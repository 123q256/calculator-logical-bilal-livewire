<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2">
                    <div class="col-span-12">
                        <label for="av" class="label">{{ $lang['accept'] }}</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="av" id="av" class="input" aria-label="input" />
                            @error('av') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="ov" class="label">{{ $lang['observe'] }}</label>
                        <div class="w-100 py-2">
                            <input type="text" step="any" wire:model.live="ov" id="ov" class="input" aria-label="input" />
                            @error('ov') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
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

        @if(isset($detail))
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="w-full lg:w-[80%] mt-2">
                                    <table class="w-full text-[18px]">
                                        @php
                                            $avUsed = $detail['av_used'] ?? $av;
                                            $ovUsed = $detail['ov_used'] ?? $ov;
                                            $ownError = $detail['own_error'] ?? 0;
                                        @endphp
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['percent_err'] }}</strong></td>
                                            <td class="py-2 border-b">{{ abs($ownError) }}%</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['non_absolute'] }}</strong></td>
                                            <td class="py-2 border-b">{{ $ownError }}%</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['absolute_err'] }}</strong></td>
                                            <td class="py-2 border-b">{{ is_numeric($ovUsed) && is_numeric($avUsed) ? abs($ovUsed - $avUsed) : '0.0' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full lg:w-[80%] text-[16px] mt-6">
                                    <p class="mt-2 text-xl font-bold border-b pb-2 mb-4">{{ $lang['cal'] }}</p>
                                    <div class="space-y-6">
                                        <p class="flex items-center gap-2">
                                            PE = 
                                            <span class="quadratic_fraction inline-flex flex-col items-center">
                                                <span class="num border-b px-2">OV - AV</span>
                                                <span>AV</span>
                                            </span>
                                            × 100
                                        </p>
                                        <p class="flex items-center gap-2">
                                            PE = 
                                            <span class="quadratic_fraction inline-flex flex-col items-center">
                                                <span class="num border-b px-2">{{ $ovUsed }} - {{ $avUsed }}</span>
                                                <span>{{ $avUsed }}</span>
                                            </span>
                                            × 100
                                        </p>
                                        <p class="flex items-center gap-2">
                                            PE = 
                                            <span class="quadratic_fraction inline-flex flex-col items-center">
                                                <span class="num border-b px-2">{{ (float)$ovUsed - (float)$avUsed }}</span>
                                                <span>{{ $avUsed }}</span>
                                            </span>
                                            × 100
                                        </p>
                                        <p class="mt-2 py-2 px-4 bg-gray-50 rounded italic border-l-4 border-blue-200">
                                            PE = {{ $avUsed != 0 ? ((float)$ovUsed - (float)$avUsed) / (float)$avUsed : 0 }} × 100 
                                        </p>
                                        <p class="mt-4 text-2xl font-bold text-blue-600">
                                            PE = {{ $ownError }}% 
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
