<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    <!-- Gender -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="gender" class="label">{!! $lang['1'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="gender" id="gender" class="input">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                    </div>

                    <!-- Age -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="age" class="label">{!! $lang['2'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" wire:model.live="age" id="age" class="input" placeholder="00" />
                        </div>
                    </div>

                    <!-- Weight -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="weight" class="label">{{ $lang['3'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="weight" id="weight" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $weight_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('weight_unit', 'lbs');" @click="open = false">pounds (lbs)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('weight_unit', 'kg');" @click="open = false">kilograms (kg)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Height -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="label">{{ $lang['4'] }} <span class="text-blue">({{ $unit_ft_in }})</span>:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            @if($unit_ft_in === 'ft/in')
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="number" step="any" wire:model.live="height_ft" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="ft" />
                                    <input type="number" step="any" wire:model.live="height_in" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="in" />
                                </div>
                            @else
                                <input type="number" wire:model.live="height_cm" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="{{ $unit_ft_in }}" />
                            @endif

                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit_ft_in }} ▾</label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach(['cm' => 'centimeters', 'in' => 'inch', 'ft' => 'feet', 'm' => 'meters', 'ft/in' => 'feet / inches'] as $val => $label)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit_ft_in', '{{ $val }}');" @click="open = false">{{ $label }} ({{ $val }})</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Neck -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="label">{{ $lang['7'] }} <span class="text-blue">({{ $unit_ft_in1 }})</span>:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            @if($unit_ft_in1 === 'ft/in')
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="number" step="any" wire:model.live="neck_ft" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="ft" />
                                    <input type="number" step="any" wire:model.live="neck_in" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="in" />
                                </div>
                            @else
                                <input type="number" wire:model.live="neck_cm" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="{{ $unit_ft_in1 }}" />
                            @endif

                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit_ft_in1 }} ▾</label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach(['cm' => 'centimeters', 'in' => 'inch', 'ft' => 'feet', 'm' => 'meters', 'ft/in' => 'feet / inches'] as $val => $label)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit_ft_in1', '{{ $val }}');" @click="open = false">{{ $label }} ({{ $val }})</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Waist -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="label">{{ $lang['8'] }} <span class="text-blue">({{ $unit_ft_in2 }})</span>:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            @if($unit_ft_in2 === 'ft/in')
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="number" step="any" wire:model.live="waist_ft" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="ft" />
                                    <input type="number" step="any" wire:model.live="waist_in" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="in" />
                                </div>
                            @else
                                <input type="number" wire:model.live="waist_cm" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="{{ $unit_ft_in2 }}" />
                            @endif

                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit_ft_in2 }} ▾</label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach(['cm' => 'centimeters', 'in' => 'inch', 'ft' => 'feet', 'm' => 'meters', 'ft/in' => 'feet / inches'] as $val => $label)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit_ft_in2', '{{ $val }}');" @click="open = false">{{ $label }} ({{ $val }})</p>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Hip (Only for Females) -->
                    @if($gender === 'female')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label class="label">{{ $lang['9'] }} <span class="text-blue">({{ $unit_ft_in3 }})</span>:</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                @if($unit_ft_in3 === 'ft/in')
                                    <div class="grid grid-cols-2 gap-2">
                                        <input type="number" step="any" wire:model.live="hip_ft" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="ft" />
                                        <input type="number" step="any" wire:model.live="hip_in" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="in" />
                                    </div>
                                @else
                                    <input type="number" wire:model.live="hip_cm" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="{{ $unit_ft_in3 }}" />
                                @endif

                                <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit_ft_in3 }} ▾</label>
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    @foreach(['cm' => 'centimeters', 'in' => 'inch', 'ft' => 'feet', 'm' => 'meters', 'ft/in' => 'feet / inches'] as $val => $label)
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit_ft_in3', '{{ $val }}');" @click="open = false">{{ $label }} ({{ $val }})</p>
                                    @endforeach
                                </div>
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

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                       @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                    <div class="w-full bg-light-blue result radius-10 p-3 mt-3">
                        <div class="w-full mt-2">
                            <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                <div class="w-full md:w-[60%] lg:w-[60%] py-2">
                                    <div class="grid grid-cols-12 gap-2">
                                        <div class="col-span-5">
                                            <p><strong>{{ $lang['10'] }}</strong></p>
                                            <p>
                                                <strong class="text-green-700 text-[32px]">
                                                    {{ is_numeric($detail['bodyFat']) ? $detail['bodyFat'] . ' %' : $detail['bodyFat'] }}
                                                </strong>
                                                <span class="text-green-700 text-[18px]" x-show="is_numeric($detail['bodyFat'])">{{ $lang['15'] }}</span>
                                            </p>
                                        </div>
                                        <div class="col-span-2 hidden lg:flex md:flex justify-center">
                                            <div class="border" style="width: 1px"></div>
                                        </div>
                                        <div class="col-span-5 ps-md-4">
                                            <p><strong>{{ $lang['11'] }}</strong></p>
                                            <p>
                                                <strong class="text-green-700 text-[32px]">{{ $detail['fatMass'] }}</strong>
                                                <span class="text-green-700 text-[18px]">{{ $lang['14'] }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full md:w-[60%] lg:w-[60%] p-3">
                                <div class="grid grid-cols-12 gap-2">
                                    <div class="col-span-5">
                                        <p><strong>{{ $lang['12'] }}</strong></p>
                                        <p>
                                            <strong class="text-green-700 text-[32px]">{{ $detail['leanMass'] }}</strong>
                                            <span class="text-green-700 text-[18px]">{{ $lang['14'] }}</span>
                                        </p>
                                    </div>
                                    <div class="col-span-2 hidden lg:flex md:flex justify-center">
                                        <div class="border" style="width: 1px"></div>
                                    </div>
                                    <div class="col-span-5 ps-md-4">
                                        <p><strong>{{ $lang['13'] }}</strong></p>
                                        <p><strong class="text-green-700 text-[32px]">{{ $detail['bodyFatCategory'] }}</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             
            </div>
        @endisset
    </form>
</div>
