<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="cmpnd" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <select name="cmpnd" id="cmpnd" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = ["Select Compound","Abietic Acid [C19H29COOH]","Acenaphthene [C12H10]","Acenaphthoquinone [C12H6O2]","Acenaphthylene [C12H8]","Acetaldehyde [CH3CHO]","Acetanilide [C8H9NO]","Acetic Acid [CH3COOH]","Acetone [CH3COCH3]","Acetonitrile [CH3CN]","Acetophenone [C8H8O]","Benzaldehyde [C6H5CHO]","Benzene [C6H6]","Benzoic Acid [C6H5COOH]","Benzyl Alcohol [C7H8O]","Bromobenzene [C6H5Br]","Bromomethane [CH3Br]","Butanal [C4H8O]","Butane [C4H10]","2-Butanol [C4H10O]","Carbon Dioxide [CO2]","Carbonic Acid [H2CO3]","Cellulose [C6H10O5]","Chloral Hydrate [C2HCl3O.H2O]","Chloroethene [C2H3Cl]","Chloroform [CHCl3]","Citric Acid [C3H4OH(COOH)3]","Cyclohexane [C6H12]","Diethyl Ether [C4H10O]","Ethane [C2H6]","Ethanol [CH3CH2OH]","Ethene [C2H4]","Ethidium Bromide [C21H20BrN3]","Ethyl Acetate [C4H8O2]","Ethylamine [C2H7N]","Ethylbenzene [C8H10]","Ethylene [C2H4]","Ethylene Glycol [HOCH2CH2OH]","Formaldehyde [HCHO]","Glucose [C6H12O6]","Glycerol [C3H8O3]","Glycine [NH2CH2COOH]","Heptane [C7H16]","Hexane [C6H14]","Histidine [NH2CH(C4H5N2)COOH]","Isoborneol [C10H18O]","Lactic Acid [CH3CH(OH)COOH]","Lactose [C12H22O11]","Lysine [C6H14N2O2]","Maleic Anhydride [C4H2O3]","Methane [CH4]","Methanol [CH3OH]","Methyl Acetate [C3H6O2]","2-Methylpropene [CH3CH(CH3)CH3]","Naphthalene [C10H8]","Octane [C8H18]","Pentane [C5H12]","Phenacetin [CH3CONHC6H4OC2H5]","Propane [C3H8]","Propionic Acid [CH3CH2COOH]","Salicylie Acid [C7H6O3]","Styrene [C8H8]","Sucrose [C12H22O11]","Toluene [C6H5CH3]","Valine [C5H11NO2]","Water [H2O]"];
                            $val = ["none","C19H29COOH","C12H10","C12H6O2","C12H8","CH3CHO","C8H9NO","CH3COOH","CH3COCH3","CH3CN","C8H8O","C6H5CHO","C6H6","C6H5COOH","C7H8O","C6H5Br","CH3Br","C4H8O","C4H10","C4H10O","CO2","H2CO3","C6H10O5","C2HCl3O.H2O","C2H3Cl","CHCl3","C3H4OH(COOH)3","C6H12","C4H10O","C2H6","CH3CH2OH","C2H4","C21H20BrN3","C4H8O2","C2H7N","C8H10","C2H4","HOCH2CH2OH","HCHO","C6H12O6","C3H8O3","NH2CH2COOH","C7H16","C6H14","NH2CH(C4H5N2)COOH","C10H18O","CH3CH(OH)COOH","C12H22O11","C6H14N2O2","C4H2O3","CH4","CH3OH","C3H6O2","CH3CH(CH3)CH3","C10H8","C8H18","C5H12","CH3CONHC6H4OC2H5","C3H8","CH3CH2COOH","C7H6O3","C8H8","C12H22O11","C6H5CH3","C5H11NO2","H2O"];
                            optionsList($val,$name,isset(request()->cmpnd)?request()->cmpnd:'none');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="elem" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                    <select name="elem" id="elem" class="input">
                        @php
                            $name = ["Select Element","Actinium [Ac]","Aluminum [Al]","Americium [Am]","Antimony [Sb]","Argon [Ar]","Arsenic [As]","Astatine [At]","Barium [Ba]","Berkelium [Bk]","Beryllium [Be]","Bismuth [Bi]","Bohrium [Bh]","Boron [B]","Bromine [Br]","Cadmium [Cd]","Calcium [Ca]","Californium [Cf]","Carbon [C]","Cerium [Ce]","Cesium [Cs]","Chlorine [Cl]","Chromium [Cr]","Cobalt [Co]","Copper [Cu]","Curium [Cm]","Dubnium [Db]","Dysprosium [Dy]","Einsteinium [Es]","Erbium [Er]","Europium [Eu]","Fermium [Fm]","Fluorine [F]","Francium [Fr]","Gadolinium [Gd]","Gallium [Ga]","Germanium [Ge]","Gold [Au]","Hafnium [Hf]","Hassium [Hs]","Helium [He]","Holmium [Ho]","Hydrogen [H]","Indium [In]","Iodine [I]","Iridium [Ir]","Iron [Fe]","Krypton [Kr]","Lanthanum [La]","Lawrencium [Lr]","Lead [Pb]","Lithium [Li]","Lutetium [Lu]","Magnesium [Mg]","Manganese [Mn]","Meitnerium [Mt]","Mendelevium [Md]","Mercury [Hg]","Molybdenum [Mo]","Neodymium [Nd]","Neon [Ne]","Neptunium [Np]","Nickel [Ni]","Niobium [Nb]","Nitrogen [N]","Nobelium [No]","Osmium [Os]","Oxygen [O]","Palladium [Pd]","Phosphorus [P]","Platinum [Pt]","Plutonium [Pu]","Polonium [Po]","Potassium [K]","Praseodymium [Pr]","Promethium [Pm]","Protactinium [Pa]","Radium [Ra]","Radon [Rn]","Rhenium [Re]","Rhodium [Rh]","Rubidium [Rb]","Ruthenium [Ru]","Rutherfordium [Rf]","Samarium [Sm]","Scandium [Sc]","Seaborgium [Sg]","Selenium [Se]","Silicon [Si]","Silver [Ag]","Sodium [Na]","Strontium [Sr]","Sulfur [S]","Tantalum [Ta]","Technetium [Tc]","Tellurium [Te]","Terbium [Tb]","Thallium [Tl]","Thorium [Th]","Thulium [Tm]","Tin [Sn]","Titanium [Ti]","Tungsten [W]","Uranium [U]","Vanadium [V]","Xenon [Xe]","Ytterbium [Yb]","Yttrium [Y]","Zinc [Zn]","Zirconium [Zr]"];
                            $val = ["none","Ac","Al","Am","Sb","Ar","As","At","Ba","Bk","Be","Bi","Bh","B","Br","Cd","Ca","Cf","C","Ce","Cs","Cl","Cr","Co","Cu","Cm","Db","Dy","Es","Er","Eu","Fm","F","Fr","Gd","Ga","Ge","Au","Hf","Hs","He","Ho","H","In","I","Ir","Fe","Kr","La","Lr","Pb","Li","Lu","Mg","Mn","Mt","Md","Hg","Mo","Nd","Ne","Np","Ni","Nb","N","No","Os","O","Pd","P","Pt","Pu","Po","K","Pr","Pm","Pa","Ra","Rn","Re","Rh","Rb","Ru","Rf","Sm","Sc","Sg","Se","Si","Ag","Na","Sr","S","Ta","Tc","Te","Tb","Tl","Th","Tm","Sn","Ti","W","U","V","Xe","Yb","Y","Zn","Zr"];
                            optionsList($val,$name,isset(request()->elem)?request()->elem:'none');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="f" class="font-s-14 text-blue">{!! $lang['3'] !!}:</label>
                    <input type="text" step="any" name="f" id="f" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->f)?request()->f:'CO2' }}" />
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
                    <div class="w-full  p-3 rounded-lg mt-3">
                        <div class="w-full">
                            <p><strong>{!! $lang['4'] !!}</strong></p>
                            <p class="text-[#119154] text-3xl font-semibold mt-2">{!! $detail['mass'] !!}</p>
                            
                            <div class="w-full overflow-auto mt-2">{!! $detail['table'] !!}</div>
                    
                            <p class="mt-3"><strong>{!! $lang['5'] !!}</strong></p>
                            <p class="text-lg mt-1">{!! $detail['hill'] !!}</p>
                    
                            <p class="mt-1"><strong>{!! $lang['6'] !!}</strong></p>
                            <p class="text-lg mt-1">{!! $detail['emp'] !!}</p>
                    
                            <p class="mt-1"><strong>{!! $lang['7'] !!}</strong></p>
                            <p class="text-lg mt-1">{!! $detail['n_mass'] !!}</p>
                    
                            <p class="mt-1"><strong>{!! $lang['8'] !!}</strong></p>
                            <p class="text-lg mt-1">{!! $detail['m_mass'] !!}</p>
                    
                            <div class="w-full mt-2">
                                <p><strong>{!! $lang['9'] !!}:</strong></p>
                                <div id="myChart" class="w-[250px] h-[250px]"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        @if(isset($detail))
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script>
                function loadMathJax(){
                    var mathJaxScript = document.createElement('script');
                    mathJaxScript.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
                    document.querySelector('head').appendChild(mathJaxScript);
                
                    var mathJaxConfigScript = document.createElement('script');
                    mathJaxConfigScript.type = "text/x-mathjax-config";
                    mathJaxConfigScript.textContent = 'MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}}); function MJrerender() { MathJax.Hub.Queue(["Rerender", MathJax.Hub]); }';
                    document.querySelector('head').appendChild(mathJaxConfigScript);
                }

                window.addEventListener('load', function () {
                    loadMathJax();
                });

                google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart(){
                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hours per Day'],
                        @php
                            for($i=0; $i < count($detail['elem'])-1; $i++){
                                echo "['".$detail['elem'][$i]."', ".round($detail['frac'][$i],2)."],";
                            }
                        @endphp
                    ]);
                    var options = { 
                        colors: ['#99EA48', '#ff9f00'],
                        backgroundColor: 'transparent',
                        titlePosition: 'none',
                        legend: 'none',
                        is3D: true,
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('myChart'));
                    chart.draw(data, options);
                }
            </script>
        @endif
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('#cmpnd').addEventListener('change', function() {
                    var cmpnd = this.value;
                    if (document.querySelector('#elem').value !== 'none') {
                        document.querySelector('#elem').value = 'none';
                    }
                    document.querySelector('#f').value = cmpnd;
                });

                document.querySelector('#elem').addEventListener('change', function() {
                    var elem = this.value;
                    if (document.querySelector('#cmpnd').value !== 'none') {
                        document.querySelector('#cmpnd').value = 'none';
                    }
                    document.querySelector('#f').value = elem;
                });

                document.querySelector('#f').addEventListener('input', function() {
                    if (document.querySelector('#elem').value !== 'none') {
                        document.querySelector('#elem').value = 'none';
                    }
                    if (document.querySelector('#cmpnd').value !== 'none') {
                        document.querySelector('#cmpnd').value = 'none';
                    }
                });
            });
        </script>
    @endpush
</form>