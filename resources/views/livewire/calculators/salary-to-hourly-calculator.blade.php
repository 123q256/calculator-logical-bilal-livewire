 <div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="type" class="label">{{ $lang['2'] }}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="type" id="type" class="input">
                                <option value="an">{{ $lang['3'] }}</option>
                                <option value="mo">{{ $lang['4'] }}</option>
                                <option value="we">{{ $lang['5'] }}</option>
                                <option value="da">{{ $lang['6'] }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="salary" class="label">{{ $lang['7'] }}:</label>
                        <div class="w-100 py-2 relative flex items-center">
                            <input type="text" wire:model.live="salary" id="salary" class="input pr-10" aria-label="input" placeholder="{{ $lang['1'] }}" />
                            <span class="text-blue absolute right-3 font-semibold">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="hweek" class="label">{{ $lang['8'] }}:</label>
                        <div class="w-100 py-2">
                            <input type="text" wire:model.live="hweek" id="hweek" class="input" aria-label="input" placeholder="{{ $lang['2'] }}" />
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="hyear" class="label">{{ $lang['9'] }}:</label>
                        <div class="w-100 py-2">
                            <input type="text" wire:model.live="hyear" id="hyear" class="input" aria-label="input" placeholder="{{ $lang['3'] }}" />
                        </div>
                    </div>
                </div>
            </div>
            @if ($type_ui == 'calculator')
                @include('inc.button')
            @endif
            @if ($type_ui == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
        <hr>
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type_ui == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-5">
                            <div class="w-full">
                                <div class="text-center">
                                    <p class="text-[20px]"><strong>{{ $lang['10'] }}</strong></p>
                                    <div class="flex justify-center">
                                        <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2 my-3">
                                            <strong>{{ $currancy }} {{ number_format($detail['hourly_rate'], 2) }}</strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="w-full lg:w-[80%] overflow-auto text-[18px] mt-5">
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[11] }} :</strong></td>
                                            <td class="border-b py-2">{{ $currancy }} {{ number_format($detail['monthaly_rate'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong>{{ $lang[12] }} :</strong></td>
                                            <td class="border-b py-2">{{ $currancy }} {{ number_format($detail['weekly_rate'], 2) }}</td>
                                        </tr>
                                        @if ($currancy == '$' || $currancy == '£')
                                            <tr>
                                                <td class="border-b py-2"><strong>% {{ $detail['name'] }} {{ $lang[7] }} :</strong></td>
                                                <td class="border-b py-2">{{ number_format($detail['mean'], 2) }} %</td>
                                            </tr>
                                        @endif
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
