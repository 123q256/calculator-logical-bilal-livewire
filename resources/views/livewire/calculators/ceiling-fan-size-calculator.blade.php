<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[80%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-3">
                    {{-- Room Width --}}
                    <div class="w-full">
                        <label for="room_width" class="label">{{ $lang['1'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="room_width" id="room_width" step="any" class="input" placeholder="00" />
                            <span class="absolute right-6 top-3.5 font-bold text-gray-400">ft</span>
                        </div>
                    </div>

                    {{-- Room Length --}}
                    <div class="w-full">
                        <label for="room_length" class="label">{{ $lang['2'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="room_length" id="room_length" step="any" class="input" placeholder="00" />
                            <span class="absolute right-6 top-3.5 font-bold text-gray-400">ft</span>
                        </div>
                    </div>

                    {{-- Ceiling Height --}}
                    <div class="w-full md:col-span-2">
                        <label for="ceiling_height" class="label">{{ $lang['3'] }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live.debounce.500ms="ceiling_height" id="ceiling_height" step="any" class="input" placeholder="00" />
                            <span class="absolute right-6 top-3.5 font-bold text-gray-400">ft</span>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="w-full lg:w-[80%] text-[18px]">
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['3'] }} :</strong></td>
                                            <td class="border-b py-2">{{ round($detail['squareFootage'], 2) }} ft<sup>2</sup></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['5'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['fanSize'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang['6'] }} :</strong></td>
                                            <td class="border-b py-2">{{ $detail['downrodLength'] }}</td>
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
