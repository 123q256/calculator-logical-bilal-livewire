<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="normal_pay" class="label">{{ $lang['1'] ?? 'Normal Pay Rate' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="normal_pay" id="normal_pay" class="input" aria-label="normal_pay" placeholder="15" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="normal_time" class="label">{{ $lang['2'] ?? 'Normal Hours Worked' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="normal_time" id="normal_time" class="input" aria-label="normal_time" placeholder="0" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="over_time" class="label">{{ $lang['3'] ?? 'Overtime Hours Worked' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="over_time" id="over_time" class="input" aria-label="over_time" placeholder="50" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="multiplier" class="label">{{ $lang['4'] ?? 'Overtime Multiplier' }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="multiplier" id="multiplier" class="input" style="cursor: pointer;">
                                <option value="1.5">{{ $lang[13] ?? '1.5x (Time and a Half)' }}</option>
                                <option value="2">{{ $lang[14] ?? '2x (Double Time)' }}</option>
                                <option value="3">{{ $lang[15] ?? '3x (Triple Time)' }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="pay_period" class="label">{{ $lang[23] ?? 'Pay Period' }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="pay_period" id="pay_period" class="input" style="cursor: pointer;">
                                <option value="52">{{ $lang[16] ?? 'Weekly (52 periods)' }}</option>
                                <option value="26">{{ $lang[17] ?? 'Bi-Weekly (26 periods)' }}</option>
                                <option value="24">{{ $lang[18] ?? 'Semi-Monthly (24 periods)' }}</option>
                                <option value="12">{{ $lang[19] ?? 'Monthly (12 periods)' }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="currency" class="label">{{ $lang[5] ?? 'Currency' }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="currency" id="currency" class="input" style="cursor: pointer;">
                                <option value="$">$</option>
                                <option value="£">£</option>
                                <option value="€">€</option>
                                <option value="¥">¥</option>
                            </select>
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
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="lg:w-[80%] w-full overflow-auto mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%">
                                            <strong>
                                                @if ($detail['multiplier'] == 1.5)
                                                    {{ $lang[8] ?? 'Time and a Half Pay Rate' }}
                                                @elseif($detail['multiplier'] == 2)
                                                    {{ $lang[20] ?? 'Double Time Pay Rate' }}
                                                @elseif($detail['multiplier'] == 3)
                                                    {{ $lang[22] ?? 'Triple Time Pay Rate' }}
                                                @endif
                                            </strong>
                                        </td>
                                        <td class="py-2 border-b">{{ $detail['currency'] }}{{ round($detail['half'], 2) }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="lg:w-[80%] w-full overflow-auto mt-2">
                                <table class="w-full text-[18px]">
                                    @if ($detail['over_time'] > 0)
                                        <tr>
                                            <td class="py-2 border-b" width="70%">{{ $lang[7] ?? 'Total Overtime Pay' }}</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['currency'] . ' ' . round($detail['half_pay'], 2) }}</strong></td>
                                        </tr>
                                    @endif
                                    @if ($detail['normal_time'] > 0)
                                        <tr>
                                            <td class="py-2 border-b" width="70%">{{ $lang[9] ?? 'Regular Pay' }}</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['currency'] . ' ' . round($detail['standered_pay'], 2) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="70%">{{ $lang[10] ?? 'Regular Pay per Year' }}</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['currency'] . ' ' . round($detail['Regular_Pay_per_Year'], 2) }}</strong></td>
                                        </tr>
                                    @endif
                                    @if ($detail['multiplier'] > 0 && $detail['over_time'] > 0)
                                        <tr>
                                            <td class="py-2 border-b" width="70%">{{ $lang[11] ?? 'Overtime Pay per Year' }}</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['currency'] . ' ' . round($detail['Overtime_Pay_per_Year'], 2) }}</strong></td>
                                        </tr>
                                    @endif

                                    @if ($detail['normal_time'] > 0 || $detail['over_time'] > 0)
                                        <tr>
                                            <td class="py-2 border-b" width="70%">{{ $lang[12] ?? 'Total Pay per Year' }}</td>
                                            <td class="py-2 border-b"><strong>{{ $detail['currency'] . ' ' . round($detail['Total_Pay_per_Year'], 2) }}</strong></td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
