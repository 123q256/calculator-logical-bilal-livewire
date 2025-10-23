<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="ast" class="font-s-14 text-blue">AST <span class="bg-white radius-circle px-2" title="Aspartate transaminase<br>(AspAT/SGOT/ASAT/AAT/GOT)">?</span>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="ast" id="ast" step="any" placeholder="424.18" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ast']) ? $_POST['ast'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="ast_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ast_unit_dropdown')">{{ isset($_POST['ast_unit'])?$_POST['ast_unit']:'U / liter' }} ▾</label>
                        <input type="text" name="ast_unit" value="{{ isset($_POST['ast_unit'])?$_POST['ast_unit']:'U / liter' }}" id="ast_unit" class="hidden">
                        <div id="ast_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ast_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ast_unit', 'U / mm³')">U / millimeters cube (mm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ast_unit', 'U / cm³')">U / centimeters cube (cm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ast_unit', 'U / dm³')">U / decimeters cube (dm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ast_unit', 'U / cu in')">U / cubic inches (cu in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ast_unit', 'U / cu ft')">U / cubic feet (cu ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ast_unit', 'U / ml')">U / milliliters (ml)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ast_unit', 'U / cl')">U / centiliters (cl)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ast_unit', 'U / liter')">U / liter</p>

                        </div>
                     </div>
                </div>
                <div class="col-span-12">
                    <label for="alt" class="font-s-14 text-blue">ALT <span class="bg-white radius-circle px-2" title="Alanine transaminase / alanine aminotransferase<br>(ALAT/SGPT)">?</span>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="alt" id="alt" step="any" placeholder="424.18" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['alt']) ? $_POST['alt'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="alt_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('alt_unit_dropdown')">{{ isset($_POST['alt_unit'])?$_POST['alt_unit']:'U / liter' }} ▾</label>
                        <input type="text" name="alt_unit" value="{{ isset($_POST['alt_unit'])?$_POST['alt_unit']:'U / liter' }}" id="alt_unit" class="hidden">
                        <div id="alt_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="alt_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('alt_unit', 'U / mm³')">U / millimeters cube (mm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('alt_unit', 'U / cm³')">U / centimeters cube (cm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('alt_unit', 'U / dm³')">U / decimeters cube (dm³)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('alt_unit', 'U / cu in')">U / cubic inches (cu in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('alt_unit', 'U / cu ft')">U / cubic feet (cu ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('alt_unit', 'U / ml')">U / milliliters (ml)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('alt_unit', 'U / cl')">U / centiliters (cl)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('alt_unit', 'U / liter')">U / liter</p>

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
                    <div class="col-12">
                        <p><strong>{{ $lang['ratio'] }}</strong></p>
                        <p><strong class="text-[30px] text-green-500">{{ $detail['ratio'] }}</strong></p>
                        <p><strong>{{ $detail['m3'] }}</strong></p>
                        @if($detail['ratio'] >= 2)
                            <p>{{ $lang['suggest'] }}</p>
                        @endif
                        <div class="col s12 overflow-auto mt-2">
                            <table class="w-full md:w-[60%] lg:w-[60%]" cellspacing="0">
                                <tr id="first_row">
                                    <td class="border-b py-2"><strong>Name</strong></td>
                                    <td class="border-b py-2"><strong>Value</strong></td>
                                    <td class="border-b py-2"><strong>Result</strong></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">AST</td>
                                    <td class="border-b py-2">{{ $detail['ast'] }} U / liter</td>
                                    <td class="border-b py-2">{{ $detail['m1'] }}</td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2">ALT</td>
                                    <td class="border-b py-2">{{ $detail['alt'] }} U / liter</td>
                                    <td class="border-b py-2">{{ $detail['m2'] }}</td>
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