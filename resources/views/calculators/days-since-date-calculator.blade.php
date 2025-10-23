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
    .content table tr td:nth-child(1){
        background-color: var(--bg-gray);
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
                    
                    
                    <div class="grid grid-cols-3  gap-4">
                        <div class="space-y-2 ">
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
                                        optionsList($val,$name,isset($_POST['month'])?$_POST['month']:date('m',strtotime('-1 Month')));
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="space-y-2">
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
                        <div class="space-y-2">
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
                    <div class="grid grid-cols-3  gap-4">
                        <div class="space-y-2 ">
                            <label for="month1" class="text-blue font-s-14">{{$lang['2']}}</label>
                            <div class="w-100 py-2">
                                <select name="month1" id="month1" class="input" onchange="updateDays('year1', 'month1', 'day1')">
                                    @php
                                        $name = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                                        $val = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"];
                                        optionsList($val,$name,isset($_POST['month1'])?$_POST['month1']: date('m') );
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="space-y-2">
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
                        <div class="space-y-2">
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
                        @php
                            $holidays = $detail['holidays'];
                            $totaldays = $detail['totaldays'];
                            $workingDays = $detail['workingDays'];
                        @endphp
                            <p class="mb-2 text-center">Days Since the Start Date</p>
                            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2   gap-4">
                            <div class="space-y-2">
                                <div class="border radius-10 bg-sky p-2">
                                    <p>📅 Total Days</p>
                                    <p class="font-s-25"><strong class="text-blue">{{$totaldays > 0 ? $totaldays . ' Day' . ($totaldays == 1 ? '' : 's') : ''}} 
                                       </strong></p>
                                    @if ($totaldays == 0)
                                        <p class="font-s-18"><strong class="text-blue">0 Days</strong></p>
                                    @endif
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="border radius-10 bg-sky p-2">
                                    <p>📅 Business Days</p>
                                    <p class="font-s-25"><strong class="text-blue">{{$workingDays > 0 ? $workingDays . ' Day' . ($workingDays == 1 ? '' : 's') : ''}} 
                                       </strong></p>
                                    @if ($workingDays == 0)
                                        <p class="font-s-18"><strong class="text-blue">0 Days</strong></p>
                                    @endif
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="border radius-10 bg-sky p-2">
                                    <p>📅 Weekend Days</p>
                                    <p class="font-s-25"><strong class="text-blue">{{$holidays > 0 ? $holidays . ' Day' . ($holidays == 1 ? '' : 's') : ''}} 
                                       </strong></p>
                                    @if ($holidays == 0)
                                        <p class="font-s-18"><strong class="text-blue">0 Days</strong></p>
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

        function updateYearSecOptions() {
            var yearSelect = document.getElementById('year');
            var yearSecSelect = document.getElementById('year1');
            
            // Get the selected year value
            var selectedYear = parseInt(yearSelect.value);
            var currentYear = new Date().getFullYear();
            yearSecSelect.innerHTML = '';
            for (var i = selectedYear ; i <= 2050; i++) {
                var option = document.createElement('option');
                option.value = i;
                option.text = i;
                yearSecSelect.appendChild(option);
            }
            if (currentYear > selectedYear) {
                yearSecSelect.value = currentYear;
            } else {
                // Select the first available option if current year is not greater
                yearSecSelect.selectedIndex = 0;
            }
        }

        window.onload = function() {
            updateYearSecOptions();
            document.getElementById('year').addEventListener('change', updateYearSecOptions);
        }
        document.addEventListener('DOMContentLoaded', function() {
            updateDays('year', 'month', 'day');
            updateDays('year1', 'month1', 'day1');
        });

        
    </script>
@endpush