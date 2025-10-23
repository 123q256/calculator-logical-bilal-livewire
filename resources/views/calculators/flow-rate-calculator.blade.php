<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">


                <div class="col-span-6">
                    <label for="conversion_type" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2">
                        <i class="fas fa-sort-down color_blue"></i>
                        <select name="conversion_type" id="conversion_type" class="input">
                            <option value="1" {{ isset($_POST['conversion_type']) && $_POST['conversion_type']=='1'?'selected':''}}  >{{$lang['2'] }}</option>
                            <option value="2" {{ isset($_POST['conversion_type']) && $_POST['conversion_type']=='2'?'selected':''}}  >{{ $lang['3']}}</option>
                            <option value="3" {{ isset($_POST['conversion_type']) && $_POST['conversion_type']=='3'?'selected':''}}  >{{ $lang['4'] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="choice_unit" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="w-100 py-2">
                        <i class="fas fa-sort-down color_blue"></i>
                        <select name="choice_unit" id="choice_unit" class="input">
                            <option value="cp" {{ isset($_POST['choice_unit']) && $_POST['choice_unit']=='cp'?'selected':''}}  >{{$lang['6'] }}</option>
                            <option value="cpf" {{ isset($_POST['choice_unit']) && $_POST['choice_unit']=='cpf'?'selected':''}}  >{{ $lang['7']}}</option>
                            <option value="rec" {{ isset($_POST['choice_unit']) && $_POST['choice_unit']=='rec'?'selected':''}}  >{{ $lang['8'] }}</option>
                            <option value="trap" {{ isset($_POST['choice_unit']) && $_POST['choice_unit']=='trap'?'selected':''}}  >{{ $lang['9'] }}</option>
                            <option value="other" {{ isset($_POST['choice_unit']) && $_POST['choice_unit']=='other'?'selected':''}}  >{{ $lang['10'] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 flex justify-center">
                    <div class="ch">
                        <img src="{{ asset('images/circular.png?v=1') }}" alt="Flow Rate Calculator" width="180" height="180" class="change_img">
                      </div>
                </div>
                <div class="col-span-6 volume hidden">
                    <label for="volume" class="font-s-14 text-blue" >{{ $lang['11']}} </label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="volume" id="volume" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['volume']) ? $_POST['volume'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="volume_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('volume_unit_dropdown')">{{ isset($_POST['volume_unit'])?$_POST['volume_unit']:'fluid-ounce' }} ▾</label>
                        <input type="text" name="volume_unit" value="{{ isset($_POST['volume_unit'])?$_POST['volume_unit']:'fluid-ounce' }}" id="volume_unit" class="hidden">
                        <div id="volume_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="volume_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'fluid-ounce')">{{ $lang['12']}}</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'quart')">{{ $lang['13']}}</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'pint')">{{ $lang['14']}}</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'gallon')">{{ $lang['15']}}</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'milliliter')">{{ $lang['16']}}</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'liter')">{{ $lang['17']}}</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'cubic-inch')">cu in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'cubic-foot')">cu ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'cubic-centimeter')">cu cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('volume_unit', 'cubic-meter')">cu m</p>
                        </div>
                     </div>
                </div>
    
                <div class="col-span-6 time hidden">
                    <label for="time" class="font-s-14 text-blue" >{{ $lang['18']}} </label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="time" id="time" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['time']) ? $_POST['time'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="time_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('time_unit_dropdown')">{{ isset($_POST['time_unit'])?$_POST['time_unit']:'second' }} ▾</label>
                        <input type="text" name="time_unit" value="{{ isset($_POST['time_unit'])?$_POST['time_unit']:'second' }}" id="time_unit" class="hidden">
                        <div id="time_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="time_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'second')">sec</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'minute')">min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'hour')">hours</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'day')">days</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 diameter">
                    <label for="diameter" class="font-s-14 text-blue" >{{ $lang['19']}} (d) </label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="diameter" id="diameter" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['diameter']) ? $_POST['diameter'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="diameter_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('diameter_unit_dropdown')">{{ isset($_POST['diameter_unit'])?$_POST['diameter_unit']:'cm' }} ▾</label>
                        <input type="text" name="diameter_unit" value="{{ isset($_POST['diameter_unit'])?$_POST['diameter_unit']:'cm' }}" id="diameter_unit" class="hidden">
                        <div id="diameter_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="diameter_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'yd')">yd</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('diameter_unit', 'mm')">mm</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 velocity">
                    <label for="velocity" class="font-s-14 text-blue" >{{ $lang['20']}} </label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="velocity" id="velocity" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['velocity']) ? $_POST['velocity'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="velocity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('velocity_unit_dropdown')">{{ isset($_POST['velocity_unit'])?$_POST['velocity_unit']:'cm' }} ▾</label>
                        <input type="text" name="velocity_unit" value="{{ isset($_POST['velocity_unit'])?$_POST['velocity_unit']:'cm' }}" id="velocity_unit" class="hidden">
                        <div id="velocity_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="velocity_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'ms')">m/s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'fts')">fts</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 density">
                    <label for="density" class="font-s-14 text-blue" >{{ $lang['21']}} </label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="density" id="density" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['density']) ? $_POST['density'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="density_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('density_unit_dropdown')">{{ isset($_POST['density_unit'])?$_POST['density_unit']:'cm' }} ▾</label>
                        <input type="text" name="density_unit" value="{{ isset($_POST['density_unit'])?$_POST['density_unit']:'cm' }}" id="density_unit" class="hidden">
                        <div id="density_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="density_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'kg')">kg/m³</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'lb1')">lb/cu ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'lb2')">lb/cu yd</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('density_unit', 'g')">g/cm³</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 filled hidden">
                    <label for="filled" class="font-s-14 text-blue" >{{ $lang['22']}} </label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="filled" id="filled" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['filled']) ? $_POST['filled'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="filled_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('filled_unit_dropdown')">{{ isset($_POST['filled_unit'])?$_POST['filled_unit']:'cm' }} ▾</label>
                        <input type="text" name="filled_unit" value="{{ isset($_POST['filled_unit'])?$_POST['filled_unit']:'cm' }}" id="filled_unit" class="hidden">
                        <div id="filled_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="filled_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('filled_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('filled_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('filled_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('filled_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('filled_unit', 'yd')">yd</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('filled_unit', 'mm')">mm</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 height hidden">
                    <label for="height" class="font-s-14 text-blue" >{{ $lang['23']}} </label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height" id="height" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height']) ? $_POST['height'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('height_unit_dropdown')">{{ isset($_POST['height_unit'])?$_POST['height_unit']:'cm' }} ▾</label>
                        <input type="text" name="height_unit" value="{{ isset($_POST['height_unit'])?$_POST['height_unit']:'cm' }}" id="height_unit" class="hidden">
                        <div id="height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="height_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'yd')">yd</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'mm')">mm</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 width hidden">
                    <label for="width" class="font-s-14 text-blue" >{{ $lang['24']}} </label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="width" id="width" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width']) ? $_POST['width'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }} ▾</label>
                        <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }}" id="width_unit" class="hidden">
                        <div id="width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'yd')">yd</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'mm')">mm</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 area hidden">
                    <label for="cross" class="font-s-14 text-blue" >{{ $lang['25']}} (A)</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="cross" id="cross" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cross']) ? $_POST['cross'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm²' }} ▾</label>
                        <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm²' }}" id="width_unit" class="hidden">
                        <div id="width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'cm²')">cm²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'm²')">m²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'in²')">in²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'ft²')">ft²</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'yd²')">yd²</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 top_width hidden">
                    <label for="top_width" class="font-s-14 text-blue" >{{ $lang['26']}}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="top_width" id="top_width" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['top_width']) ? $_POST['top_width'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="top_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('top_width_unit_dropdown')">{{ isset($_POST['top_width_unit'])?$_POST['top_width_unit']:'cm' }} ▾</label>
                        <input type="text" name="top_width_unit" value="{{ isset($_POST['top_width_unit'])?$_POST['top_width_unit']:'cm' }}" id="top_width_unit" class="hidden">
                        <div id="top_width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="top_width_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('top_width_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('top_width_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('top_width_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('top_width_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('top_width_unit', 'yd')">yd</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('top_width_unit', 'mm')">mm</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 bottom_width hidden">
                    <label for="bottom_width" class="font-s-14 text-blue" >{{ $lang['27']}}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="bottom_width" id="bottom_width" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['bottom_width']) ? $_POST['bottom_width'] : '2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="bottom_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('bottom_width_unit_dropdown')">{{ isset($_POST['bottom_width_unit'])?$_POST['bottom_width_unit']:'cm' }} ▾</label>
                        <input type="text" name="bottom_width_unit" value="{{ isset($_POST['bottom_width_unit'])?$_POST['bottom_width_unit']:'cm' }}" id="bottom_width_unit" class="hidden">
                        <div id="bottom_width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="bottom_width_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bottom_width_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bottom_width_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bottom_width_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bottom_width_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bottom_width_unit', 'yd')">yd</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('bottom_width_unit', 'mm')">mm</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 pressure_start hidden">
                    <label for="pressure_start" class="font-s-14 text-blue" >{{ $lang['28']}}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="pressure_start" id="pressure_start" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pressure_start']) ? $_POST['pressure_start'] : '2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="pressure_start_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pressure_start_unit_dropdown')">{{ isset($_POST['pressure_start_unit'])?$_POST['pressure_start_unit']:'Pa' }} ▾</label>
                        <input type="text" name="pressure_start_unit" value="{{ isset($_POST['pressure_start_unit'])?$_POST['pressure_start_unit']:'Pa' }}" id="pressure_start_unit" class="hidden">
                        <div id="pressure_start_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pressure_start_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_start_unit', 'Pa')">Pa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_start_unit', 'kPa')">kPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_start_unit', 'MPa')">MPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_start_unit', 'GPa')">GPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_start_unit', 'mbar')">mbar</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_start_unit', 'bar')">bar</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_start_unit', 'atm')">atm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_start_unit', 'mmHg')">mmHg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_start_unit', 'mmH2O')">mmH2O</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_start_unit', 'psi')">psi</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 pressure_end hidden">
                    <label for="pressure_end" class="font-s-14 text-blue" >{{ $lang['29']}}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="pressure_end" id="pressure_end" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pressure_end']) ? $_POST['pressure_end'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="pressure_end_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pressure_end_unit_dropdown')">{{ isset($_POST['pressure_end_unit'])?$_POST['pressure_end_unit']:'Pa' }} ▾</label>
                        <input type="text" name="pressure_end_unit" value="{{ isset($_POST['pressure_end_unit'])?$_POST['pressure_end_unit']:'Pa' }}" id="pressure_end_unit" class="hidden">
                        <div id="pressure_end_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pressure_end_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_end_unit', 'Pa')">Pa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_end_unit', 'kPa')">kPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_end_unit', 'MPa')">MPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_end_unit', 'GPa')">GPa</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_end_unit', 'mbar')">mbar</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_end_unit', 'bar')">bar</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_end_unit', 'atm')">atm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_end_unit', 'mmHg')">mmHg</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_end_unit', 'mmH2O')">mmH2O</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pressure_end_unit', 'psi')">psi</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 pipe_length hidden">
                    <label for="pipe_length" class="font-s-14 text-blue" >{{ $lang['30']}}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="pipe_length" id="pipe_length" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pipe_length']) ? $_POST['pipe_length'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="pipe_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pipe_length_unit_dropdown')">{{ isset($_POST['pipe_length_unit'])?$_POST['pipe_length_unit']:'cm' }} ▾</label>
                        <input type="text" name="pipe_length_unit" value="{{ isset($_POST['pipe_length_unit'])?$_POST['pipe_length_unit']:'cm' }}" id="pipe_length_unit" class="hidden">
                        <div id="pipe_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pipe_length_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pipe_length_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pipe_length_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pipe_length_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pipe_length_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pipe_length_unit', 'yd')">yd</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pipe_length_unit', 'mm')">mm</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-6 dynamic_viscosity hidden">
                    <label for="dynamic_viscosity" class="font-s-14 text-blue" >{{ $lang['31']}}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="dynamic_viscosity" id="dynamic_viscosity" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dynamic_viscosity']) ? $_POST['dynamic_viscosity'] : '45' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="dynamic_viscosity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dynamic_viscosity_unit_dropdown')">{{ isset($_POST['dynamic_viscosity_unit'])?$_POST['dynamic_viscosity_unit']:'kgms' }} ▾</label>
                        <input type="text" name="dynamic_viscosity_unit" value="{{ isset($_POST['dynamic_viscosity_unit'])?$_POST['dynamic_viscosity_unit']:'kgms' }}" id="dynamic_viscosity_unit" class="hidden">
                        <div id="dynamic_viscosity_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dynamic_viscosity_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dynamic_viscosity_unit', 'kgms')">kg/m·s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dynamic_viscosity_unit', 'nsm2')">N·s/m2</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dynamic_viscosity_unit', 'pas')">Pa·s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dynamic_viscosity_unit', 'cp')">cp</p>
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
            <div class="rounded-lg ">
                <div class="w-full mt-3">
                    <div class="w-full md:w-[80%] lg:w-[80%]  mt-2">
                        <table class="w-full font-s-18">
                           <tr>
                              <td class="py-2 border-b" width="70%"><strong>{{ $lang[32] }} </strong></td>
                               <td class="py-2 border-b"> {{ $detail['volumetric_flow_rate'] }} (m³/s)</td>
                           </tr>
                           @if($detail['mass_flow_rate']!="")
                           <tr>
                             <td class="py-2 border-b" width="70%"><strong>{{ $lang[33] }} </strong></td>
                             <td class="py-2 border-b"> {{ $detail['mass_flow_rate'] }} (kg/s)</td>
                           </tr>
                         @endif
                        </table>
                        <table class="w-full font-s-18">
                            <tr>
                                <td class="py-2 border-b">{{ $lang['32']}} (ft<sup>3</sup>)</td>
                                <td class="py-2 border-b"><strong>{{ $detail['volumetric_flow_rate']*35.3147 }} ft<sup>3</sup>/h ({{ $detail['volumetric_flow_rate']*127133 }} ft<sup>3</sup>/s )</strong></p></td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b">{{ $lang['32']}} (yd<sup>3</sup>)</td>
                                <td class="py-2 border-b"><strong>{{ $detail['volumetric_flow_rate']*4708.622229 }} yd<sup>3</sup>/h ({{ $detail['volumetric_flow_rate']*1.3079506193144 }} yd<sup>3</sup>/s )</strong></p></td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b">{{ $lang['32']}} ({{ $lang['15']}})</td>
                                <td class="py-2 border-b"><strong>{{ $detail['volumetric_flow_rate']*951019.38848933 }} gal/h ({{ $detail['volumetric_flow_rate']*15850.323 }} gal/min )</strong></p></td>   
                            </tr>
                            @if($detail['mass_flow_rate']!="")
                            <tr>
                                <td class="py-2 border-b">{{ $lang['33']}}</td>
                                <td class="py-2 border-b"><strong>{{ $detail['mass_flow_rate']*7937 }} lb/h ({{ $detail['mass_flow_rate']*132.28 }} lb/min )</strong></p></td>   
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
    document.getElementById("conversion_type").addEventListener("change", function() {
        var t = this.value;

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

        if (t === "1") {
            showElements([".image_setting", ".shapes", ".diameter", ".velocity", ".density", ".ch"]);
            hideElements([".height", ".width", ".top_width", ".bottom_width", ".area", ".dynamic_viscosity", ".pressure_start", ".pressure_end"]);
            document.querySelector(".change_img").src = "<?=asset('images/circular.png?v=1')?>";
        } else if (t === "2") {
            hideElements([".image_setting", ".height", ".width", ".top_width", ".bottom_width", ".area", ".velocity", ".time", ".volume"]);
            showElements([".diameter", ".dynamic_viscosity", ".density", ".pressure_start", ".pressure_end", ".pipe_length", ".ch"]);
            document.querySelector(".change_img").src = "<?=asset('images/pressure.png')?>";
        } else if (t === "3") {
            hideElements([".image_setting", ".shapes", ".pressure_start", ".pressure_end", ".pipe_length", ".dynamic_viscosity", ".velocity", ".density", ".diameter", ".ch"]);
            showElements([".volume", ".time"]);
        }
    });
});

