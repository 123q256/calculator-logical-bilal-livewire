<div>
 <form wire:submit.prevent="calculate">


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-6">
                <label for="x1" class="label">{{$lang['1']}} x₁</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="x1" id="x1" class="input" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="y1" class="label">{{$lang['1']}} y₁</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="y1" id="y1" class="input" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="x2" class="label">{{$lang['1']}} x₂</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="x2" id="x2" class="input" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="y2" class="label">{{$lang['1']}} y₂</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="y2" id="y2" class="input" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="x3" class="label">{{$lang['1']}} x₃</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="x3" id="x3" class="input" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-6">
                <label for="y3" class="label">{{$lang['1']}} y₃</label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.live="y3" id="y3" class="input" aria-label="input"/>
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
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full text-center  text-[20px]">
                                <p>{{$lang['2']}}</p>
                                <p class="my-3"><strong class="bg-[#2845F5] text-white px-3 py-2 text-[32px] rounded-lg text-blue">({{safe_round($detail['x'], 5)}} , {{safe_round($detail['y'], 5)}})</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
</div>
