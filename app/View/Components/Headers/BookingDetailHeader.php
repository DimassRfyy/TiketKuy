<?php

namespace App\View\Components\Headers;

use App\Models\Booking;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BookingDetailHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Booking $booking
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.headers.booking-detail-header');
    }
}
