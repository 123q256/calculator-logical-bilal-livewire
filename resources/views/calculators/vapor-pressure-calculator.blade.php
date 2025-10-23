<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="w-full  mb-2">
                <p><strong class="text-blue">{!! $lang['1'] !!}</strong></p>
            </div>
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="t1" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="t1" id="t1" step="any" min="0" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['t1'])?$_POST['t1']:'298' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="t1_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t1_units_dropdown')">{{ isset($_POST['t1_units'])?$_POST['t1_units']:'°C' }} ▾</label>
                        <input type="text" name="t1_units" value="{{ isset($_POST['t1_units'])?$_POST['t1_units']:'°C' }}" id="t1_units" class="hidden">
                        <div id="t1_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1_units', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1_units', '°F')">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1_units', 'k')">k</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1_units', '°R')">°R</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1_units', '°De')">°De</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1_units', '°N')">°N</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1_units', '°Ré')">°Ré</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t1_units', '°Rø')">°Rø</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="t2" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="t2" id="t2" step="any" min="0" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['t2'])?$_POST['t2']:'298' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="t2_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('t2_units_dropdown')">{{ isset($_POST['t2_units'])?$_POST['t2_units']:'°C' }} ▾</label>
                        <input type="text" name="t2_units" value="{{ isset($_POST['t2_units'])?$_POST['t2_units']:'°C' }}" id="t2_units" class="hidden">
                        <div id="t2_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t2_units', '°C')">°C</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t2_units', '°F')">°F</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t2_units', 'k')">k</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t2_units', '°R')">°R</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t2_units', '°De')">°De</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t2_units', '°N')">°N</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t2_units', '°Ré')">°Ré</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('t2_units', '°Rø')">°Rø</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="p1" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="p1" id="p1" step="any" min="0" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['p1'])?$_POST['p1']:'298' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="p1_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('p1_units_dropdown')">{{ isset($_POST['p1_units'])?$_POST['p1_units']:'Pa' }} ▾</label>
                        <input type="text" name="p1_units" value="{{ isset($_POST['p1_units'])?$_POST['p1_units']:'Pa' }}" id="p1_units" class="hidden">
                        <div id="p1_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_units', 'Pa')">Pa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_units', 'Bar')">Bar</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_units', 'psi')">psi</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_units', 'at')">at</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_units', 'atm')">atm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_units', 'Torr')">Torr</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_units', 'hPa')">hPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_units', 'kPa')">kPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_units', 'MPa')">MPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p1_units', 'GPa')">GPa</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="deltaHvap" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="deltaHvap" id="deltaHvap" step="any" min="0" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['deltaHvap'])?$_POST['deltaHvap']:'40000' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="deltaHvap_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('deltaHvap_units_dropdown')">{{ isset($_POST['deltaHvap_units'])?$_POST['deltaHvap_units']:'J' }} ▾</label>
                        <input type="text" name="deltaHvap_units" value="{{ isset($_POST['deltaHvap_units'])?$_POST['deltaHvap_units']:'J' }}" id="deltaHvap_units" class="hidden">
                        <div id="deltaHvap_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('deltaHvap_units', 'J')">J</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('deltaHvap_units', 'KJ')">KJ</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('deltaHvap_units', 'MJ')">MJ</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('deltaHvap_units', 'Wh')">Wh</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('deltaHvap_units', 'KWh')">KWh</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('deltaHvap_units', 'ft-lb')">ft-lb</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('deltaHvap_units', 'kcal')">kcal</p>
                        </div>
                    </div>
                </div>
            </div>
                <div class="w-full  mt-1 mb-2">
                    <p><strong class="text-blue">{!! $lang['6'] !!}</strong></p>
                </div>
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="x_sol" class="font-s-14 text-blue">{!! $lang['7'] !!}:</label>
                        <input type="number" step="any" name="x_sol" id="x_sol" class="input" min="0" aria-label="input" placeholder="00" value="{{ isset(request()->x_sol)?request()->x_sol:'0.98' }}" />
                </div>
                <div class="space-y-2">
                    <label for="p_sol" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="p_sol" id="p_sol" step="any" min="0" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['p_sol'])?$_POST['p_sol']:'47.1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="p_sol_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('p_sol_units_dropdown')">{{ isset($_POST['p_sol_units'])?$_POST['p_sol_units']:'Pa' }} ▾</label>
                        <input type="text" name="p_sol_units" value="{{ isset($_POST['p_sol_units'])?$_POST['p_sol_units']:'Pa' }}" id="p_sol_units" class="hidden">
                        <div id="p_sol_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'Pa')">Pa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'Bar')">Bar</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'psi')">psi</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'at')">at</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'atm')">atm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'Torr')">Torr</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'hPa')">hPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'kPa')">kPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'MPa')">MPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'GPa')">GPa</p>
                        </div>
                    </div>
                </div>  <div class="space-y-2">
                    <label for="p_sol" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="p_sol" id="p_sol" step="any" min="0" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['p_sol'])?$_POST['p_sol']:'47.1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="p_sol_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('p_sol_units_dropdown')">{{ isset($_POST['p_sol_units'])?$_POST['p_sol_units']:'cm' }} ▾</label>
                        <input type="text" name="p_sol_units" value="{{ isset($_POST['p_sol_units'])?$_POST['p_sol_units']:'cm' }}" id="p_sol_units" class="hidden">
                        <div id="p_sol_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'Pa')">Pa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'Bar')">Bar</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'psi')">psi</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'at')">at</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'atm')">atm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'Torr')">Torr</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'hPa')">hPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'kPa')">kPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'MPa')">MPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_sol_units', 'GPa')">GPa</p>
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
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full  rounded-lg mt-3">
                        <div class="w-full">
                            <!-- Section 1 -->
                            <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2">
                                <strong>{!! $lang['9'] !!} =</strong>
                                <strong class="text-[#119154] text-2xl">{!! round($detail['p2'], 3) !!}</strong>
                            </div>
                            <p class="mt-3"><strong>{!! $lang['11'] !!}</strong></p>
                            <div class="flex justify-between overflow-auto gap-4">
                                <div class="mt-3 text-center">
                                    <p><strong>bar</strong></p>
                                    <p>{!! round($detail['p2'] * 0.00001, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>psi</strong></p>
                                    <p>{!! round($detail['p2'] * 0.00014504, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>at</strong></p>
                                    <p>{!! round($detail['p2'] * 0.000010197, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>atm</strong></p>
                                    <p>{!! round($detail['p2'] * 0.00000987, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>torr</strong></p>
                                    <p>{!! round($detail['p2'] * 0.0075, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>hpa</strong></p>
                                    <p>{!! round($detail['p2'] * 0.01, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>kpa</strong></p>
                                    <p>{!! round($detail['p2'] * 0.001, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>Mpa</strong></p>
                                    <p>{!! round($detail['p2'] * 0.000001, 4) !!}</p>
                                </div>
                            </div>
                
                            <!-- Section 2 -->
                            <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2 mt-3">
                                <strong>{!! $lang['10'] !!} =</strong>
                                <strong class="text-[#119154] text-2xl">{!! round($detail['xsolvent'], 3) !!}</strong>
                            </div>
                            <p class="mt-3"><strong>{!! $lang['11'] !!}</strong></p>
                            <div class="flex justify-between overflow-auto gap-4">
                                <div class="mt-3 text-center">
                                    <p><strong>bar</strong></p>
                                    <p>{!! round($detail['xsolvent'] * 0.00001, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>psi</strong></p>
                                    <p>{!! round($detail['xsolvent'] * 0.00014504, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>at</strong></p>
                                    <p>{!! round($detail['xsolvent'] * 0.000010197, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>atm</strong></p>
                                    <p>{!! round($detail['xsolvent'] * 0.00000987, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>torr</strong></p>
                                    <p>{!! round($detail['xsolvent'] * 0.0075, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>hpa</strong></p>
                                    <p>{!! round($detail['xsolvent'] * 0.01, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>kpa</strong></p>
                                    <p>{!! round($detail['xsolvent'] * 0.001, 5) !!}</p>
                                </div>
                                <div class="border-r border-gray-300 pr-4">&nbsp;</div>
                                <div class="mt-3 text-center">
                                    <p><strong>Mpa</strong></p>
                                    <p>{!! round($detail['xsolvent'] * 0.000001, 4) !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    @endisset
</form>