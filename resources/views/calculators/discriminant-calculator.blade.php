<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
                <div class="space-y-2">
                    <label for="to_calculate" class="font-s-14 text-blue">{{ $lang['pol'] }}:</label>
                    <select class="input" aria-label="select" name="to_calculate" id="to_calculate">
                        <option value="2d" {{ isset($_POST['to_calculate']) && $_POST['to_calculate']=='2d'?'selected':'' }}>{{$lang['sec']}}</option>
                        <option value="3d" {{ isset($_POST['to_calculate']) && $_POST['to_calculate']=='3d'?'selected':'' }}>{{$lang['thir']}}</option>
                        <option value="4d" {{ isset($_POST['to_calculate']) && $_POST['to_calculate']=='4d'?'selected':'' }}>{{$lang['for']}}</option>
                    </select>
                </div>
            </div>
                <p class="w-full  mt-3 text-center">
                    <strong id="textChanged">
                        @if(isset($_POST['to_calculate']) && $_POST['to_calculate']==='3d')
                            Enter a,b,c,d in ax³ + bx² + cx + d = 0
                        @elseif(isset($_POST['to_calculate']) && $_POST['to_calculate']==='4d')
                            Enter a,b,c,d,e in ax⁴ + bx³ + cx² + dx + e = 0
                        @else
                            Enter a,b,c in ax² + bx + c = 0
                        @endif
                    </strong>
                </p>
                <div class="grid grid-cols-2  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 vc4 {{ isset($_POST['to_calculate']) && $_POST['to_calculate']==='4d' ? 'd-block':'d-none' }}">
                    <label for="value4" class="font-s-14 text-blue 1st">a</label>
                    <input type="number" step="any" name="value4" id="value4" class="input" value="{{ isset($_POST['value4'])?$_POST['value4']:'4' }}" aria-label="input"/>
                </div>
                <div class="space-y-2 vc3 {{ isset($_POST['to_calculate']) && ($_POST['to_calculate']==='3d' || $_POST['to_calculate']==='4d') ? 'd-block':'d-none' }}">
                    <label for="value3" class="font-s-14 text-blue 2nd">
                        @if(isset($_POST['to_calculate']) && $_POST['to_calculate'] === '3d')
                            a
                        @else
                            b
                        @endif
                    </label>
                    <input type="number" step="any" name="value3" id="value3" class="input" value="{{ isset($_POST['value3'])?$_POST['value3']:'-6' }}" aria-label="input"/>
                </div>
                <div class="space-y-2">
                    <label for="value2" class="font-s-14 text-blue 3rd">
                        @if(isset($_POST['to_calculate']) && $_POST['to_calculate'] === '3d')
                            b
                        @elseif(isset($_POST['to_calculate']) && $_POST['to_calculate'] === '4d')
                            c
                        @else
                            a
                        @endif
                    </label>
                    <input type="number" step="any" name="value2" id="value2" class="input" value="{{ isset($_POST['value2'])?$_POST['value2']:'7' }}" aria-label="input"/>
                </div>
                <div class="space-y-2">
                    <label for="value1" class="font-s-14 text-blue 4th">
                        @if(isset($_POST['to_calculate']) && $_POST['to_calculate'] === '3d')
                            c
                        @elseif(isset($_POST['to_calculate']) && $_POST['to_calculate'] === '4d')
                            d
                        @else
                            b
                        @endif
                    </label>
                    <input type="number" step="any" name="value1" id="value1" class="input" value="{{ isset($_POST['value1'])?$_POST['value1']:'-10' }}" aria-label="input"/>
                </div>
                <div class="space-y-2">
                    <label for="value" class="font-s-14 text-blue 5th">
                        @if(isset($_POST['to_calculate']) && $_POST['to_calculate'] === '3d')
                            d
                        @elseif(isset($_POST['to_calculate']) && $_POST['to_calculate'] === '4d')
                            e
                        @else
                            c
                        @endif    
                    </label>
                    <input type="number" step="any" name="value" id="value" class="input" value="{{ isset($_POST['value'])?$_POST['value']:'13' }}" aria-label="input"/>
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
                <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                    <div class=" lg:flex-row">
                        <div class="w-full lg:w-1/2 mt-2">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b" style="width: 60%;"><strong>{{$lang['dis']}}</strong></td>
                                    <td class="py-2 border-b">{{number_format($detail['sd'], 2)}}</td>
                                </tr>
                            </table>
                        </div>
                        <p class="mt-2 text-base">{{$lang['nature']}}: <span class="text-blue-600">{{$detail['nrs']}}</span></p>
                        <p class="mt-3 text-base"><strong>{{$lang['sol']}}:</strong></p>
                        @if($_POST['to_calculate'] == '2d')
                            @php $a=$_POST['value2']; $b=$_POST['value1']; $c=$_POST['value']; @endphp
                            <div class="w-full text-base">
                                <p class="mt-2">Equation: {{ $a }}x² {{ $b < 0 ? '- ' : '+ ' }}{{ abs($b) }}x {{ $c < 0 ? '- ' : '+ ' }}{{ abs($c) }} = 0</p>
                                <p class="mt-2">{{$lang['g_f']}} : b<sup class="text-sm">2</sup>-4ac=0</p>
                                <p class="mt-2">a={{$a}}, b= {{$b}}, c= {{$c}}</p>
                                <p class="mt-2">{{$lang['put']}}</p>
                                <p class="mt-2">D = ({{$b}})<sup class="text-sm">2</sup> - 4 x {{$a}} x {{$c}}</p>
                                <p class="mt-2">D = {{pow($b, 2)}} - {{4*$a*$c}}</p>
                                <p class="mt-2">D = {{$detail['sd']}}</p>
                            </div>
                        @elseif($_POST['to_calculate'] == '3d')
                            @php $a=$_POST['value3']; $b=$_POST['value2']; $c=$_POST['value1']; $d=$_POST['value']; @endphp
                            <div class="w-full text-base">
                                <p class="mt-2">Equation: {{ $a }}x³ {{ $b < 0 ? '- ' : '+ ' }}{{ abs($b) }}x² {{ $c < 0 ? '- ' : '+ ' }}{{ abs($c) }}x {{ $d < 0 ? '- ' : '+ ' }}{{ abs($d) }} = 0</p>
                                <p class="mt-2">{{$lang['g_f']}} : b²c² - 4ac³ - 4b³d - 27a²d² + 18abcd</p>
                                <p class="mt-2">a={{$a}}, b= {{$b}}, c= {{$c}}, d={{$d}}</p>
                                <p class="mt-2">{{$lang['put']}}</p>
                                <p class="mt-2">D = ({{$b}})<sup class="text-sm">2</sup> x ({{$c}})<sup class="text-sm">2</sup> - (4) x {{$a}} x ({{$c}})<sup class="text-sm">3</sup> - (4) x ({{$b}})<sup class="text-sm">3</sup> x {{$d}} - 27 x ({{$a}})<sup class="text-sm">2</sup> x ({{$d}})<sup class="text-sm">2</sup> + (18) x {{$a}} x {{$b}} x {{$c}} x {{$d}}</p>
                                <p class="mt-2">D = {{pow($b, 2)}} x {{pow($c, 2)}} - 4 x {{$a}} x {{pow($c, 3)}} - 4x{{pow($b, 3)}} x {{$d}} - 27 x {{pow($a, 2)}} x {{pow($d, 2)}} + 18 x {{$a}} x {{$b}} x {{$c}} x {{$d}}</p>
                                <p class="mt-2">D = ({{pow($b, 2)*pow($c, 2)}}) - ({{4*$a*pow($c, 3)}}) - ({{4*pow($b, 3)*$d}}) - ({{27*pow($a, 2)*pow($d, 2)}}) + ({{18*$a*$b*$c*$d}})</p>
                                <p class="mt-2">D = {{$detail['sd']}}</p>
                            </div>
                        @else
                            @php $a=$_POST['value4']; $b=$_POST['value3']; $c=$_POST['value2']; $d=$_POST['value1']; $e=$_POST['value']; @endphp
                            <div class="w-full text-base">
                                <p class="mt-2">Equation: {{ $a }}x⁴ {{ $b < 0 ? '- ' : '+ ' }}{{ abs($b) }}x³ {{ $c < 0 ? '- ' : '+ ' }}{{ abs($c) }}x² {{ $d < 0 ? '- ' : '+ ' }}{{ abs($d) }}x {{ $e < 0 ? '- ' : '+ ' }}{{ abs($e) }} = 0</p>
                                <p class="mt-2">{{$lang['g_f']}} : 256a³e³ - 192a²bde²-128a²c²e² + 144a²cd²e -27a²d⁴ + 144ab²ce² - 6ab²d²e - 80abc²de +18abcd³ + 16ac⁴e - 4ac³d² - 27b⁴e² +18b³cde - 4b³d³ - 4b²c³e + b²c²d²</p>
                                <p class="mt-2">a={{$a}}, b= {{$b}}, c= {{$c}}, d={{$d}}, e={{$e}}</p>
                                <p class="mt-2">{{$lang['put']}}</p>
                                <p class="mt-2">D = 256 x ({{$a}})<sup>3</sup> x ({{$e}})<sup>3</sup> - (192) x ({{$a}})<sup>2</sup> x {{$b}} x {{$d}} x ({{$e}})<sup>2</sup> - (128) x ({{$a}})<sup>2</sup> x ({{$c}})<sup>2</sup> x ({{$e}})<sup>2</sup> + (144) x ({{$a}})<sup>2</sup> x {{$c}} x ({{$d}})<sup>2</sup> x {{$e}} - (27) x ({{$a}})<sup>2</sup> x ({{$d}})<sup>4</sup> + (144) x {{$a}} x ({{$b}})<sup>2</sup> x {{$c}} x ({{$e}})<sup>2</sup> - (6) x {{$a}} x ({{$b}})<sup>2</sup> x ({{$d}})<sup>2</sup> x {{$e}} - (80) x {{$a}} x {{$b}} x ({{$c}})<sup>2</sup> x {{$d}} x {{$e}} + (18) x {{$a}} x {{$b}} x {{$c}} x ({{$d}})<sup>3</sup> + (16) x {{$a}} x ({{$c}})<sup>4</sup> x {{$e}} - (4) x {{$a}} x ({{$c}})<sup>3</sup> x ({{$d}})<sup>2</sup> - (27) x ({{$b}})<sup>4</sup> x ({{$e}})<sup>2</sup> + (18) x ({{$b}})<sup>3</sup> x {{$c}} x {{$d}} x {{$e}} - (4) x ({{$b}})<sup>3</sup> x ({{$d}})<sup>3</sup> - (4) x ({{$b}})<sup>2</sup> x ({{$c}})<sup>3</sup> x {{$e}} + ({{$b}})<sup>2</sup> x ({{$c}})<sup>2</sup> x ({{$d}})<sup>2</sup></p>
                                <p class="mt-2">D = {{$detail['sd']}}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    @endisset
    @push('calculatorJS')
        <script>
            document.getElementById('to_calculate').addEventListener("change", function() {
                var val = this.value;
                if (val === '2d') {
                    document.getElementById('textChanged').textContent = 'Enter a,b,c in ax² + bx + c = 0';
                    document.getElementsByClassName('3rd')[0].textContent = "a";
                    document.getElementsByClassName('4th')[0].textContent = "b";
                    document.getElementsByClassName('5th')[0].textContent = "c";
                    ['.vc3','.vc4'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                }else if(val === '3d') {
                    document.getElementById('textChanged').textContent = 'Enter a,b,c,d in ax³ + bx² + cx + d = 0';
                    document.getElementsByClassName('2nd')[0].textContent = "a";
                    document.getElementsByClassName('3rd')[0].textContent = "b";
                    document.getElementsByClassName('4th')[0].textContent = "c";
                    document.getElementsByClassName('5th')[0].textContent = "d";
                    ['.vc4'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('d-none');
                        });
                    });
                    ['.vc3'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                } else if (val === '4d') {
                    document.getElementById('textChanged').textContent = 'Enter a,b,c,d,e in ax⁴ + bx³ + cx² + dx + e = 0';
                    document.getElementsByClassName('2nd')[0].textContent = "b";
                    document.getElementsByClassName('3rd')[0].textContent = "c";
                    document.getElementsByClassName('4th')[0].textContent = "d";
                    document.getElementsByClassName('5th')[0].textContent = "e";
                    ['.vc3','.vc4'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('d-none');
                        });
                    });
                }
            });
        </script>
    @endpush
</form>