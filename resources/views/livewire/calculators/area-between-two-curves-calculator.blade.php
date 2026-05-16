<div>
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
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[50%] md:w-[50%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <label for="EnterEq1" class="label">{{ $lang['1'] }} (f(x)):</label>
                        <div class="w-full py-2">
                            <input type="text" wire:model.live="EnterEq1" id="EnterEq1" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="EnterEq2" class="label">{{ $lang['2'] }} (g(x)):</label>
                        <div class="w-full py-2">
                            <input type="text" wire:model.live="EnterEq2" id="EnterEq2" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="upper" class="label">{{ $lang['3'] }} (upper):</label>
                        <div class="w-full py-2">
                            <input type="text" wire:model.live="upper" id="upper" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="lower" class="label">{{ $lang['4'] }} (lower):</label>
                        <div class="w-full py-2">
                            <input type="text" wire:model.live="lower" id="lower" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="with" class="label">W.R.T:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="with" class="input border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" id="with" aria-label="select">
                                <option value="x">x</option>
                                <option value="y">y</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>
    </form>

    @isset($detail)
        <hr>
        <div id="result-section" wire:key="result-{{ count($detail) }}" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full text-[16px]">
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['6'] }}</strong></p>
                                <p class="mt-3">=\( {{ $detail['ans'] }} \)</p>
                                <p class="mt-3"> = {{ $detail['ans1'] }}</p>
                                <p class="mt-3 text-[18px]"><strong>{{ $lang['5'] }}</strong></p>
                                <p class="mt-3">\[ \int_{ {{ $detail['lb'] }} }^{ {{ $detail['ub'] }} } {{ $detail['enter'] }}\, d{{ $detail['with'] }} \]</p>
                                <p class="mt-3"><strong>{{ $lang['7'] }}</strong></p>
                                <div class="w-full res_step">
                                    <p class="mt-3">{!! $detail['steps'] !!}</p>
                                </div>
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
        
        <script type="text/x-mathjax-config">
            MathJax.Hub.Config({
                "HTML-CSS": { linebreaks: { automatic: true } },
                "CommonHTML": { linebreaks: { automatic: true } },
                tex2jax: { inlineMath: [['\\(', '\\)'], ['$', '$']] }
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>

        <script>
            function performRender() {
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body, {
                        delimiters: [
                            {left: '$$', right: '$$', display: true},
                            {left: '$', right: '$', display: false},
                            {left: '\\(', right: '\\)', display: false},
                            {left: '\\[', right: '\\]', display: true}
                        ],
                        throwOnError : false
                    });
                }
                if (typeof MathJax !== 'undefined') {
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                }
            }

            document.addEventListener('livewire:initialized', () => {
                @this.on('math-updated', (event) => {
                    setTimeout(performRender, 100);
                });

                Livewire.hook('morph.updated', ({ el }) => {
                    performRender();
                });

                // Initial render
                setTimeout(performRender, 200);
            });
            
            window.addEventListener('load', performRender);
        </script>
    @endpush
</div>
