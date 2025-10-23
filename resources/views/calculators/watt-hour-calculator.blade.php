<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
         <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="flex flex-wrap ">
                <label for="dob" class="label">{{$lang[1]}}:</label>
                <div class="w-full flex space-x-4">
                    <div class="w-full px-2">
                        <div class="w-full py-2">
                            <label for="volt" class="font-s-14 text-blue"><?= $lang[2] ?>:</label>
                            <div class="relative w-full ">
                                <input type="number" name="volt" id="volt" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['volt'])?$_POST['volt']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="volt_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('volt_unit_dropdown')">{{ isset($_POST['volt_unit'])?$_POST['volt_unit']:'nv' }} ▾</label>
                                <input type="text" name="volt_unit" value="{{ isset($_POST['volt_unit'])?$_POST['volt_unit']:'nv' }}" id="volt_unit" class="hidden">
                                <div id="volt_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[30%] mt-1 right-0  hidden">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volt_unit', 'nv')">nv</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volt_unit', 'μV')">μV</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volt_unit', 'V')">V</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volt_unit', 'mV')">mV</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volt_unit', 'kV')">kV</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volt_unit', 'MV')">MV</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-2">
                        <div class="w-full py-2">
                            <label for="charge" class="font-s-14 text-blue"><?= $lang[3] ?>:</label>
                            <div class="relative w-full ">
                                <input type="number" name="charge" id="charge" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['charge'])?$_POST['charge']:'7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="charge_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('charge_unit_dropdown')">{{ isset($_POST['charge_unit'])?$_POST['charge_unit']:'C' }} ▾</label>
                                <input type="text" name="charge_unit" value="{{ isset($_POST['charge_unit'])?$_POST['charge_unit']:'C' }}" id="charge_unit" class="hidden">
                                <div id="charge_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[30%] mt-1 right-0 hidden">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit', 'C')">C</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit', 'Ah')">Ah</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_unit', 'mAh')">mAh</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <label for="e_date" class="label">{{$lang[4]}}:</label>
                <div class="w-full flex space-x-">
                    <div class="w-full px-2">
                        <div class="w-full py-2">
                            <label for="power" class="font-s-14 text-blue"><?= $lang[5] ?>:</label>
                            <div class="relative w-full ">
                                <input type="number" name="power" id="power" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['power'])?$_POST['power']:'3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="power_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('power_unit_dropdown')">{{ isset($_POST['power_unit'])?$_POST['power_unit']:'mW' }} ▾</label>
                                <input type="text" name="power_unit" value="{{ isset($_POST['power_unit'])?$_POST['power_unit']:'mW' }}" id="power_unit" class="hidden">
                                <div id="power_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[30%] mt-1 right-0 hidden">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'mW')">mW</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'W')">W</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'kW')">kW</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'MW')">MW</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'BTU/h')">BTU/h</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'hp(I)')">hp(I)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'hp(E)')">hp(E)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full px-2">
                        <div class="w-full py-2">
                            <label for="hour" class="font-s-14 text-blue"><?= $lang[6] ?>:</label>
                            <div class="relative w-full ">
                                <input type="number" name="hour" id="hour" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['hour'])?$_POST['hour']:'9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="hour_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('hour_unit_dropdown')">{{ isset($_POST['hour_unit'])?$_POST['hour_unit']:'ms' }} ▾</label>
                                <input type="text" name="hour_unit" value="{{ isset($_POST['hour_unit'])?$_POST['hour_unit']:'ms' }}" id="hour_unit" class="hidden">
                                <div id="hour_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[30%] mt-1 right-0 hidden">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hour_unit', 'ms')">ms</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hour_unit', 'sec')">sec</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hour_unit', 'min')">min</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hour_unit', 'hrs')">hrs</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hour_unit', 'dys')">dys</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hour_unit', 'wks')">wks</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hour_unit', 'm')">m</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hour_unit', 'yrs')">yrs</p>
                                </div>
                            </div>
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
        {{-- result --}}
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full bg-light-blue  rounded-lg mt-3">
                        <div class="flex flex-wrap">
                            @if (isset($detail['energy']) && isset($detail['energy_k']))
                                <div class="w-full lg:w-7/12 mt-2">
                                    <table class="w-full">
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang['7'] }}</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ $detail['energy'] }} Wh</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang['8'] }}</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ $detail['energy_k'] }} kWh</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            @if (isset($detail['watt_h']) && isset($detail['watt_hk']))
                                <div class="w-full lg:w-7/12 mt-2">
                                    <table class="w-full">
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang['9'] }}</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ $detail['watt_h'] }} Wh</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang['10'] }}</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ $detail['watt_hk'] }} kWh</strong></td>
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
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
@push('calculatorJS')
    
@endpush