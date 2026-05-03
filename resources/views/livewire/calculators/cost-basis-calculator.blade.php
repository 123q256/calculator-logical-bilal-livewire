<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <!-- Sale Price (Stock) -->
                    <div class="col-span-12">
                        <label for="stock" class="label">{{ $lang['1'] ?? 'Stock Sale Price' }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="stock" id="stock" class="input" placeholder="200" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Dynamic Purchase Rows -->
                    @foreach($shares as $index => $share)
                    <div class="col-span-12 grid grid-cols-12 gap-4 items-end  py-4 rounded-xl relative group">
                        @if(count($shares) > 2)
                        <button type="button" wire:click="removeRow({{ $index }})" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center shadow-md hover:bg-red-600 transition-colors z-10">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                        @endif
                        
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label class="label text-[16px]">{{ $lang[10] ?? 'Purchase' }} {{ $index + 1 }} {{ $lang[11] ?? 'Shares' }}</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="shares.{{ $index }}" class="input" placeholder="50" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label class="label text-[16px]">{{ $lang[12] ?? 'Purchase' }} {{ $index + 1 }} {{ $lang[11] ?? 'Price' }}</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="prices.{{ $index }}" class="input" placeholder="50" />
                                <span class="text-blue input_unit">{{ $currancy }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- Add More Button -->
                    <div class="col-span-12 text-end mt-3">
                        <button type="button" wire:click="addRow" class="px-3 py-2 mx-1 addmore text-white bg-[#2845F5] rounded-[30px]">
                            <span>+</span>{{ $lang[7] ?? 'Add More' }}
                        </button>
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
                        <div class="w-full lg:w-[80%] mt-2 overflow-auto">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[8] ?? 'Cost Basis' }}</strong></td>
                                    <td class="py-2 border-b">{{ $currancy }}{{ $detail['cost_basis'] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">
                                        <strong>{{ $detail['stock_profit'] <= 0 ? ($lang['loss_text'] ?? "Stock Loss") : ($lang['profit_text'] ?? "Stock Profit") }} {{ $detail['stock_profit'] <= 0 ? "-" : "" }}</strong>
                                    </td>
                                    <td class="py-2 border-b">{{ $currancy }}{{ abs($detail['stock_profit']) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%">
                                        <strong>{{ $detail['percentage'] <= 0 ? ($lang['loss_percent'] ?? "Loss Percentage") : ($lang['profit_percent'] ?? "Profit Percentage") }}</strong>
                                    </td>
                                    <td class="py-2 border-b">{{ $detail['percentage'] }}%</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[9] ?? 'Total Shares' }}</strong></td>
                                    <td class="py-2 border-b">{{ $detail['total_shares'] }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endisset
    </form>
</div>
