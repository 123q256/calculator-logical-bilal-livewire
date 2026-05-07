<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 mt-3 gap-10">
                    <div class="space-y-6">
                        {{-- Mount Type --}}
                        <div>
                            <label for="blind_type" class="label cat">{{ $lang['1'] }}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="blind_type" id="blind_type" class="input">
                                    <option value="inside">{{ $lang['12'] }}</option>
                                    <option value="outside">{{ $lang['13'] }}</option>
                                </select>
                            </div>
                        </div>

                        {{-- Top Width --}}
                        <div>
                            <label for="top" class="label">{{ $lang['2'] }}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-50' : 'z-40'">
                                <input type="number" step="any" wire:model.live="top" id="top" class="input pr-20" />
                                <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                    <button type="button" @click="open = !open" class="text-sm underline cursor-pointer flex items-center gap-1 text-blue">
                                        {{ $t_units }} ▾
                                    </button>
                                    <div x-show="open" x-cloak @click.away="open = false" 
                                         class="absolute z-[100] bg-white border border-gray-300 rounded shadow-2xl right-0 top-full mt-2 min-w-[120px] overflow-hidden">
                                        @foreach (['cm' => 'centimeters', 'mm' => 'milimeters', 'ft' => 'feet', 'in' => 'inches'] as $u => $label)
                                            <div @click="$wire.set('t_units', '{{ $u }}'); open = false" 
                                                 class="p-2 hover:bg-blue-50 hover:text-blue-600 cursor-pointer text-sm text-center border-b last:border-0 bg-white transition-colors duration-150">
                                                {{ $label }} ({{ $u }})
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Middle Width --}}
                        <div>
                            <label for="width" class="label">{{ $lang['3'] }}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-40' : 'z-30'">
                                <input type="number" step="any" wire:model.live="width" id="width" class="input pr-20" />
                                <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                    <button type="button" @click="open = !open" class="text-sm underline cursor-pointer flex items-center gap-1 text-blue">
                                        {{ $w_units }} ▾
                                    </button>
                                    <div x-show="open" x-cloak @click.away="open = false" 
                                         class="absolute z-[100] bg-white border border-gray-300 rounded shadow-2xl right-0 top-full mt-2 min-w-[120px] overflow-hidden">
                                        @foreach (['cm' => 'centimeters', 'mm' => 'milimeters', 'ft' => 'feet', 'in' => 'inches'] as $u => $label)
                                            <div @click="$wire.set('w_units', '{{ $u }}'); open = false" 
                                                 class="p-2 hover:bg-blue-50 hover:text-blue-600 cursor-pointer text-sm text-center border-b last:border-0 bg-white transition-colors duration-150">
                                                {{ $label }} ({{ $u }})
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Bottom Width --}}
                        <div>
                            <label for="bottom" class="label">{{ $lang['4'] }}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-30' : 'z-20'">
                                <input type="number" step="any" wire:model.live="bottom" id="bottom" class="input pr-20" />
                                <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                    <button type="button" @click="open = !open" class="text-sm underline cursor-pointer flex items-center gap-1 text-blue">
                                        {{ $b_units }} ▾
                                    </button>
                                    <div x-show="open" x-cloak @click.away="open = false" 
                                         class="absolute z-[100] bg-white border border-gray-300 rounded shadow-2xl right-0 top-full mt-2 min-w-[120px] overflow-hidden">
                                        @foreach (['cm' => 'centimeters', 'mm' => 'milimeters', 'ft' => 'feet', 'in' => 'inches'] as $u => $label)
                                            <div @click="$wire.set('b_units', '{{ $u }}'); open = false" 
                                                 class="p-2 hover:bg-blue-50 hover:text-blue-600 cursor-pointer text-sm text-center border-b last:border-0 bg-white transition-colors duration-150">
                                                {{ $label }} ({{ $u }})
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Height Left --}}
                        <div>
                            <label for="h_left" class="label">{{ $lang['5'] }}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-20' : 'z-10'">
                                <input type="number" step="any" wire:model.live="h_left" id="h_left" class="input pr-20" />
                                <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                    <button type="button" @click="open = !open" class="text-sm underline cursor-pointer flex items-center gap-1 text-blue">
                                        {{ $l_units }} ▾
                                    </button>
                                    <div x-show="open" x-cloak @click.away="open = false" 
                                         class="absolute z-[100] bg-white border border-gray-300 rounded shadow-2xl right-0 top-full mt-2 min-w-[120px] overflow-hidden">
                                        @foreach (['cm' => 'centimeters', 'mm' => 'milimeters', 'ft' => 'feet', 'in' => 'inches'] as $u => $label)
                                            <div @click="$wire.set('l_units', '{{ $u }}'); open = false" 
                                                 class="p-2 hover:bg-blue-50 hover:text-blue-600 cursor-pointer text-sm text-center border-b last:border-0 bg-white transition-colors duration-150">
                                                {{ $label }} ({{ $u }})
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex justify-center">
                            <img src="{{asset('images/blind_size.webp')}}" alt="Blind" class="rounded-xl shadow-lg border border-gray-100">
                        </div>

                        {{-- Height Center --}}
                        <div>
                            <label for="h_center" class="label">{{ $lang['6'] }}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-20' : 'z-10'">
                                <input type="number" step="any" wire:model.live="h_center" id="h_center" class="input pr-20" />
                                <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                    <button type="button" @click="open = !open" class="text-sm underline cursor-pointer flex items-center gap-1 text-blue">
                                        {{ $c_units }} ▾
                                    </button>
                                    <div x-show="open" x-cloak @click.away="open = false" 
                                         class="absolute z-[100] bg-white border border-gray-300 rounded shadow-2xl right-0 top-full mt-2 min-w-[120px] overflow-hidden">
                                        @foreach (['cm' => 'centimeters', 'mm' => 'milimeters', 'ft' => 'feet', 'in' => 'inches'] as $u => $label)
                                            <div @click="$wire.set('c_units', '{{ $u }}'); open = false" 
                                                 class="p-2 hover:bg-blue-50 hover:text-blue-600 cursor-pointer text-sm text-center border-b last:border-0 bg-white transition-colors duration-150">
                                                {{ $label }} ({{ $u }})
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Height Right --}}
                        <div>
                            <label for="h_right" class="label">{{ $lang['7'] }}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }" :class="open ? 'z-10' : 'z-0'">
                                <input type="number" step="any" wire:model.live="h_right" id="h_right" class="input pr-20" />
                                <div class="absolute right-4 top-1/2 -translate-y-1/2">
                                    <button type="button" @click="open = !open" class="text-sm underline cursor-pointer flex items-center gap-1 text-blue">
                                        {{ $r_units }} ▾
                                    </button>
                                    <div x-show="open" x-cloak @click.away="open = false" 
                                         class="absolute z-[100] bg-white border border-gray-300 rounded shadow-2xl right-0 top-full mt-2 min-w-[120px] overflow-hidden">
                                        @foreach (['cm' => 'centimeters', 'mm' => 'milimeters', 'ft' => 'feet', 'in' => 'inches'] as $u => $label)
                                            <div @click="$wire.set('r_units', '{{ $u }}'); open = false" 
                                                 class="p-2 hover:bg-blue-50 hover:text-blue-600 cursor-pointer text-sm text-center border-b last:border-0 bg-white transition-colors duration-150">
                                                {{ $label }} ({{ $u }})
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
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

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                @php
                                    $width = round($detail['blind_width'], 2);
                                    $lenght = round($detail['blind_lenght'], 2);   
                                @endphp
                                <div class="w-full lg:w-[80%] overflow-auto text-[18px]">
                                    <table class="w-full">
                                        <tr>
                                            <td width="60%" class="border-b py-2">{{ $lang['8'] }}</td>
                                            <td class="border-b py-2">{{ $width }} in</td>
                                        </tr>
                                        @if($detail['type'] == 'inside')
                                            <tr>
                                                <td width="60%" class="border-b py-2">{{ $lang['10'] }}</td>
                                                <td class="border-b py-2">{{ round($detail['s_lenght'], 2) }} in</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td width="60%" class="border-b py-2">{{ $lang['9'] }}</td>
                                            <td class="border-b py-2">{{ $lenght }} in</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="w-full lg:w-[80%] overflow-auto font-s-18 mt-8">
                                    <p class="text-[20px] mb-4"><strong>{{$lang['11'] }}</strong></p>
                                    <table class="w-full">
                                        <tr>
                                            <td width="60%" class="border-b py-2">{{ $lang['8'] }}</td>
                                            <td class="border-b py-2">{{ round($width * 25.4, 2) }} mm</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['8'] }}</td>
                                            <td class="border-b py-2">{{ round($width * 2.54, 2) }} cm</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['8'] }}</td>
                                            <td class="border-b py-2">{{ round($width / 12, 4) }} ft</td>
                                        </tr>
                                        <tr class="h-4"></tr>
                                        <tr>
                                            <td width="60%" class="border-b py-2">{{ $lang['9'] }}</td>
                                            <td class="border-b py-2">{{ round($lenght * 25.4, 2) }} mm</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['9'] }}</td>
                                            <td class="border-b py-2">{{ round($lenght * 2.54, 2) }} cm</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['9'] }}</td>
                                            <td class="border-b py-2">{{ round($lenght / 12, 4) }} ft</td>
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
