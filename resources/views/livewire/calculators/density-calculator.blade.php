<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto">
                <!-- Mode Switch (Simple/Advance) - Hidden as per screenshot which focus on Simple tabs -->
                 <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/3 w-full px-2 py-1">
                    <div class="bg-white flex-1 py-2 cursor-pointer text-center rounded-md transition-all {{ $to_cals === 'density' ? 'bg-blue-600 text-white shadow-md tagsUnit' : 'text-blue-600 hover:bg-gray-50' }}"
                        wire:click="setToCals('density')">
                        {{ $lang['4'] }}
                    </div>
                    </div>
                     <div class="lg:w-1/3 w-full px-2 py-1">
                    <div class="bg-white flex-1 py-2 cursor-pointer text-center rounded-md transition-all {{ $to_cals === 'volume' ? 'bg-blue-600 text-white shadow-md tagsUnit' : 'text-blue-600 hover:bg-gray-50' }}"
                        wire:click="setToCals('volume')">
                        {{ $lang['5'] }}
                    </div>
                    </div>
                     <div class="lg:w-1/3 w-full px-2 py-1">
                    <div class="bg-white flex-1 py-2 cursor-pointer text-center rounded-md transition-all {{ $to_cals === 'mass' ? 'bg-blue-600 text-white shadow-md tagsUnit' : 'text-blue-600 hover:bg-gray-50' }}"
                        wire:click="setToCals('mass')">
                        Weight/Mass
                    </div>
                    </div>
                </div>

                <!-- Simple Mode Inputs -->
                <div class="grid grid-cols-12 gap-x-4 gap-y-4">
                    <!-- Unit Selection based on Target -->
                    <div class="col-span-12">
                        @if($to_cals === 'density')
                            <label class="block font-s-14 text-gray-700 mb-1">{{ $lang['7'] }}</label>
                            <select wire:model.live="dens_unt" class="input w-full">
                                @foreach(["kg/m³","kg/dm³","kg/L","g/mL","t/m³","g/cm³","oz/cu_in","lb/cu_in","lb/cu_ft","lb/cu_yd","lb/us_gal", "g/l", "g/dl","mg/l"] as $u)
                                    <option value="{{ $u }}">{{ str_replace('_', ' ', $u) }}</option>
                                @endforeach
                            </select>
                        @elseif($to_cals === 'volume')
                            <label class="block font-s-14 text-gray-700 mb-1">{{ $lang['9'] }}</label>
                            <select wire:model.live="volu_unt" class="input w-full">
                                @foreach(["m³", "mm³", "cm³", "dm³", "cu_in", "cu_ft", "cu_yd", "ml", "cl", "liters", "hl", "US_gal", "UK_gal", "US_fl_oz", "UK_fl_oz", "cups", "tbsp", "tsp", "US_qt", "UK_qt", "US_pt", "UK_pt"] as $u)
                                    <option value="{{ $u }}">{{ str_replace('_', ' ', $u) }}</option>
                                @endforeach
                            </select>
                        @elseif($to_cals === 'mass')
                            <label class="block font-s-14 text-gray-700 mb-1">{{ $lang['10'] }}</label>
                            <select wire:model.live="mass_unt" class="input w-full">
                                @foreach(["kg", "µg", "mg", "g", "dag", "t", "gr", "dr", "oz", "lb", "stone", "US_ton", "Long_ton", "Earths", "Suns", "me", "mp", "mn", "u", "oz_t"] as $u)
                                    <option value="{{ $u }}">{{ str_replace('_', ' ', $u) }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    <!-- Input Fields Layout -->
                    @if($to_cals !== 'density')
                        <div class="col-span-12 lg:col-span-6">
                            <label class="block font-s-14 text-gray-700 mb-1">{{ $lang['4'] }}</label>
                            <div class="flex items-center gap-2">
                                <input type="number" wire:model.live="dns" step="any" class="input w-full rounded-r-none border-r-0" />
                                <select wire:model.live="sldns" class="input w-44 rounded-l-none border-l-0 bg-gray-50">
                                    @foreach(["kg/m³","kg/dm³","kg/L","g/mL","t/m³","g/cm³","oz/cu_in","lb/cu_in","lb/cu_ft","lb/cu_yd","lb/us_gal", "g/l", "g/dl","mg/l"] as $u)
                                        <option value="{{ $u }}">{{ str_replace('_', ' ', $u) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    @if($to_cals !== 'volume')
                        <div class="col-span-12 lg:col-span-6">
                            <label class="block font-s-14 text-gray-700 mb-1">{{ $lang['5'] }}</label>
                            <div class="flex items-center gap-2">
                                <input type="number" wire:model.live="vol" step="any" class="input w-full rounded-r-none border-r-0" />
                                <select wire:model.live="slvol" class="input w-44 rounded-l-none border-l-0 bg-gray-50">
                                    @foreach(["m³", "mm³", "cm³", "dm³", "cu_in", "cu_ft", "cu_yd", "ml", "cl", "liters", "hl", "US_gal", "UK_gal", "US_fl_oz", "UK_fl_oz", "cups", "tbsp", "tsp", "US_qt", "UK_qt", "US_pt", "UK_pt"] as $u)
                                        <option value="{{ $u }}">{{ str_replace('_', ' ', $u) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    @if($to_cals !== 'mass')
                        <div class="col-span-12 lg:col-span-6">
                            <label class="block font-s-14 text-gray-700 mb-1">Weight/Mass</label>
                            <div class="flex items-center gap-2">
                                <input type="number" wire:model.live="mas" step="any" class="input w-full rounded-r-none border-r-0" />
                                <select wire:model.live="slmas" class="input w-44 rounded-l-none border-l-0 bg-gray-50">
                                    @foreach(["kg", "µg", "mg", "g", "dag", "t", "gr", "dr", "oz", "lb", "stone", "US_ton", "Long_ton", "Earths", "Suns", "me", "mp", "mn", "u", "oz_t"] as $u)
                                        <option value="{{ $u }}">{{ str_replace('_', ' ', $u) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Lookup Section -->
                <div class="mt-8 text-center">
                    <button type="button" wire:click="toggleLookup" class="inline-flex items-center gap-2 font-bold text-gray-800 hover:text-blue-600 transition-colors">
                        Lookup For Density
                        <svg class="w-4 h-4 transform transition-transform {{ $showLookup ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>

                @if($showLookup)
                    <div class="mt-4 border rounded-lg bg-gray-50 p-6 space-y-4 border-gray-200">
                        <div>
                            <label class="block font-s-14 text-gray-700 mb-1">{{ $lang['7'] }}</label>
                            <select wire:model.live="dens_lok_unt" class="input w-full">
                                @foreach(["kg/m³","kg/dm³","kg/L","g/mL","t/m³","g/cm³","oz/cu_in","lb/cu_in","lb/cu_ft","lb/cu_yd","lb/us_gal", "g/l", "g/dl","mg/l"] as $u)
                                    <option value="{{ $u }}">{{ str_replace('_', ' ', $u) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-6">
                                <label class="block font-s-14 text-gray-700 mb-1">{{ $lang['15'] }}</label>
                                <select wire:model.live="slcat" class="input w-full">
                                    <option value="metals">{{ $lang['17'] }}</option>
                                    <option value="non-metals">{{ $lang['18'] }}</option>
                                    <option value="gases">{{ $lang['19'] }}</option>
                                    <option value="liquids">{{ $lang['20'] }}</option>
                                    <option value="astronomy">{{ $lang['21'] }}</option>
                                </select>
                            </div>
                            <div class="col-span-6">
                                <label class="block font-s-14 text-gray-700 mb-1">{{ $lang['16'] }}</label>
                                @if($slcat === 'metals')
                                    <select wire:model.live="slmtl" class="input w-full">
                                        @foreach(['aluminum', 'beryllium', 'brass', 'copper', 'gold', 'iron', 'lead', 'magnesium', 'mercury', 'nickel', 'platium', 'plutonium', 'potassium', 'silver', 'sodium', 'tin', 'titanium', 'uranium', 'zinc'] as $m)
                                            <option value="{{ $m }}">{{ ucfirst($m) }}</option>
                                        @endforeach
                                    </select>
                                @elseif($slcat === 'non-metals')
                                    <select wire:model.live="slmtl_no" class="input w-full">
                                        @foreach(['concrete', 'cork', 'diamond', 'ice', 'nylon', 'oak', 'pine', 'plastics', 'styrofoam', 'wood'] as $m)
                                            <option value="{{ $m }}">{{ ucfirst($m) }}</option>
                                        @endforeach
                                    </select>
                                @elseif($slcat === 'gases')
                                    <select wire:model.live="slgas" class="input w-full">
                                        @foreach(['air0', 'air20', 'carbon_dioxide0', 'carbon_dioxide20', 'carbon_monoxide0', 'carbon_monoxide20', 'hydrogen', 'helium', 'methane0', 'methane20', 'nitrogen0', 'nitrogen20', 'oxygen0', 'oxygen20', 'propane20', 'water_vapor'] as $m)
                                            <option value="{{ $m }}">{{ str_replace(['0', '20', '_'], ['', ' (20°C)', ' '], $m) }}</option>
                                        @endforeach
                                    </select>
                                @elseif($slcat === 'liquids')
                                    <select wire:model.live="sllqd" class="input w-full">
                                        @foreach(['cooking_oil', 'liquid_hydrogen', 'liquid_oxygen', 'water_fresh', 'water_salt'] as $m)
                                            <option value="{{ $m }}">{{ ucfirst(str_replace('_', ' ', $m)) }}</option>
                                        @endforeach
                                    </select>
                                @elseif($slcat === 'astronomy')
                                    <select wire:model.live="slastr" class="input w-full">
                                        @foreach(['earth', 'earth_core', 'sun_core_min', 'sun_core_max', 'super_black_hole', 'dwarf_star', 'atomic_nuclei', 'neutron_star', 'stellar_black_hole'] as $m)
                                            <option value="{{ $m }}">{{ ucfirst(str_replace('_', ' ', $m)) }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block font-s-14 text-gray-700 mb-2">Result</label>
                            <div class="bg-blue-50/50 p-6 rounded-lg text-center border border-blue-100">
                                <p class="text-sm font-bold text-gray-600 uppercase tracking-widest mb-1">{{ $lang['4'] }}</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $dens_lok_ans_val }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type=='widget')
                @include('inc.widget-button')
            @endif
        </div>
    <hr>

    @isset($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-8 space-y-6 result">
           <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg flex items-center justify-center">
                <div class="w-full my-5">
                    @php
                        $calc = request()->calc;
                        $appli=request()->appli;
                        $r_type=request()->r_type;
                    @endphp
                    <div class="w-full">
                        <div class="col s12 s12 dnsty_wrap">
                            <div class="text-center">
                                <p class="text-[18px]"><strong>
                                    @if ($detail["anstitle"] === "m") {{ $lang["6"] }}
                                    @elseif ($detail["anstitle"] === "v") {{ $lang["5"] }}
                                    @elseif ($detail["anstitle"] === "d") {{ $lang["4"] }}
                                    @endif
                                </strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2 d-inline-block my-3 wrap_dnst">
                                        <strong class="text-blue">{{ $detail["ansval"] }}</strong>
                                    </p>
                                </div>
                            </div>

                            @if ($calc === 'simple')
                                <div class="col-lg-8 font-s-18 mx-auto">
                                    <table class="w-full disp_tbl">
                                        <tr>
                                            <td class="border-b py-2 text-blue-600 font-semibold">{{ $lang["81"] }} :</td>
                                            <td class="border-b py-2 text-right font-bold">{{ $detail["ansval3"] }}</td>
                                        </tr>
                                    </table>
                                </div>
                            @else
                                <p class="font-s-18 font-bold text-center mb-4">{{ $lang["82"] }} :</p>
                                <div class="col-lg-8 font-s-18 mx-auto">
                                    <table class="w-full disp_tbl">
                                        @foreach([
                                            'mass' => $lang["6"],
                                            'lngt' => $lang["11"],
                                            'wdth' => $lang["12"],
                                            'hgth' => $lang["13"],
                                            'vlme' => $lang["5"],
                                            'ansval3' => $lang["81"]
                                        ] as $key => $label)
                                            @if(isset($detail[$key]))
                                                <tr class="border-b border-gray-100">
                                                    <td class="py-2 text-blue-600 font-semibold">{{ $label }} :</td>
                                                    <td class="py-2 text-right font-bold">{{ $detail[$key] }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                
                </div>
            </div>
           </div>
        </div>
    @endisset
       </form>
</div>
