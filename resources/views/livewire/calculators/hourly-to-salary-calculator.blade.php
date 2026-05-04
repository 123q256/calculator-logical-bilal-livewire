 <div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="first" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2 relative flex items-center">
                            <input type="text" wire:model.live="first" id="first" class="input pr-10" aria-label="input" placeholder="{{ $lang['1'] }}" />
                            <span class="text-blue absolute right-3 font-semibold">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 tip">
                        <label for="second" class="label">{{ $lang['2'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="text" wire:model.live="second" id="second" class="input" aria-label="input" placeholder="{{ $lang['2'] }}" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 ppl">
                        <label for="third" class="label">{{ $lang['3'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="text" wire:model.live="third" id="third" class="input" aria-label="input" placeholder="{{ $lang['3'] }}" />
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
                            <div class="w-full">
                                <div class="w-full md:w-[60%] lg:w-[60%] text-[18px]">
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[4] }} :</strong></td>
                                            <td class="border-b py-2">{{ $currancy }} {{ number_format($detail['annuly'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[5] }} :</strong></td>
                                            <td class="border-b py-2">{{ $currancy }} {{ number_format($detail['monthly'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[6] }} :</strong></td>
                                            <td class="border-b py-2">{{ $currancy }} {{ number_format($detail['weekly'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>% {{ $lang[7] }} :</strong></td>
                                            <td class="border-b py-2">{{ number_format(($detail['annuly'] / 56160) * 100, 2) }} %</td>
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
