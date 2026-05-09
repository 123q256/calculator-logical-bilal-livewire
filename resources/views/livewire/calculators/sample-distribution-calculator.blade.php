<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-6">
                        <label for="mean" class="label">{{ $lang['mean'] ?? 'Mean' }} (μ)</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="mean" id="mean" class="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="deviation" class="label">{{ $lang['st_dev'] ?? 'Standard Deviation' }} (σ)</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="deviation" id="deviation" class="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="size" class="label">{{ $lang['size'] ?? 'Sample Size' }} (n)</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="size" id="size" class="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="probability" class="label">{{ $lang['prob'] ?? 'Probability Type' }}</label>
                        <div class="w-100 py-2">
                            <select wire:model.live="probability" id="probability" class="input cursor-pointer">
                                <option value="two_tailed">Between</option>
                                <option value="left_tailed">Below</option>
                                <option value="right_tailed">Above</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="x1" class="label">X₁</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="x1" id="x1" class="input" placeholder="00" />
                        </div>
                    </div>
                    @if($probability === 'two_tailed')
                        <div class="col-span-6">
                            <label for="x2" class="label">X₂</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="x2" id="x2" class="input" placeholder="00" />
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
                                @php
                                    $probability = $detail['probability'];
                                    $x1 = $detail['x1'];
                                    $x2 = $detail['x2'];
                                    $ans = ($probability === 'two_tailed') ? $detail['pr'] : $detail['pr2'];
                                    
                                    if($probability === 'two_tailed'){
                                        $res = "$x1 \\le \\bar{X} \\le $x2";
                                    } elseif($probability === 'left_tailed'){
                                        $res = "\\bar{X} \\le $x1";
                                    } else {
                                        $res = "\\bar{X} \\ge $x1";
                                    }

                                    function sigFig($value, $digits){
                                        if ($value !== '') {
                                            if ($value === 0) return 0;
                                            $sign = ($value < 0) ? -1 : 1;
                                            $abs_value = abs($value);
                                            $decimalPlaces = $digits - floor(log10($abs_value)) - 1;
                                            return round($value, $decimalPlaces);
                                        }
                                    }
                                @endphp

                                <div class="text-center">
                                    <p class="text-[20px]">
                                        <strong>\[ Pr({!! $res !!}) \]</strong>
                                    </p>
                                    <div class="flex justify-center">
                                        <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ sigFig($ans, 4) }}</strong>
                                        </p>
                                    </div>
                                </div>

                                <p class="w-full mt-3 text-[20px]">{{ $lang['statement1'] ?? 'Calculated values' }}:</p>
                                <div class="w-full lg:w-[50%] mt-2 overflow-auto">
                                    <table class="w-full">
                                        <tr>
                                            <td class="p-2 border-b text-blue">{{ $lang['st_d'] ?? 'Standard Deviation' }} (μX̄)</td>
                                            <td class="p-2 border-b font-semibold">{{ $detail['mean'] }}</td>
                                        </tr>
                                        <tr>
                                            <td class="p-2 border-b text-blue">{{ $lang['st_er'] ?? 'Standard Error' }} (σX̄)</td>
                                            <td class="p-2 border-b font-semibold">{{ $detail['standard_error'] }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <p class="w-full mt-6">{{ $lang['statement5'] ?? 'Probability Density Function (PDF)' }}:</p>
                                <div id="sampleChart" class="mt-3 w-full h-[400px]"></div>

                                <div class="w-full text-center mt-8">
                                    <button type="button" wire:click="resetForm" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-8 py-3">
                                        {{ $lang['reset'] ?? 'RESET' }}
                                    </button>
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
    <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body, { delimiters: [{left: '$$', right: '$$', display: true}, {left: '\\(', right: '\\)', display: false}, {left: '\\[', right: '\\]', display: true}] });"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    
    <script>
        window.renderSampleChart = function(data) {
            if (!document.getElementById('sampleChart')) return;

            let labels = [];
            if(data.probability === 'two_tailed'){
                labels = ['x', 'P(X̄ ≥ X₁ & X̄ > X₂), PDF', , , , , , , , , 'P(X₁ < X̄ < X₂), PDF'];
            } else if(data.probability === 'left_tailed'){
                labels = ['x', 'P(X̄ ≥ X), PDF', , , , , , , , , 'P(X̄ < X), PDF'];
            } else {
                labels = ['x', 'P(X̄ ≤ X), PDF', , , , , , , , , 'P(X̄ > X), PDF'];
            }

            Highcharts.chart('sampleChart', {
                chart: { type: 'area' },
                title: { text: 'Probability density function (PDF)' },
                tooltip: { pointFormat: '{series.name}, PDF {point.y}' },
                plotOptions: {
                    area: {
                        marker: { enabled: false }
                    }
                },
                series: [
                    {
                        name: data.probability === 'two_tailed' ? 'P(X̄ ≥ X₁ & X̄ > X₂)' : (data.probability === 'left_tailed' ? 'P(X̄ ≥ X), PDF' : 'P(X̄ > X), PDF'),
                        data: data.chartData
                    },
                    {
                        name: data.probability === 'two_tailed' ? 'P(X₁ < X̄ < X₂)' : (data.probability === 'left_tailed' ? 'P(X̄ < X), PDF' : 'P(X̄ ≤ X), PDF'),
                        data: data.chartData2
                    }
                ]
            });
        };

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

            Livewire.on('chart-updated', (event) => {
                setTimeout(() => { window.renderSampleChart(event[0]); }, 100);
            });

            // Initial load from session
            @isset($detail)
                setTimeout(() => {
                    window.renderSampleChart({
                        chartData: @json($detail['chartData']),
                        chartData2: @json($detail['chartData2']),
                        probability: '{{ $detail['probability'] }}'
                    });
                }, 500);
            @endisset
        });
    </script>
@endpush
