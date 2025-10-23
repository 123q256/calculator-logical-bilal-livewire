<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="calculate_unit" class="label">{{ $lang['1'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <select name="calculate_unit" id="calculate_unit" class="input">
                        <option value="1"
                            {{ isset($_POST['calculate_unit']) && $_POST['calculate_unit'] == '1' ? 'selected' : '' }}>
                            {{ $lang['2'] }}  </option>
                        <option value="2"
                            {{ isset($_POST['calculate_unit']) && $_POST['calculate_unit'] == '2' ? 'selected' : '' }}>
                            NEC {{ $lang['3'] }} </option>
                        <option value="3"
                            {{ isset($_POST['calculate_unit']) && $_POST['calculate_unit'] == '3' ? 'selected' : '' }}>
                            {{ $lang['4'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 find hidden">
                <label for="find_unit" class="label">{{ $lang['5'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <select name="find_unit" id="find_unit" class="input">
                        <option value="1"
                            {{ isset($_POST['find_unit']) && $_POST['find_unit'] == '1' ? 'selected' : '' }}>
                            {{ $lang['6'] }} </option>
                        <option value="2"
                            {{ isset($_POST['find_unit']) && $_POST['find_unit'] == '2' ? 'selected' : '' }}>
                            {{ $lang['7'] }}</option>
                        <option value="3"
                            {{ isset($_POST['find_unit']) && $_POST['find_unit'] == '3' ? 'selected' : '' }}>
                            {{ $lang['8'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 wire_material">
                <label for="wire_material_unit" class="label">{{ $lang['9'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <select name="wire_material_unit" id="wire_material_unit" class="input">
                        <option value="cu"
                            {{ isset($_POST['wire_material_unit']) && $_POST['wire_material_unit'] == 'cu' ? 'selected' : '' }}>
                            {{ $lang['10'] }} </option>
                        <option value="al"
                            {{ isset($_POST['wire_material_unit']) && $_POST['wire_material_unit'] == 'al' ? 'selected' : '' }}>
                            {{ $lang['11'] }}</option>
                        <option value="cs"
                            {{ isset($_POST['wire_material_unit']) && $_POST['wire_material_unit'] == 'cs' ? 'selected' : '' }}>
                            {{ $lang['12'] }}</option>
                        <option value="es"
                            {{ isset($_POST['wire_material_unit']) && $_POST['wire_material_unit'] == 'es' ? 'selected' : '' }}>
                            {{ $lang['13'] }}</option>
                        <option value="go"
                            {{ isset($_POST['wire_material_unit']) && $_POST['wire_material_unit'] == 'go' ? 'selected' : '' }}>
                            {{ $lang['14'] }}</option>
                        <option value="ni"
                            {{ isset($_POST['wire_material_unit']) && $_POST['wire_material_unit'] == 'ni' ? 'selected' : '' }}>
                            {{ $lang['15'] }}</option>
                        <option value="nic"
                            {{ isset($_POST['wire_material_unit']) && $_POST['wire_material_unit'] == 'nic' ? 'selected' : '' }}>
                            {{ $lang['16'] }}</option>
                        <option value="si"
                            {{ isset($_POST['wire_material_unit']) && $_POST['wire_material_unit'] == 'si' ? 'selected' : '' }}>
                            {{ $lang['17'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 wire_material_two hidden">
                <label for="wire_material_unit_two" class="label">{{ $lang['9'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <select name="wire_material_unit_two" id="wire_material_unit_two" class="input">
                        <option value="0"
                            {{ isset($_POST['wire_material_unit_two']) && $_POST['wire_material_unit_two'] == '0' ? 'selected' : '' }}>
                            {{ $lang['10'] }} </option>
                        <option value="1"
                            {{ isset($_POST['wire_material_unit_two']) && $_POST['wire_material_unit_two'] == '1' ? 'selected' : '' }}>
                            {{ $lang['11'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 wire_resistivity ">
                <label for="resistivity" class="label">{{ $lang['18'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="resistivity" id="resistivity" class="input" aria-label="input" placeholder="1.72e-8" value="{{ isset($_POST['resistivity'])?$_POST['resistivity']:'1.72e-8' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 max_voltage_drop hidden">
                <label for="max_voltage_drop" class="label">{{ $lang['19'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="max_voltage_drop" id="max_voltage_drop" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['max_voltage_drop'])?$_POST['max_voltage_drop']:'1' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 wire_size hidden">
                <label for="wire_size_unit" class="label">{{ $lang['20'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <select name="wire_size_unit" id="wire_size_unit" class="input">
                        <option value="600" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '600' ? 'selected' : '' }}>600 kcmil</option>
                        <option value="500" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '500' ? 'selected' : '' }}>500 kcmil</option>
                        <option value="400" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '400' ? 'selected' : '' }}>400 kcmil</option>
                        <option value="350" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '350' ? 'selected' : '' }}>350 kcmil</option>
                        <option value="300" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '300' ? 'selected' : '' }}>300 kcmil</option>
                        <option value="250" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '250' ? 'selected' : '' }}>250 kcmil</option>
                        <option value="4/0" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '4/0' ? 'selected' : '' }}>4/0 AWG (212 kcmil)</option>
                        <option value="3/0" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '3/0' ? 'selected' : '' }}>3/0 AWG (168 kcmil)</option>
                        <option value="2/0" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '2/0' ? 'selected' : '' }}>2/0 AWG (133 kcmil)</option>
                        <option value="1/0" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '1/0' ? 'selected' : '' }}>1/0 AWG (106 kcmil)</option>
                        <option value="1" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '1' ? 'selected' : '' }}>1 AWG (83.7 kcmil)</option>
                        <option value="2" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '2' ? 'selected' : '' }}>2 AWG (66.4 kcmil)</option>
                        <option value="3" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '3' ? 'selected' : '' }}>3 AWG (52.6 kcmil)</option>
                        <option value="4" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '4' ? 'selected' : '' }}>4 AWG (41.7 kcmil)</option>
                        <option value="5" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '5' ? 'selected' : '' }}>5 AWG (33.1 kcmil)</option>
                        <option value="6" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '6' ? 'selected' : '' }}>6 AWG (26.3 kcmil)</option>
                        <option value="7" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '7' ? 'selected' : '' }}>7 AWG (20.8 kcmil)</option>
                        <option value="8" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '8' ? 'selected' : '' }}>8 AWG (16.5 kcmil)</option>
                        <option value="9" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '9' ? 'selected' : '' }}>9 AWG (13.1 kcmil)</option>
                        <option value="10" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '10' ? 'selected' : '' }}>10 AWG (10.4 kcmil)</option>
                        <option value="11" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '11' ? 'selected' : '' }}>11 AWG (8.23 kcmil)</option>
                        <option value="12" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '12' ? 'selected' : '' }}>12 AWG (6.53 kcmil)</option>
                        <option value="13" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '13' ? 'selected' : '' }}>13 AWG (5.18 kcmil)</option>
                        <option value="14" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '14' ? 'selected' : '' }}>14 AWG (4.11 kcmil)</option>
                        <option value="15" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '15' ? 'selected' : '' }}>15 AWG (3.26 kcmil)</option>
                        <option value="16" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '16' ? 'selected' : '' }}>16 AWG (2.58 kcmil)</option>
                        <option value="17" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '17' ? 'selected' : '' }}>17 AWG (2.05 kcmil)</option>
                        <option value="18" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '18' ? 'selected' : '' }}>18 AWG (1.62 kcmil)</option>
                        <option value="19" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '19' ? 'selected' : '' }}>19 AWG (1.29 kcmil)</option>
                        <option value="20" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '20' ? 'selected' : '' }}>20 AWG (1.02 kcmil)</option>
                        <option value="21" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '21' ? 'selected' : '' }}>21 AWG (0.810 kcmil)</option>
                        <option value="22" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '22' ? 'selected' : '' }}>22 AWG (0.642 kcmil)</option>
                        <option value="23" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '23' ? 'selected' : '' }}>23 AWG (0.509 kcmil)</option>
                        <option value="24" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '24' ? 'selected' : '' }}>24 AWG (0.404 kcmil)</option>
                        <option value="25" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '25' ? 'selected' : '' }}>25 AWG (0.320 kcmil)</option>
                        <option value="26" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '26' ? 'selected' : '' }}>26 AWG (0.254 kcmil)</option>
                        <option value="27" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '27' ? 'selected' : '' }}>27 AWG (0.202 kcmil)</option>
                        <option value="28" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '28' ? 'selected' : '' }}>28 AWG (0.160 kcmil)</option>
                        <option value="29" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '29' ? 'selected' : '' }}>29 AWG (0.127 kcmil)</option>
                        <option value="30" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '30' ? 'selected' : '' }}>30 AWG (0.101 kcmil)</option>
                        <option value="31" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '31' ? 'selected' : '' }}>31 AWG (0.0797 kcmil)</option>
                        <option value="32" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '32' ? 'selected' : '' }}>32 AWG (0.0632 kcmil)</option>
                        <option value="33" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '33' ? 'selected' : '' }}>33 AWG (0.0501 kcmil)</option>
                        <option value="34" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '34' ? 'selected' : '' }}>34 AWG (0.0398 kcmil)</option>
                        <option value="35" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '35' ? 'selected' : '' }}>35 AWG (0.0315 kcmil)</option>
                        <option value="36" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '36' ? 'selected' : '' }}>36 AWG (0.0250 kcmil)</option>
                        <option value="37" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '37' ? 'selected' : '' }}>37 AWG (0.0198 kcmil)</option>
                        <option value="38" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '38' ? 'selected' : '' }}>38 AWG (0.0157 kcmil)</option>
                        <option value="39" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '39' ? 'selected' : '' }}>39 AWG (0.0125 kcmil)</option>
                        <option value="40" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '40' ? 'selected' : '' }}>40 AWG (0.00989 kcmil)</option>
                        <option value="41" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '41' ? 'selected' : '' }}></option>
                        <option value="42" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '42' ? 'selected' : '' }}></option>
                        <option value="43" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '43' ? 'selected' : '' }}></option>
                        <option value="44" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '44' ? 'selected' : '' }}></option>
                        <option value="45" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '45' ? 'selected' : '' }}></option>
                        <option value="46" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '46' ? 'selected' : '' }}></option>
                        <option value="47" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '47' ? 'selected' : '' }}></option>
                        <option value="48" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '48' ? 'selected' : '' }}></option>
                        <option value="49" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '49' ? 'selected' : '' }}></option>
                        <option value="50" {{ isset($_POST['wire_size_unit']) && $_POST['wire_size_unit'] == '50' ? 'selected' : '' }}></option>
                    </select>
                    
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 cable_length ">
                <label for="cable_length" class="label">{{ $lang['21'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="cable_length" id="cable_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cable_length'])?$_POST['cable_length']:'300' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="cable_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cable_length_unit_dropdown')">{{ isset($_POST['cable_length_unit'])?$_POST['cable_length_unit']:'ft' }} ▾</label>
                   <input type="text" name="cable_length_unit" value="{{ isset($_POST['cable_length_unit'])?$_POST['cable_length_unit']:'ft' }}" id="cable_length_unit" class="hidden">
                   <div id="cable_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cable_length_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cable_length_unit', 'ft')">feet</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cable_length_unit', 'm')">meters</p>
                   </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 wire_length hidden">
                <label for="wire_length" class="label">{{ $lang['21'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="wire_length" id="wire_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wire_length'])?$_POST['wire_length']:'300' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="wire_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wire_length_unit_dropdown')">{{ isset($_POST['wire_length_unit'])?$_POST['wire_length_unit']:'cm' }} ▾</label>
                   <input type="text" name="wire_length_unit" value="{{ isset($_POST['wire_length_unit'])?$_POST['wire_length_unit']:'cm' }}" id="wire_length_unit" class="hidden">
                   <div id="wire_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wire_length_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wire_length_unit', 'cm')">cm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wire_length_unit', 'm')">m</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wire_length_unit', 'mm')">mm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wire_length_unit', 'in')">in</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wire_length_unit', 'ft')">ft</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wire_length_unit', 'yd')">yd</p>
                   </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 gauge hidden">
                <label for="gauge" class="label">{{ $lang['22'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="gauge" id="gauge" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['gauge'])?$_POST['gauge']:'50' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 wire_diameter_size">
                <label for="wire_diameter_size" class="label">{{ $lang['23'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="wire_diameter_size" id="wire_diameter_size" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wire_diameter_size'])?$_POST['wire_diameter_size']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="wire_diameter_size_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wire_diameter_size_unit_dropdown')">{{ isset($_POST['wire_diameter_size_unit'])?$_POST['wire_diameter_size_unit']:'AWG' }} ▾</label>
                   <input type="text" name="wire_diameter_size_unit" value="{{ isset($_POST['wire_diameter_size_unit'])?$_POST['wire_diameter_size_unit']:'AWG' }}" id="wire_diameter_size_unit" class="hidden">
                   <div id="wire_diameter_size_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wire_diameter_size_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wire_diameter_size_unit', 'AWG')">AWG</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wire_diameter_size_unit', 'inch')">inch</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wire_diameter_size_unit', 'mm')">mm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wire_diameter_size_unit', 'mm')">mm</p>
                   </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 load_current">
                <label for="load_current" class="label">{{ $lang['24'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="load_current" id="load_current" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['load_current'])?$_POST['load_current']:'1.2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="load_current_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('load_current_unit_dropdown')">{{ isset($_POST['load_current_unit'])?$_POST['load_current_unit']:'am' }} ▾</label>
                   <input type="text" name="load_current_unit" value="{{ isset($_POST['load_current_unit'])?$_POST['load_current_unit']:'am' }}" id="load_current_unit" class="hidden">
                   <div id="load_current_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="load_current_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('load_current_unit', 'am')">amps</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('load_current_unit', 'mi')">milliamps</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('load_current_unit', 'wa')">watts</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('load_current_unit', 'hp')">hp</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('load_current_unit', 'kW')">kW</p>
                   </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 conductors">
                <label for="conductors" class="label">{{ $lang['25'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="conductors" id="conductors" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['conductors'])?$_POST['conductors']:'1' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 voltage">
                <label for="voltage" class="label">{{ $lang['26'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="voltage" id="voltage" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['voltage'])?$_POST['voltage']:'220' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="voltage_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('voltage_unit_dropdown')">{{ isset($_POST['voltage_unit'])?$_POST['voltage_unit']:'volts' }} ▾</label>
                   <input type="text" name="voltage_unit" value="{{ isset($_POST['voltage_unit'])?$_POST['voltage_unit']:'volts' }}" id="voltage_unit" class="hidden">
                   <div id="voltage_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="voltage_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('voltage_unit', 'volts')">{{$lang[27]}}</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('voltage_unit', 'kilovolts')">{{$lang[28]}}</p>
                   </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 conduit">
                <label for="material_of_conduit" class="label">{{ $lang['29'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <select name="material_of_conduit" id="material_of_conduit" class="input">
                        <option value="pvc"
                            {{ isset($_POST['material_of_conduit']) && $_POST['material_of_conduit'] == 'pvc' ? 'selected' : '' }}>
                            PVC</option>
                        <option value="aluminium"
                            {{ isset($_POST['material_of_conduit']) && $_POST['material_of_conduit'] == 'm' ? 'selected' : '' }}>
                            {{$lang[11]}}</option>
                        <option value="steel"
                        {{ isset($_POST['material_of_conduit']) && $_POST['material_of_conduit'] == 'steel' ? 'selected' : '' }}>
                        {{$lang[30]}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 power_factor hidden">
                <label for="power_voltage" class="label">{{ $lang['31'] }} (PF):</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="power_voltage" id="power_voltage" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['power_voltage'])?$_POST['power_voltage']:'0.1' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 wire_resistance hidden">
                <label for="wire_resistance" class="label">{{ $lang['32'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="wire_resistance" id="wire_resistance" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wire_resistance'])?$_POST['wire_resistance']:'1.29' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="wire_resistance_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wire_resistance_unit_dropdown')">{{ isset($_POST['wire_resistance_unit'])?$_POST['wire_resistance_unit']:'km' }} ▾</label>
                   <input type="text" name="wire_resistance_unit" value="{{ isset($_POST['wire_resistance_unit'])?$_POST['wire_resistance_unit']:'km' }}" id="wire_resistance_unit" class="hidden">
                   <div id="wire_resistance_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wire_resistance_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wire_resistance_unit', 'km')">Ω/km<</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wire_resistance_unit', 'm')">Ω/m</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wire_resistance_unit', 'tft')">Ω/1000f</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wire_resistance_unit', 'hft')">Ω/ft</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wire_resistance_unit', 'mqm')">mΩ/m</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wire_resistance_unit', 'mft')">mΩ/ft</p>
                   </div>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 phase">
                <label for="phase_unit" class="label">{{ $lang['33'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <select name="phase_unit" id="phase_unit" class="input">
                        <option value="1" {{ isset($_POST['phase_unit']) && $_POST['phase_unit'] == '1' ? 'selected' : '' }}>DC</option>
                        <option value="2" {{ isset($_POST['phase_unit']) && $_POST['phase_unit'] == '2' ? 'selected' : '' }}> AC single-phase</option>
                        <option value="3" {{ isset($_POST['phase_unit']) && $_POST['phase_unit'] == '3' ? 'selected' : '' }}> AC three-phase</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 insulation">
                <label for="insulation" class="label">{{ $lang['34'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <select name="insulation" id="insulation" class="input">
                        <option value="0" {{ isset($_POST['insulation']) && $_POST['insulation'] == '0' ? 'selected' : '' }}>60&deg</option>
                        <option value="1" {{ isset($_POST['insulation']) && $_POST['insulation'] == '1' ? 'selected' : '' }}> 75&degC</option>
                        <option value="2" {{ isset($_POST['insulation']) && $_POST['insulation'] == '2' ? 'selected' : '' }}> 90&degC</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 installation">
                <label for="raceway" class="label">{{ $lang['35'] }}</label>
                <div class="w-100 py-2 position-relative">
                    <select name="raceway" id="raceway" class="input">
                        <option value="0" {{ isset($_POST['raceway']) && $_POST['raceway'] == '0' ? 'selected' : '' }}>Raceway</option>
                        <option value="0" {{ isset($_POST['raceway']) && $_POST['raceway'] == '0' ? 'selected' : '' }}> Cable</option>
                        <option value="0" {{ isset($_POST['raceway']) && $_POST['raceway'] == '0' ? 'selected' : '' }}> Burried in Earth</option>
                        <option value="1" {{ isset($_POST['raceway']) && $_POST['raceway'] == '1' ? 'selected' : '' }}> Open Air</option>
                    </select>
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
                    <div class="w-full md:w-[70%] lg:w-[70%] overflow-auto mt-2">
                        <table class="w-full text-[18px]">
                            @if(isset($detail['voltage_drop_formula']) && $detail['voltage_drop_formula']!="")
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[36] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['voltage_drop_formula'] }} ({{$lang[37]}})</td>
                                </tr>
                            @endif
                            @if(isset($detail['voltage_drop_formula']) && $detail['voltage_drop_formula']!="")
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[38] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['voltage_drop_percentage'] }} (%)</td>
                                </tr>
                            @endif
                            @if(isset($detail['wire_resistance']) && $detail['wire_resistance']!="")
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[39] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['wire_resistance'] }} (Ω)</td>
                                </tr>
                            @endif
                            @if(isset($detail['voltage']) && $detail['voltage']!="")
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[40] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['voltage']-$detail['voltage_drop_formula'] }} ({{$lang[37]}})</td>
                                </tr>
                            @endif
                            @if(isset($detail['wiresize']) && $detail['wiresize']!="")
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[20] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['wiresize'] }}</td>
                                </tr>
                            @endif
                            @if(isset($detail['final']) && $detail['final']!="")
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[41] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['final'] }}</td>
                                </tr>
                            @endif
                            @if(isset($detail['vv']) && $detail['vv']!="")
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[42] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['vv'] }} (ft)</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[42] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['vv']*0.3048 }} (m)</td>
                                </tr>
                            @endif
                            @if(isset($detail['din']) && $detail['din']!="" && isset($detail['dmm']) && $detail['dmm']!="" )
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[43] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['din'] }} (ft)</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[43] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['dmm']*0.3048 }} (m)</td>
                                </tr>
                            @endif
                            @if(isset($detail['amil']) && $detail['amil']!="" && isset($detail['ain']) && $detail['ain']!="" && isset($detail['amm']) && $detail['amm']!="")
                            <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[44] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['amil'] }} (kmcil)</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[44] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['ain'] }} (in2)</td>
                                </tr>
                                <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[44] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['amm'] }} (mm2)</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var wireMaterialUnits = document.querySelectorAll("#wire_material_unit, #wire_material_two");

        wireMaterialUnits.forEach(function(element) {
            element.addEventListener("change", function() {
                var a = this.value;
                var resistivityInput = document.getElementById("resistivity");

                if (a == "cu") {
                    resistivityInput.value = "1.72e-8";
                } else if (a == "al") {
                    resistivityInput.value = "2.82e-8";
                } else if (a == "cs") {
                    resistivityInput.value = "1.43e-7";
                } else if (a == "es") {
                    resistivityInput.value = "4.6e-7";
                } else if (a == "go") {
                    resistivityInput.value = "2.44e-8";
                } else if (a == "ni") {
                    resistivityInput.value = "1.1e-6";
                } else if (a == "nic") {
                    resistivityInput.value = "6.99e-8";
                } else if (a == "si") {
                    resistivityInput.value = "1.59e-8";
                }
            });
        });
    });

    @if(isset($detail))
            document.addEventListener("DOMContentLoaded", function() {
                var wireMaterialUnit = document.getElementById("wire_material_unit");
                var wireMaterialTwo = document.getElementById("wire_material_two");
                var resistivityInput = document.getElementById("resistivity");
                var a = null;

                if (wireMaterialUnit && !wireMaterialUnit.classList.contains('hidden')) {
                    a = "{{ isset($_POST['wire_material_unit']) ? $_POST['wire_material_unit'] : '' }}";
                } else if (wireMaterialTwo && !wireMaterialTwo.classList.contains('hidden')) {
                    a = "{{ isset($_POST['wire_material_two']) ? $_POST['wire_material_two'] : '' }}";
                }

                if (a !== null) {
                    if (a === "cu") {
                        resistivityInput.value = "1.72e-8";
                    } else if (a === "al") {
                        resistivityInput.value = "2.82e-8";
                    } else if (a === "cs") {
                        resistivityInput.value = "1.43e-7";
                    } else if (a === "es") {
                        resistivityInput.value = "4.6e-7";
                    } else if (a === "go") {
                        resistivityInput.value = "2.44e-8";
                    } else if (a === "ni") {
                        resistivityInput.value = "1.1e-6";
                    } else if (a === "nic") {
                        resistivityInput.value = "6.99e-8";
                    } else if (a === "si") {
                        resistivityInput.value = "1.59e-8";
                    }
                }
            });
    @endif

    @if(isset($error))
            document.addEventListener("DOMContentLoaded", function() {
                var wireMaterialUnit = document.getElementById("wire_material_unit");
                var wireMaterialTwo = document.getElementById("wire_material_two");
                var resistivityInput = document.getElementById("resistivity");
                var a = null;

                if (wireMaterialUnit && !wireMaterialUnit.classList.contains('hidden')) {
                    a = "{{ isset($_POST['wire_material_unit']) ? $_POST['wire_material_unit'] : '' }}";
                } else if (wireMaterialTwo && !wireMaterialTwo.classList.contains('hidden')) {
                    a = "{{ isset($_POST['wire_material_two']) ? $_POST['wire_material_two'] : '' }}";
                }

                if (a !== null) {
                    if (a === "cu") {
                        resistivityInput.value = "1.72e-8";
                    } else if (a === "al") {
                        resistivityInput.value = "2.82e-8";
                    } else if (a === "cs") {
                        resistivityInput.value = "1.43e-7";
                    } else if (a === "es") {
                        resistivityInput.value = "4.6e-7";
                    } else if (a === "go") {
                        resistivityInput.value = "2.44e-8";
                    } else if (a === "ni") {
                        resistivityInput.value = "1.1e-6";
                    } else if (a === "nic") {
                        resistivityInput.value = "6.99e-8";
                    } else if (a === "si") {
                        resistivityInput.value = "1.59e-8";
                    }
                }
            });
    @endif
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("calculate_unit").addEventListener("change", function() {
            var data = this.value;

            var hideElements = function(elements) {
                elements.forEach(function(el) {
                    document.querySelectorAll(el).forEach(function(e) {
                        e.classList.add("hidden");
                    });
                });
            };

            var showElements = function(elements) {
                elements.forEach(function(el) {
                    document.querySelectorAll(el).forEach(function(e) {
                        e.classList.remove("hidden");
                    });
                });
            };

            if (data == "1") {
                hideElements([
                    ".conduit", ".cable_length", ".power_factor", ".gauge", ".find", ".max_voltage_drop", 
                    ".wire_size", ".wire_resistance", ".wire_material_two"
                ]);
                showElements([
                    ".wire_length", ".wire_material", ".wire_material_two", ".wire_diameter_size", ".wire_resistivity"
                ]);
            } else if (data == "2") {

                showElements([
                    ".power_factor", ".conduit", ".cable_length", ".wire_diameter_size", ".wire_resistivity", 
                    ".wire_material_two", ".max_voltage_drop", ".gauge", ".find"
                ]);
                hideElements([
                    ".wire_resistance", ".wire_size", ".wire_length", ".wire_material" ,".wire_diameter_size"
                ]);
            } else if (data == "3") {
                showElements([
                    ".wire_resistance", ".wire_length"
                ]);
                hideElements([
                    ".wire_material", ".wire_size", ".power_factor", ".conduit", ".wire_resistivity", 
                    ".find", ".wire_material_two", ".gauge", ".max_voltage_drop", ".wire_diameter_size", ".cable_length"
                ]);
            }
        });
    });

    @if(isset($detail))
            var data = "{{$_POST['calculate_unit']}}";
            var hideElements = function(elements) {
                elements.forEach(function(el) {
                    document.querySelectorAll(el).forEach(function(e) {
                        e.classList.add("hidden");
                    });
                });
            };

            var showElements = function(elements) {
                elements.forEach(function(el) {
                    document.querySelectorAll(el).forEach(function(e) {
                        e.classList.remove("hidden");
                    });
                });
            };
            if (data == "1") {
                hideElements([
                    ".conduit", ".cable_length", ".power_factor", ".gauge", ".find", ".max_voltage_drop", 
                    ".wire_size", ".wire_resistance", ".wire_material_two"
                ]);
                showElements([
                    ".wire_length", ".wire_material", ".wire_diameter_size", ".wire_resistivity"
                ]);
            } else if (data == "2") {
                showElements([
                    ".power_factor", ".conduit", ".cable_length", ".wire_diameter_size", ".wire_resistivity", 
                    ".wire_material_two", ".max_voltage_drop", ".gauge", ".find"
                ]);
                hideElements([
                    ".wire_resistance", ".wire_size", ".wire_length", ".wire_material" ,".wire_diameter_size"
                ]);
            } else if (data == "3") {
                showElements([
                    ".wire_resistance", ".wire_length"
                ]);
                hideElements([
                    ".wire_material", ".wire_size", ".power_factor", ".conduit", ".wire_resistivity", 
                    ".find", ".wire_material_two", ".gauge", ".max_voltage_drop", ".wire_diameter_size", ".cable_length"
                ]);
            }

    @endif

    @if(isset($error))
        var data = "{{$_POST['calculate_unit']}}";

        var hideElements = function(elements) {
                elements.forEach(function(el) {
                    document.querySelectorAll(el).forEach(function(e) {
                        e.classList.add("hidden");
                    });
                });
            };

            var showElements = function(elements) {
                elements.forEach(function(el) {
                    document.querySelectorAll(el).forEach(function(e) {
                        e.classList.remove("hidden");
                    });
                });
            };

            if (data == "1") {
                hideElements([
                    ".conduit", ".cable_length", ".power_factor", ".gauge", ".find", ".max_voltage_drop", 
                    ".wire_size", ".wire_resistance", ".wire_material_two"
                ]);
                showElements([
                    ".wire_length", ".wire_material", ".wire_material_two", ".wire_diameter_size", ".wire_resistivity"
                ]);
            } else if (data == "2") {
                showElements([
                    ".power_factor", ".conduit", ".cable_length", ".wire_diameter_size", ".wire_resistivity", 
                    ".wire_material_two", ".max_voltage_drop", ".gauge", ".find"
                ]);
                hideElements([
                    ".wire_resistance", ".wire_size", ".wire_length", ".wire_material",".wire_diameter_size"
                ]);
            } else if (data == "3") {
                showElements([
                    ".wire_resistance", ".wire_length"
                ]);
                hideElements([
                    ".wire_material", ".wire_size", ".power_factor", ".conduit", ".wire_resistivity", 
                    ".find", ".wire_material_two", ".gauge", ".max_voltage_drop", ".wire_diameter_size", ".cable_length"
                ]);
            }
            
    @endif

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("find_unit").addEventListener("change", function() {
            var find = this.value;
        });
    });
</script>
@endpush

<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>