<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2 relative">
                        <label for="first" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Dividends per period' }}:</label>
                        <input type="number" step="any" wire:model.live="first" id="first" class="input" aria-label="first" placeholder="15" />
                        <span class="text-blue input_unit">{{ $currency }}</span>
                    </div>
                    <div class="space-y-2">
                        <label for="operations" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Dividend frequency' }}</label>
                        <select wire:model.live="operations" id="operations" class="input" style="cursor: pointer;">
                            <option value="1">{{ $lang['3'] ?? 'Annually' }}</option>
                            <option value="2">{{ $lang['4'] ?? 'Semi-annually' }}</option>
                            <option value="3">{{ $lang['5'] ?? 'Quarterly' }}</option>
                            <option value="4">{{ $lang['6'] ?? 'Monthly' }}</option>
                        </select>
                    </div>
                    <div class="space-y-2 relative">
                        <label for="second" class="font-s-14 text-blue">{{ $lang['7'] ?? 'Share price' }}:</label>
                        <input type="number" step="any" wire:model.live="second" id="second" class="input" aria-label="second" placeholder="160" />
                        <span class="text-blue input_unit">{{ $currency }}</span>
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
                        <div class="w-full bg-light-blue rounded-lg mt-6">
                            <div class="lg:w-[80%] w-full overflow-auto mt-4">
                                <table class="w-full text-lg">
                                    <tr>
                                        <td class="py-2 border-b w-4/5"><strong>{{ $lang['8'] ?? 'Annual dividends' }} </strong></td>
                                        <td class="py-2 border-b">{{ $currency }} {{ round($detail['annual_div'], 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-4/5"><strong>{{ $lang['9'] ?? 'Dividend yield' }} </strong></td>
                                        <td class="py-2 border-b">{{ round($detail['dividend_yield'], 2) }} %</td>
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
