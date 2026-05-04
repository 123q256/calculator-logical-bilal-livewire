<div>
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if ($error)
            <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
        @endif

        <div class="lg:w-[70%] md:w-[70%] w-full mx-auto">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/3 w-full px-2 py-1">
                    <div wire:click="$set('unit_type', 'one')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $unit_type === 'one' ? 'tagsUnit' : '' }}">
                        {{ $lang['1'] ?? 'Years, Months, Days' }}
                    </div>
                </div>
                <div class="lg:w-1/3 w-full px-2 py-1">
                    <div wire:click="$set('unit_type', 'two')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $unit_type === 'two' ? 'tagsUnit' : '' }}">
                        {{ $lang['2'] ?? 'Start & End Dates' }}
                    </div>
                </div>
                <div class="lg:w-1/3 w-full px-2 py-1">
                    <div wire:click="$set('unit_type', 'three')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $unit_type === 'three' ? 'tagsUnit' : '' }}">
                        {{ $lang['3'] ?? 'Calculate Future Value' }}
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-12 mt-3 gap-4">
                @if($unit_type === 'one')
                <div class="col-span-12">
                    <div class="grid grid-cols-12 mt-3 gap-4">
                        <div class="col-span-12 md:col-span-6">
                            <label for="starting_first" class="label">{{ $lang['4'] ?? 'Starting Value' }}:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="starting_first" id="starting_first" class="input" placeholder="100" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="ending_first" class="label">{{ $lang['5'] ?? 'Ending Value' }}:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="ending_first" id="ending_first" class="input" placeholder="1000" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <label for="years_first" class="label">{{ $lang['6'] ?? 'Years' }}:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="years_first" id="years_first" class="input" placeholder="3" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <label for="months_first" class="label">{{ $lang['7'] ?? 'Months' }}:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="months_first" id="months_first" class="input" placeholder="0" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <label for="days_first" class="label">{{ $lang['8'] ?? 'Days' }}:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="days_first" id="days_first" class="input" placeholder="0" />
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($unit_type === 'two')
                <div class="col-span-12">
                    <div class="grid grid-cols-12 mt-3 gap-4">
                        <div class="col-span-12 md:col-span-6">
                            <label for="starting_sec" class="label">{{ $lang['4'] ?? 'Starting Value' }}:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="starting_sec" id="starting_sec" class="input" placeholder="100" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="ending_sec" class="label">{{ $lang['5'] ?? 'Ending Value' }}:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="ending_sec" id="ending_sec" class="input" placeholder="1000" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="start_date" class="label">{{ $lang['9'] ?? 'Start Date' }}:</label>
                            <div class="w-full py-2">
                                <input type="date" wire:model.live="start_date" id="start_date" class="input" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="ending_date" class="label">{{ $lang['10'] ?? 'Ending Date' }}:</label>
                            <div class="w-full py-2">
                                <input type="date" wire:model.live="ending_date" id="ending_date" class="input" />
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($unit_type === 'three')
                <div class="col-span-12">
                    <div class="grid grid-cols-12 mt-3 gap-4">
                        <div class="col-span-12 md:col-span-6">
                            <label for="starting_third" class="label">{{ $lang['4'] ?? 'Starting Value' }}:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="starting_third" id="starting_third" class="input" placeholder="100" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="cagr" class="label">CAGR %:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="cagr" id="cagr" class="input" placeholder="10" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <label for="years_third" class="label">{{ $lang['6'] ?? 'Years' }}:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="years_third" id="years_third" class="input" placeholder="3" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <label for="months_third" class="label">{{ $lang['7'] ?? 'Months' }}:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="months_third" id="months_third" class="input" placeholder="0" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-4">
                            <label for="days_third" class="label">{{ $lang['8'] ?? 'Days' }}:</label>
                            <div class="w-full py-2">
                                <input type="number" step="any" wire:model.live="days_third" id="days_third" class="input" placeholder="0" />
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        @if ($type == 'calculator')
            @include('inc.button')
        @else
            @include('inc.widget-button')
        @endif
    </div>

    <hr class="border-gray-100">

    @isset($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-5">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full mt-2">
                            <table class="w-full text-[18px]">
                                @if ($unit_type === 'one')
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>{{ $lang[12] ?? 'Annual Growth Rate' }}</strong></td>
                                        <td class="py-2 border-b">{{ round($detail['cagr_percentage'], 4) }}%</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>{{ $lang[13] ?? 'Analysis' }}</strong></td>
                                        <td class="py-2 border-b">{{ $currancy }}{{ $starting_first }} to {{ $currancy }}{{ $ending_first }} in {{ $detail['year'] }}, {{ $detail['months'] }}, {{ $detail['days'] }}</td>
                                    </tr>
                                @elseif($unit_type === 'two')
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>{{ $lang[12] ?? 'Annual Growth Rate' }}</strong></td>
                                        <td class="py-2 border-b">{{ round($detail['cagr_percentage'], 4) }}%</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>{{ $lang[13] ?? 'Analysis' }}</strong></td>
                                        <td class="py-2 border-b">{{ $currancy }}{{ $starting_sec }} to {{ $currancy }}{{ $ending_sec }} in {{ round($detail['total_days'], 4) }} days</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>Future Value</strong></td>
                                        <td class="py-2 border-b">{{ $currancy }}{{ round($detail['cagr_percentage'], 4) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="40%"><strong>{{ $lang[18] ?? 'Investment Details' }}</strong></td>
                                        <td class="py-2 border-b">{{ $currancy }}{{ $starting_third }} at {{ $cagr }}% in {{ $detail['year'] }}, {{ $detail['months'] }}, {{ $detail['days'] }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>

                        <div class="w-full md:w-[60%] lg:w-[60%] mt-3">
                            <p class="font-bold mb-2">{{ $lang['14'] ?? 'Time to Double Your Investment' }}</p>
                            <table class="w-full text-center">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <td class="py-2 border-b"><strong>{{ $lang['6'] ?? 'Years' }}</strong></td>
                                        <td class="py-2 border-b"><strong>{{ $lang['7'] ?? 'Months' }}</strong></td>
                                        <td class="py-2 border-b"><strong>{{ $lang['8'] ?? 'Days' }}</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-2 border-b">{{ round($detail['yearx'], 2) }}</td>
                                        <td class="py-2 border-b">{{ round($detail['monthz'], 2) }}</td>
                                        <td class="py-2 border-b">{{ round($detail['dayz'], 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="w-full md:w-[60%] lg:w-[60%] mt-3">
                            <p class="font-bold mb-2">Growth Schedule</p>
                            <table class="w-full text-center">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <td class="py-2 border-b"><strong>{{ $lang['20'] ?? 'Year' }}</strong></td>
                                        <td class="py-2 border-b"><strong>{{ $lang['15'] ?? 'Growth' }}</strong></td>
                                        <td class="py-2 border-b"><strong>{{ $lang['16'] ?? 'Total Value' }}</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail['dataPoints'] as $i => $point)
                                        @php
                                            $growth = ($i == 0) ? "-" : $currancy . round($point[1] - $detail['dataPoints'][$i-1][1], 2);
                                        @endphp
                                        <tr>
                                            <td class="py-2 border-b">{{ $i }}</td>
                                            <td class="py-2 border-b">{{ $growth }}</td>
                                            <td class="py-2 border-b">{{ $currancy . round($point[1], 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="w-full mt-8" 
                             x-data="{ 
                                chartData: {!! $detail['chartData'] !!},
                                render() {
                                    if (typeof Highcharts === 'undefined' || !this.chartData) {
                                        setTimeout(() => this.render(), 200);
                                        return;
                                    }
                                    Highcharts.chart($refs.canvas, {
                                        chart: { type: 'line', backgroundColor: 'transparent' },
                                        title: { text: 'Investment Value By Year', align: 'left', style: { color: '#2845F5', fontWeight: 'bold' } },
                                        xAxis: { type: 'linear', title: { text: '{{ $lang['20'] ?? 'Year' }}' }, gridLineWidth: 1 },
                                        yAxis: { title: { text: '{{ $lang['16'] ?? 'Total Value' }} ({{ $currancy }})' }, gridLineWidth: 1 },
                                        series: [{ 
                                            name: '{{ $lang['16'] ?? 'Total Value' }}', 
                                            data: this.chartData, 
                                            color: '#2845F5',
                                            lineWidth: 2,
                                            marker: { enabled: true, radius: 3 }
                                        }],
                                        credits: { enabled: false },
                                        tooltip: { headerFormat: '<b>Year: {point.x}</b><br/>', pointFormat: 'Value: {point.y}' },
                                        responsive: { rules: [{ condition: { maxWidth: 500 }, chartOptions: { legend: { layout: 'horizontal', align: 'center', verticalAlign: 'bottom' } } }] }
                                    });
                                }
                             }" 
                             x-init="render()"
                             @chart-updated.window="chartData = $event.detail.data; render()"
                             wire:ignore>
                            <div x-ref="canvas" class="w-full min-h-[400px]"></div>
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
