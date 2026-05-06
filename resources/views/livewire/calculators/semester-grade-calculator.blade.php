<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[75%] md:w-[75%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    {{-- First Quarter --}}
                    <p class="col-span-12 font-bold text-blue-800 border-b border-blue-50 pb-2">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm uppercase tracking-wider">{{ $lang['1'] }}</span>
                    </p>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="f_grade" class="label">{{ $lang['2'] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" wire:model.live.debounce.500ms="f_grade" step="any" id="f_grade" class="input pr-12" placeholder="100" />
                            <span class="absolute right-4 top-5 text-blue-600 font-bold">%</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="f_weight" class="label">{{ $lang['3'] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" wire:model.live.debounce.500ms="f_weight" step="any" id="f_weight" class="input pr-12" placeholder="43" />
                            <span class="absolute right-4 top-5 text-blue-600 font-bold">%</span>
                        </div>
                    </div>

                    {{-- Second Quarter --}}
                    <p class="col-span-12 font-bold text-blue-800 border-b border-blue-50 pb-2 mt-4">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm uppercase tracking-wider">{{ $lang['4'] }}</span>
                    </p>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="s_grade" class="label">{{ $lang['2'] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" wire:model.live.debounce.500ms="s_grade" step="any" id="s_grade" class="input pr-12" placeholder="25" />
                            <span class="absolute right-4 top-5 text-blue-600 font-bold">%</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="s_weight" class="label">{{ $lang['3'] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" wire:model.live.debounce.500ms="s_weight" step="any" id="s_weight" class="input pr-12" placeholder="41" />
                            <span class="absolute right-4 top-5 text-blue-600 font-bold">%</span>
                        </div>
                    </div>

                    {{-- Final Exam --}}
                    <p class="col-span-12 font-bold text-blue-800 border-b border-blue-50 pb-2 mt-4">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm uppercase tracking-wider">{{ $lang['5'] }}</span>
                    </p>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="l_grade" class="label">{{ $lang['2'] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" wire:model.live.debounce.500ms="l_grade" step="any" id="l_grade" class="input pr-12" placeholder="10" />
                            <span class="absolute right-4 top-5 text-blue-600 font-bold">%</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="l_weight" class="label">{{ $lang['3'] }}</label>
                        <div class="w-full py-2 relative">
                            <input type="number" wire:model.live.debounce.500ms="l_weight" step="any" id="l_weight" class="input pr-12" placeholder="16" />
                            <span class="absolute right-4 top-5 text-blue-600 font-bold">%</span>
                        </div>
                    </div>
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @else
                @include('inc.widget-button')
            @endif
        </div>

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full my-2">
                                <div class="text-center">
                                    <p class="text-[20px] font-black text-blue-800">{{ $lang['6'] }}</p>
                                    <div class="flex justify-center">
                                        <p class="text-[25px] bg-[#2845F5] text-white rounded-lg px-6 py-2 my-4 shadow-lg">
                                            <strong class="text-blue">{{ $detail['semesterGrade'] }} %</strong>
                                        </p>
                                    </div>
                                </div>
                                
                                {{-- Alpine Chart Pattern (Based on Density Altitude reference) --}}
                                <div class="w-full mt-8" 
                                     x-data="{ 
                                        chartData: @js($detail['chartData'] ?? []),
                                        render() {
                                            if (typeof Highcharts === 'undefined') {
                                                setTimeout(() => this.render(), 200);
                                                return;
                                            }
                                            Highcharts.chart($refs.canvas, {
                                                chart: { type: 'pie', backgroundColor: 'transparent' },
                                                title: { text: 'Weights of semester grade elements [%]', align: 'left', style: { color: '#2845F5', fontWeight: 'bold' } },
                                                plotOptions: {
                                                    pie: {
                                                        allowPointSelect: true,
                                                        cursor: 'pointer',
                                                        dataLabels: {
                                                            enabled: true,
                                                            format: '{point.name}: {point.y}%'
                                                        },
                                                        showInLegend: true
                                                    }
                                                },
                                                series: [{ 
                                                    name: 'Weight', 
                                                    colorByPoint: true,
                                                    data: this.chartData
                                                }],
                                                credits: { enabled: false },
                                                tooltip: { pointFormat: '{series.name}: <b>{point.y}%</b>' },
                                                responsive: { rules: [{ condition: { maxWidth: 500 }, chartOptions: { legend: { layout: 'horizontal', align: 'center', verticalAlign: 'bottom' } } }] }
                                            });
                                        }
                                     }" 
                                     x-init="render()"
                                     @chart-updated.window="chartData = $event.detail; render()"
                                     wire:ignore>
                                    <div x-ref="canvas" class="w-full min-h-[400px]"></div>
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