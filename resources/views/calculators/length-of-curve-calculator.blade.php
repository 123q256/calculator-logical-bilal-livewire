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
                        <option value="xyz" {{ isset($request->cal) && $request->cal == 'xyz' ? 'selected' : '' }}>{{$lang[5].": x=x(t), y=y(t), z=z(t)"}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12" id="f">
                <label for="func" class="font-s-14 text-blue">
                    <?=$lang[6]?> 
                    <span class="text-blue" id="ch">
                        @if(isset($request->cal) && $request->cal == 'x')
                            f(y):
                        @elseif(isset($request->cal) && $request->cal == 'r')
                            r(t):
                        @elseif(isset($request->cal) && ($request->cal == 'xyz' || $request->cal == 'xy'))
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
                            : (
                                isset($request->cal) && $request->cal === 'x' 
                                    ? ($request->func ?? '10y^3+3y^2-7y-7') 
                                    : (
                                        isset($request->cal) && $request->cal === 'xyz' 
                                            ? ($request->func ?? '17t^3+15t^2-13t+10') 
                                            : ($request->func ?? '6x^3+7x^2-7x+10')
                                    )
                            )
                    }}" />
                </div>
                
            </div>
            <div class="col-span-12 {{ isset($request->cal) && ($request->cal == 'xy' || $request->cal == 'xyz') ? '' : 'hidden' }}" id="f1">
                <label for="func1" class="font-s-14 text-blue">y(t):</label>
                <div class="w-100 py-2">
                    <input type="text" name="func1" id="func1" class="input f1" aria-label="input" value="{{ 
                        (isset($request->cal) && $request->cal === 'xy') 
                            ? ($request->func1 ?? '10t^3+3t^2-7t-7') 
                            : (
                                (isset($request->cal) && $request->cal === 'xyz') 
                                    ? ($request->func1 ?? '19t^3+2t^2-9t+11') 
                                    : ($request->func1 ?? '10y^3+3x^2-7y-7')
                            )
                    }}" />
                </div>
                
            </div>
            <div class="col-span-12 {{ isset($request->cal) && $request->cal == 'xyz' ? '' : 'hidden' }}" id="f2">
                <label for="func2" class="font-s-14 text-blue">z(t):</label>
                <div class="w-100 py-2">
                    <input type="text" name="func2" id="func2" class="input f2" aria-label="input" value="{{ isset($request->func2) ? $request->func2 : '6t^3+7t^2-7t+10' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="upper" class="font-s-14 text-blue"><?=$lang[7]?>:</label>
                <div class="w-100 py-2">
                    <input type="text" name="upper" id="upper" class="input" aria-label="input" value="{{ isset($request->upper) ? $request->upper : '2' }}" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="lower" class="font-s-14 text-blue"><?=$lang[8]?>:</label>
                <div class="w-100 py-2">
                    <input type="text" name="lower" id="lower" class="input" aria-label="input" value="{{ isset($request->lower) ? $request->lower : '0' }}" />
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
                                <?php if($request->cal==='y'){ ?>
                                    <p class="mt-3 font-s-18">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['diff']?>\right)^2+1}d x  \)</p>
                                <?php }elseif($request->cal==='x'){ ?>
                                    <p class="mt-3 font-s-18">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['diff']?>\right)^2+1}d y \)</p>
                                <?php }elseif($request->cal==='xy'){ ?>
                                    <p class="mt-3 font-s-18">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['diff']?>\right)^2+\left(<?=$detail['diff1']?>\right)^2}dt \)</p>
                                <?php }elseif($request->cal==='r'){ ?>
                                    <p class="mt-3 font-s-18">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['enter']?>\right)^2+\left(<?=$detail['diff']?>\right)^2}dt \)</p>
                                <?php }elseif($request->cal==='xyz'){ ?>
                                    <p class="mt-3 font-s-18">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['diff']?>\right)^2+\left(<?=$detail['diff1']?>\right)^2+\left(<?=$detail['diff2']?>\right)^2}dt \)</p>
                                <?php } ?>
                                <p class="mt-3"> <strong><?=$lang[10]?>:</strong></p>
                                <p class="mt-3"><?=$lang[9]?></p>
                                <?php if($request->cal==='y'){ ?>
                                    <p class="mt-3">\( f(x) = <?=$detail['enter']?> \ on \ [<?=$detail['lower']?>,<?=$detail['upper']?>] \)</p>
                                  <?php }elseif($request->cal==='x'){ ?>
                                    <p class="mt-3">\( f(y) = <?=$detail['enter']?> \ on \ [<?=$detail['lower']?>,<?=$detail['upper']?>] \)</p>
                                  <?php }elseif($request->cal==='xy'){ ?>
                                    <p class="mt-3">\( x(t) = <?=$detail['enter']?> \ on \ [<?=$detail['lower']?>,<?=$detail['upper']?>] \)</p>
                                    <p class="mt-3">\( y(t) = <?=$detail['enter1']?> \ on \ [<?=$detail['lower']?>,<?=$detail['upper']?>] \)</p>
                                  <?php }elseif($request->cal==='r'){ ?>
                                    <p class="mt-3">\( r(t) = <?=$detail['enter']?> \ on \ [<?=$detail['lower']?>,<?=$detail['upper']?>] \)</p>
                                  <?php }elseif($request->cal==='xyz'){ ?>
                                    <p class="mt-3">\( x(t) = <?=$detail['enter']?> \ on \ [<?=$detail['lower']?>,<?=$detail['upper']?>] \)</p>
                                    <p class="mt-3">\( y(t) = <?=$detail['enter1']?> \ on \ [<?=$detail['lower']?>,<?=$detail['upper']?>] \)</p>
                                    <p class="mt-3">\( z(t) = <?=$detail['enter2']?> \ on \ [<?=$detail['lower']?>,<?=$detail['upper']?>] \)</p>
                                  <?php } ?>
                                <?php if($request->cal==='y'){ ?>
                                    <p class="mt-3"><?=$lang[11]?>:</p>
                                    <p class="mt-3">\( L = \int_a^b \sqrt{\left(f'\left(x\right)\right)^2+1}d x  \)</p>
                                    <p class="mt-3"><?=$lang[12]?>: (<?=$lang[13]?> <a href="https://calculator-online.net/derivative-calculator/" class="text-blue" target="_blank">Derivative Calculator</a>)</p>
                                    <p class="mt-3">\( f \left(x\right)=(<?=$detail['enter']?>) = <?=$detail['diff']?> \)</p>
                                    <p class="mt-3"><?=$lang[14]?>:</p>
                                    <p class="mt-3">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['diff']?>\right)^2+1}d x  \)</p>
                                    <p class="mt-3"><?=$lang[15]?> (<?=$lang[13]?> <a href="https://calculator-online.net/integral-calculator/" class="text-blue" target="_blank">Integral Calculator</a>)</p>
                                  <?php }elseif($request->cal==='x'){ ?>
                                    <p class="mt-3"><?=$lang[11]?>:</p>
                                    <p class="mt-3">\( L = \int_a^b \sqrt{\left(f'\left(x\right)\right)^2+1}d y  \)</p>
                                    <p class="mt-3"><?=$lang[12]?>: (<?=$lang[13]?> <a href="https://calculator-online.net/derivative-calculator/" class="text-blue" target="_blank">Derivative Calculator</a>)</p>
                                    <p class="mt-3">\( f \left(x\right)=(<?=$detail['enter']?>)=<?=$detail['diff']?> \)</p>
                                    <p class="mt-3"><?=$lang[14]?>:</p>
                                    <p class="mt-3">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['diff']?>\right)^2+1}d y  \)</p>
                                    <p class="mt-3"><?=$lang[15]?> (<?=$lang[13]?> <a href="https://calculator-online.net/integral-calculator/" class="text-blue" target="_blank">Integral Calculator</a>)</p>
                                  <?php }elseif($request->cal==='xy'){ ?>
                                    <p class="mt-3"><?=$lang[11]?>:</p>
                                    <p class="mt-3">\( L = \int_a^b \sqrt{\left(x'\left(t\right)\right)^2+ \left(y'\left(t\right)\right)^2}dt  \)</p>
                                    <p class="mt-3"><?=$lang[12]?>: (<?=$lang[13]?> <a href="https://calculator-online.net/derivative-calculator/" class="text-blue" target="_blank">Derivative Calculator</a>)</p>
                                    <p class="mt-3">\( x \left(t\right)=(<?=$detail['enter']?>)=<?=$detail['diff']?> \)</p>
                                    <p class="mt-3">\( y \left(t\right)=(<?=$detail['enter1']?>)=<?=$detail['diff1']?> \)</p>
                                    <p class="mt-3"><?=$lang[14]?>:</p>
                                    <p class="mt-3">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['diff']?>\right)^2+\left(<?=$detail['diff1']?>\right)^2}dt  \)</p>
                                    <p class="mt-3"><?=$lang[15]?> (<?=$lang[13]?> <a href="https://calculator-online.net/integral-calculator/" class="text-blue" target="_blank">Integral Calculator</a>)</p>
                                  <?php }elseif($request->cal==='r'){ ?>
                                    <p class="mt-3"><?=$lang[11]?>:</p>
                                    <p class="mt-3">\( L = \int_a^b \sqrt{\left(r\left(t\right)\right)^2+ \left(r'\left(t\right)\right)^2}dt  \)</p>
                                    <p class="mt-3"><?=$lang[12]?>: (<?=$lang[13]?> <a href="https://calculator-online.net/derivative-calculator/" class="text-blue" target="_blank">Derivative Calculator</a>)</p>
                                    <p class="mt-3">\( r \left(t\right)=(<?=$detail['enter']?>)=<?=$detail['diff']?> \)</p>
                                    <p class="mt-3"><?=$lang[14]?>:</p>
                                    <p class="mt-3">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['enter']?>\right)^2+\left(<?=$detail['diff']?>\right)^2}dt  \)</p>
                                    <p class="mt-3"><?=$lang[15]?> (<?=$lang[13]?> <a href="https://calculator-online.net/integral-calculator/" class="text-blue" target="_blank">Integral Calculator</a>)</p>
                                  <?php }elseif($request->cal==='xyz'){ ?>
                                    <p class="mt-3"><?=$lang[11]?>:</p>
                                    <p class="mt-3">\( L = \int_a^b \sqrt{\left(x'\left(t\right)\right)^2+ \left(y'\left(t\right)\right)^2 + \left(z'\left(t\right)\right)^2}dt  \)</p>
                                    <p class="mt-3"><?=$lang[12]?>: (<?=$lang[13]?> <a href="https://calculator-online.net/derivative-calculator/" class="text-blue" target="_blank">Derivative Calculator</a>)</p>
                                    <p class="mt-3">\( x \left(t\right)=(<?=$detail['enter']?>)=<?=$detail['diff']?> \)</p>
                                    <p class="mt-3">\( y \left(t\right)=(<?=$detail['enter1']?>)=<?=$detail['diff1']?> \)</p>
                                    <p class="mt-3">\( z \left(t\right)=(<?=$detail['enter2']?>)=<?=$detail['diff2']?> \)</p>
                                    <p class="mt-3"><?=$lang[14]?>:</p>
                                    <p class="mt-3">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['diff']?>\right)^2+\left(<?=$detail['diff1']?>\right)^2+\left(<?=$detail['diff2']?>\right)^2}dt  \)</p>
                                    <p class="mt-3"><?=$lang[15]?> (<?=$lang[13]?> <a href="https://calculator-online.net/integral-calculator/" class="text-blue" target="_blank">Integral Calculator</a>)</p>
                                  <?php } ?>
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
            document.getElementById('cal').addEventListener('change', function() {
                var value = this.value;
                var fElement = document.getElementById('f');
                var f1Element = document.getElementById('f1');
                var f2Element = document.getElementById('f2');
                var chElement = document.getElementById('ch');
                var fInputs = document.querySelectorAll('.f');
                var f1Inputs = document.querySelectorAll('.f1');
                function hideElements(elements) {
                    elements.forEach(function(element) {
                        element.style.display = 'none';
                    });
                }

                function showElements(elements) {
                    elements.forEach(function(element) {
                        element.style.display = 'block';
                    });
                }

                if (value === 'y') {
                    showElements([fElement]);
                    hideElements([f1Element, f2Element]);
                    fInputs.forEach(function(input) {
                        input.value = '6x^3+7x^2-7x+10';
                    });
                    chElement.textContent = 'f(x)';
                } else if (value === 'x') {
                    showElements([fElement]);
                    hideElements([f1Element, f2Element]);
                    fInputs.forEach(function(input) {
                        input.value = '10y^3+3y^2-7y-7';
                    });
                    chElement.textContent = 'f(y)';
                } else if (value === 'xy') {
                    showElements([fElement, f1Element]);
                    hideElements([f2Element]);
                    fInputs.forEach(function(input) {
                        input.value = '6t^3+7t^2-7t+10';
                    });
                    f1Inputs.forEach(function(input) {
                        input.value = '10t^3+3t^2-7t-7';
                    });
                    chElement.textContent = 'x(t)';
                } else if (value === 'r') {
                    showElements([fElement]);
                    hideElements([f1Element, f2Element]);
                    fInputs.forEach(function(input) {
                        input.value = '6t^3+7t^2-7t+10';
                    });
                    chElement.textContent = 'r(t)';
                } else if (value === 'xyz') {
                    showElements([fElement, f1Element, f2Element]);
                    fInputs.forEach(function(input) {
                        input.value = '17t^3+15t^2-13t+10';
                    });
                    f1Inputs.forEach(function(input) {
                        input.value = '19t^3+2t^2-9t+11';
                    });
                    chElement.textContent = 'x(t)';
                }
            });
        </script>
    @endpush
</form>
