<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    
                    <!-- Method Selection -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="find" class="label">{{ $lang['1'] ?? 'Select Method' }}?</label>
                        <div class="w-100 py-2 relative">
                            <select wire:model.live="find" id="find" class="input">
                                <option value="1">{{ $lang['2'] ?? 'Dividend Capitalization' }}</option>
                                <option value="2">{{ $lang['3'] ?? 'CAPM' }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Dividend Capitalization Inputs -->
                    @if ($find == 1)
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="dividend_per_share" class="label">{{ $lang['4'] ?? 'Dividend per Share' }}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="dividend_per_share" id="dividend_per_share"
                                    class="input" aria-label="input" placeholder="50" />
                                <span class="text-blue input_unit">{{ $currancy }}</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="current_market_value" class="label">{{ $lang['5'] ?? 'Current Market Value' }}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="current_market_value" id="current_market_value"
                                    class="input" aria-label="input" placeholder="50" />
                                <span class="text-blue input_unit">{{ $currancy }}</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="growth_rate_dividend" class="label">{{ $lang['6'] ?? 'Growth Rate' }}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="growth_rate_dividend" id="growth_rate_dividend"
                                    class="input" aria-label="input" placeholder="5" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                    @endif

                    <!-- CAPM Inputs -->
                    @if ($find == 2)
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="risk_rate_return" class="label">{{ $lang['7'] ?? 'Risk-free Rate of Return' }}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="risk_rate_return" id="risk_rate_return"
                                    class="input" aria-label="input" placeholder="7" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="market_rate_return" class="label">{{ $lang['8'] ?? 'Market Rate of Return' }}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="market_rate_return" id="market_rate_return"
                                    class="input" aria-label="input" placeholder="10" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="beta" class="label">{{ $lang['9'] ?? 'Beta' }}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="beta" id="beta" class="input"
                                    aria-label="input" placeholder="1.2" />
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

        @if ($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full text-center text-[20px]">
                                <p>{{ $lang['10'] ?? 'Cost of Equity' }}</p>
                                <p class="my-3">
                                    <strong class="bg-[#2845F5] rounded-lg text-white px-3 py-2 text-[25px]">
                                        {{ round($detail['ans'], 2) }}%
                                    </strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
