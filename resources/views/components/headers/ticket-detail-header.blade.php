<div>
    <header class="relative h-[480px] mb-[44px]">
        <div id="Absolute-Top-Nav" class="absolute flex items-center justify-between w-full px-4 mt-[60px] z-10">
            <a href="{{ route('front.index') }}">
                <img src="{{ asset('assets/images/icons/back.svg') }}" class="w-12 h-12" alt="icon">
            </a>
            <a href="#">
                <img src="{{ asset('assets/images/icons/heart.svg') }}" class="w-12 h-12" alt="icon">
            </a>
        </div>
        <div id="Title" class="absolute bottom-0 w-full p-4 pt-0 z-10">
            <div
                class="flex items-center justify-between w-full h-fit rounded-[17px] border border-white/40 p-[8px_10px] bg-[#94959966] backdrop-blur-sm z-10">
                <div>
                    <h1 class="font-bold text-white line-clamp-2">{{ $ticket->name }}</h1>
                    <div class="flex items-center gap-[6px]">
                        <img src="{{ Storage::url($ticket->category->light_icon) }}" class="w-[22px] h-[22px]"
                            alt="icon">
                        <p class="text-sm leading-[18px] text-white">{{ $ticket->category->name }}</p>
                    </div>
                </div>
                <p class="w-fit flex shrink-0 items-center gap-[2px] rounded-full p-[6px_8px] bg-white">
                    <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-4 h-4" alt="star">
                    <span class="font-semibold text-xs leading-[18px]">4/5</span>
                </p>
            </div>
        </div>
        <div class="swiper-gallery w-full overflow-hidden">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="relative flex items-center w-full h-[480px] shrink-0 bg-[#13181D] overflow-hidden">
                        <img src="{{ Storage::url($ticket->thumbnail) }}" class="absolute w-full h-full object-cover"
                            alt="thumbnail">
                    </div>
                </div>

                @foreach ($ticket->ticketPhotos as $ticketPhoto)
                    <div class="swiper-slide">
                        <div class="relative flex items-center w-full h-[480px] shrink-0 bg-[#13181D] overflow-hidden">
                            <img src="{{ Storage::url($ticketPhoto->photo) }}"
                                class="absolute w-full h-full object-cover" alt="thumbnail">
                        </div>
                    </div>
                @endforeach

                <div class="swiper-slide">
                    <div class="relative flex items-center w-full h-[480px] shrink-0 bg-[#13181D] overflow-hidden">
                        <div id="playBtn" class="absolute w-full h-full z-10 bg-transparent"></div>
                        <div class="plyr__video-embed" id="player" style="width: 100%; height: 100%;">
                            <iframe
                                src="{{ $ticket->video_url }}?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
                                allowfullscreen allowtransparency allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination !relative !bottom-auto flex items-center justify-center gap-[6px] py-5"></div>
        </div>
    </header>
</div>
