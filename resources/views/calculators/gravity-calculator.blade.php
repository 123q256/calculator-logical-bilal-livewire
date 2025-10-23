<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="calculate" class="label">{{ $lang['10'] }}:</label>
                <div class="w-100 py-2 relative">
                    <select class="input" name="calculate" id="calculate">
                        <option value="1" {{ isset($_POST['calculate']) && $_POST['calculate'] == '1' ? 'selected' : '' }}>
                            {{ $lang['5'] }}</option>
                        <option value="2" {{ isset($_POST['calculate']) && $_POST['calculate'] == '2' ? 'selected' : '' }}>
                            {{ $lang['2'] }}</option>
                        <option value="3" {{ isset($_POST['calculate']) && $_POST['calculate'] == '3' ? 'selected' : '' }}>
                            {{ $lang['3'] }}</option>
                        <option value="4" {{ isset($_POST['calculate']) && $_POST['calculate'] == '4' ? 'selected' : '' }}>
                            {{ $lang['4'] }}</option>
                        <option value="5" {{ isset($_POST['calculate']) && $_POST['calculate'] == '5' ? 'selected' : '' }}>
                            {{ $lang['9'] }}</option>
                    </select>
                </div>

            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6 mass_one">
                <label for="mass_one" class="label">{{ $lang['2'] }} (M)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="mass_one" id="mass_one" step="any"  min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass_one']) ? $_POST['mass_one'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="mass_one_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mass_one_unit_dropdown')">{{ isset($_POST['mass_one_unit'])?$_POST['mass_one_unit']:'g' }} ▾</label>
                    <input type="text" name="mass_one_unit" value="{{ isset($_POST['mass_one_unit'])?$_POST['mass_one_unit']:'g' }}" id="mass_one_unit" class="hidden">
                    <div id="mass_one_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="mass_one_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_one_unit', 'g')">g</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_one_unit', 'kg')">kg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_one_unit', 't')">t</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_one_unit', 'oz')">oz</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_one_unit', 'lb')">lb</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_one_unit', 'stone')">stone</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_one_unit', 'US ton')">US ton</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_one_unit', 'Long ton')">Long ton</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_one_unit', 'Earths')">Earths</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_one_unit', 'Suns')">Suns</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_one_unit', 'me')">me</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_one_unit', 'mp')">mp</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_one_unit', 'mn')">mn</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 mass_two">
                <label for="mass_two" class="label">{{ $lang['3'] }} (m)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="mass_two" id="mass_two" step="any"  min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass_two']) ? $_POST['mass_two'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="mass_two_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mass_two_unit_dropdown')">{{ isset($_POST['mass_two_unit'])?$_POST['mass_two_unit']:'g' }} ▾</label>
                    <input type="text" name="mass_two_unit" value="{{ isset($_POST['mass_two_unit'])?$_POST['mass_two_unit']:'g' }}" id="mass_two_unit" class="hidden">
                    <div id="mass_two_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="mass_two_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_two_unit', 'g')">g</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_two_unit', 'kg')">kg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_two_unit', 't')">t</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_two_unit', 'oz')">oz</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_two_unit', 'lb')">lb</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_two_unit', 'stone')">stone</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_two_unit', 'US ton')">US ton</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_two_unit', 'Long ton')">Long ton</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_two_unit', 'Earths')">Earths</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_two_unit', 'Suns')">Suns</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_two_unit', 'me')">me</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_two_unit', 'mp')">mp</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_two_unit', 'mn')">mn</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 gf hidden">
                <label for="gravitational_force" class="label">{{ $lang['5'] }} (F)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="gravitational_force" id="gravitational_force" step="any"  min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['gravitational_force']) ? $_POST['gravitational_force'] : '13' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="gravitational_force_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('gravitational_force_unit_dropdown')">{{ isset($_POST['gravitational_force_unit'])?$_POST['gravitational_force_unit']:'N' }} ▾</label>
                    <input type="text" name="gravitational_force_unit" value="{{ isset($_POST['gravitational_force_unit'])?$_POST['gravitational_force_unit']:'N' }}" id="gravitational_force_unit" class="hidden">
                    <div id="gravitational_force_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="gravitational_force_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('gravitational_force_unit', 'N')">N</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('gravitational_force_unit', 'kN')">kN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('gravitational_force_unit', 'MN')">MN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('gravitational_force_unit', 'GN')">GN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('gravitational_force_unit', 'TN')">TN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('gravitational_force_unit', 'lbf')">lbf</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 distance">
                <label for="distance" class="label">{{ $lang['4'] }} (R)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="distance" id="distance" step="any"  min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['distance']) ? $_POST['distance'] : '13' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="distance_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('distance_unit_dropdown')">{{ isset($_POST['distance_unit'])?$_POST['distance_unit']:'nm' }} ▾</label>
                    <input type="text" name="distance_unit" value="{{ isset($_POST['distance_unit'])?$_POST['distance_unit']:'nm' }}" id="distance_unit" class="hidden">
                    <div id="distance_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="distance_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'nm')">nm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'μm')">μm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'mm')">mm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'cm')">cm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'm')">m</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'km')">km</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'in')">in</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'ft')">ft</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'yd')">yd</p>
                    </div>
                 </div>
            </div>
           
            <div class="col-span-12 md:col-span-6 lg:col-span-6 constant">
                <label for="constant" class="label">{{ $lang['6'] }} (G) =</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="constant" id="constant" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['constant'])?$_POST['constant']:'6.6743' }}" />
                    <span class="text-blue input_unit">x10<sup>-11</sup>N-m<sup>2</sup>/kg<sup>2</sup></span>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 latitude hidden">
                <label for="latitude" class="label">{{ $lang['7'] }}</label>
                <div class="w-100 py-2 relative">
                    <input type="number" step="any" name="latitude" id="latitude" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['latitude'])?$_POST['latitude']:'37.16802' }}" />
                    <span class="text-blue input_unit">degree</span>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6 height hidden">
                <label for="height" class="label">{{ $lang['8'] }} (R)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="height" id="height" step="any"  min="1"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height']) ? $_POST['height'] : '13' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('height_unit_dropdown')">{{ isset($_POST['height_unit'])?$_POST['height_unit']:'ft' }} ▾</label>
                    <input type="text" name="height_unit" value="{{ isset($_POST['height_unit'])?$_POST['height_unit']:'ft' }}" id="height_unit" class="hidden">
                    <div id="height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="height_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'ft')">ft</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'm')">m</p>
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
                    @if(isset($detail['force']) && $detail['force']!="")
                        <div class="w-full text-center text-[20px]">
                            <p>{{$lang['5']}} (F)</p>
                            <p class="my-3"><strong class="bg-[#2845F5] px-3 py-2 text-[32px] rounded-lg text-white">{{ round($detail['force'], 4) }} (N)</strong></p>
                        </div>
                    @endif
                    @if(isset($detail['first_mass']) && $detail['first_mass']!="")
                        <div class="w-full text-center text-[20px]">
                            <p>{{$lang['2']}} (M)</p>
                            <p class="my-3"><strong class="bg-[#2845F5] px-3 py-2 text-[32px] rounded-lg text-white">{{ round($detail['first_mass'], 4) }} (kg)</strong></p>
                        </div>
                    @endif
                    @if(isset($detail['second_mass']) && $detail['second_mass']!="")
                        <div class="w-full text-center text-[20px]">
                            <p>{{$lang['3']}} (m)</p>
                            <p class="my-3"><strong class="bg-[#2845F5] px-3 py-2 text-[32px] rounded-lg text-white">{{ round($detail['second_mass'], 4) }}  (kg)</strong></p>
                        </div>
                    @endif
                    @if(isset($detail['distance']) && $detail['distance']!="")
                        <div class="w-full text-center text-[20px]">
                            <p>{{$lang['4']}} (R)</p>
                            <p class="my-3"><strong class="bg-[#2845F5] px-3 py-2 text-[32px] rounded-lg text-white">{{ round($detail['distance'], 4) }}  (m)</strong></p>
                        </div>
                    @endif
                    @if(isset($detail['g']) && $detail['g']!="")
                        <div class="w-full text-center text-[20px]">
                            <p>{{$lang['9']}} (g)</p>
                            <p class="my-3"><strong class="bg-[#2845F5] px-3 py-2 text-[32px] rounded-lg text-white">{{ round($detail['g'], 4) }} (g ms<sup>-2</sup>)</strong></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>
