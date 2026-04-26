<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Initial Displacement -->
                    <div class="space-y-2">
                        <label for="i_d" class="label">{{ $lang['2'] ?? 'Initial Displacement' }} (x₁):</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="i_d" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full outline-none" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-3 top-2.5" wire:click="toggleOverlay('i_d_unit_dropdown')">{{ $i_d_unit }} ▾</label>
                            @if($showDropdown === 'i_d_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach(['cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('i_d_unit', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Final Displacement -->
                    <div class="space-y-2">
                        <label for="f_d" class="label">{{ $lang['3'] ?? 'Final Displacement' }} (x₂):</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="f_d" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full outline-none" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-3 top-2.5" wire:click="toggleOverlay('f_d_unit_dropdown')">{{ $f_d_unit }} ▾</label>
                            @if($showDropdown === 'f_d_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach(['cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('f_d_unit', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Initial Time -->
                    <div class="space-y-2">
                        <label for="i_tt" class="label">{{ $lang['4'] ?? 'Initial Time' }} (t₁):</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="i_tt" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full outline-none" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-3 top-2.5" wire:click="toggleOverlay('i_tt_unit_dropdown')">{{ $i_tt_unit }} ▾</label>
                            @if($showDropdown === 'i_tt_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach(['sec', 'min', 'hrs'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('i_tt_unit', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Final Time -->
                    <div class="space-y-2">
                        <label for="f_tt" class="label">{{ $lang['5'] ?? 'Final Time' }} (t₂):</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="f_tt" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full outline-none" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-3 top-2.5" wire:click="toggleOverlay('f_tt_unit_dropdown')">{{ $f_tt_unit }} ▾</label>
                            @if($showDropdown === 'f_tt_unit_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach(['sec', 'min', 'hrs'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('f_tt_unit', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full flex justify-center mt-6">
                @if ($type == 'calculator')
                    @include('inc.button')
                @else
                    @include('inc.widget-button')
                @endif
            </div>
        </div>

        <hr>
        @if($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            
            <div class="rounded-lg flex flex-col items-center justify-center space-y-4">
                <p class="text-xl font-bold text-gray-700">{{ $lang['iv'] ?? 'Instantaneous Velocity' }} (V<sub>int</sub>)</p>
                
                <div class="bg-blue-600 text-white rounded-lg px-8 py-6 flex items-center space-x-4">
                    <span class="md:text-2xl font-black">{{ $this->convertedValue }}</span>
                    
                    <div class="relative">
                        <span class="text-xl font-bold cursor-pointer underline decoration-dotted underline-offset-4" wire:click="toggleOverlay('result_unit_dropdown')">
                            {{ $circle_unit_result }} ▾
                        </span>
                        @if($showDropdown === 'result_unit_dropdown')
                            <div class="absolute z-20 bg-white border border-gray-300 rounded-md w-24 mt-2 right-0  overflow-auto">
                                @foreach(['m/s', 'ft/s', 'km/s', 'km/h', 'mi/s', 'mph'] as $unit)
                                    <p class="p-3 hover:bg-gray-100 cursor-pointer text-sm text-gray-800 border-b last:border-0" wire:click="setUnit('circle_unit_result', '{{ $unit }}')">
                                        {{ $unit }}
                                    </p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <div class="w-full mt-8 p-6 bg-blue-50 rounded-xl border border-blue-100">
                    <h4 class="text-blue-800 font-bold mb-4 uppercase tracking-wider text-sm">{{ $lang['sol'] ?? 'Step-by-Step Solution' }}</h4>
                    <div class="space-y-4 text-gray-700 leading-relaxed">
                        <p><strong>Step 1:</strong> Calculate change in position (Δx)</p>
                        <p class="pl-4">Δx = x₂ - x₁ = {{ $f_d }} {{ $f_d_unit }} - {{ $i_d }} {{ $i_d_unit }} = <span class="font-bold text-blue-600">{{ $detail['s1'] }} m</span></p>
                        
                        <p><strong>Step 2:</strong> Calculate change in time (Δt)</p>
                        <p class="pl-4">Δt = t₂ - t₁ = {{ $f_tt }} {{ $f_tt_unit }} - {{ $i_tt }} {{ $i_tt_unit }} = <span class="font-bold text-blue-600">{{ $detail['s2'] }} s</span></p>
                        
                        <p><strong>Step 3:</strong> Calculate Instantaneous Velocity (V<sub>int</sub>)</p>
                        <p class="pl-4 font-bold text-lg">V<sub>int</sub> = Δx / Δt = {{ $detail['s1'] }} / {{ $detail['s2'] }} = <span class="text-blue-700">{{ $detail['iv'] }} m/s</span></p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </form>
</div>
