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
    <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
        <div class="grid grid-cols-1   gap-4">
            <div class="space-y-2">
                <label for="number" class="font-s-14 ">{{$lang['1']}}:</label>
                <div class="w-100 pt-1 pb-2">
                    <input type="number" name="number" id="number" class="input" value="{{ isset($request->number) ? $request->number : '' }}" aria-label="input" autocomplete="off" />
                </div>
            </div>
            <div class="space-y-2 datetime">
                <div class="flex justify-between">
                    <label for="current" class="font-s-14 ">{{$lang['2']}}:</label>
                    <span class="font-s-14 text-end text-blue text-decoration-underline cursor-pointer now">{{isset($lang['now']) ? $lang['now'] : 'Now'}}</span>
                </div>                      
                <div class="w-100 py-2">
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
                        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-2   gap-4">
                            <div class="col-lg-6 p-1">
                                <div class="border radius-5 bg-[#F6FAFC] p-2">
                                    <p>📅 Date</p>
                                    <p class="font-s-18"><strong>{{$detail['t_date']}}</strong></p>
                                </div>
                            </div>
                            <div class="col-lg-6 p-1">
                                <div class="border radius-5 bg-[#F6FAFC] p-2">
                                    <p>🌞 Day</p>
                                    <p class="font-s-18"><strong>{{$detail['date_name']}}</strong></p>
                                </div>
                            </div>
                            <div class="col-lg-6 p-1">
                                <div class="border radius-5 bg-[#F6FAFC] p-2">
                                    <p>📅 Weeks</p>
                                    <p class="font-s-18"><strong>{{$detail['currentWeekOfYear']}} / {{$detail['weeksInYear']}}</strong></p>
                                </div>
                            </div>
                            <div class="col-lg-6 p-1">
                                <div class="border radius-5 bg-[#F6FAFC] p-2">
                                    <p>📅 Year</p>
                                    <p class="font-s-18"><strong>{{$detail['currentDayOfYear']}} / {{$detail['daysInYear']}}</strong></p>
                                </div>
                            </div>
                        </div>
                        <p class="text-center p-2">
                            What is <strong>{{$request->number}}</strong>  days ago? The answer is  <strong>{{$detail['date_name']}}</strong>,  <strong>{{$detail['t_date']}}</strong>. It is the week  <strong>{{$detail['currentWeekOfYear']}}</strong> of the total {{$detail['weeksInYear']}} weeks of the year. It also marks the day  <strong>{{$detail['currentDayOfYear']}}</strong> out of  <strong>{{$detail['daysInYear']}}</strong> days of the year.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
      document.querySelectorAll('.now').forEach(label => {
            label.addEventListener('click', function() {
                const now = new Date();
                const year = now.getFullYear();
                const month = String(now.getMonth() + 1).padStart(2, '0');
                const date = String(now.getDate()).padStart(2, '0');
                const formattedDate = `${year}-${month}-${date}`;
                const dateInput = label.closest('.datetime').querySelector('input[type="date"]');
                if (dateInput) {
                    dateInput.value = formattedDate;
                }
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
        function addWeeks(date, days) {
            const result = new Date(date);
            result.setDate(result.getDate() - days);
            return result;
        }

        const today = new Date(); 
        
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
                    <td class="bg-white border-bb hover:bg-gray-50 p-2 border"><time datetime="P${i}W">${i} days ago</time></td>
                    <td class="bg-white border-bb hover:bg-gray-50 p-2 border">
                        <time datetime="${formattedDateS}">${dateName}</time>
                        <time datetime="${formattedDateS}">${formattedDate}</time>
                    </td>
                </tr>
            `;
            weeksContainer.appendChild(weekElement);
        }

        const Sixty = addWeeks(today, 60);
        const fortyfive = addWeeks(today, 45);
        const therty = addWeeks(today, 30);
        const ten = addWeeks(today, 10);

        document.querySelectorAll('.todaydate').forEach(element => {
            element.innerHTML = formatDateString(today);
        });
        // 4 week
        document.getElementById('Sixty').innerHTML = formatDateString(Sixty);
        // 6 week
        document.getElementById('fortyfive').innerHTML = formatDateString(fortyfive);
        // 8 week
        document.getElementById('therty').innerHTML = formatDateString(therty);
        // 10 week
        document.getElementById('ten').innerHTML = formatDateString(ten);
    </script>
@endpush