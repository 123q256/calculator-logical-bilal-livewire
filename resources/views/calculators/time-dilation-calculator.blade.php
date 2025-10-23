<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12  mt-3  gap-4">

                    <div class="col-span-12" id="interval">
                        <label for="interval1" class="font-s-14 text-blue">{{ $lang['1'] }} (Δt):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="interval" id="interval1" value="{{ isset($_POST['interval'])?$_POST['interval']:'5' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-12" id="dubble_input">
                        <div class="grid grid-cols-12  mt-3  gap-4">
                            <div class="col-span-6 ">
                                <label for="interval_one" class="font-s-14 text-blue col-12 px-2">{{ $lang['1'] }} (Δt):</label>
                                <div class="w-full py-2 relative">
                                    <input type="number" step="any" name="interval_one" id="interval_one" value="{{ isset($_POST['interval_one'])?$_POST['interval_one']:'9' }}" class="input" aria-label="input" placeholder="00" />
                                    <span class="text-blue input_unit" id="one_in"></span>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <div class="w-full py-2 relative">
                                    <label for="interval_sec" class="font-s-14 text-blue col-12 px-2">&nbsp</label>
                                    <input type="number" step="any" name="interval_sec" id="interval_sec" value="{{ isset($_POST['interval_sec'])?$_POST['interval_sec']:'7' }}" class="input" aria-label="input" placeholder="00" />
                                    <span class="text-blue input_unit mt-3" id="one_tow"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 ">
                        <label for="dropdown" class="font-s-14">&nbsp;</label>
                        <div class="w-full py-2">
                            <select name="interval_unit" id="dropdown" class="input" onchange="mySelection(this)">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                        {!! $arr2[$index] !!}
                                    </option>
                                @php
                                    }}
                                    $name = ["sec", "mins", "hrs", "days", "wks", "mos", "yrs", "mins/sec", "hrs/mins", "yrs/mos", "wks/days"];
                                    $val = ["sec", "mins", "hrs", "days", "wks", "mos", "yrs", "mins/sec", "hrs/mins", "yrs/mos", "wks/days"];
                                    optionsList($val,$name,isset($_POST['interval_unit'])?$_POST['interval_unit']:'sec');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12">
                            <label for="velocity" class="font-s-14 text-blue">{{ $lang[2] }} (v):</label>
                            <div class="relative w-full mt-[7px]">
                            <input type="number" name="velocity" id="velocity" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['velocity'])?$_POST['velocity']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="velocity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('velocity_unit_dropdown')">{{ isset($_POST['velocity_unit'])?$_POST['velocity_unit']:'cm' }} ▾</label>
                            <input type="text" name="velocity_unit" value="{{ isset($_POST['velocity_unit'])?$_POST['velocity_unit']:'cm' }}" id="velocity_unit" class="hidden">
                            <div id="velocity_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="velocity_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'km/s')">km/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'm/s')">m/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'mi/s')">mi/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'c')">c</p>
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  overflow-auto">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang[3] ?> (Δt')</td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'],4) . ' '.$lang[5] }}</strong></td>
                                    </tr>                        
                                </table>
                            </div>
                              <p class="col-12 mt-3 px-2"><strong><?=$lang[3]?> (Δt') <?=$lang[4]?></strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%] overflow-auto">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang[6] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'] / 60 , 4) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang[7] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'] / 3600, 4) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang[8] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer']  / 86400, 4) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang[9] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'] /604800, 4) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang[10] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'] / 2629800, 4) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b"><?= $lang[11] ?></td>
                                        <td class="p-2 border-b"><strong class="text-blue">{{ round($detail['answer'] /31557600, 4) }}</strong></td>
                                    </tr>
                                </table>
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
            var dropdown = document.getElementById('dropdown');
            var dubbleInput = document.getElementById('dubble_input');
            var interval = document.getElementById('interval');
            var oneIn = document.getElementById('one_in');
            var oneTow = document.getElementById('one_tow');

            function checkDropdownValue(value) {
                if (value === 'mins/sec' || value === 'hrs/mins' || value === 'yrs/mos' || value === 'wks/days') {
                    dubbleInput.style.display = 'block';
                    interval.style.display = 'none';
                } else {
                    dubbleInput.style.display = 'none';
                    interval.style.display = 'block';
                }

                if (value === 'mins/sec') {
                    oneIn.textContent = "mins";
                    oneTow.textContent = "sec";
                } else if (value === 'hrs/mins') {
                    oneIn.textContent = "hrs";
                    oneTow.textContent = "mins";
                } else if (value === 'yrs/mos') {
                    oneIn.textContent = "yrs";
                    oneTow.textContent = "mos";
                } else if (value === 'wks/days') {
                    oneIn.textContent = "wks";
                    oneTow.textContent = "days";
                }
            }

            checkDropdownValue(dropdown.value);

            dropdown.addEventListener('change', function() {
                checkDropdownValue(dropdown.value);
            });

            window.mySelection = function(chal) {
                var value = chal.value;
                checkDropdownValue(value);
            }
        });
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>