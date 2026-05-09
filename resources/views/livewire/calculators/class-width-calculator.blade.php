<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="minimum" class="font-s-14 text-blue">{{ $lang[1] ?? 'Minimum Value' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="minimum" id="minimum" class="input" aria-label="input" placeholder="e.g. 20" />
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="maximum" class="font-s-14 text-blue">{{ $lang[2] ?? 'Maximum Value' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="maximum" id="maximum" class="input" aria-label="input" placeholder="e.g. 40" />
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="number" class="font-s-14 text-blue">{{ $lang[3] ?? 'Number of Classes' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="number" id="number" class="input" aria-label="input" placeholder="e.g. 2" />
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
        
        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="col">
                                <div class="text-center">
                                    <p class="lg:text-[22px] md:text-[22px] text-[18px]">
                                        <strong>{{ $lang[4] ?? 'Class Width' }}</strong>
                                    </p>
                                    <div class="flex justify-center">
                                        <p class="text-[25px] w-auto bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ round($detail['answer'], 4) }}</strong>
                                        </p>
                                    </div>
                                </div>
                                <p class="w-full text-[18px]"><strong class="text-blue">{{ $lang[5] ?? 'Solution' }}</strong></p>
                                <p class="w-full my-2">{{ $lang[6] ?? 'The formula to calculate the class width is as follows' }}.</p>
                                <p class="w-full my-2">{{ $lang[4] ?? 'Class Width' }} = ({{ $lang[2] ?? 'Maximum' }} - {{ $lang[1] ?? 'Minimum' }}) / {{ $lang[3] ?? 'Number of Classes' }}</p>
                                <p class="w-full my-2">{{ $lang[4] ?? 'Class Width' }} = ({{ $maximum }} - {{ $minimum }}) / {{ $number }}</p>
                                <p class="w-full my-2">{{ $lang[4] ?? 'Class Width' }} = {{ round($detail['answer'], 4) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
