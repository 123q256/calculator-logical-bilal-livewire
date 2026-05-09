<div>
   <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-2">
                <div class="col-span-12  mb-2 text-center flex items-center justify-between">
                    <div class="flex items-center">
                        <p class="font-s-14 me-2">{{ $lang['2'] }}:</p>
                        <input wire:model.live="freq" id="freq" value="ind" class="ind cursor-pointer" type="radio" />
                        <label for="freq" class="font-s-14 text-blue pe-lg-3 px-1 cursor-pointer">{{ $lang['3'] }}</label>
                        
                        <input wire:model.live="freq" id="freq1" value="grp" class="grp cursor-pointer" type="radio" />
                        <label for="freq1" class="font-s-14 text-blue ps-1 cursor-pointer">{{ $lang['4'] }}</label>
                    </div>
                </div>
                
                <div class="col-span-6 k_div" x-show="$wire.freq === 'grp'" x-cloak>
                    <label for="st_val" class="font-s-14 text-blue">Starting Value:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="st_val" id="st_val" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-6 k_div" x-show="$wire.freq === 'grp'" x-cloak>
                    <label for="k" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="k" id="k" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                
                <div class="col-span-12 ">
                    <label for="data" class="font-s-14 text-blue">{{ $lang['1'] }} </label>
                    <div class="w-100 py-2">
                        <textarea wire:model.live="data" id="data" class="textareaInput" aria-label="input" placeholder="e.g. 4, 14, 16, 22, 24, 25, 37, 38, 38, 40, 42, 42, 45, 44"></textarea>
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="text-center">
                            <p class="text-[20px]"><strong>{{ $lang['6'] }}</strong></p>
                        </div>
                        <div class="w-full mt-2 overflow-auto">
                            {!! $detail['table'] !!}
                        </div>
                        <p class="w-full mt-3 text-[18px]"><strong class="text-blue">{{ $lang['37'] }}</strong></p>
                        <div class="w-full mt-3" 
                             x-data="{ 
                                chartCategories: {{ $detail['chartCategories'] }},
                                seriesData: {{ $detail['seriesData'] }},
                                groupNames: {{ $detail['groupNames'] }},
                                render() {
                                    if (typeof Highcharts === 'undefined') {
                                        setTimeout(() => this.render(), 200);
                                        return;
                                    }
                                    Highcharts.chart(this.$refs.canvas, {
                                        chart: { type: 'column' },
                                        title: { text: '{!! str_replace("'", "\'", $lang["40"] ?? "") !!}', align: 'left' },
                                        subtitle: { text: 'Source: <a target=\'_blank\' href=\'https://www.indexmundi.com/agriculture/?commodity=corn\'>indexmundi</a>', align: 'left' },
                                        xAxis: { categories: this.chartCategories, crosshair: true },
                                        yAxis: { min: 0, title: { text: '{!! str_replace("'", "\'", $lang["2"] ?? "") !!}' } },
                                        plotOptions: { column: { pointPadding: 0.2, borderWidth: 0 } },
                                        series: [
                                            { name: '{!! str_replace("'", "\'", $lang["2"] ?? "") !!}', data: this.seriesData },
                                            { name: '{!! str_replace("'", "\'", $lang["38"] ?? "") !!}', data: this.groupNames }
                                        ],
                                        credits: { enabled: false }
                                    });
                                }
                             }"
                             x-init="render()"
                             @chart-updated.window="
                                chartCategories = JSON.parse($event.detail.chartCategories); 
                                seriesData = JSON.parse($event.detail.seriesData); 
                                groupNames = JSON.parse($event.detail.groupNames); 
                                render();
                             "
                             wire:ignore>
                            <div x-ref="canvas" style="height:350px" class="w-full"></div>
                        </div>
            
                        <p class="w-full mt-3 text-[18px]"><strong>{{ $lang['7'] }}</strong></p>
                        <p class="w-full mt-2">{{ $lang['10'] }} ({{ $lang['11'] }}): μ = {{ $detail['mean'] }}</p>
                        <p class="w-full mt-2">{{ $lang['12'] }} = {{ $detail['median'] }}</p>
                        <p class="w-full mt-2">{{ $lang['13'] }} = {
                            @foreach($detail['mode'] as $value)
                                @if($loop->last)
                                    {{ $value }}
                                @else
                                    {{ $value }} , 
                                @endif
                            @endforeach
                        } - multimodal</p>
                        <p class="w-full mt-2">{{ $lang['14'] }} = {{ $detail['min'] }}</p>
                        <p class="w-full mt-2">{{ $lang['15'] }} = {{ $detail['max'] }}</p>
                        <p class="w-full mt-2">{{ $lang['16'] }} = {{ $detail['range'] }}</p>
                        <p class="w-full mt-2">{{ $lang['17'] }} = {{ $detail['n'] }}</p>
                        <p class="w-full mt-2">{{ $lang['21'] }} = {{ round($detail['variance'], 3) }}</p>
                        <p class="w-full mt-2">{{ $lang['23'] }} (s) = {{ round($detail['s_d1'], 3) }}</p>
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
