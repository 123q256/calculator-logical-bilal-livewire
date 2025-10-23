<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                @php $request = request();@endphp
                <div class="col-span-12">
                    <label for="cal" class="font-s-14 text-blue"><?= $lang['1'] ?></label>
                    <div class="w-100 py-2">
                        <select name="cal" class="input" id="cal" aria-label="select">
                            <option value="y">{{$lang[2].": y=f(x)"}}</option>
                            <option value="x" {{ isset($request->cal) && $request->cal == 'x' ? 'selected' : '' }}>{{$lang[2].": x=f(y)"}}</option>
                            <option value="xy" {{ isset($request->cal) && $request->cal == 'xy' ? 'selected' : '' }}>{{$lang[3].": x=x(t), y=y(t)"}}</option>
                            <option value="r" {{ isset($request->cal) && $request->cal == 'r' ? 'selected' : '' }}>{{$lang[4].": r=r(t)"}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12" id="f">
                    <label for="func" class="font-s-14 text-blue">
                        <?=$lang[5]?> 
                        <span class="text-blue" id="ch">
                            @if(isset($request->cal) && $request->cal == 'x')
                                f(y):
                            @elseif(isset($request->cal) && $request->cal == 'r')
                                r(t):
                            @elseif(isset($request->cal) && $request->cal == 'xy')
                                x(t):
                            @else
                                f(x):
                            @endif
                        </span>
                    </label>
                    <div class="w-100 py-2">
                        <input type="text" name="func" id="func" class="input f" aria-label="input" value="{{ 
                            isset($request->cal) && ($request->cal === 'xy' || $request->cal === 'r') 
                                ? ($request->func ?? '6t^3+7t^2-7t+10') 
                                : (isset($request->cal) && $request->cal === 'x' 
                                    ? ($request->func ?? '10y^3+3y^2-7y-7') 
                                    : ($request->func ?? '3*x^2')) 
                        }}" />
                    </div>
                    
                </div>
                <div class="col-span-12 {{ isset($request->cal) && ($request->cal == 'xy') ? '' : 'hidden' }}" id="f1">
                    <label for="func1" class="font-s-14 text-blue">y(t):</label>
                    <div class="w-100 py-2">
                        <input type="text" name="func1" id="func1" class="input" value="{{ isset($request->func1)?$request->func1:'5*t^3' }}" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12" id="p">
                    <label for="func" class="font-s-14 text-blue">
                        <?=$lang[6]?> 
                        <span class="text-blue" id="ch2">
                            @if(isset($request->cal) && $request->cal == 'x')
                                (y₀):
                            @elseif(isset($request->cal) && ($request->cal == 'r' || $request->cal == 'xy'))
                                (t):
                            @else
                                (x₀):
                            @endif
                        </span>
                    </label>
                    <div class="w-100 py-2">
                        <input type="text" name="point" id="point" class="input" value="{{ isset($request->point)?$request->point:'2' }}" aria-label="input"/>
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
                <div class="w-full  mt-3">
                    @php
                        $cal = $request->cal;
                        $func = $request->func;
                        $func1 = $request->func1;
                        $point = $request->point;
                    @endphp
                    <div class="w-full">
                        <div class="w-full text-[16px]">
                            <p class="mt-3 text-[20px]"><strong>\( y = <?=$detail['ans']?> \)</strong></p>
                            <p class="mt-3"><strong><?=$lang['7']?></strong></p>
                            <?php if($cal==='y'){ ?>
                                <p class="mt-3">\( f(x) = <?=$detail['enter']?> \)</p>
                            <?php }elseif($cal==='x'){ ?>
                                <p class="mt-3">\( f(y) = <?=$detail['enter']?> \)</p>
                            <?php }elseif($cal==='xy'){ ?>
                                <p class="mt-3">\( x(t) = <?=$detail['enter']?> \)</p>
                                <p class="mt-3">\( y(t) = <?=$detail['enter1']?> \)</p>
                            <?php }elseif($cal==='r'){ ?>
                                <p class="mt-3">\( r(t) = <?=$detail['enter']?> \)</p>
                            <?php } ?>
                            <p class="mt-3"> <strong><?=$lang['9']?>:</strong></p>
                            <?php if($cal==='y'){ ?>
                                <p class="mt-3"><?=$lang['10']?> (<?=$detail['point']?>) <?=$lang['11']?> f(x)</p>
                                <p class="mt-3">\( f(x) = <?=$detail['enter']?> \)</p>
                                <p class="mt-3">\( f(<?=$detail['point']?>) = <?=str_replace('x','('.$detail['point'].')',$detail['enter'])?> \)</p>
                                <p class="mt-3">\( f(<?=$detail['point']?>) = <?=$detail['s1']?> \)</p>
                                <p class="my-3"><?=$lang['12']?> (for step by step, check <a href="https://technical-calculator.com/derivative-calculator/" class="text-blue-500 underline" target="_blank">Derivative Calculator</a>)</p>
                                <div class="w-full res_step"><?=$detail['steps']?></div>
                                <p class="mt-3"><?=$lang['10']?> (<?=$detail['point']?>) <?=$lang['11']?> f'(x) to find slope</p>
                                <p class="mt-3">\( f(x) = <?=$detail['diff']?> \)</p>
                                <p class="mt-3">\( f(<?=$detail['point']?>) = <?=str_replace('x','('.$detail['point'].')',$detail['diff'])?> \)</p>
                                <p class="mt-3">\( f(<?=$detail['point']?>) = <?=$detail['s2']?> \)</p>
                                <p class="mt-3"><?=$lang['13']?></p>
                                <p class="mt-3">\( y - y₀ = m(x - x₀) \)</p>
                                <p class="mt-3">\( y - (<?=$detail['s1']?>) = <?=$detail['s2']?>(x - (<?=$detail['point']?>)) \)</p>
                                <p class="mt-3"><?=$lang['14']?></p>
                                <p class="mt-3">\( y = <?=$detail['ans']?> \)</p>
                            <?php }elseif($cal==='x'){ ?>
                                <p class="mt-3"><?=$lang['10']?> (<?=$detail['point']?>) <?=$lang['11']?> f(y)</p>
                                <p class="mt-3">\( f(y) = <?=$detail['enter']?> \)</p>
                                <p class="mt-3">\( f(<?=$detail['point']?>) = <?=str_replace('x','('.$detail['point'].')',$detail['enter'])?> \)</p>
                                <p class="mt-3">\( f(<?=$detail['point']?>) = <?=$detail['s1']?> \)</p>
                                <p class="my-3"><?=$lang['12']?> (for step by step, check <a href="https://technical-calculator.com/derivative-calculator/" class="text-blue-500 underline" target="_blank">Derivative Calculator</a>)</p>
                                <div class="w-full res_step"><?=$detail['steps']?></div>
                                <p class="mt-3"><?=$lang['10']?> (<?=$detail['point']?>) <?=$lang['11']?> f'(x) to find slope</p>
                                <p class="mt-3">\( f(y) = <?=$detail['diff']?> \)</p>
                                <p class="mt-3">\( f(<?=$detail['point']?>) = <?=str_replace('x','('.$detail['point'].')',$detail['diff'])?> \)</p>
                                <p class="mt-3">\( f(<?=$detail['point']?>) = <?=$detail['s2']?> \)</p>
                                <p class="mt-3"><?=$lang['13']?></p>
                                <p class="mt-3">\( x - x₀ = m(y - y₀) \)</p>
                                <p class="mt-3">\( x - (<?=$detail['s1']?>) = <?=$detail['s2']?>(y - (<?=$detail['point']?>)) \)</p>
                                <p class="mt-3"><?=$lang['14']?></p>
                                <p class="mt-3">\( y = <?=$detail['ans']?> \)</p>
                            <?php }elseif($cal==='xy'){ ?>
                                <p class="mt-3"><?=$lang['10']?> (<?=$detail['point']?>) <?=$lang['11']?> x(t)</p>
                                <p class="mt-3">\( x(t) = <?=$detail['enter']?> \)</p>
                                <p class="mt-3">\( x(<?=$detail['point']?>) = <?=str_replace('t','('.$detail['point'].')',$detail['enter'])?> \)</p>
                                <p class="mt-3">\( x(<?=$detail['point']?>) = <?=$detail['s1']?> \)</p>
                                <p class="mt-3"><?=$lang['10']?> (<?=$detail['point']?>) <?=$lang['11']?> y(t)</p>
                                <p class="mt-3">\( x(t) = <?=$detail['enter1']?> \)</p>
                                <p class="mt-3">\( x(<?=$detail['point']?>) = <?=str_replace('t','('.$detail['point'].')',$detail['enter'])?> \)</p>
                                <p class="mt-3">\( x(<?=$detail['point']?>) = <?=$detail['s11']?> \)</p>
                                <p class="my-3"><?=$lang['12']?> w.r.t x (for step by step, check <a href="https://technical-calculator.com/derivative-calculator/" class="text-blue-500 underline" target="_blank">Derivative Calculator</a>)</p>
                                <div class="w-full res_step"><?=$detail['steps']?></div>
                                <p class="mt-3"><?=$lang['12']?> w.r.t y (for step by step, check <a href="https://technical-calculator.com/derivative-calculator/" class="text-blue-500 underline" target="_blank">Derivative Calculator</a>)</p>
                                <div class="w-full res_step"><?=$detail['steps1']?></div>
                                <p class="mt-3"><?=$lang['15']?>,</p>
                                <p class="mt-3">\( \frac{dy}{dx} = \frac{<?=$detail['diff1']?>}{<?=$detail['diff']?>} \)</p>
                                <p class="mt-3">\( \frac{dy}{dx} = <?=$detail['s3']?> \)</p>
                                <?php if(preg_match("/t/",$detail['s3'])){ ?>
                                    <p class="mt-3"><?=$lang['10']?> (<?=$detail['point']?>) into derivative to find slope</p>
                                    <p class="mt-3">\( \frac{dy}{dx} = <?=$detail['s3']?> \)</p>
                                    <p class="mt-3">\( \frac{dy}{dx} = <?=str_replace('t','('.$detail['point'].')',$detail['s3'])?> \)</p>
                                    <p class="mt-3">\( \frac{dy}{dx} = \space \)<span class="font_size20">\( <?=$detail['s4']?> \)</span></p>
                                <?php } ?>
                                <p class="mt-3"><?=$lang['13']?></p>
                                <p class="mt-3">\( y - y₀ = m(x - x₀) \)</p>
                                <p class="mt-3">\( y - (<?=$detail['s11']?>) = <?=($detail['s4']-(int)$detail['s4']===0)?$detail['s4']:'\)<span>\('.$detail['s3'].'\)</span>\('?>(x - (<?=$detail['s1']?>)) \)</p>
                                <p class="mt-3"><?=$lang['14']?></p>
                                <p class="mt-3">\( y = <?=$detail['ans']?> \)</p>
                            <?php }elseif($cal==='r'){ ?>
                                <p class="mt-3"><?=$lang['10']?> (<?=$detail['point']?>) <?=$lang['11']?> r(t)</p>
                                <p class="mt-3">\( r(t) = <?=$detail['enter']?> \)</p>
                                <p class="mt-3">\( r(<?=$detail['point']?>) = <?=str_replace('t','('.$detail['point'].')',$detail['enter'])?> \)</p>
                                <p class="mt-3">\( r(<?=$detail['point']?>) = <?=$detail['s1']?> \)</p>
                                <p class="mt-3"><?=$lang['12']?> (for step by step, check <a href="https://technical-calculator.com/derivative-calculator/" class="text-blue-500 underline" target="_blank">Derivative Calculator</a>)</p>
                                <div class="w-full res_step"><?=$detail['steps']?></div>
                                <p class="mt-3"><?=$lang['15']?>,</p>
                                <p class="mt-3">\( \frac{dy}{dx} = <?=$detail['s2']?> \)</p>
                                <p class="mt-3">\( \frac{dy}{dx} = <?=$detail['s3']?> \)</p>
                                <p class="mt-3"><?=$lang['10']?> (<?=$detail['point']?>) into derivative to find slope</p>
                                <p class="mt-3">\( \frac{dy}{dx} = <?=$detail['s3']?> \)</p>
                                <p class="mt-3">\( \frac{dy}{dx} = <?=str_replace('(t','('.$detail['point'],$detail['s3'])?> \)</p>
                                <p class="mt-3">\( \frac{dy}{dx} = \space <?=$detail['s4']?> \)</p>
                                <p class="mt-3"><?=$lang['13']?></p>
                                <p class="mt-3">\( y - y₀ = m(x - x₀) \)</p>
                                <p class="mt-3">\( y - (<?=$detail['y0']?>) = <?=$detail['s4']?>(x - (<?=$detail['x0']?>)) \)</p>
                                <p class="mt-3"><?=$lang['14']?></p>
                                <p class="mt-3">\( y = <?=$detail['ans']?> \)</p>
                            <?php } ?>
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
            document.getElementById('cal').addEventListener('change', function() {
                var value = this.value;
                if (value === 'y') {
                    ['#f', '#p'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#f1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    document.getElementById('ch').textContent = 'f(x)';
                    document.getElementById('ch2').textContent = '(x₀)';
                    document.getElementById('func').value = "3*x^2";
                } else if (value === 'x') {
                    ['#f', '#p'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#f1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    document.getElementById('ch').textContent = 'f(y)';
                    document.getElementById('ch2').textContent = '(y₀)';
                    document.getElementById('func').value = "y+2^2";
                } else if (value === 'xy') {
                    ['#f', '#p', '#f1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    document.getElementById('ch').textContent = 'y(t)';
                    document.getElementById('ch2').textContent = '(t)';
                    document.getElementById('func').value = "3*t^2";
                } else if (value === 'r') {
                    ['#f', '#p'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.remove('hidden');
                        });
                    });
                    ['#f1'].forEach(function(selector) {
                        document.querySelectorAll(selector).forEach(function(element) {
                            element.classList.add('hidden');
                        });
                    });
                    document.getElementById('ch').textContent = 'r(t)';
                    document.getElementById('ch2').textContent = '(t)';
                    document.getElementById('func').value = "3*t^2";
                }
            });
        </script>
    @endpush
</form>
