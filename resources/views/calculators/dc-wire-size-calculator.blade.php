<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="w-full mx-auto mt-2  lg:w-[80%] md:w-[80%]">
            <input type="hidden" name="wire" id="wire" value="{{ isset($_POST['wire'])?$_POST['wire']:'wire_size' }}">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/3 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial" id="wire_size">
                            {{ $lang['1'] }}
                    </div>
                </div>
                <div class="lg:w-1/3 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric" id="wire_diameter">
                            {{ $lang['2'] }}
                    </div>
                </div>
                <div class="lg:w-1/3 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric" id="wire_gauge">
                            {{ $lang['3'] }}
                    </div>
                </div>
            </div>
      </div>
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 gap-4">
            <div class="wire_size col-span-12">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="myselection" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <select name="type" id="myselection" class="input">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                        {!! $arr2[$index] !!}
                                    </option>
                                @php
                                    }}
                                    $name = [$lang['36'], $lang['37']];
									$val = ["single_phase","three_phase"];
                                    optionsList($val,$name,isset($_POST['type'])?$_POST['type']:'single_phase');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="s_voltage" class="font-s-14 text-blue"><?= $lang[5] ?>:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="s_voltage" id="s_voltage" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['s_voltage']) ? $_POST['s_voltage'] : '120' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
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
                        <label for="voltage_drop" class="font-s-14 text-blue"><?= $lang[6] ?>:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" type="any" name="voltage_drop" id="voltage_drop" class="input" value="{{ isset($_POST['voltage_drop'])?$_POST['voltage_drop']:'3' }}" aria-label="input" placeholder="00" />
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="c_units" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <select name="c_units" id="c_units" class="input">
                                @php
                                    $name = [$lang['38'], $lang['39'],$lang['40'],$lang['41'],$lang['42'],$lang['43']];
									$val = ["copper","aluminum","gold","silver","nickel","steel"];
                                    optionsList($val,$name,isset($_POST['c_units'])?$_POST['c_units']:'copper');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="current" class="font-s-14 text-blue"><?= $lang[8] ?>:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="current" id="current" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['current']) ? $_POST['current'] : '25' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="current_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('current_unit_dropdown')">{{ isset($_POST['current_unit'])?$_POST['current_unit']:'mV' }} ▾</label>
                            <input type="text" name="current_unit" value="{{ isset($_POST['current_unit'])?$_POST['current_unit']:'mV' }}" id="current_unit" class="hidden">
                            <div id="current_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="current_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('current_unit', 'A')">A</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('current_unit', 'mA')">mA</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('current_unit', 'µA')">µA</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="wire_length" class="font-s-14 text-blue"><?= $lang[9] ?>:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="wire_length" id="wire_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wire_length']) ? $_POST['wire_length'] : '25' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
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
                        <label for="w_temp" class="font-s-14 text-blue"><?= $lang[10] ?>:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="w_temp" id="w_temp" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['w_temp']) ? $_POST['w_temp'] : '25' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="wt_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wt_units_dropdown')">{{ isset($_POST['wt_units'])?$_POST['wt_units']:'°C' }} ▾</label>
                            <input type="text" name="wt_units" value="{{ isset($_POST['wt_units'])?$_POST['wt_units']:'°C' }}" id="wt_units" class="hidden">
                            <div id="wt_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wt_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wt_units', '°C')">°C</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wt_units', '°F')">°F</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wt_units', 'K')">K</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wire_diameter hidden col-span-12">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <label for="formula_change" class="font-s-14 text-blue">{{ $lang['11'] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <select name="wire_gauge" id="formula_change" class="input">
                                @php
                                    $name = ["2000 kcmil", "1750 kcmil", "1500 kcmil","1250 kcmil","1000 kcmil","900 kcmil","800 kcmil","750 kcmil","700 kcmil","600 kcmil","500 kcmil","400 kcmil","350 kcmil","300 kcmil","250 kcmil","0000 (4/0) AWG","000 (3/0) AWG","00 (2/0) AWG","0 (1/0) AWG","1 AWG","2 AWG","3 AWG","4 AWG","5 AWG","6 AWG","7 AWG","8 AWG","9 AWG","10 AWG","11 AWG","12 AWG","13 AWG","14 AWG","15 AWG","16 AWG","17 AWG","18 AWG","19 AWG","20 AWG","21 AWG","22 AWG","23 AWG","24 AWG","25 AWG","26 AWG","27 AWG","28 AWG","29 AWG","30 AWG","31 AWG","32 AWG","33 AWG","34 AWG","35 AWG","36 AWG","37 AWG","38 AWG","39 AWG","40 AWG"];
									$val = ["2000-kcmil", "1750-kcmil", "1500-kcmil","1250-kcmil", "1000-kcmil", "900-kcmil","800-kcmil", "750-kcmil", "700-kcmil", "600-kcmil","500-kcmil", "400-kcmil", "350-kcmil","300-kcmil", "250-kcmil",
									 "0000 (4/0)","000 (3/0)","00 (2/0)","0 (1/0)","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","37","38","39","40"];
                                    optionsList($val,$name,isset($_POST['wire_gauge'])?$_POST['wire_gauge']:'3');
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wire_gauge hidden col-span-12">
                <div class="grid grid-cols-12 gap-4">
                                    
                    <div class="col-span-12">
                        <label for="wire_diameter1" class="font-s-14 text-blue"><?= $lang[12] ?>:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="wire_diameter1" id="wire_diameter1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wire_diameter1']) ? $_POST['wire_diameter1'] : '5.771' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
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

            

    @isset($detail)
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="row">
                            <?php if ($detail['submit'] == 'wire_size') { ?>
                                <?php if ($detail['type'] == 'single_phase') {
                                    $res = round($detail['single_phase'], 2); ?>
                                    <div class="col-lg-6 mt-2">
                                        <table class="w-full font-s-18">
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang['13'] }}</td>
                                                <td class="py-2 border-b"><strong class="text-blue"><?= $detail['s_data'][1] ?> <?= $lang[14] ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang['15'] }}</td>
                                                <td class="py-2 border-b"><strong class="text-blue"><?= round($detail['single_phase'], 2) ?> mm<sup class="text-blue">2</sup></strong></td>
                                            </tr>
                                        </table>
                                    </div>
                
                                    <p class="col-12 my-3 text-[18px]"><?= $lang[16] ?></p>
                                    <div class="col-12 overflow-auto">
                                        <table class="w-full" style="border-collapse: collapse">
                                            <thead>
                                                <tr class="bg-[#F6FAFC]">
                                                    <td class="p-2 border text-center"><strong class="text-blue"><?= $lang[17] ?></strong></td>
                                                    <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['18'] ?></strong></td>
                                                    <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['19'] ?></strong></td>
                                                    <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['20'] ?></strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="bg-[#F6FAFC]">
                                                    <td class="text-center p-2 border"><?= $res * 0.000001 ?>m²</td>
                                                    <td class="text-center p-2 border"><?= round($res * 0.00155, 5) ?>in²</td>
                                                    <td class="text-center p-2 border"><?= round($res * 1973.6, 4) ?>cmil</td>
                                                    <td class="text-center p-2 border"><?= round($res * 1.9736, 2) ?>kcmil</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="w-full mt-3 text-[18px]"> <?= $lang[21] ?></p>
                                    <p class="w-full mt-2">\(A(m^2)= \dfrac{I(A) \times ρ(Ω·m) \times L(m) }{V_V}\)</p>
                                    <p class="w-full mt-2">Where:</p>
                                    <p class="w-full mt-2">A = <?= $lang[22] ?></p>
                                    <p class="w-full mt-2">ρ = <?= $lang[23] ?> (Ω·m)</p>
                                    <p class="w-full mt-2 ">L = <?= $lang[24] ?></p>
                                    <p class="w-full mt-2 ">I = <?= $lang[25] ?></p>
                                    <p class="w-full mt-2 ">v = <?= $lang[26] ?></p>
                                    <p class="w-full mt-2 ">V = Source voltage</p>
                                    <p class="w-full my-3 text-[18px]"><?= $lang['27'] ?></p>
                                    <p class="w-full mt-2"><?= $lang[28] ?> (ρ) = <?= $detail['c_units'] ?> (<?= $detail['metalunit'] ?>) Ω⋅m</p>
                                    <p class="w-full mt-2"><?= $lang[29] ?>(L) = <?= $detail['wire_length'] ?> m</p>
                                    <p class="w-full mt-2"><?= $lang[30] ?> (I) = <?= $detail['current'] ?> A</p>
                                    <p class="w-full mt-2"> Source voltage (V) = <?= $detail['s_voltage'] ?> V</p>
                                    <p class="w-full mt-2"><?= $lang[31] ?> (v) = <?= $detail['voltage_drop'] ?> %</p>
                                    <p class="w-full my-3 text-[18px]"><?= $lang[32] ?></p>
                                    <p class="w-full mt-2 ">\(A(m^2)= \dfrac{I(A) \times ρ(Ω·m) \times L(m) }{V_V}\)</p>
                                    <p class="w-full mt-2 ">\(= \dfrac{<?= $detail['current'] ?> \times <?= round($detail['metalunit'], 2) ?> \times 10^{-8} \times (2 \times <?= $detail['wire_length'] ?>) }{<?= $detail['voltage_drop'] / 100 ?> \times <?= $detail['s_voltage'] ?>}\) </p>
                                    <p class="w-full mt-2 ">\(= \dfrac{<?= $detail['res'] ?> }{<?= $detail['v'] ?>}\) </p>
                                    <p class="w-full mt-2 ">\(= <?= $detail['am'] ?> mm \times 1000000\) </p>
                                    <p class="w-full mt-2 ">\(= <?= round($detail['single_phase'], 2) ?> mm^2\)</p>
                                    <p class="w-full mt-2 "><?= $lang[33] ?> <strong><?= $detail['s_data'][1] ?>AWG</strong> <?= $lang[34] ?> <strong><?= round($detail['single_phase'], 2) ?> mm²</strong> <?= $lang[35] ?>.</p>
                
                                <?php } ?>
                                <?php if ($detail['type'] == 'three_phase') {
                                    $res1 = round($detail['three_phase'], 2); ?>
                                    <div class="col-lg-6 mt-2">
                                        <table class="w-full font-s-18">
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang['13'] }}</td>
                                                <td class="py-2 border-b"><strong class="text-blue"><?= $detail['t_data'][1] ?> AWG</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang['15'] }}</td>
                                                <td class="py-2 border-b"><strong class="text-blue"><?= round($detail['three_phase'], 2) ?> mm<sup class="text-blue">2</sup></strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p class="w-full my-3 text-[18px]"><?= $lang[16] ?></p>
                                    <div class="w-full overflow-auto">
                                        <table class="w-full" style="border-collapse: collapse">
                                            <thead>
                                                <tr class="bg-[#F6FAFC]">
                                                    <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['17'] ?></strong></td>
                                                    <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['18'] ?></strong></td>
                                                    <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['19'] ?></strong></td>
                                                    <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['20'] ?></strong></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="bg-[#F6FAFC]">
                                                    <td class="p-2 border text-center"><?= $res1 * 0.000001 ?>m²</td>
                                                    <td class="p-2 border text-center"><?= round($res1 * 0.00155, 5) ?>in²</td>
                                                    <td class="p-2 border text-center"><?= round($res1 * 1973.6, 4) ?>cmil</td>
                                                    <td class="p-2 border text-center"><?= round($res1 * 1.9736, 2) ?>kcmil</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <p class="w-full my-3 text-[18px]"><?= $lang['21'] ?></p>
                                    <p class="w-full mt-2">\(A(m^2)= \dfrac{\sqrt{3} \times ρ(Ω·m) \times L(m) \times I(A)}{V_V}\)</p>
                                    <p class="w-full mt-2">Where:</p>
                                    <p class="w-full mt-2">A = <?= $lang['22'] ?></p>
                                    <p class="w-full mt-2">ρ = <?= $lang['23'] ?> (Ω·m)</p>
                                    <p class="w-full mt-2 ">L = <?= $lang['24'] ?></p>
                                    <p class="w-full mt-2 ">I = <?= $lang['25'] ?></p>
                                    <p class="w-full mt-2 ">v = <?= $lang['26'] ?></p>
                                    <p class="w-full mt-2 ">V = Source voltage</p>
                                    <p class="w-full my-3 text-[18px]"><?= $lang['27'] ?></p>
                                    <p class="w-full mt-2"><?= $lang['28'] ?> (ρ) = <?= $detail['c_units'] ?> (<?= $detail['metalunit'] ?>) Ω⋅m</p>
                                    <p class="w-full mt-2"><?= $lang['29'] ?>(L) = <?= $detail['wire_length'] ?> m</p>
                                    <p class="w-full mt-2"><?= $lang['30'] ?> (I) = <?= $detail['current'] ?> A</p>
                                    <p class="w-full mt-2"> Source voltage (V) = <?= $detail['s_voltage'] ?> V</p>
                                    <p class="w-full mt-2"><?= $lang['31'] ?> (v) = <?= $detail['voltage_drop'] ?> %</p>
                                    <p class="w-full my-3 text-[18px]"><?= $lang['32'] ?></p>
                                    <p class="w-full mt-2 ">\(A(m^2)= \dfrac{\sqrt{3} \times ρ(Ω·m) \times L(m) \times I(A)}{V_V}\)</p>
                                    <p class="w-full mt-2 ">\(= \dfrac{<?= round($detail['sqrt'], 4) ?> \times <?= $detail['metalunit'] ?>\times 10^{-8} \times <?= $detail['wire_length'] ?> \times <?= $detail['current'] ?>}{<?= $detail['voltage_drop'] / 100 ?> \times <?= $detail['s_voltage'] ?>}\) </p>
                                    <p class="w-full mt-2 ">\(= \dfrac{<?= $detail['res'] ?>}{<?= $detail['v'] ?>}\) </p>
                                    <p class="w-full mt-2 ">\(= <?= $detail['am'] ?> \times 1,000,000\)</p>
                                    <p class="w-full mt-2 ">\(= <?= $detail['three_phase'] ?>\)</p>
                                    <p class="w-full mt-2 "><?= $lang['33'] ?> <strong><?= $detail['t_data'][1] ?>AWG</strong> <?= $lang['34'] ?> <strong><?= $detail['three_phase'] ?> mm²</strong> <?= $lang['35'] ?>.</p>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($detail['submit'] == 'wire_diameter') { ?>
                                <p class="w-full my-3 text-[18px]"><?= $lang[12] ?></p>
                                <div class="w-full overflow-auto">
                                    <table class="w-full" style="border-collapse: collapse">
                                        <thead>
                                            <tr class="bg-[#f5f5f5]">
                                                <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['44'] ?></strong></td>
                                                <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['45'] ?></strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-[#f5f5f5]">
                                                <td class="p-2 border text-center"><?= round($detail['inches'], 4) ?> in</td>
                                                <td class="p-2 border text-center"><?= round($detail['mm'], 4) ?> mm</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p class="w-full my-3 text-[18px]"><?= $lang[15] ?></p>
                                <div class="w-full overflow-auto">
                                    <table class="w-full" style="border-collapse: collapse">
                                        <thead>
                                            <tr class="bg-[#f5f5f5]">
                                                <td class="p-2 border text-center"><strong class="text-blue">kcmil</strong></td>
                                                <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['46'] ?></strong></td>
                                                <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['47'] ?></strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-[#f5f5f5]">
                                                <td class="p-2 border text-center"><?= round($detail['kcmil'], 4) ?> kcmil</td>
                                                <td class="p-2 border text-center"><?= round($detail['sqinches'], 4) ?> in<sup class="text-blue">2</sup></td>
                                                <td class="p-2 border text-center"><?= round($detail['mm2'], 2) ?> mm<sup class="text-blue">2</sup></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                            <?php if ($detail['submit'] == 'wire_gauge') { ?>
                                <p class="w-full my-3 text-[18px]"><?= $lang[13] ?></p>
                                <div class="w-full overflow-auto">
                                    <table class="w-full" style="border-collapse: collapse">
                                        <thead>
                                            <tr class="bg-[#f5f5f5]">
                                                <td class="p-2 border text-center"><strong class="text-blue">AWG</strong></td>
                                                <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['48'] ?></strong></td>
                                                <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['49'] ?></strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-[#f5f5f5]">
                                                <td class="p-2 border text-center"><?= $detail['d_data'][1] ?> AWG</td>
                                                <td class="p-2 border text-center"><?= $detail['d_data'][0] ?> in</td>
                                                <td class="p-2 border text-center"><?= $detail['d_data'][2]['mm'] ?> mm</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p class="w-full my-3 text-[18px]"><?= $lang[15] ?></p>
                                <div class="w-full overflow-auto">
                                    <table class="w-full" style="border-collapse: collapse">
                                        <thead>
                                            <tr class="bg-[#f5f5f5]">
                                                <td class="p-2 border text-center"><strong class="text-blue">kcmil</strong></td>
                                                <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['46'] ?></strong></td>
                                                <td class="p-2 border text-center"><strong class="text-blue"><?= $lang['47'] ?></strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-[#f5f5f5]">
                                                <td class="p-2 border text-center"><?= $detail['d_data'][2]['kcmil'] ?> kcmil</td>
                                                <td class="p-2 border text-center"><?= round($detail['square_in'], 2) ?> in<sup>2</sup></td>
                                                <td class="p-2 border text-center"><?= $detail['d_data'][2]['mm²'] ?> mm<sup>2</sup></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        @if (isset($detail))
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        @endif
        document.getElementById('wire_size').addEventListener('click', function () {
            this.classList.add('tagsUnit');
            document.getElementById('wire_diameter').classList.remove('tagsUnit');
            document.getElementById('wire_gauge').classList.remove('tagsUnit');
            document.querySelectorAll('.wire_size').forEach(function(element) {
                element.style.display = 'block';
            });
            document.querySelectorAll('.wire_diameter, .wire_gauge').forEach(function(element) {
                element.style.display = 'none';
            });
            document.getElementById("wire").value = "wire_size";
        });

        document.getElementById('wire_diameter').addEventListener('click', function () {
            this.classList.add('tagsUnit');
            document.getElementById('wire_size').classList.remove('tagsUnit');
            document.getElementById('wire_gauge').classList.remove('tagsUnit');
            document.querySelectorAll('.wire_diameter').forEach(function(element) {
                element.style.display = 'block';
            });
            document.querySelectorAll('.wire_size, .wire_gauge').forEach(function(element) {
                element.style.display = 'none';
            });
            document.getElementById("wire").value = "wire_diameter";
        });

        document.getElementById('wire_gauge').addEventListener('click', function () {
            this.classList.add('tagsUnit');
            document.getElementById('wire_size').classList.remove('tagsUnit');
            document.getElementById('wire_diameter').classList.remove('tagsUnit');
            document.querySelectorAll('.wire_gauge').forEach(function(element) {
                element.style.display = 'block';
            });
            document.querySelectorAll('.wire_size, .wire_diameter').forEach(function(element) {
                element.style.display = 'none';
            });
            document.getElementById("wire").value = "wire_gauge";
        });
        let wire = document.getElementById("wire").value;
        document.getElementById(wire).click();
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>