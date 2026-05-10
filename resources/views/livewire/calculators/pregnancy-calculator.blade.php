<div>
    <style>
        .calender_val {
            position: absolute;
            top: 17px;
            left: 11.5px
        }

        .inner_line {
            position: absolute;
            bottom: 3px;
            height: 4px;
            background: #fff;
        }

        .r_line,
        .r_line2,
        .r_line3 {
            position: absolute;
            bottom: 3px;
            height: 4px;
            background: #1670a7;
            width: 0px;
            height: 7px;
            border-radius: 10px
        }

        .r_line {
            width: 10px;
        }

        .p_line {
            width: 100%;
            height: 50px;
            position: relative;
            margin-top: -20px;
            z-index: 0;
        }

        .res_img,
        .res_img1,
        .res_img2 {
            position: relative;
            left: 0px;
            top: 12px;
            width: 23%;
            height: 100%;
        }

        .p_res_img,
        .p_res_img1,
        .p_res_img2 {
            position: absolute;
            z-index: 3333;
            left: -12px;
        }

        .p_res_img1,
        .p_res_img2 {
            display: none;
        }

        .trim_height {
            height: 215px;
        }

        .week_height {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 71.59px;
            line-height: 50px;
        }

        .orange_color {
            color: #000000;
        }

        .green_color {
            color: #ffffff;
        }

        .orange {
            background: #f7d7a8
        }

        .light-orange {
            background: #f7d7a8
        }

        .lime {
            background: #041dcfc7
        }

        .light-lime {
            background: #041dcfc7
        }

        .light-blue {
            background: #12a575cf
        }

        .lighter-blue {
            background: #12a575cf
        }

        .bg_blue_g {
            background-image: linear-gradient(to left, #012432, #02598c)
        }

        .grey {
            background: #eee
        }

        .color_gray {
            color: #666666
        }

        .bg-dark-blue {
            background: #094365;
        }

        .text-white {
            color: white !important;

        }

        .container1 {
            overflow: auto !important;
        }

        /* Style scrollbar thumb */
        #set_custom_scroll::-webkit-scrollbar-thumb {
            background-color: #119154;
            /* Thumb color */
            border-radius: 10px;
            /* Rounded thumb */
        }

        /* Style scrollbar size */
        #set_custom_scroll::-webkit-scrollbar {
            height: 12px;
            /* Scrollbar height */
        }
    </style>

    <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if ($error)
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[100%] md:w-[100%] w-full mx-auto">
            <div class="w-full md:w-[75%] mx-auto mt-3">
                <div class="flex flex-wrap -mx-2">
                    <!-- Calculation Method -->
                    <div class="w-full px-2 mb-4">
                        <label for="method" class="text-base  font-semibold">{!! $lang['cal_method'] ?? 'Calculation Method' !!}:</label>
                        <div class="w-full py-2 relative">
                            <select wire:model.live="method" id="method" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                <option value="Last">{{ $lang['m1'] ?? 'Last Period' }}</option>
                                <option value="Due">{{ $lang['due_date_label'] ?? 'Due Date' }}</option>
                                <option value="Conception">{{ $lang['m2'] ?? 'Conception Date' }}</option>
                                <option value="IVF">{{ $lang['m3'] ?? 'IVF' }}</option>
                                <option value="Ultrasound">{{ $lang['m4'] ?? 'Ultrasound' }}</option>
                            </select>
                        </div>
                    </div>

                    <!-- Date Input -->
                    <div class="w-full lg:w-1/2 px-2 mb-4">
                        <label for="date" class="text-base  font-semibold">
                            @if($method == 'Last') {{ $lang['start_date'] ?? 'First Day of Last Period' }}
                            @elseif($method == 'Due') Due Date
                            @elseif($method == 'Conception') {{ $lang['con'] ?? 'Conception Date' }}
                            @elseif($method == 'IVF') {{ $lang['ivf'] ?? 'Transfer Date' }}
                            @elseif($method == 'Ultrasound') {{ $lang['ultra'] ?? 'Date of Ultrasound' }}
                            @endif:
                        </label>
                        <div class="w-full py-2 relative">
                            <input type="date" wire:model="date" id="date" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" />
                        </div>
                    </div>

                    <!-- Cycle Length (for Last Period) -->
                    @if($method == 'Last')
                        <div class="w-full lg:w-1/2 px-2 mb-4">
                            <label for="cycle" class="text-base  font-semibold">{!! $lang['cycle_len'] ?? 'Cycle Length' !!}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" wire:model="cycle" id="cycle" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" min="22" max="44" />
                            </div>
                        </div>
                    @endif

                    <!-- IVF Type (for IVF) -->
                    @if($method == 'IVF')
                        <div class="w-full lg:w-1/2 px-2 mb-4">
                            <label for="ivf" class="text-base  font-semibold">{!! $lang['e_age'] ?? 'Embryo Age' !!}:</label>
                            <div class="w-full py-2 relative">
                                <select wire:model="ivf" id="ivf" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                    <option value="Last">3-day embryo</option>
                                    <option value="Conception">5-day embryo</option>
                                    <option value="Due">7-day embryo</option>
                                </select>
                            </div>
                        </div>
                    @endif

                    <!-- Weeks/Days (for Ultrasound) -->
                    @if($method == 'Ultrasound')
                        <div class="w-full lg:w-1/2 px-2 mb-4">
                            <label for="week" class="text-base  font-semibold">{!! $lang['week'] ?? 'Weeks' !!}:</label>
                            <div class="w-full py-2">
                                <input type="number" wire:model="week" id="week" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" min="1" max="24" />
                            </div>
                        </div>
                        <div class="w-full lg:w-1/2 px-2 mb-4">
                            <label for="days" class="text-base  font-semibold">{!! $lang['days'] ?? 'Days' !!}:</label>
                            <div class="w-full py-2">
                                <input type="number" wire:model="days" id="days" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" min="0" max="6" />
                            </div>
                        </div>
                    @endif
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

    @isset($detail)
    <hr>
        <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result mt-10 scroll-mt-20">
            <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                <div class="w-full p-6">
                    <div class="flex flex-col lg:flex-row gap-6">
                        <!-- Left Column: Result Cards -->
                        <div class="w-full lg:w-1/2 space-y-6">
                            <!-- Due Date Card -->
                            <div class="bg-gradient-to-br from-[#F6FAFC] to-white border border-blue-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                                    <div class="text-center md:text-left">
                                        <p class="text-lg font-bold  mb-1">{{ $lang['your_due'] ?? 'Your Due Date' }}</p>
                                        <p class="text-2xl font-black text-blue-900">{{ date('M d, Y', strtotime($detail['EstimatedAge'])) }}</p>
                                    </div>
                                    <div class="flex items-center gap-4 bg-white p-3 rounded-xl shadow-inner border border-gray-50">
                                        <strong class="text-xl text-gray-700">{{ date('M', strtotime($detail['EstimatedAge'])) }}</strong>
                                        <div class="relative group">
                                            <img src="{{ asset('images/empty_calender.png') }}" width="70" alt="Calendar" class="transition-transform group-hover:scale-110">
                                            <strong class="text-green-600 absolute inset-0 flex items-center justify-center text-2xl font-black pt-2">{{ date('d', strtotime($detail['EstimatedAge'])) }}</strong>
                                        </div>
                                        <strong class="text-xl text-gray-700">{{ date('Y', strtotime($detail['EstimatedAge'])) }}</strong>
                                    </div>
                                </div>

                                <div class="mt-6 pt-6 border-t border-blue-50">
                                    <p class="text-xl mb-2"><strong class="text-red-500">{{ $lang['cong'] ?? 'Congratulations' }}!</strong></p>
                                    <p class="text-lg text-gray-800 leading-relaxed font-medium">
                                        {!! $lang['1'] ?? 'You are currently' !!} <span class=" font-bold">{{ $detail['RemainingWeeks'] }} {{ $lang['week'] ?? 'weeks' }}</span>, <span class=" font-bold">{{ $detail['RemainingDays'] }} {{ $lang['days'] ?? 'days' }}</span> {!! $lang['2'] ?? 'pregnant' !!}.
                                    </p>
                                    @if($method == 'Due')
                                        <p class="text-sm mt-4 text-gray-600 bg-gray-50 p-2 rounded-lg inline-block">
                                            {{ $lang['con'] ?? 'Conception Date' }}: <strong class="text-black">{{ date('M d, Y', strtotime($detail['ovu_date'])) }}</strong>
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Weekly Info Card -->
                            <div class="bg-white border border-blue-100 rounded-2xl p-6 shadow-sm">
                                <p class="text-xl font-black text-blue-800 mb-4 flex items-center gap-2">
                                    <span class="w-2 h-8 bg-blue-500 rounded-full"></span>
                                    {{ $lang['5'] ?? 'How your baby is growing' }} 
                                    <span class="text-blue-600">({{ $lang['week'] ?? 'Week' }} {{ $detail['RemainingWeeks'] }})</span>
                                </p>

                                <div class="prose prose-blue max-w-none text-gray-700 leading-relaxed">
                                    @if ($detail['RemainingWeeks'] <= 2)
                                        @php $week = explode('@', $lang['w1&2'] ?? 'Growing Fast@Your baby is just starting its journey.') @endphp
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $week[0] }}</h3>
                                        <p>{{ $week[1] }}</p>
                                    @elseif ($detail['RemainingWeeks'] == 3)
                                        @php $week = explode('@', $lang['w3'] ?? 'Cell Division@The amazing process of life continues.') @endphp
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $week[0] }}</h3>
                                        <p>{{ $week[1] }}</p>
                                    @elseif ($detail['RemainingWeeks'] >= 40)
                                        @php $week = explode('@', $lang['w40'] ?? 'Ready for Birth@Your baby is fully developed.') @endphp
                                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $week[0] }}</h3>
                                        <p>{{ $week[1] }}</p>
                                    @else
                                        <p class="italic text-gray-500">Weekly development information is being updated...</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Timeline & Trimesters -->
                        <div class="w-full lg:w-1/2 space-y-4">
                            <h2 class="text-2xl font-black text-gray-800 mb-6 border-b-4 border-blue-500 pb-2 inline-block">Pregnancy Timeline</h2>
                            
                            @php
                                $trimesters = [
                                    ['name' => $lang['1st'] ?? '1st Trimester', 'range' => date('M d', strtotime($detail['ovu_date'].' - 2 weeks')).' to '.date('M d', strtotime($detail['ovu_date'].' + 11 weeks - 1 day'))],
                                    ['name' => $lang['2nd'] ?? '2nd Trimester', 'range' => date('M d', strtotime($detail['ovu_date'].' + 11 weeks')).' to '.date('M d', strtotime($detail['ovu_date'].' + 25 weeks - 1 day'))],
                                    ['name' => $lang['3rd'] ?? '3rd Trimester', 'range' => date('M d', strtotime($detail['ovu_date'].' + 25 weeks')).' to '.date('M d', strtotime($detail['ovu_date'].' + 38 weeks'))]
                                ];
                            @endphp

                            @foreach($trimesters as $index => $trim)
                                <div class="group flex items-center bg-[#F6FAFC] rounded-2xl border border-blue-100 p-4 hover:bg-blue-600 transition-all duration-300 transform hover:-translate-x-2">
                                    <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-black text-lg group-hover:bg-white transition-colors">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-blue-900 font-bold group-hover:text-white transition-colors">{{ $trim['name'] }}</p>
                                        <p class="text-gray-500 text-sm group-hover:text-blue-100 transition-colors">{{ $trim['range'] }}</p>
                                    </div>
                                </div>
                            @endforeach

                            <div class="mt-8 bg-blue-50 p-6 rounded-2xl border border-blue-100">
                                <p class="text-xl font-black text-blue-900 mb-2">{{ $lang['3'] ?? 'Important Note' }}</p>
                                <p class="text-gray-700 leading-relaxed">{{ $lang['4'] ?? 'This timeline is based on averages. Every pregnancy is unique.' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Milestone Table -->
                    <div class="mt-12">
                        <div class="bg-[#F6FAFC] rounded-3xl border border-blue-100 overflow-hidden shadow-inner">
                            <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-800 text-white flex justify-between items-center">
                                <h3 class="text-xl font-bold">{{ $lang['7'] ?? 'Important Milestones' }}</h3>
                                <div class="bg-blue-500 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Timeline</div>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="bg-blue-50 text-blue-900 text-left border-b border-blue-100">
                                            <th class="p-4 font-bold uppercase text-xs tracking-widest">Date</th>
                                            <th class="p-4 font-bold uppercase text-xs tracking-widest">Milestone</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-blue-50">
                                        @php
                                            $milestones = [
                                                ['date' => $detail['ovu_date'], 'text' => $lang['8'] ?? 'Ovulation Day'],
                                                ['date' => date('Y-m-d', strtotime($detail['ovu_date'].' + 9 days')), 'text' => $lang['10'] ?? 'Possible positive pregnancy test'],
                                                ['date' => date('Y-m-d', strtotime($detail['ovu_date'].' + 21 days')), 'text' => $lang['11'] ?? 'First heartbeat'],
                                                ['date' => date('Y-m-d', strtotime($detail['ovu_date'].' + 7 weeks')), 'text' => $lang['12'] ?? 'First morning sickness?'],
                                                ['date' => date('Y-m-d', strtotime($detail['ovu_date'].' + 8 weeks')), 'text' => $lang['13'] ?? 'First midwife appointment'],
                                                ['date' => date('Y-m-d', strtotime($detail['ovu_date'].' + 11 weeks')), 'text' => 'Start of 2nd Trimester', 'bold' => true],
                                                ['date' => date('Y-m-d', strtotime($detail['ovu_date'].' + 13 weeks')), 'text' => $lang['14'] ?? 'Baby can hear you'],
                                                ['date' => date('Y-m-d', strtotime($detail['ovu_date'].' + 15 weeks')), 'text' => $lang['15'] ?? 'Feeling first movements'],
                                                ['date' => date('Y-m-d', strtotime($detail['ovu_date'].' + 16 weeks')), 'text' => $lang['16'] ?? '20-week scan appointment'],
                                                ['date' => date('Y-m-d', strtotime($detail['ovu_date'].' + 22 weeks')), 'text' => $lang['17'] ?? 'Viability milestone'],
                                                ['date' => date('Y-m-d', strtotime($detail['ovu_date'].' + 25 weeks')), 'text' => 'Start of 3rd Trimester', 'bold' => true],
                                                ['date' => date('Y-m-d', strtotime($detail['ovu_date'].' + 38 weeks')), 'text' => $lang['20'] ?? 'Full term / Due Date', 'last' => true]
                                            ];
                                            $today = date('Y-m-d');
                                        @endphp

                                        @foreach($milestones as $m)
                                            <tr class="{{ $today == $m['date'] ? 'bg-blue-100' : 'hover:bg-blue-50/50' }} transition-colors">
                                                <td class="p-4 text-blue-700 font-bold whitespace-nowrap">{{ date('M d', strtotime($m['date'])) }}</td>
                                                <td class="p-4 text-gray-800 {{ $m['bold'] ?? false ? 'font-black' : '' }}">
                                                    {{ $m['text'] }}
                                                    @if($today == $m['date'])
                                                        <span class="ml-2 bg-blue-600 text-white px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-widest">Today</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Section -->
                    <div class="w-full mt-12" 
                         x-data='{ 
                            detail: @json($detail),
                            render(newDetail) {
                                if (newDetail) this.detail = newDetail;
                                
                                if (typeof Highcharts === "undefined" || typeof Highcharts.chart !== "function") {
                                    setTimeout(() => this.render(), 200);
                                    return;
                                }
                                
                                if (!this.detail || !this.detail.ovu_date) return;

                                const categories = [];
                                for (let i = 0; i <= 32; i++) {
                                    const date = new Date(this.detail.ovu_date);
                                    date.setDate(date.getDate() + 36 * 7 + i); // 36 weeks + i days
                                    const options = { month: "short", day: "numeric" };
                                    categories.push(date.toLocaleDateString("en-US", options));
                                }

                                Highcharts.chart(this.$refs.probChart, {
                                    chart: { type: "bar", borderRadius: 15, backgroundColor: "#F6FAFC" },
                                    title: { text: "{{ $lang['46'] ?? 'Daily Probability of Delivery' }}" },
                                    xAxis: { categories: categories },
                                    yAxis: { title: { text: null }, labels: { format: "{value}%" } },
                                    series: [{
                                        name: "{{ $lang['48'] ?? 'Probability' }}",
                                        data: [1.4,1.3,1.4,1.9,2.4,2.1,2.7,3.1,2.8,2.9,3.8,4.0,4.0,4.6,6.9,5.2,4.5,4.3,4.0,4.1,4.2,4.0,3.1,2.4,2.3,1.7,1.3,1.1,0.7],
                                        color: "#2845F5"
                                    }],
                                    credits: { enabled: false }
                                });

                                Highcharts.chart(this.$refs.cumProbChart, {
                                    chart: { type: "line", borderRadius: 15, backgroundColor: "#F6FAFC" },
                                    title: { text: "{{ $lang['47'] ?? 'Cumulative Probability of Delivery' }}" },
                                    xAxis: { categories: categories },
                                    yAxis: { title: { text: null }, labels: { format: "{value}%" } },
                                    series: [{
                                        name: "{{ $lang['49'] ?? 'Cumulative' }}",
                                        data: [10.8,12.1,13.5,15.4,17.9,19.9,22.6,26.6,28.4,31.4,35.2,39.3,43.3,47.9,54.4,60.0,64.5,68.8,72.8,76.8,81.0,85.1,88.2,90.7,93.0,94.7,96.0,97.1,97.8],
                                        color: "#1670a7"
                                    }],
                                    credits: { enabled: false }
                                });
                            }
                         }' 
                         x-init="render()"
                         @render-graph.window="render($event.detail)"
                         wire:ignore>
                        <div class="grid grid-cols-1 lg:grid-cols-1 gap-2">
                            <div x-ref="probChart" class="bg-white border border-gray-100 rounded-lg p-2 min-h-[400px]"></div>
                            <div x-ref="cumProbChart" class="bg-white border border-gray-100 rounded-lg p-2 min-h-[400px]"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>

    @push('calculatorJS')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    @endpush
</div>
