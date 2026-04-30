<div x-data="{ unit_open: false, unit1_open: false }">
   <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="selection" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" wire:model.live="selection" id="selection">
                            <option value="1"> {{ $lang[2] }} </option>
                            <option value="2"> {{ $lang[3] }} </option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="grid grid-cols-12 mt-3 gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="medium_v" class="font-s-14 text-blue">
                        <span>{{ $selection == '2' ? $lang['4'] . ' 1:' : $lang['4'] . ':' }}</span>
                    </label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" wire:model.live="medium_v" id="medium_v" x-on:change="if($event.target.value != '0') { $wire.set('medium_value', $event.target.value) }">
                            <option value="0">{{ $lang[5] }}</option>
                            <option value="299792.5">{{ $lang[6] }}</option>
                            <option value="299704.6">{{ $lang[7] }}</option>
                            <option value="224900.6">{{ $lang[8] }}</option>
                            <option value="220435.6">{{ $lang[9] }}</option>
                            <option value="228849">{{ $lang[10] }}</option>
                            <option value="201203">{{ $lang[11] }}</option>
                            <option value="197232">{{ $lang[12] }}</option>
                            <option value="123932.4">{{ $lang[13] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="medium_value" class="font-s-14 text-blue">{{ $lang['14'] }} (v)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" wire:model="medium_value" id="medium_value" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" x-on:focus="$wire.set('medium_v', '0')"/>
                       <label for="medium_value_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="unit_open = !unit_open">{{ $medium_value_unit }} ▾</label>
                       <div x-show="unit_open" @click.away="unit_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('medium_value_unit', 'm/s'); unit_open = false">m/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('medium_value_unit', 'km/s'); unit_open = false">km/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('medium_value_unit', 'mi/s'); unit_open = false">mi/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('medium_value_unit', 'c'); unit_open = false">c</p>
                       </div>
                    </div>
                  </div>
            </div>

            @if($selection == '2')
            <div class="grid grid-cols-12 mt-3 gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="medium_v2" class="font-s-14 text-blue">{{ $lang['4'] }} 2:</label>
                    <div class="w-100 py-2 position-relative">
                        <select class="input" wire:model.live="medium_v2" id="medium_v2" x-on:change="if($event.target.value != '0') { $wire.set('medium_value2', $event.target.value) }">
                            <option value="0">{{ $lang[5] }}</option>
                            <option value="299792.5">{{ $lang[6] }}</option>
                            <option value="299704.6">{{ $lang[7] }}</option>
                            <option value="224900.6">{{ $lang[8] }}</option>
                            <option value="220435.6">{{ $lang[9] }}</option>
                            <option value="228849">{{ $lang[10] }}</option>
                            <option value="201203">{{ $lang[11] }}</option>
                            <option value="197232">{{ $lang[12] }}</option>
                            <option value="123932.4">{{ $lang[13] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="medium_value2" class="font-s-14 text-blue">{{ $lang['14'] }} (v<sub>2</sub>)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" wire:model="medium_value2" id="medium_value2" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" placeholder="00" x-on:focus="$wire.set('medium_v2', '0')"/>
                       <label for="medium_value_unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="unit1_open = !unit1_open">{{ $medium_value_unit1 }} ▾</label>
                       <div x-show="unit1_open" @click.away="unit1_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('medium_value_unit1', 'm/s'); unit1_open = false">m/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('medium_value_unit1', 'km/s'); unit1_open = false">km/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('medium_value_unit1', 'mi/s'); unit1_open = false">mi/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('medium_value_unit1', 'c'); unit1_open = false">c</p>
                       </div>
                    </div>
                  </div>
            </div>
            @endif
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
                    @if ($selection == '1')
                    <div class="w-full text-center text-[20px]">
                        <p>{{ $lang[15] }}</p>
                        <p class="my-3"><strong class="bg-[#2845F5] px-3 py-2 rounded-lg text-white">{{ round($detail['index_of_refrection'], 6) }}</strong></p>
                    </div>
                    @else
                    <div class="w-full text-center text-[20px]">
                        <p>{{ $lang[3] }}</p>
                        <p class="my-3"><strong class="bg-[#2845F5] px-3 py-2 rounded-lg text-white">{{ round($detail['reflective_index'], 6) }}</strong></p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
</div>
