<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @unless(isset($detail))

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

                        <div class="col-span-6 md:col-span-2 lg:col-span-2 ft_in">
                            <label for="height_ft" class="label">{!! $lang['1'] !!}:</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="height_ft" id="height_ft" min="1" class="input" aria-label="input" placeholder="ft" value="{{ isset(request()->height_ft)?request()->height_ft:'5' }}" />
                            </div>
                        </div>

                        <div class="col-span-6 md:col-span-4 lg:col-span-4 ft_in">
                            <label for="height_in" class="label">&nbsp;</label>
                            <input type="text" name="unit_ft_in" value="{{ isset(request()->unit_ft_in)?request()->unit_ft_in:'ft/in' }}" id="unit_ft_in" class="hidden">
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="height_in" id="height_in" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_in']) ? $_POST['height_in'] : '9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
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
                            <label for="height_cm" class="label">{{ $lang['1'] }} <span class="text-blue height_unit">(cm)</span>:</label>
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
                            <label for="weight" class="label">{!! $lang['2'] !!}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '175.26' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="w_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('w_unit_dropdown')">{{ isset($_POST['w_unit'])?$_POST['w_unit']:'kg' }} ▾</label>
                                <input type="text" name="w_unit" value="{{ isset($_POST['w_unit'])?$_POST['w_unit']:'kg' }}" id="w_unit" class="hidden">
                                <div id="w_unit_dropdown" class=" absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="w_unit">
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'lbs')">pounds (lbs)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'oz')">ounces (oz)</p>
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'kg')">kilograms (kg)</p>
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'stone')">stone</p>
                                </div>
                             </div>
                        </div>
                   
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="week" class="label">{!! $lang['3'] !!}:</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" name="week" id="week" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->week)?request()->week:'25' }}" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="activity" class="label">{!! $lang['4'] !!}:</label>
                            <div class="w-100 py-2 position-relative">
                                <select name="activity" id="activity" class="input">
                                    @php
                                        function optionsList($arr1,$arr2,$unit){
                                        foreach($arr1 as $index => $name){
                                    @endphp
                                        <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                            {!! $arr2[$index] !!}
                                        </option>
                                    @php
                                        }}
                                        $name = [$lang['5'],$lang['6']];
                                        $val = ["0","1"];
                                        optionsList($val,$name,isset($_POST['activity'])?$_POST['activity']:'0');
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

    @endunless
    @isset($detail)
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full p-3 mt-3">
                    <div class="w-full">
                        <p><strong>BMI</strong></p>
                        <p class="text-[32px]"><strong class="text-green-700">{{ $detail['BMI'] }}</strong></p>
                        <p>
                            <strong>{{ $lang[7] }}</strong>
                            <strong class="text-green-700 text-[20px] ms-2">{{ $detail['you_are'] }}</strong>
                        </p>
                        <div class="flex flex-wrap justify-between mb-4">
                            <div class="px-3 px-md-0 mt-3">
                                <p><strong class="text-blue-700">{{ $lang[8] }}</strong></p>
                                <p>{{ $detail['min_weight_ans'] }} kg</p>
                            </div>
                            <div class="border-r-2 hidden md:block lg:block">&nbsp;</div>
                            <div class="px-3 px-md-0 mt-3">
                                <p><strong class="text-blue-700">{{ $lang[9] }}</strong></p>
                                <p>{{ $detail['max_weight_ans'] }} kg</p>
                            </div>
                            <div class="border-r-2 hidden md:block lg:block">&nbsp;</div>
                            <div class="px-3 px-md-0 mt-3">
                                <p><strong class="text-blue-700">{{ $lang[10] }}</strong></p>
                                <p>{{ $detail['min_weight_gain'] }} kg</p>
                            </div>
                            <div class="border-r-2 hidden md:block lg:block">&nbsp;</div>
                            <div class="px-3 px-md-0 mt-3">
                                <p><strong class="text-blue-700">{{ $lang[11] }}</strong></p>
                                <p>{{ $detail['max_weight_gain'] }} kg</p>
                            </div>
                        </div>
                        <div class="w-full overflow-auto">
                            <table class="w-full md:w-[80%] lg:w-[80%]" cellspacing="0">
                                <tr>
                                    <th class="text-blue-700 text-start border-b p-2">{{ $lang[3] }}</th>
                                    <th class="text-blue-700 text-start border-b p-2">{{ $lang[2] }}</th>
                                    <th class="text-blue-700 text-start border-b p-2">{{ $lang[2] }}</th>
                                </tr>
                                @for($i=0; $i < 40; $i++)
                                    <tr>
                                        <td class="{{ ($i == 39) ? '' : 'border-b' }} p-2">{{ ($i+1) }}</td>
                                        <td class="{{ ($i == 39) ? '' : 'border-b' }} p-2">{{ $detail['gain'][$i] }}</td>
                                        <td class="{{ ($i == 39) ? '' : 'border-b' }} p-2">{{ $detail['all'][$i] }}</td>
                                    </tr>
                                @endfor
                            </table>
                        </div>
                    </div>
                    <div class="col-12 text-center my-[30px]">
                        <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                            @if (app()->getLocale() == 'en')
                                RESET
                            @else
                                {{ $lang['reset'] ?? 'RESET' }}
                            @endif
                        </a>
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