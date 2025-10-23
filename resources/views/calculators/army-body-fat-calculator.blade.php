<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-6">
                    <label for="activeDuty" class="label">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="activeDuty" id="activeDuty" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = ["Yes", "No"];
                                $val = ["yes", "no"];
                                optionsList($val,$name,isset(request()->activeDuty)?request()->activeDuty:'yes');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="age" class="label">{!! $lang['2'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['age'])?$_POST['age']:'23' }}" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="gender" class="label">{!! $lang['3'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="gender" id="gender" class="input">
                            @php
                                $name = ["Male", "Female"];
                                $val = ["male", "female"];
                                optionsList($val,$name,isset(request()->gender)?request()->gender:'male');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-5 md:col-span-3 lg:col-span-3 hidden ft_in">
                    <label for="height_ft" class="label">{!! $lang['4'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="height_ft" id="height_ft" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['height_ft'])?$_POST['height_ft']:'6' }}" />
                    </div>
                </div>
                <div class="col-span-7 md:col-span-3 lg:col-span-3 hidden ft_in">
                    <label for="height_in" class="label">&nbsp;</label>
                    <input type="text" name="unit_ft_in" value="{{ isset($_POST['unit_ft_in'])?$_POST['unit_ft_in']:'cm' }}" id="unit_ft_in" class="hidden">
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height_in" id="height_in" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_in']) ? $_POST['height_in'] : '0' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="units1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units1_dropdown')">{{ isset($_POST['units1'])?$_POST['units1']:'ft/in' }} ▾</label>
                        <input type="text" name="units1" value="{{ isset($_POST['units1'])?$_POST['units1']:'ft/in' }}" id="units1" class="hidden">
                        <div id="units1_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units1">
                            <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'ft/in')">feet / inches (ft/in)</p>
                            <p value="ft" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'ft')">feet (ft)</p>
                            <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'in')">inch (in)</p>
                            <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'cm')">centimeters (cm)</p>
                            <p value="m" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'm')">meters (m)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 h_cm">
                    <label for="height_cm" class="label">{{ $lang['4'] }} <span class="text-blue height_unit">(cm)</span>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height_cm" id="height_cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_cm']) ? $_POST['height_cm'] : '183' }}" aria-label="input" placeholder="cm" oninput="checkInput()"/>
                        <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'cm' }} ▾</label>
                        <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'cm' }}" id="unit_h_cm" class="hidden">
                        <div id="unit_h_cm_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm">
                            <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft/in')">feet / inches (ft/in)</p>
                            <p value="ft" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft')">feet (ft)</p>
                            <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'in')">inch (in)</p>
                            <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">centimeters (cm)</p>
                            <p value="m" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'm')">meters (m)</p>
                        </div>
                     </div>
                </div>
             
              
                <div class="col-span-5 md:col-span-3 lg:col-span-3 hidden ft_in1">
                    <label for="neck_ft" class="label">{!! $lang['7'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="neck_ft" id="neck_ft" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['neck_ft'])?$_POST['neck_ft']:'0' }}" />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 lg:col-span-3 hidden ft_in1">
                    <label for="neck_in" class="label">&nbsp;</label>
                    <input type="text" name="unit_ft_in1" value="{{ isset($_POST['unit_ft_in1'])?$_POST['unit_ft_in1']:'cm' }}" id="unit_ft_in1" class="hidden">
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="neck_in" id="neck_in" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['neck_in']) ? $_POST['neck_in'] : '0' }}" aria-label="input" placeholder="cm" oninput="checkInput()"/>
                        <label for="unit_h1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h1_dropdown')">{{ isset($_POST['unit_h1'])?$_POST['unit_h1']:'cm' }} ▾</label>
                        <input type="text" name="unit_h1" value="{{ isset($_POST['unit_h1'])?$_POST['unit_h1']:'cm' }}" id="unit_h1" class="hidden">
                        <div id="unit_h1_dropdown" class="units_ft_in1 absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h1">
                            <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h1', 'ft/in')">feet / inches (ft/in)</p>
                            <p value="ft" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h1', 'ft')">feet (ft)</p>
                            <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h1', 'in')">inch (in)</p>
                            <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h1', 'cm')">centimeters (cm)</p>
                            <p value="m" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h1', 'm')">meters (m)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 h_cm1">
                    <label for="neck_cm" class="label">{{ $lang['7'] }} <span class="text-blue height_unit1">(cm)</span>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="neck_cm" id="neck_cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['neck_cm']) ? $_POST['neck_cm'] : '1' }}" aria-label="input" placeholder="cm" oninput="checkInput()"/>
                        <label for="unit_h_cm1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm1_dropdown')">{{ isset($_POST['unit_h_cm1'])?$_POST['unit_h_cm1']:'cm' }} ▾</label>
                        <input type="text" name="unit_h_cm1" value="{{ isset($_POST['unit_h_cm1'])?$_POST['unit_h_cm1']:'cm' }}" id="unit_h_cm1" class="hidden">
                        <div id="unit_h_cm1_dropdown" class="units_ft_in1 absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm1">
                            <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm1', 'ft/in')">feet / inches (ft/in)</p>
                            <p value="ft" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm1', 'ft')">feet (ft)</p>
                            <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm1', 'in')">inch (in)</p>
                            <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm1', 'cm')">centimeters (cm)</p>
                            <p value="m" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm1', 'm')">meters (m)</p>
                        </div>
                     </div>
                </div>
              
                <div class="col-span-5 md:col-span-3 lg:col-span-3 hidden ft_in2">
                    <label for="waist_ft" class="label">{!! $lang['8'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="waist_ft" id="waist_ft" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['waist_ft'])?$_POST['waist_ft']:'0' }}" />
                    </div>
                </div>
                <div class="col-span-7 md:col-span-3 lg:col-span-3 hidden ft_in2">
                    <label for="waist_in" class="label">&nbsp;</label>
                    <input type="text" name="unit_ft_in2" value="{{ isset($_POST['unit_ft_in2'])?$_POST['unit_ft_in2']:'cm' }}" id="unit_ft_in2" class="hidden">
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="waist_in" id="waist_in" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['waist_in']) ? $_POST['waist_in'] : '0' }}" aria-label="input" placeholder="in" oninput="checkInput()"/>
                        <label for="unit_h2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h2_dropdown')">{{ isset($_POST['unit_h2'])?$_POST['unit_h2']:'ft/in' }} ▾</label>
                        <input type="text" name="unit_h2" value="{{ isset($_POST['unit_h2'])?$_POST['unit_h2']:'ft/in' }}" id="unit_h2" class="hidden">
                        <div id="unit_h2_dropdown" class="units_ft_in2 absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h2">
                            <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h2', 'ft/in')">feet / inches (ft/in)</p>
                            <p value="ft" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h2', 'ft')">feet (ft)</p>
                            <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h2', 'in')">inch (in)</p>
                            <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h2', 'cm')">centimeters (cm)</p>
                            <p value="m" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h2', 'm')">meters (m)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 h_cm2">
                    <label for="waist_cm" class="label">{{ $lang['8'] }} <span class="text-blue height_unit2">(cm)</span>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="waist_cm" id="waist_cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['waist_cm']) ? $_POST['waist_cm'] : '2' }}" aria-label="input" placeholder="cm" oninput="checkInput()"/>
                        <label for="unit_h_cm2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm2_dropdown')">{{ isset($_POST['unit_h_cm2'])?$_POST['unit_h_cm2']:'cm' }} ▾</label>
                        <input type="text" name="unit_h_cm2" value="{{ isset($_POST['unit_h_cm2'])?$_POST['unit_h_cm2']:'cm' }}" id="unit_h_cm2" class="hidden">
                        <div id="unit_h_cm2_dropdown" class="units_ft_in2 absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm2">
                            <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm2', 'ft/in')">feet / inches (ft/in)</p>
                            <p value="ft" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm2', 'ft')">feet (ft)</p>
                            <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm2', 'in')">inch (in)</p>
                            <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm2', 'cm')">centimeters (cm)</p>
                            <p value="m" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm2', 'm')">meters (m)</p>
                        </div>
                     </div>
                </div>
              
                <div class="col-span-5 md:col-span-3 lg:col-span-3 hidden ft_in3">
                    <label for="hip_ft" class="label">{!! $lang['9'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="hip_ft" id="hip_ft" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['hip_ft'])?$_POST['hip_ft']:'1' }}" />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 lg:col-span-3 hidden ft_in3">
                    <label for="hip_in" class="label">&nbsp;</label>
                    <input type="text" name="unit_ft_in3" value="{{ isset($_POST['unit_ft_in3'])?$_POST['unit_ft_in3']:'cm' }}" id="unit_ft_in3" class="hidden">
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="hip_in" id="hip_in" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['hip_in']) ? $_POST['hip_in'] : '2' }}" aria-label="input" placeholder="cm" oninput="checkInput()"/>
                        <label for="unit_h3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h3_dropdown')">{{ isset($_POST['unit_h3'])?$_POST['unit_h3']:'cm' }} ▾</label>
                        <input type="text" name="unit_h3" value="{{ isset($_POST['unit_h3'])?$_POST['unit_h3']:'cm' }}" id="unit_h3" class="hidden">
                        <div id="unit_h3_dropdown" class="units_ft_in3 absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h3">
                            <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h3', 'ft/in')">feet / inches (ft/in)</p>
                            <p value="ft" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h3', 'ft')">feet (ft)</p>
                            <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h3', 'in')">inch (in)</p>
                            <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h3', 'cm')">centimeters (cm)</p>
                            <p value="m" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h3', 'm')">meters (m)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 h_cm3 hip_main hidden">
                    <label for="hip_cm" class="label">{{ $lang['9'] }} <span class="text-blue height_unit3">(cm)</span>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="hip_cm" id="hip_cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['hip_cm']) ? $_POST['hip_cm'] : '2' }}" aria-label="input" placeholder="cm" oninput="checkInput()"/>
                        <label for="unit_h_cm3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm3_dropdown')">{{ isset($_POST['unit_h_cm3'])?$_POST['unit_h_cm3']:'cm' }} ▾</label>
                        <input type="text" name="unit_h_cm3" value="{{ isset($_POST['unit_h_cm3'])?$_POST['unit_h_cm3']:'cm' }}" id="unit_h_cm3" class="hidden">
                        <div id="unit_h_cm3_dropdown" class="units_ft_in3 absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm3">
                            <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm3', 'ft/in')">feet / inches (ft/in)</p>
                            <p value="ft" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm3', 'ft')">feet (ft)</p>
                            <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm3', 'in')">inch (in)</p>
                            <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm3', 'cm')">centimeters (cm)</p>
                            <p value="m" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm3', 'm')">meters (m)</p>
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
                    <div class="w-full mt-2">
                        <p><strong>{{ $lang['10'] }}</strong></p>
                        <p><strong class="text-[32px] text-green-700">{{ round($detail['bodyFatPercentage'], 1) }} %</strong></p>
                        <p>{{ $detail['bodyFatCategory'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('gender').addEventListener('change', function() {
                if (this.value === 'female') {
                    document.querySelector('.hip_main').style.display = 'block';
                } else {
                    document.querySelectorAll('.hip_main, .ft_in3').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                }
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
                        document.getElementById('height_cm').setAttribute('placeholder', val)
                    }
                    
                    document.getElementById('unit_ft_in').value = val;
                    document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                        elem.classList.toggle('hidden');
                    });
                });
            });
            var units_ft_in = document.querySelectorAll('.units_ft_in1 p');
            units_ft_in.forEach(function(element) {
                element.addEventListener('click', function() {
                    var toAttr = this.closest('.units_ft_in1').getAttribute('to');
                    var val = this.getAttribute('value');

                    if (val == 'ft/in') {
                        document.querySelectorAll('.h_cm1').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.ft_in1').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.ft_in1 [for="unit_h1"]').textContent = val + ' ▾';
                    } else {
                        document.querySelectorAll('.ft_in1').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.h_cm1').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.h_cm1 [for="unit_h_cm1"]').textContent = val + ' ▾';
                        document.querySelector('.height_unit1').textContent = '('+val+')';
                        document.getElementById('neck_cm').setAttribute('placeholder', val)
                    }
                    
                    document.getElementById('unit_ft_in1').value = val;
                    document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                        elem.classList.toggle('hidden');
                    });
                });
            });
            var units_ft_in = document.querySelectorAll('.units_ft_in2 p');
            units_ft_in.forEach(function(element) {
                element.addEventListener('click', function() {
                    var toAttr = this.closest('.units_ft_in2').getAttribute('to');
                    var val = this.getAttribute('value');

                    if (val == 'ft/in') {
                        document.querySelectorAll('.h_cm2').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.ft_in2').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.ft_in2 [for="unit_h2"]').textContent = val + ' ▾';
                    } else {
                        document.querySelectorAll('.ft_in2').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.h_cm2').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.h_cm2 [for="unit_h_cm2"]').textContent = val + ' ▾';
                        document.querySelector('.height_unit2').textContent = '('+val+')';
                        document.getElementById('waist_cm').setAttribute('placeholder', val)
                    }
                    
                    document.getElementById('unit_ft_in2').value = val;
                    document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                        elem.classList.toggle('hidden');
                    });
                });
            });
            var units_ft_in = document.querySelectorAll('.units_ft_in3 p');
            units_ft_in.forEach(function(element) {
                element.addEventListener('click', function() {
                    var toAttr = this.closest('.units_ft_in3').getAttribute('to');
                    var val = this.getAttribute('value');

                    if (val == 'ft/in') {
                        document.querySelectorAll('.h_cm3').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.ft_in3').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.ft_in3 [for="unit_h3"]').textContent = val + ' ▾';
                    } else {
                        document.querySelectorAll('.ft_in3').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.h_cm3').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.h_cm3 [for="unit_h_cm3"]').textContent = val + ' ▾';
                        document.querySelector('.height_unit3').textContent = '('+val+')';
                        document.getElementById('hip_cm').setAttribute('placeholder', val)
                    }
                    
                    document.getElementById('unit_ft_in3').value = val;
                    document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                        elem.classList.toggle('hidden');
                    });
                });
            });

            @if(isset($detail) || isset($error))
                if (document.getElementById('gender').value === 'female') {
                    document.querySelector('.hip_main').style.display = 'block';
                    var val = document.getElementById('unit_ft_in3').value;
                    if (val === 'ft/in') {
                        document.querySelectorAll('.h_cm3').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.ft_in3').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.ft_in3 [for="unit_h3"]').textContent = val + ' ▾';
                    } else {
                        document.querySelectorAll('.ft_in3').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.h_cm3').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.h_cm3 [for="unit_h_cm3"]').textContent = val + ' ▾';
                        document.querySelector('.height_unit3').textContent = '('+val+')';
                        document.getElementById('hip_cm').setAttribute('placeholder', val)
                    }
                } else {
                    document.querySelectorAll('.hip_main, .ft_in3').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
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
                    document.getElementById('height_cm').setAttribute('placeholder', val)
                }
                var val = document.getElementById('unit_ft_in1').value;
                if (val === 'ft/in') {
                    document.querySelectorAll('.h_cm1').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.ft_in1').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.ft_in1 [for="unit_h1"]').textContent = val + ' ▾';
                } else {
                    document.querySelectorAll('.ft_in1').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.h_cm1').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.h_cm1 [for="unit_h_cm1"]').textContent = val + ' ▾';
                    document.querySelector('.height_unit1').textContent = '('+val+')';
                    document.getElementById('neck_cm').setAttribute('placeholder', val)
                }
                var val = document.getElementById('unit_ft_in2').value;
                if (val === 'ft/in') {
                    document.querySelectorAll('.h_cm2').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.ft_in2').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.ft_in2 [for="unit_h2"]').textContent = val + ' ▾';
                } else {
                    document.querySelectorAll('.ft_in2').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.h_cm2').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.h_cm2 [for="unit_h_cm2"]').textContent = val + ' ▾';
                    document.querySelector('.height_unit2').textContent = '('+val+')';
                    document.getElementById('waist_cm').setAttribute('placeholder', val)
                }
            @endif
        </script>
    @endpush
</form>