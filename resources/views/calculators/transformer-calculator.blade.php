<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  mt-3  gap-4">  

            <div class="col-span-12 md:col-span-6 lg:col-span-6  transformer_phase hidden">
                <label for="phase_unit" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <i class="fas fa-sort-down color_blue"></i>
                    <select name="phase_unit" id="phase_unit" class="input">
                        <option value="1"
                            {{ isset($_POST['phase_unit']) && $_POST['phase_unit'] == '1' ? 'selected' : '' }}>
                            {{ $lang['2'] }}</option>
                        <option value="2"
                            {{ isset($_POST['phase_unit']) && $_POST['phase_unit'] == '2' ? 'selected' : '' }}>
                            {{ $lang['3'] }}</option>
                    </select>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6  mt-0 mt-lg-2 transformer_rating hidden">
                <label for="transformer_rating" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="transformer_rating" id="transformer_rating" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['transformer_rating']) ? $_POST['transformer_rating'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="transformer_rating_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('transformer_rating_unit_dropdown')">{{ isset($_POST['transformer_rating_unit'])?$_POST['transformer_rating_unit']:'VA' }} ▾</label>
                    <input type="text" name="transformer_rating_unit" value="{{ isset($_POST['transformer_rating_unit'])?$_POST['transformer_rating_unit']:'VA' }}" id="transformer_rating_unit" class="hidden">
                    <div id="transformer_rating_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="transformer_rating_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('transformer_rating_unit', 'VA')">VA</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('transformer_rating_unit', 'kVA')">kVA</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('transformer_rating_unit', 'lb')">lb</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('transformer_rating_unit', 'MVA')">MVA</p>
                    </div>
                 </div>
            </div>
        
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="calculation_unit" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                <div class="w-100 py-2">
                    <i class="fas fa-sort-down color_blue"></i>
                    <select name="calculation_unit" id="calculation_unit" class="input">
                        <option value="1"
                            {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] == '1' ? 'selected' : '' }}>
                            {{ $lang[6] }} & {{ $lang[7] }} ({{ $lang[8] }})</option>
                        <option value="2"
                            {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] == '2' ? 'selected' : '' }}>
                            {{ $lang[9] }} & {{ $lang[7] }} ({{ $lang[8] }})</option>
                        <option value="3"
                            {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] == '3' ? 'selected' : '' }}>
                            {{ $lang[10] }} & {{ $lang[11] }} ({{ $lang[8] }})</option>
                        <option value="4"
                            {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] == '4' ? 'selected' : '' }}>
                            {{ $lang[12] }} & {{ $lang[11] }} ({{ $lang[8] }})</option>
                        <option value="5"
                            {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] == '5' ? 'selected' : '' }}>
                            {{ $lang[13] }} & {{ $lang[7] }} ({{ $lang[8] }})</option>
                        <option value="6"
                            {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] == '6' ? 'selected' : '' }}>
                            {{ $lang[14] }} & {{ $lang[7] }} ({{ $lang[8] }})</option>
                        <option value="7"
                            {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] == '7' ? 'selected' : '' }}>
                            {{ $lang[15] }} & {{ $lang[16] }} ({{ $lang[8] }})</option>
                        <option value="8"
                            {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] == '8' ? 'selected' : '' }}>
                            {{ $lang[15] }} & {{ $lang[17] }} ({{ $lang[8] }})</option>
                        <option value="9"
                            {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] == '9' ? 'selected' : '' }}>
                            {{ $lang[18] }} & {{ $lang[11] }} ({{ $lang[8] }})</option>
                        <option value="10"
                            {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] == '10' ? 'selected' : '' }}>
                            KVA & {{ $lang[19] }}</option>
                        <option value="11"
                            {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] == '11' ? 'selected' : '' }}>
                            {{ $lang[19] }} & {{ $lang[20] }}</option>
                        <option value="12"
                            {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] == '12' ? 'selected' : '' }}>
                            KVA & {{ $lang[20] }} </option>
                        <option value="13"
                            {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] == '13' ? 'selected' : '' }}>
                            {{ $lang[21] }} </option>
                        <option value="14"
                            {{ isset($_POST['calculation_unit']) && $_POST['calculation_unit'] == '14' ? 'selected' : '' }}>
                            {{ $lang[22] }} & {{ $lang[23] }} ({{ $lang[24] }})</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  location hidden">
                <label for="location"
                    class="font-s-14 text-blue">{{ $lang['25'] }}/{{ $lang['26'] }}:</label>
                <div class="w-100 py-2">
                    <i class="fas fa-sort-down color_blue"></i>
                    <select name="location" id="location" class="input">
                        <option value="1" {{ isset($_POST['location']) && $_POST['location'] == '1' ? 'selected' : '' }}> {{ $lang[25] }} </option>
                        <option value="2"{{ isset($_POST['location']) && $_POST['location'] == '2' ? 'selected' : '' }}> {{ $lang[27] }} </option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  impedance hidden">
                <label for="impedance" class="font-s-14 text-blue">% {{ $lang['28'] }} {{ $lang['29'] }} %
                    {{ $lang['30'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="impedance" id="impedance" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['impedance']) ? $_POST['impedance'] : '50' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  mt-0 mt-lg-2 primary_voltage">
                <label for="primary_transformer_voltage" class="font-s-14 text-blue">{{ $lang['31'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="primary_transformer_voltage" id="primary_transformer_voltage" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['primary_transformer_voltage']) ? $_POST['primary_transformer_voltage'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="primary_transformer_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('primary_transformer_unit_dropdown')">{{ isset($_POST['primary_transformer_unit'])?$_POST['primary_transformer_unit']:'VA' }} ▾</label>
                    <input type="text" name="primary_transformer_unit" value="{{ isset($_POST['primary_transformer_unit'])?$_POST['primary_transformer_unit']:'VA' }}" id="primary_transformer_unit" class="hidden">
                    <div id="primary_transformer_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="primary_transformer_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('primary_transformer_unit', 'VA')">VA</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('primary_transformer_unit', 'kVA')">kVA</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('primary_transformer_unit', 'lb')">lb</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('primary_transformer_unit', 'MVA')">MVA</p>
                    </div>
                 </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6  mt-0 mt-lg-2 primary_voltage">
                <label for="secondary_transformer_voltage" class="font-s-14 text-blue">{{ $lang['11'] }}</label>
                <div class="relative w-full mt-[7px]">
                    <input type="number" name="secondary_transformer_voltage" id="secondary_transformer_voltage" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['secondary_transformer_voltage']) ? $_POST['secondary_transformer_voltage'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                    <label for="secondary_transformer_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('secondary_transformer_unit_dropdown')">{{ isset($_POST['secondary_transformer_unit'])?$_POST['secondary_transformer_unit']:'V' }} ▾</label>
                    <input type="text" name="secondary_transformer_unit" value="{{ isset($_POST['secondary_transformer_unit'])?$_POST['secondary_transformer_unit']:'V' }}" id="secondary_transformer_unit" class="hidden">
                    <div id="secondary_transformer_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="secondary_transformer_unit">
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('secondary_transformer_unit', 'V')">V</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('secondary_transformer_unit', 'kV')">kV</p>
                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('secondary_transformer_unit', 'MV')">MV</p>
                    </div>
                 </div>
            </div>
          
          
            <div class="col-span-12 md:col-span-6 lg:col-span-6  primary_winding">
                <label for="primary_winding" class="font-s-14 text-blue"> {{ $lang['32'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="primary_winding" id="primary_winding" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['primary_winding']) ? $_POST['primary_winding'] : '50' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  secondary_winding">
                <label for="secondary_winding" class="font-s-14 text-blue"> {{ $lang['7'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="secondary_winding" id="secondary_winding"
                        class="input" aria-label="input" placeholder="50"
                        value="{{ isset($_POST['secondary_winding']) ? $_POST['secondary_winding'] : '50' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  primary_current hidden">
                <label for="primary_current" class="font-s-14 text-blue"> {{ $lang['33'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="primary_current" id="primary_current" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['primary_current']) ? $_POST['primary_current'] : '50' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  secondary_curren hiddent">
                <label for="secondary_current" class="font-s-14 text-blue"> {{ $lang['34'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="secondary_current" id="secondary_current"
                        class="input" aria-label="input" placeholder="50"
                        value="{{ isset($_POST['secondary_current']) ? $_POST['secondary_current'] : '50' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  kva hidden">
                <label for="kva" class="font-s-14 text-blue"> KVA:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="kva" id="kva" class="input"
                        aria-label="input" placeholder="50" value="{{ isset($_POST['kva']) ? $_POST['kva'] : '50' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  volts hidden">
                <label for="volts" class="font-s-14 text-blue"> {{ $lang[19] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="volts" id="volts" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['volts']) ? $_POST['volts'] : '50' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  amperes hidden">
                <label for="amperes" class="font-s-14 text-blue"> {{ $lang[20] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="amperes" id="amperes" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['amperes']) ? $_POST['amperes'] : '50' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  eddy_current hidden">
                <label for="eddy_current" class="font-s-14 text-blue"> {{ $lang[35] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="eddy_current" id="eddy_current" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['eddy_current']) ? $_POST['eddy_current'] : '50' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  thickness hidden">
                <label for="thickness" class="font-s-14 text-blue"> {{ $lang[36] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="thickness" id="thickness" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['thickness']) ? $_POST['thickness'] : '50' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  flux hidden">
                <label for="flux_density" class="font-s-14 text-blue"> {{ $lang[22] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="flux_density" id="flux_density" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['flux_density']) ? $_POST['flux_density'] : '50' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  frequency hidden">
                <label for="frequency" class="font-s-14 text-blue"> {{ $lang[23] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="frequency" id="frequency" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['frequency']) ? $_POST['frequency'] : '50' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  hysteresis_constant hidden">
                <label for="hysteresis_constant" class="font-s-14 text-blue"> {{ $lang[37] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="hysteresis_constant" id="hysteresis_constant"
                        class="input" aria-label="input" placeholder="50"
                        value="{{ isset($_POST['hysteresis_constant']) ? $_POST['hysteresis_constant'] : '50' }}" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6  number_of_turns hidden">
                <label for="number_of_turns" class="font-s-14 text-blue"> {{ $lang[24] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <input type="number" step="any" name="number_of_turns" id="number_of_turns" class="input"
                        aria-label="input" placeholder="50"
                        value="{{ isset($_POST['number_of_turns']) ? $_POST['number_of_turns'] : '50' }}" />
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
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full font-s-18">
                                @if (isset($detail['primary_full_load_current']) && $detail['primary_full_load_current'] != '')
                                    <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[38] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['primary_full_load_current'] }} (A)</td>
                                    </tr>
                                @endif
                                @if (isset($detail['secondary_full_load_current']) && $detail['secondary_full_load_current'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[39] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['secondary_full_load_current'] }} (A)</td>
                                </tr>
                                @endif
                                @if (isset($detail['turn_ratio']) && $detail['turn_ratio'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[40] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['turn_ratio'] }}</td>
                                </tr>
                                @endif
                                @if (isset($detail['type']) && $detail['type'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[41] }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['type'] }}</td>
                                </tr>
                                @endif
                                @if (isset($detail['impedance_value']) && $detail['impedance_value'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[42] }} (kA) {{$lang[43]}}</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['impedance_value'] }}</td>
                                </tr>
                                @endif
                                @if (isset($detail['calculate_amps']) && $detail['calculate_amps'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{ $lang[20] }}</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['calculate_amps'] }}</td>
                                </tr>
                                @endif
                                @if (isset($detail['calculate_kva']) && $detail['calculate_kva'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>KVA</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['calculate_kva'] }}</td>
                                </tr>
                                @endif
                                @if (isset($detail['calculate_volts']) && $detail['calculate_volts'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{$lang[19]}}</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['calculate_volts'] }}</td>
                                </tr>
                                @endif
                                @if (isset($detail['secondary_voltage']) && $detail['secondary_voltage'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{$lang[11]}}</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['secondary_voltage'] }} ({{ $lang[19] }})</td>
                                </tr>
                                @endif
                                @if (isset($detail['primary_voltage']) && $detail['primary_voltage'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{$lang[31]}}</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['primary_voltage'] }} ({{ $lang[19] }})</td>
                                </tr>
                                @endif
                                @if (isset($detail['secondary']) && $detail['secondary'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{$lang[7]}}</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['secondary_winding'] }} ({{ $lang[19] }})</td>
                                </tr>
                                @endif
                                @if (isset($detail['secondary_current']) && $detail['secondary_current'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{$lang[34]}}</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['secondary_current'] }} ({{ $lang[20] }})</td>
                                </tr>
                                @endif
                                @if (isset($detail['primary_current']) && $detail['primary_current'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{$lang[33]}}</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['primary_current'] }} ({{ $lang[20] }})</td>
                                </tr>
                                @endif
                
                                @if (isset($detail['secondary_winding']) && $detail['secondary_winding'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{$lang[7]}}</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['secondary_winding'] }} </td>
                                </tr>
                                @endif
                                @if (isset($detail['primary_winding']) && $detail['primary_winding'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{$lang[32]}}</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['primary_winding'] }} </td>
                                </tr>
                                @endif
                                @if (isset($detail['total_copper']) && $detail['total_copper'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{$lang[44]}} ,Pcu</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['total_copper'] }} </td>
                                </tr>
                                @endif
                                @if (isset($detail['eddy_current_loss']) && $detail['eddy_current_loss'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{$lang[45]}} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['eddy_current_loss'] }} </td>
                                </tr>
                                @endif
                                @if (isset($detail['hysteresis_loss']) && $detail['hysteresis_loss'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{$lang[46]}} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail['hysteresis_loss'] }} </td>
                                </tr>
                                @endif
                                @if (isset($detail['eddy_current_loss']) && $detail['eddy_current_loss'] != '' && isset($detail['hysteresis_loss']) && $detail['hysteresis_loss'] !='')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>{{$lang[47]}} w/m3</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['hysteresis_loss'] }}+{{ $detail['eddy_current_loss'] }} </td>
                                </tr>
                                @endif
                                @if (isset($detail['rms']) && $detail['rms'] != '')
                                <tr>
                                    <td class="py-2 border-b" width="70%"><strong>R.M.S {{$lang[48]}} EMF</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['rms'] }} </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("calculation_unit").addEventListener("change", function() {
        var selection = this.value;

        var hideElements = function(elements) {
            elements.forEach(function(el) {
                document.querySelectorAll(el).forEach(function(e) {
                    e.classList.add("hidden");
                });
            });
        };

        var showElements = function(elements) {
            elements.forEach(function(el) {
                document.querySelectorAll(el).forEach(function(e) {
                    e.classList.remove("hidden");
                });
            });
        };

        switch (selection) {
            case "1":
                hideElements([
                    ".transformer_rating", ".secondary_voltage", ".primary_current", ".secondary_current",
                    ".kva", ".volts", ".amperes", ".transformer_phase", ".location", ".impedance",
                    ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
                ]);
                showElements([".primary_winding", ".secondary_winding", ".primary_voltage"]);
                break;
            case "2":
                hideElements([
                    ".transformer_rating", ".primary_voltage", ".primary_current", ".secondary_current",
                    ".kva", ".volts", ".amperes", ".transformer_phase", ".location", ".impedance",
                    ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
                ]);
                showElements([".primary_winding", ".secondary_winding", ".secondary_voltage"]);
                break;
            case "3":
                hideElements([
                    ".transformer_rating", ".primary_current", ".secondary_current", ".kva", ".volts",
                    ".amperes", ".transformer_phase", ".secondary_winding", ".location", ".impedance",
                    ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
                ]);
                showElements([".primary_voltage", ".secondary_voltage", ".primary_winding"]);
                break;
            case "4":
                hideElements([
                    ".transformer_rating", ".primary_current", ".secondary_current", ".kva", ".volts",
                    ".amperes", ".transformer_phase", ".primary_winding", ".location", ".impedance",
                    ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
                ]);
                showElements([".primary_voltage", ".secondary_voltage", ".secondary_winding"]);
                break;
            case "5":
                hideElements([
                    ".transformer_rating", ".secondary_current", ".kva", ".volts", ".amperes",
                    ".transformer_phase", ".primary_voltage", ".secondary_voltage", ".location", ".impedance",
                    ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
                ]);
                showElements([".secondary_winding", ".primary_winding", ".primary_current"]);
                break;
            case "6":
                hideElements([
                    ".transformer_rating", ".secondary_current", ".kva", ".volts", ".amperes",
                    ".transformer_phase", ".primary_voltage", ".secondary_voltage", ".location", ".impedance",
                    ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
                ]);
                showElements([".secondary_winding", ".primary_winding", ".secondary_current"]);
                break;
            case "7":
                hideElements([
                    ".transformer_rating", ".secondary_current", ".kva", ".volts", ".amperes",
                    ".transformer_phase", ".primary_voltage", ".secondary_voltage", ".secondary_winding", ".location",
                    ".impedance", ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
                ]);
                showElements([".primary_winding", ".primary_current", ".secondary_current"]);
                break;
            case "8":
                hideElements([
                    ".transformer_rating", ".secondary_current", ".kva", ".volts", ".amperes",
                    ".transformer_phase", ".primary_voltage", ".secondary_voltage", ".primary_winding", ".location",
                    ".impedance", ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
                ]);
                showElements([".secondary_winding", ".primary_current", ".secondary_current"]);
                break;
            case "9":
                hideElements([
                    ".secondary_voltage", ".primary_current", ".secondary_current", ".kva", ".volts",
                    ".amperes", ".primary_winding", ".secondary_winding", ".eddy_current", ".thickness",
                    ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
                ]);
                showElements([
                    ".transformer_phase", ".transformer_rating", ".primary_voltage", ".secondary_voltage", ".location", ".impedance"
                ]);
                break;
            case "10":
                hideElements([
                    ".transformer_rating", ".secondary_voltage", ".primary_current", ".secondary_curren",
                    ".amperes", ".primary_winding", ".secondary_winding", ".primary_voltage", ".location",
                    ".impedance", ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
                ]);
                showElements([".transformer_phase", ".kva", ".volts"]);
                break;
            case "11":
                hideElements([
                    ".transformer_rating", ".secondary_voltage", ".primary_current", ".secondary_curren",
                    ".kva", ".primary_winding", ".secondary_winding", ".primary_voltage", ".location", ".impedance"
                ]);
                showElements([
                    ".transformer_phase", ".amperes", ".volts", ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
                ]);
                break;
            case "12":
                hideElements([
                    ".transformer_rating", ".secondary_voltage", ".primary_current", ".secondary_current",
                    ".volts", ".primary_winding", ".secondary_winding", ".primary_voltage", ".location",
                    ".impedance", ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
                ]);
                showElements([".transformer_phase", ".amperes", ".kva"]);
                break;
            case "13":
                hideElements([
                    ".transformer_rating", ".primary_voltage", ".secondary_voltage", ".kva", ".volts",
                    ".amperes", ".transformer_phase", ".location", ".impedance"
                ]);
                showElements([
                    ".primary_winding", ".secondary_winding", ".secondary_current", ".primary_current", ".eddy_current",
                    ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
                ]);
                break;
            case "14":
                hideElements([
                    ".transformer_rating", ".primary_voltage", ".secondary_voltage", ".kva", ".volts",
                    ".amperes", ".transformer_phase", ".location", ".impedance", ".primary_winding", ".secondary_winding",
                    ".secondary_current", ".primary_current", ".eddy_current", ".thickness", ".hysteresis_constant"
                ]);
                showElements([".flux", ".frequency", ".number_of_turns"]);
                break;
            default:
                break;
        }
    });
});


@if(isset($detail))
    var selection = "{{$_POST['calculation_unit']}}";

    var hideElements = function(elements) {
        elements.forEach(function(el) {
            document.querySelectorAll(el).forEach(function(e) {
                e.classList.add("hidden");
            });
        });
    };

    var showElements = function(elements) {
        elements.forEach(function(el) {
            document.querySelectorAll(el).forEach(function(e) {
                e.classList.remove("hidden");
            });
        });
    };

    switch (selection) {
        case "1":
            hideElements([
                ".transformer_rating", ".secondary_voltage", ".primary_current", ".secondary_current",
                ".kva", ".volts", ".amperes", ".transformer_phase", ".location", ".impedance",
                ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".primary_winding", ".secondary_winding", ".primary_voltage"]);
            break;
        case "2":
            hideElements([
                ".transformer_rating", ".primary_voltage", ".primary_current", ".secondary_current",
                ".kva", ".volts", ".amperes", ".transformer_phase", ".location", ".impedance",
                ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".primary_winding", ".secondary_winding", ".secondary_voltage"]);
            break;
        case "3":
            hideElements([
                ".transformer_rating", ".primary_current", ".secondary_current", ".kva", ".volts",
                ".amperes", ".transformer_phase", ".secondary_winding", ".location", ".impedance",
                ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".primary_voltage", ".secondary_voltage", ".primary_winding"]);
            break;
        case "4":
            hideElements([
                ".transformer_rating", ".primary_current", ".secondary_current", ".kva", ".volts",
                ".amperes", ".transformer_phase", ".primary_winding", ".location", ".impedance",
                ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".primary_voltage", ".secondary_voltage", ".secondary_winding"]);
            break;
        case "5":
            hideElements([
                ".transformer_rating", ".secondary_current", ".kva", ".volts", ".amperes",
                ".transformer_phase", ".primary_voltage", ".secondary_voltage", ".location", ".impedance",
                ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".secondary_winding", ".primary_winding", ".primary_current"]);
            break;
        case "6":
            hideElements([
                ".transformer_rating", ".secondary_current", ".kva", ".volts", ".amperes",
                ".transformer_phase", ".primary_voltage", ".secondary_voltage", ".location", ".impedance",
                ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".secondary_winding", ".primary_winding", ".secondary_current"]);
            break;
        case "7":
            hideElements([
                ".transformer_rating", ".secondary_current", ".kva", ".volts", ".amperes",
                ".transformer_phase", ".primary_voltage", ".secondary_voltage", ".secondary_winding", ".location",
                ".impedance", ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".primary_winding", ".primary_current", ".secondary_current"]);
            break;
        case "8":
            hideElements([
                ".transformer_rating", ".secondary_current", ".kva", ".volts", ".amperes",
                ".transformer_phase", ".primary_voltage", ".secondary_voltage", ".primary_winding", ".location",
                ".impedance", ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".secondary_winding", ".primary_current", ".secondary_current"]);
            break;
        case "9":
            hideElements([
                ".secondary_voltage", ".primary_current", ".secondary_current", ".kva", ".volts",
                ".amperes", ".primary_winding", ".secondary_winding", ".eddy_current", ".thickness",
                ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([
                ".transformer_phase", ".transformer_rating", ".primary_voltage", ".secondary_voltage", ".location", ".impedance"
            ]);
            break;
        case "10":
            hideElements([
                ".transformer_rating", ".secondary_voltage", ".primary_current", ".secondary_curren",
                ".amperes", ".primary_winding", ".secondary_winding", ".primary_voltage", ".location",
                ".impedance", ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".transformer_phase", ".kva", ".volts"]);
            break;
        case "11":
            hideElements([
                ".transformer_rating", ".secondary_voltage", ".primary_current", ".secondary_curren",
                ".kva", ".primary_winding", ".secondary_winding", ".primary_voltage", ".location", ".impedance"
            ]);
            showElements([
                ".transformer_phase", ".amperes", ".volts", ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            break;
        case "12":
            hideElements([
                ".transformer_rating", ".secondary_voltage", ".primary_current", ".secondary_current",
                ".volts", ".primary_winding", ".secondary_winding", ".primary_voltage", ".location",
                ".impedance", ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".transformer_phase", ".amperes", ".kva"]);
            break;
        case "13":
            hideElements([
                ".transformer_rating", ".primary_voltage", ".secondary_voltage", ".kva", ".volts",
                ".amperes", ".transformer_phase", ".location", ".impedance"
            ]);
            showElements([
                ".primary_winding", ".secondary_winding", ".secondary_current", ".primary_current", ".eddy_current",
                ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            break;
        case "14":
            hideElements([
                ".transformer_rating", ".primary_voltage", ".secondary_voltage", ".kva", ".volts",
                ".amperes", ".transformer_phase", ".location", ".impedance", ".primary_winding", ".secondary_winding",
                ".secondary_current", ".primary_current", ".eddy_current", ".thickness", ".hysteresis_constant"
            ]);
            showElements([".flux", ".frequency", ".number_of_turns"]);
            break;
        default:
            break;
    }

@endif

@if(isset($error))
    var selection = "{{$_POST['calculation_unit']}}";

    var hideElements = function(elements) {
        elements.forEach(function(el) {
            document.querySelectorAll(el).forEach(function(e) {
                e.classList.add("hidden");
            });
        });
    };

    var showElements = function(elements) {
        elements.forEach(function(el) {
            document.querySelectorAll(el).forEach(function(e) {
                e.classList.remove("hidden");
            });
        });
    };

    switch (selection) {
        case "1":
            hideElements([
                ".transformer_rating", ".secondary_voltage", ".primary_current", ".secondary_current",
                ".kva", ".volts", ".amperes", ".transformer_phase", ".location", ".impedance",
                ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".primary_winding", ".secondary_winding", ".primary_voltage"]);
            break;
        case "2":
            hideElements([
                ".transformer_rating", ".primary_voltage", ".primary_current", ".secondary_current",
                ".kva", ".volts", ".amperes", ".transformer_phase", ".location", ".impedance",
                ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".primary_winding", ".secondary_winding", ".secondary_voltage"]);
            break;
        case "3":
            hideElements([
                ".transformer_rating", ".primary_current", ".secondary_current", ".kva", ".volts",
                ".amperes", ".transformer_phase", ".secondary_winding", ".location", ".impedance",
                ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".primary_voltage", ".secondary_voltage", ".primary_winding"]);
            break;
        case "4":
            hideElements([
                ".transformer_rating", ".primary_current", ".secondary_current", ".kva", ".volts",
                ".amperes", ".transformer_phase", ".primary_winding", ".location", ".impedance",
                ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".primary_voltage", ".secondary_voltage", ".secondary_winding"]);
            break;
        case "5":
            hideElements([
                ".transformer_rating", ".secondary_current", ".kva", ".volts", ".amperes",
                ".transformer_phase", ".primary_voltage", ".secondary_voltage", ".location", ".impedance",
                ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".secondary_winding", ".primary_winding", ".primary_current"]);
            break;
        case "6":
            hideElements([
                ".transformer_rating", ".secondary_current", ".kva", ".volts", ".amperes",
                ".transformer_phase", ".primary_voltage", ".secondary_voltage", ".location", ".impedance",
                ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".secondary_winding", ".primary_winding", ".secondary_current"]);
            break;
        case "7":
            hideElements([
                ".transformer_rating", ".secondary_current", ".kva", ".volts", ".amperes",
                ".transformer_phase", ".primary_voltage", ".secondary_voltage", ".secondary_winding", ".location",
                ".impedance", ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".primary_winding", ".primary_current", ".secondary_current"]);
            break;
        case "8":
            hideElements([
                ".transformer_rating", ".secondary_current", ".kva", ".volts", ".amperes",
                ".transformer_phase", ".primary_voltage", ".secondary_voltage", ".primary_winding", ".location",
                ".impedance", ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".secondary_winding", ".primary_current", ".secondary_current"]);
            break;
        case "9":
            hideElements([
                ".secondary_voltage", ".primary_current", ".secondary_current", ".kva", ".volts",
                ".amperes", ".primary_winding", ".secondary_winding", ".eddy_current", ".thickness",
                ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([
                ".transformer_phase", ".transformer_rating", ".primary_voltage", ".secondary_voltage", ".location", ".impedance"
            ]);
            break;
        case "10":
            hideElements([
                ".transformer_rating", ".secondary_voltage", ".primary_current", ".secondary_curren",
                ".amperes", ".primary_winding", ".secondary_winding", ".primary_voltage", ".location",
                ".impedance", ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".transformer_phase", ".kva", ".volts"]);
            break;
        case "11":
            hideElements([
                ".transformer_rating", ".secondary_voltage", ".primary_current", ".secondary_curren",
                ".kva", ".primary_winding", ".secondary_winding", ".primary_voltage", ".location", ".impedance"
            ]);
            showElements([
                ".transformer_phase", ".amperes", ".volts", ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            break;
        case "12":
            hideElements([
                ".transformer_rating", ".secondary_voltage", ".primary_current", ".secondary_current",
                ".volts", ".primary_winding", ".secondary_winding", ".primary_voltage", ".location",
                ".impedance", ".eddy_current", ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            showElements([".transformer_phase", ".amperes", ".kva"]);
            break;
        case "13":
            hideElements([
                ".transformer_rating", ".primary_voltage", ".secondary_voltage", ".kva", ".volts",
                ".amperes", ".transformer_phase", ".location", ".impedance"
            ]);
            showElements([
                ".primary_winding", ".secondary_winding", ".secondary_current", ".primary_current", ".eddy_current",
                ".thickness", ".flux", ".frequency", ".hysteresis_constant", ".number_of_turns"
            ]);
            break;
        case "14":
            hideElements([
                ".transformer_rating", ".primary_voltage", ".secondary_voltage", ".kva", ".volts",
                ".amperes", ".transformer_phase", ".location", ".impedance", ".primary_winding", ".secondary_winding",
                ".secondary_current", ".primary_current", ".eddy_current", ".thickness", ".hysteresis_constant"
            ]);
            showElements([".flux", ".frequency", ".number_of_turns"]);
            break;
        default:
            break;
    }

@endif
 
</script>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>