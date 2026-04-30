<div x-data="{ mass_unit_open: false, velocity_unit_open: false, height_unit_open: false }">
<form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12" wire:ignore>
                <b class="col s12 center">$$\text{ME} = \frac{1}{2}m{v}^{2}+mgh$$</b>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="mass" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model="mass" id="mass" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00"/>
                    <label for="mass_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="mass_unit_open = !mass_unit_open">{{ $mass_unit }} ▾</label>
                    <div x-show="mass_unit_open" @click.away="mass_unit_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'kg'); mass_unit_open = false">kg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'g'); mass_unit_open = false">g</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'mg'); mass_unit_open = false">mg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'mu-gr'); mass_unit_open = false">mu-gr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'ct'); mass_unit_open = false">ct</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'lbs'); mass_unit_open = false">lbs</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'troy'); mass_unit_open = false">troy</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'ozm'); mass_unit_open = false">ozm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'slug'); mass_unit_open = false">slug</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('mass_unit', 'ton(short)'); mass_unit_open = false">ton(short)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="velocity" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model="velocity" id="velocity" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00"/>
                    <label for="velocity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="velocity_unit_open = !velocity_unit_open">{{ $velocity_unit }} ▾</label>
                    <div x-show="velocity_unit_open" @click.away="velocity_unit_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('velocity_unit', 'm/s'); velocity_unit_open = false">m/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('velocity_unit', 'ft/min'); velocity_unit_open = false">ft/min</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('velocity_unit', 'ft/s'); velocity_unit_open = false">ft/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('velocity_unit', 'km/hr'); velocity_unit_open = false">km/hr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('velocity_unit', 'knot (int\'l)'); velocity_unit_open = false">knot (int'l)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('velocity_unit', 'mph'); velocity_unit_open = false">mph</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('velocity_unit', '{{ $lang[29] }}/hr'); velocity_unit_open = false">{{ $lang[29] }}/hr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('velocity_unit', '{{ $lang[29] }}/min'); velocity_unit_open = false">{{ $lang[29] }}/min</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('velocity_unit', '{{ $lang[29] }}/s'); velocity_unit_open = false">{{ $lang[29] }}/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('velocity_unit', '{{ $lang[30] }}'); velocity_unit_open = false">{{ $lang[30] }}</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="height" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" wire:model="height" id="height" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" aria-label="input" placeholder="00"/>
                    <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" @click="height_unit_open = !height_unit_open">{{ $height_unit }} ▾</label>
                    <div x-show="height_unit_open" @click.away="height_unit_open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0" x-cloak>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'm'); height_unit_open = false">m</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'AU'); height_unit_open = false">AU</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'cm'); height_unit_open = false">cm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'km'); height_unit_open = false">km</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'ft'); height_unit_open = false">ft</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'in'); height_unit_open = false">in</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'mil'); height_unit_open = false">mil</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'mm'); height_unit_open = false">mm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'nm'); height_unit_open = false">nm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'mile'); height_unit_open = false">mile</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'parsec'); height_unit_open = false">parsec</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'pm'); height_unit_open = false">pm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" @click="$wire.set('height_unit', 'yd'); height_unit_open = false">yd</p>
                    </div>
                 </div>
            </div>
          
            <div class="col-span-12 md:col-span-6 lg:col-span-6 div_center">
                <label for="engergyunit" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" wire:model.live="engergyunit" id="engergyunit">
                        <option value="1">{{ $lang[5] }} (J)</option>
                        <option value="2">{{ $lang[6] . $lang[7] }} </option>
                        <option value="3">{{ $lang[6] . $lang[8] }}</option>
                        <option value="4">{{ $lang[9] . $lang[10] }}</option>
                        <option value="5">{{ $lang[11] }}</option>
                        <option value="6">{{ $lang[12] . $lang[13] }}</option>
                        <option value="7">{{ $lang[14] }}</option>
                        <option value="8">{{ $lang[15] }}</option>
                        <option value="9">{{ $lang[16] }}</option>
                        <option value="10">{{ $lang[17] . $lang[18] }}</option>
                        <option value="11">{{ $lang[19] . $lang[20] }}</option>
                        <option value="12">{{ $lang[21] }}</option>
                        <option value="13">{{ $lang[22] . $lang[23] }}</option>
                        <option value="14">{{ $lang[24] . $lang[25] }}</option>
                        <option value="15">{{ $lang[26] . $lang[27] }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
     @if ($type == 'calculator')
     @include('inc.button')
    @endif
    @if ($type=='widget')
    @include('inc.widget-button')
     @endif
 </div>
 <hr>
    @isset($detail)
    
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full text-[20px]">
                            @if ($engergyunit == '1')
                                <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang[31] }} </strong></td>
                                            <td class="py-2 border-b"> {{ round($detail['mechanical_energy'], 4) }} Joule</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang[32] }} </strong></td>
                                            <td class="py-2 border-b"> {{ round($detail['kinatic_engrgy'], 4) }} Joule</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang[33] }} </strong></td>
                                            <td class="py-2 border-b"> {{ round($detail['potentional_engergy'], 4) }} Joule</td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($engergyunit == '2')
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[31] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['mechanical_energy'], 4) }} BTU</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[32] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['kinatic_engrgy'], 4) }} BTU</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[33] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['potentional_engergy'], 4) }} BTU</td>
                                    </tr>
                                </table>
                            </div>
                            @elseif($engergyunit == '3')
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[31] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['mechanical_energy'], 4) }} BTU</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[32] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['kinatic_engrgy'], 4) }} BTU</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[33] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['potentional_engergy'], 4) }} BTU</td>
                                    </tr>
                                </table>
                            </div>
                            @elseif($engergyunit == '4')
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[31] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['mechanical_energy'], 4) }} cal</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[32] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['kinatic_engrgy'], 4) }} cal</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[33] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['potentional_engergy'], 4) }} cal</td>
                                    </tr>
                                </table>
                            </div>
                            @elseif($engergyunit == '5')
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[31] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['mechanical_energy'] / 1e21, 3) * 1e21 }} eV</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[32] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['kinatic_engrgy'] / 1e21, 3) * 1e21 }} eV</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[33] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['potentional_engergy'] / 1e21, 3) * 1e21 }} eV</td>
                                    </tr>
                                </table>
                            </div>
                            @elseif($engergyunit == '6')
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[31] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['mechanical_energy'], 5) }} erg</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[32] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['kinatic_engrgy'], 5)  }} erg</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[33] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['potentional_engergy'], 5) }} erg</td>
                                    </tr>
                                </table>
                            </div>
                            @elseif($engergyunit == '7')
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[31] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['mechanical_energy'], 3) }} ft⋅lbf</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[32] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['kinatic_engrgy'], 3)  }} ft⋅lbf</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[33] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['potentional_engergy'], 3) }} ft⋅lbf</td>
                                    </tr>
                                </table>
                            </div>
                            @elseif($engergyunit == '8')
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[31] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['mechanical_energy'], 3) }} ft-pdl</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[32] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['kinatic_engrgy'], 3)  }} ft-pdl</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[33] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['potentional_engergy'], 3) }} ft-pdl</td>
                                    </tr>
                                </table>
                            </div>
                            @elseif($engergyunit == '9')
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[31] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['mechanical_energy'], 5) }} hp.h</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[32] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['kinatic_engrgy'], 5)  }} hp.h</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[33] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['potentional_engergy'], 5) }} hp.h</td>
                                    </tr>
                                </table>
                            </div>
                            @elseif($engergyunit == '10')
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[31] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['mechanical_energy'], 5) }} kcal</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[32] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['kinatic_engrgy'], 5)  }} kcal</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[33] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['potentional_engergy'], 5) }} kcal</td>
                                    </tr>
                                </table>
                            </div>
                            @elseif($engergyunit == '11')
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[31] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['mechanical_energy'], 5) }} kW hr</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[32] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['kinatic_engrgy'], 5)  }} kW hr</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[33] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['potentional_engergy'], 5) }} kW hr</td>
                                    </tr>
                                </table>
                            </div>
                            @elseif($engergyunit == '12')
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[31] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['mechanical_energy'], 10) }} tTNT</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[32] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['kinatic_engrgy'], 10)  }} tTNT</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[33] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['potentional_engergy'], 10) }} tTNT</td>
                                    </tr>
                                </table>
                            </div>
                            @elseif($engergyunit == '13')
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[31] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['mechanical_energy'], 5) }} V Cb</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[32] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['kinatic_engrgy'], 5)  }} V Cb</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[33] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['potentional_engergy'], 5) }} V Cb</td>
                                    </tr>
                                </table>
                            </div>
                            @elseif($engergyunit == '14')
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[31] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['mechanical_energy'], 5) }} W hr</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[32] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['kinatic_engrgy'], 5)  }} W hr</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[33] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['potentional_engergy'], 5) }} W hr</td>
                                    </tr>
                                </table>
                            </div>
                            @elseif($engergyunit == '15')
                            <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[31] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['mechanical_energy'], 5) }} W sec</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[32] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['kinatic_engrgy'], 5)  }} W sec</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[33] }} </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['potentional_engergy'], 5) }} W sec</td>
                                    </tr>
                                </table>
                            </div>
                            @endif
                            <div class="col">
                                <p class="mt-2"><strong>{{ $lang[34] }} :</strong></p>
                                <p class="mt-2">\(\text {Here :}\)</p>
                                <p class="mt-2">\(\text { {{ $lang[1] }} unit = kg}\)</p>
                                <p class="mt-2">\(\text { {{ $lang[2] }} unit = m/s}\)</p>
                                <p class="mt-2">\(\text { {{ $lang[3] }} unit = m}\)</p>
                                <p class="mt-2">\(\text{ {{ $lang[1] }}} = {{{ round($detail['mass'], 4) }}} kg\)</p>
                                <p class="mt-2">\(\text{ {{ $lang[2] }}} = {{{ round($detail['velocity'], 4) }}} m/s\)</p>
                                <p class="mt-2">\(\text{ {{ $lang[3] }}} = {{{ round($detail['height'], 4) }}} m\)</p>
                                <p class="mt-2">\(\text{ME} = \frac{1}{2}m{v}^{2}+mgh\)</p>
                                <p class="mt-2">\(\text{ME} = \frac{1}{2}({{ round($detail['mass'], 4) }})  ({{{ round($detail['velocity'], 4) }}})^{2}+({{{ round($detail['mass'], 4) }}})(9.8)({{{ round($detail['height'], 4) }}})\)</p>
                                <p class="mt-2">\(\text{ME} = ({{{ round($detail['kinatic_eng'], 4) }}})+({{{ round($detail['potentional_eng'], 4) }}})\)</p>
                                <p class="mt-2">\(\text{ME} = {{{ round($detail['mechanical_eng'], 4) }}} J\)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

    @push('calculatorJS')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
        <script type="text/x-mathjax-config">
        MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
    </script>
    @endpush
</form>

</div>

