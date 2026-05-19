<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 mb-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <label for="start" class="label">{{ $lang['1'] }}</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="start" id="start" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="final" class="label">{{ $lang['2'] }}</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="final" id="final" class="input" aria-label="input" />
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
                <div>
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="w-full lg:w-[70%] overflow-auto mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }}</strong></td>
                                            <td class="py-2 border-b">{{ round($detail['ans'], 5) }}%</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }}</strong></td>
                                            <td class="py-2 border-b">{{ round($detail['dif'], 5) }}</td>
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
