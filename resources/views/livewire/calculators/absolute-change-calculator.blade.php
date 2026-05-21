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

               <div class="col-span-12">
                    <label for="initial" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model.live="initial" id="initial" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="final" class="label">{{ $lang['2'] }}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" wire:model.live="final" id="final" class="input" aria-label="input" />
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
                                <table class="w-full font-s-18">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang[3] }} is</strong></td>
                                        <td class="py-2 border-b">{{safe_round($detail['answer'])}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px] mt-2">
                                <p><strong>{{$lang[5]}}</strong></p>
                                <p class="mt-2">{{$lang[1]}} = {{$initial}}</p>
                                <p class="mt-2">{{$lang[2]}} = {{$final}}</p>
                                <p class="mt-2"><strong>{{$lang[4]}}</strong></p>
                                <p class="mt-2">Formula = {{$lang[2]}} - {{$lang[1]}}</p>
                                <p class="mt-2">{{$lang[3]}} = {{$final}} - {{$initial}}</p>
                                <p class="mt-2">{{$lang[3]}} = {{safe_round($detail['answer'])}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</form>
</div>
