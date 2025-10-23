<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <p class="col-span-12 mx-2 text-center mb-1"><strong>{{$lang[1]}}</strong></p>
            <div class="col-span-12 flex items-center justify-center">
                <div class="mx-2 py-2 relative">
                    <input type="number" step="any" name="x1" class="input" aria-label="input" value="{{ isset($_POST['x1']) ? $_POST['x1'] : '2' }}" />
                    <span class="input_unit">x</span>
                </div>
                <div class="mx-2">+</div>
                <div class="mx-2 py-2 relative">
                    <input type="number" step="any" name="y1" class="input" aria-label="input" value="{{ isset($_POST['y1']) ? $_POST['y1'] : '3' }}" />
                    <span class="input_unit">y</span>
                </div>
                <div class="mx-2">=</div>
                <div class="mx-2 py-2">
                    <input type="number" step="any" name="c1" class="input" aria-label="input" value="{{ isset($_POST['c1']) ? $_POST['c1'] : '4' }}" />
                </div>
            </div>
            <p class="col-span-12 mx-2 text-center mb-1 mt-2"><strong>{{$lang[2]}}</strong></p>
            <div class="col-span-12 flex items-center justify-center">
                <div class="mx-2 py-2 relative">
                    <input type="number" step="any" name="x2" class="input" aria-label="input" value="{{ isset($_POST['x2']) ? $_POST['x2'] : '3' }}" />
                    <span class="input_unit">x</span>
                </div>
                <div class="mx-2">+</div>
                <div class="mx-2 py-2 relative">
                    <input type="number" step="any" name="y2" class="input" aria-label="input" value="{{ isset($_POST['y2']) ? $_POST['y2'] : '4' }}" />
                    <span class="input_unit">y</span>
                </div>
                <div class="mx-2">=</div>
                <div class="mx-2 py-2">
                    <input type="number" step="any" name="c2" class="input" aria-label="input" value="{{ isset($_POST['c2']) ? $_POST['c2'] : '5' }}" />
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
                                <table class="w-100 text-[18px]">
                                    @if(is_numeric($detail['x']))
                                        <tr>
                                            <td class="py-2 border-b" width="80%"><strong>{{ $lang['3'] }} x =</strong></td>
                                            <td class="py-2 border-b">{{$detail['x']}}</td>
                                        </tr>
                                    @endif
                                    @if(is_numeric($detail['x']))
                                        <tr>
                                            <td class="py-2 border-b" width="80%"><strong>{{ $lang['3'] }} y =</strong></td>
                                            <td class="py-2 border-b">{{$detail['y']}}</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['6']}}</strong></p>
                                <p class="mt-2">{{$lang['5']}}</p>
                                <p class="mt-2">
                                    x = (y<sub class="font-s-14">1</sub> × c<sub class="font-s-14">2</sub>) - 
                                    (<span class="quadratic_fraction">
                                        <span class="num">(y<sub class="font-s-14">2</sub> × c<sub class="font-s-14">1</sub>)</span>
                                        <span>(x<sub class="font-s-14">1</sub> × y<sub class="font-s-14">2</sub>) - (x<sub class="font-s-14">2</sub> × y<sub class="font-s-14">1</sub>)</span>
                                    </span> )
                                </p>
                                <p class="mt-2">
                                    y = (x<sub class="font-s-14">2</sub> × c<sub class="font-s-14">1</sub>) - 
                                    (<span class="quadratic_fraction">
                                        <span class="num">(x<sub class="font-s-14">1</sub> × c<sub class="font-s-14">2</sub>)</span>
                                        <span>(x<sub class="font-s-14">1</sub> × y<sub class="font-s-14">2</sub>) - (x<sub class="font-s-14">2</sub> × y<sub class="font-s-14">1</sub>)</span>
                                    </span> )
                                </p>
                                <p class="mt-2">
                                    x = (y<sub class="font-s-14">1</sub> × c<sub class="font-s-14">2</sub>) - 
                                    (<span class="quadratic_fraction">
                                        <span class="num">({{$_POST['y2']}} × {{$_POST['c1']}})</span>
                                        <span>({{$_POST['x1']}} × {{$_POST['y2']}}) - ({{$_POST['x2']}} × {{$_POST['y1']}})</span>
                                    </span> )
                                </p>
                                <p class="mt-2">
                                    x = 
                                    <span class="quadratic_fraction">
                                        <span class="num">{{$detail['x1num']}}</span>
                                        <span>{{$detail['x1den']}}</span>
                                    </span>
                                </p>
                                <p class="mt-2">
                                    x = {{$detail['x']}}
                                </p>
                                <p class="mt-2">
                                    y = ({{$_POST['x2']}} × {{$_POST['c1']}}) - 
                                    (<span class="quadratic_fraction">
                                        <span class="num">({{$_POST['x1']}} × {{$_POST['c2']}})</span>
                                        <span>({{$_POST['x1']}} × {{$_POST['y2']}}) - ({{$_POST['x2']}} × {{$_POST['y1']}})</span>
                                    </span> )
                                </p>
                                <p class="mt-2">
                                    y = 
                                    <span class="quadratic_fraction">
                                        <span class="num">{{$detail['y1num']}}</span>
                                        <span>{{$detail['y1den']}}</span>
                                    </span>
                                </p>
                                <p class="mt-2">{{$lang['4']}}</p>
                            </div>
                            <div id="box1" class="w-full md:w-[80%] lg:w-[80%] mt-4 mx-auto" style="height: 350px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        @isset($detail)
            <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraphcore.js"></script>
            <script>
                var board = JXG.JSXGraph.initBoard('box1', {boundingbox: [-50, 50, 50, -50], axis:true});
                var p1 = board.create('point', [{{$detail['th']*-1 }},{{$detail['Line1'][$detail['th']*-1]}}],{name:'p1'});
                var p2 = board.create('point', [{{$detail['th']-1}}, {{$detail['Line1'][$detail['th']-1]}}],{name:'p2'});
                var l1 = board.create('line', [p1,p2], {straightFirst:false, straightLast:false});
                var p3 = board.create('point', [{{$detail['th']*-1 }},{{$detail['Line2'][$detail['th']*-1]}}],{name:'p3'});
                var p4 = board.create('point', [{{$detail['th']-1}},{{$detail['Line2'][$detail['th']-1]}}],{name:'p4'});
                var p5 = board.create('point', [{{$detail['x']}}, {{$detail['y']}}],{name:'Point of Intersection'});
                var l2 = board.create('line', [p3,p4], {straightFirst:false, straightLast:false});
            </script>
        @endisset
    @endpush
</form>