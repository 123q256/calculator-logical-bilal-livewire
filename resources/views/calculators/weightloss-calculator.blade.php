<style>
    .highcharts-credits{
        display: none
    }
    .orange-text{
        color: #FF6D00;
    }
    
    .docter{
        color: #856404;
        animation: blinker 2s linear infinite;
    }
    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
    .border-b-black{
        border-bottom: 2px solid #D2D4D8;
    }
</style>
@php
    $request = request();
    $countryName = "Pakistan"; 
    $metricCountries = [
        "United States",
        "Canada",
        "United Kingdom",
        "Pakistan",
    ];
    if(!in_array($countryName,$metricCountries)){
        if (!isset($request->unit_type)) {
            $request->unit_type = "kg";
        }
    }
@endphp
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @unless(isset($detail))

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8  input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
                <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2  gap-4">
                    <div class="space-y-2 relative">
                        <label for="gender" class="font-s-14 text-blue">{!! $lang['83'] !!}:</label>
                        <select name="gender" id="gender" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang["44"],$lang["45"]];
                                $val = ["Male","Female"];
                                optionsList($val,$name,isset(request()->gender)?request()->gender:'Male');
                            @endphp
                        </select>
                    </div>
                    <div class="space-y-2 relative">
                        <label for="age" class="font-s-14 text-blue">{!! $lang['46'] !!}:</label>
                        <input type="number" step="any" name="age" id="age" min="18" max="150" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->age)?request()->age:'25' }}" />
                    </div>
                    <div class="grid grid-cols-2  gap-4">
                        <div class="space-y-2  ft_in {{ in_array($countryName,$metricCountries) ? '' : 'hidden' }}">
                            <label for="height_ft" class="font-s-14 text-blue">{!! $lang['height'] !!}:</label>
                            <input type="number" name="height_ft" id="height_ft" class="input" min="4" max="7" aria-label="input" placeholder="ft" value="{{ isset(request()->height_ft)?request()->height_ft:'5' }}"  />
                        </div>
                        <div class="space-y-2 ft_in {{ in_array($countryName,$metricCountries) ? '' : 'hidden' }}">
                            <label for="height_in" class="font-s-14 text-blue">&nbsp;</label>
                            <input type="text" name="unit_ft_in" value="{{ isset(request()->unit_ft_in)?request()->unit_ft_in:'ft/in' }}" id="unit_ft_in" class="hidden">
                            <div class="relative w-full ">
                                <input type="number" name="height_in" id="height_in" step="any" max="11" min="0" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_in'])?$_POST['height_in']:'8' }}" aria-label="input" placeholder="in" oninput="checkInput()"/>
                                <label for="unit_h" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_dropdown')">{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }} ▾</label>
                                <input type="text" name="unit_h" value="{{ isset($_POST['unit_h'])?$_POST['unit_h']:'ft/in' }}" id="unit_h" class="hidden">
                                <div id="unit_h_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden units_ft_in unit_h" to="unit_h">
                                    <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'ft/in')">feet/inches (ft/in)</p>
                                    <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h', 'cm')">centimeters (cm)</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2 col-span-2  h_cm {{ in_array($countryName,$metricCountries) ? 'hidden' : '' }}">
                            <label for="height_cm" class="font-s-14 text-blue">{{ $lang['height'] }} (cm):</label>
                            <div class="relative w-full ">
                                <input type="number" name="height_cm" id="height_cm" step="any"  min="90" max="245" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['height_cm'])?$_POST['height_cm']:'175.26' }}" aria-label="input" placeholder="in" oninput="checkInput()"/>
                                <label for="unit_h_cm" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_h_cm_dropdown')">{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }} ▾</label>
                                <input type="text" name="unit_h_cm" value="{{ isset($_POST['unit_h_cm'])?$_POST['unit_h_cm']:'ft/in' }}" id="unit_h_cm" class="hidden">
                                <div id="unit_h_cm_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden units_ft_in unit_h_cm" to="unit_h_cm">
                                    <p value="ft/in" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'ft/in')">feet/inches (ft/in)</p>
                                    <p value="cm" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit_h_cm', 'cm')">centimeters (cm)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="hightUnit" id="hightUnit" value="{{ isset(request()->hightUnit) ? request()->hightUnit : (in_array($countryName,$metricCountries) ? 'ft/in' : 'cm') }}">
                    <div class="space-y-2">
                        <label for="weight" class="font-s-14 text-blue">{{ $lang['weight'] }}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="weight" id="weight" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset(request()->weight) ? request()->weight : (in_array($countryName,$metricCountries) ? '158' : '75') }}" aria-label="input" placeholder="00" oninput="checkInput()"
                            @if(request()->unit == 'kg')
                            min="18" max="275"
                            @else
                                min="40" max="600"
                            @endif 
                            />
                            @if (in_array($countryName,$metricCountries))
                                <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'cm' }} ▾</label>
                                <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'lbs' }}" id="unit" class="hidden">
                                <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden units unit" to="unit">
                                    <p value="lbs" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'cm')">pounds (lbs)</p>
                                    <p value="kg" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'kg')">kilograms (kg)</p>
                                </div>
                            @else
                                <label for="unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['unit'])?$_POST['unit']:'kg' }} ▾</label>
                                <input type="text" name="unit" value="{{ isset($_POST['unit'])?$_POST['unit']:'kg' }}" id="unit" class="hidden">
                                <div id="unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden units unit" to="unit">
                                    <p value="kg" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'kg')">kilograms (kg)</p>
                                    <p value="lbs" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('unit', 'cm')">pounds (lbs)</p>
                                </div>
                            @endif
                        </div>
                     </div>

                     <div class="space-y-2">
                        <label for="lose_w" class="font-s-14 text-blue">{!! $lang['49'] !!}:</label>
                        <div class="relative w-full ">
                            <input type="number" name="lose_w" id="lose_w" step="any"  class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset(request()->lose_w) ? request()->lose_w : (in_array($countryName,$metricCountries) ? '130' : '65') }}" aria-label="input" placeholder="00" oninput="checkInput()"
                            @if(request()->unit == 'kg')
                                    min="18" max="275"
                                @else
                                    min="40" max="600"
                                @endif 
                            />
                            @if (in_array($countryName,$metricCountries))
                                <label for="lose_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('lose_unit_dropdown')">{{ isset($_POST['lose_unit'])?$_POST['lose_unit']:'lbs' }} ▾</label>
                                <input type="text" name="lose_unit" value="{{ isset($_POST['lose_unit'])?$_POST['lose_unit']:'lbs' }}" id="lose_unit" class="hidden">
                                <div id="lose_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden units lose_unit" to="lose_unit">
                                    <p value="lbs" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('lose_unit', 'cm')">pounds (lbs)</p>
                                    <p value="kg" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('lose_unit', 'kg')">kilograms (kg)</p>
                                </div>
                            @else
                                <label for="lose_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('unit_dropdown')">{{ isset($_POST['lose_unit'])?$_POST['lose_unit']:'kg' }} ▾</label>
                                <input type="text" name="lose_unit" value="{{ isset($_POST['lose_unit'])?$_POST['lose_unit']:'kg' }}" id="lose_unit" class="hidden">
                                <div id="lose_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 hidden lose_units lose_unit" to="lose_unit">
                                    <p value="kg" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('lose_unit', 'kg')">kilograms (kg)</p>
                                    <p value="lbs" class="p-2 hover:bg-gray-100 cursor-pointer" onclick="setUnit('lose_unit', 'cm')">pounds (lbs)</p>
                                </div>
                            @endif
                        </div>
                     </div>


                    </div>




                    <div class="space-y-2 ">
                        <label for="activity" class="font-s-14 text-blue">{!! $lang['daily_activity'] !!}:</label>
                        <select name="activity" id="activity" class="input">
                            @php
                                $name = ["No sport/exercise","Light activity (sport 1-3 times per week)","Moderate activity (sport 3-5 times per week)","High activity (everyday exercise)","Extreme activity (professional athlete)"];
                                $val = ["0.2","0.375", "0.55", "0.725", "0.9"];
                                optionsList($val,$name,isset(request()->activity)?request()->activity:'0.55');
                            @endphp
                        </select>
                    </div>
                <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-5  gap-4">
                            <div class="col-lg-6 col-12 px-lg-2 row">
                                <label class="my-2" for="by_date" onclick="toggleInputs()">
                                    <input type="radio" class="with-gap" name="choose"  id="by_date" value="by_date" {{ isset($request->choose) && $request->choose !== 'by_date' ? '' : 'checked' }} />
                                    <span class="text-[14px]"><strong>Time to reach your weight goal?</strong></span>
                                </label>
                                <div class="grid grid-cols-2 my-3 lg:grid-cols-2 md:grid-cols-2  gap-4">
                                        <div class="col-6 pe-lg-1 pe-2">
                                            <label for="start" class="font-s-14 text-blue">{!! isset($lang['start'])?$lang['start']:"Start Date" !!}:</label>
                                            <div class="w-100 py-2 position-relative">
                                                <input type="date" name="start" id="start" class="input" aria-label="input"  value="{{ isset(request()->start)?request()->start:date('Y-m-d') }}" {{ isset($request->choose) && $request->choose !== "by_date"?'disabled':'' }} />
                                            </div>
                                        </div>
                                        <div class="col-6 ps-lg-1 ps-2">
                                            <label for="target" class="font-s-14 text-blue">{!! isset($lang['90'])?$lang['90']:"Target Date" !!}:</label>
                                            <div class="w-100 py-2 position-relative">
                                                <input type="date" name="target" id="target" class="input" aria-label="input"  value="{{ isset(request()->target)?request()->target:date('Y-m-d', strtotime('+90 days')) }}" {{ isset($request->choose) && $request->choose !== "by_date"?'disabled':'' }} />
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 px-lg-2 row">
                                <label class="my-2" for="by_calories" onclick="toggleInputs()">
                                    <input type="radio" class="with-gap" name="choose"  id="by_calories" value="by_calories" {{ isset($request->choose) && $request->choose == 'by_calories' ? 'checked' : '' }} />
                                    <span class="font-s-14"><strong>Kcal/day are you ready to reduce?</strong></span>
                                </label>
                                <div class="col-12 mt-3">
                                    <label for="enter_calories" class="label ">Calories:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" name="enter_calories" id="enter_calories" class="input" min="1" aria-label="input" placeholder="00" value="{{ isset($request->enter_calories)?$request->enter_calories:'' }}" {{ isset($request->choose) && $request->choose !== "by_date"?'':'disabled' }} />
                                        <span class="text-blue input_unit">Kcal/day</span>
                                    </div>
                                </div>
                            </div>
                        <style>
                            .custom-alert {
                                color: #721c24;
                                background-color: #f8d7da;
                                padding: 10px 15px;
                                border-radius: 7px;
                            }

                            .custom-alert p{
                                animation: blinker 1s linear infinite;
                            }
                            @keyframes blinker {
                                50% {
                                    opacity: 0;
                                }
                            }
                        </style>
                        <div class="col-12 custom-alert mt-3 hidden" id="alertmsg">
                            <p><strong>Warning</strong>: Your weight loss is faster than healthy limits. Slow down to stay safe and sustainable!</p>
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




    @endunless
    @isset($detail)
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8  result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
                <div class="">
                    <div class=" bg-light-blue result radius-10 p-3 mt-3">
                        @php
                            $submit = $detail['submit'];
                        @endphp
                        <div class="w-full ">
                            @if($detail['from'] === "from_day" || $detail['from'] === "from_pace")
                            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                                    <div class="space-y-2">
                                        <div style="background:#F6FAFC;min-height: 266px"  class="bg-[#F6FAFC] border radius-10 px-3 py-2" >
                                            <p><strong class="text-blue border-b-black-blue font-s-18">{{ $lang[102] }}</strong></p>
                                            <p class="font-s-15 mb-2 mt-3">
                                                <span>{{ $lang[137] }}</span>
                                                <strong>
                                                    @php
                                                        $NewDate = Date('d-M-Y', strtotime("+" . @$detail['days'] . " days"));
                                                        echo $NewDate.'.';
                                                    @endphp
                                                </strong>
                                            </p>
                                            <p class="text-center">
                                                <strong class=" orange-text" style="font-size: 40px">{{ $detail['CaloriesDaily'] }}</strong>
                                                <strong class="text-blue">{{ $lang[103] }}</strong>
                                            </p>
                                        </div>
                                    </div>
                
                                    <div class="space-y-2">
                                        <div style="background:#F6FAFC"  class="bg-[#def4ff] border radius-10 px-3 py-2">
                                            <div class="w-full overflow-auto">
                                                <p class="mb-2"><strong class="text-blue border-b-black-blue font-s-18">{{ $lang[119] }}</strong></p>
                                                <table class="w-full" cellspacing="0">
                                                    <tr>
                                                        <td class="border-b-black py-2">
                                                            <span class="font-s-14">BMR</span>
                                                            <span class="bg-white radius-circle px-2 ms-1" title="{{ $lang[120] }}">?</span>
                                                        </td>
                                                        <td class="text-end border-b-black py-2">
                                                            <strong>{{ $detail['BMR'] }} </strong> <sub>{{ $lang[105] }}</sub>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b-black py-2">
                                                            <span class="font-s-14">BMI</span>
                                                            <span class="bg-white radius-circle px-2 ms-1" title="{{ $lang[123] }}">?</span>
                                                        </td>
                                                        <td class="text-end border-b-black py-2"><strong>{{ $detail['BMI'] }}</strong>
                                                            <sub>Kg/m<sup>2</sup></sub>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b-black py-2">
                                                            <span class="font-s-14">IBW</span>
                                                            <span class="bg-white radius-circle px-2 ms-1" title="{{ $lang[124] }}">?</span>
                                                        </td>
                                                        <td class="text-end border-b-black py-2"><strong>{!! $detail['ibw'] !!}</strong>
                                                        @if(request()->unit_type == 'lbs')
                                                            <sub> lbs</sub>
                                                        @else
                                                            <sub> kg</sub>
                                                        @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2">
                                                            <span class="font-s-14">{{ $lang[125] }}</span>
                                                            <span class="bg-white radius-circle px-2 ms-1" title="{{ $lang[126] }}">?</span>
                                                        </td>
                                                        <td class="text-end py-2">
                                                            <strong>
                                                                @if($detail['you_are'] == 'Underweight')
                                                                    {{ $lang[127] }}
                                                                @elseif($detail['you_are'] == 'Normal Weight')
                                                                    {{ $lang[128] }}
                                                                @elseif($detail['you_are'] == 'Overweight')
                                                                    {{ $lang[129] }}
                                                                @elseif($detail['you_are'] == 'Obesity')
                                                                    {{ $lang[130] }}
                                                                @elseif($detail['you_are'] == 'Severe Obesity')
                                                                    {{ $lang[131] }}
                                                                @endif
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">

                                    <div class="space-y-2">
                                        <div style="background:#F6FAFC ;min-height: 207px"  class="bg-[#F6FAFC] border-2 rounded-lg p-5"  >
                                            <p><strong class="text-blue border-b-black-blue font-s-18">{{ $lang[102] }}</strong></p>
                                            <p class="font-s-15 mt-3 mb-2">
                                                <span>{{ $lang[137] }}</span> <br>
                                                <strong>
                                                    @php
                                                        $NewDate = Date('d-M-Y', strtotime("+" . @$detail['days'] . " days"));
                                                        echo $NewDate.'.';
                                                    @endphp
                                                </strong>
                                            </p>
                                            <div class="text-center">
                                                <strong class="orange-text" style="font-size: 40px">{{ number_format($detail['CaloriesDaily']) }}</strong>
                                                <p class="text-blue"><strong class="text-blue">{{ $lang[103] }}</strong>  <br> <span class="text-blue">&nbsp;</span></p>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="space-y-2">
                                        <div style="background:#F6FAFC;min-height: 266px"  class="bg-[#F6FAFC] border-2 rounded-lg p-5" >
                                            <div class="w-full overflow-auto">
                                                <p class="mb-2"><strong class="text-blue border-b-black-blue font-s-18">{{ $lang[119] }}</strong></p>
                                                <table class="w-full mt-3" cellspacing="0">
                                                    <tr>
                                                        <td class="border-b-black py-2">
                                                            <span class="font-s-14">Basal Metabolic Rate (BMR)</span>
                                                            {{-- <span class="bg-white radius-circle " title="{{ $lang[120] }}">?</span> --}}
                                                        </td>
                                                        <td class="text-end border-b-black py-2">
                                                            <strong>{{ $detail['BMR'] }} </strong> <sub>{{ $lang[105] }}</sub>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b-black py-2">
                                                            <span class="font-s-14">Body Mass Index (BMI)</span>
                                                            {{-- <span class="bg-white radius-circle px-2 ms-1" title="{{ $lang[123] }}">?</span> --}}
                                                        </td>
                                                        <td class="text-end border-b-black py-2"><strong>{{ $detail['BMI'] }}</strong>
                                                            <sub>Kg/m<sup>2</sup></sub>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b-black py-2">
                                                            <span class="font-s-14">Ideal body weight (IBW)</span>
                                                            {{-- <span class="bg-white radius-circle px-2 ms-1" title="{{ $lang[124] }}">?</span> --}}
                                                        </td>
                                                        <td class="text-end border-b-black py-2"><strong>{!! $detail['ibw'] !!}</strong>
                                                        @if(request()->unit_type == 'lbs')
                                                            <sub> lbs</sub>
                                                        @else
                                                            <sub> kg</sub>
                                                        @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 border-b-black">
                                                            <span class="font-s-14">{{ $lang[125] }}</span>
                                                            {{-- <span class="bg-white radius-circle px-2 ms-1" title="{{ $lang[126] }}">?</span> --}}
                                                        </td>
                                                        <td class="text-end py-2 border-b-black">
                                                            <strong>
                                                                @if($detail['you_are'] == 'Underweight')
                                                                    {{ $lang[127] }}
                                                                @elseif($detail['you_are'] == 'Normal Weight')
                                                                    {{ $lang[128] }}
                                                                @elseif($detail['you_are'] == 'Overweight')
                                                                    {{ $lang[129] }}
                                                                @elseif($detail['you_are'] == 'Obesity')
                                                                    {{ $lang[130] }}
                                                                @elseif($detail['you_are'] == 'Severe Obesity')
                                                                    {{ $lang[131] }}
                                                                @endif
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($detail['CaloriesDaily'] <= 1000)
                                    <p class="font-s-15 docter">Consult a doctor if your plan requires consuming less than 1,000 Kcal/day.</p>
                                @endif
                            @endif
                            @if(app()->getLocale() == 'en')
                                <!-- Weight Loss And Weight Gain Table -->
                                <div style="background:#F6FAFC"  class="bg-[#F6FAFC] border radius-10 px-3 py-2 h-100 overflow-auto mt-3">
                                    {{-- <p class="mb-2"><strong class="text-blue border-b-black-blue font-s-18">Calories Intake To Lose Weight</strong></p> --}}
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <td class="border-b-black py-2">Maintain weight</td>
                                            <td class="border-b-black py-2 text-end">
                                                <strong class="font-s-18">{{ number_format($detail['Calories']) }}</strong>
                                                <span class="font-s-14">Calories/Day</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b-black py-2">Mild Weight Loss @if($device == 'mobile') <br> @endif {{ ($submit === "lbs") ? "( 0.5 lb/week )" : "( 0.25 kg/week )"}}</td>
                                            <td class="border-b-black py-2 text-end">
                                                @php
                                                    $calorieReduction = ($submit === "lbs") ? 250 : round((7700 * 0.25) / 7);
                                                @endphp                        
                                                <strong class="font-s-18">{{ number_format($detail['Calories']-$calorieReduction) }}</strong>
                                                <span class="font-s-14">Calories/Day</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b-black py-2">Weight Loss @if($device == 'mobile') <br> @endif {{ ($submit === "lbs") ? "( 1 lb/week )" : "( 0.5 kg/week )"}}</td>
                                            <td class="border-b-black py-2 text-end">
                                                @php $calorieReduction = ($submit === "lbs") ? 500 : round((7700 * 0.5) / 7); @endphp
                                                <strong class="font-s-18">{{ number_format($detail['Calories']-$calorieReduction) }}</strong>
                                                <span class="font-s-14">Calories/Day</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">Extreme Weight Loss @if($device == 'mobile') <br> @endif {{ ($submit === "lbs") ? "( 2 lb/week ) " : "( 1 kg/week )" }}</td>
                                            <td class="py-2 text-end">
                                                @php $calorieReduction = ($submit === "lbs") ? 1000 : round(7700 / 7); @endphp
                                                <strong class="font-s-18">{{ number_format($detail['Calories']-$calorieReduction) }}</strong>
                                                <span class="font-s-14">Calories/Day</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            
                            <!-- Weight Loss Chart -->
                            <div class="row mt-3">
                                <p class="font-s-18 mb-3 ps-lg-3"><strong class="text-blue border-b-black-blue">{{ $lang[132] }}</strong></p>
                                <div  style="background:#F6FAFC" class= "col-12 bg-[#def4ff] radius-10 pb-2">
                                    <div id="container1" style="width:100%; height:370px;margin-top: 15px"></div>
                                </div>
                            </div>
                            
                            <!-- Activities -->
                            <div class="col-12 mt-3">
                                <p class="ps-lg-3"><strong class="text-blue border-b-black-blue font-s-18">{{ $lang[146] }}!</strong></p>
                                <div style="background:#F6FAFC"  class="bg-[#def4ff] border radius-10 p-3 mt-2">
                                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 align-items-center">
                                        <div>  <p><strong class="text-blue">{{ $lang[147] }}</strong></p></div>
                                      
                                        <div >
                                            <div class="col-md-9 ms-auto">
                                                <select name="time_duration" id="time_duration" class="input">
                                                    <option value="1">15 {{ $lang[148] }}</option>
                                                    <option value="2">30 {{ $lang[148] }}</option>
                                                    <option value="3">45 {{ $lang[148] }}</option>
                                                    <option value="4" selected>1 {{ $lang[149] }}</option>
                                                    <option value="5">1 {{ $lang[149] }} 15 {{ $lang[148] }}</option>
                                                    <option value="6">1 {{ $lang[149] }} 30 {{ $lang[148] }}</option>
                                                    <option value="7">1 {{ $lang[149] }} 45 {{ $lang[148] }}</option>
                                                    <option value="8">2 {{ $lang[149] }}s</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 calories_pandran hidden my-3">
                                        @if(count($detail['diff_array_pandran']) > 0)
                                            <div class="col-12 overflow-auto" style="height:300px">
                                                <table class="col-12" cellspacing="0">
                                                    @foreach($detail['final_array_pandran'] as $key => $value)
                                                        <tr>
                                                            @php list($cal_ans, $name_ans, $img_ans) = explode("@@", $value) @endphp
                                                            <td class="col-10 border-b-black border-e py-3 pe-3">{{ $name_ans }}</td>
                                                            <td class="col-2 border-b-black py-3 px-3 pe-lg-0"><strong>{{ $cal_ans }}</strong> kcal</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @else
                                            <p>{{ $lang[150] }}</p>
                                        @endif
                                    </div>
                                    <div class="col-12 calories_adha hidden my-3">
                                        @if(count($detail['diff_array_adha']) > 0)
                                            <div class="col-12 overflow-auto" style="height:300px">
                                                <table class="w-[100%]" cellspacing="0">
                                                    @foreach($detail['final_array_adha'] as $key => $value)
                                                        <tr>
                                                            @php list($cal_ans, $name_ans, $img_ans) = explode("@@", $value) @endphp
                                                            <td class="col-10 border-b-black border-e py-3 pe-3">{{ $name_ans }}</td>
                                                            <td class="col-2 border-b-black py-3 px-3 pe-lg-0"><strong>{{ $cal_ans }}</strong> kcal</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @else
                                            <p>{{ $lang[150] }}</p>
                                        @endif
                                    </div>
                                    <div class="col-12 calories_pona hidden my-3">
                                        @if(count($detail['diff_array_pona']) > 0)
                                            <div class="col-12 overflow-auto" style="height:300px">
                                                <table class="w-[100%]" cellspacing="0">
                                                    @foreach($detail['final_array_pona'] as $key => $value)
                                                        <tr>
                                                            @php list($cal_ans, $name_ans, $img_ans) = explode("@@", $value) @endphp
                                                            <td class="col-10 border-b-black border-e py-3 pe-3">{{ $name_ans }}</td>
                                                            <td class="col-2 border-b-black py-3 px-3 pe-lg-0"><strong>{{ $cal_ans }}</strong> kcal</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @else
                                            <p>{{ $lang[150] }}</p>
                                        @endif
                                    </div>
                                    <div class="col-12 calories_hour my-3">
                                        @if(count($detail['diff_array']) > 0)
                                            <div class="col-12 overflow-auto" style="height:300px">
                                                <table class="w-[100%]" cellspacing="0">
                                                    @foreach($detail['final_array'] as $key => $value)
                                                        <tr>
                                                            @php list($cal_ans, $name_ans, $img_ans) = explode("@@", $value) @endphp
                                                            <td class="col-10 border-b-black border-e py-3 pe-3">{{ $name_ans }}</td>
                                                            <td class="col-2 border-b-black py-3 px-3 pe-lg-0"><strong>{{ $cal_ans }}</strong> kcal</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @else
                                            <p>{{ $lang[150] }}</p>
                                        @endif
                                    </div>
                                    <div class="col-12 calories_sawa hidden my-3">
                                        @if(count($detail['diff_array_sawa']) > 0)
                                            <div class="col-12 overflow-auto" style="height:300px">
                                                <table class="w-[100%]" cellspacing="0">
                                                    @foreach($detail['final_array_sawa'] as $key => $value)
                                                        <tr>
                                                            @php list($cal_ans, $name_ans, $img_ans) = explode("@@", $value) @endphp
                                                            <td class="col-10 border-b-black border-e py-3 pe-3">{{ $name_ans }}</td>
                                                            <td class="col-2 border-b-black py-3 px-3 pe-lg-0"><strong>{{ $cal_ans }}</strong> kcal</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @else
                                            <p>{{ $lang[150] }}</p>
                                        @endif
                                    </div>
                                    <div class="col-12 calories_dher hidden my-3">
                                        @if(count($detail['diff_array_dher']) > 0)
                                            <div class="col-12 overflow-auto" style="height:300px">
                                                <table class="w-[100%]" cellspacing="0">
                                                    @foreach($detail['final_array_dher'] as $key => $value)
                                                        <tr>
                                                            @php list($cal_ans, $name_ans, $img_ans) = explode("@@", $value) @endphp
                                                            <td class="col-10 border-b-black border-e py-3 pe-3">{{ $name_ans }}</td>
                                                            <td class="col-2 border-b-black py-3 px-3 pe-lg-0"><strong>{{ $cal_ans }}</strong> kcal</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @else
                                            <p>{{ $lang[150] }}</p>
                                        @endif
                                    </div>
                                    <div class="col-12 calories_pone hidden my-3">
                                        @if(count($detail['diff_array_pone']) > 0)
                                            <div class="col-12 overflow-auto" style="height:300px">
                                                <table class="w-[100%]" cellspacing="0">
                                                    @foreach($detail['final_array_pone'] as $key => $value)
                                                        <tr>
                                                            @php list($cal_ans, $name_ans, $img_ans) = explode("@@", $value) @endphp
                                                            <td class="col-10 border-b-black border-e py-3 pe-3">{{ $name_ans }}</td>
                                                            <td class="col-2 border-b-black py-3 px-3 pe-lg-0"><strong>{{ $cal_ans }}</strong> kcal</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @else
                                            <p>{{ $lang[150] }}</p>
                                        @endif
                                    </div>
                                    <div class="col-12 calories_do hidden my-3">
                                        @if(count($detail['diff_array_pone']) > 0)
                                            <div class="col-12 overflow-auto" style="height:300px">
                                                <table class="w-[100%]" cellspacing="0">
                                                    @foreach($detail['final_array_do'] as $key => $value)
                                                        <tr>
                                                            @php list($cal_ans, $name_ans, $img_ans) = explode("@@", $value) @endphp
                                                            <td class="col-10 border-b-black border-e py-3 pe-3">{{ $name_ans }}</td>
                                                            <td class="col-2 border-b-black py-3 px-3 pe-lg-0"><strong>{{ $cal_ans }}</strong> kcal</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @else
                                            <p>{{ $lang[150] }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(app()->getLocale() == 'en')
                                <!-- Zigzag Calorie Cycling -->
                                <div class="row mt-3 ">
                                    <p class="mb-2 ps-lg-3"><strong class="text-blue border-b-black-blue font-s-18">Activity Level</strong></p>
                                    <p class="mb-2 ps-lg-3">Besides cutting calories, amp up your activity! See a list of estimated weight loss for different activity levels, based on a daily intake of {{ $detail['Calories'] }} calories.</p>
                                    <div class="col-12 overfl  ow-auto bg-[#F6FAFC] border radius-10 p-3" style="background:#F6FAFC">
                                        {{-- <table class="w-100 " cellspacing="0">
                                            <tr>
                                                <th class="text-start border-b-black py-2 pe-2">Activity Level</th>
                                                <th class="text-start border-b-black py-2 ps-2">Weight lost per week</th>
                                            </tr>
                                            @php $submit_unit = ($submit === "lbs") ? "lbs" : "kg" @endphp
                                            
                                            <tr>
                                                <td class="border-b-black py-2 pe-2">Basal Metabolic Rate (BMR)</td>
                                                <td class="border-b-black py-2 ps-2">{{ $detail['activity_first'] }} {{ $submit_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b-black py-2 pe-2">Sedentary: little or no exercise</td>
                                                <td class="border-b-black py-2 ps-2">{{ $detail['activity_second'] }} {{ $submit_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b-black py-2 pe-2">Light: exercise 1-3 times/week</td>
                                                <td class="border-b-black py-2 ps-2">{{ $detail['activity_third'] }} {{ $submit_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b-black py-2 pe-2">Moderate: exercise 4-5 times/week</td>
                                                <td class="border-b-black py-2 ps-2">{{ $detail['activity_four'] }} {{ $submit_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 pe-2 border-b-black">Active: daily exercise or intense exercise 3-4 times/week</td>
                                                <td class="py-2 ps-2 border-b-black">{{ $detail['activity_five'] }} {{ $submit_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 pe-2 border-b-black">Very Active: intense exercise 6-7 times/week</td>
                                                <td class="py-2 ps-2 border-b-black">{{ $detail['activity_six'] }} {{ $submit_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 pe-2">Extra Active: very intense exercise daily, or physical job</td>
                                                <td class="py-2 ps-2">{{ $detail['activity_seven'] }} {{ $submit_unit }}</td>
                                            </tr>
                                        </table> --}}
                                        <table class="w-100 " cellspacing="0">
                                            <tr>
                                                <th class="text-start border-b-black py-2 pe-2">Activity Level</th>
                                                <th class="text-start border-b-black py-2 ps-2">Weight lost per week</th>
                                            </tr>
                                            @php $submit_unit = ($submit === "lbs") ? "lbs" : "kg" @endphp
                                            
                                            <tr>
                                                <td class="border-b-black py-2 pe-2">No sport/exercise</td>
                                                <td class="border-b-black py-2 ps-2">{{ $detail['activity_first'] }} {{ $submit_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b-black py-2 pe-2">Light activity (sport 1-3 times per week)</td>
                                                <td class="border-b-black py-2 ps-2">{{ $detail['activity_second'] }} {{ $submit_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b-black py-2 pe-2">Moderate activity (sport 3-5 times per week)</td>
                                                <td class="border-b-black py-2 ps-2">{{ $detail['activity_third'] }} {{ $submit_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b-black py-2 pe-2">High activity (everyday exercise)</td>
                                                <td class="border-b-black py-2 ps-2">{{ $detail['activity_four'] }} {{ $submit_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 pe-2 border-b-black">Extreme activity (professional athlete)</td>
                                                <td class="py-2 ps-2 border-b-black">{{ $detail['activity_five'] }} {{ $submit_unit }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-12 text-center mt-[20px]">
                            <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                                @if (app()->getLocale() == 'en')
                                    RESET
                                @else
                                    {{ $lang['reset'] ?? 'RESET' }}
                                @endif
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endisset


    @push('calculatorJS')
    {{-- @if (!isset($detail))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const calculateButton = document.getElementsByName('submit')[0];
                const alertmsg = document.getElementById('alertmsg');
                calculateButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    const currentWeight = parseFloat(document.getElementById('weight').value);
                    const targetWeight = parseFloat(document.getElementById('lose_w').value);
                    const startDate = new Date(document.getElementById('start').value);
                    const targetDate = new Date(document.getElementById('target').value);
                    let currentUnit = document.getElementById("unit").value;
                    let targetUnit = document.getElementById("lose_unit").value;
                    let lose_w_lbs = '';
                    let lose_w_kg = '';
                    if(targetUnit == "lbs"){
                        lose_w_lbs = targetWeight;
                        lose_w_kg = targetWeight / 2.205;
                    }else{
                        lose_w_kg = targetWeight;
                        lose_w_lbs = targetWeight * 2.205;
                    }
                    let weight_lbs='';
                    let weight_kg='';
                    if(currentUnit == "lbs"){
                        weight_lbs = currentWeight;
                        weight_kg = currentWeight / 2.205;
                    }else{
                        weight_kg = currentWeight;
                        weight_lbs = currentWeight * 2.205;
                    }
                    const daysBetween = Math.floor((targetDate - startDate) / (1000 * 60 * 60 * 24));
                    // const weightToLose = currentWeight - targetWeight;
                    const weightToLose = weight_lbs - lose_w_lbs;
                    const maxSafeLoss = daysBetween * 0.29;
                    if (weightToLose > maxSafeLoss) {
                        event.preventDefault();
                        alertmsg.classList.remove('d-none');
                        setTimeout(function() {
                            alertmsg.classList.add('d-none');
                        }, 5000);
                    }
                });
            });
        </script>
    @endif --}}
    @isset($detail)
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script>
            document.getElementById('time_duration').addEventListener('change', function() {
                let macro = this.value;

                document.querySelectorAll('.calories_adha, .calories_pandran, .calories_pona, .calories_hour, .calories_sawa, .calories_dher, .calories_pone, .calories_do').forEach(function(el) {
                    el.style.display = 'none';
                });

                if (macro == '1') {
                    document.querySelector('.calories_pandran').style.display = 'block';
                } else if (macro == '2') {
                    document.querySelector('.calories_adha').style.display = 'block';
                } else if (macro == '3') {
                    document.querySelector('.calories_pona').style.display = 'block';
                } else if (macro == '4') {
                    document.querySelector('.calories_hour').style.display = 'block';
                } else if (macro == '5') {
                    document.querySelector('.calories_sawa').style.display = 'block';
                } else if (macro == '6') {
                    document.querySelector('.calories_dher').style.display = 'block';
                } else if (macro == '7') {
                    document.querySelector('.calories_pone').style.display = 'block';
                } else if (macro == '8') {
                    document.querySelector('.calories_do').style.display = 'block';
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                var myChart = Highcharts.chart('container1', {
                    chart: {
                        type: 'line',
                        backgroundColor: '#F6FAFC'
                    },
                    title: {
                        text: null
                    },
                    xAxis: {
                        title: {
                            text: 'Days'
                        },
                        categories: [
                            @php
                                for ($i = 1; $i <= $detail['days']; $i++) {
                                    $NewDate = Date('d M', strtotime("+" . $i . " day"));
                                    echo "'" . $NewDate . "',";
                                }
                            @endphp
                        ]
                    },
                    yAxis: {
                        title: {
                            text: 'Current Weight'
                        },
                        labels: {
                            formatter: function() {
                                return Math.abs(this.value) + '{{ $detail['submit'] }}';
                            }
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    tooltip: {
                        crosshairs: true,
                        shared: true,
                        valueSuffix: '{{ $detail['submit'] }}'
                    },
                    series: [{
                        name: 'Weight',
                        data: [
                            @php
                                $weight = $detail['ans_weight'];
                                for ($i = 1; $i <= $detail['days']; $i++) {
                                    echo $weight . ",";
                                    $weight = round($weight - $detail['PoundsDaily'], 2);
                                }
                            @endphp
                        ]
                    }]
                });
            });
        </script>
    @endisset
    @if (!isset($detail))
        <script>
            const byDateRadio = document.getElementById("by_date");
            const byCaloriesRadio = document.getElementById("by_calories");
            const startInput = document.getElementById("start");
            const targetInput = document.getElementById("target");
            const enterCaloriesInput = document.getElementById("enter_calories");
            function toggleInputs() {
                if (byDateRadio.checked) {
                    startInput.disabled = false;
                    targetInput.disabled = false;
                    enterCaloriesInput.disabled = true;
                } else if (byCaloriesRadio.checked) {
                    startInput.disabled = true;
                    targetInput.disabled = true;
                    enterCaloriesInput.disabled = false;
                }
            }
            byDateRadio.addEventListener("change", toggleInputs);
            byCaloriesRadio.addEventListener("change", toggleInputs);

            if(document.querySelector('.imperial')){
                document.querySelector('.imperial').addEventListener('click', function() {
                    document.getElementById('unit_type').value = 'lbs';
                    this.classList.add('units_active');
                    document.querySelector('.metric').classList.remove('units_active');
                    document.querySelectorAll('.lbs_or_kg').forEach(function(el) {
                        el.textContent = "lbs";
                    })
                    document.querySelector('.height_ft_in').style.display = 'block';
                    document.querySelector('.height_cm').style.display = 'none';

                    var kg_to_lbs = document.getElementById('weight').value;
                    if (kg_to_lbs !== "") {
                        var input_lbs = Math.round(kg_to_lbs * 2.205);
                        document.getElementById('weight').value = input_lbs;
                    }

                    var kg_to_lbs_lose = document.getElementById('lose_w').value;
                    if (kg_to_lbs_lose !== "") {
                        var input_lbs_lose = Math.round(kg_to_lbs_lose * 2.205);
                        document.getElementById('lose_w').value = input_lbs_lose;
                    }
                });
            }

            if(document.querySelector('.metric')){
                document.querySelector('.metric').addEventListener('click', function() {
                    document.getElementById('unit_type').value = 'kg';
                    this.classList.add('units_active');
                    document.querySelector('.imperial').classList.remove('units_active');
                    document.querySelectorAll('.lbs_or_kg').forEach(function(el) {
                        el.textContent = "kg";
                    })
                    document.querySelector('.height_ft_in').style.display = 'none';
                    document.querySelector('.height_cm').style.display = 'block';

                    var in_to_cm = document.getElementById('ft_in').value;
                    if (in_to_cm !== null) {
                        var input_cm = Math.round(in_to_cm * 2.54);
                        document.getElementById('height_cm').value = input_cm;
                    }

                    var lbs_to_kg = document.getElementById('weight').value;
                    if (lbs_to_kg !== "") {
                        var input_kg = Math.round(lbs_to_kg / 2.205);
                        document.getElementById('weight').value = input_kg;
                    }

                    var kg_to_lbs_lose = document.getElementById('lose_w').value;
                    if (kg_to_lbs_lose !== "") {
                        var input_lbs_lose = Math.round(kg_to_lbs_lose / 2.205);
                        document.getElementById('lose_w').value = input_lbs_lose;
                    }
                });
            }

            if(document.getElementById('from')){
                document.getElementById('from').addEventListener('change', function() {
                    var opt_val = document.getElementById('from').value;
                    if (opt_val == 'from_day') {
                        document.getElementById('target_show').style.display = 'block';
                        document.getElementById('kcal_show').style.display = 'none';
                        document.getElementById('pace_show').style.display = 'none';
                        document.getElementById('kal_day').removeAttribute('required');
                        document.getElementById('pace').removeAttribute('required');
                        document.getElementById('target').setAttribute('required', 'required');
                    } else if (opt_val == 'from_kal') {
                        document.getElementById('kcal_show').style.display = 'block';
                        document.getElementById('target_show').style.display = 'none';
                        document.getElementById('pace_show').style.display = 'none';
                        document.getElementById('target').removeAttribute('required');
                        document.getElementById('pace').removeAttribute('required');
                        document.getElementById('kal_day').setAttribute('required', 'required');
                    } else {
                        document.getElementById('pace_show').style.display = 'block';
                        document.getElementById('target_show').style.display = 'none';
                        document.getElementById('kcal_show').style.display = 'none';
                        document.getElementById('target').removeAttribute('required');
                        document.getElementById('kal_day').removeAttribute('required');
                        document.getElementById('pace').setAttribute('required', 'required');
                    }
                });
            }

            var units_ft_in = document.querySelectorAll('.units_ft_in p');
            units_ft_in.forEach(function(element) {
                element.addEventListener('click', function() {
                    var toAttr = this.closest('.units_ft_in').getAttribute('to');
                    var val = this.getAttribute('value');
                        console.log(val);
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
                    
                    // document.getElementById('unit_ft_in').value = val;
                    // document.querySelectorAll('.' + toAttr).forEach(function(elem) {
                    //     elem.classList.toggle('d-none');
                    // });
                });
            });
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
    @endif
@endpush



</form>