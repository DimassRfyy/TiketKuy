<x-app-layout>
    <x-slot:title>
        City Detail
    </x-slot>

    {{-- Header --}}
    <x-headers.city-detail-header />
    {{-- End --}}

    <main class="relative flex flex-col w-full gap-[30px] mt-[30px] overflow-x-hidden">
        <div class="flex flex-col items-center text-center gap-5 px-4">
            <div class="w-[120px] h-[120px] rounded-[50px] bg-[#D9D9D9] overflow-hidden">
                <img src="{{ Storage::url($city->photo) }}" class="w-full h-full object-cover" alt="thumbnail">
            </div>
            <p class="font-bold text-xl leading-[30px]">
                <span class="text-[#F97316]">{{ $city->ticket_counts }}</span> Things to Do <br>
                in {{ $city->name }}
            </p>
        </div>
        <section id="Places" class="flex flex-col gap-3 px-4 pb-10">
            @foreach ($city->tickets as $ticket)
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
                                    <img src="{{ Storage::url($ticket->category->dark_icon) }}"
                                        class="w-[18px] h-[18px]" alt="icon">
                                    <p class="font-semibold text-xs leading-[18px]">{{ $ticket->category->name }}</p>
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
    </main>
</x-app-layout>
