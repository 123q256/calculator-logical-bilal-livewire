<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-3 lg:gap-3">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="age" class="label">{!! $lang['1'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['age'])?$_POST['age']:'23' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="gender" class="label">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2 relative">
                    <select name="gender" id="gender" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = [$lang['3'],$lang['4']];
                            $val = ["1","2"];
                            optionsList($val,$name,isset($_POST['gender'])?$_POST['gender']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-6 md:col-span-2 lg:col-span-2 ft_in">
                <label for="height_ft" class="label">{!! $lang['5'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="height_ft" id="height_ft" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['height_ft'])?$_POST['height_ft']:'5' }}" />
                </div>
            </div>
            <div class="col-span-6 md:col-span-4 lg:col-span-4 ft_in">
                <label for="" class="label">&nbsp;</label>
                <input type="text" name="unit_ft_in" value="{{ isset($_POST['unit_ft_in'])?$_POST['unit_ft_in']:'ft/in' }}" id="unit_ft_in" class="hidden">
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="height_in" id="height_in" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_in']) ? $_POST['height_in'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit_h" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_dropdown')">{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }} ▾</label>
                    <input type="text" name="unit_h" value="{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }}" id="unit_h" class="hidden">
                    <div id="unit_h_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h">
                        <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'ft/in')"> feet / inches (ft/in)</p>
                        <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'cm')">centimeters (cm)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden h_cm">
                <label for="height_cm" class="label">{{ $lang['5'] }} (cm):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="height_cm" id="height_cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_cm']) ? $_POST['height_cm'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'cm' }} ▾</label>
                    <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'cm' }}" id="unit_h_cm" class="hidden">
                    <div id="unit_h_cm_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm">
                        <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft/in')">feet / inches (ft/in)</p>
                        <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">centimeters (cm)</p>
                    </div>
                 </div>
            </div>
         
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="operations" class="label">{{ $lang['6'] }}:</label>
                <div class="w-100 py-2 relative">
                    <select name="operations" id="operations" class="input">
                        @php
                            $name = ["< 100 ".$lang['7'],"100-120 ".$lang['7'],$lang['8'],"120-160 ".$lang['7']];
                            $val = ["8.8","11.8","12.3","12.3"];
                            optionsList($val,$name,isset($_POST['operations'])?$_POST['operations']:'8.8');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="first" class="label">{{ $lang['9'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first']) ? $_POST['first'] : '72' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="units1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units1_dropdown')">{{ isset($_POST['units1'])?$_POST['units1']:'kg' }} ▾</label>
                    <input type="text" name="units1" value="{{ isset($_POST['units1'])?$_POST['units1']:'kg' }}" id="units1" class="hidden">
                    <div id="units1_dropdown" class=" absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units1">
                        <p value="kg" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'kg')">kilograms (kg)</p>
                        <p value="lbs" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'lbs')">pounds (lbs)</p>
                        <p value="stone" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'stone')">stone</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="second" class="label">{{ $lang['10'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second']) ? $_POST['second'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="units2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units2_dropdown')">{{ isset($_POST['units2'])?$_POST['units2']:'sec' }} ▾</label>
                    <input type="text" name="units2" value="{{ isset($_POST['units2'])?$_POST['units2']:'sec' }}" id="units2" class="hidden">
                    <div id="units2_dropdown" class=" absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units2">
                        <p value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'sec')">seconds (sec)</p>
                        <p value="min" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'min')">minutes (min)</p>
                        <p value="hrs" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'hrs')">hours (hrs)</p>
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
                        <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                    {{ $lang[11] }} = <span class="text-green font-s-25">{{ round($detail['cbr_ans'], 2) }}</span> (kcal/min)
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                    {{ $lang[12] }} = <span class="text-green font-s-25">{{ round($detail['cb_ans'], 2) }}</span> (kcal)
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                    BMR = <span class="text-green font-s-25">{{ round($detail['BMR'], 2) }}</span> (kcal/day)
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                    MET = <span class="text-green font-s-25">{{ $detail['met'] }}</span> (Mets/h)
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
                    } else {
                        document.querySelectorAll('.ft_in').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.h_cm').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                    }
                    
                    document.getElementById('unit_ft_in').value = val;
                    document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                        elem.classList.toggle('hidden');
                    });
                });
            });
            @isset($detail)
                var val = document.getElementById('unit_ft_in').value;
                if (val === 'ft/in') {
                    document.querySelectorAll('.h_cm').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.ft_in').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                } else {
                    document.querySelectorAll('.ft_in').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.h_cm').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                }
            @endisset
        </script>
    @endpush
</form>