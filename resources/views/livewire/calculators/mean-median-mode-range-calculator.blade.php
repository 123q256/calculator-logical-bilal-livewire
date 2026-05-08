<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
                    
            <div class="space-y-2 raw_mean">
                <label for="x" class="font-s-14 text-blue">{!! $lang['x'] !!}</label>
                <div class="w-100 py-2">
                    <textarea wire:model.live="x" id="x" class="textareaInput h-[130px]" aria-label="input" placeholder="7,1,6,2,11,3,4,5,2
3 4 5 9 7 5
5
8"></textarea>
                </div>
        </div>

                      
         </div>
    </div>
    @if ($type == 'calculator')
    @include('inc.button')
    @endif
    @if ($type=='widget')
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
                    <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3">
                        <div class="space-y-2 p-2">
                            <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3">
                                <span class="font-s-18">{{ $lang['ave'] }}</span>
                                <strong class="text-[#119154] text-[22px] ps-2">{{ $detail['average'] }}</strong>
                            </div>
                        </div>
                        <div class="space-y-2 p-2">
                            <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3">
                                <span class="font-s-18">{{ $lang['med'] }}</span>
                                <strong class="text-[#119154] text-[22px] ps-2">{{ $detail['median'] }}</strong>
                            </div>
                        </div>
                        <div class="space-y-2 p-2">
                            <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3">
                                <span class="font-s-18">{{ $lang['mode'] }}</span>
                                <strong class="text-[#119154] text-[22px] ps-2">
                                    {{ implode(' , ', $detail['mode']) }}
                                </strong>
                            </div>
                        </div>
                        <div class="space-y-2 p-2">
                            <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3">
                                <span class="font-s-18">{{ $lang['range'] }}</span>
                                <strong class="text-[#119154] text-[22px] ps-2">{{ max($detail['numbers']) - min($detail['numbers']) }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-2 px-2">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['geo'] }}:</td>
                                    <td class="py-2 border-b"><strong>{{ round(pow(array_product($detail['numbers']), (1/$detail['count'])), 4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['ao'] }}:</td>
                                    <td class="py-2 border-b"><strong>{{ implode(' , ', $detail['numbers']) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['do'] }}:</td>
                                    <td class="py-2 border-b"><strong>
                                        @php
                                            $descNumbers = $detail['numbers'];
                                            rsort($descNumbers);
                                            echo implode(' , ', $descNumbers);
                                        @endphp
                                    </strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['sum'] }}:</td>
                                    <td class="py-2 border-b"><strong>{{ array_sum($detail['numbers']) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">Lower quartile (Q1):</td>
                                    <td class="py-2 border-b"><strong>{{ $detail['Q1'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">Upper quartile (Q3):</td>
                                    <td class="py-2 border-b"><strong>{{ $detail['Q3'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">Interquartile range (IQR):</td>
                                    <td class="py-2 border-b"><strong>{{ $detail['IQR'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['max'] }}:</td>
                                    <td class="py-2 border-b"><strong>{{ max($detail['numbers']) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['min'] }}:</td>
                                    <td class="py-2 border-b"><strong>{{ min($detail['numbers']) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2">{{ $lang['count'] }}:</td>
                                    <td class="py-2"><strong>{{ count($detail['numbers']) }}</strong></td>
                                </tr>
                            </table>
                        </div>
                        <div class="border radius-5 font-s-18 p-4 bg-white mt-2">
                            <p><i class="text-blue">Reporting in APA style</i></p>
                            <p>M = {{ $detail['average'] }}</p>
                            <p>Mdn = {{ $detail['median'] }}</p>
                            <p>IQR = {{ $detail['Q1'] }} - {{ $detail['Q3'] }}, IQR = {{ $detail['IQR'] }}</p>
                        </div>
                        
                        <div class="w-full mt-3" 
                             x-data='{ 
                                detail: @json($detail),
                                render(newDetail) {
                                    if (newDetail) this.detail = newDetail;
                                    
                                    if (typeof Highcharts === "undefined" || typeof Highcharts.chart !== "function") {
                                        setTimeout(() => this.render(), 200);
                                        return;
                                    }
                                    
                                    if (!this.detail || !this.detail.numbers) return;

                                    // Bar Chart
                                    Highcharts.chart(this.$refs.barChart, {
                                        chart: { type: "column", backgroundColor: "transparent" },
                                        title: { text: "Mean, Median, and Mode", style: { color: "#2845F5", fontWeight: "bold" } },
                                        xAxis: { categories: [...this.detail.numbers.map(n => n.toString()), "Mean", "Median", ...this.detail.mode.map(m => "Mode ("+m+")")] },
                                        yAxis: { title: { text: "Value" } },
                                        series: [{
                                            name: "Values",
                                            data: [
                                                ...this.detail.numbers.map(n => ({ y: parseFloat(n), color: "#2845F5" })),
                                                { y: parseFloat(this.detail.average), color: "#FFA500" },
                                                { y: parseFloat(this.detail.median), color: "#FF0000" },
                                                ...this.detail.mode.map(m => ({ y: parseFloat(m), color: "#008000" }))
                                            ]
                                        }],
                                        credits: { enabled: false }
                                    });

                                    // Box Plot
                                    Highcharts.chart(this.$refs.boxPlot, {
                                        chart: { type: "boxplot", backgroundColor: "transparent" },
                                        title: { text: "Box and Whisker Plot", style: { color: "#2845F5", fontWeight: "bold" } },
                                        xAxis: { categories: ["Data Set"], title: { text: null } },
                                        yAxis: { title: { text: "Values" } },
                                        series: [{
                                            name: "Distribution",
                                            data: [
                                                [
                                                    Math.min(...this.detail.numbers.map(n => parseFloat(n))), 
                                                    parseFloat(this.detail.Q1), 
                                                    parseFloat(this.detail.median), 
                                                    parseFloat(this.detail.Q3), 
                                                    Math.max(...this.detail.numbers.map(n => parseFloat(n)))
                                                ]
                                            ],
                                            tooltip: { headerFormat: "<em>{point.key}</em><br/>" }
                                        }],
                                        credits: { enabled: false }
                                    });
                                }
                             }' 
                             x-init="render()"
                             @render-graph.window="render($event.detail)"
                             wire:ignore>
                            <div class="grid grid-cols-1 gap-8 mt-6">
                                <div x-ref="barChart" class="w-full min-h-[400px]" style="display: block; width: 100%;"></div>
                                <div x-ref="boxPlot" class="w-full min-h-[400px]" style="display: block; width: 100%;"></div>
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
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
@endpush

</div>
