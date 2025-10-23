<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
            <div class="space-y-2 relative">
                <label for="calculation" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                <select name="calculation" id="calculation" class="input">
                    @php
                        function optionsList($arr1,$arr2,$unit){
                        foreach($arr1 as $index => $name){
                    @endphp
                        <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                            {!! $arr2[$index] !!}
                        </option>
                    @php
                        }}
                        $name = [ $lang['7']."(Tf)",$lang['3']."(Vi)",$lang['2']."(Pi)",$lang['4']."(Ti)",$lang['6']."(Vf)",$lang['5']."(Pf)"];
                        $val = ["1","2","3","4","5","6"];
                        optionsList($val,$name,isset(request()->calculation)?request()->calculation:'1');
                    @endphp
                </select>
            </div>
            <div class="space-y-2 input-field p_one">
                <label for="pressure_one" class="font-s-14 text-blue">{{ $lang['2'] }} (P<sub>i</sub>):</label>
                <div class="relative w-full ">
                    <input type="number" name="pressure_one" id="pressure_one" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pressure_one'])?$_POST['pressure_one']:'10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="pressure_one_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pressure_one_unit_dropdown')">{{ isset($_POST['pressure_one_unit'])?$_POST['pressure_one_unit']:'Pa' }} ▾</label>
                    <input type="text" name="pressure_one_unit" value="{{ isset($_POST['pressure_one_unit'])?$_POST['pressure_one_unit']:'Pa' }}" id="pressure_one_unit" class="hidden">
                    <div id="pressure_one_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[20%] mt-1 right-0 hidden">
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_one_unit', 'Pa')">Pa</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_one_unit', 'kPa')">kPa</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_one_unit', 'Bar')">Bar</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_one_unit', 'atm')">atm</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_one_unit', 'mmHg')">mmHg</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_one_unit', 'mbar')">mbar</p>
                   
                    </div>
                </div>
             </div>
             <div class="space-y-2 input-field v_one">
                <label for="volume_one" class="font-s-14 text-blue">{{ $lang['3'] }} (V<sub>i</sub>):</label>
                <div class="relative w-full ">
                    <input type="number" name="volume_one" id="volume_one" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['volume_one'])?$_POST['volume_one']:'12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="volume_one_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('volume_one_unit_dropdown')">{{ isset($_POST['volume_one_unit'])?$_POST['volume_one_unit']:'m³' }} ▾</label>
                    <input type="text" name="volume_one_unit" value="{{ isset($_POST['volume_one_unit'])?$_POST['volume_one_unit']:'m³' }}" id="volume_one_unit" class="hidden">
                    <div id="volume_one_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[45%] mt-1 right-0 hidden">
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_one_unit', 'm³')">cubic meters (m³)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_one_unit', 'l')">liters (l)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_one_unit', 'ml')">milliliters (ml)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_one_unit', 'ft³')">cubic feet (ft³)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_one_unit', 'in³')">cubic inches (in³)</p>
                    </div>
                </div>
             </div>
             <div class="space-y-2 input-field t_one">
                <label for="temp_one" class="font-s-14 text-blue">{{ $lang['4'] }} (T<sub>i</sub>):</label>
                <div class="relative w-full ">
                    <input type="number" name="temp_one" id="temp_one" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['temp_one'])?$_POST['temp_one']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="temp_one_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('temp_one_unit_dropdown')">{{ isset($_POST['temp_one_unit'])?$_POST['temp_one_unit']:'°C' }} ▾</label>
                    <input type="text" name="temp_one_unit" value="{{ isset($_POST['temp_one_unit'])?$_POST['temp_one_unit']:'°C' }}" id="temp_one_unit" class="hidden">
                    <div id="temp_one_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0 hidden">
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_one_unit', '°C')">°C</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_one_unit', '°F')">°F</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_one_unit', 'K')">K</p>
                    </div>
                </div>
             </div>
             <div class="space-y-2 input-field p_two">
                <label for="pressure_two" class="font-s-14 text-blue">{{ $lang['5'] }} (P<sub>f</sub>):</label>
                <div class="relative w-full ">
                    <input type="number" name="pressure_two" id="pressure_two" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pressure_two'])?$_POST['pressure_two']:'7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="pressure_two_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pressure_two_unit_dropdown')">{{ isset($_POST['pressure_two_unit'])?$_POST['pressure_two_unit']:'Pa' }} ▾</label>
                    <input type="text" name="pressure_two_unit" value="{{ isset($_POST['pressure_two_unit'])?$_POST['pressure_two_unit']:'Pa' }}" id="pressure_two_unit" class="hidden">
                    <div id="pressure_two_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[20%] mt-1 right-0 hidden">
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_two_unit', 'Pa')">Pa</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_two_unit', 'kPa')">kPa</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_two_unit', 'Bar')">Bar</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_two_unit', 'atm')">atm</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_two_unit', 'mmHg')">mmHg</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_two_unit', 'mbar')">mbar</p>
                    </div>
                </div>
             </div>
             <div class="space-y-2 input-field v_two">
                <label for="volume_two" class="font-s-14 text-blue">{{ $lang['3'] }} (V<sub>f</sub>):</label>
                <div class="relative w-full ">
                    <input type="number" name="volume_two" id="volume_two" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['volume_two'])?$_POST['volume_two']:'2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="volume_two_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('volume_two_unit_dropdown')">{{ isset($_POST['volume_two_unit'])?$_POST['volume_two_unit']:'m³' }} ▾</label>
                    <input type="text" name="volume_two_unit" value="{{ isset($_POST['volume_two_unit'])?$_POST['volume_two_unit']:'m³' }}" id="volume_two_unit" class="hidden">
                    <div id="volume_two_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[44%] mt-1 right-0 hidden">
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_two_unit', 'm³')">cubic meters (m³)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_two_unit', 'l')">liters (l)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_two_unit', 'ml')">milliliters (ml)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_two_unit', 'ft³')">cubic feet (ft³)</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_two_unit', 'in³')">cubic inches (in³)</p>
                    </div>
                </div>
             </div>

             <div class="space-y-2 input-field t_two hidden">
                <label for="temp_two" class="font-s-14 text-blue">{{ $lang['7'] }} (T<sub>f</sub>):</label>
                <div class="relative w-full ">
                    <input type="number" name="temp_two" id="temp_two" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['temp_two'])?$_POST['temp_two']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="temp_two_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('temp_two_unit_dropdown')">{{ isset($_POST['temp_two_unit'])?$_POST['temp_two_unit']:'°C' }} ▾</label>
                    <input type="text" name="temp_two_unit" value="{{ isset($_POST['temp_two_unit'])?$_POST['temp_two_unit']:'°C' }}" id="temp_two_unit" class="hidden">
                    <div id="temp_two_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0 hidden">
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_two_unit', '°C')">°C</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_two_unit', '°F')">°F</p>
                        <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_two_unit', 'K')">K</p>
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
                <div class="w-full p-3 radius-10 mt-3">
                    <div class="w-full">
                        @if($detail['method']=="1")
                            <p><strong>{!! $lang['7'] !!} (T<sub>f</sub>)</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! round($detail['temperature'],2) !!} (K)</strong></p>
                        @endif
                        @if($detail['method']=="2")
                            <p><strong>{!! $lang['3'] !!} (V<sub>i</sub>)</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! round($detail['volume'],2) !!} (m)<sup class="text-[#119154] text-[20px]">3</sup></strong></p>
                        @endif
                        @if($detail['method']=="3")
                            <p><strong>{!! $lang['2']; !!}(P<sub>i</sub>)</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! round($detail['pressure'],2) !!} (Pa)</strong></p>
                        @endif
                        @if($detail['method']=="6")
                            <p><strong>{!! $lang['5'] !!}(P<sub>f</sub>)</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! round($detail['pressure'],2) !!} (Pa)</strong></p>
                        @endif
                        @if($detail['method']=="4")
                            <p><strong>{!! $lang['4'] !!} (T<sub>i</sub>)</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! round($detail['temperature'],2) !!} (K)</strong></p>
                        @endif
                        @if($detail['method']=="5")
                            <p><strong>{!! $lang['6'] !!} (V<sub>f</sub>)</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! round($detail['volume'],2) !!} (m)<sup class="text-[#119154] text-[20px]">3</sup></strong></p>
                        @endif
                        @if($detail['method']=="1" || $detail['method']=="4")
                            <p class="mt-3 mb-2"><strong>Results in other units:</strong></p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                <table class="col-12 col-lg-7" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2 pe-2">
                                            @if($detail['method']=="1")
                                                <strong>{!! $lang['7'] !!} (T<sub>f</sub>)</strong>
                                            @elseif($detail['method']=="4")
                                                <strong>{!! $lang['4'] !!} (T<sub>i</sub>)</strong>
                                            @endif
                                        </td>
                                        <td class="border-b py-2 ps-2">{!! round($detail['temperature']-273.15,4) !!} (°C)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 pe-2">
                                            @if($detail['method']=="1")
                                                <strong>{!! $lang['7'] !!} (T<sub>f</sub>)</strong>
                                            @elseif($detail['method']=="4")
                                                <strong>{!! $lang['4'] !!} (T<sub>i</sub>)</strong>
                                            @endif
                                        </td>
                                        <td class="py-2 ps-2">{!! round(($detail['temperature']-273.15)*(9/5)+32,4) !!} (°F)</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if($detail['method']=="2" || $detail['method']=="5")
                            <p class="mt-3 mb-2"><strong>Results in other units:</strong></p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                <table class="col-12 col-lg-7" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2 pe-2">
                                            @if($detail['method']=="5")
                                                <strong>{!! $lang['6'] !!} (V<sub>f</sub>)</strong>
                                            @elseif($detail['method']=="2")
                                                <strong>{!! $lang['3'] !!} (V<sub>i</sub>)</strong>
                                            @endif    
                                            </td>
                                        <td class="border-b py-2 pe-2">{!! $detail['volume']/0.001 !!} liters (l)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">
                                            @if($detail['method']=="5")
                                                <strong>{!! $lang['6'] !!} (V<sub>f</sub>)</strong>
                                            @elseif($detail['method']=="2")
                                                <strong>{!! $lang['3'] !!} (V<sub>i</sub>)</strong>
                                            @endif    
                                            </td>
                                        <td class="border-b py-2 pe-2">{!! $detail['volume']/0.000001 !!} milliliters (ml)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">
                                            @if($detail['method']=="5")
                                                <strong>{!! $lang['6'] !!} (V<sub>f</sub>)</strong>
                                            @elseif($detail['method']=="2")
                                                <strong>{!! $lang['3'] !!} (V<sub>i</sub>)</strong>
                                            @endif    
                                            </td>
                                        <td class="border-b py-2 pe-2">{!! $detail['volume']/0.0283168 !!} cubic feet (ft³)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 pe-2">
                                            @if($detail['method']=="5")
                                                <strong>{!! $lang['6'] !!} (V<sub>f</sub>)</strong>
                                            @elseif($detail['method']=="2")
                                                <strong>{!! $lang['3'] !!} (V<sub>i</sub>)</strong>
                                            @endif    
                                            </td>
                                        <td class="py-2 pe-2">{!! $detail['volume']/1.63871e-5 !!} cubic inch (in³)</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @if($detail['method']=="3" || $detail['method']=="6")
                            <p class="mt-3 mb-2"><strong>Results in other units:</strong></p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                <table class="col-12 col-lg-9" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2 pe-2">
                                            @if($detail['method']=="6")
                                                <strong>{!! $lang['5'] !!}(P<sub>f</sub>)</strong>
                                            @elseif($detail['method']=="3")
                                                <strong>{!! $lang['2'] !!}(P<sub>i</sub>)</strong>
                                            @endif
                                        </td>
                                        <td class="border-b py-2 ps-2">{!! $detail['pressure']/1000 !!} kilopascals (kPa)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">
                                            @if($detail['method']=="6")
                                                <strong>{!! $lang['5'] !!}(P<sub>f</sub>)</strong>
                                            @elseif($detail['method']=="3")
                                                <strong>{!! $lang['2'] !!}(P<sub>i</sub>)</strong>
                                            @endif
                                        </td>
                                        <td class="border-b py-2 ps-2">{!! $detail['pressure']/100000 !!} bars (bar)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">
                                            @if($detail['method']=="6")
                                                <strong>{!! $lang['5'] !!}(P<sub>f</sub>)</strong>
                                            @elseif($detail['method']=="3")
                                                <strong>{!! $lang['2'] !!}(P<sub>i</sub>)</strong
                                            @endif
                                        </td>
                                        <td class="border-b py-2 ps-2">{!! $detail['pressure']/101325 !!} standard atmospheres (atm)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">
                                            @if($detail['method']=="6")
                                                <strong>{!! $lang['5'] !!}(P<sub>f</sub>)</strong>
                                            @elseif($detail['method']=="3")
                                                <strong>{!! $lang['2'] !!}(P<sub>i</sub>)</strong>
                                            @endif
                                        </td>
                                        <td class="border-b py-2 ps-2">{!! $detail['pressure']/100 !!} hectopascals (hPa)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 pe-2">
                                            @if($detail['method']=="6")
                                                <strong>{!! $lang['5'] !!}(P<sub>f</sub>)</strong>
                                            @elseif($detail['method']=="3")
                                                <strong>{!! $lang['2'] !!}(P<sub>i</sub>)</strong>
                                            @endif
                                        </td>
                                        <td class="py-2 ps-2">{!! $detail['pressure']/133.32 !!} millimeters of mercury (mmHg)</td>
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
                    var a = document.getElementById("calculation").value;
                    var inputFields = document.querySelectorAll(".input-field");

                    inputFields.forEach(function(field) {
                        field.style.display = 'none';
                    });

                    if (a == "1") {
                        document.querySelectorAll(".p_one, .v_one, .p_two, .v_two, .t_one").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "2") {
                        document.querySelectorAll(".p_one, .t_two, .p_two, .v_two, .t_one").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "3") {
                        document.querySelectorAll(".v_one, .t_two, .p_two, .v_two, .t_one").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "4") {
                        document.querySelectorAll(".v_one, .t_two, .p_two, .v_two, .p_one").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "5") {
                        document.querySelectorAll(".v_one, .t_two, .p_two, .t_one, .p_one").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "6") {
                        document.querySelectorAll(".v_one, .t_two, .v_two, .t_one, .p_one").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    }
                }

                updateFields();

                document.getElementById("calculation").addEventListener("change", function() {
                    updateFields();
                });
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>