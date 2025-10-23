<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12">
                <b class="col s12 center">$$\text{ME} = \frac{1}{2}m{v}^{2}+mgh$$</b>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="mass" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="mass" id="mass" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['mass']) ? $_POST['mass'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="mass_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('mass_unit_dropdown')">{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'kg' }} ▾</label>
                    <input type="text" name="mass_unit" value="{{ isset($_POST['mass_unit'])?$_POST['mass_unit']:'kg' }}" id="mass_unit" class="hidden">
                    <div id="mass_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="mass_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'kg')">kg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'g')">g</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'mg')">mg</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'mu-gr')">mu-gr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'ct')">ct</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'lbs')">lbs</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'troy')">troy</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'ozm')">ozm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'slug')">slug</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('mass_unit', 'ton(short)')">ton(short)</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="velocity" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="velocity" id="velocity" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['velocity']) ? $_POST['velocity'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="velocity_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('velocity_unit_dropdown')">{{ isset($_POST['velocity_unit'])?$_POST['velocity_unit']:'m/s' }} ▾</label>
                    <input type="text" name="velocity_unit" value="{{ isset($_POST['velocity_unit'])?$_POST['velocity_unit']:'m/s' }}" id="velocity_unit" class="hidden">
                    <div id="velocity_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="velocity_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'm/s')">m/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'ft/min')">ft/min</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'ft/s')">ft/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'km/hr')">km/hr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'knot (int'l)')">knot (int'l)</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', 'mph')">mph</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', '{{ $lang[29] }}/hr')">{{ $lang[29] }}/hr</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', '{{ $lang[29] }}/min')">{{ $lang[29] }}/min</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', '{{ $lang[29] }}/s')">{{ $lang[29] }}/s</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('velocity_unit', '{{ $lang[30] }}')">{{ $lang[30] }}</p>
                    </div>
                 </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="height" class="font-s-14 text-blue">{{ $lang['3'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="height" id="height" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height']) ? $_POST['height'] : '1200' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('height_unit_dropdown')">{{ isset($_POST['height_unit'])?$_POST['height_unit']:'m' }} ▾</label>
                    <input type="text" name="height_unit" value="{{ isset($_POST['height_unit'])?$_POST['height_unit']:'m' }}" id="height_unit" class="hidden">
                    <div id="height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="height_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'm')">m</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'AU')">AU</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'cm')">cm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'km')">km</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'ft')">ft</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'in')">in</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'mil')">mil</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'mm')">mm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'nm')">nm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'mile')">mile</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'parsec')">parsec</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'pm')">pm</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('height_unit', 'yd')">yd</p>
                    </div>
                 </div>
            </div>
          
            <div class="col-span-12 md:col-span-6 lg:col-span-6 div_center">
                <label for="engergyunit" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="engergyunit" id="engergyunit">
                        <option value="1"
                            {{ isset($_POST['engergyunit']) && $_POST['engergyunit'] == '1' ? 'selected' : '' }}>
                            {{ $lang[5] }} (J)</option>
                        <option value="2"
                            {{ isset($_POST['engergyunit']) && $_POST['engergyunit'] == '2' ? 'selected' : '' }}>
                            {{ $lang[6] . $lang[7] }} </option>
                        <option value="3"
                            {{ isset($_POST['engergyunit']) && $_POST['engergyunit'] == '3' ? 'selected' : '' }}>
                            {{ $lang[6] . $lang[8] }}</option>
                        <option value="4"
                            {{ isset($_POST['engergyunit']) && $_POST['engergyunit'] == '4' ? 'selected' : '' }}>
                            {{ $lang[9] . $lang[10] }}</option>
                        <option value="5"
                            {{ isset($_POST['engergyunit']) && $_POST['engergyunit'] == '5' ? 'selected' : '' }}>
                            {{ $lang[11] }}</option>
                        <option value="6"
                            {{ isset($_POST['engergyunit']) && $_POST['engergyunit'] == '6' ? 'selected' : '' }}>
                            {{ $lang[12] . $lang[13] }}</option>
                        <option value="7"
                            {{ isset($_POST['engergyunit']) && $_POST['engergyunit'] == '7' ? 'selected' : '' }}>
                            {{ $lang[14] }}</option>
                        <option value="8"
                            {{ isset($_POST['engergyunit']) && $_POST['engergyunit'] == '8' ? 'selected' : '' }}>
                            {{ $lang[15] }}</option>
                        <option value="9"
                            {{ isset($_POST['engergyunit']) && $_POST['engergyunit'] == '9' ? 'selected' : '' }}>
                            {{ $lang[16] }}</option>
                        <option value="10"
                            {{ isset($_POST['engergyunit']) && $_POST['engergyunit'] == '10' ? 'selected' : '' }}>
                            {{ $lang[17] . $lang[18] }}</option>
                        <option value="11"
                            {{ isset($_POST['engergyunit']) && $_POST['engergyunit'] == '11' ? 'selected' : '' }}>
                            {{ $lang[19] . $lang[20] }}</option>
                        <option value="12"
                            {{ isset($_POST['engergyunit']) && $_POST['engergyunit'] == '12' ? 'selected' : '' }}>
                            {{ $lang[21] }}</option>
                        <option value="13"
                            {{ isset($_POST['engergyunit']) && $_POST['engergyunit'] == '13' ? 'selected' : '' }}>
                            {{ $lang[22] . $lang[23] }}</option>
                        <option value="14"
                            {{ isset($_POST['engergyunit']) && $_POST['engergyunit'] == '14' ? 'selected' : '' }}>
                            {{ $lang[24] . $lang[25] }}</option>
                        <option value="15"
                            {{ isset($_POST['engergyunit']) && $_POST['engergyunit'] == '15' ? 'selected' : '' }}>
                            {{ $lang[26] . $lang[27] }}</option>
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
    @isset($detail)
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full text-[20px]">
                            @if (isset($_POST['engergyunit']) && $_POST['engergyunit'] == '1')
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
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
                            @elseif(isset($_POST['engergyunit']) && $_POST['engergyunit'] == '2')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
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
                            @elseif(isset($_POST['engergyunit']) && $_POST['engergyunit'] == '3')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
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
                            @elseif(isset($_POST['engergyunit']) && $_POST['engergyunit'] == '4')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
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
                            @elseif(isset($_POST['engergyunit']) && $_POST['engergyunit'] == '5')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
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
                            @elseif(isset($_POST['engergyunit']) && $_POST['engergyunit'] == '6')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
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
                            @elseif(isset($_POST['engergyunit']) && $_POST['engergyunit'] == '7')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
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
                            @elseif(isset($_POST['engergyunit']) && $_POST['engergyunit'] == '8')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
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
                            @elseif(isset($_POST['engergyunit']) && $_POST['engergyunit'] == '9')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
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
                            @elseif(isset($_POST['engergyunit']) && $_POST['engergyunit'] == '10')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
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
                            @elseif(isset($_POST['engergyunit']) && $_POST['engergyunit'] == '11')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
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
                            @elseif(isset($_POST['engergyunit']) && $_POST['engergyunit'] == '12')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
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
                            @elseif(isset($_POST['engergyunit']) && $_POST['engergyunit'] == '13')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
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
                            @elseif(isset($_POST['engergyunit']) && $_POST['engergyunit'] == '14')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
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
                            @elseif(isset($_POST['engergyunit']) && $_POST['engergyunit'] == '15')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
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
