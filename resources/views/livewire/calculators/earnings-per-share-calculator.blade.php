<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="net_income" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Net Income' }} (I):</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="net_income" id="net_income" class="input" aria-label="net_income" placeholder="8" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="dividends" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Preferred Dividends' }} (D):</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="dividends" id="dividends" class="input" aria-label="dividends" placeholder="4" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="common_shares" class="font-s-14 text-blue">{{ $lang['3'] ?? 'End-of-Period Common Shares Outstanding' }} (S):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="common_shares" id="common_shares" class="input" aria-label="common_shares" placeholder="4" />
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
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[4] ?? 'Earnings Per Share' }} ({{ $lang[6] ?? 'EPS' }}) </strong></td>
                                    <td class="py-2 border-b">{{ $currency }} {{ round($detail['share_dividends'], 2) }} {{ $lang[5] ?? 'per share' }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>{{ $lang[7] ?? 'Formula' }}</strong></p>
                            <p class="mt-2">{{$lang[6] ?? 'EPS'}} = (I - D) / S</p>
                            <p class="mt-2">{{$lang[6] ?? 'EPS'}} = ({{ $currency }} {{ $net_income }} - {{ $currency }} {{ $dividends }} ) / {{ $common_shares }}</p>
                            <p class="mt-2">{{$lang[6] ?? 'EPS'}} = {{ $currency }} {{ $net_income - $dividends }} / {{ $common_shares }}</p>
                            <p class="mt-2">{{$lang[6] ?? 'EPS'}} = {{ $currency }} {{ round($detail['share_dividends'], 2) }} </p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        @endisset
    </form>
</div>
