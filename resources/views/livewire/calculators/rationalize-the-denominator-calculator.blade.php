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

<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
                    <div class="col-span-12 flex items-center justify-evenly">
                        <p class="font-s-14 text-blue"><strong>{{ $lang[1] }}:</strong></p>
                        <p id="fInput">
                            <input type="radio" wire:model.live="activeType" id="first" value="first">
                            <label for="first" class="font-s-14 cursor-pointer">{{ $lang['2'] }}</label>
                        </p>
                        <p id="sInput">
                            <input type="radio" wire:model.live="activeType" id="second" value="second">
                            <label for="second" class="font-s-14 cursor-pointer">{{ $lang['3'] }}</label>
                        </p>
                    </div>

                    @if ($activeType === 'first')
                        <div class="col-span-12" id="simpleMethod">
                            <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                                <div class="col-span-12 px-2">
                                    <label for="operations" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                                    <div class="w-100 py-2">
                                        <select wire:model.live="operations" class="input" id="operations" aria-label="select">
                                            <option value="1">{{ $lang[5] }}/{{ $lang[5] }}</option>
                                            <option value="2">{{ $lang[6] }}/{{ $lang[5] }}</option>
                                            <option value="3">{{ $lang[5] }}/{{ $lang[6] }}</option>
                                            <option value="4">{{ $lang[6] }}/{{ $lang[6] }}</option>
                                        </select>
                                    </div>
                                </div>

                                @if ($operations == 1)
                                    <p class="col-span-12 text-[20px] mt-0 mt-lg-2 text-center">
                                        \( \frac{a\sqrt[n]b}{x\sqrt[k]y} \ = \ ? \)
                                    </p>
                                @elseif ($operations == 2)
                                    <p class="col-span-12 text-[20px] mt-0 mt-lg-2 text-center">
                                        \( \frac{ a\sqrt[n]b+c\sqrt[m]d }{ x\sqrt[k]y } \ = \ ? \)
                                    </p>
                                @elseif ($operations == 3)
                                    <p class="col-span-12 text-[20px] mt-0 mt-lg-2 text-center">
                                        \( \frac{ a\sqrt{b} }{ x\sqrt{y}+z\sqrt{u} } \ = \ ? \)
                                    </p>
                                @elseif ($operations == 4)
                                    <p class="col-span-12 text-[20px] mt-0 mt-lg-2 text-center">
                                        \( \frac{ a\sqrt{b}+c\sqrt{d} }{ x\sqrt{y}+k\sqrt{u} } \ = \ ? \)
                                    </p>
                                @endif

                                <p class="col-span-12"><strong>{{ $lang[7] }}</strong></p>
                                
                                <div class="col-span-4" id="aInput">
                                    <label for="a" class="font-s-14 text-blue">a:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="a" id="a" class="input" aria-label="input" />
                                    </div>
                                </div>
                                <div class="col-span-4" id="bInput">
                                    <label for="b" class="font-s-14 text-blue">b:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="b" id="b" class="input" aria-label="input" />
                                    </div>
                                </div>

                                @if ($operations == 1 || $operations == 2)
                                    <div class="col-span-4" id="nInput">
                                        <label for="n" class="font-s-14 text-blue">n:</label>
                                        <div class="w-100 py-2">
                                            <input type="number" step="any" wire:model.live="n" id="n" class="input" aria-label="input" />
                                        </div>
                                    </div>
                                @endif

                                @if ($operations == 2 || $operations == 4)
                                    <div class="col-span-4" id="cInput">
                                        <label for="c" class="font-s-14 text-blue">c:</label>
                                        <div class="w-100 py-2">
                                            <input type="number" step="any" wire:model.live="c" id="c" class="input" aria-label="input" />
                                        </div>
                                    </div>
                                    <div class="col-span-4" id="dInput">
                                        <label for="d" class="font-s-14 text-blue">d:</label>
                                        <div class="w-100 py-2">
                                            <input type="number" step="any" wire:model.live="d" id="d" class="input" aria-label="input" />
                                        </div>
                                    </div>
                                @endif

                                @if ($operations == 2)
                                    <div class="col-span-4" id="mInput">
                                        <label for="m" class="font-s-14 text-blue">m:</label>
                                        <div class="w-100 py-2">
                                            <input type="number" step="any" wire:model.live="m" id="m" class="input" aria-label="input" />
                                        </div>
                                    </div>
                                @endif

                                <p class="col-span-12"><strong>{{ $lang[8] }}</strong></p>

                                <div class="col-span-4" id="xInput">
                                    <label for="x" class="font-s-14 text-blue">x:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="x" id="x" class="input" aria-label="input" />
                                    </div>
                                </div>
                                <div class="col-span-4" id="yInput">
                                    <label for="y" class="font-s-14 text-blue">y:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="y" id="y" class="input" aria-label="input" />
                                    </div>
                                </div>
                                <div class="col-span-4" id="kInput">
                                    <label for="k" class="font-s-14 text-blue">k:</label>
                                    <div class="w-100 py-2">
                                        <input type="number" step="any" wire:model.live="k" id="k" class="input" aria-label="input" />
                                    </div>
                                </div>

                                @if ($operations == 3 || $operations == 4)
                                    <div class="col-span-4" id="uInput">
                                        <label for="u" class="font-s-14 text-blue">u:</label>
                                        <div class="w-100 py-2">
                                            <input type="number" step="any" wire:model.live="u" id="u" class="input" aria-label="input" />
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="col-span-12 mt-0 mt-lg-2" id="advanceMethod">
                            <label for="n1" class="font-s-14 text-blue">{{ $lang[9] }}:</label>
                            <div class="w-100 py-2">
                                <input type="text" wire:model.live="n1" id="n1" class="input" aria-label="input" />
                            </div>
                            <hr class="my-2">
                            <label for="d1" class="font-s-14 text-blue mt-2">{{ $lang[10] }}:</label>
                            <div class="w-100 py-2">
                                <input type="text" wire:model.live="d1" id="d1" class="input" aria-label="input" />
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if ($type == 'calculator')
                @include('inc.button')
            @endif
            @if ($type == 'widget')
                @include('inc.widget-button')
            @endif
        </div>

        @isset($detail)
            <hr>
            <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg space-y-6 result">
                <div>
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                @if ($activeType === 'first')
                                    <div class="w-full text-[16px]">
                                        <p class="mt-3 text-[18px]"><strong>{!! $detail['main_jawab'] !!}</strong></p>
                                        <p class="mt-3"><strong>{{ $lang[12] }}:</strong></p>
                                        <div class="w-full all_result">
                                            {!! $detail['all_result'] !!}
                                        </div>
                                        <p class="mt-3">= &nbsp;&nbsp;&nbsp;&nbsp;<span>{!! $detail['main_jawab'] !!}</span></p>
                                    </div>
                                @else
                                    <div class="w-full text-[16px]">
                                        <p class="mt-3 text-[18px]"><strong>\( {!! $detail['main_ans'] !!} \)</strong></p>
                                        <p class="mt-3"><strong>{{ $lang[12] }}:</strong></p>
                                        <p class="mt-3">\( ={!! $detail['enter'] !!} \)</p>
                                        <p class="mt-3">\( =\dfrac{ {!! $detail['up'] !!} }{ {!! $detail['down'] !!} } \)</p>
                                        <p class="mt-3">\( ={!! $detail['main_ans'] !!} \)</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset

        @push('calculatorJS')
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
            <script defer src="{{ url('katex/katex.min.js') }}"></script>
            <script defer src="{{ url('katex/auto-render.min.js') }}" 
                    onload="renderMathInElement(document.body); window.MJrerender = function() { renderMathInElement(document.body); }"></script>
        @endpush
    </form>
</div>