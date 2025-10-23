<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12">
                <label for="choose" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="choose" id="choose">
                        <option value="1"
                            {{ isset($_POST['choose']) && $_POST['choose'] == '1' ? 'selected' : '' }}>{{ $lang['2']}}</option>
                        <option value="2"
                            {{ isset($_POST['choose']) && $_POST['choose'] == '2' ? 'selected' : '' }}>{{$lang['3']}} </option>
                    </select>
                </div>
            </div>
            <div class="col-span-6 hidden" id="calculation2">
                <label for="selection1" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="selection1" id="selection1">
                        <option value="1"{{ isset($_POST['selection1']) && $_POST['selection1'] == '1' ? 'selected' : '' }}>{{ $lang['5']}} (F) </option>
                        <option value="2" {{ isset($_POST['selection1']) && $_POST['selection1'] == '2' ? 'selected' : '' }}>{{$lang['6']}} (q1)</option>
                        <option value="3" {{ isset($_POST['selection1']) && $_POST['selection1'] == '3' ? 'selected' : '' }}>{{$lang['7']}} (q2)</option>
                        <option value="4" {{ isset($_POST['selection1']) && $_POST['selection1'] == '4' ? 'selected' : '' }}>{{$lang['8']}} (r)</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6 " id="calculation1">
                <label for="selection2" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="selection2" id="selection2">
                        <option value="1"{{ isset($_POST['selection2']) && $_POST['selection2'] == '1' ? 'selected' : '' }}>{{ $lang['5']}} (F) </option>
                        <option value="2" {{ isset($_POST['selection2']) && $_POST['selection2'] == '2' ? 'selected' : '' }}>{{$lang['6']}} (q₁ & q₂)</option>
                        <option value="3" {{ isset($_POST['selection2']) && $_POST['selection2'] == '3' ? 'selected' : '' }}>{{$lang['7']}} (r)</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6 charge_three">
                <label for="charge_three" class="font-s-14 text-blue">{{ $lang['6'] }} (q₁ & q₂)</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="charge_three" id="charge_three" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['charge_three']) ? $_POST['charge_three'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="charge_three_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('charge_three_unit_dropdown')">{{ isset($_POST['charge_three_unit'])?$_POST['charge_three_unit']:'pC' }} ▾</label>
                   <input type="text" name="charge_three_unit" value="{{ isset($_POST['charge_three_unit'])?$_POST['charge_three_unit']:'pC' }}" id="charge_three_unit" class="hidden">
                   <div id="charge_three_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="charge_three_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_three_unit', 'pC')">pC</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_three_unit', 'nC')">nC</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_three_unit', 'μC')">μC</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_three_unit', 'mC')">mC</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_three_unit', 'C')">C</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_three_unit', 'e')">e</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_three_unit', 'Ah')">Ah</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_three_unit', 'mAh')">mAh</p>
                   </div>
                </div>
              </div>
              <div class="col-span-6 hidden charge_one">
                <label for="charge_one" class="font-s-14 text-blue">{{ $lang['10'] }} (q₁)</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="charge_one" id="charge_one" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['charge_one']) ? $_POST['charge_one'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="charge_one_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('charge_one_unit_dropdown')">{{ isset($_POST['charge_one_unit'])?$_POST['charge_one_unit']:'pC' }} ▾</label>
                   <input type="text" name="charge_one_unit" value="{{ isset($_POST['charge_one_unit'])?$_POST['charge_one_unit']:'pC' }}" id="charge_one_unit" class="hidden">
                   <div id="charge_one_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="charge_one_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_one_unit', 'pC')">pC</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_one_unit', 'nC')">nC</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_one_unit', 'μC')">μC</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_one_unit', 'mC')">mC</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_one_unit', 'C')">C</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_one_unit', 'e')">e</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_one_unit', 'Ah')">Ah</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_one_unit', 'mAh')">mAh</p>
                   </div>
                </div>
              </div>
              <div class="col-span-6  hidden charge_two">
                <label for="charge_two" class="font-s-14 text-blue">{{ $lang['11'] }} (q₂)</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="charge_two" id="charge_two" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['charge_two']) ? $_POST['charge_two'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="charge_two_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('charge_two_unit_dropdown')">{{ isset($_POST['charge_two_unit'])?$_POST['charge_two_unit']:'pC' }} ▾</label>
                   <input type="text" name="charge_two_unit" value="{{ isset($_POST['charge_two_unit'])?$_POST['charge_two_unit']:'pC' }}" id="charge_two_unit" class="hidden">
                   <div id="charge_two_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="charge_two_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_two_unit', 'pC')">pC</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_two_unit', 'nC')">nC</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_two_unit', 'μC')">μC</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_two_unit', 'mC')">mC</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_two_unit', 'C')">C</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_two_unit', 'e')">e</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_two_unit', 'Ah')">Ah</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('charge_two_unit', 'mAh')">mAh</p>
                   </div>
                </div>
              </div>
              <div class="col-span-6  distance">
                <label for="distance" class="font-s-14 text-blue">{{ $lang['8'] }} (r)</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="distance" id="distance" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['distance']) ? $_POST['distance'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="distance_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('distance_unit_dropdown')">{{ isset($_POST['distance_unit'])?$_POST['distance_unit']:'nm' }} ▾</label>
                   <input type="text" name="distance_unit" value="{{ isset($_POST['distance_unit'])?$_POST['distance_unit']:'nm' }}" id="distance_unit" class="hidden">
                   <div id="distance_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="distance_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'nm')">nm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'μm')">μm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'mm')">mm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'cm')">cm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'm')">m</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'km')">km</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'in')">in</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'ft')">ft</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('distance_unit', 'yd')">yd</p>
                   </div>
                </div>
              </div>
              <div class="col-span-6 hidden force">
                <label for="force" class="font-s-14 text-blue">{{ $lang['5'] }} (F)</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="force" id="force" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['force']) ? $_POST['force'] : '7' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="force_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('force_unit_dropdown')">{{ isset($_POST['force_unit'])?$_POST['force_unit']:'mN' }} ▾</label>
                   <input type="text" name="force_unit" value="{{ isset($_POST['force_unit'])?$_POST['force_unit']:'mN' }}" id="force_unit" class="hidden">
                   <div id="force_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="force_unit">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'mN')">mN</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'N')">N</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'kN')">kN</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'MN')">MN</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'GN')">GN</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'TN')">TN</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'pdl')">pdl</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('force_unit', 'lbf')">lbf</p>
                   </div>
                </div>
              </div>
          
            <div class="col-span-6 constant">
                <label for="constant" class="font-s-14 text-blue">{{ $lang['9'] }} (Ke)</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" name="constant" id="constant" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['constant'])?$_POST['constant']:'8.98755' }}" />
                    <span class="text-blue input_unit">x10<sup>9</sup> N⋅m²/C²</span>
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
                        @if(isset($detail['force']) && $detail['force'] != '')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{ $lang[5] }}</strong></td>
                                    <td class="py-2 border-b"> {{ $detail['force'] }} (N) </td>
                                </tr>
                        
                                </table>
                            </div>
                            <p class="mt-2"><strong>{{$lang['12']}}:</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="30%">{{$lang['5']}}</td>
                                    <td class="py-2 border-b">{{$detail['force']*0.001;}} (Kilo Newton) kN</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="30%">{{$lang['5']}}</td>
                                    <td class="py-2 border-b">{{$detail['force']*1000;}} (Milli Newton) mN</td>
                                </tr>
                                    <tr>
                                    <td class="py-2 border-b" width="30%">{{$lang['5']}}</td>
                                    <td class="py-2 border-b">{{$detail['force']*0.224809;}} (pounds-force) lbf</td>
                                </tr>
                                    <tr>
                                    <td class="py-2 border-b" width="30%">{{$lang['5']}}</td>
                                    <td class="py-2 border-b">{{$detail['force']*0.000001;}} (Mega Newton) MN</td>
                                </tr>
                                    <tr>
                                    <td class="py-2 border-b" width="30%">{{$lang['5']}}</td>
                                    <td class="py-2 border-b">{{$detail['force']*0.000000001;}} (Giga Newton) GN</td>
                                </tr>
                                    <tr>
                                    <td class="py-2 border-b" width="30%">{{$lang['5']}}</td>
                                    <td class="py-2 border-b">{{$detail['force']*0.000000000001;}} (Tera Newton) TN</td>
                                </tr>
                                    <tr>
                                    <td class="py-2 border-b">{{$lang['5']}}</td>
                                    <td class="py-2 border-b">{{$detail['force']*7.23301;}} (poundals) pdl</td>
                                </tr>
                                </table>
                            </div>
                        @endif
                        @if (isset($detail['charging']) && $detail['charging'] != '')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{$lang['6']}} (q1 & q2)</strong></td>
                                    <td class="py-2 border-b"> {{$detail['charging']}} (C)</td>
                                </tr>
                                </table>
                            </div>
                            <p class="mt-2"><strong>Results in other units:</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="40%">{{$lang['6']}} (q1&q2)</td>
                                    <td class="py-2 border-b">{{$detail['charging']*1000000000;}} (nanocoulombs) nC</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="40%">{{$lang['6']}} (q1&q2)</td>
                                    <td class="py-2 border-b">{{$detail['charging']*1000000000000;}} (picocoulombs) pC</td>
                                </tr>
                                    <tr>
                                    <td class="py-2 border-b" width="40%">{{$lang['6']}} (q1&q2)</td>
                                    <td class="py-2 border-b">{{$detail['charging']*1000;}} (millicoulombs) mC</td>
                                </tr>
                                    <tr>
                                    <td class="py-2 border-b" width="40%">{{$lang['6']}} (q1&q2)</td>
                                    <td class="py-2 border-b">{{$detail['charging']*0.000277778;}} (ampere hours) Ah </td>
                                </tr>
                                    <tr>
                                    <td class="py-2 border-b" width="40%">{{$lang['6']}} (q1&q2)</td>
                                    <td class="py-2 border-b">{{$detail['charging']*0.277778;}} (milliampere hours) aAh</td>
                                </tr>
                                    <tr>
                                    <td class="py-2 border-b" width="40%">{{$lang['6']}} (q1&q2)</td>
                                    <td class="py-2 border-b">{{$detail['charging']*6241509074460762608;}} (Elementary charge) e</td>
                                </tr>
                                </table>
                            </div>
                        @endif
                        @if (isset($detail['distancing']) && $detail['distancing'] != '')
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{$lang['8']}} (r)</strong></td>
                                    <td class="py-2 border-b"> {{$detail['distancing']}} (m)</td>
                                </tr>
                                </table>
                            </div>
                            <p class="mt-2"><strong>Results in other units:</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                    <td class="py-2 border-b" width="40%">{{$lang['8']}} (r)</td>
                                    <td class="py-2 border-b">{{$detail['distancing']*1000000000;}} (nanometers) nm</td>
                                    </tr>
                                    <tr>
                                    <td class="py-2 border-b" width="40%">{{$lang['8']}} (r)</td>
                                    <td class="py-2 border-b">{{$detail['distancing']*1000000;}} (micrometers) μm</td>
                                    </tr>
                                    <tr>
                                    <td class="py-2 border-b" width="40%">{{$lang['8']}} (r)</td>
                                    <td class="py-2 border-b">{{$detail['distancing']*1000;}} (millimeters) mm</td>
                                    </tr>
                                    <tr>
                                    <td class="py-2 border-b" width="40%">{{$lang['8']}} (r)</td>
                                    <td class="py-2 border-b">{{$detail['distancing']*100;}} (centimeters) cm </td>
                                    </tr>
                                    <tr>
                                    <td class="py-2 border-b" width="40%">{{$lang['8']}} (r)</td>
                                    <td class="py-2 border-b">{{$detail['distancing']*0.001;}} (kilometers) km</td>
                                    </tr>
                                    <tr>
                                    <td class="py-2 border-b" width="40%">{{$lang['8']}} (r)</td>
                                    <td class="py-2 border-b">{{$detail['distancing']*39.3701;}} (inches) in</td>
                                    </tr>
                                    <tr>
                                    <td class="py-2 border-b" width="40%">{{$lang['8']}} (r)</td>
                                    <td class="py-2 border-b">{{$detail['distancing']*3.28084;}} (feet) ft</td>
                                    </tr>
                                    <tr>
                                    <td class="py-2 border-b" width="40%">{{$lang['8']}} (r)</td>
                                    <td class="py-2 border-b">{{$detail['distancing']*1.093613;}} (yards) yd</td>
                                    </tr>
                                </table>
                            </div>
                        @endif
                        @php
                            $content = "";
                            if (isset($detail['method'])) {
                                if ($detail['method'] == "1") {
                                    $content = "q1";
                                } else if ($detail['method'] == "2") {
                                    $content = "q2";
                                }
                            }
                        @endphp
                        @if(isset($detail['method']) && ($detail['method'] == "1" || $detail['method'] == "2"))
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="40%"><strong>{{$lang['6']}} ({{ $content }})</strong></td>
                                    @if(isset($detail['charge_one']))
                                    <td class="py-2 border-b"> {{$detail['charge_one']}} (C)</td>
                                    @endif
                                </tr>
                                </table>
                            </div>
                            @if(isset($detail['charge_one']))
                                <p class="mt-2"><strong>Results in other units:</strong></p>
                                <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                    <table class="w-full text-[18px]">
                                        <tr>
                                            <td  class="py-2 border-b" width="40%">{{$lang['6']}} {{ $content }}</td>
                                            <td class="py-2 border-b">{{ $detail['charge_one'] * 1000000000 }} <span>(nanocoulombs) nC</span></td>
                                        </tr>
                                        <tr>
                                            <td  class="py-2 border-b" width="40%">{{$lang['6']}} {{ $content }}</td>
                                            <td class="py-2 border-b">{{ $detail['charge_one'] * 1000000000000 }} <span>(picocoulombs) pC</span></td>
                                        </tr>
                                        <tr>
                                            <td  class="py-2 border-b" width="40%">{{$lang['6']}} {{ $content }}</td>
                                            <td class="py-2 border-b">{{ $detail['charge_one'] * 1000 }} <span>(millicoulombs) mC</span></td>
                                        </tr>
                                        <tr>
                                            <td  class="py-2 border-b" width="40%">{{$lang['6']}} {{ $content }}</td>
                                            <td class="py-2 border-b">{{ $detail['charge_one'] * 0.000277778 }} <span>(ampere hours) Ah</span></td>
                                        </tr>
                                        <tr>
                                            <td  class="py-2 border-b" width="40%">{{$lang['6']}} {{ $content }}</td>
                                            <td class="py-2 border-b">{{ $detail['charge_one'] * 0.277778 }} <span>(milliampere hours) mAh</span></td>
                                        </tr>
                                        <tr>
                                            <td  class="py-2 border-b" width="40%">{{$lang['6']}} {{ $content }}</td>
                                            <td class="py-2 border-b">{{ $detail['charge_one'] * 6241509074460762608 }} <span>(Elementary charge) e</span></td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                        @endif
                        
                    </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('selection1').addEventListener('change', function() {
        var b = this.value;

        function hideElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.add('hidden');
            });
        }

        function showElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.remove('hidden');
            });
        }

        if (b === "1") {
            hideElements('.force,.charge_three');
            showElements('.charge_one,.charge_two,.distance');
        } else if (b === "2") {
            hideElements('.charge_one,.charge_three');
            showElements('.charge_two,.force,.distance');
        } else if (b === "3") {
            hideElements('.charge_two,.charge_three');
            showElements('.charge_one,.force,.distance');
        }else if (b === "4") {
            hideElements('.distance,.charge_three');
            showElements('.charge_one,.charge_two,.force');
        }
    });
});
@if(isset($detail))
    var b = "{{$_POST['selection1']}}";
        function hideElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.add('hidden');
            });
        }
        function showElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.remove('hidden');
            });
        }

        if (b === "1") {
            hideElements('.force,.charge_three');
            showElements('.charge_one,.charge_two,.distance');
        } else if (b === "2") {
            hideElements('.charge_one,.charge_three');
            showElements('.charge_two,.force,.distance');
        } else if (b === "3") {
            hideElements('.charge_two,.charge_three');
            showElements('.charge_one,.force,.distance');
        }else if (b === "4") {
            hideElements('.distance,.charge_three');
            showElements('.charge_one,.charge_two,.force');
        }
