<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="find" class="label" style="cursor: pointer;">{{ $lang['1'] ?? 'What to find' }}:</label>
                        <div class="w-full py-2 relative">
                            <select class="input" wire:model.live="find" id="find" style="cursor: pointer;">
                                <option value="1">{{ $lang['2'] ?? 'Commission' }}</option>
                                <option value="2">{{ $lang['3'] ?? 'Commission with Sale Price' }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-field col-span-12 m-set" id="g-hide">
                        <p class="col med-set">
                            <label class="font_size16"><strong>{{ $lang['4'] ?? 'Select Input to Calculate' }} : </strong></label>
                        </p>
                        <p class="med-set1 flex justify-between">
                            <label class="g1" style="cursor: pointer;">
                                <input class="with-gap" type="radio" value="commission" wire:model.live="select1">
                                <span style="cursor: pointer;">{{ $lang['5'] ?? 'Commission' }}</span>
                            </label>
                            <label class="g2" style="cursor: pointer;">
                                <input class="with-gap" type="radio" value="sale_price" wire:model.live="select1">
                                <span style="cursor: pointer;">{{ $lang['6'] ?? 'Sale Price' }}</span>
                            </label>
                            <label class="g3" style="cursor: pointer;">
                                <input class="with-gap" type="radio" value="commission_rate" wire:model.live="select1">
                                <span style="cursor: pointer;">{{ $lang['7'] ?? 'Commission Rate' }}</span>
                            </label>
                        </p>
                    </div>

                    @if($select1 !== 'sale_price')
                        <div class="col-span-12" id="sp">
                            <label for="sale_price" class="label">{{ $lang['6'] ?? 'Sale Price' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="sale_price" id="sale_price" class="input" aria-label="sale_price" placeholder="50" />
                                <span class="text-blue input_unit">{{ $currency }}</span>
                            </div>
                        </div>
                    @endif

                    @if($select1 !== 'commission_rate')
                        <div class="col-span-12" id="cr">
                            <label for="commission_rate" class="label">{{ $lang['7'] ?? 'Commission Rate' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="commission_rate" id="commission_rate" class="input" aria-label="commission_rate" placeholder="50" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                    @endif

                    @if($select1 !== 'commission')
                        <div class="col-span-12" id="c">
                            <label for="commission_amount" class="label">{{ $lang['5'] ?? 'Commission Amount' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="commission_amount" id="commission_amount" class="input" aria-label="commission_amount" placeholder="50" />
                                <span class="text-blue input_unit">{{ $currency }}</span>
                            </div>
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
                        <div class="w-full mt-3">
                            @if($detail['calculate'] == "1" || $detail['calculate'] == "2")
                                <div class="lg:w-[80%] w-full overflow-auto mt-2">
                                    @if($detail['find'] == "1")
                                        <table class="w-full font-s-18">
                                            @if($detail['calculate'] == "1")
                                                <tr>
                                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['5'] ?? 'Commission' }} </strong></td>
                                                    <td class="py-2 border-b"> {{ $currency }} {{ round($detail['ans'], 3) }}</td>
                                                </tr>
                                            @endif
                                            @if($detail['calculate'] == "2")
                                                <tr>
                                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['8'] ?? 'Commission Amount' }} </strong></td>
                                                    <td class="py-2 border-b"> {{ $currency }} {{ round($detail['ans'], 3) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['9'] ?? 'Sale Price after Commission' }} </strong></td>
                                                    <td class="py-2 border-b"> {{ $currency }} {{ $detail['sale_price'] - $detail['ans'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['10'] ?? 'Total Sale Price' }} </strong></td>
                                                    <td class="py-2 border-b"> {{ $currency }} {{ $detail['sale_price'] + $detail['ans'] }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                    @endif
                                    @if($detail['find'] == "2")
                                        <table class="w-full text-[18px]">
                                            @if($detail['calculate'] == "1" || $detail['calculate'] == "2")
                                                <tr>
                                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['6'] ?? 'Sale Price' }} </strong></td>
                                                    <td class="py-2 border-b"> {{ $currency }} {{ round($detail['ans'], 3) }}</td>
                                                </tr>
                                            @endif
                                            @if($detail['calculate'] == "2")
                                                <tr>
                                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['9'] ?? 'Sale Price after Commission' }} </strong></td>
                                                    <td class="py-2 border-b"> {{ $currency }} {{ $detail['ans'] - $detail['commission_amount'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['10'] ?? 'Total Sale Price' }} </strong></td>
                                                    <td class="py-2 border-b"> {{ $currency }} {{ $detail['ans'] + $detail['commission_amount'] }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                    @endif

                                    @if($detail['find'] == "3")
                                        <table class="w-full text-[18px]">
                                            @if($detail['calculate'] == "1")
                                                <tr>
                                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['7'] ?? 'Commission Rate' }} </strong></td>
                                                    <td class="py-2 border-b"> {{ round($detail['ans'], 2) }} % </td>
                                                </tr>
                                            @endif
                                            @if($detail['calculate'] == "2")
                                                <tr>
                                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['11'] ?? 'Commission Rate Percentage' }} </strong></td>
                                                    <td class="py-2 border-b"> {{ round($detail['ans'], 2) }} % </td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['9'] ?? 'Sale Price after Commission' }} </strong></td>
                                                    <td class="py-2 border-b"> {{ $currency }} {{ round($detail['sale_price'] - $detail['commission_amount'], 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['10'] ?? 'Total Sale Price' }} </strong></td>
                                                    <td class="py-2 border-b"> {{ $currency }} {{ round($detail['sale_price'] + $detail['commission_amount'], 2) }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
