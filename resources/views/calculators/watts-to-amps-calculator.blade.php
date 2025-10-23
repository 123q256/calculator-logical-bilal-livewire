<style>
    .velocitytab .v_active{
        border-bottom: 3px solid var(--light-blue);
    }
    .velocitytab .v_active strong{
        color: var(--light-blue);
    }
    .velocitytab p{
        position: relative;
        top: 2px;
    }
    .veloTabs:hover{
        background-color: gainsboro;
    }
    .active{
        background-color: var(--light-blue);;
        color: white;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <div class=" mx-auto mt-2  w-full">
               <div class="col-lg-3 font-s-14  d-lg-block">{{isset($lang['to_calc']) ? $lang['to_calc'] : "To Calculate"}}:</div>
               <input type="hidden" name="unit_type" id="unit_type" value="lbs">
               <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                   <div class="lg:w-1/2 w-full px-2 py-1">
                       <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  imperial" id="imperial">
                           <a href="{{url('amps-to-watts-calculator')}}/" class="cursor-pointer veloTabs  text-decoration-none "><strong>{{ isset($lang['1']) ? $lang['1'] : 'Watts to Amps' }}</strong></a>
                       </div>
                   </div>
                   <div class="lg:w-1/2 w-full px-2 py-1">
                       <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric tagsUnit" id="metric">
                           <strong>{{ $lang['2'] }}</strong>
                       </div>
                   </div>
               </div>
           </div>
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-2">
                <div class="col-12 px-2">
                    <label for="current_type" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="current_type" id="current_type" class="input" onchange="change_current(this)">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = ["$lang[4] (DC)","$lang[5] (AC) - $lang[6]","$lang[7] (AC) - $lang[8]"];
                                $val = ["DC","AC","ACT"];
                                optionsList($val,$name,isset($_POST['current_type'])?$_POST['current_type']:'DC');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-12 px-2">
                    <label for="power" class="font-s-14 text-blue"><?= $lang[9] ?> (<?= $lang[10] ?>):</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="power" id="power" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['power'])?$_POST['power']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="power_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('power_unit_dropdown')">{{ isset($_POST['power_unit'])?$_POST['power_unit']:'mW' }} ▾</label>
                       <input type="text" name="power_unit" value="{{ isset($_POST['power_unit'])?$_POST['power_unit']:'mW' }}" id="power_unit" class="hidden">
                       <div id="power_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="power_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'mW')">mW</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'W')">W</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('power_unit', 'kW')">kW</p>
                       </div>
                    </div>
                </div>
              
                <div class="col-12 px-2 hidden" id="voltage_type_div">
                    <label for="voltage_type" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="voltage_type" id="voltage_type" class="input">
                            @php
                                $name = [$lang[12],$lang[13]];
                                $val = ["ltl","ltn"];
                                optionsList($val,$name,isset($_POST['voltage_type'])?$_POST['voltage_type']:'ltl');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-12 px-2">
                    <label for="voltage" class="font-s-14 text-blue"><?= $lang[14] ?> (<?= $lang[15] ?>):</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="voltage" id="voltage" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['voltage'])?$_POST['voltage']:'120' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="voltage_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('voltage_unit_dropdown')">{{ isset($_POST['voltage_unit'])?$_POST['voltage_unit']:'mW' }} ▾</label>
                       <input type="text" name="voltage_unit" value="{{ isset($_POST['voltage_unit'])?$_POST['voltage_unit']:'mW' }}" id="voltage_unit" class="hidden">
                       <div id="voltage_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="voltage_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('voltage_unit', 'mV')">mV</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('voltage_unit', 'V')">V</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('voltage_unit', 'kV')">kV</p>
                       </div>
                    </div>
                </div>
                <div class="col-12 px-2 hidden" id="power_factor_div">
                    <label for="power_factor" class="font-s-14 text-blue"><?= $lang[16] ?> (≤1):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" type="any" name="power_factor" max="1" id="power_factor" class="input" value="{{ isset($_POST['power_factor'])?$_POST['power_factor']:'1' }}" aria-label="input" placeholder="00" />
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
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['17'] }} (amps)</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{round($detail['amps_ans'], 2)}} A</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['17'] }} ({{ $lang['18'] }})</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{round(($detail['amps_ans'] * 1000), 2)}} mA</strong></td>
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
@push('calculatorJS')
    <script>
        // Get the initial value of the dropdown
        var dropVal = document.getElementById('current_type').value;

        // Function to handle the visibility based on the dropdown value
        function handleVisibility(dropVal) {
            var powerFactorDiv = document.getElementById('power_factor_div');
            var voltageTypeDiv = document.getElementById('voltage_type_div');

            if (dropVal === "DC") {
                powerFactorDiv.style.display = 'none';
                voltageTypeDiv.style.display = 'none';
            } else if (dropVal === "AC") {
                powerFactorDiv.style.display = 'block';
                voltageTypeDiv.style.display = 'none';
            } else {
                powerFactorDiv.style.display = 'block';
                voltageTypeDiv.style.display = 'block';
            }
        }

        // Initial call to set visibility based on the current value
        handleVisibility(dropVal);

        // Function to be called when the dropdown value changes
        function changeCurrent(element) {
            var dropVal = element.value;
            handleVisibility(dropVal);
        }

        // Add an event listener to the dropdown to handle changes
        document.getElementById('current_type').addEventListener('change', function() {
            changeCurrent(this);
        });

    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>