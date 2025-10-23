<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-7">
                <div class="col-lg-9">
                    <label for="room_unit" class="font-s-14 text-blue">Given:</label>
                    <div class="w-100 py-2">
                        <select name="given" class="input" id="room_unit" aria-label="select">
                            <option value="1">Longer (l) & Shorter Side (w)</option>
                            <option value="2" {{ isset($_POST['given']) && $_POST['given']=='2'?'selected':'' }}>Longer (l) Side & Area</option>
                            <option value="3" {{ isset($_POST['given']) && $_POST['given']=='3'?'selected':'' }}>Longer (l) Side & Perimeter</option>
                            <option value="4" {{ isset($_POST['given']) && $_POST['given']=='4'?'selected':'' }}>Longer (l) Side & Angle (α)</option>
                            <option value="5" {{ isset($_POST['given']) && $_POST['given']=='5'?'selected':'' }}>Shorter Side (w) & Area</option>
                            <option value="6" {{ isset($_POST['given']) && $_POST['given']=='6'?'selected':'' }}>Shorter Side (w) & Perimeter</option>
                            <option value="7" {{ isset($_POST['given']) && $_POST['given']=='7'?'selected':'' }}>Shorter Side (w) & Angle (α)</option>
                            <option value="8" {{ isset($_POST['given']) && $_POST['given']=='8'?'selected':'' }}>Circumcircle radius (r)</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="col-12 mt-0 mt-lg-2 {{ isset($_POST['given']) && ($_POST['given'] === '5' || $_POST['given'] === '6' || $_POST['given'] === '7' || $_POST['given'] === '8') ? 'd-none':'' }} lsInput">
                        <label for="ls" class="font-s-14 text-blue">{{$lang['1']}} (I)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="ls" id="ls" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ls']) ? $_POST['ls'] : '1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="ls_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ls_unit_dropdown')">{{ isset($_POST['ls_unit'])?$_POST['ls_unit']:'cm' }} ▾</label>
                            <input type="text" name="ls_unit" value="{{ isset($_POST['ls_unit'])?$_POST['ls_unit']:'cm' }}" id="ls_unit" class="hidden">
                            <div id="ls_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ls_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ls_unit', 'mm')">millimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ls_unit', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ls_unit', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ls_unit', 'km')">kilometers (km)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ls_unit', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ls_unit', 'ft')">feets (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ls_unit', 'yd')">yards (yd)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ls_unit', 'mi')">miles (mi)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 {{ isset($_POST['given']) && ($_POST['given'] === '2' || $_POST['given'] === '3' || $_POST['given'] === '4' || $_POST['given'] === '8') ? 'd-none':'' }} ssInput">
                        <label for="ss" class="font-s-14 text-blue">{{$lang['2']}} (w)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="ss" id="ss" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ss']) ? $_POST['ss'] : '2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="ss_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ss_unit_dropdown')">{{ isset($_POST['ss_unit'])?$_POST['ss_unit']:'cm' }} ▾</label>
                            <input type="text" name="ss_unit" value="{{ isset($_POST['ss_unit'])?$_POST['ss_unit']:'cm' }}" id="ss_unit" class="hidden">
                            <div id="ss_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ss_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ss_unit', 'mm')">millimeters (mm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ss_unit', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ss_unit', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ss_unit', 'km')">kilometers (km)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ss_unit', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ss_unit', 'ft')">feets (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ss_unit', 'yd')">yards (yd)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ss_unit', 'mi')">miles (mi)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 {{ isset($_POST['given']) && ($_POST['given'] === '2' || $_POST['given'] === '5') ? '':'d-none' }} areaInput">
                        <label for="area" class="font-s-14 text-blue">{{$lang['3']}} (A)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="area" id="area" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area']) ? $_POST['area'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="area_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('area_unit_dropdown')">{{ isset($_POST['area_unit'])?$_POST['area_unit']:'cm²' }} ▾</label>
                            <input type="text" name="area_unit" value="{{ isset($_POST['area_unit'])?$_POST['area_unit']:'cm²' }}" id="area_unit" class="hidden">
                            <div id="area_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="area_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'mm²')">square millimeters (mm²)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'cm²')">square centimeters (cm²)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'm²')">square meters (m²)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'km²')">square kilometers (km²)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'in²')">square inches (in²)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'ft²')">square feets (ft²)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'yd²')">square yards (yd²)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'mi²')">square miles (mi²)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'a')">(a)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'da')">(da)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'ha')">(ha)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('area_unit', 'ac')">(ac)</p>

                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 {{ isset($_POST['given']) && ($_POST['given'] === '3' || $_POST['given'] === '6') ? '':'d-none' }} perimeterInput">
                        <label for="perimeter" class="font-s-14 text-blue">{{$lang['4']}} (P)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="perimeter" id="perimeter" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['perimeter']) ? $_POST['perimeter'] : '1.5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="perimeter_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('perimeter_unit_dropdown')">{{ isset($_POST['perimeter_unit'])?$_POST['perimeter_unit']:'cm' }} ▾</label>
                            <input type="text" name="perimeter_unit" value="{{ isset($_POST['perimeter_unit'])?$_POST['perimeter_unit']:'cm' }}" id="perimeter_unit" class="hidden">
                            <div id="perimeter_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="perimeter_unit">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('perimeter_unit', 'mm')">millimeters (mm)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('perimeter_unit', 'cm')">centimeters (cm)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('perimeter_unit', 'm')">meters (m)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('perimeter_unit', 'km')">kilometers (km)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('perimeter_unit', 'in')">inches (in)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('perimeter_unit', 'ft')">feets (ft)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('perimeter_unit', 'yd')">yards (yd)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('perimeter_unit', 'mi')">miles (mi)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 {{ isset($_POST['given']) && ($_POST['given'] === '4' || $_POST['given'] === '7') ? '':'d-none' }} angleInput">
                        <label for="angle" class="font-s-14 text-blue">{{$lang['5']}} (α)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="angle" id="angle" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angle']) ? $_POST['angle'] : '1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="angle_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angle_unit_dropdown')">{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }} ▾</label>
                            <input type="text" name="angle_unit" value="{{ isset($_POST['angle_unit'])?$_POST['angle_unit']:'deg' }}" id="angle_unit" class="hidden">
                            <div id="angle_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angle_unit">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'deg')">degrees (deg)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'rad')">radians (rad)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'gon')">gradians (gon)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angle_unit', 'pirad')">* π rad (pirad)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2 {{ isset($_POST['given']) && $_POST['given'] === '8' ? '':'d-none' }} circumInput">
                        <label for="circum" class="font-s-14 text-blue">{{$lang['6']}} (r)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="circum" id="circum" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['circum']) ? $_POST['circum'] : '1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="circum_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('circum_unit_dropdown')">{{ isset($_POST['circum_unit'])?$_POST['circum_unit']:'deg' }} ▾</label>
                            <input type="text" name="circum_unit" value="{{ isset($_POST['circum_unit'])?$_POST['circum_unit']:'deg' }}" id="circum_unit" class="hidden">
                            <div id="circum_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="circum_unit">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('circum_unit', 'mm')">millimeters (mm)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('circum_unit', 'cm')">centimeters (cm)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('circum_unit', 'm')">meters (m)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('circum_unit', 'km')">kilometers (km)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('circum_unit', 'in')">inches (in)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('circum_unit', 'ft')">feets (ft)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('circum_unit', 'yd')">yards (yd)</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('circum_unit', 'mi')">miles (mi)</p>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            <div class="col-span-5 flex items-center text-center">
                <img src="{{asset('images/diagonal.webp')}}" height="180px" width="100%" alt="trianle details image" loading="lazy" decoding="async" style="object-fit: contain">
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
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full font-s-18">
                                    @if($detail['lsv']!="")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang[1]}}</strong></td>
                                            <td class="py-2 border-b">{{round($detail['lsv'],3)}} cm</td>
                                        </tr>
                                    @endif
                                    @if($detail['ssv']!="")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang[2]}}</strong></td>
                                            <td class="py-2 border-b">{{round($detail['ssv'],3)}} cm</td>
                                        </tr>
                                    @endif
                                    @if($detail['area']!="")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang[3]}}</strong></td>
                                            <td class="py-2 border-b">{{round($detail['area'],3)}} cm²</td>
                                        </tr>
                                    @endif
                                    @if($detail['perimeter']!="")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang[4]}}</strong></td>
                                            <td class="py-2 border-b">{{round($detail['perimeter'],3)}} cm</td>
                                        </tr>
                                    @endif
                                    @if($detail['radius']!="")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang[6]}}</strong></td>
                                            <td class="py-2 border-b">{{round($detail['radius'],3)}} cm</td>
                                        </tr>
                                    @endif
                                    @if($detail['angle_α']!="")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang[8]}}</strong></td>
                                            <td class="py-2 border-b">{{round($detail['angle_α'],3)}} rad</td>
                                        </tr>
                                    @endif
                                    @if($detail['diagonal']!="")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{$lang[7]}}</strong></td>
                                            <td class="py-2 border-b">{{round($detail['diagonal'],3)}} rad</td>
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
            document.getElementById('room_unit').addEventListener('change', function() {
                if(this.value === '1'){
                    ['.areaInput', '.perimeterInput', '.angleInput', '.circumInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    ['.lsInput', '.ssInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                }else if(this.value === '2'){
                    ['.ssInput', '.perimeterInput', '.angleInput', '.circumInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    ['.lsInput', '.areaInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                }else if (this.value === '3'){
                    ['.ssInput', '.areaInput', '.angleInput', '.circumInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    ['.lsInput', '.perimeterInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                }else if (this.value === '4'){
                    ['.ssInput', '.areaInput', '.perimeterInput', '.circumInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    ['.lsInput', '.angleInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                }else if (this.value === '5'){
                    ['.lsInput', '.perimeterInput', '.angleInput', '.circumInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    ['.ssInput', '.areaInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                }else if (this.value === '6'){
                    ['.lsInput', '.areaInput', '.angleInput', '.circumInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    ['.ssInput', '.perimeterInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                }else if (this.value === '7'){
                    ['.lsInput', '.areaInput', '.perimeterInput', '.circumInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    ['.ssInput', '.angleInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                }else{
                    ['.lsInput', '.ssInput', '.areaInput', '.perimeterInput', '.angleInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    ['.circumInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>