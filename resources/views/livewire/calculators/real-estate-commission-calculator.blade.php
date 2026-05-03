<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="housePrice" class="font-s-14 text-blue">{{ $lang['1'] ?? 'House Price' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="housePrice" id="housePrice" class="input" aria-label="housePrice" placeholder="1680000" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="commissionRate" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Commission Rate' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="commissionRate" id="commissionRate" class="input" aria-label="commissionRate" placeholder="10" />
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
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr class="border-b">
                                        <td class="py-3" width="60%"><strong>{{ $lang['3'] ?? 'Commission Amount' }}</strong></td>
                                        <td class="py-3 text-xl font-bold orange-text">{{ $currancy }} {{ round($detail['commissionAmount'], 2) + 0 }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3" width="60%"><strong>{{ $lang['4'] ?? 'Owner Receives' }}</strong></td>
                                        <td class="py-3 font-semibold text-blue-700">{{ $currancy }} {{ round($detail['ownerReceives'], 2) + 0 }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="w-full text-[16px] mt-10">
                                <p class="mt-2 font-bold text-lg text-blue-600 border-b pb-2 mb-4">Calculation Breakdown</p>
                                <div class="bg-gray-50 p-6 rounded-lg space-y-4 border">
                                    <p><strong>Step 1: Calculate Commission Amount</strong></p>
                                    <p class="pl-4 border-l-4 border-blue-200">
                                        Commission = (House Price * Commission Rate) / 100<br>
                                        Commission = ({{ $housePrice + 0 }} * {{ $commissionRate + 0 }}) / 100 = <strong>{{ $currancy }} {{ round($detail['commissionAmount'], 2) + 0 }}</strong>
                                    </p>
                                    
                                    <p class="pt-4"><strong>Step 2: Calculate Amount for Owner</strong></p>
                                    <p class="pl-4 border-l-4 border-green-200">
                                        Owner Receives = House Price - Commission Amount<br>
                                        Owner Receives = {{ $housePrice + 0 }} - {{ round($detail['commissionAmount'], 2) + 0 }} = <strong>{{ $currancy }} {{ round($detail['ownerReceives'], 2) + 0 }}</strong>
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
