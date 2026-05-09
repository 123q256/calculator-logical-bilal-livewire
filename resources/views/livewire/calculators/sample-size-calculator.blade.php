<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="mx-auto mt-2 w-full">
                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div wire:click="setPopulation('sample')" 
                                 class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover:bg-[#2845F5] hover:text-white @if($population === 'sample') bg-[#2845F5] text-white tagsUnit @endif">
                                {{ $lang['1'] ?? 'Infinite Population' }}
                            </div>
                        </div>
                        <div class="lg:w-1/2 w-full px-2 py-1">
                            <div wire:click="setPopulation('margin')" 
                                 class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover:bg-[#2845F5] hover:text-white @if($population === 'margin') bg-[#2845F5] text-white tagsUnit @endif">
                                {{ $lang['2'] ?? 'Finite Population' }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-4">
                    <div class="space-y-2">
                        <label for="given_change" class="label">{{ $lang['3'] ?? 'Given Parameter' }}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="given_unit" id="given_change" class="input">
                                <option value="standard">{{ $lang[4] ?? 'Standard Deviation' }}</option>
                                <option value="population">{{ $lang[5] ?? 'Proportion' }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="confidence_unit" class="label">{{ $lang['6'] ?? 'Confidence Level' }}:</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="confidence_unit" id="confidence_unit" class="input">
                                @php
                                    $levels = ["70%", "75%", "80%", "85%", "90%", "95%", "98%", "99%", "99.9%", "99.99%", "99.999%"];
                                @endphp
                                @foreach($levels as $level)
                                    <option value="{{ $level }}">{{ $level }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="space-y-2">
                        <label for="margin" class="label">{{ $lang['7'] ?? 'Margin of Error' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="margin" id="margin" class="input" placeholder="00" />
                            <span class="text-blue input_unit">%</span>
                        </div>
                    </div>

                    @if($given_unit === 'standard')
                        <div class="space-y-2">
                            <label for="standard" class="label">{{ $lang['4'] ?? 'Standard Deviation' }}:</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="standard" id="standard" class="input" placeholder="00" />
                            </div>
                        </div>
                    @else
                        <div class="space-y-2">
                            <label for="proportion1" class="label">{{ $lang['5'] ?? 'Proportion' }}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="proportion" id="proportion1" class="input" placeholder="00" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                    @endif

                    @if($population === 'margin')
                        <div class="space-y-2">
                            <label for="n_finite" class="label">Population Size (N):</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="n_finite" id="n_finite" class="input" placeholder="00" />
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
                                        <strong>{{ $lang['8'] ?? 'Recommended Sample Size' }}</strong>
                                    </p>
                                    <div class="flex justify-center">
                                        <p class="text-[30px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['answer'] }}</strong>
                                        </p>
                                    </div>
                                </div>

                                @if ($population == "sample")
                                    @if ($given_unit == "standard")
                                        <p class="w-full mt-2 font-s-18 text-blue"><strong>{{ $lang['9'] ?? 'Solution' }}</strong></p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['10'] ?? 'Calculation' }}.</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \( \left(\frac{\text{<?= $lang['6'] ?>}\times \text{<?= $lang['4'] ?>}}{<?= $lang['7'] ?>}\right)^2 \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \( \left(\frac{{<?= round($detail['confidence_unit'], 4) ?>}\times {<?= round($detail['standard'], 4) ?>}}{<?= round($detail['margin'], 4) ?>}\right)^2 \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \( \left( \frac{<?= round($detail['multiply'], 4) ?>}{<?= round($detail['margin'], 4) ?>} \right)^2 \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \( (<?= round($detail['divide'], 4) ?>)^2 \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = {{ round($detail['sub_answer'], 4) }}</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = {{ round($detail['answer'], 7) }}</p>
                                    @else
                                        <p class="w-full mt-2 font-s-18 text-blue"><strong>{{ $lang['9'] ?? 'Solution' }}</strong></p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['10'] ?? 'Calculation' }}.</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \(\frac{ \text({<?= $lang['6'] ?>})^2 \times \text{<?= $lang['5'] ?>}(1 -\text{<?= $lang['5'] ?>})}{\text({<?= $lang['7'] ?>})^2} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \(\frac{ ({<?= round($detail['confidence_unit'], 4) ?>})^2 \times {<?= round($detail['proportion'], 4) ?>}(1 - <?= round($detail['proportion'], 4) ?>)}{({<?= round($detail['margin'], 4) ?>})^2} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \(\frac{ ({<?= round($detail['confidence_unit'], 4) ?>})^2 \times {<?= round($detail['proportion'], 4) ?>}(<?= round($detail['minus'], 4) ?>)}{{<?= round($detail['marg'], 4) ?>}} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \(\frac{ {<?= round($detail['con_unit'], 4) ?>} \times {<?= round($detail['proportion'], 4) ?>}\times<?= round($detail['minus'], 4) ?>}{{<?= round($detail['marg'], 4) ?>}} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \( \frac{<?= round($detail['propro'], 4) ?>}{<?= round($detail['marg'], 4) ?>} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = {{ round($detail['propro_answer'], 4) }}</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = {{ round($detail['answer'], 7) }}</p>
                                    @endif
                                @else
                                    @if ($given_unit == "standard")
                                        <p class="w-full mt-2 font-s-18 text-blue"><strong>{{ $lang['9'] ?? 'Solution' }}</strong></p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['11'] ?? 'Calculation for finite population' }}.</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \( \frac{n \times N}{n + N - 1} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \( \frac{n \times <?= round($detail['n_finite'], 4) ?>}{n + {<?= round($detail['n_finite'], 4) ?>} - 1} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['13'] ?? 'Calculate n' }} n=?</p>
                                        <p class="w-full mt-3 md:text-[25px]"> n = \( \left(\frac{\text{<?= $lang['6'] ?>}\times \text{<?= $lang['4'] ?>}}{Margin of Error}\right)^2 \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">n = \( \left(\frac{{<?= round($detail['confidence_unit'], 4) ?>}\times {<?= round($detail['standard'], 4) ?>}}{<?= round($detail['margin'], 4) ?>}\right)^2 \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">n = \( \left( \frac{<?= round($detail['multiply'], 4) ?>}{<?= round($detail['margin'], 4) ?>} \right)^2 \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">n = \( (<?= round($detail['divide'], 4) ?>)^2 \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">n = {{ round($detail['sub_answer'], 4) }}</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['12'] ?? 'Adjust for finite' }} </p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \( \frac{n \times N}{n + N - 1} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \( \frac{ <?= round($detail['sub_answer'], 4) ?> \times <?= round($detail['n_finite'], 4) ?>}{ <?= round($detail['sub_answer'], 4) ?> + {<?= round($detail['n_finite'], 4) ?>} - 1} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \( \frac{ <?= round($detail['a_answer'], 4) ?>}{ <?= round($detail['b_answer'], 4) ?> }\)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = {{ round($detail['answer'], 7) }}</p>
                                    @else
                                        <p class="w-full mt-2 font-s-18 text-blue"><strong>{{ $lang['9'] ?? 'Solution' }}</strong></p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['11'] ?? 'Calculation for finite population' }}.</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \( \frac{n \times N}{n + N - 1} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \( \frac{n \times <?= round($detail['n_finite'], 4) ?>}{n + {<?= round($detail['n_finite'], 4) ?>} - 1} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['13'] ?? 'Calculate n' }} n=?</p>
                                        <p class="w-full mt-3 md:text-[25px]"> n = \(\frac{ \text({<?= $lang['6'] ?>})^2 \times \text{<?= $lang['5'] ?>}(1 -\text{<?= $lang['5'] ?>})}{\text({<?= $lang['7'] ?>})^2} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">n= \(\frac{ ({<?= round($detail['confidence_unit'], 4) ?>})^2 \times {<?= round($detail['proportion'], 4) ?>}(1 - <?= round($detail['proportion'], 4) ?>)}{({<?= round($detail['margin'], 4) ?>})^2} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">n= \(\frac{ ({<?= round($detail['confidence_unit'], 4) ?>})^2 \times {<?= round($detail['proportion'], 4) ?>}(<?= round($detail['minus'], 4) ?>)}{{<?= round($detail['marg'], 4) ?>}} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">n = \(\frac{ {<?= round($detail['con_unit'], 4) ?>} \times {<?= round($detail['proportion'], 4) ?>}\times<?= round($detail['minus'], 4) ?>}{{<?= round($detail['marg'], 4) ?>}} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">n= \( \frac{<?= round($detail['propro'], 4) ?>}{<?= round($detail['marg'], 4) ?>} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">n= {{ round($detail['sub_answer'], 7) }}</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['12'] ?? 'Adjust for finite' }}</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \( \frac{n \times N}{n + N - 1} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \( \frac{ <?= round($detail['sub_answer'], 4) ?> \times <?= round($detail['n_finite'], 4) ?>}{ <?= round($detail['sub_answer'], 4) ?> + {<?= round($detail['n_finite'], 4) ?>} - 1} \)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = \( \frac{ <?= round($detail['a_answer'], 4) ?>}{ <?= round($detail['b_answer'], 4) ?> }\)</p>
                                        <p class="w-full mt-3 md:text-[25px]">{{ $lang['8'] ?? 'Size' }} = {{ round($detail['answer'], 7) }}</p>
                                    @endif
                                @endif
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
    <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body, { delimiters: [{left: '$$', right: '$$', display: true}, {left: '\\(', right: '\\)', display: false}, {left: '\\[', right: '\\]', display: true}] });"></script>
    
    <script>
        window.MJrerender = function() {
            if (typeof renderMathInElement === 'function') {
                renderMathInElement(document.getElementById('result-section') || document.body, {
                    delimiters: [
                        {left: '$$', right: '$$', display: true},
                        {left: '\\(', right: '\\)', display: false},
                        {left: '\\[', right: '\\]', display: true}
                    ],
                    throwOnError : false
                });
            }
        };

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('math-updated', () => {
                setTimeout(() => { window.MJrerender(); }, 100);
            });
        });
    </script>
@endpush
