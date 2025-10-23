<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
            @php 
                $request = request();
                if(!isset($request->with)) {
                    $request->with = "x";
                }
            @endphp
            <div class="col-span-12">
                <label for="EnterEq" class="label">{{$lang['1']}} y′=f(x,y)` or `y′=f(t,y)=:</label>
                <div class="w-full py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" required class="input" value="{{ isset($request->EnterEq)?$request->EnterEq:'(x^2+4y)^(1/2)' }}" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9" alt="keyboard" loading="lazy" decoding="async">

                </div>
            </div>
            <div class="col-span-12 hidden keyboard">
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" onclick="clear_input();">CLS</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="+">+</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="-">-</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="/">/</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="*">*</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="^">^</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="sqrt(">√</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="(">(</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value=")">)</button>
            </div>
            <div class="col-span-12">
                <label for="steps" class="label">{{$lang['2']}}:</label>
                <div class="w-full py-2">
                    <select name="steps" class="input" id="steps" aria-label="select">
                        <option value="h">{{$lang['3']}}</option>
                        <option value="n" {{ isset($request->steps) && $request->steps=='n'?'selected':'' }}>{{$lang['4']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="size" class="label " id="n_number_label" >{{$lang['18']}} (h):</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="size" id="size" required class="input" value="{{ isset($request->size)?$request->size:'0.2' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="ini" class="label">{{$lang['5']}} (t₀)</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="ini" id="ini" required class="input" value="{{ isset($request->ini)?$request->ini:'0' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="con" class="label">{{$lang['19']}}  (Y₀):</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="con" required id="con" class="input" value="{{ isset($request->con)?$request->con:'3' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="find" class="label">{{$lang['6']}}<sub class="text-blue">1</sub></label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="find" id="find" required class="input" value="{{ isset($request->find)?$request->find:'1' }}" aria-label="input"/>
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
                        <div class="w-full  ">
                            @php
                                $EnterEq= $request->EnterEq;
                                $step= $request->steps;
                                $size= $request->size;
                                $ini= $request->ini;
                                $con= $request->con;
                                $find= $request->find;
                            @endphp
                               <div class="w-full  text-center text-[20px]">
                                <p class="my-3"><strong class="bg-[#2845F5] text-white px-3 py-2 text-[23px] rounded-lg text-blue">y<sub class="text-blue">{{$detail['find']}}</sub>= {{ round($detail['ans'],2) }}</strong></p>
                            </div>
                            <div class="w-full font-16 rounded-lg px-4 py-2">
                                <p class="mt-3">{{$lang['9']}} \( y({{$detail['find']}}) \) {{$lang['10']}} \(y' = {{$detail['enter']}}\),</p>
                                {{-- <p class="mt-3"> {{$lang['11'] }} \(y({{$detail['ini']}}) = {{$detail['con']}}, {{ (($detail['step']=='h')?'h = '.$detail['h']:'n ='.$size)}}\) {{$lang['12']}}.</p> --}}
                                <p class="mt-3"><strong>{{$lang['8']}}</strong></p>
                                @if($step=='n')
                                <p class="mt-3">{{$lang['13']}} \( h=\frac{ {{$detail['find']}}-{{$detail['ini']}}}{{{$size}}} = {{round($detail['h'],2)}}\)</p>
                                @endif
                                <p class="mt-3">{{$lang['14']}}  \( y_{n+1} = y_n + h . f({{$detail['one']}}_n,y_n)\)</p>
                                <p class="mt-3">{{$lang['16']}}</p>
                                <ul class="px-3">
                                    <li class="py-2"> \(h={{round($detail['h'],2)}}\)</li>
                                    <li class="py-2">\( {{$detail['one']}}_0 = {{$detail['ini']}}\) </li>
                                    <li class="py-2">\( y_0 = {{$detail['con']}} \) </li>
                                    <li class="py-2">\( f({{$detail['one']}},y)={{$detail['enter']}}\) </li>
                                </ul>
                                <?php 
                                    $count=count($detail['steps']);
                                    $xx=$detail['ini'];
                                    $final=$detail['ini'];
                                    $con=$detail['con'];
                                    $table='';
                                    for ($i=1; $i <$count ; $i++){ 
                                        $final=$final+round($detail['h'],2);
                                        $table.='<tr><td>'.round($i,2).'</td><td>'.round($xx,2).'</td><td>'.round($con,2).'</td><td>'.round($detail['steps'][$i-1],2).'</td><td>'.round($detail['steps1'][$i-1],2).'</td></tr>';
                                        ?>
                                        <p class="mt-3"><strong>{{ $lang['17']}} {{ $i}}</strong></p>
                                        <p class="mt-3">\({{ $detail['one'].'_'.$i}} = {{ $detail['one'].'_'.($i-1)}} + h = {{ $xx.'+'.round($detail['h'],2).'='.$final}}\)</p>
                                        <p class="mt-3">\(y({{ $detail['one'].'_'.$i}}) = y({{ $final}}) = y_{{ $i}}= y_{{ $i-1}} + h. f({{ $detail['one'].'_'.($i-1)}},y_{{ $i-1}}) = {{ $con}} + {{ round($detail['h'],2)}} \times f({{ $xx.','.$con}})\)</p>
                                        <p class="mt-3">\( = {{ $con}} + {{ round($detail['h'],2)}} \times {{round($detail['steps'][$i-1], 2)}} = {{round($detail['steps1'][$i-1], 2)}} \)</p>
                                <?php
                                    $con=  round($detail['steps1'][$i-1] ,2);
                                    $xx=$xx+round($detail['h'],2);
                                    }
                                ?>
                                <p class="mt-3"><strong>{{$lang['7']}}: \( y({{$detail['find']}}) \)= {{round($detail['ans'],2)}}</strong></p>
                                <style>
                                    .result_tab tbody tr td{
                                        padding: 0.5rem 0px !important;
                                        border: 1px solid black
                                    }
                                </style>
                                <div class="w-full mt-3" style="overflow: auto;">
                                    <table class="w-full result_tab text-center" style="border-collapse: collapse;">
                                        <tr style="background-image: linear-gradient(90deg, #99EA48, #569e0e);">
                                            <td><strong class="text-white">{{$lang['17']}}</strong></td>
                                            <td><strong class="text-white">x<sub class="text-white">0</sub></strong></td>
                                            <td><strong class="text-white">y<sub class="text-white">0</sub></strong></td>
                                            <td><strong class="text-white">slope</strong></td>
                                            <td><strong class="text-white">y<sub class="text-white">n</sub></strong></td>
                                        </tr>
                                        {!! $table !!}
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
    @push('calculatorJS')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}});
        </script>
        @isset($detail)
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var repeatElements = document.querySelectorAll('.repeat');

                    repeatElements.forEach(function(repeatElement) {
                        repeatElement.addEventListener('click', function() {
                            var chk = this.getAttribute('chk');
                            var elementsToToggle = document.querySelectorAll('[step_cal="' + chk + '"]');

                            elementsToToggle.forEach(function(element) {
                                if (element.style.display === 'none' || element.style.display === '') {
                                    element.style.display = 'block';
                                    element.style.maxHeight = '0';
                                    element.style.overflow = 'hidden';
                                    element.style.transition = 'max-height 0.7s ease-out';

                                    // Allow the browser to apply the styles before changing max-height
                                    requestAnimationFrame(function() {
                                        element.style.maxHeight = element.scrollHeight + 'px';
                                    });

                                    // Reset styles after the transition completes
                                    setTimeout(function() {
                                        element.style.maxHeight = '';
                                        element.style.overflow = '';
                                        element.style.transition = '';
                                    }, 700);
                                } else {
                                    element.style.maxHeight = element.scrollHeight + 'px';
                                    element.style.overflow = 'hidden';
                                    element.style.transition = 'max-height 0.7s ease-in';

                                    // Allow the browser to apply the styles before changing max-height
                                    requestAnimationFrame(function() {
                                        element.style.maxHeight = '0';
                                    });

                                    // Hide the element after the transition completes
                                    setTimeout(function() {
                                        element.style.display = 'none';
                                        element.style.maxHeight = '';
                                        element.style.overflow = '';
                                        element.style.transition = '';
                                    }, 700);
                                }
                            });
                        });
                    });
                });
            </script>
        @endisset
        <script>
            function clear_input() {
                var check = confirm("Are you sure you want to clear Equation?");
                if (check === true) {
                    document.getElementById('EnterEq').value = '';
                }
            }
            document.querySelectorAll('.keyBtn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var val = this.value;
                    var enterEq = document.getElementById('EnterEq');
                    enterEq.value += val;
                    var equ = enterEq.value;
                    EquPreview(equ, 0);
                });
            });
            document.querySelectorAll('.keyboardImg').forEach(function(element) {
                element.addEventListener('click', function() {
                    document.querySelectorAll('.keyboard').forEach(function(keyboard) {
                        if (keyboard.style.display === 'none' || keyboard.style.display === '') {
                            keyboard.style.display = 'block';
                            keyboard.style.transition = 'display 1.5s ease-out';
                        } else {
                            keyboard.style.display = 'none';
                            keyboard.style.transition = 'display 1.5s ease-out';
                        }
                    });
                });
            });
            document.addEventListener('DOMContentLoaded', function() {
                var stepsSelect = document.getElementById('steps');
                stepsSelect.addEventListener('change', function() {
                    var value = document.getElementById("steps").value;
                    if(value == 'h'){
                        value = 'Step Size (h):';
                        document.getElementById('size').value =  '0.2';
                        document.getElementById('size').setAttribute("min", "");
                    }else{
                        value = 'Step Size (n):';
                        document.getElementById('size').value =  '3';
                        document.getElementById('size').setAttribute("min", "1");

                    }
                    var outputSpan = document.getElementById("n_number_label");
                    outputSpan.textContent = value;
                    });
            });
            @if(isset($detail))
                var value = "{{$_POST['steps']}}";
                if(value == 'h'){
                        value = 'Step Size (h):';
                        document.getElementById('size').setAttribute("min", "");
                    }else{
                        value = 'Step Size (n):';
                        document.getElementById('size').setAttribute("min", "1");
                    }
                var outputSpan = document.getElementById("n_number_label");
                outputSpan.textContent = value;
            @endif
        </script>
    @endpush
</form>