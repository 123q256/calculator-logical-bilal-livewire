<div x-data="{ method: @entangle('method'), fun: @entangle('fun') }">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2 relative">
                        <label for="method" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <select id="method" class="input" wire:model.live="method">
                            <option value="1">{{ $lang['hyper'] }}</option>
                            <option value="2">{{ $lang['hyper'] }} ({{ $lang['chart'] }})</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 mt-4 gap-4" x-show="method == '2'" x-cloak>
                    <div class="space-y-2 function">
                        <label for="fun" class="font-s-14 text-blue">{{ $lang['2'] }}</label>
                        <select id="fun" class="input" wire:model.live="fun">
                            <option value="1">{{ $lang['mass'] }} f</option>
                            <option value="2">{{ $lang['lcd'] }} P</option>
                            <option value="3">{{ $lang['ucd'] }} Q</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2 mt-4 gap-4">
                    <div class="space-y-2 relative">
                        <label for="p" class="font-s-14 text-blue">{{ $lang['p'] }}</label>
                        <input type="number" step="any" id="p" wire:model.live="p" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2 relative">
                        <label for="sp" class="font-s-14 text-blue">{{ $lang['sp'] }}</label>
                        <input type="number" step="any" id="sp" wire:model.live="sp" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2 relative">
                        <label for="s" class="font-s-14 text-blue">{{ $lang['s'] }}</label>
                        <input type="number" step="any" id="s" wire:model.live="s" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2 relative">
                        <label for="ss" class="font-s-14 text-blue">{{ $lang['ss'] }} <span x-text="method == '2' ? '{{ $lang['ini'] }}' : ''"></span></label>
                        <input type="number" step="any" id="ss" wire:model.live="ss" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2 chart" x-show="method == '2'" x-cloak>
                        <label for="inc" class="font-s-14 text-blue">{{ $lang['inc'] }}</label>
                        <input type="number" min="1" max="4" id="inc" wire:model.live="inc" class="input" aria-label="input" placeholder="00" />
                    </div>
                    <div class="space-y-2 chart" x-show="method == '2'" x-cloak>
                        <label for="rep" class="font-s-14 text-blue">{{ $lang['rep'] }}</label>
                        <input type="number" min="1" max="20" id="rep" wire:model.live="rep" class="input" aria-label="input" placeholder="00" />
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
            <div id="result-section" 
                 x-init="
                    renderMath();
                    $nextTick(() => {
                        const offset = $el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    });
                 "
                 @render-math.window="renderMath()"
                 wire:loading.remove wire:target="calculate" 
                 class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full">
                            @if ($detail['method'] == 1)
                                <div class="w-full mt-2 overflow-auto">
                                    <table class="w-full">
                                        <tr>
                                            <td class="text-blue py-2 border-b"><p>{{ $lang['a'] }}{{ $ss != '' ? '= ' . $ss . ')' : '= x)' }}</p></td>
                                            <td class="py-2 border-b"><b>{{ $detail['a'] }}</b></td>
                                            <td class="p-2 border-b"><b>{{ round($detail['a'] * 100, 4) }}%</b></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><p>{{ $lang['b'] }}{{ $ss != '' ? '< ' . $ss . ')' : '< x)' }}</p></td>
                                            <td class="py-2 border-b"><b>{{ $detail['b'] }}</b></td>
                                            <td class="p-2 border-b"><b>{{ round($detail['b'] * 100, 4) }}%</b></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><p>{{ $lang['b'] }}{{ $ss != '' ? '&#8804; ' . $ss . ')' : '&#8804; x)' }}</p></td>
                                            <td class="py-2 border-b"><b>{{ $detail['c'] }}</b></td>
                                            <td class="p-2 border-b"><b>{{ round($detail['c'] * 100, 4) }}%</b></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><p>{{ $lang['b'] }}{{ $ss != '' ? '> ' . $ss . ')' : '> x)' }}</p></td>
                                            <td class="py-2 border-b"><b>{{ $detail['d'] }}</b></td>
                                            <td class="p-2 border-b"><b>{{ round($detail['d'] * 100, 4) }}%</b></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b"><p>{{ $lang['b'] }}{{ $ss != '' ? '&#8805; ' . $ss . ')' : '&#8805; x)' }}</p></td>
                                            <td class="py-2 border-b"><b>{{ $detail['e'] }}</b></td>
                                            <td class="p-2 border-b"><b>{{ round($detail['e'] * 100, 4) }}%</b></td>
                                        </tr>
                                    </table>
                                </div>
                            @else
                                <div class="w-full mt-2 overflow-auto">
                                    <table class="w-full">
                                        <tr>
                                            <td class="py-2 border-b"><b>x</b></td>
                                            <td class="py-2 border-b"><b>{{ $lang['geo'] }}</b></td>
                                            <td class="py-2 border-b"><b>{{ $lang['geo'] }} %</b></td>
                                        </tr>
                                        {!! $detail['table'] !!}
                                    </table>
                                </div>
                            @endif
                            <p class="col-12 overflow-auto mt-4 text-blue">Your Input: \( N = {{ $p }}, K = {{ $sp }}, n = {{ $s }}, k = {{ $ss }}\)</p>
                            <p class="col-12 overflow-auto mt-4"> \( Mean (μ) = n * K/N = {{ $s }} * {{ $sp }}/{{ $p }} \) </p>
                            <p class="col-12 overflow-auto mt-4"> \( = {{ $s * $sp }} / {{ $p }} \) </p>
                            <p class="col-12 overflow-auto mt-4"> \( = {{ $detail['mean'] }}\)</p>
                            <p class="col-12 overflow-auto mt-4"> \( Variance (σ^2) = n * K/N * (N - K)/N * (N - n)/(N - 1) \) </p> 
                            <p class="col-12 overflow-auto mt-4"> \( = {{ $s }} * {{ $sp }}/{{ $p }} * ({{ $p }} - {{ $sp }})/{{ $p }} * ({{ $p }} - {{ $s }})/({{ $p }} - 1) \) </p>
                            <p class="col-12 overflow-auto mt-4"> \( = {{ $s * $sp * ($p - $sp) * ($p - $s) }} / {{ $p * $p * ($p - 1) }} ≈ {{ $detail['variance'] }} \)</p>
                            <p class="col-12 overflow-auto mt-4"> \( \text{Standard deviation} (σ) = \sqrt(n * K/N * (N - K)/N * (N - n)/(N - 1)) \) </p>
                            <p class="col-12 overflow-auto mt-4"> \(= \sqrt({{ $s }} * {{ $sp }}/{{ $p }} * ({{ $p }} - {{ $sp }})/{{ $p }} * ({{ $p }} - {{ $s }})/({{ $p }} - 1)) \) </p>
                            <p class="col-12 overflow-auto mt-4"> \( = \sqrt({{ $s * $sp * ($p - $sp) * ($p - $s) }} / {{ $p * $p * ($p - 1) }}) ≈ {{ $detail['sd'] }} \)</p>
                            <p class="col s12 margin_top_20 mt-4 font_size18"><strong>So, Mean (μ) = {{ $detail['mean'] }} , Variance (σ<sup>2</sup>) ≈ {{ $detail['variance'] }} , Standard deviation (σ) ≈ {{ $detail['sd'] }}</strong></p>
                            
                            <div class="w-full mt-3" 
                                 x-data="{ 
                                    detail: @js($detail),
                                    method: @entangle('method'),
                                    ss: @entangle('ss'),
                                    render() {
                                        if (typeof Highcharts === 'undefined' || !this.detail) return;
                                        
                                        let categories = [];
                                        let data = [];
                                        
                                        if (this.method == '1') {
                                            categories = ['P(X = ' + this.ss + ')','P(X < ' + this.ss + ')','P(X ≤ ' + this.ss + ')','P(X ≥ ' + this.ss + ')','P(X > ' + this.ss + ')'];
                                            data = [
                                                parseFloat(this.detail.a), 
                                                parseFloat(this.detail.b), 
                                                parseFloat(this.detail.c), 
                                                parseFloat(this.detail.e), 
                                                parseFloat(this.detail.d)
                                            ];
                                        } else {
                                            if (this.detail.xval) {
                                                categories = this.detail.xval.split(',').map(v => v.trim());
                                            }
                                            if (this.detail.chart) {
                                                data = this.detail.chart.split(',').map(v => parseFloat(v.trim()));
                                            }
                                        }

                                        Highcharts.chart($refs.canvas, {
                                            chart: { type: 'column' },
                                            title: { text: null },
                                            xAxis: {
                                                categories: categories,
                                                title: { text: 'x' }
                                            },
                                            yAxis: { title: { text: 'P(X=x)' } },
                                            tooltip: { crosshairs: true, shared: true },
                                            credits: { enabled: false },
                                            legend: { enabled: false },
                                            series: [{
                                                name: 'P(X=x) = ',
                                                data: data
                                            }]
                                        });
                                    }
                                 }" 
                                 x-init="render()"
                                 @render-chart.window="detail = $event.detail; render()"
                                 wire:ignore>
                                <div x-ref="canvas" style="height:350px;" class="w-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>

@push('calculatorJS')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/katex.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/katex.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.11/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>

    <script>
        function renderMath() {
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
            if (typeof MathJax !== 'undefined' && typeof MathJax.typeset === 'function') {
                MathJax.typeset();
            }
        }

        window.addEventListener('render-math', renderMath);

        document.addEventListener('livewire:navigated', () => {
            renderMath();
            window.dispatchEvent(new CustomEvent('render-chart', { detail: @json($detail ?? null) }));
        });
    </script>
@endpush
