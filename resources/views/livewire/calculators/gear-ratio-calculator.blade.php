<div>
    <style>
        .simple-input {
            border: 1px solid #d1d5db;
            padding: 0.5rem;
            border-radius: 0.5rem;
            width: 100%;
            outline: none;
        }
        .simple-input:focus {
            ring: 2px;
            ring-color: #3b82f6;
        }
        .unit-label-abs {
            position: absolute;
            cursor: pointer;
            font-size: 0.875rem;
            text-decoration: underline;
            right: 1.5rem;
            top: 1rem;
        }
        [x-cloak] { display: none !important; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-2 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto space-y-4">
                {{-- Mode Selection --}}
                <div class="flex items-center justify-center space-x-6 bg-blue-50 p-2 rounded-xl border border-blue-100">
                    <strong class="text-blue">{{ $lang[1] }}:</strong>
                    <label class="flex items-center cursor-pointer space-x-2">
                        <input type="radio" wire:model.live="type" value="first" class="w-4 h-4 text-blue-600">
                        <span class="text-sm font-medium">{{ $lang['2'] }}</span>
                    </label>
                    <label class="flex items-center cursor-pointer space-x-2">
                        <input type="radio" wire:model.live="type" value="second" class="w-4 h-4 text-blue-600">
                        <span class="text-sm font-medium">{{ $lang['3'] }}</span>
                    </label>
                </div>

                <div class="grid grid-cols-12 gap-2 mt-4">
                    @if($type == 'first')
                        {{-- Gear Ratio Mode --}}
                        <div class="col-span-12 md:col-span-6 space-y-2">
                            <label for="f_first" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                            <input type="number" step="any" wire:model="f_first" id="f_first" class="simple-input" placeholder="00" />
                        </div>
                        <div class="col-span-12 md:col-span-6 space-y-2">
                            <label for="f_second" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                            <input type="number" step="any" wire:model="f_second" id="f_second" class="simple-input" placeholder="00" />
                        </div>
                        <div class="col-span-12 md:col-span-6 space-y-2">
                            <label for="f_third" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                            <div class="relative w-full" x-data="{ open: false }">
                                <input type="number" step="any" wire:model="f_third" id="f_third" class="simple-input" />
                                <label @click="open = !open" class="unit-label-abs">{{ $ft_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                    @foreach(['rpm', 'rad/s', 'Hz'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.setUnit('ft_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 space-y-2">
                            <label for="f_four" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                            <div class="relative w-full" x-data="{ open: false }">
                                <input type="number" step="any" wire:model="f_four" id="f_four" class="simple-input" />
                                <label @click="open = !open" class="unit-label-abs">{{ $ff_unit }} ▾</label>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                    @foreach(['Nm', 'kg-cm', 'J/rad', 'ft-lb'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.setUnit('ff_unit', '{{ $u }}'); open = false">{{ $u }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Speed Calculator Mode --}}
                        <div class="col-span-12 space-y-2">
                            <label for="transmissions" class="font-s-14 text-blue">{{ $lang[8] }}:</label>
                            <select wire:model="transmissions" id="transmissions" class="simple-input bg-white">
                                @foreach(["Magnum XL 2.66 - .50","Magnum XL 2.97 - .63","Magnum 2.66 - .63","Magnum 2.97 - .50","Magnum-F 2.66 - .63","Magnum-F 2.97 - .63","Magnum-F 2.66 - .50","Magnum-F 2.97 - .50","T-5 2.95 - .63","TKO-500 3.27 - .68","TKO-600 2.87 - .64","TKO-600 2.87 - .82","TKX 3.27 - .72","TKX 2.87 - .81","TKX 2.87 - .68","GM Muncie 2.20 - 1.00","Ford Toploader 2.32 - 1.00","Ford Toploader 2.78 - 1.00","A-833 HEMI 4-Speed 2.44 - 1.00"] as $opt)
                                    <option value="{{ $opt }}">{{ $opt }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-12 md:col-span-6 space-y-2">
                            <label for="s_first" class="font-s-14 text-blue">{{ $lang['13'] }}:</label>
                            <input type="number" step="any" wire:model="s_first" id="s_first" class="simple-input" />
                        </div>
                        <div class="col-span-12 md:col-span-6 space-y-2">
                            <label for="s_second" class="font-s-14 text-blue">{{ $lang['14'] }}:</label>
                            <input type="number" step="any" wire:model="s_second" id="s_second" class="simple-input" />
                        </div>
                        <div class="col-span-12 md:col-span-6 space-y-2">
                            <label for="s_third" class="font-s-14 text-blue">{{ $lang['15'] }} (in):</label>
                            <input type="number" step="any" wire:model="s_third" id="s_third" class="simple-input" />
                        </div>
                        <div class="col-span-12 md:col-span-6 space-y-2">
                            <label for="s_four" class="font-s-14 text-blue">{{ $lang['16'] }} (mm):</label>
                            <input type="number" step="any" wire:model="s_four" id="s_four" class="simple-input" />
                        </div>
                        <div class="col-span-12 md:col-span-6 space-y-2">
                            <label for="s_five" class="font-s-14 text-blue">{{ $lang['17'] }} (in):</label>
                            <input type="number" step="any" wire:model="s_five" id="s_five" class="simple-input" />
                        </div>
                        <div class="col-span-12 md:col-span-6 space-y-2">
                            <label for="s_six" class="font-s-14 text-blue">{{ $lang['18'] }} (1-100):</label>
                            <input type="number" step="any" wire:model="s_six" id="s_six" class="simple-input" />
                        </div>
                    @endif
                </div>
            </div>

            @if ($type_calc == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        <hr>

        @if($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-2 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type_calc == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <p class="text-2xl font-bold text-blue mb-4 text-center">{{ $lang[19] }}</p>
                            
                            @if ($detail['type'] == "first")
                                <div class="w-full md:w-[80%] overflow-auto ">
                                    <table class="w-full text-left">
                                        <tbody class="divide-y divide-gray-100">
                                            <tr>
                                                <td class="text-blue font-medium p-2">{{ $lang[20] }}</td>
                                                <td class="p-2 font-bold text-lg">{{ round($detail['gear_ratio'], 2) }} :1</td>
                                            </tr>
                                            <tr>
                                                <td class="text-blue font-medium p-2">{{ $lang[21] }}</td>
                                                <td class="p-2 font-bold text-lg">{{ round($detail['mechanical'], 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-blue font-medium p-2">{{ $lang[22] }}</td>
                                                <td class="p-2 font-bold text-lg">{{ round($detail['output_rot'], 2) }} (rpm)</td>
                                            </tr>
                                            <tr>
                                                <td class="text-blue font-medium p-2">{{ $lang[23] }}</td>
                                                <td class="p-2 font-bold text-lg">{{ round($detail['output_tor'], 2) }} (Nm)</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="space-y-6">
                                    <div class="w-full md:w-[80%] overflow-auto">
                                        <table class="w-full text-left">
                                            <tbody class="divide-y ">
                                                <tr>
                                                    <td class="text-blue font-medium p-2">{{ $lang[24] }}</td>
                                                    <td class="p-2 font-bold text-lg">{{ round($detail['height'], 2) }} (in)</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-blue font-medium p-2">{{ $lang[25] }}</td>
                                                    <td class="p-2 font-bold text-lg">{{ round($detail['width'], 2) }} (in)</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="w-full overflow-x-auto ">
                                        <table class="w-full text-center divide-y divide-gray-200">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th class="p-3 text-blue font-bold text-sm">{{ $lang[26] }}</th>
                                                    <th class="p-3 text-blue font-bold text-sm">{{ $lang[27] }}</th>
                                                    <th class="p-3 text-blue font-bold text-sm">MPH</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-100 bg-white">
                                                @foreach([['1st', 1], ['2nd', 2], ['3rd', 3], ['4th', 4], ['5th', 5], ['6th', 6]] as $gear)
                                                    <tr>
                                                        <td class="p-3 text-sm font-medium">{{ $gear[0] }} {{ $lang[28] }}</td>
                                                        <td class="p-3 text-sm">{{ $detail['transratio'.$gear[1].'_value'] ?: '-' }}</td>
                                                        <td class="p-3 text-sm font-bold text-blue">{{ $detail['mph'.$gear[1].'_value'] ?: '-' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
