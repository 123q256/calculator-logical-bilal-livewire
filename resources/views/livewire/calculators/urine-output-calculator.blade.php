<div>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="weight" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="weight" id="weight" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $weight_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('weight_unit', 'g'); open = false">grams (g)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('weight_unit', 'dag'); open = false">decagrams (dag)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('weight_unit', 'kg'); open = false">kilograms (kg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('weight_unit', 'oz'); open = false">ounces (oz)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('weight_unit', 'lbs'); open = false">pounds (lbs)</p>
                        </div>
                     </div>
                </div>

                <!-- FT IN logic for time -->
                <template x-if="['min/sec', 'hrs/min'].includes($wire.time_unit)">
                    <div class="col-span-12 grid grid-cols-2 gap-4">
                        <div>
                            <label class="font-s-14 text-blue" x-text="$wire.time_unit === 'min/sec' ? 'min' : 'hrs'"></label>
                            <input type="number" step="any" wire:model.live="time_min" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                        </div>
                        <div class="relative" x-data="{ open: false }">
                            <label class="font-s-14 text-blue" x-text="$wire.time_unit === 'min/sec' ? 'sec' : 'min'"></label>
                            <input type="number" step="any" wire:model.live="time_sec" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-10" @click="open = !open" x-text="$wire.time_unit + ' ▾'"></label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach(['sec', 'min', 'hrs', 'day', 'min/sec', 'hrs/min'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('time_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </template>

                <template x-if="!['min/sec', 'hrs/min'].includes($wire.time_unit)">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="time" class="font-s-14 text-blue">{{ $lang['2'] }} <span class="text-blue" x-text="'(' + $wire.time_unit + ')'"></span>:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="time" id="time" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="$wire.time_unit + ' ▾'"></label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach(['sec', 'min', 'hrs', 'day', 'min/sec', 'hrs/min'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('time_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </template>

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="urine" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="urine" id="urine" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $urine_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(["mm³", "cm³", "dm³", "cu in", "ml", "cl", "liters", "us gal", "uk gal", "us fl oz", "uk fl oz"] as $unit)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('urine_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="fluid" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="fluid" id="fluid" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00" />
                        <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $fluid_unit }} ▾</label>
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                            @foreach(["mm³", "cm³", "dm³", "cu in", "ml", "cl", "liters", "us gal", "uk gal", "us fl oz", "uk fl oz"] as $unit)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('fluid_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="output_unit" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="output_unit" id="output_unit" class="input">
                            @foreach(["g", "dag", "kg", "oz", "lbs"] as $unit)
                                <option value="{{ $unit }}">{{ $unit }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="balance_unit" class="font-s-14 text-blue">{!! $lang['6'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select wire:model.live="balance_unit" id="balance_unit" class="input">
                            @foreach(["mm³", "cm³", "dm³", "cu in", "ml", "cl", "liters", "us gal", "uk gal", "us fl oz", "uk fl oz"] as $unit)
                                <option value="{{ $unit }}">{{ $unit }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
        </div>
    </div>
     @if ($type == 'calculator')
     @include('inc.button')
    @endif
    @if ($type=='widget')
    @include('inc.widget-button')
     @endif
 </div>        


    @isset($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                 @endif
                <div class="rounded-lg  flex items-center justify-center">
                    
                    <div class="w-full  mt-3">
                        <div class="w-full mt-2">
                            <div class="w-full border-b pb-3">
                                <div class="grid grid-cols-12 gap-2">
                                    <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                        <p><strong>{{ $lang['7'] }}:</strong></p>
                                        <p>
                                            <strong class="text-green-500 text-[30px]">{{ round($detail['answer'], 4) }}</strong>
                                            <span class="text-blue-500 text-[18px]">(ml/{{ $output_unit }}/hr)</span>
                                        </p>
                                    </div>
                                    <div class="col-span-1 border-r hidden md:block lg:block">&nbsp;</div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <p><strong>{{ $lang['8'] }}:</strong></p>
                                        <p>
                                            <strong class="text-green-500 text-[30px]">{{ round($detail['sec_answer'], 4)  }}</strong>
                                            <span class="text-blue-500 text-[18px]">({{ $balance_unit }})</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-3 ">
                                <p class="text-[18px]"><strong>{{ $lang['9'] }}:</strong></p>
                                <p><strong>{{ $lang['10'] }}.</strong></p>
                                <p>{{ $lang['11'] }} = {{ $lang['3'] }} / ({{ $lang['1'] }} × {{ $lang['2'] }})</p>
                                <p>{{ $lang['11'] }} = {{ $urine }} / ({{ $weight }} × {{ $detail['time_ans'] }})</p>
                                <p>{{ $lang['11'] }} = {{ round($detail['answer'], 4) }}</p>
                                <p class="mt-2"><strong>{{ $lang['12'] }}.</strong></p>
                                <p>{{ $lang['8'] }} = {{ $lang['4'] }} - {{ $lang['3'] }}</p>
                                <p>{{ $lang['8'] }} = {{ $urine }} - {{ $fluid }}</p>
                                <p>{{ $lang['8'] }} = {{ round($detail['sec_answer'], 4) }}</p>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    @endisset
</form>
</div>
