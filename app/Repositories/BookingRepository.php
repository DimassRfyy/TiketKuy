<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Repositories\Contracts\BookingRepositoryInterface;

class BookingRepository implements BookingRepositoryInterface
{
    public function create(array $data): Booking
    {
        return Booking::query()->create($data);
    }

    public function getBookingDetailByCodeAndPhone(string $code, string $phone): Booking
    {
        return Booking::with(['ticket', 'ticket.city'])
            ->where('code', $code)
            ->where('phone', $phone)
            ->first();
    }

    public function getBookingDetailById(Booking $booking): Booking
    {
        $booking->load(['ticket', 'ticket.city']);

        return $booking;
    }
}
