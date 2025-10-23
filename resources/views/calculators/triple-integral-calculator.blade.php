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
                    $request->with = "xyz";
                }
            @endphp
            <style>
                .integral_input{
                    height: 30px;
                    background: white;
                    padding-left: 5px;
                    border: 1px solid #D2D4D8;
                    border-radius: 5px;
                    color: black;
                    font-size: 15px;
                    box-sizing: border-box;
                    width: 35px;
                    outline: 0;
                }
                .integ_symb{
                    font-size: 7rem;
                    line-height: normal;
                }
            </style>
            <div class="col-span-12 flex items-center align-items-center justify-content-center">
                <div>
                    <input type="text" name="ubx" id="ubx" class="integral_input" value="{{ isset($request->ubx)?$request->ubx:'' }}" aria-label="input" autocomplete="off" style="margin-left: -10px;margin-bottom: 5px;"/>
                    <p class="text-blue integ_symb">∫</p>
                    <input type="text" name="lbx" id="lbx" class="integral_input" value="{{ isset($request->lbx)?$request->lbx:'' }}" aria-label="input" autocomplete="off" style="margin-left: -10px;margin-top: -5px;"/>
                </div>
                <div class="mx-2">
                    <input type="text" name="uby" id="uby" class="integral_input" value="{{ isset($request->uby)?$request->uby:'' }}" aria-label="input" autocomplete="off" style="margin-bottom: 5px;"/>
                    <p class="text-blue integ_symb">∫</p>
                    <input type="text" name="lby" id="lby" class="integral_input" value="{{ isset($request->lby)?$request->lby:'' }}" aria-label="input" autocomplete="off" style="margin-top: -5px;"/>
                </div>
                <div>
                    <input type="text" name="ubz" id="ubz" class="integral_input" value="{{ isset($request->ubz)?$request->ubz:'' }}" aria-label="input" autocomplete="off" style="margin-bottom: 5px;"/>
                    <p class="text-blue integ_symb">∫</p>
                    <input type="text" name="lbz" id="lbz" class="integral_input" value="{{ isset($request->lbz)?$request->lbz:'' }}" aria-label="input" autocomplete="off" style="margin-top: -5px;"/>
                </div>
                <p class="text-blue" style="font-size: 5rem">(</p>
                <div>
                    <label for="EnterEq" class="text-[14px] text-blue">Function:</label>
                    <input type="text" name="EnterEq" id="EnterEq" class="input" value="{{ isset($request->EnterEq)?$request->EnterEq:'x^2 + 3xy^2 + xy' }}" aria-label="input" autocomplete="off"/>                    
                </div>
                <p class="text-blue" style="font-size: 5rem">)</p>
                <div>
                    <label for="with" class="text-[14px] text-blue">W.R.T:</label>
                    <div class="w-100 py-2">
                        <select name="with" class="input" id="with" aria-label="select">
                            <option value="zyx">dzdydx</option>
                            <option value="zxy" {{ isset($request->with) && $request->with=='zxy'?'selected':'' }}>dzdxdy</option>
                            <option value="xyz" {{ isset($request->with) && $request->with=='xyz'?'selected':'' }}>dxdydz</option>
                            <option value="xzy" {{ isset($request->with) && $request->with=='xzy'?'selected':'' }}>dxdzdy</option>
                            <option value="yxz" {{ isset($request->with) && $request->with=='yxz'?'selected':'' }}>dydxdz</option>
                            <option value="yzx" {{ isset($request->with) && $request->with=='yzx'?'selected':'' }}>dydzdx</option>
                        </select>
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
                        @php
                            $EnterEq= $request->EnterEq;
                            $with= $request->with;
                            $lbx= $request->lbx;
                            $ubx= $request->ubx;
                            $lby= $request->lby;
                            $uby= $request->uby;
                            $lbz= $request->lbz;
                            $ubz= $request->ubz;
                        @endphp
                        <div class="w-full text-[16px]">
                            <p class="mt-3 text-[18px]"><strong>{{$lang['8']}}</strong></p>
                            <p class="mt-3 text-[18px]">\( =<?=$detail['final']?>+ \mathrm{constant} \)</p>
                            @if($detail['def']=='def')
                                <p class="mt-3 text-[18px]"><strong>{{$lang['9']}}</strong></p>
                                <p class="mt-3 text-[18px]">\( =<?=$detail['finaln']?> \)</p>
                            @endif
                            <p class="mt-3"><strong>{{$lang['7']}}</strong></p>
                            <p class="mt-3">\( <?=$detail['enter']?> \)</p>
                            <p class="mt-3"><strong>{{$lang['10']}}</strong></p>
                            <p class="mt-3"><?=$lang['11']?>:</p>
                            <p class="mt-3 mb-3">\(<?=$detail['en1']?>\)</p>
                            <div class="w-full res_step">
                                <?=$detail['step1']?>
                            </div>
                            <p class="mt-3"><?=$lang['12']?>:</p>
                            <p class="mt-3 mb-3">\(<?=$detail['en2']?>\)</p>
                            <div class="w-full res_step">
                                <?=$detail['step2']?>
                            </div>
                            <p class="mt-3"><?=$lang['13']?>:</p>
                            <p class="mt-3 mb-3">\(<?=$detail['en3']?>\)</p>
                            <div class="w-full res_step">
                                <?=$detail['step3']?>
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