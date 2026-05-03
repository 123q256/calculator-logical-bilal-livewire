<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="col-12 mx-auto mt-2 w-full lg:w-[80%] md:w-[80%]">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  imperial">
                            <a href="{{ url('depreciation-calculator') }}/" class="text-decoration-none col-4 py-2  cursor-pointer radius-5">{{ $lang['simple'] ?? 'Simple' }}</a>
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 tagsUnit  hover_tags hover:text-white metric">
                            <a href="{{ url('car-depreciation-calculator') }}/" class="text-decoration-none col-4 py-2  cursor-pointer radius-5">{{ $lang['Auto'] ?? 'Auto' }}</a>
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric">
                            <a href="{{ url('property-depreciation-calculator') }}/" class="text-decoration-none col-4 py-2  cursor-pointer radius-5">{{ $lang['Property'] ?? 'Property' }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <!-- Car Cost -->
                    <div class="col-span-12 md:col-span-6">
                        <label for="car_cost" class="font-bold  text-xs tracking-wider mb-1 block">{{ $lang['car_p'] ?? 'Car Purchase Price' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="car_cost" id="car_cost" class="input" placeholder="21000" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Car Age -->
                    <div class="col-span-12 md:col-span-6">
                        <label for="c_age" class="font-bold  text-xs tracking-wider mb-1 block">{{ $lang['c_age'] ?? 'Car Age' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="c_age" id="c_age" class="input" placeholder="5" />
                            <span class="text-blue input_unit">Yrs</span>
                        </div>
                    </div>

                    <!-- Projection Period -->
                    <div class="col-span-12 md:col-span-6">
                        <label for="car_year" class="font-bold  text-xs tracking-wider mb-1 block">{{ $lang['car_year'] ?? 'Depreciation Years' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="car_year" id="car_year" class="input" placeholder="4" />
                            <span class="text-blue input_unit">Yrs</span>
                        </div>
                    </div>

                    <!-- Depreciation Rate -->
                    <div class="col-span-12 md:col-span-6">
                        <label for="rate_level" class="font-bold  text-xs tracking-wider mb-1 block">{{ $lang['d_r'] ?? 'Depreciation Rate' }}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="rate_level" id="rate_level" class="input">
                                <option value="1">{{ $lang['High'] ?? 'High' }}</option>
                                <option value="2">{{ $lang['Average'] ?? 'Average' }}</option>
                                <option value="3">{{ $lang['Low'] ?? 'Low' }}</option>
                            </select>
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
                    <div class="rounded-lg flex flex-col items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full mt-2 overflow-x-auto bg-white rounded-2xl border border-gray-200 shadow-sm">
                                <table class="w-full text-sm text-center">
                                    <thead class="bg-gray-50 border-b border-gray-200">
                                        <tr>
                                            <th class="py-4 px-3 font-bold text-gray-700">{{ $lang['Year'] ?? 'Year' }}</th>
                                            <th class="py-4 px-3 font-bold text-gray-700">{{ $lang['bb_v'] ?? 'Beginning Value' }}</th>
                                            <th class="py-4 px-3 font-bold text-gray-700">{{ $lang['depp'] ?? 'Depreciation' }}</th>
                                            <th class="py-4 px-3 font-bold text-gray-700">{{ $lang['d_a'] ?? 'Dep. Amount' }}</th>
                                            <th class="py-4 px-3 font-bold text-gray-700">{{ $lang['a_d_a'] ?? 'Accumulated' }}</th>
                                            <th class="py-4 px-3 font-bold text-gray-700">{{ $lang['eb_v'] ?? 'Ending Value' }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        {!! $detail['table'] !!}
                                    </tbody>
                                </table>
                            </div>

                            <div class="w-full mt-10 p-6 bg-white rounded-2xl border border-gray-200 shadow-sm"
                                 x-data='{ 
                                    chartData: {!! $detail["chartData"] !!},
                                    render() {
                                        if (typeof Highcharts === "undefined") {
                                            setTimeout(() => this.render(), 200);
                                            return;
                                        }
                                        Highcharts.chart($refs.canvas, {
                                            chart: { type: "line", borderRadius: 15, backgroundColor: "transparent" },
                                            title: { text: "Car Value Depreciation Curve", style: { fontWeight: "bold", color: "#2563eb" } },
                                            xAxis: { categories: this.chartData.categories, title: { text: "{{ $lang["Year"] ?? "Year" }}" } },
                                            yAxis: { title: { text: "{{ $lang["r_v"] ?? "Resale Value" }} ({{ $currancy }})" }, min: 0 },
                                            tooltip: { shared: true, valuePrefix: "{{ $currancy }}" },
                                            series: [{
                                                name: "{{ $lang["eb_v"] ?? "Ending Book Value" }}",
                                                data: this.chartData.bookValues,
                                                color: "#2563eb",
                                                lineWidth: 3,
                                                marker: { enabled: true, radius: 4 }
                                            }],
                                            credits: { enabled: false }
                                        });
                                    }
                                 }' 
                                 x-init="render()"
                                 @chart-updated.window="chartData = $event.detail; render()"
                                 wire:ignore>
                                <div x-ref="canvas" class="w-full min-h-[450px]"></div>
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