<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\Contracts\CityRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CityRepository implements CityRepositoryInterface
{
    public function all(): Collection
    {
        return City::query()->withCount('tickets')->get();
    }

    public function getTicketBasedOnCity(City $city): City
    {
        $city->load(['tickets', 'tickets.category:id,name,dark_icon'])->loadCount('tickets');
        return $city;
    }
}
