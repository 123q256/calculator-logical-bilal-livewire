<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="distance" class="label">{{ $lang['1'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="distance" id="distance" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['distance']) ? $_POST['distance'] : '800' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="distance_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('distance_unit_dropdown')">{{ isset($_POST['distance_unit'])?$_POST['distance_unit']:'km' }} ▾</label>
                        <input type="text" name="distance_unit" value="{{ isset($_POST['distance_unit'])?$_POST['distance_unit']:'km' }}" id="distance_unit" class="hidden">
                        <div id="distance_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="distance_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'km')">km</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'mi')">mi</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'nmi')">nmi</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="average_speed" class="label">{{ $lang['2'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="average_speed" id="average_speed" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['average_speed']) ? $_POST['average_speed'] : '800' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="average_speed_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('average_speed_unit_dropdown')">{{ isset($_POST['average_speed_unit'])?$_POST['average_speed_unit']:'km/h' }} ▾</label>
                        <input type="text" name="average_speed_unit" value="{{ isset($_POST['average_speed_unit'])?$_POST['average_speed_unit']:'km/h' }}" id="average_speed_unit" class="hidden">
                        <div id="average_speed_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="average_speed_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('average_speed_unit', 'km/h')">km/h</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('average_speed_unit', 'm/h')">m/h</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('average_speed_unit', 'mph')">mph</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="breaks" class="label">{{ $lang['3'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="breaks" id="breaks" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['breaks']) ? $_POST['breaks'] : '800' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="breaks_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('breaks_unit_dropdown')">{{ isset($_POST['breaks_unit'])?$_POST['breaks_unit']:'sec' }} ▾</label>
                        <input type="text" name="breaks_unit" value="{{ isset($_POST['breaks_unit'])?$_POST['breaks_unit']:'sec' }}" id="breaks_unit" class="hidden">
                        <div id="breaks_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="breaks_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('breaks_unit', 'sec')">sec</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('breaks_unit', 'min')">min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('breaks_unit', 'hrs')">hrs</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('breaks_unit', 'days')">days</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('breaks_unit', 'wks')">wks</p>
                        </div>
                     </div>
                </div>

          
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="departure_time" class="label">{{ $lang['7'] }}:</label>
                <div class="w-full py-2"> 
                    <input type="datetime-local" name="departure_time" id="departure_time" class="input" aria-label="input"  value="{{ isset($_POST['departure_time'])?$_POST['departure_time']: ""}}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="fuel_e" class="label">{{ $lang['8'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="fuel_e" id="fuel_e" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fuel_e']) ? $_POST['fuel_e'] : '800' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="fuel_e_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fuel_e_unit_dropdown')">{{ isset($_POST['fuel_e_unit'])?$_POST['fuel_e_unit']:'L/100km' }} ▾</label>
                    <input type="text" name="fuel_e_unit" value="{{ isset($_POST['fuel_e_unit'])?$_POST['fuel_e_unit']:'L/100km' }}" id="fuel_e_unit" class="hidden">
                    <div id="fuel_e_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fuel_e_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fuel_e_unit', 'L/100km')">L/100km</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fuel_e_unit', 'us mpg')">us mpg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fuel_e_unit', 'uk mpg')">uk mpg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fuel_e_unit', 'km/L')">km/L</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="fuel_p" class="label">{{ $lang['9'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="fuel_p" id="fuel_p" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fuel_p']) ? $_POST['fuel_p'] : '1.22' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="fuel_p_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fuel_p_unit_dropdown')">{{ isset($_POST['fuel_p_unit'])?$_POST['fuel_p_unit']:$currancy.'/L' }} ▾</label>
                    <input type="text" name="fuel_p_unit" value="{{ isset($_POST['fuel_p_unit'])?$_POST['fuel_p_unit']:$currancy.'/L' }}" id="fuel_p_unit" class="hidden">
                    <div id="fuel_p_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fuel_p_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fuel_p_unit', '{{$currancy}}/L')">{{$currancy}}/L</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fuel_p_unit', '{{$currancy}}/us gal')">{{$currancy}}/us gal</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fuel_p_unit', '{{$currancy}}/uk gal')">{{$currancy}}/uk gal</p>
                    </div>
                 </div>
            </div>
           
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="passengers" class="label">{{ $lang['10'] }}:</label>
                <div class="w-full py-2 position-relative"> 
                    <input type="number" step="any" name="passengers" id="passengers" class="input" aria-label="input"  value="{{ isset($_POST['passengers'])?$_POST['passengers']: '1'}}" />
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
                        <div class="w-full my-2">
                            <div class="w-full md:w-[80%] lg:w-[80%]">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td width="60%" class="border-b py-2"><strong>{{$lang['11']}} :</strong></td>
                                        <td class="border-b py-2">
                                            @php
                                                $wholeHours = floor($detail['total_drive_hours']);
                                                $remainingMinutes = ($detail['total_drive_hours'] - $wholeHours) * 60;                                        
                                            @endphp
                                            {{sprintf("%02d", $wholeHours) . $lang['5']}}
                                            {{sprintf("%02d", $remainingMinutes) . $lang['6']}}
                                        </td>
                                    </tr>
                                    @if(isset($detail['arrival_time']))
                                        <tr>
                                            <td class="border-b py-2"><strong>{{$lang['12']}} :</strong></td>
                                            <td class="border-b py-2">
                                                {{$detail['arrival_time'] }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['13']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$currancy.number_format($detail['total_drive_cost'], 2)}}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong>{{$lang['14']}} :</strong></td>
                                        <td class="border-b py-2">
                                            {{$currancy.number_format($detail['drive_cost_per_person'], 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    @endisset
</form>