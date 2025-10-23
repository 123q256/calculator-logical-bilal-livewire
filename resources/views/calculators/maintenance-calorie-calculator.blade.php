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
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">


                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="gender" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
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
                                $name = [$lang['2'], $lang['3']];
                                $val = ["Male", "Female"];
                                optionsList($val,$name,isset(request()->gender)?request()->gender:'Male');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">

                    <div class=" mx-auto mt-7  w-full">
                        <input type="hidden" name="unit_type" id="unit_type" value="lbs">
                        <div class="flex flex-wrap items-center bg-green-100 border border-green-500 text-center rounded-lg px-1">
                            <div class="lg:w-1/2 w-full px-2 py-1">
                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial" id="imperial">
                                        {{ $lang['4'] }}
                                </div>
                            </div>
                            <div class="lg:w-1/2 w-full px-2 py-1">
                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric" id="metric">
                                        {{ $lang['5'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="age" class="font-s-14 text-blue">{!! $lang['34'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <input type="number" step="any" name="age" id="age" class="input" aria-label="input" placeholder="00" value="{{ isset(request()->age)?request()->age:'23' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 height_ft_in">
                    <label for="ft_in" class="font-s-14 text-blue">{!! $lang['6'] !!} (ft/in):</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="ft_in" id="ft_in" class="input">
                            @php
                                $name = ["4ft 7in","4ft 8in","4ft 9in","4ft 10in","4ft 11in","5ft 0in","5ft 1in","5ft 2in","5ft 3in","5ft 4in","5ft 5in","5ft 6in","5ft 7in","5ft 8in","5ft 9in","5ft 10in","5ft 11in","6ft 0in","6ft 1in","6ft 2in","6ft 3in","6ft 4in","6ft 5in","6ft 6in","6ft 7in","6ft 8in","6ft 9in","6ft 10in","6ft 11in","7ft 0in"];
                                $val = ["55","56","57","58","59","60","61","62","63","64","65","66","67","68","69","70","71","72","73","74","75","76","77","78","79","80","81","82","83","84"];
                                optionsList($val,$name,isset(request()->ft_in)?request()->ft_in:'69');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 height_cm d-none">
                    <label for="height_cm" class="font-s-14 text-blue">{!! $lang['6'] !!} (cm):</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="height_cm" id="height_cm" class="input" min="1" aria-label="input" placeholder="00" value="{{ isset(request()->height_cm)?request()->height_cm:'185' }}" />
                        <span class="text-blue input_unit">cm</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="weight" class="font-s-14 text-blue">{!! $lang['7'] !!} <span class="text-blue text">(lbs)</span></label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" name="weight" id="weight" class="input" min="1" aria-label="input" placeholder="00" value="{{ isset(request()->weight)?request()->weight:'205' }}" />
                        <span class="text-blue input_unit" id="lbs_or_kg">lbs</span>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="activity" class="font-s-14 text-blue">{!! $lang['8'] !!}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="activity" id="activity" class="input">
                            @php
                                $name = [$lang['9'],$lang['10'],$lang['11'],$lang['12'],$lang['13']];
                                $val = ["Sedentary","Lightly Active","Moderately Active","Very Active","Extremely Active"];
                                optionsList($val,$name,isset(request()->activity)?request()->activity:'Sedentary');
                            @endphp
                        </select>
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-fill mt-3">
                        <div class="col-12">
                            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4 my-4">
                                <div class="col-span-12 border-2">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <div class="mb-3 mb-md-0">
                                            <p><strong class="text-[20px] text-blue-500">{{ $lang['33'] }}</strong></p>
                                            <p>{{ $lang[14] }}.</p>
                                        </div>
                                        <div class="border-s-dark ps-2">
                                            <div><strong class="text-green font-s-25">{{ $detail['Calories'] }}</strong></div>
                                            <div>Kcal/{{ $lang['15'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 border-2">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <div class="mb-3 mb-md-0">
                                            <p><strong class="text-[20px] text-blue-500">BMR</strong></p>
                                            <p>{{ $lang[16] }}.</p>
                                        </div>
                                        <div class="border-s-dark ps-2">
                                            <div><strong class="text-green font-s-25">{{ $detail['BMR'] }}</strong></div>
                                            <div>Kcal/{{ $lang['15'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 border-2">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <div class="mb-3 mb-md-0">
                                            <p><strong class="text-[20px] text-blue-500">RMR</strong></p>
                                            <p>{{ $lang[17] }}.</p>
                                        </div>
                                        <div class="border-s-dark ps-2">
                                            <div><strong class="text-green font-s-25">{{ $detail['rmr'] }}</strong></div>
                                            <div>Kcal/{{ $lang['15'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 border-2">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <div class="mb-3 mb-md-0">
                                            <p><strong class="text-[20px] text-blue-500">BMI</strong></p>
                                            <p>{{ $lang[18] }}.</p>
                                        </div>
                                        <div class="border-s-dark ps-2">
                                            <div><strong class="text-green font-s-25">{{ $detail['BMI'] }}</strong></div>
                                            <div>Kg/m<sup>2</sup></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 border-2">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <div class="mb-3 mb-md-0">
                                            <p><strong class="text-[20px] text-blue-500">IBW</strong></p>
                                            <p>{{ $lang[19] }}.</p>
                                        </div>
                                        <div class="border-s-dark ps-2">
                                            <div><strong class="text-green font-s-25">{{ $detail['ibw'] }}</strong></div>
                                            <div>{{ $detail['submit'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-2"><strong class="text-[20px] text-blue-500">{{ $lang[20] }}</strong></p>
                            <p>{{ $lang[21] }} <strong>{{ $detail['Calories'] }}</strong> Kcal/{{ $lang[15] }}</p>
                            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4 my-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6"><strong class="text-blue-500">{{ $lang[22] }}</strong></div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="col-lg-8 ms-auto">
                                        <select name="macro" id="macro" class="input">
                                            <option value="1" selected>{{ $lang[23] }} - 50C/30P/20F</option>
                                            <option value="2">{{ $lang[24] }} - 40C/40P/20F</option>
                                            <option value="3">{{ $lang[25] }} - 40C/30P/30F</option>
                                            <option value="4">{{ $lang[26] }} - 20C/45P/35F</option>
                                            <option value="5">{{ $lang[27] }} - 5C/25P/70F</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-12  gap-2 md:gap-4 border-2 rounded-xl p-4 lg:gap-4 my-4 bg-[#F6FAFC]" style="border: 1px solid #c1b8b899;">
                                <div class="col-span-12 md:col-span-5 lg:col-span-5 ">
                                    <div class="px-3 border-b-2 py-3">
                                        <div class="mb-2"><strong class="text-blue-500">{{ $lang[29] }}</strong></div>
                                        <div>
                                            <strong class="cbval text-[25px]">{{ $detail['cb'] }}</strong>
                                            <span>{{ $lang[28] }}</span>
                                        </div>
                                    </div>
                                    <div class="px-3 border-b-2 py-3">
                                        <div class="mb-2"><strong class="text-blue-500">{{ $lang[30] }}</strong></div>
                                        <div>
                                            <strong class="poval text-[25px]">{{ $detail['po'] }}</strong>
                                            <span>{{ $lang[28] }}</span>
                                        </div>
                                    </div>
                                    <div class="px-3 pt-3">
                                        <div class="mb-2"><strong class="text-blue-500">{{ $lang[31] }}</strong></div>
                                        <div>
                                            <strong class="fatval text-[25px]">{{ $detail['fat'] }}</strong>
                                            <span>{{ $lang[28] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-1 border-r-2 hidden md:block lg:block">&nbsp;</div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <p class="ps-3"><strong class="text-blue-500 text-[20px]">MACRO</strong></p>
                                    <div id="container2" style="width:100%; height:250px"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center my-[30px]">
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
            if(document.querySelector('.imperial')){
                document.querySelector('.imperial').addEventListener('click', function() {
                    document.getElementById('unit_type').value = 'lbs';
                    this.classList.add('tagsUnit');
                    document.querySelector('.metric').classList.remove('tagsUnit');
                    document.getElementById('lbs_or_kg').textContent = "lbs";
                    document.querySelector('.height_ft_in').style.display = 'block';
                    document.querySelector('.height_cm').style.display = 'none';

                    var kg_to_lbs = document.getElementById('weight').value;
                    if (kg_to_lbs !== "") {
                        var input_lbs = Math.round(kg_to_lbs * 2.205 * 100) / 100; // Fixed rounding to two decimal places
                        document.getElementById('weight').value = input_lbs;
                    }
                });
            }

            if(document.querySelector('.metric')){
                document.querySelector('.metric').addEventListener('click', function() {
                    document.getElementById('unit_type').value = 'kg';
                    this.classList.add('tagsUnit');
                    document.querySelector('.imperial').classList.remove('tagsUnit');
                    document.getElementById('lbs_or_kg').textContent = "kg";
                    document.querySelector('.height_ft_in').style.display = 'none';
                    document.querySelector('.height_cm').style.display = 'block';

                    var in_to_cm = document.getElementById('ft_in').value;
                    if (in_to_cm !== "") {
                        var input_cm = Math.round(in_to_cm * 2.54 * 100) / 100; // Fixed rounding to two decimal places
                        document.getElementById('height_cm').value = input_cm;
                    }

                    var lbs_to_kg = document.getElementById('weight').value;
                    if (lbs_to_kg !== "") {
                        var input_kg = Math.round(lbs_to_kg / 2.205 * 100) / 100; // Fixed rounding to two decimal places
                        document.getElementById('weight').value = input_kg;
                    }
                });
            }

            @isset($detail)
                document.addEventListener('DOMContentLoaded', function() {
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

                var cb = '';
                document.getElementById('macro').addEventListener('change', function(){
                    let cal = "{{ $detail['Calories'] }}";
                    let macro = this.value;

                    function updateMacroValues(fat, po, cb) {
                        document.querySelector('.fatval').textContent = fat;
                        document.querySelector('.poval').textContent = po;
                        document.querySelector('.cbval').textContent = cb;

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

                    if (macro === '1') {
                        let fat = Math.round((cal / 9) * 0.2, 2);
                        let po = Math.round((cal / 4) * 0.3, 2);
                        cb = Math.round((cal / 4) * 0.5, 2);
                        updateMacroValues(fat, po, cb);
                    } else if (macro === '2') {
                        let fat = Math.round((cal / 9) * 0.2, 2);
                        let po = Math.round((cal / 4) * 0.4, 2);
                        cb = Math.round((cal / 4) * 0.4, 2);
                        updateMacroValues(fat, po, cb);
                    } else if (macro === '3') {
                        let fat = Math.round((cal / 9) * 0.3, 2);
                        let po = Math.round((cal / 4) * 0.3, 2);
                        cb = Math.round((cal / 4) * 0.4, 2);
                        updateMacroValues(fat, po, cb);
                    } else if (macro === '4') {
                        let fat = Math.round((cal / 9) * 0.35, 2);
                        let po = Math.round((cal / 4) * 0.45, 2);
                        cb = Math.round((cal / 4) * 0.2, 2);
                        updateMacroValues(fat, po, cb);
                    } else if (macro === '5') {
                        let fat = Math.round((cal / 9) * 0.7, 2);
                        let po = Math.round((cal / 4) * 0.25, 2);
                        cb = Math.round((cal / 4) * 0.05, 2);
                        updateMacroValues(fat, po, cb);
                    }
                });
            @endisset
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>