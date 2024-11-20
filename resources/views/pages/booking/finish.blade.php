<x-app-layout>
    <x-slot:title>
        Success Booking
    </x-slot>

    {{-- Header --}}
    <x-headers.payment-finish-header :booking="$booking" />
    {{-- End --}}

    <div class="relative mt-5 flex flex-1 justify-center items-center p-4 w-full h-full">
        <div class="flex flex-col h-fit w-full max-w-[361px] rounded-[30px] p-5 gap-6 bg-white">
            <img src="{{ asset('assets/images/icons/ticket-star.svg') }}" class="w-20 h-20 mx-auto" alt="icon">
            <h1 class="font-bold text-2xl leading-9 text-center">Booking Finished, <br>Well Done! 🤩</h1>
            <a href="{{ route('booking.show', $booking) }}">
                <div
                    class="flex items-center w-full rounded-full transition-all duration-300 hover:ring-1 hover:ring-[#F97316] py-3 px-4 gap-4 bg-[#F8F8F9]">
                    <img src="{{ asset('assets/images/icons/receipt-text.svg') }}" class="w-8 h-8 flex shrink-0"
                        alt="icon">
                    <p>Booking ID <span class="font-bold text-[#07B704]">{{ $booking->code }}</span></p>
                </div>
            </a>
            <p class="leading-[28px] text-center">We will check the payment and update the status to your email address
            </p>
            <div class="flex flex-col gap-3">
                <a href="{{ route('front.index') }}"
                    class="w-full rounded-full p-[14px_20px] text-white text-center bg-[#F97316] font-bold">
                    Explore More Tickets
                </a>
                <a href="{{ route('booking.check') }}"
                    class="w-full rounded-full p-[14px_20px] text-white text-center bg-[#13181D] font-bold">
                    View My Booking
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
