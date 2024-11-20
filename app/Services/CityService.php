<?php

namespace App\Services;

use App\Models\City;
use App\Repositories\Contracts\CityRepositoryInterface;

class CityService
{
    /**
     * Create a new class instance.
     */
    public function __construct(protected CityRepositoryInterface $cityRepository)
    {
        //
    }

    public function getCategoryDetailData(City $city): City
    {
        return $this->cityRepository->getTicketBasedOnCity($city);
    }
}
