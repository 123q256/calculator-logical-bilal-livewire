<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-8">
                    <div class="space-y-4">
                        {{-- Fabric Width --}}
                        <div x-data="{ open: false }">
                            <label for="fabric" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live.debounce.500ms="fabric" id="fabric" step="any" class="input pr-16" placeholder="00" />
                                <div class="absolute right-4 top-3 flex items-center">
                                    <span @click="open = !open" class="text-sm cursor-pointer underline decoration-gray-400">
                                        <span x-text="$wire.fabric_unit"></span> ▾
                                    </span>
                                </div>
                                <div x-show="open" @click.away="open = false" x-transition class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[180px] py-1 overflow-y-auto" x-cloak>
                                    @foreach (["mm", "cm", "m", "in", "ft", "km", "yd"] as $u)
                                        <p @click="$wire.set('fabric_unit', '{{ $u }}'); open = false" class="px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer {{ $fabric_unit == $u ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-700' }}">
                                            {{ $u == 'mm' ? 'milimeters (mm)' : ($u == 'cm' ? 'centimeters (cm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : ($u == 'ft' ? 'feet (ft)' : ($u == 'km' ? 'kilometers (km)' : 'yard (yd)'))))) }}
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Piece Width --}}
                        <div x-data="{ open: false }">
                            <label for="width" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live.debounce.500ms="width" id="width" step="any" class="input pr-16" placeholder="00" />
                                <div class="absolute right-4 top-3 flex items-center">
                                    <span @click="open = !open" class="text-sm cursor-pointer underline decoration-gray-400">
                                        <span x-text="$wire.width_unit"></span> ▾
                                    </span>
                                </div>
                                <div x-show="open" @click.away="open = false" x-transition class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[180px] py-1 overflow-y-auto" x-cloak>
                                    @foreach (["mm", "cm", "m", "in", "ft", "km", "yd"] as $u)
                                        <p @click="$wire.set('width_unit', '{{ $u }}'); open = false" class="px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer {{ $width_unit == $u ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-700' }}">
                                            {{ $u == 'mm' ? 'milimeters (mm)' : ($u == 'cm' ? 'centimeters (cm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : ($u == 'ft' ? 'feet (ft)' : ($u == 'km' ? 'kilometers (km)' : 'yard (yd)'))))) }}
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Piece Length --}}
                        <div x-data="{ open: false }">
                            <label for="length" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live.debounce.500ms="length" id="length" step="any" class="input pr-16" placeholder="00" />
                                <div class="absolute right-4 top-3 flex items-center">
                                    <span @click="open = !open" class="text-sm cursor-pointer underline decoration-gray-400">
                                        <span x-text="$wire.length_unit"></span> ▾
                                    </span>
                                </div>
                                <div x-show="open" @click.away="open = false" x-transition class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[180px] py-1 overflow-y-auto" x-cloak>
                                    @foreach (["mm", "cm", "m", "in", "ft", "km", "yd"] as $u)
                                        <p @click="$wire.set('length_unit', '{{ $u }}'); open = false" class="px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer {{ $length_unit == $u ? 'bg-blue-50 text-blue-700 font-bold' : 'text-gray-700' }}">
                                            {{ $u == 'mm' ? 'milimeters (mm)' : ($u == 'cm' ? 'centimeters (cm)' : ($u == 'm' ? 'meters (m)' : ($u == 'in' ? 'inches (in)' : ($u == 'ft' ? 'feet (ft)' : ($u == 'km' ? 'kilometers (km)' : 'yard (yd)'))))) }}
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Piece Count --}}
                        <div>
                            <label for="piece" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                            <div class="w-full py-2">
                                <input type="number" wire:model.live.debounce.500ms="piece" step="any" id="piece" class="input" placeholder="0" />
                            </div>
                        </div>

                        {{-- Output Unit --}}
                        <div>
                            <label for="unit" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                            <div class="w-full py-2">
                                <select wire:model.live="unit" id="unit" class="input">
                                    @foreach (["mm", "cm", "m", "km", "in", "ft", "yd"] as $u)
                                        <option value="{{ $u }}">{{ $u }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-center">
                        <img src="{{ asset('images/fabric_new.webp') }}" alt="Fabric" class="max-w-full h-auto drop-shadow-2xl rounded-2xl" width="300">
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="w-full md:w-[60%] lg:w-[60%] text-[18px]">
                                    <p class="text-[20px] mt-3 mb-2"><strong>{{ $lang['6'] }}</strong></p>
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['7'] }} :</td>
                                            <td class="border-b py-2">{{ $detail['answer'] . $detail['unit'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b pt-4 pb-2">{{ $lang['8'] }} :</td>
                                            <td class="border-b pt-4 pb-2">{{ $detail['down'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['9'] }} :</td>
                                            <td class="border-b py-2">{{ $detail['across'] }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div>
                                    <p class="text-[20px] my-3"><strong>{{ $lang['10'] }}</strong></p>
                                    <p class="my-2">{{ $lang['11'] }}.</p>
                                    <p class="my-2">{{ $lang['9'] }} = {{ $lang['1'] }} / {{ $lang['2'] }}</p>
                                    <p class="my-2">{{ $lang['9'] }} = {{ $detail['fabric'] }} /{{ $detail['width'] }}</p>
                                    <p class="my-2">{{ $lang['9'] }} = {{ $detail['across'] }}</p>
                                    <p class="my-2">{{ $lang['12'] }}.</p>
                                    <p class="my-2">{{ $lang['8'] }} = {{ $lang['4'] }} / {{ $lang['9'] }}</p>
                                    <p class="my-2">{{ $lang['8'] }} = {{ $detail['piece'] }} / {{ $detail['across'] }}</p>
                                    <p class="my-2">{{ $lang['8'] }} = {{ $detail['down'] }}</p>
                                    <p class="my-2">{{ $lang['13'] }}.</p>
                                    <p class="my-2">{{ $lang['14'] }} = {{ $lang['3'] }} *{{ $lang['8'] }}</p>
                                    <p class="my-2">{{ $lang['14'] }} = {{ $detail['length'] }} * {{ $detail['down'] }}</p>
                                    <p class="my-2">{{ $lang['14'] }} = {{ $detail['answer'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
