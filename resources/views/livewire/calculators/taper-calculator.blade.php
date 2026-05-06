<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[80%] md:w-[90%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center mt-3">
                    <div class="space-y-6">
                        {{-- Major Diameter --}}
                        <div x-data="{ open: false }" class="w-full">
                            <label for="major" class="label">{{ $lang['1'] }}:</label>
                            <div class="relative w-full mt-2">
                                <input type="number" wire:model.live.debounce.500ms="major" id="major" step="any" class="input pr-16" placeholder="00" />
                                <div class="absolute right-4 top-3 flex items-center">
                                    <span @click="open = !open" class="text-sm  cursor-pointer underline decoration-gray-400">
                                        <span x-text="$wire.major_unit"></span> ▾
                                    </span>
                                </div>
                                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[180px] py-1 overflow-y-auto scrollbar-thin" x-cloak>
                                    @foreach(['mm' => 'milimeters (mm)', 'cm' => 'centimeters (cm)', 'm' => 'meters (m)', 'ft' => 'feet (ft)', 'in' => 'inches (in)'] as $unit => $label)
                                        <p @click="$wire.set('major_unit', '{{ $unit }}'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer transition-colors {{ $major_unit == $unit ? '  bg-blue-50' : 'text-gray-700' }}">
                                            {{ $label }}
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Minor Diameter --}}
                        <div x-data="{ open: false }" class="w-full">
                            <label for="minor" class="label">{{ $lang['2'] }}:</label>
                            <div class="relative w-full mt-2">
                                <input type="number" wire:model.live.debounce.500ms="minor" id="minor" step="any" class="input pr-16" placeholder="00" />
                                <div class="absolute right-4 top-3 flex items-center">
                                    <span @click="open = !open" class="text-sm  cursor-pointer underline decoration-gray-400">
                                        <span x-text="$wire.minor_unit"></span> ▾
                                    </span>
                                </div>
                                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[180px] py-1 overflow-y-auto scrollbar-thin" x-cloak>
                                    @foreach(['mm' => 'milimeters (mm)', 'cm' => 'centimeters (cm)', 'm' => 'meters (m)', 'ft' => 'feet (ft)', 'in' => 'inches (in)'] as $unit => $label)
                                        <p @click="$wire.set('minor_unit', '{{ $unit }}'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer transition-colors {{ $minor_unit == $unit ? '  bg-blue-50' : 'text-gray-700' }}">
                                            {{ $label }}
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Length --}}
                        <div x-data="{ open: false }" class="w-full">
                            <label for="length" class="label">{{ $lang['3'] }}:</label>
                            <div class="relative w-full mt-2">
                                <input type="number" wire:model.live.debounce.500ms="length" id="length" step="any" class="input pr-16" placeholder="00" />
                                <div class="absolute right-4 top-3 flex items-center">
                                    <span @click="open = !open" class="text-sm  cursor-pointer underline decoration-gray-400">
                                        <span x-text="$wire.length_unit"></span> ▾
                                    </span>
                                </div>
                                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[180px] py-1 overflow-y-auto scrollbar-thin" x-cloak>
                                    @foreach(['mm' => 'milimeters (mm)', 'cm' => 'centimeters (cm)', 'm' => 'meters (m)', 'ft' => 'feet (ft)', 'in' => 'inches (in)'] as $unit => $label)
                                        <p @click="$wire.set('length_unit', '{{ $unit }}'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer transition-colors {{ $length_unit == $unit ? '  bg-blue-50' : 'text-gray-700' }}">
                                            {{ $label }}
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center lg:justify-end">
                        <img src="{{ asset('images/taper_new.webp') }}" alt="Taper Diagram" class="max-w-full h-auto rounded-2xl shadow-sm border border-gray-100" width="500" height="80">
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
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="w-full lg:w-[80%] overflow-auto text-[18px]">
                                    {{-- Taper Angle Section --}}
                                    <div class="mb-8">
                                        <p class="text-[18px] font-black  mb-2">{{ $lang['4'] }} (θ)</p>
                                        <table class="w-full border-spacing-y-1">
                                            <tr>
                                                <td class="py-2 px-6  border-b">Degrees:</td>
                                                <td class="py-2 px-6 text-right font-black  border-b">{{ round($detail['answer'], 4) }} deg</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 px-6  border-b">Radians:</td>
                                                <td class="py-2 px-6 text-right font-black  border-b">{{ round($detail['answer_rad'], 4) }} rad</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 px-6  border-b">Gradians (gon):</td>
                                                <td class="py-2 px-6 text-right font-black  border-b">{{ round($detail['answer_gon'], 4) }} gon</td>
                                            </tr>
                                        </table>
                                    </div>

                                    {{-- Taper Ratio Section --}}
                                    <div>
                                        <p class="text-[18px] font-black  mb-2">{{ $lang['5'] }} (T)</p>
                                        <table class="w-full border-spacing-y-1">
                                            <tr>
                                                <td class="py-2 px-6  border-b">Inches (in):</td>
                                                <td class="py-2 px-6 text-right font-black  border-b">{{ round($detail['main'], 4) }} in</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 px-6  border-b">Centimeters (cm):</td>
                                                <td class="py-2 px-6 text-right font-black  border-b">{{ round($detail['main_cm'], 4) }} cm</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 px-6  border-b">Meters (m):</td>
                                                <td class="py-2 px-6 text-right font-black  border-b">{{ round($detail['main_m'], 4) }} m</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 px-6  border-b">Milimeters (mm):</td>
                                                <td class="py-2 px-6 text-right font-black  border-b">{{ round($detail['main_mm'], 4) }} mm</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 px-6  border-b">Feet (ft):</td>
                                                <td class="py-2 px-6 text-right font-black  border-b">{{ round($detail['main_ft'], 4) }} ft</td>
                                            </tr>
                                        </table>
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
