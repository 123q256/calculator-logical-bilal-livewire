<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[80%] md:w-[90%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-4">
                    <!-- Initial Investment -->
                    <div class="col-span-12 md:col-span-6">
                        <label for="initial" class="label font-bold text-xs mb-1 block text-black">{{ $lang['1'] ?? 'Initial Investment' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="initial" id="initial" class="input" min="0" />
                            <span class="input_unit text-blue-600">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Discount Rate -->
                    <div class="col-span-12 md:col-span-6">
                        <label for="discount" class="label font-bold text-xs mb-1 block text-black">{{ $lang['2'] ?? 'Discount Rate' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="discount" id="discount" class="input" min="0" max="100" />
                            <span class="input_unit text-blue-600">%</span>
                        </div>
                    </div>

                    <!-- Cash Flows Header -->
                    <div class="col-span-12 border-b pb-2 mt-4">
                        <h4 class="font-bold text-xs tracking-[0.2em] text-gray-600">{{ $lang[3] ?? 'Cash Flows' }}</h4>
                    </div>

                    <!-- Dynamic Year Flows -->
                    <div class="col-span-12 grid grid-cols-12 gap-4">
                        @foreach ($year_flows as $index => $flow)
                            <div class="col-span-6 group transition-all">
                                <label class="label font-bold text-xs mb-1 flex justify-between text-black">
                                    <span class="font-bold">{{ $lang['4'] ?? 'Year' }} {{ $index + 1 }}</span>
                                    @if ($index >= 6)
                                        <button type="button" wire:click="removeYear({{ $index }})" class="p-1 hover:bg-red-50 rounded-full transition-colors">
                                            <svg class="w-3 h-3 text-red-400 hover:text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    @endif
                                </label>
                                <div class="relative py-2">
                                    <input type="number" step="any" wire:model.live="year_flows.{{ $index }}" class="input" />
                                    <span class="input_unit text-blue-600">{{ $currancy }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add Year Button -->
                    <div class="col-span-12 text-end pt-2">
                        <button type="button" wire:click="addYear" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-[#2845F5] hover:bg-blue-700 rounded-lg transition-colors tracking-widest shadow-sm">
                            <span class="mr-2 text-lg">+</span>{{ $lang[5] ?? 'Add Year' }}
                        </button>
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
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[6] }} </strong></td>
                                        <td class="py-2 border-b"> {{ $currancy }} {{ $detail['npv_ans'] }}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[7] }} </strong></td>
                                        <td class="py-2 border-b"> {{ $detail['gross_return'] }}%</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[8] }} </strong></td>
                                        <td class="py-2 border-b"> {{ $currancy }} {{ $detail['net_cash_flow'] }}</td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div class="w-full mt-8" 
                                 x-data='{ 
                                    chartData: {!! $detail["chartData"] !!},
                                    render() {
                                        if (typeof Highcharts === "undefined") {
                                            setTimeout(() => this.render(), 200);
                                            return;
                                        }
                                        const data = typeof this.chartData === "string" ? JSON.parse(this.chartData) : this.chartData;
                                        Highcharts.chart($refs.canvas, {
                                            chart: { type: "column", backgroundColor: "transparent" },
                                            title: { text: "{{ $lang[9] ?? "Net Present Value Analysis" }}", align: "left", style: { color: "#2845F5", fontWeight: "bold" } },
                                            xAxis: { categories: data.map(p => p.label) },
                                            yAxis: { title: { text: "{{ $lang[8] ?? "Net Cash Flow" }} ({{ $currancy }})" } },
                                            series: [{ 
                                                name: "{{ $lang[8] ?? "Net Cash Flow" }}", 
                                                data: data.map(p => ({
                                                    y: p.y,
                                                    color: p.y >= 0 ? "#10b981" : "#ef4444"
                                                }))
                                            }],
                                            credits: { enabled: false },
                                            legend: { enabled: false }
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
        @endisset
    </form>
</div>

@push('calculatorJS')
<script src="https://code.highcharts.com/highcharts.js"></script>
@endpush
