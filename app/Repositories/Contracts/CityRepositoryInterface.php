<?php

namespace App\Repositories\Contracts;

use App\Models\City;
use Illuminate\Database\Eloquent\Collection;

interface CityRepositoryInterface
{
    public function all(): Collection;

    public function getTicketBasedOnCity(City $city): City;
}
