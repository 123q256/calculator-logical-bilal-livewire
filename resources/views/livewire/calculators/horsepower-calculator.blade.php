<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12  gap-4">
                    <div class="col-span-12">
                        <label for="method" class="font-s-14 text-blue">{{ $lang['method'] }}</label>
                        <div class="w-full py-2 position-relative">
                            <select wire:model.live="method" id="method" class="input">
                                <option value="1">{{ $lang['et'] }}</option>
                                <option value="2">{{ $lang['ts'] }}</option>
                                <option value="3">{{ $lang['rpm'] }}</option>
                                <option value="4">{{ $lang['base'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Method 1 & 2: Weight --}}
                    @if ($method == 1 || $method == 2)
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 weight">
                            <label for="weight" class="font-s-14 text-blue">{{ $lang['weight'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="weight" step="any" min="1"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('unit_w')">{{ $unit_w }} ▾</label>
                                @if ($openDropdown === 'unit_w')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['lbs', 'kg'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('unit_w', '{{ $val }}')">{{ $val }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Method 1: Time --}}
                    @if ($method == 1)
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 trap">
                            <label for="time" class="font-s-14 text-blue">{{ $lang['time'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="time" step="any" min="1"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('unit_t')">{{ $unit_t }} ▾</label>
                                @if ($openDropdown === 'unit_t')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['sec', 'min', 'h'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('unit_t', '{{ $val }}')">{{ $val }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Method 2: Speed --}}
                    @if ($method == 2)
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 elapsed">
                            <label for="speed" class="font-s-14 text-blue">{{ $lang['speed'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="speed" step="any" min="1"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('unit_s')">{{ $unit_s }} ▾</label>
                                @if ($openDropdown === 'unit_s')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['mph', 'km/s', 'km/h', 'm/s'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('unit_s', '{{ $val }}')">{{ $val }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>

                {{-- Method 4: Based --}}
                @if ($method == 4)
                    <div class="grid grid-cols-12 gap-4 mt-4 based">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="force" class="font-s-14 text-blue">{{ $lang['for'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="force" step="any" min="1"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('for_u')">{{ $for_u }} ▾</label>
                                @if ($openDropdown === 'for_u')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['N', 'kN', 'MN', 'GN', 'TN'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('for_u', '{{ $val }}')">{{ $val }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="distance" class="font-s-14 text-blue">{{ $lang['dis'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="distance" step="any" min="1"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('dis_u')">{{ $dis_u }} ▾</label>
                                @if ($openDropdown === 'dis_u')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['m', 'km', 'yd', 'ft', 'cm', 'mm'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('dis_u', '{{ $val }}')">{{ $val }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="btime" class="font-s-14 text-blue">{{ $lang['time'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live="btime" step="any"
                                    class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                    placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                    wire:click.stop="toggleDropdown('unit_bt')">{{ $unit_bt }} ▾</label>
                                @if ($openDropdown === 'unit_bt')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div
                                        class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['sec', 'min', 'h'] as $val)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                                wire:click.stop="setUnit('unit_bt', '{{ $val }}')">{{ $val }}
                                            </p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Method 3: RPM --}}
                @if ($method == 3)
                    <div class="grid grid-cols-12 gap-4 mt-4 torque">
                        <div class="col-span-12">
                            <label for="to" class="font-s-14 text-blue">To Calculate:</label>
                            <div class="w-full py-2 position-relative">
                                <select wire:model.live="to" id="to" class="input">
                                    <option value="1">{{ $lang['eh'] }}</option>
                                    <option value="2">{{ $lang['tor'] }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12">
                            <label for="rpm" class="font-s-14 text-blue">Engine RPM:</label>
                            <div class="w-full py-2 position-relative">
                                <input type="number" step="any" wire:model.live="rpm" id="rpm" class="input"
                                    placeholder="413" />
                            </div>
                        </div>
                        @if ($to == 1)
                            <div class="col-span-12 tor">
                                <label for="tor" class="font-s-14 text-blue">{{ $lang['tor'] }}</label>
                                <div class="w-full py-2 relative">
                                    <input type="number" step="any" wire:model.live="tor" id="tor" class="input"
                                        placeholder="413" />
                                    <span class="text-blue input_unit">ft-lb</span>
                                </div>
                            </div>
                        @else
                            <div class="col-span-12 hors">
                                <label for="hors" class="font-s-14 text-blue">{{ $lang['eh'] }}</label>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" wire:model.live="hors" id="hors" class="input"
                                        placeholder="413" />
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
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
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto  mt-2">
                                @if ($method == 1 || $method == 2 || ($method == 3 && $to == 1))
                                    <p class="mt-2">{{ $lang['pow'] }}</p>
                                    <p class="mt-2 py-2 border-b"><strong>{{ $detail['hpm'] }} {{ $lang['hpm'] }}</strong>
                                    </p>
                                    <p class="my-2">It is equivalent to</p>
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{ $detail['hpmet'] }}
                                                    {{ $lang['hpmet'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{ $detail['hpkw'] }}
                                                    {{ $lang['kilo'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{ $detail['hpm'] * 550 }}
                                                    {{ $lang['ft'] }}</strong></td>
                                        </tr>
                                    </table>
                                @elseif($method == 4)
                                    <p class="mt-2">{{ $lang['pow'] }}</p>
                                    <p class="mt-2"><strong>{{ $detail['hp'] }} {{ $lang['wat'] }}</strong></p>
                                    <p class="mt-2">It is equivalent to</p>
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{ $detail['hp'] / 1000 }}
                                                    {{ $lang['kilo'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{ round($detail['hp'] * 0.001341, 7) }}
                                                    {{ $lang['hpm'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{ round($detail['hp'] * 0.00136, 7) }}
                                                    {{ $lang['hpmet'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{ round($detail['hp'] / 746, 7) }}
                                                    {{ $lang['hpel'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{ round($detail['hp'] / 9810, 7) }}
                                                    {{ $lang['hpb'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{ round($detail['hp'] * 0.7376, 7) }}
                                                    {{ $lang['ft'] }}</strong></td>
                                        </tr>
                                    </table>
                                @elseif($method == 3 && $to == 2)
                                    <p class="mt-2">{{ $lang['tor'] }} = <strong>{{ $detail['tor'] }}
                                            <sub>ft-lb</sub></strong></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
