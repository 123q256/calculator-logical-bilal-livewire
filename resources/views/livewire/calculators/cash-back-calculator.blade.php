<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="purchase" class="label">{{ $lang['1'] ?? 'Purchase Amount' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="purchase" id="purchase" class="input" aria-label="purchase" placeholder="413" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="cash" class="label">{{ $lang['2'] ?? 'Cash Back Percentage' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="cash" id="cash" class="input" aria-label="cash" placeholder="50" />
                            <span class="input_unit">%</span>
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
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] ?? 'Cash Back Amount' }}</strong></td>
                                        <td class="py-2 border-b text-xl font-bold orange-text">{{ $currency }} {{ number_format($detail['answer'], 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full mt-8 text-[16px]">
                                <p class="mt-2 font-bold text-lg text-blue-600 border-b pb-2 mb-4">{{ $lang[5] ?? 'Formula & Calculation' }}:</p>
                                <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                                    <p class="font-mono">{{ $lang[6] ?? 'Cash Back' }} = {{ $lang['1'] ?? 'Purchase' }} × ({{ $lang['2'] ?? 'Percentage' }} / 100)</p>
                                    <div class="ml-4 border-l-4 border-blue-200 pl-4 py-1">
                                        <p>{{ $lang['3'] ?? 'Amount' }} = {{ number_format($purchase, 2) }} × ({{ $cash }} / 100)</p>
                                        <p>{{ $lang['3'] ?? 'Amount' }} = {{ number_format($purchase, 2) }} × {{ $cash / 100 }}</p>
                                        <p class="text-xl font-bold mt-2">{{ $lang['3'] ?? 'Amount' }} = <span class="orange-text">{{ $currency }} {{ number_format($detail['answer'], 2) }}</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
