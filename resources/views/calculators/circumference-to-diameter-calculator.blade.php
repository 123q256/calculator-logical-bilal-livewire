<style>
    img{
        object-fit: contain;
    }
</style>
<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 ">
                    <p>
                    <label class="pe-2" for="circumferenceToDiameter">
                        <input type="radio" name="conversionType" value="circumferenceToDiameter" id="circumferenceToDiameter" onchange="toggleFields();" checked>
                        <span><?= $lang['1'] ?></span>
                    </label>
                    </p>
                    <p class="my-2">
                    <label for="diameterToCircumference">
                        <input type="radio" name="conversionType" value="diameterToCircumference" id="diameterToCircumference" onchange="toggleFields();">
                        <span><?= $lang['2'] ?></span>
                    </label>
                    </p>
                </div>

                <div class="col-span-12">
                    <label for="value" class="label" id="textChanged"><?= $lang['3'] ?>:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="value" id="value" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['value']) ? $_POST['value'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'cm' }} ▾</label>
                        <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'cm' }}" id="unit" class="hidden">
                        <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'cm')">centimeters (cm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'mm')">milimeters (mm)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'm')">meters (m)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'km')">kilometers (km)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'in')">inches (in)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'ft')">feets (ft)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'yd')">yards (yd)</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'mi')">miles (mi)</p>
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $_POST['conversionType'] === "circumferenceToDiameter" ? $lang['4'] : $lang['3'] }}</strong></td>
                                        <td class="py-2 border-b">{{round($detail['result'],3)}} {{$detail['unit']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <p class="col-12 pb-2 mt-3"><strong>{{ $lang['5'] }}</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%] ">                    
                                <table class="w-full text-[16px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{ $lang['6'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round($detail['result'] * 10, 3) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['7'] }}</td>
                                        <td class="py-2 border-b"><strong>{{round($detail['result'] * 0.01,  3)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['8'] }}</td>
                                        <td class="py-2 border-b"><strong>{{round($detail['result'] ,1)* 0.00001}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['9'] }}</td>
                                        <td class="py-2 border-b"><strong>{{round($detail['result'] * 0.3937,  2)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['10'] }}</td>
                                        <td class="py-2 border-b"><strong>{{round($detail['result'] * 0.0328084,  3)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['11'] }}</td>
                                        <td class="py-2 border-b"><strong>{{round($detail['result'] * 0.0109361,5)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['12'] }}</td>
                                        <td class="py-2 border-b"><strong>{{round($detail['result'] * 0.0000062137,6)}}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            function toggleFields() {
                var value = document.querySelector('input[name="conversionType"]:checked').value;
                if (value === "circumferenceToDiameter") {
                    document.getElementById('textChanged').textContent = '{{ $lang['3'] }}:';
                } else if (value === "diameterToCircumference") {
                    document.getElementById('textChanged').textContent = '{{ $lang['4'] }}:';
                }
            }
        </script>
    @endpush
</form>