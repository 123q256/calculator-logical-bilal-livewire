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
            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
              <div class="col-span-9">
                <label for="EnterEq" class="label">{{$lang['1'] ?? 'Enter Equation'}}:</label>
                <div class="w-full py-2 relative">
                    <input type="text" name="EnterEq" id="EnterEq" class="input" x-model="EnterEq" aria-label="input"/>
                    <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" alt="keyboard" loading="lazy" decoding="async" @click="showKeyboard = !showKeyboard">
                </div>
            </div>
            <div class="col-span-3">
                <label for="with" class="label">W.R.T:</label>
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
                <label for="lb" class="label">{{$lang['2'] ?? 'Lower Limit'}} If you want −∞, enter -inf:</label>
                <div class="w-full py-2">
                    <input type="text" name="lb" id="lb" class="input" x-model="lb" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="ub" class="label">{{$lang['3'] ?? 'Upper Limit'}} If you want −∞, enter -inf:</label>
                <div class="w-full py-2">
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
                                <p class="mt-3 text-[18px]">\( <?=$detail['res1']?>=<?=$detail['ans']?> \)</p>
                                @if(!is_numeric($detail['ans']))
                                    <p class="mt-3">{{$lang['5']}}.</p>
                                @endif
                                <p class="mt-3"><strong>{{$lang['6']}}</strong></p>
                                <p class="mt-3"><?=$lang['7']?>: \(<?=$detail['res1']?>\)</p>
                                <p class="mt-3"><?=$lang['8']?>:</p>
                                <p class="mt-3">\(<?=$detail['int']?> = <?=$detail['res']?>\) (<?=$lang['9']?> <a href="https://calculator-online.net/integral-calculator/" class="text-blue" target="_blank"><?=$lang['10']?></a>):</p>
                                @if($lb=='inf' || $lb=='-inf' || $ub=='inf' || $ub=='-inf')
                                    <p class="mt-3"><?=$lang['11']?>.</p>
                                @else
                                    <p class="mt-3"><?=$lang['12']?>.</p>
                                @endif
                                
                                @if($lb=='inf' || $lb=='-inf')
                                    @php $lim=str_replace('inf', 'infty', $lb); @endphp
                                    <p class="mt-3">\(\lim_{x \to \<?=$lim?>}\left(<?=$detail['res']?>\right)=<?=$detail['first']?>\)</p>
                                @else
                                    <p class="mt-3">\(\left(<?=$detail['res']?>\right)|_{<?=$with.'='.$lb?>}=<?=$detail['first']?>\)</p>
                                @endif
                                
                                @if($ub=='inf' || $ub=='-inf')
                                    @php $lim=str_replace('inf', 'infty', $ub); @endphp
                                    <p class="mt-3">\(\lim_{x \to \<?=$lim?>}\left(<?=$detail['res']?>\right)=<?=$detail['sec']?>\)</p>
                                @else
                                    <p class="mt-3">\(\left(<?=$detail['res']?>\right)|_{<?=$with.'='.$ub?>}=<?=$detail['sec']?>\)</p>
                                @endif
                                
                                <p class="mt-3">
                                    \(<?=$detail['res1']?> = \left(<?php 
                                        if($lb=='inf' || $lb=='-inf'){
                                            $lim=str_replace('inf', 'infty', $lb); ?>
                                            \lim_{x \to \<?=$lim?>}\left(<?=$detail['res']?>\right)
                                        <?php }else{ ?>
                                            \left(<?=$detail['res']?>\right)|_{<?=$with.'='.$lb?>}
                                        <?php } ?> \right) - \left( <?php 
                                        if($ub=='inf' || $ub=='-inf'){
                                            $lim=str_replace('inf', 'infty', $ub); ?>
                                            \lim_{x \to \<?=$lim?>}\left(<?=$detail['res']?>\right)
                                        <?php }else{ ?>
                                            \left(<?=$detail['res']?>\right)|_{<?=$with.'='.$ub?>}
                                        <?php } ?> \right) = <?=$detail['ans']?>\)
                                </p>
                                <p class="mt-3"><?=$lang['4']?>: \(<?=$detail['res1']?>=<?=$detail['ans']?>\)</p>
                                @if(!is_numeric($detail['ans']))
                                    <p class="mt-3"><?=$lang['13']?>.</p>
                                @endif
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
