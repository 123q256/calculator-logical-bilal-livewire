<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto space-y-4">
                <div class="bg-blue-50 p-4 rounded-lg text-sm text-blue-800 space-y-1">
                    <p class="w-full"><strong>{{ $lang['voltage'] ?? 'Voltage' }}</strong> = {{ $lang['current'] ?? 'Current' }} * {{ $lang['resistance'] ?? 'Resistance' }}</p>
                    <p class="w-full"><strong>{{ $lang['power'] ?? 'Power' }}</strong> = {{ $lang['voltage'] ?? 'Voltage' }} * {{ $lang['current'] ?? 'Current' }}</p>
                    <p class="w-full text-xs italic text-blue-600 mt-2"><strong>{{ $lang['note'] ?? 'Note:' }}</strong> {{ $lang['note_value'] ?? 'Please enter any two values to calculate the others.' }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Voltage -->
                    <div class="space-y-2">
                        <label for="voltage" class="label text-blue-600">{{ $lang['voltage'] ?? 'Voltage' }}:</label>
                        <div class="relative w-full">
                            <input type="number" wire:model.live="voltage" step="any" id="voltage"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full outline-none"
                                placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-3 top-2.5"
                                wire:click="toggleOverlay('unit_v_dropdown')">{{ $unit_v }} ▾</label>
                            @if($showDropdown === 'unit_v_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach(['V', 'KV', 'mV'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('unit_v', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Current -->
                    <div class="space-y-2">
                        <label for="current" class="label text-blue-600">{{ $lang['current'] ?? 'Current' }}:</label>
                        <div class="relative w-full">
                            <input type="number" wire:model.live="current" step="any" id="current"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full outline-none"
                                placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-3 top-2.5"
                                wire:click="toggleOverlay('unit_i_dropdown')">{{ $unit_i }} ▾</label>
                            @if($showDropdown === 'unit_i_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach(['A', 'mA'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('unit_i', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Resistance -->
                    <div class="space-y-2">
                        <label for="resistance" class="label text-blue-600">{{ $lang['resistance'] ?? 'Resistance' }}:</label>
                        <div class="relative w-full">
                            <input type="number" wire:model.live="resistance" step="any" id="resistance"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full outline-none"
                                placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-3 top-2.5"
                                wire:click="toggleOverlay('unit_r_dropdown')">{{ $unit_r }} ▾</label>
                            @if($showDropdown === 'unit_r_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach(['Ω', 'kΩ'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('unit_r', '{{ $unit }}')">{{ $unit }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Power -->
                    <div class="space-y-2">
                        <label for="power" class="label text-blue-600">{{ $lang['power'] ?? 'Power' }}:</label>
                        <div class="relative w-full">
                            <input type="number" wire:model.live="power" step="any" id="power"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full outline-none"
                                placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-3 top-2.5"
                                wire:click="toggleOverlay('unit_p_dropdown')">{{ $unit_p }} ▾</label>
                            @if($showDropdown === 'unit_p_dropdown')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach(['W', 'kW'] as $unit)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" wire:click="setUnit('unit_p', '{{ $unit }}')">{{ $unit }}</p>
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

        @if($detail)
        <hr class="my-8">
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full bg-blue-50 rounded-lg mt-2 p-6">
                        <div class="flex flex-wrap items-center">
                            <div class="w-full lg:w-1/2">
                                <table class="w-full text-lg border-separate border-spacing-y-3">
                                    <tr>
                                        <td class="py-2 border-b w-3/5 font-semibold text-blue-700">{{ $lang['voltage'] ?? 'Voltage' }}</td>
                                        <td class="py-2 border-b font-bold text-gray-800">{{ $detail['voltage'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-3/5 font-semibold text-blue-700">{{ $lang['current'] ?? 'Current' }}</td>
                                        <td class="py-2 border-b font-bold text-gray-800">{{ $detail['current'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-3/5 font-semibold text-blue-700">{{ $lang['resistance'] ?? 'Resistance' }}</td>
                                        <td class="py-2 border-b font-bold text-gray-800">{{ $detail['resistance'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-3/5 font-semibold text-blue-700">{{ $lang['power'] ?? 'Power' }}</td>
                                        <td class="py-2 border-b font-bold text-gray-800">{{ $detail['power'] }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full lg:w-1/2 mt-6 lg:mt-0 text-center">
                                <img src="{{ asset('images/ohm-min.webp') }}" alt="Ohm's Law Triangle" class="mx-auto rounded-lg shadow-sm" width="220">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </form>
</div>
