<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6 sex">
                    <label for="sex" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="sex" id="sex" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = [$lang['2'],$lang['3']];
                                $val = ["male","female"];
                                optionsList($val,$name,isset(request()->sex)?request()->sex:'male');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 bw">
                    <label for="bw" class="font-s-14 text-blue">{!! $lang['4'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="bw" id="bw" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['bw']) ? $_POST['bw'] : '80' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'kg' }} ▾</label>
                        <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'kg' }}" id="unit" class="hidden">
                        <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'kg')">kilograms (kg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'lbs')">pounds (lbs)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12">
                    <span class="font-s-14 pe-2 pe-lg-3"><strong>{{ $lang['5'] }}: </strong></span>
                    <input type="radio" name="method" id="au" value="au" checked {{ isset(request()->method) && request()->method === 'au' ? 'checked' : '' }}>
                    <label for="au" class="font-s-14 text-blue pe-lg-3 pe-2">{{ $lang['6'] }}:</label>
                    <input type="radio" name="method" id="sep" value="sep" {{ isset(request()->method) && request()->method === 'sep' ? 'checked' : '' }}>
                    <label for="sep" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                </div>
                <div class="col-span-12">
                    <p id="p1" class="p_set">{{ $lang['8'] }}</p>
                    <p id="p2" class="p_set hidden">{{ $lang['9'] }}</p>
                </div>
                <div class="col-span-12  hidden" id="sep1">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                     <div class="col-span-6 bp">
                            <label for="bp" class="font-s-14 text-blue">{!! $lang['10'] !!}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="bp" id="bp" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['bp']) ? $_POST['bp'] : '20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit1_dropdown')">{{ isset($_POST['unit1'])?$_POST['unit1']:'kg' }} ▾</label>
                                <input type="text" name="unit1" value="{{ isset($_POST['unit1'])?$_POST['unit1']:'kg' }}" id="unit1" class="hidden">
                                <div id="unit1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit1">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'kg')">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'lbs')">pounds (lbs)</p>
                                </div>
                             </div>
                        </div>
                     
                        <div class="col-span-6 bp">
                            <label for="bp_reps" class="font-s-14 text-blue">{!! $lang['11'] !!}:</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="bp_reps" id="bp_reps" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->bp_reps)?request()->bp_reps:'15' }}" />
                            </div>
                        </div>
                        <div class="col-span-6 bs">
                            <label for="bs" class="font-s-14 text-blue">{!! $lang['12'] !!}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="bs" id="bs" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['bs']) ? $_POST['bs'] : '15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit2_dropdown')">{{ isset($_POST['unit2'])?$_POST['unit2']:'kg' }} ▾</label>
                                <input type="text" name="unit2" value="{{ isset($_POST['unit2'])?$_POST['unit2']:'kg' }}" id="unit2" class="hidden">
                                <div id="unit2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit2">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'kg')">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'lbs')">pounds (lbs)</p>
                                </div>
                             </div>
                        </div>
                     
                        <div class="col-span-6 bs">
                            <label for="bs_reps" class="font-s-14 text-blue">{!! $lang['11'] !!}:</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="bs_reps" id="bs_reps" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->bs_reps)?request()->bs_reps:'10' }}" />
                            </div>
                        </div>
                        <div class="col-span-6 dl">
                            <label for="dl" class="font-s-14 text-blue">{!! $lang['13'] !!}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="dl" id="dl" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dl']) ? $_POST['dl'] : '15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit3_dropdown')">{{ isset($_POST['unit3'])?$_POST['unit3']:'kg' }} ▾</label>
                                <input type="text" name="unit3" value="{{ isset($_POST['unit3'])?$_POST['unit3']:'kg' }}" id="unit3" class="hidden">
                                <div id="unit3_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit3">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'kg')">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'lbs')">pounds (lbs)</p>
                                </div>
                             </div>
                        </div>
                        <div class="col-span-6 dl">
                            <label for="dl_reps" class="font-s-14 text-blue">{!! $lang['11'] !!}:</label>
                            <div class="w-100 py-2 position-relative">
                                <input type="number" step="any" name="dl_reps" id="dl_reps" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->dl_reps)?request()->dl_reps:'5' }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 wl">
                    <label for="wl" class="font-s-14 text-blue">{!! $lang['14'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="wl" id="wl" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wl']) ? $_POST['wl'] : '100' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit4" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit4_dropdown')">{{ isset($_POST['unit4'])?$_POST['unit4']:'kg' }} ▾</label>
                        <input type="text" name="unit4" value="{{ isset($_POST['unit4'])?$_POST['unit4']:'kg' }}" id="unit4" class="hidden">
                        <div id="unit4_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit4">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit4', 'kg')">kilograms (kg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit4', 'lbs')">pounds (lbs)</p>
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
        @php
            $ws_cal = $detail['ws_cal'];
            $ws = $detail['ws'];
            $fw = isset($detail['fw']) ? $detail['fw'] : '';
            $lb = isset($detail['lb']) ? $detail['lb'] : '';
            $lb1 = isset($detail['lb1']) ? $detail['lb1'] : '';
            $wl = request()->wl;
            $bw = request()->bw;
            $sex = request()->sex;
        @endphp

