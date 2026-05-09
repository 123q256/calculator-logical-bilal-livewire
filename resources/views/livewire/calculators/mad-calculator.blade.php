<div>
<style>
    [x-cloak] { display: none !important; }
</style>

<form wire:submit.prevent="calculate" x-data="{ method: @entangle('method') }">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-1 px-2">
                    <label for="method" class="label">{{ $lang['1'] ?? 'Calculation From' }} (m):</label>
                    <div class="w-100 py-2">
                        <select wire:model.live="method" id="method" class="input cursor-pointer">
                            <option value="0">{{ $lang['2'] ?? 'Mean' }}</option>
                            <option value="1">{{ $lang['3'] ?? 'Median' }}</option>
                            <option value="2">{{ $lang['4'] ?? 'Custom Point' }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-1 px-2 flex items-center justify-center">
                    <img src="{{ asset('images/mad_formula.webp') }}" width="165" height="50" loading="lazy" alt="MAD Formula">
                </div>
                
                <div class="col-span-2 px-2" x-show="method == 2" x-cloak>
                    <label for="m" class="label">{{ $lang['5'] ?? 'Custom Point' }} (m)</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="m" id="m" class="input" aria-label="input" placeholder="e.g. 10" />
                    </div>
                </div>

                <div class="col-span-2 px-2">
                    <label for="textarea" class="label">{{ $lang['6'] ?? 'Dataset (separated by comma)' }}</label>
                    <div class="w-100 py-2">
                        <textarea wire:model.live="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 12, 23, 45, 33, 65, 54, 54"></textarea>
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
                        <div class="w-full">
                            @php
                                $mad = $detail['mad'];
                                $m = $detail['m'];
                                $x_raw = $detail['x'];
                                $data = array_map('trim', array_filter(explode(',', str_replace([" ", "\n", "\r"], ",", $x_raw))));
                                $n = count($data);
                            @endphp
                            <div class="text-center">
                                <p class="text-[20px]">
                                    <strong>
                                        @if($detail['method'] == 0)
                                            {{ $lang['7'] ?? 'Mean Absolute Deviation (MAD)' }}
                                        @elseif($detail['method'] == 1)
                                            {{ $lang['8'] ?? 'Median Absolute Deviation (MAD)' }}
                                        @else
                                            {{ $lang['9'] ?? 'Absolute Deviation from Custom Point' }}
                                        @endif
                                    </strong>
                                </p>
                                <div class="flex justify-center">
                                    <p class="text-[30px] bg-[#2845F5] text-white px-4 py-2 rounded-lg d-inline-block my-3">
                                        <strong>{{ $detail['mad'] }}</strong>
                                    </p>
                                </div>
                            </div>

                            <p class="w-full font-s-24 mt-4">{{ $lang['10'] ?? 'Step by Step Solution' }}</p>

                            @if(isset($detail['mean']))
                                @php
                                    $mean = $detail['mean'];
                                    $diff = $detail['diff'];
                                    $diff_sum = $detail['sum1'];
                                @endphp
                                <div class="mt-4 space-y-6">
                                    <div>
                                        <p class="font-s-18"><span class="text-blue">{{ $lang['11'] ?? 'Step' }} 1:</span> <b>{{ $lang['12'] ?? 'Calculate the Mean' }}:</b></p>
                                        <p class="mt-2 p-3 bg-gray-50 rounded">
                                            ({{ implode(' + ', $data) }}) / {{ $n }} = <strong>{{ $mean }}</strong>
                                        </p>
                                    </div>

                                    <div>
                                        <p class="font-s-18"><span class="text-blue">{{ $lang['11'] ?? 'Step' }} 2:</span> <b>{{ $lang['13'] ?? 'Calculate the absolute values' }}:</b></p>
                                        <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-2">
                                            @foreach($data as $i => $val)
                                                <p class="p-2 border-b">{{ $lang['14'] ?? 'Distance between' }} {{ $val }} {{ $lang['and'] ?? 'and' }} {{ $mean }} is <strong>{{ $diff[$i] }}</strong></p>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div>
                                        <p class="font-s-18"><span class="text-blue">{{ $lang['11'] ?? 'Step' }} 3:</span> <b>{{ $lang['15'] ?? 'Sum of absolute values' }}:</b></p>
                                        <p class="mt-2 p-3 bg-gray-50 rounded">
                                            {{ implode(' + ', $diff) }} = <strong>{{ $diff_sum }}</strong>
                                        </p>
                                    </div>

                                    <div>
                                        <p class="font-s-18"><span class="text-blue">{{ $lang['11'] ?? 'Step' }} 4:</span> <b>{{ $lang['16'] ?? 'Divide the sum by the number of data values' }}:</b></p>
                                        <p class="mt-2">{{ $diff_sum }} / {{ $n }} = {{ round(($diff_sum/$n), 1) }}</p>
                                        <p class="mt-2">{{ $lang['17'] ?? 'The' }} <b>{{ $lang['9'] ?? 'MAD' }}</b> = <strong>{{ $mad }}</strong></p>
                                    </div>
                                </div>
                            @elseif(isset($detail['median']))
                                @php
                                    $median = $detail['median'];
                                    $diff1 = $detail['diff1'];
                                    $diff = $detail['diff'];
                                @endphp
                                <div class="mt-4 space-y-6">
                                    <div>
                                        <p class="font-s-18"><span class="text-blue">{{ $lang['11'] ?? 'Step' }} 1:</span> <b>{{ $lang['18'] ?? 'Calculate the Median' }}:</b></p>
                                        <div class="mt-2 ml-4 space-y-2">
                                            <p><b>{{ $lang['20'] ?? 'Data' }}:</b> {{ implode(', ', $data) }}</p>
                                            @php sort($data); @endphp
                                            <p><b>{{ $lang['21'] ?? 'Sorted Data' }}:</b> {{ implode(', ', $data) }}</p>
                                            <p><b>{{ $lang['22'] ?? 'Center Position' }}:</b> {{ $n }}/2 = {{ $n/2 }}</p>
                                            <p>{{ $lang['17'] ?? 'The' }} <b>{{ $lang['3'] ?? 'Median' }}</b> = <strong>{{ $median }}</strong></p>
                                        </div>
                                    </div>

                                    <div>
                                        <p class="font-s-18"><span class="text-blue">{{ $lang['11'] ?? 'Step' }} 2:</span> <b>{{ $lang['13'] ?? 'Calculate the absolute values' }}:</b></p>
                                        <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-2">
                                            @foreach($data as $i => $val)
                                                <p class="p-2 border-b">{{ $lang['14'] ?? 'Distance between' }} {{ $val }} {{ $lang['and'] ?? 'and' }} {{ $median }} is <strong>{{ $diff[$i] }}</strong></p>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div>
                                        <p class="font-s-18"><span class="text-blue">{{ $lang['11'] ?? 'Step' }} 3:</span> <b>{{ $lang['25'] ?? 'Calculate the Median of deviations' }}:</b></p>
                                        <div class="mt-2 ml-4 space-y-2">
                                            <p><b>{{ $lang['20'] ?? 'Deviations' }}:</b> {{ implode(', ', $diff) }}</p>
                                            @php sort($diff1); @endphp
                                            <p><b>{{ $lang['21'] ?? 'Sorted Deviations' }}:</b> {{ implode(', ', $diff1) }}</p>
                                            <p><b>{{ $lang['22'] ?? 'Center Position' }}:</b> {{ $n }}/2 = {{ $n/2 }}</p>
                                            <p>The <b>MAD</b> = <strong>{{ $mad }}</strong></p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                @php
                                    $diff_sum1 = $detail['sum'] ?? 0;
                                    $diff = $detail['diff'] ?? [];
                                @endphp
                                <div class="mt-4 space-y-6">
                                    <div>
                                        <p class="font-s-18"><span class="text-blue">{{ $lang['11'] ?? 'Step' }} 1:</span> <b>{{ $lang['26'] ?? 'Calculate distances from' }} (m):</b></p>
                                        <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-2">
                                            @foreach($data as $i => $val)
                                                <p class="p-2 border-b">{{ $lang['14'] ?? 'Distance between' }} {{ $val }} {{ $lang['and'] ?? 'and' }} {{ $m }} is <strong>{{ $diff[$i] }}</strong></p>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div>
                                        <p class="font-s-18"><span class="text-blue">{{ $lang['11'] ?? 'Step' }} 2:</span> <b>{{ $lang['15'] ?? 'Sum of absolute values' }}:</b></p>
                                        <p class="mt-2 p-3 bg-gray-50 rounded">
                                            {{ implode(' + ', $diff) }} = <strong>{{ $diff_sum1 }}</strong>
                                        </p>
                                    </div>

                                    <div>
                                        <p class="font-s-18"><span class="text-blue">{{ $lang['11'] ?? 'Step' }} 3:</span> <b>{{ $lang['16'] ?? 'Divide the sum by the number of values' }}:</b></p>
                                        <p class="mt-2">{{ $diff_sum1 }} / {{ $n }} = {{ round(($diff_sum1/$n), 1) }}</p>
                                        <p class="mt-2">So, the <b>MAD</b> = <strong>{{ $mad }}</strong></p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
</div>
