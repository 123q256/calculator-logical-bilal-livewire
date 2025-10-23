<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="cal" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <select class="input" name="cal" id="cal">
                        <option value="mass" {{ isset($_POST['cal']) && $_POST['cal'] == 'mass' ? 'selected' : '' }}>
                            {{ $lang['2'] }}</option>
                        <option value="gravity" {{ isset($_POST['cal']) && $_POST['cal'] == 'gravity' ? 'selected' : '' }}>
                            {{ $lang['3'] }}</option>
                        <option value="height" {{ isset($_POST['cal']) && $_POST['cal'] == 'height' ? 'selected' : '' }}>
                            {{ $lang['4'] }}</option>
                        <option value="pe" {{ isset($_POST['cal']) && $_POST['cal'] == 'pe' ? 'selected' : '' }}>
                            {{ $lang['5'] }}</option>
                    </select>
                </div>
                <div class="space-y-2 hidden" id="pes">
                    <label for="pe" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="pe" id="pe" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pe'])?$_POST['pe']:'50' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="pe_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pe_unit_dropdown')">{{ isset($_POST['pe_unit'])?$_POST['pe_unit']:'j' }} ▾</label>
                        <input type="text" name="pe_unit" value="{{ isset($_POST['pe_unit'])?$_POST['pe_unit']:'j' }}" id="pe_unit" class="hidden">
                        <div id="pe_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pe_unit', 'j')">j</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pe_unit', 'kJ')">kJ</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pe_unit', 'MJ')">MJ</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pe_unit', 'Wh')">Wh</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pe_unit', 'kWh')">kWh</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pe_unit', 'ft_lbs')">ft-lbs</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pe_unit', 'kcal')">kcal</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pe_unit', 'eV')">eV</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 " id="masss">
                    <label for="mass" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="mass" id="mass" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass'])?$_POST['mass']:'50' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="mass_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mass_unit_dropdown')">{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'µg' }} ▾</label>
                        <input type="text" name="mass_unit" value="{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'µg' }}" id="mass_unit" class="hidden">
                        <div id="mass_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'µg')">µg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'mg')">mg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'g')">g</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'dag')">dag</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'kg')">kg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 't')">t</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'gr')">gr</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'dr')">dr</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'oz')">oz</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'lb')">lb</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'stone')">stone</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'us_ton')">US ton</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'long_ton')">Long ton</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'earths')">Earths</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'me')">me</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'u')">u</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'oz_t')">oz t</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 " id="gravitys">
                    <label for="gravity" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="gravity" id="gravity" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['gravity'])?$_POST['gravity']:'9.80665' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="gravity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('gravity_unit_dropdown')">{{ isset($_POST['gravity_unit'])?$_POST['gravity_unit']:'lbs' }} ▾</label>
                        <input type="text" name="gravity_unit" value="{{ isset($_POST['gravity_unit'])?$_POST['gravity_unit']:'lbs' }}" id="gravity_unit" class="hidden">
                        <div id="gravity_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[3%] md:w-[3%] w-[50%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('gravity_unit', 'm_s2')">m/s²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('gravity_unit', 'cm_s2')">cm/s²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('gravity_unit', 'in_s2')">in/s²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('gravity_unit', 'mi_h_s')">mi/h/s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('gravity_unit', 'g')">g²</p>
                        </div>
                    </div>


                </div>
                <div class="space-y-2 " id="heights">
                    <label for="height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                    <div class="relative w-full ">
                        <input type="number" name="height" id="height" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height'])?$_POST['height']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('height_unit_dropdown')">{{ isset($_POST['height_unit'])?$_POST['height_unit']:'lbs' }} ▾</label>
                        <input type="text" name="height_unit" value="{{ isset($_POST['height_unit'])?$_POST['height_unit']:'lbs' }}" id="height_unit" class="hidden">
                        <div id="height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'mm')">mm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'km')">km</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'yd')">yd</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'mi')">mi</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'nmi')">nmi</p>
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
                <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                    <div class="lg:w-2/5 mt-2">
                      <table class="w-full text-lg">
                        <tr>
                          <td class="py-2 border-b w-7/10"><strong>{{ $detail['cal'] }} </strong></td>
                          <td class="py-2 border-b">
                            <strong>{{ round($detail['ans'], 4) }}
                              <span class="text-2xl">{{ $detail['unit'] }}</span></strong>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div class="w-full text-lg">
                      <div class="w-full">
                        <p class="w-full mt-2">{{ $lang[6] }}:</p>
                        @if($detail['cal'] === 'mass')
                        <p class="mt-2"><strong>{{ $lang[7] }}</strong></p>
                        <p class="mt-2">m = PE * g * h</p>
                        <p class="mt-2"><strong>{{ $lang[8] }}</strong></p>
                        <p class="mt-2">PE = {{ $detail['pe'] }}, g = {{ $detail['g'] }}, h = {{ $detail['h'] }}, m = ?</p>
                        <p class="mt-2"><strong>{{ $lang[9] }}</strong></p>
                        <p class="mt-2">m = PE * g * h</p>
                        <p class="mt-2">m = {{ $detail['pe'] }} * {{ $detail['g'] }} * {{ $detail['h'] }}</p>
                        <p class="mt-2">m = <strong>{{ $detail['ans'] }}</strong></p>
                        @elseif($detail['cal'] === 'gravity')
                        <p class="mt-2"><strong>{{ $lang[7] }}</strong></p>
                        <p class="mt-2">g = PE * m * h</p>
                        <p class="mt-2"><strong>{{ $lang[8] }}</strong></p>
                        <p class="mt-2">PE = {{ $detail['pe'] }}, m = {{ $detail['m'] }}, h = {{ $detail['h'] }}, g = ?</p>
                        <p class="mt-2"><strong>{{ $lang[9] }}</strong></p>
                        <p class="mt-2">g = PE * m * h</p>
                        <p class="mt-2">g = {{ $detail['pe'] }} * {{ $detail['m'] }} * {{ $detail['h'] }}</p>
                        <p class="mt-2">g = <strong>{{ $detail['ans'] }}</strong></p>
                        @elseif($detail['cal'] === 'height')
                        <p class="mt-2"><strong>{{ $lang[7] }}</strong></p>
                        <p class="mt-2">h = PE * m * g</p>
                        <p class="mt-2"><strong>{{ $lang[8] }}</strong></p>
                        <p class="mt-2">PE = {{ $detail['pe'] }}, m = {{ $detail['m'] }}, g = {{ $detail['g'] }}, h = ?</p>
                        <p class="mt-2"><strong>{{ $lang[9] }}</strong></p>
                        <p class="mt-2">h = PE * m * g</p>
                        <p class="mt-2">h = {{ $detail['pe'] }} * {{ $detail['m'] }} * {{ $detail['g'] }}</p>
                        <p class="mt-2">h = <strong>{{ $detail['ans'] }}</strong></p>
                        @elseif($detail['cal'] === 'pe')
                        <p class="mt-2"><strong>{{ $lang[7] }}</strong></p>
                        <p class="mt-2">PE = m * g * h</p>
                        <p class="mt-2"><strong>{{ $lang[8] }}</strong></p>
                        <p class="mt-2">m = {{ $detail['m'] }}, g = {{ $detail['g'] }}, h = {{ $detail['h'] }}, PE = ?</p>
                        <p class="mt-2"><strong>{{ $lang[9] }}</strong></p>
                        <p class="mt-2">PE = m * g * h</p>
                        <p class="mt-2">PE = {{ $detail['m'] }} * {{ $detail['g'] }} * {{ $detail['h'] }}</p>
                        <p class="mt-2">PE = <strong>{{ $detail['ans'] }}</strong></p>
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
@if(isset($error))
    var value = "{{$_POST['cal']}}";

    var mass = document.getElementById('masss');
        var gravity = document.getElementById('gravitys');
        var height = document.getElementById('heights');
        var pe = document.getElementById('pes');

        function showElement(element) {
            element.classList.remove('hidden');
        }

        function hideElement(element) {
            element.classList.add('hidden');
        }

        if (value === "mass") {
            showElement(gravity);
            showElement(height);
            showElement(pe);
            hideElement(mass);
        } else if (value === "gravity") {
            showElement(mass);
            showElement(height);
            showElement(pe);
            hideElement(gravity);
        } else if (value === "height") {
            showElement(mass);
            showElement(gravity);
            showElement(pe);
            hideElement(height);
        } else if (value === "pe") {
            showElement(mass);
            showElement(gravity);
            showElement(height);
            hideElement(pe);
        }
