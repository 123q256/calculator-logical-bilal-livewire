<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-6">
                <div class="col-12 mt-0 mt-lg-2">
                    <label for="cal" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                    <div class="w-full py-2">
                        <select name="cal" class="input" id="cal" aria-label="select">
                            <option value="abb">{{$lang['2']." A ".$lang['3']." a, b, B"}}</option>
                            <option value="acc" {{ isset($_POST['cal']) && $_POST['cal']=='acc'?'selected':'' }}>{{$lang['2']." A ".$lang['3']." a, c, C"}}</option>
                            <option value="aba" {{ isset($_POST['cal']) && $_POST['cal']=='aba'?'selected':'' }}>{{$lang['2']." B ".$lang['3']." a, b, A"}}</option>
                            <option value="bcc" {{ isset($_POST['cal']) && $_POST['cal']=='bcc'?'selected':'' }}>{{$lang['2']." B ".$lang['3']." b, c, C"}}</option>
                            <option value="aca" {{ isset($_POST['cal']) && $_POST['cal']=='aca'?'selected':'' }}>{{$lang['2']." C ".$lang['3']." a, c, A"}}</option>
                            <option value="bcb" {{ isset($_POST['cal']) && $_POST['cal']=='bcb'?'selected':'' }}>{{$lang['2']." C ".$lang['3']." b, c, B"}}</option>
                            <option value="bab" {{ isset($_POST['cal']) && $_POST['cal']=='bab'?'selected':'' }}>{{$lang['4']." a ".$lang['3']." b, A, B"}}</option>
                            <option value="cac" {{ isset($_POST['cal']) && $_POST['cal']=='cac'?'selected':'' }}>{{$lang['4']." a ".$lang['3']." c, A, C"}}</option>
                            <option value="aab" {{ isset($_POST['cal']) && $_POST['cal']=='aab'?'selected':'' }}>{{$lang['4']." b ".$lang['3']." a, A, B"}}</option>
                            <option value="cbc" {{ isset($_POST['cal']) && $_POST['cal']=='cbc'?'selected':'' }}>{{$lang['4']." b ".$lang['3']." c, B, C"}}</option>
                            <option value="aac" {{ isset($_POST['cal']) && $_POST['cal']=='aac'?'selected':'' }}>{{$lang['4']." c ".$lang['3']." a, A, C"}}</option>
                            <option value="bbc" {{ isset($_POST['cal']) && $_POST['cal']=='bbc'?'selected':'' }}>{{$lang['4']." c ".$lang['3']." b, B, C"}}</option>
                        </select>
                    </div>
                </div>


                <div class="col-12 mt-0 mt-lg-2 {{ isset($_POST['cal']) && ($_POST['cal'] === 'bcc' || $_POST['cal'] === 'bcb' || $_POST['cal'] === 'bab' || $_POST['cal'] === 'cac' || $_POST['cal'] === 'cbc' || $_POST['cal'] === 'bbc') ? 'hidden' : '' }}" id="a">
                    <label for="side_a" class="font-s-14 text-blue">{{ $lang['4'] }} a:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="side_a" id="side_a" step="any" min="1"   class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['side_a']) ? $_POST['side_a'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="side_a_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('side_a_unit_dropdown')">{{ isset($_POST['side_a_unit'])?$_POST['side_a_unit']:'cm' }} ▾</label>
                        <input type="text" name="side_a_unit" value="{{ isset($_POST['side_a_unit'])?$_POST['side_a_unit']:'cm' }}" id="side_a_unit" class="hidden">
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

                <div class="col-12 mt-0 mt-lg-2 {{ isset($_POST['cal']) && ($_POST['cal'] === 'acc' || $_POST['cal'] === 'aca' || $_POST['cal'] === 'cac' || $_POST['cal'] === 'aab' || $_POST['cal'] === 'cbc' || $_POST['cal'] === 'aac') ? 'hidden' : '' }}" id="b">
                    <label for="side_b" class="font-s-14 text-blue">{{ $lang['4'] }} b:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="side_b" id="side_b" step="any" min="1"   class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['side_b']) ? $_POST['side_b'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
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
             
                <div class="col-12 mt-0 mt-lg-2 {{ isset($_POST['cal']) && ($_POST['cal'] === 'abb' || $_POST['cal'] === 'aba' || $_POST['cal'] === 'bab' || $_POST['cal'] === 'aab' || $_POST['cal'] === 'aac' || $_POST['cal'] === 'bbc') ? 'hidden' : '' }}" id="c">
                    <label for="side_c" class="font-s-14 text-blue">{{ $lang['4'] }} c:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="side_c" id="side_c" step="any" min="1"   class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['side_c']) ? $_POST['side_c'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
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
                <div class="col-12 mt-0 mt-lg-2 {{ isset($_POST['cal']) && ($_POST['cal'] === 'aba' || $_POST['cal'] === 'aca' || $_POST['cal'] === 'bab' || $_POST['cal'] === 'cac' || $_POST['cal'] === 'aab' || $_POST['cal'] === 'aac') ? '' : 'hidden' }}" id="A">
                    <label for="angle_a" class="font-s-14 text-blue">{{ $lang['2'] }} A (α):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="angle_a" id="angle_a" step="any" min="1"   class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_a']) ? $_POST['angle_a'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
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
                <div class="col-12 mt-0 mt-lg-2 {{ isset($_POST['cal']) && ($_POST['cal'] === 'abb' || $_POST['cal'] === 'bcb' || $_POST['cal'] === 'bab' || $_POST['cal'] === 'aab' || $_POST['cal'] === 'cbc' || $_POST['cal'] === 'bbc') ? '' : 'hidden' }}" id="B">
                    <label for="angle_b" class="font-s-14 text-blue">{{ $lang['2'] }} B (β):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="angle_b" id="angle_b" step="any" min="1"   class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_b']) ? $_POST['angle_b'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
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
              
                <div class="col-12 mt-0 mt-lg-2 {{ isset($_POST['cal']) && ($_POST['cal'] === 'acc' || $_POST['cal'] === 'bcc' || $_POST['cal'] === 'cac' || $_POST['cal'] === 'cbc' || $_POST['cal'] === 'aac' || $_POST['cal'] === 'bbc') ? '' : 'hidden' }}" id="C">
                    <label for="angle_c" class="font-s-14 text-blue">{{ $lang['2'] }} C (γ):</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="angle_c" id="angle_c" step="any" min="1"   class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle_c_unit']) ? $_POST['angle_c_unit'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="angle_c_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_c_unit_dropdown')">{{ isset($_POST['angle_c_unit'])?$_POST['angle_c_unit']:'deg' }} ▾</label>
                        <input type="text" name="angle_c_unit" value="{{ isset($_POST['angle_c_unit'])?$_POST['angle_c_unit']:'deg' }}" id="angle_c_unit" class="hidden">
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
            <div class="col-span-6 my-auto">
                <div class="col-12 text-[20px] text-center">
                    <p class="{{ isset($_POST['cal']) && $_POST['cal'] !== 'abb' ? 'hidden' : '' }}" id="eq">\( A = \sin^{-1} \left[ \dfrac{a \sin B}{b} \right] \)</p>
                    <p class="{{ isset($_POST['cal']) && $_POST['cal'] === 'acc' ? '' : 'hidden' }}" id="eq1">\( A = \sin^{-1} \left[ \dfrac{a \sin C}{c} \right] \)</p>
                    <p class="{{ isset($_POST['cal']) && $_POST['cal'] === 'aba' ? '' : 'hidden' }}" id="eq2">\( B = \sin^{-1} \left[ \dfrac{b \sin A}{a} \right] \)</p>
                    <p class="{{ isset($_POST['cal']) && $_POST['cal'] === 'bcc' ? '' : 'hidden' }}" id="eq3">\( B = \sin^{-1} \left[ \dfrac{b \sin C}{c} \right] \)</p>
                    <p class="{{ isset($_POST['cal']) && $_POST['cal'] === 'aca' ? '' : 'hidden' }}" id="eq4">\( C = \sin^{-1} \left[ \dfrac{c \sin A}{a} \right] \)</p>
                    <p class="{{ isset($_POST['cal']) && $_POST['cal'] === 'bcb' ? '' : 'hidden' }}" id="eq5">\( C = \sin^{-1} \left[ \dfrac{c \sin B}{b} \right] \)</p>
                    <p class="{{ isset($_POST['cal']) && $_POST['cal'] === 'bab' ? '' : 'hidden' }}" id="eq6">\( a = \dfrac{b \sin A}{\sin B} \)</p>
                    <p class="{{ isset($_POST['cal']) && $_POST['cal'] === 'cac' ? '' : 'hidden' }}" id="eq7">\( a = \dfrac{c \sin A}{\sin C} \)</p>
                    <p class="{{ isset($_POST['cal']) && $_POST['cal'] === 'aab' ? '' : 'hidden' }}" id="eq8">\( b = \dfrac{a \sin B}{\sin A} \)</p>
                    <p class="{{ isset($_POST['cal']) && $_POST['cal'] === 'cbc' ? '' : 'hidden' }}" id="eq9">\( b = \dfrac{c \sin B}{\sin C} \)</p>
                    <p class="{{ isset($_POST['cal']) && $_POST['cal'] === 'aac' ? '' : 'hidden' }}" id="eq10">\( c = \dfrac{a \sin C}{\sin A} \)</p>
                    <p class="{{ isset($_POST['cal']) && $_POST['cal'] === 'bbc' ? '' : 'hidden' }}" id="eq11">\( c = \dfrac{b \sin C}{\sin B} \)</p>
                </div>
                <div class="col-12 text-center mt-5 flex items-center">
                    <img src="{{ asset('images/law_of_sine.webp') }}" width="100%" height="100%" alt="Law of Sines" loading="lazy" decoding="async">
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
                                        @if($_POST['cal']==='abb')
                                            {{$lang['2']}} A
                                        @elseif($_POST['cal']==='acc')
                                            {{$lang['2']}} A
                                        @elseif($_POST['cal']==='aba')
                                            {{$lang['2']}} B
                                        @elseif($_POST['cal']==='bcc')
                                            {{$lang['2']}} B
                                        @elseif($_POST['cal']==='aca')
                                            {{$lang['2']}} C
                                        @elseif($_POST['cal']==='bcb')
                                            {{$lang['2']}} C
                                        @elseif($_POST['cal']==='bab')
                                            {{$lang['4']}} a
                                        @elseif($_POST['cal']==='cac')
                                            {{$lang['4']}} a
                                        @elseif($_POST['cal']==='aab')
                                            {{$lang['4']}} b
                                        @elseif($_POST['cal']==='cbc')
                                            {{$lang['4']}} b
                                        @elseif($_POST['cal']==='aac')
                                            {{$lang['4']}} c
                                        @elseif($_POST['cal']==='bbc')
                                            {{$lang['4']}} c
                                        @endif
                                    </strong>
                                </td>
                                <td class="py-2 border-b">
                                    @if($_POST['cal']==='abb')
                                        {{round($A,5)}}°
                                    @elseif($_POST['cal']==='acc')
                                        {{round($A,5)}}°
                                    @elseif($_POST['cal']==='aba')
                                        {{round($B,5)}}°
                                    @elseif($_POST['cal']==='bcc')
                                        {{round($B,5)}}°
                                    @elseif($_POST['cal']==='aca')
                                        {{round($C,5)}}°
                                    @elseif($_POST['cal']==='bcb')
                                        {{round($C,5)}}°
                                    @elseif($_POST['cal']==='bab')
                                        {{round($a,5)}} cm
                                    @elseif($_POST['cal']==='cac')
                                        {{round($a,5)}} cm
                                    @elseif($_POST['cal']==='aab')
                                        {{round($b,5)}} cm
                                    @elseif($_POST['cal']==='cbc')
                                        {{round($b,5)}} cm
                                    @elseif($_POST['cal']==='aac')
                                        {{round($c,5)}} cm
                                    @elseif($_POST['cal']==='bbc')
                                        {{round($c,5)}} cm
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-[16px]">
                        <p class="mt-2"><strong><?=$lang['10']?>:</strong></p>
                        @if($_POST['cal']==='abb')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} A</p>
                            <p class="mt-2">\( A = \sin^{-1} \left[ \dfrac{a \sin B}{b} \right] \)</p>
                            <p class="mt-2">\( A = \sin^{-1} \) \( \left [\frac { {{{$a}}}\space{\sin}\space({{$B}}^\circ)} {{{$b}}}\right] \)</p>
                            <p class="mt-2">\( A = {{$A}}^\circ \)</p>
                        @elseif($_POST['cal']==='acc')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} A</p>
                            <p class="mt-2">\( A = \sin^{-1} \left[ \dfrac{a \sin C}{c} \right] \)</p>
                            <p class="mt-2">\( A = \sin^{-1} \) \( \left [\frac { {{{$a}}}\space{\sin}\space({{$C}}^\circ)} {{{$c}}}\right] \)</p>
                            <p class="mt-2">\( A = {{$A}}^\circ \)</p>
                        @elseif($_POST['cal']==='aba')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} B</p>
                            <p class="mt-2">\( B = \sin^{-1} \left[ \dfrac{b \sin A}{a} \right] \)</p>
                            <p class="mt-2">\( B = \sin^{-1} \) \( \left [\frac { {{{$b}}}\space{\sin}\space({{$A}}^\circ)} {{{$a}}}\right] \)</p>
                            <p class="mt-2">\( B = {{$B}}^\circ \)</p>
                        @elseif($_POST['cal']==='bcc')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} B</p>
                            <p class="mt-2">\( B = \sin^{-1} \left[ \dfrac{b \sin C}{c} \right] \)</p>
                            <p class="mt-2">\( B = \sin^{-1} \) \( \left [\frac { {{{$b}}}\space{\sin}\space({{$C}}^\circ)} {{{$c}}}\right] \)</p>
                            <p class="mt-2">\( B = {{$B}}^\circ \)</p>
                        @elseif($_POST['cal']==='aca')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} C</p>
                            <p class="mt-2">\( C = \sin^{-1} \left[ \dfrac{c \sin A}{a} \right] \)</p>
                            <p class="mt-2">\( C = \sin^{-1} \) \( \left [\frac { {{{$c}}}\space{\sin}\space({{$A}}^\circ)} {{{$a}}}\right] \)</p>
                            <p class="mt-2">\( C = {{$C}}^\circ \)</p>
                        @elseif($_POST['cal']==='bcb')
                            <p class="mt-2">{{$lang['5']}} {{$lang['2']}} C</p>
                            <p class="mt-2">\( C = \sin^{-1} \left[ \dfrac{c \sin B}{b} \right] \)</p>
                            <p class="mt-2">\( C = \sin^{-1} \) \( \left [\frac { {{{$c}}}\space{\sin}\space({{$B}}^\circ)} {{{$b}}}\right] \)</p>
                            <p class="mt-2">\( C = {{$C}}^\circ \)</p>
                        @elseif($_POST['cal']==='bab')
                            <p class="mt-2">{{$lang['5']}} {{$lang['4']}} a</p>
                            <p class="mt-2">\( a = \dfrac{b \sin A}{\sin B} \)</p>
                            <p class="mt-2">\( a = \) \( \frac { {{{$b}}}\space{\sin}\space({{$A}} ^\circ)} { {\sin}\space({{$B}} ^\circ)} \)</p>
                            <p class="mt-2">\( a = {{$a}}^\circ \)</p>
                        @elseif($_POST['cal']==='cac')
                            <p class="mt-2">{{$lang['5']}} {{$lang['4']}} a</p>
                            <p class="mt-2">\( a = \dfrac{c \sin A}{\sin C} \)</p>
                            <p class="mt-2">\( a = \) \( \frac { {{{$c}}}\space{\sin}\space({{$A}} ^\circ)} { {\sin}\space({{$C}} ^\circ)} \)</p>
                            <p class="mt-2">\( a = {{$a}}^\circ \)</p>
                        @elseif($_POST['cal']==='aab')
                            <p class="mt-2">{{$lang['5']}} {{$lang['4']}} b</p>
                            <p class="mt-2">\( b = \dfrac{a \sin B}{\sin A} \)</p>
                            <p class="mt-2">\( b = \) \( \frac { {{{$a}}}\space{\sin}\space({{$B}} ^\circ)} { {\sin}\space({{$A}} ^\circ)} \)</p>
                            <p class="mt-2">\( b = {{$b}}^\circ \)</p>
                        @elseif($_POST['cal']==='cbc')
                            <p class="mt-2">{{$lang['5']}} {{$lang['4']}} b</p>
                            <p class="mt-2">\( b = \dfrac{c \sin B}{\sin C} \)</p>
                            <p class="mt-2">\( b = \) \( \frac { {{{$c}}}\space{\sin}\space({{$B}} ^\circ)} { {\sin}\space({{$C}} ^\circ)} \)</p>
                            <p class="mt-2">\( b = {{$b}}^\circ \)</p>
                        @elseif($_POST['cal']==='aac')
                            <p class="mt-2">{{$lang['5']}} {{$lang['4']}} c</p>
                            <p class="mt-2">\( c = \dfrac{a \sin C}{\sin A} \)</p>
                            <p class="mt-2">\( c = \) \( \frac { {{{$a}}}\space{\sin}\space({{$C}} ^\circ)} { {\sin}\space({{$A}} ^\circ)} \)</p>
                            <p class="mt-2">\( c = {{$c}}^\circ \)</p>
                        @elseif($_POST['cal']==='bbc')
                            <p class="mt-2">{{$lang['5']}} {{$lang['4']}} c</p>
                            <p class="mt-2">\( c = \dfrac{b \sin C}{\sin B} \)</p>
                            <p class="mt-2">\( c = \) \( \frac { {{{$b}}}\space{\sin}\space({{$C}} ^\circ)} { {\sin}\space({{$B}} ^\circ)} \)</p>
                            <p class="mt-2">\( c = {{$c}}^\circ \)</p>
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
                    <div class="col-12 mt-4 canvas">
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
                var selectedValue = this.value;
                var elementsToHide = document.querySelectorAll('#a,#b,#c,#A,#B,#C,#eq,#eq1,#eq2,#eq3,#eq4,#eq5,#eq6,#eq7,#eq8,#eq9,#eq10,#eq11');
                elementsToHide.forEach(function(element) {
                    element.style.display = 'none';
                });
                switch (selectedValue) {
                    case 'abb':
                        document.querySelectorAll('#a,#b,#B,#eq').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        break;
                    case 'acc':
                        document.querySelectorAll('#a,#c,#C,#eq1').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        break;
                    case 'aba':
                        document.querySelectorAll('#b,#a,#A,#eq2').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        break;
                    case 'bcc':
                        document.querySelectorAll('#b,#c,#C,#eq3').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        break;
                    case 'aca':
                        document.querySelectorAll('#c,#a,#A,#eq4').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        break;
                    case 'bcb':
                        document.querySelectorAll('#c,#b,#B,#eq5').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        break;
                    case 'bab':
                        document.querySelectorAll('#b,#A,#B,#eq6').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        break;
                    case 'cac':
                        document.querySelectorAll('#c,#A,#C,#eq7').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        break;
                    case 'aab':
                        document.querySelectorAll('#a,#B,#A,#eq8').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        break;
                    case 'cbc':
                        document.querySelectorAll('#c,#B,#C,#eq9').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        break;
                    case 'aac':
                        document.querySelectorAll('#a,#C,#A,#eq10').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        break;
                    case 'bbc':
                        document.querySelectorAll('#b,#C,#B,#eq11').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        break;
                    default:
                        break;
                }
            });
        </script>
    @endpush
</form>