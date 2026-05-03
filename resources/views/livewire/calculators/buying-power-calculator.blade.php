<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="amount" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Amount' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="amount" id="amount" class="input" aria-label="amount" placeholder="500" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="reference" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Reference Year (1913-2021)' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="1" wire:model.live="reference" id="reference" class="input" aria-label="reference" placeholder="1913" />
                            <span class="text-blue input_unit">Year</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="target" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Target Year (1913-2021)' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="1" wire:model.live="target" id="target" class="input" aria-label="target" placeholder="2018" />
                            <span class="text-blue input_unit">Year</span>
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
                            <div class="col-12 text-center">
                                <p class="text-lg font-semibold text-blue-800 mb-2">{{ $lang[4] ?? 'Adjusted Buying Power' }}</p>
                                <div class="flex flex-col items-center space-y-2">
                                    <p class="text-gray-500 text-sm italic">{{ $currency }}{{ $amount + 0 }} in {{ $reference }} is worth</p>
                                    <strong class="bg-[#2845F5] text-white rounded-lg px-4 py-4 text-[30px] ">
                                        {{ $currency }}{{ $detail['result'] + 0 }}
                                    </strong>
                                    <p class="text-gray-500 text-sm italic">in {{ $target }}</p>
                                </div>
                            </div>

                            <div class="w-full mt-8 text-[16px]">
                                <p class="mt-2 font-bold text-lg text-blue-600 border-b pb-2 mb-4">{{ $lang[5] ?? 'Economic Context' }}:</p>
                                <div class="bg-gray-50 p-6 rounded-lg space-y-4 border border-gray-100">
                                    <p class="leading-relaxed">
                                        This calculation is based on the <strong>Consumer Price Index (CPI)</strong>. It measures the changes in the price level of a weighted average market basket of consumer goods and services.
                                    </p>
                                    <div class="flex flex-col md:flex-row items-center md:space-x-4 space-y-4 md:space-y-0 pt-2">
                                        <div class="p-3 bg-white rounded-lg border border-blue-50 shadow-xs w-full md:flex-1 text-center">
                                            <span class="block text-xs uppercase text-gray-400 font-bold mb-1">Inflation Factor</span>
                                            <span class="text-xl font-bold text-blue-700">
                                                {{ number_format($detail['result'] / ($amount ?: 1), 2) }}x
                                            </span>
                                        </div>
                                        <div class="p-3 bg-white rounded-lg border border-blue-50 shadow-xs w-full md:flex-1 text-center">
                                            <span class="block text-xs uppercase text-gray-400 font-bold mb-1">Total Change</span>
                                            <span class="text-xl font-bold {{ $detail['result'] > $amount ? 'text-green-600' : 'text-red-600' }}">
                                                {{ number_format(($detail['result'] / ($amount ?: 1) - 1) * 100, 1) }}%
                                            </span>
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
