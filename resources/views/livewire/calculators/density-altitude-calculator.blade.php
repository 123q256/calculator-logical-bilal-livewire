<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[90%] w-full mx-auto ">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Temperature & Dewpoint --}}
                <div class="space-y-4">
                    <div>
                        <label for="air_temp" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                        <div class="relative w-full mt-1">
                            <input type="number" wire:model="air_temp" id="air_temp" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                            <label for="air_temp_unit" class="absolute cursor-pointer text-sm underline right-6 top-3" wire:click="toggleDropdown('air_temp_unit')">{{ $air_temp_unit }} ▾</label>
                            @if($dropdowns['air_temp_unit'] ?? false)
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach(['°C', '°F', 'K'] as $unit)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('air_temp_unit', '{{ $unit }}', 'air_temp_unit')">{{ $unit }}</p>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    <div>
                        <label for="dewpoint" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                        <div class="relative w-full mt-1">
                            <input type="number" wire:model="dewpoint" id="dewpoint" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                            <label for="dewpoint_unit" class="absolute cursor-pointer text-sm underline right-6 top-3" wire:click="toggleDropdown('dewpoint_unit')">{{ $dewpoint_unit }} ▾</label>
                            @if($dropdowns['dewpoint_unit'] ?? false)
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach(['°C', '°F', 'K'] as $unit)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('dewpoint_unit', '{{ $unit }}', 'dewpoint_unit')">{{ $unit }}</p>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Altimeter & Elevation --}}
                <div class="space-y-4">
                    <div>
                        <label for="altimeter_setting" class="font-s-14 text-blue">{{ $lang[3] }}:</label>
                        <div class="relative w-full mt-1">
                            <input type="number" wire:model="altimeter_setting" id="altimeter_setting" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                            <label for="altimeter_setting_unit" class="absolute cursor-pointer text-sm underline right-6 top-3" wire:click="toggleDropdown('altimeter_setting_unit')">{{ $altimeter_setting_unit }} ▾</label>
                            @if($dropdowns['altimeter_setting_unit'] ?? false)
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                @foreach(['mb', 'hpa', 'inHg', 'mmHg'] as $unit)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('altimeter_setting_unit', '{{ $unit }}', 'altimeter_setting_unit')">{{ $unit }}</p>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    <div>
                        <label for="station_elevation" class="font-s-14 text-blue">{{ $lang[4] }}:</label>
                        <div class="relative w-full mt-1">
                            <input type="number" wire:model="station_elevation" id="station_elevation" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00"/>
                            <label for="station_elevation_unit" class="absolute cursor-pointer text-sm underline right-6 top-3" wire:click="toggleDropdown('station_elevation_unit')">{{ $station_elevation_unit }} ▾</label>
                            @if($dropdowns['station_elevation_unit'] ?? false)
                            <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 h-48 overflow-y-auto">
                                @foreach(['m', 'in', 'ft', 'yd', 'mi'] as $unit)
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="setUnit('station_elevation_unit', '{{ $unit }}', 'station_elevation_unit')">{{ $unit }}</p>
                                @endforeach
                            </div>
                            @endif
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
    @if(isset($detail))
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg ">
                <div class="w-full bg-light-blue rounded-lg mt-3">
                        <div class="w-full lg:w-[80%] mt-2 ">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['5'] }}</td>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ number_format($detail['density_altitude'], 4) }} km</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['6'] }}</td>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ number_format($detail['air_density'], 4) }} kg/m³</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['7'] }}</td>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ number_format($detail['relative_density'], 2) }} %</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">{{ $lang['8'] }}</td>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ number_format($detail['absolute_pressure'], 2) }} mb</strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b">Relative Humidity</td>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ number_format($detail['relative_humidity'], 2) }} %</strong></td>
                                </tr>
                            </table>

                            <div id="chart-container" class="w-full min-h-[400px] mt-8 p-4" wire:ignore></div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</form>

@push('calculatorJS')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            const renderChart = (data) => {
                if (!document.getElementById('chart-container')) return;
                
                Highcharts.chart('chart-container', {
                    chart: { type: 'line', backgroundColor: 'transparent' },
                    title: { text: 'Density Altitude Graph', align: 'left', style: { color: '#2845F5', fontWeight: 'bold' } },
                    xAxis: { 
                        categories: ['-18', '-16', '-11', '-6', '-2', '1', '4', '7', '10', '14', '18', '22', '26', '30', '34', '38', '43'], 
                        title: { text: 'Temperature (°C)' } 
                    },
                    yAxis: { title: { text: 'Altitude (ft)' } },
                    series: [{ 
                        name: 'Density Altitude', 
                        data: typeof data === 'string' ? JSON.parse(data) : data, 
                        color: '#2845F5' 
                    }],
                    credits: { enabled: false },
                    responsive: { rules: [{ condition: { maxWidth: 500 }, chartOptions: { legend: { layout: 'horizontal', align: 'center', verticalAlign: 'bottom' } } }] }
                });
            };

            @if(isset($detail['chartData']))
                renderChart(@json($detail['chartData']));
            @endif

            Livewire.on('chartUpdated', (event) => {
                setTimeout(() => {
                    renderChart(event.data);
                }, 100);
            });
        });
    </script>
@endpush
</div>