@if(isset($detail))
    var t = "{{$_POST['conversion_type']}}";

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

        if (t === "1") {
            showElements([".image_setting", ".shapes", ".diameter", ".velocity", ".density", ".ch"]);
            hideElements([".height", ".width", ".top_width", ".bottom_width", ".area", ".dynamic_viscosity", ".pressure_start", ".pressure_end"]);
            document.querySelector(".change_img").src = "<?=asset('images/circular.png?v=1')?>";
        } else if (t === "2") {
            hideElements([".image_setting", ".height", ".width", ".top_width", ".bottom_width", ".area", ".velocity", ".time", ".volume"]);
            showElements([".diameter", ".dynamic_viscosity", ".density", ".pressure_start", ".pressure_end", ".pipe_length", ".ch"]);
            document.querySelector(".change_img").src = "<?=asset('images/pressure.png')?>";
        } else if (t === "3") {
            hideElements([".image_setting", ".shapes", ".pressure_start", ".pressure_end", ".pipe_length", ".dynamic_viscosity", ".velocity", ".density", ".diameter", ".ch"]);
            showElements([".volume", ".time"]);
        }

@endif

@if(isset($error))
    var t = "{{$_POST['conversion_type']}}";

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

        if (t === "1") {
            showElements([".image_setting", ".shapes", ".diameter", ".velocity", ".density", ".ch"]);
            hideElements([".height", ".width", ".top_width", ".bottom_width", ".area", ".dynamic_viscosity", ".pressure_start", ".pressure_end"]);
            document.querySelector(".change_img").src = "<?=asset('images/circular.png?v=1')?>";
        } else if (t === "2") {
            hideElements([".image_setting", ".height", ".width", ".top_width", ".bottom_width", ".area", ".velocity", ".time", ".volume"]);
            showElements([".diameter", ".dynamic_viscosity", ".density", ".pressure_start", ".pressure_end", ".pipe_length", ".ch"]);
            document.querySelector(".change_img").src = "<?=asset('images/pressure.png')?>";
        } else if (t === "3") {
            hideElements([".image_setting", ".shapes", ".pressure_start", ".pressure_end", ".pipe_length", ".dynamic_viscosity", ".velocity", ".density", ".diameter", ".ch"]);
            showElements([".volume", ".time"]);
        }

