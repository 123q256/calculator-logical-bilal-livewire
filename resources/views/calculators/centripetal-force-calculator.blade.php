<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                <label for="find" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select class="input" name="find" id="find">
                        <option value="1" {{ isset($_POST['find']) && $_POST['find'] == '1' ? 'selected' : '' }}>
                            {{ $lang['2'] }} (m)</option>
                        <option value="2" {{ isset($_POST['find']) && $_POST['find'] == '2' ? 'selected' : '' }}>
                            {{ $lang['3'] }} (r)</option>
                        <option value="3" {{ isset($_POST['find']) && $_POST['find'] == '3' ? 'selected' : '' }}>
                            {{ $lang['4'] }} (v) </option>
                        <option value="4" {{ isset($_POST['find']) && $_POST['find'] == '4' ? 'selected' : '' }}>
                            {{ $lang['5'] }} (F)</option>
                        <option value="5" {{ isset($_POST['find']) && $_POST['find'] == '5' ? 'selected' : '' }}>
                            {{ $lang['6'] }} (ω)</option>
                        <option value="6" {{ isset($_POST['find']) && $_POST['find'] == '6' ? 'selected' : '' }}>
                            {{ $lang['9'] }} (a)</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  mass hidden">
                <label for="mass" class="font-s-14 text-blue">{{ $lang['2'] }} (M)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="mass" id="mass" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass']) ? $_POST['mass'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="mass_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mass_unit_dropdown')">{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'g' }} ▾</label>
                    <input type="text" name="mass_unit" value="{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'g' }}" id="mass_unit" class="hidden">
                    <div id="mass_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="mass_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'g')">g</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'kg')">kg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 't')">t</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'oz')">oz</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'lb')">lb</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'stone')">stone</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'US ton')">US ton</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'Long ton')">Long ton</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'Earths')">Earths</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'Suns')">Suns</p>
                       
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  radius">
                <label for="radius" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="radius" id="radius" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['radius']) ? $_POST['radius'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="radius_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('radius_unit_dropdown')">{{ isset($_POST['radius_unit'])?$_POST['radius_unit']:'mm' }} ▾</label>
                    <input type="text" name="radius_unit" value="{{ isset($_POST['radius_unit'])?$_POST['radius_unit']:'mm' }}" id="radius_unit" class="hidden">
                    <div id="radius_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="radius_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('radius_unit', 'mm')">mm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('radius_unit', 'cm')">cm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('radius_unit', 'm')">m</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('radius_unit', 'km')">km</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('radius_unit', 'in')">in</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('radius_unit', 'ft')">ft</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('radius_unit', 'yd')">yd</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('radius_unit', 'mi')">mi</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('radius_unit', 'ly')">ly</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('radius_unit', 'au')">au</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  t_velocity">
                <label for="t_velocity" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="t_velocity" id="t_velocity" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['t_velocity']) ? $_POST['t_velocity'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="t_velocity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t_velocity_unit_dropdown')">{{ isset($_POST['t_velocity_unit'])?$_POST['t_velocity_unit']:'m/s' }} ▾</label>
                    <input type="text" name="t_velocity_unit" value="{{ isset($_POST['t_velocity_unit'])?$_POST['t_velocity_unit']:'m/s' }}" id="t_velocity_unit" class="hidden">
                    <div id="t_velocity_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="t_velocity_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_velocity_unit', 'm/s')">m/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_velocity_unit', 'km/h')">km/h</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_velocity_unit', 'ft/s')">ft/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_velocity_unit', 'mph')">mph</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_velocity_unit', 'ft/min')">ft/min</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_velocity_unit', 'm/min')">m/min</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  centi_force">
                <label for="c_force" class="font-s-14 text-blue">{{ $lang['5'] }} (F)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="c_force" id="c_force" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['c_force']) ? $_POST['c_force'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="c_force_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('c_force_unit_dropdown')">{{ isset($_POST['c_force_unit'])?$_POST['c_force_unit']:'N' }} ▾</label>
                    <input type="text" name="c_force_unit" value="{{ isset($_POST['c_force_unit'])?$_POST['c_force_unit']:'N' }}" id="c_force_unit" class="hidden">
                    <div id="c_force_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="c_force_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_force_unit', 'N')">N</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_force_unit', 'km/h')">km/h</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_force_unit', 'kN')">kN</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_force_unit', 'pdl')">pdl</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('c_force_unit', 'lbf')">lbf</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  angular_velocity  hidden">
                <label for="angular_velocity" class="font-s-14 text-blue">{{ $lang['6'] }} (ω)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="angular_velocity" id="angular_velocity" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['angular_velocity']) ? $_POST['angular_velocity'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="angular_velocity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('angular_velocity_unit_dropdown')">{{ isset($_POST['angular_velocity_unit'])?$_POST['angular_velocity_unit']:'rpm' }} ▾</label>
                    <input type="text" name="angular_velocity_unit" value="{{ isset($_POST['angular_velocity_unit'])?$_POST['angular_velocity_unit']:'rpm' }}" id="angular_velocity_unit" class="hidden">
                    <div id="angular_velocity_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="angular_velocity_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angular_velocity_unit', 'rpm')">rpm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angular_velocity_unit', 'rad/s')">rad/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('angular_velocity_unit', 'Hz')">Hz</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  centripetal_acceleration  hidden">
                <label for="centripetal_acceleration" class="font-s-14 text-blue">{{ $lang['7'] }} (a)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="centripetal_acceleration" id="centripetal_acceleration" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['centripetal_acceleration']) ? $_POST['centripetal_acceleration'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="centripetal_acceleration_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('centripetal_acceleration_unit_dropdown')">{{ isset($_POST['centripetal_acceleration_unit'])?$_POST['centripetal_acceleration_unit']:'m/s²' }} ▾</label>
                    <input type="text" name="centripetal_acceleration_unit" value="{{ isset($_POST['centripetal_acceleration_unit'])?$_POST['centripetal_acceleration_unit']:'m/s²' }}" id="centripetal_acceleration_unit" class="hidden">
                    <div id="centripetal_acceleration_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="centripetal_acceleration_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('centripetal_acceleration_unit', 'm/s²')">m/s²</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('centripetal_acceleration_unit', 'g')">g</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('centripetal_acceleration_unit', 'm/s')">m/s</p>
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
                    <div class="w-full text-[18px]">
                        <div id="res_copy">
                            @if(isset($detail['mass']) && $detail['mass']!="")
            
                            <div class="col-lg-5 mt-2">
                                <table class="w-100 font-s-18">
                                   <tr>
                                      <td class="py-2 border-b" width="70%"><strong>{{ $lang[2] }} </strong></td>
                                       <td class="py-2 border-b"> {{ $detail['mass'] }} (kg)</td>
                                   </tr>
                          
                                </table>
                            </div>
                                <p class="mt-3">{{$lang['8']}}</p>
                                <p class="mt-2"><strong>{{$lang['9']}} :</strong></p>
                                <p class="mt-2">
                                 m = d
                                    <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                        <span class="num">Fc.r</span>
                                        <span class="visually-hidden"> / </span>
                                        <span class="den">v<sup>2</sup> </span>
                                    </span>
                                </p>
                                <p class="mt-2"><strong>{{$lang['11']}} :</strong></p>
                                <p class="mt-2">
                                m = d
                                    <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                        <span class="num">Fc.r</span>
                                        <span class="visually-hidden"> / </span>
                                        <span class="den">v<sup>2</sup> </span>
                                    </span>
                                </p>
                                <p class="mt-2">
                                m = d
                                    <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                        <span class="num">{{ $detail['c'] }}*{{ $detail['r'] }}</span>
                                        <span class="visually-hidden"> / </span>
                                        <span class="den">{{ $detail['v'] }}<sup>2</sup> </span>
                                    </span>
                                </p>
            
                                <p class="mt-2 dk">m = {{ $detail['mass'] }}`</p>
                            @endif
            
                            @if(isset($detail['radius']) && $detail['radius']!="")
                                <div class="col-lg-5 mt-2">
                                    <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }} </strong></td>
                                        <td class="py-2 border-b"> {{ $detail['radius'] }} (m)</td>
                                    </tr>
                                    </table>
                                </div>
                                <p class="mt-2"><strong>{{$lang['8']}} :</strong></p>
                                <p class="mt-2"><strong>{{$lang['9']}} :</strong></p>
                                <p class="mt-2">
                                    r =
                                    <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                        <span class="num">m v<sup>2</sup></span>
                                        <span class="visually-hidden"> / </span>
                                        <span class="den">F </span>
                                    </span>
                                    </p>
                                <p class="mt-2"><strong>{{$lang['11']}} :</strong></p>
                                <p class="mt-2">
                                    r =
                                    <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                        <span class="num">m v<sup>2</sup></span>
                                        <span class="visually-hidden"> / </span>
                                        <span class="den">F </span>
                                    </span>
                                </p>
                                <p class="mt-2">
                                    r =
                                    <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                        <span class="num">{{ $detail['m'] }}* {{ $detail['v'] }}<sup>2</sup></span>
                                        <span class="visually-hidden"> / </span>
                                        <span class="den">{{ $detail['c'] }}</span>
                                    </span>
                                </p>
                                <p class="mt-2 dk">r = {{ $detail['radius'] }}</p>
                            @endif
                            @if(isset($detail['velocity']) && $detail['velocity']!="")
                                <div class="col-lg-8 mt-2">
                                    <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[4] }} (v)</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['velocity'] }} (m/s)</td>
                                    </tr>
                                    </table>
                                </div>
                                <p class="mt-2"><strong><?=$lang['8']?> :</strong></p>
                                <p class="mt-2"><strong><?=$lang['9']?> :</strong></p>
                                <p class="mt-2">v= 
                                    <span class="fractionUpDown quadratic_math-eq-token">
                                        <span class="quadratic_square-root">r*Fc</span>/
                                        <span class="">m</span>
                                    </span>
                                </p>
                                <p class="mt-2"><strong><?=$lang['11']?> :</strong></p>
                                <p class="mt-2">v= 
                                    <span class="fractionUpDown quadratic_math-eq-token">
                                        <span class="quadratic_square-root">r*Fc</span>/
                                        <span class="">m</span>
                                    </span>
                                </p>
                                <p class="mt-2">v= 
                                    <span class="fractionUpDown quadratic_math-eq-token">
                                        <span class="quadratic_square-root">{{$detail['r']}}*{{$detail['c']}}</span>/
                                        <span class="">{{$detail['m']}}</span>
                                    </span>
                                </p>
                                <p class="mt-2">v= 
                                    <span class="fractionUpDown quadratic_math-eq-token">
                                        <span class="quadratic_square-root">{{$detail['r']}}*{{$detail['c']}}</span>/
                                        <span class="">{{$detail['m']}}</span>
                                    </span>
                                </p>
                                <p class="mt-2 dk">v = {{ $detail['velocity'] }}</p>
                            @endif
                            @if(isset($detail['centripetal_force']) && $detail['centripetal_force']!="")
                                <div class="col-lg-8 mt-2">
                                    <table class="w-100 font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><strong>{{ $lang[5] }} (F)</strong></td>
                                            <td class="py-2 border-b"> {{ $detail['centripetal_force'] }} (N)</td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="mt-2"><?=$lang['8']?></p>
                                <p class="mt-2"><strong><?=$lang['9']?> :</strong></p>
                                <p class="mt-2">
                                    F =
                                    <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                        <span class="num">m v<sup>2</sup></span>
                                        <span class="visually-hidden"> / </span>
                                        <span class="den">r </span>
                                    </span>
                                </p>
                                <p class="mt-2"><strong><?=$lang['11']?> :</strong></p>
                                <p class="mt-2">
                                    F =
                                    <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                        <span class="num">m v<sup>2</sup></span>
                                        <span class="visually-hidden"> / </span>
                                        <span class="den">r </span>
                                    </span>
                                </p>
                                <p class="mt-2">
                                    F =
                                    <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                        <span class="num">{{$detail['m']}}*{{$detail['v']}}<sup>2</sup></span>
                                        <span class="visually-hidden"> / </span>
                                        <span class="den">r </span>
                                    </span>
                                </p>
                                <p class="mt-2 dk">F = {{$detail['centripetal_force'] }}</p>
                            @endif
                            @if(isset($detail['angular_velocity']) && $detail['angular_velocity']!="")
                            <div class="col-lg-8 mt-2">
                                <table class="w-100 font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>{{ $lang[6] }} (ω)</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['angular_velocity'] }} (rad/s)</td>
                                    </tr>
                                </table>
                            </div>
                                <p class="mt-3">{{$lang['8']}}</p>
                                <p class="mt-2"><strong>{{$lang['9']}} :</strong></p>
                                <p class="mt-2">ω= 
                                    <span class="fractionUpDown quadratic_math-eq-token">
                                        <span class="quadratic_square-root">F</span>/
                                        <span class="">m*r</span>
                                    </span>
                                </p>
                                <p class="mt-2"><strong>{{$lang['11']}} :</strong></p>
                                <p class="mt-2">ω= 
                                    <span class="fractionUpDown quadratic_math-eq-token">
                                        <span class="quadratic_square-root">F</span>/
                                        <span class="">m*r</span>
                                    </span>
                                </p>
                                <p class="mt-2">ω= 
                                    <span class="fractionUpDown quadratic_math-eq-token">
                                        <span class="quadratic_square-root">{{$detail['c']}}</span>/
                                        <span class="">{{$detail['m']}}*{{$detail['r']}}</span>
                                    </span>
                                </p>
                                <p class="mt-2 dk">ω = {{$detail['angular_velocity']}}</p>
                            @endif
                            @if(isset($detail['ac']) && $detail['ac']!="")
                                <div class="col-lg-8 mt-2">
                                    <table class="w-100 font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="50%"><strong>{{ $lang[7] }} (a)</strong></td>
                                            <td class="py-2 border-b"> {{ $detail['ac'] }} (m/s<sup>2</sup>)</td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="mt-2">{{$lang['8']}}</p>
                                <p class="mt-2"><strong>{{$lang['9']}}:</strong></p>
                                <p class="mt-2">
                                  a = 
                                    <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                        <span class="num">v<sup>2</sup></span>
                                        <span class="visually-hidden"> / </span>
                                        <span class="den">r</span>
                                    </span>
                                </p>
                             
                                <p class="mt-2"><strong><?=$lang['11']?> :</strong></p>
                                <p class="mt-2">
                                 a = 
                                    <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                        <span class="num">{{$detail['v']}}<sup>2</sup></span>
                                        <span class="visually-hidden"> / </span>
                                        <span class="den">{{$detail['r']}}</span>
                                    </span>
                                </p>
                                <p class="mt-2">
                                 a = 
                                <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                    <span class="num">{{$detail['v'] *$detail['v']}}</span>
                                    <span class="visually-hidden"> / </span>
                                    <span class="den">{{$detail['r']}}</span>
                                </span>
                                </p>
                                <p class="mt-2 dk">a = {{$detail['ac'] }}</p>
                            @endif
                        </div>
                    </div>
               </div>

            </div>
        </div>
    </div>
    @endisset
</form>
<script>


@if(isset($detail))
    var a = "{{$_POST['find']}}";

        var t_velocity = document.querySelectorAll(".t_velocity");
        var centi_force = document.querySelectorAll(".centi_force");
        var radius = document.querySelectorAll(".radius");
        var mass = document.querySelectorAll(".mass");
        var angular_velocity = document.querySelectorAll(".angular_velocity");
        var centi_acceleration = document.querySelectorAll(".centi_acceleration");

        function showElements(elements) {
            elements.forEach(function(element) {
                element.style.display = "block";
            });
        }

        function hideElements(elements) {
            elements.forEach(function(element) {
                element.style.display = "none";
            });
        }

        hideElements(t_velocity);
        hideElements(centi_force);
        hideElements(radius);
        hideElements(mass);
        hideElements(angular_velocity);
        hideElements(centi_acceleration);

        if (a == "1") {
            showElements(t_velocity);
            showElements(centi_force);
            showElements(radius);
        } else if (a == "2") {
            showElements(mass);
            showElements(centi_force);
            showElements(t_velocity);
        } else if (a == "3") {
            showElements(mass);
            showElements(centi_force);
            showElements(radius);
        } else if (a == "4") {
            showElements(mass);
            showElements(radius);
            showElements(t_velocity);
        } else if (a == "5") {
            showElements(mass);
            showElements(radius);
            showElements(centi_force);
        } else if (a == "6") {
            showElements(radius);
            showElements(t_velocity);
        }

@endif

@if(isset($error))
    var a = "{{$_POST['find']}}";

        var t_velocity = document.querySelectorAll(".t_velocity");
        var centi_force = document.querySelectorAll(".centi_force");
        var radius = document.querySelectorAll(".radius");
        var mass = document.querySelectorAll(".mass");
        var angular_velocity = document.querySelectorAll(".angular_velocity");
        var centi_acceleration = document.querySelectorAll(".centi_acceleration");

        function showElements(elements) {
            elements.forEach(function(element) {
                element.style.display = "block";
            });
        }

        function hideElements(elements) {
            elements.forEach(function(element) {
                element.style.display = "none";
            });
        }

        hideElements(t_velocity);
        hideElements(centi_force);
        hideElements(radius);
        hideElements(mass);
        hideElements(angular_velocity);
        hideElements(centi_acceleration);

        if (a == "1") {
            showElements(t_velocity);
            showElements(centi_force);
            showElements(radius);
        } else if (a == "2") {
            showElements(mass);
            showElements(centi_force);
            showElements(t_velocity);
        } else if (a == "3") {
            showElements(mass);
            showElements(centi_force);
            showElements(radius);
        } else if (a == "4") {
            showElements(mass);
            showElements(radius);
            showElements(t_velocity);
        } else if (a == "5") {
            showElements(mass);
            showElements(radius);
            showElements(centi_force);
        } else if (a == "6") {
            showElements(radius);
            showElements(t_velocity);
        }

@endif
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("find").addEventListener("change", function() {
        var a = this.value;
        var t_velocity = document.querySelectorAll(".t_velocity");
        var centi_force = document.querySelectorAll(".centi_force");
        var radius = document.querySelectorAll(".radius");
        var mass = document.querySelectorAll(".mass");
        var angular_velocity = document.querySelectorAll(".angular_velocity");
        var centi_acceleration = document.querySelectorAll(".centi_acceleration");

        function showElements(elements) {
            elements.forEach(function(element) {
                element.style.display = "block";
            });
        }

        function hideElements(elements) {
            elements.forEach(function(element) {
                element.style.display = "none";
            });
        }

        hideElements(t_velocity);
        hideElements(centi_force);
        hideElements(radius);
        hideElements(mass);
        hideElements(angular_velocity);
        hideElements(centi_acceleration);

        if (a == "1") {
            showElements(t_velocity);
            showElements(centi_force);
            showElements(radius);
        } else if (a == "2") {
            showElements(mass);
            showElements(centi_force);
            showElements(t_velocity);
        } else if (a == "3") {
            showElements(mass);
            showElements(centi_force);
            showElements(radius);
        } else if (a == "4") {
            showElements(mass);
            showElements(radius);
            showElements(t_velocity);
        } else if (a == "5") {
            showElements(mass);
            showElements(radius);
            showElements(centi_force);
        } else if (a == "6") {
            showElements(radius);
            showElements(t_velocity);
        }
    });
});


</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>