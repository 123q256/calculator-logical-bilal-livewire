<div>
    <style>
        .tagsUnit { background-color: #2845F5 !important; color: white !important; }
        .tab-inactive { background-color: white; color: #374151; }
        .tab-inactive:hover { background-color: #f3f4f6; }
        .unit-dropdown { max-height: 250px; overflow-y: auto; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <div class="bg-red-50 text-red-600 p-4 rounded-xl border border-red-100 font-semibold mb-6 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ $error }}
                </div>
            @endif

            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                {{-- Tab Switcher --}}
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 mb-6">
                    <div class="lg:w-1/2 w-full p-1">
                        <button type="button" 
                            wire:click="setTab('first')"
                            class="w-full py-3 px-4 rounded-lg font-bold transition-all duration-300 {{ $tab == 'first' ? 'tagsUnit shadow-md' : 'tab-inactive' }}">
                            {{ $lang['1'] }}
                        </button>
                    </div>
                    <div class="lg:w-1/2 w-full p-1">
                        <button type="button" 
                            wire:click="setTab('second')"
                            class="w-full py-3 px-4 rounded-lg font-bold transition-all duration-300 {{ $tab == 'second' ? 'tagsUnit shadow-md' : 'tab-inactive' }}">
                            {{ $lang['2'] }}
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    {{-- Tab 1: Direct Calculation --}}
                    @if($tab == 'first')
                        <div class="grid grid-cols-1 gap-6 bg-white p-6 rounded-lg">
                            <div class="space-y-2">
                                <label class="label font-bold text-gray-700">I want to calculate:</label>
                                <select wire:model.live="find" class="input">
                                    <option value="1">{{ $lang['3'] }}</option>
                                    <option value="2">{{ $lang['4'] }}</option>
                                    <option value="3">{{ $lang['5'] }}</option>
                                </select>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Field: Amount of Solute (Shown if find is 1 or 3) --}}
                                @if($find == '1' || $find == '3')
                                    <div class="space-y-2">
                                        <label class="label font-bold text-gray-700">{{ $lang['4'] }}:</label>
                                        <div class="relative w-full" x-data="{ open: false }">
                                            <input type="number" step="any" wire:model="amount_solute" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $amount_solute_unit }} ▾</label>
                                            <div x-show="open" @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[50%] mt-1 right-0" style="display: none;">
                                                @foreach(['mol' => 'mole (mol)', 'mmol' => 'millimole (mmol)', 'µmol' => 'micormole (µmol)', 'nmol' => 'nanomol (nmol)', 'pmol' => 'picomol (pmol)'] as $unit => $label)
                                                <p class="p-1 hover:bg-gray-100 cursor-pointer text-xs" wire:click="$set('amount_solute_unit', '{{ $unit }}'); open = false">{{ $label }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Field: Mass of Solvent (Shown if find is 1 or 2) --}}
                                @if($find == '1' || $find == '2')
                                    <div class="space-y-2">
                                        <label class="label font-bold text-gray-700">{{ $lang['5'] }}:</label>
                                        <div class="relative w-full" x-data="{ open: false }">
                                            <input type="number" step="any" wire:model="mass_solvent" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $mass_solvent_unit }} ▾</label>
                                            <div x-show="open" @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[50%] mt-1 right-0" style="display: none;">
                                                @foreach(['µg' => 'micrograms (µg)', 'mg' => 'milligrams (mg)', 'g' => 'grams (g)', 'dag' => 'decagrams (dag)', 'kg' => 'kilograms (kg)', 'oz' => 'ounces (oz)', 'lbs' => 'pounds (lbs)'] as $unit => $label)
                                                <p class="p-1 hover:bg-gray-100 cursor-pointer text-xs" wire:click="$set('mass_solvent_unit', '{{ $unit }}'); open = false">{{ $label }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Field: Molality (Shown if find is 2 or 3) --}}
                                @if($find == '2' || $find == '3')
                                    <div class="space-y-2">
                                        <label class="label font-bold text-gray-700">{{ $lang['3'] }}:</label>
                                        <div class="relative w-full" x-data="{ open: false }">
                                            <input type="number" step="any" wire:model="molality" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $molality_unit }} ▾</label>
                                            <div x-show="open" @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[60%] mt-1 right-0" style="display: none;">
                                                @foreach(['mol / µg' => 'mol / micrograms (µg)', 'mol / mg' => 'mol / milligrams (mg)', 'mol / g' => 'mol / grams (g)', 'mol / dag' => 'mol / decagrams (dag)', 'mol / kg' => 'mol / kilograms (kg)', 'mol / oz' => 'mol / ounces (oz)', 'mol / lbs' => 'mol / pounds (lbs)'] as $unit => $label)
                                                <p class="p-1 hover:bg-gray-100 cursor-pointer text-xs" wire:click="$set('molality_unit', '{{ $unit }}'); open = false">{{ $label }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Tab 2: Molarity Conversion --}}
                    @if($tab == 'second')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-6 rounded-lg">
                            <div class="space-y-2">
                                <label class="label font-bold text-gray-700">{{ $lang['7'] }} [ρ]:</label>
                                <div class="relative w-full" x-data="{ open: false }">
                                    <input type="number" step="any" wire:model="density" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">unit ▾</label>
                                    <div x-show="open" @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-full mt-1 right-0 unit-dropdown shadow-xl" style="display: none;">
                                        @php
                                            $densityUnits = [
                                                "0.01" => "Centigram per Liter", "0.1" => "Decigram per Liter", "10" => "Dekagram per Liter",
                                                "0.0002" => "Earth's Density (mean)", "1E-15" => "Femtogram per Liter", "0.0023" => "Grain per Foot³",
                                                "0.0143" => "Grain per Gallon (UK)", "0.0171" => "Grain per Gallon (US)", "1000" => "Gram per Centimeter³",
                                                "1" => "Gram per Liter", "0.001" => "Gram per Meter³", "1000" => "Gram per Milliliter",
                                                "1000000" => "Gram per Millimeter³", "100" => "Hectogram per Liter", "1000000" => "Kilogram per Centimeter³",
                                                "1000" => "Kilogram per Cubic Decimeter", "1000" => "Kilogram per Liter", "1" => "Kilogram per Meter³",
                                                "1000000" => "Megagram per Liter", "1E-6" => "Microgram per Liter", "0.001" => "Milligram per Centimeter³",
                                                "1E-6" => "Milligram per Liter", "1000" => "Milligram per Meter³", "1E-9" => "Milligram per Millimeter³",
                                                "1.0012" => "Nanogram per Liter", "6.236" => "Ounce per Foot³", "7.4892" => "Ounce per Gallon (UK)",
                                                "1729.994" => "Ounce per Gallon (US)", "1E-12" => "Picogram per Liter", "16.0185" => "Pound per Foot³",
                                                "99.7764" => "Pound per Gallon (UK)", "119.8264" => "Pound per Gallon (US)", "27679.9047" => "Pound per Inch³",
                                                "0.5933" => "Pound per Yard³", "515.3788" => "Slug per Foot³", "890574.5976" => "Slug per Inch³",
                                                "19.0881" => "Slug per Yard³", "1328.9392" => "Ton (long) per Yard³", "1186.5529" => "Ton (short) per Yard³"
                                            ];
                                        @endphp
                                        @foreach($densityUnits as $val => $name)
                                            <p class="p-1 hover:bg-gray-100 cursor-pointer text-xs" wire:click="$set('density_unit', '{{ $val }}'); open = false">{{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="label font-bold text-gray-700">{{ $lang['8'] }}:</label>
                                <div class="relative w-full" x-data="{ open: false }">
                                    <input type="number" step="any" wire:model="molecular_mass_solute" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">unit ▾</label>
                                    <div x-show="open" @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-full mt-1 right-0 unit-dropdown shadow-xl" style="display: none;">
                                        @php
                                            $massUnits = [
                                                "4155.8441558" => "Assarion (Biblical Roman)", "6.022136651E+26" => "Atomic Mass Unit", "1E+21" => "Attogram",
                                                "175.43859649" => "Bekan (Biblical Hebrew)", "5000" => "Carat", "100000" => "Centigram",
                                                "6.022173643E+26" => "Dalton", "100" => "Decagram", "10000" => "Decigram",
                                                "259.74025974" => "Denarius (Biblical Roman)", "2.990800894E+26" => "Didrachma (Biblical Greek)",
                                                "2.990800894E+26" => "Drachma (Biblical Greek)", "1.67336010709505E-25" => "Earth's Mass",
                                                "9.10938970730895E-31" => "Electron Mass (Rest)", "1E-15" => "Exagram", "1E+15" => "Femtogram",
                                                "1E+18" => "Gamma", "1000000000" => "Gerah (Biblical Hebrew)", "1754.3859649" => "Gigagram",
                                                "5.978633201E+26" => "Gigatonne", "15432.358353" => "Grain", "1000" => "Gram", "10" => "Hectogram",
                                                "0.0196841306" => "Hundredweight(UK)", "5.26592943654555E-28" => "Jupiter Mass", "1" => "Kilogram",
                                                "0.1019716213" => "Kilo-Force Square Second Per Foot", "0.0022046226218" => "KiloPound",
                                                "1E-06" => "Kiloton(Metric)", "33246.753247" => "Lepton (Biblical Roman)", "0.001" => "Megragram",
                                                "1E-09" => "Megatonne", "1000000000" => "Microgram", "1000000" => "Milligram",
                                                "2.9411764706" => "Mina(Biblical Greek)", "5.309172492E+27" => "Muon Mass", "1000000000000" => "Nanogram",
                                                "5.970403753E+26" => "Neutron Mass", "35.27396195" => "Ounce", "643.01493137" => "Pennyweight",
                                                "1E-12" => "Petagram", "1E+15" => "Picogram", "45940892.448" => "Planck Mass", "2.6792288807" => "Pound",
                                                "70.988848424" => "Poundal", "0.0685217658999999" => "Pound-Force Square Second Per Foot",
                                                "5.978633201E+26" => "Proton Mass", "16623.376623" => "Quadrans(Biblical Romans)",
                                                "0.0787365221999998" => "Quarter(UK)", "0.0881849049000002" => "Quarter(US)", "0.01" => "Quintal",
                                                "0.000984206527611061" => "Scruple(Apotherapy)", "87.719298246" => "Shekel(Biblical Hebrew)",
                                                "0.0685217658999999" => "Slug", "1.988E+30" => "Solar Mass", "0.1574730444" => "Stone (UK)",
                                                "0.1763698097" => "Stone (US)", "5.02765208647562E-31" => "Sun's Mass", "0.0490196078" => "Talent(Biblical Greek)",
                                                "0.0292397661" => "Talent(Biblical Hebrew)", "1E-09" => "Teragram", "73.529411765" => "Tetradrachma(Biblical Greek)",
                                                "30.612244898" => "Ton (Assay)(UK)", "34.285710367" => "Ton (Assay)(US)",
                                                "0.000984206527611061" => "Ton(Long)", "0.001" => "Ton(Metric)", "0.0011023113" => "Ton(Short)", "0.001" => "Tonne"
                                            ];
                                        @endphp
                                        @foreach($massUnits as $val => $name)
                                            <p class="p-1 hover:bg-gray-100 cursor-pointer text-xs" wire:click="$set('molecular_mass_solute_unit', '{{ $val }}'); open = false">{{ $name }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-full space-y-2">
                                <label class="label font-bold text-gray-700">{{ $lang['3'] }}:</label>
                                <div class="relative w-full" x-data="{ open: false }">
                                    <input type="number" step="any" wire:model="molality" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">{{ $molality_unit }} ▾</label>
                                    <div x-show="open" @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[50%] mt-1 right-0 shadow-lg" style="display: none;">
                                        @foreach(['mol / µg' => 'mol / micrograms (µg)', 'mol / mg' => 'mol / milligrams (mg)', 'mol / g' => 'mol / grams (g)', 'mol / dag' => 'mol / decagrams (dag)', 'mol / kg' => 'mol / kilograms (kg)', 'mol / oz' => 'mol / ounces (oz)', 'mol / lbs' => 'mol / pounds (lbs)'] as $unit => $label)
                                        <p class="p-1 hover:bg-gray-100 cursor-pointer text-xs" wire:click="$set('molality_unit', '{{ $unit }}'); open = false">{{ $label }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="flex justify-center mt-6">
                @if ($type == 'calculator')
                    @include('inc.button')
                @elseif ($type == 'widget')
                    @include('inc.widget-button')
                @endif
            </div>
        </div>

        <hr class="border-gray-200">

        {{-- Result Section --}}
        @if ($detail)
            <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-xl space-y-6 mt-6">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif

                    <div class="mt-6 text-center space-y-2">
                        @if($detail['type'] == "first")
                            @if($detail['method'] == "1")
                                <p class="text-black font-bold text-lg">{{ $lang['3'] }}</p>
                                <p class="text-[18px] md:text-[30px] font-black text-[#119154]">
                                    {{ number_format($detail['molality'], 2, '.', '') }}
                                    <span class="text-xl md:text-lg font-bold"> (mol/kg)</span>
                                </p>
                            @elseif($detail['method'] == "2")
                                <p class="text-black font-bold text-lg">{{ $lang['4'] }}</p>
                                <p class="text-[18px] md:text-[30px] font-black text-[#119154]">
                                    {{ number_format($detail['amount_of_solute'], 2, '.', '') }}
                                    <span class="text-xl md:text-lg font-bold"> (mol)</span>
                                </p>
                            @elseif($detail['method'] == "3")
                                <p class="text-black font-bold text-lg">{{ $lang['5'] }}</p>
                                <p class="text-[18px] md:text-[30px] font-black text-[#119154]">
                                    {{ number_format($detail['amount_of_solvent'], 2, '.', '') }}
                                    <span class="text-xl md:text-lg font-bold"> (kg)</span>
                                </p>
                            @endif
                        @elseif($detail['type'] == "second")
                            <p class="text-black font-bold text-lg">{{ $lang['6'] }} [M]</p>
                            <p class="text-[18px] md:text-[30px] font-black text-[#119154]">
                                {{ number_format($detail['molality'] * 0.001, 5, '.', '') }}
                                <span class="text-xl md:text-lg font-bold"> (m/L)</span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
