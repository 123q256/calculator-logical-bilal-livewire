<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="video" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Video Views' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="video" id="video" class="input" aria-label="video" placeholder="500000" />
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="average" class="font-s-12 text-blue">{{ $lang['2'] ?? 'Average Revenue Per Click' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="average" id="average" class="input" aria-label="average" placeholder="50" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="click" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Click Through Rate (CTR)' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="click" id="click" class="input" aria-label="click" placeholder="5" />
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
                            <div class="w-full lg:w-[80%] overflow-auto mt-2">
                                <table class="w-full text-[18px]">
                                    <tr class="border-b">
                                        <td class="py-3" width="70%"><strong>{{ $lang['4'] ?? 'Estimated Clicks' }}</strong></td>
                                        <td class="py-3 text-xl font-bold orange-text">{{ $detail['averageClicks'] + 0 }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3" width="70%"><strong>{{ $lang['5'] ?? 'Estimated Total Revenue' }}</strong></td>
                                        <td class="py-3 text-xl font-bold text-blue-700">{{ $currancy }}{{ abs($detail['averageRevenue']) + 0 }}</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div class="w-full text-[16px] mt-5">
                                <p class="mt-2 font-bold text-lg text-blue-600  mb-4">Calculation Breakdown</p>
                                <div class="bg-gray-50 p-6 rounded-lg space-y-4 border">
                                    <p><strong>Step 1: Calculate Total Clicks</strong></p>
                                    <p class="pl-4 border-l-4 border-blue-200">
                                        Clicks = Views * (CTR / 100)<br>
                                        Clicks = {{ $video + 0 }} * ({{ $click + 0 }} / 100) = <strong>{{ $detail['averageClicks'] + 0 }}</strong>
                                    </p>
                                    
                                    <p class="pt-4"><strong>Step 2: Calculate Total Revenue</strong></p>
                                    <p class="pl-4 border-l-4 border-green-200">
                                        Revenue = Clicks * Revenue Per Click<br>
                                        Revenue = {{ $detail['averageClicks'] + 0 }} * {{ $average + 0 }} = <strong>{{ $currancy }}{{ abs($detail['averageRevenue']) + 0 }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
