<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\FrontService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function __construct(protected FrontService $frontService)
    {
        //
    }

    public function index(): View
    {
        $data = $this->frontService->getFrontPageData();

        return view('pages.front.index', compact('data'));
    }
}
