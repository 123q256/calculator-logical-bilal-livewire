<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6" id="f1">
                <label for="first" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first']) ? $_POST['first'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="units1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units1_dropdown')">{{ isset($_POST['units1'])?$_POST['units1']:'m/s' }} ▾</label>
                    <input type="text" name="units1" value="{{ isset($_POST['units1'])?$_POST['units1']:'m/s' }}" id="units1" class="hidden">
                    <div id="units1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units1">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'm/s')">m/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'km/h')">km/h</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'ft/s')">ft/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'mph')">mph</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units1', 'knots')">knots</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" id="f2">
                <label for="second" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="second" id="second" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second']) ? $_POST['second'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="units2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units2_dropdown')">{{ isset($_POST['units2'])?$_POST['units2']:'mm' }} ▾</label>
                    <input type="text" name="units2" value="{{ isset($_POST['units2'])?$_POST['units2']:'mm' }}" id="units2" class="hidden">
                    <div id="units2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units2">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'mm')">mm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'cm')">cm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'm')">m</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'km')">km</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'in')">in</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'ft')">ft</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'yd')">yd</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'mi')">mi</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units2', 'nmi')">nmi</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" id="f3">
                <label for="third" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="third" id="third" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third']) ? $_POST['third'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="units3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units3_dropdown')">{{ isset($_POST['units3'])?$_POST['units3']:'g' }} ▾</label>
                    <input type="text" name="units3" value="{{ isset($_POST['units3'])?$_POST['units3']:'g' }}" id="units3" class="hidden">
                    <div id="units3_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units3">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'g')">g</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'kg')">kg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'gr')">gr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'oz')">oz</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'lb')">lb</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units3', 'stone')">stone</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" id="f4">
                <label for="four" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="four" id="four" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['four']) ? $_POST['four'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="units4" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units4_dropdown')">{{ isset($_POST['units4'])?$_POST['units4']:'g' }} ▾</label>
                    <input type="text" name="units4" value="{{ isset($_POST['units4'])?$_POST['units4']:'g' }}" id="units4" class="hidden">
                    <div id="units4_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units4">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units4', 'g')">g</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units4', 'kg')">kg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units4', 'gr')">gr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units4', 'oz')">oz</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units4', 'lb')">lb</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units4', 'stone')">stone</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6" id="f4">
                <label for="five" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="five" id="five" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['five']) ? $_POST['five'] : '1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="units5" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('units5_dropdown')">{{ isset($_POST['units5'])?$_POST['units5']:'g' }} ▾</label>
                    <input type="text" name="units5" value="{{ isset($_POST['units5'])?$_POST['units5']:'g' }}" id="units5" class="hidden">
                    <div id="units5_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="units5">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units5', 'g')">g</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units5', 'kg')">kg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units5', 'gr')">gr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units5', 'oz')">oz</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units5', 'lb')">lb</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('units5', 'stone')">stone</p>
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                          <table class="w-full font-s-18">
                             <tr>
                                <td class="py-2 border-b" width="50%"><strong>{{ $lang[7] }} </strong></td>
                                 <td class="py-2 border-b"> {{ round($detail['speed'], 3) }} (ft/s)</td>
                             </tr>
                             <tr>
                              <td class="py-2 border-b" width="50%"><strong>{{ $lang[8] }} </strong></td>
                               <td class="py-2 border-b"> {{ round($detail['momentum'], 6) }}  (Ns)</td>
                           </tr>
                           <tr>
                            <td class="py-2 border-b" width="50%"><strong>{{ $lang[9] }} </strong></td>
                             <td class="py-2 border-b"> {{ round($detail['k_energy'], 5) }} (J)</td>
                            </tr>
                          </table>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>