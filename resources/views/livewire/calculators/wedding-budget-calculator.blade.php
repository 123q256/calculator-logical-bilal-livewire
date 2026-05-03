<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[80%] md:w-[90%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-6">
                    <!-- Main Budget Info -->
                    <div class="col-span-12 md:col-span-6">
                        <label for="spend" class="font-bold text-xs mb-1 block">{{ $lang['1'] ?? 'Total Budget' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="spend" id="spend" class="input" placeholder="5,000,000" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6">
                        <label for="guest" class="font-bold text-xs mb-1 block">{{ $lang['2'] ?? 'Total Guests' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="guest" id="guest" class="input" placeholder="500" min="0" />
                        </div>
                    </div>

                    <div class="col-span-12 border-b pb-2 mb-2">
                        <h3 class="font-bold text-gray-800 text-sm tracking-widest">{{ $lang['3'] ?? 'Bride & Groom Clothing' }}</h3>
                    </div>

                    <div class="col-span-12 md:col-span-6 lg:col-span-4">
                        <label for="dress" class="font-bold text-xs mb-1 block">{{ $lang['4'] ?? 'Wedding Dress' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="dress" id="dress" class="input" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-4">
                        <label for="jewelery" class="font-bold text-xs mb-1 block">{{ $lang['5'] ?? 'Jewelry' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="jewelery" id="jewelery" class="input" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-4">
                        <label for="accessories" class="font-bold text-xs mb-1 block">{{ $lang['6'] ?? 'Accessories' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="accessories" id="accessories" class="input" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-4">
                        <label for="ring" class="font-bold text-xs mb-1 block">{{ $lang['7'] ?? 'Wedding Rings' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="ring" id="ring" class="input" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-4">
                        <label for="makeup" class="font-bold text-xs mb-1 block">{{ $lang['8'] ?? 'Makeup & Hair' }}:</label>
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="makeup" id="makeup" class="input" />
                            <span class="text-blue input_unit">{{ $currancy }}</span>
                        </div>
                    </div>

                    <!-- Collapsible Sections -->
                    <div class="col-span-12 space-y-4 mt-6">
                        <!-- Category 1 -->
                        <div class="border rounded-xl overflow-hidden bg-white">
                            <button type="button" wire:click="toggleDetail(1)" class="w-full flex items-center justify-between p-4 bg-gray-50">
                                <span class="font-bold text-sm text-gray-700">{{ $lang['9'] ?? 'Sub-contractors' }}</span>
                                <span class="transition-transform duration-300 {{ $clickvalue1 ? 'rotate-180' : '' }}">▼</span>
                            </button>
                            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 {{ $clickvalue1 ? '' : 'hidden' }}">
                                <div>
                                    <label class="font-bold text-xs mb-1 block">{{ $lang['10'] ?? 'Stationery' }}:</label>
                                    <div class="relative py-2">
                                        <input type="number" wire:model.live="stationery" class="input" />
                                        <span class="text-blue input_unit">{{ $currancy }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="font-bold text-xs mb-1 block">{{ $lang['11'] ?? 'Photography' }}:</label>
                                    <div class="relative py-2">
                                        <input type="number" wire:model.live="photography" class="input" />
                                        <span class="text-blue input_unit">{{ $currancy }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="font-bold text-xs mb-1 block">{{ $lang['12'] ?? 'Florist' }}:</label>
                                    <div class="relative py-2">
                                        <input type="number" wire:model.live="florist" class="input" />
                                        <span class="text-blue input_unit">{{ $currancy }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="font-bold text-xs mb-1 block">{{ $lang['13'] ?? 'Wedding Planner' }}:</label>
                                    <div class="relative py-2">
                                        <input type="number" wire:model.live="planner" class="input" />
                                        <span class="text-blue input_unit">{{ $currancy }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Category 2 -->
                        <div class="border rounded-xl overflow-hidden bg-white">
                            <button type="button" wire:click="toggleDetail(2)" class="w-full flex items-center justify-between p-4 bg-gray-50">
                                <span class="font-bold text-sm text-gray-700">{{ $lang['14'] ?? 'Food & Drinks' }}</span>
                                <span class="transition-transform duration-300 {{ $clickvalue2 ? 'rotate-180' : '' }}">▼</span>
                            </button>
                            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 {{ $clickvalue2 ? '' : 'hidden' }}">
                                <div>
                                    <label class="font-bold text-xs mb-1 block">{{ $lang['15'] ?? 'Venue' }}:</label>
                                    <div class="relative py-2">
                                        <input type="number" wire:model.live="venue" class="input" />
                                        <span class="text-blue input_unit">{{ $currancy }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="font-bold text-xs mb-1 block">{{ $lang['16'] ?? 'Rehearsal Dinner' }}:</label>
                                    <div class="relative py-2">
                                        <input type="number" wire:model.live="dinner" class="input" />
                                        <span class="text-blue input_unit">{{ $currancy }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="font-bold text-xs mb-1 block">{{ $lang['17'] ?? 'Catering' }}:</label>
                                    <div class="relative py-2">
                                        <input type="number" wire:model.live="catering" class="input" />
                                        <span class="text-blue input_unit">{{ $currancy }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="font-bold text-xs mb-1 block">{{ $lang['18'] ?? 'Wedding Cake' }}:</label>
                                    <div class="relative py-2">
                                        <input type="number" wire:model.live="cake" class="input" />
                                        <span class="text-blue input_unit">{{ $currancy }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="font-bold text-xs mb-1 block">{{ $lang['19'] ?? 'DJ/Music' }}:</label>
                                    <div class="relative py-2">
                                        <input type="number" wire:model.live="DJs" class="input" />
                                        <span class="text-blue input_unit">{{ $currancy }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="font-bold text-xs mb-1 block">{{ $lang['20'] ?? 'Liquors' }}:</label>
                                    <div class="relative py-2">
                                        <input type="number" wire:model.live="liquors" class="input" />
                                        <span class="text-blue input_unit">{{ $currancy }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Category 3 -->
                        <div class="border rounded-xl overflow-hidden bg-white">
                            <button type="button" wire:click="toggleDetail(3)" class="w-full flex items-center justify-between p-4 bg-gray-50">
                                <span class="font-bold text-sm text-gray-700">{{ $lang['21'] ?? 'Ceremony' }}</span>
                                <span class="transition-transform duration-300 {{ $clickvalue3 ? 'rotate-180' : '' }}">▼</span>
                            </button>
                            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 {{ $clickvalue3 ? '' : 'hidden' }}">
                                <div>
                                    <label class="font-bold text-xs mb-1 block">{{ $lang['22'] ?? 'Ceremony Venue' }}:</label>
                                    <div class="relative py-2">
                                        <input type="number" wire:model.live="ceremony" class="input" />
                                        <span class="text-blue input_unit">{{ $currancy }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="font-bold text-xs mb-1 block">{{ $lang['23'] ?? 'Officiant' }}:</label>
                                    <div class="relative py-2">
                                        <input type="number" wire:model.live="officiant" class="input" />
                                        <span class="text-blue input_unit">{{ $currancy }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Category 4 -->
                        <div class="border rounded-xl overflow-hidden bg-white">
                            <button type="button" wire:click="toggleDetail(4)" class="w-full flex items-center justify-between p-4 bg-gray-50">
                                <span class="font-bold text-sm text-gray-700">{{ $lang['24'] ?? 'Transportation & Accommodation' }}</span>
                                <span class="transition-transform duration-300 {{ $clickvalue4 ? 'rotate-180' : '' }}">▼</span>
                            </button>
                            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 {{ $clickvalue4 ? '' : 'hidden' }}">
                                <div>
                                    <label class="font-bold text-xs mb-1 block">{{ $lang['25'] ?? 'Hotel' }}:</label>
                                    <div class="relative py-2">
                                        <input type="number" wire:model.live="hotel" class="input" />
                                        <span class="text-blue input_unit">{{ $currancy }}</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="font-bold text-xs mb-1 block">{{ $lang['26'] ?? 'Transportation' }}:</label>
                                    <div class="relative py-2">
                                        <input type="number" wire:model.live="transportation" class="input" />
                                        <span class="text-blue input_unit">{{ $currancy }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Category 5 -->
                        <div class="border rounded-xl overflow-hidden bg-white">
                            <button type="button" wire:click="toggleDetail(5)" class="w-full flex items-center justify-between p-4 bg-gray-50">
                                <span class="font-bold text-sm text-gray-700">{{ $lang['27'] ?? 'Other Expenses' }}</span>
                                <span class="transition-transform duration-300 {{ $clickvalue5 ? 'rotate-180' : '' }}">▼</span>
                            </button>
                            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 {{ $clickvalue5 ? '' : 'hidden' }}">
                                <div class="col-span-full">
                                    <label class="font-bold text-xs mb-1 block">{{ $lang['28'] ?? 'Other' }}:</label>
                                    <div class="relative py-2">
                                        <input type="number" wire:model.live="other" class="input" />
                                        <span class="text-blue input_unit">{{ $currancy }}</span>
                                    </div>
                                </div>
                            </div>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
               <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                        <div class="w-full lg:w-[80%] overflow-auto mt-2">
                        <table class="w-full text-[18px]">
                            <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['29'] }} </strong></td>
                                <td class="py-2 border-b">{{ $currancy}} {{round($detail['average_cost'],2)}}</td>
                            </tr>
                                <tr>
                                <td class="py-2 border-b" width="70%"><strong>{{ $lang['30'] }} </strong></td>
                                <td class="py-2 border-b">{{ $currancy}} {{round($detail['budget_balance'],0)}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="w-full text-[16px]">
                            <div class="my-3">
                                @if($detail['budget_balance'] == '0')
                                <p style="color:green"> {{$lang['31']}}</p>
                                @elseif($detail['budget_balance'] > '0')
                                <p style="color:green"> {{$lang['32']}}</p>
                                @elseif($detail['budget_balance'] < '0')
                                <p style="color:red"> {{$lang['33']}}</p>
                                @endif
                            </div>
                            <div class="mt-8" 
                                 x-data='{ 
                                    chartData: {!! $detail["chartData"] !!},
                                    render() {
                                        if (typeof Highcharts === "undefined") {
                                            setTimeout(() => this.render(), 200);
                                            return;
                                        }
                                        Highcharts.chart($refs.canvas, {
                                            chart: { type: "pie", backgroundColor: "transparent" },
                                            title: { text: "{{ $lang["34"] ?? "Budget Breakdown" }}", align: "center", style: { color: "#333", fontWeight: "bold" } },
                                            tooltip: { 
                                                pointFormat: "<b>{point.percentage:.1f}%</b><br>{point.y:,.2f}" 
                                            },
                                            plotOptions: {
                                                pie: {
                                                    allowPointSelect: true,
                                                    cursor: "pointer",
                                                    dataLabels: { 
                                                        enabled: true, 
                                                        format: "<b>{point.name}</b>: {point.percentage:.1f} %",
                                                        style: { fontSize: "11px" }
                                                    },
                                                    showInLegend: true
                                                }
                                            },
                                            series: [{ 
                                                name: "Budget", 
                                                colorByPoint: true, 
                                                data: this.chartData 
                                            }],
                                            credits: { enabled: false }
                                        });
                                    }
                                 }' 
                                 x-init="render()"
                                 @chart-updated.window="chartData = JSON.parse($event.detail); render()"
                                 wire:ignore>
                                <div x-ref="canvas" class="w-full min-h-[350px]"></div>
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
    <script src="https://code.highcharts.com/highcharts.js"></script>
@endpush