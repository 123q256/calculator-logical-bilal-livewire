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
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-8">
                <div class="grid grid-cols-12 mt-3  ">
                    <div class="col-span-12">
                        <label for="x" class="label">x:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="x" id="x" class="input" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="a" class="label">a:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="a" id="a" class="input" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="b" class="label">b:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="b" id="b" class="input" aria-label="input"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-4 flex justify-center items-center text-center">
                <p class="font-s-20">
                    <strong>
                        log<sub class="font-s-14">a</sub>(X) = 
                        <span class="quadratic_fraction">
                            <span class="num">log<sub class="font-s-14">b</sub>(X)</span>
                            <span>log<sub class="font-s-14">b</sub>(a)</span>
                        </span>
                    </strong>
                </p>
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
                                        <td class="py-2 border-b">{{safe_round($detail['log_one'], 4)}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-2"><strong>{{$lang['2']}}</strong></p>
                                <p class="mt-2">
                                    log<sub class="text-[14px]">{{$a}}</sub>({{$x}}) = 
                                    <span class="quadratic_fraction">
                                        <span class="num">log<sub class="text-[14px]">{{$b}}</sub>({{$x}})</span>
                                        <span>log<sub class="text-[14px]">{{$b}}</sub>({{$a}})</span>
                                    </span>
                                </p>
                                <p class="mt-2">
                                    log<sub class="text-[14px]">{{$a}}</sub>({{$x}}) = 
                                    <span class="quadratic_fraction">
                                        <span class="num">{{safe_round($detail['log_two'], 4)}}</span>
                                        <span>{{safe_round($detail['log_two_bottom'] ?? $detail['log_two'], 4)}}</span>
                                    </span>
                                </p>
                                <p class="mt-2">
                                    log<sub class="text-[14px]">{{$a}}</sub>({{$x}}) = {{safe_round($detail['log_one'], 4)}}
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
