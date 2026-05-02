<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[40%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 gap-6 mt-3">
                    {{-- Choose Method --}}
                    <div class="space-y-2">
                        <label for="method" class="label font-s-14 text-blue">{{ $lang['chose'] ?? 'Choose to Calculate' }}:</label>
                        <select wire:model.live="method" id="method" class="input">
                            <option value="cost">{{ $lang['cost'] ?? 'Total Cost' }}</option>
                            <option value="cpc">{{ $lang['cpc'] ?? 'Cost Per Click' }}</option>
                            <option value="click">{{ $lang['click'] ?? 'Total Clicks' }}</option>
                        </select>
                    </div>

                    {{-- Dynamic Input X --}}
                    <div class="space-y-2">
                        <label for="x" class="label font-s-14 text-blue">
                            @if ($method == 'cost') {{ $lang['cpc'] ?? 'Cost Per Click' }}
                            @elseif ($method == 'cpc') {{ $lang['cost'] ?? 'Total Cost' }}
                            @else {{ $lang['cost'] ?? 'Total Cost' }}
                            @endif
                        </label>
                        <div class="relative py-1">
                            <input type="number" step="any" wire:model.live="x" id="x" class="input" placeholder="50">
                            @if ($method != 'click')
                                <span class="input_unit text-blue absolute right-4 top-1/2 -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                            @endif
                        </div>
                    </div>

                    {{-- Dynamic Input Y --}}
                    <div class="space-y-2">
                        <label for="y" class="label font-s-14 text-blue">
                            @if ($method == 'cost') {{ $lang['click'] ?? 'Total Clicks' }}
                            @elseif ($method == 'cpc') {{ $lang['click'] ?? 'Total Clicks' }}
                            @else {{ $lang['cpc'] ?? 'Cost Per Click' }}
                            @endif
                        </label>
                        <div class="relative py-1">
                            <input type="number" step="any" wire:model.live="y" id="y" class="input" placeholder="50">
                            @if ($method == 'click')
                                <span class="input_unit text-blue absolute right-4 top-1/2 -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                            @endif
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
            {{-- result --}}
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex flex-col items-center justify-center space-y-4">
                        <div class="w-full mt-3">
                            <div class="w-full text-center text-[20px]">
                                <p class="text-blue font-semibold mb-3">
                                    @if ($method == 'cost') {{ $lang['cost'] ?? 'Total Cost' }}
                                    @elseif ($method == 'cpc') {{ $lang['cpc'] ?? 'Cost Per Click' }}
                                    @else {{ $lang['click'] ?? 'Total Clicks' }}
                                    @endif
                                </p>
                                <div class="flex justify-center">
                                    <strong class="bg-[#2845F5] rounded-lg text-white px-6 py-3 text-[25px] shadow-lg">
                                        {{ !empty($detail['ans']) ? $detail['ans'] : '0.0' }}
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
