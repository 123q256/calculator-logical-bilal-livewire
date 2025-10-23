<style>
    .bg-orange{
        background: #2845F5;
        color: white;
    }
    .cl-orange{
        color: orange;
    }
    .days_box .col:hover{
        background-color: #2845F5;
        color: white;
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
                    <div class="w-full bg-light-blue result p-3 rounded-lg mt-3 overflow-auto">
                        <div class="flex flex-wrap">
                            <div class="lg:w-1/2 w-full p-1">
                                <div class="border rounded-md bg-white p-2">
                                    <p>📅 Date</p>
                                    <p class="text-lg font-bold">{{$detail['t_date']}}</p>
                                </div>
                            </div>
                            <div class="lg:w-1/2 w-full p-1">
                                <div class="border rounded-md bg-white p-2">
                                    <p>🌞 Day</p>
                                    <p class="text-lg font-bold">{{$detail['date_name']}}</p>
                                </div>
                            </div>
                            <div class="lg:w-1/2 w-full p-1">
                                <div class="border rounded-md bg-white p-2">
                                    <p>📅 Weeks</p>
                                    <p class="text-lg font-bold">{{$detail['currentWeekOfYear']}} / {{$detail['weeksInYear']}}</p>
                                </div>
                            </div>
                            <div class="lg:w-1/2 w-full p-1">
                                <div class="border rounded-md bg-white p-2">
                                    <p>📅 Year</p>
                                    <p class="text-lg font-bold">{{$detail['currentDayOfYear']}} / {{$detail['daysInYear']}}</p>
                                </div>
                            </div>
                            <p class="w-full text-center p-2">
                                What is <strong>{{$request->number}}</strong> weeks from now? The answer is <strong>{{$detail['date_name']}}</strong>, <strong>{{$detail['t_date']}}</strong>. It is week <strong>{{$detail['currentWeekOfYear']}}</strong> of the total {{$detail['weeksInYear']}} weeks of the year. It also marks day <strong>{{$detail['currentDayOfYear']}}</strong> out of <strong>{{$detail['daysInYear']}}</strong> days of the year.
                            </p>
                        </div>
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
          

            const today = new Date(); // Note: Months are zero-based, so 9 is 
            const weeksContainer = document.getElementById('weeksContainer');
            const twoweeksContainer = document.getElementById('twoweeksContainer');
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
                result.setDate(result.getDate() + weeks * 7);
                return result;
            }
            for (let i = 1; i <= 25; i++) {
                const addedWeeksDate = addWeeks(today, i);
                const formattedDate = formatDateString(addedWeeksDate);
                const formattedDateS = formatDate(addedWeeksDate);
                const dateName = getDayName(addedWeeksDate);
                const weekElement = document.createElement('tr');
                weekElement.innerHTML = `
                    <tr>
                        <td class="bg-gray"><time datetime="P${i}W">${i} Weeks</time></td>
                        <td>
                            <time datetime="${formattedDateS}">${dateName}</time>,
                            <time datetime="${formattedDateS}">${formattedDate}</time>
                        </td>
                    </tr>
                `;
                weeksContainer.appendChild(weekElement);
            }
            for (let i = 26; i <= 50; i++) {
                const addedWeeksDate = addWeeks(today, i);
                const formattedDate = formatDateString(addedWeeksDate);
                const formattedDateS = formatDate(addedWeeksDate);
                const dateName = getDayName(addedWeeksDate);


                const weekElement = document.createElement('tr');
                weekElement.innerHTML = `
                    <tr>
                        <td class="bg-gray"><time datetime="P${i}W">${i} Weeks</time></td>
                        <td>
                            <time datetime="${formattedDateS}">${dateName}</time>,
                            <time datetime="${formattedDateS}">${formattedDate}</time>
                        </td>
                    </tr>
                `;
                twoweeksContainer.appendChild(weekElement);
            }
            const addThreeWeeks = addWeeks(today, 3);
            const addFourWeeks = addWeeks(today, 4);
            const addSixWeeks = addWeeks(today, 6);
            const addEightWeeks = addWeeks(today, 8);
            const addTenWeeks = addWeeks(today, 10);
            const addtwlWeeks = addWeeks(today, 12);

            document.querySelectorAll('.todaydate').forEach(element => {
                element.innerHTML = formatDate(today);
            });
            document.getElementById('addThreeWeeks').innerHTML = formatDate(addThreeWeeks);

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