<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="original" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Original Value' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="original" id="original" class="input" aria-label="original" placeholder="100" />
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="rate" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Depreciation Rate' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="rate" id="rate" class="input" aria-label="rate" placeholder="10" />
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="year" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Number of Years' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="year" id="year" class="input" aria-label="year" placeholder="10" />
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
                                    <tr class="border-b">
                                        <td class="py-3" width="60%"><strong>{{ $lang['4'] ?? 'Salvage Value' }}</strong></td>
                                        <td class="py-3 text-xl font-bold orange-text">{{ round($detail['answer'], 2) + 0 }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px] mt-5">
                                <p class="mt-2 font-bold text-lg text-blue-600 mb-4">{{ $lang['5'] ?? 'Calculation Breakdown' }}</p>
                                <div class="bg-gray-50 p-6 rounded-lg space-y-4 border">
                                    <p class="leading-relaxed">{{ $lang['6'] ?? 'The Salvage Value is calculated using the following formula' }}:</p>
                                    <p class="font-bold py-2 px-4 bg-white rounded border border-blue-100 inline-block">
                                        {{ $lang['4'] ?? 'Salvage Value' }} = P(1 - i)<sup>y</sup>
                                    </p>
                                    
                                    <div class="pt-4 border-t border-gray-200 space-y-2">
                                        <p class="text-sm text-gray-600"><strong>{{ $lang['7'] ?? 'Where' }}:</strong></p>
                                        <ul class="list-disc pl-8 space-y-1 text-sm">
                                            <li><strong>P</strong> = {{ $lang['1'] ?? 'Original Value' }} = {{ $original + 0 }}</li>
                                            <li><strong>i</strong> = {{ $lang['2'] ?? 'Depreciation Rate' }} = {{ $rate + 0 }}%</li>
                                            <li><strong>y</strong> = {{ $lang['3'] ?? 'Number of Years' }} = {{ $year + 0 }}</li>
                                        </ul>
                                        
                                        <p class="pt-4"><strong>Calculation:</strong></p>
                                        <p class="pl-4 border-l-4 border-blue-200 italic">
                                            {{ $lang['4'] ?? 'Salvage Value' }} = {{ $original + 0 }} * (1 - {{ $rate / 100 }})<sup>{{ $year + 0 }}</sup><br>
                                            {{ $lang['4'] ?? 'Salvage Value' }} = {{ $original + 0 }} * ({{ 1 - ($rate / 100) }})<sup>{{ $year + 0 }}</sup><br>
                                            <span class="text-xl font-bold orange-text">{{ $lang['4'] ?? 'Salvage Value' }} = {{ round($detail['answer'], 2) + 0 }}</span>
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
