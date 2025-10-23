<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="inw" class="font-s-14 text-blue">{{ $lang['in'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="inw" id="inw" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['inw']) ? $_POST['inw'] : '190' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }} ▾</label>
                        <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }}" id="unit" class="hidden">
                        <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'lbs')">pounds (lbs)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'kg')">kilograms (kg)</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="crw" class="font-s-14 text-blue">{{ $lang['cur'] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="crw" id="crw" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['crw']) ? $_POST['crw'] : '190' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit1_dropdown')">{{ isset($_POST['unit1'])?$_POST['unit1']:'lbs' }} ▾</label>
                        <input type="text" name="unit1" value="{{ isset($_POST['unit1'])?$_POST['unit1']:'lbs' }}" id="unit1" class="hidden">
                        <div id="unit1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit1">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'lbs')">pounds (lbs)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'kg')">kilograms (kg)</p>
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
                        <div class="bg-[#F6FAFC] border radius-10 px-3 py-2" style="border: 1px solid #c1b8b899;">
                            <strong>{{ $lang['ans'] }} =</strong>
                            <strong class="text-green-700 text-[25px]">{{ $detail['pw'] }} % </strong>
                        </div>
                        <div class="bg-[#F6FAFC]  border rounnded px-3 py-2 mt-3" style="border: 1px solid #c1b8b899;">
                            <strong>{{ $lang['weight'] }} {{ ($detail['pw']<0)?$lang['gain']:$lang['loss'] }} =</strong>
                            <strong class="text-green-700 text-[25px]">{{ abs((int)$detail['wg']) }}</strong>
                        </div>
                        <div class="w-full overflow-auto mt-3">
                            <table class="w-full" cellspacing="0">
                                <tr>
                                    <th class="text-start text-blue border-b py-2 pe-3" colspan="2">{{ $lang['in'] }}</th>
                                    <th class="text-start text-blue border-b py-2 px-3" colspan="2">{{ $lang['cur'] }}</th>
                                    <th class="text-start text-blue border-b py-2 ps-3" colspan="2">{{ $lang['loss'] }} / {{ $lang['gain'] }}</th>
                                </tr>
                                <tr>
                                    <th class="text-start border-b py-2 pe-3">{{ $lang['imperial'] }}</th>
                                    <th class="text-start border-b py-2 px-3">{{ $lang['metric'] }}</th>
                                    <th class="text-start border-b py-2 px-3">{{ $lang['imperial'] }}</th>
                                    <th class="text-start border-b py-2 px-3">{{ $lang['metric'] }}</th>
                                    <th class="text-start border-b py-2 px-3">PCT</th>
                                    <th class="text-start border-b py-2 ps-3">TTL</th>
                                </tr>
                                <tr>
                                    <td class="py-2 pe-3">{{ $detail['inw_lbs'] }} lbs</td>
                                    <td class="py-2 px-3">{{ $detail['inw_kg'] }} kg</td>
                                    <td class="py-2 px-3">{{ $detail['crw_lbs'] }} lbs</td>
                                    <td class="py-2 px-3">{{ $detail['crw_kg'] }} kg</td>
                                    <td class="py-2 px-3">{{ $detail['pw'] }} %</td>
                                    <td class="py-2 ps-3">{{ $detail['wg'] }}</td>
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