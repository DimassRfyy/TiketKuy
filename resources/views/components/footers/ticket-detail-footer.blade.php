<div>
    <nav id="Bottom-Nav-Book"
        class="fixed bottom-0 flex items-center justify-between w-full max-w-[640px] bg-white p-4 z-30">
        <div>
            <p class="font-bold text-[22px] leading-[26px]">Rp {{ number_format($ticket->price, 0, ',', '.') }}</p>
            <p class="text-sm leading-[26px] text-[#70758F]">/person</p>
        </div>
        <a href="{{ route('booking.create', $ticket) }}">
            <div class="flex items-center p-1 pl-5 w-fit gap-4 rounded-full bg-[#13181D]">
                <p class="font-bold text-white">Book Now</p>
                <img src="{{ asset('assets/images/icons/coupon.svg') }}" class="w-[50px] h-[50px]" alt="icon">
            </div>
        </a>
    </nav>
</div>
