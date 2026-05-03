<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-6 text-center border-b pb-2">
                        <p class="text-blue-700 font-bold uppercase tracking-wider text-sm">{{ $lang['1'] ?? 'Assets' }}</p>
                    </div>
                    <div class="col-span-6 text-center border-b pb-2">
                        <p class="text-red-700 font-bold uppercase tracking-wider text-sm">{{ $lang['8'] ?? 'Liabilities' }}</p>
                    </div>

                    <!-- Row 1 -->
                    <div class="col-span-6">
                        <label for="as_real" class="label text-xs">{{ $lang['2'] ?? 'Real Estate' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="as_real" id="as_real" class="input" aria-label="as_real" placeholder="00" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="li_real" class="label text-xs">{{ $lang['9'] ?? 'Mortgage' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="li_real" id="li_real" class="input" aria-label="li_real" placeholder="00" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Row 2 -->
                    <div class="col-span-6">
                        <label for="as_check" class="label text-xs">{{ $lang['3'] ?? 'Checking Acct' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="as_check" id="as_check" class="input" aria-label="as_check" placeholder="00" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="li_card" class="label text-xs">{{ $lang['10'] ?? 'Credit Cards' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="li_card" id="li_card" class="input" aria-label="li_card" placeholder="00" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="col-span-6">
                        <label for="as_saving" class="label text-xs">{{ $lang['4'] ?? 'Savings Acct' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="as_saving" id="as_saving" class="input" aria-label="as_saving" placeholder="00" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="li_loan" class="label text-xs">{{ $lang['11'] ?? 'Personal Loans' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="li_loan" id="li_loan" class="input" aria-label="li_loan" placeholder="00" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Row 4 -->
                    <div class="col-span-6">
                        <label for="as_retire" class="label text-xs">{{ $lang['5'] ?? 'Retirement' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="as_retire" id="as_retire" class="input" aria-label="as_retire" placeholder="00" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="li_stload" class="label text-xs">{{ $lang['12'] ?? 'Student Loans' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="li_stload" id="li_stload" class="input" aria-label="li_stload" placeholder="00" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Row 5 -->
                    <div class="col-span-6">
                        <label for="as_car" class="label text-xs">{{ $lang['6'] ?? 'Car Value' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="as_car" id="as_car" class="input" aria-label="as_car" placeholder="00" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="li_car" class="label text-xs">{{ $lang['13'] ?? 'Car Loans' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="li_car" id="li_car" class="input" aria-label="li_car" placeholder="00" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Row 6 -->
                    <div class="col-span-6">
                        <label for="as_other" class="label text-xs">{{ $lang['7'] ?? 'Other Assets' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="as_other" id="as_other" class="input" aria-label="as_other" placeholder="00" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="li_other" class="label text-xs">{{ $lang['14'] ?? 'Other Debts' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="li_other" id="li_other" class="input" aria-label="li_other" placeholder="00" />
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
                                        <td class="py-3" width="70%"><strong>{{ $lang['15'] ?? 'Estimated Net Worth' }}</strong></td>
                                        <td class="py-3 text-xl font-bold text-blue-700">{{ $currancy }} {{ $detail['net_worth'] + 0 }}</td>
                                    </tr>
                                    <tr class="border-b text-gray-600">
                                        <td class="py-3" width="70%">{{ $lang['1'] ?? 'Total Assets' }}</td>
                                        <td class="py-3 font-semibold">{{ $currancy }} {{ $detail['assets'] + 0 }}</td>
                                    </tr>
                                    <tr class="border-b text-gray-600">
                                        <td class="py-3" width="70%">{{ $lang['8'] ?? 'Total Liabilities' }}</td>
                                        <td class="py-3 font-semibold">{{ $currancy }} {{ $detail['liabilities'] + 0 }}</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div class="w-full text-[16px] mt-10">
                                <p class="mt-2 font-bold text-lg text-blue-600 border-b pb-2 mb-4">Calculation Breakdown</p>
                                <div class="bg-gray-50 p-6 rounded-lg space-y-4 border">
                                    <p class="leading-relaxed">Net Worth is the value of all your assets minus the total of all your liabilities.</p>
                                    <p class="font-bold py-2 px-4 bg-white rounded border border-blue-100 inline-block">
                                        Net Worth = Total Assets - Total Liabilities
                                    </p>
                                    
                                    <div class="pt-4 border-t border-gray-200 space-y-2 mt-2">
                                        <div class="pl-4 border-l-4 border-blue-200 italic space-y-2 mt-2">
                                            <p>Net Worth = {{ $detail['assets'] + 0 }} - {{ $detail['liabilities'] + 0 }}</p>
                                            <p class="text-xl font-bold orange-text pt-1">Net Worth = {{ $currancy }} {{ $detail['net_worth'] + 0 }}</p>
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
