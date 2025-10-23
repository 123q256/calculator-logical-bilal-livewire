<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
        @php $request = request(); @endphp

            <div class="grid grid-cols-1  gap-4">
                <div class="space-y-2">
                    <label for="formula" class="font-s-14 text-blue">{{ $lang['e_f'] }}:</label>
                    <select class="input" aria-label="select" name="formula" id="formula">
                        <option value="1">Ax² + Bx + C = 0</option>
                        <option value="2" {{ isset($request->formula) && $request->formula=='2'?'selected':'' }}>A(x - H)² + K = 0</option>
                        <option value="3" {{ isset($request->formula) && $request->formula=='3'?'selected':'' }}>A(x - x₁)(x - x₂) = 0</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="method" class="font-s-14 text-blue">{{ $lang['c_m'] }}:</label>
                    <select class="input" aria-label="select" name="method" id="method">
                        <option value="2">{{$lang['q_f']}}</option>
                        <option value="1" {{ isset($request->method) && $request->method=='1'?'selected':'' }}>{{$lang['c_s']}}</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-3  lg:grid-cols-3 md:grid-cols-3  mt-4 gap-4">
                <div class="space-y-2">
                    <label for="a" class="font-s-14 text-blue">{{$lang['Enter']}} A</label>
                    <input type="number" step="any" name="a" id="a" class="input" value="{{ isset($request->a)?$request->a:'2' }}" aria-label="input"/>
                </div>
                <div class="space-y-2">
                    <label for="b" class="font-s-14 text-blue enter_b">
                        @if(isset($request->formula) && $request->formula=='2')
                            {{$lang['Enter']}} H
                        @elseif(isset($request->formula) && $request->formula=='3')
                            {{$lang['Enter']}} x₁
                        @else  
                            {{$lang['Enter']}} B
                        @endif
                    </label>
                    <input type="number" step="any" name="b" id="b" class="input" value="{{ isset($request->b)?$request->b:'-6' }}" aria-label="input"/>
                </div>
                <div class="space-y-2">
                    <label for="c" class="font-s-14 text-blue enter_c">
                        @if(isset($request->formula) && $request->formula=='2')
                            {{$lang['Enter']}} K
                        @elseif(isset($request->formula) && $request->formula=='3')
                            {{$lang['Enter']}} x₂
                        @else  
                            {{$lang['Enter']}} C
                        @endif
                    </label>
                    <input type="number" step="any" name="c" id="c" class="input" value="{{ isset($request->c)?$request->c:'-13' }}" aria-label="input"/>
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
                    <div class="w-full bg-light-blue  p-3 radius-10 mt-3">
                        <div class="row">
                            <div class="col-12 font-s-16">
                                <p class="mt-2 font-s-18"><strong>{{$detail['roots']}}</strong></p>
                                @if($request->method=='2')
                                    <p class="mt-2 font-s-18"><strong>{{$lang['t_d']}} = {{$detail['dis']}}</strong></p>
                                @endif
                                <p class="mt-2"><strong>Solution:</strong></p>
                                <p class="mt-2">Standard Form: \( {{$request->a}}x^2 {{(($detail['B']<0)?$detail['B']:' + '.$detail['B'])}}x {{(($detail['C']<0)?$detail['C']:' + '.$detail['C'])}} = 0 \)
                                </p>
                                <p class="mt-2">Vertex Form: \( {{$detail['vertex']}} = 0 \)</p>
                                <p class="mt-2">Factored Form: \(  {{$detail['fact']}} = 0 \)</p>
                                @if($request->method=='1')
                                    <p class="mt-2">{{$lang['ans_s_c']}}</p>
                                    <p class="mt-2">a = {{$request->a}}, b = {{$detail['B']}}, & c = {{$detail['C']}}</p>
                                    @if($request->a!=1)
                                        <p class="mt-2">\( a \ne 1 \) {{$lang['divide']}} {{$request->a}}</p>
                                        <p class="mt-2">
                                            \( { x^2}{{(($detail['B']<0)?' - ':' + ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}} x}{ {{$request->a}} } = {{(($detail['C']<0)?' ':' - ')}} \frac{ {{(($detail['C']<0)?($detail['C']*(-1)):$detail['C'])}}}{ {{$request->a}} } \)
                                        </p>
                                        <p class="mt-2">{{$lang['half']}} \( x \) {{$lang['add_s']}}</p>
                                        <p class="mt-2">
                                            \( { x^2}{{(($detail['B']<0)?' - ':' + ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}} x}{ {{$request->a}} } + \frac{ {{pow($detail['B'],2)}} }{ {{pow(($request->a*2),2)}} } = {{(($detail['C']<0)?' ':' - ')}} \frac{ {{(($detail['C']<0)?($detail['C']*(-1)):$detail['C'])}}}{ {{$request->a}} } + \frac{ {{pow($detail['B'],2)}} }{ {{pow(($request->a*2),2)}} } \)
                                        </p>
                                        <p class="mt-2">
                                            \( ({ x }{{(($detail['B']<0)?' - ':' + ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}}}{ {{$request->a*2}} })^2  = {{(($detail['C']<0)?' ':' - ')}} \frac{ {{(($detail['C']<0)?($detail['C']*(-1)):$detail['C'])}}}{ {{$request->a}} } + \frac{ {{pow($detail['B'],2)}} }{ {{pow(($request->a*2),2)}} } \)
                                        </p>
                                        @php
                                            $right_side=pow(($request->a*2),2) / $request->a;
                                            $right_side= (($detail['C'] * (-1)) * $right_side) + (pow($detail['B'],2));
                                        @endphp
                                        <p class="mt-2">
                                            \( ({ x }{{(($detail['B']<0)?' - ':' + ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}}}{ {{$request->a*2}} })^2  = {{(($detail['C']<0)?' ':' - ')}} \frac{ {{$right_side}} }{ {{pow(($request->a*2),2)}} } \)
                                        </p>
                                        @php
                                            if ($right_side<0) {
                                                $right_side=$right_side * (-1);
                                                $i='\, i';
                                            }
                                        @endphp
                                        @if($right_side!=0)
                                            <p class="mt-2">
                                                \( { x }{{(($detail['B']<0)?' - ':' + ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}}}{ {{$request->a*2}} }  = \pm \sqrt{ {{(($right_side<0)?' - ':' ')}} \frac{ {{$right_side}} }{ {{pow(($request->a*2),2)}} }} {{@$i}} \)
                                            </p>
                                            <p class="mt-2">
                                                \( { x }  = {{(($detail['B']<0)?' + ':' - ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}}}{ {{$request->a*2}} } \pm \sqrt{ {{(($right_side<0)?' - ':' ')}} \frac{ {{$right_side}} }{ {{pow(($request->a*2),2)}} }} {{@$i}} \)
                                            </p>
                                            <p class="mt-2">
                                                \( { x₁ }  = {{(($detail['B']<0)?' + ':' - ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}}}{ {{$request->a*2}} } + \sqrt{ {{(($right_side<0)?' - ':' ')}} \frac{ {{$right_side}} }{ {{pow(($request->a*2),2)}} }} {{@$i}} , { x₁ = {{$detail['x1']}} } {{@$i}} \)
                                            </p>
                                            <p class="mt-2">
                                                \( { x₂ }  = {{(($detail['B']<0)?' + ':' - ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}}}{ {{$request->a*2}} } - \sqrt{ {{(($right_side<0)?' - ':' ')}} \frac{ {{$right_side}} }{ {{pow(($request->a*2),2)}} }} {{@$i}} , { x₂ = {{$detail['x2']}} } {{@$i}} \)
                                            </p>
                                        @endif
                                        @if($right_side==0)
                                            <p class="mt-2">
                                                \( { x }{{(($detail['B']<0)?' - ':' + ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}}}{ {{$request->a*2}} }  = \pm \sqrt{ {{(($right_side<0)?' - ':' ')}} { {{$right_side}} }} \)
                                            </p>
                                            <p class="mt-2">
                                                \( { x }  = {{(($detail['B']<0)?' + ':' - ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}}}{ {{$request->a*2}} } , { x = {{$detail['x1']}} }\)
                                            </p>
                                        @endif
                                    @elseif($request->a==1)
                                        <p class="mt-2">
                                            \( { x^2}{{(($detail['B']<0)?' - ':' + ')}} { {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}} x} = {{(($detail['C']<0)?' ':' - ')}} { {{(($detail['C']<0)?($detail['C']*(-1)):$detail['C'])}}}\)
                                        </p>
                                        <p class="mt-2">{{$lang['half']}} \( x \) {{$lang['add_s']}}</p>
                                        @if(is_int(($detail['B']/2)))
                                            <p class="mt-2">
                                                \( { x^2}{{(($detail['B']<0)?' - ':' + ')}} { {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}} x} + { {{pow(($detail['B']/2),2)}} } = {{(($detail['C']<0)?' ':' - ')}} { {{(($detail['C']<0)?($detail['C']*(-1)):$detail['C'])}}} + { {{pow(($detail['B']/2),2)}} } \)
                                            </p>
                                            <p class="mt-2">
                                                \(({ x }{{(($detail['B']<0)?' - ':' + ')}} { {{(($detail['B']<0)?(($detail['B']*(-1))/2):($detail['B']/2))}} })^2  = {{(($detail['C']<0)?' ':' - ')}} { {{(($detail['C']<0)?($detail['C']*(-1)):$detail['C'])}} } + { {{pow(($detail['B']/2),2)}} } \)
                                            </p>
                                            @php
                                                $right_side= ($detail['C'] * (-1)) + pow(($detail['B']/2),2);
                                                if ($right_side<0) {
                                                    $right_side=$right_side * (-1);
                                                    $i='\, i';
                                                } 
                                            @endphp
                                            @if($right_side!=0)
                                                <p class="mt-2">
                                                    \( { x }{{(($detail['B']<0)?' - ':' + ')}} { {{(($detail['B']<0)?(($detail['B']*(-1))/2):($detail['B']/2))}}} = \pm \sqrt{ {{(($right_side<0)?' - ':' ')}} { {{$right_side}} }} {{@$i}} \)
                                                </p>
                                                <p class="mt-2">
                                                    \( { x } = {{(($detail['B']<0)?' ':' - ')}} { {{(($detail['B']<0)?(($detail['B']*(-1))/2):($detail['B']/2))}}} \pm \sqrt{ {{(($right_side<0)?' - ':' ')}} { {{$right_side}} }} {{@$i}} \)
                                                </p>
                                                <p class="mt-2">
                                                    \( { x₁ } = {{(($detail['B']<0)?' ':' - ')}} { {{(($detail['B']<0)?(($detail['B']*(-1))/2):($detail['B']/2))}}} + \sqrt{ {{(($right_side<0)?' - ':' ')}} { {{$right_side}} }} {{@$i}} , { x₁ = {{$detail['x1']}} } {{@$i}} \)
                                                </p>
                                                <p class="mt-2">
                                                    \( { x₂ } = {{(($detail['B']<0)?' ':' - ')}} { {{(($detail['B']<0)?(($detail['B']*(-1))/2):($detail['B']/2))}}} - \sqrt{ {{(($right_side<0)?' - ':' ')}} { {{$right_side}} }} {{@$i}} , { x₂ = {{$detail['x2']}} } {{@$i}}\)
                                                </p>
                                            @endif
                                            @if($right_side==0)
                                                <p class="mt-2">
                                                    \( { x }{{(($detail['B']<0)?' - ':' + ')}} { {{(($detail['B']<0)?(($detail['B']*(-1))/2):($detail['B']/2))}}} = \pm \sqrt{ { {{$right_side}} }} \)
                                                </p>
                                                <p class="mt-2">
                                                    \( { x }  = {{(($detail['B']<0)?' + ':' - ')}} { {{(($detail['B']<0)?(($detail['B']*(-1))/2):($detail['B']/2))}}}\)
                                                </p>
                                            @endif
                                        @else
                                            <p class="mt-2">
                                                \( { x^2}{{(($detail['B']<0)?' - ':' + ')}} { {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}} x} + \frac{ {{pow(($detail['B']),2)}} }{4} = {{(($detail['C']<0)?' ':' - ')}} { {{(($detail['C']<0)?($detail['C']*(-1)):$detail['C'])}}} + \frac{ {{pow(($detail['B']),2)}} }{4} \)
                                            </p>
                                            <p class="mt-2">
                                                \(({ x }{{(($detail['B']<0)?' - ':' + ')}} \frac{ {{(($detail['B']<0)?(($detail['B']*(-1))):($detail['B']))}} }{2})^2  = {{(($detail['C']<0)?' ':' - ')}} { {{(($detail['C']<0)?($detail['C']*(-1)):$detail['C'])}} } + \frac{ {{pow(($detail['B']),2)}} }{4} \)
                                            </p>
                                            @php
                                                $right_side= ($detail['C'] * (-1) * 4) + pow(($detail['B']),2);
                                                if ($right_side<0) {
                                                    $right_side=$right_side * (-1);
                                                    $i='\, i';
                                                }
                                            @endphp
                                            @if($right_side!=0)
                                                <p class="mt-2">
                                                    \( { x }{{(($detail['B']<0)?' - ':' + ')}} \frac{ {{(($detail['B']<0)?(($detail['B']*(-1))):($detail['B']))}} }{2} = \pm \sqrt{ {{(($right_side<0)?' - ':' ')}} \frac{ {{$right_side}} }{4}} {{@$i}} \)
                                                </p> 
                                                <p class="mt-2">
                                                    \( { x } ={{(($detail['B']<0)?' ':' - ')}} \frac{ {{(($detail['B']<0)?(($detail['B']*(-1))):($detail['B']))}} }{2} \pm \sqrt{ {{(($right_side<0)?' - ':' ')}} \frac{ {{$right_side}} }{4}} {{@$i}} \)
                                                </p>
                                                <p class="mt-2">
                                                    \( {x₁} ={{(($detail['B']<0)?' ':' - ')}} \frac{ {{(($detail['B']<0)?(($detail['B']*(-1))):($detail['B']))}} }{2} + \sqrt{ {{(($right_side<0)?' - ':' ')}} \frac{ {{$right_side}} }{4}} {{@$i}}, { x₁ = {{$detail['x1']}} } {{@$i}} \)
                                                </p>
                                                <p class="mt-2">
                                                    \( {x₂} ={{(($detail['B']<0)?' ':' - ')}} \frac{ {{(($detail['B']<0)?(($detail['B']*(-1))):($detail['B']))}} }{2} - \sqrt{ {{(($right_side<0)?' - ':' ')}} \frac{ {{$right_side}} }{4}} {{@$i}}, { x₂ = {{$detail['x2']}} } {{@$i}} \)
                                                </p>
                                            @endif
                                            @if($right_side==0)
                                                <p class="mt-2">
                                                    \( { x }{{(($detail['B']<0)?' - ':' + ')}} { {{(($detail['B']<0)?(($detail['B']*(-1))/2):($detail['B']/2))}}} = \pm \sqrt{ { {{$right_side}} }} \)
                                                </p>
                                                <p class="mt-2">
                                                    \( { x }  = {{(($detail['B']<0)?' + ':' - ')}} { {{(($detail['B']<0)?(($detail['B']*(-1))/2):($detail['B']/2))}}}\)
                                                </p>
                                            @endif
                                        @endif
                                    @endif
                                @else
                                    <p class="mt-2">{{$lang['using_q']}}</p>
                                    @php
                                        $inner1= 4 * $request->a * $detail['C'];
                                        $inner=(pow($detail['B'], 2)) - $inner1;
                                        $inner2=round(sqrt($inner),4);
                                    @endphp
                                    <p class="mt-2">a = {{$request->a}}, b = {{$detail['B']}}, and c = {{$detail['C']}}</p>
                                    <p class="mt-2">\( x = \frac{ -b \pm \sqrt{b^2 - 4ac}}{ 2a } \)</p>
                                    <p class="mt-2">
                                        \( x = \frac{ {{(($detail['B']<0)?'- ('.$detail['B'].')':' - '.$detail['B'])}} \pm \sqrt{({{$detail['B']}})^2 - 4({{$request->a}})({{$detail['C']}})}}{ 2({{$request->a}}) } \)
                                    </p>
                                    <p class="mt-2">
                                        \( x = \frac{ {{(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])}} \pm \sqrt{ {{pow($detail['B'], 2)}} {{(($inner1<0)?' + '.$inner1 * (-1):' - '.$inner1)}}}}{ {{$request->a * 2}} } \)
                                    </p>
                                    <p class="mt-2">\( x = \frac{ {{(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])}} \pm \sqrt{{{$inner}}}}{ {{$request->a*2}} } \)</p>
                                    @if($inner>0)
                                        <p class="mt-2">{{$lang['t_d']}} b<sup class="font-s-14">2</sup>−4ac > 0 so, there are two real roots.</p>
                                        <p class="mt-2">
                                            \( x₁ = \frac{ {{(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])}} + \sqrt{{{$inner}}}}{ {{$request->a*2}} },x₁ = { {{(($detail['B'] * (-1)) + $inner2) / ($request->a*2)}}} \)
                                        </p>
                                        <p class="mt-2">
                                            \( x₂ = \frac{ {{(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])}} - \sqrt{{{$inner}}}}{ {{$request->a*2}} },x₂ = { {{(($detail['B'] * (-1)) - $inner2) / ($request->a*2)}}} \)
                                        </p>
                                    @endif
                                    @if($inner<0)
                                        <p class="mt-2">{{$lang['t_d']}} b<sup class="font-s-14">2</sup>−4ac < 0 so, there are two complex roots.</p>
                                        <p class="mt-2">
                                            \( x₁ = \frac{ {{(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])}} + \sqrt{{{($inner * (-1))}}}\, i}{ {{$request->a*2}} },x₁ = { {{round(($detail['B'] * (-1) / ($request->a*2)),4)}}} + {{round(sqrt(($inner*(-1))) /($request->a*2),4)}} \,i \)
                                        </p>
                                        <p class="mt-2">
                                            \( x₂ = \frac{ {{(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])}} - \sqrt{{{($inner * (-1))}}}\, i}{ {{$request->a*2}} },x₂ = { {{round(($detail['B'] * (-1) / ($request->a*2)),4)}}} -  {{round(sqrt(($inner*(-1))) /($request->a*2),4)}} \,i \)
                                        </p>
                                    @endif
                                    @if($inner==0)
                                        <p class="mt-2">{{$lang['t_d']}} b<sup class="font-s-14">2</sup>−4ac = 0 so, there is one real root.</p>
                                        <p class="mt-2">\( x = \frac{ <?=(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])?>}{ <?=$request->a*2?> } \)</p>
                                        <p class="mt-2">\({ <?=$detail['roots']?> } \)</p>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="overflow-auto">
                        <div id="chart_div" class="col-lg-8 mt-3 mx-auto" style="height: 350px;"></div>
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
                    data.addColumn('number');
                    data.addColumn('number');
                    var a="{{$request->a}}";
                    var b="{{$detail['B']}}";
                    var c="{{$detail['C']}}";
                    var firstx="{{($detail['B'] * (-1)) / ($request->a*2)}}";
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
                    var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
                    chart.draw(data, options);
                    chart.draw(data, options);
                }
            </script>
        @endisset
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        <script>
            document.getElementById('formula').addEventListener('change', function() {
                var formula = this.value;
                var enterB = document.querySelector('.enter_b');
                var enterC = document.querySelector('.enter_c'); 
                switch (formula) {
                    case '1':
                        enterB.textContent = '{{$lang['Enter']}} B';
                        enterC.textContent = '{{$lang['Enter']}} C';
                        break;
                    case '2':
                        enterB.textContent = '{{$lang['Enter']}} H';
                        enterC.textContent = '{{$lang['Enter']}} K';
                        break;
                    case '3':
                        enterB.textContent = '{{$lang['Enter']}} x₁';
                        enterC.textContent = '{{$lang['Enter']}} x₂';
                        break;
                }
            });
        </script>
    @endpush
</form>