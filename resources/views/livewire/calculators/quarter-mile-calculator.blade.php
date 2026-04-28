<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[85%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- Equation Selection (Main) --}}
                    <div class="col-span-12 md:col-span-12">
                        <label for="equation" class="label">{{ $lang['1'] }}</label>
                        <select wire:model.live="equation" id="equation" class="input">
                            <option value="1">{{ $lang['2'] }}</option>
                            <option value="2">{{ $lang['3'] }}</option>
                            <option value="3">{{ $lang['4'] }}</option>
                        </select>
                    </div>

                    {{-- Selection Selection (Main) --}}
                    <div class="col-span-12 md:col-span-12">
                        <label for="selection" class="label">{{ $lang['17'] }}</label>
                        <select wire:model.live="selection" id="selection" class="input">
                            <option value="1">{{ $lang['6'] }}</option>
                            <option value="2">{{ $lang['7'] }}</option>
                            <option value="3">{{ $lang['8'] }}</option>
                        </select>
                    </div>

                    {{-- Power Input (Shown if selection is 1) --}}
                    @if ($selection == '1')
                        <div class="col-span-12 md:col-span-12">
                            <label for="power" class="label">{{ $lang['15'] }} (HP)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="power" id="power" class="input" placeholder="00" />
                                
                                @if ($equation != '3')
                                    {{-- Power Unit Dropdown --}}
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('power_unit')">
                                        {{ $power_unit }} ▾
                                    </label>
                                    @if ($openDropdown === 'power_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto max-h-48">
                                            @foreach (['watts (W)', 'kilowatts (kW)', 'megawatts (mW)', 'mechanical horsepowers hp (l)', 'metric horsepowers hp (M)'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('power_unit', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                @else
                                    {{-- Sample Unit Dropdown (For Equation 3) --}}
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('sample_unit')">
                                        {{ $sample_unit }} ▾
                                    </label>
                                    @if ($openDropdown === 'sample_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto max-h-48">
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('sample_unit', '{{ $lang['18'] ?? 'Wheel horsepower' }}')">{{ $lang['18'] ?? 'Wheel horsepower' }}</p>
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('sample_unit', '{{ $lang['19'] ?? 'Flywheel horsepower' }}')">{{ $lang['19'] ?? 'Flywheel horsepower' }}</p>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Weight Input (Always Shown based on user logic) --}}
                    <div class="col-span-12 md:col-span-12">
                        <label for="weight" class="label">{{ $lang['16'] }}</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="weight" id="weight" class="input" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('weight_unit')">
                                {{ $weight_unit }} ▾
                            </label>
                            @if ($openDropdown === 'weight_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto max-h-48">
                                    @foreach (['(kg)', '(t)', '(lb)'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('weight_unit', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Trap Speed Input (Shown if selection is 2) --}}
                    @if ($selection == '2')
                        <div class="col-span-12 md:col-span-12">
                            <label for="trap" class="label">{{ $lang['10'] }}</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="trap" id="trap" class="input" placeholder="00" />
                                <span class="text-blue input_unit">mph</span>
                            </div>
                        </div>
                    @endif

                    {{-- ET Input (Shown if selection is 3) --}}
                    @if ($selection == '3')
                        <div class="col-span-12 md:col-span-12">
                            <label for="et" class="label">{{ $lang['11'] }}</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="et" id="et" class="input" placeholder="00" />
                                <span class="text-blue input_unit">sec</span>
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
    </form>

    <hr>

    @isset($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
            <div class="text-left space-y-6 overflow-auto">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="w-full mt-2">
                    <table class="w-full text-[18px]">
                        @if (!empty($detail['sixty']) && !empty($detail['one_eight']))
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>60 {{ $lang['12'] ?? 'ft time' }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['sixty'], 3) }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b"><strong>1/8 {{ $lang['13'] ?? 'mile ET' }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['one_eight'], 3) }}</td>
                            </tr>
                        @endif

                        @if (!empty($detail['elapsed_time']))
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>1/4 {{ $lang['14'] ?? 'mile ET' }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['elapsed_time'], 3) }} (sec)</td>
                            </tr>
                        @endif

                        @if (!empty($detail['trap_speed']))
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>1/4 {{ $lang['13'] ?? 'mile trap speed' }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['trap_speed'], 3) }} (mph)</td>
                            </tr>
                        @endif

                        @if (!empty($detail['final_value']))
                            <tr>
                                <td class="py-2 border-b" width="60%"><strong>1/4 {{ $lang['13'] ?? 'mile power' }}</strong></td>
                                <td class="py-2 border-b">{{ number_format($detail['final_value'], 3) }} (hp)</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    @endisset
</div>
