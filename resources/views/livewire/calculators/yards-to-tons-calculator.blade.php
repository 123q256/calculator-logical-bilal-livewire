<div x-data="{ dropdowns: {} }">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[40%] md:w-[60%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-1 gap-6">
                    {{-- Material Type --}}
                    <div class="w-full">
                        <label for="material_type" class="label">{{ $lang['1'] }} ({{ $lang['2'] }}):</label>
                        <div class="w-full py-2">
                            <select wire:model.live="material_type" id="material_type" class="input">
                                @php
                                    $materials = [
                                        "Own Density" => "",
                                        "Asphalt (crushed)" => "45",
                                        "Asphalt (liquid)" => "65",
                                        "Cement (portland)" => "94",
                                        "Concrete" => "145",
                                        "Dirt" => "72",
                                        "Gravel (loose, dry)" => "85",
                                        "Gravel (dry, 1/4 to 2 in)" => "105",
                                        "Gravel (wet 1/4 to 2 in)" => "125",
                                        "Gravel (with sand)" => "120",
                                        "Limestone (crushed)" => "90",
                                        "Limestone (low density)" => "120",
                                        "Limestone (high density)" => "160",
                                        "Mulch (bark)" => "18.728",
                                        "Mulch (woodchip)" => "24.97",
                                        "Sand (dry)" => "100",
                                        "Sand (loose)" => "90",
                                        "Sand (wet)" => "120",
                                        "Topsoil" => "100",
                                        "Topsoil (saturated)" => "115"
                                    ];
                                @endphp
                                @foreach($materials as $name => $val)
                                    <option value="{{ $val }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Density --}}
                    <div class="w-full">
                        <label for="density" class="label">{{ $lang['3'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="density" id="density" step="any" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['density_unit'] = !dropdowns['density_unit']">
                                {{ $density_unit }} ▾
                            </label>
                            <div x-show="dropdowns['density_unit']" @click.away="dropdowns['density_unit'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-xl" x-cloak>
                                @foreach (['lb/ft³', 'kg/m³'] as $unit)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="$wire.set('density_unit', '{{ $unit }}'); dropdowns['density_unit'] = false">{{ $unit }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Cubic Yards --}}
                    <div class="w-full">
                        <label for="cubic_yards" class="label">{{ $lang['4'] }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live.debounce.500ms="cubic_yards" id="cubic_yards" class="input" placeholder="00" />
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
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg items-center">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-5 text-center">
                            <div class="p-4 border-b md:border-b-0 md:border-r border-gray-100">
                                <p class="text-[25px]"><strong class="text-green-700">{{ round($detail['tons'], 2) }}</strong> <span class="text-[18px]">{{ $lang['6'] }}</span></p>
                            </div>
                            <div class="p-4 border-b md:border-b-0 md:border-r border-gray-100">
                                <p class="text-[25px]"><strong class="text-green-700">{{ round($detail['metric_tonnes'], 2) }}</strong> <span class="text-[18px]">{{ $lang['7'] }}</span></p>
                            </div>
                            <div class="p-4">
                                <p class="text-[25px]"><strong class="text-green-700">{{ round($detail['pounds'], 2) }}</strong> <span class="text-[18px]">{{ $lang['8'] }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
