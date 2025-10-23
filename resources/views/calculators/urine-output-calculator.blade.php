<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="weight" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '80' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="weight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('weight_unit_dropdown')">{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }} ▾</label>
                        <input type="text" name="weight_unit" value="{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }}" id="weight_unit" class="hidden">
                        <div id="weight_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="weight_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'g')">grams (g)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'dag')">decagrams (dag)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'kg')">kilograms (kg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'oz')">ounces (oz)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'lbs')">pounds (lbs)</p>
                        </div>
                     </div>
                </div>
          
                <div class="col-span-6 md:col-span-3 lg:col-span-3 hidden ft_in">
                    <label for="time_min" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="time_min" id="time_min" class="input" aria-label="input" placeholder="min" value="{{ isset(request()->time_min)?request()->time_min:'10' }}" />
                    </div>
                </div>

                <div class="col-span-6 md:col-span-3 lg:col-span-3 hidden ft_in">
                    <label for="time_sec" class="font-s-14 text-blue">&nbsp;</label>
                    <input type="text" name="time_unit" value="{{ isset(request()->time_unit)?request()->time_unit:'sec' }}" id="time_unit" class="hidden">
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="time_sec" id="time_sec" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['time_sec']) ? $_POST['time_sec'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_h" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_dropdown')">{{ isset($_POST['unit_h'])?$_POST['unit_h']:'sec' }} ▾</label>
                        <input type="text" name="unit_h" value="{{ isset($_POST['unit_h'])?$_POST['unit_h']:'sec' }}" id="unit_h" class="hidden">
                        <div id="unit_h_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h">
                            <p value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'sec')">seconds (sec)</p>
                            <p value="min" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'min')">minutes (min)</p>
                            <p value="hrs" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'hrs')">hours (hrs)</p>
                            <p value="day" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'day')">day</p>
                            <p value="min/sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'min/sec')">minutes / second (min/sec)</p>
                            <p value="hrs/min" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'hrs/min')">hours / minute (hrs/min)</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 h_cm">
                    <label for="time" class="font-s-14 text-blue">{{ $lang['2'] }} <span class="text-blue timeUnit">(sec)</span>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="time" id="time" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['time']) ? $_POST['time'] : '24' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'sec' }} ▾</label>
                        <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'sec' }}" id="unit_h_cm" class="hidden">
                        <div id="unit_h_cm_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm">
                            <p value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'sec')">seconds (sec)</p>
                            <p value="min" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'min')">minutes (min)</p>
                            <p value="hrs" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'hrs')">hours (hrs)</p>
                            <p value="day" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'day')">day</p>
                            <p value="min/sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'min/sec')">minutes / second (min/sec)</p>
                            <p value="hrs/min" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'hrs/min')">hours / minute (hrs/min)</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="urine" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="urine" id="urine" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['urine']) ? $_POST['urine'] : '3000' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="urine_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('urine_unit_dropdown')">{{ isset($_POST['urine_unit'])?$_POST['urine_unit']:'ml' }} ▾</label>
                        <input type="text" name="urine_unit" value="{{ isset($_POST['urine_unit'])?$_POST['urine_unit']:'ml' }}" id="urine_unit" class="hidden">
                        <div id="urine_unit_dropdown" class=" absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="urine_unit">
                            <p value="mm³" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('urine_unit', 'mm³')">mm³</p>
                            <p value="cm³" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('urine_unit', 'cm³')">cm³</p>
                            <p value="dm³" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('urine_unit', 'dm³')">dm³</p>
                            <p value="cu in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('urine_unit', 'cu in')">cu in</p>
                            <p value="ml" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('urine_unit', 'ml')">ml</p>
                            <p value="cl" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('urine_unit', 'cl')">cl</p>
                            <p value="liters" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('urine_unit', 'liters')">liters</p>
                            <p value="us gal" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('urine_unit', 'us gal')">us gal</p>
                            <p value="uk gal" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('urine_unit', 'uk gal')">uk gal</p>
                            <p value="us fl oz" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('urine_unit', 'us fl oz')">us fl oz</p>
                            <p value="uk fl oz" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('urine_unit', 'uk fl oz')">uk fl oz</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="fluid" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="fluid" id="fluid" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fluid']) ? $_POST['fluid'] : '300' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="fluid_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fluid_unit_dropdown')">{{ isset($_POST['fluid_unit'])?$_POST['fluid_unit']:'ml' }} ▾</label>
                        <input type="text" name="fluid_unit" value="{{ isset($_POST['fluid_unit'])?$_POST['fluid_unit']:'ml' }}" id="fluid_unit" class="hidden">
                        <div id="fluid_unit_dropdown" class=" absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fluid_unit">
                            <p value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_unit', 'mm³')">mm³</p>
                            <p value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_unit', 'cm³')">cm³</p>
                            <p value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_unit', 'dm³')">dm³</p>
                            <p value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_unit', 'cu in')">cu in</p>
                            <p value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_unit', 'ml')">ml</p>
                            <p value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_unit', 'cl')">cl</p>
                            <p value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_unit', 'liters')">liters</p>
                            <p value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_unit', 'us gal')">us gal</p>
                            <p value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_unit', 'uk gal')">uk gal</p>
                            <p value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_unit', 'us fl oz')">us fl oz</p>
                            <p value="sec" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fluid_unit', 'uk fl oz')">uk fl oz</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="output_unit" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="output_unit" id="output_unit" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = ["g", "dag", "kg", "oz", "lb"];
                                $val = ["g", "dag", "kg", "oz", "lb"];
                                optionsList($val,$name,isset(request()->output_unit)?request()->output_unit:'kg');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="balance_unit" class="font-s-14 text-blue">{!! $lang['6'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="balance_unit" id="balance_unit" class="input">
                            @php
                                $name = ["mm³", "cm³", "dm³", "cu in", "ml", "cl", "liters", "us gal", "uk gal", "us fl oz", "uk fl oz"];
                                $val = ["mm³", "cm³", "dm³", "cu in", "ml", "cl", "liters", "us gal", "uk gal", "us fl oz", "uk fl oz"];
                                optionsList($val,$name,isset(request()->balance_unit)?request()->balance_unit:'ml');
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
                    
                    <div class="w-full  mt-3">
                        <div class="w-full mt-2">
                            <div class="w-full border-b pb-3">
                                <div class="grid grid-cols-12 gap-2">
                                    <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                        <p><strong>{{ $lang['7'] }}:</strong></p>
                                        <p>
                                            <strong class="text-green-500 text-[30px]">{{ round($detail['answer'], 4) }}</strong>
                                            <span class="text-blue-500 text-[18px]">(ml/{{ request()->output_unit }}/hr)</span>
                                        </p>
                                    </div>
                                    <div class="col-span-1 border-r hidden mf:block lg:block">&nbsp;</div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <p><strong>{{ $lang['8'] }}:</strong></p>
                                        <p>
                                            <strong class="text-green-500 text-[30px]">{{ round($detail['sec_answer'], 4)  }}</strong>
                                            <span class="text-blue-500 text-[18px]">({{ request()->balance_unit }})</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mt-3 ">
                                <p class="text-[18px]"><strong>{{ $lang['9'] }}:</strong></p>
                                <p><strong>{{ $lang['10'] }}.</strong></p>
                                <p>{{ $lang['11'] }} = {{ $lang['3'] }} / ({{ $lang['1'] }} × {{ $lang['2'] }})</p>
                                <p>{{ $lang['11'] }} = {{ request()->urine }} / ({{ request()->weight }} × {{ $detail['time_ans'] }})</p>
                                <p>{{ $lang['11'] }} = {{ round($detail['answer'], 4) }}</p>
                                <p class="mt-2"><strong>{{ $lang['12'] }}.</strong></p>
                                <p>{{ $lang['8'] }} = {{ $lang['4'] }} - {{ $lang['3'] }}</p>
                                <p>{{ $lang['8'] }} = {{ request()->urine }} - {{ request()->fluid }}</p>
                                <p>{{ $lang['8'] }} = {{ round($detail['sec_answer'], 4) }}</p>
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

                    if (val == 'min/sec' || val == 'hrs/min') {
                        document.querySelectorAll('.h_cm').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.ft_in').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.ft_in [for="unit_h"]').textContent = val + ' ▾';
                        let placeholder = val.split('/')
                        document.getElementById('time_min').setAttribute('placeholder', placeholder[0])
                        document.getElementById('time_sec').setAttribute('placeholder', placeholder[1])
                    } else {
                        document.querySelectorAll('.ft_in').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.h_cm').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.h_cm [for="unit_h_cm"]').textContent = val + ' ▾';
                        document.querySelector('.timeUnit').textContent = '('+val+')';
                        document.getElementById('time').setAttribute('placeholder', val)
                    }
                    
                    document.getElementById('time_unit').value = val;
                    document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                        elem.classList.toggle('hidden');
                    });
                });
            });
            @if(isset($detail) || isset($error))
                var val = document.getElementById('time_unit').value;
                if (val == 'min/sec' || val == 'hrs/min') {
                    document.querySelectorAll('.h_cm').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.ft_in').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.ft_in [for="unit_h"]').textContent = val + ' ▾';
                    let placeholder = val.split('/')
                    document.getElementById('time_min').setAttribute('placeholder', placeholder[0])
                    document.getElementById('time_sec').setAttribute('placeholder', placeholder[1])
                } else {
                    document.querySelectorAll('.ft_in').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.h_cm').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.h_cm [for="unit_h_cm"]').textContent = val + ' ▾';
                    document.querySelector('.timeUnit').textContent = '('+val+')';
                    document.getElementById('time').setAttribute('placeholder', val)
                }
            @endif
        </script>
    @endpush
</form>