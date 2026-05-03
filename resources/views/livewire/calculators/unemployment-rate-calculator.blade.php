<div>
    <style>
        img {
            object-fit: contain;
        }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
                <div class="grid grid-cols-2 gap-4">
                    
                    <!-- Calculation Mode Selection -->
                    <div class="col-span-2 md:col-span-1 space-y-2">
                        <label for="find" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Calculate' }}:</label>
                        <select wire:model.live="find" id="find" class="input">
                            <option value="1">{{ ($lang['2'] ?? 'Labor Force') . " & " . ($lang['3'] ?? 'Unemployment Rate') }}</option>
                            <option value="2">{{ ($lang['4'] ?? 'Employed') . " & " . ($lang['5'] ?? 'Unemployed People') }}</option>
                        </select>
                    </div>

                    <!-- Common Input -->
                    <div class="col-span-2 md:col-span-1 space-y-2 relative">
                        <label for="adult_population" class="font-s-14 text-blue">{{ $lang['8'] ?? 'Adult Population' }}:</label>
                        <input type="number" step="any" wire:model.live="adult_population" id="adult_population" class="input"
                            aria-label="input" placeholder="00" />
                        <span class="input_unit">{{ $lang['7'] ?? 'People' }}</span>
                    </div>

                    <!-- Mode 1 Specific Inputs -->
                    @if ($find == 1)
                        <div class="col-span-2 md:col-span-1 space-y-2 relative">
                            <label for="employed_people" class="font-s-14 text-blue">{{ $lang['6'] ?? 'Employed People' }}:</label>
                            <input type="number" step="any" wire:model.live="employed_people" id="employed_people" class="input"
                                aria-label="input" placeholder="40" />
                            <span class="input_unit">{{ $lang['7'] ?? 'People' }}</span>
                        </div>
                        <div class="col-span-2 md:col-span-1 space-y-2 relative">
                            <label for="unemployed_people" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Unemployed People' }}:</label>
                            <input type="number" step="any" wire:model.live="unemployed_people" id="unemployed_people" class="input"
                                aria-label="input" placeholder="40" />
                            <span class="input_unit">{{ $lang['7'] ?? 'People' }}</span>
                        </div>
                    @endif

                    <!-- Mode 2 Specific Inputs -->
                    @if ($find == 2)
                        <div class="col-span-2 md:col-span-1 space-y-2 relative">
                            <label for="labor_force" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Labor Force' }}:</label>
                            <input type="number" step="any" wire:model.live="labor_force" id="labor_force" class="input"
                                aria-label="input" placeholder="1.44" />
                            <span class="input_unit">{{ $lang['7'] ?? 'People' }}</span>
                        </div>
                        <div class="col-span-2 md:col-span-1 space-y-2 relative">
                            <label for="unemployment_rate" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Unemployment Rate' }}:</label>
                            <input type="number" step="any" wire:model.live="unemployment_rate" id="unemployment_rate" class="input"
                                aria-label="input" placeholder="50" />
                            <span class="input_unit">%</span>
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

        @if ($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full bg-light-blue  rounded-lg">
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto mt-4 p-4">
                                <table class="w-full text-lg">
                                    @if ($detail['method'] == "1")
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{ $lang['2'] ?? 'Labor Force' }} </strong></td>
                                            <td class="py-2 border-b whitespace-nowrap"> {{ round($detail['labor_force'], 2) }} ({{ $lang['7'] ?? 'People' }})</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{ $lang['3'] ?? 'Unemployment Rate' }} </strong></td>
                                            <td class="py-2 border-b whitespace-nowrap"> {{ round($detail['unemployment_rate'], 2) }}%</td>
                                        </tr>
                                    @endif

                                    @if ($detail['method'] == "2")
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{ $lang['6'] ?? 'Unemployed' }} </strong></td>
                                            <td class="py-2 border-b whitespace-nowrap"> {{ round($detail['unemployment'], 2) }} ({{ $lang['7'] ?? 'People' }})</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{ $lang['5'] ?? 'Employed' }} </strong></td>
                                            <td class="py-2 border-b whitespace-nowrap"> {{ round($detail['employment'], 2) }} ({{ $lang['7'] ?? 'People' }})</td>
                                        </tr>
                                    @endif

                                    @if (isset($detail['labor_force_participation']) && $detail['labor_force_participation'] != "")
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{ $lang['9'] ?? 'Labor Force Participation' }} </strong></td>
                                            <td class="py-2 border-b whitespace-nowrap"> {{ round($detail['labor_force_participation'], 2) }}%</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
