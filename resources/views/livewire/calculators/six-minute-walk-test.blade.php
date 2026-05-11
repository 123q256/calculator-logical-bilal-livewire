<div>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto" x-data="{ unit_h: @entangle('unit_ft_in'), unit_w: @entangle('unit'), unit_d: @entangle('dis_unit') }">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    {{-- Age --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="age" class="label">{!! $lang['age_year'] ?? 'Age' !!}:</label>
                        <div class="w-full py-2">
                            <input type="number" wire:model.live="age" id="age" class="input" placeholder="00" />
                        </div>
                    </div>

                    {{-- Gender --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="gender" class="label">{!! $lang['gender'] ?? 'Gender' !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="gender" id="gender" class="input">
                                <option value="Male">{{ $lang['male'] ?? 'Male' }}</option>
                                <option value="Female">{{ $lang['female'] ?? 'Female' }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Height (ft/in) --}}
                    <div class="col-span-12 grid grid-cols-12 gap-2" x-show="unit_h === 'ft/in'" x-cloak style="{{ $unit_ft_in === 'ft/in' ? '' : 'display: none;' }}">
                        <div class="col-span-6">
                            <label class="label">{!! $lang['height'] ?? 'Height' !!}:</label>
                            <div class="w-full py-2">
                                <input type="number" wire:model.live="height_ft" class="input" placeholder="ft" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label class="label">&nbsp;</label>
                            <div class="relative w-full py-2">
                                <input type="number" wire:model.live="height_in" class="input pr-16" placeholder="in" />
                                <div class="absolute right-3 top-4">
                                    <div class="relative" x-data="{ open: false }">
                                        <button type="button" @click="open = !open" class="text-sm underline">ft/in ▾</button>
                                        <div x-show="open" @click.away="open = false" x-cloak style="display: none;" class="absolute right-0 mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 w-32">
                                            <p @click="unit_h = 'ft/in'; open = false" class="p-2 hover:bg-gray-100 cursor-pointer">ft/in</p>
                                            <p @click="unit_h = 'cm'; open = false" class="p-2 hover:bg-gray-100 cursor-pointer">cm</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Height (cm) --}}
                    <div class="col-span-12" x-show="unit_h === 'cm'" x-cloak style="{{ $unit_ft_in === 'cm' ? '' : 'display: none;' }}">
                        <label class="label">{{ $lang['height'] ?? 'Height' }} (cm):</label>
                        <div class="relative w-full py-2">
                            <input type="number" wire:model.live="height_cm" class="input pr-16" placeholder="cm" />
                            <div class="absolute right-3 top-4">
                                <div class="relative" x-data="{ open: false }">
                                    <button type="button" @click="open = !open" class="text-sm underline">cm ▾</button>
                                    <div x-show="open" @click.away="open = false" x-cloak style="display: none;" class="absolute right-0 mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 w-32">
                                        <p @click="unit_h = 'ft/in'; open = false" class="p-2 hover:bg-gray-100 cursor-pointer">ft/in</p>
                                        <p @click="unit_h = 'cm'; open = false" class="p-2 hover:bg-gray-100 cursor-pointer">cm</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Weight --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{{ $lang['weight'] ?? 'Weight' }}:</label>
                        <div class="relative w-full py-2">
                            <input type="number" wire:model.live="weight" class="input pr-16" placeholder="00" />
                            <div class="absolute right-3 top-4">
                                <div class="relative" x-data="{ open: false }">
                                    <button type="button" @click="open = !open" class="text-sm underline" x-text="unit_w + ' ▾'"></button>
                                    <div x-show="open" @click.away="open = false" x-cloak style="display: none;" class="absolute right-0 mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 w-24">
                                        <p @click="unit_w = 'lbs'; open = false" class="p-2 hover:bg-gray-100 cursor-pointer">lbs</p>
                                        <p @click="unit_w = 'kg'; open = false" class="p-2 hover:bg-gray-100 cursor-pointer">kg</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Distance --}}
                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{{ $lang['Dis_walked'] ?? 'Distance Walked' }}:</label>
                        <div class="relative w-full py-2">
                            <input type="number" wire:model.live="distance" class="input pr-16" placeholder="00" />
                            <div class="absolute right-3 top-4">
                                <div class="relative" x-data="{ open: false }">
                                    <button type="button" @click="open = !open" class="text-sm underline" x-text="unit_d + ' ▾'"></button>
                                    <div x-show="open" @click.away="open = false" x-cloak style="display: none;" class="absolute right-0 mt-1 bg-white border border-gray-300 rounded-md shadow-lg z-10 w-24">
                                        <p @click="unit_d = 'ft'; open = false" class="p-2 hover:bg-gray-100 cursor-pointer">ft</p>
                                        <p @click="unit_d = 'm'; open = false" class="p-2 hover:bg-gray-100 cursor-pointer">m</p>
                                    </div>
                                </div>
                            </div>
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

        {{-- Results --}}
       @if(!empty($detail))
            <div id="result-section" wire:key="walk-test-results" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
                <hr class="mb-5">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="grid grid-cols-12 gap-4">
                    {{-- Expected --}}
                    <div class="col-span-12 md:col-span-4 text-center">
                        <div class="bg-[#F6FAFC] border rounded-lg p-6 flex flex-col items-center justify-center min-h-[160px] shadow-sm">
                            <img src="{{ asset('images/walk_boy.png') }}" alt="6MWT" width="60" class="mb-2">
                            <p>
                                <strong class="text-blue-500 text-[32px]">{{ $detail['Ans'] }}</strong>
                                <span class="text-[18px]">{{ $lang['meters'] ?? 'meters' }}</span>
                            </p>
                        </div>
                        <p class="mt-2 text-sm text-gray-600">{{ $lang['expected'] ?? 'Expected Distance' }}</p>
                    </div>

                    {{-- Percentage --}}
                    <div class="col-span-12 md:col-span-4 text-center">
                        <div class="bg-[#F6FAFC] border rounded-lg p-6 flex flex-col items-center justify-center min-h-[160px] shadow-sm">
                            <img src="{{ asset('images/exp_dist.png') }}" alt="Expected" width="60" class="mb-2">
                            <p>
                                <strong class="text-blue-500 text-[32px]">{{ $detail['Percent'] }}</strong>
                                <span class="text-[18px]">%</span>
                            </p>
                        </div>
                        <p class="mt-2 text-sm text-gray-600">{{ $lang['percentage'] ?? 'Percentage' }}</p>
                    </div>

                    {{-- Lower Limit --}}
                    <div class="col-span-12 md:col-span-4 text-center">
                        <div class="bg-[#F6FAFC] border rounded-lg p-6 flex flex-col items-center justify-center min-h-[160px] shadow-sm">
                            <img src="{{ asset('images/limit.png') }}" alt="Limit" width="60" class="mb-2">
                            <p>
                                <strong class="text-blue-500 text-[32px]">{{ $detail['limit'] }}</strong>
                                <span class="text-[18px]">{{ $lang['meters'] ?? 'meters' }}</span>
                            </p>
                        </div>
                        <p class="mt-2 text-sm text-gray-600">Lower limit of normal</p>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
