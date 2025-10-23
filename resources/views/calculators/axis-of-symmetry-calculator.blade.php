<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="eq" class="font-s-14 text-blue">{{$lang['1']}} f(x):</label>
                <div class="w-full py-2">
                    <input type="text" name="eq" id="eq" value="{{ isset($_POST['eq'])?$_POST['eq']:'2x^2+5x-1' }}" class="input" aria-label="input" />
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
                    <div class="w-full">
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }}</strong></td>
                                    <td class="py-2 border-b">\( ({{$detail['asal_jawab']}},0) \)</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-12 text-[16px]">
                            <p class="mt-3"><strong>{{$lang['4']}}</strong></p>
                            <p class="mt-3">{{$lang[10]}} \( f(x) = {{$detail['input_eq']}} \).</p>
                            @if($detail['input_eq'] !== $detail['expand_eq'])
                                <p class="mt-3">{{$lang[11]}} \( f(x) = {{$detail['input_eq']}} \).</p>
                                <p class="mt-3">{{$lang[12]}}</p>
                                <p class="mt-3">\( {{$detail['input_eq']}} = {{$detail['expand_eq']}} \).</p>
                            @endif
                            <p class="mt-3">{{$lang[13]}}</p>
                            <p class="mt-3">\( x = - \frac{b}{2a} \)</p>
                            <p class="mt-3">{{$lang[14]}}</p>
                            <p class="mt-3">\( a = {{$detail['coeff_a']}} \)</p>
                            <p class="mt-3">\( b = {{$detail['coeff_b']}} \)</p>
                            <p class="mt-3">\( c = {{$detail['coeff_c']}} \)</p>
                            <p class="mt-3">{{$lang[15]}}</p>
                            <p class="mt-3">\( x = - \frac{b}{2a} = - \frac{ {{$detail['coeff_b']}}}{2 × {{$detail['coeff_a']}}} = {{$detail['asal_jawab']}} \)</p>
                            <p class="mt-3">{{$lang['16']}} \( ({{$detail['asal_jawab']}},0) \)</p>
                            <p class="mt-3">{{$lang['17']}}</p>
                            <div id="box1" class="col-lg-8 mt-4 mx-auto" style="height: 350px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @push('calculatorJS')
            @isset($detail)
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script>
                    google.charts.load("current", {packages:["corechart"]});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data = new google.visualization.DataTable();
                        data.addColumn('number');
                        data.addColumn('number');
                        var a='{{$detail['coeff_a']}}';
                        var b='{{$detail['coeff_b']}}';
                        var c='{{$detail['coeff_c']}}';
                        var firstx='{{($detail['coeff_b'] * (-1)) / ($detail['coeff_a']*2)}}';
                        firstx=parseFloat(firstx) + parseFloat(25);
                        for (var i = 0; i <=50 ; i++) {
                            var first_part=Math.pow(firstx,2)*a;
                            var second_part=b*firstx;
                            if (second_part<0 && c<0) {
                                var eq=first_part+' '+second_part+' '+c;
                            }
                            if (second_part<0 && c>=0) {
                                var eq=first_part+' '+second_part+' + '+c;
                            }
                            if (second_part>=0 && c<0) {
                                var eq=first_part+' + '+second_part+' '+c;
                            }
                            if (second_part>=0 && c>=0) {
                                var eq=first_part+' + '+second_part+' + '+c;
                            }
                            var yaxis=eval(eq);
                            yaxis=parseFloat(yaxis);
                            firstx=parseFloat(firstx);
                            data.addRow([firstx, yaxis]);
                            firstx=parseFloat(firstx)-1;
                        }

                        var options = {
                            legend: 'none',
                            colors: ['#13699E'],
                            lineWidth: 1,
                            pointSize: 0,
                            hAxis: {title: 'x-axis'},
                            vAxis: {title: 'y-axis'},
                        };

                        var chart = new google.visualization.ScatterChart(document.getElementById('box1'));

                        chart.draw(data, options);
                        chart.draw(data, options);
                    }
                </script>
            @endisset
            <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
            <script type="text/x-mathjax-config">
                MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
            </script>
        @endpush
    @endisset
</form>