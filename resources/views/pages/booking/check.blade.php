<x-app-layout>
    <x-slot:title>
        Check Booking
    </x-slot>

    <main class="flex flex-col justify-center items-center w-full px-8 m-auto">
        <form action="{{ route('booking.check-result') }}" method="POST" autocomplete="off"
            class="flex flex-col w-[329px] shrink-0 rounded-[30px] p-5 gap-6 bg-white">
            @csrf

            <img src="{{ asset('assets/images/icons/ticket-star.svg') }}" class="w-20 h-20 mx-auto" alt="icon">

            <h1 class="font-bold text-2xl leading-9 text-center">View Your Tickets</h1>

            <div class="flex flex-col gap-[6px]">
                <label for="code" class="font-semibold text-sm leading-[21px]">Booking ID</label>
                <div
                    class="flex items-center rounded-full px-5 gap-[10px] bg-[#F8F8F9] transition-all duration-300 focus-within:ring-1 focus-within:ring-[#F97316]">
                    <img src="{{ asset('assets/images/icons/user-octagon.svg') }}" class="w-6 h-6" alt="icon">
                    <input type="text" name="code" id="code"
                        class="appearance-none outline-none py-[14px] !bg-transparent w-full font-semibold text-sm leading-[21px] placeholder:font-normal placeholder:text-[#13181D]"
                        placeholder="What’s your booking code" required>
                </div>
            </div>

            <div class="flex flex-col gap-[6px]">
                <label for="phone" class="font-semibold text-sm leading-[21px]">Phone Number</label>
                <div
                    class="flex items-center rounded-full px-5 gap-[10px] bg-[#F8F8F9] transition-all duration-300 focus-within:ring-1 focus-within:ring-[#F97316]">
                    <img src="{{ asset('assets/images/icons/mobile.svg') }}" class="w-6 h-6" alt="icon">
                    <input type="tel" name="phone" id="phone"
                        class="appearance-none outline-none py-[14px] !bg-transparent w-full font-semibold text-sm leading-[21px] placeholder:font-normal placeholder:text-[#13181D]"
                        placeholder="What’s your number" required>
                </div>
            </div>

            <button type="submit"
                class="w-full rounded-full p-[14px_20px] text-white text-center bg-[#F97316] font-bold">
                Find Now
            </button>
        </form>
    </main>

    {{-- Bottom Nav --}}
    <x-navbars.bottom-navbar />
    {{-- End --}}
</x-app-layout>
