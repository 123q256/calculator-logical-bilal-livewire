<div>
    <style>
        .cart-h400 { height: 400px; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    @php
                        $scores = [
                            'ten' => '10 😍', 'nine' => '9 😍', 'eight' => '8 😐', 'seven' => '7 😐',
                            'six' => '6 😒', 'five' => '5 😒', 'four' => '4 😒', 'three' => '3 😒',
                            'two' => '2 😒', 'one' => '1 😒', 'zero' => '0 😒'
                        ];
                    @endphp

                    @foreach($scores as $key => $label)
                        <div class="col-span-6">
                            <label for="score_{{ $key }}" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Score' }} {{ $label }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="score_{{ $key }}" id="score_{{ $key }}" class="input" aria-label="score_{{ $key }}" placeholder="10" />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        <hr>

        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full">
                            <div class="w-full mt-3">
                                <div class="row">
                                    <div class="w-full lg:w-[80%] overflow-auto mt-5">
                                        <table class="w-full text-[18px]">
                                            <tr>
                                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[2] }} (NPS)</strong></td>
                                                <td class="py-2 border-b"> {{ round($detail['answer'], 4) + 0 }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }}
                                                        ({{ $lang[4] }} 😍)</strong></td>
                                                <td class="py-2 border-b"> {{ $detail['good'] + 0 }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[5] }}
                                                        ({{ $lang[6] }} 😐)</strong></td>
                                                <td class="py-2 border-b"> {{ $detail['neutral'] + 0 }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[7] }}
                                                        ({{ $lang[8] }} 😐)</strong></td>
                                                <td class="py-2 border-b"> {{ $detail['bad'] + 0 }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="70%"><strong>{{ $lang[9] }}</strong></td>
                                                <td class="py-2 border-b"> {{ $detail['total'] + 0 }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="w-full font-s-16">
                                        <p class="mt-3"><strong>{{ $lang[10] }}</strong></p>
                                        <p class="mt-2">{{ $lang[11] }}.</p>
                                        <p class="mt-2">{{ $lang[9] }}= {{ $lang[1] }} 10 + {{ $lang[1] }} 9 +
                                            {{ $lang[1] }} 8 + {{ $lang[1] }} 7 + {{ $lang[1] }} 6 + {{ $lang[1] }}
                                            5 + {{ $lang[1] }} 4 + {{ $lang[1] }} 3 + {{ $lang[1] }} 2 +
                                            {{ $lang[1] }} 1 + {{ $lang[1] }} 0 </p>
                                        <p class="mt-2">{{ $lang[9] }}= {{ $score_ten + 0 }} + {{ $score_nine + 0 }}
                                            + {{ $score_eight + 0 }} + {{ $score_seven + 0 }} + {{ $score_six + 0 }} +
                                            {{ $score_five + 0 }} + {{ $score_four + 0 }} + {{ $score_three + 0 }} +
                                            {{ $score_two + 0 }} + {{ $score_one + 0 }} + {{ $score_zero + 0 }} </p>
                                        <p class="mt-2 text-blue-700 font-bold">{{ $lang[9] }}= {{ $detail['total'] + 0 }} </p>
                                        <p class="mt-2">{{ $lang[12] }}.</p>
                                        <p class="mt-2">{{ $lang[3] }}= {{ $lang[1] }} 10 + {{ $lang[1] }} 9</p>
                                        <p class="mt-2">{{ $lang[3] }}= {{ $score_ten + 0 }} + {{ $score_nine + 0 }}
                                        </p>
                                        <p class="mt-2 text-blue-700 font-bold">{{ $lang[3] }}= {{ $detail['good'] + 0 }}</p>
                                        <p class="mt-2">{{ $lang[13] }}.</p>
                                        <p class="mt-2">{{ $lang[5] }}= {{ $lang[1] }} 8 + {{ $lang[1] }} 7</p>
                                        <p class="mt-2">{{ $lang[5] }}= {{ $score_eight + 0 }} +
                                            {{ $score_seven + 0 }}</p>
                                        <p class="mt-2 text-blue-700 font-bold">{{ $lang[5] }}= {{ $detail['neutral'] + 0 }}</p>
                                        <p class="mt-2">{{ $lang[14] }}.</p>
                                        <p class="mt-2">{{ $lang[7] }}= {{ $lang[1] }} 6 + {{ $lang[1] }} 5 +
                                            {{ $lang[1] }} 4 + {{ $lang[1] }} 3 + {{ $lang[1] }} 2 + {{ $lang[1] }}
                                            1 + {{ $lang[1] }} 0 </p>
                                        <p class="mt-2">{{ $lang[7] }}= {{ $score_six + 0 }} + {{ $score_five + 0 }}
                                            + {{ $score_four + 0 }} + {{ $score_three + 0 }} + {{ $score_two + 0 }} +
                                            {{ $score_one + 0 }} + {{ $score_zero + 0 }}</p>
                                        <p class="mt-2 text-blue-700 font-bold">{{ $lang[7] }}= {{ $detail['bad'] + 0 }}</p>
                                        <p class="mt-2">{{ $lang[15] }} (NPS).</p>
                                        <p class="mt-2 text-blue-600 font-bold">NPS = (% Promoters) - (% Detractors)</p>
                                        <p class="mt-2">{{ $lang[2] }}= ({{ $lang[3] }} / {{ $lang[9] }} -
                                            {{ $lang[7] }} / {{ $lang[9] }}) x 100</p>
                                        <p class="mt-2">{{ $lang[2] }}= ({{ $detail['good'] + 0 }} /
                                            {{ $detail['total'] + 0 }} - {{ $detail['bad'] + 0 }} /
                                            {{ $detail['total'] + 0 }}) x 100</p>
                                        <p class="mt-2 text-xl font-bold orange-text">{{ $lang[2] }}= {{ round($detail['answer'], 4) + 0 }}</p>
                                        <p class="mt-2">{{ $lang[16] }}! 😵</p>
                                    </div>
                                </div>
                                
                                <div class="w-full mt-8" 
                                 x-data='{ 
                                    chartData: {!! $detail["chartData"] !!},
                                    render() {
                                        if (typeof Highcharts === "undefined") {
                                            setTimeout(() => this.render(), 200);
                                            return;
                                        }
                                        Highcharts.chart(this.$refs.canvas, {
                                            chart: { type: "pie", backgroundColor: "transparent" },
                                            title: { text: "{{ $lang[2] }} Distribution", align: "left", style: { color: "#2845F5", fontWeight: "bold" } },
                                            plotOptions: {
                                                pie: {
                                                    allowPointSelect: true,
                                                    cursor: "pointer",
                                                    dataLabels: {
                                                        enabled: true,
                                                        format: "<b>{point.name}</b>: {point.y}"
                                                    }
                                                }
                                            },
                                            series: [{ 
                                                name: "Respondents", 
                                                data: this.chartData, 
                                                colorByPoint: true
                                            }],
                                            credits: { enabled: false },
                                            tooltip: { pointFormat: "{series.name}: <b>{point.y}</b>" },
                                            responsive: { rules: [{ condition: { maxWidth: 500 }, chartOptions: { legend: { layout: "horizontal", align: "center", verticalAlign: "bottom" } } }] }
                                        });
                                    }
                                 }' 
                                 x-init="render()"
                                 @chart-updated.window="chartData = $event.detail; render()"
                                 wire:ignore>
                                <div x-ref="canvas" class="w-full min-h-[400px]"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <script src="https://code.highcharts.com/highcharts.js"></script>
    @endpush
</div>
