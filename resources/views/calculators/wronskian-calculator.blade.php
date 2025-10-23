<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            @php 
                $request = request();
                if(!isset($request->with)) {
                    $request->with = "x";
                }
            @endphp
            <div class="col-span-10">
                <label for="EnterEq" class="label">{{$lang['2']}}:</label>
                <div class="w-full py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" value="{{ isset($request->EnterEq)?$request->EnterEq:'(x^2+4), sin(2x), cos(x)' }}" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9" alt="keyboard" loading="lazy" decoding="async">

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
            </div>
            <div class="col-span-2">
                <label for="with" class="label">W.R.T:</label>
                <div class="w-100 py-2">
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
                                <p class="mt-3 text-[18px]"><strong>{{$lang['4']}}</strong></p>
                                <p class="mt-3">
                                    \( {{$detail['res']}} \)
                                </p>
                                <p class="mt-3"><strong>{{$lang['5']}}</strong></p>
                                <p class="mt-3">
                                    {{$lang['6']}}:
                                    \(
                                        @php
                                            $input=explode('##', $detail['enter']);
                                            $cou=count($input);
                                            $fs='';
                                            for ($i=0; $i<($cou-1); $i++){
                                                if (($cou-2)==$i){
                                                    $fs.="f_".($i+1);
                                                    echo "f_".($i+1)." = ".$input[$i];
                                                }else{
                                                    $fs.="f_".($i+1).",";
                                                    echo "f_".($i+1)." = ".$input[$i].",";
                                                }
                                            }
                                        @endphp
                                    \)    
                                </p>
                                <p class="mt-3">{{$lang['7']}}:</p>
                                <p class="mt-3">
                                    \( 
                                        W({{$fs}})({{$request->with}}) = 
                                        \begin{vmatrix}
                                         @php
                                             $how=$cou;
                                             $de="";
                                             while ($how > 1) {
                                                 for ($i=0; $i<($cou-1); $i++) {
                                                    if (($cou-2)==$i) {
                                                        echo "f_".($i+1)."(".$request->with.")^{".$de."} \\\ ";
                                                    }else{
                                                        echo "f_".($i+1)."(".$request->with.")^{".$de."} & ";
                                                    }
                                                }
                                                $de.="'";
                                                $how--;
                                             }
                                         @endphp \end{vmatrix}
                                    \)
                                </p>
                                <p class="mt-3">{{$lang['8']}}:</p>
                                <p class="mt-3">
                                    \( 
                                        W({{$fs}})({{$request->with}}) = 
                                        \begin{vmatrix}
                                         @php
                                             $how=$cou;
                                             $de="";
                                             while ($how > 1) {
                                                 for ($i=0; $i<($cou-1); $i++) {
                                                    if (($cou-2)==$i) {
                                                        echo "(".$input[$i].")^{".$de."} \\\ ";
                                                    }else{
                                                        echo "(".$input[$i].")^{".$de."} & ";
                                                    }
                                                }
                                                $de.="'";
                                                $how--;
                                             }
                                         @endphp \end{vmatrix}
                                    \)
                                </p>
                                <p class="mt-3">{{$lang['9']}} ({{$lang['10']}} <a href="https://calculator-online.net/derivative-calculator/" class="text-blue" target="_blank">{{$lang[11]}}</a>):</p>
                                @php $mat=str_replace('[', '|', $detail['matrix']);  @endphp
                                <p class="mt-3">\( W({{$fs}})({{$request->with}}) = {{str_replace(']', '|', $mat)}} \)</p>
                                <p class="mt-3">{{$lang['12']}}:</p>
                                <p class="mt-3">\( W({{$fs}})({{$request->with}}) = {{str_replace(']', '|', $mat)}} = {{$detail['res']}} \)</p>
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