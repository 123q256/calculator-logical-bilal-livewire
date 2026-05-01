<div>
    <style>
        .units-list {
            max-height: 250px;
            overflow: auto;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            padding-left: 5px;
        }
        [x-cloak] { display: none !important; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">

                    <div class="col-span-12 flex">
                        @if ($device == 'mobile')
                            <label class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        @endif
                        <div class="w-full py-2">
                            <div class="mt-2 mt-lg-2 calEnthalpy md:flex lg:flex justify-between align-items-center">
                                @if ($device == 'desktop')
                                    <label class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                                @endif
                                <p class="mb-1 mb-lg-0">
                                    <input type="radio" wire:model.live="calEnthalpy" id="enthalpyFormula" value="enthalpyFormula">
                                    <label for="enthalpyFormula" class="font-s-14 text-blue pe-lg-2 pe-2">{{ $lang['2'] }}:</label>
                                </p>
                                <p>
                                    <input type="radio" wire:model.live="calEnthalpy" id="reactionScheme" value="reactionScheme">
                                    <label for="reactionScheme" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                                </p>
                            </div>
                        </div>
                    </div>

                    @if($calEnthalpy == 'enthalpyFormula')
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="calFrom" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <div class="w-100 py-2">
                            <i class="fas fa-sort-down color_blue"></i>
                            <select wire:model.live="calFrom" id="calFrom" class="input calFrom">
                                <option value="byStandard">{{ $lang['5'] }}</option>
                                <option value="byChange">{{ $lang['6'] }}</option>
                            </select>
                        </div>
                    </div>
                    @endif

                    @if($calEnthalpy == 'reactionScheme')
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="calFrom1" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                        <div class="w-100 py-2">
                            <i class="fas fa-sort-down color_blue"></i>
                            <select wire:model.live="calFrom1" id="calFrom1" class="input calFrom1">
                                <option value="2">2 {{ $lang['7'] }}</option>
                                <option value="3">3 {{ $lang['7'] }}</option>
                            </select>
                        </div>
                    </div>
                    @endif

                    <div class="col-span-12 items-center flex text-center justify-center py-2">
                        @if($calEnthalpy == 'enthalpyFormula')
                            <div><strong>ΔH = ΔQ + p * ΔV</strong></div>
                        @else
                            <div><strong>a<sub>n</sub>A + b<sub>n</sub>B + c<sub>n</sub>C → d<sub>n</sub>D + e<sub>n</sub>E + f<sub>n</sub>F</strong></div>
                        @endif
                    </div>

                    <div class="col-span-12 inp_wrap">
                        <div class="grid grid-cols-12 mt-3 gap-4">
                            @if($calEnthalpy == 'enthalpyFormula')
                                @if($calFrom == 'byStandard')
                                    {{-- Q1 --}}
                                    <div class="col-span-6 space-y-2">
                                        <label for="q1" class="font-s-14 text-blue">{{ $lang['8'] }}</label>
                                        <div class="relative w-full" x-data="{ open: false }">
                                            <input type="number" wire:model="q1" id="q1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $q1_unit }} ▾</label>
                                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 " x-cloak>
                                                @foreach(['J', 'kJ', 'MJ', 'Wh', 'kWh', 'ft-lbs', 'kcal', 'eV'] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('q1_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Q2 --}}
                                    <div class="col-span-6 space-y-2">
                                        <label for="q2" class="font-s-14 text-blue">{{ $lang['9'] }}</label>
                                        <div class="relative w-full" x-data="{ open: false }">
                                            <input type="number" wire:model="q2" id="q2" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $q2_unit }} ▾</label>
                                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 " x-cloak>
                                                @foreach(['J', 'kJ', 'MJ', 'Wh', 'kWh', 'ft-lbs', 'kcal', 'eV'] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('q2_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    {{-- V1 --}}
                                    <div class="col-span-6 space-y-2">
                                        <label for="v1" class="font-s-14 text-blue">{{ $lang['10'] }}</label>
                                        <div class="relative w-full" x-data="{ open: false }">
                                            <input type="number" wire:model="v1" id="v1" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $v1_unit }} ▾</label>
                                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 units-list" x-cloak>
                                                @foreach(['mm3', 'cm3', 'dm3', 'm3', 'cu_in', 'cu_ft', 'cu_yd', 'ml', 'cl', 'liters', 'us_gal', 'uk_gal', 'us_fl_oz', 'uk_fl_oz', 'cups', 'tbsp', 'tsp', 'us_qt', 'uk_qt', 'us_pt', 'uk_pt'] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('v1_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    {{-- V2 --}}
                                    <div class="col-span-6 space-y-2">
                                        <label for="v2" class="font-s-14 text-blue">{{ $lang['11'] }}</label>
                                        <div class="relative w-full" x-data="{ open: false }">
                                            <input type="number" wire:model="v2" id="v2" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $v2_unit }} ▾</label>
                                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 units-list" x-cloak>
                                                @foreach(['mm3', 'cm3', 'dm3', 'm3', 'cu_in', 'cu_ft', 'cu_yd', 'ml', 'cl', 'liters', 'us_gal', 'uk_gal', 'us_fl_oz', 'uk_fl_oz', 'cups', 'tbsp', 'tsp', 'us_qt', 'uk_qt', 'us_pt', 'uk_pt'] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('v2_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    {{-- Change Q --}}
                                    <div class="col-span-6 space-y-2">
                                        <label for="changeQ" class="font-s-14 text-blue">{{ $lang['12'] }}</label>
                                        <div class="relative w-full" x-data="{ open: false }">
                                            <input type="number" wire:model="changeQ" id="changeQ" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $changeQ_unit }} ▾</label>
                                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 units-list" x-cloak>
                                                @foreach(['J', 'kJ', 'MJ', 'Wh', 'kWh', 'ft-lbs', 'kcal', 'eV'] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('changeQ_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Change V --}}
                                    <div class="col-span-6 space-y-2">
                                        <label for="changeV" class="font-s-14 text-blue">{{ $lang['13'] }}</label>
                                        <div class="relative w-full" x-data="{ open: false }">
                                            <input type="number" wire:model="changeV" id="changeV" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $changeV_unit }} ▾</label>
                                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 units-list" x-cloak>
                                                @foreach(['mm3', 'cm3', 'dm3', 'm3', 'cu_in', 'cu_ft', 'cu_yd', 'ml', 'cl', 'liters', 'us_gal', 'uk_gal', 'us_fl_oz', 'uk_fl_oz', 'cups', 'tbsp', 'tsp', 'us_qt', 'uk_qt', 'us_pt', 'uk_pt'] as $u)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('changeV_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                {{-- Pressure --}}
                                <div class="col-span-6 space-y-2">
                                    <label for="p" class="font-s-14 text-blue">{{ $lang['14'] }}</label>
                                    <div class="relative w-full" x-data="{ open: false }">
                                        <input type="number" wire:model="p" id="p" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $p_unit }} ▾</label>
                                        <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 units-list" x-cloak>
                                            @foreach(['Pa', 'bar', 'psi', 'at', 'atm', 'torr', 'hpa', 'kPa', 'MPa', 'GPa', 'in_hg', 'mmhg'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('p_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($calEnthalpy == 'reactionScheme')
                                <div class="col-span-12 font-semibold text-lg text-blue mt-2">{{ $lang['16'] }}</div>
                                {{-- Reactant A --}}
                                <div class="col-span-6 space-y-2">
                                    <label class="font-s-14 text-blue"> a<sub>n</sub> {{ $lang['15'] }}:</label>
                                    <input type="number" step="any" wire:model.live="a_n" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                </div>
                                <div class="col-span-6 space-y-2">
                                    <label class="font-s-14 text-blue">{{ $lang['16'] }}</label>
                                    <div class="relative w-full" x-data="{ open: false }">
                                        <input type="number" step="any" wire:model="rA" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $rA_values }} ▾</label>
                                        <div x-show="open" @click.away="open = false" class="absolute z-20 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 units-list" x-cloak>
                                            @foreach ($DATA_A as $name => $val)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('rA_values', '{{ $name }}'); open = false">{{ $name }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                {{-- Reactant B --}}
                                <div class="col-span-6 space-y-2">
                                    <label class="font-s-14 text-blue"> b<sub>n</sub> {{ $lang['15'] }}:</label>
                                    <input type="number" step="any" wire:model.live="b_n" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                </div>
                                <div class="col-span-6 space-y-2">
                                    <label class="font-s-14 text-blue">{{ $lang['16'] }} B</label>
                                    <div class="relative w-full" x-data="{ open: false }">
                                        <input type="number" step="any" wire:model="rB" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $rB_values }} ▾</label>
                                        <div x-show="open" @click.away="open = false" class="absolute z-20 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 units-list" x-cloak>
                                            @foreach ($DATA_A as $name => $val)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('rB_values', '{{ $name }}'); open = false">{{ $name }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                @if($calFrom1 == '3')
                                {{-- Reactant C --}}
                                <div class="col-span-6 space-y-2">
                                    <label class="font-s-14 text-blue"> c<sub>n</sub> {{ $lang['15'] }}:</label>
                                    <input type="number" step="any" wire:model.live="c_n" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                </div>
                                <div class="col-span-6 space-y-2">
                                    <label class="font-s-14 text-blue">{{ $lang['16'] }} C</label>
                                    <div class="relative w-full" x-data="{ open: false }">
                                        <input type="number" step="any" wire:model="rC" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $rC_values }} ▾</label>
                                        <div x-show="open" @click.away="open = false" class="absolute z-20 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 units-list" x-cloak>
                                            @foreach ($DATA_A as $name => $val)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('rC_values', '{{ $name }}'); open = false">{{ $name }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="col-span-12 font-semibold text-lg text-blue mt-4">{{ $lang['17'] }}</div>
                                {{-- Product D --}}
                                <div class="col-span-6 space-y-2">
                                    <label class="font-s-14 text-blue"> d<sub>n</sub> {{ $lang['15'] }}:</label>
                                    <input type="number" step="any" wire:model.live="d_n" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                </div>
                                <div class="col-span-6 space-y-2">
                                    <label class="font-s-14 text-blue">{{ $lang['17'] }} D</label>
                                    <div class="relative w-full" x-data="{ open: false }">
                                        <input type="number" step="any" wire:model="pD" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $pD_values }} ▾</label>
                                        <div x-show="open" @click.away="open = false" class="absolute z-20 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 units-list" x-cloak>
                                            @foreach ($DATA_A as $name => $val)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('pD_values', '{{ $name }}'); open = false">{{ $name }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                {{-- Product E --}}
                                <div class="col-span-6 space-y-2">
                                    <label class="font-s-14 text-blue"> e<sub>n</sub> {{ $lang['15'] }}:</label>
                                    <input type="number" step="any" wire:model.live="e_n" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                </div>
                                <div class="col-span-6 space-y-2">
                                    <label class="font-s-14 text-blue">{{ $lang['17'] }} E</label>
                                    <div class="relative w-full" x-data="{ open: false }">
                                        <input type="number" step="any" wire:model="pE" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $pE_values }} ▾</label>
                                        <div x-show="open" @click.away="open = false" class="absolute z-20 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 units-list" x-cloak>
                                            @foreach ($DATA_A as $name => $val)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('pE_values', '{{ $name }}'); open = false">{{ $name }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                @if($calFrom1 == '3')
                                {{-- Product F --}}
                                <div class="col-span-6 space-y-2">
                                    <label class="font-s-14 text-blue"> f<sub>n</sub> {{ $lang['15'] }}:</label>
                                    <input type="number" step="any" wire:model.live="f_n" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                </div>
                                <div class="col-span-6 space-y-2">
                                    <label class="font-s-14 text-blue">{{ $lang['17'] }} F</label>
                                    <div class="relative w-full" x-data="{ open: false }">
                                        <input type="number" step="any" wire:model="pF" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $pF_values }} ▾</label>
                                        <div x-show="open" @click.away="open = false" class="absolute z-20 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 units-list" x-cloak>
                                            @foreach ($DATA_A as $name => $val)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('pF_values', '{{ $name }}'); open = false">{{ $name }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @endif

                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        <hr>

        @if($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result" x-data="{
            ans: {{ $detail['ans'] }},
            initial_enth: {{ $detail['initial_enth'] ?? 0 }},
            final_enth: {{ $detail['Final_enth'] ?? 0 }},
            unit1: '{{ $calEnthalpy == 'enthalpyFormula' ? 'J' : 'kJ' }}',
            unit2: 'J',
            unit3: 'J',
            factors: {
                'J': 1,
                'kJ': 0.001,
                'MJ': 0.000001,
                'Wh': 0.000277778,
                'kWh': 0.000000277778,
                'ft-lbs': 0.737562,
                'kcal': 0.000239006,
                'eV': 6242000000000000000
            },
            convert(val, unit) {
                return (val * this.factors[unit]).toFixed(6).replace(/\.?0+$/, '');
            }
        }">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full lg:w-[60%]">
                            <table class="w-full ">
                                <tr>
                                    <td class="py-2 border-b" width="50%">{{ $lang[18] }}</td>
                                    <td class="py-2 border-b text-end circle_result" x-text="convert(ans, unit1)"></td>
                                    <td class="py-2 border-b relative text-center" width="25%">
                                        <div class="relative w-full mt-[7px]">
                                            <label class="cursor-pointer input-unit text-sm underline" @click="open1 = !open1" x-data="{open1: false}">
                                                <span x-text="unit1"></span> ▾
                                                <div class="units absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open1" @click.away="open1 = false" x-cloak>
                                                    @foreach(['J', 'kJ', 'MJ', 'Wh', 'kWh', 'ft-lbs', 'kcal', 'eV'] as $u)
                                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click.stop="unit1 = '{{ $u }}'; open1 = false">{{ $u }}</p>
                                                    @endforeach
                                                </div>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                @if($calEnthalpy == 'enthalpyFormula')
                                <tr>
                                    <td class="py-2 border-b" width="50%">{{ $lang[27] }}</td>
                                    <td class="py-2 border-b text-end circle_result" x-text="convert(initial_enth, unit2)"></td>
                                    <td class="py-2 border-b position-relative text-center" width="25%">
                                        <div class="relative w-full mt-[7px]">
                                            <label class="cursor-pointer input-unit text-sm underline" @click="open2 = !open2" x-data="{open2: false}">
                                                <span x-text="unit2"></span> ▾
                                                <div class="units absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open2" @click.away="open2 = false" x-cloak>
                                                    @foreach(['J', 'kJ', 'MJ', 'Wh', 'kWh', 'ft-lbs', 'kcal', 'eV'] as $u)
                                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click.stop="unit2 = '{{ $u }}'; open2 = false">{{ $u }}</p>
                                                    @endforeach
                                                </div>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%">{{ $lang[28] }}</td>
                                    <td class="py-2 border-b text-end circle_result" x-text="convert(final_enth, unit3)"></td>
                                    <td class="py-2 border-b position-relative text-center" width="20%">
                                        <div class="relative w-full mt-[7px]">
                                            <label class="cursor-pointer input-unit text-sm underline" @click="open3 = !open3" x-data="{open3: false}">
                                                <span x-text="unit3"></span> ▾
                                                <div class="units absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open3" @click.away="open3 = false" x-cloak>
                                                    @foreach(['J', 'kJ', 'MJ', 'Wh', 'kWh', 'ft-lbs', 'kcal', 'eV'] as $u)
                                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click.stop="unit3 = '{{ $u }}'; open3 = false">{{ $u }}</p>
                                                    @endforeach
                                                </div>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        <div class="w-full">
                            <div class="mt-2">
                                @if($calEnthalpy === 'enthalpyFormula')
                                    @php $check = $detail['check']; @endphp
                                    <p class="mt-2 font-s-18"><strong class="text-blue">{{$lang['19']}}:</strong></p>
                                    <p class="mt-2">{{$lang['20']}}</p>
                                    <p class="mt-2">ΔH = ΔQ + p * ΔV</p>
                                    @if($check === 'byStandard')
                                        @php
                                            $q1 = $detail['q1']; $q2 = $detail['q2']; $v1 = $detail['v1']; $v2 = $detail['v2']; $p = $detail['p'];
                                        @endphp
                                        <p class="mt-2">{{$lang['21']}}</p>
                                        <p class="mt-2">ΔH = (Q₂ - Q₁) + p * (V₂ - V₁)</p>
                                        <p class="mt-2">{{$lang['22']}}</p>
                                        <p class="mt-2">Q₁ = {{$q1}}, Q₂ = {{$q2}}, V₁ = {{$v1}}, V₂ = {{$v2}}, p = {{$p}}, ΔH = ?</p>
                                        <p class="mt-2"><strong>{{$lang['23']}}</strong></p>
                                        <p class="mt-2">ΔH = (Q₂ - Q₁) + p * (V₂ - V₁)</p>
                                        <p class="mt-2">ΔH = ({{$q2}} - {{$q1}}) + ({{$p}}) * ({{$v2}} - {{$v1}})</p>
                                        <p class="mt-2">ΔH = ({{$q2-$q1}}) + ({{$p}}) * ({{$v2-$v1}})</p>
                                        <p class="mt-2">ΔH = ({{$q2-$q1}}) + ({{$p*($v2-$v1)}})</p>
                                        <p class="mt-2">ΔH = <strong>{{$detail['ans']}}</strong></p>
                                    @elseif($check === 'byChange')
                                        @php
                                            $changeQ = $detail['changeQ']; $changeV = $detail['changeV']; $p = $detail['p'];
                                        @endphp
                                        <p class="mt-2">{{ $lang['22']}}</p>
                                        <p class="mt-2">ΔQ = {{$changeQ}}, ΔV = {{$changeV}}, p = {{$p}}, ΔH = ?</p>
                                        <p class="mt-2"><strong>{{$lang['23']}}</strong></p>
                                        <p class="mt-2">ΔH = ΔQ + p * ΔV</p>
                                        <p class="mt-2">ΔH = ({{$changeQ}}) + ({{$p}}) * ({{$changeV}})</p>
                                        <p class="mt-2">ΔH = ({{$changeQ}}) + ({{$p*($changeV)}})</p>
                                        <p class="mt-2">ΔH = <strong>{{$detail['ans']}}</strong></p>
                                    @endif
                                @elseif($calEnthalpy === 'reactionScheme' && isset($detail['reaction']))
                                    @php
                                        $reaction = $detail['reaction']; $text = $detail['text']; $text_vals = $detail['text_vals'];
                                    @endphp
                                    <p class="mt-2"><strong>{{ $lang['25']}}:</strong></p>
                                    <p class="mt-2">{{ $reaction}}</p>
                                    <p class="mt-2"><strong>{{ $lang['26']}}:</strong></p>
                                    <p class="mt-2">
                                        @for($i=0; $i < count($text)-1; $i++)
                                            {{$text[$i]}}: H<sub>f</sub> = {{$text_vals[$i]}} kJ<br>
                                        @endfor
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </form>
</div>
