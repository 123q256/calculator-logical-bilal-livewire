<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
    
                <div class="col-span-12 w-set">
                    <label for="find" class="font-s-14 text-blue">{{ $lang['18'] }}:</label>
                    <div class="w-full py-2">
                        <i class="fas fa-sort-down color_blue"></i>
                        <select name="find" id="find" class="input">
                            <option value="0" {{ isset($_POST['find']) && $_POST['find']=='0'?'selected':''}}  >{{$lang['1'] }}</option>
                            <option value="1" {{ isset($_POST['find']) && $_POST['find']=='1'?'selected':''}}  >{{ $lang['2']}}</option>
                            <option value="2" {{ isset($_POST['find']) && $_POST['find']=='2'?'selected':''}}  >{{ $lang['3'] }}</option>
                        </select>
                    </div>
                </div>
            </div>
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12" id="g-hide">
                        <p class="col med-set"><label><strong>{{$lang['4']}}: </strong></label></p>
                        <p class="med-set1">
                            <label class="g1 my-3 mx-2">
                                @if(isset($_POST['select1']) && $_POST['select1']=="angular_acceleration")
                                <input class="with-gap checking" id="g1" name="select1" type="radio" value="angular_acceleration" checked>
                                @else
                                    <input class="with-gap checking" id="g1" name="select1" type="radio" value="angular_acceleration">
                                @endif
                                <span>{{$lang['5']}}</span>
                            </label>
                            <label class="g2 my-3 mx-2">
                                @if(isset($_POST['select1']) && $_POST['select1']=="radius")
                                <input class="with-gap" id="g2" name="select1" type="radio" value="radius" checked>
                                @else
                                    <input class="with-gap" id="g2" name="select1" type="radio" value="radius">
                                @endif
                                <span>{{$lang['6']}}</span>
                            </label>
                            <label class="g3 my-3 mx-2">
                                @if(isset($_POST['select1']) && $_POST['select1']=="tangential_acceleration")
                                <input class="with-gap" id="g3" name="select1" type="radio" value="tangential_acceleration" checked>
                                @else
                                <input class="with-gap" id="g3" name="select1" type="radio" value="tangential_acceleration">
                                @endif 
                                <span>{{$lang['7']}}</span>
                            </label>
                        </p>
                    </div>
                    <div class="col-span-12 hidden" id="g-hide1">
                        <p class="col med-set">
                        <label class="font_size16"><strong>{{ $lang['4']}}: </strong></label>
                        </p>
                        <label class="g1 my-3 mx-2">
                            @if(isset($_POST['select2']) && $_POST['select2']=="angular_acceleration_two")
                            <input class="with-gap checking3" id="g4" name="select2" type="radio" value="angular_acceleration_two" checked>
                        @else
                            <input class="with-gap checking3" id="g4" name="select2" type="radio" value="angular_acceleration_two" checked>
                        @endif
                        <span>{{ $lang['5']}}</span>
                        </label>
                        <label class="g2 my-3 mx-2">
                            @if(isset($_POST['select2']) && $_POST['select2']=="mass")
                        <input class="with-gap" id="g5" name="select2" type="radio" value="mass" checked>
                        @else
                            <input class="with-gap" id="g5" name="select2" type="radio" value="mass">
                        @endif
                        <span>{{ $lang['8']}}</span>
                        </label>
                        <label class="g3 my-3 mx-2">
                            @if(isset($_POST['select2']) && $_POST['select2']=="total_torque_two")
                        <input class="with-gap" id="g6" name="select2" type="radio" value="total_torque_two" checked>
                        @else
                            <input class="with-gap" id="g6" name="select2" type="radio" value="total_torque_two">
                        @endif
                        <span>{{ $lang['9']}}</span>
                        </label>
                    </p>
                    </div>
                    <div class="col-span-12 hidden root">
                        <p class="col med-set med-set2">
                        <label class="font_size16"><strong>{{$lang['4']}}: </strong></label>
                    </div>
                    <div class="col-span-12 hidden" id="g-hide2">
                        <p class="med-set3">
                            <label class="g1 my-3 mx-2">
                                @if(isset($_POST['select3']) && $_POST['select3']=="angular_acceleration_three")
                                    <input class="with-gap checking2" id="g7" name="select3" type="radio" value="angular_acceleration_three" checked>
                                @else
                                    <input class="with-gap checking2" id="g7" name="select3" type="radio" value="angular_acceleration_three" checked>
                                @endif  
                                <span>{{ $lang['5']}}</span>
                            </label>
                            <label class="g4 my-3 mx-2">
                                @if(isset($_POST['select3']) && $_POST['select3']=="time")
                                    <input class="with-gap" id="g8" name="select3" type="radio" value="time" checked>
                                    @else
                                    <input class="with-gap" id="g8" name="select3" type="radio" value="time">
                                @endif
                            <span>{{ $lang['10']}}</span>
                            </label>
                            <label class="g2 my-3 mx-2">
                                @if(isset($_POST['select3']) && $_POST['select3']=="inv")
                            <input class="with-gap" id="g9" name="select3" type="radio" value="inv" checked>
                                @else
                                <input class="with-gap" id="g9" name="select3" type="radio" value="inv">
                                @endif  
                                <span>{{ $lang['11']}}</span>
                            </label>
                            <label class="g3 my-3 mx-2">
                                @if(isset($_POST['select3']) && $_POST['select3']=="fnv")
                                <input class="with-gap" id="g10" name="select3" type="radio" value="fnv" checked>
                                @else
                                <input class="with-gap" id="g10" name="select3" type="radio" value="fnv">
                                @endif 
                                <span>{{$lang['12']}}</span>
                            </label>
                        </p>
                    </div>
                </div>
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6" id="tangential_acceleration">
                        <label for="ta" class="font-s-14 text-blue">{{ $lang['7'] }} (a)</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" name="ta" id="ta" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ta'])?$_POST['ta']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                           <label for="ta_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ta_unit_dropdown')">{{ isset($_POST['ta_unit'])?$_POST['ta_unit']:'m/s²' }} ▾</label>
                           <input type="text" name="ta_unit" value="{{ isset($_POST['ta_unit'])?$_POST['ta_unit']:'m/s²' }}" id="ta_unit" class="hidden">
                           <div id="ta_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ta_unit">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ta_unit', 'm/s²')">m/s²</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ta_unit', 'g')">g</p>
                           </div>
                        </div>
                      </div>

                      <div class="col-span-12 md:col-span-6 lg:col-span-6" id="radius">
                        <label for="ra" class="font-s-14 text-blue">{{ $lang['6'] }} (R)</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" name="ra" id="ra" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ra'])?$_POST['ra']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                           <label for="ra_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ra_unit_dropdown')">{{ isset($_POST['ra_unit'])?$_POST['ra_unit']:'mm' }} ▾</label>
                           <input type="text" name="ra_unit" value="{{ isset($_POST['ra_unit'])?$_POST['ra_unit']:'mm' }}" id="ra_unit" class="hidden">
                           <div id="ra_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ra_unit">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ra_unit', 'mm')">mm</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ra_unit', 'cm')">cm</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ra_unit', 'm')">m</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ra_unit', 'km')">km</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ra_unit', 'in')">in</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ra_unit', 'ft')">ft</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ra_unit', 'yd')">yd</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ra_unit', 'mi')">mi</p>
                           </div>
                        </div>
                      </div>
                    

                    <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="angular_acceleration">
                        <label for="aa" class="font-s-14 text-blue">{{ $lang['5'] }} (α)</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="aa" id="aa" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['aa'])?$_POST['aa']:'50' }}" />
                            <span class="text-blue input_unit">rad/s<sup>2</sup></span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="total_torque">
                        <label for="torque" class="font-s-14 text-blue">{{ $lang['9'] }} (τ)</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="torque" id="torque" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['torque'])?$_POST['torque']:'50' }}" />
                            <span class="text-blue input_unit">rad/sec</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="moment">
                        <label for="moment" class="font-s-14 text-blue">{{ $lang['8'] }} (I)</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="moment" id="moment" class="input" aria-label="input" placeholder="50" value="{{ isset($_POST['moment'])?$_POST['moment']:'50' }}" />
                            <span class="text-blue input_unit">kg-m<sup>2</sup>/rad<sup>2</sup></span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="inv">
                        <label for="inv" class="font-s-14 text-blue">{{ $lang['11'] }} (R)</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" name="inv" id="inv" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['inv'])?$_POST['inv']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                           <label for="inv_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('inv_unit_dropdown')">{{ isset($_POST['inv_unit'])?$_POST['inv_unit']:'rad/s' }} ▾</label>
                           <input type="text" name="inv_unit" value="{{ isset($_POST['inv_unit'])?$_POST['inv_unit']:'rad/s' }}" id="inv_unit" class="hidden">
                           <div id="inv_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="inv_unit">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('inv_unit', 'rad/s')">rad/s</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('inv_unit', 'rpm')">rpm</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('inv_unit', 'Hz')">Hz</p>
                           </div>
                        </div>
                      </div>
                      <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="fnv">
                        <label for="fnv" class="font-s-14 text-blue">{{ $lang['12'] }} (R)</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" name="fnv" id="fnv" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fnv'])?$_POST['fnv']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                           <label for="fnv_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fnv_unit_dropdown')">{{ isset($_POST['fnv_unit'])?$_POST['fnv_unit']:'rad/s' }} ▾</label>
                           <input type="text" name="fnv_unit" value="{{ isset($_POST['fnv_unit'])?$_POST['fnv_unit']:'rad/s' }}" id="fnv_unit" class="hidden">
                           <div id="fnv_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fnv_unit">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fnv_unit', 'rad/s')">rad/s</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fnv_unit', 'rpm')">rpm</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fnv_unit', 'Hz')">Hz</p>
                           </div>
                        </div>
                      </div>
                      <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="time">
                        <label for="time" class="font-s-14 text-blue">{{ $lang['10'] }}</label>
                        <div class="relative w-full mt-[7px]">
                           <input type="number" name="time" id="time" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['time'])?$_POST['time']:'5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                           <label for="time_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('time_unit_dropdown')">{{ isset($_POST['time_unit'])?$_POST['time_unit']:'sec' }} ▾</label>
                           <input type="text" name="time_unit" value="{{ isset($_POST['time_unit'])?$_POST['time_unit']:'sec' }}" id="time_unit" class="hidden">
                           <div id="time_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="time_unit">
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'sec')">sec</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'min')">min</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'hrs')">hrs</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'days')">days</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'wks')">wks</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'mos')">mos</p>
                               <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('time_unit', 'yrs')">yrs</p>
                           </div>
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
                    <div class="w-full font-s-20 overflow-auto">
                        @if($detail['method']=="1")
                            <p class="mt-2"><strong>{{ $lang['5']}} (`\alpha`)</strong></p>
                            <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> (rad/s<sup>2</sup>)</span></strong></p>
                            <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                            <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                            <p class="mt-2">`\alpha = \dfrac{a}{R}`</p> 
                            <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                            <p class="mt-2"><strong>`a = {{ $detail['first_value']; }}, R = {{ $detail['second_value']}},  \ and \  {{ $lang['16']}} \ \alpha `</strong></p>
                            <p class="mt-2"><strong>{{ $lang['17']}} :</strong></p>
                            <p class="mt-2">`\alpha = \dfrac{a}{R}`</p> 
                            <p class="mt-2">`\alpha = \dfrac{{{ $detail['first_value'] }}}{{{ $detail['second_value']; }}}`</p> 
                            <p class="mt-2 dk">`\alpha = {{ $detail['ans'] }}`</p>
                        @endif
                        @if($detail['method']=="2")
                            <p class="mt-2"><strong>{{ $lang['6']}} (R)</strong></p>
                            <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> (m)</span></strong></p>
                            <p class="mt-2"><strong>{{ $lang['19']}}:</strong></p>
                            <div class="mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="color_blue">{{ $lang['6']}} (R)</td>
                                    <td class=""><strong>{{ $detail['ans']*1000}} (mm)</strong></td>
                                </tr>
                                <tr>
                                    <td class="color_blue">{{ $lang['6']}} (R)</td>
                                    <td class=""><strong>{{ $detail['ans']*100}} (cm)</strong></td>
                                </tr>
                                <tr>
                                    <td class="color_blue">{{ $lang['6']}} (R)</td>
                                    <td class=""><strong>{{ $detail['ans']*0.001}} (km)</strong></td>
                                </tr>
                                <tr>
                                    <td class="color_blue">{{ $lang['6']}} (R)</td>
                                    <td class=""><strong>{{ $detail['ans']*39.37}} (in)</strong></td>
                                </tr>
                                <tr>
                                    <td class="color_blue">{{ $lang['6']}} (R)</td>
                                    <td class=""><strong>{{ $detail['ans']*3.281}} (ft)</strong></td>
                                </tr>
                                <tr>
                                    <td class="color_blue">{{ $lang['6']}} (R)</td>
                                    <td class=""><strong>{{ $detail['ans']*1.0936}} (yd)</strong></td>
                                </tr>
                                <tr>
                                    <td class="color_blue">{{ $lang['6']}} (R)</td>
                                    <td class=""><strong>{{ $detail['ans']*0.0006214}} (mi)</strong></td>
                                </tr>
                            </table>
                            </div>
                            <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                            <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                            <p class="mt-2">`R = \dfrac{a}{\alpha}`</p> 
                            <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                            <p class="mt-2"><strong>`a = {{ $detail['second_value']; }}, \alpha = {{ $detail['first_value']}},  \ and \  {{ $lang['16']}} \ R `</strong></p>
                            <p class="mt-2"><strong>{{ $lang['17']}}:</strong></p>
                            <p class="mt-2">`R = \dfrac{{{ $detail['second_value'] }}}{{{ $detail['first_value']; }}}`</p>
                            <p class="mt-2 dk">`R = {{ $detail['ans'] }}`</p>
                        @endif
                        @if($detail['method']=="3")
                            <p class="mt-2"><strong>{{ $lang['7']}} (a)</strong></p>
                            <p class="mt-2"><strong>{{round($detail['ans'],2)}}<span> (m/s<sup>2</sup>)</span></strong></p>
                            <p class="mt-2"><strong>{{ $lang['19']}}:</strong></p>
                            <div class="mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="color_blue">{{ $lang['7']}} (a)</td>
                                    <td><strong>{{ $detail['ans']*0.10197}} (g)</strong></td>
                                </tr>
                            </table>
                            </div>
                            <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                            <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                            <p class="mt-2">`a = \alpha*R`</p> 
                            <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                            <p class="mt-2"><strong>`\alpha = {{ $detail['first_value']; }}, R = {{ $detail['second_value']}},  \ and \  {{ $lang['16']}} \ R `</strong></p>
                            <p class="mt-2"><strong>{{ $lang['17']}}:</strong></p>
                            <p class="mt-2">`a = {{ $detail['first_value'] }}*{{ $detail['second_value'] }}`</p> 
                            <p class="mt-2 dk">`a = {{ $detail['ans'] }}`</p>
                        @endif
                        @if($detail['method']=="4")
                            <p class="mt-2"><strong>{{ $lang['5']}} (`\alpha`)</strong></p>
                            <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> (rad/s<sup>2</sup>)</span></strong></p>
                            <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                            <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                            <p class="mt-2">`\alpha = \dfrac{ω₂ - ω₁}{t}`</p> 
                                <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                            <p class="mt-2"><strong>`ω₁ = {{ $detail['first_value']; }},ω₂ = {{ $detail['second_value']}},t = {{ $detail['third_value'] }}  \ and \  {{ $lang['16']}} \ \alpha `</strong></p>
                            <p class="mt-2"><strong>{{ $lang['17']}} :</strong></p>
                            <p class="mt-2">`\alpha = \dfrac{ω₂ - ω₁}{t}`</p>
                            <p class="mt-2">`\alpha = \dfrac{ {{ $detail['second_value'] }} - {{ $detail['first_value'] }}}{{{ $detail['third_value'] }}}`</p>
                            <p class="mt-2 dk">`\alpha = {{ $detail['ans'] }}`</p>
                        @endif
                        @if($detail['method']=="5")
                            <p class="mt-2"><strong>{{ $lang['10']}} (t)</strong></p>
                            <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> (sec) </span></strong></p>
                            <p class="mt-2"><strong>{{ $lang['19']}}:</strong></p>
                            <div class="mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="color_blue">{{ $lang['10']}} (t)</td>
                                    <td class=""><strong>{{ $detail['ans']*0.016667}} minutes (min)</strong></td>
                                </tr>
                                <tr>
                                    <td class="color_blue">{{ $lang['10']}} (t)</td>
                                    <td class=""><strong>{{ $detail['ans']*0.0002778}} hour (hrs)</strong></td>
                                </tr>
                                <tr>
                                    <td class="color_blue">{{ $lang['10']}} (t)</td>
                                    <td class=""><strong>{{ $detail['ans']*0.000011574}} days(days)</strong></td>
                                </tr>
                                <tr>
                                    <td class="color_blue">{{ $lang['10']}} (t)</td>
                                    <td class=""><strong>{{ $detail['ans']*0.0000016534}} weeks(wks)</strong></td>
                                </tr>
                                <tr>
                                    <td class="color_blue">{{ $lang['10']}} (t)</td>
                                    <td class=""><strong>{{ $detail['ans']*0.00000038026}} months(mos)</strong></td>
                                </tr>
                                <tr>
                                    <td class="color_blue">{{ $lang['10']}} (t)</td>
                                    <td class=""><strong>{{ $detail['ans']*0.00000003169}} years(yrs)</strong></td>
                                </tr>
                            </table>
                            </div>
                            <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                            <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                            <p class="mt-2">`t = \dfrac{ω₂ - ω₁}{a}`</p> 
                                <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                            <p class="mt-2"><strong>`ω₁ = {{ $detail['first_value']; }},ω₂ = {{ $detail['second_value']}},a = {{ $detail['third_value'] }}  \ and \  {{ $lang['16']}} \ \alpha `</strong></p>
                            <p class="mt-2"><strong>{{ $lang['17']}} :</strong></p>
                            <p class="mt-2">`t = \dfrac{ω₂ - ω₁}{a}`</p>
                            <p class="mt-2">`t = \dfrac{ {{ $detail['second_value'] }} - {{ $detail['first_value'] }}}{{{ $detail['third_value'] }}}`</p>
                            <p class="mt-2 dk">`t = {{ $detail['ans'] }}`</p>
                        @endif
                        @if($detail['method']=="6")
                            <p class="mt-2"><strong>{{ $lang['11']}} (ω₁)</strong></p>
                            <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> (rad/s) </span></strong></p>
                            <p class="mt-2"><strong>{{ $lang['19']}}:</strong></p>
                            <div class="mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="color_blue">{{ $lang['11']}} (ω₁)</td>
                                    <td class=""><strong>{{ round($detail['ans']*9.55,2)}} Rotations per minute (rpm)</strong></td>
                                </tr>
                                <tr>
                                    <td class="color_blue">{{ $lang['11']}} (ω₁)</td>
                                    <td class=""><strong>{{ round($detail['ans']*0.15915,2)}} Hertz (Hz)</strong></td>
                                </tr>
                            </table>
                            </div>
                            <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                            <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                            <p class="mt-2">`ω₁ = ω₂-(t*\alpha)`</p> 
                            <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                            <p class="mt-2"><strong>`ω₂ = {{ $detail['first_value']; }},t = {{ $detail['second_value']}},\alpha = {{ $detail['third_value'] }}  \ and \  {{ $lang['16']}} \ ω₁ `</strong></p>
                            <p class="mt-2"><strong>{{ $lang['17']}} :</strong></p>
                            <p class="mt-2">`ω₁ = ω₂-(t*\alpha)`</p>
                            <p class="mt-2">`ω₁ = {{ $detail['first_value'] }}-({{ $detail['second_value'] }}*{{ $detail['third_value'] }})`</p>
                            <p class="mt-2 dk">`ω₁ = {{ $detail['ans'] }}`</p>
                        @endif
                        @if($detail['method']=="7")
                            <p class="mt-2"><strong>{{ $lang['12']}} (ω₂)</strong></p>
                            <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> (rad/s) </span></strong></p>
                            <p class="mt-2"><strong>{{ $lang['19']}}:</strong></p>
                            <div class="mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="color_blue">{{ $lang['12']}} (ω₂)</td>
                                    <td class=""><strong>{{ round($detail['ans']*9.55,2)}} Rotations per minute (rpm)</strong></td>
                                </tr>
                                <tr>
                                    <td class="color_blue">{{ $lang['12']}} (ω₂)</td>
                                    <td class=""><strong>{{ round($detail['ans']*0.15915,2)}} Hertz (Hz)</strong></td>
                                </tr>
                            </table>
                            </div>
                            <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                            <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                            <p class="mt-2">`ω₂ =(t*\alpha)+ω₁`</p> 
                            <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                            <p class="mt-2"><strong>`ω₁ = {{ $detail['first_value']; }},t = {{ $detail['second_value']}},\alpha = {{ $detail['third_value'] }}  \ and \  {{ $lang['16']}} \ ω₂ `</strong></p>
                            <p class="mt-2"><strong>{{ $lang['17']}} :</strong></p>
                            <p class="mt-2">`ω₂ =(t*\alpha)+ω₁`</p>
                            <p class="mt-2">`ω₂ =({{ $detail['second_value'] }}*{{ $detail['third_value'] }} )+{{ $detail['first_value'] }}`</p>
                            <p class="mt-2 dk">`ω₂ = {{ $detail['ans'] }}`</p>
                        @endif
                        @if($detail['method']=="8")
                            <p class="mt-2"><strong>{{ $lang['5']}} (`\alpha`)</strong></p>
                            <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> (rad/s<sup>2</sup>)</span></strong></p>
                            <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                            <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                            <p class="mt-2">`\alpha = \dfrac{τ}{I}`</p> 
                            <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                            <p class="mt-2"><strong>`τ = {{ $detail['first_value']; }}, I = {{ $detail['second_value']}},  \ and \  {{ $lang['16']}} \ \alpha `</strong></p>
                            <p class="mt-2"><strong>{{ $lang['17']}} :</strong></p>
                            <p class="mt-2">`\alpha = \dfrac{τ}{I}`</p>
                            <p class="mt-2">`\alpha = \dfrac{{{ $detail['first_value'] }}}{{{ $detail['second_value'] }}}`</p>
                            <p class="mt-2 dk">`\alpha = {{ $detail['ans'] }}`</p>
                        @endif
                        @if($detail['method']=="9")
                            <p class="mt-2"><strong>{{ $lang['8']}} (`I`)</strong></p>
                            <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> (kg-m<sup>2</sup>/rad<sup>2</sup>)</span></strong></p>
                            <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                            <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                            <p class="mt-2">`I = \dfrac{τ}{\alpha}`</p> 
                            <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                            <p class="mt-2"><strong>`τ = {{ $detail['first_value']; }}, \alpha = {{ $detail['second_value']}},  \ and \  {{ $lang['16']}} \ I `</strong></p>
                            <p class="mt-2"><strong>{{ $lang['17']}} :</strong></p>
                            <p class="mt-2">`I = \dfrac{τ}{\alpha}`</p>
                            <p class="mt-2">`I = \dfrac{{{ $detail['first_value'] }}}{{{ $detail['second_value'] }}}`</p>
                            <p class="mt-2 dk">`I = {{ $detail['ans'] }}`</p>
                        @endif
                        @if($detail['method']=="10")
                            <p class="mt-2"><strong>{{ $lang['9']}} (`τ`)</strong></p>
                            <p class="mt-2"><strong>{{ round($detail['ans'],2)}}<span> rad/sec</span></strong></p>
                            <p class="mt-2"><strong>{{ $lang['13']}} :</strong></p>
                            <p class="mt-2"><strong>{{ $lang['14']}} :</strong></p>
                            <p class="mt-2">`τ =I*\alpha`</p> 
                            <p class="mt-2"><strong>{{ $lang['15']}} :</strong></p>
                            <p class="mt-2"><strong>`I = {{ $detail['first_value']; }}, \alpha = {{ $detail['second_value']}},  \ and \  {{ $lang['16']}} \ τ `</strong></p>
                            <p class="mt-2"><strong>{{ $lang['17']}} :</strong></p>
                            <p class="mt-2">`τ =I*\alpha`</p>
                            <p class="mt-2">`τ ={{ $detail['first_value'] }}*{{ $detail['second_value'] }}`</p>
                            <p class="mt-2 dk">`τ = {{ $detail['ans'] }}`</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>

