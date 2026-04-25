<div>
    <style>
    @media (max-width: 450px) {
        #loading {
            top: 50% !important;
            left: 40% !important;
        }
        .loader-text {
            top: 35% !important;
            left: 28% !important;
        }
    }
    #loading {
        position: absolute;
        top: 50%;
        left: 46%;
        transform: translate(-50%, -50%);
        z-index: 1;
        width: 70px;
        height: 70px;
        /* margin: -76px 0 0 -76px; */
        border: 10px solid #b1cff1;
        /* border: 10px solid transparent; */
        border-radius: 50%;
        border-top: 10px solid #036bd3;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .animate-bottom {
        position: relative;
        -webkit-animation-name: animatebottom;
        -webkit-animation-duration: 1s;
        animation-name: animatebottom;
        animation-duration: 1s
    }

    @-webkit-keyframes animatebottom {
        from { bottom:-100px; opacity:0 } 
        to { bottom:0px; opacity:1 }
    }

    @keyframes animatebottom { 
        from{ bottom:-100px; opacity:0 } 
        to{ bottom:0; opacity:1 }
    }
    #myTable {
        visibility: hidden;
    }
    .loader-text {
        margin-top: 10px; /* Adjust the spacing as needed */
        font-size: 16px; /* Adjust the font size as needed */
        color: #333; /* Adjust the text color as needed */
        position: absolute;
        top: 38%;
        left: 39%;
    }
