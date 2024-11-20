<?php

namespace App\Repositories\Contracts;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;

interface TicketRepositoryInterface
{
    public function getPopularTickets(int $limit = 4): Collection;

    public function getLatestTicket(): Collection;

    public function show(Ticket $ticket): Ticket;

    public function getTicketPrice(Ticket $ticket): mixed;
}
