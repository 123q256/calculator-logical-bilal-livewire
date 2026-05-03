<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-3 gap-4">
                    <div class="space-y-2">
                        <label for="income_type" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Income Type' }}:</label>
                        <div class="w-full py-2 relative">
                            <select class="input" wire:model.live="income_type" id="income_type" style="cursor: pointer;">
                                <option value="Salary">{{ $lang['2'] ?? 'Salary' }}</option>
                                <option value="Bonus">{{ $lang['3'] ?? 'Bonus' }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="pay_frequency" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Pay Frequency' }}:</label>
                        <div class="w-full py-2 relative">
                            <select class="input" wire:model.live="pay_frequency" id="pay_frequency" style="cursor: pointer;">
                                <option value="Daily">{{ $lang['5'] ?? 'Daily' }}</option>
                                <option value="Weekly">{{ $lang['6'] ?? 'Weekly' }}</option>
                                <option value="Bi-Weekly">{{ $lang['7'] ?? 'Bi-Weekly' }}</option>
                                <option value="Semi-Monthly">{{ $lang['8'] ?? 'Semi-Monthly' }}</option>
                                <option value="Monthly">{{ $lang['9'] ?? 'Monthly' }}</option>
                                <option value="Quarterly">{{ $lang['10'] ?? 'Quarterly' }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label for="filer_status" class="font-s-14 text-blue">{{ $lang['31'] ?? 'Filer Status' }}:</label>
                        <div class="w-full py-2 relative">
                            <select class="input" wire:model.live="filer_status" id="filer_status" style="cursor: pointer;">
                                <option value="single">{{ $lang['32'] ?? 'Single' }}</option>
                                <option value="married-jointly">{{ $lang['33'] ?? 'Married Jointly' }}</option>
                                <option value="married-separately">{{ $lang['34'] ?? 'Married Separately' }}</option>
                                <option value="head">{{ $lang['35'] ?? 'Head of Household' }}</option>
                            </select>
                        </div>
                    </div>
                    @if($income_type === 'Salary')
                        <div class="space-y-2 pay_method">
                            <label for="pay_method" class="font-s-14 text-blue">{{ $lang['11'] ?? 'Pay Method' }}:</label>
                            <div class="w-full py-2 relative">
                                <select class="input" wire:model.live="pay_method" id="pay_method" style="cursor: pointer;">
                                    <option value="Per-Period">{{ $lang['12'] ?? 'Per Period' }}</option>
                                    <option value="Per-Year">{{ $lang['13'] ?? 'Per Year' }}</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="space-y-2">
                        <label for="amount" class="font-s-14 text-blue">{{ $lang['14'] ?? 'Amount' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="amount" id="amount" class="input" aria-label="amount" placeholder="10000" />
                            <span class="text-blue input_unit">{{ $currency }}</span>
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

        <hr>
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="col-12 px-2 font-s-20">
                                <div class="col">
                                    <div class="col-12 text-[16px]">
                                        <table class="w-full">
                                            <tr>
                                                <td class="py-2 border-b"><strong>{{ $lang[21] ?? 'Tax Year 2024' }}</strong>
                                                    <sub>
                                                        @if ($detail['filer_status'] == 'single')
                                                            {{ $lang[32] ?? 'Single' }}
                                                        @elseif($detail['filer_status'] == 'married-jointly')
                                                            {{ $lang[33] ?? 'Married Jointly' }}
                                                        @elseif($detail['filer_status'] == 'married-separately')
                                                            {{ $lang[34] ?? 'Married Separately' }}
                                                        @elseif($detail['filer_status'] == 'head')
                                                            {{ $lang[35] ?? 'Head of Household' }}
                                                        @endif
                                                    </sub>
                                                </td>
                                                <td class="py-2 border-b"><strong>{{ $lang[22] ?? 'Tax Rate' }}(%)</strong></td>
                                                <td class="py-2 border-b"><strong>
                                                        @if ($detail['pay_frequency'] == 'Daily')
                                                            {{ $lang[5] ?? 'Daily' }}
                                                        @elseif($detail['pay_frequency'] == 'Weekly')
                                                            {{ $lang[6] ?? 'Weekly' }}
                                                        @elseif($detail['pay_frequency'] == 'Bi-Weekly')
                                                            {{ $lang[7] ?? 'Bi-Weekly' }}
                                                        @elseif($detail['pay_frequency'] == 'Semi-Monthly')
                                                            {{ $lang[8] ?? 'Semi-Monthly' }}
                                                        @elseif($detail['pay_frequency'] == 'Monthly')
                                                            {{ $lang[9] ?? 'Monthly' }}
                                                        @elseif($detail['pay_frequency'] == 'Quarterly')
                                                            {{ $lang[10] ?? 'Quarterly' }}
                                                        @endif
                                                    </strong>
                                                </td>
                                                <td class="py-2 border-b"><strong>{{ $lang[23] ?? 'Yearly' }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $income_type == 'Salary' ? ($lang[24] ?? 'Salary') : ($lang[25] ?? 'Bonus') }}</td>
                                                <td class="py-2 border-b">&nbsp;</td>
                                                <td class="py-2 border-b"><strong>{{ $currency }} {{ $detail['per_frequency'] }}</strong></td>
                                                <td class="py-2 border-b"><strong>{{ $currency }} {{ $detail['total_amount'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[26] ?? 'Federal Income Tax' }}</td>
                                                <td class="py-2 border-b">{{ $detail['tax_per'] }}%</td>
                                                <td class="py-2 border-b"><strong>{{ $currency }} {{ $detail['tax_amount_frequency'] }}</strong></td>
                                                <td class="py-2 border-b"><strong>{{ $currency }} {{ $detail['tax_amount_yearly'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[27] ?? 'Social Security' }}</td>
                                                <td class="py-2 border-b">{{ $detail['secrity_per'] }}%</td>
                                                <td class="py-2 border-b"><strong>{{ $currency }} {{ $detail['secrity_amount_frequency'] }}</strong></td>
                                                <td class="py-2 border-b"><strong>{{ $currency }} {{ $detail['secrity_amount_yearly'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $lang[28] ?? 'Medicare' }} </td>
                                                <td class="py-2 border-b"> {{ $detail['medicare_per'] }}%</td>
                                                <td class="py-2 border-b"><strong>{{ $currency }} {{ $detail['medicare_amount_frequency'] }}</strong></td>
                                                <td class="py-2 border-b"><strong>{{ $currency }} {{ $detail['medicare_amount_yearly'] }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b">{{ $income_type == 'Salary' ? ($lang[29] ?? 'Net Salary') : ($lang[30] ?? 'Net Bonus') }}</td>
                                                <td class="py-2 border-b">&nbsp;</td>
                                                <td class="py-2 border-b">{{ $currency }} <strong>{{ $detail['net_frequency_amount'] }}</strong></td>
                                                <td class="py-2 border-b">{{ $currency }} <strong>{{ $detail['yearly_net_income'] }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <p class=" my-2">
                                            @if ($detail['pay_frequency'] == 'Daily')
                                                {{ $lang[15] ?? 'Daily Net Income' }}
                                            @elseif($detail['pay_frequency'] == 'Weekly')
                                                {{ $lang[16] ?? 'Weekly Net Income' }}
                                            @elseif($detail['pay_frequency'] == 'Bi-Weekly')
                                                {{ $lang[17] ?? 'Bi-Weekly Net Income' }}
                                            @elseif($detail['pay_frequency'] == 'Semi-Monthly')
                                                {{ $lang[18] ?? 'Semi-Monthly Net Income' }}
                                            @elseif($detail['pay_frequency'] == 'Monthly')
                                                {{ $lang[19] ?? 'Monthly Net Income' }}
                                            @elseif($detail['pay_frequency'] == 'Quarterly')
                                                {{ $lang[20] ?? 'Quarterly Net Income' }}
                                            @endif
                                            {{ $currency }} <strong>{{ $detail['net_frequency_amount'] }}</strong>
                                        </p>
                                        <div class="w-full mt-8" 
                                             x-data='{ 
                                                chartData: {!! json_encode($detail["chartData"]) !!},
                                                chartInstance: null,
                                                render() {
                                                    if (typeof Highcharts === "undefined") {
                                                        setTimeout(() => this.render(), 200);
                                                        return;
                                                    }
                                                    
                                                    if (this.chartInstance) {
                                                        this.chartInstance.series[0].setData(this.chartData);
                                                        return;
                                                    }

                                                    this.chartInstance = Highcharts.chart($refs.canvas, {
                                                        chart: { type: "pie", backgroundColor: "transparent" },
                                                        title: { text: "Income Distribution", align: "left", style: { color: "#2845F5", fontWeight: "bold" } },
                                                        tooltip: { pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>" },
                                                        accessibility: { point: { valueSuffix: "%" } },
                                                        plotOptions: {
                                                            pie: {
                                                                allowPointSelect: true,
                                                                cursor: "pointer",
                                                                dataLabels: {
                                                                    enabled: true,
                                                                    format: "<b>{point.name}</b>: {point.percentage:.1f} %"
                                                                },
                                                                showInLegend: true
                                                            }
                                                        },
                                                        series: [{
                                                            name: "Percentage",
                                                            colorByPoint: true,
                                                            data: this.chartData
                                                        }],
                                                        credits: { enabled: false }
                                                    });
                                                }
                                             }' 
                                             x-init="render()"
                                             @chart-updated.window="chartData = $event.detail.data; render()"
                                             wire:ignore>
                                            <div x-ref="canvas" class="w-full min-h-[400px]"></div>
                                        </div>
                                    </div>
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
