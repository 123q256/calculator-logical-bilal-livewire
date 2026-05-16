 <div>
 <script src="https://code.highcharts.com/highcharts.js"></script>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">

            <div class="grid grid-cols-1  gap-4">
                <div class="space-y-2">
                    <label for="formula" class="font-s-14 text-blue">{{ $lang['e_f'] }}:</label>
                    <select wire:model.live="formula" class="input" aria-label="select" name="formula" id="formula">
                        <option value="1">Ax² + Bx + C = 0</option>
                        <option value="2">A(x - H)² + K = 0</option>
                        <option value="3">A(x - x₁)(x - x₂) = 0</option>
                    </select>
                </div>
                <div class="space-y-2">
                    <label for="method" class="font-s-14 text-blue">{{ $lang['c_m'] }}:</label>
                    <select wire:model.live="method" class="input" aria-label="select" name="method" id="method">
                        <option value="2">{{$lang['q_f']}}</option>
                        <option value="1">{{$lang['c_s']}}</option>
                    </select>
                </div>
            </div>
            <div class="grid grid-cols-3  lg:grid-cols-3 md:grid-cols-3  mt-4 gap-4">
                <div class="space-y-2">
                    <label for="a" class="font-s-14 text-blue">{{$lang['Enter']}} A</label>
                    <input type="number" step="any" wire:model.live="a" name="a" id="a" class="input" aria-label="input"/>
                </div>
                <div class="space-y-2">
                    <label for="b" class="font-s-14 text-blue enter_b">
                        @if($formula == '2')
                            {{$lang['Enter']}} H
                        @elseif($formula == '3')
                            {{$lang['Enter']}} x₁
                        @else  
                            {{$lang['Enter']}} B
                        @endif
                    </label>
                    <input type="number" step="any" wire:model.live="b" name="b" id="b" class="input" aria-label="input"/>
                </div>
                <div class="space-y-2">
                    <label for="c" class="font-s-14 text-blue enter_c">
                        @if($formula == '2')
                            {{$lang['Enter']}} K
                        @elseif($formula == '3')
                            {{$lang['Enter']}} x₂
                        @else  
                            {{$lang['Enter']}} C
                        @endif
                    </label>
                    <input type="number" step="any" wire:model.live="c" name="c" id="c" class="input" aria-label="input"/>
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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                    @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full bg-light-blue  p-3 radius-10 mt-3">
                        <div class="row">
                            <div class="col-12 font-s-16">
                                <p class="mt-2 font-s-18"><strong>{{$detail['roots']}}</strong></p>
                                @if($method == '2')
                                    <p class="mt-2 font-s-18"><strong>{{$lang['t_d']}} = {{$detail['dis']}}</strong></p>
                                @endif
                                <p class="mt-2"><strong>Solution:</strong></p>
                                <p class="mt-2">Standard Form: \( {{$a}}x^2 {{(($detail['B']<0)?$detail['B']:' + '.$detail['B'])}}x {{(($detail['C']<0)?$detail['C']:' + '.$detail['C'])}} = 0 \)
                                </p>
                                <p class="mt-2">Vertex Form: \( {{$detail['vertex']}} = 0 \)</p>
                                <p class="mt-2">Factored Form: \(  {{$detail['fact']}} = 0 \)</p>
                                @if($method == '1')
                                    <p class="mt-2">{{$lang['ans_s_c']}}</p>
                                    <p class="mt-2">a = {{$a}}, b = {{$detail['B']}}, & c = {{$detail['C']}}</p>
                                    @if($a != 1)
                                        <p class="mt-2">\( a \ne 1 \) {{$lang['divide']}} {{$a}}</p>
                                        <p class="mt-2">
                                            \( { x^2}{{(($detail['B']<0)?' - ':' + ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}} x}{ {{$a}} } = {{(($detail['C']<0)?' ':' - ')}} \frac{ {{(($detail['C']<0)?($detail['C']*(-1)):$detail['C'])}}}{ {{$a}} } \)
                                        </p>
                                        <p class="mt-2">{{$lang['half']}} \( x \) {{$lang['add_s']}}</p>
                                        <p class="mt-2">
                                            \( { x^2}{{(($detail['B']<0)?' - ':' + ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}} x}{ {{$a}} } + \frac{ {{pow($detail['B'],2)}} }{ {{pow(($a*2),2)}} } = {{(($detail['C']<0)?' ':' - ')}} \frac{ {{(($detail['C']<0)?($detail['C']*(-1)):$detail['C'])}}}{ {{$a}} } + \frac{ {{pow($detail['B'],2)}} }{ {{pow(($a*2),2)}} } \)
                                        </p>
                                        <p class="mt-2">
                                            \( ({ x }{{(($detail['B']<0)?' - ':' + ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}}}{ {{$a*2}} })^2  = {{(($detail['C']<0)?' ':' - ')}} \frac{ {{(($detail['C']<0)?($detail['C']*(-1)):$detail['C'])}}}{ {{$a}} } + \frac{ {{pow($detail['B'],2)}} }{ {{pow(($a*2),2)}} } \)
                                        </p>
                                        @php
                                            $right_side = pow(($a*2),2) / $a;
                                            $right_side = (($detail['C'] * (-1)) * $right_side) + (pow($detail['B'],2));
                                        @endphp
                                        <p class="mt-2">
                                            \( ({ x }{{(($detail['B']<0)?' - ':' + ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}}}{ {{$a*2}} })^2  = {{(($detail['C']<0)?' ':' - ')}} \frac{ {{$right_side}} }{ {{pow(($a*2),2)}} } \)
                                        </p>
                                        @php
                                            if ($right_side<0) {
                                                $right_side=$right_side * (-1);
                                                $i='\, i';
                                            }
                                        @endphp
                                        @if($right_side != 0)
                                            <p class="mt-2">
                                                \( { x }{{(($detail['B']<0)?' - ':' + ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}}}{ {{$a*2}} }  = \pm \sqrt{ {{(($right_side<0)?' - ':' ')}} \frac{ {{$right_side}} }{ {{pow(($a*2),2)}} }} {{@$i}} \)
                                            </p>
                                            <p class="mt-2">
                                                \( { x }  = {{(($detail['B']<0)?' + ':' - ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}}}{ {{$a*2}} } \pm \sqrt{ {{(($right_side<0)?' - ':' ')}} \frac{ {{$right_side}} }{ {{pow(($a*2),2)}} }} {{@$i}} \)
                                            </p>
                                            <p class="mt-2">
                                                \( { x₁ }  = {{(($detail['B']<0)?' + ':' - ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}}}{ {{$a*2}} } + \sqrt{ {{(($right_side<0)?' - ':' ')}} \frac{ {{$right_side}} }{ {{pow(($a*2),2)}} }} {{@$i}} , { x₁ = {{$detail['x1']}} } {{@$i}} \)
                                            </p>
                                            <p class="mt-2">
                                                \( { x₂ }  = {{(($detail['B']<0)?' + ':' - ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}}}{ {{$a*2}} } - \sqrt{ {{(($right_side<0)?' - ':' ')}} \frac{ {{$right_side}} }{ {{pow(($a*2),2)}} }} {{@$i}} , { x₂ = {{$detail['x2']}} } {{@$i}} \)
                                            </p>
                                        @endif
                                        @if($right_side == 0)
                                            <p class="mt-2">
                                                \( { x }{{(($detail['B']<0)?' - ':' + ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}}}{ {{$a*2}} }  = \pm \sqrt{ {{(($right_side<0)?' - ':' ')}} { {{$right_side}} }} \)
                                            </p>
                                            <p class="mt-2">
                                                \( { x }  = {{(($detail['B']<0)?' + ':' - ')}} \frac{ {{(($detail['B']<0)?($detail['B']*(-1)):$detail['B'])}}}{ {{$a*2}} } , { x = {{$detail['x1']}} }\)
                                            </p>
                                        @endif
                                    @elseif($a == 1)
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
                                                $right_side = ($detail['C'] * (-1)) + pow(($detail['B']/2),2);
                                                if ($right_side < 0) {
                                                    $right_side = $right_side * (-1);
                                                    $i = '\, i';
                                                } 
                                            @endphp
                                            @if($right_side != 0)
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
                                            @if($right_side == 0)
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
                                                $right_side = ($detail['C'] * (-1) * 4) + pow(($detail['B']),2);
                                                if ($right_side < 0) {
                                                    $right_side = $right_side * (-1);
                                                    $i = '\, i';
                                                }
                                            @endphp
                                            @if($right_side != 0)
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
                                            @if($right_side == 0)
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
                                        $inner1 = 4 * $a * $detail['C'];
                                        $inner = (pow($detail['B'], 2)) - $inner1;
                                        $inner2 = round(sqrt($inner),4);
                                    @endphp
                                    <p class="mt-2">a = {{$a}}, b = {{$detail['B']}}, and c = {{$detail['C']}}</p>
                                    <p class="mt-2">\( x = \frac{ -b \pm \sqrt{b^2 - 4ac}}{ 2a } \)</p>
                                    <p class="mt-2">
                                        \( x = \frac{ {{(($detail['B']<0)?'- ('.$detail['B'].')':' - '.$detail['B'])}} \pm \sqrt{({{$detail['B']}})^2 - 4({{$a}})({{$detail['C']}})}}{ 2({{$a}}) } \)
                                    </p>
                                    <p class="mt-2">
                                        \( x = \frac{ {{(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])}} \pm \sqrt{ {{pow($detail['B'], 2)}} {{(($inner1<0)?' + '.$inner1 * (-1):' - '.$inner1)}}}}{ {{$a * 2}} } \)
                                    </p>
                                    <p class="mt-2">\( x = \frac{ {{(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])}} \pm \sqrt{{{$inner}}}}{ {{$a*2}} } \)</p>
                                    @if($inner > 0)
                                        <p class="mt-2">{{$lang['t_d']}} b<sup class="font-s-14">2</sup>−4ac > 0 so, there are two real roots.</p>
                                        <p class="mt-2">
                                            \( x₁ = \frac{ {{(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])}} + \sqrt{{{$inner}}}}{ {{$a*2}} },x₁ = { {{(($detail['B'] * (-1)) + $inner2) / ($a*2)}}} \)
                                        </p>
                                        <p class="mt-2">
                                            \( x₂ = \frac{ {{(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])}} - \sqrt{{{$inner}}}}{ {{$a*2}} },x₂ = { {{(($detail['B'] * (-1)) - $inner2) / ($a*2)}}} \)
                                        </p>
                                    @endif
                                    @if($inner < 0)
                                        <p class="mt-2">{{$lang['t_d']}} b<sup class="font-s-14">2</sup>−4ac < 0 so, there are two complex roots.</p>
                                        <p class="mt-2">
                                            \( x₁ = \frac{ {{(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])}} + \sqrt{{{($inner * (-1))}}}\, i}{ {{$a*2}} },x₁ = { {{round(($detail['B'] * (-1) / ($a*2)),4)}}} + {{round(sqrt(($inner*(-1))) /($a*2),4)}} \,i \)
                                        </p>
                                        <p class="mt-2">
                                            \( x₂ = \frac{ {{(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])}} - \sqrt{{{($inner * (-1))}}}\, i}{ {{$a*2}} },x₂ = { {{round(($detail['B'] * (-1) / ($a*2)),4)}}} -  {{round(sqrt(($inner*(-1))) /($a*2),4)}} \,i \)
                                        </p>
                                    @endif
                                    @if($inner == 0)
                                        <p class="mt-2">{{$lang['t_d']}} b<sup class="font-s-14">2</sup>−4ac = 0 so, there is one real root.</p>
                                        <p class="mt-2">\( x = \frac{ {{(($detail['B']<0)?$detail['B'] * (-1):' - '.$detail['B'])}}}{ {{$a*2}} } \)</p>
                                        <p class="mt-2">\({ {{$detail['roots']}} } \)</p>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="overflow-auto">
                            <div class="w-full mt-8" 
                                 wire:key="quadratic-chart-{{ time() }}"
                                 x-data="{ 
                                    chartData: {!! $detail['chartData'] !!},
                                    init() {
                                        this.render();
                                        if (window.MJrerender) window.MJrerender();
                                    },
                                    render() {
                                        if (typeof Highcharts === 'undefined') {
                                            setTimeout(() => this.render(), 200);
                                            return;
                                        }
                                        Highcharts.chart($refs.canvas, {
                                            chart: { type: 'spline', backgroundColor: 'transparent' },
                                            title: { text: 'Parabola Graph', style: { color: '#2845F5', fontWeight: 'bold' } },
                                            xAxis: { title: { text: 'x' }, gridLineWidth: 1 },
                                            yAxis: { title: { text: 'y' }, gridLineWidth: 1 },
                                            series: [{
                                                name: 'y = ax² + bx + c',
                                                data: this.chartData,
                                                color: '#2845F5'
                                            }],
                                            credits: { enabled: false }
                                        });
                                    }
                                 }"
                                 @chart-update.window="chartData = (typeof $event.detail === 'string') ? JSON.parse($event.detail) : $event.detail; render();">
                                <div x-ref="canvas" style="height: 350px;"></div>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" 
        onload="window.MJrerender && window.MJrerender()"></script>
        <script>
            window.MJrerender = function() {
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            }
        </script>
    @endpush
</form>
</div>
