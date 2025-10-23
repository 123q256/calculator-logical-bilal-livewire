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
                    <label for="EnterEq" class="text-sm text-blue-500">{{$lang['1']}}:</label>
                    <div class="w-full py-2 relative">
                        <input type="text" name="EnterEq" id="EnterEq" class="input w-full py-2 px-3 border border-gray-300 rounded-md" value="{{ isset($request->EnterEq)?$request->EnterEq:'(6x + 4)/(3x - 1)' }}" aria-label="input"/>
                        <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9" alt="keyboard" loading="lazy" decoding="async">
                    </div>
                </div>
                <div class="col-span-3">
                    <label for="with" class="text-sm text-blue-500">W.R.T:</label>
                    <div class="w-full py-2">
                        <select name="with" class="input w-full py-2 px-3 border border-gray-300 rounded-md" id="with" aria-label="select">
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
                <div class="col-span-9">
                    <label for="how" class="text-sm text-blue-500">{{$lang['3']}} (inf = ∞ , pi = π):</label>
                    <div class="w-full py-2">
                        <input type="text" name="how" id="how" class="input w-full py-2 px-3 border border-gray-300 rounded-md" value="{{ isset($request->how)?$request->how:'1' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-3">
                    <label for="dir" class="text-sm text-blue-500">{{$lang['4']}}:</label>
                    <div class="w-full py-2">
                        <select name="dir" class="input w-full py-2 px-3 border border-gray-300 rounded-md" id="dir" aria-label="select">
                            <option value="+">+</option>
                            <option value="-" {{ isset($request->dir) && $request->dir=='-'?'selected':'' }}>-</option>
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
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg p-4 flex items-center justify-center">
                <div class="w-full   rounded-lg mt-3">
                    <div class="flex flex-wrap">
                        @php
                            $EnterEq= $request->EnterEq;
                            $how= $request->how;
                            $with= $request->with;
                            $dir= $request->dir;
                        @endphp
                        <div class="w-full text-base">
                            <p class="mt-3 text-lg">\( \lim_{ {{$with}} \to {{$detail['inf'].'^'.$detail['dir']}} }({{$detail['enter']}}) = {{$detail['ans']}} \)</p>
                            <p class="mt-3 font-bold">{{$lang['8']}}</p>
                            <p class="mt-3">\( \lim_{ {{$with}} \to {{$detail['inf'].'^'.$detail['dir']}} }({{$detail['enter']}}) \)</p>
                            <p class="mt-3">{{$lang['9']}}:</p>
                            <p class="mt-3">\(={{$detail['put']}} \)</p>
                            @isset($detail['upr'])
                                <p class="mt-3">
                                    @if ($detail['upr'] < 0 && $detail['btm'] < 0 && $detail['upr'] != 0 && $detail['btm'] != 0)
                                        \(=\dfrac{{ abs($detail['upr']) }}{{ abs($detail['btm']) }} \)
                                    @elseif ($detail['btm'] < 0 && $detail['upr'] != 0 && $detail['btm'] != 0)
                                        \(=\dfrac{-{{ abs($detail['upr']) }}}{{ abs($detail['btm']) }} \)
                                    @else
                                        \(=\dfrac{{ $detail['upr'] }}{{ $detail['btm'] }} \)
                                    @endif
                                </p>
                            @endisset
                            <p class="mt-3">{{$lang['7']}} \( = {{$detail['ans']}} \)</p>
                            <p class="mt-3">{{$lang['10']}} {{$with}} = {{$detail['inf']}}</p>
                            <p class="mt-3">\( {{$detail['ser']}} \) <br> <span class="text-base">{{$lang['11']}}</span></p>
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
                var check = confirm("Do you want to clear the equation? ");
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
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>