@endif
@if(isset($error))
    var b = "{{$_POST['selection1']}}";
        function hideElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.add('hidden');
            });
        }
        function showElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.remove('hidden');
            });
        }

        if (b === "1") {
            hideElements('.force,.charge_three');
            showElements('.charge_one,.charge_two,.distance');
        } else if (b === "2") {
            hideElements('.charge_one,.charge_three');
            showElements('.charge_two,.force,.distance');
        } else if (b === "3") {
            hideElements('.charge_two,.charge_three');
            showElements('.charge_one,.force,.distance');
        }else if (b === "4") {
            hideElements('.distance,.charge_three');
            showElements('.charge_one,.charge_two,.force');
        }
@endif
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('selection2').addEventListener('change', function() {
        var a = this.value;
        function hideElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.add('hidden');
            });
        }

        function showElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.remove('hidden');
            });
        }  

        if (a === "1") {
            hideElements('.force,.charge_one,.charge_two');
            showElements('.charge_three,.distance');
        } else if (a === "2") {
            hideElements('.charge_three,.charge_one,.charge_two');
            showElements('.force,.distance');
        } else if (a === "3") {
            hideElements('.distance,.charge_one,.charge_two');
            showElements('.force,.charge_three');
        } 
    });
});
@if(isset($detail))
    var a = "{{$_POST['selection2']}}";

    function hideElements(selector) {
        document.querySelectorAll(selector).forEach(function(element) {
            element.classList.add('hidden');
        });
    }
    function showElements(selector) {
        document.querySelectorAll(selector).forEach(function(element) {
            element.classList.remove('hidden');
        });
    }

    if (a === "1") {
            hideElements('.force,.charge_one,.charge_two');
            showElements('.charge_three,.distance');
        } else if (a === "2") {
            hideElements('.charge_three,.charge_one,.charge_two');
            showElements('.force,.distance');
        } else if (a === "3") {
            hideElements('.distance,.charge_one,.charge_two');
            showElements('.force,.charge_three');
        } 
