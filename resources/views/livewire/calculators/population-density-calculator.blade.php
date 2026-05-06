<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="no" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="no" id="no" class="input" aria-label="input" placeholder="3000" />
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="area" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="area" id="area" class="input" aria-label="input" placeholder="9" />
                            <span class="text-blue input_unit">sq. mi</span>
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
        <div id="result-section">
            @isset($detail)
                <div wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                    <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                        <div class="rounded-lg flex items-center justify-center">
                            <div class="w-full mt-3">
                                <div class="w-full">
                                    <div class="text-center">
                                        <p class="text-[20px]">{{ $lang['3'] }}</p>
                                        <p class="my-4 p-2">
                                            <strong class="bg-[#2845F5] text-white px-md-3 py-md-2 p-2 rounded-lg text-[22px]">{{ $detail['ans'] }} {{ $lang['4'] }} sq. mi</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </form>
</div>
