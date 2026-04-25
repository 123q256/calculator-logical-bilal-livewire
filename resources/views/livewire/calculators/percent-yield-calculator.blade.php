<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2 relative">
                        <label for="method" class="font-s-14 text-blue">{!! $lang['to'] !!}:</label>
                        <select wire:model.live="method" id="method" class="input border border-gray-300 p-2 rounded-lg w-full">
                            <option value="1">{{ $lang['yeild'] }}</option>
                            <option value="2">{{ $lang['ther'] }}</option>
                            <option value="3">{{ $lang['actul'] }}</option>
                        </select>
                    </div>

                    {{-- Field 1 --}}
                    @if ($method == '1' || $method == '3')
                        <div class="space-y-2">
                            <label class="font-s-14 text-blue">
                                @if ($method == '1') {{ $lang['ther'] }} @else {{ $lang['yeild'] }} @endif
                            </label>
                            <div class="relative w-full">
                                <input type="number" wire:model="x" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <button type="button" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('unit_x')">{{ $unit_x }} ▾</button>
                                @if ($openDropdown === 'unit_x')
                                    <div wire:key="dropdown-x" class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_x', 'g')">grams (g)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_x', 'µg')">micrograms (µg)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_x', 'mg')">milligrams (mg)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_x', 'kg')">kilograms (kg)</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_x', 'lbs')">pounds (lbs)</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Field 2 (Yield Percentage) --}}
                    @if ($method == '2' || $method == '3')
                        <div class="space-y-2">
                            <label class="font-s-14 text-blue">{!! $lang['yeild'] !!}:</label>
                            <div class="w-full relative">
                                <input type="number" step="any" wire:model="z" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                                <span class="absolute right-4 top-2 text-blue">%</span>
                            </div>
                        </div>
                    @endif

                    {{-- Field 3 --}}
                    <div class="space-y-2">
                        <label class="font-s-14 text-blue">
                            @if ($method == '1' || $method == '2') {{ $lang['actul'] }} @else {{ $lang['ther'] }} @endif
                        </label>
                        <div class="relative w-full">
                            <input type="number" wire:model="y" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <button type="button" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('unit_y')">{{ $unit_y }} ▾</button>
                            @if ($openDropdown === 'unit_y')
                                <div wire:key="dropdown-y" class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_y', 'g')">grams (g)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_y', 'µg')">micrograms (µg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_y', 'mg')">milligrams (mg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_y', 'kg')">kilograms (kg)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_y', 'lbs')">pounds (lbs)</p>
                                </div>
                            @endif
                        </div>
                    </div>
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
                        <div class="w-full text-[20px] mt-3">
                            <div class="w-full text-center">
                                @php
                                    if ($method == '1') {
                                        $head = $lang['yeild'];
                                    } elseif ($method == '2') {
                                        $head = $lang['ther'];
                                    } else {
                                        $head = $lang['actul'];
                                    }
                                @endphp
                                <p class="mb-2"><strong class="z">{{ $head }}</strong></p>
                                <strong class="text-[#119154] text-[32px]">{{ $detail['ans'] ?? '00' }}</strong>
                                <span class="text-blue text-[20px] nachy">{{ ($method == '1') ? '%' : 'g' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
