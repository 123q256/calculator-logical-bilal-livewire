<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
            <input type="hidden" name="type" id="type" value="first">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit tabs" id="first">
                            {{ $lang['1'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tabs" id="second">
                            {{ $lang['2'] }}
                    </div>
                </div>
            </div>
        </div>

            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 input-field finch">
                <label for="find" class="label">I want to calculate:</label>
                <div class="w-full py-2 position-relative">
                    <select name="find" id="find" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name=[$lang['3'],$lang['4'],$lang['5']];
                            $val = ["1","2","3"];
                            optionsList($val,$name,isset(request()->find)?request()->find:'1');
                        @endphp
                    </select>
                </div>
            </div>


            <div class="col-span-12 md:col-span-6 lg:col-span-6 input-field amount_solute">
                <label for="amount_solute" class="label">{{ $lang['4'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="amount_solute" id="amount_solute" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['amount_solute']) ? $_POST['amount_solute'] : '8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="amount_solute_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('amount_solute_unit_dropdown')">{{ isset($_POST['amount_solute_unit'])?$_POST['amount_solute_unit']:'mol' }} ▾</label>
                    <input type="text" name="amount_solute_unit" value="{{ isset($_POST['amount_solute_unit'])?$_POST['amount_solute_unit']:'mol' }}" id="amount_solute_unit" class="hidden">
                    <div id="amount_solute_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="amount_solute_unit">
                        <p value="1" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('amount_solute_unit', 'mol')">mole (mol)</p>
                        <p value="0.001" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('amount_solute_unit', 'mmol')">millimole (mmol)</p>
                        <p value="1e-6" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('amount_solute_unit', 'µmol')">micormole (µmol)</p>
                        <p value="1e-9" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('amount_solute_unit', 'nmol')">nanomol (nmol)</p>
                        <p value="1e-12" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('amount_solute_unit', 'pmol')">picomol (pmol)</p>
                    </div>
                 </div>
            </div>

             
            <div class="col-span-12 md:col-span-6 lg:col-span-6 input-field mass_solvent">
                <label for="mass_solvent" class="label">{{ $lang['5'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="mass_solvent" id="mass_solvent" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass_solvent']) ? $_POST['mass_solvent'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="mass_solvent_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mass_solvent_unit_dropdown')">{{ isset($_POST['mass_solvent_unit'])?$_POST['mass_solvent_unit']:'µg' }} ▾</label>
                    <input type="text" name="mass_solvent_unit" value="{{ isset($_POST['mass_solvent_unit'])?$_POST['mass_solvent_unit']:'µg' }}" id="mass_solvent_unit" class="hidden">
                    <div id="mass_solvent_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="mass_solvent_unit">
                        <p value="0.000000001" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solvent_unit', 'µg')">micrograms (µg)</p>
                        <p value="0.000001" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solvent_unit', 'mg')">milligrams (mg)</p>
                        <p value="0.001" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solvent_unit', 'g')">grams (g)</p>
                        <p value="0.01" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solvent_unit', 'dag')">decagrams (dag)</p>
                        <p value="1" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solvent_unit', 'kg')">kilograms (kg)</p>
                        <p value="0.02835" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solvent_unit', 'oz')">ounces (oz)</p>
                        <p value="0.4536" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_solvent_unit', 'lbs')">pounds (lbs)</p>
                    </div>
                 </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6 input-field molality">
                <label for="molality" class="label">{{ $lang['3'] }}:</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="molality" id="molality" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['molality']) ? $_POST['molality'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="molality_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('molality_unit_dropdown')">{{ isset($_POST['molality_unit'])?$_POST['molality_unit']:'mol / µg' }} ▾</label>
                    <input type="text" name="molality_unit" value="{{ isset($_POST['molality_unit'])?$_POST['molality_unit']:'mol / µg' }}" id="molality_unit" class="hidden">
                    <div id="molality_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="molality_unit">
                        <p value="0.000000001" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('molality_unit', 'mol / µg')">mol / micrograms (µg)</p>
                        <p value="0.000001" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('molality_unit', 'mol / mg')">mol / milligrams (mg)</p>
                        <p value="0.001" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('molality_unit', 'mol / g')">mol / grams (g)</p>
                        <p value="0.01" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('molality_unit', 'mol / dag')">mol / decagrams (dag)</p>
                        <p value="1" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('molality_unit', 'mol / kg')">mol / kilograms (kg)</p>
                        <p value="0.02835" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('molality_unit', 'mol / oz')">mol / ounces (oz)</p>
                        <p value="0.4536" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('molality_unit', 'mol / lbs')">mol / pounds (lbs)</p>
                      
                    </div>
                 </div>
            </div>
            <div class="col-span-12 input-field whole hidden">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="density" class="label">{{ $lang['7'] }} [ρ]:</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" name="density" id="density" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->density)?request()->density:'997' }}" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="density_unit" class="label">&nbsp;</label>
                        <div class="w-full py-2 position-relative">
                            <select name="density_unit" id="density_unit" class="input">
                                @php
                                    $name=["Centigram per Liter","Decigram per Liter","Dekagram per Liter","Earth's Density (mean)","Femtogram per Liter","Grain per Foot³","Grain per Gallon (UK)","Grain per Gallon (US)","Gram per Centimeter³","Gram per Liter","Gram per Meter³","Gram per Milliliter","Gram per Millimeter³","Hectogram per Liter","Kilogram per Centimeter³","Kilogram per Centimeter³","Kilogram per Cubic Decimeter","Kilogram per Liter","Kilogram per Meter³","Megagram per Liter","Microgram per Liter","Milligram per Centimeter³","Milligram per Liter","Milligram per Meter³","Milligram per Millimeter³","Nanogram per Liter","Ounce per Foot³","Ounce per Gallon (UK)","Ounce per Gallon (US)","Ounce per Inch³","Picogram per Liter","Planck Density","Pound per Foot³","Pound per Gallon (UK)","Pound per Gallon (US)","Pound per Inch³","Pound per Inch³","Pound per Yard³","Slug per Foot³","Slug per Inch³","Slug per Yard³","Ton (long) per Yard³","Ton (short) per Yard³"];
                                    $val= ["0.01","0.1","10","0.0002","1E-15","0.0023","0.0143","0.0171","1000","1","0.001","1000","1000000","100","1000000","1000000","1000","1000","1","1000000","1E-6","0.001","1E-6","1000","1E-9","1.0012","6.236","7.4892","1729.994","1E-12","5.155E+96 ","16.0185","99.7764","119.8264","27679.9047","27679.9047","0.5933","515.3788","890574.5976","19.0881","1328.9392","1186.5529"];
                                    optionsList($val,$name,isset(request()->density_unit)?request()->density_unit:'1');
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="molecular_mass_solute" class="label">{{ $lang['8'] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" name="molecular_mass_solute" id="molecular_mass_solute" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->molecular_mass_solute)?request()->molecular_mass_solute:'25' }}" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="molecular_mass_solute_unit" class="label">&nbsp;</label>
                        <div class="w-full py-2 position-relative">
                            <select name="molecular_mass_solute_unit" id="molecular_mass_solute_unit" class="input">
                                @php
                                    $name = ["Assarion (Biblical Roman)","Atomic Mass Unit","Attogram","Bekan (Biblical Hebrew)","Carat","Centigram","Dalton","Decagram","Decigram","Denarius (Biblical Roman)","Deuteron Mass","Didrachma (Biblical Greek)","Drachma (Biblical Greek)","Earth's Mass","Electron Mass (Rest)","Exagram","Femtogram","Gamma","Gerah (Biblical Hebrew)","Gigagram","Gigatonne","Grain","Gram","Hectogram","Hundredweight(UK)","Jupiter Mass","Kilogram","Kilo-Force Square Second Per Foot","KiloPound","Kiloton(Metric)","Lepton (Biblical Roman)","Megragram","Megatonne","Microgram","Milligram","Mina(Biblical Greek)","Mina(Biblical Hebrew)","Muon Mass","Nanogram","Neutron Mass","Ounce","Pennyweight","Petagram","Picogram","Planck Mass","Pound","Pound(Troy or Apothecary)","Poundal","Pound-Force Square Second Per Foot","Proton Mass","Quadrans(Biblical Romans)","Quarter(UK)","Quarter(US)","Quintal","Scruple(Apotherapy)","Shekel(Biblical Hebrew)","Slug","Solar Mass","Stone (UK)","Stone (US)","Sun's Mass","Talent(Biblical Greek)","Talent(Biblical Hebrew)","Teragram","Tetradrachma(Biblical Greek)","Ton (Assay)(UK)","Ton (Assay)(US)","Ton(Long)","Ton(Metric)","Ton(Short)","Tonne"];
                                    $val = ["4155.8441558","6.022136651E+26","1E+21","175.43859649","5000","100000","6.022173643E+26","100","10000","259.74025974","2.990800894E+26","2.990800894E+26","1.67336010709505E-25","9.10938970730895E-31","1E-15","1E+15","1E+18","1000000000","1754.3859649","5.978633201E+26","1E-12","15432.358353","1000","10","0.0196841306","5.26592943654555E-28","1","0.1019716213","0.0022046226218","1E-06","33246.753247)","0.001","1E-09","1000000000","1000000","2.9411764706","2.9411764706)","5.309172492E+27","1000000000000","5.970403753E+26","35.27396195","643.01493137","1E-12","1E+15","45940892.448","45940892.448","2.6792288807","70.988848424","0.0685217658999999","5.978633201E+26","16623.376623","0.0787365221999998","0.0881849049000002","0.01","0.000984206527611061","87.719298246","87.719298246","1.988E+30","0.1574730444","0.1763698097","5.02765208647562E-31s","0.0490196078","0.0292397661)","1E-09","73.529411765","30.612244898","34.285710367","0.000984206527611061","0.001","0.0011023113","0.001"];
                                    optionsList($val,$name,isset(request()->molecular_mass_solute_unit)?request()->molecular_mass_solute_unit:'1');
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
                        <div class="w-full text-center">
                            @if($detail['type']=="first")
                                @if($detail['method']=="1")
                                    <p><strong class="text-[14px] md:text-[18px] lg:text-[18px]">{!! $lang['3'] !!}</strong></p>
                                    <p><strong class="text-green-500 text-[20px] md:text-[32px] lg:text-[32px]">{!! round($detail['molality'],2) !!}<span class="text-green-500 text-[16px] md:text-[22px] lg:text-[22px]"> (mol/kg) </span></strong></p>
                                @endif
                                @if($detail['method']=="2")
                                    <p><strong class="text-[14px] md:text-[18px] lg:text-[18px]">{!! $lang['4'] !!}</strong></p>
                                    <p><strong class="text-green-500 text-[20px] md:text-[32px] lg:text-[32px]">{!! round($detail['amount_of_solute'],2) !!}<span class="text-green-500 text-[16px] md:text-[22px] lg:text-[22px]"> (mol) </span></strong></p>
                                @endif
                                @if($detail['method']=="3")
                                    <p><strong class="text-[14px] md:text-[18px] lg:text-[18px]">{!! $lang['5'] !!}</strong></p>
                                    <p><strong class="text-green-500 text-[20px] md:text-[32px] lg:text-[32px]">{!! round($detail['amount_of_solvent'],2) !!}<span class="text-green-500 text-[16px] md:text-[22px] lg:text-[22px]"> (kg) </span></strong></p>
                                @endif
                            @endif
                            @if($detail['type']=="second")
                                <p><strong class="text-[14px] md:text-[18px] lg:text-[18px]">{!! $lang['6'] !!} [M]</strong></p>
                                <p><strong class="text-green-500 text-[20px] md:text-[32px] lg:text-[32px]">{!! $detail['molality']*0.001 !!}<span class="text-green-500 text-[16px] md:text-[22px] lg:text-[22px]"> (m/L) </span></strong></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var type = "{{ request()->type }}";

                function hideAllFields() {
                    var fields = document.querySelectorAll('.input-field');
                    fields.forEach(function(field) {
                        field.style.display = 'none';
                    });
                }

                function deactivateAllTabs() {
                    var tabs = document.querySelectorAll('.tabs');
                    tabs.forEach(function(tab) {
                        tab.classList.remove('tagsUnit');
                    });
                }

                if (type === 'first') {
                    var h = document.getElementById('find').value;
                    hideAllFields();
                    deactivateAllTabs();
                    document.getElementById('first').classList.add('tagsUnit');

                    if (h === '1') {
                        document.querySelector('.amount_solute').style.display = 'block';
                        document.querySelector('.mass_solvent').style.display = 'block';
                        document.querySelector('.finch').style.display = 'block';
                    } else if (h === '2') {
                        document.querySelector('.molality').style.display = 'block';
                        document.querySelector('.mass_solvent').style.display = 'block';
                        document.querySelector('.finch').style.display = 'block';
                    } else if (h === '3') {
                        document.querySelector('.molality').style.display = 'block';
                        document.querySelector('.amount_solute').style.display = 'block';
                        document.querySelector('.finch').style.display = 'block';
                    }
                } else if (type === 'second') {
                    deactivateAllTabs();
                    document.getElementById('second').classList.add('tagsUnit');
                    hideAllFields();
                    document.querySelector('.whole').style.display = 'block';
                    document.querySelector('.molality').style.display = 'block';
                }

                document.getElementById('first').addEventListener('click', function() {
                    document.getElementById('type').value = 'first';
                    var h = document.getElementById('find').value;
                    hideAllFields();
                    deactivateAllTabs();
                    this.classList.add('tagsUnit');

                    if (h === '1') {
                        document.querySelector('.amount_solute').style.display = 'block';
                        document.querySelector('.mass_solvent').style.display = 'block';
                        document.querySelector('.finch').style.display = 'block';
                    } else if (h === '2') {
                        document.querySelector('.molality').style.display = 'block';
                        document.querySelector('.mass_solvent').style.display = 'block';
                        document.querySelector('.finch').style.display = 'block';
                    } else if (h === '3') {
                        document.querySelector('.molality').style.display = 'block';
                        document.querySelector('.amount_solute').style.display = 'block';
                        document.querySelector('.finch').style.display = 'block';
                    }
                });

                document.getElementById('second').addEventListener('click', function() {
                    document.getElementById('type').value = 'second';
                    deactivateAllTabs();
                    this.classList.add('tagsUnit');
                    hideAllFields();
                    document.querySelector('.whole').style.display = 'block';
                    document.querySelector('.molality').style.display = 'block';
                });

                function updateFields() {
                    var a = document.getElementById("find").value;
                    var inputFields = document.querySelectorAll(".input-field");

                    inputFields.forEach(function(field) {
                        field.style.display = 'none';
                    });

                    if (a == "1") {
                        document.querySelectorAll(".amount_solute, .mass_solvent, .finch").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "2") {
                        document.querySelectorAll(".molality, .mass_solvent, .finch").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    } else if (a == "3") {
                        document.querySelectorAll(".molality, .amount_solute, .finch").forEach(function(field) {
                            field.style.display = 'block';
                        });
                    }
                }

                document.getElementById("find").addEventListener("change", function() {
                    updateFields();
                });
            });
        </script>
    @endpush
</form>