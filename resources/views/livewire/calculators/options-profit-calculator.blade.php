<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-6">
                        <label for="ot" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Option Type' }}</label>
                        <select wire:model.live="ot" id="ot" class="input mt-2" style="cursor: pointer;">
                            <option value="c">{{ $lang['15'] ?? 'Call' }}</option>
                            <option value="p">{{ $lang['16'] ?? 'Put' }}</option>
                        </select>
                    </div>
                    <div class="col-span-6">
                        <label for="sp" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Strike Price' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="sp" id="sp" class="input" aria-label="sp" placeholder="10" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="op" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Option Price' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="op" id="op" class="input" aria-label="op" placeholder="10" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="stp" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Stock Price' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="stp" id="stp" class="input" aria-label="stp" placeholder="10" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="nc" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Number of Contracts' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="nc" id="nc" class="input" aria-label="nc" placeholder="10" />
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
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                </div>
                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                    <table class="w-full text-[18px]">
                        <tr>
                            @if ($detail['ans'] > 0)
                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['6'] ?? 'Net Profit' }} </strong></td>
                            @else
                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] ?? 'Net Loss' }} </strong></td>
                            @endif
                            <td class="py-2 border-b">{{ $currency }} {{ $detail['ans'] }}</td>
                        </tr>
                    </table>
                </div>
                <div class="w-full text-[18px]">
                    <p class="mt-2"><strong>{{ $lang['8'] ?? 'Calculation Steps' }}</strong></p>
                    <p class="mt-2"> {{ $lang['9'] ?? 'Equivalent Shares' }} = {{ $lang['10'] ?? 'Contracts' }} x 100</p>
                    <p class="mt-2"> {{ $lang['9'] ?? 'Equivalent Shares' }} = {{ $detail['nc'] }} x 100 </p>
                    <p class="mt-2"> {{ $lang['9'] ?? 'Equivalent Shares' }} = {{ $currency }} {{ $detail['ec'] }} </p>
                    <p class="mt-2"> {{ $lang['11'] ?? 'Total Strike Value' }} = {{ $lang['2'] ?? 'Strike Price' }} x {{ $lang['9'] ?? 'Equivalent Shares' }} </p>
                    <p class="mt-2"> {{ $lang['11'] ?? 'Total Strike Value' }} = {{ $detail['sp'] }} x {{ $detail['ec'] }} </p>
                    <p class="mt-2"> {{ $lang['11'] ?? 'Total Strike Value' }} = {{ $currency }} {{ $detail['sp'] * $detail['ec'] }}</p>
                    <p class="mt-2"> {{ $lang['12'] ?? 'Total Stock Value' }} = {{ $lang['4'] ?? 'Stock Price' }} x {{ $lang['9'] ?? 'Equivalent Shares' }}</p>
                    <p class="mt-2"> {{ $lang['12'] ?? 'Total Stock Value' }} = {{ $detail['stp'] }} x {{ $detail['ec'] }} </p>
                    <p class="mt-2"> {{ $lang['12'] ?? 'Total Stock Value' }} = {{ $currency }} {{ $detail['stp'] * $detail['ec'] }} </p>
                    <p class="mt-2"> {{ $lang['13'] ?? 'Total Option Cost' }} = {{ $lang['1'] ?? 'Option Price' }} x {{ $lang['9'] ?? 'Equivalent Shares' }}</p>
                    <p class="mt-2"> {{ $lang['13'] ?? 'Total Option Cost' }} = {{ $detail['op'] }} x {{ $detail['ec'] }} </p>
                    <p class="mt-2"> {{ $lang['13'] ?? 'Total Option Cost' }} = {{ $currency }} {{ $detail['op'] * $detail['ec'] }} </p>
                    
                    @if ($detail['ot'] == 'c')
                        <p class="mt-2"> {{ $lang['14'] ?? 'Net Profit/Loss' }} = {{ $lang['11'] ?? 'Total Strike Value' }} - {{ $lang['12'] ?? 'Total Stock Value' }} - {{ $lang['13'] ?? 'Total Option Cost' }}</p>
                        <p class="mt-2"> {{ $lang['14'] ?? 'Net Profit/Loss' }} = {{ $detail['sp'] * $detail['ec'] }} - {{ $detail['stp'] * $detail['ec'] }} - {{ $detail['op'] * $detail['ec'] }}</p>
                        <p class="mt-2"> {{ $lang['14'] ?? 'Net Profit/Loss' }} = {{ $currency }} {{ $detail['ans'] }} </p>
                    @else
                        <p class="mt-2"> {{ $lang['14'] ?? 'Net Profit/Loss' }} = {{ $lang['12'] ?? 'Total Stock Value' }} - {{ $lang['11'] ?? 'Total Strike Value' }} - {{ $lang['13'] ?? 'Total Option Cost' }}</p>
                        <p class="mt-2"> {{ $lang['14'] ?? 'Net Profit/Loss' }} = {{ $detail['stp'] * $detail['ec'] }} - {{ $detail['sp'] * $detail['ec'] }} - {{ $detail['op'] * $detail['ec'] }}</p>
                        <p class="mt-2"> {{ $lang['14'] ?? 'Net Profit/Loss' }} = {{ $currency }} {{ $detail['ans'] }} </p>
                    @endif
                </div>
            </div>
        @endisset
    </form>
</div>
