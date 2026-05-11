<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="w-full lg:w-2/3 mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-5">
                    {{-- Calcium --}}
                    <div class="space-y-2">
                        <label for="calcium" class="label">{!! $lang['Calcium'] !!}:</label>
                        <div class="relative w-full" x-data="{ open: false, unit: @entangle('unit_c') }">
                            <input type="number" step="any" wire:model.live="calcium" id="calcium" class="input" placeholder="00" />
                            <span class="absolute right-3 top-4 cursor-pointer text-sm underline" @click="open = !open">
                                <span x-text="unit"></span> ▾
                            </span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 p-2 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                <p @click="$wire.set('unit_c', 'mg/dl'); open = false" class="p-1 hover:bg-gray-100 cursor-pointer text-sm">milligrams per deciliter (mg/dL)</p>
                                <p @click="$wire.set('unit_c', 'mmol/l'); open = false" class="p-1 hover:bg-gray-100 cursor-pointer text-sm">millimoles per liter (mmol/L)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Albumin --}}
                    <div class="space-y-2">
                        <label for="albumin" class="label">{!! $lang['Albumin'] !!}:</label>
                        <div class="relative w-full" x-data="{ open: false, unit: @entangle('unit_a') }">
                            <input type="number" step="any" wire:model.live="albumin" id="albumin" class="input" placeholder="00" />
                            <span class="absolute right-3 top-4 cursor-pointer text-sm underline" @click="open = !open">
                                <span x-text="unit"></span> ▾
                            </span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 p-2 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                <p @click="$wire.set('unit_a', 'g/dL'); open = false" class="p-1 hover:bg-gray-100 cursor-pointer text-sm">grams per deciliter (g/dL)</p>
                                <p @click="$wire.set('unit_a', 'g/L'); open = false" class="p-1 hover:bg-gray-100 cursor-pointer text-sm">grams per liter (g/L)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Normal --}}
                    <div class="space-y-2">
                        <label for="normal" class="label">{!! $lang['Normal'] !!}:</label>
                        <div class="relative w-full" x-data="{ open: false, unit: @entangle('unit_n') }">
                            <input type="number" step="any" wire:model.live="normal" id="normal" class="input" placeholder="00" />
                            <span class="absolute right-3 top-4 cursor-pointer text-sm underline" @click="open = !open">
                                <span x-text="unit"></span> ▾
                            </span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 p-2 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                <p @click="$wire.set('unit_n', 'g/dL'); open = false" class="p-1 hover:bg-gray-100 cursor-pointer text-sm">grams per deciliter (g/dL)</p>
                                <p @click="$wire.set('unit_n', 'g/L'); open = false" class="p-1 hover:bg-gray-100 cursor-pointer text-sm">grams per liter (g/L)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full   rounded-xl mt-3">
                            <div class="w-full text-center mt-2">
                                <p class="text-lg text-[#3E9960] font-bold mb-2">{{ isset($lang['answer_text']) ? $lang['answer_text'] : 'Corrected Calcium' }}</p>
                                @if(isset($detail['Calcium_res']))
                                    <strong class="text-green text-4xl">{{ $detail['Calcium_res'] }}</strong>
                                @else
                                    <strong class="text-green text-4xl">00.0</strong>
                                @endif
                                <strong class="text-green text-2xl">{{ isset($detail['request']->unit_c) ? $detail['request']->unit_c : 'mg/dl' }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
