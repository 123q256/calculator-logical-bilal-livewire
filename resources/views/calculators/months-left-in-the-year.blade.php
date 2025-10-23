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
            @php
                $request = request();
            @endphp
           <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1 my-5  lg:grid-cols-3 md:grid-cols-3 gap-4">
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
                            $selectedDate = request()->has('year') ? request()->year : date('Y');
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
                    @php
                    $remainingDaysAfterMonths = $detail['remainingDaysAfterMonths'];
                    $remainingDaysAfterWeeks = $detail['remainingDaysAfterWeeks'];
                @endphp
                <div class="text-center mb-3">
                    <p class="mb-3">{{$lang['4']}} <span id="currentYear">&nbsp;</span></p>
                    <p class="border radius-5 d-inline p-2 px-4 bg-white font-s-32"><strong class="text-blue">
                        {{$detail['monthsRemaining']}} 
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
                    <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                        
                        <div class="space-y-2">
                            <div class="border radius-5 bg-[#F6FAFC] p-4">
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
                        <div class="space-y-2">
                            <div class="border radius-5 bg-[#F6FAFC] p-4">
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
                        <div class="space-y-2">
                            <div class="border radius-5 bg-[#F6FAFC] p-4">
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
                        <div class="space-y-2">
                            <div class="border radius-5 bg-[#F6FAFC] p-4">
                                <p>🕑 Hours</p>
                                <p class="font-s-18"><strong>{{$detail['hoursRemaining']}} hours</strong></p>
                            </div>
                        </div>
                    </div>
                    <p class="text-center p-2">
                        How many Months form <strong>{{$detail['now']}}</strong> left in this year ? The answer is  <strong>{{$detail['monthsRemaining']}}</strong>  @if($detail['monthsRemaining'] == 1)
                            Month 
                        @else
                            Months are
                        @endif  left in End of the year. <strong>{{$detail['weeksRemaining']}}</strong> weeks and <strong>{{$detail['remainingDaysAfterWeeks']}}</strong> days are Remaining  left in the year.
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

        // Initialize days based on the selected month and year on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateDays('year', 'month', 'day');
        });

    </script>
    <script>
        const now = new Date();
        const currentMonth = now.getMonth() + 1; 
        const monthsRemaining = 12 - currentMonth;
        const month = now.toLocaleString('default', { month: 'long' });

        document.querySelectorAll('.currentMonth').forEach(element => {
            element.innerHTML = currentMonth;
        });
        document.querySelectorAll('.monthsRemaining').forEach(element => {
            element.innerHTML = monthsRemaining;
        });
        document.querySelectorAll('.month').forEach(element => {
            element.innerHTML = month;
        });
        
    </script>
@endpush