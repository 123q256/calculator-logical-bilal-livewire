<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-3">
                    <div class="space-y-2">
                        <label for="x" class="label font-s-14 text-blue">{{ $lang['r'] ?? 'Revenue' }}:</label>
                        <div class="relative py-1">
                            <input type="number" step="any" wire:model.live="x" id="x" class="input" placeholder="413">
                            <span class="input_unit text-blue absolute right-4 top-1/2 -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="y" class="label font-s-14 text-blue">{{ $lang['o_e'] ?? 'Operating Expenses' }}:</label>
                        <div class="relative py-1">
                            <input type="number" step="any" wire:model.live="y" id="y" class="input" placeholder="50">
                            <span class="input_unit text-blue absolute right-4 top-1/2 -translate-y-1/2 font-semibold">{{ $currancy }}</span>
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
                    <div class="rounded-lg flex flex-col items-center justify-center space-y-8">
                        <div class="w-full mt-3">
                            <div class="w-full text-[25px] text-center my-3">
                                <p class="text-blue font-semibold">{{ $lang['ebit'] ?? 'EBIT' }}</p>
                                <p class="my-3">
                                    <strong class="bg-[#2845F5] px-6 py-3 text-[30px] rounded-lg text-white shadow-lg inline-block">
                                        {{ !empty($detail['ebit']) ? $detail['ebit'] : '0.0' }} {{ $currancy }}
                                    </strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
