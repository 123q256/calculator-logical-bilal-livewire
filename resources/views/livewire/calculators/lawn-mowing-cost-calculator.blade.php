<div x-data="{ dropdowns: {} }">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    {{-- Calculation Type --}}
                    <div class="col-span-12">
                        <label for="calc_type" class="label">{{ $lang['1'] }}</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="calc_type" id="calc_type" class="input">
                                <option value="lawn_mowed">{{ $lang['2'] }}</option>
                                <option value="mowing_time">{{ $lang['3'] }}</option>
                            </select>
                        </div>
                    </div>

                    @if ($calc_type == 'lawn_mowed')
                        {{-- Charges Type --}}
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="charges" class="label">{{ $lang['4'] }}</label>
                            <div class="w-100 py-2">
                                <select wire:model.live="charges" id="charges" class="input">
                                    <option value="area">{{ $lang['5'] }}</option>
                                    <option value="hour">{{ $lang['6'] }}</option>
                                </select>
                            </div>
                        </div>

                        {{-- Mow Price --}}
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="mow_price" class="label">{{ $lang['7'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live.debounce.500ms="mow_price" id="mow_price" step="any" min="0" class="input" placeholder="00" />
                                
                                @if ($charges == 'hour')
                                    <span class="absolute text-sm right-6 top-4  font-bold">{{ $currancy }}/h</span>
                                @else
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['m_p_units'] = !dropdowns['m_p_units']">
                                        {{ $m_p_units }} ▾
                                    </label>
                                    <div x-show="dropdowns['m_p_units']" @click.away="dropdowns['m_p_units'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl" x-cloak>
                                        @foreach (["$currancy m²","$currancy km²", "$currancy ft²", "$currancy yd²","$currancy a","$currancy da","$currancy ha","$currancy ac"] as $name)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('m_p_units', '{{ $name }}'); dropdowns['m_p_units'] = false"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if ($charges == 'area')
                            {{-- Area to Mow --}}
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="area_mow" class="label">{{ $lang['8'] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model.live.debounce.500ms="area_mow" id="area_mow" step="any" class="input" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['a_m_units'] = !dropdowns['a_m_units']">
                                        {{ $a_m_units }} ▾
                                    </label>
                                    <div x-show="dropdowns['a_m_units']" @click.away="dropdowns['a_m_units'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl" x-cloak>
                                        @foreach (["m²","km²", "ft²", "yd²","a","da","ha","ac"] as $name)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('a_m_units', '{{ $name }}'); dropdowns['a_m_units'] = false"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- Hours of Work --}}
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="hours_work" class="label">{{ $lang['9'] }}:</label>
                                <div class="w-100 py-2">
                                    <input type="number" step="any" wire:model.live.debounce.500ms="hours_work" id="hours_work" class="input" placeholder="00" />
                                </div>
                            </div>
                        @endif
                    @endif

                    @if ($calc_type == 'mowing_time')
                        {{-- Mowing Speed --}}
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="mow_speed" class="label">{{ $lang['10'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live.debounce.500ms="mow_speed" id="mow_speed" step="any" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['mow_speed_units'] = !dropdowns['mow_speed_units']">
                                    {{ $mow_speed_units }} ▾
                                </label>
                                <div x-show="dropdowns['mow_speed_units']" @click.away="dropdowns['mow_speed_units'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl" x-cloak>
                                    @foreach (["km/h","m/h", "ft/h"] as $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('mow_speed_units', '{{ $name }}'); dropdowns['mow_speed_units'] = false"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Mower Width --}}
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="mow_width" class="label">{{ $lang['11'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live.debounce.500ms="mow_width" id="mow_width" step="any" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['mow_width_units'] = !dropdowns['mow_width_units']">
                                    {{ $mow_width_units }} ▾
                                </label>
                                <div x-show="dropdowns['mow_width_units']" @click.away="dropdowns['mow_width_units'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl" x-cloak>
                                    @foreach (["cm","m", "km","in","ft"] as $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('mow_width_units', '{{ $name }}'); dropdowns['mow_width_units'] = false"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Efficiency --}}
                        <div class="col-span-12">
                            <label for="mow_pro" class="label">{{ $lang['12'] }}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live.debounce.500ms="mow_pro" id="mow_pro" class="input" placeholder="80" />
                                <span class="absolute text-sm right-6 top-6  font-bold">%</span>
                            </div>
                        </div>

                        {{-- Area to Mow (Time Calc) --}}
                        <div class="col-span-12">
                            <p class="text-sm text-gray-600 mb-1">{{ $lang['13'] }} ({{ $lang['14'] }})</p>
                            <label for="to_mow" class="label">{{ $lang['15'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live.debounce.500ms="to_mow" id="to_mow" step="any" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['to_mow_units'] = !dropdowns['to_mow_units']">
                                    {{ $to_mow_units }} ▾
                                </label>
                                <div x-show="dropdowns['to_mow_units']" @click.away="dropdowns['to_mow_units'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl" x-cloak>
                                    @foreach (["m²/to mow","km²/to mow", "ft²/to mow","yd²/to mow","a/to mow","ha/to mow","ac/to mow"] as $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('to_mow_units', '{{ $name }}'); dropdowns['to_mow_units'] = false"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        <hr>
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                @if ($detail['type'] == 'lawn_mowed')
                                    @if ($detail['charges'] == 'area')
                                        <div class="text-center">
                                            <p class="text-[20px]"><strong>{{$lang['16']}}</strong></p>
                                            <div class="flex justify-center">
                                                <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><span>{{$currancy}}</span> {{round($detail['total_cost'],5)}}</strong> </p>
                                            </div>
                                        </div>
                                        <div>
                                            <p><strong>{{ $lang['17'] }}</strong></p>
                                            <p class="mt-2">{{ $lang['18'] }} = {{ $detail['mow_price']}}km²</p>
                                            <p class="mt-2">{{ $lang['8'] }} = {{ $detail['area_mow']}}km²</p>
                                            <p class="mt-2"><strong>{{ $lang['19'] }}</strong></p>
                                            <p class="mt-2">{{ $lang['16'] }}  = {{ $lang['18'] }}  * {{ $lang['8'] }}</p>
                                            <p class="mt-2">{{ $lang['16'] }}  = {{ $detail['mow_price']}} * {{ $detail['area_mow']}}</p>
                                            <p class="mt-2"><strong>{{ $lang['16'] }}</strong> = <i>{{$currancy}}</i> {{ $detail['total_cost']}}</p>
                                        </div>
                                    @elseif ($detail['charges'] == 'hour')
                                        <div class="text-center">
                                            <p class="text-[20px]"><strong>{{$lang['16']}}</strong></p>
                                            <div class="flex justify-center">
                                                <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><span>{{$currancy}}</span> {{round($detail['total_cost'],5)}}</strong> </p>
                                            </div>
                                        </div>
                                        <div>
                                            <p><strong>{{ $lang['17'] }}</strong></p>
                                            <p class="mt-2">{{ $lang['18'] }} = {{ $detail['mow_price']}}/h</p>
                                            <p class="mt-2">{{ $lang['8'] }} = {{ $detail['hours_work']}}h</p>
                                            <p class="mt-2"><strong>{{ $lang['19'] }}</strong></p>
                                            <p class="mt-2">{{ $lang['16'] }} = {{ $lang['18'] }} * {{ $lang['20'] }}</p>
                                            <p class="mt-2">{{ $lang['16'] }} = {{ $detail['mow_price']}} * {{ $detail['hours_work']}}</p>
                                            <p class="mt-2"><strong>{{ $lang['16'] }}</strong> = <i>{{$currancy}}</i> {{ $detail['total_cost']}}</p>
                                        </div>
                                    @endif
                                @elseif ($detail['type'] == 'mowing_time')
                                        <div class="lg:w-[80%] w-full overflow-auto">
                                            <table class="w-full">
                                                <tr>
                                                    <td width="50%" class="border-b py-2"><strong>{{ $lang['21'] }} :</strong></td>
                                                    <td class="border-b py-2">{{ $detail['m_cost'] }} <span class="font-s-16">km² {{ $lang['6'] }}</span></td>
                                                </tr>
                                                @if (isset($detail['hours']))
                                                    <tr>
                                                        <td class="border-b py-2"><strong>{{ $lang['13'] }} :</strong></td>
                                                        <td class="border-b py-2">{{ $detail['hours']}} <span class="font-s-16">{{ $lang['21'] }}</span> : {{ $detail['minutes']}} <span class="font-s-16">{{ $lang['22'] }}</span></td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div>	
                                        <div class="lg:w-[80%] w-full overflow-auto" style="overflow: auto;">
                                            <p>{{ $lang['23'] }}</p> 
                                            <table class="w-full">
                                                <tr>
                                                    <td width="50%" class="border-b py-2">{{ $lang['21'] }} :</td>
                                                    <td class="border-b py-2">{{$detail['m_cost'] * 1000000}} m²</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['21'] }} :</td>
                                                    <td class="border-b py-2">{{$detail['m_cost'] * 10763910}} ft²</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['21'] }} :</td>
                                                    <td class="border-b py-2">{{$detail['m_cost'] * 1195990 }} yd²</td>
                    
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['21'] }} :</td>
                                                    <td class="border-b py-2">{{$detail['m_cost'] * 10000}} a</td>
                    
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['21'] }} :</td>
                                                    <td class="border-b py-2">{{$detail['m_cost'] * 100 }} ha</td>
                    
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang['21'] }} :</td>
                                                    <td class="border-b py-2">{{$detail['m_cost'] * 247.1 }} ac</td>
                    
                                                </tr>
                                            </table>
                                        </div>
                                        <div>
                                            <p class="mt-2"><strong>{{ $lang['17'] }}</strong></p>
                                            <p class="mt-2">{{ $lang['10'] }} = {{ $detail['mow_speed'] }} km/h</p>
                                            <p class="mt-2">{{ $lang['11'] }} = {{ $detail['mow_width'] }} km </p>
                                            <p class="mt-2">{{ $lang['30'] }} = {{ $detail['mow_pro'] }} %</p>
                                            @if (isset($detail['hours']))
                                                <p class="mt-2">{{ $lang['8'] }} = {{ $detail['to_mow'] }} km²</p>
                                            @endif
                                            <p class="mt-2 "><strong>{{ $lang['19'] }}</strong></p>
                                            <p class="mt-2">{{ $lang['21'] }} =  {{ $lang['10'] }} * {{ $lang['11'] }} * {{ $lang['30'] }} </p>
                                            <p class="mt-2">{{ $lang['21'] }} = {{ $detail['mow_speed'] }} * {{ $detail['mow_width'] }} * 
                                            <span class="fraction">
                                                <span class="num">{{ $detail['mow_pro'] }}</span>
                                                <span class="visually-hidden "></span>
                                                <span class="den">100</span>
                                            </span></p>
                                            <p class="mt-2">{{ $lang['21'] }} = {{ $detail['mow_speed'] * $detail['mow_width'] }} * {{ $detail['mow_pro'] / 100 }}</p>
                                            <p class="mt-2"><strong>{{ $lang['21'] }}  = {{ $detail['m_cost'] }}  km² {{ $lang['6'] }}</strong></p>
                                            @if (isset($detail['hours']))
                                                <p class="mt-2 font-s-16">{{ $lang['31'] }}</p>
                                                <p class="mt-2"> {{ $lang['13'] }}   =
                                                    <span class="fraction">
                                                        <span class="num">{{$lang['8'] }}</span>
                                                        <span class="visually-hidden "></span>
                                                        <span class="den">{{ $lang['32']}}</span>
                                                </p>
                                                <p class="mt-2"> {{ $lang['13'] }} = 
                                                    <span class="fraction">
                                                        <span class="num">{{ $detail['to_mow'] }}</span>
                                                        <span class="visually-hidden "></span>
                                                        <span class="den">{{$detail['m_cost'] }}</span>
                                                    </span>
                                                </p>
                                                <p class="mt-2"><strong> {{ $lang['13'] }}  = {{ $detail['hours']}} {{ $lang['21'] }}  : {{ $detail['minutes']}} {{ $lang['22'] }}</strong></p>
                                            @endif
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
