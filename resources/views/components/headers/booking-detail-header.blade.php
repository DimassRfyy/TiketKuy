<div>
    <div id="background" class="fixed w-full max-w-[640px] top-0 h-screen z-0">
        <div class="absolute z-0 w-full h-[459px] bg-[linear-gradient(180deg,#000000_12.61%,rgba(0,0,0,0)_70.74%)]">
        </div>
        <img src="{{ Storage::url($booking->ticket->thumbnail) }}" class="w-full h-full object-cover" alt="background">
    </div>

    <div id="Top-Nav-Fixed" class="relative flex items-center justify-between w-full max-w-[640px] px-4 mt-[60px] z-20">
        <div class="fixed flex items-center justify-between w-full max-w-[640px] -ml-4 px-4 mx-auto">
            <a href="{{ route('booking.check') }}">
                <img src="{{ asset('assets/images/icons/back.svg') }}" class="w-12 h-12" alt="icon">
            </a>
            <a href="#">
                <img src="{{ asset('assets/images/icons/heart.svg') }}" class="w-12 h-12" alt="icon">
            </a>
        </div>
        <div class="flex items-center justify-center h-12 w-full shrink-0">
            <h1 class="font-bold text-lg leading-[27px] text-white text-center w-full">Booking Details</h1>
        </div>
    </div>
</div>
