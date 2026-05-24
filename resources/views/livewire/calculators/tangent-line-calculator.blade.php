<div>
<form wire:submit.prevent="calculate"
    x-data="{
        cal: $wire.entangle('cal'),
        func: $wire.entangle('func'),
        func1: $wire.entangle('func1'),
        point: $wire.entangle('point'),
        onCalChange() {
            if (this.cal === 'y') {
                this.func = '3*x^2';
            } else if (this.cal === 'x') {
                this.func = 'y+2^2';
            } else if (this.cal === 'xy') {
                this.func = '3*t^2';
            } else if (this.cal === 'r') {
                this.func = '3*t^2';
            }
        }
    }"
>
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="cal" class="font-s-14 text-blue"><?= $lang['1'] ?></label>
                    <div class="w-100 py-2">
                        <select wire:model.live="cal" x-model="cal" @change="onCalChange()" name="cal" class="input" id="cal" aria-label="select">
                            <option value="y">{{$lang[2].": y=f(x)"}}</option>
                            <option value="x">{{$lang[2].": x=f(y)"}}</option>
                            <option value="xy">{{$lang[3].": x=x(t), y=y(t)"}}</option>
                            <option value="r">{{$lang[4].": r=r(t)"}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12" id="f">
                    <label for="func" class="font-s-14 text-blue">
                        <?=$lang[5]?> 
                        <span class="text-blue" id="ch" x-text="cal === 'x' ? 'f(y):' : (cal === 'r' ? 'r(t):' : (cal === 'xy' ? 'x(t):' : 'f(x):'))">
                        </span>
                    </label>
                    <div class="w-100 py-2">
                        <input type="text" wire:model.live="func" x-model="func" name="func" id="func" class="input f" aria-label="input" />
                    </div>
                    
                </div>
                <div class="col-span-12" x-show="cal === 'xy'" style="display:none;" id="f1">
                    <label for="func1" class="font-s-14 text-blue">y(t):</label>
                    <div class="w-100 py-2">
                        <input type="text" wire:model.live="func1" x-model="func1" name="func1" id="func1" class="input" aria-label="input"/>
                    </div>
                </div>
                <div class="col-span-12" id="p">
                    <label for="point" class="font-s-14 text-blue">
                        <?=$lang[6]?> 
                        <span class="text-blue" id="ch2" x-text="cal === 'x' ? '(y₀):' : ((cal === 'r' || cal === 'xy') ? '(t):' : '(x₀):')">
                        </span>
                    </label>
                    <div class="w-100 py-2">
                        <input type="text" wire:model.live="point" x-model="point" name="point" id="point" class="input" aria-label="input"/>
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
                <div class="w-full  mt-3">
                    @php
                        $cal = $this->cal;
                        $func = $this->func;
                        $func1 = $this->func1;
                        $point = $this->point;
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
                                <p class="my-3"><?=$lang['12']?> (for step by step, check <a href="{{ url('derivative-calculator') }}/" class="text-blue-500 underline" target="_blank">Derivative Calculator</a>)</p>
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
                                <p class="my-3"><?=$lang['12']?> (for step by step, check <a href="{{ url('derivative-calculator') }}/" class="text-blue-500 underline" target="_blank">Derivative Calculator</a>)</p>
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
                                <p class="my-3"><?=$lang['12']?> w.r.t x (for step by step, check <a href="{{ url('derivative-calculator') }}/" class="text-blue-500 underline" target="_blank">Derivative Calculator</a>)</p>
                                <div class="w-full res_step"><?=$detail['steps']?></div>
                                <p class="mt-3"><?=$lang['12']?> w.r.t y (for step by step, check <a href="{{ url('derivative-calculator') }}/" class="text-blue-500 underline" target="_blank">Derivative Calculator</a>)</p>
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
                                <p class="mt-3"><?=$lang['12']?> (for step by step, check <a href="{{ url('derivative-calculator') }}/" class="text-blue-500 underline" target="_blank">Derivative Calculator</a>)</p>
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.on('math-updated', (event) => {
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
                    }, 100);
                });

                // Initial render
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            });
        </script>
    @endpush
</form>

</div>
