<?php

namespace App\View\Components\Headers;

use App\Models\Ticket;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PaymentCreateHeader extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Ticket $ticket
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.headers.payment-create-header');
    }
}
