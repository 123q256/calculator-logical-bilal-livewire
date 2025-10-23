<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">


            <div class="col-span-12">
                <label for="from" class="label">{{ $lang['1'] }}:</label>
                <div class="w-full py-2">
                    <select class="input" aria-label="select" name="from" id="from">
                        <option value="1">(x - A)² + (y - B)² = C</option>
                        <option value="2" {{ isset($_POST['from']) && $_POST['from'] == '2' ? 'selected' : '' }}>x = A + r cos(α), y = B + r sin(α)</option>
                        <option value="3" {{ isset($_POST['from']) && $_POST['from'] == '3' ? 'selected' : '' }}>x² + y² + Dx + Ey + F = 0</option>
                        <option value="4" {{ isset($_POST['from']) && $_POST['from'] == '4' ? 'selected' : '' }}>{{$lang[2]}}</option>
                        <option value="5" {{ isset($_POST['from']) && $_POST['from'] == '5' ? 'selected' : '' }}>{{$lang[3]}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['from']) && ($_POST['from'] === '4' || $_POST['from'] === '5') ? 'hidden':'' }} standardEquation">
                <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12 text-center my-3 text-[18px]">
                        <strong id="changeText">
                            @if (isset($_POST['from']) && $_POST['from'] === '2')
                                Parametric Equation: x = A + r cos(α), y = B + r sin(α)
                            @elseif (isset($_POST['from']) && $_POST['from'] === '3')
                                General Form: x² + y² + Dx + Ey + F = 0
                            @else
                                Standard Form: (x - A)² + (y - B)² = C
                            @endif
                        </strong>
                    </p>
                    <div class="col-span-4">
                        <label for="a" class="label enter_a">
                            @if (isset($_POST['from']) && $_POST['from'] === '3')
                                D
                            @else
                                A
                            @endif
                        </label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="a" id="a" class="input" value="{{ isset($_POST['a']) ? $_POST['a'] : '5' }}" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="b" class="label enter_b">
                            @if (isset($_POST['from']) && $_POST['from'] === '3')
                                E
                            @else
                                B
                            @endif
                        </label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="b" id="b" class="input" value="{{ isset($_POST['b']) ? $_POST['b'] : '3' }}" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <label for="c" class="label enter_c">
                            @if (isset($_POST['from']) && $_POST['from'] === '2')
                                r
                            @elseif (isset($_POST['from']) && $_POST['from'] === '3')
                                F
                            @else
                                C
                            @endif
                        </label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="c" id="c" class="input" value="{{ isset($_POST['c']) ? $_POST['c'] : '1' }}" aria-label="input" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['from']) && ($_POST['from'] === '4' || $_POST['from'] === '5') ? '':'hidden' }} circlePoints">
                <div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12 text-center my-3 text-[18px]"><strong>{{$lang['5']}} (x,y)</strong></p>
                    <div class="{{ isset($_POST['from']) && $_POST['from']==='5' ? 'col-span-6':'col-span-4' }} px-2 mt-0 mt-lg-2 xInput">
                        <label for="x1" class="label">x</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="x1" id="x1" class="input" value="{{ isset($_POST['x1']) ? $_POST['x1'] : '5' }}" aria-label="input" />
                        </div>
                    </div>
                    <div class="{{ isset($_POST['from']) && $_POST['from']==='5' ? 'col-span-6':'col-span-4' }} px-2 mt-0 mt-lg-2 yInput">
                        <label for="y1" class="label">y</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="y1" id="y1" class="input" value="{{ isset($_POST['y1']) ? $_POST['y1'] : '4' }}" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-4 {{ isset($_POST['from']) && $_POST['from'] === '5' ? 'hidden':'' }} radiusInput">
                        <label for="r" class="label">{{$lang['6']}}</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="r" id="r" class="input" value="{{ isset($_POST['r']) ? $_POST['r'] : '3' }}" aria-label="input" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 {{ isset($_POST['from']) && $_POST['from'] === '5' ? '':'hidden' }} centerPoints">
                <div class="grid grid-cols-12    gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12 text-center my-3 text-[18px]"><strong>{{$lang['7']}} (h,k)</strong></p>
                    <div class="col-span-6">
                        <label for="h1" class="label">h</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="h1" id="h1" class="input" value="{{ isset($_POST['h1']) ? $_POST['h1'] : '3' }}" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="k1" class="label">k</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="k1" id="k1" class="input" value="{{ isset($_POST['k1']) ? $_POST['k1'] : '4' }}" aria-label="input" />
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
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="45%"><strong>{{$lang[8]}}</strong></td>
                                        <td class="py-2 border-b">
                                            @php
                                                $xSign = ($detail['A'] < 0) ? '+' : '-';
                                                $ySign = ($detail['B'] < 0) ? '+' : '-';
                                                $xValue = abs($detail['A']);
                                                $yValue = abs($detail['B']);
                                            @endphp
                                            @if ($detail['A'] < 0 && $detail['B'] < 0)
                                                (x {{ $xSign }} {{ $xValue }})² + (y {{ $ySign }} {{ $yValue }})² = ({{ $detail['radius'] }})²
                                            @elseif ($detail['A'] >= 0 && $detail['B'] < 0)
                                                (x - {{ $detail['A'] }})² + (y {{ $ySign }} {{ $yValue }})² = ({{ $detail['radius'] }})²
                                            @elseif ($detail['A'] < 0 && $detail['B'] >= 0)
                                                (x {{ $xSign }} {{ $xValue }})² + (y - {{ $detail['B'] }})² = ({{ $detail['radius'] }})²
                                            @else
                                                (x - {{ $detail['A'] }})² + (y - {{ $detail['B'] }})² = ({{ $detail['radius'] }})²
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="45%"><strong>{{$lang[9]}}</strong></td>
                                        <td class="py-2 border-b">
                                            @php
                                                $xD = ($detail['D'] < 0) ? -1 * $detail['D'] : $detail['D'];
                                                $yE = ($detail['E'] < 0) ? -1 * $detail['E'] : $detail['E'];
                                                $zF = ($detail['F'] < 0) ? -1 * $detail['F'] : $detail['F'];
                
                                                $xSign = ($detail['D'] < 0) ? '-' : '+';
                                                $ySign = ($detail['E'] < 0) ? '-' : '+';
                                                $zSign = ($detail['F'] < 0) ? '-' : '+';
                                            @endphp
                                            @if ($detail['D'] < 0 && $detail['E'] < 0)
                                                @if ($detail['F'] >= 0)
                                                    x² + y² {{ $xSign }} {{ $xD }}x {{ $ySign }} {{ $yE }}y {{ $zSign }} {{ $zF }} = 0
                                                @else
                                                    x² + y² {{ $xSign }} {{ $xD }}x {{ $ySign }} {{ $yE }}y - {{ $zF }} = 0
                                                @endif
                                            @elseif ($detail['D'] >= 0 && $detail['E'] < 0)
                                                @if ($detail['F'] >= 0)
                                                    x² + y² + {{ $xD }}x {{ $ySign }} {{ $yE }}y {{ $zSign }} {{ $zF }} = 0
                                                @else
                                                    x² + y² + {{ $xD }}x {{ $ySign }} {{ $yE }}y - {{ $zF }} = 0
                                                @endif
                                            @elseif ($detail['D'] < 0 && $detail['E'] >= 0)
                                                @if ($detail['F'] >= 0)
                                                    x² + y² {{ $xSign }} {{ $xD }}x + {{ $yE }}y {{ $zSign }} {{ $zF }} = 0
                                                @else
                                                    x² + y² {{ $xSign }} {{ $xD }}x + {{ $yE }}y - {{ $zF }} = 0
                                                @endif
                                            @else
                                                @if ($detail['F'] >= 0)
                                                    x² + y² + {{ $xD }}x + {{ $yE }}y {{ $zSign }} {{ $zF }} = 0
                                                @else
                                                    x² + y² + {{ $xD }}x + {{ $yE }}y - {{ $zF }} = 0
                                                @endif
                                            @endif
                
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12">
                                <div class="w-full md:w-[80%] lg:w-[80%] mt-2">                    
                                    <table class="w-full font-s-16">
                                        <tr>
                                            <td class="py-2 border-b" width="45%">{{ $lang['6'] }}</td>
                                            <td class="py-2 border-b"><strong>{{$detail['radius']}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="45%">{{ $lang['10'] }}</td>
                                            <td class="py-2 border-b"><strong>{{$detail['diameter']}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="45%">{{ $lang['11'] }}</td>
                                            <td class="py-2 border-b"><strong>[{{$detail['d1']}} , {{$detail['d2']}}]</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="45%">{{ $lang['12'] }}</td>
                                            <td class="py-2 border-b"><strong>{{$detail['eccentricity']}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" rowspan="2" width="45%">{{ $lang['13'] }}</td>
                                            <td class="py-2"><strong>x-coordianate {{$detail['A']}}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong>y-coordianate {{$detail['B']}}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                <table class="w-full text-[16px]">
                                    <tr>
                                        <td class="py-2 border-b" width="45%"><strong>{{ $lang['14'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['area']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="45%"><strong>{{ $lang['15'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['circumference']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="45%"><strong>{{ $lang['16'] }}</strong></td>
                                        <td class="py-2 border-b">[{{$detail['r1']}} , {{$detail['r2']}}]</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="45%"><strong>{{ $lang['17'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['eccentricity']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" rowspan="2" width="45%"><strong>{{ $lang['18'] }}</strong></td>
                                        <td class="py-2">x = {{$detail['A']}} + {{$detail['radius']}} cos(α)</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">y = {{$detail['B']}} + {{$detail['radius']}} sin(α)</td>
                                    </tr>
                                </table>
                            </div>
                            <div id="box1" class="col-lg-8 mt-4 mx-auto" style="height: 350px;"></div>
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
                var board = JXG.JSXGraph.initBoard('box1', {boundingbox: [-15, 15, 15, -15], axis:true});
                var p1 = board.create('point', [{{$detail['A']}}, {{$detail['B']}}],{name:'Center'});
                var ci = board.create('circle',[p1, [0,0]], {strokeColor:'#00ff00',strokeWidth:2});
                var li3 = board.create('line',[p1,[0,0]], {straightFirst:false, straightLast:false, strokeWidth:2});
            </script>
        @endisset
        <script>
            document.getElementById('from').addEventListener('change', function() {
                if (this.value === "1") {
                    document.getElementById('changeText').textContent = 'Standard Form: (x - A)² + (y - B)² = C';
                    document.getElementsByClassName('enter_a')[0].textContent = 'A';
                    document.getElementsByClassName('enter_b')[0].textContent = 'B';
                    document.getElementsByClassName('enter_c')[0].textContent = 'C';
                    ['.standardEquation'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['.centerPoints', '.circlePoints'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(this.value === "2"){
                    document.getElementById('changeText').textContent = 'Parametric Equation: x = A + r cos(α), y = B + r sin(α)';
                    document.getElementsByClassName('enter_a')[0].textContent = 'A';
                    document.getElementsByClassName('enter_b')[0].textContent = 'B';
                    document.getElementsByClassName('enter_c')[0].textContent = 'r';
                    ['.standardEquation'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['.centerPoints', '.circlePoints'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(this.value === "3"){
                    document.getElementById('changeText').textContent = 'General Form: x = ay² + by + c';
                    document.getElementsByClassName('enter_a')[0].textContent = 'D';
                    document.getElementsByClassName('enter_b')[0].textContent = 'E';
                    document.getElementsByClassName('enter_c')[0].textContent = 'F';
                    ['.standardEquation'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['.centerPoints', '.circlePoints'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                }else if(this.value === "4"){
                    ['.standardEquation', '.centerPoints'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['.circlePoints', '.radiusInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['.xInput', '.yInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('lg:col-span-6', 'col-span-6');
                            element.classList.add('lg:col-span-4', 'col-span-4');
                        });
                    });
                }else{
                    ['.circlePoints', '.centerPoints'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['.standardEquation', '.radiusInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    ['.xInput', '.yInput'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('lg:col-span-4', 'col-span-4');
                            element.classList.add('lg:col-span-6', 'col-span-6');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>
