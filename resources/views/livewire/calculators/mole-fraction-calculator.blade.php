<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="w-full px-2 mb-2">
                    <p><strong class="text-blue">{{ $lang['note'] }}:</strong> {{ $lang['note_val'] }}</p>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="label my-3">{{ $lang['sol'] }}</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="x" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <button type="button" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('unit_x')">{{ $unit_x }} ▾</button>
                            @if ($openDropdown === 'unit_x')
                                <div wire:key="dropdown-x" class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_x', 'Mole')">{{ $lang['m_u'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_x', 'Gram')">{{ $lang['Gram'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_x', 'Millimole')">{{ $lang['mili'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_x', 'Kilomole')">{{ $lang['kilo'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_x', 'PoundMole')">{{ $lang['pound'] }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if ($unit_x === 'Gram')
                        <div class="space-y-2">
                            <label class="label my-2">{!! $lang['mass'] !!}:</label>
                            <input type="number" step="any" wire:model="divide_x" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                        </div>
                    @endif
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2 mt-2">
                        <label class="label my-3">{{ $lang['solv'] }}</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="y" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <button type="button" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('unit_y')">{{ $unit_y }} ▾</button>
                            @if ($openDropdown === 'unit_y')
                                <div wire:key="dropdown-y" class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_y', 'Mole')">{{ $lang['m_u'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_y', 'Gram')">{{ $lang['Gram'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_y', 'Millimole')">{{ $lang['mili'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_y', 'Kilomole')">{{ $lang['kilo'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_y', 'PoundMole')">{{ $lang['pound'] }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if ($unit_y === 'Gram')
                        <div class="space-y-2 mt-2">
                            <label class="label my-2">{!! $lang['mass'] !!}:</label>
                            <input type="number" step="any" wire:model="divide_y" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                        </div>
                    @endif
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2 mt-2">
                        <label class="label my-3">{{ $lang['solu'] }}</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="z" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <button type="button" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('unit_z')">{{ $unit_z }} ▾</button>
                            @if ($openDropdown === 'unit_z')
                                <div wire:key="dropdown-z" class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_z', 'Mole')">{{ $lang['m_u'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_z', 'Gram')">{{ $lang['Gram'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_z', 'Millimole')">{{ $lang['mili'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_z', 'Kilomole')">{{ $lang['kilo'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_z', 'PoundMole')">{{ $lang['pound'] }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if ($unit_z === 'Gram')
                        <div class="space-y-2 mt-2">
                            <label class="label my-2">{!! $lang['mass'] !!}:</label>
                            <input type="number" step="any" wire:model="divide_z" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                        </div>
                    @endif
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    <div class="space-y-2 mt-2">
                        <label class="label my-3">{{ $lang['mole'] }}</label>
                        <div class="relative w-full">
                            <input type="number" wire:model="a" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <button type="button" class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click="toggleDropdown('unit_a')">{{ $unit_a }} ▾</button>
                            @if ($openDropdown === 'unit_a')
                                <div wire:key="dropdown-a" class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_a', 'Mole')">{{ $lang['m_u'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_a', 'Gram')">{{ $lang['Gram'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_a', 'Millimole')">{{ $lang['mili'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_a', 'Kilomole')">{{ $lang['kilo'] }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit_a', 'PoundMole')">{{ $lang['pound'] }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if ($unit_a === 'Gram')
                        <div class="space-y-2 mt-2">
                            <label class="label my-2">{!! $lang['mass'] !!}:</label>
                            <input type="number" step="any" wire:model="divide_a" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                    <table class="w-full col-lg-7" cellspacing="0">
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['solute'] }}</td>
                                            <td class="border-b py-2"><strong>{{ $detail['Solute'] }} {{ $lang['m_u'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['solvent'] }}</td>
                                            <td class="border-b py-2"><strong>{{ $detail['Solvent'] }} {{ $lang['m_u'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['solu'] }}</td>
                                            <td class="border-b py-2"><strong>{{ $detail['sol'] }} {{ $lang['m_u'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">{{ $lang['mole'] }}</td>
                                            <td class="py-2"><strong>{{ $detail['mol'] }} {{ $lang['m_u'] }}</strong></td>
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
