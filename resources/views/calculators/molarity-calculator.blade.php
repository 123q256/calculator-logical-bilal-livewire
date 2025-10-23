<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="cal" class="font-s-14 text-blue">{!! $lang['15'] !!}:</label>
                    <select name="cal" id="cal" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['1'],$lang['2'],$lang['3'],$lang['4']];
                            $val = ["mass","vol","mol","rv"];
                            optionsList($val,$name,isset(request()->cal)?request()->cal:'mol');
                        @endphp
                    </select>
                </div>
                
                <div class="space-y-2 mass">
                    <label for="mass" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="mass" id="mass" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass'])?$_POST['mass']:'2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="mass_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mass_unit_dropdown')">{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'pg' }} ▾</label>
                        <input type="text" name="mass_unit" value="{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'pg' }}" id="mass_unit" class="hidden">
                        <div id="mass_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'pg')">pg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'ng')">ng</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'μg')">μg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'mg')">mg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'g')">g</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'kg')">kg</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 conc hidden">
                    <label for="conc" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="conc" id="conc" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['conc'])?$_POST['conc']:'2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="conc_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('conc_unit_dropdown')">{{ isset($_POST['conc_unit'])?$_POST['conc_unit']:'fM' }} ▾</label>
                        <input type="text" name="conc_unit" value="{{ isset($_POST['conc_unit'])?$_POST['conc_unit']:'fM' }}" id="conc_unit" class="hidden">
                        <div id="conc_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('conc_unit', 'fM')">fM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('conc_unit', 'pM')">pM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('conc_unit', 'nM')">nM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('conc_unit', 'μM')">μM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('conc_unit', 'mM')">mM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('conc_unit', 'M')">M</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 mw">
                    <label for="mw" class="font-s-14 text-blue">{!! $lang['7'] !!} (g/mol):</label>
                    <input type="number" step="any" name="mw" id="mw" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->mw)?request()->mw:'4' }}" />
                </div>
                <div class="space-y-2 vol">
                    <label for="vol" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="vol" id="vol" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['vol'])?$_POST['vol']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="vol_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('vol_unit_dropdown')">{{ isset($_POST['vol_unit'])?$_POST['vol_unit']:'nL' }} ▾</label>
                        <input type="text" name="vol_unit" value="{{ isset($_POST['vol_unit'])?$_POST['vol_unit']:'nL' }}" id="vol_unit" class="hidden">
                        <div id="vol_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'nL')">nL</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'μL')">μL</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'mL')">mL</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'L')">L</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 sc hidden">
                    <label for="sc" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="sc" id="sc" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['sc'])?$_POST['sc']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="sc_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('sc_unit_dropdown')">{{ isset($_POST['sc_unit'])?$_POST['sc_unit']:'fM' }} ▾</label>
                        <input type="text" name="sc_unit" value="{{ isset($_POST['sc_unit'])?$_POST['sc_unit']:'fM' }}" id="sc_unit" class="hidden">
                        <div id="sc_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sc_unit', 'fM')">fM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sc_unit', 'pM')">pM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sc_unit', 'nM')">nM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sc_unit', 'μM')">μM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sc_unit', 'mM')">mM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sc_unit', 'M')">M</p>

                        </div>
                    </div>
                </div>
                <div class="space-y-2 dc hidden">
                    <label for="dc" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="dc" id="dc" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dc'])?$_POST['dc']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="dc_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dc_unit_dropdown')">{{ isset($_POST['dc_unit'])?$_POST['dc_unit']:'fM' }} ▾</label>
                        <input type="text" name="dc_unit" value="{{ isset($_POST['dc_unit'])?$_POST['dc_unit']:'fM' }}" id="dc_unit" class="hidden">
                        <div id="dc_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dc_unit', 'fM')">fM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dc_unit', 'pM')">pM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dc_unit', 'nM')">nM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dc_unit', 'μM')">μM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dc_unit', 'mM')">mM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dc_unit', 'M')">M</p>

                        </div>
                    </div>
                </div>
                <div class="space-y-2 dv hidden">
                    <label for="dv" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="dv" id="dv" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dv'])?$_POST['dv']:'3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="dv_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dv_unit_dropdown')">{{ isset($_POST['dv_unit'])?$_POST['dv_unit']:'fM' }} ▾</label>
                        <input type="text" name="dv_unit" value="{{ isset($_POST['dv_unit'])?$_POST['dv_unit']:'fM' }}" id="dv_unit" class="hidden">
                        <div id="dv_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dv_unit', 'nL')">nL</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dv_unit', 'μL')">μL</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dv_unit', 'mL')">mL</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dv_unit', 'L')">L</p>
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
                    <div class="w-full  result p-3 radius-10 mt-3">
                        @php
                            $ans=$detail['ans'];
                            if(request()->cal==='mass'){
                                $head=$lang['5'];
                            }elseif(request()->cal==='vol'){
                                $head=$lang['8'];
                            }elseif(request()->cal==='mol'){
                                $head=$lang['12'];
                            }elseif(request()->cal==='rv'){
                                $head=$lang['13'];
                            }
                        @endphp
                        <div class="w-full">
                            <p class=""><strong>{{ $head }}</strong></p>
                            <p class=""><strong class="text-green font-s-32">{!! $ans !!}</strong></p>
                            <p class="my-2"><strong>{{ $lang['14'] }}</strong></p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                <table class="col-12 col-lg-7" cellspacing="0">
                                    @if(request()->cal==='mass')
                                        <tr>
                                            <td class="border-b py-2">{{ $head }}</td>
                                            <td class='border-b py-2'><strong>{{ $detail['ans_pg'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $head }}</td>
                                            <td class='border-b py-2'><strong>{{ $detail['ans_ng'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $head }}</td>
                                            <td class='border-b py-2'><strong>{{ $detail['ans_ug'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $head }}</td>
                                            <td class='border-b py-2'><strong>{{ $detail['ans_g'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">{{ $head }}</td>
                                            <td class='py-2'><strong>{{ $detail['ans_kg'] }}</strong></td>
                                        </tr>
                                    @elseif(request()->cal==='vol' || request()->cal==='rv')
                                        <tr>
                                            <td class="border-b py-2">{{ $head }}</td>
                                            <td class='border-b py-2'><strong>{{ $detail['ans_nl'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $head }}</td>
                                            <td class='border-b py-2'><strong>{{ $detail['ans_ul'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">{{ $head }}</td>
                                            <td class='py-2'><strong>{{ $detail['ans_l'] }}</strong></td>
                                        </tr>
                                    @elseif(request()->cal==='mol')
                                        <tr>
                                            <td class="border-b py-2">{{ $head }}</td>
                                            <td class='border-b py-2'><strong>{{ $detail['ans_fm'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $head }}</td>
                                            <td class='border-b py-2'><strong>{{ $detail['ans_pm'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $head }}</td>
                                            <td class='border-b py-2'><strong>{{ $detail['ans_nm'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $head }}</td>
                                            <td class='border-b py-2'><strong>{{ $detail['ans_um'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">{{ $head }}</td>
                                            <td class='py-2'><strong>{{ $detail['ans_m'] }}</strong></td>
                                        </tr>
                                    @endif
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
            document.addEventListener('DOMContentLoaded', function() {
                let cal = document.querySelector('#cal').value;
                toggleElements(cal);

                document.querySelector('#cal').addEventListener('change', function() {
                    let cal = this.value;
                    toggleElements(cal);
                });

                function toggleElements(cal) {
                    if (cal === "mass") {
                        showElements(['conc', 'mw', 'vol']);
                        hideElements(['mass', 'sc', 'dc', 'dv']);
                    } else if (cal === "vol") {
                        showElements(['mass', 'mw', 'conc']);
                        hideElements(['vol', 'sc', 'dc', 'dv']);
                    } else if (cal === "mol") {
                        showElements(['mass', 'mw', 'vol']);
                        hideElements(['conc', 'sc', 'dc', 'dv']);
                    } else if (cal === "rv") {
                        showElements(['sc', 'dc', 'dv']);
                        hideElements(['mass', 'vol', 'conc', 'mw']);
                    }
                }

                function showElements(classes) {
                    classes.forEach(function(cls) {
                        document.querySelectorAll('.' + cls).forEach(function(el) {
                            el.style.display = 'block';
                        });
                    });
                }

                function hideElements(classes) {
                    classes.forEach(function(cls) {
                        document.querySelectorAll('.' + cls).forEach(function(el) {
                            el.style.display = 'none';
                        });
                    });
                }
            });
        </script>
    @endpush
</form>