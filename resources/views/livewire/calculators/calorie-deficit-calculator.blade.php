<div x-data="{ 
    unit: @entangle('unit'),
    gender: @entangle('gender'),
    activity: @entangle('activity'),
    height_ft: @entangle('height_ft'),
    height_in: @entangle('height_in'),
    height_cm: @entangle('height_cm'),
    weight: @entangle('weight'),
    target: @entangle('target'),
    
    // Legacy support logic
    getDetail(calories, time, date, element) {
        document.querySelectorAll('.click_me').forEach(el => el.classList.remove('active_tr'));
        if (element) element.classList.add('active_tr');
        
        const loading = document.querySelector('.loading');
        const content = document.querySelector('.load_content');
        const loadingData = document.querySelector('.loading_data');
        const hideTable = document.querySelector('.hide_table');

        hideTable.style.display = 'none';
        loadingData.style.display = 'block';
        loading.style.display = 'flex';
        loading.style.opacity = '1';
        content.style.opacity = '0';

        document.querySelectorAll('.cal_update').forEach(el => el.textContent = calories);
        document.getElementById('time_update').textContent = time;
        document.getElementById('target_date').textContent = date;

        const low_fat_pro = Math.round((calories * 0.25) / 4);
        const low_fat_fat = Math.round((calories * 0.20) / 9);
        const low_fat_carbs = Math.round((calories * 0.55) / 4);
        document.getElementById('low_fat_protein').textContent = low_fat_pro;
        document.getElementById('low_fat_fats').textContent = low_fat_fat;
        document.getElementById('low_fat_carbs').textContent = low_fat_carbs;

        const low_carb_pro = Math.round((calories * 0.25) / 4);
        const low_carb_fat = Math.round((calories * 0.30) / 9);
        const low_carb_carbs = Math.round((calories * 0.45) / 4);
        document.getElementById('low_carb_protein').textContent = low_carb_pro;
        document.getElementById('low_carb_fats').textContent = low_carb_fat;
        document.getElementById('low_carb_carbs').textContent = low_carb_carbs;

        const high_pro_pro = Math.round((calories * 0.35) / 4);
        const high_pro_fat = Math.round((calories * 0.20) / 9);
        const high_pro_carbs = Math.round((calories * 0.45) / 4);
        document.getElementById('high_pro_protein').textContent = high_pro_pro;
        document.getElementById('high_pro_fats').textContent = high_pro_fat;
        document.getElementById('high_pro_carbs').textContent = high_pro_carbs;

        const balanced_pro = Math.round((calories * 0.20) / 4);
        const balanced_fat = Math.round((calories * 0.30) / 9);
        const balanced_carbs = Math.round((calories * 0.50) / 4);
        document.getElementById('balanced_protein').textContent = balanced_pro;
        document.getElementById('balanced_fats').textContent = balanced_fat;
        document.getElementById('balanced_carbs').textContent = balanced_carbs;

        setTimeout(() => {
            loading.style.display = 'none';
            content.style.opacity = '1';
        }, 1200);
    },

    hideDetail() {
        const loading = document.querySelector('.loading');
        const content = document.querySelector('.load_content');
        loading.style.display = 'flex';
        loading.style.opacity = '1';
        content.style.opacity = '0';
        setTimeout(() => {
            document.querySelector('.hide_table').style.display = 'block';
            document.querySelector('.loading_data').style.display = 'none';
        }, 800);
    },

    renderCharts() {
        if (!this.$wire.detail) return;
        
        const mildVal = this.$wire.detail.tdee - (this.unit === 'lbs' ? 250 : 275);
        const lossVal = this.$wire.detail.tdee - (this.unit === 'lbs' ? 500 : 550);
        const extremeVal = this.$wire.detail.tdee - (this.unit === 'lbs' ? 1000 : 1100);

        if (window.CanvasJS) {
            var chart = new CanvasJS.Chart('chartContainer', {
                animationEnabled: true,
                theme: 'light2',
                axisY: {
                    title: 'Weight (' + this.unit + ')',
                    interval: 200,
                    minimum: 80,
                    maximum: mildVal + 500
                },
                data: [{        
                    type: 'column',
                    dataPoints: [      
                        { y: extremeVal, label: 'Extreme Weight Loss', color: '#fec623' },
                        { y: mildVal, label: 'Mild Weight Loss', color: '#3c5bbd' },
                        { y: lossVal, label: 'Weight Loss', color: '#ff5b55' },
                    ]
                }]
            });
            chart.render();
        }

        if (window.Highcharts) {
            const categories = [];
            const data = [];
            let weightVal = this.$wire.detail.weight;
            const dailyLoss = this.$wire.detail.pounds_daily;

            for (let i = 1; i <= this.$wire.detail.days && i <= 30; i++) {
                const date = new Date();
                date.setDate(date.getDate() + i);
                categories.push(date.toLocaleDateString('en-GB', { day: 'numeric', month: 'short' }));
                data.push(parseFloat(weightVal.toFixed(2)));
                weightVal -= dailyLoss;
            }

            Highcharts.chart('container1', {
                chart: { backgroundColor: 'transparent', type: 'line' },
                title: { text: null },
                xAxis: { categories: categories, title: { text: 'Days' } },
                yAxis: { title: { text: 'Weight' }, labels: { format: '{value} ' + this.unit } },
                legend: { enabled: false },
                series: [{ name: 'Weight', data: data, color: '#2845F5' }],
                credits: { enabled: false }
            });
        }
    }
}" x-init="window.addEventListener('render-graph', () => { $nextTick(() => renderCharts()); })">

