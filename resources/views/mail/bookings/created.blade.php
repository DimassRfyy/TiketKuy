<x-mail::message>
Hi {{ $booking->name }}, thank you for ordering ticket in JuaraTicket. We are currently checking your payment, you can check your ticket via check ticket page using your booking code : <strong>{{ $booking->code }}</strong>.

<x-mail::button :url="$check_booking_url">
Cek Booking
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
