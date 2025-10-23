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
             <div class="col-span-9">
                <label for="EnterEq" class="label">{{$lang['6']}}:</label>
                <div class="w-100 py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" value="{{ isset($request->EnterEq)?$request->EnterEq:'2x^2+3x^3' }}" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9" alt="keyboard" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-span-3">
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
            <div class="col-span-12 hidden keyboard">
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-green-600" onclick="clear_input();">CLS</button>
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
                <label for="lb" class="label">{{$lang['1']}}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="lb" id="lb" class="input" value="{{ isset($request->lb)?$request->lb:'1' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="ub" class="label">{{$lang['2']}}:</label>
                <div class="w-full py-2">
                    <input type="number" step="any" name="ub" id="ub" class="input" value="{{ isset($request->ub)?$request->ub:'4' }}" aria-label="input"/>
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
                        @php
                            $EnterEq= $request->EnterEq;
                            $ub= $request->ub;
                            $lb= $request->lb;
                            $with= $request->with;
                        @endphp
                        <div class="w-full text-[16px]">
                            <p class="mt-3 text-[18px]"><strong>{{$lang['3']}}</strong></p>
                            <p class="mt-3">\( \int\limits_{{$lb.'^'.$ub}} ({{$detail['enter']}})\, d{{$with}} \)</p>
                            <p class="mt-3">\( = {{$detail['ress']}} ≈ {{round($detail['ress1'],3)}} \)</p>
                            <p class="mt-3 text-[18px]"><strong>{{$lang['4']}}</strong></p>
                            <p class="mt-3">\( \int ({{$detail['enter']}})\, d{{$with}} \)</p>
                            <p class="mt-3">\(= \left({{$detail['res']}}\right) + \mathrm{constant}\)</p>
                            <p class="mt-3"><strong>{{$lang['5']}}</strong></p>
                            <p class="mt-3 text-center">\( \int ({{$detail['enter']}})\, d{{$with}} \)</p>
                            <div class="w-full res_step">
                                <p class="mt-3">{!!$detail['step']!!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        @if (isset($detail))
            <script>
                function loadMathJax() {
                    var mathJaxScript = document.createElement('script');
                    mathJaxScript.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
                    document.querySelector('head').appendChild(mathJaxScript);
                
                    var mathJaxConfigScript = document.createElement('script');
                    mathJaxConfigScript.type = "text/x-mathjax-config";
                    mathJaxConfigScript.textContent = 'MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}}); function MJrerender() { MathJax.Hub.Queue(["Rerender", MathJax.Hub]); }';
                    document.querySelector('head').appendChild(mathJaxConfigScript);
                }
                
                window.addEventListener('load', function () {
                    loadMathJax();
                });
            </script>
        @endif
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