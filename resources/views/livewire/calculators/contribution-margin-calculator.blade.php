<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <!-- Price -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="selling_price" class="label">{{ $lang['1'] ?? 'Selling Price' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="selling_price" id="selling_price" class="input" aria-label="selling_price" placeholder="20" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Variable Cost -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="variable_cost" class="label">{{ $lang['2'] ?? 'Variable Cost' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="variable_cost" id="variable_cost" class="input" aria-label="variable_cost" placeholder="10" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Units -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="number_units" class="label">{{ $lang['3'] ?? 'Number of Units' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="number_units" id="number_units" class="input" aria-label="number_units" placeholder="15" />
                        </div>
                    </div>

                    <!-- Fixed Cost -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="fixed_cost" class="label">{{ $lang['4'] ?? 'Fixed Cost' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="fixed_cost" id="fixed_cost" class="input" aria-label="fixed_cost" placeholder="10" />
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

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full lg:w-[80%] overflow-auto mt-2">
                                <table class="w-full text-[18px]">
                                    <tr class="border-b">
                                        <td class="py-3" width="70%"><strong>{{ $lang['5'] ?? 'Contribution Margin' }}</strong></td>
                                        <td class="py-3 text-xl font-bold text-blue-700">{{ $detail['contribution_margin'] + 0 }} {{ $currancy }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3" width="70%"><strong>{{ $lang['6'] ?? 'Contribution Margin Ratio' }}</strong></td>
                                        <td class="py-3 font-semibold orange-text">{{ $detail['contribution_margin_ratio'] + 0 }} %</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3" width="70%"><strong>{{ $lang['7'] ?? 'Total Profit' }}</strong></td>
                                        <td class="py-3 font-semibold text-green-600">{{ $detail['profit'] + 0 }} {{ $currancy }}</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div class="w-full text-[16px] mt-10">
                                <p class="mt-2 font-bold text-lg text-blue-600 border-b pb-2 mb-4">Calculation Breakdown</p>
                                <div class="bg-gray-50 p-6 rounded-lg space-y-6 border">
                                    <!-- Step 1 -->
                                    <div class="space-y-2">
                                        <p class="font-semibold text-gray-700">1. Contribution Margin:</p>
                                        <p class="text-sm text-gray-600">Formula: (Price * Units) - (Variable Cost * Units)</p>
                                        <div class="pl-4 border-l-4 border-blue-200 italic space-y-2 mt-2">
                                            <p>CM = ({{ $selling_price + 0 }} * {{ $number_units + 0 }}) - ({{ $variable_cost + 0 }} * {{ $number_units + 0 }})</p>
                                            <p>CM = {{ $selling_price * $number_units }} - {{ $variable_cost * $number_units }}</p>
                                            <p class="text-lg font-bold orange-text pt-1">CM = {{ $detail['contribution_margin'] + 0 }} {{ $currancy }}</p>
                                        </div>
                                    </div>

                                    <!-- Step 2 -->
                                    <div class="space-y-2 pt-4 border-t border-gray-200">
                                        <p class="font-semibold text-gray-700">2. Margin Ratio:</p>
                                        <p class="text-sm text-gray-600">Formula: Contribution Margin / Total Sales</p>
                                        <div class="pl-4 border-l-4 border-blue-200 italic space-y-1 mt-2">
                                            <p>Ratio = {{ $detail['contribution_margin'] + 0 }} / {{ $selling_price * $number_units }}</p>
                                            <p class="text-lg font-bold orange-text pt-1">Ratio = {{ $detail['contribution_margin_ratio'] + 0 }}%</p>
                                        </div>
                                    </div>

                                    <!-- Step 3 -->
                                    <div class="space-y-2 pt-4 border-t border-gray-200">
                                        <p class="font-semibold text-gray-700">3. Net Profit:</p>
                                        <p class="text-sm text-gray-600">Formula: Contribution Margin - Fixed Cost</p>
                                        <div class="pl-4 border-l-4 border-green-200 italic space-y-1 mt-2">
                                            <p>Profit = {{ $detail['contribution_margin'] + 0 }} - {{ $fixed_cost + 0 }}</p>
                                            <p class="text-xl font-bold text-green-600 pt-1">Profit = {{ $detail['profit'] + 0 }} {{ $currancy }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
