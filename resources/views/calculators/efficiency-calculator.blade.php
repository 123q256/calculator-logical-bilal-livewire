<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="solve" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="solve" id="solve" class="input" onchange="change_text(this)">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang[2],$lang[3],$lang[4]];
                                $val = ["1","2","3"];
                                optionsList($val,$name,isset($_POST['solve'])?$_POST['solve']:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6" id="en_in">
                    <label for="en_in1" class="label">{{ $lang[5] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="en_in" id="en_in1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['en_in']) ? $_POST['en_in'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="en_in_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('en_in_unit_dropdown')">{{ isset($_POST['en_in_unit'])?$_POST['en_in_unit']:'J' }} ▾</label>
                        <input type="text" name="en_in_unit" value="{{ isset($_POST['en_in_unit'])?$_POST['en_in_unit']:'J' }}" id="en_in_unit" class="hidden">
                        <div id="en_in_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="en_in_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('en_in_unit', 'J')">J</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('en_in_unit', 'kJ')">kJ</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('en_in_unit', 'MJ')">MJ</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('en_in_unit', 'Wh')">Wh</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('en_in_unit', 'kWh')">kWh</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('en_in_unit', 'ft-lbs')">ft-lbs</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('en_in_unit', 'kcal')">kcal</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('en_in_unit', 'eV')">eV</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6" id="en_ou">
                    <label for="en_ou1" class="label">{{ $lang[6] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="en_ou" id="en_ou1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['en_ou']) ? $_POST['en_ou'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="en_ou_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('en_ou_unit_dropdown')">{{ isset($_POST['en_ou_unit'])?$_POST['en_ou_unit']:'J' }} ▾</label>
                        <input type="text" name="en_ou_unit" value="{{ isset($_POST['en_ou_unit'])?$_POST['en_ou_unit']:'J' }}" id="en_ou_unit" class="hidden">
                        <div id="en_ou_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="en_ou_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('en_ou_unit', 'J')">J</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('en_ou_unit', 'kJ')">kJ</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('en_ou_unit', 'MJ')">MJ</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('en_ou_unit', 'Wh')">Wh</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('en_ou_unit', 'kWh')">kWh</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('en_ou_unit', 'ft-lbs')">ft-lbs</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('en_ou_unit', 'kcal')">kcal</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('en_ou_unit', 'eV')">eV</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="en_ef">
                    <label for="en_ef1" class="label">{{ $lang[6] }}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="en_ef" id="en_ef1" class="input" value="{{ isset($_POST['en_ef'])?$_POST['en_ef']:'7' }}" aria-label="input" placeholder="00" />
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
                <div class="w-full mt-3">
                    @php
                        $request = request();
                        $solve = trim($request->solve);
                        $en_ou = trim($request->en_ou);
                        $en_ou_unit = trim($request->en_ou_unit);
                        $en_in = trim($request->en_in);
                        $en_in_unit = trim($request->en_in_unit);
                        $en_ef = trim($request->en_ef);
                    @endphp
                    <div class="w-full">
                        <div class="text-center">
                            <p class="text-[20px]">
                                <strong>
                                    @php
                                        if ($solve === "1") {
                                            echo $lang[2];
                                        }else if ($solve === "2") {
                                            echo $lang[3];
                                        }else{
                                            echo $lang[4];
                                        }
                                    @endphp
                                </strong>
                            </p>
                            <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3">
                                <strong class="text-blue">{{ round($detail['answer'], 4) }} 
                                    @php
                                        if ($solve === "2" || $solve === "3") {
                                            echo "J";
                                        }else{
                                            echo "%";
                                        }
                                    @endphp
                                </strong>
                            </p>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
@push('calculatorJS')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var solveElement = document.getElementById('solve');
            var enOu = document.getElementById('en_ou');
            var enIn = document.getElementById('en_in');
            var enEf = document.getElementById('en_ef');

            function checkSolveValue(value) {
                if (value === "1") {
                    enOu.style.display = 'block';
                    enIn.style.display = 'block';
                    enEf.style.display = 'none';
                } else if (value === "2") {
                    enOu.style.display = 'block';
                    enEf.style.display = 'block';
                    enIn.style.display = 'none';
                } else {
                    enIn.style.display = 'block';
                    enEf.style.display = 'block';
                    enOu.style.display = 'none';
                }
            }

            checkSolveValue(solveElement.value);

            solveElement.addEventListener('change', function() {
                checkSolveValue(solveElement.value);
            });
        });

    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>