<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2 relative">
                        <label for="sample_size" class="label">{{ $lang[1] ?? 'Sample Size (n)' }}:</label>
                        <input type="number" step="any" wire:model.live="sample_size" id="sample_size" class="input" placeholder="00" />
                    </div>
                    <div class="space-y-2 relative">
                        <label for="occurrences" class="label">{{ $lang[2] ?? 'Number of Occurrences (x)' }}:</label>
                        <input type="number" step="any" wire:model.live="occurrences" id="occurrences" class="input" placeholder="00" />
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
                    <div class="rounded-lg mt-3 flex items-center justify-center">
                        <div class="w-full">
                            <div class="text-center">
                                <p class="font-s-18">
                                    <strong>p̂</strong>
                                </p>
                                <p class="font-s-21 px-3 py-2 my-3">
                                    <strong class="bg-[#2845F5] text-white rounded-lg p-4">{{ round($detail['p_hat'], 3) }}</strong>
                                </p>
                            </div>
                            <p class="col-12 mt-3 font-s-18"><strong class="text-blue">{{ $lang['3'] ?? 'Summary' }}</strong></p>
                            <p class="col-12 mt-2">{{ $lang['1'] ?? 'Sample Size' }} : {{ $sample_size }}</p>
                            <p class="col-12 mt-2">{{ $lang['2'] ?? 'Number of Occurrences' }} : {{ $occurrences }}</p>
                            <!-- -------------------------- Solution ----------------------- -->
                           <div class="overflow-auto">
                             <p class="col-12 mt-3 font-s-18"><strong class="text-blue">{{ $lang['5'] ?? 'Solution' }}</strong></p>
                            <p class="col-12 mt-2">{{ $lang['4'] ?? 'Formula' }} :</p>
                            <p class="col-12 mt-2">\( \hat{p} = \dfrac{\text{Number of Occurrences}}{\text{Sample Size}} \)</p>
                            <p class="col-12 mt-2">\( \hat{p} = \dfrac{ {{ $occurrences }} }{ {{ $sample_size }} } \)</p>
                            <p class="col-12 mt-2">\( \hat{p} = {{ round($detail['p_hat'], 3) }} \)</p>
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
