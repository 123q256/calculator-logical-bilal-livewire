<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="period" class="label">{{ $lang['1'] ?? 'Pay Frequency' }}:</label>
                        <select wire:model.live="period" id="period" class="input">
                            <option value="1">{{ $lang['2'] ?? 'Hourly' }}</option>
                            <option value="2">{{ $lang['3'] ?? 'Weekly' }}</option>
                            <option value="3">{{ $lang['4'] ?? 'Monthly' }}</option>
                            <option value="4">{{ $lang['5'] ?? 'Yearly' }}</option>
                        </select>
                    </div>

                    <div class="space-y-2 relative">
                        <label for="pay" class="label">{{ $lang['6'] ?? 'Current Pay' }}:</label>
                        <input type="number" step="any" wire:model.live="pay" id="pay" class="input"
                            aria-label="input" placeholder="50" />
                        <span class="text-blue input_unit">{{ $currancy }}</span>
                    </div>

                    <div class="space-y-2">
                        <label for="hour" class="label">{{ $lang['7'] ?? 'Hours per Week' }}:</label>
                        <input type="number" step="any" wire:model.live="hour" id="hour" class="input"
                            aria-label="input" placeholder="40" />
                    </div>

                    <div class="space-y-2">
                        <label for="type_selection" class="label">{{ $lang['8'] ?? 'Raise Type' }}:</label>
                        <select wire:model.live="type_selection" id="type_selection" class="input">
                            <option value="1">{{ $lang['9'] ?? 'Percentage' }}</option>
                            <option value="2">{{ $lang['10'] ?? 'Amount' }}</option>
                        </select>
                    </div>

                    <div class="space-y-2 relative">
                        <label for="new_raise" class="label">Pay Raise: (<span>{{ $type_selection == 1 ? '%' : $currancy }}</span>)</label>
                        <input type="number" step="any" wire:model.live="new_raise" id="new_raise" class="input"
                            aria-label="input" placeholder="40" />
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
                    <div class="rounded-lgr">
                        <div class="w-full md:w-[80%] lg:w-[80%] mt-2 space-y-8">
                            <!-- Overall Raise -->
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[9] ?? 'Overall Raise' }} (%) </strong></td>
                                    <td class="py-2 border-b whitespace-nowrap">{{ number_format($detail['percent'], 2) }}%</td>
                                </tr>
                            </table>

                            <!-- Current Pay -->
                            <div class="space-y-2">
                                <h3 class="font-bold text-xl">{{ $lang['11'] ?? 'Current Pay' }}</h3>
                                <table class="w-full text-lg">
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang['2'] ?? 'Hourly' }}</td>
                                        <td class="py-2 border-b whitespace-nowrap"> {{ number_format($detail['hourly'], 2) }} {{ $currancy }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang['3'] ?? 'Weekly' }}</td>
                                        <td class="py-2 border-b whitespace-nowrap"> {{ number_format($detail['weekly'], 2) }} {{ $currancy }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang['4'] ?? 'Monthly' }}</td>
                                        <td class="py-2 border-b whitespace-nowrap"> {{ number_format($detail['monthly'], 2) }} {{ $currancy }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang['5'] ?? 'Yearly' }}</td>
                                        <td class="py-2 border-b whitespace-nowrap"> {{ number_format($detail['yearly'], 2) }} {{ $currancy }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- New Pay -->
                            <div class="space-y-2">
                                <h3 class="font-bold text-xl">{{ $lang['12'] ?? 'New Pay after Raise' }}</h3>
                                <table class="w-full text-lg">
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang['2'] ?? 'Hourly' }}</td>
                                        <td class="py-2 border-b whitespace-nowrap font-bold text-blue"> {{ number_format(($detail['hourly'] + $detail['incHour']), 2) }} {{ $currancy }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang['3'] ?? 'Weekly' }}</td>
                                        <td class="py-2 border-b whitespace-nowrap font-bold text-blue"> {{ number_format(($detail['weekly'] + $detail['incWeek']), 2) }} {{ $currancy }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang['4'] ?? 'Monthly' }}</td>
                                        <td class="py-2 border-b whitespace-nowrap font-bold text-blue"> {{ number_format(($detail['monthly'] + $detail['incMonth']), 2) }} {{ $currancy }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang['5'] ?? 'Yearly' }}</td>
                                        <td class="py-2 border-b whitespace-nowrap font-bold text-blue"> {{ number_format(($detail['yearly'] + $detail['incYear']), 2) }} {{ $currancy }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Raise Amount -->
                            <div class="space-y-2">
                                <h3 class="font-bold text-xl">{{ $lang['13'] ?? 'Total Raise Amount' }}</h3>
                                <table class="w-full text-lg">
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang['2'] ?? 'Hourly' }}</td>
                                        <td class="py-2 border-b whitespace-nowrap"> {{ number_format($detail['incHour'], 2) }} {{ $currancy }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang['3'] ?? 'Weekly' }}</td>
                                        <td class="py-2 border-b whitespace-nowrap"> {{ number_format($detail['incWeek'], 2) }} {{ $currancy }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang['4'] ?? 'Monthly' }}</td>
                                        <td class="py-2 border-b whitespace-nowrap"> {{ number_format($detail['incMonth'], 2) }} {{ $currancy }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%">{{ $lang['5'] ?? 'Yearly' }}</td>
                                        <td class="py-2 border-b whitespace-nowrap"> {{ number_format($detail['incYear'], 2) }} {{ $currancy }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
