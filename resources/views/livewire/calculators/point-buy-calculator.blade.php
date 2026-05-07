<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">

                    {{-- Point Buy Type --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="choice" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="choice" id="choice" class="input">
                                <option value="1">{{ $lang['2'] }}</option>
                                <option value="2">{{ $lang['3'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Racial Choice --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="racial_choice" class="label">{{ $lang['4'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="racial_choice" id="racial_choice" class="input">
                                @php
                                    $raceNames = [$lang[5],$lang[6]." (".$lang[7].")","Elf (".$lang[8].")",$lang[9]." (".$lang[10].")",$lang[11]."-Elf",$lang[11]."-Orc",$lang[12]." (".$lang[13].")",$lang[14],$lang[15],$lang[16],$lang[17],$lang[18],$lang[19],$lang[20],$lang[21],$lang[22],$lang[23],$lang[24],$lang[25],$lang[26],$lang[12],$lang[27],$lang[28],$lang[29],$lang[30],$lang[31],$lang[32],$lang[33],$lang[34],$lang[35],$lang[36],$lang[37],$lang[38],$lang[39],$lang[40]];
                                    $raceVals = ["2.0.0.0.0.1","0.0.2.0.1.0","0.2.0.1.0.0","0.0.1.0.2.0","0.0.0.0.0.2","2.0.1.0.0.0","0.2.0.0.0.1","1.1.1.1.1.1","0.0.0.1.0.2","0.2.0.0.0.1","0.0.0.0.0.2","2.1.0.0.0.0","2.0.0.0.1.0","1.0.0.0.2.0","0.0.2.0.0.0","0.0.0.1.0.0","0.0.0.2.0.0","0.2.1.0.0.0","2.0.1.0.0.0","0.2.1.0.0.0","0.2.0.0.0.0","0.0.2.1.0.0","0.0.0.0.2.1","0.2.0.0.1.0","0.2.0.0.0.0","1.0.2.0.0.0","0.0.2.0.1.0","2.1.0.0.0.0","0.0.2.0.1.0","2.0.1.0.0.0","0.1.0.0.0.2","0.2.0.0.0.1","2.0.0.0.1.0","1.0.1.0.0.1","39"];
                                @endphp
                                @foreach($raceVals as $idx => $val)
                                    <option value="{{ $val }}">{{ $raceNames[$idx] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Customize Section --}}
                    @if ($choice == '2')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-4 md:col-span-4 lg:col-span-4">
                                    <label for="points_budget" class="label">{{ $lang[41] }}:</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" wire:model.live="points_budget" id="points_budget" class="input" />
                                    </div>
                                </div>
                                <div class="col-span-4 md:col-span-4 lg:col-span-4">
                                    <label for="smallest_score" class="label">{{ $lang[42] }}:</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" wire:model.live="smallest_score" id="smallest_score" class="input" />
                                    </div>
                                </div>
                                <div class="col-span-4 md:col-span-4 lg:col-span-4">
                                    <label for="largest_score" class="label">{{ $lang[43] }}:</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" wire:model.live="largest_score" id="largest_score" class="input" />
                                    </div>
                                </div>
                                {{-- Cost settings s1-s16 --}}
                                @for ($i = 1; $i <= 16; $i++)
                                    <div class="col-span-4 md:col-span-3 lg:col-span-3">
                                        <label for="s{{ $i }}" class="label">{{ $i + 2 }}:</label>
                                        <div class="w-full py-2 relative">
                                            <input type="number" step="any" wire:model.live="s{{ $i }}" id="s{{ $i }}" class="input" />
                                            <span class="text-blue input_unit">{{ $lang[44] }}</span>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    @endif

                    {{-- Base Ability Scores --}}
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="strength" class="label">{{ $lang[46] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="strength" id="strength" class="input" />
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="dexerity" class="label">{{ $lang[47] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="dexerity" id="dexerity" class="input" />
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="intelligence" class="label">{{ $lang[48] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="intelligence" id="intelligence" class="input" />
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="wisdom" class="label">{{ $lang[49] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="wisdom" id="wisdom" class="input" />
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="charisma" class="label">{{ $lang[50] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="charisma" id="charisma" class="input" />
                        </div>
                    </div>
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="constitution" class="label">{{ $lang[51] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="constitution" id="constitution" class="input" />
                        </div>
                    </div>

                    {{-- Custom Racial Bonuses Section --}}
                    @if ($racial_choice == '39')
                        <div class="col-span-12">
                            <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                                <p class="col-span-12">{{ $lang[52] }}</p>
                                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                                    <label for="strength1" class="label">{{ $lang[46] }}:</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" wire:model.live="strength1" id="strength1" class="input" />
                                    </div>
                                </div>
                                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                                    <label for="dexerity1" class="label">{{ $lang[47] }}:</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" wire:model.live="dexerity1" id="dexerity1" class="input" />
                                    </div>
                                </div>
                                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                                    <label for="intelligence1" class="label">{{ $lang[48] }}:</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" wire:model.live="intelligence1" id="intelligence1" class="input" />
                                    </div>
                                </div>
                                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                                    <label for="wisdom1" class="label">{{ $lang[49] }}:</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" wire:model.live="wisdom1" id="wisdom1" class="input" />
                                    </div>
                                </div>
                                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                                    <label for="charisma1" class="label">{{ $lang[50] }}:</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" wire:model.live="charisma1" id="charisma1" class="input" />
                                    </div>
                                </div>
                                <div class="col-span-6 md:col-span-6 lg:col-span-6">
                                    <label for="constitution1" class="label">{{ $lang[51] }}:</label>
                                    <div class="w-full py-2">
                                        <input type="number" step="any" wire:model.live="constitution1" id="constitution1" class="input" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

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
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg">
                        <div class="w-full mt-3">
                            <div class="row">
                                <div class="w-full lg:w-[80%] text-[18px] overflow-auto">
                                    <table class="w-full">
                                        <thead>
                                            <th class="border-b py-2">{{ $lang[53] }}</th>
                                            <th class="border-b py-2">{{ $lang[54] }}</th>
                                            <th class="border-b py-2">{{ $lang[55] }}</th>
                                            <th class="border-b py-2">{{ $lang[56] }}</th>
                                            <th class="border-b py-2">{{ $lang[57] }}</th>
                                            <th class="border-b py-2">{{ $lang[58] }}</th>
                                        </thead>
                                            <tbody>
                                        @foreach ([['strength', 46], ['dexerity', 47], ['constitution', 51], ['intelligence', 48], ['wisdom', 49], ['charisma', 50]] as $item)
                                            @php
                                                $key = $item[0];
                                                $langIdx = $item[1];
                                                $base = $detail[$key];
                                                $racial = $detail[$key . '_racial_bonus'];
                                                $total = $base + $racial;
                                                $mod = floor(($total - 10) / 2);
                                                $cost = $detail[$key . '_value'];
                                            @endphp
                                            <tr>
                                                <td class="border-b py-2">{{ $lang[$langIdx] }}</td>
                                                <td class="border-b py-2">{{ $base }}</td>
                                                <td class="border-b py-2">+{{ $racial }}</td>
                                                <td class="border-b py-2">{{ $total }}</td>
                                                <td class="border-b py-2">{{ $mod }}</td>
                                                <td class="border-b py-2">{{ $cost }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
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
