<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-4">
                <div class="col-span-12">
                    <label for="method" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2">
                        <select name="method" id="method" class="input" autocomplete="off">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = [$lang['2'],$lang['3']];
                                $val = ['1','2'];
                                optionsList($val,$name,isset($_POST['method'])?$_POST['method']:'1');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="textarea" class="font-s-14 text-blue">{{ $lang['4'] }} ({{ $lang['5'] }}):</label>
                    <div class="w-100 py-2">
                        <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 43, 21, 25, 42, 57, 59">{{ isset($_POST['x'])?$_POST['x']:'43, 21, 25, 42, 57, 59' }}</textarea>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="textarea1" class="font-s-14 text-blue">{{ $lang['6'] }} ({{ $lang['5'] }}):</label>
                    <div class="w-100 py-2">
                        <textarea name="y" id="textarea1" class="textareaInput" aria-label="input" placeholder="e.g. 99, 65, 79, 75, 87, 81">{{ isset($_POST['y'])?$_POST['y']:'99, 65, 79, 75, 87, 81' }}</textarea>
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
                    <div class="row">
                        @php
                            $x = $detail['x'];
                            $y = $detail['y'];
                            function sdigFig($value,$digits){
                                if($value===0){
                                $decimalPlaces=$digits-1;
                                }elseif($value<0){
                                $decimalPlaces=$digits-floor(log10($value*-1))-1;
                                }else{
                                $decimalPlaces=$digits-floor(log10($value))-1;
                                }
                                $answer=round($value,$decimalPlaces);
                                return $answer;
                            }
                        @endphp
                        <div class="text-center">
                            <p class="lg:text-[22px] md:text-[22px] text-[16px]"><strong>{{$lang['7']}}</strong></p>
                        <div class="flex justify-center">
                            <p class="text-[25px] w-auto bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                <strong class="text-white">{{ round($detail['final'],4) }}</strong>
                            </p>
                        </div>
                    </div>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue"><?=$lang['8']?> (n)</strong></td>
                                    <td class="py-2 border-b"><?=count($detail['numbers'])?></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue"><?=$lang['9']?> \(μ_X\)</strong></td>
                                    <td class="py-2 border-b"><?=round($detail['meanx'],4)?></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue"><?=$lang['9']?> \(μ_Y\)</strong></td>
                                    <td class="py-2 border-b"><?=round($detail['meany'],4)?></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">\(σ_x\)</strong></td>
                                    <td class="py-2 border-b"><?=round(sqrt(array_sum($detail['arr2'])/$detail['countx']),4)?></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">\(σ_y\)</strong></td>
                                    <td class="py-2 border-b"><?=round(sqrt(array_sum($detail['arr4'])/$detail['countx']),4)?></td>
                                </tr>
                            </table>
                        </div>
                        <p class="w-full mt-3 text-[12px] overflow-auto"><strong class="text-blue"><?=$lang['10']?>:</strong></p>
                        <p class="w-full mt-2 font-s-18 overflow-auto"><strong><?=$lang['11']?> X = <?=$x?></strong></p>
                        <p class="w-full mt-2 font-s-18 overflow-auto"><strong><?=$lang['11']?> Y = <?=$y?></strong></p>
                        <p class="w-full mt-3 text-[12px] overflow-auto"><strong class="text-blue"><?=$lang['12']?>:</strong></p>
                        <?php if($detail['method']=='2'){ ?>
                            <p class="w-full mt-2"><strong><?=$lang['13']?>:</strong></p>
                            <div class="col-lg-6 mt-2 overflow-auto">
                                <table class='w-full font-s-18' style='border-collapse: collapse'>
                                    <tr class='bg-gray'>
                                        <td class='border p-2 text-center text-blue'>X</td>
                                        <td class='border p-2 text-center text-blue'>Y</td>
                                    </tr>
                                    <?php for ($i=0; $i < $detail['countx']; $i++) { ?>
                                        <tr class="bg-white">
                                            <td class='border p-2 text-center'><?=round($detail['numbers'][$i],4)?></td>
                                            <td class='border p-2 text-center'><?=round($detail['numbersy'][$i],4)?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        <?php } ?>
                        <p class="w-full mt-2">\(\sum x \)= <?=array_sum($detail['numbers'])?></p>
                        <p class="w-full mt-2"><?=$lang['9']?> \(μ_X\) = <strong> \(\dfrac{<?=array_sum($detail['numbers'])?>}{<?=$detail['countx']?>} = <?=round($detail['meanx'],4)?>\)</strong></p>
                        <p class="w-full mt-2">\(\sum y \)= <?=array_sum($detail['numbersy'])?></p>
                        <p class="w-full mt-2"><?=$lang['9']?> \(μ_Y\) = <strong> \(\dfrac{<?=array_sum($detail['numbersy'])?>}{<?=$detail['countx']?>} = <?=round($detail['meany'],4)?>\)</strong></p>
                        <div class="w-full mt-2 overflow-auto">
                            <table class='w-full font-s-18' style='border-collapse: collapse'>
                                <tr class='bg-gray'>
                                    <td class='border p-2 text-center'>(\(x_i - μ_X\))</td>
                                    <td class='border p-2 text-center'>\((x_i - μ_X)^2\)<</td>
                                    <td class='border p-2 text-center'>(\(y_i - μ_Y\))</td>
                                    <td class='border p-2 text-center'>\((y_i - μ_Y)^2\)</td>
                                    <td class='border p-2 text-center'>(\(x_i - μ_X\))(\(x_i - μ_Y\))</td>
                                </tr>
                                <?php for ($i=0; $i < $detail['countx']; $i++) { ?>
                                    <tr class="bg-white">
                                        <td class='border p-2 text-center'><?=round($detail['arr1'][$i],4)?></td>
                                        <td class='border p-2 text-center'><?=round($detail['arr2'][$i],4)?></td>
                                        <td class='border p-2 text-center'><?=round($detail['arr3'][$i],4)?></td>
                                        <td class='border p-2 text-center'><?=round($detail['arr4'][$i],4)?></td>
                                        <td class='border p-2 text-center'><?=round($detail['arr5'][$i],4)?></td>
                                    </tr>
                                <?php } ?>
                                <tr class='bg-gray'>
                                    <td class='border p-2 text-center'></td>
                                    <td class='border p-2 text-center'>\(\sum\) = <?=round(array_sum($detail['arr2']),2)?></td>
                                    <td class='border p-2 text-center'></td>
                                    <td class='border p-2 text-center'>\(\sum\) = <?=round(array_sum($detail['arr4']),2)?></td>
                                    <td class='border p-2 text-center'>\(\sum\) = <?=round(array_sum($detail['arr5']),2)?></td>
                                </tr>
                            </table>
                        </div>
                        <p class="w-full mt-3 text-[12px]"><strong class="text-blue"><?=$lang['14']?></strong></p>
                        <p class="w-full mt-2">$$r=\dfrac{\sum{(x_i-\bar{x})(y_i-\bar{y})}}{\sqrt{\sum{(x_i-\bar{x})^2}\sum{(y_i-\bar{y})^2}}}$$</p>
                        <p class="w-full mt-2">$$r=\dfrac{<?=round(array_sum($detail['arr2']),2)?>}{\sqrt{<?=round(array_sum($detail['arr2']),2)?> \times <?=round(array_sum($detail['arr4']),2)?>}}$$</p>
                        <p class="w-full mt-2">$$ r = <?=round($detail['final'],4)?>$$</p>
                        <div class="w-full overflow-auto">
                            <div id="chart_div" style="height: 400px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    @if(isset($detail))
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" 
        onload="renderMathInElement(document.body);"></script>
    @endif
    <script>
        @if(isset($detail))
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('number');
                data.addColumn('number');

                // Our central point, which will jiggle.
                @for ($i=0; $i < $detail['countx']; $i++)
                    data.addRow([{{$detail['numbers'][$i]}}, {{$detail['numbersy'][$i]}}]);
                @endfor

                var options = {
                    legend: 'none',
                    colors: ['#13699E'],
                    lineWidth: 0,
                    pointSize: 3,
                    hAxis: {title: 'x-axis'},
                    vAxis: {title: 'y-axis'},
                };

                var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));

                chart.draw(data, options);
                // data.setValue(-1.34, x);
                // data.setValue(0.877, y);
                chart.draw(data, options);
            }
        @endif
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>