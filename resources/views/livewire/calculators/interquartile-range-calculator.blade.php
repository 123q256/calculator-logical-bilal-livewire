<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-4">
                <div class="col-span-8 px-2">
                    <label for="seprateby" class="font-s-14 text-blue">{{ $lang['by'] ?? 'Separate By' }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="seprateby" id="seprateby" class="input" wire:model.live="seprateby">
                            <option value="space">{{ $lang['space'] ?? 'Space' }}</option>
                            <option value=",">{{ $lang['coma'] ?? 'Comma' }}</option>
                            <option value="user">{{ $lang['user'] ?? 'User Define' }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-4 px-2">
                    <label for="seprate" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2">
                        <input type="text" name="seprate" id="seprate" class="input readonly" aria-label="input" placeholder=" " wire:model.live="seprate" {{ $seprateby != 'user' ? 'readonly' : '' }} />
                    </div>
                </div>
                <div class="col-span-12 px-2">
                    <label for="textarea" class="font-s-14 text-blue">{{ $lang['enter'] ?? 'Enter Numbers' }}:</label>
                    <div class="w-100 py-2">
                        <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 55 62 35 32 50 57 54" wire:model.live="x"></textarea>
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="row">
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{ $lang['iqr'] ?? 'Interquartile Range' }} (IQR)</strong></p>
                        <div class="flex justify-center">

                            <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                <strong class="text-white">{{ $detail['iter'] }}</strong>
                            </p>
                        </div>
                    </div>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-2 px-lg-2 px-0">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['qu'] ?? 'Quartile' }} Q1:</td>
                                    <td class="py-2 border-b"><strong>{{ $detail['first'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['qu'] ?? 'Quartile' }} Q2:</td>
                                    <td class="py-2 border-b"><strong>{{ $detail['second'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['qu'] ?? 'Quartile' }} Q3:</td>
                                    <td class="py-2 border-b"><strong>{{ $detail['third'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['ave'] ?? 'Average' }}:</td>
                                    <td class="py-2 border-b"><strong>{{ $detail['average'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['geo'] ?? 'Geometric Mean' }}:</td>
                                    <td class="py-2 border-b"><strong>{{ round(pow(array_product($detail['numbers']), (1/$detail['count'])),4) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['sum'] ?? 'Sum' }}:</td>
                                    <td class="py-2 border-b"><strong>{{ array_sum($detail['numbers']) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['psd'] ?? 'Population Standard Deviation' }}:</td>
                                    <td class="py-2 border-b"><strong>{{ $detail['s_d_p'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['ssd'] ?? 'Sample Standard Deviation' }}:</td>
                                    <td class="py-2 border-b"><strong>{{ $detail['s_d_s'] }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['range'] ?? 'Range' }}:</td>
                                    <td class="py-2 border-b"><strong>{{ max($detail['numbers']) - min($detail['numbers']) }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['count'] ?? 'Count' }}:</td>
                                    <td class="py-2 border-b"><strong>{{ count($detail['numbers']) }}</strong></td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full overflow-auto"
                             x-data='{
                                detail: @json($detail),
                                lang: @json($lang),
                                render(newDetail) {
                                    if (newDetail) this.detail = newDetail;

                                    if (typeof Highcharts === "undefined" || typeof Highcharts.chart !== "function") {
                                        setTimeout(() => this.render(), 200);
                                        return;
                                    }

                                    if (!this.detail || !this.detail.numbers) return;

                                    const minX = Math.min(...this.detail.numbers.map(n => parseFloat(n))) - 1;
                                    const maxX = Math.max(...this.detail.numbers.map(n => parseFloat(n))) + 1;
                                    const quLang = this.lang && this.lang.qu ? this.lang.qu : "Q";

                                    Highcharts.chart(this.$refs.iqrChart, {
                                        chart: { type: "line", backgroundColor: "transparent", zoomType: "xy" },
                                        title: { text: "Quartiles Distribution", style: { color: "#2845F5", fontWeight: "bold" } },
                                        xAxis: { min: minX, max: maxX },
                                        yAxis: { 
                                            title: { text: "" },
                                            min: 0,
                                            max: 2,
                                            labels: { enabled: false },
                                            gridLineWidth: 0
                                        },
                                        plotOptions: {
                                            line: {
                                                lineWidth: 4,
                                                marker: { enabled: true, radius: 4 }
                                            }
                                        },
                                        series: [
                                            {
                                                name: quLang + " Q1 (" + this.detail.a1 + " - " + this.detail.first + ")",
                                                data: [[parseFloat(this.detail.a1), 1], [parseFloat(this.detail.first), 1]],
                                                color: "#fda400"
                                            },
                                            {
                                                name: quLang + " Q2 (" + this.detail.first + " - " + this.detail.second + ")",
                                                data: [[parseFloat(this.detail.first), 1], [parseFloat(this.detail.second), 1]],
                                                color: "#0081B0"
                                            },
                                            {
                                                name: quLang + " Q3 (" + this.detail.second + " - " + this.detail.third + ")",
                                                data: [[parseFloat(this.detail.second), 1], [parseFloat(this.detail.third), 1]],
                                                color: "#9ccc65"
                                            },
                                            {
                                                name: quLang + " Q4 (" + this.detail.third + " - " + this.detail.a2 + ")",
                                                data: [[parseFloat(this.detail.third), 1], [parseFloat(this.detail.a2), 1]],
                                                color: "#795548"
                                            }
                                        ],
                                        legend: { layout: "vertical", align: "center", verticalAlign: "bottom" },
                                        credits: { enabled: false },
                                        exporting: { enabled: true }
                                    });
                                }
                             }'
                             x-init="render()"
                             @render-graph.window="render($event.detail)"
                             wire:ignore>
                            <div x-ref="iqrChart" class="w-full mt-3" style="height: 400px; display: block; width: 100%;"></div>
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
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
@endpush
</div>
