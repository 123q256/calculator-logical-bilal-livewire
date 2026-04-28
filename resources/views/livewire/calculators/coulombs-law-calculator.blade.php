<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[85%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- Choose Case --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="choose" class="label">{{ $lang['1'] ?? 'Choose Case' }}</label>
                        <select wire:model.live="choose" id="choose" class="input">
                            <option value="1">{{ $lang['2'] ?? 'Standard (q1 = q2)' }}</option>
                            <option value="2">{{ $lang['3'] ?? 'General (q1 ≠ q2)' }}</option>
                        </select>
                    </div>

                    {{-- Selection based on Case --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="selection" class="label">{{ $lang['4'] ?? 'I want to find' }}</label>
                        @if ($choose == '1')
                            <select wire:model.live="selection2" id="selection2" class="input">
                                <option value="1">{{ $lang['5'] ?? 'Force' }} (F)</option>
                                <option value="2">{{ $lang['6'] ?? 'Charges' }} (q₁ & q₂)</option>
                                <option value="3">{{ $lang['7'] ?? 'Distance' }} (r)</option>
                            </select>
                        @else
                            <select wire:model.live="selection1" id="selection1" class="input">
                                <option value="1">{{ $lang['5'] ?? 'Force' }} (F)</option>
                                <option value="2">{{ $lang['6'] ?? 'Charge' }} (q1)</option>
                                <option value="3">{{ $lang['7'] ?? 'Charge' }} (q2)</option>
                                <option value="4">{{ $lang['8'] ?? 'Distance' }} (r)</option>
                            </select>
                        @endif
                    </div>

                    {{-- Charge 3 (q1 & q2) - Only for Choose 1 --}}
                    @if ($choose == '1' && in_array($selection2, ['1', '3']))
                        <div class="col-span-12 md:col-span-6">
                            <label for="charge_three" class="label">{{ $lang['6'] ?? 'Charges' }} (q₁ & q₂)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="charge_three" id="charge_three" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('charge_three_unit')">
                                    {{ $charge_three_unit }} ▾
                                </label>
                                @if ($openDropdown === 'charge_three_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                        @foreach (['pC', 'nC', 'μC', 'mC', 'C', 'e', 'Ah', 'mAh'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('charge_three_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Charge 1 & 2 - Only for Choose 2 --}}
                    @if ($choose == '2')
                        @if (in_array($selection1, ['1', '3', '4']))
                            <div class="col-span-12 md:col-span-6">
                                <label for="charge_one" class="label">{{ $lang['10'] ?? 'Charge' }} (q1)</label>
                                <div class="relative">
                                    <input type="number" step="any" wire:model.live="charge_one" id="charge_one" class="input" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('charge_one_unit')">
                                        {{ $charge_one_unit }} ▾
                                    </label>
                                    @if ($openDropdown === 'charge_one_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                            @foreach (['pC', 'nC', 'μC', 'mC', 'C', 'e', 'Ah', 'mAh'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('charge_one_unit', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if (in_array($selection1, ['1', '2', '4']))
                            <div class="col-span-12 md:col-span-6">
                                <label for="charge_two" class="label">{{ $lang['11'] ?? 'Charge' }} (q2)</label>
                                <div class="relative">
                                    <input type="number" step="any" wire:model.live="charge_two" id="charge_two" class="input" placeholder="00" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('charge_two_unit')">
                                        {{ $charge_two_unit }} ▾
                                    </label>
                                    @if ($openDropdown === 'charge_two_unit')
                                        <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                            @foreach (['pC', 'nC', 'μC', 'mC', 'C', 'e', 'Ah', 'mAh'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('charge_two_unit', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endif

                    {{-- Distance (r) --}}
                    @if (($choose == '1' && in_array($selection2, ['1', '2'])) || ($choose == '2' && in_array($selection1, ['1', '2', '3'])))
                        <div class="col-span-12 md:col-span-6">
                            <label for="distance" class="label">{{ $lang['8'] ?? 'Distance' }} (r)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="distance" id="distance" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('distance_unit')">
                                    {{ $distance_unit }} ▾
                                </label>
                                @if ($openDropdown === 'distance_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                        @foreach (['nm', 'μm', 'mm', 'cm', 'm', 'km', 'in', 'ft', 'yd'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('distance_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Force (F) --}}
                    @if (($choose == '1' && in_array($selection2, ['2', '3'])) || ($choose == '2' && in_array($selection1, ['2', '3', '4'])))
                        <div class="col-span-12 md:col-span-6">
                            <label for="force" class="label">{{ $lang['5'] ?? 'Force' }} (F)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="force" id="force" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('force_unit')">
                                    {{ $force_unit }} ▾
                                </label>
                                @if ($openDropdown === 'force_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                        @foreach (['mN', 'N', 'kN', 'MN', 'GN', 'TN', 'pdl', 'lbf'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('force_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Constant (Ke) --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="constant" class="label">{{ $lang['9'] ?? 'Coulomb Constant' }} (Ke)</label>
                        <div class="relative">
                            <input type="number" step="any" wire:model.live="constant" id="constant" class="input" />
                            <span class="absolute right-6 top-4 text-sm text-gray-500">x10⁹ N⋅m²/C²</span>
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
    </form>

    <hr>

    @isset($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
            <div class="text-left space-y-6 overflow-auto">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="w-full mt-2">
                    <div class="w-full md:w-[100%] overflow-auto">
                        {{-- Force Result --}}
                        @if (isset($detail['force']) && $detail['force'] != '')
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[5] ?? 'Force' }}</strong></td>
                                    <td class="py-2 border-b">{{ $detail['force'] }} (N)</td>
                                </tr>
                            </table>
                            <p class="mt-6 mb-2 font-bold text-lg">{{ $lang['12'] ?? 'Results in other units:' }}</p>
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="40%">{{ $lang[5] ?? 'Force' }}</td>
                                    <td class="py-2 border-b">{{ $detail['force']*0.001 }} (Kilo Newton) kN</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang[5] ?? 'Force' }}</td>
                                    <td class="py-2 border-b">{{ $detail['force']*1000 }} (Milli Newton) mN</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang[5] ?? 'Force' }}</td>
                                    <td class="py-2 border-b">{{ $detail['force']*0.224809 }} (pounds-force) lbf</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang[5] ?? 'Force' }}</td>
                                    <td class="py-2 border-b">{{ $detail['force']*0.000001 }} (Mega Newton) MN</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang[5] ?? 'Force' }}</td>
                                    <td class="py-2 border-b">{{ $detail['force']*1e-9 }} (Giga Newton) GN</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang[5] ?? 'Force' }}</td>
                                    <td class="py-2 border-b">{{ $detail['force']*1e-12 }} (Tera Newton) TN</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang[5] ?? 'Force' }}</td>
                                    <td class="py-2 border-b">{{ $detail['force']*7.23301 }} (poundals) pdl</td>
                                </tr>
                            </table>
                        @endif

                        {{-- Charge Result (Identical Charges) --}}
                        @if (isset($detail['charging']) && $detail['charging'] != '')
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang['6'] ?? 'Charges' }} (q1 & q2)</strong></td>
                                    <td class="py-2 border-b">{{ $detail['charging'] }} (C)</td>
                                </tr>
                            </table>
                            <p class="mt-6 mb-2 font-bold text-lg">Results in other units:</p>
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="40%">{{ $lang['6'] ?? 'Charge' }}</td>
                                    <td class="py-2 border-b">{{ $detail['charging']*1e9 }} (nanocoulombs) nC</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['6'] ?? 'Charge' }}</td>
                                    <td class="py-2 border-b">{{ $detail['charging']*1e12 }} (picocoulombs) pC</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['6'] ?? 'Charge' }}</td>
                                    <td class="py-2 border-b">{{ $detail['charging']*1000 }} (millicoulombs) mC</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['6'] ?? 'Charge' }}</td>
                                    <td class="py-2 border-b">{{ $detail['charging']*0.000277778 }} (ampere hours) Ah</td>
                                </tr>
                            </table>
                        @endif

                        {{-- Distance Result --}}
                        @if (isset($detail['distancing']) && $detail['distancing'] != '')
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang['8'] ?? 'Distance' }} (r)</strong></td>
                                    <td class="py-2 border-b">{{ $detail['distancing'] }} (m)</td>
                                </tr>
                            </table>
                            <p class="mt-6 mb-2 font-bold text-lg">Results in other units:</p>
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="40%">{{ $lang['8'] ?? 'Distance' }}</td>
                                    <td class="py-2 border-b">{{ $detail['distancing']*1e9 }} (nanometers) nm</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['8'] ?? 'Distance' }}</td>
                                    <td class="py-2 border-b">{{ $detail['distancing']*1e6 }} (micrometers) μm</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['8'] ?? 'Distance' }}</td>
                                    <td class="py-2 border-b">{{ $detail['distancing']*1000 }} (millimeters) mm</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['8'] ?? 'Distance' }}</td>
                                    <td class="py-2 border-b">{{ $detail['distancing']*100 }} (centimeters) cm</td>
                                </tr>
                            </table>
                        @endif

                        {{-- General Case Charge Result --}}
                        @if (isset($detail['charge_one']))
                            @php $qLabel = ($detail['method'] == 1) ? 'q1' : 'q2'; @endphp
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang['6'] ?? 'Charge' }} ({{ $qLabel }})</strong></td>
                                    <td class="py-2 border-b">{{ $detail['charge_one'] }} (C)</td>
                                </tr>
                            </table>
                            <p class="mt-6 mb-2 font-bold text-lg">Results in other units:</p>
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="40%">{{ $lang['6'] ?? 'Charge' }} {{ $qLabel }}</td>
                                    <td class="py-2 border-b">{{ $detail['charge_one']*1e9 }} (nanocoulombs) nC</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['6'] ?? 'Charge' }} {{ $qLabel }}</td>
                                    <td class="py-2 border-b">{{ $detail['charge_one']*1e12 }} (picocoulombs) pC</td>
                                </tr>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
