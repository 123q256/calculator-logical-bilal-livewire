<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[80%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-1 gap-6 mt-3">
                    {{-- Bill Amount --}}
                    <div class="w-full">
                        <label for="bill_amount" class="label">{{ $lang['1'] }}:</label>
                        <div class="relative w-full mt-2"> 
                            <input type="number" step="any" wire:model.live.debounce.500ms="bill_amount" id="bill_amount" class="input pr-12" placeholder="00" />
                            <span class="absolute right-4 top-3 font-bold">{{ $currancy }}</span>
                        </div>
                    </div>
                    {{-- Split Ways --}}
                    <div class="w-full">
                        <label for="split" class="label">{{ $lang['2'] }}:</label>
                        <div class="w-full mt-2">
                            <input type="number" step="any" wire:model.live.debounce.500ms="split" id="split" class="input" placeholder="00" />
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-8 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="col-12 bg-light-blue p-3 radius-10 mt-3 w-full">
                            <div class="w-full">
                                <div class="text-center">
                                    <p class="text-[20px]"><strong>{{ $lang['3'] }}</strong></p>
                                    <div class="flex justify-center">
                                        <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2 my-3">
                                            <strong class="text-blue">{{ $currancy }} {{ round($detail['answer'], 7) }}</strong>
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-[20px]"><strong>{{ $lang[4] }}</strong></p>
                                    <p class="mt-2">{{ $lang[5] }}.</p>
                                    <p class="mt-2">{{ $lang[3] }} = {{ $lang[1] }}({{ $currancy }}) / {{ $lang[2] }}</p>
                                    <p class="mt-2">{{ $lang[3] }} = {{ $bill_amount }} ({{ $currancy }}) / {{ $split }}</p>
                                    <p class="mt-2">{{ $lang[3] }} = {{ $detail['answer'] }} {{ $currancy }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