@endif
@if(isset($error))
    var a = "{{$_POST['selection2']}}";

    function hideElements(selector) {
        document.querySelectorAll(selector).forEach(function(element) {
            element.classList.add('hidden');
        });
    }

    function showElements(selector) {
        document.querySelectorAll(selector).forEach(function(element) {
            element.classList.remove('hidden');
        });
    }


    if (a === "1") {
            hideElements('.force,.charge_one,.charge_two');
            showElements('.charge_three,.distance');
        } else if (a === "2") {
            hideElements('.charge_three,.charge_one,.charge_two');
            showElements('.force,.distance');
        } else if (a === "3") {
            hideElements('.distance,.charge_one,.charge_two');
            showElements('.force,.charge_three');
        } 
@endif
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('choose').addEventListener('change', function() {
        var o = this.value;
        function hideElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.add('hidden');
            });
        }

        function showElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.remove('hidden');
            });
        }

        if (o === "1") {
            document.getElementById('calculation1').classList.remove('hidden');
            document.getElementById('calculation2').classList.add('hidden');
            hideElements('.charge_one, .charge_two, .force');
            showElements('.charge_three');
            var f1 = document.getElementById('selection1').value;
            if (f1 === "1") {
                hideElements('.force, .charge_one, .charge_two');
                showElements('.charge_three, .distance');
            } else if (f1 === "2") {
                hideElements('.charge_three, .charge_one, .charge_two');
                showElements('.force, .distance');
            } else if (f1 === "3") {
                hideElements('.distance, .charge_one, .charge_two');
                showElements('.force, .charge_three');
            }
        } else if (o === "2") {
            document.getElementById('calculation1').classList.add('hidden');
            document.getElementById('calculation2').classList.remove('hidden');
            showElements('.charge_one, .charge_two');
            hideElements('.charge_three, .force');
            var f2 = document.getElementById('selection2').value;
            if (f2 === "1") {
                hideElements('.force, .charge_three');
                showElements('.charge_one, .charge_two, .distance');
            } else if (f2 === "2") {
                hideElements('.charge_one, .charge_three');
                showElements('.charge_two, .force, .distance');
            } else if (f2 === "3") {
                hideElements('.charge_two, .charge_three');
                showElements('.charge_one, .force, .distance');
            } else if (f2 === "4") {
                hideElements('.distance, .charge_three');
                showElements('.charge_one, .charge_two, .force');
            }
        }
    });
});
@if(isset($error))
    var o = "{{$_POST['choose']}}";
        function hideElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.add('hidden');
            });
        }

        function showElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.remove('hidden');
            });
        }

        if (o === "1") {
            document.getElementById('calculation1').classList.remove('hidden');
            document.getElementById('calculation2').classList.add('hidden');
            hideElements('.charge_one, .charge_two, .force');
            showElements('.charge_three');
            var f1 = document.getElementById('selection1').value;
            if (f1 === "1") {
                hideElements('.force, .charge_one, .charge_two');
                showElements('.charge_three, .distance');
            } else if (f1 === "2") {
                hideElements('.charge_three, .charge_one, .charge_two');
                showElements('.force, .distance');
            } else if (f1 === "3") {
                hideElements('.distance, .charge_one, .charge_two');
                showElements('.force, .charge_three');
            }
        } else if (o === "2") {
            document.getElementById('calculation1').classList.add('hidden');
            document.getElementById('calculation2').classList.remove('hidden');
            showElements('.charge_one, .charge_two');
            hideElements('.charge_three, .force');
            var f2 = document.getElementById('selection2').value;
            if (f2 === "1") {
                hideElements('.force, .charge_three');
                showElements('.charge_one, .charge_two, .distance');
            } else if (f2 === "2") {
                hideElements('.charge_one, .charge_three');
                showElements('.charge_two, .force, .distance');
            } else if (f2 === "3") {
                hideElements('.charge_two, .charge_three');
                showElements('.charge_one, .force, .distance');
            } else if (f2 === "4") {
                hideElements('.distance, .charge_three');
                showElements('.charge_one, .charge_two, .force');
            }
        }

