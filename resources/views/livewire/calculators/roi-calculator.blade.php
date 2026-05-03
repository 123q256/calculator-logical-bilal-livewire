<div>
    <form wire:submit.prevent="calculate">

        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3  gap-4">

                    <!-- Basic Inputs -->
                    <div class="col-span-12">
                        <div class="grid grid-cols-12 mt-3 gap-4">
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="invest" class="label">{{ $lang['4'] ?? 'Amount Invested' }}:</label>
                                <div class="w-100 py-2 relative">
                                    <input type="number" step="any" wire:model.live="invest" id="invest"
                                        class="input" aria-label="input" placeholder="10" />
                                    <span class="text-blue input_unit">{{ $currancy }}</span>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="return" class="label">{{ $lang['5'] ?? 'Amount Returned' }}:</label>
                                <div class="w-100 py-2 relative">
                                    <input type="number" step="any" wire:model.live="return" id="return"
                                        class="input" aria-label="input" placeholder="20" />
                                    <span class="text-blue input_unit">{{ $currancy }}</span>
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                <label for="find" class="label">{{ $lang['6'] ?? 'Find' }}:</label>
                                <div class="w-100 py-2 relative">
                                    <select class="input" wire:model.live="find" id="find">
                                        <option value="1">{{ $lang[7] ?? 'Investment' }} ROI</option>
                                        <option value="2">{{ $lang[8] ?? 'Annualized' }} ROI</option>
                                    </select>
                                </div>
                            </div>

                            @if ($find == 1)
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="date" class="label">{{ $lang['9'] ?? 'Investment Period' }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <select class="input" wire:model.live="date" id="date">
                                            <option value="1">{{ $lang[10] ?? 'Dates' }}</option>
                                            <option value="2">{{ $lang[11] ?? 'Length' }}</option>
                                        </select>
                                    </div>
                                </div>
                            @endif

                            @if ($find == 2)
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="annualized" class="label">{{ $lang['7'] ?? 'Investment' }} ROI %:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" wire:model.live="annualized" id="annualized"
                                            class="input" aria-label="input" placeholder="50" />
                                        <span class="text-blue input_unit">%</span>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if ($find == 1 && $date == 1)
                            <div class="grid grid-cols-12 mt-3 gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="s_date" class="label">{{ $lang['12'] ?? 'Start Date' }}</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="date" wire:model.live="s_date" id="s_date" class="input" />
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="e_date" class="label">{{ $lang['13'] ?? 'End Date' }}</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="date" wire:model.live="e_date" id="e_date" class="input" />
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($find == 1 && $date == 2)
                            <div class="grid grid-cols-12 mt-3 gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="length" class="label">{{ $lang['14'] ?? 'Investment Length' }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" wire:model.live="length" id="length"
                                            class="input" placeholder="30" />
                                        
                                        <label for="length_unit"
                                            class="absolute cursor-pointer text-sm underline right-6 top-4"
                                            wire:click="toggleDropdown('length_unit')">
                                            {{ $length_unit }} ▾
                                        </label>

                                        @if ($openDropdown === 'length_unit')
                                            <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[50%] mt-1 right-0 shadow-lg" style="display: block;">
                                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('length_unit', 'days')">{{ $lang[15] ?? 'days' }}</p>
                                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('length_unit', 'weeks')">{{ $lang[16] ?? 'weeks' }}</p>
                                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('length_unit', 'months')">{{ $lang[17] ?? 'months' }}</p>
                                                <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('length_unit', 'years')">{{ $lang[18] ?? 'years' }}</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="grid grid-cols-12 mt-3 gap-4">
                            <div class="col-span-12">
                                <label for="compare" class="label">{{ $lang['19'] ?? 'Compare with another investment?' }}:</label>
                                <div class="w-100 py-2 relative">
                                    <select class="input" wire:model.live="compare" id="compare">
                                        <option value="1">{{ $lang[20] ?? 'No' }}</option>
                                        <option value="2">{{ $lang[21] ?? 'Yes' }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Comparison Section -->
                        @if ($compare == 2)
                            <div class="grid grid-cols-12 mt-3 gap-4 border-t pt-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="invest_compare" class="label">{{ $lang['4'] ?? 'Amount Invested' }} (Comp):</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" wire:model.live="invest_compare" id="invest_compare"
                                            class="input" placeholder="5000" />
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="return_compare" class="label">{{ $lang['5'] ?? 'Amount Returned' }} (Comp):</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" wire:model.live="return_compare" id="return_compare"
                                            class="input" placeholder="3000" />
                                    </div>
                                </div>

                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label for="find_compare" class="label">{{ $lang['6'] ?? 'Find' }}:</label>
                                    <div class="w-100 py-2 relative">
                                        <select class="input" wire:model.live="find_compare" id="find_compare">
                                            <option value="1">{{ $lang[7] ?? 'Investment' }} ROI</option>
                                            <option value="2">{{ $lang[8] ?? 'Annualized' }} ROI</option>
                                        </select>
                                    </div>
                                </div>

                                @if ($find_compare == 1)
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <label for="date_compare" class="label">{{ $lang['9'] ?? 'Investment Period' }}:</label>
                                        <div class="w-100 py-2 relative">
                                            <select class="input" wire:model.live="date_compare" id="date_compare">
                                                <option value="1">{{ $lang[10] ?? 'Dates' }}</option>
                                                <option value="2">{{ $lang[11] ?? 'Length' }}</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                @if ($find_compare == 2)
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <label for="annualized_compare" class="label">{{ $lang['7'] ?? 'Investment' }} ROI %:</label>
                                        <div class="w-100 py-2 relative">
                                            <input type="number" step="any" wire:model.live="annualized_compare" id="annualized_compare"
                                                class="input" placeholder="3000" />
                                        </div>
                                    </div>
                                @endif

                                @if ($find_compare == 1 && $date_compare == 1)
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <label for="s_date_compare" class="label">{{ $lang['12'] ?? 'Start Date' }}</label>
                                        <div class="w-100 py-2 relative">
                                            <input type="date" wire:model.live="s_date_compare" id="s_date_compare" class="input" />
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <label for="e_date_compare" class="label">{{ $lang['13'] ?? 'End Date' }}</label>
                                        <div class="w-100 py-2 relative">
                                            <input type="date" wire:model.live="e_date_compare" id="e_date_compare" class="input" />
                                        </div>
                                    </div>
                                @endif

                                @if ($find_compare == 1 && $date_compare == 2)
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <label for="length_compare" class="label">{{ $lang['14'] ?? 'Investment Length' }}:</label>
                                        <div class="w-100 py-2 relative">
                                            <input type="number" step="any" wire:model.live="length_compare" id="length_compare"
                                                class="input" placeholder="30" />
                                            
                                            <label for="length_unit_compare"
                                                class="absolute cursor-pointer text-sm underline right-6 top-4"
                                                wire:click="toggleDropdown('length_unit_compare')">
                                                {{ $length_unit_compare }} ▾
                                            </label>

                                            @if ($openDropdown === 'length_unit_compare')
                                                <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md lg:w-[40%] md:w-[40%] w-[50%] mt-1 right-0 shadow-lg" style="display: block;">
                                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('length_unit_compare', 'days')">{{ $lang[15] ?? 'days' }}</p>
                                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('length_unit_compare', 'weeks')">{{ $lang[16] ?? 'weeks' }}</p>
                                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('length_unit_compare', 'months')">{{ $lang[17] ?? 'months' }}</p>
                                                    <p class="p-1 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('length_unit_compare', 'years')">{{ $lang[18] ?? 'years' }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
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
                    <div class="rounded-lg  flex items-center justify-center mt-5">
                        <div class="w-full ">
                            <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-8 mt-5">
                                <!-- Standard Results -->
                                <div class="space-y-4">
                                    <h3 class="font-bold text-xl border-b pb-2">Investment Results</h3>
                                    @if ($find == 1 && $date == 1)
                                        <table class="w-full font-s-18">
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $lang[22] ?? 'Start Date' }}</strong></td>
                                                <td class="py-2 border-b"> {{ $detail['from'] }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $lang[23] ?? 'End Date' }}</strong></td>
                                                <td class="py-2 border-b"> {{ $detail['to'] }}</td>
                                            </tr>
                                        </table>
                                    @endif
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="py-2 border-b" width="60%"><strong>ROI</strong></td>
                                            <td class="py-2 border-b break-all"> {{ round($detail['roi'], 2) }}%</td>
                                        </tr>
                                        @if (isset($detail['annualized_answer']) && $detail['annualized_answer'] != '')
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] ?? 'Annualized' }} ROI</strong></td>
                                                <td class="py-2 border-b break-all"> {{ $detail['annualized_answer'] }}%</td>
                                            </tr>
                                        @endif
                                        @if ($detail['loss'] > 0)
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $lang[24] ?? 'Total Loss' }}</strong></td>
                                                <td class="py-2 border-b text-red-500"> {{ $currancy }} {{ number_format($detail['loss'], 2) }}</td>
                                            </tr>
                                        @endif
                                        @if ($detail['gain'] > 0)
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $lang[25] ?? 'Total Gain' }}</strong></td>
                                                <td class="py-2 border-b text-green-500"> {{ $currancy }} {{ number_format($detail['gain'], 2) }}</td>
                                            </tr>
                                        @endif
                                        @if ($detail['time'])
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>{{ $lang[26] ?? 'Investment Time' }}</strong></td>
                                                <td class="py-2 border-b"> {{ round($detail['time'], 2) }} years</td>
                                            </tr>
                                        @endif
                                    </table>

                                    <!-- Chart -->
                                    <div wire:key="chart-standard-{{ count($detail['chartData'] ?? []) }}-{{ microtime() }}"
                                        x-data="{ 
                                        chartData: {{ json_encode($detail['chartData']) }},
                                        render() {
                                            if (typeof CanvasJS === 'undefined') {
                                                setTimeout(() => this.render(), 200);
                                                return;
                                            }
                                            const chart = new CanvasJS.Chart($refs.canvas, {
                                                theme: 'light2',
                                                animationEnabled: true,
                                                data: [{
                                                    type: 'pie',
                                                    indexLabel: '{label}: {y}',
                                                    yValueFormatString: '#,##0.00\'%\'',
                                                    indexLabelPlacement: 'inside',
                                                    indexLabelFontColor: '#36454F',
                                                    indexLabelFontSize: 14,
                                                    indexLabelFontWeight: 'bolder',
                                                    showInLegend: true,
                                                    legendText: '{label}',
                                                    dataPoints: this.chartData
                                                }]
                                            });
                                            chart.render();
                                        }
                                    }" x-init="render()" @calculator-calculated.window="setTimeout(() => render(), 100)">
                                        <div x-ref="canvas" style="height: 300px; width: 100%;"></div>
                                    </div>
                                </div>

                                <!-- Comparison Results -->
                                @if ($compare == 2)
                                    <div class="space-y-4">
                                        <h3 class="font-bold text-xl border-b pb-2">Comparison Investment</h3>
                                        @if ($find_compare == 1 && $date_compare == 1)
                                            <table class="w-full font-s-18">
                                                <tr>
                                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[22] ?? 'Start Date' }}</strong></td>
                                                    <td class="py-2 border-b"> {{ $detail['from2'] ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[23] ?? 'End Date' }}</strong></td>
                                                    <td class="py-2 border-b"> {{ $detail['to2'] ?? '' }}</td>
                                                </tr>
                                            </table>
                                        @endif
                                        <table class="w-full font-s-18">
                                            <tr>
                                                <td class="py-2 border-b" width="60%"><strong>ROI</strong></td>
                                                <td class="py-2 border-b break-all"> {{ round($detail['roi2'] ?? 0, 2) }}%</td>
                                            </tr>
                                            @if (isset($detail['annualized_answer2']) && $detail['annualized_answer2'] != '')
                                                <tr>
                                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['7'] ?? 'Annualized' }} ROI</strong></td>
                                                    <td class="py-2 border-b break-all"> {{ $detail['annualized_answer2'] }}%</td>
                                                </tr>
                                            @endif
                                            @if (($detail['loss2'] ?? 0) > 0)
                                                <tr>
                                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[24] ?? 'Total Loss' }}</strong></td>
                                                    <td class="py-2 border-b text-red-500"> {{ $currancy }} {{ number_format($detail['loss2'] ?? 0, 2) }}</td>
                                                </tr>
                                            @endif
                                            @if (($detail['gain2'] ?? 0) > 0)
                                                <tr>
                                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[25] ?? 'Total Gain' }}</strong></td>
                                                    <td class="py-2 border-b text-green-500"> {{ $currancy }} {{ number_format($detail['gain2'] ?? 0, 2) }}</td>
                                                </tr>
                                            @endif
                                            @if ($detail['time2'] ?? false)
                                                <tr>
                                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang[26] ?? 'Investment Time' }}</strong></td>
                                                    <td class="py-2 border-b"> {{ round($detail['time2'] ?? 0, 2) }} years</td>
                                                </tr>
                                            @endif
                                        </table>

                                        <!-- Comparison Chart -->
                                        <div wire:key="chart-compare-{{ count($detail['chartData2'] ?? []) }}-{{ microtime() }}"
                                            x-data="{ 
                                            chartData: {{ json_encode($detail['chartData2'] ?? []) }},
                                            render() {
                                                if (this.chartData.length === 0) return;
                                                if (typeof CanvasJS === 'undefined') {
                                                    setTimeout(() => this.render(), 200);
                                                    return;
                                                }
                                                const chart = new CanvasJS.Chart($refs.canvas2, {
                                                    theme: 'light2',
                                                    animationEnabled: true,
                                                    data: [{
                                                        type: 'pie',
                                                        indexLabel: '{label}: {y}',
                                                        yValueFormatString: '#,##0.00\'%\'',
                                                        indexLabelPlacement: 'inside',
                                                        indexLabelFontColor: '#36454F',
                                                        indexLabelFontSize: 14,
                                                        indexLabelFontWeight: 'bolder',
                                                        showInLegend: true,
                                                        legendText: '{label}',
                                                        dataPoints: this.chartData
                                                    }]
                                                });
                                                chart.render();
                                            }
                                        }" x-init="render()" @calculator-calculated.window="setTimeout(() => render(), 100)">
                                            <div x-ref="canvas2" style="height: 300px; width: 100%;"></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
    
    @push('calculatorJS')
        <script src="https://cdn.canvasjs.com/ga/canvasjs.min.js"></script>
    @endpush
</div>
