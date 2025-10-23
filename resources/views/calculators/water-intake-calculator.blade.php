<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="w-full lg:w-8/12 mx-auto">
            <div class="flex flex-wrap justify-center">
                <div class="grid grid-cols-2 lg:grid-cols-2 gap-4 mt-5 w-full">
                    <div class="w-full px-2 lg:pr-4">
                        <label for="gender" class="label">{!! $lang['gender'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select name="gender" id="gender" class="w-full border border-gray-300 rounded-md py-2 px-3">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                        {{ $arr2[$index] }}
                                    </option>
                                @php
                                    }}
                                    $name = [$lang['male'],$lang['female']];
                                    $val = ["Male","Female"];
                                    optionsList($val,$name,isset(request()->gender)?request()->gender:'Male');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="w-full px-2 lg:pl-4">
                        <label for="weight" class="label">{!! $lang['weight'] !!}:</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="weight" id="weight" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-[#3E9960] w-full" value="{{ isset($_POST['weight'])?$_POST['weight']:'160' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit" class="absolute  cursor-pointer text-sm underline right-6 top-4 mt-1" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }} ▾</label>
                            <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }}" id="unit" class="hidden">
                            <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[80%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'lbs')">pounds (lbs)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'kg')">kilograms (kg)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-5 w-full">
                    <div class="w-full px-2 lg:pr-4">
                        <label for="activity" class="label">{!! $lang['activity'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select name="activity" id="activity" class="w-full border border-gray-300 rounded-md py-2 px-3">
                                @php
                                    $name = [$lang['Sedentary'],$lang['Lightly'],$lang['Moderately'],$lang['Very']];
                                    $val = ["0","0.1","0.2","0.4"];
                                    optionsList($val,$name,isset(request()->activity)?request()->activity:'0');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="w-full px-2 lg:pl-4">
                        <label for="weather" class="label">{!! $lang['weather'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select name="weather" id="weather" class="w-full border border-gray-300 rounded-md py-2 px-3">
                                @php
                                    $name = [$lang['e_cool'],$lang['cool'],$lang['hot'],$lang['e_hot']];
                                    $val = ["0.05","0","0.1","0.2"];
                                    optionsList($val,$name,isset(request()->weather)?request()->weather:'0');
                                @endphp
                            </select>
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
        {{-- result --}}
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full  rounded-xl  mt-4 ">
                        <div class="w-full">
                            <div class=" border rounded-xl px-4 py-3 mt-2" style="border: 1px solid #c1b8b899;">
                                <strong>{{ $lang['1'] }}</strong>
                                <strong class="text-[#119154] text-2xl">{{ round($detail['cups']) }}</strong>
                                <strong>{{ $lang['2'] }}</strong>
                            </div>
                            <div class=" border rounded-xl px-4 py-3 mt-3" style="border: 1px solid #c1b8b899;">
                                <strong>Which is</strong>
                                <strong class="text-[#119154] text-2xl">{{ round($detail['us_ounce'] * 1.043175556502 ,1) }}</strong>
                                <strong>Ounces</strong>
                            </div>
                            <div class="w-full">
                                <div class="flex flex-wrap items-center">
                                    <div class="w-full lg:w-1/4 mt-3 lg:pr-2"><strong>{{ $lang['result'] }}</strong></div>
                                    <div class="w-full lg:w-1/4 mt-3 px-2">
                                        <div class="flex justify-between  border rounded-xl px-4 py-3" style="border: 1px solid #c1b8b899;">
                                            <strong class="pr-3">{{ round($detail['us_ounce'] * 29.5735 ,2) }}</strong>
                                            <strong>{{ $lang['mili'] }}</strong>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-1/4 mt-3 px-2">
                                        <div class="flex justify-between  border rounded-xl px-4 py-3" style="border: 1px solid #c1b8b899;">
                                            <strong class="pr-3">{{ round($detail['us_ounce'] * 0.0295735 ,2) }}</strong>
                                            <strong>{{ $lang['li'] }}</strong>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-1/4 mt-3 px-2">
                                        <div class="flex justify-between  border rounded-xl px-4 py-3" style="border: 1px solid #c1b8b899;">
                                            <strong class="pr-3">{{ number_format($detail['us_ounce'] * 0.125,2) }}</strong>
                                            <strong>{{ $lang['cu'] }}</strong>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <p class="mt-3"><strong class="text-blue">{{ $lang['12'] }}</strong></p>
                            <p>{{ $lang['13'] }}</p>
                            <p class="mt-2">{{ $lang['14'] }}</p>
                            <div class="w-full overflow-auto mt-4">
                                <table class="w-full text-sm" cellspacing="0">
                                    <tr class="bg-gradient-to-r from-[#2845F5] to-[#2845F5] text-white">
                                        <td rowspan="2" class="text-center rounded-l-xl border-r px-4 py-3">
                                            {{ $lang['15'] }}
                                        </td>
                                        <td colspan="2" class="border-r text-center px-4 py-3">
                                            {{ $lang['16'] }}
                                        </td>
                                        <td colspan="2" class="text-center rounded-tr-xl px-4 py-3">
                                            {{ $lang['17'] }}
                                        </td>
                                    </tr>
                                    <tr class="bg-gradient-to-r from-[#2845F5] to-[#2845F5] text-white">
                                        <td class="border-r px-4 py-3">{{ $lang['18'] }} ({{ $lang['30'] }})</td>
                                        <td class="border-r px-4 py-3">{{ $lang['19'] }} ({{ $lang['30'] }})</td>
                                        <td class="border-r px-4 py-3">{{ $lang['18'] }} ({{ $lang['30'] }})</td>
                                        <td class="rounded-br-xl px-4 py-3">{{ $lang['19'] }} ({{ $lang['30'] }})</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b px-3 py-2">0-6 mo.</td>
                                        <td class="border-b px-3 py-2">0.68 ({{ $lang['20'] }})</td>
                                        <td class="border-b px-3 py-2">0.68 ({{ $lang['20'] }})</td>
                                        <td class="border-b px-3 py-2">0.70</td>
                                        <td class="border-b px-3 py-2">0.70</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b px-3 py-2">6-12 mo.</td>
                                        <td class="border-b px-3 py-2">0.80 - 1.00</td>
                                        <td class="border-b px-3 py-2">0.64 - 0.80</td>
                                        <td class="border-b px-3 py-2">0.80</td>
                                        <td class="border-b px-3 py-2">0.80</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b px-3 py-2">1-2 {{ $lang['21'] }}</td>
                                        <td class="border-b px-3 py-2">1.10 - 1.20</td>
                                        <td class="border-b px-3 py-2">0.88 - 0.90</td>
                                        <td class="border-b px-3 py-2">N/A</td>
                                        <td class="border-b px-3 py-2">N/A</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b px-3 py-2">2-3 {{ $lang['21'] }}</td>
                                        <td class="border-b px-3 py-2">1.30</td>
                                        <td class="border-b px-3 py-2">1.00</td>
                                        <td class="border-b px-3 py-2">N/A</td>
                                        <td class="border-b px-3 py-2">N/A</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b px-3 py-2">1-3 {{ $lang['21'] }}</td>
                                        <td class="border-b px-3 py-2">N/A</td>
                                        <td class="border-b px-3 py-2">N/A</td>
                                        <td class="border-b px-3 py-2">1.30</td>
                                        <td class="border-b px-3 py-2">0.90</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b px-3 py-2">4-8 {{ $lang['21'] }}</td>
                                        <td class="border-b px-3 py-2">1.60</td>
                                        <td class="border-b px-3 py-2">1.20</td>
                                        <td class="border-b px-3 py-2">1.70</td>
                                        <td class="border-b px-3 py-2">1.20</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b px-3 py-2">9-13 y. {{ $lang['22'] }}</td>
                                        <td class="border-b px-3 py-2">2.10</td>
                                        <td class="border-b px-3 py-2">1.60</td>
                                        <td class="border-b px-3 py-2">2.40</td>
                                        <td class="border-b px-3 py-2">1.80</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b px-3 py-2">9-13 y. {{ $lang['23'] }}</td>
                                        <td class="border-b px-3 py-2">1.90</td>
                                        <td class="border-b px-3 py-2">1.50</td>
                                        <td class="border-b px-3 py-2">2.10</td>
                                        <td class="border-b px-3 py-2">1.60</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b px-3 py-2">{{ $lang['22'] }} 14+ &amp; {{ $lang['24'] }}</td>
                                        <td class="border-b px-3 py-2">2.50</td>
                                        <td class="border-b px-3 py-2">2.00</td>
                                        <td class="border-b px-3 py-2">3.30</td>
                                        <td class="border-b px-3 py-2">2.60</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b px-3 py-2">{{ $lang['23'] }} 14+ &amp; {{ $lang['25'] }}</td>
                                        <td class="border-b px-3 py-2">2.00</td>
                                        <td class="border-b px-3 py-2">1.60</td>
                                        <td class="border-b px-3 py-2">2.30</td>
                                        <td class="border-b px-3 py-2">1.80</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b px-3 py-2">{{ $lang['26'] }}</td>
                                        <td class="border-b px-3 py-2">2.30</td>
                                        <td class="border-b px-3 py-2">1.84</td>
                                        <td class="border-b px-3 py-2">2.60</td>
                                        <td class="border-b px-3 py-2">1.90</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b px-3 py-2">{{ $lang['27'] }}</td>
                                        <td class="border-b px-3 py-2">2.60</td>
                                        <td class="border-b px-3 py-2">2.10</td>
                                        <td class="border-b px-3 py-2">3.40</td>
                                        <td class="border-b px-3 py-2">2.80</td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2">{{ $lang['28'] }}</td>
                                        <td class="px-3 py-2">{{ $lang['29'] }}</td>
                                        <td class="px-3 py-2">{{ $lang['29'] }}</td>
                                        <td class="px-3 py-2">{{ $lang['29'] }}</td>
                                        <td class="px-3 py-2">{{ $lang['29'] }}</td>
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