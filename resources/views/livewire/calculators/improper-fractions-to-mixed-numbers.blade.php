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
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[20%] md:w-[20%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 text-center">
                        <input type="number" step="any" wire:model.live="uper" id="uper" class="input mb-2 text-center" aria-label="numerator" placeholder="7"/>
                        <hr class="border-gray-400 my-2">
                        <input type="number" step="any" wire:model.live="btm" id="btm" class="input mt-2 text-center" aria-label="denominator" placeholder="3"/>
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
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                <div class="col-12 text-[16px]">
                                    <p class="mt-2 text-[18px]">
                                        @if(isset($detail['rem']))
                                            @if($detail['rem'] != 0)
                                                \( {{ $detail['q'] }} \dfrac{ {{ $detail['rem'] }} }{ {{ $btm }} } \)
                                            @else
                                                \( {{ $detail['q'] }} \)
                                            @endif
                                        @else
                                            \( \dfrac{ {{ $uper }} }{ {{ $btm }} } \)
                                        @endif
                                    </p>
                                    <p class="mt-2"><strong>{{$lang['2']}}:</strong></p>
                                    @if(isset($detail['rem']))
                                        <p class="mt-2">{{$lang['3']}}</p>
                                        <p class="mt-2">{{$lang['4']}} ÷ {{$lang['5']}} = {{$lang['6']}} <b>R</b> {{$lang['7']}}</p>
                                        <p class="mt-2">{{$uper}} ÷ {{$btm}} = {{$detail['q']}} <b>R</b> {{$detail['rem']}}</p>
                                        <p class="mt-2">
                                            {{$lang['8']}}
                                            @if($detail['rem'] == 0)
                                                {{$lang['9']}}
                                            @endif
                                        </p>
                                        @if($detail['rem'] != 0)
                                            <p class="mt-2">\( = \text{ {{$lang['6']}} } \dfrac{\text{ {{$lang['7']}} }}{\text{ {{$lang['10']}}  }} \)</p>
                                            <p class="mt-2">\( \dfrac{{{$uper}}}{{{$btm}}} = {{$detail['q']}} \dfrac{{{$detail['rem']}}}{{{$btm}}} \)</p>
                                        @else
                                            <p class="mt-2">\( \dfrac{{{$uper}}}{{{$btm}}} = {{$detail['q']}} \)</p>
                                        @endif
                                    @else
                                        <p class="mt-2">{{$lang['11']}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset

        @push('calculatorJS')
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
            <script defer src="{{ url('katex/katex.min.js') }}"></script>
            <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
        @endpush
    </form>
</div>
