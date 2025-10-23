<form class="row w-full" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php $request = request(); @endphp
            <div class="col-span-6">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12 mt-2 px-2"><strong>{{$lang['2']}}(C)(x<sub class="font-s-12">0</sub>, y<sub class="font-s-12">0</sub>)</strong></p>
                    <div class="col-span-12">
                        <label for="x" class="label">{{$lang['3']}} x<sub class="font-s-12 text-blue">0</sub>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="x" id="x" class="input" value="{{ isset($request->x)?$request->x:'1' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="y" class="label">{{$lang['3']}} y<sub class="font-s-12 text-blue">0</sub>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="y" id="y" class="input" value="{{ isset($request->y)?$request->y:'4' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="a" class="label">{{$lang['3']}} a:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="a" min="1" id="a" class="input" value="{{ isset($request->a)?$request->a:'7' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="b" class="label">{{$lang['3']}} b:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="b" min="1" id="b" class="input" value="{{ isset($request->b)?$request->b:'11' }}" aria-label="input"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-6 text-center text-[18px]">
                <p class="mt-5"><strong>{{$lang['1']}}</strong></p>
                <p class="mt-2"><strong>\( \frac{(x-x_0)^2}{a} - \frac{(y-y_0)^2}{b} = 1 \)</strong></p>
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
                            $x=$_POST['x'];
                            $y=$_POST['y'];
                            $a=$_POST['a'];
                            $b=$_POST['b'];
                        @endphp
                        <div class="w-full">
                            <div class="w-full  text-[18px]">
                                <p class="mt-3"><strong>{{$lang['1']}}</strong></p>
                                <p class="mt-2">\( \frac{(x-({{$x}}))^2}{{{$a}}} - \frac{(y-({{$y}}))^2}{{{$b}}} = 1 \)</p>
                                <p class="mt-3"><strong>{{$lang['4']}}</strong></p>
                                <p class="mt-2">\( ({{$x.','.$y}}) \)</p>
                                <p class="mt-3"><strong>{{$lang['5']}}</strong></p>
                                <p class="mt-2">\( ({{$x.'-'.$detail['ashow'].','.$y}}) ≈ ({{$detail['v1']}}), ({{$x.'+'.$detail['ashow'].','.$y}}) ≈  ({{$detail['v2']}}) \)</p>
                                <p class="mt-3"><strong>{{$lang['6']}}</strong></p>
                                <p class="mt-2">\( ({{$x.','.$y.'-'.$detail['bshow']}}) ≈ ( {{$x.','.$detail['v21']}}), ({{$x.','.$y.'+'.$detail['bshow']}}) ≈ ( {{$x.','.$detail['v22']}}) \)</p>
                                <p class="mt-3"><strong>{{$lang['7']}}</strong></p>
                                <p class="mt-2">\( \frac{ {{$detail['cshow']}} }{ {{$detail['ashow']}} } ≈ {{$detail['ecc']}} \)</p>
                                <p class="mt-3"><strong>{{$lang['8']}}</strong></p>
                                <p class="mt-2">
                                    \(
                                        @php
                                            if ($detail['cshow']==$detail['c']) {
                                                echo $detail['c'];
                                            }else{
                                                echo $detail['cshow']." ≈ ".$detail['c'];
                                            }
                                        @endphp
                                    \)
                                </p>
                                <p class="mt-3"><strong>{{$lang['9']}}</strong></p>
                                <p class="mt-2">\( \frac{ {{$b}}\times{{$detail['cshow']}} }{ {{$a+$b}} } ≈ {{$detail['fp']}} \)</p>
                                <p class="mt-3"><strong>{{$lang['10']}}</strong></p>
                                <p class="mt-2">\( 2\times{{$detail['ashow']}} ≈ {{2*$detail['as']}} \)</p>
                                <p class="mt-3"><strong>{{$lang['11']}}</strong></p>
                                <p class="mt-2">
                                    \(
                                        @php
                                            if ($detail['ashow']==$detail['as']) {
                                                echo $detail['as'];
                                            }else{
                                                echo $detail['ashow']." ≈ ".$detail['as'];
                                            }
                                        @endphp
                                    \)
                                </p>
                                <p class="mt-3"><strong>{{$lang['12']}}</strong></p>
                                <p class="mt-2">\( 2\times{{$detail['bshow']}} ≈ {{2*$detail['bs']}} \)</p>
                                <p class="mt-3"><strong>{{$lang['11']}}</strong></p>
                                <p class="mt-2">
                                    \(
                                        @php
                                            if ($detail['bshow']==$detail['bs']) {
                                                echo $detail['bs'];
                                            }else{
                                                echo $detail['bshow']." ≈ ".$detail['bs'];
                                            }
                                        @endphp
                                    \)
                                </p>
                                <p class="mt-3"><strong>{{$lang['13']}}</strong></p>
                                <p class="mt-2">\( y = - \frac{ {{$detail['bshow']}}\times{{$detail['ashow']}}(x - ({{$x}}))}{ {{$a}} } + ({{$y}}) \)</p>
                                <p class="mt-3"><strong>{{$lang['14']}}</strong></p>
                                <p class="mt-2">\( y = \frac{ {{$detail['bshow']}}\times{{$detail['ashow']}}(x - ({{$x}}))}{ {{$a}} } + ({{$y}}) \)</p>
                                <p class="mt-3"><strong>{{$lang['15']}}</strong></p>
                                <p class="mt-2">\( x = {{$x}} - \frac{ {{$a}}\times{{$detail['cshow']}} }{ {{$a+$b}} } ≈ {{$detail['dir1']}} \)</p>
                                <p class="mt-3"><strong>{{$lang['16']}}</strong></p>
                                <p class="mt-2">\( x = {{$x}} + \frac{ {{$a}}\times{{$detail['cshow']}} }{ {{$a+$b}} } ≈ {{$detail['dir2']}} \)</p>
                                <p class="mt-3"><strong>{{$lang['17']}}</strong></p>
                                <p class="mt-2">\( x = {{$x}} - {{$detail['cshow']}} ≈ {{$detail['fl1']}} \)</p>
                                <p class="mt-3"><strong>{{$lang['18']}}</strong></p>
                                <p class="mt-2">\( x = {{$x}} + {{$detail['cshow']}} ≈ {{$detail['fl2']}} \)</p>
                                <p class="mt-3"><strong>{{$lang['19']}}</strong></p>
                                <p class="mt-2">\( \frac{2\times{{$b}} \times {{$detail['ashow']}} }{ {{$a}} } ≈ {{(2*$b*$detail['as'])/($a)}} \)</p>
                                <p class="mt-3"><strong>{{$lang['20']}}</strong></p>
                                <p class="mt-2">\( \left( {{$x}} - \frac{ {{$y.'\\times'.$detail['ashow']}} }{ {{$detail['bshow']}} },0\right) ≈ ({{$x-(($y*$detail['as'])/$detail['bs'])}},0) , \left( {{$x}} + \frac{ {{$y.'\\times'.$detail['ashow']}} }{ {{$detail['bshow']}} },0\right) ≈ ({{$x+(($y*$detail['as'])/$detail['bs'])}},0) \)</p>
                                <p class="mt-3"><strong>{{$lang['20']}}</strong></p>
                                <p class="mt-2">\( \left(0, {{$y}} - \frac{ {{$x.'\\times'.$detail['bshow']}} }{ {{$detail['ashow']}} }\right) ≈ (0,{{$y-(($x*$detail['bs'])/$detail['as'])}}) , \left(0, {{$y}} + \frac{ {{$x.'\\times'.$detail['bshow']}} }{ {{$detail['ashow']}} }\right) ≈ (0,{{$y+(($x*$detail['bs'])/$detail['as'])}}) \)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
    @endpush
</form>