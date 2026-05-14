<div>
    <style>
        .tagsUnit { background-color: #2845F5 !important; color: white !important; }
        .hover_tags:hover { background-color: #2845F5 !important; color: white !important; }
        .bg-light-blue { background-color: #F0F7FF; }
        .text-blue { color: #2845F5; }
        .border-blue { border-color: #2845F5; }
        .input_unit { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); font-weight: bold; color: #666; }
        .highcharts-credits { display: none; }
        .result_calculator select {
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

    <form wire:submit.prevent="calculate" x-data="{ unit_type: @entangle('unit_type'), surplus: @entangle('surplus'), stype: @entangle('stype') }">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                <div class="col-span-12">
                    <div class="grid grid-cols-12 lg:gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6 flex items-center">
                            <h2 class="text-xl font-bold">{{ $lang['title'] ?? 'Weight Gain Calories' }}</h2>
                        </div>

                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 w-full">
                                <div class="lg:w-1/2 w-full px-2 py-1">
                                    <button type="button" @click="unit_type = 'lbs'; $wire.setUnitType('lbs')" :class="unit_type === 'lbs' ? 'tagsUnit' : 'bg-white'" class="w-full px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white">
                                        {{ $lang['imperial'] }}
                                    </button>
                                </div>
                                <div class="lg:w-1/2 w-full px-2 py-1">
                                    <button type="button" @click="unit_type = 'kg'; $wire.setUnitType('kg')" :class="unit_type === 'kg' ? 'tagsUnit' : 'bg-white'" class="w-full px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white">
                                        {{ $lang['metric'] }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-4 md:gap-6">
                    <!-- Row 1: Gender & Age -->
                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{!! $lang['gender'] !!}:</label>
                        <div class="py-2">
                            <select wire:model.live="gender" class="input">
                                <option value="Male">{{ $lang['male'] }}</option>
                                <option value="Female">{{ $lang['female'] }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{!! $lang['your_age'] !!}:</label>
                        <div class="py-2">
                            <input type="number" step="any" wire:model.live="age" class="input" placeholder="00">
                        </div>
                    </div>

                    <!-- Row 2: Height & Weight -->
                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{!! $lang['height'] !!}:</label>
                        <div class="py-2">
                            <!-- Imperial Height (Dropdown) -->
                            <div x-show="unit_type === 'lbs'" style="{{ $unit_type === 'lbs' ? '' : 'display: none;' }}">
                                <select wire:model.live="height_ft" class="input">
                                    @foreach(["55"=>"4ft 7in","56"=>"4ft 8in","57"=>"4ft 9in","58"=>"4ft 10in","59"=>"4ft 11in","60"=>"5ft 0in","61"=>"5ft 1in","62"=>"5ft 2in","63"=>"5ft 3in","64"=>"5ft 4in","65"=>"5ft 5in","66"=>"5ft 6in","67"=>"5ft 7in","68"=>"5ft 8in","69"=>"5ft 9in","70"=>"5ft 10in","71"=>"5ft 11in","72"=>"6ft 0in","73"=>"6ft 1in","74"=>"6ft 2in","75"=>"6ft 3in","76"=>"6ft 4in","77"=>"6ft 5in","78"=>"6ft 6in","79"=>"6ft 7in","80"=>"6ft 8in","81"=>"6ft 9in","82"=>"6ft 10in","83"=>"6ft 11in","84"=>"7ft 0in"] as $val => $name)
                                        <option value="{{ $val }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Metric Height (Input) -->
                            <div x-show="unit_type === 'kg'" style="{{ $unit_type === 'kg' ? '' : 'display: none;' }}" class="relative w-full">
                                <input type="number" step="any" wire:model.live="height_cm" class="input pr-12" placeholder="00">
                                <span class="input_unit">cm</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{!! $lang['weight'] !!}:</label>
                        <div class="relative w-full py-2">
                            <input type="number" step="any" wire:model.live="weight" class="input pr-12" placeholder="00">
                            <span class="input_unit" x-text="unit_type"></span>
                        </div>
                    </div>

                    <!-- Row 3: Weight Gain Goal & Activity -->
                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{!! $lang['i_want'] !!}:</label>
                        <div class="relative w-full py-2">
                            <input type="number" step="any" wire:model.live="weight1" class="input pr-12" placeholder="00">
                            <span class="input_unit" x-text="unit_type"></span>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{!! $lang['daily_activity'] !!}:</label>
                        <div class="py-2">
                            <select wire:model.live="activity" class="input">
                                <option value="sedentary">{{ $lang['No_sport'] }}</option>
                                <option value="Lightly_Active">{{ $lang['Light_activity'] }}</option>
                                <option value="Moderately_Active">{{ $lang['Moderate_activity'] }}</option>
                                <option value="Very_Active">{{ $lang['High_activity'] }}</option>
                                <option value="ext">{{ $lang['Extreme_activity'] }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Row 4: Surplus Selection -->
                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{!! $lang['48'] !!}:</label>
                        <div class="py-2">
                            <select wire:model.live="surplus" class="input">
                                <option value="0.10">{{ $lang['49'] }}</option>
                                <option value="0.15">{{ $lang['50'] }}</option>
                                <option value="0.20">{{ $lang['51'] }}</option>
                                <option value="custom">{{ $lang['52'] }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{!! $lang['body_fat'] !!} (%):</label>
                        <div class="relative w-full py-2">
                            <input type="number" step="any" wire:model.live="percent" class="input pr-12" placeholder="0%">
                            <span class="input_unit">%</span>
                        </div>
                    </div>

                    <!-- Row 5: Custom Surplus Fields (Conditional) -->
                    <div class="col-span-12 grid grid-cols-12 gap-4" x-show="surplus === 'custom'" style="{{ $surplus === 'custom' ? '' : 'display: none;' }}">
                        <div class="col-span-12 md:col-span-6">
                            <label class="label">{{ $lang['53'] }}:</label>
                            <div class="flex items-center gap-4 py-2">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" value="Incal" wire:model.live="stype" class="w-4 h-4 text-blue border-gray-300 focus:ring-blue-500">
                                    <span class="text-sm font-medium text-gray-700">{{ $lang['54'] }}</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" value="per_cal" wire:model.live="stype" class="w-4 h-4 text-blue border-gray-300 focus:ring-blue-500">
                                    <span class="text-sm font-medium text-gray-700">{{ $lang['55'] }}</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <div x-show="stype === 'Incal'">
                                <label class="label">{{ $lang['54'] }}:</label>
                                <div class="relative w-full py-2">
                                    <input type="number" step="any" wire:model.live="kal_day" class="input pr-24" placeholder="00">
                                    <span class="input_unit">kcal/day</span>
                                </div>
                            </div>
                            <div x-show="stype === 'per_cal'">
                                <label class="label">{{ $lang['55'] }}:</label>
                                <div class="relative w-full py-2">
                                    <input type="number" step="any" wire:model.live="per_cal" class="input pr-12" placeholder="00">
                                    <span class="input_unit">%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 6: Dates -->
                    <div class="col-span-12"><strong class="text-blue">{{ $lang['to_achieve'] }}?</strong></div>
                    
                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{!! $lang['41'] !!}:</label>
                        <div class="py-2">
                            <input type="date" wire:model.live="start" class="input">
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{!! $lang['42'] !!}:</label>
                        <div class="py-2">
                            <input type="date" wire:model.live="target" class="input">
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
        </div>
    </form>

    <!-- Result Section -->
    @isset($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result"
         x-data="{ 
            macroType: '1',
            detail: @js($detail),
            weight: @js($weight),
            lang: @js($lang),
            macroData: { cb: 0, po: 0, fat: 0 },
            init() {
                this.updateMacros();
                this.renderWeightChart();
            },
            updateMacros() {
                const cal = this.detail.CaloriesDaily;
                let f = 0.2, p = 0.3, c = 0.5;
                if (this.macroType === '2') { f = 0.2; p = 0.4; c = 0.4; }
                else if (this.macroType === '3') { f = 0.3; p = 0.3; c = 0.4; }
                else if (this.macroType === '4') { f = 0.35; p = 0.45; c = 0.2; }
                else if (this.macroType === '5') { f = 0.7; p = 0.25; c = 0.05; }
                
                this.macroData.fat = Math.round((cal / 9) * f);
                this.macroData.po = Math.round((cal / 4) * p);
                this.macroData.cb = Math.round((cal / 4) * c);

                this.renderMacroChart();
            },
            renderWeightChart() {
                if (typeof Highcharts === 'undefined') {
                    setTimeout(() => this.renderWeightChart(), 200);
                    return;
                }
                const categories = [];
                const data = [];
                let w = parseFloat(this.weight);
                for (let i = 1; i <= this.detail.days; i++) {
                    const date = new Date();
                    date.setDate(date.getDate() + i);
                    categories.push(date.toLocaleDateString('en-GB', { day: '2-digit', month: 'short' }));
                    data.push(parseFloat(w.toFixed(2)));
                    if (this.detail.want === '2') {
                        w += this.detail.PoundsDaily;
                    }
                }
                Highcharts.chart($refs.canvas1, {
                    chart: { type: 'line', backgroundColor: 'transparent' },
                    title: { text: null },
                    xAxis: { categories: categories, title: { text: this.lang['1'] } },
                    yAxis: { title: { text: this.lang['weight'] } },
                    legend: { enabled: false },
                    credits: { enabled: false },
                    series: [{ name: 'Weight', color: '#2845F5', data: data }]
                });
            },
            renderMacroChart() {
                if (typeof Highcharts === 'undefined') {
                    setTimeout(() => this.renderMacroChart(), 200);
                    return;
                }
                Highcharts.chart($refs.canvas2, {
                    chart: { type: 'column', inverted: true, polar: true, backgroundColor: 'transparent' },
                    title: { text: null },
                    pane: { size: '85%', innerSize: '20%', endAngle: 270 },
                    xAxis: { tickInterval: 1, lineWidth: 0, categories: [''] },
                    yAxis: { lineWidth: 0, tickInterval: 25, reversedStacks: false },
                    credits: { enabled: false },
                    plotOptions: { column: { stacking: 'normal', borderWidth: 0, pointPadding: 0, groupPadding: 0.15 } },
                    series: [
                        { name: 'CARBS', color: '#623a6c', data: [this.macroData.cb] },
                        { name: 'PROTEIN', color: '#b04c7a', data: [this.macroData.po] },
                        { name: 'FATS', color: '#e06f85', data: [this.macroData.fat] }
                    ]
                });
            }
         }"
         x-init="init()">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full p-3 mt-3">
                        <div class="w-full">
                            <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <div class=""><strong class="text-[18px]">{{ $lang['39'] }}</strong></div>
                                        <div class="border-s-dark ps-2">
                                            <div><strong class="text-green-700 text-[25px]">{{ $detail['CaloriesDaily'] }}</strong></div>
                                            <div>{{ $lang['c/d'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <div class=""><strong class="text-[18px]">{{ $lang['11'] }}</strong></div>
                                        <div class="border-s-dark ps-2">
                                            <div><strong class="text-green-700 text-[25px]">{{ $detail['CaloriesLess'] }}</strong></div>
                                            <div>{{ $lang['c/d'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 ">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <div class="border-end pe-2 pe-lg-3">
                                            <div class="mb-1" class=""><strong class="text-[18px]">{{ $lang['22'] }}</strong></div>
                                            <div>{{ $lang['56'] }}</div>
                                        </div>
                                        <div class="ps-2 ps-lg-3">
                                            <div><strong class="text-green-700 text-[25px]">{{ $detail['BMR'] }}</strong></div>
                                            <div>{{ $lang['c/d'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 ">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <div class="border-end pe-2 pe-lg-3">
                                            <div class="mb-1" class=""><strong class="text-[18px]">TDEE</strong></div>
                                            <div>{{ $lang['57'] }}</div>
                                        </div>
                                        <div class="ps-2 ps-lg-3">
                                            <div><strong class="text-green-700 text-[25px]">{{ $detail['Calories'] }}</strong></div>
                                            <div>{{ $lang['c/d'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <div class=""><strong class="text-[18px]">{{ $lang['40'] }}</strong></div>
                                        <div class="border-s-dark ps-2 ps-lg-3">
                                            <div><strong class="text-green-700 text-[25px]">{{ $detail['days'] }}</strong></div>
                                            <div>{{ $lang['1'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-3" style="min-height:64px;border: 1px solid #c1b8b899;">
                                        <div class=""><strong class="text-[18px]">{{ $lang['Target_Date'] }}</strong></div>
                                        <div class="border-s-dark ps-2">
                                            <div>
                                                <strong class="text-green-700 text-[25px]">
                                                    @php $NewDate = Date('d-M-Y', strtotime("+" . @$detail['days'] . " days")) @endphp
                                                    {{ $NewDate }}
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-2" class=""><strong class="text-[18px]">{{ $lang[58] }}</strong></p>
                            <p class="">{{ $lang[59] }}</p>
                            <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 my-3 items-center">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6"><strong>{{ $lang[60] }}</strong></div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="py-2">
                                        <select x-model="macroType" @change="updateMacros()" class="input" id="macro">
                                            <option value="1">{{ $lang[61] }}</option>
                                            <option value="2">{{ $lang[62] }}</option>
                                            <option value="3">{{ $lang[63] }}</option>
                                            <option value="4">{{ $lang[64] }}</option>
                                            <option value="5">{{ $lang[65] }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full  mx-auto my-4 bg-[#F6FAFC] p-4 border-2 rounded-2xl" style="top:30px;border: 1px solid #c1b8b899;">
                                <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4 my-3">
                                    <div class="col-span-12 md:col-span-3 lg:col-span-3">
                                        <div class="mb-1"><strong>{{ $lang[44] }}</strong></div>
                                        <div>
                                            <strong class="cbval font-s-25" x-text="macroData.cb"></strong>
                                            <span>{{ $lang[45] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-span-1 md:border-r-2 lg:border-r-2">&nbsp;</div>
                                    <div class="col-span-12 md:col-span-3 lg:col-span-3">
                                        <div class="mb-1"><strong>{{ $lang[46] }}</strong></div>
                                        <div>
                                            <strong class="poval font-s-25" x-text="macroData.po"></strong>
                                            <span>{{ $lang[45] }}</span>
                                        </div>
                                    </div>
                                    <div class="col-span-1 md:border-r-2 lg:border-r-2">&nbsp;</div>
                                    <div class="col-span-12 md:col-span-3 lg:col-span-3">
                                        <div class="mb-1"><strong>{{ $lang[47] }}</strong></div>
                                        <div>
                                            <strong class="fatval font-s-25" x-text="macroData.fat"></strong>
                                            <span>{{ $lang[45] }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                
                            @if($detail['HighRiskCalories'] == '1')
                                <p class="text--[18px] col s12 padding_10">
                                    <strong class="red-text">{{ $lang['3'] }}!</strong>
                                    {{ $lang['4'] }} {{ @$detail['CaloriesDaily'] }} {{ $lang['c/d'] }} , {{ $lang['5'] }}
                                    {{ @$detail['CaloriesDaily'] }} {{ $lang['6'] }}!
                                </p>
                            @endif
                                <div class="col-span-12 md:col-span-6 lg:col-span-6 border-r-2" wire:ignore>
                                    <p class="ps-3"><strong class="font-s-20">{{ $lang['10'] }}</strong></p>
                                    <div x-ref="canvas1" class="mt-3 w-full h-[250px]"></div>
                                </div>

                                <div class="col-span-12 md:col-span-6 lg:col-span-6" wire:ignore>
                                    <p class="ps-3"><strong class="font-s-20">MACRO</strong></p>
                                    <div x-ref="canvas2" class="w-full h-[250px]"></div>
                                </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @endisset

    @push('calculatorJS')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
    @endpush
</div>
