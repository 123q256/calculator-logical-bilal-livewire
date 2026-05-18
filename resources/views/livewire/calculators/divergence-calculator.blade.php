<div x-data="{
    xeq: @entangle('xeq').live,
    yeq: @entangle('yeq').live,
    zeq: @entangle('zeq').live,
    x: @entangle('x').live,
    y: @entangle('y').live,
    z: @entangle('z').live
}">
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12">
                <p class="font-bold text-lg text-blue">F(x,y,z)</p>
            </div>
            <div class="col-span-4">
                <label for="xeq" class="font-s-14 text-blue">x component:</label>
                <div class="w-100 py-2">
                    <input type="text" name="xeq" id="xeq" class="input" aria-label="input" x-model="xeq" />
                </div>
            </div>
            <div class="col-span-4">
                <label for="yeq" class="font-s-14 text-blue">y component:</label>
                <div class="w-100 py-2">
                    <input type="text" name="yeq" id="yeq" class="input" aria-label="input" x-model="yeq" />
                </div>
            </div>
            <div class="col-span-4">
                <label for="zeq" class="font-s-14 text-blue">z component:</label>
                <div class="w-100 py-2">
                    <input type="text" name="zeq" id="zeq" class="input" aria-label="input" x-model="zeq" />
                </div>
            </div>
            <div class="col-span-12">
                <p class="font-bold text-lg text-blue">(x₀, y₀, z₀) (<?=$lang['1'] ?? 'Optional'?>)</p>
            </div>
            <div class="col-span-4">
                <label for="x" class="font-s-14 text-blue">x₀:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="x" id="x" class="input" aria-label="input" x-model="x" />
                </div>
            </div>
            <div class="col-span-4">
                <label for="y" class="font-s-14 text-blue">y₀:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="y" id="y" class="input" aria-label="input" x-model="y" />
                </div>
            </div>
            <div class="col-span-4">
                <label for="z" class="font-s-14 text-blue">z₀:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" name="z" id="z" class="input" aria-label="input" x-model="z" />
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
                    <div class="w-full text-[16px]">
                        <p class="mt-3 text-[18px]"><strong>\( \left(<?=$detail['one']?>+<?=$detail['two']?>+<?=$detail['three']?>\right) \)</strong></p>
                        <?php if(isset($detail['ev1'])){ ?>
                            <p class="mt-3 text-[18px]"><strong>\( \left(<?=$detail['ev1']+$detail['ev2']+$detail['ev3']?>\right) \)</strong></p>
                        <?php } ?>
                        <p class="mt-3"><strong><?=$lang['3']?></strong></p>
                        <p class="mt-3"><?=$lang['4']?>:</p>
                        <p class="mt-3"><?=$lang['calculate']?> \(\operatorname{div}{\left(<?=$detail['enx']?>,<?=$detail['eny']?>,<?=$detail['enz']?>\right)}\) 
                            <?php if(isset($detail['ev1'])){ ?>
                                and evaluate it at \((x_0,y_0,z_0) = \left(<?=$x?>,<?=$y?>,<?=$z?>\right)\)
                            <?php } ?>
                        </p>
                        <p class="mt-3"><?=$lang['5']?>, \(\operatorname{div}{\left(<?=$detail['enx']?>,<?=$detail['eny']?>,<?=$detail['enz']?>\right)} = \nabla\cdot \left(<?=$detail['enx']?>,<?=$detail['eny']?>,<?=$detail['enz']?>\right)\), </p>
                        <p class="mt-3"><?=$lang['6']?>, \(\operatorname{div}{\left(<?=$detail['enx']?>,<?=$detail['eny']?>,<?=$detail['enz']?>\right)} = \left(\frac{\partial}{\partial x}, \frac{\partial}{\partial y}, \frac{\partial}{\partial z}\right)\cdot \left(<?=$detail['enx']?>, <?=$detail['eny']?>, <?=$detail['enz']?>\right).\)</p>
                        <p class="mt-3"><?=$lang['7']?>, \(\operatorname{div}{\left(<?=$detail['enx']?>,<?=$detail['eny']?>,<?=$detail['enz']?>\right)} = \frac{\partial}{\partial x} \left(<?=$detail['enx']?>\right) + \frac{\partial}{\partial y} \left(<?=$detail['eny']?>\right) + \frac{\partial}{\partial z} \left(<?=$detail['enz']?>\right).\)</p>
                        <p class="mt-3"><?=$lang['8']?>:</p>
                        <p class="mt-3">\(\frac{\partial}{\partial x} \left(<?=$detail['enx']?>\right) = <?=$detail['one']?>\) (<?=$lang['9']?> <a href="https://calculator-online.net/partial-derivative-calculator/" class="text-blue" target="_blank"><?=$lang['10']?></a>)</p>
                        <p class="mt-3">\(\frac{\partial}{\partial y} \left(<?=$detail['eny']?>\right) = <?=$detail['two']?>\) (<?=$lang['9']?> <a href="https://calculator-online.net/partial-derivative-calculator/" class="text-blue" target="_blank"><?=$lang['10']?></a>)</p>
                        <p class="mt-3">\(\frac{\partial}{\partial z} \left(<?=$detail['enz']?>\right) = <?=$detail['three']?>\) (<?=$lang['9']?> <a href="https://calculator-online.net/partial-derivative-calculator/" class="text-blue" target="_blank"><?=$lang['10']?></a>)</p>
                        <p class="mt-3"><?=$lang['11']?>:</p>
                        <p class="mt-3">\(\operatorname{div}{\left(<?=$detail['enx']?>,<?=$detail['eny']?>,<?=$detail['enz']?>\right)} = \left(<?=$detail['one']?>+<?=$detail['two']?>+<?=$detail['three']?>\right)\)</p>
                        <?php if(isset($detail['ev1'])){ ?>
                            <p class="col s12 font_size20 margin_top_20"><?=$lang['12']?>:</p>
                            <p class="mt-3">\(\operatorname{div}{\left(<?=$detail['enx']?>,<?=$detail['eny']?>,<?=$detail['enz']?>\right)}|_{(x_0,y_0,z_0) = \left(<?=$x?>,<?=$y?>,<?=$z?>\right)} = \left((<?=$detail['ev1']?>)+(<?=$detail['ev2']?>)+(<?=$detail['ev3']?>)\right)\)</p>
                            <p class="mt-3">\(\operatorname{div}{\left(<?=$detail['enx']?>,<?=$detail['eny']?>,<?=$detail['enz']?>\right)}|_{(x_0,y_0,z_0) = \left(<?=$x?>,<?=$y?>,<?=$z?>\right)} = \left(<?=$detail['ev1']+$detail['ev2']+$detail['ev3']?>\right)\)</p>
                        <?php } ?>
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
