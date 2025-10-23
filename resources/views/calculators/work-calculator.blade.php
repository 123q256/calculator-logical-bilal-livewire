<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="method" class="font-s-14 text-blue">{{ $lang['calculate'] }}:</label>
                    <select name="method" id="method" class="input">
                        <option value="work" {{ isset($_POST['method']) && $_POST['method']=='work'?'selected':''}}  >Work</option>
                        <option value="power" {{ isset($_POST['method']) && $_POST['method']=='power'?'selected':''}}  >Power</option>
                    </select>
                </div>
                <div class="space-y-2 method1">
                    <label for="method1" class="font-s-14 text-blue">{{ $lang['calculate'] }} {{$lang['1']}}:</label>
                    <select name="method1" id="method1" class="input">
                        <option value="fnd" {{ isset($_POST['method1']) && $_POST['method1']=='fnd'?'selected':''}}  >{{$lang['2']}} & {{$lang['3']}}</option>
                        <option value="velocity" {{ isset($_POST['method1']) && $_POST['method1']=='velocity'?'selected':''}}  >{{$lang['4']}}</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1  gap-4" id="find">
                <div class="col-12 px-2 pe-lg-4 mt-0 mt-lg-2 py-2" >
                    <p class="col">
                       <strong style="color:#000">{{ $lang['5']}}: </strong>
                    </p>
                    <p>
                        <label for="work" class="work px-2">
                            @if(isset($_POST['find']) && $_POST['find']=="work")
                            <input class="with-gap" id="work" name="find" type="radio" value="work" checked>
                            @else
                            <input class="with-gap" id="work" name="find" type="radio" value="work" checked>
                            @endif
                            <span style="color:#000">{{$lang['6']}}</span>
                        </label>
                        <label for="force" class="force px-2">
                            @if(isset($_POST['find']) && $_POST['find']=="force")
                            <input class="with-gap" id="force" name="find" type="radio" value="force" checked>
                            @else
                            <input class="with-gap" id="force" name="find" type="radio" value="force">
                            @endif
                            <span style="color:#000">{{ $lang['2']}}</span>
                        </label>
                        <label for="dsplcmnt" class="dsplcmnt px-2">
                            @if(isset($_POST['find']) && $_POST['find']=="dsplcmnt")
                            <input class="with-gap" id="dsplcmnt" name="find" type="radio" value="dsplcmnt" checked>
                            @else
                            <input class="with-gap" id="dsplcmnt" name="find" type="radio" value="dsplcmnt">
                            @endif
                            <span style="color:#000">{{ $lang['3']}}</span>
                        </label>
                    </p>
                </div>

            </div>
            <div class="grid grid-cols-1  gap-4 hidden" id="find1">
                <div class="col-12 px-2 pe-lg-4 mt-0 mt-lg-2 py-2" >
                    <p class="col">
                    <strong style="color:#000">{{ $lang['5']}}: </strong>
                    </p>
                    <p>
                        <label for="power" class="power px-2">
                            @if(isset($_POST['find1']) && $_POST['find1']=="power")
                            <input class="with-gap" id="power" name="find1" type="radio" value="power" checked>
                            @else
                                <input class="with-gap" id="power" name="find1" type="radio" value="power" checked>
                            @endif
                        <span style="color:#000">{{ $lang['7']}}</span>
                        </label>
                        <label for="work1" class="work1 px-2">
                            @if(isset($_POST['find1']) && $_POST['find1']=="work1")
                            <input class="with-gap" id="work1" name="find1" type="radio" value="work1" checked>
                            @else
                                <input class="with-gap" id="work1" name="find1" type="radio" value="work1">
                            @endif
                        <span style="color:#000">{{ $lang['6']}}</span>
                        </label>
                        <label for="time" class="time px-2">
                            @if(isset($_POST['find1']) && $_POST['find1']=="time")
                            <input class="with-gap" id="time" name="find1" type="radio" value="time" checked>
                            @else
                                <input class="with-gap" id="time" name="find1" type="radio" value="time">
                            @endif
                            <span style="color:#000">{{ $lang['8']}}</span>
                        </label>
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-1  gap-4 hidden" id="find2">
                <div class="col-12 px-2 pe-lg-4 mt-0 mt-lg-2 py-2 " >
                    <p class="col px-2">
                    <strong style="color:#000">{{ $lang['5']}}: </strong>
                    </p>
                    <p>
                        <label for="work2" class="work2 px-2">
                            @if(isset($_POST['find2']) && $_POST['find2']=="work2")
                                <input class="with-gap" id="work2" name="find2" type="radio" value="work2" checked>
                            @else
                                <input class="with-gap" id="work2" name="find2" type="radio" value="work2" checked>
                            @endif
                        <span style="color:#000">{{ $lang['6']}}</span>
                        </label>
                        <label for="v0" class="v0 px-2">
                            @if(isset($_POST['find2']) && $_POST['find2']=="v0")
                                <input class="with-gap" id="v0" name="find2" type="radio" value="v0" checked>
                            @else
                                <input class="with-gap" id="v0" name="find2" type="radio" value="v0">
                            @endif
                        <span style="color:#000">{{ $lang['9']}}</span>
                        </label>
                        <label for="v1" class="v1 px-2">
                            @if(isset($_POST['find2']) && $_POST['find2']=="v1")
                                <input class="with-gap" id="v1" name="find2" type="radio" value="v1" checked>
                            @else
                                <input class="with-gap" id="v1" name="find2" type="radio" value="v1">
                            @endif
                        <span class="radio_set" style="color:#000">{{ $lang['11']}}</span>
                        </label>
                        <label for="mass" class="mass px-2">
                            @if(isset($_POST['find2']) && $_POST['find2']=="mass")
                                <input class="with-gap" id="mass" name="find2" type="radio" value="mass" checked>
                            @else
                                <input class="with-gap" id="mass" name="find2" type="radio" value="mass">
                            @endif
                            <span style="color:#000">{{ $lang['10']}}</span>
                        </label>
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2" id="fs">
                    <label for="f" class="font-s-14 text-blue">{{ $lang['2'] }} (F)</label>
                    <div class="relative w-full ">
                        <input type="number" name="f" id="f" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['f'])?$_POST['f']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="f_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('f_unit_dropdown')">{{ isset($_POST['f_unit'])?$_POST['f_unit']:'n' }} ▾</label>
                        <input type="text" name="f_unit" value="{{ isset($_POST['f_unit'])?$_POST['f_unit']:'n' }}" id="f_unit" class="hidden">
                        <div id="f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'n')">N</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'kn')">KN</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'mn')">MN</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'gn')">GN</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('f_unit', 'tn')">TN</p>
                       
                        </div>
                    </div>
                </div>
                <div class="space-y-2" id="ds">
                    <label for="d" class="font-s-14 text-blue">{{ $lang['3'] }} (d)</label>
                    <div class="relative w-full ">
                        <input type="number" name="d" id="d" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['d'])?$_POST['d']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="d_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('d_unit_dropdown')">{{ isset($_POST['d_unit'])?$_POST['d_unit']:'mm' }} ▾</label>
                        <input type="text" name="d_unit" value="{{ isset($_POST['d_unit'])?$_POST['d_unit']:'mm' }}" id="d_unit" class="hidden">
                        <div id="d_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'mm')">mm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'km')">km</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'yd')">yd</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'mi')">mi</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('d_unit', 'nmi')">nmi</p>
                       
                        </div>
                    </div>
                </div>
                <div class="space-y-2 hidden" id="ms">
                    <label for="m" class="font-s-14 text-blue">{{ $lang['10'] }} (m)</label>
                    <div class="relative w-full ">
                        <input type="number" name="m" id="m" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['m'])?$_POST['m']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="m_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('m_unit_dropdown')">{{ isset($_POST['m_unit'])?$_POST['m_unit']:'mg' }} ▾</label>
                        <input type="text" name="m_unit" value="{{ isset($_POST['m_unit'])?$_POST['m_unit']:'mg' }}" id="m_unit" class="hidden">
                        <div id="m_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'mg')">mg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'g')">g</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'kg')">kg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 't')">t</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'oz')">oz</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'lb')">lb</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'stone')">stone</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'us_ton')">US ton</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'long_ton')">Long ton</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 hidden" id="v0s">
                    <label for="v0" class="font-s-14 text-blue">{{ $lang['9'] }} (v₀)</label>
                    <div class="relative w-full ">
                        <input type="number" name="v0" id="v0" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['v0'])?$_POST['v0']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="v0_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('v0_unit_dropdown')">{{ isset($_POST['v0_unit'])?$_POST['v0_unit']:'ms' }} ▾</label>
                        <input type="text" name="v0_unit" value="{{ isset($_POST['v0_unit'])?$_POST['v0_unit']:'ms' }}" id="v0_unit" class="hidden">
                        <div id="v0_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v0_unit', 'ms')">m/s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v0_unit', 'kmh')">km/h</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v0_unit', 'fts')">ft/s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v0_unit', 'mph')">mph</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v0_unit', 'knots')">knots</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v0_unit', 'ftmin')">ft/min</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 hidden" id="v1s">
                    <label for="v1" class="font-s-14 text-blue">{{ $lang['11'] }} (v₁)</label>
                    <div class="relative w-full ">
                        <input type="number" name="v1" id="v1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['v1'])?$_POST['v1']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="v1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('v1_unit_dropdown')">{{ isset($_POST['v1_unit'])?$_POST['v1_unit']:'ms' }} ▾</label>
                        <input type="text" name="v1_unit" value="{{ isset($_POST['v1_unit'])?$_POST['v1_unit']:'ms' }}" id="v1_unit" class="hidden">
                        <div id="v1_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'ms')">m/s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'kmh')">km/h</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'fts')">ft/s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'mph')">mph</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'knots')">knots</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'ftmin')">ft/min</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 hidden" id="ws">
                    <label for="w" class="font-s-14 text-blue">{{ $lang['6'] }} (W)</label>
                    <div class="relative w-full ">
                        <input type="number" name="w" id="w" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['w'])?$_POST['w']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="w_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('w_unit_dropdown')">{{ isset($_POST['w_unit'])?$_POST['w_unit']:'ms' }} ▾</label>
                        <input type="text" name="w_unit" value="{{ isset($_POST['w_unit'])?$_POST['w_unit']:'ms' }}" id="w_unit" class="hidden">
                        <div id="w_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'J')">J</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'kJ')">kJ</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'mJ')">mJ</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'Wh')">Wh</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'kWh')">kWh</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'ft_lbs')">ft-lbs</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'kcal')">kcal</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('w_unit', 'eV')">eV</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 hidden" id="ps">
                    <label for="p" class="font-s-14 text-blue">{{ $lang['7'] }} (P)</label>
                    <div class="relative w-full ">
                        <input type="number" name="p" id="p" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['p'])?$_POST['p']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="p_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('p_unit_dropdown')">{{ isset($_POST['p_unit'])?$_POST['p_unit']:'ms' }} ▾</label>
                        <input type="text" name="p_unit" value="{{ isset($_POST['p_unit'])?$_POST['p_unit']:'ms' }}" id="p_unit" class="hidden">
                        <div id="p_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'mW')">mW</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'W')">W</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'kW')">kW</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'MW')">MW</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'gw')">gw</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'btu_h')">BTU/h</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'hp_l')">hp(l)</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2 hidden" id="ts">
                    <label for="t" class="font-s-14 text-blue">{{ $lang['8'] }} (t)</label>
                    <div class="relative w-full ">
                        <input type="number" name="t" id="t" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['t'])?$_POST['t']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="t_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t_unit_dropdown')">{{ isset($_POST['t_unit'])?$_POST['t_unit']:'ms' }} ▾</label>
                        <input type="text" name="t_unit" value="{{ isset($_POST['t_unit'])?$_POST['t_unit']:'ms' }}" id="t_unit" class="hidden">
                        <div id="t_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'sec')">sec</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'min')">min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'hrs')">hrs</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'days')">days</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'wks')">wks</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'mos')">mos</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t_unit', 'yrs')">yrs</p>
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
                    <div class="w-full radius-10 mt-3">
                        <div class="w-full  mt-2">
                            <table class="w-100 font-s-18">
                               <tr>
                                  <td class="py-2 border-b" width="70%"><strong>
                                    @if(isset($detail['work']) || isset($detail['work1']) || isset($detail['work2']))
                                    {{ $lang['6']}}
                                  @elseif(isset($detail['force']))
                                    {{ $lang['2']}}
                                  @elseif(isset($detail['dsplcmnt']))
                                    {{ $lang['3']}}
                                  @elseif(isset($detail['i_v']))
                                    {{ $lang['9']}}
                                  @elseif(isset($detail['f_v']))
                                    {{ $lang['11']}}
                                  @elseif(isset($detail['mass']))
                                    {{ $lang['10']}}
                                  @elseif(isset($detail['power']))
                                    {{ $lang['7']}}
                                  @elseif(isset($detail['time']))
                                    {{ $lang['8']}}
                                  @endif
                                 </strong></td>
                                   <td class="py-2 border-b"> 
                                    @if(isset($detail['work']) || isset($detail['work1']) || isset($detail['work2']))
                                    {{  $detail['w']}}  J
                                    @elseif(isset($detail['force']))
                                        {{  $detail['f']}}  N
                                    @elseif(isset($detail['dsplcmnt']))
                                        {{  $detail['d']}}  m
                                    @elseif(isset($detail['i_v']))
                                        {{ $detail['v0']}}  m/s
                                    @elseif(isset($detail['f_v']))
                                        {{ $detail['v1']}}  m/s
                                    @elseif(isset($detail['mass']))
                                        {{ $detail['m']}}  kg
                                    @elseif(isset($detail['power']))
                                        {{  $detail['p']}}  W
                                    @elseif(isset($detail['time']))
                                        {{  $detail['t']}}  sec
                                    @endif
                                   </td>
                               </tr>
                            </table>
                      </div>
                        <div class="w-full">
                            <div class="mt-2">
                                <p class="mt-2">{{ $lang['12']}}:</p>
                                @if(isset($detail['work']))
                                <p class="mt-2"><strong>{{ $lang['13']}}</strong></p>
                                <p class="mt-2">W = F * D</p>
                                <p class="mt-2"><strong>{{ $lang['14']}}</strong></p>
                                <p class="mt-2">F = {{ $detail['f']}}, D = {{ $detail['d']}}, W = ?</p>
                                <p class="mt-2"><strong>{{ $lang['15']}}</strong></p>
                                <p class="mt-2">W = F * D</p>
                                <p class="mt-2">W = {{ $detail['f']}} * {{ $detail['d']}}</p>
                                <p class="mt-2">W = <strong>{{ $detail['w']}}</strong></p>
                               @elseif(isset($detail['force']))
                                <p class="mt-2"><strong>{{ $lang['13']}}</strong></p>
                                <p class="mt-2">F = W / D</p>
                                <p class="mt-2"><strong>{{ $lang['14']}}</strong></p>
                                <p class="mt-2">W = {{ $detail['w']}}, D = {{ $detail['d']}}, F = ?</p>
                                <p class="mt-2"><strong>{{ $lang['15']}}</strong></p>
                                <p class="mt-2">F = W / D</p>
                                <p class="mt-2">F = {{ $detail['w']}} / {{ $detail['d']}}</p>
                                <p class="mt-2">F = <strong>{{ $detail['f']}}</strong></p>
                               @elseif(isset($detail['dsplcmnt']))
                                <p class="mt-2"><strong>{{ $lang['13']}}</strong></p>
                                <p class="mt-2">D = W / F</p>
                                <p class="mt-2"><strong>{{ $lang['14']}}</strong></p>
                                <p class="mt-2">W = {{ $detail['w']}}, F = {{ $detail['f']}}, D = ?</p>
                                <p class="mt-2"><strong>{{ $lang['15']}}</strong></p>
                                <p class="mt-2">D = W / F</p>
                                <p class="mt-2">D = {{ $detail['w']}} / {{ $detail['f']}}</p>
                                <p class="mt-2">D = <strong>{{ $detail['d']}}</strong></p>
                               @elseif(isset($detail['work1']))
                                <p class="mt-2"><strong>{{ $lang['13']}}</strong></p>
                                <p class="mt-2">W = (m/2) * (v₁² - v₀²)</p>
                                <p class="mt-2"><strong>{{ $lang['14']}}</strong></p>
                                <p class="mt-2">m = {{ $detail['f']}}, v₀ = {{ $detail['v0']}}, v₁ = {{ $detail['v1']}}, W = ?</p>
                                <p class="mt-2"><strong>{{ $lang['15']}}</strong></p>
                                <p class="mt-2">W = (m/2) * (v₁² - v₀²)</p>
                                <p class="mt-2">W = ({{ $detail['m']}}> / 2) * (({{ $detail['v1']}})² - ({{ $detail['v0']}})²)</p>
                                <p class="mt-2">W = ({{ $detail['s1']}}) * ({{ $detail['s2']}} - {{ $detail['s3']}})</p>
                                <p class="mt-2">W = ({{ $detail['s1']}}) * ({{ $detail['s4']}})</p>
                                <p class="mt-2">W = <strong>{{ $detail['w']}}</strong></p>
                               @elseif(isset($detail['i_v']))
                                <p class="mt-2"><strong>{{ $lang['13']}}</strong></p>
                                <p class="mt-2">v₀ = v₁² - ((2/m) * w)</p>
                                <p class="mt-2"><strong>{{ $lang['14']}}</strong></p>
                                <p class="mt-2">w = {{ $detail['w']}}, m = {{ $detail['m']}}, v₁ = {{ $detail['v1']}}, v₀ = ?</p>
                                <p class="mt-2"><strong>{{ $lang['15']}}</strong></p>
                                <p class="mt-2">v₀ = &radic;<span class="b_t">v₁² - ((2/m) * w)</span></p>
                                <p class="mt-2">v₀ = &radic;<span class="b_t">({{ $detail['v1']}})² - ((2/{{ $detail['m']}}) * {{ $detail['w']}})</span></p>
                                <p class="mt-2">v₀ = &radic;<span class="b_t">({{ $detail['s1']}}) - ({{ $detail['s2']}}> * {{ $detail['w']}})</span></p>
                                <p class="mt-2">v₀ = &radic;<span class="b_t">{{ $detail['s1']}}> - {{ $detail['s3']}}</span></p>
                                <p class="mt-2">v₀ = &radic;<span class="b_t">{{ $detail['s4']}}</span></p>
                                <p class="mt-2">v₀ = <strong>{{ $detail['v0']}}</strong></p>
                               @elseif(isset($detail['f_v']))
                                <p class="mt-2"><strong>{{ $lang['13']}}</strong></p>
                                <p class="mt-2">v₁ = v₀² + ((2/m) * w)</p>
                                <p class="mt-2"><strong>{{ $lang['14']}}</strong></p>
                                <p class="mt-2">w = {{ $detail['w']}}, m = {{ $detail['m']}}, v₀ = {{ $detail['v0']}}, v₁ = ?</p>
                                <p class="mt-2"><strong>{{ $lang['15']}}</strong></p>
                                <p class="mt-2">v₁ = &radic;<span class="b_t">v₀² + ((2/m) * w)</span></p>
                                <p class="mt-2">v₁ = &radic;<span class="b_t">({{ $detail['v0']}})² + ((2/{{ $detail['m']}}) * {{ $detail['w']}})</span></p>
                                <p class="mt-2">v₁ = &radic;<span class="b_t">({{ $detail['s1']}}) + ({{ $detail['s2']}}> * {{ $detail['w']}})</span></p>
                                <p class="mt-2">v₁ = &radic;<span class="b_t">{{ $detail['s1']}}> + {{ $detail['s3']}}</span></p>
                                <p class="mt-2">v₁ = &radic;<span class="b_t">{{ $detail['s4']}}</span></p>
                                <p class="mt-2">v₁ = <strong>{{ $detail['v1']}}</strong></p>
                               @elseif(isset($detail['mass']))
                                <p class="mt-2"><strong>{{ $lang['13']}}</strong></p>
                                <p class="mt-2">m = 2w / (v₁² - v₀²)</p>
                                <p class="mt-2"><strong>{{ $lang['14']}}</strong></p>
                                <p class="mt-2">w = {{ $detail['w']}}, v₀ = {{ $detail['v0']}}, v₁ = {{ $detail['v1']}}, m = ?</p>
                                <p class="mt-2"><strong>{{ $lang['15']}}</strong></p>
                                <p class="mt-2">m = 2w / (v₁² - v₀²)</p>
                                <p class="mt-2">m = (2*{{ $detail['w']}}) / (({{ $detail['v1']}})² - ({{ $detail['v0']}})²)</p>
                                <p class="mt-2">m = {{ $detail['s1']}} / ({{ $detail['s2']}} - {{ $detail['s3']}})</p>
                                <p class="mt-2">m = {{ $detail['s1']}} / {{ $detail['s4']}}</p>
                                <p class="mt-2">m = <strong>{{ $detail['m']}}</strong></p>
                               @elseif(isset($detail['power']))
                                <p class="mt-2"><strong>{{ $lang['13']}}</strong></p>
                                <p class="mt-2">P = W / T</p>
                                <p class="mt-2"><strong>{{ $lang['14']}}</strong></p>
                                <p class="mt-2">W = {{ $detail['w']}}, T = {{ $detail['t']}}, P = ?</p>
                                <p class="mt-2"><strong>{{ $lang['15']}}</strong></p>
                                <p class="mt-2">P = W / T</p>
                                <p class="mt-2">P = {{ $detail['w']}} / {{ $detail['t']}}</p>
                                <p class="mt-2">P = <strong>{{ $detail['p']}}</strong></p>
                               @elseif(isset($detail['work2']))
                                <p class="mt-2"><strong>{{ $lang['13']}}</strong></p>
                                <p class="mt-2">W = P * T</p>
                                <p class="mt-2"><strong>{{ $lang['14']}}</strong></p>
                                <p class="mt-2">P = {{ $detail['p']}}, T = {{ $detail['t']}}, W = ?</p>
                                <p class="mt-2"><strong>{{ $lang['15']}}</strong></p>
                                <p class="mt-2">W = P * T</p>
                                <p class="mt-2">W = {{ $detail['p']}}> * {{ $detail['t']}}</p>
                                <p class="mt-2">W = <strong>{{ $detail['w']}}</strong></p>
                               @elseif(isset($detail['time']))
                                <p class="mt-2"><strong>{{ $lang['13']}}</strong></p>
                                <p class="mt-2">T = W / P</p>
                                <p class="mt-2"><strong>{{ $lang['14']}}</strong></p>
                                <p class="mt-2">W = {{ $detail['w']}}, P = {{ $detail['p']}}, T = ?</p>
                                <p class="mt-2"><strong>{{ $lang['15']}}</strong></p>
                                <p class="mt-2">T = W / P</p>
                                <p class="mt-2">T = {{ $detail['w']}} / {{ $detail['p']}}</p>
                                <p class="mt-2">T = <strong>{{ $detail['t']}}</strong></p>
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
        function showHideElements(showSelectors, hideSelectors) {
            showSelectors.forEach(selector => {
                document.querySelector(selector).style.display = 'block';
            });
            hideSelectors.forEach(selector => {
                document.querySelector(selector).style.display = 'none';
            });
        }
        document.querySelectorAll('.work').forEach(el => {
            el.addEventListener("click", function() {
                showHideElements(['#fs', '#ds'], ['#ws', '#ps', '#ts', '#v0s', '#v1s', '#ms']);
            });
        });
        document.querySelectorAll('.force').forEach(el => {
            el.addEventListener("click", function() {
                showHideElements(['#ws', '#ds'], ['#fs', '#ps', '#ts', '#v0s', '#v1s', '#ms']);
            });
        });
        document.querySelectorAll('.dsplcmnt').forEach(el => {
            el.addEventListener("click", function() {
                showHideElements(['#fs', '#ws'], ['#ds', '#ps', '#ts', '#v0s', '#v1s', '#ms']);
            });
        });
        document.querySelectorAll('.power').forEach(el => {
            el.addEventListener("click", function() {
                showHideElements(['#ws', '#ts'], ['#fs', '#ps', '#ds', '#v0s', '#v1s', '#ms']);
            });
        });
        document.querySelectorAll('.work1').forEach(el => {
            el.addEventListener("click", function() {
                showHideElements(['#ps', '#ts'], ['#fs', '#ws', '#ds', '#v0s', '#v1s', '#ms']);
            });
        });
        document.querySelectorAll('.time').forEach(el => {
            el.addEventListener("click", function() {
                showHideElements(['#ps', '#ws'], ['#ds', '#fs', '#ts', '#v0s', '#v1s', '#ms']);
            });
        });
        document.querySelectorAll('.work2').forEach(el => {
            el.addEventListener("click", function() {
                showHideElements(['#ms', '#v0s', '#v1s'], ['#fs', '#ds', '#ws', '#ps', '#ts']);
            });
        });
        document.querySelectorAll('.v0').forEach(el => {
            el.addEventListener("click", function() {
                showHideElements(['#ms', '#ws', '#v1s'], ['#fs', '#v0s', '#ds', '#ps', '#ts']);
            });
        });
        document.querySelectorAll('.v1').forEach(el => {
            el.addEventListener("click", function() {
                showHideElements(['#ms', '#v0s', '#ws'], ['#fs', '#v1s', '#ds', '#ps', '#ts']);
            });
        });
        document.querySelectorAll('.mass').forEach(el => {
            el.addEventListener("click", function() {
                showHideElements(['#ws', '#v0s', '#v1s'], ['#fs', '#ms', '#ds', '#ps', '#ts']);
            });
        });


    document.getElementById('method1').addEventListener('change', function() {
        if (this.value === 'fnd') {
            document.querySelectorAll('.method1, #find').forEach(function(element) {
                element.style.display = 'block';
            });
            document.querySelectorAll('#find1, #find2').forEach(function(element) {
                element.style.display = 'none';
            });

            let findValue = document.querySelector('input[name="find"]:checked').value;
            if (findValue === 'work') {
                document.querySelectorAll('#fs, #ds').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('#ws, #ps, #ts, #v0s, #v1s, #ms').forEach(function(element) {
                    element.style.display = 'none';
                });
            } else if (findValue === 'force') {
                document.querySelectorAll('#ws, #ds').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('#fs, #ps, #ts, #v0s, #v1s, #ms').forEach(function(element) {
                    element.style.display = 'none';
                });
            } else if (findValue === 'dsplcmnt') {
                document.querySelectorAll('#fs, #ws').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('#ds, #ps, #ts, #v0s, #v1s, #ms').forEach(function(element) {
                    element.style.display = 'none';
                });
            }
        } else if (this.value === 'velocity') {
            document.querySelectorAll('.method1, #find2, #ms, #v0s, #v1s').forEach(function(element) {
                element.style.display = 'block';
            });
            document.querySelectorAll('#find, #find1, #fs, #ds, #ws, #ps, #ts').forEach(function(element) {
                element.style.display = 'none';
            });

            let find2Value = document.querySelector('input[name="find2"]:checked').value;
            if (find2Value === 'work2') {
                document.querySelectorAll('#ms, #v0s, #v1s').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('#fs, #ds, #ws, #ps, #ts').forEach(function(element) {
                    element.style.display = 'none';
                });
            } else if (find2Value === 'v0') {
                document.querySelectorAll('#ms, #ws, #v1s').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('#fs, #v0s, #ds, #ps, #ts').forEach(function(element) {
                    element.style.display = 'none';
                });
            } else if (find2Value === 'v1') {
                document.querySelectorAll('#ms, #v0s, #ws').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('#fs, #v1s, #ds, #ps, #ts').forEach(function(element) {
                    element.style.display = 'none';
                });
            } else if (find2Value === 'mass') {
                document.querySelectorAll('#ws, #v0s, #v1s').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('#fs, #ms, #ds, #ps, #ts').forEach(function(element) {
                    element.style.display = 'none';
                });
            }
        }
    });
    @if(isset($detail) || isset($error))
    var type = "{{$_POST['method1']}}";
     if (type === 'fnd') {
            document.querySelectorAll('.method1, #find').forEach(function(element) {
                element.style.display = 'block';
            });
            document.querySelectorAll('#find1, #find2').forEach(function(element) {
                element.style.display = 'none';
            });

            let findValue = document.querySelector('input[name="find"]:checked').value;
            if (findValue === 'work') {
                document.querySelectorAll('#fs, #ds').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('#ws, #ps, #ts, #v0s, #v1s, #ms').forEach(function(element) {
                    element.style.display = 'none';
                });
            } else if (findValue === 'force') {
                document.querySelectorAll('#ws, #ds').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('#fs, #ps, #ts, #v0s, #v1s, #ms').forEach(function(element) {
                    element.style.display = 'none';
                });
            } else if (findValue === 'dsplcmnt') {
                document.querySelectorAll('#fs, #ws').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('#ds, #ps, #ts, #v0s, #v1s, #ms').forEach(function(element) {
                    element.style.display = 'none';
                });
            }
    } else if (type === 'velocity') {
            document.querySelectorAll('.method1, #find2, #ms, #v0s, #v1s').forEach(function(element) {
                element.style.display = 'block';
            });
            document.querySelectorAll('#find, #find1, #fs, #ds, #ws, #ps, #ts').forEach(function(element) {
                element.style.display = 'none';
            });

            let find2Value = document.querySelector('input[name="find2"]:checked').value;
            if (find2Value === 'work2') {
                document.querySelectorAll('#ms, #v0s, #v1s').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('#fs, #ds, #ws, #ps, #ts').forEach(function(element) {
                    element.style.display = 'none';
                });
            } else if (find2Value === 'v0') {
                document.querySelectorAll('#ms, #ws, #v1s').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('#fs, #v0s, #ds, #ps, #ts').forEach(function(element) {
                    element.style.display = 'none';
                });
            } else if (find2Value === 'v1') {
                document.querySelectorAll('#ms, #v0s, #ws').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('#fs, #v1s, #ds, #ps, #ts').forEach(function(element) {
                    element.style.display = 'none';
                });
            } else if (find2Value === 'mass') {
                document.querySelectorAll('#ws, #v0s, #v1s').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.querySelectorAll('#fs, #ms, #ds, #ps, #ts').forEach(function(element) {
                    element.style.display = 'none';
                });
            }
        }
    @endif

    document.getElementById('method').addEventListener("change", function() {
        const methodValue = this.value;
        const method1Value = document.getElementById('method1').value;
        const findValue = document.querySelector('input[name="find"]:checked')?.value;
        const find2Value = document.querySelector('input[name="find2"]:checked')?.value;
        const find1Value = document.querySelector('input[name="find1"]:checked')?.value;
        // Hide all elements initially
        const elementsToHide = ['#fs', '#ds', '#ws', '#ps', '#ts', '#v0s', '#v1s', '#ms', '#find', '#find1', '#find2', '.method1'];
        elementsToHide.forEach(selector => document.querySelectorAll(selector).forEach(el => el.style.display = 'none'));
        if (methodValue === 'work') {
            if (method1Value === 'fnd') {
                document.querySelectorAll('.method1, #find').forEach(el => el.style.display = 'block');
                if (findValue === 'work') {
                    document.getElementById('fs').style.display = 'block';
                    document.getElementById('ds').style.display = 'block';
                } else if (findValue === 'force') {
                    document.getElementById('ws').style.display = 'block';
                    document.getElementById('ds').style.display = 'block';
                } else if (findValue === 'dsplcmnt') {
                    document.getElementById('fs').style.display = 'block';
                    document.getElementById('ws').style.display = 'block';
                }
            } else if (method1Value === 'velocity') {
                document.querySelectorAll('.method1, #find2').forEach(el => el.style.display = 'block');
                if (find2Value === 'work2') {
                    document.getElementById('ms').style.display = 'block';
                    document.getElementById('v0s').style.display = 'block';
                    document.getElementById('v1s').style.display = 'block';
                } else if (find2Value === 'v0') {
                    document.getElementById('ms').style.display = 'block';
                    document.getElementById('ws').style.display = 'block';
                    document.getElementById('v1s').style.display = 'block';
                } else if (find2Value === 'v1') {
                    document.getElementById('ms').style.display = 'block';
                    document.getElementById('v0s').style.display = 'block';
                    document.getElementById('ws').style.display = 'block';
                } else if (find2Value === 'mass') {
                    document.getElementById('ws').style.display = 'block';
                    document.getElementById('v0s').style.display = 'block';
                    document.getElementById('v1s').style.display = 'block';
                }
            }
        } else if (methodValue === 'power') {
            document.getElementById('find1').style.display = 'block';
            if (find1Value === 'power') {
                document.getElementById('ws').style.display = 'block';
                document.getElementById('ts').style.display = 'block';
            } else if (find1Value === 'work1') {
                document.getElementById('ps').style.display = 'block';
                document.getElementById('ts').style.display = 'block';
            } else if (find1Value === 'time') {
                document.getElementById('ps').style.display = 'block';
                document.getElementById('ws').style.display = 'block';
            }
        }
    });

    @if(isset($detail) || isset($error))
    var type = "{{$_POST['method']}}";
        const method1Value = document.getElementById('method1').value;
        const findValue = document.querySelector('input[name="find"]:checked')?.value;
        const find2Value = document.querySelector('input[name="find2"]:checked')?.value;
        const find1Value = document.querySelector('input[name="find1"]:checked')?.value;
        // Hide all elements initially
        const elementsToHide = ['#fs', '#ds', '#ws', '#ps', '#ts', '#v0s', '#v1s', '#ms', '#find', '#find1', '#find2', '.method1'];
        elementsToHide.forEach(selector => document.querySelectorAll(selector).forEach(el => el.style.display = 'none'));
        if (type === 'work') {
            if (method1Value === 'fnd') {
                document.querySelectorAll('.method1, #find').forEach(el => el.style.display = 'block');
                if (findValue === 'work') {
                    document.getElementById('fs').style.display = 'block';
                    document.getElementById('ds').style.display = 'block';
                } else if (findValue === 'force') {
                    document.getElementById('ws').style.display = 'block';
                    document.getElementById('ds').style.display = 'block';
                } else if (findValue === 'dsplcmnt') {
                    document.getElementById('fs').style.display = 'block';
                    document.getElementById('ws').style.display = 'block';
                }
            } else if (method1Value === 'velocity') {
                document.querySelectorAll('.method1, #find2').forEach(el => el.style.display = 'block');
                if (find2Value === 'work2') {
                    document.getElementById('ms').style.display = 'block';
                    document.getElementById('v0s').style.display = 'block';
                    document.getElementById('v1s').style.display = 'block';
                } else if (find2Value === 'v0') {
                    document.getElementById('ms').style.display = 'block';
                    document.getElementById('ws').style.display = 'block';
                    document.getElementById('v1s').style.display = 'block';
                } else if (find2Value === 'v1') {
                    document.getElementById('ms').style.display = 'block';
                    document.getElementById('v0s').style.display = 'block';
                    document.getElementById('ws').style.display = 'block';
                } else if (find2Value === 'mass') {
                    document.getElementById('ws').style.display = 'block';
                    document.getElementById('v0s').style.display = 'block';
                    document.getElementById('v1s').style.display = 'block';
                }
            }
        } else if (type === 'power') {
            document.getElementById('find1').style.display = 'block';
            if (find1Value === 'power') {
                document.getElementById('ws').style.display = 'block';
                document.getElementById('ts').style.display = 'block';
            } else if (find1Value === 'work1') {
                document.getElementById('ps').style.display = 'block';
                document.getElementById('ts').style.display = 'block';
            } else if (find1Value === 'time') {
                document.getElementById('ps').style.display = 'block';
                document.getElementById('ws').style.display = 'block';
            }
        }

    @endif

</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>