<div>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if ($error)
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
            <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="outcome" class="font-s-14 text-blue">{!! $lang['1'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <select wire:model.live="outcome" id="outcome" class="input">
                            <option value="per">{{ $lang['2'] }}</option>
                            <option value="yrs">{{ $lang['3'] }}</option>
                        </select>
                    </div>
                </div>

                @if ($outcome === 'yrs')
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="first" class="font-s-14 text-blue">{!! $lang['3'] !!}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="first" id="first" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                @endif

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="second" class="font-s-14 text-blue">{!! $lang['4'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" wire:model.live="second" id="second" class="input" aria-label="input" placeholder="00" />
                        <span class="text-blue input_unit">{{ $outcome === 'per' ? '%' : $lang[17] }}</span>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                    <label for="third" class="font-s-14 text-blue">{!! $lang['5'] !!}:</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" wire:model.live="third" id="third" class="input" aria-label="input" placeholder="00" />
                        <span class="text-blue input_unit">{{ $outcome === 'per' ? '%' : $lang[17] }}</span>
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

    @if ($detail)
        <hr>
        <div id="result-section" wire:key="result-{{ rand() }}" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full p-3 mt-3">
                        <div class="w-full">
                            <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 mb-5">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899">
                                        <span>{{ $lang[6] }} (ARR) =</span>
                                        <strong class="text-green-700 text-[28px]">{{ round($detail['arr'], 2) }}</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899">
                                        <span>{{ $lang[7] }} (NNT) =</span>
                                        <strong class="text-green-700 text-[28px]">{{ round($detail['nnt'], 2) }}</strong>
                                    </div>
                                </div>
                            </div>
                            <p>{{ $lang[8] }} <strong>{{ round(abs($detail['nnt']), 2) }}</strong> {{ $lang[9] }}</p>
                            <p class="mb-1"><strong class="text-blue font-s-18">{{ $lang[10] }}:</strong></p>
                            @if ($outcome == 'per')
                                <p class="text-left mt-3">ARR = ({{ $lang[11] }} {{ $lang[12] }} {{ $lang[13] }}) - ({{ $lang[16] }} {{ $lang[12] }} {{ $lang[13] }})</p>
                                <p class="text-left mt-3">\( \displaystyle ARR = {{ ($second / 100) }} - {{ ($third / 100) }} = {{ $detail['arr'] }} \)</p>
                                <p class="text-left mt-3">
                                    \( \displaystyle NNT = \frac{1}{ARR} = \frac{1}{ {{ $detail['arr'] }} } = {{ $detail['nnt'] }} \)
                                </p>
                            @else
                                <p class="text-left mt-3">\( \displaystyle R_0 = 1 - e^(\frac{-{{ $lang[11] }}\;{{ $lang[14] }}}{{{ $lang[15] }}}) \)</p>
                                <p class="text-left mt-3">\( \displaystyle R_1 = 1 - e^(\frac{-{{ $lang[16] }}\;{{ $lang[14] }}}{{{ $lang[15] }}}) \)</p>
                                <p class="text-left mt-3">\( \displaystyle ARR = R_0 - R_1 = {{ $detail['arr'] }} \)</p>
                                <p class="text-left mt-3">\( \displaystyle NNT = \frac{1}{ARR} = \frac{1}{{!! $detail['arr'] !!}} = {{ $detail['nnt'] }} \)</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @push('calculatorJS')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('livewire:initialized', () => {
                @this.on('math-updated', (event) => {
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
                    }, 100);
                });

                // Initial render
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            });
        </script>
    @endpush
</form>
</div>
