<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">  

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="age" class="label">{!! $lang['age_year'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['age'])?$_POST['age']:'' }}" />
                </div>
            </div>
            <div class="col-span-6 ps-lg-4">
                <label for="gender" class="label">{!! $lang['gender'] !!}:</label>
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
                            optionsList($val,$name,isset($_POST['gender'])?$_POST['gender']:'Male');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 ft_in">
                <label for="height-ft" class="label">{!! $lang['height'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="height-ft" id="height-ft" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['height-ft'])?$_POST['height-ft']:'' }}" />
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6 ft_in">
                <label for="height-in" class="label">&nbsp;</label>
                <input type="text" name="unit_ft_in" value="{{ isset($_POST['unit_ft_in'])?$_POST['unit_ft_in']:'ft/in' }}" id="unit_ft_in" class="hidden">
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="height-in" id="height-in" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height-in']) ? $_POST['height-in'] : '12' }}" aria-label="input" placeholder="in" oninput="checkInput()"/>
                    <label for="unit_h" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_dropdown')">{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }} ▾</label>
                    <input type="text" name="unit_h" value="{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }}" id="unit_h" class="hidden">
                    <div id="unit_h_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h">
                        <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'ft/in')">feet / inches (ft/in)</p>
                        <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'cm')">centimeters (cm)</p>
                    </div>
                 </div>
            </div>

            <div class="col-span-12  hidden h_cm">
                <label for="height-cm" class="label">{{ $lang['height'] }} (cm):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="height-cm" id="height-cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height-cm']) ? $_POST['height-cm'] : '' }}" aria-label="input" placeholder="cm" oninput="checkInput()"/>
                    <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }} ▾</label>
                    <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }}" id="unit_h_cm" class="hidden">
                    <div id="unit_h_cm_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm">
                        <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft/in')">feet / inches (ft/in)</p>
                        <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">centimeters (cm)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="weight" class="label">{{ $lang['weight'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }} ▾</label>
                    <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }}" id="unit" class="hidden">
                    <div id="unit_dropdown" class=" absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'lbs')">pounds (lbs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'kg')">kilograms (kg)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="distance" class="label">{{ $lang['Dis_walked'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="distance" id="distance" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['distance']) ? $_POST['distance'] : '' }}" aria-label="input" placeholder="ft" oninput="checkInput()"/>
                    <label for="dis_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dis_unit_dropdown')">{{ isset($_POST['dis_unit'])?$_POST['dis_unit']:'ft' }} ▾</label>
                    <input type="text" name="dis_unit" value="{{ isset($_POST['dis_unit'])?$_POST['dis_unit']:'ft' }}" id="dis_unit" class="hidden">
                    <div id="dis_unit_dropdown" class=" absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dis_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'ft')">feet (ft)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'm')">meters (m)</p>
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
                        <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">  
                            <div class="col-span-12 md:col-span-4 lg:col-span-4 text-center">
                                <div class="bg-[#F6FAFC] border rounded-lg p-3 text-center flex justify-center" style="border: 1px solid #c1b8b899;">
                                    <div >
                                    <img src="{{ asset('images/walk_boy.png') }}" alt="6MWT" width="70" height="62" class="rounded-lg">
                                    <p>
                                        <strong class="text-blue-500 text-[28px]">{{ $detail['Ans'] }}</strong>
                                        <sub class="text-[18px]"><?=$lang['meters']?></sub>
                                    </p>
                                    </div>
                                </div>
                                <p class="mt-2"><?=$lang['expected']?></p>
                            </div>
                            <div class="col-span-12 md:col-span-4 lg:col-span-4  text-center">
                                <div class="bg-[#F6FAFC] border rounded-lg p-3 text-center  flex justify-center" style="border: 1px solid #c1b8b899;">
                                    <div >
                                    <img src="{{ asset('images/exp_dist.png') }}" alt="6 minute walk test" width="70" height="62" class="rounded-lg">
                                    <p>
                                        <strong class="text-blue-500 text-[28px]">{{ $detail['Percent'] }}</strong>
                                        <sub class="text-[18px]">%</sub>
                                    </p>
                                </div>
                                </div>
                                <p class="mt-2"><?=$lang['percentage']?></p>
                            </div>
                            <div class="col-span-12 md:col-span-4 lg:col-span-4  text-center">
                                <div class="bg-[#F6FAFC] border rounded-lg p-3 text-center  flex justify-center" style="border: 1px solid #c1b8b899;">
                                    <div >
                                    <img src="{{ asset('images/limit.png') }}" alt="Lower limit of normal" width="70" height="62" class="rounded-lg">
                                    <p>
                                        <strong class="text-blue-500 text-[28px]">{{ $detail['limit'] }}</strong>
                                        <sub class="text-[18px]"><?=$lang['meters']?></sub>
                                    </p>
                                </div>
                                </div>
                                <p class="mt-2">Lower limit of normal</p>
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