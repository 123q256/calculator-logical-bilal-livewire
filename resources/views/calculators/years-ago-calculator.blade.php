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
                <div class="w-full  p-3 rounded-lg mt-3 overflow-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="p-1">
                            <div class="border rounded-lg bg-white p-2">
                                <p>📅 Date</p>
                                <p class="text-lg font-semibold"><strong>{{ $detail['t_date'] }}</strong></p>
                            </div>
                        </div>
                        <div class="p-1">
                            <div class="border rounded-lg bg-white p-2">
                                <p>🌞 Day</p>
                                <p class="text-lg font-semibold"><strong>{{ $detail['date_name'] }}</strong></p>
                            </div>
                        </div>
                        <div class="p-1">
                            <div class="border rounded-lg bg-white p-2">
                                <p>📅 Total Weeks</p>
                                <p class="text-lg font-semibold"><strong>{{ $detail['WeekOfYear'] }}</strong></p>
                            </div>
                        </div>
                        <div class="p-1">
                            <div class="border rounded-lg bg-white p-2">
                                <p>📅 Total Days</p>
                                <p class="text-lg font-semibold"><strong>{{ $detail['DayOfYear'] }}</strong></p>
                            </div>
                        </div>
                    </div>
                    <p class="text-center p-2">
                        What is <strong>{{ $request->number }}</strong> years ago? The answer is <strong>{{ $detail['date_name'] }}</strong>, <strong>{{ $detail['t_date'] }}</strong>. It can be converted into <strong>{{ $detail['WeekOfYear'] }}</strong> weeks. It is also equivalent to <strong>{{ $detail['diffInMonths'] }}</strong> months or during these periods, there are <strong>{{ $detail['DayOfYear'] }}</strong> days.
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

        function addWeeks(date, years) {
            const result = new Date(date);
            result.setFullYear(result.getFullYear() - years);
            return result;
        }


            const today = new Date(); // Note: Months are zero-based, so 9 is October
            

            const weeksContainer = document.getElementById('weeksContainer');
            const twoweeksContainer = document.getElementById('twoweeksContainer');
            for (let i = 1; i <= 50; i++) {
                const addedWeeksDate = addWeeks(today, i);
                const formattedDate = formatDateString(addedWeeksDate);
                const formattedDateS = formatDate(addedWeeksDate);
                const dateName = getDayName(addedWeeksDate);
                const weekElement = document.createElement('tr');
                weekElement.innerHTML = `
                    <tr>
                        <td class="bg-gray"><time datetime="P${i}W">${i} Years ago form today</time></td>
                        <td>
                            <time datetime="${formattedDateS}">${dateName}</time>,
                            <time datetime="${formattedDateS}">${formattedDate}</time>
                        </td>
                    </tr>
                `;
                weeksContainer.appendChild(weekElement);
            }


            const add5year = addWeeks(today, 5);
            const add10year = addWeeks(today, 10);

            document.getElementById('add5year').innerHTML = formatDateString(add5year);
            document.getElementById('add10year').innerHTML = formatDateString(add10year);

    </script>
@endpush