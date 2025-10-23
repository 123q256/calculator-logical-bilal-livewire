<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
        <div class="col-12  mx-auto mt-2 w-full">
            <input type="hidden" name="unit_type" id="unit_type" value="one">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/3 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit one" id="one">
                            {{ $lang['1'] }}
                    </div>
                </div>
                <div class="lg:w-1/3 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white two" id="two">
                            {{ $lang['2'] }}
                    </div>
                </div>
                <div class="lg:w-1/3 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric three" id="three">
                            {{ $lang['3'] }}
                    </div>
                </div>
            </div>
        </div>
      
            <div class="grid grid-cols-12 mt-3  gap-4">
            <div class="col-span-12" id="first">
                <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="starting_first" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="starting_first" id="starting_first" class="input"
                            aria-label="input" placeholder="100"
                            value="{{ isset($_POST['starting_first']) ? $_POST['starting_first'] : '100' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="ending_first" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="ending_first" id="ending_first" class="input"
                            aria-label="input" placeholder="1000"
                            value="{{ isset($_POST['ending_first']) ? $_POST['ending_first'] : '1000' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="years_first" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="years_first" id="years_first" class="input"
                            aria-label="input" placeholder="3"
                            value="{{ isset($_POST['years_first']) ? $_POST['years_first'] : '3' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="months_first" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="months_first" id="months_first" class="input"
                            aria-label="input" placeholder="0"
                            value="{{ isset($_POST['months_first']) ? $_POST['months_first'] : '0' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="days_first" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="days_first" id="days_first" class="input"
                            aria-label="input" placeholder="0"
                            value="{{ isset($_POST['days_first']) ? $_POST['days_first'] : '0' }}" />
                    </div>
                </div>
                </div>
            </div>
            <div class="col-span-12 hidden" id="sec">
                <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="starting_sec" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="starting_sec" id="starting_sec" class="input"
                            aria-label="input" placeholder="100"
                            value="{{ isset($_POST['starting_sec']) ? $_POST['starting_sec'] : '100' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="ending_sec" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="ending_sec" id="ending_sec" class="input"
                            aria-label="input" placeholder="1000"
                            value="{{ isset($_POST['ending_sec']) ? $_POST['ending_sec'] : '1000' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="start_date" class="font-s-14 text-blue">{{ $lang['9'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="date" name="start_date" id="start_date" class="input" aria-label="input"
                            value="{{ isset($_POST['start_date']) ? $_POST['start_date'] : date('Y-m-d') }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="ending_date" class="font-s-14 text-blue">{{ $lang['10'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="date" name="ending_date" id="ending_date" class="input" aria-label="input"
                        value="{{ isset($_POST['ending_date']) ? $_POST['ending_date'] : date('Y-m-d', strtotime('+7 days')) }}" />
                 
                    </div>
                </div>
                </div>
            </div>
            <div class="col-span-12 hidden" id="third">
                <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="starting_third" class="font-s-14 text-blue">{{ $lang['4'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="starting_third" id="starting_third"
                            class="input" aria-label="input" placeholder="100"
                            value="{{ isset($_POST['starting_third']) ? $_POST['starting_third'] : '100' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="cagr" class="font-s-14 text-blue">CAGR %</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="cagr" id="cagr" class="input"
                            aria-label="input" placeholder="10"
                            value="{{ isset($_POST['cagr']) ? $_POST['cagr'] : '10' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="years_third" class="font-s-14 text-blue">{{ $lang['6'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="years_third" id="years_third" class="input"
                            aria-label="input" placeholder="3"
                            value="{{ isset($_POST['years_third']) ? $_POST['years_third'] : '3' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="months_third" class="font-s-14 text-blue">{{ $lang['7'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="months_third" id="months_third" class="input"
                            aria-label="input" placeholder="0"
                            value="{{ isset($_POST['months_third']) ? $_POST['months_third'] : '0' }}" />
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="days_third" class="font-s-14 text-blue">{{ $lang['8'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <input type="number" step="any" name="days_third" id="days_third" class="input"
                            aria-label="input" placeholder="0"
                            value="{{ isset($_POST['days_third']) ? $_POST['days_third'] : '0' }}" />
                    </div>
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
    
   
<div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full mt-2">
                        <table class=" w-full font-s-18">
                            @if (isset($_POST['unit_type']) === 'one')
                                <tr>
                                    <td class="py-2 border-b" width="30%"><strong>{{ $lang[12] }}</strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['cagr_percentage'], 4) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="30%"><strong>{{ $lang[13] }}</strong></td>
                                    <td class="py-2 border-b"> {{ $currancy }} {{ $_POST['starting_first'] }} to
                                        {{ $currancy }} {{ $_POST['ending_first'] }} in {{ $detail['year'] }},
                                        {{ $detail['months'] }}, {{ $detail['days'] }} </td>
                                </tr>
                            @elseif(isset($_POST['unit_type']) === 'two')
                                <tr>
                                    <td class="py-2 border-b" width="30%"><strong>{{ $lang[12] }}</strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['cagr_percentage'], 4) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="30%"><strong>{{ $lang[13] }}</strong></td>
                                    <td class="py-2 border-b"> {{ $currancy }} {{ $_POST['starting_sec'] }} to
                                        {{ $currancy }} {{ $_POST['ending_sec'] }} in {{ round($detail['total_days'], 4) }}
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td class="py-2 border-b" width="30%"><strong>Future Value</strong></td>
                                    <td class="py-2 border-b"> {{ round($detail['cagr_percentage'], 4) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b" width="30%"><strong>{{ $lang[18] }}</strong></td>
                                    <td class="py-2 border-b"> {{ $currancy }} {{ $_POST['starting_third'] }}
                                        {{ $lang[19] }} {{ $_POST['cagr'] }}
                                        in {{ $detail['yearx'] }}, {{ $detail['monthz'] }}, {{ $detail['dayz'] }}</td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    @if($_POST['unit_type'] === "one")
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-3">
                            <p class="">{{ $lang['14'] }}</p>
                            <table class="w-full">
                                <thead>
                                    <tr id="first_roow">
                                        <td class="py-2 border-b"><strong>{{ $lang['6'] }}</strong></td>
                                        <td class="py-2 border-b"><strong>{{ $lang['7'] }}</strong></td>
                                        <td class="py-2 border-b"><strong>{{ $lang['8'] }}</strong></td>  
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-2 border-b">{{ round($detail['yearx'], 2) }}</td>
                                        <td class="py-2 border-b">{{ round($detail['monthz'], 2) }}</td>
                                        <td class="py-2 border-b">{{ round($detail['dayz'], 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> 
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-3">
                            <table class="w-full">
                                <thead>
                                    <tr id="first_row">
                                        <td class="py-2 border-b"><strong>{{ $lang['20'] }}</strong></td>
                                        <td class="py-2 border-b"><strong>{{ $lang['15'] }}</strong></td>
                                        <td class="py-2 border-b"><strong>{{ $lang['16'] }}</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $value = $_POST['starting_first'];
                                    $growth_rate = $detail['cagr_percentage'] / 100;
                                    $years = $detail['table_year'];
                                    $dataPoints = [];
                                
                                    for ($year = 0; $year <= $years; $year++) {
                                        $growth = $year == 0 ? "-" : round($value * $growth_rate, 2);
                                    @endphp
                                    <tr>
                                        <td class="py-2 border-b">{{ $year }}</td>
                                        <td class="py-2 border-b">{{ $currancy }}{{ $growth }}</td>
                                        <td class="py-2 border-b">{{ $currancy }}{{ round($value, 2) }}</td>
                                    </tr>
                                    @php
                                        $dataPoints[$year] = [
                                            "y" => (int)round($value, 2),
                                            "label" => 'Year ' . ($year),
                                        ];
                                        $value += $value * $growth_rate;
                                    }
                                    $dataPoints = json_encode($dataPoints);
                                    @endphp
                                </tbody>
                            </table>
                        </div>
                        <div class="col my-3">
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                        </div>
                    @elseif($_POST['unit_type'] === "two")
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-3">
                            <p class="" >{{ $lang['14'] }}</p>
                            <table class="w-full">
                                <thead>
                                    <tr id="first_roow">
                                        <td class="py-2 border-b"><strong>{{ $lang['6'] }}</strong></td>
                                        <td class="py-2 border-b"><strong>{{ $lang['7'] }}</strong></td>
                                        <td class="py-2 border-b"><strong>{{ $lang['8'] }}</strong></td>  
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-2 border-b">{{ round($detail['yearx'], 2) ;}}</td>
                                        <td class="py-2 border-b">{{ round($detail['monthz'], 2) ;}}</td>
                                        <td class="py-2 border-b">{{ round($detail['dayz'], 2) ;}}</td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div> 
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-3">
                            <table class="w-full">
                                <thead>
                                    <tr id="first_row">
                                        <td class="py-2 border-b"><strong>Year</strong></td>
                                        <td class="py-2 border-b"><strong>Growth</strong></td>
                                        <td class="py-2 border-b"><strong>Value</strong></td>
                                    </tr>
                                </thead>
            
                                <tbody>
                                    @php
                                    $value = $_POST['starting_sec'];
                                    $growth_rate = $detail['cagr_percentage'] / 100;
                                    $years = $detail['table_year'];
                                    $dataPoints = [];
                                
                                    for ($year = 0; $year <= $years; $year++) {
                                        $growth = $year == 0 ? "-" : round($value * $growth_rate, 2);
                                    @endphp
                                    <tr>
                                        <td class="py-2 border-b">{{ $year }}</td>
                                        <td class="py-2 border-b">{{ $currancy }}{{ $growth }}</td>
                                        <td class="py-2 border-b">{{ $currancy }}{{ round($value, 2) }}</td>
                                    </tr>
                                    @php
                                        $dataPoints[$year] = [
                                            "y" => (int)round($value, 2),
                                            "label" => 'Year ' . ($year),
                                        ];
                                        $value += $value * $growth_rate;
                                    }
                                    $dataPoints = json_encode($dataPoints);
                                    @endphp
                                </tbody>
                            </table>
                        </div>
                        <div class="col my-3 ">
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                        </div> 
                    @else
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-3">
                            <p class="" >{{ $lang['14'] }}</p>
                            <table class="w-full">
                                <thead>
                                    <tr id="first_roow">
                                        <td class="py-2 border-b"><strong>{{ $lang['6'] }}</strong></td>
                                        <td class="py-2 border-b"><strong>{{ $lang['7'] }}</strong></td>
                                        <td class="py-2 border-b"><strong>{{ $lang['8'] }}</strong></td>  
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-2 border-b">{{ round($detail['yearx'], 2) ;}}</td>
                                        <td class="py-2 border-b">{{ round($detail['monthz'], 2) ;}}</td>
                                        <td class="py-2 border-b">{{ round($detail['dayz'], 2) ;}}</td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-3">
                            <table class="w-full">
                                <thead>
                                    <tr id="first_row">
                                        <td class="py-2 border-b"><strong>Year</strong></td>
                                        <td class="py-2 border-b"><strong>Growth</strong></td>
                                        <td class="py-2 border-b"><strong>Value</strong></td>
                                    </tr>
                                </thead>
                                <tbody>  
                                    @php
                                    $value = $_POST['starting_third'];
                                    $growth_rate = $_POST['cagr'] / 100;
                                    $years = $detail['year'];
                                    $dataPoints = [];
                                
                                    for ($year = 0; $year <= $years; $year++) {
                                        $growth = $year == 0 ? "-" : round($value * $growth_rate, 2);
                                    @endphp
                                    <tr>
                                        <td class="py-2 border-b">{{ $year }}</td>
                                        <td class="py-2 border-b">{{ $growth }}</td>
                                        <td class="py-2 border-b">{{ $currancy }}{{ round($value, 2) }}</td>
                                    </tr>
                                    @php
                                        $dataPoints[$year] = [
                                            "y" => (int)round($value, 2),
                                            "label" => 'Year ' . ($year),
                                        ];
                                        $value += $value * $growth_rate;
                                    }
                                    $dataPoints = json_encode($dataPoints);
                                    @endphp
                                </tbody>
                            </table>
                        </div>
                        <div class="col my-3">
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @endisset
</form>
@push('calculatorJS')
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script>
    @if(isset($detail))
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2", // "light1", "light2", "dark1", "dark2"
                title:{
                    text: "{{$lang['17']}}"
                },
                axisY: {
                    title: "Value({{$currancy}}) "
                },
                data: [{        
                    type: "column",  
                    showInLegend: true, 
                    legendMarkerColor: "grey",
                    legendText: "Year",
                    dataPoints: <?= $dataPoints ?>
                }],
            });
            chart.render();
        }
    @endif

    @if(isset($error))
        var type = "{{$_POST['unit_type']}}";
            if (type == "one") {
                document.querySelectorAll('.one').forEach(function(element) {
                document.getElementById('one').classList.add('tagsUnit')
                    document.querySelectorAll('.two,.three').forEach(function(metricElement) {
                        metricElement.classList.remove('tagsUnit')
                    })
                    document.getElementById('unit_type').value = "one"
                    var third = document.getElementById('third');
                    var sec = document.getElementById('sec');
                    var first = document.getElementById('first');
                    if (third && sec && first) {
                        third.classList.add('hidden');
                        sec.classList.add('hidden');
                        first.classList.remove('hidden');
                        }
                    })
            }
    @else
        @if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'one')
            document.querySelectorAll('.one').forEach(function(element) {
            document.getElementById('one').classList.add('tagsUnit')
                document.querySelectorAll('.two,.three').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "one"
            
                var third = document.getElementById('third');
                var sec = document.getElementById('sec');
                var first = document.getElementById('first');

                if (third && sec && first) {
                    third.classList.add('hidden');
                    sec.classList.add('hidden');
                    first.classList.remove('hidden');
                }
            })
            @else
        document.getElementById('one').classList.add('tagsUnit')
        
        @endif
    @endif

    @if(isset($error))
        var type = "{{$_POST['unit_type']}}";
        if (type == "two") {
            document.querySelectorAll('.two').forEach(function(element) {
            document.getElementById('two').classList.add('tagsUnit')
                document.querySelectorAll('.one,.three').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "two"
                var third = document.getElementById('third');
                    var sec = document.getElementById('sec');
                    var first = document.getElementById('first');

                    if (third && sec && first) {
                        third.classList.add('hidden');
                        sec.classList.remove('hidden');
                        first.classList.add('hidden');
                    }
            })
        }
    @else
        @if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'two')
            document.querySelectorAll('.two').forEach(function(element) {
            document.getElementById('two').classList.add('tagsUnit')
                document.querySelectorAll('.one,.three').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "two"
                var third = document.getElementById('third');
                    var sec = document.getElementById('sec');
                    var first = document.getElementById('first');

                    if (third && sec && first) {
                        third.classList.add('hidden');
                        sec.classList.remove('hidden');
                        first.classList.add('hidden');
                    }
            })
        
        @endif
    @endif

    @if(isset($error))
        var type = "{{$_POST['unit_type']}}";
        if (type == "three") {
            document.querySelectorAll('.three').forEach(function(element) {
            document.getElementById('three').classList.add('tagsUnit')
                document.querySelectorAll('.one , .two').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "uk"
                var third = document.getElementById('third');
                    var sec = document.getElementById('sec');
                    var first = document.getElementById('first');
                    if (third && sec && first) {
                        third.classList.remove('hidden');
                        sec.classList.add('hidden');
                        first.classList.add('hidden');
                    }
            })
        }
    @else
        @if(isset($_POST['unit_type']) && $_POST['unit_type'] === 'three')
            document.querySelectorAll('.three').forEach(function(element) {
            document.getElementById('three').classList.add('tagsUnit')
                document.querySelectorAll('.one , .two').forEach(function(metricElement) {
                    metricElement.classList.remove('tagsUnit')
                })
                document.getElementById('unit_type').value = "three"
                var third = document.getElementById('third');
                    var sec = document.getElementById('sec');
                    var first = document.getElementById('first');
                    if (third && sec && first) {
                        third.classList.remove('hidden');
                        sec.classList.add('hidden');
                        first.classList.add('hidden');
                    }
            })
            
        @endif
    @endif

    document.querySelectorAll('.one').forEach(function(element) {
    element.addEventListener('click', function() {
        this.classList.add('tagsUnit');
        document.querySelectorAll('.two, .three').forEach(function(metricElement) {
            metricElement.classList.remove('tagsUnit');
        });
        document.getElementById('unit_type').value = "one";

        var third = document.getElementById('third');
        var sec = document.getElementById('sec');
        var first = document.getElementById('first');

        if (this.classList.contains('one')) { // Condition added here
            if (third && sec && first) {
                third.classList.add('hidden');
                sec.classList.add('hidden');
                first.classList.remove('hidden');
            }
        }
    });
});

document.querySelectorAll('.two').forEach(function(element) {
    element.addEventListener('click', function() {
        if (this.classList.contains('two')) {
            this.classList.add('tagsUnit');
            document.querySelectorAll('.one, .three').forEach(function(imperialElement) {
                imperialElement.classList.remove('tagsUnit');
            });

            document.getElementById('unit_type').value = "two";

            var third = document.getElementById('third');
            var sec = document.getElementById('sec');
            var first = document.getElementById('first');

            if (third && sec && first) {
                third.classList.add('hidden');
                sec.classList.remove('hidden');
                first.classList.add('hidden');
            }
        }
    });
});

document.querySelectorAll('.three').forEach(function(element) {
    element.addEventListener('click', function() {
        if (this.classList.contains('three')) {
            this.classList.add('tagsUnit');
            document.querySelectorAll('.one, .two').forEach(function(imperialElement) {
                imperialElement.classList.remove('tagsUnit');
            });
            document.getElementById('unit_type').value = "three";
            var third = document.getElementById('third');
            var sec = document.getElementById('sec');
            var first = document.getElementById('first');

            if (third && sec && first) {
                third.classList.remove('hidden');
                sec.classList.add('hidden');
                first.classList.add('hidden');
            }
        }
    });
});



</script>
@endpush
