<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">


                <div class="col-span-12">
                    <label for="length" class="font-s-14 text-blue"><?= $lang['1'] ?></label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length']) ? $_POST['length'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'in' }} ▾</label>
                        <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'in' }}" id="length_unit" class="hidden">
                        <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'mm')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'ft')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'mi')">miles (mi)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'nmi')">nautical mile (nmi)</p>
                        </div>
                     </div>
                </div>

                <div class="col-span-12">
                    <label for="height" class="font-s-14 text-blue"><?= $lang['2'] ?></label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height" id="height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height']) ? $_POST['height'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('height_unit_dropdown')">{{ isset($_POST['height_unit'])?$_POST['height_unit']:'in' }} ▾</label>
                        <input type="text" name="height_unit" value="{{ isset($_POST['height_unit'])?$_POST['height_unit']:'in' }}" id="height_unit" class="hidden">
                        <div id="height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="height_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'mm')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'ft')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'mi')">miles (mi)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'nmi')">nautical mile (nmi)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12">
                    <label for="width" class="font-s-14 text-blue"><?= $lang['3'] ?></label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width']) ? $_POST['width'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'in' }} ▾</label>
                        <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'in' }}" id="width_unit" class="hidden">
                        <div id="width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'mm')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'ft')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'mi')">miles (mi)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'nmi')">nautical mile (nmi)</p>
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
                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] }}</strong></td>
                                    <td class="py-2 border-b">{{round($detail['answer'], 4)}} in³</td>
                                </tr>
                            </table>
                        </div>
                        <p class="col-12 mt-3"><strong>{{ $lang['5'] }}</strong></p>
                        <div class="w-full md:w-[60%] lg:w-[60%]">                    
                            <table class="w-full text-[16px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%">mm³</td>
                                    <td class="py-2 border-b"><strong>{{ round($detail['answer'] * 16390 , 4)}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">m³</td>
                                    <td class="py-2 border-b"><strong>{{round($detail['answer'] / 61020, 4)}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">ft³</td>
                                    <td class="py-2 border-b"><strong>{{round($detail['answer'] / 1728, 4)}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">cm³</td>
                                    <td class="py-2 border-b"><strong>{{round($detail['answer'] * 16.387, 4)}}</strong></td>
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