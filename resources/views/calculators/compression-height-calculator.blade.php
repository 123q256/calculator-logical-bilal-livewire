<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="height" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="height" id="height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height']) ? $_POST['height'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('height_unit_dropdown')">{{ isset($_POST['height_unit'])?$_POST['height_unit']:'m' }} ▾</label>
                        <input type="text" name="height_unit" value="{{ isset($_POST['height_unit'])?$_POST['height_unit']:'m' }}" id="height_unit" class="hidden">
                        <div id="height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="height_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'in')">inches (in)</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                    <label for="stone" class="font-s-14 text-blue cat">{{ $lang['2'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="stone" id="stone" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['stone']) ? $_POST['stone'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="stone_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('stone_unit_dropdown')">{{ isset($_POST['stone_unit'])?$_POST['stone_unit']:'in' }} ▾</label>
                        <input type="text" name="stone_unit" value="{{ isset($_POST['stone_unit'])?$_POST['stone_unit']:'in' }}" id="stone_unit" class="hidden">
                        <div id="stone_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="stone_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('stone_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('stone_unit', 'in')">inches (in)</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="length" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="length" id="length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['length']) ? $_POST['length'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('length_unit_dropdown')">{{ isset($_POST['length_unit'])?$_POST['length_unit']:'in' }} ▾</label>
                        <input type="text" name="length_unit" value="{{ isset($_POST['length_unit'])?$_POST['length_unit']:'in' }}" id="length_unit" class="hidden">
                        <div id="length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="length_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('length_unit', 'in')">inches (in)</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="deck" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="deck" id="deck" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['deck']) ? $_POST['deck'] : '2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="deck_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('deck_unit_dropdown')">{{ isset($_POST['deck_unit'])?$_POST['deck_unit']:'m' }} ▾</label>
                        <input type="text" name="deck_unit" value="{{ isset($_POST['deck_unit'])?$_POST['deck_unit']:'m' }}" id="deck_unit" class="hidden">
                        <div id="deck_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="deck_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('deck_unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('deck_unit', 'in')">inches (in)</p>
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
                        <div class="w-full mt-1">
                            <div class="w-full md:w-[60%] lg:w-[60%]  text-[18px]">
                                <p class="text-[20px] my-2"><strong>{{ $lang['5']}}</strong></p>
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2">{{ round($detail['compression_val'],6) }}:</td>
                                        <td class="border-b py-2">in</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ round($detail['compression_val_m'],6) }}:</td>
                                        <td class="border-b py-2">m</td>
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