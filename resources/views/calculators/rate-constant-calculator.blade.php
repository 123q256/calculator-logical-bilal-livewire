<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
                @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
               @endif
               <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                    <div class="grid grid-cols-1  gap-4">
                        <div class="space-y-2 relative">
                            <label for="unit_x" class="label">{!! $lang['1'] !!}:</label>
                            <select name="unit_x" id="unit_x" class="input">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                        {!! $arr2[$index] !!}
                                    </option>
                                @php
                                    }}
                                    $name = [$lang['5'], $lang['6'], $lang['7']];
                                    $val = ["uni", "bi", "tri"];
                                    optionsList($val,$name,isset(request()->unit_x)?request()->unit_x:'uni');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 mt-4  gap-4">
                        <div class="col-12 text-center">
                            <p class="one"><strong>{!! $lang['2'] !!}<span id="a">{!! $lang['3'] !!}</span><sup id="seq_0" class="hidden">2</sup></strong></p>
                            <p class="two hidden"><strong>rate = K [A]<sup id="seq_1" class="hidden">2</sup>[B]<sup id="seq_2" class="hidden">2</sup></strong></p>
                            <p class="three hidden"><strong>rate = K [A]<sup id="seq_3" class="hidden">2</sup>[B]<sup id="seq_4" class="hidden">2</sup>[C]<sup id="seq_5" class="hidden">2</sup></strong></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 mt-4   gap-4">
                        <div class="col-12 first_div">
                            <div class="grid grid-cols-12 mt-4   gap-4">
                                <div class="col-span-12 ">
                                    <label for="module_x" class="label">{!! $lang['4'] !!}:</label>
                                    <div class="w-100 py-2 position-relative">
                                        <select name="module_x" id="module_x" class="input">
                                            @php
                                                $name = [$lang['8'], $lang['9'], $lang['10']];
                                                $val = ["0", "1", "2"];
                                                optionsList($val,$name,isset(request()->module_x)?request()->module_x:'1');
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="con_a" class="label">{{ $lang['11'] }}:</label>
                                    <div class="relative w-full my-2 ">
                                        <input type="number" name="con_a" id="con_a" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['con_a'])?$_POST['con_a']:'3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                        <label for="unit_a" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_a_dropdown')">{{ isset($_POST['unit_a'])?$_POST['unit_a']:'M' }} ▾</label>
                                        <input type="text" name="unit_a" value="{{ isset($_POST['unit_a'])?$_POST['unit_a']:'M' }}" id="unit_a" class="hidden">
                                        <div id="unit_a_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_a">
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'M')">M</p>
                                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'mM')">mM</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'μM')">μM</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'nM')">nM</p>
                                        </div>
                                    </div>
                                 </div>
                                 <div class="col-span-6">
                                    <label for="half_a" class="label">{{ $lang['12'] }} T<sub>1/2</sub>:</label>
                                    <div class="relative w-full my-2 ">
                                        <input type="number" name="half_a" id="half_a" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['half_a'])?$_POST['half_a']:'2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                        <label for="time_a" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('time_a_dropdown')">{{ isset($_POST['time_a'])?$_POST['time_a']:'sec' }} ▾</label>
                                        <input type="text" name="time_a" value="{{ isset($_POST['time_a'])?$_POST['time_a']:'sec' }}" id="time_a" class="hidden">
                                        <div id="time_a_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="time_a">
                                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_a', 'μs')">microseconds (μs)</p>
                                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_a', 'ms')">milliseconds (ms)</p>
                                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_a', 'sec')">seconds (sec)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_a', 'min')">minutes (min)</p>
                                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_a', 'min/sec')">minutes per second (min/sec)</p>
                                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_a', 'hrs')">hours (hrs)</p>
                                        </div>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 mt-4  gap-4">
                        <div class="col-12 second_div hidden">
                            <div class="grid grid-cols-12 mt-4   gap-4">
                                <div class="col-span-12 ">
                                    <label for="module_y" class="label">{!! $lang['13'] !!}:</label>
                                    <div class="w-100 py-2 position-relative">
                                        <select name="module_y" id="module_y" class="input">
                                            @php
                                                $name = [$lang['9'], $lang['10']];
                                                $val = ["1", "2"];
                                                optionsList($val,$name,isset(request()->module_y)?request()->module_y:'1');
                                            @endphp
                                        </select>
                                    </div>
                                </div>

                                <div class="col-span-6">
                                    <label for="con_b" class="label">{{ $lang['14'] }}:</label>
                                    <div class="relative w-full my-2 ">
                                        <input type="number" name="con_b" id="con_b" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['con_b'])?$_POST['con_b']:'3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                        <label for="unit_b" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_b_dropdown')">{{ isset($_POST['unit_b'])?$_POST['unit_b']:'M' }} ▾</label>
                                        <input type="text" name="unit_b" value="{{ isset($_POST['unit_b'])?$_POST['unit_b']:'M' }}" id="unit_b" class="hidden">
                                        <div id="unit_b_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_b">
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_b', 'M')">M</p>
                                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_b', 'mM')">mM</p>
                                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_b', 'μM')">μM</p>
                                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_b', 'nM')">nM</p>
                                        </div>
                                    </div>
                                 </div>
                             
                              <div class="col-span-6">
                                <label for="half_b" class="label">{{ $lang['12'] }} T<sub>1/2</sub>:</label>
                                    <div class="relative w-full my-2 ">
                                        <input type="number" name="half_b" id="half_b" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['half_b'])?$_POST['half_b']:'2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                        <label for="time_b" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('time_b_dropdown')">{{ isset($_POST['time_b'])?$_POST['time_b']:'sec' }} ▾</label>
                                        <input type="text" name="time_b" value="{{ isset($_POST['time_b'])?$_POST['time_b']:'sec' }}" id="time_b" class="hidden">
                                        <div id="time_b_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="time_b">
                                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_b', 'μs')">microseconds (μs)</p>
                                            <p   class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_b', 'ms')">milliseconds (ms)</p>
                                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_b', 'sec')">seconds (sec)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_b', 'min')">minutes (min)</p>
                                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_b', 'min/sec')">minutes per second (min/sec)</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_b', 'hrs')">hours (hrs)</p>
                                        </div>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 mt-4   gap-4">
                        <div class="col-12 third_div hidden">
                            <div class="grid grid-cols-12 mt-4   gap-4">
                                <div class="col-span-12">
                                    <label for="module_z" class="label">{!! $lang['15'] !!}:</label>
                                    <div class="w-100 py-2 position-relative">
                                        <select name="module_z" id="module_z" class="input">
                                            @php
                                                $name = [$lang['9'], $lang['10']];
                                                $val = ["1", "2"];
                                                optionsList($val,$name,isset(request()->module_z)?request()->module_z:'1');
                                            @endphp
                                        </select>
                                    </div>
                                </div>
                                <div class="col-span-6">
                                    <label for="con_c" class="label">{{ $lang['16'] }}:</label>
                                    <div class="relative w-full my-2 ">
                                        <input type="number" name="con_c" id="con_c" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['con_c'])?$_POST['con_c']:'3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                        <label for="unit_c" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_c_dropdown')">{{ isset($_POST['unit_c'])?$_POST['unit_c']:'M' }} ▾</label>
                                        <input type="text" name="unit_c" value="{{ isset($_POST['unit_c'])?$_POST['unit_c']:'M' }}" id="unit_c" class="hidden">
                                        <div id="unit_c_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_c">
                                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_c', 'M')">M</p>
                                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_c', 'mM')">mM</p>
                                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_c', 'μM')">μM</p>
                                            <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_c', 'nM')">nM</p>
                                        </div>
                                    </div>
                                 </div>
                                <div class="col-span-6">
                                    <label for="half_c" class="label">{{ $lang['12'] }} T<sub>1/2</sub>:</label>
                                        <div class="relative w-full my-2 ">
                                            <input type="number" name="half_c" id="half_c" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['half_c'])?$_POST['half_c']:'2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                            <label for="time_c" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('time_c_dropdown')">{{ isset($_POST['time_c'])?$_POST['time_c']:'sec' }} ▾</label>
                                            <input type="text" name="time_c" value="{{ isset($_POST['time_c'])?$_POST['time_c']:'sec' }}" id="time_c" class="hidden">
                                            <div id="time_c_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="time_c">
                                                <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_c', 'μs')">microseconds (μs)</p>
                                                <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_c', 'ms')">milliseconds (ms)</p>
                                                <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_c', 'sec')">seconds (sec)</p>
                                                <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_c', 'min')">minutes (min)</p>
                                                <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_c', 'min/sec')">minutes per second (min/sec)</p>
                                                <p  class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_c', 'hrs')">hours (hrs)</p>
                                            </div>
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
                    <div class="w-full  mt-3">
                        <div class="w-full">
                            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                                <div class="mt-2">
                                    <p><strong>{!! $lang['17'] !!} (K)</strong></p>
                                    <p><strong class="text-[#119154] text-[25px]">{{ round($detail['k_res'], 5) }}</strong> <strong class="text-[20px]">sec</strong></p>
                                </div>
                                <div class="mt-2">
                                    <p><strong>{!! $lang['18'] !!}</strong></p>
                                    <p><strong class="text-[#119154] text-[25px]">{{ round($detail['rate_res'], 5) }}</strong> <strong class="text-[20px]">M s<sup>-1</sup></strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function handleUnitChange() {
                    var unit_x = document.getElementById('unit_x').value;
                    var module_x = document.getElementById('module_x').value;

                    document.querySelectorAll('.one, .two, .three, .first_div, .second_div, .third_div').forEach(function(el) {
                        el.style.display = 'none';
                    });

                    if (unit_x == 'uni') {
                        document.querySelector('.one').style.display = 'block';
                        document.querySelector('.first_div').style.display = 'block';
                        if (module_x === '1') {
                            document.querySelector('#module_x option[value="0"]').style.display = 'block';
                        }
                    } else if (unit_x == 'bi') {
                        document.querySelector('.two').style.display = 'block';
                        document.querySelector('.first_div').style.display = 'block';
                        document.querySelector('.second_div').style.display = 'block';
                        if (module_x === '1') {
                            document.querySelector('#module_x option[value="0"]').style.display = 'none';
                        }
                    } else if (unit_x == 'tri') {
                        document.querySelector('.three').style.display = 'block';
                        document.querySelector('.first_div').style.display = 'block';
                        document.querySelector('.second_div').style.display = 'block';
                        document.querySelector('.third_div').style.display = 'block';
                        document.getElementById('u_fi').style.display = 'none';
                        if (module_x === '1') {
                            document.querySelector('#module_x option[value="0"]').style.display = 'none';
                        }
                    }
                }

                document.getElementById('unit_x').addEventListener('change', handleUnitChange);
                handleUnitChange();

                function handleModuleXChange() {
                    var module_x = document.getElementById('module_x').value;

                    if (module_x == '0') {
                        document.getElementById('a').style.display = 'none';
                        document.querySelector('.one #seq_0').style.display = 'none';
                    } else if (module_x == '1') {
                        document.getElementById('a').style.display = 'inline';
                        document.querySelector('.one #seq_0').style.display = 'none';
                        document.querySelector('.two #seq_1').style.display = 'none';
                        document.querySelector('.three #seq_3').style.display = 'none';
                    } else if (module_x == '2') {
                        document.getElementById('a').style.display = 'inline';
                        document.querySelector('.one #seq_0').style.display = 'block';
                        document.querySelector('.two #seq_1').style.display = 'inline';
                        document.querySelector('.three #seq_3').style.display = 'inline';
                    }
                }

                document.getElementById('module_x').addEventListener('change', handleModuleXChange);
                handleModuleXChange();

                function handleModuleYChange() {
                    var module_y = document.getElementById('module_y').value;

                    if (module_y == '1') {
                        document.querySelector('.two #seq_2').style.display = 'none';
                        document.querySelector('.three #seq_4').style.display = 'none';
                    } else if (module_y == '2') {
                        document.querySelector('.two #seq_2').style.display = 'inline';
                        document.querySelector('.three #seq_4').style.display = 'inline';
                    }
                }

                document.getElementById('module_y').addEventListener('change', handleModuleYChange);
                handleModuleYChange();

                function handleModuleZChange() {
                    var module_z = document.getElementById('module_z').value;

                    if (module_z == '1') {
                        document.querySelector('.three #seq_5').style.display = 'none';
                    } else if (module_z == '2') {
                        document.querySelector('.three #seq_5').style.display = 'inline';
                    }
                }

                document.getElementById('module_z').addEventListener('change', handleModuleZChange);
                handleModuleZChange();
            });
        </script>
    @endpush
</form>