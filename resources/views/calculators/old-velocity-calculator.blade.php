<style>
    @media (max-width: 380px) {
        .calculator-box{
            padding-left: 0.5rem; 
            padding-right: 0.5rem; 
        }
    }
    .velocitytab .v_active{
        border-bottom: 3px solid var(--light-blue);
    }
    .velocitytab .v_active strong{
        color: var(--light-blue);
    }
    .velocitytab p{
        position: relative;
        top: 2px;
    }
    .active{
        background-color: var(--light-blue);;
        color: white;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="col-12 col-lg-12 mx-auto">
        <div class="row">
            <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[70%] w-full">
                <input type="hidden" name="velo_value" id="velo_value" value="{{ isset($_POST['velo_value'])?$_POST['velo_value']:'5' }}">

                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                            
                        <div class="lg:w-1/3 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit " id="distanceTab">
                                {{$lang['d_c']}}
                            </div>
                        </div>
                        <div class="lg:w-1/3 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white " id="accTab">
                                {{$lang['a']}}
                            </div>
                        </div>
                        <div class="lg:w-1/3 w-full px-2 py-1">
                            <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white " id="timeTab">
                                {{$lang['av']}}
                            </div>
                        </div>
                    
                    </div>
            </div>
            <input type="hidden" name="type" id="type" value="f_v">
            <input type="hidden" name="ans" id="ans" value="{{ $lang['f_v'] }}">
            <div class="lg:w-8/12 mx-auto mt-3 test1" id="test1">
                <div class="grid grid-cols-2 gap-2 mt-4">
                    <!-- Distance Input -->
                    <div class="px-2">
                        <label for="x21" class="label">{{ $lang['d'] }}</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="x" id="x21" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 w-full" value="{{ isset($_POST['x'])?$_POST['x']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="dis_unit" class="absolute text-blue-500 cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dis_unit_dropdown')">{{ isset($_POST['dis_unit'])?$_POST['dis_unit']:'m' }} ▾</label>
                            <input type="text" name="dis_unit" value="{{ isset($_POST['dis_unit'])?$_POST['dis_unit']:'m' }}" id="dis_unit" class="hidden">
                            <div id="dis_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'in')">in</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'ft')">ft</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'yd')">yd</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'm')">m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'cm')">cm</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'km')">km</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'mi')">mi</p>
                            </div>
                        </div>
                    </div>
                    <!-- Time Input -->
                    <div class="px-2 lg:mt-0">
                        <label for="y21" class="label">{{ $lang['t'] }}</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="y" id="y21" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 w-full" value="{{ isset($_POST['y'])?$_POST['y']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="time_unit" class="absolute text-blue-500 cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('time_unit_dropdown')">{{ isset($_POST['time_unit'])?$_POST['time_unit']:'sec' }} ▾</label>
                            <input type="text" name="time_unit" value="{{ isset($_POST['time_unit'])?$_POST['time_unit']:'sec' }}" id="time_unit" class="hidden">
                            <div id="time_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
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
                    <!-- Velocity Input -->
                    <div class="px-2 ">
                        <label for="y22" class="label">{{ $lang['v'] }}</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="z" id="y22" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 w-full" value="{{ isset($_POST['z'])?$_POST['z']:'' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="val_unit" class="absolute text-blue-500 cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('val_unit_dropdown')">{{ isset($_POST['val_unit'])?$_POST['val_unit']:'m/s' }} ▾</label>
                            <input type="text" name="val_unit" value="{{ isset($_POST['val_unit'])?$_POST['val_unit']:'m/s' }}" id="val_unit" class="hidden">
                            <div id="val_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('val_unit', 'm/s')">m/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('val_unit', 'km/h')">km/h</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('val_unit', 'ft/s')">ft/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('val_unit', 'mph')">mph</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('val_unit', 'kn')">kn</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('val_unit', 'ft/m')">ft/m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('val_unit', 'cm/s')">cm/s</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:w-8/12 mx-auto mt-3 hidden test2" id="test2">
                <div class="grid grid-cols-2 gap-2 mt-4">
                    <div class="px-2">
                        <label for="x11" class="label"  id="x1">{{ $lang['i_v'] }}</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="x1" id="x11" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 w-full" value="{{ isset($_POST['x1'])?$_POST['x1']:'' }}" aria-label="input" placeholder="00" oninput="checkInputs()"/>
                            <label for="iv_unit" class="absolute text-blue-500 cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('iv_unit_dropdown')">{{ isset($_POST['iv_unit'])?$_POST['iv_unit']:'m/s' }} ▾</label>
                            <input type="text" name="iv_unit" value="{{ isset($_POST['iv_unit'])?$_POST['iv_unit']:'m/s' }}" id="iv_unit" class="hidden">
                            <div id="iv_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('iv_unit', 'm/s')">m/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('iv_unit', 'km/h')">km/h</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('iv_unit', 'ft/s')">ft/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('iv_unit', 'mph')">mph</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('iv_unit', 'kn')">kn</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('iv_unit', 'ft/m')">ft/m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('iv_unit', 'cm/s')">cm/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('iv_unit', 'm/min')">m/min</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        <label for="z11" class="label"  id="z1">{{ $lang['f_v'] }}</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="z1" id="z11" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 w-full" value="{{ isset($_POST['z1'])?$_POST['z1']:'' }}" aria-label="input" placeholder="00" oninput="checkInputs()"/>
                            <label for="fv_unit" class="absolute text-blue-500 cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fv_unit_dropdown')">{{ isset($_POST['fv_unit'])?$_POST['fv_unit']:'m/s' }} ▾</label>
                            <input type="text" name="fv_unit" value="{{ isset($_POST['fv_unit'])?$_POST['fv_unit']:'m/s' }}" id="fv_unit" class="hidden">
                            <div id="fv_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fv_unit', 'm/s')">m/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fv_unit', 'km/h')">km/h</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fv_unit', 'ft/s')">ft/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fv_unit', 'mph')">mph</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fv_unit', 'kn')">kn</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fv_unit', 'ft/m')">ft/m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fv_unit', 'cm/s')">cm/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fv_unit', 'm/min')">m/min</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        <label for="acc" class="label"  id="z1">{{ $lang['a'] }}</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="acc" id="acc" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 w-full" value="{{ isset($_POST['acc'])?$_POST['acc']:'' }}" aria-label="input" placeholder="00" oninput="checkInputs()"/>
                            <label for="acc_unit" class="absolute text-blue-500 cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('acc_unit_dropdown')">{{ isset($_POST['acc_unit'])?$_POST['acc_unit']:'in/s²' }} ▾</label>
                            <input type="text" name="acc_unit" value="{{ isset($_POST['acc_unit'])?$_POST['acc_unit']:'in/s²' }}" id="acc_unit" class="hidden">
                            <div id="acc_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('acc_unit', 'in/s²')">in/s²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('acc_unit', 'ft/s²')">ft/s²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('acc_unit', 'cm/s²')">cm/s²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('acc_unit', 'm/s²')">m/s²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('acc_unit', 'mi/s²')">mi/s²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('acc_unit', 'km/s²')">km/s²</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('acc_unit', 'g')">g</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        <label for="y11" class="label"  id="z1">{{ $lang['t'] }}</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="y1" id="y11" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 w-full" value="{{ isset($_POST['y1'])?$_POST['y1']:'' }}" aria-label="input" placeholder="00" oninput="checkInputs()"/>
                            <label for="atime_unit" class="absolute text-blue-500 cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('atime_unit_dropdown')">{{ isset($_POST['atime_unit'])?$_POST['atime_unit']:'sec' }} ▾</label>
                            <input type="text" name="atime_unit" value="{{ isset($_POST['atime_unit'])?$_POST['atime_unit']:'sec' }}" id="atime_unit" class="hidden">
                            <div id="atime_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('atime_unit', 'sec')">sec</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('atime_unit', 'min')">min</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('atime_unit', 'hrs')">hrs</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('atime_unit', 'days')">days</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('atime_unit', 'wks')">wks</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('atime_unit', 'mos')">mos</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('atime_unit', 'yrs')">yrs</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:w-8/12 mx-auto mt-3 hidden test3" id="test3">
                <div class="grid grid-cols-2 gap-2 mt-4">
                    <div class="px-2">
                        <label for="vs" class="label"  id="z1">{{ $lang['v'] }}</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="vs[]" id="vs" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 w-full" value="{{ isset(request()->vs) ? request()->vs[0] :'' }}" aria-label="input" placeholder="00" />
                            <label for="vs_unit" class="absolute text-blue-500 cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('vs_unit_dropdown')">{{ isset(request()->vs_unit)? request()->vs_unit[0]:'m/s' }} ▾</label>
                            <input type="text" name="vs_unit[]" value="{{ isset(request()->vs_unit)? request()->vs_unit[0]:'m/s' }}" id="vs_unit" class="hidden">
                            <div id="vs_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit', 'm/s')">m/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit', 'km/h')">km/h</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit', 'ft/s')">ft/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit', 'mph')">mph</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit', 'kn')">kn</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit', 'ft/m')">ft/m</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit', 'cm/s')">cm/s</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit', 'm/min')">m/min</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        <label for="avt" class="label"  id="z1">{{ $lang['t'] }}</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="avt[]" id="avt" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 w-full" value="{{ isset(request()->avt)? request()->avt[0]:'' }}" aria-label="input" placeholder="00" />
                            <label for="avt_unit" class="absolute text-blue-500 cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('avt_unit_dropdown')">{{ isset(request()->avt_unit)? request()->avt_unit[0]:'sec' }} ▾</label>
                            <input type="text" name="avt_unit[]" value="{{ isset(request()->avt_unit)? request()->avt_unit[0]:'sec' }}" id="avt_unit" class="hidden">
                            <div id="avt_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit', 'sec')">sec</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit', 'min')">min</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit', 'hrs')">hrs</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit', 'days')">days</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit', 'wks')">wks</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit', 'mos')">mos</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit', 'yrs')">yrs</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="  time_add">
                    @if(isset($_POST['vs']) && count($_POST['vs']) > 1)
                        @php $j = 0; @endphp
                        @foreach ($_POST['vs'] as $key => $value)
                            @if($key > 0) 

                            <div class="px-2">
                                <label for="vs{{ $j }}" class="label"  id="z1">{{ $lang['v'] }}</label>
                                <div class="relative w-full py-2">
                                    <input type="number" name="vs[]" id="vs{{ $j }}" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 w-full"  value="{{ isset(request()->vs[$key]) ? request()->vs[$key] : '' }}" aria-label="input" placeholder="00" />
                                    <label for="vs_unit" class="absolute text-blue-500 cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('vs_unit_dropdown')">{{ isset(request()->vs_unit[$key]) ? request()->vs_unit[$key] : 'm/s' }} ▾</label>
                                    <input type="text" name="vs_unit[]" value="{{ isset(request()->vs_unit[$key]) ? request()->vs_unit[$key] : 'm/s' }}" id="vs_unit{{ $j }}" class="hidden">
                                    <div id="vs_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit', 'm/s')">m/s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit', 'km/h')">km/h</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit', 'ft/s')">ft/s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit', 'mph')">mph</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit', 'kn')">kn</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit', 'ft/m')">ft/m</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit', 'cm/s')">cm/s</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit', 'm/min')">m/min</p>
                                    </div>
                                </div>
                            </div>
                            <div class="px-2">
                                <label for="avt{{ $j }}"  class="label"  id="z1">{{ $lang['t'] }}</label>
                                <div class="relative w-full py-2">
                                    <input type="number" name="avt[]" id="avt{{ $j }}" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 w-full" value="{{ isset(request()->avt[$key]) ? request()->avt[$key] : '' }}" aria-label="input" placeholder="00" />
                                    <label for="avt_unit" class="absolute text-blue-500 cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('avt_unit_dropdown')"> {{ isset(request()->avt_unit[$key]) ? request()->avt_unit[$key] : 'sec' }} ▾</label>
                                    <input type="text" name="avt_unit[]" value=" {{ isset(request()->avt_unit[$key]) ? request()->avt_unit[$key] : 'sec' }}" id="avt_unit{{ $j }}" class="hidden">
                                    <div id="avt_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit', 'sec')">sec</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit', 'min')">min</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit', 'hrs')">hrs</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit', 'days')">days</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit', 'wks')">wks</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit', 'mos')">mos</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit', 'yrs')">yrs</p>
                                    </div>
                                </div>
                            </div>

                            @php $j++; @endphp
                            @endif
                        @endforeach
                    @endif
                </div>
                <div class="flex flex-wrap time_due">
            <button type="button" title="Add New Semester" class="px-7 py-3 border cursor-pointer add_semester text-[#ffffff] bg-[#2845F5] rounded-[30px] text-sm mt-3">+ <?=$lang['adrow']?></button>
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
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg p-4 flex items-center justify-center">
                <div class="w-full bg-white p-3 rounded-lg mt-3">
                    @php
                            $ans_t = $detail['ans_t'];
                            $unit = $detail['unit'];
                    @endphp
                    <div class="flex justify-center">
                        <div class="text-center">
                            <p class="text-lg font-semibold">
                                <strong>{{ $detail['ans_t'] }}</strong>
                            </p>
                            <p class="text-xl bg-[#2845F5] px-4 py-2 rounded-lg inline-block my-3">
                                <strong class="text-black answer" id="circle_result">{{ $detail['ans'] }}</strong>
                                <select name="circle_unit_result" id="onetw" class="d-inline border-0 text-blue outline-0 font-s-16">
                                    @php
                                        function optionsList($arr1,$arr2,$unit){
                                        foreach($arr1 as $index => $name){
                                    @endphp
                                        <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                            {{ $arr2[$index] }}
                                        </option>
                                    @php
                                        }}
                                        if($detail['ans_t'] == 'Distance'){
                                            $name = ["m","cm","in","ft","yd","km","mi"];
                                            $val = ["m","cm","in","ft","yd","km","mi"];
                                        }elseif($ans_t == 'Final Velocity' || $ans_t == 'Initial Velocity' || $ans_t == 'Velocity' || $ans_t == 'Avrage Velocity') {
                                            $name = ["m/s","km/h","ft/s","mph","kn","ft/m","cm/s"];
                                            $val = ["m/s","km/h","ft/s","mph","kn","ft/m","cm/s"];
                                        }elseif($ans_t == 'Time'){
                                            $name = ["sec","min","hrs","days","weeks","months","year"];
                                            $val = ["s","m","h","d","w","m","y"];
                                        }elseif($ans_t == 'Acceleration'){
                                            $name = ["m/s²","cm/s²","in/s²","ft/s²","km/s²","mi/s²","g"];
                                            $val = ["m/s²","cm/s²","in/s²","ft/s²","km/s²","mi/s²","g"];
                                        }
                                        optionsList($val,$name,isset($_POST['circle_unit_result'])?$_POST['circle_unit_result']:$unit);
                                    @endphp
                                </select>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script>
            @if(isset($detail))
                document.addEventListener("DOMContentLoaded", () => {
                    // Conversion factors for different units and types
                    const conversionFactors = {
                        'Distance': {
                            'm': 1,
                            'cm': 100,
                            'in': 39.3701,
                            'ft': 3.28084,
                            'yd': 1.09361,
                            'km': 0.001,
                            'mi': 0.000621371
                        },
                        'Velocity': {
                            'm/s': 1,
                            'km/h': 3.6,
                            'ft/s': 3.28084,
                            'mph': 2.23694,
                            'kn': 1.94384,
                            'ft/m': 196.8504,
                            'cm/s': 100,
                            'm/min': 60
                        },
                        'Avrage Velocity': {
                            'm/s': 1,
                            'km/h': 3.6,
                            'ft/s': 3.28084,
                            'mph': 2.23694,
                            'kn': 1.94384,
                            'ft/m': 196.8504,
                            'cm/s': 100,
                            'm/min': 60
                        },
                        'Final Velocity': {
                            'm/s': 1,
                            'km/h': 3.6,
                            'ft/s': 3.28084,
                            'mph': 2.23694,
                            'kn': 1.94384,
                            'ft/m': 196.8504,
                            'cm/s': 100,
                            'm/min': 60
                        },
                        'Initial Velocity': {
                            'm/s': 1,
                            'km/h': 3.6,
                            'ft/s': 3.28084,
                            'mph': 2.23694,
                            'kn': 1.94384,
                            'ft/m': 196.8504,
                            'cm/s': 100,
                            'm/min': 60
                        },
                        'Time': {
                            's': 1,
                            'm': 60,
                            'h': 3600,
                            'd': 86400,
                            'w': 604800,
                            'm': 2.628e+6,
                            'y': 3.154e+7,
                        },
                        'Acceleration': {
                            'm/s²': 1,
                            'cm/s²': 100,
                            'in/s²': 39.3701,
                            'ft/s²': 3.28084,
                            'yd/s²': 1.09361,
                            'km/s²': 0.001,
                            'mi/s²': 0.000621371,
                            'g': 	0.10197162129779
                        }
                    };

                    const circleResultDiv = document.getElementById('circle_result');
                    const initialValue = parseFloat(circleResultDiv.innerText);
                    circleResultDiv.setAttribute('data-initial-value', initialValue);

                    document.getElementById('onetw').addEventListener('change', event => {
                        const unitType = "{{ $ans_t }}"; // PHP variable for the unit type
                        const unit = event.target.value;
                        
                        if (unitType == 'Time' && conversionFactors[unitType][unit] !== undefined) {
                            console.log(unitType);
                            const conversionFactor = conversionFactors[unitType][unit];
                            const originalValue = parseFloat(circleResultDiv.getAttribute('data-initial-value'));
                            const newValue = originalValue / conversionFactor;
                            circleResultDiv.innerText = Number(newValue.toFixed(10)).toString();
                        }else if (conversionFactors[unitType] && conversionFactors[unitType][unit] !== undefined) {
                            const conversionFactor = conversionFactors[unitType][unit];
                            const originalValue = parseFloat(circleResultDiv.getAttribute('data-initial-value'));
                            const newValue = originalValue * conversionFactor;
                            circleResultDiv.innerText = Number(newValue.toFixed(10)).toString();
                        } else {
                            console.error("Invalid conversion factor for unit: " + unit);
                        }
                    });
                });
            @endif
            function checkInputs() {
                const inputs = [
                    document.getElementById('x11'),
                    document.getElementById('y11'),
                    document.getElementById('z11'),
                    document.getElementById('acc'),
                ];

                let filledCount = 0;
                inputs.forEach(input => {
                    if (input.value.trim() !== '') {
                        filledCount++;
                    }
                });

                if (filledCount === 3) {
                    inputs.forEach(input => {
                        if (input.value.trim() === '') {
                            input.disabled = true;
                            input.style.backgroundColor = 'gainsboro';
                        }
                    });
                } else {
                    inputs.forEach(input => {
                        input.disabled = false;
                        input.style.backgroundColor = '';
                    });
                }
            }
            function checkInput() {
                const input = [
                    document.getElementById('x21'),
                    document.getElementById('y21'),
                    document.getElementById('y22'),
                ];

                let filledCount = 0;
                input.forEach(input => {
                    if (input.value.trim() !== '') {
                        filledCount++;
                    }
                });

                if (filledCount === 2) {
                    input.forEach(input => {
                        if (input.value.trim() === '') {
                            input.disabled = true;
                            input.style.backgroundColor = 'gainsboro';
                        }
                    });
                } else {
                    input.forEach(input => {
                        input.disabled = false;
                        input.style.backgroundColor = '';
                    });
                }
            }
            @if(isset($detail) || isset($error))
                function checkInputs() {
                    const inputs = [
                        document.getElementById('x11'),
                        document.getElementById('y11'),
                        document.getElementById('z11'),
                        document.getElementById('acc'),
                    ];

                    let filledCount = 0;
                    inputs.forEach(input => {
                        if (input.value.trim() !== '') {
                            filledCount++;
                        }
                    });

                    if (filledCount === 3) {
                        inputs.forEach(input => {
                            if (input.value.trim() === '') {
                                input.disabled = true;
                                input.style.backgroundColor = 'gainsboro';
                            }
                        });
                    } else {
                        inputs.forEach(input => {
                            input.disabled = false;
                            input.style.backgroundColor = '';
                        });
                    }
                }
                function checkInput() {
                    const input = [
                        document.getElementById('x21'),
                        document.getElementById('y21'),
                        document.getElementById('y22'),
                    ];

                    let filledCount = 0;
                    input.forEach(input => {
                        if (input.value.trim() !== '') {
                            filledCount++;
                        }
                    });

                    if (filledCount === 2) {
                        input.forEach(input => {
                            if (input.value.trim() === '') {
                                input.disabled = true;
                                input.style.backgroundColor = 'gainsboro';
                            }
                        });
                    } else {
                        input.forEach(input => {
                            input.disabled = false;
                            input.style.backgroundColor = '';
                        });
                    }
                }
                document.addEventListener('DOMContentLoaded', function() {
                    checkInputs();
                    checkInput();
                });
            @endif
            var j=1;
            document.querySelector('.add_semester').addEventListener('click',function(){
                // this.style.display = 'none';
                j++;
                add_semester(j);
            });
            function add_semester(count){
                var semester = `
                    <div class="grid grid-cols-2 gap-2">   
                        <div class="px-2">
                            <label for="vs" class="label"  id="z1">{{ $lang['v'] }}</label>
                            <div class="relative w-full py-2">
                                <input type="number" name="vs[]" id="vs${j}" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 w-full" value="{{ isset(request()->vs) ? (isset(request()->vs[0]) ? request()->vs[0] : '') : '' }}" aria-label="input" placeholder="00" oninput="checkInputs()"/>
                                <label for="vs_unit${j}" class="absolute text-blue-500 cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('vs_unit${j}_dropdown')"> {{ isset(request()->vs_unit) ? (isset(request()->vs_unit[0]) ? request()->vs_unit[0] : 'm/s') : 'm/s' }} ▾</label>
                                <input type="text" name="vs_unit[]" value="{{ isset(request()->vs_unit) ? (isset(request()->vs_unit[0]) ? request()->vs_unit[0] : 'm/s') : 'm/s' }}" id="vs_unit${j}" class="hidden">
                                <div id="vs_unit${j}_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit${j}', 'm/s')">m/s</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit${j}', 'km/h')">km/h</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit${j}', 'ft/s')">ft/s</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit${j}', 'mph')">mph</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit${j}', 'kn')">kn</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit${j}', 'ft/m')">ft/m</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit${j}', 'cm/s')">cm/s</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('vs_unit${j}', 'm/min')">m/min</p>
                                </div>
                            </div>
                        </div>
                        <div class="w-full lg:w-2/2 px-2">
                            <label for="avt${j}" class="label"  id="z1">{{ $lang['t'] }}</label>
                            <div class="relative w-full py-2">
                                <input type="number" name="avt[]" id="avt${j}" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 w-full" value="{{ isset(request()->avt) ? (isset(request()->avt[0]) ? request()->avt[0] : '') : '' }}" aria-label="input" placeholder="00" />
                                <label for="avt_unit${j}" class="absolute text-blue-500 cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('avt_unit${j}_dropdown')">{{ isset(request()->avt_unit) ? (isset(request()->avt_unit[0]) ? request()->avt_unit[0] : 'sec') : 'sec' }} ▾</label>
                                <input type="text" name="avt_unit[]" value="{{ isset(request()->avt_unit) ? (isset(request()->avt_unit[0]) ? request()->avt_unit[0] : 'sec') : 'sec' }}" id="avt_unit${j}" class="hidden">
                                <div id="avt_unit${j}_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit${j}', 'sec')">sec</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit${j}', 'min')">min</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit${j}', 'hrs')">hrs</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit${j}', 'days')">days</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit${j}', 'wks')">wks</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit${j}', 'mos')">mos</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('avt_unit${j}', 'yrs')">yrs</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;

                let semesterElement = document.createElement('div');
                semesterElement.classList.add('w-full');
                semesterElement.innerHTML = semester;
                document.querySelector('.time_add').append(semesterElement);
            }
        </script>
        <script>

            document.getElementById('distanceTab').addEventListener('click', function() {
                this.classList.add('tagsUnit');
                document.getElementById('velo_value').value = "5";

                document.getElementById('accTab').classList.remove('tagsUnit');
                document.getElementById('timeTab').classList.remove('tagsUnit');
                document.querySelectorAll('.test1').forEach(element => {
                    element.classList.remove("hidden");
                });
                document.querySelectorAll('.test2').forEach(element => {
                    element.classList.add("hidden");
                });
                document.querySelectorAll('.test3').forEach(element => {
                    element.classList.add("hidden");
                });
            });

            document.getElementById('accTab').addEventListener('click', function() {
                this.classList.add('tagsUnit');
                document.getElementById('velo_value').value = "3";
                document.getElementById('timeTab').classList.remove('tagsUnit');
                document.getElementById('distanceTab').classList.remove('tagsUnit');
                document.querySelectorAll('.test2').forEach(element => {
                    element.classList.remove("hidden");
                });
                document.querySelectorAll('.test1').forEach(element => {
                    element.classList.add("hidden");
                });

                document.querySelectorAll('.test3').forEach(element => {
                    element.classList.add("hidden");
                });

            });


            document.getElementById('timeTab').addEventListener('click', function() {
                this.classList.add('tagsUnit');
                document.getElementById('velo_value').value = "4";
                document.getElementById('accTab').classList.remove('tagsUnit');
                document.getElementById('distanceTab').classList.remove('tagsUnit');
                document.querySelectorAll('.test3').forEach(element => {
                    element.classList.remove("hidden");
                });
                document.querySelectorAll('.test1').forEach(element => {
                    element.classList.add("hidden");
                });

                document.querySelectorAll('.test2').forEach(element => {
                    element.classList.add("hidden");
                });

            });





            @if(isset($detail) || isset($error))


            let element = document.querySelector('.time_add');

            if (element) {
                element.classList.add('grid', 'grid-cols-2', 'gap-2');
            }


            velo_value = '{{$_POST['velo_value']}}';

            if (velo_value === '5') {

                document.getElementById('distanceTab').classList.add('tagsUnit');
                document.getElementById('accTab').classList.remove('tagsUnit');
                document.getElementById('timeTab').classList.remove('tagsUnit');
                document.querySelectorAll('.test1').forEach(element => {
                    element.classList.remove("hidden");
                });
                document.querySelectorAll('.test2').forEach(element => {
                    element.classList.add("hidden");
                });
                document.querySelectorAll('.test3').forEach(element => {
                    element.classList.add("hidden");
                });
            }

            if (velo_value === '3') {

                document.getElementById('velo_value').value = "3";
                document.getElementById('accTab').classList.add('tagsUnit');
                document.getElementById('timeTab').classList.remove('tagsUnit');
                document.getElementById('distanceTab').classList.remove('tagsUnit');
                document.querySelectorAll('.test2').forEach(element => {
                    element.classList.remove("hidden");
                });
                document.querySelectorAll('.test1').forEach(element => {
                    element.classList.add("hidden");
                });

                document.querySelectorAll('.test3').forEach(element => {
                    element.classList.add("hidden");
                });
            }

            if (velo_value === '4') {

                document.getElementById('velo_value').value = "4";
                document.getElementById('timeTab').classList.add('tagsUnit');
                document.getElementById('accTab').classList.remove('tagsUnit');
                document.getElementById('distanceTab').classList.remove('tagsUnit');
                document.querySelectorAll('.test3').forEach(element => {
                    element.classList.remove("hidden");
                });
                document.querySelectorAll('.test1').forEach(element => {
                    element.classList.add("hidden");
                });

                document.querySelectorAll('.test2').forEach(element => {
                    element.classList.add("hidden");
                });
            }
        @endif
        </script>
        <script>

            function toggleDropdown(id) {
                const dropdown = document.getElementById(id);
                dropdown.classList.toggle('hidden');
            }

            function setUnit(inputId, value) {
                document.getElementById(inputId).value = value;
                document.querySelector(`label[for="${inputId}"]`).textContent = value + ' ▾';
                toggleDropdown(inputId + '_dropdown');
            }

            // Close all open dropdowns when clicking outside
            document.addEventListener('click', function (event) {
                // Get all dropdowns
                const dropdowns = document.querySelectorAll('.dropdown');

                dropdowns.forEach(dropdown => {
                    // If the click is outside the dropdown and the input, close the dropdown
                    if (!dropdown.contains(event.target) && !dropdown.previousElementSibling.contains(event.target)) {
                        dropdown.classList.add('hidden');
                    }
                });
            });

        </script>
    @endpush
</form>