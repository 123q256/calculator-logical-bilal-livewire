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
    #current{
        padding-right: 8px;
    }
    #current::-webkit-calendar-picker-indicator{
        cursor: pointer;
        font-size: 20px;
    }
    @media (min-width: 720px) {
        .ms-6{
            margin-left: 6rem;
        }
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
    .border-bb{
        border-bottom: 1px solid black !important;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
        @php
            $request = request();
        @endphp

<div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-3 my-5  gap-4">
                <div class="space-y-2 relative">
                    <label for="month" class="font-s-14 text-blue">{{$lang['1']}}</label>
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
                    <label for="day" class="font-s-14 text-blue">{{$lang['2']}}</label>
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
                    <label for="year" class="font-s-14 text-blue">{{$lang['3']}}</label>
                    <select name="year" id="year" class="input" onchange="updateDays('year', 'month', 'day')">
                        @for ($i = 1950; $i <= 2050; $i++)
                        <option value="{{ $i }}" {{ $selectedDate == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
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
                        <div class="col-12 bg-light-blue result p-3 radius-10 mt-3 overflow-auto">
                            <div class="text-center mb-3">
                                <p class="mb-3">{{$lang['4']}} <span id="currentYear">&nbsp;</span></p>
                                <p class="border radius-5 d-inline p-2 px-4 bg-[#2845F5] text-white text-[32px]"><strong class="text-blue">{{$detail['daysRemaining']}} Days</strong></p>
                            </div>
                            @php
                                $remainingDaysAfterMonths = $detail['remainingDaysAfterMonths'];
                                $remainingDaysAfterWeeks = $detail['remainingDaysAfterWeeks'];
                            @endphp
                            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2   gap-4">
                                <div class="col-lg-6 p-1">
                                    <div class="border radius-5 bg-sky p-2">
                                        <p>📅 Months</p>
                                        <p class="font-s-18"><strong>{{$detail['monthsRemaining']}} 
                                            @if($detail['monthsRemaining'] == 1)
                                                Month
                                            @else
                                                Months
                                            @endif 
                                            @if ($remainingDaysAfterMonths == 0)
                                                {{''}}
                                            @elseif($remainingDaysAfterMonths == 1)
                                                {{$remainingDaysAfterMonths}} Day
                                            @else
                                                {{$remainingDaysAfterMonths}} Days
                                            @endif
                                        </strong></p>
                                    </div>
                                </div>
                                
                                <div class="col-lg-6 p-1">
                                    <div class="border radius-5 bg-sky p-2">
                                        <p>📅 Weeks</p>
                                        {{-- @dd($remainingDaysAfterWeeks) --}}
                                        <p class="font-s-18"><strong>{{$detail['weeksRemaining']}} 
                                            @if($detail['weeksRemaining'] == 1)
                                                Week
                                            @else
                                                Weeks
                                            @endif
                                            @if ($remainingDaysAfterWeeks == 0)
                                                {{''}}
                                            @elseif($remainingDaysAfterWeeks == 1)
                                                {{$remainingDaysAfterWeeks}} Day
                                            @else
                                                {{$remainingDaysAfterWeeks}} Days
                                            @endif
                                    </strong></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 p-1">
                                    <div class="border radius-5 bg-sky p-2">
                                        <p>🌞 Days</p>
                                        <p class="font-s-18"><strong>{{$detail['daysRemaining']}}
                                        @if($detail['daysRemaining'] == 1)
                                            Day
                                        @else
                                            Days
                                        @endif
                                            </strong></p>
                                    </div>
                                </div>
                                <div class="col-lg-6 p-1">
                                    <div class="border radius-5 bg-sky p-2">
                                        <p>🕑 Hours</p>
                                        <p class="font-s-18"><strong>{{$detail['hoursRemaining']}} hours</strong></p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center p-2">
                                What is Days form <strong>{{$detail['now']}}</strong> left in this year ? The answer is  <strong>{{$detail['daysRemaining']}}</strong> Days are left in End of the year. <strong>{{$detail['weeksRemaining']}}</strong> weeks and <strong>{{$detail['remainingDaysAfterWeeks']}}</strong> days are Remaining  left in the year.
                            </p>
                        </div>
                </div>
            </div>
        </div>
    


    @endisset
</form>
@push('calculatorJS')
    <script>
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
        document.addEventListener('DOMContentLoaded', function() {
            updateDays('year', 'month', 'day');
        });

        const months = [
            "January", "February", "March", "April", "May", "June", 
            "July", "August", "September", "October", "November", "December"
        ];
        function daysInMonth(month, year) {
            return new Date(year, month + 1, 0).getDate();
        }
        function generateTable() {
            const monthSelect = document.getElementById('monthSelect');
            const selectedMonth = monthSelect.value;
            const currentYear = new Date().getFullYear();
            const days = daysInMonth(selectedMonth, currentYear);
            var DaysinYear;
            if ((0 == currentYear % 4) && (0 != currentYear % 100) || (0 == currentYear % 400)) {
                DaysinYear = 366;
            } else {
                DaysinYear = 365;
            }
            let table = `<table class="table-auto w-full md:w-[80%] lg:w-[80%] border border-collapse border-gray-300 my-4">
                            <thead>
                                <tr>
                                    <th class="bg-white border-bb hover:bg-gray-50 p-2 border" colspan=4 style="background: #2845F5;">${months[selectedMonth]} ${currentYear}</th>
                                </tr>
                                <tr>
                                    <th class="bg-white border-bb hover:bg-gray-50 p-2 border">Date</th>
                                    <th class="bg-white border-bb hover:bg-gray-50 p-2 border">Day</th>
                                    <th class="bg-white border-bb hover:bg-gray-50 p-2 border">Day of the Year</th>
                                    <th class="bg-white border-bb hover:bg-gray-50 p-2 border">Days Left Till the End of the Year</th>
                                </tr>
                            </thead>
                            <tbody>`;

            let dayOfYear = 1;
            for (let i = 0; i < selectedMonth; i++) {
                dayOfYear += daysInMonth(i, currentYear);
            }

            for (let i = 1; i <= days; i++) {
                const date = new Date(currentYear, selectedMonth, i);
                const dayName = date.toLocaleString('en-us', { weekday: 'long' });
                const daysLeft = DaysinYear - dayOfYear ;

                table += `<tr>
                            <td class="bg-white border-bb hover:bg-gray-50 p-2 border">${i}</td>
                            <td class="bg-white border-bb hover:bg-gray-50 p-2 border">${dayName}</td>
                            <td class="bg-white border-bb hover:bg-gray-50 p-2 border">${dayOfYear}</td>
                            <td class="bg-white border-bb hover:bg-gray-50 p-2 border">${daysLeft}</td>
                        </tr>`;
                dayOfYear++;
            }

            table += `</tbody></table>`;
            document.getElementById('tableContainer').innerHTML = table;
        }
        function populateMonthSelect() {
            const monthSelect = document.getElementById('monthSelect');
            const currentMonth = new Date().getMonth();

            months.forEach((month, index) => {
                const option = document.createElement('option');
                option.value = index;
                option.text = month;
                if (index === currentMonth) {
                    option.selected = true;
                }
                monthSelect.add(option);
            });

            generateTable();
        }
        populateMonthSelect();

        function calculateDaysInfo() {
            const today = new Date();
            const currentYear = today.getFullYear();
            const currentMonth = today.getMonth();
            const currentDay = today.getDate();
            const daysInCurrentMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            const daysLeftInCurrentMonth = daysInCurrentMonth - currentDay;
            
            let daysLeftInNextMonths = 0;
            for (let month = currentMonth + 1; month < 12; month++) {
                daysLeftInNextMonths += new Date(currentYear, month + 1, 0).getDate();
            }
            const totalDaysLeftInYear = daysLeftInCurrentMonth + daysLeftInNextMonths;
            const weeksleft = Math.floor(totalDaysLeftInYear / 7);
            const daysLeft = totalDaysLeftInYear % 7;
            document.querySelectorAll('.daysLeftInMonth').forEach(element => {
                element.innerText = daysLeftInCurrentMonth;
            });
            document.querySelectorAll('.totalDaysInMonth').forEach(element => {
                element.innerText = daysInCurrentMonth;
            });
            document.querySelectorAll('.currentDayNumber').forEach(element => {
                element.innerText = currentDay;
            });
            document.querySelectorAll('.daysLeftInNextMonths').forEach(element => {
                element.innerText = daysLeftInNextMonths;
            });
            document.querySelectorAll('.totalDaysLeftInYear').forEach(element => {
                element.innerText = totalDaysLeftInYear;
            });
            function formatDateString(date) {
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                return date.toLocaleDateString('en-US', options);
            }
            document.querySelectorAll('.todaydate').forEach(element => {
                element.innerHTML = formatDateString(today);
            });
            var newDescription = `Find the remaining days till the end of this year. There are ${totalDaysLeftInYear} days left until the end of ${currentYear} that are equivalent to the ${weeksleft} weeks ${daysLeft} day.`;
            let metaDescription = document.querySelector('meta[name="description"]');
            if (metaDescription) {
                metaDescription.setAttribute('content', newDescription);
            } 
            document.getElementById('currentYear').innerHTML = currentYear;
        }
        calculateDaysInfo();

    </script>
@endpush