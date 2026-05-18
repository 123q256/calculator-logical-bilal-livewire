<div x-data="{
    EnterEq: @entangle('EnterEq').live,
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
            <div class="col-span-12">
                <label for="EnterEq" class="label">{{$lang['1'] ?? 'Enter f(x,y)'}} f(x,y):</label>
                <div class="w-100 py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" x-model="EnterEq" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" alt="keyboard" loading="lazy" decoding="async" @click="showKeyboard = !showKeyboard">
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
                                <p class="mt-3 font-s-18"><strong>{{$lang['3']}}</strong></p>
                                <p class="mt-3">\( <?=$detail['root']?> \)</p>
                                <p class="mt-3"><strong><?=$lang['5']?></strong></p>
                                <p class="mt-3">\( \frac{\partial^{2}}{\partial {(x,y)}^{2}} \left(<?=$detail['enter']?>\right) = 0  \)</p>
                                <p class="my-3">1st <?=$lang['4']?>: \( \frac{\partial}{\partial x}\left(<?=$detail['enter']?>\right) \)</p>
                                <div class="w-full res_step">
                                    <?=$detail['buffer']?>
                                </div>
                                <p class="my-3">2nd <?=$lang['4']?>: \( \frac{\partial}{\partial x}\left(<?=$detail['en1']?>\right) \)</p>
                                <div class="w-full res_step">
                                    <?=$detail['step1']?>
                                </div>
                                <p class="my-3">1st <?=$lang['4']?>: \( \frac{\partial}{\partial y}\left(<?=$detail['enter']?>\right) \)</p>
                                <div class="w-full res_step">
                                    <?=$detail['step']?>
                                </div>
                                <p class="my-3">2nd <?=$lang['4']?>: \( \frac{\partial}{\partial y}\left(<?=$detail['en2']?>\right) \)</p>
                                <div class="w-full res_step">
                                    <?=$detail['step2']?>
                                </div>
                                <p class="mt-3"><strong><?=$lang['6']?> f''(x,y) = 0</strong></p>
                                <p class="mt-3">\( <?=$detail['ans']?> = 0\)</p>
                                <p class="mt-3">\( <?=$detail['ans1']?> = 0\)</p>
                                <p class="mt-3"><?=$lang['7']?>: \( <?=$detail['root']?>\)</p>
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
