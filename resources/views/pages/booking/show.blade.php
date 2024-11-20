<x-app-layout>
    <x-slot:title>
        Booking Details
    </x-slot>

    {{-- Header --}}
    <x-headers.booking-detail-header :booking="$data" />
    {{-- End --}}

    <main class="relative flex flex-col w-full px-4 gap-[18px] mt-5 pb-[30px] overflow-x-hidden">
        <div class="flex items-center justify-between rounded-3xl p-[6px] pr-[14px] bg-white overflow-hidden">
            <div class="flex items-center gap-[14px]">
                <div class="flex w-[90px] h-[90px] shrink-0 rounded-3xl bg-[#D9D9D9] overflow-hidden">
                    <img src="{{ Storage::url($data->ticket->thumbnail) }}" class="w-full h-full object-cover"
                        alt="thumbnail">
                </div>
                <div class="flex flex-col gap-[6px]">
                    <h3 class="font-semibold">{{ $data->ticket->name }}</h3>
                    <div class="flex items-center gap-1">
                        <img src="{{ asset('assets/images/icons/location.svg') }}" class="w-[18px] h-[18px]"
                            alt="icon">
                        <p class="font-semibold text-xs leading-[18px]">{{ $data->ticket->city->name }}</p>
                    </div>
                    <p class="font-bold text-sm leading-[21px] text-[#F97316]">Rp
                        {{ number_format($data->price, 0, ',', '.') }}</p>
                </div>
            </div>
            <p class="w-fit flex shrink-0 items-center gap-[2px] rounded-full p-[6px_8px] bg-[#FFE5D3]">
                <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-4 h-4" alt="star">
                <span class="font-semibold text-xs leading-[18px] text-[#F97316]">4/5</span>
            </p>
        </div>
        <div class="relative w-[361px] h-[504px] shrink-0 mx-auto overflow-hidden">
            <img src="{{ asset('assets/images/backgrounds/receipt.svg') }}"
                class="absolute w-full h-full object-contain" alt="background">
            <div class="relative flex flex-col p-5 pb-[30px] gap-6">
                <img src="{{ asset('assets/images/icons/ticket-star.svg') }}" class="w-20 h-20 mx-auto" alt="icon">
                <div class="flex flex-col gap-[14px] shrink-0 h-full">
                    <div class="flex items-center justify-between">
                        <p class="font-bold text-sm leading-[21px]">Booking Code</p>
                        <p class="font-bold text-lg leading-[21px]">{{ $data->code }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="font-bold text-sm leading-[21px]">Booking Date</p>
                        <p class="font-bold text-sm leading-[21px] text-[#FF1927]">
                            {{ $data->booking_date->format('j F Y') }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="font-bold text-sm leading-[21px]">Total People</p>
                        <p class="font-bold text-sm leading-[21px]">{{ $data->total_participant }} Participant</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="font-bold text-sm leading-[21px]">Sub Total</p>
                        <p class="font-bold text-sm leading-[21px]">Rp
                            {{ number_format($data->price * $data->total_participant, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="font-bold text-sm leading-[21px]">Tax (11%)</p>
                        <p class="font-bold text-sm leading-[21px]">Rp
                            {{ number_format($data->total - $data->price * $data->total_participant, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="font-bold text-sm leading-[21px]">Grand Total</p>
                        <p class="font-bold text-[22px] leading-[33px] text-[#F97316]">Rp
                            {{ number_format($data->total, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="font-bold text-sm leading-[21px]">Payment Status</p>
                        <p
                            class="w-fit rounded-full p-[6px_12px] {{ $data->status->getColorLabelFront() }} font-bold text-xs leading-[18px] text-white">
                            {{ $data->status->getLabel() }}</p>
                    </div>
                </div>
                <hr class="w-[321px] mx-auto border border-[#D0D5DC] border-dashed">
                <div class="flex items-center rounded-[20px] px-[10px] pb-[10px] gap-[10px] bg-[#F8F8F9]">
                    <img src="{{ asset('assets/images/icons/ticket-star-black.svg') }}" class="w-8 h-8" alt="icon">
                    <p class="leading-[28px]">
                        @if ($data->status === \App\Enums\BookingStatus::PENDING)
                            Your payment is still on pending. The ticket is not available yet.
                        @elseif($data->status === \App\Enums\BookingStatus::SUCCESS)
                            Use the <span class="font-bold">booking code</span> when you exchanging for original
                            ticket.
                        @else
                            The ticket has been cancelled. You can't use this ticket.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
