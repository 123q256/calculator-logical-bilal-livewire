<style>
    .bg-orange{
        background: #2845F5;
        color: white;
    }
    .cl-orange{
        color: orange;
    }
    .mb_3{
        margin-bottom: -5px; 
    }
    .days_box .col:hover{
        background-color: #2845F5;
        color: white;
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
    .border-bb {
        border-bottom: 1px solid black !important;
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
         <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-1  mt-5 lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="px-2 lg:px-0">
                    <div class="w-full mx-auto">
                        <label for="next" class="text-sm">{{ $lang['1'] }}</label>
                        <div class="grid grid-cols-6 text-center border rounded-md mt-2 bg-white days_box">
                            <p class="col cursor-pointer border-r py-2">4</p>
                            <p class="col cursor-pointer border-r py-2">8</p>
                            <p class="col cursor-pointer border-r py-2">12</p>
                            <p class="col cursor-pointer border-r py-2">16</p>
                            <p class="col cursor-pointer border-r py-2">20</p>
                            <p class="col cursor-pointer border-r py-2">24</p>
                        </div> 
                    </div>
                </div>
                <div class="px-2 lg:px-0">
                    <input type="hidden" name="selected_value" id="selected_value" value="{{ isset($request->number) ? $request->number : '' }}" />
                    <div class="space-y-2 {{isset($request->stype) && $request->stype == 'date' ? 'hidden' : ''}} inputshow">
                        <label for="number" class="text-sm">&nbsp;</label>
                        <input type="number" name="number" id="number" class="input" value="{{ isset($request->number) ? $request->number : '' }}" aria-label="input" autocomplete="off" />
                    </div>
                </div>
            </div>
         </div>
         <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-1  mt-5 lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="date-now space-y-2 relative">
                    <div class="flex justify-between items-center">
                        <label for="s_date_duration" class="font-s-14 text-blue">{{$lang['2']}}</label>
                        <span class="font-s-14 text-end text-blue text-decoration-underline cursor-pointer now">{{isset($lang['now']) ? $lang['now'] : 'Now'}}</span>
                    </div>
                    <div class="w-full py-2">
                        <input type="date" name="current" id="current" class="input" value="{{ isset($request->current) ? $request->current : date('Y-m-d') }}" aria-label="input" />
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
                    <div class="col-12 bg-light-blue result p-3 radius-10 mt-3 overflow-auto">
                        <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                            <div class="col-lg-6 p-1">
                                <div class="border radius-5 bg-sky p-2">
                                    <p>📅 Date</p>
                                    <p class="font-s-18"><strong>{{$detail['t_date']}}</strong></p>
                                </div>
                            </div>
                            <div class="col-lg-6 p-1">
                                <div class="border radius-5 bg-sky p-2">
                                    <p>🌞 Day</p>
                                    <p class="font-s-18"><strong>{{$detail['date_name']}}</strong></p>
                                </div>
                            </div>
                            <div class="col-lg-6 p-1">
                                <div class="border radius-5 bg-sky p-2">
                                    <p>📅 Weeks</p>
                                    <p class="font-s-18"><strong>{{$detail['currentWeekOfYear']}} / {{$detail['weeksInYear']}}</strong></p>
                                </div>
                            </div>
                            <div class="col-lg-6 p-1">
                                <div class="border radius-5 bg-sky p-2">
                                    <p>📅 Year</p>
                                    <p class="font-s-18"><strong>{{$detail['currentDayOfYear']}} / {{$detail['daysInYear']}}</strong></p>
                                </div>
                            </div>
                        </div>
                        <p class="text-center p-2">
                            What is <strong>{{$request->number}}</strong>  weeks from now? The answer is  <strong>{{$detail['date_name']}}</strong>,  <strong>{{$detail['t_date']}}</strong>. It is the week  <strong>{{$detail['currentWeekOfYear']}}</strong> of the total {{$detail['weeksInYear']}} weeks of the year. It also marks the day  <strong>{{$detail['currentDayOfYear']}}</strong> out of  <strong>{{$detail['daysInYear']}}</strong> days of the year.
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>

    @endisset
</form>
@push('calculatorJS')
    <script>

document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll('.now').forEach(label => {
                    label.addEventListener('click', function() {
                        const now = new Date();
                        const year = now.getFullYear();
                        const month = String(now.getMonth() + 1).padStart(2, '0');
                        const date = String(now.getDate()).padStart(2, '0');
                        const formattedDate = `${year}-${month}-${date}`;
                        const dateInput = label.closest('.date-now').querySelector('input[type="date"]');
                        if (dateInput) {
                            dateInput.value = formattedDate;
                        }
                    });
                });
            });


        document.addEventListener('DOMContentLoaded', function() {
            var daysBox = document.querySelectorAll('.days_box p');
            var numberInput = document.getElementById('number');
            var selectedValueInput = document.getElementById('selected_value');
            
            var selectedValue = selectedValueInput.value.trim();
            if (selectedValue) {
                daysBox.forEach(function(p) {
                    if (p.innerHTML.trim() === selectedValue) {
                        p.classList.add('bg-orange');
                    }
                });
            }

            daysBox.forEach(function(p) {
                p.addEventListener('click', function() {
                    daysBox.forEach(function(p) {
                        p.classList.remove('bg-orange');
                    });
                    var value = this.innerHTML.trim();
                    this.classList.add('bg-orange');
                    numberInput.value = value;
                    selectedValueInput.value = value; // Update the hidden input value
                });
            });
        });

        // document.querySelectorAll('.now').forEach(label => {
        //     label.addEventListener('click', function() {
        //         const now = new Date();
        //         const year = now.getFullYear();
        //         const month = String(now.getMonth() + 1).padStart(2, '0');
        //         const date = String(now.getDate()).padStart(2, '0');
        //         const formattedDate = `${year}-${month}-${date}`;
        //         const dateInput = label.closest('.col-lg-5').querySelector('input[type="date"]');
        //         if (dateInput) {
        //             dateInput.value = formattedDate;
        //         }
        //     });
        // });

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

        function addMonths(date, months) {
            const result = new Date(date);
            result.setMonth(result.getMonth() + months);
            return result;
        }

        const today = new Date();

        const weeksContainer = document.getElementById('weeksContainer');
        for (let i = 1; i <= 50; i++) {
            const addedMonthsDate = addMonths(today, i);
            const formattedDate = formatDateString(addedMonthsDate);
            const formattedDateS = formatDate(addedMonthsDate);
            const dateName = getDayName(addedMonthsDate);
            const monthElement = document.createElement('tr');
            monthElement.innerHTML = `
                <tr>
                    <td class="bg-white border-bb hover:bg-gray-50 p-2 border"><time datetime="P${i}M">${i} Months from today</time></td>
                    <td class="bg-white border-bb hover:bg-gray-50 p-2 border">
                        <time datetime="${formattedDateS}">${dateName}</time>,
                        <time datetime="${formattedDateS}">${formattedDate}</time>
                    </td>
                </tr>
            `;
            weeksContainer.appendChild(monthElement);
        }
        function formatString(date) {
            const options = { weekday: 'long' , year: 'numeric', month: 'long', day: 'numeric' };
            return date.toLocaleDateString('en-US', options);
        }

        const addThreeMonths = addMonths(today, 3);
        const addFourMonths = addMonths(today, 4);
        const addSixMonths = addMonths(today, 6);
        const addNineMonths = addMonths(today, 9);
        const addEighteenMonths = addMonths(today, 18);

        // 18 months
        document.getElementById('addEighteenMonths').innerHTML = formatString(addEighteenMonths);
        // 3 months
        document.getElementById('addThreeMonths').innerHTML = formatString(addThreeMonths);
        // 4 months
        document.getElementById('addFourMonths').innerHTML = formatString(addFourMonths);
        // 6 months
        document.getElementById('addSixMonths').innerHTML = formatString(addSixMonths);
        // 9 months
        document.getElementById('addNineMonths').innerHTML = formatString(addNineMonths);

        document.querySelectorAll('.todaydate').forEach(element => {
            element.innerHTML = formatDate(today);
        });
    </script>
@endpush