<style>
    @media (max-width: 520px) {
        .calculator-box{ padding-right: 0rem; padding-left: 0rem; }
        .border-end-cus{ border-bottom: 1px solid gainsboro; }
    }
    @media (min-width: 520px) {
        .border-end-cus{ border-right: 1px solid gainsboro; }
    }
    .calo{ font-size: 10px; }
	.loading { display: flex; justify-content: center; align-items: center; transition: 0.5s; position: absolute; top: 0; width: 95.5%; height: 100% }
    .text-orange{ color: #ff4500c4; }
	.loading::after { content: ""; width: 37.6px; height: 37.6px; border: 8px solid #bbdbfc; border-top-color: #2845F5; border-radius: 50%; animation: loading 1s linear infinite }
	@keyframes loading { to { transform: rotate(1turn) } }
	.load_content { transition: 0.5s; opacity: 0 }
	.active_tr{ background-image: linear-gradient(45deg, #2845F5, #57b4eb) !important; }
    .active_tr td{ color: white !important; }
	.click_me:hover{ background-image: linear-gradient(45deg, #2845F5, #57b4eb); }
    .click_me:hover td{ color: white !important; }
    .line-height{ line-height: 28px; }
    .gap-2{ gap: 15px; }
    tbody .click_me:nth-child(even) { background-color: #1670a712; }
    .radius-top{ border-radius: 10px 10px 0px 0px; }
    .tagsUnit { background-color: #2845F5 !important; color: white !important; }
</style>

  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if ($error)
            <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
        @endif
                
                <div class="w-full md:w-[70%] mx-auto">
                    <div class="mt-2 lg:w-[50%]">
                        <div class="flex flex-wrap items-center bg-green-100 border border-green-500 text-center rounded-lg px-1">
                            <div class="lg:w-1/2 w-full px-2 py-1">
                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300" 
                                     :class="unit === 'lbs' ? 'tagsUnit' : 'hover:bg-green-50'" @click="unit = 'lbs'">
                                    {{ $lang['49'] ?? 'Imperial' }}
                                </div>
                            </div>
                            <div class="lg:w-1/2 w-full px-2 py-1">
                                <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300" 
                                     :class="unit === 'kg' ? 'tagsUnit' : 'hover:bg-green-50'" @click="unit = 'kg'">
                                    {{ $lang['48'] ?? 'Metric' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4 mt-4">
                        <div class="col-span-12">
                            <div class="px-lg-0 px-2 py-3">
                                <label class="pe-3 text-[14px] text-blue">{!! $lang['gender'] ?? 'Gender' !!}:</label>
                                <input type="radio" wire:model.live="gender" id="male" value="Male">
                                <label for="male" class="text-[14px] text-blue pe-lg-3 pe-2">{{ $lang['male'] ?? 'Male' }}</label>
                                <input type="radio" wire:model.live="gender" id="female" value="Female">
                                <label for="female" class="text-[14px] text-blue">{{ $lang['female'] ?? 'Female' }}</label>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label class="text-[14px] text-blue">{!! $lang['your_age'] ?? 'Age' !!}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" wire:model.live="age" class="input" placeholder="00" />
                            </div>
                        </div>
                        
                        <div class="col-span-6" x-show="unit === 'lbs'">
                            <label class="text-[14px] text-blue">{!! $lang['height'] ?? 'Height' !!}:</label>
                            <div class="w-full py-2">
                                <select wire:model.live="height_ft_in" class="input w-full">
                                    @for($f=4; $f<=8; $f++)
                                        @for($i=0; $i<=11; $i++)
                                            <option value="{{$f}}-{{$i}}">{{$f}}ft {{$i}}in</option>
                                        @endfor
                                    @endfor
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-span-6" x-show="unit === 'kg'">
                            <label class="text-[14px] text-blue">{!! $lang['height'] ?? 'Height (cm)' !!}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" wire:model.live="height_cm" class="input" placeholder="175" />
                            </div>
                        </div>

                        <div class="col-span-6">
                            <label class="text-[14px] text-blue">{!! $lang['weight'] ?? 'Weight' !!}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="weight" class="input" placeholder="00" />
                                <span class="text-blue input_unit absolute right-3 top-[30px]" x-text="unit"></span>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label class="text-[14px] text-blue">{!! $lang['50'] ?? 'Target' !!}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="target" class="input" placeholder="00" />
                                <span class="text-blue input_unit absolute right-3 top-[30px]" x-text="unit"></span>
                            </div>
                        </div>
                        <div class="col-span-12">
                            <label class="text-[14px] text-blue">{!! $lang['daily_activity'] ?? 'Activity' !!}:</label>
                            <div class="w-full py-2 relative">
                                <select wire:model.live="activity" class="input">
                                    <option value="1.2">{{ $lang['No_sport'] ?? 'Sedentary' }}</option>
                                    <option value="1.375">{{ $lang['Light_activity'] ?? 'Lightly Active' }}</option>
                                    <option value="1.55">{{ $lang['Moderate_activity'] ?? 'Moderately Active' }}</option>
                                    <option value="1.725">{{ $lang['High_activity'] ?? 'Very Active' }}</option>
                                    <option value="1.9">{{ $lang['Extreme_activity'] ?? 'Extremely Active' }}</option>
                                </select>
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
        @if($detail)
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:py-8 md:py-8 result_calculator rounded-lg mt-5 space-y-6 result">
            <hr>
            <div class="">
                @if ($type == 'calculator')
                     @include('inc.copy-pdf')
                 @endif
                <div class="w-full mt-5">
                    <div class="grid grid-cols-12 gap-4 text-center shadow-md rounded-lg px-2 py-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <div class="text-center line-height border-end-cus px-3">
                                <strong>{{ $lang[84] ?? 'Maintenance' }}</strong>
                                <p class="text-[14px] px-4 py-2">Calories needed per day to stay at your current weight</p>
                                <strong class="text-orange text-[25px]">{{ $detail['tdee'] }}</strong>
                                <p class="text-[12px]" style="line-height: 1;">Kcal/day</p>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <div class="text-center line-height px-3">
                                <strong>{{ $lang[86] ?? 'Calorie Deficit' }}</strong>
                                <p class="text-[14px] px-4 my-2">Recommended daily deficit to reach your goal safely</p>
                                <strong class="text-orange text-[25px]">{{ $detail['calorie_def_cal'] }}</strong>
                                <p class="text-[12px]" style="line-height: 1;">Kcal/day</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        <div class="shadow-md p-4 rounded-lg flex justify-between items-center bg-white">
                            <div><span class="text-xs font-bold">Mild Loss</span><p class="text-[10px] text-gray-400">{{ $unit === 'lbs' ? '0.5 lb/week' : '0.25 kg/week' }}</p></div>
                            <div class="text-blue-500 font-bold">{{ number_format($detail['tdee'] - ($unit === 'lbs' ? 250 : 275)) }} <span class="text-[10px] text-gray-600">kcal</span></div>
                        </div>
                        <div class="shadow-md p-4 rounded-lg flex justify-between items-center bg-white border-2 border-blue-50">
                            <div><span class="text-xs font-bold text-blue-600">Weight Loss</span><p class="text-[10px] text-gray-400">{{ $unit === 'lbs' ? '1 lb/week' : '0.5 kg/week' }}</p></div>
                            <div class="text-blue-600 font-bold text-lg">{{ number_format($detail['tdee'] - ($unit === 'lbs' ? 500 : 550)) }} <span class="text-[10px] text-gray-600">kcal</span></div>
                        </div>
                        <div class="shadow-md p-4 rounded-lg flex justify-between items-center bg-white">
                            <div><span class="text-xs font-bold">Extreme Loss</span><p class="text-[10px] text-gray-400">{{ $unit === 'lbs' ? '2 lb/week' : '1 kg/week' }}</p></div>
                            <div class="text-blue-500 font-bold">{{ number_format($detail['tdee'] - ($unit === 'lbs' ? 1000 : 1100)) }} <span class="text-[10px] text-gray-600">kcal</span></div>
                        </div>
                    </div>

                    <div class="w-full hide_table px-3 mt-8">
                        <p class="text-[18px] px-3 mb-3 text-center uppercase tracking-widest font-bold text-blue-600"><strong>{{ $lang[56] ?? 'Weight Loss Projection' }}</strong></p>
                        <div class="w-full overflow-auto border rounded-lg custom-scroll shadow-inner bg-white" style="max-height:350px">
                            <table class="w-full px-3 text-center">
                                <thead class="sticky top-0 bg-blue-50">
                                    <tr>
                                        <th class="text-[12px] p-3 text-blue-800">{{ $lang[57] ?? 'Calories' }}</th>
                                        <th class="text-[12px] p-3 text-blue-800">{{ $lang[58] ?? 'Deficit' }}</th>
                                        <th class="text-[12px] p-3 text-blue-800">{{ $lang[59] ?? 'Duration' }}</th>
                                        <th class="text-[12px] p-3 text-blue-800">{{ $lang[60] ?? 'Target Date' }}</th>
                                        <th class="text-[12px] p-3 text-blue-800">Plan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach ($detail['intake_cal_array'] as $key => $val)
                                        @php list($in_cal, $yrs, $date, $less_cal) = explode("@@", $val); @endphp
                                        <tr class="click_me hover:bg-blue-50/50 transition-colors" @click="getDetail({{ $in_cal }}, '{{ $yrs }}', '{{ $date }}', $el)">
                                            <td class="text-[14px] p-3 font-bold">{{ $in_cal }}</td>
                                            <td class="text-[14px] p-3 text-red-500">-{{ $less_cal }}</td>
                                            <td class="text-[14px] p-3 text-gray-500">{{ $yrs }}</td>
                                            <td class="text-[14px] p-3 text-gray-400">{{ $date }}</td>
                                            <td class="p-3"><img src="{{ asset('images/blue-arrow.png') }}" class="mx-auto" width="13px"></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
        
                    <div class="w-full loading_data hidden mt-8">
                        <div class="w-full bg-blue-50/30 overflow-auto px-4 py-8 rounded-[40px] relative border border-blue-100">
                            <div class="loading"><div align="center" style="position: absolute; margin-top: 63px; text-align: center; font-size: 14px; font-weight: bold; color: #2845F5;">Generating...</div></div>
                            <div class="load_content">
                                <p class="text-center mb-6"><strong class="text-blue-600 text-lg">Daily intake: <span class="cal_update"></span> kcal for <span id="time_update"></span></strong></p>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-[14px]">
                                    <div class="bg-white p-4 rounded-2xl shadow-sm">
                                        <table class="w-full">
                                            <tr><td class="border-b py-2 font-bold">Weight</td><td class="border-b py-2 text-right">{{ $detail['weight'] }} {{ $unit }}</td></tr>
                                            <tr><td class="border-b py-2 font-bold">TDEE</td><td class="border-b py-2 text-right">{{ $detail['tdee'] }} kcal</td></tr>
                                            <tr><td class="border-b py-2 font-bold">BMR</td><td class="border-b py-2 text-right">{{ $detail['BMR'] }} kcal</td></tr>
                                            <tr><td class="py-2 font-bold">BMI</td><td class="py-2 text-right">{{ $detail['BMI'] }}</td></tr>
                                        </table>
                                    </div>
                                    <div class="bg-white p-4 rounded-2xl shadow-sm border-2 border-blue-100">
                                        <p class="text-center font-bold text-blue-600 mb-2" id="target_date">Target Date</p>
                                        <table class="w-full">
                                            <tr><td class="border-b py-2 font-bold">Target</td><td class="border-b py-2 text-right">{{ $detail['target'] }} {{ $unit }}</td></tr>
                                            <tr><td class="border-b py-2 font-bold">Target TDEE</td><td class="border-b py-2 text-right">{{ $detail['tdee_target'] }} kcal</td></tr>
                                            <tr><td class="border-b py-2 font-bold">Target BMR</td><td class="border-b py-2 text-right">{{ $detail['BMR_target'] }} kcal</td></tr>
                                            <tr><td class="py-2 font-bold">Target BMI</td><td class="py-2 text-right">{{ $detail['BMI_target'] }}</td></tr>
                                        </table>
                                    </div>
                                    <div class="bg-white p-4 rounded-2xl shadow-sm">
                                        <p class="text-center font-bold text-gray-400 mb-2 uppercase text-xs">Ideal Info</p>
                                        <table class="w-full">
                                            <tr><td class="border-b py-2 font-bold">Ideal Weight</td><td class="border-b py-2 text-right">{{ $detail['ibw'] }} {{ $unit }}</td></tr>
                                            <tr><td class="border-b py-2 font-bold">Healthy BMI</td><td class="border-b py-2 text-right">18.5 - 24.9</td></tr>
                                            <tr><td class="border-b py-2 font-bold">Activity (PAL)</td><td class="border-b py-2 text-right">{{ $activity }}</td></tr>
                                            <tr><td class="py-2 font-bold">Age</td><td class="py-2 text-right">{{ $age }} yrs</td></tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="mt-8">
                                    <p class="text-center font-bold text-gray-500 mb-4 uppercase tracking-widest text-xs">Macronutrient Distribution</p>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                        @foreach(['Balanced' => 'balanced', 'Low Fat' => 'low_fat', 'Low Carb' => 'low_carb', 'High Pro' => 'high_pro'] as $label => $id)
                                            <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                                                <p class="text-blue-600 font-bold text-center mb-3 text-xs uppercase">{{ $label }}</p>
                                                <div class="space-y-1 text-xs">
                                                    <div class="flex justify-between"><span>Protein:</span><span class="font-bold" id="{{$id}}_protein"></span>g</div>
                                                    <div class="flex justify-between"><span>Fats:</span><span class="font-bold" id="{{$id}}_fats"></span>g</div>
                                                    <div class="flex justify-between"><span>Carbs:</span><span class="font-bold" id="{{$id}}_carbs"></span>g</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="w-full text-center mt-8"><button type="button" class="bg-[#2845F5] text-white rounded-full px-8 py-3 font-bold shadow-lg hover:shadow-xl transition-all" @click="hideDetail()">CLOSE PLAN</button></div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full mt-12 px-3">
                        <p class="text-[18px] px-3 mb-6 text-center font-bold text-gray-800 uppercase tracking-widest"><strong>Weight Loss Projection</strong></p>
                        <div class="bg-white p-6 rounded-lg border border-gray-100">
                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                        </div>
                    </div> 

                    <div class="w-full mt-12 px-3">
                        <div class="bg-white border border-gray-100 rounded-lg overflow-hidden">
                            <p class="text-[18px] text-center bg-[#2845F5] py-4 text-white font-bold uppercase tracking-widest">Metabolic Profile</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 p-6 divide-y md:divide-y-0 md:divide-x divide-gray-100">
                                <div class="px-4 py-4 md:py-0"><table class="w-full">
                                    <tr class="border-b"><td class="py-3 text-gray-500">TDEE</td><td class="text-right font-bold">{{ $detail['tdee'] }} <small>kcal</small></td></tr>
                                    <tr class="border-b"><td class="py-3 text-gray-500">BMR</td><td class="text-right font-bold">{{ $detail['BMR'] }} <small>kcal</small></td></tr>
                                    <tr><td class="py-3 text-gray-500">RMR</td><td class="text-right font-bold">{{ $detail['RMR'] }} <small>kcal</small></td></tr>
                                </table></div>
                                <div class="px-4 py-4 md:py-0"><table class="w-full">
                                    <tr class="border-b"><td class="py-3 text-gray-500">BMI</td><td class="text-right font-bold">{{ $detail['BMI'] }}</td></tr>
                                    <tr class="border-b"><td class="py-3 text-gray-500">Activity (PAL)</td><td class="text-right font-bold">{{ $activity }}</td></tr>
                                    <tr><td class="py-3 text-gray-500">Ideal Weight</td><td class="text-right font-bold text-blue-600">{{ $detail['ibw'] }} <small>{{ $unit }}</small></td></tr>
                                </table></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

@push('calculatorJS')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
@endpush
</form>
</div>
