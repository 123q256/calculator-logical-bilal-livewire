<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="gender" class="labele">{!! $lang['1'] !!}:</label>
                <div class="w-100 py-2 position-relative">
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
                            $name = ["Male", "Female"];
                            $val = ["male", "female"];
                            optionsList($val,$name,isset(request()->gender)?request()->gender:'male');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-6 md:col-span-3 lg:col-span-3 hidden ft_in">
                <label for="height_ft" class="labele">{!! $lang['2'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="height_ft" id="height_ft" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['height_ft'])?$_POST['height_ft']:'6' }}" />
                </div>
            </div>

            <div class="col-span-6 md:col-span-3 lg:col-span-3 hidden ft_in">
                <label for="height_in" class="labele">&nbsp;</label>
                <input type="text" name="unit_ft_in" value="{{ isset($_POST['unit_ft_in'])?$_POST['unit_ft_in']:'cm' }}" id="unit_ft_in" class="hidden">
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="height_in" id="height_in" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_in']) ? $_POST['height_in'] : '12' }}" aria-label="input" placeholder="in" oninput="checkInput()"/>
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
            <div class="col-span-12 md:col-span-6 lg:col-span-6 h_cm">
                <label for="height_cm" class="labele">{{ $lang['2'] }} <span class="text-blue height_unit">(cm)</span>:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="height_cm" id="height_cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_cm']) ? $_POST['height_cm'] : '168' }}" aria-label="input" placeholder="cm" oninput="checkInput()"/>
                    <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'cm' }} ▾</label>
                    <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'kg' }}" id="unit_h_cm" class="hidden">
                    <div id="unit_h_cm_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm">
                        <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">feet / inches (ft/in)</p>
                        <p value="ft" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft')">feet (ft)</p>
                        <p value="in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'in')">inch (in)</p>
                        <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">centimeters (cm)</p>
                        <p value="m" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'm')">meters (m)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="weight" class="labele">{{ $lang['13'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '15' }}" aria-label="input" placeholder="cm" oninput="checkInput()"/>
                    <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'kg' }} ▾</label>
                    <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'kg' }}" id="unit" class="hidden">
                    <div id="unit_dropdown" class=" absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                        <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'kg')">kilograms (kg)</p>
                        <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'lbs')">pounds (lbs)</p>
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
                            <div class="grid grid-cols-12 gap-5">

                                <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                    <p><strong>{{ $lang['4'] }}</strong></p>
                                    <p>
                                        <strong class="text-green-700 text-[32px]">{{ $detail['idealBodyWeight'] }}</strong>
                                        <span class="text-blue-700 text-[20px]"> {{ $lang['5'] }}</span>
                                    </p>
                                </div>
                                <div class="border-r-2 col-span-1 ps-3 me-3 hidden md:block lg:block ">&nbsp;</div>
                                <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                    <p><strong>{{ $lang['6'] }}</strong></p>
                                    <p>
                                        <strong class="text-green-700 text-[32px]">{{ $detail['adjustedBodyWeight'] }}</strong>
                                        <span class="text-blue-700 text-[20px]"> {{ $lang['5'] }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="grid grid-cols-12 gap-5 mt-5">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <p class="pe-md-3 pb-2 border-md-end"><strong class="text-blue-700 border-b-2">{{ $lang['7'] }}</strong></p>
                                    <div class="w-full  overflow-auto pe-md-3 border-md-end">
                                        <table class="w-full " cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['8'] }}</strong> </td>
                                                    <td class="border-b py-2"><strong>{{ $lang['9'] }}</strong> </td>
                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="py-2">{{ round($detail['adjustedBodyWeight'] * 2.2046, 2); }}</td>
                                                    <td class="py-2">{{ round($detail['adjustedBodyWeight'] * 0.157473, 2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <p class="ps-md-3 pb-2"><strong class="text-blue-700 border-b-2">{{ $lang['10'] }}</strong></p>
                                    <div class="w-full overflow-auto ps-md-3">
                                        <table class="w-full" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <td class="border-b py-2"><strong>{{ $lang['8'] }}</strong> </td>
                                                    <td class="border-b py-2"><strong>{{ $lang['9'] }}</strong> </td>
                
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="py-2">{{ round($detail['idealBodyWeight'] * 2.2046, 2); }}</td>
                                                    <td class="py-2">{{ round($detail['idealBodyWeight'] * 0.157473, 2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
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