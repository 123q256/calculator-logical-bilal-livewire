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
            <div class="grid grid-cols-3  gap-4">
                
                    <div class="space-y-2">
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
                    <div class="space-y-2">
                        <label for="day" class="text-blue font-s-14">{{$lang['2']}}</label>
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
                    <div class="space-y-2">
                        <label for="year" class="text-blue font-s-14">{{$lang['3']}}</label>
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
    
                    <div class="col-12  result p-3 radius-10 mt-3 overflow-auto">
                        @php
                        $remainingDaysAfterMonths = $detail['remainingDaysAfterMonths'];
                        $remainingDaysAfterWeeks = $detail['remainingDaysAfterWeeks'];
                    @endphp
                    <div class="text-center mb-3">
                        <p class="mb-2">{{$lang['4']}} <span class="currentYear">&nbsp;</span></p>
                        <p class="border radius-5 d-inline p-2 px-4 bg-sky font-s-25"><strong class="text-blue">
                            {{$detail['weeksRemaining']}} 
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
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2   gap-4">
                         
                            <div class="col-lg-6 p-1">
                                <div class="border radius-5 bg-[#F6FAFC] p-2">
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
                                <div class="border radius-5 bg-[#F6FAFC] p-2">
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
                                <div class="border radius-5 bg-[#F6FAFC] p-2">
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
                                <div class="border radius-5 bg-[#F6FAFC] p-2">
                                    <p>🕑 Hours</p>
                                    <p class="font-s-18"><strong>{{$detail['hoursRemaining']}} hours</strong></p>
                                </div>
                            </div>
                        </div>
                        <p class="text-center p-2">
                            How many weeks form <strong>{{$detail['now']}}</strong> left in this year ? The answer is  <strong>{{$detail['weeksRemaining']}}</strong>  @if($detail['weeksRemaining'] == 1)
                                Week
                            @else
                                Weeks are
                            @endif left in End of the year. 
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

    </script>
    <script>
        function formatDate(date) {
            return date.toISOString().split('T')[0];
        }
        const today = new Date();
        const currentYear = today.getFullYear();
        const lastDayOfYear = new Date(currentYear, 11, 31);
        const diffInMillis = lastDayOfYear - today;
        const diffInDays = Math.ceil(diffInMillis / (1000 * 60 * 60 * 24));
        const weeksLeft = Math.floor(diffInDays / 7);
        const daysLeft = diffInDays % 7;
        var currentweek = 52 - weeksLeft;

        document.querySelectorAll('.currentYear').forEach(element => {
            element.innerHTML = currentYear;
        });
        document.querySelectorAll('.weeksLeft').forEach(element => {
            element.innerHTML = weeksLeft;
        });
        document.querySelectorAll('.daysLeft').forEach(element => {
            element.innerHTML = daysLeft;
        });
        document.querySelectorAll('.todaydate').forEach(element => {
            element.innerHTML = today.toDateString();
        });
        document.querySelectorAll('.diffInDays').forEach(element => {
            element.innerHTML = diffInDays;
        });            
        document.querySelectorAll('.currentweek').forEach(element => {
            element.innerHTML = currentweek;
        });            
        var newDescription = `Find weeks left in this year. There are ${weeksLeft} weeks and ${daysLeft} days remaining in ${currentYear}. This amounts to a total of ${diffInDays} days left until the end of this year.`;
        let metaDescription = document.querySelector('meta[name="description"]');
        if (metaDescription) {
            metaDescription.setAttribute('content', newDescription);
        } 
    </script>
@endpush