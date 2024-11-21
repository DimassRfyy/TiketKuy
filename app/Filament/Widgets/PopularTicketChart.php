<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Booking;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;

class PopularTicketChart extends ChartWidget
{
    protected static ?string $heading = 'Popular Tickets';
    public function getDescription(): ?string
{
    return 'Top 10 most booked tickets';
}
    protected static ?string $maxHeight = '385px';

    protected function getData(): array
    {
        // Tentukan bulan dan tahun yang ingin difilter
        $month = request()->input('month', date('m')); // Default ke bulan saat ini
        $year = request()->input('year', date('Y')); // Default ke tahun saat ini

        // Fetch the top most booked tickets with status 'success' for the specified month and year
        $bookings = Booking::select('ticket_id', DB::raw('count(*) as total'))
            ->where('status', 'success')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->groupBy('ticket_id')
            ->orderBy('total', 'desc')
            ->take(10)
            ->get();

        // Prepare the data and labels
        $data = [];
        $labels = [];
        $backgroundColors = [];
        $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'];

        foreach ($bookings as $index => $booking) {
            $ticket = Ticket::find($booking->ticket_id);
            $labels[] = $ticket->name;
            $data[] = $booking->total;
            $backgroundColors[] = $colors[$index % count($colors)];
        }

        return [
            'datasets' => [
                [
                    'label' => 'Most Booked Tickets',
                    'data' => $data,
                    'backgroundColor' => $backgroundColors,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
