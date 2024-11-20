<x-app-layout>
    <x-slot:title>
        Ticket Detail
    </x-slot>

    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    @endpush

    {{-- Header --}}
    <x-headers.ticket-detail-header :ticket="$ticket" />
    {{-- End --}}

    {{-- Ticket Detail --}}
    <main id="details" class="flex flex-col gap-5 px-4 pb-[116px]">
        <section id="Get-to-Know" class="flex flex-col gap-[6px]">
            <h2 class="font-bold text-sm leading--[21px]">Get to Know</h2>
            <p class="text-sm leading-[28px]">{!! $ticket->about !!}</p>
        </section>
        <section id="Time" class="flex flex-col gap-[6px]">
            <h2 class="font-bold text-sm leading--[21px]">Time</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex items-center rounded-3xl p-[14px_16px] gap-4 bg-[#F8F8F9]">
                    <img src="{{ asset('assets/images/icons/timer.svg') }}" class="w-6 h-6" alt="icon">
                    <div class="text-left">
                        <p class="text-sm leading-[21px]">Open Time</p>
                        <p class="font-bold text-lg leading-[27px]">{{ $ticket->opened_at->format('H:i') }}</p>
                    </div>
                </div>
                <div class="flex items-center rounded-3xl p-[14px_16px] gap-4 bg-[#F8F8F9]">
                    <img src="{{ asset('assets/images/icons/clock.svg') }}" class="w-6 h-6" alt="icon">
                    <div class="text-left">
                        <p class="text-sm leading-[21px]">Closed Time</p>
                        <p class="font-bold text-lg leading-[27px]">{{ $ticket->closed_at->format('H:i') }}</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="Travel-with-Juara" class="flex flex-col gap-[6px]">
            <h2 class="font-bold text-sm leading-[21px]">Get to Know</h2>
            <div class="grid grid-cols-3 gap-3">
                <div class="flex flex-col items-center rounded-3xl p-[14px_16px] gap-3 text-center bg-[#13181D]">
                    <img src="{{ asset('assets/images/icons/security-card.svg') }}" class="w-9 h-9" alt="icon">
                    <div>
                        <h3 class="font-bold text-sm leading-[21px] text-white">Security</h3>
                        <p class="text-xs leading-[18px] text-white">24/7 Support</p>
                    </div>
                </div>
                <div class="flex flex-col items-center rounded-3xl p-[14px_16px] gap-3 text-center bg-[#13181D]">
                    <img src="{{ asset('assets/images/icons/hospital.svg') }}" class="w-9 h-9" alt="icon">
                    <div>
                        <h3 class="font-bold text-sm leading-[21px] text-white">Insurance</h3>
                        <p class="text-xs leading-[18px] text-white">Available</p>
                    </div>
                </div>
                <div class="flex flex-col items-center rounded-3xl p-[14px_16px] gap-3 text-center bg-[#13181D]">
                    <img src="{{ asset('assets/images/icons/lovely.svg') }}" class="w-9 h-9" alt="icon">
                    <div>
                        <h3 class="font-bold text-sm leading-[21px] text-white">Comfort</h3>
                        <p class="text-xs leading-[18px] text-white">Easy Refund</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="Management" class="flex flex-col gap-[6px]">
            <h2 class="font-bold text-sm leading--[21px]">Management</h2>
            <div class="flex items-center justify-between rounded-3xl p-[10px] pr-[14px] bg-[#F8F8F9]">
                <div class="flex items-center gap-[14px]">
                    <div class="w-[60px] h-[60px] rounded-[20px] overflow-hidden">
                        <img src="{{ Storage::url($ticket->city->photo) }}" class="w-full h-full object-cover"
                            alt="">
                    </div>
                    <div>
                        <p class="font-bold text-lg leading-[27px]">{{ $ticket->city->name }}</p>
                        <p class="text-sm leading-[21px]">{{ $ticket->city->phone }}</p>
                    </div>
                </div>
                <a href="tel:{{ str_replace(' ', '', $ticket->city->phone) }}">
                    <img src="{{ asset('assets/images/icons/call-orange.svg') }}" class="w-10 h-10" alt="">
                </a>
            </div>
        </section>
        <section id="Map" class="flex flex-col gap-[10px]">
            <h2 class="font-bold text-sm leading--[21px]">Map & Address</h2>
            <div class="w-full h-[200px] overflow-hidden">
                <div id="embedded-map-display" class="w-full h-full">
                    <iframe class="w-full h-full" frameborder="0"
                        src="https://www.google.com/maps/embed/v1/place?q={{ $ticket->address }}&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"></iframe>
                </div>
            </div>
            <p class="text-sm leading-[28px]">{!! $ticket->address !!}</p>
        </section>
    </main>
    {{-- End --}}

    {{-- Footer --}}
    <x-footers.ticket-detail-footer :ticket="$ticket" />
    {{-- End --}}

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
        <script defer src="{{ asset('js/details.js') }}"></script>
        <script>
            const player = new Plyr('#player', {
                controls: ['play-large'],
                speed: {
                    selected: 1
                }
            });

            const playBtn = document.getElementById("playBtn");
            let played = false

            playBtn.addEventListener("click", () => {
                if (!played) {
                    player.play();
                    played = true;
                } else {
                    player.pause();
                    played = false;
                }
            });
        </script>
    @endpush
</x-app-layout>
