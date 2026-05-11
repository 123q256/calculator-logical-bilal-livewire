<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="w-full lg:w-9/12 mx-auto">
                <div class="flex flex-col">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-5">
                        {{-- First hCG --}}
                        <div class="px-2 lg:px-4">
                            <label for="first" class="label">{!! $lang['1'] !!}:</label>
                            <div class="relative py-2">
                                <input type="number" step="any" wire:model.live="first" id="first" class="input w-full" aria-label="input" placeholder="00" required />
                                <span class="absolute right-2 top-5 input-unit">mIU/ml</span>
                            </div>
                        </div>

                        {{-- Second hCG --}}
                        <div class="px-2 lg:px-4">
                            <label for="second" class="label">{!! $lang['2'] !!}:</label>
                            <div class="relative py-2">
                                <input type="number" step="any" wire:model.live="second" id="second" class="input w-full" aria-label="input" placeholder="00" required />
                                <span class="absolute right-2 top-5 input-unit">mIU/ml</span>
                            </div>
                        </div>

                        {{-- Time interval --}}
                        <div class="w-full px-2 lg:pl-4">
                            <label for="third" class="label">{!! $lang['3'] !!}:</label>
                            <div class="relative w-full py-2" x-data="{ open: false }">
                                <input type="number" wire:model.live="third" id="third" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-[#3E9960] w-full" aria-label="input" placeholder="00" required />
                                <label for="unit3" class="absolute cursor-pointer text-sm underline right-6 top-5" @click="open = !open">
                                    @php
                                        $unit_labels = ['hours' => $lang['4'], 'days' => $lang['5']];
                                    @endphp
                                    {{ $unit_labels[$unit3] ?? $lang['4'] }} ▾
                                </label>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg" x-cloak>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('unit3', 'hours'); open = false">{{ $lang['4'] }}</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('unit3', 'days'); open = false">{{ $lang['5'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @elseif ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    @if ($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full rounded-lg mt-3">
                        <div class="w-full mt-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Difference --}}
                                <div class="px-3">
                                    <div class="flex items-center bg-[#F6FAFC] text-black border rounded-lg px-4 py-3 h-full" style="border: 1px solid #c1b8b899; min-height: 80px;">
                                        <p class="w-1/2"><strong>{{ $lang['7'] }}</strong></p>
                                        <p class="w-1/2 text-right">
                                            <strong class="text-[#119154] text-2xl">{{ number_format($detail['difference'], 2) }}</strong>
                                            <span class="text-[#119154] text-sm ml-1">(mIU/ml)</span>
                                        </p>
                                    </div>
                                </div>

                                {{-- Percent Increase --}}
                                <div class="px-3">
                                    <div class="flex items-center bg-[#F6FAFC] text-black border rounded-lg px-4 py-3 h-full" style="border: 1px solid #c1b8b899; min-height: 80px;">
                                        <p class="w-1/2"><strong>{{ $lang['8'] }}</strong></p>
                                        <p class="w-1/2 text-right">
                                            <strong class="text-[#119154] text-2xl">{{ number_format($detail['percent'], 2) }}</strong>
                                            <span class="text-[#119154] text-sm ml-1">(%)</span>
                                        </p>
                                    </div>
                                </div>

                                {{-- Doubling Time --}}
                                <div class="px-3">
                                    <div class="flex items-center bg-[#F6FAFC] text-black border rounded-lg px-4 py-3 h-full" style="border: 1px solid #c1b8b899; min-height: 80px;">
                                        <p class="w-1/2"><strong>{{ $lang['9'] }}</strong></p>
                                        <p class="w-1/2 text-right">
                                            <strong class="text-[#119154] text-2xl">{{ number_format($detail['t2'], 2) }}</strong>
                                            <span class="text-[#119154] text-sm ml-1">(days)</span>
                                        </p>
                                    </div>
                                </div>

                                {{-- 2-day Increase --}}
                                <div class="px-3">
                                    <div class="flex items-center bg-[#F6FAFC] text-black border rounded-lg px-4 py-3 h-full" style="border: 1px solid #c1b8b899; min-height: 80px;">
                                        <p class="w-1/2"><strong>{{ $lang['10'] }}</strong></p>
                                        <p class="w-1/2 text-right">
                                            <strong class="text-[#119154] text-2xl">{{ number_format($detail['i1'], 2) }}</strong>
                                            <span class="text-[#119154] text-sm ml-1">(%)</span>
                                        </p>
                                    </div>
                                </div>

                                {{-- 3-day Increase --}}
                                <div class="px-3">
                                    <div class="flex items-center bg-[#F6FAFC] text-black border rounded-lg px-4 py-3 h-full" style="border: 1px solid #c1b8b899; min-height: 80px;">
                                        <p class="w-1/2"><strong>{{ $lang['11'] }}</strong></p>
                                        <p class="w-1/2 text-right">
                                            <strong class="text-[#119154] text-2xl">{{ number_format($detail['i2'], 2) }}</strong>
                                            <span class="text-[#119154] text-sm ml-1">(%)</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
