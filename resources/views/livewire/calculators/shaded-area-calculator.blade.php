<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[80%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-3">
                    {{-- Input Dimension --}}
                    <div class="w-full" x-data="{ open: false }">
                        <label for="input" class="label">{{ $lang['1'] }}:</label>
                        <div class="relative w-full mt-2">
                            <input type="number" wire:model.live.debounce.500ms="input" id="input" step="any" class="input pr-16" placeholder="00" />
                            <div class="absolute right-4 top-3 flex items-center">
                                <span @click="open = !open" class="text-sm font-bold text-gray-700 cursor-pointer hover:text-blue-600 underline decoration-gray-400">
                                    <span x-text="$wire.in_unit"></span> ▾
                                </span>
                            </div>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[80px] py-1  overflow-y-auto scrollbar-thin" x-cloak>
                                @foreach(['m', 'AU', 'cm', 'km', 'in', 'ft', 'mil', 'mm', 'nm', 'mile', 'parsec', 'pm', 'yd'] as $unit)
                                    <button type="button" @click="$wire.set('in_unit', '{{ $unit }}'); open = false" class="w-full text-center py-2 text-sm hover:bg-gray-100 transition-colors {{ $in_unit == $unit ? 'text-blue-700 font-bold bg-blue-50' : 'text-gray-700' }}">
                                        {{ $unit }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Target Unit (Solve) --}}
                    <div class="w-full">
                        <label for="solve" class="label">{{ $lang['2'] }}:</label>
                        <div class="w-full mt-2">
                            <select wire:model.live="solve" id="solve" class="input">
                                @php
                                    $units = [
                                        "1@@m²" => "m²",
                                        "0.000247105@@Acre" => "Acre",
                                        "10000000000000000000000000000@@Barn" => "Barn",
                                        "0.0001@@Hectare" => "Hectare",
                                        "10000@@cm²" => "cm²",
                                        "0.000001@@km²" => "km²",
                                        "10.7639@@ft²" => "ft²",
                                        "1550@@in²" => "in²",
                                        "0.0000003861@@miles²" => "miles²",
                                        "1.19599@@yd²" => "yd²"
                                    ];
                                @endphp
                                @foreach($units as $val => $name)
                                    <option value="{{ $val }}">{{ $name }}</option>
                                @endforeach
                            </select>
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
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-8 result">
                <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="col-12 bg-light-blue  p-3 radius-10 mt-3">
                    <div class="w-full">
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{$lang['3']}}</strong></p>
                            <div class="flex justify-center">
                                <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue">{{ $detail['answer']  }} <span class="font-s-20">{{$detail['unit']}}</span> </strong></p>
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
