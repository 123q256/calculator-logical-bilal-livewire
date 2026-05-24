<div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto " x-data="{ cal: @entangle('cal') }">
            <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <label for="cal" class="font-s-14 text-blue"><?= $lang['1'] ?></label>
                <div class="w-100 py-2">
                    <select wire:model.live="cal" class="input" id="cal" aria-label="select">
                        <option value="y">{{$lang[2].": y=f(x)"}}</option>
                        <option value="x">{{$lang[2].": x=f(y)"}}</option>
                        <option value="xy">{{$lang[3].": x=x(t), y=y(t)"}}</option>
                        <option value="r">{{$lang[4].": r=r(t)"}}</option>
                        <option value="xyz">{{$lang[5].": x=x(t), y=y(t), z=z(t)"}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12" id="f">
                <label for="func" class="font-s-14 text-blue">
                    <?=$lang[6]?> 
                    <span class="text-blue" id="ch" x-text="cal === 'x' ? 'f(y):' : (cal === 'r' ? 'r(t):' : (cal === 'xy' || cal === 'xyz' ? 'x(t):' : 'f(x):'))"></span>
                </label>
                <div class="w-100 py-2">
                    <input type="text" wire:model.live="func" id="func" class="input f" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12" id="f1" x-show="cal === 'xy' || cal === 'xyz'" style="display: none;">
                <label for="func1" class="font-s-14 text-blue">y(t):</label>
                <div class="w-100 py-2">
                    <input type="text" wire:model.live="func1" id="func1" class="input f1" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12" id="f2" x-show="cal === 'xyz'" style="display: none;">
                <label for="func2" class="font-s-14 text-blue">z(t):</label>
                <div class="w-100 py-2">
                    <input type="text" wire:model.live="func2" id="func2" class="input f2" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="upper" class="font-s-14 text-blue"><?=$lang[7]?>:</label>
                <div class="w-100 py-2">
                    <input type="text" wire:model.live="upper" id="upper" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-6">
                <label for="lower" class="font-s-14 text-blue"><?=$lang[8]?>:</label>
                <div class="w-100 py-2">
                    <input type="text" wire:model.live="lower" id="lower" class="input" aria-label="input" />
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
                            <div class="w-full text-[16px] overflow-auto">
                                <?php if($cal==='y'){ ?>
                                    <p class="mt-3 font-s-18">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['diff']?>\right)^2+1}d x  \)</p>
                                <?php }elseif($cal==='x'){ ?>
                                    <p class="mt-3 font-s-18">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['diff']?>\right)^2+1}d y \)</p>
                                <?php }elseif($cal==='xy'){ ?>
                                    <p class="mt-3 font-s-18">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['diff']?>\right)^2+\left(<?=$detail['diff1']?>\right)^2}dt \)</p>
                                <?php }elseif($cal==='r'){ ?>
                                    <p class="mt-3 font-s-18">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['enter']?>\right)^2+\left(<?=$detail['diff']?>\right)^2}dt \)</p>
                                <?php }elseif($cal==='xyz'){ ?>
                                    <p class="mt-3 font-s-18">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['diff']?>\right)^2+\left(<?=$detail['diff1']?>\right)^2+\left(<?=$detail['diff2']?>\right)^2}dt \)</p>
                                <?php } ?>
                                <p class="mt-3"> <strong><?=$lang[10]?>:</strong></p>
                                <p class="mt-3"><?=$lang[9]?></p>
                                <?php if($cal==='y'){ ?>
                                    <p class="mt-3">\( f(x) = <?=$detail['enter']?> \ on \ [<?=$detail['lower']?>,<?=$detail['upper']?>] \)</p>
                                  <?php }elseif($cal==='x'){ ?>
                                    <p class="mt-3">\( f(y) = <?=$detail['enter']?> \ on \ [<?=$detail['lower']?>,<?=$detail['upper']?>] \)</p>
                                  <?php }elseif($cal==='xy'){ ?>
                                    <p class="mt-3">\( x(t) = <?=$detail['enter']?> \ on \ [<?=$detail['lower']?>,<?=$detail['upper']?>] \)</p>
                                    <p class="mt-3">\( y(t) = <?=$detail['enter1']?> \ on \ [<?=$detail['lower']?>,<?=$detail['upper']?>] \)</p>
                                  <?php }elseif($cal==='r'){ ?>
                                    <p class="mt-3">\( r(t) = <?=$detail['enter']?> \ on \ [<?=$detail['lower']?>,<?=$detail['upper']?>] \)</p>
                                  <?php }elseif($cal==='xyz'){ ?>
                                    <p class="mt-3">\( x(t) = <?=$detail['enter']?> \ on \ [<?=$detail['lower']?>,<?=$detail['upper']?>] \)</p>
                                    <p class="mt-3">\( y(t) = <?=$detail['enter1']?> \ on \ [<?=$detail['lower']?>,<?=$detail['upper']?>] \)</p>
                                    <p class="mt-3">\( z(t) = <?=$detail['enter2']?> \ on \ [<?=$detail['lower']?>,<?=$detail['upper']?>] \)</p>
                                  <?php } ?>
                                <?php if($cal==='y'){ ?>
                                    <p class="mt-3"><?=$lang[11]?>:</p>
                                    <p class="mt-3">\( L = \int_a^b \sqrt{\left(f'\left(x\right)\right)^2+1}d x  \)</p>
                                    <p class="mt-3"><?=$lang[12]?>: (<?=$lang[13]?> <a href="https://calculator-online.net/derivative-calculator/" class="text-blue" target="_blank">Derivative Calculator</a>)</p>
                                    <p class="mt-3">\( f \left(x\right)=(<?=$detail['enter']?>) = <?=$detail['diff']?> \)</p>
                                    <p class="mt-3"><?=$lang[14]?>:</p>
                                    <p class="mt-3">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['diff']?>\right)^2+1}d x  \)</p>
                                    <p class="mt-3"><?=$lang[15]?> (<?=$lang[13]?> <a href="https://calculator-online.net/integral-calculator/" class="text-blue" target="_blank">Integral Calculator</a>)</p>
                                  <?php }elseif($cal==='x'){ ?>
                                    <p class="mt-3"><?=$lang[11]?>:</p>
                                    <p class="mt-3">\( L = \int_a^b \sqrt{\left(f'\left(x\right)\right)^2+1}d y  \)</p>
                                    <p class="mt-3"><?=$lang[12]?>: (<?=$lang[13]?> <a href="https://calculator-online.net/derivative-calculator/" class="text-blue" target="_blank">Derivative Calculator</a>)</p>
                                    <p class="mt-3">\( f \left(x\right)=(<?=$detail['enter']?>)=<?=$detail['diff']?> \)</p>
                                    <p class="mt-3"><?=$lang[14]?>:</p>
                                    <p class="mt-3">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['diff']?>\right)^2+1}d y  \)</p>
                                    <p class="mt-3"><?=$lang[15]?> (<?=$lang[13]?> <a href="https://calculator-online.net/integral-calculator/" class="text-blue" target="_blank">Integral Calculator</a>)</p>
                                  <?php }elseif($cal==='xy'){ ?>
                                    <p class="mt-3"><?=$lang[11]?>:</p>
                                    <p class="mt-3">\( L = \int_a^b \sqrt{\left(x'\left(t\right)\right)^2+ \left(y'\left(t\right)\right)^2}dt  \)</p>
                                    <p class="mt-3"><?=$lang[12]?>: (<?=$lang[13]?> <a href="https://calculator-online.net/derivative-calculator/" class="text-blue" target="_blank">Derivative Calculator</a>)</p>
                                    <p class="mt-3">\( x \left(t\right)=(<?=$detail['enter']?>)=<?=$detail['diff']?> \)</p>
                                    <p class="mt-3">\( y \left(t\right)=(<?=$detail['enter1']?>)=<?=$detail['diff1']?> \)</p>
                                    <p class="mt-3"><?=$lang[14]?>:</p>
                                    <p class="mt-3">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['diff']?>\right)^2+\left(<?=$detail['diff1']?>\right)^2}dt  \)</p>
                                    <p class="mt-3"><?=$lang[15]?> (<?=$lang[13]?> <a href="https://calculator-online.net/integral-calculator/" class="text-blue" target="_blank">Integral Calculator</a>)</p>
                                  <?php }elseif($cal==='r'){ ?>
                                    <p class="mt-3"><?=$lang[11]?>:</p>
                                    <p class="mt-3">\( L = \int_a^b \sqrt{\left(r\left(t\right)\right)^2+ \left(r'\left(t\right)\right)^2}dt  \)</p>
                                    <p class="mt-3"><?=$lang[12]?>: (<?=$lang[13]?> <a href="https://calculator-online.net/derivative-calculator/" class="text-blue" target="_blank">Derivative Calculator</a>)</p>
                                    <p class="mt-3">\( r \left(t\right)=(<?=$detail['enter']?>)=<?=$detail['diff']?> \)</p>
                                    <p class="mt-3"><?=$lang[14]?>:</p>
                                    <p class="mt-3">\( L = \int_{<?=$detail['lower']?>}^{<?=$detail['upper']?>} \sqrt{\left(<?=$detail['enter']?>\right)^2+\left(<?=$detail['diff']?>\right)^2}dt  \)</p>
                                    <p class="mt-3"><?=$lang[15]?> (<?=$lang[13]?> <a href="https://calculator-online.net/integral-calculator/" class="text-blue" target="_blank">Integral Calculator</a>)</p>
                                  <?php }elseif($cal==='xyz'){ ?>
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
    @endpush
</form>
</div>
