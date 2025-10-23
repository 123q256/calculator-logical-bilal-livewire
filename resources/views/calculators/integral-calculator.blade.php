<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">

                @php 
                    $request = request();
                    if(!isset($request->with)) {
                        $request->with = "x";
                    }
                @endphp
                <div class="col-span-9">
                    <label for="EnterEq" class="label">{{$lang['6']}}:</label>
                    <div class="w-full py-2 relative">
                        <input type="text" name="EnterEq" id="EnterEq" class="border border-gray-300 rounded w-full p-2" value="{{ isset($request->EnterEq)?$request->EnterEq:'cos(x)^3*sin(x)' }}" aria-label="input"/>
                        <img src="{{ asset('images/keyboard.png') }}" width="40" height="35" alt="keyboard" loading="lazy" decoding="async" class="absolute top-2 right-3 keyboardImg">
                    </div>
                </div>
                <div class="col-span-3">
                    <label for="with" class="label">W.R.T:</label>
                    <div class="w-full py-2">
                        <select name="with" class="border border-gray-300 rounded w-full p-2" id="with" aria-label="select">
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
                    <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" onclick="clear_input();">CLS</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="+">+</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="-">-</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="/">/</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="*">*</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="^">^</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="sqrt(">√</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value="(">(</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" value=")">)</button>
                </div>
                <div class="col-span-12 flex items-center px-2 mt-3">
                    <p id="defInput">
                        <input type="radio" name="form" id="def" value="def" {{ isset($request->form) && $request->form==='def' ? 'checked':'checked' }} class="mr-2">
                        <label for="def" class="text-base">Definite</label>
                    </p>
                    <p class="ml-4" id="indInput">
                        <input type="radio" name="form" id="ind" value="ind" {{ isset($request->form) && $request->form==='ind' ? 'checked':'' }} class="mr-2">
                        <label for="ind" class="text-base">Indefinite</label>
                    </p>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 {{ isset($request->form) && $request->form === 'ind' ? 'hidden' : '' }} bound">
                    <label for="ub" class="label">{{$lang['3']}}:</label>
                    <div class="w-full py-2">
                        <input type="text" name="ub" id="ub" class="border border-gray-300 rounded w-full p-2" value="{{ isset($request->ub)?$request->ub:'3' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-6 lg:col-span-6 {{ isset($request->form) && $request->form === 'ind' ? 'hidden' : '' }} bound">
                    <label for="lb" class="label">{{$lang['4']}}:</label>
                    <div class="w-full py-2">
                        <input type="text" name="lb" id="lb" class="border border-gray-300 rounded w-full p-2" value="{{ isset($request->lb)?$request->lb:'2' }}" aria-label="input"/>
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
        {{-- result --}}
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full   p-3 rounded-lg mt-3">
                        <div class="grid grid-cols-1 gap-4">
                            @php
                                $EnterEq= $request->EnterEq;
                                $ub= $request->ub;
                                $lb= $request->lb;
                                $form= $request->form;
                                $with= $request->with;
                            @endphp
                            <div class="text-base">
                                @isset($detail['defi'])
                                    <p class="mt-3 text-lg font-semibold">{{ $lang['7'] }}</strong></p>
                                    <p class="mt-3 text-lg">\( {{$detail['defi']}} \)</p>
                                @endisset
                                <p class="mt-3 text-lg font-semibold">{{ $lang['8'] }}</p>
                                <p class="mt-3 text-lg">\( {{$detail['ans']}} + \text{ constant} \)</p>
                                <p class="mt-3 text-lg font-semibold">{{ $lang['6'] }}</p>
                                @if(isset($detail['defi']))
                                    <p class="mt-3">\( \int_{ {{$lb.'}^{'.$ub}}} {{$detail['enter']}}\, d{{$with}} \)</p>
                                @else
                                    <p class="mt-3">\( \int {{$detail['enter']}}\, d{{$with}}  \)</p>
                                @endif
                                <p class="mt-3 text-lg font-semibold">Solution:</p>
                                <div class="w-full res_step overflow-auto">
                                    <p class="mt-3">{!! $detail['buffer'] !!}</p>
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
            document.querySelectorAll('#indInput').forEach(function(element) {
                element.addEventListener('click', function() {
                    document.querySelectorAll('.bound').forEach(function(keyboard) {
                        keyboard.style.display = 'none';
                        keyboard.style.transition = 'display 1.5s ease-out';
                    });
                });
            });
            document.querySelectorAll('#defInput').forEach(function(element) {
                element.addEventListener('click', function() {
                    document.querySelectorAll('.bound').forEach(function(keyboard) {
                        keyboard.style.display = 'block';
                        keyboard.style.transition = 'display 1.5s ease-out';
                    });
                });
            });
        </script>
    @endpush
</form>
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>