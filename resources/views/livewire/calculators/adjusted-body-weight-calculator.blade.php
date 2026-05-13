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

                    <!-- Height -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="label">{{ $lang['2'] }} <span class="text-blue">({{ $unit_ft_in }})</span>:</label>
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

                    <!-- Weight -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="weight" class="label">{{ $lang['13'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="weight" id="weight" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $weight_unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('weight_unit', 'kg');" @click="open = false">kilograms (kg)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('weight_unit', 'lbs');" @click="open = false">pounds (lbs)</p>
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

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="grid grid-cols-12 gap-5">
                                    <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                        <p><strong>{{ $lang['4'] }}</strong></p>
                                        <p>
                                            <strong class="text-green-700 text-[32px]">{{ $detail['idealBodyWeight'] }}</strong>
                                            <span class="text-blue-700 text-[20px]"> {{ $lang['5'] }}</span>
                                        </p>
                                    </div>
                                    <div class="border-r-2 col-span-1 ps-3 me-3 hidden md:block lg:block ">&nbsp;</div>
                                    <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                        <p><strong>{{ $lang['6'] }}</strong></p>
                                        <p>
                                            <strong class="text-green-700 text-[32px]">{{ $detail['adjustedBodyWeight'] }}</strong>
                                            <span class="text-blue-700 text-[20px]"> {{ $lang['5'] }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-5 mt-5">
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <p class="pe-md-3 pb-2 border-md-end"><strong class="text-blue-700 border-b-2">{{ $lang['7'] }}</strong></p>
                                        <div class="w-full overflow-auto pe-md-3 border-md-end">
                                            <table class="w-full" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <td class="border-b py-2"><strong>{{ $lang['8'] }}</strong></td>
                                                        <td class="border-b py-2"><strong>{{ $lang['9'] }}</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="py-2">{{ round($detail['adjustedBodyWeight'] * 2.2046, 2) }}</td>
                                                        <td class="py-2">{{ round($detail['adjustedBodyWeight'] * 0.157473, 2) }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <p class="ps-md-3 pb-2"><strong class="text-blue-700 border-b-2">{{ $lang['10'] }}</strong></p>
                                        <div class="w-full overflow-auto ps-md-3">
                                            <table class="w-full" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <td class="border-b py-2"><strong>{{ $lang['8'] }}</strong></td>
                                                        <td class="border-b py-2"><strong>{{ $lang['9'] }}</strong></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="py-2">{{ round($detail['idealBodyWeight'] * 2.2046, 2) }}</td>
                                                        <td class="py-2">{{ round($detail['idealBodyWeight'] * 0.157473, 2) }}</td>
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
            </div>
        @endisset
    </form>
</div>
