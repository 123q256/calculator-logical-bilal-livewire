<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[35%] md:w-[35%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <select wire:model.live="operations" id="operations" class="input my-2">
                            <option value="1">mcg to mg</option>
                            <option value="2">mg to mcg</option>
                        </select>
                    </div>
                    <div class="col-span-12">
                        <label for="first" class="font-s-14 text-blue">
                            {{ $operations == '1' ? 'mcg' : 'mg' }}
                        </label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="first" id="first" class="input" aria-label="input" placeholder="3" />
                            @if ($operations == '1')
                                <span class="text-blue input_unit">μg</span>
                            @else
                                <span class="text-blue input_unit">mg</span>
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
        <div id="result-section">
            @isset($detail)
                <div wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                    <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                        <div class="rounded-lg flex items-center justify-center">
                            <div class="w-full mt-3">
                                <div class="w-full my-4 text-center">
                                    @if ($detail['operations'] == 1)
                                        <p class="my-3"><strong class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2">{{ $detail['jawab'] . ' mg' }}</strong></p>
                                        <div class="text-left mt-6">
                                            <p class="font-s-20 mt-2 mb-1"><strong>{{ $lang[3] }}:</strong></p>
                                            <p class="my-2">{{ $lang[4] }} = {{ $first . ' μg' }}</p>
                                            <p class="my-2">{{ $lang[5] }} = {{ $first . ' / 1000' }}</p>
                                            <p class="my-2">{{ $lang[2] }} = {{ $detail['jawab'] . ' mg' }}</p>
                                        </div>
                                    @else
                                        <p class="my-3"><strong class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2">{{ $detail['jawab'] . ' μg' }}</strong></p>
                                        <div class="text-left mt-6">
                                            <p class="font-s-20 mt-2 mb-1"><strong>{{ $lang[3] }}:</strong></p>
                                            <p class="my-2">{{ $lang[4] }} = {{ $first . ' mg' }}</p>
                                            <p class="my-2">{{ $lang[5] }} = {{ $first . ' × 1000' }}</p>
                                            <p class="my-2">{{ $lang[2] }} = {{ $detail['jawab'] . ' μg' }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </form>
</div>
