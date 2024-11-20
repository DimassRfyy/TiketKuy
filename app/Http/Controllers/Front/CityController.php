<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Services\CityService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct(protected CityService $cityService)
    {
        //
    }

    public function show(City $city): View
    {
        $data = $this->cityService->getCategoryDetailData($city);

        return view('pages.city.show', [
            'city' => $data
        ]);
    }
}
