<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    {{-- Gender --}}
                    <div class="space-y-2 relative">
                        <label for="gender" class="label">{{ $lang['gender'] }}:</label>
                        <select wire:model.live="gender" id="gender" class="input">
                            <option value="Male">{!! $lang['male'] !!}</option>
                            <option value="Female">{!! $lang['female'] !!}</option>
                        </select>
                    </div>

                    {{-- Height --}}
                    <div class="space-y-2" x-data="{ unit_h: @entangle('unit_h') }">
                        <label class="label">{!! $lang['height'] !!}:</label>
                        
                        <div class="flex space-x-2" x-show="unit_h === 'ft/in'" x-cloak>
                            <div class="w-1/2">
                                <input type="number" step="any" wire:model.live="height_ft" id="height_ft" class="input" placeholder="ft" />
                            </div>
                            <div class="w-1/2 relative" x-data="{ open: false }">
                                <input type="number" step="any" wire:model.live="height_in" id="height_in" class="input" placeholder="in" />
                                <span class="absolute right-3 top-4 cursor-pointer text-sm underline" @click="open = !open">
                                    <span x-text="unit_h"></span> ▾
                                </span>
                                <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p @click="$wire.set('unit_h', 'ft/in'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">feet / inches (ft/in)</p>
                                    <p @click="$wire.set('unit_h', 'cm'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">centimeters (cm)</p>
                                </div>
                            </div>
                        </div>

                        <div class="relative" x-show="unit_h === 'cm'" x-cloak x-data="{ open: false }">
                            <input type="number" step="any" wire:model.live="height_cm" id="height_cm" class="input" placeholder="cm" />
                            <span class="absolute right-3 top-4 cursor-pointer text-sm underline" @click="open = !open">
                                <span x-text="unit_h"></span> ▾
                            </span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                <p @click="$wire.set('unit_h', 'ft/in'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">feet / inches (ft/in)</p>
                                <p @click="$wire.set('unit_h', 'cm'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">centimeters (cm)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Weight --}}
                    <div class="space-y-2">
                        <label for="weight" class="label">{{ $lang['weight'] }}:</label>
                        <div class="relative w-auto" x-data="{ open: false, unit: @entangle('unit') }">
                            <input type="number" step="any" wire:model.live="weight" id="weight" class="input" placeholder="00" />
                            <span class="absolute right-3 top-4 cursor-pointer text-sm underline" @click="open = !open">
                                <span x-text="unit"></span> ▾
                            </span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                <p @click="$wire.set('unit', 'lbs'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">pounds (lbs)</p>
                                <p @click="$wire.set('unit', 'kg'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">kilograms (kg)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Formula --}}
                    <div class="space-y-2">
                        <label for="formula" class="label">{!! $lang['formula'] !!}:</label>
                        <select wire:model.live="formula" id="formula" class="input">
                            <option value="Boer">Boer</option>
                            <option value="James">James</option>
                            <option value="Hume">Hume</option>
                            <option value="Peters">Peters ({!! $lang['1'] !!})</option>
                        </select>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full p-3 rounded-lg mt-3">
                            <div class="w-full  mt-2">
                                <div class="bg-[#F6FAFC] text-center border rounded-lg p-4">
                                    <p class="text-lg font-semibold">{{ $lang['2'] }}</p>
                                    <div class="mt-2">
                                        <span class="text-blue-700 text-lg font-bold">{{ $lang['3'] }}:</span>
                                        <span class="text-green-700 text-2xl font-bold ml-2">{{ $detail['ans'] }} {{ $unit }}</span>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col lg:flex-row items-center justify-between bg-[#F6FAFC] text-center border rounded-lg p-4 mt-4 gap-4">
                                    <div class="w-full lg:w-1/2">
                                        {{ $lang['3'] }} % <strong class="text-blue-700 text-xl ml-2">{{ $detail['ans_per'] }}%</strong>
                                    </div>
                                    <div class="hidden lg:block border-r h-8"></div>
                                    <div class="w-full lg:w-1/2">
                                        {{ $lang['body_fat'] }} % <strong class="text-blue-700 text-xl ml-2">{{ round(100 - $detail['ans_per'], 2) }}%</strong>
                                    </div>
                                </div>

                                <p class="text-lg font-bold my-6">{{ $lang['text'] }}</p>
                                
                                <div class="w-full overflow-auto mt-2 border rounded-lg">
                                    <table class="w-full text-left" cellspacing="0">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="text-blue-700 py-3 px-4 font-semibold">{{ $lang['formula'] }}</th>
                                                <th class="text-blue-700 py-3 px-4 font-semibold">{{ $lang['3'] }}</th>
                                                <th class="text-blue-700 py-3 px-4 font-semibold">{{ $lang['body_fat'] }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="{{ $formula == 'Boer' ? 'bg-[#2845F5] text-white' : '' }}">
                                                <td class="border-b py-3 px-4">Boer</td>
                                                <td class="border-b py-3 px-4">
                                                    {!! $detail['Boer'] != '' ? $detail['Boer'] . ' <sub class="'.($formula == 'Boer' ? 'text-white' : 'text-gray-500').'">(' . $detail['Boer_per'] . '%)</sub>' : '0.0kg' !!}
                                                </td>
                                                <td class="border-b py-3 px-4">{{ $detail['Boer_per'] != '' ? (100 - $detail['Boer_per']) . '%' : '0.0%' }}</td>
                                            </tr>
                                            <tr class="{{ $formula == 'James' ? 'bg-[#2845F5] text-white' : '' }}">
                                                <td class="border-b py-3 px-4">James</td>
                                                <td class="border-b py-3 px-4">
                                                    {!! $detail['James'] != '' ? $detail['James'] . ' <sub class="'.($formula == 'James' ? 'text-white' : 'text-gray-500').'">(' . $detail['James_per'] . '%)</sub>' : '0.0kg' !!}
                                                </td>
                                                <td class="border-b py-3 px-4">{{ $detail['James_per'] != '' ? (100 - $detail['James_per']) . '%' : '0.0%' }}</td>
                                            </tr>
                                            <tr class="{{ $formula == 'Hume' ? 'bg-[#2845F5] text-white' : '' }}">
                                                <td class="border-b py-3 px-4">Hume</td>
                                                <td class="border-b py-3 px-4">
                                                    {!! $detail['Hume'] != '' ? $detail['Hume'] . ' <sub class="'.($formula == 'Hume' ? 'text-white' : 'text-gray-500').'">(' . $detail['Hume_per'] . '%)</sub>' : '0.0kg' !!}
                                                </td>
                                                <td class="border-b py-3 px-4">{{ $detail['Hume_per'] != '' ? (100 - $detail['Hume_per']) . '%' : '0.0%' }}</td>
                                            </tr>
                                            <tr class="{{ $formula == 'Peters' ? 'bg-[#2845F5] text-white' : '' }}">
                                                <td class="py-3 px-4">Peters ({!! $lang['1'] !!})</td>
                                                <td class="py-3 px-4">
                                                    {!! $detail['Peters'] != '' ? $detail['Peters'] . ' <sub class="'.($formula == 'Peters' ? 'text-white' : 'text-gray-500').'">(' . $detail['Peters_per'] . '%)</sub>' : '0.0kg' !!}
                                                </td>
                                                <td class="py-3 px-4">{{ $detail['Peters_per'] != '' ? (100 - $detail['Peters_per']) . '%' : '0.0%' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
