<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4"> 

            <p class="col-span-12"><strong>{{ $lang[1] }}</strong></p>
            <div class="col-span-12">
                <label for="temperature_air" class="font-s-14 text-blue"><?= $lang[2] ?>:</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="temperature_air" id="temperature_air" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['temperature_air'])?$_POST['temperature_air']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="temperature_air_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('temperature_air_unit_dropdown')">{{ isset($_POST['temperature_air_unit'])?$_POST['temperature_air_unit']:'°C' }} ▾</label>
                   <input type="text" name="temperature_air_unit" value="{{ isset($_POST['temperature_air_unit'])?$_POST['temperature_air_unit']:'°C' }}" id="temperature_air_unit" class="hidden">
                   <div id="temperature_air_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="temperature_air_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temperature_air_unit', '°C')">°C</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temperature_air_unit', '°F')">°F</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temperature_air_unit', 'k')">k</p>
                   </div>
                </div>
              </div>
            <p class="col-span-12"><strong>{{ $lang[3] }}</strong></p>
            <div class="col-span-12">
                <label for="select_unit" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="select_unit" id="select_unit" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = ["°C", "°F"];
                            $val = ["C", "°F"];
                            optionsList($val,$name,isset($_POST['select_unit'])?$_POST['select_unit']:'C');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="f_values" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="f_values" id="f_values" class="input hidden">
                        @php
                            $name = ["32 °F", "40 °F","50 °F","60 °F","70 °F","80 °F","90 °F","100 °F","120 °F","140 °F","160 °F","180 °F","200 °F","212 °F"];
                            $val = ["1403", "1424","1447.2","1467.3","1484.7","1499.3","1511.8","1522.5","1539","1551.7","1554.8","1553","1551","1543"];
                            optionsList($val,$name,isset($_POST['f_values'])?$_POST['f_values']:'1403');
                        @endphp
                    </select>
                    <select name="c_values" id="c_values" class="input">
                        @php
                            $name = ["0 °C","5 °C","10 °C","20 °C","30 °C","40 °C","50 °C","60 °C","70 °C","80 °C","90 °C","100 °C"];
                            $val = ["1403","1427","1447","1481","1507","1526","1541","1552","1555","1555","1550","1543"];
                            optionsList($val,$name,isset($_POST['f_values'])?$_POST['f_values']:'1403');
                        @endphp
                    </select>
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
                        $request = request();
                        $temperature_air_units = $request->temperature_air_units;
                        $temperature_air = $request->temperature_air;
                        $select_unit = $request->select_unit;
                        $f_values = $request->f_values;
                        $c_values = $request->c_values;
                    @endphp
                    <div class="w-full">
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['1'] }}</td>
                                    <td class="py-2 border-b"><strong class="text-blue">{{$detail['speedOfSound']}} m/s</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['3'] }}</td>
                                    <td class="py-2 border-b"><strong class="text-blue">{{$f_values}} m/s</strong></td>
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
        // Function to handle changes based on the unit type
        function handleUnitChange(unit) {
            var fValues = document.getElementById("f_values");
            var cValues = document.getElementById("c_values");

            if (unit === 'C') {
                fValues.style.display = 'none';
                cValues.style.display = 'block';
            } else {
                fValues.style.display = 'block';
                cValues.style.display = 'none';
            }
        }

        // Initial setup based on the current value of #select_unit
        var unit = document.getElementById('select_unit').value;
        handleUnitChange(unit);

        // Add event listener to handle changes when #select_unit value changes
        document.getElementById('select_unit').addEventListener('change', function() {
            var unit = this.value;
            handleUnitChange(unit);
        });

    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>