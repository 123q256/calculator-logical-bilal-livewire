<div>
    <style>
        .pace_tab {
            cursor: pointer;
            padding: 10px 20px;
            transition: all 0.3s ease;
            position: relative;
        }
        .pace_tab.active {
            color: #2845F5;
        }
        .pace_tab.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: #2845F5;
        }
        .pace_border {
            border-bottom: 1px solid #e5e7eb;
        }
        .calculator-btn {
            @apply bg-white px-4 py-2 rounded-md transition-all duration-300 border border-transparent shadow-sm hover:shadow-md;
        }
        .calculator-btn.active {
            @apply bg-[#2845F5] text-white shadow-blue-200;
        }
        /* User's custom font size and color classes */
        .font-s-20 { font-size: 20px; }
        .font-s-25 { font-size: 25px; }
        .text-blue { color: #2845F5; }
        .text-green { color: #10B981; }
    </style>

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if ($error)
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif

        <form wire:submit.prevent="calculate">
            <!-- Main Calculator Selector Tabs -->
            <div class="mx-auto mt-2 w-full">
                <input type="hidden" wire:model="calculator_name">
                <div class="flex flex-wrap items-center bg-blue-100 border border-blue-200 text-center rounded-lg px-1 py-1">
                    <div class="lg:w-1/4 w-full px-2 py-1">
                        <div wire:click="setTab('calculator1')" 
                             class="px-3 py-2 cursor-pointer text-[12px] rounded-md transition-colors duration-300 font-bold {{ $calculator_name == 'calculator1' ? 'bg-[#2845F5] text-white shadow-md' : 'bg-white text-gray-700 hover:bg-blue-50' }}">
                            {{ $cal_name }}
                        </div>
                    </div>
                    <div class="lg:w-1/4 w-full px-2 py-1">
                        <div wire:click="setTab('calculator2')" 
                             class="px-3 py-2 cursor-pointer text-[12px] rounded-md transition-colors duration-300 font-bold {{ $calculator_name == 'calculator2' ? 'bg-[#2845F5] text-white shadow-md' : 'bg-white text-gray-700 hover:bg-blue-50' }}">
                            {{ $lang['21'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/4 w-full px-2 py-1">
                        <div wire:click="setTab('calculator3')" 
                             class="px-3 py-2 cursor-pointer text-[12px] rounded-md transition-colors duration-300 font-bold {{ $calculator_name == 'calculator3' ? 'bg-[#2845F5] text-white shadow-md' : 'bg-white text-gray-700 hover:bg-blue-50' }}">
                            {{ $lang['20'] }}
                        </div>
                    </div>
                    <div class="lg:w-1/4 w-full px-2 py-1">
                        <div wire:click="setTab('calculator4')" 
                             class="px-3 py-2 cursor-pointer text-[12px] rounded-md transition-colors duration-300 font-bold {{ $calculator_name == 'calculator4' ? 'bg-[#2845F5] text-white shadow-md' : 'bg-white text-gray-700 hover:bg-blue-50' }}">
                            {{ $lang['16'] }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-[80%] md:w-[80%] w-full mx-auto">
                <div class="row grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    
                    <!-- Calculator 1: Main -->
                    @if($calculator_name == 'calculator1')
                        <div class="col-span-12">
                            <div class="row grid grid-cols-12 mt-3 my-5 gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="w-full flex justify-between text-[14px] pace_border relative">
                                        <p wire:click="setSubtype('pace')" class="pace_tab px-3 {{ $sub_type == 'pace' ? 'active' : '' }}"><strong>{{ $lang['1'] }}</strong></p>
                                        <p wire:click="setSubtype('time')" class="pace_tab px-3 {{ $sub_type == 'time' ? 'active' : '' }}"><strong>{{ $lang['2'] }}</strong></p>
                                        <p wire:click="setSubtype('distance')" class="pace_tab px-3 {{ $sub_type == 'distance' ? 'active' : '' }}"><strong>{{ $lang['3'] }}</strong></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                @if($sub_type != 'time')
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <label class="label">{{ $lang['2'] }} (hh:mm:ss):</label>
                                        <div class="w-full py-2 relative">
                                            <input type="text" wire:model.live="time" class="input" placeholder="00:05:13">
                                        </div>
                                    </div>
                                @endif

                                @if($sub_type != 'distance')
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6 dis">
                                        <label class="label">{{ $lang['3'] }}:</label>
                                        <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                            <input type="number" step="any" wire:model.live="dis" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                                            <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" 
                                                   @click="open = !open">
                                                {{ $dis_unit }} ▾
                                            </label>
                                            
                                            <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg top-full" x-cloak>
                                                @foreach (["mi" => "miles (mi)", "km" => "kilometers (km)", "m" => "meters (m)", "yd" => "yards (yd)"] as $val => $label)
                                                    <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="open = false; $wire.setUnit('dis_unit', '{{ $val }}')">{{ $label }}</p>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-12 md:col-span-6 lg:col-span-6 event">
                                        <label class="label">{{ $lang['4'] }}:</label>
                                        <div class="w-full py-2 relative">
                                            <select wire:model.live="event" class="input">
                                                <option value="">{{ $lang['5'] }}</option>
                                                <option value="1">Marathon</option>
                                                <option value="2">Half-Marathon</option>
                                                <option value="3">1K</option>
                                                <option value="4">5K</option>
                                                <option value="5">10K</option>
                                                <option value="6">1 Miles</option>
                                                <option value="7">5 Miles</option>
                                                <option value="8">10 Miles</option>
                                                <option value="9">800 meters</option>
                                                <option value="10">1500 meters</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif

                                @if($sub_type != 'pace')
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <label class="label flex">{{ $lang['1'] }} <span class="text-blue hh ml-1">(hh:mm:ss)</span>:</label>
                                        <div class="w-full py-2 relative">
                                            <input type="text" wire:model.live="pace" class="input" placeholder="00:07:33">
                                        </div>
                                    </div>
                                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                        <label class="label">{{ $lang['6'] }}:</label>
                                        <div class="w-full py-2 relative">
                                            <select wire:model.live="per" class="input">
                                                <option value="1">per Mile</option>
                                                <option value="2">per Kilometer</option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    <!-- Calculator 2: Splits -->
                    @elseif($calculator_name == 'calculator2')
                        <div class="col-span-12">
                            <div class="row grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                @foreach($splits as $index => $split)
                                    <div class="col-span-6">
                                        @if($index == 0) <label class="label">{{ $lang['3'] }}:</label> @endif
                                        <div class="flex items-center">
                                            <span class="label mr-2">{{ $index + 1 }}:</span>
                                            <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                                <input type="number" step="any" wire:model.live="splits.{{ $index }}.dis" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-12" placeholder="00">
                                                <label class="absolute cursor-pointer text-sm underline right-4 top-1/2 -translate-y-1/2 font-bold text-gray-500 z-10" 
                                                       @click="open = !open">
                                                    {{ $split['unit'] }} ▾
                                                </label>
                                                
                                                <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg top-full" x-cloak>
                                                    @foreach (["mi" => "miles (mi)", "km" => "kilometers (km)", "m" => "meters (m)", "yd" => "yards (yd)"] as $val => $label)
                                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="open = false; $wire.setUnit('splits.{{ $index }}.unit', '{{ $val }}')">{{ $label }}</p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-6">
                                        @if($index == 0) <label class="label">{{ $lang['2'] }} (hh:mm:ss):</label> @endif
                                        <div class="w-full {{ $index == 0 ? 'py-2' : 'mt-[7px]' }} relative">
                                            <input type="text" wire:model.live="splits.{{ $index }}.time" class="input" placeholder="00:00:00">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    <!-- Calculator 3: Converter -->
                    @elseif($calculator_name == 'calculator3')
                        <div class="col-span-12">
                            <div class="row grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label class="label flex">{{ $lang['14'] }} <span class="text-blue hhm ml-1">(hh:mm:ss)</span>:</label>
                                    <div class="w-full py-2 relative">
                                        <input type="text" wire:model.live="conv_from" class="input" placeholder="00:07:33">
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label class="label">&nbsp;</label>
                                    <div class="w-full py-2 relative">
                                        <select wire:model.live="fromu" class="input">
                                            <option value="1">min/mile</option>
                                            <option value="2">min/km</option>
                                            <option value="3">min/800m</option>
                                            <option value="4">min/400m</option>
                                            <option value="5">mph</option>
                                            <option value="6">kph</option>
                                            <option value="7">m/s</option>
                                            <option value="8">min/100m</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label class="label">{{ $lang['15'] }}</label>
                                    <div class="w-full py-2 relative">
                                        <select wire:model.live="to" class="input">
                                            <option value="1">min/mile</option>
                                            <option value="2">min/km</option>
                                            <option value="3">min/800m</option>
                                            <option value="4">min/400m</option>
                                            <option value="5">mph</option>
                                            <option value="6">kph</option>
                                            <option value="7">m/s</option>
                                            <option value="8">min/100m</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Calculator 4: Predictor -->
                    @elseif($calculator_name == 'calculator4')
                        <div class="col-span-12">
                            <div class="row grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label class="label">{{ $lang['17'] }}:</label>
                                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                        <input type="number" step="any" wire:model.live="p_fdis" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" 
                                               @click="open = !open">
                                            {{ $p_fdis_unit }} ▾
                                        </label>
                                        
                                        <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg top-full" x-cloak>
                                            @foreach (["mi" => "miles (mi)", "km" => "kilometers (km)", "m" => "meters (m)", "yd" => "yards (yd)"] as $val => $label)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="open = false; $wire.setUnit('p_fdis_unit', '{{ $val }}')">{{ $label }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label class="label">{{ $lang['18'] }} (hh:mm:ss):</label>
                                    <div class="w-full py-2 relative">
                                        <input type="text" wire:model.live="p_ftime" class="input" placeholder="00:05:13">
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <label class="label">{{ $lang['19'] }}:</label>
                                    <div class="relative w-full mt-[7px]" x-data="{ open: false }">
                                        <input type="number" step="any" wire:model.live="p_ffdis" class="border border-gray-300 p-2 rounded-lg focus:ring-2 w-full pr-16" placeholder="00">
                                        <label class="absolute cursor-pointer text-sm underline right-6 top-1/2 -translate-y-1/2 font-bold text-gray-600 z-10" 
                                               @click="open = !open">
                                            {{ $p_ffdis_unit }} ▾
                                        </label>
                                        
                                        <div x-show="open" @click.away="open = false" class="absolute z-50 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg top-full" x-cloak>
                                            @foreach (["mi" => "miles (mi)", "km" => "kilometers (km)", "m" => "meters (m)", "yd" => "yards (yd)"] as $val => $label)
                                                <p class="p-2 hover:bg-gray-100 cursor-pointer text-sm border-b last:border-0" @click="open = false; $wire.setUnit('p_ffdis_unit', '{{ $val }}')">{{ $label }}</p>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-8 flex justify-center">
                @if ($type == 'calculator')
                    @include('inc.button')
                @endif
                @if ($type == 'widget')
                    @include('inc.widget-button')
                @endif
            </div>
        </form>
    </div>

    <!-- Result Section -->
    @isset($detail)
        <hr>
        <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8">
            <div>
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
                
                <div class="rounded-lg flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            
                            <!-- Calculator 3: Converter Result -->
                            @if($calculator_name === 'calculator3')
                                @php
                                    $name = [$lang['6'], $lang['7'], $lang['8'], $lang['9'], $lang['10'], $lang['11'], $lang['12'], $lang['13']];
                                    $i = (int)$fromu - 1;
                                    $j = (int)$to - 1;
                                @endphp
                                <div class="w-full">
                                    <div class="w-full py-2">
                                        <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                            <strong><span class="text-blue font-s-20">{{ $conv_from }}</span> {{ $name[$i] ?? '' }} = <span class="text-green font-s-20">{{ $detail['res'] }}</span> {{ $name[$j] ?? '' }}</strong>
                                        </div>
                                    </div>
                                </div>

                            <!-- Calculator 4: Predictor Result -->
                            @elseif($calculator_name === 'calculator4')
                                <div class="w-full">
                                    <div class="w-full py-2">
                                        <div class="bg-[#F6FAFC] border rounded-lg p-3" style="border: 1px solid #c1b8b899;">
                                            {{ $lang['22'] }}
                                            <strong class="text-green font-s-20">{{ $detail['main'] }}</strong>
                                            {{ $lang['23'] }}
                                            {{ $p_ffdis . ' ' . $p_ffdis_unit }}.
                                        </div>
                                    </div>
                                </div>
                                <p><strong>{{ $lang['24'] }}:</strong></p>
                                <div class="w-full overflow-auto mt-2">
                                    <table class="w-full" cellspacing="0">
                                        <tr class="border-b"><td class="py-2"><strong class="text-blue">{{ $this->gettime($detail['pace']) }}</strong> <span>{{ $lang['6'] }}</span></td></tr>
                                        <tr class="border-b"><td class="py-2"><strong class="text-blue">{{ $this->gettime($detail['pacekm']) }}</strong> <span>{{ $lang['7'] }}</span></td></tr>
                                        <tr class="border-b"><td class="py-2"><strong class="text-blue">{{ $detail['mi_h'] }}</strong> <span>{{ $lang['25'] }}</span></td></tr>
                                        <tr class="border-b"><td class="py-2"><strong class="text-blue">{{ $detail['km_h'] }}</strong> <span>{{ $lang['26'] }}</span></td></tr>
                                        <tr class="border-b"><td class="py-2"><strong class="text-blue">{{ $detail['m_m'] }}</strong> <span>{{ $lang['27'] }}</span></td></tr>
                                        <tr class="border-b"><td class="py-2"><strong class="text-blue">{{ $detail['m_s'] }}</strong> <span>{{ $lang['28'] }}</span></td></tr>
                                        <tr class="border-b"><td class="py-2"><strong class="text-blue">{{ $detail['yd_m'] }}</strong> <span>{{ $lang['29'] }}</span></td></tr>
                                        <tr><td class="py-2"><strong class="text-blue">{{ $detail['yd_s'] }}</strong> <span>{{ $lang['30'] }}</span></td></tr>
                                    </table>
                                </div>

                            <!-- Calculator 2: Splits Result -->
                            @elseif($calculator_name === 'calculator2')
                                <div class="w-full overflow-auto">
                                    <table class="w-full text-sm" cellspacing="0">
                                        <tr class="bg-blue-50">
                                            <th class="text-blue border-b p-3" colspan="4">{{ $lang['31'] }}</th>
                                            <th class="text-start text-blue border-l border-b p-3" rowspan="2">{{ $lang['32'] }} <br> (hh:mm:ss {{ $lang['6'] }})</th>
                                        </tr>
                                        <tr class="bg-blue-50">
                                            <th class="text-start text-blue border-b p-3">#</th>
                                            <th class="text-start text-blue border-b p-3">{{ $lang['3'] }}</th>
                                            <th class="text-start text-blue border-b p-3">{{ $lang['2'] }}</th>
                                            <th class="text-start text-blue border-b p-3">{{ $lang['1'] }}</th>
                                        </tr>
                                        <tbody class="divide-y divide-gray-100">
                                            {!! $detail['table'] !!}
                                        </tbody>
                                    </table>
                                    <p class="mt-4"><strong>{{ $lang['33'] }} (hh:mm:ss): <span class="text-green font-s-20">{{ $this->gettime($detail['stime']) }} {{ $lang['6'] }}</span></strong></p>
                                    
                                    <!-- Split Chart -->
                                    <div class="mt-6" 
                                         x-data="{ 
                                            render() {
                                                if (typeof Highcharts === 'undefined') {
                                                    setTimeout(() => this.render(), 200);
                                                    return;
                                                }
                                                Highcharts.chart($refs.chartContainer, {
                                                    chart: { type: 'column', backgroundColor: 'transparent' },
                                                    title: { text: 'Split Pace Comparison', style: { color: '#2845F5', fontWeight: 'bold' } },
                                                    xAxis: { 
                                                        categories: [{{ implode(',', array_keys($detail['mile_secs'] ?? [])) }}],
                                                        title: { text: 'Split #' }
                                                    },
                                                    yAxis: { title: { text: 'Seconds' } },
                                                    series: [{
                                                        name: 'Pace (Seconds)',
                                                        data: [{{ implode(',', array_values($detail['mile_secs'] ?? [])) }}],
                                                        color: '#2845F5'
                                                    }],
                                                    credits: { enabled: false }
                                                });
                                            }
                                         }" 
                                         x-init="render()"
                                         wire:ignore>
                                        <div x-ref="chartContainer" class="w-full h-64 bg-white p-4 rounded-xl border border-gray-100"></div>
                                    </div>
                                </div>

                            <!-- Calculator 1: Main Result -->
                            @elseif($calculator_name === 'calculator1')
                                @if($sub_type == 'pace')
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="w-full py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-4" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ $this->gettime($detail['pace']) }}</strong>
                                                <strong class="ml-2 text-gray-700">{{ $lang['6'] }}</strong>
                                            </div>
                                        </div>
                                        <div class="w-full py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-4" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ $this->gettime($detail['pacekm']) }}</strong>
                                                <strong class="ml-2 text-gray-700">{{ $lang['7'] }}</strong>
                                            </div>
                                        </div>
                                        <div class="w-full py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-4" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ $detail['mi_h'] }}</strong>
                                                <strong class="ml-2 text-gray-700">{{ $lang['8'] }}</strong>
                                            </div>
                                        </div>
                                        <div class="w-full py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-4" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ $detail['km_h'] }}</strong>
                                                <strong class="ml-2 text-gray-700">{{ $lang['26'] }}</strong>
                                            </div>
                                        </div>
                                        <div class="w-full py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-4" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ $detail['m_m'] }}</strong>
                                                <strong class="ml-2 text-gray-700">{{ $lang['27'] }}</strong>
                                            </div>
                                        </div>
                                        <div class="w-full py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-4" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ $detail['m_s'] }}</strong>
                                                <strong class="ml-2 text-gray-700">{{ $lang['28'] }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @elseif($sub_type == 'time')
                                    <div class="w-full py-2">
                                        <div class="bg-[#F6FAFC] border rounded-lg p-5" style="border: 1px solid #c1b8b899;">
                                            <strong class="text-gray-700">{{ $lang['34'] }} =</strong>
                                            <strong class="text-green font-s-25 ml-4">{{ $this->gettime($detail['timeres']) }}</strong>
                                        </div>
                                    </div>
                                @elseif($sub_type == 'distance')
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="w-full py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-4" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ number_format($detail['dis_mi'],3) }}</strong>
                                                <span class="ml-2">{{ $lang['35'] }}</span>
                                            </div>
                                        </div>
                                        <div class="w-full py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-4" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ number_format($detail['dis_km'],3) }}</strong>
                                                <span class="ml-2">{{ $lang['36'] }}</span>
                                            </div>
                                        </div>
                                        <div class="w-full py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-4" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ number_format($detail['dis_m'],0) }}</strong>
                                                <span class="ml-2">{{ $lang['37'] }}</span>
                                            </div>
                                        </div>
                                        <div class="w-full py-2">
                                            <div class="bg-[#F6FAFC] border rounded-lg p-4" style="border: 1px solid #c1b8b899;">
                                                <strong class="text-green font-s-25">{{ number_format($detail['dis_yd'],0) }}</strong>
                                                <span class="ml-2">{{ $lang['38'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            <!-- Universal Pace Breakdown (for Calculator 1) -->
                            @if($calculator_name == 'calculator1')
                                <p class="mt-8 font-bold text-gray-800">{{ $lang['39'] }}:</p>
                                <div class="w-full overflow-auto mt-2">
                                    <table class="w-full text-sm" cellspacing="0">
                                        <tr class="bg-gray-50">
                                            <th class="text-start text-blue border-b p-3">{{ $lang['3'] }}</th>
                                            <th class="text-start text-blue border-b p-3">{{ $lang['2'] }} (hh:mm:ss)</th>
                                            <th class="text-start text-blue border-b p-3">{{ $lang['3'] }}</th>
                                            <th class="text-start text-blue border-b p-3">{{ $lang['2'] }} (hh:mm:ss)</th>
                                        </tr>
                                        @php
                                            $breakdown = [
                                                ['1 km', $detail['pacekm']*1, '1 mi', $detail['pace']*1],
                                                ['3 km', $detail['pacekm']*3, '3 mi', $detail['pace']*3],
                                                ['5 km', $detail['pacekm']*5, '5 mi', $detail['pace']*5],
                                                ['10 km', $detail['pacekm']*10, '10 mi', $detail['pace']*10],
                                                ['15 km', $detail['pacekm']*15, '15 mi', $detail['pace']*15],
                                                ['Marathon', $detail['pacekm']*42.195, 'Half-Marathon', $detail['pacekm']*21.0975],
                                                ['400 m', $detail['pacekm']*(400/1000), '800 m', $detail['pacekm']*(800/1000)],
                                            ];
                                        @endphp
                                        <tbody class="divide-y divide-gray-100">
                                            @foreach($breakdown as $row)
                                                <tr>
                                                    <td class="p-3">{{ $row[0] }}</td>
                                                    <td class="p-3 text-blue font-bold">{{ $this->gettime($row[1]) }}</td>
                                                    <td class="p-3">{{ $row[2] }}</td>
                                                    <td class="p-3 text-blue font-bold">{{ $this->gettime($row[3]) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            <!-- Mile/Kilometer Splits (Dynamic) -->
                            @if(isset($detail['dis_km']) && $detail['dis_km'] >= 3 && $calculator_name == 'calculator1')
                                <p class="mt-8 font-bold text-gray-800">{{ $lang['40'] }}:</p>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-2">
                                    <div class="w-full overflow-auto">
                                        <table class="w-full text-sm" cellspacing="0">
                                            <tr class="bg-gray-50">
                                                <th class="text-start text-blue border-b p-3">{{ $lang['3'] }}</th>
                                                <th class="text-start text-blue border-b p-3">{{ $lang['2'] }} (hh:mm:ss)</th>
                                            </tr>
                                            <tbody class="divide-y divide-gray-100">
                                                @for ($i=1; $i <= min(50, floor($detail['dis_km'] ?? 0)); $i++)
                                                    <tr>
                                                        <td class="p-3">{{ $i }} km</td>
                                                        <td class="p-3 text-blue font-bold">{{ $this->gettime(($detail['pacekm'] ?? 0) * $i) }}</td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="w-full overflow-auto">
                                        <table class="w-full text-sm" cellspacing="0">
                                            <tr class="bg-gray-50">
                                                <th class="text-start text-blue border-b p-3">{{ $lang['3'] }}</th>
                                                <th class="text-start text-blue border-b p-3">{{ $lang['2'] }} (hh:mm:ss)</th>
                                            </tr>
                                            <tbody class="divide-y divide-gray-100">
                                                @for ($i=1; $i <= min(50, floor($detail['dis_mi'] ?? 0)); $i++)
                                                    <tr>
                                                        <td class="p-3">{{ $i }} mi</td>
                                                        <td class="p-3 text-blue font-bold">{{ $this->gettime(($detail['pace'] ?? 0) * $i) }}</td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset

    @push('calculatorJS')
        <script src="https://code.highcharts.com/highcharts.js"></script>
    @endpush
</div>
