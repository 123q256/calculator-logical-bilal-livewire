<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="selection" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <select class="input" name="selection" id="selection">
                            <option value="1"
                                {{ isset($_POST['selection']) && $_POST['selection'] == '1' ? 'selected' : '' }}>
                                {{ $lang['2'] }}</option>
                            <option value="2"
                                {{ isset($_POST['selection']) && $_POST['selection'] == '2' ? 'selected' : '' }}>
                                {{ $lang['3'] }}</option>
                            <option value="3"
                                {{ isset($_POST['selection']) && $_POST['selection'] == '3' ? 'selected' : '' }}>
                                {{ $lang['4'] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 dis ">
                    <label for="acceleration" class="font-s-14 text-blue">{{ $lang['5'] }}(g)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="acceleration" id="acceleration" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['acceleration'])?$_POST['acceleration']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="a_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('a_unit_dropdown')">{{ isset($_POST['a_unit'])?$_POST['a_unit']:'m/s²' }} ▾</label>
                       <input type="text" name="a_unit" value="{{ isset($_POST['a_unit'])?$_POST['a_unit']:'m/s²' }}" id="a_unit" class="hidden">
                       <div id="a_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="a_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'm/s')">m/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'g')">g</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'ft/s²')">ft/s²</p>
                       </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 initial ">
                    <label for="velocity" class="font-s-14 text-blue">{{ $lang['6'] }}(v₀)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="velocity" id="velocity" step="any"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['velocity'])?$_POST['velocity']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="v_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('v_unit_dropdown')">{{ isset($_POST['v_unit'])?$_POST['v_unit']:'m/s²' }} ▾</label>
                       <input type="text" name="v_unit" value="{{ isset($_POST['v_unit'])?$_POST['v_unit']:'m/s²' }}" id="v_unit" class="hidden">
                       <div id="v_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="v_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'm/s²')">m/s²</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'km/h')">km/h</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'ft/s')">ft/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'mph')">mph</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'knots')">knots</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'km/s')">km/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'mi/s')">mi/s</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'ft/min')">ft/min</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_unit', 'm/min')">m/min</p>
                       </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 height">
                    <label for="height" class="font-s-14 text-blue">{{ $lang['7'] }}(h)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="height" id="height" step="any"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height'])?$_POST['height']:'1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="h_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('h_unit_dropdown')">{{ isset($_POST['h_unit'])?$_POST['h_unit']:'cm' }} ▾</label>
                       <input type="text" name="h_unit" value="{{ isset($_POST['h_unit'])?$_POST['h_unit']:'cm' }}" id="h_unit" class="hidden">
                       <div id="h_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="h_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'cm')">cm</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'm')">m</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'km')">km</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'in')">in</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'ft')">ft</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'yd')">yd</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('h_unit', 'mi')">mi</p>

                       </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 time hidden">
                    <label for="time" class="font-s-14 text-blue">{{ $lang['8'] }}(t)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="time" id="time" step="any"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['time'])?$_POST['time']:'1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="t_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t_unit_dropdown')">{{ isset($_POST['t_unit'])?$_POST['t_unit']:'sec' }} ▾</label>
                       <input type="text" name="t_unit" value="{{ isset($_POST['t_unit'])?$_POST['t_unit']:'sec' }}" id="t_unit" class="hidden">
                       <div id="t_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="t_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'sec')">sec</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'min')">min</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'hrs')">hrs</p>

                       </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden velocity">
                    <label for="velocity_one" class="font-s-14 text-blue">{{ $lang['9'] }}(V)</label>
                    <div class="relative w-full mt-[7px]">
                       <input type="number" name="velocity_one" id="velocity_one" step="any"  min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['velocity_one'])?$_POST['velocity_one']:'1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                       <label for="v_one_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('v_one_unit_dropdown')">{{ isset($_POST['v_one_unit'])?$_POST['v_one_unit']:'sec' }} ▾</label>
                       <input type="text" name="v_one_unit" value="{{ isset($_POST['v_one_unit'])?$_POST['v_one_unit']:'m/s²' }}" id="v_one_unit" class="hidden">
                       <div id="v_one_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="v_one_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_one_unit', 'm/s²')">m/s²</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_one_unit', 'km/h')">km/h</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_one_unit', 'ft/s')">ft/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_one_unit', 'mph')">mph</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_one_unit', 'knots')">knots</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_one_unit', 'km/s')">km/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_one_unit', 'mi/s')">mi/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_one_unit', 'ft/min')">ft/min</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v_one_unit', 'm/min')">m/min</p>

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
                    <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                        <table class="w-full font-s-18">
                            @if (isset($detail['answer1']) && isset($detail['answer2']))
                                <tr>
                                    <td class="py-2 border-b" width="35%"><strong>{{ $lang[10] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['answer1'] }} (sec)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="35%"><strong>{{ $lang[9] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['answer2'] }} (m/s)</td>
                                </tr>
                            @elseif (isset($detail['answer3']) && isset($detail['answer4']))
                                <tr>
                                    <td class="py-2 border-b" width="35%"><strong>{{ $lang[7] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['answer3'] }} (m)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="35%"><strong>{{ $lang[9] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['answer4'] }} (m/s)</td>
                                </tr>
                            @elseif (isset($detail['answer5']) && isset($detail['answer6']))
                                <tr>
                                    <td class="py-2 border-b" width="35%"><strong>{{ $lang[8] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['answer5'] }} (sec)</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="35%"><strong>{{ $lang[9] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['answer6'] }} (m)</td>
                                </tr>
                            @endif
            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')

<script>
    @if (isset($error))
        var selection = "{{ $_POST['selection'] }}";

        function showElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.classList.remove('hidden');
                });
            });
        }

        function hideElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.classList.add('hidden');
                });
            });
        }

        if (selection == "1") {
            hideElements(['.velocity', '.time']);
            showElements(['.height']);
        } else if (selection == "2") {
            showElements(['.time']);
            hideElements(['.height', '.velocity']);
        } else if (selection == "3") {
            hideElements(['.time', '.height']);
            showElements(['.velocity']);
        }
    @endif

    @if (isset($detail))
        var selection = "{{ $_POST['selection'] }}";

        function showElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.classList.remove('hidden');
                });
            });
        }

        function hideElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelectorAll(selector).forEach(function(element) {
                    element.classList.add('hidden');
                });
            });
        }

        if (selection == "1") {
            hideElements(['.velocity', '.time']);
            showElements(['.height']);
        } else if (selection == "2") {
            showElements(['.time']);
            hideElements(['.height', '.velocity']);
        } else if (selection == "3") {
            hideElements(['.time', '.height']);
            showElements(['.velocity']);
        }
    @endif



    document.addEventListener('DOMContentLoaded', function() {
        'use strict';

        document.getElementById('selection').addEventListener('change', function() {
            var val = this.value;

            function showElements(selectors) {
                selectors.forEach(function(selector) {
                    document.querySelectorAll(selector).forEach(function(element) {
                        element.classList.remove('hidden');
                    });
                });
            }

            function hideElements(selectors) {
                selectors.forEach(function(selector) {
                    document.querySelectorAll(selector).forEach(function(element) {
                        element.classList.add('hidden');
                    });
                });
            }

            if (val == "1") {
                hideElements(['.velocity', '.time']);
                showElements(['.height']);
            } else if (val == "2") {
                showElements(['.time']);
                hideElements(['.height', '.velocity']);
            } else if (val == "3") {
                hideElements(['.time', '.height']);
                showElements(['.velocity']);
            }
        });
    });
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>