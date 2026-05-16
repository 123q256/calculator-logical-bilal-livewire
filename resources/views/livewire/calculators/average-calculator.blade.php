 <div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
            <div class="grid grid-cols-1   gap-4">
                <div class="space-y-2">
                    <label for="more" class="font-s-14 text-blue">{{$lang['1']}}:</label>
                    <select wire:model.live="more" name="more" class="input" id="more" aria-label="select">
                        <option value="space">{{$lang[2]}}</option>
                        <option value=",">{{$lang[3]}}</option>
                    </select>
                </div>
                <div class="space-y-2 hidden">
                    <label for="seprate" class="font-s-14 text-blue">&nbsp;</label>
                    <input type="text" readonly name="seprate" id="seprate" disabled class="input readonly" value="{{ $seprate }}" aria-label="input"/>
                </div>
                <div class="space-y-2">
                    <label for="x" class="font-s-14 text-blue">Please provide numbers separated by a comma:</label>
                    <textarea wire:model.live="x" aria-label="textarea input" id="x" name="x" class="textareaInput" id="textarea" placeholder="12, 23, 45"></textarea>
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
                    <div class="w-full bg-light-blue  rounded-lg mt-3">
                        <div class="w-full flex-wrap">
                            <div class="w-full md:w-[50%] lg:w-[50%] mt-2">
                                <table class="w-full text-lg">
                                    <tr>
                                        <td class="py-2 border-b w-2/2"><strong>{{$lang['a']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['average']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2"><strong>{{$lang['5']}}</strong></td>
                                        <td class="py-2 border-b">{{$detail['median']}}</td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2"><strong>{{$lang['6']}}</strong></td>
                                        <td class="py-2 border-b">
                                            @php
                                                foreach ($detail['mode'] as $value) {
                                                    if (end($detail['mode']) == $value) {
                                                        echo $value;
                                                    } else {
                                                        echo $value . " , ";
                                                    }
                                                }
                                            @endphp
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2"><strong>{{$lang['7']}}</strong></td>
                                        <td class="py-2 border-b">{{max($detail['numbers']) - min($detail['numbers'])}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full md:w-[50%] lg:w-[50%] mt-2">
                                <table class="w-full text-base">
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['8'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ "( ".array_sum($detail['numbers'])." ) / ".count($detail['numbers'])." = ".$detail['average'] }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['9'] }}</td>
                                        <td class="py-2 border-b"><strong>{{ round(pow(array_product($detail['numbers']), (1/$detail['count'])),4) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['10'] }}</td>
                                        <td class="py-2 border-b">
                                            <strong>
                                                @php
                                                    $nums = $detail['numbers'];
                                                    foreach ($nums as $key => $value) {
                                                        if ($key == (count($nums)-1)) {
                                                            echo $value;
                                                        } else {
                                                            echo $value." , ";
                                                        }
                                                    }
                                                @endphp
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['11'] }}</td>
                                        <td class="py-2 border-b">
                                            <strong>
                                                @php
                                                    $sortedNums = $detail['numbers'];
                                                    rsort($sortedNums);
                                                    foreach ($sortedNums as $key => $value) {
                                                        if ($key == (count($sortedNums)-1)) {
                                                            echo $value;
                                                        } else {
                                                            echo $value." , ";
                                                        }
                                                    }
                                                @endphp
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['12'] }}</td>
                                        <td class="py-2 border-b">
                                            <strong>
                                                @php
                                                    foreach ($detail['numbers'] as $key => $value) {
                                                        if ($value % 2 == 0) {
                                                            echo $value." , ";
                                                        }
                                                    }
                                                @endphp
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['13'] }}</td>
                                        <td class="py-2 border-b">
                                            <strong>
                                                @php
                                                    foreach ($detail['numbers'] as $key => $value) {
                                                        if ($value % 2) {
                                                            echo $value." , ";
                                                        }
                                                    }
                                                @endphp
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['sum'] }}</td>
                                        <td class="py-2 border-b"><strong>{{array_sum($detail['numbers'])}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['d'] }}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['d']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['14'] }}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['s_d_p']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">{{ $lang['15'] }}</td>
                                        <td class="py-2 border-b"><strong>{{$detail['s_d_s']}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">Largest</td>
                                        <td class="py-2 border-b"><strong>{{max($detail['numbers'])}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">Smallest</td>
                                        <td class="py-2 border-b"><strong>{{min($detail['numbers'])}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td class="py-2 border-b w-2/2">Count</td>
                                        <td class="py-2 border-b"><strong>{{count($detail['numbers'])}}</strong></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full md:w-[50%] lg:w-[50%]  text-base mt-2">
                                <p class="mt-2"><strong>{{$lang[20]}}</strong></p>
                                <div class="">
                                    <table class="w-full text-center">
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{$lang[21]}}</strong></td>
                                            <td class="py-2 border-b"><strong>{{$lang[22]}}</strong></td>
                                            <td class="py-2 border-b"><strong>{{$lang[23]}}</strong></td>
                                        </tr>
                                        {!!$detail['table']!!}
                                        <tr>
                                            <td class="py-2 border-b"><strong>{{$lang['sum']}}</strong></td>
                                            <td class="py-2 border-b"><strong>{{$detail['count']}}</strong></td>
                                            <td class="py-2 border-b"><strong>{{array_sum($detail['numbers'])}}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="w-full mt-8" 
                                 x-data="{ 
                                    chartData: {!! $detail['chartData'] !!},
                                    render() {
                                        if (typeof Highcharts === 'undefined') {
                                            setTimeout(() => this.render(), 200);
                                            return;
                                        }
                                        Highcharts.chart($refs.canvas, {
                                            chart: { type: 'column', backgroundColor: 'transparent' },
                                            title: { text: '{{$lang['16']}}', align: 'left', style: { color: '#2845F5', fontWeight: 'bold' } },
                                            xAxis: { type: 'linear', title: { text: '{{$lang['18']}}' }, gridLineWidth: 1 },
                                            yAxis: { title: { text: '# {{$lang['17']}}' }, gridLineWidth: 1 },
                                            series: [{ 
                                                name: 'Frequency', 
                                                data: this.chartData, 
                                                color: '#2845F5',
                                            }],
                                            credits: { enabled: false }
                                        });
                                    }
                                 }" 
                                 x-init="render()"
                                 wire:ignore>
                                <div x-ref="canvas" class="w-full min-h-[350px]"></div>
                            </div>
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
