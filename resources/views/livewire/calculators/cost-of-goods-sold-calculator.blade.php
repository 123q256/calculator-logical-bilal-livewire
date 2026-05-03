<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-4">
                    <div class="col-span-12 lg:col-span-2">
                        <label for="inventory" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Beginning Inventory' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="inventory" id="inventory" class="input" aria-label="inventory" placeholder="30" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-2 mt-0 mt-lg-2">
                        <label for="purchases" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Purchases During Period' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="purchases" id="purchases" class="input" aria-label="purchases" placeholder="10" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-2 mt-0 mt-lg-2">
                        <label for="e_inventory" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Ending Inventory' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="e_inventory" id="e_inventory" class="input" aria-label="e_inventory" placeholder="10" />
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
                                        <td class="py-3" width="70%"><strong>{{ $lang['4'] ?? 'Cost of Goods Sold (COGS)' }}</strong></td>
                                        <td class="py-3 text-xl font-bold orange-text">{{ $currancy }} {{ $detail['COGS'] + 0 }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px] mt-15">
                                <p class="mt-2 font-bold text-lg text-blue-600 mb-4">{{ $lang['6'] ?? 'Calculation Breakdown' }}</p>
                                <div class="bg-gray-50 p-6 rounded-lg space-y-4 border">
                                    <p class="leading-relaxed">{{ $lang['7'] ?? 'The Cost of Goods Sold is calculated using the following basic accounting formula :' }}</p>
                                    <p class="font-bold py-2 px-4 bg-white rounded border border-blue-100 inline-block">
                                        COGS = {{ $lang['1'] ?? 'Beginning Inventory' }} + {{ $lang['2'] ?? 'Purchases' }} - {{ $lang['3'] ?? 'Ending Inventory' }}
                                    </p>
                                    
                                    <div class="pt-4 border-t border-gray-200 space-y-2">
                                        <p><strong>Calculation:</strong></p>
                                        <p class="pl-4 border-l-4 border-blue-200 italic">
                                            COGS = {{ $inventory + 0 }} + {{ $purchases + 0 }} - {{ $e_inventory + 0 }}<br>
                                            <span class="text-xl font-bold orange-text">COGS = {{ $currancy }} {{ $detail['COGS'] + 0 }}</span>
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
