<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    
                    <!-- Operation 1 Selection -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="operations1" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Select Operation' }}:</label>
                        <select class="input mt-2" wire:model.live="operations1" id="operations1">
                            <option value="1">{{ $lang[2] ?? 'Calculate Consumer Surplus' }}</option>
                            <option value="2">{{ $lang[3] ?? 'Calculate Actual Price' }}</option>
                            <option value="3">{{ $lang[4] ?? 'Calculate Willing Price' }}</option>
                        </select>
                    </div>

                    <!-- First Input (Dynamic Label) -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="first" class="font-s-14 text-blue">
                            @if($operations1 == 1) {{ $lang[3] ?? 'Actual Price' }} @else {{ $lang[2] ?? 'Consumer Surplus' }} @endif:
                        </label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="first" id="first" class="input"
                                aria-label="input" placeholder="50" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Second Input (Dynamic Label) -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="second" class="font-s-14 text-blue">
                            @if($operations1 == 3) {{ $lang[3] ?? 'Actual Price' }} @else {{ $lang[4] ?? 'Willing Price' }} @endif:
                        </label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="second" id="second" class="input"
                                aria-label="input" placeholder="50" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Operation 2 Selection -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="operations2" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Select Extended Operation' }}:</label>
                        <select class="input mt-2" wire:model.live="operations2" id="operations2">
                            <option value="1">{{ $lang[6] ?? 'Calculate Extended Consumer Surplus' }}</option>
                            <option value="2">{{ $lang[7] ?? 'Calculate Equilibrium Price' }}</option>
                            <option value="3">{{ $lang[8] ?? 'Calculate Equilibrium Quantity' }}</option>
                        </select>
                    </div>

                    <!-- Third Input (Dynamic Label) -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="third" class="font-s-14 text-blue">
                            @if($operations2 == 2) {{ $lang[6] ?? 'Extended Consumer Surplus' }} @else {{ $lang[7] ?? 'Equilibrium Price' }} @endif:
                        </label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="third" id="third" class="input"
                                aria-label="input" placeholder="35" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Fourth Input (Dynamic Label) -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="four" class="font-s-14 text-blue">
                            @if($operations2 == 3) {{ $lang[6] ?? 'Extended Consumer Surplus' }} @else {{ $lang[8] ?? 'Equilibrium Quantity' }} @endif:
                        </label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="four" id="four" class="input"
                                aria-label="input" placeholder="20" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Fifth Input -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="five" class="font-s-14 text-blue">{{ $lang['9'] ?? 'Producer Surplus' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="five" id="five" class="input"
                                aria-label="input" placeholder="10" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
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

        @if ($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $detail['line1'] }}</strong></td>
                                        <td class="py-2 border-b whitespace-nowrap"> {{ $currancy }} {{ round($detail['answer1'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $detail['line2'] }}</strong></td>
                                        <td class="py-2 border-b whitespace-nowrap"> {{ $currancy }} {{ round($detail['answer2'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[9] ?? 'Producer Surplus' }}</strong></td>
                                        <td class="py-2 border-b whitespace-nowrap"> {{ $currancy }} {{ round($detail['ps'], 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
