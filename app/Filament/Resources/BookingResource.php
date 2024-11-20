<?php

namespace App\Filament\Resources;

use App\Enums\BookingStatus;
use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Filament\Resources\BookingResource\Widgets\BookingStats;
use App\Jobs\SendBookingApprovedEmail;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action as FilamentAction;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\VerticalAlignment;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

use function Livewire\after;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Transaction';

    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('ticket.city:id,name');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\Select::make('ticket_id')
                    ->relationship('ticket', 'name')
                    ->required(),
                Forms\Components\TextInput::make('total_participant')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('booking_date')
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('total')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('pending'),
                Forms\Components\TextInput::make('payment_method')
                    ->required()
                    ->maxLength(255)
                    ->default('transfer'),
                Forms\Components\TextInput::make('payment_proof')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->description(fn(Booking $record) => $record->phone)
                    ->searchable(),
                Tables\Columns\TextColumn::make('ticket.name')
                    ->description(fn(Booking $record) => $record->ticket->city->name)
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('booking_date')
                    ->description(fn(Booking $record) => $record->ticket->opened_at->format('H:i') . ' - ' . $record->ticket->closed_at->format('H:i'))
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->prefix('Rp ')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn($state) => $state->getColor())
                    ->icon(fn($state) => $state->getIcon()),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(BookingStatus::class)
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        Tables\Actions\ViewAction::make(),
                        Action::make('approve')
                            ->requiresConfirmation()
                            ->icon('heroicon-o-check')
                            ->color('success')
                            ->visible(fn(Booking $record) => $record->status === BookingStatus::PENDING)
                            ->action(function (Booking $record) {
                                $record->approve();
                                SendBookingApprovedEmail::dispatch($record);
                            })
                            ->after(function () {
                                Notification::make()
                                    ->success()
                                    ->title('Approved!')
                                    ->body('Booking ticket has been approved.')
                                    ->send();
                            }),
                        Action::make('reject')
                            ->requiresConfirmation()
                            ->icon('heroicon-o-x-mark')
                            ->color('warning')
                            ->visible(fn(Booking $record) => $record->status === BookingStatus::PENDING)
                            ->action(fn(Booking $record) => $record->reject())
                            ->after(function () {
                                Notification::make()
                                    ->success()
                                    ->title('Rejected!')
                                    ->body('Booking ticket has been rejected.')
                                    ->send();
                            }),
                    ])
                        ->dropdown(false),
                    Tables\Actions\DeleteAction::make()
                ])
                    ->icon('heroicon-m-bars-3'),
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            // 'create' => Pages\CreateBooking::route('/create'),
            // 'view' => Pages\ViewBooking::route('/{record}'),
            // 'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::$model::where('status', BookingStatus::PENDING)->count();
    }

    public static function getWidgets(): array
    {
        return [
            BookingStats::class
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            TextEntry::make('created_at')
                ->label('Transaction Date'),
            TextEntry::make('code')
                ->label('Booking Code')
                ->badge()
                ->color('primary'),
            Section::make('Customer Detail')
                ->schema([
                    TextEntry::make('name')
                        ->label('Name'),
                    TextEntry::make('email')
                        ->label('Email'),
                    TextEntry::make('phone')
                        ->label('Phone'),
                ])
                ->columns(3),
            Section::make('Ticket Detail')
                ->schema([
                    TextEntry::make('ticket.name')
                        ->label('Ticket Name'),
                    TextEntry::make('ticket.city.name')
                        ->label('Ticket City'),
                    TextEntry::make('price')
                        ->label('Ticket Price')
                        ->numeric()
                        ->prefix('Rp '),
                ])
                ->columns(3),
            Section::make('Additional Information')
                ->schema([
                    TextEntry::make('booking_date')
                        ->label('Booking Date'),
                    TextEntry::make('total_participant')
                        ->label('Total Participant'),
                    TextEntry::make('total')
                        ->label('Total Price')
                        ->numeric()
                        ->prefix('Rp '),
                    TextEntry::make('status')
                        ->label('Status')
                        ->badge()
                        ->color(fn($state) => $state->getColor())
                        ->icon(fn($state) => $state->getIcon()),
                ])
                ->columns(2),
            TextEntry::make('payment_method')
                ->label('Payment Method')
                ->badge()
                ->color(fn($state) => $state->getColor())
                ->icon(fn($state) => $state->getIcon()),
            Actions::make([
                FilamentAction::make('openPaymentProof')
                    ->url(fn(Booking $record): string => Storage::url($record->payment_proof))
                    ->openUrlInNewTab()
                    ->icon('heroicon-m-link')
                    ->color('info')
                    ->label('Payment Proof')
            ])
                ->verticalAlignment(VerticalAlignment::End)
        ]);
    }
}
