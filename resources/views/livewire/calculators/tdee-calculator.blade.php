<div>
    @php
    $metricCountries = ["United States", "Canada", "United Kingdom", "Pakistan"];
    @endphp

    @push('calculatorJS')
        <script src="https://code.highcharts.com/highcharts.js"></script>
    @endpush

    <style>
        .activeMacro { background: #278ECD; color: white; }
        .resultInput {
            height: 41px;
            border-radius: 5px;
            box-shadow: 0px 0px 2px 0px #1670a7 inset;
            background: #FFFFFF;
            outline: 0px;
            border: 0px;
            font-size: 14px;
        }
        input[type=range] { -webkit-appearance: none; width: 100%; background: transparent; }
        input[type=range]::-webkit-slider-runnable-track { width: 100%; height: 8px; cursor: pointer; background: #ddd; border-radius: 5px; }
        input[type=range]::-webkit-slider-thumb { border: 2px solid #278ECD; height: 20px; width: 20px; border-radius: 50%; background: #ffffff; cursor: pointer; -webkit-appearance: none; margin-top: -6px; }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="w-full lg:w-10/12 mx-auto mt-3">
                <div class="lg:w-2/3 mb-3">
                    <div class="py-2">
                        <label class="pr-3 text-base font-semibold">{!! $lang['1'] ?? 'Gender' !!}:</label>
                        <label class="inline-flex items-center mr-4 cursor-pointer">
                            <input type="radio" wire:model.live="gender" value="male" class="form-radio text-blue-600">
                            <span class="ml-2">{{ $lang['male'] ?? 'Male' }}</span>
                        </label>
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="radio" wire:model.live="gender" value="female" class="form-radio text-blue-600">
                            <span class="ml-2">{{ $lang['female'] ?? 'Female' }}</span>
                        </label>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-2">
                    <!-- Age -->
                    <div class="w-full lg:w-1/3 px-2 mb-4">
                        <label class="label font-semibold">{!! $lang['age_year'] ?? 'Age' !!}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" wire:model.live="age" min="18" max="130" class="input w-full border border-gray-300 rounded-lg px-4 py-2" placeholder="25" />
                        </div>
                    </div>

                    <!-- Weight -->
                    <div class="w-full lg:w-1/3 px-2 mb-4">
                        <label class="label font-semibold">{{ $lang['weight'] ?? 'Weight' }}:</label>
                        <div class="relative w-full py-2">
                            <input type="number" step="any" wire:model.live="weight" class="input w-full border border-gray-300 rounded-lg px-4 py-2" />
                            <div class="absolute right-2 top-4">
                                <select wire:model.live="unit" class="bg-transparent border-none text-sm underline cursor-pointer focus:ring-0">
                                    <option value="lbs">lbs</option>
                                    <option value="kg">kg</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Height -->
                    @if($hightUnit == 'ft/in')
                        <div class="w-1/2 lg:w-1/6 px-2 mb-4">
                            <label class="label font-semibold">{!! $lang['height'] ?? 'Height' !!} (ft):</label>
                            <div class="w-full py-2">
                                <input type="number" wire:model.live="height_ft" min="4" max="7" class="input w-full border border-gray-300 rounded-lg px-4 py-2" />
                            </div>
                        </div>
                        <div class="w-1/2 lg:w-1/6 px-2 mb-4">
                            <label class="label font-semibold">(in):</label>
                            <div class="relative w-full py-2">
                                <input type="number" wire:model.live="height_in" min="0" max="11" class="input w-full border border-gray-300 rounded-lg px-4 py-2" />
                                <div class="absolute right-2 top-4">
                                    <span class="text-sm underline cursor-pointer" wire:click="$set('hightUnit', 'cm')">ft/in ▾</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="w-full lg:w-1/3 px-2 mb-4">
                            <label class="label font-semibold">{{ $lang['height'] ?? 'Height' }} (cm):</label>
                            <div class="relative w-full py-2">
                                <input type="number" step="any" wire:model.live="height_cm" class="input w-full border border-gray-300 rounded-lg px-4 py-2" />
                                <div class="absolute right-2 top-4">
                                    <span class="text-sm underline cursor-pointer" wire:click="$set('hightUnit', 'ft/in')">cm ▾</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Activity -->
                    <div class="w-full lg:w-1/2 px-2 mb-4">
                        <label class="label font-semibold">{!! $lang['activity'] ?? 'Activity' !!}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="activity" class="input w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                                <option value="Sedentary">{{ $lang[64] ?? 'Sedentary (office job)' }}</option>
                                <option value="Lightly Active">{{ $lang['Lightly'] ?? 'Lightly Active' }}</option>
                                <option value="Moderately Active">{{ $lang['Moderately'] ?? 'Moderately Active' }}</option>
                                <option value="Very Active">{{ $lang['Very'] ?? 'Very Active' }}</option>
                                <option value="Extremely Active">{{ $lang['Extremely'] ?? 'Extremely Active' }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Body Fat -->
                    <div class="w-full lg:w-1/2 px-2 mb-4">
                        <label class="label font-semibold">{!! $lang['b_f'] ?? 'Body Fat %' !!} ({{ $lang['opt'] ?? 'optional' }}):</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="percent" class="input w-full border border-gray-300 rounded-lg px-4 py-2 pr-10" placeholder="%" />
                            <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">%</span>
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
    </form>

    @if($detail)
    <hr class="my-8">
    <div id="result-section" 
         x-data="{ 
            detail: @entangle('detail'),
            formula: 'mifflin',
            macroMode: 'maintenance',
            customPro: 30,
            customFat: 35,
            customCarb: 35,
            get tdee() { 
                let bmr = this.bmr;
                let factor = { 'Sedentary': 1.2, 'Lightly Active': 1.375, 'Moderately Active': 1.55, 'Very Active': 1.725, 'Extremely Active': 1.9 }[this.detail.activity] || 1.2;
                return Math.round(bmr * factor);
            },
            get bmr() {
                let w = this.detail.weight;
                let h = this.detail.height_cm;
                let a = this.detail.age;
                let g = this.detail.gender;
                let p = this.detail.percent;

                if (this.formula === 'katch' && p) {
                    return 370 + 21.6 * (1 - (p/100)) * w;
                } else if (this.formula === 'revised') {
                    if (g === 'female') return (9.247 * w) + (3.098 * h) - (4.330 * a) + 447.593;
                    return (13.397 * w) + (4.799 * h) - (5.677 * a) + 88.362;
                } else {
                    if (g === 'female') return (10 * w) + (6.25 * h) - (5 * a) - 161;
                    return (10 * w) + (6.25 * h) - (5 * a) + 5;
                }
            },
            updateCharts() {
                this.renderMainChart();
                this.renderMacroCharts();
            },
            renderMainChart() {
                let bmrVal = this.bmr;
                let tef = this.tdee * 0.1;
                let pal = this.tdee - bmrVal - tef;
                
                Highcharts.chart('componentsChart', {
                    chart: { type: 'pie', height: 300, backgroundColor: 'transparent' },
                    title: { text: null },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: { enabled: true, format: '{point.name}: {point.percentage:.1f}%' },
                            colors: ['#278ECD', '#1670A7', '#4CBAFD']
                        }
                    },
                    series: [{
                        name: 'Calories',
                        data: [
                            { name: 'BMR', y: bmrVal },
                            { name: 'Physical Activity', y: Math.max(0, pal) },
                            { name: 'TEF', y: tef }
                        ]
                    }],
                    credits: { enabled: false }
                });
            },
            renderMacroCharts() {
                const renderSmallPie = (id, pro, fat, carb) => {
                    Highcharts.chart(id, {
                        chart: { type: 'pie', height: 150, backgroundColor: 'transparent' },
                        title: { text: null },
                        plotOptions: {
                            pie: {
                                dataLabels: { enabled: false },
                                innerSize: '40%',
                                colors: ['#E94442', '#E7A827', '#38a169']
                            }
                        },
                        series: [{
                            data: [
                                { name: 'Protein', y: pro },
                                { name: 'Fat', y: fat },
                                { name: 'Carbs', y: carb }
                            ]
                        }],
                        credits: { enabled: false }
                    });
                };

                let targetCal = this.tdee;
                if (this.macroMode === 'cutting') targetCal -= 500;
                if (this.macroMode === 'bulking') targetCal += 500;

                renderSmallPie('moderateChart', 30, 35, 35);
                renderSmallPie('lowerChart', 40, 40, 20);
                renderSmallPie('higherChart', 30, 20, 50);
                
                if (this.macroMode === 'custom') {
                    renderSmallPie('customChart', this.customPro, this.customFat, this.customCarb);
                }
            }
         }"
         x-init="
            updateCharts(); 
            window.addEventListener('render-graph', () => updateCharts());
            $watch('macroMode', () => {
                $nextTick(() => renderMacroCharts());
            });
         "
         class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 mt-10 scroll-mt-20">
        
        <div class="flex flex-col md:flex-row justify-between items-center">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="mt-4 md:mt-0">
                <select x-model="formula" @change="updateCharts()" class="resultInput px-4 border border-blue-200">
                    <option value="mifflin">{{ $lang['66'] ?? 'Mifflin-St Jeor' }}</option>
                    <option value="revised">{{ $lang['67'] ?? 'Revised Harris-Benedict' }}</option>
                    <option value="katch">{{ $lang['68'] ?? 'Katch-McArdle' }}</option>
                </select>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-blue-100">
            <h2 class="text-center text-2xl font-bold text-blue-600 mb-6">
                {{ $lang['70'] ?? 'Total Daily Energy Expenditure' }} (TDEE)
            </h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div class="bg-[#F6FAFC] rounded-2xl p-8 text-center border border-blue-50">
                    <div class="text-6xl font-black text-green-600 mb-2">
                        <span x-text="tdee.toLocaleString()"></span>
                    </div>
                    <div class="text-lg font-semibold text-gray-500 uppercase tracking-widest mb-4">
                        {{ $lang['71'] ?? 'Calories Per Day' }}
                    </div>
                    <p class="text-gray-600 leading-relaxed">
                        Based on your stats, your maintenance calories are 
                        <strong class="text-blue-600" x-text="tdee.toLocaleString()"></strong> per day, 
                        which is <strong class="text-blue-600" x-text="(tdee * 7).toLocaleString()"></strong> calories per week.
                    </p>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 border-b border-gray-100 font-bold text-gray-700">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('images/tdee_cal.svg') }}" class="w-6 h-6">
                            {{ $lang['75'] ?? 'Activity Level' }}
                        </div>
                        <span>{{ $lang['76'] ?? 'Daily Calories' }}</span>
                    </div>
                    
                    <template x-for="(factor, name) in { 
                        '{{ $lang[64] ?? 'Sedentary' }}': 1.2, 
                        '{{ $lang['Lightly'] ?? 'Lightly Active' }}': 1.375, 
                        '{{ $lang['Moderately'] ?? 'Moderately Active' }}': 1.55, 
                        '{{ $lang['Very'] ?? 'Very Active' }}': 1.725, 
                        '{{ $lang['Extremely'] ?? 'Extremely Active' }}': 1.9 
                    }">
                        <div class="flex justify-between p-3 rounded-lg transition-colors" 
                             :class="detail.activity.includes(name) ? 'bg-blue-50 border border-blue-100 text-blue-700 font-bold' : 'text-gray-600'">
                            <span x-text="name"></span>
                            <span x-text="Math.round(bmr * factor).toLocaleString()"></span>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
            <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm">
                <h3 class="text-center font-bold text-gray-700 mb-4">{{ $lang['77'] ?? 'TDEE Component Breakdown' }}</h3>
                <div id="componentsChart"></div>
            </div>
            
            <div class="bg-white rounded-xl p-6 border border-gray-100 shadow-sm flex flex-col justify-center">
                <div class="text-center space-y-4">
                    <div class="text-xl font-bold text-gray-800">
                        {{ $lang[49] ?? 'BMI Score' }}: <span class="text-blue-600" x-text="detail.BMI"></span>
                    </div>
                    <div class="inline-block px-6 py-2 rounded-full text-white font-bold"
                         :class="{
                            'bg-teal-500': detail.you_are === 'Underweight',
                            'bg-green-600': detail.you_are === 'Normal Weight',
                            'bg-yellow-500': detail.you_are === 'Overweight',
                            'bg-red-500': detail.you_are === 'Obesity',
                            'bg-red-700': detail.you_are === 'Severe Obesity'
                         }"
                         x-text="detail.you_are">
                    </div>
                    <p class="text-gray-500 text-sm">
                        {{ $lang[50] ?? 'Normal Range' }}: 18.5 - 24.9
                    </p>
                </div>
            </div>
        </div>

        <!-- Weight Goals -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
            <!-- Loss -->
            <div class="overflow-hidden rounded-xl border border-red-100">
                <div class="bg-red-500 p-4 flex items-center justify-center gap-3 text-white font-bold">
                    <img src="{{ asset('images/tdee_apple.svg') }}" class="w-6 h-6 brightness-0 invert">
                    {{ $lang['78'] ?? 'Weight Loss' }}
                </div>
                <div class="p-4 space-y-4 bg-white">
                    <div class="flex justify-between items-center p-3 border-b border-gray-50">
                        <div>
                            <div class="font-bold text-gray-700">{{ $lang['20'] ?? 'Mild Weight Loss' }}</div>
                            <div class="text-xs text-gray-400">0.5 lb / 0.25 kg week</div>
                        </div>
                        <div class="text-red-500 font-bold text-xl" x-text="Math.round(tdee * 0.9).toLocaleString()"></div>
                    </div>
                    <div class="flex justify-between items-center p-3 border-b border-gray-50">
                        <div>
                            <div class="font-bold text-gray-700">{{ $lang['22'] ?? 'Weight Loss' }}</div>
                            <div class="text-xs text-gray-400">1 lb / 0.5 kg week</div>
                        </div>
                        <div class="text-red-500 font-bold text-xl" x-text="Math.round(tdee * 0.8).toLocaleString()"></div>
                    </div>
                    <div class="flex justify-between items-center p-3">
                        <div>
                            <div class="font-bold text-gray-700">{{ $lang['23'] ?? 'Extreme Weight Loss' }}</div>
                            <div class="text-xs text-gray-400">2 lb / 1 kg week</div>
                        </div>
                        <div class="text-red-500 font-bold text-xl" x-text="Math.round(tdee * 0.6).toLocaleString()"></div>
                    </div>
                </div>
            </div>

            <!-- Gain -->
            <div class="overflow-hidden rounded-xl border border-green-100">
                <div class="bg-green-600 p-4 flex items-center justify-center gap-3 text-white font-bold">
                    <img src="{{ asset('images/tdee_arm.svg') }}" class="w-6 h-6 brightness-0 invert">
                    {{ $lang['80'] ?? 'Weight Gain' }}
                </div>
                <div class="p-4 space-y-4 bg-white">
                    <div class="flex justify-between items-center p-3 border-b border-gray-50">
                        <div>
                            <div class="font-bold text-gray-700">{{ $lang['25'] ?? 'Mild Weight Gain' }}</div>
                            <div class="text-xs text-gray-400">0.5 lb / 0.25 kg week</div>
                        </div>
                        <div class="text-blue-600 font-bold text-xl" x-text="Math.round(tdee * 1.1).toLocaleString()"></div>
                    </div>
                    <div class="flex justify-between items-center p-3 border-b border-gray-50">
                        <div>
                            <div class="font-bold text-gray-700">{{ $lang['26'] ?? 'Weight Gain' }}</div>
                            <div class="text-xs text-gray-400">1 lb / 0.5 kg week</div>
                        </div>
                        <div class="text-blue-600 font-bold text-xl" x-text="Math.round(tdee * 1.2).toLocaleString()"></div>
                    </div>
                    <div class="flex justify-between items-center p-3">
                        <div>
                            <div class="font-bold text-gray-700">{{ $lang['27'] ?? 'Extreme Weight Gain' }}</div>
                            <div class="text-xs text-gray-400">2 lb / 1 kg week</div>
                        </div>
                        <div class="text-blue-600 font-bold text-xl" x-text="Math.round(tdee * 1.4).toLocaleString()"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Macronutrients -->
        <div class="bg-white rounded-xl shadow-sm p-8 border border-blue-50 mt-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">{{ $lang[52] ?? 'Macronutrients' }}</h3>
            
            <div class="flex flex-wrap gap-3 mb-8 bg-gray-50 p-2 rounded-2xl w-fit">
                <button @click="macroMode = 'maintenance'; updateCharts()" :class="macroMode === 'maintenance' ? 'activeMacro shadow-lg' : 'text-gray-500 hover:bg-white'" class="px-6 py-2 rounded-xl font-bold transition-all">
                    {{ $lang['m1'] ?? 'Maintenance' }}
                </button>
                <button @click="macroMode = 'cutting'; updateCharts()" :class="macroMode === 'cutting' ? 'activeMacro shadow-lg' : 'text-gray-500 hover:bg-white'" class="px-6 py-2 rounded-xl font-bold transition-all">
                    {{ $lang['m2'] ?? 'Cutting' }}
                </button>
                <button @click="macroMode = 'bulking'; updateCharts()" :class="macroMode === 'bulking' ? 'activeMacro shadow-lg' : 'text-gray-500 hover:bg-white'" class="px-6 py-2 rounded-xl font-bold transition-all">
                    {{ $lang['m3'] ?? 'Bulking' }}
                </button>
                <button @click="macroMode = 'custom'; updateCharts()" :class="macroMode === 'custom' ? 'activeMacro shadow-lg' : 'text-gray-500 hover:bg-white'" class="px-6 py-2 rounded-xl font-bold transition-all">
                    {{ $lang[53] ?? 'Custom' }}
                </button>
            </div>

            <div x-show="macroMode !== 'custom'" class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Moderate -->
                <div class="text-center p-6 rounded-2xl border border-gray-100 hover:border-blue-200 transition-all">
                    <div class="font-bold text-gray-800 mb-4">{{ $lang['moderate'] ?? 'Moderate Carbs' }} (30/35/35)</div>
                    <div id="moderateChart"></div>
                    <div class="mt-4 space-y-2 text-sm font-semibold">
                        <div class="flex justify-between text-red-500"><span>Protein:</span> <span x-text="Math.round(((macroMode === 'cutting' ? tdee-500 : (macroMode === 'bulking' ? tdee+500 : tdee)) * 0.3) / 4) + 'g'"></span></div>
                        <div class="flex justify-between text-yellow-600"><span>Fats:</span> <span x-text="Math.round(((macroMode === 'cutting' ? tdee-500 : (macroMode === 'bulking' ? tdee+500 : tdee)) * 0.35) / 9) + 'g'"></span></div>
                        <div class="flex justify-between text-green-600"><span>Carbs:</span> <span x-text="Math.round(((macroMode === 'cutting' ? tdee-500 : (macroMode === 'bulking' ? tdee+500 : tdee)) * 0.35) / 4) + 'g'"></span></div>
                    </div>
                </div>
                <!-- Lower -->
                <div class="text-center p-6 rounded-2xl border border-gray-100 hover:border-blue-200 transition-all">
                    <div class="font-bold text-gray-800 mb-4">{{ $lang['lower'] ?? 'Lower Carbs' }} (40/40/20)</div>
                    <div id="lowerChart"></div>
                    <div class="mt-4 space-y-2 text-sm font-semibold">
                        <div class="flex justify-between text-red-500"><span>Protein:</span> <span x-text="Math.round(((macroMode === 'cutting' ? tdee-500 : (macroMode === 'bulking' ? tdee+500 : tdee)) * 0.4) / 4) + 'g'"></span></div>
                        <div class="flex justify-between text-yellow-600"><span>Fats:</span> <span x-text="Math.round(((macroMode === 'cutting' ? tdee-500 : (macroMode === 'bulking' ? tdee+500 : tdee)) * 0.4) / 9) + 'g'"></span></div>
                        <div class="flex justify-between text-green-600"><span>Carbs:</span> <span x-text="Math.round(((macroMode === 'cutting' ? tdee-500 : (macroMode === 'bulking' ? tdee+500 : tdee)) * 0.2) / 4) + 'g'"></span></div>
                    </div>
                </div>
                <!-- Higher -->
                <div class="text-center p-6 rounded-2xl border border-gray-100 hover:border-blue-200 transition-all">
                    <div class="font-bold text-gray-800 mb-4">{{ $lang['high'] ?? 'Higher Carbs' }} (30/20/50)</div>
                    <div id="higherChart"></div>
                    <div class="mt-4 space-y-2 text-sm font-semibold">
                        <div class="flex justify-between text-red-500"><span>Protein:</span> <span x-text="Math.round(((macroMode === 'cutting' ? tdee-500 : (macroMode === 'bulking' ? tdee+500 : tdee)) * 0.3) / 4) + 'g'"></span></div>
                        <div class="flex justify-between text-yellow-600"><span>Fats:</span> <span x-text="Math.round(((macroMode === 'cutting' ? tdee-500 : (macroMode === 'bulking' ? tdee+500 : tdee)) * 0.2) / 9) + 'g'"></span></div>
                        <div class="flex justify-between text-green-600"><span>Carbs:</span> <span x-text="Math.round(((macroMode === 'cutting' ? tdee-500 : (macroMode === 'bulking' ? tdee+500 : tdee)) * 0.5) / 4) + 'g'"></span></div>
                    </div>
                </div>
            </div>

            <!-- Custom Macros -->
            <div x-show="macroMode === 'custom'" class="max-w-3xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="space-y-4">
                        <div class="flex justify-between font-bold text-red-500">
                            <span>Protein</span>
                            <span x-text="customPro + '%'"></span>
                        </div>
                        <input type="range" x-model="customPro" min="10" max="60" @input="updateCharts()" class="accent-red-500">
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between font-bold text-yellow-600">
                            <span>Fats</span>
                            <span x-text="customFat + '%'"></span>
                        </div>
                        <input type="range" x-model="customFat" min="10" max="60" @input="updateCharts()" class="accent-yellow-500">
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between font-bold text-green-600">
                            <span>Carbs</span>
                            <span x-text="customCarb + '%'"></span>
                        </div>
                        <input type="range" x-model="customCarb" min="10" max="80" @input="updateCharts()" class="accent-green-500">
                    </div>
                </div>
                
                <div class="flex flex-col items-center">
                    <div id="customChart"></div>
                    <div class="mt-6 flex gap-8 font-bold">
                        <div class="text-red-500">Protein: <span x-text="Math.round((tdee * (customPro/100)) / 4) + 'g'"></span></div>
                        <div class="text-yellow-600">Fats: <span x-text="Math.round((tdee * (customFat/100)) / 9) + 'g'"></span></div>
                        <div class="text-green-600">Carbs: <span x-text="Math.round((tdee * (customCarb/100)) / 4) + 'g'"></span></div>
                    </div>
                    <div x-show="parseInt(customPro) + parseInt(customFat) + parseInt(customCarb) !== 100" class="text-red-500 mt-4 font-bold">
                        Warning: Percentages must total 100% (Current: <span x-text="parseInt(customPro) + parseInt(customFat) + parseInt(customCarb)"></span>%)
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
