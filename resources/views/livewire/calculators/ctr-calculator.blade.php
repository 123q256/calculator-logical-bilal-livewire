<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-1 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="impression" class="label">{{ $lang['1'] ?? 'Total Impressions' }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="impression" id="impression" class="input" aria-label="impression" placeholder="5000" />
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="clicks" class="label">{{ $lang['2'] ?? 'Total Clicks' }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="clicks" id="clicks" class="input" aria-label="clicks" placeholder="50" />
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
                                        <td class="py-3" width="70%"><strong>Click Through Rate (CTR)</strong></td>
                                        <td class="py-3 text-xl font-bold orange-text">{{ round($detail['ctr'] * 100, 3) + 0 }} %</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div class="w-full text-[16px] mt-5">
                                <p class="mt-2 font-bold text-lg text-blue-600 mb-4">{{ $lang['4'] ?? 'Calculation Breakdown' }}</p>
                                <div class="bg-gray-50 p-6 rounded-lg space-y-4 border">
                                    <p class="leading-relaxed">{{ $lang['5'] ?? 'CTR is calculated by dividing the number of clicks by the number of impressions' }}:</p>
                                    <p class="font-bold py-2 px-4 bg-white rounded border border-blue-100 inline-block">
                                        CTR = (Clicks / Impressions) * 100
                                    </p>
                                    
                                    <div class="pt-4 border-t border-gray-200 space-y-2 mt-2">
                                        <div class="pl-4 border-l-4 border-blue-200 italic space-y-2 mt-2">
                                            <p>CTR = ({{ $clicks + 0 }} / {{ $impression + 0 }}) * 100</p>
                                            <p>CTR = {{ round($detail['ctr'], 5) + 0 }} * 100</p>
                                            <p class="text-xl font-bold orange-text pt-1">CTR = {{ round($detail['ctr'] * 100, 3) + 0 }} %</p>
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
