<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-12 gap-4">
                    {{-- Conversion Type --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="conversion_type" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="conversion_type" id="conversion_type" class="input">
                                <option value="1">{{ $lang['2'] }}</option>
                                <option value="2">{{ $lang['3'] }}</option>
                                <option value="3">{{ $lang['4'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Shape / Choice Unit (Only for Type 1) --}}
                    @if($conversion_type == '1')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="choice_unit" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="choice_unit" id="choice_unit" class="input">
                                    <option value="cp">{{ $lang['6'] }}</option>
                                    <option value="cpf">{{ $lang['7'] }}</option>
                                    <option value="rec">{{ $lang['8'] }}</option>
                                    <option value="trap">{{ $lang['9'] }}</option>
                                    <option value="other">{{ $lang['10'] }}</option>
                                </select>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Dynamic Image --}}
                @if($this->getFlowImage())
                    <div class="flex justify-center py-4">
                        <img src="{{ $this->getFlowImage() }}" alt="Flow Rate Diagram" width="180" class="rounded-lg shadow-sm">
                    </div>
                @endif

                <div class="grid grid-cols-12 gap-6">
                    {{-- Type 3: Volume and Time --}}
                    @if($conversion_type == '3')
                        <div class="col-span-12 md:col-span-6">
                            <label for="volume" class="font-s-14 text-blue">{{ $lang['11'] }}</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="volume" id="volume" step="any" class="input" />
                                <label wire:click="toggleDropdown('volume_unit')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $volume_unit }} ▾</label>
                                @if($openDropdown == 'volume_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-60 overflow-auto">
                                        @foreach(['fluid-ounce', 'quart', 'pint', 'gallon', 'milliliter', 'liter', 'cubic-inch', 'cubic-foot', 'cubic-centimeter', 'cubic-meter'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('volume_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="time" class="font-s-14 text-blue">{{ $lang['18'] }}</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="time" id="time" step="any" class="input" />
                                <label wire:click="toggleDropdown('time_unit')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $time_unit }} ▾</label>
                                @if($openDropdown == 'time_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['second', 'minute', 'hour', 'day'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('time_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Diameter (Types 1 & 2) --}}
                    @if($conversion_type != '3' && in_array($choice_unit, ['cp', 'cpf', 'trap']) || $conversion_type == '2')
                        <div class="col-span-12 md:col-span-6">
                            <label for="diameter" class="font-s-14 text-blue">{{ $lang['19'] }} (d)</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="diameter" id="diameter" step="any" class="input" />
                                <label wire:click="toggleDropdown('diameter_unit')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $diameter_unit }} ▾</label>
                                @if($openDropdown == 'diameter_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['cm', 'm', 'in', 'ft', 'yd', 'mm'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('diameter_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Velocity (Type 1) --}}
                    @if($conversion_type == '1')
                        <div class="col-span-12 md:col-span-6">
                            <label for="velocity" class="font-s-14 text-blue">{{ $lang['20'] }}</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="velocity" id="velocity" step="any" class="input" />
                                <label wire:click="toggleDropdown('velocity_unit')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $velocity_unit }} ▾</label>
                                @if($openDropdown == 'velocity_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['ms' => 'm/s', 'fts' => 'ft/s'] as $key => $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('velocity_unit', '{{ $key }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Density (Types 1 & 2) --}}
                    @if($conversion_type != '3')
                        <div class="col-span-12 md:col-span-6">
                            <label for="density" class="font-s-14 text-blue">{{ $lang['21'] }}</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="density" id="density" step="any" class="input" />
                                <label wire:click="toggleDropdown('density_unit')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $density_unit }} ▾</label>
                                @if($openDropdown == 'density_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['kg' => 'kg/m³', 'lb1' => 'lb/cu ft', 'lb2' => 'lb/cu yd', 'g' => 'g/cm³'] as $key => $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('density_unit', '{{ $key }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Rectangular: Width & Height --}}
                    @if($conversion_type == '1' && $choice_unit == 'rec')
                        <div class="col-span-12 md:col-span-6">
                            <label for="width" class="font-s-14 text-blue">{{ $lang['24'] }}</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="width" id="width" step="any" class="input" />
                                <label wire:click="toggleDropdown('width_unit')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $width_unit }} ▾</label>
                                @if($openDropdown == 'width_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['cm', 'm', 'in', 'ft', 'yd', 'mm'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('width_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="height" class="font-s-14 text-blue">{{ $lang['23'] }}</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="height" id="height" step="any" class="input" />
                                <label wire:click="toggleDropdown('height_unit')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $height_unit }} ▾</label>
                                @if($openDropdown == 'height_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['cm', 'm', 'in', 'ft', 'yd', 'mm'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('height_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Partially Filled: Liquid Height --}}
                    @if($conversion_type == '1' && $choice_unit == 'cpf')
                        <div class="col-span-12 md:col-span-6">
                            <label for="filled" class="font-s-14 text-blue">{{ $lang['22'] }}</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="filled" id="filled" step="any" class="input" />
                                <label wire:click="toggleDropdown('filled_unit')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $filled_unit }} ▾</label>
                                @if($openDropdown == 'filled_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['cm', 'm', 'in', 'ft', 'yd', 'mm'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('filled_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Other: Area --}}
                    @if($conversion_type == '1' && $choice_unit == 'other')
                        <div class="col-span-12 md:col-span-6">
                            <label for="cross" class="font-s-14 text-blue">{{ $lang['25'] }} (A)</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="cross" id="cross" step="any" class="input" />
                                <label wire:click="toggleDropdown('cross_unit')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $cross_unit }} ▾</label>
                                @if($openDropdown == 'cross_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['cm²', 'm²', 'in²', 'ft²', 'yd²'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('cross_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Type 2: Pressure Related Fields --}}
                    @if($conversion_type == '2')
                        <div class="col-span-12 md:col-span-6">
                            <label for="pressure_start" class="font-s-14 text-blue">{{ $lang['28'] }}</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="pressure_start" id="pressure_start" step="any" class="input" />
                                <label wire:click="toggleDropdown('pressure_start_unit')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $pressure_start_unit }} ▾</label>
                                @if($openDropdown == 'pressure_start_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-60 overflow-auto">
                                        @foreach(['Pa', 'kPa', 'MPa', 'GPa', 'mbar', 'bar', 'atm', 'mmHg', 'mmH2O', 'psi'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('pressure_start_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="pressure_end" class="font-s-14 text-blue">{{ $lang['29'] }}</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="pressure_end" id="pressure_end" step="any" class="input" />
                                <label wire:click="toggleDropdown('pressure_end_unit')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $pressure_end_unit }} ▾</label>
                                @if($openDropdown == 'pressure_end_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-60 overflow-auto">
                                        @foreach(['Pa', 'kPa', 'MPa', 'GPa', 'mbar', 'bar', 'atm', 'mmHg', 'mmH2O', 'psi'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('pressure_end_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="pipe_length" class="font-s-14 text-blue">{{ $lang['30'] }}</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="pipe_length" id="pipe_length" step="any" class="input" />
                                <label wire:click="toggleDropdown('pipe_length_unit')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $pipe_length_unit }} ▾</label>
                                @if($openDropdown == 'pipe_length_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['cm', 'm', 'in', 'ft', 'yd', 'mm'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('pipe_length_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="dynamic_viscosity" class="font-s-14 text-blue">{{ $lang['31'] }}</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="dynamic_viscosity" id="dynamic_viscosity" step="any" class="input" />
                                <label wire:click="toggleDropdown('dynamic_viscosity_unit')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $dynamic_viscosity_unit }} ▾</label>
                                @if($openDropdown == 'dynamic_viscosity_unit')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['kgms' => 'kg/m·s', 'nsm2' => 'N·s/m²', 'pas' => 'Pa·s', 'cp' => 'cp'] as $key => $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('dynamic_viscosity_unit', '{{ $key }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
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
            <div class="rounded-lg ">
                <div class="w-full mt-3">
                    <div class="w-full overflow-auto  mt-2">
                        <table class="w-full">
                           <tr>
                              <td class="py-2 border-b" width="70%"><strong>{{ $lang[32] }} </strong></td>
                               <td class="py-2 border-b"> {{ $detail['volumetric_flow_rate'] }} (m³/s)</td>
                           </tr>
                           @if($detail['mass_flow_rate']!="")
                           <tr>
                             <td class="py-2 border-b" width="70%"><strong>{{ $lang[33] }} </strong></td>
                             <td class="py-2 border-b"> {{ $detail['mass_flow_rate'] }} (kg/s)</td>
                           </tr>
                         @endif
                        </table>
                        <table class="w-full">
                            <tr>
                                <td class="py-2 border-b">{{ $lang['32']}} (ft<sup>3</sup>)</td>
                                <td class="py-2 border-b"><strong>{{ $detail['volumetric_flow_rate']*35.3147 }} ft<sup>3</sup>/h ({{ $detail['volumetric_flow_rate']*127133 }} ft<sup>3</sup>/s )</strong></p></td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b">{{ $lang['32']}} (yd<sup>3</sup>)</td>
                                <td class="py-2 border-b"><strong>{{ $detail['volumetric_flow_rate']*4708.622229 }} yd<sup>3</sup>/h ({{ $detail['volumetric_flow_rate']*1.3079506193144 }} yd<sup>3</sup>/s )</strong></p></td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b">{{ $lang['32']}} ({{ $lang['15']}})</td>
                                <td class="py-2 border-b"><strong>{{ $detail['volumetric_flow_rate']*951019.38848933 }} gal/h ({{ $detail['volumetric_flow_rate']*15850.323 }} gal/min )</strong></p></td>   
                            </tr>
                            @if($detail['mass_flow_rate']!="")
                            <tr>
                                <td class="py-2 border-b">{{ $lang['33']}}</td>
                                <td class="py-2 border-b"><strong>{{ $detail['mass_flow_rate']*7937 }} lb/h ({{ $detail['mass_flow_rate']*132.28 }} lb/min )</strong></p></td>   
                            </tr>
                            @endif
                    </table>
                  </div>
                  
                </div>
            </div>
        </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
    @endpush
</div>
