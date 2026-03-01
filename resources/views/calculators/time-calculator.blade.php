<form class="row position-relative" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        <div class="col-12  mx-auto mt-2 w-full">
            <div class="row">
                @if (isset($error))
                <p class="text-red-500 text-lg mb-3"><strong>{{ $error }}</strong></p>
                @endif
                <div class="container mx-auto">
                    <input type="hidden" name="sim_adv" id="calculator_time" value="{{ isset(request()->sim_adv) ? request()->sim_adv : 'time_first' }}">
    
                        <div class="flex flex-wrap items-center bg-green-100 border border-green-500 text-center rounded-lg px-1">
                                
                            <div class="lg:w-1/3 w-full px-2 py-1">
                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit " id="time_first">
                                    {{$cal_name}}
                                </div>
                            </div>
                            <div class="lg:w-1/3 w-full px-2 py-1">
                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white " id="time_sec">
                                    {{$lang['7']}}
                                </div>
                            </div>
                            <div class="lg:w-1/3 w-full px-2 py-1">
                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white " id="time_three">
                                    {{$lang['20']}}
                                </div>
                            </div>
                        
                        </div>
                </div>
    
                <div class="time_due ">
                    <p class="text-lg mt-4 "> {{ $lang['after_title_1'] }} </p>
                    <div >
                        <div class="flex flex-wrap gap-4">
                            <div class="flex-1 px-2 py-2">
                                <label for="t_days" class="text-blue-600 text-sm font-medium">{{ $lang['days'] }}:</label>
                                <div class="py-2">
                                    <input type="number" step="any" name="t_days" id="t_days" class="w-full px-3 py-2 border border-gray-300 rounded-md" aria-label="input" value="{{ isset(request()->t_days) ? request()->t_days : '5' }}" placeholder="days" />
                                </div>
                            </div>
                            <div class="flex-1 px-2 py-2">
                                <label for="t_hours" class="text-blue-600 text-sm font-medium">{{ $lang['hours'] }}:</label>
                                <div class="py-2">
                                    <input type="number" step="any" name="t_hours" id="t_hours" class="w-full px-3 py-2 border border-gray-300 rounded-md" aria-label="input" value="{{ isset(request()->t_hours) ? request()->t_hours : '6' }}" placeholder="hrs" />
                                </div>
                            </div>
                            <div class="flex-1 px-2 py-2">
                                <label for="t_min" class="text-blue-600 text-sm font-medium">{{ $lang['min'] }}:</label>
                                <div class="py-2">
                                    <input type="number" step="any" name="t_min" id="t_min" class="w-full px-3 py-2 border border-gray-300 rounded-md" aria-label="input" value="{{ isset(request()->t_min) ? request()->t_min : '5' }}" placeholder="min" />
                                </div>
                            </div>
                            <div class="flex-1 px-2 py-2">
                                <label for="t_sec" class="text-blue-600 text-sm font-medium">{{ $lang['sec'] }}:</label>
                                <div class="py-2">
                                    <input type="number" step="any" name="t_sec" id="t_sec" class="w-full px-3 py-2 border border-gray-300 rounded-md" aria-label="input" value="{{ isset(request()->t_sec) ? request()->t_sec : '6' }}" placeholder="sec" />
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="my-2 flex justify-center space-x-4">
                        <div class="flex items-center">
                            <input type="radio" id="a" name="t_method" value="plus" 
                                class="mr-2" 
                                @if((isset($_POST['t_method']) && $_POST['t_method'] === 'plus') || !isset($_POST['t_method'])) checked @endif>
                            <label for="a" class="text-sm">+Add</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" id="m" name="t_method" value="minus" 
                                class="mr-2" 
                                @if(isset($_POST['t_method']) && $_POST['t_method'] === 'minus') checked @endif>
                            <label for="m" class="text-sm">-Subtract</label>
                        </div>
                    </div>
                    
                        <div class="flex flex-wrap gap-4">
                            <div class="flex-1 px-2 py-2">
                                <label for="te_days" class="text-blue-600 text-sm font-medium">{{ $lang['days'] }}:</label>
                                <div class="py-2">
                                    <input type="number" step="any" name="te_days" id="te_days" class="w-full px-3 py-2 border border-gray-300 rounded-md" aria-label="input" value="{{ isset(request()->te_days) ? request()->te_days : '5' }}" placeholder="date" />
                                </div>
                            </div>
                            <div class="flex-1 px-2 py-2">
                                <label for="te_hours" class="text-blue-600 text-sm font-medium">{{ $lang['hours'] }}:</label>
                                <div class="py-2">
                                    <input type="number" step="any" name="te_hours" id="te_hours" class="w-full px-3 py-2 border border-gray-300 rounded-md" aria-label="input" value="{{ isset(request()->te_hours) ? request()->te_hours : '5' }}" placeholder="hrs" />
                                </div>
                            </div>
                            <div class="flex-1 px-2 py-2">
                                <label for="te_min" class="text-blue-600 text-sm font-medium">{{ $lang['min'] }}:</label>
                                <div class="py-2">
                                    <input type="number" step="any" name="te_min" id="te_min" class="w-full px-3 py-2 border border-gray-300 rounded-md" aria-label="input" value="{{ isset(request()->te_min) ? request()->te_min : '6' }}" placeholder="min" />
                                </div>
                            </div>
                            <div class="flex-1 px-2 py-2">
                                <label for="te_sec" class="text-blue-600 text-sm font-medium">{{ $lang['sec'] }}:</label>
                                <div class="py-2">
                                    <input type="number" step="any" name="te_sec" id="te_sec" class="w-full px-3 py-2 border border-gray-300 rounded-md" aria-label="input" value="{{ isset(request()->te_sec) ? request()->te_sec : '6' }}" placeholder="sec" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="time_due_sec hidden">
                    <p class="text-lg mt-4  "> {{ $lang['8'] }} </p>
                    <div class=" mt-5 flex flex-wrap gap-4 ">
                        <!-- Date Input -->
                        <div class=" w-full lg:w-auto">
                            <label for="td_date" class="text-blue-600 text-sm font-medium">{{ $lang['days'] }}:</label>
                            <div class="py-2">
                            <input type="date" name="td_date" id="td_date" class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                                aria-label="input" value="{{ isset(request()->td_date) ? request()->td_date : date('Y-m-d') }}" />
                            </div>
                        </div>
                        <!-- Hours Input -->
                        <div class="flex-1">
                            <label for="ts_hours" class="text-blue-600 text-sm font-medium">{{ $lang['hours'] }}:</label>
                            <div class="py-2">
                            <input type="number" step="any" name="t_hours" id="ts_hours" class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                                aria-label="input" value="{{ isset(request()->t_hours) ? request()->t_hours : '6' }}" placeholder="hrs" />
                            </div>
                        </div>
                        <!-- Minutes Input -->
                        <div class="flex-1">
                            <label for="ts_min" class="text-blue-600 text-sm font-medium">{{ $lang['min'] }}:</label>
                            <div class="py-2">
                            <input type="number" step="any" name="t_min" id="ts_min" class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                                aria-label="input" value="{{ isset(request()->t_min) ? request()->t_min : '5' }}" placeholder="min" />
                            </div>
                        </div>
                        <!-- Seconds Input -->
                        <div class="flex-1">
                            <label for="ts_sec" class="text-blue-600 text-sm font-medium">{{ $lang['sec'] }}:</label>
                            <div class="py-2">
                            <input type="number" step="any" name="t_sec" id="ts_sec" class="w-full px-3 py-2 border border-gray-300 rounded-md" 
                                aria-label="input" value="{{ isset(request()->t_sec) ? request()->t_sec : '5' }}" placeholder="sec" />
                            </div>
                        </div>
                        <!-- AM/PM Selector -->
                        <div class="flex-1 ">
                            <label for="am_pm" class="text-blue-600 text-sm font-medium">12/24</label>
                            <div class="py-2">
                                
    
    
                            <select name="am_pm" id="am_pm" class=" px-3 py-2 border border-gray-300 rounded-md">
    
                                @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                        {{ $arr2[$index] }}
                                    </option>
                                @php
                                }}
                                $name = ["AM", "PM","24-hr"];
                                $val = ["am", "pm","24"];
                                optionsList($val,$name,isset(request()->am_pm)?request()->am_pm:'pm');
                            @endphp
    
    
    
                                
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="my-6 flex justify-center space-x-4">
                        <div class="flex items-center">
                            <input type="radio" id="td" name="td_method" value="plus" 
                                class="mr-2" 
                                @if((isset($_POST['td_method']) && $_POST['td_method'] === 'plus') || !isset($_POST['td_method'])) checked @endif>
                            <label for="td" class="text-sm">+Add</label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" id="tds" name="td_method" value="minus" 
                                class="mr-2" 
                                @if(isset($_POST['td_method']) && $_POST['td_method'] === 'minus') checked @endif>
                            <label for="tds" class="text-sm">-Subtract</label>
                        </div>
                    </div>
                    
                    
                    <div class=" flex flex-wrap gap-4 ">
                        <!-- Date Input -->
                        <div class="flex-1">
                            <label for="td_days" class="text-blue-600 text-sm font-medium">{{ $lang['days'] }}:</label>
                            <div class="py-2">
                                <input type="number" step="any" name="td_days" id="td_days" class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                    aria-label="input" value="{{ isset(request()->td_days) ? request()->td_days : '10' }}" placeholder="days" />
                            </div>
                        </div>
                        <!-- Hours Input -->
                        <div class="flex-1">
                            <label for="td_hours" class="text-blue-600 text-sm font-medium">{{ $lang['hours'] }}:</label>
                            <div class="py-2">
                                <input type="number" step="any" name="td_hours" id="td_hours" class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                    aria-label="input" value="{{ isset(request()->td_hours) ? request()->td_hours : '5' }}" placeholder="hrs" />
                            </div>
                        </div>
                        <!-- Minutes Input -->
                        <div class="flex-1">
                            <label for="td_min" class="text-blue-600 text-sm font-medium">{{ $lang['min'] }}:</label>
                            <div class="py-2">
                                <input type="number" step="any" name="td_min" id="td_min" class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                    aria-label="input" value="{{ isset(request()->td_min) ? request()->td_min : '35' }}" placeholder="min" />
                            </div>
                        </div>
                        <!-- Seconds Input -->
                        <div class="flex-1">
                            <label for="td_sec" class="text-blue-600 text-sm font-medium">{{ $lang['sec'] }}:</label>
                            <div class="py-2">
                                <input type="number" step="any" name="td_sec" id="td_sec" class="w-full px-3 py-2 border border-gray-300 rounded-md"
                                    aria-label="input" value="{{ isset(request()->td_sec) ? request()->td_sec : '10' }}" placeholder="sec" />
                            </div>
                        </div>
                        <!-- AM/PM Selector -->
                        <div class="flex-1 hidden md:block">
                        </div>
                    
                    </div>
                </div>
                <div class="paragraph hidden">
                    <p class="text-lg mt-4 "> {{ $lang['14'] }} </p>
                    <div class="col-12 mt-0 mt-lg-2 my-4 ">
                        <div class="w-full py-2">
                            <textarea name="input" id="input" class="w-full px-3 py-2 border border-gray-300 rounded-md resize-none"
                                aria-label="input">{{ isset(request()->input) ? request()->input : '2d 3h 15m 30s + 5h 20s - 1200s + 12h' }}</textarea>
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
    @if(isset($detail))
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full col-12   rounded-lg mt-3">
                    <div class="my-2">
                        @if(request()->sim_adv == 'time_first')
                            <div class="lg:w-3/3 text-lg">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4   rounded-lg ">
                                    <div class="flex justify-between items-center border-b border-gray-300 py-2">
                                        <span class="font-medium text-gray-600">{{ $lang['10'] }}</span>
                                        <span class="text-gray-900">{{ round($detail['totalDays'], 3) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-gray-300 py-2">
                                        <span class="font-medium text-gray-600">{{ $lang['11'] }}</span>
                                        <span class="text-gray-900">{{ round($detail['totalHours'], 3) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-gray-300 py-2">
                                        <span class="font-medium text-gray-600">{{ $lang['12'] }}</span>
                                        <span class="text-gray-900">{{ round($detail['totalMin'], 3) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-gray-300 py-2">
                                        <span class="font-medium text-gray-600">{{ $lang['13'] }}</span>
                                        <span class="text-gray-900">{{ round($detail['totalSec'], 3) }}</span>
                                    </div>
                                </div>
                            </div>
                        @elseif(request()->sim_adv == 'time_second')
                            <div class="text-center">
                                <!-- Main time result block -->
                                <div class=" px-6 py-4 rounded-lg inline-block my-4 bg-[#F6FAFC] border">
                                    <p class="text-2xl font-bold text-blue-600">{{ $detail['resTime'] }}</p>
                                    <p class="text-lg text-gray-700">{{ $detail['finalDate'].' '.$detail['resDay'] }}</p>
                                </div>
                            </div>
                        @else
                            <div class="lg:w-full text-lg">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4   rounded-lg ">
                                    <div class="flex justify-between items-center border-b border-gray-300 py-2">
                                        <span class="font-medium text-gray-600">{{ $lang['10'] }}</span>
                                        <span class="text-gray-900">{{ round($detail['daysResult'], 3) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-gray-300 py-2">
                                        <span class="font-medium text-gray-600">{{ $lang['11'] }}</span>
                                        <span class="text-gray-900">{{ round($detail['hoursResult'], 3) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-gray-300 py-2">
                                        <span class="font-medium text-gray-600">{{ $lang['12'] }}</span>
                                        <span class="text-gray-900">{{ round($detail['mintsResult'], 3) }}</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-gray-300 py-2">
                                        <span class="font-medium text-gray-600">{{ $lang['13'] }}</span>
                                        <span class="text-gray-900">{{ round($detail['secondsResult'], 3) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @push('calculatorJS')
        <script>

        document.getElementById('time_first').addEventListener('click', function() {
            this.classList.add('tagsUnit');
            document.getElementById('calculator_time').value = "time_first";

            document.getElementById('time_sec').classList.remove('tagsUnit');
            document.getElementById('time_three').classList.remove('tagsUnit');
            document.querySelectorAll('.time_due').forEach(element => {
                element.classList.add("d-lg-flex");
                element.classList.remove("hidden");
            });
            document.querySelectorAll('.time_due_sec').forEach(element => {
                element.classList.add("hidden");
            });
            document.querySelector(".paragraph").style.display = "none";
            document.querySelector(".after_title").innerHTML = "{{ $lang['after_title_1'] }}";
        });

        document.getElementById('time_sec').addEventListener('click', function() {
            this.classList.add('tagsUnit');
            document.getElementById('calculator_time').value = "time_second";
            document.getElementById('time_first').classList.remove('tagsUnit');
            document.getElementById('time_three').classList.remove('tagsUnit');
            document.querySelectorAll('.time_due').forEach(element => {
                element.classList.add("hidden");
            });
            document.querySelectorAll('.time_due_sec').forEach(element => {
                element.classList.add("d-lg-flex");
                element.classList.remove("hidden");
            });
            document.querySelector(".paragraph").style.display = "none";
            document.querySelector(".paragraphs").style.display = "none";
            document.querySelector(".after_title").innerHTML = "{{ $lang['8'] }}";

        });

        document.getElementById('time_three').addEventListener('click', function() {
            this.classList.add('tagsUnit');
            document.getElementById('calculator_time').value = "time_third";
            document.getElementById('time_first').classList.remove('tagsUnit');
            document.getElementById('time_sec').classList.remove('tagsUnit');
            document.querySelectorAll('.time_due').forEach(element => {
                element.classList.add("hidden");
            });
            document.querySelectorAll('.time_due_sec').forEach(element => {
                element.classList.add("hidden");
            });
            document.querySelector(".paragraph").style.display = "block";
            document.querySelector(".paragraphs").style.display = "block";
            document.querySelector(".after_title").innerHTML = "{{ $lang['14'] }}";

        });

        @if(isset($detail) || isset($error))

        sim_adv = '{{$_POST['sim_adv']}}';

        if (sim_adv === 'time_first') {

            document.getElementById('time_first').classList.add('tagsUnit');
            document.getElementById('time_sec').classList.remove('tagsUnit');
            document.getElementById('time_three').classList.remove('tagsUnit');
            document.querySelectorAll('.time_due').forEach(element => {
                element.classList.add("d-lg-flex");
                element.classList.remove("hidden");
            });
            document.querySelectorAll('.time_due_sec').forEach(element => {
                element.classList.add("hidden");
            });
            document.querySelector(".paragraph").style.display = "none";
            document.querySelector(".after_title").innerHTML = "{{ $lang['after_title_1'] }}";
        }

        if (sim_adv === 'time_second') {

            document.getElementById('time_first').classList.remove('tagsUnit');
            document.getElementById('time_sec').classList.add('tagsUnit');
            document.getElementById('time_three').classList.remove('tagsUnit');
        
            document.querySelectorAll('.time_due').forEach(element => {
                element.classList.add("hidden");
            });
            document.querySelectorAll('.time_due_sec').forEach(element => {
                element.classList.add("d-lg-flex");
                element.classList.remove("hidden");
            });
            document.querySelector(".paragraph").style.display = "none";
            document.querySelector(".paragraphs").style.display = "none";
            document.querySelector(".after_title").innerHTML = "{{ $lang['8'] }}";

              
        }

        if (sim_adv === 'time_third') {
                document.getElementById('time_first').classList.remove('tagsUnit');
                document.getElementById('time_sec').classList.remove('tagsUnit');
                document.getElementById('time_three').classList.add('tagsUnit');
                document.querySelectorAll('.time_due').forEach(element => {
                    element.classList.add("hidden");
                });
                document.querySelectorAll('.time_due_sec').forEach(element => {
                    element.classList.add("hidden");
                });
                document.querySelector(".paragraph").style.display = "block";
                document.querySelector(".paragraphs").style.display = "block";
                document.querySelector(".after_title").innerHTML = "{{ $lang['14'] }}";
        }
       @endif

        </script>
    @endpush
</form>


