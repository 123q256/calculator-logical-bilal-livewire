<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
         <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="flex flex-wrap ">
                <label for="dob" class="label">{{$lang[106]}}:</label>
                <div class="w-full flex space-x-4">
                    <div class="w-full px-2">
                        <div class="w-full py-2">
                            <select name="year" id="year" onchange="updateDays('year', 'month', 'day')">
                                @for ($i = 1940; $i <= date('Y'); $i++)
                                    <option value="{{$i}}" {{ (isset(request()->year_sec) && request()->year_sec == $i) || (!isset(request()->year_sec) && $i == 1999) ? 'selected' : '' }}>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="w-full px-2">
                        <div class="w-full py-2">
                            <select name="month" id="month" onchange="updateDays('year', 'month', 'day')">
                                <option value="1" {{ isset($_POST['month']) && $_POST['month'] == '1' ? 'selected' : '' }}>January</option>
                                <option value="2" {{ isset($_POST['month']) && $_POST['month'] == '2' ? 'selected' : '' }}>February</option>
                                <option value="3" {{ isset($_POST['month']) && $_POST['month'] == '3' ? 'selected' : '' }}>March</option>
                                <option value="4" {{ isset($_POST['month']) && $_POST['month'] == '4' ? 'selected' : '' }}>April</option>
                                <option value="5" {{ isset($_POST['month']) && $_POST['month'] == '5' ? 'selected' : '' }}>May</option>
                                <option value="6" {{ isset($_POST['month']) && $_POST['month'] == '6' ? 'selected' : '' }}>June</option>
                                <option value="7" {{ isset($_POST['month']) && $_POST['month'] == '7' ? 'selected' : '' }}>July</option>
                                <option value="8" {{ isset($_POST['month']) && $_POST['month'] == '8' ? 'selected' : '' }}>August</option>
                                <option value="9" {{ isset($_POST['month']) && $_POST['month'] == '9' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ isset($_POST['month']) && $_POST['month'] == '10' ? 'selected' : '' }}>October</option>
                                <option value="11" {{ isset($_POST['month']) && $_POST['month'] == '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ isset($_POST['month']) && $_POST['month'] == '12' ? 'selected' : '' }}>December</option>
                            </select>
                        </div>
                    </div>
                    <div class="w-full px-2">
                        <div class="w-full py-2">
                            <select name="day" id="day" onchange="updateDays('year', 'month', 'day');">
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{$i}}" {{ isset(request()->day) && request()->day == $i ? 'selected' : '' }}>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <label for="e_date" class="label">{{$lang[107]}}:</label>
                <div class="{{ app()->getLocale() == 'id' ? 'hidden' : 'w-full flex space-x-4' }}">
                    <div class="w-full px-2">
                        <div class="w-full py-2">
                            <select name="year_sec" id="year_sec" onchange="updateDays('year_sec', 'month_sec', 'day_sec')">
                                @for ($i = 1940; $i <= date('Y'); $i++)
                                    <option value="{{ $i }}" {{ (isset(request()->year_sec) && request()->year_sec == $i) || (!isset(request()->year_sec) && $i == date('Y')) ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="w-full px-2">
                        <div class="w-full py-2">
                            <select name="month_sec" id="month_sec" onchange="updateDays('year_sec', 'month_sec', 'day_sec')">
                                @for ($i = 1; $i <= 12; $i++)
                                    @php
                                        $monthName = date('F', mktime(0, 0, 0, $i, 10));
                                    @endphp
                                    <option value="{{ $i }}" {{ (isset(request()->month_sec) && request()->month_sec == $i) || (!isset(request()->month_sec) && $i == date('n')) ? 'selected' : '' }}>
                                        {{ $monthName }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="w-full px-2">
                        <div class="w-full py-2">
                            <select name="day_sec" id="day_sec" onchange="updateDays('year_sec', 'month_sec', 'day_sec')">
                                @php
                                    $currentDay = date('j'); 
                                    $selectedDay = request()->has('day_sec') ? request()->get('day_sec') : $currentDay;
                                @endphp
                                @for ($i = 1; $i <= 31; $i++)
                                    <option value="{{ $i }}" {{ $i == $selectedDay ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
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
    {{-- result --}}
    @if(isset($detail))
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg lg:p-4 md:p-4 p-1 flex items-center justify-center">
                    <div class="col-12 rounded-lg mt-3">
                        <div class="flex flex-wrap my-2">
                            <div class="w-full lg:w-1/2 lg:pr-3 mb-4">
                                <div class="p-6 border rounded-xl text-center  bg-[#ffffff]">
                                    <p class="border-b-2 border-[#30804D] py-3 text-xl font-semibold text-[#30804D]">
                                        <strong>{{ $lang[60] }} :</strong>
                                    </p>
                                    <p class="py-4 text-lg font-medium text-gray-800">
                                        <span class="text-[#30804D] text-2xl font-bold">{{ $detail['age_years'][0] }}</span> {{ $lang['years'] }}
                                        <span class="text-[#30804D] text-2xl font-bold">{{ $detail['age_months'][0] }}</span> {{ $lang['months'] }}
                                        <span class="text-[#30804D] text-2xl font-bold">{{ $detail['age_days'][0] }}</span> {{ $lang['days'] }}
                                    </p>
                                </div>
                            </div>
                            <div class="w-full lg:w-1/2 lg:pl-3 lg:mt-0 md:mt-4 ">
                                <div class="p-6 border rounded-xl text-center  bg-[#ffffff]">
                                    <p class="border-b-2 border-[#30804D] py-3 text-xl font-semibold text-[#30804D]">
                                        <strong>{{ $lang[108] }} :</strong>
                                    </p>
                                    <p class="py-4 text-lg font-medium text-gray-800">
                                        {{ date('l, F d, Y', strtotime($detail['dates_array'][0])) }}
                                    </p>
                                </div>
                            </div>
                            <div class="w-full lg:w-12/12 mx-auto my-1  lg:p-6 py-2 rounded-lg ">
                                <table class="w-full  text-left rounded-lg overflow-hidden">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="bg-[#2845F5] text-white text-lg font-bold py-4 px-6 rounded-t-lg">
                                                {{ $lang['lived'] }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-b ">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang['90'] }}:</td>
                                            <td class="py-4 px-6 text-gray-900">
                                                <strong>{{ $detail['Total_years'][0] }}</strong> {{ $lang['years'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang['91'] }}:</td>
                                            <td class="py-4 px-6 text-gray-900">
                                                <strong>{{ $detail['Total_months'][0] }}</strong> {{ $lang['months'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang['92'] }}:</td>
                                            <td class="py-4 px-6 text-gray-900">
                                                <strong>{{ $detail['Total_weeks'][0] }}</strong> {{ $lang['weeks'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang['93'] }}:</td>
                                            <td class="py-4 px-6 text-gray-900">
                                                <strong>{{ $detail['Total_days'][0] }}</strong> {{ $lang['days'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang['94'] }}:</td>
                                            <td class="py-4 px-6 text-gray-900">
                                                <strong>{{ $detail['Total_hours'][0] }}</strong> {{ $lang['hours'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang['95'] }}:</td>
                                            <td class="py-4 px-6 text-gray-900">
                                                <strong>{{ $detail['Total_minuts'][0] }}</strong> {{ $lang['minute'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang['96'] }}:</td>
                                            <td class="py-4 px-6 text-gray-900">
                                                <strong>{{ $detail['Total_seconds'][0] }}</strong> {{ $lang['seconds'] }}
                                            </td>
                                        </tr>
                                        <?php
                                            $retirement_date = date('Y-m-d', strtotime($detail['dob_array'][0]. ' + 67 years'));
                                            $initialDate = new DateTime($retirement_date);
                                            list($to_saal, $to_mahina, $to_din) = explode("-", $detail['dates_array'][0]);
                                            $yearsToSubtract = $to_saal;
                                            $monthsToSubtract = $to_mahina;
                                            $daysToSubtract = $to_din;
                                            $interval = new DateInterval("P{$yearsToSubtract}Y{$monthsToSubtract}M{$daysToSubtract}D");
                                            $modifiedDate = $initialDate->sub($interval);
                                            $newDate = $modifiedDate->format('Y-m-d');
                                            $retirement_rem_years = $modifiedDate->format('y');
                                            $retirement_rem_months = $modifiedDate->format('m');
                                            $retirement_rem_days = $modifiedDate->format('d');
                                        ?>
                                        <tr class="bg-green-50 ">
                                            <td colspan="2" class="bg-[#2845F5] text-white text-lg font-bold py-4 px-6">
                                                {{ $lang['22'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang[23] }}:</td>
                                            <td class="py-4 px-6 text-gray-900 {{ app()->getLocale() == 'id' ? 'py-2 lg:py-4' : 'py-2' }}">
                                                {{ $detail['breath'][0] }} {{ $lang[24] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang[25] }}:</td>
                                            <td class="py-4 px-6 text-gray-900">
                                                {{ $detail['heartBeats'][0] }} {{ $lang[26] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang[29] }}:</td>
                                            <td class="py-4 px-6 text-gray-900">
                                                {{ $detail['laughed'][0] }} {{ $lang[26] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang[30] }}:</td>
                                            <td class="py-4 px-6 text-gray-900">
                                                {{ $detail['sleeping'][0] }} {{ $lang['years'] }}
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang[64] }}:</td>
                                            <td class="py-4 px-6 text-gray-900">
                                                {{ $detail['hair_length_m'][0] }} m
                                            </td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-4 px-6 font-medium text-gray-700">{{ $lang[65] }}:</td>
                                            <td class="py-4 px-6 text-gray-900">
                                                {{ $detail['nail_length_m'][0] }} m
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</form>

  