@push('calculatorJS')

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('calculate').addEventListener('change', function() {
        var w = this.value;

        function hideElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.add('hidden');
            });
        }

        function showElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.remove('hidden');
            });
        }

        if (w === "1") {
            showElements('.mass_one, .mass_two, .distance, .constant');
            hideElements('.latitude, .gf, .height');
        } else if (w === "2") {
            showElements('.gf, .mass_two, .distance, .constant');
            hideElements('.latitude, .mass_one, .height');
        } else if (w === "3") {
            showElements('.gf, .mass_one, .distance, .constant');
            hideElements('.latitude, .mass_two, .height');
        } else if (w === "4") {
            showElements('.gf, .mass_one, .mass_two, .constant');
            hideElements('.latitude, .distance, .height');
        } else if (w === "5") {
            showElements('.latitude, .height');
            hideElements('.constant, .distance, .gf, .mass_one, .mass_two');
        }
    });
});

@if(isset($detail))
        var w = "{{$_POST['calculate']}}";
        function hideElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.add('hidden');
            });
        }
        function showElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.remove('hidden');
            });
        }
        if (w === "1") {
            showElements('.mass_one, .mass_two, .distance, .constant');
            hideElements('.latitude, .gf, .height');
        } else if (w === "2") {
            showElements('.gf, .mass_two, .distance, .constant');
            hideElements('.latitude, .mass_one, .height');
        } else if (w === "3") {
            showElements('.gf, .mass_one, .distance, .constant');
            hideElements('.latitude, .mass_two, .height');
        } else if (w === "4") {
            showElements('.gf, .mass_one, .mass_two, .constant');
            hideElements('.latitude, .distance, .height');
        } else if (w === "5") {
            showElements('.latitude, .height');
            hideElements('.constant, .distance, .gf, .mass_one, .mass_two');
        }
@endif

@if(isset($error))
        var w = "{{$_POST['calculate']}}";
        function hideElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.add('hidden');
            });
        }
        function showElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.remove('hidden');
            });
        }
        if (w === "1") {
            showElements('.mass_one, .mass_two, .distance, .constant');
            hideElements('.latitude, .gf, .height');
        } else if (w === "2") {
            showElements('.gf, .mass_two, .distance, .constant');
            hideElements('.latitude, .mass_one, .height');
        } else if (w === "3") {
            showElements('.gf, .mass_one, .distance, .constant');
            hideElements('.latitude, .mass_two, .height');
        } else if (w === "4") {
            showElements('.gf, .mass_one, .mass_two, .constant');
            hideElements('.latitude, .distance, .height');
        } else if (w === "5") {
            showElements('.latitude, .height');
            hideElements('.constant, .distance, .gf, .mass_one, .mass_two');
        }
@endif
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>