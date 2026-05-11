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

                    {{-- Activity --}}
                    <div class="space-y-2">
                        <label for="activity" class="label">{{ $lang['9'] }}:</label>
                        <select wire:model.live="activity" id="activity" class="input">
                            <option value="1.2">{!! $lang['10'] !!}</option>
                            <option value="1.375">{!! $lang['11'] !!}</option>
                            <option value="1.55">{!! $lang['12'] !!}</option>
                            <option value="1.725">{!! $lang['13'] !!}</option>
                            <option value="1.9">{!! $lang['14'] !!}</option>
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
                            <div class="w-full mt-2">
                                    <div class="lg:w-full">
                                        <div class="flex flex-col lg:flex-row bg-[#F6FAFC] text-black text-center border rounded-lg p-3">
                                            <div class="lg:w-7/12 border-b lg:border-r lg:border-b-0 pb-3 lg:pb-0">
                                                <div class="text-lg mb-2">{{ $lang['bmr'] }}</div>
                                                <strong class="text-green text-xl">{{ $detail['BMR'] }}</strong> 
                                                <sub class="text-lg">{{ $lang['Calories/Day'] }}</sub>
                                            </div>
                                            <div class="lg:w-5/12 lg:pl-4 mt-3 lg:mt-0">
                                                <div class="text-lg mb-2">{{ $lang['17'] }}</div>
                                                <strong class="text-green text-xl">{{ round($detail['BMR'] * $activity, 2) }}</strong> 
                                                <sub class="text-lg">kcal</sub>
                                            </div>
                                        </div>

                                        <div class="w-full overflow-auto mt-4">
                                            <table class="w-full lg:w-12/12 mx-auto" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-blue-500 text-left border-b py-2">{{ $lang['9'] }}</th>
                                                        <th class="text-blue-500 text-left border-b py-2">{{ $lang['17'] }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="{{ $activity == '1.2' ? 'bg-[#2845F5] text-white' : '' }}">
                                                        <td class="border-b py-2 px-2">{{ $lang['10'] }}</td>
                                                        <td class="border-b py-2 px-2">{{ round($detail['BMR'] * 1.2, 2) }} kcal</td>
                                                    </tr>
                                                    <tr class="{{ $activity == '1.375' ? 'bg-[#2845F5] text-white' : '' }}">
                                                        <td class="border-b py-2 px-2">{{ $lang['11'] }}</td>
                                                        <td class="border-b py-2 px-2">{{ round($detail['BMR'] * 1.375, 2) }} kcal</td>
                                                    </tr>
                                                    <tr class="{{ $activity == '1.55' ? 'bg-[#2845F5] text-white' : '' }}">
                                                        <td class="border-b py-2 px-2">{{ $lang['12'] }}</td>
                                                        <td class="border-b py-2 px-2">{{ round($detail['BMR'] * 1.55, 2) }} kcal</td>
                                                    </tr>
                                                    <tr class="{{ $activity == '1.725' ? 'bg-[#2845F5] text-white' : '' }}">
                                                        <td class="border-b py-2 px-2">{{ $lang['13'] }}</td>
                                                        <td class="border-b py-2 px-2">{{ round($detail['BMR'] * 1.725, 2) }} kcal</td>
                                                    </tr>
                                                    <tr class="{{ $activity == '1.9' ? 'bg-[#2845F5] text-white' : '' }}">
                                                        <td class="py-2 px-2">{{ $lang['14'] }}</td>
                                                        <td class="py-2 px-2">{{ round($detail['BMR'] * 1.9, 2) }} kcal</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="w-full overflow-auto mt-4">
                                            <table class="w-full mx-auto" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-blue-500 text-left border-b py-2 px-2">{{ $lang['15'] }}</th>
                                                        <th class="text-blue-500 text-left border-b py-2 px-2">{{ $lang['16'] }}</th>
                                                        <th class="text-blue-500 text-left border-b py-2 px-2">{{ $lang['17'] }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="border-b py-2 px-2">Revised Harris-Benedict</td>
                                                        <td class="border-b py-2 px-2">{{ $detail['hbmr'] }} kcal</td>
                                                        <td class="border-b py-2 px-2">{{ round($detail['hbmr'] * $activity, 2) }} kcal</td>
                                                    </tr>
                                                    <tr class="bg-[#2845F5] text-white">
                                                        <td class="border-b py-2 px-2">Mifflin St Jeor</td>
                                                        <td class="border-b py-2 px-2">{{ $detail['BMR'] }} kcal</td>
                                                        <td class="border-b py-2 px-2">{{ round($detail['BMR'] * $activity, 2) }} kcal</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b py-2 px-2">Schofield</td>
                                                        <td class="border-b py-2 px-2">{{ $detail['sbmr'] }} kcal</td>
                                                        <td class="border-b py-2 px-2">{{ round($detail['sbmr'] * $activity, 2) }} kcal</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
