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
    .col:hover{
        background-color: #2845F5;
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
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-1  mt-5 lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="px-2 lg:px-0">
                    <div class="w-full mx-auto">
                        <label for="next" class="text-sm">{{ $lang['1'] }}</label>
                        <div class="grid grid-cols-7 text-center border rounded-md mt-2 bg-white days_box">
                            <p class="col cursor-pointer border-r py-2">7</p>
                            <p class="col cursor-pointer border-r py-2">14</p>
                            <p class="col cursor-pointer border-r py-2">21</p>
                            <p class="col cursor-pointer border-r py-2">28</p>
                            <p class="col cursor-pointer border-r py-2">45</p>
                            <p class="col cursor-pointer border-r py-2">60</p>
                            <p class="col cursor-pointer py-2">90</p>
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
                        <label for="s_date_duration" class="text-sm">{{$lang['2']}}:</label>
                        <span class="text-sm text-right text-[#2845F5] underline cursor-pointer now">{{isset($lang['now']) ? $lang['now'] : 'Now'}}</span>
                    </div>
                    <div class="w-full py-2">
                        <input type="date" name="current" id="current" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#38A169]" value="{{ isset($request->current) ? $request->current : date('Y-m-d') }}" aria-label="input" />
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
                    <div class="w-full bg-light-blue p-3 rounded-lg mt-3 overflow-auto">
                        <div class="flex flex-col">
                            <div class="w-full">
                                <div class="text-center">
                                    <p class="text-xl bg-[#2845F5] text-white px-3 py-2 rounded-lg inline-block my-3">
                                        <strong class="text-blue">
                                            {{$detail['date_name']}} 
                                            <img src="{{asset('images/r_days.png')}}" alt="Calendar" class="inline mb-1 w-7 h-7"> 
                                            {{$detail['t_date']}}
                                        </strong>
                                    </p>
                                </div>
                                <div class="lg:w-7/12 w-full mx-auto mt-2">
                                    <table class="w-full">
                                        <tr>
                                            <td class="border-b border-dark py-2 w-1/3">
                                                <img src="{{asset('images/days_usa.svg')}}" class="w-1/4" alt="USA Flag">
                                            </td>
                                            <td class="border-b border-dark py-2 text-right">
                                                {{$detail['t_date']}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b border-dark py-2">
                                                <img src="{{asset('images/days_uk.svg')}}" class="w-1/4" alt="UK Flag">
                                            </td>
                                            <td class="border-b border-dark py-2 text-right">
                                                {{$detail['uk_date']}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b border-dark py-2">
                                                <img src="{{asset('images/days_usa.svg')}}" class="w-1/4" alt="USA Flag">
                                            </td>
                                            <td class="border-b border-dark py-2 text-right">
                                                {{$detail['usa_num']}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b border-dark py-2">
                                                <img src="{{asset('images/days_uk.svg')}}" class="w-1/4" alt="UK Flag">
                                            </td>
                                            <td class="border-b border-dark py-2 text-right">
                                                {{$detail['number']}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">
                                                <span class="border rounded-md p-1 mb-1 text-sm">ISO</span>
                                            </td>
                                            <td class="py-2 text-right">
                                                {{$detail['iso']}}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    @endisset
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

            function addDays(date, days) {
                const result = new Date(date);
                result.setDate(result.getDate() + days);
                return result;
            }
            function formatDate(date) {
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                return date.toLocaleDateString('en-US', options);
            }
            const today = new Date(); // Note: Months are zero-based, so 9 is October
            const add7days = addDays(today, 7);
            const add14days = addDays(today, 14);
            const add21days = addDays(today, 21);
            const add28days = addDays(today, 28);
            const add30days = addDays(today, 30);
            const add45days = addDays(today, 45);
            const add60days = addDays(today, 60);
            const add90days = addDays(today, 90);

            document.querySelectorAll('.todaydate').forEach(element => {
                element.innerHTML = formatDate(today);
            });

            document.getElementById('add7days').innerHTML = formatDate(add7days);
            document.getElementById('add14days').innerHTML = formatDate(add14days);
            document.getElementById('add21days').innerHTML = formatDate(add21days);
            document.getElementById('add28days').innerHTML = formatDate(add28days);
            document.getElementById('add30days').innerHTML = formatDate(add30days);
            document.getElementById('add45days').innerHTML = formatDate(add45days);
            document.getElementById('add60days').innerHTML = formatDate(add60days);
            document.getElementById('add90days').innerHTML = formatDate(add90days);

        
         


            // const today = new Date(); 
            const DaysContainer = document.getElementById('DaysContainer');
            const DaysTwoContainer = document.getElementById('DaysTwoContainer');
            const DaysThreeContainer = document.getElementById('DaysThreeContainer');

            function formatDates(date) {
                const options = { year: '2-digit', month: '2-digit', day: '2-digit' };
                return date.toLocaleDateString('en-US', options);
            }

            function formatDateString(date) {
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                return date.toLocaleDateString('en-US', options);
            }
            function getDayName(date, locale)
            {
                var date = new Date(date);
                return date.toLocaleDateString(locale, { weekday: 'long' });        
            }

            for (let i = 1; i <= 20; i++) {
                const addedDaysDate = addDays(today, i);
                const formattedDateS = formatDates(addedDaysDate);
                const formattedDate = formatDateString(addedDaysDate);
                const dateName = getDayName(addedDaysDate);

                const DayElement = document.createElement('tr');
                DayElement.innerHTML = `
                    <tr>
                        <td class="bg-gray">${i} days</td>
                        <td>${dateName}</td> 
                        <td>${formattedDate}</td> 
                        <td>${formattedDateS}</td> 
                    </tr>
                `;
                DaysContainer.appendChild(DayElement);
            }

            for (let i = 20; i <= 40; i++) {
                const addedDaysDate = addDays(today, i);
                const formattedDateS = formatDates(addedDaysDate);
                const formattedDate = formatDateString(addedDaysDate);
                const dateName = getDayName(addedDaysDate);

                const DayElement = document.createElement('tr');
                DayElement.innerHTML = `
                    <tr>
                        <td class="bg-gray">${i} days</td>
                        <td>${dateName}</td> 
                        <td>${formattedDate}</td> 
                        <td>${formattedDateS}</td> 
                    </tr>
                `;
                DaysTwoContainer.appendChild(DayElement);
            }

            for (let i = 40; i <= 60; i++) {
                const addedDaysDate = addDays(today, i);
                const formattedDateS = formatDates(addedDaysDate);
                const formattedDate = formatDateString(addedDaysDate);
                const dateName = getDayName(addedDaysDate);

                const DayElement = document.createElement('tr');
                DayElement.innerHTML = `
                    <tr>
                        <td class="bg-gray">${i} days</td>
                        <td>${dateName}</td> 
                        <td>${formattedDate}</td> 
                        <td>${formattedDateS}</td> 
                    </tr>
                `;
                DaysThreeContainer.appendChild(DayElement);
            }
        </script>
    @endpush
</form>