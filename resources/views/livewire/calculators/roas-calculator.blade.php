<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-12 mt-3 gap-4">
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="first" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Ad Spend' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="first" id="first" class="input"
                                aria-label="input" placeholder="90" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-6">
                        <label for="operations1" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Mode' }}:</label>
                        <div class="w-full py-2 relative">
                            <select class="input" wire:model.live="operations1" id="operations1">
                                <option value="1">{{ $lang[3] ?? 'Calculate ROAS' }}</option>
                                <option value="2">{{ $lang[4] ?? 'Revenue Target' }}</option>
                            </select>
                        </div>
                    </div>

                    @if ($operations1 == 1)
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="second" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Ad Revenue' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="second" id="second" class="input"
                                    aria-label="input" placeholder="90" />
                                <span class="text-blue input_unit">{{ $currancy }}</span>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="third" class="font-s-14 text-blue">{{ $lang[6] ?? 'Total Revenue' }}:</label>
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="third" id="third" class="input"
                                    aria-label="input" placeholder="90" />
                                <span class="text-blue input_unit">{{ $currancy }}</span>
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

        <hr>

        @if ($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex flex-col items-center justify-center">
                        <div class="w-full mt-3">
                            @if ($detail['operations1'] == 1)
                                <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto mt-2">
                                    <table class="w-full text-lg">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang[7] ?? 'ROAS' }} </strong></td>
                                            <td class="py-2 border-b whitespace-nowrap">{{ number_format($detail['answer1'], 2) }}%</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang[8] ?? 'Net Profit' }} </strong></td>
                                            <td class="py-2 border-b whitespace-nowrap">{{ $currancy }} {{ number_format($detail['answer2'], 2) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full my-4">
                                    <p class="p-4 bg-light-blue rounded-lg text-lg">{{ $detail['line'] }}</p>
                                </div>
                                <div wire:ignore class="w-full my-4">
                                    <div id="roasChart" style="height: 370px; width: 100%;"></div>
                                </div>
                            @elseif($detail['operations1'] == 2)
                                <div class="w-full md:w-[80%] lg:w-[80%] overflow-auto mt-2">
                                    <table class="w-full text-lg">
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['9'] ?? 'Ad Revenue Target' }} </strong></td>
                                            <td class="py-2 border-b whitespace-nowrap">{{ $currancy }} {{ number_format($detail['answer1'], 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b" width="70%"><strong>{{ $lang['10'] ?? 'Overall Revenue Target' }} </strong></td>
                                            <td class="py-2 border-b whitespace-nowrap">{{ number_format($detail['answer2'], 2) }}%</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="w-full my-4">
                                    <p class="p-4 bg-light-blue rounded-lg text-lg">{{ $detail['line'] }}</p>
                                </div>
                                <div wire:ignore class="w-full my-4">
                                    <div id="roasChartTarget" style="height: 370px; width: 100%;"></div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>

@push('calculatorJS')
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('calculator-calculated', (event) => {
            const data = event[0];
            setTimeout(() => {
                renderRoasChart(data);
            }, 200);
        });
    });

    function renderRoasChart(data) {
        if (typeof CanvasJS === 'undefined') {
            setTimeout(() => renderRoasChart(data), 200);
            return;
        }

        if (data.mode == "1") {
            const container = document.getElementById('roasChart');
            if (!container) return;

            const chart = new CanvasJS.Chart("roasChart", {
                animationEnabled: true,
                theme: "light2",
                title: { text: "ROAS Analysis" },
                data: [{
                    type: "column",
                    dataPoints: [
                        { y: parseFloat(data.first), label: "Ad Spend" },
                        { y: parseFloat(data.first * 8), label: "Ad Revenue Target" },
                        { y: parseFloat(data.second), label: "Ad Revenue" }
                    ]
                }]
            });
            chart.render();
        } else if (data.mode == "2") {
            const container = document.getElementById('roasChartTarget');
            if (!container) return;

            const chart = new CanvasJS.Chart("roasChartTarget", {
                animationEnabled: true,
                theme: "light2",
                title: { text: "Revenue Target" },
                data: [{
                    type: "column",
                    dataPoints: [
                        { y: parseFloat(data.first), label: "Ad Spend" },
                        { y: parseFloat(data.answer1), label: "Ad Revenue Target" }
                    ]
                }]
            });
            chart.render();
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        if (@json(isset($detail))) {
            setTimeout(() => {
                renderRoasChart({
                    mode: @json($detail['operations1'] ?? 1),
                    first: @json($detail['first'] ?? 0),
                    second: @json($detail['second'] ?? 0),
                    answer1: @json($detail['answer1'] ?? 0)
                });
            }, 500);
        }
    });

    window.onload = function() {
        if (@json(isset($detail))) {
            renderRoasChart({
                mode: @json($detail['operations1'] ?? 1),
                first: @json($detail['first'] ?? 0),
                second: @json($detail['second'] ?? 0),
                answer1: @json($detail['answer1'] ?? 0)
            });
        }
    };
</script>
@endpush
