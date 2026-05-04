 <div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="car" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2 relative flex items-center">
                            <input type="number" step="any" wire:model.live="car" id="car" class="input pr-10" aria-label="input" />
                            <span class="absolute right-3 text-blue font-semibold">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="dealership" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                        <div class="w-100 py-2 relative flex items-center">
                            <input type="number" step="any" wire:model.live="dealership" id="dealership" class="input pr-10" aria-label="input" />
                            <span class="absolute right-3 text-blue font-semibold">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="taxes" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                        <div class="w-100 py-2 relative flex items-center">
                            <input type="number" step="any" wire:model.live="taxes" id="taxes" class="input pr-10" aria-label="input" />
                            <span class="absolute right-3 text-blue font-semibold">{{ $currancy }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
        <hr>
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="text-center">
                                    <p class="text-[20px]"><strong>{{ $lang['4'] }}</strong></p>
                                    <div class="flex justify-center">
                                        <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2 my-3">
                                            <strong>{{ $currancy }} {{ number_format($detail['answer'], 2) }}</strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="">
                                    <p class="text-[20px]"><strong>{{ $lang['5'] }}</strong></p>
                                    <p class="mt-2">{{ $lang['6'] }}.</p>
                                    <p class="mt-2">OTD = CV + F + T</p>
                                    <p class="mt-2">{{ $lang['7'] }}</p>
                                    <p class="mt-2">{{ $lang['8'] }}</p>
                                    <p class="mt-2">{{ $lang['9'] }}</p>
                                    <p class="mt-2">{{ $lang['10'] }}</p>
                                    <p class="mt-2">OTD = {{ number_format($detail['car'], 2) }} + {{ number_format($detail['dealership'], 2) }} + {{ number_format($detail['taxes'], 2) }}</p>
                                    <p class="mt-2">OTD = {{ number_format($detail['answer'], 2) }} {{ $currancy }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
