<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="age" class="font-s-14 text-blue">{!! $lang['age_year'] !!}:</label>
                    <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['age'])?$_POST['age']:'25' }}" />
                </div>
                <div class="space-y-2 relative">
                    <label for="gender" class="font-s-14 text-blue">{{ $lang['gender'] }}:</label>
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
                            $name = [$lang["male"],$lang["female"]];
                            $val = ["Male","Female"];
                            optionsList($val,$name,isset($_POST['gender'])?$_POST['gender']:'Male');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 flex">
                    <div class="w-[50%] mt-2 mr-2 ft_in">
                        <label for="height-ft" class="font-s-14 text-blue">{!! $lang['height'] !!}:</label>
                        <input type="number" step="any" name="height-ft" id="height-ft" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['height-ft'])?$_POST['height-ft']:'5' }}" />
                    </div>
                    <div class="w-[50%] ft_in">
                        <label for="height-in" class="font-s-14 text-blue">&nbsp;</label>
                        <input type="text" name="unit_ft_in" value="{{ isset($_POST['unit_ft_in'])?$_POST['unit_ft_in']:'ft/in' }}" id="unit_ft_in" class="hidden">
                        <div class="relative w-full ">
                            <input type="number" name="height-in" id="height-in" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height-in'])?$_POST['height-in']:'9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit_h" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_dropdown')">{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }} ▾</label>
                            <input type="text" name="unit_h" value="{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }}" id="unit_h" class="hidden">
                            <div id="unit_h_dropdown" to="unit_h" class="units_ft_in unit_h absolute z-10 bg-white border border-gray-300 rounded-md w-[100%] mt-1 right-0 hidden">
                                <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'ft/in')">feet / inches (ft/in)</p>
                                <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'cm')">centimeters (cm)</p>
                        
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 h_cm hidden w-full">
                        <label for="height-cm" class="font-s-14 text-blue">{{ $lang['height'] }} (cm):</label>
                        <div class="relative w-full ">
                            <input type="number" name="height-cm" id="height-cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height-cm'])?$_POST['height-cm']:'9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }} ▾</label>
                            <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }}" id="unit_h_cm" class="hidden">
                            <div id="unit_h_cm_dropdown" to="unit_h_cm" class="units_ft_in unit_h_cm absolute z-10 bg-white border border-gray-300 rounded-md w-[100%] mt-1 right-0 hidden">
                                <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft/in')">feet / inches (ft/in)</p>
                                <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">centimeters (cm)</p>
                        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="weight" class="font-s-14 text-blue">{{ $lang['weight'] }} :</label>
                    <div class="relative w-full ">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height-cm'])?$_POST['height-cm']:'9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }} ▾</label>
                        <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }}" id="unit" class="hidden">
                        <div id="unit_dropdown" class=" unit absolute z-10 bg-white border border-gray-300 rounded-md w-[100%] mt-1 right-0 hidden">
                            <p value="lbs" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'lbs')">pounds (lbs)</p>
                            <p value="kg" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'kg')">kilograms (kg)</p>
                    
                        </div>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <label for="activity" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                    <select name="activity" id="activity" class="input">
                        @php
                            $name = [$lang['10'],$lang['11'],$lang['12'],$lang['13'],$lang['14']];
                            $val = ["1.2","1.375","1.55","1.725","1.9"];
                            optionsList($val,$name,isset($_POST['activity'])?$_POST['activity']:'1.2');
                        @endphp
                    </select>
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
                    <div class="w-full p-3 rounded-lg mt-3">
                        <div class="w-full mt-2">
                            <div class="flex justify-center">
                                <div class="lg:w-10/12">
                                    <div class="flex flex-col lg:flex-row bg-[#F6FAFC] text-black text-center border rounded-lg p-3">
                                        <div class="lg:w-7/12 border-b lg:border-r lg:border-b-0 pb-3 lg:pb-0">
                                            <div class="text-lg mb-2">{{ $lang['bmr'] }}</div>
                                            <strong class="text-green text-xl">{{ $detail['BMR'] }}</strong> 
                                            <sub class=" text-lg">{{ $lang['Calories/Day'] }}</sub>
                                        </div>
                                        <div class="lg:w-5/12 lg:pl-4 mt-3 lg:mt-0">
                                            <div class="text-lg mb-2">{{ $lang['17'] }}</div>
                                            <strong class="text-green text-xl">{{ round($detail['BMR']*$_POST['activity'], 2) }}</strong> 
                                            <sub class=" text-lg">kcal</sub>
                                        </div>
                                    </div>
                    
                                    <div class="w-full overflow-auto mt-4">
                                        <table class="w-full lg:w-12/12 mx-auto" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="text-blue-500 text-left border-b py-2">{{ $lang['9'] }}</th>
                                                    <th class="text-blue-500 text-left border-b py-2">{{ $lang['17'] }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="{{ $_POST['activity'] == '1.2' ? 'bg-[#2845F5] text-white' : '' }}">
                                                    <td class="border-b py-2 px-2">{{ $lang['10'] }}</td>
                                                    <td class="border-b py-2 px-2">{{ round($detail['BMR']*1.2, 2) }} kcal</td>
                                                </tr>
                                                <tr class="{{ $_POST['activity'] == '1.375' ? 'bg-[#2845F5] text-white' : '' }}">
                                                    <td class="border-b py-2 px-2">{{ $lang['11'] }}</td>
                                                    <td class="border-b py-2 px-2">{{ round($detail['BMR']*1.375, 2) }} kcal</td>
                                                </tr>
                                                <tr class="{{ $_POST['activity'] == '1.55' ? 'bg-[#2845F5] text-white' : '' }}">
                                                    <td class="border-b py-2 px-2">{{ $lang['12'] }}</td>
                                                    <td class="border-b py-2 px-2">{{ round($detail['BMR']*1.55, 2) }} kcal</td>
                                                </tr>
                                                <tr class="{{ $_POST['activity'] == '1.725' ? 'bg-[#2845F5] text-white' : '' }}">
                                                    <td class="border-b py-2 px-2">{{ $lang['13'] }}</td>
                                                    <td class="border-b py-2 px-2">{{ round($detail['BMR']*1.725, 2) }} kcal</td>
                                                </tr>
                                                <tr class="{{ $_POST['activity'] == '1.9' ? 'bg-[#2845F5] text-white' : '' }}">
                                                    <td class="py-2 px-2">{{ $lang['14'] }}</td>
                                                    <td class="py-2 px-2">{{ round($detail['BMR']*1.9, 2) }} kcal</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="w-full overflow-auto mt-4">
                                        <table class="w-full mx-auto" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th class="text-blue-500 text-left border-b py-2 px-2">{{ $lang['15'] }}</th>
                                                    <th class="text-blue-500 text-left border-b py-2 px-2">{{ $lang['16'] }}</th>
                                                    <th class="text-blue-500 text-left border-b py-2 px-2">{{ $lang['17'] }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="border-b py-2 px-2">Revised Harris-Benedict</td>
                                                    <td class="border-b py-2 px-2">{{ $detail['hbmr'] }} kcal</td>
                                                    <td class="border-b py-2 px-2">{{ round($detail['hbmr']*$_POST['activity'], 2) }} kcal</td>
                                                </tr>
                                                <tr class="bg-[#2845F5] text-white">
                                                    <td class="border-b py-2 px-2">Mifflin St Jeor</td>
                                                    <td class="border-b py-2 px-2">{{ $detail['BMR'] }} kcal</td>
                                                    <td class="border-b py-2 px-2">{{ round($detail['BMR']*$_POST['activity'], 2) }} kcal</td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-2 px-2">Schofield</td>
                                                    <td class="border-b py-2 px-2">{{ $detail['sbmr'] }} kcal</td>
                                                    <td class="border-b py-2 px-2">{{ round($detail['sbmr']*$_POST['activity'], 2) }} kcal</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full text-center mt-3">
                            <a href="{{ url()->current() }}">
                                <button type="button" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600">{{ $lang['reset'] }}</button>
                            </a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script>
            var get_document = document.getElementById('unit_ft_in')

            if(get_document){
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
                        // document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                        //     elem.classList.toggle('d-none');
                        // });
                    });
                });
            }
        </script>
    @endpush
</form>