@endif
@if(isset($detail))
    var value = "{{$_POST['cal']}}";

    var mass = document.getElementById('masss');
        var gravity = document.getElementById('gravitys');
        var height = document.getElementById('heights');
        var pe = document.getElementById('pes');

        function showElement(element) {
            element.classList.remove('hidden');
        }

        function hideElement(element) {
            element.classList.add('hidden');
        }

        if (value === "mass") {
            showElement(gravity);
            showElement(height);
            showElement(pe);
            hideElement(mass);
        } else if (value === "gravity") {
            showElement(mass);
            showElement(height);
            showElement(pe);
            hideElement(gravity);
        } else if (value === "height") {
            showElement(mass);
            showElement(gravity);
            showElement(pe);
            hideElement(height);
        } else if (value === "pe") {
            showElement(mass);
            showElement(gravity);
            showElement(height);
            hideElement(pe);
        }
@endif
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    document.getElementById('cal').addEventListener('change', function() {
        var value = this.value;
        var mass = document.getElementById('masss');
        var gravity = document.getElementById('gravitys');
        var height = document.getElementById('heights');
        var pe = document.getElementById('pes');

        function showElement(element) {
            element.classList.remove('hidden');
        }

        function hideElement(element) {
            element.classList.add('hidden');
        }

        if (value === "mass") {
            showElement(gravity);
            showElement(height);
            showElement(pe);
            hideElement(mass);
        } else if (value === "gravity") {
            showElement(mass);
            showElement(height);
            showElement(pe);
            hideElement(gravity);
        } else if (value === "height") {
            showElement(mass);
            showElement(gravity);
            showElement(pe);
            hideElement(height);
        } else if (value === "pe") {
            showElement(mass);
            showElement(gravity);
            showElement(height);
            hideElement(pe);
        }
    });
});
</script>
@endpush
