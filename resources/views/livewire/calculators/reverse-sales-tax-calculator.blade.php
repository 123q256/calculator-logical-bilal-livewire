<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="final" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Final Price (Inc. Tax)' }}:</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" wire:model.live="final" id="final" class="input" aria-label="final" placeholder="8" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="sale" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Sales Tax Rate' }}:</label>
                        <div class="w-full py-2 position-relative">
                            <input type="number" step="any" wire:model.live="sale" id="sale" class="input" aria-label="sale" placeholder="4" />
                            <span class="text-blue input_unit">%</span>
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
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] ?? 'Price Before Tax' }}</strong></td>
                                        <td class="py-2 border-b text-xl font-bold orange-text">{{ $currency }} {{ number_format($detail['reverse'], 4) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 mt-8 text-[16px]">
                                <p class="mt-2 font-bold text-lg text-blue-600 border-b pb-2 mb-4">{{ $lang[4] ?? 'Calculation' }}:</p>
                                <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                                    <p class="mt-2">{{ $lang[5] ?? 'To find the price before tax, use the following formula' }}:</p>
                                    <p class="font-mono p-2 bg-white rounded border">{{ $lang[3] ?? 'Original Price' }} = {{ $lang['1'] ?? 'Final Price' }} / (1 + ({{ $lang['2'] ?? 'Tax Rate' }} / 100))</p>
                                    <div class="ml-4 border-l-4 border-blue-200 pl-4 py-1">
                                        <p>{{ $lang[3] ?? 'Price' }} = {{ number_format($final, 2) }} / (1 + ({{ $sale }} / 100))</p>
                                        <p>{{ $lang[3] ?? 'Price' }} = {{ number_format($final, 2) }} / (1 + {{ $sale / 100 }})</p>
                                        <p>{{ $lang[3] ?? 'Price' }} = {{ number_format($final, 2) }} / {{ 1 + ($sale / 100) }}</p>
                                        <p class="text-xl font-bold mt-2">{{ $lang[3] ?? 'Price' }} = <span class="orange-text">{{ $currency }} {{ number_format($detail['reverse'], 4) }}</span></p>
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
