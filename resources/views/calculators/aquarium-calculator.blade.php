<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

                <div class="col-span-6">
                    <div class="col-12 mt-0 mt-lg-2">
                        <label for="shape" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2"> 
                            <select name="shape" id="shape" class="input">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? "selected" : "" }}>
                                        {!! $arr2[$index] !!}
                                    </option>
                                @php
                                    }}
                                    $name=[$lang['2'],$lang['3'],$lang['4'],$lang['5'],$lang['6'],$lang['7'],$lang['8'],$lang['9'],$lang['10'],$lang['11'],$lang['12'],$lang['13'],$lang['34']];
                                    $val = ["1","2","3","4","5","6","7","8","9","10","11","12","13"];
                                    optionsList($val,$name,isset($_POST['shape'])?$_POST['shape']:'1');
                                @endphp
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mt-0 mt-lg-2 length">
                        <label for="length" class="label length_text">
                                {{ $lang['14']}}
                        :</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length']) ? $_POST['length'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'kg' }} ▾</label>
                            <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'kg' }}" id="length_unit" class="hidden">
                            <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('length_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 width">
                        <label for="width" class="label width_text">
                            {{ $lang['15']}}
                        :</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width']) ? $_POST['width'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'kg' }} ▾</label>
                            <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'kg' }}" id="width_unit" class="hidden">
                            <div id="width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('width_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 height ">
                        <label for="height" class="label height_text">
                            {{ $lang['16']}}
                        :</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="height" id="height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height']) ? $_POST['height'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('height_unit_dropdown')">{{ isset($_POST['height_unit'])?$_POST['height_unit']:'kg' }} ▾</label>
                            <input type="text" name="height_unit" value="{{ isset($_POST['height_unit'])?$_POST['height_unit']:'kg' }}" id="height_unit" class="hidden">
                            <div id="height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="height_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('height_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 front_pane">
                        <label for="front_pane" class="label front_pane_text">
                            {{ $lang['17']}}
                        :</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="front_pane" id="front_pane" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['front_pane']) ? $_POST['front_pane'] : '16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="front_pane_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('front_pane_unit_dropdown')">{{ isset($_POST['front_pane_unit'])?$_POST['front_pane_unit']:'kg' }} ▾</label>
                            <input type="text" name="front_pane_unit" value="{{ isset($_POST['front_pane_unit'])?$_POST['front_pane_unit']:'kg' }}" id="front_pane_unit" class="hidden">
                            <div id="front_pane_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="front_pane_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('front_pane_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 end_pane">
                        <label for="end_pane" class="label end_pane_text">
                            {{ $lang['18']}}
                        :</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="end_pane" id="end_pane" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['end_pane']) ? $_POST['end_pane'] : '16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="end_pane_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('end_pane_unit_dropdown')">{{ isset($_POST['end_pane_unit'])?$_POST['end_pane_unit']:'kg' }} ▾</label>
                            <input type="text" name="end_pane_unit" value="{{ isset($_POST['end_pane_unit'])?$_POST['end_pane_unit']:'kg' }}" id="end_pane_unit" class="hidden">
                            <div id="end_pane_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="end_pane_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('end_pane_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 radius">
                        <label for="radius" class="label">{{ $lang['19'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="radius" id="radius" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['radius']) ? $_POST['radius'] : '16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="radius_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('radius_unit_dropdown')">{{ isset($_POST['radius_unit'])?$_POST['radius_unit']:'kg' }} ▾</label>
                            <input type="text" name="radius_unit" value="{{ isset($_POST['radius_unit'])?$_POST['radius_unit']:'kg' }}" id="radius_unit" class="hidden">
                            <div id="radius_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="radius_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('radius_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 radius_one">
                        <label for="radius_one" class="label">{{ $lang['20'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="radius_one" id="radius_one" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['radius_one']) ? $_POST['radius_one'] : '16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="radius_one_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('radius_one_unit_dropdown')">{{ isset($_POST['radius_one_unit'])?$_POST['radius_one_unit']:'kg' }} ▾</label>
                            <input type="text" name="radius_one_unit" value="{{ isset($_POST['radius_one_unit'])?$_POST['radius_one_unit']:'kg' }}" id="radius_one_unit" class="hidden">
                            <div id="radius_one_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="radius_one_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('radius_one_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 radius_two ">
                        <label for="radius_two" class="label">{{ $lang['21'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="radius_two" id="radius_two" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['radius_two']) ? $_POST['radius_two'] : '16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="radius_two_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('radius_two_unit_dropdown')">{{ isset($_POST['radius_two_unit'])?$_POST['radius_two_unit']:'kg' }} ▾</label>
                            <input type="text" name="radius_two_unit" value="{{ isset($_POST['radius_two_unit'])?$_POST['radius_two_unit']:'kg' }}" id="radius_two_unit" class="hidden">
                            <div id="radius_two_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="radius_two_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('radius_two_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 long_side">
                        <label for="long_side" class="label">{{ $lang['22'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="long_side" id="long_side" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['long_side']) ? $_POST['long_side'] : '16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="long_side_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('long_side_unit_dropdown')">{{ isset($_POST['long_side_unit'])?$_POST['long_side_unit']:'kg' }} ▾</label>
                            <input type="text" name="long_side_unit" value="{{ isset($_POST['long_side_unit'])?$_POST['long_side_unit']:'kg' }}" id="long_side_unit" class="hidden">
                            <div id="long_side_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="long_side_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('long_side_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 short_side ">
                        <label for="short_side" class="label">{{ $lang['23'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="short_side" id="short_side" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['short_side']) ? $_POST['short_side'] : '16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="short_side_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('short_side_unit_dropdown')">{{ isset($_POST['short_side_unit'])?$_POST['short_side_unit']:'kg' }} ▾</label>
                            <input type="text" name="short_side_unit" value="{{ isset($_POST['short_side_unit'])?$_POST['short_side_unit']:'kg' }}" id="short_side_unit" class="hidden">
                            <div id="short_side_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="short_side_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('short_side_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 len_one">
                        <label for="len_one" class="label">{{ $lang['24'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="len_one" id="len_one" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['len_one']) ? $_POST['len_one'] : '16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="len_one_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('len_one_unit_dropdown')">{{ isset($_POST['len_one_unit'])?$_POST['len_one_unit']:'kg' }} ▾</label>
                            <input type="text" name="len_one_unit" value="{{ isset($_POST['len_one_unit'])?$_POST['len_one_unit']:'kg' }}" id="len_one_unit" class="hidden">
                            <div id="len_one_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="len_one_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('len_one_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 len_two">
                        <label for="len_two" class="label">{{ $lang['25'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="len_two" id="len_two" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['len_two']) ? $_POST['len_two'] : '16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="len_two_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('len_two_unit_dropdown')">{{ isset($_POST['len_two_unit'])?$_POST['len_two_unit']:'kg' }} ▾</label>
                            <input type="text" name="len_two_unit" value="{{ isset($_POST['len_two_unit'])?$_POST['len_two_unit']:'kg' }}" id="len_two_unit" class="hidden">
                            <div id="len_two_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="len_two_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('len_two_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 wid_one">
                        <label for="wid_one" class="label">{{ $lang['26'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="wid_one" id="wid_one" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wid_one']) ? $_POST['wid_one'] : '16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="wid_one_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wid_one_unit_dropdown')">{{ isset($_POST['wid_one_unit'])?$_POST['wid_one_unit']:'kg' }} ▾</label>
                            <input type="text" name="wid_one_unit" value="{{ isset($_POST['wid_one_unit'])?$_POST['wid_one_unit']:'kg' }}" id="wid_one_unit" class="hidden">
                            <div id="wid_one_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wid_one_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('wid_one_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 wid_two">
                        <label for="wid_two" class="label">{{ $lang['27'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="wid_two" id="wid_two" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wid_two']) ? $_POST['wid_two'] : '16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="wid_two_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wid_two_unit_dropdown')">{{ isset($_POST['wid_two_unit'])?$_POST['wid_two_unit']:'kg' }} ▾</label>
                            <input type="text" name="wid_two_unit" value="{{ isset($_POST['wid_two_unit'])?$_POST['wid_two_unit']:'kg' }}" id="wid_two_unit" class="hidden">
                            <div id="wid_two_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wid_two_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('wid_two_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 fill_depth">
                        <label for="fill_depth" class="label">{{ $lang['28'] }} ({{$lang['29']}}):</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="fill_depth" id="fill_depth" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fill_depth']) ? $_POST['fill_depth'] : '16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="fill_depth_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fill_depth_unit_dropdown')">{{ isset($_POST['fill_depth_unit'])?$_POST['fill_depth_unit']:'kg' }} ▾</label>
                            <input type="text" name="fill_depth_unit" value="{{ isset($_POST['fill_depth_unit'])?$_POST['fill_depth_unit']:'kg' }}" id="fill_depth_unit" class="hidden">
                            <div id="fill_depth_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fill_depth_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('fill_depth_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 full_width">
                        <label for="full_width" class="label">{{ $lang['36'] }} :</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="full_width" id="full_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['full_width']) ? $_POST['full_width'] : '16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="full_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('full_width_unit_dropdown')">{{ isset($_POST['full_width_unit'])?$_POST['full_width_unit']:'kg' }} ▾</label>
                            <input type="text" name="full_width_unit" value="{{ isset($_POST['full_width_unit'])?$_POST['full_width_unit']:'kg' }}" id="full_width_unit" class="hidden">
                            <div id="full_width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="full_width_unit">
                                @foreach (["cm","m","in","ft","yd"] as $name)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('full_width_unit', '{{ $name }}')"> {{ $name }}</p>
                            @endforeach
                            </div>
                         </div>
                    </div>
                </div>
                <div class="col-span-6 pt-5">
                    <img src="{{asset('images/pict12.png')}}" alt="ShapeImage" class="max-width my-lg-2 change_img" width="320px" height="250px">
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  lg:text-[18px] md:text-[18px] text-[16px]">
                                <table class="w-full">
                                    <tr>
                                        <td width="50%" class="border-b py-2"><strong>{{$lang['30']}} :</strong></td>
                                        <td class="border-b py-2">{{round($detail['volume']*0.000264172,2)}} (U.S Gallons)</td>
                                    </tr>
                                </table>
                                <p class="mt-2">{{$lang['31']}}</p>
                                <table class="w-full">
                                    <tr>
                                        <td width="50%" class="border-b py-2">{{$lang['32']}} :</td>
                                        <td class="border-b py-2">{{round($detail['volume'],3)}} <span class="black-text font_unit2">(cm)<sup>3</sup></span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['32']}} :</td>
                                        <td class="border-b py-2">{{round($detail['volume']*0.001,3)}} <span class="black-text font_unit2">(dm)<sup>3</sup></span></td>
                                    </tr>
                                        <tr>
                                        <td class="border-b py-2">{{$lang['32']}} :</td>
                                        <td class="border-b py-2">{{round($detail['volume']*0.000001,3)}} <span class="black-text font_unit2">(m)<sup>3</sup></span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['32']}} :</td>
                                        <td class="border-b py-2">{{round($detail['volume']*0.0610237,3)}} <span class="black-text font_unit2">(cu in)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['32']}} :</td>
                                        <td class="border-b py-2">{{round($detail['volume']*0.000035315,3)}} <span class="black-text font_unit2">(cu ft)</span></td>
                                    </tr>
                                        <tr>
                                        <td class="border-b py-2">{{$lang['32']}} :</td>
                                        <td class="border-b py-2">{{round($detail['volume']*0.000001308,3)}} <span class="black-text font_unit2">(cu yd)</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{$lang['32']}} :</td>
                                        <td class="border-b py-2">{{round($detail['volume']*0.001,3)}} <span class="black-text font_unit2">(liters)</span></td>
                                    </tr>
                                </table>
                                @if(!empty($detail['filled_volume']))
                                    <table class="w-full">
                                        <tr>
                                            <td width="50%" class="border-b py-2"><strong>{{$lang['33']}} :</strong></td>
                                            <td class="border-b py-2">{{round($detail['filled_volume']*0.000264172,2)}} (U.S Gallons)</td>
                                        </tr>
                                    </table>
                                    <p class="mt-2">{{$lang['31']}}</p>
                                    <table class="w-100">
                                        <tr>
                                            <td width="50%" class="border-b py-2">{{$lang['33']}} :</td>
                                            <td class="border-b py-2">{{round($detail['filled_volume'],3)}} <span class="black-text font_unit2">(cm)<sup>3</sup></span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang['33']}} :</td>
                                            <td class="border-b py-2">{{round($detail['filled_volume']*0.001,3)}} <span class="black-text font_unit2">(dm)<sup>3</sup></span></td>
                                        </tr>
                                            <tr>
                                            <td class="border-b py-2">{{$lang['33']}} :</td>
                                            <td class="border-b py-2">{{round($detail['filled_volume']*0.000001,3)}} <span class="black-text font_unit2">(m)<sup>3</sup></span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang['33']}} :</td>
                                            <td class="border-b py-2">{{round($detail['filled_volume']*0.0610237,3)}} <span class="black-text font_unit2">(cu in)</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang['33']}} :</td>
                                            <td class="border-b py-2">{{round($detail['filled_volume']*0.000035315,3)}} <span class="black-text font_unit2">(cu ft)</span></td>
                                        </tr>
                                            <tr>
                                            <td class="border-b py-2">{{$lang['33']}} :</td>
                                            <td class="border-b py-2">{{round($detail['filled_volume']*0.000001308,3)}} <span class="black-text font_unit2">(cu yd)</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{$lang['33']}} :</td>
                                            <td class="border-b py-2">{{round($detail['filled_volume']*0.001,3)}} <span class="black-text font_unit2">(liters)</span></td>
                                        </tr>
                                        </table>
                                @endif
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
        var a = document.getElementById("shape").value;
        if (a === "1") {
            document.querySelectorAll(".length, .width, .height, .fill_depth").forEach(function(element) {
                element.style.display = "block";
            });
            document.querySelectorAll(".front_pane, .end_pane, .radius, .radius_one, .radius_two, .long_side, .short_side, .len_one, .len_two, .wid_one, .wid_two, .full_width").forEach(function(element) {
                element.style.display = "none";
            });
            document.querySelectorAll(".change_img").forEach(function(element) {
                element.setAttribute("src", "{{asset('images/pict12.png')}}");
            });
        }
        @isset($detail)
            if (a === "1") {
                document.querySelectorAll(".length, .width, .height, .fill_depth").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".front_pane, .end_pane, .radius, .radius_one, .radius_two, .long_side, .short_side, .len_one, .len_two, .wid_one, .wid_two, .full_width").forEach(function(element) {
                    element.style.display = "none";
                });
                document.querySelectorAll(".change_img").forEach(function(element) {
                    element.setAttribute("src", "{{asset('images/pict12.png')}}");
                });
            }else if (a === "2") {
                document.querySelectorAll(".length, .fill_depth").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".width, .height, .front_pane, .end_pane, .radius, .radius_one, .radius_two, .long_side, .short_side, .len_one, .len_two, .wid_one, .wid_two, .full_width").forEach(function(element) {
                    element.style.display = "none";
                });
                document.querySelectorAll(".change_img").forEach(function(element) {
                    element.setAttribute("src", "{{asset('images/pict11.png')}}");
                });
            } else if (a === "3") {
                document.querySelectorAll(".length, .width, .height, .fill_depth, .front_pane").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".end_pane, .radius, .radius_one, .radius_two, .long_side, .short_side, .len_one, .len_two, .wid_one, .wid_two, .full_width").forEach(function(element) {
                    element.style.display = "none";
                });
                document.querySelectorAll(".change_img").forEach(function(element) {
                    element.setAttribute("src", "{{asset('images/pict10.png')}}");
                });
            }else if (a === "4" || a === "5") {
                document.querySelectorAll(".length, .width, .height, .fill_depth, .front_pane, .end_pane").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".radius, .radius_one, .radius_two, .long_side, .short_side, .len_one, .len_two, .wid_one, .wid_two, .full_width").forEach(function(element) {
                    element.style.display = "none";
                });
                if (a === "4") {
                    document.querySelectorAll(".change_img").forEach(function(element) {
                        element.setAttribute("src", "{{asset('images/pict9.png')}}");
                    });
                } else {
                    document.querySelectorAll(".change_img").forEach(function(element) {
                        element.setAttribute("src", "{{asset('images/pict8.png')}}");
                    });
                }
            } else if (a === "6" || a === "7" || a === "8") {
                document.querySelectorAll(".height, .radius, .fill_depth").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".width, .front_pane, .front_pane_unit, .length, .radius_one, .radius_two, .long_side, .short_side, .len_one, .len_two, .wid_one, .wid_two, .full_width").forEach(function(element) {
                    element.style.display = "none";
                });
                if (a === "6") {
                    document.querySelectorAll(".change_img").forEach(function(element) {
                        element.setAttribute("src", "{{asset('images/pict7.png')}}");
                    });
                } else if (a === "7") {
                    document.querySelectorAll(".change_img").forEach(function(element) {
                        element.setAttribute("src", "{{asset('images/pict6.png')}}");
                    });
                } else {
                    document.querySelectorAll(".change_img").forEach(function(element) {
                        element.setAttribute("src", "{{asset('images/pict5.png')}}");
                    });
                }
            }else if (a === "9") {
                document.querySelectorAll(".length, .width, .height, .front_pane, .end_pane, .radius, .long_side, .short_side, .len_one, .len_two, .wid_one, .wid_two, .full_width").forEach(function(element) {
                    element.style.display = "none";
                });
                document.querySelectorAll(".radius_one, .radius_two, .height, .fill_depth").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".change_img").forEach(function(element) {
                    element.setAttribute("src", "{{asset('images/pict4.png')}}");
                });
            } else if (a === "10") {
                document.querySelectorAll(".length, .width, .height, .front_pane, .end_pane, .radius, .len_one, .len_two, .wid_one, .wid_two, .radius_one, .radius_two, .full_width").forEach(function(element) {
                    element.style.display = "none";
                });
                document.querySelectorAll(".height, .fill_depth, .long_side, .short_side").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".change_img").forEach(function(element) {
                    element.setAttribute("src", "{{asset('images/pict3.png')}}");
                });
            }else if (a === "11") {
                document.querySelectorAll(".length, .width, .height, .front_pane, .end_pane, .radius, .radius_one, .radius_two, .long_side, .short_side, .full_width").forEach(function(element) {
                    element.style.display = "none";
                });
                document.querySelectorAll(".height, .fill_depth, .len_one, .len_two, .wid_one, .wid_two").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".change_img").forEach(function(element) {
                    element.setAttribute("src", "{{asset('images/pict2.png')}}");
                });
            } else if (a === "12") {
                document.querySelectorAll(".length, .width, .height, .front_pane, .end_pane, .radius, .radius_one, .radius_two, .long_side, .short_side, .full_width, .wid_one, .wid_two").forEach(function(element) {
                    element.style.display = "none";
                });
                document.querySelectorAll(".height, .fill_depth, .len_one, .len_two").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".change_img").forEach(function(element) {
                    element.setAttribute("src", "{{asset('images/pict1.png')}}");
                });
            } else if (a === "13") {
                document.querySelectorAll(".length, .width, .height, .full_width").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".front_pane, .end_pane, .radius, .radius_one, .radius_two, .long_side, .short_side, .len_one, .len_two, .wid_one, .wid_two, .fill_depth").forEach(function(element) {
                    element.style.display = "none";
                });
                document.querySelectorAll(".change_img").forEach(function(element) {
                    element.setAttribute("src", "{{asset('images/pi1.webp')}}");
                });
            }
        @endisset
        document.getElementById("shape").addEventListener("change", function() {
            var a = this.value;
            if (a === "1") {
                document.querySelectorAll(".length, .width, .height, .fill_depth").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".front_pane, .end_pane, .radius, .radius_one, .radius_two, .long_side, .short_side, .len_one, .len_two, .wid_one, .wid_two, .full_width").forEach(function(element) {
                    element.style.display = "none";
                });
                document.querySelectorAll(".change_img").forEach(function(element) {
                    element.setAttribute("src", "{{asset('images/pict12.png')}}");
                });
            }else if (a === "2") {
                document.querySelectorAll(".length, .fill_depth").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".width, .height, .front_pane, .end_pane, .radius, .radius_one, .radius_two, .long_side, .short_side, .len_one, .len_two, .wid_one, .wid_two, .full_width").forEach(function(element) {
                    element.style.display = "none";
                });
                document.querySelectorAll(".change_img").forEach(function(element) {
                    element.setAttribute("src", "{{asset('images/pict11.png')}}");
                });
            } else if (a === "3") {
                document.querySelectorAll(".length, .width, .height, .fill_depth, .front_pane").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".end_pane, .radius, .radius_one, .radius_two, .long_side, .short_side, .len_one, .len_two, .wid_one, .wid_two, .full_width").forEach(function(element) {
                    element.style.display = "none";
                });
                document.querySelectorAll(".change_img").forEach(function(element) {
                    element.setAttribute("src", "{{asset('images/pict10.png')}}");
                });
            }else if (a === "4" || a === "5") {
                document.querySelectorAll(".length, .width, .height, .fill_depth, .front_pane, .end_pane").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".radius, .radius_one, .radius_two, .long_side, .short_side, .len_one, .len_two, .wid_one, .wid_two, .full_width").forEach(function(element) {
                    element.style.display = "none";
                });
                if (a === "4") {
                    document.querySelectorAll(".change_img").forEach(function(element) {
                        element.setAttribute("src", "{{asset('images/pict9.png')}}");
                    });
                } else {
                    document.querySelectorAll(".change_img").forEach(function(element) {
                        element.setAttribute("src", "{{asset('images/pict8.png')}}");
                    });
                }
            } else if (a === "6" || a === "7" || a === "8") {
                document.querySelectorAll(".height, .radius, .fill_depth").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".width, .front_pane, .front_pane_unit, .length, .radius_one, .radius_two, .long_side, .short_side, .len_one, .len_two, .wid_one, .wid_two, .full_width").forEach(function(element) {
                    element.style.display = "none";
                });
                if (a === "6") {
                    document.querySelectorAll(".change_img").forEach(function(element) {
                        element.setAttribute("src", "{{asset('images/pict7.png')}}");
                    });
                } else if (a === "7") {
                    document.querySelectorAll(".change_img").forEach(function(element) {
                        element.setAttribute("src", "{{asset('images/pict6.png')}}");
                    });
                } else {
                    document.querySelectorAll(".change_img").forEach(function(element) {
                        element.setAttribute("src", "{{asset('images/pict5.png')}}");
                    });
                }
            }else if (a === "9") {
                document.querySelectorAll(".length, .width, .height, .front_pane, .end_pane, .radius, .long_side, .short_side, .len_one, .len_two, .wid_one, .wid_two, .full_width").forEach(function(element) {
                    element.style.display = "none";
                });
                document.querySelectorAll(".radius_one, .radius_two, .height, .fill_depth").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".change_img").forEach(function(element) {
                    element.setAttribute("src", "{{asset('images/pict4.png')}}");
                });
            } else if (a === "10") {
                document.querySelectorAll(".length, .width, .height, .front_pane, .end_pane, .radius, .len_one, .len_two, .wid_one, .wid_two, .radius_one, .radius_two, .full_width").forEach(function(element) {
                    element.style.display = "none";
                });
                document.querySelectorAll(".height, .fill_depth, .long_side, .short_side").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".change_img").forEach(function(element) {
                    element.setAttribute("src", "{{asset('images/pict3.png')}}");
                });
            }else if (a === "11") {
                document.querySelectorAll(".length, .width, .height, .front_pane, .end_pane, .radius, .radius_one, .radius_two, .long_side, .short_side, .full_width").forEach(function(element) {
                    element.style.display = "none";
                });
                document.querySelectorAll(".height, .fill_depth, .len_one, .len_two, .wid_one, .wid_two").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".change_img").forEach(function(element) {
                    element.setAttribute("src", "{{asset('images/pict2.png')}}");
                });
            } else if (a === "12") {
                document.querySelectorAll(".length, .width, .height, .front_pane, .end_pane, .radius, .radius_one, .radius_two, .long_side, .short_side, .full_width, .wid_one, .wid_two").forEach(function(element) {
                    element.style.display = "none";
                });
                document.querySelectorAll(".height, .fill_depth, .len_one, .len_two").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".change_img").forEach(function(element) {
                    element.setAttribute("src", "{{asset('images/pict1.png')}}");
                });
            } else if (a === "13") {
                document.querySelectorAll(".length, .width, .height, .full_width").forEach(function(element) {
                    element.style.display = "block";
                });
                document.querySelectorAll(".front_pane, .end_pane, .radius, .radius_one, .radius_two, .long_side, .short_side, .len_one, .len_two, .wid_one, .wid_two, .fill_depth").forEach(function(element) {
                    element.style.display = "none";
                });
                document.querySelectorAll(".change_img").forEach(function(element) {
                    element.setAttribute("src", "{{asset('images/pi1.webp')}}");
                });
            }
        });
    </script>
@endpush