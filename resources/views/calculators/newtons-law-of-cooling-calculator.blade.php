<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-6">
                    <label for="ambient" class="font-s-14 text-blue"><?= $lang[1] ?>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="ambient" id="ambient" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ambient']) ? $_POST['ambient'] : '20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="ambient_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ambient_units_dropdown')">{{ isset($_POST['ambient_units'])?$_POST['ambient_units']:'°C' }} ▾</label>
                        <input type="text" name="ambient_units" value="{{ isset($_POST['ambient_units'])?$_POST['ambient_units']:'°C' }}" id="ambient_units" class="hidden">
                        <div id="ambient_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ambient_units">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ambient_units', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ambient_units', '°F')">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ambient_units', 'K')">K</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6">
                    <label for="initial_temperature" class="font-s-14 text-blue"><?= $lang[2] ?>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="initial_temperature" id="initial_temperature" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['initial_temperature']) ? $_POST['initial_temperature'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="initial_temp_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('initial_temp_units_dropdown')">{{ isset($_POST['initial_temp_units'])?$_POST['initial_temp_units']:'°C' }} ▾</label>
                        <input type="text" name="initial_temp_units" value="{{ isset($_POST['initial_temp_units'])?$_POST['initial_temp_units']:'°C' }}" id="initial_temp_units" class="hidden">
                        <div id="initial_temp_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="initial_temp_units">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('initial_temp_units', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('initial_temp_units', '°F')">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('initial_temp_units', 'K')">K</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6">
                    <label for="area" class="font-s-14 text-blue"><?= $lang[3] ?>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="area" id="area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area']) ? $_POST['area'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="area_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_units_dropdown')">{{ isset($_POST['area_units'])?$_POST['area_units']:'mm²' }} ▾</label>
                        <input type="text" name="area_units" value="{{ isset($_POST['area_units'])?$_POST['area_units']:'mm²' }}" id="area_units" class="hidden">
                        <div id="area_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_units">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_units', 'mm²')">mm²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_units', 'cm²')">cm²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_units', 'm²')">m²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_units', 'km²')">km²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_units', 'in²')">in²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_units', 'ft²')">ft²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_units', 'yd²')">yd²</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6">
                    <label for="heat_capacity" class="font-s-14 text-blue"><?= $lang[4] ?>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="heat_capacity" id="heat_capacity" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['heat_capacity']) ? $_POST['heat_capacity'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="heat_capacity_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('heat_capacity_units_dropdown')">{{ isset($_POST['heat_capacity_units'])?$_POST['heat_capacity_units']:'J/K' }} ▾</label>
                        <input type="text" name="heat_capacity_units" value="{{ isset($_POST['heat_capacity_units'])?$_POST['heat_capacity_units']:'J/K' }}" id="heat_capacity_units" class="hidden">
                        <div id="heat_capacity_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="heat_capacity_units">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('heat_capacity_units', 'J/K')">J/K</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('heat_capacity_units', 'J/°C')">J/°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('heat_capacity_units', 'BTU/°F')">BTU/°F</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6">
                    <label for="heat_transfer_co" class="font-s-14 text-blue"><?= $lang[5] ?>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="heat_transfer_co" id="heat_transfer_co" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['heat_transfer_co']) ? $_POST['heat_transfer_co'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="heat_transfer_co_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('heat_transfer_co_units_dropdown')">{{ isset($_POST['heat_transfer_co_units'])?$_POST['heat_transfer_co_units']:'W/(m²·K)' }} ▾</label>
                        <input type="text" name="heat_transfer_co_units" value="{{ isset($_POST['heat_transfer_co_units'])?$_POST['heat_transfer_co_units']:'W/(m²·K)' }}" id="heat_transfer_co_units" class="hidden">
                        <div id="heat_transfer_co_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="heat_transfer_co_units">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('heat_transfer_co_units', 'W/(m²·K)')">W/(m²·K)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('heat_transfer_co_units', 'BTU/(h·ft²·°F)')">BTU/(h·ft²·°F)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6">
                    <label for="temp_after" class="font-s-14 text-blue"><?= $lang[4] ?>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="temp_after" id="temp_after" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['temp_after']) ? $_POST['temp_after'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="temp_after_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('temp_after_units_dropdown')">{{ isset($_POST['temp_after_units'])?$_POST['temp_after_units']:'sec' }} ▾</label>
                        <input type="text" name="temp_after_units" value="{{ isset($_POST['temp_after_units'])?$_POST['temp_after_units']:'sec' }}" id="temp_after_units" class="hidden">
                        <div id="temp_after_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="temp_after_units">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_after_units', 'sec')">sec</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_after_units', 'min')">min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_after_units', 'hrs')">hrs</p>
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
                    <div class="w-full">
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['7'] }}</td>
                                    <td class="py-2 border-b"><strong class="text-blue"><?= round($detail['temperature'], 3) ?> °C</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['8'] }}</td>
                                    <td class="py-2 border-b"><strong class="text-blue"><?= number_format($detail['k'], 5) ?> sec⁻¹</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <p class="col-12 mt-3 font-s-18 text-blue"><?= $lang[9] ?></p>
                    <div class="w-full md:w-[60%] lg:w-[60%]  overflow-auto mt-2">
                        <table class="w-100" style="border-collapse: collapse">
                            <thead>
                                <tr class="bg-[#f5f5f5]">
                                    <td class="p-2 border text-center"><strong class="text-blue">°F</strong></td>
                                    <td class="p-2 border text-center"><strong class="text-blue">K</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-[#F6FAFC]">
                                    <td class="text-center p-2 border"><?= ($detail['temperature'] * 9 / 5) + 32; ?></td>
                                    <td class="text-center p-2 border"><?= $detail['temperature'] + 273.15 ?></td>
                                </tr>
                            </tbody>
                        </table>
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