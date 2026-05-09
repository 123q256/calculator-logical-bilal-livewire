<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2">
                    <div class="col-span-12">
                        <label for="observed" class="label">{{ $lang[1] ?? 'Observed value' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="observed" id="observed" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="expected" class="label">{{ $lang[2] ?? 'Expected value' }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="expected" id="expected" class="input" aria-label="input" placeholder="00" />
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
                                        <strong>{{ $lang[3] ?? 'Chi-Square' }} ( X²)</strong>
                                    </p>
                                    <div class="flex justify-center">
                                        <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg inline-block my-3">
                                            <strong class="text-white">{{ round($detail['chiSquared'], 4) }}</strong>
                                        </p>
                                    </div>
                                </div>
                                <p class="w-full mt-2 text-[20px]"><strong class="text-blue">{{ $lang['4'] ?? 'Input Data' }}</strong></p>
                                <p class="w-full mt-2">{{ $lang['1'] ?? 'Observed value' }} : {{ $observed }}</p>
                                <p class="w-full mt-2">{{ $lang['2'] ?? 'Expected value' }} : {{ $expected }}</p>
                                
                                <!-- -------------------------- Solution ----------------------- -->
                                <p class="w-full mt-2 text-[20px]"><strong class="text-blue">{{ $lang['5'] ?? 'Solution' }}</strong></p>
                                <p class="w-full mt-2">{{ $lang['6'] ?? 'Formula' }} :</p>
                                <div class="overflow-auto py-4">
                                    <p class="w-full mt-2 text-center text-[18px]">\( X^2 = \dfrac{( \text{Observed value} - \text{Expected value} )^2}{\text{Expected value}} \)</p>
                                    <p class="w-full mt-2 text-center text-[18px]">\( X^2 = \dfrac{( {{ $observed }} - {{ $expected }} )^2}{ {{ $expected }} } \)</p>
                                    <p class="w-full mt-2 text-center text-[22px] font-bold text-blue">\( X^2 = {{ round($detail['chiSquared'], 4) }} \)</p>
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
    <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('math-updated', () => {
                setTimeout(() => {
                    if (typeof renderMathInElement !== 'undefined') {
                        renderMathInElement(document.body);
                    }
                }, 100);
            });
        });
    </script>
@endpush
