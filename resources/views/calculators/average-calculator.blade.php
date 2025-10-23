<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
                <div class="space-y-2">
                    <label for="more" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                    <select name="more" class="input" id="more" aria-label="select">
                        <option value="space">{{$lang[2]}}</option>
                        <option value="," {{ isset($_POST['more']) && $_POST['more']==','?'selected':'' }}>{{$lang[3]}}</option>
                       
                    </select>
                </div>
                <div class="space-y-2 hidden">
                    <label for="seprate" class="font-s-14 text-blue">&nbsp;</label>
                    <input type="text" readonly name="seprate" id="seprate" disabled class="input readonly" value="{{ isset($_POST['seprate'])?$_POST['seprate']:'' }}" aria-label="input"/>
                </div>
                <div class="space-y-2">
                    <label for="x" class="font-s-14 text-blue">Please provide numbers separated by a comma:</label>
                    <textarea aria-label="textarea input" id="x" name="x" class="textareaInput" id="textarea" placeholder="12, 23, 45">{{ isset($_POST['x'])?$_POST['x']:'55 62 35 32 50 57 54' }}</textarea>
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
                    <div class="w-full bg-light-blue  rounded-lg mt-3">
                        <div class="w-full flex-wrap">
                            <div class="w-full md:w-[50%] lg:w-[50%] mt-2">
                                <table class="w-full text-lg">
                                    <tr>
                                        <td class="py-2 border-b w-2/2"><strong>{{$lang['a']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['average']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2"><strong>{{$lang['5']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['median']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2"><strong>{{$lang['6']}}</strong></td>
                                        <td class="py-2 border-b">
                                            @php
                                                foreach ($detail['mode'] as $value) {
                                                    if (end($detail['mode']) == $value) {
                                                        echo $value;
                                                    } else {
                                                        echo $value . " , ";
                                                    }
                                                }
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2"><strong>{{$lang['7']}}</strong></td>
                                        <td class="py-2 border-b">{{max($detail['numbers']) - min($detail['numbers'])}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full md:w-[50%] lg:w-[50%] mt-2">
                                <table class="w-full text-base">
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['8'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ "( ".array_sum($detail['numbers'])." ) / ".count($detail['numbers'])." = ".$detail['average'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['9'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round(pow(array_product($detail['numbers']), (1/$detail['count'])),4) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['10'] }}</td>
                                        <td class="py-2 border-b">
                                            <strong>
                                                @php
                                                    foreach ($detail['numbers'] as $key => $value) {
                                                        if ($key == ($detail['count']-1)) {
                                                            echo $value;
                                                        } else {
                                                            echo $value." , ";
                                                        }
                                                    }
                                                @endphp
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['11'] }}</td>
                                        <td class="py-2 border-b">
                                            <strong>
                                                @php
                                                    rsort($detail['numbers']);
                                                    foreach ($detail['numbers'] as $key => $value) {
                                                        if ($key == ($detail['count']-1)) {
                                                            echo $value;
                                                        } else {
                                                            echo $value." , ";
                                                        }
                                                    }
                                                @endphp
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['12'] }}</td>
                                        <td class="py-2 border-b">
                                            <strong>
                                                @php
                                                    foreach ($detail['numbers'] as $key => $value) {
                                                        if ($value % 2 == 0) {
                                                            echo $value." , ";
                                                        }
                                                    }
                                                @endphp
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['13'] }}</td>
                                        <td class="py-2 border-b">
                                            <strong>
                                                @php
                                                    foreach ($detail['numbers'] as $key => $value) {
                                                        if ($value % 2) {
                                                            echo $value." , ";
                                                        }
                                                    }
                                                @endphp
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['sum'] }}</td>
                                        <td class="py-2 border-b"><strong>{{array_sum($detail['numbers'])}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['d'] }}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['d']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['14'] }}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['s_d_p']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['15'] }}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['s_d_s']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">Largest</td>
                                        <td class="py-2 border-b"><strong>{{max($detail['numbers'])}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">Smallest</td>
                                        <td class="py-2 border-b"><strong>{{min($detail['numbers'])}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">Count</td>
                                        <td class="py-2 border-b"><strong>{{count($detail['numbers'])}}</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full md:w-[50%] lg:w-[50%]  text-base mt-2">
                                <p class="mt-2"><strong>{{$lang[20]}}</strong></p>
                                <div class="">
                                    <table class="w-full text-center">
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{$lang[21]}}</strong></td>
                                            <td class="py-2 border-b"><strong>{{$lang[22]}}</strong></td>
                                            <td class="py-2 border-b"><strong>{{$lang[23]}}</strong></td>
                                        </tr>
                                        {!!$detail['table']!!}
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{$lang['sum']}}</strong></td>
                                            <td class="py-2 border-b"><strong>{{$detail['count']}}</strong></td>
                                            <td class="py-2 border-b"><strong>{{array_sum($detail['numbers'])}}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div id="chart_div" class=" w-full overflow-x-auto  " style="height: 350px;"></div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        @isset($detail)
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            @php
                $repeat = array_count_values($detail['numbers']);
                asort($detail['numbers']);
                $outputChart = '';
                foreach ($detail['numbers'] as $key => $value) {
                    $outputChart .= "[" . $value . "," . $repeat[$value] . "," . "''" . "],";
                }
            @endphp
            <script>
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawVisualization);
                function drawVisualization() {
                    var data = google.visualization.arrayToDataTable([
                        ['', '', { role: 'style' }],
                        {!!$outputChart!!}
                    ]);

                    var options = {
                    title : "{{$lang['16']}}",
                    legend: {position: 'none'},
                    vAxis: {title: '# {{$lang['17']}}',viewWindow: { min: 0} },
                    hAxis: {title: "{{$lang['18']}}"},
                    seriesType: 'bars',
                    };

                    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                    chart.draw(data, options);
                    var avg= "{{$detail['average']}}";
                    var n=Math.round(avg*100)/100;
                    drawVAxisLine(chart, n);
                }
                function drawVAxisLine(chart,value){
                    var layout = chart.getChartLayoutInterface();
                    var chartArea = layout.getChartAreaBoundingBox();

                    var svg = chart.getContainer().getElementsByTagName('svg')[0];
                    var xLoc = layout.getXLocation(value)
                    svg.appendChild(createLine(xLoc,chartArea.top + chartArea.height,xLoc,chartArea.top,'#009688',4)); // axis line 
                }
                function createLine(x1, y1, x2, y2, color, w) {
                    var line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                    line.setAttribute('x1', x1);
                    line.setAttribute('y1', y1);
                    line.setAttribute('x2', x2);
                    line.setAttribute('y2', y2);
                    line.setAttribute('stroke', color);
                    line.setAttribute('stroke-width', w);
                    return line;
                }
            </script>
        @endisset
        <script>
            document.getElementById('more').addEventListener('change', function() {
                var x = this.value;
                if (x === 'space') {
                    document.querySelector('textarea').value = '55 62 35 32 50 57 54';
                    var readonlyElements = document.getElementsByClassName('readonly');
                    for (var i = 0; i < readonlyElements.length; i++) {
                        readonlyElements[i].removeAttribute('required');
                        readonlyElements[i].setAttribute('readonly', 'readonly');
                        readonlyElements[i].setAttribute('disabled', 'disabled');
                        readonlyElements[i].value = '';
                    }
                } else if (x === ',') {
                    document.querySelector('textarea').value = '55, 62, 35, 32, 50, 57, 54';
                    var readonlyElements = document.getElementsByClassName('readonly');
                    for (var i = 0; i < readonlyElements.length; i++) {
                        readonlyElements[i].setAttribute('readonly', 'readonly');
                        readonlyElements[i].removeAttribute('required');
                        readonlyElements[i].setAttribute('disabled', 'disabled');
                        readonlyElements[i].value = ',';
                    }
                } else {
                    var readonlyElements = document.getElementsByClassName('readonly');
                    for (var i = 0; i < readonlyElements.length; i++) {
                        readonlyElements[i].setAttribute('required', 'required');
                        readonlyElements[i].removeAttribute('readonly');
                        readonlyElements[i].removeAttribute('disabled');
                        readonlyElements[i].value = '';
                    }
                }
            });
        </script>
    @endpush
</form>