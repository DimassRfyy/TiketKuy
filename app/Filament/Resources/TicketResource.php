<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TicketResource\Pages;
use App\Filament\Resources\TicketResource\RelationManagers;
use App\Models\Ticket;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Transaction';

    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('category:id,name');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Ticket Detail')
                    ->description('Detail information about the ticket')
                    ->icon('heroicon-m-ticket')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn($state, Set $set) => $set('slug', Str::slug($state) . '-' . strtolower(Str::random(5))))
                            ->prefixIcon('heroicon-m-ticket'),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated()
                            ->unique(Ticket::class, 'slug', ignoreRecord: true)
                            ->prefixIcon('heroicon-m-link'),
                        Forms\Components\FileUpload::make('thumbnail')
                            ->required()
                            ->image()
                            ->disk('public')
                            ->directory('ticket/thumbnails'),
                        Forms\Components\TextInput::make('video_url')
                            ->maxLength(255)
                            ->url()
                            ->prefixIcon('heroicon-m-video-camera'),
                        Forms\Components\RichEditor::make('about')
                            ->columnSpanFull(),
                        Forms\Components\RichEditor::make('address')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Ticket Additional Information')
                    ->description('Additional information regarding related ticket')
                    ->icon('heroicon-m-document-text')
                    ->schema([
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->prefixIcon('heroicon-m-list-bullet'),
                        Forms\Components\Select::make('city_id')
                            ->relationship('city', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->prefixIcon('heroicon-m-building-library'),
                        Forms\Components\TimePicker::make('opened_at')
                            ->required()
                            ->prefixIcon('heroicon-m-clock'),
                        Forms\Components\TimePicker::make('closed_at')
                            ->required()
                            ->prefixIcon('heroicon-m-clock'),
                        Forms\Components\Toggle::make('is_popular')
                            ->required()
                            ->inline(false),
                    ])
                    ->columns(3),
                Section::make('Ticket Photo')
                    ->description('Various photos about related ticket')
                    ->icon('heroicon-m-document-text')
                    ->schema([
                        Repeater::make('ticketPhotos')
                            ->relationship()
                            ->schema([
                                Forms\Components\FileUpload::make('photo')
                                    ->required()
                                    ->image()
                                    ->disk('public')
                                    ->directory('ticket/ticket-photos')
                            ])
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->description(fn(Ticket $record): string => $record->category->name)
                    ->searchable(),
                Tables\Columns\TextColumn::make('city.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->numeric()
                    ->prefix('Rp. ')
                    ->sortable(),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->circular(),
                Tables\Columns\ToggleColumn::make('is_popular')
                    ->label('Is Popular')
                    ->afterStateUpdated(function () {
                        Notification::make()
                            ->info()
                            ->title('Info')
                            ->body('Ticket popular is updated.')
                            ->send();
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
            ])
            ->actions([
                ActionGroup::make([
                    ActionGroup::make([
                        Tables\Actions\ViewAction::make(),
                        Tables\Actions\EditAction::make(),
                    ])
                        ->dropdown(false),
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->icon('heroicon-m-bars-3')
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
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'view' => Pages\ViewTicket::route('/{record}'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
