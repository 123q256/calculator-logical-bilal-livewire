<style>
    .content table, .content th, .content td {
        border: 1px solid #9f9d9d;
        border-collapse: collapse;
        padding: 5px;
        text-align: center;
    }
    .content table tr:hover td {
        color: #fff !important;
        background-color: rgb(0, 0, 0) !important;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">


                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="weight" class="label">{!! $lang['1'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '170' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="w_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('w_unit_dropdown')">{{ isset($_POST['w_unit'])?$_POST['w_unit']:'kg' }} ▾</label>
                        <input type="text" name="w_unit" value="{{ isset($_POST['w_unit'])?$_POST['w_unit']:'kg' }}" id="w_unit" class="hidden">
                        <div id="w_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="w_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'kg')">kilograms (kg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'lbs')">pounds (lbs)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'stone')">stone</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'oz')">oz</p>
                        </div>
                     </div>
                </div>
          
            <div class="col-span-7 md:col-span-3 lg:col-span-3 ft_in">
                <label for="height_ft" class="label">{!! $lang['3'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="height_ft" id="height_ft" class="input" aria-label="input" placeholder="ft" value="{{ isset(request()->height_ft)?request()->height_ft:'5' }}" />
                </div>
            </div>
            <div class="col-span-5 md:col-span-3 lg:col-span-3 ft_in">
                <label for="height_in" class="label">&nbsp;</label>
                <input type="text" name="unit_ft_in" value="{{ isset(request()->unit_ft_in)?request()->unit_ft_in:'ft/in' }}" id="unit_ft_in" class="hidden">
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="height_in" id="height_in" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_in']) ? $_POST['height_in'] : '9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit_h" class=" absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_dropdown')">{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }} ▾</label>
                    <input type="text" name="unit_h" value="{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }}" id="unit_h" class="hidden">
                    <div id="unit_h_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h">
                        <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'ft/in')">feet / inches (ft/in)</p>
                        <p value="ft" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'ft')">feet (ft)</p>
                        <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'in')">inch (in)</p>
                        <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'cm')">centimeters (cm)</p>
                        <p value="m"  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'm')">meters (m)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden h_cm">
                <label for="height_cm" class="label">{{ $lang['3'] }} <span class="text-blue height_unit">(cm)</span>:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="height_cm" id="height_cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_cm']) ? $_POST['height_cm'] : '175.26' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit_h_cm" class=" absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }} ▾</label>
                    <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }}" id="unit_h_cm" class="hidden">
                    <div id="unit_h_cm_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm">
                        <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft/in')">feet / inches (ft/in)</p>
                        <p value="ft" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft')">feet (ft)</p>
                        <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'in')">inch (in)</p>
                        <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">centimeters (cm)</p>
                        <p value="m"  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'm')">meters (m)</p>
                    </div>
                 </div>
            </div>
           
         
            <div class="col-span-6">
                <label for="steps" class="label">{!! $lang['4'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="steps" id="steps" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->steps)?request()->steps:'400' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="speed" class="label">{!! $lang['5'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="speed" id="speed" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['6'],$lang['7'],$lang['8']];
                            $val = ["0.9","1.34","1.79"];
                            optionsList($val,$name,isset(request()->speed)?request()->speed:'0.9');
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
                    <div class="w-full p-3 mt-3">
                        <div class="w-full">
                            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <strong>{{ $lang[9] }} =</strong>
                                        <strong class="text-green font-s-32">{{ round($detail['cal_burn'], 2) }}</strong>
                                        <span class="text-blue">(kcal)</span>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <strong>{{ $lang[10] }} =</strong>
                                        <strong class="text-green font-s-32">{{ round($detail['cal_per'], 2) }}</strong>
                                        <span class="text-blue">(kcal)</span>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-2">{!! $detail['text'] !!}</p>
                            <p class="mt-1">{!! $detail['main_text'] !!}</p>
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

            @if(isset($detail) || isset($error))
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
            @endif
        </script>
    @endpush
</form>