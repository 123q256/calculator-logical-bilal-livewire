<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
          
                <div class="grid grid-cols-1    gap-4">
                    <div class="space-y-2 relative">
                        <label for="point_unit" class="label">{!! $lang['1'] !!}:</label>
                        <select name="point_unit" id="point_unit" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['11'], $lang['12'], $lang['13']];
                                $val = [$lang['11'], $lang['12'], $lang['13']];
                                optionsList($val,$name,isset(request()->point_unit)?request()->point_unit:$lang['11']);
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="w-full mt-4" id="first">
                    <div class="grid grid-cols-2 mt-4  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2">
                            <label for="products" class="label">{{ $lang['2'] }}:</label>>
                            <div class="relative w-full ">
                                <input type="number" name="products" id="products" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['products'])?$_POST['products']:'80' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="products_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('products_unit_dropdown')">{{ isset($_POST['products_unit'])?$_POST['products_unit']:'j/mol*K' }} ▾</label>
                                <input type="text" name="products_unit" value="{{ isset($_POST['products_unit'])?$_POST['products_unit']:'j/mol*K' }}" id="products_unit" class="hidden">
                                <div id="products_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="products_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('products_unit', 'j/mol*K')">j/mol*K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('products_unit', 'kj/mol*K')">kj/mol*K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('products_unit', 'mj/mol*K')">mj/mol*K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('products_unit', 'wh/mol*K')">wh/mol*K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('products_unit', 'kwh/mol*K')">kwh/mol*K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('products_unit', 'ft-lb/mol*K')">ft-lb/mol*K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('products_unit', 'cal/mol*K')">cal/mol*K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('products_unit', 'kcal/mol*K')">kcal/mol*K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('products_unit', 'ev/mol*K')">ev/mol*K</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="reactants" class="label">{{ $lang['3'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="reactants" id="reactants" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['reactants'])?$_POST['reactants']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="reactants_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('reactants_unit_dropdown')">{{ isset($_POST['reactants_unit'])?$_POST['reactants_unit']:'j/mol*K' }} ▾</label>
                                <input type="text" name="reactants_unit" value="{{ isset($_POST['reactants_unit'])?$_POST['reactants_unit']:'j/mol*K' }}" id="reactants_unit" class="hidden">
                                <div id="reactants_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="reactants_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('reactants_unit', 'j/mol*K')">j/mol*K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('reactants_unit', 'kj/mol*K')">kj/mol*K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('reactants_unit', 'mj/mol*K')">mj/mol*K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('reactants_unit', 'wh/mol*K')">wh/mol*K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('reactants_unit', 'kwh/mol*K')">kwh/mol*K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('reactants_unit', 'ft-lb/mol*K')">ft-lb/mol*K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('reactants_unit', 'cal/mol*K')">cal/mol*K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('reactants_unit', 'kcal/mol*K')">kcal/mol*K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('reactants_unit', 'ev/mol*K')">ev/mol*K</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full hidden mt-3" id="second">
                    <div class="grid grid-cols-2 mt-4  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2">
                            <label for="enthalpy" class="label">{{ $lang['4'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="enthalpy" id="enthalpy" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['enthalpy'])?$_POST['enthalpy']:'80' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="enthalpy_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('enthalpy_unit_dropdown')">{{ isset($_POST['enthalpy_unit'])?$_POST['enthalpy_unit']:'j' }} ▾</label>
                                <input type="text" name="enthalpy_unit" value="{{ isset($_POST['enthalpy_unit'])?$_POST['enthalpy_unit']:'j' }}" id="enthalpy_unit" class="hidden">
                                <div id="enthalpy_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="enthalpy_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('enthalpy_unit', 'j')">j</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('enthalpy_unit', 'kj')">kj</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('enthalpy_unit', 'mj')">mj</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('enthalpy_unit', 'wh')">wh</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('enthalpy_unit', 'kwh')">kwh</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('enthalpy_unit', 'ft-lb')">ft-lb</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('enthalpy_unit', 'cal')">cal</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('enthalpy_unit', 'kcal')">kcal</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('enthalpy_unit', 'ev')">ev</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="temperature" class="label">{{ $lang['5'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="temperature" id="temperature" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['temperature'])?$_POST['temperature']:'80' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="temperature_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('temperature_unit_dropdown')">{{ isset($_POST['temperature_unit'])?$_POST['temperature_unit']:'°C' }} ▾</label>
                                <input type="text" name="temperature_unit" value="{{ isset($_POST['temperature_unit'])?$_POST['temperature_unit']:'°C' }}" id="temperature_unit" class="hidden">
                                <div id="temperature_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="temperature_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temperature_unit', '°C')">°C</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temperature_unit', '°F')">°F</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('temperature_unit', 'K')">K</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="entropy" class="label">{{ $lang['6'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="entropy" id="entropy" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['entropy'])?$_POST['entropy']:'80' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="entropy_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('entropy_unit_dropdown')">{{ isset($_POST['entropy_unit'])?$_POST['entropy_unit']:'j/K' }} ▾</label>
                                <input type="text" name="entropy_unit" value="{{ isset($_POST['entropy_unit'])?$_POST['entropy_unit']:'j/K' }}" id="entropy_unit" class="hidden">
                                <div id="entropy_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="entropy_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('entropy_unit', 'j/K')">j/K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('entropy_unit', 'kj/K')">kj/K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('entropy_unit', 'mj/K')">mj/K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('entropy_unit', 'wh/K')">wh/K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('entropy_unit', 'kwh/K')">kwh/K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('entropy_unit', 'ft-lb/K')">ft-lb/K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('entropy_unit', 'cal/K')">cal/K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('entropy_unit', 'kcal/K')">kcal/K</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('entropy_unit', 'ev/K')">ev/K</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-12 hidden" id="three">
                    <div class="grid grid-cols-2 mt-4  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2 relative">
                            <label for="base_unit" class="label">{!! $lang['7'] !!}:</label>
                            <select name="base_unit" id="base_unit" class="input">
                                @php
                                    $name = [$lang['23'], $lang['24']];
                                    $val = [$lang['23'], $lang['24']];
                                    optionsList($val,$name,isset(request()->base_unit)?request()->base_unit:$lang['23']);
                                @endphp
                            </select>
                        </div>
                        <div class="space-y-2 ">
                            <label for="moles" class="label">{!! $lang['8'] !!}:</label>
                            <div class="w-full py-2 relative">
                            <input type="number" step="any" name="moles" id="moles" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->moles)?request()->moles:'80' }}" />
                            <span class="text-blue input_unit" id="text_one">mol</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="initial" class="label" id="tex_first">{{ $lang['9'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="initial" id="initial" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['initial'])?$_POST['initial']:'12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <div id="vol_first">
                                    <label for="initial_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('initial_unit_dropdown')">{{ isset($_POST['initial_unit'])?$_POST['initial_unit']:'mm³' }} ▾</label>
                                    <input type="text" name="initial_unit" value="{{ isset($_POST['initial_unit'])?$_POST['initial_unit']:'mm³' }}" id="initial_unit" class="hidden">
                                    <div id="initial_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="initial_unit">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('initial_unit', 'mm³')">cubic millimeters (mm³)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('initial_unit', 'cm³')">cubic centimeters (cm³)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('initial_unit', 'dm³')">cubic decimeters (dm³)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('initial_unit', 'm³')">cubic meters (m³)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('initial_unit', 'in³')">cubic inches (in³)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('initial_unit', 'ft³')">cubic feet (ft³)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('initial_unit', 'ml')">milliliters (ml)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('initial_unit', 'cl')">centiliters (cl)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('initial_unit', 'l')">liters (l)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('initial_unit', 'US gal')">US gallons (US gal)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('initial_unit', 'UK gal')">UK gallons (UK gal)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('initial_unit', 'Pa')">US fluid ounces (US fl oz)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('initial_unit', 'US fl oz')">US fluid ounces (US fl oz)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('initial_unit', 'UK fl oz')">UK fluid ounces (UK fl oz)</p>
                                    </div>
                                </div>
                                <div class="hidden"  id="par_first">
                                    <label for="pre_one_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pre_one_unit_dropdown')">{{ isset($_POST['pre_one_unit'])?$_POST['pre_one_unit']:'Pa' }} ▾</label>
                                    <input type="text" name="pre_one_unit" value="{{ isset($_POST['pre_one_unit'])?$_POST['pre_one_unit']:'Pa' }}" id="pre_one_unit" class="hidden">
                                    <div id="pre_one_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pre_one_unit">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_one_unit', 'Pa')">Pa</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_one_unit', 'Bar')">Bar</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_one_unit', 'psi')">psi</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_one_unit', 'at')">at</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_one_unit', 'atm')">atm</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_one_unit', 'Torr')">Torr</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_one_unit', 'hPa')">hPa</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_one_unit', 'kPa')">kPa</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_one_unit', 'MPa')">MPa</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_one_unit', 'GPa')">GPa</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_one_unit', 'inHg')">inHg</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_one_unit', 'mmHg')">mmHg</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="final" class="label" id="tex_sec">{{ $lang['10'] }}:</label>
                            <div class="relative w-full ">
                                <input type="number" name="final" id="final" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['final'])?$_POST['final']:'12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <div id="vol_second">
                                    <label for="final_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('final_unit_dropdown')">{{ isset($_POST['final_unit'])?$_POST['final_unit']:'mm³' }} ▾</label>
                                    <input type="text" name="final_unit" value="{{ isset($_POST['final_unit'])?$_POST['final_unit']:'mm³' }}" id="final_unit" class="hidden">
                                    <div id="final_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="final_unit">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'mm³')">cubic millimeters (mm³)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'cm³')">cubic centimeters (cm³)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'dm³')">cubic decimeters (dm³)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'm³')">cubic meters (m³)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'in³')">cubic inches (in³)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'ft³')">cubic feet (ft³)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'ml')">milliliters (ml)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'cl')">centiliters (cl)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'l')">liters (l)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'US gal')">US gallons (US gal)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'UK gal')">UK gallons (UK gal)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'Pa')">US fluid ounces (US fl oz)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'US fl oz')">US fluid ounces (US fl oz)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('final_unit', 'UK fl oz')">UK fluid ounces (UK fl oz)</p>
                                    </div>
                                </div>
                                <div class="hidden"  id="par_second">
                                    <label for="pre_two_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pre_two_unit_dropdown')">{{ isset($_POST['pre_two_unit'])?$_POST['pre_two_unit']:'Pa' }} ▾</label>
                                    <input type="text" name="pre_two_unit" value="{{ isset($_POST['pre_two_unit'])?$_POST['pre_two_unit']:'Pa' }}" id="pre_two_unit" class="hidden">
                                    <div id="pre_two_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pre_two_unit">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_two_unit', 'Pa')">Pa</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_two_unit', 'Bar')">Bar</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_two_unit', 'psi')">psi</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_two_unit', 'at')">at</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_two_unit', 'atm')">atm</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_two_unit', 'Torr')">Torr</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_two_unit', 'hPa')">hPa</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_two_unit', 'kPa')">kPa</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_two_unit', 'MPa')">MPa</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_two_unit', 'GPa')">GPa</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_two_unit', 'inHg')">inHg</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pre_two_unit', 'mmHg')">mmHg</p>
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
                            @if(request()->point_unit === "entropy change for a reaction")
                                <div class="flex flex-column flex-md-row items-center bg-sky px-3 py-2">
                                    <strong class="pe-md-3">{!! $lang['14'] !!} =</strong>
                                    <strong class="text-green font-s-28">{!! round($detail['entropy_reaction']) !!} <span class="font-s-16">j/mol*K</span></strong>
                                </div>
                                <p class="mt-3"><strong>{!! $lang['15'] !!}</strong></p>
                                <div class="grid grid-cols-2  lg:grid-cols-4 md:grid-cols-4  gap-4">
                                    <div class="border-r-4 mt-3">
                                        <p><strong>kj/mol*K</strong></p>
                                        <p>{!! round($detail['entropy_reaction'] / 1000,4) !!}</p>
                                    </div>
                                    <div class="border-r-4 mt-3">
                                        <p><strong>mj/mol*K</strong></p>
                                        <p>{!! round($detail['entropy_reaction']  / 1e+6,4) !!}</p>
                                    </div>
                                    <div class="border-r-4 mt-3">
                                        <p><strong>wh/mol*K</strong></p>
                                        <p>{!! round($detail['entropy_reaction'] / 3600,4) !!}</p>
                                    </div>
                                    <div class="border-r-4 mt-3">
                                        <p><strong>kwh/mol*K</strong></p>
                                        <p>{!! round($detail['entropy_reaction']  / 3.6e+6,6) !!}</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2  lg:grid-cols-4 md:grid-cols-4  gap-4">
                                    <div class="border-r-4 mt-3">
                                        <p><strong>ft-lb/mol*K</strong></p>
                                        <p>{!! round($detail['entropy_reaction'] * 0.737562149,4) !!}</p>
                                    </div>
                                    <div class="border-r-4 mt-3">
                                        <p><strong>cal/mol*K</strong></p>
                                        <p>{!! round($detail['entropy_reaction']  / 4.184,4) !!}</p>
                                    </div>
                                    <div class="border-r-4 mt-3">
                                        <p><strong>kcal/mol*K</strong></p>
                                        <p>{!! round($detail['entropy_reaction'] * 0.000239006,4) !!}</p>
                                    </div>
                                    <div class="border-r-4 mt-3">
                                        <p><strong>ev/mol*K</strong></p>
                                        <p>{!! round($detail['entropy_reaction'] * 6.242 * pow(10, 18),4) !!}</p>
                                    </div>
                                </div>
                            @elseif(request()->point_unit === "gibbs free energy ΔG = ΔH - T*ΔS")
                                <div class="bg-[#F6FAFC] border radius-10 px-3 py-2">
                                    <div class="d-flex flex-column flex-md-row align-items-center">
                                        <strong class="pe-md-3">{!! $lang['16'] !!} =</strong>
                                        <strong class="text-green font-s-28">{!! round($detail['gibbs']) !!} <span class="font-s-16">j</span></strong>
                                    </div>
                                    <div class="col-12 text-center text-md-start">
                                        @if($detail['gibbs'] < "0")
                                            <p class="mt-2">{!! $lang['18'] !!}.</p>
                                        @elseif($detail['gibbs'] > "0")
                                            <p class="mt-2">{!! $lang['19'] !!}.</p>
                                        @else
                                            <p class="mt-2">{!! $lang['20'] !!}.</p>
                                        @endif
                                    </div>
                                </div>
                                <p class="mt-3"><strong>{!! $lang['17'] !!}</strong></p>
                                <div class="grid grid-cols-2  lg:grid-cols-4 md:grid-cols-4  gap-4">
                                    <div class="border-r-4 mt-3">
                                        <p><strong>kj</strong></p>
                                        <p>{!! round($detail['gibbs'] / 1000,4) !!}</p>
                                    </div>
                                    <div class="border-r-4 mt-3">
                                        <p><strong>mj</strong></p>
                                        <p>{!! round($detail['gibbs']  / 1e+6,4) !!}</p>
                                    </div>
                                    <div class="border-r-4 mt-3">
                                        <p><strong>wh</strong></p>
                                        <p>{!! round($detail['gibbs'] / 3600,4) !!}</p>
                                    </div>
                                    <div class="border-r-4 mt-3">
                                        <p><strong>kwh</strong></p>
                                        <p>{!! round($detail['gibbs']  / 3.6e+6,6) !!}</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2  lg:grid-cols-4 md:grid-cols-4  gap-4">
                                    <div class="border-r-4 mt-3">
                                        <p><strong>ft-lb</strong></p>
                                        <p>{!! round($detail['gibbs'] * 0.737562149,4) !!}</p>
                                    </div>
                                    <div class="border-r-4 mt-3">
                                        <p><strong>cal</strong></p>
                                        <p>{!! round($detail['gibbs']  / 4.184,4) !!}</p>
                                    </div>
                                    <div class="border-r-4 mt-3">
                                        <p><strong>kcal</strong></p>
                                        <p>{!! round($detail['gibbs'] * 0.000239006,4) !!}</p>
                                    </div>
                                    <div class="border-r-4 mt-3">
                                        <p><strong>ev</strong></p>
                                        <p class="break-word">{!! round($detail['gibbs'] * 6.242 * pow(10, 18),4) !!}</p>
                                    </div>
                                </div>
                            @elseif(request()->point_unit === "isothermal entropy change of an ideal gas")
                                @if(request()->base_unit === "volume")
                                    <div class="flex flex-column flex-md-row items-center bg-sky px-3 py-2">
                                        <strong class="pe-md-3">{!! $lang['21'] !!} =</strong>
                                        <strong class="text-green font-s-28">{!! round($detail['answer'],4) !!} <span class="font-s-16">j</span></strong>
                                    </div>
                                    <p class="mt-3"><strong>{!! $lang['15'] !!}</strong></p>
                                    <div class="grid grid-cols-2  lg:grid-cols-4 md:grid-cols-4  gap-4">
                                        <div class="border-r-4 mt-3">
                                            <p><strong>kj</strong></p>
                                            <p>{!! round($detail['answer'] / 1000,4) !!}</p>
                                        </div>
                                        <div class="border-r-4 mt-3">
                                            <p><strong>mj</strong></p>
                                            <p>{!! round($detail['answer']  / 1e+6,4) !!}</p>
                                        </div>
                                        <div class="border-r-4 mt-3">
                                            <p><strong>wh</strong></p>
                                            <p>{!! round($detail['answer'] / 3600,4) !!}</p>
                                        </div>
                                        <div class="border-r-4 mt-3">
                                            <p><strong>kwh</strong></p>
                                            <p>{!! round($detail['answer']  / 3.6e+6,6) !!}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2  lg:grid-cols-4 md:grid-cols-4  gap-4">
                                        <div class="border-r-4 mt-3">
                                            <p><strong>ft-lb</strong></p>
                                            <p>{!! round($detail['answer'] * 0.737562149,4) !!}</p>
                                        </div>
                                        <div class="border-r-4 mt-3">
                                            <p><strong>cal</strong></p>
                                            <p>{!! round($detail['answer']  / 4.184,4) !!}</p>
                                        </div>
                                        <div class="border-r-4 mt-3">
                                            <p><strong>kcal</strong></p>
                                            <p>{!! round($detail['answer'] * 0.000239006,4) !!}</p>
                                        </div>
                                        <div class="border-r-4 mt-3">
                                            <p><strong>ev</strong></p>
                                            <p class="break-word">{!! round($detail['answer'] * 6.242 * pow(10, 18),4) !!}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex flex-column flex-md-row items-center bg-sky px-3 py-2">
                                        <strong class="pe-md-3">{!! $lang['21'] !!} =</strong>
                                        <strong class="text-green font-s-28">{!! round($detail['answers'],4) !!} <span class="font-s-16">j</span></strong>
                                    </div>
                                    <p class="mt-3"><strong>{!! $lang['15'] !!}</strong></p>
                                    <div class="grid grid-cols-2  lg:grid-cols-4 md:grid-cols-4  gap-4">
                                        <div class="border-r-4 mt-3">
                                            <p><strong>kj</strong></p>
                                            <p>{!! round($detail['answers'] / 1000,4) !!}</p>
                                        </div>
                                        <div class="col-1 border-end ps-3 me-3 mt-3">&nbsp;</div>
                                        <div class="border-r-4 mt-3">
                                            <p><strong>mj</strong></p>
                                            <p>{!! round($detail['answers']  / 1e+6,4) !!}</p>
                                        </div>
                                        <div class="col-1 border-end ps-3 me-3 mt-3 hidden d-md-block">&nbsp;</div>
                                        <div class="border-r-4 mt-3">
                                            <p><strong>wh</strong></p>
                                            <p>{!! round($detail['answers'] / 3600,4) !!}</p>
                                        </div>
                                        <div class="col-1 border-end ps-3 me-3 mt-3">&nbsp;</div>
                                        <div class="border-r-4 mt-3">
                                            <p><strong>kwh</strong></p>
                                            <p>{!! round($detail['answers']  / 3.6e+6,6) !!}</p>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2  lg:grid-cols-4 md:grid-cols-4  gap-4">
                                        <div class="border-r-4 mt-3">
                                            <p><strong>ft-lb</strong></p>
                                            <p>{!! round($detail['answers'] * 0.737562149,4) !!}</p>
                                        </div>
                                        <div class="col-1 border-end ps-3 me-3 mt-3">&nbsp;</div>
                                        <div class="border-r-4 mt-3">
                                            <p><strong>cal</strong></p>
                                            <p>{!! round($detail['answers']  / 4.184,4) !!}</p>
                                        </div>
                                        <div class="col-1 border-end ps-3 me-3 mt-3 hidden d-md-block">&nbsp;</div>
                                        <div class="border-r-4 mt-3">
                                            <p><strong>kcal</strong></p>
                                            <p>{!! round($detail['answers'] * 0.000239006,4) !!}</p>
                                        </div>
                                        <div class="col-1 border-end ps-3 me-3 mt-3">&nbsp;</div>
                                        <div class="border-r-4 mt-3">
                                            <p><strong>ev</strong></p>
                                            <p class="break-word">{!! round($detail['answers'] * 6.242 * pow(10, 18),4) !!}</p>
                                        </div>
                                    </div>
                                @endif
                            @endif
                    </div>
                </div>
        </div>
    </div>
    @endisset

    @push('calculatorJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function handlePointUnitChange() {
                    var aja = document.getElementById('point_unit').value;
                    if (aja === "entropy change for a reaction") {
                        document.getElementById('first').style.display = 'block';
                        document.getElementById('second').style.display = 'none';
                        document.getElementById('three').style.display = 'none';
                    } else if (aja === "gibbs free energy ΔG = ΔH - T*ΔS") {
                        document.getElementById('second').style.display = 'block';
                        document.getElementById('first').style.display = 'none';
                        document.getElementById('three').style.display = 'none';
                    } else {
                        document.getElementById('three').style.display = 'block';
                        document.getElementById('second').style.display = 'none';
                        document.getElementById('first').style.display = 'none';
                    }
                }

                function handleBaseUnitChange() {
                    var aja = document.getElementById('base_unit').value;
                    if (aja === "volume") {
                        document.getElementById('vol_first').style.display = 'block';
                        document.getElementById('vol_second').style.display = 'block';
                        document.getElementById('par_first').style.display = 'none';
                        document.getElementById('par_second').style.display = 'none';
                        document.getElementById('tex_first').textContent = "Initial Volume";
                        document.getElementById('tex_sec').textContent = "Final Volume";
                    } else {
                        document.getElementById('par_first').style.display = 'block';
                        document.getElementById('par_second').style.display = 'block';
                        document.getElementById('vol_first').style.display = 'none';
                        document.getElementById('vol_second').style.display = 'none';
                        document.getElementById('tex_first').textContent = "Initial Pressure";
                        document.getElementById('tex_sec').textContent = "Final Pressure";
                    }
                }

                handlePointUnitChange();
                handleBaseUnitChange();

                document.getElementById('point_unit').addEventListener('change', handlePointUnitChange);
                document.getElementById('base_unit').addEventListener('change', handleBaseUnitChange);
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>