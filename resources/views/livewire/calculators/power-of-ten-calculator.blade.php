<div>
    @php
        if (!function_exists('safe_round')) {
            function safe_round($val, $precision = 5) {
                if ($val === 'NAN' || $val === 'NaN' || (is_numeric($val) && is_nan((float)$val))) {
                    return 'NAN';
                }
                if ($val === 'INF' || $val === 'INF' || $val === 'infinity' || $val === 'Infinity' || (is_numeric($val) && is_infinite((float)$val))) {
                    return 'INF';
                }
                return is_numeric($val) ? round((float)$val, $precision) : $val;
            }
        }
    @endphp
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[40%] md:w-[40%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <p class="col-span-12 text-center my-2 text-[21px]"><strong>10<sup class="font-s-14">x</sup> = a</strong></p>
            <div class="col-span-12 mt-0 mt-lg-2">
                <label for="input" class="font-s-14 text-blue">{{$lang['1']}} (x):</label>
                <div class="w-full py-2 relative">
                    <input type="number" step="any" wire:model.live="input" id="input" class="input" aria-label="input"/>
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
                                        <td class="py-2 border-b" width="60%"><strong>{{$lang['2']}} (a)</strong></td>
                                        <td class="py-2 border-b">{{ safe_round($detail['result']) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['5']}}</strong></p>
                                <p class="mt-2">(10)<sup class="font-s-14">x</sup> = (10)<sup class="font-s-14">{{$input}}</sup></p>
                                <p class="mt-2">{{$lang[6]}}</p>
                                <p class="mt-2">
                                    (10)<sup class="font-s-14">{{$input}}</sup> = 
                                    @php
                                        for($i=0; $i < round((float)$input); $i++){
                                            $mul='×';
                                            if($i+1==round((float)$input)){
                                                $mul='';
                                            }
                                            echo " 10 ".$mul;
                                        }   
                                    @endphp
                                </p>
                                <p class="mt-2">{{$lang[4]}} (a)</p>
                                <p class="mt-2">(10)<sup class="font-s-14">{{$input}}</sup> = {{ safe_round($detail['result']) }}</p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
    @endisset
</form>
</div>
