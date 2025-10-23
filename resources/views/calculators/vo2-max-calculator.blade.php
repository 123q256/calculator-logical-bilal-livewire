<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-3 lg:gap-3">

            <div class="col-span-12">
                <label for="methods" class="label">{!! $lang['1'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <select name="methods" id="methods" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = [$lang['2'],$lang['3'],$lang['4'],$lang['5'],$lang['6']];
                            $val = ["1","2","3","4","5"];
                            optionsList($val,$name,isset(request()->methods)?request()->methods:'2');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-6" id="div1">
                <label for="operations1" class="label">{!! $lang['7'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <select name="operations1" id="operations1" class="input">
                        @php
                            $name = [$lang['8'],$lang['9']];
                            $val = ["1","0"];
                            optionsList($val,$name,isset(request()->operations1)?request()->operations1:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-6" id="div2">
                <label for="first" class="label">{!! $lang['10'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="first" id="first" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->first)?request()->first:'22' }}" />
                    <span class="input_unit">{{ $lang['11'] }}</span>
                </div>
            </div>

            <div class="col-span-6" id="div3">
                <label for="second" class="label" id="lb_1">{!! $lang['12'] !!}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second']) ? $_POST['second'] : '67' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="units2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units2_dropdown')">{{ isset($_POST['units2'])?$_POST['units2']:'kg' }} ▾</label>
                    <input type="text" name="units2" value="{{ isset($_POST['units2'])?$_POST['units2']:'kg' }}" id="units2" class="hidden">
                    <div id="units2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units2">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'kg')">kilograms (kg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'lbs')">pounds (lbs)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-6" id="div4">
                <label for="third" class="label" id="txt4">{!! $lang['13'] !!}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third']) ? $_POST['third'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="units3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units3_dropdown')">{{ isset($_POST['units3'])?$_POST['units3']:'sec' }} ▾</label>
                    <input type="text" name="units3" value="{{ isset($_POST['units3'])?$_POST['units3']:'sec' }}" id="units3" class="hidden">
                    <div id="units3_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units3">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'sec')">seconds (sec)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'min')">minutes (min)</p>
                    </div>
                 </div>
            </div>
          
            <div class="col-span-6 hidden" id="div6">
                <label for="operations2" class="label">{!! $lang['14'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <select name="operations2" id="operations2" class="input">
                        @php
                            $name = [$lang['15'],$lang['16']];
                            $val = ["2","1"];
                            optionsList($val,$name,isset(request()->operations2)?request()->operations2:'2');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-6" id="div5">
                <label for="four" class="label" id="txt5">{!! $lang['17'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="four" id="four" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->four)?request()->four:'70' }}" />
                    <span class="input_unit" id="inner">beats / 10 sec</span>
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
                <div class="col-12 bg-light-blue result radius-10 p-3 mt-3">
                    <div class="col-12 text-center">
                        <p><strong>{{ $lang[19] }}</strong></p>
                        <p class="text-[32px]"><strong class="text-green-700">{{ round($detail['answer'], 2) }}<span class="text-[20px] text-green"> (ml/kg/min)</span></strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            function updateDisplay(cal) {
                switch(cal) {
                    case '1':
                        document.querySelectorAll('#div2,#div5').forEach(function(el) {
                            el.style.display = 'block';
                        });
                        document.querySelectorAll('#div1,#div3,#div4,#div6').forEach(function(el) {
                            el.style.display = 'none';
                        });
                        document.getElementById('txt5').innerText = "{{ $lang[2] }}:";
                        document.getElementById('inner').innerText = "{{ $lang[18] }} / 20 sec";
                        break;
                    case '2':
                        document.querySelectorAll('#div1,#div2,#div3,#div4,#div5').forEach(function(el) {
                            el.style.display = 'block';
                        });
                        document.getElementById('div6').style.display = 'none';
                        document.getElementById('txt5').innerText = "{{ $lang[17] }}:";
                        document.getElementById('txt4').innerText = "{{ $lang[13] }}:";
                        document.getElementById('inner').innerText = "{{ $lang[18] }} / 10 sec";
                        break;
                    case '3':
                        document.querySelectorAll('#div1,#div5').forEach(function(el) {
                            el.style.display = 'block';
                        });
                        document.querySelectorAll('#div2,#div3,#div4,#div6').forEach(function(el) {
                            el.style.display = 'none';
                        });
                        document.getElementById('txt5').innerText = "{{ $lang[17] }}:";
                        document.getElementById('inner').innerText = "{{ $lang[18] }} / 15 sec";
                        break;
                    case '4':
                        document.getElementById('div4').style.display = 'block';
                        document.querySelectorAll('#div1,#div2,#div3,#div5,#div6').forEach(function(el) {
                            el.style.display = 'none';
                        });
                        document.getElementById('txt4').innerText = "{{ $lang[20] }}:";
                        break;
                    case '5':
                        document.querySelectorAll('#div1,#div3,#div4,#div6').forEach(function(el) {
                            el.style.display = 'block';
                        });
                        document.querySelectorAll('#div2,#div5').forEach(function(el) {
                            el.style.display = 'none';
                        });
                        document.getElementById('txt4').innerText = "{{ $lang[21] }}:";
                        break;
                    default:
                        break;
                }
            }

            document.getElementById('methods').addEventListener('change', function() {
                var cal = this.value;
                updateDisplay(cal);
            });

            updateDisplay(document.getElementById('methods').value);
        </script>
    @endpush
</form>