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

    <form wire:submit.prevent="calculate" x-data="{ unit_type: @entangle('unit_type') }">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-6">
                    <div class="col-span-12">
                        <div class="grid grid-cols-12 gap-4 md:gap-6">
                            <!-- Row 1: Gender & Unit Switcher -->
                            <div class="col-span-12 md:col-span-6">
                                <label class="label">{{ $lang['1'] }}:</label>
                                <div class="py-2">
                                    <select wire:model.live="gender" class="input">
                                        <option value="Male">{{ $lang['2'] }}</option>
                                        <option value="Female">{{ $lang['3'] }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-span-12 md:col-span-6">
                                <div class="flex items-center justify-center h-full pt-6">
                                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 w-full">
                                        <div class="lg:w-1/2 w-full px-2 py-1">
                                            <button type="button" @click="$wire.setUnitType('lbs')" :class="unit_type === 'lbs' ? 'tagsUnit' : 'bg-white'" class="w-full px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white">
                                                {{ $lang['4'] }}
                                            </button>
                                        </div>
                                        <div class="lg:w-1/2 w-full px-2 py-1">
                                            <button type="button" @click="$wire.setUnitType('kg')" :class="unit_type === 'kg' ? 'tagsUnit' : 'bg-white'" class="w-full px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white">
                                                {{ $lang['5'] }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Age & Height -->
                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{{ $lang['34'] }}:</label>
                        <div class="py-2">
                            <input type="number" step="any" wire:model.live="age" class="input" placeholder="00">
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{{ $lang['6'] }}:</label>
                        <div class="py-2">
                            <!-- Imperial Height (Dropdown) -->
                            <div x-show="unit_type === 'lbs'" style="{{ $unit_type === 'lbs' ? '' : 'display: none;' }}">
                                <select wire:model.live="ft_in" class="input">
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

                    <!-- Row 3: Weight & Activity -->
                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{{ $lang['7'] }}:</label>
                        <div class="relative w-full py-2">
                            <input type="number" step="any" wire:model.live="weight" class="input pr-12" placeholder="00">
                            <span class="input_unit" x-text="unit_type"></span>
                        </div>
                    </div>

                    <div class="col-span-12 md:col-span-6">
                        <label class="label">{{ $lang['8'] }}:</label>
                        <div class="py-2">
                            <select wire:model.live="activity" class="input">
                                <option value="Sedentary">{{ $lang['9'] }}</option>
                                <option value="Lightly Active">{{ $lang['10'] }}</option>
                                <option value="Moderately Active">{{ $lang['11'] }}</option>
                                <option value="Very Active">{{ $lang['12'] }}</option>
                                <option value="Extremely Active">{{ $lang['13'] }}</option>
                            </select>
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
            lang: @js($lang),
            macroData: { cb: 0, po: 0, fat: 0 },
            init() {
                this.updateMacros();
            },
            updateMacros() {
                const cal = this.detail.Calories;
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
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full p-3 mt-3">
                        <div class="w-full">
                            <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 border-2">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899;">
                                        <div class="mb-3 mb-md-0">
                                            <p><strong class="text-[20px]">{{ $lang['33'] }}</strong></p>
                                            <p>{{ $lang[14] }}.</p>
                                        </div>
                                        <div class="border-s-dark ps-2">
                                            <div><strong class="text-green-700 text-[25px]">{{ $detail['Calories'] }}</strong></div>
                                            <div>Kcal/{{ $lang['15'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899; min-height: 80px;">
                                        <div class="mb-3 mb-md-0">
                                            <p><strong class="text-[18px]">BMR</strong></p>
                                            <p class="text-sm">{{ $lang[16] }}.</p>
                                        </div>
                                        <div class="border-s-dark ps-2 text-right">
                                            <div><strong class="text-green-700 text-[20px]">{{ $detail['BMR'] }}</strong></div>
                                            <div class="text-xs">Kcal/{{ $lang['15'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899; min-height: 80px;">
                                        <div class="mb-3 mb-md-0">
                                            <p><strong class="text-[18px]">RMR</strong></p>
                                            <p class="text-sm">{{ $lang[17] }}.</p>
                                        </div>
                                        <div class="border-s-dark ps-2 text-right">
                                            <div><strong class="text-green-700 text-[20px]">{{ $detail['rmr'] }}</strong></div>
                                            <div class="text-xs">Kcal/{{ $lang['15'] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899; min-height: 80px;">
                                        <div class="mb-3 mb-md-0">
                                            <p><strong class="text-[18px]">BMI</strong></p>
                                            <p class="text-sm">{{ $lang[18] }}.</p>
                                        </div>
                                        <div class="border-s-dark ps-2 text-right">
                                            <div><strong class="text-green-700 text-[20px]">{{ $detail['BMI'] }}</strong></div>
                                            <div class="text-xs">Kg/m<sup>2</sup></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-lg px-3 py-2" style="border: 1px solid #c1b8b899; min-height: 80px;">
                                        <div class="mb-3 mb-md-0">
                                            <p><strong class="text-[18px]">IBW</strong></p>
                                            <p class="text-sm">{{ $lang[19] }}.</p>
                                        </div>
                                        <div class="border-s-dark ps-2 text-right">
                                            <div><strong class="text-green-700 text-[20px]">{{ $detail['ibw'] }}</strong></div>
                                            <div class="text-xs">{{ $detail['submit'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8">
                                <p><strong class="text-[20px]">{{ $lang[20] }}</strong></p>
                                <p>{{ $lang[21] }} <strong>{{ $detail['Calories'] }}</strong> Kcal/{{ $lang[15] }}</p>
                                
                                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 my-3">
                                    <div class="col-span-12 md:col-span-6">
                                        <label class="label"><strong>{{ $lang[22] }}:</strong></label>
                                        <div class="py-2">
                                            <select x-model="macroType" @change="updateMacros()" class="input">
                                                <option value="1">{{ $lang[23] }} - 50C/30P/20F</option>
                                                <option value="2">{{ $lang[24] }} - 40C/40P/20F</option>
                                                <option value="3">{{ $lang[25] }} - 40C/30P/30F</option>
                                                <option value="4">{{ $lang[26] }} - 20C/45P/35F</option>
                                                <option value="5">{{ $lang[27] }} - 5C/25P/70F</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-12 gap-2 md:gap-4 border-2 rounded-xl p-4 lg:gap-4 my-4 bg-[#F6FAFC]" style="border: 1px solid #c1b8b899;">
                                    <div class="col-span-12 md:col-span-5 lg:col-span-5">
                                        <div class="px-3 border-b-2 py-3">
                                            <div class="mb-2"><strong>{{ $lang[29] }}</strong></div>
                                            <div>
                                                <strong class="text-[25px]" x-text="macroData.cb"></strong>
                                                <span>{{ $lang[28] }}</span>
                                            </div>
                                        </div>
                                        <div class="px-3 border-b-2 py-3">
                                            <div class="mb-2"><strong>{{ $lang[30] }}</strong></div>
                                            <div>
                                                <strong class="text-[25px]" x-text="macroData.po"></strong>
                                                <span>{{ $lang[28] }}</span>
                                            </div>
                                        </div>
                                        <div class="px-3 pt-3">
                                            <div class="mb-2"><strong>{{ $lang[31] }}</strong></div>
                                            <div>
                                                <strong class="text-[25px]" x-text="macroData.fat"></strong>
                                                <span>{{ $lang[28] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-1 border-r-2 hidden md:block lg:block">&nbsp;</div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6" wire:ignore>
                                        <p class="ps-3"><strong class="text-[20px]">MACRO</strong></p>
                                        <div x-ref="canvas2" class="w-full h-[250px]"></div>
                                    </div>
                                </div>
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
