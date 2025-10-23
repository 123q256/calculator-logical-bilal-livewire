<style>
    .bg-orange{
        background: var(--light-blue);
        color: white;
    }
    .cl-orange{
        color: orange;
    }
    .mb_3{
        margin-bottom: -5px; 
    }
    
    @media (min-width: 720px) {
        .ms-6{
            margin-left: 6rem;
        }
    }
    .gap-5{
        gap: 5px;
    }
    .content table, .content th, .content td {
        border: 1px solid #9f9d9d;
        border-collapse: collapse;
        padding: 5px;
        text-align: center;
    }
    .content table tr:hover td {
        color: #fff !important;
        background-color: rgb(0, 0, 0) !important;
    }
    .content table tr td:nth-child(1){
        background-color: var(--bg-gray);
    }
</style>
<form action="{{ url()->current() }}/" method="POST">
    @csrf
        @php
            $request = request();
        @endphp
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="md:flex lg:flex mb-3 justify-content-center pt-1 col-10 mx-auto">
                    <p>
                        <input type="radio" name="timecheck" id="stat" class="cursor-pointer" value="stat" checked {{ isset($_POST['timecheck']) && $_POST['timecheck'] === 'stat' ? 'checked' : '' }}>
                        <label for="stat" class="font-s-14 cursor-pointer text-blue pe-lg-3 pe-2">{{ $lang['1'] }}</label> @if($device == 'mobile') <br> @endif 
                    </p>
                    <p>
                        <input type="radio" class="cursor-pointer pt-2" name="timecheck" id="dyna" value="dyna" {{ isset($_POST['timecheck']) && $_POST['timecheck'] === 'dyna' ? 'checked' : '' }}>
                        <label for="dyna" class="font-s-14 cursor-pointer text-blue">{{ $lang['2'] }}</label>
                    </p>
                </div>



                <div class="grid grid-cols-1   mt-3 gap-4 timeclock {{isset($request->timecheck) && $request->timecheck != 'stat' ? 'hidden' : ''}} ">

                    <div class="flex justify-center">
                    <div class="grid grid-cols-3  lg:w-[70%] md:w-[70%] w-full  gap-4  ">
                        <div class="space-y-2 relative">
                            <label for="month" class="text-blue font-s-14">{{$lang['3']}}</label>
                            <select name="month" id="month" class="input" onchange="updateDays('year', 'month', 'day')">
                                @php
                                    function optionsList($arr1,$arr2,$unit){
                                    foreach($arr1 as $index => $name){
                                @endphp
                                    <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                        {{ $arr2[$index] }}
                                    </option>
                                @php
                                    }}
                                    $name = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                                    $val = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];
                                    optionsList($val,$name,isset($_POST['month'])?$_POST['month']:date('m'));
                                @endphp
                            </select>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="day" class="text-blue font-s-14">{{$lang['4']}}</label>
                            @php
                            $selectedDay = request()->has('day') ? request()->day : date('j');
                            $selectedDate = request()->has('year') ? request()->year : date('Y');
                            @endphp
                            <select name="day" id="day" class="input" onchange="updateDays('year', 'month', 'day');">
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}" {{ $selectedDay == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="year" class="text-blue font-s-14">{{$lang['5']}}</label>
                            <select name="year" id="year" class="input" onchange="updateDays('year', 'month', 'day')">
                                @for ($i = 1950; $i <= 2050; $i++)
                                <option value="{{ $i }}" {{ $selectedDate == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                   </div>
                   <div class="flex justify-center">
                    <div class="grid grid-cols-1   gap-4  lg:w-[70%] md:w-[70%] ">
                        <div class="space-y-2 relative 2  date-now">
                            <div class="flex justify-between">
                                <label for="time" class="font-s-14 text-blue">{{$lang['6']}}</label>
                                <span class="font-s-14 text-end text-blue text-decoration-underline cursor-pointer now">{{isset($lang['now']) ? $lang['now'] : 'Now'}}</span>
                            </div>
                            <div class="w-100 py-2">
                                <input type="time" name="time" id="time" class="input" value="{{ isset($request->time) ? $request->time : date('H:i') }}" aria-label="input" autocomplete="off" />
                            </div>
                        </div>
                        
                    </div>
                   </div>

                </div>
                <div class="grid grid-cols-1   gap-4 dateclock {{isset($request->timecheck) && $request->timecheck != 'stat' ? '' : 'hidden'}}">
                    <div class="flex justify-center">
                    <div class="space-y-2 relative ">
                        <label for="julian" class="font-s-14 text-blue">{{$lang['7']}}</label>
                        <input type="input" name="julian" id="julian" class="input px-3" placeholder="e.g: 2458759.500000" value="{{ isset($request->julian) ? $request->julian : '' }}"  aria-label="input" autocomplete="off" />
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
                    <div class="w-full bg-light-blue result p-3 radius-10 mt-3 overflow-auto">
                        <div class="w-full md:w-[40%] lg:w-[40%] mx-auto p-1 mb-2">
                            <div class="border radius-5 bg-sky p-2 text-center">
                                @if ($request->timecheck == 'dyna')
                                    <p class="pb-1">📅 Calendar Date</p>
                                    <p class="font-s-25"><strong class="text-blue">{{$detail['jul_date']}}</strong></p>
                                @else
                                    <p class="pb-1">📅 Julian Date</p> 
                                    <p class="font-s-25"><strong class="text-blue">{{$detail['julianDate']}}</strong></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        <script>

    


            var currentTime = document.getElementById('time').value;
            document.querySelectorAll('.now').forEach(label => {
                label.addEventListener('click', function() {                
                     // Get the current time in the format HH:MM
                    const now = new Date();
                    const currentTime = now.toTimeString().substring(0, 5); // "HH:M
                    const timeInput = label.closest('.date-now').querySelector('input[type="time"]');
                    if (timeInput) {
                        timeInput.value = currentTime;
                    }
                });
            });
            function updateDays(yearId, monthId, dayId) {
                const month = document.getElementById(monthId).value;
                const year = document.getElementById(yearId).value;
                const daySelect = document.getElementById(dayId);
                let days = 31;

                if (month === '2') { // February
                    days = (year % 4 === 0 && year % 100 !== 0) || year % 400 === 0 ? 29 : 28;
                } else if (['4', '6', '9', '11'].includes(month)) { // April, June, September, November
                    days = 30;
                }

                const selectedDay = daySelect.value; // Store the current selected day

                daySelect.innerHTML = '';
                for (let i = 1; i <= days; i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.textContent = i;
                    if (i == selectedDay) {
                        option.selected = true; // Retain the previously selected day if possible
                    }
                    daySelect.appendChild(option);
                }
            }

            // Initialize days based on the selected month and year on page load
            document.addEventListener('DOMContentLoaded', function() {
                updateDays('year', 'month', 'day');
            });

        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const statRadio = document.getElementById("stat");
                const dynaRadio = document.getElementById("dyna");

                var date = document.querySelector('.dateclock');
                var time = document.querySelector('.timeclock');
                function updateInputs(){
                    if (statRadio.checked) {
                        date.classList.add('hidden');
                        time.classList.remove('hidden');
                    } else if (dynaRadio.checked) {
                        time.classList.add('hidden');
                        date.classList.remove('hidden');
                    }
                }
                statRadio.addEventListener("click", updateInputs);
                dynaRadio.addEventListener("click", updateInputs);

                updateInputs();
            });
            function calculateJulianDate(date) {
                var year = today.getUTCFullYear();
                var month = today.getUTCMonth() + 1; // getUTCMonth() returns 0-11, so we add 1
                var day = today.getUTCDate();

                if (month <= 2) {
                    year -= 1;
                    month += 12;
                }

                var A = Math.floor(year / 100);
                var B = 2 - A + Math.floor(A / 4);

                var julianDay = Math.floor(365.25 * (year + 4716)) + Math.floor(30.6001 * (month + 1)) + day + B - 1524.5;
                return julianDay;
            }
            var today = new Date(); // 10 is November since months are 0-11
            const options = { day: '2-digit', month: 'short', year: 'numeric', timeZone: 'UTC' };
            const utcToday = new Date(Date.UTC(today.getUTCFullYear(), today.getUTCMonth(), today.getUTCDate()));
            const formattedDate = utcToday.toLocaleDateString('en-GB', options).replace(/ /g, '-').replace(',', '') + ' (UTC)';
            var julianDate = calculateJulianDate(today);
            document.getElementById('todaydate').innerHTML = formattedDate;
            document.getElementById('julianDate').innerHTML = julianDate;
        </script>
    @endpush
</form>