<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                    <label for="length" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length']) ? $_POST['length'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }} ▾</label>
                        <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'cm' }}" id="length_unit" class="hidden">
                        <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'cm')">centimeters (cm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'mm')">milimeters (mm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'm')">meters (m)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'km')">kilometers (km)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'in')">inches (in)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'ft')">feet (ft)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'yd')">yards (yd)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'mi')">miles (mi)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'mi')">nenomiles (nmi)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="width" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="width" id="width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['width']) ? $_POST['width'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('width_unit_dropdown')">{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }} ▾</label>
                        <input type="text" name="width_unit" value="{{ isset($_POST['width_unit'])?$_POST['width_unit']:'cm' }}" id="width_unit" class="hidden">
                        <div id="width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="width_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'cm')">centimeters (cm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'mm')">milimeters (mm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'm')">meters (m)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'km')">kilometers (km)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'in')">inches (in)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'ft')">feet (ft)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'yd')">yards (yd)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'mi')">miles (mi)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('width_unit', 'mi')">nenomiles (nmi)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="height" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height" id="height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height']) ? $_POST['height'] : '146' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('height_unit_dropdown')">{{ isset($_POST['height_unit'])?$_POST['height_unit']:'cm' }} ▾</label>
                        <input type="text" name="height_unit" value="{{ isset($_POST['height_unit'])?$_POST['height_unit']:'cm' }}" id="height_unit" class="hidden">
                        <div id="height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="height_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'cm')">centimeters (cm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'mm')">milimeters (mm)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'm')">meters (m)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'km')">kilometers (km)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'in')">inches (in)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'ft')">feet (ft)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'yd')">yards (yd)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'mi')">miles (mi)</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'mi')">nenomiles (nmi)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="weight" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '146' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="weight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('weight_unit_dropdown')">{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'cm' }} ▾</label>
                        <input type="text" name="weight_unit" value="{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'cm' }}" id="weight_unit" class="hidden">
                        <div id="weight_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="weight_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'mg')">mg</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'g')">g</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'kg')">kg</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 't')">t</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'oz')">oz</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'lb')">lb</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'stone')">stone</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'us_ton')">us_ton</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'long_ton')">long_ton</p>

                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="pq" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="pq" id="pq" value="{{ isset($_POST['pq'])?$_POST['pq']:'1' }}" class="input" aria-label="input" placeholder="1" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="fr" class="font-s-14 text-blue">{{ $lang['6'] }}</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="fr" id="fr" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fr']) ? $_POST['fr'] : '146' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="fr_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fr_unit_dropdown')">{{ isset($_POST['fr_unit'])?$_POST['fr_unit']: $currancy.'/'.'lb' }} ▾</label>
                        <input type="text" name="fr_unit" value="{{ isset($_POST['fr_unit'])?$_POST['fr_unit']: $currancy.'/'.'lb' }}" id="fr_unit" class="hidden">
                        <div id="fr_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fr_unit">
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit','{{$currancy}}/mg')">{{$currancy}}/mg</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit','{{$currancy}}/g')">{{$currancy}}/g</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit','{{$currancy}}/kg')">{{$currancy}}/kg</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit','{{$currancy}}/t')">{{$currancy}}/t</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit','{{$currancy}}/oz')">{{$currancy}}/oz</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit','{{$currancy}}/lb')">{{$currancy}}/lb</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit','{{$currancy}}/stone')">{{$currancy}}/stone</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit','{{$currancy}}/us_ton')">{{$currancy}}/us_ton</p>
                           <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fr_unit','{{$currancy}}/long_ton')">{{$currancy}}/long_ton</p>
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
            <div class="w-full mt-3">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
                <div class="w-full md:w-[60%] lg:w-[60%]  lg:text-[18px] md:text-[18px] text-[16px]">
                    <table class="w-full">
                        <tr>
                            <td width="60%" class="border-b py-2"><strong>{{$lang['7']}} :</strong></td>
                            <td class="border-b py-2">{{$detail['weight']}} lb</td>
                        </tr>
                        <tr>
                            <td class="border-b py-2"><strong>{{$lang['8']}} :</strong></td>
                            <td class="border-b py-2">{{$detail['volume']}} cu ft</td>
                        </tr>
                        <tr>
                            <td class="border-b py-2"><strong>{{$lang['9']}} :</strong></td>
                            <td class="border-b py-2">{{$detail['density']}} lb/cu ft</td>
                        </tr>
                        <tr>
                            <td class="border-b py-2"><strong>{{$lang['10']}} :</strong></td>
                            <td class="border-b py-2">{{$detail['f_cls']}}</td>
                        </tr>
                        @if(isset($detail['fc']))
                            <tr>
                                <td class="border-b py-2"><strong>{{$lang['11']}} :</strong></td>
                                <td class="border-b py-2">{{$currancy}} {{round($detail['fc'],10)}}</td>
                            </tr>
                        @endif
                    </table>
                </div>
                
            </div>
        </div>
    @endisset
</form>