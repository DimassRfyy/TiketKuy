<x-app-layout>
    <x-slot:title>
        Category Detail
    </x-slot>

    {{-- Header --}}
    <x-headers.category-detail-header />
    {{-- End --}}

    {{-- Category Detail --}}
    <main class="relative flex flex-col w-full gap-[30px] mt-[30px] overflow-x-hidden">
        <div class="flex flex-col gap-2 px-4">
            <div class="flex items-center gap-[6px]">
                <img src="{{ Storage::url($category->light_icon) }}" class="w-[22px] h-[22px]" alt="icon">
                <p class="font-semibold text-sm leading-[21px] text-white">{{ $category->name }}</p>
            </div>
            <p class="font-bold text-xl leading-[30px] text-white">
                Browse <span class="text-[#F97316]">{{ $category->tickets_count }}</span> Places <br>
                Available Worth to Visit
            </p>
        </div>

        {{-- Ticket List --}}
        <section id="Places" class="flex flex-col gap-3 px-4 pb-10">
            @foreach ($category->tickets as $ticket)
                <a href="{{ route('ticket.show', $ticket) }}" class="card">
                    <div
                        class="flex items-center justify-between rounded-3xl p-[6px] pr-[14px] bg-white overflow-hidden">
                        <div class="flex items-center gap-[14px]">
                            <div class="flex w-[90px] h-[90px] shrink-0 rounded-3xl bg-[#D9D9D9] overflow-hidden">
                                <img src="{{ Storage::url($ticket->thumbnail) }}" class="w-full h-full object-cover"
                                    alt="thumbnail">
                            </div>
                            <div class="flex flex-col gap-[6px]">
                                <h3 class="font-semibold">{{ $ticket->name }}</h3>
                                <div class="flex items-center gap-1">
                                    <img src="{{ asset('assets/images/icons/location.svg') }}" class="w-[18px] h-[18px]"
                                        alt="icon">
                                    <p class="font-semibold text-xs leading-[18px]">{{ $ticket->city->name }}</p>
                                </div>
                                <p class="font-bold text-sm leading-[21px] text-[#F97316]">Rp
                                    {{ number_format($ticket->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        <p class="w-fit flex shrink-0 items-center gap-[2px] rounded-full p-[6px_8px] bg-[#FFE5D3]">
                            <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-4 h-4" alt="star">
                            <span class="font-semibold text-xs leading-[18px] text-[#F97316]">4/5</span>
                        </p>
                    </div>
                </a>
            @endforeach
        </section>
        {{-- End --}}
    </main>
    {{-- End --}}
</x-app-layout>
