<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 gap-4">
                    <div class="space-y-2">
                        <label for="next_birth" class="font-s-14 text-blue">{{ $lang['dob'] }}:</label>
                        <input type="date" wire:model.live="next_birth" id="next_birth" class="input" aria-label="Date of Birth" />
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
        <div id="result-section">
            @isset($detail)
                <div wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                    <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                        <div class="rounded-lg">
                            <div class="w-full bg-light-blue rounded-[10px] mt-3 p-2 lg:p-2">
                                {{-- Top Section: Key Dates --}}
                                <div class="text-[18px] mb-8">
                                    <table class="w-full">
                                        <tr class="border-b">
                                            <td class="w-[55%] py-3"><strong>{{ $lang['57'] }} :</strong></td>
                                            <td class="py-3 text-gray-700">{{ $detail['nextBirth'] }}</td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-3">
                                                <strong>{{ $lang[59] }} <span class="underline">{{ $lang[60] }}</span> {{ $lang[50] }} :</strong>
                                            </td>
                                            <td class="py-3 text-gray-700">{{ $detail['half_brdy'] }}</td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-3"><strong>{{ $lang[58] }} :</strong></td>
                                            <td class="py-3"><span class="text-gray-900 font-bold">{{ $detail['remDays'] }}</span> {{ $lang['days'] }}</td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-3"><strong>{{ $lang[62] }} :</strong></td>
                                            <td class="py-3"><span class="text-gray-900 font-bold">{{ $detail['next_half_r_days'] }}</span> {{ $lang['days'] }}</td>
                                        </tr>
                                        <tr class="border-b">
                                            <td class="py-3">
                                                <strong>{{ $lang[59] }} <span class="underline">{{ $lang[61] }}</span> {{ $lang[63] }} :</strong>
                                            </td>
                                            <td class="py-3 text-gray-900">
                                                <span class="font-bold text-[22px]">{{ $detail['Age'] }}</span> <span class="text-[16px] text-gray-600">{{ $lang['years'] }}</span>
                                                <span class="font-bold text-[22px] ml-1">{{ $detail['Age_months'] }}</span> <span class="text-[16px] text-gray-600">{{ $lang['months'] }}</span>
                                                <span class="font-bold text-[22px] ml-1">{{ $detail['Age_days'] }}</span> <span class="text-[16px] text-gray-600">{{ $lang['days'] }}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                                {{-- Bottom Section: Split Columns --}}
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
                                    {{-- Left Column: Counts --}}
                                    <div class="text-[18px]">
                                        <table class="w-full">
                                            <tr class="border-b">
                                                <td class="py-3"><strong>{{ $lang['40'] }} :</strong></td>
                                                <td class="py-3 text-right font-bold">{{ array_sum($detail['totalDays']) }}</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="py-2 text-gray-600">Sunday</td>
                                                <td class="py-2 text-right font-bold">{{ $detail['totalDays'][0] }}</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="py-2 text-gray-600">Monday</td>
                                                <td class="py-2 text-right font-bold">{{ $detail['totalDays'][1] }}</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="py-2 text-gray-600">Tuesday</td>
                                                <td class="py-2 text-right font-bold">{{ $detail['totalDays'][2] }}</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="py-2 text-gray-600">Wednesday</td>
                                                <td class="py-2 text-right font-bold">{{ $detail['totalDays'][3] }}</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="py-2 text-gray-600">Thursday</td>
                                                <td class="py-2 text-right font-bold">{{ $detail['totalDays'][4] }}</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="py-2 text-gray-600">Friday</td>
                                                <td class="py-2 text-right font-bold">{{ $detail['totalDays'][5] }}</td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="py-2 text-gray-600">Saturday</td>
                                                <td class="py-2 text-right font-bold">{{ $detail['totalDays'][6] }}</td>
                                            </tr>
                                        </table>
                                    </div>

                                    {{-- Right Column: Chart --}}
                                    <div class="w-full flex items-center justify-center rounded-xl p-2"
                                         x-data="{ 
                                            chartData: {{ $detail['chartData'] }},
                                            render() {
                                                if (typeof Highcharts === 'undefined') {
                                                    setTimeout(() => this.render(), 200);
                                                    return;
                                                }
                                                Highcharts.chart($refs.canvas, {
                                                    chart: { type: 'variablepie', backgroundColor: 'transparent', height: 350 },
                                                    title: false,
                                                    tooltip: {
                                                        headerFormat: '',
                                                        pointFormat: '<span style=&quot;color:{point.color}&quot;>\u25CF</span> <b> {point.name}</b><br/><b>{point.y} times</b>'
                                                    },
                                                    colors: ['#FF2445', '#00A8F1', '#00D2FF', '#00ECA6', '#00AE28','#D5DC23','#FF681C'],
                                                    series: [{
                                                        minPointSize: 10,
                                                        innerSize: '20%',
                                                        zMin: 0,
                                                        name: 'Birthdays',
                                                        data: this.chartData
                                                    }],
                                                    credits: { enabled: false },
                                                    exporting: { enabled: false }
                                                });
                                            }
                                         }" 
                                         x-init="render()"
                                         @chart-updated.window="chartData = JSON.parse($event.detail); render()"
                                         wire:ignore>
                                        <div x-ref="canvas" class="w-full"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </form>
</div>

@push('calculatorJS')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    <script src="https://code.highcharts.com/modules/variable-pie.js"></script>
@endpush
