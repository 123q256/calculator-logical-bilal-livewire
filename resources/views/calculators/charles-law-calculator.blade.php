<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="find" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <select name="find" id="find" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['2']." (V₁)",$lang['3']." (T₁)",$lang['4']." (V₂)",$lang['5']." (T₂)",$lang['6']." (p)",$lang['7']." (n)"];
                            $val = ["v1","t1","v2","t2","p","n"];
                            optionsList($val,$name,isset(request()->find)?request()->find:'t2');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 v1">
                    <label for="v1" class="font-s-14 text-blue">{{ $lang['2'] }} (V₁)</label>
                    <div class="relative w-full ">
                        <input type="number" name="v1" id="v1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['v1'])?$_POST['v1']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_x" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_unit_dropdown')">{{ isset($_POST['unit_x'])?$_POST['unit_x']:'m³' }} ▾</label>
                        <input type="text" name="unit_x" value="{{ isset($_POST['unit_x'])?$_POST['unit_x']:'m³' }}" id="unit_x" class="hidden">
                        <div id="f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[100%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'mm³')">cubic millimeters (mm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'cm³')">cubic centimeters (cm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'dm³')">cubic decimeters (dm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'm³')">cubic meters (m³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'cu in')">cubic inches (cu in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'cu ft')">cubic feet (cu ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'cu yd')">cubic yards (cu yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'ml')">milliliters (ml)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_x', 'liters')">liters</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 t1">
                    <label for="t1" class="font-s-14 text-blue">{{ $lang['3'] }} (T₁)</label>
                    <div class="relative w-full ">
                        <input type="number" name="t1" id="t1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['t1'])?$_POST['t1']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="t1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_unit_dropdown')">{{ isset($_POST['t1_unit'])?$_POST['t1_unit']:'°C' }} ▾</label>
                        <input type="text" name="t1_unit" value="{{ isset($_POST['t1_unit'])?$_POST['t1_unit']:'°C' }}" id="t1_unit" class="hidden">
                        <div id="f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[100%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1_unit', '°C')">Celsius (°C)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1_unit', '°F')">Fahrenheit (°F)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1_unit', 'K')">Kelvin (K)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 v2">
                    <label for="v2" class="font-s-14 text-blue">{{ $lang['4'] }} (V₂)</label>
                    <div class="relative w-full ">
                        <input type="number" name="v2" id="v2" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['v2'])?$_POST['v2']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="v2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_unit_dropdown')">{{ isset($_POST['v2_unit'])?$_POST['v2_unit']:'m³' }} ▾</label>
                        <input type="text" name="v2_unit" value="{{ isset($_POST['v2_unit'])?$_POST['v2_unit']:'m³' }}" id="v2_unit" class="hidden">
                        <div id="f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[100%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'mm³')">cubic millimeters (mm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'cm³')">cubic centimeters (cm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'dm³')">cubic decimeters (dm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'm³')">cubic meters (m³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'cu in')">cubic inches (cu in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'cu ft')">cubic feet (cu ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'cu yd')">cubic yards (cu yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'ml')">milliliters (ml)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'liters')">liters</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 t2 hidden">
                    <label for="t2" class="font-s-14 text-blue">{{ $lang['5'] }} (T₂)</label>
                    <div class="relative w-full ">
                        <input type="number" name="t2" id="t2" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['t2'])?$_POST['t2']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="t2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_unit_dropdown')">{{ isset($_POST['t2_unit'])?$_POST['t2_unit']:'°C' }} ▾</label>
                        <input type="text" name="t2_unit" value="{{ isset($_POST['t2_unit'])?$_POST['t2_unit']:'°C' }}" id="t2_unit" class="hidden">
                        <div id="f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[100%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t2_unit', '°C')">Celsius (°C)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t2_unit', '°F')">Fahrenheit (°F)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t2_unit', 'K')">Kelvin (K)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 p hidden">
                    <label for="p" class="font-s-14 text-blue">{{ $lang['4'] }} (p)</label>
                    <div class="relative w-full ">
                        <input type="number" name="p" id="p" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['p'])?$_POST['p']:'9' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="p_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_unit_dropdown')">{{ isset($_POST['p_unit'])?$_POST['p_unit']:'Pa' }} ▾</label>
                        <input type="text" name="p_unit" value="{{ isset($_POST['p_unit'])?$_POST['p_unit']:'Pa' }}" id="p_unit" class="hidden">
                        <div id="f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[100%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'Pa')">Pa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'bar')">bar</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'psi')">psi</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'at')">at</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'atm')">atm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'Torr')">Torr</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'hPa')">hPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'kPa')">kPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'MPa')">MPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'GPa')">GPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'in Hg')">in Hg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'mmHg')">mmHg</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 n hidden relative">
                    <label for="n" class="font-s-14 text-blue">{!! $lang['7'] !!} (n):</label>
                    <input type="number" step="any" name="n" id="n" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->n)?request()->n:'10' }}" />
                        <span class="text-blue input_unit">mol</span>
                 </div>
               
                 <div class="space-y-2 n hidden relative">
                    <label for="R" class="font-s-14 text-blue">{!! $lang['8'] !!} (R):</label>
                    <input type="number" step="any" name="R" id="R" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->R)?request()->R:'8.3144626' }}" />
                    <span class="text-blue input-unit">J⋅K⁻¹⋅mol⁻¹</span>
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
                <div class="w-full  p-3 radius-10 mt-3">
                    <div class="col-12 col-lg-8 text-center mx-auto ">
                        <p class="text-[16px]">
                            <strong>
                                @if(isset($detail['v1']))
                                    {{ $lang['9'] }} (v₁)
                                @elseif(isset($detail['t1']))
                                    {{ $lang['10'] }} (T₁)
                                @elseif(isset($detail['v2']))
                                    {{ $lang['11'] }} (v₂)
                                @elseif(isset($detail['t2']))
                                    {{ $lang['12'] }} (T₂)
                                @elseif(isset($detail['p_val']))
                                    {{ $lang['6'] }} (p)
                                @elseif(isset($detail['n_val']))
                                    {{ $lang['13'] }} (n)
                                @endif
                            </strong>
                        </p>
                        <p class="text-[36px]">
                            <strong class="text-green font-s-32">
                                @if(isset($detail['v1']))
                                    {{ $detail['v1'] }} <span class="text-green font-s-22">m³</span>
                                @elseif(isset($detail['t1']))
                                    {{ $detail['t1'] }} <span class="text-green font-s-22">K</span>
                                @elseif(isset($detail['v2']))
                                    {{ $detail['v2'] }} <span class="text-green font-s-22">m³</span>
                                @elseif(isset($detail['t2']))
                                    {{ $detail['t2'] }} <span class="text-green font-s-22">K</span>
                                @elseif(isset($detail['p_val']))
                                    {{ $detail['p_val'] }} <span class="text-green font-s-22">Pa</span>
                                @elseif(isset($detail['n_val']))
                                    {{ $detail['n_val'] }} <span class="text-green font-s-22">mol</span>
                                @endif
                            </strong>
                        </p>
                        @if(!isset($detail['p_val']) && !isset($detail['n_val']))
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 lg:gap-5 md:gap-5 gap-2">
                                <div class="pe-lg-2 mt-2">
                                    <div class="bg-[#F6FAFC] text-black border radius-10 px-3 py-2">
                                        <p><{{ $lang['6'] }} (p)</p>
                                        <p class=""><strong><{{ $detail['p'] }} pascals</strong></p>
                                    </div>
                                </div>
                                <div class="ps-lg-2 mt-2">
                                    <div class="bg-[#F6FAFC] text-black border radius-10 px-3 py-2">
                                        <p><{{ $lang['13'] }} (n)</p>
                                        <p class=""><strong><{{ $detail['n'] }} mol</strong></p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(isset($detail['v1']) || isset($detail['v2']))
                            <p class="text-start font-s-18 mt-2"><strong>{{ $lang['14'] }}</strong></p>
                            <div class="col-12 overflow-auto">
                                <table class="col-12 text-start" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ isset($detail['v1'])?$lang['9'].' (v₁)':$lang['11'].' (v₂)' }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['mm3'] }} cubic millimeters (mm³)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ isset($detail['v1'])?$lang['9'].' (v₁)':$lang['11'].' (v₂)' }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['cm3'] }} cubic centimeters (cm³)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ isset($detail['v1'])?$lang['9'].' (v₁)':$lang['11'].' (v₂)' }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['dm3'] }} cubic decimeters (dm³)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ isset($detail['v1'])?$lang['9'].' (v₁)':$lang['11'].' (v₂)' }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['cu_in'] }} cubic inches (cu in)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ isset($detail['v1'])?$lang['9'].' (v₁)':$lang['11'].' (v₂)' }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['cu_ft'] }} cubic feet (cu ft)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ isset($detail['v1'])?$lang['9'].' (v₁)':$lang['11'].' (v₂)' }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['cu_yd'] }} cubic yards (cu yd)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ isset($detail['v1'])?$lang['9'].' (v₁)':$lang['11'].' (v₂)' }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['cm3'] }} milliliters (ml)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 pe-2">{{ isset($detail['v1'])?$lang['9'].' (v₁)':$lang['11'].' (v₂)' }}</td>
                                        <td class='py-2 ps-2'>{{ $detail['dm3'] }} liters (L)</td>
                                    </tr>
                                </table>
                            </div>
                        @elseif(isset($detail['t1']) || isset($detail['t2']))
                            <p class="text-start font-s-18 mt-2"><strong>{{ $lang['14'] }}</strong></p>
                            <div class="col-12 overflow-auto">
                                <table class="col-12 text-start" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ isset($detail['t1'])?$lang['10'].' (T₁)':$lang['12'].' (T₂)' }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['c'] }} Celsius (°C)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 pe-2">{{ isset($detail['t1'])?$lang['10'].' (T₁)':$lang['12'].' (T₂)' }}</td>
                                        <td class='py-2 ps-2'>{{ $detail['f'] }} Fahrenheit (°F)</td>
                                    </tr>
                                </table>
                            </div>
                        @elseif(isset($detail['p_val']))
                            <p class="text-start font-s-18 mt-2"><strong>{{ $lang['14'] }}</strong></p>
                            <div class="col-12 overflow-auto">
                                <table class="col-12 text-start" cellspacing="0">
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ $lang['6'] }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['bar'] }} bars (bar)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ $lang['6'] }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['psi'] }} pounds per square inch (psi)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ $lang['6'] }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['at'] }} technical atmospheres (at)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ $lang['6'] }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['atm'] }} standard atmospheres (atm)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ $lang['6'] }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['torr'] }} torrs (Torr)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ $lang['6'] }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['hpa'] }} hectopascals (hPa)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ $lang['6'] }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['kpa'] }} kilopascals (kPa)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ $lang['6'] }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['mpa'] }} megapascals (MPa)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ $lang['6'] }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['gpa'] }} gigapascals (GPa)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ $lang['6'] }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['in_hg'] }} inches of mercury (in Hg)</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 pe-2">{{ $lang['6'] }}</td>
                                        <td class='border-b py-2 ps-2'>{{ $detail['mmhg'] }} millimeters of mercury (mmHg)</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function handleFindChange(find) {
                    const elementsToShow = {
                        'v1': ['.t1', '.v2', '.t2'],
                        't1': ['.v1', '.v2', '.t2'],
                        'v2': ['.v1', '.t1', '.t2'],
                        't2': ['.v1', '.t1', '.v2'],
                        'p': ['.v1', '.t1', '.n', '.R'],
                        'n': ['.v1', '.t1', '.p', '.R']
                    };

                    const allElements = ['.v1', '.t1', '.v2', '.t2', '.p', '.n', '.R'];

                    allElements.forEach(selector => {
                        document.querySelectorAll(selector).forEach(elem => elem.style.display = 'none');
                    });

                    if (elementsToShow[find]) {
                        elementsToShow[find].forEach(selector => {
                            document.querySelectorAll(selector).forEach(elem => elem.style.display = 'block');
                        });
                    }
                }

                const initialFind = document.querySelector('#find').value;
                handleFindChange(initialFind);

                document.querySelector('#find').addEventListener('change', function() {
                    const selectedFind = this.value;
                    handleFindChange(selectedFind);
                });
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>