<div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                <strong>{{ $lang[15] }} <span class="text-green-700 text-[28px] ms-2">{{ $ws }}</span></strong>
                            </div>
                            <p class="my-2">
                                <span>{{ $lang[16] }}</span>
                                <strong>
                                    {{ ($fw != '') ? $fw : $wl }}
                                    {{ ($lb != '') ? 'lbs' : 'kg' }}
                                </strong>
                                <span>{{ $lang[17] }}</span>
                                <strong>
                                    {{ $bw }}
                                    {{ ($lb != '') ? 'lbs' : 'kg' }}
                                </strong>
                            </p>
                            <div class="w-full overflow-auto">
                                <table class="w-full md:w-[60%] lg:w-[60%]" cellspacing="0">
                                    <tr>
                                        <th class="text-start text-blue-700 border-b py-2">{{ $lang[18] }}</th>
                                        <th class="text-start text-blue-700 border-b py-2">{{ $lang[19] }}</th>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang[20] }}</td>
                                        <td class="border-b py-2">120</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang[21] }}</td>
                                        <td class="border-b py-2">200</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang[22] }}</td>
                                        <td class="border-b py-2">238</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang[23] }}</td>
                                        <td class="border-b py-2">326</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2">{{ $lang[24] }}</td>
                                        <td class="py-2">414</td>
                                    </tr>
                                </table>
                            </div>
                            <p class="text-[20px] mt-3"><strong class="text-blue-700">{{ $lang[25] }}:</strong></p>
                            <p><strong class="text-blue-700">{{ $lang[26] }}</strong></p>
                            <p class="text-[15px]">{{ $lang[27] }} = TWL * 500 / (a + b * BWT + c * BWT<sup>2</sup> + d * BWT<sup>3</sup> + e * BWT<sup>4</sup> + f * BWT<sup>5</sup>)</p>
                            <p class="mt-3"><strong class="text-blue-700">{{ $lang[28] }}</strong></p>
                            <p class="text-[15px]">{{ $lang[27] }} = TWL * 500 / (a + b * BWT + c * BWT<sup>2</sup> + d * BWT<sup>3</sup> + e * BWT<sup>4</sup> + f * BWT<sup>5</sup>)</p>
                            <p class="mt-2 text-[15px]">{{ $lang[27] }} =
                                @if($sex==='male')
                                    @if($fw != '')
                                        {{ ($lb != '') ? $lb1 : $fw }}
                                    @else
                                        {{ ($lb != '') ? $lb1 : $wl }}
                                    @endif
                                    * 500 / (-216.0475144 + 16.2606339 * {{ ($lb)?$lb:$bw }} + (-0.002388645) * {{ ($lb)?$lb:$bw }}<sup>2</sup> + (-0.00113732) * {{ ($lb)?$lb:$bw }}<sup>3</sup> + 0.00000701863 * {{ ($lb)?$lb:$bw }}<sup>4</sup> + (-1.291e-8) * {{ ($lb)?$lb:$bw }}<sup>5</sup>)
                                @elseif($sex==='female')
                                    @if($fw != '')
                                        {{ ($lb != '') ? $lb1 : $fw }}
                                    @else
                                        {{ ($lb != '') ? $lb1 : $wl }}
                                    @endif
                                    * 500 / (594.31747775582 + (-27.23842536447) * {{ ($lb)?$lb:$bw }} + 0.82112226871 * {{ ($lb)?$lb:$bw }}<sup>2</sup> + (-0.00930733913) * {{ ($lb)?$lb:$bw }}<sup>3</sup> + 0.00004731582 * {{ ($lb)?$lb:$bw }}<sup>4</sup> + (-9.054e-8) * {{ ($lb)?$lb:$bw }}<sup>5</sup>)
                                @endif
                            </p>
                            <p class="mt-2 text-[15px]">{{ $lang[27] }} =
                                @if($fw != '')
                                    {{ ($lb != '') ? $lb1 : $fw }}
                                @else
                                    {{ ($lb != '') ? $lb1 : $wl }}
                                @endif
                                * {{ $ws_cal }} = <strong class="font-s-16">{{ $ws }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            function handleAuClick() {
                document.querySelectorAll('#sep1,#p2').forEach(function(el) {
                    el.style.display = 'none';
                });
                document.querySelectorAll('.wl,#p1').forEach(function(el) {
                    el.style.display = 'block';
                });
            }
            function handleSepClick() {
                document.querySelectorAll('.wl,#p1').forEach(function(el) {
                    el.style.display = 'none';
                });
                document.querySelectorAll('#sep1,#p2').forEach(function(el) {
                    el.style.display = 'block';
                });
            }
            function handleUnitClick() {
                var val = this.getAttribute('value');
                document.querySelector('.input-unit').textContent = val + ' ▾';
                document.querySelector('#unit').value = (val === 'kg') ? 'kg' : 'lbs';
            }
            document.getElementById('au').addEventListener('click', handleAuClick);
            document.getElementById('sep').addEventListener('click', handleSepClick);
            document.querySelectorAll('.units p').forEach(function(el) {
                el.addEventListener('click', handleUnitClick);
            });
            var val = "{{ request()->method }}";
            if(val === 'au'){
                handleAuClick();
            } else if(val === 'sep'){
                handleSepClick();
            }
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>