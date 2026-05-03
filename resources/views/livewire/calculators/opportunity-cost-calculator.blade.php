<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="return_best" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Return on Best Alternative Option' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="return_best" id="return_best" class="input" aria-label="return_best" placeholder="100" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="return_choose" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Return on Chosen Option' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="return_choose" id="return_choose" class="input" aria-label="return_choose" placeholder="50" />
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

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="text-center text-[20px] mb-8">
                                <p class="text-gray-600 mb-4">{{ $lang[3] ?? 'Opportunity Cost' }}</p>
                                <p><strong class="bg-[#2845F5] text-white rounded-lg px-6 py-3 text-[30px] shadow-lg inline-block">{{ $currancy }}{{ round($detail['OpportunityCost'], 4) + 0 }}</strong></p>
                            </div>
                            
                            <div class="w-full text-[16px] mt-5">
                                <p class="mt-2 font-bold text-lg text-blue-600 mb-4">{{ $lang['5'] ?? 'Calculation Breakdown' }}:</p>
                                <div class="bg-gray-50 p-6 rounded-lg space-y-4 border">
                                    <p class="leading-relaxed">{{ $lang['6'] ?? 'Opportunity cost is the difference between the returns of the best alternative and the chosen option' }}:</p>
                                    <p class="font-bold py-2 px-4 bg-white rounded border border-blue-100 inline-block">
                                        Opportunity Cost = Best Alternative - Chosen Option
                                    </p>
                                    
                                    <div class="pt-4 border-t border-gray-200 space-y-2 mt-2">
                                        <div class="pl-4 border-l-4 border-blue-200 italic space-y-2 mt-2">
                                            <p>Cost = {{ $return_best + 0 }} - {{ $return_choose + 0 }}</p>
                                            <p class="text-xl font-bold orange-text pt-1">Opportunity Cost = {{ $currancy }}{{ round($detail['OpportunityCost'], 4) + 0 }}</p>
                                        </div>
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
