<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 mt-3 gap-4">
                    <div class="space-y-2">
                        <label for="seprateby" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-full py-2 position-relative">
                            <select wire:model.live="seprateby" id="seprateby" class="input">
                                <option value="space">{{ $lang['2'] }}</option>
                                <option value=",">{{ $lang['3'] }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="textarea" class="font-s-14 text-blue">{{ $lang['5'] }}:</label>
                        <div class="w-100 py-2">
                            <textarea wire:model.live="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 3, 8, 10, 17, 24, 27"></textarea>
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
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="col">
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang[7] }}:</td>
                                            <td class="py-2 border-b"><strong class="text-blue">
                                                {{ implode(' , ', $detail['numbers']) }}
                                            </strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang[8] }}:</td>
                                            <td class="py-2 border-b"><strong class="text-blue">
                                                @php
                                                    $sortedNumbers = $detail['numbers'];
                                                    rsort($sortedNumbers);
                                                @endphp
                                                {{ implode(' , ', $sortedNumbers) }}
                                            </strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang[9] }}:</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ max($detail['numbers']) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang[10] }}:</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ min($detail['numbers']) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang[11] }}:</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ $detail['third'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang[12] }}:</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ $detail['first'] }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b">{{ $lang[13] }}:</td>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ $detail['median'] }}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full overflow-auto" wire:ignore>
                                    <div class="w-full mt-3" id="chartContainer" 
                                        x-data="{
                                            chart: null,
                                            init() {
                                                const options = {
                                                    series: [{
                                                        name: 'box',
                                                        type: 'boxPlot',
                                                        data: [{
                                                            x: 'Box Plot',
                                                            y: [{{ min($detail['numbers']) }}, {{ $detail['first'] }}, {{ $detail['median'] }}, {{ $detail['third'] }}, {{ max($detail['numbers']) }}]
                                                        }]
                                                    }],
                                                    chart: {
                                                        type: 'boxPlot',
                                                        height: 350,
                                                        toolbar: { show: true }
                                                    },
                                                    colors: ['#2845F5', '#FEB019'],
                                                    title: {
                                                        text: 'Box and Whisker Plot',
                                                        align: 'left',
                                                        style: { fontSize: '18px', color: '#2845F5' }
                                                    },
                                                    xaxis: { type: 'category' },
                                                    tooltip: { shared: false, intersect: true }
                                                };
                                                this.chart = new ApexCharts(this.$el, options);
                                                this.chart.render();

                                                window.addEventListener('chart-updated', (e) => {
                                                    const data = e.detail;
                                                    this.chart.updateSeries([{
                                                        data: [{
                                                            x: 'Box Plot',
                                                            y: [data.min, data.first, data.median, data.third, data.max]
                                                        }]
                                                    }]);
                                                });
                                            }
                                        }">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @endpush
</div>
