<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class TransactionChart extends ChartWidget
{
    protected static ?string $heading = 'Transaction';
    public function getDescription(): ?string
{
    return 'Trafic transaction';
}

    protected function getData(): array
    {
        // Inisialisasi array untuk menyimpan total booking per bulan
        $monthlyBookings = array_fill(0, 12, 0);

        // Fetch total bookings with status 'success' grouped by month
        $bookings = Booking::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->where('status', 'success')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        // Isi array monthlyBookings dengan data dari query
        foreach ($bookings as $booking) {
            $monthlyBookings[$booking->month - 1] = $booking->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Bookings (Success)',
                    'data' => $monthlyBookings,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
