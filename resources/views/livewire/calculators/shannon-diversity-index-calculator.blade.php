<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2">
                    <div class="col-span-8 px-2">
                        <label for="seprateby" class="font-s-14 text-blue">{{ $lang['no'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="seprateby" id="seprateby" class="input">
                                <option value="space">{{ $lang['Space'] }}</option>
                                <option value=",">{{ $lang['comma'] }}</option>
                                <option value="user">{{ $lang['user'] }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-4 px-2">
                        <label for="seprate" class="font-s-14 text-blue">&nbsp;</label>
                        <div class="w-100 py-2">
                            <input type="text" wire:model.live="seprate" id="seprate" {{ $seprateby !== 'user' ? 'readonly' : '' }} class="input {{ $seprateby !== 'user' ? 'readonly' : '' }}" aria-label="input" placeholder=" " />
                        </div>
                    </div>
                    <div class="col-span-12 px-2">
                        <label for="textarea" class="font-s-14 text-blue">{{ $lang['enter'] }}:</label>
                        <div class="w-100 py-2">
                            <textarea wire:model.live="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 55 62 35 32 50 57 54"></textarea>
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
                            <div class="w-full">
                                <div class="text-center">
                                    <p class="text-[25px]">
                                        <strong>{{ $lang['17'] }} (H)</strong>
                                    </p>
                                    <div class="flex justify-center">
                                        <p class="text-[30px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ number_format($detail['shannon_diversity'] * (-1), 2) }}</strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="w-full mt-2 overflow-auto">
                                    <table class='w-full' style='border-collapse: collapse'>
                                        <tr class='bg-white'>
                                            <td class='border p-2 text-center'><strong>{{ $lang[1] }}/{{ $lang[2] }}</strong></td>
                                            <td class='border p-2 text-center'><span class="text-[20px]"><strong>{{ round(($detail['shannon_diversity'] / $detail['count_elements']) * (-1), 4) }}</strong></span></td>
                                            <td class='border p-2 text-center'><strong>{{ $lang[3] }}</strong></td>
                                            <td class='border p-2 text-center'><span class="text-[20px]"><strong>{{ $detail['hitman'] }}</strong></span></td>
                                        </tr>
                                        <tr class='bg-white'>
                                            <td class='border p-2 text-center'><strong>{{ $lang[4] }}</strong></td>
                                            <td class='border p-2 text-center'><span class="text-[20px]"><strong>{{ $detail['sum'] }}</strong></span></td>
                                            <td class='border p-2 text-center'><strong>{{ $lang[5] }}</strong></td>
                                            <td class='border p-2 text-center'><span class="text-[20px]"><strong>{{ round(($detail['sum']) / ($detail['hitman']), 4) }}</strong></span></td>
                                        </tr>
                                        <tr class='bg-white'>
                                            <td class='border p-2 text-center'><strong>{{ $lang[6] }}</strong></td>
                                            <td class='border p-2 text-center'><span class="text-[20px]"><strong>{{ round((($detail['hitman'] - 1) / log($detail['sum'])), 4) }}</strong></span></td>
                                            <td class='border p-2 text-center'><strong>{{ $lang[7] }}</strong></td>
                                            <td class='border p-2 text-center'><span class="text-[20px]"><strong>{{ round($detail['max'] / $detail['sum'], 4) }}</strong></span></td>
                                        </tr>
                                        <tr class='bg-white'>
                                            <td class='border p-2 text-center'><strong>{{ $lang[8] }}</strong></td>
                                            <td class='border p-2 text-center'><span class="text-[20px]"><strong>{{ round($detail['sum'] / $detail['max'], 4) }}</strong></span></td>
                                            <td class='border p-2 text-center'><strong>{{ $lang[9] }}</strong></td>
                                            <td class='border p-2 text-center'><span class="text-[20px]"><strong>{{ round($detail['simpson_index'], 4) }}</strong></span></td>
                                        </tr>
                                        <tr class='bg-white'>
                                            <td class='border p-2 text-center'><strong>{{ $lang[10] }}</strong></td>
                                            <td class='border p-2 text-center'><span class="text-[20px]"><strong>{{ round(1 - $detail['simpson_index'], 4) }}</strong></span></td>
                                            <td class='border p-2 text-center'><strong>{{ $lang[11] }}</strong></td>
                                            <td class='border p-2 text-center'><span class="text-[20px]"><strong>{{ round(1 / $detail['simpson_index'], 4) }}</strong></span></td>
                                        </tr>
                                        <tr class='bg-white'>
                                            <td class='border p-2 text-center'><strong>{{ $lang[12] }}</strong></td>
                                            <td class='border p-2 text-center'><span class="text-[20px]"><strong>{{ round($detail['hitman'] / sqrt($detail['sum']), 4) }}</strong></span></td>
                                            <td class='border p-2 text-center'><strong>{{ $lang[13] }}</strong></td>
                                            <td class='border p-2 text-center'><span class="text-[20px]"><strong>{{ round($detail['sum3'], 4) }}</strong></span></td>
                                        </tr>
                                        <tr class='bg-white'>
                                            <td class='border p-2 text-center'><strong>{{ $lang[14] }}</strong></td>
                                            <td class='border p-2 text-center'><span class="text-[20px]"><strong>{{ round(1 / $detail['sum3'], 4) }}</strong></span></td>
                                            <td class='border p-2 text-center'><strong>{{ $lang[15] }}</strong></td>
                                            <td class='border p-2 text-center'><span class="text-[20px]"><strong>{{ round(1 - $detail['sum3'], 4) }}</strong></span></td>
                                        </tr>
                                        <tr class='bg-white'>
                                            <td class='border p-2 text-center'><strong>{{ $lang[16] }}</strong></td>
                                            <td class='border p-2 text-center' colspan="3">
                                                <p class="text-[20px]"><strong>{{ number_format(exp($detail['shannon_diversity'] * (-1)) / $detail['hitman'], 6) }}</strong></p>
                                            </td>
                                        </tr>
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
