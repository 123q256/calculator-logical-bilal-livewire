<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2 relative">
                        <label for="find" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                        <select wire:model.live="find" id="find" class="input border border-gray-300 p-2 rounded-lg w-full">
                            <option value="v1">{!! $lang['2'] !!} (V₁)</option>
                            <option value="t1">{!! $lang['3'] !!} (T₁)</option>
                            <option value="v2">{!! $lang['4'] !!} (V₂)</option>
                            <option value="t2">{!! $lang['5'] !!} (T₂)</option>
                            <option value="p">{!! $lang['6'] !!} (p)</option>
                            <option value="n">{!! $lang['7'] !!} (n)</option>
                        </select>
                    </div>

                    @if (in_array($find, ['t1', 'v2', 't2', 'p', 'n']))
                        <div class="space-y-2 v1">
                            <label for="v1" class="font-s-14 text-blue">{{ $lang['2'] }} (V₁)</label>
                            <div class="relative w-full">
                        <input type="number" step="any" wire:model="v1" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <button type="button" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('v1_unit')">{{ $v1_unit }} ▾</button>
                                @if ($openDropdown === 'v1_unit')
                                    <div wire:key="dropdown-v1" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[100%] mt-1 right-0 shadow-lg">
                                        @foreach (['mm³' => 'cubic millimeters (mm³)', 'cm³' => 'cubic centimeters (cm³)', 'dm³' => 'cubic decimeters (dm³)', 'm³' => 'cubic meters (m³)', 'cu in' => 'cubic inches (cu in)', 'cu ft' => 'cubic feet (cu ft)', 'cu yd' => 'cubic yards (cu yd)', 'ml' => 'milliliters (ml)', 'liters' => 'liters'] as $val => $label)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('v1_unit', '{{ $val }}')">{{ $label }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if (in_array($find, ['v1', 'v2', 't2', 'p', 'n']))
                        <div class="space-y-2 t1">
                            <label for="t1" class="font-s-14 text-blue">{{ $lang['3'] }} (T₁)</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model="t1" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <button type="button" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('t1_unit')">{{ $t1_unit }} ▾</button>
                                @if ($openDropdown === 't1_unit')
                                    <div wire:key="dropdown-t1" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[100%] mt-1 right-0 shadow-lg">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('t1_unit', '°C')">Celsius (°C)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('t1_unit', '°F')">Fahrenheit (°F)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('t1_unit', 'K')">Kelvin (K)</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if (in_array($find, ['v1', 't1', 't2']))
                        <div class="space-y-2 v2">
                            <label for="v2" class="font-s-14 text-blue">{{ $lang['4'] }} (V₂)</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model="v2" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <button type="button" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('v2_unit')">{{ $v2_unit }} ▾</button>
                                @if ($openDropdown === 'v2_unit')
                                    <div wire:key="dropdown-v2" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[100%] mt-1 right-0 shadow-lg">
                                        @foreach (['mm³' => 'cubic millimeters (mm³)', 'cm³' => 'cubic centimeters (cm³)', 'dm³' => 'cubic decimeters (dm³)', 'm³' => 'cubic meters (m³)', 'cu in' => 'cubic inches (cu in)', 'cu ft' => 'cubic feet (cu ft)', 'cu yd' => 'cubic yards (cu yd)', 'ml' => 'milliliters (ml)', 'liters' => 'liters'] as $val => $label)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('v2_unit', '{{ $val }}')">{{ $label }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if (in_array($find, ['v1', 't1', 'v2']))
                        <div class="space-y-2 t2">
                            <label for="t2" class="font-s-14 text-blue">{{ $lang['5'] }} (T₂)</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model="t2" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <button type="button" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('t2_unit')">{{ $t2_unit }} ▾</button>
                                @if ($openDropdown === 't2_unit')
                                    <div wire:key="dropdown-t2" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[100%] mt-1 right-0 shadow-lg">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('t2_unit', '°C')">Celsius (°C)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('t2_unit', '°F')">Fahrenheit (°F)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('t2_unit', 'K')">Kelvin (K)</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if (in_array($find, ['n']))
                        <div class="space-y-2 p">
                            <label for="p" class="font-s-14 text-blue">{{ $lang['4'] }} (p)</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model="p" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <button type="button" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('p_unit')">{{ $p_unit }} ▾</button>
                                @if ($openDropdown === 'p_unit')
                                    <div wire:key="dropdown-p" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[100%] mt-1 right-0 shadow-lg overflow-y-auto max-h-60">
                                        @foreach (['Pa', 'bar', 'psi', 'at', 'atm', 'Torr', 'hPa', 'kPa', 'MPa', 'GPa', 'in Hg', 'mmHg'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('p_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if (in_array($find, ['p']))
                        <div class="space-y-2 n relative">
                            <label for="n" class="font-s-14 text-blue">{!! $lang['7'] !!} (n):</label>
                            <input type="number" step="any" wire:model="n" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                            <span class="absolute right-4 top-10 text-blue">mol</span>
                        </div>
                    @endif

                    @if (in_array($find, ['p', 'n']))
                        <div class="space-y-2 n relative">
                            <label for="R" class="font-s-14 text-blue">{!! $lang['8'] !!} (R):</label>
                            <input type="number" step="any" wire:model="R" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                            <span class="absolute right-4 top-10 text-blue text-xs">J⋅K⁻¹⋅mol⁻¹</span>
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
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full p-3 radius-10 mt-3">
                            <div class="col-12 col-lg-8 text-center mx-auto">
                                <p class="text-[16px]">
                                    <strong>
                                        @if (isset($detail['v1'])) {{ $lang['9'] }} (v₁)
                                        @elseif(isset($detail['t1'])) {{ $lang['10'] }} (T₁)
                                        @elseif(isset($detail['v2'])) {{ $lang['11'] }} (v₂)
                                        @elseif(isset($detail['t2'])) {{ $lang['12'] }} (T₂)
                                        @elseif(isset($detail['p_val'])) {{ $lang['6'] }} (p)
                                        @elseif(isset($detail['n_val'])) {{ $lang['13'] }} (n)
                                        @endif
                                    </strong>
                                </p>
                                <p class="text-[36px]">
                                    <strong class="text-green font-s-32">
                                        @if (isset($detail['v1'])) {{ $detail['v1'] }} <span class="text-green font-s-22">m³</span>
                                        @elseif(isset($detail['t1'])) {{ $detail['t1'] }} <span class="text-green font-s-22">K</span>
                                        @elseif(isset($detail['v2'])) {{ $detail['v2'] }} <span class="text-green font-s-22">m³</span>
                                        @elseif(isset($detail['t2'])) {{ $detail['t2'] }} <span class="text-green font-s-22">K</span>
                                        @elseif(isset($detail['p_val'])) {{ $detail['p_val'] }} <span class="text-green font-s-22">Pa</span>
                                        @elseif(isset($detail['n_val'])) {{ $detail['n_val'] }} <span class="text-green font-s-22">mol</span>
                                        @endif
                                    </strong>
                                </p>

                                @if (!isset($detail['p_val']) && !isset($detail['n_val']))
                                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 lg:gap-5 md:gap-5 gap-2 mt-4">
                                        <div class="bg-[#F6FAFC] text-black border radius-10 px-3 py-2">
                                            <p>{{ $lang['6'] }} (p)</p>
                                            <p><strong>{{ $detail['p'] }} pascals</strong></p>
                                        </div>
                                        <div class="bg-[#F6FAFC] text-black border radius-10 px-3 py-2">
                                            <p>{{ $lang['13'] }} (n)</p>
                                            <p><strong>{{ $detail['n'] }} mol</strong></p>
                                        </div>
                                    </div>
                                @endif

                                @if (isset($detail['v1']) || isset($detail['v2']))
                                    <p class="text-start font-s-18 mt-4"><strong>{{ $lang['14'] }}</strong></p>
                                    <div class="col-12 overflow-auto">
                                        <table class="w-full text-start" cellspacing="0">
                                            @foreach (['mm3' => 'cubic millimeters (mm³)', 'cm3' => 'cubic centimeters (cm³)', 'dm3' => 'cubic decimeters (dm³)', 'cu_in' => 'cubic inches (cu in)', 'cu_ft' => 'cubic feet (cu ft)', 'cu_yd' => 'cubic yards (cu yd)', 'cm3_ml' => 'milliliters (ml)', 'dm3_l' => 'liters (L)'] as $key => $label)
                                                <tr>
                                                    <td class="border-b py-2 pe-2">{{ isset($detail['v1']) ? $lang['9'] . ' (v₁)' : $lang['11'] . ' (v₂)' }}</td>
                                                    <td class='border-b py-2 ps-2'>{{ $detail[$key === 'cm3_ml' ? 'cm3' : ($key === 'dm3_l' ? 'dm3' : $key)] }} {{ $label }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                @elseif(isset($detail['t1']) || isset($detail['t2']))
                                    <p class="text-start font-s-18 mt-4"><strong>{{ $lang['14'] }}</strong></p>
                                    <div class="col-12 overflow-auto">
                                        <table class="w-full text-start" cellspacing="0">
                                            <tr>
                                                <td class="border-b py-2 pe-2">{{ isset($detail['t1']) ? $lang['10'] . ' (T₁)' : $lang['12'] . ' (T₂)' }}</td>
                                                <td class='border-b py-2 ps-2'>{{ $detail['c'] }} Celsius (°C)</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 pe-2">{{ isset($detail['t1']) ? $lang['10'] . ' (T₁)' : $lang['12'] . ' (T₂)' }}</td>
                                                <td class='py-2 ps-2'>{{ $detail['f'] }} Fahrenheit (°F)</td>
                                            </tr>
                                        </table>
                                    </div>
                                @elseif(isset($detail['p_val']))
                                    <p class="text-start font-s-18 mt-4"><strong>{{ $lang['14'] }}</strong></p>
                                    <div class="col-12 overflow-auto">
                                        <table class="w-full text-start" cellspacing="0">
                                            @foreach (['bar' => 'bars (bar)', 'psi' => 'pounds per square inch (psi)', 'at' => 'technical atmospheres (at)', 'atm' => 'standard atmospheres (atm)', 'torr' => 'torrs (Torr)', 'hpa' => 'hectopascals (hPa)', 'kpa' => 'kilopascals (kPa)', 'mpa' => 'megapascals (MPa)', 'gpa' => 'gigapascals (GPa)', 'in_hg' => 'inches of mercury (in Hg)', 'mmhg' => 'millimeters of mercury (mmHg)'] as $key => $label)
                                                <tr>
                                                    <td class="border-b py-2 pe-2">{{ $lang['6'] }}</td>
                                                    <td class='border-b py-2 ps-2'>{{ $detail[$key] }} {{ $label }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
