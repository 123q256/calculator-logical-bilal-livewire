<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-6">
                        <label for="original_price" class="label">{{ $lang['1'] ?? 'Original Price' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="original_price" id="original_price" class="input" aria-label="original_price" placeholder="6" />
                            <span class="text-blue input_unit">{{ $lang['2'] ?? 'Rs' }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="new_price" class="label">{{ $lang['3'] ?? 'New Price' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="new_price" id="new_price" class="input" aria-label="new_price" placeholder="7" />
                            <span class="text-blue input_unit">{{ $lang['2'] ?? 'Rs' }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="original_quantity" class="label">{{ $lang['4'] ?? 'Original Quantity' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="original_quantity" id="original_quantity" class="input" aria-label="original_quantity" placeholder="2200" />
                            <span class="text-blue input_unit">{{ $lang['5'] ?? 'Units' }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="new_quantity" class="label">{{ $lang['6'] ?? 'New Quantity' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="new_quantity" id="new_quantity" class="input" aria-label="new_quantity" placeholder="1760" />
                            <span class="text-blue input_unit">{{ $lang['5'] ?? 'Units' }}</span>
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
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] ?? 'Deadweight Loss' }}</strong></td>
                                        <td class="py-2 border-b text-xl font-bold orange-text">{{ $currency }} {{ number_format($detail['deadweight'], 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full mt-8 text-[16px]">
                                <p class="mt-2 font-bold text-lg text-blue-600 border-b pb-2 mb-4">{{ $lang['12'] ?? 'Step-by-Step Calculation' }}:</p>
                                <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                                    <p class="font-mono p-2 bg-white rounded border">{{ $lang['10'] ?? 'Deadweight Loss' }} = 0.5 × (Pₙ - Pₒ) × (Qₒ - Qₙ)</p>
                                    <div class="ml-4 space-y-2">
                                        <p class="text-gray-600">Where:</p>
                                        <ul class="list-disc ml-8 space-y-1">
                                            <li>Pₒ (Original Price) = {{ number_format($original_price, 2) }}</li>
                                            <li>Pₙ (New Price) = {{ number_format($new_price, 2) }}</li>
                                            <li>Qₒ (Original Quantity) = {{ number_format($original_quantity) }}</li>
                                            <li>Qₙ (New Quantity) = {{ number_format($new_quantity) }}</li>
                                        </ul>
                                        <div class="border-l-4 border-blue-200 pl-4 py-1 mt-4">
                                            <p>{{ $lang['10'] ?? 'DWL' }} = 0.5 × ({{ $new_price }} - {{ $original_price }}) × ({{ $original_quantity }} - {{ $new_quantity }})</p>
                                            <p>{{ $lang['10'] ?? 'DWL' }} = 0.5 × ({{ $detail['total_price'] }}) × ({{ $detail['total_quantity'] }})</p>
                                            <p>{{ $lang['10'] ?? 'DWL' }} = {{ $detail['dead'] }} / 2</p>
                                            <p class="text-xl font-bold mt-2">{{ $lang['11'] ?? 'Final' }} {{ $lang['10'] ?? 'DWL' }}: <span class="orange-text">{{ $currency }} {{ number_format($detail['deadweight'], 2) }}</span></p>
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
