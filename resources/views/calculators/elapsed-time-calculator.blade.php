<form class="row" action="{{ url()->current() }}/" method="POST" id="clockForm">
    @csrf
    @if(!isset($detail))
       
    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
                <input type="hidden" name="main_units" id="main_units" value="{{ isset(request()->main_units) ? request()->main_units : 'elapsed' }}">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  wed {{ isset($_POST['main_units']) && $_POST['main_units'] !== 'elapsed'  ? '' :'tagsUnit' }}" id="wed">
                                {{ $lang['1'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/2 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white rel {{ isset($_POST['main_units']) && $_POST['main_units'] == 'clock' ? 'tagsUnit' :'' }}" id="rel">
                                {{ $lang['2'] }}
                        </div>
                    </div>
                </div>
            </div>

           <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">

               <div class="grid grid-cols-1  gap-4">
                   <div class="d-flex align-items-center px-2 mt-3 clock-time {{ isset(request()->main_units) && request()->main_units != 'elapsed' ? '' : 'hidden' }}">
                       <p class="text-blue font-s-14 pe-2">{{ $lang['5'] }}:</p>
                       <input type="radio" name="clock_format" id="first" value="12" onchange="updateDisplay()" checked {{ isset(request()->clock_format) && request()->clock_format === '12' ? 'checked' : '' }}>
                       <label for="first" class="font-s-14 text-blue ps-lg-1 pe-2">12 Hours</label>
                       <input type="radio" name="clock_format" id="second" value="24" onchange="updateDisplay()" {{ isset(request()->clock_format) && request()->clock_format === '24' ? 'checked' : '' }}>
                       <label for="second" class="font-s-14 ps-lg-1 text-blue">24 Hours</label>
                   </div>
               </div>
               <div class="grid grid-cols-1  gap-4 elapsed {{ isset(request()->main_units) && request()->main_units != 'elapsed' ? 'hidden' : '' }}">
                   <p class="mt-2 px-1 font-s-14">{{$lang['3']}}</p>
               </div>
                <div class="grid grid-cols-4 gap-4 elapsed {{ isset(request()->main_units) && request()->main_units != 'elapsed' ? 'hidden' : '' }}">
                    <div class="space-y-2 hidden elapsed_start">
                        <label for="elapsed_start" class="font-s-14 text-blue elapsed_start_t">hrs:</label>
                        <div class="w-100 py-2">                                  
                            <input type="number" step="any" name="elapsed_start" id="elapsed_start" class="input" aria-label="input"
                            value="{{ isset(request()->elapsed_start) ? request()->elapsed_start : '5' }}" />
                        </div>
                    </div>
                    <div class="space-y-2 elapsed_start_one">
                        <label for="elapsed_start_one" class="font-s-14 text-blue">hrs:</label>
                        <div class="w-100 py-2">                                  
                            <input type="number" step="any" name="elapsed_start_one" id="elapsed_start_one" class="input" aria-label="input"
                            value="{{ isset(request()->elapsed_start_one) ? request()->elapsed_start_one : '9' }}" />
                        </div>
                    </div>
                    <div class="space-y-2 elapsed_start_sec">
                        <label for="elapsed_start_sec" class="font-s-14 text-blue">mins:</label>
                        <div class="w-100 py-2">                                  
                            <input type="number" step="any" name="elapsed_start_sec" id="elapsed_start_sec" class="input" aria-label="input"
                            value="{{ isset(request()->elapsed_start_sec) ? request()->elapsed_start_sec : '5' }}" />
                        </div>
                    </div>
                    <div class="space-y-2 elapsed_start_three">
                        <label for="elapsed_start_three" class="font-s-14 text-blue">sec:</label>
                        <div class="w-100 py-2">                                  
                            <input type="number" step="any" name="elapsed_start_three" id="elapsed_start_three" class="input" aria-label="input"
                            value="{{ isset(request()->elapsed_start_three) ? request()->elapsed_start_three : '9' }}" />
                        </div>
                    </div>
                    <div class="space-y-2 elapsed_start_unit">
                        <label for="elapsed_start_unit" class="font-s-14 text-blue">&nbsp;</label>
                        <div class="w-100 py-2">                                  
                            <select name="elapsed_start_unit" id="elapsed_start_unit" class="input">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                        {{ $arr2[$index] }}
                                    </option>
                                @php
                                    }}
                                    $name = ["sec", "mins", "hrs", "mins/sec", "hrs/mins", "hrs/mins/sec"];
                                    $val = ["sec", "mins", "hrs", "mins/sec", "hrs/mins", "hrs/mins/sec"];
                                    optionsList($val,$name,isset($_POST['elapsed_start_unit'])?$_POST['elapsed_start_unit']:'hrs/mins/sec');
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>
               <div class="grid grid-cols-1  gap-4 elapsed {{ isset(request()->main_units) && request()->main_units != 'elapsed' ? 'hidden' : '' }}">
                   <p class="mt-2 px-1 font-s-14">{{$lang['4']}}</p>
               </div>
               <div class="grid grid-cols-4  gap-4 elapsed {{ isset(request()->main_units) && request()->main_units != 'elapsed' ? 'hidden' : '' }}">
                    <div class="space-y-2 hidden elapsed_end">
                        <label for="elapsed_end" class="font-s-14 text-blue elapsed_end_t">hrs:</label>
                        <div class="w-100 py-2">                                  
                            <input type="number" step="any" name="elapsed_end" id="elapsed_end" class="input" aria-label="input"
                            value="{{ isset(request()->elapsed_end) ? request()->elapsed_end : '7' }}" />
                        </div>
                    </div>
                    <div class="space-y-2 elapsed_end_one">
                        <label for="elapsed_end_one" class="font-s-14 text-blue">hrs:</label>
                        <div class="w-100 py-2">                                  
                            <input type="number" step="any" name="elapsed_end_one" id="elapsed_end_one" class="input" aria-label="input"
                            value="{{ isset(request()->elapsed_end_one) ? request()->elapsed_end_one : '9' }}" />
                        </div>
                    </div>
                    <div class="space-y-2 elapsed_end_sec">
                        <label for="elapsed_end_sec" class="font-s-14 text-blue">mins:</label>
                        <div class="w-100 py-2">                                  
                            <input type="number" step="any" name="elapsed_end_sec" id="elapsed_end_sec" class="input" aria-label="input"
                            value="{{ isset(request()->elapsed_end_sec) ? request()->elapsed_end_sec : '30' }}" />
                        </div>
                    </div>
                    <div class="space-y-2 elapsed_end_three">
                        <label for="elapsed_end_three" class="font-s-14 text-blue">sec:</label>
                        <div class="w-100 py-2">                                  
                            <input type="number" step="any" name="elapsed_end_three" id="elapsed_end_three" class="input" aria-label="input"
                            value="{{ isset(request()->elapsed_end_three) ? request()->elapsed_end_three : '50' }}" />
                        </div>
                    </div>
                    <div class="space-y-2 elapsed_end_unit">
                        <label for="elapsed_end_unit" class="font-s-14 text-blue">&nbsp;</label>
                        <div class="w-100 py-2">                                  
                            <select name="elapsed_end_unit" id="elapsed_end_unit" class="input">
                                @php
                                    $name = ["sec", "mins", "hrs", "mins/sec", "hrs/mins", "hrs/mins/sec"];
                                    $val = ["sec", "mins", "hrs", "mins/sec", "hrs/mins", "hrs/mins/sec"];
                                    optionsList($val,$name,isset($_POST['elapsed_end_unit'])?$_POST['elapsed_end_unit']:'hrs/mins/sec');
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>

               <div class="grid grid-cols-1  gap-4 clock {{ isset(request()->main_units) && request()->main_units != 'elapsed' ? '' : 'hidden' }}">
                 <p class="mt-2 px-1 font-s-14">{{$lang['6']}}</p>
               </div>
                <div class="grid grid-cols-4  gap-4  clock {{ isset(request()->main_units) && request()->main_units != 'elapsed' ? '' : 'hidden' }}">
                    <div class="space-y-2 clock_hour">
                        <div class="w-100 py-2 relative">                                  
                            <input type="number" step="any" name="clock_hour" id="clock_hour" class="input" aria-label="input"
                            value="{{ isset(request()->clock_hour) ? request()->clock_hour : '9' }}" />
                            <span class="input_unit text-blue">hrs</span>
                        </div>
                    </div>
                    <div class="space-y-2 clock_minute">
                        <div class="w-100 py-2 relative">                                  
                            <input type="number" step="any" name="clock_minute" id="clock_minute" class="input" aria-label="input"
                            value="{{ isset(request()->clock_minute) ? request()->clock_minute : '5' }}" />
                            <span class="input_unit text-blue">min</span>
                        </div>
                    </div>
                    <div class="space-y-2 clock_second">
                        <div class="w-100 py-2 relative">                                  
                            <input type="number" step="any" name="clock_second" id="clock_second" class="input" aria-label="input"
                            value="{{ isset(request()->clock_second) ? request()->clock_second : '7' }}" />
                            <span class="input_unit text-blue">sec</span>
                        </div>
                    </div>
                    <div class="space-y-2 clock_start_unit {{ isset(request()->clock_format) && request()->clock_format != '12' ? 'hidden' : '' }}">
                        <div class="w-100 py-2">                                  
                            <select name="clock_start_unit" id="clock_start_unit" class="input">
                                @php
                                    $name = ["AM", "PM"];
                                    $val = ["AM", "PM"];
                                    optionsList($val,$name,isset($_POST['clock_start_unit'])?$_POST['clock_start_unit']:'AM');
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1  gap-4 clock {{ isset(request()->main_units) && request()->main_units != 'elapsed' ? '' : 'hidden' }}">
                    <p class="mt-2 px-1 font-s-14">{{$lang['7']}}</p>
                </div>
                <div class="grid grid-cols-4  gap-4 clock {{ isset(request()->main_units) && request()->main_units != 'elapsed' ? '' : 'hidden' }}">
                    <div class="space-y-2 clock_hur">
                        <div class="w-100 py-2 relative">                                  
                            <input type="number" step="any" name="clock_hur" id="clock_hur" class="input" aria-label="input"
                            value="{{ isset(request()->clock_hur) ? request()->clock_hur : '7' }}" />
                            <span class="input_unit text-blue">hrs</span>
                        </div>
                    </div>
                    <div class="space-y-2 clock_mints">
                        <div class="w-100 py-2 relative">                                  
                            <input type="number" step="any" name="clock_mints" id="clock_mints" class="input" aria-label="input"
                            value="{{ isset(request()->clock_mints) ? request()->clock_mints : '12' }}" />
                            <span class="input_unit text-blue">min</span>
                        </div>
                    </div>
                    <div class="space-y-2 clock_secs">
                        <div class="w-100 py-2 relative">                                  
                            <input type="number" step="any" name="clock_secs" id="clock_secs" class="input" aria-label="input"
                            value="{{ isset(request()->clock_secs) ? request()->clock_secs : '9' }}" />
                            <span class="input_unit text-blue">sec</span>
                        </div>
                    </div>
                    <div class="space-y-2 clock_end_unit {{ isset(request()->clock_format) && request()->clock_format != '12' ? 'hidden' : '' }}">
                        <div class="w-100 py-2">                                  
                            <select name="clock_end_unit" id="clock_end_unit" class="input">
                                @php
                                    $name = ["AM", "PM"];
                                    $val = ["AM", "PM"];
                                    optionsList($val,$name,isset($_POST['clock_end_unit'])?$_POST['clock_end_unit']:'AM');
                                @endphp
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

    @else
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full p-6 rounded-lg mt-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div class="text-lg lg:text-xl">
                                <p class="mb-4 font-bold">
                                    {{ $detail['hours'] . " Hours " . $detail['minutes'] . " Minutes " . $detail['seconds'] . " Seconds" }}
                                </p>
                                <table class="w-full">
                                    <tr>
                                        <td class="w-3/5 border-b py-2 font-bold">{{ $lang[9] }} :</td>
                                        <td class="border-b py-2">{{ $detail['answer'] }} {{ $lang[11] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3" colspan="2">{{ $lang[1] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">MM:SS</td>
                                        <td class="border-b py-2">
                                            @php
                                                $seconds = $detail['answer'];
                                                $minutes = floor($seconds / 60);
                                                $seconds = $seconds % 60;
                                                $time_format = sprintf("%02d:%02d", $minutes, $seconds);
                                            @endphp
                                            {{ $time_format }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">HH:MM</td>
                                        <td class="border-b py-2">
                                            @php
                                                $seconds = $detail['answer'];
                                                $hours = floor($seconds / 3600);
                                                $seconds = $seconds % 3600;
                                                $minutes = floor($seconds / 60);
                                                $seconds = $seconds % 60;
                                                $time_format = sprintf("%02d:%02d", $hours, $minutes);
                                            @endphp
                                            {{ $time_format }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">HH:MM:SS</td>
                                        <td class="border-b py-2">
                                            @php
                                                $seconds = $detail['answer'];
                                                $hours = floor($seconds / 3600);
                                                $seconds = $seconds % 3600;
                                                $minutes = floor($seconds / 60);
                                                $seconds = $seconds % 60;
                                                $time_format = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
                                            @endphp
                                            {{ $time_format }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3" colspan="2">{{ $lang[10] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang[12] }} :</td>
                                        <td class="border-b py-2">{{ round($detail['answer'] / 60, 4) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang[8] }} :</td>
                                        <td class="border-b py-2">{{ round($detail['answer'] / 3600, 4) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2">{{ $lang[13] }} :</td>
                                        <td class="border-b py-2">{{ round($detail['answer'] / 86400, 4) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="w-full text-center mt-16">
                            <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3">
                                @if (app()->getLocale() == 'en')
                                    RESET
                                @else
                                    {{ $lang['reset'] ?? 'RESET' }}
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</form>
@push('calculatorJS')
    <script>
        var elapsed_start = document.querySelector('.elapsed_start');
        var elapsed_start_t = document.querySelector('.elapsed_start_t');
        var elapsed_start_one = document.querySelector('.elapsed_start_one');
        var elapsed_start_sec = document.querySelector('.elapsed_start_sec');
        var elapsed_start_three = document.querySelector('.elapsed_start_three');
        var elapsed_start_unit = document.querySelector('.elapsed_start_unit');
        var elapsed_end = document.querySelector('.elapsed_end');
        var elapsed_end_t = document.querySelector('.elapsed_end_t');
        var elapsed_end_one = document.querySelector('.elapsed_end_one');
        var elapsed_end_sec = document.querySelector('.elapsed_end_sec');
        var elapsed_end_three = document.querySelector('.elapsed_end_three');;
        var elapsed_end_unit = document.querySelector('.elapsed_end_unit');;
        document.querySelectorAll('.wed').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('main_units').value = 'elapsed'
                this.classList.add('tagsUnit')
                document.querySelectorAll('.rel').forEach(function(hours) {
                    hours.classList.remove('tagsUnit')
                });
                document.querySelectorAll('.clock').forEach(function(clock) {
                    clock.classList.add('hidden');
                    clock.classList.remove('row');
                });
                document.querySelectorAll('.elapsed').forEach(function(elapsed) {
                    elapsed.classList.add('row');
                    elapsed.classList.remove('hidden');
                });
                document.querySelector('.clock-time').style.display= "none";
            })
        });
        document.querySelectorAll('.rel').forEach(function(element) {
            element.addEventListener('click', function() {
                document.getElementById('main_units').value = 'clock'
                this.classList.add('tagsUnit')
                document.querySelectorAll('.wed').forEach(function(hours) {
                    hours.classList.remove('tagsUnit')
                });
                document.querySelectorAll('.clock').forEach(function(clock) {
                    clock.classList.add('row');
                    clock.classList.remove('hidden');
                });
                document.querySelectorAll('.elapsed').forEach(function(elapsed) {
                    elapsed.classList.add('hidden');
                    elapsed.classList.remove('row');
                });
                document.querySelector('.clock-time').style.display= "flex";
            })
        });
        function updateDisplay() {
            var format = document.querySelector('input[name="clock_format"]:checked').value;
            var hdOne = document.querySelector('.clock_start_unit');
            var hdTwo = document.querySelector('.clock_end_unit');
            var clock_hour = document.getElementById('clock_hour').value;
            var clock_hur = document.getElementById('clock_hur').value;
            if (format === '12') {
                hdOne.style.display = 'block';
                hdTwo.style.display = 'block';
            } else {
                hdOne.style.display = 'none';
                hdTwo.style.display = 'none';
            }
        }
        document.getElementById('elapsed_end_unit').addEventListener('change',function(){
            var type2 = this.value;
            if(type2 == 'hrs/mins/sec'){
                elapsed_end.style.display= "none";
                elapsed_end_one.style.display= "block";
                elapsed_end_one.classList.add("col-lg-3");
                elapsed_end_one.classList.remove("col-lg-4");
                elapsed_end_sec.classList.add("col-lg-3");
                elapsed_end_sec.classList.remove("col-lg-4");
                elapsed_end_unit.classList.add("col-lg-3");
                elapsed_end_unit.classList.remove("col-lg-4");
                elapsed_end_three.classList.add("col-lg-3");
                elapsed_end_three.classList.remove("col-lg-4");

                elapsed_end_sec.style.display= "block";
                elapsed_end_three.style.display= "block";
            }else if(type2 == 'hrs/mins'){
                elapsed_end_one.classList.add("col-lg-4");
                elapsed_end_one.classList.remove("col-lg-3");
                elapsed_end_sec.classList.add("col-lg-4");
                elapsed_end_sec.classList.remove("col-lg-3");
                elapsed_end_unit.classList.remove("col-lg-3");
                elapsed_end_unit.classList.add("col-lg-4");

                elapsed_end.style.display= "none";
                elapsed_end_one.style.display= "block";
                elapsed_end_sec.style.display= "block";
                elapsed_end_three.style.display= "none";
            }else if(type2 == 'mins/sec'){
                elapsed_end_three.classList.add("col-lg-4");
                elapsed_end_three.classList.remove("col-lg-3");
                elapsed_end_sec.classList.add("col-lg-4");
                elapsed_end_sec.classList.remove("col-lg-3");
                elapsed_end_unit.classList.remove("col-lg-3");
                elapsed_end_unit.classList.add("col-lg-4");

                elapsed_end.style.display= "none";
                elapsed_end_one.style.display= "none";
                elapsed_end_sec.style.display= "block";
                elapsed_end_three.style.display= "block";
            }else if(type2 == 'hrs'){
                elapsed_end_unit.classList.remove("col-lg-4");
                elapsed_end_unit.classList.add("col-lg-3");

                elapsed_end_t.innerHTML= "hrs";
                elapsed_end.style.display= "block";
                elapsed_end_one.style.display= "none";
                elapsed_end_sec.style.display= "none";
                elapsed_end_three.style.display= "none";
            }else if(type2 == 'mins'){
                elapsed_end_unit.classList.remove("col-lg-4");
                elapsed_end_unit.classList.add("col-lg-3");
                elapsed_end_t.innerHTML= "mins";
                elapsed_end.style.display= "block";
                elapsed_end_one.style.display= "none";
                elapsed_end_sec.style.display= "none";
                elapsed_end_three.style.display= "none";
            }else{
                elapsed_end_unit.classList.remove("col-lg-4");
                elapsed_end_unit.classList.add("col-lg-3");
                elapsed_end_t.innerHTML= "sec";
                elapsed_end.style.display= "block";
                elapsed_end_one.style.display= "none";
                elapsed_end_sec.style.display= "none";
                elapsed_end_three.style.display= "none";
            }
        });
        document.getElementById('elapsed_start_unit').addEventListener('change',function(){
            var type2 = this.value;
            if(type2 == 'hrs/mins/sec'){
                elapsed_start.style.display= "none";
                elapsed_start_one.style.display= "block";
                elapsed_start_one.classList.add("col-lg-3");
                elapsed_start_one.classList.remove("col-lg-4");
                elapsed_start_sec.classList.add("col-lg-3");
                elapsed_start_sec.classList.remove("col-lg-4");
                elapsed_start_unit.classList.add("col-lg-3");
                elapsed_start_unit.classList.remove("col-lg-4");
                elapsed_start_three.classList.add("col-lg-3");
                elapsed_start_three.classList.remove("col-lg-4");

                elapsed_start_sec.style.display= "block";
                elapsed_start_three.style.display= "block";
            }else if(type2 == 'hrs/mins'){
                elapsed_start_one.classList.add("col-lg-4");
                elapsed_start_one.classList.remove("col-lg-3");
                elapsed_start_sec.classList.add("col-lg-4");
                elapsed_start_sec.classList.remove("col-lg-3");
                elapsed_start_unit.classList.remove("col-lg-3");
                elapsed_start_unit.classList.add("col-lg-4");

                elapsed_start.style.display= "none";
                elapsed_start_one.style.display= "block";
                elapsed_start_sec.style.display= "block";
                elapsed_start_three.style.display= "none";
            }else if(type2 == 'mins/sec'){
                elapsed_start_three.classList.add("col-lg-4");
                elapsed_start_three.classList.remove("col-lg-3");
                elapsed_start_sec.classList.add("col-lg-4");
                elapsed_start_sec.classList.remove("col-lg-3");
                elapsed_start_unit.classList.remove("col-lg-3");
                elapsed_start_unit.classList.add("col-lg-4");

                elapsed_start.style.display= "none";
                elapsed_start_one.style.display= "none";
                elapsed_start_sec.style.display= "block";
                elapsed_start_three.style.display= "block";
            }else if(type2 == 'hrs'){
                elapsed_start_unit.classList.remove("col-lg-4");
                elapsed_start_unit.classList.add("col-lg-3");

                elapsed_start_t.innerHTML= "hrs";
                elapsed_start.style.display= "block";
                elapsed_start_one.style.display= "none";
                elapsed_start_sec.style.display= "none";
                elapsed_start_three.style.display= "none";
            }else if(type2 == 'mins'){
                elapsed_start_unit.classList.remove("col-lg-4");
                elapsed_start_unit.classList.add("col-lg-3");
                elapsed_start_t.innerHTML= "mins";
                elapsed_start.style.display= "block";
                elapsed_start_one.style.display= "none";
                elapsed_start_sec.style.display= "none";
                elapsed_start_three.style.display= "none";
            }else{
                elapsed_start_unit.classList.remove("col-lg-4");
                elapsed_start_unit.classList.add("col-lg-3");
                elapsed_start_t.innerHTML= "sec";
                elapsed_start.style.display= "block";
                elapsed_start_one.style.display= "none";
                elapsed_start_sec.style.display= "none";
                elapsed_start_three.style.display= "none";
            }
        });
    </script>
@endpush