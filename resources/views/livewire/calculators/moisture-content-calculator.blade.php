<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[80%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-3">
                    {{-- Wet Mass --}}
                    <div class="w-full" x-data="{ open: false }">
                        <label for="wet" class="label">{{ $lang['wet'] }}:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" wire:model.live.debounce.500ms="wet" id="wet" step="any" class="input pr-16" placeholder="00" />
                            <div class="absolute right-4 top-3 flex items-center">
                                <span @click="open = !open" class="text-sm font-bold text-gray-700 cursor-pointer hover:text-blue-600 underline decoration-gray-400">
                                    <span x-text="$wire.wet_unit"></span> ▾
                                </span>
                            </div>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg  right-0 mt-2 w-[60px] py-1 overflow-hidden" x-cloak>
                                @foreach(['mg', 'g', 'oz', 'kg', 'lb'] as $unit)
                                    <button type="button" @click="$wire.set('wet_unit', '{{ $unit }}'); open = false" class="w-full text-center py-2 text-sm hover:bg-gray-100 transition-colors {{ $wet_unit == $unit ? 'text-blue-700 font-bold bg-blue-50' : 'text-gray-700' }}">
                                        {{ $unit }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Dry Mass --}}
                    <div class="w-full" x-data="{ open: false }">
                        <label for="dry" class="label">{{ $lang['dry'] }}:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" wire:model.live.debounce.500ms="dry" id="dry" step="any" class="input pr-16" placeholder="00" />
                            <div class="absolute right-4 top-3 flex items-center">
                                <span @click="open = !open" class="text-sm font-bold text-gray-700 cursor-pointer hover:text-blue-600 underline decoration-gray-400">
                                    <span x-text="$wire.dry_unit"></span> ▾
                                </span>
                            </div>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[60px] py-1 overflow-hidden" x-cloak>
                                @foreach(['mg', 'g', 'oz', 'kg', 'lb'] as $unit)
                                    <button type="button" @click="$wire.set('dry_unit', '{{ $unit }}'); open = false" class="w-full text-center py-2 text-sm hover:bg-gray-100 transition-colors {{ $dry_unit == $unit ? 'text-blue-700 font-bold bg-blue-50' : 'text-gray-700' }}">
                                        {{ $unit }}
                                    </button>
                                @endforeach
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

        @isset($detail)
            <hr class="my-8">
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-8 result">
                 <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="col-12 bg-light-blue  p-3 radius-10 mt-3">
                    <div class="w-full">
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{$lang['moisture']}}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-3 py-2  my-3"><strong class="text-blue">{{$detail['mc']}} %</strong></p>
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