@push('calculatorJS')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML">
</script>
<script type="text/x-mathjax-config">
MathJax.Hub.Register.StartupHook("AsciiMath Jax Config",function () {
      var AM = MathJax.InputJax.AsciiMath.AM;
      AM.symbols.push({
          input:'rightleftharpoons',
          tag:'mo',
          output:'\u21CC',
          tex:'rightleftharpoons',
          ttype:'d'
      });
  });
  MathJax.Hub.Config({
      jax: ["input/TeX", "input/AsciiMath", "output/CommonHTML"],
      extensions: ["tex2jax.js", "asciimath2jax.js"],
      TeX: {
          extensions: ["AMSmath.js", "AMSsymbols.js", "noErrors.js", "noUndefined.js"]
      },
      tex2jax: {
          inlineMath: [['`','`']]
      },
      asciimath2jax: {
          delimiters: [['#','#']]
      },
      CommonHTML: {
          linebreaks: {
              automatic: true
          }
      },
      messageStyle: "none",
      MathMenu: {
          showLocale: false,
          showRenderer: false
      }
  });
</script>

  <script>

    document.getElementById("find").addEventListener("change", function() {
        var m = this.value;

        if (m == "0") {
            document.getElementById("g-hide").classList.remove("hidden");
            document.getElementById("tangential_acceleration").classList.remove("hidden");
            document.getElementById("radius").classList.remove("hidden");
            document.getElementById("g-hide1").classList.add("hidden");
            document.getElementById("g-hide2").classList.add("hidden");
            document.getElementById("moment").classList.add("hidden");
            document.getElementById("total_torque").classList.add("hidden");
            document.getElementById("angular_acceleration").classList.add("hidden");
            document.getElementById("inv").classList.add("hidden");
            document.getElementById("fnv").classList.add("hidden");
            document.getElementById("time").classList.add("hidden");
            document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            
            var y = document.getElementById("g1").className;
            var y1 = document.getElementById("g2").className;
            var y2 = document.getElementById("g3").className;

            if (y == "with-gap checking") {
                document.getElementById("tangential_acceleration").classList.remove("hidden");
                document.getElementById("radius").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            } else if (y1 == "with-gap checking") {
                document.getElementById("tangential_acceleration").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            } else if (y2 == "with-gap checking") {
                document.getElementById("tangential_acceleration").classList.remove("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
                document.getElementById("radius").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
            }
        } else if (m == "1") {
            document.getElementById("g-hide2").classList.remove("hidden");
            document.getElementById("inv").classList.remove("hidden");
            document.getElementById("fnv").classList.remove("hidden");
            document.getElementById("time").classList.remove("hidden");
            document.querySelectorAll(".root").forEach(el => el.classList.remove("hidden"));
            document.getElementById("g-hide").classList.add("hidden");
            document.getElementById("g-hide1").classList.add("hidden");
            document.getElementById("tangential_acceleration").classList.add("hidden");
            document.getElementById("radius").classList.add("hidden");
            document.getElementById("total_torque").classList.add("hidden");
            document.getElementById("moment").classList.add("hidden");
            document.getElementById("angular_acceleration").classList.add("hidden");

            var y7 = document.getElementById("g7").className;
            var y8 = document.getElementById("g8").className;
            var y9 = document.getElementById("g9").className;
            var y10 = document.getElementById("g10").className;

            if (y7 == "with-gap checking2") {
                document.getElementById("g-hide2").classList.remove("hidden");
                document.getElementById("inv").classList.remove("hidden");
                document.getElementById("fnv").classList.remove("hidden");
                document.getElementById("time").classList.remove("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.remove("hidden"));
                document.getElementById("g-hide").classList.add("hidden");
                document.getElementById("g-hide1").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("angular_acceleration").classList.add("hidden");
            } else if (y8 == "with-gap checking2") {
                document.getElementById("g-hide2").classList.remove("hidden");
                document.getElementById("inv").classList.remove("hidden");
                document.getElementById("fnv").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.remove("hidden"));
                document.getElementById("g-hide").classList.add("hidden");
                document.getElementById("g-hide1").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
            } else if (y9 == "with-gap checking2") {
                document.getElementById("g-hide2").classList.remove("hidden");
                document.getElementById("time").classList.remove("hidden");
                document.getElementById("fnv").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.remove("hidden"));
                document.getElementById("g-hide").classList.add("hidden");
                document.getElementById("g-hide1").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
            } else if (y10 == "with-gap checking2") {
                document.getElementById("g-hide2").classList.remove("hidden");
                document.getElementById("time").classList.remove("hidden");
                document.getElementById("inv").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.remove("hidden"));
                document.getElementById("g-hide").classList.add("hidden");
                document.getElementById("g-hide1").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
            }
        } else if (m == "2") {
            document.getElementById("g-hide").classList.add("hidden");
            document.getElementById("g-hide2").classList.add("hidden");
            document.getElementById("tangential_acceleration").classList.add("hidden");
            document.getElementById("radius").classList.add("hidden");
            document.getElementById("angular_acceleration").classList.add("hidden");
            document.getElementById("inv").classList.add("hidden");
            document.getElementById("fnv").classList.add("hidden");
            document.getElementById("time").classList.add("hidden");
            document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            document.getElementById("g-hide1").classList.remove("hidden");
            document.getElementById("moment").classList.remove("hidden");
            document.getElementById("total_torque").classList.remove("hidden");

            var y4 = document.getElementById("g4").className;
            var y5 = document.getElementById("g5").className;
            var y6 = document.getElementById("g6").className;

            if (y4 == "with-gap checking3") {
                document.getElementById("moment").classList.remove("hidden");
                document.getElementById("total_torque").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            } else if (y5 == "with-gap checking3") {
                document.getElementById("total_torque").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            } else if (y6 == "with-gap checking3") {
                document.getElementById("moment").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            }
        }
    });
    @if(isset($detail))
        var m = "{{$_POST['find']}}";
        if (m == "0") {
            document.getElementById("g-hide").classList.remove("hidden");
            document.getElementById("tangential_acceleration").classList.remove("hidden");
            document.getElementById("radius").classList.remove("hidden");
            document.getElementById("g-hide1").classList.add("hidden");
            document.getElementById("g-hide2").classList.add("hidden");
            document.getElementById("moment").classList.add("hidden");
            document.getElementById("total_torque").classList.add("hidden");
            document.getElementById("angular_acceleration").classList.add("hidden");
            document.getElementById("inv").classList.add("hidden");
            document.getElementById("fnv").classList.add("hidden");
            document.getElementById("time").classList.add("hidden");
            document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            
            var y = document.getElementById("g1").className;
            var y1 = document.getElementById("g2").className;
            var y2 = document.getElementById("g3").className;

            if (y == "with-gap checking") {
                document.getElementById("tangential_acceleration").classList.remove("hidden");
                document.getElementById("radius").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            } else if (y1 == "with-gap checking") {
                document.getElementById("tangential_acceleration").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            } else if (y2 == "with-gap checking") {
                document.getElementById("tangential_acceleration").classList.remove("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
                document.getElementById("radius").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
            }
        } else if (m == "1") {
            document.getElementById("g-hide2").classList.remove("hidden");
            document.getElementById("inv").classList.remove("hidden");
            document.getElementById("fnv").classList.remove("hidden");
            document.getElementById("time").classList.remove("hidden");
            document.querySelectorAll(".root").forEach(el => el.classList.remove("hidden"));
            document.getElementById("g-hide").classList.add("hidden");
            document.getElementById("g-hide1").classList.add("hidden");
            document.getElementById("tangential_acceleration").classList.add("hidden");
            document.getElementById("radius").classList.add("hidden");
            document.getElementById("total_torque").classList.add("hidden");
            document.getElementById("moment").classList.add("hidden");
            document.getElementById("angular_acceleration").classList.add("hidden");

            var y7 = document.getElementById("g7").className;
            var y8 = document.getElementById("g8").className;
            var y9 = document.getElementById("g9").className;
            var y10 = document.getElementById("g10").className;

            if (y7 == "with-gap checking2") {
                document.getElementById("g-hide2").classList.remove("hidden");
                document.getElementById("inv").classList.remove("hidden");
                document.getElementById("fnv").classList.remove("hidden");
                document.getElementById("time").classList.remove("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.remove("hidden"));
                document.getElementById("g-hide").classList.add("hidden");
                document.getElementById("g-hide1").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("angular_acceleration").classList.add("hidden");
            } else if (y8 == "with-gap checking2") {
                document.getElementById("g-hide2").classList.remove("hidden");
                document.getElementById("inv").classList.remove("hidden");
                document.getElementById("fnv").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.remove("hidden"));
                document.getElementById("g-hide").classList.add("hidden");
                document.getElementById("g-hide1").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
            } else if (y9 == "with-gap checking2") {
                document.getElementById("g-hide2").classList.remove("hidden");
                document.getElementById("time").classList.remove("hidden");
                document.getElementById("fnv").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.remove("hidden"));
                document.getElementById("g-hide").classList.add("hidden");
                document.getElementById("g-hide1").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
            } else if (y10 == "with-gap checking2") {
                document.getElementById("g-hide2").classList.remove("hidden");
                document.getElementById("time").classList.remove("hidden");
                document.getElementById("inv").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.remove("hidden"));
                document.getElementById("g-hide").classList.add("hidden");
                document.getElementById("g-hide1").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
            }
        } else if (m == "2") {
            document.getElementById("g-hide").classList.add("hidden");
            document.getElementById("g-hide2").classList.add("hidden");
            document.getElementById("tangential_acceleration").classList.add("hidden");
            document.getElementById("radius").classList.add("hidden");
            document.getElementById("angular_acceleration").classList.add("hidden");
            document.getElementById("inv").classList.add("hidden");
            document.getElementById("fnv").classList.add("hidden");
            document.getElementById("time").classList.add("hidden");
            document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            document.getElementById("g-hide1").classList.remove("hidden");
            document.getElementById("moment").classList.remove("hidden");
            document.getElementById("total_torque").classList.remove("hidden");

            var y4 = document.getElementById("g4").className;
            var y5 = document.getElementById("g5").className;
            var y6 = document.getElementById("g6").className;

            if (y4 == "with-gap checking3") {
                document.getElementById("moment").classList.remove("hidden");
                document.getElementById("total_torque").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            } else if (y5 == "with-gap checking3") {
                document.getElementById("total_torque").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            } else if (y6 == "with-gap checking3") {
                document.getElementById("moment").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            }
        }
    @endif
    @if(isset($error))
        var m = "{{$_POST['find']}}";
        if (m == "0") {
            document.getElementById("g-hide").classList.remove("hidden");
            document.getElementById("tangential_acceleration").classList.remove("hidden");
            document.getElementById("radius").classList.remove("hidden");
            document.getElementById("g-hide1").classList.add("hidden");
            document.getElementById("g-hide2").classList.add("hidden");
            document.getElementById("moment").classList.add("hidden");
            document.getElementById("total_torque").classList.add("hidden");
            document.getElementById("angular_acceleration").classList.add("hidden");
            document.getElementById("inv").classList.add("hidden");
            document.getElementById("fnv").classList.add("hidden");
            document.getElementById("time").classList.add("hidden");
            document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            
            var y = document.getElementById("g1").className;
            var y1 = document.getElementById("g2").className;
            var y2 = document.getElementById("g3").className;

            if (y == "with-gap checking") {
                document.getElementById("tangential_acceleration").classList.remove("hidden");
                document.getElementById("radius").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            } else if (y1 == "with-gap checking") {
                document.getElementById("tangential_acceleration").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            } else if (y2 == "with-gap checking") {
                document.getElementById("tangential_acceleration").classList.remove("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
                document.getElementById("radius").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
            }
        } else if (m == "1") {
            document.getElementById("g-hide2").classList.remove("hidden");
            document.getElementById("inv").classList.remove("hidden");
            document.getElementById("fnv").classList.remove("hidden");
            document.getElementById("time").classList.remove("hidden");
            document.querySelectorAll(".root").forEach(el => el.classList.remove("hidden"));
            document.getElementById("g-hide").classList.add("hidden");
            document.getElementById("g-hide1").classList.add("hidden");
            document.getElementById("tangential_acceleration").classList.add("hidden");
            document.getElementById("radius").classList.add("hidden");
            document.getElementById("total_torque").classList.add("hidden");
            document.getElementById("moment").classList.add("hidden");
            document.getElementById("angular_acceleration").classList.add("hidden");

            var y7 = document.getElementById("g7").className;
            var y8 = document.getElementById("g8").className;
            var y9 = document.getElementById("g9").className;
            var y10 = document.getElementById("g10").className;

            if (y7 == "with-gap checking2") {
                document.getElementById("g-hide2").classList.remove("hidden");
                document.getElementById("inv").classList.remove("hidden");
                document.getElementById("fnv").classList.remove("hidden");
                document.getElementById("time").classList.remove("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.remove("hidden"));
                document.getElementById("g-hide").classList.add("hidden");
                document.getElementById("g-hide1").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("angular_acceleration").classList.add("hidden");
            } else if (y8 == "with-gap checking2") {
                document.getElementById("g-hide2").classList.remove("hidden");
                document.getElementById("inv").classList.remove("hidden");
                document.getElementById("fnv").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.remove("hidden"));
                document.getElementById("g-hide").classList.add("hidden");
                document.getElementById("g-hide1").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
            } else if (y9 == "with-gap checking2") {
                document.getElementById("g-hide2").classList.remove("hidden");
                document.getElementById("time").classList.remove("hidden");
                document.getElementById("fnv").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.remove("hidden"));
                document.getElementById("g-hide").classList.add("hidden");
                document.getElementById("g-hide1").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
            } else if (y10 == "with-gap checking2") {
                document.getElementById("g-hide2").classList.remove("hidden");
                document.getElementById("time").classList.remove("hidden");
                document.getElementById("inv").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.remove("hidden"));
                document.getElementById("g-hide").classList.add("hidden");
                document.getElementById("g-hide1").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
            }
        } else if (m == "2") {
            document.getElementById("g-hide").classList.add("hidden");
            document.getElementById("g-hide2").classList.add("hidden");
            document.getElementById("tangential_acceleration").classList.add("hidden");
            document.getElementById("radius").classList.add("hidden");
            document.getElementById("angular_acceleration").classList.add("hidden");
            document.getElementById("inv").classList.add("hidden");
            document.getElementById("fnv").classList.add("hidden");
            document.getElementById("time").classList.add("hidden");
            document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            document.getElementById("g-hide1").classList.remove("hidden");
            document.getElementById("moment").classList.remove("hidden");
            document.getElementById("total_torque").classList.remove("hidden");

            var y4 = document.getElementById("g4").className;
            var y5 = document.getElementById("g5").className;
            var y6 = document.getElementById("g6").className;

            if (y4 == "with-gap checking3") {
                document.getElementById("moment").classList.remove("hidden");
                document.getElementById("total_torque").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            } else if (y5 == "with-gap checking3") {
                document.getElementById("total_torque").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.getElementById("moment").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            } else if (y6 == "with-gap checking3") {
                document.getElementById("moment").classList.remove("hidden");
                document.getElementById("angular_acceleration").classList.remove("hidden");
                document.getElementById("total_torque").classList.add("hidden");
                document.getElementById("inv").classList.add("hidden");
                document.getElementById("fnv").classList.add("hidden");
                document.getElementById("time").classList.add("hidden");
                document.getElementById("tangential_acceleration").classList.add("hidden");
                document.getElementById("radius").classList.add("hidden");
                document.querySelectorAll(".root").forEach(el => el.classList.add("hidden"));
            }
        }

    @endif
    
    document.getElementById("g1").addEventListener("click", function() {
        showElements(["tangential_acceleration", "radius"]);
        hideElements(["angular_acceleration", "inv", "fnv", "time", "total_torque", "moment", "root"]);
        toggleClass("g1", "checking", ["g2", "g3"]);
    });

    document.getElementById("g2").addEventListener("click", function() {
        showElements(["tangential_acceleration", "angular_acceleration"]);
        hideElements(["radius", "inv", "fnv", "time", "total_torque", "moment", "root"]);
        toggleClass("g2", "checking", ["g1", "g3"]);
    });

    document.getElementById("g3").addEventListener("click", function() {
        showElements(["radius", "angular_acceleration"]);
        hideElements(["tangential_acceleration", "total_torque", "moment", "inv", "fnv", "time", "root"]);
        toggleClass("g3", "checking", ["g1", "g2"]);
    });

    document.getElementById("g4").addEventListener("click", function() {
        showElements(["moment", "total_torque"]);
        hideElements(["angular_acceleration", "inv", "fnv", "time", "tangential_acceleration", "radius", "root"]);
        toggleClass("g4", "checking3", ["g5", "g6"]);
    });

    document.getElementById("g5").addEventListener("click", function() {
        showElements(["total_torque", "angular_acceleration"]);
        hideElements(["moment", "tangential_acceleration", "inv", "fnv", "time", "radius", "root"]);
        toggleClass("g5", "checking3", ["g4", "g6"]);
    });

    document.getElementById("g6").addEventListener("click", function() {
        showElements(["moment", "angular_acceleration"]);
        hideElements(["total_torque", "inv", "fnv", "time", "tangential_acceleration", "radius", "root"]);
        toggleClass("g6", "checking3", ["g4", "g5"]);
    });

    document.getElementById("g7").addEventListener("click", function() {
        showElements(["g-hide2", "inv", "fnv", "time", "root"]);
        hideElements(["g-hide", "g-hide1", "tangential_acceleration", "radius", "total_torque", "moment", "angular_acceleration"]);
        toggleClass("g7", "checking2", ["g8", "g9", "g10"]);
    });

    document.getElementById("g8").addEventListener("click", function() {
        showElements(["g-hide2", "inv", "fnv", "angular_acceleration", "root"]);
        hideElements(["g-hide", "g-hide1", "tangential_acceleration", "radius", "total_torque", "moment", "time"]);
        toggleClass("g8", "checking2", ["g7", "g9", "g10"]);
    });

    document.getElementById("g9").addEventListener("click", function() {
        showElements(["g-hide2", "time", "fnv", "angular_acceleration", "root"]);
        hideElements(["g-hide", "g-hide1", "tangential_acceleration", "radius", "total_torque", "moment", "inv"]);
        toggleClass("g9", "checking2", ["g7", "g8", "g10"]);
    });

    document.getElementById("g10").addEventListener("click", function() {
        showElements(["g-hide2", "time", "inv", "angular_acceleration", "root"]);
        hideElements(["g-hide", "g-hide1", "tangential_acceleration", "radius", "total_torque", "moment", "fnv"]);
        toggleClass("g10", "checking2", ["g7", "g8", "g9"]);
    });

    function showElements(ids) {
        ids.forEach(id => {
            if (id === "root") {
                document.querySelectorAll(`.${id}`).forEach(el => el.classList.remove("hidden"));
            } else {
                document.getElementById(id).classList.remove("hidden");
            }
        });
    }

    function hideElements(ids) {
        ids.forEach(id => {
            if (id === "root") {
                document.querySelectorAll(`.${id}`).forEach(el => el.classList.add("hidden"));
            } else {
                document.getElementById(id).classList.add("hidden");
            }
        });
    }

    function toggleClass(activeId, className, inactiveIds) {
        document.getElementById(activeId).classList.add(className);
        inactiveIds.forEach(id => document.getElementById(id).classList.remove(className));
    }
   
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>