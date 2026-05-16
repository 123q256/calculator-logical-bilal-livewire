<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif

        @php
            $visible = ['a', 'b', 'dot1']; // Always visible
            if ($ratio_of == 'r2') {
                $visible[] = 'method';
                if ($method == '0') {
                    $visible = array_merge($visible, ['txt1', 'c', 'd', 'dot3', 'eq']);
                } elseif ($method == '1' || $method == '2') {
                    $visible = array_merge($visible, ['i']);
                }
            } elseif ($ratio_of == 'r3') {
                $visible[] = 'method1';
                $visible[] = 'c1';
                $visible[] = 'dot2';
                if ($method1 == '0') {
                    $visible = array_merge($visible, ['txt2', 'd', 'e', 'f', 'eq', 'dot4', 'dot5']);
                } elseif ($method1 == '1' || $method1 == '2') {
                    $visible = array_merge($visible, ['i']);
                }
            }
            
            $isVisible = function($id) use ($visible) {
                return in_array($id, $visible);
            };

            // Input Locking Logic
            $filled_r2 = collect([$a, $b, $c, $d])->filter(fn($v) => strlen(trim((string)$v)) > 0)->count();
            $filled_r3 = collect([$a, $b, $c1, $d, $e, $f])->filter(fn($v) => strlen(trim((string)$v)) > 0)->count();

            $isDisabled = function($val, $mode) use ($filled_r2, $filled_r3, $ratio_of, $method, $method1) {
                if ($mode == 'r2' && $ratio_of == 'r2' && $method == '0') {
                    return $filled_r2 >= 3 && strlen(trim((string)$val)) == 0;
                }
                if ($mode == 'r3' && $ratio_of == 'r3' && $method1 == '0') {
                    return $filled_r3 >= 4 && strlen(trim((string)$val)) == 0;
                }
                return false;
            };
        @endphp

       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 md:col-span-8 lg:col-span-8" id="method" style="display: {{ $isVisible('method') ? 'block' : 'none' }}">
                    <label for="meth" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <select class="input" id="meth" wire:model.live="method" name="method">
                            <option value="0">{{ $lang['2'] }}</option>
                            <option value="1">{{ $lang['3'] }}</option>
                            <option value="2">{{ $lang['4'] }}</option>
                            <option value="3">{{ $lang['5'] }}</option>
                            <option value="4">{{ $lang['6'] }}</option>
                            <option value="5">{{ $lang['7'] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-8 lg:col-span-8" id="method1" style="display: {{ $isVisible('method1') ? 'block' : 'none' }}">
                    <label for="metho" class="label">{{ $lang['1'] }} :</label>
                    <div class="w-full py-2 position-relative">
                        <select class="input" id="metho" wire:model.live="method1" name="method1">
                            <option value="0">{{ $lang['2'] }}</option>
                            <option value="1">{{ $lang['3'] }}</option>
                            <option value="2">{{ $lang['4'] }}</option>
                            <option value="3">{{ $lang['5'] }}</option>
                            <option value="4">{{ $lang['8'] }}</option>
                            <option value="5">{{ $lang['9'] }}</option>
                            <option value="6">{{ $lang['10'] }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-4 lg:col-span-4 text-center flex items-center justify-end">
                    <input type="radio" wire:model.live="ratio_of" name="ratio_of" id="r2" value="r2">
                    <label for="r2" class="label pe-lg-3 pe-2 ms-1">A:B </label>
                    <input type="radio" wire:model.live="ratio_of" name="ratio_of" id="r3" value="r3">
                    <label for="r3" class="label ms-1">A:B:C</label>
                </div>
                <div id="txt1" class="txt_set my-2 col-span-12" style="display: {{ $isVisible('txt1') ? 'block' : 'none' }}">{!! $lang['12'] !!}</div>
                <div id="txt2" class="txt_set my-2 col-span-12" style="display: {{ $isVisible('txt2') ? 'block' : 'none' }}">{!! $lang['13'] !!}</div>
                
                <div class="col-span-12 items-center mt-2">
                    <div class="grid grid-cols-12 gap-1">
                        <div class="col-span-2 p_set" id="a" style="display: {{ $isVisible('a') ? 'block' : 'none' }}">
                            <p class="text-center"><strong>A</strong></p>
                            <input type="number" step="any" class="input" wire:model.live="a" name="a" @if($isDisabled($a, $ratio_of)) disabled style="background-color: gainsboro" @endif>
                        </div>
                        <div class="col-span-1 text-center mt-3 flex items-center" id="dot1" style="display: {{ $isVisible('dot1') ? 'flex' : 'none' }}">
                            <div class="eq_set">:</div>
                        </div>
                        <div class="col-span-2 p_set" id="b" style="display: {{ $isVisible('b') ? 'block' : 'none' }}">
                            <p class="text-center"><strong>B</strong></p>
                            <input type="number" step="any" class="input" wire:model.live="b" name="b" @if($isDisabled($b, $ratio_of)) disabled style="background-color: gainsboro" @endif>
                        </div>
                        <div class="col-span-1 text-center mt-3 flex items-center" id="dot2" style="display: {{ $isVisible('dot2') ? 'flex' : 'none' }}">
                            <div class="eq_set">:</div>
                        </div>
                        <div class="col-span-2" id="c1" style="display: {{ $isVisible('c1') ? 'block' : 'none' }}">
                            <p class="text-center"><strong>C</strong></p>
                            <input type="number" step="any" class="input" wire:model.live="c1" name="c1" @if($isDisabled($c1, $ratio_of)) disabled style="background-color: gainsboro" @endif>
                        </div>
                        <div class="col-span-1 text-center mt-3 flex items-center" id="eq" style="display: {{ $isVisible('eq') ? 'flex' : 'none' }}">
                            <div class="eq_set">=</div>
                        </div>
                        <div class="col-span-2 p_set" id="c" style="display: {{ $isVisible('c') ? 'block' : 'none' }}">
                            <p class="text-center"><strong>C</strong></p>
                            <input type="number" step="any" class="input" wire:model.live="c" name="c" @if($isDisabled($c, $ratio_of)) disabled style="background-color: gainsboro" @endif>
                        </div>
                        <div class="col-span-1 text-center mt-3 flex items-center" id="dot3" style="display: {{ $isVisible('dot3') ? 'flex' : 'none' }}">
                            <div class="eq_set">:</div>
                        </div>
                        <div class="col-span-2 p_set" id="d" style="display: {{ $isVisible('d') ? 'block' : 'none' }}">
                            <p class="text-center"><strong>D</strong></p>
                            <input type="number" step="any" class="input" wire:model.live="d" name="d" @if($isDisabled($d, $ratio_of)) disabled style="background-color: gainsboro" @endif>
                        </div>
                        <div class="col-span-1 text-center mt-3 flex items-center" id="dot4" style="display: {{ $isVisible('dot4') ? 'flex' : 'none' }}">
                            <div class="eq_set">:</div>
                        </div>
                        <div class="col-span-2 p_set" id="e" style="display: {{ $isVisible('e') ? 'block' : 'none' }}">
                            <p class="text-center"><strong>E</strong></p>
                            <input type="number" step="any" class="input" wire:model.live="e" name="e" @if($isDisabled($e, $ratio_of)) disabled style="background-color: gainsboro" @endif>
                        </div>
                        <div class="col-span-1 text-center mt-3 flex items-center" id="dot5" style="display: {{ $isVisible('dot5') ? 'flex' : 'none' }}">
                            <div class="eq_set">:</div>
                        </div>
                        <div class="col-span-2 p_set" id="f" style="display: {{ $isVisible('f') ? 'block' : 'none' }}">
                            <p class="text-center"><strong>F</strong></p>
                            <input type="number" step="any" class="input" wire:model.live="f" name="f" @if($isDisabled($f, $ratio_of)) disabled style="background-color: gainsboro" @endif>
                        </div>
                        <div class="col-span-6 p_set ps-lg-2" id="i" style="display: {{ $isVisible('i') ? 'block' : 'none' }}">
                            <p class="text-center font-s-14"><strong>
                                @if($ratio_of == 'r2')
                                    {{ $method == '1' ? 'Times Larger' : ($method == '2' ? 'Times Smaller' : $lang['14']) }}
                                @else
                                    {{ $method1 == '1' ? 'Times Larger' : ($method1 == '2' ? 'Times Smaller' : $lang['14']) }}
                                @endif
                            </strong></p>
                            <input type="number" step="any" class="input" wire:model.live="i" name="i">
                        </div>
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
    <div id="result-section" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                @include('inc.copy-pdf')
            @endif
            
            <div class="rounded-lg flex flex-col items-center justify-center space-y-6">
                @php
                    $r2_mode = isset($detail['r2']);
                    $r3_mode = isset($detail['r3']);
                    
                    $res_a = $detail['a_val'] ?? $detail['a_val1'] ?? $detail['a_val2'] ?? $detail['a_val3'] ?? $detail['a_val4'] ?? $detail['a_val5'] ?? $detail['a_val6'] ?? $a;
                    $res_b = $detail['b_val'] ?? $detail['b_val1'] ?? $detail['b_val1'] ?? $detail['b_val2'] ?? $detail['b_val3'] ?? $detail['b_val4'] ?? $detail['b_val5'] ?? $detail['b_val6'] ?? $b;
                    $res_c1 = $detail['c_val1'] ?? $detail['c_val2'] ?? $detail['c_val3'] ?? $detail['c_val4'] ?? $detail['c_val5'] ?? $detail['c_val6'] ?? $c1;
                    
                    $res_c = $detail['c_val'] ?? $c;
                    $res_d = $detail['d_val'] ?? $d;
                    $res_e = $detail['e_val'] ?? $e;
                    $res_f = $detail['f_val'] ?? $f;

                    // Visualizations logic
                    $total_val = (float)$res_a + (float)$res_b + (float)($r3_mode ? $res_c1 : 0);
                    $pie_width = $total_val > 0 ? ((float)$res_a / $total_val) * 100 : 0;
                    
                    if((float)$res_a > 0 && (float)$res_b > 0){
                        $bar_height = (float)$res_a > (float)$res_b ? ((float)$res_b / (float)$res_a) * 150 : ((float)$res_a / (float)$res_b) * 150;
                    } else {
                        $bar_height = 0;
                    }
                @endphp

                <div class="text-center w-full">
                    <p class="text-2xl font-bold mb-4">{{ $lang['15'] }}</p>
                    <p class="text-3xl text-blue-600 font-bold">
                        @if($r2_mode)
                            @if($method == '0')
                                <span class="{{ isset($detail['a_val']) ? 'text-orange-500' : '' }}">{{ (float)$res_a }}</span> : 
                                <span class="{{ isset($detail['b_val']) ? 'text-orange-500' : '' }}">{{ round((float)$res_b, 4) }}</span> = 
                                <span class="{{ isset($detail['c_val']) ? 'text-orange-500' : '' }}">{{ round((float)$res_c, 4) }}</span> : 
                                <span class="{{ isset($detail['d_val']) ? 'text-orange-500' : '' }}">{{ round((float)$res_d, 4) }}</span>
                            @else
                                {{ $a }} : {{ $b }} = <span class="text-orange-500">{{ round((float)$res_a, 4) }} : {{ round((float)$res_b, 4) }}</span>
                            @endif
                        @else
                            @if($method1 == '0')
                                {{ $a }} : {{ $b }} : {{ $c1 }} = {{ $res_d }} : <span class="text-orange-500">{{ round((float)$res_e, 4) }} : {{ round((float)$res_f, 4) }}</span>
                            @else
                                {{ $a }} : {{ $b }} : {{ $c1 }} = <span class="text-orange-500">{{ round((float)$res_a, 4) }} : {{ round((float)$res_b, 4) }} : {{ round((float)$res_c1, 4) }}</span>
                            @endif
                        @endif
                    </p>

                    @if(isset($detail['dbl']))
                        <div class="mt-4">
                            <p class="text-xl font-bold">{{ $lang['16'] }}:</p>
                            <p class="text-2xl text-blue-500 font-bold">
                                @if($r2_mode)
                                    {{ $a }} : {{ $b }} = {{ round((float)$res_a) }} : {{ round((float)$res_b) }}
                                @else
                                    {{ $a }} : {{ $b }} : {{ $c1 }} = {{ round((float)$res_a) }} : {{ round((float)$res_b) }} : {{ round((float)$res_c1) }}
                                @endif
                            </p>
                        </div>
                    @endif
                    
                    @if(isset($detail['gcf']))
                        <p class="mt-4 text-lg"><strong>{{ $lang['17'] }} <a href="{{ $lang['18'] }}" target="_blank" class="text-blue-500 underline">{{ $lang['19'] }}</a> {{ $lang['20'] }}</strong></p>
                    @elseif($method == '3' || $method1 == '3')
                            <p class="mt-4 text-lg"><strong>{{ $lang['21'] }} <a href="{{ $lang['18'] }}" target="_blank" class="text-blue-500 underline">{{ $lang['19'] }}</a> {{ $lang['22'] }}</strong></p>
                    @endif
                </div>

                <div class="w-full grid grid-cols-12 gap-8 items-start mt-8">
                    {{-- Pie Chart Section --}}
                    <div class="col-span-12 lg:col-span-6 flex flex-col items-center">
                        <p class="text-xl font-bold mb-4">{{ $lang['24'] }}</p>
                        <div class="w-full" 
                                 wire:key="ratio-chart-{{ count((array)$detail) }}"
                                 x-data='{ 
                                    chartData: {!! $detail["chartData"] !!},
                                    render() {
                                        if (!this.chartData || this.chartData.length === 0) return;
                                        if (typeof Highcharts === "undefined") {
                                            setTimeout(() => this.render(), 200);
                                            return;
                                        }
                                        Highcharts.chart($refs.canvas, {
                                            chart: { type: "pie", backgroundColor: "transparent" },
                                            title: { text: null },
                                            series: [{ 
                                                name: "Ratio Part", 
                                                data: this.chartData,
                                                colorByPoint: true
                                            }],
                                            colors: ["#00c2db", "#ff9f00", "#4caf50"],
                                            credits: { enabled: false },
                                            tooltip: { pointFormat: "{series.name}: {point.percentage:.1f}%" },
                                            plotOptions: {
                                                pie: {
                                                    allowPointSelect: true,
                                                    cursor: "pointer",
                                                    dataLabels: { enabled: true, format: "{point.name}: {point.percentage:.1f}%" }
                                                }
                                            }
                                        });
                                    }
                                 }' 
                                 x-init="render()"
                                 @chartUpdated.window="chartData = $event.detail; render()"
                                 wire:ignore>
                            <div x-ref="canvas" class="w-full h-[300px]"></div>
                        </div>
                    </div>

                    {{-- Bar Graphs Section --}}
                    <div class="col-span-12 lg:col-span-6 flex flex-col items-center space-y-8">
                        <p class="text-xl font-bold">{{ $lang['23'] }}</p>
                        
                        {{-- Horizontal Comparison --}}
                        <div class="flex flex-col items-center w-full">
                            <p class="text-sm font-semibold mb-2">{{ $lang['25'] }} {{ round((float)$res_a, 2) }}, {{ $lang['26'] }} {{ round((float)$res_b, 2) }}</p>
                            <div class="w-[200px] h-[40px] bg-orange-400 relative rounded overflow-hidden shadow-inner">
                                <div class="bg-cyan-500 h-full transition-all duration-500" style="width: {{ $pie_width }}%"></div>
                            </div>
                        </div>

                        {{-- Vertical Comparison --}}
                        <div class="flex flex-col items-center w-full">
                            <p class="text-sm font-semibold mb-2">{{ $lang['27'] }} {{ round((float)$res_a, 2) }}, {{ $lang['28'] }} {{ round((float)$res_b, 2) }}</p>
                            <div class="w-[200px] h-[150px] flex items-end justify-center space-x-4 border-b-2 border-gray-300 pb-1">
                                <div class="bg-cyan-500 w-[60px] shadow-md transition-all duration-500" style="height: {{ min($bar_height, 150) }}px"></div>
                                <div class="bg-orange-400 w-[60px] h-[150px] shadow-md"></div>
                            </div>
                            <div class="flex space-x-12 mt-1 text-xs font-bold">
                                <span>Part A</span>
                                <span>Part B</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>

@push('calculatorJS')
<script src="https://code.highcharts.com/highcharts.js"></script>
@endpush
</div>
