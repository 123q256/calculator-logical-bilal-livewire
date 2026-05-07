<div>
    <style>
        .input_unit {
            top: 21px !important
        }
        input:disabled, select:disabled {
            background-color: #f3f4f6;
            cursor: not-allowed;
        }
    </style>

    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif

            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12"><b class="label">How often are you paid?</b></p>
                    <div class="col-span-6">
                        <label for="paytype" class="label">{{ $lang['1'] ?? 'Pay Frequency' }}:</label>
                        <div class="w-full py-2">
                            <select wire:model.live="paytype" id="paytype" class="input">
                                <option value="52">Weekly</option>
                                <option value="26">Bi-Weekly</option>
                                <option value="12">Monthly</option>
                                <option value="24">Semi-Monthly</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-6">
                        <label for="status" class="label">Your Filing Status?</label>
                        <div class="w-full py-2">
                            <select wire:model.live="status" id="status" class="input">
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="head_of_household">Head of the House</option>
                            </select>
                        </div>
                    </div>

                    <p class="col-span-12"><b class="label">How are you paid?</b></p>
                    
                    {{-- Paid Rows --}}
                    @foreach($paidRows as $index => $row)
                        <div class="col-span-12 grid grid-cols-12 gap-2 md:gap-4 items-end border-b pb-4 mb-2">
                            <div class="col-span-4">
                                <p class="label">Type:</p>
                                <div class="w-full py-2">
                                    <select wire:model.live="paidRows.{{ $index }}.type" class="input">
                                        <option value="hourly">Hourly</option>
                                        <option value="salary">Salary</option>
                                    </select>
                                </div>
                            </div>

                            @if($paidRows[$index]['type'] === 'salary')
                                <div class="col-span-4">
                                    <p class="label">Gross Pay Method:</p>
                                    <div class="w-full py-2">
                                        <select wire:model.live="paidRows.{{ $index }}.grosspay" class="input">
                                            <option value="per_year">Per Year</option>
                                            <option value="pay_period">Pay Per Period</option>
                                        </select>
                                    </div>
                                </div>
                            @else
                                <div class="col-span-4">
                                    <p class="label">{{ $lang['3'] ?? 'Hours' }}:</p>
                                    <div class="w-full py-2 position-relative">
                                        <input type="number" step="any" wire:model.live="paidRows.{{ $index }}.working" class="input" />
                                        <span class="text-blue input_unit">Hrs</span>
                                    </div>
                                </div>
                            @endif

                            <div class="col-span-3">
                                <p class="label">{{ $lang['2'] ?? 'Rate/Amount' }}:</p>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" wire:model.live="paidRows.{{ $index }}.wage" class="input" />
                                    <span class="text-blue input_unit">{{ $currancy }}</span>
                                </div>
                            </div>

                            <div class="col-span-1 flex items-center justify-center pb-3">
                                @if(count($paidRows) > 1)
                                    <img src="{{ asset('images/delete.png') }}" 
                                         style="filter: invert(28%) sepia(100%) saturate(7432%) hue-rotate(354deg) brightness(91%) contrast(100%);"
                                         class="cursor-pointer" 
                                         wire:click="removePaidRow({{ $index }})" 
                                         width="20" alt="Delete">
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="col-span-12 flex px-2 items-center mt-2">
                        <img src="{{ asset('images/hourly_add.png') }}" height="15px" width="15px">
                        <p class="label ms-1 text-blue-500 cursor-pointer" wire:click="addPaidRow">Add Another</p>
                    </div>

                    <p class="col-span-12 mt-4"><b class="label">Any overtime?</b></p>

                    {{-- Overtime Rows --}}
                    @foreach($overtimeRows as $index => $row)
                        <div class="col-span-12 grid grid-cols-12 gap-2 md:gap-4 items-end border-b pb-4 mb-2">
                            <div class="col-span-4">
                                <p class="label">Type:</p>
                                <div class="w-full py-2">
                                    <select wire:model.live="overtimeRows.{{ $index }}.type" class="input">
                                        <option value="overtime">Overtime</option>
                                        <option value="doubletime">Double Time</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-4">
                                <p class="label">{{ $lang['3'] ?? 'Hours' }}:</p>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" wire:model.live="overtimeRows.{{ $index }}.hours" class="input" placeholder="0" />
                                    <span class="text-blue input_unit">Hrs</span>
                                </div>
                            </div>
                            <div class="col-span-3">
                                <p class="label">{{ $lang['2'] ?? 'Rate' }}:</p>
                                <div class="w-full py-2 position-relative">
                                    <input type="number" step="any" wire:model.live="overtimeRows.{{ $index }}.wage" class="input" placeholder="0" />
                                    <span class="text-blue input_unit">{{ $currancy }}</span>
                                </div>
                            </div>
                            <div class="col-span-1 flex items-center justify-center pb-3">
                                @if(count($overtimeRows) > 1)
                                    <img src="{{ asset('images/delete.png') }}" 
                                         style="filter: invert(28%) sepia(100%) saturate(7432%) hue-rotate(354deg) brightness(91%) contrast(100%);"
                                         class="cursor-pointer" 
                                         wire:click="removeOvertimeRow({{ $index }})" 
                                         width="20" alt="Delete">
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="col-span-12 flex px-2 items-center mt-2">
                        <img src="{{ asset('images/hourly_add.png') }}" height="15px" width="15px">
                        <p class="label ms-1 text-blue-500 cursor-pointer" wire:click="addOvertimeRow">Add Another</p>
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
    </form>

    @isset($detail)
        <hr>
        <div id="result-section" wire:key="result-{{ $result_key }}" wire:loading.remove class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-8 space-y-6">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            
            <div class="text-center">
                <p class="font-s-20"><strong>Take Home Salary</strong></p>
                <div class="flex justify-center">
                    <p class="text-[32px] bg-[#2845F5] text-white px-6 py-2 rounded-lg d-inline-block my-3">
                        <strong>{{ $currancy }} {{ $detail['take_home'] }}</strong>
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                <div class="w-full overflow-auto">
                    <table class="w-full text-left">
                        <tr>
                            <td class="border-b py-2 text-[18px]"><b>Earnings</b></td>
                            <td class="border-b py-2 text-[18px] text-right"><b>{{ $currancy }} {{ $detail['total_weekly_salary'] }}</b></td>
                        </tr>
                        @foreach ($detail['salaries'] as $i => $sal)
                            <tr>
                                <td class="border-b py-3 text-gray-600">
                                    @if($paidRows[$i]['type'] === 'hourly')
                                        Hourly <span class='text-xs'>({{ $paidRows[$i]['working'] }} hrs × {{ $currancy }}{{ $paidRows[$i]['wage'] }})</span>
                                    @else
                                        Salary <span class='text-xs'>({{ $paidRows[$i]['grosspay'] === 'per_year' ? 'Per Year' : 'Pay Per Period' }})</span>
                                    @endif
                                </td>
                                <td class="border-b py-3 text-right">{{ $currancy }} {{ number_format($sal, 2) }}</td>
                            </tr>
                        @endforeach
                        
                        @isset($detail['overtimes'])
                            @foreach ($detail['overtimes'] as $i => $ot)
                                <tr>
                                    <td class="border-b py-3 text-gray-600">
                                        @if($overtimeRows[$i]['type'] === 'overtime')
                                            Overtime <span class='text-xs'>(1.5 × {{ $overtimeRows[$i]['hours'] }} hrs × {{ $currancy }}{{ $overtimeRows[$i]['wage'] }})</span>
                                        @else
                                            Double Time <span class='text-xs'>(2 × {{ $overtimeRows[$i]['hours'] }} hrs × {{ $currancy }}{{ $overtimeRows[$i]['wage'] }})</span>
                                        @endif
                                    </td>
                                    <td class="border-b py-3 text-right">{{ $currancy }} {{ number_format($ot, 2) }}</td>
                                </tr>
                            @endforeach
                        @endisset

                        <tr>
                            <td class="border-b py-3 text-[18px]"><b>Taxes</b></td>
                            <td class="border-b py-3 text-[18px] text-right"><b>{{ $currancy }} {{ $detail['total_tax'] }}</b></td>
                        </tr>
                        <tr>
                            <td class="border-b py-2 text-gray-600">Federal Income Tax</td>
                            <td class="border-b py-2 text-right">{{ $currancy }} {{ $detail['federalTax'] }}</td>
                        </tr>
                        <tr>
                            <td class="border-b py-2 text-gray-600">Medicare Tax</td>
                            <td class="border-b py-2 text-right">{{ $currancy }} {{ $detail['medicareTax'] }}</td>
                        </tr>
                        <tr>
                            <td class="border-b py-2 text-gray-600">Social Security Tax</td>
                            <td class="border-b py-2 text-right">{{ $currancy }} {{ $detail['socialSecurityTax'] }}</td>
                        </tr>
                        <tr>
                            <td class="border-b py-3 text-[18px]"><b>Take Home</b></td>
                            <td class="border-b py-3 text-[18px] text-right"><b>{{ $currancy }} {{ $detail['take_home'] }}</b></td>
                        </tr>
                    </table>
                </div>

            </div>
            {{-- Highcharts Doughnut Chart --}}
            {{-- Highcharts Doughnut Chart (Matching Semester Grade Pattern) --}}
            <div class="w-full mt-8" 
                 x-data="{ 
                    chartData: @js($detail['chartData'] ?? []),
                    render() {
                        if (typeof Highcharts === 'undefined') {
                            setTimeout(() => this.render(), 200);
                            return;
                        }
                        Highcharts.chart($refs.canvas, {
                            chart: { type: 'pie', backgroundColor: 'transparent' },
                            title: { text: 'Take Home vs Taxes', align: 'left', style: { color: '#2845F5', fontWeight: 'bold' } },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.name}: {point.y}'
                                    },
                                    showInLegend: true
                                }
                            },
                            series: [{ 
                                name: 'Amount', 
                                data: this.chartData,
                                innerSize: '60%'
                            }],
                            credits: { enabled: false },
                            tooltip: { pointFormat: '{series.name}: <b>{point.y}</b>' }
                        });
                    }
                 }" 
                 x-init="render()"
                 @hourly-chart-updated.window="chartData = $event.detail; render()"
                 wire:ignore>
                <div x-ref="canvas" class="w-full min-h-[400px]"></div>
            </div>
        </div>
    @endisset
</div>
@push('calculatorJS')
    <script src="https://code.highcharts.com/highcharts.js"></script>
@endpush
