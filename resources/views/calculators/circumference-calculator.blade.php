<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
          <p class="w-full my-3">{{ $lang['note_value'] }}</p>
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="radius" class="label">{{ $lang['radius'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="radius" id="radius" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['radius'])?$_POST['radius']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_r" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_r_dropdown')">{{ isset($_POST['unit_r'])?$_POST['unit_r']:'cm' }} ▾</label>
                        <input type="text" name="unit_r" value="{{ isset($_POST['unit_r'])?$_POST['unit_r']:'cm' }}" id="unit_r" class="hidden">
                        <div id="unit_r_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_r', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_r', 'mm')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_r', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_r', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_r', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_r', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_r', 'mi')">miles (mi)</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="diameter" class="label">{{ $lang['diameter'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="diameter" id="diameter" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['diameter'])?$_POST['diameter']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_d" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_d_dropdown')">{{ isset($_POST['unit_d'])?$_POST['unit_d']:'cm' }} ▾</label>
                        <input type="text" name="unit_d" value="{{ isset($_POST['unit_d'])?$_POST['unit_d']:'cm' }}" id="unit_d" class="hidden">
                        <div id="unit_d_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_d', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_d', 'mm')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_d', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_d', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_d', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_d', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_d', 'mi')">miles (mi)</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="circumference" class="label">{{ $lang['circumference'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="circumference" id="circumference" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['circumference'])?$_POST['circumference']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_c" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_c_dropdown')">{{ isset($_POST['unit_c'])?$_POST['unit_c']:'cm' }} ▾</label>
                        <input type="text" name="unit_c" value="{{ isset($_POST['unit_c'])?$_POST['unit_c']:'cm' }}" id="unit_c" class="hidden">
                        <div id="unit_c_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_c', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_c', 'mm')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_c', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_c', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_c', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_c', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_c', 'mi')">miles (mi)</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="area" class="label">{{ $lang['area'] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="area" id="area" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['area'])?$_POST['area']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_a" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_a_dropdown')">{{ isset($_POST['unit_a'])?$_POST['unit_a']:'cm' }} ▾</label>
                        <input type="text" name="unit_a" value="{{ isset($_POST['unit_a'])?$_POST['unit_a']:'cm' }}" id="unit_a" class="hidden">
                        <div id="unit_a_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'mm')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_a', 'mi')">miles (mi)</p>
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
            <div class="rounded-lg  flex items-center ">
                <div class="w-full md:w-[60%] bg-light-blue rounded-lg mt-3">
                    <div class="flex flex-wrap">
                        <div class="w-full">
                            <table class="w-full">
                                <tr class="{{ isset(request()->radius) && !empty($_POST['radius']) ? 'hidden' : '' }}">
                                    <td class="py-2 border-b w-2/5"><strong>{{ $lang['radius'] }}</strong></td>
                                    <td class="py-2 border-b text-right"><strong>r</strong></td>
                                    <td class="py-2 border-b text-right">{{$detail['Radius']}} cm</td>
                                </tr>
                                <tr class="{{ isset(request()->diameter) && !empty($_POST['diameter']) ? 'hidden' : '' }}">
                                    <td class="py-2 border-b"><strong>{{ $lang['diameter'] }}</strong></td>
                                    <td class="py-2 border-b text-right"><strong>2r</strong></td>
                                    <td class="py-2 border-b text-right">{{ round($detail['Radius'] * 2, 5) }} cm</td>
                                </tr>
                                <tr class="{{ isset(request()->circumference) && !empty($_POST['circumference']) ? 'hidden' : '' }}">
                                    <td class="py-2 border-b"><strong>{{ $lang['circumference'] }}</strong></td>
                                    <td class="py-2 border-b text-right"><strong>2πr</strong></td>
                                    <td class="py-2 border-b text-right">{{ round($detail['Radius'] * 3.14159 * 2, 5) }} cm</td>
                                </tr>
                                <tr class="{{ isset(request()->area) && !empty($_POST['area']) ? 'hidden' : '' }}">
                                    <td class="py-2 border-b"><strong>{{ $lang['area'] }}</strong></td>
                                    <td class="py-2 border-b text-right"><strong>πr²</strong></td>
                                    <td class="py-2 border-b text-right">{{ round(pow($detail['Radius'], 2) * 3.14159, 5) }} cm</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    @endisset
</form>