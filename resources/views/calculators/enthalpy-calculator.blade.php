<style>
    .units{
        /* right: 5px;
    z-index: 2; */
        max-height: 250px;
        overflow: auto;
        border-bottom-left-radius: 20px;
        border-bottom-right-radius: 20px;
        padding-left: 10px;
        max-width: 78%;
    }
    #onetw{
        background: transparent;
        border: none;
        color: #1670a7;
        outline: none;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">


            <div class="col-span-12 flex">
                @if($device == 'mobile')
                <label for="calEnthalpy" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                @endif
                <div class="w-full py-2">
                    <div class="mt-2 mt-lg-2 calEnthalpy md:flex lg:flex justify-between align-items-center">
                        @if($device == 'desktop')
                        <label for="calEnthalpy" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        @endif
                        <p class="mb-1 mb-lg-0">
                            <input type="radio" name="calEnthalpy" id="enthalpyFormula" value="enthalpyFormula" checked {{ isset($_POST['calEnthalpy']) && $_POST['calEnthalpy'] === 'enthalpyFormula' ? 'checked' : '' }}>
                            <label for="enthalpyFormula" class="font-s-14 text-blue pe-lg-2 pe-2">{{ $lang['2'] }}:</label>
                        </p>
                        <p>
                            <input type="radio" name="calEnthalpy" id="reactionScheme" value="reactionScheme" {{ isset($_POST['calEnthalpy']) && $_POST['calEnthalpy'] === 'reactionScheme' ? 'checked' : '' }}>
                            <label for="reactionScheme" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="calFrom">
                <label for="calFrom" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                <div class="w-100 py-2">
                    <i class="fas fa-sort-down color_blue"></i>
                    <select name="calFrom" id="calFrom" class="input calFrom">
                        <option value="byStandard"
                            {{ isset($_POST['calFrom']) && $_POST['calFrom'] == 'byStandard' ? 'selected' : '' }}>
                            {{ $lang['5'] }}</option>
                        <option value="byChange"
                            {{ isset($_POST['calFrom']) && $_POST['calFrom'] == 'byChange' ? 'selected' : '' }}>
                            {{ $lang['6'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="calFrom1">
                <label for="calFrom1" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="w-100 py-2">
                    <i class="fas fa-sort-down color_blue"></i>
                    <select name="calFrom1" id="calFrom1" class="input calFrom1">
                        <option value="2"
                            {{ isset($_POST['calFrom1']) && $_POST['calFrom1'] == '2' ? 'selected' : '' }}> 2
                            {{ $lang['7'] }}</option>
                        <option value="3"
                            {{ isset($_POST['calFrom1']) && $_POST['calFrom1'] == '3' ? 'selected' : '' }}> 3
                            {{ $lang['7'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 items-center flex text-center justify-center">
                <div class="" id="enthalpyFormulatext"><strong>ΔH = ΔQ + p * ΔV</strong></div>
                <div class="hidden" id="reactionSchemetext"><strong>a<sub>n</sub>A + b<sub>n</sub>B + c<sub>n</sub>C →
                        d<sub>n</sub>D + e<sub>n</sub>E + f<sub>n</sub>F</strong></div>
            </div>
            <div class="col-span-12 inp_wrap">
                <div class="grid grid-cols-12 mt-3  gap-4">

                    <div class="col-span-6" id="q1">
                        <label for="q1" class="font-s-14 text-blue">{{ $lang['8'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="q1" id="q1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['q1']) ? $_POST['q1'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="q1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('q1_unit_dropdown')">{{ isset($_POST['q1_unit'])?$_POST['q1_unit']:'J' }} ▾</label>
                            <input type="text" name="q1_unit" value="{{ isset($_POST['q1_unit'])?$_POST['q1_unit']:'J' }}" id="q1_unit" class="hidden">
                            <div id="q1_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="q1_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q1_unit', 'J')">J</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q1_unit', 'kJ')">kJ</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q1_unit', 'MJ')">MJ</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q1_unit', 'Wh')">Wh</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q1_unit', 'kWh')">kWh</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q1_unit', 'ft_lbs')">ft-lbs</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q1_unit', 'kcal')">kcal</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q1_unit', 'kcal')">kcal</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q1_unit', 'eV')">eV</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-6" id="q2">
                        <label for="q2" class="font-s-14 text-blue">{{ $lang['9'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="q2" id="q2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['q2']) ? $_POST['q2'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="q2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('q2_unit_dropdown')">{{ isset($_POST['q2_unit'])?$_POST['q2_unit']:'J' }} ▾</label>
                            <input type="text" name="q2_unit" value="{{ isset($_POST['q2_unit'])?$_POST['q2_unit']:'J' }}" id="q2_unit" class="hidden">
                            <div id="q2_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="q2_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q2_unit', 'J')">J</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q2_unit', 'kJ')">kJ</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q2_unit', 'MJ')">MJ</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q2_unit', 'Wh')">Wh</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q2_unit', 'kWh')">kWh</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q2_unit', 'ft_lbs')">ft-lbs</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q2_unit', 'kcal')">kcal</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q2_unit', 'kcal')">kcal</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('q2_unit', 'eV')">eV</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-6" id="v1">
                        <label for="v1" class="font-s-14 text-blue">{{ $lang['10'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="v1" id="v1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['v1']) ? $_POST['v1'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="v1_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('v1_unit_dropdown')">{{ isset($_POST['v1_unit'])?$_POST['v1_unit']:'mm3' }} ▾</label>
                            <input type="text" name="v1_unit" value="{{ isset($_POST['v1_unit'])?$_POST['v1_unit']:'mm3' }}" id="v1_unit" class="hidden">
                            <div id="v1_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="v1_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'mm3')">mm³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'cm3')">cm³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'dm3')">dm³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'm3')">m³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'cu_in')">cu in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'cu_ft')">cu ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'cu_yd')">cu yd</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'ml')">ml</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'cl')">cl</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'liters')">liters</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'us_gal')">US gal</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'uk_gal')">UK gal</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'us_fl_oz')">US fl oz</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'uk_fl_oz')">UK fl oz</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'cups')">cups</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'tbsp')">tbsp</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'tsp')">tsp</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'us_qt')">US qt</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'uk_qt')">UK qt</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'us_pt')">US pt</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v1_unit', 'uk_pt')">UK pt</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-6" id="v2">
                        <label for="v2" class="font-s-14 text-blue">{{ $lang['11'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="v2" id="v2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['v2']) ? $_POST['v2'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="v2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('v2_unit_dropdown')">{{ isset($_POST['v2_unit'])?$_POST['v2_unit']:'mm3' }} ▾</label>
                            <input type="text" name="v2_unit" value="{{ isset($_POST['v2_unit'])?$_POST['v2_unit']:'mm3' }}" id="v2_unit" class="hidden">
                            <div id="v2_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="v2_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'mm3')">mm³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'cm3')">cm³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'dm3')">dm³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'm3')">m³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'cu_in')">cu in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'cu_ft')">cu ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'cu_yd')">cu yd</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'ml')">ml</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'cl')">cl</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'liters')">liters</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'us_gal')">US gal</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'uk_gal')">UK gal</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'us_fl_oz')">US fl oz</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'uk_fl_oz')">UK fl oz</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'cups')">cups</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'tbsp')">tbsp</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'tsp')">tsp</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'us_qt')">US qt</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'uk_qt')">UK qt</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'us_pt')">US pt</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('v2_unit', 'uk_pt')">UK pt</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-6 hidden" id="changeQ">
                        <label for="changeQ" class="font-s-14 text-blue">{{ $lang['12'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="changeQ" id="changeQ" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['changeQ']) ? $_POST['changeQ'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="changeQ_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('changeQ_unit_dropdown')">{{ isset($_POST['changeQ_unit'])?$_POST['changeQ_unit']:'mm3' }} ▾</label>
                            <input type="text" name="changeQ_unit" value="{{ isset($_POST['changeQ_unit'])?$_POST['changeQ_unit']:'mm3' }}" id="changeQ_unit" class="hidden">
                            <div id="changeQ_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="changeQ_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeQ_unit', 'J')">J</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeQ_unit', 'kJ')">kJ</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeQ_unit', 'MJ')">MJ</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeQ_unit', 'Wh')">Wh</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeQ_unit', 'kWh')">kWh</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeQ_unit', 'ft_lbs')">ft-lbs</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeQ_unit', 'kcal')">kcal</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeQ_unit', 'kcal')">kcal</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeQ_unit', 'eV')">eV</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-6 hidden" id="changeV">
                        <label for="changeV" class="font-s-14 text-blue">{{ $lang['13'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="changeV" id="changeV" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['changeV']) ? $_POST['changeV'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="changeV_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('changeV_unit_dropdown')">{{ isset($_POST['changeV_unit'])?$_POST['changeV_unit']:'mm3' }} ▾</label>
                            <input type="text" name="changeV_unit" value="{{ isset($_POST['changeV_unit'])?$_POST['changeV_unit']:'mm3' }}" id="changeV_unit" class="hidden">
                            <div id="changeV_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="changeV_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'mm3')">mm³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'cm3')">cm³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'dm3')">dm³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'm3')">m³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'cu_in')">cu in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'cu_ft')">cu ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'cu_yd')">cu yd</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'ml')">ml</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'cl')">cl</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'liters')">liters</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'us_gal')">US gal</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'uk_gal')">UK gal</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'us_fl_oz')">US fl oz</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'uk_fl_oz')">UK fl oz</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'cups')">cups</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'tbsp')">tbsp</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'tsp')">tsp</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'us_qt')">US qt</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'uk_qt')">UK qt</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'us_pt')">US pt</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('changeV_unit', 'uk_pt')">UK pt</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-span-6" id="p">
                        <label for="p" class="font-s-14 text-blue">{{ $lang['14'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="p" id="p" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['p']) ? $_POST['p'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="p_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('p_unit_dropdown')">{{ isset($_POST['p_unit'])?$_POST['p_unit']:'Pa' }} ▾</label>
                            <input type="text" name="p_unit" value="{{ isset($_POST['p_unit'])?$_POST['p_unit']:'Pa' }}" id="p_unit" class="hidden">
                            <div id="p_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="p_unit">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'Pa')">Pa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'bar')">bar</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'psi')">psi</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'at')">at</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'atm')">atm/p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'torr')">Torr</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'hpa')">hpa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'kPa')">kPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'MPa')">MPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'GPa')">GPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'in_hg')">in H</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('p_unit', 'mmhg')">mmHg</p>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
              <strong class="col-span-12 hidden heading mb-2 mb-lg-0">{{ $lang['16'] }}</strong>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="a_n">
                <label for="a_n" class="font-s-14 text-blue"> a<sub  class="text-blue">n</sub> {{ $lang['15'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="a_n"  id="a_n"
                        class="input" aria-label="input" placeholder="50"
                        value="{{ isset($_POST['a_n']) ? $_POST['a_n'] : '2' }}" />
                </div>
            </div>
            @php
                $DATA_A =  [
                    "None" => "0",
                    "Custom" => "0",
                    "Ag(s)" => "0",
                    "Ag⁺(aq)" => "105.58",
                    "Ag₂O(s)" => "-31.05",
                    "Ag₂S(s)" => "-31.8",
                    "AgBr(aq)" => "-15.98",
                    "AgBr(s)" => "-100.37",
                    "AgCl(aq)" => "-61.58",
                    "AgCl(s)" => "-127.7",
                    "AgI(aq)" => "50.38",
                    "AgI(s)" => "-61.84",
                    "AgNO₃(s)" => "-124.39",
                    "Al(s)" => "0",
                    "Al₂O₃(s)" => "-1669.8",
                    "Al³⁺(aq)" => "-524.7",
                    "AlCl₃(s)" => "-704.2",
                    "As(s) " => "0",
                    "As₂S₃(s) " => "-169",
                    "AsO₄³⁻(aq)" => "-888.14",
                    "B(s)" => "0",
                    "B₂O₃(s)" => "-1272.8",
                    "Ba(s)" => "0",
                    "Ba²⁺(aq)" => "-537.64",
                    "BaCl₂(s)" => "-860.1",
                    "BaCO₃(aq)" => "-1214.78",
                    "BaCO₃(s)" => "-1218.8",
                    "BaO(s)" => "-558.1",
                    "BaSO₄(s)" => "-1465.2",
                    "BF₃(g)" => "-1137",
                    "Br⁻(aq)" => "-121.55",
                    "Br(g)" => "111.88",
                    "Br₂(g)" => "30.907",
                    "Br₂(l)" => "0",
                    "C(g)" => "716.68",
                    "C(s) - Diamond" => "1.88",
                    "C(s) - Graphite" => "0",
                    "CH₃CHO(g)" => "-166.19",
                    "CH₃CHO(l) - Acetaldehyde" => "-192.3",
                    "CH₃COCH₃(l) - Acetone" => "-248.1",
                    "CH₃COOH(aq)" => "-485.76",
                    "CH₃COOH(l) - Acetic acid" => "-484.5",
                    "CH₃NH₂(g) - Methylamine" => "-22.97",
                    "CH₃OH(g)" => "-200.66",
                    "CH₃OH(l) - Methanol" => "-238.6",
                    "CH₄(g) - Methane" => "-74.81",
                    "CHCl₃(l)" => "-131.8",
                    "(COOH)₂(s) - Oxalic acid" => "-827.2",
                    "C₂H₂(g) - Acetylene" => "226.73",
                    "C₂H₄(g) - Ethylene" => "52.28",
                    "C₂H₅OH(g)" => "-235.1",
                    "C₂H₅OH(l) - Ethanol" => "-277.69",
                    "C₂H₆(g) - Ethane" => "-84.68",
                    "C₃H₆(g) - Cyclopropane " => "53.3",
                    "C₃H₆(g) - Propylene" => "20.42",
                    "C₃H₈(g) - Propane" => "-103.8",
                    "C₄H₁₀(g) - Butane" => "-126.15",
                    "C₅H₁₂(g) - Pentane" => "-146.44",
                    "C₆H₁₂(l) - Cyclohexane" => "-156.4",
                    "C₆H₁₂O₆(s) - Fructose" => "-1266",
                    "C₆H₁₂O₆(s) - Glucose" => "-1273",
                    "C₆H₁₄(l) - Haxane" => "-198.7",
                    "C₆H₅COOH(s) - Benzoic acid" => "-385.1",
                    "C₆H₅NH₂(l) - Aniline" => "31.6",
                    "C₆H₅OH(s) - Phenol" => "-164.6",
                    "C₆H₆(l) - Benzene" => "49.03",
                    "C₇H₈(l) - Toluene" => "12",
                    "C₈H₁₈(l) - Octane" => "-250.1",
                    "C₁₂H₂₂O₁₁(s) - Sucrose" => "-2220",
                    "CO(g)" => "-110.5",
                    "CO(NH₂)₂(s) - Urea" => "-333.51",
                    "CO₂(g)" => "-393.5",
                    "CO₃²⁻(aq)" => "-677.14",
                    "CCl₄(g)" => "-102.9",
                    "CCl₄(l)" => "-139.5",
                    "Ca(g)" => "178.2",
                    "Ca(OH)₂(aq)" => "-1002.82",
                    "Ca(OH)₂(s)" => "-986.6",
                    "Ca(s)" => "0",
                    "Ca²⁺(aq)" => "-542.83",
                    "CaBr₂(s)" => "-682.8",
                    "CaC₂(s)" => "-59.8",
                    "CaCl₂(aq)" => "-877.1",
                    "CaCl₂(s)" => "-795",
                    "CaCO₃(aq)" => "-1219.97",
                    "CaCO₃(s)" => "-1207.1",
                    "CaF₂(aq)" => "-1208.09",
                    "CaF₂(s)" => "-1219.6",
                    "CaO(s)" => "-635.5",
                    "CaSO₄(aq)" => "-1452.1",
                    "CaSO₄(s)" => "-1432.7",
                    "Ce(s)" => "0",
                    "Ce³⁺(aq)" => "-696.2",
                    "Ce⁴⁺(aq)" => "-537.2",
                    "Cl(g)" => "121.68",
                    "Cl⁻(aq)" => "-167.16",
                    "Cl₂(g)" => "0",
                    "CoO(s)" => "-239.3",
                    "Cr₂O₃(s)" => "-1128.4",
                    "CS₂(l)" => "89.7",
                    "Cu(s)" => "0",
                    "Cu⁺(aq)" => "71.67",
                    "Cu²⁺(aq)" => "64.77",
                    "Cu₂O(s)" => "-168.6",
                    "CuO(s)" => "-157.3",
                    "CuS(s)" => "-48.5",
                    "CuSO₄(s)" => "-771.36",
                    "D₂(g)" => "0",
                    "D₂O(l)" => "-294.6",
                    "D₂O(g)" => "-249.2",
                    "F⁻(aq)" => "-332.63",
                    "F₂(g)" => "0",
                    "Fe(s)" => "0",
                    "Fe²⁺(aq)" => "-89.1",
                    "Fe³⁺(aq)" => "-48.5",
                    "FeO(s)" => "-272.04",
                    "Fe₂O₃(s) - Hematite" => "-824.2",
                    "Fe₃O₄(s) - Magnetite" => "-1118.4",
                    "FeS(s) - α" => "-100",
                    "FeS₂(s) " => "-178.2",
                    "H(g)" => "217.97",
                    "H⁺(aq)" => "0",
                    "H₂(g)" => "0",
                    "H₂O(g) - Water vapor" => "-241.8",
                    "H₂O(l) - Water" => "-285.83",
                    "H₂O₂(aq)" => "-191.17",
                    "H₂O₂(l)" => "-187.8",
                    "H₂S(aq)" => "-39.7",
                    "H₂S(g)" => "-20.63",
                    "H₂SO₄(aq)" => "-909.27",
                    "H₂SO₄(l)" => "-813.99",
                    "H₃PO₃(aq)" => "-964",
                    "H₃PO₄(aq)" => "-277.4",
                    "H₃PO₄(l)" => "-1266.9",
                    "HBr(g)" => "-36.23",
                    "HCHO(g) - Formaldehyde" => "-108.57",
                    "HCl(aq)" => "-167.16",
                    "HCl(g)" => "-92.31",
                    "HCN(g)" => "135.1",
                    "HCN(l)" => "108.87",
                    "HCOOH(l) - Formic acid" => "-424.72",
                    "HF(aq)" => "-332.36",
                    "HF(g)" => "-271.1",
                    "Hg(g)" => "61.32",
                    "Hg(l)" => "0",
                    "Hg₂Cl₂(s)" => "-265.22",
                    "HgO(s)" => "-90.83",
                    "HgS(s)" => "-58.2",
                    "HI(g)" => "26.48",
                    "HN₃(g)" => "294.1",
                    "HNO₃(aq)" => "-207.36",
                    "HNO₃(l)" => "-174.1",
                    "I⁻(aq)" => "-55.19",
                    "I₂(g)" => "62.44",
                    "I₂(s)" => "0",
                    "K(g)" => "89.24",
                    "K(s)" => "0",
                    "K⁺(aq)" => "-252.38",
                    "K₂S(aq)" => "-471.5",
                    "K₂S(s)" => "-380.7",
                    "KBr(s)" => "-393.8",
                    "KCl(s)" => "-436.75",
                    "KClO₃(s)" => "-397.73",
                    "KClO₄(s)" => "-432.75",
                    "KF(s)" => "-567.27",
                    "KI(s)" => "-327.9",
                    "KOH(aq)" => "-482.37",
                    "KOH(s)" => "-424.76",
                    "Mg(g)" => "147.7",
                    "Mg(OH)₂(s)" => "-924.7",
                    "Mg(s)" => "0",
                    "Mg²⁺(aq)" => "-466.85",
                    "MgBr₂(s)" => "-524.3",
                    "MgCl₂(s)" => "-641.8",
                    "MgCO₃(s)" => "-1095.8",
                    "MgO(s)" => "-601.7",
                    "MgSO₄(s)" => "-1278.2",
                    "MnO(s)" => "-384.9",
                    "MnO₂(s)" => "-519.7",
                    "N₂(g)" => "0",
                    "N₂H₄(g)" => "95.4",
                    "N₂H₄(l)" => "50.63",
                    "N₂O(g)" => "82.05",
                    "N₂O₄(g)" => "9.16",
                    "N₂O₄(l)" => "-19.5",
                    "Na(g)" => "107.32",
                    "Na(s)" => "0",
                    "Na⁺(aq)" => "-240.12",
                    "Na₂CO₃(s)" => "-1130.9",
                    "NaBr(s)" => "-361.06",
                    "NaCl(s)" => "-411.15",
                    "NaF(s)" => -569,
                    "NaHCO₃(s)" => "-947.7",
                    "NaI(s)" => "-287.78",
                    "NaOH(aq)" => "-470.11",
                    "NaOH(s)" => "-425.61",
                    "NH₂CH₂COOH(s) - Glycine" => "-532.9",
                    "NH₂OH(s)" => "-114.2",
                    "NH₃(aq)" => "-80.29",
                    "NH₃(g) - Ammonia" => "-46.11",
                    "NH₄⁺(aq)" => "-132.51",
                    "NH₄Cl(s)" => "-314.43",
                    "NH₄ClO₄(s)" => "-295.31",
                    "NH₄NO₃(s)" => "-365.56",
                    "NiO(s)" => "-244.3",
                    "NO(g)" => "90.25",
                    "NO₂(g)" => "33.18",
                    "NO₃⁻(aq)" => "-205",
                    "O₂(g)" => "0",
                    "O₃(g)" => "142.7",
                    "OH⁻(aq)" => "-229.99",
                    "P(s)" => "0",
                    "P₄(g)" => "58.91",
                    "P₄O₁₀(s)" => "-2984",
                    "Pb(s)" => "0",
                    "Pb²⁺(aq)" => "-1.7",
                    "Pb₃O₄(s)" => "-734.7",
                    "PbBr₂(aq)" => "-244.8",
                    "PbBr₂(s)" => "-278.7",
                    "PbCl₂(s)" => "-359.2",
                    "PbO(s)" => "-217.9",
                    "PbO₂(s)" => "-277.4",
                    "PbSO₄(s)" => "-919.94",
                    "PCl₃(g)" => "-287",
                    "PCl₃(l)" => "-319.7",
                    "PCl₅(g)" => "-374.9",
                    "PCl₅(s)" => "-443.5",
                    "PH₃(g)" => "5.4",
                    "S(s) - Monoclinic" => "0.33",
                    "S(s) - Rhombic" => "0",
                    "S²⁻(aq)" => "33.1",
                    "SbCl₃(g)" => "-313.8",
                    "SbCl₅(g) " => "-394.34",
                    "SbH₃(g) " => "145.11",
                    "SF₆(g)" => "-1209",
                    "Si(s)" => "0",
                    "SiO₂(s)" => "-859.4",
                    "SiO₂(s) - α" => "-910.94",
                    "Sn(s) - Gray" => "-2.09",
                    "Sn(s) - White" => "0",
                    "SnCl₂(s)" => "-349.8",
                    "SnCl₄(l)" => "-545.2",
                    "SnO(s)" => "-285.8",
                    "SnO₂(s)" => "-580.7",
                    "SO₂(g)" => "-296.83",
                    "SO₃(g)" => "-395.72",
                    "SO₄²⁻(aq)" => "-909.27",
                    "Zn(s)" => "0",
                    "Zn²⁺(aq)" => "-153.89",
                    "ZnO(s)" => "-348.28",
                    "ZnS(s)" => "-202.9"
                ];
                $jsonDataA = json_encode($DATA_A);
            @endphp

            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="rA">
                <label for="new_rA" class="font-s-14 text-blue">{{ $lang['16'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="rA" id="new_rA" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['rA']) ? $_POST['rA'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="rA_values" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('rA_values_dropdown')">{{ isset($_POST['rA_values'])?$_POST['rA_values']:'Ag(s)' }} ▾</label>
                    <input type="text" name="rA_values" value="{{ isset($_POST['rA_values'])?$_POST['rA_values']:'Ag(s)' }}" id="rA_values" class="hidden">
                    <div id="rA_values_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="rA_values">
                        @foreach ($DATA_A as $name => $val)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer chOk"  onclick="setUnit('rA_values', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                    </div>
                </div>
            </div>

           
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="b_n">
                <label for="b_n" class="font-s-14 text-blue"> b<sub  class="text-blue">n</sub> {{ $lang['15'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="b_n"  id="b_n"
                        class="input" aria-label="input" placeholder="50"
                        value="{{ isset($_POST['b_n']) ? $_POST['b_n'] : '2' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="rB">
                <label for="newrB" class="font-s-14 text-blue">{{ $lang['16'] }} B</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="rB" id="newrB" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['rB']) ? $_POST['rB'] : '105.58' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="rB_values" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('rB_values_dropdown')">{{ isset($_POST['rB_values'])?$_POST['rB_values']:'Ag(s)' }} ▾</label>
                    <input type="text" name="rB_values" value="{{ isset($_POST['rB_values'])?$_POST['rB_values']:'Ag(s)' }}" id="rB_values" class="hidden">
                    <div id="rB_values_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="rB_values">
                        @foreach ($DATA_A as $name => $val)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer chOk"  onclick="setUnit('rB_values', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                    </div>
                </div>
            </div>
          
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="c_n">
                <label for="c_n" class="font-s-14 text-blue"> c<sub  class="text-blue">n</sub> {{ $lang['15'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="c_n"  id="c_n"
                        class="input" aria-label="input" placeholder="50"
                        value="{{ isset($_POST['c_n']) ? $_POST['c_n'] : '2' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="rC">
                <label for="newrC" class="font-s-14 text-blue">{{ $lang['16'] }} C</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="rC" id="newrC" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['rC']) ? $_POST['rC'] : '105.58' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="rC_values" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('rC_values_dropdown')">{{ isset($_POST['rC_values'])?$_POST['rC_values']:'Ag(s)' }} ▾</label>
                    <input type="text" name="rC_values" value="{{ isset($_POST['rC_values'])?$_POST['rC_values']:'Ag(s)' }}" id="rC_values" class="hidden">
                    <div id="rC_values_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="rC_values">
                        @foreach ($DATA_A as $name => $val)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer chOk"  onclick="setUnit('rC_values', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                    </div>
                </div>
            </div>

           
            <strong class="col-span-12 hidden heading mt-1 mb-2 mb-lg-0">{{ $lang['17'] }}</strong>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="d_n">
              <label for="d_n" class="font-s-14 text-blue"> d<sub class="text-blue">n</sub> {{ $lang['15'] }}:</label>
              <div class="w-100 py-2 position-relative">
                  <input type="number" step="any" name="d_n" id="d_n"
                      class="input" aria-label="input" placeholder="50"
                      value="{{ isset($_POST['d_n']) ? $_POST['d_n'] : '2' }}" />
              </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="pD">
                <label for="newpD" class="font-s-14 text-blue">{{ $lang['17'] }} D</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="pD" id="newpD" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2 pD  w-full" value="{{ isset($_POST['pD']) ? $_POST['pD'] : '105.58' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="pD_values" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pD_values_dropdown')">{{ isset($_POST['pD_values'])?$_POST['pD_values']:'Ag(s)' }} ▾</label>
                    <input type="text" name="pD_values" value="{{ isset($_POST['pD_values'])?$_POST['pD_values']:'Ag(s)' }}" id="pD_values" class="hidden">
                    <div id="pD_values_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pD_values">
                        @foreach ($DATA_A as $name => $val)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer chOk"  onclick="setUnit('pD_values', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                    </div>
                </div>
            </div>
          

            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="e_n">
              <label for="e_n" class="font-s-14 text-blue"> e<sub class="text-blue">n</sub> {{ $lang['15'] }}:</label>
              <div class="w-100 py-2 position-relative">
                  <input type="number" step="any" name="e_n"  id="e_n"
                      class="input" aria-label="input" placeholder="50"
                      value="{{ isset($_POST['e_n']) ? $_POST['e_n'] : '1' }}" />
              </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="pE">
                <label for="newpE" class="font-s-14 text-blue">{{ $lang['17'] }} E</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="pE" id="newpE" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2 pE  w-full" value="{{ isset($_POST['pE']) ? $_POST['pE'] : '105.58' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="pE_values" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pE_values_dropdown')">{{ isset($_POST['pE_values'])?$_POST['pE_values']:'Ag(s)' }} ▾</label>
                    <input type="text" name="pE_values" value="{{ isset($_POST['pE_values'])?$_POST['pE_values']:'Ag(s)' }}" id="pE_values" class="hidden">
                    <div id="pE_values_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pE_values">
                        @foreach ($DATA_A as $name => $val)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer chOk"  onclick="setUnit('pE_values', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
                    </div>
                </div>
            </div>
          
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="f_n">
              <label for="f_n" class="font-s-14 text-blue"> f<sub class="text-blue">n</sub> {{ $lang['15'] }}:</label>
              <div class="w-100 py-2 position-relative">
                  <input type="number" step="any" name="f_n"  id="f_n"
                      class="input" aria-label="input" placeholder="50"
                      value="{{ isset($_POST['f_n']) ? $_POST['f_n'] : '1' }}" />
              </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="pF">
                <label for="newpF" class="font-s-14 text-blue">{{ $lang['17'] }} F</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="pF" id="newpE" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2 pF  w-full" value="{{ isset($_POST['pF']) ? $_POST['pF'] : '105.58' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="pE_values" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pE_values_dropdown')">{{ isset($_POST['pF_values'])?$_POST['pF_values']:'Ag(s)' }} ▾</label>
                    <input type="text" name="pF_values" value="{{ isset($_POST['pF_values'])?$_POST['pF_values']:'Ag(s)' }}" id="pF_values" class="hidden">
                    <div id="pF_values_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pF_values">
                        @foreach ($DATA_A as $name => $val)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer chOk"  onclick="setUnit('pF_values', '{{ $name }}')"> {{ $name }}</p>
                         @endforeach
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
                    <div class="w-full md:w-[60%] lg:w-[60%] ">
                      <table class="w-full ">
                          <tr>
                             <td class="py-2 border-b" width="50%">{{ $lang[18] }}</td>
                             <td class="py-2 border-b text-end circle_result"  data-target="1">
                                     {{ $detail['ans'] }} 
                             </td>
                             <td class="py-2 border-b relative text-center" width="25%">
                                    <div class="relative w-full mt-[7px]">
                                        <label for="resultUnit1" class=" cursor-pointer  input-unit text-sm underline right-6 top-4" onclick="toggleDropdown('resultUnit1_dropdown')">{{ request()->calEnthalpy == 'enthalpyFormula' ? 'J' : 'kJ' }} ▾</label>
                                        <input type="text" name="resultUnit1" value="J" id="resultUnit1" class="hidden">
                                        <div id="resultUnit1_dropdown" class="units resultUnit1 absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="resultUnit1" data-target="1">
                                            <p value="J" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit1', 'J')">J</p>
                                            <p value="kJ" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit1', 'kJ')">kJ</p>
                                            <p value="MJ" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit1', 'MJ')">MJ</p>
                                            <p value="Wh" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit1', 'Wh')">Wh</p>
                                            <p value="kWh" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit1', 'kWh')">kWh</p>
                                            <p value="ft-lbs" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit1', 'ft-lbs')">ft-lbs</p>
                                            <p value="kcal" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit1', 'kcal')">kcal</p>
                                            <p value="eV" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit1', 'eV')">eV</p>
                                        </div>
                                     </div>
                             </td>
                          </tr>
                          @if(request()->calEnthalpy == 'enthalpyFormula')
                            <tr>
                                <td class="py-2 border-b" width="50%">{{ $lang[27] }}</td>
                                <td class="py-2 border-b text-end circle_result"  data-target="2"> {{ round($detail['initial_enth']) }}</td>
                                <td class="py-2 border-b position-relative text-center" width="25%">
                                    <div class="relative w-full mt-[7px]">
                                        <label for="resultUnit2" class=" cursor-pointer  input-unit text-sm underline right-6 top-4" onclick="toggleDropdown('resultUnit2_dropdown')">{{ isset($_POST['resultUnit2']) ? $_POST['resultUnit2'] : 'J' }} ▾</label>
                                        <input type="text" name="resultUnit2" value="J" id="resultUnit2" class="hidden">
                                        <div id="resultUnit2_dropdown" class="units resultUnit2 absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="resultUnit2" data-target="2">
                                            <p value="J" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit2', 'J')">J</p>
                                            <p value="kJ" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit2', 'kJ')">kJ</p>
                                            <p value="MJ" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit2', 'MJ')">MJ</p>
                                            <p value="Wh" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit2', 'Wh')">Wh</p>
                                            <p value="kWh" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit2', 'kWh')">kWh</p>
                                            <p value="ft-lbs" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit2', 'ft-lbs')">ft-lbs</p>
                                            <p value="kcal" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit2', 'kcal')">kcal</p>
                                            <p value="eV" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit2', 'eV')">eV</p>
                                        </div>
                                     </div>
                                   
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="50%">{{ $lang[28] }}</td>
                                <td class="py-2 border-b text-end circle_result"  data-target="3"> {{ round($detail['Final_enth']) }}</td>
                                <td class="py-2 border-b position-relative text-center" width="20%">

                                    <div class="relative w-full mt-[7px]">
                                        <label for="resultUnit3" class=" cursor-pointer  input-unit text-sm underline right-6 top-4" onclick="toggleDropdown('resultUnit3_dropdown')">{{ isset($_POST['resultUnit3']) ? $_POST['resultUnit3'] : 'J' }} ▾</label>
                                        <input type="text" name="resultUnit3" value="J" id="resultUnit3" class="hidden">
                                        <div id="resultUnit3_dropdown" class="units resultUnit3 absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="resultUnit3" data-target="3">
                                            <p value="J" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit3', 'J')">J</p>
                                            <p value="kJ" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit3', 'kJ')">kJ</p>
                                            <p value="MJ" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit3', 'MJ')">MJ</p>
                                            <p value="Wh" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit3', 'Wh')">Wh</p>
                                            <p value="kWh" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit3', 'kWh')">kWh</p>
                                            <p value="ft-lbs" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit3', 'ft-lbs')">ft-lbs</p>
                                            <p value="kcal" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit3', 'kcal')">kcal</p>
                                            <p value="eV" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('resultUnit3', 'eV')">eV</p>
                                        </div>
                                     </div>
                                    
                                </td>

                            </tr>
                          @endif
                      </table>
                   </div>
                    <div class="w-full">
                        <div class="mt-2">
                            @if($_POST['calEnthalpy']==='enthalpyFormula')
                                @php
                                    $check=$detail['check'];
                                @endphp
                                <p class="mt-2 font-s-18"><strong class="text-blue">{{$lang['19']}}:</strong></p>
                                <p class="mt-2">{{$lang['20']}}</p>
                                <p class="mt-2">ΔH = ΔQ + p * ΔV</p>
                                @if($check==='byStandard')
                                @php
                                    $q1=$detail['q1'];
                                    $q2=$detail['q2'];
                                    $v1=$detail['v1'];
                                    $v2=$detail['v2'];
                                    $p=$detail['p'];
                                @endphp
                                <p class="mt-2">{{$lang['21']}}</p>
                                <p class="mt-2">ΔH = (Q₂ - Q₁) + p * (V₂ - V₁)</p>
                                <p class="mt-2">{{$lang['22']}}</p>
                                <p class="mt-2">Q₁ = {{$q1}}, Q₂ = {{$q2}}, V₁ = {{$v1}}, V₂ = {{$v2}}, p = {{$p}}, ΔH = ?</p>
                                <p class="mt-2"><strong>{{$lang['23']}}</strong></p>
                                <p class="mt-2">ΔH = (Q₂ - Q₁) + p * (V₂ - V₁)</p>
                                <p class="mt-2">ΔH = ({{$q2}} - {{$q1}}) + ({{$p}}) * ({{$v2}} - {{$v1}})</p>
                                <p class="mt-2">ΔH = ({{$q2-$q1}}) + ({{$p}}) * ({{$v2-$v1}})</p>
                                <p class="mt-2">ΔH = ({{$q2-$q1}}) + ({{$p*($v2-$v1)}})</p>
                                <p class="mt-2">ΔH = <strong>{{$detail['ans']}}</strong></p>
                                @elseif($check==='byChange')
                                @php
                                    $changeQ=$detail['changeQ'];
                                    $changeV=$detail['changeV'];
                                    $p=$detail['p'];
                                @endphp
                                <p class="mt-2">{{ $lang['22']}}</p>
                                <p class="mt-2">ΔQ = {{$changeQ}}, ΔV = {{$changeV}}, p = {{$p}}, ΔH = ?</p>
                                <p class="mt-2"><strong>{{$lang['23']}}</strong></p>
                                <p class="mt-2">ΔH = ΔQ + p * ΔV</p>
                                <p class="mt-2">ΔH = ({{$changeQ}}) + ({{$p}}) * ({{$changeV}})</p>
                                <p class="mt-2">ΔH = ({{$changeQ}}) + ({{$p*($changeV)}})</p>
                                <p class="mt-2">ΔH = <strong>{{$detail['ans']}}</strong></p>
                                @endif
                            @elseif($_POST['calEnthalpy']==='reactionScheme')
                                @php
                                $reaction=$detail['reaction'];
                                $text=$detail['text'];
                                $text_vals=$detail['text_vals'];
                                @endphp
                                {{-- <p class="mt-2"><strong>{{ $lang['24']}}:</strong></p> --}}
                                <p class="mt-2"><strong>{{ $lang['25']}}:</strong></p>
                                <p class="mt-2">{{ $reaction}}</p>
                                <p class="mt-2"><strong>{{ $lang['26']}}:</strong></p>
                                <p class="mt-2">
                                    @for($i=0; $i < count($text)-1; $i++)
                                    {{$text[$i]}}: H<sub>f</sub> = {{$text_vals[$i]}} kJ
                                    @endfor
                                </p>
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
const conversionFactors1 = {
    'J': 1,
    'kJ': 0.001,
    'MJ': 0.000001,
    'Wh': 0.000277778,
    'kWh': 0.000000277778,
    'ft-lbs': 0.737562,
    'kcal': 0.000239006,
    'eV': 6242000000000000000
};

const conversionFactors2 = {
    'J': 1000,
    'kJ': 1,
    'MJ': 0.001,
    'Wh': 0.277778,
    'kWh': 0.000277778,
    'ft-lbs': 737.562,
    'kcal': 0.239006,
    'eV': 6242000000000000000000
};
function changeValues(unit, target) {
    // Determine which set of conversion factors to use
    const conversionFactor = @if(request()->calEnthalpy == 'enthalpyFormula') conversionFactors1[unit]; @else conversionFactors2[unit]; @endif
    if (conversionFactor !== undefined) {
        // Find the specific .circle_result element associated with the target
        const resultDiv = document.querySelector(`.circle_result[data-target="${target}"]`);
        if (resultDiv) {
            const originalValue = parseFloat(resultDiv.getAttribute('data-initial-value'));
            const newValue = originalValue * conversionFactor;
            resultDiv.innerText = Number(newValue.toFixed(6)).toString();  // Update the value
        } else {
            console.error("No .circle_result found for target: " + target);
        }
    } else {
        console.error("Invalid conversion factor for unit: " + unit);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.units').forEach(unitDiv => {
        unitDiv.querySelectorAll('p').forEach(p => {
            p.addEventListener('click', () => {
                const unit = p.getAttribute('value');
                const target = unitDiv.getAttribute('data-target'); // Get the data-target value from the units container
                changeValues(unit, target);
            });
        });
    });

    document.querySelectorAll('.circle_result').forEach(div => {
        const initialValue = parseFloat(div.innerText);
        div.setAttribute('data-initial-value', initialValue);
    });
});

    document.addEventListener("DOMContentLoaded", function() {
        var calEnthalpyElements = document.querySelectorAll('input[name="calEnthalpy"]');
        calEnthalpyElements.forEach(function(element) {
            element.addEventListener('click', function() {
                var value = element.value;
                console.log(value);
                
                if (value === 'enthalpyFormula') {
                    //   document.getElementById('calFrom').classList.remove('hidden');
                    document.getElementById('enthalpyFormulatext').classList.remove('hidden');
                    //   document.getElementById('calFrom1').classList.add('hidden');
                    document.getElementById('reactionSchemetext').classList.add('hidden');
                        document.querySelectorAll('.heading').forEach(ele => {
                            ele.style.display = 'none';
                        });
                    showElements(['#q1', '#q2', '#v1', '#v2', '#p']);
                    hideElements(['#changeQ', '#changeV', '#a_n', '#rA', '#b_n', '#rB', '#c_n', '#rC', '#d_n', '#pD', '#e_n', '#pE', '#f_n', '#pF']);
                    
                } else if (value === 'reactionScheme') {
                    document.querySelectorAll('.heading').forEach(ele => {
                            ele.style.display = 'block';
                        });
                    //   document.getElementById('calFrom1').classList.remove('hidden');
                    document.getElementById('reactionSchemetext').classList.remove('hidden');
                    //   document.getElementById('calFrom').classList.add('hidden');
                    document.getElementById('enthalpyFormulatext').classList.add('hidden');

                    showElements(['#a_n', '#rA', '#b_n', '#rB', '#c_n', '#rC', '#d_n', '#pD', '#e_n', '#pE', '#f_n', '#pF']);
                    hideElements(['#q1', '#q2', '#v1', '#v2', '#p', '#changeQ', '#changeV']);
                }
            });
        });

        function showElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelector(selector).classList.remove('hidden');
            });
        }

        function hideElements(selectors) {
            selectors.forEach(function(selector) {
                document.querySelector(selector).classList.add('hidden');
            });
        }
    });
  @if(isset($detail) || isset($error))
            var value = "{{$_POST['calEnthalpy']}}";
              if (value === 'enthalpyFormula') {
                //   document.getElementById('calFrom').classList.remove('hidden');
                  document.getElementById('enthalpyFormulatext').classList.remove('hidden');
                //   document.getElementById('calFrom1').classList.add('hidden');
                  document.getElementById('reactionSchemetext').classList.add('hidden');
                  document.querySelectorAll('.heading').forEach(ele => {
                        ele.style.display = 'none';
                    });
                  showElements(['#q1', '#q2', '#v1', '#v2', '#p']);
                  hideElements(['#changeQ', '#changeV', '#a_n', '#rA', '#b_n', '#rB', '#c_n', '#rC', '#d_n', '#pD', '#e_n', '#pE', '#f_n', '#pF']);
                 
              } else if (value === 'reactionScheme') {
                //   document.getElementById('calFrom1').classList.remove('hidden');
                  document.getElementById('reactionSchemetext').classList.remove('hidden');
                //   document.getElementById('calFrom').classList.add('hidden');
                  document.getElementById('enthalpyFormulatext').classList.add('hidden');
                document.querySelectorAll('.heading').forEach(ele => {
                        ele.style.display = 'block';
                    });
                showElements(['#a_n', '#rA', '#b_n', '#rB', '#c_n', '#rC', '#d_n', '#pD', '#e_n', '#pE', '#f_n', '#pF']);
                hideElements(['#q1', '#q2', '#v1', '#v2', '#p', '#changeQ', '#changeV']);
              }
      function showElements(selectors) {
          selectors.forEach(function(selector) {
              document.querySelector(selector).classList.remove('hidden');
          });
      }
      function hideElements(selectors) {
          selectors.forEach(function(selector) {
              document.querySelector(selector).classList.add('hidden');
          });
      }

  @endif
  document.addEventListener("DOMContentLoaded", function() {
      var calFromElement = document.querySelector('.calFrom');

      calFromElement.addEventListener('change', function() {
          var value = calFromElement.value;

          if (value === 'byStandard') {
              showElements(['#q1', '#q2', '#v1', '#v2', '#p']);
              hideElements(['#changeQ', '#changeV']);
          } else if (value === 'byChange') {
              showElements(['#changeQ', '#changeV', '#p']);
              hideElements(['#q1', '#q2', '#v1', '#v2']);
          }
      });

      function showElements(selectors) {
          selectors.forEach(function(selector) {
              document.querySelector(selector).classList.remove('hidden');
          });
      }

      function hideElements(selectors) {
          selectors.forEach(function(selector) {
              document.querySelector(selector).classList.add('hidden');
          });
      }
  });
  document.addEventListener("DOMContentLoaded", function() {
      var calFrom1Element = document.querySelector('.calFrom1');

      calFrom1Element.addEventListener('change', function() {
          var value = calFrom1Element.value;

          if (value === '2') {
              showElements(['#a_n', '#rA', '#b_n', '#rB', '#d_n', '#pD', '#e_n', '#pE']);
              hideElements(['#q1', '#q2', '#v1', '#v2', '#p', '#changeQ', '#changeV', '#c_n', '#rC', '#f_n', '#pF']);
          } else if (value === '3') {
              showElements(['#a_n', '#rA', '#b_n', '#rB', '#c_n', '#rC', '#d_n', '#pD', '#e_n', '#pE', '#f_n', '#pF']);
              hideElements(['#q1', '#q2', '#v1', '#v2', '#p', '#changeQ', '#changeV']);
          }
      });

      function showElements(selectors) {
          selectors.forEach(function(selector) {
              document.querySelector(selector).classList.remove('hidden');
          });
      }

      function hideElements(selectors) {
          selectors.forEach(function(selector) {
              document.querySelector(selector).classList.add('hidden');
          });
      }
  });
  document.addEventListener("DOMContentLoaded", function() {
      var checkElements = document.querySelectorAll('.check');

      checkElements.forEach(function(checkElement) {
          checkElement.addEventListener('input', function() {
              var getClass = checkElement.getAttribute('check');
              var chOkElement = document.querySelector('[chOk_value="' + getClass + '"]');

              if (checkElement.value !== '') {
                  chOkElement.value = checkElement.value;
                  var update_val = chOkElement.value;
                  if (update_val === null) {
                      chOkElement.value = 'none';
                  }
              } else if (checkElement.value === '') {
                  chOkElement.value = 'none';
              }
          });
      });
  });
  document.addEventListener("DOMContentLoaded", function() {
      var chOkElements = document.querySelectorAll('.chOk');
    var dataA = <?php echo $jsonDataA; ?>;
      chOkElements.forEach(function(element) {
          element.addEventListener('click', function() {
              var chOk = element.getAttribute('chok_value');
              var value = element.getAttribute('value');
              var text = element.textContent;
              if (chOk === 'rA') {
                  document.getElementById('new_rA').value = dataA[value];
              } else if (chOk === 'rB') {
                  var love = document.getElementById('newrB').value = dataA[value];
                  console.log(love);
              } else if (chOk === 'rC') {
                  document.getElementById('newrC').value = dataA[value];
              } else if (chOk === 'pD') {
                  document.getElementById('newpD').value = dataA[value];
              } else if (chOk === 'pE') {
                  document.getElementById('newpE').value = dataA[value];
              } else if (chOk === 'pF') {
                  document.getElementById('newpF').value = dataA[value];
              }
          });
      });
  });
</script>
@endpush
