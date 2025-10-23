<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select class="input" aria-label="select" id="operations" name="operations">
                        <option value="1"><?=$lang[2]?> (c)</option>
                        <option value="2" {{ isset($_POST['operations']) && $_POST['operations']=='2'?'selected':'' }}><?=$lang[3]?> (A)</option>
                        <option value="3" {{ isset($_POST['operations']) && $_POST['operations']=='3'?'selected':'' }}><?=$lang[4]?> (d)</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['operations']) && $_POST['operations']=='2' ? 'hidden':'block' }}" id="f_input">
                <label for="first" class="font-s-14 text-blue" id="txt">
                    {{ isset($_POST['operations']) && $_POST['operations']=='3' ? "$lang[4] (d):" : "$lang[5] (c):" }}
                </label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first']) ? $_POST['first'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit1_dropdown')">{{ isset($_POST['unit1'])?$_POST['unit1']:'cm' }} ▾</label>
                    <input type="text" name="unit1" value="{{ isset($_POST['unit1'])?$_POST['unit1']:'cm' }}" id="unit1" class="hidden">
                    <div id="unit1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit1">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'cm')">centimeters (cm)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'mm')">milimeters (mm)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'm')">meters (m)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'km')">kilometers (km)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'dm')">decimetre (dm)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'in')">inches (in)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'yd')">yards (yd)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'mi')">miles (mi)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'nmi')">nautical mile (nmi)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['operations']) && $_POST['operations']=='2' ? 'block':'hidden' }}" id="areaInput">
                <label for="second" class="font-s-14 text-blue">{{$lang[3]}} (A)</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second']) ? $_POST['second'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit2_dropdown')">{{ isset($_POST['unit2'])?$_POST['unit2']:'cm' }} ▾</label>
                    <input type="text" name="unit2" value="{{ isset($_POST['unit2'])?$_POST['unit2']:'cm' }}" id="unit2" class="hidden">
                    <div id="unit2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit2">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'mm²')">square millimeter (mm²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'cm²')">square centimeter (cm²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'dm²')">square decimeter (dm²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'm²')">square metre (m²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'km²')">square kilometre (km²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'in²')">square inch (in²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'ft²')">square feet (ft²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'yd²')">square yards (yd²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'mi²')">square miles (mi²)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'a')">atto (a)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'da')">dekameters (da)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'ha')">hectares (ha)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'ac')">acres (ac)</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'sf')">soccer fields</p>
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
                                    @isset($detail['radius'])
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['6'] }}</strong></td>
                                            <td class="py-2 border-b">{{round($detail['radius'], 2)}} cm</td>
                                        </tr>
                                    @endisset
                                    @isset($detail['circum'])
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['5'] }}</strong></td>
                                            <td class="py-2 border-b">{{round($detail['circum'], 2)}} cm</td>
                                        </tr>
                                    @endisset
                                    @isset($detail['area'])
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }}</strong></td>
                                            <td class="py-2 border-b">{{round($detail['area'], 2)}} cm²</td>
                                        </tr>
                                    @endisset
                                    @isset($detail['diameter'])
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }}</strong></td>
                                            <td class="py-2 border-b">{{round($detail['diameter'], 2)}} cm</td>
                                        </tr>
                                    @endisset
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
            document.getElementById('operations').addEventListener('change', function() {
                if(this.value === "1"){
                    document.getElementById('txt').textContent = '{{$lang[5]}} (c):';
                    document.getElementById('f_input').style.display = 'block';
                    document.getElementById('areaInput').style.display = 'none';
                }else if(this.value === '2'){
                    document.getElementById('f_input').style.display = 'none';
                    document.getElementById('areaInput').style.display = 'block';
                }else{
                    document.getElementById('f_input').style.display = 'block';
                    document.getElementById('areaInput').style.display = 'none';
                    document.getElementById('txt').textContent = '{{$lang[4]}} (d):';
                }
            });
        </script>
    @endpush
</form>