@endif
@if(isset($detail))
    var o = "{{$_POST['choose']}}";
        function hideElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.add('hidden');
            });
        }

        function showElements(selector) {
            document.querySelectorAll(selector).forEach(function(element) {
                element.classList.remove('hidden');
            });
        }

        if (o === "1") {
            document.getElementById('calculation1').classList.remove('hidden');
            document.getElementById('calculation2').classList.add('hidden');
            hideElements('.charge_one, .charge_two, .force');
            showElements('.charge_three');
            var f1 = document.getElementById('selection1').value;
            if (f1 === "1") {
                hideElements('.force, .charge_one, .charge_two');
                showElements('.charge_three, .distance');
            } else if (f1 === "2") {
                hideElements('.charge_three, .charge_one, .charge_two');
                showElements('.force, .distance');
            } else if (f1 === "3") {
                hideElements('.distance, .charge_one, .charge_two');
                showElements('.force, .charge_three');
            }
        } else if (o === "2") {
            document.getElementById('calculation1').classList.add('hidden');
            document.getElementById('calculation2').classList.remove('hidden');
            showElements('.charge_one, .charge_two');
            hideElements('.charge_three, .force');
            var f2 = document.getElementById('selection2').value;
            if (f2 === "1") {
                hideElements('.force, .charge_three');
                showElements('.charge_one, .charge_two, .distance');
            } else if (f2 === "2") {
                hideElements('.charge_one, .charge_three');
                showElements('.charge_two, .force, .distance');
            } else if (f2 === "3") {
                hideElements('.charge_two, .charge_three');
                showElements('.charge_one, .force, .distance');
            } else if (f2 === "4") {
                hideElements('.distance, .charge_three');
                showElements('.charge_one, .charge_two, .force');
            }
        }

@endif
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>