<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">


            @php
                if (!isset($detail)) {
                    $_POST['dem'] = "2";
                }
            @endphp
            <div class="col-span-6">
                <label for="x1" class="label">{{ $lang['x1'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x1" id="x1" value="{{ isset($_POST['x1'])?$_POST['x1']:'9' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6 d2">
                <label for="y1" class="label">{{ $lang['y1'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y1" id="y1" value="{{ isset($_POST['y1'])?$_POST['y1']:'13' }}" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="x2" class="label">{{ $lang['x2'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x2" id="x2" value="{{ isset($_POST['x2'])?$_POST['x2']:'15' }}" class="input" aria-label="input" />
                </div>
            </div>
            
            <div class="col-span-6 d2">
                <label for="y2" class="label">{{ $lang['y2'] }}:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y2" id="y2" value="{{ isset($_POST['y2'])?$_POST['y2']:'-9' }}" class="input" aria-label="input" />
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
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['mid'] }}</strong></td>
                                        <td class="py-2 border-b">(x , y) =
                                            @php
                                                if (isset($detail['x']) && isset($detail['y'])) {
                                                    echo "(".$detail['x']." , ".$detail['y'].")";
                                                } else {
                                                    echo "(0 , 0)";
                                                }
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['dis'] }}</strong></td>
                                        <td class="py-2 border-b">
                                            @php
                                                if (isset($detail['dis'])) {
                                                    echo "(".$detail['dis'].")";
                                                } else {
                                                    echo "(0.0)";
                                                }
                                            @endphp
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full">
                                <p class="mt-2"><strong>{{$lang['exp']}}</strong></p>
                                <p class="mt-2">{{$lang['to_find']}} X(x₁,x₂) and Y(y₁,y₂) {{$lang['use']}}:</p>
                                <p class="mt-2">
                                    M = 
                                    (<span class="quadratic_fraction">
                                        <span class="num">x₁ + x₂</span>
                                        <span>2</span>
                                    </span> , 
                                    <span class="quadratic_fraction">
                                        <span class="num">y₁ + y₂</span>
                                        <span>2</span>
                                    </span>)
                                </p>
                                <p class="mt-2">
                                    M = 
                                    (<span class="quadratic_fraction">
                                        <span class="num">{{$_POST['x1']}} + {{$_POST['x2']}}</span>
                                        <span>2</span>
                                    </span> , 
                                    <span class="quadratic_fraction">
                                        <span class="num">{{$_POST['y1']}} + {{$_POST['y2']}}</span>
                                        <span>2</span>
                                    </span>
                                    )
                                </p>
                                <p class="mt-2">
                                    M = 
                                    (<span class="quadratic_fraction">
                                        <span class="num">{{ $_POST['x1'] + $_POST['x2'] }}</span>
                                        <span>2</span>
                                    </span> , 
                                    <span class="quadratic_fraction">
                                        <span class="num">{{ $_POST['y1'] + $_POST['y2'] }}</span>
                                        <span>2</span>
                                    </span>
                                    )
                                </p>
                                <p class="mt-2">
                                    M = ({{ $detail['x'] }} , {{ $detail['y'] }})
                                </p>
                               
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
                @php
                    $x2=(($detail['x2']<0)?$detail['x2']-10:"-".$detail['x2']+10);
                    $x1=(($detail['x1']<0)?($detail['x1']-10)*(-1):$detail['x1']+10);
                    $y2=(($detail['y2']<0)?$detail['y2']-10:"-".$detail['y2']+10);
                    $y1=(($detail['y1']<0)?($detail['y1']-10)*(-1):$detail['y1']+10);
                @endphp
                <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraphcore.js"></script>
                <script>
                    var board = JXG.JSXGraph.initBoard('box1', {boundingbox: [{{$x2}}, {{$y1}}, {{$x1}}, {{$y2}}], axis:true});
                    var p1 = board.create('point', [{{$detail['x1']}}, {{$detail['y1']}}], {name:'X',size:4});
                    var p2 = board.create('point', [{{$detail['x2']}}, {{$detail['y2']}}], {name:'Y',size:4});
                    var p3 = board.create('point', [{{$detail['x']}}, {{$detail['y']}}], {name:'Midpoint',size:4});
                    var l1 = board.create('line', [p1, p2]);
                </script>
        @endisset
    @endpush
</form>