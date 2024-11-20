<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\Booking\CheckBookingResultRequest;
use App\Http\Requests\Front\Booking\PaymentStoreRequest;
use App\Http\Requests\Front\Booking\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Ticket;
use App\Services\BookingService;
use App\Services\TicketService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct(
        protected TicketService $ticketService,
        protected BookingService $bookingService
    ) {
        //
    }

    public function create(Ticket $ticket): View
    {
        $data = $this->ticketService->getTicketDetail($ticket);

        return view('pages.booking.create', [
            'ticket' => $data
        ]);
    }

    public function store(StoreBookingRequest $request, Ticket $ticket): RedirectResponse
    {
        $validatedData = $request->validated();
        $amount = $this->bookingService->calculateAmount($ticket, $validatedData['total_participant']);

        $this->bookingService->storeBookingSession($ticket, $validatedData, $amount);

        return redirect(route('booking.payment'));
    }

    public function payment(): View
    {
        $data = $this->bookingService->getPaymentSummary();

        return view('pages.booking.payment', compact('data'));
    }

    public function paymentStore(PaymentStoreRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $booking = $this->bookingService->storePayment($validatedData);

        if ($booking) {
            return redirect(route('booking.finish', $booking));
        }

        return back()->withErrors(['error' => 'Payment failed. Please try again.']);
    }

    public function finish(Booking $booking): View
    {
        return view('pages.booking.finish', compact('booking'));
    }

    public function show(Booking $booking): View
    {
        $data = $this->bookingService->getBookingDetailById($booking);

        return view('pages.booking.show', compact('data'));
    }

    public function check(): View
    {
        return view('pages.booking.check');
    }

    public function checkResult(CheckBookingResultRequest $request): View
    {
        $validatedData = $request->validated();
        $data = $this->bookingService->checkBookingDetail($validatedData['code'], $validatedData['phone']);

        return view('pages.booking.show', compact('data'));
    }
}
