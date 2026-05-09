<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="select" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="select" id="select" class="input">
                                <option value="1">{{ $lang[2] }}</option>
                                <option value="2">Chi-Square {{ $lang[3] }}</option>
                                <option value="3">F-{{ $lang[3] }}</option>
                                <option value="4">{{ $lang[4] }} t-{{ $lang[3] }}</option>
                                <option value="5">{{ $lang[5] }}</option>
                                <option value="6">{{ $lang[6] }}</option>
                                <option value="7">t-{{ $lang[3] }}</option>
                                <option value="8">({{ $lang[7] }}) {{ $lang[8] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Dynamic Parameter Fields --}}
                    @if (in_array($select, ['1', '2', '3', '4', '5', '7', '8']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="a1" class="font-s-14 text-blue">
                                @if (in_array($select, ['2', '4', '7'])) {{ $lang[10] }}:
                                @elseif ($select === '3') {{ $lang[10] }} 1:
                                @elseif ($select === '5') {{ $lang[12] }}:
                                @else a:
                                @endif
                            </label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="a" id="a1" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    @if (in_array($select, ['1', '2', '3', '4', '5', '7', '8']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="b1" class="font-s-14 text-blue">
                                @if (in_array($select, ['2', '7'])) x:
                                @elseif ($select === '3') {{ $lang[10] }} 2:
                                @elseif ($select === '4') {{ $lang[11] }} (δ):
                                @elseif ($select === '5') {{ $lang[13] }}:
                                @else b:
                                @endif
                            </label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="b" id="b1" class="input" placeholder="00" />
                            </div>
                        </div>
                    @endif

                    @if (in_array($select, ['1', '3', '4', '5', '6', '8']))
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="c1" class="font-s-14 text-blue">
                                @if ($select === '4') t-value:
                                @else x:
                                @endif
                            </label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="c" id="c1" class="input" placeholder="00" />
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
                                    <p class="text-[20px]">
                                        <strong>{{ $lang['9'] }} (PDF)</strong>
                                    </p>
                                    <div class="flex justify-center">
                                        <p class="text-[25px] bg-[#2845F5] w-auto px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['ans'] }}</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
