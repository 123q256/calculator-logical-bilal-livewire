<div>
    <style>
        .flotr-legend {
            z-index: 1 !important;
        }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="w-full mb-lg-3 mb-2 mt-0 mt-lg-2 flex items-center">
                    <p class="font-s-14 pe-lg-5">To Calculate:</p>
                    <div class="flex items-center mt-lg-0 mt-1 cursor-pointer">
                        <input wire:model.live="form" id="form1" class="cursor-pointer" value="summary" type="radio" />
                        <label for="form1" class="font-s-14 text-blue pe-3 px-1 cursor-pointer">{{ $lang['s_data'] }}</label>
                        <input wire:model.live="form" id="form" class="ms-lg-0 ms-4 cursor-pointer" value="raw" type="radio" />
                        <label for="form" class="font-s-14 text-blue ps-1 cursor-pointer">{{ $lang['r_data'] }}</label>
                    </div>
                </div>

                <div class="grid grid-cols-1 mt-3 gap-4">
                    <div class="w-full" x-show="$wire.form == 'summary'">
                        <div class="grid grid-cols-2 mt-3 gap-4">
                            <div class="space-y-2">
                                <label for="mean" class="font-s-14 text-blue">
                                    {{ $lang['x'] }} {{ $type_r == 1 ? '(x̅)' : '(μ)' }}
                                </label>
                                <div class="w-100 py-2">
                                    <input type="number" step="any" wire:model.live="mean" id="mean" class="input" aria-label="input" placeholder="e.g. 20.75" />
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="deviation" class="font-s-14 text-blue">
                                    {{ $lang['y'] }} {{ $type_r == 1 ? '(s)' : '(σ)' }}
                                </label>
                                <div class="w-100 py-2">
                                    <input type="number" step="any" wire:model.live="deviation" id="deviation" class="input" aria-label="input" placeholder="e.g. 20.75" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full" x-show="$wire.form == 'raw'" x-cloak>
                        <div class="grid grid-cols-1 mt-3 gap-4">
                            <div class="space-y-2">
                                <label for="type_r" class="font-s-14 text-blue">{{ $lang['d_type'] }}</label>
                                <div class="w-100 py-2 position-relative">
                                    <select wire:model.live="type_r" id="type_r" class="input">
                                        <option value="1">{{ $lang['Sample'] }}</option>
                                        <option value="2">{{ $lang['Population'] }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="x" class="font-s-14 text-blue">{{ $lang['enter'] }} ({{ $lang['note_des'] }})</label>
                                <div class="w-100 py-2">
                                    <textarea wire:model.live="x" id="x" class="textareaInput" aria-label="input" placeholder="e.g. 12, 23, 45, 33, 65, 54, 54"></textarea>
                                </div>
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

        @isset($detail)
            <div id="result-section" 
                 x-init="
                    $nextTick(() => {
                        const offset = $el.getBoundingClientRect().top + window.pageYOffset - 100;
                        window.scrollTo({ top: offset, behavior: 'smooth' });
                    });
                 "
                 @render-graph.window="chartData = $event.detail.chartData; render()"
                 wire:loading.remove wire:target="calculate" 
                 class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto">
                                    <table class="w-100">
                                        <tr>
                                            <td class="py-2 border-b">68% {{ $lang['ans'] }}</td>
                                            <td class="py-2 border-b"><b class="text-[#2845F5]">{!! $detail['first'] !!}</b></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">95% {{ $lang['ans'] }}</td>
                                            <td class="py-2 border-b"><b class="text-[#2845F5]">{!! $detail['second'] !!}</b></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">99.7% {{ $lang['ans'] }}</td>
                                            <td class="py-2 border-b"><b class="text-[#2845F5]">{!! $detail['third'] !!}</b></td>
                                        </tr>
                                        @if ($form == 'raw')
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang['b'] }}</td>
                                                <td class="py-2 border-b"><b class="text-[#2845F5]">{{ $detail['mean'] }}</b></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang['c'] }}</td>
                                                <td class="py-2 border-b"><b class="text-[#2845F5]">{{ $detail['devi'] }}</b></td>
                                            </tr>
                                        @endif
                                        @if (isset($detail['count']))
                                            <tr>
                                                <td class="py-2 border-b">Total Numbers:</td>
                                                <td class="py-2 border-b"><b class="text-[#2845F5]">{{ $detail['count'] }}</b></td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                                <p class="w-full mt-1 font-s-18 text-blue"><strong>To further divide up the percentages of the bell curve:</strong></p>
                                <ul class="w-full ps-3">
                                    <li class="mt-1 ms-1">2.35% of data will be between {{ round($detail['mean'] - ($detail['devi'] * 3), 2) }} & {{ round($detail['mean'] - ($detail['devi'] * 2), 2) }}</li>
                                    <li class="mt-1 ms-1">13.5% of data will be between {{ round($detail['mean'] - ($detail['devi'] * 2), 2) }} & {{ round($detail['mean'] - $detail['devi'], 2) }}</li>
                                    <li class="mt-1 ms-1">34% of data will be between {{ round($detail['mean'] - $detail['devi'], 2) }} & {{ round($detail['mean'], 2) }}</li>
                                    <li class="mt-1 ms-1">34% of data will be between {{ round($detail['mean'], 2) }} & {{ round($detail['mean'] + $detail['devi'], 2) }}</li>
                                    <li class="mt-1 ms-1">13.5% of data will be between {{ round($detail['mean'] + $detail['devi'], 2) }} & {{ round($detail['mean'] + ($detail['devi'] * 2), 2) }}</li>
                                    <li class="mt-1 ms-1">2.35% of data will be between {{ round($detail['mean'] + ($detail['devi'] * 2), 2) }} & {{ round($detail['mean'] + ($detail['devi'] * 3), 2) }}</li>
                                </ul>
                        <div class="w-full mt-8" 
                             x-data="{ 
                                chartData: @json($detail['chartData']),
                                render() {
                                    if (typeof Highcharts === 'undefined') {
                                        setTimeout(() => this.render(), 200);
                                        return;
                                    }
                                    Highcharts.chart($refs.canvas, {
                                        chart: { type: 'area', backgroundColor: 'transparent' },
                                        title: { text: 'Empirical Rule (Bell Curve)', align: 'left', style: { color: '#2845F5', fontWeight: 'bold' } },
                                        xAxis: { type: 'linear', title: { text: 'Values' }, gridLineWidth: 1 },
                                        yAxis: { title: { text: 'Probability Density' }, gridLineWidth: 1 },
                                        series: [{ 
                                            name: 'Normal Distribution', 
                                            data: this.chartData, 
                                            color: '#2845F5',
                                            fillColor: {
                                                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                                                stops: [
                                                    [0, 'rgba(40, 69, 245, 0.3)'],
                                                    [1, 'rgba(40, 69, 245, 0)']
                                                ]
                                            },
                                            lineWidth: 2,
                                            marker: { enabled: false }
                                        }],
                                        credits: { enabled: false },
                                        tooltip: { headerFormat: '<b>x: {point.x}</b><br/>', pointFormat: 'y: {point.y}' },
                                        responsive: { rules: [{ condition: { maxWidth: 500 }, chartOptions: { legend: { layout: 'horizontal', align: 'center', verticalAlign: 'bottom' } } }] }
                                    });
                                }
                             }" 
                             x-init="render()"
                             @render-graph.window="chartData = $event.detail.chartData; render()"
                             wire:ignore>
                            <div x-ref="canvas" class="w-full min-h-[400px]"></div>
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
    <script src="https://code.highcharts.com/highcharts.js"></script>
@endpush
