<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-4">
                    {{-- Gender --}}
                    <div class="space-y-2 relative">
                        <label for="gender" class="label">{!! $lang['gender'] !!}:</label>
                        <select wire:model.live="gender" id="gender" class="input">
                            <option value="Male">{!! $lang['male'] !!}</option>
                            <option value="Female">{!! $lang['female'] !!}</option>
                        </select>
                    </div>

                    {{-- Weight --}}
                    <div class="space-y-2">
                        <label for="weight" class="label">{{ $lang['weight'] }}:</label>
                        <div class="relative w-auto" x-data="{ open: false, unit: @entangle('unit') }">
                            <input type="number" step="any" wire:model.live="weight" id="weight" class="input" placeholder="00" />
                            <span class="absolute right-3 top-4 cursor-pointer text-sm underline" @click="open = !open">
                                <span x-text="unit"></span> ▾
                            </span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                <p @click="$wire.set('unit', 'lbs'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">pounds (lbs)</p>
                                <p @click="$wire.set('unit', 'kg'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">kilograms (kg)</p>
                            </div>
                        </div>
                    </div>

                    {{-- Height --}}
                    <div class="space-y-2" x-data="{ unit_h: @entangle('unit_h') }">
                        <label class="label">{!! $lang['height'] !!}:</label>
                        
                        <div class="flex space-x-2" x-show="unit_h === 'ft/in'" x-cloak>
                            <div class="w-1/2">
                                <input type="number" step="any" wire:model.live="height_ft" id="height_ft" class="input" placeholder="ft" />
                            </div>
                            <div class="w-1/2 relative" x-data="{ open: false }">
                                <input type="number" step="any" wire:model.live="height_in" id="height_in" class="input" placeholder="in" />
                                <span class="absolute right-3 top-4 cursor-pointer text-sm underline" @click="open = !open">
                                    <span x-text="unit_h"></span> ▾
                                </span>
                                <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p @click="$wire.set('unit_h', 'ft/in'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">feet / inches (ft/in)</p>
                                    <p @click="$wire.set('unit_h', 'cm'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">centimeters (cm)</p>
                                </div>
                            </div>
                        </div>

                        <div class="relative" x-show="unit_h === 'cm'" x-cloak x-data="{ open: false }">
                            <input type="number" step="any" wire:model.live="height_cm" id="height_cm" class="input" placeholder="cm" />
                            <span class="absolute right-3 top-4 cursor-pointer text-sm underline" @click="open = !open">
                                <span x-text="unit_h"></span> ▾
                            </span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                <p @click="$wire.set('unit_h', 'ft/in'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">feet / inches (ft/in)</p>
                                <p @click="$wire.set('unit_h', 'cm'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">centimeters (cm)</p>
                            </div>
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
                            <div class="w-full mt-2">
                                <table class="w-full" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-blue text-start font-s-18 border-b py-3">{{ $lang['formula'] }}</th>
                                            <th class="text-blue text-start font-s-18 border-b py-3">m<sup>2</sup></th>
                                            <th class="text-blue text-start font-s-18 border-b py-3">ft<sup>2</sup></th>
                                            <th class="text-blue text-start font-s-18 border-b py-3">in<sup>2</sup></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="border-b py-3"><strong>DuBois</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['DuBois']!='')?$detail['DuBois']:'0') }}</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['DuBois']!='')?round($detail['DuBois'] * 10.764,2):'0') }}</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['DuBois']!='')?round($detail['DuBois'] * 1550.003,2):'0') }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3"><strong>Mosteller</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Mosteller']!='')?$detail['Mosteller']:'0') }}</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Mosteller']!='')?round($detail['Mosteller'] * 10.764,2):'0') }}</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Mosteller']!='')?round($detail['Mosteller'] * 1550.003,2):'0') }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3"><strong>Haycock</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Haycock']!='')?$detail['Haycock']:'0') }}</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Haycock']!='')?round($detail['Haycock'] * 10.764,2):'0') }}</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Haycock']!='')?round($detail['Haycock'] * 1550.003,2):'0') }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3"><strong>Gehan</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Gehan']!='')?$detail['Gehan']:'0') }}</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Gehan']!='')?round($detail['Gehan'] * 10.764,2):'0') }}</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Gehan']!='')?round($detail['Gehan'] * 1550.003,2):'0') }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3"><strong>Boyd</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Boyd']!='')?$detail['Boyd']:'0') }}</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Boyd']!='')?round($detail['Boyd'] * 10.764,2):'0') }}</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Boyd']!='')?round($detail['Boyd'] * 1550.003,2):'0') }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3"><strong>Fujimoto</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Fujimoto']!='')?$detail['Fujimoto']:'0') }}</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Fujimoto']!='')?round($detail['Fujimoto'] * 10.764,2):'0') }}</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Fujimoto']!='')?round($detail['Fujimoto'] * 1550.003,2):'0') }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3"><strong>Takahira</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Takahira']!='')?$detail['Takahira']:'0') }}</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Takahira']!='')?round($detail['Takahira'] * 10.764,2):'0') }}</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Takahira']!='')?round($detail['Takahira'] * 1550.003,2):'0') }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-3"><strong>Schlich</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Schlich']!='')?$detail['Schlich']:'0') }}</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Schlich']!='')?round($detail['Schlich'] * 10.764,2):'0') }}</strong></td>
                                            <td class="border-b"><strong>{{ (($detail['Schlich']!='')?round($detail['Schlich'] * 1550.003,2):'0') }}</strong></td>
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
        @endif
    </form>
</div>
