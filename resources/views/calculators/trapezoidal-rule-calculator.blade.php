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
             <div class="col-span-9">
                <label for="EnterEq" class="label">{{$lang['1']}}:</label>
                <div class="w-full py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" value="{{ isset($request->EnterEq)?$request->EnterEq:'(x^2+4)^(1/2)' }}" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9" alt="keyboard" loading="lazy" decoding="async">

                </div>
            </div>
            <div class="col-span-3">
                <label for="with" class="label">W.R.T:</label>
                <div class="w-full py-2">
                    <select name="with" class="input" id="with" aria-label="select">
                        <option value="a">a</option>
                        <option value="b" {{ isset($request->with) && $request->with=='b'?'selected':'' }}>b</option>
                        <option value="c" {{ isset($request->with) && $request->with=='c'?'selected':'' }}>c</option>
                        <option value="n" {{ isset($request->with) && $request->with=='n'?'selected':'' }}>n</option>
                        <option value="x" {{ isset($request->with) && $request->with=='x'?'selected':'' }}>x</option>
                        <option value="y" {{ isset($request->with) && $request->with=='y'?'selected':'' }}>y</option>
                        <option value="z" {{ isset($request->with) && $request->with=='z'?'selected':'' }}>z</option>
                    </select>
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
            <div class="col-span-6">
                <label for="lb" class="label">{{$lang['2']}}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="lb" id="lb" class="input" value="{{ isset($request->lb)?$request->lb:'1' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="ub" class="label">{{$lang['3']}}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="ub" id="ub" class="input" value="{{ isset($request->ub)?$request->ub:'4' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="n" class="label">{{$lang['4']}}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="n" id="n" class="input" value="{{ isset($request->n)?$request->n:'5' }}" aria-label="input"/>
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
                        <div class="w-full text-[16px]">
                            <p class="mt-3 text-[18px]">
                                \( \int\limits_{ {{$detail['lb']}} }^{ {{$detail['ub']}} } {{$detail['enter']}}\, d{{$detail['with']}} \) = {{$detail['res']}}
                            </p>
                            <p class="mt-3"><strong>{{$lang['6']}}</strong></p>
                            <p class="mt-3">{{$lang['7']}} \( \int\limits_{ {{$detail['lb']}} }^{ {{$detail['ub']}} } {{$detail['enter']}}\, d{{$detail['with']}} \) {{$lang['8']}} \(n={{$detail['n']}}\) {{$lang['8']}}.</p>
                            <p class="mt-3">\( \int\limits_{a}^{b} f({{$detail['with']}})\, d{{$detail['with']}} ≈ \frac{\Delta {{$detail['with']}} }{2}(f({{$detail['with']}}_0) + 2f({{$detail['with']}}_1) + 2f({{$detail['with']}}_2) + 2f({{$detail['with']}}_3) + ... + 2f({{$detail['with']}}_{n-2}) + 2f({{$detail['with']}}_{n-1}) + f(x_n)) \)</p>
                            <p class="mt-3">{{$lang['9']}} \(\Delta {{$detail['with']}} = \frac{b-a}{n}\)</p>
                            <p class="mt-3">{{$lang['10']}} \(a = {{$detail['lb']}},b = {{$detail['ub']}},n = {{$detail['n']}}\)</p>
                            <p class="mt-3">{{$lang['11']}}, \(\Delta {{$detail['with']}} = \frac{ {{$detail['ub']}}-{{$detail['lb']}} }{ {{$detail['n']}} } = {{$detail['diff']}}\)</p>
                            <p class="mt-3">{{$lang['12']}} \([{{$detail['lb']}},{{$detail['ub']}}]\) {{$lang['13']}} \(n={{$detail['n']}}\) {{$lang['14']}} \(Δ{{$detail['with']}}={{$detail['diff']}}\) {{$lang['15']}}:</p>
                            <p class="mt-3">
                                \(
                                    a =
                                    @php
                                        $j=0;
                                        $len=count($detail['steps'])-1;
                                        while ($j<$len) {
                                            if ($detail['limit_a'][$j]!=$detail['limit_a'][$len-1]) {
                                                echo $detail['limit_a'][$j].', ';
                                            }else{
                                                echo $detail['limit_a'][$j];
                                            }
                                            $j++;
                                        }
                                    @endphp
                                    =b
                                \)
                            </p>
                            <p class="mt-3">{{$lang['16']}}.</p>
                            @php $i=0;$show=''; @endphp
                            @foreach ($detail['steps'] as $key => $value)
                                @if(!empty($value))
                                    @php
                                        if ((count($detail['steps'])-2)==$i) {
                                            $show .= "$value";
                                        }else{
                                            $show .= "$value + ";
                                        }
                                    @endphp
                                    @if($i==0 || (count($detail['steps'])-2)==$i)
                                        <p class="mt-3">\( f({{$detail['with']}}_{ {{$i}} }) = f({{$detail['limit_a'][$i]}}) = {{str_replace($detail['with'], $detail['limit_a'][$i], $detail['enter'])}} = {{$value}} \)</p>
                                    @else
                                        <p class="mt-3">\( 2f({{$detail['with']}}_{ {{$i}} }) = 2f({{$detail['limit_a'][$i]}}) = 2{{str_replace($detail['with'], $detail['limit_a'][$i], $detail['enter'])}} = {{$value}} \)</p>
                                    @endif
                                    @php $i++; @endphp
                                @endif
                            @endforeach
                            <p class="mt-3">{{$lang['17']}} \(\frac{Δ{{$detail['with']}}}{2} = {{$detail['diff']/2}}\)</p>
                            <p class="mt-3">\( {{$detail['diff']/2}}({{$show}}) = {{$detail['res']}}\)</p>
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
        </script>
    @endpush
</form>