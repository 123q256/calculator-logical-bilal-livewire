<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- Base Value --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="basic" class="font-s-14 text-blue">{{ $lang['a'] ?? 'Base Value' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="number" step="any" wire:model.live="basic" id="basic" class="input" placeholder="700000">
                            <span class="text-blue input_unit absolute right-4 top-1/2 -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                        </div>
                    </div>

                    {{-- Percentage/Business Use --}}
                    @if ($method != 'dbl')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="percent" class="font-s-14 text-blue">{{ $lang['b'] ?? 'Business Use %' }}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="percent" id="percent" class="input" placeholder="90">
                                <span class="text-blue input_unit absolute right-4 top-1/2 -translate-y-1/2 font-semibold">%</span>
                            </div>
                        </div>
                    @endif

                    {{-- Salvage Value (Only for DDB/DBL) --}}
                    @if ($method == 'dbl')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="sal" class="font-s-14 text-blue">{{ $lang['sal'] ?? 'Salvage Value' }}:</label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="sal" id="sal" class="input" placeholder="90">
                                <span class="text-blue input_unit absolute right-4 top-1/2 -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- Method Selection --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="method" class="font-s-14 text-blue">{{ $lang['c'] ?? 'Depreciation Method' }}:</label>
                        <select wire:model.live="method" id="method" class="input mt-2">
                            <option value="200">200% {{ $lang['1'] ?? 'Declining Balance' }}</option>
                            <option value="175">175% {{ $lang['1'] ?? 'Declining Balance' }}</option>
                            <option value="150">150% {{ $lang['1'] ?? 'Declining Balance' }}</option>
                            <option value="125">125% {{ $lang['1'] ?? 'Declining Balance' }}</option>
                            <option value="sl">GDS {{ $lang['3'] ?? 'Straight Line' }}</option>
                            <option value="asl">ADS {{ $lang['3'] ?? 'Straight Line' }}</option>
                            <option value="dbl">DDB {{ $lang['1'] ?? 'Double Declining' }}</option>
                        </select>
                    </div>

                    {{-- Period Selection --}}
                    @if ($method != 'asl')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="period" class="font-s-14 text-blue">{{ $lang['d'] ?? 'Recovery Period' }}:</label>
                            <select wire:model.live="period" id="period" class="input mt-2">
                                <option value="3">3 {{ $lang['year'] ?? 'Years' }}</option>
                                <option value="5">5 {{ $lang['year'] ?? 'Years' }}</option>
                                <option value="7">7 {{ $lang['year'] ?? 'Years' }}</option>
                                <option value="10">10 {{ $lang['year'] ?? 'Years' }}</option>
                                <option value="15">15 {{ $lang['year'] ?? 'Years' }}</option>
                                <option value="20">20 {{ $lang['year'] ?? 'Years' }}</option>
                                <option value="25">25 {{ $lang['year'] ?? 'Years' }}</option>
                                <option value="27.5">27.5 {{ $lang['year'] ?? 'Years' }}</option>
                                <option value="39">39 {{ $lang['year'] ?? 'Years' }}</option>
                            </select>
                        </div>
                    @else
                        {{-- ADS Period --}}
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="ads_" class="font-s-14 text-blue">{{ $lang['d'] ?? 'Recovery Period' }}:</label>
                            <select wire:model.live="ads_" id="ads_" class="input mt-2">
                                @foreach(['2.5', '3', '3.5', '4', '5', '6', '6.5', '7', '7.5', '8', '8.5', '9', '9.5', '10', '10.5', '11', '11.5', '12', '12.5', '13', '13.5', '14', '15', '16', '16.5', '17', '18', '19', '20', '22', '24', '25', '26.5', '28', '30', '35', '39', '40', '45', '50'] as $val)
                                    <option value="{{ $val }}">ADS {{ $val }} {{ $lang['year'] ?? 'Years' }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    {{-- Convention --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="conver" class="font-s-14 text-blue">{{ $lang['e'] ?? 'Convention' }}:</label>
                        <select wire:model.live="conver" id="conver" class="input mt-2">
                            <option value="3">{{ $lang['4'] ?? 'Half-Year' }}</option>
                            <option value="1">{{ $lang['5'] ?? 'Mid-Quarter' }}</option>
                            <option value="2">{{ $lang['6'] ?? 'Mid-Month' }}</option>
                        </select>
                    </div>

                    {{-- Date --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="date" class="font-s-14 text-blue">{{ $lang['f'] ?? 'Date Placed in Service' }}:</label>
                        <div class="w-100 py-2 relative">
                            <input type="date" wire:model.live="date" id="date" class="input">
                        </div>
                    </div>

                    {{-- Rounding --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="round" class="font-s-14 text-blue">{{ $lang['round'] ?? 'Round to nearest integer' }}:</label>
                        <select wire:model.live="round" id="round" class="input mt-2">
                            <option value="yes">{{ $lang['yes'] ?? 'Yes' }}</option>
                            <option value="no">{{ $lang['no'] ?? 'No' }}</option>
                        </select>
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
                            <div class="w-full mt-2 overflow-auto">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang['bas'] ?? 'Depreciable Basis' }} </strong></td>
                                        <td class="py-2 border-b">{{ $currancy }} {{ number_format($detail['original'] ?? 0, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang['f'] ?? 'Date Placed in Service' }} </strong></td>
                                        <td class="py-2 border-b">{{ $date }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang['d'] ?? 'Recovery Period' }} </strong></td>
                                        <td class="py-2 border-b">{{ $method == 'asl' ? $ads_ : $period }} {{ $lang['year'] ?? 'Years' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang['c'] ?? 'Method' }} </strong></td>
                                        <td class="py-2 border-b">
                                            @if($method == '200') 200% {{ $lang['1'] ?? 'Declining Balance' }}
                                            @elseif($method == '175') 175% {{ $lang['1'] ?? 'Declining Balance' }}
                                            @elseif($method == '150') 150% {{ $lang['1'] ?? 'Declining Balance' }}
                                            @elseif($method == '125') 125% {{ $lang['1'] ?? 'Declining Balance' }}
                                            @elseif($method == 'sl') GDS {{ $lang['3'] ?? 'Straight Line' }}
                                            @elseif($method == 'asl') ADS {{ $lang['3'] ?? 'Straight Line' }}
                                            @else DDB {{ $lang['1'] ?? 'Double Declining' }} @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang['e'] ?? 'Convention' }} </strong></td>
                                        <td class="py-2 border-b">
                                            @if($conver == '1') {{ $lang['5'] ?? 'Mid-Quarter' }}
                                            @elseif($conver == '2') {{ $lang['6'] ?? 'Mid-Month' }}
                                            @else {{ $lang['4'] ?? 'Half-Year' }} @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="w-full text-center text-[15px] mt-6">
                                <div class="w-full my-4 overflow-auto">
                                    <table class="w-full border-collapse">
                                        <thead>
                                            <tr class="bg-blue-100 text-blue-900">
                                                <th class="py-2 border-b px-2">{{ $lang['year'] ?? 'Year' }}</th>
                                                <th class="py-2 border-b px-2">{{ $lang['a_b'] ?? 'Beginning Balance' }}</th>
                                                <th class="py-2 border-b px-2">%</th>
                                                <th class="py-2 border-b px-2">{{ $lang['dep'] ?? 'Depreciation' }}</th>
                                                <th class="py-2 border-b px-2">{{ $lang['cam'] ?? 'Accumulated' }}</th>
                                                <th class="py-2 border-b px-2">{{ $lang['b_v'] ?? 'Ending Balance' }}</th>
                                                <th class="py-2 border-b px-2">{{ $lang['method'] ?? 'Method' }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {!! $detail['output'] ?? '' !!}
                                        </tbody>
                                    </table>
                                </div>
                            <div class="w-full mt-8" 
                                 x-data="{ 
                                    chartData: {!! $detail['chartData'] ?? '[]' !!},
                                    render() {
                                        if (typeof Highcharts === 'undefined') {
                                            setTimeout(() => this.render(), 200);
                                            return;
                                        }
                                        Highcharts.chart($refs.canvas, {
                                            chart: { type: 'line', backgroundColor: 'transparent' },
                                            title: { text: '{{ $lang["bv_chart"] ?? "Depreciation Schedule (Book Value over Time)" }}', align: 'left', style: { color: '#2845F5', fontWeight: 'bold' } },
                                            xAxis: { type: 'linear', title: { text: '{{ $lang["year"] ?? "Year" }}' }, gridLineWidth: 1 },
                                            yAxis: { title: { text: '{{ $lang["rv"] ?? "Book Value" }}' }, labels: { format: '{value} {{ $currancy }}' }, gridLineWidth: 1 },
                                            series: [{ 
                                                name: '{{ $lang["b_v"] ?? "Ending Balance" }}', 
                                                data: this.chartData, 
                                                color: '#2845F5',
                                                lineWidth: 2,
                                                marker: { enabled: true, radius: 3 }
                                            }],
                                            credits: { enabled: false },
                                            tooltip: { headerFormat: '<b>{{ $lang["year"] ?? "Year" }}: {point.x}</b><br/>', pointFormat: '{{ $lang["b_v"] ?? "Ending Balance" }}: {point.y} {{ $currancy }}' },
                                            responsive: { rules: [{ condition: { maxWidth: 500 }, chartOptions: { legend: { layout: 'horizontal', align: 'center', verticalAlign: 'bottom' } } }] }
                                        });
                                    }
                                 }" 
                                 x-init="render()"
                                 @chart-updated.window="chartData = $event.detail.data || $event.detail; render()"
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

