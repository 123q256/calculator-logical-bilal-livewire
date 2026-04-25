<div>
    <style>
        [x-cloak] { display: none !important; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    {{-- Conversion Type --}}
                    <div class="space-y-2 relative">
                        <label for="convert" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                        <select wire:model.live="convert" id="convert" class="input">
                            <option value="1">{{ $lang['10'] }}</option>
                            <option value="2">{{ $lang['11'] }}</option>
                        </select>
                    </div>

                    {{-- Buffer Type (Acidic/Basic) --}}
                    <div class="space-y-2 relative">
                        <label for="buf_unit" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <select wire:model.live="buf_unit" id="buf_unit" class="input">
                            <option value="1">{{ $lang['2'] }}</option>
                            <option value="2">{{ $lang['3'] }}</option>
                        </select>
                    </div>

                    {{-- Ka / Kb Input (Show if convert == 1) --}}
                    <div class="space-y-2 {{ $convert == '1' ? '' : 'hidden' }}">
                        <label for="ka" class="font-s-14 text-blue">
                            K<span>{{ $buf_unit == '1' ? 'a' : 'b' }}</span>:
                        </label>
                        <input type="number" step="any" wire:model="ka" id="ka" class="input" placeholder="0.00" />
                    </div>

                    {{-- pH Input (Show if convert == 2) --}}
                    <div class="space-y-2 {{ $convert == '2' ? '' : 'hidden' }}">
                        <label for="ph" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                        <input type="number" step="any" wire:model="ph" id="ph" class="input" placeholder="7.00" />
                    </div>

                    {{-- Acid / Base Concentration --}}
                    <div class="space-y-2" x-data="{ open: false }">
                        <label for="acid" class="font-s-14 text-blue">
                            {{ $buf_unit == '1' ? $lang['2'] : $lang['3'] }} {{ $lang['4'] }}:
                        </label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model="acid" id="acid" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="0.00" />
                            <div class="absolute right-2 top-2">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer">
                                    {{ $acid_unit == '1' ? 'M' : ($acid_unit == '0.001' ? 'mM' : 'μM') }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md mt-1 right-0 shadow-lg">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" @click="$wire.set('acid_unit', '1'); open = false">M</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" @click="$wire.set('acid_unit', '0.001'); open = false">mM</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" @click="$wire.set('acid_unit', '0.000001'); open = false">μM</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Salt Concentration --}}
                    <div class="space-y-2" x-data="{ open: false }">
                        <label for="salt" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <div class="relative w-full">
                            <input type="number" step="any" wire:model="salt" id="salt" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="0.00" />
                            <div class="absolute right-2 top-2">
                                <button type="button" @click="open = !open" class="text-sm underline cursor-pointer">
                                    {{ $salt_unit == '1' ? 'M' : ($salt_unit == '0.001' ? 'mM' : 'μM') }} ▾
                                </button>
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md mt-1 right-0 shadow-lg">
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" @click="$wire.set('salt_unit', '1'); open = false">M</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" @click="$wire.set('salt_unit', '0.001'); open = false">mM</p>
                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" @click="$wire.set('salt_unit', '0.000001'); open = false">μM</p>
                                </div>
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
    </form>

    <hr>

    @if ($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            
            <div class="lg:w-[80%] md:w-[80%] w-full overflow-auto mt-4">
                <table class="w-full" cellspacing="0">
                    {{-- pKa Result --}}
                    <tr>
                        <td class="border-b py-3 px-3 font-semibold text-gray-700 text-lg">
                            {{ $detail['unit'] == "1" ? $lang['6'] : $lang['7'] }}
                        </td>
                        <td class="border-b py-3 px-3 text-right font-bold text-[#119154] text-2xl">
                            {{ round($detail['pka'], 4) }}
                        </td>
                    </tr>

                    {{-- pH Result --}}
                    @if(isset($detail['ph']) && $detail['ph'] != "")
                        <tr>
                            <td class="border-b py-3 px-3 font-semibold text-gray-700 text-lg">
                                {{ $lang['8'] }}
                            </td>
                            <td class="border-b py-3 px-3 text-right font-bold text-[#119154] text-2xl">
                                {{ round($detail['ph'], 4) }}
                            </td>
                        </tr>
                    @endif

                    {{-- Ka/Kb Result --}}
                    @if(isset($detail['pk']) && $detail['pk'] != "")
                        <tr>
                            <td class="py-3 px-3 font-semibold text-gray-700 text-lg">
                                {{ $detail['unit'] == "1" ? $lang['12'] : $lang['13'] }}
                            </td>
                            <td class="py-3 px-3 text-right font-bold text-[#119154] text-2xl">
                                @if (is_numeric($detail['pk']))
                                    @if ($detail['pk'] < 0.0001 && $detail['pk'] > 0)
                                        @php
                                            $formatted = sprintf('%.2E', $detail['pk']);
                                            $parts = explode('E', $formatted);
                                            $base = $parts[0];
                                            $exp = (int)$parts[1];
                                        @endphp
                                        {!! $base !!} &times; 10<sup>{!! $exp !!}</sup>
                                    @else
                                        {{ round($detail['pk'], 6) }}
                                    @endif
                                @else
                                    {{ $detail['pk'] }}
                                @endif
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    @endif
</div>
