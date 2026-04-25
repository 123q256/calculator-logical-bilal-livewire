

    <div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2 relative">
                        <label for="cmpnd" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                        <select wire:model.live="cmpnd" id="cmpnd" class="input border border-gray-300 p-2 rounded-lg w-full">
                            <option value="none">Select Compound</option>
                            @foreach ([
                                'C19H29COOH' => 'Abietic Acid [C19H29COOH]', 'C12H10' => 'Acenaphthene [C12H10]', 'C12H6O2' => 'Acenaphthoquinone [C12H6O2]',
                                'C12H8' => 'Acenaphthylene [C12H8]', 'CH3CHO' => 'Acetaldehyde [CH3CHO]', 'C8H9NO' => 'Acetanilide [C8H9NO]',
                                'CH3COOH' => 'Acetic Acid [CH3COOH]', 'CH3COCH3' => 'Acetone [CH3COCH3]', 'CH3CN' => 'Acetonitrile [CH3CN]',
                                'C8H8O' => 'Acetophenone [C8H8O]', 'C6H5CHO' => 'Benzaldehyde [C6H5CHO]', 'C6H6' => 'Benzene [C6H6]',
                                'C6H5COOH' => 'Benzoic Acid [C6H5COOH]', 'C7H8O' => 'Benzyl Alcohol [C7H8O]', 'C6H5Br' => 'Bromobenzene [C6H5Br]',
                                'CH3Br' => 'Bromomethane [CH3Br]', 'C4H8O' => 'Butanal [C4H8O]', 'C4H10' => 'Butane [C4H10]',
                                'C4H10O' => '2-Butanol [C4H10O]', 'CO2' => 'Carbon Dioxide [CO2]', 'H2CO3' => 'Carbonic Acid [H2CO3]',
                                'C6H10O5' => 'Cellulose [C6H10O5]', 'C2HCl3O.H2O' => 'Chloral Hydrate [C2HCl3O.H2O]', 'C2H3Cl' => 'Chloroethene [C2H3Cl]',
                                'CHCl3' => 'Chloroform [CHCl3]', 'C3H4OH(COOH)3' => 'Citric Acid [C3H4OH(COOH)3]', 'C6H12' => 'Cyclohexane [C6H12]',
                                'C4H10O' => 'Diethyl Ether [C4H10O]', 'C2H6' => 'Ethane [C2H6]', 'CH3CH2OH' => 'Ethanol [CH3CH2OH]',
                                'C2H4' => 'Ethene [C2H4]', 'C21H20BrN3' => 'Ethidium Bromide [C21H20BrN3]', 'C4H8O2' => 'Ethyl Acetate [C4H8O2]',
                                'C2H7N' => 'Ethylamine [C2H7N]', 'C8H10' => 'Ethylbenzene [C8H10]', 'C2H4' => 'Ethylene [C2H4]',
                                'HOCH2CH2OH' => 'Ethylene Glycol [HOCH2CH2OH]', 'HCHO' => 'Formaldehyde [HCHO]', 'C6H12O6' => 'Glucose [C6H12O6]',
                                'C3H8O3' => 'Glycerol [C3H8O3]', 'NH2CH2COOH' => 'Glycine [NH2CH2COOH]', 'C7H16' => 'Heptane [C7H16]',
                                'C6H14' => 'Hexane [C6H14]', 'NH2CH(C4H5N2)COOH' => 'Histidine [NH2CH(C4H5N2)COOH]', 'C10H18O' => 'Isoborneol [C10H18O]',
                                'CH3CH(OH)COOH' => 'Lactic Acid [CH3CH(OH)COOH]', 'C12H22O11' => 'Lactose [C12H22O11]', 'C6H14N2O2' => 'Lysine [C6H14N2O2]',
                                'C4H2O3' => 'Maleic Anhydride [C4H2O3]', 'CH4' => 'Methane [CH4]', 'CH3OH' => 'Methanol [CH3OH]',
                                'C3H6O2' => 'Methyl Acetate [C3H6O2]', 'CH3CH(CH3)CH3' => '2-Methylpropene [CH3CH(CH3)CH3]', 'C10H8' => 'Naphthalene [C10H8]',
                                'C8H18' => 'Octane [C8H18]', 'C5H12' => 'Pentane [C5H12]', 'CH3CONHC6H4OC2H5' => 'Phenacetin [CH3CONHC6H4OC2H5]',
                                'C3H8' => 'Propane [C3H8]', 'CH3CH2COOH' => 'Propionic Acid [CH3CH2COOH]', 'C7H6O3' => 'Salicylie Acid [C7H6O3]',
                                'C8H8' => 'Styrene [C8H8]', 'C12H22O11' => 'Sucrose [C12H22O11]', 'C6H5CH3' => 'Toluene [C6H5CH3]',
                                'C5H11NO2' => 'Valine [C5H11NO2]', 'H2O' => 'Water [H2O]'
                            ] as $val => $name)
                                <option value="{{ $val }}">{!! $name !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label for="elem" class="font-s-14 text-blue">{!! $lang['2'] !!}:</label>
                        <select wire:model.live="elem" id="elem" class="input border border-gray-300 p-2 rounded-lg w-full">
                            <option value="none">Select Element</option>
                            @foreach ([
                                'Ac' => 'Actinium [Ac]', 'Al' => 'Aluminum [Al]', 'Am' => 'Americium [Am]', 'Sb' => 'Antimony [Sb]', 'Ar' => 'Argon [Ar]', 'As' => 'Arsenic [As]',
                                'At' => 'Astatine [At]', 'Ba' => 'Barium [Ba]', 'Bk' => 'Berkelium [Bk]', 'Be' => 'Beryllium [Be]', 'Bi' => 'Bismuth [Bi]', 'Bh' => 'Bohrium [Bh]',
                                'B' => 'Boron [B]', 'Br' => 'Bromine [Br]', 'Cd' => 'Cadmium [Cd]', 'Ca' => 'Calcium [Ca]', 'Cf' => 'Californium [Cf]', 'C' => 'Carbon [C]',
                                'Ce' => 'Cerium [Ce]', 'Cs' => 'Cesium [Cs]', 'Cl' => 'Chlorine [Cl]', 'Cr' => 'Chromium [Cr]', 'Co' => 'Cobalt [Co]', 'Cu' => 'Copper [Cu]',
                                'Cm' => 'Curium [Cm]', 'Db' => 'Dubnium [Db]', 'Dy' => 'Dysprosium [Dy]', 'Es' => 'Einsteinium [Es]', 'Er' => 'Erbium [Er]', 'Eu' => 'Europium [Eu]',
                                'Fm' => 'Fermium [Fm]', 'F' => 'Fluorine [F]', 'Fr' => 'Francium [Fr]', 'Gd' => 'Gadolinium [Gd]', 'Ga' => 'Gallium [Ga]', 'Ge' => 'Germanium [Ge]',
                                'Au' => 'Gold [Au]', 'Hf' => 'Hafnium [Hf]', 'Hs' => 'Hassium [Hs]', 'He' => 'Helium [He]', 'Ho' => 'Holmium [Ho]', 'H' => 'Hydrogen [H]',
                                'In' => 'Indium [In]', 'I' => 'Iodine [I]', 'Ir' => 'Iridium [Ir]', 'Fe' => 'Iron [Fe]', 'Kr' => 'Krypton [Kr]', 'La' => 'Lanthanum [La]',
                                'Lr' => 'Lawrencium [Lr]', 'Pb' => 'Lead [Pb]', 'Li' => 'Lithium [Li]', 'Lu' => 'Lutetium [Lu]', 'Mg' => 'Magnesium [Mg]', 'Mn' => 'Manganese [Mn]',
                                'Mt' => 'Meitnerium [Mt]', 'Md' => 'Mendelevium [Md]', 'Hg' => 'Mercury [Hg]', 'Mo' => 'Molybdenum [Mo]', 'Nd' => 'Neodymium [Nd]', 'Ne' => 'Neon [Ne]',
                                'Np' => 'Neptunium [Np]', 'Ni' => 'Nickel [Ni]', 'Nb' => 'Niobium [Nb]', 'N' => 'Nitrogen [N]', 'No' => 'Nobelium [No]', 'Os' => 'Osmium [Os]',
                                'O' => 'Oxygen [O]', 'Pd' => 'Palladium [Pd]', 'P' => 'Phosphorus [P]', 'Pt' => 'Platinum [Pt]', 'Pu' => 'Plutonium [Pu]', 'Po' => 'Polonium [Po]',
                                'K' => 'Potassium [K]', 'Pr' => 'Praseodymium [Pr]', 'Pm' => 'Promethium [Pm]', 'Pa' => 'Protactinium [Pa]', 'Ra' => 'Radium [Ra]', 'Rn' => 'Radon [Rn]',
                                'Re' => 'Rhenium [Re]', 'Rh' => 'Rhodium [Rh]', 'Rb' => 'Rubidium [Rb]', 'Ru' => 'Ruthenium [Ru]', 'Rf' => 'Rutherfordium [Rf]', 'Sm' => 'Samarium [Sm]',
                                'Sc' => 'Scandium [Sc]', 'Sg' => 'Seaborgium [Sg]', 'Se' => 'Selenium [Se]', 'Si' => 'Silicon [Si]', 'Ag' => 'Silver [Ag]', 'Na' => 'Sodium [Na]',
                                'Sr' => 'Strontium [Sr]', 'S' => 'Sulfur [S]', 'Ta' => 'Tantalum [Ta]', 'Tc' => 'Technetium [Tc]', 'Te' => 'Tellurium [Te]', 'Tb' => 'Terbium [Tb]',
                                'Tl' => 'Thallium [Tl]', 'Th' => 'Thorium [Th]', 'Tm' => 'Thulium [Tm]', 'Sn' => 'Tin [Sn]', 'Ti' => 'Titanium [Ti]', 'W' => 'Tungsten [W]',
                                'U' => 'Uranium [U]', 'V' => 'Vanadium [V]', 'Xe' => 'Xenon [Xe]', 'Yb' => 'Ytterbium [Yb]', 'Y' => 'Yttrium [Y]', 'Zn' => 'Zinc [Zn]', 'Zr' => 'Zirconium [Zr]'
                            ] as $val => $name)
                                <option value="{{ $val }}">{!! $name !!}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label for="f" class="font-s-14 text-blue">{!! $lang['3'] !!}:</label>
                        <input type="text" wire:model.live="f" id="f" class="input border border-gray-300 p-2 rounded-lg w-full" aria-label="input" placeholder="e.g., CO2" />
                    </div>
                </div>
            </div>
            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full p-3 rounded-lg mt-3">
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

                                <div class="w-full mt-2" 
                                     x-data="{ 
                                        draw() { 
                                            const rawData = this.$el.querySelector('#molarChart').getAttribute('data-chart');
                                            if (!rawData) return;
                                            const chartData = JSON.parse(rawData);
                                            if (typeof drawMolarChart === 'function') {
                                                drawMolarChart(chartData);
                                            }
                                        } 
                                     }" 
                                     x-init="setTimeout(() => draw(), 500)"
                                     @math-updated.window="setTimeout(() => draw(), 100)">
                                    <p><strong>{!! $lang['9'] !!}:</strong></p>
                                    <div id="molarChart" 
                                         data-chart='@json($detail["chartData"] ?? [])' 
                                         style="width: 250px; height: 250px; display: block;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset

        @push('calculatorJS')
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script>
                if (typeof google !== 'undefined' && google.charts) {
                    google.charts.load('current', {packages:['corechart']});
                }

                function drawMolarChart(chartData) {
                    if (!chartData || chartData.length === 0) return;
                    const el = document.getElementById('molarChart');
                    if (!el) return;

                    if (typeof google === 'undefined' || !google.visualization || !google.visualization.PieChart) {
                        setTimeout(() => drawMolarChart(chartData), 300);
                        return;
                    }

                    try {
                        const data = google.visualization.arrayToDataTable([
                            ['Element', 'Fraction'],
                            ...chartData
                        ]);
                        const chart = new google.visualization.PieChart(el);
                        chart.draw(data, {
                            colors: ['#99EA48', '#ff9f00', '#119154', '#036bd3', '#ff6b6b'],
                            backgroundColor: 'transparent',
                            titlePosition: 'none',
                            legend: 'none',
                            is3D: true,
                            width: 250,
                            height: 250
                        });
                    } catch (e) {
                        console.error('Chart error:', e);
                    }
                }

                window.addEventListener('math-updated', () => {
                    setTimeout(() => {
                        if (window.MathJax && window.MathJax.typesetPromise) {
                            MathJax.typesetClear();
                            MathJax.typesetPromise().catch(err => console.log(err));
                        }
                    }, 200);
                });
            </script>
        @endpush
    </form>
</div>
