<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4 ">

                <div class="col-span-12 md:col-span-5 lg:col-span-5">
                    <label for="weight" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '75' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="weight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('weight_unit_dropdown')">{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }} ▾</label>
                        <input type="text" name="weight_unit" value="{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }}" id="weight_unit" class="hidden">
                        <div id="weight_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="weight_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'kg')">kilograms (kg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'lbs')">pounds (lbs)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'stone')">stone</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 md:col-span-2 lg:col-span-3 hidden ft_in">
                    <label for="hour" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="hour" id="hour" class="input" aria-label="input" placeholder="hours" value="{{ isset(request()->hour)?request()->hour:'9' }}" />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-4 lg:col-span-4  hidden ft_in">
                    <label for="min" class="font-s-14 text-blue">&nbsp;</label>
                    <input type="text" name="unit_hrs_min" value="{{ isset(request()->unit_hrs_min)?request()->unit_hrs_min:'sec' }}" id="unit_hrs_min" class="hidden">
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="min" id="min" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['min']) ? $_POST['min'] : '75' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_h" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_dropdown')">{{ isset($_POST['unit_h'])?$_POST['unit_h']:'sec' }} ▾</label>
                        <input type="text" name="unit_h" value="{{ isset($_POST['unit_h'])?$_POST['unit_h']:'sec' }}" id="unit_h" class="hidden">
                        <div id="unit_h_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h">
                            <p  value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'sec')">seconds (sec)</p>
                            <p value="min" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'min')">minutes (min)</p>
                            <p value="hrs" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'hrs')">hours (hrs)</p>
                            <p value="hrs/min" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'hrs/min')">hours / minute (hrs/min)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 h_cm">
                    <label for="time" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="time" id="time" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['time']) ? $_POST['time'] : '75' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'sec' }} ▾</label>
                        <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'sec' }}" id="unit_h_cm" class="hidden">
                        <div id="unit_h_cm_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm">
                            <p  value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'sec')">seconds (sec)</p>
                            <p value="min" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'min')">minutes (min)</p>
                            <p value="hrs" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'hrs')">hours (hrs)</p>
                            <p value="hrs/min" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'hrs/min')">hours / minute (hrs/min)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-5 lg:col-span-5">
                    <label for="effort_unit" class="font-s-14 text-blue">{!! $lang['3'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="effort_unit" id="effort_unit" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = ["Light (MET = 4.6)", "Moderate (MET = 4.9)", "Vigorous (MET = 5.7)", "Custom (enter MET value)"];
                                $val = ["Light (MET = 4.6)", "Moderate (MET = 4.9)", "Vigorous (MET = 5.7)", "Custom (enter MET value)"];
                                optionsList($val,$name,isset(request()->effort_unit)?request()->effort_unit:'Moderate (MET = 4.9)');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="mets">
                    <label for="effort" class="font-s-14 text-blue">{!! $lang['4'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="effort" id="effort" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->effort)?request()->effort:'4.9' }}" />
                        <span class="text-blue input_unit">%</span>
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
                        <div class="w-full md:w-[80%] lg:w-[80%] flex flex-md-row justify-between">

                            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                            <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                <p><strong>{{ $lang['5'] }}</strong></p>
                                <p>
                                    <strong class="text-green-700 text-[32px]">{{ round($detail['answer']) }}</strong>
                                    <span class="text-blue-700">kcal</span>
                                </p>
                            </div>
                            <div class="col-span-1 border-r-2  me-3 hidden lg:block md:block">&nbsp;</div>
                            <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                <p><strong>{{ $lang['6'] }}</strong></p>
                                <p>
                                    <strong class="text-green-700 text-[32px]">{{ round($detail['sub_answer']) }}</strong>
                                    <span class="text-blue-700">kcal</span>
                                </p>
                            </div>
                            </div>
                        </div>
                        <p><strong>{{ $lang['7'] }}</strong></p>
                        <p>{{ $lang['8'] }}.</p>
                        <p>{{ $lang['9'] }} = {{ $lang['12'] }} (in sec)* {{ $lang['3'] }} * 3.5 * {{ $lang['1'] }} (in kg) / (200 * 60)</p>
                        <p>{{ $lang['9'] }} = {{ $detail['time'] }} * {{ request()->effort }} * 3.5 * {{ $detail['weight'] }} / (200 * 60)</p>
                        <p>{{ $lang['9'] }} = {{ round($detail['answer']) }}kcal</p>
                        <p>{{ $lang['10'] }}</p>
                        <p>{{ $lang['11'] }} = 60 * {{ $lang['3'] }} * 3.5 * {{ $lang['1'] }} (in kg) / 200</p>
                        <p>{{ $lang['11'] }} = 60 * {{ request()->effort }} * 3.5 * {{ $detail['weight'] }} / 200</p>
                        <p>{{ $lang['11'] }} = {{ round($detail['sub_answer']) }}kcal</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
    @push('calculatorJS')
        <script>
            let effort_unit = document.getElementById('effort_unit').value;
            if (effort_unit === 'Custom (enter MET value)') {
                document.getElementById('mets').style.display = 'block';
            } else {
                document.getElementById('mets').style.display = 'none';
            }
            document.getElementById('effort_unit').addEventListener('change', function() {
                let effort_unit = this.value;
                if (effort_unit === 'Custom (enter MET value)') {
                    document.getElementById('mets').style.display = 'block';
                } else {
                    document.getElementById('mets').style.display = 'none';
                }
            });

            var units_ft_in = document.querySelectorAll('.units_ft_in p');
            units_ft_in.forEach(function(element) {
                element.addEventListener('click', function() {
                    var toAttr = this.closest('.units_ft_in').getAttribute('to');
                    var val = this.getAttribute('value');

                    if (val == 'hrs/min') {
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
                        document.getElementById('time').setAttribute('placeholder', val)
                    }
                    
                    document.getElementById('unit_hrs_min').value = val;
                    document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                        elem.classList.toggle('hidden');
                    });
                });
            });

            @if(isset($detail) || isset($error))
                var val = document.getElementById('unit_hrs_min').value;
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
                    document.getElementById('time').setAttribute('placeholder', val)
                }
            @endif
        </script>
    @endpush
</form>