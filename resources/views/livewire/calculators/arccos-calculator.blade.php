<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <label for="arccos" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="arccos" min="-1" max="1" id="arccos" class="input" aria-label="input" />
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="round" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="round" min="0" max="15" id="round" class="input" aria-label="input" />
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
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }}</strong></td>
                                        <td class="py-2 border-b">{{ $detail['angle'] }}°</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['4'] }}</strong></td>
                                        <td class="py-2 border-b">{{ $detail['rad'] }} rad</td>
                                    </tr>
                                </table>
                            </div>

                            <p class="mt-3 text-[18px]"><strong>{{ $lang['5'] }}</strong></p>
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-3 overflow-x-auto">
                                <table class="w-full text-[18px]">
                                    @foreach([['gon', 'gradians'], ['tr', 'turns'], ['arcmin', 'minutes of'], ['arcsec', 'seconds of'], ['mrad', 'miliradians'], ['urad', 'microradians'], ['pirad', 'π radians']] as $unit)
                                        <tr>
                                            <td class="py-2 border-b whitespace-nowrap" width="40%">arccos ({{ $arccos }})</td>
                                            <td class="py-2 border-b whitespace-nowrap"><strong>{{ $detail[$unit[0]] }} ({{ $unit[1] }})</strong></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>

                            <div class="w-full text-[16px] mt-3 overflow-x-auto">
                                <p><strong>{{ $lang[6] }}</strong></p>
                                <p class="mt-2 text-[18px] whitespace-nowrap">arccos {{ $arccos }} = cos<sup class="font-s-14">-1</sup> {{ $arccos }} = {{ $detail['deg'] }}° {{ $detail['min'] }}' {{ $detail['sec'] }}"</p>
                                <p class="mt-2 text-[18px] whitespace-nowrap">= {{ $detail['angle'] }} + k * 360° (k = -1,0,1,...)</p>
                                <p class="mt-2 text-[18px] whitespace-nowrap">= 
                                    @php
                                        $ans = $detail['angle'] + (-1) * 360;
                                        $ans1 = $detail['angle'] + 0 * 360;
                                        $ans2 = $detail['angle'] + 1 * 360;
                                        echo round($ans, $round).'°, '.round($ans1, $round).'°, '.round($ans2, $round).'°, ...';
                                    @endphp
                                </p>
                                <p class="mt-2 text-[18px] whitespace-nowrap">= {{ $detail['rad'] }} rad + k * 2π (k = -1,0,1,...)</p>
                                <p class="mt-2 text-[18px] whitespace-nowrap">= 
                                    @php
                                        $radVal = floatval($detail['rad']) / pi();
                                        $ans3 = $radVal + (-1) * 2;
                                        $ans4 = $radVal + 0 * 2;
                                        $ans5 = $radVal + 1 * 2;
                                        echo round($ans3, $round).'π, '.round($ans4, $round).'π, '.round($ans5, $round).'π, ...';
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('math-updated', () => {
                    setTimeout(() => {
                        if (typeof renderMathInElement === 'function') {
                            renderMathInElement(document.body);
                        }
                    }, 100);
                });

                Livewire.hook('morph.updated', ({ el }) => {
                    if (typeof renderMathInElement === 'function') {
                        renderMathInElement(el);
                    }
                });
            });
        </script>
    @endpush
</div>
