<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-1   rounded-lg  space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6">
                {{-- <div class=" w-full mx-auto p-4"> --}}
                <div class="lg:w-[90%] md:w-[90%] w-full mx-auto ">
                    <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        <div class="space-y-2">
                            <div class="space-y-2">
                                <p class="font-s-14 text-blue mb-3">{{ $lang['1'] }}:</p>

                                <label for="height" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>

                                <div class="relative w-full">
                                    <!-- Height Input -->
                                    <input type="number" step="any" id="height" wire:model="height"
                                        class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                        aria-label="input" placeholder="00" />

                                    <!-- Unit Selector Display -->
                                    <label for="h_units"
                                        class="absolute cursor-pointer text-sm underline right-6 top-3"
                                        wire:click="$toggle('showUnitDropdown')">
                                        {{ $h_units }} ▾
                                    </label>

                                    <!-- Hidden Input to store unit -->
                                    <input type="hidden" name="h_units" id="h_units" wire:model="h_units">

                                    <!-- Unit Dropdown -->
                                    @if ($showUnitDropdown ?? false)
                                        <div
                                            class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                            @foreach (['cm' => 'centimeters (cm)', 'm' => 'meters (m)', 'ft' => 'feet (ft)', 'in' => 'inches (in)'] as $value => $label)
                                                <p class="p-1 hover:bg-gray-100 cursor-pointer"
                                                    wire:click="setHeightUnit('{{ $value }}')">
                                                    {{ $label }}
                                                </p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="space-y-2">
                                <p class="font-s-14 mb-3 text-blue">{{ $lang['3'] }}:</p>

                                <label for="length" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>

                                <div class="relative w-full">
                                    <!-- Length Input -->
                                    <input type="number" step="any" id="length" wire:model="length"
                                        class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full"
                                        placeholder="00" aria-label="input" />

                                    <!-- Unit Display -->
                                    <label for="l_units"
                                        class="absolute cursor-pointer text-sm underline right-6 top-3"
                                        wire:click="$toggle('showLengthUnitDropdown')">
                                        {{ $l_units }} ▾
                                    </label>

                                    <!-- Hidden Input -->
                                    <input type="hidden" id="l_units" wire:model="l_units">

                                    <!-- Unit Dropdown -->
                                    @if ($showLengthUnitDropdown)
                                        <div
                                            class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                            @foreach (['cm' => 'centimeters (cm)', 'm' => 'meters (m)', 'ft' => 'feet (ft)', 'in' => 'inches (in)'] as $value => $label)
                                                <p class="p-1 hover:bg-gray-100 cursor-pointer"
                                                    wire:click="setLengthUnit('{{ $value }}')">
                                                    {{ $label }}
                                                </p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="space-y-2">
                            <img src="{{ asset('assets/img/dog-crate.webp') }}" class="max-width" alt="Dog Crate"
                                width="300px" height="180px">
                            <div class="col-12 px-2 mt-0 mt-lg-4">
                                <label for="extra_lenght" class="font-s-14 text-blue cat">{{ $lang['5'] }}:</label>
                                <select class="input" wire:model="extra_lenght" wire:change="changeMethod" id="extra_lenght"
                                    aria-label="input select">
                                    <option value="5.1">2 in/5.1 cm (small dog)</option>
                                    <option value="7.6">3 in/7.6 cm (medium dog)</option>
                                    <option value="10.2">4 in/10.2 cm (big dog)</option>
                                </select>
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
        </div>
        @isset($detail)
        <hr style="height: 1px; background-color: #e5e7eb;">
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full bg-light-blue p-4 rounded-lg mt-6">
                            <div class="mt-4">
                                <p class="text-lg mt-2 mb-2 font-bold text-[#2845F5]">{{ $lang['9'] }}
                                    {{ $lang['10'] }}</p>
                                <table class="text-base mb-6 w-full lg:w-1/2 overflow-auto">
                                    <tr>
                                        <td class="border-b py-2 w-3/4">{{ $lang['10'] }}:</td>
                                        <td class="border-b py-2">{{ $detail['c_height'] }} cm</td>
                                    </tr>
                                </table>

                                <p class="text-lg mt-2 mb-2 font-bold text-[#2845F5]">{{ $lang['9'] }}
                                    {{ $lang['11'] }}</p>
                                <table class="text-base mb-6 w-full lg:w-1/2 overflow-auto">
                                    <tr>
                                        <td class="border-b py-2 w-3/4">{{ $lang['11'] }}:</td>
                                        <td class="border-b py-2">{{ $detail['c_lenght'] }} cm</td>
                                    </tr>
                                </table>

                                <p class="text-lg font-bold mb-2 text-[#2845F5]">{{ $lang['12'] }}</p>
                                <div class="overflow-auto w-full lg:w-1/2 text-base">
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['10'] }} ({{ $lang['13'] }}):</td>
                                            <td class="border-b py-2">{{ $detail['c_height'] * 0.01 }} m</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['11'] }} ({{ $lang['13'] }}):</td>
                                            <td class="border-b py-2">{{ $detail['c_lenght'] * 0.01 }} m</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['10'] }} ({{ $lang['10'] }}):</td>
                                            <td class="border-b py-2">{{ round($detail['c_height'] * 0.3937, 3) }} in</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['11'] }} ({{ $lang['10'] }}):</td>
                                            <td class="border-b py-2">{{ round($detail['c_lenght'] * 0.3937, 3) }} in</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['10'] }} ({{ $lang['15'] }}):</td>
                                            <td class="border-b py-2">{{ round($detail['c_height'] * 0.03281, 4) }} ft
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">{{ $lang['11'] }} ({{ $lang['15'] }}):</td>
                                            <td class="border-b py-2">{{ round($detail['c_lenght'] * 0.03281, 4) }} ft
                                            </td>
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
