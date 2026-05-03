<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 ">
                        <label for="rs" class="labele">{{ $lang['company'] ?? 'Stock Returns (rS)' }} (,):</label>
                        <div class="w-full py-2">
                            <textarea wire:model.live="rs" id="rs" class="input textareaInput" aria-label="rs" placeholder="1, 13, 5, 7, 9"></textarea>
                        </div>
                    </div>
                    <div class="col-span-12 ">
                        <label for="rm" class="labele">{{ $lang['market'] ?? 'Market Returns (rM)' }} (,):</label>
                        <div class="w-full py-2">
                            <textarea wire:model.live="rm" id="rm" class="input textareaInput" aria-label="rm" placeholder="2, 4, 6, 18, 10"></textarea>
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
                                        <td class="py-2 border-b" width="60%"><strong>β (Beta)</strong></td>
                                        <td class="py-2 border-b text-xl font-bold orange-text">{{ $detail['beta_1'] }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full mt-8 text-[16px]">
                                <p class="mt-4 font-bold text-lg text-blue-600 border-b pb-2 mb-4">{{ $lang['solution'] ?? 'Step-by-Step Solution' }}:</p>
                                
                                <p class="mt-4 font-semibold">{{ $lang['statement1'] ?? '1. Data Input Summary' }}:</p>
                                <div class="overflow-x-auto mt-2">
                                    <table class="w-full text-center border-collapse">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="py-2 border-b">Obs.</th>
                                                <th class="py-2 border-b">rM (Market)</th>
                                                <th class="py-2 border-b">rS (Stock)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detail['rm'] as $key => $value)
                                                <tr class="hover:bg-gray-50">
                                                    <td class="py-2 border-b">{{ $key + 1 }}</td>
                                                    <td class="py-2 border-b">{{ $value }}</td>
                                                    <td class="py-2 border-b">{{ $detail['rs'][$key] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <p class="mt-8 font-semibold">{{ $lang['statement2'] ?? '2. Intermediate Calculations' }}:</p>
                                <div class="overflow-x-auto mt-2">
                                    <table class="w-full text-center border-collapse">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="py-2 border-b">Obs.</th>
                                                <th class="py-2 border-b">rM (X)</th>
                                                <th class="py-2 border-b">rS (Y)</th>
                                                <th class="py-2 border-b">Xᵢ²</th>
                                                <th class="py-2 border-b">Yᵢ²</th>
                                                <th class="py-2 border-b">Xᵢ &middot; Yᵢ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detail['rm'] as $key => $xi)
                                                @php $yi = $detail['rs'][$key]; @endphp
                                                <tr class="hover:bg-gray-50">
                                                    <td class="py-2 border-b">{{ $key + 1 }}</td>
                                                    <td class="py-2 border-b">{{ $xi }}</td>
                                                    <td class="py-2 border-b">{{ $yi }}</td>
                                                    <td class="py-2 border-b">{{ $detail['xi2'][$key] }}</td>
                                                    <td class="py-2 border-b">{{ $detail['yi2'][$key] }}</td>
                                                    <td class="py-2 border-b">{{ $xi * $yi }}</td>
                                                </tr>
                                            @endforeach
                                            <tr class="bg-blue-50 font-bold">
                                                <td class="py-2 border-b">Sum (Σ)</td>
                                                <td class="py-2 border-b">{{ $detail['rm_sum'] }}</td>
                                                <td class="py-2 border-b">{{ $detail['rs_sum'] }}</td>
                                                <td class="py-2 border-b">{{ $detail['xi2_sum'] }}</td>
                                                <td class="py-2 border-b">{{ $detail['yi2_sum'] }}</td>
                                                <td class="py-2 border-b">{{ $detail['xy_sum'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
