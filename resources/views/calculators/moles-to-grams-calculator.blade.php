<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   

    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4 cont">
                <div class="w-full px-2 mb-2">
                    <p class="font-s-14"><strong class="text-blue">{!! $lang['1'] !!}</strong></p>
                </div>
            </div>
            <div class="grid grid-cols-2 mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4 cont">
                <div class="space-y-2  ">
                    <label for="chemical_selection" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                    <select name="chemical_selection" id="chemical_selection" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['3'],$lang['4']];
                            $val = ["8","9"];
                            optionsList($val,$name,isset(request()->chemical_selection)?request()->chemical_selection:'9');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2  " id="selection2">
                    <label for="chemical_name" class="font-s-14 text-blue">&nbsp;</label>
                    <select name="chemical_name" id="chemical_name" class="input">
                        @php
                            $name = ['Actinium [Ac]','Silver [Ag]','Aluminium [Al]','Americium [Am]','Argon [Ar]','Arsenic [As]','Astatine [At]','Gold [Au]','Boron [B]','Barium[Ba]','Beryllium[Be]','Bohrium [Bh]','Bismuth [Bi]','Berkelium [Bk]','Bromine [Br]','Carbon [C]','Calcium [Ca]','Cadmium [Cd]','Cerium [Ce]','Californium [Cf]','Chlorine [Cl]','Curium [Cm]','Copper [Cu]','Cesium [Cs]','Chromium [Cr]','Cobalt [Co]','Copernicium [Cn]','Dubnium [Db]','Darmstadtium [Ds]','Dysprosium [Dy]','Erbium [Er]','Einsteinium [Es]','Europium [Eu]','Fluorine [F]','Iron [Fe]','Flevorium [Fl]','Fermium [Fe]','Francium[Fr]','Galium [Ga]','Gadollnium [Gd]','Germanium [Ge]','Hydrogen [H]','Helium [He]','Hafnium [Hf]','Mercury [Hg]','Holmium [Ho]','Hassium [Hs]','Iodine [I]','Indium [In]','Iridium [Ir]','Potassium [K]','Krypton [Kr]','Lanthanum [La]','Lithium [Li]','Lawrencium [Lr]','Livermonium','Luetium [Lu]','260|Mendelevium [Md]','Magnesium [Mg]','Manganese [Mn]','Molybdenum [Mo]','Meitnerium [Mt]','Nitrogen [N]','Sodium [Na]','Niobium [Nb]','Neodymium [Nd]','Neon [Ne]','Nickel [Ni]','Nobelium [No]','Neptunium [Np]','Oxygen [O₂]','Osmium [Os]','Phosporus [P]','Protactinium [Pa]','Lead [Pb]','Palladium [Pd]','Promethium [Pm]','Polonium [Po]','Praseodymium [Pr]','Platinum [Pt]','Plutonium [Pu]','Radium [Ra]','Rubidium [Rd]','Rhenium [Re]','Rutherfordium [Rf]','Roentgenium [Rg]','Rhodium [Rh]','Radon [Rn]','Ruthenium [Ru]','Sulfur [S]','Anitomy [Sb]','Scandium [Sc]','Selenium [Se]','Seaborgium [Sb]','Silicon [Si]','Samarium [Sm]','Tin [Sn]','Strontium [Sr]','Terbium [Tb]','Technetium [Te]','Tellurium [Te]','Thorium [Th]','Titanium [Ti]','Thallium [Tl]','Thullium [Tm]','Tantulum [Ta]','Ununoctium [Uuo]','Ununpentium [Uup]','Ununseptium [Uus]','Ununtrium [Uut]','Vanadium [V]','Tungsten [W]','Xenon [Xe]','Yttrium [Y]','Ytterbium [Yb]','Zinc [Zn]','Zirconium [Zr]'];
                            $val=['227','107.868','26.9815','243','39.948','74.9216','210','196.967','10.811','137.327','9.0122','262','208.98','247','79.904','12.0107','40.078','112.411','140.116','251','35.453','247','63.546','132.905','51.9961','58.9332','285','262','281','162.5','167.259','254','151.964','18.9984','55.845','289','257','223','69.723','157.25','72.64','1.0079','4.003','178.49','200.59','164.93','265','126.904','114.813','192.217','39.098','83.798','138.906','6.941','262','293','174.967','260','24.305','54.938','95.94','266','14.0067','22.9898','92.9064','144.24','20.1797','58.6934','259','237','31.999','190.23','30.9738','231.036','207.2','106.42','','210','140.908','195.078','244','226','85.4678','186.207','261','272','102.906','222','101.07','32.065','121.76','44.9559','78.96','266','28.0855','150.36','118.71','87.62','158.925','127.6','127.6','232.038','47.867','204.383','168.934','180.947','294','294','294','284','50.9415','183.84','131.293','88.9059','173.04','65.409','91.224'];
                            optionsList($val,$name,isset(request()->chemical_name)?request()->chemical_name:'227');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-4 gap-4">    
                <div class="space-y-2" id="molar_mass">
                    <label for="mm" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="mm" id="mm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mm'])?$_POST['mm']:'227' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="mm_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mm_unit_dropdown')">{{ isset($_POST['mm_unit'])?$_POST['mm_unit']:'g/mol' }} ▾</label>
                        <input type="text" name="mm_unit" value="{{ isset($_POST['mm_unit'])?$_POST['mm_unit']:'g/mol' }}" id="mm_unit" class="hidden">
                        <div id="mm_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[20%] md:w-[20%] w-[30%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mm_unit', 'g/mol')">g/mol</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mm_unit', 'dag/mol')">dag/mol</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mm_unit', 'kg/mol')">kg/mol</p>
                        </div>
                    </div>
                 </div>
            </div>
            <div class="grid grid-cols-1 mt-4  gap-4">  
                <div class="space-y-2">
                    <p><strong class="text-blue">{{ $lang['6'] }}</strong></p>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-4 lg:grid-cols-2 md:grid-cols-2  gap-4">   
                <div class="space-y-2">
                    <label for="unit" class="font-s-14 text-blue">{!! $lang['7'] !!}:</label>
                    <select name="unit" id="unit" class="input">
                        @php
                            $name = [$lang['8'],$lang['9']."(g)",$lang['5']];
                            $val = ["1","2","3"];
                            optionsList($val,$name,isset(request()->unit)?request()->unit:'2');
                        @endphp
                    </select>
                 </div>
                 <div class="space-y-2" id="mass">
                    <label for="m" class="font-s-14 text-blue">{!! $lang['9'] !!}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="m" id="m" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['m'])?$_POST['m']:'1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="m_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('m_unit_dropdown')">{{ isset($_POST['m_unit'])?$_POST['m_unit']:'ng' }} ▾</label>
                        <input type="text" name="m_unit" value="{{ isset($_POST['m_unit'])?$_POST['m_unit']:'ng' }}" id="m_unit" class="hidden">
                        <div id="m_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[44%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'ng')">nanograms (ng)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'µg')">micrograms (µg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'mg')">milligrams (mg)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'dag')">grams (g)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'dag')">decagrams (dag)</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('m_unit', 'kg')">kilograms (kg)</p>
                        </div>
                    </div>
                 </div>
                 <div class="space-y-2 hidden" id="no_moles">
                    <label for="nm" class="font-s-14 text-blue">{!! $lang['8'] !!}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="nm" id="nm" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['nm'])?$_POST['nm']:'1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="nm_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('nm_unit_dropdown')">{{ isset($_POST['nm_unit'])?$_POST['nm_unit']:'mol' }} ▾</label>
                        <input type="text" name="nm_unit" value="{{ isset($_POST['nm_unit'])?$_POST['nm_unit']:'mol' }}" id="nm_unit" class="hidden">
                        <div id="nm_unit_dropdown" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[46%] md:w-[46%] w-[46%] mt-1 right-0 hidden">
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
                    <div class="w-full  mt-2">
                        @if(isset($detail['ans1']) && isset($detail['ans2']))
                            <p><strong>{!! $lang['8'] !!}</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! ($detail['ans1']) !!} <span class="text-[#119154] text-[20px]">(mol)</span></strong></p>
                            <p><strong>{!! $lang['10'] !!} / {!! $lang['11'] !!}</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! ($detail['ans2']) !!}</strong></p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['12'] !!}:</strong></p>
                            <p class="my-2">{!! $lang['5'] !!} = {!! $detail['ans91']  !!} g / mol <br>{!! $lang['9'] !!}  = {!! $detail['ans90']  !!} g <br>{!! $lang['8'] !!}  = ? <br> {!! $lang['10'] !!} / {!! $lang['11'] !!} = ?</p>
                            <p class="my-2"><strong>{!! $lang['13'] !!}</strong></p>
                            <p class="my-2">{!! $lang['8'] !!} = {!! $lang['9'] !!}  / {!! $lang['5'] !!}</p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!} = {!! $lang['8'] !!} * 6.02214085774</p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['14'] !!}: </strong>{!! $lang['15'] !!}</p>
                            <p class="my-2">{!! $lang['8'] !!} = {!! $detail['ans90']  !!} / {!! $detail['ans91']  !!}</p>
                            <p class="my-2"> {!! $lang['8'] !!} = {!! $detail['ans1']  !!}</p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!} = {!! $detail['ans1']  !!}  * 6.02214085774  </p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!} = {!! $detail['ans2']  !!}</p>
                        @endif
                        @if(isset($detail['ans3']) && isset($detail['ans4']))
                            <p><strong>{!! $lang['9'] !!}</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! ($detail['ans3']) !!} <span class="text-[#119154] text-[20px]">(g)</span></strong></p>
                            <p><strong>{!! $lang['10'] !!} / {!! $lang['11'] !!}</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! ($detail['ans4']) !!}</strong></p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['12'] !!}:</strong></p>
                            <p class="my-2">{!! $lang['5'] !!} ={!! $detail['ans90']  !!} (g/mol)
                            <br> {!! $lang['8'] !!} = {!! $detail['ans91']  !!} (mol) <br>{!! $lang['9'] !!} = ? <br>{!! $lang['10'] !!} / {!! $lang['11'] !!} = ?</p>
                            <p class="my-2">{!! $lang['13'] !!}</p>
                            <p class="my-2">{!! $lang['9'] !!} = {!! $lang['8'] !!} * {!! $lang['5'] !!}</p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!} = </strong>{!! $lang['8'] !!} * 6.02214085774</p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['14'] !!}: </strong>{!! $lang['15'] !!}</p>
                            <p class="my-2">{!! $lang['9'] !!} ={!! $detail['ans90']  !!} * {!! $detail['ans91']  !!}</p>
                            <p class="my-2"> {!! $lang['9'] !!} = {!! $detail['ans3']  !!} (g)</p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!} = {!! $detail['ans91']  !!}  * 6.02214085774</p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!} = {!! $detail['ans4']  !!}</p>
                        @endif
                        @if(isset($detail['ans5']) && isset($detail['ans6']))
                            <p><strong>{!! $lang['5'] !!}</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! ($detail['ans5']) !!} <span class="text-[#119154] text-[20px]">(g/mol)</span></strong></p>
                            <p><strong>{!! $lang['10'] !!}/{!! $lang['11'] !!}</strong></p>
                            <p><strong class="text-[#119154] text-[28px]">{!! ($detail['ans6']) !!}</strong></p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['12'] !!}:</strong></p>
                            <p class="my-2">{!! $lang['9'] !!} = {!! $detail['ans90']  !!} g <br> {!! $lang['8'] !!}={!! $detail['ans91']  !!} mol <br>{!! $lang['5'] !!} = ? <br>{!! $lang['10'] !!} / {!! $lang['11'] !!} = ? </p>
                            <p class="my-2">{!! $lang['13'] !!}</p>
                            <p class="my-2"> {!! $lang['5'] !!} =  {!! $lang['9'] !!} / {!! $lang['8'] !!}</p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!}= {!! $lang['8'] !!} * 6.02214085774</p>
                            <p class="mt-3 mb-2"><strong>{!! $lang['14'] !!}: </strong>{!! $lang['15'] !!}</p>
                            <p class="my-2">{!! $lang['5'] !!}  ={!! $detail['ans90']  !!} / {!! $detail['ans91']  !!}</p>
                            <p class="my-2">{!! $lang['5'] !!}  ={!! $detail['ans5']  !!} (g/mol)</p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!} = {!!  $detail['ans91']  !!}  * 6.02214085774 </p>
                            <p class="my-2">{!! $lang['10'] !!} / {!! $lang['11'] !!} = {!! $detail['ans6']  !!}</p>
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
                var val = document.querySelector('#unit').value;
                if (val === "1") {
                    showElements(['molar_mass', 'mass']);
                    hideElements(['no_moles']);
                    showElementsByClass('cont');
                } else if (val === "2") {
                    showElements(['no_moles', 'molar_mass']);
                    hideElements(['mass']);
                    showElementsByClass('cont');
                } else if (val === "3") {
                    showElements(['mass', 'no_moles']);
                    hideElements(['molar_mass']);
                    hideElementsByClass('cont');
                }
                document.querySelector('#unit').addEventListener('change', function() {
                    var val = this.value;
                    if (val === "1") {
                        showElements(['molar_mass', 'mass']);
                        hideElements(['no_moles']);
                        showElementsByClass('cont');
                    } else if (val === "2") {
                        showElements(['no_moles', 'molar_mass']);
                        hideElements(['mass']);
                        showElementsByClass('cont');
                    } else if (val === "3") {
                        showElements(['mass', 'no_moles']);
                        hideElements(['molar_mass']);
                        hideElementsByClass('cont');
                    }
                });

                function showElements(ids) {
                    ids.forEach(function(id) {
                        document.querySelector('#' + id).style.display = 'block';
                    });
                }

                function hideElements(ids) {
                    ids.forEach(function(id) {
                        document.querySelector('#' + id).style.display = 'none';
                    });
                }

                function showElementsByClass(className) {
                    var elements = document.querySelectorAll('.' + className);
                    elements.forEach(function(element) {
                        element.style.display = 'block';
                    });
                }

                function hideElementsByClass(className) {
                    var elements = document.querySelectorAll('.' + className);
                    elements.forEach(function(element) {
                        element.style.display = 'none';
                    });
                }

                document.querySelector('#chemical_name').addEventListener('change', function() {
                    var v2 = this.value;
                    document.querySelector('#mm').value = v2;
                });

                document.querySelector('#chemical_selection').addEventListener('change', function() {
                    var a = this.value;
                    if (a === "8") {
                        document.querySelector('#mm').value = "44.0526";
                    } else if (a === "9") {
                        document.querySelector('#mm').value = "227";
                    }
                });

                var s1=document.getElementById('chemical_selection');
                var s2=document.getElementById('chemical_name');

                s2.innerHTML="";
                if(s1.value=="8"){
                    var optionArray=['44.0526|Acetaldehyde [C₂H₄O]','59.0672|Acetamide [C₂H₅NO]','60.052|Acetic acid [CH₃COOH]','58.0791|Acetone [C₃H₆O]','41.0519|Acetonitrile [C₂H₃N]','133.341|Aluminium chloride [AlCl₃]','212.996|Aluminium nitrate [Al(NO₃)₃]','342.151|Aluminium sulfate [Al₂(SO₄)₃]','17.0305|Ammonia[NH₃]','77.0825|Ammonium acetate [CH₃COONH₄]','96.0858|Ammonium carbonate [(NH₄)₂CO₃]','53.4915|Ammonium chloride [NH₄Cl]','252.065|Ammonium dichromate [(NH₄)₂Cr₂O₇]','35.0458|Ammonium hydroxide [NH₄OH]','80.0434|Ammonium nitrate [NH₄NO₃]','124.096|Ammonium oxalate [(NH₄)₂C₂O₄]','132.14|Ammonium sulfate [(NH₄)₂SO₄]','208.233|Barium chloride [BaCl₂]','171.342|Barium hydroxide [Ba(OH)₂]','261.337|Barium nitrate [Ba(NO₃)₂]','78.1118|Benzene [C₆H₆]','58.1222|Butane [C₄H₁₀]','110.984| Calcium chloride [CaCl₂]','74.0927|Calcium hydroxide [Ca(OH)₂]','164.088|Calcium nitrate [Ca(NO₃)₂] ','136.141|Calcium sulfate [CaSO₄]','44.0095|Carbon dioxide [CO₂]','76.1407|Carbon disulfide [CS₂]','94.497|Chloroacetic acid [C₂H₃ClO₂]','339.786|Chloroauric acid [HAuCl₄]','119.378|Chloroform [CHCl₃]','409.812|Chloroplatinic acid [H₂PtCl₆]','192.124|Citric acid [C₆H₈O₇]','128.942|Dichloroacetic acid [C₂H₂Cl₂O₂]','74.1216|Diethyl ether [(C₂H₅)₂O]','116.119|Dimethylglyoxime [(CH₃CNOH)₂]','336.206|EDTA, disodium salt [Na₂C₁₀H₁₄N₂O₈]','30.069|Ethane [C₂H₆]','46.0684|Ethanol [C₂H₅OH]','62.0678|Ethylene glycol [(CH₂OH)₂] ','30.026|Formaldehyde [CH₂O]','46.0254|Formic acid [CH₂O₂]','180.156|Fructose [C₆H₁₂O₆]','180.156|Glucose [C₆H₁₂O₆]','92.0938|Glycerol [C₃H₈O₃]','144.092|Hexafluorosilicic acid [H₂SiF₆]','32.0452|Hydrazine [N₂H₄]','80.9119|Hydrobromic acid [HBr]','36.4609|Hydrochloric acid [HCl]','27.0253|Hydrocyanic acid [HCN]','20.0063|Hydrofluoric acid [HF]','2.0159|Hydrogen [H₂]','34.0147|Hydrogen peroxide [H₂O₂]','34.0809|Hydrogen sulfide [H₂S]','127.912|Hydroiodic acid [HI]','175.911|Iodic acid [HIO₃]','74.1216|Isobutanol [C₄H₁₀O]','90.0779|Lactic acid [C₃H₆O₃]','342.296|Lactose [C₁₂H₂₂O₁₁]','42.394|Lithium chloride [LiCl]','95.211|Magnesium chloride [MgCl₂]','148.315|Magnesium nitrate [Mg(NO₃)₂]','120.368|Magnesium sulfate [MgSO₄]','116.072|Maleic acid [C₄H₄O₄]','104.061|Malonic acid [C₃H₄O₄]','342.296|Maltose [C₁₂H₂₂O₁₁]','182.172|Mannitol [C₆H₁₄O₆]','16.0425|Methane [CH₄]','32.0419|Methanol [CH₃OH]','74.0785|Methyl acetate [C₃H₆O₂]','129.599|Nickel chloride [NiCl₂]','182.703|Nickel nitrate [Ni(NO₃)₂]','154.756|Nickel sulfate [NiSO₄]','162.232|Nicotine [C₁₀H₁₄N₂]','63.0128|Nitric acid [HNO₃]','28.0134|Nitrogen [N₂]','31.9988|Oxygen [O₂]','90.0349|Oxalic acid [H₂C₂O₄]','97.9952|Phosphoric acid [H₃PO₄]','100.115|Potassium bicarbonate [KHCO₃]','167|Potassium bromate [KBrO₃]','119.002|Potassium bromide [KBr]','138.205|Potassium carbonate [K₂CO₃]','74.551|Potassium chloride [KCl]','194.19|Potassium chromate [K₂CrO₄]','65.1154|Potassium cyanide [KCN]','294.184|Potassium dichromate [K₂Cr₂O₇]','174.175|Potassium hydrogen phosphate [K₂HPO₄]','56.1053|Potassium hydroxide [KOH]','214.001|Potassium iodate [KIO₃]','166.002|Potassium iodide [KI]','101.103|Potassium nitrate [KNO₃]','85.1035|Potassium nitrite [KNO₂]','158.034|Potassium permanganate [KMnO₄]','174.259|Potassium sulfate [K₂SO₄]','158.259|Potassium sulfite [K₂SO₃]','226.267|Potassium tartrate [K₂C₄H₄O₆]','97.1804|Potassium thiocyanate [KCNS]','44.0956|Propane [C₃H₈]','79.0999|Pyridine [C₅H₅N] ','110.111|Resorcinol [C₆H₆O₂]','342.296|Saccharose [C₁₂H₂₂O₁₁]','169.873|Silver nitrate [AgNO₃] ','311.799|Silver sulfate [Ag₂SO₄]','82.0338|Sodium acetate [NaC₂H₃O₂]','207.889|Sodium arsenate [Na₃AsO₄] ','102.894|Sodium bromide [NaBr]','105.988|Sodium carbonate [Na₂CO₃]','106.441|Sodium chlorate [NaClO₃]','58.4428|Sodium chloride [NaCl]','161.973|Sodium chromate [Na₂CrO₄]','258.069|Sodium citrate [Na₃C₆H₅O₇]','261.968|Sodium dichromate [Na₂Cr₂O₇]','119.977|Sodium dihydrogen phosphate [NaH₂PO₄]','68.0072|Sodium formate [HCOONa]','84.0066|Sodium hydrogen carbonate [NaHCO₃]','141.959|Sodium hydrogen phosphate [Na₂HPO₄]','172.069|Sodium hydrogen tartrate [NaHC₄H₄O₆]','39.9971|Sodium hydroxide [NaOH]','84.9947|Sodium nitrate [NaNO₃]','68.9953|Sodium nitrite [NaNO₂]','163.941|Sodium phosphate [Na₃PO₄]','210.159|Sodium potassium tartrate [NaKC₄H₄O₆]','142.042|Sodium sulfate [Na₂SO₄]','78.0445|Sodium sulfide [Na₂S]','126.043|Sodium sulfite [Na₂SO₃]','194.051|Sodium tartrate [Na₂C₄H₄O₆]','158.108|Sodium thiosulfate [Na₂S₂O₃]','158.526|Strontium chloride [SrCl₂]','211.63|Strontium nitrate [Sr(NO₃)₂]','98.0785|Sulfuric acid [H₂SO₄]','82.0791|Sulfurous acid [H₂SO₃]','150.087|Tartaric acid [H₂C₄H₄O₆]','76.1209|Thiourea [CH₄N₂S]','163.387|Trichloroacetic acid [CCl₃COOH]','89.0932|Urethane [C₃H₇NO₂]','176.124|Vitamin C [C₆H₈O₆]','18.0153|Water [H₂O]','225.217|Zinc bromide [ZnBr₂]','136.315|Zinc chloride [ZnCl₂]','189.419|Zinc nitrate [Zn(NO₃)₂]','161.472|Zinc sulfate [ZnSO₄]','161.443|Zinc Oxide [SO₄]','132.056|Di-Ammonium Phosphate [(NH4)3PO4]','74.122|Ether [(C2H5)2O]','60.084|Quartz [SiO2]','32.117|Silane[SiH4]','210.228|Benzil [C14H10O2]','76.012|Dinitrogen Trioxide [N2O3]','69.62|Boron Oxide [B2O3]','63.126|Pentaborane [B5H9]','261.337|Barium Nitrate [Ba(NO3)2]','63.126| Barium Hydroxide [Ba(OH)2]','208.233|Barium Chloride [BaCl2]','197.336|Barium Carbonate [BaCO3]','300.051|Diamminedichloroplatinum [Pt(NH3)2Cl2]','194.704|Stannic Fluoride [SnF4]','294.303|Aspartame [C14H18N2O5]','206.281|Ibuprofen [C13H18O2]','181.281|Arsenic Trichloride [AsCl3]','162.232|Nicotine [C₁₀H₁₄N₂]','150.218|Carvone [C10H14O]','165.232|Ephedrine [C10H15NO]','128.171|Naphthalene [C10H8]','386.654|Cholestrol [C27H46O]','44.053|Ethylene Oxide [C2H4O]','62.068|Ethylene Glycol [C2H6O2]','104.149|Styrene [C8H8]','98.916|Phosgene [COCl2]','283.794|Ethyl 1-methyl-4-phenylpiperidine-4-carboxylate [C15H22ClNO2]','58.079|Propionaldehyde [C3H6O]','79.918|Beryllium Chloride [BeCl2]','262.821|Beryllium Iodide [BeI2]','72.106|Tetrahydrofuran [C4H8O]','311.799|Ribose [C5H10O5]','228.119|Antimony Tricloride [SbCl3]','102.475|Rubidium Hydroxide [RbOH]','108.059|Sulfur Tetrafluoride [SF4]','146.055|Sulfur Hexafluoride [SF6]','123.109|Vitamin B3 [C6H5NO2]','58.079|Propionaldehyde [C3H6O]','102.089|Acetic Anhydride [C4H6O3]','147.002|P-Dichlorobenzene [C6H4Cl2]','157.008|Bromobenzene [C6H5Br]','96.063|Sulfate Ion [SO4]','106.122|Benzaldehyde [C7H6O]'];
                    document.getElementById("selection2").style.display='block';
                }else if(s1.value=="9"){
                    var optionArray=['227|Actinium [Ac]','107.868|Silver [Ag]','26.9815|Aluminium [Al]','243|Americium [Am]','39.948|Argon [Ar]','74.9216|Arsenic [As]','210|Astatine [At]','196.967|Gold [Au]','10.811|Boron [B]','137.327|Barium[Ba]','9.0122|Beryllium[Be]','262|Bohrium [Bh]','208.98|Bismuth [Bi]','247|Berkelium [Bk]','79.904|Bromine [Br]','12.0107|Carbon [C]','40.078|Calcium [Ca]','112.411|Cadmium [Cd]','140.116|Cerium [Ce]','251|Californium [Cf]','35.453|Chlorine [Cl]','247|Curium [Cm]','63.546|Copper [Cu]','132.905|Cesium [Cs]','51.9961|Chromium [Cr]','58.9332|Cobalt [Co]','285|Copernicium [Cn]','262|Dubnium [Db]','281|Darmstadtium [Ds]','162.5|Dysprosium [Dy]','167.259|Erbium [Er]','254|Einsteinium [Es]','151.964|Europium [Eu]','18.9984|Fluorine [F]','55.845|Iron [Fe]','289|Flevorium [Fl]','257|Fermium [Fe]','223|Francium[Fr]','69.723|Galium [Ga]','157.25|Gadollnium [Gd]','72.64|Germanium [Ge]','1.0079|Hydrogen [H]','4.003|Helium [He]','178.49|Hafnium [Hf]','200.59|Mercury [Hg]','164.93|Holmium [Ho]','265|Hassium [Hs]','126.904|Iodine [I]','114.813|Indium [In]','192.217|Iridium [Ir]','39.098|Potassium [K]','83.798|Krypton [Kr]','138.906|Lanthanum [La]','6.941|Lithium [Li]','262|Lawrencium [Lr]','293|Livermonium','174.967|Luetium [Lu]','260|Mendelevium [Md]','24.305|Magnesium [Mg]','54.938|Manganese [Mn]','95.94|Molybdenum [Mo]','266|Meitnerium [Mt]','14.0067|Nitrogen [N]','22.9898|Sodium [Na]','92.9064|Niobium [Nb]','144.24|Neodymium [Nd]','20.1797|Neon [Ne]','58.6934|Nickel [Ni]','259|Nobelium [No]','237|Neptunium [Np]','31.999|Oxygen [O₂]','190.23|Osmium [Os]','30.9738|Phosporus [P]','231.036|Protactinium [Pa]','207.2|Lead [Pb]','106.42|Palladium [Pd]','|Promethium [Pm]','210|Polonium [Po]','140.908|Praseodymium [Pr]','195.078|Platinum [Pt]','244|Plutonium [Pu]','226|Radium [Ra]','85.4678|Rubidium [Rd]','186.207|Rhenium [Re]','261|Rutherfordium [Rf]','272|Roentgenium [Rg]','102.906|Rhodium [Rh]','222|Radon [Rn]','101.07|Ruthenium [Ru]','32.065|Sulfur [S]','121.76|Anitomy [Sb]','44.9559|Scandium [Sc]','78.96|Selenium [Se]','266|Seaborgium [Sb]','28.0855|Silicon [Si]','150.36|Samarium [Sm]','118.71|Tin [Sn]','87.62|Strontium [Sr]','158.925|Terbium [Tb]','127.6|Technetium [Te]','127.6|Tellurium [Te]','232.038|Thorium [Th]','47.867|Titanium [Ti]','204.383|Thallium [Tl]','168.934|Thullium [Tm]','180.947|Tantulum [Ta]','294|Ununoctium [Uuo]','294|Ununpentium [Uup]','294|Ununseptium [Uus]','284|Ununtrium [Uut]','50.9415|Vanadium [V]','183.84|Tungsten [W]','131.293|Xenon [Xe]','88.9059|Yttrium [Y]','173.04|Ytterbium [Yb]','65.409|Zinc [Zn]','91.224|Zirconium [Zr]'];
                    document.getElementById("selection2").style.display='block';
                }
                for(var option in optionArray){
                    var pair=optionArray[option].split("|");
                    var newoption=document.createElement("option");
                    newoption.value=pair[0];
                    newoption.innerHTML=pair[1];
                    var val=optionArray[0].split("|");
                    s2.options.add(newoption);
                }

                @if(isset($detail) || isset($error))
                    document.getElementById('chemical_name').value = "{!! request()->chemical_name !!}"
                @endif

                document.getElementById('chemical_selection').addEventListener('change', function(){
                    var s1=this;
                    var s2=document.getElementById('chemical_name');

                    s2.innerHTML="";
                    if(s1.value=="8"){
                        var optionArray=['44.0526|Acetaldehyde [C₂H₄O]','59.0672|Acetamide [C₂H₅NO]','60.052|Acetic acid [CH₃COOH]','58.0791|Acetone [C₃H₆O]','41.0519|Acetonitrile [C₂H₃N]','133.341|Aluminium chloride [AlCl₃]','212.996|Aluminium nitrate [Al(NO₃)₃]','342.151|Aluminium sulfate [Al₂(SO₄)₃]','17.0305|Ammonia[NH₃]','77.0825|Ammonium acetate [CH₃COONH₄]','96.0858|Ammonium carbonate [(NH₄)₂CO₃]','53.4915|Ammonium chloride [NH₄Cl]','252.065|Ammonium dichromate [(NH₄)₂Cr₂O₇]','35.0458|Ammonium hydroxide [NH₄OH]','80.0434|Ammonium nitrate [NH₄NO₃]','124.096|Ammonium oxalate [(NH₄)₂C₂O₄]','132.14|Ammonium sulfate [(NH₄)₂SO₄]','208.233|Barium chloride [BaCl₂]','171.342|Barium hydroxide [Ba(OH)₂]','261.337|Barium nitrate [Ba(NO₃)₂]','78.1118|Benzene [C₆H₆]','58.1222|Butane [C₄H₁₀]','110.984| Calcium chloride [CaCl₂]','74.0927|Calcium hydroxide [Ca(OH)₂]','164.088|Calcium nitrate [Ca(NO₃)₂] ','136.141|Calcium sulfate [CaSO₄]','44.0095|Carbon dioxide [CO₂]','76.1407|Carbon disulfide [CS₂]','94.497|Chloroacetic acid [C₂H₃ClO₂]','339.786|Chloroauric acid [HAuCl₄]','119.378|Chloroform [CHCl₃]','409.812|Chloroplatinic acid [H₂PtCl₆]','192.124|Citric acid [C₆H₈O₇]','128.942|Dichloroacetic acid [C₂H₂Cl₂O₂]','74.1216|Diethyl ether [(C₂H₅)₂O]','116.119|Dimethylglyoxime [(CH₃CNOH)₂]','336.206|EDTA, disodium salt [Na₂C₁₀H₁₄N₂O₈]','30.069|Ethane [C₂H₆]','46.0684|Ethanol [C₂H₅OH]','62.0678|Ethylene glycol [(CH₂OH)₂] ','30.026|Formaldehyde [CH₂O]','46.0254|Formic acid [CH₂O₂]','180.156|Fructose [C₆H₁₂O₆]','180.156|Glucose [C₆H₁₂O₆]','92.0938|Glycerol [C₃H₈O₃]','144.092|Hexafluorosilicic acid [H₂SiF₆]','32.0452|Hydrazine [N₂H₄]','80.9119|Hydrobromic acid [HBr]','36.4609|Hydrochloric acid [HCl]','27.0253|Hydrocyanic acid [HCN]','20.0063|Hydrofluoric acid [HF]','2.0159|Hydrogen [H₂]','34.0147|Hydrogen peroxide [H₂O₂]','34.0809|Hydrogen sulfide [H₂S]','127.912|Hydroiodic acid [HI]','175.911|Iodic acid [HIO₃]','74.1216|Isobutanol [C₄H₁₀O]','90.0779|Lactic acid [C₃H₆O₃]','342.296|Lactose [C₁₂H₂₂O₁₁]','42.394|Lithium chloride [LiCl]','95.211|Magnesium chloride [MgCl₂]','148.315|Magnesium nitrate [Mg(NO₃)₂]','120.368|Magnesium sulfate [MgSO₄]','116.072|Maleic acid [C₄H₄O₄]','104.061|Malonic acid [C₃H₄O₄]','342.296|Maltose [C₁₂H₂₂O₁₁]','182.172|Mannitol [C₆H₁₄O₆]','16.0425|Methane [CH₄]','32.0419|Methanol [CH₃OH]','74.0785|Methyl acetate [C₃H₆O₂]','129.599|Nickel chloride [NiCl₂]','182.703|Nickel nitrate [Ni(NO₃)₂]','154.756|Nickel sulfate [NiSO₄]','162.232|Nicotine [C₁₀H₁₄N₂]','63.0128|Nitric acid [HNO₃]','28.0134|Nitrogen [N₂]','31.9988|Oxygen [O₂]','90.0349|Oxalic acid [H₂C₂O₄]','97.9952|Phosphoric acid [H₃PO₄]','100.115|Potassium bicarbonate [KHCO₃]','167|Potassium bromate [KBrO₃]','119.002|Potassium bromide [KBr]','138.205|Potassium carbonate [K₂CO₃]','74.551|Potassium chloride [KCl]','194.19|Potassium chromate [K₂CrO₄]','65.1154|Potassium cyanide [KCN]','294.184|Potassium dichromate [K₂Cr₂O₇]','174.175|Potassium hydrogen phosphate [K₂HPO₄]','56.1053|Potassium hydroxide [KOH]','214.001|Potassium iodate [KIO₃]','166.002|Potassium iodide [KI]','101.103|Potassium nitrate [KNO₃]','85.1035|Potassium nitrite [KNO₂]','158.034|Potassium permanganate [KMnO₄]','174.259|Potassium sulfate [K₂SO₄]','158.259|Potassium sulfite [K₂SO₃]','226.267|Potassium tartrate [K₂C₄H₄O₆]','97.1804|Potassium thiocyanate [KCNS]','44.0956|Propane [C₃H₈]','79.0999|Pyridine [C₅H₅N] ','110.111|Resorcinol [C₆H₆O₂]','342.296|Saccharose [C₁₂H₂₂O₁₁]','169.873|Silver nitrate [AgNO₃] ','311.799|Silver sulfate [Ag₂SO₄]','82.0338|Sodium acetate [NaC₂H₃O₂]','207.889|Sodium arsenate [Na₃AsO₄] ','102.894|Sodium bromide [NaBr]','105.988|Sodium carbonate [Na₂CO₃]','106.441|Sodium chlorate [NaClO₃]','58.4428|Sodium chloride [NaCl]','161.973|Sodium chromate [Na₂CrO₄]','258.069|Sodium citrate [Na₃C₆H₅O₇]','261.968|Sodium dichromate [Na₂Cr₂O₇]','119.977|Sodium dihydrogen phosphate [NaH₂PO₄]','68.0072|Sodium formate [HCOONa]','84.0066|Sodium hydrogen carbonate [NaHCO₃]','141.959|Sodium hydrogen phosphate [Na₂HPO₄]','172.069|Sodium hydrogen tartrate [NaHC₄H₄O₆]','39.9971|Sodium hydroxide [NaOH]','84.9947|Sodium nitrate [NaNO₃]','68.9953|Sodium nitrite [NaNO₂]','163.941|Sodium phosphate [Na₃PO₄]','210.159|Sodium potassium tartrate [NaKC₄H₄O₆]','142.042|Sodium sulfate [Na₂SO₄]','78.0445|Sodium sulfide [Na₂S]','126.043|Sodium sulfite [Na₂SO₃]','194.051|Sodium tartrate [Na₂C₄H₄O₆]','158.108|Sodium thiosulfate [Na₂S₂O₃]','158.526|Strontium chloride [SrCl₂]','211.63|Strontium nitrate [Sr(NO₃)₂]','98.0785|Sulfuric acid [H₂SO₄]','82.0791|Sulfurous acid [H₂SO₃]','150.087|Tartaric acid [H₂C₄H₄O₆]','76.1209|Thiourea [CH₄N₂S]','163.387|Trichloroacetic acid [CCl₃COOH]','89.0932|Urethane [C₃H₇NO₂]','176.124|Vitamin C [C₆H₈O₆]','18.0153|Water [H₂O]','225.217|Zinc bromide [ZnBr₂]','136.315|Zinc chloride [ZnCl₂]','189.419|Zinc nitrate [Zn(NO₃)₂]','161.472|Zinc sulfate [ZnSO₄]','161.443|Zinc Oxide [SO₄]','132.056|Di-Ammonium Phosphate [(NH4)3PO4]','74.122|Ether [(C2H5)2O]','60.084|Quartz [SiO2]','32.117|Silane[SiH4]','210.228|Benzil [C14H10O2]','76.012|Dinitrogen Trioxide [N2O3]','69.62|Boron Oxide [B2O3]','63.126|Pentaborane [B5H9]','261.337|Barium Nitrate [Ba(NO3)2]','63.126| Barium Hydroxide [Ba(OH)2]','208.233|Barium Chloride [BaCl2]','197.336|Barium Carbonate [BaCO3]','300.051|Diamminedichloroplatinum [Pt(NH3)2Cl2]','194.704|Stannic Fluoride [SnF4]','294.303|Aspartame [C14H18N2O5]','206.281|Ibuprofen [C13H18O2]','181.281|Arsenic Trichloride [AsCl3]','162.232|Nicotine [C₁₀H₁₄N₂]','150.218|Carvone [C10H14O]','165.232|Ephedrine [C10H15NO]','128.171|Naphthalene [C10H8]','386.654|Cholestrol [C27H46O]','44.053|Ethylene Oxide [C2H4O]','62.068|Ethylene Glycol [C2H6O2]','104.149|Styrene [C8H8]','98.916|Phosgene [COCl2]','283.794|Ethyl 1-methyl-4-phenylpiperidine-4-carboxylate [C15H22ClNO2]','58.079|Propionaldehyde [C3H6O]','79.918|Beryllium Chloride [BeCl2]','262.821|Beryllium Iodide [BeI2]','72.106|Tetrahydrofuran [C4H8O]','311.799|Ribose [C5H10O5]','228.119|Antimony Tricloride [SbCl3]','102.475|Rubidium Hydroxide [RbOH]','108.059|Sulfur Tetrafluoride [SF4]','146.055|Sulfur Hexafluoride [SF6]','123.109|Vitamin B3 [C6H5NO2]','58.079|Propionaldehyde [C3H6O]','102.089|Acetic Anhydride [C4H6O3]','147.002|P-Dichlorobenzene [C6H4Cl2]','157.008|Bromobenzene [C6H5Br]','96.063|Sulfate Ion [SO4]','106.122|Benzaldehyde [C7H6O]'];
                        document.getElementById("mm").value="44.0526";
                        document.getElementById("selection2").style.display='block';
                    }else if(s1.value=="9"){
                        var optionArray=['227|Actinium [Ac]','107.868|Silver [Ag]','26.9815|Aluminium [Al]','243|Americium [Am]','39.948|Argon [Ar]','74.9216|Arsenic [As]','210|Astatine [At]','196.967|Gold [Au]','10.811|Boron [B]','137.327|Barium[Ba]','9.0122|Beryllium[Be]','262|Bohrium [Bh]','208.98|Bismuth [Bi]','247|Berkelium [Bk]','79.904|Bromine [Br]','12.0107|Carbon [C]','40.078|Calcium [Ca]','112.411|Cadmium [Cd]','140.116|Cerium [Ce]','251|Californium [Cf]','35.453|Chlorine [Cl]','247|Curium [Cm]','63.546|Copper [Cu]','132.905|Cesium [Cs]','51.9961|Chromium [Cr]','58.9332|Cobalt [Co]','285|Copernicium [Cn]','262|Dubnium [Db]','281|Darmstadtium [Ds]','162.5|Dysprosium [Dy]','167.259|Erbium [Er]','254|Einsteinium [Es]','151.964|Europium [Eu]','18.9984|Fluorine [F]','55.845|Iron [Fe]','289|Flevorium [Fl]','257|Fermium [Fe]','223|Francium[Fr]','69.723|Galium [Ga]','157.25|Gadollnium [Gd]','72.64|Germanium [Ge]','1.0079|Hydrogen [H]','4.003|Helium [He]','178.49|Hafnium [Hf]','200.59|Mercury [Hg]','164.93|Holmium [Ho]','265|Hassium [Hs]','126.904|Iodine [I]','114.813|Indium [In]','192.217|Iridium [Ir]','39.098|Potassium [K]','83.798|Krypton [Kr]','138.906|Lanthanum [La]','6.941|Lithium [Li]','262|Lawrencium [Lr]','293|Livermonium','174.967|Luetium [Lu]','260|Mendelevium [Md]','24.305|Magnesium [Mg]','54.938|Manganese [Mn]','95.94|Molybdenum [Mo]','266|Meitnerium [Mt]','14.0067|Nitrogen [N]','22.9898|Sodium [Na]','92.9064|Niobium [Nb]','144.24|Neodymium [Nd]','20.1797|Neon [Ne]','58.6934|Nickel [Ni]','259|Nobelium [No]','237|Neptunium [Np]','31.999|Oxygen [O₂]','190.23|Osmium [Os]','30.9738|Phosporus [P]','231.036|Protactinium [Pa]','207.2|Lead [Pb]','106.42|Palladium [Pd]','|Promethium [Pm]','210|Polonium [Po]','140.908|Praseodymium [Pr]','195.078|Platinum [Pt]','244|Plutonium [Pu]','226|Radium [Ra]','85.4678|Rubidium [Rd]','186.207|Rhenium [Re]','261|Rutherfordium [Rf]','272|Roentgenium [Rg]','102.906|Rhodium [Rh]','222|Radon [Rn]','101.07|Ruthenium [Ru]','32.065|Sulfur [S]','121.76|Anitomy [Sb]','44.9559|Scandium [Sc]','78.96|Selenium [Se]','266|Seaborgium [Sb]','28.0855|Silicon [Si]','150.36|Samarium [Sm]','118.71|Tin [Sn]','87.62|Strontium [Sr]','158.925|Terbium [Tb]','127.6|Technetium [Te]','127.6|Tellurium [Te]','232.038|Thorium [Th]','47.867|Titanium [Ti]','204.383|Thallium [Tl]','168.934|Thullium [Tm]','180.947|Tantulum [Ta]','294|Ununoctium [Uuo]','294|Ununpentium [Uup]','294|Ununseptium [Uus]','284|Ununtrium [Uut]','50.9415|Vanadium [V]','183.84|Tungsten [W]','131.293|Xenon [Xe]','88.9059|Yttrium [Y]','173.04|Ytterbium [Yb]','65.409|Zinc [Zn]','91.224|Zirconium [Zr]'];
                        document.getElementById("mm").value='227';
                        document.getElementById("selection2").style.display='block';
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