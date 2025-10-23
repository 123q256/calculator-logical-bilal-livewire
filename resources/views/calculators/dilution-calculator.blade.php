<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="cal" class="label">{!! $lang['1'] !!}:</label>
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
                            $name = [$lang['2']." (".$lang['3'].") (C₁)",$lang['4']." (".$lang['3'].") (V₁)",$lang['2']." (".$lang['5'].") (C₂)",$lang['4']." (".$lang['5'].") (V₂)"];
                            $val = ["c1","v1","c2","v2"];
                            optionsList($val,$name,isset(request()->cal)?request()->cal:'v2');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2 c1">
                    <label for="c1" class="label">{{ $lang['2'] }} 1:</label>
                    <div class="relative w-full ">
                        <input type="number" name="c1" id="c1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['c1'])?$_POST['c1']:'2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="c1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('c1_unit_dropdown')">{{ isset($_POST['c1_unit'])?$_POST['c1_unit']:'M' }} ▾</label>
                        <input type="text" name="c1_unit" value="{{ isset($_POST['c1_unit'])?$_POST['c1_unit']:'M' }}" id="c1_unit" class="hidden">
                        <div id="c1_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c1_unit', 'fM')">fM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c1_unit', 'pM')">pM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c1_unit', 'nM')">nM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c1_unit', 'μM')">μM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c1_unit', 'mM')">mM</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c1_unit', 'M')">M</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 v1">
                <label for="v1" class="label">{{ $lang['4'] }} 1:</label>
                <div class="relative w-full ">
                    <input type="number" name="v1" id="v1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['v1'])?$_POST['v1']:'3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="v1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('v1_unit_dropdown')">{{ isset($_POST['v1_unit'])?$_POST['v1_unit']:'mL' }} ▾</label>
                    <input type="text" name="v1_unit" value="{{ isset($_POST['v1_unit'])?$_POST['v1_unit']:'mL' }}" id="v1_unit" class="hidden">
                    <div id="v1_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'nL')">nL</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'μL')">μL</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'mL')">mL</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'L')">L</p>
                    </div>
                </div>
                </div>
                <div class="space-y-2 c2">
                <label for="c2" class="label">{{ $lang['2'] }} 2:</label>
                <div class="relative w-full ">
                    <input type="number" name="c2" id="c2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['c2'])?$_POST['c2']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="c2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('c2_unit_dropdown')">{{ isset($_POST['c2_unit'])?$_POST['c2_unit']:'mL' }} ▾</label>
                    <input type="text" name="c2_unit" value="{{ isset($_POST['c2_unit'])?$_POST['c2_unit']:'mL' }}" id="c2_unit" class="hidden">
                    <div id="c2_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c2_unit', 'fM')">fM</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c2_unit', 'pM')">pM</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c2_unit', 'nM')">nM</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c2_unit', 'mM')">mM</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c2_unit', 'mM')">mM</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c2_unit', 'M')">M</p>
                    </div>
                </div>
                </div>
                <div class="space-y-2 v2 hidden">
                <label for="v2" class="label">{{ $lang['4'] }} 2:</label>
                <div class="relative w-full ">
                    <input type="number" name="v2" id="v2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['v2'])?$_POST['v2']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="v2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('v2_unit_dropdown')">{{ isset($_POST['v2_unit'])?$_POST['v2_unit']:'mL' }} ▾</label>
                    <input type="text" name="v2_unit" value="{{ isset($_POST['v2_unit'])?$_POST['v2_unit']:'mL' }}" id="v2_unit" class="hidden">
                    <div id="c2_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'nL')">nL</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'μL')">μL</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'mL')">mL</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'L')">L</p>
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
                    @php
                        $ans=$detail['ans'];
                        if(request()->cal==='c1'){
                            $head=$lang['6']." (".$lang['3'].")";
                        }elseif(request()->cal==='v1'){
                            $head=$lang['4']." (".$lang['3'].")";
                        }elseif(request()->cal==='c2'){
                            $head=$lang['6']." (".$lang['5'].")";
                        }elseif(request()->cal==='v2'){
                            $head=$lang['4']." (".$lang['5'].")";
                        }
                    @endphp
                    <div class="w-full">
                        <p class=""><strong>{{ $head }}</strong></p>
                        <p class="my-3"><strong class="text-[#119154]" style="font-size: 30px;">{!! $ans !!}</strong></p>
                        <p class="my-2"><strong>{{ $lang['6'] }}</strong></p>
                        <div class="w-full overflow-auto">
                            <table class="col-12 col-lg-7" cellspacing="0">
                                @if(request()->cal==='c1' || request()->cal==='c2')
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
                                @elseif(request()->cal==='v1' || request()->cal==='v2')
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
                    if (cal === "c1") {
                        showElements(['c2', 'v1', 'v2']);
                        hideElements(['c1']);
                    } else if (cal === "v1") {
                        showElements(['c1', 'c2', 'v2']);
                        hideElements(['v1']);
                    } else if (cal === "c2") {
                        showElements(['c1', 'v1', 'v2']);
                        hideElements(['c2']);
                    } else if (cal === "v2") {
                        showElements(['c1', 'v1', 'c2']);
                        hideElements(['v2']);
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