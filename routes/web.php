<?php

use App\Http\Controllers\Front\BookingController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\CityController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Front\TicketController;
use Illuminate\Support\Facades\Route;

Route::name('front.')->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('index');
});

Route::prefix('category')->name('category.')->group(function () {
    Route::get('/{category:slug}', [CategoryController::class, 'show'])->name('show');
});

Route::prefix('city')->name('city.')->group(function () {
    Route::get('/{city:slug}', [CityController::class, 'show'])->name('show');
});

Route::prefix('ticket')->name('ticket.')->group(function () {
    Route::get('/{ticket:slug}', [TicketController::class, 'show'])->name('show');
});

Route::prefix('booking')->name('booking.')->group(function () {
    Route::get('/finish/{booking}', [BookingController::class, 'finish'])->name('finish');

    Route::get('/payment', [BookingController::class, 'payment'])->name('payment');
    Route::post('/payment', [BookingController::class, 'paymentStore'])->name('payment-store');

    Route::get('/check', [BookingController::class, 'check'])->name('check');
    Route::post('/check-result', [BookingController::class, 'checkResult'])->name('check-result');

    Route::get('/create/{ticket:slug}', [BookingController::class, 'create'])->name('create');
    Route::post('/{ticket:slug}', [BookingController::class, 'store'])->name('store');

    Route::get('/{booking}', [BookingController::class, 'show'])->name('show');
});
