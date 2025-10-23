<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
                @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
               @endif
               <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                   <div class=" w-full">
                    <input type="hidden" name="room_unit" id="calculator_time" value="{{ isset(request()->room_unit) ? request()->room_unit : '1' }}">
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  pacetab {{ isset(request()->room_unit) && request()->room_unit === '2'  ? '' :'tagsUnit' }}" id="time_first">
                                <?= $lang[2] . "/" . $lang[3] ?>
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white pacetab {{ isset(request()->room_unit) && request()->room_unit === '2'  ? 'tagsUnit' :'' }}" id="time_sec">
                                <?= $lang[4] . "/" . $lang[3] ?>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="grid grid-cols-12 mt-5  gap-3">
                        <div class="col-span-6 ">
                        
                            <div class="space-y-2 ">
                                <label for="shapes1" class="label">{{ $lang['5'] }}</label>
                                <div class="w-100 py-2"> 
                                    <select class="input" id="shapes1" onchange="notwork(0)" name="shape_unit[0]" data-id="1">
                                        @php
                                            function optionsList($arr1,$arr2,$unit){
                                            foreach($arr1 as $index => $name){
                                        @endphp
                                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                                {{ $arr2[$index] }}
                                            </option>
                                        @php
                                            }}
                                            $name = [$lang[6], $lang[7], $lang[8], $lang[9], $lang[10], $lang[11], $lang[12], $lang[13], $lang[14], $lang[15], $lang[16], $lang[17], $lang[18]];
                                            $val = ["sq", "rec", "recbor", "tra", "para", "tri", "cir", "ell", "sec", "hex", "oct", "ann", "cirborder"];
                                            optionsList($val,$name,isset(request()->shape_unit[0])?request()->shape_unit[0]:'sq');
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-2 length1 hidden">
                                <label for="length" class="label">
                                    {{ $lang['19'] }} (l):
                                </label>
                                <div class="relative w-full mt-2">
                                    <input 
                                        type="number" 
                                        name="length[]" 
                                        id="length" 
                                        step="any" 
                                        class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" 
                                        value="{{ isset(request()->length[0]) ? request()->length[0] : '6' }}" 
                                        placeholder="00" 
                                        oninput="checkInput()" 
                                        aria-label="Length input"
                                    />
                                    
                                    <!-- Unit Selector -->
                                    <label 
                                        for="length_unit" 
                                        class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                        onclick="toggleDropdown('length_unit_dropdown')">
                                        {{ isset(request()->length_unit[0]) ? request()->length_unit[0] : 'cm' }} ▾
                                    </label>
                                    <input 
                                        type="text" 
                                        name="length_unit[]" 
                                        id="length_unit" 
                                        value="{{ isset(request()->length_unit[0]) ? request()->length_unit[0] : 'cm' }}" 
                                        class="hidden"
                                    />
                                    
                                    <!-- Dropdown Menu -->
                                    <div 
                                        id="length_unit_dropdown" 
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" 
                                        role="menu">
                                        @foreach (["in", "ft", "yd", "mm", "cm", "m"] as $name)
                                        <p 
                                            class="p-2 hover:bg-gray-100 cursor-pointer" 
                                            onclick="setUnit('length_unit', '{{ $name }}')">
                                            {{ $name }}
                                        </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 width1 hidden">
                                <label for="width" class="label">{{ $lang['20'] }} (w):</label>
                                <div class="relative w-full mt-2">
                                    <input 
                                        type="number" 
                                        name="width[]" 
                                        id="width" 
                                        step="any" 
                                        class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" 
                                        value="{{ isset(request()->width[0]) ? request()->width[0] : '6' }}" 
                                        placeholder="00" 
                                        oninput="checkInput()" 
                                        aria-label="width input"
                                    />
                                    
                                    <!-- Unit Selector -->
                                    <label 
                                        for="width_unit" 
                                        class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                        onclick="toggleDropdown('width_unit_dropdown')">
                                        {{ isset(request()->width_unit[0]) ? request()->width_unit[0] : 'cm' }} ▾
                                    </label>
                                    <input 
                                        type="text" 
                                        name="width_unit[]" 
                                        id="width_unit" 
                                        value="{{ isset(request()->width_unit[0]) ? request()->width_unit[0] : 'cm' }}" 
                                        class="hidden"
                                    />
                                    
                                    <!-- Dropdown Menu -->
                                    <div 
                                        id="width_unit_dropdown" 
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" 
                                        role="menu">
                                        @foreach (["in", "ft", "yd", "mm", "cm", "m"] as $name)
                                        <p 
                                            class="p-2 hover:bg-gray-100 cursor-pointer" 
                                            onclick="setUnit('width_unit', '{{ $name }}')">
                                            {{ $name }}
                                        </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 inner_length1 hidden">
                                <label for="inner_length" class="label">{{ $lang['22'] }} (t):</label>
                                <div class="relative w-full mt-2">
                                    <input  type="number"   name="inner_length[]"  id="inner_length"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->inner_length[0]) ? request()->inner_length[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                    
                                    <!-- Unit Selector -->
                                    <label   for="inner_length_unit"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                        onclick="toggleDropdown('inner_length_unit_dropdown')">{{ isset(request()->inner_length_unit[0]) ? request()->inner_length_unit[0] : 'cm' }} ▾
                                    </label>
                                    <input  type="text"  name="inner_length_unit[]"  id="inner_length_unit"  value="{{ isset(request()->inner_length_unit[0]) ? request()->inner_length_unit[0] : 'cm' }}"  class="hidden" />
                                    
                                    <!-- Dropdown Menu -->
                                    <div  id="inner_length_unit_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" role="menu" to="inner_length_unit">
                                        @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                        <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('inner_length_unit', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 inner_width1 hidden">
                                <label for="inner_width" class="label">{{ $lang['23'] }} (s):</label>
                                <div class="relative w-full mt-2">
                                    <input  type="number"   name="inner_width[]"  id="inner_width"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->inner_width[0]) ? request()->inner_width[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                    
                                    <!-- Unit Selector -->
                                    <label   for="inner_width_unit"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                        onclick="toggleDropdown('inner_width_unit_dropdown')">{{ isset(request()->inner_width_unit[0]) ? request()->inner_width_unit[0] : 'cm' }} ▾
                                    </label>
                                    <input  type="text"  name="inner_width_unit[]"  id="inner_width_unit"  value="{{ isset(request()->inner_width_unit[0]) ? request()->inner_width_unit[0] : 'cm' }}"  class="hidden" />
                                    
                                    <!-- Dropdown Menu -->
                                    <div  id="inner_width_unit_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" role="menu" to="inner_width_unit">
                                        @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                        <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('inner_width_unit', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 border_width1 hidden">
                                <label for="border_width" class="label">{{ $lang['24'] }}:</label>
                                <div class="relative w-full mt-2">
                                    <input  type="number"   name="border_width[]"  id="border_width"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->border_width[0]) ? request()->border_width[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                    
                                    <!-- Unit Selector -->
                                    <label   for="border_width_unit"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                        onclick="toggleDropdown('border_width_unit_dropdown')">{{ isset(request()->border_width_unit[0]) ? request()->border_width_unit[0] : 'cm' }} ▾
                                    </label>
                                    <input  type="text"  name="border_width_unit[]"  id="border_width_unit"  value="{{ isset(request()->border_width_unit[0]) ? request()->border_width_unit[0] : 'cm' }}"  class="hidden" />
                                    
                                    <!-- Dropdown Menu -->
                                    <div  id="border_width_unit_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" role="menu" to="border_width_unit">
                                        @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                        <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('border_width_unit', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 sidea_length1 {{ isset(request()->shape_unit[0]) && request()->shape_unit[0] !== 'sq'? 'hidden' :'d-block' }}">
                                <label for="sidealength" class="label">{{ $lang['25'] }} (a) <?= $lang[26] ?>:</label>
                                <div class="relative w-full mt-2">
                                    <input  type="number"   name="sidealength[]"  id="sidealength"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->sidealength[0]) ? request()->sidealength[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                    
                                    <!-- Unit Selector -->
                                    <label   for="sidealength_unit"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                        onclick="toggleDropdown('sidealength_unit_dropdown')">{{ isset(request()->sidealength_unit[0]) ? request()->sidealength_unit[0] : 'cm' }} ▾
                                    </label>
                                    <input  type="text"  name="sidealength_unit[]"  id="sidealength_unit"  value="{{ isset(request()->sidealength_unit[0]) ? request()->sidealength_unit[0] : 'cm' }}"  class="hidden" />
                                    
                                    <!-- Dropdown Menu -->
                                    <div  id="sidealength_unit_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" role="menu" to="sidealength_unit">
                                        @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                        <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('sidealength_unit', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 sideb_length1 hidden">
                                <label for="sideblength_" class="label"><?= $lang[25] ?> (b) <?= $lang[26] ?>:</label>
                                <div class="relative w-full mt-2">
                                    <input  type="number"   name="sideblength[]"  id="sideblength"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->sideblength[0]) ? request()->sideblength[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                    
                                    <!-- Unit Selector -->
                                    <label   for="sideblength_unit"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                        onclick="toggleDropdown('sideblength_unit_dropdown')">{{ isset(request()->sideblength_unit[0]) ? request()->sideblength_unit[0] : 'cm' }} ▾
                                    </label>
                                    <input  type="text"  name="sideblength_unit[]"  id="sideblength_unit"  value="{{ isset(request()->sideblength_unit[0]) ? request()->sideblength_unit[0] : 'cm' }}"  class="hidden" />
                                    
                                    <!-- Dropdown Menu -->
                                    <div  id="sideblength_unit_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" role="menu" to="sideblength_unit">
                                        @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                        <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('sideblength_unit', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 sidec_length1 hidden">
                                <label for="sideblength_1" class="label"><?= $lang[25] ?> (c) <?= $lang[26] ?>:</label>
                                <div class="relative w-full mt-2">
                                    <input  type="number"   name="sideblength[]"  id="sideblength_1"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->sideblength[0]) ? request()->sideblength[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                    
                                    <!-- Unit Selector -->
                                    <label   for="sideblength_unit"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                        onclick="toggleDropdown('sideblength_unit_dropdown')">{{ isset(request()->sideblength_unit[0]) ? request()->sideblength_unit[0] : 'cm' }} ▾
                                    </label>
                                    <input  type="text"  name="sideblength_unit[]"  id="sideblength_unit"  value="{{ isset(request()->sideblength_unit[0]) ? request()->sideblength_unit[0] : 'cm' }}"  class="hidden" />
                                    
                                    <!-- Dropdown Menu -->
                                    <div  id="sideblength_unit_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" role="menu" to="sideblength_unit">
                                        @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                        <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('sideblength_unit', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2 height1 hidden">
                                <label for="height" class="label"><?= $lang[27] ?> h=</label>
                                <div class="relative w-full mt-2">
                                    <input  type="number"   name="height[]"  id="height"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->height[0]) ? request()->height[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                    
                                    <!-- Unit Selector -->
                                    <label   for="height_unit"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                        onclick="toggleDropdown('height_unit_dropdown')">{{ isset(request()->height_unit[0]) ? request()->height_unit[0] : 'cm' }} ▾
                                    </label>
                                    <input  type="text"  name="height_unit[]"  id="height_unit"  value="{{ isset(request()->height_unit[0]) ? request()->height_unit[0] : 'cm' }}"  class="hidden" />
                                    
                                    <!-- Dropdown Menu -->
                                    <div  id="height_unit_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" role="menu" to="height_unit">
                                        @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                        <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('height_unit', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 diameter1 hidden">
                                <label for="diameter" class="label"><?= $lang[28] ?>:</label>
                                <div class="relative w-full mt-2">
                                    <input  type="number"   name="diameter[]"  id="diameter"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->diameter[0]) ? request()->diameter[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                    
                                    <!-- Unit Selector -->
                                    <label   for="diameter_unit"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                        onclick="toggleDropdown('diameter_unit_dropdown')">{{ isset(request()->diameter_unit[0]) ? request()->diameter_unit[0] : 'cm' }} ▾
                                    </label>
                                    <input  type="text"  name="diameter_unit[]"  id="diameter_unit"  value="{{ isset(request()->diameter_unit[0]) ? request()->diameter_unit[0] : 'cm' }}"  class="hidden" />
                                    
                                    <!-- Dropdown Menu -->
                                    <div  id="diameter_unit_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" role="menu" to="diameter_unit">
                                        @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                        <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('diameter_unit', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 base1 hidden">
                                <label for="base" class="label"><?= $lang[29] ?>:</label>
                                <div class="relative w-full mt-2">
                                    <input  type="number"   name="base[]"  id="base"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->base[0]) ? request()->base[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                    
                                    <!-- Unit Selector -->
                                    <label   for="base_unit"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                        onclick="toggleDropdown('base_unit_dropdown')">{{ isset(request()->base_unit[0]) ? request()->base_unit[0] : 'cm' }} ▾
                                    </label>
                                    <input  type="text"  name="base_unit[]"  id="base_unit"  value="{{ isset(request()->base_unit[0]) ? request()->base_unit[0] : 'cm' }}"  class="hidden" />
                                    
                                    <!-- Dropdown Menu -->
                                    <div  id="base_unit_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" role="menu" to="base_unit">
                                        @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                        <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('base_unit', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 axis_a1 hidden">
                                <label for="axisa" class="label"><?= $lang[30] ?>(a):</label>
                                <div class="relative w-full mt-2">
                                    <input  type="number"   name="axisa[]"  id="axisa"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->axisa[0]) ? request()->axisa[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                    
                                    <!-- Unit Selector -->
                                    <label   for="axisa_unit"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                        onclick="toggleDropdown('axisa_unit_dropdown')">{{ isset(request()->axisa_unit[0]) ? request()->axisa_unit[0] : 'cm' }} ▾
                                    </label>
                                    <input  type="text"  name="axisa_unit[]"  id="axisa_unit"  value="{{ isset(request()->axisa_unit[0]) ? request()->axisa_unit[0] : 'cm' }}"  class="hidden" />
                                    
                                    <!-- Dropdown Menu -->
                                    <div  id="axisa_unit_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" role="menu" to="axisa_unit">
                                        @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                        <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('axisa_unit', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 axis_b1 hidden">
                                <label for="axisb" class="label"><?= $lang[30] ?>(b):</label>
                                <div class="relative w-full mt-2">
                                    <input  type="number"   name="axisb[]"  id="axisb"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->axisb[0]) ? request()->axisb[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                    
                                    <!-- Unit Selector -->
                                    <label   for="axisb_unit"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                        onclick="toggleDropdown('axisb_unit_dropdown')">{{ isset(request()->axisb_unit[0]) ? request()->axisb_unit[0] : 'cm' }} ▾
                                    </label>
                                    <input  type="text"  name="axisb_unit[]"  id="axisb_unit"  value="{{ isset(request()->axisb_unit[0]) ? request()->axisb_unit[0] : 'cm' }}"  class="hidden" />
                                    
                                    <!-- Dropdown Menu -->
                                    <div  id="axisb_unit_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" role="menu" to="axisb_unit">
                                        @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                        <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('axisb_unit', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 radius1 hidden">
                                <label for="radius" class="label"><?= $lang[31] ?>(r):</label>
                                <div class="relative w-full mt-2">
                                    <input  type="number"   name="radius[]"  id="radius"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->radius[0]) ? request()->radius[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                    
                                    <!-- Unit Selector -->
                                    <label   for="radius_unit"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                        onclick="toggleDropdown('radius_unit_dropdown')">{{ isset(request()->radius_unit[0]) ? request()->radius_unit[0] : 'cm' }} ▾
                                    </label>
                                    <input  type="text"  name="radius_unit[]"  id="radius_unit"  value="{{ isset(request()->radius_unit[0]) ? request()->radius_unit[0] : 'cm' }}"  class="hidden" />
                                    
                                    <!-- Dropdown Menu -->
                                    <div  id="radius_unit_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" role="menu" to="radius_unit">
                                        @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                        <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('radius_unit', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 angle1 hidden">
                                <label for="angle" class="label"><?= $lang[32] ?> ° :</label>
                                <div class="w-full py-2"> 
                                    <input type="number" step="any" name="angle[]" id="angle" class="input" aria-label="input"  value="{{ isset(request()->angle[0])?request()->angle[0]:'6' }}" />
                                </div>
                            </div>
                            <div class="space-y-2 inner_diameter1 hidden">
                                <label for="inner_diameter" class="label"><?= $lang[33] ?>:</label>
                                <div class="relative w-full mt-2">
                                    <input  type="number"   name="inner_diameter[]"  id="inner_diameter"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->inner_diameter[0]) ? request()->inner_diameter[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                    
                                    <!-- Unit Selector -->
                                    <label   for="inner_diameter_unit"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                        onclick="toggleDropdown('inner_diameter_unit_dropdown')">{{ isset(request()->inner_diameter_unit[0]) ? request()->inner_diameter_unit[0] : 'cm' }} ▾
                                    </label>
                                    <input  type="text"  name="inner_diameter_unit[]"  id="inner_diameter_unit"  value="{{ isset(request()->inner_diameter_unit[0]) ? request()->inner_diameter_unit[0] : 'cm' }}"  class="hidden" />
                                    
                                    <!-- Dropdown Menu -->
                                    <div  id="inner_diameter_unit_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" role="menu" to="inner_diameter_unit">
                                        @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                        <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('inner_diameter_unit', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 outer_diameter1 hidden">
                                <label for="outer_diameter" class="label"><?= $lang[34] ?>:</label>
                                <div class="relative w-full mt-2">
                                    <input  type="number"   name="outer_diameter[]"  id="outer_diameter"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->outer_diameter[0]) ? request()->outer_diameter[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                    
                                    <!-- Unit Selector -->
                                    <label   for="outer_diameter_unit"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                        onclick="toggleDropdown('outer_diameter_unit_dropdown')">{{ isset(request()->outer_diameter_unit[0]) ? request()->outer_diameter_unit[0] : 'cm' }} ▾
                                    </label>
                                    <input  type="text"  name="outer_diameter_unit[]"  id="outer_diameter_unit"  value="{{ isset(request()->outer_diameter_unit[0]) ? request()->outer_diameter_unit[0] : 'cm' }}"  class="hidden" />
                                    
                                    <!-- Dropdown Menu -->
                                    <div  id="outer_diameter_unit_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" role="menu" to="outer_diameter_unit">
                                        @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                        <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('outer_diameter_unit', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-2 no1 hidden">
                                <label for="sides" class="label"><?= $lang[35] ?>:</label>
                                <div class="w-100 py-2"> 
                                    <input type="number" step="any" name="sides[0]" id="sides" class="input" aria-label="input"  value="{{ isset(request()->sides[0])?request()->sides[0]:'6' }}" />
                                </div>
                            </div>
                            <div class="space-y-2 price">
                                <label for="price" class="label"><?= $lang[36] ?> (<?= $lang[37] ?>):</label>
                                <div class="relative w-full mt-2 ">
                                    <input type="number" name="price" id="price" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['price'])?$_POST['price']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                    <label for="price_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('price_unit_dropdown')">{{ isset($_POST['price_unit'])?$_POST['price_unit']:'m²' }} ▾</label>
                                    <input type="text" name="price_unit" value="{{ isset($_POST['price_unit'])?$_POST['price_unit']:'m²' }}" id="price_unit" class="hidden">
                                    <div id="price_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="price_unit">
                                        @foreach (["ft²", "yd²", "m²"] as $name)
                                        <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('price_unit', '{{ $name }}')"> {{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                             </div>
                             
                        </div>
                        <div class="col-span-6 ">
                            <div class="col-12 mt-0 mt-lg-2">
                                <label for="quantity" class="label">{{ $lang['21'] }}</label>
                                <div class="w-100 py-2"> 
                                    <input type="number" step="any" name="quantity" id="quantity" class="input" aria-label="input"  value="{{ isset(request()->quantity)?request()->quantity:'1' }}" />
                                </div>
                            </div>
                            <img src="{{asset('images/k1.png')}}" alt="Shape Image" class="max-width change_img mt-lg-2" width="500px" height="200px">
                        </div>
                    </div>
                    <div class="grid grid-cols-12 mt-5  gap-3 cd2">
                
                    </div>
                    <div class="w-full md:w-[20%] lg::w-[20%] hidden mt-[20px]" id="btn2">
                        <div class="bg-[#99ea48] px-3 py-2 cursor-pointer rounded-lg border">add more</div>
                    </div>
               </div>
                @if ($type == 'calculator')
                @include('inc.button')
               @endif
               @if ($type=='widget')
               @include('inc.widget-button')
                @endif
            </div>
    @else
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full my-2">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 font-s-18">
                            <table class="w-full">
                                <tr>
                                    <td width="60%" class="border-b py-3"><strong><?= $lang['39'] ?> :</strong></td>
                                    <td class="border-b py-3"><?= round($detail['ans'], 2) ?> (ft²)</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="pt-3">Square Footage in Other Units</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-3"><?= $lang[40] ?> :</td>
                                    <td class="border-b py-3"><?= round($detail['sqyards'], 4) ?> (yd²)</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-3"><?= $lang[41] ?> :</td>
                                    <td class="border-b py-3"><?= round($detail['sqmeters'], 4) ?> (m²)</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-3"><?= $lang[42] ?> :</td>
                                    <td class="border-b py-3"><?= round($detail['acres'], 4) ?> (acres)</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-3"><?= $lang[43] ?> :</td>
                                    <td class="border-b py-3">{{$currancy}} <?= (isset($detail['cost']) ? round($detail['cost'], 4) : "0") ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="w-full text-center mt-[50px]">
                        <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                            @if (app()->getLocale() == 'en')
                                RESET
                            @else
                                {{ $lang['reset'] ?? 'RESET' }}
                            @endif
                        </a>
                    </div>
                </div>

                </div>
            </div>
        </div>
    
    @endif
</form>

@push('calculatorJS')
    <script>
        document.getElementById('time_first').addEventListener('click', function() {
            this.classList.add('tagsUnit');
            document.getElementById('calculator_time').value = "1";
            document.getElementById('time_sec').classList.remove('tagsUnit');
            document.getElementById('btn2').style.display = "none";

        });
        document.getElementById('time_sec').addEventListener('click', function() {
            this.classList.add('tagsUnit');
            document.getElementById('calculator_time').value = "2";
            document.getElementById('time_first').classList.remove('tagsUnit');
            document.getElementById('btn2').style.display = "block";
        });
        document.addEventListener('DOMContentLoaded', function() {
            var shapesElement = document.getElementById('shapes1');
            if (shapesElement) {
                shapesElement.addEventListener('change', function() {
                    var hsb = this.getAttribute('data-id');
                    var find = this.value;
                    var elementsToHide = [
                        ".length" + hsb, ".width" + hsb, ".inner_length" + hsb, ".inner_width" + hsb,
                        ".border_width" + hsb, ".sideb_length" + hsb, ".sidea_length" + hsb, ".sidec_length" + hsb,
                        ".height" + hsb, ".diameter" + hsb, ".base" + hsb, ".axis_a" + hsb,
                        ".axis_b" + hsb, ".radius" + hsb, ".angle" + hsb, ".inner_diameter" + hsb,
                        ".outer_diameter" + hsb, ".no" + hsb
                    ];

                    elementsToHide.forEach(function(selector) {
                        var elements = document.querySelectorAll(selector);
                        elements.forEach(function(element) {
                            element.style.display = 'none';
                        });
                    });

                    var elementsToShow = [];
                    var imageSrc = '';

                    if (find === "sq") {
                        elementsToShow = [".sidea_length" + hsb];
                        imageSrc = "<?= asset('images/square.png') ?>";
                    } else if (find === "rec") {
                        elementsToShow = [".width" + hsb, ".length" + hsb];
                        imageSrc = "<?= asset('images/rectangle.png') ?>";
                    } else if (find === "recbor") {
                        elementsToShow = [".inner_width" + hsb, ".inner_length" + hsb, ".border_width" + hsb];
                        imageSrc = "<?= asset('images/rectangle_border.png') ?>";
                    } else if (find === "para") {
                        elementsToShow = [".base" + hsb, ".height" + hsb];
                        imageSrc = "<?= asset('images/pp.png') ?>";
                    } else if (find === "tri") {
                        elementsToShow = [".sidea_length" + hsb, ".sideb_length" + hsb, ".sidec_length" + hsb];
                        imageSrc = "<?= asset('images/triangle.png') ?>";
                    } else if (find === "cir") {
                        elementsToShow = [".diameter" + hsb];
                        imageSrc = "<?= asset('images/circle.png') ?>";
                    } else if (find === "ell") {
                        elementsToShow = [".axis_a" + hsb, ".axis_b" + hsb];
                        imageSrc = "<?= asset('images/ellipse.png') ?>";
                    } else if (find === "sec") {
                        elementsToShow = [".radius" + hsb, ".border_width" + hsb];
                        imageSrc = "<?= asset('images/ss.png') ?>";
                    } else if (find === "oct") {
                        elementsToShow = [".sidea_length" + hsb];
                        imageSrc = "<?= asset('images/octagon.png') ?>";
                    } else if (find === "ann") {
                        elementsToShow = [".inner_diameter" + hsb, ".outer_diameter" + hsb];
                        imageSrc = "<?= asset('images/Annulus.png') ?>";
                    } else if (find === "cirborder") {
                        elementsToShow = [".inner_diameter" + hsb, ".border_width" + hsb];
                        imageSrc = "<?= asset('images/circle_border.png') ?>";
                    } else if (find === "hex") {
                        elementsToShow = [".sidea_length" + hsb];
                        imageSrc = "<?= asset('images/hexagon.png') ?>";
                    } else if (find === "tra") {
                        elementsToShow = [".sidea_length" + hsb, ".sideb_length" + hsb, ".height" + hsb];
                        imageSrc = "<?= asset('images/Trapezoid.png') ?>";
                    }

                    elementsToShow.forEach(function(selector) {
                        var elements = document.querySelectorAll(selector);
                        elements.forEach(function(element) {
                            element.style.display = 'block';
                        });
                    });

                    var changeImg = document.querySelector('.change_img');
                    if (changeImg) {
                        changeImg.src = imageSrc;
                    }
                });
            }
        });

        @if(!isset($detail))
            var x = 1;
            document.getElementById("btn2").addEventListener('click',function() {
                if (5 > x) {
                    x++;
                    function add_fields(counter){
                        const html = 
                        `
                        <p class="col-span-12"> Room ${counter}</p>
                        <div class="col-span-6 ">
                            <label for="shapes${counter}" class="label">{{ $lang['5'] }}</label>
                            <div class="w-100 py-2"> 
                                <select class="input" id="shapes${counter}" onchange="notwork(${counter})" name="shape_unit[]" data-id="${counter}">
                                    <option value="sq"><?= $lang[6] ?></option>
                                    <option  value="rec"><?= $lang[7] ?></option>
                                    <option value="recbor"><?= $lang[8] ?></option>
                                    <option value="tra"><?= $lang[9] ?></option>
                                    <option value="para">{{$lang[10]}}</option>
                                    <option value="tri"><?= $lang[11] ?></option>
                                    <option value="cir"><?= $lang[12] ?></option>
                                    <option value="ell"><?= $lang[13] ?></option>
                                    <option value="sec">{{$lang[14]}}</option>
                                    <option value="hex"><?= $lang[15] ?></option>
                                    <option value="oct"><?= $lang[16] ?></option>
                                    <option value="ann"><?= $lang[17] ?></option>
                                    <option value="cirborder"><?= $lang[18] ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-6 length${counter} hidden">
                                <label for="length${counter}" class="font-s-14 text-blue">{{ $lang['19'] }} (l):</label>
                            <div class="relative w-full mt-2">
                                <input  type="number"   name="length[]"  id="length${counter}"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->length[0]) ? request()->length[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                
                                <!-- Unit Selector -->
                                <label   for="length_unit${counter}"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                    onclick="toggleDropdown('length_unit${counter}_dropdown')">{{ isset(request()->length_unit[0]) ? request()->length_unit[0] : 'cm' }} ▾
                                </label>
                                <input  type="text"  name="length_unit[]"  id="length_unit${counter}"  value="{{ isset(request()->length_unit[0]) ? request()->length_unit[0] : 'cm' }}"  class="hidden" />
                                
                                <!-- Dropdown Menu -->
                                <div  id="length_unit${counter}_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden length_unit${counter} " role="menu" to="length_unit${counter}">
                                    @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('length_unit${counter}', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 width${counter} hidden">
                                <label for="width${counter}" class="font-s-14 text-blue">{{ $lang['20'] }} (w):</label>
                            <div class="relative w-full mt-2">
                                <input  type="number"   name="width[]"  id="width${counter}"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->width[0]) ? request()->width[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                
                                <!-- Unit Selector -->
                                <label   for="width_unit${counter}"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                    onclick="toggleDropdown('width_unit${counter}_dropdown')">{{ isset(request()->width_unit[0]) ? request()->width_unit[0] : 'cm' }} ▾
                                </label>
                                <input  type="text"  name="width_unit[]"  id="width_unit${counter}"  value="{{ isset(request()->width_unit[0]) ? request()->width_unit[0] : 'cm' }}"  class="hidden" />
                                
                                <!-- Dropdown Menu -->
                                <div  id="width_unit${counter}_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden width_unit${counter} " role="menu" to="width_unit${counter}">
                                    @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('width_unit${counter}', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 inner_length${counter} hidden">
                            <label for="inner_length${counter}" class="font-s-14 text-blue">{{ $lang['22'] }} (t):</label>
                            <div class="relative w-full mt-2">
                                <input  type="number"   name="inner_length[]"  id="inner_length${counter}"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->inner_length[0]) ? request()->inner_length[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                
                                <!-- Unit Selector -->
                                <label   for="inner_width_unit${counter}"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                    onclick="toggleDropdown('inner_width_unit${counter}_dropdown')">{{ isset(request()->inner_width_unit[0]) ? request()->inner_width_unit[0] : 'cm' }} ▾
                                </label>
                                <input  type="text"  name="inner_width_unit[]"  id="inner_width_unit${counter}"  value="{{ isset(request()->inner_width_unit[0]) ? request()->inner_width_unit[0] : 'cm' }}"  class="hidden" />
                                
                                <!-- Dropdown Menu -->
                                <div  id="inner_width_unit${counter}_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden inner_width_unit${counter} " role="menu" to="inner_width_unit${counter}">
                                    @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('inner_width_unit${counter}', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 inner_width${counter} hidden">
                            <label for="inner_width${counter}" class="font-s-14 text-blue">{{ $lang['23'] }} (s):</label>
                            <div class="relative w-full mt-2">
                                <input  type="number"   name="inner_width[]"  id="inner_width${counter}"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->inner_width[0]) ? request()->inner_width[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                
                                <!-- Unit Selector -->
                                <label   for="inner_width${counter}"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                    onclick="toggleDropdown('inner_width${counter}_dropdown')">{{ isset(request()->inner_width[0]) ? request()->inner_width[0] : 'cm' }} ▾
                                </label>
                                <input  type="text"  name="inner_width[]"  id="inner_width${counter}"  value="{{ isset(request()->inner_width[0]) ? request()->inner_width[0] : 'cm' }}"  class="hidden" />
                                
                                <!-- Dropdown Menu -->
                                <div  id="inner_width${counter}_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden inner_width${counter} " role="menu" to="inner_width${counter}">
                                    @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('inner_width${counter}', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 border_width${counter} hidden">
                          <label for="border_width${counter}" class="label">{{ $lang['24'] }}:</label>
                            <div class="relative w-full mt-2">
                                <input  type="number"   name="border_width[]"  id="border_width${counter}"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->border_width[0]) ? request()->border_width[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                
                                <!-- Unit Selector -->
                                <label   for="border_width_unit${counter}"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                    onclick="toggleDropdown('border_width_unit${counter}_dropdown')">{{ isset(request()->border_width_unit[0]) ? request()->border_width_unit[0] : 'cm' }} ▾
                                </label>
                                <input  type="text"  name="border_width_unit[]"  id="border_width_unit${counter}"  value="{{ isset(request()->border_width_unit[0]) ? request()->border_width_unit[0] : 'cm' }}"  class="hidden" />
                                
                                <!-- Dropdown Menu -->
                                <div  id="border_width_unit${counter}_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden border_width_unit${counter} " role="menu" to="border_width_unit${counter}">
                                    @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('border_width_unit${counter}', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 sidea_length${counter} ">
                           <label for="sidealength${counter}" class="label">{{ $lang['25'] }} (a) <?= $lang[26] ?>:</label>
                            <div class="relative w-full mt-2">
                                <input  type="number"   name="sidealength[]"  id="sidealength${counter}"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->sidealength[0]) ? request()->sidealength[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                
                                <!-- Unit Selector -->
                                <label   for="sidealength_unit${counter}"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                    onclick="toggleDropdown('sidealength_unit${counter}_dropdown')">{{ isset(request()->sidealength_unit[0]) ? request()->sidealength_unit[0] : 'cm' }} ▾
                                </label>
                                <input  type="text"  name="sidealength_unit[]"  id="sidealength_unit${counter}"  value="{{ isset(request()->sidealength_unit[0]) ? request()->sidealength_unit[0] : 'cm' }}"  class="hidden" />
                                
                                <!-- Dropdown Menu -->
                                <div  id="sidealength_unit${counter}_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden sidealength_unit${counter} " role="menu" to="sidealength_unit${counter}">
                                    @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('sidealength_unit${counter}', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                        </div>
                        </div>
                        <div class="col-span-6 sideb_length${counter} hidden">
                          <label for="sideblength${counter}" class="label"><?= $lang[25] ?> (b) <?= $lang[26] ?>:</label>
                            <div class="relative w-full mt-2">
                                <input  type="number"   name="sideblength[]"  id="sideblength${counter}"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->sideblength[0]) ? request()->sideblength[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                
                                <!-- Unit Selector -->
                                <label   for="sideblength_unit${counter}"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                    onclick="toggleDropdown('sideblength_unit${counter}_dropdown')">{{ isset(request()->sideblength_unit[0]) ? request()->sideblength_unit[0] : 'cm' }} ▾
                                </label>
                                <input  type="text"  name="sideblength_unit[]"  id="sideblength_unit${counter}"  value="{{ isset(request()->sideblength_unit[0]) ? request()->sideblength_unit[0] : 'cm' }}"  class="hidden" />
                                
                                <!-- Dropdown Menu -->
                                <div  id="sideblength_unit${counter}_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden sideblength_unit${counter} " role="menu" to="sideblength_unit${counter}">
                                    @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('sideblength_unit${counter}', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 sidec_length${counter} hidden">
                            <label for="sideblength${counter}" class="label"><?= $lang[25] ?> (c) <?= $lang[26] ?>:</label>
                            <div class="relative w-full mt-2">
                                <input  type="number"   name="sideblength[]"  id="sideblength${counter}"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->sideblength[0]) ? request()->sideblength[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                
                                <!-- Unit Selector -->
                                <label   for="sideblength_unit${counter}"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                    onclick="toggleDropdown('sideblength_unit${counter}_dropdown')">{{ isset(request()->sideblength_unit[0]) ? request()->sideblength_unit[0] : 'cm' }} ▾
                                </label>
                                <input  type="text"  name="sideblength_unit[]"  id="sideblength_unit${counter}"  value="{{ isset(request()->sideblength_unit[0]) ? request()->sideblength_unit[0] : 'cm' }}"  class="hidden" />
                                
                                <!-- Dropdown Menu -->
                                <div  id="sideblength_unit${counter}_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden sideblength_unit${counter} " role="menu" to="sideblength_unit${counter}">
                                    @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('sideblength_unit${counter}', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 height${counter} hidden">
                           <label for="height${counter}" class="label"><?= $lang[27] ?> h=</label>
                            <div class="relative w-full mt-2">
                                <input  type="number"   name="height[]"  id="height${counter}"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->height[0]) ? request()->height[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                
                                <!-- Unit Selector -->
                                <label   for="height_unit${counter}"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                    onclick="toggleDropdown('height_unit${counter}_dropdown')">{{ isset(request()->height_unit[0]) ? request()->height_unit[0] : 'cm' }} ▾
                                </label>
                                <input  type="text"  name="height_unit[]"  id="height_unit${counter}"  value="{{ isset(request()->height_unit[0]) ? request()->height_unit[0] : 'cm' }}"  class="hidden" />
                                
                                <!-- Dropdown Menu -->
                                <div  id="height_unit${counter}_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden height_unit${counter} " role="menu" to="height_unit${counter}">
                                    @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('height_unit${counter}', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 diameter${counter} hidden">
                           <label for="diameter${counter}" class="label"><?= $lang[28] ?>:</label>
                            <div class="relative w-full mt-2">
                                <input  type="number"   name="diameter[]"  id="diameter${counter}"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->diameter[0]) ? request()->diameter[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                
                                <!-- Unit Selector -->
                                <label   for="diameter_unit${counter}"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                    onclick="toggleDropdown('diameter_unit${counter}_dropdown')">{{ isset(request()->diameter_unit[0]) ? request()->diameter_unit[0] : 'cm' }} ▾
                                </label>
                                <input  type="text"  name="diameter_unit[]"  id="diameter_unit${counter}"  value="{{ isset(request()->diameter_unit[0]) ? request()->diameter_unit[0] : 'cm' }}"  class="hidden" />
                                
                                <!-- Dropdown Menu -->
                                <div  id="diameter_unit${counter}_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden diameter_unit${counter} " role="menu" to="diameter_unit${counter}">
                                    @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('diameter_unit${counter}', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 base${counter} hidden">
                            <label for="base${counter}" class="label"><?= $lang[29] ?>:</label>
                            <div class="relative w-full mt-2">
                                <input  type="number"   name="base[]"  id="base${counter}"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->base[0]) ? request()->base[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                
                                <!-- Unit Selector -->
                                <label   for="base_unit${counter}"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                    onclick="toggleDropdown('base_unit${counter}_dropdown')">{{ isset(request()->base_unit[0]) ? request()->base_unit[0] : 'cm' }} ▾
                                </label>
                                <input  type="text"  name="base_unit[]"  id="base_unit${counter}"  value="{{ isset(request()->base_unit[0]) ? request()->base_unit[0] : 'cm' }}"  class="hidden" />
                                
                                <!-- Dropdown Menu -->
                                <div  id="base_unit${counter}_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden base_unit${counter} " role="menu" to="base_unit${counter}">
                                    @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('base_unit${counter}', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 axis_a${counter} hidden">
                               <label for="axisa${counter}" class="font-s-14 text-blue"><?= $lang[30] ?>(a):</label>
                            <div class="relative w-full mt-2">
                                <input  type="number"   name="axisa[]"  id="axisa${counter}"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->axisa[0]) ? request()->axisa[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                
                                <!-- Unit Selector -->
                                <label   for="axisa_unit${counter}"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                    onclick="toggleDropdown('axisa_unit${counter}_dropdown')">{{ isset(request()->axisa_unit[0]) ? request()->axisa_unit[0] : 'cm' }} ▾
                                </label>
                                <input  type="text"  name="axisa_unit[]"  id="axisa_unit${counter}"  value="{{ isset(request()->axisa_unit[0]) ? request()->axisa_unit[0] : 'cm' }}"  class="hidden" />
                                
                                <!-- Dropdown Menu -->
                                <div  id="axisa_unit${counter}_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden axisa_unit${counter} " role="menu" to="axisa_unit${counter}">
                                    @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('axisa_unit${counter}', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 axis_b${counter} hidden">
                            <label for="axisb${counter}" class="label"><?= $lang[30] ?>(b):</label>
                            <div class="relative w-full mt-2">
                                <input  type="number"   name="axisb[]"  id="axisb${counter}"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->axisb[0]) ? request()->axisb[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                
                                <!-- Unit Selector -->
                                <label   for="axisb_unit${counter}"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                    onclick="toggleDropdown('axisb_unit${counter}_dropdown')">{{ isset(request()->axisb_unit[0]) ? request()->axisb_unit[0] : 'cm' }} ▾
                                </label>
                                <input  type="text"  name="axisb_unit[]"  id="axisb_unit${counter}"  value="{{ isset(request()->axisb_unit[0]) ? request()->axisb_unit[0] : 'cm' }}"  class="hidden" />
                                
                                <!-- Dropdown Menu -->
                                <div  id="axisb_unit${counter}_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden axisb_unit${counter} " role="menu" to="axisb_unit${counter}">
                                    @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('axisb_unit${counter}', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 radius${counter} hidden">
                                 <label for="radius${counter}" class="label"><?= $lang[31] ?>(r):</label>
                            <div class="relative w-full mt-2">
                                <input  type="number"   name="radius[]"  id="radius${counter}"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->radius[0]) ? request()->radius[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                
                                <!-- Unit Selector -->
                                <label   for="radius_unit${counter}"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                    onclick="toggleDropdown('radius_unit${counter}_dropdown')">{{ isset(request()->radius_unit[0]) ? request()->radius_unit[0] : 'cm' }} ▾
                                </label>
                                <input  type="text"  name="radius_unit[]"  id="radius_unit${counter}"  value="{{ isset(request()->radius_unit[0]) ? request()->radius_unit[0] : 'cm' }}"  class="hidden" />
                                
                                <!-- Dropdown Menu -->
                                <div  id="radius_unit${counter}_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden radius_unit${counter} " role="menu" to="radius_unit${counter}">
                                    @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('radius_unit${counter}', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 angle${counter} hidden">
                            <label for="angle${counter}" class="label"><?= $lang[32] ?> ° :</label>
                            <div class="w-100 py-2"> 
                                <input type="number" step="any" name="angle[]" id="angle${counter}" class="input" aria-label="input"  value="{{ isset(request()->angle[0])?request()->angle[0]:'6' }}" />
                            </div>
                        </div>
                        <div class="col-span-6 radius${counter} hidden">
                               <label for="inner_diameter${counter}" class="label"><?= $lang[33] ?>:</label>
                            <div class="relative w-full mt-2">
                                <input  type="number"   name="inner_diameter[]"  id="inner_diameter${counter}"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->inner_diameter[0]) ? request()->inner_diameter[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                
                                <!-- Unit Selector -->
                                <label   for="inner_diameter${counter}"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                    onclick="toggleDropdown('inner_diameter${counter}_dropdown')">{{ isset(request()->inner_diameter[0]) ? request()->inner_diameter[0] : 'cm' }} ▾
                                </label>
                                <input  type="text"  name="inner_diameter[]"  id="inner_diameter${counter}"  value="{{ isset(request()->inner_diameter[0]) ? request()->inner_diameter[0] : 'cm' }}"  class="hidden" />
                                
                                <!-- Dropdown Menu -->
                                <div  id="inner_diameter${counter}_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden inner_diameter${counter} " role="menu" to="inner_diameter${counter}">
                                    @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('inner_diameter${counter}', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                         <div class="col-span-6 outer_diameter${counter} hidden">
                              <label for="outer_diameter${counter}" class="label"><?= $lang[34] ?>:</label>
                            <div class="relative w-full mt-2">
                                <input  type="number"   name="outer_diameter[]"  id="outer_diameter${counter}"  step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-400 w-full" value="{{ isset(request()->outer_diameter[0]) ? request()->outer_diameter[0] : '6' }}"  placeholder="00"   oninput="checkInput()" aria-label="width input"/>
                                
                                <!-- Unit Selector -->
                                <label   for="outer_diameter_unit${counter}"   class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                    onclick="toggleDropdown('outer_diameter_unit${counter}_dropdown')">{{ isset(request()->outer_diameter_unit[0]) ? request()->outer_diameter_unit[0] : 'cm' }} ▾
                                </label>
                                <input  type="text"  name="outer_diameter_unit[]"  id="outer_diameter_unit${counter}"  value="{{ isset(request()->outer_diameter_unit[0]) ? request()->outer_diameter_unit[0] : 'cm' }}"  class="hidden" />
                                
                                <!-- Dropdown Menu -->
                                <div  id="outer_diameter_unit${counter}_dropdown"  class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden outer_diameter_unit${counter} " role="menu" to="outer_diameter_unit${counter}">
                                    @foreach (["cm", "m", "mm", "in", "ft", "yd"] as $name)
                                    <p  class="p-2 hover:bg-gray-100 cursor-pointer"  onclick="setUnit('outer_diameter_unit${counter}', '{{ $name }}')"> {{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-6 no${counter} hidden">
                            <label for="sides${counter}" class="label"><?= $lang[35] ?>:</label>
                            <div class="w-100 py-2"> 
                                <input type="number" step="any" name="sides[]" id="sides${counter}" class="input" aria-label="input"  value="{{ isset(request()->sides[0])?request()->sides[0]:'6' }}" />
                            </div>
                        </div>
                        `;
                    
                    document.querySelector('.cd2').insertAdjacentHTML('beforeend', html);
                    }
                    add_fields(x);
                } else {
                    alert('<?= $lang[45] ?>');
                }
            });
        @endif
        function notwork(hsb) {
            // console.log(hsb);
            var find = document.getElementById('shapes' + hsb).value;
            var hideClasses = [
                "length" + hsb, "width" + hsb, "inner_length" + hsb, "inner_width" + hsb, 
                "border_width" + hsb, "sideb_length" + hsb, "sidea_length" + hsb, "sidec_length" + hsb, 
                "height" + hsb, "diameter" + hsb, "base" + hsb, "axis_a" + hsb, 
                "axis_b" + hsb, "radius" + hsb, "angle" + hsb, "inner_diameter" + hsb, 
                "outer_diameter" + hsb, "no" + hsb
            ];
            var showClasses = [];

            switch (find) {
                case "sq":
                    showClasses = ["sidea_length" + hsb];
                    break;
                case "rec":
                    showClasses = ["width" + hsb, "length" + hsb];
                    break;
                case "recbor":
                    showClasses = ["inner_width" + hsb, "inner_length" + hsb, "border_width" + hsb];
                    break;
                case "para":
                    showClasses = ["base" + hsb, "height" + hsb];
                    break;
                case "tri":
                    showClasses = ["sidea_length" + hsb, "sideb_length" + hsb, "sidec_length" + hsb];
                    break;
                case "cir":
                    showClasses = ["diameter" + hsb];
                    break;
                case "ell":
                    showClasses = ["axis_a" + hsb, "axis_b" + hsb];
                    break;
                case "sec":
                    showClasses = ["radius" + hsb, "border_width" + hsb];
                    break;
                case "oct":
                    showClasses = ["sidea_length" + hsb];
                    break;
                case "ann":
                    showClasses = ["inner_diameter" + hsb, "outer_diameter" + hsb];
                    break;
                case "cirborder":
                    showClasses = ["inner_diameter" + hsb, "border_width" + hsb];
                    break;
                case "hex":
                    showClasses = ["sidea_length" + hsb];
                    break;
                case "tra":
                    showClasses = ["sidea_length" + hsb, "sideb_length" + hsb, "height" + hsb];
                    break;
                default:
                    console.log("Unknown shape type:", find);
                    return;
            }

            hideClasses.forEach(cls => {
                document.querySelectorAll('.' + cls).forEach(el => {
                    el.style.display = 'none';
                });
            });

            showClasses.forEach(cls => {
                document.querySelectorAll('.' + cls).forEach(el => {
                    el.style.display = 'block';
                });
            });
        }

    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

