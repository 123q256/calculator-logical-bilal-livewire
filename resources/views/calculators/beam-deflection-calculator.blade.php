<style>
    #second_select, #first_select{
        background: transparent;
        border: none;
        color: #1670a7;
        outline: none;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-4">
                <div class="col-span-6">
                    <div class="grid grid-cols-12  gap-4">
                        <div class="col-span-12">
                            <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                            <div class="w-full py-2 position-relative">
                                <select name="operations" id="operations" class="input">
                                    @php
                                        function optionsList($arr1,$arr2,$unit){
                                        foreach($arr1 as $index => $name){
                                    @endphp
                                        <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                            {!! $arr2[$index] !!}
                                        </option>
                                    @php
                                        }}
                                        $name = [$lang[2],$lang[3]];
                                        $val = ["1","2"];
                                        optionsList($val,$name,isset($_POST['operations'])?$_POST['operations']:'1');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 shape1">
                            <label for="shape_1" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                            <div class="w-full py-2 position-relative">
                                <select name="shape_1" id="shape_1" class="input">
                                    @php
                                        $name=[$lang[5],$lang[6],$lang[7],$lang[8],$lang[9],$lang[10]];
                                        $val = ["1","2","3","4","5","6"];
                                        optionsList($val,$name,isset($_POST['shape_1'])?$_POST['shape_1']:'1');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 shape2">
                            <label for="shape_2" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                            <div class="w-full py-2 position-relative">
                                <select name="shape_2" id="shape_2" class="input">
                                    @php
                                        $name=[$lang[11],$lang[6],$lang[7],$lang[12],$lang[13],$lang[14]];
                                        $val = ["1","2","3","4","5","6"];
                                        optionsList($val,$name,isset($_POST['shape_2'])?$_POST['shape_2']:'1');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 f1">
                            <label for="first" class="font-s-14 text-blue" id="txt1">{{ $lang[15] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="first" id="first" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['first']) ? $_POST['first'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit1_dropdown')">{{ isset($_POST['unit1'])?$_POST['unit1']:'m' }} ▾</label>
                                <input type="text" name="unit1" value="{{ isset($_POST['unit1'])?$_POST['unit1']:'m' }}" id="unit1" class="hidden">
                                <div id="unit1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit1">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'cm')">cm</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'mm')">mm</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'm')">m</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'in')">in</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'ft')">ft</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit1', 'yd')">yd</p>
                                </div>
                             </div>
                        </div>
                        <div class="col-span-12 f6">
                            <label for="six" class="font-s-14 text-blue" id="txt6">{{ $lang[16] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="six" id="six" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['six']) ? $_POST['six'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit6" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit6_dropdown')">{{ isset($_POST['unit6'])?$_POST['unit6']:'N/m' }} ▾</label>
                                <input type="text" name="unit6" value="{{ isset($_POST['unit6'])?$_POST['unit6']:'N/m' }}" id="unit6" class="hidden">
                                <div id="unit6_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit6">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit6', 'N/m')">N/m</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit6', 'kN/m')">kN/m</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit6', 'ibf/in')">ibf/in</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit6', 'ibf/ft')">ibf/ft</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit6', 'dyn/cm')">dyn/cm</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit6', 'kip/ft')">kip/ft</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit6', 'kip/in')">kip/in</p>
                                </div>
                             </div>
                        </div>
                        <div class="col-span-12 f7">
                            <label for="seven" class="font-s-14 text-blue" id="txt7">{{ $lang[16] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="seven" id="seven" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['seven']) ? $_POST['seven'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit7" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit7_dropdown')">{{ isset($_POST['unit7'])?$_POST['unit7']:'N.m' }} ▾</label>
                                <input type="text" name="unit7" value="{{ isset($_POST['unit7'])?$_POST['unit7']:'N.m' }}" id="unit7" class="hidden">
                                <div id="unit7_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit7">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit7', 'N.m')">N.m</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit7', 'kgf.cm')">kgf.cm</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit7', 'J/rad')">J/rad</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit7', 'ibf.ft')">ibf.ft</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit7', 'ibf.in')">ibf.in</p>
                                </div>
                             </div>
                        </div>
                        <div class="col-span-12 f2">
                            <label for="second" class="font-s-14 text-blue" id="txt2">{{ $lang[18] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="second" id="second" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['second']) ? $_POST['second'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit2_dropdown')">{{ isset($_POST['unit2'])?$_POST['unit2']:'N' }} ▾</label>
                                <input type="text" name="unit2" value="{{ isset($_POST['unit2'])?$_POST['unit2']:'N' }}" id="unit2" class="hidden">
                                <div id="unit2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit2">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'N')">N</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'kN')">kN</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'MN')">MN</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'GN')">GN</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'TN')">TN</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'ibf')">ibf</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit2', 'kip')">kip</p>
                                </div>
                             </div>
                        </div>
                        <div class="col-span-12 f3">
                            <label for="third" class="font-s-14 text-blue" id="txt3">{{ $lang[19] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="third" id="third" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['third']) ? $_POST['third'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit3_dropdown')">{{ isset($_POST['unit3'])?$_POST['unit3']:'kPa' }} ▾</label>
                                <input type="text" name="unit3" value="{{ isset($_POST['unit3'])?$_POST['unit3']:'kPa' }}" id="unit3" class="hidden">
                                <div id="unit3_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit3">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'Pa')">Pa</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'psi')">psi</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'kPa')">kPa</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'MPa')">MPa</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'GPa')">GPa</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit3', 'kN/m²')">kN/m²</p>
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-6 con">
                    <div class="grid grid-cols-12  gap-4">
                        <div class="col-span-12 text-center">
                            <img src="<?=url('images/d1_img1.png')?>" alt="beam image" width="100%" height="100%" class="set_img"> 
                        </div>
                        <div class="col-span-12 f4">
                            <label for="four" class="font-s-14 text-blue" id="txt4">{{ $lang[20] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="four" id="four" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['four']) ? $_POST['four'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit4" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit4_dropdown')">{{ isset($_POST['unit4'])?$_POST['unit4']:'m⁴' }} ▾</label>
                                <input type="text" name="unit4" value="{{ isset($_POST['unit4'])?$_POST['unit4']:'m⁴' }}" id="unit4" class="hidden">
                                <div id="unit4_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit4">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit4', 'm⁴')">m⁴</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit4', 'cm⁴')">cm⁴</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit4', 'mm⁴')">mm⁴</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit4', 'in⁴')">in⁴</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit4', 'ft⁴')">ft⁴</p>
                                </div>
                             </div>
                        </div>
                        <div class="col-span-12 f5">
                            <label for="five" class="font-s-14 text-blue" id="txt5">{{ $lang[21] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="five" id="five" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['five']) ? $_POST['five'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="unit5" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit5_dropdown')">{{ isset($_POST['unit5'])?$_POST['unit5']:'m' }} ▾</label>
                                <input type="text" name="unit5" value="{{ isset($_POST['unit5'])?$_POST['unit5']:'m' }}" id="unit5" class="hidden">
                                <div id="unit5_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit5">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit5', 'm')">m</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit5', 'mm')">mm</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit5', 'm')">m</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit5', 'in')">in</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit5', 'ft')">ft</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit5', 'yd')">yd</p>
                                </div>
                             </div>
                        </div>
                       
                        <div class="col-span-12 shape1_ex">
                            <label for="shape1_extra" class="font-s-14 text-blue">{{ $lang['22'] }}:</label>
                            <div class="w-full py-2 position-relative">
                                <select name="shape1_extra" id="shape1_extra" class="input">
                                    @php
                                        $name=[$lang[23],$lang[24]];
                                        $val = ["1","2"];
                                        optionsList($val,$name,isset($_POST['shape1_extra'])?$_POST['shape1_extra']:'1');
                                    @endphp
                                </select>
                            </div>
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  overflow-auto">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">{{ $lang[25] }}</td>
                                        <td class="py-2 border-b"><strong class="text-blue">
                                            <span id="first_result">{{ round($detail['stiffness'], 4) }}</span> 
                                            <select name="first_unit_result" id="first_select" class="d-inline ms-2" style="width:100px">
                                                @php
                                                    $name = ["MN·m²","kN·m²","N·m²"];
                                                    $val = ["MN·m²","kN·m²","N·m²"];
                                                    optionsList($val, $name, isset($_POST['first_unit_result']) ? $_POST['first_unit_result'] : 'MN·m²');
                                                @endphp
                                            </select>
                                        </strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang[26] }}</td>
                                        <td class="py-2 border-b"><strong class="text-blue">
                                            <span id="second_result">{{ round($detail['max_def'], 4) }}</span>
                                            <select name="second_unit_result" id="second_select" class="d-inline ms-2" style="width:100px">
                                                @php
                                                    $name = ["mm","cm","m","in","ft"];
                                                    $val = ["mm","cm","m","in","ft"];
                                                    optionsList($val, $name, isset($_POST['second_unit_result']) ? $_POST['second_unit_result'] : 'mm');
                                                @endphp
                                            </select>    
                                        </strong></td>
                                    </tr>
                                    @if (isset($detail['distance_b']))    
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang[27] }}</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['distance_b'], 4) }} (m)</strong></td>
                                        </tr>
                                    @endif
                                    @if (isset($detail['x']))
                                        <tr>
                                            <td class="py-2 border-b">x</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['x'], 4) }} (m)</strong></td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
