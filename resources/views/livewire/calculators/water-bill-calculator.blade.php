 <div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="water" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="water" id="water" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="gallon" class="font-s-14 text-blue">
                            {{ $lang['2'] }} ({{ $currancy }} /{{ $lang['3'] }}):
                        </label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="gallon" id="gallon" class="input" aria-label="input" />
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
                                    <p class="text-[20px]"><strong>{{ $lang['4'] }}</strong></p>
                                    <div class="flex justify-center">
                                        <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2 my-3">
                                            <strong>{{ $currancy }} {{ number_format($detail['bill'], 2) }}</strong>
                                        </p>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <p class="text-[20px]"><strong>{{ $lang['5'] }}</strong></p>
                                    <p class="mt-2">{{ $lang['6'] }}:</p>
                                    <p class="mt-2">{{ $lang['4'] }} = {{ $lang['7'] }} * {{ $lang['2'] }} ({{ $lang['8'] }})</p>
                                    <p class="mt-2">{{ $lang['4'] }} = {{ $water }} * {{ $gallon }}</p>
                                    <p class="mt-2">{{ $lang['4'] }} = {{ number_format($detail['bill'], 2) }} {{ $currancy }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
