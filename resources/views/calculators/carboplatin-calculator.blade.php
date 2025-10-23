<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">   

            <div class="col-span-12">
                <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
                    <input type="hidden" name="type" value="first" id="type">
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit tab" data-value="first" id="imperial">
                                Simple
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tab" data-value="second" id="metric">
                                Advance
                            </div>
                        </div>
                    </div>
                </div>

            
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="operations" class="font-s-14 text-blue">{!! $lang['3'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <select name="operations" id="operations" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = [$lang['4'],$lang['5']];
                            $val = ["1","2"];
                            optionsList($val,$name,isset($_POST['operations'])?$_POST['operations']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="first" class="font-s-14 text-blue">{!! $lang['6'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="first" id="first" class="input" aria-label="input" placeholder="00" required value="{{ isset($_POST['first'])?$_POST['first']:'22' }}" />
                    <span class="text-blue input_unit">{{ $lang[26] }}</span>
                </div>
            </div>


            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="second" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second']) ? $_POST['second'] : '67' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="s_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('s_units_dropdown')">{{ isset($_POST['s_units'])?$_POST['s_units']:'kg' }} ▾</label>
                    <input type="text" name="s_units" value="{{ isset($_POST['s_units'])?$_POST['s_units']:'kg' }}" id="s_units" class="hidden">
                    <div id="s_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="s_units">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_units', 'kg')">kilograms (kg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_units', 'lbs')">pounds (lbs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('s_units', 'stone')">stone</p>
                    </div>
                 </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="third" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third']) ? $_POST['third'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="t_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t_units_dropdown')">{{ isset($_POST['t_units'])?$_POST['t_units']:'mg/dL' }} ▾</label>
                    <input type="text" name="t_units" value="{{ isset($_POST['t_units'])?$_POST['t_units']:'mg/dL' }}" id="t_units" class="hidden">
                    <div id="t_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="t_units">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_units', 'mg/dL')">mg/dL</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_units', 'μmol/L')">μmol/L</p>
                    </div>
                 </div>
            </div>
         
        
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="four" class="font-s-14 text-blue">{!! $lang['10'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="four" id="four" class="input" aria-label="input" placeholder="ft" value="{{ isset($_POST['four'])?$_POST['four']:'5' }}" />
                    <span class="text-blue input_unit">mg/ml/min</span>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6 height-input hidden">
                <label for="five" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="five" id="five" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['five']) ? $_POST['five'] : '67' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="f_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_units_dropdown')">{{ isset($_POST['f_units'])?$_POST['f_units']:'in' }} ▾</label>
                    <input type="text" name="f_units" value="{{ isset($_POST['f_units'])?$_POST['f_units']:'in' }}" id="f_units" class="hidden">
                    <div id="f_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="f_units">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_units', 'in')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_units', 'cm')">centimeters (cm)</p>
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
                        <div class="w-full mt-2">
                            @if($detail['request']->type == "first")
                            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                                    <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                        <div class="text-center text-md-start md:border-r lg:border-r border-sm-bottom pb-3 pb-md-0">
                                            <p class="text-[18px]"><strong>GFR</strong></p>
                                            <p class="lg:text-[28px] md:text-[28px] text-[20px] mt-1"><strong class="text-[#119154]">{{ round($detail['answer'], 3) }}</strong><span class="text-[#119154] text-[20px]"> (ml/min)</span></p>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                        <div class="text-center text-md-start md:border-r lg:border-r border-sm-bottom ps-md-4 mt-3 mt-md-0 pb-3 pb-md-0">
                                            <p class="text-[18px]"><strong>{{ $lang[24] }}</strong></p>
                                            <p class="lg:text-[28px] md:text-[28px] text-[20px] mt-1"><strong class="text-[#119154]">{{ round($detail['car_dos'], 3) }}</strong><span class="text-[#119154] text-[20px]"> (mg)</span></p>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                        <div class="text-center text-md-start ps-md-4 mt-3 mt-md-0">
                                            <p class="text-[18px]"><strong>{{ $lang[25] }}</strong></p>
                                            <p class="lg:text-[28px] md:text-[28px] text-[20px] mt-1"><strong class="text-[#119154]">{{ round($detail['max_dos'], 3) }}</strong><span class="text-[#119154] text-[20px]"> (mg)</span></p>
                                        </div>
                                    </div>
                                </div>
                            @elseif($detail['request']->type == "second")
                            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="text-center text-md-start md:border-r lg:border-r border-bottom pb-3">
                                            <p class="text-[18px]"><strong>BSA ({{ $lang[27] }})</strong></p>
                                            <p class="lg:text-[28px] md:text-[28px] text-[20px] mt-1"><strong class="text-[#119154]">{{ $detail['bsa'] }}</strong><span class="text-[#119154] text-[22px]"> (M2)</span></p>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="text-center text-md-start border-bottom ps-md-4 mt-3 mt-md-0 pb-3">
                                            <p class="text-[18px]"><strong>{{ $lang[28] }} (IBW)</strong></p>
                                            <p class="lg:text-[28px] md:text-[28px] text-[20px] mt-1"><strong class="text-[#119154]">{{ round($detail['ibw'], 1) }}</strong><span class="text-[#119154] text-[22px]"> (kg)</span></p>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="text-center text-md-start md:border-r lg:border-r border-sm-bottom pt-3 pb-3 pb-md-0">
                                            <p class="text-[18px]"><strong>{{ $lang[29] }} (abw)</strong></p>
                                            <p class="lg:text-[28px] md:text-[28px] text-[20px] mt-1"><strong class="text-[#119154]">{{ $detail['abw'] }}</strong><span class="text-[#119154] text-[22px]"> (kg)</span></p>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="text-center text-md-start ps-md-4 pt-3">
                                            <p class="text-[18px]"><strong>{{ $lang[30] }} (abw)</strong></p>
                                            <p class="lg:text-[28px] md:text-[28px] text-[20px] mt-1"><strong class="text-[#119154]">{{ $detail['abw_alt'] }}</strong><span class="text-[#119154] text-[22px]"> (kg)</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mt-3">
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <th class="text-blue text-start text-[18px] border-b py-3">{{ $lang[31] }}</th>
                                            <th class="text-blue text-start text-[18px] border-b py-3">{{ $lang[32] }} (ml/min)<</th>
                                            <th class="text-blue text-start text-[18px] border-b py-3">{{ $lang[33] }}</th>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3">{{ $lang[34] }}</td>
                                            <td class="border-b text-center">{{ round($detail['jell_ans1'], 1) }}</td>
                                            <td class="border-b text-center">{{ round($detail['jell_ans11']) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3">{{ $lang[34] }} ({{ $lang[35] }} BSA)</td>
                                            <td class="border-b text-center">{{ round($detail['jell_ans2'], 1) }}</td>
                                            <td class="border-b text-center">{{ round($detail['jell_ans22']) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3">{{ $lang[36] }} ({{ $lang[37] }} ibw)</td>
                                            <td class="border-b text-center">{{ round($detail['cg_ibw_ans'], 1) }}</td>
                                            <td class="border-b text-center">{{ round($detail['cg_ibw_ans2']) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3">{{ $lang[36] }} ({{ $lang[38] }} wt)</td>
                                            <td class="border-b text-center">{{ round($detail['cg_abw_ans'], 1) }}</td>
                                            <td class="border-b text-center">{{ round($detail['cg_abw_ans2']) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3">{{ $lang[36] }} ({{ $lang[38] }} wt {{ $lang[39] }} eq)</td>
                                            <td class="border-b text-center">{{ round($detail['cg_abwalt_ans'], 1) }}</td>
                                            <td class="border-b text-center">{{ round($detail['cg_abwalt_ans2']) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-3">{{ $lang[36] }} ({{ $lang[40] }})</td>
                                            <td class="text-center">{{ round($detail['cg_ac_ans'], 1) }}</td>
                                            <td class="text-center">{{ round($detail['cg_ac_ans2']) }}</td>
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
            document.querySelectorAll('.tab').forEach(function(tab) {
                tab.addEventListener('click', function() {
                    document.querySelectorAll('.tab').forEach(function(tab) {
                        tab.classList.remove('tagsUnit');
                    });
                    this.classList.add('tagsUnit');
                    let val = this.dataset.value;
                    document.getElementById('type').value = val;
                    if (val === 'second') {
                        document.querySelectorAll('.height-input').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                    } else {
                        document.querySelectorAll('.height-input').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                    }
                });
            });
            @isset($detail)
                let val = "{{ $detail['request']->type }}";
                if (val === 'second') {
                    document.querySelector('.tab[data-value="first"]').classList.remove('tagsUnit');
                    document.querySelector('.tab[data-value="second"]').classList.add('tagsUnit');
                    document.querySelectorAll('.height-input').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                } else {
                    document.querySelector('.tab[data-value="second"]').classList.remove('tagsUnit');
                    document.querySelector('.tab[data-value="first"]').classList.add('tagsUnit');
                    document.querySelectorAll('.height-input').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                }
            @endisset
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>