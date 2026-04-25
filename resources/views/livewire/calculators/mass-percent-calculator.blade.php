<div x-data="{ 
    mass_solute_unit: @entangle('mass_solute_unit'),
    mass_solvent_unit: @entangle('mass_solvent_unit'),
    mass_chemical_unit: @entangle('mass_chemical_unit'),
    total_mass_compound_unit: @entangle('total_mass_compound_unit'),
    openDropdown: null,
    toggleDropdown(name) {
        this.openDropdown = this.openDropdown === name ? null : name;
    }
}" @click.away="openDropdown = null">
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2 relative">
                        <label for="find" class="font-s-14 text-blue cursor-pointer">Find:</label>
                        <select wire:model.live="find" id="find" class="input cursor-pointer">
                            <option value="1">Mass Percentage for a Solute</option>
                            <option value="2">Mass of Solute</option>
                            <option value="3">Mass of Solvent</option>
                            <option value="4">Mass Percentage for a Chemical</option>
                            <option value="5">Mass of Chemical</option>
                            <option value="6">Total Mass of Compound</option>
                            <option value="7">Percent Composition</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-4 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    {{-- Selection 1, 3 --}}
                    <div class="space-y-2" x-show="$wire.find == '1' || $wire.find == '3'">
                        <label for="mass_solute" class="font-s-14 text-blue cursor-pointer">Mass of solute:</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model="mass_solute" id="mass_solute" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label @click="toggleDropdown('mass_solute_unit')" class="absolute cursor-pointer text-sm underline right-6 top-4" x-text="mass_solute_unit + ' ▾'"></label>
                            <div x-show="openDropdown === 'mass_solute_unit'" x-cloak class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[44%] mt-1 right-0">
                                @foreach(['µg'=>'micrograms (µg)', 'mg'=>'milligrams (mg)', 'g'=>'grams (g)', 'dag'=>'decagrams (dag)', 'kg'=>'kilograms (kg)', 't'=>'metric tons (t)', 'oz'=>'ounces (oz)', 'lbs'=>'pounds (lbs)'] as $unit => $label)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" @click="mass_solute_unit = '{{ $unit }}'; openDropdown = null">{{ $label }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Selection 1, 2 --}}
                    <div class="space-y-2" x-show="$wire.find == '1' || $wire.find == '2'">
                        <label for="mass_solvent" class="font-s-14 text-blue cursor-pointer">Mass of solvent:</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model="mass_solvent" id="mass_solvent" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label @click="toggleDropdown('mass_solvent_unit')" class="absolute cursor-pointer text-sm underline right-6 top-4" x-text="mass_solvent_unit + ' ▾'"></label>
                            <div x-show="openDropdown === 'mass_solvent_unit'" x-cloak class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[44%] mt-1 right-0">
                                @foreach(['µg'=>'micrograms (µg)', 'mg'=>'milligrams (mg)', 'g'=>'grams (g)', 'dag'=>'decagrams (dag)', 'kg'=>'kilograms (kg)', 't'=>'metric tons (t)', 'oz'=>'ounces (oz)', 'lbs'=>'pounds (lbs)'] as $unit => $label)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" @click="mass_solvent_unit = '{{ $unit }}'; openDropdown = null">{{ $label }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Selection 2, 3, 5, 6 --}}
                    <div class="space-y-2 relative" x-show="$wire.find == '2' || $wire.find == '3' || $wire.find == '5' || $wire.find == '6'" x-cloak>
                        <label for="mass_percentage" class="font-s-14 text-blue cursor-pointer">Mass Percentage:</label>
                        <input type="number" step="any" wire:model="mass_percentage" id="mass_percentage" class="input" placeholder="00" />
                        <span class="text-blue input_unit">%</span>
                    </div>

                    {{-- Selection 4, 6 --}}
                    <div class="space-y-2" x-show="$wire.find == '4' || $wire.find == '6'" x-cloak>
                        <label for="mass_chemical" class="font-s-14 text-blue cursor-pointer">Mass of chemical:</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model="mass_chemical" id="mass_chemical" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label @click="toggleDropdown('mass_chemical_unit')" class="absolute cursor-pointer text-sm underline right-6 top-4" x-text="mass_chemical_unit + ' ▾'"></label>
                            <div x-show="openDropdown === 'mass_chemical_unit'" x-cloak class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[44%] mt-1 right-0">
                                @foreach(['µg'=>'micrograms (µg)', 'mg'=>'milligrams (mg)', 'g'=>'grams (g)', 'dag'=>'decagrams (dag)', 'kg'=>'kilograms (kg)', 't'=>'metric tons (t)', 'oz'=>'ounces (oz)', 'lbs'=>'pounds (lbs)'] as $unit => $label)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" @click="mass_chemical_unit = '{{ $unit }}'; openDropdown = null">{{ $label }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Selection 4, 5 --}}
                    <div class="space-y-2" x-show="$wire.find == '4' || $wire.find == '5'" x-cloak>
                        <label for="total_mass_compound" class="font-s-14 text-blue cursor-pointer">Total mass of compound:</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model="total_mass_compound" id="total_mass_compound" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label @click="toggleDropdown('total_mass_compound_unit')" class="absolute cursor-pointer text-sm underline right-6 top-4" x-text="total_mass_compound_unit + ' ▾'"></label>
                            <div x-show="openDropdown === 'total_mass_compound_unit'" x-cloak class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[50%] md:w-[50%] w-[44%] mt-1 right-0">
                                @foreach(['µg'=>'micrograms (µg)', 'mg'=>'milligrams (mg)', 'g'=>'grams (g)', 'dag'=>'decagrams (dag)', 'kg'=>'kilograms (kg)', 't'=>'metric tons (t)', 'oz'=>'ounces (oz)', 'lbs'=>'pounds (lbs)'] as $unit => $label)
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" @click="total_mass_compound_unit = '{{ $unit }}'; openDropdown = null">{{ $label }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Selection 7 --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4" x-show="$wire.find == '7'" x-cloak>
                    @php
                        $elements = [
                            ['label' => '1st', 'value' => 'first_value', 'unit' => 'first_value_unit'],
                            ['label' => '2nd', 'value' => 'second_value', 'unit' => 'second_value_unit'],
                            ['label' => '3rd', 'value' => 'third_value', 'unit' => 'third_value_unit'],
                            ['label' => '4th', 'value' => 'four_value', 'unit' => 'four_value_unit'],
                            ['label' => '5th', 'value' => 'five_value', 'unit' => 'five_value_unit'],
                            ['label' => '6th', 'value' => 'six_value', 'unit' => 'six_value_unit'],
                        ];
                        $options = ["Atomic mass amu","H (Hydrogen)","He (Helium)","Li (Lithium)","Be (Beryllium)","B (Boron)","C (Carbon)","N (Nitrogen)","O (Oxygen)","F (Fluorine)","Ne (Neon)","Na (Sodium)","Mg (Magnesium)","Al (Aluminium)","Si (Silicon)","P (Phosphorus)","S (Sulfur)","Cl (Chlorine)","Ar (Argon)","K (Potassium)","Ca (Calcium)","Sc (Scandium)","Ti (Titanium)","V  (Vanadium)","Cr (Chromium)","Mn (Manganese)","Fe (Iron)","Co ( Cobalt)","Ni (Nickel)","Cu (Copper)","Zn (Zinc)"];
                    @endphp
                    @foreach($elements as $el)
                        <div class="space-y-2">
                            <label for="{{ $el['value'] }}" class="font-s-14 text-blue cursor-pointer">No of {{ $el['label'] }} elements atoms:</label>
                            <input type="number" step="any" wire:model="{{ $el['value'] }}" id="{{ $el['value'] }}" class="input" placeholder="00" />
                        </div>
                        <div class="space-y-2">
                            <label for="{{ $el['unit'] }}" class="font-s-14 text-blue">&nbsp;</label>
                            <select wire:model="{{ $el['unit'] }}" id="{{ $el['unit'] }}" class="input cursor-pointer">
                                @foreach($options as $opt)
                                    <option value="{{ $opt }}">{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    <hr>

    @if($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full p-3 radius-10 mt-3">
                        <div class="w-full">
                            @if($detail['method']=="1")
                                <p><strong>Mass Percentage</strong></p>
                                <p><strong class="text-[#119154] text-[30px]">{{ number_format($detail['mass_percent'], 4) }} <span class="text-[#119154] text-[20px]">(%)</span></strong></p>
                                <div class="lg:w-[80%] md:w-[80%] w-full overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <td class="border-b py-2 pe-2">Mass Solution</td>
                                            <td class="border-b py-2 ps-2"><strong>{{ number_format($detail['mass_solution'], 4) }} (kg)</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">Mass of Solute</td>
                                            <td class="border-b py-2 ps-2"><strong>{{ $mass_solute }} ({{ $mass_solute_unit }})</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pe-2">Mass of Solvent</td>
                                            <td class="py-2 ps-2"><strong>{{ $mass_solvent }} ({{ $mass_solvent_unit }})</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($detail['method']=="2")
                                <p><strong>Mass Solute</strong></p>
                                <p><strong class="text-[#119154] text-[30px]">{{ number_format($detail['mass_solute'], 4) }} <span class="text-[#119154] text-[20px]">(kg)</span></strong></p>
                                <div class="lg:w-[80%] md:w-[80%] w-full overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <td class="border-b py-2 pe-2">Mass Solution</td>
                                            <td class="border-b py-2 ps-2"><strong>{{ number_format($detail['mass_solution'], 4) }} (kg)</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">Mass of Solvent</td>
                                            <td class="border-b py-2 ps-2"><strong>{{ $mass_solvent }} ({{ $mass_solvent_unit }})</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pe-2">Mass Percentage</td>
                                            <td class="py-2 ps-2"><strong>{{ $mass_percentage }} (%)</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($detail['method']=="3")
                                <p><strong>Mass of Solvent</strong></p>
                                <p><strong class="text-[#119154] text-[30px]">{{ number_format($detail['mass_solvent'], 4) }} <span class="text-[#119154] text-[20px]">(kg)</span></strong></p>
                                <div class="lg:w-[80%] md:w-[80%] w-full overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <td class="border-b py-2 pe-2">Mass Solution</td>
                                            <td class="border-b py-2 ps-2"><strong>{{ number_format($detail['mass_solution'], 4) }} (kg)</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2 pe-2">Mass of Solute</td>
                                            <td class="border-b py-2 ps-2"><strong>{{ $mass_solute }} ({{ $mass_solute_unit }})</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pe-2">Mass Percentage</td>
                                            <td class="py-2 ps-2"><strong>{{ $mass_percentage }} (%)</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($detail['method']=="4")
                                <p><strong>Mass Percentage</strong></p>
                                <p><strong class="text-[#119154] text-[30px]">{{ number_format($detail['mass_percent'], 4) }} <span class="text-[#119154] text-[20px]">(%)</span></strong></p>
                                <div class="lg:w-[80%] md:w-[80%] w-full overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <td class="border-b py-2 pe-2">Mass of Chemical</td>
                                            <td class="border-b py-2 ps-2"><strong>{{ $mass_chemical }} ({{ $mass_chemical_unit }})</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pe-2">Total Mass of Compound</td>
                                            <td class="py-2 ps-2"><strong>{{ $total_mass_compound }} ({{ $total_mass_compound_unit }})</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($detail['method']=="5")
                                <p><strong>Mass of Chemical</strong></p>
                                <p><strong class="text-[#119154] text-[30px]">{{ number_format($detail['mass_of_chemical'], 4) }} <span class="text-[#119154] text-[20px]">(kg)</span></strong></p>
                                <div class="lg:w-[80%] md:w-[80%] w-full overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <td class="border-b py-2 pe-2">Mass Percentage</td>
                                            <td class="border-b py-2 ps-2"><strong>{{ $mass_percentage }} (%)</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pe-2">Total Mass of Compound</td>
                                            <td class="py-2 ps-2"><strong>{{ $total_mass_compound }} ({{ $total_mass_compound_unit }})</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($detail['method']=="6")
                                <p><strong>Total Mass of Compound</strong></p>
                                <p><strong class="text-[#119154] text-[30px]">{{ number_format($detail['total_mass_compound'], 4) }} <span class="text-[#119154] text-[20px]">(kg)</span></strong></p>
                                <div class="lg:w-[80%] md:w-[80%] w-full overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <td class="border-b py-2 pe-2">Mass Percentage</td>
                                            <td class="border-b py-2 ps-2"><strong>{{ $mass_percentage }} (%)</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 pe-2">Mass of Chemical</td>
                                            <td class="py-2 ps-2"><strong>{{ $mass_chemical }} ({{ $mass_chemical_unit }})</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($detail['method']=="7")
                                <div class="lg:w-[80%] md:w-[80%] w-full overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <th class="text-start border-b py-2 pe-2">Element</th>
                                            <th class="text-start border-b py-2 px-2">Number</th>
                                            <th class="text-start border-b py-2 px-2">Mass</th>
                                            <th class="text-start border-b py-2 ps-2">Percent Composition</th>
                                        </tr>
                                        @for($i=1; $i<=6; $i++)
                                            @if(isset($detail['value'.$i]))
                                                @php
                                                    $punk = ($i==1) ? $detail['punk'] : $detail['punk'.($i*2-2)];
                                                    $punk1 = ($i==1) ? $detail['punk1'] : $detail['punk'.($i*2-1)];
                                                    $perc = ($detail['call'] > 0) ? ($punk1 / $detail['call']) * 100 * $punk : 0;
                                                @endphp
                                                <tr>
                                                    <td class="border-b py-2 pe-2"><strong class="text-blue">{{ $detail['name'.$i] }}</strong></td>
                                                    <td class="border-b py-2 px-2"><strong>{{ $punk }}</strong></td>
                                                    <td class="border-b py-2 px-2"><strong>{{ number_format($punk1, 4) }}</strong></td>
                                                    <td class="border-b py-2 ps-2"><strong>{{ number_format($perc, 4) }} %</strong></td>
                                                </tr>
                                            @endif
                                        @endfor
                                        <tr>
                                            <td class="py-2 pe-2"><strong class="text-blue">Total</strong></td>
                                            <td></td>
                                            <td class="py-2 px-2"><strong>{{ number_format($detail['call'], 4) }}</strong></td>
                                            <td class="py-2 ps-2"><strong>100 %</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
