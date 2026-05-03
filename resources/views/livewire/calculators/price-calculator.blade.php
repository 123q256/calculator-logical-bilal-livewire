<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="price" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Cost Price' }} (C):</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="price" id="price" class="input" aria-label="price" placeholder="500" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="gross" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Gross Margin' }} (G):</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="gross" min="0" max="100" id="gross" class="input" aria-label="gross" placeholder="70" />
                            <span class="text-blue input_unit">%</span>
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
            <div class="">
                <div class="w-full mt-5">
                    <div class="w-full lg:w-[80%] overflow-auto mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] ?? 'Revenue' }} (R) </strong></td>
                                <td class="py-2 border-b"> {{ $currancy }}{{ $detail['revenue'] + 0 }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[4] ?? 'Gross Profit' }} (P)</strong></td>
                                <td class="py-2 border-b"> {{ $currancy }}{{ $detail['gross_profit'] + 0 }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[5] ?? 'Mark-up' }} (M)</strong></td>
                                <td class="py-2 border-b"> {{ $detail['mark_up'] + 0 }}%</td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-[16px] mt-2">
                        <p class="mt-2"><strong>{{ $lang[7] ?? 'Calculation Breakdown' }}</strong></p>
                        <p class="mt-2"> {{ $lang[3] ?? 'Revenue' }} = {{ $lang[1] ?? 'Cost' }} / (1 - {{ $lang[2] ?? 'Margin' }}) </p>
                        <p class="mt-2"> {{ $lang[3] ?? 'Revenue' }} = {{ $price + 0 }} / (1 - {{ $gross + 0 }}/100) </p>
                        <p class="mt-2 text-blue-700 font-bold"> {{ $lang[3] ?? 'Revenue' }} = {{ $currancy }}{{ $detail['revenue'] + 0 }}</p>
                        
                        <p class="mt-4"> {{ $lang[4] ?? 'Profit' }} = {{ $lang[3] ?? 'Revenue' }} × {{ $lang[2] ?? 'Margin' }} </p>
                        <p class="mt-2"> {{ $lang[4] ?? 'Profit' }} = {{ $detail['revenue'] + 0 }} × {{ $gross / 100 }} </p>
                        <p class="mt-2 text-blue-700 font-bold"> {{ $lang[4] ?? 'Profit' }} = {{ $currancy }}{{ $detail['gross_profit'] + 0 }} </p>
                        
                        <p class="mt-4"> {{ $lang[5] ?? 'Markup' }} = {{ $lang[4] ?? 'Profit' }} / {{ $lang[1] ?? 'Cost' }} × 100</p>
                        <p class="mt-2"> {{ $lang[5] ?? 'Markup' }} = {{ $detail['gross_profit'] + 0 }} / {{ $price + 0 }} × 100 </p>
                        <p class="mt-2 text-blue-700 font-bold"> {{ $lang[5] ?? 'Markup' }} = {{ $detail['mark_up'] + 0 }}% </p>
                    </div>
                </div>
            </div>
        </div>
            </div>
        @endisset
    </form>
</div>
