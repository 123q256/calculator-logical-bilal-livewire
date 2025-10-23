@isset($detail)
    <style>
        .speech-bubble-area{
            position: absolute;
            width:18%;
            top: -29px;
            background:{{ $detail['color'] }};
            left: {{ $detail['left'] }};
            animation: bmi_res 0.5s
        }
        @keyframes bmi_res {
            from {left: 2%;}
            to {left: {{ $detail['left'] }}}
        }
        .speech-bubble:after{
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            bottom: 0;
            left: 40%;
            border: 8px solid transparent;
            border-bottom: 0;
            margin-bottom: -7px;
            border-top-color: {{ $detail['color'] }};
        }
    </style>
@endisset
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                    <label for="gender" class="label">{!! $lang['gen'] !!}:</label>
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
                                $name = [$lang['male'],$lang['female']];
                                $val = ["Male","Female"];
                                optionsList($val,$name,isset(request()->gender)?request()->gender:'Male');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                    <label for="age" class="label">{!! $lang['age'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->age)?request()->age:'25' }}" />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 lg:col-span-3 ft_in">
                    <label for="height_ft" class="label">{!! $lang['height'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="height_ft" id="height_ft" class="input" min="1" aria-label="input" placeholder="ft" value="{{ isset(request()->height_ft)?request()->height_ft:'5' }}" />
                    </div>
                </div>
                <div class="col-span-6 md:col-span-3 lg:col-span-3 ft_in">
                    <label for="height_in" class="label">&nbsp;</label>
                    <input type="text" name="unit_ft_in" value="{{ isset(request()->unit_ft_in)?request()->unit_ft_in:'ft/in' }}" id="unit_ft_in" class="hidden">
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="height_in" id="height_in" step="any"  min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_in']) ? $_POST['height_in'] : '9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit_h" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_dropdown')">{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }} ▾</label>
                            <input type="text" name="unit_h" value="{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }}" id="unit_h" class="hidden">
                            <div id="unit_h_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h">
                                <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'ft/in')">feet / inches (ft/in)</p>
                                <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'cm')">centimeters (cm)</p>
                            </div>
                        </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden h_cm">
                    <label for="height_cm" class="label">{{ $lang['height'] }} (cm):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height_cm" id="height_cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_cm']) ? $_POST['height_cm'] : '175.26' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }} ▾</label>
                        <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }}" id="unit_h_cm" class="hidden">
                        <div id="unit_h_cm_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm">
                            <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft/in')">feet / inches (ft/in)</p>
                            <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">centimeters (cm)</p>
                        </div>
                    </div>
                  </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="waist" class="label">{{ $lang['waist'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="waist" id="waist" step="any"  min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['waist']) ? $_POST['waist'] : '32' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'in' }} ▾</label>
                            <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'in' }}" id="unit" class="hidden">
                            <div id="unit_dropdown" class=" absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                                <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'in')">inches (in)</p>
                                <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'cm')">centimeters (cm)</p>
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
                    <div class="w-full md:w-[70%] lg:w-[70%]  mx-auto">
                        <div class="bg-[#F6FAFC] border rounded-lg px-3 py-3" style="border: 1px solid #c1b8b899;">
                            <span>{{ $lang['ans'] }} =</span>
                            <strong class="text-green text-[25px]">{{ ((isset($detail['ratio']))?$detail['ratio']:'0.0') }}</strong>
                        </div>
                        <div class="grid grid-cols-12 mt-[50px] mb-4 relative">
                            <div class="col-span-12 speech-bubble-area text-center radius-5 pt-2px">
                                <p class="speech-bubble text-white rounded-lg text-[13px] relative">{{ isset($detail['ratio']) ? $detail['ratio'] : '0.0' }}</p>
                            </div>
                            <div class="col-span-3 bg-blue text-center py-1 rounded-l pt-2px">
                                <p class="text-white text-[13px]">{{ $lang['under'] }}</p>
                            </div>
                            <div class="col-span-3 bg-green text-center py-1 pt-2px">
                                <p class="text-white text-[13px]">{{ $lang['health'] }}</p>
                            </div>
                            <div class="col-span-3 bg-turmeric text-center py-1 pt-2px">
                                <p class="text-white text-[13px]">{{ $lang['over'] }}</p>
                            </div>
                            <div class="col-span-3 bg-red text-center py-1 rounded-r pt-2px">
                                <p class="text-white text-[13px]">{{ $lang['obese'] }}</p>
                            </div>
                        </div>
                        <div class="w-full overflow-auto mt-3 mt-md-0">
                            <table class="w-full" cellspacing="2" >
                                <tr>
                                    <th class="text-start text-blue-700 py-2 px-2">{{ $lang['val'] }}</th>
                                    <th class="text-start text-blue-700 py-2 px-2">{{ $lang['clasi'] }}</th>
                                </tr>
                                <tr class="{{ isset($detail['xslim']) ? $detail['xslim'] : '' }}">
                                    <td class="border-b py-2 px-2">0.34 {{ $lang['and_b'] }}</td>
                                    <td class="border-b py-2 px-2">{{ $lang['xslim'] }}</td>
                                </tr>
                                <tr class="{{ isset($detail['slim']) ? $detail['slim'] : '' }}">
                                    <td class="border-b py-2 px-2">{{ (request()->gender=='Female') ? '0.35 to 0.41' : '0.35 to 0.42' }}</td>
                                    <td class="border-b py-2 px-2">{{ $lang['slim'] }}</td>
                                </tr>
                                <tr class="{{ isset($detail['health']) ? $detail['health'] : '' }}">
                                    <td class="border-b py-2 px-2">{{ (request()->gender=='Female') ? '0.42 to 0.48' : '0.43 to 0.52' }}</td>
                                    <td class="border-b py-2 px-2">{{ $lang['health'] }}</td>
                                </tr>
                                <tr class="{{ isset($detail['overc']) ? $detail['overc'] : '' }}">
                                    <td class="border-b py-2 px-2">{{ (request()->gender=='Female') ? '0.49 to 0.57' : '0.53 to 0.62' }}</td>
                                    <td class="border-b py-2 px-2">{{ $lang['over'] }}</td>
                                </tr>
                                <tr class="{{ isset($detail['overh']) ? $detail['overh'] : '' }}">
                                    <td class="py-2 px-2">{{ (request()->gender=='Female') ? '0.58' : '0.63' }} {{ $lang['and_a'] }}</td>
                                    <td class="py-2 px-2">{{ $lang['obese'] }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-center flex justify-center">
                            <img src="{{ asset('images/waist-min.png') }}" class="materialboxed" alt="Waist to Height Ratio Chart" width="500px" height="auto" style="width: 100%; max-width:400px">
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
                    document.querySelector('.ft_in [for="unit_h"]').textContent = val + ' ▾';
                } else {
                    document.querySelectorAll('.ft_in').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.h_cm').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.h_cm [for="unit_h_cm"]').textContent = val + ' ▾';
                }
            @endisset
        </script>
    @endpush
</form>