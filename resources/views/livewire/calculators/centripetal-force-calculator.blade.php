<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[70%] md:w-[85%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- Find --}}
                    <div class="col-span-12 md:col-span-6">
                        <label for="calculation_type" class="label">{{ $lang['1'] ?? 'Solve For' }}</label>
                        <select wire:model.live="calculation_type" id="calculation_type" class="input">
                            <option value="1">{{ $lang['2'] ?? 'Mass' }} (m)</option>
                            <option value="2">{{ $lang['3'] ?? 'Radius' }} (r)</option>
                            <option value="3">{{ $lang['4'] ?? 'Tangential Velocity' }} (v)</option>
                            <option value="4">{{ $lang['5'] ?? 'Centripetal Force' }} (F)</option>
                            <option value="5">{{ $lang['6'] ?? 'Angular Velocity' }} (ω)</option>
                            <option value="6">{{ $lang['9'] ?? 'Centripetal Acceleration' }} (a)</option>
                        </select>
                    </div>

                    {{-- Mass --}}
                    @if (in_array($calculation_type, [2, 3, 4, 5]))
                        <div class="col-span-12 md:col-span-6">
                            <label for="mass" class="label">{{ $lang['2'] ?? 'Mass' }} (m)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="mass" id="mass" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('mass_unit')">
                                    {{ $mass_unit }} ▾
                                </label>
                                @if ($openDropdown === 'mass_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                        @foreach (['g', 'kg', 't', 'oz', 'lb', 'stone', 'US ton', 'Long ton', 'Earths', 'Suns'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('mass_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Radius --}}
                    @if (in_array($calculation_type, [1, 3, 4, 5, 6]))
                        <div class="col-span-12 md:col-span-6">
                            <label for="radius" class="label">{{ $lang['3'] ?? 'Radius' }} (r)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="radius" id="radius" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('radius_unit')">
                                    {{ $radius_unit }} ▾
                                </label>
                                @if ($openDropdown === 'radius_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                        @foreach (['mm', 'cm', 'm', 'km', 'in', 'ft', 'yd', 'mi', 'ly', 'au'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('radius_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Velocity --}}
                    @if (in_array($calculation_type, [1, 2, 4, 6]))
                        <div class="col-span-12 md:col-span-6">
                            <label for="t_velocity" class="label">{{ $lang['4'] ?? 'Tangential Velocity' }} (v)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="t_velocity" id="t_velocity" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('t_velocity_unit')">
                                    {{ $t_velocity_unit }} ▾
                                </label>
                                @if ($openDropdown === 't_velocity_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                        @foreach (['m/s', 'km/h', 'ft/s', 'mph', 'ft/min', 'm/min'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('t_velocity_unit', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Centripetal Force --}}
                    @if (in_array($calculation_type, [1, 2, 3, 5]))
                        <div class="col-span-12 md:col-span-6">
                            <label for="c_force" class="label">{{ $lang['5'] ?? 'Centripetal Force' }} (F)</label>
                            <div class="relative">
                                <input type="number" step="any" wire:model.live="c_force" id="c_force" class="input" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" wire:click.stop="toggleDropdown('c_force_unit')">
                                    {{ $c_force_unit }} ▾
                                </label>
                                @if ($openDropdown === 'c_force_unit')
                                    <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 overflow-y-auto ">
                                        @foreach (['N', 'kN', 'pdl', 'lbf'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('c_force_unit', '{{ $u }}')">{{ $u }}</p>
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
    </form>

    <hr>

    <style>
        .fractionUpDown {
            display: inline-block;
            text-align: center;
            vertical-align: middle;
            font-size: .9em;
        }
        .fractionUpDown .num {
            top: 0;
            padding: 0 .3rem;
            display: block;
            white-space: nowrap;
            border-bottom: 1px solid currentColor;
        }
        .visually-hidden {
            width: 1px;
            height: 1px;
            margin: -1px;
            padding: 0;
            border: 0;
            position: absolute;
            clip: rect(0 0 0 0);
            overflow: hidden;
        }
        .fractionUpDown .den {
            line-height: 15px;
            display: block;
            width: 100%;
            white-space: nowrap;
        }
    </style>

    @isset($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
            <div class="text-left space-y-6 overflow-auto">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="w-full mt-2">
                    <div class="w-full overflow-auto">
                        @php
                            $resultLabel = '';
                            $resultValue = '';
                            $resultUnit = '';
                            switch($calculation_type) {
                                case 1: $resultLabel = $lang['2'] ?? 'Mass'; $resultValue = number_format($detail['mass'], 4); $resultUnit = 'kg'; break;
                                case 2: $resultLabel = $lang['3'] ?? 'Radius'; $resultValue = number_format($detail['radius'], 4); $resultUnit = 'm'; break;
                                case 3: $resultLabel = $lang['4'] ?? 'Tangential Velocity'; $resultValue = number_format($detail['velocity'], 4); $resultUnit = 'm/s'; break;
                                case 4: $resultLabel = $lang['5'] ?? 'Centripetal Force'; $resultValue = number_format($detail['centripetal_force'], 4); $resultUnit = 'N'; break;
                                case 5: $resultLabel = $lang['6'] ?? 'Angular Velocity'; $resultValue = number_format($detail['angular_velocity'], 4); $resultUnit = 'rad/s'; break;
                                case 6: $resultLabel = $lang['9'] ?? 'Centripetal Acceleration'; $resultValue = number_format($detail['ac'], 4); $resultUnit = 'm/s²'; break;
                            }
                        @endphp

                        <div class="w-full md:w-[60%] lg:w-[60%] mt-2 mb-8">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $resultLabel }}</strong></td>
                                    <td class="py-2 border-b text-right">{{ $resultValue }} ({{ $resultUnit }})</td>
                                </tr>
                            </table>
                        </div>

                        <div class="space-y-4 text-gray-800 font-s-16">
                            <h3 class="text-lg font-bold border-b pb-2 text-gray-700">{{ $lang['solution'] ?? 'Solution' }}</h3>
                            
                            {{-- Mode-specific Magic Solution --}}
                            @if($calculation_type == 1) {{-- Mass --}}
                                <div class="space-y-3">
                                    <p class="font-bold">Formula :</p>
                                    <p>m = <span class="fractionUpDown"><span class="num">Fc · r</span><span class="den">v²</span></span></p>
                                    <p class="font-bold">Result :</p>
                                    <p>m = <span class="fractionUpDown"><span class="num">Fc · r</span><span class="den">v²</span></span></p>
                                    <p>m = <span class="fractionUpDown"><span class="num">{{ $detail['c'] }} · {{ $detail['r'] }}</span><span class="den">{{ $detail['v'] }}²</span></span></p>
                                    <p class="font-bold pt-2 border-t border-gray-200">m = {{ $resultValue }}</p>
                                </div>
                            @elseif($calculation_type == 2) {{-- Radius --}}
                                <div class="space-y-3">
                                    <p class="font-bold">Formula :</p>
                                    <p>r = <span class="fractionUpDown"><span class="num">m · v²</span><span class="den">Fc</span></span></p>
                                    <p class="font-bold">Result :</p>
                                    <p>r = <span class="fractionUpDown"><span class="num">m · v²</span><span class="den">Fc</span></span></p>
                                    <p>r = <span class="fractionUpDown"><span class="num">{{ $detail['m'] }} · {{ $detail['v'] }}²</span><span class="den">{{ $detail['c'] }}</span></span></p>
                                    <p class="font-bold pt-2 border-t border-gray-200">r = {{ $resultValue }}</p>
                                </div>
                            @elseif($calculation_type == 3) {{-- Velocity --}}
                                <div class="space-y-3">
                                    <p class="font-bold">Formula :</p>
                                    <p>v = √(<span class="fractionUpDown"><span class="num">r · Fc</span><span class="den">m</span></span>)</p>
                                    <p class="font-bold">Result :</p>
                                    <p>v = √(<span class="fractionUpDown"><span class="num">r · Fc</span><span class="den">m</span></span>)</p>
                                    <p>v = √(<span class="fractionUpDown"><span class="num">{{ $detail['r'] }} · {{ $detail['c'] }}</span><span class="den">{{ $detail['m'] }}</span></span>)</p>
                                    <p class="font-bold pt-2 border-t border-gray-200">v = {{ $resultValue }}</p>
                                </div>
                            @elseif($calculation_type == 4) {{-- Force --}}
                                <div class="space-y-3">
                                    <p class="font-bold">Formula :</p>
                                    <p>Fc = <span class="fractionUpDown"><span class="num">m · v²</span><span class="den">r</span></span></p>
                                    <p class="font-bold">Result :</p>
                                    <p>Fc = <span class="fractionUpDown"><span class="num">m · v²</span><span class="den">r</span></span></p>
                                    <p>Fc = <span class="fractionUpDown"><span class="num">{{ $detail['m'] }} · {{ $detail['v'] }}²</span><span class="den">{{ $detail['r'] }}</span></span></p>
                                    <p class="font-bold pt-2 border-t border-gray-200">Fc = {{ $resultValue }}</p>
                                </div>
                            @elseif($calculation_type == 5) {{-- Angular Velocity --}}
                                <div class="space-y-3">
                                    <p class="font-bold">Formula :</p>
                                    <p>ω = √(<span class="fractionUpDown"><span class="num">Fc</span><span class="den">m · r</span></span>)</p>
                                    <p class="font-bold">Result :</p>
                                    <p>ω = √(<span class="fractionUpDown"><span class="num">Fc</span><span class="den">m · r</span></span>)</p>
                                    <p>ω = √(<span class="fractionUpDown"><span class="num">{{ $detail['c'] }}</span><span class="den">{{ $detail['m'] }} · {{ $detail['r'] }}</span></span>)</p>
                                    <p class="font-bold pt-2 border-t border-gray-200">ω = {{ $resultValue }}</p>
                                </div>
                            @elseif($calculation_type == 6) {{-- Acceleration --}}
                                <div class="space-y-3">
                                    <p class="font-bold">Formula :</p>
                                    <p>a = <span class="fractionUpDown"><span class="num">v²</span><span class="den">r</span></span></p>
                                    <p class="font-bold">Result :</p>
                                    <p>a = <span class="fractionUpDown"><span class="num">v²</span><span class="den">r</span></span></p>
                                    <p>a = <span class="fractionUpDown"><span class="num">{{ $detail['v'] }}²</span><span class="den">{{ $detail['r'] }}</span></span></p>
                                    <p class="font-bold pt-2 border-t border-gray-200">a = {{ $resultValue }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
