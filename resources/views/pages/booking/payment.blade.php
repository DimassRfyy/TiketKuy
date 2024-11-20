<x-app-layout>
    <x-slot:title>
        Ticket Payment
    </x-slot>

    {{-- Header --}}
    <x-headers.payment-create-header :ticket="$data['ticket']" />
    {{-- End --}}

    <form action="{{ route('booking.payment-store') }}" method="POST" enctype="multipart/form-data"
        class="relative flex flex-col w-full px-4 gap-[18px] mt-5 pb-[30px] overflow-x-hidden">
        @csrf

        <div class="flex items-center justify-between rounded-3xl p-[6px] pr-[14px] bg-white overflow-hidden">
            <div class="flex items-center gap-[14px]">
                <div class="flex w-[90px] h-[90px] shrink-0 rounded-3xl bg-[#D9D9D9] overflow-hidden">
                    <img src="{{ Storage::url($data['ticket']->thumbnail) }}" class="w-full h-full object-cover"
                        alt="thumbnail">
                </div>
                <div class="flex flex-col gap-[6px]">
                    <h3 class="font-semibold">{{ $data['ticket']->name }}</h3>
                    <div class="flex items-center gap-1">
                        <img src="{{ asset('assets/images/icons/location.svg') }}" class="w-[18px] h-[18px]"
                            alt="icon">
                        <p class="font-semibold text-xs leading-[18px]">{{ $data['ticket']->city->name }}</p>
                    </div>
                    <p class="font-bold text-sm leading-[21px] text-[#F97316]">Rp
                        {{ number_format($data['ticket']->price, 0, ',', '.') }}</p>
                </div>
            </div>
            <p class="w-fit flex shrink-0 items-center gap-[2px] rounded-full p-[6px_8px] bg-[#FFE5D3]">
                <img src="{{ asset('assets/images/icons/Star 1.svg') }}" class="w-4 h-4" alt="star">
                <span class="font-semibold text-xs leading-[18px] text-[#F97316]">4/5</span>
            </p>
        </div>

        <div class="flex flex-col rounded-[30px] p-5 gap-[14px] bg-white">
            <div class="flex items-center justify-between">
                <p class="font-semibold text-sm leading-[21px]">Total People</p>
                <p class="font-semibold text-sm leading-[21px]">{{ $data['booking']['total_participant'] }} Participant
                </p>
            </div>
            <div class="flex items-center justify-between">
                <p class="font-semibold text-sm leading-[21px]">Sub Total</p>
                <p class="font-semibold text-sm leading-[21px]">Rp
                    {{ number_format($data['booking']['sub_total'], 0, ',', '.') }}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="font-semibold text-sm leading-[21px]">Tax 11%</p>
                <p class="font-semibold text-sm leading-[21px]">Rp
                    {{ number_format($data['booking']['tax_amount'], 0, ',', '.') }}</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="font-semibold text-sm leading-[21px]">Discount 0%</p>
                <p class="font-semibold text-sm leading-[21px]">Rp 0</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="font-semibold text-sm leading-[21px]">Insurance</p>
                <p class="font-semibold text-sm leading-[21px]">Included 100%</p>
            </div>
            <div class="flex items-center justify-between">
                <p class="font-semibold text-sm leading-[21px]">Total</p>
                <p class="font-bold text-[22px] leading-[33px] text-[#F97316]">Rp
                    {{ number_format($data['booking']['total'], 0, ',', '.') }}</p>
            </div>
        </div>

        <div class="flex flex-col rounded-[30px] p-5 gap-6 bg-white">
            <div class="flex flex-col gap-[6px]">
                <p class="font-semibold text-sm leading-[21px]">Payment Method</p>
                <div class="grid grid-cols-2 gap-[10px]">
                    <label for="transfer" class="relative group">
                        <div
                            class="flex items-center h-full rounded-full p-[14px_12px] gap-[6px] bg-[#F8F8F9] transition-all duration-300 group-has-[:checked]:ring-1 group-has-[:checked]:ring-[#F97316]">
                            <img src="{{ asset('assets/images/icons/security-card-black.svg') }}" class="w-6 h-6"
                                alt="icon">
                            <p class="font-semibold text-sm leading-[21px]">Transfer Bank</p>
                        </div>
                        <input type="radio" name="payment_method" id="transfer" value="transfer"
                            class="absolute top-1/2 left-1/2 -z-10" checked>
                    </label>

                    <label for="credit" class="relative group">
                        <div
                            class="flex items-center h-full rounded-full p-[14px_12px] gap-[6px] bg-[#F8F8F9] transition-all duration-300 group-has-[:checked]:ring-1 group-has-[:checked]:ring-[#F97316]">
                            <img src="{{ asset('assets/images/icons/cards.svg') }}" class="w-6 h-6" alt="icon">
                            <p class="font-semibold text-sm leading-[21px]">Credit Card</p>
                        </div>
                        <input type="radio" name="payment_method" id="credit" value="credit_card"
                            class="absolute top-1/2 left-1/2 -z-10">
                    </label>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="h-[50px] w-[71px] overflow-hidden">
                    <img src="{{ asset('assets/images/logos/bca.svg') }}" class="h-full w-full object-contain"
                        alt="bank logo">
                </div>
                <div>
                    <p class="font-semibold">JuaraTiket Indonesia</p>
                    <p>8008129839</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="h-[50px] w-[71px] overflow-hidden">
                    <img src="{{ asset('assets/images/logos/mandiri.svg') }}" class="h-full w-full object-contain"
                        alt="bank logo">
                </div>
                <div>
                    <p class="font-semibold">JuaraTiket Indonesia</p>
                    <p>12379834983281</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col rounded-[30px] p-5 gap-6 bg-white">
            <p class="font-semibold text-sm leading-[21px]">Payment Proof</p>
            <div
                class="group w-full rounded-full px-5 flex items-center gap-[10px] bg-[#F8F8F9] relative transition-all duration-300 ">
                <div class="w-6 h-6 flex shrink-0">
                    <img src="{{ asset('assets/images/icons/receipt-2.svg') }}" alt="icon">
                </div>
                <button type="button" id="Upload-btn"
                    class="appearance-none outline-none w-full py-[14px] text-left text-sm leading-[21px] overflow-hidden"
                    onclick="document.getElementById('payment-proof').click()">
                    Upload file
                </button>
                <img src="{{ asset('assets/images/icons/verify.svg') }}" class="w-6 h-6 flex shrink-0" alt="icon">
                <input type="file" name="payment_proof" id="payment-proof" class="absolute -z-10 opacity-0" required>
            </div>

            <button type="submit"
                class="flex items-center justify-between p-1 pl-5 w-full gap-4 rounded-full bg-[#13181D]">
                <p class="font-bold text-white">Confirm My Payment</p>
                <img src="{{ asset('assets/images/icons/card-tick.svg') }}" class="w-[50px] h-[50px]"
                    alt="icon">
            </button>
        </div>
    </form>

    @push('scripts')
        <script src="{{ asset('js/payment.js') }}"></script>
    @endpush
</x-app-layout>
