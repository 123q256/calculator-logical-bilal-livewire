<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-2">
                    <div class="col-span-6">
                        <label for="test" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="selection" id="test" class="input">
                                <option value="1">1-{{ $lang['2'] }}</option>
                                <option value="2">2-{{ $lang['3'] }}</option>
                                <option value="3">2-{{ $lang['4'] }}</option>
                                <option value="4">{{ $lang['5'] }}</option>
                                <option value="5">{{ $lang['6'] }}</option>
                                <option value="6">{{ $lang['7'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Dynamic Fields based on Selection --}}
                    @if (in_array($selection, ['1', '5', '6']))
                        <div class="col-span-6">
                            <label for="sample_size" class="font-s-14 text-blue">{{ $lang['8'] }} (N)</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="sample_size" id="sample_size" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    @if (in_array($selection, ['2', '3']))
                        <div class="col-span-6">
                            <label for="sample_size_one" class="font-s-14 text-blue">{{ $lang['8'] }} (N₁)</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="sample_size_one" id="sample_size_one" class="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="sample_size_two" class="font-s-14 text-blue">{{ $lang['8'] }} (N₂)</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="sample_size_two" id="sample_size_two" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    @if ($selection === '3')
                        <div class="col-span-6">
                            <label for="variance_one" class="font-s-14 text-blue">{{ $lang['9'] }} (σ₁)</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="variance_one" id="variance_one" class="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="variance_two" class="font-s-14 text-blue">{{ $lang['9'] }} (σ₂)</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="variance_two" id="variance_two" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    @if ($selection === '4')
                        <div class="col-span-6">
                            <label for="c1" class="font-s-14 text-blue">{{ $lang['10'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="c1" id="c1" class="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="r1" class="font-s-14 text-blue">{{ $lang['11'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="r1" id="r1" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    @if ($selection === '5')
                        <div class="col-span-6">
                            <label for="k1" class="font-s-14 text-blue">{{ $lang['12'] }} (k)</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="k1" id="k1" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    @if ($selection === '6')
                        <div class="col-span-6">
                            <label for="h" class="font-s-14 text-blue">{{ $lang['15'] }} (h)</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="h" id="h" class="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="sample_mean" class="font-s-14 text-blue">{{ $lang['16'] }} (x)</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="sample_mean" id="sample_mean" class="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="standard_deviation_three" class="font-s-14 text-blue">{{ $lang['17'] }}</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="standard_deviation_three" id="standard_deviation_three" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif
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
                                        <strong>{{ $lang['18'] }}</strong>
                                    </p>
                                    <div class="flex justify-center">
                                        <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['degrees_of_freedom'] }}</strong>
                                        </p>
                                    </div>
                                </div>
                                @if (isset($detail['t_statistic']) && $detail['t_statistic'] != "")
                                    <div class="text-center">
                                        <p class="text-[25px]">
                                            <strong>{{ $lang['7'] }}</strong>
                                        </p>
                                        <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['t_statistic'] }}</strong>
                                        </p>
                                    </div>
                                @endif
                                @if (isset($detail['v1']) && $detail['v1'] != "")
                                    <div class="text-center">
                                        <p class="text-[25px]">
                                            <strong>{{ $lang['19'] }} (s₁)</strong>
                                        </p>
                                        <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['v1'] }}</strong>
                                        </p>
                                    </div>
                                @endif
                                @if (isset($detail['v2']) && $detail['v2'] != "")
                                    <div class="text-center">
                                        <p class="text-[25px]">
                                            <strong>{{ $lang['19'] }} (s₂)</strong>
                                        </p>
                                        <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['v2'] }}</strong>
                                        </p>
                                    </div>
                                @endif
                                @if (isset($detail['d3']) && $detail['d3'] != "")
                                    <div class="text-center">
                                        <p class="text-[25px]">
                                            <strong>{{ $lang['14'] }}</strong>
                                        </p>
                                        <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['d3'] }}</strong>
                                        </p>
                                    </div>
                                @endif
                                @if (isset($detail['d2']) && $detail['d2'] != "")
                                    <div class="text-center">
                                        <p class="text-[25px]">
                                            <strong>{{ $lang['13'] }}</strong>
                                        </p>
                                        <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['d2'] }}</strong>
                                        </p>
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
