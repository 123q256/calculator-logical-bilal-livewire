<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="age" class="label">{!! $lang['age_year'] !!}:</label>
                    <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->age)?request()->age:'10' }}" />
                </div>
                <div class="space-y-2 relative">
                    <label for="gender" class="label">{!! $lang['gender'] !!}:</label>
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
                            $name = [$lang['male'],$lang['female']];
                            $val = ["Male","Female"];
                            optionsList($val,$name,isset($_POST['gender'])?$_POST['gender']:'Male');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 flex">
                        <div class="w-[50%] ft_in  mt-2 mr-2">
                        <label for="height_ft" class="label">{!! $lang['height'] !!}:</label>
                        <input type="number" step="any" name="height_ft" id="height_ft" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['height_ft'])?$_POST['height_ft']:'3' }}" />
                        </div>
                    <div class="w-[50%] ft_in">
                        <label for="height_in" class="label">&nbsp;</label>
                        <input type="text" name="unit_ft_in" value="{{ isset($_POST['unit_ft_in'])?$_POST['unit_ft_in']:'ft/in' }}" id="unit_ft_in" class="d-none">
                        <div class="relative w-full ">
                            <input type="number" name="height_in" id="height_in" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_in'])?$_POST['height_in']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit_h" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_dropdown')">{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }} ▾</label>
                            <input type="text" name="unit_h" value="{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }}" id="unit_h" class="hidden">
                            <div id="unit_h_dropdown" to="unit_h" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[90%] md:w-[90%] w-[90%] mt-1 right-0 hidden unit_h units_ft_in">
                                <p value="ft/in" class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'ft/in')">feet / inches (ft/in)</p>
                                <p value="cm" class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'cm')">centimeters (cm)</p>

                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 h_cm hidden w-full">
                        <label for="height_cm" class="label">{{ $lang['height'] }} (cm):</label>
                        <div class="relative w-full ">
                            <input type="number" name="height_cm" id="height_cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_cm'])?$_POST['height_cm']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }} ▾</label>
                            <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }}" id="unit_h_cm" class="hidden">
                            <div id="unit_h_cm_dropdown" to="unit_h_cm" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[50%] mt-1 right-0 hidden units_ft_in unit_h_cm">
                                <p value="ft/in" class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft/in')">feet / inches (ft/in)</p>
                                <p  value="cm" class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">centimeters (cm)</p>

                            </div>
                        </div>
                    </div>
                </div>
                    <div class="space-y-2 ">
                    <label for="weight" class="label">{{ $lang['weight'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_cm'])?$_POST['height_cm']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }} ▾</label>
                        <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }}" id="unit" class="hidden">
                        <div id="unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'lbs')">pounds (lbs)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'kg')">kilograms (kg)</p>

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
                    <div class="w-full rounded-lg p-3 mt-3">
                        <div class="w-full text-center">
                            <div><strong>{{ $lang['rmr'] }}</strong></div>
                            <div class="flex items-center justify-center mt-3">
                                <div class="ml-4 bg-[#2845F5] text-white rounded-lg p-2">
                                    <div class="text-[30px] font-bold ">{{ isset($detail) ? $detail['RMR'] : '00.0' }}</div>
                                    <div class="">{{ $lang['Calories/Day'] }}</div>
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
                    }
                    
                    // document.getElementById('unit_ft_in').value = val;
                    // document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                    //     elem.classList.toggle('d-none');
                    // });
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