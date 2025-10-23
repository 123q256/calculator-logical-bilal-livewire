<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-6">
                <label for="find" class="lable">{{ $lang['26'] }}</label>
                <div class="w-full py-2 position-relative">
                    <select name="find" id="find" class="input">
                        <option value="1" {{ isset($_POST['find']) && $_POST['find'] == '1' ? 'selected' : '' }}>
                            {{ $lang['27'] }}</option>
                        <option value="2" {{ isset($_POST['find']) && $_POST['find'] == '2' ? 'selected' : '' }}>
                            {{ $lang['28'] }}</option>
                        <option value="3" {{ isset($_POST['find']) && $_POST['find'] == '3' ? 'selected' : '' }}>
                            {{ $lang['29'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="planet" class="lable">{{ $lang['13'] }}</label>
                <div class="w-full py-2 position-relative">
                    <select name="planet" id="planet" class="input">
                        <option value="1"
                            {{ isset($_POST['planet']) && $_POST['planet'] == '1' ? 'selected' : '' }}>
                            {{ $lang['14'] }}</option>
                        <option value="2"
                            {{ isset($_POST['planet']) && $_POST['planet'] == '2' ? 'selected' : '' }}>
                            {{ $lang['15'] }}</option>
                        <option value="3"
                            {{ isset($_POST['planet']) && $_POST['planet'] == '3' ? 'selected' : '' }}>
                            {{ $lang['16'] }}</option>
                        <option value="4"
                            {{ isset($_POST['planet']) && $_POST['planet'] == '4' ? 'selected' : '' }}>
                            {{ $lang['17'] }}</option>
                        <option value="5"
                            {{ isset($_POST['planet']) && $_POST['planet'] == '5' ? 'selected' : '' }}>
                            {{ $lang['18'] }}</option>
                        <option value="6"
                            {{ isset($_POST['planet']) && $_POST['planet'] == '6' ? 'selected' : '' }}>
                            {{ $lang['19'] }}</option>
                        <option value="7"
                            {{ isset($_POST['planet']) && $_POST['planet'] == '7' ? 'selected' : '' }}>
                            {{ $lang['20'] }}</option>
                        <option value="8"
                            {{ isset($_POST['planet']) && $_POST['planet'] == '8' ? 'selected' : '' }}>
                            {{ $lang['21'] }}</option>
                        <option value="9"
                            {{ isset($_POST['planet']) && $_POST['planet'] == '9' ? 'selected' : '' }}>
                            {{ $lang['22'] }}</option>
                        <option value="10"
                            {{ isset($_POST['planet']) && $_POST['planet'] == '10' ? 'selected' : '' }}>
                            {{ $lang['23'] }}</option>
                        <option value="11"
                            {{ isset($_POST['planet']) && $_POST['planet'] == '11' ? 'selected' : '' }}>
                            {{ $lang['24'] }}</option>
                        <option value="12"
                            {{ isset($_POST['planet']) && $_POST['planet'] == '12' ? 'selected' : '' }}>
                            {{ $lang['25'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6 planet_mass">
                <label for="mass" class="lable">{{ $lang['12'] }} (M)</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="mass" id="mass" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass']) ? $_POST['mass'] : '1.989E30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="mass_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mass_unit_dropdown')">{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'kg' }} ▾</label>
                   <input type="text" name="mass_unit" value="{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'kg' }}" id="mass_unit" class="hidden">
                   <div id="mass_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="mass_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'kg')">kg</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 't')">t</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'lb')">lb</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'oz')">oz</p>

                   </div>
                </div>
              </div>
              <div class="col-span-6 planet_radius">
                <label for="radius" class="lable">{{ $lang['11'] }} (r)</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="radius" id="radius" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['radius']) ? $_POST['radius'] : '6.96E5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="radius_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('radius_unit_dropdown')">{{ isset($_POST['radius_unit'])?$_POST['radius_unit']:'m' }} ▾</label>
                   <input type="text" name="radius_unit" value="{{ isset($_POST['radius_unit'])?$_POST['radius_unit']:'m' }}" id="radius_unit" class="hidden">
                   <div id="radius_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="radius_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('radius_unit', 'm')">m</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('radius_unit', 'km')">km</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('radius_unit', 'yd')">yd</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('radius_unit', 'mi')">mi</p>

                   </div>
                </div>
              </div>
          
            <div class="col-span-6">
                <label for="orbit" class="lable">{{ $lang['10'] }} (R)</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="orbit" id="orbit" class="input" aria-label="input"
                        placeholder="50" value="{{ isset($_POST['orbit']) ? $_POST['orbit'] : '1.9E9' }}" />
                    <span class="text-blue input_unit">AU</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="galaxy_mass" class="lable">{{ $lang['9'] }} (Mc)</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="galaxy_mass" id="galaxy_mass" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['galaxy_mass']) ? $_POST['galaxy_mass'] : '2.8E41' }}" />
                    <span class="text-blue input_unit">kg</span>
                </div>
            </div>
            <div class="col-span-6">
                <label for="gravity" class="lable">{{ $lang['8'] }} G</label>
                <div class="w-full py-2 position-relative">
                    <input type="number" step="any" name="gravity" id="gravity" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['gravity']) ? $_POST['gravity'] : '6.67438E-11' }}" />
                </div>
            </div>
            <div class="col-span-6 d-none escape_velocity">
                <label for="escape_velocity" class="lable">{{ $lang['1'] }} (r)</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="escape_velocity" id="escape_velocity" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['escape_velocity']) ? $_POST['escape_velocity'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="escape_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('escape_unit_dropdown')">{{ isset($_POST['escape_unit']) ? $_POST['escape_unit'] : 'm/s' }} ▾</label>
                   <input type="text" name="escape_unit" value="{{ isset($_POST['escape_unit']) ? $_POST['escape_unit'] : 'm/s' }}" id="escape_unit" class="hidden">
                   <div id="escape_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="escape_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('escape_unit', 'm/s')">m/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('escape_unit', 'km/h')">km/h</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('escape_unit', 'mph')">mph</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('escape_unit', 'km/s')">km/s</p>

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
                <div class="w-full mt-3">
                    <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        @if ($detail['method'] == '1')
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="50%"><strong>{{ $lang[1] }} (V<sub>e</sub>)</strong>
                                    </td>
                                    <td class="py-2 border-b"> {{ $detail['escape_velocity'] }} (km/s)</td>
                                </tr>
                            </table>
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="50%">{{ $lang['2'] }} (V<sub>1)</sub></td>
                                    <td class="py-2 border-b"><strong>{{ round($detail['first_cosmic_velocity'], 3) }}
                                            <span>(km/s)</span></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%">{{ $lang['3'] }} (V<sub>c</sub>)</td>
                                    <td class="py-2 border-b"><strong>{{ round($detail['orbital_speed'] / 1000) }}
                                            <span>(km/s)</span></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%">{{ $lang['4'] }} (V<sub>3</sub>)</td>
                                    <td class="py-2 border-b"><strong>{{ round(($detail['orbital_speed'] / 1000) * sqrt(2)) }}
                                            <span>(km/s)</span></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%">{{ $lang['5'] }} (T<sub>c</sub>)</td>
                                    <td class="py-2 border-b"><strong>{{ round($detail['orbital_period'], 2) }}
                                            <span>(year)</span></strong></td>
                                </tr>
                            </table>
                        @endif
                        @if ($detail['method'] == '2')
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="50%"><strong>{{ $lang[6] }} (M)</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['mass_value'] }} (kg)</td>
                                </tr>
                            </table>
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="50%">{{ $lang['2'] }} (V<sub>1)</sub></td>
                                    <td class="py-2 border-b"><strong>{{ round($detail['first_cosmic_velocity'], 3) }}
                                            <span>(km/s)</span></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%">{{ $lang['3'] }}(V<sub>c</sub>)</td>
                                    <td class="py-2 border-b"><strong>{{ round($detail['orbital_speed'] / 1000) }}
                                            <span>(km/s)</span></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%">{{ $lang['4'] }} (V<sub>3</sub>)</td>
                                    <td class="py-2 border-b"><strong>{{ round(($detail['orbital_speed'] / 1000) * sqrt(2)) }}
                                            <span>(km/s)</span></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%">{{ $lang['5'] }} (T<sub>c</sub>)</td>
                                    <td class="py-2 border-b"><strong>{{ round($detail['orbital_period'], 2) }}
                                            <span>(year)</span></strong></td>
                                </tr>
                            </table>
                        @endif
                        @if ($detail['method'] == '3')
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="50%"><strong>{{ $lang[7] }} (r)</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['mass_value'] }} (m)</td>
                                </tr>
                            </table>
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="50%">{{ $lang['2'] }} (V<sub>1)</sub></td>
                                    <td class="py-2 border-b"><strong>{{ round($detail['first_cosmic_velocity'], 3) }}
                                            <span>(km/s)</span></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%">{{ $lang['3'] }}(V<sub>c</sub>)</td>
                                    <td class="py-2 border-b"><strong>{{ round($detail['orbital_speed'] / 1000) }}
                                            <span>(km/s)</span></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%">{{ $lang['4'] }} (V<sub>3</sub>)</td>
                                    <td class="py-2 border-b"><strong>{{ round(($detail['orbital_speed'] / 1000) * sqrt(2)) }}
                                            <span>(km/s)</span></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%">{{ $lang['5'] }} (T<sub>c</sub>)</td>
                                    <td class="py-2 border-b"><strong>{{ round($detail['orbital_period'], 2) }}
                                            <span>(year)</span></strong></td>
                                </tr>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
