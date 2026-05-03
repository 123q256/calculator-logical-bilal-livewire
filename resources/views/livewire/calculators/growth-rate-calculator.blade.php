<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <label for="operation" class="label">{{ $lang['1'] ?? 'Growth Type' }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="operation" id="operation" class="input" style="cursor: pointer;">
                                <option value="1">{{ $lang['2'] ?? 'Growth Rate' }}</option>
                                <option value="2">{{ $lang['3'] ?? 'Annual Growth Rate' }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 my-3">
                        @if ($operation == 2)
                            <p class="font-bold">
                                {{ $lang['1'] ?? 'Growth Rate' }} <sub>annual</sub> =
                                \[ \left( \frac{V_{\text{present}}}{V_{\text{past}}} \right)^{\frac{1}{t}} - 1 \]
                            </p>
                        @else
                            <p class="font-bold">
                                {{ $lang['1'] ?? 'Growth Rate' }} =
                                \[ \frac{V_{\text{present}} - V_{\text{past}}}{V_{\text{past}}} \]
                            </p>
                        @endif
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="present_val" class="label">{{ $lang['4'] ?? 'Present Value' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="present_val" id="present_val" class="input" aria-label="present_val" placeholder="2400" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="past_val" class="label">{{ $lang['5'] ?? 'Past Value' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="past_val" id="past_val" class="input" aria-label="past_val" placeholder="1200" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
                        </div>
                    </div>
                    @if ($operation == 2)
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="time_val" class="label">{{ $lang['6'] ?? 'Time (years)' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="time_val" id="time_val" class="input" aria-label="time_val" placeholder="2" />
                            </div>
                        </div>
                    @endif
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
            <div id="result-section" x-init="window.renderMath($el)" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] ?? 'Total Growth' }}</strong></td>
                                        <td class="py-2 border-b">{{ round($detail['growth_percent'], 2) }} %</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="mt-2 text-[18px]">
                                <p class="mt-2"><strong>{{ $lang[8] ?? 'Solution' }}:</strong></p>
                                @if ($detail['operation'] == "1")
                                    <p class="mt-2">\[ \text{Growth Rate} = \frac{ {{ $detail['present_val'] }} - {{ $detail['past_val'] }} }{ {{ $detail['past_val'] }} } \]</p>
                                    <p class="mt-2">\[ \text{Growth Rate} = \frac{ {{ $detail['growth_diff'] }} }{ {{ $detail['past_val'] }} } \]</p>
                                    <p class="mt-2">\[ \text{Growth Rate} = {{ round($detail['growth_val'], 4) }} \]</p>
                                    <p class="mt-2">\[ \text{Growth Rate } \% = {{ round($detail['growth_val'], 4) }} \times 100 \]</p>
                                    <p class="mt-2"><strong>{{ $lang[1] ?? 'Growth Rate' }} % = <span class="text-accent-4 font-size-22 orange-text">{{ round($detail['growth_percent'], 2) }}%</span></strong></p>
                                @else
                                    <p class="mt-2">\[ \text{Annual Growth} = \left( \frac{ {{ $detail['present_val'] }} }{ {{ $detail['past_val'] }} } \right)^{\frac{1}{ {{ $detail['time_val'] }} }} - 1 \]</p>
                                    <p class="mt-2">\[ \text{Annual Growth} = \left( {{ round($detail['growth_sub'], 4) }} \right)^{\frac{1}{ {{ $detail['time_val'] }} }} - 1 \]</p>
                                    <p class="mt-2">\[ \text{Annual Growth} = ({{ round($detail['g_val'], 4) }}) - 1 \]</p>
                                    <p class="mt-2">\[ \text{Annual Growth} = {{ round($detail['growth_val'], 4) }} \]</p>
                                    <p class="mt-2">\[ \text{Annual Growth } \% = {{ round($detail['growth_val'], 4) }} \times 100 \]</p>
                                    <p class="mt-2"><strong>{{ $lang[3] ?? 'Annual Growth Rate' }} % = <span class="text-accent-4 font-size-22 orange-text">{{ round($detail['growth_percent'], 2) }}%</span></strong></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script src="{{ url('katex/katex.min.js') }}"></script>
        <script src="{{ url('katex/auto-render.min.js') }}"></script>
        <script>
            window.renderMath = function(el = document.body) {
                // Try KaTeX
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(el, {
                        delimiters: [
                            {left: '$$', right: '$$', display: true},
                            {left: '$', right: '$', display: false},
                            {left: '\\(', right: '\\)', display: false},
                            {left: '\\[', right: '\\]', display: true}
                        ],
                        throwOnError: false
                    });
                } 
                // Fallback to MathJax (already in app.blade.php)
                else if (window.MathJax && window.MathJax.typesetPromise) {
                    window.MathJax.typesetPromise();
                }
            };

            document.addEventListener('DOMContentLoaded', () => window.renderMath());
            document.addEventListener('livewire:navigated', () => window.renderMath());
            
            document.addEventListener('livewire:init', () => {
                Livewire.hook('morph.updated', (el, component) => {
                    window.renderMath();
                });
            });

            // Extra trigger for calculation results
            window.addEventListener('scroll_to_result', () => {
                setTimeout(window.renderMath, 150);
            });
            
            // Interval check for lazy loading
            let mathCheck = setInterval(() => {
                if (typeof renderMathInElement === 'function') {
                    window.renderMath();
                    clearInterval(mathCheck);
                }
            }, 500);
            setTimeout(() => clearInterval(mathCheck), 5000);
        </script>
    @endpush
</div>