</style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <div class="element">
                            <div class="add_related col-12 mx-auto">
                                <label for="element" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Select an Element' }}</label>
                                <div class="py-1">
                                    <select wire:model.live="element" class="input border border-gray-300 p-2 rounded-lg w-full" id="element">
                                        @foreach ([
                                            'H' => 'Hydrogen (H)', 'He' => 'Helium (He)', 'Li' => 'Lithium (Li)', 'Be' => 'Beryllium (Be)', 'B' => 'Boron (B)', 'C' => 'Carbon (C)',
                                            'N' => 'Nitrogen (N)', 'O' => 'Oxygen (O)', 'F' => 'Fluorine (F)', 'Ne' => 'Neon (Ne)', 'Na' => 'Sodium (Na)', 'Mg' => 'Magnesium (Mg)',
                                            'Al' => 'Aluminum (Al)', 'Si' => 'Silicon (Si)', 'P' => 'Phosphorus (P)', 'S' => 'Sulfur (S)', 'Cl' => 'Chlorine (Cl)', 'Ar' => 'Argon (Ar)',
                                            'K' => 'Potassium (K)', 'Ca' => 'Calcium (Ca)', 'Sc' => 'Scandium (Sc)', 'Ti' => 'Titanium (Ti)', 'V' => 'Vanadium (V)', 'Cr' => 'Chromium (Cr)',
                                            'Mn' => 'Manganese (Mn)', 'Fe' => 'Iron (Fe)', 'Co' => 'Cobalt (Co)', 'Ni' => 'Nickel (Ni)', 'Cu' => 'Copper (Cu)', 'Zn' => 'Zinc (Zn)',
                                            'Ga' => 'Gallium (Ga)', 'Ge' => 'Germanium (Ge)', 'As' => 'Arsenic (As)', 'Se' => 'Selenium (Se)', 'Br' => 'Bromine (Br)', 'Kr' => 'Krypton (Kr)',
                                            'Rb' => 'Rubidium (Rb)', 'Sr' => 'Strontium (Sr)', 'Y' => 'Yttrium (Y)', 'Zr' => 'Zirconium (Zr)', 'Nb' => 'Niobium (Nb)', 'Mo' => 'Molybdenum (Mo)',
                                            'Tc' => 'Technetium (Tc)', 'Ru' => 'Ruthenium (Ru)', 'Rh' => 'Rhodium (Rh)', 'Pd' => 'Palladium (Pd)', 'Ag' => 'Silver (Ag)', 'Cd' => 'Cadmium (Cd)',
                                            'In' => 'Indium (In)', 'Sn' => 'Tin (Sn)', 'Sb' => 'Antimony (Sb)', 'Te' => 'Tellurium (Te)', 'I' => 'Iodine (I)', 'Xe' => 'Xenon (Xe)',
                                            'Cs' => 'Cesium (Cs)', 'Ba' => 'Barium (Ba)', 'La' => 'Lanthanum (La)', 'Ce' => 'Cerium (Ce)', 'Pr' => 'Praseodymium (Pr)', 'Nd' => 'Neodymium (Nd)',
                                            'Pm' => 'Promethium (Pm)', 'Sm' => 'Samarium (Sm)', 'Eu' => 'Europium (Eu)', 'Gd' => 'Gadolinium (Gd)', 'Tb' => 'Terbium (Tb)', 'Dy' => 'Dysprosium (Dy)',
                                            'Ho' => 'Holmium (Ho)', 'Er' => 'Erbium (Er)', 'Tm' => 'Thulium (Tm)', 'Yb' => 'Ytterbium (Yb)', 'Lu' => 'Lutetium (Lu)', 'Hf' => 'Hafnium (Hf)',
                                            'Ta' => 'Tantalum (Ta)', 'W' => 'Tungsten (W)', 'Re' => 'Rhenium (Re)', 'Os' => 'Osmium (Os)', 'Iridium (Ir)', 'Pt' => 'Platinum (Pt)',
                                            'Au' => 'Gold (Au)', 'Hg' => 'Mercury (Hg)', 'Tl' => 'Thallium (Tl)', 'Pb' => 'Lead (Pb)', 'Bi' => 'Bismuth (Bi)', 'Po' => 'Polonium (Po)',
                                            'At' => 'Astatine (At)', 'Rn' => 'Radon (Rn)', 'Fr' => 'Francium (Fr)', 'Ra' => 'Radium (Ra)', 'Ac' => 'Actinium (Ac)', 'Th' => 'Thorium (Th)',
                                            'Pa' => 'Protactinium (Pa)', 'U' => 'Uranium (U)', 'Np' => 'Neptunium (Np)', 'Pu' => 'Plutonium (Pu)', 'Am' => 'Americium (Am)', 'Cm' => 'Curium (Cm)',
                                            'Bk' => 'Berkelium (Bk)', 'Cf' => 'Californium (Cf)', 'Es' => 'Einsteinium (Es)', 'Fm' => 'Fermium (Fm)', 'Md' => 'Mendelevium (Md)', 'No' => 'Nobelium (No)',
                                            'Lr' => 'Lawrencium (Lr)', 'Rf' => 'Rutherfordium (Rf)', 'Db' => 'Dubnium (Db)', 'Sg' => 'Seaborgium (Sg)', 'Bh' => 'Bohrium (Bh)', 'Hs' => 'Hassium (Hs)',
                                            'Mt' => 'Meitnerium (Mt)', 'Ds' => 'Darmstadtium (Ds)', 'Rg' => 'Roentgenium (Rg)', 'Cn' => 'Copernicium (Cn)', 'Nh' => 'Nihonium (Nh)', 'Fl' => 'Flerovium (Fl)',
                                            'Mc' => 'Moscovium (Mc)', 'Lv' => 'Livermorium (Lv)', 'Ts' => 'Tennessine (Ts)', 'Og' => 'Oganesson (Og)', 'Custom' => 'Custom'
                                        ] as $val => $name)
                                            <option value="{{ $val }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($element === 'Custom')
                        <div class="col-span-12 el_name mt-2">
                            <label for="el_name">{{ $lang['8'] ?? 'Enter an Element Symbol' }}</label>
                            <div class="w-full py-2 relative">
                                <input type="text" wire:model="el_name" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="e.g., Ca" />
                            </div>
                        </div>
                    @endif
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
                    <div class="rounded-lg flex items-center justify-center mt-3">
                        <div class="w-full">
                            <div class="w-full">
                                <p><strong>{{ $lang['2'] }}</strong></p>
                                <p><strong class="text-[#119154] text-[20px]">{{ $detail['res'][4] }}</strong></p>
                                <p class="mt-2"><strong>{{ $lang['3'] }}</strong></p>
                                <p><strong class="text-[#119154] text-[20px]">{{ $detail['res'][6] }}</strong></p>
                                <div class="w-full overflow-auto mt-2">
                                    <table class="w-full md:w-[80%] lg:w-[80%]" cellspacing="0">
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['4'] }}</td>
                                            <td class="text-end border-b py-2"><strong>{{ $detail['res'][0] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang['7'] }}</td>
                                            <td class="text-end border-b py-2"><strong>{{ $detail['res'][3] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['5'] }}</td>
                                            <td class="text-end border-b py-2"><strong>{{ $detail['res'][1] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['6'] }}</td>
                                            <td class="text-end border-b py-2"><strong>{{ $detail['res'][2] }}</strong></td>
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
</div>
