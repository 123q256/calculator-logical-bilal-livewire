<div x-data="{ dropdowns: {} }">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[80%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mt-3">
                    {{-- Volume --}}
                    <div class="w-full">
                        <label for="volume" class="label">{{ $lang['1'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="volume" id="volume" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['vol_unit'] = !dropdowns['vol_unit']">
                                {{ $vol_unit }} ▾
                            </label>
                            <div x-show="dropdowns['vol_unit']" @click.away="dropdowns['vol_unit'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl max-h-72 overflow-y-auto" x-cloak>
                                @foreach (['mm³', 'cm³', 'dm³', 'm³', 'cu in', 'cu ft', 'cu yd', 'ml', 'cl', 'liters', 'US gal', 'UK gal', 'US fl oz', 'UK fl oz', 'cups', 'tbsp', 'tsp', 'US qt', 'UK qt', 'US pt', 'UK pt'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('vol_unit', '{{ $unit }}'); dropdowns['vol_unit'] = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Time --}}
                    <div class="w-full">
                        <label for="time" class="label">{{ $lang['2'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="time" id="time" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['time_unit'] = !dropdowns['time_unit']">
                                {{ $time_unit }} ▾
                            </label>
                            <div x-show="dropdowns['time_unit']" @click.away="dropdowns['time_unit'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl" x-cloak>
                                @foreach (['sec', 'min', 'hrs', 'days', 'wks', 'mos', 'yrs'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('time_unit', '{{ $unit }}'); dropdowns['time_unit'] = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Answer Unit --}}
                    <div class="w-full md:col-span-2">
                        <label for="ans_unit" class="label">{{ $lang['4'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="ans_unit" id="ans_unit" class="input">
                                @php
                                    $units = [
                                        "US gal/s" => "1", "US gal/min" => "2", "US gal/h" => "3", "US gal/day" => "4",
                                        "UK gal/s" => "5", "UK gal/min" => "6", "UK gal/h" => "7", "UK gal/day" => "8",
                                        "ft³/s" => "9", "ft³/min" => "10", "ft³/h" => "11", "ft³/day" => "12",
                                        "mm³/s" => "13", "m³/s" => "14", "m³/min" => "15", "m³/h" => "16", "m³/day" => "17",
                                        "L/s" => "18", "L/min" => "19", "L/h" => "20", "L/day" => "21",
                                        "ml/min" => "22", "ml/h" => "23",
                                        "US fl oz / min" => "24", "US fl oz / h" => "25",
                                        "UK fl oz / min" => "26", "UK fl oz / h" => "27",
                                        "US pt / min" => "28", "US pt / h" => "29",
                                        "UK pt / min" => "30", "UK pt / h" => "31"
                                    ];
                                @endphp
                                @foreach($units as $name => $val)
                                    <option value="{{ $val }}">{{ $name }}</option>
                                @endforeach
                            </select>
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
                     <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                        <div class="flex justify-center mt-3">
                            <div class="text-center">
                                <p class="text-lg font-semibold px-3">{{ $lang['4']}}</p>
                                <p class="lg:text-4xl md:text-4xl px-3 py-2 bg-[#2845F5] text-white inline-block rounded-lg my-3">
                                    <strong class="text-blue">{{ round($detail['main_ans'], 6) }}</strong>
                                    <span class="text-base">{{ $detail['answer_unit'] }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                </div>
                </div>
            </div>
        @endisset
    </form>
</div>
