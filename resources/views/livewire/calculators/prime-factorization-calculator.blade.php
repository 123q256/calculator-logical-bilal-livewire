<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            
            <div class="lg:w-[40%] md:w-[40%] w-full mx-auto">
                <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12">
                        <label for="from" class="font-s-14 text-blue">{{ $lang['to'] }}:</label>
                        <div class="w-100 py-2">
                            <select class="input" aria-label="select" wire:model.live="from" id="from">
                                <option value="1">{{ $lang['1'] }}</option>
                                <option value="2">{{ $lang['2'] }}</option>
                                <option value="3">{{ $lang['3'] }}</option>
                                <option value="4">{{ $lang['4'] }}</option>
                                <option value="5">{{ $lang['5'] }}</option>
                                <option value="6">{{ $lang['6'] }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="num" class="font-s-14 text-blue">{{ $lang['input'] }}</label>
                        <div class="w-100 py-2">
                            <input type="text" wire:model.live="num" id="num" class="input" aria-label="input" />
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

        @if(isset($detail))
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                @if(isset($detail['prime']) && $detail['prime'] == 1)
                                    <div class="w-full text-center my-2">
                                        <p><strong class="bg-sky px-3 py-2 text-[21px] rounded-lg text-blue-500">{{ $detail['Factors'] }}</strong></p>
                                    </div>
                                @else
                                    @php
                                        $fUsed = $detail['from_used'] ?? $from;
                                        $nUsed = $detail['num_used'] ?? $num;
                                    @endphp

                                    @if($fUsed == 1)
                                        <div class="w-full mt-2">
                                            <table class="w-full font-s-18">
                                                <tr>
                                                    <td class="py-2 border-b" width="50%"><strong>{{ $lang['prime'] }}</strong></td>
                                                    <td class="py-2 border-b">{{ $detail['Factors'] }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b" width="50%"><strong>{{ $lang['exp'] }}</strong></td>
                                                    <td class="py-2 border-b">
                                                        @php
                                                            $csv = explode(' × ', $detail['Factors'] ?? '');
                                                            $exp = array_count_values($csv);
                                                            $end = count($exp);
                                                            $i = 1;
                                                            foreach ($exp as $key => $value) {
                                                                if ($i != $end) {
                                                                    echo $key . '<sup class="font-s-14">' . $value . '</sup> x ';
                                                                } else {
                                                                    echo $key . '<sup class="font-s-14">' . $value . '</sup>';
                                                                }
                                                                $i++;
                                                            }
                                                        @endphp
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b" width="50%"><strong>{{ $lang['csv'] }}</strong></td>
                                                    <td class="py-2 border-b">{{ $detail['csv'] ?? '' }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="py-2 border-b" width="50%"><strong>{{ $lang['all'] }} {{ $nUsed }}</strong></td>
                                                    <td class="py-2 border-b">
                                                        @php
                                                            $n = (int)$nUsed;
                                                            $factors = [];
                                                            if ($n > 0 && $n <= 1000000) {
                                                                for ($f = 1; $f <= $n; $f++) { 
                                                                    if ($n % $f == 0) {
                                                                        $factors[] = $f;
                                                                    }
                                                                }
                                                            }
                                                            echo implode(', ', $factors);
                                                        @endphp
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="w-full text-[16px]">
                                            <p class="my-2"><strong>{{ $lang[7] }}</strong></p>
                                            <table class="col-2 text-[16px]">
                                                {!! $detail['tree'] ?? '' !!}
                                            </table>
                                        </div>
                                    @elseif($fUsed == 2)
                                        <div class="w-full mt-2">
                                            <table class="w-100 font-s-18 text-center">
                                                {!! $detail['table'] ?? '' !!}
                                            </table>
                                        </div>
                                    @elseif($fUsed == 3)
                                        <div class="w-full text-center text-[20px]">
                                            <p>{{ $lang[8] }} {{ $nUsed }}</p>
                                            <p class="my-3"><strong class="bg-sky px-3 py-2 text-[21px] rounded-lg text-blue">{{ $detail['list'] ?? '' }}</strong></p>
                                        </div>
                                    @elseif($fUsed == 4)
                                        <div class="w-full text-center text-[20px]">
                                            <p>{{ $lang['9'] }} {{ $nUsed }} {{ $lang['10'] }}</p>
                                            <p class="my-3"><strong class="bg-sky px-3 py-2 text-[32px] rounded-lg text-blue">{{ $detail['total'] ?? '' }}</strong></p>
                                        </div>
                                    @elseif($fUsed == 5)
                                        <div class="w-full text-center">
                                            <p>
                                                <strong class="bg-sky px-3 py-2 text-[32px] rounded-lg text-blue">
                                                    {{ $nUsed }}: {{ (isset($detail['prime_check']) && $detail['prime_check'] === 0) ? $lang['11'] : '' }} {{ $lang['12'] }}
                                                </strong>
                                            </p>
                                        </div>
                                    @else
                                        <div class="w-full md:w-[80%] lg:w-[80%] mt-2">
                                            <table class="w-full text-[18px]">
                                                @if(!empty($detail['prev']))
                                                    <tr>
                                                        <td class="py-2 border-b" width="80%"><strong>{{ $lang['13'] }}</strong></td>
                                                        <td class="py-2 border-b">{{ $detail['prev'] }}</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td class="py-2 border-b" width="80%"><strong>{{ $lang['14'] }}</strong></td>
                                                    <td class="py-2 border-b">{{ $detail['next'] ?? '' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </form>
</div>
