<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-12 gap-x-8 gap-y-6">
                    {{-- Gradient --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['1'] !!}:</label>
                        <div class="relative">
                            <input type="number" wire:model.live="gradient" step="any" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-10" placeholder="1">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold">%</span>
                        </div>
                    </div>

                    {{-- Weight --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{{ $lang['2'] }}:</label>
                        <div class="relative">
                            <input type="number" wire:model.live="weight" step="any" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-16" placeholder="175">
                            <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20 font-medium text-gray-600 text-xs" @click="open = !open">{{ $weight_unit }} ▾</label>
                            
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 top-[45px] overflow-hidden">
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('weight_unit', 'lbs')" @click="open = false">pounds (lbs)</p>
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('weight_unit', 'kg')" @click="open = false">kilograms (kg)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Speed --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{{ $lang['3'] }}:</label>
                        <div class="relative">
                            <input type="number" wire:model.live="speed" step="any" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-16" placeholder="4.5">
                            <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20 font-medium text-gray-600 text-xs" @click="open = !open">{{ $speed_unit }} ▾</label>
                            
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 top-[45px] overflow-hidden">
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('speed_unit', 'mph')" @click="open = false">mph</p>
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('speed_unit', 'Km/h')" @click="open = false">Km/h</p>
                            </div>
                        </div>
                    </div>

                    {{-- Distance --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{{ $lang['4'] }}:</label>
                        <div class="relative">
                            <input type="number" wire:model.live="distance" step="any" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-16" placeholder="4.5">
                            <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20 font-medium text-gray-600 text-xs" @click="open = !open">{{ $distance_unit }} ▾</label>
                            
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 top-[45px] overflow-hidden">
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('distance_unit', 'mile')" @click="open = false">{{ $lang[5] }}</p>
                                <p class="p-2 cursor-pointer text-xs hover:bg-blue-50 whitespace-nowrap" wire:click="setUnit('distance_unit', 'Km')" @click="open = false">Km</p>
                            </div>
                        </div>
                    </div>

                    {{-- Running Time --}}
                    <div class="col-span-12 md:col-span-12 lg:col-span-12">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['6'] !!}:</label>
                        <div class="relative">
                            <input type="number" wire:model.live="time" step="any" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-12" placeholder="60">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold">min</span>
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

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <p class="mb-2"><strong class="text-blue-700 text-[18px]">{{ $lang[7] }}</strong></p>
                                <div class="grid grid-cols-12 items-center">
                                    <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                        <div class="w-full bg-[#F6FAFC] border rounded-lg overflow-auto px-3 py-2" style="border: 1px solid #c1b8b899;">
                                            <table class="w-full" cellspacing="0">
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang[1] }}</td>
                                                    <td class="border-b py-2 ps-3"><strong class="text-green-700">{{ $detail['gradient'] }} %</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang[3] }}</td>
                                                    <td class="border-b py-2 ps-3">
                                                        <strong><span class="text-green-700">{{ $detail['speed_mph'] }}</span> mph</strong>
                                                        <span>/</span>
                                                        <strong><span class="text-green-700">{{ $detail['speed_kmh'] }}</span> Km/h</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang[6] }}</td>
                                                    <td class="border-b py-2 ps-3"><strong><span class="text-green-700">{{ $detail['time_ans'] }}</span> min</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2">{{ $lang[4] }}</td>
                                                    <td class="py-2 ps-3">
                                                        <strong><span class="text-green-700">{{ $detail['distance_m'] }}</span> {{ $lang[5] }}</strong>
                                                        <span>/</span>
                                                        <strong><span class="text-green-700">{{ $detail['distance_km'] }}</span> Km</strong>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-2 lg:col-span-2 flex justify-center py-4 text-center">
                                        <img src="{{ asset('images/send.webp') }}" alt="send icon" width="45px" height="45px">
                                    </div>
                                    <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                        <div class="col-12 bg-[#F6FAFC] border rounded-lg overflow-auto px-3 py-2" style="border: 1px solid #c1b8b899;">
                                            <table class="col-12" cellspacing="0">
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang[1] }}</td>
                                                    <td class="border-b py-2 ps-3"><strong><span class="text-green-700">0.0</span> %</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang[3] }}</td>
                                                    <td class="border-b py-2 ps-3">
                                                        <strong><span class="text-green-700">{{ $detail['speed_mph_sec'] }}</span> mph</strong>
                                                        <span>/</span>
                                                        <strong><span class="text-green-700">{{ $detail['speed_kmh_sec'] }}</span> Km/h</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2">{{ $lang[6] }}</td>
                                                    <td class="border-b py-2 ps-3"><strong><span class="text-green-700">{{ $detail['time_ans'] }}</span> min</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2">{{ $lang[4] }}</td>
                                                    <td class="py-2 ps-3">
                                                        <strong><span class="text-green-700">{{ $detail['distance_m_sec'] }}</span> {{ $lang[5] }}</strong>
                                                        <span>/</span>
                                                        <strong><span class="text-green-700">{{ $detail['distance_km_sec'] }}</span> Km</strong>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                {{-- weight loss meal planner --}}
                                <div class="grid grid-cols-12 bg-[#F6FAFC] border rounded-lg py-2 mt-3" style="border: 1px solid #c1b8b899'">
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6 px-3 overflow-auto md:border-r-2 lg:border-r-2 ">
                                        <table class="w-full px-4" cellspacing="0">
                                            <tr>
                                                <td class="border-b py-2">{{ $lang[8] }}</td>
                                                <td class="border-b py-2"><strong class="text-green-700">{{ $detail['cal'] }} Kcal</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang[9] }}</td>
                                                <td class="border-b py-2">
                                                    <strong>{{ $detail['fatoz_ans'] }} oz</strong>
                                                    <span>/</span>
                                                    <strong>{{ $detail['fatg_ans'] }} g</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2">METs</td>
                                                <td class="py-2"><strong>{{ $detail['mets'] }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6 px-3 overflow-auto ps-md-3">
                                        <table class="w-full px-4" cellspacing="0">
                                            <tr>
                                                <td class="border-b py-2">{{ $lang[10] }}</td>
                                                <td class="border-b py-2"><strong>{{ $detail['energy_kw_ans'] }} KWH</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $lang[11] }}</td>
                                                <td class="border-b py-2"><strong>{{ $detail['electric_heater_ans'] }} min</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2">{{ $lang[12] }}</td>
                                                <td class="py-2"><strong>{{ $detail['light_bulb_ans'] }} {{ $lang[13] }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="w-full overflow-auto mt-3">
                                    <table class="col-12 col-lg-6" cellspacing="0">
                                        <tr>
                                            <td class="border-b py-2">{{ $lang[14] }}</td>
                                            <td class="border-b py-2"><strong>{{ $detail['cburger_ans'] }} {{ $lang[15] }}(s)</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang[16] }} (355ml)</td>
                                            <td class="border-b py-2"><strong>{{ $detail['beer2_ans'] }} {{ $lang[17] }}(s)</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang[18] }}</td>
                                            <td class="border-b py-2"><strong>{{ $detail['shop_ans'] }} min</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">{{ $lang[19] }}</td>
                                            <td class="py-2"><strong>{{ $detail['cleanning_ans'] }} min</strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full mt-3">
                                    <ul class="blue-marker ">
                                        <li class="py-1">
                                            {{ $lang[20] }} <strong>{{ $detail['meter_dash_ans'] }} sec</strong>	
                                        </li>
                                        <li class="py-1">
                                            {{ $lang[21] }} <strong>{{ $detail['meter_run_h_ans'] }} min {{ $detail['meter_run_m_ans'] }} sec</strong>	
                                        </li>
                                        <li class="py-1">
                                            {{ $lang[22] }} <strong>{{ $detail['half_marathonh'] }} {{ $lang[13] }} {{ $detail['half_marathonm'] }} min {{ $detail['half_marathons'] }} sec</strong>	
                                        </li>
                                        <li class="py-1">
                                            {{ $lang[23] }} <strong>{{ $detail['marathonh'] }} {{ $lang[13] }} {{ $detail['marathonm'] }} min {{ $detail['marathons'] }} sec</strong>	
                                        </li>
                                    </ul>
                                    <p>*{{ $lang[24] }} <strong>{{ $detail['record_ans'] }} %</strong> {{ $lang[25] }}.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
