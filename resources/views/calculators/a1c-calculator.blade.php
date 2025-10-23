<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="solve" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="solve" id="solve" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang[2],$lang[3]];
                            $val = ["1","2"];
                            optionsList($val,$name,isset(request()->solve)?request()->solve:'1');
                        @endphp
                    </select>
                </div>
            </div>

            <div class="col-span-12">
                <label for="input" class="font-s-14 text-blue" id="cc_hp">{!! $lang['3'] !!}:</label>
                <div class="relative w-full mt-[7px]">
                        <input type="number" name="input" id="input" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['input']) ? $_POST['input'] : '6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <div class="unit_1 ">
                                <label for="unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit1_dropdown')">{{ isset($_POST['unit1'])?$_POST['unit1']:'%' }} ▾</label>
                                <input type="text" name="unit1" value="{{ isset($_POST['unit1'])?$_POST['unit1']:'%' }}" id="unit1" class="hidden">
                                <div id="unit1_dropdown" class="units absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit1">
                                    <p value="1" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', '%')">percent (%)</p>
                                    <p value="2" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'mmol/mol')">mmol/mol</p>
                                </div>
                        </div>
                        <div class="unit_2 hidden">
                            <label for="unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit2_dropdown')">{{ isset($_POST['unit2'])?$_POST['unit2']:'mmol/L' }} ▾</label>
                            <input type="text" name="unit2" value="{{ isset($_POST['unit2'])?$_POST['unit2']:'mmol/L' }}" id="unit2" class="hidden">
                            <div id="unit2_dropdown" class="units absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit2">
                                <p value="1" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'mmol/L')">mmol/L</p>
                                <p value="2" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'mg/dL')">mg/dL</p>
                            </div>
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
                        <div class="w-full">
                            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                            @if(request()->solve === "1")
                                <p class="col-span-12 mb-2"><strong>{{ $lang[2] }}</strong></p>
                                <div class="col-span-12">
                                    <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                                        <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                            <strong class="text-[#119154] text-[32px]">{{ round($detail['jawab']/18.016, 2) }}</strong>
                                            <span class="text-[#2845F5] text-[20px]">mmol/L</span>
                                        </div>
                                        <div class="col-span-1 border-r hidden md:block lg:block ps-3 me-3">&nbsp;</div>
                                        <div>
                                            <strong class="text-[#119154] text-[32px]">{{ $detail['jawab'] }}</strong>
                                            <span class="text-[#2845F5] text-[20px]">mg/dL</span>
                                        </div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    </div>
                                </div>
                            @else
                                <p class="col-span-12  mb-2"><strong>{{ $lang[3] }}</strong></p>
                                <div class="col-span-12">
                                    <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                                        <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                            <strong class="text-[#119154] text-[32px]">{{ round($detail['jawab'], 2) }}</strong>
                                            <span class="text-[#2845F5] text-[20px]">%</span>
                                        </div>
                                        <div class="col-span-1 border-r hidden md:block lg:block ps-3 me-3">&nbsp;</div>
                                        <div>
                                            <strong class="text-[#119154] text-[32px]">{{ round((($detail['jawab'] - 2.152) / 0.09148), 2) }}</strong>
                                            <span class="text-[#2845F5] text-[20px]">mmol/mol</span>
                                        </div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    </div>
                                </div>
                            @endif
                            </div>
                            @if($detail['percent'] < "5.7")
                                <p class="mt-2">{{ $lang[4] }}</p>
                            @elseif($detail['percent'] >= "5.7" || $detail['percent'] < "6.4")
                                <p class="mt-2">{{ $lang[5] }}</p>
                            @else
                                <p class="mt-2">{{ $lang[6] }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            function handleSolveChange() {
                var solve_val = this.value;
                if (solve_val === "1") {
                    document.getElementById("cc_hp").textContent = "{{ $lang[3] }}";
                    document.querySelectorAll(".unit_1").forEach(function(el) {
                        el.style.display = "block";
                    });
                    document.querySelectorAll(".unit_2").forEach(function(el) {
                        el.style.display = "none";
                    });
                } else {
                    document.getElementById("cc_hp").textContent = "{{ $lang[2] }}";
                    document.querySelectorAll(".unit_1").forEach(function(el) {
                        el.style.display = "none";
                    });
                    document.querySelectorAll(".unit_2").forEach(function(el) {
                        el.style.display = "block";
                    });
                }
            }
            document.getElementById("solve").addEventListener("change", handleSolveChange);
            var solve_val = document.getElementById("solve").value;
            if (solve_val === "1") {
                document.getElementById("cc_hp").textContent = "{{ $lang[3] }}";
                document.querySelectorAll(".unit_1").forEach(function(el) {
                    el.style.display = "block";
                });
                document.querySelectorAll(".unit_2").forEach(function(el) {
                    el.style.display = "none";
                });
            } else {
                document.getElementById("cc_hp").textContent = "{{ $lang[2] }}";
                document.querySelectorAll(".unit_1").forEach(function(el) {
                    el.style.display = "none";
                });
                document.querySelectorAll(".unit_2").forEach(function(el) {
                    el.style.display = "block";
                });
            }
        </script>
    @endpush
</form>