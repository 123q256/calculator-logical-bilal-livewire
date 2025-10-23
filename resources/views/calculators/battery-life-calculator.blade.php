<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="battery_capacity" class="label py-2">{{ $lang['1'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="battery_capacity" id="battery_capacity" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['battery_capacity']) ? $_POST['battery_capacity'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="battery_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('battery_units_dropdown')">{{ isset($_POST['battery_units'])?$_POST['battery_units']:'Ah' }} ▾</label>
                        <input type="text" name="battery_units" value="{{ isset($_POST['battery_units'])?$_POST['battery_units']:'Ah' }}" id="battery_units" class="hidden">
                        <div id="battery_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="battery_units">
                            @foreach (["Ah","mAh"] as $name)
                            <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('battery_units', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                        </div>
                     </div>
                </div>
           
              
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="discharge_safety" class="label py-2">({{ $lang['2'] }}):</label>
                <div class="w-100 py-2 relative">
                    <input type="number" name="discharge_safety" id="discharge_safety" class="input" aria-label="input"  value="{{ isset(request()->discharge_safety)?request()->discharge_safety:'20' }}" />
                    <span class="text-blue input_unit">%</span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="device_con1" class="label py-2 cat">{{ $lang['3'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="device_con1" id="device_con1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['device_con1']) ? $_POST['device_con1'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="device_con1_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('device_con1_units_dropdown')">{{ isset($_POST['device_con1_units'])?$_POST['device_con1_units']:'µA' }} ▾</label>
                    <input type="text" name="device_con1_units" value="{{ isset($_POST['device_con1_units'])?$_POST['device_con1_units']:'µA' }}" id="device_con1_units" class="hidden">
                    <div id="device_con1_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="device_con1_units">
                        @foreach (["A","mA","µA"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('device_con1_units', '{{ $name }}')"> {{ $name }}</p>
                    @endforeach
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="awake_time" class="label py-2">({{ $lang['4'] }}):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="awake_time" id="awake_time" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['awake_time']) ? $_POST['awake_time'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="awake_time_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('awake_time_units_dropdown')">{{ isset($_POST['awake_time_units'])?$_POST['awake_time_units']:'sec' }} ▾</label>
                    <input type="text" name="awake_time_units" value="{{ isset($_POST['awake_time_units'])?$_POST['awake_time_units']:'sec' }}" id="awake_time_units" class="hidden">
                    <div id="awake_time_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="awake_time_units">
                        @foreach ([" sec", " min", " hrs", " days", " wks", " mos", " yrs"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('awake_time_units', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                    </div>
                 </div>
            </div>
           
            <p class="col-span-12">{{$lang['5']}}</p>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="device_con2" class="label py-2 cat">{{ $lang['6'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="device_con2" id="device_con2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['device_con2']) ? $_POST['device_con2'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="device_con2_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('device_con2_units_dropdown')">{{ isset($_POST['device_con2_units'])?$_POST['device_con2_units']:'mA' }} ▾</label>
                    <input type="text" name="device_con2_units" value="{{ isset($_POST['device_con2_units'])?$_POST['device_con2_units']:'mA' }}" id="device_con2_units" class="hidden">
                    <div id="device_con2_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="device_con2_units">
                        @foreach (["A","mA","µA"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('device_con2_units', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="sleep_time" class="label py-2">({{ $lang['7'] }}):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="sleep_time" id="sleep_time" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['sleep_time']) ? $_POST['sleep_time'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="sleep_time_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('sleep_time_units_dropdown')">{{ isset($_POST['sleep_time_units'])?$_POST['sleep_time_units']:'mA' }} ▾</label>
                    <input type="text" name="sleep_time_units" value="{{ isset($_POST['sleep_time_units'])?$_POST['sleep_time_units']:'mA' }}" id="sleep_time_units" class="hidden">
                    <div id="sleep_time_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="sleep_time_units">
                        @foreach ([" sec", " min", " hrs", " days", " wks", " mos", " yrs"] as $name)
                        <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('sleep_time_units', '{{ $name }}')"> {{ $name }}</p>
                        @endforeach
                    </div>
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
                    @php
                        $battery_capacity = request()->battery_capacity;
                        $battery_units = request()->battery_units;
                        $discharge_safety = request()->discharge_safety;
                        $device_con1 = request()->device_con1;
                        $device_con1_units = request()->device_con1_units;
                        $awake_time = request()->awake_time;
                        $awake_time_units = request()->awake_time_units;
                        $device_con2 = request()->device_con2;
                        $device_con2_units = request()->device_con2_units;
                        $sleep_time = request()->sleep_time;
                        $sleep_time_units = request()->sleep_time_units;
                    @endphp
                    <div class="w-full my-2">
                        <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                            <table class="w-full">
                                <tr>
                                    <td class="border-b py-2" width="60%">
                                        {{$lang[6]}} :
                                    </td>
                                    <td class="border-b py-2">{{$detail['Average_consumption']}} mA</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">{{$lang[7]}} :</td>
                                    <td class="border-b py-2">{{round($detail['Battery_life'],1)}} hrs</td>
                                </tr>
                            </table>
                            <p class="py-2">
                                <strong>{{ $lang['8'] }}</strong></p>
                            <table class="w-full">
                                <tr>
                                    <td class="border-b" width="60%">{{ $lang['9'] }} :</td>
                                    <td class="border-b">{{ round($detail['Average_consumption'], 2) * 0.001 }}</td>
                                </tr>
                                <tbody>
                                    <tr>
                                        <td class="border-b">{{ $lang['10'] }} :</td>
                                        <td class="border-b py-2">{{ round($detail['Average_consumption'], 2) * 1000 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="pt-2">
                                <strong>{{ $lang['11'] }}</strong></p>
                            <table class="w-full">
                                    <tr>
                                        <td width="60%" class="border-b ">{{ $lang['12'] }}</td>
                                        <td class="border-b py-2">{{ round($detail['Battery_life'], 2) * 3600; }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b ">{{ $lang['13'] }}</td>
                                        <td class="border-b py-2">{{ round($detail['Battery_life'], 2) * 60; }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b ">{{ $lang['14'] }}</td>
                                        <td class="border-b py-2">{{ round($detail['Battery_life'], 2) * 0.04167; }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b ">{{ $lang['15'] }}</td>
                                        <td class="border-b py-2">{{ round($detail['Battery_life'], 2) * 0.005952; }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b ">{{ $lang['16'] }}</td>
                                        <td class="border-b py-2">{{ round($detail['Battery_life'], 2) * 0.001369; }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b ">{{ $lang['17'] }}</td>
                                        <td class="border-b py-2">{{ round($detail['Battery_life'], 2) * 0.00011408; }}</td>
                                    </tr>
                            </table>
                        </div>
                        <div class="font-s-18 overflow-auto">
                            <p class="mt-3"><strong>{{$lang['19']}}</strong></p>
                            <span>{{$lang['7'] }} = </span>
                            <span class="fraction">
                                <span class="num">Capacity</span>
                                <span class="visually-hidden"></span>
                                <span class="den">Consumption</span>
                            </span>
                            <span>
                                <i>x </i> (1 - Discharge safety)
                            </span>
                            <div>
                                <span>{{$lang['7'] }} = </span>
                                <span class="fraction">
                                    <span class="num">{{$battery_capacity}}</span>
                                    <span class="visually-hidden"></span>
                                    <span class="den">{{$device_con1}}</span>
                                </span>
                                <span>
                                    <i>x </i> (1 - {{$discharge_safety}})
                                </span>
                            </div>
                            <div>
                                {{$lang['7'] }} = {{round($detail['Battery_life'], 2)}}
                            </div>
                            <p class="mt-2">{{ $lang['20'] }}</p>
                            <div>
                                <span>{{$lang['6'] }} = </span>
                                <span class="fraction">
                                    <span class="num"> ( Consumption1 x Time1 +
                                        Consumption2 x Time2)</span>
                                    <span class="visually-hidden"></span>
                                    <span class="den">(Time1 + Time2)</span>
                                </span>
                            </div>
                            <div>
                                <span>{{$lang['6'] }} = </span>
                                <span class="fraction">
                                    <span class="num"> ( {{$device_con1.' x '.$awake_time .' + '.
                                        $device_con2 .' x '. $sleep_time}})</span>
                                    <span class="visually-hidden"></span>
                                    <span class="den">({{$awake_time .' + '. $sleep_time}})</span>
                                </span>
                            </div>
                            <div>
                                {{$lang['6'] }} = {{round($detail['Average_consumption'], 2)}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>