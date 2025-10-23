<style>
    .purple{
        background: #9c27b0
    }
    .cyan{
        background: #00bcd4
    }
    .red{
        background: #F44336
    }
    .orange{
        background: #ff9800
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="gender" class="label">{{ $lang['gender'] }}:</label>
                <div class="w-full py-2 position-relative">
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
      
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="weight" class="label">{{ $lang['weight'] }}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }} ▾</label>
                    <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }}" id="unit" class="hidden">
                    <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'lbs')">pounds (lbs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'kg')">kilograms (kg)</p>
                    </div>
                 </div>
            </div>
           
            <div class="col-span-6 md:col-span-3 lg:col-span-3 ft_in">
                <label for="height_ft" class="label">{!! $lang['height'] !!}:</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="height_ft" id="height_ft" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['height_ft'])?$_POST['height_ft']:'' }}" />
                </div>
            </div>
            <div class="col-span-6 md:col-span-3 lg:col-span-3 ft_in">
                <label for="height_in" class="label">&nbsp;</label>
                <input type="text" name="unit_ft_in" value="{{ isset($_POST['unit_ft_in'])?$_POST['unit_ft_in']:'ft/in' }}" id="unit_ft_in" class="hidden">
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="height_in" id="height_in" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_in']) ? $_POST['height_in'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
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
                    <input type="number" name="height_cm" id="height_cm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_cm']) ? $_POST['height_cm'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }} ▾</label>
                    <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }}" id="unit_h_cm" class="hidden">
                    <div id="unit_h_cm_dropdown" class="units_ft_in absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_h_cm">
                        <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft/in')">feet / inches (ft/in)</p>
                        <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">centimeters (cm)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="percent" class="label"  >
                    {{ $lang['body_fat'] .' % '. $lang['dont'] }}
                    <a title="Body Fat Percentage Calculator" href="{{ url('body-fat-percentage-calculator') }}/" class="text-blue font-s-12" target="_blank" rel="noopener"> {{ $lang['click'] }}</a>:
                </label>
                <div class="w-fullpy-2 relative">
                    <input type="number" step="any" name="percent" id="percent" class="input" aria-label="input" placeholder="0%" value="{{ isset($_POST['percent'])?$_POST['percent']:'' }}" />
                    <span class="text-blue input_unit">%</span>
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
                        <div class="w-full">
                            <div class="w-full overflow-auto">
                                <table class="w-full md:w-[80%] lg:w-[80%]" cellspacing="0">
                                    <tr>
                                        <th class="text-start text-blue border-b py-2">{{ $lang['name'] }}</th>
                                        <th class="text-start text-blue border-b">{{ $lang['value'] }}</th>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['fat'] }}</td>
                                        <td class="border-b">
                                            @if (isset($detail['lean']))
                                                {{ $detail['lean']." kg / ".round($detail['lean']*2.205,2)." lbs" }}
                                            @else
                                                00 kg
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['body_fat'] }}</td>
                                        <td class="border-b">
                                            @if (isset($detail['body_fat']))
                                                {{ $detail['body_fat']." kg / ".round($detail['body_fat']*2.205,2)." lbs" }}
                                            @else
                                                00 kg
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['ffmi'] }}</td>
                                        <td class="border-b">
                                            @if (isset($detail['ffmi']))
                                                {{ $detail['ffmi']." kg/m²" }}
                                            @else
                                                00 kg/m²
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['nffmi'] }}</td>
                                        <td class="border-b">
                                            @if (isset($detail['nffmi']))
                                                {{ $detail['nffmi']." kg/m²" }}
                                            @else
                                                00 kg/m²
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang['f_cat'] }}</td>
                                        <td class="border-b">{{ $detail['cat'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">{{ $lang['bmi'] }}</td>
                                        <td>
                                            @if (isset($detail['bmi']))
                                                {{ $detail['bmi']." kg/m²" }}
                                            @else
                                                00 kg/m²
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full overflow-auto mt-3">
                                <table class="w-full col-lg-8" cellspacing="0">
                                    <tr>
                                        <th class="text-start text-blue border-b py-2">{{ $lang['frang'] }}</th>
                                        <th class="text-start text-blue border-b">{{ $lang['des'] }}</th>
                                    </tr>
                                    <tr class="{{ isset($detail['skinny']) ? $detail['skinny'] : '' }}">
                                        <td class="border-b p-2">{{ $lang['Below'] }}</td>
                                        <td class="border-b p-2">{{ $lang['b_a'] }}</td>
                                    </tr>
                                    <tr class="{{ isset($detail['average']) ? $detail['average'] : '' }}">
                                        <td class="border-b p-2">18 - 20</td>
                                        <td class="border-b p-2">{{ $lang['ave'] }}</td>
                                    </tr>
                                    <tr class="{{ isset($detail['fat']) ? $detail['fat'] : '' }}">
                                        <td class="border-b p-2">20 - 22</td>
                                        <td class="border-b p-2">{{ $lang['a_a'] }}</td>
                                    </tr>
                                    <tr class="{{ isset($detail['athlete']) ? $detail['athlete'] : '' }}">
                                        <td class="border-b p-2">22 - 23</td>
                                        <td class="border-b p-2">{{ $lang['ex'] }}</td>
                                    </tr>
                                    <tr class="{{ isset($detail['gym']) ? $detail['gym'] : '' }}">
                                        <td class="border-b p-2">23 - 26</td>
                                        <td class="border-b p-2">{{ $lang['sup'] }}</td>
                                    </tr>
                                    <tr class="{{ isset($detail['body']) ? $detail['body'] : '' }}">
                                        <td class="p-2">26 - 28</td>
                                        <td class="p-2">{{ $lang['sups'] }}</td>
                                    </tr>
                                    <tr class="{{ isset($detail['unlikely']) ? $detail['unlikely'] : '' }}">
                                        <td class="p-2">> 28</td>
                                        <td class="p-2">Highly Unlikely without steroids</td>
                                    </tr>
                                </table>
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
                }
            @endif
        </script>
    @endpush
</form>