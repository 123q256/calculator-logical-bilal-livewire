<div x-data="{
    EnterEq: @entangle('EnterEq').live,
    with: @entangle('with').live,
    lb: @entangle('lb').live,
    ub: @entangle('ub').live,
    showKeyboard: false,
    clearInput() {
        if (confirm('Are you sure you want to clear Equation?')) {
            this.EnterEq = '';
        }
    }
}" x-init="$watch('EnterEq', value => {
    if (typeof EquPreview === 'function') {
        EquPreview(value, 0);
    }
})">
<style>
    [x-cloak] {
        display: none !important;
    }
</style>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
             <div class="col-span-9">
                <label for="EnterEq" class="label">{{$lang['1'] ?? 'Enter Equation'}}:</label>
                <div class="w-100 py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" x-model="EnterEq" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" alt="keyboard" loading="lazy" decoding="async" @click="showKeyboard = !showKeyboard">
                </div>
            </div>
            <div class="col-span-3">
                <label for="with" class="label">{{$lang['2'] ?? 'W.R.T'}}:</label>
                <div class="w-full py-2">
                    <select name="with" class="input" id="with" aria-label="select" x-model="with">
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
            <div class="col-span-12 keyboard" x-show="showKeyboard" x-cloak>
                <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="clearInput()">CLS</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '+'">+</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '-'">-</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '/'">/</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '*'">*</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '^'">^</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += 'sqrt('">√</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '('">(</button>
                <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm  h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += ')'">)</button>
            </div>
            <div class="col-span-12">
                <label for="lb" class="label">{{$lang['3'] ?? 'Lower Limit'}} (If you want −π, enter -pi):</label>
                <div class="w-100 py-2">
                    <input type="text" name="lb" id="lb" class="input" x-model="lb" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="ub" class="label">{{$lang['4'] ?? 'Upper Limit'}} (If you want −π, enter -pi):</label>
                <div class="w-100 py-2">
                    <input type="text" name="ub" id="ub" class="input" x-model="ub" aria-label="input"/>
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
                        <div class="w-full text-[16px]">
                            <p class="mt-3 text-[18px]"><strong>{{$lang['5']}}</strong></p>
                            <p class="mt-3">\( <?=$detail['res']?> \)</p>
                            <p class="mt-3"><strong>{{$lang['7']}}</strong></p>
                            <p class="mt-3"><?=$lang['8']?> \(<?=$detail['enter']?>\) on the interval \(\left[<?=$detail['t1']?>,<?=$detail['t2']?>\right]\)</p>
                            <p class="mt-3">\(\mathrm{Fourier\:series\:of\:function}\:f\left(<?=$with?>\right)\:\mathrm{on\:interval}\:-L\le \:<?=$with?>\le \:L\:\mathrm{is\:defined\:as:}\)</p>
                            <p class="mt-3">\(f\left(<?=$with?>\right)=A_0+\sum _{n=1}^{\infty \:}A_n\cdot \cos \left(\frac{n\pi <?=$with?>}{L}\right)+\sum _{n=1}^{\infty \:}B_n\cdot \sin \left(\frac{n\pi <?=$with?>}{L}\right)\)</p>
                            <p class="mt-3"><?=$lang['9']?>:</p>
                            <p class="mt-3">\(A_0=\frac{1}{2L}\cdot \int _{-L}^Lf\left(<?=$with?>\right)d<?=$with?>\)</p>
                            <p class="mt-3">\(A_n=\frac{1}{L}\cdot \int _{-L}^Lf\left(<?=$with?>\right)\cos \left(\frac{n\pi <?=$with?>}{L}\right)d<?=$with?>,\:\quad \:n>0\)</p>
                            <p class="mt-3">\(B_n=\frac{1}{L}\cdot \int _{-L}^Lf\left(<?=$with?>\right)\sin \left(\frac{n\pi <?=$with?>}{L}\right)d<?=$with?>,\:\quad \:n>0\)</p>
                            
                            <p class="mt-3"><?=$lang['10']?> \(A_0,A_n \text{ and } B_n\):</p>
                            <p class="mt-3">\(A_0=\frac{1}{2\times <?=$detail['t']?>}\cdot \int _{<?=$detail['t1']?>}^<?=$detail['t2']?>\left(<?=$detail['enter']?>\right)d<?=$with?> = <?=$detail['a0']?>\)</p>
                            <p class="mt-3">\(A_n=\frac{1}{<?=$detail['t2']?>}\cdot \int _{<?=$detail['t1']?>}^<?=$detail['t2']?>\left(<?=$detail['enter']?>\right)\cos \left(\frac{n\pi <?=$with?>}{<?=$detail['t2']?>}\right)d<?=$with?> = <?=$detail['an']?>\)</p>
                            <p class="mt-3">\(B_n=\frac{1}{<?=$detail['t2']?>}\cdot \int _{<?=$detail['t1']?>}^<?=$detail['t2']?>\left(<?=$detail['enter']?>\right)\sin \left(\frac{n\pi <?=$with?>}{<?=$detail['t2']?>}\right)d<?=$with?> = <?=$detail['bn']?>\)</p>
                            <p class="mt-3">Put \(A_0,A_n \text{ and } B_n\) values in Fourier Series Formula:</p>
                            <p class="mt-3">\(f\left(<?=$with?>\right)=<?=$detail['a0']?> +\sum _{n=1}^{\infty \:}<?=$detail['an']?>\cdot \cos \left(\frac{n\pi <?=$with?>}{L}\right)+\sum _{n=1}^{\infty \:}<?=$detail['bn']?>\cdot \sin \left(\frac{n\pi <?=$with?>}{L}\right)\)</p>
                            <p class="mt-3"><?=$lang['11']?>:</p>
                            <p class="mt-3">\(<?=$detail['res']?>\)</p>
                        </div>
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
