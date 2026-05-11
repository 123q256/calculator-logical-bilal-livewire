<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    {{-- Age --}}
                    <div class="space-y-2 relative">
                        <label for="age" class="label">{!! $lang['age_year'] !!}:</label>
                        <input type="number" step="any" wire:model.live="age" id="age" class="input" aria-label="age" placeholder="00" />
                    </div>

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
                        <label for="weight" class="label">{{ $lang['1'] ?? 'Weight' }}:</label>
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
                            <div class="w-full mt-2">
                                <div class="bg-[#F6FAFC] text-black text-center border rounded-lg p-4">
                                    <p class="text-lg font-semibold">{!! $lang['4'] !!}</p>
                                    <p class="text-3xl font-bold text-green-600 mt-2">{!! $detail['ans'] !!}</p>
                                </div>
                                
                                <div class="w-full overflow-auto mt-6">
                                    <table class="w-full text-left" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td class="border-b py-3 font-medium">{!! $lang['5'] !!}</td>
                                                <td class="border-b py-3 font-bold">{!! $detail['abw'] !!}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-3 font-medium">{!! $lang['6'] !!}</td>
                                                <td class="border-b py-3 font-bold">{!! $detail['Percent'] !!}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-3 font-medium">{!! $lang['7'] !!}</td>
                                                <td class="border-b py-3 font-bold">{!! $detail['bsa'] !!}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b py-3 font-medium">{!! $lang['8'] !!}</td>
                                                <td class="border-b py-3 font-bold">{!! $detail['bmi'] !!}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-3 font-medium">{!! $lang['9'] !!}</td>
                                                <td class="py-3 font-bold">{!! $detail['lbw'] !!}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="w-full overflow-auto mt-8">
                                    <table class="w-full border-collapse" cellspacing="0">
                                        <thead>
                                            <tr class="bg-[#2845F5] text-white">
                                                <th colspan="2" class="text-center py-3 rounded-t-lg">Your Ideal weight according to</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border-x border-b">
                                            @if(isset($detail['Robinson']))
                                                <tr>
                                                    <td class="border-b py-3 px-4">Robinson formula (1983)</td>
                                                    <td class="border-b py-3 px-4 font-bold text-right">
                                                        @if($unit == 'kg') {{ $detail['Robinson'] }} kg @else {{ round($detail['Robinson'] * 2.205, 2) }} lbs @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-3 px-4">Miller formula (1983)</td>
                                                    <td class="border-b py-3 px-4 font-bold text-right">
                                                        @if($unit == 'kg') {{ $detail['Miller'] }} kg @else {{ round($detail['Miller'] * 2.205, 2) }} lbs @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-3 px-4">Devine formula (1974)</td>
                                                    <td class="border-b py-3 px-4 font-bold text-right">
                                                        @if($unit == 'kg') {{ $detail['Devine'] }} kg @else {{ round($detail['Devine'] * 2.205, 2) }} lbs @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-3 px-4">Hamwi formula (1964)</td>
                                                    <td class="border-b py-3 px-4 font-bold text-right">
                                                        @if($unit == 'kg') {{ $detail['Hamwi'] }} kg @else {{ round($detail['Hamwi'] * 2.205, 2) }} lbs @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-3 px-4">Broca Formula (1871)</td>
                                                    <td class="border-b py-3 px-4 font-bold text-right">
                                                        @if($unit == 'kg') {{ $detail['Broca'] }} kg @else {{ round($detail['Broca'] * 2.205, 2) }} lbs @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-3 px-4">Lorentz Formula</td>
                                                    <td class="border-b py-3 px-4 font-bold text-right">
                                                        @if($unit == 'kg') {{ $detail['Lorentz'] }} kg @else {{ round($detail['Lorentz'] * 2.205, 2) }} lbs @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-3 px-4">Peterson formula (2016)</td>
                                                    <td class="border-b py-3 px-4 font-bold text-right">
                                                        @if($unit == 'kg') {{ $detail['Peterson'] }} kg @else {{ round($detail['Peterson'] * 2.205, 2) }} lbs @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="border-b py-3 px-4">Lemmens Formula (2005)</td>
                                                    <td class="border-b py-3 px-4 font-bold text-right">
                                                        @if($unit == 'kg') {{ $detail['Lemmens'] }} kg @else {{ round($detail['Lemmens'] * 2.205, 2) }} lbs @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="py-3 px-4">BMI Method</td>
                                                    <td class="py-3 px-4 font-bold text-right">
                                                        @if($unit == 'kg') {{ $detail['BMI1'] }} @else {{ $detail['BMI2'] }} @endif
                                                    </td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td class="border-b py-3 px-4">Intuitive Formula</td>
                                                    <td class="border-b py-3 px-4 font-bold text-right">
                                                        @if($unit == 'kg') {{ $detail['Intuitive'] }} kg @else {{ round($detail['Intuitive'] * 2.205, 2) }} lbs @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="py-3 px-4">Baseline Formula</td>
                                                    <td class="py-3 px-4 font-bold text-right">
                                                        @if($unit == 'kg') {{ $detail['Baseline'] }} kg @else {{ round($detail['Baseline'] * 2.205, 2) }} lbs @endif
                                                    </td>
                                                </tr>
                                            @endif
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
