<style>
    img{
        object-fit: contain;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @php $request = request(); @endphp
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="t1" class="label">{{$lang[1]}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="t1" id="t1" class="input" value="{{ isset($request->t1) ? $request->t1 : '2' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="y1" class="label">{{$lang[2]}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="y1" id="y1" class="input" value="{{ isset($request->y1) ? $request->y1 : '4' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="t2" class="label">{{$lang[3]}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="t2" id="t2" class="input" value="{{ isset($request->t2) ? $request->t2 : '5' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="y2" class="label">{{$lang[4]}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="y2" id="y2" class="input" value="{{ isset($request->y2) ? $request->y2 : '5' }}" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="point_optional" class="label">{{$lang[5]}}</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="point_optional" id="point_optional" class="input" value="{{ isset($request->point_optional) ? $request->point_optional : '' }}" aria-label="input" />
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
                    @php
                        $t1 = $request->t1;
                        $y1 = $request->y1;
                        $t2 = $request->t2;
                        $y2 = $request->y2;
                        $point_optional = $request->point_optional;
                    @endphp
                    <div class="w-full">
                        <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['6'] }}</strong></td>
                                    <td class="py-2 border-b">{{$detail['A']}} x e<sup class="font-s-14">{{$detail['k']}}t</sup></td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-3"><strong>{{$lang[16]}}</strong></p>
                            <p class="mt-3">{{$lang[11]}}</p>
                            <p class="mt-3">{{$lang[12]}} (t<sub class="font-s-14">1</sub>) = {{$t1}}</p>
                            <p class="mt-3">{{$lang[14]}} (y1) = {{$y1}}</p>
                            <p class="mt-3">{{$lang[13]}} (t<sub class="font-s-14">2</sub>) = {{$t2}}</p>
                            <p class="mt-3">{{$lang[15]}} (y2) = {{$y2}}</p>
                            <p class="mt-3">{{ $lang[17] }}</p>
                            <p class="mt-3">\( f(t) = A_0e^{kt} \)</p>
                            <p class="mt-3">{{ $lang[18] }}<sub class="font-s-14">0</sub>{{ $lang[19] }}</p>
                            <p class="mt-3">\( y_1 = A_0e^{kt_1} \)</p>
                            <p class="mt-3">\( y_2 = A_0e^{kt_2} \)</p>
                            <p class="mt-3">{{ $lang[20] }} Divide y<sub class="font-s-14">1</sub> by y<sub class="font-s-14">2</sub> to cancel A<sub class="font-s-14">0</sub></p>
                            <p class="mt-3">\( \dfrac{y_1}{y_2} = \dfrac{A_0e^{kt_1}}{A_0e^{kt_2}} \)</p>
                            <p class="mt-3">\( => \dfrac{y_1}{y_2} = \dfrac{\require{cancel}\cancel{A_0}e^{kt_1}}{\require{cancel}\cancel{A_0}e^{kt_2}} \)</p>
                            <p class="mt-3">\( => \dfrac{y_1}{y_2} = \dfrac{e^{kt1}}{e^{kt_2}} \)</p>
                            <p class="mt-3">{{ $lang[21] }}{{ $lang[22] }}</p>
                            <p class="mt-3">\( \dfrac{y_1}{y_2} = \dfrac{e^{kt_1}}{e^{kt_2}} \)</p>
                            <p class="mt-3">\( \dfrac{y_1}{y_2} = e^{kt_1}.e^{kt_2} \)</p>
                            <p class="mt-3">\( \dfrac{y_1}{y_2} = e^{k(t_1 - t_2)} \)</p>
                            <p class="mt-3">{{ $lang[23] }}</p>
                            <p class="mt-3">\( In ({\dfrac{y_1}{y_2}}) = In(e^{k(t_1 - t_2)}) \)</p>
                            <p class="mt-3">\( In ({\dfrac{y_1}{y_2}}) = e.k(t_1 - t_2)  \)</p>
                            <p class="mt-3">\(  k = \dfrac{1}{t_1 - t_2} In ({\dfrac{y_1}{y_2}}) \)</p>
                            <p class="mt-3">{{ $lang[24] }}{{ $lang[25] }}</p>
                            <p class="mt-3">\(  y_1 = A_0e^{kt_1} \)</p>
                            <p class="mt-3">or</p>
                            <p class="mt-3">\( A_0 = y_1e^{-kt_1} \)</p>
                            <p class="mt-3">{{ $lang[26] }}</p>
                            <p class="mt-3">\(  A_0 = y_1e^{-({\dfrac{1}{t_1 - t_2} In ({\dfrac{y_1}{y_2}})})t_1} \)</p>
                            <p class="mt-3">\(  A_0 = \require{cancel}\cancel{y_1} × \dfrac{y_2}{\require{cancel}\cancel{y_1}e^{kt_2}} \)</p>
                            <p class="mt-3">\(  A_0 = y_2e^{-kt_2} \)</p>
                            <p class="mt-3">{{ $lang[27] }}{{ $lang[28] }}<sub class="font-s-14">0</sub>{{ $lang[29] }}<sub class="font-s-14">0</sub>.</p>
                            <p class="mt-3">\(  k = \dfrac{1}{ {{ $t1 }} - {{ $t2 }}} In ({\dfrac{{{ $y1 }}}{{{ $y2 }}}}) \)</p>
                            <p class="mt-3">\(  k = {{ $detail['k'] }} \)</p>
                            <p class="mt-3">{{ $lang[30] }}</p>
                            <p class="mt-3">\( A_0 = y_2e^{-kt_2} \)</p>
                            <p class="mt-3">\( A_0 = {{$y2}}×e^{-{{$detail['k']}}×{{$t2}}} \)</p>
                            <p class="mt-3">{{$lang[31]}}{{$lang[32]}}</p>
                            <p class="mt-3">\( f(t) = A_0e^{kt} \)</p>
                            <p class="mt-3">\( f(t) = {{$detail['A']}}e^{ {{$detail['k']}}t} \)</p>
                            @if(!empty($point_optional))
                                <p class="mt-3"><?=$lang[33]?> <?=$lang[34]?><?=$point_optional?>, so we have:</p>
                                <p class="mt-3">\( f(<?=$point_optional?>) = <?=$detail['A']?>e^{<?=$detail['k']?>×<?=$point_optional?>} \)</p>
                                <p class="mt-3">\( f(<?=$point_optional?>) = <?=$detail['f']?> \)</p>
                            @else
                                <p class="mt-3"><?=$lang[33]?><?=$lang[34]?> 2, so we have:</p>
                                <p class="mt-3">\( f(2) = <?=$detail['A']?>e^{<?=$detail['k']?>×2} \)</p>
                                <p class="mt-3">\( f(2) = <?=$detail['f']?> \)</p>
                            @endif
                            <p class="mt-3"><?=$lang[7]?></p>
                            <p class="mt-3">
                                @if($detail['k']>0)
                                    <?=$lang[8]?>
                                @else
                                    <?=$lang[9]?>
                                @endif
                            </p>
                            <div id="curve_chart" class="col-lg-8 mx-auto my-3 overflow-auto" style="height: 500px;"></div>
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
            <script>
                google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = new google.visualization.DataTable();
                    data.addColumn('number','x');
                    data.addColumn('number','f (x)');
                    var A = "{{$detail['A']}}";
                    var k = "{{$detail['k']}}";
                    var t = "{{is_numeric($point_optional)?$point_optional:'2'}}";
                    var time = t + 8;
                    for(var i=0.01;i<=time;i++){
                        var e = Math.exp(k*i);
                        var f = A*e;
                        i = parseFloat(i);
                        f = parseFloat(f);
                        data.addRow([i,f]);
                    }
                    var options = {
                        colors: ['#13699E'],
                        lineWidth: 1,
                        pointSize: 0,
                        hAxis: {title: 'x'},
                        vAxis: {title: 'f(x)'},
                    }
                    var chart = new google.visualization.ScatterChart(document.getElementById('curve_chart'));
                    chart.draw(data, options);   
                }
            </script>
        @endisset
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({"SVG": {linebreaks: { automatic: true }} });
        </script>
    @endpush
</form>