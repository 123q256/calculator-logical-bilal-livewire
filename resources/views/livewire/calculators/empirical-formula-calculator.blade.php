<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[50%] md:w-[50%] w-full mx-auto">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="my-4 text-[16px] font-bold">{!! $lang['1'] !!}:</p>
                        <div class="grid grid-cols-1 gap-4">
                            <div class="space-y-2">
                                <input type="text" wire:model="e1" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                            </div>
                            <div class="space-y-2">
                                <input type="text" wire:model="e2" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                            </div>
                            <div class="space-y-2">
                                <input type="text" wire:model="e3" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                            </div>
                            <div class="space-y-2">
                                <input type="text" wire:model="e4" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                            </div>
                            <div class="space-y-2">
                                <input type="text" wire:model="e5" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                            </div>
                            <div class="space-y-2">
                                <input type="text" wire:model="e6" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                            </div>
                        </div>
                    </div>
                    <div>
                        <p class="my-4 text-[16px] font-bold">{!! $lang['2'] !!}:</p>
                        <div class="grid grid-cols-1 gap-4">
                            <div class="space-y-2">
                                <input type="number" step="any" wire:model="m1" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                            </div>
                            <div class="space-y-2">
                                <input type="number" step="any" wire:model="m2" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                            </div>
                            <div class="space-y-2">
                                <input type="number" step="any" wire:model="m3" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                            </div>
                            <div class="space-y-2">
                                <input type="number" step="any" wire:model="m4" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                            </div>
                            <div class="space-y-2">
                                <input type="number" step="any" wire:model="m5" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                            </div>
                            <div class="space-y-2">
                                <input type="number" step="any" wire:model="m6" class="input border border-gray-300 p-2 rounded-lg w-full" placeholder="00" />
                            </div>
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

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full p-3 radius-10 mt-3">
                            <div class="w-full mt-2">
                                <div class="bg-sky border radius-10 px-3 py-2">
                                    <strong>{{ $lang['3'] }} =</strong>
                                    <strong class="text-[#119154] text-[28px]">{!! $detail['formula'] !!}</strong>
                                </div>
                                <p class="font-s-20 px-2 mt-3"><strong>Solution</strong></p>
                                <div class=" w-full text-[20px] overflow-auto">
                                    <table class="w-full" cellspacing="0">
                                        <tr id="s1Ans">
                                            <td class="border-b p-2">{{ $lang['1'] }}</td>
                                            {!! $detail['s1'] !!}
                                        </tr>
                                        <tr id="s2Ans">
                                            <td class="border-b p-2">{{ $lang['4'] }}</td>
                                            {!! $detail['s2'] !!}
                                        </tr>
                                        <tr id="s3Ans">
                                            <td class="border-b p-2">{{ $lang['5'] }}</td>
                                            {!! $detail['s3'] !!}
                                        </tr>
                                        <tr id="s4Ans">
                                            <td class="border-b p-2">{{ $lang['5'] }}</td>
                                            {!! $detail['s4'] !!}
                                        </tr>
                                        <tr id="s5Ans">
                                            <td class="border-b p-2">{{ $lang['6'] }}</td>
                                            {!! $detail['s5'] !!}
                                        </tr>
                                        <tr id="s6Ans">
                                            <td class="border-b p-2">{{ $lang['7'] }}</td>
                                            {!! $detail['s6'] !!}
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="p-2">{{ $lang['3'] }}</td>
                                            <td id="defineColspan"><strong class="text-green">{!! $detail['formula'] !!}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
        @push('calculatorJS')
            <script>
                function loadMathJax() {
                    if (!window.MathJax) {
                        var script = document.createElement('script');
                        script.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
                        script.async = true;
                        script.onload = () => {
                            if (window.MathJax.Hub) {
                                window.MathJax.Hub.Config({
                                    tex2jax: {
                                        inlineMath: [['\\(', '\\)']],
                                        displayMath: [['\\[', '\\]']],
                                        processEscapes: true
                                    },
                                    "HTML-CSS": { linebreaks: { automatic: true } },
                                    SVG: { linebreaks: { automatic: true } }
                                });
                            }
                        };
                        document.head.appendChild(script);
                    }
                }

                loadMathJax();

                function rerenderMath() {
                    if (window.MathJax) {
                        if (window.MathJax.typesetPromise) {
                            MathJax.typesetPromise().catch(err => console.log(err));
                        } else if (window.MathJax.Hub) {
                            window.MathJax.Hub.Queue(["Typeset", window.MathJax.Hub]);
                        }
                    }
                }

                document.addEventListener('livewire:init', () => {
                    Livewire.on('math-updated', () => {
                        setTimeout(rerenderMath, 300);
                    });
                });

                // Fallback for direct $wire events
                window.addEventListener('math-updated', () => {
                    setTimeout(rerenderMath, 300);
                });
            </script>
        @endpush
    </form>
</div>
