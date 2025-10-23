@php
    error_reporting(0);

    function gethours($total_sec=''){
        return str_pad(floor($total_sec/3600), 2, "0", STR_PAD_LEFT);
    }
    function getmins($total_sec=''){
        $mins=$total_sec-(gethours($total_sec)*3600);
        return str_pad(floor($mins/60), 2, "0", STR_PAD_LEFT);
    }
    function getsecs($value=''){
        return str_pad(round($value-(gethours($value)*3600)-(getmins($value)*60)), 2, "0", STR_PAD_LEFT);
    }
    function gettime($seconds){
        $hour=gethours($seconds);
        $mins=getmins($seconds);
        $sec=getsecs($seconds);
        return "$hour : $mins : $sec";
    }
@endphp
<style>



.pace_border::after{content:'';background:var(--white);position:absolute;width:100%;height:2px;bottom:0;border-radius:20px;border:1px solid #d0cfcf}.pace_tab.active{border-bottom:3px solid var(--light-blue);z-index:2}.pace_tab.active::after{content:'';background:var(--light-blue);position:absolute;width:5px;height:5px;bottom:-6px;right:46%;transform:rotate(45deg);z-index:2}.pacetabs{position:absolute;top:-36px;left:4%}@media (max-width:991px){.pacetabs{left:0}}.table-p-2 tr td{padding:2px!important}input[type="number"]:disabled,input[type="text"]:disabled{cursor:not-allowed}.roll_val_9,.roll_val_8,.roll_val_7,.coin_val_7,.coin_val_8,.coin_val_9{display:none}.border-0{border:0}@media (max-width:991px){.border-md-b{border-bottom:2px solid var(--white)}}@media (max-width:575px){.radius-sm-10{border-radius:10px}}

</style>
<form class="row relative" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class=" mx-auto mt-2  w-full">
        <input type="hidden" name="calculator_name" id="calculator_name" value="calculator1">
            <div class="flex flex-wrap items-center bg-blue-100 border border-greeblue text-center rounded-lg px-1">
                <div class="lg:w-1/4 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer text-[12px] rounded-md transition-colors duration-300  hover_tags pacetab hover:text-white tagsUnit " id="calculator1" data-value="calculator1">
                        {{ $cal_name }}
                    </div>
                </div>
                <div class="lg:w-1/4 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer text-[12px] rounded-md transition-colors duration-300  hover_tags pacetab hover:text-white " id="calculator2" data-value="calculator2">
                            {{ $lang['21'] }}
                    </div>
                </div>
                <div class="lg:w-1/4 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer text-[12px] rounded-md transition-colors duration-300  hover_tags pacetab hover:text-white " id="calculator3" data-value="calculator3">
                            {{ $lang['20'] }}
                    </div>
                </div>
                <div class="lg:w-1/4 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer text-[12px] rounded-md transition-colors duration-300  hover_tags pacetab hover:text-white " id="calculator4" data-value="calculator4">
                            {{ $lang['16'] }}
                    </div>
                </div>
            </div>
        </div>



       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="row grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 calculator1">
                    <div class="row grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12">
                            <div class="row grid grid-cols-12 mt-3  my-5  gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-10 md:col-span-6 lg:col-span-6">
                                <div class="w-full flex justify-between text-[14px] pace_border relative">
                                    <p id="pace_tab" class="pace_tab px-3 active"><strong>{{ $lang['1'] }}</strong></p>
                                    <p id="time_tab" class="pace_tab px-3"><strong>{{ $lang['2'] }}</strong></p>
                                    <p id="distance_tab" class="pace_tab px-3"><strong>{{ $lang['3'] }}</strong></p>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="time" class="label">{!! $lang['2'] !!} (hh:mm:ss):</label>
                            <div class="w-100 py-2 relative">
                                <input type="text" name="time" id="time" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['time'])?$_POST['time']:'00:05:13' }}" />
                            </div>
                        </div>
                        <input type="hidden" name="type" value="pace" id="type">

                        <div class="col-span-12 md:col-span-6 lg:col-span-6 dis">
                            <label for="dis" class="label">{{ $lang['3'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="dis" id="dis" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dis']) ? $_POST['dis'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="dis_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dis_unit_dropdown')">{{ isset($_POST['dis_unit'])?$_POST['dis_unit']:'mi' }} ▾</label>
                                <input type="text" name="dis_unit" value="{{ isset($_POST['dis_unit'])?$_POST['dis_unit']:'mi' }}" id="dis_unit" class="hidden">
                                <div id="dis_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dis_unit">
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'mi')">miles (mi)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'km')">kilometers (km)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'm')">meters (m)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit', 'yd')">yards (yd)</p>
                                </div>
                             </div>
                        </div>

                    
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 event">
                            <label for="event" class="label">{!! $lang['4'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <select name="event" id="event" class="input">
                                    @php
                                        function optionsList($arr1,$arr2,$unit){
                                        foreach($arr1 as $index => $name){
                                    @endphp
                                        <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                            {!! $arr2[$index] !!}
                                        </option>
                                    @php
                                        }}
                                        $name = [$lang['5'],"Marathon","Half-Marathon","1K","5K","10K","1 Miles","5 Miles","10 Miles","800 meters","1500 meters"];
                                        $val = ["","1","2","3","4","5","6","7","8","9","10"];
                                        optionsList($val,$name,isset($_POST['event'])?$_POST['event']:'');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 pace hidden">
                            <label for="pace" class="label flex">{!! $lang['1'] !!} <span class="text-blue hh">(hh:mm:ss)</span>:</label>
                            <div class="w-100 py-2 relative">
                                <input type="text" name="pace" id="pace" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['pace'])?$_POST['pace']:'00:07:33' }}" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 pace hidden">
                            <label for="per" class="label">{!! $lang['6'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <select name="per" id="per" class="input">
                                    @php
                                        $name = [$lang['5'],"Marathon","Half-Marathon","1K","5K","10K","1 Miles","5 Miles","10 Miles","800 meters","1500 meters"];
                                        $val = ["","1","2","3","4","5","6","7","8","9","10"];
                                        optionsList($val,$name,isset($_POST['per'])?$_POST['per']:'1');
                                    @endphp
                                </select>
                            </div>
                        </div>
                  
                    </div>
                </div>
                <div class="col-span-12 calculator2 hidden">
                    <div class="row grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

                        <div class="col-span-6">
                            <label for="dis1" class="label">{{ $lang['3'] }}:</label>
                            <div class="flex items-center">
                                <span class="label">1:</span>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="fdis" id="fdis" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fdis']) ? $_POST['fdis'] : '1' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="dis_unit1" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dis_unit1_dropdown')">{{ isset($_POST['dis_unit1'])?$_POST['dis_unit1']:'mi' }} ▾</label>
                                <input type="text" name="dis_unit1" value="{{ isset($_POST['dis_unit1'])?$_POST['dis_unit1']:'mi' }}" id="dis_unit1" class="hidden">
                                <div id="dis_unit1_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dis_unit1">
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit1', 'mi')">miles (mi)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit1', 'km')">kilometers (km)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit1', 'm')">meters (m)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit1', 'yd')">yards (yd)</p>
                                </div>
                             </div>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="time1" class="label">{!! $lang['2'] !!} (hh:mm:ss):</label>
                            <div class="w-100 py-2 relative">
                                <input type="text" name="time1" id="time1" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['time1'])?$_POST['time1']:'00:03:13' }}" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="flex items-center">
                                <span class="label">2:</span>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="dis2" id="dis2" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dis2']) ? $_POST['dis2'] : '2' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="dis_unit2" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dis_unit2_dropdown')">{{ isset($_POST['dis_unit2'])?$_POST['dis_unit2']:'mi' }} ▾</label>
                                <input type="text" name="dis_unit2" value="{{ isset($_POST['dis_unit2'])?$_POST['dis_unit2']:'mi' }}" id="dis_unit2" class="hidden">
                                <div id="dis_unit2_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dis_unit2">
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit2', 'mi')">miles (mi)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit2', 'km')">kilometers (km)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit2', 'm')">meters (m)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit2', 'yd')">yards (yd)</p>
                                </div>
                             </div>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="w-100 py-2 relative">
                                <input type="text" name="time2" id="time2" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['time2'])?$_POST['time2']:'00:06:26' }}" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="flex items-center">
                                <span for="dis3" class="label">3:</span>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="dis3" id="dis3" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dis3']) ? $_POST['dis3'] : '3' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="dis_unit3" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dis_unit3_dropdown')">{{ isset($_POST['dis_unit3'])?$_POST['dis_unit3']:'mi' }} ▾</label>
                                <input type="text" name="dis_unit3" value="{{ isset($_POST['dis_unit3'])?$_POST['dis_unit3']:'mi' }}" id="dis_unit3" class="hidden">
                                <div id="dis_unit3_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dis_unit3">
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit3', 'mi')">miles (mi)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit3', 'km')">kilometers (km)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit3', 'm')">meters (m)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit3', 'yd')">yards (yd)</p>
                                </div>
                             </div>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="w-100 py-2 relative">
                                <input type="text" name="time3" id="time3" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['time3'])?$_POST['time3']:'00:09:55' }}" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="flex items-center">
                                <span for="dis4" class="label">4:</span>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="dis4" id="dis4" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dis4']) ? $_POST['dis4'] : '4' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="dis_unit4" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dis_unit4_dropdown')">{{ isset($_POST['dis_unit4'])?$_POST['dis_unit4']:'mi' }} ▾</label>
                                <input type="text" name="dis_unit4" value="{{ isset($_POST['dis_unit4'])?$_POST['dis_unit4']:'mi' }}" id="dis_unit4" class="hidden">
                                <div id="dis_unit4_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dis_unit4">
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit4', 'mi')">miles (mi)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit4', 'km')">kilometers (km)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit4', 'm')">meters (m)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit4', 'yd')">yards (yd)</p>
                                </div>
                             </div>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="w-100 py-2 relative">
                                <input type="text" name="time4" id="time4" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['time4'])?$_POST['time4']:'00:12:13' }}" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="flex items-center">
                                <span for="dis5" class="label">5:</span>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="dis5" id="dis5" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dis5']) ? $_POST['dis5'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="dis_unit5" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dis_unit5_dropdown')">{{ isset($_POST['dis_unit5'])?$_POST['dis_unit5']:'mi' }} ▾</label>
                                <input type="text" name="dis_unit5" value="{{ isset($_POST['dis_unit5'])?$_POST['dis_unit5']:'mi' }}" id="dis_unit5" class="hidden">
                                <div id="dis_unit5_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dis_unit5">
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit5', 'mi')">miles (mi)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit5', 'km')">kilometers (km)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit5', 'm')">meters (m)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit5', 'yd')">yards (yd)</p>
                                </div>
                             </div>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="w-100 py-2 relative">
                                <input type="text" name="time5" id="time5" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['time5'])?$_POST['time5']:'' }}" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="flex items-center">
                                <span for="dis6" class="label">6:</span>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="dis6" id="dis6" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dis6']) ? $_POST['dis6'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="dis_unit6" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dis_unit6_dropdown')">{{ isset($_POST['dis_unit6'])?$_POST['dis_unit6']:'mi' }} ▾</label>
                                <input type="text" name="dis_unit6" value="{{ isset($_POST['dis_unit6'])?$_POST['dis_unit6']:'mi' }}" id="dis_unit6" class="hidden">
                                <div id="dis_unit6_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dis_unit6">
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit6', 'mi')">miles (mi)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit6', 'km')">kilometers (km)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit6', 'm')">meters (m)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit6', 'yd')">yards (yd)</p>
                                </div>
                             </div>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="w-100 py-2 relative">
                                <input type="text" name="time6" id="time6" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['time6'])?$_POST['time6']:'' }}" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="flex items-center">
                                <span for="dis7" class="label">7:</span>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="dis7" id="dis7" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dis7']) ? $_POST['dis7'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="dis_unit7" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dis_unit7_dropdown')">{{ isset($_POST['dis_unit7'])?$_POST['dis_unit7']:'mi' }} ▾</label>
                                <input type="text" name="dis_unit7" value="{{ isset($_POST['dis_unit7'])?$_POST['dis_unit7']:'mi' }}" id="dis_unit7" class="hidden">
                                <div id="dis_unit7_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dis_unit7">
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit7', 'mi')">miles (mi)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit7', 'km')">kilometers (km)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit7', 'm')">meters (m)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit7', 'yd')">yards (yd)</p>
                                </div>
                             </div>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="w-100 py-2 relative">
                                <input type="text" name="time7" id="time7" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['time7'])?$_POST['time7']:'' }}" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="flex items-center">
                                <span for="dis8" class="label">8:</span>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="dis8" id="dis8" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dis8']) ? $_POST['dis8'] : '' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="dis_unit8" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dis_unit8_dropdown')">{{ isset($_POST['dis_unit8'])?$_POST['dis_unit8']:'mi' }} ▾</label>
                                <input type="text" name="dis_unit8" value="{{ isset($_POST['dis_unit8'])?$_POST['dis_unit8']:'mi' }}" id="dis_unit8" class="hidden">
                                <div id="dis_unit8_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="dis_unit8">
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit8', 'mi')">miles (mi)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit8', 'km')">kilometers (km)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit8', 'm')">meters (m)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dis_unit8', 'yd')">yards (yd)</p>
                                </div>
                             </div>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <div class="w-100 py-2 relative">
                                <input type="text" name="time8" id="time8" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['time8'])?$_POST['time8']:'' }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 calculator3 hidden">
                    <div class="row grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                            <label for="from" class="label flex">{!! $lang['14'] !!} <span class="text-blue hhm">(hh:mm:ss)</span>:</label>
                            <div class="w-full py-2 relative">
                                <input type="text" name="from" id="from" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['from'])?$_POST['from']:'00:07:33' }}" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="fromu" class="label">&nbsp;</label>
                            <div class="w-100 py-2 relative">
                                <select name="fromu" id="fromu" class="input">
                                    @php
                                        $name = [$lang['6'],$lang['7'],$lang['8'],$lang['9'],$lang['10'],$lang['11'],$lang['12'],$lang['13']];
                                        $val = ["","1","2","3","4","5","6","7","8"];
                                        optionsList($val,$name,isset($_POST['fromu'])?$_POST['fromu']:'1');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="to" class="label">{{ $lang['15'] }}</label>
                            <div class="w-100 py-2 relative">
                                <select name="to" id="to" class="input">
                                    @php
                                        $name = [$lang['6'],$lang['7'],$lang['8'],$lang['9'],$lang['10'],$lang['11'],$lang['12'],$lang['13']];
                                        $val = ["","1","2","3","4","5","6","7","8"];
                                        optionsList($val,$name,isset($_POST['to'])?$_POST['to']:'2');
                                    @endphp
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 calculator4 hidden">
                    <div class="row grid grid-cols-12    gap-2 md:gap-4 lg:gap-4">

                        <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                            <label for="fdis" class="label">{{ $lang['17'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="fdis" id="fdis" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['fdis']) ? $_POST['fdis'] : '12' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="fdis_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('fdis_unit_dropdown')">{{ isset($_POST['fdis_unit'])?$_POST['fdis_unit']:'mi' }} ▾</label>
                                <input type="text" name="fdis_unit" value="{{ isset($_POST['fdis_unit'])?$_POST['fdis_unit']:'mi' }}" id="fdis_unit" class="hidden">
                                <div id="fdis_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="fdis_unit">
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fdis_unit', 'mi')">miles (mi)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fdis_unit', 'km')">kilometers (km)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fdis_unit', 'm')">meters (m)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('fdis_unit', 'yd')">yards (yd)</p>
                                </div>
                             </div>
                        </div>
                     
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                            <label for="ftime" class="label">{!! $lang['18'] !!} (hh:mm:ss):</label>
                            <div class="w-100 py-2 relative">
                                <input type="text" name="ftime" id="ftime" class="input" aria-label="input" placeholder="00" value="{{ isset($_POST['ftime'])?$_POST['ftime']:'00:05:13' }}" />
                            </div>
                        </div>

                        <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                            <label for="ffdis" class="label">{{ $lang['19'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" name="ffdis" id="ffdis" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['ffdis']) ? $_POST['ffdis'] : '5' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                                <label for="ffdis_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('ffdis_unit_dropdown')">{{ isset($_POST['ffdis_unit'])?$_POST['ffdis_unit']:'mi' }} ▾</label>
                                <input type="text" name="ffdis_unit" value="{{ isset($_POST['ffdis_unit'])?$_POST['ffdis_unit']:'mi' }}" id="ffdis_unit" class="hidden">
                                <div id="ffdis_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden" to="ffdis_unit">
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ffdis_unit', 'mi')">miles (mi)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ffdis_unit', 'km')">kilometers (km)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ffdis_unit', 'm')">meters (m)</p>
                                     <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('ffdis_unit', 'yd')">yards (yd)</p>
                                </div>
                             </div>
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
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 resblue
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        @php
                            $weight_unit = $detail['request']->weight_unit;
                        @endphp
                        <div class="w-full">
                            @if($detail['request']->calculator_name==='calculator3')
                                @php
                                    $name=array($lang['6'],$lang['7'],$lang['8'],$lang['9'],$lang['10'],$lang['11'],$lang['12'],$lang['13']);
                                    $i=$detail['request']->fromu-1;
                                    $j=$detail['request']->to-1;
                                @endphp
                                <div class="w-full">
                                    <div class="w-full py-2">
                                        <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                            <strong><span class="text-blue font-s-20">{{ $detail['request']->from }}</span> {{ $name[$i] }} = <span class="text-green font-s-20">{{ $detail['res'] }}</span> {{ $name[$j] }}</strong>
                                        </div>
                                    </div>
                                </div>
                            @elseif($detail['request']->calculator_name==='calculator4')
                                <div class="w-full">
                                    <div class="w-full py-2">
                                        <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                            {{ $lang['22'] }}
                                            <strong class="text-green font-s-20">{{ $detail['main'] }}</strong>
                                            {{ $lang['23'] }}
                                            {{ $detail['request']->ffdis.' '.$detail['request']->ffdis_unit }}.
                                        </div>
                                    </div>
                                </div>
                                <p><strong>{{ $lang['24'] }}:</strong></p>
                                
                                <div class="w-full overflow-auto">
                                    <table class="w-full col-lg-6" cellspacing="0">
                                        <tr>
                                            <td class="border-b py-2"><strong class="text-blue">{{ gethours($detail['pace']) }} Hours {{ getmins($detail['pace']) }} Min {{ getsecs($detail['pace']) }} Sec</strong> <span>{{ $lang['6'] }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong class="text-blue">{{ gethours($detail['pacekm']) }} Hours {{ getmins($detail['pacekm']) }} Min {{ getsecs($detail['pacekm']) }} Sec</strong> <span>{{ $lang['7'] }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong class="text-blue">{{ $detail['mi_h'] }}</strong> <span>{{ $lang['25'] }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong class="text-blue">{{ $detail['km_h'] }}</strong> <span>{{ $lang['26'] }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong class="text-blue">{{ $detail['m_m'] }}</strong> <span>{{ $lang['27'] }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong class="text-blue">{{ $detail['m_s'] }}</strong> <span>{{ $lang['28'] }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2"><strong class="text-blue">{{ $detail['yd_m'] }}</strong> <span>{{ $lang['29'] }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2"><strong class="text-blue">{{ $detail['yd_s'] }}</strong> <span>{{ $lang['30'] }}</span></td>
                                        </tr>
                                    </table>
                                </div>
                            @elseif($detail['request']->calculator_name==='calculator2')
                                <div class="w-full px-lg-3 overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <th class="text-blue border-b p-2" colspan="4">{{ $lang['31'] }}</th>
                                            <th class="text-start text-blue border-s border-b p-2" rowspan="2">{{ $lang['32'] }} <br> (hh:mm:ss {{ $lang['6'] }})</th>
                                        </tr>
                                        <tr>
                                            <th class="text-start text-blue border-b p-2">#</th>
                                            <th class="text-start text-blue border-b p-2">{{ $lang['3'] }} <br> ({{ $_POST['dis_unit1'] }})</th>
                                            <th class="text-start text-blue border-b p-2">{{ $lang['2'] }} <br> (hh:mm:ss)</th>
                                            <th class="text-start text-blue border-b p-2">{{ $lang['1'] }} <br> (hh:mm:ss {{ $lang['6'] }})</th>
                                        </tr>
                                        {!! $detail['table'] !!}
                                    </table>
                                    <p class="mt-3"><strong>{{ $lang['33'] }} (hh:mm:ss): <span class="text-green font-s-20">{{ gettime($detail['stime']) }} {{ $lang['6'] }}</span></strong></p>
                                    <div id="ourchart" class="w-full mt-3" style="height:250px"></div>
                                </div>
                            @elseif($detail['request']->calculator_name==='calculator1')
                                @if($detail['request']->type=='pace')
                                    <div class="w-full">
                                        <div class="w-full px-lg-3 py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ gethours($detail['pace']) }} Hours {{ getmins($detail['pace']) }} Min {{ getsecs($detail['pace']) }} Sec</strong>
                                                <strong>{{ $lang['6'] }}</strong>
                                            </div>
                                        </div>
                                        <div class="w-full px-lg-3 py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ gethours($detail['pacekm']) }} Hours {{ getmins($detail['pacekm']) }} Min {{ getsecs($detail['pacekm']) }} Sec</strong>
                                                <strong>{{ $lang['7'] }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 px-lg-3 py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ $detail['mi_h'] }}</strong>
                                                <strong>{{ $lang['8'] }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 px-lg-3 py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ $detail['km_h'] }}</strong>
                                                <strong>{{ $lang['26'] }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 px-lg-3 py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ $detail['m_m'] }}</strong>
                                                <strong>{{ $lang['27'] }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 px-lg-3 py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ $detail['m_s'] }}</strong>
                                                <strong>{{ $lang['28'] }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($detail['request']->type=='time')
                                    <div class="w-full">
                                        <div class="w-full px-lg-3 py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                                <strong>{{ $lang['34'] }} =</strong>
                                                <strong class="text-green font-s-25">{{ gethours($detail['timeres']) }} Hours {{ getmins($detail['timeres']) }} Min {{ getsecs($detail['timeres']) }} Sec</strong>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($detail['request']->type=='distance')
                                    <div class="w-full">
                                        <p class="px-lg-3"><strong>{{ $lang['3'] }}:</strong></p>
                                        <div class="col-lg-6 px-lg-3 py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ number_format($detail['dis_mi'],3) }}</strong>
                                                <span>{{ $lang['35'] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 px-lg-3 py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ number_format($detail['dis_km'],3) }}</strong>
                                                <span>{{ $lang['36'] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 px-lg-3 py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ number_format($detail['dis_m'],3) }}</strong>
                                                <span>{{ $lang['37'] }}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 px-lg-3 py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ number_format($detail['dis_yd'],3) }}</strong>
                                                <span>{{ $lang['38'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif
                            @if($detail['request']->calculator_name!='calculator2' && $detail['request']->calculator_name!='calculator4' && $detail['request']->calculator_name!='calculator3')
                                <p class="px-lg-3 mt-3"><strong>{{ $lang['39'] }}:</strong></p>
                                <div class="w-full px-lg-3 overflow-auto">
                                    <table class="w-full col-lg-11" cellspacing="0">
                                        <tr>
                                            <th class="text-start text-blue border-b py-2">{{ $lang['3'] }}</th>
                                            <th class="text-start text-blue border-b py-2">{{ $lang['2'] }} (hh:mm:ss)</th>
                                            <th class="text-start text-blue border-b py-2">{{ $lang['3'] }}</th>
                                            <th class="text-start text-blue border-b py-2">{{ $lang['2'] }} (hh:mm:ss)</th>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">1 km</td>
                                            <td class="border-b py-2">{{ gettime($detail['pacekm']*1) }}</td>
                                            <td class="border-b py-2">1 mi</td>
                                            <td class="border-b py-2">{{ gettime($detail['pace']*1) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">3 km</td>
                                            <td class="border-b py-2">{{ gettime(($detail['pacekm']*3)) }}</td>
                                            <td class="border-b py-2">3 mi</td>
                                            <td class="border-b py-2">{{ gettime($detail['pace']*3) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">5 km</td>
                                            <td class="border-b py-2">{{ gettime($detail['pacekm']*5) }}</td>
                                            <td class="border-b py-2">5 mi</td>
                                            <td class="border-b py-2">{{ gettime($detail['pace']*5) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">10 km</td>
                                            <td class="border-b py-2">{{ gettime($detail['pacekm']*10) }}</td>
                                            <td class="border-b py-2">10 mi</td>
                                            <td class="border-b py-2">{{ gettime($detail['pace']*10) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">15 km</td>
                                            <td class="border-b py-2">{{ gettime($detail['pacekm']*15) }}</td>
                                            <td class="border-b py-2">15 mi</td>
                                            <td class="border-b py-2">{{ gettime($detail['pace']*15) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="border-b py-2">Marathon</td>
                                            <td class="border-b py-2">{{ gettime($detail['pacekm']*42.195) }}</td>
                                            <td class="border-b py-2">Half-Marathon</td>
                                            <td class="border-b py-2">{{ gettime($detail['pacekm']*21.0975) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">400 m</td>
                                            <td class="py-2">{{ gettime($detail['pacekm']*(400/1000)) }}</td>
                                            <td class="py-2">800 m</td>
                                            <td class="py-2">{{ gettime($detail['pacekm']*(800/1000)) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            @if($detail['dis_km']>=3 && $detail['request']->calculator_name!='calculator2')
                                <p class="px-lg-3 mt-3"><strong>{{ $lang['40'] }}:</strong></p>
                                <div class="w-full">
                                    <div class="w-full md:w-[60%] lg:w-[60%] px-lg-3 pe-md-3 overflow-auto">
                                        <table class="w-full" cellspacing="0">
                                            <tr>
                                                <th class="text-start text-blue border-b py-2">{{ $lang['3'] }}</th>
                                                <th class="text-start text-blue border-b py-2">{{ $lang['2'] }} (hh:mm:ss)</th>
                                            </tr>
                                            @for ($i=1; $i <= $detail['dis_km']; $i++)
                                                <tr>
                                                    <td class="{{ ($i != round($detail['dis_km'])) ? 'border-b' : '' }} py-2">{{ $i }} km</td>
                                                    <td class="{{ ($i != round($detail['dis_km'])) ? 'border-b' : '' }} py-2">{{ gettime($detail['pacekm']*$i) }}</td>
                                                </tr>
                                            @endfor
                                        </table>
                                    </div>
                                    <div class="w-full md:w-[60%] lg:w-[60%] px-lg-3 ps-md-3 mt-3 mt-md-0 overflow-auto">
                                        <table class="w-full" cellspacing="0">
                                            <tr>
                                                <th class="text-start text-blue border-b py-2">{{ $lang['3'] }}</td>
                                                <th class="text-start text-blue border-b py-2">{{ $lang['2'] }} (hh:mm:ss)</td>
                                            </tr>
                                            @for ($i=1; $i <= $detail['dis_mi']; $i++)
                                                <tr>
                                                    <td class="{{ ($i != round($detail['dis_mi'])) ? 'border-b' : '' }} py-2">{{ $i }} mi</td>
                                                    <td class="{{ ($i != round($detail['dis_mi'])) ? 'border-b' : '' }} py-2">{{ gettime($detail['pace']*$i) }}</td>
                                                </tr>
                                            @endfor
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        @if($detail['request']->calculator_name == 'calculator2')
            <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script src="//d26tpo4cm8sb6k.cloudfront.net/highchart/highcharts.js"></script>
            <script>
                $('#ourchart').highcharts({
                    chart: {
                        type: 'column',
                        backgroundColor: 'transparent'
                    },
                    title: {
                        text: ''
                    },
                    xAxis: {
                        categories: [
                            @foreach($detail['mile_secs'] as $key => $value)
                                {{ ($key+1)."," }}
                            @endforeach
                        ],
                        title: {
                            text: '{{ $lang["41"] }}'
                        }
                    },
                    yAxis: {
                        title: {text: '{{ $lang["42"] }}'}
                    },
                    legend: {
                        enabled: false
                    },
                    tooltip: {
                    headerFormat: '<table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y}</b></td></tr>',
                    footerFormat: '</table>',
                    },
                    series: [{
                        name: '{{ $lang["43"] }}',
                        data: [
                        @foreach($detail['mile_secs'] as $key => $value)
                            {{ $value."," }}
                        @endforeach
                    ]
                    }]
                });
            </script>
		@endif
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let val = "{{ isset($detail['request']->calculator_name) ? $detail['request']->calculator_name : 'calculator1' }}";

                if(val == 'calculator1'){
                    document.querySelector('.calculator1').classList.remove('hidden');
                    document.querySelector('.calculator2').classList.add('hidden');
                    document.querySelector('.calculator3').classList.add('hidden');
                    document.querySelector('.calculator4').classList.add('hidden');

                }else if(val == 'calculator2'){
                    document.querySelector('.calculator1').classList.add('hidden');
                    document.querySelector('.calculator2').classList.remove('hidden');
                    document.querySelector('.calculator3').classList.add('hidden');
                    document.querySelector('.calculator4').classList.add('hidden');

                }else if(val == 'calculator3'){
                    document.querySelector('.calculator1').classList.add('hidden');
                    document.querySelector('.calculator2').classList.add('hidden');
                    document.querySelector('.calculator3').classList.remove('hidden');
                    document.querySelector('.calculator4').classList.add('hidden');

                }else if(val == 'calculator4'){
                    document.querySelector('.calculator1').classList.add('hidden');
                    document.querySelector('.calculator2').classList.add('hidden');
                    document.querySelector('.calculator3').classList.add('hidden');
                    document.querySelector('.calculator4').classList.remove('hidden');
                }

                document.querySelectorAll('.pacetab').forEach(function(tab) {
                    tab.classList.remove('tagsUnit');
                });

                document.getElementById(val).classList.add('tagsUnit');
                document.getElementById("calculator_name").value = val;
             
        
                @if(isset($detail['request']->per))
                    document.getElementById('per').value = "{{ $detail['request']->per }}";
                    let per = "{{ $detail['request']->per }}";
                    if (per === '1' || per === '2') {
                        document.querySelectorAll('.hh').forEach(function(element) {
                            element.style.display = 'block';
                        });
                    } else {
                        document.querySelectorAll('.hh').forEach(function(element) {
                            element.style.display = 'none';
                        });
                    }
                @endif
        
                @if(isset($detail['request']->submit))
                    var sub = "{{ $detail['request']->type }}";
                    if (sub === 'time') {
                        document.querySelectorAll('.dis, .event, .pace').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        document.querySelectorAll('.time').forEach(function(element) {
                            element.style.display = 'none';
                        });
                        document.getElementById('type').value = 'time';
                        document.querySelectorAll('.unit_menu li').forEach(function(li) {
                            li.classList.remove('active');
                        });
                        document.getElementById('time_tab').classList.add('active');
                        document.querySelectorAll('.pace_tab').forEach(function(tab) {
                            tab.classList.remove('active');
                        });
                        document.getElementById(sub+'_tab').classList.add('active');
                    } else if (sub === 'pace') {
                        document.querySelectorAll('.event, .time, .dis').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        document.querySelectorAll('.pace').forEach(function(element) {
                            element.style.display = 'none';
                        });
                        document.getElementById('type').value = 'pace';
                        document.querySelectorAll('.unit_menu li').forEach(function(li) {
                            li.classList.remove('active');
                        });
                        document.getElementById('pace_tab').classList.add('active');
                        document.querySelectorAll('.pace_tab').forEach(function(tab) {
                            tab.classList.remove('active');
                        });
                        document.getElementById(sub+'_tab').classList.add('active');
                    } else {
                        document.querySelectorAll('.dis, .event').forEach(function(element) {
                            element.style.display = 'none';
                        });
                        document.querySelectorAll('.time, .pace').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        document.getElementById('type').value = 'distance';
                        document.querySelectorAll('.unit_menu li').forEach(function(li) {
                            li.classList.remove('active');
                        });
                        document.getElementById('distance_tab').classList.add('active');
                        document.querySelectorAll('.pace_tab').forEach(function(tab) {
                            tab.classList.remove('active');
                        });
                        document.getElementById(sub+'_tab').classList.add('active');
                    }
                @endif
        
                @if(isset($detail['request']->dis_unit))
                    document.getElementById('dis_unit').value = "{{ $detail['request']->dis_unit }}";
                @endif
        
                @if(isset($detail['request']->fromu))
                    document.getElementById('fromu').value = "{{ $detail['request']->fromu }}";
                    let fromu = document.getElementById('fromu').value;
                    if (fromu === '1' || fromu === '2') {
                        document.querySelectorAll('.hhm').forEach(function(element) {
                            element.style.display = 'block';
                        });
                    } else {
                        document.querySelectorAll('.hhm').forEach(function(element) {
                            element.style.display = 'none';
                        });
                    }
                @endif
        
                document.querySelectorAll('.unit_menu li').forEach(function(li) {
                    li.addEventListener('click', function() {
                        document.querySelectorAll('.unit_menu li').forEach(function(li) {
                            li.classList.remove('active');
                        });
                        this.classList.add('active');
                    });
                });
        
                document.getElementById('fromu').addEventListener('change', function() {
                    let per = this.value;
                    if (per === '1' || per === '2') {
                        document.querySelectorAll('.hhm').forEach(function(element) {
                            element.style.display = 'block';
                        });
                    } else {
                        document.querySelectorAll('.hhm').forEach(function(element) {
                            element.style.display = 'none';
                        });
                    }
                });
        
                document.getElementById('per').addEventListener('change', function() {
                    let per = this.value;
                    if (per === '1' || per === '2') {
                        document.querySelectorAll('.hh').forEach(function(element) {
                            element.style.display = 'block';
                        });
                    } else {
                        document.querySelectorAll('.hh').forEach(function(element) {
                            element.style.display = 'none';
                        });
                    }
                });
        
                document.getElementById('time_tab').addEventListener('click', function() {
                    document.querySelectorAll('.dis, .event, .pace').forEach(function(element) {
                        element.style.display = 'block';
                    });
                    document.querySelectorAll('.time').forEach(function(element) {
                        element.style.display = 'none';
                    });
                    document.getElementById('type').value = 'time';
                    document.querySelectorAll('.pace_tab').forEach(function(tab) {
                        tab.classList.remove('active');
                    });
                    this.classList.add('active');
                });
        
                document.getElementById('distance_tab').addEventListener('click', function() {
                    document.querySelectorAll('.dis, .event').forEach(function(element) {
                        element.style.display = 'none';
                    });
                    document.querySelectorAll('.time, .pace').forEach(function(element) {
                        element.style.display = 'block';
                    });
                    document.getElementById('type').value = 'distance';
                    document.querySelectorAll('.pace_tab').forEach(function(tab) {
                        tab.classList.remove('active');
                    });
                    this.classList.add('active');
                });
        
                document.getElementById('pace_tab').addEventListener('click', function() {
                    document.querySelectorAll('.event, .time, .dis').forEach(function(element) {
                        element.style.display = 'block';
                    });
                    document.querySelectorAll('.pace').forEach(function(element) {
                        element.style.display = 'none';
                    });
                    document.getElementById('type').value = 'pace';
                    document.querySelectorAll('.pace_tab').forEach(function(tab) {
                        tab.classList.remove('active');
                    });
                    this.classList.add('active');
                });
        
                document.getElementById('event').addEventListener('change', function() {
                    let event = this.value;
                    if (event === '1') {
                        document.getElementById('dis').value = '42.195';
                        document.getElementById('dis_unit').value = 'km';
                    } else if (event === '2') {
                        document.getElementById('dis').value = '21.0975';
                        document.getElementById('dis_unit').value = 'km';
                    } else if (event === '3') {
                        document.getElementById('dis').value = '1';
                        document.getElementById('dis_unit').value = 'km';
                    } else if (event === '4') {
                        document.getElementById('dis').value = '5';
                        document.getElementById('dis_unit').value = 'km';
                    } else if (event === '5') {
                        document.getElementById('dis').value = '10';
                        document.getElementById('dis_unit').value = 'km';
                    } else if (event === '6') {
                        document.getElementById('dis').value = '1';
                        document.getElementById('dis_unit').value = 'mi';
                    } else if (event === '7') {
                        document.getElementById('dis').value = '5';
                        document.getElementById('dis_unit').value = 'mi';
                    } else if (event === '8') {
                        document.getElementById('dis').value = '10';
                        document.getElementById('dis_unit').value = 'mi';
                    } else if (event === '9') {
                        document.getElementById('dis').value = '800';
                        document.getElementById('dis_unit').value = 'm';
                    } else if (event === '10') {
                        document.getElementById('dis').value = '1500';
                        document.getElementById('dis_unit').value = 'm';
                    }
                });
        
                document.querySelectorAll('.pacetab').forEach(function(tab) {
                    tab.addEventListener('click', function() {
                        let val = this.getAttribute('data-value');

                        if(val == 'calculator1'){
                          document.querySelector('.calculator1').classList.remove('hidden');
                          document.querySelector('.calculator2').classList.add('hidden');
                          document.querySelector('.calculator3').classList.add('hidden');
                          document.querySelector('.calculator4').classList.add('hidden');

                        }else if(val == 'calculator2'){
                            document.querySelector('.calculator1').classList.add('hidden');
                            document.querySelector('.calculator2').classList.remove('hidden');
                            document.querySelector('.calculator3').classList.add('hidden');
                            document.querySelector('.calculator4').classList.add('hidden');

                        }else if(val == 'calculator3'){
                            document.querySelector('.calculator1').classList.add('hidden');
                            document.querySelector('.calculator2').classList.add('hidden');
                            document.querySelector('.calculator3').classList.remove('hidden');
                            document.querySelector('.calculator4').classList.add('hidden');

                        }else if(val == 'calculator4'){
                            document.querySelector('.calculator1').classList.add('hidden');
                            document.querySelector('.calculator2').classList.add('hidden');
                            document.querySelector('.calculator3').classList.add('hidden');
                            document.querySelector('.calculator4').classList.remove('hidden');
                        }

                        document.querySelectorAll('.pacetab').forEach(function(tab) {
                            tab.classList.remove('tagsUnit');
                        });
                        this.classList.add('tagsUnit');
                        document.getElementById("calculator_name").value = val;
                    });
                });


            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>