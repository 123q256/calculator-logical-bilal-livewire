<style>
    .hidden1{
        display: none;
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
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-6 ">
                <div class="row">
                    <div class="col-lg-12">
                        <label for="volume_select" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <div class="w-full py-2">
                            <select name="volume_select" id="volume_select" class="input">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                        {{ $arr2[$index] }}
                                    </option>
                                @php
                                    }}
                                    $name = ["Rectangular Box", "Cube", "Cylinder", "Cone", "Sphere", "Triangular Prism", "Pyramid", "Capsule", "Hemisphere", "Hollow cylinder / tube", "Conical frustum", "Truncated pyramid", "Ellipsoid", "Square", "Column"];
                                    $val = ["Rectangular", "Cube", "Cylinder", "Cone", "Sphere", "Triangular", "Pyramid", "Capsule", "Hemisphere", "Hollow", "Conical", "Truncated", "Ellipsoid", "Square", "Column"];
                                    optionsList($val,$name,isset($_POST['volume_select'])?$_POST['volume_select']:'Rectangular');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-12 hidden1" id="Rectangular">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="rec_width" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="rec_width" id="rec_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['rec_width']) ? $_POST['rec_width'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="rec_width_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('rec_width_units_dropdown')">{{ isset($_POST['rec_width_units'])?$_POST['rec_width_units']:'cm' }} ▾</label>
                                    <input type="text" name="rec_width_units" value="{{ isset($_POST['rec_width_units'])?$_POST['rec_width_units']:'cm' }}" id="rec_width_units" class="hidden">
                                    <div id="rec_width_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="rec_width_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rec_width_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rec_width_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rec_width_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rec_width_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rec_width_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6 ps-lg-0 ps-0">
                                <label for="rec_length" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="rec_length" id="rec_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['rec_length']) ? $_POST['rec_length'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="rec_length_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('rec_length_units_dropdown')">{{ isset($_POST['rec_length_units'])?$_POST['rec_length_units']:'cm' }} ▾</label>
                                    <input type="text" name="rec_length_units" value="{{ isset($_POST['rec_length_units'])?$_POST['rec_length_units']:'cm' }}" id="rec_length_units" class="hidden">
                                    <div id="rec_length_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="rec_length_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rec_length_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rec_length_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rec_length_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rec_length_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rec_length_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="rec_height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="rec_height" id="rec_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['rec_height']) ? $_POST['rec_height'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="rec_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('rec_height_units_dropdown')">{{ isset($_POST['rec_height_units'])?$_POST['rec_height_units']:'cm' }} ▾</label>
                                    <input type="text" name="rec_height_units" value="{{ isset($_POST['rec_height_units'])?$_POST['rec_height_units']:'cm' }}" id="rec_height_units" class="hidden">
                                    <div id="rec_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="rec_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rec_height_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rec_height_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rec_height_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rec_height_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('rec_height_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 hidden" id="Cube">
                        <label for="cub_side" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="cub_side" id="cub_side" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cub_side']) ? $_POST['cub_side'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="cub_side_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cub_side_units_dropdown')">{{ isset($_POST['cub_side_units'])?$_POST['cub_side_units']:'cm' }} ▾</label>
                            <input type="text" name="cub_side_units" value="{{ isset($_POST['cub_side_units'])?$_POST['cub_side_units']:'cm' }}" id="cub_side_units" class="hidden">
                            <div id="cub_side_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cub_side_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cub_side_units', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cub_side_units', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cub_side_units', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cub_side_units', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cub_side_units', 'yd')">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                    <div class="col-12 hidden1" id="Cylinder">
                        <div class="row"> 
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="cyl_height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="cyl_height" id="cyl_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cyl_height']) ? $_POST['cyl_height'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="cyl_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cyl_height_units_dropdown')">{{ isset($_POST['cyl_height_units'])?$_POST['cyl_height_units']:'cm' }} ▾</label>
                                    <input type="text" name="cyl_height_units" value="{{ isset($_POST['cyl_height_units'])?$_POST['cyl_height_units']:'cm' }}" id="cyl_height_units" class="hidden">
                                    <div id="cyl_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cyl_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cyl_height_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cyl_height_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cyl_height_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cyl_height_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cyl_height_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="cyl_diameter" class="font-s-14 text-blue">{{ $lang['6'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="cyl_diameter" id="cyl_diameter" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cyl_diameter']) ? $_POST['cyl_diameter'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="cyl_diameter_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cyl_diameter_units_dropdown')">{{ isset($_POST['cyl_diameter_units'])?$_POST['cyl_diameter_units']:'cm' }} ▾</label>
                                    <input type="text" name="cyl_diameter_units" value="{{ isset($_POST['cyl_diameter_units'])?$_POST['cyl_diameter_units']:'cm' }}" id="cyl_diameter_units" class="hidden">
                                    <div id="cyl_diameter_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cyl_diameter_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cyl_diameter_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cyl_diameter_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cyl_diameter_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cyl_diameter_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cyl_diameter_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 hidden1" id="Cone">
                        <div class="row">

                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="con_height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="con_height" id="con_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['con_height']) ? $_POST['con_height'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="con_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('con_height_units_dropdown')">{{ isset($_POST['con_height_units'])?$_POST['con_height_units']:'cm' }} ▾</label>
                                    <input type="text" name="con_height_units" value="{{ isset($_POST['con_height_units'])?$_POST['con_height_units']:'cm' }}" id="con_height_units" class="hidden">
                                    <div id="con_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="con_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_height_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_height_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_height_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_height_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_height_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="con_diameter" class="font-s-14 text-blue">{{ $lang['6'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="con_diameter" id="con_diameter" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['con_diameter']) ? $_POST['con_diameter'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="con_diameter_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('con_diameter_units_dropdown')">{{ isset($_POST['con_diameter_units'])?$_POST['con_diameter_units']:'cm' }} ▾</label>
                                    <input type="text" name="con_diameter_units" value="{{ isset($_POST['con_diameter_units'])?$_POST['con_diameter_units']:'cm' }}" id="con_diameter_units" class="hidden">
                                    <div id="con_diameter_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="con_diameter_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_diameter_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_diameter_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_diameter_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_diameter_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('con_diameter_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden1" id="Triangular">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="tri_base" class="font-s-14 text-blue">{{ $lang['5'] }} {{ $lang['3'] }} a</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="tri_base" id="tri_base" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['tri_base']) ? $_POST['tri_base'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="tri_base_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('tri_base_units_dropdown')">{{ isset($_POST['tri_base_units'])?$_POST['tri_base_units']:'cm' }} ▾</label>
                                    <input type="text" name="tri_base_units" value="{{ isset($_POST['tri_base_units'])?$_POST['tri_base_units']:'cm' }}" id="tri_base_units" class="hidden">
                                    <div id="tri_base_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tri_base_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_base_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_base_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_base_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_base_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_base_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="tri_length" class="font-s-14 text-blue">{{ $lang['5'] }} {{ $lang['3'] }} b</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="tri_length" id="tri_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['tri_length']) ? $_POST['tri_length'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="tri_length_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('tri_length_units_dropdown')">{{ isset($_POST['tri_length_units'])?$_POST['tri_length_units']:'cm' }} ▾</label>
                                    <input type="text" name="tri_length_units" value="{{ isset($_POST['tri_length_units'])?$_POST['tri_length_units']:'cm' }}" id="tri_length_units" class="hidden">
                                    <div id="tri_length_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tri_length_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_length_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_length_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_length_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_length_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_length_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="tri_height" class="font-s-14 text-blue">{{ $lang['5'] }} {{ $lang['3'] }} c</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="tri_height" id="tri_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['tri_height']) ? $_POST['tri_height'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="tri_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('tri_height_units_dropdown')">{{ isset($_POST['tri_height_units'])?$_POST['tri_height_units']:'cm' }} ▾</label>
                                    <input type="text" name="tri_height_units" value="{{ isset($_POST['tri_height_units'])?$_POST['tri_height_units']:'cm' }}" id="tri_height_units" class="hidden">
                                    <div id="tri_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tri_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_height_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_height_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_height_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_height_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_height_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="tri_h" class="font-s-14 text-blue">{{ $lang['4'] }} h</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="tri_h" id="tri_h" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['tri_h']) ? $_POST['tri_h'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="tri_h_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('tri_h_units_dropdown')">{{ isset($_POST['tri_h_units'])?$_POST['tri_h_units']:'cm' }} ▾</label>
                                    <input type="text" name="tri_h_units" value="{{ isset($_POST['tri_h_units'])?$_POST['tri_h_units']:'cm' }}" id="tri_h_units" class="hidden">
                                    <div id="tri_h_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tri_h_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_h_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_h_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_h_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_h_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tri_h_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="col-12 hidden1" id="Sphere">
                        <label for="sph_diameter" class="font-s-14 text-blue">{{ $lang['6'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="sph_diameter" id="sph_diameter" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['sph_diameter']) ? $_POST['sph_diameter'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="sph_diameter_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('sph_diameter_units_dropdown')">{{ isset($_POST['sph_diameter_units'])?$_POST['sph_diameter_units']:'cm' }} ▾</label>
                            <input type="text" name="sph_diameter_units" value="{{ isset($_POST['sph_diameter_units'])?$_POST['sph_diameter_units']:'cm' }}" id="sph_diameter_units" class="hidden">
                            <div id="sph_diameter_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="sph_diameter_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sph_diameter_units', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sph_diameter_units', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sph_diameter_units', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sph_diameter_units', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sph_diameter_units', 'yd')">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                    <div class="hidden1" id="Pyramid">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="pyr_height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="pyr_height" id="pyr_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pyr_height']) ? $_POST['pyr_height'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="pyr_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pyr_height_units_dropdown')">{{ isset($_POST['pyr_height_units'])?$_POST['pyr_height_units']:'cm' }} ▾</label>
                                    <input type="text" name="pyr_height_units" value="{{ isset($_POST['pyr_height_units'])?$_POST['pyr_height_units']:'cm' }}" id="pyr_height_units" class="hidden">
                                    <div id="pyr_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pyr_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pyr_height_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pyr_height_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pyr_height_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pyr_height_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pyr_height_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="pyr_side" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="pyr_side" id="pyr_side" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pyr_side']) ? $_POST['pyr_side'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="pyr_side_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pyr_side_units_dropdown')">{{ isset($_POST['pyr_side_units'])?$_POST['pyr_side_units']:'cm' }} ▾</label>
                                    <input type="text" name="pyr_side_units" value="{{ isset($_POST['pyr_side_units'])?$_POST['pyr_side_units']:'cm' }}" id="pyr_side_units" class="hidden">
                                    <div id="pyr_side_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pyr_side_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pyr_side_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pyr_side_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pyr_side_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pyr_side_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pyr_side_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden" id="Capsule">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="cap_height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="cap_height" id="cap_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cap_height']) ? $_POST['cap_height'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="cap_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cap_height_units_dropdown')">{{ isset($_POST['cap_height_units'])?$_POST['cap_height_units']:'cm' }} ▾</label>
                                    <input type="text" name="cap_height_units" value="{{ isset($_POST['cap_height_units'])?$_POST['cap_height_units']:'cm' }}" id="cap_height_units" class="hidden">
                                    <div id="cap_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cap_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cap_height_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cap_height_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cap_height_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cap_height_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cap_height_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="cap_radius" class="font-s-14 text-blue">{{ $lang['19'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="cap_radius" id="cap_radius" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cap_radius']) ? $_POST['cap_radius'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="cap_radius_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cap_radius_units_dropdown')">{{ isset($_POST['cap_radius_units'])?$_POST['cap_radius_units']:'cm' }} ▾</label>
                                    <input type="text" name="cap_radius_units" value="{{ isset($_POST['cap_radius_units'])?$_POST['cap_radius_units']:'cm' }}" id="cap_radius_units" class="hidden">
                                    <div id="cap_radius_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cap_radius_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cap_radius_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cap_radius_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cap_radius_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cap_radius_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cap_radius_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 hidden1" id="Hemisphere">
                        <label for="hem_radius" class="font-s-14 text-blue">{{ $lang['19'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="hem_radius" id="hem_radius" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['hem_radius']) ? $_POST['hem_radius'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="hem_radius_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('hem_radius_units_dropdown')">{{ isset($_POST['hem_radius_units'])?$_POST['hem_radius_units']:'cm' }} ▾</label>
                            <input type="text" name="hem_radius_units" value="{{ isset($_POST['hem_radius_units'])?$_POST['hem_radius_units']:'cm' }}" id="hem_radius_units" class="hidden">
                            <div id="hem_radius_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="hem_radius_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hem_radius_units', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hem_radius_units', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hem_radius_units', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hem_radius_units', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hem_radius_units', 'yd')">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                    <div class="hidden1" id="Hollow">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="hol_inner_dia" class="font-s-14 text-blue">{{ $lang['22'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="hol_inner_dia" id="hol_inner_dia" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['hol_inner_dia']) ? $_POST['hol_inner_dia'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="hol_inner_dia_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('hol_inner_dia_units_dropdown')">{{ isset($_POST['hol_inner_dia_units'])?$_POST['hol_inner_dia_units']:'cm' }} ▾</label>
                                    <input type="text" name="hol_inner_dia_units" value="{{ isset($_POST['hol_inner_dia_units'])?$_POST['hol_inner_dia_units']:'cm' }}" id="hol_inner_dia_units" class="hidden">
                                    <div id="hol_inner_dia_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="hol_inner_dia_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hol_inner_dia_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hol_inner_dia_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hol_inner_dia_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hol_inner_dia_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hol_inner_dia_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="hol_outer_dia" class="font-s-14 text-blue">{{ $lang['23'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="hol_outer_dia" id="hol_outer_dia" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['hol_outer_dia']) ? $_POST['hol_outer_dia'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="hol_outer_dia_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('hol_outer_dia_units_dropdown')">{{ isset($_POST['hol_outer_dia_units'])?$_POST['hol_outer_dia_units']:'cm' }} ▾</label>
                                    <input type="text" name="hol_outer_dia_units" value="{{ isset($_POST['hol_outer_dia_units'])?$_POST['hol_outer_dia_units']:'cm' }}" id="hol_outer_dia_units" class="hidden">
                                    <div id="hol_outer_dia_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="hol_outer_dia_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hol_outer_dia_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hol_outer_dia_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hol_outer_dia_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hol_outer_dia_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hol_outer_dia_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="hol_height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="hol_height" id="hol_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['hol_height']) ? $_POST['hol_height'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="hol_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('hol_height_units_dropdown')">{{ isset($_POST['hol_height_units'])?$_POST['hol_height_units']:'cm' }} ▾</label>
                                    <input type="text" name="hol_height_units" value="{{ isset($_POST['hol_height_units'])?$_POST['hol_height_units']:'cm' }}" id="hol_height_units" class="hidden">
                                    <div id="hol_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="hol_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hol_height_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hol_height_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hol_height_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hol_height_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('hol_height_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class="hidden1" id="Conical">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="coni_top_r" class="font-s-14 text-blue">{{ $lang['25'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="coni_top_r" id="coni_top_r" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['coni_top_r']) ? $_POST['coni_top_r'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="coni_top_r_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('coni_top_r_units_dropdown')">{{ isset($_POST['coni_top_r_units'])?$_POST['coni_top_r_units']:'cm' }} ▾</label>
                                    <input type="text" name="coni_top_r_units" value="{{ isset($_POST['coni_top_r_units'])?$_POST['coni_top_r_units']:'cm' }}" id="coni_top_r_units" class="hidden">
                                    <div id="coni_top_r_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="coni_top_r_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('coni_top_r_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('coni_top_r_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('coni_top_r_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('coni_top_r_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('coni_top_r_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="coni_bottom_r" class="font-s-14 text-blue">{{ $lang['26'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="coni_bottom_r" id="coni_bottom_r" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['coni_bottom_r']) ? $_POST['coni_bottom_r'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="coni_bottom_r_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('coni_bottom_r_units_dropdown')">{{ isset($_POST['coni_bottom_r_units'])?$_POST['coni_bottom_r_units']:'cm' }} ▾</label>
                                    <input type="text" name="coni_bottom_r_units" value="{{ isset($_POST['coni_bottom_r_units'])?$_POST['coni_bottom_r_units']:'cm' }}" id="coni_bottom_r_units" class="hidden">
                                    <div id="coni_bottom_r_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="coni_bottom_r_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('coni_bottom_r_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('coni_bottom_r_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('coni_bottom_r_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('coni_bottom_r_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('coni_bottom_r_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="coni_height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="coni_height" id="coni_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['coni_height']) ? $_POST['coni_height'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="coni_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('coni_height_units_dropdown')">{{ isset($_POST['coni_height_units'])?$_POST['coni_height_units']:'cm' }} ▾</label>
                                    <input type="text" name="coni_height_units" value="{{ isset($_POST['coni_height_units'])?$_POST['coni_height_units']:'cm' }}" id="coni_height_units" class="hidden">
                                    <div id="coni_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="coni_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('coni_height_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('coni_height_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('coni_height_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('coni_height_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('coni_height_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden1" id="Truncated">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="tru_base_side" class="font-s-14 text-blue">{{ $lang['29'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="tru_base_side" id="tru_base_side" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['tru_base_side']) ? $_POST['tru_base_side'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="tru_base_side_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('tru_base_side_units_dropdown')">{{ isset($_POST['tru_base_side_units'])?$_POST['tru_base_side_units']:'cm' }} ▾</label>
                                    <input type="text" name="tru_base_side_units" value="{{ isset($_POST['tru_base_side_units'])?$_POST['tru_base_side_units']:'cm' }}" id="tru_base_side_units" class="hidden">
                                    <div id="tru_base_side_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tru_base_side_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tru_base_side_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tru_base_side_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tru_base_side_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tru_base_side_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tru_base_side_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="tru_top_side" class="font-s-14 text-blue">{{ $lang['28'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="tru_top_side" id="tru_top_side" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['tru_top_side']) ? $_POST['tru_top_side'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="tru_top_side_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('tru_top_side_units_dropdown')">{{ isset($_POST['tru_top_side_units'])?$_POST['tru_top_side_units']:'cm' }} ▾</label>
                                    <input type="text" name="tru_top_side_units" value="{{ isset($_POST['tru_top_side_units'])?$_POST['tru_top_side_units']:'cm' }}" id="tru_top_side_units" class="hidden">
                                    <div id="tru_top_side_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tru_top_side_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tru_top_side_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tru_top_side_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tru_top_side_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tru_top_side_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tru_top_side_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="tru_height" class="font-s-14 text-blue">{{ $lang['31'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="tru_height" id="tru_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['tru_height']) ? $_POST['tru_height'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="tru_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('tru_height_units_dropdown')">{{ isset($_POST['tru_height_units'])?$_POST['tru_height_units']:'cm' }} ▾</label>
                                    <input type="text" name="tru_height_units" value="{{ isset($_POST['tru_height_units'])?$_POST['tru_height_units']:'cm' }}" id="tru_height_units" class="hidden">
                                    <div id="tru_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="tru_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tru_height_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tru_height_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tru_height_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tru_height_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('tru_height_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden" id="Ellipsoid">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2"> 
                                <label for="ell_sem_a" class="font-s-14 text-blue">{{ $lang['31'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="ell_sem_a" id="ell_sem_a" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ell_sem_a']) ? $_POST['ell_sem_a'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="ell_sem_a_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ell_sem_a_units_dropdown')">{{ isset($_POST['ell_sem_a_units'])?$_POST['ell_sem_a_units']:'cm' }} ▾</label>
                                    <input type="text" name="ell_sem_a_units" value="{{ isset($_POST['ell_sem_a_units'])?$_POST['ell_sem_a_units']:'cm' }}" id="ell_sem_a_units" class="hidden">
                                    <div id="ell_sem_a_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ell_sem_a_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ell_sem_a_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ell_sem_a_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ell_sem_a_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ell_sem_a_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ell_sem_a_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6">
                                <label for="ell_sem_b" class="font-s-14 text-blue">{{ $lang['32'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="ell_sem_b" id="ell_sem_b" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ell_sem_b']) ? $_POST['ell_sem_b'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="ell_sem_b_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ell_sem_b_units_dropdown')">{{ isset($_POST['ell_sem_b_units'])?$_POST['ell_sem_b_units']:'cm' }} ▾</label>
                                    <input type="text" name="ell_sem_b_units" value="{{ isset($_POST['ell_sem_b_units'])?$_POST['ell_sem_b_units']:'cm' }}" id="ell_sem_b_units" class="hidden">
                                    <div id="ell_sem_b_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ell_sem_b_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ell_sem_b_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ell_sem_b_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ell_sem_b_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ell_sem_b_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ell_sem_b_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="col_radi" class="font-s-14 text-blue">{{ $lang['33'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="ell_sem_c" id="ell_sem_c" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ell_sem_c']) ? $_POST['ell_sem_c'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="ell_sem_c_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ell_sem_c_units_dropdown')">{{ isset($_POST['ell_sem_c_units'])?$_POST['ell_sem_c_units']:'cm' }} ▾</label>
                                    <input type="text" name="ell_sem_c_units" value="{{ isset($_POST['ell_sem_c_units'])?$_POST['ell_sem_c_units']:'cm' }}" id="ell_sem_c_units" class="hidden">
                                    <div id="ell_sem_c_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ell_sem_c_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ell_sem_c_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ell_sem_c_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ell_sem_c_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ell_sem_c_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ell_sem_c_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden1" id="Column">
                        <div class="row">
                            <div class="col-lg-12 col-6 pe-lg-0 pe-2">
                                <label for="col_radi" class="font-s-14 text-blue">{{ $lang['19'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="col_radi" id="col_radi" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['col_radi']) ? $_POST['col_radi'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="col_radi_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('col_radi_units_dropdown')">{{ isset($_POST['col_radi_units'])?$_POST['col_radi_units']:'cm' }} ▾</label>
                                    <input type="text" name="col_radi_units" value="{{ isset($_POST['col_radi_units'])?$_POST['col_radi_units']:'cm' }}" id="col_radi_units" class="hidden">
                                    <div id="col_radi_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="col_radi_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('col_radi_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('col_radi_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('col_radi_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('col_radi_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('col_radi_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>

                            <div class="col-lg-12 col-6">
                                <label for="col_height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" name="col_height" id="col_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['col_height']) ? $_POST['col_height'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="col_height_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('col_height_units_dropdown')">{{ isset($_POST['col_height_units'])?$_POST['col_height_units']:'cm' }} ▾</label>
                                    <input type="text" name="col_height_units" value="{{ isset($_POST['col_height_units'])?$_POST['col_height_units']:'cm' }}" id="col_height_units" class="hidden">
                                    <div id="col_height_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="col_height_units">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('col_height_units', 'cm')">centimeters (cm)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('col_height_units', 'm')">meters (m)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('col_height_units', 'in')">inches (in)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('col_height_units', 'ft')">feet (ft)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('col_height_units', 'yd')">yards (yd)</p>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 hidden1"  id="Square">
                        <label for="square" class="font-s-14 text-blue">{{ $lang['35'] }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" name="square" id="square" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['square']) ? $_POST['square'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="square_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('square_units_dropdown')">{{ isset($_POST['square_units'])?$_POST['square_units']:'cm' }} ▾</label>
                            <input type="text" name="square_units" value="{{ isset($_POST['square_units'])?$_POST['square_units']:'cm' }}" id="square_units" class="hidden">
                            <div id="square_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="square_units">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('square_units', 'cm')">centimeters (cm)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('square_units', 'm')">meters (m)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('square_units', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('square_units', 'ft')">feet (ft)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('square_units', 'yd')">yards (yd)</p>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
            <div class="col-span-6  flex items-center ps-lg-3 justify-center">
                <img src="<?= asset('images/rectangular_v_new.png') ?>" loading="lazy" alt="Rectangular" class="ms-5 max-rec_length hidden1" width="250px" height="180px" id="Rectangular_img">
                <img src="<?= asset('images/cube_v.png') ?>" loading="lazy" alt="Cube" width="177px" id="Cube_img" class="hidden1">
                <img src="<?= asset('images/cylinder_v.png') ?>" loading="lazy" alt="Cylinder" width="143px" id="Cylinder_img" class="hidden1">
                <img src="<?= asset('images/cone_v.png') ?>" loading="lazy" alt="Cone" width="107px" id="Cone_img" class="hidden1">
                <img src="<?= asset('images/sphere_v.png') ?>" loading="lazy" alt="Sphere" height="150px" width="151px" id="Sphere_img" class="mt-3 hidden1">
                <img src="<?= asset('images/triangular_v1.webp') ?>" loading="lazy" alt="Triangular" width="185px" id="Triangular_img" class="hidden1">
                <img src="<?= asset('images/pyramid_v.png') ?>" loading="lazy" alt="Pyramid" width="205px" id="Pyramid_img" class="hidden1">
                <img src="<?= asset('images/capsule_v.png') ?>" loading="lazy" alt="Capsule" width="126px" id="Capsule_img" class="hidden1">
                <img src="<?= asset('images/hemisphere_v.png') ?>" loading="lazy" alt="Hemisphere" width="200px" id="Hemisphere_img" class="ms-4 mt-3 hidden1">
                <img src="<?= asset('images/hollow_v.png') ?>" loading="lazy" alt="Hollow" width="144px" id="Hollow_img" class="hidden1">
                <img src="<?= asset('images/conical_v.png') ?>" loading="lazy" alt="Conical" width="209px" id="Conical_img" class="hidden1">
                <img src="<?= asset('images/truncated_v.png') ?>" loading="lazy" alt="Truncated" width="270px" id="Truncated_img" class="ms-5 hidden1">
                <img src="<?= asset('images/ellipsoid_v.png') ?>" loading="lazy" alt="Ellipsoid" width="145px" id="Ellipsoid_img" class="hidden1">
                <img src="<?= asset('images/column_v.png') ?>" loading="lazy" alt="column" width="143px" id="Column_img" class="hidden1">
                <img src="<?= asset('images/square_v.png') ?>" loading="lazy" alt="square" height="150px" width="260px" id="Square_img" class="ms-5 mt-3 hidden1">
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
                        @php
                            $tri_a = request()->tri_base;
                            $tri_b = request()->tri_length;
                            $tri_c = request()->tri_height;
                            $tri_h = request()->tri_h;   
                        @endphp
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[80%] lg:w-[80%] ">
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b" width="60%">
                                            <strong><?= $lang['8'] ?> :</strong>
                                        </td>
                                        <td class="border-b py-2 d-flex justify-content-end">
                                            <div id="circle_result">
                                                <?php
                                                    if (request()->volume_select == 'Rectangular') {
                                                        echo  round($detail['rectangular'], 2);
                                                    } elseif (request()->volume_select == 'Cube') {
                                                        echo  round($detail['cube'], 2);
                                                    } elseif (request()->volume_select == 'Cylinder') {
                                                        echo  round($detail['cylinder'], 2);
                                                    } elseif (request()->volume_select == 'Cone') {
                                                        echo  round($detail['cone'], 2);
                                                    } elseif (request()->volume_select == 'Sphere') {
                                                        echo  round($detail['sphere'], 2);
                                                    } elseif (request()->volume_select == 'Triangular') {
                                                        echo  round($detail['triangular'], 2);
                                                    } elseif (request()->volume_select == 'Pyramid') {
                                                        echo  round($detail['pyramid'], 2);
                                                    } elseif (request()->volume_select == 'Capsule') {
                                                        echo  round($detail['capsule'], 2);
                                                    } elseif (request()->volume_select == 'Hemisphere') {
                                                        echo  round($detail['hemisphere'], 2);
                                                    } elseif (request()->volume_select == 'Hollow') {
                                                        echo  round($detail['hollow'], 2);
                                                    } elseif (request()->volume_select == 'Conical') {
                                                        echo  round($detail['conical'], 2);
                                                    } elseif (request()->volume_select == 'Truncated') {
                                                        echo  round($detail['truncated'], 2);
                                                    } elseif (request()->volume_select == 'Ellipsoid') {
                                                        echo  round($detail['ellipsoid'], 2);
                                                    } elseif (request()->volume_select == 'Square') {
                                                        echo  round($detail['square'], 2);
                                                    } elseif (request()->volume_select == 'Column') {
                                                        echo  round($detail['column'], 2);
                                                    }
                                                ?>
                                            </div>
                                            <select name="circle_unit_result" id="onetw" class="d-inline ms-2" style="width:100px">
                                                @php
                                                    $name = ["in³","cm³","m³","ft³","yd³"];
                                                    $val = ["in³","cm³","m³","ft³","yd³"];
                                                    optionsList($val,$name,isset($_POST['circle_unit_result'])?$_POST['circle_unit_result']:'cm³');
                                                @endphp
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                           {{-- <p class="font-s-20 text-center mt-2"><?= $lang['9'] ?></p>
                            <table class="font_size16">
                                <thead>
                                    <tr id="first_row">
                                        <td class="border-b py-2"><strong>mm³</strong></td>
                                        <td class="border-b py-2"><strong>dm³</strong></td>
                                        <td class="border-b py-2"><strong>m³</strong></td>
                                        <td class="border-b py-2"><strong>cu in</strong></td>
                                        <td class="border-b py-2"><strong>cu ft</strong></td>
                                        <td class="border-b py-2"><strong>cu yd</strong></td>
                                    </tr>
                                </thead>
                                 <tbody>
                                    <tr>
                                        <?php
                                        $volume_types = [
                                                'Rectangular' => isset($detail['rectangular']) ? $detail['rectangular'] : '',
                                                'Cube' => isset($detail['cube']) ? $detail['cube'] : '',
                                                'Cylinder' => isset($detail['cylinder']) ? $detail['cylinder'] : '',
                                                'Cone' => isset($detail['cone']) ? $detail['cone'] : '',
                                                'Sphere' => isset($detail['sphere']) ? $detail['sphere'] : '',
                                                'Triangular' => isset($detail['triangular']) ? $detail['triangular'] : '',
                                                'Pyramid' => isset($detail['pyramid']) ? $detail['pyramid'] : '',
                                                'Capsule' => isset($detail['capsule']) ? $detail['capsule'] : '',
                                                'Hemisphere' => isset($detail['hemisphere']) ? $detail['hemisphere'] : '',
                                                'Hollow' => isset($detail['hollow']) ? $detail['hollow'] : '',
                                                'Conical' => isset($detail['conical']) ? $detail['conical'] : '',
                                                'Truncated' => isset($detail['truncated']) ? $detail['truncated'] : '',
                                                'Ellipsoid' => isset($detail['ellipsoid']) ? $detail['ellipsoid'] : '',
                                                'Square' => isset($detail['square']) ? $detail['square'] : '',
                                                'Column' => isset($detail['column']) ? $detail['column'] : '',
                                            ];
                                        if (isset($volume_types[request()->volume_select])) {
                                            $volume_data = $volume_types[request()->volume_select];
                                            $multipliers = [1000, 0.001, 0.000001, 0.061, 0.0000353, 0.000001308];
            
                                            foreach ($multipliers as $multiplier) {
                                                echo '<td class="border-b py-2">' . round($volume_data * $multiplier, 3) . '</td>';
                                            }
                                        }
                                        ?>
                                    </tr>
                                </tbody>
                            </table> --}}
                            <div class="w-full>
                                <?php if (request()->volume_select == 'Rectangular') { ?>
                                    
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['12'] ?> :</p>
                                    <p class="mt-2">\( V = \text {length} \times \text {width} \times \text {height}\)</p>
                                    <p class="mt-2">\( V = \text {<?php echo request()->rec_length ?>} \times \text {<?php echo request()->rec_width ?>} \times \text {<?php echo request()->rec_height ?>}\)</p>
                                    <p class="mt-2">\( V = <?= round($detail['rectangular'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif (request()->volume_select == 'Cube') { ?>
                                   
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['13'] ?> :</p>
                                    <p class="mt-2">\( V = \text {Side} \times \text {Side} \times \text {Side}\)</p>
                                    <p class="mt-2">\( V = \text {<?php echo request()->cub_side ?>} \times \text {<?php echo request()->cub_side ?>} \times \text {<?php echo request()->cub_side ?>}\)</p>
                                    <p class="mt-2">\( V = <?= round($detail['cube'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif (request()->volume_select == 'Cylinder') { ?>
                                  
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['14'] ?> :</p>
                                    <p class="mt-2">\( V = \pi r^2 h \)</p>
                                    <p class="mt-2">\( r = d/2 \)</p>
                                    <p class="mt-2">\( r = <?php echo request()->cyl_diameter ?>/2 \)</p>
                                    <p class="mt-2">\( r = <?= $detail['radius'] ?> \)</p>
                                    <p class="mt-2">\( V = \pi \times<?= $detail['radius'] ?>^2 \times <?php echo request()->cyl_height ?> \)</p>
                                    <p class="mt-2">\( V = <?= round($detail['cylinder'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif (request()->volume_select == 'Cone') { ?>
                                   
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['15'] ?> :</p>
                                    <p class="mt-2">\( V = \frac{1}{3} \pi r^2 h \)</p>
                                    <p class="mt-2">\( r = d/2 \)</p>
                                    <p class="mt-2">\( r = <?php echo request()->con_diameter ?>/2 \)</p>
                                    <p class="mt-2">\( r = <?= $detail['radius'] ?> \)</p>
                                    <p class="mt-2">\( V = \frac{1}{3} \times 3.14 \times {<?= $detail['radius'] ?>}^2 \times <?php echo request()->con_height ?> \)</p>
                                    <p class="mt-2">\( V = <?= round($detail['cone'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif (request()->volume_select == 'Sphere') { ?>
                                    
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['16'] ?> :</p>
                                    <p class="mt-2">\( V = \frac{4}{3} \pi r^3\)</p>
                                    <p class="mt-2">\( r = d/2 \)</p>
                                    <p class="mt-2">\( r = <?php echo request()->sph_diameter ?>/2 \)</p>
                                    <p class="mt-2">\( r = <?= $detail['radius'] ?> \)</p>
                                    <p class="mt-2">\( V = \frac{4}{3} \times 3.14 \times <?= $detail['radius'] ?>^3\)</p>
            
                                    <p class="mt-2">\( V = <?= round($detail['sphere'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif (request()->volume_select == 'Triangular') { ?>
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['17'] ?> :</p>
                                    <p class="mt-2">$$V = \frac{1}{4}h \sqrt{(a + b + c)(b + c - a)(c + a - b)(a + b - c)}$$</p>
                                    <p class="mt-2">$$V = \frac{1}{4}{{$tri_h}} \sqrt{({{$tri_a}} + {{$tri_b}} + {{$tri_c}})({{$tri_b}} + {{$tri_c}} - {{$tri_a}})({{$tri_c}} + {{$tri_a}} - {{$tri_b}})({{$tri_a}} + {{$tri_b}} - {{$tri_c}})}$$</p>
                                    <p class="mt-2">$$V = \frac{1}{4}{{$tri_h}} \sqrt{{{$detail['baseArea']}}}$$</p>
                                    <p class="mt-2 text-center">\( V = <?= round($detail['triangular'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif (request()->volume_select == 'Pyramid') { ?>
                                    
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['18'] ?> :</p>
                                    <p class="mt-2">\( V = \frac{1}{3} \times \text{base area} \times \text{height}\)</p>
                                    <p class="mt-2">\( \text {Base Area} = 0.33 \times \text{side} \times \text {side}\)</p>
                                    <p class="mt-2">\( \text {Base Area} = 0.33 \times \text{<?php echo request()->pyr_side ?>} \times \text {<?php echo request()->pyr_side ?>}\)</p>
                                    <p class="mt-2">\( \text {Base Area} = <?= $detail['baseArea'] ?>\)</p>
                                    <p class="mt-2">\( V = \frac{1}{3} \times \text{<?= $detail['baseArea'] ?>} \times \text{<?php echo request()->pyr_height ?>}\)</p>
                                    <p class="mt-2">\( V = <?= round($detail['pyramid'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif (request()->volume_select == 'Capsule') { ?>
                                  
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['20'] ?> :</p>
                                    <p class="mt-2">\( V = \pi r^2 \left( \frac{4}{3} r + h \right)\)</p>
                                    <p class="mt-2">\( V = 3.14 \times <?php echo request()->cap_radius ?>^2 \left( \frac{4}{3} \times <?php echo request()->cap_radius ?> + <?php echo request()->cap_height ?> \right)\)</p>
                                    <p class="mt-2">\( V = <?= round($detail['capsule'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif (request()->volume_select == 'Hemisphere') { ?>
                              
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['21'] ?> :</p>
                                    <p class="mt-2">\( V = \frac{2}{3} \pi r^3 \)</p>
                                    <p class="mt-2">\( V = \frac{2}{3} \times 3.14 \times <?php echo request()->hem_radius ?>^3 \)</p>
                                    <p class="mt-2">\( V = <?= round($detail['hemisphere'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif (request()->volume_select == 'Hollow') { ?>
                                   
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['24'] ?> :</p>
                                    <p class="mt-2">\( V = \pi \cdot h \cdot \frac {(R_{\text{outer}}^2 - R_{\text{inner}}^2)}{4} \)</p>
                                    <p class="mt-2">\( V = 3.14 \times <?php echo request()->hol_height ?> \times \frac{(<?php echo request()->hol_outer_dia ?>^2 - <?php echo request()->hol_inner_dia ?>^2)}{4} \)</p>
                                    <p class="mt-2">\( V = <?= round($detail['hollow'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif (request()->volume_select == 'Conical') { ?>
                                    
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['27'] ?> :</p>
                                    <p class="mt-2">\( V = \frac{h}{3} \left( A_t + A_b + \sqrt{A_t \cdot A_b} \right) \)</p>
                                    <p class="mt-2">\( V = \frac{<?php echo request()->coni_height ?>}{3} \left( <?php echo request()->coni_top_r ?> + <?php echo request()->coni_bottom_r ?> + \sqrt{<?php echo request()->coni_top_r ?> \cdot <?php echo request()->coni_bottom_r ?>} \right) \)</p>
                                    <p class="mt-2">\( V = <?= round($detail['conical'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif (request()->volume_select == 'Truncated') { ?>
                                
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['30'] ?> :</p>
                                    <p class="mt-2">\(V = \frac{1}{3} \times h\left(A_1 + A_2 + \sqrt{A_1 \cdot A_2}\right) \)</p>
                                    <p class="mt-2">\(V = \frac{1}{3}\times<?php echo request()->tru_height ?>\left(<?php echo request()->tru_top_side ?> + <?php echo request()->tru_base_side ?> + \sqrt{<?php echo request()->tru_top_side ?> \cdot <?php echo request()->tru_base_side ?>}\right) \)</p>
                                    <p class="mt-2">\( V = <?= round($detail['truncated'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif (request()->volume_select == 'Ellipsoid') { ?>
                                  
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['34'] ?> :</p>
                                    <p class="mt-2">\(V = \frac{4}{3} \pi abc \)</p>
                                    <p class="mt-2">\(V = \frac{4}{3} \times 3.14 \times <?php echo request()->ell_sem_a ?>\times <?php echo request()->ell_sem_a ?>\times <?php echo request()->ell_sem_a ?> \)</p>
                                    <p class="mt-2">\( V = <?= round($detail['ellipsoid'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif (request()->volume_select == 'Square') { ?>
                                    
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['36'] ?> :</p>
                                    <p class="mt-2">\( V = \text {Side} \times \text {Side} \times \text {Side}\)</p>
                                    <p class="mt-2">\( V = \text {<?php echo request()->square ?>} \times \text {<?php echo request()->square ?>} \times \text {<?php echo request()->square ?>}\)</p>
                                    <p class="mt-2">\( V = <?= round($detail['square'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } elseif (request()->volume_select == 'Column') { ?>
                                    
                                    <!-- -------------------------- Solution ----------------------- -->
                                    <p class=" mt-2"><strong><?= $lang['11'] ?></strong></p>
                                    <p class="mt-2"><?= $lang['37'] ?> :</p>
                                    <p class="mt-2">\( V = \pi \cdot r^2 \cdot h\)</p>
                                    <p class="mt-2">\( V = \pi \cdot <?php echo request()->col_radi ?>^2 \cdot <?php echo request()->col_height ?>\)</p>
                                    <p class="mt-2">\( V = <?= round($detail['column'], 2) ?> \text{ cm}^3 \)</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" 
        onload="renderMathInElement(document.body);"></script>
    @endisset
</form>
@push('calculatorJS')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(!isset($detail))
                var first = document.getElementById("volume_select").value;
                if(first == 'Rectangular'){
                    document.getElementById("Rectangular").style.display = 'block';
                    document.getElementById("Rectangular_img").style.display = 'block';
                }
            @endif
            document.getElementById("volume_select").addEventListener('change', function() {
                // Hide all elements with class 'd-none'
                var dNoneElements = document.querySelectorAll(".hidden1");
                dNoneElements.forEach(function(element) {
                    element.style.display = 'none';
                });

                // Hide all img elements within elements with class 'sub_img'
                var subImgElements = document.querySelectorAll(".sub_img img");
                subImgElements.forEach(function(element) {
                    element.style.display = 'none';
                });

                // Show the selected option
                var selectedOption = this.value;
                document.getElementById(selectedOption).style.display = 'block';
                document.getElementById(selectedOption + "_img").style.display = 'block';
            });
        });
        document.addEventListener("DOMContentLoaded", () => {
            const conversionFactors = {
                'in³': 16.387064, // in³ to cm³
                'cm³': 1,        // cm³ to cm³
                'ft³': 28316.846592, // ft³ to cm³
                'yd³': 764554.857984, // yd³ to cm³
                'm³': 1000000    // m³ to cm³
            };

            const circleResultDiv = document.getElementById('circle_result');
            const initialValue = parseFloat(circleResultDiv.innerText);
            circleResultDiv.setAttribute('data-initial-value', initialValue);

            document.getElementById('onetw').addEventListener('change', event => {
                const unit = event.target.value;
                const conversionFactor = conversionFactors[unit];

                if (conversionFactor !== undefined) {
                    const originalValue = parseFloat(circleResultDiv.getAttribute('data-initial-value'));
                    const newValue = originalValue / conversionFactor;

                    circleResultDiv.innerText = Number(newValue.toFixed(6)).toString();  // Set the new value with unit
                } else {
                    console.error("Invalid conversion factor for unit: " + unit);
                }
            });
        });

        @if(isset($detail) || isset($error))
            var dNoneElements = document.querySelectorAll(".hidden1");
            dNoneElements.forEach(function(element) {
                element.style.display = 'none';
            });

            // Hide all img elements within elements with class 'sub_img'
            var subImgElements = document.querySelectorAll(".sub_img img");
            subImgElements.forEach(function(element) {
                element.style.display = 'none';
            });

            var detail = document.getElementById("volume_select").value;
            document.getElementById(detail).style.display = 'block';
            document.getElementById(detail + "_img").style.display = 'block';
        @endif
    </script>
@endpush