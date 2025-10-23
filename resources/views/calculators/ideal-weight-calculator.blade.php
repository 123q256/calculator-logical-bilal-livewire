<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @unless(isset($detail))
      
    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">

                <div class="space-y-2">
                    <label for="age" class="font-s-14 text-blue">{!! $lang['age_year'] !!}:</label>
                    <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['age'])?$_POST['age']:'25' }}" />
                </div>
                <div class="space-y-2">
                    <label for="gender" class="font-s-14 text-blue">{!! $lang['gender'] !!}:</label>
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
            <div class="grid  mt-4  lg:grid-cols-2 md:grid-cols-2 grid-cols-1  gap-4">

                <div class="space-y-2 flex">
                    <div class="w-[50%] ft_in mr-2 mt-2">
                        <label for="height-ft" class="font-s-14 text-blue">{!! $lang['height'] !!}:</label>
                        <input type="number" step="any" name="height-ft" id="height-ft" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['height-ft'])?$_POST['height-ft']:'5' }}" />
                    </div>
                    <div class="w-[50%] ft_in ">
                    <label for="height-in" class="font-s-14 text-blue">&nbsp;</label>
                    <input type="text" name="unit_ft_in" value="{{ isset($_POST['unit_ft_in'])?$_POST['unit_ft_in']:'ft/in' }}" id="unit_ft_in" class="hidden">
                    <div class="relative w-full ">
                        <input type="number" name="height-in" id="height-in" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height-in'])?$_POST['height-in']:'9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_h" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_dropdown')">{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }} ▾</label>
                        <input type="text" name="unit_h" value="{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }}" id="unit_h" class="hidden">
                        <div id="unit_h_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[100%] md:w-[100%] w-[100%] mt-1 right-0 hidden units_ft_in">
                            <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'ft/in')">feet / inches (ft/in)</p>
                            <p  value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'cm')">centimeters (cm)</p>
                        </div>
                    </div>
                    </div>
                    <div class="space-y-2 w-full hidden h_cm">
                    <label for="height-cm" class="font-s-14 text-blue">{{ $lang['height'] }} (cm):</label>
                        <div class="relative w-full ">
                            <input type="number" name="height-cm" id="height-cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height-cm'])?$_POST['height-cm']:'175' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }} ▾</label>
                            <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }}" id="unit_h_cm" class="hidden">
                            <div id="unit_h_cm_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[44%] mt-1 right-0 hidden units_ft_in">
                                <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft/in')">feet / inches (ft/in)</p>
                                <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">centimeters (cm)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 mt-2">
                <label for="weight" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                <div class="relative w-full ">
                    <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight'])?$_POST['weight']:'158' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }} ▾</label>
                    <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }}" id="unit" class="hidden">
                    <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[44%] mt-1 right-0 hidden">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'lbs')">pounds (lbs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'kg')">kilograms (kg)</p>
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

    @endunless
    @isset($detail)
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg shadow-md space-y-6 result">
            <div class="">
            
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full  p-3 radius-10 mt-3">
                        <div class="w-full mx-auto mt-2">
                            <div class="bg-[#F6FAFC] text-black text-center border radius-10 p-3">
                                <p class="font-s-18"><strong>{!! $lang['4'] !!}</strong></p>
                                <p class="font-s-28"><strong class="text-green text-[22px]">{!! $detail['ans'] !!}</strong></p>
                            </div>
                            <div class="w-full overflow-auto mt-2">
                                <table class="w-full" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-3">{!! $lang['5'] !!}</td>
                                        <td class="border-b"><strong>{!! $detail['abw'] !!}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3">{!! $lang['6'] !!}</td>
                                        <td class="border-b"><strong>{!! $detail['Percent'] !!}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3">{!! $lang['7'] !!}</td>
                                        <td class="border-b"><strong>{!! $detail['bsa'] !!}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-3">{!! $lang['8'] !!}</td>
                                        <td class="border-b"><strong>{!! $detail['bmi'] !!}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-3">{!! $lang['9'] !!}</td>
                                        <td><strong>{!! $detail['lbw'] !!}</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full overflow-auto mt-4">
                                <table class="w-full" cellspacing="0">
                                    <tr class="bg-[#2845F5] rounded-lg text-white">
                                        <td colspan="3" class="text-center radius-10 px-3 py-2">Your Ideal weight according to</td>
                                    </tr>
                                    @if(isset($detail['Robinson']))
                                        <tr>
                                            <td class="border-b py-3">Robinson formula (1983)</td>
                                            @if($_POST['unit']=='kg')
                                                <td class="border-b"><strong>{{ $detail['Robinson'] }} kg</strong></td>
                                            @else
                                                <td class="border-b"><strong>{{ round($detail['Robinson']*2.205,2) }} lbs</strong></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3">Miller formula (1983)</td>
                                            @if($_POST['unit']=='kg')
                                                <td class="border-b"><strong>{{ $detail['Miller'] }} kg</strong></td>
                                            @else
                                                <td class="border-b"><strong>{{ round($detail['Miller']*2.205,2) }} lbs</strong></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3">Devine formula (1974)</td>
                                            @if($_POST['unit']=='kg')
                                                <td class="border-b"><strong>{{ $detail['Devine'] }} kg</strong></td>
                                            @else
                                                <td class="border-b"><strong>{{ round($detail['Devine']*2.205,2) }} lbs</strong></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3">Hamwi formula (1964)</td>
                                            @if($_POST['unit']=='kg')
                                                <td class="border-b"><strong>{{ $detail['Hamwi'] }} kg</strong></td>
                                            @else
                                                <td class="border-b"><strong>{{ round($detail['Hamwi']*2.205,2) }} lbs</strong></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3">Broca Formula (1871)</td>								
                                            @if($_POST['unit']=='kg')
                                                <td class="border-b"><strong>{{ $detail['Broca'] }} kg</strong></td>
                                            @else
                                                <td class="border-b"><strong>{{ round($detail['Broca']*2.205,2) }} lbs</strong></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3">Lorentz Formula</td>
                                            @if($_POST['unit']=='kg')
                                                <td class="border-b"><strong>{{ $detail['Lorentz'] }} kg</strong></td>
                                            @else
                                                <td class="border-b"><strong>{{ round($detail['Lorentz']*2.205,2) }} lbs</strong></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3">Peterson formula (2016)</td>
                                            @if($_POST['unit']=='kg')
                                                <td class="border-b"><strong>{{ $detail['Peterson'] }} kg</strong></td>
                                            @else
                                                <td class="border-b"><strong>{{ round($detail['Peterson']*2.205,2) }} lbs</strong></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3">Lemmens Formula (2005)</td>
                                            @if($_POST['unit']=='kg')
                                                <td class="border-b"><strong>{{ $detail['Lemmens'] }} kg</strong></td>
                                            @else
                                                <td class="border-b"><strong>{{ round($detail['Lemmens']*2.205,2) }} lbs</strong></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="py-3">BMI Method</td>
                                            @if($_POST['unit']=='kg')
                                                <td><strong>{{ $detail['BMI1'] }}</strong></td>
                                            @else
                                                <td><strong>{{ $detail['BMI2'] }}</strong></td>
                                            @endif
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="border-b py-3">Intuitive Formula</td>
                                            @if($_POST['unit']=='kg')
                                                <td class="border-b"><strong>{{ $detail['Intuitive'] }} kg</strong></td>
                                            @else
                                                <td class="border-b"><strong>{{ round($detail['Intuitive']*2.205,2) }} lbs</strong></td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="py-3">Baseline Formula</td>
                                            @if($_POST['unit']=='kg')
                                                <td><strong>{{ $detail['Baseline'] }} kg</strong></td>
                                            @else
                                                <td><strong>{{ round($detail['Baseline']*2.205,2) }} lbs</strong></td>
                                            @endif
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                        <div class="w-full text-center mt-6">

                            <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl mb-8 text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
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
                        document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                            elem.classList.toggle('hidden');
                        });
                    });
                });
            }
        </script>
    @endpush
</form>