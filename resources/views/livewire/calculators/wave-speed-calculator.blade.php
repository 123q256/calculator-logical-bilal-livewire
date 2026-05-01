<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[80%] w-full mx-auto space-y-4">
                {{-- Frequency --}}
                <div>
                    <label for="frequency" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="frequency" id="frequency" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                        <label wire:click="toggleDropdown('f_unit')" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $f_unit }} ▾</label>
                        @if($openDropdown == 'f_unit')
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                @foreach(['Hz', 'kHz', 'MHz', 'GHz', 'THz'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('f_unit', '{{ $u }}')">{{ $u }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Wavelength --}}
                <div>
                    <label for="wavelength" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" wire:model="wavelength" id="wavelength" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                        <label wire:click="toggleDropdown('w_units')" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $w_units }} ▾</label>
                        @if($openDropdown == 'w_units')
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                @foreach(['m', 'nm', 'μm', 'mm', 'cm', 'km', 'in', 'ft', 'yd', 'mi'] as $u)
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('w_units', '{{ $u }}')">{{ $u }}</p>
                                @endforeach
                            </div>
                        @endif
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

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    
                    <div class="space-y-8">
                        {{-- Wave Speed Section --}}
                        <div>
                            <p class="w-full mt-2 font-s-18 text-blue font-bold border-b pb-2"><strong>{{ $lang[3] }}</strong></p>
                            <div class="w-full md:w-[70%] lg:w-[70%] mt-4 overflow-auto">
                                <table class="w-full font-s-18 border-collapse">
                                    <tbody>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['v'], 6) }}</strong></td>
                                            <td class="p-3 border-b">m/s</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['v']*3.6, 6) }}</strong></td>
                                            <td class="p-3 border-b">km/h</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['v']*3.28084, 6) }}</strong></td>
                                            <td class="p-3 border-b">ft/s</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['v']*2.236936, 6) }}</strong></td>
                                            <td class="p-3 border-b">mph</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['v']*1.943844, 6) }}</strong></td>
                                            <td class="p-3 border-b">knots</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ sprintf("%.4e", $detail['v']*3.33564e-9) }}</strong></td>
                                            <td class="p-3 border-b">light speed</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['v']*100, 6) }}</strong></td>
                                            <td class="p-3 border-b">cm/s</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Period Section --}}
                        <div>
                            <p class="w-full mt-2 font-s-18 text-blue font-bold border-b pb-2"><strong>{{ $lang[4] }}</strong></p>
                            <div class="w-full md:w-[70%] lg:w-[70%] mt-4 overflow-auto">
                                <table class="w-full font-s-18 border-collapse">
                                    <tbody>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['t'], 10) }}</strong></td>
                                            <td class="p-3 border-b">sec</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ sprintf("%.4e", $detail['t']*1e12) }}</strong></td>
                                            <td class="p-3 border-b">{{ $lang['5'] }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ sprintf("%.4e", $detail['t']*1e9) }}</strong></td>
                                            <td class="p-3 border-b">{{ $lang['6'] }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['t']*1e6, 6) }}</strong></td>
                                            <td class="p-3 border-b">{{ $lang['7'] }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['t']*1000, 6) }}</strong></td>
                                            <td class="p-3 border-b">{{ $lang['8'] }}</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['t']*0.016667, 10) }}</strong></td>
                                            <td class="p-3 border-b">{{ $lang['9'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Wave Number Section --}}
                        <div>
                            <p class="w-full mt-2 font-s-18 text-blue font-bold border-b pb-2"><strong>{{ $lang[10] }}</strong></p>
                            <div class="w-full md:w-[70%] lg:w-[70%] mt-4 overflow-auto">
                                <table class="w-full font-s-18 border-collapse">
                                    <tbody>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['vn'], 6) }}</strong></td>
                                            <td class="p-3 border-b">1/m</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['vn']*0.001, 8) }}</strong></td>
                                            <td class="p-3 border-b">1/mm</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['vn']*0.01, 8) }}</strong></td>
                                            <td class="p-3 border-b">1/cm</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['vn']*1000, 4) }}</strong></td>
                                            <td class="p-3 border-b">1/km</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['vn']*0.0254, 8) }}</strong></td>
                                            <td class="p-3 border-b">1/in</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['vn']*0.3048, 8) }}</strong></td>
                                            <td class="p-3 border-b">1/ft</td>
                                        </tr>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['vn']*0.9144, 8) }}</strong></td>
                                            <td class="p-3 border-b">1/yd</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Steps Section --}}
                        <div class="bg-blue-50 p-6 rounded-xl space-y-4">
                            <p class="font-s-20 text-blue font-bold"><strong>{{ $lang['11'] }}</strong></p>
                            <div class="space-y-2 font-s-16">
                                <p>{{ $lang['1'] }} = {{ $detail['frequency'] }} Hz</p>
                                <p>{{ $lang['2'] }} = {{ $detail['wavelength'] }} m</p>
                            </div>
                            
                            <p class="font-s-20 text-blue font-bold pt-4"><strong>{{ $lang['12'] }}</strong></p>
                            
                            <div class="space-y-6">
                                {{-- Speed Step --}}
                                <div class="space-y-2">
                                    <p class="text-blue font-semibold underline">{{ $lang['13'] }} {{ $lang['3'] }}</p>
                                    <p>\( \text{ {{ $lang['3'] }} = } f \lambda \)</p>
                                    <p>\( \text{ {{ $lang['3'] }} = } {{ $detail['frequency'] }} \times {{ $detail['wavelength'] }} \)</p>
                                    <p class="font-bold">\( \text{ {{ $lang['3'] }} = } {{ round($detail['v'], 3) }} \text{ m/s} \)</p>
                                </div>

                                {{-- Period Step --}}
                                <div class="space-y-2">
                                    <p class="text-blue font-semibold underline">{{ $lang['13'] }} {{ $lang['4'] }}</p>
                                    <p>\( \text{ {{ $lang['4'] }} = } \dfrac{1}{ \text{ {{ $lang['1'] }} }} \)</p>
                                    <p>\( \text{ {{ $lang['4'] }} = } \dfrac{1}{ {{ $detail['frequency'] }} } \)</p>
                                    <p class="font-bold">\( \text{ {{ $lang['4'] }} = } {{ round($detail['t'], 8) }} \text{ sec} \)</p>
                                </div>

                                {{-- Wave Number Step --}}
                                <div class="space-y-2">
                                    <p class="text-blue font-semibold underline">{{ $lang['13'] }} {{ $lang['10'] }}</p>
                                    <p>\( \text{ {{ $lang['10'] }} = } \dfrac{1}{ \lambda } \)</p>
                                    <p>\( \text{ {{ $lang['10'] }} = } \dfrac{1}{ {{ $detail['wavelength'] }} } \)</p>
                                    <p class="font-bold">\( \text{ {{ $lang['10'] }} = } {{ round($detail['vn'], 3) }} \text{ 1/m} \)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
    @endpush
</div>
