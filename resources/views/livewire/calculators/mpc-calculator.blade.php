<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="income" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Change in Income' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="income" id="income" class="input"
                                aria-label="input" placeholder="100" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="save" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Change in Saving' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="save" id="save" class="input"
                                aria-label="input" placeholder="13" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
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

        @if ($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full bg-light-blue p-3 radius-10 mt-3">
                            <div class="w-full text-center font-s-20">
                                <p>{{ $lang[3] ?? 'Marginal Propensity to Consume (MPC)' }}</p>
                                <p class="my-3">
                                    <strong class="bg-[#2845F5] text-white rounded-lg px-3 py-2 text-[25px]">
                                        {{ $currancy }} {{ number_format($detail['ans'], 2) }}
                                    </strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
