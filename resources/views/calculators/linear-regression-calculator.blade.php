<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="textarea" class="font-s-14 text-blue">{{ $lang['1'] }} ({{ $lang['2'] }})</label>
                    <div class="w-100 py-2">
                        <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 43, 21, 25, 42, 57, 59">{{ isset($_POST['x'])?$_POST['x']:'43, 21, 25, 42, 57, 59' }}</textarea>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="y" class="font-s-14 text-blue">{{ $lang['3'] }} ({{ $lang['2'] }})</label>
                    <div class="w-100 py-2">
                        <textarea name="y" id="y" class="textareaInput" aria-label="input" placeholder="e.g. 99, 65, 79, 75, 87, 81">{{ isset($_POST['y'])?$_POST['y']:'99, 65, 79, 75, 87, 81' }}</textarea>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="estimate" class="font-s-14 text-blue" title="{{ $lang['5'] }}">{{ $lang['4'] }}: ({{ $lang['2'] }}) optional</label>
                    <div class="w-100 py-2">
                        <textarea name="estimate" id="estimate" class="textareaInput" aria-label="input" placeholder="e.g. 1, 2, 3, 4">{{ isset($_POST['estimate'])?$_POST['estimate']:'' }}</textarea>
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
                        <div class="w-ful">
                            <div class="text-center">
                                <p class="text-[18px]"><strong>{{$lang['6']}}</strong></p>
                                <div class="flex justify-center">
                                <p class="text-[22px] w-auto bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">ŷ = {{round($detail['b'],5)}}x + {{round($detail['a'],5)}}</strong>
                                </p>
                            </div>
                        </div>
                            <p class="w-full  mt-3 font-s-20"><strong class="text-blue"><?=$lang['7']?>:</strong></p>
                            <p class="w-full  mt-2 text-[18px]"><?=$lang['8']?> x:
                                <?php foreach ($detail['numbers'] as $key => $value) {
                                    if (count($detail['numbers'])-1 != $key) {
                                        echo $value.', ';
                                    }else{
                                        echo $value;
                                    }
                                } ?>
                            </p>
                            <p class="w-full  mt-2 text-[18px]"><?=$lang['8']?> y:
                                <?php foreach ($detail['numbersy'] as $key => $value) {
                                    if (count($detail['numbersy'])-1 != $key) {
                                        echo $value.', ';
                                    }else{
                                        echo $value;
                                    }
                                } ?>
                            </p>
                            <p class="w-full  mt-2 text-[18px]"><?=$lang['9']?>: <?=count($detail['numbers'])?></p>
                            <p class="w-full  mt-3 font-s-20"><strong class="text-blue">Solution:</strong></p>
                            <p class="w-full  mt-2 text-[18px]"><?=$lang['10']?> X: <?=array_sum($detail['numbers'])?></p>
                            <p class="w-full  mt-2 text-[18px]"><?=$lang['10']?> Y: <?=array_sum($detail['numbersy'])?></p>
                            <p class="w-full  mt-2 text-[18px]"><?=$lang['11']?> X: <?=$detail['meanx']?></p>
                            <p class="w-full  mt-2 text-[18px]"><?=$lang['11']?> Y: <?=$detail['meany']?></p>
                            <div class="w-full  mt-2 overflow-auto">
                                <table class="w-full text-[18px]" style="border-collapse: collapse">
                                    <tr class="bg-sky">
                                        <td class="border p-2 text-center text-blue">X - M<sub class="text-blue">x</sub></td>
                                        <td class="border p-2 text-center text-blue">Y - M<sub class="text-blue">y</sub></td>
                                        <td class="border p-2 text-center text-blue">(X - M<sub class="text-blue">x</sub>)<sup class="text-blue">2</sup></td>
                                        <td class="border p-2 text-center text-blue">(X - M<sub class="text-blue">x</sub>)*(Y - M<sub class="text-blue">y</sub>)</td>
                                    </tr>
                                    <?php for ($i=0; $i < count($detail['numbers']); $i++) { ?>
                                        <tr class="bg-white">
                                            <td class="border p-2 text-center"><?=$detail['arr1'][$i]?></td>
                                            <td class="border p-2 text-center"><?=$detail['arr3'][$i]?></td>
                                            <td class="border p-2 text-center"><?=$detail['arr2'][$i]?></td>
                                            <td class="border p-2 text-center"><?=$detail['arr5'][$i]?></td>
                                        </tr>
                                    <?php } ?>
                                    <tr class="bg-gray">
                                        <td class="border p-2 text-center">&nbsp;</td>
                                        <td class="border p-2 text-center">&nbsp;</td>
                                        <td class="border p-2 text-center"><strong class="text-blue">SS<sub class="text-blue">x</sub> (∑x²) = <?=$detail['ssx']?></strong></td>
                                        <td class="border p-2 text-center"><strong class="text-blue">SP (∑xy) = <?=$detail['sp']?></strong></td>
                                    </tr>
                                </table>
                            </div>
                            
                            <p class="w-full  mt-3 font-s-20 text-center"><strong class="text-blue"><?=$lang['12']?>: $$ ŷ = bX + a $$</strong></p>
                            <p class="w-full  mt-2 text-[18px]"><strong><?=$lang['13']?> b:</strong></p>
                            <p class="w-full  mt-2 text-[18px]"><strong>\(b = \dfrac{SP}{SS_x}\)</strong></p>
                            <p class="w-full  mt-2 text-[18px]"><strong>\(b = \dfrac{<?=$detail['sp']?>}{<?=$detail['ssx']?>}\)</strong></p>
                            <p class="w-full  mt-2 text-[18px]"><strong>\(b = <?=$detail['b']?>\)</strong></p>
                            <p class="w-full  mt-2 text-[18px]"><strong><?=$lang['13']?> a:</strong></p>
                            <p class="w-full  mt-2 text-[18px]"><strong>\(a = M_Y - (b \times M_X)\)</strong></p>
                            <p class="w-full  mt-2 text-[18px]"><strong>\(a = <?=$detail['meany']?> - (<?=round($detail['sp']/$detail['ssx'],4)?> \times <?=$detail['meanx']?>)\)</strong></p>
                            <p class="w-full  mt-2 text-[18px]"><strong>\(a = <?=$detail['a']?>\)</strong></p>
                            <p class="w-full  mt-2 text-[18px]"><strong><?=$lang['14']?>:</strong></p>
                            <p class="w-full  mt-3 font-s-20"><strong class="text-blue">ŷ = <?=round($detail['b'],5)?>x + <?=round($detail['a'],5)?></strong></p>
                           <div class="w-full overflow-auto">
                            <div id="chart_div" class="w-full  mt-3" style="height: 400px;"></div>
                           </div>
                            <?php if(isset($detail['estimate'])){ ?>
                                <div class="w-full mt-3 overflow-auto">
                                    <table class="w-full text-[18px]" style="border-collapse: collapse">
                                        <tr class="bg-gray">
                                            <td class="border p-2 text-center text-blue"><?=$lang['4']?></td>
                                            <td class="border p-2 text-center text-blue"><?=$lang['15']?> Y</td>
                                        </tr>
                                        <?php for ($i=0; $i < count($detail['estimate']); $i++) { ?>
                                            <tr class="bg-white">
                                                <td class="border p-2 text-center"><?=$detail['estimate'][$i]?></td>
                                                <td class="border p-2 text-center"><?=round(($detail['b']*$detail['estimate'][$i]) + $detail['a'],5)?></td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
@push('calculatorJS')
    @if (isset($detail))
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" 
                onload="renderMathInElement(document.body);"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
    
            function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('number', 'X');
                data.addColumn('number', 'Y');
    
                // Add rows using PHP to output the data
                <?php if (isset($detail['numbers']) && isset($detail['numbersy'])) { 
                    for ($i = 0; $i < count($detail['numbers']); $i++) { ?>
                        data.addRow([<?=$detail['numbers'][$i]?>, <?=$detail['numbersy'][$i]?>]);
                <?php } } ?>
    
                var options = {
                    legend: 'none',
                    colors: ['#13699E'],
                    lineWidth: 0,
                    pointSize: 3,
                    hAxis: {title: 'x-axis'},
                    vAxis: {title: 'y-axis'},
                    trendlines: {
                        0: {
                            type: 'linear',
                            degree: 1,
                            color: 'lightblue',
                            lineWidth: 2,
                            opacity: 1
                        }
                    }
                };
    
                var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        </script>
    @endif
@endpush