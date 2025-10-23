<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-12  mt-lg-2" id="optional">
                <label for="operation" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="operation" id="operation">
                        <option value="1"
                            {{ isset($_POST['operation']) && $_POST['operation'] == '1' ? 'selected' : '' }}>
                            {{ $lang[2] }} </option>
                        <option value="2"
                            {{ isset($_POST['operation']) && $_POST['operation'] == '2' ? 'selected' : '' }}>
                            {{ $lang[3] }} </option>
                        <option value="3"
                            {{ isset($_POST['operation']) && $_POST['operation'] == '3' ? 'selected' : '' }}>
                            {{ $lang[4] }} </option>
                    </select>
                </div>
            </div>
            <div class="col-span-12  px-2 mt-0 mt-lg-2">
                <p class="col s12 font_s28  black-text txt" id="math_s">
                    <b class="col s12 center">
                        $$\Delta P=m(V_f - {V_i})$$
                    </b>
                </p>
                <p class="col s12 font_s28  black-text txt d-none" id="math_d">
                    <b class="col s12 center">
                        $$\Delta P =m\Delta V$$
                    </b>
                </p>
                <p class="col s12 font_s28  black-text txt d-none" id="math_t">
                    <b class="col s12 center">
                        $$\Delta P =F.T$$
                    </b>
                </p>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 mass">
                <label for="mass" class="font-s-14 text-blue">{{ $lang['13'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first']) ? $_POST['first'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="mass_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mass_unit_dropdown')">{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'kg' }} ▾</label>
                    <input type="text" name="mass_unit" value="{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'kg' }}" id="mass_unit" class="hidden">
                    <div id="mass_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="mass_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'kg')">kg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'g')">g</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'mg')">mg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'µg')">µg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'tons(t)')">tons(t)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'US ton')">US ton</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'long ton')">long ton</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'oz')">oz</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'lb')">lb</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'stone')">stone</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'me')">me</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'u')">u</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 i_velocity">
                <label for="i_velocity" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="i_velocity" id="i_velocity" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['i_velocity']) ? $_POST['i_velocity'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="i_velocity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('i_velocity_unit_dropdown')">{{ isset($_POST['i_velocity_unit'])?$_POST['i_velocity_unit']:'m/s' }} ▾</label>
                    <input type="text" name="i_velocity_unit" value="{{ isset($_POST['i_velocity_unit'])?$_POST['i_velocity_unit']:'m/s' }}" id="i_velocity_unit" class="hidden">
                    <div id="i_velocity_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="i_velocity_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('i_velocity_unit', 'm/s')">m/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('i_velocity_unit', 'km/h')">km/h</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('i_velocity_unit', 'ft/s')">ft/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('i_velocity_unit', 'mph')">mph</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('i_velocity_unit', 'knots')">knots</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('i_velocity_unit', 'ft/min')">ft/min</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 f_velocity">
                <label for="f_velocity" class="font-s-14 text-blue">{{ $lang['6'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="f_velocity" id="f_velocity" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['f_velocity']) ? $_POST['f_velocity'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="f_velocity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_velocity_unit_dropdown')">{{ isset($_POST['f_velocity_unit'])?$_POST['f_velocity_unit']:'m/s' }} ▾</label>
                    <input type="text" name="f_velocity_unit" value="{{ isset($_POST['f_velocity_unit'])?$_POST['f_velocity_unit']:'m/s' }}" id="f_velocity_unit" class="hidden">
                    <div id="f_velocity_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="f_velocity_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_velocity_unit', 'm/s')">m/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_velocity_unit', 'km/h')">km/h</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_velocity_unit', 'ft/s')">ft/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_velocity_unit', 'mph')">mph</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_velocity_unit', 'knots')">knots</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_velocity_unit', 'ft/min')">ft/min</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 chnage_velocity d-none">
                <label for="chnage_velocity" class="font-s-14 text-blue">{{ $lang['7'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="chnage_velocity" id="chnage_velocity" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['chnage_velocity']) ? $_POST['chnage_velocity'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="c_velocity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('c_velocity_unit_dropdown')">{{ isset($_POST['c_velocity_unit'])?$_POST['c_velocity_unit']:'m/s' }} ▾</label>
                    <input type="text" name="c_velocity_unit" value="{{ isset($_POST['c_velocity_unit'])?$_POST['c_velocity_unit']:'m/s' }}" id="c_velocity_unit" class="hidden">
                    <div id="c_velocity_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="c_velocity_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_velocity_unit', 'm/s')">m/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_velocity_unit', 'km/h')">km/h</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_velocity_unit', 'ft/s')">ft/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_velocity_unit', 'mph')">mph</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_velocity_unit', 'knots')">knots</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_velocity_unit', 'ft/min')">ft/min</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 force d-none">
                <label for="force" class="font-s-14 text-blue">{{ $lang['8'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="force" id="force" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['force']) ? $_POST['force'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="force_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('force_unit_dropdown')">{{ isset($_POST['force_unit'])?$_POST['force_unit']:'N' }} ▾</label>
                    <input type="text" name="force_unit" value="{{ isset($_POST['force_unit'])?$_POST['force_unit']:'N' }}" id="force_unit" class="hidden">
                    <div id="force_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="force_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'N')">N</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'KN')">KN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'MN')">MN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'GN')">GN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'TN')">TN</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 time d-none">
                <label for="time" class="font-s-14 text-blue">{{ $lang['9'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="time" id="time" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['time']) ? $_POST['time'] : '15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="time_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('time_unit_dropdown')">{{ isset($_POST['time_unit'])?$_POST['time_unit']:'sec' }} ▾</label>
                    <input type="text" name="time_unit" value="{{ isset($_POST['time_unit'])?$_POST['time_unit']:'sec' }}" id="time_unit" class="hidden">
                    <div id="time_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="time_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'sec')">sec</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'min')">min</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'hr')">hr</p>
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
                        @if (isset($_POST['operation']) && $_POST['operation'] == '1')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['initial_momentum'], 2) }} Ns</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['final_momentum'], 2) }} Ns</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['change_momentum_val'], 2) }} Ns</td>
                                    </tr>
                                </table>
                            </div>
                        @else
                            <div class="w-full text-center text-[25px]">
                                <p>{{ $lang[12] }}</p>
                                <p class="my-3"><strong
                                        class="bg-sky px-3 py-2 ">{{ round($detail['change_momentum_val'], 2) }}</strong>
                                </p>
                            </div>
                        @endif
                    </div>
    
                </div>
            </div>
        </div>
    
    @endisset

