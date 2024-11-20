<?php

namespace App\Repositories\Contracts;

use App\Models\Booking;

interface BookingRepositoryInterface
{
    public function create(array $data): Booking;

    public function getBookingDetailByCodeAndPhone(string $code, string $phone): Booking;

    public function getBookingDetailById(Booking $booking): Booking;
}
