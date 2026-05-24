<div>
 <form wire:submit.prevent="calculate">


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 flex items-center justify-center font-s-16 mb-2">
                <div>&nbsp;</div>
                <div class="px-2 w-full text-center"><strong>{{$lang['5']}}</strong></div>
                <div class="px-2 w-full text-center"><strong>{{$lang['6']}}</strong></div>
            </div>
            @foreach($weights as $index => $weight)
            <div class="col-span-12 flex items-center justify-center {{ $loop->first ? '' : 'mt-3' }}">
                <div class="label">x<sub class="font-s-14">{{ $index + 1 }}</sub></div>
                <div class="px-2">
                    <input type="number" step="any" wire:model.live="weights.{{ $index }}" class="input" aria-label="input" />
                </div>
                <div class="px-2">
                    <input type="number" step="any" wire:model.live="values.{{ $index }}" class="input" aria-label="input" />
                </div>
            </div>
            @endforeach
            <div class="col-span-12 text-end mt-3">
                <button type="button" wire:click="addRow" title="Add More Fields" class="px-3 py-2 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><span>+</span>Add Row</button>
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
                                    <td class="py-2 border-b" width="60%"><strong>{{ $lang['1'] }}</strong></td>
                                    <td class="py-2 border-b">{{round($detail['weighted_average'],2)}}</td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong>{{ $lang['2'] }}</strong></td>
                                    <td class="py-2 border-b">{{round($detail['weight_sum'],2)}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="w-full text-[16px]">
                            <p class="mt-2"><strong>{{$lang['3']}}</strong></p>
                            <p class="mt-2">{{$lang['4']}}</p>
                            <p class="mt-2 overflow-auto">
                                x̄ = 
                                <span class="quadratic_fraction">
                                    <span class="num">(x<sub class="font-s-14">1</sub> × w<sub class="font-s-14">1</sub>) + (x<sub class="font-s-14">2</sub> × w<sub class="font-s-14">2</sub>) + ..... + (x<sub class="font-s-14">n</sub> × w<sub class="font-s-14">n</sub>)</span>
                                    <span>(w<sub class="font-s-14">1</sub> + w<sub class="font-s-14">2</sub> + .... + w<sub class="font-s-14">n</sub>)</span>
                                </span> 
                            </p>
                            @php
                                $v=$detail['v'];
                                $sum=0;
                                $wv=$detail['wv'];
                                $values=$detail['values'];
                                $weights=$detail['weights'];
                                $suming=0;
                            @endphp
                            <p class="mt-2 overflow-auto">
                                x̄ = 
                                <span class="quadratic_fraction">
                                    <span class="num">
                                        @php
                                            for ($j=0; $j<$v; $j++) { 
                                                echo "( $weights[$j] × $values[$j])";
                                                if ($j != $v-1) {
                                                    echo " +";
                                                }
                                            }
                                        @endphp
                                    </span>
                                    <span>
                                        @php
                                            for ($k=0;$k<$v;$k++) { 
                                                echo $weights[$k];
                                                if ($k != $v-1) {
                                                    echo " +";
                                                }
                                            }
                                        @endphp
                                    </span>
                                </span> 
                            </p>
                            <p class="mt-2 overflow-auto">
                                x̄ = 
                                <span class="quadratic_fraction">
                                    <span class="num">
                                        @php
                                            for ($j=0; $j<$v; $j++) { 
                                                echo ($weights[$j] * $values[$j]);
                                                $suming=$suming+$values[$j]*$weights[$j];
                                                if ($j != $v-1) {
                                                    echo " +";
                                                }
                                            }
                                        @endphp
                                    </span>
                                    <span>{{$detail['weight_sum']}}</span>
                                </span> 
                            </p>
                            <p class="mt-2 overflow-auto">
                                x̄ = 
                                <span class="quadratic_fraction">
                                    <span class="num">{{$suming}}</span>
                                    <span>{{$detail['weight_sum']}}</span>
                                </span> 
                            </p>
                            <p class="mt-2">
                                x̄ = {{$suming/$detail['weight_sum']}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endisset

</form>
</div>