</form>

@push('calculatorJS')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
    <script type="text/x-mathjax-config">
MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
</script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            'use strict';
            document.getElementById('operation').addEventListener('change', function() {
                var cal = this.value;
                var showClasses, hideClasses;

                if (cal === '1') {
                    showClasses = ['.mass', '.i_velocity', '.f_velocity', '#math_s'];
                    hideClasses = ['.chnage_velocity', '.force', '.time', '#math_t', '#math_d'];
                } else if (cal === '2') {
                    showClasses = ['.mass', '.chnage_velocity', '#math_d'];
                    hideClasses = ['.i_velocity', '.f_velocity', '.force', '.time', '#math_t', '#math_s'];
                } else if (cal === '3') {
                    showClasses = ['.force', '.time', '#math_t'];
                    hideClasses = ['.i_velocity', '.f_velocity', '.mass', '.chnage_velocity', '#math_s',
                        '#math_d'
                    ];
                }

                showClasses.forEach(function(className) {
                    document.querySelectorAll(className).forEach(function(element) {
                        element.classList.remove('d-none');
                    });
                });

                hideClasses.forEach(function(className) {
                    document.querySelectorAll(className).forEach(function(element) {
                        element.classList.add('d-none');
                    });
                });
            });
        });


        @if (isset($detail))
            var cal = "{{ $_POST['operation'] }}";
            var showClasses, hideClasses;

            if (cal === '1') {
                showClasses = ['.mass', '.i_velocity', '.f_velocity', '#math_s'];
                hideClasses = ['.chnage_velocity', '.force', '.time', '#math_t', '#math_d'];
            } else if (cal === '2') {
                showClasses = ['.mass', '.chnage_velocity', '#math_d'];
                hideClasses = ['.i_velocity', '.f_velocity', '.force', '.time', '#math_t', '#math_s'];
            } else if (cal === '3') {
                showClasses = ['.force', '.time', '#math_t'];
                hideClasses = ['.i_velocity', '.f_velocity', '.mass', '.chnage_velocity', '#math_s', '#math_d'];
            }

            showClasses.forEach(function(className) {
                document.querySelectorAll(className).forEach(function(element) {
                    element.classList.remove('d-none');
                });
            });

            hideClasses.forEach(function(className) {
                document.querySelectorAll(className).forEach(function(element) {
                    element.classList.add('d-none');
                });
            });
        @endif

        @if (isset($error))
            var cal = "{{ $_POST['operation'] }}";
            var showClasses, hideClasses;

            if (cal === '1') {
                showClasses = ['.mass', '.i_velocity', '.f_velocity', '#math_s'];
                hideClasses = ['.chnage_velocity', '.force', '.time', '#math_t', '#math_d'];
            } else if (cal === '2') {
                showClasses = ['.mass', '.chnage_velocity', '#math_d'];
                hideClasses = ['.i_velocity', '.f_velocity', '.force', '.time', '#math_t', '#math_s'];
            } else if (cal === '3') {
                showClasses = ['.force', '.time', '#math_t'];
                hideClasses = ['.i_velocity', '.f_velocity', '.mass', '.chnage_velocity', '#math_s', '#math_d'];
            }

            showClasses.forEach(function(className) {
                document.querySelectorAll(className).forEach(function(element) {
                    element.classList.remove('d-none');
                });
            });

            hideClasses.forEach(function(className) {
                document.querySelectorAll(className).forEach(function(element) {
                    element.classList.add('d-none');
                });
            });
        @endif
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>