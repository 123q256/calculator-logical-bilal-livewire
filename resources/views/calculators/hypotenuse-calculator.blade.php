<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php
                if (!isset($detail)) {
                    $_POST['cal_with'] = "a_angle";
                    $_POST['cal_with1'] = "area_a";
                }
            @endphp
            <div class="col-span-12">
                <label for="cal_from" class="font-s-14 text-blue">{{$lang['calculate']}} {{$lang['1'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="cal_from" id="cal_from">
                        <option value="two_sides">{{$lang['2']." ∟"}}</option>
                        <option value="angle_side" {{ isset($_POST['cal_from']) && $_POST['cal_from']=='angle_side'?'selected':'' }}>{{$lang['3']." ∡ ".$lang['4']}}</option>
                        <option value="area_side" {{ isset($_POST['cal_from']) && $_POST['cal_from']=='area_side'?'selected':'' }}>{{$lang['5']." ⊿ ".$lang['4']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['cal_from']) && $_POST['cal_from'] === 'area_side' ? '':'hidden' }}" id="calInput">
                <label for="cal" class="font-s-14 text-blue">{{ $lang['calculate'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="cal" id="cal">
                        <option value="hypo">{{$lang['8']}}</option>
                        <option value="area" {{ isset($_POST['cal']) && $_POST['cal']=='area'?'selected':'' }}>{{$lang['5']}}</option>
                        <option value="side_a" {{ isset($_POST['cal']) && $_POST['cal']=='side_a'?'selected':'' }}>{{$lang['7']}} a</option>
                        <option value="side_b" {{ isset($_POST['cal']) && $_POST['cal']=='side_b'?'selected':'' }}>{{$lang['7']}} b</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 mb-1 flex  items-center justify-evenly {{ isset($_POST['cal_from']) && $_POST['cal_from'] === 'angle_side' ? '':'hidden' }}" id="cal_with">
                <p class="font-s-14 text-blue"><strong>{{$lang['calculate']}} {{$lang['6']}}:</strong></p>
                <p id="cal_with_a">
                    <input type="radio" name="cal_with" id="a_angle" value="a_angle" {{ isset($_POST['cal_with']) && $_POST['cal_with']==='a_angle' ? 'checked':'' }}>
                    <label for="a_angle" class="font-s-14">a & {{$lang['3']}} α</label>
                </p>
                <p id="cal_with_b">
                    <input type="radio" name="cal_with" id="b_angle" value="b_angle" {{ isset($_POST['cal_with']) && $_POST['cal_with']==='b_angle' ? 'checked':'' }}>
                    <label for="b_angle" class="font-s-14">b & {{$lang['3']}} β</label>
                </p>
            </div>
            <div class="col-span-12 mb-1 flex  items-center justify-evenly {{ isset($_POST['cal_from']) && isset($_POST['cal']) && $_POST['cal_from'] === 'area_side' && $_POST['cal'] === 'hypo' ? '':'hidden' }}" id="cal_with1">
                <p class="font-s-14 text-blue"><strong>{{$lang['calculate']}} {{$lang['6']}}:</strong></p>
                <p id="cal_with1_a">
                    <input type="radio" name="cal_with1" id="bnry_cal" value="area_a" {{ isset($_POST['cal_with1']) && $_POST['cal_with1']==='area_a' ? 'checked':'' }}>
                    <label for="bnry_cal" class="font-s-14">{{$lang['5']}} & a</label>
                </p>
                <p id="cal_with1_b">
                    <input type="radio" name="cal_with1" id="dec_cal" value="area_b" {{ isset($_POST['cal_with1']) && $_POST['cal_with1']==='area_b' ? 'checked':'' }}>
                    <label for="dec_cal" class="font-s-14">{{$lang['5']}} & b</label>
                </p>
            </div>

            <div class="col-span-12 {{ isset($_POST['cal_from']) && isset($_POST['cal_with1']) && $_POST['cal_from'] === 'area_side' && (isset($_POST['cal']) || $_POST['cal'] === 'hypo' || $_POST['cal'] === 'side_a' || $_POST['cal'] === 'side_b') ? '':'hidden' }}" id="areaInput">
                <label for="area" class="font-s-14 text-blue">{{$lang['5']}}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="area" id="area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area']) ? $_POST['area'] : '75' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_unit_dropdown')">{{ isset($_POST['area_unit'])?$_POST['area_unit']:'cm²' }} ▾</label>
                    <input type="text" name="area_unit" value="{{ isset($_POST['area_unit'])?$_POST['area_unit']:'cm²' }}" id="area_unit" class="hidden">
                    <div id="area_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'mm²')">square millimeter (mm²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'cm²')">square centimeter (cm²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'dm²')">square decimeter (dm²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'm²')">square metre (m²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'km²')">square kilometre (km²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'in²')">square inch (in²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'ft²')">square feet (ft²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'yd²')">square yards (yd²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'mi²')">square miles (mi²)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'a')">ares (a)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'da')">dekameters (da)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'ha')">hectares (ha)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'ac')">acres (ac)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'sf')">soccer fields</p>

                    </div>
                 </div>
            </div>

            <div class="col-span-12 {{ isset($_POST['cal_with']) && $_POST['cal_with'] === 'b_angle' && isset($_POST['cal_with1']) && $_POST['cal_with1'] === 'area_b' && isset($_POST['cal']) && $_POST['cal'] === 'side_a' ? 'hidden':'' }}" id="aInput">
                <label for="a" class="font-s-14 text-blue">a</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="a" id="a" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['a']) ? $_POST['a'] : '75' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="a_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('a_unit_dropdown')">{{ isset($_POST['a_unit'])?$_POST['a_unit']:'cm' }} ▾</label>
                    <input type="text" name="a_unit" value="{{ isset($_POST['a_unit'])?$_POST['a_unit']:'cm' }}" id="a_unit" class="hidden">
                    <div id="a_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="a_unit">
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'mm')">milimeters (mm)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'cm')">centimeters (cm)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'm')">meters (m)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'km')">kilometers (km)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'dm')">decimetre (dm)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'in')">inches (in)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'yd')">yards (yd)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'mi')">miles (mi)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('a_unit', 'nmi')">nautical mile (nmi)</p>

                    </div>
                 </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['cal_from']) && isset($_POST['cal_with']) && $_POST['cal_from'] === 'angle_side' && $_POST['cal_with'] === 'a_angle' ? '':'hidden' }}" id="angleaInput">
                <label for="angle_a" class="font-s-14 text-blue">{{$lang['3']}} α</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="angle_a" id="angle_a" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_a']) ? $_POST['angle_a'] : '75' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="angle_a_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_a_unit_dropdown')">{{ isset($_POST['angle_a_unit'])?$_POST['angle_a_unit']:'deg' }} ▾</label>
                    <input type="text" name="angle_a_unit" value="{{ isset($_POST['angle_a_unit'])?$_POST['angle_a_unit']:'deg' }}" id="angle_a_unit" class="hidden">
                    <div id="angle_a_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_a_unit">
                         
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_a_unit', 'deg')">degrees (deg)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_a_unit', 'rad')">radians (rad)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_a_unit', 'gon')">gradians (gon)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_a_unit', 'tr')">(tr)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_a_unit', 'arcmin')">arcminute (arcmin)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_a_unit', 'arcsec')">Arc Second (arcsec)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_a_unit', 'mrad')">milliradians (mrad)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_a_unit', 'μrad')">microradians (μrad)</p>
                         <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_a_unit', 'pirad')">* π rad (pirad)</p>

                    </div>
                 </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['cal_from']) && isset($_POST['cal_with1']) && $_POST['cal_from'] === 'angle_side' && $_POST['cal_with1'] === 'area_a' && (isset($_POST['cal']) || $_POST['cal'] === 'hypo' || $_POST['cal'] === 'side_b') ? 'hidden':'' }}" id="bInput">
                <label for="b" class="font-s-14 text-blue">b</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="b" id="b" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['b']) ? $_POST['b'] : '75' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="b_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('b_unit_dropdown')">{{ isset($_POST['b_unit'])?$_POST['b_unit']:'deg' }} ▾</label>
                    <input type="text" name="b_unit" value="{{ isset($_POST['b_unit'])?$_POST['b_unit']:'deg' }}" id="b_unit" class="hidden">
                    <div id="b_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="b_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_unit', 'mm')">milimeters (mm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_unit', 'cm')">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_unit', 'm')">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_unit', 'km')">kilometers (km)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_unit', 'dm')">decimetre (dm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_unit', 'in')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_unit', 'yd')">yards (yd)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_unit', 'mi')">miles (mi)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('b_unit', 'nmi')">nautical mile (nmi)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['cal_from']) && isset($_POST['cal_with']) && $_POST['cal_from'] === 'angle_side' && $_POST['cal_with'] === 'b_angle' ? '':'hidden' }}" id="anglebInput">
                <label for="angle_b" class="font-s-14 text-blue">{{$lang['3']}} β</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="angle_b" id="angle_b" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_b_unit']) ? $_POST['angle_b_unit'] : '75' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="angle_b_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_b_unit_dropdown')">{{ isset($_POST['angle_b_unit'])?$_POST['angle_b_unit']:'deg' }} ▾</label>
                    <input type="text" name="angle_b_unit" value="{{ isset($_POST['angle_b_unit'])?$_POST['angle_b_unit']:'deg' }}" id="angle_b_unit" class="hidden">
                    <div id="angle_b_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_b_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_b_unit', 'deg')">degrees (deg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_b_unit', 'rad')">radians (rad)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_b_unit', 'gon')">gradians (gon)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_b_unit', 'tr')">(tr)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_b_unit', 'arcmin')">arcminute (arcmin)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_b_unit', 'arcsec')">Arc Second (arcsec)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_b_unit', 'mrad')">milliradians (mrad)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_b_unit', 'μrad')">microradians (μrad)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_b_unit', 'pirad')">* π rad (pirad)</p>
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
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%">
                                        <strong>
                                            @php
                                                if(isset($detail['area_cal'])){
                                                    echo $lang['5'];
                                                }elseif(isset($detail['side_a'])){
                                                    echo $lang['7'].' a';
                                                }elseif(isset($detail['side_b'])){
                                                    echo $lang['7'].' b';
                                                }else{
                                                    echo $lang['8'];
                                                } 
                                            @endphp
                                        </strong>
                                    </td>
                                    <td class="py-2 border-b">
                                        @php
                                            if(isset($detail['area_cal'])){
                                                echo $detail['area'].' cm²';
                                            }elseif(isset($detail['side_a'])){
                                                echo $detail['a'].' cm';
                                            }elseif(isset($detail['side_b'])){
                                                echo $detail['b'].' cm';
                                            }else{
                                                echo $detail['c'].' cm';
                                            }
                                        @endphp
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>{{$lang['9']}}</strong></p>
                            @if(isset($detail['two_sides']))
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">{{$lang['8']}} (c) = √<span class="b_t">(a² + b²)</span></p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">a = {{$detail['a']}}, b = {{$detail['b']}}, c = ?</p>
                                <p class="mt-2">{{$lang['12']}}</p>
                                <p class="mt-2">c = √<span class="border-top-black">(a² + b²)</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">(({{$detail['a']}})² + ({{$detail['b']}})²)</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">({{$detail['s1']}} + {{$detail['s2']}})</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">{{$detail['s3']}}</span></p>
                                <p class="mt-2">c = {{$detail['c']}}</p>
                            @elseif(isset($detail['a_angle']))
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">{{$lang['8']}} (c) = a / sin(α)</p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">a = {{$detail['a']}}, α = {{$detail['angle_a']}}, c = ?</p>
                                <p class="mt-2">{{$lang['12']}}</p>
                                <p class="mt-2">c = a / sin(α)</p>
                                <p class="mt-2">c = {{$detail['a']}} / sin({{$detail['angle_a']}})</p>
                                <p class="mt-2">c = {{$detail['a']}} / {{$detail['s1']}}</p>
                                <p class="mt-2">c = {{$detail['c']}}</p>
                            @elseif(isset($detail['b_angle']))
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">{{$lang['8']}} (c) = b / sin(β)</p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">b = {{$detail['b']}}, β = {{$detail['angle_b']}}, c = ?</p>
                                <p class="mt-2">{{$lang['12']}}</p>
                                <p class="mt-2">c = b / sin(β)</p>
                                <p class="mt-2">c = {{$detail['b']}} / sin({{$detail['angle_b']}})</p>
                                <p class="mt-2">c = {{$detail['b']}} / {{$detail['s1']}}</p>
                                <p class="mt-2">c = {{$detail['c']}}</p>
                            @elseif(isset($detail['hypo_a']))
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">{{$lang['8']}} (c) = √<span class="border-top-black">(a² + (area * 2 / a)²)</span></p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">a = {{$detail['a']}}, area = {{$detail['area']}}, c = ?</p>
                                <p class="mt-2">{{$lang['12']}}</p>
                                <p class="mt-2">c = √<span class="border-top-black">(a² + (area * 2 / a)²)</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">({{$detail['a']}}² + ({{$detail['area']}} * 2 / {{$detail['a']}})²)</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">({{$detail['s1']}} + ({{$detail['s2']}} / {{$detail['a']}})²)</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">({{$detail['s1']}} + ({{$detail['s3']}})²)</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">({{$detail['s1']}} + {{$detail['s4']}})</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">{{$detail['s5']}}</span></p>
                                <p class="mt-2">c = {{$detail['c']}}</p>
                            @elseif(isset($detail['hypo_b']))
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">{{$lang['8']}} (c) = √<span class="border-top-black">((area * 2 / b)² + b²)</span></p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">b = {{$detail['b']}}, area = {{$detail['area']}}, c = ?</p>
                                <p class="mt-2">{{$lang['12']}}</p>
                                <p class="mt-2">c = √<span class="border-top-black">((area * 2 / b)² + b²)</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">(({{$detail['area']}} * 2 / {{$detail['b']}})² + {{$detail['b']}}²)</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">(({{$detail['s2']}} / {{$detail['b']}})² + {{$detail['s1']}})</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">(({{$detail['s3']}})² + {{$detail['s1']}})</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">({{$detail['s4']}} + {{$detail['s1']}})</span></p>
                                <p class="mt-2">c = √<span class="border-top-black">{{$detail['s5']}}</span></p>
                                <p class="mt-2">c = {{$detail['c']}}</p>
                            @elseif(isset($detail['area_cal']))
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">area = (a * b) / 2</p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">a = {{$detail['a']}}, b = {{$detail['b']}}, area = ?</p>
                                <p class="mt-2">{{$lang['12']}}</p>
                                <p class="mt-2">area = (a * b) / 2</p>
                                <p class="mt-2">area = ({{$detail['a']}} * {{$detail['b']}}) / 2</p>
                                <p class="mt-2">area = {{$detail['s1']}} / 2</p>
                                <p class="mt-2">area = {{$detail['area']}}</p>
                            @elseif(isset($detail['side_a']))
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">a = (area * 2) / b</p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">area = {{$detail['area']}}, b = {{$detail['b']}}, a = ?</p>
                                <p class="mt-2">{{$lang['12']}}</p>
                                <p class="mt-2">a = (area * 2) / b</p>
                                <p class="mt-2">a = ({{$detail['area']}} * 2) / {{$detail['b']}}</p>
                                <p class="mt-2">a = {{$detail['s1']}} / {{$detail['b']}}</p>
                                <p class="mt-2">a = {{$detail['a']}}</p>
                            @else
                                <p class="mt-2">{{$lang['10']}}</p>
                                <p class="mt-2">b = (area * 2) / a</p>
                                <p class="mt-2">{{$lang['11']}}</p>
                                <p class="mt-2">area = {{$detail['area']}}, a = {{$detail['a']}}, b = ?</p>
                                <p class="mt-2">{{$lang['12']}}</p>
                                <p class="mt-2">b = (area * 2) / a</p>
                                <p class="mt-2">b = ({{$detail['area']}} * 2) / {{$detail['a']}}</p>
                                <p class="mt-2">b = {{$detail['s1']}} / {{$detail['a']}}</p>
                                <p class="mt-2">b = {{$detail['b']}}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('cal_from').addEventListener('change', function() {
                if(this.value === "two_sides"){
                    ['#aInput', '#bInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#calInput', '#cal_with', '#cal_with1', '#areaInput', '#angleaInput', '#anglebInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(this.value === "angle_side"){
                    ['#cal_with', '#aInput', '#angleaInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#calInput', '#cal_with1', '#areaInput', '#bInput', '#anglebInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    document.getElementById('cal_with_b').addEventListener('click', function() {
                        ['#cal_with', '#bInput', '#anglebInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        ['#calInput', '#cal_with1', '#areaInput', '#aInput', '#angleaInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                    });
                    document.getElementById('cal_with_a').addEventListener('click', function() {
                        ['#cal_with', '#aInput', '#angleaInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        ['#calInput', '#cal_with1', '#areaInput', '#bInput', '#anglebInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                    });
                }else{
                    ['#calInput', '#cal_with1', '#areaInput', '#aInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#cal_with', '#angleaInput', '#bInput', '#anglebInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    document.getElementById('cal_with1_a').addEventListener('click', function() {
                        ['#calInput', '#cal_with1', '#areaInput', '#aInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        ['#cal_with', '#angleaInput', '#bInput', '#anglebInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                    });
                    document.getElementById('cal_with1_b').addEventListener('click', function() {
                        ['#calInput', '#cal_with1', '#areaInput', '#bInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.remove('hidden');
                            });
                        });
                        ['#cal_with', '#aInput', '#angleaInput', '#anglebInput'].forEach(function(selector) {
                            document.querySelectorAll(selector).forEach(function(element) {
                                element.classList.add('hidden');
                            });
                        });
                    });
                    document.getElementById('cal').addEventListener('change', function() {
                        if(this.value === "hypo"){
                            ['#calInput', '#cal_with1', '#areaInput', '#aInput'].forEach(function(selector) {
                                document.querySelectorAll(selector).forEach(function(element) {
                                    element.classList.remove('hidden');
                                });
                            });
                            ['#cal_with', '#angleaInput', '#bInput', '#anglebInput'].forEach(function(selector) {
                                document.querySelectorAll(selector).forEach(function(element) {
                                    element.classList.add('hidden');
                                });
                            });
                        }else if(this.value === "area"){
                            ['#calInput', '#aInput', '#bInput'].forEach(function(selector) {
                                document.querySelectorAll(selector).forEach(function(element) {
                                    element.classList.remove('hidden');
                                });
                            });
                            ['#cal_with', '#cal_with1', '#areaInput', '#angleaInput', '#anglebInput'].forEach(function(selector) {
                                document.querySelectorAll(selector).forEach(function(element) {
                                    element.classList.add('hidden');
                                });
                            });
                        }else if(this.value === "side_a"){
                            ['#calInput', '#areaInput', '#bInput'].forEach(function(selector) {
                                document.querySelectorAll(selector).forEach(function(element) {
                                    element.classList.remove('hidden');
                                });
                            });
                            ['#cal_with', '#cal_with1', '#aInput', '#angleaInput', '#anglebInput'].forEach(function(selector) {
                                document.querySelectorAll(selector).forEach(function(element) {
                                    element.classList.add('hidden');
                                });
                            });
                        }else{
                            ['#calInput', '#areaInput', '#aInput'].forEach(function(selector) {
                                document.querySelectorAll(selector).forEach(function(element) {
                                    element.classList.remove('hidden');
                                });
                            });
                            ['#cal_with', '#cal_with1', '#angleaInput', '#bInput', '#anglebInput'].forEach(function(selector) {
                                document.querySelectorAll(selector).forEach(function(element) {
                                    element.classList.add('hidden');
                                });
                            });
                        }
                    });
                }
            });
        </script>
    @endpush
</form>