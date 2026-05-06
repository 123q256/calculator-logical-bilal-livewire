<div x-data="{ dropdowns: {} }">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-4 mt-3">
                    {{-- Distance Input --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="distance" class="label">{{ $lang['1'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="distance" id="distance" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['dist'] = !dropdowns['dist']">
                                <span wire:text="distance_unit">{{ $distance_unit }}</span> ▾
                            </label>
                            <div x-show="dropdowns['dist']" @click.away="dropdowns['dist'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                @foreach(['km', 'mi'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('distance_unit', '{{ $unit }}'); dropdowns['dist'] = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Average Speed Input --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="speed" class="label">{{ $lang['2'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="speed" id="speed" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['speed'] = !dropdowns['speed']">
                                <span>{{ $speed_unit == 'km' ? 'km/h' : 'mi/h' }}</span> ▾
                            </label>
                            <div x-show="dropdowns['speed']" @click.away="dropdowns['speed'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                @foreach(['km', 'mi'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('speed_unit', '{{ $unit }}'); dropdowns['speed'] = false">{{ $unit == 'km' ? 'km/h' : 'mi/h' }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Break Time --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="break_hrs" class="label cat">{{ $lang['3'] }}:</label>
                        <div class="grid grid-cols-12 gap-4 mt-3">
                            <div class="col-span-6 relative">
                                <input type="number" wire:model.live.debounce.500ms="break_hrs" id="break_hrs" class="input" />
                                <span class="input_unit text-blue">hrs</span>
                            </div>
                            <div class="col-span-6 relative">
                                <input type="number" wire:model.live.debounce.500ms="break_min" class="input" />
                                <span class="input_unit text-blue">min</span>
                            </div>
                        </div>
                    </div>

                    {{-- Departure Time --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="dep_time" class="label">{{ $lang['4'] }}:</label>
                        <div class="w-full py-2">
                            <input type="datetime-local" wire:model.live="dep_time" id="dep_time" class="input" />
                        </div>
                    </div>

                    <p class="col-span-12 font-bold text-blue-600 mt-4">{{ $lang['5'] }}</p>

                    {{-- Fuel Efficiency --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="fule_effi" class="label cat">{{ $lang['6'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="fule_effi" id="fule_effi" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['fuel'] = !dropdowns['fuel']">
                                <span>{{ $fule_effi_unit }}</span> ▾
                            </label>
                            <div x-show="dropdowns['fuel']" @click.away="dropdowns['fuel'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                @foreach(['kmpl', 'mpg'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('fule_effi_unit', '{{ $unit }}'); dropdowns['fuel'] = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Fuel Price --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="price" class="label">{{ $lang['7'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="price" id="price" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['price'] = !dropdowns['price']">
                                <span>{{ $price_unit }}</span> ▾
                            </label>
                            <div x-show="dropdowns['price']" @click.away="dropdowns['price'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                @foreach(['liter', 'gallon'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('price_unit', '{{ $currancy . ' ' . $unit }}'); dropdowns['price'] = false">{{ $currancy . ' ' . $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Number of Passengers --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="passenger" class="label">{{ $lang['8'] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" wire:model.live.debounce.500ms="passenger" id="passenger" class="input" />
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

        <div id="result-section">
            @isset($detail)
                <div wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                    <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                        <div class="rounded-lg flex items-center justify-center">
                            <div class="w-full mt-3">
                                <div class="w-full my-2">
                                    <div class="w-full lg:w-[80%] text-[18px] overflow-auto">
                                        <table class="w-full">
                                            <tr>
                                                <td class="border-b py-2" width="60%">
                                                    <strong>{{$lang[12]}}</strong> :
                                                </td>
                                                <td class="border-b py-2">{{$detail['hours']}} 
                                                    <span class="font-s-14">{{($device=='desktop') ? "Hours" : "hr" }}</span>
                                                    {{round($detail['mins'],1)}} 
                                                    <span class="font-s-14">{{($device=='desktop') ? "Minutes" : "min" }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{$lang[13]}} :</td>
                                                <td class="border-b py-2">{{$detail['depature']}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{$lang[14]}} :</td>
                                                <td class="border-b py-2">{{$detail['arrival']}}
                                                </td>
                                            </tr>
                                        </table>
                                        <p class="pt-2">
                                            <strong>{{ $lang['15'] }}</strong></p>
                                        <table class="w-full">
                                            <tr>
                                                <td width="60%" class="border-b ">{{ $lang['16'] }} :</td>
                                                <td class="border-b py-2">{{ $currancy.' '.$detail['fule_price']}}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b ">{{ $lang['17'] }} :</td>
                                                <td class="border-b py-2">{{ $currancy.' '.$detail['per_person']}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </form>
</div>
