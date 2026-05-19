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
                        <label for="want" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2">
                            <select class="input" aria-label="select" wire:model.live="want" id="want">
                                <option value="1">{{$lang['2']}}</option>
                                <option value="2">{{$lang['3']}} (%)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="x" class="font-s-14 text-blue" id="changeText">
                            {{ $want === '2' ? 'Doubling Time:' : "$lang[3] (%):" }}
                        </label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model="x" id="x" class="input" aria-label="input"/>
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
                                <div class="w-full text-center text-[20px]">
                                    <p>
                                        @if ($want === "1")
                                            {{$lang['2']}}
                                        @else
                                            {{$lang['3']}}
                                        @endif
                                    </p>
                                    <div class="flex justify-center">
                                        <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3">
                                            {{safe_round($detail['ans'])}} @if($want === "2") (%)@endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>
</div>
