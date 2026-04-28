<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-4">
                    {{-- Mode: Single or Multiple --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="selection" class="label">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="selection" class="input" id="selection">
                                <option value="1">{{ $lang['2'] }}</option>
                                <option value="2">{{ $lang['3'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Solve For (Only for Single Charge) --}}
                    @if ($selection == '1')
                        <div class="col-span-12 md:col-span-6">
                            <label for="selection3" class="label">{{ $lang['4'] }}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="selection3" class="input" id="selection3">
                                    <option value="1">{{ $lang['5'] }}</option>
                                    <option value="2">{{ $lang['6'] }}</option>
                                    <option value="3">{{ $lang['7'] }}</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    {{-- Relative Permittivity --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="per" class="label">{{ $lang[8] }}:</label>
                        <div class="w-full py-2">
                            <input type="text" inputmode="decimal" wire:model.live="per" id="per" class="input" placeholder="00" />
                        </div>
                    </div>

                    {{-- Single Charge Inputs --}}
                    @if ($selection == '1')
                        {{-- Charge (q) --}}
                        @if ($selection3 == '1' || $selection3 == '2')
                            <div class="col-span-12 md:col-span-6">
                                <label for="charge" class="label">{{ $lang['7'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="text" inputmode="decimal" wire:model.live="charge" id="charge" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('c_unit')">
                                        {{ $c_unit }} ▾
                                    </label>
                                    @if ($openDropdown === 'c_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                            @foreach (['PC', 'NC', 'μC', 'mC', 'C', 'e'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('c_unit', null, '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Distance (r) --}}
                        @if ($selection3 == '1' || $selection3 == '3')
                            <div class="col-span-12 md:col-span-6">
                                <label for="distance" class="label">{{ $lang['6'] }}</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="text" inputmode="decimal" wire:model.live="distance" id="distance" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('d_unit')">
                                        {{ $d_unit }} ▾
                                    </label>
                                    @if ($openDropdown === 'd_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                            @foreach (['nm', 'μm', 'mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('d_unit', null, '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Electric Field (E) --}}
                        @if ($selection3 == '2' || $selection3 == '3')
                            <div class="col-span-12 md:col-span-6">
                                <label for="electric_field" class="label">{{ $lang['5'] }}</label>
                                <div class="w-full py-2 relative">
                                    <input type="text" inputmode="decimal" wire:model.live="electric_field" id="electric_field" class="input" placeholder="00" />
                                    <span class="input_unit">N/C</span>
                                </div>
                            </div>
                        @endif
                    @endif

                    {{-- Multiple Charges Inputs --}}
                    @if ($selection == '2')
                        <div class="col-span-12 space-y-4">
                            @for ($i = 0; $i < $num_charges; $i++)
                                <div class="grid grid-cols-12 gap-4 p-4 border rounded-lg bg-gray-50/50">
                                    <div class="col-span-12 mb-2">
                                        <strong class="text-blue">Charge {{ $i + 1 }}</strong>
                                    </div>
                                    {{-- Charge i --}}
                                    <div class="col-span-12 md:col-span-6">
                                        <label class="label">Charge (q{{ $i + 1 }})</label>
                                        <div class="relative w-full mt-[7px]">
                                            <input type="text" inputmode="decimal" wire:model.live="charge1.{{ $i }}" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('charge_unit_{{ $i }}')">
                                                {{ $charge_unit[$i] }} ▾
                                            </label>
                                            @if ($openDropdown === "charge_unit_{$i}")
                                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                    @foreach (['PC', 'NC', 'μC', 'mC', 'C', 'e'] as $u)
                                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('charge_unit', {{ $i }}, '{{ $u }}')">{{ $u }}</p>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    {{-- Distance i --}}
                                    <div class="col-span-12 md:col-span-6">
                                        <label class="label">Distance (r{{ $i + 1 }})</label>
                                        <div class="relative w-full mt-[7px]">
                                            <input type="text" inputmode="decimal" wire:model.live="distance1.{{ $i }}" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                            <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('distance_unit_{{ $i }}')">
                                                {{ $distance_unit[$i] }} ▾
                                            </label>
                                            @if ($openDropdown === "distance_unit_{$i}")
                                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                                    @foreach (['nm', 'μm', 'mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'] as $u)
                                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('distance_unit', {{ $i }}, '{{ $u }}')">{{ $u }}</p>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endfor
                            <div class="col-span-12 flex justify-start mt-2">
                                <button type="button" wire:click="addCharge" class="bg-[#2845F5] text-white border rounded px-4 py-2 hover:bg-blue-700 transition-colors">
                                    <strong>+ {{ $lang[9] }}</strong>
                                </button>
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
                        <div class="w-full justify-center flex mt-3">
                            <div class="w-full">
                                {{-- Electric Field Result --}}
                                @if (isset($detail['answer']) || isset($detail['answer3']))
                                    <div class="text-center overflow-auto">
                                        <p class="text-[20px]"><strong>{{ $lang[5] }}</strong></p>
                                        <p class="lg:text-[22px] md:text-[22px] text-[16px] bg-[#2845F5] px-5 py-3 my-3 rounded-lg">
                                            <strong class="text-white">{{ number_format($detail['answer'] ?? $detail['answer3'], 4) }} (N/C)</strong>
                                        </p>
                                    </div>
                                @endif
                                {{-- Distance Result --}}
                                @if (isset($detail['answer1']))
                                    <div class="text-center overflow-auto">
                                        <p class="text-[20px]"><strong>{{ $lang[6] }}</strong></p>
                                        <p class="lg:text-[22px] md:text-[22px] text-[16px] bg-[#2845F5] px-5 py-3 my-3 rounded-lg">
                                            <strong class="text-white">{{ number_format($detail['answer1'], 4) }} (m)</strong>
                                        </p>
                                    </div>
                                @endif
                                {{-- Charge Result --}}
                                @if (isset($detail['answer2']))
                                    <div class="text-center overflow-auto">
                                        <p class="text-[20px]"><strong>{{ $lang[7] }}</strong></p>
                                        <p class="lg:text-[22px] md:text-[22px] text-[16px] bg-[#2845F5] px-5 py-3 my-3 rounded-lg">
                                            <strong class="text-white">{{ number_format($detail['answer2'], 4) }} (C)</strong>
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
