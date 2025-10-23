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
            <div class="col-span-12">
                <label for="n" class="label">{{$lang['3']}} n:</label>
                <div class="w-full py-2">
                    <input type="number" name="n" id="n" class="input" value="{{ isset($request->n)?$request->n:'4' }}" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="find" class="label">{{$lang['4']}}:</label>
                <div class="w-full py-2">
                    <input type="number" name="find" id="find" class="input" value="{{ isset($request->find)?$request->find:'' }}" aria-label="input"/>
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
                        <div class="row">
                            @php
                                $EnterEq= $request->EnterEq;
                                $find= $request->find;
                                $n= $request->n;
                                $with= $request->with;
                                $point=0;
                            @endphp
                            <div class="w-full text-[16px]">
                                <p class="mt-3 text-[16px]">\( <?=$detail['enter']?>≈P(<?=$point?>)=<?=$detail['series']?> \)</p>
                                @if(is_numeric($find))
                                    <p class="mt-3 text-[16px]"><strong>\(f(<?=$point?>)=<?=$detail['efun']?>≈<?=$detail['efv']?>\)</strong></p>
                                    <p class="mt-3 text-[16px]"><strong>\(P(<?=$point?>)=<?=$detail['eser']?>≈<?=$detail['fsv']?>\)</strong></p>
                                    <p class="mt-3 text-[16px]"><strong>\(E=<?=$detail['efun']?>-(<?=$detail['eser']?>)≈<?=abs($detail['err'])?>\)</strong></p>
                                @endif
                                <p class="mt-3"><strong>{{$lang['6']}}</strong></p>
                                <p class="mt-3"><?=$lang['7']?> \(<?=$detail['enter']?> \) <?=$lang['8']?> \(a = <?=$point?>\) <?=$lang['9']?> \(n = <?=$n?>\) <?=((is_numeric($find))?$lang['10'].' \(y = '.$find.'\)':'')?></p>
                                <p class="mt-3"><?=$lang['11']?> \(f (<?=$with?>) = \sum\limits_{k=0}^{\infty} \frac{f^{(k)}(a)}{k!}(<?=$with?> - a)^{k}\)</p>
                                <p class="mt-3"><?=$lang['12']?>, \(f (<?=$with?>) ≈ P(<?=$with?>) = \sum\limits_{k=0}^{\infty} \frac{f^{(k)}(a)}{k!}(<?=$with?> - a)^{k} = \sum\limits_{k=0}^{<?=$n?>} \frac{f^{(k)}(a)}{k!}(<?=$with?> - a)^{k}\)</p>
                                <p class="mt-3"><?=$lang['13']?></p>
                                <p class="mt-3">\( f^{(0)}(<?=$with?>) = f(<?=$with?>)= <?=$detail['enter']?> \)</p>
                                <p class="mt-3"><?=$lang['14']?>: \( f(<?=$point?>) = <?=$detail['eexe']?> \)</p>
                                <?php 
                                    $result=explode('@HA@', $detail['res']);
                                    $i=0;
                                    $der="'";
                                    if ($point==0) {
                                        $series='f('.$with.') ≈ \frac{'.$detail['eexe'].'}{0!}'.$with.'^{0}';
                                    }else{
                                        $series='f('.$with.') ≈ \frac{'.$detail['eexe'].'}{0!}('.$with.'- ('.$point.'))^{0}';
                                    }
                                    foreach ($result as $key => $value) {
                                        $get=explode('@@@', $value);
                                        if ($point==0) {
                                            $series.=' + \frac{'.$get[1].'}{'.($i+1).'!}'.$with.'^{'.($i+1).'}';
                                        }else{
                                            $series.=' + \frac{'.$get[1].'}{'.($i+1).'!}('.$with.'- ('.$point.'))^{'.($i+1).'}';
                                        }
                                        if($i==0){
                                        ?>
                                        <p class="mt-3"><?=$i+1?>. <?=$lang['15']?> <?=$i+1?> <?=$lang['16']?> : <strong>\( f^{(<?=$i+1?>)}(<?=$with?>) =  \left(f^{(<?=$i?>)}(<?=$with?>)\right)^{'}= \left(<?=$detail['enter']?>\right)^{'} = <?=$get[0]?> \)</strong></p>
                                        <p class="mt-3"><?=$lang['17']?> <?=$i+1?> <?=$lang['18']?>: \(\left(f(<?=$point?>)\right)^{'} = <?=$get[1]?>\)</p>
                                    <?php }else{ ?>
                                        <p class="mt-3"><?=$i+1?>. <?=$lang['15']?> <?=$i+1?> <?=$lang['16']?> : <strong>\( f^{(<?=$i+1?>)}(<?=$with?>) =  \left(f^{(<?=$i?>)}(<?=$with?>)\right)^{'}= \left(<?=$per?>\right)^{'} = <?=$get[0]?> \)</strong></p>
                                        <p class="mt-3"><?=$lang['17']?> <?=$i+1?> <?=$lang['18']?>: \(\left(f(<?=$point?>)\right)^{<?=$der?>} = <?=$get[1]?>\)</p>
                                <?php }$per=$get[0];$i++;$der.="'"; } ?>
                                <p class="mt-3"><?=$lang['19']?>: \( <?=$series?>\)</p>
                                <p class="mt-3"><?=$lang['20']?>:  \(f(<?=$with?>)≈P(<?=$with?>)=<?=$detail['series']?>\)</p>
                                <?php if(is_numeric($find)){ ?>
                                    <p class="mt-3"><?=$lang['21']?>: \(f(<?=$find?>)=<?=$detail['efun']?>\)</p>
                                    <p class="mt-3"><?=$lang['22']?>: \(P(<?=$find?>)=<?=$detail['eser']?>\)</p>
                                    <p class="mt-3"><?=$lang['23']?>: \(E|f(<?=$find?>) - P(<?=$find?>)|=<?=$detail['efun']?>-(<?=$detail['eser']?>)\)</p>
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