<form class="row relative" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif

       <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[90%] md:w-[90%] w-full  ">
        <input type="hidden" name="type" id="type" value="first">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 ">
                <div class="lg:w-1/4 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit " id="aa" data-value="first">
                            {{ $lang['1'] }}
                    </div>
                </div>
                <div class="lg:w-1/4 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white " id="bb" data-value="second">
                            {{ $lang['2'] }}
                    </div>
                </div>
                <div class="lg:w-1/4 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white " id="cc" data-value="third">
                            {{ $lang['3'] }}
                    </div>
                </div>
                <div class="lg:w-1/4 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white " id="dd" data-value="fourth">
                            {{ $lang['4'] }}
                    </div>
                </div>
            </div>
        </div>


       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="dose" class="label">{{ $lang['5'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="dose" id="dose" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dose']) ? $_POST['dose'] : '10' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <div class="d1">
                        <label for="dose_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dose_unit_dropdown')">{{ isset($_POST['dose_unit'])?$_POST['dose_unit']:'mg/kg' }} ▾</label>
                        <input type="text" name="dose_unit" value="{{ isset($_POST['dose_unit'])?$_POST['dose_unit']:'mg/kg' }}" id="dose_unit" class="hidden">
                        <div id="dose_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dose_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dose_unit', 'mg/kg')">mg/kg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dose_unit', 'mg/kg/day')">mg/kg/day</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dose_unit', 'mg/kg/dose')">mg/kg/dose</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dose_unit', 'mcg/kg')">mcg/kg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dose_unit', 'mcg/kg/day')">mcg/kg/day</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dose_unit', 'mcg/kg/dose')">mcg/kg/dose</p>
                        </div>
                    </div>
                    <div class="d2 hidden">
                        <label for="dose_unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dose_unit2_dropdown')">{{ isset($_POST['dose_unit2'])?$_POST['dose_unit2']:'mg/m²' }} ▾</label>
                        <input type="text" name="dose_unit2" value="{{ isset($_POST['dose_unit2'])?$_POST['dose_unit2']:'mg/m²' }}" id="dose_unit2" class="hidden">
                        <div id="dose_unit2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dose_unit2">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dose_unit2', 'mg/m²')">mg/m²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dose_unit2', 'mg/day')">mg/day</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dose_unit2', 'mg/dose')">mg/dose</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dose_unit2', 'mcg/m²')">mcg/m²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dose_unit2', 'mcg/day')">mcg/day</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dose_unit2', 'mcg/dose')">mcg/dose</p>
                        </div>
                    </div>
                    <div class="d3 hidden">
                        <label for="dose_unit3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dose_unit3_dropdown')">{{ isset($_POST['dose_unit3'])?$_POST['dose_unit3']:'mg/day' }} ▾</label>
                        <input type="text" name="dose_unit3" value="{{ isset($_POST['dose_unit3'])?$_POST['dose_unit3']:'mg/day' }}" id="dose_unit3" class="hidden">
                        <div id="dose_unit3_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dose_unit3">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dose_unit3', 'mg/day')">mg/day</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dose_unit3', 'mg/dose')">mg/dose</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dose_unit3', 'mcg/day')">mcg/day</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dose_unit3', 'mcg/dose')">mcg/dose</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 weight">
                <label for="weight" class="label">{{ $lang['6'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '120' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="weight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('weight_unit_dropdown')">{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }} ▾</label>
                    <input type="text" name="weight_unit" value="{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }}" id="weight_unit" class="hidden">
                    <div id="weight_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="weight_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'kg')">kilograms (kg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'lbs')">pounds (lbs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'g')">grams (g)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'dag')">decagrams (dag)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'oz')">ounces (oz)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 bsa hidden">
                <label for="bsa" class="label">{!! $lang['7'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="bsa" id="bsa" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->bsa)?request()->bsa:'13' }}" />
                    <span class="text-blue input_unit"><span class="roy">m<sup>2</sup></span></span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 ch hidden">
                <label for="child_age" class="label">{!! $lang['8'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="child_age" id="child_age" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->child_age)?request()->child_age:'13' }}" />
                    <span class="text-blue input_unit"><span class="roy">years</span></span>
                </div>
            </div>
            <p class="col-span-12"><strong class="text-blue">{{ $lang['12'] }}</strong></p>

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="mass" class="label">{{ $lang['9'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="mass" id="mass" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass']) ? $_POST['mass'] : '120' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="mass_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mass_unit_dropdown')">{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'mg' }} ▾</label>
                    <input type="text" name="mass_unit" value="{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'mg' }}" id="mass_unit" class="hidden">
                    <div id="mass_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="mass_unit">
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'mg')">millgrams (mg)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'µg')">micrograms (µg)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'g')">grams (g)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="per" class="label">{{ $lang['10'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="per" id="per" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['per']) ? $_POST['per'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="per_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('per_unit_dropdown')">{{ isset($_POST['per_unit'])?$_POST['per_unit']:'ml' }} ▾</label>
                    <input type="text" name="per_unit" value="{{ isset($_POST['per_unit'])?$_POST['per_unit']:'ml' }}" id="per_unit" class="hidden">
                    <div id="per_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="per_unit">
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per_unit', 'ml')">milliliters (ml)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per_unit', 'mm³')">cubic milliliters (mm³)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per_unit', 'cm³')">cubic centimeters (cm³)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per_unit', 'cu in')">cubic inches (cu in)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per_unit', 'cl')">centiliters (cl)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('per_unit', 'cc')">cubic centimeters (cc)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="dose_frequency" class="label">{!! $lang['11'] !!}:</label>
                <div class="w-100 py-2 relative">
                    <select name="dose_frequency" id="dose_frequency" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = ["qD","BID","TID","QID","q8 hr","q6 hr","q4 hr","q3 hr","q2 hr","q1 hr"];
                            $val = ["qD","BID","TID","QID","q8 hr","q6 hr","q4 hr","q3 hr","q2 hr","q1 hr"];
                            optionsList($val,$name,isset(request()->dose_frequency)?request()->dose_frequency:'qD');
                        @endphp
                    </select>
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
                        <div class="col-12">
                            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <p class="">{{ $lang['13'] }} =<strong><span class="text-[#119154] text-[28px]"> {{ round($detail['main_answer1'],2) }}</span><span class="text-[#119154]"> (mg/day) </span></strong></p>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <p class="">{{ $lang['14'] }} ({{ $detail['dose_frequency'] }}) =<strong><span class="text-[#119154] text-[28px]"> {{ round($detail['ans1'],2) }}</span><span class="text-[#119154]"> (mg/dose) </span></strong></p>
                                    </div>
                                </div>
                                <div class="col-span-12">
                                    <strong> {{ $lang['15'] }} {{ $detail['mass'] }} ({{ $detail['mass_unit'] }}) / {{ $detail['per'] }} ({{ $detail['per_unit'] }}) :</strong>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <p class="">{{ $lang['13'] }} =<strong><span class="text-[#119154] text-[28px]"> {{ round($detail['main_answer1']/$detail['main_answer3'],2) }}</span><span class="text-[#119154]"> (mL/day) </span></strong></p>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <p class="">{{ $lang['14'] }} ({{ $detail['dose_frequency'] }}) =<strong><span class="text-[#119154] text-[28px]"> {{ round($detail['main_answer4'],2) }}</span><span class="text-[#119154]"> (mL/dose) </span></strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script>
            @if(isset($detail) || isset($error))
                var val = "{{ request()->type }}";
                if (val === 'first') {
                    document.querySelectorAll("#bb, #cc, #dd").forEach(function(el) {
                        el.classList.remove("tagsUnit");
                    });
                    document.getElementById("aa").classList.add("tagsUnit");
                    document.querySelectorAll(".d1, .weight").forEach(function(el) {
                        el.style.display = "block";
                    });
                    document.querySelectorAll(".d2, .bsa, .d3, .ch").forEach(function(el) {
                        el.style.display = "none";
                    });
                    document.getElementById('type').value = val;
                } else if (val === 'second') {
                    document.querySelectorAll("#aa, #cc, #dd").forEach(function(el) {
                        el.classList.remove("tagsUnit");
                    });
                    document.getElementById("bb").classList.add("tagsUnit");
                    document.querySelectorAll(".d2, .bsa").forEach(function(el) {
                        el.style.display = "block";
                    });
                    document.querySelectorAll(".d1, .weight, .d3, .ch").forEach(function(el) {
                        el.style.display = "none";
                    });
                    document.getElementById('type').value = val;
                } else if (val === 'third') {
                    document.querySelectorAll("#aa, #bb, #dd").forEach(function(el) {
                        el.classList.remove("tagsUnit");
                    });
                    document.getElementById("cc").classList.add("tagsUnit");
                    document.querySelectorAll(".d3, .ch").forEach(function(el) {
                        el.style.display = "block";
                    });
                    document.querySelectorAll(".d1, .weight, .bsa, .d2").forEach(function(el) {
                        el.style.display = "none";
                    });
                    document.getElementById('type').value = val;
                } else if (val === 'fourth') {
                    document.querySelectorAll("#aa, #bb, #cc").forEach(function(el) {
                        el.classList.remove("tagsUnit");
                    });
                    document.getElementById("dd").classList.add("tagsUnit");
                    document.querySelectorAll(".d3, .weight").forEach(function(el) {
                        el.style.display = "block";
                    });
                    document.querySelectorAll(".d1, .bsa, .d2, .ch").forEach(function(el) {
                        el.style.display = "none";
                    });
                    document.getElementById('type').value = val;
                }
            @endif

            document.addEventListener('DOMContentLoaded', function() {


            document.getElementById('aa').addEventListener('click', function() {


                document.querySelectorAll('#bb, #cc, #dd').forEach(function(el) {
                    el.classList.remove('tagsUnit');
                });
                document.getElementById('aa').classList.add('tagsUnit');
                document.querySelectorAll('.d1, .weight').forEach(function(el) {
                    el.style.display = 'block';
                });
                document.querySelectorAll('.d2, .bsa, .d3, .ch').forEach(function(el) {
                    el.style.display = 'none';
                });
                document.getElementById('type').value = this.getAttribute('data-value');
            });

            document.getElementById('bb').addEventListener('click', function() {

                document.querySelectorAll('#aa, #cc, #dd').forEach(function(el) {
                    el.classList.remove('tagsUnit');
                });
                document.getElementById('bb').classList.add('tagsUnit');
                document.querySelectorAll('.d2, .bsa').forEach(function(el) {
                    el.style.display = 'block';
                });
                document.querySelectorAll('.d1, .weight, .d3, .ch').forEach(function(el) {
                    el.style.display = 'none';
                });
                document.getElementById('type').value = this.getAttribute('data-value');
            });

            document.getElementById('cc').addEventListener('click', function() {
                document.querySelectorAll('#aa, #bb, #dd').forEach(function(el) {
                    el.classList.remove('tagsUnit');
                });
                document.getElementById('cc').classList.add('tagsUnit');
                document.querySelectorAll('.d3, .ch').forEach(function(el) {
                    el.style.display = 'block';
                });
                document.querySelectorAll('.d1, .weight, .bsa, .d2').forEach(function(el) {
                    el.style.display = 'none';
                });
                document.getElementById('type').value = this.getAttribute('data-value');
            });

            document.getElementById('dd').addEventListener('click', function() {
                document.querySelectorAll('#aa, #bb, #cc').forEach(function(el) {
                    el.classList.remove('tagsUnit');
                });
                document.getElementById('dd').classList.add('tagsUnit');
                document.querySelectorAll('.d3, .weight').forEach(function(el) {
                    el.style.display = 'block';
                });
                document.querySelectorAll('.d1, .bsa, .d2, .ch').forEach(function(el) {
                    el.style.display = 'none';
                });
                document.getElementById('type').value = this.getAttribute('data-value');
            });
        });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>