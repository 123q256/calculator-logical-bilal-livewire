<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="assets" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Current Assets' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="assets" id="assets" class="input" aria-label="assets" placeholder="40" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="liabilities" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Current Liabilities' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="liabilities" id="liabilities" class="input" aria-label="liabilities" placeholder="20" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
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
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] ?? 'Current Ratio' }}</strong></td>
                                        <td class="py-2 border-b text-xl font-bold orange-text">{{ $detail['answer'] + 0 }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full mt-8 text-[16px]">
                                <p class="mt-2 font-bold text-lg text-blue-600 border-b pb-2 mb-4">{{ $lang[4] ?? 'Calculation' }}:</p>
                                <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                                    <p class="font-mono p-2 bg-white rounded border">{{ $lang[3] ?? 'Current Ratio' }} = {{ $lang['1'] ?? 'Assets' }} / {{ $lang['2'] ?? 'Liabilities' }}</p>
                                    <div class="ml-4 border-l-4 border-blue-200 pl-4 py-1">
                                        <p>{{ $lang[3] ?? 'Ratio' }} = {{ $assets + 0 }} / {{ $liabilities + 0 }}</p>
                                        <p class="text-xl font-bold mt-2">{{ $lang[3] ?? 'Ratio' }} = <span class="orange-text">{{ $detail['answer'] + 0 }}</span></p>
                                    </div>
                                    <p class="mt-4 text-gray-600 italic text-sm">{{ $lang[5] ?? 'A current ratio of 1 or higher indicates that a company has more assets than liabilities.' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
