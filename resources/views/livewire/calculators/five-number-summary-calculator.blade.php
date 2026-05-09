<div>
<style>
    [x-cloak] { display: none !important; }
</style>

<form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1   mt-3  gap-4">
                <div class="col-span-12">
                    <label for="seprateby" class="font-s-14 text-blue">{{ $lang['1'] ?? 'Separate By' }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="seprateby" class="input cursor-pointer" id="seprateby">
                                <option value="space">{{ $lang['2'] ?? 'Space' }}</option>
                                <option value=",">{{ $lang['3'] ?? 'Comma' }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="textarea" class="font-s-14 text-blue">{{ $lang['5'] ?? 'Data Set' }}:</label>
                    <div class="w-100 py-2">
                        <textarea wire:model.live="textarea" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 12 32 12 33 4 21"></textarea>
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full ">
                        @php
                            $min = $detail['min'];
                            $q1 = $detail['first'];
                            $q2 = $detail['second'];
                            $q3 = $detail['third'];
                            $max = $detail['max'];
                        @endphp
                        <div class="flex lg:w-1/2 md:w-1/2 justify-center overflow-auto mt-2 px-2 py-1 bg-white border">
                            <table class="w-full font-s-18">
                                <tr>
                                    <td class="py-2 border-b" colspan="2"><b>{{ $lang['6'] ?? '5 Number Summary' }}</b></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['7'] ?? 'Minimum' }}:</td>
                                    <td class="py-2 border-b"><strong>{{ $min }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['8'] ?? 'Quartile' }} Q1:</td>
                                    <td class="py-2 border-b"><strong>{{ $q1 }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['8'] ?? 'Quartile' }} Q2 ({{ $lang['9'] ?? 'Median' }}):</td>
                                    <td class="py-2 border-b"><strong>{{ $q2 }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['8'] ?? 'Quartile' }} Q3:</td>
                                    <td class="py-2 border-b"><strong>{{ $q3 }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-blue py-2 border-b">{{ $lang['10'] ?? 'Maximum' }}:</td>
                                    <td class="py-2 border-b"><strong>{{ $max }}</strong></td>
                                </tr>
                            </table>
                        </div>
                    @php
                        $data = $detail['numbers'];
                        sort($data);
                        $count = count($data);
                        // Calculate median
                        if ($count % 2 == 0) {
                            $median = ($data[$count / 2 - 1] + $data[$count / 2]) / 2;
                        } else {
                            $median = $data[floor($count / 2)];
                        }
                        // Calculate Q1 (first quartile)
                        $firstHalf = array_slice($data, 0, floor($count / 2));
                        $firstHalfCount = count($firstHalf);
                        if ($firstHalfCount % 2 == 0) {
                            $q1_calc = ($firstHalf[$firstHalfCount / 2 - 1] + $firstHalf[$firstHalfCount / 2]) / 2;
                        } else {
                            $q1_calc = $firstHalf[floor($firstHalfCount / 2)];
                        }
                        // Calculate Q3 (third quartile)
                        $secondHalf = array_slice($data, ceil($count / 2));
                        $secondHalfCount = count($secondHalf);
                        if ($secondHalfCount % 2 == 0) {
                            $q3_calc = ($secondHalf[$secondHalfCount / 2 - 1] + $secondHalf[$secondHalfCount / 2]) / 2;
                        } else {
                            $q3_calc = $secondHalf[floor($secondHalfCount / 2)];
                        }
                    @endphp
                    @if($count % 2 == 0)
                    <div class="w-full md:w-[60%] lg:w-[60%] text-[16px] p-3 mt-3 bg-gray-50 rounded border">
                        <p class="mt-2 text-center text-xl text-blue"><strong>Step by step solution:</strong></p>
                        <p class="mt-2">The data set is: 
                            @php
                                $originalData = $detail['numbers'];
                                echo implode(', ', $originalData);
                            @endphp
                        </p>
                        <p class="mt-2 text-blue"><strong>Step 1: Arrange the data set in ascending order.</strong></p>
                        <p class="mt-2">
                            @php
                                echo implode(', ', $data);
                            @endphp
                        </p>
                        <p class="mt-2 text-blue"><strong>Step 2: Calculate the total number of terms “n”</strong></p>
                        <p class="mt-2">Total terms = n = {{ count($detail['numbers']) }}.</p>
                        <p class="mt-2 text-blue"><strong>Step 3: Find the Median:</strong></p>
                        <p class="mt-2">Median = Median of sorted data set.</p>
                        <p class="mt-2">Sorted data set = 
                            @php
                                echo implode(', ', $data);
                            @endphp
                        </p>
                        <p class="mt-2">Median of sorted data set = 
                            @if($count % 2 == 0)
                                <span class="fractionUpDown" aria-label="fractionUpDown with sum over count">
                                    <span class="num">{{ $data[$count / 2 - 1] }} + {{ $data[$count / 2] }}</span>
                                    <span class="visually-hidden"> / </span>
                                    <span class="den">2</span>
                                </span>
                            @else
                                {{ $data[floor($count / 2)] }}
                            @endif
                        </p>
                        <p class="mt-2 text-lg"><strong>Median = {{ $median }}</strong></p>
                        <p class="mt-4 text-blue"><strong>For Q1:</strong></p>
                        <p class="mt-2">Q1 = central element of first half sorted data set.</p>
                        <p class="mt-2">First half data set = 
                            @php
                                echo implode(', ', $firstHalf);
                            @endphp
                        </p>
                        <p class="mt-2 text-lg"><strong>Q1 = {{ $q1_calc }}</strong></p>
                        <p class="mt-4 text-blue"><strong>For Q3:</strong></p>
                        <p class="mt-2">Q3 = central element of second half sorted data set.</p>
                        <p class="mt-2">Second half data set = 
                            @php
                                echo implode(', ', $secondHalf);
                            @endphp
                        </p>
                        <p class="mt-2 text-lg"><strong>Q3 = {{ $q3_calc }}</strong></p>
                    </div>
                    @else
                    <div class="w-full md:w-[60%] lg:w-[60%] text-[16px] bg-gray-50 rounded border p-3 mt-3">
                        <p class="mt-2 text-center text-xl text-blue"><strong>Step by step solution:</strong></p>
                        <p class="mt-2">The data set is: 
                            @php
                                $originalData = $detail['numbers'];
                                echo implode(', ', $originalData);
                            @endphp
                        </p>
                        <p class="mt-2 text-blue"><strong>Step 1: Arrange the data set in ascending order.</strong></p>
                        <p class="mt-2">
                            @php
                                echo implode(', ', $data);
                            @endphp
                        </p>
                        <p class="mt-2 text-blue"><strong>Step 2: Calculate the total number of terms “n”</strong></p>
                        <p class="mt-2">Total terms = n = {{ count($detail['numbers']) }}.</p>
                        <p class="mt-4 text-blue"><strong>For Median:</strong></p>
                        <p class="mt-2"><strong>The formula for Median is: </strong></p>
                        <p>  Median   \( = \left\{ \frac{2 \times (n + 1)}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Median   \( = \left\{ \frac{2 \times ({{ count($detail['numbers']) }}+ 1)}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Median   \( = \left\{ \frac{2 \times ({{ count($detail['numbers'])+ 1 }})}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Median   \( = \left\{ \frac{ ({{ (count($detail['numbers'])+ 1)*2 }})}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Median  =  {{ ((count($detail['numbers'])+ 1)*2)/4 }} term</p>
                        <p class="mt-2 text-lg"><strong>Median  =  {{ round($q2 ,0)}}</strong></p>
                        
                        <p class="mt-4 text-blue"><strong>For Q1:</strong></p>
                        <p class="mt-2"><strong>The formula for Q1 is: </strong></p>
                        <p>  Q1   \( = \left\{ \frac{1 \times (n + 1)}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Q1   \( = \left\{ \frac{1 \times ({{ count($detail['numbers']) }}+ 1)}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Q1   \( = \left\{ \frac{1 \times ({{ count($detail['numbers'])+ 1 }})}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Q1   \( = \left\{ \frac{ ({{ (count($detail['numbers'])+ 1)*1 }})}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Q1  =  {{ ((count($detail['numbers'])+ 1)*1)/4 }} term</p>
                        <p class="mt-2 text-lg"><strong>Q1  =  {{ round($q1 ,0)}}</strong></p>
                        
                        <p class="mt-4 text-blue"><strong>For Q3:</strong></p>
                        <p class="mt-2"><strong>The formula for Q3 is: </strong></p>
                        <p>  Q3   \( = \left\{ \frac{3 \times (n + 1)}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Q3   \( = \left\{ \frac{3 \times ({{ count($detail['numbers']) }}+ 1)}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Q3   \( = \left\{ \frac{3 \times ({{ count($detail['numbers'])+ 3 }})}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Q3   \( = \left\{ \frac{ ({{ (count($detail['numbers'])+ 1)*3 }})}{4} \right\}^\text{th} \text{ term} \)</p>
                        <p>  Q3  =  {{ ((count($detail['numbers'])+ 1)*3)/4 }} term</p>
                        <p class="mt-2 text-lg"><strong>Q3  =  {{ round($q3 ,0)}}</strong></p>
                    </div>
                    @endif
                        <div class="w-full mt-3" 
                             x-data="{ 
                                chartData: {
                                    min: {{ $min }},
                                    q1: {{ $q1 }},
                                    median: {{ $q2 }},
                                    q3: {{ $q3 }},
                                    max: {{ $max }}
                                },
                                render() {
                                    if (typeof Highcharts === 'undefined') {
                                        setTimeout(() => this.render(), 200);
                                        return;
                                    }
                                    
                                    Highcharts.chart($refs.canvas, {
                                        chart: { type: 'boxplot', backgroundColor: 'transparent' },
                                        title: { text: '5 Number Summary', style: { color: '#2845F5', fontWeight: 'bold' } },
                                        legend: { enabled: false },
                                        xAxis: {
                                            categories: ['Data Set'],
                                            title: { text: 'Distribution' }
                                        },
                                        yAxis: {
                                            title: { text: 'Values' }
                                        },
                                        series: [{
                                            name: 'Observations',
                                            data: [
                                                [
                                                    parseFloat(this.chartData.min),
                                                    parseFloat(this.chartData.q1),
                                                    parseFloat(this.chartData.median),
                                                    parseFloat(this.chartData.q3),
                                                    parseFloat(this.chartData.max)
                                                ]
                                            ],
                                            color: '#2845F5',
                                            fillColor: '#EBF4FA'
                                        }],
                                        credits: { enabled: false }
                                    });
                                }
                             }" 
                             x-init="render()"
                             @render-five-number-chart.window="chartData = $event.detail[0]; render()"
                             wire:ignore>
                            <div x-ref="canvas" style="height:400px;" class="w-full rounded-lg border shadow-sm"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>

@push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
    <script src="{{ url('katex/katex.min.js') }}"></script>
    <script src="{{ url('katex/auto-render.min.js') }}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-more.js"></script>
    
    <script>
        // Render KaTeX on load if detail is present
        document.addEventListener('livewire:initialized', () => {
            if (document.getElementById('result-section')) {
                renderMathInElement(document.body);
            }
        });
    </script>
@endpush
</div>
