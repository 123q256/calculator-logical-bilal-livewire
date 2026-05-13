<div>
    <style>
        [x-cloak] { display: none !important; }
    </style>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if ($error)
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[70%] md:w-[70%] w-full mx-auto">
            <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="total" class="label">{{ $lang['1'] }}:</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="total" id="total" step="any" placeholder="{{ $lang[2] }}: 3.9 - 5.2" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $total_unit }} ▾</label>
                        <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('total_unit', 'mmol/L'); open = false">mmol/L</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('total_unit', 'mg/dL'); open = false">mg/dL</p>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="high" class="label">{{ $lang['3'] }} (HDL):</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="high" id="high" step="any" placeholder="{{ $lang[2] }}: 0 - 1.55" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $high_unit }} ▾</label>
                        <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('high_unit', 'mmol/L'); open = false">mmol/L</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('high_unit', 'mg/dL'); open = false">mg/dL</p>
                        </div>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="triglycerides" class="label">{{ $lang['4'] }} (TG):</label>
                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                        <input type="number" wire:model.live="triglycerides" id="triglycerides" step="any" placeholder="{{ $lang[2] }}: 0 - 1.7" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                        <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $triglycerides_unit }} ▾</label>
                        <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('triglycerides_unit', 'mmol/L'); open = false">mmol/L</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('triglycerides_unit', 'mg/dL'); open = false">mg/dL</p>
                        </div>
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
    @if ($detail)
        <hr>
        <div id="result-section" wire:key="result-{{ rand() }}" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-ful">
                            <p class="mt-2"><strong>{{ $lang[5] }} (LDL)</strong></p>
                            <p><strong class="text-[#119154] text-[32px]">{{ number_format($detail['ldl_mmoll'], 1) }}</strong><span class="text-green-500 text-[20px]"> (mmol/L)</span></p>
                            <p><strong class="text-[#119154] text-[32px]">{{ number_format($detail['ldl_mgdL'], 1) }}</strong><span class="text-green-500 text-[20px]"> (mg/dL)</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</form>
</div>
