<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            {{-- Tabs --}}
            <div class="flex items-center justify-center mb-6">
                <div class="lg:w-[80%] md:w-[80%] w-full">
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 py-1">
                        <div class="lg:w-1/3 w-full px-2 py-1">
                            <div wire:click="setTab('1')"
                                class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $velo_value == '1' ? 'tagsUnit' : '' }}">
                                {{ $lang['v_d'] ?? 'Velocity & Time' }}
                            </div>
                        </div>
                        <div class="lg:w-1/3 w-full px-2 py-1">
                            <div wire:click="setTab('2')"
                                class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $velo_value == '2' ? 'tagsUnit' : '' }}">
                                {{ $lang['d_t'] ?? 'Displacement & Time' }}
                            </div>
                        </div>
                        <div class="lg:w-1/3 w-full px-2 py-1">
                            <div wire:click="setTab('3')"
                                class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $velo_value == '3' ? 'tagsUnit' : '' }}">
                                {{ $lang['f_m'] ?? 'Force & Mass' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    {{-- Mode 1 & 2: Initial Velocity --}}
                    @if($velo_value == '1' || $velo_value == '2')
                        <div class="col-span-12 md:col-span-6">
                            <label for="iv" class="font-s-14 text-blue">{{ $lang['iv'] }} (V₀)</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="iv" id="iv" step="any" class="input" placeholder="00" />
                                <label wire:click="toggleDropdown('ivU')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $ivU }} ▾</label>
                                @if($openDropdown == 'ivU')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['m/s', 'ft/s', 'km/h', 'km/s', 'mi/s', 'mph'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('ivU', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Mode 1: Final Velocity --}}
                    @if($velo_value == '1')
                        <div class="col-span-12 md:col-span-6">
                            <label for="fv" class="font-s-14 text-blue">{{ $lang['fv'] }} (Vf)</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="fv" id="fv" step="any" class="input" placeholder="00" />
                                <label wire:click="toggleDropdown('fvU')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $fvU }} ▾</label>
                                @if($openDropdown == 'fvU')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['m/s', 'ft/s', 'km/h', 'km/s', 'mi/s', 'mph'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('fvU', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Mode 1 & 2: Time --}}
                    @if($velo_value == '1' || $velo_value == '2')
                        <div class="col-span-12 md:col-span-6">
                            <label for="ct" class="font-s-14 text-blue">{{$lang['time']}} (t)</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="ct" id="ct" step="any" class="input" placeholder="00" />
                                <label wire:click="toggleDropdown('ctU')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $ctU }} ▾</label>
                                @if($openDropdown == 'ctU')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['sec', 'min', 'h'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('ctU', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Mode 2: Displacement --}}
                    @if($velo_value == '2')
                        <div class="col-span-12 md:col-span-6">
                            <label for="cdis" class="font-s-14 text-blue">{{ $lang['disp'] }} (∆x)</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="cdis" id="cdis" step="any" class="input" placeholder="00" />
                                <label wire:click="toggleDropdown('cdisU')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $cdisU }} ▾</label>
                                @if($openDropdown == 'cdisU')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['m', 'cm', 'in', 'ft', 'km', 'mi', 'yd'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('cdisU', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Mode 3: Mass --}}
                    @if($velo_value == '3')
                        <div class="col-span-12 md:col-span-6">
                            <label for="mass" class="font-s-14 text-blue">{{ $lang['mass'] }} (m)</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="mass" id="mass" step="any" class="input" placeholder="00" />
                                <label wire:click="toggleDropdown('masU')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $masU }} ▾</label>
                                @if($openDropdown == 'masU')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-60 overflow-auto">
                                        @foreach(['kg', 'g', 'mg', 't', 'gr', 'dr', 'oz', 'lbs', 'us ton', 'long ton'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('masU', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Mode 3: Force --}}
                    @if($velo_value == '3')
                        <div class="col-span-12 md:col-span-6">
                            <label for="force" class="font-s-14 text-blue">{{ $lang['net'] }} (F)</label>
                            <div class="relative w-full mt-1">
                                <input type="number" wire:model="force" id="force" step="any" class="input" placeholder="00" />
                                <label wire:click="toggleDropdown('forceU')" class="absolute cursor-pointer text-sm underline right-4 top-1/2 transform -translate-y-1/2">{{ $forceU }} ▾</label>
                                @if($openDropdown == 'forceU')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg max-h-60 overflow-auto">
                                        @foreach(['N', 'KN', 'MN', 'GN', 'TN', 'pdl', 'lbf', 'dyn'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('forceU', '{{ $u }}')">{{ $u }}</p>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    
                    <div class="space-y-8">
                        <div class="text-center">
                            <p class="text-[18px] font-bold"><strong>{{ $lang['res'] }}</strong></p>
                            <div class="flex justify-center mt-4">
                                <div class="bg-[#2845F5] text-white rounded-lg px-10 py-6">
                                    <span class="text-3xl font-bold block">{{ sprintf("%.7f", $detail['ans']) }}</span>
                                    <span class="text-lg opacity-90 block mt-1">m/s²</span>
                                </div>
                            </div>
                        </div>

                        {{-- Unit Conversion Table --}}
                        <div class=" space-y-4">
                            <p class="text-xl font-bold text-blue border-b border-blue-200 pb-2">Unit Conversions</p>
                            <div class="w-full lg:w-[70%]  overflow-auto">
                                <table class="w-full font-s-18 border-collapse">
                                    <tbody>
                                        <tr class="transition-colors">
                                            <td class="p-3 border-b">m/s²</td>
                                            <td class="p-3 border-b font-bold text-blue text-right">{{ sprintf("%.7f", $detail['ans']) }}</td>
                                        </tr>
                                        <tr class="transition-colors">
                                            <td class="p-3 border-b">g (Standard Gravity)</td>
                                            <td class="p-3 border-b font-bold text-blue text-right">{{ sprintf("%.7f", $detail['ans'] / 9.80665) }}</td>
                                        </tr>
                                        <tr class="transition-colors">
                                            <td class="p-3 border-b">ft/s²</td>
                                            <td class="p-3 border-b font-bold text-blue text-right">{{ sprintf("%.7f", $detail['ans'] / 0.3048) }}</td>
                                        </tr>
                                        <tr class="transition-colors">
                                            <td class="p-3 border-b">km/h²</td>
                                            <td class="p-3 border-b font-bold text-blue text-right">{{ sprintf("%.7f", $detail['ans'] * 12960) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
