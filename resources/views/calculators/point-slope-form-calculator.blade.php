<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 mt-0 mt-lg-2">
                <label for="point_unit" class="label">{{ $lang['1'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="point_unit" id="point_unit">
                        <option value="1" {{ isset($_POST['point_unit']) && $_POST['point_unit']=='1'?'selected':'' }}>{{$lang['2']}}</option>
                        <option value="2" {{ isset($_POST['point_unit']) && $_POST['point_unit']=='2'?'selected':'' }}>{{$lang['3']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['point_unit']) && $_POST['point_unit']==='2' ? 'hidden':'' }}" id="firstInput">

                <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="x1" class="label">X<sub class="text-[14px]">1</sub>:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="x1" id="x1" class="input" value="{{ isset($_POST['x1'])?$_POST['x1']:'2' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="y1" class="label">Y<sub class="text-[14px]">1</sub>:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="y1" id="y1" class="input" value="{{ isset($_POST['y1'])?$_POST['y1']:'4' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="m" class="label">{{$lang['m']}}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="m" id="m" class="input" value="{{ isset($_POST['m'])?$_POST['m']:'1.5' }}" aria-label="input"/>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['point_unit']) && $_POST['point_unit']==='2' ? 'block':'hidden' }}" id="secondInput">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="sec_x1" class="label">X<sub class="text-[14px]">1</sub>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="sec_x1" id="sec_x1" class="input" value="{{ isset($_POST['sec_x1'])?$_POST['sec_x1']:'2' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="sec_y1" class="label">Y<sub class="text-[14px]">1</sub>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="sec_y1" id="sec_y1" class="input" value="{{ isset($_POST['sec_y1'])?$_POST['sec_y1']:'4' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="sec_x2" class="label">X<sub class="text-[14px]">2</sub>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="sec_x2" id="sec_x2" class="input" value="{{ isset($_POST['sec_x2'])?$_POST['sec_x2']:'6' }}" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="sec_y2" class="label">X<sub class="text-[14px]">2</sub>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="sec_y2" id="sec_y2" class="input" value="{{ isset($_POST['sec_y2'])?$_POST['sec_y2']:'8' }}" aria-label="input"/>
                        </div>
                    </div>
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
                        @if($_POST['point_unit']=='1')
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['ans']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['s']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['4']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['s3']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[18px] mt-3">
                                <p><strong>{{$lang['5']}}</strong></p>
                                <p class="mt-3">{{$lang['7']}}</p>
                                <p class="mt-3">y - y<sub class="text-[14px]">1</sub> = m(x - x<sub class="text-[14px]">1</sub>)</p>
                                <p class="mt-3">{{$lang['8']}}:</p>
                                <p class="mt-3">{{$detail['s']}}</p>
                                <p class="mt-3">{{$detail['s1']}}</p>
                                <p class="mt-3">{{$detail['s2']}}</p>
                                <p class="mt-3">{{$detail['s3']}}</p>
                                <p class="mt-3">{{$detail['s4']}}</p>
                                <p class="mt-3">{{$lang['graph']}}:</p>
                            </div>
                            <div id="box1" class="w-full md:w-[60%] lg:w-[60%]  mt-4 text-center" style="height: 350px;"></div>
                        @else
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['ans']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['s']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px] mt-3">
                                <p><strong>{{$lang['5']}}:</strong></p>
                                <p class="mt-3">{{$lang['9']}}:</p>
                                <p class="mt-3">{{$lang['m']}} = (y<sub class="text-[14px]">2</sub> - y<sub class="text-[14px]">1</sub>)/(x<sub class="text-[14px]">2</sub> - x<sub class="text-[14px]">1</sub>)</p>
                                <p class="mt-3">{{$lang['8']}}:</p>
                                <p class="mt-3">{{$lang['m']}} = {{$_POST['sec_y2']}} - {{$_POST['sec_y1']}} / ({{$_POST['sec_x2']}} - {{$_POST['sec_x1']}})</p>
                                <p class="mt-3">{{$lang['m']}} = {{$detail['slope']}}</p>
                                <p class="mt-3">{{$lang['12']}}:</p>
                                <p class="mt-3">y - y<sub class="text-[14px]">1</sub> = m(x - x<sub class="text-[14px]">1</sub>)</p>
                                <p class="mt-3">{{$lang['11']}}:</p>
                                <p class="mt-3">{{$detail['s']}}</p>
                                <p class="mt-3">{{$detail['s1']}}</p>
                                <p class="mt-3">{{$detail['s2']}}</p>
                                <p class="mt-3">{{$detail['s3']}}</p>
                                <p class="mt-3">{{$detail['s4']}}</p>
                                <p class="mt-3">{{$lang['graph']}}:</p>
                            </div>
                            <div id="box1" class="w-full md:w-[60%] lg:w-[60%]  mt-4 text-center" style="height: 350px;"></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset
    @push('calculatorJS')
        @isset($detail)
            <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraphcore.js"></script>
            @if($_POST['point_unit'] === '1')
                <script>
                    var board = JXG.JSXGraph.initBoard('box1', {
                        boundingbox: [-15, 15, 15, -15],
                        axis: true
                    });
                    var p1 = board.create('point', [{{$_POST['x1']}}, {{$_POST['y1']}}]);
                    var p2 = board.create('point', [{{$_POST['m']}}, 0]);
                    var l1 = board.create('line', [p1, p2]);
                </script>
            @else
                <script>
                    var board = JXG.JSXGraph.initBoard('box1', {
                        boundingbox: [-15, 15, 15, -15],
                        axis: true
                    });
                    var p1 = board.create('point', [{{$_POST['x1']}}, {{$_POST['y1']}}]);
                    var p2 = board.create('point', [{{$_POST['m']}}, 0]);
                    var l1 = board.create('line', [p1, p2]);
                </script>
            @endif
        @endisset
        <script>
            document.getElementById('point_unit').addEventListener("change", function() {
                var selectedValue = this.value;
                switch(selectedValue) {
                    case '1':
                        document.getElementById('firstInput').style.display = 'block';
                        document.getElementById('secondInput').style.display = 'none';
                        break;
                    case '2':
                        document.getElementById('firstInput').style.display = 'none';
                        document.getElementById('secondInput').style.display = 'block';
                        break;
                }
            });
        </script>
    @endpush
</form>