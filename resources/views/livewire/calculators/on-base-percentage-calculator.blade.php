<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Hits (H) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="hits" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2"> 
                            <input type="number" step="any" wire:model.live.debounce.500ms="hits" id="hits" class="input" placeholder="00" />
                        </div>
                    </div>
                    {{-- Bases on Balls (BB) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="bases" class="label">{{ $lang['2'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live.debounce.500ms="bases" id="bases" class="input" placeholder="00" />
                        </div>
                    </div>
                    {{-- Hit by Pitch (HBP) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="pitch" class="label">{{ $lang['3'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live.debounce.500ms="pitch" id="pitch" class="input" placeholder="00" />
                        </div>
                    </div>
                    {{-- At Bats (AB) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="bats" class="label">{{ $lang['4'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live.debounce.500ms="bats" id="bats" class="input" placeholder="00" />
                        </div>
                    </div>
                    {{-- Sacrifice Flies (SF) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="flies" class="label">{{ $lang['5'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live.debounce.500ms="flies" id="flies" class="input" placeholder="00" />
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

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
                                    <p class="text-[20px]"><strong>{{ $lang['6'] }}</strong></p>
                                    <div class="flex justify-center">
                                        <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2 my-3">
                                            <strong>{{ round($detail['answer'], 4) }}</strong>
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-[20px]"><strong>{{ $lang['7'] }}</strong></p>
                                    <p class="mt-2">{{ $lang['8'] }}.</p>
                                    <p class="mt-2">OBP = (H + BB + HBP) / (AB + BB + HBP + SF)</p>
                                    <p class="mt-2">{{ $lang['9'] }}</p>
                                    <p class="mt-2">{{ $lang['10'] }}</p>
                                    <p class="mt-2">{{ $lang['11'] }}</p>
                                    <p class="mt-2">{{ $lang['12'] }}</p>
                                    <p class="mt-2">{{ $lang['13'] }}</p>
                                    <p class="mt-2">{{ $lang['14'] }}</p>
                                    <p class="mt-2">OBP = ({{ $hits }} + {{ $bases }} + {{ $pitch }}) / ({{ $bats }} + {{ $bases }} + {{ $pitch }} + {{ $flies }})</p>
                                    <p class="mt-2">OTD = {{ round($detail['answer'], 4) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
