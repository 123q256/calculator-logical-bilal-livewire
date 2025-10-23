<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php
                if (!isset($detail)) {
                    $_POST['grades'] = "2";
                }
            @endphp
            <p class="col-span-12  mb-2"><strong>{{ $lang['8'] }}:</strong> {{ $lang['9'] }}.</p>

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="angle" class="font-s-14 text-blue">{{$lang['1']}}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="angle" id="angle" step="any" min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle']) ? $_POST['angle'] : '120' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="angle_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_unit_dropdown')">{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }} ▾</label>
                    <input type="text" name="angle_unit" value="{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }}" id="angle_unit" class="hidden">
                    <div id="angle_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'deg')">degrees (deg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'rad')">radiana (rad)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="rad" class="font-s-14 text-blue">{{$lang['2']}}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="rad" id="rad" step="any"   min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['rad']) ? $_POST['rad'] : '120' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="rad_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('rad_unit_dropdown')">{{ isset($_POST['rad_unit'])?$_POST['rad_unit']:'cm' }} ▾</label>
                    <input type="text" name="rad_unit" value="{{ isset($_POST['rad_unit'])?$_POST['rad_unit']:'cm' }}" id="rad_unit" class="hidden">
                    <div id="rad_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="rad_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad_unit', 'cm')">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad_unit', 'm')">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad_unit', 'in')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad_unit', 'ft')">feets (ft)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad_unit', 'yd')">yards (yd)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="diameter" class="font-s-14 text-blue">{{$lang['3']}}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="diameter" id="diameter" step="any"   min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['diameter']) ? $_POST['diameter'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="diameter_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('diameter_unit_dropdown')">{{ isset($_POST['diameter_unit'])?$_POST['diameter_unit']:'cm' }} ▾</label>
                    <input type="text" name="diameter_unit" value="{{ isset($_POST['diameter_unit'])?$_POST['diameter_unit']:'cm' }}" id="diameter_unit" class="hidden">
                    <div id="diameter_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="diameter_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'cm')">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'm')">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'in')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'ft')">feets (ft)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'yd')">yards (yd)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="area" class="font-s-14 text-blue">{{$lang['4']}} (A)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="area" id="area" step="any"   min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area']) ? $_POST['area'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_unit_dropdown')">{{ isset($_POST['area_unit'])?$_POST['area_unit']:'cm²' }} ▾</label>
                    <input type="text" name="area_unit" value="{{ isset($_POST['area_unit'])?$_POST['area_unit']:'cm²' }}" id="area_unit" class="hidden">
                    <div id="area_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'cm²')">square centimeters (cm²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'm²')">square meters (m²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'in²')">square inchs (in²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'ft²')">square feets (ft²)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'yd²')">square yards (yd²)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="arc" class="font-s-14 text-blue">{{$lang['5']}} (L)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="arc" id="arc" step="any"   min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['arc']) ? $_POST['arc'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="arc_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('arc_unit_dropdown')">{{ isset($_POST['arc_unit'])?$_POST['arc_unit']:'cm' }} ▾</label>
                    <input type="text" name="arc_unit" value="{{ isset($_POST['arc_unit'])?$_POST['arc_unit']:'cm' }}" id="arc_unit" class="hidden">
                    <div id="arc_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="arc_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('arc_unit', 'cm')">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('arc_unit', 'm')">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('arc_unit', 'in')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('arc_unit', 'ft')">feets (ft)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('arc_unit', 'yd')">yards (yd)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="c" class="font-s-14 text-blue">{{$lang['6']}} (c)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="c" id="c" step="any"   min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['c']) ? $_POST['c'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="c_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('c_unit_dropdown')">{{ isset($_POST['c_unit'])?$_POST['c_unit']:'cm' }} ▾</label>
                    <input type="text" name="c_unit" value="{{ isset($_POST['c_unit'])?$_POST['c_unit']:'cm' }}" id="c_unit" class="hidden">
                    <div id="c_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="c_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'cm')">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'm')">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'in')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'ft')">feets (ft)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_unit', 'yd')">yards (yd)</p>
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[18px]">
                                @if($detail['mode']===1)
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['4'] }} (A)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['area'],5)}} {{$detail['unit']}}²</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['5'] }} (L)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['arc'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['c'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['3'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['dia'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                @elseif($detail['mode']===2)
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['4'] }} (A)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['area'],5)}} {{$detail['unit']}}²</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['5'] }} (L)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['arc'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['c'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['2'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['rad'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                @elseif($detail['mode']===3)
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['7'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['angle'],5)}} rad / {{round(rad2deg($detail['angle']),5)}} deg</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['5'] }} (L)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['arc'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['c'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['3'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['dia'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                @elseif($detail['mode']===4)
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['2'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['rad'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['5'] }} (L)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['arc'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['c'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['3'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['dia'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                @elseif($detail['mode']===5)
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['4'] }} (A)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['area'],5)}} {{$detail['unit']}}²</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['2'] }} (L)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['rad'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['c'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['3'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['dia'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                @elseif($detail['mode']===6)
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['4'] }} (A)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['area'],5)}} {{$detail['unit']}}²</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['2'] }} (L)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['rad'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['5'] }} (L)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['c'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['3'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['dia'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                @elseif($detail['mode']===7)
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['4'] }} (A)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['area'],5)}} {{$detail['unit']}}²</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['7'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['angle'],5)}} rad / {{round(rad2deg($detail['angle']),5)}} deg</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['c'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['3'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['dia'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                @elseif($detail['mode']===8)
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['4'] }} (A)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['area'],5)}} {{$detail['unit']}}²</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['7'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['angle'],5)}} rad / {{round(rad2deg($detail['angle']),5)}} deg</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['5'] }} (L)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['arc'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['3'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['dia'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                @elseif($detail['mode']===9)
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['7'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['angle'],5)}} rad / {{round(rad2deg($detail['angle']),5)}} deg</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['5'] }} (L)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['arc'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['c'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['2'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['rad'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                @elseif($detail['mode']===10)
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['4'] }} (A)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['area'],5)}} {{$detail['unit']}}²</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['7'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['angle'],5)}} rad / {{round(rad2deg($detail['angle']),5)}} deg</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['c'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['2'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['rad'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                @elseif($detail['mode']===11)
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['4'] }} (A)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['area'],5)}} {{$detail['unit']}}²</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['7'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['angle'],5)}} rad / {{round(rad2deg($detail['angle']),5)}} deg</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['5'] }} (L)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['arc'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['2'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['rad'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['6'] }} (c)</strong></td>
                                        <td class="py-2 border-b">{{round($detail['c'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['2'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['rad'],5)}} {{$detail['unit']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{ $lang['3'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['dia'],5)}} {{$detail['unit']}}</td>
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
</form>