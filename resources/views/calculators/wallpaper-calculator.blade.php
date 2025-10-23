<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-4">
                
                <div class="col-span-6 pe-lg-3">
                    <label for="type" class="label one_text">{{$lang['22']}}:</label>
                    <div class="w-100 py-2">
                        <select name="type" id="type" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = [$lang['1'],$lang['2']];
                                $val = ["1","2"];
                                optionsList($val,$name,isset(request()->type)?request()->type:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6 pe-lg-3 rooms hidden">
                    <label for="room_length" class="label  one_text">{{$lang['3']}}:</label>
                    <div class="relative w-full mt-3">
                        <input type="number" name="room_length" id="room_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['room_length'])?$_POST['room_length']:'22' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="room_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('room_length_unit_dropdown')">{{ isset($_POST['room_length_unit'])?$_POST['room_length_unit']:'cm' }} ▾</label>
                        <input type="text" name="room_length_unit" value="{{ isset($_POST['room_length_unit'])?$_POST['room_length_unit']:'cm' }}" id="room_length_unit" class="hidden">
                        <div id="room_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="room_length_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_length_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_length_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_length_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_length_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_length_unit', 'yd')">yd</p>
                        </div>
                    </div>
                </div>

                <div class="col-span-6 pe-lg-3 rooms hidden">
                    <label for="room_width" class="label one_text">{{$lang['4']}}:</label>
                    <div class="relative w-full mt-3">
                        <input type="number" name="room_width" id="room_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['room_width'])?$_POST['room_width']:'22' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="room_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('room_width_unit_dropdown')">{{ isset($_POST['room_width_unit'])?$_POST['room_width_unit']:'cm' }} ▾</label>
                        <input type="text" name="room_width_unit" value="{{ isset($_POST['room_width_unit'])?$_POST['room_width_unit']:'cm' }}" id="room_width_unit" class="hidden">
                        <div id="room_width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="room_width_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_width_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_width_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_width_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_width_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_width_unit', 'yd')">yd</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-6 pe-lg-3 rooms hidden">
                    <label for="room_height" class="label one_text">{{$lang['5']}}:</label>
                    <div class="relative w-full mt-3">
                        <input type="number" name="room_height" id="room_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['room_height'])?$_POST['room_height']:'12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="room_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('room_height_unit_dropdown')">{{ isset($_POST['room_height_unit'])?$_POST['room_height_unit']:'m' }} ▾</label>
                        <input type="text" name="room_height_unit" value="{{ isset($_POST['room_height_unit'])?$_POST['room_height_unit']:'m' }}" id="room_height_unit" class="hidden">
                        <div id="room_height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="room_height_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_height_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_height_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_height_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_height_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('room_height_unit', 'yd')">yd</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-6  walls">
                    <label for="wall_width" class="label one_text">{{$lang['6']}}:</label>
                    <div class="relative w-full mt-3">
                        <input type="number" name="wall_width" id="wall_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wall_width'])?$_POST['wall_width']:'12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="wall_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wall_width_unit_dropdown')">{{ isset($_POST['wall_width_unit'])?$_POST['wall_width_unit']:'m' }} ▾</label>
                        <input type="text" name="wall_width_unit" value="{{ isset($_POST['wall_width_unit'])?$_POST['wall_width_unit']:'m' }}" id="wall_width_unit" class="hidden">
                        <div id="wall_width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wall_width_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wall_width_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wall_width_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wall_width_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wall_width_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wall_width_unit', 'yd')">yd</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-6 pe-lg-3 walls">
                    <label for="wall_height" class="label one_text">{{$lang['7']}}:</label>
                    <div class="relative w-full mt-3">
                        <input type="number" name="wall_height" id="wall_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['wall_height'])?$_POST['wall_height']:'20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="wall_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('wall_height_unit_dropdown')">{{ isset($_POST['wall_height_unit'])?$_POST['wall_height_unit']:'m' }} ▾</label>
                        <input type="text" name="wall_height_unit" value="{{ isset($_POST['wall_height_unit'])?$_POST['wall_height_unit']:'m' }}" id="wall_height_unit" class="hidden">
                        <div id="wall_height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="wall_height_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wall_height_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wall_height_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wall_height_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wall_height_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('wall_height_unit', 'yd')">yd</p>
                        </div>
                    </div>
                </div>
                <p class="col-span-12">{{$lang['8']}}</p>

                <div class="col-span-6 pe-lg-3">
                  <label for="door_height" class="label one_text">{{$lang['9']}}:</label>
                    <div class="relative w-full mt-3">
                        <input type="number" name="door_height" id="door_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['door_height'])?$_POST['door_height']:'20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="door_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('door_height_unit_dropdown')">{{ isset($_POST['door_height_unit'])?$_POST['door_height_unit']:'m' }} ▾</label>
                        <input type="text" name="door_height_unit" value="{{ isset($_POST['door_height_unit'])?$_POST['door_height_unit']:'m' }}" id="door_height_unit" class="hidden">
                        <div id="door_height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="door_height_unit">
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('door_height_unit', 'cm')">cm</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('door_height_unit', 'm')">m</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('door_height_unit', 'in')">in</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('door_height_unit', 'ft')">ft</p>
                            <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('door_height_unit', 'yd')">yd</p>
                        </div>
                    </div>
                </div>
                <div class="col-span-6 pe-lg-3">
                    <label for="door_width" class="label one_text">{{$lang['10']}}:</label>
                      <div class="relative w-full mt-3">
                          <input type="number" name="door_width" id="door_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['door_width'])?$_POST['door_width']:'20' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                          <label for="door_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('door_width_unit_dropdown')">{{ isset($_POST['door_width_unit'])?$_POST['door_width_unit']:'m' }} ▾</label>
                          <input type="text" name="door_width_unit" value="{{ isset($_POST['door_width_unit'])?$_POST['door_width_unit']:'m' }}" id="door_width_unit" class="hidden">
                          <div id="door_width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="door_width_unit">
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('door_width_unit', 'cm')">cm</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('door_width_unit', 'm')">m</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('door_width_unit', 'in')">in</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('door_width_unit', 'ft')">ft</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('door_width_unit', 'yd')">yd</p>
                          </div>
                      </div>
                  </div>
                <div class="col-span-6 pe-lg-3">
                    <label for="no_of_doors" class="label one_text">{{$lang['11']}}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="no_of_doors" id="no_of_doors" class="input" aria-label="input"
                            value="{{ isset(request()->no_of_doors) ? request()->no_of_doors : '15' }}" />
                    </div>
                </div>

                <p class="col-span-12">{{$lang['12']}}</p>
                <div class="col-span-6 pe-lg-3">
                    <label for="window_height" class="label one_text">{{$lang['13']}}:</label>
                      <div class="relative w-full mt-3">
                          <input type="number" name="window_height" id="window_height" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['window_height'])?$_POST['window_height']:'6' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                          <label for="window_height_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('window_height_unit_dropdown')">{{ isset($_POST['window_height_unit'])?$_POST['window_height_unit']:'m' }} ▾</label>
                          <input type="text" name="window_height_unit" value="{{ isset($_POST['window_height_unit'])?$_POST['window_height_unit']:'m' }}" id="window_height_unit" class="hidden">
                          <div id="window_height_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="window_height_unit">
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('window_height_unit', 'cm')">cm</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('window_height_unit', 'm')">m</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('window_height_unit', 'in')">in</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('window_height_unit', 'ft')">ft</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('window_height_unit', 'yd')">yd</p>
                          </div>
                      </div>
                  </div>

                  <div class="col-span-6 pe-lg-3">
                    <label for="window_width" class="label one_text">{{$lang['13']}}:</label>
                      <div class="relative w-full mt-3">
                          <input type="number" name="window_width" id="window_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['window_width'])?$_POST['window_width']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                          <label for="window_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('window_width_unit_dropdown')">{{ isset($_POST['window_width_unit'])?$_POST['window_width_unit']:'m' }} ▾</label>
                          <input type="text" name="window_width_unit" value="{{ isset($_POST['window_width_unit'])?$_POST['window_width_unit']:'m' }}" id="window_width_unit" class="hidden">
                          <input type="hidden" name="currancy" value="{{$currancy}}">
                          <div id="window_width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="window_width_unit">
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('window_width_unit', 'cm')">cm</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('window_width_unit', 'm')">m</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('window_width_unit', 'in')">in</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('window_width_unit', 'ft')">ft</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('window_width_unit', 'yd')">yd</p>
                          </div>
                      </div>
                  </div>
                <div class="col-span-6 pe-lg-3">
                    <label for="no_of_windows" class="label one_text">{{$lang['15']}}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="no_of_windows" id="no_of_windows" class="input" aria-label="input"
                            value="{{ isset(request()->no_of_windows) ? request()->no_of_windows : '10' }}" />
                    </div>
                </div>
                <p class="col-span-12">{{$lang['16']}}</p>

                <div class="col-span-6 pe-lg-3">
                    <label for="roll_length" class="label one_text">{{$lang['17']}}:</label>
                      <div class="relative w-full mt-3">
                          <input type="number" name="roll_length" id="roll_length" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['roll_length'])?$_POST['roll_length']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                          <label for="roll_length_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('roll_length_unit_dropdown')">{{ isset($_POST['roll_length_unit'])?$_POST['roll_length_unit']:'m' }} ▾</label>
                          <input type="text" name="roll_length_unit" value="{{ isset($_POST['roll_length_unit'])?$_POST['roll_length_unit']:'m' }}" id="roll_length_unit" class="hidden">
                          <input type="hidden" name="currancy" value="{{$currancy}}">
                          <div id="roll_length_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="roll_length_unit">
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('roll_length_unit', 'cm')">cm</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('roll_length_unit', 'm')">m</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('roll_length_unit', 'in')">in</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('roll_length_unit', 'ft')">ft</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('roll_length_unit', 'yd')">yd</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-span-6 pe-lg-3">
                    <label for="roll_width" class="label one_text">{{$lang['17']}}:</label>
                      <div class="relative w-full mt-3">
                          <input type="number" name="roll_width" id="roll_width" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['roll_width'])?$_POST['roll_width']:'8' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                          <label for="roll_width_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('roll_width_unit_dropdown')">{{ isset($_POST['roll_width_unit'])?$_POST['roll_width_unit']:'m' }} ▾</label>
                          <input type="text" name="roll_width_unit" value="{{ isset($_POST['roll_width_unit'])?$_POST['roll_width_unit']:'m' }}" id="roll_width_unit" class="hidden">
                          <input type="hidden" name="currancy" value="{{$currancy}}">
                          <div id="roll_width_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="roll_width_unit">
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('roll_width_unit', 'cm')">cm</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('roll_width_unit', 'm')">m</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('roll_width_unit', 'in')">in</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('roll_width_unit', 'ft')">ft</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('roll_width_unit', 'yd')">yd</p>
                          </div>
                      </div>
                  </div>
                <div class="col-span-6 pe-lg-3">
                    <label for="cost" class="label one_text"><?=$lang['19'] ?> (<?=$lang['20']?>):</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="cost" id="cost" class="input" aria-label="input"
                            value="{{ isset(request()->cost) ? request()->cost : '7' }}" />
                            <span class="input-unit text-blue">{{$currancy}}</span>
                    </div>
                </div>
                <div class="col-span-6 pe-lg-3">
                    <label for="pattern" class="label one_text">{{$lang['21']}}:</label>
                      <div class="relative w-full mt-3">
                          <input type="number" name="pattern" id="pattern" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['pattern'])?$_POST['pattern']:'0.1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                          <label for="pattern_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('pattern_unit_dropdown')">{{ isset($_POST['pattern_unit'])?$_POST['pattern_unit']:'m' }} ▾</label>
                          <input type="text" name="pattern_unit" value="{{ isset($_POST['pattern_unit'])?$_POST['pattern_unit']:'m' }}" id="pattern_unit" class="hidden">
                          <input type="hidden" name="currancy" value="{{$currancy}}">
                          <div id="pattern_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="pattern_unit">
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pattern_unit', 'cm')">cm</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pattern_unit', 'm')">m</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pattern_unit', 'in')">in</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pattern_unit', 'ft')">ft</p>
                              <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('pattern_unit', 'yd')">yd</p>
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
                    @php
                        $cost = request()->cost;   
                    @endphp
                    <div class="w-full my-1">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td width="60%" class="border-b py-2"><strong>Wall surface area :</strong></td>
                                    <td class="border-b py-2"><?=round($detail['area'],3)?><span class="font-s-14"> (m<sup>2</sup>)</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>Total doors area :</strong></td>
                                    <td class="border-b py-2"><?=$detail['door_area']?><span class="font-s-14"> (m<sup>2</sup>)</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>Total windows area :</strong></td>
                                    <td class="border-b py-2"><?=round($detail['window_area'],3)?><span class="font-s-14"> (m<sup>2</sup>)</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>Adjusted height :</strong></td>
                                    <td class="border-b py-2"><?=round($detail['adjusted_height'],3)?> <span class="font-s-14"> m</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>Adjusted wall area :</strong></td>
                                    <td class="border-b py-2"><?=round($detail['adjusted_wall_area'],3)?><span class="font-s-14"> (m<sup>2</sup>)</span></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong>Number of rolls :</strong></td>
                                    <td class="border-b py-2"><?=intval($detail['number_of_rolls'])?></td>
                                </tr>
                                @if(!empty($detail['costs']))
                                    <tr>
                                        <td class="border-b py-2"><strong>Total cost :</strong></td>
                                        <td class="border-b py-2">{{$currancy}} <?=intval($detail['costs'])?></td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
        var walls = document.querySelectorAll('.walls');
        var rooms = document.querySelectorAll('.rooms');
        @if(isset($error) || isset($detail))
            var type = document.getElementById('type').value;
            if(type === '2'){
                walls.forEach(element => {
                    element.style.display="none";
                });
                rooms.forEach(element => {
                    element.style.display="block";
                });
            }else{
                walls.forEach(element => {
                    element.style.display="block";
                });
                rooms.forEach(element => {
                    element.style.display="none";
                });
            }
        @endif
        document.getElementById('type').addEventListener('change',function(){
            var type = this.value;
            if(type === '2'){
                walls.forEach(element => {
                    element.style.display="none";
                });
                rooms.forEach(element => {
                    element.style.display="block";
                });
            }else{
                walls.forEach(element => {
                    element.style.display="block";
                });
                rooms.forEach(element => {
                    element.style.display="none";
                });
            }
        });
    </script>
@endpush
