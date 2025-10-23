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
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                @php
                    $request = request();
                @endphp
                <div class="col-span-12">
                    <div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-5 ">
                        <label for="month" class="text-blue font-s-14">{{$lang['1']}}</label>
                        <div class="w-100 py-2">
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
                    </div>
                    <div class="col-span-3">
                        <label for="day" class="text-blue font-s-14">&nbsp;</label>
                        <div class="w-100 py-2">
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
                    </div>
                    <div class="col-span-4">
                        <label for="year" class="text-blue font-s-14">&nbsp;</label>
                        <div class="w-100 py-2">
                            <select name="year" id="year" class="input" onchange="updateDays('year', 'month', 'day')">
                                @for ($i = 1950; $i <= 2050; $i++)
                                <option value="{{ $i }}" {{ $selectedDate == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-span-12">
                    <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-5 ">
                        <label for="month1" class="text-blue font-s-14">{{$lang['2']}}</label>
                        <div class="w-100 py-2">
                            <select name="month1" id="month1" class="input" onchange="updateDays('year1', 'month1', 'day1')">
                                @php
                                    $name = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                                    $val = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];
                                    optionsList($val,$name,isset($_POST['month1'])?$_POST['month1']: date('m',strtotime("+1 month") ) );
                                @endphp
                            </select>
                        </div>
                    </div>
                    <div class="col-span-3">
                        <label for="day1" class="text-blue font-s-14">&nbsp;</label>
                        <div class="w-100 py-2">
                            @php
                                $selectedDay = request()->has('day1') ? request()->day1 : date('j');
                                $selectedDate = request()->has('year1') ? request()->year1 : date('Y');
                            @endphp
                            <select name="day1" id="day1" class="input" onchange="updateDays('year1', 'month1', 'day1');">
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}" {{ $selectedDay == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="year1" class="text-blue font-s-14">&nbsp;</label>
                        <div class="w-100 py-2">
                            <select name="year1" id="year1" class="input" onchange="updateDays('year1', 'month1', 'day1')">
                                @for ($i = 1950; $i <= 2050; $i++)
                                <option value="{{ $i }}" {{ $selectedDate == $i ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full overflow-auto">
                    @php
                        $days = $detail['days'];
                        $weeks = $detail['weeks'];
                        $date1 = $detail['date1'];
                        $date2 = $detail['date2'];
                    @endphp
                    <div class="w-full">
                        <div class="w-full md:w-[60%] lg:w-[60%]  p-1 mx-auto text-center">
                            <div class="border  rounded-lg bg-[#F6FAFC] p-2 mt-3" style="border: 1px solid #c1b8b899;">
                                <p>📅 Weeks Between Dates</p>
                                <p class="font-s-25"><strong class="text-blue">{{$weeks > 0 ? $weeks . ' Week' . ($weeks == 1 ? '' : 's') : ''}} 
                                    {{$days > 0 ? $days . ' Day' . ($days == 1 ? '' : 's')  : ''}}</strong></p>
            
                                @if ($days == 0)
                                    <p class="text-[18px]"><strong class="text-blue">0 Weeks</strong></p>
                                @endif
                            </div>
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
            updateDays('year1', 'month1', 'day1');
        });

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