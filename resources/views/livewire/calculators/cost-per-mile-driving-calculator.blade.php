<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[80%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-3">
                    {{-- Cost of Gas --}}
                    <div class="w-full md:col-span-2">
                        <label for="cost_of_gas" class="label">{{ $lang['1'] }} ({{ $currancy }}/{{ $lang['2'] }}):</label>
                        <div class="w-full py-2">
                            <input type="number" wire:model.live.debounce.500ms="cost_of_gas" id="cost_of_gas" step="any" class="input" placeholder="0.00" />
                        </div>
                    </div>

                    {{-- Miles per Gallon --}}
                    <div class="w-full">
                        <label for="miles_per_gallon" class="label">{{ $lang['3'] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" wire:model.live.debounce.500ms="miles_per_gallon" id="miles_per_gallon" step="any" class="input" placeholder="00" />
                        </div>
                    </div>

                    {{-- Car Value --}}
                    <div class="w-full">
                        <label for="car_value" class="label">{{ $lang['4'] }} ({{ $currancy }}):</label>
                        <div class="w-full py-2">
                            <input type="number" wire:model.live.debounce.500ms="car_value" id="car_value" step="any" class="input" placeholder="00" />
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
            <div class="rounded-lg">
                <div class="col-span-12 mt-3">
                    <div class="w-full my-2">
                        <div>
                            <p class="text-[20px] text-center"><strong>{{$lang['5']}}</strong></p>
                            <div class="flex justify-center">
                            <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue">{{round($detail['answer'], 7) }}<span class="text-[20px]"> {{$currancy}}</span></strong></p>
                            </div>
                            <div class="col-12">
                                <p class="text-[20px]"><strong>{{ $lang[6]}}</strong></p>
                                <p class="mt-2">{{ $lang[7] }}</p>
                                <p class="mt-2">{{ $lang[8] }}.</p>
                                <p class="mt-2">{{ $lang[5] }} = {{ $lang[1]}}/ {{ $lang[3]}} + ({{$lang[4]}} /25000*0.03) + 0.05 </p>
                                <p class="mt-2">{{ $lang[9] }}</p>
                                <p class="mt-2">{{ $lang[5] }} = <?php echo $cost_of_gas; ?>/ <?php echo $miles_per_gallon; ?>+(<?php echo $car_value; ?>/25000*0.03) + 0.05</p>
                                <p class="mt-2">{{ $lang[5] }} = <?php echo $cost_of_gas; ?>/ <?php echo $miles_per_gallon; ?>+{{ ($detail['car_value'] *0.03) + 0.05 }}</p>
                                <p class="mt-2">{{ $lang[5] }} = <?php echo $cost_of_gas; ?>/ <?php echo $miles_per_gallon; ?>+{{ ($detail['total_car_value']) + 0.05 }}</p>
                                <p class="mt-2">{{ $lang[5] }} = {{ $detail['total_cost_mile'] }} +{{ $detail['total_car_value'] }} + 0.05</p>
                                <p class="mt-2">{{ $lang[5] }} = {{ $detail['answer'] }} {{$currancy}}</p>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        @endisset
    </form>
</div>
