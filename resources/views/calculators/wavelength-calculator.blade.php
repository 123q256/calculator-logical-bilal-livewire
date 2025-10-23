<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12">
                <label for="find" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="find" id="find">
                        <option value="wavelength" {{ isset($_POST['find']) && $_POST['find'] == 'wavelength' ? 'selected' : '' }}>
                            {{ $lang['2'] }}</option>
                        <option value="frequency" {{ isset($_POST['find']) && $_POST['find'] == 'frequency' ? 'selected' : '' }}>
                            {{ $lang['3'] }}</option>
                        <option value="velocity" {{ isset($_POST['find']) && $_POST['find'] == 'velocity' ? 'selected' : '' }}>
                            {{ $lang['4'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <label for="preset" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="preset" id="preset">
                        <option value="custom" {{ isset($_POST['preset']) && $_POST['preset'] == 'custom' ? 'selected' : '' }}>{{ $lang['6'] }}</option>
                        <option value="299792458" {{ isset($_POST['preset']) && $_POST['preset'] == '299792458' ? 'selected' : '' }}> {{ $lang['7'] }}</option>
                        <option value="299702547" {{ isset($_POST['preset']) && $_POST['preset'] == '299702547' ? 'selected' : '' }}> {{ $lang['8'] }}</option>
                        <option value="225238511" {{ isset($_POST['preset']) && $_POST['preset'] == '225238511' ? 'selected' : '' }}> {{ $lang['9'] }}</option>
                        <option value="199861639" {{ isset($_POST['preset']) && $_POST['preset'] == '199861639' ? 'selected' : '' }}> {{ $lang['10'] }}</option>
                        <option value="343"       {{ isset($_POST['preset']) && $_POST['preset'] == '343' ? 'selected' : '' }}> {{ $lang['11'] }}</option>
                        <option value="355"       {{ isset($_POST['preset']) && $_POST['preset'] == '355' ? 'selected' : '' }}> {{ $lang['12'] }}</option>
                        <option value="60"        {{ isset($_POST['preset']) && $_POST['preset'] == '60' ? 'selected' : '' }}> {{ $lang['13'] }}</option>
                        <option value="1210"      {{ isset($_POST['preset']) && $_POST['preset'] == '1210' ? 'selected' : '' }}> {{ $lang['14'] }}</option>
                        <option value="3240"      {{ isset($_POST['preset']) && $_POST['preset'] == '3240' ? 'selected' : '' }}> {{ $lang['15'] }}</option>
                        <option value="4540"      {{ isset($_POST['preset']) && $_POST['preset'] == '4540' ? 'selected' : '' }}> {{ $lang['16'] }}</option>
                        <option value="4600"      {{ isset($_POST['preset']) && $_POST['preset'] == '4600' ? 'selected' : '' }}> {{ $lang['17'] }}</option>
                        <option value="6320"      {{ isset($_POST['preset']) && $_POST['preset'] == '6320' ? 'selected' : '' }}> {{ $lang['18'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 " id="velocitys">
                <label for="velocity" class="font-s-14 text-blue">{{ $lang['19'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="velocity" id="velocity" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['velocity']) ? $_POST['velocity'] : '299792458' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="velocity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('velocity_unit_dropdown')">{{ isset($_POST['velocity_unit'])?$_POST['velocity_unit']:'cms' }} ▾</label>
                   <input type="text" name="velocity_unit" value="{{ isset($_POST['velocity_unit'])?$_POST['velocity_unit']:'cms' }}" id="velocity_unit" class="hidden">
                   <div id="velocity_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="velocity_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'cms')">cm/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'ms')">m/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'kmh')">km/h</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'fts')">ft/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'mph')">mph</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'knots')">knots</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'c')">c</p>
                   </div>
                </div>
              </div>
              <div class="col-span-12" id="frequencys">
                <label for="frequency" class="font-s-14 text-blue">{{ $lang['20'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="frequency" id="frequency" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['frequency']) ? $_POST['frequency'] : '6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="frequency_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('frequency_unit_dropdown')">{{ isset($_POST['frequency_unit'])?$_POST['frequency_unit']:'hz' }} ▾</label>
                   <input type="text" name="frequency_unit" value="{{ isset($_POST['frequency_unit'])?$_POST['frequency_unit']:'hz' }}" id="frequency_unit" class="hidden">
                   <div id="frequency_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="frequency_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('frequency_unit', 'hz')">Hz</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('frequency_unit', 'khz')">kHz</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('frequency_unit', 'mhz')">MHz</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('frequency_unit', 'ghz')">GHz</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('frequency_unit', 'thz')">THz</p>
                 
                   </div>
                </div>
              </div>
              <div class="col-span-12 d-none" id="wavelengths">
                <label for="wavelength" class="font-s-14 text-blue">{{ $lang['21'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="wavelength" id="wavelength" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wavelength']) ? $_POST['wavelength'] : '6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="wavelength_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wavelength_unit_dropdown')">{{ isset($_POST['wavelength_unit'])?$_POST['wavelength_unit']:'nm' }} ▾</label>
                   <input type="text" name="wavelength_unit" value="{{ isset($_POST['wavelength_unit'])?$_POST['wavelength_unit']:'hz' }}" id="wavelength_unit" class="hidden">
                   <div id="wavelength_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wavelength_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wavelength_unit', 'nm')">Hz</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wavelength_unit', 'μm')">μm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wavelength_unit', 'mm')">mm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wavelength_unit', 'cm')">cm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wavelength_unit', 'm')">m</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wavelength_unit', 'km')">km</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wavelength_unit', 'in')">in</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wavelength_unit', 'ft')">ft</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wavelength_unit', 'yd')">yd</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wavelength_unit', 'mi')">mi</p>
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
                <div class="w-full overflow-auto">
                    <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="40%"><strong>{{$detail['find']}} </strong></td>
                                <td class="py-2 border-b"> <strong>{{$detail['ans']}} <span>{{$detail['unit']}}</span></strong></td>
                            </tr>
                            <tr>
                            <td class="py-2 border-b" width="40%"><strong>{{$lang['22']}} </strong></td>
                                <td class="py-2 border-b"> <strong>{{$detail['wn']}} <span>1/m</span></strong></strong></td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full font-s-20">
                        <div class="col m10 s12">
                            <div class="c">
                                <p class="mt-2">{{$lang[23]}}:</p>
                                <p class="mt-2"><strong>{{$lang[24]}}</strong></p>
                                @if($_POST['find']==='wavelength')
                                    <p class="mt-2">λ = {v}{f} </p>
                                <p class="mt-2"><strong>{{$lang[26]}}</strong></p>
                                    <p class="mt-2">λ ={v}{f} </p>
                                    <p class="mt-2">λ = {{{$detail['velocity']}}}{{{$detail['frequency']}}} </p>
                                    <p class="mt-2">λ = {{$detail['ans']}} </p>
                                @elseif($_POST['find']==='frequency')
                                    <p class="mt-2">f = {v}{λ} </p>
                                    <p class="mt-2"><strong>{{$lang[26]}}</strong></p>
                                    <p class="mt-2">f = {v}{λ} </p>
                                    <p class="mt-2">f = {{{$detail['velocity']}}}{{{$detail['wavelength']}}} </p>
                                    <p class="mt-2">f = {{$detail['ans']}} </p>
                                @elseif($_POST['find']==='velocity')
                                    <p class="mt-2">v = f * λ </p>
                                <p class="mt-2"><strong>{{$lang[26]}}</strong></p>
                                    <p class="mt-2">v = f * λ </p>
                                    <p class="mt-2">v = {{$detail['frequency']}} * {{$detail['wavelength']}} </p>
                                    <p class="mt-2">v = {{$detail['ans']}} </p>
                                @endif
                            </div>
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
document.addEventListener('DOMContentLoaded', function() {
    'use strict';
    var preset = "{{$_POST['preset']}}";
    var velocityValue = "{{$_POST['velocity']}}";

    document.querySelectorAll('.velocity').forEach(function(element) {
        element.value = preset;
    });

    var presetElement = document.getElementById('preset');
    presetElement.value = velocityValue;

    if (!Array.from(presetElement.options).some(option => option.value === velocityValue)) {
        presetElement.value = 'custom';
    }
});
@endif
@if(isset($detail))
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    var preset = "{{$_POST['preset']}}";
    var velocityValue = "{{$_POST['velocity']}}";

    document.querySelectorAll('.velocity').forEach(function(element) {
        element.value = preset;
    });

    var presetElement = document.getElementById('preset');
    presetElement.value = velocityValue;

    if (!Array.from(presetElement.options).some(option => option.value === velocityValue)) {
        presetElement.value = 'custom';
    }
});
@endif
    document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    document.getElementById('preset').addEventListener('change', function() {
        var value = this.value;
        document.querySelectorAll('.velocity').forEach(function(element) {
            element.value = value;
        });
    });

    document.querySelectorAll('.velocity').forEach(function(element) {
        element.addEventListener('input', function() {
            var value = this.value;
            var preset = document.getElementById('preset');
            preset.value = value;
            if (!Array.from(preset.options).some(option => option.value === value)) {
                preset.value = 'custom';
            }
        });
    });
});

@if(isset($error))
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    var find = "{{$_POST['find']}}";

    function showElement(element) {
        element.classList.remove('d-none');
    }

    function hideElement(element) {
        element.classList.add('d-none');
    }

    var wavelength = document.getElementById('wavelengths');
    var frequency = document.getElementById('frequencys');
    var velocity = document.getElementById('velocitys');

    if (find === 'wavelength') {
        showElement(frequency);
        showElement(velocity);
        hideElement(wavelength);
    } else if (find === 'frequency') {
        showElement(wavelength);
        showElement(velocity);
        hideElement(frequency);
    } else if (find === 'velocity') {
        showElement(wavelength);
        showElement(frequency);
        hideElement(velocity);
    }
});
@endif