@endif

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("choice_unit").addEventListener("change", function() {
        var a = this.value;

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

        if (a === "cp") {
            hideElements([".filled", ".height", ".width", ".area", ".top_width", ".bottom_width", ".dynamic_viscosity", ".pipe_length", ".pressure_start", ".pressure_end"]);
            showElements([".diameter", ".velocity", ".density"]);
            document.querySelector(".change_img").src = "<?=asset('images/circular.png?v=1')?>";
        } else if (a === "cpf") {
            hideElements([".height", ".width", ".area", ".top_width", ".bottom_width", ".dynamic_viscosity", ".pipe_length", ".pressure_start", ".pressure_end"]);
            showElements([".diameter", ".velocity", ".density", ".filled"]);
            document.querySelector(".change_img").src = "<?=asset('images/circular_partial.png')?>";
        } else if (a === "rec") {
            hideElements([".filled", ".diameter", ".area", ".top_width", ".bottom_width", ".dynamic_viscosity", ".pipe_length", ".pressure_start", ".pressure_end"]);
            showElements([".width", ".height", ".velocity", ".density"]);
            document.querySelector(".change_img").src = "<?=asset('images/recta.png')?>";
        } else if (a === "trap") {
            hideElements([".filled", ".height", ".area", ".diameter", ".dynamic_viscosity", ".pipe_length", ".pressure_start", ".pressure_end", ".top_width", ".bottom_width", ".density", ".width"]);
            showElements([".diameter", ".velocity"]);
        } else if (a === "other") {
            hideElements([".height", ".width", ".top_width", ".bottom_width", ".diameter", ".dynamic_viscosity", ".pipe_length", ".pressure_start", ".pressure_end"]);
            showElements([".area", ".velocity", ".density"]);
            document.querySelector(".change_img").src = "<?=asset('images/oth.png')?>";
        } else if (a === "pr") {
            hideElements([".height", ".width", ".top_width", ".bottom_width", ".area", ".velocity"]);
            showElements([".diameter", ".dynamic_viscosity", ".density", ".pressure_start", ".pressure_end", ".pipe_length"]);
            document.querySelector(".change_img").src = "<?=asset('')?>";
        }
    });
});

