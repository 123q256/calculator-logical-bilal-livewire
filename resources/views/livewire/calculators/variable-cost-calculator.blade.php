<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="type_select" class="label">{{ $lang['1'] ?? 'Calculation Type' }}:</label>
                        <div class="w-full py-2 position-relative">
                            <select wire:model.live="type_select" id="type_select" class="input" style="cursor: pointer;">
                                <option value="average_cost"> Average Variable Cost </option>
                                <option value="variable_cost"> Variable Costs </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12">
                        @if($type_select === 'average_cost')
                            <label for="cost" class="label">{{ $lang['2'] ?? 'Variable Cost' }} (VC):</label>
                        @else
                            <label for="cost" class="label">{{ $lang['3'] ?? 'Total Cost' }}:</label>
                        @endif
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="cost" id="cost" class="input" aria-label="cost" placeholder="50" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        @if($type_select === 'average_cost')
                            <label for="output" class="label">{{ $lang['4'] ?? 'Quantity' }} (Q):</label>
                        @else
                            <label for="output" class="label">{{ $lang['5'] ?? 'Fixed Cost' }}:</label>
                        @endif
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="output" id="output" class="input" aria-label="output" placeholder="40" />
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
                            @if ($detail['type'] == 'average_cost')
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['6'] ?? 'Average Variable Cost' }} (AVC)</strong></td>
                                            <td class="py-2 border-b"> {{ $currency }} {{ round($detail['av_cost'], 4) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 text-[16px]">
                                    <p class="mt-3"><strong>{{ $lang['7'] ?? 'Formula' }}</strong></p>
                                    <p>
                                        AvgCost<sub>variable</sub> = 
                                        <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                            <span class="num">Cost <sub>variable</sub></span>
                                            <span class="den">Output <sub>total</sub></span>
                                        </span>
                                    </p>
                                    <p class="mt-2">{{ $lang['8'] ?? 'Calculation' }}</p>
                                    <p>
                                        AvgCost<sub>variable</sub> = 
                                        <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                            <span class="num">{{ round($detail['cost'], 2) }}</span>
                                            <span class="den">{{ round($detail['output'], 2) }}</span>
                                        </span>
                                    </p>
                                    <p class="mt-2">AvgCost<sub>variable</sub> = <strong>{{ $currency }}{{ round($detail['av_cost'], 4) }}</strong></p>
                                </div>
                            @endif

                            @if ($detail['type'] == 'variable_cost')
                                <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['2'] ?? 'Variable Cost' }} (VC)</strong></td>
                                            <td class="py-2 border-b"> {{ $currency }} {{ round($detail['v_cost'], 4) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-12 text-[16px]">
                                    <p class="mt-3"><strong>{{ $lang['7'] ?? 'Formula' }}</strong></p>
                                    <p class="mt-2">{{ $lang['2'] ?? 'Variable Cost' }} = {{ $lang['3'] ?? 'Total Cost' }} - {{ $lang['5'] ?? 'Fixed Cost' }}</p>
                                    <p class="mt-2">{{ $lang['8'] ?? 'Calculation' }}</p>
                                    <p class="mt-2">{{ $lang['2'] ?? 'Variable Cost' }} = {{ round($detail['cost'], 2) }} - {{ round($detail['output'], 2) }}</p>
                                    <p class="mt-2">{{ $lang['2'] ?? 'Variable Cost' }} = <strong>{{ round($detail['v_cost'], 4) }} {{ $currency }}</strong></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
</div>