@if(isset($detail))
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    var find = "{{$_POST['find']}}";

    function showElement(element) {
        element.classList.remove('d-none');
    }

    function hideElement(element) {
        element.classList.add('d-none');
    }

    var wavelength = document.getElementById('wavelengths');
    var frequency = document.getElementById('frequencys');
    var velocity = document.getElementById('velocitys');

    if (find === 'wavelength') {
        showElement(frequency);
        showElement(velocity);
        hideElement(wavelength);
    } else if (find === 'frequency') {
        showElement(wavelength);
        showElement(velocity);
        hideElement(frequency);
    } else if (find === 'velocity') {
        showElement(wavelength);
        showElement(frequency);
        hideElement(velocity);
    }
});
@endif

    document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    document.getElementById('find').addEventListener('change', function() {
        var value = this.value;
        var wavelength = document.getElementById('wavelengths');
        var frequency = document.getElementById('frequencys');
        var velocity = document.getElementById('velocitys');

        function showElement(element) {
            element.classList.remove('d-none');
        }

        function hideElement(element) {
            element.classList.add('d-none');
        }

        if (value === 'wavelength') {
            showElement(frequency);
            showElement(velocity);
            hideElement(wavelength);
        } else if (value === 'frequency') {
            showElement(wavelength);
            showElement(velocity);
            hideElement(frequency);
        } else if (value === 'velocity') {
            showElement(wavelength);
            showElement(frequency);
            hideElement(velocity);
        }
    });
});
  </script>

  @endpush