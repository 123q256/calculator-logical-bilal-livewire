<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-4">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="type_curtain" class="label">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" name="type_curtain" id="type_curtain" aria-label="input select">
                        <option value="sill_lenght" selected>{{ $lang['9'] }}</option>
                        <option value="cafe_length" {{ isset($_POST['type_curtain']) && $_POST['type_curtain'] === 'cafe_length' ? 'selected' : '' }}>{{ $lang['10'] }}</option>
                        <option value="extra_long" {{ isset($_POST['type_curtain']) && $_POST['type_curtain'] === 'extra_long' ? 'selected' : '' }}>{{ $lang['11'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                <label for="fullness" class="label cat">{{ $lang['2'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" name="fullness" id="fullness" aria-label="input select">
                        <option value="std_full" selected>{{ $lang['12'] }}</option>
                        <option value="del_full" {{ isset($_POST['fullness']) && $_POST['fullness'] === 'del_full' ? 'selected' : '' }}>{{ $lang['13'] }}</option>
                        <option value="ult_full" {{ isset($_POST['fullness']) && $_POST['fullness'] === 'ult_full' ? 'selected' : '' }}>{{ $lang['14'] }}</option>
                    </select>
                </div>
            </div> 
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="w_height" class="label">({{ $lang['3'] }}):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="w_height" id="w_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['w_height']) ? $_POST['w_height'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="wh_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wh_units_dropdown')">{{ isset($_POST['wh_units'])?$_POST['wh_units']:'mm' }} ▾</label>
                    <input type="text" name="wh_units" value="{{ isset($_POST['wh_units'])?$_POST['wh_units']:'mm' }}" id="wh_units" class="hidden">
                    <div id="wh_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wh_units">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wh_units', 'mm')">milimeters (mm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wh_units', 'cm')">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wh_units', 'm')">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wh_units', 'ft')">feet (ft)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wh_units', 'in')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wh_units', 'yd')">yards (yd)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="w_width" class="label">({{ $lang['4'] }}):</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="w_width" id="w_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['w_width']) ? $_POST['w_width'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="ww_units" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ww_units_dropdown')">{{ isset($_POST['ww_units'])?$_POST['ww_units']:'mm' }} ▾</label>
                    <input type="text" name="ww_units" value="{{ isset($_POST['ww_units'])?$_POST['ww_units']:'mm' }}" id="ww_units" class="hidden">
                    <div id="ww_units_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ww_units">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ww_units', 'mm')">milimeters (mm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ww_units', 'cm')">centimeters (cm)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ww_units', 'm')">meters (m)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ww_units', 'ft')">feet (ft)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ww_units', 'in')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ww_units', 'yd')">yards (yd)</p>
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
    
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full mt-1">
                        <div class="w-full md:w-[60%] lg:w-[60%">
                            @if (isset($detail['type_curtain']))
                                <p class="text-[20px] my-2"><strong>{{ $lang[5] }}</strong></p>
                                <table class="text-[18px] w-full">
                                    <tr>
                                        <td class="border-b py-2">{{ $lang[6] }} :</td>
                                        <td class="border-b py-2">{{ $detail['c_lenght'] }} <span class="font-s-14">({{ $lang[7] }})</span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang[8] }} :</td>
                                        <td class="border-b py-2">{{ $detail['c_width'] }} <span class="font-s-14">({{ $lang[7] }})</span></td>
                                    </tr>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

    @endisset
</form>