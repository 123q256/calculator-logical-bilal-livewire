<div>
    <style>
        img { object-fit: contain; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-4">
                    {{-- Select Mode --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="to_cal" class="label font-semibold text-blue">{{ $lang['1'] ?? 'Select Mode' }}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="to_cal" id="to_cal" class="input">
                                <option value="1">{{ $lang['c'] ?? 'Cost' }} & {{ $lang['d'] ?? 'Markup' }}</option>
                                <option value="2">{{ $lang['c'] ?? 'Cost' }} & {{ $lang['b'] ?? 'Revenue' }}</option>
                                <option value="3">{{ $lang['c'] ?? 'Cost' }} & {{ $lang['a'] ?? 'Profit' }}</option>
                                <option value="4">{{ $lang['d'] ?? 'Markup' }} & {{ $lang['b'] ?? 'Revenue' }}</option>
                                <option value="5">{{ $lang['d'] ?? 'Markup' }} & {{ $lang['a'] ?? 'Profit' }}</option>
                                <option value="6">{{ $lang['b'] ?? 'Revenue' }} & {{ $lang['a'] ?? 'Profit' }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Dynamic Inputs based on to_cal --}}
                    
                    {{-- Input A (Cost) --}}
                    @if (in_array($to_cal, ['1', '2', '3']))
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="a" class="label text-blue">{{ $lang['c'] ?? 'Cost' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="a" id="a" class="input" placeholder="10" />
                            <span class="text-blue input_unit absolute right-4 top-1/2 -translate-y-1/2 font-semibold">{{ $currency }}</span>
                        </div>
                    </div>
                    @endif

                    {{-- Input B (Markup) --}}
                    @if (in_array($to_cal, ['1', '4', '5']))
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="b" class="label text-blue">{{ $lang['d'] ?? 'Markup' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="b" id="b" class="input" placeholder="20" />
                            <span class="text-blue input_unit absolute right-4 top-1/2 -translate-y-1/2 font-semibold">%</span>
                        </div>
                    </div>
                    @endif

                    {{-- Input C (Revenue) --}}
                    @if (in_array($to_cal, ['2', '4', '6']))
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="c" class="label text-blue">{{ $lang['b'] ?? 'Revenue' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="c" id="c" class="input" placeholder="30" />
                            <span class="text-blue input_unit absolute right-4 top-1/2 -translate-y-1/2 font-semibold">{{ $currency }}</span>
                        </div>
                    </div>
                    @endif

                    {{-- Input D (Profit) --}}
                    @if (in_array($to_cal, ['3', '5', '6']))
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="d" class="label text-blue">{{ $lang['a'] ?? 'Profit' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="d" id="d" class="input" placeholder="40" />
                            <span class="text-blue input_unit absolute right-4 top-1/2 -translate-y-1/2 font-semibold">{{ $currency }}</span>
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
                            <div class="w-full lg:w-[80%] mt-2 overflow-auto">
                                <table class="w-full text-[18px]">
                                    <tr class="border-b">
                                        <td class="py-3" width="70%"><strong>{{ $lang['c'] ?? 'Cost' }}</strong></td>
                                        <td class="py-3 text-blue font-bold">{{ $detail['cost'] ?? '0.00' }} {{ $currency }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3" width="70%"><strong>{{ $lang['d'] ?? 'Markup' }}</strong></td>
                                        <td class="py-3 text-blue font-bold">{{ $detail['markup'] ?? '0.00' }}%</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3" width="70%"><strong>{{ $lang['b'] ?? 'Revenue' }}</strong></td>
                                        <td class="py-3 text-blue font-bold">{{ $detail['revenue'] ?? '0.00' }} {{ $currency }}</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="py-3" width="70%"><strong>{{ $lang['a'] ?? 'Profit' }}</strong></td>
                                        <td class="py-3 text-blue font-bold">{{ $detail['profit'] ?? '0.00' }} {{ $currency }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3" width="70%"><strong>{{ $lang['e'] ?? 'Margin' }}</strong></td>
                                        <td class="py-3 text-blue font-bold">{{ $detail['margin'] ?? '0.00' }}%</td>
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
