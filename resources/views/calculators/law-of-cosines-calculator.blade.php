<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           @php $request = request(); @endphp
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-6">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="cal" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                    <div class="w-full py-2">
                        <select name="cal" class="input" id="cal" aria-label="select">
                            <option value="aa">{{$lang['2']." A"}}</option>
                            <option value="ab" {{ isset($request->cal) && $request->cal=='ab'?'selected':'' }}>{{$lang['2']." B"}}</option>
                            <option value="ac" {{ isset($request->cal) && $request->cal=='ac'?'selected':'' }}>{{$lang['2']." C"}}</option>
                            <option value="sa" {{ isset($request->cal) && $request->cal=='sa'?'selected':'' }}>{{$lang['3']." a"}}</option>
                            <option value="sb" {{ isset($request->cal) && $request->cal=='sb'?'selected':'' }}>{{$lang['3']." b"}}</option>
                            <option value="sc" {{ isset($request->cal) && $request->cal=='sc'?'selected':'' }}>{{$lang['3']." c"}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2 {{ isset($request->cal) && $request->cal === 'sa' ? 'hidden' : '' }}" id="a">
                    <label for="side_a" class="font-s-14 text-blue">{{ $lang['3'] }} a:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="side_a" id="side_a" min="1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['side_a']) ? $_POST['side_a'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="side_a_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('side_a_unit_dropdown')">{{ isset($_POST['side_a_unit'])?$_POST['side_a_unit']:'m' }} ▾</label>
                        <input type="text" name="side_a_unit" value="{{ isset($_POST['side_a_unit'])?$_POST['side_a_unit']:'m' }}" id="side_a_unit" class="hidden">
                        <div id="side_a_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="side_a_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_a_unit', 'mm')">milimeters (mm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_a_unit', 'cm')">centimeters (cm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_a_unit', 'm')">meters (m)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_a_unit', 'km')">kilometers (km)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_a_unit', 'dm')">decimetre (dm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_a_unit', 'in')">inches (in)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_a_unit', 'ft')">feets (ft)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_a_unit', 'yd')">yards (yd)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_a_unit', 'mi')">miles (mi)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_a_unit', 'nmi')">nautical mile (nmi)</p>
                        </div>
                     </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2 {{ isset($request->cal) && $request->cal === 'sb' ? 'hidden' : '' }}" id="b">
                    <label for="side_b" class="font-s-14 text-blue">{{ $lang['3'] }} b:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="side_b" id="side_b" min="1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['side_b']) ? $_POST['side_b'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="side_b_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('side_b_unit_dropdown')">{{ isset($_POST['side_b_unit'])?$_POST['side_b_unit']:'cm' }} ▾</label>
                        <input type="text" name="side_b_unit" value="{{ isset($_POST['side_b_unit'])?$_POST['side_b_unit']:'cm' }}" id="side_b_unit" class="hidden">
                        <div id="side_b_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="side_b_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_b_unit', 'mm')">milimeters (mm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_b_unit', 'cm')">centimeters (cm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_b_unit', 'm')">meters (m)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_b_unit', 'km')">kilometers (km)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_b_unit', 'dm')">decimetre (dm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_b_unit', 'in')">inches (in)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_b_unit', 'ft')">feets (ft)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_b_unit', 'yd')">yards (yd)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_b_unit', 'mi')">miles (mi)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_b_unit', 'nmi')">nautical mile (nmi)</p>
                        </div>
                     </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2 {{ isset($request->cal) && $request->cal === 'sc' ? 'hidden' : '' }}" id="c">
                    <label for="side_c" class="font-s-14 text-blue">{{ $lang['3'] }} c:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="side_c" id="side_c" min="1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['side_c']) ? $_POST['side_c'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="side_c_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('side_c_unit_dropdown')">{{ isset($_POST['side_c_unit'])?$_POST['side_c_unit']:'cm' }} ▾</label>
                        <input type="text" name="side_c_unit" value="{{ isset($_POST['side_c_unit'])?$_POST['side_c_unit']:'cm' }}" id="side_c_unit" class="hidden">
                        <div id="side_c_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="side_c_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_c_unit', 'mm')">milimeters (mm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_c_unit', 'cm')">centimeters (cm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_c_unit', 'm')">meters (m)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_c_unit', 'km')">kilometers (km)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_c_unit', 'dm')">decimetre (dm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_c_unit', 'in')">inches (in)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_c_unit', 'ft')">feets (ft)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_c_unit', 'yd')">yards (yd)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_c_unit', 'mi')">miles (mi)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('side_c_unit', 'nmi')">nautical mile (nmi)</p>
                        </div>
                     </div>
                </div>
                <div class="col-12 mt-0 mt-lg-2 {{ isset($request->cal) && $request->cal === 'sa' ? '' : 'hidden' }}" id="A">
                    <label for="angle_a" class="font-s-14 text-blue">{{ $lang['2'] }} A (α):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="angle_a" id="angle_a" min="1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_a']) ? $_POST['angle_a'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="angle_a_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_a_unit_dropdown')">{{ isset($_POST['angle_a_unit'])?$_POST['angle_a_unit']:'cm' }} ▾</label>
                        <input type="text" name="angle_a_unit" value="{{ isset($_POST['angle_a_unit'])?$_POST['angle_a_unit']:'cm' }}" id="angle_a_unit" class="hidden">
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
                <div class="col-12 mt-0 mt-lg-2 {{ isset($request->cal) && $request->cal === 'sb' ? '' : 'hidden' }}" id="B">
                    <label for="angle_b" class="font-s-14 text-blue">{{ $lang['2'] }} B (β):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="angle_b" id="angle_b" min="1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_b']) ? $_POST['angle_b'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="angle_b_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_b_unit_dropdown')">{{ isset($_POST['angle_b_unit'])?$_POST['angle_b_unit']:'cm' }} ▾</label>
                        <input type="text" name="angle_b_unit" value="{{ isset($_POST['angle_b_unit'])?$_POST['angle_b_unit']:'cm' }}" id="angle_b_unit" class="hidden">
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
                <div class="col-12 mt-0 mt-lg-2 {{ isset($request->cal) && $request->cal === 'sc' ? '' : 'hidden' }}" id="C">
                    <label for="angle_c" class="font-s-14 text-blue">{{ $lang['2'] }} C (γ):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="angle_c" id="angle_c" min="1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_c']) ? $_POST['angle_c'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="angle_c_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_c_unit_dropdown')">{{ isset($_POST['angle_c_unit'])?$_POST['angle_c_unit']:'cm' }} ▾</label>
                        <input type="text" name="angle_c_unit" value="{{ isset($_POST['angle_c_unit'])?$_POST['angle_c_unit']:'cm' }}" id="angle_c_unit" class="hidden">
                        <div id="angle_c_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_c_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_c_unit', 'deg')">degrees (deg)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_c_unit', 'rad')">radians (rad)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_c_unit', 'gon')">gradians (gon)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_c_unit', 'tr')">(tr)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_c_unit', 'arcmin')">arcminute (arcmin)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_c_unit', 'arcsec')">Arc Second (arcsec)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_c_unit', 'mrad')">milliradians (mrad)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_c_unit', 'μrad')">microradians (μrad)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_c_unit', 'pirad')">* π rad (pirad)</p>
                        </div>
                     </div>
                </div>
            </div>
            <div class="col-span-6  flex items-center">
                <div>
                <div class="col-12 font-s-20 text-center  flex items-center">
                    <p class="{{ isset($request->cal) && $request->cal !== 'aa' ? 'hidden' : '' }}" id="eq">\( A = \cos^{-1} \left[ \dfrac{b^2+c^2-a^2}{2bc} \right] \)</p>
                    <p class="{{ isset($request->cal) && $request->cal === 'ab' ? '' : 'hidden' }}" id="eq1">\( B = \cos^{-1} \left[ \dfrac{a^2+c^2-b^2}{2ac} \right] \)</p>
                    <p class="{{ isset($request->cal) && $request->cal === 'ac' ? '' : 'hidden' }}" id="eq2">\( C = \cos^{-1} \left[ \dfrac{a^2+b^2-c^2}{2ab} \right] \)</p>
                    <p class="{{ isset($request->cal) && $request->cal === 'sa' ? '' : 'hidden' }}" id="eq3">\( a = \sqrt{b^2 + c^2 - 2bc \cos A } \)</p>
                    <p class="{{ isset($request->cal) && $request->cal === 'sb' ? '' : 'hidden' }}" id="eq4">\( b = \sqrt{a^2 + c^2 - 2ac \cos B } \)</p>
                    <p class="{{ isset($request->cal) && $request->cal === 'sc' ? '' : 'hidden' }}" id="eq5">\( c = \sqrt{a^2 + b^2 - 2ab \cos C } \)</p>
                </div>
                <div class="col-12 text-center mt-5 flex items-center justify-center">
                    <img src="{{ asset('images/law_of_cosines.webp') }}" width="75%" height="100%" alt="Law of Cosines" loading="lazy" decoding="async">
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
                    
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        @php
                            $A=$detail['angle_a'];
                            $B=$detail['angle_b'];
                            $C=$detail['angle_c'];
                            $a=$detail['side_a'];
                            $b=$detail['side_b'];
                            $c=$detail['side_c'];
                        @endphp
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="60%">
                                    <strong>
                                        @if($request->cal==='aa')
                                            {{$lang['2']}} A
                                        @elseif($request->cal==='ab')
                                            {{$lang['2']}} B
                                        @elseif($request->cal==='ac')
                                            {{$lang['2']}} C
                                        @elseif($request->cal==='sa')
                                            {{$lang['3']}} a
                                        @elseif($request->cal==='sb')
                                            {{$lang['3']}} b
                                        @elseif($request->cal==='sc')
                                            {{$lang['3']}} c
                                        @endif
                                    </strong>
                                </td>
                                <td class="py-2 border-b">
                                    @if($request->cal==='aa')
                                        {{round($A,5)}}°
                                    @elseif($request->cal==='ab')
                                        {{round($B,5)}}°
                                    @elseif($request->cal==='ac')
                                        {{round($C,5)}}°
                                    @elseif($request->cal==='sa')
                                        {{round($a,5)}} cm
                                    @elseif($request->cal==='sb')
                                        {{round($b,5)}} cm
                                    @elseif($request->cal==='sc')
                                        {{round($c,5)}} cm
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-span-12  text-[16px]">
                        <p class="mt-2"><strong><?=$lang['4']?>:</strong></p>
                        @if($request->cal==='aa')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} A</p>
                            <p class="mt-2">\( A = \cos^{-1} \left[ \dfrac{b^2+c^2-a^2}{2bc} \right] \)</p>
                            <p class="mt-2">\( A = \cos^{-1} \) \( \left[\frac{ {{$b}}^2\space+\space{{$c}}^2\space-\space{{$a}}^2}{2\space\times\space{{$b}}\space\times\space{{$c}}} \right] \)</p>
                            <p class="mt-2">\( A = {{$A}}^\circ \)</p>
                        @elseif($request->cal==='ab')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} B</p>
                            <p class="mt-2">\( B = \cos^{-1} \left[ \dfrac{a^2+c^2-b^2}{2ac} \right] \)</p>
                            <p class="mt-2">\( B = \cos^{-1} \)<span class="font_size20">\( \left[\frac{ {{$a}}^2\space+\space{{$c}}^2\space-\space{{$b}}^2}{2\space\times\space{{$a}}\space\times\space{{$c}}} \right] \)</span></p>
                            <p class="mt-2">\( B = {{$B}}^\circ \)</p>
                        @elseif($request->cal==='ac')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} C</p>
                            <p class="mt-2">\( C = \cos^{-1} \left[ \dfrac{a^2+b^2-c^2}{2ab} \right] \)</p>
                            <p class="mt-2">\( C = \cos^{-1} \)<span class="font_size20">\( \left[\frac{ {{$a}}^2\space+\space{{$b}}^2\space-\space{{$c}}^2}{2\space\times\space{{$a}}\space\times\space{{$b}}} \right] \)</span></p>
                            <p class="mt-2">\( C = {{$C}}^\circ \)</p>
                        @elseif($request->cal==='sa')
                            <p class="mt-2">{{$lang['5']}} {{$lang['3']}} a</p>
                            <p class="mt-2">\( a = \sqrt{b^2 + c^2 - 2bc \cos A } \)</p>
                            <p class="mt-2">\( a = \sqrt{ {{$b}}^2 + {{$c}}^2 - 2\times{{$b}}\times{{$c}} \cos ({{$A}} ^\circ) } \)</span></p>
                            <p class="mt-2">\( a = {{$a}}^\circ \)</p>
                        @elseif($request->cal==='sb')
                            <p class="mt-2">{{$lang['5']}} {{$lang['3']}} b</p>
                            <p class="mt-2">\( b = \sqrt{a^2 + c^2 - 2ac \cos B } \)</p>
                            <p class="mt-2">\( b = \sqrt{ {{$a}}^2 + {{$c}}^2 - 2\times{{$a}}\times{{$c}} \cos ({{$B}} ^\circ) } \)</span></p>
                            <p class="mt-2">\( b = {{$b}}^\circ \)</p>
                        @endif
                        <p class="mt-2">{{$lang['6']}}</p>
                        <p class="mt-2">\( a = {{$a}}\space cm \)</p>
                        <p class="mt-2">\( b = {{$b}}\space cm \)</p>
                        <p class="mt-2">\( c = {{$c}}\space cm \)</p>
                        <p class="mt-2">{{$lang['7']}}</p>
                        <p class="mt-2">\( A = {{$A}}^\circ \)</p>
                        <p class="mt-2">\( B = {{$B}}^\circ \)</p>
                        <p class="mt-2">\( C = {{$C}}^\circ \)</p>
                        <p class="mt-2">{{$lang['8']}}</p>
                        <p class="mt-2">\( P = {{$detail['P']}}\space cm \)</p>
                        <p class="mt-2">\( s = {{$detail['s']}}\space cm \)</p>
                        <p class="mt-2">\( K = {{$detail['K']}}\space cm^2 \)</p>
                        <p class="mt-2">\( r = {{$detail['r']}}\space cm \)</p>
                        <p class="mt-2">\( R = {{$detail['R']}}\space cm \)</p>
                        <p class="mt-2">{{$lang['9']}}</p>
                    </div>
                    <div class="col-span-12 mt-4 canvas">
                        <canvas id="triangle" width="600" height="350"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        @isset($detail)
            <script>
                function deg2rad(deg){
                    return deg*Math.PI/180;
                }
                function draw(a,b,c,A,B){
                    canvasclear();
                    var a=a;
                    var b=b;
                    var c=c;
                    var A=A;
                    var B=B;
                    var e=-a*Math.sin(deg2rad(B));
                    var d=Math.sqrt(Math.abs(b*b-e*e));
                    if(A>90){
                    d=-1*d;
                    }
                    var max=Math.max(Math.max(Math.abs(c),Math.abs(d)),Math.abs(e));
                    var dMax=300;
                    var scl=dMax/max;
                    c=c*scl;
                    d=d*scl;
                    e=e*scl;
                    var mX=Math.min(Math.min(c,d),0);
                    xo=mX;
                    if(xo<0){
                    xo=-xo;
                    }
                    xo+=30;
                    yo=-e+30;
                    linedraw(0,0,c,0);
                    linedraw(c,0,d,e);
                    linedraw(d,e,0,0);
                    ctx.font='14pt Arial';
                    textdraw("A",-20,10);
                    textdraw("B",c+10,10);
                    textdraw("C",d-5,e-10);
                    document.getElementById('triangle').style.display='block';
                }
                var canvas=null;
                var ctx=null;
                var xo=200;
                var yo=330;
                function linedraw(x1,y1,x2,y2){
                    x1+=xo;
                    y1+=yo;
                    x2+=xo;
                    y2+=yo;
                    if(getcc()!=null){
                    ctx.fillStyle="rgb(200,0,0)";
                    ctx.beginPath();
                    ctx.moveTo(x1,y1);
                    ctx.lineTo(x2,y2);
                    ctx.closePath();
                    ctx.stroke();
                    }
                }
                function textdraw(text,x1,y1){
                    if(getcc()!=null){
                    x1+=xo;
                    y1+=yo;
                    ctx.fillText(text,x1,y1);
                    }
                }
                function canvasclear(){
                    if(getcc()!=null){
                    ctx.clearRect(0,0,canvas.width,canvas.height);
                    }
                }
                function getcc(){
                    if(ctx==null){
                    if(canvas==null){
                        canvas=document.getElementById('triangle');
                    }
                    if(canvas.getContext){
                        ctx=canvas.getContext('2d');
                    }
                    }
                    return ctx;
                }
                draw({{$a}},{{$b}},{{$c}},{{$A}},{{$B}});
            </script>
        @endisset
        <script>
            document.getElementById('cal').addEventListener('change', function() {
                const value = this.value;
                const elementsToShow = {
                    aa: ['a', 'b', 'c', 'eq'],
                    ab: ['a', 'b', 'c', 'eq1'],
                    ac: ['a', 'b', 'c', 'eq2'],
                    sa: ['b', 'c', 'A', 'eq3'],
                    sb: ['c', 'a', 'B', 'eq4'],
                    sc: ['a', 'b', 'C', 'eq5']
                };
                const allElements = ['a', 'b', 'c', 'A', 'B', 'C', 'eq', 'eq1', 'eq2', 'eq3', 'eq4', 'eq5'];
                allElements.forEach(function(id) {
                    document.getElementById(id).style.display = 'none';
                });
                if (elementsToShow[value]) {
                    elementsToShow[value].forEach(function(id) {
                        document.getElementById(id).style.display = 'block';
                    });
                }
            });
        </script>
    @endpush
</form>