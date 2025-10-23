<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
    

            <div class="col-span-12">
                <label for="known" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-full py-2 position-relative">
                    <select class="input" name="known" id="known" >
                        <option value="1" {{ isset($_POST['known']) && $_POST['known'] == '1' ? 'selected' : '' }}> {{ $lang['2'] }} </option>
                        <option value="2"  {{ isset($_POST['known']) && $_POST['known'] == '2' ? 'selected' : '' }}> {{ $lang['3'] }}   </option>
                        <option value="3"  {{ isset($_POST['known']) && $_POST['known'] == '3' ? 'selected' : '' }}> {{ $lang['4'] }}   </option>
                        <option value="4"  {{ isset($_POST['known']) && $_POST['known'] == '4' ? 'selected' : '' }}> {{ $lang['5'] }}   </option>
                        <option value="5"  {{ isset($_POST['known']) && $_POST['known'] == '5' ? 'selected' : '' }}> {{ $lang['6'] }}   </option>
                        <option value="6"  {{ isset($_POST['known']) && $_POST['known'] == '6' ? 'selected' : '' }}> {{ $lang['7'] }}   </option>
                        <option value="7"  {{ isset($_POST['known']) && $_POST['known'] == '7' ? 'selected' : '' }}> {{ $lang['8'] }}   </option>
                        <option value="8"  {{ isset($_POST['known']) && $_POST['known'] == '8' ? 'selected' : '' }}> {{ $lang['9'] }}   </option>
                        <option value="9"  {{ isset($_POST['known']) && $_POST['known'] == '9' ? 'selected' : '' }}> {{ $lang['10'] }}   </option>
                        <option value="10"  {{ isset($_POST['known']) && $_POST['known'] == '10' ? 'selected' : '' }}> {{ $lang['11'] }}   </option>
                    </select>
                </div>
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="kin_inp_dis" >
                <label for="cdis" class="font-s-14 text-blue">{{ $lang['12'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="cdis" id="cdis" step="any" readonly="readonly"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cdis'])?$_POST['cdis']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="cdisU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cdisU_dropdown')">{{ isset($_POST['cdisU'])?$_POST['cdisU']:'m' }} ▾</label>
                   <input type="text" name="cdisU" value="{{ isset($_POST['cdisU'])?$_POST['cdisU']:'m' }}" id="cdisU" class="hidden">
                   <div id="cdisU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cdisU">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cdisU', 'm')">m</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cdisU', 'cm')">cm</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cdisU', 'in')">in</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cdisU', 'ft')">ft</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cdisU', 'km')">km</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cdisU', 'mi')">mi</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cdisU', 'yd')">yd</p>
                   </div>
                </div>
              </div>
              <div class="col-span-12 md:col-span-6 lg:col-span-6" id="kin_inp_vli" >
                <label for="iv" class="font-s-14 text-blue">{{ $lang['13'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="iv" id="iv" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['iv'])?$_POST['iv']:'20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="ivU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ivU_dropdown')">{{ isset($_POST['ivU'])?$_POST['ivU']:'m/s' }} ▾</label>
                   <input type="text" name="ivU" value="{{ isset($_POST['ivU'])?$_POST['ivU']:'m/s' }}" id="ivU" class="hidden">
                   <div id="ivU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ivU">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ivU', 'm/s')">m/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ivU', 'ft/s')">ft/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ivU', 'km/h')">km/h</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ivU', 'km/s')">km/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ivU', 'mi/s')">mi/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ivU', 'mph')">mph</p>
                   </div>
                </div>
              </div>
              <div class="col-span-12 md:col-span-6 lg:col-span-6" id="kin_inp_vlf" >
                <label for="fv" class="font-s-14 text-blue">{{ $lang['14'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="fv" id="fv" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fv'])?$_POST['fv']:'30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="fvU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fvU_dropdown')">{{ isset($_POST['fvU'])?$_POST['fvU']:'m/s' }} ▾</label>
                   <input type="text" name="fvU" value="{{ isset($_POST['fvU'])?$_POST['fvU']:'m/s' }}" id="fvU" class="hidden">
                   <div id="fvU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fvU">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fvU', 'm/s')">m/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fvU', 'ft/s')">ft/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fvU', 'km/h')">km/h</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fvU', 'km/s')">km/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fvU', 'mi/s')">mi/s</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fvU', 'mph')">mph</p>
                   </div>
                </div>
              </div>
              <div class="col-span-12 md:col-span-6 lg:col-span-6" id="kin_inp_tim" >
                <label for="ct" class="font-s-14 text-blue">{{ $lang['15'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="ct" id="ct" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ct'])?$_POST['ct']:'40' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="ctU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ctU_dropdown')">{{ isset($_POST['ctU'])?$_POST['ctU']:'m/s' }} ▾</label>
                   <input type="text" name="ctU" value="{{ isset($_POST['ctU'])?$_POST['ctU']:'m/s' }}" id="ctU" class="hidden">
                   <div id="ctU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ctU">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ctU', 'sec')">sec</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ctU', 'min')">min</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ctU', 'h')">h</p>
                   </div>
                </div>
              </div>
              <div class="col-span-12 md:col-span-6 lg:col-span-6 hidden" id="kin_inp_acc" >
                <label for="cac" class="font-s-14 text-blue">{{ $lang['16'] }}</label>
                <div class="relative w-full mt-[7px]">
                   <input type="number" name="cac" id="cac" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['cac'])?$_POST['cac']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                   <label for="cacU" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('cacU_dropdown')">{{ isset($_POST['cacU'])?$_POST['cacU']:'m/s²' }} ▾</label>
                   <input type="text" name="cacU" value="{{ isset($_POST['cacU'])?$_POST['cacU']:'m/s²' }}" id="cacU" class="hidden">
                   <div id="cacU_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="cacU">
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cacU', 'm/s²')">m/s²</p>
                       <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('cacU', 'ft/s²')">ft/s²</p>
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
                        @if(isset($detail))
                        @php
                            function kinAnsTbl($detail, $ans1, $ans11, $ans2, $ans22, $knw1, $knw11, $knw2, $knw22, $knw3, $knw33, $frm1, $frm2, $inpKey) {
                        @endphp
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="50%" ><strong>{{ $ans1 }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail[$ans11] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%" ><strong>{{ $ans2 }} </strong></td>
                                    <td class="py-2 border-b"> {{ $detail[$ans22] }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%" ><strong>\({{ $frm1 }}\) </strong></td>
                                    <td class="py-2 border-b"> <strong>\({{ $frm2 }}\) </strong></td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                        <p class="col"><strong>{{ $inpKey}}</strong></p>
                        <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="50%" >{{ $knw1}}</td>
                                    <td  class="py-2 border-b" ><strong>{{ $detail[$knw11]}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%" >{{ $knw2}}</td>
                                    <td  class="py-2 border-b" ><strong>{{ $detail[$knw22]}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="50%" >{{ $knw3}}</td>
                                    <td  class="py-2 border-b" ><strong>{{ $detail[$knw33]}}</strong></td>
                                </tr>
                            </table>
                        </div>
                        @php
                            }
                        @endphp
                        @endif
                        <div class="w-full font-s-20">
                            <div class="col m10 s12">
                                @php
                                    if (is_numeric($_POST['iv']) && is_numeric($_POST['fv']) && is_numeric($_POST['ct'])) {
                
                                        kinAnsTbl($detail,$lang['12'],'dis',$lang['16'],'a',$lang['13'],'iv',$lang['14'],'fv',$lang['15'],'time','s = \frac{1}{2} (v + u)t','a = \frac{(v-u)}{t}',$lang['17']);
                
                                    } elseif (is_numeric($_POST['iv']) && is_numeric($_POST['fv']) && is_numeric($_POST['cac'])) {
                
                                        kinAnsTbl($detail,$lang['12'],'dis',$lang['15'],'time',$lang['13'],'iv',$lang['14'],'fv',$lang['16'],'a','t = \frac{(v-u)}{a}','s = \frac{1}{2} (v + u)t',$lang['17']);
                
                                    } elseif (is_numeric($_POST['ct']) && is_numeric($_POST['fv']) && is_numeric($_POST['cac'])) {
                
                                        kinAnsTbl($detail,$lang['12'],'dis',$lang['13'],'iv',$lang['14'],'fv',$lang['15'],'time',$lang['16'],'a','u = v-at','s = \frac{1}{2} (v + u)t',$lang['17']);
                
                                    } elseif (is_numeric($_POST['ct']) && is_numeric($_POST['iv']) && is_numeric($_POST['cac'])) {
                
                                        kinAnsTbl($detail,$lang['12'],'dis',$lang['14'],'fv',$lang['13'],'iv',$lang['15'],'time',$lang['16'],'a','v = u+at','s = \frac{1}{2} (v + u)t',$lang['17']);
                
                                    } elseif (is_numeric($_POST['cdis']) && is_numeric($_POST['iv']) && is_numeric($_POST['ct'])) {
                
                                        kinAnsTbl($detail,$lang['14'],'fv',$lang['16'],'a',$lang['12'],'dis',$lang['13'],'iv',$lang['15'],'time','v = \frac{2s}{t}-u','a = \frac{v-u}{t}',$lang['17']);
                
                                    } elseif (is_numeric($_POST['cdis']) && is_numeric($_POST['fv']) && is_numeric($_POST['ct'])) {
                
                                        kinAnsTbl($detail,$lang['13'],'iv',$lang['16'],'a',$lang['12'],'dis',$lang['14'],'fv',$lang['15'],'time','u = \frac{2s}{t}-v','a = \frac{v-u}{t}',$lang['17']);
                
                                    } elseif (is_numeric($_POST['cdis']) && is_numeric($_POST['iv']) && is_numeric($_POST['cac'])) {
                
                                        //Doing Wrong Calculations
                                        kinAnsTbl($detail,$lang['14'],'fv',$lang['15'],'time',$lang['12'],'dis',$lang['13'],'iv',$lang['16'],'a','v = \sqrt{u^2 + 2as}','t = \frac{v-u}{a}',$lang['17']);
                
                                    } elseif (is_numeric($_POST['cdis']) && is_numeric($_POST['fv']) && is_numeric($_POST['cac'])) {
                
                                        kinAnsTbl($detail,$lang['13'],'iv',$lang['15'],'time',$lang['12'],'dis',$lang['14'],'fv',$lang['16'],'a','u = \sqrt{v^2 - 2as}','t = \frac{v-u}{a}',$lang['17']);
                
                                    } elseif (is_numeric($_POST['cdis']) && is_numeric($_POST['iv']) && is_numeric($_POST['fv'])) {
                
                                        kinAnsTbl($detail,$lang['16'],'a',$lang['15'],'time',$lang['12'],'dis',$lang['13'],'iv',$lang['14'],'fv','t = \frac{2s}{v+u}','a = \frac{v-u}{t}',$lang['17']);
                
                                    } elseif (is_numeric($_POST['cdis']) && is_numeric($_POST['ct']) && is_numeric($_POST['cac'])) {
                
                                        kinAnsTbl($detail,$lang['13'],'iv',$lang['14'],'fv',$lang['12'],'dis',$lang['15'],'time',$lang['16'],'a','u = \frac{s}{t} - \frac{1}{2}at','v = u+at',$lang['17']);
                                    }
                                @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>

@push('calculatorJS')
@if(isset($detail))
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
@endif
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('known').addEventListener('change', function() {
        var k = this.value;
        var elementsToModify = {
            dis: document.querySelectorAll('.dis'),
            accel: document.querySelectorAll('.accel'),
            time: document.querySelectorAll('.time'),
            in_vel: document.querySelectorAll('.in_vel'),
            fn_vel: document.querySelectorAll('.fn_vel')
        };

        function setReadonly(elements, readonly) {
            elements.forEach(function(element) {
                element.value = '';
                if (readonly) {
                    element.setAttribute('readonly', 'readonly');
                } else {
                    element.removeAttribute('readonly');
                }
            });
        }

        function showElement(selector) {
            document.querySelector(selector).classList.remove('hidden');
        }

        function hideElement(selector) {
            document.querySelector(selector).classList.add('hidden');
        }

        // Reset all elements to default state
        setReadonly(elementsToModify.dis, false);
        setReadonly(elementsToModify.accel, false);
        setReadonly(elementsToModify.time, false);
        setReadonly(elementsToModify.in_vel, false);
        setReadonly(elementsToModify.fn_vel, false);

        document.querySelectorAll('.kin_inp_wrap, #kin_inp_dis, #kin_inp_acc, #kin_inp_tim, #kin_inp_vli, #kin_inp_vlf').forEach(function(element) {
            element.classList.remove('hidden');
        });

        // Apply specific changes based on the selected value
        if (k == '1') {
            setReadonly(elementsToModify.dis, true);
            setReadonly(elementsToModify.accel, true);
            hideElement('#kin_inp_dis');
            hideElement('#kin_inp_acc');
        } else if (k == '2') {
            setReadonly(elementsToModify.dis, true);
            setReadonly(elementsToModify.time, true);
            hideElement('#kin_inp_dis');
            hideElement('#kin_inp_tim');
        } else if (k == '3') {
            setReadonly(elementsToModify.dis, true);
            setReadonly(elementsToModify.in_vel, true);
            hideElement('#kin_inp_dis');
            hideElement('#kin_inp_vli');
        } else if (k == '4') {
            setReadonly(elementsToModify.dis, true);
            setReadonly(elementsToModify.fn_vel, true);
            hideElement('#kin_inp_dis');
            hideElement('#kin_inp_vlf');
        } else if (k == '5') {
            setReadonly(elementsToModify.accel, true);
            setReadonly(elementsToModify.fn_vel, true);
            hideElement('#kin_inp_acc');
            hideElement('#kin_inp_vlf');
        } else if (k == '6') {
            setReadonly(elementsToModify.accel, true);
            setReadonly(elementsToModify.in_vel, true);
            hideElement('#kin_inp_acc');
            hideElement('#kin_inp_vli');
        } else if (k == '7') {
            setReadonly(elementsToModify.time, true);
            setReadonly(elementsToModify.fn_vel, true);
            hideElement('#kin_inp_tim');
            hideElement('#kin_inp_vlf');
        } else if (k == '8') {
            setReadonly(elementsToModify.time, true);
            setReadonly(elementsToModify.in_vel, true);
            hideElement('#kin_inp_tim');
            hideElement('#kin_inp_vli');
        } else if (k == '9') {
            setReadonly(elementsToModify.time, true);
            setReadonly(elementsToModify.accel, true);
            hideElement('#kin_inp_tim');
            hideElement('#kin_inp_acc');
        } else if (k == '10') {
            setReadonly(elementsToModify.in_vel, true);
            setReadonly(elementsToModify.fn_vel, true);
            hideElement('#kin_inp_vli');
            hideElement('#kin_inp_vlf');
        }
    });
});

@if(isset($detail))
    var k = "{{$_POST['known']}}";

    var elementsToModify = {
            dis: document.querySelectorAll('.dis'),
            accel: document.querySelectorAll('.accel'),
            time: document.querySelectorAll('.time'),
            in_vel: document.querySelectorAll('.in_vel'),
            fn_vel: document.querySelectorAll('.fn_vel')
        };

        function setReadonly(elements, readonly) {
            elements.forEach(function(element) {
                element.value = '';
                if (readonly) {
                    element.setAttribute('readonly', 'readonly');
                } else {
                    element.removeAttribute('readonly');
                }
            });
        }

        function showElement(selector) {
            document.querySelector(selector).classList.remove('hidden');
        }

        function hideElement(selector) {
            document.querySelector(selector).classList.add('hidden');
        }

        document.querySelectorAll('.kin_inp_wrap, #kin_inp_dis, #kin_inp_acc, #kin_inp_tim, #kin_inp_vli, #kin_inp_vlf').forEach(function(element) {
            element.classList.remove('hidden');
        });

        // Apply specific changes based on the selected value
        if (k == '1') {
            hideElement('#kin_inp_dis');
            hideElement('#kin_inp_acc');
        } else if (k == '2') {
            hideElement('#kin_inp_dis');
            hideElement('#kin_inp_tim');
        } else if (k == '3') {
            hideElement('#kin_inp_dis');
            hideElement('#kin_inp_vli');
        } else if (k == '4') {
            hideElement('#kin_inp_dis');
            hideElement('#kin_inp_vlf');
        } else if (k == '5') {
            hideElement('#kin_inp_acc');
            hideElement('#kin_inp_vlf');
        } else if (k == '6') {
            hideElement('#kin_inp_acc');
            hideElement('#kin_inp_vli');
        } else if (k == '7') {
          
            hideElement('#kin_inp_tim');
            hideElement('#kin_inp_vlf');
        } else if (k == '8') {
            hideElement('#kin_inp_tim');
            hideElement('#kin_inp_vli');
        } else if (k == '9') {
           
            hideElement('#kin_inp_tim');
            hideElement('#kin_inp_acc');
        } else if (k == '10') {
           
            hideElement('#kin_inp_vli');
            hideElement('#kin_inp_vlf');
        }

@endif
@if(isset($error))
       var k = "{{$_POST['known']}}";

       var elementsToModify = {
            dis: document.querySelectorAll('.dis'),
            accel: document.querySelectorAll('.accel'),
            time: document.querySelectorAll('.time'),
            in_vel: document.querySelectorAll('.in_vel'),
            fn_vel: document.querySelectorAll('.fn_vel')
        };

        function setReadonly(elements, readonly) {
            elements.forEach(function(element) {
                element.value = '';
                if (readonly) {
                    element.setAttribute('readonly', 'readonly');
                } else {
                    element.removeAttribute('readonly');
                }
            });
        }

        function showElement(selector) {
            document.querySelector(selector).classList.remove('hidden');
        }

        function hideElement(selector) {
            document.querySelector(selector).classList.add('hidden');
        }

        document.querySelectorAll('.kin_inp_wrap, #kin_inp_dis, #kin_inp_acc, #kin_inp_tim, #kin_inp_vli, #kin_inp_vlf').forEach(function(element) {
            element.classList.remove('hidden');
        });

        // Apply specific changes based on the selected value
        if (k == '1') {
            hideElement('#kin_inp_dis');
            hideElement('#kin_inp_acc');
        } else if (k == '2') {
            hideElement('#kin_inp_dis');
            hideElement('#kin_inp_tim');
        } else if (k == '3') {
            hideElement('#kin_inp_dis');
            hideElement('#kin_inp_vli');
        } else if (k == '4') {
            hideElement('#kin_inp_dis');
            hideElement('#kin_inp_vlf');
        } else if (k == '5') {
            hideElement('#kin_inp_acc');
            hideElement('#kin_inp_vlf');
        } else if (k == '6') {
            hideElement('#kin_inp_acc');
            hideElement('#kin_inp_vli');
        } else if (k == '7') {
            hideElement('#kin_inp_tim');
            hideElement('#kin_inp_vlf');
        } else if (k == '8') {
            hideElement('#kin_inp_tim');
            hideElement('#kin_inp_vli');
        } else if (k == '9') {
            hideElement('#kin_inp_tim');
            hideElement('#kin_inp_acc');
        } else if (k == '10') {
            hideElement('#kin_inp_vli');
            hideElement('#kin_inp_vlf');
        }

@endif
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>