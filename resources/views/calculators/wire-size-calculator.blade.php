<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    {{-- @unless(isset($detail))  --}}

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
           <input type="hidden" name="unit_type" id="unit_type" value="wire_size">
            @if (isset($error))
                    <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
                        <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                            @if($_POST['unit_type'] == 'wire_size')
                                <div class="lg:w-1/3 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 text-[12px] cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit tab1" id="tab1">
                                        {{$lang['1']}}
                                    </div>
                                </div>
                            @elseif($_POST['unit_type'] == '')
                                <div class="lg:w-1/3 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 text-[12px] cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit tab1" id="tab1">
                                        {{$lang['1']}}
                                    </div>
                                </div>
                            @else
                                <div class="lg:w-1/3 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 text-[12px] cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tab1" id="tab1">
                                        {{$lang['1']}}
                                    </div>
                                </div>
                            @endif

                            @if($_POST['unit_type'] == 'wire_diameter')
                                <div class="lg:w-1/3 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 text-[12px] cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit tab2" id="tab2">
                                        {{$lang['2']}}
                                    </div>
                                </div>
                            @else
                            <div class="lg:w-1/3 w-full px-2 py-1">
                                <div class="bg-white px-3 py-2 text-[12px] cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  tab2" id="tab2">
                                    {{$lang['2']}}
                                </div>
                            </div>
                            @endif
                            @if($_POST['unit_type'] == 'wire_gauge')
                            <div class="lg:w-1/3 w-full px-2 py-1">
                                <div class="bg-white px-3 py-2 text-[12px] cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit tab3" id="tab3">
                                    {{$lang['3']}}
                                </div>
                            </div>
                            @else
                            <div class="lg:w-1/3 w-full px-2 py-1">
                                <div class="bg-white px-3 py-2 text-[12px] cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tab3" id="tab3">
                                    {{$lang['3']}}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>



            @else
                @if(isset($detail))
                    <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
                            <div class="flex flex-wrap items-center bg-green-100 border border-green-500 text-center rounded-lg px-1">
                                @if($_POST['unit_type'] == 'wire_size')
                                    <div class="lg:w-1/3 w-full px-2 py-1">
                                        <div class="bg-white px-3 py-2  text-[12px] cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit tab1" id="tab1">
                                            {{$lang['1']}}
                                        </div>
                                    </div>
                                @elseif($_POST['unit_type'] == '')
                                    <div class="lg:w-1/3 w-full px-2 py-1">
                                        <div class="bg-white px-3 py-2  text-[12px] cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit tab1" id="tab1">
                                            {{$lang['1']}}
                                        </div>
                                    </div>
                                @else
                                    <div class="lg:w-1/3 w-full px-2 py-1">
                                        <div class="bg-white px-3 py-2  text-[12px] cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tab1" id="tab1">
                                            {{$lang['1']}}
                                        </div>
                                    </div>
                                @endif



                                @if($_POST['unit_type'] == 'wire_diameter')
                                    <div class="lg:w-1/3 w-full px-2 py-1">
                                        <div class="bg-white px-3 py-2  text-[12px] cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit tab2" id="tab2">
                                            {{$lang['2']}}
                                        </div>
                                    </div>
                                @else
                                <div class="lg:w-1/3 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2  text-[12px] cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  tab2" id="tab2">
                                        {{$lang['2']}}
                                    </div>
                                </div>
                                @endif
                                @if($_POST['unit_type'] == 'wire_gauge')
                                <div class="lg:w-1/3 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2  text-[12px] cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit tab3" id="tab3">
                                        {{$lang['3']}}
                                    </div>
                                </div>
                                @else
                                <div class="lg:w-1/3 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2  text-[12px] cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tab3" id="tab3">
                                        {{$lang['3']}}
                                    </div>
                                </div>
                                @endif
                            </div>
                    </div>
                @else
                        <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
                         
                            <div class="flex flex-wrap items-center bg-green-100 border border-green-500 text-center rounded-lg px-1">
                                <div class="lg:w-1/3 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 text-[12px] cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit tab1" id="tab1">
                                        {{$lang['1']}}
                                    </div>
                                </div>
                                <div class="lg:w-1/3 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 text-[12px] cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tab2" id="tab2">
                                        {{$lang['2']}}
                                    </div>
                                </div>
                                <div class="lg:w-1/3 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 text-[12px] cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tab3" id="tab3">
                                        {{$lang['3']}}
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif

            @endif
            <div class="grid grid-cols-12 mt-4 gap-4">
                <div class="col-span-12 wire_size" id="wire_sizes">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="type" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                            <div class="w-full py-2 position-relative">
                                <select class="input" name="type" id="myselection" >
                                    <option value="single_phase" {{ isset($_POST['type']) && $_POST['type'] == 'single_phase' ? 'selected' : '' }}> {{ $lang['36'] }} </option>
                                    <option value="three_phase"  {{ isset($_POST['type']) && $_POST['type'] == 'three_phase' ? 'selected' : '' }}> {{ $lang['37'] }}   </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="s_voltage" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="s_voltage" id="s_voltage" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['s_voltage']) ? $_POST['s_voltage'] : '5.771' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="sv_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('sv_units_dropdown')">{{ isset($_POST['sv_units'])?$_POST['sv_units']:'mV' }} ▾</label>
                                <input type="text" name="sv_units" value="{{ isset($_POST['sv_units'])?$_POST['sv_units']:'mV' }}" id="sv_units" class="hidden">
                                <div id="sv_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="sv_units">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sv_units', 'mV')">mV</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sv_units', 'V')">V</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sv_units', 'kV')">kV</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sv_units', 'MV')">MV</p>
                                </div>
                             </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="voltage_drop" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="voltage_drop" id="voltage_drop" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['voltage_drop'])?$_POST['voltage_drop']:'3' }}" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="c_units" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                            <div class="w-full py-2 position-relative">
                                <select class="input" name="c_units" id="myselection" >
                                    <option value="copper" {{ isset($_POST['c_units']) && $_POST['c_units'] == 'copper' ? 'selected' : '' }}> {{ $lang['38'] }} </option>
                                    <option value="aluminum"  {{ isset($_POST['c_units']) && $_POST['c_units'] == 'aluminum' ? 'selected' : '' }}> {{ $lang['39'] }}   </option>
                                    <option value="gold"  {{ isset($_POST['c_units']) && $_POST['c_units'] == 'gold' ? 'selected' : '' }}> {{ $lang['40'] }}   </option>
                                    <option value="silver"  {{ isset($_POST['c_units']) && $_POST['c_units'] == 'silver' ? 'selected' : '' }}> {{ $lang['41'] }}   </option>
                                    <option value="nickel"  {{ isset($_POST['c_units']) && $_POST['c_units'] == 'nickel' ? 'selected' : '' }}> {{ $lang['42'] }}   </option>
                                    <option value="steel"  {{ isset($_POST['c_units']) && $_POST['c_units'] == 'steel' ? 'selected' : '' }}> {{ $lang['43'] }}   </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="current" class="font-s-14 text-blue">{{ $lang['8'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="current" id="current" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['current']) ? $_POST['current'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="current_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('current_unit_dropdown')">{{ isset($_POST['current_unit'])?$_POST['current_unit']:'A' }} ▾</label>
                                <input type="text" name="current_unit" value="{{ isset($_POST['current_unit'])?$_POST['current_unit']:'A' }}" id="current_unit" class="hidden">
                                <div id="current_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="current_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('current_unit', 'A')">A</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('current_unit', 'mA')">mA</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('current_unit', 'µA')">µA</p>
                                </div>
                             </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="wire_length" class="font-s-14 text-blue">{{ $lang['9'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="wire_length" id="wire_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wire_length']) ? $_POST['wire_length'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="wl_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wl_units_dropdown')">{{ isset($_POST['wl_units'])?$_POST['wl_units']:'cm' }} ▾</label>
                                <input type="text" name="wl_units" value="{{ isset($_POST['wl_units'])?$_POST['wl_units']:'cm' }}" id="wl_units" class="hidden">
                                <div id="wl_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wl_units">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wl_units', 'cm')">cm</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wl_units', 'm')">m</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wl_units', 'km')">km</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wl_units', 'in')">in</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wl_units', 'ft')">ft</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wl_units', 'yd')">yd</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wl_units', 'mi')">mi</p>
                                </div>
                             </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="w_temp" class="font-s-14 text-blue">{{ $lang['10'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="w_temp" id="w_temp" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['w_temp']) ? $_POST['w_temp'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="wl_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wl_units_dropdown')">{{ isset($_POST['wl_units'])?$_POST['wl_units']:'°C' }} ▾</label>
                                <input type="text" name="wl_units" value="{{ isset($_POST['wl_units'])?$_POST['wl_units']:'°C' }}" id="wl_units" class="hidden">
                                <div id="wl_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wl_units">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wl_units', '°C')">°C</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wl_units', '°F')">°F</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wl_units', 'K')">K</p>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-6 wire_diameter d-none" id="wire_diameters">
                    @php
                    $name = ["2000 kcmil", "1750 kcmil", "1500 kcmil", "1250 kcmil", "1000 kcmil", "900 kcmil", "800 kcmil", "750 kcmil", "700 kcmil", "600 kcmil", "500 kcmil", "400 kcmil", "350 kcmil", "300 kcmil", "250 kcmil", "0000 (4/0) AWG", "000 (3/0) AWG", "00 (2/0) AWG", "0 (1/0) AWG", "1 AWG", "2 AWG", "3 AWG", "4 AWG", "5 AWG", "6 AWG", "7 AWG", "8 AWG", "9 AWG", "10 AWG", "11 AWG", "12 AWG", "13 AWG", "14 AWG", "15 AWG", "16 AWG", "17 AWG", "18 AWG", "19 AWG", "20 AWG", "21 AWG", "22 AWG", "23 AWG", "24 AWG", "25 AWG", "26 AWG", "27 AWG", "28 AWG", "29 AWG", "30 AWG", "31 AWG", "32 AWG", "33 AWG", "34 AWG", "35 AWG", "36 AWG", "37 AWG", "38 AWG", "39 AWG", "40 AWG"];
                    
                    $val = ["2000-kcmil", "1750-kcmil", "1500-kcmil", "1250-kcmil", "1000-kcmil", "900-kcmil", "800-kcmil", "750-kcmil", "700-kcmil", "600-kcmil", "500-kcmil", "400-kcmil", "350-kcmil", "300-kcmil", "250-kcmil", "0000 (4/0)", "000 (3/0)", "00 (2/0)", "0 (1/0)", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39", "40"];
                    @endphp
                     <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 ">
                        <label for="wire_gauge" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <select class="input" name="wire_gauge" id="wire_gauge" onchange="wire_gauge_method(this)">
                                @foreach($name as $index => $text)
                                    <option value="{{ htmlspecialchars($val[$index]) }}" {{ isset($_POST['wire_gauge']) && $_POST['wire_gauge'] == $val[$index] ? 'selected' : '' }}>
                                        {{ htmlspecialchars($text)}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                     </div>
                </div>
                <div class="col-span-6 wire_gauge d-none" id="wire_gauges">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <label for="wire_diameter" class="font-s-14 text-blue">{{ $lang['12'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="wire_diameter" id="wire_diameter" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wire_diameter']) ? $_POST['wire_diameter'] : '5.771' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="wd_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wd_units_dropdown')">{{ isset($_POST['wd_units'])?$_POST['wd_units']:'in' }} ▾</label>
                                <input type="text" name="wd_units" value="{{ isset($_POST['wd_units'])?$_POST['wd_units']:'in' }}" id="wd_units" class="hidden">
                                <div id="wd_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wd_units">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wd_units', 'in')">in</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wd_units', 'mm')">mm</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wd_units', 'cm')">cm</p>
                                </div>
                             </div>
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

    {{-- @endunless --}}
    @isset($detail)
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full  text-[18px] overflow-auto">
                         @if ($detail['submit'] == 'wire_size')
                            @if ($detail['type'] == 'single_phase')
                                @php $res = round($detail['single_phase'],2)@endphp
            
                            <div class="w-full  mt-2">
                                <table class="w-full text-[18px]">
                                   <tr>
                                      <td class="py-2 border-b" width="70%"><strong>{{ $lang[13] }} </strong></td>
                                       <td class="py-2 border-b"> {{ $detail['s_data'][1] }} {{$lang[14]}}</td>
                                   </tr>
                                   <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[15] }} </strong></td>
                                     <td class="py-2 border-b"> {{ round($detail['single_phase'],2) }}  mm<sup>2</sup></td>
                                  </tr>
                                </table>
                                <p class="w-full mt-3">{{$lang['16']}}</p>
                                <table class="w-full text-[18px]">
                                    <tr>
                                       <td class="py-2 border-b" width="70%"><strong>{{ $lang[17] }} </strong></td>
                                        <td class="py-2 border-b"> {{ $res * 0.000001}} m²</td>
                                    </tr>
                                    <tr>
                                     <td class="py-2 border-b" width="70%"><strong>{{ $lang[18] }} </strong></td>
                                      <td class="py-2 border-b"> {{ round($res * 0.00155,5) }}  in²</td>
                                   </tr>
                                   <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[19] }} </strong></td>
                                     <td class="py-2 border-b"> {{ round($res * 1973.6,4) }}  cmil</td>
                                  </tr>
                                  <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[20] }} </strong></td>
                                     <td class="py-2 border-b"> {{ round($res * 1.9736,2) }} kcmil</td>
                                  </tr>
                                </table>
                            </div>
                                <p class="mt-2"><span> {{$lang[21]}}</p>
                                <p class="mt-2">\(A(m^2)= \dfrac{I(A) \times ρ(Ω·m) \times L(m) }{V_V}\)</p>
                                <p class="mt-2">Where:</p>
                                <p class="mt-2">A = {{$lang[22]}}</p>
                                <p class="mt-2">ρ = {{$lang[23]}} (Ω·m)</p>
                                <p class="mt-2 ">L = {{$lang[24]}}</p>
                                <p class="mt-2 ">I = {{$lang[25]}}</p>
                                <p class="mt-2 ">v = {{$lang[26]}}</p>
                                <p class="mt-2 ">V = Source voltage</p>
                                <p class="mt-2">{{$lang['27']}}</p>
                                <p class="mt-2">{{$lang[28]}} (ρ) = {{$detail['c_units']}} ({{$detail['metalunit']}}) Ω⋅m</p>
                                <p class="mt-2">{{$lang[29]}}(L) = {{$detail['wire_length']}} m</p>
                                <p class="mt-2">{{$lang[30]}} (I) = {{$detail['current']}} A</p>
                                <p class="mt-2"> Source voltage (V) = {{$detail['s_voltage']}} V</p>
                                <p class="mt-2">{{$lang[31]}} (v) = {{$detail['voltage_drop']}} %</p>
                                <p class="mt-2">{{$lang[32]}}</p>
                                <p class="mt-2 ">\(A(m^2)= \dfrac{I(A) \times ρ(Ω·m) \times L(m) }{V_V}\)</p>
                                <p class="mt-2 ">\(= \dfrac{ {{$detail['current']}} \times {{round($detail['metalunit'],2)}} \times 10^{-8} \times (2 \times {{$detail['wire_length']}}) }{ {{$detail['voltage_drop']/100}} \times {{$detail['s_voltage']}}}\) </p>
                                <p class="mt-2 ">\(= \dfrac{ {{$detail['res']}} }{{{$detail['v']}}}\) </p>
                                <p class="mt-2 ">\(= {{$detail['am']}} mm \times 1000000\) </p>
                                <p class="mt-2 ">\(= {{round($detail['single_phase'],2)}} mm^2\)</p>
                                <p class="mt-2 ">{{$lang[33]}} <strong>{{$detail['s_data'][1]}}AWG</strong> {{$lang[34]}} <strong>{{round($detail['single_phase'],2)}} mm²</strong> {{$lang[35]}}.</p>
                            @endif
                            @if($detail['type'] == 'three_phase')
                                @php $res1 = round($detail['three_phase'],2)
                                @endphp
            
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[13] }} </strong></td>
                                        <td class="py-2 border-b"> {{ $detail['t_data'][1] }} AWG</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[15] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['three_phase'],2) }}  mm<sup>2</sup></td>
                                    </tr>
                                    </table>
                                    <p class="w-full mt-3">{{$lang['16']}}</p>
                                    <table class="w-full text-[18px]">
                                        <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[17] }} </strong></td>
                                            <td class="py-2 border-b"> {{ $res1 * 0.000001}} m²</td>
                                        </tr>
                                        <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[18] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($res1 * 0.00155,5) }}  in²</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[19] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($res1 * 1973.6,4) }}  cmil</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[20] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($res1 * 1.9736,2) }} kcmil</td>
                                    </tr>
                                    </table>
                                </div>
                                <p class="mt-2"><span>{{ $lang['21']}}</p>
                                <p class="mt-2">\(A(m^2)= \dfrac{\sqrt{3} \times ρ(Ω·m) \times L(m) \times I(A)}{V_V}\)</p>
                                <p class="mt-2">Where:</p>
                                <p class="mt-2">A = {{ $lang['22']}}</p>
                                <p class="mt-2">ρ = {{ $lang['23']}} (Ω·m)</p>
                                <p class="mt-2 ">L = {{ $lang['24']}}</p>
                                <p class="mt-2 ">I = {{ $lang['25']}}</p>
                                <p class="mt-2 ">v = {{ $lang['26']}}</p>
                                <p class="mt-2 ">V = Source voltage</p>
                                <p class="mt-2">{{ $lang['27']}}</p>
                                <p class="mt-2">{{ $lang['28']}} (ρ) = {{ $detail['c_units']}} ({{ $detail['metalunit']}}) Ω⋅m</p>
                                <p class="mt-2">{{ $lang['29']}}(L) = {{ $detail['wire_length']}} m</p>
                                <p class="mt-2">{{ $lang['30']}} (I) = {{ $detail['current']}} A</p>
                                <p class="mt-2"> Source voltage (V) = {{ $detail['s_voltage']}} V</p>
                                <p class="mt-2">{{ $lang['31']}} (v) = {{ $detail['voltage_drop']}} %</p>
                                <p class="mt-2">{{ $lang['32']}}</p>
                                <p class="mt-2 ">\(A(m^2)=  \dfrac{\sqrt{3} \times ρ(Ω·m) \times L(m) \times I(A)}{V_V}\)</p>
                                <p class="mt-2 ">\(= \dfrac{ {{ round($detail['sqrt'],4)}} \times {{ $detail['metalunit']}}\times 10^{-8} \times {{ $detail['wire_length']}} \times {{ $detail['current']}}}{ {{ $detail['voltage_drop']/100}} \times {{ $detail['s_voltage']}}}\) </p>
                                <p class="mt-2 ">\(= \dfrac{{{  $detail['res']}}}{{{ $detail['v']}}}\) </p>
                                <p class="mt-2 ">\(= {{ $detail['am']}} \times 1,000,000\)</p>
                                <p class="mt-2 ">\(= {{ $detail['three_phase']}}\)</p>
                                <p class="mt-2 ">{{ $lang['33']}} <strong>{{ $detail['t_data'][1]}}AWG</strong> {{ $lang['34']}} <strong>{{ $detail['three_phase']}} mm²</strong> {{ $lang['35']}}.</p>
                            @endif
                        @endif
                        @if($detail['submit'] == 'wire_diameter')
                            <div class="w-full mt-2">
                                <p class="w-full mt-3">{{$lang['12']}}</p>
                                <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[44] }}</strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['inches'],4) }} in</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[45] }}</strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['mm'],4) }} mm</td>
                                </tr>
                                </table>
                                <p class="w-full mt-3">{{$lang['15']}}</p>
                                <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>kcmil</strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['kcmil'],4) }} kcmil</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[45] }}</strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['sqinches'],4) }} in<sup>2</sup></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[47] }}</strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['mm2'],4) }} mm<sup>2</sup></td>
                                </tr>
                                </table>
                            </div>
                         @endif
                        @if ($detail['submit'] == 'wire_gauge')
                            <div class="w-full mt-2">
                                <p class="w-full mt-3">{{$lang['13']}}</p>
                                    <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>AWG</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['d_data'][1] }} AWG</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>Diameter inches</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['d_data'][0] }} in</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>Diameter millimeters</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['d_data'][2]['mm'] }} mm</td>
                                    </tr>
                                    </table>
                                <p class="w-full mt-3">{{$lang['15']}}</p>
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>kcmil</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['d_data'][2]['kcmil'] }} kcmil</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[46] }}</strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['square_in'],2) }} in<sup>2</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[47] }}</strong></td>
                                        <td class="py-2 border-b"> {{ $detail['d_data'][2]['mm²'] }} mm<sup>2</sup></td>
                                    </tr>
                                </table>
                           </div>
                        @endif
                    </div>
                    <div class="flex justify-center gap-3 mb-6 my-[25px]">
                        <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                            @if (app()->getLocale() == 'en')
                                RESET
                            @else
                                {{ $lang['reset'] ?? 'RESET' }}
                            @endif
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
@if(isset($detail))
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
@endif
@endpush
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.tab1').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit')
                document.querySelectorAll('.tab2,.tab3').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "wire_size"
                var wire_size = document.getElementById('wire_sizes');
                var wire_diameter = document.getElementById('wire_diameters');
                var wire_gauge = document.getElementById('wire_gauges');
                
                if (wire_size && wire_diameter && wire_gauge) {
                    wire_size.classList.remove('d-none');
                    wire_diameter.classList.add('d-none');
                    wire_gauge.classList.add('d-none');
                }
            })      
        })
        document.querySelectorAll('.tab2').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit')
                document.querySelectorAll('.tab1,.tab3').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
                
                document.getElementById('unit_type').value = "wire_diameter"
                var wire_size = document.getElementById('wire_sizes');
                var wire_diameter = document.getElementById('wire_diameters');
                var wire_gauge = document.getElementById('wire_gauges');
                
                if (wire_size && wire_diameter && wire_gauge) {
                    wire_size.classList.add('d-none');
                    wire_diameter.classList.remove('d-none');
                    wire_gauge.classList.add('d-none');
                }
            })
        })
        document.querySelectorAll('.tab3').forEach(function(element) {
            element.addEventListener('click', function() {
                this.classList.add('tagsUnit')
                document.querySelectorAll('.tab1,.tab2').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
                
                document.getElementById('unit_type').value = "wire_gauge"
                var wire_size = document.getElementById('wire_sizes');
                var wire_diameter = document.getElementById('wire_diameters');
                var wire_gauge = document.getElementById('wire_gauges');
                
                if (wire_size && wire_diameter && wire_gauge) {
                    wire_size.classList.add('d-none');
                    wire_diameter.classList.add('d-none');
                    wire_gauge.classList.remove('d-none');
                }
            })
        })
    });
    @if(isset($detail))
        @if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'wire_size')
            document.querySelectorAll('.tab1').forEach(function(element) {
                element.addEventListener('tab1', function() {
                    document.getElementById('tab2').classList.add('tagsUnit')
                    document.querySelectorAll('.tab2,.tab3').forEach(function(metricElement) {
                        metricElement.classList.remove('tagsUnit')
                    })
                    document.getElementById('unit_type').value = "wire_size"
                    var wire_size = document.getElementById('wire_sizes');
                    var wire_diameter = document.getElementById('wire_diameters');
                    var wire_gauge = document.getElementById('wire_gauges');
                    
                    if (wire_size && wire_diameter && wire_gauge) {
                        wire_size.classList.remove('d-none');
                        wire_diameter.classList.add('d-none');
                        wire_gauge.classList.add('d-none');
                    }
                })      
            })

        @endif
        @if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'wire_diameter')

            document.querySelectorAll('.tab2').forEach(function(element) {
                document.getElementById('tab2').classList.add('tagsUnit')

                document.querySelectorAll('.tab1,.tab3').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
                
                document.getElementById('unit_type').value = "wire_diameter"
                var wire_size = document.getElementById('wire_sizes');
                var wire_diameter = document.getElementById('wire_diameters');
                var wire_gauge = document.getElementById('wire_gauges');
                
                if (wire_size && wire_diameter && wire_gauge) {
                    wire_size.classList.add('d-none');
                    wire_diameter.classList.remove('d-none');
                    wire_gauge.classList.add('d-none');
                }
                })
        @endif
        @if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'wire_gauge')
        document.querySelectorAll('.tab1').forEach(function(element) {
            document.getElementById('tab1').classList.add('tagsUnit')
                    document.querySelectorAll('.tab1,.tab2').forEach(function(imperialElement) {
                        imperialElement.classList.remove('tagsUnit')
                    })
                    document.getElementById('unit_type').value = "wire_gauge"
                    var wire_size = document.getElementById('wire_sizes');
                    var wire_diameter = document.getElementById('wire_diameters');
                    var wire_gauge = document.getElementById('wire_gauges');
                    
                    if (wire_size && wire_diameter && wire_gauge) {
                        wire_size.classList.add('d-none');
                        wire_diameter.classList.add('d-none');
                        wire_gauge.classList.remove('d-none');
                    }
            })

        @endif
    @endif
    @if(isset($error))
        @if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'wire_size')
            document.querySelectorAll('.tab1').forEach(function(element) {
                element.addEventListener('tab1', function() {
                    document.getElementById('tab2').classList.add('tagsUnit')
                    document.querySelectorAll('.tab2,.tab3').forEach(function(metricElement) {
                        metricElement.classList.remove('tagsUnit')
                    })
                    document.getElementById('unit_type').value = "wire_size"
                    var wire_size = document.getElementById('wire_sizes');
                    var wire_diameter = document.getElementById('wire_diameters');
                    var wire_gauge = document.getElementById('wire_gauges');
                    
                    if (wire_size && wire_diameter && wire_gauge) {
                        wire_size.classList.remove('d-none');
                        wire_diameter.classList.add('d-none');
                        wire_gauge.classList.add('d-none');
                    }
                })      
            })

        @endif
        @if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'wire_diameter')

            document.querySelectorAll('.tab2').forEach(function(element) {
                document.getElementById('tab2').classList.add('tagsUnit')

                document.querySelectorAll('.tab1,.tab3').forEach(function(imperialElement) {
                    imperialElement.classList.remove('tagsUnit')
                })
                
                document.getElementById('unit_type').value = "wire_diameter"
                var wire_size = document.getElementById('wire_sizes');
                var wire_diameter = document.getElementById('wire_diameters');
                var wire_gauge = document.getElementById('wire_gauges');
                
                if (wire_size && wire_diameter && wire_gauge) {
                    wire_size.classList.add('d-none');
                    wire_diameter.classList.remove('d-none');
                    wire_gauge.classList.add('d-none');
                }
                })
        @endif
        @if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'wire_gauge')
        document.querySelectorAll('.tab1').forEach(function(element) {
            document.getElementById('tab1').classList.add('tagsUnit')
                    document.querySelectorAll('.tab1,.tab2').forEach(function(imperialElement) {
                        imperialElement.classList.remove('tagsUnit')
                    })
                    document.getElementById('unit_type').value = "wire_gauge"
                    var wire_size = document.getElementById('wire_sizes');
                    var wire_diameter = document.getElementById('wire_diameters');
                    var wire_gauge = document.getElementById('wire_gauges');
                    
                    if (wire_size && wire_diameter && wire_gauge) {
                        wire_size.classList.add('d-none');
                        wire_diameter.classList.add('d-none');
                        wire_gauge.classList.remove('d-none');
                    }
            })

        @endif
    @endif
</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>