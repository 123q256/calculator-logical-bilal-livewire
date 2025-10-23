<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
                @endif
               <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                   <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2 relative">
                            <label for="find" class="font-s-14 text-blue">{!! $lang['9'] !!}:</label>
                            <select name="find" id="find" class="input">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                        {!! $arr2[$index] !!}
                                    </option>
                                @php
                                    }}
                                    $name = [$lang['4'],$lang['3'],$lang['2'],$lang['1'],$lang['5'],$lang['6']];
                                    $val = ["1","2","3","4","5","6"];
                                    optionsList($val,$name,isset(request()->find)?request()->find:'1');
                                @endphp
                            </select>
                        </div>
                        <div class="space-y-2 pressure_one">
                            <label for="p1" class="font-s-14 text-blue">{{ $lang['1'] }} (p₁):</label>
                            <div class="relative w-full ">
                                <input type="number" name="p1" id="p1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['p1'])?$_POST['p1']:'2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="p1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('p1_unit_dropdown')">{{ isset($_POST['p1_unit'])?$_POST['p1_unit']:'Pa' }} ▾</label>
                                <input type="text" name="p1_unit" value="{{ isset($_POST['p1_unit'])?$_POST['p1_unit']:'Pa' }}" id="p1_unit" class="hidden">
                                <div id="p1_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[25%] mt-1 right-0 hidden">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'Pa')">Pa</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'Bar')">Bar</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'Torr')">Torr</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'psi')">psi</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'at')">at</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'atm')">atm</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'hPa')">hPa</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'MPa')">MPa</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'kPa')">kPa</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'GPa')">GPa</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'mmHg')">mmHg</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_unit', 'in Hg')">in Hg</p>
                               
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2 volume_one">
                            <label for="v1" class="font-s-14 text-blue">{{ $lang['2'] }} (V₁):</label>
                            <div class="relative w-full ">
                                <input type="number" name="v1" id="v1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['v1'])?$_POST['v1']:'3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="v1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('v1_unit_dropdown')">{{ isset($_POST['v1_unit'])?$_POST['v1_unit']:'m³' }} ▾</label>
                                <input type="text" name="v1_unit" value="{{ isset($_POST['v1_unit'])?$_POST['v1_unit']:'m³' }}" id="v1_unit" class="hidden">
                                <div id="v1_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[44%] mt-1 right-0 hidden">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'mm³')">cubic millimeters (mm³)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'cm³')">cubic centimeters (cm³)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'dm³')">cubic decimeters (dm³)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'm³')">cubic meters (m³)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'in³')">cubic inches (in³)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'ft³')">cubic feet (ft³)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'yd³')">cubic yards (yd³)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'ml')">milliliters (ml)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'liters')">liters</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2 pressure_two">
                            <label for="p2" class="font-s-14 text-blue">{{ $lang['3'] }} (p₂):</label>
                            <div class="relative w-full ">
                                <input type="number" name="p2" id="p2" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['p2'])?$_POST['p2']:'3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="p2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('p2_unit_dropdown')">{{ isset($_POST['p2_unit'])?$_POST['p2_unit']:'Pa' }} ▾</label>
                                <input type="text" name="p2_unit" value="{{ isset($_POST['p2_unit'])?$_POST['p2_unit']:'Pa' }}" id="p2_unit" class="hidden">
                                <div id="p2_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[25%] mt-1 right-0 hidden">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'Pa')">Pa</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'Bar')">Bar</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'Torr')">Torr</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'psi')">psi</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'at')">at</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'atm')">atm</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'hPa')">hPa</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'MPa')">MPa</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'kPa')">kPa</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'GPa')">GPa</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'mmHg')">mmHg</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p2_unit', 'in Hg')">in Hg</p>
                               
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2 volume_two hidden">
                            <label for="v2" class="font-s-14 text-blue">{{ $lang['4'] }} (V₂):</label>
                            <div class="relative w-full ">
                                <input type="number" name="v2" id="v2" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['v2'])?$_POST['v2']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="v2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('v2_unit_dropdown')">{{ isset($_POST['v2_unit'])?$_POST['v2_unit']:'m³' }} ▾</label>
                                <input type="text" name="v2_unit" value="{{ isset($_POST['v2_unit'])?$_POST['v2_unit']:'m³' }}" id="v2_unit" class="hidden">
                                <div id="v2_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[54%] mt-1 right-0 hidden">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'mm³')">cubic millimeters (mm³)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'cm³')">cubic centimeters (cm³)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'dm³')">cubic decimeters (dm³)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'm³')">cubic meters (m³)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'in³')">cubic inches (in³)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'ft³')">cubic feet (ft³)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'yd³')">cubic yards (yd³)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'ml')">milliliters (ml)</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'liters')">liters</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2 temperature hidden">
                            <label for="temp" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="temp" id="temp" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['temp'])?$_POST['temp']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="temp_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('temp_unit_dropdown')">{{ isset($_POST['temp_unit'])?$_POST['temp_unit']:'°C' }} ▾</label>
                                <input type="text" name="temp_unit" value="{{ isset($_POST['temp_unit'])?$_POST['temp_unit']:'°C' }}" id="temp_unit" class="hidden">
                                <div id="temp_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[30%] mt-1 right-0 hidden">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_unit', '°C')">°C</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_unit', '°F')">°F</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_unit', 'K')">K</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2 relative amount hidden">
                            <label for="amount" class="font-s-14 text-blue">{!! $lang['6'] !!} (n):</label>
                            <input type="number" step="any" name="amount" id="amount" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['amount'])?$_POST['amount']:'8' }}" />
                            <span class="text-blue input_unit">mol</span>
                        </div>
                        <div class="space-y-2 relative gas hidden">
                            <label for="R" class="font-s-14 text-blue">{!! $lang['7'] !!} (R):</label>
                            <input type="number" step="any" name="R" id="R" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['R'])?$_POST['R']:'8.3144626' }}" />
                            <span class="text-blue input_unit">J⋅K⁻¹⋅mol⁻¹</span>
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
                <div class="w-full  rounded-lg mt-3">
                    <div class="w-full">
                        @if($detail['method']=="1" || $detail['method']=="3")
                            <div class="bg-[#F6FAFC] text-black border rounded-lg px-3 py-2">
                                <strong>{!! $detail['content'] !!} =</strong>
                                <strong class="text-[#119154] font-s-21">{!! round($detail['ans'],2) !!}<span class="text-[#119154]"> (m³) </span></strong>
                            </div>
                        @endif
                        @if($detail['method']=="2" || $detail['method']=="4")
                            <div class="bg-[#F6FAFC] text-black border rounded-lg px-3 py-2">
                                <strong>{!! $detail['content'] !!} =</strong>
                                <strong class="text-[#119154] font-s-21">{!! round($detail['ans'],2) !!}<span class="text-[#119154]"> (Pa) </span></strong>
                            </div>
                        @endif
                        @if($detail['method']=="5")
                            <div class="bg-[#F6FAFC] text-black border rounded-lg px-3 py-2">
                                <strong>{!! $detail['content'] !!} =</strong>
                                <strong class="text-[#119154] font-s-21">{!! $detail['pooran'] !!}<span class="text-[#119154]"> (K)</span></strong>
                            </div>
                            <p class="mt-3 mb-2"><strong>Results in other units:</strong></p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                <table class="col-12 col-lg-7" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                        <td class="border-b py-2 ps-2">{!! $detail['pooran']-273.15 !!} (°C)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 pe-2">{!! $detail['content'] !!}</td>
                                        <td class="py-2 ps-2">{!! ($detail['pooran']-273.15)*(9/5)+32 !!} (°F)</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if($detail['method']=="6")
                            <div class="col-12 text-center">
                                <p><strong>{!! $detail['content'] !!}</strong></p>
                                <p><strong class="text-[#119154] font-s-25">{!! $detail['final'] !!}</strong></p>
                            </div>
                        @endif
                        @if($detail['method']=="1" || $detail['method']=="2" || $detail['method']=="3" || $detail['method']=="4")
                            <div class="bg-[#F6FAFC] text-black border rounded-lg px-3 py-2 mt-2">
                                <strong>{!! $lang['5'] !!} (t) =</strong>
                                <strong class="text-[#119154] font-s-21">{!! $detail['temp'] !!} K</strong>
                            </div>
                            <div class="bg-[#F6FAFC] text-black border rounded-lg px-3 py-2 mt-2">
                                <strong>{!! $lang['6'] !!} (n) =</strong>
                                <strong class="text-[#119154] font-s-21">{!! $detail['n'] !!} mol</strong>
                            </div>
                        @endif
                        @if($detail['method']=="1" || $detail['method']=="3")
                            <p class="mt-3 mb-2"><strong>Results in other units:</strong></p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                <table class="col-12 col-lg-8" cellspacing="0">
                                    <tr>
                                    <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                    <td class="border-b py-2 ps-2">{!! round($detail['ans']*1000000000,4) !!} (mm³)</td>
                                    </tr>
                                    <tr>
                                    <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                    <td class="border-b py-2 ps-2">{!! round($detail['ans']*1000000,4) !!} (cm³)</td>
                                    </tr>
                                    <tr>
                                    <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                    <td class="border-b py-2 ps-2">{!! round($detail['ans']*1000,4) !!} (dm³)</td>
                                    </tr>
                                    <tr>
                                    <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                    <td class="border-b py-2 ps-2">{!! round($detail['ans']*61024,4) !!} (cu in)</td>
                                    </tr>
                                    <tr>
                                    <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                    <td class="border-b py-2 ps-2">{!! round($detail['ans']*35.315,4) !!} (cu ft)</td>
                                    </tr>
                                    <tr>
                                    <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                    <td class="border-b py-2 ps-2">{!! round($detail['ans']*1000000,4) !!} (ml)</td>
                                    </tr>
                                    <tr>
                                    <td class="py-2 pe-2">{!! $detail['content'] !!}</td>
                                    <td class="py-2 ps-2">{!! round($detail['ans']*1000,2) !!} (liters)</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if($detail['method']=="2" || $detail['method']=="4")
                            <p class="mt-3 mb-2"><strong>{!! $lang['8'] !!}:</strong></p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                <table class="col-12 col-lg-9" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                        <td class="border-b py-2 ps-2">{!! $detail['ans']*0.00001 !!} bars (bar)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                        <td class="border-b py-2 ps-2">{!! $detail['ans']*0.00014504 !!} pounds per square inch (psi)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                        <td class="border-b py-2 ps-2">{!! $detail['ans']*0.000010197 !!} technical atmospheres (at)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                        <td class="border-b py-2 ps-2">{!! $detail['ans']*0.00000987 !!} standard atmospheres (atm)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                        <td class="border-b py-2 ps-2">{!! $detail['ans']*0.0075 !!} torrs (Torr)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                        <td class="border-b py-2 ps-2">{!! $detail['ans']*0.01 !!} hectopascals (hPa)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                        <td class="border-b py-2 ps-2">{!! $detail['ans']*0.001 !!} kilopascals (kPa)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                        <td class="border-b py-2 ps-2">{!! $detail['ans']*0.000001 !!} megapascals (MPa)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                        <td class="border-b py-2 ps-2">{!! $detail['ans']*0.000000001 !!} megapascals (GPa)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{!! $detail['content'] !!}</td>
                                        <td class="border-b py-2 ps-2">{!! $detail['ans']*0.0002953 !!} inches of mercury (in Hg)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 pe-2">{!! $detail['content'] !!}</td>
                                        <td class="py-2 ps-2">{!! $detail['ans']*0.0075 !!} millimeters of mercury (mmHg)</td>
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
                    var a = document.getElementById("find").value;
                    var inputFields = document.querySelectorAll(".input-field");

                    inputFields.forEach(function(field) {
                        field.style.display = 'none';
                    });

                    if (a == "1") {
                        document.querySelectorAll(".pressure_one, .volume_one, .pressure_two").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "2") {
                        document.querySelectorAll(".pressure_one, .volume_one, .volume_two").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "3") {
                        document.querySelectorAll(".pressure_one, .volume_two, .pressure_two").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "4") {
                        document.querySelectorAll(".volume_one, .volume_two, .pressure_two").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "5") {
                        document.querySelectorAll(".volume_one, .amount, .gas").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "6") {
                        document.querySelectorAll(".volume_one, .gas, .temperature").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    }
                }

                updateFields();

                document.getElementById("find").addEventListener("change", function() {
                    updateFields();
                });
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>