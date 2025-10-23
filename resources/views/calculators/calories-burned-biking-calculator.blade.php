<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="age" class="label">{{ $lang['23'] }}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="age" id="age" min="1" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['age'])?$_POST['age']:'25' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="operations" class="label">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 relative">
                    <select name="operations" id="operations" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['2'],$lang['3']];
                            $val = ["Yes","No"];
                            optionsList($val,$name,isset($_POST['operations'])?$_POST['operations']:'No');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 drop_down">
                <label for="activity" class="label">{{ $lang['4'] }}:</label>
                <div class="w-full py-2 relative">
                    <select name="activity" id="activity" class="input">
                        @php
                            $name = [$lang['5'],$lang['6'],$lang['7'],$lang['8'],$lang['9'],$lang['10'],$lang['11'],$lang['12'],$lang['13']];
                            $val = ["8.5","4","6","8","10","12","16","5","5"];
                            optionsList($val,$name,isset($_POST['activity'])?$_POST['activity']:'4');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="f1">
                <label for="first" class="label">{{ $lang['14'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first']) ? $_POST['first'] : '13' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="units1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units1_dropdown')">{{ isset($_POST['units1'])?$_POST['units1']:'mW' }} ▾</label>
                    <input type="text" name="units1" value="{{ isset($_POST['units1'])?$_POST['units1']:'mW' }}" id="units1" class="hidden">
                    <div id="units1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units1">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'mW')">megawatt (mW)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'W')">watt (W)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'kW')">kilowatt (kW)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'BTU/h')">british thermal units per hour (BTU/h)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'hp(l)')">horsepower hp(l)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'kcal/min')">kilocalories per minute (kcal/min)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'kcal/h')">kilocalories per hour (kcal/h)</p>
                      
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" id="f2">
                <label for="second" class="label">{{ $lang['15'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second']) ? $_POST['second'] : '65' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="units2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units2_dropdown')">{{ isset($_POST['units2'])?$_POST['units2']:'lbs' }} ▾</label>
                    <input type="text" name="units2" value="{{ isset($_POST['units2'])?$_POST['units2']:'lbs' }}" id="units2" class="hidden">
                    <div id="units2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units2">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'lbs')">pounds (lbs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'kg')">kilograms (kg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'stone')">stone</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-6 md:col-span-3 lg:col-span-3 ft_in">
                <label for="height_ft" class="label">{!! $lang['24'] !!}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="height_ft" id="height_ft" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['height_ft'])?$_POST['height_ft']:'5' }}" />
                </div>
            </div>
            <div class="col-span-6 md:col-span-3 lg:col-span-3 ft_in">
                <label for="height_in" class="label">&nbsp;</label>
                <input type="text" name="unit_ft_in" value="{{ isset($_POST['unit_ft_in'])?$_POST['unit_ft_in']:'ft/in' }}" id="unit_ft_in" class="hidden">
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="height_in" id="height_in" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_in']) ? $_POST['height_in'] : '9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit_h" class=" absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_dropdown')">{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }} ▾</label>
                    <input type="text" name="unit_h" value="{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }}" id="unit_h" class="hidden">
                    <div id="unit_h_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h">
                        <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'ft/in')">feet / inches (ft/in)</p>
                        <p value="ft" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'ft')">feet (ft)</p>
                        <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'in')">inch (in)</p>
                        <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'cm')">centimeters (cm)</p>
                        <p value="m" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'm')">meters (m)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden h_cm">
                <label for="height_cm" class="label">{{ $lang['24'] }} <span class="text-blue height_unit">(cm)</span>:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="height_cm" id="height_cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_cm']) ? $_POST['height_cm'] : '175.26' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }} ▾</label>
                    <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }}" id="unit_h_cm" class="hidden">
                    <div id="unit_h_cm_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm">
                        <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft/in')">feet / inches (ft/in)</p>
                        <p value="ft" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft')">feet (ft)</p>
                        <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'in')">inch (in)</p>
                        <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">centimeters (cm)</p>
                        <p value="m" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'm')">meters (m)</p>
                    </div>
                 </div>
            </div>
         
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="gender" class="label">{{ $lang['25'] }}:</label>
                <div class="w-full py-2 relative">
                    <select name="gender" id="gender" class="input">
                        @php
                            $name = [$lang['26'],$lang['27']];
                            $val = ["male","female"];
                            optionsList($val,$name,isset($_POST['gender'])?$_POST['gender']:'male');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="met" class="label">MET:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="met" id="met" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['met'])?$_POST['met']:'4' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" id="f3">
                <label for="third" class="label">{{ $lang['16'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="units3" id="units3" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['units3']) ? $_POST['units3'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="units3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units3_dropdown')">{{ isset($_POST['units3'])?$_POST['units3']:'sec' }} ▾</label>
                    <input type="text" name="units3" value="{{ isset($_POST['units3'])?$_POST['units3']:'sec' }}" id="units3" class="hidden">
                    <div id="units3_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units3">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'sec')">seconds (sec)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'min')">minutes (min)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'hrs')">hours (hrs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'days')">days</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12">
                <span>{{ $lang[19] }}:</span>
                <span><a class="text-blue-500 font-s-14 text-decoration-none" href="{{ url('weightloss-calculator') }}/" target="_blank" rel="noopener">{{ $lang[20] }}</a></span>,
                <span><a class="text-blue-500 font-s-14 text-decoration-none" href="{{ url('calorie-deficit-calculator') }}/" target="_blank" rel="noopener">{{ $lang[21] }}</a></span>,
                <span><a class="text-blue-500 font-s-14 text-decoration-none" href="{{ url('bmr-calculator') }}/" target="_blank" rel="noopener">{{ $lang[22] }}</a></span>
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
                            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                        <strong>{{ $lang[17] }} = <span class="text-[#119154] text-[28px]">{{ round($detail['calories'], 2) }}</span> kcal</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                        <strong>{{ $lang[18] }} = <span class="text-[#119154] text-[28px]">{{ round($detail['w_loss'], 2) }}</span> kg</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                        <strong>BMR = <span class="text-[#119154] text-[28px]">{{ $detail['bmr_ans'] }}</span> kcal/day</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                        <strong>{{ $lang[28] }} = <span class="text-[#119154] text-[28px]">{{ $detail['exercise'] }}</span> Mets</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('operations').addEventListener('change', function() {
                var cal = this.value;
                if (cal === 'Yes') {
                    document.querySelectorAll('.drop_down').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.getElementById('f1').style.display = 'block';
                } else if (cal === 'No') {
                    document.querySelectorAll('.drop_down').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.getElementById('f1').style.display = 'none';
                }
            });

            document.getElementById('activity').addEventListener('change', function() {
                var v2 = this.value;
                document.getElementById('met').value = v2;
            });

            var units_ft_in = document.querySelectorAll('.units_ft_in p');
            units_ft_in.forEach(function(element) {
                element.addEventListener('click', function() {
                    var toAttr = this.closest('.units_ft_in').getAttribute('to');
                    var val = this.getAttribute('value');

                    if (val == 'ft/in') {
                        document.querySelectorAll('.h_cm').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.ft_in').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.ft_in [for="unit_h"]').textContent = val + ' ▾';
                    } else {
                        document.querySelectorAll('.ft_in').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.h_cm').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.h_cm [for="unit_h_cm"]').textContent = val + ' ▾';
                        document.querySelector('.height_unit').textContent = '('+val+')';
                        document.getElementById('height-cm').setAttribute('placeholder', val)
                    }
                    
                    document.getElementById('unit_ft_in').value = val;
                    document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                        elem.classList.toggle('hidden');
                    });
                });
            });
            @if(isset($detail) || isset($error))
                var cal = document.getElementById('operations').value;
                if (cal === 'Yes') {
                    document.querySelectorAll('.drop_down').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.getElementById('f1').style.display = 'block';
                } else if (cal === 'No') {
                    document.querySelectorAll('.drop_down').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.getElementById('f1').style.display = 'none';
                }

                var val = document.getElementById('unit_ft_in').value;
                if (val === 'ft/in') {
                    document.querySelectorAll('.h_cm').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.ft_in').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.ft_in [for="unit_h"]').textContent = val + ' ▾';
                } else {
                    document.querySelectorAll('.ft_in').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.h_cm').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.h_cm [for="unit_h_cm"]').textContent = val + ' ▾';
                    document.querySelector('.height_unit').textContent = '('+val+')';
                    document.getElementById('height-cm').setAttribute('placeholder', val)
                }
            @endif
        </script>
    @endpush
</form>