<div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[75%] md:w-[75%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="to" class="font-s-14 text-blue"><?= $lang['1'] ?? 'Operation Type' ?>:</label>
                    <div class="w-100 py-2">
                        <select name="to" class="input" id="to" aria-label="select" wire:model.live="to">
                            <option value="1"><?=$lang[2] ?? 'Simplify'?></option>
                            <option value="2"><?=$lang[3] ?? 'Arithmetic Operations'?></option>
                            <option value="3"><?=$lang[4] ?? 'Complex Expressions'?></option>
                        </select>
                    </div>
                </div>

                @if ($to == '1')
                <div class="col-span-12 basic">
                    <div class="col-12 mt-0 mt-lg-2">
                        <label for="n1" class="font-s-14 text-blue"><?=$lang['5'] ?? 'Numerator'?>:</label>
                        <div class="w-100 py-2">
                            <input type="text" name="n1" id="n1" class="input" aria-label="input" wire:model.live="n1" />
                        </div>
                    </div>
                    <div class="col-12 mt-0 mt-lg-2">
                        <label for="d1" class="font-s-14 text-blue"><?=$lang['6'] ?? 'Denominator'?>:</label>
                        <div class="w-100 py-2">
                            <input type="text" name="d1" id="d1" class="input" aria-label="input" wire:model.live="d1" />
                        </div>
                    </div>
                </div>
                @endif

                @if ($to == '2')
                <div class="col-span-12 advance">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12 flex items-center justify-center">
                            <p id="twoInput">
                                <input type="radio" name="to_cal" id="two" value="two" wire:model.live="to_cal">
                                <label for="two" class="font-s-14 ms-1 cursor-pointer"><?=$lang['7'] ?? '2 Expressions'?></label>
                            </p>
                            <p class="ms-4" id="threeInput">
                                <input type="radio" name="to_cal" id="three" value="three" wire:model.live="to_cal">
                                <label for="three" class="font-s-14 ms-1 cursor-pointer"><?=$lang['8'] ?? '3 Expressions'?></label>
                            </p>
                        </div>

                        @if ($to_cal == 'two')
                        <div class="col-span-12 far2">
                            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-5">
                                    <input type="text" name="n11" id="n11" class="input mb-2" wire:model.live="n11" placeholder="numerator" aria-label="input"/>
                                    <hr>
                                    <input type="text" name="d11" id="d11" class="input mt-2" wire:model.live="d11" placeholder="denominator" aria-label="input"/>
                                </div>
                                <div class="col-span-2 flex items-center">
                                    <select name="action" class="input text-center" aria-label="select" wire:model.live="action">
                                        <option value="plus"><b>+</b></option>
                                        <option value="-"><b>-</b></option>
                                        <option value="*"><b>×</b></option>
                                        <option value="div"><b>÷</b></option>
                                    </select>
                                </div>
                                <div class="col-span-5">
                                    <input type="text" name="n22" id="n22" class="input mb-2" wire:model.live="n22" placeholder="numerator" aria-label="input"/>
                                    <hr>
                                    <input type="text" name="d22" id="d22" class="input mt-2" wire:model.live="d22" placeholder="denominator" aria-label="input"/>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if ($to_cal == 'three')
                        <div class="col-span-12 far3">
                            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-3">
                                    <input type="text" name="n13" id="n13" class="input mb-2" wire:model.live="n13" placeholder="numerator" aria-label="input"/>
                                    <hr>
                                    <input type="text" name="d13" id="d13" class="input mt-2" wire:model.live="d13" placeholder="denominator" aria-label="input"/>
                                </div>
                                <div class="col-span-2 flex items-center">
                                    <select name="action1" class="input text-center" aria-label="select" wire:model.live="action1">
                                        <option value="plus"><b>+</b></option>
                                        <option value="-"><b>-</b></option>
                                        <option value="*"><b>×</b></option>
                                        <option value="div"><b>÷</b></option>
                                    </select>
                                </div>
                                <div class="col-span-3">
                                    <input type="text" name="n23" id="n23" class="input mb-2" wire:model.live="n23" placeholder="numerator" aria-label="input"/>
                                    <hr>
                                    <input type="text" name="d23" id="d23" class="input mt-2" wire:model.live="d23" placeholder="denominator" aria-label="input"/>
                                </div>
                                <div class="col-span-1 flex items-center">
                                    <select name="action2" class="input text-center" aria-label="select" wire:model.live="action2">
                                        <option value="plus"><b>+</b></option>
                                        <option value="-"><b>-</b></option>
                                        <option value="*"><b>×</b></option>
                                        <option value="div"><b>÷</b></option>
                                    </select>
                                </div>
                                <div class="col-span-3">
                                    <input type="text" name="n33" id="n33" class="input mb-2" wire:model.live="n33" placeholder="numerator" aria-label="input"/>
                                    <hr>
                                    <input type="text" name="d33" id="d33" class="input mt-2" wire:model.live="d33" placeholder="denominator" aria-label="input"/>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                @if ($to == '3')
                <div class="col-span-12 simple">
                    <label for="expr" class="font-s-14 text-blue"><?=$lang['9'] ?? 'Expression'?>:</label>
                    <div class="w-100 py-2">
                        <input type="text" name="expr" id="expr" class="input" aria-label="input" wire:model.live="expr" />
                    </div>
                </div>
                @endif
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
                    <div class="row overflow-auto">
                        @if($to == 1)
                            <div class="col-12 text-[16px]">
                                <p class="mt-2 text-[16px]">\( <?=$detail['ress']?> \)</p>
                                <p class="mt-2"><strong><?=$lang[11] ?? 'Steps'?>:</strong></p>
                                <p class="mt-2">\( =<?=$detail['enter']?> \)</p>
                                <p class="mt-2">\( =\dfrac{<?=$detail['up']?>}{<?=$detail['down']?>} \)</p>
                                <p class="mt-2">\( =<?=$detail['ress']?> \)</p>
                            </div>
                        @elseif($to == 2)
                            @if($to_cal=='two')
                                <?php if(isset($detail['lcm']) && ($detail['action']=='+' || $detail['action']=='-')){ ?>
                                    <div class="col-12 text-[16px]">
                                        <p class="mt-2 font-s-18">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm']?>} \)</p>
                                        <p class="mt-2"><strong><?=$lang[11] ?? 'Steps'?>:</strong></p>
                                        <p class="mt-2">\( <?=$detail['up']?> <?=$detail['action']?> <?=$detail['down']?> \)</p>
                                        <p class="mt-2">\( =\dfrac{\left(<?=$detail['left']?>\right)<?=$detail['action']?>\left(<?=$detail['right']?>\right)}{<?=$detail['lcm']?>} \)</p>
                                        <p class="mt-2">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm']?>} \)</p>
                                        <p class="mt-2">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm']?>} \)</p>
                                    </div>
                                <?php } elseif(isset($detail['lcm']) && ($detail['action']=='*' || $detail['action']=='÷')){ ?>
                                    <div class="col-12 text-center my-2">
                                        <p>
                                            <strong class="bg-white px-3 py-2 font-s-21 rounded-lg text-blue">
                                                \(
                                                    <?=$detail['up']?> <?=$detail['action']?> <?=$detail['down']?> = \dfrac{<?=$detail['top']?>}{<?=$detail['lcm']?>}      
                                                \)
                                            </strong>
                                        </p>
                                    </div>
                                <?php }else{ ?>
                                    <div class="col-12 text-center my-2">
                                        <p>
                                            <strong class="bg-white px-3 py-2 font-s-21 rounded-lg text-blue">
                                                \(
                                                    <?=$detail['up']?> <?=$detail['action']?> <?=$detail['down']?>=<?=$detail['ans']?>
                                                \)
                                            </strong>
                                        </p>
                                    </div>
                                <?php } ?>
                            @else
                                <?php if(isset($detail['lcm']) && ($detail['action']=='+' || $detail['action']=='-') && (($detail['action1'] ?? '')=='+' || ($detail['action1'] ?? '')=='-')){ ?>
                                    <div class="col-12 font-s-16">
                                        <p class="mt-2 font-s-18">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm']?>} \)</p>
                                        <p class="mt-2"><strong><?=$lang[11] ?? 'Steps'?>:</strong></p>
                                        <p class="mt-2">\( <?=$detail['up']?> <?=$detail['action']?> <?=$detail['down']?> <?=($detail['action1'] ?? '')?> <?=$detail['thr']?> \)</p>
                                        <p class="mt-2">\( =\dfrac{\left(<?=$detail['left']?>\right)<?=$detail['action']?>\left(<?=$detail['center']?>\right)<?=($detail['action1'] ?? '')?>\left(<?=$detail['right']?>\right)}{<?=$detail['lcm']?>} \)</p>
                                        <p class="mt-2">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm']?>} \)</p>
                                    </div>
                                <?php } elseif(isset($detail['lcm']) && ($detail['action']=='+' || $detail['action']=='-') && (($detail['action1'] ?? '')=='*' || ($detail['action1'] ?? '')=='÷')){ ?>
                                    <div class="col-12 font-s-16">
                                        <p class="mt-2 font-s-18">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm1']?>} \)</p>
                                        <p class="mt-2"><strong><?=$lang[11] ?? 'Steps'?>:</strong></p>
                                        <p class="mt-2">\( =<?=$detail['up']?> <?=$detail['action']?> <?=$detail['down']?> <?=($detail['action1'] ?? '')?> <?=$detail['thr']?> \)</p>
                                        <p class="mt-2">\( =<?=$detail['up']?> <?=$detail['action']?> \dfrac{<?=$detail['up1']?>}{<?=$detail['down1']?>} \)</p>
                                        <p class="mt-2">\( =\dfrac{\left(<?=$detail['left']?>\right)<?=$detail['action']?>\left(<?=$detail['right']?>\right)}{<?=$detail['lcm1']?>} \)</p>
                                        <p class="mt-2">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm1']?>} \)</p>
                                    </div>
                                <?php } elseif(isset($detail['lcm']) && ($detail['action']=='*' || $detail['action']=='÷') && (($detail['action1'] ?? '')=='+' || ($detail['action1'] ?? '')=='-')){ ?>
                                    <div class="col-12 font-s-16">
                                        <p class="mt-2 font-s-18">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm1']?>} \)</p>
                                        <p class="mt-2"><strong><?=$lang[11] ?? 'Steps'?>:</strong></p>
                                        <p class="mt-2">\( =<?=$detail['up']?> <?=$detail['action']?> <?=$detail['down']?> <?=($detail['action1'] ?? '')?> <?=$detail['thr']?> \)</p>
                                        <p class="mt-2">\( =\dfrac{<?=$detail['up1']?>}{<?=$detail['down1']?>} <?=($detail['action1'] ?? '')?> <?=$detail['thr']?> \)</p>
                                        <p class="mt-2">\( =\dfrac{\left(<?=$detail['left']?>\right)<?=($detail['action1'] ?? '')?>\left(<?=$detail['right']?>\right)}{<?=$detail['lcm1']?>} \)</p>
                                        <p class="mt-2">\( =\dfrac{<?=$detail['top']?>}{<?=$detail['lcm1']?>} \)</p>
                                    </div>
                                <?php }else{ ?>
                                    <div class="col-12 text-center text-[16px]">
                                        <p>\( =<?=$detail['up']?> <?=$detail['action']?> <?=$detail['down']?> <?=($detail['action1'] ?? '')?> <?=$detail['thr']?> \)</p>
                                        <p class="my-3"><strong class="bg-sky px-3 py-2 text-[32px] rounded-lg text-blue">\( =<?=$detail['ans']?> \)</strong></p>
                                    </div>
                                <?php } ?>
                            @endif
                        @else
                            <div class="col-12 text-center text-[16px]">
                                <p class="my-3"><strong class="bg-sky px-3 py-4 text-[32px] rounded-lg text-blue">\( <?=$detail['enter']?>=<?=$detail['ans']?> \)</strong></p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endisset
    @push('calculatorJS')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({
                "HTML-CSS": { linebreaks: { automatic: true }, scale: 100 },
                "CommonHTML": { linebreaks: { automatic: true } },
                tex2jax: { inlineMath: [['$', '$'], ['\\(', '\\)']] }
            });
        </script>
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.hook('request', ({ respond, succeed, fail }) => {
                    succeed(({ status, response }) => {
                        setTimeout(() => {
                            if (window.MathJax && window.MathJax.Hub) {
                                MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                            }
                        }, 100);
                    });
                });
            });
        </script>
    @endpush
</form>
</div>