@push('calculatorJS')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('find').addEventListener('change', function() {
            var p = this.value;
            if (p == "1") {
                document.querySelectorAll('.planet_mass, .planet_radius').forEach(function(el) {
                    el.classList.remove('d-none');
                });
                document.querySelectorAll('.escape_velocity').forEach(function(el) {
                    el.classList.add('d-none');
                });
            } else if (p == "2") {
                document.querySelectorAll('.escape_velocity, .planet_radius').forEach(function(el) {
                    el.classList.remove('d-none');
                });
                document.querySelectorAll('.planet_mass').forEach(function(el) {
                    el.classList.add('d-none');
                });
            } else if (p == "3") {
                document.querySelectorAll('.escape_velocity, .planet_mass').forEach(function(el) {
                    el.classList.remove('d-none');
                });
                document.querySelectorAll('.planet_radius').forEach(function(el) {
                    el.classList.add('d-none');
                });
            }
        });
    });


    @if (isset($detail))
        var type = "{{ $_POST['find'] }}";

        if (type == "1") {
            document.querySelectorAll('.planet_mass, .planet_radius').forEach(function(el) {
                el.classList.remove('d-none');
            });
            document.querySelectorAll('.escape_velocity').forEach(function(el) {
                el.classList.add('d-none');
            });
        } else if (type == "2") {
            document.querySelectorAll('.escape_velocity, .planet_radius').forEach(function(el) {
                el.classList.remove('d-none');
            });
            document.querySelectorAll('.planet_mass').forEach(function(el) {
                el.classList.add('d-none');
            });
        } else if (type == "3") {
            document.querySelectorAll('.escape_velocity, .planet_mass').forEach(function(el) {
                el.classList.remove('d-none');
            });
            document.querySelectorAll('.planet_radius').forEach(function(el) {
                el.classList.add('d-none');
            });
        }
    @endif

    @if (isset($error))
        var type = "{{ $_POST['find'] }}";

        if (type == "1") {
            document.querySelectorAll('.planet_mass, .planet_radius').forEach(function(el) {
                el.classList.remove('d-none');
            });
            document.querySelectorAll('.escape_velocity').forEach(function(el) {
                el.classList.add('d-none');
            });
        } else if (type == "2") {
            document.querySelectorAll('.escape_velocity, .planet_radius').forEach(function(el) {
                el.classList.remove('d-none');
            });
            document.querySelectorAll('.planet_mass').forEach(function(el) {
                el.classList.add('d-none');
            });
        } else if (type == "3") {
            document.querySelectorAll('.escape_velocity, .planet_mass').forEach(function(el) {
                el.classList.remove('d-none');
            });
            document.querySelectorAll('.planet_radius').forEach(function(el) {
                el.classList.add('d-none');
            });
        }
    @endif


    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('planet').addEventListener('change', function() {
            var q = this.value;
            var mass = document.getElementById('mass');
            var radius = document.getElementById('radius');
            var orbit = document.getElementById('orbit');
            var galaxy_mass = document.getElementById('galaxy_mass');
            var gravity = document.getElementById('gravity');

            if (q == "1") {
                mass.value = "1.989E30";
                radius.value = "6.96E5";
                orbit.value = "1.9E9";
                galaxy_mass.value = "2.8E41";
                gravity.value = "6.67438E-11";
            } else if (q == "2") {
                mass.value = "3.302E23";
                radius.value = "2.4397E3";
                orbit.value = "0.38710";
                galaxy_mass.value = "1.989E30";
                gravity.value = "6.67438E-11";
            } else if (q == "3") {
                mass.value = "4.869E24";
                radius.value = "6.0518E3";
                orbit.value = "0.72333";
                galaxy_mass.value = "1.989E30";
                gravity.value = "6.67438E-11";
            } else if (q == "4") {
                mass.value = "5.974E24";
                radius.value = "6.37815E3";
                orbit.value = "1.00";
                galaxy_mass.value = "1.989E30";
                gravity.value = "6.67438E-11";
            } else if (q == "5") {
                mass.value = "7.347673E22";
                radius.value = "1.73715E3";
                orbit.value = "0.00256955";
                galaxy_mass.value = "5.974E24";
                gravity.value = "6.67438E-11";
            } else if (q == "6") {
                mass.value = "6.419E23";
                radius.value = "3.3972E3";
                orbit.value = "1.52366";
                galaxy_mass.value = "1.989E30";
                gravity.value = "6.67438E-11";
            } else if (q == "7") {
                mass.value = "3.510E10";
                radius.value = "0.165";
                orbit.value = "1.324";
                galaxy_mass.value = "1.989E30";
                gravity.value = "6.67438E-11";
            } else if (q == "8") {
                mass.value = "9.445E20";
                radius.value = "476.2";
                orbit.value = "2.766";
                galaxy_mass.value = "1.989E30";
                gravity.value = "6.67438E-11";
            } else if (q == "9") {
                mass.value = "1.899E27";
                radius.value = "7.1492E4";
                orbit.value = "5.20336";
                galaxy_mass.value = "1.989E30";
                gravity.value = "6.67438E-11";
            } else if (q == "10") {
                mass.value = "5.688E26";
                radius.value = "6.0268E4";
                orbit.value = "9.53707";
                galaxy_mass.value = "1.989E30";
                gravity.value = "6.67438E-11";
            } else if (q == "11") {
                mass.value = "8.683E25";
                radius.value = "2.5559E4";
                orbit.value = "19.19138";
                galaxy_mass.value = "1.989E30";
                gravity.value = "6.67438E-11";
            } else if (q == "12") {
                mass.value = "1.024E26";
                radius.value = "2.4786E4";
                orbit.value = "30.06896";
                galaxy_mass.value = "1.989E30";
                gravity.value = "6.67438E-11";
            }
        });
    });

    @if (isset($detail))
        var type = "{{ $_POST['planet'] }}";
        var mass = document.getElementById('mass');
        var radius = document.getElementById('radius');
        var orbit = document.getElementById('orbit');
        var galaxy_mass = document.getElementById('galaxy_mass');
        var gravity = document.getElementById('gravity');

        if (type == "1") {
            mass.value = "1.989E30";
            radius.value = "6.96E5";
            orbit.value = "1.9E9";
            galaxy_mass.value = "2.8E41";
            gravity.value = "6.67438E-11";
        } else if (type == "2") {
            mass.value = "3.302E23";
            radius.value = "2.4397E3";
            orbit.value = "0.38710";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "3") {
            mass.value = "4.869E24";
            radius.value = "6.0518E3";
            orbit.value = "0.72333";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "4") {
            mass.value = "5.974E24";
            radius.value = "6.37815E3";
            orbit.value = "1.00";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "5") {
            mass.value = "7.347673E22";
            radius.value = "1.73715E3";
            orbit.value = "0.00256955";
            galaxy_mass.value = "5.974E24";
            gravity.value = "6.67438E-11";
        } else if (type == "6") {
            mass.value = "6.419E23";
            radius.value = "3.3972E3";
            orbit.value = "1.52366";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "7") {
            mass.value = "3.510E10";
            radius.value = "0.165";
            orbit.value = "1.324";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "8") {
            mass.value = "9.445E20";
            radius.value = "476.2";
            orbit.value = "2.766";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "9") {
            mass.value = "1.899E27";
            radius.value = "7.1492E4";
            orbit.value = "5.20336";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "10") {
            mass.value = "5.688E26";
            radius.value = "6.0268E4";
            orbit.value = "9.53707";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "11") {
            mass.value = "8.683E25";
            radius.value = "2.5559E4";
            orbit.value = "19.19138";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "12") {
            mass.value = "1.024E26";
            radius.value = "2.4786E4";
            orbit.value = "30.06896";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        }
    @endif

    @if (isset($error))
        var type = "{{ $_POST['planet'] }}";
        var mass = document.getElementById('mass');
        var radius = document.getElementById('radius');
        var orbit = document.getElementById('orbit');
        var galaxy_mass = document.getElementById('galaxy_mass');
        var gravity = document.getElementById('gravity');

        if (type == "1") {
            mass.value = "1.989E30";
            radius.value = "6.96E5";
            orbit.value = "1.9E9";
            galaxy_mass.value = "2.8E41";
            gravity.value = "6.67438E-11";
        } else if (type == "2") {
            mass.value = "3.302E23";
            radius.value = "2.4397E3";
            orbit.value = "0.38710";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "3") {
            mass.value = "4.869E24";
            radius.value = "6.0518E3";
            orbit.value = "0.72333";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "4") {
            mass.value = "5.974E24";
            radius.value = "6.37815E3";
            orbit.value = "1.00";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "5") {
            mass.value = "7.347673E22";
            radius.value = "1.73715E3";
            orbit.value = "0.00256955";
            galaxy_mass.value = "5.974E24";
            gravity.value = "6.67438E-11";
        } else if (type == "6") {
            mass.value = "6.419E23";
            radius.value = "3.3972E3";
            orbit.value = "1.52366";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "7") {
            mass.value = "3.510E10";
            radius.value = "0.165";
            orbit.value = "1.324";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "8") {
            mass.value = "9.445E20";
            radius.value = "476.2";
            orbit.value = "2.766";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "9") {
            mass.value = "1.899E27";
            radius.value = "7.1492E4";
            orbit.value = "5.20336";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "10") {
            mass.value = "5.688E26";
            radius.value = "6.0268E4";
            orbit.value = "9.53707";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "11") {
            mass.value = "8.683E25";
            radius.value = "2.5559E4";
            orbit.value = "19.19138";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        } else if (type == "12") {
            mass.value = "1.024E26";
            radius.value = "2.4786E4";
            orbit.value = "30.06896";
            galaxy_mass.value = "1.989E30";
            gravity.value = "6.67438E-11";
        }
    @endif
</script>

@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>