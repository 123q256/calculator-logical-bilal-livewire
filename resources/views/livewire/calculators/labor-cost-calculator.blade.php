<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="h_p_w" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Hours per week' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="h_p_w" id="h_p_w" class="input" aria-label="h_p_w" placeholder="40" min="0" />
                            <span class="text-blue input_unit">{{ $lang['2'] ?? 'Hours' }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="p_r" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Pay rate' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="p_r" id="p_r" class="input" aria-label="p_r" placeholder="10" min="0" />
                            <span class="text-blue input_unit">{{ $currency }}/{{ $lang['2'] ?? 'Hours' }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="a_d_p_y" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Absence days per year' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="a_d_p_y" id="a_d_p_y" class="input" aria-label="a_d_p_y" placeholder="15" min="0" />
                            <span class="text-blue input_unit">{{ $lang['5'] ?? 'Days' }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <p><strong>{{ $lang['23'] ?? 'Other Annual Costs' }}</strong></p>
                    </div>
                    <div class="col-span-6">
                        <label for="tax" class="font-s-14 text-blue">{{ $lang['6'] ?? 'Taxes' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="tax" id="tax" class="input" aria-label="tax" placeholder="900" min="0" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div> 
                    <div class="col-span-6">
                        <label for="insurance" class="font-s-14 text-blue">{{ $lang['7'] ?? 'Insurance' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="insurance" id="insurance" class="input" aria-label="insurance" placeholder="600" min="0" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="benefits" class="font-s-14 text-blue">{{ $lang['8'] ?? 'Benefits' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="benefits" id="benefits" class="input" aria-label="benefits" placeholder="1200" min="0" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="overtime" class="font-s-14 text-blue">{{ $lang['9'] ?? 'Overtime' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="overtime" id="overtime" class="input" aria-label="overtime" placeholder="800" min="0" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="supplies" class="font-s-14 text-blue">{{ $lang['10'] ?? 'Supplies' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="supplies" id="supplies" class="input" aria-label="supplies" placeholder="400" min="0" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="total_revenue" class="font-s-14 text-blue">{{ $lang['11'] ?? 'Total Annual Revenue' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="total_revenue" id="total_revenue" class="input" aria-label="total_revenue" placeholder="80000" min="0" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
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
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang['12'] ?? 'Annual Productive Labor Cost' }}</strong></td>
                                        <td class="py-2 border-b">{{ $currency }} {{ number_format($detail['annual_p_labor_cost'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang['13'] ?? 'Hourly Labor Cost' }}</strong></td>
                                        <td class="py-2 border-b">{{ $currency }} {{ number_format($detail['h_l_cost'], 3) }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="mt-8 text-[16px]">
                                <p class="mt-3 font-bold text-lg text-blue-600 border-b pb-2 mb-4">{{ $lang['15'] ?? 'Detailed Calculation' }}:</p>
                                <div class="space-y-4">
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="font-bold mb-2">1. {{ $lang['16'] ?? 'Calculate' }} {{ $lang['17'] ?? 'Gross Pay' }}.</p>
                                        <p class="ml-4">{{ $lang['18'] ?? 'Gross' }} {{ $lang['2'] ?? 'Hours' }} {{ $lang['19'] ?? 'per Year' }} = {{ $lang['1'] ?? 'Hours/Week' }} × 52</p>
                                        <p class="ml-4">{{ $lang['18'] ?? 'Gross' }} {{ $lang['2'] ?? 'Hours' }} {{ $lang['19'] ?? 'per Year' }} = {{ $detail['h_p_w'] }} × 52 = {{ number_format($detail['g_h_per_year']) }} {{ $lang['2'] ?? 'Hours' }}</p>
                                        <p class="ml-4">{{ $lang['17'] ?? 'Gross Pay' }} = {{ $lang['18'] ?? 'Gross' }} {{ $lang['2'] ?? 'Hours' }} {{ $lang['19'] ?? 'per Year' }} × {{ $lang['3'] ?? 'Pay Rate' }}</p>
                                        <p class="ml-4">{{ $lang['17'] ?? 'Gross Pay' }} = {{ number_format($detail['g_h_per_year']) }} × {{ number_format($detail['p_r'], 2) }} = {{ number_format($detail['gross_pay'], 2) }} {{ $currency }}</p>
                                    </div>

                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="font-bold mb-2">2. {{ $lang['16'] ?? 'Calculate' }} {{ $lang['22'] ?? 'Net' }} {{ $lang['2'] ?? 'Hours' }} {{ $lang['20'] ?? 'Worked' }}.</p>
                                        <p class="ml-4">{{ $lang['2'] ?? 'Hours' }} {{ $lang['21'] ?? 'Off' }} {{ $lang['20'] ?? 'Worked' }} {{ $lang['19'] ?? 'per Year' }} = {{ $lang['4'] ?? 'Absence Days' }} × 8</p>
                                        <p class="ml-4">{{ $lang['2'] ?? 'Hours' }} {{ $lang['21'] ?? 'Off' }} {{ $lang['20'] ?? 'Worked' }} {{ $lang['19'] ?? 'per Year' }} = {{ $detail['a_d_p_y'] }} × 8 = {{ number_format($detail['n_w_p_year']) }} {{ $lang['2'] ?? 'Hours' }}</p>
                                        <p class="ml-4">{{ $lang['22'] ?? 'Net' }} {{ $lang['2'] ?? 'Hours' }} {{ $lang['20'] ?? 'Worked' }} = Gross {{ $lang['2'] ?? 'Hours' }} {{ $lang['19'] ?? 'per Year' }} - {{ $lang['2'] ?? 'Hours' }} {{ $lang['21'] ?? 'Off' }}</p>
                                        <p class="ml-4">{{ $lang['22'] ?? 'Net' }} {{ $lang['2'] ?? 'Hours' }} {{ $lang['20'] ?? 'Worked' }} = {{ number_format($detail['g_h_per_year']) }} - {{ number_format($detail['n_w_p_year']) }} = {{ number_format($detail['net_h_work']) }} {{ $lang['2'] ?? 'Hours' }}</p>
                                    </div>

                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="font-bold mb-2">3. {{ $lang['16'] ?? 'Calculate' }} {{ $lang['23'] ?? 'Other Annual Costs' }}.</p>
                                        <p class="ml-4">{{ $lang['24'] ?? 'Total Other Costs' }} = {{ $lang['6'] ?? 'Tax' }} + {{ $lang['7'] ?? 'Insurance' }} + {{ $lang['8'] ?? 'Benefits' }} + {{ $lang['9'] ?? 'Overtime' }} + {{ $lang['10'] ?? 'Supplies' }}</p>
                                        <p class="ml-4">{{ $lang['24'] ?? 'Total Other Costs' }} = {{ number_format($detail['tax'], 2) }} + {{ number_format($detail['insurance'], 2) }} + {{ number_format($detail['benefits'], 2) }} + {{ number_format($detail['overtime'], 2) }} + {{ number_format($detail['supplies'], 2) }} = {{ number_format($detail['annual_cost'], 2) }} {{ $currency }}</p>
                                    </div>

                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="font-bold mb-2">4. {{ $lang['16'] ?? 'Calculate' }} {{ $lang['25'] ?? 'Total Labor Cost' }}.</p>
                                        <p class="ml-4">{{ $lang['12'] ?? 'Annual Productive Labor Cost' }} = {{ $lang['17'] ?? 'Gross Pay' }} + {{ $lang['24'] ?? 'Other Costs' }}</p>
                                        <p class="ml-4">{{ $lang['12'] ?? 'Annual Productive Labor Cost' }} = {{ number_format($detail['gross_pay'], 2) }} + {{ number_format($detail['annual_cost'], 2) }} = <strong><span class="text-accent-4 font-size-22 orange-text">{{ number_format($detail['annual_p_labor_cost'], 2) }} {{ $currency }}</span></strong></p>
                                    </div>

                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="font-bold mb-2">5. {{ $lang['16'] ?? 'Calculate' }} {{ $lang['13'] ?? 'Hourly Labor Cost' }}.</p>
                                        <div class="ml-4 flex items-center space-x-2">
                                            <span>{{ $lang['13'] ?? 'Hourly Labor Cost' }} = </span>
                                            <div class="flex flex-col items-center border-l border-r px-2">
                                                <span class="border-b">{{ $lang['12'] ?? 'Annual Cost' }}</span>
                                                <span>Net {{ $lang['2'] ?? 'Hours' }} {{ $lang['20'] ?? 'Worked' }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-4 flex items-center space-x-2 mt-2">
                                            <span>{{ $lang['13'] ?? 'Hourly Labor Cost' }} = </span>
                                            <div class="flex flex-col items-center border-l border-r px-2">
                                                <span class="border-b">{{ number_format($detail['annual_p_labor_cost'], 2) }}</span>
                                                <span>{{ number_format($detail['net_h_work']) }}</span>
                                            </div>
                                            <span class="font-bold text-blue-600">= {{ number_format($detail['h_l_cost'], 3) }} {{ $currency }}</span>
                                        </div>
                                    </div>

                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <p class="font-bold mb-2">6. {{ $lang['16'] ?? 'Calculate' }} {{ $lang['26'] ?? 'Labor Cost Percentage' }}.</p>
                                        <div class="ml-4 flex items-center space-x-2">
                                            <span>{{ $lang['26'] ?? 'Percentage' }} = </span>
                                            <div class="flex flex-col items-center border-l border-r px-2">
                                                <span class="border-b">{{ $lang['12'] ?? 'Annual Cost' }}</span>
                                                <span>{{ $lang['11'] ?? 'Total Revenue' }}</span>
                                            </div>
                                            <span>× 100</span>
                                        </div>
                                        <div class="ml-4 flex items-center space-x-2 mt-2">
                                            <span>{{ $lang['26'] ?? 'Percentage' }} = </span>
                                            <div class="flex flex-col items-center border-l border-r px-2">
                                                <span class="border-b">{{ number_format($detail['annual_p_labor_cost'], 2) }}</span>
                                                <span>{{ number_format($detail['total_revenue'], 2) }}</span>
                                            </div>
                                            <span>× 100 = <strong><span class="text-accent-4 font-size-22 orange-text">{{ number_format($detail['l_c_percentge'] * 100, 1) }}%</span></strong></span>
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
