<?php

namespace App\Filament\Resources\BookingResource\Widgets;

use App\Enums\BookingStatus;
use App\Models\Booking;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BookingStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Booking', Booking::query()->count())
                ->description('Total ticket bookings')
                ->icon('heroicon-m-ticket')
                ->color('gray'),
            Stat::make('Success Booking', Booking::query()->where('status', BookingStatus::SUCCESS)->count())
                ->description('Total success bookings')
                ->icon('heroicon-m-check')
                ->color('success'),
            Stat::make('Total Revenue', 'Rp ' . number_format(Booking::query()->where('status', BookingStatus::SUCCESS)->sum('total'), 0, ',', '.'))
                ->description('Total revenue')
                ->icon('heroicon-m-currency-dollar')
                ->color('info'),
        ];
    }
}
