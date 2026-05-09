<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2 relative">
                        <label for="z_score" class="label">{{ $lang['1'] ?? 'Z-score' }} (-5 to 5):</label>
                        <input type="number" step="any" wire:model.live="z_score" id="z_score" class="input" placeholder="00" />
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
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="text-center">
                                    <p class="text-[20px]">
                                        <strong class="text-blue">{{ round(100 * $detail['res_val'], 0) }}-th {{ $lang[2] ?? 'Percentile' }}</strong>
                                    </p>
                                    <div class="flex justify-center">
                                        <p class="text-[30px] bg-[#2845F5] text-white px-6 py-4 rounded-xl d-inline-block my-4">
                                            <strong>{{ round(100 * $detail['res_val'], 2) }}%</strong>
                                        </p>
                                    </div>
                                </div>

                                <div class="space-y-6 mt-8">
                                    <p class="text-blue font-bold text-[18px]">{{ $lang[3] ?? 'Solution' }}:</p>
                                    
                                    <div class="bg-gray-50 p-6 rounded-xl space-y-4 overflow-auto">
                                        <p><strong>{{ $lang[4] ?? 'Step 1' }}:</strong> Z = {{ round($detail['z_score'], 4) }}</p>
                                        
                                        <p><strong>{{ $lang[5] ?? 'Step 2' }}:</strong> \( P(Z < {{ round($detail['z_score'], 4) }}) \)</p>
                                        <p class="text-center bg-white p-3 rounded-lg shadow-sm">
                                            \( P(Z < {{ round($detail['z_score'], 4) }}) = {{ round($detail['res_val'], 4) }} \)
                                        </p>

                                        <p><strong>{{ $lang[6] ?? 'Step 3' }}:</strong> {{ $lang[6] ?? 'Calculate percentage' }}</p>
                                        <p class="text-center bg-white p-3 rounded-lg shadow-sm">
                                            \( 100 \times P(Z < {{ round($detail['z_score'], 4) }}) = 100 \times {{ round($detail['res_val'], 4) }} = {{ round(100 * $detail['res_val'], 2) }}\% \)
                                        </p>

                                        <p><strong>{{ $lang[7] ?? 'Final Step' }}:</strong> {{ round($detail['z_score'], 4) }} is the <strong>{{ round(100 * $detail['res_val'], 0) }}-th {{ $lang[2] ?? 'Percentile' }}</strong></p>
                                    </div>

                                    <div class="text-center space-y-4 mt-8">
                                        <p class="font-bold text-[18px]">{{ $lang[8] ?? 'Visual Representation' }}</p>
                                        <p class="text-gray-600">The {{ round(100 * $detail['res_val'], 0) }}-th {{ $lang[2] ?? 'percentile' }} {{ $lang[9] ?? 'is' }} z = {{ round($detail['z_score'], 4) }}</p>
                                        <div class="flex justify-center mt-4">
                                            <img src="{{ url('images/graph/' . $detail['img']) }}" alt="Z-Score Graph" class="max-w-xl w-full h-auto rounded-lg shadow-md border border-gray-200">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>

@push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
    <script defer src="{{ url('katex/katex.min.js') }}"></script>
    <script defer src="{{ url('katex/auto-render.min.js') }}" onload="window.MJrerender && window.MJrerender()"></script>
    
    <script>
        window.MJrerender = function() {
            if (typeof renderMathInElement === 'function') {
                renderMathInElement(document.body, {
                    delimiters: [
                        {left: '$$', right: '$$', display: true},
                        {left: '\\(', right: '\\)', display: false},
                        {left: '\\[', right: '\\]', display: true}
                    ],
                    throwOnError : false
                });
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            window.MJrerender();
        });

        document.addEventListener('livewire:initialized', () => {
            window.MJrerender();

            Livewire.hook('morph.updated', (el, component) => {
                window.MJrerender();
            });

            Livewire.on('math-updated', () => {
                setTimeout(() => { window.MJrerender(); }, 100);
            });
        });
    </script>
@endpush
