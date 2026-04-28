<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Solve For --}}
                    <div class="col-span-12">
                        <label for="find" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="find" class="input" id="find">
                                <option value="wavelength">{{ $lang['2'] }}</option>
                                <option value="frequency">{{ $lang['3'] }}</option>
                                <option value="velocity">{{ $lang['4'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Medium Preset (Speed of Sound/Light) --}}
                    <div class="col-span-12">
                        <label for="preset" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="preset" class="input" id="preset">
                                <option value="custom">{{ $lang['6'] }}</option>
                                <option value="299792458">{{ $lang['7'] }}</option>
                                <option value="299702547">{{ $lang['8'] }}</option>
                                <option value="225238511">{{ $lang['9'] }}</option>
                                <option value="199861639">{{ $lang['10'] }}</option>
                                <option value="343">{{ $lang['11'] }}</option>
                                <option value="355">{{ $lang['12'] }}</option>
                                <option value="60">{{ $lang['13'] }}</option>
                                <option value="1210">{{ $lang['14'] }}</option>
                                <option value="3240">{{ $lang['15'] }}</option>
                                <option value="4540">{{ $lang['16'] }}</option>
                                <option value="4600">{{ $lang['17'] }}</option>
                                <option value="6320">{{ $lang['18'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Velocity --}}
                    @if ($find !== 'velocity')
                        <div class="col-span-12">
                            <label for="velocity" class="font-s-14 text-blue">{{ $lang['19'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="text" inputmode="decimal" wire:model.live="velocity" id="velocity" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('velocity_unit')">
                                    {{ $velocity_unit == 'cms' ? 'cm/s' : ($velocity_unit == 'ms' ? 'm/s' : ($velocity_unit == 'kmh' ? 'km/h' : ($velocity_unit == 'fts' ? 'ft/s' : ($velocity_unit == 'mph' ? 'mph' : ($velocity_unit == 'knots' ? 'knots' : 'c'))))) }} ▾
                                </label>
                                @if ($openDropdown === 'velocity_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('velocity_unit', 'cms')">cm/s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('velocity_unit', 'ms')">m/s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('velocity_unit', 'kmh')">km/h</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('velocity_unit', 'fts')">ft/s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('velocity_unit', 'mph')">mph</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('velocity_unit', 'knots')">knots</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('velocity_unit', 'c')">c</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Frequency --}}
                    @if ($find !== 'frequency')
                        <div class="col-span-12">
                            <label for="frequency" class="font-s-14 text-blue">{{ $lang['20'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="text" inputmode="decimal" wire:model.live="frequency" id="frequency" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('frequency_unit')">
                                    {{ strtoupper($frequency_unit) }} ▾
                                </label>
                                @if ($openDropdown === 'frequency_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['hz', 'khz', 'mhz', 'ghz', 'thz'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('frequency_unit', '{{ $u }}')">{{ strtoupper($u) }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Wavelength --}}
                    @if ($find !== 'wavelength')
                        <div class="col-span-12">
                            <label for="wavelength" class="font-s-14 text-blue">{{ $lang['21'] }}</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="text" inputmode="decimal" wire:model.live="wavelength" id="wavelength" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('wavelength_unit')">
                                    {{ $wavelength_unit }} ▾
                                </label>
                                @if ($openDropdown === 'wavelength_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto max-h-48">
                                        @foreach (['nm', 'μm', 'mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('wavelength_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
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

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full overflow-auto">
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b text-capitalize" width="40%"><strong>{{ $detail['find'] }} </strong></td>
                                        <td class="py-2 border-b"> <strong>{{ $detail['ans'] }} <span>{{ $detail['unit'] }}</span></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>{{ $lang['22'] }} </strong></td>
                                        <td class="py-2 border-b"> <strong>{{ $detail['wn'] }} <span>1/m</span></strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full mt-6 space-y-4">
                                <p class="mt-2">{{ $lang[23] }}:</p>
                                <p class="mt-2"><strong>{{ $lang[24] }}</strong></p>
                                @if ($detail['find'] === 'wavelength')
                                    <p class="font-mono">λ = v / f</p>
                                    <p><strong>{{ $lang[26] }}</strong></p>
                                    <p class="font-mono">λ = {{ round($detail['velocity'], 4) }} / {{ round($detail['frequency'], 4) }}</p>
                                    <p>λ = <strong>{{ $detail['ans'] }} {{ $detail['unit'] }}</strong></p>
                                @elseif($detail['find'] === 'frequency')
                                    <p class="font-mono">f = v / λ</p>
                                    <p><strong>{{ $lang[26] }}</strong></p>
                                    <p class="font-mono">f = {{ round($detail['velocity'], 4) }} / {{ round($detail['wavelength'], 4) }}</p>
                                    <p>f = <strong>{{ $detail['ans'] }} {{ $detail['unit'] }}</strong></p>
                                @elseif($detail['find'] === 'velocity')
                                    <p class="font-mono">v = f * λ</p>
                                    <p><strong>{{ $lang[26] }}</strong></p>
                                    <p class="font-mono">v = {{ round($detail['frequency'], 4) }} * {{ round($detail['wavelength'], 4) }}</p>
                                    <p>v = <strong>{{ $detail['ans'] }} {{ $detail['unit'] }}</strong></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
