<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="mt-2 lg:w-[50%]">
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div wire:click="setTab('first')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $calc_type === 'first' ? 'tagsUnit' : '' }}">
                                {{ $lang['1'] }}
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div wire:click="setTab('second')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $calc_type === 'second' ? 'tagsUnit' : '' }}">
                                {{ $lang['2'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- First Input (Tread or Total Run) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="f_input" class="font-s-14 text-blue">
                            {{ $calc_type === 'first' ? $lang['3'] : $lang['2'] }}:
                        </label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                            <input type="number" wire:model.live="f_input" id="f_input" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="($wire.f_units) + ' ▾'"></label>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                @foreach (["cm","in"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('f_units', '{{ $name }}')" @click="open = false">{{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Second Input (Total Rise) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="s_input" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                            <input type="number" wire:model.live="s_input" id="s_input" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="($wire.s_units) + ' ▾'"></label>
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                @foreach (["cm","m","in","ft"] as $name)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('s_units', '{{ $name }}')" @click="open = false">{{ $name }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Rise Selection --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="rise" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="rise" id="rise" class="input">
                                <option value="1">{{ $lang['6'] }} ({{ $lang['7'] }})</option>
                                <option value="2">{{ $lang['8'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Third Input (Riser Height or Number of Stairs) --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="t_input" class="font-s-14 text-blue">
                            {{ $rise === '1' ? $lang['9'] . ' (' . $lang['7'] . ')' : $lang['23'] }}:
                        </label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                            <input type="number" wire:model.live="t_input" id="t_input" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            @if ($rise === '1')
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="($wire.t_units) + ' ▾'"></label>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                    @foreach (["cm","in"] as $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('t_units', '{{ $name }}')" @click="open = false">{{ $name }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Tread Selection --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="tread" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="tread" id="tread" class="input">
                                <option value="1">{{ $lang['11'] }}</option>
                                <option value="2">{{ $lang['12'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Tread Thickness --}}
                    @if ($tread === '2')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="tread_input" class="font-s-14 text-blue">{{ $lang['13'] }}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                                <input type="number" wire:model.live="tread_input" id="tread_input" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="($wire.tread_units) + ' ▾'"></label>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                    @foreach (["cm","in"] as $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('tread_units', '{{ $name }}')" @click="open = false">{{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Headroom Selection --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="headroom" class="font-s-14 text-blue">{{ $lang['14'] }}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="headroom" id="headroom" class="input">
                                <option value="1">{{ $lang['15'] }}</option>
                                <option value="2">{{ $lang['16'] }}</option>
                            </select>
                        </div>
                    </div>

                    @if ($headroom === '2')
                        {{-- Headroom Requirements --}}
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="h_req" class="font-s-14 text-blue">{{ $lang['17'] }}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                                <input type="number" wire:model.live="h_req" id="h_req" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="($wire.hr_units) + ' ▾'"></label>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                    @foreach (["cm","m","in","ft"] as $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('hr_units', '{{ $name }}')" @click="open = false">{{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Floor Thickness --}}
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="f_thickness" class="font-s-14 text-blue">{{ $lang['18'] }}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                                <input type="number" wire:model.live="f_thickness" id="f_thickness" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="($wire.ft_units) + ' ▾'"></label>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                    @foreach (["cm","m","in","ft"] as $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('ft_units', '{{ $name }}')" @click="open = false">{{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Floor Opening --}}
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="f_opening" class="font-s-14 text-blue">{{ $lang['19'] }}:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }" @click.away="open = false">
                                <input type="number" wire:model.live="f_opening" id="f_opening" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open" x-text="($wire.fo_units) + ' ▾'"></label>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-show="open" x-cloak>
                                    @foreach (["cm","m","in","ft"] as $name)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('fo_units', '{{ $name }}')" @click="open = false">{{ $name }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Mount Selection --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="mount" class="font-s-14 text-blue">{{ $lang['20'] }}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="mount" id="mount" class="input">
                                <option value="1">{{ $lang['21'] }}</option>
                                <option value="2">{{ $lang['22'] }}</option>
                            </select>
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
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="w-full md:w-[80%] lg:w-[80%] lg:text-[18px] md:text-[18px] text-[14px]">
                                    <table class="highlight striped div_center">
                                        @if (!empty($detail['inch']))
                                            <tr>
                                                <td width="50%" class="border-b py-2"><strong>{{ $lang[5] }}</strong></td>
                                                <td class="border-b py-2">{{ $detail['inch'] . " " . $lang[29] . " or " . $detail['inch'] * 2.54 . " cm" }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['run_ans']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[3] }}</strong></td>
                                                <td class="border-b py-2">{{ $detail['run_ans'] . " " . $lang[29] . " or " . $detail['run_ans'] * 2.54 . " cm" }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['step_ans']))
                                            <tr>
                                                <td class="border-b py-2"><strong>1st {{ $lang[7] }}</strong></td>
                                                <td class="border-b py-2">{{ $detail['step_ans'] . " " . $lang[29] . " or " . $detail['step_ans'] * 2.54 . " cm" }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['total_run_ans']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[2] }}</strong></td>
                                                <td class="border-b py-2">{{ $detail['total_run_ans'] . " " . $lang[29] . " or " . $detail['total_run_ans'] * 2.54 . " cm" }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['stair_ans']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[23] }}</strong></td>
                                                <td class="border-b py-2">{{ $detail['stair_ans'] }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['mount_ans']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[24] }}</strong></td>
                                                <td class="border-b py-2">{{ $detail['mount_ans'] . " " . $lang[29] . " or " . $detail['mount_ans'] * 2.54 . " cm" }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['str']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[25] }}</strong></td>
                                                <td class="border-b py-2">{{ $detail['str'] . " " . $lang[29] . " or " . $detail['str'] * 2.54 . " cm" }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['angle_ans']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[26] }}</strong></td>
                                                <td class="border-b py-2">{{ $detail['angle_ans'] . "°" . " or " . $detail['angle_ans'] * 0.017 . " rad" }}</td>
                                            </tr>
                                        @endif
                                        @if (!empty($detail['answ']))
                                            <tr>
                                                <td class="border-b py-2"><strong>{{ $lang[14] }}</strong></td>
                                                <td class="border-b py-2">{{ $detail['answ'] . " " . $lang[29] . " or " . $detail['answ'] * 2.54 . " cm" }}</td>
                                            </tr>
                                        @endif
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
