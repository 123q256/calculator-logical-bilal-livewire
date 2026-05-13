<div>
    <style>
        .highcharts-credits { display: none }
        .tagsUnit { background-color: #2845F5 !important; color: white !important; }
    </style>
    
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
            @endif

            <div class="lg:w-[90%] md:w-[90%] w-full mx-auto space-y-6">
                {{-- Unit System Selector --}}
                <div class="col-span-12 mb-4">
                    <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6"></div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <div class="mx-auto mt-2 w-full">
                                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 py-1">
                                    <div class="lg:w-1/2 w-full px-2 py-1">
                                        <div wire:click="setUnitType('imperial')" class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $unit_type === 'imperial' ? 'tagsUnit' : 'bg-white' }}">
                                            {{ $lang['imperial'] }}
                                        </div>
                                    </div>
                                    <div class="lg:w-1/2 w-full px-2 py-1">
                                        <div wire:click="setUnitType('metric')" class="px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white {{ $unit_type === 'metric' ? 'tagsUnit' : 'bg-white' }}">
                                            {{ $lang['metric'] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-x-8 gap-y-6">
                    {{-- Gender --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['gender'] !!}:</label>
                        <select wire:model.live="gender" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 bg-white cursor-pointer">
                            <option value="Male">{{ $lang['male'] }}</option>
                            <option value="Female">{{ $lang['female'] }}</option>
                        </select>
                    </div>

                    {{-- Age --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['your_age'] !!}:</label>
                        <input type="number" wire:model.live="age" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" placeholder="25">
                    </div>

                    {{-- Height --}}
                    @if($unit_type === 'imperial')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['height'] !!}:</label>
                            <select wire:model.live="height_ft" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 bg-white cursor-pointer">
                                @php
                                    $ft_names = ["4ft 7in", "4ft 8in", "4ft 9in", "4ft 10in", "4ft 11in", "5ft 0in", "5ft 1in", "5ft 2in", "5ft 3in", "5ft 4in", "5ft 5in", "5ft 6in", "5ft 7in", "5ft 8in", "5ft 9in", "5ft 10in", "5ft 11in", "6ft 0in", "6ft 1in", "6ft 2in", "6ft 3in", "6ft 4in", "6ft 5in", "6ft 6in", "6ft 7in", "6ft 8in", "6ft 9in", "6ft 10in", "6ft 11in", "7ft 0in"];
                                    $ft_vals = ["55", "56", "57", "58", "59", "60", "61", "62", "63", "64", "65", "66", "67", "68", "69", "70", "71", "72", "73", "74", "75", "76", "77", "78", "79", "80", "81", "82", "83", "84"];
                                @endphp
                                @foreach($ft_names as $idx => $name)
                                    <option value="{{ $ft_vals[$idx] }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['height'] !!}:</label>
                            <div class="relative">
                                <input type="number" wire:model.live="height_cm" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-10" placeholder="175">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 text-xs font-bold">cm</span>
                            </div>
                        </div>
                    @endif

                    {{-- Weight --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['weight'] !!}:</label>
                        <div class="relative">
                            <input type="number" wire:model.live="weight" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-10" placeholder="170">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 text-xs font-bold">{{ $unit_type === 'imperial' ? 'lbs' : 'kg' }}</span>
                        </div>
                    </div>

                    {{-- Goal Weight Change --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['i_want'] !!}:</label>
                        <div class="relative">
                            <input type="number" wire:model.live="weight1" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-10" placeholder="10">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 text-xs font-bold">{{ $unit_type === 'imperial' ? 'lbs' : 'kg' }}</span>
                        </div>
                    </div>

                    {{-- Daily Activity --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['daily_activity'] !!}:</label>
                        <select wire:model.live="activity" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 bg-white cursor-pointer">
                            <option value="sedentary">{{ $lang['No_sport'] }}</option>
                            <option value="Lightly_Active">{{ $lang['Light_activity'] }}</option>
                            <option value="Moderately_Active">{{ $lang['Moderate_activity'] }}</option>
                            <option value="Very_Active">{{ $lang['High_activity'] }}</option>
                            <option value="ext">{{ $lang['Extreme_activity'] }}</option>
                        </select>
                    </div>

                    {{-- Surplus Goal --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">{!! $lang['48'] !!}:</label>
                        <select wire:model.live="surplus" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 bg-white cursor-pointer">
                            <option value="0.10">{{ $lang['49'] }}</option>
                            <option value="0.15">{{ $lang['50'] }}</option>
                            <option value="0.20">{{ $lang['51'] }}</option>
                            <option value="custom">{{ $lang['52'] }}</option>
                        </select>
                    </div>

                    {{-- Custom Surplus Fields --}}
                    @if($surplus === 'custom')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 bg-blue-50 p-4 rounded-xl space-y-4">
                            <p class="text-sm font-bold text-blue-700 mb-2">{{ $lang['53'] }}:</p>
                            <div class="flex space-x-6 mb-4">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="stype" value="Incal" class="w-4 h-4 text-[#2845F5] focus:ring-[#2845F5]">
                                    <span class="text-sm font-medium text-gray-700">{{ $lang['54'] }}</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="radio" wire:model.live="stype" value="per_cal" class="w-4 h-4 text-[#2845F5] focus:ring-[#2845F5]">
                                    <span class="text-sm font-medium text-gray-700">{{ $lang['55'] }}</span>
                                </label>
                            </div>
                            
                            @if($stype === 'Incal')
                                <div class="relative">
                                    <input type="number" wire:model.live="kal_day" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-16" placeholder="250">
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 text-xs font-bold">kcal/day</span>
                                </div>
                            @else
                                <div class="relative">
                                    <input type="number" wire:model.live="per_cal" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-10" placeholder="10">
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 text-xs font-bold">%</span>
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- Body Fat % --}}
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="text-[15px] font-medium text-gray-700 mb-2 block">
                            {!! $lang['body_fat'] !!} 
                            <a href="{{ url('body-fat-percentage-calculator') }}/" class="text-blue-600 underline text-xs" target="_blank">{{ $lang['click'] }}</a>:
                        </label>
                        <div class="relative">
                            <input type="number" wire:model.live="percent" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-10" placeholder="Optional">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-600 text-xs font-bold">%</span>
                        </div>
                    </div>

                    {{-- Goal Dates --}}
                    <div class="col-span-12">
                        <p class="text-[15px] font-bold text-blue-700 mb-4">{{ $lang['to_achieve'] }}?</p>
                        <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-12 md:col-span-6">
                                <label class="text-xs font-medium text-gray-500 mb-1 block">{{ $lang['41'] }}</label>
                                <input type="date" wire:model.live="start" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3">
                            </div>
                            <div class="col-span-12 md:col-span-6">
                                <label class="text-xs font-medium text-gray-500 mb-1 block">{{ $lang['42'] }}</label>
                                <input type="date" wire:model.live="target" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3">
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

        @if ($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full p-3 mt-3">
                            <div class="w-full">
                                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                            <div><strong class="text-[20px] text-blue-500">{{ $lang['39'] }}</strong></div>
                                            <div class="border-s-dark ps-2">
                                                <div><strong class="text-green-500 text-[25px]">{{ $detail['CaloriesDaily'] }}</strong></div>
                                                <div>{{ $lang['c/d'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                            <div><strong class="text-[20px] text-blue-500">{{ $lang['11'] }}</strong></div>
                                            <div class="border-s-dark ps-2">
                                                <div><strong class="text-green-500 text-[25px]">{{ $detail['CaloriesLess'] }}</strong></div>
                                                <div>{{ $lang['c/d'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12">
                                        <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                            <div class="border-end pe-2 pe-lg-3">
                                                <div class="mb-1"><strong class="text-[20px] text-blue-500">{{ $lang['22'] }}</strong></div>
                                                <div>{{ $lang['56'] }}</div>
                                            </div>
                                            <div class="ps-2 ps-lg-3">
                                                <div><strong class="text-green-500 text-[25px]">{{ $detail['BMR'] }}</strong></div>
                                                <div>{{ $lang['c/d'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 border">
                                        <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                            <div class="border-end pe-2 pe-lg-3">
                                                <div class="mb-1"><strong class="text-[20px] text-blue-500">TDEE</strong></div>
                                                <div>{{ $lang['57'] }}</div>
                                            </div>
                                            <div class="ps-2 ps-lg-3">
                                                <div><strong class="text-green-500 text-[25px]">{{ $detail['Calories'] }}</strong></div>
                                                <div>{{ $lang['c/d'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                            <div><strong class="text-[20px] text-blue-500">{{ $lang['40'] }}</strong></div>
                                            <div class="border-s-dark ps-2 ps-lg-3">
                                                <div><strong class="text-green-500 text-[25px]">{{ $detail['days'] }}</strong></div>
                                                <div>{{ $lang['1'] }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="min-height:64px;border: 1px solid #c1b8b899;">
                                            <div><strong class="text-[20px] text-blue-500">{{ $lang['Target_Date'] }}</strong></div>
                                            <div class="border-s-dark ps-2">
                                                <div>
                                                    <strong class="text-green-500 text-[25px]">
                                                        {{ date('d-M-Y', strtotime("+" . $detail['days'] . " days")) }}
                                                    </strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-4"><strong class="text-[20px] text-blue-500">{{ $lang[58] }}</strong></p>
                                <p class="text-sm text-gray-600">{{ $lang[59] }}</p>
                                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 my-4 items-center">
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6"><strong class="text-blue-500">{{ $lang[60] }}</strong></div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <div class="w-full ms-auto">
                                            <select wire:model.live="macro_split" class="border border-blue-400 p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 bg-white cursor-pointer">
                                                <option value="1">{{ $lang[61] }}</option>
                                                <option value="2">{{ $lang[62] }}</option>
                                                <option value="3">{{ $lang[63] }}</option>
                                                <option value="4">{{ $lang[64] }}</option>
                                                <option value="5">{{ $lang[65] }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full mx-auto" x-data="{ cb: @js($detail['cb']), po: @js($detail['po']), fat: @js($detail['fat']) }" @macros-updated.window="cb = $event.detail.cb; po = $event.detail.po; fat = $event.detail.fat" @results-calculated.window="cb = $event.detail.cb; po = $event.detail.po; fat = $event.detail.fat">
                                    <div class="flex flex-col md:flex-row items-center justify-between bg-[#F6FAFC] border rounded p-3" style="border: 1px solid #c1b8b899;">
                                        <div class="px-3 text-center">
                                            <div class="mb-1"><strong class="text-blue-500">{{ $lang[44] }}</strong></div>
                                            <div>
                                                <strong class="text-[25px]" x-text="cb">{{ $detail['cb'] }}</strong>
                                                <span class="text-xs text-gray-500 ml-1">{{ $lang[45] }}</span>
                                            </div>
                                        </div>
                                        <div class="hidden md:block border-l h-8 mx-2">&nbsp;</div>
                                        <div class="px-3 text-center">
                                            <div class="mb-1"><strong class="text-blue-500">{{ $lang[46] }}</strong></div>
                                            <div>
                                                <strong class="text-[25px]" x-text="po">{{ $detail['po'] }}</strong>
                                                <span class="text-xs text-gray-500 ml-1">{{ $lang[45] }}</span>
                                            </div>
                                        </div>
                                        <div class="hidden md:block border-l h-8 mx-2">&nbsp;</div>
                                        <div class="px-3 text-center">
                                            <div class="mb-1"><strong class="text-blue-500">{{ $lang[47] }}</strong></div>
                                            <div>
                                                <strong class="text-[25px]" x-text="fat">{{ $detail['fat'] }}</strong>
                                                <span class="text-xs text-gray-500 ml-1">{{ $lang[45] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($detail['HighRiskCalories'] == '1')
                                    <p class="text-[18px] p-4 bg-red-50 text-red-700 rounded-lg mt-4">
                                        <strong class="font-bold">{{ $lang['3'] }}!</strong>
                                        {{ $lang['4'] }} {{ $detail['CaloriesLess'] }} {{ $lang['c/d'] }} , {{ $lang['5'] }}
                                        {{ $detail['CaloriesDaily'] }} {{ $lang['6'] }}!
                                    </p>
                                @endif
                                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 my-8">
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6" 
                                         x-data="{ 
                                            labels: @js($detail['weightChartLabels']),
                                            values: @js($detail['weightChartData']),
                                            chart: null,
                                            renderWeightChart() {
                                                if (typeof Highcharts === 'undefined') {
                                                    setTimeout(() => this.renderWeightChart(), 200);
                                                    return;
                                                }
                                                this.chart = Highcharts.chart($refs.weightCanvas, {
                                                    chart: { type: 'line', backgroundColor: 'transparent' },
                                                    title: { text: null },
                                                    xAxis: { categories: this.labels, labels: { step: Math.ceil(this.labels.length / 5) } },
                                                    yAxis: { title: { text: 'Weight (' + (@js($unit_type) === 'imperial' ? 'lbs' : 'kg') + ')' } },
                                                    legend: { enabled: false },
                                                    tooltip: { shared: true, crosshairs: true },
                                                    series: [{ name: 'Weight', color: '#2845F5', data: this.values, marker: { enabled: false } }],
                                                    credits: { enabled: false }
                                                });
                                            }
                                         }" 
                                         x-init="renderWeightChart()"
                                         @results-calculated.window="labels = $event.detail.weightLabels; values = $event.detail.weightData; renderWeightChart()"
                                         wire:ignore>
                                        <p class="ps-3 mb-2"><strong class="text-blue-500 text-[20px]">{{ $lang['10'] }}</strong></p>
                                        <div x-ref="weightCanvas" class="w-full h-[250px] bg-white rounded-lg"></div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6 md:border-l"
                                         x-data="{ 
                                            fat: @js($detail['fat']),
                                            po: @js($detail['po']),
                                            cb: @js($detail['cb']),
                                            chart: null,
                                            renderChart() {
                                                if (typeof Highcharts === 'undefined') {
                                                    setTimeout(() => this.renderChart(), 200);
                                                    return;
                                                }
                                                this.chart = Highcharts.chart($refs.macroCanvas, {
                                                    chart: { type: 'column', inverted: true, polar: true, backgroundColor: 'transparent' },
                                                    title: { text: null },
                                                    pane: { size: '85%', innerSize: '20%', endAngle: 270 },
                                                    xAxis: { tickInterval: 1, labels: { enabled: false }, lineWidth: 0, categories: [''] },
                                                    yAxis: { lineWidth: 0, tickInterval: 25, reversedStacks: false, endOnTick: true, showLastLabel: true },
                                                    plotOptions: { column: { stacking: 'normal', borderWidth: 0, pointPadding: 0, groupPadding: 0.15 } },
                                                    series: [
                                                        { name: 'CARBS', color: '#623a6c', data: [parseInt(this.cb)] },
                                                        { name: 'PROTEIN', color: '#b04c7a', data: [parseInt(this.po)] },
                                                        { name: 'FATS', color: '#e06f85', data: [parseInt(this.fat)] }
                                                    ],
                                                    credits: { enabled: false }
                                                });
                                            }
                                         }" 
                                         x-init="renderChart()"
                                         @results-calculated.window="fat = $event.detail.fat; po = $event.detail.po; cb = $event.detail.cb; renderChart()"
                                         @macros-updated.window="fat = $event.detail.fat; po = $event.detail.po; cb = $event.detail.cb; renderChart()"
                                         wire:ignore>
                                        <p class="ps-3 mb-2"><strong class="text-blue-500 text-[20px]">MACRO</strong></p>
                                        <div x-ref="macroCanvas" class="w-full h-[250px] bg-white rounded-lg"></div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>

    @push('calculatorJS')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    @endpush
</div>

