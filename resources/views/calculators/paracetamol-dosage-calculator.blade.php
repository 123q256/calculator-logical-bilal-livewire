<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-lg-6 px-2 pe-lg-4">
                    <label for="age" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="age" id="age" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['age']) ? $_POST['age'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="age_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('age_unit_dropdown')">{{ isset($_POST['age_unit'])?$_POST['age_unit']:'weeks' }} ▾</label>
                        <input type="text" name="age_unit" value="{{ isset($_POST['age_unit'])?$_POST['age_unit']:'weeks' }}" id="age_unit" class="hidden">
                        <div id="age_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="age_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('age_unit', 'years')">years</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('age_unit', 'weeks')">weeks</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('age_unit', 'months')">months</p>
                        </div>
                     </div>
                </div>
                <div class="col-lg-6 px-2 ps-lg-4">
                    <label for="weight" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="weight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('weight_unit_dropdown')">{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }} ▾</label>
                        <input type="text" name="weight_unit" value="{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }}" id="weight_unit" class="hidden">
                        <div id="weight_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="weight_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'kg')">kilograms (kg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'lbs')">pounds (lbs)</p>
                        </div>
                     </div>
                </div>
         
            <div class="col-lg-6 px-2 pe-lg-4">
                <label for="med_type" class="font-s-14 text-blue">{!! $lang['3'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="med_type" id="med_type" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['5']." (120 mg/5 mL)",$lang['6']." (250 mg/5 mL)",$lang['7']." (500 mg)",$lang['8']];
                            $val = ["1","2","3","4"];
                            optionsList($val,$name,isset(request()->med_type)?request()->med_type:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-lg-6 px-2 ps-lg-4 ss hidden">
                <label for="ss" class="font-s-14 text-blue">{!! $lang['4'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="ss" id="ss" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->ss)?request()->ss:'7' }}" />
                    <span class="text-blue input_unit">mg/mL</span>
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
                    <div class="w-full">
                        @if(isset($detail['dose']))
                            <p>
                                <strong class="text-[#119154] text-[32px]">{{ round($detail['dose'],2) }}</strong>
                                <span class="text-[#119154] text-[20px]">{{ ($detail['med_type']=="1" || $detail['med_type']=="2") ? "(ml)" : "(tabl)" }}</span>
                            </p>
                        @endif
                        @if(isset($detail['line']))
                            <p><strong>{{ $detail['line'] }}</strong></p>
                        @endif
                        @if(isset($detail['solution_amount']))
                            <p>
                                <strong class="text-[#119154] text-[32px]">{{ round($detail['solution_amount'],2) }}</strong>
                                <span class="text-[#119154] text-[20px]">(mL)</span>
                            </p>
                        @endif
                        <p class="mt-2">{{ $lang['11'] }}.</p>
                        <p class="mt-2"><span class="">{{ $lang['12'] }} <u>{{ $lang['13'] }}</u> {{ $lang['15'] }} is </span><strong class="text-[#119154]">{{ round($detail['fifteen'],2) }}</strong><strong><span> (mg)</span></strong></p>
                        <p class="mt-2"><span class="">{{ $lang['12'] }} <u>{{ $lang['14'] }}</u> {{ $lang['15'] }} is </span><strong class="text-[#119154]">{{ round($detail['sixty'],2) }}</strong><strong><span> (mg)</span></strong></p>
                    </div>
                </div>
    
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            var a = document.getElementById("med_type").value;
            if (a === "4") {
                document.querySelectorAll(".ss").forEach(function(el) {
                    el.style.display = "block";
                });
            } else {
                document.querySelectorAll(".ss").forEach(function(el) {
                    el.style.display = "none";
                });
            }
            document.getElementById("med_type").addEventListener("change", function() {
                var a = this.value;
                if (a === "4") {
                    document.querySelectorAll(".ss").forEach(function(el) {
                        el.style.display = "block";
                    });
                } else {
                    document.querySelectorAll(".ss").forEach(function(el) {
                        el.style.display = "none";
                    });
                }
            });
        </script>
    @endpush
</form>