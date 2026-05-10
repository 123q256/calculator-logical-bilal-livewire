<div>
    @php
    $metricCountries = ["United States", "Canada", "United Kingdom", "Pakistan"];
    @endphp

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
        .unit-label-abs {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 14px;
            text-decoration: underline;
            color: #278ECD;
        }
        .unit-dropdown-item {
            padding: 8px 12px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .unit-dropdown-item:hover { background: #f3f4f6; }
        input[type=range] { -webkit-appearance: none; width: 100%; background: transparent; }
        input[type=range]::-webkit-slider-runnable-track { width: 100%; height: 8px; cursor: pointer; background: #ddd; border-radius: 5px; }
        input[type=range]::-webkit-slider-thumb { border: 2px solid #278ECD; height: 20px; width: 20px; border-radius: 50%; background: #ffffff; cursor: pointer; -webkit-appearance: none; margin-top: -6px; }
    </style>

    @push('calculatorJS')
        <script src="https://code.highcharts.com/highcharts.js"></script>
    @endpush

    <div x-data="{
        unit: @entangle('unit'),
        weight: @entangle('weight'),
        hightUnit: @entangle('hightUnit'),
        height_cm: @entangle('height_cm'),
        height_ft: @entangle('height_ft'),
        height_in: @entangle('height_in'),
        openWeightUnit: false,
        openHeightUnit: false,
        
        convertWeight(newUnit) {
            if (newUnit === 'kg' && this.unit === 'lbs') {
                this.weight = (this.weight / 2.20462).toFixed(2);
            } else if (newUnit === 'lbs' && this.unit === 'kg') {
                this.weight = (this.weight * 2.20462).toFixed(2);
            }
            this.unit = newUnit;
            this.openWeightUnit = false;
        },
        
        convertHeight(newUnit) {
            if (newUnit === 'cm' && this.hightUnit === 'ft/in') {
                this.height_cm = ((this.height_ft * 30.48) + (this.height_in * 2.54)).toFixed(2);
            } else if (newUnit === 'ft/in' && this.hightUnit === 'cm') {
                let totalInches = this.height_cm / 2.54;
                this.height_ft = Math.floor(totalInches / 12);
                this.height_in = Math.round(totalInches % 12);
            }
            this.hightUnit = newUnit;
            this.openHeightUnit = false;
        }
    }">
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
                            <input type="number" step="any" x-model="weight" class="input w-full border border-gray-300 rounded-lg px-4 py-2" />
                            <label @click="openWeightUnit = !openWeightUnit" class="unit-label-abs" x-text="unit + ' ▾'"></label>
                            <div x-show="openWeightUnit" @click.away="openWeightUnit = false" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-lg mt-1 right-0 min-w-[60px]" x-cloak>
                                <p class="unit-dropdown-item" @click="convertWeight('lbs')">lbs</p>
                                <p class="unit-dropdown-item" @click="convertWeight('kg')">kg</p>
                            </div>
                        </div>
                    </div>

                    <!-- Height -->
                    <div class="w-full lg:w-1/3 px-2 mb-4">
                        <template x-if="hightUnit === 'ft/in'">
                            <div class="flex gap-2">
                                <div class="w-1/2">
                                    <label class="label font-semibold">{!! $lang['height'] !!} (ft):</label>
                                    <div class="w-full py-2">
                                        <input type="number" x-model="height_ft" min="4" max="7" class="input w-full border border-gray-300 rounded-lg px-4 py-2" />
                                    </div>
                                </div>
                                <div class="w-1/2">
                                    <label class="label font-semibold">(in):</label>
                                    <div class="relative w-full py-2">
                                        <input type="number" x-model="height_in" min="0" max="11" class="input w-full border border-gray-300 rounded-lg px-4 py-2" />
                                        <label @click="openHeightUnit = !openHeightUnit" class="unit-label-abs">ft/in ▾</label>
                                        <div x-show="openHeightUnit" @click.away="openHeightUnit = false" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-lg mt-1 right-0 min-w-[70px]" x-cloak>
                                            <p class="unit-dropdown-item" @click="convertHeight('cm')">cm</p>
                                            <p class="unit-dropdown-item font-bold text-blue-600 bg-blue-50">ft/in</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <template x-if="hightUnit === 'cm'">
                            <div>
                                <label class="label font-semibold">{{ $lang['height'] }} (cm):</label>
                                <div class="relative w-full py-2">
                                    <input type="number" step="any" x-model="height_cm" class="input w-full border border-gray-300 rounded-lg px-4 py-2" />
                                    <label @click="openHeightUnit = !openHeightUnit" class="unit-label-abs">cm ▾</label>
                                    <div x-show="openHeightUnit" @click.away="openHeightUnit = false" class="absolute z-10 bg-white border border-gray-300 rounded-md shadow-lg mt-1 right-0 min-w-[70px]" x-cloak>
                                        <p class="unit-dropdown-item font-bold text-blue-600 bg-blue-50">cm</p>
                                        <p class="unit-dropdown-item" @click="convertHeight('ft/in')">ft/in</p>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Activity -->
                    <div class="w-full lg:w-1/2 px-2 mb-4">
                        <label class="label font-semibold">{!! $lang['activity'] !!}:</label>
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
                        <label class="label font-semibold">{!! $lang['b_f'] !!} ({{ $lang['opt'] ?? 'optional' }}):</label>
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
    <div id="result-section" 
         x-data="{ 
            detail: @entangle('detail'),
            formula: 'mifflin',
            macroMode: 'maintenance',
            customPro: 25,
            customFat: 28,
            customCarb: 47,
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
                        chart: { type: 'pie', width: 100, height: 100, backgroundColor: 'transparent' },
                        title: { text: null },
                        plotOptions: {
                            pie: {
                                dataLabels: { enabled: false },
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
                renderSmallPie('moderateChart', 30, 35, 35);
                renderSmallPie('lowerChart', 40, 40, 20);
                renderSmallPie('higherChart', 30, 20, 50);
                if (this.macroMode === 'custom') {
                    renderSmallPie('custom_moderate', this.customPro, this.customFat, this.customCarb);
                }
            }
         }"
         x-init="
            updateCharts(); 
            window.addEventListener('render-graph', () => updateCharts());
            $watch('macroMode', () => { $nextTick(() => renderMacroCharts()); });
         "
         class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 mt-10 scroll-mt-20">
        
        <div class="flex flex-col md:flex-row justify-between items-center">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            <div class="mt-4 md:mt-0 lg:w-[30%]">
                <select x-model="formula" @change="updateCharts()" class="resultInput w-full px-4 border border-blue-200">
                    <option value="mifflin">{{ $lang['66'] ?? 'Mifflin-St Jeor' }}</option>
                    <option value="revised">{{ $lang['67'] ?? 'Harris-Benedict' }}</option>
                    <option value="katch">{{ $lang['68'] ?? 'Katch-McArdle' }}</option>
                </select>
            </div>
        </div>

        <div class="bg-white rounded-lg p-5 mt-3">
            <div class="rounded-lg p-4">
                <p class="text-center text-xl font-bold mt-3 text-blue-600 uppercase"><strong>{{$lang['70']}} (TDEE)</strong></p>
                
                <div class="lg:flex md:flex justify-between gap-6">
                    <!-- TDEE Score -->
                    <div class="lg:w-1/2 mt-3 flex flex-col justify-center">
                        <div class="bg-[#F6FAFC] rounded-lg text-center p-8 border border-blue-50">
                            <p><b class="text-green-600 text-6xl" x-text="tdee.toLocaleString()"></b></p>
                            <p class="text-sm font-bold pb-2 border-b border-gray-200 text-gray-500 uppercase tracking-widest mt-2">{{$lang['71']}}</p>
                            <p class="text-sm mt-4 text-left leading-relaxed">
                                Based on the <b x-text="formula === 'mifflin' ? '{{$lang['66']}}' : (formula === 'revised' ? '{{$lang['67']}}' : '{{$lang['68']}}')"></b>, 
                                you have a total daily energy expenditure of <b x-text="tdee.toLocaleString()"></b> calories, 
                                which is <b x-text="(tdee * 7).toLocaleString()"></b> calories per week.
                            </p>
                        </div>
                    </div>

                    <!-- Activity Levels Table -->
                    <div class="lg:w-1/2 pl-4 mt-3 text-sm border-l border-gray-200 space-y-1">
                        <div class="flex items-center justify-between p-2 border-b border-gray-100 font-bold text-gray-700">
                            <p class="flex items-center gap-2">
                                <img src="{{ asset('images/tdee_cal.svg') }}" class="w-6 h-6">
                                <b>{{$lang['75']}}</b>
                            </p>
                            <p><b>{{$lang['76']}}</b></p>
                        </div>
                        
                        <template x-for="(factor, name) in { 
                            '{{$lang[64]}}': 1.2, 
                            '{{ $lang['Lightly'] }}': 1.375, 
                            '{{ $lang['Moderately'] }}': 1.55, 
                            '{{ $lang['Very'] }}': 1.725, 
                            '{{ $lang['Extremely'] }}': 1.9 
                        }">
                            <div class="flex items-center justify-between p-2 rounded-md transition-colors" 
                                 :class="detail.activity.includes(name) ? 'bg-[#F6FAFC] font-bold text-blue-600' : 'text-gray-600'">
                                <p x-text="name"></p>
                                <p x-text="Math.round(bmr * factor).toLocaleString()"></p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Components Chart -->
            <p class="text-center text-lg mt-8">
                <strong class="text-blue-600">{{$lang['77']}}</strong>
            </p>
            <div class="w-full flex justify-center py-4">
                <div id="componentsChart" style="width: 100%; max-width: 600px; height:300px"></div>
            </div>

            <!-- BMI Details -->
            <p class="mt-3 text-lg text-center">
                <strong id="bmiDetails">{{ $lang[49] }}: <span class="text-blue-600" x-text="detail.BMI"></span> (
                    <span :class="{
                        'text-teal-600': detail.you_are === 'Underweight',
                        'text-green-700': detail.you_are === 'Normal Weight',
                        'text-yellow-600': detail.you_are === 'Overweight',
                        'text-red-600': detail.you_are === 'Obesity',
                        'text-red-700': detail.you_are === 'Severe Obesity'
                    }" x-text="detail.you_are"></span>
                ), {{ $lang[50] }}: 18.5 to 24.9
                </strong>
            </p>

            <!-- Weight Loss/Gain Grid -->
            <div class="flex flex-col lg:flex-row gap-6 mt-8">
                <!-- Weight Loss -->
                <div class="w-full lg:w-1/2">
                    <div class="flex items-center justify-center p-3 bg-red-600 rounded-t-lg gap-2 shadow-sm">
                        <img src="{{ asset('images/tdee_apple.svg') }}" class="w-5 h-5 brightness-0 invert">
                        <p class="text-white font-bold">{{$lang['78']}}</p>
                    </div>
                    <div class="w-full text-sm px-2 border border-red-100 rounded-b-lg bg-white shadow-sm">
                        <div class="flex items-center justify-between py-4 px-4 border-b border-gray-50">
                            <div>
                                <p class="font-bold text-gray-700">{{ $lang['20'] }}</p>
                                <p class="text-xs text-gray-400" x-text="detail.submit === 'lbs' ? '(0.5 lb {{$lang['79']}})' : '(0.25 kg {{$lang['79']}})'"></p>
                            </div>
                            <p class="text-red-500 font-bold text-lg"><span x-text="Math.round(tdee * 0.9).toLocaleString()"></span> <span class="text-gray-300 font-normal text-xs">(90%)</span></p>
                        </div>
                        <div class="flex items-center justify-between py-4 px-4 border-b border-gray-50">
                            <div>
                                <p class="font-bold text-gray-700">{{ $lang['22'] }}</p>
                                <p class="text-xs text-gray-400" x-text="detail.submit === 'lbs' ? '(1 lb {{$lang['79']}})' : '(0.5 kg {{$lang['79']}})'"></p>
                            </div>
                            <p class="text-red-500 font-bold text-lg"><span x-text="Math.round(tdee * 0.8).toLocaleString()"></span> <span class="text-gray-300 font-normal text-xs">(80%)</span></p>
                        </div>
                        <div class="flex items-center justify-between py-4 px-4">
                            <div>
                                <p class="font-bold text-gray-700">{{ $lang['23'] }}</p>
                                <p class="text-xs text-gray-400" x-text="detail.submit === 'lbs' ? '(2 lb {{$lang['79']}})' : '(1 kg {{$lang['79']}})'"></p>
                            </div>
                            <p class="text-red-500 font-bold text-lg"><span x-text="Math.round(tdee * 0.61).toLocaleString()"></span> <span class="text-gray-300 font-normal text-xs">(61%)</span></p>
                        </div>
                    </div>
                </div>
            
                <!-- Weight Gain -->
                <div class="w-full lg:w-1/2">
                    <div class="flex items-center justify-center p-3 bg-green-600 rounded-t-lg gap-2 shadow-sm">
                        <img src="{{ asset('images/tdee_arm.svg') }}" class="w-5 h-5 brightness-0 invert">
                        <p class="text-white font-bold">{{$lang['80']}}</p>
                    </div>
                    <div class="w-full text-sm px-2 border border-green-100 rounded-b-lg bg-white shadow-sm">
                        <div class="flex items-center justify-between py-4 px-4 border-b border-gray-50">
                            <div>
                                <p class="font-bold text-gray-700">{{ $lang['25'] }}</p>
                                <p class="text-xs text-gray-400" x-text="detail.submit === 'lbs' ? '(0.5 lb {{$lang['79']}})' : '(0.25 kg {{$lang['79']}})'"></p>
                            </div>
                            <p class="text-blue-600 font-bold text-lg"><span x-text="Math.round(tdee * 1.1).toLocaleString()"></span> <span class="text-gray-300 font-normal text-xs">(110%)</span></p>
                        </div>
                        <div class="flex items-center justify-between py-4 px-4 border-b border-gray-50">
                            <div>
                                <p class="font-bold text-gray-700">{{ $lang['26'] }}</p>
                                <p class="text-xs text-gray-400" x-text="detail.submit === 'lbs' ? '(1 lb {{$lang['79']}})' : '(0.5 kg {{$lang['79']}})'"></p>
                            </div>
                            <p class="text-blue-600 font-bold text-lg"><span x-text="Math.round(tdee * 1.2).toLocaleString()"></span> <span class="text-gray-300 font-normal text-xs">(120%)</span></p>
                        </div>
                        <div class="flex items-center justify-between py-4 px-4">
                            <div>
                                <p class="font-bold text-gray-700">{{ $lang['27'] }}</p>
                                <p class="text-xs text-gray-400" x-text="detail.submit === 'lbs' ? '(2 lb {{$lang['79']}})' : '(1 kg {{$lang['79']}})'"></p>
                            </div>
                            <p class="text-blue-600 font-bold text-lg"><span x-text="Math.round(tdee * 1.39).toLocaleString()"></span> <span class="text-gray-300 font-normal text-xs">(139%)</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Macronutrients Section -->
            <p class="mt-8 text-2xl text-blue-600 font-bold uppercase text-center border-b border-blue-50 pb-4"><b>{{ $lang[52] }}</b></p>
            
            <div class="max-w-3xl mx-auto mt-6">
                <div class="flex items-center justify-between p-1 bg-gray-100 rounded-2xl shadow-inner gap-1">
                    <button @click="macroMode = 'maintenance'; updateCharts()" 
                            class="flex-1 py-3 px-2 rounded-xl font-bold transition-all text-sm md:text-base" 
                            :class="macroMode === 'maintenance' ? 'bg-[#278ECD] text-white shadow-md' : 'text-gray-500 hover:bg-white'">
                        {{ $lang['m1'] }}
                    </button>
                    <button @click="macroMode = 'cutting'; updateCharts()" 
                            class="flex-1 py-3 px-2 rounded-xl font-bold transition-all text-sm md:text-base" 
                            :class="macroMode === 'cutting' ? 'bg-[#278ECD] text-white shadow-md' : 'text-gray-500 hover:bg-white'">
                        {{ $lang['m2'] }}
                    </button>
                    <button @click="macroMode = 'bulking'; updateCharts()" 
                            class="flex-1 py-3 px-2 rounded-xl font-bold transition-all text-sm md:text-base" 
                            :class="macroMode === 'bulking' ? 'bg-[#278ECD] text-white shadow-md' : 'text-gray-500 hover:bg-white'">
                        {{ $lang['m3'] }}
                    </button>
                    <button @click="macroMode = 'custom'; updateCharts()" 
                            class="flex-1 py-3 px-2 rounded-xl font-bold transition-all text-sm md:text-base" 
                            :class="macroMode === 'custom' ? 'bg-[#278ECD] text-white shadow-md' : 'text-gray-500 hover:bg-white'">
                        {{ $lang[53] }}
                    </button>
                </div>
            </div>

            <div class="mt-8">
                <!-- Description Line -->
                <p class="text-center text-gray-600 italic mb-6">
                    <span x-show="macroMode === 'maintenance'">{{ $lang['m1_des'] }} <strong x-text="tdee.toLocaleString()"></strong> {{ $lang['m1_des1'] }}</span>
                    <span x-show="macroMode === 'cutting'">{{ $lang['m2_des'] }} <strong x-text="(tdee - 500).toLocaleString()"></strong> {{ $lang['m2_des1'] }} <strong x-text="tdee.toLocaleString()"></strong> {{ $lang['m1_des1'] }}</span>
                    <span x-show="macroMode === 'bulking'">{{ $lang['m3_des'] }} <strong x-text="(tdee + 500).toLocaleString()"></strong> {{ $lang['m3_des1'] }} <strong x-text="tdee.toLocaleString()"></strong> {{ $lang['m1_des1'] }}</span>
                    <span x-show="macroMode === 'custom'" class="font-bold text-blue-600">Custom Macronutrient Breakdown</span>
                </p>

                <!-- Non-Custom View (3 Charts) -->
                <div x-show="macroMode !== 'custom'" class="flex flex-wrap justify-center gap-8 animate-in fade-in duration-500">
                    <template x-for="(macro, index) in [
                        { name: '{{ $lang['moderate'] }} (30/35/35)', id: 'moderateChart', p: 0.3, f: 0.35, c: 0.35 },
                        { name: '{{ $lang['lower'] }} (40/40/20)', id: 'lowerChart', p: 0.4, f: 0.4, c: 0.2 },
                        { name: '{{ $lang['high'] }} (30/20/50)', id: 'higherChart', p: 0.3, f: 0.2, c: 0.5 }
                    ]">
                        <div class="w-full md:w-[30%] bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                            <p class="mb-4 text-center font-bold text-gray-800" x-text="macro.name"></p>
                            <div class="flex justify-between items-center">
                                <div class="space-y-4 text-sm font-bold">
                                    <div class="text-red-600">
                                        <div class="flex items-center gap-1"><img src="{{ asset('images/chart_pro.jpg') }}" class="w-3 h-3 object-contain"> <span x-text="'{{ $lang['pro'] }}'"></span></div>
                                        <p x-text="Math.round(((macroMode === 'cutting' ? tdee-500 : (macroMode === 'bulking' ? tdee+500 : tdee)) * macro.p) / 4) + ' g'"></p>
                                    </div>
                                    <div class="text-yellow-600">
                                        <div class="flex items-center gap-1"><img src="{{ asset('images/chart_fat.jpg') }}" class="w-3 h-3 object-contain"> <span x-text="'{{ $lang['fat'] }}'"></span></div>
                                        <p x-text="Math.round(((macroMode === 'cutting' ? tdee-500 : (macroMode === 'bulking' ? tdee+500 : tdee)) * macro.f) / 9) + ' g'"></p>
                                    </div>
                                    <div class="text-green-600">
                                        <div class="flex items-center gap-1"><img src="{{ asset('images/chart_carb.jpg') }}" class="w-3 h-3 object-contain"> <span x-text="'{{ $lang['carb'] }}'"></span></div>
                                        <p x-text="Math.round(((macroMode === 'cutting' ? tdee-500 : (macroMode === 'bulking' ? tdee+500 : tdee)) * macro.c) / 4) + ' g'"></p>
                                    </div>
                                </div>
                                <div :id="macro.id"></div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Custom View (Sliders + 1 Chart) -->
                <div x-show="macroMode === 'custom'" class="animate-in fade-in duration-500">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                        <!-- Protein Box -->
                        <div class="bg-red-50/50 p-6 rounded-2xl border border-red-100">
                            <div class="flex justify-between font-bold text-red-600 mb-4">
                                <span class="text-lg">Protein</span>
                                <span class="text-lg" x-text="customPro + '%'"></span>
                            </div>
                            <input type="range" min="10" max="60" x-model="customPro" @input="updateCharts()" class="w-full accent-red-600">
                        </div>
                        <!-- Fats Box -->
                        <div class="bg-yellow-50/50 p-6 rounded-2xl border border-yellow-100">
                            <div class="flex justify-between font-bold text-yellow-600 mb-4">
                                <span class="text-lg">Fats</span>
                                <span class="text-lg" x-text="customFat + '%'"></span>
                            </div>
                            <input type="range" min="10" max="60" x-model="customFat" @input="updateCharts()" class="w-full accent-yellow-600">
                        </div>
                        <!-- Carbs Box -->
                        <div class="bg-green-50/50 p-6 rounded-2xl border border-green-100">
                            <div class="flex justify-between font-bold text-green-600 mb-4">
                                <span class="text-lg">Carbs</span>
                                <span class="text-lg" x-text="customCarb + '%'"></span>
                            </div>
                            <input type="range" min="10" max="80" x-model="customCarb" @input="updateCharts()" class="w-full accent-green-600">
                        </div>
                    </div>
                    
                    <div class="flex flex-col items-center mt-12 bg-white p-8 rounded-3xl border border-gray-50 shadow-sm max-w-2xl mx-auto">
                        <div id="custom_moderate" style="width: 250px; height: 250px;"></div>
                        
                        <div class="grid grid-cols-3 gap-12 mt-8 w-full">
                            <div class="text-center">
                                <p class="text-red-600 font-bold mb-1">Protein</p>
                                <p class="text-2xl font-black text-red-700" x-text="Math.round((tdee * (customPro/100)) / 4) + ' g'"></p>
                            </div>
                            <div class="text-center">
                                <p class="text-yellow-600 font-bold mb-1">Fats</p>
                                <p class="text-2xl font-black text-yellow-700" x-text="Math.round((tdee * (customFat/100)) / 9) + ' g'"></p>
                            </div>
                            <div class="text-center">
                                <p class="text-green-600 font-bold mb-1">Carbs</p>
                                <p class="text-2xl font-black text-green-700" x-text="Math.round((tdee * (customCarb/100)) / 4) + ' g'"></p>
                            </div>
                        </div>
                        
                        <div x-show="parseInt(customPro) + parseInt(customFat) + parseInt(customCarb) !== 100" class="mt-6 px-4 py-2 bg-red-100 text-red-700 rounded-lg font-bold text-sm">
                            ⚠️ Percentages must total 100% (Current: <span x-text="parseInt(customPro) + parseInt(customFat) + parseInt(customCarb)"></span>%)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
