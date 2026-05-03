<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="item" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Item Value' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="item" id="item" class="input" aria-label="item" placeholder="2000" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="sale" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Total Sales' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="sale" id="sale" class="input" aria-label="sale" placeholder="50" />
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
                                        <td class="py-3" width="60%"><strong>{{ $lang['3'] ?? 'Percentage of Sales' }}</strong></td>
                                        <td class="py-3 text-xl font-bold orange-text">{{ round($detail['answer'], 2) + 0 }} %</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px] mt-5">
                                <p class="mt-2 font-bold text-lg text-blue-600 mb-4">{{ $lang['4'] ?? 'Calculation Breakdown' }}</p>
                                <div class="bg-gray-50 p-6 rounded-lg space-y-4 border">
                                    <p class="leading-relaxed">{{ $lang['5'] ?? 'The Percentage of Sales is calculated using the following formula' }}:</p>
                                    <p class="font-bold py-2 px-4 bg-white rounded border border-blue-100 inline-block">
                                        {{ $lang['3'] ?? 'Percent of Sales' }} = ({{ $lang['1'] ?? 'Item' }} / {{ $lang['2'] ?? 'Sales' }}) x 100
                                    </p>
                                    
                                    <div class="pt-4 border-t border-gray-200 space-y-2">
                                        <p><strong>Calculation:</strong></p>
                                        <p class="pl-4 border-l-4 border-blue-200 italic">
                                            {{ $lang['3'] ?? 'Percent' }} = ({{ $item + 0 }} / {{ $sale + 0 }}) x 100<br>
                                            {{ $lang['3'] ?? 'Percent' }} = {{ round($item / $sale, 4) }} x 100<br>
                                            <span class="text-xl font-bold orange-text">{{ $lang['3'] ?? 'Percent' }} = {{ round($detail['answer'], 2) + 0 }}%</span>
                                        </p>
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
