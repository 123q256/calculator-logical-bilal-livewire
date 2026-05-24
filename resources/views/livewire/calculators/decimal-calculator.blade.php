<div>
 <form wire:submit.prevent="calculate">


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto" x-data="{ method: @entangle('method') }">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <p class="col-span-12 text-center my-3 text-[18px]">
                    <strong id="changeText">
                        <span x-show="method == '2'">a - b = ?</span>
                        <span x-show="method == '3'">a x b = ?</span>
                        <span x-show="method == '4'">a ÷ b = ?</span>
                        <span x-show="method == '5'">a<sup class="font-s-14">b</sup> = ?</span>
                        <span x-show="method == '6'"><sup class="font-s-14">a</sup>√b = ?</span>
                        <span x-show="method == '7'">log<sub class="font-s-14">a</sub>b = ?</span>
                        <span x-show="method == '1' || (method != '2' && method != '3' && method != '4' && method != '5' && method != '6' && method != '7')">a + b = ?</span>
                    </strong>
                </p>
                <div class="col-span-12">
                    <label for="method" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2">
                        <select wire:model.live="method" class="input" aria-label="select" id="method">
                            <option value="1">{{$lang[2]}} (+)</option>
                            <option value="2">{{$lang[3]}} (-)</option>
                            <option value="3">{{$lang[4]}} (×)</option>
                            <option value="4">{{$lang[5]}} (÷)</option>
                            <option value="5">{{$lang[6]}}</option>
                            <option value="6">{{$lang[7]}} (√)</option>
                            <option value="7">{{$lang[8]}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="a" class="font-s-14 text-blue">a</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="a" id="a" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="b" class="font-s-14 text-blue">b</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="b" id="b" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="rounding" class="font-s-14 text-blue">Rounding to:</label>
                    <div class="w-100 py-2">
                        <select wire:model.live="rounding" class="input" aria-label="select" id="rounding">
                            <option value="not">Do Not Round</option>
                            <option value="-3">Thousands</option>
                            <option value="-2">Hundreds</option>
                            <option value="-1">Tens</option>
                            <option value="0">Ones</option>
                            <option value="1">1 decimal</option>
                            <option value="2">2 decimals</option>
                            <option value="3">3 decimals</option>
                            <option value="4">4 decimals</option>
                            <option value="5">5 decimals</option>
                            <option value="6">6 decimals</option>
                        </select>
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
                        <div class="w-full md:w-[60%] lg:w-[60%]  mt-2">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b" width="60%"><strong>{{$lang[9]}}</strong></td>
                                    <td class="py-2 border-b">{{round($detail['ans'],8)}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>{{ $lang[12] }}</strong></p>
                            @if($method > 4)
                                <p class="mt-2"><strong>{{$lang[11]}}</strong></p>
                                <p class="mt-2">{!!$detail['res']!!}</p>
                            @endif
                            @if($method === "7")
                                @php $floatChkB = explode('.', $b); @endphp
                                @if (count($floatChkB)==2)
                                    @php
                                        $divideB = pow(10, strlen($floatChkB[1]));
                                        $newB = $b * $divideB;
                                    @endphp
                                    <p class="mt-2">= log<sub class="font-s-14">{{$a}}</sub>{{$b}}</p>
                                    <p class="mt-2">= log<sub class="font-s-14">{{$a}}</sub>({{$newB}}/{{$divideB}})</p>
                                    <p class="mt-2">= log<sub class="font-s-14">{{$a}}</sub>({{$newB}}) - log<sub class="font-s-14">{{$a}}</sub>({{$divideB}})</p>
                                    <p class="mt-2">= {{$detail['ans']}}</p>
                                @else
                                    <p class="mt-2">= log<sub class="font-s-14">{{$a}}</sub>{{$b}} = {{$detail['ans']}}</p>
                                @endif
                            @elseif($method === "6")
                                @php
                                    $floatChkA = explode('.', $a);
                                    $floatChkB = explode('.', $b);
                                @endphp
                                @if(count($floatChkA)==2 && count($floatChkB)==2)
                                    @php
                                        $divideA = pow(10, strlen($floatChkA[1]));
                                        $newA = $a * $divideA;
                                        $divideB = pow(10, strlen($floatChkB[1]));
                                        $newB = $b * $divideB;
                                    @endphp
                                    <p class="mt-2">= <sup class="font-s-14">{{$b}}</sup>√{{$a}}</p>
                                    <p class="mt-2">= <sup class="font-s-14">({{$newB}}/{{$divideB}})</sup>√({{$newA}}/{{$divideA}})</p>
                                    <p class="mt-2">= ({{$newB}}/{{$divideB}})<sup class="font-s-14">({{$divideA}}/{{$newA}})</sup></p>
                                    <p class="mt-2">= <sup class="font-s-14">({{$newB}})</sup>√({{$newA}}<sup class="font-s-14">{{$divideB}}</sup>) / <sup class="font-s-14">({{$newB}})</sup>√({{$divideA}}<sup class="font-s-14">{{$divideB}}</sup>)</p>
                                    <p class="mt-2"> = {{$detail['ans']}}</p>
                                @elseif(count($floatChkA)==2)
                                    @php
                                        $divideA = pow(10, strlen($floatChkA[1]));
                                        $newA = $a * $divideA;
                                    @endphp
                                    <p class="mt-2">= <sup class="font-s-14">{{$b}}</sup>√{{$a}}</p>
                                    <p class="mt-2">= <sup class="font-s-14">{{$b}}</sup>√({{$newA}}/{{$divideA}})</p>
                                    <p class="mt-2">= <sup class="font-s-14">{{$b}}</sup>√({{$newA}}) / <sup class="font-s-14">{{$b}}</sup>√({{$divideA}})</p>
                                    <p class="mt-2"> = {{$detail['ans']}}</p>
                                @elseif(count($floatChkB)==2)
                                    @php
                                        $divideB = pow(10, strlen($floatChkB[1]));
                                        $newB = $b * $divideB;
                                    @endphp
                                    <p class="mt-2">= <sup class="font-s-14">{{$b}}</sup>√{{$a}}</p>
                                    <p class="mt-2">= <sup class="font-s-14">{{$newB}}/{{$divideB}}</sup>√{{$a}}</p>
                                    <p class="mt-2">={{$a}}<sup class="font-s-14">({{$divideB}}/{{$newB}})</sup></p>
                                    <p class="mt-2">= <sup class="font-s-14">{{$newB}}</sup>√({{$a}}<sup class="font-s-14">{{$divideB}}</sup>)</p>
                                    <p class="mt-2"> = {{$detail['ans']}}</p>
                                @else
                                    <p class="mt-2">= <sup class="font-s-14">{{$b}}</sup>√{{$a}} = {{$detail['ans']}}</p>
                                @endif
                            @elseif($method === "5")
                                @php
                                    $floatChkA = explode('.', $a);
                                    $floatChkB = explode('.', $b);
                                @endphp
                                @if(count($floatChkA)==2 && count($floatChkB)==2)
                                    @php
                                        $divideA = pow(10, strlen($floatChkA[1]));
                                        $newA = $a * $divideA;
                                        $divideB = pow(10, strlen($floatChkB[1]));
                                        $newB = $b * $divideB;
                                    @endphp
                                    <p class="mt-2">= {{$a}}<sup class="font-s-14">{{$b}}</sup></p>
                                    <p class="mt-2">= ({{$newA}}/{{$divideA}})<sup class="font-s-14">({{$newB}}/{{$divideB}})</sup></p>
                                    <p class="mt-2">= <sup class="font-s-14">{{$divideB}}</sup>√(({{$newA}})<sup class="font-s-14">{{$newB}}</sup>) / <sup class="font-s-14">{{$divideB}}</sup>√(({{$divideA}})<sup class="font-s-14">{{$newB}}</sup>)</p>
                                    <p class="mt-2"> = {{$detail['ans']}}</p>
                                @elseif(count($floatChkA)==2)
                                    @php
                                        $divideA = pow(10, strlen($floatChkA[1]));
                                        $newA = $a * $divideA;
                                    @endphp
                                    <p class="mt-2">= {{$a}}<sup class="font-s-14">{{$b}}</sup></p>
                                    <p class="mt-2">= ({{$newA}}/{{$divideA}})<sup class="font-s-14">{{$b}}</sup></p>
                                    <p class="mt-2">= {{$newA}}<sup class="font-s-14">{{$b}}</sup> / {{$divideA}}<sup class="font-s-14">{{$b}}</sup></p>
                                    <p class="mt-2"> = {{$detail['ans']}}</p>
                                @elseif (count($floatChkB)==2)
                                    @php
                                        $divideB = pow(10, strlen($floatChkB[1]));
                                        $newB = $b * $divideB;
                                    @endphp
                                    <p class="mt-2">= {{$a}}<sup class="font-s-14">{{$b}}</sup></p>
                                    <p class="mt-2">= {{$a}}<sup class="font-s-14">({{$newB}}/{{$divideB}})</sup></p>
                                    <p class="mt-2">= <sup class="font-s-14">{{$divideB}}</sup>√({{$a}}<sup class="font-s-14">{{$newB}}</sup>)</p>
                                    <p class="mt-2"> = {{$detail['ans']}}</p>
                                @else
                                    <p class="mt-2">= {{$a}}<sup class="font-s-14">{{$b}}</sup> = {{$detail['ans']}}</p>
                                @endif
                            @else
                                <p class="mt-2">{!!$detail['res']!!}</p>
                            @endif
                            @isset($detail['round_ans'])
                                @php
                                    $round_array = [
                                    '-3' => 'Thousands',
                                    '-2' => 'Hundreds',
                                    '-1' => 'Tens',
                                    '0' => 'Ones',
                                    '1' => '1 Decimal',
                                    '2' => '2 Decimal',
                                    '3' => '3 Decimal',
                                    '4' => '4 Decimal',
                                    '5' => '5 Decimal',
                                    '6' => '6 Decimal',
                                ];
                                @endphp
                                <p class="mt-2">Rounding to {{$round_array[$rounding] ?? ''}} Place</p>
                                <p class="mt-2">= {{$detail['round_ans']}}</p>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>

</div>
