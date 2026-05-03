<div x-data="{ method: @entangle('method').live, round: @entangle('round').live }">
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="col-12 mx-auto mt-2 w-full lg:w-[70%] md:w-[70%]">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial">
                            <a href="{{ url('depreciation-calculator') }}/" class="text-decoration-none col-4 py-2  cursor-pointer radius-5  test11">{{ $lang['simple'] ?? 'Simple' }}</a>
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  imperial">
                            <a href="{{ url('car-depreciation-calculator') }}/" class="text-decoration-none col-4 py-2  cursor-pointer radius-5 test12">{{ $lang['Auto'] ?? 'Auto' }}</a>
                        </div>
                    </div>
                    <div class="lg:w-1/3 w-full px-2 py-1">
                        <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white  imperial">
                            <a href="{{ url('property-depreciation-calculator') }}/" class="text-decoration-none col-4 py-2  cursor-pointer radius-5 test13">{{ $lang['Property'] ?? 'Property' }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-[70%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <!-- Method -->
                    <div class="col-span-12 md:col-span-6">
                        <label for="method" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['dep_m'] ?? 'Depreciation Method' }}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="method" id="method" class="input">
                                <option value="Straight">{{ $lang['s_l'] ?? 'Straight Line' }}</option>
                                <option value="Declining">{{ $lang['d_b'] ?? 'Declining Balance' }}</option>
                                <option value="sum">{{ $lang['sum'] ?? 'Sum of Years' }}</option>
                                <option value="unit_of_pro">{{ $lang['u_of_p'] ?? 'Units of Production' }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Cost / Asset Value -->
                    <div class="col-span-12 md:col-span-6">
                        <label for="asset" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['a_s'] ?? 'Asset Value' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="asset" id="asset" class="input" placeholder="15000" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Salvage Value -->
                    <div class="col-span-12 md:col-span-6">
                        <label for="salvage" class="font-bold text-xs tracking-wider mb-1 block">
                            <span x-text="method === 'Reducing' ? 'Annual Depreciation Rate' : '{{ $lang['s_v'] ?? 'Salvage Value' }}'"></span>:
                        </label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="salvage" id="salvage" class="input" placeholder="2500" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Period / Life -->
                    <div class="col-span-12 md:col-span-6">
                        <label for="year" class="font-bold text-xs tracking-wider mb-1 block">
                            <span x-text="method === 'unit_of_pro' ? '{{ $lang['useful'] ?? 'Useful Life (Units)' }}' : '{{ $lang['d_y'] ?? 'Useful Life (Years)' }}'"></span>:
                        </label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="year" id="year" class="input" placeholder="5" />
                            <span class="text-blue input_unit" x-show="method !== 'unit_of_pro'">Yrs</span>
                        </div>
                    </div>

                    <!-- Units of Production Specific -->
                    <template x-if="method === 'unit_of_pro'">
                        <div class="col-span-12 md:col-span-6">
                            <label for="u_of_p" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['u_of_p'] ?? 'Units Produced' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="u_of_p" id="u_of_p" class="input" placeholder="1200" />
                            </div>
                        </div>
                    </template>

                    <!-- Standard Method Extras -->
                    <template x-if="method !== 'unit_of_pro'">
                        <div class="col-span-12 grid grid-cols-12 gap-4">
                            <!-- Rounding -->
                            <div class="col-span-12 md:col-span-6">
                                <label class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['r_d'] ?? 'Round Results' }}:</label>
                                <div class="w-full py-2 flex gap-2">
                                    <button type="button" @click="round = 'yes'" :class="round === 'yes' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300'" class="flex-1 py-2 rounded-lg border font-bold transition-all shadow-sm">
                                        {{ $lang['Yes'] ?? 'Yes' }}
                                    </button>
                                    <button type="button" @click="round = 'no'" :class="round === 'no' ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-700 border-gray-300'" class="flex-1 py-2 rounded-lg border font-bold transition-all shadow-sm">
                                        {{ $lang['No'] ?? 'No' }}
                                    </button>
                                </div>
                            </div>

                            <!-- Convention -->
                            <div class="col-span-12 md:col-span-6">
                                <label for="conver" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['con'] ?? 'Convention' }}:</label>
                                <div class="w-full py-2 relative">
                                    <select wire:model.live="conver" id="conver" class="input">
                                        <option value="3">{{ $lang['m_m'] ?? 'Monthly' }}</option>
                                        <option value="4">{{ $lang['f_m'] ?? 'Full Month' }}</option>
                                        <option value="1">{{ $lang['m_q'] ?? 'Mid-Quarter' }}</option>
                                        <option value="2">{{ $lang['h_y'] ?? 'Half-Year' }}</option>
                                        <option value="0">{{ $lang['f_y'] ?? 'Full-Year' }}</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Start Date -->
                            <div class="col-span-12 md:col-span-6">
                                <label for="date" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['start_d'] ?? 'Start Date' }}:</label>
                                <div class="w-full py-2 relative">
                                    <input type="date" wire:model.live="date" id="date" class="input" />
                                </div>
                            </div>

                            <!-- Declining Factor -->
                            <template x-if="method === 'Declining'">
                                <div class="col-span-12 md:col-span-6">
                                    <label for="Factor" class="font-bold text-xs tracking-wider mb-1 block">{{ $lang['d_f'] ?? 'Factor' }}:</label>
                                    <div class="w-full py-2 relative">
                                        <input type="number" step="any" wire:model.live="Factor" id="Factor" class="input" placeholder="4" />
                                    </div>
                                </div>
                            </template>
                        </div>
                    </template>
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
                            @if ($method == 'unit_of_pro')
                                <div class="w-full lg:w-[80%] overflow-auto">
                                    <table class="w-full text-lg">
                                        <tr class="border-b border-gray-100">
                                            <td class="py-2 text-gray-600">{{ $lang['3'] ?? 'Depreciable Base' }}</td>
                                            <td class="py-2 font-black text-right">{{ $currancy }}{{ (float)str_replace(',', '', $detail['Depreciable_Base']) + 0 }}</td>
                                        </tr>
                                        <tr class="border-b border-gray-100">
                                            <td class="py-2 text-gray-600">{{ $lang['1'] ?? 'Depreciation Per Unit' }}</td>
                                            <td class="py-2 font-black text-right">{{ $currancy }}{{ (float)str_replace(',', '', $detail['Depreciation_Per_Unit']) + 0 }}</td>
                                        </tr>
                                        <tr class="">
                                            <td class="py-2 font-bold text-gray-800">{{ $lang['2'] ?? 'Current Period Depreciation' }}</td>
                                            <td class="py-2 font-black text-orange-600 text-2xl text-right">{{ $currancy }}{{ (float)str_replace(',', '', $detail['Depreciation_for_Period']) + 0 }}</td>
                                        </tr>
                                    </table>
                                </div>
                            @else
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
                                                chart: { type: "column", borderRadius: 15, backgroundColor: "transparent" },
                                                title: { text: "Book Value vs Depreciation Amount", style: { fontWeight: "bold" } },
                                                xAxis: { categories: this.chartData.categories, crosshair: true },
                                                yAxis: { min: 0, title: { text: "Value ({{ $currancy }})" } },
                                                tooltip: { shared: true, borderRadius: 10 },
                                                plotOptions: { column: { pointPadding: 0.2, borderWidth: 0 } },
                                                series: [
                                                    { name: "Book Value", color: "#2563eb", data: this.chartData.bookValues },
                                                    { name: "{{ $lang["d_a"] ?? "Depreciation Amount" }}", color: "#f97316", data: this.chartData.depAmounts }
                                                ],
                                                credits: { enabled: false }
                                            });
                                        }
                                     }' 
                                     x-init="render()"
                                     @chart-updated.window="chartData = $event.detail; render()"
                                     wire:ignore>
                                    <div x-ref="canvas" class="w-full min-h-[450px]"></div>
                                </div>
                            @endif
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
