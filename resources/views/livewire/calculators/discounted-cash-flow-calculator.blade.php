<div>
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if ($error)
            <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
        @endif

        <div class="lg:w-[90%] md:w-[90%] w-full mx-auto">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12">
                    <label for="main_unit" class="label">{{ $lang['1'] ?? 'Valuation Method' }}:</label>
                    <div class="w-full py-2 relative">
                        <select wire:model.live="main_unit" class="input" id="main_unit">
                            <option value="{{ $lang[2] ?? 'Free cash flow to firm (FCFF)' }}">{{ $lang[2] ?? 'Free cash flow to firm (FCFF)' }}</option>
                            <option value="{{ $lang[3] ?? 'Earnings per share (EPS)' }}">{{ $lang[3] ?? 'Earnings per share (EPS)' }}</option>
                        </select>
                    </div>
                </div>

                @if ($main_unit === ($lang[2] ?? 'Free cash flow to firm (FCFF)'))
                    <div class="col-span-12">
                        <div class="grid grid-cols-12 gap-4">
                            <p class="col-span-12 px-2 font-bold text-sm">{{ $lang[4] ?? 'Cash Flow Projections' }}</p>
                            
                            @foreach ($fcff_inputs as $index => $value)
                                <div class="col-span-12 md:col-span-6">
                                    <label class="label">FCFF {{ $index + 1 }}</label>
                                    <div class="w-full py-2 relative flex items-center gap-2">
                                        <div class="relative flex-1">
                                            <input type="number" step="any" wire:model.blur="fcff_inputs.{{ $index }}" class="input" placeholder="50" />
                                            <span class="input_unit">{{ $currancy }}</span>
                                        </div>
                                        @if(count($fcff_inputs) > 1)
                                            <button type="button" wire:click="removeInput({{ $index }})" class="p-2 text-red-500 hover:text-red-700 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            @if(count($fcff_inputs) < 8)
                                <div class="col-span-12 text-end">
                                    <button type="button" wire:click="addInput" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-all flex items-center gap-2 ml-auto">
                                        <span>+</span> {{ $lang['add_row'] ?? 'Add Row' }}
                                    </button>
                                </div>
                            @endif

                            <div class="col-span-12 mt-4">
                                <p class="px-2 font-bold text-sm">{{ $lang[5] ?? 'Balance Sheet Items' }}</p>
                                <div class="grid grid-cols-12 gap-4 mt-2">
                                    <div class="col-span-12 md:col-span-6">
                                        <label class="label">{{ $lang[6] ?? 'Cash and Cash Equivalents' }}</label>
                                        <div class="w-full py-2 relative">
                                            <input type="number" step="any" wire:model.blur="cash" class="input" placeholder="50" />
                                            <span class="input_unit">{{ $currancy }}</span>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6">
                                        <label class="label">{{ $lang[7] ?? 'Total Debt' }}</label>
                                        <div class="w-full py-2 relative">
                                            <input type="number" step="any" wire:model.blur="outstanding" class="input" placeholder="60000" />
                                            <span class="input_unit">{{ $currancy }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-12 mt-4">
                                <p class="px-2 font-bold text-sm">{{ $lang[8] ?? 'Growth and Discount Rates' }}</p>
                                <div class="grid grid-cols-12 gap-4 mt-2">
                                    <div class="col-span-12 md:col-span-6">
                                        <label class="label">{{ $lang[9] ?? 'Perpetual Growth Rate' }}</label>
                                        <div class="w-full py-2 relative">
                                            <input type="number" step="any" wire:model.blur="perpetual" class="input" placeholder="4.48" />
                                            <span class="input_unit">%</span>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6">
                                        <label class="label">{{ $lang[10] ?? 'WACC' }}</label>
                                        <div class="w-full py-2 relative">
                                            <input type="number" step="any" wire:model.blur="wacc" class="input" placeholder="9.94" />
                                            <span class="input_unit">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-12 mt-4">
                                <p class="px-2 font-bold text-sm">{{ $lang[11] ?? 'Share Information' }}</p>
                                <div class="grid grid-cols-12 gap-4 mt-2">
                                    <div class="col-span-12 md:col-span-6">
                                        <label class="label">{{ $lang[12] ?? 'Shares Outstanding' }}</label>
                                        <div class="w-full py-2 relative">
                                            <input type="number" step="any" wire:model.blur="shares" class="input" placeholder="1000" />
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6">
                                        <label class="label">{{ $lang[13] ?? 'Current Price' }}</label>
                                        <div class="w-full py-2 relative">
                                            <input type="number" step="any" wire:model.blur="price" class="input" placeholder="17" />
                                            <span class="input_unit">{{ $currancy }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-span-12">
                        <div class="grid grid-cols-12 gap-4">
                            <p class="col-span-12 px-2 font-bold text-sm">{{ $lang[14] ?? 'Earnings and Discount' }}</p>
                            <div class="col-span-12 md:col-span-6">
                                <label class="label">{{ $lang[15] ?? 'Current EPS' }}</label>
                                <div class="w-full py-2 relative">
                                    <input type="number" step="any" wire:model.blur="earnings" class="input" placeholder="200" />
                                    <span class="input_unit">{{ $currancy }}</span>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <label class="label">{{ $lang[16] ?? 'Discount Rate' }}</label>
                                <div class="w-full py-2 relative">
                                    <input type="number" step="any" wire:model.blur="discount" class="input" placeholder="11" />
                                    <span class="input_unit">%</span>
                                </div>
                            </div>

                            <p class="col-span-12 px-2 font-bold text-sm mt-4">{{ $lang[17] ?? 'Predictable Growth' }}</p>
                            <div class="col-span-12 md:col-span-4">
                                <label class="label">{{ $lang[18] ?? 'Growth Rate' }}</label>
                                <div class="w-full py-2 relative">
                                    <input type="number" step="any" wire:model.blur="growth" class="input" placeholder="200" />
                                    <span class="input_unit">%</span>
                                </div>
                            </div>

                            @if($growth_unit === 'yrs/mos')
                                <div class="col-span-6 md:col-span-3">
                                    <label class="label">{{ $lang[19] ?? 'Growth Period' }}</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" step="any" wire:model.blur="growth_time_one" class="input" placeholder="200" />
                                        <span class="input_unit">yrs</span>
                                    </div>
                                </div>
                                <div class="col-span-6 md:col-span-2">
                                    <label class="label">&nbsp;</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" step="any" wire:model.blur="growth_time_sec" class="input" placeholder="1" />
                                        <span class="input_unit">mos</span>
                                    </div>
                                </div>
                            @else
                                <div class="col-span-12 md:col-span-5">
                                    <label class="label">{{ $lang[19] ?? 'Growth Period' }}</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" step="any" wire:model.blur="growth_time" class="input" placeholder="1" />
                                        <span class="input_unit">{{ $growth_unit === 'mos' ? 'mos' : 'yrs' }}</span>
                                    </div>
                                </div>
                            @endif

                            <div class="col-span-12 md:col-span-3">
                                <label class="label">{{ $lang['unit'] ?? 'Unit' }}</label>
                                <div class="w-full py-2 relative">
                                    <select wire:model.live="growth_unit" class="input">
                                        <option value="mos">mos</option>
                                        <option value="yrs">yrs</option>
                                        <option value="yrs/mos">yrs/mos</option>
                                    </select>
                                </div>
                            </div>

                            <p class="col-span-12 px-2 font-bold text-sm mt-4">{{ $lang[20] ?? 'Terminal Growth' }}</p>
                            <div class="col-span-12 md:col-span-4">
                                <label class="label">{{ $lang[21] ?? 'Terminal Rate' }}</label>
                                <div class="w-full py-2 relative">
                                    <input type="number" step="any" wire:model.blur="terminal" class="input" placeholder="200" />
                                    <span class="input_unit">%</span>
                                </div>
                            </div>

                            @if($terminal_unit === 'yrs/mos')
                                <div class="col-span-6 md:col-span-3">
                                    <label class="label">{{ $lang[19] ?? 'Terminal Period' }}</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" step="any" wire:model.blur="terminal_one" class="input" placeholder="200" />
                                        <span class="input_unit">yrs</span>
                                    </div>
                                </div>
                                <div class="col-span-6 md:col-span-2">
                                    <label class="label">&nbsp;</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" step="any" wire:model.blur="terminal_sec" class="input" placeholder="1" />
                                        <span class="input_unit">mos</span>
                                    </div>
                                </div>
                            @else
                                <div class="col-span-12 md:col-span-5">
                                    <label class="label">{{ $lang[19] ?? 'Terminal Period' }}</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" step="any" wire:model.blur="terminal_time" class="input" placeholder="1" />
                                        <span class="input_unit">{{ $terminal_unit === 'mos' ? 'mos' : 'yrs' }}</span>
                                    </div>
                                </div>
                            @endif

                            <div class="col-span-12 md:col-span-3">
                                <label class="label">{{ $lang['unit'] ?? 'Unit' }}</label>
                                <div class="w-full py-2 relative">
                                    <select wire:model.live="terminal_unit" class="input">
                                        <option value="mos">mos</option>
                                        <option value="yrs">yrs</option>
                                        <option value="yrs/mos">yrs/mos</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

                @if ($type == 'calculator')
                    @include('inc.button')
                @else
                    @include('inc.widget-button')
                @endif
        </div>
    </div>

    <hr>

    @isset($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-5">
                        @if ($main_unit === ($lang[3] ?? 'Earnings per share (EPS)'))
                            <div class="w-full lg:w-[80%] overflow-auto">
                                <h3 class="text-xl font-bold mb-4">{{ $lang[28] ?? 'Intrinsic Value Calculation' }}</h3>
                                <table class="w-full border-collapse">
                                    <tr class="border-b ">
                                        <td class="py-2 font-medium" width="70%">{{ $lang[29] ?? 'Growth Value' }}</td>
                                        <td class="py-2 text-right font-bold text-blue-700">{{ $currancy }}{{ number_format($detail['groeth_answer'], 4) }}</td>
                                    </tr>
                                    <tr class="border-b ">
                                        <td class="py-2 font-medium">{{ $lang[30] ?? 'Terminal Value' }}</td>
                                        <td class="py-2 text-right font-bold text-blue-700">{{ $currancy }}{{ number_format($detail['terminal_answer'], 4) }}</td>
                                    </tr>
                                    <tr class="bg-blue-50/50">
                                        <td class="py-4 px-2 font-bold">{{ $lang[31] ?? 'Total Intrinsic Value' }}</td>
                                        <td class="py-4 px-2 text-right font-bold text-blue-800 text-lg">{{ $currancy }}{{ number_format($detail['Total_intrinsic_answer'], 4) }}</td>
                                    </tr>
                                </table>
                            </div>
                        @else
                            <div class="w-full lg:w-[80%] overflow-auto">
                                <h3 class="text-xl font-bold mb-2">{{ $lang[14] ?? 'Valuation Summary' }}</h3>
                                <p class="text-sm mb-4">{{ $lang[22] ?? 'Based on Free Cash Flow to Firm (FCFF)' }}</p>
                                <table class="w-full border-collapse">
                                    <tr class="border-b ">
                                        <td class="py-2 font-medium" width="70%">{{ $lang[23] ?? 'Terminal Value' }}</td>
                                        <td class="py-2 text-right font-semibold">{{ $currancy }}{{ number_format($detail['terminal_value'], 4) }}</td>
                                    </tr>
                                    <tr class="border-b ">
                                        <td class="py-2 font-medium">{{ $lang[24] ?? 'Present Value of Cash Flows' }}</td>
                                        <td class="py-2 text-right font-semibold">{{ $currancy }}{{ number_format($detail['answer_sec'], 4) }}</td>
                                    </tr>
                                    <tr class="border-b ">
                                        <td class="py-2 font-medium">{{ $lang[25] ?? 'Equity Value' }}</td>
                                        <td class="py-2 text-right font-semibold">{{ $currancy }}{{ number_format($detail['equdiry'], 4) }}</td>
                                    </tr>
                                    <tr class="bg-blue-50/50">
                                        <td class="py-4 px-2 font-bold">{{ $lang[26] ?? 'Intrinsic Value per Share' }}</td>
                                        <td class="py-4 px-2 text-right font-bold text-blue-800 text-lg">{{ $currancy }}{{ number_format($detail['fair_val'], 4) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 font-medium">{{ $lang[27] ?? 'Upside/Downside' }}</td>
                                        <td class="py-2 text-right font-bold {{ $detail['percentage'] < 0 ? 'text-red-600' : 'text-green-600' }}">
                                            {{ number_format($detail['percentage'], 2) }}%
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endisset
  </form>

</div>
