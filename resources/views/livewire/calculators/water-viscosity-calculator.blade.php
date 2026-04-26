<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
                <div class="grid grid-cols-1 mt-3  gap-4">
                    {{-- Temperature Input --}}
                    <div class="space-y-2 mt-0 mt-lg-2 ">
                        <label for="temp" class="font-s-14 text-blue">{{ $lang['1'] }} </label>
                        <div class="relative w-full mt-[7px]">
                            <input type="number" wire:model.live="temp" step="any"
                                class="border border-gray-300 p-2 rounded-lg focus:ring-2  w-full" placeholder="00" />
                            <label class="absolute cursor-pointer text-sm underline right-6 top-4"
                                wire:click.stop="toggleDropdown('temp_unit')">
                                {{ $unit == 'c' ? '°C' : ($unit == 'f' ? '°F' : 'K') }} ▾
                            </label>
                            @if ($openDropdown === 'temp_unit')
                                <div class="fixed inset-0 z-[9]" wire:click="toggleDropdown(null)"></div>
                                <div class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        wire:click.stop="setUnit('unit', 'c')">°C</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        wire:click.stop="setUnit('unit', 'f')">°F</p>
                                    <p class="p-2 hover:bg-gray-100 cursor-pointer"
                                        wire:click.stop="setUnit('unit', 'k')">K</p>
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
        @isset($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full md:w-[80%] lg:w-[80%]  mt-2 overflow-x-auto">
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[2] }} , η </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['ans'], 4) }} mPa.s</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[3] }} , v </strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['ans1'], 4) }} mm²/s</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b" width="70%"><strong>{{ $lang[4] }}</strong></td>
                                        <td class="py-2 border-b"> {{ round($detail['ans2'], 4) }} g/cm³</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full px-2" wire:ignore>
                                <div id="container" class="mt-4" style="height:500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        window.drawWaterViscosityChart = function() {
            var container = document.getElementById('container');
            if (!container || typeof google === 'undefined' || !google.visualization) return;

            var data = new google.visualization.DataTable();
            data.addColumn('number', '');
            data.addColumn('number', '{{ $lang['2'] }} (mPa⋅s)');
            data.addColumn('number', '{{ $lang['3'] }} (mm²/s)');
            data.addColumn('number', '{{ $lang['4'] }} (g/cm³)');

            data.addRows([
                [0, 1.788, 1.789, 0.9999], [1, 1.73075, 1.7313, 0.9999], [2, 1.6735, 1.6736, 0.9999], [3, 1.619, 1.6191, 1], [4, 1.5673, 1.5674, 1], [5, 1.5182, 1.5182, 1], [6, 1.4715, 1.4716, 0.9999], [7, 1.4271, 1.4272, 0.9999], [8, 1.3847, 1.3849, 0.9999], [9, 1.3444, 1.3447, 0.9998], [10, 1.3059, 1.3063, 0.9997], [11, 1.2692, 1.2696, 0.9996], [12, 1.234, 1.2347, 0.9995], [13, 1.2005, 1.2012, 0.9994], [14, 1.1683, 1.1692, 0.9992], [15, 1.1375, 1.1386, 0.9991], [16, 1.1081, 1.1092, 0.9989], [17, 1.0798, 1.0811, 0.9988], [18, 1.0526, 1.0541, 0.9986], [19, 1.0266, 1.0282, 0.9984], [20, 1.0016, 1.0034, 0.9982], [21, 0.9775, 0.9795, 0.998], [22, 0.9544, 0.9565, 0.9978], [23, 0.9321, 0.9344, 0.9975], [24, 0.9107, 0.9131, 0.9973], [25, 0.89, 0.8926, 0.997], [26, 0.8701, 0.8729, 0.9968], [27, 0.8509, 0.8539, 0.9965], [28, 0.8324, 0.8355, 0.9962], [29, 0.8145, 0.8178, 0.9959], [30, 0.7972, 0.8007, 0.9956], [31, 0.7805, 0.7842, 0.9953], [32, 0.7644, 0.7682, 0.995], [33, 0.7488, 0.7528, 0.9947], [34, 0.7337, 0.7379, 0.9944], [35, 0.7191, 0.7234, 0.994], [36, 0.705, 0.7095, 0.9937], [37, 0.6913, 0.6959, 0.9933], [38, 0.678, 0.6828, 0.993], [39, 0.6652, 0.6702, 0.9926], [40, 0.6527, 0.6579, 0.9922], [41, 0.64132, 0.64666, 0.9918], [42, 0.62994, 0.63542, 0.9914], [43, 0.61856, 0.62418, 0.991], [44, 0.60718, 0.61294, 0.9906], [45, 0.5958, 0.6017, 0.9902], [46, 0.58594, 0.59198, 0.98976], [47, 0.57608, 0.58226, 0.98932], [48, 0.56622, 0.57254, 0.98888], [49, 0.55636, 0.56282, 0.98844], [50, 0.5465, 0.5531, 0.988], [51, 0.53792, 0.54466, 0.98754], [52, 0.52934, 0.53622, 0.98708], [53, 0.52076, 0.52778, 0.98662], [54, 0.51218, 0.51934, 0.98616], [55, 0.5036, 0.5109, 0.9857], [56, 0.49608, 0.50352, 0.9852], [57, 0.48856, 0.49614, 0.9847], [58, 0.48104, 0.48876, 0.9842], [59, 0.47352, 0.48138, 0.9837], [60, 0.466, 0.474, 0.9832], [61, 0.45938, 0.4675, 0.98268], [62, 0.45276, 0.461, 0.98216], [63, 0.44614, 0.4545, 0.98164], [64, 0.43952, 0.448, 0.98112], [65, 0.4329, 0.4415, 0.9806], [66, 0.42702, 0.43574, 0.98004], [67, 0.42114, 0.42998, 0.97948], [68, 0.41526, 0.42422, 0.97892], [69, 0.40938, 0.41846, 0.97836], [70, 0.4035, 0.4127, 0.9778], [71, 0.39828, 0.4076, 0.9772], [72, 0.39306, 0.4025, 0.9766], [73, 0.38784, 0.3974, 0.976], [74, 0.38262, 0.3923, 0.9754], [75, 0.3774, 0.3872, 0.9748], [76, 0.37272, 0.38262, 0.9742], [77, 0.36804, 0.37804, 0.9736], [78, 0.36336, 0.37346, 0.973], [79, 0.35868, 0.36888, 0.9724], [80, 0.354, 0.3643, 0.9718], [81, 0.35009, 0.36047, 0.97115], [82, 0.34618, 0.35664, 0.9705], [83, 0.34227, 0.35281, 0.96985], [84, 0.33836, 0.34898, 0.9692], [85, 0.33445, 0.34515, 0.96855], [86, 0.33054, 0.34132, 0.9679], [87, 0.32663, 0.33749, 0.96725], [88, 0.32272, 0.33366, 0.9666], [89, 0.31881, 0.32983, 0.96595], [90, 0.3149, 0.326, 0.9653], [91, 0.31166, 0.3229, 0.96461], [92, 0.30842, 0.3198, 0.96392], [93, 0.30518, 0.3167, 0.96323], [94, 0.30194, 0.3136, 0.96254], [95, 0.2987, 0.3105, 0.96185], [96, 0.29546, 0.3074, 0.96116], [97, 0.29222, 0.3043, 0.96047], [98, 0.28898, 0.3012, 0.95978], [99, 0.28574, 0.2981, 0.95909], [100, 0.2825, 0.295, 0.9584], [101, 0.28111, 0.2937, 0.95744], [110, 0.26868, 0.28209, 0.9488], [121, 0.25348, 0.26789, 0.93824], [132, 0.23828, 0.25369, 0.92768], [144, 0.2217, 0.2382, 0.91616], [155, 0.2065, 0.224, 0.9056], [166, 0.1913, 0.2098, 0.89504], [177, 0.1761, 0.1956, 0.88448], [188, 0.1609, 0.1814, 0.87392], [200, 0.14431, 0.1659, 0.8624], [250, 0.1099, 0.137, 0.799], [300, 0.0912, 0.128, 0.7125], [370, 0.0569, 0.126, 0.4505]
            ]);

            var options = {
                title: '{{ $lang['5'] }}',
                colors: ['#13699E', '#EF3322', '#0086F2'],
                curveType: 'function',
                legend: { position: 'bottom' },
                hAxis: { title: 'Temperature (°C)' },
                vAxis: { minValue: 0 }
            };

            var chart = new google.visualization.LineChart(container);
            chart.draw(data, options);
        }

        window.triggerWaterChart = function() {
            if (typeof google !== 'undefined' && google.charts && google.visualization) {
                window.drawWaterViscosityChart();
            } else {
                setTimeout(window.triggerWaterChart, 500);
            }
        }

        google.charts.load('current', {'packages':['corechart']});

        @if (isset($detail))
            google.charts.setOnLoadCallback(window.drawWaterViscosityChart);
        @endif
    </script>
</div>
