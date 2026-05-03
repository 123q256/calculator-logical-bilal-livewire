<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <p class="text-lg font-bold border-b pb-2 text-blue-800">{{ $lang['1'] ?? 'Time Point 1' }}</p>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="first" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Price of Product A' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="first" id="first" class="input" aria-label="first" placeholder="35" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="second" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Quantity of Product B' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="second" id="second" class="input" aria-label="second" placeholder="15" />
                            <span class="text-blue input_unit">units</span>
                        </div>
                    </div>

                    <div class="col-span-12 mt-4">
                        <p class="text-lg font-bold border-b pb-2 text-blue-800">{{ $lang['8'] ?? 'Time Point 2' }}</p>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="third" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Price of Product A' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="third" id="third" class="input" aria-label="third" placeholder="45" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="four" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Quantity of Product B' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="four" id="four" class="input" aria-label="four" placeholder="25" />
                            <span class="text-blue input_unit">units</span>
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
                        <div class="w-full mt-3">
                            <div class="w-full lg:w-[80%] mt-2 overflow-auto">
                                <table class="w-full text-[18px]">
                                    <tr class="border-b">
                                        <td class="py-4 " width="50%"><strong>{{ $lang[4] ?? 'Cross Price Elasticity' }}</strong></td>
                                        <td class="py-4  text-2xl font-bold orange-text">{{ $detail['elasticity'] + 0 }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-4" width="50%"><strong>{{ $lang[5] ?? 'Relationship' }}</strong></td>
                                        <td class="py-4 font-semibold text-blue-700">
                                            @if ($detail['elasticity'] > 0)
                                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">{{ $lang[6] ?? 'Substitutes' }}</span>
                                            @elseif ($detail['elasticity'] < 0)
                                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm">{{ $lang[7] ?? 'Complements' }}</span>
                                            @else
                                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">{{ $lang[9] ?? 'Independent' }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="w-full mt-8 text-[16px]">
                                <p class="mt-2 font-bold text-lg text-blue-600 border-b pb-2 mb-4">{{ $lang[10] ?? 'How it was calculated' }}:</p>
                                <div class="bg-gray-50 p-6 rounded-lg space-y-4 border">
                                    <p class="font-mono p-3 bg-white rounded border ">
                                        E<sub>ab</sub> = [(Q<sub>b2</sub> - Q<sub>b1</sub>) / (Q<sub>b2</sub> + Q<sub>b1</sub>)] / [(P<sub>a2</sub> - P<sub>a1</sub>) / (P<sub>a2</sub> + P<sub>a1</sub>)]
                                    </p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                                        <div class="space-y-2">
                                            <p class="text-sm font-semibold  tracking-wider">Change in Quantity (Product B)</p>
                                            <p>{{ $four + 0 }} - {{ $second + 0 }} = {{ ($four - $second) + 0 }}</p>
                                        </div>
                                        <div class="space-y-2">
                                            <p class="text-sm font-semibold  tracking-wider">Change in Price (Product A)</p>
                                            <p>{{ $third + 0 }} - {{ $first + 0 }} = {{ ($third - $first) + 0 }}</p>
                                        </div>
                                    </div>
                                    <p class="mt-4 pt-4 border-t border-gray-200">
                                        {{ $lang[4] ?? 'Final Elasticity' }}: <span class="font-bold orange-text">{{ $detail['elasticity'] + 0 }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
