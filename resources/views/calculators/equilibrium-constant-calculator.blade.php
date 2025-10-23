<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
                @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
               @endif
               <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
                    <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2 relative">
                            <label for="selection" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                            <select name="selection" id="selection" class="input">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                        {!! $arr2[$index] !!}
                                    </option>
                                @php
                                    }}
                                    $name = [$lang['2'],$lang['3']];
                                    $val = ["1","2"];
                                    optionsList($val,$name,isset(request()->selection)?request()->selection:'1');
                                @endphp
                            </select>
                        </div>
                        <div class="space-y-2 concentration1">
                            <label for="concentration_one" class="font-s-14 text-blue">{{ $lang['2'] }} [A]:</label>
                            <div class="relative w-full ">
                                <input type="number" name="concentration_one" id="concentration_one" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['concentration_one'])?$_POST['concentration_one']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="concentration_one_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('concentration_one_unit_dropdown')">{{ isset($_POST['concentration_one_unit'])?$_POST['concentration_one_unit']:'M' }} ▾</label>
                                <input type="text" name="concentration_one_unit" value="{{ isset($_POST['concentration_one_unit'])?$_POST['concentration_one_unit']:'M' }}" id="concentration_one_unit" class="hidden">
                                <div id="concentration_one_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="concentration_one_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_one_unit', 'M')">M</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_one_unit', 'mM')">mM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_one_unit', 'μM')">μM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_one_unit', 'nM')">nM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_one_unit', 'pM')">pM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_one_unit', 'fM')">fM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_one_unit', 'aM')">aM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_one_unit', 'zM')">zM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_one_unit', 'yM')">yM</p>
                                </div>
                            </div>
                       </div>
                        <div class="space-y-2 a">
                            <label for="a" class="font-s-14 text-blue">{!! $lang['4'] !!} a:</label>
                            <input type="number" step="any" name="a" id="a" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->a)?request()->a:'3' }}" />
                        </div>
                        <div class="space-y-2 concentration2">
                            <label for="concentration_two" class="font-s-14 text-blue">{{ $lang['2'] }} [B]:</label>
                            <div class="relative w-full ">
                                <input type="number" name="concentration_two" id="concentration_two" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['concentration_two'])?$_POST['concentration_two']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="concentration_two_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('concentration_two_unit_dropdown')">{{ isset($_POST['concentration_two_unit'])?$_POST['concentration_two_unit']:'M' }} ▾</label>
                                <input type="text" name="concentration_two_unit" value="{{ isset($_POST['concentration_two_unit'])?$_POST['concentration_two_unit']:'M' }}" id="concentration_two_unit" class="hidden">
                                <div id="concentration_two_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="concentration_two_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_two_unit', 'M')">M</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_two_unit', 'mM')">mM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_two_unit', 'μM')">μM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_two_unit', 'nM')">nM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_two_unit', 'pM')">pM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_two_unit', 'fM')">fM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_two_unit', 'aM')">aM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_two_unit', 'zM')">zM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_two_unit', 'yM')">yM</p>
                                </div>
                            </div>
                       </div>
                        <div class="space-y-2 b">
                            <label for="b" class="font-s-14 text-blue">{!! $lang['4'] !!} b:</label>
                            <input type="number" step="any" name="b" id="b" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->b)?request()->b:'5' }}" />
                        </div>
                        <div class="space-y-2 concentration3">
                            <label for="concentration_three" class="font-s-14 text-blue">{{ $lang['2'] }} [C]:</label>
                            <div class="relative w-full ">
                                <input type="number" name="concentration_three" id="concentration_three" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['concentration_three'])?$_POST['concentration_three']:'4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="concentration_three_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('concentration_three_unit_dropdown')">{{ isset($_POST['concentration_three_unit'])?$_POST['concentration_three_unit']:'M' }} ▾</label>
                                <input type="text" name="concentration_three_unit" value="{{ isset($_POST['concentration_three_unit'])?$_POST['concentration_three_unit']:'M' }}" id="concentration_three_unit" class="hidden">
                                <div id="concentration_three_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="concentration_three_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_three_unit', 'M')">M</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_three_unit', 'mM')">mM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_three_unit', 'μM')">μM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_three_unit', 'nM')">nM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_three_unit', 'pM')">pM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_three_unit', 'fM')">fM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_three_unit', 'aM')">aM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_three_unit', 'zM')">zM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_three_unit', 'yM')">yM</p>
                                </div>
                            </div>
                       </div>
                        <div class="space-y-2 c">
                            <label for="c" class="font-s-14 text-blue">{!! $lang['4'] !!} c:</label>
                            <input type="number" step="any" name="c" id="c" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->c)?request()->c:'7' }}" />
                        </div>
                        <div class="space-y-2 concentration4">
                            <label for="concentration_four" class="font-s-14 text-blue">{{ $lang['2'] }} [D]:</label>
                            <div class="relative w-full ">
                                <input type="number" name="concentration_four" id="concentration_four" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['concentration_four'])?$_POST['concentration_four']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="concentration_four_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('concentration_four_unit_dropdown')">{{ isset($_POST['concentration_four_unit'])?$_POST['concentration_four_unit']:'M' }} ▾</label>
                                <input type="text" name="concentration_four_unit" value="{{ isset($_POST['concentration_four_unit'])?$_POST['concentration_four_unit']:'M' }}" id="concentration_four_unit" class="hidden">
                                <div id="concentration_four_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="concentration_four_unit">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_four_unit', 'M')">M</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_four_unit', 'mM')">mM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_four_unit', 'μM')">μM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_four_unit', 'nM')">nM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_four_unit', 'pM')">pM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_four_unit', 'fM')">fM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_four_unit', 'aM')">aM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_four_unit', 'zM')">zM</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('concentration_four_unit', 'yM')">yM</p>
                                </div>
                            </div>
                       </div>
                        <div class="space-y-2 d">
                            <label for="d" class="font-s-14 text-blue">{!! $lang['4'] !!} d:</label>
                            <input type="number" step="any" name="d" id="d" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->d)?request()->d:'9' }}" />
                        </div>
                        <div class="space-y-2 equation hidden">
                            <label for="chemical_equation" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                            <input type="text" name="chemical_equation" id="chemical_equation" class="input" aria-label="input" placeholder="4NO2 + O2 = 2N2O5 ,Na2 + Cl2 = NaCl" value="{{ isset(request()->chemical_equation)?request()->chemical_equation:'4NO2 + O2 = 2N2O5' }}" />
                        </div>
                        <div class="space-y-2 pressure hidden ">
                            <label for="total_pressure" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="total_pressure" id="total_pressure" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->total_pressure)?request()->total_pressure:'1.00794' }}" />
                                <span class="text-blue input_unit">atm</span>
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
                            <div class=equi></div>
                            @if(isset($detail['answer']) && $detail['answer'] != "")
                                <p class="text-center"><strong>{!! $lang['7'] !!} (Kc)</strong></p>
                                <p class="text-center my-1"><strong class="text-[#119154] text-[30px]">{!! round($detail['answer']) !!}</strong></p>
                            @endif
                            <div class='result d-none' id='resid'>
                                <div class='text-center mt-3 mb-1'><strong id='re'></strong></div>
                                <div id='eqre' class="text-center"><span id='equ'></span></div>
                                <font color='red'><span id='message'></span></font>
                                <code id='result'></code>
                                <div class='table mt-3'>
                                    <table id='tabledata' class="col-12" cellspacing="0"></table>
                                </div>
                            </div>
                            <?php
                                $opt=$detail['opt'];
                                if($detail['equation']){
                                    $chemical_equation=$detail['equation'];
                                }
                                if($detail['total_pressure']){
                                    $total_pressure=$detail['total_pressure'];
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        @isset($detail)
            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        @endisset
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var selectionElement = document.querySelector('#selection');

                function updateVisibility() {
                    var w = selectionElement.value;
                    if (w === "1") {
                        document.querySelectorAll('.equation, .pressure').forEach(function(el) {
                            el.style.display = 'none';
                        });
                        document.querySelectorAll('.concentration1, .a, .concentration2, .b, .concentration3, .c, .concentration4, .d').forEach(function(el) {
                            el.style.display = 'block';
                        });
                    } else if (w === "2") {
                        document.querySelectorAll('.equation, .pressure').forEach(function(el) {
                            el.style.display = 'block';
                        });
                        document.querySelectorAll('.concentration1, .a, .concentration2, .b, .concentration3, .c, .concentration4, .d').forEach(function(el) {
                            el.style.display = 'none';
                        });
                    }
                }

                selectionElement.addEventListener('change', updateVisibility);
                updateVisibility();

                @isset($detail)
                    var ions = true;
                    var colorCodes = new Array();
                    var reactant = new Array();
                    var product = new Array();
                    var reactratio = new Array();
                    var prodratio = new Array();
                    var reactarr = new Array();
                    var prodarr = new Array();
                    var arr1 = new Array();
                    var arr2 = new Array();
                    var rarr = [];
                    var mole = [];  var wt = [];
                    var op = [];
                    var rmolefractions = [];
                    var pmolefractions = [];
                    var weight = [];
                    var rlen , plen;

                    var symb = ['H', 'He', 'Li', 'Be', 'B', 'C', 'N', 'O', 'F', 'Ne', 'Na', 'Mg', 'Al', 'Si', 'P', 'S', 'Cl', 'Ar', 'K', 'Ca', 'Sc', 'Ti', 'V', 'Cr', 'Mn', 'Fe', 'Co', 'Ni', 'Cu', 'Zn', 'Ga', 'Ge', 'As', 'Se', 'Br', 'Kr', 'Rb', 'Sr', 'Y', 'Zr', 'Nb', 'Mo', 'Tc', 'Ru', 'Rh', 'Pd', 'Ag', 'Cd', 'In', 'Sn', 'Sb', 'Te', 'I', 'Xe', 'Cs', 'Ba', 'La', 'Ce', 'Pr', 'Nd', 'Pm', 'Sm', 'Eu', 'Gd', 'Tb', 'Dy', 'Ho', 'Er', 'Tm', 'Yb', 'Lu', 'Hf', 'Ta', 'W', 'Re', 'Os', 'Ir', 'Pt', 'Au', 'Hg', 'Tl', 'Pb', 'Bi', 'Po', 'At', 'Rn', 'Fr', 'Ra', 'Ac', 'Th', 'Pa', 'U', 'Np', 'Pu', 'Am', 'Cm', 'Bk', 'Cf', 'Es', 'Fm', 'Md', 'No', 'Lr', 'Rf', 'Db', 'Sg', 'Bh', 'Hs', 'Mt', 'Ds', 'Rg', 'Cn', 'Uut', 'Uuq', 'Uup', 'Uuh', 'Uus', 'Uuo'];
                    var elem = ['Hydrogen', 'Helium', 'Lithium', 'Beryllium', 'Boron', 'Carbon', 'Nitrogen', 'Oxygen', 'Fluorine', 'Neon', 'Sodium', 'Magnesium', 'Aluminum', 'Silicon', 'Phosphorus', 'Sulfur', 'Chlorine', 'Argon', 'Potassium', 'Calcium', 'Scandium', 'Titanium', 'Vanadium', 'Chromium', 'Manganese', 'Iron', 'Cobalt', 'Nickel', 'Copper', 'Zinc', 'Gallium', 'Germanium', 'Arsenic', 'Selenium', 'Bromine', 'Krypton', 'Rubidium', 'Strontium', 'Yttrium', 'Zirconium', 'Niobium', 'Molybdenum', 'Technetium', 'Ruthenium', 'Rhodium', 'Palladium', 'Silver', 'Cadmium', 'Indium', 'Tin', 'Antimony', 'Tellurium', 'Iodine', 'Xenon', 'Cesium', 'Barium', 'Lanthanum', 'Cerium', 'Praseodymium', 'Neodymium', 'Promethium', 'Samarium', 'Europium', 'Gadolinium', 'Terbium', 'Dysprosium', 'Holmium', 'Erbium', 'Thulium', 'Ytterbium', 'Lutetium', 'Hafnium', 'Tantalum', 'Tungsten', 'Rhenium', 'Osmium', 'Iridium', 'Platinum', 'Gold', 'Mercury', 'Thallium', 'Lead', 'Bismuth', 'Polonium', 'Astatine', 'Radon', 'Francium', 'Radium', 'Actinium', 'Thorium', 'Protactinium', 'Uranium', 'Neptunium', 'Plutonium', 'Americium', 'Curium', 'Berkelium', 'Californium', 'Einsteinium', 'Fermium', 'Mendelevium', 'Nobelium', 'Lawrencium', 'Rutherfordium', 'Dubnium', 'Seaborgium', 'Bohrium', 'Hassium', 'Meitnerium', 'Darmstadtium', 'Roentgenium', 'Copernicium', 'Ununtrium', 'Ununquadium', 'Ununpentium', 'Ununhexium', 'Ununseptium', 'Ununoctium'];
                    var aweight = ['1.00794', '4.002602', '6.941', '9.012182', '10.811', '12.0107', '14.0067', '15.9994', '18.9984032', '20.1797', '22.9897693', '24.305', '26.9815386', '28.0855', '30.973762', '32.065', '35.453', '39.948', '39.0983', '40.078', '44.955912', '47.867', '50.9415', '51.9961', '54.938045', '55.845', '58.933195', '58.6934', '63.546', '65.38', '69.723', '72.63', '74.9216', '78.96', '79.904', '83.798', '85.4678', '87.62', '88.90585', '91.224', '92.90638', '95.96', '98', '101.07', '102.9055', '106.42', '107.8682', '112.411', '114.818', '118.71', '121.76', '127.6', '126.90447', '131.293', '132.9054519', '137.327', '138.90547', '140.116', '140.90765', '144.242', '145', '150.36', '151.964', '157.25', '158.92535', '162.5', '164.93032', '167.259', '168.93421', '173.054', '174.9668', '178.49', '180.94788', '183.84', '186.207', '190.23', '192.217', '195.084', '196.966569', '200.59', '204.3833', '207.2', '208.9804', '209', '210', '222', '223', '226', '227', '232.03806', '231.03588', '238.02891', '237', '244', '243', '247', '247', '251', '252', '257', '258', '259', '262', '267', '268', '271', '272', '270', '276', '281', '280', '285', '284', '289', '288', '293', '294', '294'];
                    var totpres = "{!! request()->total_pressure !!}";
                    var equa ="{!! request()->chemical_equation !!}";
                    var option="{!! $opt !!}";
                    if(option=="2"){
                        // console.log('Second Condition');
                        if(totpres == '' || equa == ''){
                            alert('Fill all the required fields');
                            $('#resid').hide();
                        }else{
                            $('#tabledata').html('');
                            $('#re').text('Balanced Equation');
                            setError('');
                            var balancedElem = document.getElementById('equ');
                            var codeOutElem = document.getElementById('result');   
                            // Parse equation
                            var eqn;
                            try{
                                eqn = eqn_parse(); 
                            } catch (e)
                            {
                                setError('Equation error');
                            }
                            try {
                                var colorsCode = ['9933ff','3399ff','ff9933','ff3333','990099','004c99','4c9900','999900','994c00']; // Element Colors
                                shuffle(colorsCode);
                                var matrix = createMatrix(eqn);            // form matrix
                                solveEq(matrix);                                // Solve by linear system
                                var coefficients = splitCoeffic(matrix);      // select coeffic
                                checkAnswer(eqn, coefficients);                      // test answers.
                                var eltLen = eqn.getElements().length;
                                for(colo=0;colo<eltLen;colo++)
                                {
                                    if (colo != 0)
                                    {
                                        colorCodes[eqn.getElements()[colo]] = colorsCode[colo];
                                    }
                                }
                                
                                balancedElem.appendChild(eqn.toHtml(coefficients));  // output bal-equation
                                
                            } catch (e) {
                                setError(e.toString());
                            }
                            rlen=reactant.length;
                            plen=product.length;
                            var index=new Array();
                            var matches='';
                            var totalmoles = 0;
                            var rpartialpressure = new Array();
                            var ppartialpressure = new Array();
                            var rmoles = new Array();
                            var pmoles = new Array();
                            var ppressure = 1;
                            var rpressure= 1;
                            reactarr = [];
                            prodarr = [];
                            for (var k=0;k<rlen;k++) {                  //loop checks for the all Reactants
                                var mmass = 0; var t_mass=0;
                                var ans=reactant[k].split(/(?=[A-Z])/);         //splits each reactant as seperate chemicals
                                ab = ans;
                                for(var i=0;i<ab.length;i++){
                                    var regex = /\d+/g;
                                    var string = ab[i];
                                    matches = string.match(regex);  // creates array from matches
                                    if(matches){
                                        index[i]=matches;
                                    }else{
                                        index[i]=1;
                                    }
                                    for(var j=0; j<symb.length; j++) {
                                        if(ab[i].split(/(?=[0-9])/)[0] == symb[j]){
                                            mmass = aweight[j] * index[i];
                                            t_mass += mmass;
                                        }
                                    }
                                }
                                reactarr[k] = t_mass;

                                rmoles[k] = reactratio[k] * reactarr[k];
                                totalmoles += rmoles[k];
                            }
                            for (var k=0;k<plen;k++) {                  //loop checks for the all Reactants
                            
                                var mmass = 0; var t_mass=0;
                                var ans=product[k].split(/(?=[A-Z])/);          //splits each product as seperate chemicals
                                ab = ans;
                                for(var i=0;i<ab.length;i++){
                                var regex = /\d+/g;
                                var string = ab[i];
                                matches = string.match(regex);  // creates array from matches
                                if(matches){
                                index[i]=matches;
                                }
                                else{
                                    index[i]=1;
                                }
                                
                                for(var j=0; j<symb.length; j++) {
                                    if(ab[i].split(/(?=[0-9])/)[0] == symb[j]){
                                    mmass = aweight[j] * index[i];
                                    t_mass += mmass;
                                    }
                                }
                                }
                                prodarr[k] = t_mass;
                                pmoles[k] = prodratio[k] * prodarr[k];
                                totalmoles += pmoles[k];
                            }
                            for (var k=0;k<rlen;k++) { 
                                rmolefractions[k] = parseFloat(rmoles[k]) / parseFloat(totalmoles);
                                rpartialpressure[k] = parseFloat(rmolefractions[k]) * totpres;
                                rpressure *= Math.pow(parseFloat(rpartialpressure[k]), parseFloat(reactratio[k]) ); 
                            }
                            for (var m=0;m<plen;m++) { 
                                pmolefractions[m] = parseFloat(pmoles[m]) / parseFloat(totalmoles);
                                ppartialpressure[m] = parseFloat(pmolefractions[m]) * totpres;
                                ppressure *= Math.pow(parseFloat(ppartialpressure[m]), parseFloat(prodratio[m]) );
                            } 
                            
                            var kp = rpressure/ppressure;
                            kp = easyRoundOf(kp,4);
                            var val;
                            val += '<tr> <th class=" sizing font_size20 center margin_top_10 text-accent-4 color_blue">Compound</th> <th class=" sizing font_size20 center margin_top_10 text-accent-4 color_blue">Moles</th> <th class=" sizing font_size20 center margin_top_10 text-accent-4 color_blue">Mole Fractions</th> <th class="sizing font_size20 center margin_top_10 text-accent-4 color_blue">Partial pressure</th> </tr> ';
                            val += ' <tr> <th colspan=4 class="sizing font_size20 center margin_top_10 text-accent-4 color_blue">Reactants</th> </tr>';
                            for(i=1;i<=rlen;i++){

                                val+='<tr> <td class="font_size18 center margin_top_10 text-accent-4 black-text">'+reactant[i-1]+'</td> <td class=" font_size18 center margin_top_10 text-accent-4 black-text">'+easyRoundOf(rmoles[i-1],4)+' mol'+'</td> <td class="col s12 font_size18 center margin_top_10 text-accent-4 black-text">'+easyRoundOf(rmolefractions[i-1],4)+'</td> <td class=" font_size18 center margin_top_10 text-accent-4 black-text">'+easyRoundOf(rpartialpressure[i-1],4)+' atm</td> </tr>';
                            }
                            val+=' <tr> <th colspan=4 class="font_size20 center margin_top_10 text-accent-4 color_blue">Products</th> </tr>';
                            for(j=1;j<=plen;j++){
                                val+='<tr> <td class=" font_size18 center margin_top_10 text-accent-4 black-text">'+product[j-1]+'</td> <td class=" font_size18 center margin_top_10 text-accent-4 black-text">'+easyRoundOf(pmoles[j-1],4) +' mol'+'</td> <td class="font_size18 center margin_top_10 text-accent-4 black-text">'+easyRoundOf(pmolefractions[j-1],4)+'</td> <td class="font_size18 center margin_top_10 text-accent-4 black-text">'+easyRoundOf(ppartialpressure[j-1],4)+' atm</td> </tr>';
                            }
                            $('#resid').show();
                            $('#dispdiv').show();
                            $('#tabledata').html(val);
                            $('.equi').html('<div class="col s12 font_s25 center color_blue"><strong>Equilibrium Constant k<sub>p</sub></strong><span class=\'width_100\'><div class="col s12 font_size28 center margin_top_10 text-accent-4 orange-text">'+kp+'</div>');       
                            var rwt = [];
                            var rml = [];
                            var n,ac,bc,s,molar,lr, z;
                            var minimum;  var count = 0; 
                            function calc(obj){
                                //moles, weight and limiting calculation here
                                n= rlen;
                                s= plen; 
                                for (z=1;z<=n;z++) {            //Loop to get the input values from the input area
                                    if (rwt[z-1] = document.getElementById('wr'+[z]).value) {
                                        
                                    mole[z-1] = rwt[z-1]/reactarr[z-1];
                                    document.getElementById('mr'+[z]).value=mole[z-1];
                                    }
                                    else if(rml[z-1] = document.getElementById('mr'+[z]).value)
                                    {
                                    wt[z-1] = rml[z-1] * reactarr[z-1];
                                    document.getElementById('wr'+[z]).value=wt[z-1];
                                    mole[z-1] = rml[z-1];
                                    }
                                }
                                Array.min = function( mole ){      // function to find minimum mole
                                    return Math.min.apply( Math, mole );
                                };
                                minimum = Array.min(mole);
                                for (var k=1;k<=n;k++) {            
                                    if (minimum == mole[k-1]) {         // minimum value to match the reactant weight
                                        ac = reactratio[k-1];
                                        lr = reactant[k-1];
                                        document.getElementById('opp').value='The Limiting reagent is '+lr;
                                    }
                                }
                                for (var m=1;m<=s;m++) {            // Loop to calculate the product moles and weight
                                    bc = prodratio[m-1]; 
                                    op[m-1] = (bc/ac) * minimum;
                                    molar = document.getElementById('mmp'+[m]).value;
                                    weight[m-1] = molar * op[m-1];
                                    //document.getElementById('mp'+[m]).value=op[m-1];
                                    //document.getElementById('wp'+[m]).value=weight[m-1];
                                }
                                var isValid = true;
                                $('.tabledata').find(':input:not([readonly])').each(function (){
                                    var element = $(this);
                                    if (element.val() == '') {
                                        isValid = false;
                                        return isValid;
                                    }
                                });
                                if (!isValid) {
                                // do nothing
                                }
                                if(isValid) {
                                    for (var m=1;m<=s;m++) {
                                        document.getElementById('mp'+[m]).value=op[m-1];
                                        document.getElementById('wp'+[m]).value=weight[m-1];
                                    }
                                }
                            }
                    
                            function clearall(){
                                $('#equ').html('');
                                $('#message').html('');
                                $('#result').html('');
                                $('#re').html('');
                                $('#input').val('');
                                $('#totpres').val('');
                                $('#tabledata').html('');
                                $('#resid').hide();
                            }

                            function shuffle(o){ 
                                for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
                                return o;
                            }

                            function eqn_parse() {
                                var fakhar="{!! request()->chemical_equation !!}";
                                var inputs = fakhar.replace(/ /g,'');
                                //console.log('Enter Into the Parse Equation');
                                console.log(inputs);
                                var oper = new Array('+', '-', '=');
                                var input = '';
                                var opera = false;

                                for (i=0; i<inputs.length; i++) {
                                    var tempstr = inputs[i];
                                    if(i==0 && !isNaN(tempstr)) {
                                        input += '';
                                    } else {
                                        if(jQuery.inArray(tempstr, oper)>-1) {
                                            opera = true;
                                            input += tempstr;
                                        }
                                        else if(opera == true && !isNaN(tempstr)) {
                                            opera = false;
                                        }
                                        else {
                                            opera = false;
                                            input += tempstr;
                                        }
                                    }
                                }

                                var token = new Tnizer(input);
                                // console.log('Token');
                                // console.log(token);
                                return pEquation(token);
                            }

                            function setError(str){
                                $('#resid').show();
                                $('#message').text(str);
                            }

                            function Tnizer(stri){
                                var posi = 0;
                                this.position = function(){
                                    return posi;
                                }

                                this.peek = function(){
                                    if (posi == stri.length)
                                        return null;      // End of stream
                                    
                                    var match = /^([A-Za-z][a-z]*|[0-9]+| +|[+\-^=()])/.exec(stri.substring(posi)); 
                                    if (match == null)
                                        throw {errormsg: 'Invalid symbol ', start: posi};
                                        
                                    
                                    var token = match[0];
                                    if (/^ +$/.test(token))
                                    {                   // jump whitespace token
                                        posi += token.length;
                                        token = this.peek();        // Return next token
                                    }
                                    return token;
                                }

                                this.take = function(){
                                    var result = this.peek();
                                    posi += result.length;
                                    return result;
                                }
                            }

                            function pEquation(tokstr){
                                var lside = [];
                                var rside = [];
                                
                                lside.push(parseTerm(tokstr));
                                while (true){
                                    var nextstr = tokstr.peek();
                                    if (nextstr == '=')
                                        break;
                                    if (nextstr == null)
                                        throw {errormsg: 'Plus or equal sign expected', start: tokstr.position()};
                                    if (nextstr != '+')
                                        throw {errormsg: 'Plus expected', start: tokstr.position()};
                                    tokstr.take();  
                                    lside.push(parseTerm(tokstr));
                                }
                                
                                if (tokstr.take() != '=')
                                    throw 'Assertion error';
                                
                                rside.push(parseTerm(tokstr));
                                while (true){
                                    var nextstr = tokstr.peek();
                                    if (nextstr == null)
                                        break;
                                    if (nextstr != '+')
                                        throw {errormsg: 'Plus expected', start: tokstr.position()};
                                    tokstr.take();  
                                    rside.push(parseTerm(tokstr));
                                }
                                
                                return new EquationFun(lside, rside);
                            }

                            function parseTerm(tokstr){
                                var startPosition = tokstr.position();  
                                var items_array = [];
                                while (true){
                                    var nextstr = tokstr.peek();
                                    if (nextstr == null)
                                        break;
                                    else if (nextstr == '(')
                                        items_array.push(parseGroup(tokstr));
                                    else if (/^[A-Za-z][a-z]*$/.test(nextstr))
                                        items_array.push(parseElement(tokstr));
                                    else
                                        break;
                                }
                                
                                var charge = 0;
                                var nextstr = tokstr.peek();
                                if (nextstr != null && nextstr == '^'){
                                    tokstr.take();  
                                    nextstr = tokstr.peek();
                                    if (nextstr == null)
                                        throw {errormsg: 'Number or sign expected', start: tokstr.position()};
                                    else if (/^[0-9]+$/.test(nextstr)) {
                                        charge = checkedParseInt(nextstr, 10);
                                        tokstr.take();  
                                        nextstr = tokstr.peek();
                                    } else
                                        charge = 1;
                                    
                                    if (nextstr == null)
                                        throw {errormsg: 'Sign expected', start: tokstr.position()};
                                    else if (nextstr == '+');  
                                    else if (nextstr == '-')
                                        charge = -charge;
                                    else
                                        throw {errormsg: 'Sign expected', start: tokstr.position()};
                                    tokstr.take();  
                                }
                                
                                var elements = new Set();
                                for (var i = 0; i < items_array.length; i++)
                                    items_array[i].getElements(elements);
                                elements = elements.toArray();  
                                if (items_array.length == 0) {
                                    throw {errormsg: 'Invalid term ', start: startPosition, end: tokstr.position()};
                                } else if (indexOf(elements, 'e') != -1) {  
                                    if (items_array.length > 1 || charge != 0 && charge != -1)
                                        throw {errormsg: 'Invalid term ', start: startPosition, end: tokstr.position()};
                                    items_array = [];
                                    charge = -1;
                                } else {  
                                    for (var i = 0; i < elements.length; i++) {
                                        if (/^[a-z]+$/.test(elements[i]))
                                            throw {errormsg: 'Invalid element '+elements[i],start: startPosition, end: tokstr.position()};
                                    }
                                }
                                
                                return new checkTerm(items_array, charge);
                            }

                            function createMatrix(eqn){
                                var elements = eqn.getElements(); 
                                var m_rows = elements.length + 1;
                                var M_cols = eqn.getLeftSide().length + eqn.getRightSide().length + 1;
                                var matrix = new Matrix(m_rows, M_cols);
                                for (var i = 0; i < elements.length; i++) {
                                    var j = 0;
                                    for (var k = 0, lside = eqn.getLeftSide() ; k < lside.length; j++, k++)
                                        matrix.set(i, j,  lside[k].countElement(elements[i]));
                                    for (var k = 0, rside = eqn.getRightSide(); k < rside.length; j++, k++)
                                        matrix.set(i, j, -rside[k].countElement(elements[i]));
                                }
                                return matrix;
                            }

                            function solveEq(matrix){
                                matrix.GJ_Eliminate();
                                var i;
                                for (i = 0; i < matrix.rowCount() - 1; i++) {
                                    if (CNZeroCoeffs(matrix, i) > 1)
                                        break;
                                }
                                if (i == matrix.rowCount() - 1)
                                    throw 'Element combination incorrect'; 
                                
                                matrix.set(matrix.rowCount() - 1, i, 1);
                                matrix.set(matrix.rowCount() - 1, matrix.columnCount() - 1, 1);
                                
                                matrix.GJ_Eliminate();
                            }

                            function CNZeroCoeffs(matrix, row) {
                                var count = 0;
                                for (var i = 0; i < matrix.columnCount(); i++) {
                                    if (matrix.get(row, i) != 0)
                                        count++;
                                }
                                return count;
                            }

                            function splitCoeffic(matrix) {
                                var m_rows = matrix.rowCount();
                                var M_cols = matrix.columnCount();
                                
                                if (M_cols - 1 > m_rows || matrix.get(M_cols - 2, M_cols - 2) == 0)
                                    throw 'No unique solution';
                                
                                var lcm = 1;
                                for (var i = 0; i < M_cols - 1; i++)
                                    lcm = checkedMultiply(lcm / gcd(lcm, matrix.get(i, i)), matrix.get(i, i));
                                
                                var coefficients = [];
                                var allzero = true;
                                for (var i = 0; i < M_cols - 1; i++) {
                                    var coef = checkedMultiply(lcm / matrix.get(i, i), matrix.get(i, M_cols - 1));
                                    coefficients.push(coef);
                                    allzero &= coef == 0;
                                }
                                if (allzero)
                                    throw 'Assertion error: All zero solution';
                                return coefficients;
                            }

                            function checkAnswer(eqn, coefficients) {
                                if (coefficients.length != eqn.getLeftSide().length + eqn.getRightSide().length)
                                    throw 'Assertion error: Mismatched length';
                                
                                var allzero = true;
                                for (var i = 0; i < coefficients.length; i++) {
                                    var coef = coefficients[i];
                                    if (typeof coef != 'number' || isNaN(coef) || Math.floor(coef) != coef)
                                        throw 'Assertion error: Not an integer';
                                    allzero &= coef == 0;
                                }
                                if (allzero)
                                    throw 'Assertion error: Solution of all zeros';
                                
                                var elements = eqn.getElements();
                                for (var i = 0; i < elements.length; i++) {
                                    var sum = 0;
                                    var j = 0;
                                    for (var k = 0, lside = eqn.getLeftSide() ; k < lside.length; j++, k++)
                                        sum = checkedAdd(sum, checkedMultiply(lside[k].countElement(elements[i]),  coefficients[j]));
                                    for (var k = 0, rside = eqn.getRightSide(); k < rside.length; j++, k++)
                                        sum = checkedAdd(sum, checkedMultiply(rside[k].countElement(elements[i]), -coefficients[j]));
                                    if (sum != 0)
                                        throw 'Assertion error: Balance failed';
                                }
                            }

                            function EquationFun(lside, rside){
                                reactant = [];
                                product = [];
                                reactratio = [];
                                prodratio = [];

                                lside = copyArray(lside);
                                rside = copyArray(rside);
                                
                                this.getLeftSide  = function() { return copyArray(lside); }
                                this.getRightSide = function() { return copyArray(rside); }
                                
                                this.getElements = function(){
                                    var result = new Set();
                                    for (var i = 0; i < lside.length; i++)
                                        lside[i].getElements(result);
                                    for (var i = 0; i < rside.length; i++)
                                        rside[i].getElements(result);
                                    return result.toArray();
                                }
                                
                                this.toHtml = function(coefficients){
                                    if (coefficients !== undefined && coefficients.length != lside.length + rside.length)
                                        throw 'Mismatched number of coefficients';
                                    var node = document.createElement('span');
                                    var initial = true;
                                    for (var i = 0; i < lside.length; i++) {
                                        var coef = coefficients !== undefined ? coefficients[i] : 1;
                                        if (coef != 0) {
                                        if (initial) initial = false;
                                        else node.appendChild(document.createTextNode(' + '));
                                            if (coef != 1)
                                            {
                                                var disp = document.createElement('span');
                                                disp.setAttribute('style','font-weight:bold;color:blue;padding-left:0.5%;padding-right:0.5%;');
                                                disp.appendChild(document.createTextNode(coef.toString().replace(/-/, MINUS)));
                                                node.appendChild(disp);
                                            }
                                            reactratio.push(coef);
                                            reactant.push(lside[i].toHtml().innerText);
                                            node.appendChild(lside[i].toHtml());
                                        }
                                    }
                                    
                                    var disp = document.createElement('span');
                                    disp.setAttribute('style','font-weight:bold;color:green;font-size:30px;');
                                    disp.appendChild(document.createTextNode(' \u2192 '));
                                    node.appendChild(disp);
                                    
                                    initial = true;
                                    for (var i = 0; i < rside.length; i++) {
                                        var coef = coefficients !== undefined ? coefficients[lside.length + i] : 1;
                                        if (coef != 0) {
                                        if (initial) initial = false;
                                        else node.appendChild(document.createTextNode(' + '));
                                            if (coef != 1)
                                            {
                                                var disp = document.createElement('span');
                                                disp.setAttribute('style','font-weight:bold;color:blue;padding-left:0.5%;padding-right:0.5%;');
                                                disp.appendChild(document.createTextNode(coef.toString().replace(/-/, MINUS)));
                                                node.appendChild(disp);
                                            }
                                            prodratio.push(coef);
                                            product.push(rside[i].toHtml().innerText);
                                            node.appendChild(rside[i].toHtml());
                                        }
                                    }
                                    return node;
                                }
                            }

                            function checkTerm(items_array, charge){

                                if(charge!=0){
                                    ions = false;
                                }
                                
                                if(ions==false && charge!=0){
                                    throw 'Invalid term, Elements without Ions';
                                }
                            
                                if (items_array.length == 0 && charge != -1)
                                    throw 'Invalid term ';
                                items_array = copyArray(items_array);
                                
                                this.getItems = function() { return copyArray(items_array); }
                                
                                this.getElements = function(result) {
                                    result.add('e');
                                    for (var i = 0; i < items_array.length; i++)
                                        items_array[i].getElements(result);
                                }
                                
                                this.countElement = function(name) {
                                    if (name == 'e') {
                                        return -charge;
                                    } else {
                                        var sum = 0;
                                        for (var i = 0; i < items_array.length; i++)
                                            sum = checkedAdd(sum, items_array[i].countElement(name));
                                        return sum;
                                    }
                                }
                                this.toHtml = function() {
                                    var node = document.createElement('span');
                                    if (items_array.length == 0 && charge == -1) {
                                        node.appendChild(document.createTextNode('e'));
                                        var sup = document.createElement('sup');
                                        sup.appendChild(document.createTextNode(MINUS));
                                        node.appendChild(sup);
                                    } else {
                                        for (var i = 0; i < items_array.length; i++)
                                            node.appendChild(items_array[i].toHtml());
                                        if (charge != 0) {
                                            var sup = document.createElement('sup');
                                            var s;
                                            if (Math.abs(charge) == 1) s = '';
                                            else s = Math.abs(charge).toString();
                                            if (charge > 0) s += '+';
                                            else s += MINUS;
                                            sup.appendChild(document.createTextNode(s));
                                            node.appendChild(sup);
                                        }
                                    }
                                    return node;
                                }
                            }

                            function Group(items_array, count) {
                                if (count < 1)
                                    throw 'Count must be a positive integer';
                                items_array = copyArray(items_array);
                                
                                this.getItems = function() { return copyArray(items_array); }
                                
                                this.getCount = function() { return count; }
                                
                                this.getElements = function(result) {
                                    for (var i = 0; i < items_array.length; i++)
                                        items_array[i].getElements(result);
                                }
                                
                                this.countElement = function(name) {
                                    var sum = 0;
                                    for (var i = 0; i < items_array.length; i++)
                                        sum = checkedAdd(sum, checkedMultiply(items_array[i].countElement(name), count));
                                    return sum;
                                }
                                
                                this.toHtml = function() {
                                    var node = document.createElement('span');
                                    node.appendChild(document.createTextNode('('));
                                    for (var i = 0; i < items_array.length; i++)
                                        node.appendChild(items_array[i].toHtml());
                                    node.appendChild(document.createTextNode(')'));
                                    if (count != 1) {
                                        var sub = document.createElement('sub');
                                        sub.appendChild(document.createTextNode(count.toString()));
                                        node.appendChild(sub);
                                    }
                                    return node;
                                }
                            }

                            function Element(name, count) {
                                if (count < 1)
                                    throw 'Count must be a positive integer';
                                
                                this.getName = function() { return name; }
                                
                                this.getCount = function() { return count; }
                                
                                this.getElements = function(result) { result.add(name); }
                                
                                this.countElement = function(n) { return n == name ? count : 0; }
                                
                                this.toHtml = function() {
                                    var node = document.createElement('span');
                                    node.setAttribute('style','color:#'+colorCodes[name]+';padding-left:0.5%;padding-right:0.5%');
                                    node.appendChild(document.createTextNode(name));
                                    if (count != 1) {
                                        var sub = document.createElement('sub');
                                        sub.appendChild(document.createTextNode(count.toString()));
                                        node.appendChild(sub);
                                    }
                                    return node;
                                }
                            }

                            function parseGroup(tokstr) {
                                if (tokstr.take() != '(')
                                    throw 'Assertion error';
                                
                                var items_array = [];
                                while (true) {
                                    var nextstr = tokstr.peek();
                                    if (nextstr == null)
                                        throw {errormsg: 'Element, group, or closing parenthesis expected', start: tokstr.position()};
                                    else if (nextstr == '(')
                                        items_array.push(parseGroup(tokstr));
                                    else if (/^[A-Za-z][a-z]*$/.test(nextstr))
                                        items_array.push(parseElement(tokstr));
                                    else if (nextstr == ')')
                                        break;
                                    else
                                        throw {errormsg: 'Element, group, or closing parenthesis expected', start: tokstr.position()};
                                }
                                
                                if (tokstr.take() != ')')
                                    throw 'Assertion error';
                                
                                return new Group(items_array, parseCount(tokstr));
                            }

                            function parseElement(tokstr) {
                                var name = tokstr.take();
                                if (!/^[A-Za-z][a-z]*$/.test(name))
                                    throw 'Assertion error';
                                return new Element(name, parseCount(tokstr));
                            }

                            function parseCount(tokstr) {
                                var nextstr = tokstr.peek();
                                if (nextstr != null && /^[0-9]+$/.test(nextstr))
                                    return checkedParseInt(tokstr.take(), 10);
                                else
                                    return 1;
                            }

                            function Matrix(m_rows, M_cols){
                                var cells = [];
                                for (var i = 0; i < m_rows; i++) {
                                    var row = [];
                                    for (var j = 0; j < M_cols; j++)
                                        row.push(0);
                                    cells.push(row);
                                }
                                
                                this.rowCount = function() { return m_rows; }
                                this.columnCount = function() { return M_cols; }
                                
                                this.get = function(r, c) {
                                    if (r < 0 || r >= m_rows || c < 0 || c >= M_cols)
                                        throw 'Index out of bounds';
                                    return cells[r][c];
                                }
                                
                                this.set = function(r, c, val) {
                                    if (r < 0 || r >= m_rows || c < 0 || c >= M_cols)
                                        throw 'Index out of bounds';
                                    cells[r][c] = val;
                                }
                                
                                function swapRows(i, j) {
                                    if (i < 0 || i >= m_rows || j < 0 || j >= m_rows)
                                        throw 'Index out of bounds';
                                    var temp = cells[i];
                                    cells[i] = cells[j];
                                    cells[j] = temp;
                                }
                                
                                function AdditionRows(x, y) {
                                    var z = copyArray(x);
                                    for (var i = 0; i < z.length; i++)
                                        z[i] = checkedAdd(x[i], y[i]);
                                    return z;
                                }
                                
                                function multiplyRow(x, c) {
                                    var y = copyArray(x);
                                    for (var i = 0; i < y.length; i++)
                                        y[i] = checkedMultiply(x[i], c);
                                    return y;
                                }
                                
                                function gcdRow(x) {
                                    var result = 0;
                                    for (var i = 0; i < x.length; i++)
                                        result = gcd(x[i], result);
                                    return result;
                                }
                                
                                function simplifyRow(x)
                                {
                                    var sign = 0;
                                    for (var i = 0; i < x.length; i++) {
                                        if (x[i] > 0) {
                                            sign = 1;
                                            break;
                                        } else if (x[i] < 0) {
                                            sign = -1;
                                            break;
                                        }
                                    }
                                    var y = copyArray(x);
                                    if (sign == 0)
                                        return y;5
                                    var g = gcdRow(x) * sign;
                                    for (var i = 0; i < y.length; i++)
                                        y[i] /= g;
                                    return y;
                                }
                                
                                this.GJ_Eliminate = function()
                                {
                                    for (var i = 0; i < m_rows; i++)
                                        cells[i] = simplifyRow(cells[i]);
                                    
                                    var numPivots = 0;
                                    for (var i = 0; i < M_cols; i++)
                                    {
                                        var pivotRow = numPivots;
                                        while (pivotRow < m_rows && cells[pivotRow][i] == 0)
                                            pivotRow++;
                                        if (pivotRow == m_rows)
                                            continue;
                                        var pivot = cells[pivotRow][i];
                                        swapRows(numPivots, pivotRow);
                                        numPivots++;
                                        
                                        for (var j = numPivots; j < m_rows; j++) {
                                            var g = gcd(pivot, cells[j][i]);
                                            cells[j] = simplifyRow(AdditionRows(multiplyRow(cells[j], pivot / g), multiplyRow(cells[i], -cells[j][i] / g)));
                                        }
                                    }
                                    
                                    for (var i = m_rows - 1; i >= 0; i--) {
                                        // Find pivot
                                        var pivotCol = 0;
                                        while (pivotCol < M_cols && cells[i][pivotCol] == 0)
                                            pivotCol++;
                                        if (pivotCol == M_cols)
                                            continue;
                                        var pivot = cells[i][pivotCol];
                                        
                                        for (var j = i - 1; j >= 0; j--) {
                                            var g = gcd(pivot, cells[j][pivotCol]);
                                            cells[j] = simplifyRow(AdditionRows(multiplyRow(cells[j], pivot / g), multiplyRow(cells[i], -cells[j][pivotCol] / g)));
                                        }
                                    }
                                }
                                
                                this.toString = function() {
                                    var result = '[';
                                    for (var i = 0; i < m_rows; i++) {
                                        if (i != 0) result += '],\n';
                                        result += '[';
                                        for (var j = 0; j < M_cols; j++) {
                                            if (j != 0) result += ', ';
                                            result += cells[i][j];
                                        }
                                        result += ']';
                                    }
                                    return result + ']';
                                }
                            }

                            function Set() {
                                var items_array = [];
                                this.add = function(obj) { if (indexOf(items_array, obj) == -1) items_array.push(obj); }
                                this.contains = function(obj) { return items_array.indexOf(obj) != -1; }
                                this.toArray = function() { return copyArray(items_array); }
                            }

                            var NBSP  = '\u00A0';  // No-break space
                            var MINUS = '\u2212';  // Minus sign


                            var INT_MAX = 9007199254740992;  // 2^53

                            function checkedParseInt(str) {
                                var result = parseInt(str, 10);
                                if (isNaN(result))
                                    throw 'Not a number';
                                if (result <= -INT_MAX || result >= INT_MAX)
                                    throw 'Arithmetic overflow';
                                return result;
                            }

                            function checkedAdd(x, y) {
                                var z = x + y;
                                if (z <= -INT_MAX || z >= INT_MAX)
                                    throw 'Arithmetic overflow';
                                return z;
                            }

                            function checkedMultiply(x, y) {
                                var z = x * y;
                                if (z <= -INT_MAX || z >= INT_MAX)
                                    throw 'Arithmetic overflow';
                                return z;
                            }

                            function gcd(x, y) {
                                if (typeof x != 'number' || typeof y != 'number' || isNaN(x) || isNaN(y))
                                    throw 'Invalid argument ';
                                x = Math.abs(x);
                                y = Math.abs(y);
                                while (y != 0) {
                                    var z = x % y;
                                    x = y;
                                    y = z;
                                }
                                return x;
                            }


                            function indexOf(array, item){
                                for (var i = 0; i < array.length; i++) {
                                    if (array[i] == item)
                                        return i;
                                }
                                return -1;
                            }


                            function copyArray(array) {
                                return array.slice(0);
                            }

                            function RM_AllChildren(node) {
                                while (node.childNodes.length > 0){
                                    node.removeChild(node.firstChild);
                                }
                            }
                        }
                    }
                @endisset
            });
        </script>
    @endpush
</form>