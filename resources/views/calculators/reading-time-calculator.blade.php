<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">

            <p>{{ $lang['1'] }}</p>
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="reading_speed" class="font-s-14 text-blue">{{ $lang['2'] }}:</label>
                    <select name="reading_speed" id="reading_speed" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                {{ $arr2[$index] }}
                            </option>
                        @php
                            }}
                            $name = [$lang['11'], $lang['12'], $lang['13']];
                                    $val = ["0.25", "0.50", "1"];
                            optionsList($val,$name,isset($_POST['reading_speed'])?$_POST['reading_speed']:'0.50');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="read_pages" class="text-blue text-sm">{{ $lang['3'] }}:</label>
                    <div class="flex flex-wrap">
                        <div class="lg:w-2/3 p relative pr-1">
                            <input type="number" step="any" name="read_pages" id="read_pages" value="{{ isset($_POST['read_pages']) ? $_POST['read_pages'] : '0.50' }}" class="input w-full" aria-label="input"/>
                            <span class="absolute right-0 top-1/2 transform -translate-y-1/2 text-blue px-2">pgs</span>
                        </div>
                        <div class="lg:w-1/3 ">
                            <select name="book_unit" id="book_unit" class="input w-full">
                                @php
                                    $name = [$lang['14'], $lang['15']];
                                    $val = ["min", "hr"];
                                    optionsList($val, $name, isset($_POST['book_unit']) ? $_POST['book_unit'] : 'min');
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="space-y-2">
                    <label for="book_leng" class="font-s-14 text-blue">{!! $lang['4'] !!}:</label>
                    <input type="number" step="any" name="book_leng" id="book_leng" class="input" aria-label="input"  value="{{ isset($_POST['book_leng'])?$_POST['book_leng']:'1' }}" />
                </div>
                <div class="space-y-2">
                    <label for="total_unit" class="font-s-14 text-blue">{{ $lang['5'] }} ({{ $lang['6'] }}):</label>
                    <select name="total_unit" id="total_unit" class="input">
                        @php
                            $name = [$lang['14'], $lang['15'], $lang['23']];
                            $val = ["min", "hr", "min/hr"];
                            optionsList($val,$name,isset($_POST['total_unit'])?$_POST['total_unit']:'min');
                        @endphp
                    </select>
                </div>
            </div>
            <p class="mt-4" >{{ $lang['7'] }}</p>
            <div class="grid grid-cols-1 mt-4  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2">
                    <label for="daily_reading" class="text-blue text-sm">{{ $lang['8'] }}:</label>
                    <div class="flex flex-wrap">
                        <div class="lg:w-2/3 relative pr-1">
                            <input type="number" step="any" name="daily_reading" id="daily_reading" value="{{ isset($_POST['daily_reading']) ? $_POST['daily_reading'] : '8' }}" class="input w-full" aria-label="input"/>
                            <span class="absolute right-0 top-1/2 transform -translate-y-1/2 text-blue px-2">pgs</span>
                        </div>
                        <div class="lg:w-1/3 ">
                            <select name="time_unit" id="time_unit" class="input w-full">
                                @php
                                    $name = [$lang['14'], $lang['15']];
                                    $val = ["min", "hr"];
                                    optionsList($val, $name, isset($_POST['time_unit']) ? $_POST['time_unit'] : 'min');
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="reading_unit" class="font-s-14 text-blue">{{ $lang['9'] }} ({{ $lang['6'] }}):</label>
                    <select name="reading_unit" id="reading_unit" class="input">
                        @php
                        $name = [$lang['14'], $lang['15'], $lang['16'], $lang['17'], $lang['18'], $lang['19']];
                                    $val = ["min", "hr", "day", "week", "month", "year"];
                            optionsList($val,$name,isset($_POST['reading_unit'])?$_POST['reading_unit']:'min');
                        @endphp
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="period_unit" class="font-s-14 text-blue">{{ $lang['10'] }} ({{ $lang['6'] }}):</label>
                    <select name="period_unit" id="period_unit" class="input">
                        @php
                            $name = [$lang['14'], $lang['15'], $lang['16'], $lang['17'], $lang['18'], $lang['19'], $lang['23'], $lang['24'], $lang['25'], $lang['26']];
                            $val = ["min", "hr", "day", "week", "month", "year", "minutes/hour", "year/month/day", "week/day", "day/hour/minutes"];
                            optionsList($val,$name,isset($_POST['period_unit'])?$_POST['period_unit']:'min');
                        @endphp
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
                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 rounded-lg mt-3">
                        <div class="my-2">
                            <div class="lg:w-2/3 font-sans text-lg">
                                <table class="w-full table-auto">
                                    <tr>
                                        <td class="w-3/5 border-b py-2 font-semibold">{{ $lang['20'] }} :</td>
                                        <td class="border-b py-2">{{ $detail['answer'] }}</td>
                                    </tr>
                                    @if (isset($detail['total_daily_reading']))
                                    <tr>
                                        <td class="border-b py-2 font-semibold">{{ $lang['21'] }} :</td>
                                        <td class="border-b py-2">{{ $detail['total_daily_reading'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2 font-semibold">{{ $lang['22'] }} :</td>
                                        <td class="border-b py-2">{{ $detail['period_spent'] }}</td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>