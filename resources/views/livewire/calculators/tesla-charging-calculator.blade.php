<div x-data="{ dropdowns: {}, main_unit: '{{ $main_unit }}' }">
    <style>
        [x-cloak] { display: none !important; }
        .result_output select {
            width: 100%;
            min-height: 46px;
            padding: 10px 14px;
            border-radius: 14px;
            border: 1px solid #d1d5db;
            background: #f9fafc;
            font-size: 14px;
            color: #111827;
            outline: none;
            transition: 0.15s;
            resize: vertical;
        }
    </style>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 mt-3">
                    {{-- Calculation Mode --}}
                    <div class="col-span-12">
                        <label for="main_unit" class="label">{{ $lang['20'] }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="main_unit" id="main_unit" class="input">
                                <option value="Full Capacity Charging Cost">{{ $lang['23'] }}</option>
                                <option value="Custom Distance Charging Cost">{{ $lang['24'] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- Full Capacity Fields --}}
                    <div class="col-span-12 space-y-4" x-show="main_unit === 'Full Capacity Charging Cost'">
                        <div>
                            <label for="battery" class="label">{{ $lang['21'] }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live.debounce.500ms="battery" id="battery" class="input" placeholder="00" />
                                <span class="input_unit">kWh</span>
                            </div>
                        </div>
                        <div>
                            <label for="electricity" class="label">{{ $lang['22'] }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live.debounce.500ms="electricity" id="electricity" class="input" placeholder="00" />
                                <span class="input_unit">per kWh</span>
                            </div>
                        </div>
                    </div>

                    {{-- Custom Distance Fields --}}
                    <div class="col-span-12 space-y-4" x-show="main_unit === 'Custom Distance Charging Cost'" x-cloak>
                        <div>
                            <label for="type_ev" class="label">{{ $lang['1'] }}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="type_ev" id="type_ev" class="input">
                                    @php
                                        $evModels = [
                                            "1" => "Tesla Model S (2013 - 60D)", "2" => "Tesla Model S (2016 - 60D)", 
                                            "3" => "Tesla Model S (2017 - 100D)", "4" => "Tesla Model 3 (2019)", 
                                            "5" => "Tesla Model 3 (2021)", "6" => "Tesla Model X (2016 - 90D)", 
                                            "7" => "Tesla Model X (2016 - P100D)", "8" => "Tesla Model Y (2021)", 
                                            "9" => "Chevrolet Bolt (2016)", "10" => "Audi Q4 e-tron 50 quattro", 
                                            "11" => "Nissan Leaf", "12" => "Hyundai IONIQ Electric", 
                                            "13" => "Citroen e-C4", "14" => "Kia EV6", "15" => "Kia Soul EV", 
                                            "16" => "BMW i3", "17" => "BMW i4", "18" => "Fiat 500e", "19" => "Hyundai Kona Electric"
                                        ];
                                    @endphp
                                    @foreach($evModels as $val => $name)
                                        <option value="{{ $val }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="price" class="label">{{ $lang['2'] }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live.debounce.500ms="price" id="price" class="input" placeholder="00" />
                                <span class="input_unit">{{ $currancy }}</span>
                            </div>
                        </div>
                        <div>
                            <label for="distance" class="label">{{ $lang['3'] }}:</label>
                            <div class="relative w-full mt-[7px]">
                                <input type="number" wire:model.live.debounce.500ms="distance" id="distance" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                                <label class="absolute cursor-pointer text-sm underline right-6 top-4" @click="dropdowns['units'] = !dropdowns['units']">
                                    {{ $units }} ▾
                                </label>
                                <div x-show="dropdowns['units']" @click.away="dropdowns['units'] = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg" x-cloak>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('units', 'km'); dropdowns['units'] = false">km</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm" @click="$wire.set('units', 'mi'); dropdowns['units'] = false">mi</p>
                                </div>
                            </div>
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

        <div id="result-section">
            @isset($detail)
                <div wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result result_output" x-cloak>
                    <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                        <div class="rounded-lg">
                            <div class="w-full mt-3">
                                <div class="w-full my-2">
                                    <div class="w-full lg:w-[80%] px-5 text-[18px]">
                                        <table class="w-full">
                                            <tr>
                                                <td class="border-b py-3"><strong>{{ $lang['4'] }} :</strong></td>
                                                <td class="border-b py-3 text-right font-bold text-blue-700">{{ $currancy }} {{ number_format($detail['cost'], 2) }}</td>
                                            </tr>
                                            @if($main_unit == 'Custom Distance Charging Cost')
                                                <tr>
                                                    <td class="border-b py-3"><strong>{{ $lang['6'] }} {{ $lang['4'] }} :</strong></td>
                                                    <td class="border-b py-3 text-right font-bold text-blue-700">{{ $currancy }} {{ number_format($detail['ec'], 2) }}</td>
                                                </tr>
                                            @endif
                                        </table>
                                    </div>

                                    @if($main_unit == 'Custom Distance Charging Cost')
                                        <div class="w-full lg:w-[80%] overflow-auto mt-8">
                                            <p class="text-[20px] text-blue-900 border-b pb-2"><strong>{{ $lang['7'] }}</strong></p>
                                            <table class="w-full text-[16px] mt-4">
                                                <tbody>
                                                    <tr>
                                                        <td class="py-2 text-gray-600">{{ $lang['8'] }} :</td>
                                                        <td class="py-2 font-bold">{{ $detail['name'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 text-gray-600">{{ $lang['9'] }} {{ $lang['10'] }} :</td>
                                                        <td class="py-2 font-bold">{{ $detail['capacity'] }} {{ $lang['11'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 text-gray-600">{{ $lang['9'] }} {{ $lang['12'] }} :</td>
                                                        <td class="py-2 font-bold">{{ number_format($detail['capacity'] * 1000) }} {{ $lang['13'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 text-gray-600">{{ $lang['14'] }} {{ $lang['15'] }} :</td>
                                                        <td class="py-2 font-bold">{{ number_format($detail['efficiency'], 2) }} {{ $lang['16'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 text-gray-600">{{ $lang['14'] }} {{ $lang['17'] }} :</td>
                                                        <td class="py-2 font-bold">{{ number_format($detail['efficiency'] * 1.61, 1) }} {{ $lang['18'] }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                    <div class="w-full bg-white p-6 rounded-xl shadow-sm border border-blue-50 mt-8" 
                                         x-data="{ 
                                            step: 50,
                                            cost: {{ $detail['cost'] ?? 0 }},
                                            render() {
                                                if (typeof Highcharts === 'undefined') {
                                                    setTimeout(() => this.render(), 200);
                                                    return;
                                                }
                                                
                                                if (!this.cost) return;

                                                let data = [];
                                                let currentStep = parseInt(this.step) || 5;
                                                for (let i = 0; i <= 100; i += currentStep) {
                                                    data.push([i, parseFloat((this.cost * (i / 100)).toFixed(2))]);
                                                }

                                                Highcharts.chart(this.$refs.canvas, {
                                                    chart: { type: 'line', backgroundColor: 'transparent' },
                                                    title: { text: 'Charging cost vs Battery level', style: { color: '#333333', fontWeight: 'bold', fontSize: '18px' } },
                                                    xAxis: { 
                                                        type: 'linear', 
                                                        title: { text: '' }, 
                                                        gridLineWidth: 0, 
                                                        tickPositions: [0, 50, 100],
                                                        lineColor: '#e6e6e6'
                                                    },
                                                    yAxis: { 
                                                        title: { text: '' }, 
                                                        gridLineWidth: 1,
                                                        gridLineColor: '#f1f5f9'
                                                    },
                                                    series: [{ 
                                                        name: 'Cost', 
                                                        data: data, 
                                                        color: '#38bdf8',
                                                        lineWidth: 2,
                                                        marker: { 
                                                            enabled: true, 
                                                            radius: 4,
                                                            fillColor: '#38bdf8'
                                                        }
                                                    }],
                                                    legend: {
                                                        align: 'center',
                                                        verticalAlign: 'bottom',
                                                        layout: 'horizontal'
                                                    },
                                                    credits: { enabled: false },
                                                    tooltip: { headerFormat: '<b>Battery: {point.x}%</b><br/>', pointFormat: 'Cost: {{ $currancy }}{point.y}' }
                                                });
                                            }
                                         }" 
                                         x-init="$nextTick(() => render())"
                                         @chart-updated.window="cost = $event.detail.cost; $nextTick(() => render())"
                                         wire:ignore>
                                        
                                        <div class="w-full mb-8">
                                            <label class="block font-bold mb-3 text-[18px]">{{ $lang['19'] }}:</label>
                                            <div class="w-full">
                                                <select x-model="step" @change="render()" class="w-full px-6 py-4 text-[18px]">
                                                    <option value="5">5 %</option>
                                                    <option value="10">10 %</option>
                                                    <option value="20">20 %</option>
                                                    <option value="50">50 %</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div x-ref="canvas" class="w-full min-h-[400px]" ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </form>
    @push('calculatorJS')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    @endpush
</div>
