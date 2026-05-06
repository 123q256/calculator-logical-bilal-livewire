<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[80%] w-full mx-auto space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-3">
                    {{-- Focus Distance (d) --}}
                    <div class="w-full" x-data="{ open: false }">
                        <label for="d" class="label">{{ $lang['focus_d'] }} (d):</label>
                        <div class="relative w-full mt-2">
                            <input type="number" wire:model.live.debounce.500ms="d" id="d" step="any" class="input pr-16" placeholder="00" />
                            <div class="absolute right-4 top-3 flex items-center">
                                <span @click="open = !open" class="text-sm font-bold text-gray-700 cursor-pointer hover:text-blue-600 underline decoration-gray-400">
                                    <span x-text="$wire.d_unit"></span> ▾
                                </span>
                            </div>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[180px] py-1  overflow-y-auto scrollbar-thin" x-cloak>
                                @php
                                    $d_units = [
                                        'cm' => 'centimeters (cm)',
                                        'mm' => 'milimeters (mm)',
                                        'm' => 'meters (m)',
                                        'km' => 'kilometers (km)',
                                        'in' => 'inches (in)',
                                        'yd' => 'yards (yd)',
                                        'mi' => 'miles (mi)',
                                        'nmi' => 'nautical miles (nmi)'
                                    ];
                                @endphp
                                @foreach($d_units as $unit => $label)
                                    <p @click="$wire.set('d_unit', '{{ $unit }}'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer transition-colors {{ $d_unit == $unit ? 'text-blue-700 font-bold bg-blue-50' : 'text-gray-700' }}">
                                        {{ $label }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Focal Distance (f) --}}
                    <div class="w-full" x-data="{ open: false }">
                        <label for="f" class="label">{{ $lang['focal_d'] }} (f):</label>
                        <div class="relative w-full mt-2">
                            <input type="number" wire:model.live.debounce.500ms="f" id="f" step="any" class="input pr-16" placeholder="00" />
                            <div class="absolute right-4 top-3 flex items-center">
                                <span @click="open = !open" class="text-sm font-bold text-gray-700 cursor-pointer hover:text-blue-600 underline decoration-gray-400">
                                    <span x-text="$wire.f_unit"></span> ▾
                                </span>
                            </div>
                            <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="absolute z-50 bg-white border border-gray-200 rounded-lg shadow-xl right-0 mt-2 w-[180px] py-1  overflow-y-auto scrollbar-thin" x-cloak>
                                @php
                                    $f_units = [
                                        'cm' => 'centimeters (cm)',
                                        'mm' => 'milimeters (mm)',
                                        'm' => 'meters (m)',
                                        'km' => 'kilometers (km)',
                                        'in' => 'inches (in)',
                                        'yd' => 'yards (yd)',
                                        'mi' => 'miles (mi)'
                                    ];
                                @endphp
                                @foreach($f_units as $unit => $label)
                                    <p @click="$wire.set('f_unit', '{{ $unit }}'); open = false" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-100 cursor-pointer transition-colors {{ $f_unit == $unit ? 'text-blue-700 font-bold bg-blue-50' : 'text-gray-700' }}">
                                        {{ $label }}
                                    </p>
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
            <hr >
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-8 result">
              <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full my-2">
                            <div class="w-full md:w-[60%] lg:w-[60%] ">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="border-b py-2">
                                            <strong>{{ $lang['magnification'] }} :</strong></td>
                                        <td class="border-b py-2">{{ $detail['m'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">
                                            <strong>{{ $lang['o_d'] }} :</strong></td>
                                        <td class="border-b py-2">{{ $detail['g'] }} m</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">
                                            <strong>{{ $lang['s_d'] }} :</strong></td>
                                        <td class="border-b py-2">{{ $detail['h'] }} m</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        @endisset
    </form>
</div>
