<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    {{-- Age --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="age" class="label">{!! $lang['age'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="age" id="age" min="1" class="input" placeholder="00" />
                        </div>
                    </div>

                    {{-- Tonsils --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="tonsils" class="label">{!! $lang['t'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="tonsils" id="tonsils" class="input">
                                <option value="0">{{ $lang['no'] }}</option>
                                <option value="1">{{ $lang['yes'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Cough --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="cough" class="label">{!! $lang['c'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="cough" id="cough" class="input">
                                <option value="0">{{ $lang['cc'] }}</option>
                                <option value="1">{{ $lang['nc'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Lymph nodes --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="lymph" class="label">{!! $lang['l'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="lymph" id="lymph" class="input">
                                <option value="0">{{ $lang['no'] }}</option>
                                <option value="1">{{ $lang['yes'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Temperature --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="temp" class="label">{{ $lang['b'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="temp" id="temp" step="any" class="input pr-12" placeholder="00" />
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline focus:outline-none">
                                    {{ $unit }} ▾
                                </button>
                            </div>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('°C'); open = false">°C</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('°F'); open = false">°F</p>
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
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full text-center">
                                <p class="w-full text-[20px] mt-2"><strong>{{ $lang['ans'] }}</strong></p>
                                <p class="w-full text-[32px]">
                                    @if(isset($detail['ans']))
                                        <strong class="text-[#119154]">{!! $detail['ans'] !!} Points</strong>
                                    @else
                                        <strong class="text-[#119154]">0.0 <span class="text-[#119154] lg:text-[25px] md:text-[25px] text-[18px]">Points</span></strong>
                                    @endif
                                </p>
                                <p class="w-full mt-2 text-lg">
                                    {{ $detail['per'] ?? '' }} {{ $detail['text'] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
