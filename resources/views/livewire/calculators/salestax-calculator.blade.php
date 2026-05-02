<div>
    <style>
        .circle-color:before {
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
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2 relative">
                        <label for="amount" class="font-s-14 text-blue">{{ $lang['amount'] ?? 'Amount' }}:</label>
                        <input type="number" step="any" wire:model.live="amount" id="amount" class="input" aria-label="input" placeholder="00" />
                        <span class="input_unit">{{ $currancy }}</span>
                    </div>
                    <div class="space-y-2">
                        <label for="method" class="font-s-14 text-blue">&nbsp;</label>
                        <select wire:model.live="method" id="method" class="input">
                            <option value="add">{{ $lang['add'] ?? 'Add' }}</option>
                            <option value="not">{{ $lang['not'] ?? 'Remove' }}</option>
                        </select>
                    </div>
                    <div class="space-y-2 relative">
                        <label for="vat" class="font-s-14 text-blue">{{ $lang['sale_tax'] ?? 'Sales Tax' }}:</label>
                        <input type="number" step="any" wire:model.live="vat" id="vat" class="input" aria-label="input" placeholder="00" />
                        <span class="input_unit">%</span>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full bg-light-blue rounded-lg mt-6">
                            <div class="lg:flex">
                                <div class="lg:w-1/2 w-full px-2 mt-4">
                                    <table class="w-full text-lg">
                                        <tr>
                                            <td class="py-2 border-b w-7/10 font-bold">{{ $lang['your_sale'] ?? 'Your Sales Tax' }}</td>
                                            <td class="py-2 border-b">{{ $currancy }} {{ $detail['vatAmount'] ?? '0.00' }}</td>
                                        </tr>
                                    </table>
                                    <table class="w-full text-lg mt-4">
                                        <tr>
                                            <td class="py-2 border-b w-7/10 font-bold">Sale Tax Detail</td>
                                            <td class="py-2 border-b w-7/10"></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b w-7/10 font-bold">{{ $lang['net_price'] ?? 'Net Price' }}</td>
                                            <td class="py-2 border-b">{{ $currancy }}
                                                @if($method == 'add')
                                                    {{ $amount }}
                                                @else
                                                    {{ $detail['netBill'] ?? '0.00' }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b w-7/10 font-bold">{{ $lang['sale_tax'] ?? 'Sales Tax' }}</td>
                                            <td class="py-2 border-b">{{ $currancy }} {{ $detail['vatAmount'] ?? '0.00' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b w-7/10 font-bold">{{ $lang['sale_tax'] ?? 'Sales Tax' }} (%)</td>
                                            <td class="py-2 border-b">{{ $vat }}%</td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b w-7/10 font-bold">{{ $lang['gross_price'] ?? 'Gross Price' }}</td>
                                            <td class="py-2 border-b">{{ $currancy }}
                                                @if($method == 'not')
                                                    {{ $amount }}
                                                @else
                                                    {{ $detail['netBill'] ?? '0.00' }}
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                
                                {{-- Reactive Chart Section --}}
                                <div class="lg:w-1/2 w-full mt-4 overflow-auto" 
                                     x-data="{ 
                                        chartData: {{ $detail['chartData'] }},
                                        render() {
                                            if (typeof google === 'undefined' || typeof google.visualization === 'undefined') {
                                                setTimeout(() => this.render(), 200);
                                                return;
                                            }
                                            const data = google.visualization.arrayToDataTable([
                                                ['Task', 'Amount'],
                                                ...this.chartData
                                            ]);
                                            const options = {
                                                colors: ['#99EA48', '#FF6D00'],
                                                slices: { 1: {offset: 0.09} },
                                                legend: 'none',
                                                backgroundColor: 'transparent'
                                            };
                                            const chart = new google.visualization.PieChart(this.$refs.canvas);
                                            chart.draw(data, options);
                                        }
                                     }" 
                                     x-init="google.charts.load('current', {'packages':['corechart']}); google.charts.setOnLoadCallback(() => render())"
                                     @chart-updated.window="chartData = $event.detail; render()"
                                     wire:ignore>
                                    <div x-ref="canvas" class="h-[300px]"></div>
                                    <div class="mt-4">
                                        <table class="w-full">
                                            <tr class="border-b">
                                                <td class="text-[#99EA48] px-4 py-2 circle-color"><span>Net Price</span></td>
                                                <td class="text-[#FF6D00] px-4 py-2 circle-color"><span>Sale Tax</span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>

@push('calculatorJS')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endpush
