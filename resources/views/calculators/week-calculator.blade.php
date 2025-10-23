<style>
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
    #current{
        padding-right: 8px;
    }
    #current::-webkit-calendar-picker-indicator{
        cursor: pointer;
        font-size: 20px;
    }
    #next{
        padding-right: 8px;
    }
    #next::-webkit-calendar-picker-indicator{
        cursor: pointer;
        font-size: 20px;
    }

</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
            @php
                $request = request();
                $nextYear = date('Y-m-d', strtotime('+1 month'));
                $selectedDays = request()->has('weekDay') ? request()->input('weekDay') : [''];
            @endphp
         
         <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
        <div class="grid grid-cols-1 gap-4">
            <div class="space-y-2">
                <div class="flex items-center space-x-4">
                    <!-- Radio Button 1 -->
                    <input type="radio" name="stype" id="s_date" value="s_date" checked class="cursor-pointer" 
                           {{ isset($_POST['stype']) && $_POST['stype'] === 's_date' ? 'checked' : '' }}>
                    <label for="s_date" class="text-sm ">{{ $lang['4'] }}</label>
                    
                    <!-- Radio Button 2 -->
                    <input type="radio" name="stype" id="e_date" value="e_date" class="cursor-pointer" 
                           {{ isset($_POST['stype']) && $_POST['stype'] === 'e_date' ? 'checked' : '' }}>
                    <label for="e_date" class="text-sm ">{{ $lang['5'] }}</label>
                    
                    <!-- Radio Button 3 -->
                    <input type="radio" name="stype" id="date" value="date" class="cursor-pointer" 
                           {{ isset($_POST['stype']) && $_POST['stype'] === 'date' ? 'checked' : '' }}>
                    <label for="date" class="text-sm ">{{ $lang['6'] }}</label>
                </div>
            </div>
        </div>
        


            <div class="grid grid-cols-5 lg:grid-cols-5 md:grid-cols-5 mt-4 gap-2 items-center">
                <div class="space-y-1 col-span-2">
                    <label for="current" class="text-sm ">{{ $lang['1'] }}</label>
                    <div class="w-full py-2">
                        <input type="date" name="current" id="current" class="w-full px-3 py-2 border rounded-md cursor-pointer" 
                               value="{{ isset($request->current) ? $request->current : date('Y-m-d') }}" aria-label="input" />
                    </div>
                </div>
                <!-- Centered Arrow -->
                <p class="text-lg mt-3 col-span-1 text-center symble"> ➕ </p>
            
                <div class="space-y-1 col-span-2 dateshow {{ isset($request->stype) && $request->stype == 'date' ? 'block' : 'hidden' }}">
                    <label for="next" class="text-sm ">{{ $lang['2'] }}</label>
                    <div class="w-full py-2">
                        <input type="date" name="next" id="next" class="w-full px-3 py-2 border rounded-md cursor-pointer" 
                               value="{{ isset($request->next) ? $request->next : $nextYear }}" aria-label="input" />
                    </div>
                </div>
                <div class="space-y-1 col-span-2 {{ isset($request->stype) && $request->stype == 'date' ? 'hidden' : '' }} inputshow">
                    <label for="next" class="text-sm ">{{ $lang['3'] }}</label>
                    <div class="w-full py-2">
                        <input type="number" name="number" id="number" class="w-full px-3 py-2 border rounded-md cursor-pointer" 
                               value="{{ isset($request->number) ? $request->number : '' }}" aria-label="input" autocomplete="off" />
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
                <div class="w-full  p-6 rounded-lg mt-6 overflow-auto">
                    <div class="grid grid-cols-1">
                        <div class="w-full">
                            @if($request->stype == 'date')
                                <div class="text-center">
                                    <p class="text-4xl bg-[#2845F5] px-4 py-3 rounded-lg inline-block my-6">
                                        <strong class="text-white">{{ $detail['weeks'] }}<span class="text-xl"> Weeks</span></strong>
                                    </p>
                                </div>
                            @elseif($request->stype == 's_date')
                                <div class="text-center">
                                    <p class="text-4xl bg-[#2845F5] px-4 py-3 rounded-lg inline-block my-6">
                                        <strong class="text-white">{{ $detail['adding'] }}</strong>
                                    </p>
                                </div>
                            @else
                                <div class="text-center">
                                    <p class="text-4xl bg-[#2845F5] px-4 py-3 rounded-lg inline-block my-6">
                                        <strong class="text-white">{{ $detail['subbtract'] }}</strong>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('s_date').addEventListener('click', function() {
                document.querySelector('.inputshow').style.display = 'block';
                document.querySelector('.dateshow').style.display = 'none';
                document.querySelector('.symble').innerHTML = '➕';
            });
            document.getElementById('e_date').addEventListener('click', function() {
                document.querySelector('.inputshow').style.display = 'block';
                document.querySelector('.dateshow').style.display = 'none';
                document.querySelector('.symble').innerHTML = '➖';
                
            });
            document.getElementById('date').addEventListener('click', function() {
                document.querySelector('.inputshow').style.display = 'none';
                document.querySelector('.dateshow').style.display = 'block';
                document.querySelector('.symble').innerHTML = '⇢';
            });

            const today = new Date();

            function formatDate(date) {
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                return date.toLocaleDateString('en-US', options);
            }

            function addWeeks(date, weeks) {
                const result = new Date(date);
                result.setDate(result.getDate() + weeks * 7);
                return result;
            }

            function formatDates(date) {
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
            // Container to hold the results

            const weeksContainer = document.getElementById('weeksContainer');
            const twoweeksContainer = document.getElementById('twoweeksContainer');
            for (let i = 1; i <= 25; i++) {
                const addedWeeksDate = addWeeks(today, i);
                const formattedDate = formatDateString(addedWeeksDate);
                const formattedDateS = formatDates(addedWeeksDate);
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
                const formattedDateS = formatDates(addedWeeksDate);
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


            const addTwoWeeks = addWeeks(today, 2);
            const addFourWeeks = addWeeks(today, 4);
            const addSixWeeks = addWeeks(today, 6);
            const addEightWeeks = addWeeks(today, 8);
            const addTenWeeks = addWeeks(today, 10);

            document.querySelectorAll('.todaydate').forEach(element => {
                element.innerHTML = formatDate(today);
            });

            // 2 week
            document.getElementById('addTwoWeeks').innerHTML = formatDate(addTwoWeeks);
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
</form>