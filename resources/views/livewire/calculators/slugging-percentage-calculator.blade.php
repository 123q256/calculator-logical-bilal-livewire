<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="singles" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" wire:model.live.debounce.500ms="singles" step="any" id="singles" class="input" placeholder="0" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="doubles" class="label">{{ $lang['2'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" wire:model.live.debounce.500ms="doubles" step="any" id="doubles" class="input" placeholder="0" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="triples" class="label">{{ $lang['3'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" wire:model.live.debounce.500ms="triples" step="any" id="triples" class="input" placeholder="0" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="home" class="label">{{ $lang['4'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" wire:model.live.debounce.500ms="home" step="any" id="home" class="input" placeholder="0" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="bats" class="label">{{ $lang['5'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" wire:model.live.debounce.500ms="bats" step="any" id="bats" class="input" placeholder="0" />
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
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="text-center">
                                    <p class="font-s-20"><strong>{{ $lang['6'] }}</strong></p>
                                    <div class="flex justify-center">
                                        <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2 my-3"><strong class="text-blue">{{ round($detail['answer'], 4) }} %</strong></p>
                                    </div>
                                </div>
                                <div class="">
                                    <p class="font-s-20"><strong>{{ $lang[7] }}</strong></p>
                                    <p class="mt-2 text-gray-700">{{ $lang[8] }}.</p>
                                    <p class="mt-2">{{ $lang['6'] }} = ({{ $lang['1'] }} + 2 x {{ $lang['2'] }} + 3 x {{ $lang['3'] }} + 4 x {{ $lang['4'] }}) / {{ $lang['5'] }}</p>
                                    <p class="mt-2">{{ $lang['6'] }} = ({{ $detail['singles'] }} + 2 x {{ $detail['doubles'] }} + 3 x {{ $detail['triples'] }} + 4 x {{ $detail['home'] }}) / {{ $detail['bats'] }}</p>
                                    <p class="mt-2">{{ $lang['6'] }} = {{ round($detail['answer'], 4) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
