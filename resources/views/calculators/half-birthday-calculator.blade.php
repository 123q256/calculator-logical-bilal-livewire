<style>
    @media (max-width: 450px) {
        .calculator-box{
            padding-right: 0.25rem;
            padding-left: 0.25rem;
        }
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    {{-- <div class="col-12 col-lg-7 mx-auto">
        <div class="row">
            <div class="col-4 px-lg-2 mt-2 ">
                <label for="dob" class="font-s-14 text-blue">{{ $lang['y'] }}:</label>
                <div class="w-100 py-2">
                    <select name="year" id="year" class="input">
                        @for ($i = 1940; $i <= date('Y'); $i++)
                        <option value="{{$i}}"  {{ (isset(request()->year_sec) && request()->year_sec == $i) || (!isset(request()->year_sec) && $i == date('1999')) ? 'selected' : '' }}>{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="col-lg-5 col-5 px-1 px-lg-2 mt-2 ">
                <label for="dob" class="font-s-14 text-blue">{{ $lang['m'] }}:</label>
                <div class="w-100 py-2">
                    <select name="month" id="month" class="input" onchange="updateDays(this)">
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
                            optionsList($val,$name,isset($_POST['month'])?$_POST['month']:'6');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-lg-3 col-3 px-lg-2 mt-2 ">
                <label for="dob" class="font-s-14 text-blue">{{ $lang['d'] }}:</label>
                <div class="w-100 py-2">
                    <select name="day" id="day" class="input">
                        @for ($i = 1; $i < 31; $i++)
                        <option value="{{$i}}" {{ isset(request()->day) && request()->day == $i ? 'selected' : '' }}>{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
        <div class="flex flex-wrap ">
            <div class="w-full lg:flex md:flex lg:space-x-4 md:space-x-4">
                <div class="w-full lg:px-2 md:px-2">
                    <label for="year" class="font-s-14 text-blue">{{ $lang['y'] }}:</label>
                    <div class="w-full py-2">
                        <select name="year" id="year" class="input">
                            @for ($i = 1940; $i <= date('Y'); $i++)
                            <option value="{{$i}}"  {{ (isset(request()->year_sec) && request()->year_sec == $i) || (!isset(request()->year_sec) && $i == date('1999')) ? 'selected' : '' }}>{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="w-full lg:px-2 md:px-2">
                    <label for="dob" class="font-s-14 text-blue">{{ $lang['m'] }}:</label>
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
                <div class="w-full lg:px-2 md:px-2">
                    <label for="day" class="font-s-14 text-blue">{{ $lang['d'] }}:</label>
                    <div class="w-full py-2">
                        <select name="day" id="day" onchange="updateDays('year', 'month', 'day');">
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{$i}}" {{ isset(request()->day) && request()->day == $i ? 'selected' : '' }}>{{$i}}</option>
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
     {{-- result --}}
     <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full bg-light-blue p-3 rounded-[10px] mt-3">
                    <div class="my-2">
                        @if($device == 'desktop')
                        <div class="lg:w-[83.33%]">
                            <table class="w-full">
                                <tr>
                                    <td class="w-[60%] border-b py-2"><strong><?=$lang['7']?> :</strong></td>
                                    <td class="border-b py-2"><strong><?=$detail['next_half']?></strong></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><?=$lang[11]?> :</td>
                                    <td class="border-b py-2"><?=$detail['first_Q']?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><?=$lang[14]?> :</td>
                                    <td class="border-b py-2"><?=$detail['third_Q']?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><strong><?=$lang[15]?> <u><?=$lang[16]?></u> <?=$lang[17]?> :</strong></td>
                                    <td class="border-b py-2"><strong><?=$detail['next_bday']?></strong></td>
                                </tr>
                                <tr>
                                    <td class="w-[60%] border-b py-2"><?=$lang['10']?> :</td>
                                    <td class="border-b py-2"><?=$detail['next_half_days']?> <?=$lang[13]?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><?=$lang['12']?> <?=$lang[18]?> :</td>
                                    <td class="border-b py-2"><?=$detail['first_Q_days']?> <?=$lang[13]?></td>
                                </tr>
                                <tr>
                                    <td class="border-b py-2"><?=$lang['12']?> <?=$lang[19]?> :</td>
                                    <td class="border-b py-2"><?=$detail['third_Q_days']?> <?=$lang[13]?></td>
                                </tr>
                            </table>
                        </div>
                        @else
                        <div class="w-full text-sm">
                            <p class="pt-2"><strong><?=$lang['7']?> :</strong></p>
                            <p class="border-b py-2"><?=$detail['next_half']?></p>
                
                            <p class="pt-2"><strong><?=$lang[11]?> :</strong></p>
                            <p class="border-b py-2"><?=$detail['first_Q']?></p>
                
                            <p class="pt-2"><strong><?=$lang[14]?> :</strong></p>
                            <p class="border-b py-2"><?=$detail['third_Q']?></p>
                
                            <p class="pt-2"><strong><?=$lang[15]?> <u><?=$lang[16]?></u> <?=$lang[17]?> :</strong></p>
                            <p class="border-b py-2"><?=$detail['next_bday']?></p>
                
                            <p class="pt-2"><strong><?=$lang['10']?> :</strong></p>
                            <p class="border-b py-2"><?=$detail['next_half_days']?> <?=$lang[13]?></p>
                
                            <p class="pt-2"><strong><?=$lang['12']?> <?=$lang[18]?> :</strong></p>
                            <p class="border-b py-2"><?=$detail['first_Q_days']?> <?=$lang[13]?></p>
                
                            <p class="pt-2"><strong><?=$lang['12']?> <?=$lang[19]?> :</strong></p>
                            <p class="border-b py-2"><?=$detail['third_Q_days']?> <?=$lang[13]?></p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        <script>
            function updateDays() {
        const month = document.getElementById('month').value;
        const year = document.getElementById('year').value;
        const daySelect = document.getElementById('day');
        let days = 31;

        if (month === '2') { // February
            days = (year % 4 === 0 && year % 100 !== 0) || year % 400 === 0 ? 29 : 28;
        } else if (['4', '6', '9', '11'].includes(month)) { // April, June, September, November
            days = 30;
        }

        daySelect.innerHTML = '';
        for (let i = 1; i <= days; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i;
            daySelect.appendChild(option);
        }
    }

    // Initialize days based on the selected month and year on page load
    document.addEventListener('DOMContentLoaded', updateDays);
        </script>
    @endpush
</form>