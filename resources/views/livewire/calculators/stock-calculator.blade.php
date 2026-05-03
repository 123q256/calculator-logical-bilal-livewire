<div>
   
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <div class="space-y-2">
                        <label for="first" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Shares' }}:</label>
                        <input type="number" step="any" wire:model.live="first" id="first" class="input"
                            aria-label="input" placeholder="15" />
                    </div>

                    <div class="space-y-2 relative">
                        <label for="second" class="font-s-14 text-blue">{{ $lang['2'] ?? 'Buy Price' }}:</label>
                        <input type="number" step="any" wire:model.live="second" id="second" class="input"
                            aria-label="input" placeholder="500" />
                        <span class="input_unit">{{ $currancy }}</span>
                    </div>

                    <div class="space-y-2">
                        <label for="third" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Buy Commission' }}:</label>
                        <div class="relative w-full">
                            <input type="number" wire:model.live="third" id="third" step="any" class="input pr-16"
                                aria-label="input" placeholder="5" />
                            
                            <div class="absolute right-3 bottom-2 flex flex-col items-end">
                                <label for="t_unit" class="cursor-pointer text-sm underline text-black font-semibold"
                                    wire:click="toggleDropdown('t_unit')">
                                    {{ $t_unit }} ▾
                                </label>

                                @if ($openDropdown === 't_unit')
                                    <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md shadow-lg bottom-full mb-1 right-0 min-w-[60px]">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-center border-b" wire:click="setUnit('t_unit', '%')">%</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-center" wire:click="setUnit('t_unit', '{{ $currancy ?: 'PKRs' }}')">{{ $currancy ?: 'PKRs' }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2 relative">
                        <label for="four" class="font-s-14 text-blue">{{ $lang['4'] ?? 'Sell Price' }}:</label>
                        <input type="number" step="any" wire:model.live="four" id="four" class="input"
                            aria-label="input" placeholder="500" />
                        <span class="input_unit">{{ $currancy }}</span>
                    </div>

                    <div class="space-y-2">
                        <label for="five" class="font-s-14 text-blue">{{ $lang['3'] ?? 'Sell Commission' }}:</label>
                        <div class="relative w-full">
                            <input type="number" wire:model.live="five" id="five" step="any" class="input pr-16"
                                aria-label="input" placeholder="5" />
                            
                            <div class="absolute right-3 bottom-2 flex flex-col items-end">
                                <label for="f_unit" class="cursor-pointer text-sm underline text-black font-semibold"
                                    wire:click="toggleDropdown('f_unit')">
                                    {{ $f_unit }} ▾
                                </label>

                                @if ($openDropdown === 'f_unit')
                                    <div class="absolute z-10 p-1 bg-white border border-gray-300 rounded-md shadow-lg bottom-full mb-1 right-0 min-w-[60px]">
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-center border-b" wire:click="setUnit('f_unit', '%')">%</p>
                                        <p class="p-2 hover:bg-gray-100 cursor-pointer text-center" wire:click="setUnit('f_unit', '{{ $currancy ?: 'PKRs' }}')">{{ $currancy ?: 'PKRs' }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="cgt" class="font-s-14 text-blue">{{ $lang['11'] ?? 'CGT Rate (%)' }}:</label>
                        <input type="number" step="any" wire:model.live="cgt" id="cgt" class="input"
                            aria-label="input" placeholder="6" />
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

        @if ($detail)
            <div id="result-section" wire:loading.remove wire:target="calculate"
                class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg">
                        <div class="w-full md:w-[80%] lg:w-[80%] mt-2 overflow-auto">
                            <table class="w-full text-lg">
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang[3] ?? 'Buy Commission' }} </strong></td>
                                    <td class="py-2 border-b whitespace-nowrap">{{ $currancy }} {{ number_format($detail['b_c'], 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang[6] ?? 'Net Buy Price' }} </strong></td>
                                    <td class="py-2 border-b whitespace-nowrap">{{ $currancy }} {{ number_format($detail['netby_ans'], 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang[5] ?? 'Sell Commission' }} </strong></td>
                                    <td class="py-2 border-b whitespace-nowrap">{{ $currancy }} {{ number_format($detail['s_c'], 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang[7] ?? 'Net Sell Price' }} </strong></td>
                                    <td class="py-2 border-b whitespace-nowrap">{{ $currancy }} {{ number_format($detail['netsa_ans'], 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang[8] ?? 'Profit/Loss' }} </strong></td>
                                    <td class="py-2 border-b whitespace-nowrap">{{ $currancy }} {{ number_format($detail['profit'], 2) }}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang[9] ?? 'ROI' }} </strong></td>
                                    <td class="py-2 border-b whitespace-nowrap">{{ number_format($detail['roi_ans'], 2) }}%</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang[10] ?? 'Break Even Price' }} </strong></td>
                                    <td class="py-2 border-b whitespace-nowrap">{{ $currancy }} {{ number_format($detail['break_ans'], 2) }}</td>
                                </tr>
                            </table>
                        </div>

                        <!-- Chart Section -->
                        <div class="w-full mt-8">
                            <div wire:ignore>
                                <div id="stockChart" style="height: 300px; width: 100%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('calculator-calculated', (event) => {
            // event is an array, first element is our data object
            const data = event[0];
            setTimeout(() => {
                renderStockChart(data.netBuy, data.netSell);
            }, 200);
        });
    });

    function renderStockChart(netBuy, netSell) {
        if (typeof CanvasJS === 'undefined') {
            setTimeout(() => renderStockChart(netBuy, netSell), 200);
            return;
        }

        const container = document.getElementById('stockChart');
        if (!container) return;

        // If no values provided (initial load), try to get them from PHP or use 0
        if (netBuy === undefined || netSell === undefined) {
            netBuy = @json($detail['netby_ans'] ?? 0);
            netSell = @json($detail['netsa_ans'] ?? 0);
            
            // Clean initial load strings aggressively (remove everything except digits, dots, and minus)
            if (typeof netBuy === 'string') netBuy = netBuy.replace(/[^0-9.-]/g, '');
            if (typeof netSell === 'string') netSell = netSell.replace(/[^0-9.-]/g, '');
        }

        const chart = new CanvasJS.Chart("stockChart", {
            animationEnabled: true,
            title: {
                text: "Stock Calculator"
            },
            axisX: {
                interval: 1
            },
            axisY2: {
                interlacedColor: "#2845F5",
                gridColor: "rgb(39 52 131)",
                includeZero: true
            },
            data: [{
                type: "bar",
                name: "companies",
                axisYType: "secondary",
                color: "#014D65",
                dataPoints: [
                    { y: parseFloat(netBuy), label: "Net Buy Price" },
                    { y: parseFloat(netSell), label: "Net Sell Price" }
                ]
            }]
        });
        chart.render();
    }

    document.addEventListener('DOMContentLoaded', () => {
        if (@json(isset($detail))) {
            setTimeout(() => renderStockChart(), 500);
        }
    });
</script>
@push('calculatorJS')
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    @endpush