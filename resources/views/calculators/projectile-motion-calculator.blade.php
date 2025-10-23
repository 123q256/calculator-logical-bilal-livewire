<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12">
                <div class="w-full mx-auto col-12 px-2 mt-0 mt-lg-2">
                    <label for="method" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <select class="input" name="method" id="method">
                            <option value="tof"
                                {{ isset($_POST['method']) && $_POST['method'] == 'tof' ? 'selected' : '' }}>
                                {{ $lang['2'] }}</option>
                            <option value="range"
                                {{ isset($_POST['method']) && $_POST['method'] == 'range' ? 'selected' : '' }}>
                                {{ $lang['3'] }}</option>
                            <option value="mh"
                                {{ isset($_POST['method']) && $_POST['method'] == 'mh' ? 'selected' : '' }}>
                                {{ $lang['4'] }}</option>
                            <option value="fp"
                                {{ isset($_POST['method']) && $_POST['method'] == 'fp' ? 'selected' : '' }}>
                                {{ $lang['5'] }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                <label for="v" class="font-s-14 text-blue">{{ $lang['12'] }} {{ $lang['8'] }} (V)</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="v" id="v" step="any"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['v']) ? $_POST['v'] : '30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="v_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('v_unit_dropdown')">{{ isset($_POST['v_unit'])?$_POST['v_unit']:'m/s' }} ▾</label>
                   <input type="text" name="v_unit" value="{{ isset($_POST['v_unit'])?$_POST['v_unit']:'m/s' }}" id="v_unit" class="hidden">
                   <div id="v_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="v_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'm/s')">m/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'km/h')">km/h</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'ft/s')">ft/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'mph')">mph</p>
                   </div>
                </div>
              </div>
              <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                <label for="a" class="font-s-14 text-blue">{{ $lang['6'] }} (α)</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="a" id="a" step="any"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['a']) ? $_POST['a'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="a_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('a_unit_dropdown')">{{ isset($_POST['a_unit'])?$_POST['a_unit']:'deg' }} ▾</label>
                   <input type="text" name="a_unit" value="{{ isset($_POST['a_unit'])?$_POST['a_unit']:'deg' }}" id="a_unit" class="hidden">
                   <div id="a_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="a_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'deg')">deg</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'rad')">rad</p>
                   </div>
                </div>
              </div>
              <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                <label for="h" class="font-s-14 text-blue">{{ $lang['12'] }} {{ $lang['7'] }} (h)</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="h" id="h" step="any"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['h']) ? $_POST['h'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="h_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('h_unit_dropdown')">{{ isset($_POST['h_unit'])?$_POST['h_unit']:'cm' }} ▾</label>
                   <input type="text" name="h_unit" value="{{ isset($_POST['h_unit'])?$_POST['h_unit']:'cm' }}" id="h_unit" class="hidden">
                   <div id="h_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="h_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'cm')">cm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'm')">m</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'km')">km</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'in')">in</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'ft')">ft</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'yd')">yd</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'mi')">mi</p>
                   </div>
                </div>
              </div>
              <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                <label for="g" class="font-s-14 text-blue">{{ $lang['9'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="g" id="g" step="any"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['g']) ? $_POST['g'] : '9.80665' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="g_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('g_unit_dropdown')">{{ isset($_POST['g_unit'])?$_POST['g_unit']:'m/s²' }} ▾</label>
                   <input type="text" name="g_unit" value="{{ isset($_POST['g_unit'])?$_POST['g_unit']:'m/s²' }}" id="g_unit" class="hidden">
                   <div id="g_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="g_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('g_unit', 'm/s²')">m/s²</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('g_unit', 'g')">g</p>
                   </div>
                </div>
              </div>
              <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="t">
                <label for="t1" class="font-s-14 text-blue">{{ $lang['10'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="t" id="t" step="any"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['t']) ? $_POST['t'] : '2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="t_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t_unit_dropdown')">{{ isset($_POST['t_unit'])?$_POST['t_unit']:'min' }} ▾</label>
                   <input type="text" name="t_unit" value="{{ isset($_POST['t_unit'])?$_POST['t_unit']:'min' }}" id="t_unit" class="hidden">
                   <div id="t_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="t_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'sec')">sec</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'min')">min</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'hrs')">hrs</p>
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
                    <div class="w-full md:w-[70%] lg:w-[70%]">
                        <table class="w-full font-s-18">
                            <tr>
                                <td class="py-2 border-b" width="70%">
                                    <strong>
                                        @if ($detail['check'] === 'tof')
                                            {{ $lang['2'] }}
                                        @elseif($detail['check'] === 'range')
                                            {{ $lang['3'] }}
                                        @elseif($detail['check'] === 'mh')
                                            {{ $lang['4'] }}
                                        @elseif($detail['check'] === 'fp')
                                            {{ $lang['8'] }}
                                        @endif
                                    </strong></td>
                                <td class="py-2 border-b">
                                    {{-- @if ($detail['check'] === 'tof')
                                        {{ $detail['tof'] }} sec
                                    @elseif($detail['check'] === 'range')
                                        {{ $detail['r'] }} m
                                    @elseif($detail['check'] === 'mh')
                                        {{ $detail['hmax'] }} m
                                    @elseif($detail['check'] === 'fp')
                                        {{ $detail['vel'] }} m/s
                                    @endif --}}
                                    @if ($detail['check'] === 'tof')
                                        <strong class="text-blue answer" data-value="{{ $detail['tof'] }}" id="resultValue">{{ $detail['tof'] }}</strong>
                                    @elseif($detail['check'] === 'range')
                                        <strong class="text-blue answer" data-value="{{ $detail['r'] }}" id="resultValue">{{ $detail['r'] }}</strong>
                                    @elseif($detail['check'] === 'mh')
                                        <strong class="text-blue answer" data-value="{{ $detail['hmax'] }}" id="resultValue">{{ $detail['hmax'] }}</strong>
                                    @elseif($detail['check'] === 'fp')
                                        <strong class="text-blue answer" data-value="{{ $detail['vel'] }}" id="resultValue">{{ $detail['vel'] }}</strong>
                                    @endif
                                    <select id="changeResultValue" name="changeResultValue" class="d-inline border-0 text-blue font-s-16" style="outline:none;border:none;width:100px">
                                        @if ($detail['check'] === 'tof')
                                            <option value="sec">sec</option>
                                            <option value="min">min</option>
                                            <option value="hrs">hrs</option>
                                        @elseif($detail['check'] === 'range' || $detail['check'] === 'mh')
                                            <option value="m">m</option>
                                            <option value="km">km</option>
                                            <option value="cm">cm</option>
                                            <option value="mm">mm</option>
                                            <option value="ft">ft</option>
                                            <option value="in">in</option>
                                            <option value="yd">yd</option>
                                            <option value="mi">mi</option>
                                            <option value="in">in</option>
                                        @elseif($detail['check'] === 'fp')
                                            <option value="m/s">m/s</option>
                                            <option value="km/h">km/h</option>
                                            <option value="ft/s">ft/s</option>
                                            <option value="mph">mph</option>
                                        @endif
                                    </select>
                                </td>
                            </tr>
            
                        </table>
                    </div>
                    <div class="w-full md:w-[70%] lg:w-[70%]">
                        <table class="w-full font-s-16">
                            <tr>
                                <td class="py-2 border-b" width="70%">{{ $lang['12'] }} {{ $lang['13'] }} {{ $lang['8'] }} (Vx)</td>
                                <td class="py-2 border-b">
                                    <span class="value-span" data-value="{{ $detail['vx'] }}">{{ $detail['vx'] }}</span>
                                    <select name="changeValues" class="unitSelect d-inline border-0 text-blue font-s-16" style="outline:none;border:none;width:100px">
                                        <option value="m/s">m/s</option>
                                        <option value="km/h">km/h</option>
                                        <option value="ft/s">ft/s</option>
                                        <option value="mph">mph</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%">{{ $lang['12'] }} {{ $lang['14'] }} {{ $lang['8'] }} (Vy)</td>
                                <td class="py-2 border-b">
                                    <span class="value-span" data-value="{{ $detail['vy'] }}">{{ $detail['vy'] }}</span>
                                    <select name="changeValues" class="unitSelect d-inline border-0 text-blue font-s-16" style="outline:none;border:none;width:100px">
                                        <option value="m/s">m/s</option>
                                        <option value="km/h">km/h</option>
                                        <option value="ft/s">ft/s</option>
                                        <option value="mph">mph</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%">{{ $lang['9'] }}</td>
                                <td class="py-2 border-b">
                                    <span id="gravityValue" data-value="{{ $detail['g'] }}">{{ $detail['g'] }}</span>
                                    <select id="changeGravityValue" name="changeGravityValue" class="d-inline border-0 text-blue font-s-16" style="outline:none;border:none;width:100px">
                                        <option value="m/s²">m/s²</option>
                                        <option value="g">g</option>
                                    </select>
                                </td>
                            </tr>
                            @if ($detail['check'] === 'fp')
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang['13'] }} {{ $lang['8'] }}</td>
                                    <td class="py-2 border-b">
                                        <span class="value-span" data-value="{{ $detail['hv'] }}">{{ $detail['hv'] }}</span>
                                        <select name="changeValues" class="unitSelect d-inline border-0 text-blue font-s-16" style="outline:none;border:none;width:100px">
                                            <option value="m/s">m/s</option>
                                            <option value="km/h">km/h</option>
                                            <option value="ft/s">ft/s</option>
                                            <option value="mph">mph</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang['14'] }} {{ $lang['8'] }}</td>
                                    <td class="py-2 border-b">
                                        <span class="value-span" data-value="{{ $detail['vv'] }}">{{ $detail['vv'] }}</span>
                                        <select name="changeValues" class="unitSelect d-inline border-0 text-blue font-s-16" style="outline:none;border:none;width:100px">
                                            <option value="m/s">m/s</option>
                                            <option value="km/h">km/h</option>
                                            <option value="ft/s">ft/s</option>
                                            <option value="mph">mph</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang['13'] }}
                                            {{ $lang['15'] }}</td>
                                    <td class="py-2 border-b">
                                        <span class="value-span" data-value="{{ $detail['x'] }}">{{ $detail['x'] }}</span>
                                        <select name="changeValues" class="unitSelect d-inline border-0 text-blue font-s-16" style="outline:none;border:none;width:100px">
                                            <option value="m">m</option>
                                            <option value="km">km</option>
                                            <option value="cm">cm</option>
                                            <option value="mm">mm</option>
                                            <option value="ft">ft</option>
                                            <option value="in">in</option>
                                            <option value="yd">yd</option>
                                            <option value="mi">mi</option>
                                            <option value="in">in</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">{{ $lang['7'] }}</td>
                                    <td class="py-2 border-b">
                                        <span class="value-span" data-value="{{ $detail['y'] }}">{{ $detail['y'] }}</span>
                                        <select name="changeValues" class="unitSelect d-inline border-0 text-blue font-s-16" style="outline:none;border:none;width:100px">
                                            <option value="m">m</option>
                                            <option value="km">km</option>
                                            <option value="cm">cm</option>
                                            <option value="mm">mm</option>
                                            <option value="ft">ft</option>
                                            <option value="in">in</option>
                                            <option value="yd">yd</option>
                                            <option value="mi">mi</option>
                                            <option value="in">in</option>
                                        </select>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        @if(isset($error) || isset($detail))
            var method = "{{ $_POST['method'] }}";
            if (method === 'fp') {
                document.getElementById('t').style.display = 'block';
            } else {
                document.getElementById('t').style.display = 'none';
            }
        @endif
        document.addEventListener('DOMContentLoaded', function() {
            'use strict';

            document.getElementById('method').addEventListener('change', function() {
                if (this.value === 'fp') {
                    document.getElementById('t').style.display = 'block';
                } else {
                    document.getElementById('t').style.display = 'none';
                }
            });
        });
    </script>
    @if(isset($detail))
        <script>
            document.getElementById('changeResultValue').addEventListener('change', function() {
                const resultElement = document.getElementById('resultValue');
                const originalValue = parseFloat(resultElement.getAttribute('data-value'));
                const selectedUnit = this.value;
                let convertedValue = originalValue;
                if (selectedUnit === 'sec') {
                    convertedValue = originalValue;
                } else if (selectedUnit === 'min') {
                    convertedValue = originalValue / 60;
                } else if (selectedUnit === 'hrs') {
                    convertedValue = originalValue / 3600;
                } else if (selectedUnit === 'm') {
                    convertedValue = originalValue;
                } else if (selectedUnit === 'km') {
                    convertedValue = originalValue / 1000;
                } else if (selectedUnit === 'cm') {
                    convertedValue = originalValue * 100;
                } else if (selectedUnit === 'mm') {
                    convertedValue = originalValue * 1000;
                } else if (selectedUnit === 'ft') {
                    convertedValue = originalValue * 3.28084;
                } else if (selectedUnit === 'in') {
                    convertedValue = originalValue * 39.3701;
                } else if (selectedUnit === 'yd') {
                    convertedValue = originalValue * 1.09361;
                } else if (selectedUnit === 'mi') {
                    convertedValue = originalValue / 1609.34;
                } else if (selectedUnit === 'm/s') {
                    convertedValue = originalValue;
                } else if (selectedUnit === 'km/h') {
                    convertedValue = originalValue * 3.6;
                } else if (selectedUnit === 'ft/s') {
                    convertedValue = originalValue * 3.28084;
                } else if (selectedUnit === 'mph') {
                    convertedValue = originalValue * 2.23694;
                }
                resultElement.textContent = convertedValue.toFixed(2);
            });
            document.getElementById('changeGravityValue').addEventListener('change', function() {
                const resultElement = document.getElementById('resultValue');
                const originalValue = parseFloat(resultElement.getAttribute('data-value'));
                const selectedUnit = this.value;
                let convertedValue = originalValue;

                const gravityElement = document.getElementById('gravityValue');
                const gravityValue = parseFloat(gravityElement.getAttribute('data-value'));
                const gravityUnit = this.value;
                let gravityConvertedValue = gravityValue;
                if (gravityUnit === 'm/s²') {
                    gravityConvertedValue = gravityValue;
                } else if (gravityUnit === 'g') {
                    gravityConvertedValue = gravityValue * 0.101971621298;
                }
                gravityElement.textContent = gravityConvertedValue.toFixed(2);
            });
            const conversionFactors = {
                'm/s': 1,
                'km/h': 3.6,
                'ft/s': 3.28084,
                'mph': 2.23694,
                'm': 1,           // base unit (meters)
                'km': 0.001,      // 1 meter = 0.001 kilometers
                'cm': 100,        // 1 meter = 100 centimeters
                'mm': 1000,       // 1 meter = 1000 millimeters
                'ft': 3.28084,    // 1 meter = 3.28084 feet
                'in': 39.3701,    // 1 meter = 39.3701 inches
                'yd': 1.09361,    // 1 meter = 1.09361 yards
                'mi': 0.000621371 // 1 meter = 0.000621371 miles
            };
            function convertValue(originalValue, fromUnit, toUnit) {
                return originalValue * (conversionFactors[toUnit] / conversionFactors[fromUnit]);
            }
            document.querySelectorAll('.unitSelect').forEach(select => {
                select.addEventListener('change', function() {
                    const span = this.previousElementSibling;
                    const originalValue = parseFloat(span.getAttribute('data-value'));
                    const selectedUnit = this.value;
                    const convertedValue = convertValue(originalValue, 'm/s', selectedUnit);
                    span.textContent = convertedValue.toFixed(2);
                });
            });
        </script>
    @endif
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>