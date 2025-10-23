<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php 
                $request = request();
            @endphp
            <div class="col-span-12">
                <label for="type" class="label"><?=$lang['1']?>:</label>
                <div class="w-full py-2">
                    <select name="type" class="input" id="type" onchange="select_type(this)" aria-label="select">
                        <option value="1">{{$lang[2]}}</option>
                        <option value="2" {{ isset($request->type) && $request->type=='2'?'selected':'' }}>{{$lang[3]}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12" id="similarity_criterion_select">
                <label for="similarity" class="label" id="similarity_criterion"><?=$lang['4']?>:</label>
                <div class="w-full py-2">
                    <select name="similarity" class="input" id="similarity" onchange="select_similarity(this)" aria-label="select">
                        <option value="SSS">{{"$lang[5] (SSS)"}}</option>
                        <option value="SAS" {{ isset($request->similarity) && $request->similarity=='SAS'?'selected':'' }}>{{"$lang[6] (SAS)"}}</option>
                        <option value="ASA" {{ isset($request->similarity) && $request->similarity=='ASA'?'selected':'' }}>{{"$lang[7] (ASA)"}}</option>
                    </select>
                </div>
            </div>
            <p class="col-span-12 text-[18px]"><strong>△ABC</strong></p>

            <div class="col-span-12 md:col-span-4 lg:col-span-4 ABC_f_input">
                <label for="ABC_f" class="label" id="ABC_f_text">AB (a):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="ABC_f" id="ABC_f" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ABC_f']) ? $_POST['ABC_f'] : '15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <div id="ABC_f_unit_main">
                        <label for="ABC_f_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ABC_f_unit_dropdown')">{{ isset($_POST['ABC_f_unit'])?$_POST['ABC_f_unit']:'cm' }} ▾</label>
                        <input type="text" name="ABC_f_unit" value="{{ isset($_POST['ABC_f_unit'])?$_POST['ABC_f_unit']:'cm' }}" id="ABC_f_unit" class="hidden">
                        <div id="ABC_f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ABC_f_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_f_unit', 'mm')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_f_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_f_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_f_unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_f_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_f_unit', 'ft')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_f_unit', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_f_unit', 'mi')">miles (mi)</p>
                        </div>
                    </div>
                    <div class="hidden" id="ABC_f_deg_rad_main">
                        <label for="ABC_f_deg_rad" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ABC_f_deg_rad_dropdown')">{{ isset($_POST['ABC_f_deg_rad'])?$_POST['ABC_f_deg_rad']:'rad' }} ▾</label>
                        <input type="text" name="ABC_f_deg_rad" value="{{ isset($_POST['ABC_f_deg_rad'])?$_POST['ABC_f_deg_rad']:'rad' }}" id="ABC_f_deg_rad" class="hidden">
                        <div id="ABC_f_deg_rad_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ABC_f_deg_rad">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_f_deg_rad', 'deg')">degrees (deg)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_f_deg_rad', 'rad')">radians (rad)</p>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-4 lg:col-span-4 ABC_s_input">
                <label for="ABC_s" class="label" id="ABC_s_text">BC (b):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="ABC_s" id="ABC_s" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ABC_s']) ? $_POST['ABC_s'] : '15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <div id="ABC_s_unit_main">
                        <label for="ABC_s_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ABC_s_unit_dropdown')">{{ isset($_POST['ABC_s_unit'])?$_POST['ABC_s_unit']:'cm' }} ▾</label>
                        <input type="text" name="ABC_s_unit" value="{{ isset($_POST['ABC_s_unit'])?$_POST['ABC_s_unit']:'cm' }}" id="ABC_s_unit" class="hidden">
                        <div id="ABC_s_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ABC_s_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_s_unit', 'mm')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_s_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_s_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_s_unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_s_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_s_unit', 'ft')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_s_unit', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_s_unit', 'mi')">miles (mi)</p>
                        </div>
                    </div>
                    <div class="hidden" id="ABC_s_deg_rad_main">
                        <label for="ABC_s_deg_rad" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ABC_s_deg_rad_dropdown')">{{ isset($_POST['ABC_s_deg_rad'])?$_POST['ABC_s_deg_rad']:'rad' }} ▾</label>
                        <input type="text" name="ABC_s_deg_rad" value="{{ isset($_POST['ABC_s_deg_rad'])?$_POST['ABC_s_deg_rad']:'rad' }}" id="ABC_s_deg_rad" class="hidden">
                        <div id="ABC_s_deg_rad_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ABC_s_deg_rad">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_s_deg_rad', 'deg')">degrees (deg)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_s_deg_rad', 'rad')">radians (rad)</p>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-4 lg:col-span-4" id="ABC_third_input">
                <label for="ABC_t" class="label" id="ABC_t_text">AC (c):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="ABC_t" id="ABC_t" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ABC_t']) ? $_POST['ABC_t'] : '15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <div id="ABC_t_unit_main">
                        <label for="ABC_t_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ABC_t_unit_dropdown')">{{ isset($_POST['ABC_t_unit'])?$_POST['ABC_t_unit']:'cm' }} ▾</label>
                        <input type="text" name="ABC_t_unit" value="{{ isset($_POST['ABC_t_unit'])?$_POST['ABC_t_unit']:'cm' }}" id="ABC_t_unit" class="hidden">
                        <div id="ABC_t_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ABC_t_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_t_unit', 'mm')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_t_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_t_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_t_unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_t_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_t_unit', 'ft')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_t_unit', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_t_unit', 'mi')">miles (mi)</p>
                        </div>
                    </div>
                    <div class="hidden" id="ABC_t_deg_rad_main">
                        <label for="ABC_t_deg_rad" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ABC_t_deg_rad_dropdown')">{{ isset($_POST['ABC_t_deg_rad'])?$_POST['ABC_t_deg_rad']:'rad' }} ▾</label>
                        <input type="text" name="ABC_t_deg_rad" value="{{ isset($_POST['ABC_t_deg_rad'])?$_POST['ABC_t_deg_rad']:'rad' }}" id="ABC_t_deg_rad" class="hidden">
                        <div id="ABC_t_deg_rad_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ABC_t_deg_rad">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_t_deg_rad', 'deg')">degrees (deg)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_t_deg_rad', 'rad')">radians (rad)</p>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 hidden" id="corresponding_ABC">
                <label for="ABC_corresponding" class="label"><?= $lang[8] ?> △ABC:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="ABC_corresponding" id="ABC_corresponding" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ABC_corresponding']) ? $_POST['ABC_corresponding'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="ABC_corresponding_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ABC_corresponding_unit_dropdown')">{{ isset($_POST['ABC_corresponding_unit'])?$_POST['ABC_corresponding_unit']:'cm' }} ▾</label>
                    <input type="text" name="ABC_corresponding_unit" value="{{ isset($_POST['ABC_corresponding_unit'])?$_POST['ABC_corresponding_unit']:'cm' }}" id="ABC_corresponding_unit" class="hidden">
                    <div id="ABC_corresponding_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ABC_corresponding_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_corresponding_unit', 'mm')">millimeters (mm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_corresponding_unit', 'cm')">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_corresponding_unit', 'm')">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_corresponding_unit', 'km')">kilometers (km)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_corresponding_unit', 'in')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_corresponding_unit', 'ft')">feets (ft)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_corresponding_unit', 'yd')">yards (yd)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ABC_corresponding_unit', 'mi')">miles (mi)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-4 lg:col-span-4 hidden" id="scale_factor_input">
                <label for="scale_factor" class="label"><?= $lang[9] ?>:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="scale_factor" id="scale_factor" class="input" aria-label="input" value="{{ isset($request->scale_factor)?$request->scale_factor:'14' }}" />
                </div>
            </div>
            <p class="col-span-12 text-[18px] DEF_inputs"><strong>△DEF</strong></p>

            <div class="col-span-12 md:col-span-4 lg:col-span-4 DEF_inputs DEF_f_input">
                <label for="DEF_f" class="label" id="DEF_f_text">DE (d):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="DEF_f" id="DEF_f" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['DEF_f']) ? $_POST['DEF_f'] : '15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <div id="DEF_f_unit_main">
                        <label for="DEF_f_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('DEF_f_unit_dropdown')">{{ isset($_POST['DEF_f_unit'])?$_POST['DEF_f_unit']:'cm' }} ▾</label>
                        <input type="text" name="DEF_f_unit" value="{{ isset($_POST['DEF_f_unit'])?$_POST['DEF_f_unit']:'cm' }}" id="DEF_f_unit" class="hidden">
                        <div id="DEF_f_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="DEF_f_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_f_unit', 'mm')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_f_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_f_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_f_unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_f_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_f_unit', 'ft')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_f_unit', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_f_unit', 'mi')">miles (mi)</p>
                        </div>
                    </div>
                    <div class="hidden" id="DEF_f_deg_rad_main">
                        <label for="DEF_f_deg_rad" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('DEF_f_deg_rad_dropdown')">{{ isset($_POST['DEF_f_deg_rad'])?$_POST['DEF_f_deg_rad']:'rad' }} ▾</label>
                        <input type="text" name="DEF_f_deg_rad" value="{{ isset($_POST['DEF_f_deg_rad'])?$_POST['DEF_f_deg_rad']:'rad' }}" id="DEF_f_deg_rad" class="hidden">
                        <div id="DEF_f_deg_rad_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="DEF_f_deg_rad">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_f_deg_rad', 'deg')">degrees (deg)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_f_deg_rad', 'rad')">radians (rad)</p>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-4 lg:col-span-4 DEF_inputs DEF_s_input">
                <label for="DEF_s" class="label" id="DEF_s_text">EF (e):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="DEF_s" id="DEF_s" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['DEF_s']) ? $_POST['DEF_s'] : '15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <div id="DEF_s_unit_main">
                        <label for="DEF_s_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('DEF_s_unit_dropdown')">{{ isset($_POST['DEF_s_unit'])?$_POST['DEF_s_unit']:'cm' }} ▾</label>
                        <input type="text" name="DEF_s_unit" value="{{ isset($_POST['DEF_s_unit'])?$_POST['DEF_s_unit']:'cm' }}" id="DEF_s_unit" class="hidden">
                        <div id="DEF_s_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="DEF_s_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_s_unit', 'mm')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_s_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_s_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_s_unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_s_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_s_unit', 'ft')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_s_unit', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_s_unit', 'mi')">miles (mi)</p>
                        </div>
                    </div>
                    <div class="hidden" id="DEF_s_deg_rad_main">
                        <label for="DEF_s_deg_rad" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('DEF_s_deg_rad_dropdown')">{{ isset($_POST['DEF_s_deg_rad'])?$_POST['DEF_s_deg_rad']:'rad' }} ▾</label>
                        <input type="text" name="DEF_s_deg_rad" value="{{ isset($_POST['DEF_s_deg_rad'])?$_POST['DEF_s_deg_rad']:'rad' }}" id="DEF_s_deg_rad" class="hidden">
                        <div id="DEF_s_deg_rad_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="DEF_s_deg_rad">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_s_deg_rad', 'deg')">degrees (deg)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_s_deg_rad', 'rad')">radians (rad)</p>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-4 lg:col-span-4 DEF_inputs" id="DEF_third_input">
                <label for="DEF_t" class="label" id="DEF_t_text">DF (f):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="DEF_t" id="DEF_t" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['DEF_t']) ? $_POST['DEF_t'] : '15' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <div id="DEF_t_unit_main">
                        <label for="DEF_t_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('DEF_t_unit_dropdown')">{{ isset($_POST['DEF_t_unit'])?$_POST['DEF_t_unit']:'cm' }} ▾</label>
                        <input type="text" name="DEF_t_unit" value="{{ isset($_POST['DEF_t_unit'])?$_POST['DEF_t_unit']:'cm' }}" id="DEF_t_unit" class="hidden">
                        <div id="DEF_t_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="DEF_t_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_t_unit', 'mm')">millimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_t_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_t_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_t_unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_t_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_t_unit', 'ft')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_t_unit', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_t_unit', 'mi')">miles (mi)</p>
                        </div>
                    </div>
                    <div class="hidden" id="DEF_t_deg_rad_main">

                        <label for="DEF_t_deg_rad" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('DEF_t_deg_rad_dropdown')">{{ isset($_POST['DEF_t_deg_rad'])?$_POST['DEF_t_deg_rad']:'rad' }} ▾</label>
                        <input type="text" name="DEF_t_deg_rad" value="{{ isset($_POST['DEF_t_deg_rad'])?$_POST['DEF_t_deg_rad']:'rad' }}" id="DEF_t_deg_rad" class="hidden">
                        <div id="DEF_t_deg_rad_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="DEF_t_deg_rad">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_t_deg_rad', 'deg')">degrees (deg)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_t_deg_rad', 'rad')">radians (rad)</p>
                        </div>


                    </div>
                 </div>
            </div>
            <div class="col-span-12 hidden" id="corresponding_DEF">
                <label for="DEF_corresponding" class="label"><?= $lang[8] ?> △DEF:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="DEF_corresponding" id="DEF_corresponding" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['DEF_corresponding']) ? $_POST['DEF_corresponding'] : '21' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="DEF_corresponding_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('DEF_corresponding_unit_dropdown')">{{ isset($_POST['DEF_corresponding_unit'])?$_POST['DEF_corresponding_unit']:'kg' }} ▾</label>
                    <input type="text" name="DEF_corresponding_unit" value="{{ isset($_POST['DEF_corresponding_unit'])?$_POST['DEF_corresponding_unit']:'kg' }}" id="DEF_corresponding_unit" class="hidden">
                    <div id="DEF_corresponding_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="DEF_corresponding_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_corresponding_unit', 'mm')">millimeters (mm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_corresponding_unit', 'cm')">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_corresponding_unit', 'm')">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_corresponding_unit', 'km')">kilometers (km)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_corresponding_unit', 'in')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_corresponding_unit', 'ft')">feets (ft)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_corresponding_unit', 'yd')">yards (yd)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('DEF_corresponding_unit', 'mi')">miles (mi)</p>
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
                    <div class="w-full">
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full font-s-18">
                                @if($request->type === "2")
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong><?= $lang[13] ?> △ABC</strong></td>
                                        <td class="py-2 border-b">△ABC <?= $detail['ABC_area_ans'] ?> (cm²)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong><?= $lang[14] ?> △ABC</strong></td>
                                        <td class="py-2 border-b">△ABC <?= $detail['ABC_perimeter_ans'] ?> (cm)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>DE (d)</strong></td>
                                        <td class="py-2 border-b">△ABC <?= $detail['DEF_f_ans'] ?> (cm)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>EF (e)</strong></td>
                                        <td class="py-2 border-b">△ABC <?= $detail['DEF_s_ans'] ?> (cm)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong>DF (f)</strong></td>
                                        <td class="py-2 border-b">△ABC <?= $detail['DEF_t_ans'] ?> (cm)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong><?= $lang[13] ?> △DEF</strong></td>
                                        <td class="py-2 border-b">△ABC <?= $detail['DEF_area_ans'] ?> (cm²)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="50%"><strong><?= $lang[14] ?> △DEF</strong></td>
                                        <td class="py-2 border-b">△ABC <?= $detail['DEF_perimeter_ans'] ?> (cm)</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong><?= $lang[10] ?></strong></td>
                                        <td class="py-2 border-b">△ABC <?= $detail['symbol'] ?> △DEF</td>
                                    </tr>
                                    @if($request->similarity === "ASA" && $detail['jawab'] === "equal")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong><?= $lang[9] ?> (k)</strong></td>
                                            <td class="py-2 border-b"><?= $detail['scale_ans'] ?></td>
                                        </tr>
                                    @endif
                                    @if($request->similarity === "ASA")
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>∠ACB (γ₁)</strong></td>
                                            <td class="py-2 border-b"><?= $detail['ACB_jawab'] ?> (deg)</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>∠DFE (γ₂)</strong></td>
                                            <td class="py-2 border-b"><?= $detail['DEF_jawab'] ?> (deg)</td>
                                        </tr>
                                    @endif
                                @endif
                            </table>
                        </div>
                        @if($request->type === "1")
                            <p class="mt-2"><?= ($detail['jawab'] === "equal") ? "$lang[11]" : "$lang[12]"; ?></p> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        <script>
            // function select_similarity(element) {
            //     var similarity_val = element.value;
            //     var addClass = function(elements, className) {
            //         elements.forEach(function(element) {
            //             element.classList.add(className);
            //         });
            //     };
            //     var removeClass = function(elements, className) {
            //         elements.forEach(function(element) {
            //             element.classList.remove(className);
            //         });
            //     };
            //     var ABC_f_deg_rad = document.getElementById("ABC_f_deg_rad_main");
            //     var ABC_s_deg_rad = document.getElementById("ABC_s_deg_rad_main");
            //     var ABC_t_deg_rad = document.getElementById("ABC_t_deg_rad_main");
            //     var DEF_f_deg_rad = document.getElementById("DEF_f_deg_rad_main");
            //     var DEF_s_deg_rad = document.getElementById("DEF_s_deg_rad_main");
            //     var DEF_t_deg_rad = document.getElementById("DEF_t_deg_rad_main");
            //     var corresponding_ABC = document.getElementById("corresponding_ABC");
            //     var corresponding_DEF = document.getElementById("corresponding_DEF");
            //     var ABC_f_unit = document.getElementById("ABC_f_unit_main");
            //     var ABC_s_unit = document.getElementById("ABC_s_unit_main");
            //     var ABC_t_unit = document.getElementById("ABC_t_unit_main");
            //     var DEF_f_unit = document.getElementById("DEF_f_unit_main");
            //     var DEF_s_unit = document.getElementById("DEF_s_unit_main");
            //     var DEF_t_unit = document.getElementById("DEF_t_unit_main");
            //     var ABC_third_input = document.getElementById("ABC_third_input");
            //     var DEF_third_input = document.getElementById("DEF_third_input");
            //     var ABC_f = document.getElementById("ABC_f_text");
            //     var ABC_s = document.getElementById("ABC_s_text");
            //     var ABC_t = document.getElementById("ABC_t_text");
            //     var DEF_f = document.getElementById("DEF_f_text");
            //     var DEF_s = document.getElementById("DEF_s_text");
            //     var DEF_t = document.getElementById("DEF_t_text");
            //     if (similarity_val === "SSS") {
            //         addClass([ABC_f_deg_rad, ABC_s_deg_rad, ABC_t_deg_rad, DEF_f_deg_rad, DEF_s_deg_rad, DEF_t_deg_rad, corresponding_ABC, corresponding_DEF], 'hidden');
            //         removeClass([ABC_f_unit, ABC_s_unit, ABC_t_unit, DEF_f_unit, DEF_s_unit, DEF_t_unit, ABC_third_input, DEF_third_input], 'hidden');
            //         ABC_f.textContent = "AB (a)";
            //         ABC_s.textContent = "BC (b)";
            //         ABC_t.textContent = "AC (c)";
            //         DEF_f.textContent = "DE (d)";
            //         DEF_s.textContent = "EF (e)";
            //         DEF_t.textContent = "DF (f)";
            //         ['.ABC_f_input', '.ABC_s_input', '.DEF_f_input', '.DEF_s_input'].forEach(function(selector) {
            //             document.querySelectorAll(selector).forEach(function(element) {
            //                 element.classList.add('col-lg-4');
            //                 element.classList.remove('col-lg-6');
            //             });
            //         });
            //     } else if (similarity_val === "SAS") {
            //         addClass([ABC_f_deg_rad, ABC_s_deg_rad, ABC_t_unit, DEF_f_deg_rad, DEF_s_deg_rad, DEF_t_unit, corresponding_ABC, corresponding_DEF], 'hidden');
            //         removeClass([ABC_f_unit, ABC_s_unit, ABC_t_deg_rad, DEF_f_unit, DEF_s_unit, DEF_t_deg_rad, ABC_third_input, DEF_third_input], 'hidden');
            //         ABC_f.textContent = "AB (a)";
            //         ABC_s.textContent = "BC (b)";
            //         ABC_t.textContent = "∠BAC (α₁)";
            //         DEF_f.textContent = "DE (d)";
            //         DEF_s.textContent = "EF (e)";
            //         DEF_t.textContent = "∠EDF (α₂)";
            //         ['.ABC_f_input', '.ABC_s_input', '.DEF_f_input', '.DEF_s_input'].forEach(function(selector) {
            //             document.querySelectorAll(selector).forEach(function(element) {
            //                 element.classList.add('col-lg-4');
            //                 element.classList.remove('col-lg-6');
            //             });
            //         });
            //     } else {
            //         addClass([ABC_f_unit, ABC_s_unit, ABC_t_unit, DEF_f_unit, DEF_s_unit, DEF_t_unit, ABC_third_input, DEF_third_input], 'hidden');
            //         removeClass([ABC_f_deg_rad, ABC_s_deg_rad, ABC_t_deg_rad, DEF_f_deg_rad, DEF_s_deg_rad, DEF_t_deg_rad, corresponding_ABC, corresponding_DEF], 'hidden');
            //         ABC_f.textContent = "∠BAC (α₁)";
            //         ABC_s.textContent = "∠ABC (β₁)";
            //         ABC_t.textContent = "∠ACB (γ₁)";
            //         DEF_f.textContent = "∠EDF (α₂)";
            //         DEF_s.textContent = "∠DEF (β₂)";
            //         DEF_t.textContent = "∠DFE (γ₂)";
            //         ['.ABC_f_input', '.ABC_s_input', '.DEF_f_input', '.DEF_s_input'].forEach(function(selector) {
            //             document.querySelectorAll(selector).forEach(function(element) {
            //                 element.classList.remove('col-lg-4');
            //                 element.classList.add('col-lg-6');
            //             });
            //         });
            //     }
            // }
            // document.getElementById('type').addEventListener('change', function() {
            //     var findValue = this.value
            //     switch (findValue) {
            //         case '1':
            //             var addClass = function(elements, className) {
            //                 elements.forEach(function(element) {
            //                     element.classList.add(className);
            //                 });
            //             };
            //             var removeClass = function(elements, className) {
            //                 elements.forEach(function(element) {
            //                     element.classList.remove(className);
            //                 });
            //             };
            //             var ABC_f_deg_rad = document.getElementById("ABC_f_deg_rad_main");
            //             var ABC_s_deg_rad = document.getElementById("ABC_s_deg_rad_main");
            //             var ABC_t_deg_rad = document.getElementById("ABC_t_deg_rad_main");
            //             var DEF_f_deg_rad = document.getElementById("DEF_f_deg_rad_main");
            //             var DEF_s_deg_rad = document.getElementById("DEF_s_deg_rad_main");
            //             var DEF_t_deg_rad = document.getElementById("DEF_t_deg_rad_main");
            //             var corresponding_ABC = document.getElementById("corresponding_ABC");
            //             var corresponding_DEF = document.getElementById("corresponding_DEF");
            //             var ABC_f_unit = document.getElementById("ABC_f_unit_main");
            //             var ABC_s_unit = document.getElementById("ABC_s_unit_main");
            //             var ABC_t_unit = document.getElementById("ABC_t_unit_main");
            //             var DEF_f_unit = document.getElementById("DEF_f_unit_main");
            //             var DEF_s_unit = document.getElementById("DEF_s_unit_main");
            //             var DEF_t_unit = document.getElementById("DEF_t_unit_main");
            //             var ABC_third_input = document.getElementById("ABC_third_input");
            //             var DEF_third_input = document.getElementById("DEF_third_input");
            //             var ABC_f = document.getElementById("ABC_f_text");
            //             var ABC_s = document.getElementById("ABC_s_text");
            //             var ABC_t = document.getElementById("ABC_t_text");
            //             var DEF_f = document.getElementById("DEF_f_text");
            //             var DEF_s = document.getElementById("DEF_s_text");
            //             var DEF_t = document.getElementById("DEF_t_text");
            //             var similarityValue = document.getElementById("similarity").value;
            //             if (similarityValue === "SSS") {
            //                 addClass([ABC_f_deg_rad, ABC_s_deg_rad, ABC_t_deg_rad, DEF_f_deg_rad, DEF_s_deg_rad, DEF_t_deg_rad, corresponding_ABC, corresponding_DEF], 'hidden');
            //                 removeClass([ABC_f_unit, ABC_s_unit, ABC_t_unit, DEF_f_unit, DEF_s_unit, DEF_t_unit, ABC_third_input, DEF_third_input], 'hidden');
            //                 ABC_f.textContent = "AB (a)";
            //                 ABC_s.textContent = "BC (b)";
            //                 ABC_t.textContent = "AC (c)";
            //                 DEF_f.textContent = "DE (d)";
            //                 DEF_s.textContent = "EF (e)";
            //                 DEF_t.textContent = "DF (f)";
            //                 ['.ABC_f_input', '.ABC_s_input', '.DEF_f_input', '.DEF_s_input'].forEach(function(selector) {
            //                     document.querySelectorAll(selector).forEach(function(element) {
            //                         element.classList.add('col-lg-4');
            //                         element.classList.remove('col-lg-6');
            //                     });
            //                 });
            //             } else if (similarityValue === "SAS") {
            //                 addClass([ABC_f_deg_rad, ABC_s_deg_rad, ABC_t_unit, DEF_f_deg_rad, DEF_s_deg_rad, DEF_t_unit, corresponding_ABC, corresponding_DEF], 'hidden');
            //                 removeClass([ABC_f_unit, ABC_s_unit, ABC_t_deg_rad, DEF_f_unit, DEF_s_unit, DEF_t_deg_rad, ABC_third_input, DEF_third_input], 'hidden');
            //                 ABC_f.textContent = "AB (a)";
            //                 ABC_s.textContent = "BC (b)";
            //                 ABC_t.textContent = "∠BAC (α₁)";
            //                 DEF_f.textContent = "DE (d)";
            //                 DEF_s.textContent = "EF (e)";
            //                 DEF_t.textContent = "∠EDF (α₂)";
            //                 ['.ABC_f_input', '.ABC_s_input', '.DEF_f_input', '.DEF_s_input'].forEach(function(selector) {
            //                     document.querySelectorAll(selector).forEach(function(element) {
            //                         element.classList.add('col-lg-4');
            //                         element.classList.remove('col-lg-6');
            //                     });
            //                 });
            //             } else {
            //                 addClass([ABC_f_unit, ABC_s_unit, ABC_t_unit, DEF_f_unit, DEF_s_unit, DEF_t_unit, ABC_third_input, DEF_third_input], 'hidden');
            //                 removeClass([ABC_f_deg_rad, ABC_s_deg_rad, ABC_t_deg_rad, DEF_f_deg_rad, DEF_s_deg_rad, DEF_t_deg_rad, corresponding_ABC, corresponding_DEF], 'hidden');
            //                 ABC_f.textContent = "∠BAC (α₁)";
            //                 ABC_s.textContent = "∠ABC (β₁)";
            //                 ABC_t.textContent = "∠ACB (γ₁)";
            //                 DEF_f.textContent = "∠EDF (α₂)";
            //                 DEF_s.textContent = "∠DEF (β₂)";
            //                 DEF_t.textContent = "∠DFE (γ₂)";
            //                 ['.ABC_f_input', '.ABC_s_input', '.DEF_f_input', '.DEF_s_input'].forEach(function(selector) {
            //                     document.querySelectorAll(selector).forEach(function(element) {
            //                         element.classList.remove('col-lg-4');
            //                         element.classList.add('col-lg-6');
            //                     });
            //                 });
            //             }
            //             ['#scale_factor_input'].forEach(function(selector) {
            //                 document.querySelectorAll(selector).forEach(function(element) {
            //                     element.classList.add('hidden');
            //                 });
            //             });
            //             ['.similarity_criterion_select_select'].forEach(function(selector) {
            //                 document.querySelectorAll(selector).forEach(function(element) {
            //                     element.classList.remove('hidden');
            //                 });
            //             });
            //            break;
            //         case '2':
            //             document.getElementById("ABC_f_text").textContent = "AB (a)";
            //             document.getElementById("ABC_s_text").textContent = "BC (b)";
            //             document.getElementById("ABC_t_text").textContent = "AC (c)";
            //             ['.ABC_f_input', '.ABC_s_input', '#ABC_third_input'].forEach(function(selector) {
            //                 document.querySelectorAll(selector).forEach(function(element) {
            //                     element.classList.remove('col-lg-4');
            //                     element.classList.add('col-lg-6');
            //                 });
            //             });
            //             ['.ABC_f_input', '.ABC_s_input', '#ABC_third_input', '#scale_factor_input'].forEach(function(selector) {
            //                 document.querySelectorAll(selector).forEach(function(element) {
            //                     element.classList.remove('hidden');
            //                 });
            //             });
            //             ['.similarity_criterion_select_select', '.DEF_inputs', '#corresponding_DEF', '#corresponding_ABC'].forEach(function(selector) {
            //                 document.querySelectorAll(selector).forEach(function(element) {
            //                     element.classList.add('hidden');
            //                 });
            //             });
            //            break;
            //    }
            // });
            function select_similarity(element) {
                let similarity_val = element.value;
                if(similarity_val === "SSS"){
                    document.getElementById("ABC_f_deg_rad_main").classList.add('hidden');
                    document.getElementById("ABC_s_deg_rad_main").classList.add('hidden');
                    document.getElementById("ABC_t_deg_rad_main").classList.add('hidden');
                    document.getElementById("DEF_f_deg_rad_main").classList.add('hidden');
                    document.getElementById("DEF_s_deg_rad_main").classList.add('hidden');
                    document.getElementById("DEF_t_deg_rad_main").classList.add('hidden');
                    document.getElementById("corresponding_ABC").classList.add('hidden');
                    document.getElementById("corresponding_DEF").classList.add('hidden');
                    document.getElementById("ABC_f_unit_main").classList.remove('hidden');
                    document.getElementById("ABC_s_unit_main").classList.remove('hidden');
                    document.getElementById("ABC_t_unit_main").classList.remove('hidden');
                    document.getElementById("DEF_f_unit_main").classList.remove('hidden');
                    document.getElementById("DEF_s_unit_main").classList.remove('hidden');
                    document.getElementById("DEF_t_unit_main").classList.remove('hidden');
                    document.getElementById("ABC_third_input").classList.remove('hidden');
                    document.getElementById("DEF_third_input").classList.remove('hidden');
                    document.getElementById("ABC_f_text").innerText = "AB (a)";
                    document.getElementById("ABC_s_text").innerText = "BC (b)";
                    document.getElementById("ABC_t_text").innerText = "AC (c)";
                    document.getElementById("DEF_f_text").innerText = "DE (d)";
                    document.getElementById("DEF_s_text").innerText = "EF (e)";
                    document.getElementById("DEF_t_text").innerText = "DF (f)";
                } else if(similarity_val === "SAS"){
                    document.getElementById("ABC_f_deg_rad_main").classList.add('hidden');
                    document.getElementById("ABC_s_deg_rad_main").classList.add('hidden');
                    document.getElementById("ABC_t_unit_main").classList.add('hidden');
                    document.getElementById("DEF_f_deg_rad_main").classList.add('hidden');
                    document.getElementById("DEF_s_deg_rad_main").classList.add('hidden');
                    document.getElementById("DEF_t_unit_main").classList.add('hidden');
                    document.getElementById("corresponding_ABC").classList.add('hidden');
                    document.getElementById("corresponding_DEF").classList.add('hidden');
                    document.getElementById("ABC_f_unit_main").classList.remove('hidden');
                    document.getElementById("ABC_s_unit_main").classList.remove('hidden');
                    document.getElementById("ABC_t_deg_rad_main").classList.remove('hidden');
                    document.getElementById("DEF_f_unit_main").classList.remove('hidden');
                    document.getElementById("DEF_s_unit_main").classList.remove('hidden');
                    document.getElementById("DEF_t_deg_rad_main").classList.remove('hidden');
                    document.getElementById("ABC_third_input").classList.remove('hidden');
                    document.getElementById("DEF_third_input").classList.remove('hidden');
                    document.getElementById("ABC_f_text").innerText = "AB (a)";
                    document.getElementById("ABC_s_text").innerText = "BC (b)";
                    document.getElementById("ABC_t_text").innerText = "∠BAC (α₁)";
                    document.getElementById("DEF_f_text").innerText = "DE (d)";
                    document.getElementById("DEF_s_text").innerText = "EF (e)";
                    document.getElementById("DEF_t_text").innerText = "∠EDF (α₂)";
                } else {
                    document.getElementById("ABC_f_unit_main").classList.add('hidden');
                    document.getElementById("ABC_s_unit_main").classList.add('hidden');
                    document.getElementById("ABC_t_unit_main").classList.add('hidden');
                    document.getElementById("DEF_f_unit_main").classList.add('hidden');
                    document.getElementById("DEF_s_unit_main").classList.add('hidden');
                    document.getElementById("DEF_t_unit_main").classList.add('hidden');
                    document.getElementById("ABC_third_input").classList.add('hidden');
                    document.getElementById("DEF_third_input").classList.add('hidden');
                    document.getElementById("ABC_f_deg_rad_main").classList.remove('hidden');
                    document.getElementById("ABC_s_deg_rad_main").classList.remove('hidden');
                    document.getElementById("ABC_t_deg_rad_main").classList.remove('hidden');
                    document.getElementById("DEF_f_deg_rad_main").classList.remove('hidden');
                    document.getElementById("DEF_s_deg_rad_main").classList.remove('hidden');
                    document.getElementById("DEF_t_deg_rad_main").classList.remove('hidden');
                    document.getElementById("corresponding_ABC").classList.remove('hidden');
                    document.getElementById("corresponding_DEF").classList.remove('hidden');
                    document.getElementById("ABC_f_text").innerText = "∠BAC (α₁)";
                    document.getElementById("ABC_s_text").innerText = "∠ABC (β₁)";
                    document.getElementById("ABC_t_text").innerText = "∠ACB (γ₁)";
                    document.getElementById("DEF_f_text").innerText = "∠EDF (α₂)";
                    document.getElementById("DEF_s_text").innerText = "∠DEF (β₂)";
                    document.getElementById("DEF_t_text").innerText = "∠DFE (γ₂)";
                }
            }
            function select_type(element) {
                let type_val = element.value;
                if (type_val === "1") {
                    document.getElementById("scale_factor_input").classList.add('hidden');
                    document.getElementById("similarity_criterion_select").classList.remove('hidden');
                    document.querySelectorAll(".DEF_inputs").forEach(input => {
                        input.classList.remove('hidden');
                    });
                    document.getElementById("corresponding_DEF").classList.remove('hidden');
                    document.getElementById("corresponding_ABC").classList.remove('hidden');
                } else {
                    document.getElementById("scale_factor_input").classList.remove('hidden');
                    document.getElementById("similarity_criterion_select").classList.add('hidden');
                    document.querySelectorAll(".DEF_inputs").forEach(input => {
                        input.classList.add('hidden');
                    });
                    document.getElementById("corresponding_DEF").classList.add('hidden');
                    document.getElementById("corresponding_ABC").classList.add('hidden');
                }
            }
       </script>
       @isset($detail)
           <script>
                let typeValue = "{{$request->type}}";
                let similarityValue = "{{$request->similarity}}";
                if(similarityValue === "SSS"){
                    document.getElementById("ABC_f_deg_rad_main").classList.add('hidden');
                    document.getElementById("ABC_s_deg_rad_main").classList.add('hidden');
                    document.getElementById("ABC_t_deg_rad_main").classList.add('hidden');
                    document.getElementById("DEF_f_deg_rad_main").classList.add('hidden');
                    document.getElementById("DEF_s_deg_rad_main").classList.add('hidden');
                    document.getElementById("DEF_t_deg_rad_main").classList.add('hidden');
                    document.getElementById("corresponding_ABC").classList.add('hidden');
                    document.getElementById("corresponding_DEF").classList.add('hidden');
                    document.getElementById("ABC_f_unit_main").classList.remove('hidden');
                    document.getElementById("ABC_s_unit_main").classList.remove('hidden');
                    document.getElementById("ABC_t_unit_main").classList.remove('hidden');
                    document.getElementById("DEF_f_unit_main").classList.remove('hidden');
                    document.getElementById("DEF_s_unit_main").classList.remove('hidden');
                    document.getElementById("DEF_t_unit_main").classList.remove('hidden');
                    document.getElementById("ABC_third_input").classList.remove('hidden');
                    document.getElementById("DEF_third_input").classList.remove('hidden');
                    document.getElementById("ABC_f_text").innerText = "AB (a)";
                    document.getElementById("ABC_s_text").innerText = "BC (b)";
                    document.getElementById("ABC_t_text").innerText = "AC (c)";
                    document.getElementById("DEF_f_text").innerText = "DE (d)";
                    document.getElementById("DEF_s_text").innerText = "EF (e)";
                    document.getElementById("DEF_t_text").innerText = "DF (f)";
                } else if(similarityValue === "SAS"){
                    document.getElementById("ABC_f_deg_rad_main").classList.add('hidden');
                    document.getElementById("ABC_s_deg_rad_main").classList.add('hidden');
                    document.getElementById("ABC_t_unit_main").classList.add('hidden');
                    document.getElementById("DEF_f_deg_rad_main").classList.add('hidden');
                    document.getElementById("DEF_s_deg_rad_main").classList.add('hidden');
                    document.getElementById("DEF_t_unit_main").classList.add('hidden');
                    document.getElementById("corresponding_ABC").classList.add('hidden');
                    document.getElementById("corresponding_DEF").classList.add('hidden');
                    document.getElementById("ABC_f_unit_main").classList.remove('hidden');
                    document.getElementById("ABC_s_unit_main").classList.remove('hidden');
                    document.getElementById("ABC_t_deg_rad_main").classList.remove('hidden');
                    document.getElementById("DEF_f_unit_main").classList.remove('hidden');
                    document.getElementById("DEF_s_unit_main").classList.remove('hidden');
                    document.getElementById("DEF_t_deg_rad_main").classList.remove('hidden');
                    document.getElementById("ABC_third_input").classList.remove('hidden');
                    document.getElementById("DEF_third_input").classList.remove('hidden');
                    document.getElementById("ABC_f_text").innerText = "AB (a)";
                    document.getElementById("ABC_s_text").innerText = "BC (b)";
                    document.getElementById("ABC_t_text").innerText = "∠BAC (α₁)";
                    document.getElementById("DEF_f_text").innerText = "DE (d)";
                    document.getElementById("DEF_s_text").innerText = "EF (e)";
                    document.getElementById("DEF_t_text").innerText = "∠EDF (α₂)";
                } else {
                    document.getElementById("ABC_f_unit_main").classList.add('hidden');
                    document.getElementById("ABC_s_unit_main").classList.add('hidden');
                    document.getElementById("ABC_t_unit_main").classList.add('hidden');
                    document.getElementById("DEF_f_unit_main").classList.add('hidden');
                    document.getElementById("DEF_s_unit_main").classList.add('hidden');
                    document.getElementById("DEF_t_unit_main").classList.add('hidden');
                    document.getElementById("ABC_third_input").classList.add('hidden');
                    document.getElementById("DEF_third_input").classList.add('hidden');
                    document.getElementById("ABC_f_deg_rad_main").classList.remove('hidden');
                    document.getElementById("ABC_s_deg_rad_main").classList.remove('hidden');
                    document.getElementById("ABC_t_deg_rad_main").classList.remove('hidden');
                    document.getElementById("DEF_f_deg_rad_main").classList.remove('hidden');
                    document.getElementById("DEF_s_deg_rad_main").classList.remove('hidden');
                    document.getElementById("DEF_t_deg_rad_main").classList.remove('hidden');
                    document.getElementById("corresponding_ABC").classList.remove('hidden');
                    document.getElementById("corresponding_DEF").classList.remove('hidden');
                    document.getElementById("ABC_f_text").innerText = "∠BAC (α₁)";
                    document.getElementById("ABC_s_text").innerText = "∠ABC (β₁)";
                    document.getElementById("ABC_t_text").innerText = "∠ACB (γ₁)";
                    document.getElementById("DEF_f_text").innerText = "∠EDF (α₂)";
                    document.getElementById("DEF_s_text").innerText = "∠DEF (β₂)";
                    document.getElementById("DEF_t_text").innerText = "∠DFE (γ₂)";
                }

                if (typeValue === "1") {
                    document.getElementById("scale_factor_input").classList.add('hidden');
                    document.getElementById("similarity_criterion_select").classList.remove('hidden');
                    document.querySelectorAll(".DEF_inputs").forEach(input => {
                        input.classList.remove('hidden');
                    });
                    document.getElementById("corresponding_DEF").classList.remove('hidden');
                    document.getElementById("corresponding_ABC").classList.remove('hidden');
                } else {
                    document.getElementById("scale_factor_input").classList.remove('hidden');
                    document.getElementById("similarity_criterion_select").classList.add('hidden');
                    document.querySelectorAll(".DEF_inputs").forEach(input => {
                        input.classList.add('hidden');
                    });
                    document.getElementById("corresponding_DEF").classList.add('hidden');
                    document.getElementById("corresponding_ABC").classList.add('hidden');
                }
           </script>
       @endisset
    @endpush
</form>