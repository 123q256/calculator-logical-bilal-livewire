<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Fluid Substance --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 div_center">
                        <label for="fluid_substance" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Fluid Substance' }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="fluid_substance" class="input" id="fluid_substance">
                                <option value="custom">{{ $lang[2] ?? 'Custom' }}</option>
                                <option value="1.225|0.0000181|0.000014776">{{ $lang[3] ?? 'Air' }} (15 °C)</option>
                                <option value="1.184|0.0000186|0.00001571">{{ $lang[3] ?? 'Air' }} (25 °C)</option>
                                <option value="999.7|0.001308|0.0000013084">{{ $lang[4] ?? 'Water' }} (10 °C)</option>
                                <option value="988|0.0005471|0.0000005537">{{ $lang[4] ?? 'Water' }} (50 °C)</option>
                                <option value="965.3|0.000315|0.0000003263">{{ $lang[4] ?? 'Water' }} (90 °C)</option>
                                <option value="1060|0.0035|0.000003302">{{ $lang[5] ?? 'Blood' }} (37 °C)</option>
                                <option value="1450|0.006|0.000004138">{{ $lang[6] ?? 'Honey' }}</option>
                                <option value="1082|0.25|0.00023104">{{ $lang[7] ?? 'Engine Oil' }}</option>
                                <option value="791|0.000306|0.00000038685">{{ $lang[8] ?? 'Ethanol' }} (25 °C)</option>
                                <option value="789|0.001074|0.0000013612">{{ $lang[9] ?? 'Olive Oil' }} (25 °C)</option>
                                <option value="13600|0.001526|0.0000001122">{{ $lang[10] ?? 'Mercury' }} (25 °C)</option>
                                <option value="807|0.000158|0.0000001958">{{ $lang[11] ?? 'Nitrogen' }} (-196 °C)</option>
                                <option value="920|0.081|0.00008804">{{ $lang[12] ?? 'Castor Oil' }} (25 °C)</option>
                            </select>
                        </div>
                    </div>

                    {{-- Fluid Density --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                        <label for="fluid_density" class="font-s-14 text-blue">{{ $lang['13'] ?? 'Fluid Density' }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="fluid_density" id="fluid_density" step="any" 
                                   class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full {{ $fluid_substance !== 'custom' ? 'bg-gray-100' : '' }}" 
                                   {{ $fluid_substance !== 'custom' ? 'readonly' : '' }} />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">
                                {{ $fluid_density_unit }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 dropdown-content">
                                @foreach (['kg/m³', 'kg/dm³', 't/m³', 'g/cm³', 'oz/cu in', 'lb/cu in', 'lb/cu ft', 'lb/cu yd'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('fluid_density_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Dynamic Viscosity --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                        <label for="dynamic_velocity" class="font-s-14 text-blue">{{ $lang['14'] ?? 'Dynamic Viscosity' }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="dynamic_velocity" id="dynamic_velocity" step="any" 
                                   class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full {{ $fluid_substance !== 'custom' ? 'bg-gray-100' : '' }}" 
                                   {{ $fluid_substance !== 'custom' ? 'readonly' : '' }} />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">
                                {{ $dynamic_velocity_unit }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 dropdown-content">
                                @foreach (['kg-m-s', 'p', 'cp', 'mpas', 'pas', 'slug', 'lbfs-ft2', 'lb-fts', 'dynas-cm2', 'g-cms', 'reyn'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('dynamic_velocity_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Fluid Velocity --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                        <label for="fluid_velocity" class="font-s-14 text-blue">{{ $lang['15'] ?? 'Fluid Velocity' }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="fluid_velocity" id="fluid_velocity" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">
                                {{ $fluid_velocity_unit }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 dropdown-content">
                                @foreach (['m-s', 'km-h', 'ft-s', 'mi-h'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('fluid_velocity_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Linear Dimension --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                        <label for="linear_dimension" class="font-s-14 text-blue">{{ $lang['16'] ?? 'Linear Dimension' }}</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="linear_dimension" id="linear_dimension" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">
                                {{ $linear_dimension_unit }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 dropdown-content">
                                @foreach (['mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('linear_dimension_unit', '{{ $unit }}'); open = false">{{ $unit }}</p>
                                @endforeach
                            </div>
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

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full  mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="50%"><strong>{{ $lang[17] ?? 'Kinematic Viscosity' }}</strong></td>
                                    <td class="py-2 border-b">{{ round($detail['kinematic'], 10) }} m²/s</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang[18] ?? 'Reynolds Number' }}</strong></td>
                                    <td class="py-2 border-b">
                                        {{ number_format($detail['reynolds']) }}
                                        <span class="ml-2 font-semibold">
                                            @if($detail['reynolds'] < 2100)
                                                ({{ $lang[19] ?? 'Laminar Flow' }})
                                            @elseif($detail['reynolds'] < 3000)
                                                ({{ $lang[20] ?? 'Transitional Flow' }})
                                            @else
                                                ({{ $lang[21] ?? 'Turbulent Flow' }})
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

</div>
