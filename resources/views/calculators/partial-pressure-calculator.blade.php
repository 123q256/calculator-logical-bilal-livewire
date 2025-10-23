<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
                <div class="space-y-2 relative">
                    <label for="formula" class="label">{!! $lang['1'] !!}:</label>
                    <select name="formula" id="formula" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = ["Dalton's law","Ideal gas law","Henry's law - method 1","Henry's law - method 2"];
                            $val = ["1","2","3","4"];
                            optionsList($val,$name,isset(request()->formula)?request()->formula:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="formula1 ">
                <div class="grid grid-cols-2  mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4 ">
                    <div class="space-y-2">
                        <label for="to_cal1" class="label">{!! $lang['2'] !!}:</label>
                            <select name="to_cal1" id="to_cal1" class="input">
                                @php
                                    $name = [$lang[3],$lang[4],$lang[5]];
                                    $val = ["1","2","3"];
                                    optionsList($val,$name,isset(request()->to_cal1)?request()->to_cal1:'1');
                                @endphp
                            </select>
                    </div>
                    <div class="space-y-2 total">
                        <label for="total" class="label">{{ $lang['5'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="total" id="total" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['total'])?$_POST['total']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="total_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('total_unit_dropdown')">{{ isset($_POST['total_unit'])?$_POST['total_unit']:'Pa' }} ▾</label>
                            <input type="text" name="total_unit" value="{{ isset($_POST['total_unit'])?$_POST['total_unit']:'Pa' }}" id="total_unit" class="hidden">
                            <div id="total_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_unit', 'Pa')">Pa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_unit', 'Bar')">Bar</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_unit', 'Torr')">Torr</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_unit', 'psi')">psi</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_unit', 'atm')">atm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_unit', 'hPa')">hPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_unit', 'MPa')">MPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_unit', 'kPa')">kPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_unit', 'GPa')">GPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_unit', 'mmHg')">mmHg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('total_unit', 'in Hg')">in Hg</p>
                            </div>
                        </div>
                        </div>
                    
                    <div class="space-y-2 mole">
                        <label for="mole" class="label">{!! $lang['4'] !!}:</label>
                            <input type="number" step="any" name="mole" id="mole" class="input" min="0" max="1" aria-label="input" placeholder="00" value="{{ isset(request()->mole)?request()->mole:'' }}" />
                    </div>
                    <div class="space-y-2 partial">
                        <label for="partial" class="label">{{ $lang['3'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="partial" id="partial" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['partial'])?$_POST['partial']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="part_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('part_unit_dropdown')">{{ isset($_POST['part_unit'])?$_POST['part_unit']:'Pa' }} ▾</label>
                            <input type="text" name="part_unit" value="{{ isset($_POST['part_unit'])?$_POST['part_unit']:'Pa' }}" id="part_unit" class="hidden">
                            <div id="part_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit', 'Pa')">Pa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit', 'Bar')">Bar</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit', 'Torr')">Torr</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit', 'psi')">psi</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit', 'atm')">atm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit', 'hPa')">hPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit', 'MPa')">MPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit', 'kPa')">kPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit', 'GPa')">GPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit', 'mmHg')">mmHg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit', 'in Hg')">in Hg</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="formula2 hidden">
                 <div class="grid grid-cols-2  mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4  ">
                    <div class="space-y-2">
                        <label for="to_cal2" class="label">{!! $lang['2'] !!}:</label>
                            <select name="to_cal2" id="to_cal2" class="input">
                                @php
                                    $name = [$lang[3],$lang[8],$lang[7],$lang[12]];
                                    $val = ["1","2","3","4"];
                                    optionsList($val,$name,isset(request()->to_cal2)?request()->to_cal2:'1');
                                @endphp
                            </select>
                    </div>
                    <div class="space-y-2 amole ">
                        <label for="amole" class="label">{!! $lang['6'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="amole" id="amole" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->amole)?request()->amole:'' }}" />
                            <span class="text-blue input_unit">mol</span>
                        </div>
                    </div>
                    <div class="space-y-2 temp">
                        <label for="temp" class="label">{{ $lang['7'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="temp" id="temp" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['temp'])?$_POST['temp']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="temp_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('temp_unit_dropdown')">{{ isset($_POST['temp_unit'])?$_POST['temp_unit']:'°C' }} ▾</label>
                            <input type="text" name="temp_unit" value="{{ isset($_POST['temp_unit'])?$_POST['temp_unit']:'°C' }}" id="temp_unit" class="hidden">
                            <div id="temp_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_unit', '°C')">°C</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_unit', '°F')">°F</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temp_unit', 'K')">K</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 volume">
                        <label for="volume" class="label">{{ $lang['8'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="volume" id="volume" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['volume'])?$_POST['volume']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="vol_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('vol_unit_dropdown')">{{ isset($_POST['vol_unit'])?$_POST['vol_unit']:'mm³' }} ▾</label>
                            <input type="text" name="vol_unit" value="{{ isset($_POST['vol_unit'])?$_POST['vol_unit']:'mm³' }}" id="vol_unit" class="hidden">
                            <div id="vol_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'mm³')">mm³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'cm³')">cm³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'dm³')">dm³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'm³')">m³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'in³')">in³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'ft³')">ft³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'yd³')">yd³</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vol_unit', 'litre')">litre</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 partial1">
                        <label for="partial1" class="label">{{ $lang['3'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="partial1" id="partial1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['partial1'])?$_POST['partial1']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="part_unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('part_unit1_dropdown')">{{ isset($_POST['part_unit1'])?$_POST['part_unit1']:'Pa' }} ▾</label>
                            <input type="text" name="part_unit1" value="{{ isset($_POST['part_unit1'])?$_POST['part_unit1']:'Pa' }}" id="part_unit1" class="hidden">
                            <div id="part_unit1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit1', 'Pa')">Pa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit1', 'Bar')">Bar</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit1', 'Torr')">Torr</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit1', 'psi')">psi</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit1', 'atm')">atm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit1', 'hPa')">hPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit1', 'MPa')">MPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit1', 'kPa')">kPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit1', 'GPa')">GPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit1', 'mmHg')">mmHg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit1', 'in Hg')">in Hg</p>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="henry1 hidden">
               <div class="grid grid-cols-2  mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4  ">
                    <div class="space-y-2">
                        <label for="to_cal3" class="label">{!! $lang['2'] !!}:</label>
                            <select name="to_cal3" id="to_cal3" class="input">
                                @php
                                    $name = [$lang[3],$lang[9]];
                                    $val = ["1","2"];
                                    optionsList($val,$name,isset(request()->to_cal3)?request()->to_cal3:'1');
                                @endphp
                            </select>
                    </div>
                    <div class="space-y-2">
                        <label for="gas" class="label">{!! $lang['10'] !!}:</label>
                            <select name="gas" id="gas" class="input">
                                @php
                                    $name = [$lang[13],$lang[14],$lang[15],$lang[16],$lang[17],$lang[18],$lang[19],$lang[20],$lang[21]];
                                    $val = ["1","2","3","4","5","6","7","8","9"];
                                    optionsList($val,$name,isset(request()->gas)?request()->gas:'1');
                                @endphp
                            </select>
                    </div>
                    <div class="space-y-2 const">
                        <label for="cons" class="label">{!! $lang['22'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="cons" id="cons" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->cons)?request()->cons:'' }}" />
                            <span class="text-blue input-unit">litre*atm/mol</span>
                        </div>
                    </div>
                    <div class="space-y-2 conc">
                        <label for="conc" class="label">{{ $lang['9'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="conc" id="conc" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['conc'])?$_POST['conc']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="conc_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('conc_unit_dropdown')">{{ isset($_POST['conc_unit'])?$_POST['conc_unit']:'Pa' }} ▾</label>
                            <input type="text" name="conc_unit" value="{{ isset($_POST['conc_unit'])?$_POST['conc_unit']:'Pa' }}" id="conc_unit" class="hidden">
                            <div id="conc_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('conc_unit', 'M')">M</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('conc_unit', 'mM')">mM</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('conc_unit', 'μM')">μM</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('conc_unit', 'nM')">nM</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('conc_unit', 'pM')">pM</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('conc_unit', 'fM')">fM</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('conc_unit', 'aM')">aM</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('conc_unit', 'zM')">zM</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('conc_unit', 'yM')">yM</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 partial2">
                        <label for="partial2" class="label">{{ $lang['3'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="partial2" id="partial2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['partial2'])?$_POST['partial2']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="part_unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('part_unit2_dropdown')">{{ isset($_POST['part_unit2'])?$_POST['part_unit2']:'Pa' }} ▾</label>
                            <input type="text" name="part_unit2" value="{{ isset($_POST['part_unit2'])?$_POST['part_unit2']:'Pa' }}" id="part_unit2" class="hidden">
                            <div id="part_unit2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit2', 'Pa')">Pa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit2', 'Bar')">Bar</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit2', 'Torr')">Torr</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit2', 'psi')">psi</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit2', 'atm')">atm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit2', 'hPa')">hPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit2', 'MPa')">MPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit2', 'kPa')">kPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit2', 'GPa')">GPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit2', 'mmHg')">mmHg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit2', 'in Hg')">in Hg</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="henry2 hidden">
               <div class="grid grid-cols-2  mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4 ">
                    <div class="space-y-2">
                        <label for="to_cal4" class="label">{!! $lang['2'] !!}:</label>
                            <select name="to_cal4" id="to_cal4" class="input">
                                @php
                                    $name = [$lang[3],$lang[4]];
                                    $val = ["1","2"];
                                    optionsList($val,$name,isset(request()->to_cal4)?request()->to_cal4:'1');
                                @endphp
                            </select>
                    </div>
                    <div class="space-y-2">
                        <label for="gas1" class="label">{!! $lang['10'] !!}:</label>
                            <select name="gas1" id="gas1" class="input">
                                @php
                                    $name = [$lang[13],$lang[14],$lang[15],$lang[16],$lang[17],$lang[18],$lang[19],$lang[20],$lang[21]];
                                    $val = ["1","2","3","4","5","6","7","8","9"];
                                    optionsList($val,$name,isset(request()->gas1)?request()->gas1:'1');
                                @endphp
                            </select>
                    </div>
                    <div class="space-y-2 cons1">
                        <label for="cons1" class="label">{!! $lang['22'] !!}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="cons1" id="cons1" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cons1'])?$_POST['cons1']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="cons1_unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cons1_unit2_dropdown')">{{ isset($_POST['cons1_unit2'])?$_POST['cons1_unit2']:'Pa' }} ▾</label>
                            <input type="text" name="cons1_unit2" value="{{ isset($_POST['cons1_unit2'])?$_POST['cons1_unit2']:'Pa' }}" id="cons1_unit2" class="hidden">
                            <div id="cons1_unit2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cons1_unit2', 'Pa')">Pa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cons1_unit2', 'Bar')">Bar</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cons1_unit2', 'Torr')">Torr</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cons1_unit2', 'psi')">psi</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cons1_unit2', 'atm')">atm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cons1_unit2', 'hPa')">hPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cons1_unit2', 'MPa')">MPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cons1_unit2', 'kPa')">kPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cons1_unit2', 'GPa')">GPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cons1_unit2', 'mmHg')">mmHg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cons1_unit2', 'in Hg')">in Hg</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 mole1">
                        <label for="mole1" class="label">{!! $lang['4'] !!}:</label>
                            <input type="number" step="any" name="mole1" id="mole1" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->mole1)?request()->mole1:'' }}" />
                    </div>
                    <div class="space-y-2 partial3">
                        <label for="partial3" class="label">{{ $lang['3'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="partial3" id="partial3" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['partial3'])?$_POST['partial3']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="part_unit3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('part_unit3_dropdown')">{{ isset($_POST['part_unit3'])?$_POST['part_unit3']:'Pa' }} ▾</label>
                            <input type="text" name="part_unit3" value="{{ isset($_POST['part_unit3'])?$_POST['part_unit3']:'Pa' }}" id="part_unit3" class="hidden">
                            <div id="part_unit3_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit3', 'Pa')">Pa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit3', 'Bar')">Bar</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit3', 'Torr')">Torr</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit3', 'psi')">psi</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit3', 'atm')">atm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit3', 'hPa')">hPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit3', 'MPa')">MPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit3', 'kPa')">kPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit3', 'GPa')">GPa</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit3', 'mmHg')">mmHg</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('part_unit3', 'in Hg')">in Hg</p>
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
                <div class="w-full   p-3 rounded mt-3">
                    @php
                        $ans=$detail['ans'];
                        if(request()->cal==='c1'){
                            $head=$lang['6']." (".$lang['3'].")";
                        }elseif(request()->cal==='v1'){
                            $head=$lang['4']." (".$lang['3'].")";
                        }elseif(request()->cal==='c2'){
                            $head=$lang['6']." (".$lang['5'].")";
                        }elseif(request()->cal==='v2'){
                            $head=$lang['4']." (".$lang['5'].")";
                        }
                    @endphp
                    <div class="w-full text-center">
                        @if($detail['mode']===1)
                          <p class="text-[16px]">{{ $lang[3] }}</p>
                          <p><strong class="text-[#119154] text-[26px]">{{ $detail['ans'] }}<span class="text-[#119154] font-s-22"> {{ $detail['unit'] }}</span></strong></p>
                        @elseif($detail['mode']===2)
                          <p class="text-[16px]">{{ $lang[4] }}</p>
                          <p><strong class="text-[#119154] text-[26px]">{{ $detail['ans'] }}</strong></p>
                          @if($detail['ans']>1)
                            <p class="text-red">{{ $lang[11] }} 1</p>
                          @endif
                        @elseif($detail['mode']===3)
                          <p class="text-[16px]">{{ $lang[5] }}</p>
                          <p><strong class="text-[#119154] text-[26px]">{{ $detail['ans'] }}<span class="text-[#119154] font-s-22"> {{ $detail['unit'] }}</span></strong></p>
                        @elseif($detail['mode']===4)
                          <p class="text-[16px]">{{ $lang[3] }}</p>
                          <p><strong class="text-[#119154] text-[26px]">{{ $detail['ans'] }}<span class="text-[#119154] font-s-22"> Pa</span></strong></p>
                        @elseif($detail['mode']===5)
                          <p class="text-[16px]">{{ $lang[8] }}</p>
                          <p><strong class="text-[#119154] text-[26px]">{{ $detail['ans'] }}<span class="text-[#119154] font-s-22"> m³</span></strong></p>
                        @elseif($detail['mode']===6)
                          <p class="text-[16px]">{{ $lang[7] }}</p>
                          <p><strong class="text-[#119154] text-[26px]">{{ $detail['ans'] }}<span class="text-[#119154] font-s-22"> K</span></strong></p>
                        @elseif($detail['mode']===7)
                          <p class="text-[16px]">{{ $lang[12] }}</p>
                          <p><strong class="text-[#119154] text-[26px]">{{ $detail['ans'] }}<span class="text-[#119154] font-s-22"> mol</span></strong></p>
                        @elseif($detail['mode']===8)
                          <p class="text-[16px]">{{ $lang[9] }}</p>
                          <p><strong class="text-[#119154] text-[26px]">{{ $detail['ans'] }}<span class="text-[#119154] font-s-22"> M</span></strong></p>
                        @endif
                    </div>
                </div>
                </div>
            </div>
        </div>

        
    @endisset
    @push('calculatorJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                updateGas1Visibility();
                updateToCalVisibility();
                updateToCal2Visibility();
                updateToCal3Visibility();
                updateGasVisibility();
                updateFormulaVisibility();
                updateToCal4Visibility();

                document.querySelector('#formula').addEventListener('change', updateFormulaVisibility);
                document.querySelector('#to_cal1').addEventListener('change', updateToCalVisibility);
                document.querySelector('#to_cal2').addEventListener('change', updateToCal2Visibility);
                document.querySelector('#to_cal3').addEventListener('change', updateToCal3Visibility);
                document.querySelector('#gas').addEventListener('change', updateGasVisibility); 
                document.querySelector('#to_cal4').addEventListener('change', updateToCal4Visibility);
                document.querySelector('#gas1').addEventListener('change', updateGas1Visibility);

                function updateFormulaVisibility() {
                    let formula = document.querySelector('#formula').value;

                    let classGroups = [
                        ['formula1'],
                        ['formula2'],
                        ['henry1'],
                        ['henry2']
                    ];

                    classGroups.forEach((group, index) => {
                        if (formula == index + 1) {
                            showElements(group);
                            classGroups.filter((_, i) => i !== index).forEach(hideElements);
                        }
                    });
                }

                function showElements(classes) {
                    classes.forEach(cls => {
                        document.querySelectorAll(`.${cls}`).forEach(el => {
                            el.style.display = 'block';
                        });
                    });
                }

                function hideElements(classes) {
                    classes.forEach(cls => {
                        document.querySelectorAll(`.${cls}`).forEach(el => {
                            el.style.display = 'none';
                        });
                    });
                }

                function updateToCalVisibility() {
                    let to_cal = document.querySelector('#to_cal1').value;

                    if (to_cal == 1) {
                        showElements(['total', 'mole']);
                        hideElements(['partial']);
                    } else if (to_cal == 2) {
                        showElements(['total', 'partial']);
                        hideElements(['mole']);
                    } else if (to_cal == 3) {
                        showElements(['mole', 'partial']);
                        hideElements(['total']);
                    }
                }

                function updateToCal2Visibility() {
                    let to_cal = document.querySelector('#to_cal2').value;

                    if (to_cal == 1) {
                        showElements(['temp', 'amole', 'volume']);
                        hideElements(['partial1']);
                    } else if (to_cal == 2) {
                        showElements(['temp', 'amole', 'partial1']);
                        hideElements(['volume']);
                    } else if (to_cal == 3) {
                        showElements(['volume', 'amole', 'partial1']);
                        hideElements(['temp']);
                    } else if (to_cal == 4) {
                        showElements(['volume', 'temp', 'partial1']);
                        hideElements(['amole']);
                    }
                }

                function updateToCal3Visibility() {
                    let to_cal = document.querySelector('#to_cal3').value;

                    if (to_cal == 1) {
                        showElements(['conc']);
                        hideElements(['partial2']);
                    } else if (to_cal == 2) {
                        hideElements(['conc']);
                        showElements(['partial2']);
                    }
                }

                function updateGasVisibility() {
                    let gas = document.querySelector('#gas').value;

                    if (gas == 9) {
                        showElements(['const']);
                    } else {
                        hideElements(['const']);
                    }
                }

                function updateToCal4Visibility() {
                    let to_cal4 = document.querySelector('#to_cal4').value;

                    if (to_cal4 == 1) {
                        showElements(['mole1']);
                        hideElements(['partial3']);
                    } else if (to_cal4 == 2) {
                        hideElements(['mole1']);
                        showElements(['partial3']);
                    }
                }

                function updateGas1Visibility() {
                    let gas1 = document.querySelector('#gas1').value;

                    if (gas1 == 9) {
                        showElements(['const1']);
                    } else {
                        hideElements(['const1']);
                    }
                }
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>