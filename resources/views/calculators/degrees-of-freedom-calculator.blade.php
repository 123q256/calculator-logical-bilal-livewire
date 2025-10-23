<style>
    .n1,.n2,.v1,.v2,.c,.r,.k,.d1,.d2,.h,.three,.x{
        display:none;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

         
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-2">
       
 
            <div class="col-span-6">
                <label for="test" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <select name="selection" id="test" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = ["1-".$lang['2'],"2-".$lang['3'],"2-".$lang['4'],$lang['5'],$lang['6'],$lang['7']];
                            $val = ["1","2","3","4","5","6"];
                            optionsList($val,$name,isset($_POST['selection'])?$_POST['selection']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-6 n">
                <label for="sample_size" class="font-s-14 text-blue">{{ $lang['8'] }} (N)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="sample_size" id="sample_size" value="{{ isset($_POST['sample_size'])?$_POST['sample_size']:'2' }}" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-6 n1">
                <label for="sample_size_one" class="font-s-14 text-blue">{{ $lang['8'] }} (N₁)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="sample_size_one" id="sample_size_one" value="{{ isset($_POST['sample_size_one'])?$_POST['sample_size_one']:'5' }}" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-6 n2">
                <label for="sample_size_two" class="font-s-14 text-blue">{{ $lang['8'] }} (N₂)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="sample_size_two" id="sample_size_two" value="{{ isset($_POST['sample_size_two'])?$_POST['sample_size_two']:'4' }}" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-6 v1">
                <label for="variance_one" class="font-s-14 text-blue">{{ $lang['9'] }} (σ₁)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="variance_one" id="variance_one" value="{{ isset($_POST['variance_one'])?$_POST['variance_one']:'6' }}" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-6 v2">
                <label for="variance_two" class="font-s-14 text-blue">{{ $lang['9'] }} (σ₂)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="variance_two" id="variance_two" value="{{ isset($_POST['variance_two'])?$_POST['variance_two']:'3' }}" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-6 c">
                <label for="c1" class="font-s-14 text-blue">{{ $lang['10'] }}</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="c1" id="c1" value="{{ isset($_POST['c1'])?$_POST['c1']:'7' }}" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-6 r">
                <label for="r1" class="font-s-14 text-blue">{{ $lang['11'] }}</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="r1" id="r1" value="{{ isset($_POST['r1'])?$_POST['r1']:'2' }}" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-6 k">
                <label for="k1" class="font-s-14 text-blue">{{ $lang['12'] }} (k)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="k1" id="k1" value="{{ isset($_POST['k1'])?$_POST['k1']:'1.5' }}" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-6 d1">
                <label for="d1" class="font-s-14 text-blue">{{ $lang['13'] }}</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="d1" id="d1" value="{{ isset($_POST['d1'])?$_POST['d1']:'2.5' }}" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-6 d2">
                <label for="d2" class="font-s-14 text-blue">{{ $lang['14'] }}</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="d2" id="d2" value="{{ isset($_POST['d2'])?$_POST['d2']:'2.7' }}" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-6 h">
                <label for="h" class="font-s-14 text-blue">{{ $lang['15'] }} (h)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="h" id="h" value="{{ isset($_POST['h'])?$_POST['h']:'7' }}" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-6 x">
                <label for="sample_mean" class="font-s-14 text-blue">{{ $lang['16'] }} (x)</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="sample_mean" id="sample_mean" value="{{ isset($_POST['sample_mean'])?$_POST['sample_mean']:'3' }}" class="input" aria-label="input" placeholder="00" />
                </div>
            </div>
            <div class="col-span-6 three">
                <label for="standard_deviation_three" class="font-s-14 text-blue">{{ $lang['17'] }}</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="standard_deviation_three" id="standard_deviation_three" value="{{ isset($_POST['standard_deviation_three'])?$_POST['standard_deviation_three']:'5' }}" class="input" aria-label="input" placeholder="00" />
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
                            <div class="text-center">
                                <p class="text-[25px]">
                                    <strong>{{ $lang['18'] }}</strong>
                                </p>
                                <div class="flex justify-center">
                                <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ $detail['degrees_of_freedom'] }}</strong>
                                </p>
                            </div>
                        </div>
                            @if (isset($detail['t_statistic']) && $detail['t_statistic']!="")
                                <div class="text-center">
                                    <p class="text-[25px]">
                                        <strong>{{ $lang['7'] }}</strong>
                                    </p>
                                    <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['t_statistic'] }}</strong>
                                    </p>
                                </div>
                            @endif
                            @if (isset($detail['v1']) && $detail['v1']!="")
                                <div class="text-center">
                                    <p class="text-[25px]">
                                        <strong>{{ $lang['19'] }} (s₁)</strong>
                                    </p>
                                    <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['v1'] }}</strong>
                                    </p>
                                </div>
                            @endif
                            @if (isset($detail['v2']) && $detail['v2']!="")
                                <div class="text-center">
                                    <p class="text-[25px]">
                                        <strong>{{ $lang['19'] }} (s₂)</strong>
                                    </p>
                                    <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['v2'] }}</strong>
                                    </p>
                                </div>
                            @endif
                            @if (isset($detail['d3']) && $detail['d3']!="")
                                <div class="text-center">
                                    <p class="text-[25px]">
                                        <strong>{{ $lang['14'] }}</strong>
                                    </p>
                                    <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['d3'] }}</strong>
                                    </p>
                                </div>
                            @endif
                            @if (isset($detail['d2']) && $detail['d2']!="")
                                <div class="text-center">
                                    <p class="text-[25px]">
                                        <strong>{{ $lang['13'] }}</strong>
                                    </p>
                                    <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['d2'] }}</strong>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        // Initial setup
        var a = document.getElementById('test').value;
        if (a === "1") {
            hideElements([".n1", ".n2", ".v1", ".v2", ".c", ".r", ".k", ".d1", ".d2", ".h", ".three", ".x"]);
            showElements([".n"]);
        } else if (a === "2") {
            hideElements([".n", ".v1", ".v2", ".c", ".r", ".k", ".d1", ".d2", ".h", ".three", ".x"]);
            showElements([".n1", ".n2"]);
        } else if (a === "3") {
            hideElements([".n", ".c", ".r", ".k", ".d1", ".d2", ".h", ".three", ".x"]);
            showElements([".n1", ".n2", ".v1", ".v2"]);
        } else if (a === "4") {
            hideElements([".n", ".k", ".d1", ".d2", ".h", ".three", ".x", ".n1", ".n2", ".v1", ".v2"]);
            showElements([".r", ".c"]);
        } else if (a === "5") {
            hideElements([".r", ".c", ".d1", ".d2", ".h", ".three", ".x", ".n1", ".n2", ".v1", ".v2"]);
            showElements([".n", ".k"]);
        } else if (a === "6") {
            hideElements([".n1", ".n2", ".v1", ".v2", ".c", ".r", ".k", ".d1", ".d2"]);
            showElements([".three", ".x", ".h", ".n"]);
        }

        // Event listener for the 'change' event
        document.getElementById('test').addEventListener('change', function() {
            var a = this.value;
            if (a === "1") {
                hideElements([".n1", ".n2", ".v1", ".v2", ".c", ".r", ".k", ".d1", ".d2", ".h", ".three", ".x"]);
                showElements([".n"]);
            } else if (a === "2") {
                hideElements([".n", ".v1", ".v2", ".c", ".r", ".k", ".d1", ".d2", ".h", ".three", ".x"]);
                showElements([".n1", ".n2"]);
            } else if (a === "3") {
                hideElements([".n", ".c", ".r", ".k", ".d1", ".d2", ".h", ".three", ".x"]);
                showElements([".n1", ".n2", ".v1", ".v2"]);
            } else if (a === "4") {
                hideElements([".n", ".k", ".d1", ".d2", ".h", ".three", ".x", ".n1", ".n2", ".v1", ".v2"]);
                showElements([".r", ".c"]);
            } else if (a === "5") {
                hideElements([".r", ".c", ".d1", ".d2", ".h", ".three", ".x", ".n1", ".n2", ".v1", ".v2"]);
                showElements([".n", ".k"]);
            } else if (a === "6") {
                hideElements([".n1", ".n2", ".v1", ".v2", ".c", ".r", ".k", ".d1", ".d2"]);
                showElements([".three", ".x", ".h", ".n"]);
            }
        });

        // Function to hide elements
        function hideElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.style.display = 'none';
                });
            });
        }

        // Function to show elements
        function showElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.style.display = 'block';
                });
            });
        }
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>