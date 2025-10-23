<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="age" class="label">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->age)?request()->age:'24' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="gender" class="label">{!! $lang['2'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="gender" id="gender" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['3'],$lang['4']];
                                $val = ["male","female"];
                                optionsList($val,$name,isset($_POST['gender'])?$_POST['gender']:'male');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 lg:col-span-3 ft_in">
                    <label for="height_ft" class="label">{!! $lang['5'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="height_ft" id="height_ft" min="0" class="input" aria-label="input" placeholder="ft" value="{{ isset(request()->height_ft)?request()->height_ft:'5' }}" />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 lg:col-span-3 ft_in">
                    <label for="height_in" class="label">&nbsp;</label>
                    <input type="text" name="unit_ft_in" value="{{ isset(request()->unit_ft_in)?request()->unit_ft_in:'ft/in' }}" id="unit_ft_in" class="hidden">
                   <div class="relative w-full mt-[7px]">
                    <input type="number" name="height_in" id="height_in" step="any" min="0"   class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_in']) ? $_POST['height_in'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit_h" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_dropdown')">{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }} ▾</label>
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
                    <label for="height_cm" class="label">{{ $lang['5'] }} <span class="text-blue height_unit">(cm)</span>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height_cm" id="height_cm" step="any" min="0"   class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_cm']) ? $_POST['height_cm'] : '175.26' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_h_cm" class=" absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }} ▾</label>
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
                    <label for="weight" class="label">{!! $lang['6'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="weight" id="weight" step="any" min="0"   class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '175.26' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="weight_unit" class=" absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('weight_unit_dropdown')">{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }} ▾</label>
                        <input type="text" name="weight_unit" value="{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }}" id="weight_unit" class="hidden">
                        <div id="weight_unit_dropdown" class=" absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="weight_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'g')">grams (g)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'kg')">kilograms (kg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'lbs')">pounds (lbs)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'stone')">stone</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="activity_level" class="label">{!! $lang['10'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="activity_level" id="activity_level" class="input">
                            @php
                                $name = [$lang[11],$lang[12],$lang[13],$lang[14],$lang[15]];
                                $val = ["sedentary","light","moderate","very_active","extra_active"];
                                optionsList($val,$name,isset(request()->activity_level)?request()->activity_level:'sedentary');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="protein_for" class="label">{!! $lang['16'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="protein_for" id="protein_for" class="input">
                            @php
                                $name = [$lang[17],$lang[18]];
                                $val = ["general","sport"];
                                optionsList($val,$name,isset(request()->protein_for)?request()->protein_for:'general');
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
                    <div class="w-full ">
                        <div class="w-full  border-b pb-2">
                            <p><strong>{{ $lang[31] }}</strong></p>
                            <p class="text-[32px]"><strong class="text-green-700">{{ round($detail['calories']) }}</strong></p>
                        </div>
                        <div class="w-full  mt-3">
                            <p class="text-[18px] mb-1"><strong class="text-blue-700">{{ $lang[21] }}</strong></p>
                            @if(request()->protein_for === "general")
                                <p class="mb-1">
                                    {{ $lang[27] }}: <strong>{{ round($detail['calories'] * 0.1 / 4) }} - {{ round($detail['calories'] * 0.30 / 4) }} {{ $lang[32] }} ({{ round( $detail['calories'] * 0.1) }} - {{ round($detail['calories'] * 0.30) }} kcal)</strong>
                                </p>
                                <p>
                                    {{ $lang[28] }}: <strong>{{ round($detail['weight_kg'] * 0.83) }} {{ $lang[32] }} ({{ round($detail['weight_kg'] * 0.83*4) }} kcal)</strong>
                                </p>
                            @else
                                <p>
                                    {{ $lang[22] }}: <strong>{{ round($detail['weight_kg'] * 0.8) }} {{ $lang[32] }}</strong> ({{ round($detail['weight_kg'] * 0.8 * 4) }}kcal)
                                </p>
                                <p>
                                    {{ $lang[23] }}: <strong>{{ round($detail['weight_kg']) }} {{ $lang[32] }}</strong> ({{ round($detail['weight_kg'] * 4) }} kcal)
                                </p>
                                <p>
                                    {{ $lang[24] }}: <strong>{{ round($detail['weight_kg']*1.3) }} {{ $lang[32] }}</strong> ({{ round($detail['weight_kg']*1.3*4) }} kcal)
                                </p>
                                <p>
                                    {{ $lang[25] }}: <strong>{{ round($detail['weight_kg']*1.6) }} {{ $lang[32] }}</strong> ({{ round($detail['weight_kg']*1.6*4) }} kcal)
                                </p>
                                <p>
                                    {{ $lang[26] }}: <strong>{{ round($detail['weight_kg']*2) }} {{ $lang[32] }}</strong> ({{ round($detail['weight_kg']*2*4) }} kcal)
                                </p>
                                <p>
                                    <strong>❗ {{ $lang[30] }}</strong>
                                </p>
                            @endif
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

            @if(isset($error))
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