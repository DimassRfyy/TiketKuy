<?php

namespace App\Repositories;

use App\Models\Ticket;
use App\Repositories\Contracts\TicketRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TicketRepository implements TicketRepositoryInterface
{
    public function getPopularTickets(int $limit = 4): Collection
    {
        return Ticket::with(['category:id,name'])->where('is_popular', true)->take($limit)->get();
    }

    public function getLatestTicket(): Collection
    {
        return Ticket::with(['city:id,name'])->latest()->get();
    }

    public function show(Ticket $ticket): Ticket
    {
        $ticket->load(['category', 'city', 'ticketPhotos']);

        return $ticket;
    }

    public function getTicketPrice(Ticket $ticket): mixed
    {
        return $ticket->price;
    }
}
