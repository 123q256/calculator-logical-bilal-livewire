<div x-data="{
    EnterEq: @entangle('EnterEq').live,
    with: @entangle('with').live,
    lb: @entangle('lb').live,
    ub: @entangle('ub').live,
    n: @entangle('n').live
}" x-init="$watch('EnterEq', value => {
    if (typeof EquPreview === 'function') {
        EquPreview(value, 0);
    }
})">
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-9">
                <label for="EnterEq" class="label">{{$lang['1']}}:</label>
                <div class="w-100 py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" x-model="EnterEq" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" alt="keyboard" loading="lazy" decoding="async">
                </div>
            </div>
            <div class="col-span-3">
                <label for="with" class="label">W.R.T:</label>
                <div class="w-100 py-2">
                    <select name="with" class="input" id="with" x-model="with" aria-label="select">
                        <option value="a">a</option>
                        <option value="b">b</option>
                        <option value="c">c</option>
                        <option value="n">n</option>
                        <option value="x">x</option>
                        <option value="y">y</option>
                        <option value="z">z</option>
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
                <div class="w-100 py-2">
                    <input type="number" name="lb" id="lb" class="input" x-model="lb" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="ub" class="label">{{$lang['3']}}:</label>
                <div class="w-100 py-2">
                    <input type="number" name="ub" id="ub" class="input" x-model="ub" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="n" class="label">{{$lang['4']}}:</label>
                <div class="w-100 py-2">
                    <input type="number" name="n" id="n" class="input" x-model="n" aria-label="input"/>
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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="col-12 text-[16px]">
                            <p class="mt-3 text-[18px]">\( \int\limits_{<?=$detail['lb']?>}^{<?=$detail['ub']?>} <?=$detail['enter']?>\, d<?=$detail['with']?> = <?=$detail['res']?> \)</p>
                            <p class="mt-3"><strong>{{$lang['6']}}</strong></p>
                            <p class="mt-3"><?=$lang['7']?> \( \int\limits_{<?=$detail['lb']?>}^{<?=$detail['ub']?>} <?=$detail['enter']?>\, d<?=$detail['with']?> \) <?=$lang['8']?> \(n=<?=$detail['n']?>\) <?=$lang['8']?>.</p>
                            <p class="col s12 font_size18">\(\int\limits_{a}^{b} f(<?=$detail['with']?>)\, d<?=$detail['with']?> ≈ \dfrac{\Delta <?=$detail['with']?>}{3}(f(<?=$detail['with']?>_0) + 4f(<?=$detail['with']?>_1) + 2f(<?=$detail['with']?>_2) + 4f(<?=$detail['with']?>_3) + ... + 2f(<?=$detail['with']?>_{n-2}) + 4f(<?=$detail['with']?>_{n-1}) + f(x_n))\)</p>
                            <p class="mt-3"><?=$lang['9']?> \(\Delta <?=$detail['with']?> = \dfrac{b-a}{n}\)</p>
                            <p class="mt-3"><?=$lang['10']?> \(a = <?=$detail['lb']?>,b = <?=$detail['ub']?>,n = <?=$detail['n']?>\)</p>
                            <p class="mt-3"><?=$lang['11']?>, \(\Delta <?=$detail['with']?> = \dfrac{<?=$detail['ub']?>-<?=$detail['lb']?>}{<?=$detail['n']?>} = <?=$detail['diff']?>\)</p>
                            <p class="mt-3"><?=$lang['12']?> \([<?=$detail['lb']?>,<?=$detail['ub']?>]\) <?=$lang['13']?> \(n=<?=$detail['n']?>\) <?=$lang['14']?> \(Δ<?=$detail['with']?>=<?=$detail['diff']?>\) <?=$lang['15']?>:</p>
                            
                            <p class="mt-3">\(a=
                                <?php 
                                    $j=0;
                                    $len=count($detail['steps'])-1;
                                    while ($j<$len) {
                                        if ($detail['limit_a'][$j]!=$detail['limit_a'][$len-1]) {
                                            echo $detail['limit_a'][$j].', ';
                                        }else{
                                            echo $detail['limit_a'][$j];
                                        }
                                        $j++;
                                    }
                                    ?>
                            =b\)</p>
                            <p class="mt-3"><?=$lang['16']?>:</p>
                            <?php $i=0;$show='';$ev=0; foreach ($detail['steps'] as $key => $value) {
                                if(!empty($value)){
                                    if ((count($detail['steps'])-2)==$i) {
                                        $show .= "$value";
                                    }else{
                                        $show .= "$value + ";
                                    }
                                ?>
                                <?php if($i==0 || (count($detail['steps'])-2)==$i){ ?>
                                    <p class="mt-3">\(f(<?=$detail['with']?>_{<?=$i?>}) = f(<?=$detail['limit_a'][$i]?>) = <?=str_replace($detail['with'], $detail['limit_a'][$i], $detail['enter'])?> = <?=$value?>\)</p>
                                <?php }else{ ?>
                                    <?php if($ev==0){ $ev=1;?>
                                        <p class="mt-3">\(4f(<?=$detail['with']?>_{<?=$i?>}) = 4f(<?=$detail['limit_a'][$i]?>) = 4<?=str_replace($detail['with'], $detail['limit_a'][$i], $detail['enter'])?> = <?=$value?>\)</p>
                                    <?php }else{ $ev=0; ?>
                                        <p class="mt-3">\(2f(<?=$detail['with']?>_{<?=$i?>}) = 2f(<?=$detail['limit_a'][$i]?>) = 2<?=str_replace($detail['with'], $detail['limit_a'][$i], $detail['enter'])?> = <?=$value?>\)</p>
                                    <?php } ?>
                                <?php } ?>
                            <?php $i++;}} ?>
                            <p class="mt-3"><?=$lang['17']?> \(\dfrac{Δ<?=$detail['with']?>}{3} = <?=$detail['diff']/2?>\)</p>
                            <p class="mt-3">\( <?=$detail['diff']/2?>(<?=$show?>) = <?=$detail['res']?>\)</p>
                            <p class="mt-3">The true solution for the integral is:</p>
                            <p class="mt-3">\(<?=$detail['int']?>=<?=$detail['intv']?>\)</p>
                            <p class="mt-3">Hence, the error in approximating the integral is:</p>
                            <p class="mt-3">\({\left| \varepsilon \right| = \left| {\frac{{<?=round($detail['intv'],2)?> – <?=round($detail['res'],2)?>}}{{<?=round($detail['intv'],2)?>}}} \right| }\approx{ <?=round($detail['errorans'],5)?> }={ <?=round($detail['errorans'],5)*100?>\%} \)</p>
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
                var enterEq = document.getElementById('EnterEq');
                enterEq.value = '';
                enterEq.dispatchEvent(new Event('input'));
            }
        }
        document.querySelectorAll('.keyBtn').forEach(function(button) {
            button.addEventListener('click', function() {
                var val = this.value;
                var enterEq = document.getElementById('EnterEq');
                enterEq.value += val;
                enterEq.dispatchEvent(new Event('input'));
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

        document.addEventListener('livewire:init', () => {
            Livewire.on('math-updated', () => {
                setTimeout(() => {
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(document.body);
                    }
                }, 100);
            });
        });
    </script>
    @endpush
</form>
</div>
