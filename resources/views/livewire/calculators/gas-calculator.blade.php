<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="flex items-center justify-center my-4 gap-6">
                    <div class="flex items-center gap-2">
                        <input type="radio" wire:model.live="calc_mode" id="first" value="first" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 cursor-pointer">
                        <label for="first" class="label cursor-pointer">{{ $lang['2'] }}</label>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="radio" wire:model.live="calc_mode" id="second" value="second" class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 cursor-pointer">
                        <label for="second" class="label cursor-pointer">{{ $lang['3'] }}</label>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 mt-3 gap-6">
                    {{-- Trip Type --}}
                    <div>
                        <label for="trip_type" class="label">{{ $lang['4'] }}</label>
                        <div class="w-full py-2">
                            <select wire:model.live="trip_type" id="trip_type" class="input">
                                <option value="1">{{$lang[5]}}</option>
                                <option value="2">{{$lang[6]}}</option>
                                <option value="3">{{$lang[7]}}</option>
                                <option value="4">{{$lang[8]}}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Distance --}}
                    <div>
                        <label for="distance" class="label">{{ $lang['9'] }}</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : 'z-10'">
                            <input type="number" step="any" wire:model.live="distance" id="distance" class="input pr-20" />
                            <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer flex items-center gap-1 text-blue">
                                    {{ $distance_unit }} ▾
                                </button>
                                <div x-show="open" x-cloak @click.away="open = false" 
                                     class="absolute z-[100] bg-white border border-gray-300 rounded shadow-2xl right-0 top-full mt-2 min-w-[80px] overflow-hidden">
                                    @foreach (["km","mi"] as $u)
                                        <div @click="$wire.set('distance_unit', '{{ $u }}'); open = false" 
                                             class="p-2 hover:bg-blue-50 hover:text-blue-600 cursor-pointer text-sm text-center border-b last:border-0 bg-white transition-colors duration-150">
                                            {{ $u }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Days of Week --}}
                    <div>
                        <label for="week_day" class="label">{{ $lang['10'] }}</label>
                        <div class="w-full py-2">                                  
                            <input type="number" step="any" wire:model.live="week_day" id="week_day" class="input" />
                        </div>
                    </div>

                    {{-- Gas Price --}}
                    <div>
                        <label for="price" class="label">{{ $lang['12'] }}</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : 'z-10'">
                            <input type="number" step="any" wire:model.live="price" id="price" class="input pr-28" />
                            <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer flex items-center gap-1 text-blue">
                                    {{ $price_unit }} ▾
                                </button>
                                <div x-show="open" x-cloak @click.away="open = false" 
                                     class="absolute z-[100] bg-white border border-gray-300 rounded shadow-2xl right-0 top-full mt-2 min-w-[120px] overflow-hidden">
                                    @foreach ([$currancy.' '.$lang['14'], $currancy.' '.$lang['15']] as $u)
                                        <div @click="$wire.set('price_unit', '{{ $u }}'); open = false" 
                                             class="p-2 hover:bg-blue-50 hover:text-blue-600 cursor-pointer text-sm text-center border-b last:border-0 bg-white transition-colors duration-150">
                                            {{ $u }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- People (Mode 1 Only) --}}
                    @if($calc_mode === 'first')
                        <div>
                            <label for="peoples" class="label">{{ $lang['16'] }} ({{ $lang['17'] }})</label>
                            <div class="w-full py-2">                                  
                                <input type="number" step="any" wire:model.live="peoples" id="peoples" class="input" />
                            </div>
                        </div>
                    @endif

                    <div class="col-span-1 md:col-span-2">
                        <p class="font-bold text-blue border-b pb-2">
                            {{ $calc_mode === 'second' ? $lang[38] : $lang[18] }}
                        </p>
                    </div>

                    {{-- Vehicle 1 Name --}}
                    <div>
                        <label for="name_v1" class="label">{{ $lang['19'] }} </label>
                        <div class="w-full py-2">                                  
                            <input type="text" wire:model.live="name_v1" id="name_v1" class="input" />
                        </div>
                    </div>

                    {{-- Vehicle 1 Fuel Efficiency --}}
                    <div>
                        <label for="fule_effi_v1" class="label">{{ $lang['20'] }}</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-40' : 'z-0'">
                            <input type="number" step="any" wire:model.live="fule_effi_v1" id="fule_effi_v1" class="input pr-20" />
                            <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer flex items-center gap-1 text-blue">
                                    {{ $fule_effi_v1_unit }} ▾
                                </button>
                                <div x-show="open" x-cloak @click.away="open = false" 
                                     class="absolute z-[100] bg-white border border-gray-300 rounded shadow-2xl right-0 top-full mt-2 min-w-[80px] overflow-hidden">
                                    @foreach (["kmpl","mpg"] as $u)
                                        <div @click="$wire.set('fule_effi_v1_unit', '{{ $u }}'); open = false" 
                                             class="p-2 hover:bg-blue-50 hover:text-blue-600 cursor-pointer text-sm text-center border-b last:border-0 bg-white transition-colors duration-150">
                                            {{ $u }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Vehicle 2 (Mode 2 Only) --}}
                    @if($calc_mode === 'second')
                        <div class="col-span-1 md:col-span-2">
                            <p class="font-bold text-blue border-b pb-2">{{$lang[21]}}</p>
                        </div>
                        <div>
                            <label for="name_v2" class="label">{{ $lang['19'] }} </label>
                            <div class="w-full py-2">                                  
                                <input type="text" wire:model.live="name_v2" id="name_v2" class="input" />
                            </div>
                        </div>
                        <div>
                            <label for="fule_effi_v2" class="label">{{ $lang['20'] }}</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-30' : 'z-0'">
                                <input type="number" step="any" wire:model.live="fule_effi_v2" id="fule_effi_v2" class="input pr-20" />
                                <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                    <button type="button" @click="open = !open" class="text-sm underline cursor-pointer flex items-center gap-1 text-blue">
                                        {{ $fule_effi_v2_unit }} ▾
                                    </button>
                                    <div x-show="open" x-cloak @click.away="open = false" 
                                         class="absolute z-[100] bg-white border border-gray-300 rounded shadow-2xl right-0 top-full mt-2 min-w-[80px] overflow-hidden">
                                        @foreach (["kmpl","mpg"] as $u)
                                            <div @click="$wire.set('fule_effi_v2_unit', '{{ $u }}'); open = false" 
                                                 class="p-2 hover:bg-blue-50 hover:text-blue-600 cursor-pointer text-sm text-center border-b last:border-0 bg-white transition-colors duration-150">
                                                {{ $u }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
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
                                @if($calc_mode == 'first')
                                    <p>
                                        {{$lang[22]}}
                                        <strong>
                                            {{$detail['fule_req'] }} {{ ($distance_unit == "km") ? " $lang[14]" : " $lang[15]" }},
                                        </strong> 
                                        {{$lang[23]}}
                                        <strong>{{$currancy.' '. $detail['fule_price_daily']}}</strong>
                                    </p>
                                    @if(!empty($peoples))
                                        <p class="mt-1">{{$lang[24]}}
                                            <strong>{{$currancy.' '.$detail['each_pay']}}</strong>
                                        </p>
                                    @endif
                                    <div class="w-full lg:w-[80%] text-[18px] overflow-auto">
                                        <table class="w-full"> 
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang[27]}}</strong></td>
                                                <td class="border-b py-2"><strong>{{$lang[25]}}</strong></td>
                                                <td class="border-b py-2"><strong>{{$lang[26]}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{$lang[28]}}</td>
                                                <td class="border-b py-2">{{ $detail['fule_req']  }} {{  ($distance_unit == "km") ? " $lang[14]" : " $lang[15]" }}</td>
                                                <td class="border-b py-2">{{ $detail['fule_price_daily'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{$lang[29]}}</td>
                                                <td class="border-b py-2">{{ $detail['fule_req_weekly']  }} {{  ($distance_unit == "km") ? " $lang[14]" : " $lang[15]" }}</td>
                                                <td class="border-b py-2">{{ $detail['fule_price_weekly'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{$lang[30]}}</td>
                                                <td class="border-b py-2">{{ $detail['fule_req_biweekly']  }} {{  ($distance_unit == "km") ? " $lang[14]" : " $lang[15]" }}</td>
                                                <td class="border-b py-2">{{ $detail['fule_price_biweekly'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{$lang[31]}}</td>
                                                <td class="border-b py-2">{{ $detail['fule_req_monthly']  }} {{  ($distance_unit == "km") ? " $lang[14]" : " $lang[15]" }}</td>
                                                <td class="border-b py-2">{{ $detail['fule_price_monthly'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{$lang[32]}}</td>
                                                <td class="border-b py-2">{{ $detail['fule_req_yearly']  }} {{  ($distance_unit == "km") ? " $lang[14]" : " $lang[15]" }}</td>
                                                <td class="border-b py-2">{{ $detail['fule_price_yearly'] }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @else
                                    <div class="flex">
                                        <div class="col-lg-4 border-lg-end">
                                            <p>{{$lang[35]}}</p>
                                            <p><strong class="text-green font-s-21">{{$detail['weekly_saving']}}</strong></p>
                                        </div>
                                        <div class="col-lg-4 ps-lg-4 border-lg-end">
                                            <p>{{$lang[36]}}</p>
                                            <p><strong class="text-green font-s-21">{{$detail['monthly_saving']}}</strong></p>
                                        </div>
                                        <div class="col-lg-4 ps-lg-4">
                                            <p>{{$lang[37]}}</p>
                                            <p><strong class="text-green font-s-21">{{$detail['yearly_saving']}}</strong></p>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-[80%] text-[18px] mt-lg-3 overflow-auto">
                                        <table class="w-full">
                                            <tr>
                                                <td class="border-b py-2"><strong>{{$lang[27]}}</strong></td>
                                                <td class="border-b py-2"><strong>{{$name_v1}}</strong></td>
                                                <td class="border-b py-2"><strong>{{$name_v2}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><p class="left-align">{{$lang[33]}}</p></td>
                                                <td class="border-b py-2">{{ $detail['fule_req_v1']  }} {{  ($distance_unit == "km") ? " $lang[14]" : " $lang[15]" }}</td>
                                                <td class="border-b py-2">{{ $detail['fule_req_v2']  }} {{  ($distance_unit == "km") ? " $lang[14]" : " $lang[15]" }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2"><p class="left-align">{{$lang[34]}}</p></td>
                                                <td class="border-b py-2">{{ $detail['price_price_v1'] }}</td>
                                                <td class="border-b py-2">{{ $detail['price_price_v2'] }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
