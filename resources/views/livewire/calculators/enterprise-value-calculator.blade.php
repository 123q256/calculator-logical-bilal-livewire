<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-3">
                    <div class="space-y-2">
                        <label for="cs" class="label font-s-14 text-blue">{{ $lang['cs'] ?? 'Common Stock' }}</label>
                        <div class="relative py-1">
                            <input type="number" step="any" wire:model.live="cs" id="cs" class="input" placeholder="10">
                            <span class="input_unit text-blue absolute right-4 top-1/2 -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="ps" class="label font-s-14 text-blue">{{ $lang['ps'] ?? 'Preferred Stock' }}</label>
                        <div class="relative py-1">
                            <input type="number" step="any" wire:model.live="ps" id="ps" class="input" placeholder="15">
                            <span class="input_unit text-blue absolute right-4 top-1/2 -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="mvd" class="label font-s-14 text-blue">{{ $lang['mvd'] ?? 'Market Value of Debt' }}</label>
                        <div class="relative py-1">
                            <input type="number" step="any" wire:model.live="mvd" id="mvd" class="input" placeholder="25">
                            <span class="input_unit text-blue absolute right-4 top-1/2 -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="mi" class="label font-s-14 text-blue">{{ $lang['mi'] ?? 'Minority Interest' }}</label>
                        <div class="relative py-1">
                            <input type="number" step="any" wire:model.live="mi" id="mi" class="input" placeholder="30">
                            <span class="input_unit text-blue absolute right-4 top-1/2 -translate-y-1/2 font-semibold">{{ $currancy }}</span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="ce" class="label font-s-14 text-blue">{{ $lang['ce'] ?? 'Cash and Equivalents' }}</label>
                        <div class="relative py-1">
                            <input type="number" step="any" wire:model.live="ce" id="ce" class="input" placeholder="35">
                            <span class="input_unit text-blue absolute right-4 top-1/2 -translate-y-1/2 font-semibold">{{ $currancy }}</span>
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

        <hr>

        @isset($detail)
            {{-- result --}}
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex flex-col items-center justify-center space-y-8">
                        <div class="w-full mt-3">
                            <div class="w-full text-[25px] text-center my-3">
                                <p class="text-blue font-semibold">{{ $lang['ev'] ?? 'Enterprise Value' }}</p>
                                <p class="my-3">
                                    <strong class="bg-[#2845F5] px-6 py-3 text-[30px] rounded-lg text-white shadow-lg inline-block">
                                        {{ $currancy }} {{ $detail['ev'] ?? '0.0' }}
                                    </strong>
                                </p>
                            </div>
                        </div>

                        {{-- Highcharts using Alpine.js for reactivity --}}
                        <div class="w-full md:w-[80%] lg:w-[70%] mx-auto bg-white p-4 rounded-xl shadow-sm" 
                             x-data="{ 
                                render() {
                                    if (typeof Highcharts === 'undefined') {
                                        setTimeout(() => this.render(), 200);
                                        return;
                                    }
                                    Highcharts.chart($refs.canvas, {
                                        chart: { type: 'bar', backgroundColor: 'transparent' },
                                        title: { text: null },
                                        xAxis: { categories: ['MC', 'PS', 'MVD', 'MI', 'CCE'], labels: { style: { color: '#2845F5', fontWeight: 'bold' } } },
                                        yAxis: { title: { text: null }, labels: { style: { color: '#2845F5' } } },
                                        tooltip: { pointFormat: '{point.y} {{ $currancy }}', shared: true },
                                        legend: { enabled: false },
                                        series: [{ 
                                            data: {{ json_encode([(float)$cs, (float)$ps, (float)$mvd, (float)$mi, (float)$ce]) }}, 
                                            color: '#2845F5' 
                                        }]
                                    });
                                }
                             }" 
                             x-init="$nextTick(() => render())">
                            <div x-ref="canvas" style="width:100%; height:300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
@push('calculatorJS')
<script src="https://code.highcharts.com/highcharts.js"></script>
@endpush
