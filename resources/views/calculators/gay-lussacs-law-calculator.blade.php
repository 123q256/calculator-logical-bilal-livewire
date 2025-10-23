<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="selection" class="label">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="selection" id="selection" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['2']." (T₂) ",$lang['3']." (p₂) ",$lang['4']." (p₁) ",$lang['5']." (T₁) ",$lang['6']." (V) ",$lang['7']." (n) "];
                                $val = ["1","2","3","4","5","6"];
                                optionsList($val,$name,isset(request()->selection)?request()->selection:'1');
                            @endphp
                        </select>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6 input-field pressure_one">
                    <label for="p1" class="label">{{ $lang['4'] }} (p₁):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="p1" id="p1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['p1']) ? $_POST['p1'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="p1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('p1_unit_dropdown')">{{ isset($_POST['p1_unit'])?$_POST['p1_unit']:'Pa' }} ▾</label>
                        <input type="text" name="p1_unit" value="{{ isset($_POST['p1_unit'])?$_POST['p1_unit']:'Pa' }}" id="p1_unit" class="hidden">
                        <div id="p1_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="p1_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'Pa')">Pa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'Bar')">Bar</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'psi')">psi</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'at')">at</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'atm')">atm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'Torr')">Torr</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'hPa')">hPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'kPa')">kPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'MPa')">MPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'GPa')">GPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'inHg')">inHg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'mmHg')">mmHg</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 input-field temperature_one">
                    <label for="t1" class="label">{{ $lang['5'] }} (T₁):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="t1" id="t1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['t1']) ? $_POST['t1'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="t1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t1_unit_dropdown')">{{ isset($_POST['t1_unit'])?$_POST['t1_unit']:'°C' }} ▾</label>
                        <input type="text" name="t1_unit" value="{{ isset($_POST['t1_unit'])?$_POST['t1_unit']:'°C' }}" id="t1_unit" class="hidden">
                        <div id="t1_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="t1_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1_unit', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1_unit', '°F')">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1_unit', 'K')">K</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 input-field pressure_two">
                    <label for="p2" class="label">{{ $lang['3'] }} (p₂):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="p2" id="p2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['p2']) ? $_POST['p2'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="p2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('p2_unit_dropdown')">{{ isset($_POST['p2_unit'])?$_POST['p2_unit']:'°C' }} ▾</label>
                        <input type="text" name="p2_unit" value="{{ isset($_POST['p2_unit'])?$_POST['p2_unit']:'°C' }}" id="p2_unit" class="hidden">
                        <div id="p2_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="p2_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'Pa')">Pa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'Bar')">Bar</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'psi')">psi</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'at')">at</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'atm')">atm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'Torr')">Torr</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'hPa')">hPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'kPa')">kPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'MPa')">MPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'GPa')">GPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'inHg')">inHg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'mmHg')">mmHg</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 input-field temperature_two">
                    <label for="t2" class="label">{{ $lang['2'] }} (T₂):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="t2" id="t2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['t2']) ? $_POST['t2'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="t2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t2_unit_dropdown')">{{ isset($_POST['t2_unit'])?$_POST['t2_unit']:'°C' }} ▾</label>
                        <input type="text" name="t2_unit" value="{{ isset($_POST['t2_unit'])?$_POST['t2_unit']:'°C' }}" id="t2_unit" class="hidden">
                        <div id="t2_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="t2_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t2_unit', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t2_unit', '°F')">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t2_unit', 'K')">K</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 input-field volume_one">
                    <label for="v1" class="label">{{ $lang['6'] }} (V):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="v1" id="v1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['v1']) ? $_POST['v1'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="v1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('v1_unit_dropdown')">{{ isset($_POST['v1_unit'])?$_POST['v1_unit']:'°C' }} ▾</label>
                        <input type="text" name="v1_unit" value="{{ isset($_POST['v1_unit'])?$_POST['v1_unit']:'°C' }}" id="v1_unit" class="hidden">
                        <div id="v1_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="v1_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'mm³')">mm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'cm³')">cm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'dm³')">dm³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'm³')">m³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'in³')">in³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'ft³')">ft³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'yd³')">yd³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'ml')">ml</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'liters')">liters</p>
                        </div>
                     </div>
                </div>
             
                <div class="col-span-12 md:col-span-6 lg:col-span-6 input-field amount">
                    <label for="amount" class="label">{!! $lang['7'] !!} (n):</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="amount" id="amount" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['amount'])?$_POST['amount']:'1' }}" />
                        <span class="text-blue input_unit">mol</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 input-field gas">
                    <label for="R" class="label">{!! $lang['8'] !!} (R):</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="R" id="R" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['R'])?$_POST['R']:'8.3144626' }}" />
                        <span class="text-blue input_unit">J⋅K⁻¹⋅mol⁻¹</span>
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
                                @php
                                    if($detail['method']=="1"){
                                        $assign=$lang['2']." (T₂)";
                                    }else if($detail['method']=="4"){
                                        $assign=$lang['5']." (T₁)";
                                    }else if($detail['method']=="2"){
                                        $assign=$lang['3']." (p₂)";
                                    }else if($detail['method']=="3"){
                                        $assign=$lang['4']." (p₁)";
                                    }else if($detail['method']=="6"){
                                        $assign=$lang['7']." (n)";
                                    }else if($detail['method']=="5"){
                                        $assign=$lang['6']." (V)";
                                    }
                                @endphp
                                @if($detail['method']=="1" || $detail['method']=="4")
                                    <div class="bg-[#F6FAFC] my-1 border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <strong>{!! $assign !!} =</strong>
                                        <strong class="text-green-500 text-[21px]">{!! $detail['temp'] !!} <span class="text-green-500 text-[18px]">(K)</span></strong>
                                    </div>
                                @endif
                                @if($detail['method']=="2" || $detail['method']=="3")
                                    <div class="bg-[#F6FAFC] my-1 border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <strong>{!! $assign !!} =</strong>
                                        <strong class="text-green-500 text-[21px]">{!! $detail['temp'] !!} <span class="text-green-500 text-[18px]">(Pa)</span></strong>
                                    </div>
                                @endif
                                @if($detail['method']=="5")
                                    <div class="bg-[#F6FAFC] my-1 border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <strong>{!! $assign !!} =</strong>
                                        <strong class="text-green-500 text-[21px]">{!! $detail['calculate_volume'] !!} <span class="text-green-500 text-[18px]">(m³)</span></strong>
                                    </div>
                                    <p class="mt-3 mb-2"><strong>Results in other units:</strong></p>
                                    <div class="w-full overflow-auto">
                                        <table class="w-full md:w-[80%] lg:w-[80%]" cellspacing="0">
                                            <tr>
                                                <td class="border-b py-2 pe-2">{!! $assign !!}</td>
                                                <td class="border-b py-2 ps-2">{!! round($detail['calculate_volume']*1000000000,4) !!} (mm³)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 pe-2">{!! $assign !!}</td>
                                                <td class="border-b py-2 ps-2">{!! round($detail['calculate_volume']*1000000,4) !!} (cm³)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 pe-2">{!! $assign !!}</td>
                                                <td class="border-b py-2 ps-2">{!! round($detail['calculate_volume']*1000,4) !!} (dm³)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 pe-2">{!! $assign !!}</td>
                                                <td class="border-b py-2 ps-2">{!! round($detail['calculate_volume']*61024,4) !!} (cu in)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 pe-2">{!! $assign !!}</td>
                                                <td class="border-b py-2 ps-2">{!! round($detail['calculate_volume']*35.315,4) !!} (cu ft)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 pe-2">{!! $assign !!}</td>
                                                <td class="border-b py-2 ps-2">{!! round($detail['calculate_volume']*1000000,4) !!} (ml)</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 pe-2">{!! $assign !!}</td>
                                                <td class="py-2 ps-2">{!! round($detail['calculate_volume']*1000,2) !!} (liters)</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif
                                @if($detail['method']=="6")
                                    <div class="bg-[#F6FAFC] my-1 border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <strong>{!! $assign !!} =</strong>
                                        <strong class="text-green-500 text-[21px]">{!! $detail['n'] !!} <span class="text-green-500 text-[18px]">(mol)</span></strong>
                                    </div>
                                @endif
                                @if($detail['method']=="1" || $detail['method']=="4" || $detail['method']=="2" || $detail['method']=="3")
                                <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                            <div class="bg-[#F6FAFC] my-1 border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                                <strong>Volume (V) =</strong>
                                                <strong class="text-green-500 text-[21px]">{!! round($detail['volume'],4) !!} m³</strong>
                                            </div>
                                        </div>
                                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                            <div class="bg-[#F6FAFC] my-1 border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                                <strong>Amount of gas (n) =</strong>
                                                <strong class="text-green-500 text-[21px]">{!! $detail['amount_of_gas'] !!} mol</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($detail['method']=="1" || $detail['method']=="4")
                                    <p class="mt-3 mb-2"><strong>{!! $lang['9'] !!}:</strong></p>
                                    <div class="w-full overflow-auto">
                                        <table class="w-full md:w-[80%] lg:w-[80%]" cellspacing="0">
                                            <tr>
                                                <td class="border-b py-2 pe-2">{!! $assign !!}</td>
                                                <td class="border-b py-2 ps-2">{!! $detail['temp']-273.15; !!} (°C)</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 pe-2">{!! $assign !!}</td>
                                                <td class="py-2 ps-2">{!! ($detail['temp']-273.15)*(9/5)+32; !!} (°F)</td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif
                                @if($detail['method']=="2" || $detail['method']=="3")
                                    <p class="mt-3 mb-2"><strong>{!! $lang['9'] !!}:</strong></p>
                                    <div class="w-full overflow-auto">
                                        <table class="w-full md:w-[80%] lg:w-[80%]" cellspacing="0">
                                            <tr>
                                                <td class="border-b py-2 pe-2">{!! $assign  !!}</td>
                                                <td class="border-b py-2 ps-2">{!! $detail['temp']*0.00001 !!} bars (bar)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 pe-2">{!! $assign  !!}</td>
                                                <td class="border-b py-2 ps-2">{!! $detail['temp']*0.00014504; !!} pounds per square inch (psi)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 pe-2">{!! $assign  !!}</td>
                                                <td class="border-b py-2 ps-2">{!! $detail['temp']*0.000010197; !!} technical atmospheres (at)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 pe-2">{!! $assign  !!}</td>
                                                <td class="border-b py-2 ps-2">{!! $detail['temp']*0.00000987; !!} standard atmospheres (atm)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 pe-2">{!! $assign  !!}</td>
                                                <td class="border-b py-2 ps-2">{!! $detail['temp']*0.0075 !!} torrs (Torr)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 pe-2">{!! $assign  !!}</td>
                                                <td class="border-b py-2 ps-2">{!! $detail['temp']*0.01 !!} hectopascals (hPa)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 pe-2">{!! $assign  !!}</td>
                                                <td class="border-b py-2 ps-2">{!! $detail['temp']*0.001 !!} kilopascals (kPa)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 pe-2">{!! $assign  !!}</td>
                                                <td class="border-b py-2 ps-2">{!! $detail['temp']*0.000001; !!} megapascals (MPa)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 pe-2">{!! $assign  !!}</td>
                                                <td class="border-b py-2 ps-2">{!! $detail['temp']*0.000000001 !!} megapascals (GPa)</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2 pe-2">{!! $assign  !!}</td>
                                                <td class="border-b py-2 ps-2">{!! $detail['temp']*0.0002953 !!} inches of mercury (in Hg)</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 pe-2">{!! $assign  !!}</td>
                                                <td class="py-2 ps-2">{!! $detail['temp']*0.0075 !!} millimeters of mercury (mmHg)</td>
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
    @push('calculatorJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function updateFields() {
                    var a = document.getElementById("selection").value;
                    var inputFields = document.querySelectorAll(".input-field");

                    inputFields.forEach(function(field) {
                        field.style.display = 'none';
                    });

                    if (a == "1") {
                        document.querySelectorAll(".pressure_one, .temperature_one, .pressure_two").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "2") {
                        document.querySelectorAll(".pressure_one, .temperature_one, .temperature_two").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "3") {
                        document.querySelectorAll(".pressure_two, .temperature_one, .temperature_two").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "4") {
                        document.querySelectorAll(".pressure_one, .temperature_two, .pressure_two").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "5") {
                        document.querySelectorAll(".pressure_one, .temperature_one, .gas, .amount").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "6") {
                        document.querySelectorAll(".pressure_one, .temperature_one, .gas, .volume_one").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    }
                }

                updateFields();

                document.getElementById("selection").addEventListener("change", function() {
                    updateFields();
                });
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>