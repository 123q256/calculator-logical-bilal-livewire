<div>
      <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
        @if ($error)
            <p class="text-red-500 text-lg font-semibold w-full text-center">{{ $error }}</p>
        @endif

        <div class="lg:w-[85%] w-full mx-auto space-y-6">
            <div class="grid grid-cols-12 gap-x-8 gap-y-6">
                {{-- Age --}}
                <div class="col-span-12 md:col-span-6">
                    <label class="text-[15px] font-medium text-gray-700 mb-2 block">Age Years:</label>
                    <input type="number" wire:model.live="age" class="border p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" placeholder="25">
                </div>

                {{-- Gender --}}
                <div class="col-span-12 md:col-span-6">
                    <label class="text-[15px] font-medium text-gray-700 mb-2 block">Gender:</label>
                    <div class="relative">
                        <select wire:model.live="gender" class="border p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 bg-white cursor-pointer appearance-none">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                {{-- Height --}}
                <div class="col-span-12 md:col-span-6" x-data="{ open: false }">
                    <label class="text-[15px] font-medium text-gray-700 mb-2 block">Height:</label>
                    <div class="flex items-center gap-3">
                        @if($unit_h === 'ft/in')
                            <div class="w-[80px]">
                                <input type="number" wire:model.live="height_ft" class="border p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3" placeholder="ft">
                            </div>
                            <div class="flex-1 relative">
                                <input type="number" wire:model.live="height_in" class="border p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-16" placeholder="in">
                                <label class="absolute cursor-pointer  underline right-3 top-1/2 -translate-y-1/2 z-20" @click="open = !open">{{ $unit_h }} ▾</label>
                                
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg overflow-hidden">
                                    <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_h', 'ft/in')" @click="open = false">feet / inches (ft/in)</p>
                                    <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_h', 'ft')" @click="open = false">feet (ft)</p>
                                    <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_h', 'in')" @click="open = false">inch (in)</p>
                                    <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_h', 'cm')" @click="open = false">centimeters (cm)</p>
                                    <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_h', 'm')" @click="open = false">meters (m)</p>
                                </div>
                            </div>
                        @else
                            <div class="flex-1 relative">
                                <input type="number" wire:model.live="height_cm" class="border p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-16" placeholder="{{ $unit_h }}">
                                <label class="absolute cursor-pointer  underline right-3 top-1/2 -translate-y-1/2 z-20" @click="open = !open">{{ $unit_h }} ▾</label>
                                
                                <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-auto mt-1 right-0 shadow-lg overflow-hidden">
                                    <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_h', 'ft/in')" @click="open = false">feet / inches (ft/in)</p>
                                    <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_h', 'ft')" @click="open = false">feet (ft)</p>
                                    <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_h', 'in')" @click="open = false">inch (in)</p>
                                    <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_h', 'cm')" @click="open = false">centimeters (cm)</p>
                                    <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit_h', 'm')" @click="open = false">meters (m)</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Weight --}}
                <div class="col-span-12 md:col-span-6" x-data="{ open: false }">
                    <label class="text-[15px] font-medium text-gray-700 mb-2 block">Weight:</label>
                    <div class="relative">
                        <input type="number" wire:model.live="weight" class="border p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 pr-16" placeholder="{{ $unit }}">
                        <label class="absolute cursor-pointer underline right-3 top-1/2 -translate-y-1/2 z-20" @click="open = !open">{{ $unit }} ▾</label>
                        
                        <div x-show="open" @click.away="open = false" x-cloak class="absolute z-50 bg-white border border-gray-300 rounded-md w-32 mt-1 right-0 shadow-lg overflow-hidden">
                            <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit', 'lbs')" @click="open = false">pounds (lbs)</p>
                            <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit', 'kg')" @click="open = false">kilograms (kg)</p>
                            <p class="p-2 cursor-pointer text-xs hover:bg-blue-50" wire:click="setUnit('unit', 'stone')" @click="open = false">stone</p>
                        </div>
                    </div>
                </div>

                {{-- PAL --}}
                <div class="col-span-12">
                    <label class="text-[15px] font-medium text-gray-700 mb-2 block">PAL (optional):</label>
                    <div class="relative">
                        <select wire:model.live="activity" class="border p-1 rounded-xl focus:ring-2 focus:ring-blue-200 w-full text-xs h-10 px-3 bg-white cursor-pointer appearance-none">
                            <option value="1.2">Sedentary (little or no exercise)</option>
                            <option value="1.375">Lightly active (light exercise/sports 1-3 days/week)</option>
                            <option value="1.55">Moderate exercise 2-3 times a week</option>
                            <option value="1.725">Very active (hard exercise/sports 6-7 days a week)</option>
                            <option value="1.9">Extra active (very hard exercise/sports & physical job)</option>
                            <option value="2.3">Professional Athlete</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap gap-x-2 gap-y-1 text-[16px] pt-2 mt-6">
                <span class="font-medium text-gray-700">Related Calculators:</span>
                <a href="{{ url('bmr-calculator') }}/" class="text-blue-500 hover:underline">BMR Calculator</a>,
                <a href="{{ url('macro-calculator') }}/" class="text-blue-500 hover:underline">Macro Calculator</a>,
                <a href="{{ url('weightloss-calculator') }}/" class="text-blue-500 hover:underline">Weight loss Calculator</a>
            </div>
        </div>

           @if ($type == 'calculator')
        @include('inc.button')
        @endif
        @if ($type=='widget')
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
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12">
                                    <div class="flex items-center bg-[#F6FAFC] border rounded-lg h-100 p-3" style="border: 1px solid #c1b8b899;">
                                        <strong>BMR = <span class="text-[#119154] text-[28px]">{{ $detail['bmr_ans'] }}</span> kcal/day</strong>
                                    </div>
                                </div>
                                <div class="col-span-12">
                                    <div class="flex items-center bg-[#F6FAFC] border rounded-lg h-100 p-3" style="border: 1px solid #c1b8b899;">
                                        <strong>{{ $lang[8] }} = <span class="text-[#119154] text-[28px]">{{ $detail['tee'] }}</span> kcal/day</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex items-center bg-[#F6FAFC] border rounded-lg h-100 p-3" style="border: 1px solid #c1b8b899;">
                                        <strong>{{ $lang[9] }} = <span class="text-[#119154] text-[28px]">{{ $detail['carb_gram_ans'] }}</span> Grams per day</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex items-center bg-[#F6FAFC] border rounded-lg h-100 p-3" style="border: 1px solid #c1b8b899;">
                                        <strong>{{ $lang[10] }} = <span class="text-[#119154] text-[28px]">{{ $detail['pro_gram_ans'] }}</span> Grams per day</strong>
                                    </div>
                                </div>
                                <div class="col-span-12 md:col-span-6 lg:col-span-6">
                                    <div class="flex items-center bg-[#F6FAFC] border rounded-lg h-100 p-3" style="border: 1px solid #c1b8b899;">
                                        <strong>{{ $lang[11] }} = <span class="text-[#119154] text-[28px]">{{ $detail['fats_gram_ans'] }}</span> Grams per day</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 mt-8">
                                <p class="font-s-20 mb-2"><strong class="text-blue">Grams Per Day Percentage Chart</strong></p>
                                <div class="w-full mt-4" 
                                     x-data='{ 
                                        chartData: {!! $detail["chartData"] !!},
                                        render() {
                                            if (typeof Highcharts === "undefined") {
                                                setTimeout(() => this.render(), 200);
                                                return;
                                            }
                                            Highcharts.chart($refs.canvas, {
                                                chart: { type: "pie", backgroundColor: "transparent" },
                                                title: { text: "", align: "left" },
                                                tooltip: { pointFormat: "{series.name}: <b>{point.percentage:.1f}%</b>" },
                                                plotOptions: {
                                                    pie: {
                                                        allowPointSelect: true,
                                                        cursor: "pointer",
                                                        dataLabels: { enabled: true, format: "<b>{point.name}</b>: {point.percentage:.1f} %" },
                                                        showInLegend: true
                                                    }
                                                },
                                                series: [{ name: "Macros", colorByPoint: true, data: this.chartData }],
                                                credits: { enabled: false }
                                            });
                                        }
                                     }'
                                     x-init="render()"
                                     @chartUpdated.window="chartData = (typeof $event.detail === 'string') ? JSON.parse($event.detail) : $event.detail; render()"
                                     wire:ignore>
                                    <div x-ref="canvas" class="w-full min-h-[400px]"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</form>
</div>
@push('calculatorJS')
    <script src="https://code.highcharts.com/highcharts.js"></script>
@endpush
