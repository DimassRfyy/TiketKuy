<x-mail::message>
Hi {{ $booking->name }}, we have approved your payment. You can use your ticket later from check ticket page using your booking code : <strong>{{ $booking->code }}</strong>.

<x-mail::button :url="$check_booking_url">
Check Booking
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
