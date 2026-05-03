<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="pay" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Salary Type' }}:</label>
                        <select wire:model.live="pay" id="pay" class="input">
                            <option value="1">{{ $lang['1'] ?? 'Hourly' }}</option>
                            <option value="2">{{ $lang['2'] ?? 'Daily' }}</option>
                            <option value="3">{{ $lang['3'] ?? 'Weekly' }}</option>
                            <option value="4">{{ $lang['4'] ?? 'Bi-weekly' }}</option>
                            <option value="5">{{ $lang['5'] ?? 'Semi-monthly' }}</option>
                            <option value="6">{{ $lang['6'] ?? 'Quarterly' }}</option>
                            <option value="7">{{ $lang['7'] ?? 'Annual' }}</option>
                        </select>
                    </div>
                    <div class="space-y-2 relative">
                        <label for="first" class="font-s-14 text-blue">{{ $txt1 }}:</label>
                        <input type="number" step="any" wire:model.live="first" id="first" class="input" aria-label="first" placeholder="50" />
                        <span class="text-blue input_unit">{{ $currency }}</span>
                    </div>
                    @if ($showSecond)
                        <div class="space-y-2 relative">
                            <label for="second" class="font-s-14 text-blue">{{ $txt2 }}:</label>
                            <input type="number" step="any" wire:model.live="second" id="second" class="input" aria-label="second" placeholder="40" />
                        </div>
                    @endif
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
                        <div class="w-full bg-light-blue rounded-lg mt-3">
                            <div class="py-4 border-b">
                                <h3 class="text-xl font-bold">{{ $lang[11] ?? 'Monthly Income' }}: <span class="orange-text">{{ $currency }} {{ number_format($detail['monthly_income'], 2) }}</span></h3>
                            </div>
                            <div class="lg:w-[80%] w-full overflow-auto pt-4">
                                <table class="w-full text-lg">
                                    <tr>
                                        <td class="py-2 border-b ">{{ $lang[12] ?? 'Hourly Income' }}</td>
                                        <td class="py-2 border-b  font-bold ">{{ $currency }} {{ number_format($detail['hourly_income'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b ">{{ $lang[13] ?? 'Daily Income' }}</td>
                                        <td class="py-2 border-b  font-bold ">{{ $currency }} {{ number_format($detail['daily_income'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b ">{{ $lang[14] ?? 'Weekly Income' }}</td>
                                        <td class="py-2 border-b  font-bold ">{{ $currency }} {{ number_format($detail['weekly_income'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b ">{{ $lang[15] ?? 'Bi-weekly Income' }}</td>
                                        <td class="py-2 border-b  font-bold ">{{ $currency }} {{ number_format($detail['bi_weekly_income'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b ">{{ $lang[16] ?? 'Semi-monthly Income' }}</td>
                                        <td class="py-2 border-b  font-bold ">{{ $currency }} {{ number_format($detail['sami_monthly_income'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b ">{{ $lang[17] ?? 'Quarterly Income' }}</td>
                                        <td class="py-2 border-b  font-bold ">{{ $currency }} {{ number_format($detail['quarterly_income'], 2) }}</td>
                                    </tr>
                                    <tr class="border-t-2 border-blue-200">
                                        <td class="py- font-bold text-xl">{{ $lang[18] ?? 'Annual Income' }}</td>
                                        <td class="py-2 font-bold text-2xl orange-text">{{ $currency }} {{ number_format($detail['annual_income'], 2) }}</td>
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
