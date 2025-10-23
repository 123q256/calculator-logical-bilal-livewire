@php
$metricCountries = [
    "United States",
    "Canada",
    "United Kingdom",
    "Pakistan",
];
@endphp
<style>
      .first:before {
    content: '';
    display: inline-block;
    height: 14px;
    width: 14px;
    border-radius: 3px;
    margin-right: 12px;
    background-color: currentColor;
    -ms-flex-negative: 0;
    flex-shrink: 0;
}

.first:before {
    border-radius: 50px;
    margin-right: 0;
}
 

    input[type=range]::-webkit-slider-runnable-track {
        -webkit-appearance: none;
        box-shadow: none;
        border: none;
        background: transparent;
    }
    #custom_moderate{
        margin-top: 10px
    }
    .units_active1{
        background-color: var(--light-blue);
        color: white;
    }

    @keyframes  button-pulse {
        0% {
            box-shadow: 0 0 0 0px #77DC7E;                ;
        }
        100% {
            box-shadow: 0 0 0 5px #fff;
        }
    }


    .activeMacro{
        background: #278ECD;
        color: var(--white);
    }

    .resultInput{
        height: 41px;
        border-radius: 5px;
        box-shadow: 0px 0px 2px 0px #1670a7 inset;
        background: #FFFFFF;
        outline: 0px;
        border: 0px;
        /* text-align: center; */
        font-size: 14px
    }

    .border_btm_D9D9D9{
        border-bottom: 1px solid #D9D9D9
    }

    .border_btm_D9D9D9.bg-light-blue p{
        color:var(--light-blue) !important
    }

    .color_434648{
        color: #434648
    }

    .min_mt_10{
        margin-top: -10px
    }

    .gap_5{
        gap: 5px
    }

    .border_left{
        border-left: 2px solid #ECEAEA
    }

    .border_right{
        border-right: 1px solid #00000026
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            @php function optionsList($arr1, $arr2, $unit = null){
                    foreach($arr1 as $index => $name){
                        if(isset($arr2[$index])) { 
                            @endphp
                            <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? 'selected' : '' }}>
                                {{ $arr2[$index] }}
                            </option>
                            @php
                        } 
                    }
                }
            @endphp
            @csrf
            <input type="hidden" value="{{ app()->getLocale() }}" name="language">
            <div class="w-full lg:w-8/12 mx-auto mt-3">
                <div class="lg:w-2/3 mb-3">
                    <div class="py-2">
                        <label for="gender" class="pr-3 text-base">{!! $lang['1'] !!}:</label>
                        <input type="radio" name="gender" id="male" value="male" checked {{ isset($_POST['gender']) && $_POST['gender'] === 'male' ? 'checked' : '' }}>
                        <label for="male" class="text-base pr-2 lg:pr-3">{{ $lang['male'] }}</label>
                        <input type="radio" name="gender" id="female" value="female" {{ isset($_POST['gender']) && $_POST['gender'] === 'female' ? 'checked' : '' }}>
                        <label for="female" class="text-base">{{ $lang['female'] }}</label>
                    </div>
                </div>
                <div class="flex flex-wrap">
                    <div class="w-full lg:w-1/2 pr-2 lg:px-2">
                        <label for="age" class="label">{!! $lang['age_year'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="age" min="18" max="130" id="age" class="input w-full" placeholder="00" value="{{ isset(request()->age)?request()->age:'25' }}" />
                        </div>
                    </div>
                    <div class="w-full lg:w-6/12 px-2" >
                        <label for="weight" class="label">{{ $lang['weight'] }}:</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="weight" step="any" id="weight"  class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 w-full" value="{{ isset(request()->weight) ? request()->weight : (in_array($countryName,$metricCountries) ? '158' : '75') }}" aria-label="input" placeholder="00" oninput="checkInput()"
                            @if(request()->unit == 'kg')
                            min="18" max="275"
                            @else
                                min="40" max="600"
                            @endif 
                            />
                        @if (in_array($countryName,$metricCountries))
                            <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-5" onclick="toggleDropdown('unit_dropdown')">{{ isset(request()->unit)?request()->unit:'lbs' }} ▾</label>
                            <input type="text" name="unit" value="{{ isset(request()->unit)?request()->unit:'lbs' }}" id="unit" class="hidden">
                            <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[50%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'lbs')">{{$lang[60]}} (lbs)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'kg')">{{$lang[61]}} (kg)</p>
                            </div>
                        @else
                            <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-5" onclick="toggleDropdown('unit_dropdown')">{{ isset(request()->unit)?request()->unit:'kg' }} ▾</label>
                            <input type="text" name="unit" value="{{ isset(request()->unit)?request()->unit:'kg' }}" id="unit" class="hidden">
                            <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[50%] mt-1 right-0 hidden">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'lbs')">{{$lang[60]}} (lbs)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'kg')">{{$lang[61]}} (kg)</p>
                            </div>
                        @endif
                        </div>
                    </div>
                    <div class="w-6/12 lg:w-2/12 lg:px-2 ft_in ">
                        <label for="height_ft" class="label">{!! $lang['height'] !!}:</label>
                        <div class="w-full py-3 relative">
                            <input type="number" name="height_ft" id="height_ft" class="w-full h-10 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500" min="4" max="7" aria-label="input" placeholder="ft" value="{{ isset(request()->height_ft) ? request()->height_ft : '5' }}" />
                        </div>
                    </div>
                    <div class="w-6/12 lg:w-4/12 px-2 ft_in">
                        <label for="x21" class="label">&nbsp;</label>
                        <input type="text" name="unit_ft_in" value="{{ isset(request()->unit_ft_in)?request()->unit_ft_in:'ft/in' }}" id="unit_ft_in" class="hidden">
                        <div class="relative w-full py-2">
                            <input type="number" name="x" id="x21" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 w-full" value="{{ isset($_POST['height_in'])?$_POST['height_in']:'9' }}" max="11" min="0" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="time_unit" class="absolute cursor-pointer text-sm underline right-6 top-5" onclick="toggleDropdown('time_unit_dropdown')">{{ isset($_POST['time_unit'])?$_POST['time_unit']:'ft/in' }} ▾</label>
                            <input type="text" name="time_unit" value="{{ isset($_POST['time_unit'])?$_POST['time_unit']:'ft/in' }}" id="time_unit" class="hidden">
                            <div id="time_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[90%] mt-1 right-0 hidden units_ft_in time_unit"  to="unit_h">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" value="ft/in" onclick="setUnit('time_unit', 'ft/in')">{{$lang[62]}} (ft/in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" value="cm" onclick="setUnit('time_unit', 'cm')">{{$lang[63]}} (cm)</p>
        
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-6/12 px-2 h_cm hidden ">
                        <label for="height_cm" class="label">{{ $lang['height'] }} (cm):</label>
                        <div class="relative w-full py-2">
                            <input type="number" name="height_cm" step="any" id="height_cm"  min="90" max="245" class="border border-gray-300 p-2 rounded-lg focus:ring-2 focus:ring-blue-500 w-full" value="{{ isset(request()->height_cm)?request()->height_cm:'175.26' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                            <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset(request()->unit_h_cm)?request()->unit_h_cm:'cm' }} ▾</label>
                            <input type="text" name="unit_h_cm" value="{{ isset(request()->unit_h_cm)?request()->unit_h_cm:'cm' }}" id="unit_h_cm" class="hidden">
                            <div id="unit_h_cm_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[60%] mt-1 right-0 hidden  units_ft_in" to="unit_h_cm">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" value="ft/in" onclick="setUnit('unit_h_cm', 'ft/in')">{{$lang[62]}} (ft/in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" value="cm" onclick="setUnit('unit_h_cm', 'cm')">{{$lang[63]}} (cm)</p>
                            </div>
                        </div>
                    </div>
                       <input type="hidden" name="hightUnit" id="hightUnit" value="{{ isset(request()->hightUnit) ? request()->hightUnit : (in_array($countryName,$metricCountries) ? 'ft/in' : 'cm') }}">
                    <div class="w-full  lg:w-1/2 pl-2 lg:px-2">
                        <label for="activity" class="label">{!! $lang['activity'] !!}:</label>
                        <div class="w-full py-2 relative">
                            <select name="activity" id="activity" class="input w-full py-2 px-3 border border-gray-300 rounded-md text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @php
                                    $name = [$lang[64],$lang['Lightly'],$lang['Moderately'],$lang['Very'],$lang['Extremely']];
                                    $val = ["Sedentary", "Lightly Active", "Moderately Active", "Very Active", "Extremely Active"];
                                    optionsList($val,$name,isset(request()->activity)?request()->activity:'Lightly Active');
                                @endphp
                            </select>



                            
                        </div>
                    </div>
                    <div class="w-full  lg:w-1/2 pr-2 lg:px-2">
                        <label for="percent" class="px-lg-2 font-s-14 text-blue">
                            {!! $lang['b_f'] !!}:
                        </label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="percent" id="percent" class="input w-full pr-10" placeholder="{{$lang['opt']}}" value="{{ isset(request()->percent)?request()->percent:'' }}" />
                            <span class="absolute right-3 top-1/2 transform -translate-y-1/2 ">%</span>
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
           <div class="w-full flex justify-end mt-5">
            <div class="pb-0 md:w-[30%] lg:w-[30%]">
                <select name="formula_types" class="resultInput px-2" id="formula_types" onchange="changeFormulas(this)">
                    <option value="mifflin">{{$lang['66']}}</option>
                    <option value="revised">{{$lang['67']}}</option>
                    <option value="katch">{{$lang['68']}}</option>
                </select>
            </div>
           </div>
           <div class="w-full  justify-center ">
            <p class="text-sm text-end mt-1 px-1 text-red-500 hidden" id="percentError">{{$lang['69']}}</p>
  
        </div>
        

                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full bg-white  rounded-lg mt-3 p-5">
                        <div class=" rounded-lg p-4 ">
                            <p class="text-sm text-end mt-1 px-1 text-red-500 hidden" id="percentError">{{$lang['69']}}</p>
                            <p class="text-center text-xl font-bold mt-3 text-blue-600"><strong>{{$lang['70']}} (TDEE)</strong></p>
                            <div class="lg:flex md:flex justify-between">
                                <div class="lg:w-1/2 lg:pr-4 md:pr-4 mt-3 my-auto">
                                    <div class="bg-[#F6FAFC] rounded-lg text-center p-6">
                                        <p><b class="dailyCalories text-green-600 text-5xl">{{ number_format($detail['tdee']) }}</b></p>
                                        <p class="text-sm pb-2 border-b border-gray-300 text-gray-600 mt-2">{{$lang['71']}}</p>
                                        <p class="text-sm mt-2 text-left">
                                            Based on the <b id="formulaText">{{$lang['66']}}</b>, you have a total daily energy expenditure of <b class="dailyCalories">{{ number_format($detail['tdee']) }}</b> calories, which is <b class="weeklyCalories">{{ number_format($detail['tdee'] * 7) }}</b> calories per week.
                                        </p>
                                    </div>
                                </div>
                                <div class="lg:w-1/2 pl-4 mt-3 text-sm border-l border-gray-300">
                                    <div class="flex items-center justify-between p-2 border-b border-gray-300">
                                        <p class="flex items-center gap-2">
                                            <img src="{{ asset('images/tdee_cal.svg') }}" alt="calorie image for tdee" class="w-6 h-6">
                                            <b>{{$lang['75']}}</b>
                                        </p>
                                        <p><b>{{$lang['76']}}</b></p>
                                    </div>
                                    <div class="flex items-center justify-between p-2 border-b border-gray-300 {{request()->activity === "Sedentary" ? 'bg-[#F6FAFC]' : ''}}">
                                        <p>{{$lang['64']}}</p>
                                        <p id="sedentary_calories">{{ round($detail['BMR'] * 1.2) }}</p>
                                    </div>
                                    <div class="flex items-center justify-between p-2 border-b border-gray-300 {{request()->activity === "Lightly Active" ? 'bg-[#F6FAFC]' : ''}}">
                                        <p>{{ $lang['Lightly'] }}</p>
                                        <p id="lightly_calories">{{ round($detail['BMR'] * 1.375) }}</p>
                                    </div>
                                    <div class="flex items-center justify-between p-2 border-b border-gray-300 {{request()->activity === "Moderately Active" ? 'bg-[#F6FAFC]' : ''}}">
                                        <p>{{ $lang['Moderately'] }}</p>
                                        <p id="moderately_calories">{{ round($detail['BMR'] * 1.55) }}</p>
                                    </div>
                                    <div class="flex items-center justify-between p-2 border-b border-gray-300 {{request()->activity === "Very Active" ? 'bg-[#F6FAFC]' : ''}}">
                                        <p>{{ $lang['Very'] }}</p>
                                        <p id="very_calories">{{ round($detail['BMR'] * 1.725) }}</p>
                                    </div>
                                    <div class="flex items-center justify-between p-2 {{request()->activity === "Extremely Active" ? 'bg-[#F6FAFC]' : ''}}">
                                        <p>{{ $lang['Extremely'] }}</p>
                                        <p id="extremely_calories">{{ round($detail['BMR'] * 1.9) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-center text-lg mt-3">
                            <strong class="text-blue-600">{{$lang['77']}}</strong>
                        </p>
                        <div class="w-full">
                            <div class="mx-auto" id="componentsChart" style="height:300px"></div>
                        </div>
                        <p class="mt-3 text-lg">
                            <strong id="bmiDetails">{{ $lang[49] }}: {{ $detail['BMI'] }} (
                                @if ($detail['you_are'] == 'Underweight')
                                    <b class="text-teal-600" title="{{ "18.5 " . $lang['18']; }}">{{ $lang['9'] }}</b>
                                @elseif ($detail['you_are'] == 'Normal Weight')
                                    <b class="text-green-700" title="{{ "18.5 - 24.99"; }}">{{ $lang['10'] }}</b>
                                @elseif ($detail['you_are'] == 'Overweight')
                                    <b class="text-yellow-600" title="{{ "25 - 29.99"; }}">{{ $lang['11'] }}</b>
                                @elseif ($detail['you_are'] == 'Obesity')
                                    <b class="text-red-600" title="{{ "30 - 34.99"; }}">{{ $lang['12'] }}</b>
                                @elseif ($detail['you_are'] == 'Severe Obesity')
                                    <b class="text-red-700" title="{{ "35+"; }}">{{ $lang['13'] }}</b>
                                @endif
                                ), {{ $lang[50] }}: 18.5 to 24.9
                            </strong>
                        </p>
                        <div class="flex flex-col lg:flex-row gap-6">
                            <!-- Left Section (Weight Loss) -->
                            <div class="w-full lg:w-1/2 mt-3">
                                <div class="flex items-center justify-center p-2 bg-[red] rounded-t-lg gap-2">
                                    <img src="{{ asset('images/tdee_apple.svg') }}" alt="apple image for tdee" class="w-5 h-5" decoding="async" loading="lazy">
                                    <p class="text-white">{{$lang['78']}}</p>
                                </div>
                                <div class="w-full text-sm px-2 border border-blue-600 rounded-b-lg">
                                    <div class="flex items-center justify-between py-2 px-3 border-b border-gray-400">
                                        @if($detail['submit'] === "lbs")
                                            <div>
                                                <p>{{ $lang['20'] }}</p>
                                                <p class="text-xs text-gray-500">(0.5 lb {{$lang['79']}})</p>
                                            </div>
                                        @else
                                            <div>
                                                <p>{{ $lang['20'] }}</p>
                                                <p class="text-xs text-gray-500">(0.25 kg {{$lang['79']}})</p>
                                            </div>
                                        @endif
                                        <p class="text-red-400"><span id="mild_loss_calories">{{ number_format($detail['tdee'] - ($detail['tdee'] * 0.1)) }}</span> (90%)</p>
                                    </div>
                                    <div class="flex items-center justify-between py-2 px-3 border-b border-gray-400">
                                        @if($detail['submit'] === "lbs")
                                            <div>
                                                <p>{{ $lang['22'] }}</p>
                                                <p class="text-xs text-gray-500">(1 lb {{$lang['79']}})</p>
                                            </div>
                                        @else
                                            <div>
                                                <p>{{ $lang['22'] }}</p>
                                                <p class="text-xs text-gray-500">(0.5 kg {{$lang['79']}})</p>
                                            </div>
                                        @endif
                                        <p class="text-red-400"><span id="loss_calories">{{ number_format($detail['tdee'] - ($detail['tdee'] * 0.2)) }}</span> (80%)</p>
                                    </div>
                                    <div class="flex items-center justify-between py-2 px-3">
                                        @if($detail['submit'] === "lbs")
                                            <div>
                                                <p>{{ $lang['23'] }}</p>
                                                <p class="text-xs text-gray-500">(2 lb {{$lang['79']}})</p>
                                            </div>
                                        @else
                                            <div>
                                                <p>{{ $lang['23'] }}</p>
                                                <p class="text-xs text-gray-500">(1 kg {{$lang['79']}})</p>
                                            </div>
                                        @endif
                                        <p class="text-red-400"><span id="ex_loss_calories">{{ number_format($detail['tdee'] - ($detail['tdee'] * 0.39)) }}</span> (61%)</p>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Right Section (Weight Gain) -->
                            <div class="w-full lg:w-1/2 mt-3">
                                <div class="flex items-center justify-center p-2 bg-green-600 rounded-t-lg gap-2">
                                    <img src="{{ asset('images/tdee_arm.svg') }}" alt="arm image for tdee" class="w-5 h-5" decoding="async" loading="lazy">
                                    <p class="text-white">{{$lang['80']}}</p>
                                </div>
                                <div class="w-full text-sm px-2 border border-blue-600 rounded-b-lg">
                                    <div class="flex items-center justify-between py-2 px-3 border-b border-gray-400">
                                        @if($detail['submit'] === "lbs")
                                            <div>
                                                <p>{{ $lang['25'] }}</p>
                                                <p class="text-xs text-gray-500">(0.5 lb {{$lang['79']}})</p>
                                            </div>
                                        @else
                                            <div>
                                                <p>{{ $lang['25'] }}</p>
                                                <p class="text-xs text-gray-500">(0.25 kg {{$lang['79']}})</p>
                                            </div>
                                        @endif
                                        <p class="text-blue-600"><span id="mild_gain_calories">{{ number_format($detail['tdee'] + ($detail['tdee'] * 0.1)) }}</span> (110%)</p>
                                    </div>
                                    <div class="flex items-center justify-between py-2 px-3 border-b border-gray-400">
                                        @if($detail['submit'] === "lbs")
                                            <div>
                                                <p>{{ $lang['26'] }}</p>
                                                <p class="text-xs text-gray-500">(1 lb {{$lang['79']}})</p>
                                            </div>
                                        @else
                                            <div>
                                                <p>{{ $lang['26'] }}</p>
                                                <p class="text-xs text-gray-500">(0.5 kg {{$lang['79']}})</p>
                                            </div>
                                        @endif
                                        <p class="text-blue-600"><span id="gain_calories">{{ number_format($detail['tdee'] + ($detail['tdee'] * 0.2)) }}</span> (120%)</p>
                                    </div>
                                    <div class="flex items-center justify-between py-2 px-3">
                                        @if($detail['submit'] === "lbs")
                                            <div>
                                                <p>{{ $lang['27'] }}</p>
                                                <p class="text-xs text-gray-500">(2 lb {{$lang['79']}})</p>
                                            </div>
                                        @else
                                            <div>
                                                <p>{{ $lang['27'] }}</p>
                                                <p class="text-xs text-gray-500">(1 kg {{$lang['79']}})</p>
                                            </div>
                                        @endif
                                        <p class="text-blue-600"><span id="ex_gain_calories">{{ number_format($detail['tdee'] + ($detail['tdee'] * 0.39)) }}</span> (139%)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 text-lg"><b>{{ $lang[52] }}</b></p>
                            
                            @php
                                $main_mod_pro = round(((30 * $detail['calories']) / 100) / 4) . ' g';
                                $main_mod_fat = round(((35 * $detail['calories']) / 100) / 9) . ' g';
                                $main_mod_carb = round(((35 * $detail['calories']) / 100) / 4) . ' g';
                                $main_low_pro = round(((40 * $detail['calories']) / 100) / 4) . ' g';
                                $main_low_fat = round(((40 * $detail['calories']) / 100) / 9) . ' g';
                                $main_low_carb = round(((20 * $detail['calories']) / 100) / 4) . ' g';
                                $main_high_pro = round(((30 * $detail['calories']) / 100) / 4) . ' g';
                                $main_high_fat = round(((20 * $detail['calories']) / 100) / 9) . ' g';
                                $main_high_carb = round((50 * $detail['calories']) / 100 / 4) . ' g';
                                
                                $low_mod_pro = round(((30 * ($detail['calories'] - 500)) / 100) / 4) . ' g';
                                $low_mod_fat = round(((35 * ($detail['calories'] - 500)) / 100) / 9) . ' g';
                                $low_mod_carb = round(((35 * ($detail['calories'] - 500)) / 100) / 4) . ' g';
                                $low_low_pro = round(((40 * ($detail['calories'] - 500)) / 100) / 4) . ' g';
                                $low_low_fat = round(((40 * ($detail['calories'] - 500)) / 100) / 9) . ' g';
                                $low_low_carb = round(((20 * ($detail['calories'] - 500)) / 100) / 4) . ' g';
                                $low_high_pro = round(((30 * ($detail['calories'] - 500)) / 100) / 4) . ' g';
                                $low_high_fat = round(((20 * ($detail['calories'] - 500)) / 100) / 9) . ' g';
                                $low_high_carb = round(((50 * ($detail['calories'] - 500)) / 100) / 4) . ' g';
                
                                $high_mod_pro = round(((30 * ($detail['calories'] + 500)) / 100) / 4) . ' g';
                                $high_mod_fat = round(((35 * ($detail['calories'] + 500)) / 100) / 9) . ' g';
                                $high_mod_carb = round(((35 * ($detail['calories'] + 500)) / 100) / 4) . ' g';
                                $high_low_pro = round(((40 * ($detail['calories'] + 500)) / 100) / 4) . ' g';
                                $high_low_fat = round(((40 * ($detail['calories'] + 500)) / 100) / 9) . ' g';
                                $high_low_carb = round(((20 * ($detail['calories'] + 500)) / 100) / 4) . ' g';
                                $high_high_pro = round(((30 * ($detail['calories'] + 500)) / 100) / 4) . ' g';
                                $high_high_fat = round(((20 * ($detail['calories'] + 500)) / 100) / 9) . ' g';
                                $high_high_carb = round(((50 * ($detail['calories'] + 500)) / 100) / 4) . ' g';
                            @endphp
                            <div class="lg:w-7/12 mt-2 flex items-center p-2 text-sm rounded-lg flex-wrap bg-white shadow-inner gap-4">
                            <p class="py-1 px-2 rounded-md cursor-pointer macronutrients activeMacro" data-value="maintenance" onclick="updateCharts(this)" data-line="{{ $lang['m1_des'] }} <strong class='dailyCalories'>{{ $detail['calories'] }}</strong> {{ $lang['m1_des1'] }}">
                                {{ $lang['m1'] }}
                            </p>
                            <p class="py-1 px-2 rounded-md cursor-pointer macronutrients" data-value="cutting" onclick="updateCharts(this)" data-line="{{ $lang['m2_des'] }} <strong>{{ $detail['calories'] - 500 }}</strong> {{ $lang['m2_des1'] }} <strong class='dailyCalories'>{{ $detail['calories'] }}</strong> {{ $lang['m1_des1'] }}">
                                {{ $lang['m2'] }}
                            </p>
                            <p class="py-1 px-2 rounded-md cursor-pointer macronutrients" data-value="bulking" onclick="updateCharts(this)" data-line="{{ $lang['m3_des'] }} <strong>{{ $detail['calories'] + 500 }}</strong> {{ $lang['m3_des1'] }} <strong class='dailyCalories'>{{ $detail['calories'] }}</strong> {{ $lang['m1_des1'] }}">
                                {{ $lang['m3'] }}
                            </p>
                            <p class="py-1 px-2 rounded-md cursor-pointer macronutrients" data-value="custom" onclick="updateCharts(this)" data-line="custom">
                                {{ $lang[53] }}
                            </p>
                            </div>
                            
                            <div class="col-12 font-s-14 hidden" id="customDetails">
                                <div class="flex flex-col lg:flex-row gap-4 my-2">
                                    <div class="lg:w-1/3 w-full">
                                        <p class="flex justify-between">
                                            <strong>{{ $lang['pro'] }}</strong>
                                            <strong class="change_pro">25%</strong>
                                        </p>
                                        <input type="range" min="10" max="35" value="25" id="own_pro" class="w-full own_pro">
                                    </div>
                                    <div class="lg:w-1/3 w-full lg:px-3 mt-1 lg:mt-0">
                                        <p class="flex justify-between">
                                            <strong>{{ $lang['fat'] }}</strong>
                                            <strong class="change_fat">28%</strong>
                                        </p>
                                        <input type="range" min="20" max="35" id="own_fat" value="28" class="w-full own_fat">
                                    </div>
                                    <div class="lg:w-1/3 w-full mt-1 lg:mt-0">
                                        <p class="flex justify-between">
                                            <strong>{{ $lang['carb'] }}</strong>
                                            <strong class="change_carb">55%</strong>
                                        </p>
                                        <input type="range" min="25" max="65" id="own_carb" value="55" class="w-full own_carb">
                                    </div>
                                </div>
                                <div class="lg:w-1/2 mx-auto flex justify-between flex-wrap mt-4">
                                    <div>
                                        <div class="flex items-center gap-1">
                                            <img src="{{ asset('images/chart_pro.jpg') }}" alt="protien first image for tdee" width="15px" height="15px" decoding="async" loading="lazy" class="object-contain">
                                            <p class="text-[#E94442]">{{ $lang['pro'] }}</p>
                                        </div>
                                        <div class="first custom_pro text-[#E94442]">
                                            @php
                                                $protain = (30 * $detail['calories']) / 100;
                                                echo round($protain / 4) . ' g';
                                            @endphp
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-1">
                                            <img src="{{ asset('images/chart_fat.jpg') }}" alt="fat first image for tdee" width="15px" height="15px" decoding="async" loading="lazy" class="object-contain">
                                            <p class="text-[#E7A827]">{{ $lang['fat'] }}</p>
                                        </div>
                                        <div class="first custom_fat text-[#E7A827]">
                                            @php
                                                $protain = (35 * $detail['calories']) / 100;
                                                echo round($protain / 9) . ' g';
                                            @endphp
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-1">
                                            <img src="{{ asset('images/chart_carb.jpg') }}" alt="carb first image for tdee" width="15px" height="15px" decoding="async" loading="lazy" class="object-contain">
                                            <p class="text-[#38a169]">{{ $lang['carb'] }}</p>
                                        </div>
                                        <div class="first custom_carb text-[#38a169]">
                                            @php
                                                $protain = (35 * $detail['calories']) / 100;
                                                echo round($protain / 4) . ' g';
                                            @endphp
                                        </div>
                                    </div>
                                </div>
                                <div class="mx-auto" id="custom_moderate" style="width: 200px; height: 200px;"></div>
                            </div>
                            
                
                            <div class="w-full text-sm" id="nonCustomDetails">
                                <p class="text-sm mt-3" id="macroLine">
                                    {{ $lang['m1_des'] }} <strong class="dailyCalories">{{ $detail['calories'] }}</strong> {{ $lang['m1_des1'] }}
                                </p>
                                <div class="flex flex-wrap">
                                    <!-- Moderate Section -->
                                    <div class="md:w-1/3 w-full mt-2 pr-3 md:border-r md:border-gray-300">
                                        <p class="mb-2"><strong>{{ $lang['moderate'] }} (30/35/35)</strong></p>
                                <div class="flex justify-center">
                                      
                                        <div class="">
                                            <div class="flex items-center gap-1">
                                                <img src="{{ asset('images/chart_pro.jpg') }}" alt="protien first image for tdee" class="w-4 h-4 object-contain" decoding="async" loading="lazy">
                                                <p class="text-red-600">{{ $lang['pro'] }}</p>
                                            </div>
                                            <div class="mt-1 text-red-600 first" id="mod_pro">
                                                @php
                                                    $protain = (30 * $detail['calories']) / 100;
                                                    echo round($protain / 4) . ' g';
                                                @endphp
                                            </div>
                            
                                            <div class="mt-2">
                                                <div class="flex items-center gap-1">
                                                    <img src="{{ asset('images/chart_fat.jpg') }}" alt="fat first image for tdee" class="w-4 h-4 object-contain" decoding="async" loading="lazy">
                                                    <p class="text-yellow-500">{{ $lang['fat'] }}</p>
                                                </div>
                                                <div class="mt-1 text-yellow-500 first" id="mod_fat">
                                                    @php
                                                        $protain = (35 * $detail['calories']) / 100;
                                                        echo round($protain / 9) . ' g';
                                                    @endphp
                                                </div>
                                            </div>
                            
                                            <div class="mt-2">
                                                <div class="flex items-center gap-1">
                                                    <img src="{{ asset('images/chart_carb.jpg') }}" alt="carb first image for tdee" class="w-4 h-4 object-contain" decoding="async" loading="lazy">
                                                    <p class="text-green-400">{{ $lang['carb'] }}</p>
                                                </div>
                                                <div class="mt-1 text-green-400 first" id="mod_carb">
                                                    @php
                                                        $protain = (35 * $detail['calories']) / 100;
                                                        echo round($protain / 4) . ' g';
                                                    @endphp
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div id="moderateChart"></div>
                                        </div>
                                    </div>
                                    </div>
                            
                                    <!-- Lower Section -->
                                    <div class="md:w-1/3 w-full mt-2 px-3 md:border-r md:border-gray-300">
                                        <p class="mb-2"><strong>{{ $lang['lower'] }} (40/40/20)</strong></p>
                                        <div class="flex justify-center">
                                        <div >
                                            <div class="flex items-center gap-1">
                                                <img src="{{ asset('images/chart_pro.jpg') }}" alt="protien second image for tdee" class="w-4 h-4 object-contain" decoding="async" loading="lazy">
                                                <p class="text-red-600">{{ $lang['pro'] }}</p>
                                            </div>
                                            <div class="mt-1 text-red-600 first" id="low_pro">
                                                @php
                                                    $protain = (30 * $detail['calories']) / 100;
                                                    echo round($protain / 4) . ' g';
                                                @endphp
                                            </div>
                            
                                            <div class="mt-2">
                                                <div class="flex items-center gap-1">
                                                    <img src="{{ asset('images/chart_fat.jpg') }}" alt="fat second image for tdee" class="w-4 h-4 object-contain" decoding="async" loading="lazy">
                                                    <p class="text-yellow-500">{{ $lang['fat'] }}</p>
                                                </div>
                                                <div class="mt-1 text-yellow-500 first" id="low_fat">
                                                    @php
                                                        $protain = (35 * $detail['calories']) / 100;
                                                        echo round($protain / 9) . ' g';
                                                    @endphp
                                                </div>
                                            </div>
                            
                                            <div class="mt-2">
                                                <div class="flex items-center gap-1">
                                                    <img src="{{ asset('images/chart_carb.jpg') }}" alt="carb second image for tdee" class="w-4 h-4 object-contain" decoding="async" loading="lazy">
                                                    <p class="text-green-400">{{ $lang['carb'] }}</p>
                                                </div>
                                                <div class="mt-1 text-green-400 first" id="low_carb">
                                                    @php
                                                        $protain = (35 * $detail['calories']) / 100;
                                                        echo round($protain / 4) . ' g';
                                                    @endphp
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div id="lowerChart"></div>
                                        </div>
                                    </div>
                                    </div>
                            
                                    <!-- High Section -->
                                    <div class="md:w-1/3 w-full mt-2 pl-3">
                                        <p class="mb-2"><strong>{{ $lang['high'] }} (30/20/50)</strong></p>
                                        <div class="flex justify-center">
                                        <div >
                                                <div class="flex items-center gap-1">
                                                    <img src="{{ asset('images/chart_pro.jpg') }}" alt="protien third image for tdee" class="w-4 h-4 object-contain" decoding="async" loading="lazy">
                                                    <p class="text-red-600">{{ $lang['pro'] }}</p>
                                                </div>
                                                <div class="mt-1 text-red-600 first" id="high_pro">
                                                    @php
                                                        $protain = (30 * $detail['calories']) / 100;
                                                        echo round($protain / 4) . ' g';
                                                    @endphp
                                                </div>
                                
                                                <div class="mt-2">
                                                    <div class="flex items-center gap-1">
                                                        <img src="{{ asset('images/chart_fat.jpg') }}" alt="fat third image for tdee" class="w-4 h-4 object-contain" decoding="async" loading="lazy">
                                                        <p class="text-yellow-500">{{ $lang['fat'] }}</p>
                                                    </div>
                                                    <div class="mt-1 text-yellow-500 first" id="high_fat">
                                                        @php
                                                            $protain = (35 * $detail['calories']) / 100;
                                                            echo round($protain / 9) . ' g';
                                                        @endphp
                                                    </div>
                                                </div>
                                
                                                <div class="mt-2">
                                                    <div class="flex items-center gap-1">
                                                        <img src="{{ asset('images/chart_carb.jpg') }}" alt="carb third image for tdee" class="w-4 h-4 object-contain" decoding="async" loading="lazy">
                                                        <p class="text-green-400">{{ $lang['carb'] }}</p>
                                                    </div>
                                                    <div class="mt-1 text-green-400 first" id="high_carb">
                                                        @php
                                                            $protain = (35 * $detail['calories']) / 100;
                                                            echo round($protain / 4) . ' g';
                                                        @endphp
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="mt-2">
                                            <div id="higherChart"></div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        @isset($detail)
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
            <script>
                let main_mod_pro, main_mod_fat, main_mod_carb, main_low_pro, main_low_fat, main_low_carb, main_high_pro, main_high_fat, main_high_carb;
                let low_mod_pro, low_mod_fat, low_mod_carb, low_low_pro, low_low_fat, low_low_carb, low_high_pro, low_high_fat, low_high_carb;
                let high_mod_pro, high_mod_fat, high_mod_carb, high_low_pro, high_low_fat, high_low_carb, high_high_pro, high_high_fat, high_high_carb;
                let checkFunctionCalled = false;
                let TEF, physicalActivity;
                var TDEE = {{ $detail['calories'] }};
                var BMR = {{ $detail['BMR'] }};
                function changeFormulas(element) {
                    let BMR;
                    let tdee;
                    let formula = element.value;
                    let hightUnit = `{{request()->hightUnit}}`;
                    let unit = `{{request()->unit}}`;
                    let age = {{request()->age}};
                    let gender = `{{request()->gender}}`;
                    // let weight = {{request()->weight}};
                    let activity = `{{request()->activity}}`;
                    let percent = {{ isset(request()->percent) ? request()->percent : 0 }};
                    // if(unit == "lbs"){
                    //     weight = weight / 2.205;
                    // }
                    var height_cm = `{{$detail['height_cm']}}`;
                    var weight = `{{$detail['weight']}}`;
                    const height_m = height_cm / 100;
                    if(formula == "katch") {
                        if (typeof percent !== 'undefined' && percent !== null && percent !== 0) {
                            BMR = 370 + 21.6 * (1 - (percent/100)) * weight;
                        } else {
                            document.getElementById('percentError').classList.remove("hidden");
                            document.querySelector('input[name="percent"]').style.boxShadow = '0px 0px 2px 0px red inset';
                            return;
                        }
                    } else {
                        document.getElementById('percentError').classList.add("hidden");
                        document.querySelector('input[name="percent"]').style.boxShadow = '0px 0px 2px 0px #00000040 inset';
                        if(gender == "female"){
                            if(formula == "revised"){
                                BMR = (9.247 * weight) + (3.098 * height_cm) - (4.330 * age) + 447.593;
                            }else{
                                BMR = (10 * weight) + (6.25 * height_cm) - (5 * age) - 161;
                            }
                        }else{
                            if(formula == "revised"){
                                BMR = (13.397 * weight) + (4.799 * height_cm) - (5.677 * age) + 88.362;
                            }else{
                                BMR = (10 * weight) + (6.25 * height_cm) - (5 * age) + 5;
                            }
                        }
                    }
                    if (activity === "Sedentary") {
                        tdee = Math.round(BMR * 1.2);
                    } else if (activity === "Lightly Active") {
                        tdee = Math.round(BMR * 1.375);
                    } else if (activity === "Moderately Active") {
                        tdee = Math.round(BMR * 1.55);
                    } else if (activity === "Very Active") {
                        tdee = Math.round(BMR * 1.725);
                    } else {
                        tdee = Math.round(BMR * 1.9);
                    }
                    let weeklyCalories = tdee * 7;
                    document.querySelectorAll('.dailyCalories').forEach(el => el.textContent = tdee.toLocaleString());
                    document.querySelectorAll('.weeklyCalories').forEach(el => el.textContent = weeklyCalories.toLocaleString());
                    if(formula == "katch"){
                        document.getElementById('formulaText').textContent = "{{$lang['68']}}";
                    }else if(formula == "revised"){
                        document.getElementById('formulaText').textContent = "{{$lang['67']}}";
                    }else{
                        document.getElementById('formulaText').textContent = "{{$lang['66']}}";
                    }
                    document.getElementById('sedentary_calories').textContent = Math.round(BMR * 1.2);
                    document.getElementById('lightly_calories').textContent = Math.round(BMR * 1.375);
                    document.getElementById('moderately_calories').textContent = Math.round(BMR * 1.55);
                    document.getElementById('very_calories').textContent = Math.round(BMR * 1.725);
                    document.getElementById('extremely_calories').textContent = Math.round(BMR * 1.9);

                    document.getElementById('mild_loss_calories').textContent = Math.round(tdee - (tdee * 0.1)).toLocaleString();
                    document.getElementById('loss_calories').textContent = Math.round(tdee - (tdee * 0.2)).toLocaleString();
                    document.getElementById('ex_loss_calories').textContent = Math.round(tdee - (tdee * 0.39)).toLocaleString();
                    document.getElementById('mild_gain_calories').textContent = Math.round(tdee + (tdee * 0.1)).toLocaleString();
                    document.getElementById('gain_calories').textContent = Math.round(tdee + (tdee * 0.2)).toLocaleString();
                    document.getElementById('ex_gain_calories').textContent = Math.round(tdee + (tdee * 0.39)).toLocaleString();
                    checkFunctionCalled = true;

                    main_mod_pro = Math.round(((30 * tdee) / 100) / 4) + ' g';
                    main_mod_fat = Math.round(((35 * tdee) / 100) / 9) + ' g';
                    main_mod_carb = Math.round(((35 * tdee) / 100) / 4) + ' g';
                    main_low_pro = Math.round(((40 * tdee) / 100) / 4) + ' g';
                    main_low_fat = Math.round(((40 * tdee) / 100) / 9) + ' g';
                    main_low_carb = Math.round(((20 * tdee) / 100) / 4) + ' g';
                    main_high_pro = Math.round(((30 * tdee) / 100) / 4) + ' g';
                    main_high_fat = Math.round(((20 * tdee) / 100) / 9) + ' g';
                    main_high_carb = Math.round((50 * tdee) / 100 / 4) + ' g';

                    low_mod_pro = Math.round(((30 * (tdee - 500)) / 100) / 4) + ' g';
                    low_mod_fat = Math.round(((35 * (tdee - 500)) / 100) / 9) + ' g';
                    low_mod_carb = Math.round(((35 * (tdee - 500)) / 100) / 4) + ' g';
                    low_low_pro = Math.round(((40 * (tdee - 500)) / 100) / 4) + ' g';
                    low_low_fat = Math.round(((40 * (tdee - 500)) / 100) / 9) + ' g';
                    low_low_carb = Math.round(((20 * (tdee - 500)) / 100) / 4) + ' g';
                    low_high_pro = Math.round(((30 * (tdee - 500)) / 100) / 4) + ' g';
                    low_high_fat = Math.round(((20 * (tdee - 500)) / 100) / 9) + ' g';
                    low_high_carb = Math.round(((50 * (tdee - 500)) / 100) / 4) + ' g';

                    high_mod_pro = Math.round(((30 * (tdee + 500)) / 100) / 4) + ' g';
                    high_mod_fat = Math.round(((35 * (tdee + 500)) / 100) / 9) + ' g';
                    high_mod_carb = Math.round(((35 * (tdee + 500)) / 100) / 4) + ' g';
                    high_low_pro = Math.round(((40 * (tdee + 500)) / 100) / 4) + ' g';
                    high_low_fat = Math.round(((40 * (tdee + 500)) / 100) / 9) + ' g';
                    high_low_carb = Math.round(((20 * (tdee + 500)) / 100) / 4) + ' g';
                    high_high_pro = Math.round(((30 * (tdee + 500)) / 100) / 4) + ' g';
                    high_high_fat = Math.round(((20 * (tdee + 500)) / 100) / 9) + ' g';
                    high_high_carb = Math.round(((50 * (tdee + 500)) / 100) / 4) + ' g';

                    document.getElementById('mod_pro').textContent = `${main_mod_pro}`;
                    document.getElementById('mod_fat').textContent = `${main_mod_fat}`;
                    document.getElementById('mod_carb').textContent = `${main_mod_carb}`;
                    document.getElementById('low_pro').textContent = `${main_low_pro}`;
                    document.getElementById('low_fat').textContent = `${main_low_fat}`;
                    document.getElementById('low_carb').textContent = `${main_low_carb}`;
                    document.getElementById('high_pro').textContent = `${main_high_pro}`;
                    document.getElementById('high_fat').textContent = `${main_high_fat}`;
                    document.getElementById('high_carb').textContent = `${main_high_carb}`;
                    document.querySelectorAll('.custom_pro').forEach(el => el.textContent = Math.round(((30 * tdee) / 100)/4) + ' g');
                    document.querySelectorAll('.custom_fat').forEach(el => el.textContent = Math.round(((35 * tdee) / 100)/9) + ' g');
                    document.querySelectorAll('.custom_carb').forEach(el => el.textContent = Math.round(((35 * tdee) / 100)/4) + ' g');

                    TDEE = tdee;
                    TEF = TDEE * 0.10;
                    physicalActivity = TDEE - (TEF + BMR);
                    var total = BMR + physicalActivity + TEF;
                    var BMRPercentage = (BMR / total) * 100;
                    var physicalActivityPercentage = (physicalActivity / total) * 100;
                    var TEFPercentage = (TEF / total) * 100;
                    // function componentsChart() {
                    //     var data = google.visualization.arrayToDataTable([
                    //         ['Component', 'Percentage'],
                    //         ['BMR (Basal Metabolic Rate)', BMR],
                    //         ['Physical Activity (EAT + NEAT)', physicalActivity],
                    //         ['TEF (Thermic Effect of Food)', TEF]
                    //     ]);
                    //     var options = {
                    //         legend: {
                    //             position: 'bottom', // Move the legend to the bottom
                    //             alignment: 'center', // Align the legend to the center
                    //         },
                    //         width: 200,
                    //         height: 200,
                    //         pieStartAngle: 100,
                    //         chartArea: {
                    //             left: 15,
                    //             top: 15,
                    //             width: '100%',
                    //             height: '100%'
                    //         },
                    //         slices: {
                    //             0: { color: '#278ECD' },
                    //             1: { color: '#1670A7' },
                    //             2: { color: '#4CBAFD' }
                    //         }
                    //     };
                    //     var chart = new google.visualization.PieChart(document.getElementById('componentsChart'));
                    //     chart.draw(data, options);
                    // }
                    // google.charts.setOnLoadCallback(componentsChart);
                    // var chart = new CanvasJS.Chart("componentsChart", {
                    //     theme: "light2",
                    //     animationEnabled: true,
                    //     height: 300,
                    //     data: [{
                    //         type: "pie",
                    //         indexLabelFontSize: 14,
                    //         radius: 80,
                    //         indexLabel: "{label} - {y}",
                    //         yValueFormatString: "###0.0\"%\"",
                    //         dataPoints: [
                    //             { y: BMRPercentage, label: "BMR (Basal Metabolic Rate)", color: "#278ECD" },
                    //             { y: physicalActivityPercentage, label: "Physical Activity (EAT + NEAT)", color: '#1670A7'},
                    //             { y: TEFPercentage, label: "TEF (Thermic Effect of Food)", color: '#4CBAFD'}
                    //         ]
                    //     }]
                    // });
                    // chart.render();

                    @php if($device == "desktop"){ @endphp
                        var chart = new CanvasJS.Chart("componentsChart", {
                            theme: "light2",
                            animationEnabled: true,
                            height: 300,
                            data: [{
                                type: "pie",
                                indexLabelFontSize: 14,
                                radius: 80,
                                indexLabel: "{label} - {y}",
                                yValueFormatString: "###0.0\"%\"",
                                dataPoints: [
                                    { y: BMRPercentage, label: "BMR ({{$lang['bmr']}})", color: "#278ECD" },
                                    { y: physicalActivityPercentage, label: "{{$lang['81']}} (EAT + NEAT)", color: '#1670A7'},
                                    { y: TEFPercentage, label: "TEF ({{$lang['82']}})", color: '#4CBAFD' }
                                ]
                            }]
                        });
                        chart.render();
                    @php }else{ @endphp
                        var chart = new CanvasJS.Chart("componentsChart", {
                            theme: "light2",
                            animationEnabled: true,
                            height: 300,
                            data: [{
                                type: "pie",
                                indexLabelFontSize: 14,
                                radius: 80,
                                indexLabel: "{label} - {y}",
                                yValueFormatString: "###0.0\"%\"",
                                dataPoints: [
                                    { y: BMRPercentage, label: "BMR", color: "#278ECD" },
                                    { y: physicalActivityPercentage, label: "PAL", color: '#1670A7'},
                                    { y: TEFPercentage, label: "TEF", color: '#4CBAFD'}
                                ]
                            }]
                        });
                        chart.render();
                    @php } @endphp
                }
                function updateCharts(element) {
                    const allmacronutrients = document.querySelectorAll('.macronutrients');
                    allmacronutrients.forEach(el => el.classList.remove('activeMacro'));
                    element.classList.add('activeMacro');
                    const macro_name = element.getAttribute('data-value');
                    const new_line = element.getAttribute('data-line');
                    if(macro_name == "custom"){
                        document.getElementById('nonCustomDetails').classList.add('hidden');   
                        document.getElementById('customDetails').classList.remove('hidden');
                        customChart();    
                    }else{   
                        document.getElementById('nonCustomDetails').classList.remove('hidden');   
                        document.getElementById('customDetails').classList.add('hidden');   
                        document.getElementById('macroLine').innerHTML = new_line;
                    }
                    if(checkFunctionCalled == true){
                        if(macro_name == "maintenance"){
                            document.getElementById('mod_pro').textContent = `${main_mod_pro}`;
                            document.getElementById('mod_fat').textContent = `${main_mod_fat}`;
                            document.getElementById('mod_carb').textContent = `${main_mod_carb}`;
                            document.getElementById('low_pro').textContent = `${main_low_pro}`;
                            document.getElementById('low_fat').textContent = `${main_low_fat}`;
                            document.getElementById('low_carb').textContent = `${main_low_carb}`;
                            document.getElementById('high_pro').textContent = `${main_high_pro}`;
                            document.getElementById('high_fat').textContent = `${main_high_fat}`;
                            document.getElementById('high_carb').textContent = `${main_high_carb}`;
                        }else if(macro_name == "cutting"){
                            document.getElementById('mod_pro').textContent = `${low_mod_pro}`;
                            document.getElementById('mod_fat').textContent = `${low_mod_fat}`;
                            document.getElementById('mod_carb').textContent = `${low_mod_carb}`;
                            document.getElementById('low_pro').textContent = `${low_low_pro}`;
                            document.getElementById('low_fat').textContent = `${low_low_fat}`;
                            document.getElementById('low_carb').textContent = `${low_low_carb}`;
                            document.getElementById('high_pro').textContent = `${low_high_pro}`;
                            document.getElementById('high_fat').textContent = `${low_high_fat}`;
                            document.getElementById('high_carb').textContent = `${low_high_carb}`;
                        }else if(macro_name == "bulking"){
                            document.getElementById('mod_pro').textContent = `${high_mod_pro}`;
                            document.getElementById('mod_fat').textContent = `${high_mod_fat}`;
                            document.getElementById('mod_carb').textContent = `${high_mod_carb}`;
                            document.getElementById('low_pro').textContent = `${high_low_pro}`;
                            document.getElementById('low_fat').textContent = `${high_low_fat}`;
                            document.getElementById('low_carb').textContent = `${high_low_carb}`;
                            document.getElementById('high_pro').textContent = `${high_high_pro}`;
                            document.getElementById('high_fat').textContent = `${high_high_fat}`;
                            document.getElementById('high_carb').textContent = `${high_high_carb}`;
                        }else if(macro_name == "custom"){
                        }
                    } else {
                        if(macro_name == "maintenance"){
                            document.getElementById('mod_pro').textContent = ` {{$main_mod_pro}} `;
                            document.getElementById('mod_fat').textContent = ` {{$main_mod_fat}} `;
                            document.getElementById('mod_carb').textContent = ` {{$main_mod_carb}} `;
                            document.getElementById('low_pro').textContent = ` {{$main_low_pro}} `;
                            document.getElementById('low_fat').textContent = ` {{$main_low_fat}} `;
                            document.getElementById('low_carb').textContent = ` {{$main_low_carb}} `;
                            document.getElementById('high_pro').textContent = ` {{$main_high_pro}} `;
                            document.getElementById('high_fat').textContent = ` {{$main_high_fat}} `;
                            document.getElementById('high_carb').textContent = ` {{$main_high_carb}} `;
                        }else if(macro_name == "cutting"){
                            document.getElementById('mod_pro').textContent = ` {{$low_mod_pro}} `;
                            document.getElementById('mod_fat').textContent = ` {{$low_mod_fat}} `;
                            document.getElementById('mod_carb').textContent = ` {{$low_mod_carb}} `;
                            document.getElementById('low_pro').textContent = ` {{$low_low_pro}} `;
                            document.getElementById('low_fat').textContent = ` {{$low_low_fat}} `;
                            document.getElementById('low_carb').textContent = ` {{$low_low_carb}} `;
                            document.getElementById('high_pro').textContent = ` {{$low_high_pro}} `;
                            document.getElementById('high_fat').textContent = ` {{$low_high_fat}} `;
                            document.getElementById('high_carb').textContent = ` {{$low_high_carb}} `;
                        }else if(macro_name == "bulking"){
                            document.getElementById('mod_pro').textContent = ` {{$high_mod_pro}} `;
                            document.getElementById('mod_fat').textContent = ` {{$high_mod_fat}} `;
                            document.getElementById('mod_carb').textContent = ` {{$high_mod_carb}} `;
                            document.getElementById('low_pro').textContent = ` {{$high_low_pro}} `;
                            document.getElementById('low_fat').textContent = ` {{$high_low_fat}} `;
                            document.getElementById('low_carb').textContent = ` {{$high_low_carb}} `;
                            document.getElementById('high_pro').textContent = ` {{$high_high_pro}} `;
                            document.getElementById('high_fat').textContent = ` {{$high_high_fat}} `;
                            document.getElementById('high_carb').textContent = ` {{$high_high_carb}} `;
                        }else if(macro_name == "custom"){
                        }
                    }
                }
                TEF = TDEE * 0.10;
                physicalActivity = TDEE - (TEF + BMR);
                function moderateChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Task1', 'Hours per Day'],
                        ['{{ $lang["pro"] }}', 30],
                        ['{{ $lang["fat"] }}', 35],
                        ['{{ $lang["carb"] }}', 35]
                    ]);
                    var options = {
                        legend: 'none',
                        text: false,
                        width: 150,
                        height: 150,
                        slices: {
                            0: { color: '#E94442' },
                            1: { color: '#E7A827' },
                            2: { color: '#38a169' }
                        }
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('moderateChart'));
                    chart.draw(data, options);
                }
                function lowerChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Task1', 'Hours per Day'],
                        ['{{ $lang["pro"] }}', 40],
                        ['{{ $lang["fat"] }}', 40],
                        ['{{ $lang["carb"] }}', 20]
                    ]);
                    var options = {
                        legend: 'none',
                        text: false,
                        width: 150,
                        height: 150,
                        slices: {
                            0: { color: '#E94442' },
                            1: { color: '#E7A827' },
                            2: { color: '#38a169' }
                        }
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('lowerChart'));
                    chart.draw(data, options);
                }
                function higherChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Task1', 'Hours per Day'],
                        ['{{ $lang["pro"] }}', 30],
                        ['{{ $lang["fat"] }}', 20],
                        ['{{ $lang["carb"] }}', 50]
                    ]);
                    var options = {
                        legend: 'none',
                        text: false,
                        width: 150,
                        height: 150,
                        slices: {
                            0: { color: '#E94442' },
                            1: { color: '#E7A827' },
                            2: { color: '#38a169' }
                        }
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('higherChart'));
                    chart.draw(data, options);
                }
                function customChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Task1', 'Hours per Day'],
                        ['{{ $lang["pro"] }}', 30],
                        ['{{ $lang["fat"] }}', 35],
                        ['{{ $lang["carb"] }}', 35]
                    ]);
                    var options = {
                        legend: 'none',
                        text: false,
                        width: 200,
                        height: 200,
                        slices: {
                            0: { color: '#E94442' },
                            1: { color: '#E7A827' },
                            2: { color: '#38a169' }
                        }
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('custom_moderate'));
                    chart.draw(data, options);
                }

                google.charts.load('current', { packages: ['corechart'] });
                google.charts.setOnLoadCallback(moderateChart);
                google.charts.setOnLoadCallback(lowerChart);
                google.charts.setOnLoadCallback(higherChart);
                // google.charts.setOnLoadCallback(componentsChart);
                // google.charts.setOnLoadCallback(customChart);
                var total = BMR + physicalActivity + TEF;
                var BMRPercentage = (BMR / total) * 100;
                var physicalActivityPercentage = (physicalActivity / total) * 100;
                var TEFPercentage = (TEF / total) * 100;
                @php if($device == "desktop"){ @endphp
                    window.onload = function () {
                        var chart = new CanvasJS.Chart("componentsChart", {
                            theme: "light2",
                            animationEnabled: true,
                            height: 300,
                            data: [{
                                type: "pie",
                                indexLabelFontSize: 14,
                                radius: 80,
                                indexLabel: "{label} - {y}",
                                yValueFormatString: "###0.0\"%\"",
                                // dataPoints: [
                                //     { y: BMRPercentage, label: "BMR (Basal Metabolic Rate)", color: "#278ECD" },
                                //     { y: physicalActivityPercentage, label: "Physical Activity (EAT + NEAT)", color: '#1670A7'},
                                //     { y: TEFPercentage, label: "TEF (Thermic Effect of Food)", color: '#4CBAFD'}
                                // ]
                                dataPoints: [
                                    { y: BMRPercentage, label: "BMR ({{$lang['bmr']}})", color: "#278ECD" },
                                    { y: physicalActivityPercentage, label: "{{$lang[81]}} (EAT + NEAT)", color: '#1670A7' },
                                    { y: TEFPercentage, label: "TEF ({{$lang[82]}})", color: '#4CBAFD' }
                                ]

                            }]
                        });
                        chart.render();
                    }
                @php }else{ @endphp
                    window.onload = function () {
                        var chart = new CanvasJS.Chart("componentsChart", {
                            theme: "light2",
                            animationEnabled: true,
                            height: 300,
                            data: [{
                                type: "pie",
                                indexLabelFontSize: 14,
                                radius: 80,
                                indexLabel: "{label} - {y}",
                                yValueFormatString: "###0.0\"%\"",
                                dataPoints: [
                                    { y: BMRPercentage, label: "BMR", color: "#278ECD" },
                                    { y: physicalActivityPercentage, label: "PAL", color: '#1670A7'},
                                    { y: TEFPercentage, label: "TEF", color: '#4CBAFD'}
                                ]
                            }]
                        });
                        chart.render();
                    }
                @php } @endphp
                if(checkFunctionCalled == true){
                    var cal = tdee;
                }else{
                    var cal = {{ $detail['calories'] }};
                }

                document.querySelectorAll('.own_pro').forEach(function(element) {
                    element.addEventListener('change', function() {
                        var own_pro = parseInt(this.value);
                        var remain = 100 - own_pro;
                        var own_fat = Math.round(remain / 3);
                        var own_carb = 100 - own_fat - own_pro;
                        if (own_fat > 35) {
                            remain = parseInt(own_fat - 35);
                            own_fat = 35;
                            own_carb += remain;
                        }
                        if (own_carb < 45) {
                            own_carb = 45;
                            remain = parseInt(45 - own_carb);
                            own_fat -= remain;
                        }
                        document.querySelector('.own_fat').value = own_fat;
                        document.querySelector('.own_carb').value = own_carb;
                        var pro = Math.round((cal * (own_pro / 100)) / 4);
                        var fat = Math.round((cal * (own_fat / 100)) / 9);
                        var carbs = Math.round((cal * (own_carb / 100)) / 4);
                        // document.querySelector('.protein').textContent = pro;
                        // document.querySelector('.fats').textContent = fat;
                        // document.querySelector('.carbs').textContent = carbs;
                        // document.querySelector('.pro_per').textContent = own_pro + "%";
                        // document.querySelector('.fat_per').textContent = own_fat + "%";
                        // document.querySelector('.carb_per').textContent = own_carb + "%";
                        document.querySelector('.custom_pro').textContent = " " + pro + " g";
                        document.querySelector('.custom_fat').textContent = " " + fat + " g";
                        document.querySelector('.custom_carb').textContent = " " + carbs + " g";
                        document.querySelector('.change_pro').textContent = own_pro + "%";
                        document.querySelector('.change_fat').textContent = own_fat + "%";
                        document.querySelector('.change_carb').textContent = own_carb + "%";
                        own_pro = Number(own_pro);
                        own_fat = Number(own_fat);
                        own_carb = Number(own_carb);
                        google.charts.load('current', {'packages': ['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Task', 'Hours per Day'],
                                ['Protein', own_pro],
                                ['Fat', own_fat],
                                ['Carbs', own_carb]
                            ]);
                            var options = {
                                legend: 'none',
                                text: false,
                                slices: {
                                    0: { color: '#E94442' },
                                    1: { color: '#E7A827' },
                                    2: { color: '#38a169' }
                                }
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('custom_moderate'));

                            chart.draw(data, options);
                        }
                    });
                });
                document.querySelectorAll('.own_fat').forEach(function(element) {
                    element.addEventListener('change', function() {
                        var own_fat = parseInt(this.value);
                        var remain = 100 - own_fat;
                        var own_pro = Math.round(remain / 3);
                        var own_carb = 100 - own_fat - own_pro;
                        if (own_carb < 45) {
                            remain = 50 - own_carb;
                            own_carb = 50;
                            own_pro -= remain;
                        }
                        document.querySelector('.own_pro').value = own_pro;
                        document.querySelector('.own_carb').value = own_carb;
                        var pro = Math.round((cal * (own_pro / 100)) / 4);
                        var fat = Math.round((cal * (own_fat / 100)) / 9);
                        var carbs = Math.round((cal * (own_carb / 100)) / 4);
                        // document.querySelector('.protein').textContent = pro;
                        // document.querySelector('.fats').textContent = fat;
                        // document.querySelector('.carbs').textContent = carbs;
                        // document.querySelector('.pro_per').textContent = own_pro + "%";
                        // document.querySelector('.fat_per').textContent = own_fat + "%";
                        // document.querySelector('.carb_per').textContent = own_carb + "%";
                        document.querySelector('.custom_pro').textContent = " " + pro + " g";
                        document.querySelector('.custom_fat').textContent = " " + fat + " g";
                        document.querySelector('.custom_carb').textContent = " " + carbs + " g";
                        document.querySelector('.change_pro').textContent = own_pro + "%";
                        document.querySelector('.change_fat').textContent = own_fat + "%";
                        document.querySelector('.change_carb').textContent = own_carb + "%";
                        own_pro = Number(own_pro);
                        own_fat = Number(own_fat);
                        own_carb = Number(own_carb);
                        google.charts.load('current', {'packages': ['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Task', 'Hours per Day'],
                                ['Protein', own_pro],
                                ['Fat', own_fat],
                                ['Carbs', own_carb]
                            ]);
                            var options = {
                                legend: 'none',
                                text: false,
                                slices: {
                                    0: { color: '#E94442' },
                                    1: { color: '#E7A827' },
                                    2: { color: '#38a169' }
                                }
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('custom_moderate'));

                            chart.draw(data, options);
                        }
                    });
                });
                document.querySelectorAll('.own_carb').forEach(function(element) {
                    element.addEventListener('change', function() {
                        var own_carb = parseInt(this.value);
                        var remain = 100 - own_carb;
                        var own_pro = Math.round(remain / 3);
                        var own_fat = 100 - own_carb - own_pro;
                        if (own_fat > 35) {
                            remain = parseInt(own_fat - 30);
                            own_fat = 30;
                            own_pro += remain;
                        }
                        document.querySelector('.own_pro').value = own_pro;
                        document.querySelector('.own_fat').value = own_fat;
                        var pro = Math.round((cal * (own_pro / 100)) / 4);
                        var fat = Math.round((cal * (own_fat / 100)) / 9);
                        var carbs = Math.round((cal * (own_carb / 100)) / 4);
                        // document.querySelector('.protein').textContent = pro;
                        // document.querySelector('.fats').textContent = fat;
                        // document.querySelector('.carbs').textContent = carbs;
                        // document.querySelector('.pro_per').textContent = own_pro + "%";
                        // document.querySelector('.fat_per').textContent = own_fat + "%";
                        // document.querySelector('.carb_per').textContent = own_carb + "%";
                        document.querySelector('.custom_pro').textContent = " " + pro + " g";
                        document.querySelector('.custom_fat').textContent = " " + fat + " g";
                        document.querySelector('.custom_carb').textContent = " " + carbs + " g";
                        document.querySelector('.change_pro').textContent = own_pro + "%";
                        document.querySelector('.change_fat').textContent = own_fat + "%";
                        document.querySelector('.change_carb').textContent = own_carb + "%";
                        own_pro = Number(own_pro);
                        own_fat = Number(own_fat);
                        own_carb = Number(own_carb);
                        google.charts.load('current', {'packages': ['corechart']});
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Task', 'Hours per Day'],
                                ['Protein', own_pro],
                                ['Fat', own_fat],
                                ['Carbs', own_carb]
                            ]);
                            var options = {
                                legend: 'none',
                                text: false,
                                slices: {
                                    0: { color: '#E94442' },
                                    1: { color: '#E7A827' },
                                    2: { color: '#38a169' }
                                }
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('custom_moderate'));

                            chart.draw(data, options);
                        }
                    });
                });
                
                document.getElementById("own_pro").oninput = function() {
                    var value = (this.value - this.min) / (this.max - this.min) * 100
                    this.style.background = 'linear-gradient(to right, #82CFD0 0%, #82CFD0 ' + value + '%, #fff ' + value + '%, white 100%)'
                };
                document.getElementById("own_fat").oninput = function() {
                    var value = (this.value - this.min) / (this.max - this.min) * 100
                    this.style.background = 'linear-gradient(to right, #82CFD0 0%, #82CFD0 ' + value + '%, #fff ' + value + '%, white 100%)'
                };
                document.getElementById("own_carb").oninput = function() {
                    var value = (this.value - this.min) / (this.max - this.min) * 100
                    this.style.background = 'linear-gradient(to right, #82CFD0 0%, #82CFD0 ' + value + '%, #fff ' + value + '%, white 100%)'
                };
            </script>
        @endisset
        <script>
            var units_ft_in = document.querySelectorAll('.units_ft_in p');
            units_ft_in.forEach(function(element) {
                element.addEventListener('click', function() {
                    var toAttr = this.closest('.units_ft_in').getAttribute('to');
                    var val = this.getAttribute('value');

                    if (val == 'ft/in') {
                        document.querySelectorAll('.h_cm').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.ft_in').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.ft_in [for="unit_h"]').textContent = val + ' ▾';
                        document.getElementById('hightUnit').value = "ft/in";
                    } else {
                        document.querySelectorAll('.ft_in').forEach(function(elem) {
                            elem.style.display = 'none';
                        });
                        document.querySelectorAll('.h_cm').forEach(function(elem) {
                            elem.style.display = 'block';
                        });
                        document.querySelector('.h_cm [for="unit_h_cm"]').textContent = val + ' ▾';
                        document.getElementById('hightUnit').value = "cm";
                    }
                    
                    document.getElementById('unit_ft_in').value = val;
                    document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                        elem.classList.toggle('hidden');
                    });
                });
            });


            @isset($detail)
                
                val = '{{$_POST['unit_ft_in']}}';
              if (val == 'ft/in') {
                   document.querySelectorAll('.h_cm').forEach(function(elem) {
                       elem.style.display = 'none';
                   });
                   document.querySelectorAll('.ft_in').forEach(function(elem) {
                       elem.style.display = 'block';
                   });
                   document.querySelector('.ft_in [for="unit_h"]').textContent = val + ' ▾';
                   document.getElementById('hightUnit').value = "ft/in";
               } else {
                   document.querySelectorAll('.ft_in').forEach(function(elem) {
                       elem.style.display = 'none';
                   });
                   document.querySelectorAll('.h_cm').forEach(function(elem) {
                       elem.style.display = 'block';
                   });
                   document.querySelector('.h_cm [for="unit_h_cm"]').textContent = val + ' ▾';
                   document.getElementById('hightUnit').value = "cm";
               }
               
               document.getElementById('unit_ft_in').value = val;
               document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                   elem.classList.toggle('hidden');
               });

       @endisset



            @isset($error)
                var val = document.getElementById('unit_ft_in').value;
                if (val === 'ft/in') {
                    document.querySelectorAll('.h_cm').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.ft_in').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.ft_in [for="unit_h"]').textContent = val + ' ▾';
                } else {
                    document.querySelectorAll('.ft_in').forEach(function(elem) {
                        elem.style.display = 'none';
                    });
                    document.querySelectorAll('.h_cm').forEach(function(elem) {
                        elem.style.display = 'block';
                    });
                    document.querySelector('.h_cm [for="unit_h_cm"]').textContent = val + ' ▾';
                }
            @endisset
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>