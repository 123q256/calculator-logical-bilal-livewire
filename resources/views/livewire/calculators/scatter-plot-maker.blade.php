<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12">
                        <label for="x" class="font-s-14 text-blue">X {{ $lang['data'] }} (,)</label>
                        <div class="w-full py-2">
                            <textarea wire:model.live="x" id="x" class="textareaInput" aria-label="input" placeholder="e.g. 1, 13, 5, 7, 9"></textarea>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="y" class="font-s-14 text-blue">Y {{ $lang['data'] }} (,)</label>
                        <div class="w-full py-2">
                            <textarea wire:model.live="y" id="y" class="textareaInput" aria-label="input" placeholder="e.g. 2, 4, 6, 18, 10"></textarea>
                        </div>
                    </div>    
                    <div class="col-span-12">
                        <label for="title" class="font-s-14 text-blue">{{ $lang['g_title'] }} ({{ $lang['optional'] }}):</label>
                        <div class="w-full py-2">
                            <input type="text" wire:model.live="title" id="title" class="input" aria-label="input" placeholder="Scatter Plot" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="xaxis" class="font-s-14 text-blue">{{ $lang['horizontal'] }} {{ $lang['axis_label'] }} ({{ $lang['optional'] }}):</label>
                        <div class="w-full py-2">
                            <input type="text" wire:model.live="xaxis" id="xaxis" class="input" aria-label="input" placeholder="X" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="yaxis" class="font-s-14 text-blue">{{ $lang['vertical'] }} {{ $lang['axis_label'] }} ({{ $lang['optional'] }}):</label>
                        <div class="w-full py-2">
                            <input type="text" wire:model.live="yaxis" id="yaxis" class="input" aria-label="input" placeholder="Y" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="xmin" class="font-s-14 text-blue">X {{ $lang['min'] }} ({{ $lang['optional'] }}):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="xmin" id="xmin" class="input" aria-label="input" placeholder="" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="xmax" class="font-s-14 text-blue">X {{ $lang['max'] }} ({{ $lang['optional'] }}):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="xmax" id="xmax" class="input" aria-label="input" placeholder="" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="ymin" class="font-s-14 text-blue">Y {{ $lang['min'] }} ({{ $lang['optional'] }}):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="ymin" id="ymin" class="input" aria-label="input" placeholder="" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="ymax" class="font-s-14 text-blue">Y {{ $lang['max'] }} ({{ $lang['optional'] }}):</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="ymax" id="ymax" class="input" aria-label="input" placeholder="" />
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="position" class="font-s-14 text-blue">{{ $lang['position'] }} ({{ $lang['optional'] }})</label>
                        <div class="w-full py-2">
                            <select wire:model.live="position" id="position" class="input" autocomplete="off">
                                <option value="top">{{ $lang['top'] }}</option>
                                <option value="left">{{ $lang['left'] }}</option>
                                <option value="right">{{ $lang['right'] }}</option>
                                <option value="bottom">{{ $lang['bottom'] }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="center" class="font-s-14 text-blue">{{ $lang['align'] }} ({{ $lang['optional'] }})</label>
                        <div class="w-full py-2">
                            <select wire:model.live="center" id="center" class="input" autocomplete="off">
                                <option value="start">{{ $lang['start'] }}</option>
                                <option value="center">{{ $lang['center'] }}</option>
                                <option value="end">{{ $lang['end'] }}</option>
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

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                @php
                                    $x_data = $detail['x'];
                                    $y_data = $detail['y'];
                                    $title_val = $detail['title'];
                                    $xaxis_val = $detail['xaxis'];
                                    $yaxis_val = $detail['yaxis'];
                                    $xmin_val = $detail['xmin'];
                                    $xmax_val = $detail['xmax'];
                                    $ymin_val = $detail['ymin'];
                                    $ymax_val = $detail['ymax'];
                                    $position_val = $detail['position'];
                                    $align_val = $detail['align'];
                                @endphp
                                
                                <p class="w-full font-s-18"><strong class="text-blue">{{ $lang['statement1'] }} {{ $xaxis_val }} {{ $lang['and'] }} {{ $yaxis_val }} {{ $lang['variables'] }}:</strong></p>
                                
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                                    <table class="w-full" style="border-collapse: collapse">
                                        <tr class="bg-gray-100">
                                            <td class="p-2 border text-center"><strong class="text-blue">{{ $xaxis_val }}</strong></td>
                                            <td class="p-2 border text-center"><strong class="text-blue">{{ $yaxis_val }}</strong></td>
                                        </tr>
                                        @foreach($x_data as $key => $value)
                                            <tr class="bg-white">
                                                <td class="p-2 border text-center">{{ $value }}</td>
                                                <td class="p-2 border text-center">{{ $y_data[$key] }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                
                                <p class="mt-4 w-full font-s-18"><strong class="text-blue">{{ $lang['statement2'] }}:</strong></p>
                                
                                <div class="w-full mt-4" x-data="{
                                    initChart() {
                                        if(window.myScatterChart) {
                                            window.myScatterChart.destroy();
                                        }
                                        const ctx = document.getElementById('myChart');
                                        if(!ctx) return;

                                        const xyValues = [
                                            @foreach($x_data as $key => $value)
                                                {x: {{ $value }}, y: {{ $y_data[$key] }} },
                                            @endforeach
                                        ];

                                        window.myScatterChart = new Chart(ctx, {
                                            type: 'scatter',
                                            data: {
                                                datasets: [{
                                                    label: '{{ addslashes($title_val) }}',
                                                    pointRadius: 4,
                                                    pointBackgroundColor: 'rgba(0,0,255,1)',
                                                    data: xyValues
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                                plugins: {
                                                    legend: {
                                                        align: '{{ $align_val }}',
                                                        position: '{{ $position_val }}',
                                                        labels: {
                                                            boxWidth: 0
                                                        }
                                                    }
                                                },
                                                scales: {
                                                    x: {
                                                        type: 'linear',
                                                        position: 'bottom',
                                                        title: {
                                                            display: true,
                                                            text: '{{ addslashes($xaxis_val) }}'
                                                        },
                                                        {{ is_numeric($xmin_val) ? "min: $xmin_val," : '' }}
                                                        {{ is_numeric($xmax_val) ? "max: $xmax_val," : '' }}
                                                    },
                                                    y: {
                                                        type: 'linear',
                                                        position: 'left',
                                                        title: {
                                                            display: true,
                                                            text: '{{ addslashes($yaxis_val) }}'
                                                        },
                                                        {{ is_numeric($ymin_val) ? "min: $ymin_val," : '' }}
                                                        {{ is_numeric($ymax_val) ? "max: $ymax_val," : '' }}
                                                    }
                                                }
                                            }
                                        });
                                    }
                                }" x-init="
                                    if (typeof Chart === 'undefined') {
                                        let script = document.createElement('script');
                                        script.src = 'https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js';
                                        script.onload = () => initChart();
                                        document.head.appendChild(script);
                                    } else {
                                        initChart();
                                    }
                                ">
                                    <div wire:ignore>
                                        <canvas id="myChart" class="w-full"></canvas>
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
