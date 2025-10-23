<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
          
    
    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="cal" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
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
                            $name = [$lang['2'],$lang['3'],$lang['4']];
                            $val = ["mass","mw","moles"];
                            optionsList($val,$name,isset(request()->cal)?request()->cal:'moles');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 mass">
                    <label for="mass" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="mass" id="mass" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass'])?$_POST['mass']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="mass_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mass_unit_dropdown')">{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'pg' }} ▾</label>
                        <input type="text" name="mass_unit" value="{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'pg' }}" id="mass_unit" class="hidden">
                        <div id="mass_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'pg')">picograms (pg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'ng')">nanograms (ng)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'μg')">micrograms (μg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'mg')">milligrams (mg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'g')">grams (g)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'dag')">decagrams (dag)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'kg')">kilograms (kg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 't')">metric tons (t)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'oz')">ounces (oz)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'lbs')">pounds (lbs)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'stones')">stones</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'US ton')">US short tons (US ton)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'Long ton')">imperial tons (Long ton)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'u')">atomic mass units (u)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 mw">
                    <label for="mw" class="font-s-14 text-blue">{!! $lang['3'] !!} (g/mol):</label>
                    <input type="number" step="any" name="mw" id="mw" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->mw)?request()->mw:'4' }}" />
                </div>
                <div class="space-y-2 moles hidden">
                    <label for="moles" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="moles" id="moles" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['moles'])?$_POST['moles']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="moles_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('moles_unit_dropdown')">{{ isset($_POST['moles_unit'])?$_POST['moles_unit']:'pg' }} ▾</label>
                        <input type="text" name="moles_unit" value="{{ isset($_POST['moles_unit'])?$_POST['moles_unit']:'pg' }}" id="moles_unit" class="hidden">
                        <div id="moles_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[20%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('moles_unit', 'M')">M</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('moles_unit', 'mM')">mM</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('moles_unit', 'μM')">μM</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('moles_unit', 'nM')">nM</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('moles_unit', 'pM')">pM</p>
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
                    <div class="w-full p-3 radius-10 mt-3">
                        @php
                            $ans=$detail['ans'];
                            $molecules_22=$detail['molecules_22'];
                            $molecules_23=$detail['molecules_23'];
                            $molecules_24=$detail['molecules_24'];
            
                            if(request()->cal==='mass'){
                                $head='Mass';
                            }elseif(request()->cal==='mw'){
                                $head='Molecular Weight';
                            }elseif(request()->cal==='moles'){
                                $head='Moles';
                            }
                        @endphp
                        <div class="col-12">
                            <p><strong>{{ $head }}</strong></p>
                            <p><strong class="text-[#119154] text-[26px]">{!! $ans !!}</strong></p>
                            <p><strong>Molecules</strong></p>
                            <p class="font-s-20 my-1"><strong class="text-[#119154]">{{ $molecules_22 }}</strong></p>
                            <p class="font-s-20 my-1"><strong class="text-[#119154]">{{ $molecules_23 }}</strong></p>
                            <p class="font-s-20 my-1"><strong class="text-[#119154]">{{ $molecules_24 }}</strong></p>
                            @if(request()->cal !== 'mw')
                                <p class="my-2"><strong>{{ $lang['5'] }}</strong></p>
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                    <table class="col-12 col-lg-6" cellspacing="0">
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
                                                <td class='border-b py-2'><strong>{{ $detail['ans_mg'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_dag'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_kg'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_t'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_oz'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_lb'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_stone'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_us_ton'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-2">{{ $head }}</td>
                                                <td class='border-b py-2'><strong>{{ $detail['ans_long_ton'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2">{{ $head }}</td>
                                                <td class='py-2'><strong>{{ $detail['ans_u'] }}</strong></td>
                                            </tr>
                                        @elseif(request()->cal==='moles')
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
                                                <td class='py-2'><strong>{{ $detail['ans_mm'] }}</strong></td>
                                            </tr>
                                        @endif
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
                let cal = document.querySelector('#cal').value;
                toggleElements(cal);

                document.querySelector('#cal').addEventListener('change', function() {
                    let cal = this.value;
                    toggleElements(cal);
                });

                function toggleElements(cal) {
                    if (cal === "mass") {
                        showElements(['mw', 'moles']);
                        hideElements(['mass']);
                    } else if (cal === "mw") {
                        showElements(['mass', 'moles']);
                        hideElements(['mw']);
                    } else if (cal === "moles") {
                        showElements(['mass', 'mw']);
                        hideElements(['moles']);
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
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>