<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                
                <div class="space-y-2">
                    <label for="air_temp" class="font-s-14 text-blue">{{ $lang[1] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="air_temp" id="air_temp" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['air_temp'])?$_POST['air_temp']:'30' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="air_temp_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('air_temp_unit_dropdown')">{{ isset($_POST['air_temp_unit'])?$_POST['air_temp_unit']:'°C' }} ▾</label>
                        <input type="text" name="air_temp_unit" value="{{ isset($_POST['air_temp_unit'])?$_POST['air_temp_unit']:'°C' }}" id="air_temp_unit" class="hidden">
                        <div id="air_temp_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('air_temp_unit', '°C')">°C</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('air_temp_unit', '°F')">°F</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('air_temp_unit', 'K')">K</p>
                       
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="dewpoint" class="font-s-14 text-blue">{{ $lang[2] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="dewpoint" id="dewpoint" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['dewpoint'])?$_POST['dewpoint']:'16' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="dewpoint_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('dewpoint_unit_dropdown')">{{ isset($_POST['dewpoint_unit'])?$_POST['dewpoint_unit']:'°C' }} ▾</label>
                        <input type="text" name="dewpoint_unit" value="{{ isset($_POST['dewpoint_unit'])?$_POST['dewpoint_unit']:'°C' }}" id="dewpoint_unit" class="hidden">
                        <div id="dewpoint_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dewpoint_unit', '°C')">°C</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dewpoint_unit', '°F')">°F</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('dewpoint_unit', 'K')">K</p>
                       
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="altimeter_setting" class="font-s-14 text-blue">{{ $lang[3] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="altimeter_setting" id="altimeter_setting" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['altimeter_setting'])?$_POST['altimeter_setting']:'890' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="altimeter_setting_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('altimeter_setting_unit_dropdown')">{{ isset($_POST['altimeter_setting_unit'])?$_POST['altimeter_setting_unit']:'mb' }} ▾</label>
                        <input type="text" name="altimeter_setting_unit" value="{{ isset($_POST['altimeter_setting_unit'])?$_POST['altimeter_setting_unit']:'mb' }}" id="altimeter_setting_unit" class="hidden">
                        <div id="altimeter_setting_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[30%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('altimeter_setting_unit', 'mb')">mb</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('altimeter_setting_unit', 'hpa')">hpa</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('altimeter_setting_unit', 'inHg')">inHg</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('altimeter_setting_unit', 'mmHg')">mmHg</p>
                       
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="station_elevation" class="font-s-14 text-blue">{{ $lang[4] }}:</label>
                    <div class="relative w-full ">
                        <input type="number" name="station_elevation" id="station_elevation" class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" value="{{ isset($_POST['station_elevation'])?$_POST['station_elevation']:'1300' }}" aria-label="input" placeholder="00" oninput="checkInput()"/>
                        <label for="station_elevation_unit" class="absolute cursor-pointer text-sm underline right-6 top-4" onclick="toggleDropdown('station_elevation_unit_dropdown')">{{ isset($_POST['station_elevation_unit'])?$_POST['station_elevation_unit']:'m' }} ▾</label>
                        <input type="text" name="station_elevation_unit" value="{{ isset($_POST['station_elevation_unit'])?$_POST['station_elevation_unit']:'m' }}" id="station_elevation_unit" class="hidden">
                        <div id="station_elevation_unit_dropdown" class="absolute z-10 bg-white border border-gray-300 rounded-md w-[20%] mt-1 right-0 hidden">
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('station_elevation_unit', 'm')">m</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('station_elevation_unit', 'in')">in</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('station_elevation_unit', 'ft')">ft</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('station_elevation_unit', 'yd')">yd</p>
                            <p class="p-1 hover:bg-gray-100 cursor-pointer" onclick="setUnit('station_elevation_unit', 'mi')">mi</p>
                        </div>
                    </div>
                </div>
            </div>
       </div>
        @if ($type == 'calculator')
        @include('inc.button')
       @endif
       @if ($type=='widget')
       @include('inc.widget-button')
        @endif
    </div>


    @isset($detail)
    
    {{-- result --}}
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
               <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full bg-light-blue rounded-lg mt-3">
                        <div class="flex flex-wrap">
                            <div class="w-full lg:w-7/12 mt-2">
                                <table class="w-full text-lg">
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['5'] }}</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['density_altitude'], 4) }} (km)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['6'] }}</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['air_density'], 4) }} (kg/m<sup class="text-blue">3</sup>)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['7'] }}</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['relative_density'], 2) }} (%)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['8'] }}</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ round($detail['absolute_pressure'], 2) }} (mb)</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b">{{ $lang['8'] }}</td>
                                        <td class="py-2 border-b"><strong class="text-blue">{{ $detail['relative_humidity'] }} (%)</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div id="chart-container" class="w-full mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
@push('calculatorJS')
    @if (isset($detail))
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script>
            Highcharts.chart('chart-container', {
                title: {
                    text: 'Density altitude graph',
                    align: 'left'
                },
                yAxis: {
                    title: {
                        text: ''
                    }
                },
                xAxis: {
                    categories: ['-18', '-16', '-11', '-6', '-2', '1', '4', '7', '10', '14', '18', '22', '26', '30', '34', '38', '43']
                },
            
                series: [{
                    name: 'Density altitude (ft)',
                    data: <?php echo $detail['chartData']; ?>
                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }
            });
        </script>
    @endif
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>