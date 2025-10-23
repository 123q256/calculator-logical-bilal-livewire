<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
                <div class="space-y-2 relative">
                    <label for="method" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <select name="method" id="method" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['hyper'],$lang['hyper'].' ('.$lang['chart'].')'];
                            $val = [1,2];
                            optionsList($val,$name,isset($_POST['method'])?$_POST['method']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-1 mt-4 gap-4">
                <div class="space-y-2 function hidden">
                    <label for="fun" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                    <select name="fun" id="fun" class="input">
                        @php
                            $name = [$lang['mass'].' f',$lang['lcd'].' P',$lang['ucd'].' Q'];
                            $val = [1,2,3];
                            optionsList($val,$name,isset($_POST['fun'])?$_POST['fun']:'1');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2 mt-4 gap-4">
                <div class="space-y-2 relative">
                    <label for="p" class="font-s-14 text-blue">{{ $lang['p'] }}</label>
                    <input type="number" step="any" name="p" id="p" value="{{ isset($_POST['p'])?$_POST['p']:'52' }}" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2 relative">
                    <label for="sp" class="font-s-14 text-blue">{{ $lang['sp'] }}</label>
                    <input type="number" step="any" name="sp" id="sp" value="{{ isset($_POST['sp'])?$_POST['sp']:'26' }}" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2 relative">
                    <label for="s" class="font-s-14 text-blue">{{ $lang['s'] }}</label>
                    <input type="number" step="any" name="s" id="s" value="{{ isset($_POST['s'])?$_POST['s']:'5' }}" class="input" aria-label="input" placeholder="00" />
                </div>
              
                <div class="space-y-2 relative">
                    <label for="ss" class="font-s-14 text-blue">{{ $lang['ss'] }} <span id="text"></span></label>
                    <input type="number" step="any" name="ss" id="ss" value="{{ isset($_POST['ss'])?$_POST['ss']:'2' }}" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2  hidden chart">
                    <label for="inc" class="font-s-14 text-blue">{{ $lang['inc'] }}</label>
                    <input type="number" min="1" max="4" name="inc" id="inc" value="{{ isset($_POST['inc'])?$_POST['inc']:'1' }}" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2  hidden chart">
                    <label for="rep" class="font-s-14 text-blue">{{ $lang['rep'] }}</label>
                    <input type="number" min="1" max="20" name="rep" id="rep" value="{{ isset($_POST['rep'])?$_POST['rep']:'10' }}" class="input" aria-label="input" placeholder="00" />
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
        @php
            $request = request();
        @endphp
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full">
                        @if ($detail['method']==1)
                            <div class="w-full mt-2 overflow-auto">
                                <table class="w-full">
                                    <tr>
                                        <td class="text-blue py-2 border-b"><p><?=$lang['a']?><?=(($_POST['ss']!='')? '= '.$_POST['ss'].")":'= x)')?></p></td>
                                        <td class="py-2 border-b"><b><?=$detail['a']?></b></td>
                                        <td class="p-2 border-b"><b><?=round($detail['a']*100,4)?>%</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><p><?=$lang['b']?><?=(($_POST['ss']!='')? '< '.$_POST['ss'].")":'< x)')?></p></td>
                                        <td class="py-2 border-b"><b><?=$detail['b']?></b></td>
                                        <td class="p-2 border-b"><b><?=round($detail['b']*100,4)?>%</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><p><?=$lang['b']?><?=(($_POST['ss']!='')? '&#8804; '.$_POST['ss'].")":'&#8804; x)')?></p></td>
                                        <td class="py-2 border-b"><b><?=$detail['c']?></b></td>
                                        <td class="p-2 border-b"><b><?=round($detail['c']*100,4)?>%</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><p><?=$lang['b']?><?=(($_POST['ss']!='')? '> '.$_POST['ss'].")":'> x)')?></p></td>
                                        <td class="py-2 border-b"><b><?=$detail['d']?></b></td>
                                        <td class="p-2 border-b"><b><?=round($detail['d']*100,4)?>%</b></td>
                                    </tr>
                                    <tr>
                                        <td class="text-blue py-2 border-b"><p><?=$lang['b']?><?=(($_POST['ss']!='')? '&#8805; '.$_POST['ss'].")":'&#8805; x)')?></p></p></td>
                                        <td class="py-2 border-b"><b><?=$detail['e']?></b></td>
                                        <td class="p-2 border-b"><b><?=round($detail['e']*100,4)?>%</b></td>
                                    </tr>
                                </table>
                            </div>
                        @else
                            <div class="w-full mt-2 overflow-auto">
                                <table class="w-full">
                                    <tr>
                                        <td class="py-2 border-b"><b>x</b></td>
                                        <td class="py-2 border-b"><b><?=$lang['geo']?></b></td>
                                        <td class="py-2 border-b"><b><?=$lang['geo']?> %</b></td>
                                    </tr>
                                    <?=$detail['table']?>
                                </table>
                            </div>
                        @endif
                        <p class="col-12 overflow-auto mt-4 text-blue">Your Input: \( N = <?=$request->p?>, K = <?=$request->sp?>, n = <?=$request->s?>, k = <?=$request->ss?>\)</p>
                        <p class="col-12 overflow-auto mt-4"> \( Mean (μ) = n * K/N = <?=$request->s?> * <?=$request->sp.'/'.$request->p?> \) </p>
                        <p class="col-12 overflow-auto mt-4"> \( = <?=$request->s*$request->sp?> / <?=$request->p?> \) </p>
                        <p class="col-12 overflow-auto mt-4"> \( = <?=$detail['mean']?>\)</p>
                        <p class="col-12 overflow-auto mt-4"> \( Variance (σ^2) = n * K/N * (N - K)/N * (N - n)/(N - 1) \) </p> 
                        <p class="col-12 overflow-auto mt-4"> \( = <?=$request->s.'*'.$request->sp.'/'.$request->p.'*('.$request->p.'-'.$request->sp.')/'.$request->p.'*('.$request->p.'-'.$request->s.')/('.$request->p.'- 1)'?> \) </p>
                        <p class="col-12 overflow-auto mt-4"> \( = <?=$request->s*$request->sp*($request->p-$request->sp)*($request->p-$request->s)?> / <?=$request->p*$request->p*($request->p-1)?> ≈ <?=$detail['variance']?> \)</p>
                        <p class="col-12 overflow-auto mt-4"> \( \text{Standard deviation} (σ) = \sqrt(n * K/N * (N - K)/N * (N - n)/(N - 1)) \) </p>
                        <p class="col-12 overflow-auto mt-4"> \(= \sqrt(<?=$request->s.'*'.$request->sp.'/'.$request->p.'*('.$request->p.'-'.$request->sp.')/'.$request->p.'*('.$request->p.'-'.$request->s.')/('.$request->p.'- 1)'?>) \) </p>
                        <p class="col-12 overflow-auto mt-4"> \( = \sqrt(<?=$request->s*$request->sp*($request->p-$request->sp)*($request->p-$request->s)?> / <?=$request->p*$request->p*($request->p-1)?>) ≈ <?=$detail['sd']?> \)</p>
                        <p class="col s12 margin_top_20 mt-4 font_size18"><strong>So, Mean (μ) = <?=$detail['mean']?> , Variance (σ<sup>2</sup>) ≈ <?=$detail['variance']?> , Standard deviation (σ) ≈ <?=$detail['sd']?></strong></p>
                      
                        {{-- <div id="container" style="height:250px;" class="col-12 mt-3"></div> --}}
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
@if (isset($detail))
    <script src="https://code.highcharts.com/highcharts.js"></script>
@endif
@push('calculatorJS')
<script type="text/javascript" async
  src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.7/MathJax.js?config=TeX-MML-AM_CHTML">
</script>

<link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
    <script>
        @if (isset($detail))
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
            document.addEventListener('DOMContentLoaded', function () {
                var myChart = Highcharts.chart('container', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: null
                    },
                    xAxis: {
                        <?php if($request->method=='1'){ ?>
                        categories: ['P(X = <?=$request->ss?>)','P(X < <?=$request->ss?>)','P(X ≤ <?=$request->ss?>)','P(X ≥ <?=$request->ss?>)','P(X > <?=$request->ss?>)'],
                        <?php }else{ ?>
                            categories: [<?=$detail['xval']?>],
                        <?php } ?>
                        title: {
                            text: "x"
                        }
                    },
                    yAxis: {
                        title: {
                            text: "P(X=x)"
                        }
                    },
                    tooltip: {
                        crosshairs: true,
                        shared: true,
                    },
                    credits: {
                        enabled: false
                    },
                    legend: {
                        enabled: false
                    },
                    series: [{
                        name: 'P(X=x) = ',
                        <?php if($request->method=='1'){ ?>
                            data: [<?=$detail['a']?>, <?=$detail['b']?>, <?=$detail['c']?>, <?=$detail['e']?>, <?=$detail['d']?>]
                        <?php }else{ ?>
                            data:[<?=$detail['chart']?>]
                        <?php } ?>
                    }]
                });
            });
        @endif
        var method = document.getElementById('method').value;
        updateMethodDisplay(method);

        document.getElementById('method').addEventListener('change', function() {
            var method = this.value;
            updateMethodDisplay(method);
        });

        function updateMethodDisplay(method) {
            if (method === '1') {
                document.querySelectorAll('.chart').forEach(function(element) {
                    element.style.display = 'none';
                });
                document.getElementById('text').textContent = '';
                document.querySelectorAll('.function').forEach(function(element) {
                    element.style.display = 'none';
                });
            } else {
                document.querySelectorAll('.chart').forEach(function(element) {
                    element.style.display = 'block';
                });
                document.getElementById('text').textContent = '<?=$lang['ini']?>';
                document.querySelectorAll('.function').forEach(function(element) {
                    element.style.display = 'block';
                });
            }
        }

    </script>
@endpush