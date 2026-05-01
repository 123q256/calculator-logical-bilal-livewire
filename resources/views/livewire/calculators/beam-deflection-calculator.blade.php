<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[90%] md:w-[90%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-4">
                    {{-- Left Column: Controls --}}
                    <div class="col-span-12 lg:col-span-6 space-y-4">
                        <div>
                            <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="operations" id="operations" class="input">
                                    <option value="1">{{ $lang[2] }}</option>
                                    <option value="2">{{ $lang[3] }}</option>
                                </select>
                            </div>
                        </div>

                        @if($operations == '1')
                            <div>
                                <label for="shape_1" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                                <div class="w-full py-2">
                                    <select wire:model.live="shape_1" id="shape_1" class="input">
                                        <option value="1">{{ $lang[5] }}</option>
                                        <option value="2">{{ $lang[6] }}</option>
                                        <option value="3">{{ $lang[7] }}</option>
                                        <option value="4">{{ $lang[8] }}</option>
                                        <option value="5">{{ $lang[9] }}</option>
                                        <option value="6">{{ $lang[10] }}</option>
                                    </select>
                                </div>
                            </div>
                        @else
                            <div>
                                <label for="shape_2" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                                <div class="w-full py-2">
                                    <select wire:model.live="shape_2" id="shape_2" class="input">
                                        <option value="1">{{ $lang[11] }}</option>
                                        <option value="2">{{ $lang[6] }}</option>
                                        <option value="3">{{ $lang[7] }}</option>
                                        <option value="4">{{ $lang[12] }}</option>
                                        <option value="5">{{ $lang[13] }}</option>
                                        <option value="6">{{ $lang[14] }}</option>
                                    </select>
                                </div>
                            </div>
                        @endif

                        {{-- Dynamic Inputs based on selection --}}
                        {{-- Length L (f1) - Always visible --}}
                        <div>
                            <label for="first" class="font-s-14 text-blue">{{ $lang[15] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="first" id="first" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label wire:click="toggleDropdown('unit1')" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit1 }} ▾</label>
                                @if($openDropdown == 'unit1')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['cm','mm','m','in','ft','yd'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit1', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Uniform Load (f6) --}}
                        @php
                            $showF6 = ($operations == '1' && in_array($shape_1, ['3','4','5'])) || ($operations == '2' && in_array($shape_2, ['3','4','5']));
                        @endphp
                        @if($showF6)
                            <div>
                                <label for="six" class="font-s-14 text-blue">@if($operations == '1' && in_array($shape_1, ['4','5'])) {{ $lang[28] }} @else {{ $lang[16] }} @endif:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="six" id="six" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                    <label wire:click="toggleDropdown('unit6')" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit6 }} ▾</label>
                                    @if($openDropdown == 'unit6')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach(['N/m','kN/m','ibf/in','ibf/ft','dyn/cm','kip/ft','kip/in'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit6', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Moment M (f7) --}}
                        @php
                            $showF7 = ($operations == '1' && $shape_1 == '6') || ($operations == '2' && $shape_2 == '6');
                        @endphp
                        @if($showF7)
                            <div>
                                <label for="seven" class="font-s-14 text-blue">{{ $lang[17] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="seven" id="seven" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                    <label wire:click="toggleDropdown('unit7')" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit7 }} ▾</label>
                                    @if($openDropdown == 'unit7')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach(['N.m','kgf.cm','J/rad','ibf.ft','ibf.in'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit7', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Point Load (f2) --}}
                        @php
                            $showF2 = ($operations == '1' && in_array($shape_1, ['1','2'])) || ($operations == '2' && in_array($shape_2, ['1','2']));
                        @endphp
                        @if($showF2)
                            <div>
                                <label for="second" class="font-s-14 text-blue">{{ $lang[18] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="second" id="second" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                    <label wire:click="toggleDropdown('unit2')" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit2 }} ▾</label>
                                    @if($openDropdown == 'unit2')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach(['N','kN','MN','GN','TN','ibf','kip'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit2', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Young's Modulus (f3) - Always visible --}}
                        <div>
                            <label for="third" class="font-s-14 text-blue">{{ $lang[19] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="third" id="third" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label wire:click="toggleDropdown('unit3')" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit3 }} ▾</label>
                                @if($openDropdown == 'unit3')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['Pa','psi','kPa','MPa','GPa','kN/m²'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit3', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Right Column: Image and other inputs --}}
                    <div class="col-span-12 lg:col-span-6 space-y-4">
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <img src="{{ $this->getBeamImage() }}" alt="beam image" class="max-w-full h-auto mx-auto shadow-sm rounded">
                        </div>

                        {{-- Moment of Inertia (f4) - Always visible --}}
                        <div>
                            <label for="four" class="font-s-14 text-blue">{{ $lang[20] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model="four" id="four" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                <label wire:click="toggleDropdown('unit4')" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit4 }} ▾</label>
                                @if($openDropdown == 'unit4')
                                    <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                        @foreach(['m⁴','cm⁴','mm⁴','in⁴','ft⁴'] as $u)
                                            <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit4', '{{ $u }}')">{{ $u }}</p>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Distance a (f5) --}}
                        @php
                            $showF5 = ($operations == '1' && $shape_1 == '2') || ($operations == '2' && $shape_2 == '2');
                        @endphp
                        @if($showF5)
                            <div>
                                <label for="five" class="font-s-14 text-blue">{{ $lang[21] }}:</label>
                                <div class="relative w-full mt-[7px]">
                                    <input type="number" wire:model="five" id="five" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" />
                                    <label wire:click="toggleDropdown('unit5')" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit5 }} ▾</label>
                                    @if($openDropdown == 'unit5')
                                        <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                            @foreach(['m','mm','cm','in','ft','yd'] as $u)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('unit5', '{{ $u }}')">{{ $u }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Shape Extra (f_ex) --}}
                        @php
                            $showEx = ($operations == '1' && in_array($shape_1, ['4','6']));
                        @endphp
                        @if($showEx)
                            <div>
                                <label for="shape1_extra" class="font-s-14 text-blue">{{ $lang['22'] }}:</label>
                                <div class="w-full py-2">
                                    <select wire:model="shape1_extra" id="shape1_extra" class="input">
                                        <option value="1">{{ $lang[23] }}</option>
                                        <option value="2">{{ $lang[24] }}</option>
                                    </select>
                                </div>
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
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="w-full md:w-[70%] lg:w-[70%]">
                                    <table class="w-full font-s-18 border-collapse">
                                        <tbody>
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="p-3 border-b">{{ $lang[25] }}</td>
                                                <td class="p-3 border-b">
                                                    <div class="flex items-center gap-4">
                                                        <strong class="text-blue">{{ round($this->convertResult($detail['stiffness'], 'stiffness'), 4) }}</strong>
                                                        <div class="relative">
                                                            <button type="button" wire:click="toggleDropdown('res_unit1')" class="text-sm px-3 py-1 border border-blue-200 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors">
                                                                {{ $res_unit1 }} ▾
                                                            </button>
                                                            @if($openDropdown == 'res_unit1')
                                                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg min-w-[100px]">
                                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('res_unit1', 'MN·m²')">MN·m²</p>
                                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('res_unit1', 'kN·m²')">kN·m²</p>
                                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('res_unit1', 'N·m²')">N·m²</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="p-3 border-b">{{ $lang[26] }}</td>
                                                <td class="p-3 border-b">
                                                    <div class="flex items-center gap-4">
                                                        <strong class="text-blue">{{ round($this->convertResult($detail['max_def'], 'deflection'), 4) }}</strong>
                                                        <div class="relative">
                                                            <button type="button" wire:click="toggleDropdown('res_unit2')" class="text-sm px-3 py-1 border border-blue-200 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors">
                                                                {{ $res_unit2 }} ▾
                                                            </button>
                                                            @if($openDropdown == 'res_unit2')
                                                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg min-w-[100px]">
                                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('res_unit2', 'mm')">mm</p>
                                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('res_unit2', 'cm')">cm</p>
                                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('res_unit2', 'm')">m</p>
                                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('res_unit2', 'in')">in</p>
                                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('res_unit2', 'ft')">ft</p>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @if (isset($detail['distance_b']))
                                                <tr class="hover:bg-gray-50 transition-colors">
                                                    <td class="p-3 border-b">{{ $lang[27] }}</td>
                                                    <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['distance_b'], 4) }} m</strong></td>
                                                </tr>
                                            @endif
                                            @if (isset($detail['x']))
                                                <tr class="hover:bg-gray-50 transition-colors">
                                                    <td class="p-3 border-b">x</td>
                                                    <td class="p-3 border-b"><strong class="text-blue">{{ round($detail['x'], 4) }} m</strong></td>
                                                </tr>
                                            @endif
                                        </tbody>
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
