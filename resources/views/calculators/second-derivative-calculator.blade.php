<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php 
                $request = request();
                if(!isset($request->with)) {
                    $request->with = "x";
                }
            @endphp
            <div class="col-span-12">
                <label for="EnterEq" class="font-s-14 text-blue"><?=$lang['1']?> Please write e^x as e^{x}:</label>
                <div class="w-full py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" value="{{ isset($request->EnterEq)?$request->EnterEq:'cos(x)^3*sin(x)' }}" aria-label="input"/>
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
                <label for="with" class="font-s-14 text-blue"><?=$lang['2']?> W.R.T:</label>
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
                                $with= $request->with;
                            @endphp
                            <div class="w-full text-[16px]">
                                @php $j="'"; @endphp
                                @for($i=1; $i < count($detail['final_res']); $i++)
                                    <p class="mt-3 font-s-18"><strong>\( f{{$j}} (x)\) {{$lang['2']}}</strong></p>
                                    <p class="mt-3 font-s-18">\( {{$detail['final_res'][$i+1]}} \)</p>
                                    @php $i++;$j.="'"; @endphp
                                    @php $i++; @endphp
                                    <div class="w-full mt-3">
                                        <button type="button" class="calculate repeat" style="font-size: 16px;padding: 10px;cursor: pointer;" chk="{{$i}}">{{$lang['6']}}</button>
                                    </div>
                                    <div class="w-full mt-3 res_step hidden" step_cal="{{$i}}">
                                        <p class="mt-3">{!!$detail['final_res'][$i]!!}</p>
                                    </div>
                                @endfor
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
        </script>
    @endpush
</form>