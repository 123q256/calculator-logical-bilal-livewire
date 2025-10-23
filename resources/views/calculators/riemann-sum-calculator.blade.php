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
                    <input type="number" name="lb" id="lb" class="input" value="{{ isset($request->lb)?$request->lb:'1' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="ub" class="label">{{$lang['3']}}:</label>
                <div class="w-full py-2">
                    <input type="number" name="ub" id="ub" class="input" value="{{ isset($request->ub)?$request->ub:'4' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="n" class="label">{{$lang['4']}}:</label>
                <div class="w-full py-2">
                    <input type="number" name="n" id="n" class="input" value="{{ isset($request->n)?$request->n:'5' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="type" class="label">{{$lang['5']}}:</label>
                <div class="w-full py-2">
                    <select name="type" class="input" id="type" aria-label="select">
                        <option value="1"><?=$lang['6']?></option>
                        <option value="2" {{ isset($request->type) && $request->type=='2'?'selected':'' }}><?=$lang['7']?></option>
                        <option value="3" {{ isset($request->type) && $request->type=='3'?'selected':'' }}><?=$lang['8']?></option>
                        <option value="4" {{ isset($request->type) && $request->type=='4'?'selected':'' }}><?=$lang['9']?></option>
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
                                $lb= $request->lb;
                                $ub= $request->ub;
                                $type= $request->type;
                                $n= $request->n;
                                $with= $request->with;
                            @endphp
                            <div class="w-full text-[16px]">
                                <p class="mt-3 text-[18px]">\( \int\limits_{<?=$detail['lb']?>}^{<?=$detail['ub']?>} <?=$detail['enter']?>\, d<?=$detail['with']?> = <?=$detail['res']?> \)</p>
                                <p class="mt-3"><strong>{{$lang['10']}}</strong></p>
                                <p class="mt-3"><?=$lang['11']?> \( \int\limits_{<?=$detail['lb']?>}^{<?=$detail['ub']?>} <?=$detail['enter']?>\, d<?=$detail['with']?> \) <?=$lang['12']?> \( n=<?=$detail['n']?> \) <?=$lang['13']?> 
                                    <?php if ($detail['type']==='1') {
                                        echo $lang['6'];
                                    }elseif ($detail['type']==='2') {
                                        echo $lang['7'];
                                    }elseif ($detail['type']==='3') {
                                        echo $lang['8'];
                                    }else{
                                        echo $lang['9'];
                                    } ?>
                                .</p>
                                <?php if($detail['type']==='1' || $detail['type']==='2'){ ?>
                                    <p class="mt-3">\( \int\limits_{a}^{b} f(<?=$detail['with']?>)\, d<?=$detail['with']?> ≈ \Delta <?=$detail['with']?>(f(<?=$detail['with']?>_0) + f(<?=$detail['with']?>_1) + f(<?=$detail['with']?>_2) + ... + f(<?=$detail['with']?>_{n-2}) + f(<?=$detail['with']?>_{n-1}))\)</p>
                                    <p class="mt-3"><?=$lang['14']?> \( \Delta <?=$detail['with']?> = \frac{b-a}{n}\)</p>
                                    <p class="mt-3"><?=$lang['15']?> \( a = <?=$detail['lb']?>,b = <?=$detail['ub']?>,n = <?=$detail['n']?>\)</p>
                                    <p class="mt-3">So, \(\Delta <?=$detail['with']?> = \frac{<?=$detail['ub']?>-<?=$detail['lb']?>}{<?=$detail['n']?>} = <?=$detail['diff']?>\)</p>
                                    <p class="mt-3"><?=$lang['16']?> \([<?=$detail['lb']?>,<?=$detail['ub']?>]\) <?=$lang['25']?> \(n=<?=$detail['n']?>\) <?=$lang['17']?> \(Δ<?=$detail['with']?>=<?=$detail['diff']?>\) <?=$lang['18']?>:</p>
                                    <p class="mt-3">\(a=<?=$detail['limit']?>=b\)</p>
                                    <p class="mt-3"><?=$lang['19']?> <?=(($detail['type']==='1')?'left':'right')?> <?=$lang['20']?></p>
                                    <?php $i=0;$show=''; foreach ($detail['steps'] as $key => $value) {
                                        if(!empty($value)){
                                            if ((count($detail['steps'])-2)==$i) {
                                                $show .= "$value";
                                            }else{
                                                $show .= "$value + ";
                                            }
                                        ?>
                                        <p class="mt-3">\(f(<?=$detail['with']?>_{<?=$i?>}) = f(<?=$detail['limit_a'][$i]?>) = <?=str_replace($detail['with'], $detail['limit_a'][$i], $detail['enter'])?> = <?=$value?>\)</p>
                                    <?php $i++;}} ?>
                                    <p class="mt-3"><?=$lang['21']?> \(Δ<?=$detail['with']?> = <?=$detail['diff']?>\)</p>
                                    <p class="mt-3">\( <?=$detail['diff']?>(<?=$show?>) = <?=$detail['res']?>\)</p>
                                <?php }elseif($detail['type']==='3'){ ?>
                                    <p class="col s12 font_size18">\(\int\limits_{a}^{b} f(<?=$detail['with']?>)\, d<?=$detail['with']?> ≈ \Delta <?=$detail['with']?>(f(\frac{<?=$detail['with']?>_0+<?=$detail['with']?>_1}{2}) + f(\frac{<?=$detail['with']?>_1+<?=$detail['with']?>_2}{2}) + f(\frac{<?=$detail['with']?>_2+<?=$detail['with']?>_3}{2}) + ... + f(\frac{<?=$detail['with']?>_{n-2}+<?=$detail['with']?>_{n-1}}{2}) + f(\frac{<?=$detail['with']?>_{n-1}+<?=$detail['with']?>_n}{2}))\)</p>
                                    <p class="mt-3"><?=$lang['14']?> \(\Delta <?=$detail['with']?> = \frac{b-a}{n}\)</p>
                                    <p class="mt-3"><?=$lang['15']?> \(a = <?=$detail['lb']?>,b = <?=$detail['ub']?>,n = <?=$detail['n']?>\)</p>
                                    <p class="mt-3">So, \(\Delta <?=$detail['with']?> = \frac{<?=$detail['ub']?>-<?=$detail['lb']?>}{<?=$detail['n']?>} = <?=$detail['diff']?>\)</p>
                                    <p class="mt-3"><?=$lang['16']?> \([<?=$detail['lb']?>,<?=$detail['ub']?>]\) <?=$lang['25']?> \(n=<?=$detail['n']?>\) <?=$lang['17']?> \(Δ<?=$detail['with']?>=<?=$detail['diff']?>\) <?=$lang['18']?>:</p>
                                    <p class="mt-3">\(a=<?=$detail['limit']?>=b\)</p>
                                    <p class="mt-3"><?=$lang['19']?> <?=$lang['22']?>.</p>
                                    <?php $i=0;$show=''; foreach ($detail['steps'] as $key => $value) {
                                        if(!empty($value)){
                                            if ((count($detail['steps'])-2)==$i) {
                                                $show .= "$value";
                                            }else{
                                                $show .= "$value + ";
                                            }
                                            $inner=round(($detail['limit_a'][$i] + $detail['limit_a'][$i+1])/2,5);
                                        ?>
                                        <p class="mt-3">\(f(\frac{<?=$detail['with']?>_<?=$i?>+<?=$detail['with']?>_<?=$i+1?>}{2}) = f(\frac{<?=$detail['limit_a'][$i]?>+<?=$detail['limit_a'][$i+1]?>}{2}) = f(<?=$inner?>) = <?=str_replace($detail['with'], $inner, $detail['enter'])?> = <?=$value?>\)</p>
                                    <?php $i++;}} ?>
                                    <p class="mt-3"><?=$lang['21']?> \(Δ<?=$detail['with']?> = <?=$detail['diff']?>\)</p>
                                    <p class="mt-3">\( <?=$detail['diff']?>(<?=$show?>) = <?=$detail['res']?>\)</p>
                                <?php }elseif($detail['type']==='4'){ ?>
                                    <p class="col s12 font_size18">\(\int\limits_{a}^{b} f(<?=$detail['with']?>)\, d<?=$detail['with']?> ≈ \Delta <?=$detail['with']?>(\frac{f(<?=$detail['with']?>_0)+f(<?=$detail['with']?>_1)}{2} + \frac{f(<?=$detail['with']?>_1)+f(<?=$detail['with']?>_2)}{2} + \frac{f(<?=$detail['with']?>_2)+f(<?=$detail['with']?>_3)}{2} + ... + \frac{f(<?=$detail['with']?>_{n-2})+f(<?=$detail['with']?>_{n-1})}{2} + \frac{f(<?=$detail['with']?>_{n-1})+f(<?=$detail['with']?>_n)}{2})\)</p>
                                    <p class="mt-3"><?=$lang['14']?> \(\Delta <?=$detail['with']?> = \frac{b-a}{n}\)</p>
                                    <p class="mt-3"><?=$lang['15']?> \(a = <?=$detail['lb']?>,b = <?=$detail['ub']?>,n = <?=$detail['n']?>\)</p>
                                    <p class="mt-3"><?=$lang['24']?>, \(\Delta <?=$detail['with']?> = \frac{<?=$detail['ub']?>-<?=$detail['lb']?>}{<?=$detail['n']?>} = <?=$detail['diff']?>\)</p>
                                    <p class="mt-3"><?=$lang['16']?> \([<?=$detail['lb']?>,<?=$detail['ub']?>]\) <?=$lang['25']?> \(n=<?=$detail['n']?>\) <?=$lang['17']?> \(Δ<?=$detail['with']?>=<?=$detail['diff']?>\) <?=$lang['18']?>:</p>
                                    <p class="mt-3">\(a=<?=$detail['limit']?>=b\)</p>
                                    <p class="mt-3"><?=$lang['19']?> <?=$lang['23']?>.</p>
                                    <?php $i=0;$show=''; foreach ($detail['steps'] as $key => $value) {
                                        if(!empty($value)){
                                            if ((count($detail['steps'])-2)==$i) {
                                                $show .= "$value";
                                            }else{
                                                $show .= "$value + ";
                                            }
                                        ?>
                                        <p class="mt-3">\(\frac{f(<?=$detail['with']?>_<?=$i?>)+f(<?=$detail['with']?>_<?=$i+1?>)}{2} = \frac{f(<?=$detail['limit_a'][$i]?>)+f(<?=$detail['limit_a'][$i+1]?>)}{2} = \frac{<?=str_replace($detail['with'], $detail['limit_a'][$i], $detail['enter'])?>+<?=str_replace($detail['with'], $detail['limit_a'][$i+1], $detail['enter'])?>}{2} = <?=$value?>\)</p>
                                    <?php $i++;}} ?>
                                    <p class="mt-3"><?=$lang['21']?> \(Δ<?=$detail['with']?> = <?=$detail['diff']?>\)</p>
                                    <p class="mt-3">\( <?=$detail['diff']?>(<?=$show?>) = <?=$detail['res']?>\)</p>
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