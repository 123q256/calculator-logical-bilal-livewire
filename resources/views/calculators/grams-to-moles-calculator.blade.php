<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="w-full px-2 mb-2">
                <p class="font-s-14"><strong class="text-blue">{!! $lang['20'] !!}: </strong>{!! $lang['21'] !!}</p>
            </div>
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="chemical_selection" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <select name="chemical_selection" id="chemical_selection" class="input">
                        <option value="1" {{ isset($_POST['chemical_selection']) && $_POST['chemical_selection'] == '1' ? 'selected' : '' }}>{{ $lang['2'] }}</option>
                        <option value="2" {{ isset($_POST['chemical_selection']) && $_POST['chemical_selection'] == '2' ? 'selected' : '' }}>{{ $lang['3'] }}</option>
                        <option value="3" {{ isset($_POST['chemical_selection']) && $_POST['chemical_selection'] == '3' ? 'selected' : '' }}>{{ $lang['4'] }}</option>
                        <option value="4" {{ isset($_POST['chemical_selection']) && $_POST['chemical_selection'] == '4' ? 'selected' : '' }}>{{ $lang['5'] }}</option>
                        <option value="5" {{ isset($_POST['chemical_selection']) && $_POST['chemical_selection'] == '5' ? 'selected' : '' }}>{{ $lang['6'] }}</option>
                        <option value="6" {{ isset($_POST['chemical_selection']) && $_POST['chemical_selection'] == '6' ? 'selected' : '' }}>{{ $lang['7'] }}</option>
                        <option value="7" {{ isset($_POST['chemical_selection']) && $_POST['chemical_selection'] == '7' ? 'selected' : '' }}>{{ $lang['8'] }}</option>
                    </select>
                </div>
                <div class="space-y-2 " id="selection2">
                    <label for="chemical_name" class="font-s-14 text-blue">&nbsp;</label>
                    <select name="chemical_name" id="chemical_name" class="input">
                        <option value="18.015" {{ isset($_POST['chemical_selection']) && $_POST['chemical_selection'] == '18.015' ? 'selected' : '' }}>Water(H₂O)</option>
                        <option value="28.014" {{ isset($_POST['chemical_selection']) && $_POST['chemical_selection'] == '28.014' ? 'selected' : '' }}>Nitrogen(N₂)</option>
                        <option value="31.999" {{ isset($_POST['chemical_selection']) && $_POST['chemical_selection'] == '31.999' ? 'selected' : '' }}>Oxygen(O₂)</option>
                        <option value="2.016" {{ isset($_POST['chemical_selection']) && $_POST['chemical_selection'] == '2.016' ? 'selected' : '' }}>Hydrogen(H₂)</option>
                        <option value="4.003" {{ isset($_POST['chemical_selection']) && $_POST['chemical_selection'] == '4.003' ? 'selected' : '' }}>Helium(He)</option>
                        <option value="44.01" {{ isset($_POST['chemical_selection']) && $_POST['chemical_selection'] == '44.01' ? 'selected' : '' }}>Carbon Dioxide(CO₂)</option>
                        <option value="17.031" {{ isset($_POST['chemical_selection']) && $_POST['chemical_selection'] == '17.031' ? 'selected' : '' }}>Ammonia(NH₃)</option>
                        <option value="34.081" {{ isset($_POST['chemical_selection']) && $_POST['chemical_selection'] == '34.081' ? 'selected' : '' }}>Hydrogen sulfide(H₂S)</option>
                        <option value="119.378" {{ isset($_POST['chemical_selection']) && $_POST['chemical_selection'] == '119.378' ? 'selected' : '' }}>Choloform(CHCL₃)</option>
                    </select>
                </div>
                <div class="space-y-2" id="molar_mass">
                    <label for="mm" class="font-s-14 text-blue">{!! $lang['9'] !!}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="mm" id="mm" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mm'])?$_POST['mm']:'18.015' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="mm_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mm_unit_dropdown')">{{ isset($_POST['mm_unit'])?$_POST['mm_unit']:'g/mol' }} ▾</label>
                        <input type="text" name="mm_unit" value="{{ isset($_POST['mm_unit'])?$_POST['mm_unit']:'g/mol' }}" id="mm_unit" class="hidden">
                        <div id="mm_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[30%] md:w-[30%] w-[30%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mm_unit', 'g/mol1')">g/mol</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mm_unit', 'dag/mol')">dag/mol</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mm_unit', 'kg/mol')">kg/mol</p>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="w-full px-2 my-2">
                <p><strong class="text-blue">{{ $lang['10'] }}</strong></p>
            </div>
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="unit" class="font-s-14 text-blue">{!! $lang['11'] !!}:</label>
                    <select name="unit" id="unit" class="input">
                        <option value="1" {{ isset($_POST['unit']) && $_POST['unit'] == '1' ? 'selected' : '' }}>{{ $lang['12'] }}</option>
                        <option value="2" {{ isset($_POST['unit']) && $_POST['unit'] == '2' ? 'selected' : '' }}>{{ $lang['13'] }}</option>
                        <option value="3" {{ isset($_POST['unit']) && $_POST['unit'] == '3' ? 'selected' : '' }}>{{ $lang['9'] }}</option>
                    </select>
                </div>



                 <div class="space-y-2" id="mass">
                    <label for="m" class="font-s-14 text-blue">{!! $lang['13'] !!}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="m" id="m" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['m'])?$_POST['m']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="m_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('m_unit_dropdown')">{{ isset($_POST['m_unit'])?$_POST['m_unit']:'ng' }} ▾</label>
                        <input type="text" name="m_unit" value="{{ isset($_POST['m_unit'])?$_POST['m_unit']:'ng' }}" id="m_unit" class="hidden">
                        <div id="m_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-lg:w-[50%] md:w-[50%] w-[50%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'ng')">nanograms (ng)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'µg')">micrograms (µg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'mg')">milligrams (mg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'g')">grams (g)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'dag')">decagrams (dag)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'kg')">kilograms (kg)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 hidden" id="no_moles">
                    <label for="nm" class="font-s-14 text-blue">{!! $lang['12'] !!}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="nm" id="nm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['nm'])?$_POST['nm']:'mol' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="nm_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('nm_unit_dropdown')">{{ isset($_POST['nm_unit'])?$_POST['nm_unit']:'mol' }} ▾</label>
                        <input type="text" name="nm_unit" value="{{ isset($_POST['nm_unit'])?$_POST['nm_unit']:'1' }}" id="nm_unit" class="hidden">
                        <div id="nm_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[50%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('nm_unit', 'mol')">moles (mol)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('nm_unit', 'mmol')">millimoles (mmol)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('nm_unit', 'μmol')">micromoles (μmol)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('nm_unit', 'nmol')">nanomoles (nmol)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('nm_unit', 'pmol')">picomoles (pmol)</p>
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
                <div class="w-full p-3 radius-10 mt-3">
                    <div class="w-full mt-2">
                        @if(isset($detail['ans1']) && isset($detail['ans2']))
                            <p><strong>{{ $lang['12'] }}</strong></p>
                            <p><strong class="text-[#119154] text-[30px]">{!! ($detail['ans1']) !!} <span class="text-[#119154] text-[20px]">(mol)</span></strong></p>
                            <p><strong>{{ $lang['14'] }} / {{ $lang['15'] }}</strong></p>
                            <p><strong class="text-[#119154] text-[30px]">{!! ($detail['ans2']) !!}</strong></p>
                            <p class="font-s-20 mt-3 mb-2"><strong>{!! $lang['16'] !!}:</strong></p>
                            <p class="my-2">{!! $lang['9'] !!} = {!! $detail['ans91'] !!} g / mol <br>{!! $lang['13'] !!}  = {!! $detail['ans90'] !!} g <br> {!! $lang['12'] !!} = ? <br> {!! $lang['14'] !!} / {!! $lang['15'] !!} = ?</p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['17'] !!}</strong></p>
                            <p class="my-2">{!! $lang['12'] !!} = {!! $lang['13'] !!} / {!! $lang['9'] !!}</p>
                            <p class="my-2">{!! $lang['14'] !!} / {!! $lang['15'] !!} = {!! $lang['12'] !!} * 6.02214085774</p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['18'] !!}: </strong>{!! $lang['19'] !!}</p>
                            <p class="my-2">{!! $lang['12'] !!} = {!! $detail['ans90'] !!} / {!! $detail['ans91'] !!}</p>
                            <p class="my-2"> {!! $lang['12'] !!} = {!! $detail['ans1'] !!}</p>
                            <p class="my-2">{!! $lang['14'] !!} / {!! $lang['15'] !!} = {!! $detail['ans1'] !!}  * 6.02214085774  </p>
                            <p class="my-2">{!! $lang['14'] !!} / {!! $lang['15'] !!} = {!! $detail['ans2'] !!}</p>
                        @endif
                        @if(isset($detail['ans3']) && isset($detail['ans4']))
                            <p><strong>{{ $lang['13'] }}</strong></p>
                            <p><strong class="text-[#119154] text-[30px]">{!! ($detail['ans3']) !!} <span class="text-[#119154] text-[20px]">(g)</span></strong></p>
                            <p><strong>{{ $lang['14'] }} / {{ $lang['15'] }}</strong></p>
                            <p><strong class="text-[#119154] text-[30px]">{!! ($detail['ans4']) !!}</strong></p>
                            <p class="font-s-20 mt-3 mb-2"><strong>{!! $lang['16'] !!}:</strong></p>
                            <p class="my-2">{!! $lang['9'] !!} ={!! $detail['ans90'] !!} (g/mol)
                            <br>{!! $lang['12'] !!} = {!! $detail['ans91'] !!} (mol) <br>{!! $lang['13'] !!} = ? <br>{!! $lang['14'] !!} / {!! $lang['15'] !!} = ?</p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['17'] !!}</strong></p>
                            <p class="my-2">{!! $lang['13'] !!} = {!! $lang['12'] !!} * {!! $lang['9'] !!}</p>
                            <p class="my-2">{!! $lang['14'] !!} / {!! $lang['15'] !!} = </strong>{!! $lang['12'] !!} * 6.02214085774</p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['18'] !!}: </strong>{!! $lang['19'] !!}</p>
                            <p class="my-2">{!! $lang['13'] !!} ={!! $detail['ans90'] !!} * {!! $detail['ans91'] !!}</p>
                            <p class="my-2">{!! $lang['13'] !!} = {!! $detail['ans3'] !!} (g)</p>
                            <p class="my-2">{!! $lang['14'] !!} / {!! $lang['15'] !!} = {!! $detail['ans91'] !!}  * 6.02214085774</p>
                            <p class="my-2">{!! $lang['14'] !!} / {!! $lang['15'] !!} = {!! $detail['ans4'] !!}</p>
                        @endif
                        @if(isset($detail['ans5']) && isset($detail['ans6']))
                            <p><strong>{{ $lang['9'] }}</strong></p>
                            <p><strong class="text-[#119154] text-[30px]">{!! ($detail['ans5']) !!} <span class="text-[#119154] font-s-20">(g/mol)</span></strong></p>
                            <p><strong>{{ $lang['14'] }} / {{ $lang['15'] }}</strong></p>
                            <p><strong class="text-[#119154] text-[30px]">{!! ($detail['ans6']) !!}</strong></p>
                            <p class="font-s-20 mt-3 mb-2"><strong>{!! $lang['16'] !!}:</strong></p>
                            <p class="my-2"> {!! $lang['13'] !!}= {!! $detail['ans90'] !!} g <br>{!! $lang['12'] !!} ={!! $detail['ans91'] !!} mol <br>{!! $lang['9'] !!} = ? <br>{!! $lang['14'] !!} / {!! $lang['15'] !!} = ? </p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['17'] !!}</strong></p>
                            <p class="my-2">{!! $lang['9'] !!} =  {!! $lang['13'] !!} / {!! $lang['12'] !!}</p>
                            <p class="my-2">{!! $lang['14'] !!} / {!! $lang['15'] !!}= {!! $lang['12'] !!} * 6.02214085774</p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['18'] !!}: </strong>{!! $lang['19'] !!}</p>
                            <p class="my-2"> {!! $lang['9'] !!} ={!! $detail['ans90'] !!} / {!! $detail['ans91'] !!}</p>
                            <p class="my-2">{!! $lang['9'] !!} ={!! $detail['ans5'] !!} (g/mol)</p>
                            <p class="my-2">{!! $lang['14'] !!} / {!! $lang['15'] !!} = {!!  $detail['ans91'] !!}  * 6.02214085774 </p>
                            <p class="my-2">{!! $lang['14'] !!} / {!! $lang['15'] !!} = {!! $detail['ans6'] !!}</p>
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
                let val = document.querySelector('#unit').value;
                if (val == "1") {
                    showElements(['molar_mass', 'mass']);
                    hideElements(['no_moles']);
                } else if (val == "2") {
                    showElements(['no_moles', 'molar_mass']);
                    hideElements(['mass']);
                } else if (val == "3") {
                    showElements(['mass', 'no_moles']);
                    hideElements(['molar_mass']);
                }
                document.querySelector('#unit').addEventListener('change', function() {
                    let val = this.value;
                    if (val == "1") {
                        showElements(['molar_mass', 'mass']);
                        hideElements(['no_moles']);
                    } else if (val == "2") {
                        showElements(['no_moles', 'molar_mass']);
                        hideElements(['mass']);
                    } else if (val == "3") {
                        showElements(['mass', 'no_moles']);
                        hideElements(['molar_mass']);
                    }
                });

                document.querySelector('#chemical_name').addEventListener('change', function() {
                    let v2 = this.value;
                    document.querySelector('#mm').value = v2;
                });

                function showElements(ids) {
                    ids.forEach(id => {
                        document.querySelector(`#${id}`).style.display = 'block';
                    });
                }

                function hideElements(ids) {
                    ids.forEach(id => {
                        document.querySelector(`#${id}`).style.display = 'none';
                    });
                }

                var s1=document.getElementById('chemical_selection');
                var s2=document.getElementById('chemical_name');
                s2.innerHTML="";

                if(s1.value=="1"){
                    var optionArray=['18.015|Water(H₂O)','28.014|Nitrogen(N₂)','31.999|Oxygen(O₂)','2.016|Hydrogen(H₂)','4.003|Helium(He)','44.01|Carbon Dioxide(CO₂)','17.031|Ammonia(NH₃)','34.081|Hydrogen sulfide(H₂S)','119.378|Choloform(CHCL₃)'];
                    document.getElementById("selection2").style.display='block';
                }else if(s1.value=="2"){
                    var optionArray=['58.443|Sodium Chloride(NaCl)','74.551|Potassium Chloride(KCL)','95.211|Magnesium Chloride(MgCl₂)','110.984|Calcium Chloride(CaCI₂)','53.491|Ammonium Chloride(NH₄Cl)','84.995|Sodium Nitrate(NaNO₃)','101.103|Potassium Nitrate(KNO₃)','80.043|Ammonium Nitrate(NH₄NO₃)','182.703|Nikel Nitrate(Ni(NO₃)₂)','169.873|Silver Nitrate(AgNO₃)','100.087|Calcium Carbonate(CaCO₃)','120.368|Magnesium Sulfate(MgSO₄)','136.141|Calcium Sulphate(CaSO₄)','158.034|Potassium Permanganate(KmnO₄)'];
                    document.getElementById("selection2").style.display='block';
                }else if(s1.value=="3"){
                    var optionArray=['36.461|Hydrochloric Acid(HCL)','98.078|Sulphuric Acid(H₂SO₄)','82.079|Sulfurous Acid(H₂SO₃)','34.081|Hydrosulfuric Acid(H₂S)','63.013|Nitric Acid(HNO₃)','47.013|Nitrous Acid(HNO₂)','97.995|Phosphoric Acid(H₃PO₄)','81.996|Phosphorus Acid(H₃PO₃)','80.912|Hydrobromic Acid(HBr)','20.006|Hydrofluoric(HF)','46.025|Formic Acid(HCOOH)','60.052|Acetic Acid(CH₃COOH)'];
                    document.getElementById("selection2").style.display='block';
                }else if(s1.value=="4"){
                    var optionArray=['39.997|Sodium Hydroxide(NaOH)','98.078|Sodium Hydroxide(KOH)','58.32|Magnesium Hydroxide(Mg(OH)₂)','74.093|Calcium Hydroxide(Ca(OH)₂)','78.004|Aliminium Hydroxide(Al(OH)₃)','23.948|Lithium Hydroxide(LiOH)'];
                    document.getElementById("selection2").style.display='block';
                }else if(s1.value=="5"){
                    var optionArray=['16.042|Methane(CH₄)','36.069|Ethane(C₂H₆)','44.096|Propane(C₃H₈)','58.122|Butane(C₄H₁₀)','32.042|CH₃OH','46.068|Methanol(C₂H₅OH)','78.112|Benzene(C₆H₆)','180.156|Glucose(C₆H₁₂O₆)','176.124|Vitamin C(C₆H₈O₆)'];
                    document.getElementById("selection2").style.display='block';
                }else if(s1.value=="6"){
                    var optionArray=['55.845|Iron(Fe)','26.892|Aluminium(Al)','63.456|Copper(Cu)','47.867|Titanium(Ti)','107.868|Silver(Ag)','196.967|Gold(Au)','58.693|Nickel(Ni)','51.996|Chromium(Cr)','58.933|Cobalt(Co)','54.938|Manganese(Mn)','200.59|Mercury(Hg)',
                    '207.2|Lead(Pb)','238.029|Uranium(U)'];
                    document.getElementById("selection2").style.display='block';
                }else if(s1.value=="7"){
                    document.getElementById("selection2").style.display='none';
                }
                for(var option in optionArray){
                    var pair=optionArray[option].split("|");
                    var newoption=document.createElement("option");
                    newoption.value=pair[0];
                    newoption.innerHTML=pair[1];
                    s2.options.add(newoption);
                }

                @if(isset($detail) || isset($error))
                    document.getElementById('chemical_name').value = "{!! request()->chemical_name !!}"
                @endif

                document.getElementById('chemical_selection').addEventListener('change', function(){
                    var s1=this;
                    var s2=document.getElementById('chemical_name');
                    s2.innerHTML="";
    
                    if(s1.value=="1"){
                        var optionArray=['18.015|Water(H₂O)','28.014|Nitrogen(N₂)','31.999|Oxygen(O₂)','2.016|Hydrogen(H₂)','4.003|Helium(He)','44.01|Carbon Dioxide(CO₂)','17.031|Ammonia(NH₃)','34.081|Hydrogen sulfide(H₂S)','119.378|Choloform(CHCL₃)'];
                        document.getElementById("mm").value="18.015";
                        document.getElementById("selection2").style.display='block';
                    }else if(s1.value=="2"){
                        var optionArray=['58.443|Sodium Chloride(NaCl)','74.551|Potassium Chloride(KCL)','95.211|Magnesium Chloride(MgCl₂)','110.984|Calcium Chloride(CaCI₂)','53.491|Ammonium Chloride(NH₄Cl)','84.995|Sodium Nitrate(NaNO₃)','101.103|Potassium Nitrate(KNO₃)','80.043|Ammonium Nitrate(NH₄NO₃)','182.703|Nikel Nitrate(Ni(NO₃)₂)','169.873|Silver Nitrate(AgNO₃)','100.087|Calcium Carbonate(CaCO₃)','120.368|Magnesium Sulfate(MgSO₄)','136.141|Calcium Sulphate(CaSO₄)','158.034|Potassium Permanganate(KmnO₄)'];
                        document.getElementById("mm").value="58.443";
                        document.getElementById("selection2").style.display='block';
                    }else if(s1.value=="3"){
                        var optionArray=['36.461|Hydrochloric Acid(HCL)','98.078|Sulphuric Acid(H₂SO₄)','82.079|Sulfurous Acid(H₂SO₃)','34.081|Hydrosulfuric Acid(H₂S)','63.013|Nitric Acid(HNO₃)','47.013|Nitrous Acid(HNO₂)','97.995|Phosphoric Acid(H₃PO₄)','81.996|Phosphorus Acid(H₃PO₃)','80.912|Hydrobromic Acid(HBr)','20.006|Hydrofluoric(HF)','46.025|Formic Acid(HCOOH)','60.052|Acetic Acid(CH₃COOH)'];
                        document.getElementById("mm").value="36.461";
                        document.getElementById("selection2").style.display='block';
                    }else if(s1.value=="4"){
                        var optionArray=['39.997|Sodium Hydroxide(NaOH)','98.078|Sodium Hydroxide(KOH)','58.32|Magnesium Hydroxide(Mg(OH)₂)','74.093|Calcium Hydroxide(Ca(OH)₂)','78.004|Aliminium Hydroxide(Al(OH)₃)','23.948|Lithium Hydroxide(LiOH)'];
                        document.getElementById("mm").value="39.997";
                        document.getElementById("selection2").style.display='block';
                    }else if(s1.value=="5"){
                        var optionArray=['16.042|Methane(CH₄)','36.069|Ethane(C₂H₆)','44.096|Propane(C₃H₈)','58.122|Butane(C₄H₁₀)','32.042|CH₃OH','46.068|Methanol(C₂H₅OH)','78.112|Benzene(C₆H₆)','180.156|Glucose(C₆H₁₂O₆)','176.124|Vitamin C(C₆H₈O₆)'];
                        document.getElementById("mm").value="16.042";
                        document.getElementById("selection2").style.display='block';
                    }else if(s1.value=="6"){
                        var optionArray=['55.845|Iron(Fe)','26.892|Aluminium(Al)','63.456|Copper(Cu)','47.867|Titanium(Ti)','107.868|Silver(Ag)','196.967|Gold(Au)','58.693|Nickel(Ni)','51.996|Chromium(Cr)','58.933|Cobalt(Co)','54.938|Manganese(Mn)','200.59|Mercury(Hg)',
                        '207.2|Lead(Pb)','238.029|Uranium(U)'];
                        document.getElementById("mm").value="55.845";
                        document.getElementById("selection2").style.display='block';
                    }else if(s1.value=="7"){
                        document.getElementById("selection2").style.display='none';
                        document.getElementById("mm").value="10";
                    }
                    for(var option in optionArray){
                        var pair=optionArray[option].split("|");
                        var newoption=document.createElement("option");
                        newoption.value=pair[0];
                        newoption.innerHTML=pair[1];
                        var val=optionArray[0].split("|");
                        s2.options.add(newoption);
                        var mass=document.getElementById("mm").value=val[0];
                    }
                });
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>