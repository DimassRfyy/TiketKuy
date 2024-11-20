<?php

namespace App\Services;

use App\Models\Ticket;
use App\Repositories\Contracts\TicketRepositoryInterface;

class TicketService
{
    public function __construct(protected TicketRepositoryInterface $ticketRepository)
    {
        //
    }

    public function getTicketDetail(Ticket $ticket): Ticket
    {
        return $this->ticketRepository->show($ticket);
    }
}
