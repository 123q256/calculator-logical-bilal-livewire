<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    {{-- Calculation Target --}}
                    <div class="space-y-2">
                        <label for="cal" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <select wire:model.live="cal" class="input" id="cal">
                            <option value="mass">{{ $lang['2'] }}</option>
                            <option value="gravity">{{ $lang['3'] }}</option>
                            <option value="height">{{ $lang['4'] }}</option>
                            <option value="pe">{{ $lang['5'] }}</option>
                        </select>
                    </div>

                    {{-- Potential Energy (Show if not calculating PE) --}}
                    @if ($cal !== 'pe')
                        <div class="space-y-2">
                            <label for="pe" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="pe" id="pe" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('pe_unit')">
                                    {{ $pe_unit }} ▾
                                </label>
                                @if ($openDropdown === 'pe_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        @foreach (['j', 'kJ', 'MJ', 'Wh', 'kWh', 'ft_lbs', 'kcal', 'eV'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('pe_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Mass (Show if not calculating Mass) --}}
                    @if ($cal !== 'mass')
                        <div class="space-y-2">
                            <label for="mass" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="mass" id="mass" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('mass_unit')">
                                    {{ $mass_unit }} ▾
                                </label>
                                @if ($openDropdown === 'mass_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto max-h-48">
                                        @foreach (['µg', 'mg', 'g', 'dag', 'kg', 't', 'gr', 'dr', 'oz', 'lb', 'stone', 'us_ton', 'long_ton', 'earths', 'me', 'u', 'oz_t'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('mass_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Gravity (Show if not calculating Gravity) --}}
                    @if ($cal !== 'gravity')
                        <div class="space-y-2">
                            <label for="gravity" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="gravity" id="gravity" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('gravity_unit')">
                                    {{ $gravity_unit == 'm_s2' ? 'm/s²' : ($gravity_unit == 'cm_s2' ? 'cm/s²' : ($gravity_unit == 'in_s2' ? 'in/s²' : ($gravity_unit == 'mi_h_s' ? 'mi/h/s' : 'g'))) }} ▾
                                </label>
                                @if ($openDropdown === 'gravity_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('gravity_unit', 'm_s2')">m/s²</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('gravity_unit', 'cm_s2')">cm/s²</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('gravity_unit', 'in_s2')">in/s²</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('gravity_unit', 'mi_h_s')">mi/h/s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('gravity_unit', 'g')">g</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Height (Show if not calculating Height) --}}
                    @if ($cal !== 'height')
                        <div class="space-y-2">
                            <label for="height" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                            <div class="relative w-full">
                                <input type="number" step="any" wire:model.live="height" id="height" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('height_unit')">
                                    {{ $height_unit }} ▾
                                </label>
                                @if ($openDropdown === 'height_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto max-h-48">
                                        @foreach (['mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi', 'nmi'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click.stop="setUnit('height_unit', '{{ $u }}')">{{ $u }}</p>
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
                        <div class="w-full p-3 rounded-lg mt-3">
                            <div class="lg:w-2/5 mt-2">
                                <table class="w-full text-lg">
                                    <tr>
                                        <td class="py-2 border-b w-7/10 text-capitalize"><strong>{{ $detail['cal'] }} </strong></td>
                                        <td class="py-2 border-b">
                                            <strong>{{ round($detail['ans'], 4) }}
                                                <span class="text-2xl">{{ $detail['unit'] }}</span></strong>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-lg mt-6">
                                <div class="w-full space-y-4">
                                    <p class="w-full mt-2">{{ $lang[6] }}:</p>
                                    @if ($detail['cal'] === 'mass')
                                        <p><strong>{{ $lang[7] }}</strong></p>
                                        <p class="font-mono">m = PE / (g * h)</p>
                                        <p><strong>{{ $lang[8] }}</strong></p>
                                        <p>PE = {{ $detail['pe'] }}, g = {{ $detail['g'] }}, h = {{ $detail['h'] }}, m = ?</p>
                                        <p><strong>{{ $lang[9] }}</strong></p>
                                        <p class="font-mono">m = {{ $detail['pe'] }} / ({{ $detail['g'] }} * {{ $detail['h'] }})</p>
                                        <p>m = <strong>{{ round($detail['ans'], 5) }} {{ $detail['unit'] }}</strong></p>
                                    @elseif($detail['cal'] === 'gravity')
                                        <p><strong>{{ $lang[7] }}</strong></p>
                                        <p class="font-mono">g = PE / (m * h)</p>
                                        <p><strong>{{ $lang[8] }}</strong></p>
                                        <p>PE = {{ $detail['pe'] }}, m = {{ $detail['m'] }}, h = {{ $detail['h'] }}, g = ?</p>
                                        <p><strong>{{ $lang[9] }}</strong></p>
                                        <p class="font-mono">g = {{ $detail['pe'] }} / ({{ $detail['m'] }} * {{ $detail['h'] }})</p>
                                        <p>g = <strong>{{ round($detail['ans'], 5) }} {{ $detail['unit'] }}</strong></p>
                                    @elseif($detail['cal'] === 'height')
                                        <p><strong>{{ $lang[7] }}</strong></p>
                                        <p class="font-mono">h = PE / (m * g)</p>
                                        <p><strong>{{ $lang[8] }}</strong></p>
                                        <p>PE = {{ $detail['pe'] }}, m = {{ $detail['m'] }}, g = {{ $detail['g'] }}, h = ?</p>
                                        <p><strong>{{ $lang[9] }}</strong></p>
                                        <p class="font-mono">h = {{ $detail['pe'] }} / ({{ $detail['m'] }} * {{ $detail['g'] }})</p>
                                        <p>h = <strong>{{ round($detail['ans'], 5) }} {{ $detail['unit'] }}</strong></p>
                                    @elseif($detail['cal'] === 'pe')
                                        <p><strong>{{ $lang[7] }}</strong></p>
                                        <p class="font-mono">PE = m * g * h</p>
                                        <p><strong>{{ $lang[8] }}</strong></p>
                                        <p>m = {{ $detail['m'] }}, g = {{ $detail['g'] }}, h = {{ $detail['h'] }}, PE = ?</p>
                                        <p><strong>{{ $lang[9] }}</strong></p>
                                        <p class="font-mono">PE = {{ $detail['m'] }} * {{ $detail['g'] }} * {{ $detail['h'] }}</p>
                                        <p>PE = <strong>{{ round($detail['ans'], 5) }} {{ $detail['unit'] }}</strong></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