@push('calculatorJS')
    <script>
          @isset($detail)
            document.addEventListener("DOMContentLoaded", () => {
                const conversionFactors = {
                    'MN·m²': 1,         // Base unit for stiffness
                    'kN·m²': 1000,      // kN·m² to MN·m²
                    'N·m²': 1000000,    // N·m² to MN·m²
                    'mm': 1,            // Base unit for deflection
                    'cm': 0.1,          // cm to mm
                    'm': 0.001,         // m to mm
                    'in': 0.0393701,    // in to mm
                    'ft': 0.00328084    // ft to mm
                };

                // Function to set initial values and conversion event listeners
                function setInitialValueAndListener(resultSpanId, selectElementId) {
                    const resultSpan = document.getElementById(resultSpanId);
                    const unitSelect = document.getElementById(selectElementId);

                    // Store the initial value in a data attribute
                    const initialValue = parseFloat(resultSpan.innerText);
                    resultSpan.setAttribute('data-initial-value', initialValue);

                    // Update the displayed value based on the selected unit
                    unitSelect.addEventListener('change', () => {
                        const selectedUnit = unitSelect.value;
                        const conversionFactor = conversionFactors[selectedUnit];

                        if (conversionFactor !== undefined) {
                            const originalValue = parseFloat(resultSpan.getAttribute('data-initial-value'));
                            const convertedValue = originalValue * conversionFactor;
                            resultSpan.innerText = Number(convertedValue.toFixed(6)).toString();
                        } else {
                            console.error("Invalid conversion factor for unit: " + selectedUnit);
                        }
                    });
                }

                // Set initial values and listeners for the results
                setInitialValueAndListener('first_result', 'first_select');
                setInitialValueAndListener('second_result', 'second_select');
            });
        @endisset

        
        document.addEventListener("DOMContentLoaded", function() {
            function operations() {
                var a = document.getElementById('operations').value;
                if (a === "1") {
                    showElements([".f1", ".f2", ".f3", ".f4", ".shape1"]);
                    hideElements([".f5", ".f6", ".shape1_ex", ".f7", ".shape2"]);
                    setAttributes("src", "<?=url('images/d1_img1.png')?>");
                    setTexts(["#txt1", "#txt2", "#txt3", "#txt4"], ["<?=$lang[15]?>:", "<?=$lang[18]?>:", "<?=$lang[19]?>:", "<?=$lang[20]?>:"]);
                } else if (a === "2") {
                    showElements([".f1", ".f2", ".f3", ".f4", ".shape2"]);
                    hideElements([".f5", ".f6", ".shape1_ex", ".f7", ".shape1"]);
                    setAttributes("src", "<?=url('images/d2_img1.png')?>");
                    setTexts(["#txt1", "#txt2", "#txt3", "#txt4"], ["<?=$lang[15]?>:", "<?=$lang[18]?>:", "<?=$lang[19]?>:", "<?=$lang[20]?>:"]);
                }
            }

            document.getElementById("operations").addEventListener("change", operations);

            function shape_1() {
                var a = document.getElementById("shape_1").value;
                if (a === "1") {
                    showElements([".f1", ".f2", ".f3", ".f4"]);
                    hideElements([".f5", ".f6", ".shape1_ex", ".f7"]);
                    setAttributes("src", "<?=url('images/d1_img1.png')?>");
                    setTexts(["#txt1", "#txt2", "#txt3", "#txt4"], ["<?=$lang[15]?>:", "<?=$lang[18]?>:", "<?=$lang[19]?>:", "<?=$lang[20]?>:"]);
                } else if (a === "2") {
                    showElements([".f1", ".f2", ".f3", ".f4", ".f5"]);
                    hideElements([".f6", ".shape1_ex", ".f7"]);
                    setAttributes("src", "<?=url('images/d1_img2.png')?>");
                    setTexts(["#txt1", "#txt2", "#txt3", "#txt4", "#txt5"], ["<?=$lang[15]?>:", "<?=$lang[18]?>:", "<?=$lang[19]?>:", "<?=$lang[20]?>:", "<?=$lang[21]?>:"]);
                } else if (a === "3") {
                    showElements([".f1", ".f6", ".f3", ".f4"]);
                    hideElements([".f2", ".f5", ".shape1_ex", ".f7"]);
                    setAttributes("src", "<?=url('images/d1_img3.png')?>");
                    setTexts(["#txt1", "#txt6", "#txt3", "#txt4"], ["<?=$lang[15]?>:", "<?=$lang[16]?>:", "<?=$lang[19]?>:", "<?=$lang[20]?>:"]);
                } else if (a === "4") {
                    showElements([".f1", ".f6", ".f3", ".f4", ".shape1_ex"]);
                    hideElements([".f2", ".f5", ".f7"]);
                    setAttributes("src", "<?=url('images/d1_img4.png')?>");
                    setTexts(["#txt1", "#txt6", "#txt3", "#txt4"], ["<?=$lang[15]?>:", "<?=$lang[28]?>:", "<?=$lang[19]?>:", "<?=$lang[20]?>:"]);
                } else if (a === "5") {
                    showElements([".f1", ".f6", ".f3", ".f4"]);
                    hideElements([".f2", ".f5", ".shape1_ex", ".f7"]);
                    setAttributes("src", "<?=url('images/d1_img5.png')?>");
                    setTexts(["#txt1", "#txt6", "#txt3", "#txt4"], ["<?=$lang[15]?>:", "<?=$lang[28]?>:", "<?=$lang[19]?>:", "<?=$lang[20]?>:"]);
                } else if (a === "6") {
                    showElements([".f1", ".f3", ".f4", ".shape1_ex", ".f7"]);
                    hideElements([".f2", ".f5", ".f6"]);
                    setAttributes("src", "<?=url('images/d1_img6.png')?>");
                    setTexts(["#txt1", "#txt7", "#txt3", "#txt4"], ["<?=$lang[15]?>:", "<?=$lang[17]?>:", "<?=$lang[19]?>:", "<?=$lang[20]?>:"]);
                }
            }

            document.getElementById("shape_1").addEventListener("change", shape_1);

            function shape_2() {
                var a = document.getElementById("shape_2").value;
                if (a === "1") {
                    showElements([".f1", ".f2", ".f3", ".f4"]);
                    hideElements([".f5", ".f6", ".shape1_ex", ".f7"]);
                    setAttributes("src", "<?=url('images/d2_img1.png')?>");
                    setTexts(["#txt1", "#txt2", "#txt3", "#txt4"], ["<?=$lang[15]?>:", "<?=$lang[18]?>:", "<?=$lang[19]?>:", "<?=$lang[20]?>:"]);
                } else if (a === "2") {
                    showElements([".f1", ".f2", ".f3", ".f4", ".f5"]);
                    hideElements([".f6", ".shape1_ex", ".f7"]);
                    setAttributes("src", "<?=url('images/d2_img2.png')?>");
                    setTexts(["#txt1", "#txt2", "#txt3", "#txt4", "#txt5"], ["<?=$lang[15]?>:", "<?=$lang[18]?>:", "<?=$lang[19]?>:", "<?=$lang[20]?>:", "<?=$lang[21]?>:"]);
                } else if (a === "3") {
                    showElements([".f1", ".f6", ".f3", ".f4"]);
                    hideElements([".f2", ".f5", ".shape1_ex", ".f7"]);
                    setAttributes("src", "<?=url('images/d2_img3.png')?>");
                    setTexts(["#txt1", "#txt6", "#txt3", "#txt4"], ["<?=$lang[15]?>:", "<?=$lang[16]?>:", "<?=$lang[19]?>:", "<?=$lang[20]?>:"]);
                } else if (a === "4") {
                    showElements([".f1", ".f6", ".f3", ".f4"]);
                    hideElements([".f2", ".f5", ".f7", ".shape1_ex"]);
                    setAttributes("src", "<?=url('images/d2_img4.png')?>");
                    setTexts(["#txt1", "#txt6", "#txt3", "#txt4"], ["<?=$lang[15]?>:", "<?=$lang[28]?>:", "<?=$lang[19]?>:", "<?=$lang[20]?>:"]);
                } else if (a === "5") {
                    showElements([".f1", ".f6", ".f3", ".f4"]);
                    hideElements([".f2", ".f5", ".f7", ".shape1_ex"]);
                    setAttributes("src", "<?=url('images/d2_img5.png')?>");
                    setTexts(["#txt1", "#txt6", "#txt3", "#txt4"], ["<?=$lang[15]?>:", "<?=$lang[28]?>:", "<?=$lang[19]?>:", "<?=$lang[20]?>:"]);
                } else if (a === "6") {
                    showElements([".f1", ".f3", ".f4", ".f7"]);
                    hideElements([".f2", ".f5", ".f6", ".shape1_ex"]);
                    setAttributes("src", "<?=url('images/d2_img6.png')?>");
                    setTexts(["#txt1", "#txt7", "#txt3", "#txt4"], ["<?=$lang[15]?>:", "<?=$lang[17]?>:", "<?=$lang[19]?>:", "<?=$lang[20]?>:"]);
                }
            }

            document.getElementById("shape_2").addEventListener("change", shape_2);

            function showElements(selectors) {
                selectors.forEach(function(selector) {
                    document.querySelectorAll(selector).forEach(function(element) {
                        element.style.display = 'block';
                    });
                });
            }

            function hideElements(selectors) {
                selectors.forEach(function(selector) {
                    document.querySelectorAll(selector).forEach(function(element) {
                        element.style.display = 'none';
                    });
                });
            }

            function setAttributes(attribute, value) {
                document.querySelectorAll('.set_img').forEach(function(element) {
                    element.setAttribute(attribute, value);
                });
            }

            function setTexts(selectors, texts) {
                selectors.forEach(function(selector, index) {
                    document.querySelector(selector).innerText = texts[index];
                });
            }

            // Initial call to set the state based on current selection
            operations();
            shape_1();
            shape_2();
        })
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>