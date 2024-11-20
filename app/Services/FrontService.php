<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\CityRepositoryInterface;
use App\Repositories\Contracts\TicketRepositoryInterface;

class FrontService
{
    public function __construct(
        protected TicketRepositoryInterface $ticketRepository,
        protected CategoryRepositoryInterface $categoryRepository,
        protected CityRepositoryInterface $cityRepository
    ) {
        //
    }

    public function getFrontPageData(): array
    {
        $data['popular_ticket'] = $this->ticketRepository->getPopularTickets();
        $data['categories'] = $this->categoryRepository->all();
        $data['cities'] = $this->cityRepository->all();
        $data['latest_ticket'] = $this->ticketRepository->getLatestTicket();

        return $data;
    }
}
