<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[40%] md:w-[60%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-1 gap-6 mt-3">
                    {{-- Arm Span / Body Length --}}
                    <div class="w-full">
                        <label for="length" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-full mt-2"> 
                            <input type="number" step="any" wire:model.live.debounce.500ms="length" id="length" class="input" placeholder="00" />
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-8 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="w-full lg:w-[80%] overflow-auto text-[18px]">
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['2'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['draw'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['3'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['arrow'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['4'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['draw_cm'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['5'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['arrow_cm'], 2) }}</td>
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
