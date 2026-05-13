<div>
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-6">
                    <label for="activeDuty" class="label">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select wire:model.live="activeDuty" id="activeDuty" class="input">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="age" class="label">{!! $lang['2'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" wire:model.live="age" id="age" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="gender" class="label">{!! $lang['3'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select wire:model.live="gender" id="gender" class="input">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                </div>

                <!-- Height Section -->
                <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                    <template x-if="$wire.units1 === 'ft/in'">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="label">ft</label>
                                <input type="number" wire:model.live="height_ft" class="input" />
                            </div>
                            <div class="relative">
                                <label class="label">in</label>
                                <input type="number" wire:model.live="height_in" class="input" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-10" @click="open = !open">ft/in ▾</label>
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach(['ft/in', 'ft', 'in', 'cm', 'm'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('units1', '{{ $u }}'); open = false">{{ $u }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </template>
                    <template x-if="$wire.units1 !== 'ft/in'">
                        <div class="relative">
                            <label class="label">{{ $lang['4'] }} <span x-text="'(' + $wire.units1 + ')'"></span></label>
                            <input type="number" wire:model.live="height_cm" class="input" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-10" @click="open = !open" x-text="$wire.units1 + ' ▾'"></label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach(['ft/in', 'ft', 'in', 'cm', 'm'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('units1', '{{ $u }}'); open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </template>
                </div>
             
                <!-- Neck Section -->
                <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                    <template x-if="$wire.unit_h1 === 'ft/in'">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="label">ft</label>
                                <input type="number" wire:model.live="neck_ft" class="input" />
                            </div>
                            <div class="relative">
                                <label class="label">in</label>
                                <input type="number" wire:model.live="neck_in" class="input" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-10" @click="open = !open">ft/in ▾</label>
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach(['ft/in', 'ft', 'in', 'cm', 'm'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit_h1', '{{ $u }}'); open = false">{{ $u }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </template>
                    <template x-if="$wire.unit_h1 !== 'ft/in'">
                        <div class="relative">
                            <label class="label">{{ $lang['7'] }} <span x-text="'(' + $wire.unit_h1 + ')'"></span></label>
                            <input type="number" wire:model.live="neck_cm" class="input" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-10" @click="open = !open" x-text="$wire.unit_h1 + ' ▾'"></label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach(['ft/in', 'ft', 'in', 'cm', 'm'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit_h1', '{{ $u }}'); open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Waist Section -->
                <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                    <template x-if="$wire.unit_h2 === 'ft/in'">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="label">ft</label>
                                <input type="number" wire:model.live="waist_ft" class="input" />
                            </div>
                            <div class="relative">
                                <label class="label">in</label>
                                <input type="number" wire:model.live="waist_in" class="input" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-10" @click="open = !open">ft/in ▾</label>
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach(['ft/in', 'ft', 'in', 'cm', 'm'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit_h2', '{{ $u }}'); open = false">{{ $u }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </template>
                    <template x-if="$wire.unit_h2 !== 'ft/in'">
                        <div class="relative">
                            <label class="label">{{ $lang['8'] }} <span x-text="'(' + $wire.unit_h2 + ')'"></span></label>
                            <input type="number" wire:model.live="waist_cm" class="input" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-10" @click="open = !open" x-text="$wire.unit_h2 + ' ▾'"></label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach(['ft/in', 'ft', 'in', 'cm', 'm'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit_h2', '{{ $u }}'); open = false">{{ $u }}</p>
                                @endforeach
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Hip Section (Female only) -->
                <template x-if="$wire.gender === 'female'">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" x-data="{ open: false }">
                        <template x-if="$wire.unit_h3 === 'ft/in'">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="label">ft</label>
                                    <input type="number" wire:model.live="hip_ft" class="input" />
                                </div>
                                <div class="relative">
                                    <label class="label">in</label>
                                    <input type="number" wire:model.live="hip_in" class="input" />
                                    <label class="absolute cursor-pointer text-sm underline right-6 top-10" @click="open = !open">ft/in ▾</label>
                                    <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach(['ft/in', 'ft', 'in', 'cm', 'm'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit_h3', '{{ $u }}'); open = false">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template x-if="$wire.unit_h3 !== 'ft/in'">
                            <div class="relative">
                                <label class="label">{{ $lang['9'] }} <span x-text="'(' + $wire.unit_h3 + ')'"></span></label>
                                <input type="number" wire:model.live="hip_cm" class="input" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-10" @click="open = !open" x-text="$wire.unit_h3 + ' ▾'"></label>
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach(['ft/in', 'ft', 'in', 'cm', 'm'] as $u)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('unit_h3', '{{ $u }}'); open = false">{{ $u }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
         
        </div>
    </div>
     @if ($type == 'calculator')
     @include('inc.button')
    @endif
    @if ($type=='widget')
    @include('inc.widget-button')
     @endif
 </div>       

    @isset($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full mt-2">
                        <p><strong>{{ $lang['10'] }}</strong></p>
                        <p><strong class="text-[32px] text-green-700">
                            {{ is_numeric($detail['bodyFatPercentage']) ? round($detail['bodyFatPercentage'], 1) . ' %' : $detail['bodyFatPercentage'] }}
                        </strong></p>
                        <p>{{ $detail['bodyFatCategory'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
</div>
