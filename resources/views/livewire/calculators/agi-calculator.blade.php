<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-8 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
              <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 mt-3">
                    <div class="col-span-full mb-2">
                        <h3 class="text-2xl font-bold text-blue border-b-2 border-blue/20 pb-2">{{ $lang[1] ?? 'Gross Income' }}:</h3>
                    </div>
                    
                    <!-- Income Inputs (1-13) -->
                    <div class="flex flex-col space-y-2 relative">
                        <label for="input1" class="font-semibold">{{ $lang['2'] ?? 'Salary, Wages, and Tip' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input1" id="input1" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input2" class="font-semibold">{{ $lang['3'] ?? 'Interest, Dividends, and Royalties' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input2" id="input2" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input3" class="font-semibold">{{ $lang['5'] ?? 'Social Security Benefits' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input3" id="input3" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input4" class="font-semibold">{{ $lang['6'] ?? 'Alimony Received' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input4" id="input4" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input5" class="font-semibold">{{ $lang['8'] ?? 'Capital Gains and Losses' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input5" id="input5" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input6" class="font-semibold">{{ $lang['9'] ?? 'Real Estate/Rental Income' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input6" id="input6" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input7" class="font-semibold">{{ $lang['10'] ?? 'Unemployment Compensation' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input7" id="input7" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input8" class="font-semibold">{{ $lang['11'] ?? 'Taxable State Refunds' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input8" id="input8" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input9" class="font-semibold">{{ $lang['12'] ?? 'Pension / Annuity / IRA Distributions' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input9" id="input9" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input10" class="font-semibold">{{ $lang['13'] ?? 'Awards / Prizes / Winnings' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input10" id="input10" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input11" class="font-semibold">{{ $lang['16'] ?? 'Jury Duty Fees' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input11" id="input11" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input12" class="font-semibold">{{ $lang['19'] ?? 'Other Income' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input12" id="input12" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="col-span-full mt-8 mb-2">
                        <h3 class="text-2xl font-bold text-blue border-b-2 border-blue/20 pb-2">Deductions:</h3>
                    </div>

                    <!-- Deduction Inputs (14-24) -->
                    <div class="flex flex-col space-y-2 relative">
                        <label for="input14" class="font-semibold">{{ $lang['21'] ?? 'Educator Expenses' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input14" id="input14" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input15" class="font-semibold">{{ $lang['22'] ?? 'Contributions to Retirement / IRAs' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input15" id="input15" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input16" class="font-semibold">{{ $lang['23'] ?? 'Half of Self-Employment Tax' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input16" id="input16" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input17" class="font-semibold">{{ $lang['24'] ?? '(HSA) Contributions' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input17" id="input17" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input18" class="font-semibold">{{ $lang['25'] ?? 'Health Insurance Premiums' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input18" id="input18" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input19" class="font-semibold">{{ $lang['26'] ?? 'Retirement Plan Contributions' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input19" id="input19" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input20" class="font-semibold">{{ $lang['27'] ?? 'Alimony Paid' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input20" id="input20" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input21" class="font-semibold">{{ $lang['28'] ?? 'Moving Expenses' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input21" id="input21" class="input w-full" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 relative">
                        <label for="input22" class="font-semibold">{{ $lang['29'] ?? 'Other Deductions' }}:</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="input22" id="input22" class="input w-full" />
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

        @if ($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                        <div class="w-full md:w-[80%] lg:w-[80%] mt-5">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang['33'] ?? 'Total Income' }} </strong></td>
                                    <td class="py-2 border-b whitespace-nowrap">{{ $currancy }} {{ number_format($detail['add1'], 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong> {{ $lang['34'] ?? 'Total Adjustments' }} </strong></td>
                                    <td class="py-2 border-b whitespace-nowrap">{{ $currancy }} {{ number_format(abs($detail['add2']), 2) }}</td>
                                </tr>
                                <tr class="text-blue font-bold">
                                    <td class="py-4 border-b text-xl" width="70%">{{ $lang['35'] ?? 'Adjusted Gross Income (AGI)' }}</td>
                                    <td class="py-4 border-b whitespace-nowrap text-xl">{{ $currancy }} {{ number_format($detail['minus'], 2) }}</td>
                                </tr>
                            </table>
                        </div>
                </div>
            </div>
        @endif
    </form>
</div>
