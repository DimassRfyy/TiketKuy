<x-app-layout>
    <x-slot:title>
        Home
    </x-slot>

    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @endpush

    {{-- Navbar --}}
    <x-navbars.front-navbar />
    {{-- End --}}

    <main class="flex flex-col w-full gap-5 mt-5 overflow-x-hidden">
        {{-- Popular Tickets --}}
        <section id="Popular" class="flex flex-col gap-3">
            <h2 class="px-4 font-bold">Popular This Year</h2>
            <div class="swiper-popular w-full overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach ($data['popular_ticket'] as $popular)
                        <div class="swiper-slide !w-fit">
                            <a href="{{ route('ticket.show', $popular) }}" class="card">
                                <div
                                    class="relative flex items-end w-[345px] h-[220px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                                    <img src="{{ Storage::url($popular->thumbnail) }}"
                                        class="absolute w-full h-full object-cover" alt="thumbnail">
                                    <div
                                        class="flex items-center justify-between w-full h-fit rounded-[17px] border border-white/40 p-[8px_10px] mx-4 mb-4 bg-[#94959966] backdrop-blur-sm">
                                        <div>
                                            <h3 class="font-bold text-white">{{ $popular->name }}</h3>
                                            <p class="text-sm leading-[18px] text-white">{{ $popular->category->name }}
                                            </p>
                                        </div>
                                        <p
                                            class="w-fit flex shrink-0 items-center gap-[2px] rounded-full p-[6px_8px] bg-white">
                                            <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-4 h-4"
                                                alt="star">
                                            <span class="font-semibold text-xs leading-[18px]">4/5</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        {{-- End --}}

        {{-- Categories --}}
        <section id="Categories" class="flex flex-col gap-3">
            <h2 class="px-4 font-bold">By Categories</h2>
            <div class="swiper-categories w-full overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach ($data['categories'] as $category)
                        <div class="swiper-slide !w-fit">
                            <a href="{{ route('category.show', $category) }}" class="card">
                                <div
                                    class="flex items-center w-fit rounded-full text-nowrap p-[14px_20px] gap-[10px] bg-[#F8F8F9]">
                                    <img src="{{ Storage::url($category->dark_icon) }}" class="w-6 h-6" alt="icon">
                                    <p class="font-bold text-sm leading-[21px]">{{ $category->name }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        {{-- End --}}

        {{-- Cities --}}
        <section id="Should-Visit" class="flex flex-col gap-3">
            <h2 class="px-4 font-bold">You Should Visit</h2>
            <div class="swiper-visit w-full overflow-hidden">
                <div class="swiper-wrapper">
                    @foreach ($data['cities'] as $city)
                        <div class="swiper-slide !w-fit">
                            <a href="{{ route('city.show', $city) }}" class="card">
                                <div
                                    class="relative flex items-end w-[170px] h-[200px] shrink-0 rounded-[30px] bg-[#D9D9D9] overflow-hidden">
                                    <img src="{{ Storage::url($city->photo) }}"
                                        class="absolute w-full h-full object-cover" alt="thumbnail">
                                    <div
                                        class="flex items-center justify-between w-full h-fit rounded-[17px] border border-white/40 p-[8px_10px] mx-[10px] mb-[10px] bg-[#94959966] backdrop-blur-sm">
                                        <div>
                                            <h3 class="font-bold text-white">{{ $city->name }}</h3>
                                            <p class="text-sm leading-[18px] text-white">{{ $city->tickets_count }}
                                                Places</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        {{-- End --}}

        {{-- Latest Ticket --}}
        <section id="Available" class="flex flex-col gap-3 px-4 py-5 bg-[#F8F8F9] mb-[94px]">
            <h2 class="font-bold">Now Available</h2>
            <div class="flex flex-col gap-3">
                @foreach ($data['latest_ticket'] as $latest)
                    <a href="{{ route('ticket.show', $latest) }}" class="card">
                        <div
                            class="flex items-center justify-between rounded-3xl p-[6px] pr-[14px] bg-white overflow-hidden">
                            <div class="flex items-center gap-[14px]">
                                <div class="flex w-[90px] h-[90px] shrink-0 rounded-3xl bg-[#D9D9D9] overflow-hidden">
                                    <img src="{{ Storage::url($latest->thumbnail) }}"
                                        class="w-full h-full object-cover" alt="thumbnail">
                                </div>
                                <div class="flex flex-col gap-[6px]">
                                    <h3 class="font-semibold">{{ $latest->name }}</h3>
                                    <div class="flex items-center gap-1">
                                        <img src="{{ asset('assets/images/icons/location.svg') }}"
                                            class="w-[18px] h-[18px]" alt="icon">
                                        <p class="font-semibold text-xs leading-[18px]">{{ $latest->city->name }}</p>
                                    </div>
                                    <p class="font-bold text-sm leading-[21px] text-[#F97316]">Rp.
                                        {{ number_format($latest->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <p class="w-fit flex shrink-0 items-center gap-[2px] rounded-full p-[6px_8px] bg-[#FFE5D3]">
                                <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-4 h-4"
                                    alt="star">
                                <span class="font-semibold text-xs leading-[18px] text-[#F97316]">4/5</span>
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        {{-- End --}}
    </main>

    {{-- Bottom Nav --}}
    <x-navbars.bottom-navbar />
    {{-- End --}}

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="{{ asset('js/home.js') }}"></script>
    @endpush
</x-app-layout>
