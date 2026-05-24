<div>
    <style>
    .highcharts-credits{
        display: none
    }
    .orange-text{
        color: #FF6D00;
    }
    
    .docter{
        color: #856404;
        animation: blinker 2s linear infinite;
    }
    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
    .border-b-black{
        border-bottom: 2px solid #D2D4D8;
    }
</style>

 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8  input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
                <div class="grid grid-cols-2 lg:grid-cols-2 md:grid-cols-2  gap-4">
                    
                    {{-- Gender --}}
                    <div class="space-y-2 relative">
                        <label for="gender" class="font-s-14 text-blue">{!! $lang['83'] !!}:</label>
                        <select wire:model.live="gender" id="gender" class="input">
                            <option value="Male">{!! $lang['44'] !!}</option>
                            <option value="Female">{!! $lang['45'] !!}</option>
                        </select>
                    </div>

                    {{-- Age --}}
                    <div class="space-y-2 relative">
                        <label for="age" class="font-s-14 text-blue">{!! $lang['46'] !!}:</label>
                        <input type="number" step="any" wire:model.live="age" id="age" min="18" max="150" class="input" aria-label="input" placeholder="00" />
                    </div>

                    {{-- Height --}}
                    <div class="grid grid-cols-2 gap-4" x-data="{ hightUnit: @entangle('hightUnit') }">
                        <!-- ft/in inputs -->
                        <div class="space-y-2 ft_in" x-show="hightUnit === 'ft/in'" x-cloak>
                            <label for="height_ft" class="font-s-14 text-blue">{!! $lang['height'] !!}:</label>
                            <input type="number" wire:model.live="height_ft" id="height_ft" class="input" min="4" max="7" aria-label="input" placeholder="ft" />
                        </div>
                        <div class="space-y-2 ft_in relative" x-show="hightUnit === 'ft/in'" x-cloak x-data="{ open: false }">
                            <label for="height_in" class="font-s-14 text-blue">&nbsp;</label>
                            <div class="relative w-full">
                                <input type="number" wire:model.live="height_in" id="height_in" step="any" max="11" min="0" class="input" aria-label="input" placeholder="in" />
                                <span class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">
                                    <span x-text="hightUnit"></span> ▾
                                </span>
                                <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p @click="$wire.setHeightUnit('ft/in'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer">feet/inches (ft/in)</p>
                                    <p @click="$wire.setHeightUnit('cm'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer">centimeters (cm)</p>
                                </div>
                            </div>
                        </div>
                        <!-- cm input -->
                        <div class="space-y-2 col-span-2 h_cm" x-show="hightUnit === 'cm'" x-cloak x-data="{ open: false }">
                            <label for="height_cm" class="font-s-14 text-blue">{{ $lang['height'] }} (cm):</label>
                            <div class="relative w-full">
                                <input type="number" wire:model.live="height_cm" id="height_cm" step="any" min="90" max="245" class="input" aria-label="input" placeholder="cm" />
                                <span class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">
                                    <span x-text="hightUnit"></span> ▾
                                </span>
                                <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                    <p @click="$wire.setHeightUnit('ft/in'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer">feet/inches (ft/in)</p>
                                    <p @click="$wire.setHeightUnit('cm'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer">centimeters (cm)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Weight --}}
                    <div class="space-y-2">
                        <label for="weight" class="font-s-14 text-blue">{{ $lang['weight'] }}:</label>
                        <div class="relative w-full" x-data="{ open: false, unit: @entangle('unit') }">
                            <input type="number" wire:model.live="weight" id="weight" step="any" class="input" placeholder="00" />
                            <span class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">
                                <span x-text="unit"></span> ▾
                            </span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                <p @click="$wire.setWeightUnit('lbs'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">pounds (lbs)</p>
                                <p @click="$wire.setWeightUnit('kg'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">kilograms (kg)</p>
                            </div>
                        </div>
                     </div>

                     {{-- Target Weight to Lose --}}
                     <div class="space-y-2">
                        <label for="lose_w" class="font-s-14 text-blue">{!! $lang['49'] !!}:</label>
                        <div class="relative w-full" x-data="{ open: false, lose_unit: @entangle('lose_unit') }">
                            <input type="number" wire:model.live="lose_w" id="lose_w" step="any" class="input" placeholder="00" />
                            <span class="absolute cursor-pointer text-sm underline right-6 top-4" @click="open = !open">
                                <span x-text="lose_unit"></span> ▾
                            </span>
                            <div x-show="open" x-cloak @click.away="open = false" class="absolute z-10 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg">
                                <p @click="$wire.setLoseUnit('lbs'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">pounds (lbs)</p>
                                <p @click="$wire.setLoseUnit('kg'); open = false" class="p-2 hover:bg-gray-100 cursor-pointer text-sm">kilograms (kg)</p>
                            </div>
                        </div>
                     </div>

                    </div>

                    {{-- Activity --}}
                    <div class="space-y-2 mt-4">
                        <label for="activity" class="font-s-14 text-blue">{!! $lang['daily_activity'] !!}:</label>
                        <select wire:model.live="activity" id="activity" class="input">
                            <option value="0.2">No sport/exercise</option>
                            <option value="0.375">Light activity (sport 1-3 times per week)</option>
                            <option value="0.55">Moderate activity (sport 3-5 times per week)</option>
                            <option value="0.725">High activity (everyday exercise)</option>
                            <option value="0.9">Extreme activity (professional athlete)</option>
                        </select>
                    </div>

                    {{-- Goal reduction type selection --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 mt-5 gap-4" x-data="{ choose: @entangle('choose') }">
                            <div class="col-lg-6 col-12 px-lg-2 row">
                                <label class="my-2" for="by_date">
                                    <input type="radio" value="by_date" wire:model.live="choose" id="by_date" class="with-gap" />
                                    <span class="text-[14px]"><strong>Time to reach your weight goal?</strong></span>
                                </label>
                                <div class="grid grid-cols-2 my-3 lg:grid-cols-2 md:grid-cols-2 gap-4" :class="{ 'opacity-50 pointer-events-none': choose !== 'by_date' }">
                                        <div class="col-6 pe-lg-1 pe-2">
                                            <label for="start" class="font-s-14 text-blue">{!! isset($lang['start'])?$lang['start']:"Start Date" !!}:</label>
                                            <div class="w-100 py-2 position-relative">
                                                <input type="date" wire:model.live="start" id="start" class="input" aria-label="input" :disabled="choose !== 'by_date'" />
                                            </div>
                                        </div>
                                        <div class="col-6 ps-lg-1 ps-2">
                                            <label for="target" class="font-s-14 text-blue">{!! isset($lang['90'])?$lang['90']:"Target Date" !!}:</label>
                                            <div class="w-100 py-2 position-relative">
                                                <input type="date" wire:model.live="target" id="target" class="input" aria-label="input" :disabled="choose !== 'by_date'" />
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 px-lg-2 row">
                                <label class="my-2" for="by_calories">
                                    <input type="radio" value="by_calories" wire:model.live="choose" id="by_calories" class="with-gap" />
                                    <span class="font-s-14"><strong>Kcal/day are you ready to reduce?</strong></span>
                                </label>
                                <div class="col-12 mt-3" :class="{ 'opacity-50 pointer-events-none': choose !== 'by_calories' }">
                                    <label for="enter_calories" class="label">Calories:</label>
                                    <div class="w-100 py-2 relative">
                                        <input type="number" step="any" wire:model.live="enter_calories" id="enter_calories" class="input" min="1" aria-label="input" placeholder="00" :disabled="choose !== 'by_calories'" />
                                        <span class="text-blue input_unit">Kcal/day</span>
                                    </div>
                                </div>
                            </div>
                    </div>
           </div>
            @if ($type == 'calculator')
            @include('inc.button')
           @endif
           @if ($type=='widget')
           @include('inc.widget-button')
            @endif
        </div>

    @isset($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8  result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
                <div class="">
                    <div class=" bg-light-blue result radius-10 p-3 mt-3">
                        @php
                            $submit = $detail['submit'];
                        @endphp
                        <div class="w-full ">
                            @if($detail['from'] === "from_day" || $detail['from'] === "from_pace")
                            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                                    <div class="space-y-2">
                                        <div style="background:#F6FAFC;min-height: 266px"  class="bg-[#F6FAFC] border radius-10 px-3 py-2" >
                                            <p><strong class="text-blue border-b-black-blue font-s-18">{{ $lang[102] }}</strong></p>
                                            <p class="font-s-15 mb-2 mt-3">
                                                <span>{{ $lang[137] }}</span>
                                                <strong>
                                                    @php
                                                        $NewDate = Date('d-M-Y', strtotime("+" . @$detail['days'] . " days"));
                                                        echo $NewDate.'.';
                                                    @endphp
                                                </strong>
                                            </p>
                                            <p class="text-center">
                                                <strong class=" orange-text" style="font-size: 40px">{{ $detail['CaloriesDaily'] }}</strong>
                                                <strong class="text-blue">{{ $lang[103] }}</strong>
                                            </p>
                                        </div>
                                    </div>
                
                                    <div class="space-y-2">
                                        <div style="background:#F6FAFC"  class="bg-[#def4ff] border radius-10 px-3 py-2">
                                            <div class="w-full overflow-auto">
                                                <p class="mb-2"><strong class="text-blue border-b-black-blue font-s-18">{{ $lang[119] }}</strong></p>
                                                <table class="w-full" cellspacing="0">
                                                    <tr>
                                                        <td class="border-b-black py-2">
                                                            <span class="font-s-14">BMR</span>
                                                            <span class="bg-white radius-circle px-2 ms-1" title="{{ $lang[120] }}">?</span>
                                                        </td>
                                                        <td class="text-end border-b-black py-2">
                                                            <strong>{{ $detail['BMR'] }} </strong> <sub>{{ $lang[105] }}</sub>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b-black py-2">
                                                            <span class="font-s-14">BMI</span>
                                                            <span class="bg-white radius-circle px-2 ms-1" title="{{ $lang[123] }}">?</span>
                                                        </td>
                                                        <td class="text-end border-b-black py-2"><strong>{{ $detail['BMI'] }}</strong>
                                                            <sub>Kg/m<sup>2</sup></sub>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b-black py-2">
                                                            <span class="font-s-14">IBW</span>
                                                            <span class="bg-white radius-circle px-2 ms-1" title="{{ $lang[124] }}">?</span>
                                                        </td>
                                                        <td class="text-end border-b-black py-2"><strong>{!! $detail['ibw'] !!}</strong>
                                                        @if($lose_unit == 'lbs')
                                                            <sub> lbs</sub>
                                                        @else
                                                            <sub> kg</sub>
                                                        @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2">
                                                            <span class="font-s-14">{{ $lang[125] }}</span>
                                                            <span class="bg-white radius-circle px-2 ms-1" title="{{ $lang[126] }}">?</span>
                                                        </td>
                                                        <td class="text-end py-2">
                                                            <strong>
                                                                 @if($detail['you_are'] == 'Underweight')
                                                                    {{ $lang[127] }}
                                                                @elseif($detail['you_are'] == 'Normal Weight')
                                                                    {{ $lang[128] }}
                                                                @elseif($detail['you_are'] == 'Overweight')
                                                                    {{ $lang[129] }}
                                                                @elseif($detail['you_are'] == 'Obesity')
                                                                    {{ $lang[130] }}
                                                                @elseif($detail['you_are'] == 'Severe Obesity')
                                                                    {{ $lang[131] }}
                                                                @endif
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                                    <div class="space-y-2">
                                        <div style="background:#F6FAFC ;min-height: 207px"  class="bg-[#F6FAFC] border-2 rounded-lg p-5"  >
                                            <p><strong class="text-blue border-b-black-blue font-s-18">{{ $lang[102] }}</strong></p>
                                            <p class="font-s-15 mt-3 mb-2">
                                                <span>{{ $lang[137] }}</span> <br>
                                                <strong>
                                                    @php
                                                        $NewDate = Date('d-M-Y', strtotime("+" . @$detail['days'] . " days"));
                                                        echo $NewDate.'.';
                                                    @endphp
                                                </strong>
                                            </p>
                                            <div class="text-center">
                                                <strong class="orange-text" style="font-size: 40px">{{ number_format($detail['CaloriesDaily']) }}</strong>
                                                <p class="text-blue"><strong class="text-blue">{{ $lang[103] }}</strong>  <br> <span class="text-blue">&nbsp;</span></p>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="space-y-2">
                                        <div style="background:#F6FAFC;min-height: 266px"  class="bg-[#F6FAFC] border-2 rounded-lg p-5" >
                                            <div class="w-full overflow-auto">
                                                <p class="mb-2"><strong class="text-blue border-b-black-blue font-s-18">{{ $lang[119] }}</strong></p>
                                                <table class="w-full mt-3" cellspacing="0">
                                                    <tr>
                                                        <td class="border-b-black py-2">
                                                            <span class="font-s-14">Basal Metabolic Rate (BMR)</span>
                                                        </td>
                                                        <td class="text-end border-b-black py-2">
                                                            <strong>{{ $detail['BMR'] }} </strong> <sub>{{ $lang[105] }}</sub>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b-black py-2">
                                                            <span class="font-s-14">Body Mass Index (BMI)</span>
                                                        </td>
                                                        <td class="text-end border-b-black py-2"><strong>{{ $detail['BMI'] }}</strong>
                                                            <sub>Kg/m<sup>2</sup></sub>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-b-black py-2">
                                                            <span class="font-s-14">Ideal body weight (IBW)</span>
                                                        </td>
                                                        <td class="text-end border-b-black py-2"><strong>{!! $detail['ibw'] !!}</strong>
                                                        @if($lose_unit == 'lbs')
                                                            <sub> lbs</sub>
                                                        @else
                                                            <sub> kg</sub>
                                                        @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 border-b-black">
                                                            <span class="font-s-14">{{ $lang[125] }}</span>
                                                        </td>
                                                        <td class="text-end py-2 border-b-black">
                                                            <strong>
                                                                @if($detail['you_are'] == 'Underweight')
                                                                    {{ $lang[127] }}
                                                                @elseif($detail['you_are'] == 'Normal Weight')
                                                                    {{ $lang[128] }}
                                                                @elseif($detail['you_are'] == 'Overweight')
                                                                    {{ $lang[129] }}
                                                                @elseif($detail['you_are'] == 'Obesity')
                                                                    {{ $lang[130] }}
                                                                @elseif($detail['you_are'] == 'Severe Obesity')
                                                                    {{ $lang[131] }}
                                                                @endif
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($detail['CaloriesDaily'] <= 1000)
                                    <p class="font-s-15 docter">Consult a doctor if your plan requires consuming less than 1,000 Kcal/day.</p>
                                @endif
                            @endif
                            @if(app()->getLocale() == 'en')
                                <!-- Weight Loss And Weight Gain Table -->
                                <div style="background:#F6FAFC"  class="bg-[#F6FAFC] border radius-10 px-3 py-2 h-100 overflow-auto mt-3">
                                    <table class="w-full" cellspacing="0">
                                        <tr>
                                            <td class="border-b-black py-2">Maintain weight</td>
                                            <td class="border-b-black py-2 text-end">
                                                <strong class="font-s-18">{{ number_format($detail['Calories']) }}</strong>
                                                <span class="font-s-14">Calories/Day</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b-black py-2">Mild Weight Loss {{ ($submit === "lbs") ? "( 0.5 lb/week )" : "( 0.25 kg/week )"}}</td>
                                            <td class="border-b-black py-2 text-end">
                                                @php
                                                    $calorieReduction = ($submit === "lbs") ? 250 : round((7700 * 0.25) / 7);
                                                @endphp                        
                                                <strong class="font-s-18">{{ number_format($detail['Calories']-$calorieReduction) }}</strong>
                                                <span class="font-s-14">Calories/Day</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-b-black py-2">Weight Loss {{ ($submit === "lbs") ? "( 1 lb/week )" : "( 0.5 kg/week )"}}</td>
                                            <td class="border-b-black py-2 text-end">
                                                @php $calorieReduction = ($submit === "lbs") ? 500 : round((7700 * 0.5) / 7); @endphp
                                                <strong class="font-s-18">{{ number_format($detail['Calories']-$calorieReduction) }}</strong>
                                                <span class="font-s-14">Calories/Day</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2">Extreme Weight Loss {{ ($submit === "lbs") ? "( 2 lb/week ) " : "( 1 kg/week )" }}</td>
                                            <td class="py-2 text-end">
                                                @php $calorieReduction = ($submit === "lbs") ? 1000 : round(7700 / 7); @endphp
                                                <strong class="font-s-18">{{ number_format($detail['Calories']-$calorieReduction) }}</strong>
                                                <span class="font-s-14">Calories/Day</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            @endif
                            
                            <!-- Weight Loss Chart -->
                            <div class="row mt-3">
                                <p class="font-s-18 mb-3 ps-lg-3"><strong class="text-blue border-b-black-blue">{{ $lang[132] }}</strong></p>
                                <div style="background:#F6FAFC" class="col-12 bg-[#def4ff] radius-10 pb-2">
                                    <div class="w-full mt-8" 
                                         x-data="{ 
                                            chartData: {{ json_encode($detail['chartData'] ?? []) }},
                                            categories: {{ json_encode($detail['chartCategories'] ?? []) }},
                                            suffix: '{{ $detail['submit'] ?? 'lbs' }}',
                                            render() {
                                                if (typeof Highcharts === 'undefined') {
                                                    setTimeout(() => this.render(), 200);
                                                    return;
                                                }
                                                Highcharts.chart($refs.canvas, {
                                                    chart: { type: 'line', backgroundColor: 'transparent' },
                                                    title: { text: null },
                                                    xAxis: { 
                                                        categories: this.categories,
                                                        title: { text: 'Days' },
                                                        gridLineWidth: 1 
                                                    },
                                                    yAxis: { 
                                                        title: { text: 'Current Weight' }, 
                                                        gridLineWidth: 1,
                                                        labels: {
                                                            formatter: function() {
                                                                return Math.abs(this.value) + ' ' + this.chart.options.tooltip.valueSuffix;
                                                            }
                                                        }
                                                    },
                                                    legend: { enabled: false },
                                                    tooltip: { 
                                                        crosshairs: true,
                                                        shared: true,
                                                        valueSuffix: ' ' + this.suffix
                                                    },
                                                    series: [{ 
                                                        name: 'Weight', 
                                                        data: this.chartData, 
                                                        color: '#2845F5',
                                                        lineWidth: 2,
                                                        marker: { enabled: true, radius: 3 }
                                                    }],
                                                    credits: { enabled: false }
                                                });
                                            }
                                         }" 
                                         x-init="render()"
                                         @chart-updated.window="
                                             const data = $event.detail.chartData ? $event.detail : (Array.isArray($event.detail) && $event.detail[0] && $event.detail[0].chartData ? $event.detail[0] : (typeof $event.detail === 'object' ? $event.detail : {}));
                                             chartData = data.chartData || [];
                                             categories = data.chartCategories || [];
                                             suffix = data.suffix || 'lbs';
                                             render();
                                         "
                                         wire:ignore>
                                        <div x-ref="canvas" class="w-full min-h-[400px]"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Activities -->
                            <div class="col-12 mt-3" x-data="{ time_duration: @entangle('time_duration') }">
                                <p class="ps-lg-3"><strong class="text-blue border-b-black-blue font-s-18">{{ $lang[146] }}!</strong></p>
                                <div style="background:#F6FAFC"  class="bg-[#def4ff] border radius-10 p-3 mt-2">
                                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 align-items-center">
                                        <div>  <p><strong class="text-blue">{{ $lang[147] }}</strong></p></div>
                                      
                                        <div >
                                            <div class="col-md-9 ms-auto">
                                                <select wire:model.live="time_duration" id="time_duration" class="input">
                                                    <option value="1">15 {{ $lang[148] }}</option>
                                                    <option value="2">30 {{ $lang[148] }}</option>
                                                    <option value="3">45 {{ $lang[148] }}</option>
                                                    <option value="4">1 {{ $lang[149] }}</option>
                                                    <option value="5">1 {{ $lang[149] }} 15 {{ $lang[148] }}</option>
                                                    <option value="6">1 {{ $lang[149] }} 30 {{ $lang[148] }}</option>
                                                    <option value="7">1 {{ $lang[149] }} 45 {{ $lang[148] }}</option>
                                                    <option value="8">2 {{ $lang[149] }}s</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {{-- Active durations list --}}
                                    <div class="col-12 calories_pandran my-3" x-show="time_duration === '1'" x-cloak>
                                        @if(count($detail['diff_array_pandran']) > 0)
                                            <div class="col-12 overflow-auto" style="height:300px">
                                                <table class="col-12" cellspacing="0">
                                                    @foreach($detail['final_array_pandran'] as $key => $value)
                                                        <tr>
                                                            @php list($cal_ans, $name_ans, $img_ans) = explode("@@", $value) @endphp
                                                            <td class="col-10 border-b-black border-e py-3 pe-3">{{ $name_ans }}</td>
                                                            <td class="col-2 border-b-black py-3 px-3 pe-lg-0"><strong>{{ $cal_ans }}</strong> kcal</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @else
                                            <p>{{ $lang[150] }}</p>
                                        @endif
                                    </div>
                                    <div class="col-12 calories_adha my-3" x-show="time_duration === '2'" x-cloak>
                                        @if(count($detail['diff_array_adha']) > 0)
                                            <div class="col-12 overflow-auto" style="height:300px">
                                                <table class="w-[100%]" cellspacing="0">
                                                    @foreach($detail['final_array_adha'] as $key => $value)
                                                        <tr>
                                                            @php list($cal_ans, $name_ans, $img_ans) = explode("@@", $value) @endphp
                                                            <td class="col-10 border-b-black border-e py-3 pe-3">{{ $name_ans }}</td>
                                                            <td class="col-2 border-b-black py-3 px-3 pe-lg-0"><strong>{{ $cal_ans }}</strong> kcal</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @else
                                            <p>{{ $lang[150] }}</p>
                                        @endif
                                    </div>
                                    <div class="col-12 calories_pona my-3" x-show="time_duration === '3'" x-cloak>
                                        @if(count($detail['diff_array_pona']) > 0)
                                            <div class="col-12 overflow-auto" style="height:300px">
                                                <table class="w-[100%]" cellspacing="0">
                                                    @foreach($detail['final_array_pona'] as $key => $value)
                                                        <tr>
                                                            @php list($cal_ans, $name_ans, $img_ans) = explode("@@", $value) @endphp
                                                            <td class="col-10 border-b-black border-e py-3 pe-3">{{ $name_ans }}</td>
                                                            <td class="col-2 border-b-black py-3 px-3 pe-lg-0"><strong>{{ $cal_ans }}</strong> kcal</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @else
                                            <p>{{ $lang[150] }}</p>
                                        @endif
                                    </div>
                                    <div class="col-12 calories_hour my-3" x-show="time_duration === '4'" x-cloak>
                                        @if(count($detail['diff_array']) > 0)
                                            <div class="col-12 overflow-auto" style="height:300px">
                                                <table class="w-[100%]" cellspacing="0">
                                                    @foreach($detail['final_array'] as $key => $value)
                                                        <tr>
                                                            @php list($cal_ans, $name_ans, $img_ans) = explode("@@", $value) @endphp
                                                            <td class="col-10 border-b-black border-e py-3 pe-3">{{ $name_ans }}</td>
                                                            <td class="col-2 border-b-black py-3 px-3 pe-lg-0"><strong>{{ $cal_ans }}</strong> kcal</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @else
                                            <p>{{ $lang[150] }}</p>
                                        @endif
                                    </div>
                                    <div class="col-12 calories_sawa my-3" x-show="time_duration === '5'" x-cloak>
                                        @if(count($detail['diff_array_sawa']) > 0)
                                            <div class="col-12 overflow-auto" style="height:300px">
                                                <table class="w-[100%]" cellspacing="0">
                                                    @foreach($detail['final_array_sawa'] as $key => $value)
                                                        <tr>
                                                            @php list($cal_ans, $name_ans, $img_ans) = explode("@@", $value) @endphp
                                                            <td class="col-10 border-b-black border-e py-3 pe-3">{{ $name_ans }}</td>
                                                            <td class="col-2 border-b-black py-3 px-3 pe-lg-0"><strong>{{ $cal_ans }}</strong> kcal</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @else
                                            <p>{{ $lang[150] }}</p>
                                        @endif
                                    </div>
                                    <div class="col-12 calories_dher my-3" x-show="time_duration === '6'" x-cloak>
                                        @if(count($detail['diff_array_dher']) > 0)
                                            <div class="col-12 overflow-auto" style="height:300px">
                                                <table class="w-[100%]" cellspacing="0">
                                                    @foreach($detail['final_array_dher'] as $key => $value)
                                                        <tr>
                                                            @php list($cal_ans, $name_ans, $img_ans) = explode("@@", $value) @endphp
                                                            <td class="col-10 border-b-black border-e py-3 pe-3">{{ $name_ans }}</td>
                                                            <td class="col-2 border-b-black py-3 px-3 pe-lg-0"><strong>{{ $cal_ans }}</strong> kcal</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @else
                                            <p>{{ $lang[150] }}</p>
                                        @endif
                                    </div>
                                    <div class="col-12 calories_pone my-3" x-show="time_duration === '7'" x-cloak>
                                        @if(count($detail['diff_array_pone']) > 0)
                                            <div class="col-12 overflow-auto" style="height:300px">
                                                <table class="w-[100%]" cellspacing="0">
                                                    @foreach($detail['final_array_pone'] as $key => $value)
                                                        <tr>
                                                            @php list($cal_ans, $name_ans, $img_ans) = explode("@@", $value) @endphp
                                                            <td class="col-10 border-b-black border-e py-3 pe-3">{{ $name_ans }}</td>
                                                            <td class="col-2 border-b-black py-3 px-3 pe-lg-0"><strong>{{ $cal_ans }}</strong> kcal</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @else
                                            <p>{{ $lang[150] }}</p>
                                        @endif
                                    </div>
                                    <div class="col-12 calories_do my-3" x-show="time_duration === '8'" x-cloak>
                                        @if(count($detail['diff_array_pone']) > 0)
                                            <div class="col-12 overflow-auto" style="height:300px">
                                                <table class="w-[100%]" cellspacing="0">
                                                    @foreach($detail['final_array_do'] as $key => $value)
                                                        <tr>
                                                            @php list($cal_ans, $name_ans, $img_ans) = explode("@@", $value) @endphp
                                                            <td class="col-10 border-b-black border-e py-3 pe-3">{{ $name_ans }}</td>
                                                            <td class="col-2 border-b-black py-3 px-3 pe-lg-0"><strong>{{ $cal_ans }}</strong> kcal</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @else
                                            <p>{{ $lang[150] }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(app()->getLocale() == 'en')
                                <!-- Zigzag Calorie Cycling -->
                                <div class="row mt-3 ">
                                    <p class="mb-2 ps-lg-3"><strong class="text-blue border-b-black-blue font-s-18">Activity Level</strong></p>
                                    <p class="mb-2 ps-lg-3">Besides cutting calories, amp up your activity! See a list of estimated weight loss for different activity levels, based on a daily intake of {{ $detail['Calories'] }} calories.</p>
                                    <div class="col-12 overflow-auto bg-[#F6FAFC] border radius-10 p-3" style="background:#F6FAFC">
                                        <table class="w-100 " cellspacing="0">
                                            <tr>
                                                <th class="text-start border-b-black py-2 pe-2">Activity Level</th>
                                                <th class="text-start border-b-black py-2 ps-2">Weight lost per week</th>
                                            </tr>
                                            @php $submit_unit = ($submit === "lbs") ? "lbs" : "kg" @endphp
                                            
                                            <tr>
                                                <td class="border-b-black py-2 pe-2">No sport/exercise</td>
                                                <td class="border-b-black py-2 ps-2">{{ $detail['activity_first'] }} {{ $submit_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b-black py-2 pe-2">Light activity (sport 1-3 times per week)</td>
                                                <td class="border-b-black py-2 ps-2">{{ $detail['activity_second'] }} {{ $submit_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b-black py-2 pe-2">Moderate activity (sport 3-5 times per week)</td>
                                                <td class="border-b-black py-2 ps-2">{{ $detail['activity_third'] }} {{ $submit_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="border-b-black py-2 pe-2">High activity (everyday exercise)</td>
                                                <td class="border-b-black py-2 ps-2">{{ $detail['activity_four'] }} {{ $submit_unit }}</td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 pe-2 border-b-black">Extreme activity (professional athlete)</td>
                                                <td class="py-2 ps-2 border-b-black">{{ $detail['activity_five'] }} {{ $submit_unit }}</td>
                                            </tr>
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

</form>
</div>