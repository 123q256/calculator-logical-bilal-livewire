<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-6">
                    <label for="gradient" class="label">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="gradient" id="gradient" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->gradient)?request()->gradient:'17' }}" />
                        <span class="text-blue input_unit">%</span>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="weight" class="label">{{ $lang['2'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '175' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="weight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('weight_unit_dropdown')">{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'lbs' }} ▾</label>
                        <input type="text" name="weight_unit" value="{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'lbs' }}" id="weight_unit" class="hidden">
                        <div id="weight_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="weight_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'lbs')">pounds (lbs)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'kg')">kilograms (kg)</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="speed" class="label">{{ $lang['3'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="speed" id="speed" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['speed']) ? $_POST['speed'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="speed_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('speed_unit_dropdown')">{{ isset($_POST['speed_unit'])?$_POST['speed_unit']:'mph' }} ▾</label>
                        <input type="text" name="speed_unit" value="{{ isset($_POST['speed_unit'])?$_POST['speed_unit']:'mph' }}" id="speed_unit" class="hidden">
                        <div id="speed_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="speed_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('speed_unit', 'mph')">miles per hour (mph)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('speed_unit', 'Km/h')">kilometers per hour (Km/h)</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="distance" class="label">{{ $lang['4'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="distance" id="distance" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['distance']) ? $_POST['distance'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="distance_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('distance_unit_dropdown')">{{ isset($_POST['distance_unit'])?$_POST['distance_unit']:'mile' }} ▾</label>
                        <input type="text" name="distance_unit" value="{{ isset($_POST['distance_unit'])?$_POST['distance_unit']:'mile' }}" id="distance_unit" class="hidden">
                        <div id="distance_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="distance_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'mile')">{{ $lang[5] }}</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'Km')">Km</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="time" class="label">{!! $lang['6'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="time" id="time" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->time)?request()->time:'' }}" />
                        <span class="text-blue input_unit">min</span>
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
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
                        <div class="grid grid-cols-12  bg-[#F6FAFC] border rounded-lg  py-2 mt-3" style="border: 1px solid #c1b8b899'">
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

    @endisset
</form>