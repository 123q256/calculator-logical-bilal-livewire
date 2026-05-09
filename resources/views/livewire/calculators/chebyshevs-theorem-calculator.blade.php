<div>
    <form wire:submit.prevent="calculate">
        <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg space-y-6 my-3">
            @if ($error)
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
            @endif
            <div class="lg:w-[60%] md:w-[60%] w-full mx-auto">
                <div class="grid grid-cols-1 gap-4">
                    <div class="col-span-12 px-2">
                        <label for="operation" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                        <div class="w-100 py-2 position-relative">
                            <select wire:model.live="operations" id="operation" class="input">
                                <option value="3">{{ $lang[2] }} 1</option>
                                <option value="4">{{ $lang[2] }} 2</option>
                                <option value="5">{{ $lang[3] }}</option>
                                <option value="6">{{ $lang[4] }}</option>
                            </select>
                        </div>
                    </div>

                    {{-- First Parameter Field --}}
                    <div class="col-span-12 px-2">
                        <label for="first" class="font-s-14 text-blue">
                            @if ($operations == '5') {{ $lang[3] }} (p):
                            @elseif ($operations == '6') {{ $lang[4] }}:
                            @else {{ $lang['5'] }} (k):
                            @endif
                        </label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" wire:model.live="first" id="first" class="input" placeholder="00" />
                        </div>
                    </div>

                    {{-- Second Parameter Field (σ²) --}}
                    @if (in_array($operations, ['3', '4']))
                        <div class="col-span-12 px-2">
                            <label for="second" class="font-s-14 text-blue">{{ $lang['6'] }} (σ²):</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="second" id="second" class="input" placeholder="00" />
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
                <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                @if ($detail['operations'] == 3 || $detail['operations'] == 4)
                                    <div class="text-center">
                                        <p class="text-[20px]">
                                            <strong>{{ $lang['7'] }}</strong>
                                        </p>
                                        <div class="flex justify-center">
                                            <p class="text-[30px] w-auto bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                                <strong class="text-white">{{ $detail['final_sans'] }}%</strong>
                                            </p>
                                        </div>
                                    </div>
                                    <p class="w-full mt-3 text-[18px] text-center"> {{ $lang[9] }} <strong>{{ $detail['pehla'] }}</strong>, {{ $lang[10] }} E(X) {{ $lang[11] }} <strong>{{ $detail['final_fans'] }}</strong>.</p>
                                @elseif($detail['operations'] == 5)
                                    <div class="text-center">
                                        <p class="text-[18px]">
                                            <strong>{{ $lang['7'] }}</strong>
                                        </p>
                                        <p class="text-[25px] bg-sky px-3 py-2 radius-10 d-inline-block my-3">
                                            <strong class="text-blue">$$ P( |X - μ| < kσ ) \geqslant {{ $detail['final_sans'] }} $$</strong>
                                        </p>
                                    </div>
                                    <p class="w-full mt-3 text-[20px]"> <b class="text-blue">{{ $lang[12] }}</b></p>
                                    <p class="w-full mt-2 text-[18px]">{{ $lang[13] }} x {{ $lang[14] }} <strong>{{ $first }}</strong> {{ $lang[15] }}?</p>
                                    <p class="w-full mt-3 text-[20px]"> <b class="text-blue">{{ $lang[8] }}:</b></p>
                                    <p class="w-full mt-2 text-[18px]">{{ $lang[16] }}:</p>
                                    <p class="w-full mt-2 text-center">
                                        $$ P( |X - μ| < kσ ) \geqslant 1 - \frac{1}{k^2} $$
                                    </p>
                                    <p class="w-full mt-2 text-[18px]">
                                        {{ $lang[17] }} <strong>{{ $first }}</strong> {{ $lang[18] }}:
                                    </p>
                                    <p class="w-full mt-2 text-center">
                                        $$ P( |X - μ| < {{ $first }}σ ) \geqslant 1 - \frac{1}{ {{ $first }}^2 } $$
                                    </p>
                                    <p class="w-full mt-2 text-center">
                                        $$ P( |X - μ| < {{ $first }}σ ) \geqslant 1 - \frac{1}{ {{ $detail['pehla'] }} } $$
                                    </p>
                                    <p class="w-full mt-2 text-center">
                                        $$ P( |X - μ| < kσ ) \geqslant 1 - {{ $detail['final_fans'] }} $$
                                    </p>
                                    <p class="w-full mt-2 text-center">
                                        $$ P( |X - μ| < kσ ) \geqslant {{ $detail['final_sans'] }} $$
                                    </p>
                                @elseif($detail['operations'] == 6)
                                    <div class="text-center">
                                        <p class="text-[18px]">
                                            <strong>{{ $lang['7'] }}</strong>
                                        </p>
                                        <p class="text-[25px] bg-sky px-3 py-2 radius-10 d-inline-block my-3">
                                            <strong class="text-blue">$$ k = {{ $detail['final_sans'] }} $$</strong>
                                        </p>
                                    </div>
                                    <p class="w-full mt-2 text-[20px]"> <b class="text-blue">{{ $lang[12] }}</b></p>
                                    <p class="w-full mt-2 text-[18px]"> {{ $lang[19] }} k {{ $lang[20] }} x {{ $lang[21] }} k {{ $lang[22] }}:</p>
                                    <p class="w-full mt-2 text-center">
                                        $$ k = \sqrt{\frac{1}{1 - P(x - μ < kσ)}} $$
                                    </p>
                                    <p class="w-full mt-2 text-[20px]"> <b class="text-blue">{{ $lang[8] }}:</b></p>
                                    <p class="w-full mt-2"> $$ \text{ {{ $lang[23] }} } P( x - μ < kσ ) = {{ $first }} , \text{ {{ $lang[24] }} :} $$ </p>
                                    <p class="w-full mt-2 text-center">
                                        $$ k = \sqrt{\frac{1}{1 - {{ $first }} }} $$
                                    </p>
                                    <p class="w-full mt-2 text-center">
                                        $$ k = \sqrt{\frac{1}{ {{ $detail['pehla'] }} }} $$
                                    </p>
                                    <p class="w-full mt-2 text-center">
                                        $$ k = \sqrt{ {{ $detail['final_fans'] }} } $$
                                    </p>
                                    <p class="w-full mt-2 text-center">
                                        $$ k = {{ $detail['final_sans'] }} $$
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </form>

    @push('calculatorJS')
        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
        <script defer src="{{ url('katex/katex.min.js') }}"></script>
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
    @endpush
</div>
