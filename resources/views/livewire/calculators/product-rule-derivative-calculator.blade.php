<div x-data="{
    EnterEq: @entangle('EnterEq').live,
    wrt: @entangle('with').live,
    how: @entangle('how').live,
    showKeyboard: false,
    clearInput() {
        if (confirm('Are you sure you want to clear Equation?')) {
            this.EnterEq = '';
        }
    }
}">
<style>
    .res_step ol {
        list-style-type: decimal;
        border-left: 1px solid #FF8080;
        padding: 0 30px;
    }

    .res_step ol ol {
        list-style-type: upper-alpha;
        border-left: 1px solid #92D169;
    }

    .res_step ol ol ol {
        list-style-type: upper-roman;
        border-left: 1px solid #78BEF0;
    }

    .res_step ol ol ol ol {
        list-style-type: lower-alpha;
        border-left: 1px solid #CC66C9;
    }

    .res_step ol ol ol ol ol {
        list-style-type: lower-roman;
        border-left: 1px solid #F2A279;
    }

    [x-cloak] {
        display: none !important;
    }
</style>

<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 mblue">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif

        <div class="lg:w-[50%] md:w-[50%] w-full mx-auto">
            <div class="grid grid-cols-1 mt-3 gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-12">
                    <label for="EnterEq" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Enter Equation' }}:</label>
                    <div class="w-full py-2 relative">
                        <input type="text" name="EnterEq" id="EnterEq" class="input" x-model="EnterEq" aria-label="input"/>
                        <img src="{{ asset('images/keyboard.png') }}" class="keyboardImg absolute right-2 top-1/2 transform -translate-y-1/2 w-9 h-9 cursor-pointer" alt="keyboard" loading="lazy" decoding="async" @click="showKeyboard = !showKeyboard">
                    </div>
                </div>

                <div class="col-span-12 keyboard" x-show="showKeyboard" x-transition x-cloak>
                    <button type="button" class="bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="clearInput()">CLS</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '+'">+</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '-'">-</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '/'">/</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '*'">*</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '^'">^</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += 'sqrt('">√</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += '('">(</button>
                    <button type="button" class="keyBtn bg-blue-700 mt-1 text-white rounded-sm h-9 px-2 md:px-3 lg:px-3 uppercase shadow-md hover:bg-blue-600" @click="EnterEq += ')'">)</button>
                </div>

                <div class="col-span-12">
                    <label for="with" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Differentiate W.R.T' }}:</label>
                    <div class="w-full py-2">
                        <select name="with" class="input" id="with" aria-label="select" x-model="wrt">
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

                <div class="col-span-12">
                    <label for="how" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Order of Derivative' }}:</label>
                    <div class="w-full py-2">
                        <select name="how" class="input" id="how" aria-label="select" x-model="how">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        @if ($type == 'calculator')
            @include('inc.button')
        @endif
        @if ($type == 'widget')
            @include('inc.widget-button')
        @endif
    </div>

    @isset($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div>
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full text-[16px]">
                                @if ($how > 1)
                                    @php $j="'"; @endphp
                                    @for ($i = 1; $i < count($detail['final_res']); $i++)
                                        <div x-data="{ show: false }">
                                            <p class="mt-3 text-[18px]"><strong>\( f{{ $j }} (x)\) {{ $lang['3'] ?? 'Derivative' }}</strong></p>
                                            <p class="mt-3 text-[18px]">\( {{ $detail['final_res'][$i] }} \)</p>
                                            @php
                                                $i++;
                                                $j .= "'";
                                            @endphp
                                            <p class="mt-3 text-[18px]"><strong>{{ $lang['7'] ?? 'Simplified' }}</strong></p>
                                            <p class="mt-3 text-[18px]">\( {{ $detail['final_res'][$i] }} \)</p>
                                            @php $i++; @endphp
                                            <div class="w-full mt-3">
                                                <button type="button" class="calculate repeat"
                                                    style="font-size: 16px;padding: 10px;cursor: pointer;"
                                                    @click="show = !show">{{ $lang['8'] ?? 'Steps' }}</button>
                                            </div>
                                            <div class="w-full mt-3 res_step" x-show="show" x-transition x-cloak>
                                                <p class="mt-3">{!! $detail['final_res'][$i] !!}</p>
                                            </div>
                                        </div>
                                    @endfor
                                @else
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['3'] ?? 'Derivative' }}</strong></p>
                                    <p class="mt-3 text-[18px]">\( {{ $detail['ans'] }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>{{ $lang['7'] ?? 'Simplified' }}</strong></p>
                                    <p class="mt-3 text-[18px]">\( {{ $detail['simple'] }} \)</p>
                                    <p class="mt-3 text-[18px]"><strong>Solution:</strong></p>
                                    <div class="w-full mt-3 res_step">
                                        <p class="mt-3">{!! $detail['buffer'] !!}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

    @push('calculatorJS')
        <script>
            function convertScriptTagsToMathJax() {
                document.querySelectorAll('script[type^="math/tex"]').forEach(script => {
                    const math = script.textContent || script.innerText;
                    const isDisplay = script.getAttribute('type').includes('mode=display') || script.getAttribute('mode') === 'display';
                    
                    const span = document.createElement('span');
                    if (isDisplay) {
                        span.textContent = '$$' + math + '$$';
                    } else {
                        span.textContent = '\\(' + math + '\\)';
                    }
                    script.parentNode.replaceChild(span, script);
                });
            }

            function rerenderMath() {
                convertScriptTagsToMathJax();
                if (typeof MathJax !== 'undefined') {
                    if (typeof MathJax.typesetPromise === 'function') {
                        MathJax.typesetPromise().catch(err => console.log(err));
                    } else if (typeof MathJax.typeset === 'function') {
                        MathJax.typeset();
                    } else if (MathJax.Hub && typeof MathJax.Hub.Queue === 'function') {
                        MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                    }
                }
            }

            if (typeof MathJax === 'undefined') {
                var script = document.createElement('script');
                script.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
                document.head.appendChild(script);

                var config = document.createElement('script');
                config.type = "text/x-mathjax-config";
                config.textContent = 'MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }}, "CommonHTML": {linebreaks: { automatic: true }}});';
                document.head.appendChild(config);
            } else {
                setTimeout(rerenderMath, 200);
            }

            document.addEventListener('livewire:init', () => {
                Livewire.on('math-updated', () => {
                    setTimeout(rerenderMath, 100);
                });
            });
        </script>
    @endpush
</form>
</div>
