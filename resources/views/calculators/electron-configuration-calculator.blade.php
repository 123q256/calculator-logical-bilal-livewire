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
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
         <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <div class="element">
                        <div class="add_related col-8 mx-auto">
                            <label for="lang" class="font-s-14 text-blue ">{{ $lang['1'] ?? "Select an Element" }}</label>
                            <div class="py-1">
                                <select class="input" name="element" id="element">
                                    @php
                                        function optionsList($arr1,$arr2,$unit){
                                        foreach($arr1 as $index => $name){
                                    @endphp
                                        <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                            {{ $arr2[$index] }}
                                        </option>
                                    @php
                                        }}
                                        $name = [
                                            "Hydrogen (H)",
                                            "Helium (He)",
                                            "Lithium (Li)",
                                            "Beryllium (Be)",
                                            "Boron (B)",
                                            "Carbon (C)",
                                            "Nitrogen (N)",
                                            "Oxygen (O)",
                                            "Fluorine (F)",
                                            "Neon (Ne)",
                                            "Sodium (Na)",
                                            "Magnesium (Mg)",
                                            "Aluminum (Al)",
                                            "Silicon (Si)",
                                            "Phosphorus (P)",
                                            "Sulfur (S)",
                                            "Chlorine (Cl)",
                                            "Argon (Ar)",
                                            "Potassium (K)",
                                            "Calcium (Ca)",
                                            "Scandium (Sc)",
                                            "Titanium (Ti)",
                                            "Vanadium (V)",
                                            "Chromium (Cr)",
                                            "Manganese (Mn)",
                                            "Iron (Fe)",
                                            "Cobalt (Co)",
                                            "Nickel (Ni)",
                                            "Copper (Cu)",
                                            "Zinc (Zn)",
                                            "Gallium (Ga)",
                                            "Germanium (Ge)",
                                            "Arsenic (As)",
                                            "Selenium (Se)",
                                            "Bromine (Br)",
                                            "Krypton (Kr)",
                                            "Rubidium (Rb)",
                                            "Strontium (Sr)",
                                            "Yttrium (Y)",
                                            "Zirconium (Zr)",
                                            "Niobium (Nb)",
                                            "Molybdenum (Mo)",
                                            "Technetium (Tc)",
                                            "Ruthenium (Ru)",
                                            "Rhodium (Rh)",
                                            "Palladium (Pd)",
                                            "Silver (Ag)",
                                            "Cadmium (Cd)",
                                            "Indium (In)",
                                            "Tin (Sn)",
                                            "Antimony (Sb)",
                                            "Tellurium (Te)",
                                            "Iodine (I)",
                                            "Xenon (Xe)",
                                            "Cesium (Cs)",
                                            "Barium (Ba)",
                                            "Lanthanum (La)",
                                            "Cerium (Ce)",
                                            "Praseodymium (Pr)",
                                            "Neodymium (Nd)",
                                            "Promethium (Pm)",
                                            "Samarium (Sm)",
                                            "Europium (Eu)",
                                            "Gadolinium (Gd)",
                                            "Terbium (Tb)",
                                            "Dysprosium (Dy)",
                                            "Holmium (Ho)",
                                            "Erbium (Er)",
                                            "Thulium (Tm)",
                                            "Ytterbium (Yb)",
                                            "Lutetium (Lu)",
                                            "Hafnium (Hf)",
                                            "Tantalum (Ta)",
                                            "Tungsten (W)",
                                            "Rhenium (Re)",
                                            "Osmium (Os)",
                                            "Iridium (Ir)",
                                            "Platinum (Pt)",
                                            "Gold (Au)",
                                            "Mercury (Hg)",
                                            "Thallium (Tl)",
                                            "Lead (Pb)",
                                            "Bismuth (Bi)",
                                            "Polonium (Po)",
                                            "Astatine (At)",
                                            "Radon (Rn)",
                                            "Francium (Fr)",
                                            "Radium (Ra)",
                                            "Actinium (Ac)",
                                            "Thorium (Th)",
                                            "Protactinium (Pa)",
                                            "Uranium (U)",
                                            "Neptunium (Np)",
                                            "Plutonium (Pu)",
                                            "Americium (Am)",
                                            "Curium (Cm)",
                                            "Berkelium (Bk)",
                                            "Californium (Cf)",
                                            "Einsteinium (Es)",
                                            "Fermium (Fm)",
                                            "Mendelevium (Md)",
                                            "Nobelium (No)",
                                            "Lawrencium (Lr)",
                                            "Rutherfordium (Rf)",
                                            "Dubnium (Db)",
                                            "Seaborgium (Sg)",
                                            "Bohrium (Bh)",
                                            "Hassium (Hs)",
                                            "Meitnerium (Mt)",
                                            "Darmstadtium (Ds)",
                                            "Roentgenium (Rg)",
                                            "Copernicium (Cn)",
                                            "Nihonium (Nh)",
                                            "Flerovium (Fl)",
                                            "Moscovium (Mc)",
                                            "Livermorium (Lv)",
                                            "Tennessine (Ts)",
                                            "Oganesson (Og)"
                                        ];
                                        $val = [
                                            'H',
                                            'He',
                                            'Li',
                                            'Be',
                                            'B',
                                            'C',
                                            'N',
                                            'O',
                                            'F',
                                            'Ne',
                                            'Na',
                                            'Mg',
                                            'Al',
                                            'Si',
                                            'P',
                                            'S',
                                            'Cl',
                                            'Ar',
                                            'K',
                                            'Ca',
                                            'Sc',
                                            'Ti',
                                            'V',
                                            'Cr',
                                            'Mn',
                                            'Fe',
                                            'Co',
                                            'Ni',
                                            'Cu',
                                            'Zn',
                                            'Ga',
                                            'Ge',
                                            'As',
                                            'Se',
                                            'Br',
                                            'Kr',
                                            'Rb',
                                            'Sr',
                                            'Y',
                                            'Zr',
                                            'Nb',
                                            'Mo',
                                            'Tc',
                                            'Ru',
                                            'Rh',
                                            'Pd',
                                            'Ag',
                                            'Cd',
                                            'In',
                                            'Sn',
                                            'Sb',
                                            'Te',
                                            'I',
                                            'Xe',
                                            'Cs',
                                            'Ba',
                                            'La',
                                            'Ce',
                                            'Pr',
                                            'Nd',
                                            'Pm',
                                            'Sm',
                                            'Eu',
                                            'Gd',
                                            'Tb',
                                            'Dy',
                                            'Ho',
                                            'Er',
                                            'Tm',
                                            'Yb',
                                            'Lu',
                                            'Hf',
                                            'Ta',
                                            'W',
                                            'Re',
                                            'Os',
                                            'Ir',
                                            'Pt',
                                            'Au',
                                            'Hg',
                                            'Tl',
                                            'Pb',
                                            'Bi',
                                            'Po',
                                            'At',
                                            'Rn',
                                            'Fr',
                                            'Ra',
                                            'Ac',
                                            'Th',
                                            'Pa',
                                            'U',
                                            'Np',
                                            'Pu',
                                            'Am',
                                            'Cm',
                                            'Bk',
                                            'Cf',
                                            'Es',
                                            'Fm',
                                            'Md',
                                            'No',
                                            'Lr',
                                            'Rf',
                                            'Db',
                                            'Sg',
                                            'Bh',
                                            'Hs',
                                            'Mt',
                                            'Ds',
                                            'Rg',
                                            'Cn',
                                            'Nh',
                                            'Fl',
                                            'Mc',
                                            'Lv',
                                            'Ts',
                                            'Og'];
                                        optionsList($val, $name, isset($_POST['element']) ? $_POST['element'] : "H");
                                    @endphp
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 el_name {{request()->element == 'Custom' ? '' : 'hidden '}}">
                    <label for="el_name">{{ $lang['8'] ?? "Enter an Element" }}</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="text" step="any" name="el_name" id="el_name" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->el_name)?request()->el_name:'Ca' }}" />
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result {{ isset($detail) ? '':'hidden' }}" id="resultSection" style="position:relative;height:500px">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center mt-3">
                    <div class="w-full"  >
                        <div class="w-full">
                            <p><strong>{{ $lang['2'] }}</strong></p>
                            <p><strong class="text-[#119154] text-[20px]">{{ $detail['res'][4] }}</strong></p>
                            <p class="mt-2"><strong>{{ $lang['3'] }}</strong></p>
                            <p><strong class="text-[#119154] text-[20px]">{{ $detail['res'][6] }}</strong></p>
                            <div class="w-full overflow-auto mt-2">
                                <table class="w-full md:w-[60%] lg:w-[60%] " cellspacing="0">
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
    @push('calculatorJS')
        <script>
            document.getElementById('element').addEventListener('change',function(){
                var elements = this.value;
                if(elements == 'Custom'){
                    document.querySelector('.el_name').style.display= 'block';
                    
                }else{
                    document.querySelector('.el_name').style.display= 'none';                    
                }
            });
        </script>
    @endpush
</form>