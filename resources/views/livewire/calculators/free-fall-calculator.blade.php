<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">

                    {{-- Solve For --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="selection" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="selection" class="input" id="selection">
                                <option value="1">{{ $lang['2'] }}</option>
                                <option value="2">{{ $lang['3'] }}</option>
                                <option value="3">{{ $lang['4'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Acceleration (g) --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="acceleration" class="font-s-14 text-blue">{{ $lang['5'] }} (g)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="text" inputmode="decimal" wire:model.live="acceleration" id="acceleration" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('a_unit')">
                                {{ $a_unit }} ▾
                            </label>
                            @if ($openDropdown === 'a_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (['m/s²', 'g', 'ft/s²'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('a_unit', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Initial Velocity (v0) --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="velocity" class="font-s-14 text-blue">{{ $lang['6'] }} (v₀)</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="text" inputmode="decimal" wire:model.live="velocity" id="velocity" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('v_unit')">
                                {{ $v_unit }} ▾
                            </label>
                            @if ($openDropdown === 'v_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach (['m/s²', 'km/h', 'ft/s', 'mph', 'knots', 'km/s', 'mi/s', 'ft/min', 'm/min'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('v_unit', '{{ $u }}')">{{ $u }}</p>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Height (h) --}}
                    @if ($selection == '1')
                        <div class="col-span-12 md:col-span-6">
                            <label for="height" class="font-s-14 text-blue">{{ $lang['7'] }} (h)</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="text" inputmode="decimal" wire:model.live="height" id="height" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('h_unit')">
                                    {{ $h_unit }} ▾
                                </label>
                                @if ($openDropdown === 'h_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('h_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Time (t) --}}
                    @if ($selection == '2')
                        <div class="col-span-12 md:col-span-6">
                            <label for="time" class="font-s-14 text-blue">{{ $lang['8'] }} (t)</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="text" inputmode="decimal" wire:model.live="time" id="time" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('t_unit')">
                                    {{ $t_unit }} ▾
                                </label>
                                @if ($openDropdown === 't_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['sec', 'min', 'hrs'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('t_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Final Velocity (V) --}}
                    @if ($selection == '3')
                        <div class="col-span-12 md:col-span-6">
                            <label for="velocity_one" class="font-s-14 text-blue">{{ $lang['9'] }} (V)</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="text" inputmode="decimal" wire:model.live="velocity_one" id="velocity_one" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('v_one_unit')">
                                    {{ $v_one_unit }} ▾
                                </label>
                                @if ($openDropdown === 'v_one_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['m/s²', 'km/h', 'ft/s', 'mph', 'knots', 'km/s', 'mi/s', 'ft/min', 'm/min'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('v_one_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
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

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full font-s-18">
                                    @if (isset($detail['answer1']) && isset($detail['answer2']))
                                        <tr>
                                            <td class="py-2 border-b" width="35%"><strong>{{ $lang[10] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['answer1'], 4) }} (sec)</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="35%"><strong>{{ $lang[9] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['answer2'], 4) }} (m/s)</td>
                                        </tr>
                                    @elseif (isset($detail['answer3']) && isset($detail['answer4']))
                                        <tr>
                                            <td class="py-2 border-b" width="35%"><strong>{{ $lang[7] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['answer3'], 4) }} (m)</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="35%"><strong>{{ $lang[9] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['answer4'], 4) }} (m/s)</td>
                                        </tr>
                                    @elseif (isset($detail['answer5']) && isset($detail['answer6']))
                                        <tr>
                                            <td class="py-2 border-b" width="35%"><strong>{{ $lang[8] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['answer5'], 4) }} (sec)</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="35%"><strong>{{ $lang[7] }}</strong></td>
                                            <td class="py-2 border-b">{{ number_format($detail['answer6'], 4) }} (m)</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
