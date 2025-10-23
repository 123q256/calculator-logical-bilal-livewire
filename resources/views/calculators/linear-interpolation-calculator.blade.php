<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
           @if(app()->getLocale() == "tr")
               <span></span>
           @else
               <p class="my-2 text-[16px] px-2">{{$lang['1']}}</p>
           @endif
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-6">
                    <label for="x1" class="label">x₁:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="x1" id="x1" value="{{ isset($_POST['x1'])?$_POST['x1']:'200' }}" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="y1" class="label">y₁:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="y1" id="y1" value="{{ isset($_POST['y1'])?$_POST['y1']:'15' }}" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="x2" class="label">x₂:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="x2" id="x2" value="{{ isset($_POST['x2'])?$_POST['x2']:'300' }}" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="y2" class="label">y₂:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="y2" id="y2" value="{{ isset($_POST['y2'])?$_POST['y2']:'20' }}" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="x3" class="label">x₃:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="x3" id="x3" value="{{ isset($_POST['x3'])?$_POST['x3']:'250' }}" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="y3" class="label">y₃:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="y3" id="y3" value="{{ isset($_POST['y3'])?$_POST['y3']:'' }}" class="input" aria-label="input" />
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
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%">
                                            <strong>
                                                @php
                                                    if(isset($detail['x1'])){
                                                        echo "x1";
                                                    }elseif(isset($detail['y1'])){
                                                        echo "y1";
                                                    }elseif(isset($detail['x2'])){
                                                        echo "x2";
                                                    }elseif(isset($detail['y2'])){
                                                        echo "y2";
                                                    }elseif(isset($detail['x3'])){
                                                        echo "x3";
                                                    }elseif(isset($detail['y3'])){
                                                        echo "y3";
                                                    }
                                                @endphp
                                            </strong>
                                        </td>
                                        <td class="py-2 border-b">
                                            @php
                                                if(isset($detail['x1'])){
                                                    echo $detail['x1'];
                                                }elseif(isset($detail['y1'])){
                                                    echo $detail['y1'];
                                                }elseif(isset($detail['x2'])){
                                                    echo $detail['x2'];
                                                }elseif(isset($detail['y2'])){
                                                    echo $detail['y2'];
                                                }elseif(isset($detail['x3'])){
                                                    echo $detail['x3'];
                                                }elseif(isset($detail['y3'])){
                                                    echo $detail['y3'];
                                                }
                                            @endphp
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full">
                                <p class="mt-3"><strong>{{$lang['2']}}</strong></p>
                                <p class="mt-3">{{$lang['3']}}</p>
                                <p class="mt-3">\( x₁ = {{(isset($detail['x1']))?'?':$_POST['x1']}}, \)</p>
                                <p class="mt-3">\( y₁ = {{(isset($detail['y1']))?'?':$_POST['y1']}}, \)</p>
                                <p class="mt-3">\( x₂ = {{(isset($detail['x2']))?'?':$_POST['x2']}}, \)</p>
                                <p class="mt-3">\( y₂ = {{(isset($detail['y2']))?'?':$_POST['y2']}}, \)</p>
                                <p class="mt-3">\( x₃ = {{(isset($detail['x3']))?'?':$_POST['x3']}}, \)</p>
                                <p class="mt-3">\( y₃ = {{(isset($detail['y3']))?'?':$_POST['y3']}} \)</p>
                                <p class="mt-3">{{$lang['4']}}</p>
                                @php
                                    $s1=$detail['s1'];
                                    $s2=$detail['s2'];
                                    $s3=$detail['s3'];
                                    $s4=$detail['s4'];
                                    $s5=$detail['s5'];
                                @endphp 
                                @if(isset($detail['x1']))
                                    <p class="mt-3">\( x₁ = \) \( {( y₃ - y₁ ) * ( x₂ - x₃ ) \over ( y₃ - y₂ )} \)\( + x₃ \)</p>
                                    <p class="mt-3">{{$lang['5']}}</p>
                                    <p class="mt-3">\( x₁ = \) \( {( y₃ - y₁ ) * ( x₂ - x₃ ) \over ( y₃ - y₂ )} \)\( + x₃ \)</p>
                                    <p class="mt-3">\( x₁ = \) \( {( {{$_POST['y3'].'-'.$_POST['y1']}} ) * ( {{$_POST['x2'].'-'.$_POST['x3']}} ) \over ( {{$_POST['y3'].'-'.$_POST['y2']}} )} \)\( + {{$_POST['x3']}} \)</p>
                                    <p class="mt-3">\( x₁ = \) \( {{'('.$s1.') * ('.$s2.')'}} \over {{'('.$s3.')'}} \)\( + {{$_POST['x3']}} \)</p>
                                    <p class="mt-3">\( x₁ = \) \( {{'('.$s4.')'}} \over {{'('.$s3.')'}} \)\( + {{$_POST['x3']}} \)</p>
                                    <p class="mt-3">\( x₁ = {{$s5.'+'.$_POST['x3']}} \)</p>
                                    <p class="mt-3">\( x₁ = {{$detail['x1']}} \)</p>
                                @elseif(isset($detail['y1']))
                                    <p class="mt-3">\( y₁ = \) \( {( x₂ - x₁ ) * ( y₃ - y₂ ) \over ( x₃ - x₁ )} \)\( + y₂ \)</p>
                                    <p class="mt-3">{{$lang['5']}}</p>
                                    <p class="mt-3">\( y₁ = \) \( {( x₂ - x₁ ) * ( y₃ - y₂ ) \over ( x₃ - x₁ )} \)\( + y₂ \)</p>
                                    <p class="mt-3">\( y₁ = \) \( {( {{$_POST['x2'].'-'.$_POST['x1']}} ) * ( {{$_POST['y3'].'-'.$_POST['y2']}} ) \over ( {{$_POST['x3'].'-'.$_POST['x1']}} )} \)\( + {{$_POST['y2']}} \)</p>
                                    <p class="mt-3">\( y₁ = \) \( {{'('.$s1.') * ('.$s2.')'}} \over {{'('.$s3.')'}} \)\( + {{$_POST['y2']}} \)</p>
                                    <p class="mt-3">\( y₁ = \) \( {{'('.$s4.')'}} \over {{'('.$s3.')'}} \)\( + {{$_POST['y2']}} \)</p>
                                    <p class="mt-3">\( y₁ = {{$s5.'+'.$_POST['y2']}} \)</p>
                                    <p class="mt-3">\( y₁ = {{$detail['y1']}} \)</p>
                                @elseif(isset($detail['x2']))
                                    <p class="mt-3">\( x₂ = \) \( {( y₁ - y₂ ) * ( x₃ - x₁ ) \over ( y₁ - y₃ )} \)\( + x₁ \)</p>
                                    <p class="mt-3">{{$lang['5']}}</p>
                                    <p class="mt-3">\( x₂ = \) \( {( y₁ - y₂ ) * ( x₃ - x₁ ) \over ( y₁ - y₃ )} \)\( + x₁ \)</p>
                                    <p class="mt-3">\( x₂ = \) \( {( {{$_POST['y1'].'-'.$_POST['y2']}} ) * ( {{$_POST['x3'].'-'.$_POST['x1']}} ) \over ( {{$_POST['y1'].'-'.$_POST['y3']}} )} \)\( + {{$_POST['x1']}} \)</p>
                                    <p class="mt-3">\( x₂ = \) \( {{'('.$s1.') * ('.$s2.')'}} \over {{'('.$s3.')'}} \)\( + {{$_POST['x1']}} \)</p>
                                    <p class="mt-3">\( x₂ = \) \( {{'('.$s4.')'}} \over {{'('.$s3.')'}} \)\( + {{$_POST['x1']}} \)</p>
                                    <p class="mt-3">\( x₂ = {{$s5.'+'.$_POST['x1']}} \)</p>
                                    <p class="mt-3">\( x₂ = {{$detail['x2']}} \)</p>
                                @elseif(isset($detail['y2']))
                                    <p class="mt-3">\( y₂ = \) \( {( x₃ - x₂ ) * ( y₃ - y₁ ) \over ( x₃ - x₂ )} \)\( + y₃ \)</p>
                                    <p class="mt-3">{{$lang['5']}}</p>
                                    <p class="mt-3">\( y₂ = \) \( {( x₃ - x₂ ) * ( y₃ - y₁ ) \over ( x₃ - x₂ )} \)\( + y₃ \)</p>
                                    <p class="mt-3">\( y₂ = \) \( {( {{$_POST['x3'].'-'.$_POST['x2']}} ) * ( {{$_POST['y3'].'-'.$_POST['y1']}} ) \over ( {{$_POST['x3'].'-'.$_POST['x2']}} )} \)\( + {{$_POST['y3']}} \)</p>
                                    <p class="mt-3">\( y₂ = \) \( {{'('.$s1.') * ('.$s2.')'}} \over {{'('.$s3.')'}} \)\( + {{$_POST['y3']}} \)</p>
                                    <p class="mt-3">\( y₂ = \) \( {{'('.$s4.')'}} \over {{'('.$s3.')'}} \)\( + {{$_POST['y3']}} \)</p>
                                    <p class="mt-3">\( y₂ = {{$s5.'+'.$_POST['y3']}} \)</p>
                                    <p class="mt-3">\( y₂ = {{$detail['y2']}} \)</p>
                                @elseif(isset($detail['x3']))
                                    <p class="mt-3">\( x₃ = \) \( {( y₃ - y₂ ) * ( x₁ - x₂ ) \over ( y₁ - y₂ )} \)\( + x2 \)</p>
                                    <p class="mt-3">{{$lang['5']}}</p>
                                    <p class="mt-3">\( x₃ = \) \( {( y₃ - y₂ ) * ( x₁ - x₂ ) \over ( y₁ - y₂ )} \)\( + x2 \)</p>
                                    <p class="mt-3">\( x₃ = \) \( {( {{$_POST['y3'].'-'.$_POST['y2']}} ) * ( {{$_POST['x1'].'-'.$_POST['x2']}} ) \over ( {{$_POST['y1'].'-'.$_POST['y2']}} )} \)\( + {{$_POST['x2']}} \)</p>
                                    <p class="mt-3">\( x₃ = \) \( {{'('.$s1.') * ('.$s2.')'}} \over {{'('.$s3.')'}} \)\( + {{$_POST['x2']}} \)</p>
                                    <p class="mt-3">\( x₃ = \) \( {{'('.$s4.')'}} \over {{'('.$s3.')'}} \)\( + {{$_POST['x2']}} \)</p>
                                    <p class="mt-3">\( x₃ = {{$s5.'+'.$_POST['x2']}} \)</p>
                                    <p class="mt-3">\( x₃ = {{$detail['x3']}} \)</p>
                                @elseif(isset($detail['y3']))
                                    <p class="mt-3">\( y₃ = \) \( {( x₃ - x₁ ) * ( y₂ - y₁ ) \over ( x₂ - x₁ )} \)\( + y₁ \)</p>
                                    <p class="mt-3">{{$lang['5']}}</p>
                                    <p class="mt-3">\( y₃ = \) \( {( x₃ - x₁ ) * ( y₂ - y₁ ) \over ( x₂ - x₁ )} \)\( + y₁ \)</p>
                                    <p class="mt-3">\( y₃ = \) \( {( {{$_POST['x3'].'-'.$_POST['x1']}} ) * ( {{$_POST['y2'].'-'.$_POST['y1']}} ) \over ( {{$_POST['x2'].'-'.$_POST['x1']}} )} \)\( + {{$_POST['y1']}} \)</p>
                                    <p class="mt-3">\( y₃ = \) \( {{'('.$s1.') * ('.$s2.')'}} \over {{'('.$s3.')'}} \)\( + {{$_POST['y1']}} \)</p>
                                    <p class="mt-3">\( y₃ = \) \( {{'('.$s4.')'}} \over {{'('.$s3.')'}} \)\( + {{$_POST['y1']}} \)</p>
                                    <p class="mt-3">\( y₃ = {{$s5.'+'.$_POST['y1']}} \)</p>
                                    <p class="mt-3">\( y₃ = {{$detail['y3']}} \)</p>
                                @endif
                                <div id="box1" class="col-lg-8 mt-4 mx-auto" style="height: 350px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        @isset($detail)
            <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
            <script type="text/x-mathjax-config">
                MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
            </script>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart(){
                    var data = google.visualization.arrayToDataTable([
                        ['x', 'y'],
                        @if(isset($detail['x1']))
                            [{{ $detail['x1'] }}, {{ $_POST['y1'] }}],
                            [{{ $_POST['x3'] }}, {{ $_POST['y3'] }}],
                            [{{ $_POST['x2'] }}, {{ $_POST['y2'] }}]
                        @elseif(isset($detail['y1']))
                            [{{ $_POST['x1'] }}, {{ $detail['y1'] }}],
                            [{{ $_POST['x3'] }}, {{ $_POST['y3'] }}],
                            [{{ $_POST['x2'] }}, {{ $_POST['y2'] }}]
                        @elseif(isset($detail['x2']))
                            [{{ $_POST['x1'] }}, {{ $_POST['y1'] }}],
                            [{{ $_POST['x3'] }}, {{ $_POST['y3'] }}],
                            [{{ $detail['x2'] }}, {{ $_POST['y2'] }}]
                        @elseif(isset($detail['y2']))
                            [{{ $_POST['x1'] }}, {{ $_POST['y1'] }}],
                            [{{ $_POST['x3'] }}, {{ $_POST['y3'] }}],
                            [{{ $_POST['x2'] }}, {{ $detail['y2'] }}]
                        @elseif(isset($detail['x3']))
                            [{{ $_POST['x1'] }}, {{ $_POST['y1'] }}],
                            [{{ $detail['x3'] }}, {{ $_POST['y3'] }}],
                            [{{ $_POST['x2'] }}, {{ $_POST['y2'] }}]
                        @elseif(isset($detail['y3']))
                            [{{ $_POST['x1'] }}, {{ $_POST['y1'] }}],
                            [{{ $_POST['x3'] }}, {{ $detail['y3'] }}],
                            [{{ $_POST['x2'] }}, {{ $_POST['y2'] }}]
                        @endif
                    ]);
                    var options = {
                        title: 'The point of interpolation is plotted on a line',
                        hAxis: {title: 'x'},
                        vAxis: {title: 'y'},
                        legend: 'none',
                        trendlines: { 0: {} }
                    };
                    var chart = new google.visualization.ScatterChart(document.getElementById('box1'));
                    chart.draw(data, options);
                }
            </script>            
        @endisset
    @endpush
</form>