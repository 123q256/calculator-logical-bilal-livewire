<div>
<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  gap-4">
                <div class="space-y-2">
                    <label for="seprateby" class="font-s-14 text-blue">{{ $lang['by'] ?? 'Separate By' }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="seprateby" id="seprateby" class="input" wire:model.live="seprateby">
                            <option value="space">{{ $lang['space'] ?? 'Space' }}</option>
                            <option value=",">{{ $lang['coma'] ?? 'Comma' }}</option>
                        </select>
                    </div>
                </div>
                <div class="space-y-2 hidden">
                    <label for="seprate" class="font-s-14 text-blue">&nbsp;</label>
                    <div class="w-100 py-2">
                        <input type="text" name="seprate" id="seprate" class="input readonly" aria-label="input" placeholder=" " wire:model.live="seprate" {{ $seprateby != 'other' ? 'readonly' : '' }} />
                    </div>
                </div>
                <div class="space-y-2 raw_mean">
                    <label for="textarea" class="font-s-14 text-blue">{{ $lang['enter'] ?? 'Enter Numbers' }}:</label>
                    <div class="w-100 py-2">
                        <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 12 32 12 33 4 21" wire:model.live="x"></textarea>
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
                    <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2 mt-3  gap-2">
                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3">
                                <span class="font-s-18">{{ $lang['qu'] ?? 'Quartile' }} Q1</span>
                                <strong class="text-green text-[25px] ps-2">{{ $detail['first'] }}</strong>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3">
                                <span class="font-s-18">{{ $lang['qu'] ?? 'Quartile' }} Q2</span>
                                <strong class="text-green text-[25px] ps-2">{{ $detail['second'] }}</strong>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3">
                                <span class="font-s-18">{{ $lang['qu'] ?? 'Quartile' }} Q3</span>
                                <strong class="text-green text-[25px] ps-2">{{ $detail['third'] }}</strong>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center justify-between bg-[#F6FAFC] border rounded-lg p-3">
                                <span class="font-s-18">{{ $lang['iqr'] ?? 'Interquartile Range' }} IQR</span>
                                <strong class="text-green text-[25px] ps-2">{{ $detail['iter'] }}</strong>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1   mt-3  gap-4">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 px-2">
                            <table class="w-full font-s-18">
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

                                    Highcharts.chart(this.$refs.quartileChart, {
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
                            <div x-ref="quartileChart" class="w-full mt-3" style="height: 400px; display: block; width: 100%;"></div>
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
