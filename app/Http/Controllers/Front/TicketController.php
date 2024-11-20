<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct(protected TicketService $ticketService)
    {
        //
    }

    public function show(Ticket $ticket): View
    {
        $data = $this->ticketService->getTicketDetail($ticket);

        return view('pages.ticket.show', [
            'ticket' => $data
        ]);
    }
}
