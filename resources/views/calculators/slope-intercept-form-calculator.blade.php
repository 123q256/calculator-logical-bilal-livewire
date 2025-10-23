<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="type" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2">
                        <select class="input" aria-label="select" name="type" id="type">
                            <option value="2">{{$lang[2]}}</option>
                            <option value="1" {{ isset($_POST['type']) && $_POST['type']=='1'?'selected':'' }}>{{$lang[3]}} & {{$lang[4]}} (m)</option>
                            <option value="3" {{ isset($_POST['type']) && $_POST['type']=='3'?'selected':'' }}>{{$lang[3]}} (c) & {{$lang[4]}} (m)</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="x1" class="label f1_text">
                        @if(isset($_POST['type']) && $_POST['type']=='1')
                            {{$lang[5]}} (c)
                        @else 
                            X₁:
                        @endif
                    </label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="x1" id="x1" value="{{ isset($_POST['x1'])?$_POST['x1']:'2' }}" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="y1" class="label f2_text">
                        @if(isset($_POST['type']) && $_POST['type']=='3')
                            {{$lang[4]}} (m)
                        @else 
                            Y₁:
                        @endif
                    </label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="y1" id="y1" value="{{ isset($_POST['y1'])?$_POST['y1']:'21' }}" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6 {{ isset($_POST['type']) && $_POST['type'] === '3' ? 'hidden':'' }} x2Input">
                    <label for="x2" class="label f3_text">
                        @if(isset($_POST['type']) && $_POST['type']=='1')
                            {{$lang[4]}} (m)
                        @else
                            X₂: 
                        @endif
                    </label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="x2" id="x2" value="{{ isset($_POST['x2'])?$_POST['x2']:'11' }}" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6 {{ isset($_POST['type']) && ($_POST['type'] === '1' || $_POST['type'] === '3') ? 'hidden':'' }} x3Input">
                    <label for="y2" class="label f4_text">Y₂:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" name="y2" id="y2" value="{{ isset($_POST['y2'])?$_POST['y2']:'5' }}" class="input" aria-label="input" />
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
                            <div class="w-full">
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="55%"><strong>{{$lang[4]}}-{{$lang[6]}}</strong></td>
                                            <td class="py-2 border-b">y = {{$detail['slope']}}x {{ (($detail['b']<0)?$detail['b']:"+ ".$detail['b']) }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full font-s-16">
                                    <tr>
                                        <td class="py-2 border-b" width="55%">{{$lang[4]}} (m)</td>
                                        <td class="py-2 border-b"><strong>{{ isset($detail['slope']) ? $detail['slope'] : "0" }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="55%">Y - {{$lang[5]}} (c)</td>
                                        <td class="py-2 border-b"><strong>{{$detail['b']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="55%">X - {{$lang[5]}}</td>
                                        <td class="py-2 border-b"><strong>{{round((-1)*$detail['b']/$detail['slope'],2)}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="55%">{{$lang[7]}}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['slope']*100}}%</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="55%">{{$lang[8]}} (θ)</td>
                                        <td class="py-2 border-b"><strong>{{ isset($detail['angle']) ? $detail['angle'] : "0 deg" }}</strong></td>
                                    </tr>
                                    @if($_POST['type'] === "2")
                                        <tr>
                                            <td class="py-2 border-b" width="55%">Δx</td>
                                            <td class="py-2 border-b"><strong>{{ isset($detail['x']) ? $detail['x'] : "0" }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="55%">Δy</td>
                                            <td class="py-2 border-b"><strong>{{ isset($detail['y']) ? $detail['y'] : "0" }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="55%">{{$lang[9]}}</td>
                                            <td class="py-2 border-b"><strong>{{ isset($detail['distance']) ? $detail['distance'] : "0" }}</strong></td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                            @if($_POST['type'] === "2")
                                <div id="box1" class="col-lg-10 mt-4 mx-auto" style="height: 350px;"></div>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    @endisset
    @push('calculatorJS')
        @isset($detail)
            @if($_POST['type']=='2')
                @php
                    $x2=(($_POST['x2']<0)?$_POST['x2']-10:"-".$_POST['x2']+10);
                    $x1=(($_POST['x1']<0)?($_POST['x1']-10)*(-1):$_POST['x1']+10);
                    $_POST['y2']=(($_POST['y2']<0)?$_POST['y2']-10:"-".$_POST['y2']+10);
                    $y1=(($_POST['y1']<0)?($_POST['y1']-10)*(-1):$_POST['y1']+10);
                @endphp
                <script type="text/javascript" charset="UTF-8" src="https://cdnjs.cloudflare.com/ajax/libs/jsxgraph/0.99.7/jsxgraphcore.js"></script>
                <script>
                    var board = JXG.JSXGraph.initBoard('box1', {boundingbox: [{{$_POST['x2']}}, {{$_POST['y1']}}, {{$_POST['x1']}}, {{$_POST['y2']}}], axis:true});
                    var p1 = board.create('point', [{{$_POST['x1']}}, {{$_POST['y1']}}]);
                    var p2 = board.create('point', [{{$_POST['x2']}}, {{$_POST['y2']}}]);
                    var l1 = board.create('line', [p1, p2]);
                </script>
            @endif
        @endisset
        <script>
            document.getElementById('type').addEventListener('change', function() {
                if(this.value === "1"){
                    document.getElementsByClassName('f1_text')[0].textContent = "X₁";
                    document.getElementsByClassName('f2_text')[0].textContent = "Y₁";
                    document.getElementsByClassName('f3_text')[0].textContent = "{{$lang[4]}} (m)";
                    ['.x3Input'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['.x2Input'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }else if(this.value === "3"){
                    document.getElementsByClassName('f1_text')[0].textContent = "{{$lang[5]}} (c)";
                    document.getElementsByClassName('f2_text')[0].textContent = "{{$lang[4]}} (m)";
                    ['.x2Input', '.x3Input'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else{
                    document.getElementsByClassName('f1_text')[0].textContent = "X₁";
                    document.getElementsByClassName('f2_text')[0].textContent = "Y₁";
                    document.getElementsByClassName('f3_text')[0].textContent = "X₂";
                    document.getElementsByClassName('f4_text')[0].textContent = "Y₂";
                    ['.x2Input', '.x3Input'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>