@if(isset($detail))
    var a = "{{$_POST['choice_unit']}}";

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

        if (a === "cp") {
            hideElements([".filled", ".height", ".width", ".area", ".top_width", ".bottom_width", ".dynamic_viscosity", ".pipe_length", ".pressure_start", ".pressure_end"]);
            showElements([".diameter", ".velocity", ".density"]);
            document.querySelector(".change_img").src = "<?=asset('images/circular.png?v=1')?>";
        } else if (a === "cpf") {
            hideElements([".height", ".width", ".area", ".top_width", ".bottom_width", ".dynamic_viscosity", ".pipe_length", ".pressure_start", ".pressure_end"]);
            showElements([".diameter", ".velocity", ".density", ".filled"]);
            document.querySelector(".change_img").src = "<?=asset('images/circular_partial.png')?>";
        } else if (a === "rec") {
            hideElements([".filled", ".diameter", ".area", ".top_width", ".bottom_width", ".dynamic_viscosity", ".pipe_length", ".pressure_start", ".pressure_end"]);
            showElements([".width", ".height", ".velocity", ".density"]);
            document.querySelector(".change_img").src = "<?=asset('images/recta.png')?>";
        } else if (a === "trap") {
            hideElements([".filled", ".height", ".area", ".diameter", ".dynamic_viscosity", ".pipe_length", ".pressure_start", ".pressure_end", ".top_width", ".bottom_width", ".density", ".width"]);
            showElements([".diameter", ".velocity"]);
        } else if (a === "other") {
            hideElements([".height", ".width", ".top_width", ".bottom_width", ".diameter", ".dynamic_viscosity", ".pipe_length", ".pressure_start", ".pressure_end"]);
            showElements([".area", ".velocity", ".density"]);
            document.querySelector(".change_img").src = "<?=asset('images/oth.png')?>";
        } else if (a === "pr") {
            hideElements([".height", ".width", ".top_width", ".bottom_width", ".area", ".velocity"]);
            showElements([".diameter", ".dynamic_viscosity", ".density", ".pressure_start", ".pressure_end", ".pipe_length"]);
            document.querySelector(".change_img").src = "<?=asset('')?>";
        }

