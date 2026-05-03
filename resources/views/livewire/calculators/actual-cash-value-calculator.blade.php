<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="price" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Replacement Cost' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="price" id="price" class="input" aria-label="price" placeholder="35" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="expected" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Expected Useful Life' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="expected" id="expected" class="input" aria-label="expected" placeholder="7" />
                            <span class="text-blue input_unit">yrs</span>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="current" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Current Age of Item' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="current" id="current" class="input" aria-label="current" placeholder="5" />
                            <span class="text-blue input_unit">yrs</span>
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
                            <div class="col-12 text-center py-3">
                                <p class="text-lg font-semibold text-blue-800 mb-4">{{ $lang[4] ?? 'Actual Cash Value' }}</p>
                                <p class="my-3">
                                    <strong class="bg-[#2845F5] text-white rounded-lg px-6 py-3 text-[32px] shadow-lg inline-block">
                                        {{ $currency }} {{ $detail['acv'] + 0 }}
                                    </strong>
                                </p>
                            </div>

                            <div class="w-full mt-2 text-[16px]">
                                <p class="mt-2 font-bold text-lg text-blue-600 border-b pb-2 mb-4">{{ $lang[5] ?? 'How it was calculated' }}:</p>
                                <div class="bg-gray-50 p-6 rounded-lg space-y-4 border">
                                    <div class="flex items-start space-x-3">
                                        <span class="bg-blue-100 text-blue-600 rounded-full w-6 h-6 flex items-center justify-center font-bold text-xs shrink-0 mt-1">1</span>
                                        <p><strong>{{ $lang[6] ?? 'Formula' }}:</strong> ACV = Replacement Cost × (Expected Life - Current Age) / Expected Life</p>
                                    </div>
                                    <div class="flex items-start space-x-3">
                                        <span class="bg-blue-100 text-blue-600 rounded-full w-6 h-6 flex items-center justify-center font-bold text-xs shrink-0 mt-1">2</span>
                                        <p><strong>{{ $lang[7] ?? 'Calculation' }}:</strong> {{ $currency }}{{ $price + 0 }} × ({{ $expected + 0 }} - {{ $current + 0 }}) / {{ $expected + 0 }}</p>
                                    </div>
                                    <div class="flex items-start space-x-3">
                                        <span class="bg-blue-100 text-blue-600 rounded-full w-6 h-6 flex items-center justify-center font-bold text-xs shrink-0 mt-1">3</span>
                                        <p><strong>{{ $lang[4] ?? 'Result' }}:</strong> <span class="orange-text font-bold">{{ $currency }}{{ $detail['acv'] + 0 }}</span></p>
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
