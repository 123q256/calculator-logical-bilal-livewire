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
        .countdown div{
            padding: 30px 20px;
        }
        .gap-5{
            gap: 8px;
        }
    }
    @media (max-width: 600px) {
        .countdown div{
            padding: 24px 9px;
        }
        .gap-5{
            gap: 4px;
        }
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
           <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
                <div class="grid grid-cols-1   gap-4">
                    <p class="px-2 font-s-14 text-blue">{{isset($lang['bday']) ? $lang['bday'] : '' }}</p>
                    <div class="grid grid-cols-3   gap-4">
                        <div class="space-y-2 relative">
                            <label for="month" class="text-blue font-s-14">{{$lang['1']}}</label>
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
                            <label for="day" class="text-blue font-s-14">{{$lang['2']}}</label>
                            @php
                                    $selectedDay = request()->has('day') ? request()->day : date('j');
                                    $selectedDate = request()->has('year') ? request()->year : '1999';
                                @endphp
                                <select name="day" id="day" class="input" onchange="updateDays('year', 'month', 'day');">
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}" {{ $selectedDay == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                        </div>
                        <div class="space-y-2 relative">
                            <label for="year" class="text-blue font-s-14">{{$lang['3']}}</label>
                            <select name="year" id="year" class="input" onchange="updateDays('year', 'month', 'day')">
                                @for ($i = 1950; $i <= 2050; $i++)
                                <option value="{{ $i }}" {{ $selectedDate == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1   gap-4">
                        <div class="space-y-2 relative">
                            <label for="year" class="text-blue font-s-14">{{$lang['4']}}</label>
                            <input type="text" class="input" name="name" value="{{request()->has('name') ? request()->name : ''}}" placeholder="Optional">
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
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full  p-3 rounded-lg mt-3 overflow-auto">
                        <div class="flex flex-col items-center">
                            <div class="w-full lg:w-2/3 mb-2 text-center">
                                <p class="text-lg my-2">There are only</p>
                                <div class="flex justify-between gap-5 text-center items-center">
                                    <div class="bg-blue-100 rounded-md p-2 px-5">
                                        <strong class="text-blue-700 block text-2xl" id="days">000</strong>
                                        <strong class="text-sm">Days</strong>
                                    </div>
                                    <strong class="text-2xl text-blue-700">:</strong>
                                    <div class="bg-blue-100 rounded-md p-2 px-5">
                                        <strong class="text-blue-700 block text-2xl" id="hours">00</strong>
                                        <strong class="text-sm">Hours</strong>
                                    </div>
                                    <strong class="text-2xl text-blue-700">:</strong>
                                    <div class="bg-blue-100 rounded-md p-2 px-5">
                                        <strong class="text-blue-700 block text-2xl" id="minutes">00</strong>
                                        <strong class="text-sm">Minutes</strong>
                                    </div>
                                    <strong class="text-2xl text-blue-700">:</strong>
                                    <div class="bg-blue-100 rounded-md p-2 px-5">
                                        <strong class="text-blue-700 block text-2xl" id="seconds">00</strong>
                                        <strong class="text-sm">Seconds</strong>
                                    </div>
                                </div>
                                <p class="text-lg mt-2">until {{ isset(request()->name) ? request()->name."'s" : 'Your' }} Birthday!</p>
                            </div>
                            <table class="w-full lg:w-2/3 border-collapse border-spacing-0">
                                <tr>
                                    <td class="border-b border-gray-300 py-2">🎂 Your Age</td>
                                    <td class="border-b border-gray-300 py-2 text-right">
                                        <strong>{{$detail['age']}} Years</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b border-gray-300 py-2">📅 Months remaining until your birthday</td>
                                    <td class="border-b border-gray-300 py-2 text-right">
                                        <strong>
                                            {{$detail['diffInMonths']}}
                                            @if($detail['diffInMonths'] == 1)
                                                Month
                                            @else
                                                Months
                                            @endif
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b border-gray-300 py-2">🌞 Hours remaining until your birthday</td>
                                    <td class="border-b border-gray-300 py-2 text-right">
                                        <strong>
                                            {{$detail['diffInHours']}}
                                            @if($detail['diffInHours'] == 1)
                                                Hour
                                            @else
                                                Hours
                                            @endif
                                        </strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border-b border-gray-300 py-2">🕑 Minutes remaining until your birthday</td>
                                    <td class="border-b border-gray-300 py-2 text-right">
                                        <strong>
                                            {{$detail['diffInMinutes']}}
                                            @if($detail['diffInMinutes'] == 1)
                                                Minute
                                            @else
                                                Minutes
                                            @endif
                                        </strong>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
        </div>
    </div>

    @endisset
</form>
@push('calculatorJS')
<script>
    @isset($detail)
        function updateCountdown(targetDate) {
            const now = new Date();
            const timeLeft = targetDate - now;

            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

            document.getElementById('days').textContent = days.toString().padStart(2, '0');
            document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
            document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            const nextBirthday = new Date('{{ $detail['nextBirthday']->format('Y-m-d\TH:i:s') }}');

            setInterval(() => {
                updateCountdown(nextBirthday);
            }, 1000);
        });
    @endisset
</script>
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

        // Initialize days based on the selected month and year on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateDays('year', 'month', 'day');
        });

    </script>
    <script>

        function formatDate(date) {
            return date.toISOString().split('T')[0];
        }

        function formatDateString(date) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString('en-US', options);
        }

        function getDayName(date, locale) {
            var date = new Date(date);
            return date.toLocaleDateString(locale, { weekday: 'long' });
        }

            function addWeeks(date, weeks) {
                const result = new Date(date);
                result.setDate(result.getDate() - weeks);
                return result;
            }

            const today = new Date(); // Note: Months are zero-based, so 9 is October
            

            const weeksContainer = document.getElementById('weeksContainer');
            const twoweeksContainer = document.getElementById('twoweeksContainer');
            for (let i = 1; i <= 26; i++) {
                const addedWeeksDate = addWeeks(today, i);
                const formattedDate = formatDateString(addedWeeksDate);
                const formattedDateS = formatDate(addedWeeksDate);
                const dateName = getDayName(addedWeeksDate);
                const weekElement = document.createElement('tr');
                weekElement.innerHTML = `
                    <tr>
                        <td><time datetime="P${i}W">${i} Days</time></td>
                        <td>
                            <time datetime="${formattedDateS}">${dateName}</time>
                            </br>
                            <time datetime="${formattedDateS}">${formattedDate}</time>
                        </td>
                    </tr>
                `;
                weeksContainer.appendChild(weekElement);
            }
            for (let i = 27; i <= 50; i++) {
                const addedWeeksDate = addWeeks(today, i);
                const formattedDate = formatDateString(addedWeeksDate);
                const formattedDateS = formatDate(addedWeeksDate);
                const dateName = getDayName(addedWeeksDate);


                const weekElement = document.createElement('tr');
                weekElement.innerHTML = `
                    <tr>
                        <td><time datetime="P${i}W">${i} Days</time></td>
                        <td>
                            <time datetime="${formattedDateS}">${dateName}</time>
                            </br>
                            <time datetime="${formattedDateS}">${formattedDate}</time>
                        </td>
                    </tr>
                `;
                twoweeksContainer.appendChild(weekElement);
            }

            const addFourWeeks = addWeeks(today, 4);
            const addSixWeeks = addWeeks(today, 6);
            const addEightWeeks = addWeeks(today, 8);
            const addTenWeeks = addWeeks(today, 10);
            const addtwlWeeks = addWeeks(today, 12);

            document.querySelectorAll('.todaydate').forEach(element => {
                element.innerHTML = formatDate(today);
            });
            // 12 week
            document.getElementById('addtwlWeeks').innerHTML = formatDate(addtwlWeeks);
            // 4 week
            document.getElementById('addFourWeeks').innerHTML = formatDate(addFourWeeks);
            // 6 week
            document.getElementById('addSixWeeks').innerHTML = formatDate(addSixWeeks);
            // 8 week
            document.getElementById('addEightWeeks').innerHTML = formatDate(addEightWeeks);
            // 10 week
            document.getElementById('addTenWeeks').innerHTML = formatDate(addTenWeeks);
    </script>
@endpush