@endif

@if(isset($error))
    var a = "{{$_POST['choice_unit']}}";

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

        if (a === "cp") {
            hideElements([".filled", ".height", ".width", ".area", ".top_width", ".bottom_width", ".dynamic_viscosity", ".pipe_length", ".pressure_start", ".pressure_end"]);
            showElements([".diameter", ".velocity", ".density"]);
            document.querySelector(".change_img").src = "<?=asset('images/circular.png?v=1')?>";
        } else if (a === "cpf") {
            hideElements([".height", ".width", ".area", ".top_width", ".bottom_width", ".dynamic_viscosity", ".pipe_length", ".pressure_start", ".pressure_end"]);
            showElements([".diameter", ".velocity", ".density", ".filled"]);
            document.querySelector(".change_img").src = "<?=asset('images/circular_partial.png')?>";
        } else if (a === "rec") {
            hideElements([".filled", ".diameter", ".area", ".top_width", ".bottom_width", ".dynamic_viscosity", ".pipe_length", ".pressure_start", ".pressure_end"]);
            showElements([".width", ".height", ".velocity", ".density"]);
            document.querySelector(".change_img").src = "<?=asset('images/recta.png')?>";
        } else if (a === "trap") {
            hideElements([".filled", ".height", ".area", ".diameter", ".dynamic_viscosity", ".pipe_length", ".pressure_start", ".pressure_end", ".top_width", ".bottom_width", ".density", ".width"]);
            showElements([".diameter", ".velocity"]);
        } else if (a === "other") {
            hideElements([".height", ".width", ".top_width", ".bottom_width", ".diameter", ".dynamic_viscosity", ".pipe_length", ".pressure_start", ".pressure_end"]);
            showElements([".area", ".velocity", ".density"]);
            document.querySelector(".change_img").src = "<?=asset('images/oth.png')?>";
        } else if (a === "pr") {
            hideElements([".height", ".width", ".top_width", ".bottom_width", ".area", ".velocity"]);
            showElements([".diameter", ".dynamic_viscosity", ".density", ".pressure_start", ".pressure_end", ".pipe_length"]);
            document.querySelector(".change_img").src = "<?=asset('')?>";
        }

@endif
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>