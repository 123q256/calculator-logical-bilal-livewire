<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
                    
            <div class="space-y-2 raw_mean">
                <label for="x" class="font-s-14 text-blue">{!! $lang['x'] !!}</label>
                <div class="w-100 py-2">
                    <textarea name="x" id="x" class="textareaInput h-[130px]" aria-label="input" placeholder="7,1,6,2,11,3,4,5,2
3 4 5 9 7 5
5
8">{{ isset($_POST['x'])?$_POST['x']:'' }}</textarea>
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
                    <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3 ">
                        <div class="space-y-2 p-2">
                            <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3">
                                <span class="font-s-18">{{ $lang['ave'] }}</span>
                                <strong class="text-[#119154] text-[22px] ps-2">{{ $detail['average'] }}</strong>
                            </div>
                        </div>
                        <div class="space-y-2 p-2">
                            <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3">
                                <span class="font-s-18">{{ $lang['med'] }}</span>
                                <strong class="text-[#119154] text-[22px] ps-2">{{ $detail['median'] }}</strong>
                            </div>
                        </div>
                        <div class="space-y-2 p-2">
                            <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3">
                                <span class="font-s-18">{{ $lang['mode'] }}</span>
                                <strong class="text-[#119154] text-[22px] ps-2">
                                    @php
                                        foreach ($detail['mode'] as $value) {
                                            if (end($detail['mode'])==$value) {
                                                echo $value;
                                            }else{
                                                echo $value." , ";
                                            }
                                        }
                                    @endphp
                                </strong>
                            </div>
                        </div>
                        <div class="space-y-2 p-2">
                            <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC]  border rounded-lg p-3">
                                <span class="font-s-18">{{ $lang['range'] }}</span>
                                <strong class="text-[#119154] text-[22px] ps-2">{{ max($detail['numbers']) - min($detail['numbers']) }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1  gap-4">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-2 px-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['geo']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            echo round(pow(array_product($detail['numbers']), (1/$detail['count'])),4);
                                         ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['ao']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            foreach ($detail['numbers'] as $key => $value) {
                                                if ($key==($detail['count']-1)) {
                                                    echo $value;
                                                }else{
                                                    echo $value." , ";
                                                }
                                            }
                                         ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['do']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            rsort($detail['numbers']);
                                            foreach ($detail['numbers'] as $key => $value) {
                                                if ($key==($detail['count']-1)) {
                                                    echo $value;
                                                }else{
                                                    echo $value." , ";
                                                }
                                            }
                                         ?>
                                    </strong></td>
                                </tr>
                                {{-- <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['even']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            foreach ($detail['numbers'] as $key => $value) {
                                                if ($value % 2==0) {
                                                    echo $value." , ";
                                                }
                                            }
                                         ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['odd']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            foreach ($detail['numbers'] as $key => $value) {
                                                if ($value % 2) {
                                                    echo $value." , ";
                                                }
                                            }
                                         ?>
                                    </strong></td>
                                </tr> --}}
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['sum']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            echo array_sum($detail['numbers']);
                                         ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">Lower quartile (Q1)	:</td>
                                    <td class="py-2 border-b"><strong>
                                       {{$detail['Q1']}}
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">Upper quartile (Q3)	:</td>
                                    <td class="py-2 border-b"><strong>
                                       {{$detail['Q3']}}
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">Interquartile range (IQR)	:</td>
                                    <td class="py-2 border-b"><strong>
                                       {{$detail['IQR']}}
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['max']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            echo max($detail['numbers']);
                                         ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b"><?=$lang['min']?>:</td>
                                    <td class="py-2 border-b"><strong>
                                        <?php 
                                            echo min($detail['numbers']);
                                         ?>
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2"><?=$lang['count']?>:</td>
                                    <td class="py-2"><strong>
                                        <?php 
                                            echo count($detail['numbers']);
                                         ?>
                                    </strong></td>
                                </tr>
                            </table>
                        </div>
                        <div class="border radius-5 font-s-18 p-2 bg-white mt-2">
                            <p><i class="text-blue">Reporting in APA style</i></p>
                            <p>
                                M = {{ $detail['average'] }}
                            </p>
                            <p>
                                Mdn =  <?=$detail['median']?>
                            </p>
                            <p>
                                IQR =  {{$detail['Q1']}} -  {{$detail['Q3']}} , IQR =  {{$detail['IQR']}}
                            </p>
                        </div>
                        <p class="w-full mt-3 font-s-18 text-blue">{{ $lang['chart'] }}</p>
                        {{-- <div id="ourchart" style="height: 250px;" class="w-full mt-2"></div> --}}
                            <canvas id="myChart" style="height: 280px; width:800px;"></canvas>
                            <div class="w-full mt-3" id="chartContainer"></div>
            
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    @if (isset($detail))        
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
        <script>
             var data = {!! json_encode($detail['numbers']) !!};
            const mean = {{$detail['average']}};
            const median = {{$detail['median']}};
            @php
                $modeValue = null;
                foreach ($detail['mode'] as $value) {
                    if (is_numeric($value)) {
                        $modeValue = $value;
                        break;
                    }
                }
            @endphp
            const mode = @json($modeValue);
            // Prepare the labels and data dynamically
            const labels = data.map((num, index) => `'${num}'`);
            labels.push("'Mean'", "'Median'");
            if (mode !== null) {
                labels.push("'Mode'");
            }
            const chartData = [...data, mean, median];
            if (mode !== null) {
                chartData.push(mode);
            }
            const ctx = document.getElementById('myChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    // labels: ["'9'", "'10'", "'Mean'", "'Median'", "'Mode'", "'14'"],
                    labels: labels,
                    datasets: [{
                        label: 'Value',
                        // data: [9, 10, mean, median, {{ is_numeric($modeValue) ? $modeValue : "null" }}, 14],
                        data: chartData,
                        backgroundColor: [
                            ...data.map(() => 'blue'), 'orange', 'red', ...(mode !== null ? ['green'] : [])
                        ],
                        borderColor: [
                            ...data.map(() => 'blue'), 'orange', 'red', ...(mode !== null ? ['green'] : [])
                        ],
                        borderWidth: 2,
                    }, {
                        label: 'Mean',
                        // data: [null, null, mean, null, null, null],
                        backgroundColor: 'orange',
                        borderColor: 'orange',
                        borderWidth: 2
                    }, {
                        label: 'Median',
                        // data: [null, null, null, median, null, null],
                        backgroundColor: 'red',
                        borderColor: 'red',
                        borderWidth: 2
                    }, {
                        label: 'Mode',
                        // data: [null, null, null, null, mode, null],
                        backgroundColor: 'green',
                        borderColor: 'green',
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: true // Hide the legend if not needed
                        },
                        datalabels: {
                            color: 'black', // Text color for data labels
                            anchor: 'end', // Position of the label
                            align: 'end', // Align the label to the end of the bar
                            formatter: function(value) {
                                return value; // Display the value on the bar
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels] // Ensure the data labels plugin is registered
            });

        </script>
    @endif
    @if (isset($detail))
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
        var options = {
            series: [
            {
                name: 'box',
                type: 'boxPlot',
                data: [
                        {
                            x: "boxAndWhisker",
                            y: [<?=min($detail['numbers'])?>, <?=$detail['Q3']?>, <?=$detail['median']?>, <?=$detail['Q1']?>, <?=max($detail['numbers'])?>]
                        }
                    ]
                }
            ],
            chart: {
                type: 'boxPlot',
                height: 350
            },
            colors: ['#008FFB', '#FEB019'],
            title: {
                text: 'Box And Whisker Plot',
                align: 'left'
            },
                xaxis: {
                type: 'boxAndWhisker',
            },
            tooltip: {
                shared: false,
                intersect: true
            }
        };
        var chart = new ApexCharts(document.querySelector("#chartContainer"), options);
        chart.render();
        </script>
    @endif
@endpush

<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>