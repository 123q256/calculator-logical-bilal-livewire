<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-6">
                        <label for="initial_re" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Initial Revenue' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="initial_re" id="initial_re" class="input" aria-label="initial_re" placeholder="11" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="initial_qu" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Initial Quantity' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="initial_qu" id="initial_qu" class="input" aria-label="initial_qu" placeholder="9" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="final_re" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Final Revenue' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="final_re" id="final_re" class="input" aria-label="final_re" placeholder="7" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="final_qu" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Final Quantity' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="final_qu" id="final_qu" class="input" aria-label="final_qu" placeholder="3" />
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
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['5'] ?? 'Marginal Revenue' }}</strong></td>
                                        <td class="py-2 border-b text-xl font-bold orange-text">{{ $currency }} {{ number_format($detail['marginal_rev'], 3) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['6'] ?? 'Change in Total Revenue' }}</strong></td>
                                        <td class="py-2 border-b">{{ $currency }} {{ number_format($detail['total_rev'], 3) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] ?? 'Change in Quantity' }}</strong></td>
                                        <td class="py-2 border-b">{{ number_format($detail['quantity'], 3) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full mt-8 text-[16px]">
                                <p class="mt-2 font-bold text-lg text-blue-600 border-b pb-2 mb-4">{{ $lang['8'] ?? 'Calculation Breakdown' }}:</p>
                                <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                                    <p class="font-mono">MR = ΔTR / ΔQ</p>
                                    <div class="ml-4 border-l-4 border-blue-200 pl-4 py-1">
                                        <p>ΔTR (Change in Revenue) = {{ $final_re }} - {{ $initial_re }} = {{ $final_re - $initial_re }} {{ $currency }}</p>
                                        <p>ΔQ (Change in Quantity) = {{ $final_qu }} - {{ $initial_qu }} = {{ $final_qu - $initial_qu }}</p>
                                        <p class="text-xl font-bold mt-2">MR = {{ $final_re - $initial_re }} / {{ $final_qu - $initial_qu }} = <span class="orange-text">{{ $currency }} {{ number_format($detail['marginal_rev'], 3) }}</span></p>
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
