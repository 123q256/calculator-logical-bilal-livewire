<div>
    <style>
        .tagsUnit { background-color: #2845F5 !important; color: white !important; }
        .text-blue { color: #2845F5; }
        .text-green { color: #10B981; }
        .font-s-14 { font-size: 14px; }
        .font-s-18 { font-size: 18px; }
        .font-s-20 { font-size: 20px; }
        .font-s-28 { font-size: 28px; }
        .input_unit {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6B7280;
            font-weight: 500;
            pointer-events: none;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">

                    <!-- Mode Selector Tabs -->
                    <div class="col-span-12">
                        <div class="lg:w-[40%] md:w-[60%] w-full mx-auto mt-2">
                            <div class="flex items-center bg-blue-50 border border-blue-200 text-center rounded-lg p-1">
                                <div class="w-1/2 px-1">
                                    <div wire:click="setTab('first')" 
                                         class="px-3 py-2 cursor-pointer rounded-md transition-all duration-300 hover_tags font-bold {{ $c_type == 'first' ? 'bg-[#2845F5] text-white' : 'bg-white text-gray-700 ' }}">
                                        Simple
                                    </div>
                                </div>
                                <div class="w-1/2 px-1">
                                    <div wire:click="setTab('second')" 
                                         class="px-3 py-2 cursor-pointer rounded-md transition-all duration-300 hover_tags font-bold {{ $c_type == 'second' ? 'bg-[#2845F5] text-white' : 'bg-white text-gray-700 ' }}">
                                        Advance
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sex Selection -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="font-s-14 ">{!! $lang['3'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="operations" class="input">
                                <option value="1">{{ $lang['4'] }}</option>
                                <option value="2">{{ $lang['5'] }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Age Input -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="font-s-14 ">{!! $lang['6'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="first" class="input" placeholder="00">
                            <span class=" input_unit">{{ $lang[26] }}</span>
                        </div>
                    </div>

                    <!-- Weight Input (with Fast Unit Selector) -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="font-s-14 ">{{ $lang['7'] }}:</label>
                        <div class="relative w-full mt-2" x-data="{ open: false }">
                            <input type="number" step="any" wire:model.live="second" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" 
                                   @click="open = !open">
                                {{ $s_units }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-36 mt-1 right-0 top-full" x-cloak>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('s_units', 'kg')">kilograms (kg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('s_units', 'lbs')">pounds (lbs)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('s_units', 'stone')">stone</p>
                            </div>
                        </div>
                    </div>

                    <!-- Creatinine Input (with Fast Unit Selector) -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="font-s-14 ">{{ $lang['9'] }}:</label>
                        <div class="relative w-full mt-2" x-data="{ open: false }">
                            <input type="number" step="any" wire:model.live="third" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-20" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" 
                                   @click="open = !open">
                                {{ $t_units }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 top-full" x-cloak>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('t_units', 'mg/dL')">mg/dL</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('t_units', 'μmol/L')">μmol/L</p>
                            </div>
                        </div>
                    </div>

                    <!-- Target AUC Input -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="font-s-14 ">{!! $lang['10'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="four" class="input" placeholder="00">
                            <span class=" input_unit">mg/ml/min</span>
                        </div>
                    </div>

                    <!-- Height Input (Advance Only) -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-show="$wire.c_type == 'second'" x-cloak>
                        <label class="font-s-14 ">{{ $lang['11'] }}:</label>
                        <div class="relative w-full mt-2" x-data="{ open: false }">
                            <input type="number" step="any" wire:model.live="five" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                            <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" 
                                   @click="open = !open">
                                {{ $f_units }} ▾
                            </label>
                            <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 top-full" x-cloak>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b" @click="open = false; $wire.setUnit('f_units', 'in')">inches (in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="open = false; $wire.setUnit('f_units', 'cm')">centimeters (cm)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 flex justify-center">
                @if ($type == 'calculator')
                    @include('inc.button')
                @endif
                @if ($type == 'widget')
                    @include('inc.widget-button')
                @endif
            </div>
        </div>
    </form>

    <!-- Result Section -->
    @isset($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full mt-2">
                            <!-- Simple Mode Results -->
                            @if($c_type == "first")
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="col-span-1 border-b md:border-b-0 md:border-r border-gray-200 pb-4 md:pb-0">
                                        <div class="text-center md:text-left">
                                            <p class="font-bold font-s-18 uppercase text-gray-600">GFR</p>
                                            <p class="mt-2"><strong class="text-green font-s-28">{{ round($detail['answer'], 3) }}</strong> <span class="text-green font-s-20">ml/min</span></p>
                                        </div>
                                    </div>
                                    <div class="col-span-1 border-b md:border-b-0 md:border-r border-gray-200 py-4 md:py-0 px-0 md:px-4">
                                        <div class="text-center md:text-left">
                                            <p class="font-bold font-s-18 uppercase text-gray-600">{{ $lang[24] }}</p>
                                            <p class="mt-2"><strong class="text-green font-s-28">{{ round($detail['car_dos'], 3) }}</strong> <span class="text-green font-s-20">mg</span></p>
                                        </div>
                                    </div>
                                    <div class="col-span-1 pt-4 md:pt-0 px-0 md:px-4">
                                        <div class="text-center md:text-left">
                                            <p class="font-bold font-s-18 uppercase text-gray-600">{{ $lang[25] }}</p>
                                            <p class="mt-2"><strong class="text-green font-s-28">{{ round($detail['max_dos'], 3) }}</strong> <span class="text-green font-s-20">mg</span></p>
                                        </div>
                                    </div>
                                </div>

                            <!-- Advance Mode Results -->
                            @else
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-b border-gray-100 pb-8">
                                    <div class="text-center md:text-left border-b md:border-b-0 md:border-r border-gray-100 pb-4 md:pb-0">
                                        <p class="font-bold font-s-18 text-gray-600">BSA ({{ $lang[27] }})</p>
                                        <p class="mt-2"><strong class="text-green font-s-28">{{ $detail['bsa'] }}</strong> <span class="text-green font-s-20">M²</span></p>
                                    </div>
                                    <div class="text-center md:text-left px-0 md:px-6">
                                        <p class="font-bold font-s-18 text-gray-600">{{ $lang[28] }} (IBW)</p>
                                        <p class="mt-2"><strong class="text-green font-s-28">{{ round($detail['ibw'], 1) }}</strong> <span class="text-green font-s-20">kg</span></p>
                                    </div>
                                    <div class="text-center md:text-left border-t border-gray-100 pt-6 border-b md:border-b-0 md:border-r border-gray-100 pb-4 md:pb-0">
                                        <p class="font-bold font-s-18 text-gray-600">{{ $lang[29] }} (ABW)</p>
                                        <p class="mt-2"><strong class="text-green font-s-28">{{ $detail['abw'] }}</strong> <span class="text-green font-s-20">kg</span></p>
                                    </div>
                                    <div class="text-center md:text-left border-t border-gray-100 pt-6 px-0 md:px-6">
                                        <p class="font-bold font-s-18 text-gray-600">{{ $lang[30] }} (Adjusted ABW)</p>
                                        <p class="mt-2"><strong class="text-green font-s-28">{{ $detail['abw_alt'] }}</strong> <span class="text-green font-s-20">kg</span></p>
                                    </div>
                                </div>

                                <div class="w-full mt-6 overflow-auto">
                                    <table class="w-full text-sm" cellspacing="0">
                                        <tr class="bg-blue-50">
                                            <th class=" text-start p-3 border-b">{{ $lang[31] }}</th>
                                            <th class=" text-center p-3 border-b">{{ $lang[32] }} (ml/min)</th>
                                            <th class=" text-center p-3 border-b">{{ $lang[33] }} (mg)</th>
                                        </tr>
                                        <tbody class="divide-y divide-gray-100">
                                            <tr>
                                                <td class="p-3">{{ $lang[34] }}</td>
                                                <td class="p-3 text-center">{{ round($detail['jell_ans1'], 1) }}</td>
                                                <td class="p-3 text-center font-bold text-green">{{ round($detail['jell_ans11']) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="p-3">{{ $lang[34] }} ({{ $lang[35] }} BSA)</td>
                                                <td class="p-3 text-center">{{ round($detail['jell_ans2'], 1) }}</td>
                                                <td class="p-3 text-center font-bold text-green">{{ round($detail['jell_ans22']) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="p-3">{{ $lang[36] }} ({{ $lang[37] }} IBW)</td>
                                                <td class="p-3 text-center">{{ round($detail['cg_ibw_ans'], 1) }}</td>
                                                <td class="p-3 text-center font-bold text-green">{{ round($detail['cg_ibw_ans2']) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="p-3">{{ $lang[36] }} ({{ $lang[38] }} WT)</td>
                                                <td class="p-3 text-center">{{ round($detail['cg_abw_ans'], 1) }}</td>
                                                <td class="p-3 text-center font-bold text-green">{{ round($detail['cg_abw_ans2']) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="p-3">{{ $lang[36] }} ({{ $lang[38] }} WT {{ $lang[39] }} EQ)</td>
                                                <td class="p-3 text-center">{{ round($detail['cg_abwalt_ans'], 1) }}</td>
                                                <td class="p-3 text-center font-bold text-green">{{ round($detail['cg_abwalt_ans2']) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="p-3 font-bold">{{ $lang[36] }} ({{ $lang[40] }})</td>
                                                <td class="p-3 text-center font-bold">{{ round($detail['cg_ac_ans'], 1) }}</td>
                                                <td class="p-3 text-center font-bold text-green">{{ round($detail['cg_ac_ans2']) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
