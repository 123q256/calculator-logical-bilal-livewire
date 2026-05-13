<div>
    <style>
        .first:before {
            content: '';
            display: inline-block;
            height: 14px;
            width: 14px;
            border-radius: 3px;
            margin-right: 12px;
            background-color: currentColor;
            -ms-flex-negative: 0;
            flex-shrink: 0;
        }
        .tagsUnit {
            background-color: #2845F5 !important;
            color: white !important;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    <!-- Age -->
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="age" class="label">{!! $lang['age_year'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <input type="number" step="any" wire:model.live="age" id="age" class="input" placeholder="00" />
                        </div>
                    </div>

                    <!-- Gender -->
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="gender" class="label">{!! $lang['gender'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="gender" id="gender" class="input">
                                <option value="Male">{{ $lang['male'] }}</option>
                                <option value="Female">{{ $lang['female'] }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Height -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label class="label">{!! $lang['height'] !!} <span class="text-blue">({{ $unit_ft_in }})</span>:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            @if($unit_ft_in === 'ft/in')
                                <div class="grid grid-cols-2 gap-2">
                                    <input type="number" step="any" wire:model.live="height_ft" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="ft" />
                                    <input type="number" step="any" wire:model.live="height_in" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="in" />
                                </div>
                            @else
                                <input type="number" wire:model.live="height_cm" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="cm" />
                            @endif

                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit_ft_in }} ▾</label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit_ft_in', 'ft/in');" @click="open = false">feet / inches (ft/in)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit_ft_in', 'cm');" @click="open = false">centimeters (cm)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Weight -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="weight" class="label">{{ $lang['weight'] }}:</label>
                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                            <input type="number" wire:model.live="weight" id="weight" step="any" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full" placeholder="00" />
                            <label @click="open = !open" class="absolute cursor-pointer text-sm underline right-6 top-4">{{ $unit }} ▾</label>
                            <div x-show="open" @click.away="open = false" x-cloak class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0">
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit', 'lbs');" @click="open = false">pounds (lbs)</p>
                                <p class="p-2 hover:bg-gray-100 cursor-pointer" wire:click="$set('unit', 'kg');" @click="open = false">kilograms (kg)</p>
                            </div>
                        </div>
                    </div>

                    <!-- Meals -->
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="meal" class="label">{!! $lang['meal'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="meal" id="meal" class="input">
                                <option value="all">{{ $lang['all'] }}</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>

                    <!-- Goal -->
                    <div class="col-span-6 md:col-span-6 lg:col-span-6">
                        <label for="goal" class="label">{!! $lang['Your_goal'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="goal" id="goal" class="input">
                                <option value="Maintain">{{ $lang['main'] }}</option>
                                <option value="Fat Loss">{{ $lang['loss_20'] }}</option>
                                <option value="Loss 10%">{{ $lang['loss_10'] }}</option>
                                <option value="Muscle Gain">{{ $lang['gain'] }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Activity -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="activity" class="label">{!! $lang['activity'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="activity" id="activity" class="input">
                                <option value="Sedentary">{{ $lang['a1'] }}</option>
                                <option value="Lightly Active">{{ $lang['a2'] }}</option>
                                <option value="Moderately Active">{{ $lang['a3'] }}</option>
                                <option value="Very Active">{{ $lang['a4'] }}</option>
                                <option value="Extremely Active">{{ $lang['a5'] }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Formula -->
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="formula" class="label">{!! $lang['formula'] !!}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="formula" id="formula" class="input">
                                <option value="2nd">{{ $lang['9'] }}</option>
                                <option value="first">{{ $lang['10'] }}</option>
                                <option value="3rd">{{ $lang['11'] }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Body Fat Percent (if 3rd formula) -->
                    @if($formula === '3rd')
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="percent" class="label">
                                {{ $lang['b_f'] }}
                                <a title="Body Fat Percentage Calculator" href="{{ url('body-fat-percentage-calculator') }}/" class="text-blue font-s-12" target="_blank" rel="noopener"> {{ $lang['click'] }}</a>:
                            </label>
                            <div class="w-100 py-2 relative">
                                <input type="number" step="any" wire:model.live="percent" id="percent" class="input" placeholder="0%" />
                                <span class="text-blue input_unit">%</span>
                            </div>
                        </div>
                    @endif
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result" 
                 x-data="{ 
                    mode: 'balanced', 
                    calories: {{ $detail['calories'] }},
                    protein_p: 20,
                    fat_p: 30,
                    carb_p: 50,
                    protein_g: 0,
                    fat_g: 0,
                    carb_g: 0,
                    init() {
                        this.updateMacros();
                        this.drawChart();
                    },
                    updateMacros() {
                        if (this.mode === 'balanced') { this.protein_p = 20; this.fat_p = 30; this.carb_p = 50; }
                        if (this.mode === 'low_fat') { this.protein_p = 25; this.fat_p = 20; this.carb_p = 55; }
                        if (this.mode === 'low_carb') { this.protein_p = 25; this.fat_p = 30; this.carb_p = 45; }
                        if (this.mode === 'high_pro') { this.protein_p = 35; this.fat_p = 20; this.carb_p = 45; }
                        
                        this.protein_g = Math.round((this.calories * (this.protein_p / 100)) / 4);
                        this.fat_g = Math.round((this.calories * (this.fat_p / 100)) / 9);
                        this.carb_g = Math.round((this.calories * (this.carb_p / 100)) / 4);
                        this.drawChart();
                    },
                    updateOwn(type, val) {
                        if(type === 'pro') {
                            this.protein_p = parseInt(val);
                            let remain = 100 - this.protein_p;
                            this.fat_p = Math.min(35, Math.max(20, Math.round(remain / 3)));
                            this.carb_p = 100 - this.protein_p - this.fat_p;
                        }
                        if(type === 'fat') {
                            this.fat_p = parseInt(val);
                            let remain = 100 - this.fat_p;
                            this.protein_p = Math.min(35, Math.max(10, Math.round(remain / 3)));
                            this.carb_p = 100 - this.protein_p - this.fat_p;
                        }
                        if(type === 'carb') {
                            this.carb_p = parseInt(val);
                            let remain = 100 - this.carb_p;
                            this.fat_p = Math.min(35, Math.max(20, Math.round(remain / 3)));
                            this.protein_p = 100 - this.carb_p - this.fat_p;
                        }
                        this.updateMacros();
                    },
                    drawChart() {
                        if (typeof google !== 'undefined' && google.visualization) {
                            var data = google.visualization.arrayToDataTable([
                                ['Macro', 'Percentage'],
                                ['Protein', this.protein_p],
                                ['Fat', this.fat_p],
                                ['Carbs', this.carb_p]
                            ]);
                            var options = {
                                backgroundColor: 'transparent',
                                legend: 'none',
                                slices: { 0: { color: '#166FA5' }, 1: { color: '#299FCE' }, 2: { color: '#64D3FF' } }
                            };
                            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                            chart.draw(data, options);
                        }
                    }
                 }" x-init="init()">
                
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full bg-light-blue p-3 rounded-lg mt-3">
                            <div class="w-full">
                                <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
                                    <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1 tabs">
                                        @foreach(['balanced' => $lang['bal'], 'low_fat' => $lang['low_fat'], 'low_carb' => $lang['low_carb'], 'high_pro' => $lang['high_pro'], 'own' => $lang['own']] as $m => $label)
                                            <div class="lg:w-1/5 w-full px-2 py-1">
                                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300"
                                                     :class="mode === '{{ $m }}' ? 'tagsUnit' : ''"
                                                     @click="mode = '{{ $m }}'; updateMacros()">
                                                    {{ $label }}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="w-full mt-3" x-show="mode === 'own'" x-cloak>
                                    <div class="grid grid-cols-12 gap-2">
                                        <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                            <fieldset class="rounded-[10px] p-2 border border-blue-200">
                                                <legend class="text-blue-700 px-1 text-sm">{{ $lang['PROTEIN'] }} (<span x-text="protein_p"></span>%)</legend>
                                                <input type="range" min="10" max="35" x-model="protein_p" @input="updateOwn('pro', $event.target.value)" class="w-full">
                                            </fieldset>
                                        </div>
                                        <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                            <fieldset class="rounded-[10px] p-2 border border-blue-200">
                                                <legend class="text-blue-700 px-1 text-sm">{{ $lang['FAT'] }} (<span x-text="fat_p"></span>%)</legend>
                                                <input type="range" min="20" max="35" x-model="fat_p" @input="updateOwn('fat', $event.target.value)" class="w-full">
                                            </fieldset>
                                        </div>
                                        <div class="col-span-12 md:col-span-4 lg:col-span-4">
                                            <fieldset class="rounded-[10px] p-2 border border-blue-200">
                                                <legend class="text-blue-700 px-1 text-sm">{{ $lang['CARBS'] }} (<span x-text="carb_p"></span>%)</legend>
                                                <input type="range" min="45" max="65" x-model="carb_p" @input="updateOwn('carb', $event.target.value)" class="w-full">
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full">
                                    <p class="w-full mt-3 mb-1 text-sm text-gray-600">{{ $lang['before_res'] }}</p>
                                    <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 items-center">
                                        <div class="col-span-12 md:col-span-8 lg:col-span-8">
                                            <div class="flex flex-wrap items-center justify-between relative bg-[#F6FAFC] border rounded-xl px-4 py-4 mt-3" style="border: 1px solid #c1b8b899;">
                                                <div class="flex items-center">
                                                    <img src="{{ url('images/calories1.png') }}" alt="Calories" width="50" height="50">
                                                    <div class="ms-3">
                                                        <div class="text-blue font-semibold uppercase text-xs">{{ $lang['CALORIES'] }}</div>
                                                        <div class="text-[32px] font-bold text-[#908310] leading-none">{{ $detail['calories'] }}</div>
                                                        <div class="text-[12px] text-gray-500">
                                                            {{ $meal === 'all' ? $lang['C_per_day'] : $lang['cpm'] }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="overflow-hidden">
                                                    <table class="w-full text-[14px]" cellspacing="0">
                                                        <tr>
                                                            <td class="first py-1 text-[#166FA5]">{{ $lang['PROTEIN'] }}</td>
                                                            <td class="ps-5 font-bold"><span x-text="protein_p"></span>%</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="first py-1 text-[#299FCE]">{{ $lang['FAT'] }}</td>
                                                            <td class="ps-5 font-bold"><span x-text="fat_p"></span>%</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="first py-1 text-[#64D3FF]">{{ $lang['CARBS'] }}</td>
                                                            <td class="ps-5 font-bold"><span x-text="carb_p"></span>%</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-span-12 md:col-span-4 lg:col-span-4 flex justify-center">
                                            <div id="piechart" style="width: 180px; height: 180px;"></div>
                                        </div>
                                    </div>

                                    <p class="mt-4 text-sm text-gray-600">{{ $lang['after_res'] }}</p>
                                    <div class="grid grid-cols-12 gap-3 md:gap-4 mt-2">
                                        <!-- Protein -->
                                        <div class="col-span-12 md:col-span-6">
                                            <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-xl p-4 border-gray-200">
                                                <div class="flex items-center">
                                                    <img src="{{ url('images/protein1.png') }}" width="45" height="45">
                                                    <div class="ms-3 font-bold text-blue-800 uppercase text-sm">{{ $lang['PROTEIN'] }}</div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="text-2xl font-bold text-blue-700"><span x-text="protein_g"></span>g</div>
                                                    <div class="text-[10px] text-gray-500">{{ $meal === 'all' ? $lang['grams_per_day'] : $lang['gpm'] }}</div>
                                                    <div class="text-[9px] text-gray-400">{{ $lang['range'] }} {{ round(($detail['calories'] * 0.10) / 4) }}-{{ round(($detail['calories'] * 0.35) / 4) }}g</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fat -->
                                        <div class="col-span-12 md:col-span-6">
                                            <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-xl p-4 border-gray-200">
                                                <div class="flex items-center">
                                                    <img src="{{ url('images/Fats.png') }}" width="45" height="45">
                                                    <div class="ms-3 font-bold text-blue-800 uppercase text-sm">{{ $lang['FAT'] }}</div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="text-2xl font-bold text-blue-700"><span x-text="fat_g"></span>g</div>
                                                    <div class="text-[10px] text-gray-500">{{ $meal === 'all' ? $lang['grams_per_day'] : $lang['gpm'] }}</div>
                                                    <div class="text-[9px] text-gray-400">{{ $lang['range'] }} {{ round(($detail['calories'] * 0.20) / 9) }}-{{ round(($detail['calories'] * 0.35) / 9) }}g</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Carbs -->
                                        <div class="col-span-12 md:col-span-6">
                                            <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-xl p-4 border-gray-200">
                                                <div class="flex items-center">
                                                    <img src="{{ url('images/Carbs1.png') }}" width="45" height="45">
                                                    <div class="ms-3 font-bold text-blue-800 uppercase text-sm">{{ $lang['CARBS'] }}</div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="text-2xl font-bold text-blue-700"><span x-text="carb_g"></span>g</div>
                                                    <div class="text-[10px] text-gray-500">{{ $meal === 'all' ? $lang['grams_per_day'] : $lang['gpm'] }}</div>
                                                    <div class="text-[9px] text-gray-400">{{ $lang['range'] }} {{ round(($detail['calories'] * 0.45) / 4) }}-{{ round(($detail['calories'] * 0.65) / 4) }}g</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Sugar -->
                                        <div class="col-span-12 md:col-span-6">
                                            <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-xl p-4 border-gray-200">
                                                <div class="flex items-center">
                                                    <img src="{{ url('images/Sugar.png') }}" width="45" height="45">
                                                    <div class="ms-3 font-bold text-blue-800 uppercase text-sm">{{ $lang['suger'] }}</div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="text-2xl font-bold text-blue-700">{{ $detail['Sugar'] }}g</div>
                                                    <div class="text-[10px] text-gray-500">{{ $meal === 'all' ? $lang['grams_per_day'] : $lang['gpm'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Saturated Fat -->
                                        <div class="col-span-12 md:col-span-12 flex justify-start mt-2">
                                            <div class="flex items-center justify-between bg-[#F6FAFC] border rounded-xl p-4 border-gray-200 w-full md:w-1/2">
                                                <div class="flex items-center">
                                                    <img src="{{ url('images/stand_fat.png') }}" width="45" height="45">
                                                    <div class="ms-3 font-bold text-blue-800 uppercase text-sm">{{ $lang['s_f'] }}</div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="text-2xl font-bold text-blue-700">{{ $detail['stand_fat'] }}g</div>
                                                    <div class="text-[10px] text-gray-500">{{ $meal === 'all' ? $lang['grams_per_day'] : $lang['gpm'] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script>
            google.charts.load('current', {'packages':['corechart']});
        </script>
    @endpush
</div>
