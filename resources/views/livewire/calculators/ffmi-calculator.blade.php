<div>
    <style>
        .purple { background-color: #9c27b0 !important; }
        .cyan { background-color: #00bcd4 !important; }
        .red { background-color: #F44336 !important; }
        .orange { background-color: #ff9800 !important; }
        .bg-gradient { background: linear-gradient(to right, #9c27b0, #00bcd4) !important; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[90%] md:w-[90%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    {{-- Gender --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="gender" class="label">{{ $lang['gender'] }}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="gender" id="gender" class="input">
                                <option value="Male">{{ $lang['male'] }}</option>
                                <option value="Female">{{ $lang['female'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Weight --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="weight" class="label">{{ $lang['weight'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="weight" id="weight" step="any" class="input pr-12" placeholder="00" />
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center">
                                <button type="button" @click="open = !open" class="text-sm underline focus:outline-none">
                                    {{ $unit }} ▾
                                </button>
                            </div>
                            <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('unit', 'lbs'); open = false">pounds (lbs)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('unit', 'kg'); open = false">kilograms (kg)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Height --}}
                    @if ($unit_h == 'ft/in')
                        <div class="col-span-6 md:col-span-3 lg:col-span-3">
                            <label for="height_ft" class="label">{!! $lang['height'] !!}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="height_ft" id="height_ft" class="input" placeholder="ft" />
                            </div>
                        </div>
                        <div class="col-span-6 md:col-span-3 lg:col-span-3">
                            <label for="height_in" class="label">&nbsp;</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="height_in" id="height_in" step="any" class="input pr-12" placeholder="in" />
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center">
                                    <button type="button" @click="open = !open" class="text-sm underline focus:outline-none">
                                        ft/in ▾
                                    </button>
                                </div>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('unit_h', 'ft/in'); open = false">feet / inches (ft/in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('unit_h', 'cm'); open = false">centimeters (cm)</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="height_cm" class="label">{{ $lang['height'] }} (cm):</label>
                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                <input type="number" wire:model.live="height_cm" id="height_cm" step="any" class="input pr-12" placeholder="00" />
                                <div class="absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center">
                                    <button type="button" @click="open = !open" class="text-sm underline focus:outline-none">
                                        cm ▾
                                    </button>
                                </div>
                                <div x-show="open" @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('unit_h', 'ft/in'); open = false">feet / inches (ft/in)</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.setUnit('unit_h', 'cm'); open = false">centimeters (cm)</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    {{-- Body Fat Percentage --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="percent" class="label">
                            {{ $lang['body_fat'] .' % '. ($lang['dont'] ?? '') }}
                            <a title="Body Fat Percentage Calculator" href="{{ url('body-fat-percentage-calculator') }}/" class="text-blue-500 font-s-12 underline" target="_blank" rel="noopener"> {{ $lang['click'] ?? 'click here' }}</a>:
                        </label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="percent" id="percent" class="input pr-8" placeholder="0%" />
                            <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">%</span>
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
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="w-full overflow-auto">
                                    <table class="w-full md:w-[80%] lg:w-[80%]" cellspacing="0">
                                        <tr>
                                            <th class="text-start text-blue border-b py-2">{{ $lang['name'] }}</th>
                                            <th class="text-start text-blue border-b">{{ $lang['value'] }}</th>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['fat'] }}</td>
                                            <td class="border-b">
                                                @if (isset($detail['lean']))
                                                    {{ $detail['lean']." kg / ".round($detail['lean']*2.205,2)." lbs" }}
                                                @else
                                                    00 kg
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['body_fat'] }}</td>
                                            <td class="border-b">
                                                @if (isset($detail['body_fat']))
                                                    {{ $detail['body_fat']." kg / ".round($detail['body_fat']*2.205,2)." lbs" }}
                                                @else
                                                    00 kg
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['ffmi'] }}</td>
                                            <td class="border-b">
                                                @if (isset($detail['ffmi']))
                                                    {{ $detail['ffmi']." kg/m²" }}
                                                @else
                                                    00 kg/m²
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['nffmi'] }}</td>
                                            <td class="border-b">
                                                @if (isset($detail['nffmi']))
                                                    {{ $detail['nffmi']." kg/m²" }}
                                                @else
                                                    00 kg/m²
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['f_cat'] }}</td>
                                            <td class="border-b">{{ $detail['cat'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">{{ $lang['bmi'] }}</td>
                                            <td>
                                                @if (isset($detail['bmi']))
                                                    {{ $detail['bmi']." kg/m²" }}
                                                @else
                                                    00 kg/m²
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full overflow-auto mt-3">
                                    <table class="w-full col-lg-8" cellspacing="0">
                                        <tr>
                                            <th class="text-start text-blue border-b py-2">{{ $lang['frang'] }}</th>
                                            <th class="text-start text-blue border-b">{{ $lang['des'] }}</th>
                                        </tr>
                                        <tr class="{{ isset($detail['skinny']) ? $detail['skinny'] : '' }}">
                                            <td class="border-b p-2">{{ $lang['Below'] }}</td>
                                            <td class="border-b p-2">{{ $lang['b_a'] }}</td>
                                        </tr>
                                        <tr class="{{ isset($detail['average']) ? $detail['average'] : '' }}">
                                            <td class="border-b p-2">18 - 20</td>
                                            <td class="border-b p-2">{{ $lang['ave'] }}</td>
                                        </tr>
                                        <tr class="{{ isset($detail['fat']) ? $detail['fat'] : '' }}">
                                            <td class="border-b p-2">20 - 22</td>
                                            <td class="border-b p-2">{{ $lang['a_a'] }}</td>
                                        </tr>
                                        <tr class="{{ isset($detail['athlete']) ? $detail['athlete'] : '' }}">
                                            <td class="border-b p-2">22 - 23</td>
                                            <td class="border-b p-2">{{ $lang['ex'] }}</td>
                                        </tr>
                                        <tr class="{{ isset($detail['gym']) ? $detail['gym'] : '' }}">
                                            <td class="border-b p-2">23 - 26</td>
                                            <td class="border-b p-2">{{ $lang['sup'] }}</td>
                                        </tr>
                                        <tr class="{{ isset($detail['body']) ? $detail['body'] : '' }}">
                                            <td class="p-2">26 - 28</td>
                                            <td class="p-2">{{ $lang['sups'] }}</td>
                                        </tr>
                                        <tr class="{{ isset($detail['unlikely']) ? $detail['unlikely'] : '' }}">
                                            <td class="p-2">> 28</td>
                                            <td class="p-2">Highly Unlikely without steroids</td>
                                        </tr>
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
