<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12">
                <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="selection" class="label">{!! $lang['20'] !!}:</label>
                    <div class="w-full py-2 relative">
                        <select name="selection" id="selection" class="input">
                            <option value="1" {{ isset($_POST['selection']) && $_POST['selection'] == '1' ? 'selected' : '' }}>{{ $lang['21'] }}</option>
                            <option value="2" {{ isset($_POST['selection']) && $_POST['selection'] == '2' ? 'selected' : '' }}>{{ $lang['22'] }}</option>
                            <option value="3" {{ isset($_POST['selection']) && $_POST['selection'] == '3' ? 'selected' : '' }}>{{ $lang['23'] }}</option>
                            <option value="4" {{ isset($_POST['selection']) && $_POST['selection'] == '4' ? 'selected' : '' }}>{{ $lang['24'] }}</option>
                        </select>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6 sec1">
                <label for="fe" class="label">{!! $lang['1'] !!}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="fe" id="fe" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fe']) ? $_POST['fe'] : '50' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="fe_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fe_unit_dropdown')">{{ isset($_POST['fe_unit'])?$_POST['fe_unit']:'cal' }} ▾</label>
                    <input type="text" name="fe_unit" value="{{ isset($_POST['fe_unit'])?$_POST['fe_unit']:'cal' }}" id="fe_unit" class="hidden">
                    <div id="fe_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fe_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fe_unit', 'cal')">calories (cal)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fe_unit', 'kJ')">kilojoules (kJ)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fe_unit', 'J')">joules (J)</p>
                    </div>
                 </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6 sec1">
                <label for="sf" class="label">{!! $lang['2'] !!}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="sf" id="sf" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['sf']) ? $_POST['sf'] : '100' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="sf_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('sf_unit_dropdown')">{{ isset($_POST['sf_unit'])?$_POST['sf_unit']:'g' }} ▾</label>
                    <input type="text" name="sf_unit" value="{{ isset($_POST['sf_unit'])?$_POST['sf_unit']:'g' }}" id="sf_unit" class="hidden">
                    <div id="sf_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="sf_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sf_unit', 'mg')">milligrams (mg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sf_unit', 'g')">grams (g)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sf_unit', 'kg')">kilograms (kg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sf_unit', 'oz')">ounces (oz)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sf_unit', 'lbs')">pounds (lbs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sf_unit', 'dr')">dr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sf_unit', 'gr')">gr</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 sec1">
                <label for="sgr" class="label">{!! $lang['3'] !!}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="sgr" id="sgr" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['sgr']) ? $_POST['sgr'] : '100' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="sgr_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('sgr_unit_dropdown')">{{ isset($_POST['sgr_unit'])?$_POST['sgr_unit']:'g' }} ▾</label>
                    <input type="text" name="sgr_unit" value="{{ isset($_POST['sgr_unit'])?$_POST['sgr_unit']:'g' }}" id="sgr_unit" class="hidden">
                    <div id="sgr_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="sgr_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sgr_unit', 'mg')">milligrams (mg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sgr_unit', 'g')">grams (g)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sgr_unit', 'kg')">kilograms (kg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sgr_unit', 'oz')">ounces (oz)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sgr_unit', 'lbs')">pounds (lbs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sgr_unit', 'dr')">dr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('sgr_unit', 'gr')">gr</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 sec1">
                <label for="ptn" class="label">{!! $lang['4'] !!}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="ptn" id="ptn" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ptn']) ? $_POST['ptn'] : '150' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="ptn_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ptn_unit_dropdown')">{{ isset($_POST['ptn_unit'])?$_POST['ptn_unit']:'g' }} ▾</label>
                    <input type="text" name="ptn_unit" value="{{ isset($_POST['ptn_unit'])?$_POST['ptn_unit']:'g' }}" id="ptn_unit" class="hidden">
                    <div id="ptn_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ptn_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ptn_unit', 'mg')">milligrams (mg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ptn_unit', 'g')">grams (g)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ptn_unit', 'kg')">kilograms (kg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ptn_unit', 'oz')">ounces (oz)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ptn_unit', 'lbs')">pounds (lbs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ptn_unit', 'dr')">dr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ptn_unit', 'gr')">gr</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 sec2 hidden">
                <label for="ptn2" class="label">{!! $lang['4'] !!}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="ptn2" id="ptn2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ptn2']) ? $_POST['ptn2'] : '150' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="ptn2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ptn2_unit_dropdown')">{{ isset($_POST['ptn2_unit'])?$_POST['ptn2_unit']:'g' }} ▾</label>
                    <input type="text" name="ptn2_unit" value="{{ isset($_POST['ptn2_unit'])?$_POST['ptn2_unit']:'g' }}" id="ptn2_unit" class="hidden">
                    <div id="ptn2_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ptn2_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ptn2_unit', 'mg')">milligrams (mg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ptn2_unit', 'g')">grams (g)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ptn2_unit', 'kg')">kilograms (kg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ptn2_unit', 'oz')">ounces (oz)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ptn2_unit', 'lbs')">pounds (lbs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ptn2_unit', 'dr')">dr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ptn2_unit', 'gr')">gr</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 sec2 hidden">
                <label for="carbo" class="label">{!! $lang['5'] !!}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="carbo" id="carbo" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['carbo']) ? $_POST['carbo'] : '150' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="carbo_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('carbo_unit_dropdown')">{{ isset($_POST['carbo_unit'])?$_POST['carbo_unit']:'g' }} ▾</label>
                    <input type="text" name="carbo_unit" value="{{ isset($_POST['carbo_unit'])?$_POST['carbo_unit']:'g' }}" id="carbo_unit" class="hidden">
                    <div id="carbo_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="carbo_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('carbo_unit', 'mg')">milligrams (mg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('carbo_unit', 'g')">grams (g)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('carbo_unit', 'kg')">kilograms (kg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('carbo_unit', 'oz')">ounces (oz)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('carbo_unit', 'lbs')">pounds (lbs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('carbo_unit', 'dr')">dr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('carbo_unit', 'gr')">gr</p>
                    </div>
                 </div>
            </div>
         
            <div class="col-span-12 md:col-span-6 lg:col-span-6 sec2 hidden">
                <label for="fat" class="label">{!! $lang['6'] !!}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="fat" id="fat" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fat']) ? $_POST['fat'] : '150' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="fat_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fat_unit_dropdown')">{{ isset($_POST['fat_unit'])?$_POST['fat_unit']:'g' }} ▾</label>
                    <input type="text" name="fat_unit" value="{{ isset($_POST['fat_unit'])?$_POST['fat_unit']:'g' }}" id="fat_unit" class="hidden">
                    <div id="fat_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fat_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fat_unit', 'mg')">milligrams (mg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fat_unit', 'g')">grams (g)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fat_unit', 'kg')">kilograms (kg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fat_unit', 'oz')">ounces (oz)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fat_unit', 'lbs')">pounds (lbs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fat_unit', 'dr')">dr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fat_unit', 'gr')">gr</p>
                    </div>
                 </div>
            </div>
           
            <div class="col-span-12 md:col-span-6 lg:col-span-6 sec2 hidden">
                <label for="fiber" class="label">{!! $lang['19'] !!}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="fiber" id="fiber" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fiber']) ? $_POST['fiber'] : '150' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="fiber_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fiber_unit_dropdown')">{{ isset($_POST['fiber_unit'])?$_POST['fiber_unit']:'g' }} ▾</label>
                    <input type="text" name="fiber_unit" value="{{ isset($_POST['fiber_unit'])?$_POST['fiber_unit']:'g' }}" id="fiber_unit" class="hidden">
                    <div id="fiber_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fiber_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fiber_unit', 'mg')">milligrams (mg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fiber_unit', 'g')">grams (g)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fiber_unit', 'kg')">kilograms (kg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fiber_unit', 'oz')">ounces (oz)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fiber_unit', 'lbs')">pounds (lbs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fiber_unit', 'dr')">dr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fiber_unit', 'gr')">gr</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 sec3 hidden">
                <label for="call2" class="label">{!! $lang['1'] !!}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="call2" id="call2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['call2']) ? $_POST['call2'] : '56' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="call2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('call2_unit_dropdown')">{{ isset($_POST['call2_unit'])?$_POST['call2_unit']:'cal' }} ▾</label>
                    <input type="text" name="call2_unit" value="{{ isset($_POST['call2_unit'])?$_POST['call2_unit']:'cal' }}" id="call2_unit" class="hidden">
                    <div id="call2_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="call2_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('call2_unit', 'cal')">calories (cal)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('call2_unit', 'kJ')">kilojoules (kJ)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('call2_unit', 'J')">joules (J)</p>
                     
                    </div>
                 </div>
            </div>
       
            <div class="col-span-12 md:col-span-6 lg:col-span-6 sec3 hidden">
                <label for="fat2" class="label">{!! $lang['6'] !!}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="fat2" id="fat2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fat2']) ? $_POST['fat2'] : '150' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="fat2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fat2_unit_dropdown')">{{ isset($_POST['fat2_unit'])?$_POST['fat2_unit']:'g' }} ▾</label>
                    <input type="text" name="fat2_unit" value="{{ isset($_POST['fat2_unit'])?$_POST['fat2_unit']:'g' }}" id="fat2_unit" class="hidden">
                    <div id="fat2_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fat2_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fat2_unit', 'mg')">milligrams (mg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fat2_unit', 'g')">grams (g)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fat2_unit', 'kg')">kilograms (kg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fat2_unit', 'oz')">ounces (oz)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fat2_unit', 'lbs')">pounds (lbs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fat2_unit', 'dr')">dr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fat2_unit', 'gr')">gr</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 sec3 hidden">
                <label for="fiber2" class="label">{!! $lang['19'] !!}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="fiber2" id="fiber2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fiber2']) ? $_POST['fiber2'] : '150' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="fiber2_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fiber2_unit_dropdown')">{{ isset($_POST['fiber2_unit'])?$_POST['fiber2_unit']:'g' }} ▾</label>
                    <input type="text" name="fiber2_unit" value="{{ isset($_POST['fiber2_unit'])?$_POST['fiber2_unit']:'g' }}" id="fiber2_unit" class="hidden">
                    <div id="fiber2_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fiber2_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fiber2_unit', 'mg')">milligrams (mg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fiber2_unit', 'g')">grams (g)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fiber2_unit', 'kg')">kilograms (kg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fiber2_unit', 'oz')">ounces (oz)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fiber2_unit', 'lbs')">pounds (lbs)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fiber2_unit', 'dr')">dr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fiber2_unit', 'gr')">gr</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 sec4 hidden">
                <label for="weight" class="label">{!! $lang['7'] !!}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '56' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="weight_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('weight_unit_dropdown')">{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }} ▾</label>
                    <input type="text" name="weight_unit" value="{{ isset($_POST['weight_unit'])?$_POST['weight_unit']:'kg' }}" id="weight_unit" class="hidden">
                    <div id="weight_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="weight_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'kg')">kilograms (kg)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('weight_unit', 'lbs')">pounds (lbs)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 sec4 hidden">
                <label for="height" class="label">{!! $lang['8'] !!}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="height" id="height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height']) ? $_POST['height'] : '56' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('height_unit_dropdown')">{{ isset($_POST['height_unit'])?$_POST['height_unit']:'cm' }} ▾</label>
                    <input type="text" name="height_unit" value="{{ isset($_POST['height_unit'])?$_POST['height_unit']:'cm' }}" id="height_unit" class="hidden">
                    <div id="height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="height_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'in')">inches (in)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'cm')">centimeters (cm)</p>
                    </div>
                 </div>
            </div>
          
            <div class="col-span-12 md:col-span-6 lg:col-span-6 sec4 hidden">
                <label for="age" class="label">{!! $lang['9'] !!} ({!! $lang['10'] !!}):</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['age'])?$_POST['age']:'23' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 sec4 hidden">
                <label for="gender" class="label">{!! $lang['13'] !!}:</label>
                <div class="w-full py-2 relative">
                    <select name="gender" id="gender" class="input">
                        <option value="female" {{ isset($_POST['gender']) && $_POST['gender'] == 'female' ? 'selected' : '' }}>{{ $lang['11']}}</option>
                        <option value="male" {{ isset($_POST['gender']) && $_POST['gender'] == 'male' ? 'selected' : '' }}>{{ $lang['12']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 sec4 hidden">
                <label for="activity" class="label">{!! $lang['14'] !!}:</label>
                <div class="w-full py-2 relative">
                    <select name="activity" id="activity" class="input">
                        <option value="1" {{ isset($_POST['activity']) && $_POST['activity'] == '1' ? 'selected' : '' }}>{{ $lang['15']}}</option>
                        <option value="2" {{ isset($_POST['activity']) && $_POST['activity'] == '2' ? 'selected' : '' }}>{{ $lang['16']}}</option>
                        <option value="3" {{ isset($_POST['activity']) && $_POST['activity'] == '3' ? 'selected' : '' }}>{{ $lang['17']}}</option>
                        <option value="4" {{ isset($_POST['activity']) && $_POST['activity'] == '4' ? 'selected' : '' }}>{{ $lang['18']}}</option>
                    </select>
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
                <div class="w-full  mt-3">
                    <div class="w-full  text-center">
                        <p><strong>{{ ($detail['method'] == "4") ? 'Your daily target is' : '' }}</strong></p>
                        <div class="flex justify-center">
                            <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                            <strong >{{ round($detail['ans'],2) }}</strong>
                            <span class="text-[25px]">{{ ($detail['method']==3) ? 'Older' : '' }} Points {{ ($detail['method']==4) ? 'per day' : '' }}</span>
                        </p>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
    @push('calculatorJS')
        <script>
            function handleSelectionChange() {
                var a = this.value;
                if (a === "1") {
                    document.querySelectorAll(".sec1").forEach(function(el) {
                        el.style.display = "block";
                    });
                    document.querySelectorAll(".sec2,.sec3,.sec4").forEach(function(el) {
                        el.style.display = "none";
                    });
                } else if (a === "2") {
                    document.querySelectorAll(".sec2").forEach(function(el) {
                        el.style.display = "block";
                    });
                    document.querySelectorAll(".sec1,.sec3,.sec4").forEach(function(el) {
                        el.style.display = "none";
                    });
                } else if (a === "3") {
                    document.querySelectorAll(".sec3").forEach(function(el) {
                        el.style.display = "block";
                    });
                    document.querySelectorAll(".sec1,.sec2,.sec4").forEach(function(el) {
                        el.style.display = "none";
                    });
                } else if (a === "4") {
                    document.querySelectorAll(".sec4").forEach(function(el) {
                        el.style.display = "block";
                    });
                    document.querySelectorAll(".sec1,.sec2,.sec3").forEach(function(el) {
                        el.style.display = "none";
                    });
                }
            }
            document.getElementById("selection").addEventListener("change", handleSelectionChange);
            var a = document.getElementById("selection").value;
            if (a === "1") {
                document.querySelectorAll(".sec1").forEach(function(el) {
                    el.style.display = "block";
                });
                document.querySelectorAll(".sec2,.sec3,.sec4").forEach(function(el) {
                    el.style.display = "none";
                });
            } else if (a === "2") {
                document.querySelectorAll(".sec2").forEach(function(el) {
                    el.style.display = "block";
                });
                document.querySelectorAll(".sec1,.sec3,.sec4").forEach(function(el) {
                    el.style.display = "none";
                });
            } else if (a === "3") {
                document.querySelectorAll(".sec3").forEach(function(el) {
                    el.style.display = "block";
                });
                document.querySelectorAll(".sec1,.sec2,.sec4").forEach(function(el) {
                    el.style.display = "none";
                });
            } else if (a === "4") {
                document.querySelectorAll(".sec4").forEach(function(el) {
                    el.style.display = "block";
                });
                document.querySelectorAll(".sec1,.sec2,.sec3").forEach(function(el) {
                    el.style.display = "none";
                });
            }
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>