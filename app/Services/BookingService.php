<?php

namespace App\Services;

use App\Jobs\SendBookingCreatedEmail;
use App\Models\Booking;
use App\Models\Ticket;
use App\Repositories\Contracts\BookingRepositoryInterface;
use App\Repositories\Contracts\TicketRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BookingService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected TicketRepositoryInterface $ticketRepository,
        protected BookingRepositoryInterface $bookingRepository
    ) {
        //
    }

    public function calculateAmount(Ticket $ticket, $totalParticipant): array
    {
        $ticketPrice = $this->ticketRepository->getTicketPrice($ticket);

        $subTotal = $ticketPrice * $totalParticipant;
        $taxAmount = 0.11 * $subTotal;
        $totalAmount = $subTotal + $taxAmount;

        return [
            'sub_total' => $subTotal,
            'tax_amount' => $taxAmount,
            'total_amount' => $totalAmount
        ];
    }

    public function storeBookingSession(Ticket $ticket, array $data, $amount): void
    {
        Session::forget('booking_session');

        Session::put('booking_session', [
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'ticket_id' => $ticket->id,
            'total_participant' => $data['total_participant'],
            'booking_date' => $data['booking_date'],
            'price' => $ticket->price,
            'sub_total' => $amount['sub_total'],
            'tax_amount' => $amount['tax_amount'],
            'total' => $amount['total_amount']
        ]);
    }

    public function getPaymentSummary(): array
    {
        $data['booking'] = Session::get('booking_session');
        $data['ticket'] = $this->ticketRepository->show(Ticket::query()->find($data['booking']['ticket_id']));

        return $data;
    }

    public function storePayment(array $validated): Booking | null
    {
        $booking = Session::get('booking_session');
        $createdBooking = null;

        DB::beginTransaction();

        try {
            if (isset($validated['payment_proof'])) {
                $data['payment_proof'] = $validated['payment_proof']->store('booking/payment_proof', 'public');
            }

            $data['code'] = 'TRX' . date('Ymd') . strtoupper(Str::random(5));
            $data['name'] = $booking['name'];
            $data['phone'] = $booking['phone'];
            $data['email'] = $booking['email'] ?? null;
            $data['ticket_id'] = $booking['ticket_id'];
            $data['total_participant'] = $booking['total_participant'];
            $data['booking_date'] = $booking['booking_date'];
            $data['price'] = $booking['price'];
            $data['total'] = $booking['total'];
            $data['payment_method'] = $validated['payment_method'];

            $createdBooking = $this->bookingRepository->create($data);

            Session::forget('booking_session');

            SendBookingCreatedEmail::dispatch($createdBooking);

            DB::commit();

            return $createdBooking;
        } catch (\Throwable $th) {
            DB::rollBack();

            return null;
        }
    }

    public function checkBookingDetail(string $code, string $phone): Booking
    {
        $booking = $this->bookingRepository->getBookingDetailByCodeAndPhone($code, $phone);

        return $booking;
    }

    public function getBookingDetailById(Booking $booking): Booking
    {
        return $this->bookingRepository->getBookingDetailById($booking);
    }
}
