<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-4">
                <div class="col-span-12">
                    <label for="method" class="font-s-14 text-blue">{{ $lang['method']}}</label>
                    <div class="w-full py-2 position-relative">
                        <select class="input" name="method" id="method">
                            <option value="1"  {{ isset($_POST['method']) && $_POST['method']=='1'?'selected':''}}> {{ $lang['et']}}</option>
                            <option value="2"  {{ isset($_POST['method']) && $_POST['method']=='2'?'selected':''}}> {{$lang['ts']}} </option>
                            <option value="3"  {{ isset($_POST['method']) && $_POST['method']=='3'?'selected':''}} >{{$lang['rpm']}} </option>
                            <option value="4"  {{ isset($_POST['method']) && $_POST['method']=='4'?'selected':''}} >{{$lang['base']}} </option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 weight">
                    <label for="weight" class="font-s-14 text-blue" >{{ $lang['weight']}} </label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="weight" id="weight" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['weight']) ? $_POST['weight'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_w" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_w_dropdown')">{{ isset($_POST['unit_w'])?$_POST['unit_w']:'lbs' }} ▾</label>
                        <input type="text" name="unit_w" value="{{ isset($_POST['unit_w'])?$_POST['unit_w']:'lbs' }}" id="unit_w" class="hidden">
                        <div id="unit_w_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_w">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_w', 'lbs')">lbs</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_w', 'min')">min</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 trap">
                    <label for="time" class="font-s-14 text-blue" >{{ $lang['time']}} </label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="time" id="time" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['time']) ? $_POST['time'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_t" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_t_dropdown')">{{ isset($_POST['unit_t'])?$_POST['unit_t']:'sec' }} ▾</label>
                        <input type="text" name="unit_t" value="{{ isset($_POST['unit_t'])?$_POST['unit_t']:'sec' }}" id="unit_t" class="hidden">
                        <div id="unit_t_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_t">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_t', 'sec')">sec</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_t', 'min')">min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_t', 'h')">h</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 elapsed hidden">
                    <label for="speed" class="font-s-14 text-blue" >{{ $lang['speed']}} </label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="speed" id="speed" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['speed']) ? $_POST['speed'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_s" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_s_dropdown')">{{ isset($_POST['unit_s'])?$_POST['unit_s']:'mph' }} ▾</label>
                        <input type="text" name="unit_s" value="{{ isset($_POST['unit_s'])?$_POST['unit_s']:'mph' }}" id="unit_s" class="hidden">
                        <div id="unit_s_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_s">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_s', 'mph')">mph</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_s', 'km/s')">km/s</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_s', 'km/h')">km/h</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_s', 'm/s')">m/s</p>
                        </div>
                     </div>
                </div>
               
            </div>
            <div class="grid grid-cols-12 based hidden">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="force" class="font-s-14 text-blue" >{{ $lang['for']}} </label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="force" id="force" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['force']) ? $_POST['force'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="for_u" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('for_u_dropdown')">{{ isset($_POST['for_u'])?$_POST['for_u']:'N' }} ▾</label>
                        <input type="text" name="for_u" value="{{ isset($_POST['for_u'])?$_POST['for_u']:'N' }}" id="for_u" class="hidden">
                        <div id="for_u_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="for_u">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('for_u', 'mph')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('for_u', 'kN')">kN</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('for_u', 'MN')">MN</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('for_u', 'GN')">GN</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('for_u', 'TN')">TN</p>
                        </div>
                     </div>
                </div>
              
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="distance" class="font-s-14 text-blue" >{{ $lang['dis']}} </label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="distance" id="distance" step="any" min="1" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['distance']) ? $_POST['distance'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="dis_u" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dis_u_dropdown')">{{ isset($_POST['dis_u'])?$_POST['dis_u']:'m' }} ▾</label>
                        <input type="text" name="dis_u" value="{{ isset($_POST['dis_u'])?$_POST['dis_u']:'m' }}" id="dis_u" class="hidden">
                        <div id="dis_u_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dis_u">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_u', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_u', 'km')">km</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_u', 'yd')">yd</p>
                        </div>
                     </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="btime" class="font-s-14 text-blue" >{{ $lang['time']}} </label>
                    <div class="relative w-full mt-[7px]">
                        <input type="number" name="btime" id="btime" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['btime']) ? $_POST['btime'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="unit_bt" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_bt_dropdown')">{{ isset($_POST['unit_bt'])?$_POST['unit_bt']:'sec' }} ▾</label>
                        <input type="text" name="unit_bt" value="{{ isset($_POST['unit_bt'])?$_POST['unit_bt']:'sec' }}" id="unit_bt" class="hidden">
                        <div id="unit_bt_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="unit_bt">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_bt', 'sec')">sec</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_bt', 'min')">min</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_bt', 'h')">h</p>
                        </div>
                     </div>
                </div>
            </div>
            <div class="grid grid-cols-12 torque hidden">
                <div class="col-span-12">
                    <label for="to" class="font-s-14 text-blue">To Calculate:</label>
                    <div class="w-full py-2 position-relative">
                        <select class="input" name="to" id="to">
                            <option value="1"  {{ isset($_POST['to']) && $_POST['to']=='1'?'selected':''}}> {{ $lang['eh']}}</option>
                            <option value="2"  {{ isset($_POST['to']) && $_POST['to']=='2'?'selected':''}}> {{$lang['tor']}} </option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="rpm" class="font-s-14 text-blue">Engine RPM:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="rpm" id="rpm" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['rpm'])?$_POST['rpm']:'00' }}" />
                    </div>
                </div>
                <div class="col-span-12 tor">
                    <label for="tor" class="font-s-14 text-blue">{{ $lang['tor']}}</label>
                    <div class="w-full py-2 relative">
                        <input type="number" step="any" name="tor" id="tor" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['tor'])?$_POST['tor']:'00' }}" />
                        <span class="text-blue input_unit">ft-lb</span>
                    </div>
                </div>
                <div class="col-span-12 hidden hors">
                    <label for="hors" class="font-s-14 text-blue">{{ $lang['eh']}}</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="hors" id="hors" class="input" aria-label="input" placeholder="413" value="{{ isset($_POST['hors'])?$_POST['hors']:'00' }}" />
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
                        <div class="w-full md:w-[40%] lg:w-[40%]  mt-2">
                            @if($_POST['method']==1 || $_POST['method']==2 || ($_POST['method']==3) && $_POST['to']==1)
                                <p class="mt-2">{{$lang['pow']}}</p>
                                <p class="mt-2 py-2 border-b"><strong>{{$detail['hpm']}} {{$lang['hpm']}}</strong></p>
                                <p class="my-2">It is equivalent to</p>
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{$detail['hpmet']}} {{$lang['hpmet']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{$detail['hpkw']}} {{$lang['kilo']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{$detail['hpm']*550}} {{$lang['ft']}}</strong></td>
                                    </tr>
                                </table>
                            @elseif($_POST['method']==4)
                                <p class="mt-2">{{$lang['pow']}}</p>
                                    <p class="mt-2"><strong>{{$detail['hp']}} {{$lang['wat']}}</strong></p>
                                    <p class="mt-2">It is equivalent to</p>
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{$detail['hp']/100}} {{$lang['kilo']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{round($detail['hp']*0.001341,7)}} {{$lang['hpm']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{round($detail['hp']*0.001360,7)}} {{$lang['hpmet']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{round($detail['hp']/746,7)}} {{$lang['hpel']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{round($detail['hp']/9810,7)}} {{$lang['hpb']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b"><strong>{{round($detail['hp']*0.7376,7)}} {{$lang['ft']}}</strong></td>
                                    </tr>
                                </table>
                            @elseif($_POST['method']==3 && $_POST['to']==2)
                                    <p class="mt-2">{{$lang['tor']}} = <strong>{{$detail['tor']}} <sub>ft-lb</sub></strong></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

  <script>

    <?php if(isset($_POST['to'])): ?>
    document.addEventListener('DOMContentLoaded', function() {
        var to = document.getElementById('to').value;

        // Helper function to add or remove the hidden class
        function toggleClass(className, add) {
            document.querySelectorAll('.' + className).forEach(function(element) {
                if (add) {
                    element.classList.add('hidden');
                } else {
                    element.classList.remove('hidden');
                }
            });
        }

        if (to == 1) {
            toggleClass('tor', false);  // Show elements with class tor
            toggleClass('hors', true);  // Hide elements with class hors
        } else {
            toggleClass('tor', true);   // Hide elements with class tor
            toggleClass('hors', false); // Show elements with class hors
        }
    });
<?php endif; ?>

    <?php if(isset($_POST['method'])): ?>
    document.addEventListener('DOMContentLoaded', function() {
        var method = document.getElementById('method').value;

        // Helper function to add or remove the hidden class
        function toggleClass(className, add) {
            document.querySelectorAll('.' + className).forEach(function(element) {
                if (add) {
                    element.classList.add('hidden');
                } else {
                    element.classList.remove('hidden');
                }
            });
        }

        if (method == 1) {
            toggleClass('trap', false);  // Show elements with class trap
            toggleClass('weight', false); // Show elements with class weight
            toggleClass('elapsed', true); // Hide elements with class elapsed
            toggleClass('based', true);   // Hide elements with class based
            toggleClass('torque', true);  // Hide elements with class torque
        } else if (method == 2) {
            toggleClass('trap', true);    // Hide elements with class trap
            toggleClass('weight', false); // Show elements with class weight
            toggleClass('elapsed', false); // Show elements with class elapsed
            toggleClass('based', true);   // Hide elements with class based
            toggleClass('torque', true);  // Hide elements with class torque
        } else if (method == 4) {
            toggleClass('trap', true);    // Hide elements with class trap
            toggleClass('weight', true);  // Hide elements with class weight
            toggleClass('elapsed', true); // Hide elements with class elapsed
            toggleClass('based', false);  // Show elements with class based
            toggleClass('torque', true);  // Hide elements with class torque
        } else if (method == 3) {
            toggleClass('trap', true);    // Hide elements with class trap
            toggleClass('weight', true);  // Hide elements with class weight
            toggleClass('elapsed', true); // Hide elements with class elapsed
            toggleClass('based', true);   // Hide elements with class based
            toggleClass('torque', false); // Show elements with class torque
        }
    });
<?php endif; ?>







    document.getElementById('method').addEventListener('change', function() {
    var method = document.getElementById('method').value;

    // Helper function to add or remove the hidden class
    function toggleClass(className, add) {
        document.querySelectorAll('.' + className).forEach(function(element) {
            if (add) {
                element.classList.add('hidden');
            } else {
                element.classList.remove('hidden');
            }
        });
    }

    if (method == 1) {
        toggleClass('trap', false);  // Show elements with class trap
        toggleClass('weight', false); // Show elements with class weight
        toggleClass('elapsed', true); // Hide elements with class elapsed
        toggleClass('based', true);   // Hide elements with class based
        toggleClass('torque', true);  // Hide elements with class torque
    } else if (method == 2) {
        toggleClass('trap', true);    // Hide elements with class trap
        toggleClass('weight', false); // Show elements with class weight
        toggleClass('elapsed', false); // Show elements with class elapsed
        toggleClass('based', true);   // Hide elements with class based
        toggleClass('torque', true);  // Hide elements with class torque
    } else if (method == 4) {
        toggleClass('trap', true);    // Hide elements with class trap
        toggleClass('weight', true);  // Hide elements with class weight
        toggleClass('elapsed', true); // Hide elements with class elapsed
        toggleClass('based', false);  // Show elements with class based
        toggleClass('torque', true);  // Hide elements with class torque
    } else if (method == 3) {
        toggleClass('trap', true);    // Hide elements with class trap
        toggleClass('weight', true);  // Hide elements with class weight
        toggleClass('elapsed', true); // Hide elements with class elapsed
        toggleClass('based', true);   // Hide elements with class based
        toggleClass('torque', false); // Show elements with class torque
    }
});



    document.getElementById('to').addEventListener('change', function() {
        var to = document.getElementById('to').value;
        if (to == 1) {
            document.querySelector('.tor').style.display = 'block';
            document.querySelector('.hors').style.display = 'none';
        } else {
            document.querySelector('.tor').style.display = 'none';
            document.querySelector('.hors').style.display = 'block';
        }
    });

</script>