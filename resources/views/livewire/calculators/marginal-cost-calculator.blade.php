<div>
    <form wire:submit.prevent="calculate">

        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-4">

                    <!-- Change in Total Cost (ΔTC) -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="dc" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Change in Total Cost' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="dc" id="dc" class="input"
                                aria-label="input" placeholder="50" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Change in Quantity (ΔQ) -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="dq" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Change in Quantity' }}:</label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" step="any" wire:model.live="dq" id="dq"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full"
                                aria-label="input" placeholder="40" />
                            
                            <label for="dq_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" 
                                wire:click="toggleDropdown('dq_unit')">
                                {{ $dq_unit }} ▾
                            </label>
                            
                            @if ($openDropdown === 'dq_unit')
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" style="display: block;">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('dq_unit', 'units')">{{ $lang[5] ?? 'units' }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('dq_unit', 'pairs')">{{ $lang[6] ?? 'pairs' }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('dq_unit', 'decades')">{{ $lang[7] ?? 'decades' }}</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('dq_unit', 'dozens')">{{ $lang[8] ?? 'dozens' }}</p>
                                </div>
                            @endif
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

        @if ($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%">
                                            <strong>{{ $lang[13] ?? 'Marginal Cost' }} </strong>
                                        </td>
                                        <td class="py-2 border-b"> {{ round($detail['mc'], 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-3"><strong>{{ $lang['14'] ?? 'Calculation Steps' }}:</strong></p>
                                <p class="mt-2"><strong>{{ $lang['15'] ?? 'Marginal Cost Formula' }}</strong></p>
                                <p class="mt-2">{{ $lang['13'] ?? 'MC' }} = {{ $lang['3'] ?? 'ΔTC' }} / {{ $lang['4'] ?? 'ΔQ' }}</p>
                                <p class="mt-2">MC = ΔTC / ΔQ</p>
                                
                                <p class="mt-2"><strong>{{ $lang['17'] ?? 'Final Calculation' }}</strong></p>
                                <p class="mt-2">MC = ΔTC / ΔQ</p>
                                <p class="mt-2">MC = {{ round($detail['dc'], 2) }} / {{ $detail['dq'] }}</p>
                                <p class="mt-2">MC = {{ round($detail['mc'], 2) }}</p>
                                
                                <div class="mt-4 "><strong>{{ ($lang['13'] ?? 'Marginal Cost') . ' ' . ($lang['18'] ?? 'Graph') }}</strong></div>
                                <div class="row d-flex">
                                    <div class="w-full mt-8" 
                                         x-data="{ 
                                            chartData: {{ $detail['chartData'] }},
                                            render() {
                                                if (typeof Highcharts === 'undefined') {
                                                    setTimeout(() => this.render(), 200);
                                                    return;
                                                }
                                                Highcharts.chart($refs.canvas, {
                                                    chart: { type: 'pie', backgroundColor: 'transparent' },
                                                    title: { text: '{{ $lang[13] ?? 'Marginal Cost' }} Analysis', align: 'left', style: { color: '#2845F5', fontWeight: 'bold' } },
                                                    series: [{ 
                                                        name: 'Cost', 
                                                        data: this.chartData, 
                                                        innerSize: '50%',
                                                        colors: ['#FF9F00', '#00C2DB']
                                                    }],
                                                    credits: { enabled: false },
                                                    tooltip: { pointFormat: '{series.name}: <b>{point.y}</b>' },
                                                    plotOptions: {
                                                        pie: {
                                                            allowPointSelect: true,
                                                            cursor: 'pointer',
                                                            dataLabels: {
                                                                enabled: true,
                                                                format: '<b>{point.name}</b>: {point.y}'
                                                            }
                                                        }
                                                    }
                                                });
                                            }
                                         }" 
                                         x-init="render()"
                                         @chart-updated.window="chartData = JSON.parse($event.detail); render()"
                                         wire:ignore>
                                        <div x-ref="canvas" class="w-full min-h-[400px]"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>

@push('calculatorJS')
    <script src="https://code.highcharts.com/highcharts.js"></script>
@endpush
