<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="col-12 px-2 mb-3 text-center d-flex align-items-center justify-content-start">
                    <p class="font-s-14 text-blue me-2 mb-0">{{ $lang[19] }}</p>
                    <input wire:model.live="form" id="form_raw" value="raw" type="radio" class="cursor-pointer" />
                    <label for="form_raw" class="font-s-14 text-blue pe-lg-3 px-1 mb-0 cursor-pointer">{{ $lang['1'] }}</label>
                    
                    <input wire:model.live="form" id="form_summary" value="summary" type="radio" class="cursor-pointer" />
                    <label for="form_summary" class="font-s-14 text-blue ps-1 mb-0 cursor-pointer">{{ $lang['2'] }}</label>
                </div>
                
                @if ($form === 'raw')
                    <div class="grid grid-cols-1 gap-4">
                        <div class="space-y-2">
                            <label for="x" class="font-s-14 text-blue">{{ $lang['5'] }} ({{ $lang['6'] }})</label>
                            <textarea wire:model.live="x" id="x" class="textareaInput" aria-label="input" placeholder="e.g. 12, 23, 45, 33, 65, 54, 54"></textarea>
                        </div>
                    </div>
                @else
                    <div class="space-y-2">
                        <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label for="mean" class="font-s-14 text-blue">{{ $lang['3'] }}:</label>
                                <input type="number" step="any" wire:model.live="mean" id="mean" class="input" aria-label="input" placeholder="00" />
                            </div>
                            <div class="space-y-2">
                                <label for="deviation" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                                <input type="number" step="any" wire:model.live="deviation" id="deviation" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                    </div>
                @endif
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
                    <div class="rounded-lg flex items-center mt-3 justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="text-center">
                                    <p class="font-s-20">
                                        <strong>{{ $lang['7'] }}</strong>
                                    </p>
                                    <p class="px-3 py-2 my-3">
                                        <strong class="text-white bg-[#2845F5] text-[30px] rounded-lg px-3 py-2">{{ round($detail['rsd'], 5) }}%</strong>
                                    </p>
                                </div>
                                @if ($form === 'raw')
                                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                                        <table class="w-full font-s-18">
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[8] }}</td>
                                                <td class="py-2 border-b"><strong class="text-[#2845F5]">{{ $detail['min'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[9] }}</td>
                                                <td class="py-2 border-b"><strong class="text-[#2845F5]">{{ $detail['max'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[10] }}</td>
                                                <td class="py-2 border-b"><strong class="text-[#2845F5]">{{ $detail['range'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[11] }}</td>
                                                <td class="py-2 border-b"><strong class="text-[#2845F5]">{{ $detail['count'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[12] }}</td>
                                                <td class="py-2 border-b"><strong class="text-[#2845F5]">{{ $detail['sum'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[13] }}</td>
                                                <td class="py-2 border-b"><strong class="text-[#2845F5]">{{ $detail['median'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[14] }}</td>
                                                <td class="py-2 border-b">
                                                    <strong class="text-[#2845F5]">
                                                        {{ implode(' ', $detail['mode']) }}
                                                    </strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[3] }}</td>
                                                <td class="py-2 border-b"><strong class="text-[#2845F5]">{{ round($detail['mean'], 4) }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[15] }}</td>
                                                <td class="py-2 border-b"><strong class="text-[#2845F5]">{{ round($detail['SD'], 4) }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[16] }}</td>
                                                <td class="py-2 border-b"><strong class="text-[#2845F5]">{{ round($detail['svar'], 4) }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[17] }}</td>
                                                <td class="py-2 border-b"><strong class="text-[#2845F5]">{{ round($detail['PSD'], 4) }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[18] }}</td>
                                                <td class="py-2 border-b"><strong class="text-[#2845F5]">{{ round($detail['pvar'], 4) }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
