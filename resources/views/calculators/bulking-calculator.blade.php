<style>
    .highcharts-credits{
        display: none
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @unless(isset($detail))

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[90%] md:w-[90%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6"></div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <div class=" mx-auto mt-2  w-full">
                            <input type="hidden" name="unit_type" id="unit_type" value="imperial">
                            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                                <div class="lg:w-1/2 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial" id="imperial">
                                            {{ $lang['imperial'] }}
                                    </div>
                                </div>
                                <div class="lg:w-1/2 w-full px-2 py-1">
                                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric" id="metric">
                                            {{ $lang['metric'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="gender" class="label">{!! $lang['gender'] !!}:</label>
                    <div class="w-100 py-2 relative">
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
                                $name = [$lang["male"],$lang["female"]];
                                $val = ["Male","Female"];
                                optionsList($val,$name,isset(request()->gender)?request()->gender:'Male');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="age" class="label">{!! $lang['your_age'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->age)?request()->age:'25' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 ft_in">
                    <label for="height_ft" class="label">{!! $lang['height'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="height_ft" id="height_ft" class="input">
                            @php
                                $name = ["4ft 7in", "4ft 8in", "4ft 9in", "4ft 10in", "4ft 11in", "5ft 0in", "5ft 1in", "5ft 2in", "5ft 3in", "5ft 4in", "5ft 5in", "5ft 6in", "5ft 7in", "5ft 8in", "5ft 9in", "5ft 10in", "5ft 11in", "6ft 0in", "6ft 1in", "6ft 2in", "6ft 3in", "6ft 4in", "6ft 5in", "6ft 6in", "6ft 7in", "6ft 8in", "6ft 9in", "6ft 10in", "6ft 11in", "7ft 0in"];
                                $val = ["55", "56", "57", "58", "59", "60", "61", "62", "63", "64", "65", "66", "67", "68", "69", "70", "71", "72", "73", "74", "75", "76", "77", "78", "79", "80", "81", "82", "83", "84"];
                                optionsList($val,$name,isset(request()->height_ft)?request()->height_ft:'68');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 change_h_u hidden">
                    <label for="height_cm" class="label">{!! $lang['height'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="height_cm" id="height_cm" class="input" min="1" aria-label="input" placeholder="00" value="{{ isset(request()->height_cm)?request()->height_cm:'175.26' }}" />
                        <span class=" input_unit">cm</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="weight" class="label">{!! $lang['weight'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="weight" id="weight" class="input" min="1" aria-label="input" placeholder="00" value="{{ isset(request()->weight)?request()->weight:'170' }}" />
                        <span class=" input_unit text">lbs</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="weight1" class="label">{!! $lang['i_want'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="weight1" id="weight1" class="input" min="1" aria-label="input" placeholder="00" value="{{ isset(request()->weight1)?request()->weight1:'10' }}" />
                        <span class=" input_unit text">lbs</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="activity" class="label">{!! $lang['daily_activity'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select name="activity" id="activity" class="input">
                            @php
                                $name = [$lang['No_sport'],$lang['Light_activity'],$lang['Moderate_activity'],$lang['High_activity'],$lang['Extreme_activity']];
                                $val = ["sedentary", "Lightly_Active", "Moderately_Active", "Very_Active", "ext"];
                                optionsList($val,$name,isset(request()->activity)?request()->activity:'sedentary');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="surplus" class="label">{!! $lang['48'] !!}:</label>
                            <div class="w-100 py-2 relative">
                                <select name="surplus" id="surplus" class="input">
                                    @php
                                        $name = [$lang['49'],$lang['50'],$lang['51'],$lang['52']];
                                        $val = ["0.10", "0.15", "0.20", "custom"];
                                        optionsList($val,$name,isset(request()->surplus)?request()->surplus:'0.10');
                                    @endphp
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 surplus hidden">
                    <div class="col-12 ps-2 mt-2">
                        <p class="font-s-14 pe-2 pe-lg-3 mb-1"><strong>{{ $lang['53'] }}: </strong></p>
                        <input type="radio" name="stype" class="custom_cals" id="Incal" value="Incal" checked {{ isset(request()->stype) && request()->stype === 'Incal' ? 'checked' : '' }}>
                        <label for="Incal" class="label pe-lg-3 pe-2">{{ $lang['54'] }}:</label>
                        <input type="radio" name="stype" class="custom_cals" id="per_calorie" value="per_cal" {{ isset(request()->stype) && request()->stype === 'per_cal' ? 'checked' : '' }}>
                        <label for="per_calorie" class="label">{{ $lang['55'] }}:</label>
                    </div>
                    <div class="w-100 py-2 relative kal_day">
                        <input type="number" step="any" name="kal_day" id="kal_day" class="input" min="1" aria-label="input" placeholder="00" value="{{ isset(request()->kal_day)?request()->kal_day:request()->kal_day }}" />
                        <span class=" input_unit">kcal/day</span>
                    </div>
                    <div class="w-100 py-2 relative hidden" id="pre_cal">
                        <input type="number" step="any" name="per_cal" id="per_cal" class="input" min="1" aria-label="input" placeholder="00" value="{{ isset(request()->per_cal)?request()->per_cal:request()->kal_day }}" />
                        <span class=" input_unit">%</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <div class="grid grid-cols-12  ">
                        <div class="col-span-12 my-2"><strong class="text-blue-500">{{ $lang['to_achieve'] }}?</strong></div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="start" class="label">{!! $lang['41'] !!}</label>
                                <div class="w-100 py-2 relative">
                                <input type="date" name="start" id="start" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->start)?request()->start:'' }}" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="target" class="label">{!! $lang['42'] !!}</label>
                            <div class="w-100 py-2 relative">
                                <input type="date" name="target" id="target" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->target)?request()->target:'' }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 body_percent" style="padding-top:{{ ($device === 'desktop') ? '34px' : '0' }}">
                    <label for="percent" class="label">
                        {!! $lang['body_fat'] !!}
                        <a title="Body Fat Percentage Calculator" href="{{ url('body-fat-percentage-calculator') }}/" class="underline" target="_blank" rel="noopener"> {{ $lang['click'] }}</a>:
                    </label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="percent" id="percent" class="input" aria-label="input" placeholder="0%" value="{{ isset(request()->percent)?request()->percent:'' }}" />
                        <span class=" input_unit">%</span>
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

    @endunless
    @isset($detail)
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full p-3 mt-3">
                        <div class="w-full">
                            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <div><strong class="text-[20px] text-blue-500">{{ $lang['39'] }}</strong></div>
                                        <div class="border-s-dark ps-2">
                                            <div><strong class="text-green-500 text-[25px]">{{ $detail['CaloriesDaily'] }}</strong></div>
                                            <div>{{ $lang['c/d'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <div><strong class="text-[20px] text-blue-500">{{ $lang['11'] }}</strong></div>
                                        <div class="border-s-dark ps-2">
                                            <div><strong class="text-green-500 text-[25px]">{{ $detail['CaloriesLess'] }}</strong></div>
                                            <div>{{ $lang['c/d'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 ">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <div class="border-end pe-2 pe-lg-3">
                                            <div class="mb-1"><strong class="text-[20px] text-blue-500">{{ $lang['22'] }}</strong></div>
                                            <div>{{ $lang['56'] }}</div>
                                        </div>
                                        <div class="ps-2 ps-lg-3">
                                            <div><strong class="text-green-500 text-[25px]">{{ $detail['BMR'] }}</strong></div>
                                            <div>{{ $lang['c/d'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 border">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <div class="border-end pe-2 pe-lg-3">
                                            <div class="mb-1"><strong class="text-[20px] text-blue-500">TDEE</strong></div>
                                            <div>{{ $lang['57'] }}</div>
                                        </div>
                                        <div class="ps-2 ps-lg-3">
                                            <div><strong class="text-green-500 text-[25px]">{{ $detail['Calories'] }}</strong></div>
                                            <div>{{ $lang['c/d'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <div><strong class="text-[20px] text-blue-500">{{ $lang['40'] }}</strong></div>
                                        <div class="border-s-dark ps-2 ps-lg-3">
                                            <div><strong class="text-green-500 text-[25px]">{{ $detail['days'] }}</strong></div>
                                            <div>{{ $lang['1'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6 ">
                                    <div class="d-flex align-items-center justify-content-between bg-[#F6FAFC] border radius-10 px-3 py-3" style="min-height:64px;border: 1px solid #c1b8b899;">
                                        <div><strong class="text-[20px] text-blue-500">{{ $lang['Target_Date'] }}</strong></div>
                                        <div class="border-s-dark ps-2">
                                            <div>
                                                <strong class="text-green-500 text-[25px]">
                                                    @php $NewDate = Date('d-M-Y', strtotime("+" . @$detail['days'] . " days")) @endphp
                                                    {{ $NewDate }}
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-2"><strong class="text-[20px] text-blue-500">{{ $lang[58] }}</strong></p>
                            <p class="">{{ $lang[59] }}</p>
                            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4 my-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6"><strong class="text-blue-500">{{ $lang[60] }}</strong></div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="w-full ms-auto">
                                        <select name="macro" id="macro" class="input">
                                            <option value="1" selected>{{ $lang[61] }}</option>
                                            <option value="2">{{ $lang[62] }}</option>
                                            <option value="3">{{ $lang[63] }}</option>
                                            <option value="4">{{ $lang[64] }}</option>
                                            <option value="5">{{ $lang[65] }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mx-auto" >
                                <div class="flex  items-center justify-between bg-[#F6FAFC] border rounded p-3" style="border: 1px solid #c1b8b899;">
                                    <div class="px-3">
                                        <div class="mb-1"><strong class="text-blue-500">{{ $lang[44] }}</strong></div>
                                        <div>
                                            <strong class="cbval font-s-25">{{ $detail['cb'] }}</strong>
                                            <span>{{ $lang[45] }}</span>
                                        </div>
                                    </div>
                                    <div class="border-md-end py-2">&nbsp;</div>
                                    <div class="px-3">
                                        <div class="mb-1"><strong class="text-blue-500">{{ $lang[46] }}</strong></div>
                                        <div>
                                            <strong class="poval font-s-25">{{ $detail['po'] }}</strong>
                                            <span>{{ $lang[45] }}</span>
                                        </div>
                                    </div>
                                    <div class="border-md-end py-2">&nbsp;</div>
                                    <div class="px-3">
                                        <div class="mb-1"><strong class="text-blue-500">{{ $lang[47] }}</strong></div>
                                        <div>
                                            <strong class="fatval font-s-25">{{ $detail['fat'] }}</strong>
                                            <span>{{ $lang[45] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($detail['HighRiskCalories'] == '1')
                                <p class="text-[18px] col s12 padding_10">
                                    <strong class="red-text">{{ $lang['3'] }}!</strong>
                                    {{ $lang['4'] }} {{ @$detail['CaloriesLess'] }} {{ $lang['c/d'] }} , {{ $lang['5'] }}
                                    {{ @$detail['CaloriesDaily'] }} {{ $lang['6'] }}!
                                </p>
                            @endif
                            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4 my-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <p class="ps-3"><strong class="text-blue-500 text-[20px]">{{ $lang['10'] }}</strong></p>
                                    <div id="container1" class="mt-3" style="width:100%; height:250px"></div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6 border-l">
                                    <p class="ps-3"><strong class="text-blue-500 text-[20px]">MACRO</strong></p>
                                    <div id="container2" style="width:100%; height:250px"></div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full text-center my-[30px]">
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
        @isset($detail)
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/highcharts-more.js"></script>
        @endisset
        <script>
            @if(!isset($detail))
                @php $NewDate = Date('Y-m-d', strtotime("+ 90 days")) @endphp
                document.getElementById("start").defaultValue = "{{ date('Y-m-d') }}";
                document.getElementById("target").defaultValue = "{{ $NewDate }}";
            @endif

            document.querySelectorAll('.custom_cals').forEach(function(element) {
                element.addEventListener('click', function() {
                    var stype = this.getAttribute("value");
                    if (stype == 'Incal') {
                        document.querySelectorAll('.kal_day').forEach(function(item) {
                            item.style.display = 'block';
                        });
                        document.getElementById('pre_cal').style.display = 'none';
                    } else {
                        document.querySelectorAll('.kal_day').forEach(function(item) {
                            item.style.display = 'none';
                        });
                        document.getElementById('pre_cal').style.display = 'block';
                    }
                });
            });

            let surplus = document.getElementById('surplus')
            if(surplus){
                document.getElementById('surplus').addEventListener('change', function() {
                    var surplus = this.value;
                    if (surplus == 'custom') {
                        document.querySelectorAll('.surplus').forEach(function(element) {
                            element.style.display = 'block';
                        });
                        document.querySelectorAll('.body_percent').forEach(function(element) {
                            element.style.paddingTop = '0';
                        });
                    } else {
                        document.querySelectorAll('.surplus').forEach(function(element) {
                            element.style.display = 'none';
                        });
                        var device = "{{ $device }}";
                        document.querySelectorAll('.body_percent').forEach(function(element) {
                            if (device === 'desktop') {
                                element.style.paddingTop = '34px';
                            } else {
                                element.style.paddingTop = '0';
                            }
                        });
                    }
                });
            }

            document.querySelectorAll('.imperial').forEach(function(element) {
                element.addEventListener('click', function() {
                    document.getElementById('unit_type').value = 'imperial';
                    document.querySelectorAll('.ft_in').forEach(function(item) {
                        item.style.display = 'block';
                    });
                    document.querySelectorAll('.change_h_u').forEach(function(item) {
                        item.style.display = 'none';
                    });
                    document.querySelectorAll('.imperial').forEach(function(item) {
                        item.classList.add('tagsUnit');
                    });
                    document.querySelectorAll('.metric').forEach(function(item) {
                        item.classList.remove('tagsUnit');
                    });
                    document.querySelectorAll('.text').forEach(function(item) {
                        item.textContent = 'lbs';
                    });
                });
            });

            document.querySelectorAll('.metric').forEach(function(element) {
                element.addEventListener('click', function() {
                    document.getElementById('unit_type').value = 'metric';
                    document.querySelectorAll('.ft_in').forEach(function(item) {
                        item.style.display = 'none';
                    });
                    document.querySelectorAll('.change_h_u').forEach(function(item) {
                        item.style.display = 'block';
                    });
                    document.querySelectorAll('.metric').forEach(function(item) {
                        item.classList.add('tagsUnit');
                    });
                    document.querySelectorAll('.imperial').forEach(function(item) {
                        item.classList.remove('tagsUnit');
                    });
                    document.querySelectorAll('.text').forEach(function(item) {
                        item.textContent = 'kg';
                    });
                });
            });

            @isset($error)
                let val = "{{ request()->unit_type }}"
                if(val === 'imperial'){
                    document.querySelectorAll('.ft_in').forEach(function(item) {
                        item.style.display = 'block';
                    });
                    document.querySelectorAll('.change_h_u').forEach(function(item) {
                        item.style.display = 'none';
                    });
                    document.querySelectorAll('.imperial').forEach(function(item) {
                        item.classList.add('tagsUnit');
                    });
                    document.querySelectorAll('.metric').forEach(function(item) {
                        item.classList.remove('tagsUnit');
                    });
                    document.querySelectorAll('.text').forEach(function(item) {
                        item.textContent = 'lbs';
                    });
                }else{
                    document.querySelectorAll('.ft_in').forEach(function(item) {
                        item.style.display = 'none';
                    });
                    document.querySelectorAll('.change_h_u').forEach(function(item) {
                        item.style.display = 'block';
                    });
                    document.querySelectorAll('.metric').forEach(function(item) {
                        item.classList.add('tagsUnit');
                    });
                    document.querySelectorAll('.imperial').forEach(function(item) {
                        item.classList.remove('tagsUnit');
                    });
                    document.querySelectorAll('.text').forEach(function(item) {
                        item.textContent = 'kg';
                    });
                }
                val = "{{ request()->stype }}"
                if (val == 'Incal') {
                    document.querySelectorAll('.kal_day').forEach(function(item) {
                        item.style.display = 'block';
                    });
                    document.getElementById('pre_cal').style.display = 'none';
                } else {
                    document.querySelectorAll('.kal_day').forEach(function(item) {
                        item.style.display = 'none';
                    });
                    document.getElementById('pre_cal').style.display = 'block';
                }
                val = document.getElementById('surplus').value
                if (val == 'custom') {
                    document.querySelectorAll('.surplus').forEach(function(element) {
                        element.style.display = 'block';
                    });
                    document.querySelectorAll('.body_percent').forEach(function(element) {
                        element.style.paddingTop = '0';
                    });
                } else {
                    document.querySelectorAll('.surplus').forEach(function(element) {
                        element.style.display = 'none';
                    });
                    var device = "{{ $device }}";
                    document.querySelectorAll('.body_percent').forEach(function(element) {
                        if (device === 'desktop') {
                            element.style.paddingTop = '34px';
                        } else {
                            element.style.paddingTop = '0';
                        }
                    });
                }
            @endisset

            @isset($detail)
                var cb = '';
                document.getElementById('macro').addEventListener('change', function() {
                    let cal = "{{ $detail['CaloriesDaily'] }}";
                    let macro = this.value;
                    if (macro == '1') {
                        let fat = Math.round((cal / 9) * 0.2);
                        let po = Math.round((cal / 4) * 0.3);
                        let cb = Math.round((cal / 4) * 0.5);
                        document.querySelectorAll('.fatval').forEach(function(element) {
                            element.textContent = fat;
                        });
                        document.querySelectorAll('.poval').forEach(function(element) {
                            element.textContent = po;
                        });
                        document.querySelectorAll('.cbval').forEach(function(element) {
                            element.textContent = cb;
                        });
                        Highcharts.chart('container2', {
                            chart: {
                                type: 'column',
                                inverted: true,
                                polar: true,
                                backgroundColor: 'transparent'
                            },
                            title: {
                                text: null
                            },
                            tooltip: {
                                outside: true
                            },
                            pane: {
                                size: '85%',
                                innerSize: '20%',
                                endAngle: 270
                            },
                            xAxis: {
                                tickInterval: 1,
                                labels: {
                                    align: 'right',
                                    useHTML: true,
                                    allowOverlap: true,
                                    step: 1,
                                    y: 3,
                                    style: {
                                        fontSize: '13px'
                                    }
                                },
                                lineWidth: 0,
                                categories: ['']
                            },
                            yAxis: {
                                crosshair: {
                                    enabled: true,
                                    color: '#333'
                                },
                                lineWidth: 0,
                                tickInterval: 25,
                                reversedStacks: false,
                                endOnTick: true,
                                showLastLabel: true
                            },
                            plotOptions: {
                                column: {
                                    stacking: 'normal',
                                    borderWidth: 0,
                                    pointPadding: 0,
                                    groupPadding: 0.15
                                }
                            },
                            series: [{
                                name: 'CARBS',
                                color: '#623a6c',
                                data: [cb]
                            }, {
                                name: 'PROTEIN',
                                color: '#b04c7a',
                                data: [po]
                            }, {
                                name: 'FATS',
                                color: '#e06f85',
                                data: [fat]
                            }]
                        });
                    } else if (macro == '2') {
                        let fat = Math.round((cal / 9) * 0.2);
                        let po = Math.round((cal / 4) * 0.4);
                        let cb = Math.round((cal / 4) * 0.4);
                        document.querySelectorAll('.fatval').forEach(function(element) {
                            element.textContent = fat;
                        });
                        document.querySelectorAll('.poval').forEach(function(element) {
                            element.textContent = po;
                        });
                        document.querySelectorAll('.cbval').forEach(function(element) {
                            element.textContent = cb;
                        });
                        Highcharts.chart('container2', {
                            chart: {
                                type: 'column',
                                inverted: true,
                                polar: true,
                                backgroundColor: 'transparent'
                            },
                            title: {
                                text: null
                            },
                            tooltip: {
                                outside: true
                            },
                            pane: {
                                size: '85%',
                                innerSize: '20%',
                                endAngle: 270
                            },
                            xAxis: {
                                tickInterval: 1,
                                labels: {
                                    align: 'right',
                                    useHTML: true,
                                    allowOverlap: true,
                                    step: 1,
                                    y: 3,
                                    style: {
                                        fontSize: '13px'
                                    }
                                },
                                lineWidth: 0,
                                categories: ['']
                            },
                            yAxis: {
                                crosshair: {
                                    enabled: true,
                                    color: '#333'
                                },
                                lineWidth: 0,
                                tickInterval: 25,
                                reversedStacks: false,
                                endOnTick: true,
                                showLastLabel: true
                            },
                            plotOptions: {
                                column: {
                                    stacking: 'normal',
                                    borderWidth: 0,
                                    pointPadding: 0,
                                    groupPadding: 0.15
                                }
                            },
                            series: [{
                                name: 'CARBS',
                                color: '#623a6c',
                                data: [cb]
                            }, {
                                name: 'PROTEIN',
                                color: '#b04c7a',
                                data: [po]
                            }, {
                                name: 'FATS',
                                color: '#e06f85',
                                data: [fat]
                            }]
                        });
                    } else if (macro == '3') {
                        let fat = Math.round(((cal / 9) * 0.3 * 100) / 100);
                        let po = Math.round(((cal / 4) * 0.3 * 100) / 100);
                        let cb = Math.round(((cal / 4) * 0.4 * 100) / 100);
                        document.querySelectorAll('.fatval').forEach(function(element) {
                            element.textContent = fat;
                        });
                        document.querySelectorAll('.poval').forEach(function(element) {
                            element.textContent = po;
                        });
                        document.querySelectorAll('.cbval').forEach(function(element) {
                            element.textContent = cb;
                        });
                        Highcharts.chart('container2', {
                            chart: {
                                type: 'column',
                                inverted: true,
                                polar: true,
                                backgroundColor: 'transparent'
                            },
                            title: {
                                text: null
                            },
                            tooltip: {
                                outside: true
                            },
                            pane: {
                                size: '85%',
                                innerSize: '20%',
                                endAngle: 270
                            },
                            xAxis: {
                                tickInterval: 1,
                                labels: {
                                    align: 'right',
                                    useHTML: true,
                                    allowOverlap: true,
                                    step: 1,
                                    y: 3,
                                    style: {
                                        fontSize: '13px'
                                    }
                                },
                                lineWidth: 0,
                                categories: ['']
                            },
                            yAxis: {
                                crosshair: {
                                    enabled: true,
                                    color: '#333'
                                },
                                lineWidth: 0,
                                tickInterval: 25,
                                reversedStacks: false,
                                endOnTick: true,
                                showLastLabel: true
                            },
                            plotOptions: {
                                column: {
                                    stacking: 'normal',
                                    borderWidth: 0,
                                    pointPadding: 0,
                                    groupPadding: 0.15
                                }
                            },
                            series: [{
                                name: 'CARBS',
                                color: '#623a6c',
                                data: [cb]
                            }, {
                                name: 'PROTEIN',
                                color: '#b04c7a',
                                data: [po]
                            }, {
                                name: 'FATS',
                                color: '#e06f85',
                                data: [fat]
                            }]
                        });
                    } else if (macro == '4') {
                        let fat = Math.round(((cal / 9) * 0.35 * 100) / 100);
                        let po = Math.round(((cal / 4) * 0.45 * 100) / 100);
                        let cb = Math.round(((cal / 4) * 0.2 * 100) / 100);
                        document.querySelectorAll('.fatval').forEach(function(element) {
                            element.textContent = fat;
                        });
                        document.querySelectorAll('.poval').forEach(function(element) {
                            element.textContent = po;
                        });
                        document.querySelectorAll('.cbval').forEach(function(element) {
                            element.textContent = cb;
                        });
                        Highcharts.chart('container2', {
                            chart: {
                                type: 'column',
                                inverted: true,
                                polar: true,
                                backgroundColor: 'transparent'
                            },
                            title: {
                                text: null
                            },
                            tooltip: {
                                outside: true
                            },
                            pane: {
                                size: '85%',
                                innerSize: '20%',
                                endAngle: 270
                            },
                            xAxis: {
                                tickInterval: 1,
                                labels: {
                                    align: 'right',
                                    useHTML: true,
                                    allowOverlap: true,
                                    step: 1,
                                    y: 3,
                                    style: {
                                        fontSize: '13px'
                                    }
                                },
                                lineWidth: 0,
                                categories: ['']
                            },
                            yAxis: {
                                crosshair: {
                                    enabled: true,
                                    color: '#333'
                                },
                                lineWidth: 0,
                                tickInterval: 25,
                                reversedStacks: false,
                                endOnTick: true,
                                showLastLabel: true
                            },
                            plotOptions: {
                                column: {
                                    stacking: 'normal',
                                    borderWidth: 0,
                                    pointPadding: 0,
                                    groupPadding: 0.15
                                }
                            },
                            series: [{
                                name: 'CARBS',
                                color: '#623a6c',
                                data: [cb]
                            }, {
                                name: 'PROTEIN',
                                color: '#b04c7a',
                                data: [po]
                            }, {
                                name: 'FATS',
                                color: '#e06f85',
                                data: [fat]
                            }]
                        });
                    } else if (macro == '5') {
                        let fat = Math.round(((cal / 9) * 0.7 * 100) / 100);
                        let po = Math.round(((cal / 4) * 0.25 * 100) / 100);
                        let cb = Math.round(((cal / 4) * 0.05 * 100) / 100);
                        document.querySelectorAll('.fatval').forEach(function(element) {
                            element.textContent = fat;
                        });
                        document.querySelectorAll('.poval').forEach(function(element) {
                            element.textContent = po;
                        });
                        document.querySelectorAll('.cbval').forEach(function(element) {
                            element.textContent = cb;
                        });
                        Highcharts.chart('container2', {
                            chart: {
                                type: 'column',
                                inverted: true,
                                polar: true,
                                backgroundColor: 'transparent'
                            },
                            title: {
                                text: null
                            },
                            tooltip: {
                                outside: true
                            },
                            pane: {
                                size: '85%',
                                innerSize: '20%',
                                endAngle: 270
                            },
                            xAxis: {
                                tickInterval: 1,
                                labels: {
                                    align: 'right',
                                    useHTML: true,
                                    allowOverlap: true,
                                    step: 1,
                                    y: 3,
                                    style: {
                                        fontSize: '13px'
                                    }
                                },
                                lineWidth: 0,
                                categories: ['']
                            },
                            yAxis: {
                                crosshair: {
                                    enabled: true,
                                    color: '#333'
                                },
                                lineWidth: 0,
                                tickInterval: 25,
                                reversedStacks: false,
                                endOnTick: true,
                                showLastLabel: true
                            },
                            plotOptions: {
                                column: {
                                    stacking: 'normal',
                                    borderWidth: 0,
                                    pointPadding: 0,
                                    groupPadding: 0.15
                                }
                            },
                            series: [{
                                name: 'CARBS',
                                color: '#623a6c',
                                data: [cb]
                            }, {
                                name: 'PROTEIN',
                                color: '#b04c7a',
                                data: [po]
                            }, {
                                name: 'FATS',
                                color: '#e06f85',
                                data: [fat]
                            }]
                        });
                    }
                });
                document.addEventListener('DOMContentLoaded', function() {
                    var myChart = Highcharts.chart('container1', {
                        chart: {
                            type: 'line',
                            backgroundColor: 'transparent'
                        },
                        title: {
                            text: null
                        },
                        xAxis: {
                            title: {
                                text: '{{ $lang['1'] }}',
                            },
                            categories: [
                                @php
                                    $today = date('');
                                    for ($i = 1; $i <= $detail['days']; $i++) {
                                        $NewDate = Date('d M', strtotime("+" . $i . " day"));
                                        echo "'" . $NewDate . "',";
                                    }
                                @endphp
                            ]
                        },
                        yAxis: {
                            title: {
                                text: '{{ $lang['weight'] }}'
                            },
                            labels: {
                                formatter: function() {
                                    return Math.abs(this.value);
                                }
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        tooltip: {
                            crosshairs: true,
                            shared: true,
                        },
                        series: [{
                            name: 'Weight',
                            color: '#623a6c',
                            data: [
                                @php
                                    $weight = request()->weight;
                                    for ($i = 1; $i <= $detail['days']; $i++) {
                                        echo $weight . ",";
                                        if ($detail['want'] === '2') {
                                            $weight = round($weight + $detail['PoundsDaily'], 2);
                                        }
                                    }
                                @endphp
                            ]
                        }]
                    });
                    Highcharts.chart('container2', {
                        chart: {
                            type: 'column',
                            inverted: true,
                            polar: true,
                            backgroundColor: 'transparent'
                        },
                        title: {
                            text: null
                        },
                        tooltip: {
                            outside: true
                        },
                        pane: {
                            size: '85%',
                            innerSize: '20%',
                            endAngle: 270
                        },
                        xAxis: {
                            tickInterval: 1,
                            labels: {
                                align: 'right',
                                useHTML: true,
                                allowOverlap: true,
                                step: 1,
                                y: 3,
                                style: {
                                    fontSize: '13px'
                                }
                            },
                            lineWidth: 0,
                            categories: ['']
                        },
                        yAxis: {
                            crosshair: {
                                enabled: true,
                                color: '#333'
                            },
                            lineWidth: 0,
                            tickInterval: 25,
                            reversedStacks: false,
                            endOnTick: true,
                            showLastLabel: true
                        },
                        plotOptions: {
                            column: {
                                stacking: 'normal',
                                borderWidth: 0,
                                pointPadding: 0,
                                groupPadding: 0.15
                            }
                        },
                        series: [{
                            name: 'CARBS',
                            color: '#623a6c',
                            data: [{{ $detail['cb'] }}]
                        }, {
                            name: 'PROTEIN',
                            color: '#b04c7a',
                            data: [{{ $detail['po'] }}]
                        }, {
                            name: 'FATS',
                            color: '#e06f85',
                            data: [{{ $detail['fat'] }}]
                        }]
                    });
                });
            @endisset
        </script>
    @endpush
</form>