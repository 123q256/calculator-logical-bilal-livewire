 <div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <div class="w-full px-2 my-2"><strong>{{ $lang[1] }} :</strong></div>
                    </div>
                    <div class="col-span-12">
                        <label for="method_unit" class="label">{{ $lang['2'] }}</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="method_unit" id="method_unit" class="input">
                                <option value="{{ $lang[11] }}">{{ $lang[11] }}</option>
                                <option value="{{ $lang[12] }}">{{ $lang[12] }}</option>
                            </select>
                        </div>
                    </div>

                    @if ($method_unit === ($lang[11] ?? 'Value of the property'))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="property" class="label">{{ $lang['3'] }}:</label>
                            <div class="w-full py-2 relative flex items-center">
                                <input type="number" step="any" wire:model.live="property" id="property" class="input pr-10" aria-label="input" />
                                <span class="absolute right-3 text-blue font-semibold">{{ $currancy }}</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="value" class="label">{{ $lang['4'] }}:</label>
                            <div class="w-full py-2 relative flex items-center">
                                <input type="number" step="any" wire:model.live="value" id="value" class="input pr-10" aria-label="input" />
                                <span class="absolute right-3 text-blue font-semibold">{{ $currancy }}</span>
                            </div>
                        </div>
                    @else
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="area" class="label flex justify-between"><span class="text-blue">{{ $lang['9'] }}</span><span class="text-blue">{{ $currancy }} per</span></label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="area" id="area" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" aria-label="input" />
                                <button type="button" @click="open = !open" class="absolute cursor-pointer text-sm underline right-3 top-2.5">
                                    {{ $area_unit }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach (['m²', 'ft²', 'yd²', 'mi²'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.setUnit('area_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="total" class="label flex justify-between">{{ $lang['10'] }}</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="total" id="total" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" aria-label="input" />
                                <button type="button" @click="open = !open" class="absolute cursor-pointer text-sm underline right-3 top-2.5">
                                    {{ $total_unit }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    @foreach (['m²', 'ft²', 'yd²', 'mi²'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.setUnit('total_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-span-12">
                        <div class="w-full px-2 my-3"><strong>{{ $lang[5] }} :</strong></div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="average" class="label flex justify-between"><span class="text-blue">{{ $lang['6'] }}</span><span class="text-blue">{{ $currancy }} per</span></label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="average" id="average" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" aria-label="input" />
                            <button type="button" @click="open = !open" class="absolute cursor-pointer text-sm underline right-3 top-2.5">
                                {{ $average_unit }} ▾
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                @foreach (['m²', 'ft²', 'yd²', 'mi²'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.setUnit('average_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="cost" class="label">{{ $lang['7'] }}:</label>
                        <div class="w-full py-2 relative flex items-center">
                            <input type="number" step="any" wire:model.live="cost" id="cost" class="input pr-10" aria-label="input" />
                            <span class="absolute right-3 text-blue font-semibold">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="purchase" class="label">{{ $lang['8'] }}:</label>
                        <div class="w-full py-2 relative flex items-center">
                            <input type="number" step="any" wire:model.live="purchase" id="purchase" class="input pr-10" aria-label="input" />
                            <span class="absolute right-3 text-blue font-semibold">%</span>
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
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[14] }}</strong></td>
                                        <td class="py-2 border-b">{{ $currancy }} {{ number_format($detail['after_repair_value'], 0) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[15] }}</strong></td>
                                        <td class="py-2 border-b">{{ number_format($detail['requires_repairs'], 0) }} {{ $average_unit }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[16] }}</strong></td>
                                        <td class="py-2 border-b">{{ $currancy }} {{ number_format($detail['maximum_bid_price'], 0) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>ROI</strong></td>
                                        <td class="py-2 border-b">{{ $currancy }} {{ number_format($detail['roi'], 0) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[17] }}</strong></td>
                                        <td class="py-2 border-b">{{ number_format($detail['percentage'], 0) }} %</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <div class="w-full">
                                    <p class="mt-3">{{ $lang[18] }}</p>
                                    <p class="mt-2"><strong>{{ $lang[14] }}</strong></p>
                                    <p class="mt-2">{{ $lang[14] }} =
                                        @if ($method_unit === ($lang[11] ?? 'Value of the property'))
                                            {{ $lang[3] }} + {{ $lang[4] }}
                                        @else
                                            {{ $lang[9] }} x {{ $lang[10] }}
                                        @endif
                                    </p>
                                    <p class="mt-2">{{ $lang[14] }} = {{ $currancy }} {{ number_format($detail['after_repair_value'], 0) }}</p>
                                    <p class="mt-2"><strong>{{ $lang[15] }}</strong></p>
                                    <p class="mt-2">{{ $lang[15] }} = {{ $lang[7] }} / {{ $lang[6] }}</p>
                                    <p class="mt-2">{{ $lang[15] }} = {{ number_format($detail['requires_repairs'], 0) }} {{ $average_unit }}</p>
                                    <p class="mt-2"><strong>{{ $lang[16] }}</strong></p>
                                    <p class="mt-2">{{ $lang[16] }} = {{ $lang[15] }} x ({{ $lang[8] }} %) - {{ $lang[7] }}</p>
                                    <p class="mt-2">{{ $lang[16] }} = {{ $currancy }} {{ number_format($detail['maximum_bid_price'], 0) }}</p>
                                    <p class="mt-2"><strong>{{ $lang[17] }}</strong></p>
                                    <p class="mt-2">{{ $lang[17] }} = {{ $lang[8] }} - 100</p>
                                    <p class="mt-2">{{ $lang[17] }} = {{ number_format($detail['percentage'], 0) }} %</p>
                                    <p class="mt-2"><strong>ROI</strong></p>
                                    <p class="mt-2">ROI = {{ $lang[17] }} * {{ $lang[14] }}</p>
                                    <p class="mt-2">ROI = {{ $currancy }} {{ number_format($detail['roi'], 0) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
