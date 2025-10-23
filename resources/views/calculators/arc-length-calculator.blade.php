<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-6">
                    <div class="col-span-12">
                        <label for="find" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select class="input" aria-label="select" name="find" id="find">
                                <option value="0" {{ isset($_POST['find']) && $_POST['find']=='0'?'selected':'' }}>{{$lang['2']}}</option>
                                <option value="1" {{ isset($_POST['find']) && $_POST['find']=='1'?'selected':'' }}>{{$lang['3']}}</option>
                                <option value="2" {{ isset($_POST['find']) && $_POST['find']=='2'?'selected':'' }}>{{$lang['4']}}</option>
                                <option value="3" {{ isset($_POST['find']) && $_POST['find']=='3'?'selected':'' }}>{{$lang['5']}}</option>
                                <option value="4" {{ isset($_POST['find']) && $_POST['find']=='4'?'selected':'' }}>{{$lang['6']}}</option>
                                <option value="5" {{ isset($_POST['find']) && $_POST['find']=='5'?'selected':'' }}>{{$lang['7']}}</option>
                                <option value="6" {{ isset($_POST['find']) && $_POST['find']=='6'?'selected':'' }}>{{$lang['8']}}</option>
                                <option value="7" {{ isset($_POST['find']) && $_POST['find']=='7'?'selected':'' }}>{{$lang['9']}}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 {{ isset($_POST['find']) && ($_POST['find']==='1' || $_POST['find']==='2' || $_POST['find']==='3' || $_POST['find']==='7') ? 'd-none':'d-block' }}" id="angleInput">
                        <label for="angle" class="font-s-14 text-blue">{{$lang['10']}} {{$lang['21']}} (θ)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="angle" id="angle" min="1"  step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle']) ? $_POST['angle'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="angle_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_unit_dropdown')">{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }} ▾</label>
                            <input type="text" name="angle_unit" value="{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }}" id="angle_unit" class="hidden">
                            <div id="angle_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'deg')">degrees (deg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'rad')">radians (rad)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'gon')">gradians (gon)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'tr')">(tr)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'arcmin')">arcminute (arcmin)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'arcsec')">Arc Second (arcsec)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'mrad')">milliradians (mrad)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'μrad')">microradians (μrad)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'pirad')">* π rad (pirad)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-12 {{ isset($_POST['find']) && ($_POST['find']==='4' || $_POST['find']==='5' || $_POST['find']==='6' || $_POST['find']==='7') ? 'd-none':'d-block' }}" id="radianInput">
                        <label for="rad" class="font-s-14 text-blue">{{$lang['11']}} (r)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="rad" id="rad" min="1"  step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['rad']) ? $_POST['rad'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="rad_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('rad_unit_dropdown')">{{ isset($_POST['rad_unit'])?$_POST['rad_unit']:'m' }} ▾</label>
                            <input type="text" name="rad_unit" value="{{ isset($_POST['rad_unit'])?$_POST['rad_unit']:'m' }}" id="rad_unit" class="hidden">
                            <div id="rad_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="rad_unit">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad_unit', 'mm')">millimeters (mm)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad_unit', 'cm')">centimeters (cm)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad_unit', 'm')">meters (m)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad_unit', 'km')">kilometers (km)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad_unit', 'in')">inches (in)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad_unit', 'ft')">feets (ft)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad_unit', 'yd')">yards (yd)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad_unit', 'mi')">miles (mi)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rad_unit', 'nmi')">nautical miles (nmi)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-12 {{ isset($_POST['find']) && $_POST['find']==='4' ? 'd-block':'d-none' }}" id="diameterInput">
                        <label for="diameter" class="font-s-14 text-blue">{{$lang['12']}}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="diameter" id="diameter" min="1"  step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['diameter']) ? $_POST['diameter'] : '20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="diameter_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('diameter_unit_dropdown')">{{ isset($_POST['diameter_unit'])?$_POST['diameter_unit']:'m' }} ▾</label>
                            <input type="text" name="diameter_unit" value="{{ isset($_POST['diameter_unit'])?$_POST['diameter_unit']:'m' }}" id="diameter_unit" class="hidden">
                            <div id="diameter_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="diameter_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'mm')">millimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'km')">kilometers (km)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'ft')">feets (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'yd')">yards (yd)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'mi')">miles (mi)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'nmi')">nautical miles (nmi)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-12 {{ isset($_POST['find']) && ($_POST['find']==='2' || $_POST['find']==='5') ? 'd-block':'d-none' }}" id="areaInput">
                        <label for="area" class="font-s-14 text-blue">{{$lang['13']}} {{$lang['20']}} (A)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="area" id="area" min="1"  step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area']) ? $_POST['area'] : '20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_unit_dropdown')">{{ isset($_POST['area_unit'])?$_POST['area_unit']:'cm²' }} ▾</label>
                            <input type="text" name="area_unit" value="{{ isset($_POST['area_unit'])?$_POST['area_unit']:'cm²' }}" id="area_unit" class="hidden">
                            <div id="area_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_unit">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'mm²')">square millimeters (mm²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'cm²')">square centimeters (cm²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'dm²')">square decimeters (dm²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'm²')">square meters (m²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'km²')">square kilometers (km²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'in²')">square inchs (in²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'ft²')">square feets (ft²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'yd²')">square yards (yd²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'mi²')">square miles (mi²)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'a')">are (a)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'da')">dalton (da)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'ha')">hectare (ha)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'ac')">(ac)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 's_f')">soccer fields (s_f)</p>
                            </div>
                         </div>
                    </div>
                  
                    <div class="col-span-12 {{ isset($_POST['find']) && ($_POST['find']==='3' || $_POST['find']==='6' || $_POST['find']==='7') ? 'd-block':'d-none' }}" id="chrd_lenInput">
                        <label for="chrd_len" class="font-s-14 text-blue">{{$lang['14']}} {{$lang['22']}} (c)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="chrd_len" id="chrd_len" min="1"  step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['chrd_len']) ? $_POST['chrd_len'] : '100' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="chrd_len_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('chrd_len_unit_dropdown')">{{ isset($_POST['chrd_len_unit'])?$_POST['chrd_len_unit']:'m' }} ▾</label>
                            <input type="text" name="chrd_len_unit" value="{{ isset($_POST['chrd_len_unit'])?$_POST['chrd_len_unit']:'m' }}" id="chrd_len_unit" class="hidden">
                            <div id="chrd_len_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="chrd_len_unit">
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('chrd_len_unit', 'mm')">millimeters (mm)</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('chrd_len_unit', 'cm')">centimeters (cm)</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('chrd_len_unit', 'm')">meters (m)</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('chrd_len_unit', 'km')">kilometers (km)</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('chrd_len_unit', 'in')">inches (in)</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('chrd_len_unit', 'ft')">feets (ft)</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('chrd_len_unit', 'yd')">yards (yd)</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('chrd_len_unit', 'mi')">miles (mi)</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('chrd_len_unit', 'nmi')">nautical miles (nmi)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-12 {{ isset($_POST['find']) && ($_POST['find']==='1' || $_POST['find']==='7') ? 'd-block':'d-none' }}" id="seg_heightInput">
                        <label for="seg_height" class="font-s-14 text-blue">{{$lang['15']}} (h)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="seg_height" id="seg_height" min="1"  step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['seg_height']) ? $_POST['seg_height'] : '100' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="seg_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('seg_height_unit_dropdown')">{{ isset($_POST['seg_height_unit'])?$_POST['seg_height_unit']:'m' }} ▾</label>
                            <input type="text" name="seg_height_unit" value="{{ isset($_POST['seg_height_unit'])?$_POST['seg_height_unit']:'m' }}" id="seg_height_unit" class="hidden">
                            <div id="seg_height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="seg_height_unit">
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('seg_height_unit', 'mm')">millimeters (mm)</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('seg_height_unit', 'cm')">centimeters (cm)</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('seg_height_unit', 'm')">meters (m)</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('seg_height_unit', 'km')">kilometers (km)</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('seg_height_unit', 'in')">inches (in)</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('seg_height_unit', 'ft')">feets (ft)</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('seg_height_unit', 'yd')">yards (yd)</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('seg_height_unit', 'mi')">miles (mi)</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('seg_height_unit', 'nmi')">nautical miles (nmi)</p>
                            </div>
                         </div>
                    </div>
                 
                   
                </div>
                <div class="col-span-6 flex items-center">
                    <div class="col-12 text-center ">
                        <img src="{{ asset('images/arc_length.png') }}" width="75%" height="100%" alt="arc length img" loading="lazy" decoding="async">
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
                            <div class="w-full md:w-[80%] lg:w-[80%]  mt-2">
                                <table class="w-full text-[18px]">
                                    @if($_POST['find'] === '0')
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['16']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['arc_len']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['diameter']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['13']}} {{$lang['17']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['area']}} m²</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['14']}} {{$lang['18']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['chrd_len']}} m</td>
                                        </tr>
                                    @elseif($_POST['find'] === '1')
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['16']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['arc_len']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['10']}} {{$lang['19']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['angle']}} rad / {{round(rad2deg($detail['angle']),5)}} deg</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['diameter']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['13']}} {{$lang['17']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['area']}} m²</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['14']}} {{$lang['18']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['chrd_len']}} m</td>
                                        </tr>
                                    @elseif($_POST['find'] === '2')
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['16']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['arc_len']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['19']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['angle']}} rad / {{round(rad2deg($detail['angle']),5)}} deg</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['diameter']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['13']}} {{$lang['17']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['area']}} m²</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['14']}} {{$lang['18']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['chrd_len']}} m</td>
                                        </tr>
                                    @elseif($_POST['find'] === '3')
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['16']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['arc_len']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['19']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['angle']}} rad / {{round(rad2deg($detail['angle']),5)}} deg</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['diameter']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['17']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['area']}} m²</td>
                                        </tr>
                                    @elseif($_POST['find'] === '4')
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['16']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['arc_len']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['11']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['rad']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['diameter']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['13']}} {{$lang['17']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['area']}} m²</td>
                                        </tr>
                                    @elseif($_POST['find'] === '5')
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['16']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['arc_len']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['11']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['rad']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['diameter']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['14']}} {{$lang['18']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['chrd_len']}} m</td>
                                        </tr>
                                    @elseif($_POST['find'] === '6')
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['16']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['arc_len']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['11']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['rad']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['diameter']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['13']}} {{$lang['17']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['area']}} m²</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['16']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['arc_len']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['10']}} {{$lang['19']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['angle']}} rad / {{round(rad2deg($detail['angle']),5)}} deg</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['11']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['rad']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['12']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['diameter']}} m</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang['13']}} {{$lang['17']}}</strong></td>
                                            <td class="py-2 border-b">{{$detail['area']}} m²</td>
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
            document.getElementById('find').addEventListener("change", function() {
                var selectedValue = this.value;             
                if(selectedValue === '0') {
                    document.getElementById('angleInput').style.display = 'block';
                    document.getElementById('radianInput').style.display = 'block';
                    document.getElementById('diameterInput').style.display = 'none';
                    document.getElementById('areaInput').style.display = 'none';
                    document.getElementById('chrd_lenInput').style.display = 'none';
                    document.getElementById('seg_heightInput').style.display = 'none';
                } else if(selectedValue === '1') {
                    document.getElementById('radianInput').style.display = 'block';
                    document.getElementById('seg_heightInput').style.display = 'block';
                    document.getElementById('angleInput').style.display = 'none';
                    document.getElementById('diameterInput').style.display = 'none';
                    document.getElementById('areaInput').style.display = 'none';
                    document.getElementById('chrd_lenInput').style.display = 'none';
                } else if(selectedValue === '2') {
                    document.getElementById('radianInput').style.display = 'block';
                    document.getElementById('areaInput').style.display = 'block';
                    document.getElementById('angleInput').style.display = 'none';
                    document.getElementById('diameterInput').style.display = 'none';
                    document.getElementById('chrd_lenInput').style.display = 'none';
                    document.getElementById('seg_heightInput').style.display = 'none';
                } else if(selectedValue === '3') {
                    document.getElementById('radianInput').style.display = 'block';
                    document.getElementById('chrd_lenInput').style.display = 'block';
                    document.getElementById('angleInput').style.display = 'none';
                    document.getElementById('diameterInput').style.display = 'none';
                    document.getElementById('areaInput').style.display = 'none';
                    document.getElementById('seg_heightInput').style.display = 'none';
                } else if(selectedValue === '4') {
                    document.getElementById('angleInput').style.display = 'block';
                    document.getElementById('diameterInput').style.display = 'block';
                    document.getElementById('radianInput').style.display = 'none';
                    document.getElementById('areaInput').style.display = 'none';
                    document.getElementById('chrd_lenInput').style.display = 'none';
                    document.getElementById('seg_heightInput').style.display = 'none';
                } else if(selectedValue === '5') {
                    document.getElementById('angleInput').style.display = 'block';
                    document.getElementById('areaInput').style.display = 'block';
                    document.getElementById('radianInput').style.display = 'none';
                    document.getElementById('diameterInput').style.display = 'none';
                    document.getElementById('chrd_lenInput').style.display = 'none';
                    document.getElementById('seg_heightInput').style.display = 'none';
                } else if(selectedValue === '6') {
                    document.getElementById('angleInput').style.display = 'block';
                    document.getElementById('chrd_lenInput').style.display = 'block';
                    document.getElementById('radianInput').style.display = 'none';
                    document.getElementById('diameterInput').style.display = 'none';
                    document.getElementById('areaInput').style.display = 'none';
                    document.getElementById('seg_heightInput').style.display = 'none';
                } else if(selectedValue === '7') {
                    document.getElementById('chrd_lenInput').style.display = 'block';
                    document.getElementById('seg_heightInput').style.display = 'block';
                    document.getElementById('angleInput').style.display = 'none';
                    document.getElementById('radianInput').style.display = 'none';
                    document.getElementById('diameterInput').style.display = 'none';
                    document.getElementById('areaInput').style.display = 'none';
                }
            });
        </script>
    @endpush
</form>