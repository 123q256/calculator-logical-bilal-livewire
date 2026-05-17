<div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[50%] md:w-[50%] w-full mx-auto ">
           <div class="col-12 col-lg-9 mx-auto mt-2 w-full">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div wire:click="$set('calc_type', 'two')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white tab {{ $calc_type === 'two' ? 'tagsUnit' : '' }}">
                        {{ $lang['10'] ?? '2 Variables' }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div wire:click="$set('calc_type', 'three')" class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300 hover_tags hover:text-white tab {{ $calc_type === 'three' ? 'tagsUnit' : '' }}">
                        {{ $lang['11'] ?? '3 Variables' }}
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-12 mt-3 gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12">
                <label for="eq" class="label">{{ $lang['1'] ?? 'Equation' }}</label>
                <div class="w-100 py-2">
                    <input type="text" wire:model.live="eq" id="eq" class="input" aria-label="input"/>
                </div>
            </div>
            <div class="{{ $calc_type === 'three' ? 'col-span-4':'col-span-6' }}" id="xValue">
                <label for="x" class="label">{{ $lang['2'] ?? 'Enter' }} x:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" wire:model.live="x" id="x" class="input" aria-label="input"/>
                </div>
            </div>
            <div class="{{ $calc_type === 'three' ? 'col-span-4':'col-span-6' }}" id="yValue">
                <label for="y" class="label">{{ $lang['2'] ?? 'Enter' }} y:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" wire:model.live="y" id="y" class="input" aria-label="input"/>
                </div>
            </div>
            <div class="col-span-4 {{ $calc_type === 'three' ? '':'hidden' }}" id="zValue">
                <label for="z" class="label">{{ $lang['2'] ?? 'Enter' }} z:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" wire:model.live="z" id="z" class="input" aria-label="input"/>
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
                        @php
                            $submit = $detail['calc_type'] ?? 'two';
                            $eq=$detail['eq'] ?? '';
                            $t=$detail['t'] ?? '';
                            $diffa=$detail['diffa'] ?? '';
                            $diffb=$detail['diffb'] ?? '';
                            $stepsx=$detail['stepsx'] ?? '';
                            $stepsy=$detail['stepsy'] ?? '';
                            $a=$detail['a'] ?? '';
                            $b=$detail['b'] ?? '';
                            $c=$detail['c'] ?? '';
                            $s1=preg_replace('/x/',"($x)",$diffa);
                            $s1=preg_replace('/y/',"($y)",$s1);
                            $s2=preg_replace('/x/',"($x)",$diffb);
                            $s2=preg_replace('/y/',"($y)",$s2);
                            $s3=preg_replace('/x/',"($x)",$eq);
                            $s3=preg_replace('/y/',"($y)",$s3);
                        @endphp
                        <div class="w-full text-[16px]">
                            @if($submit==='two')
                                <p class="mt-3 text-[18px]">\( z = {!! preg_replace('/frac/','dfrac',$t) !!} \)</p>
                                <p class="mt-3"><strong>{{ $lang['5'] ?? 'Equation of Tangent Plane' }}:</strong></p>
                                <p class="mt-3">{{ $lang['6'] ?? 'Formula' }}:</p>
                                <p class="mt-3">\( z = a(x - x_0) + b(y - y_0) + z_0 \)</p>
                                <p class="mt-3">{{ $lang['7'] ?? 'Derivative' }} w.r.t (x): \( f'(x) \)</p>
                                <p class="mt-3">\( {!! $diffa !!} \)</p>
                                
                                <div x-data="{ open: false }">
                                    <div class="w-full my-3">
                                        <button type="button" @click="open = !open" class="calculate" style="font-size: 16px;padding: 10px;cursor: pointer;">{{ $lang['13'] ?? 'Show Steps' }}</button>
                                    </div>
                                    <div x-show="open" class="w-full res_step" style="display: none;">
                                        {!! $stepsx !!}
                                    </div>
                                </div>

                                <p class="mt-3">{{ $lang['7'] ?? 'Derivative' }} w.r.t (y): \( f'(y) \)</p>
                                <p class="mt-3">\( {!! $diffb !!} \)</p>
                                
                                <div x-data="{ open: false }">
                                    <div class="w-full my-3">
                                        <button type="button" @click="open = !open" class="calculate" style="font-size: 16px;padding: 10px;cursor: pointer;">{{ $lang['13'] ?? 'Show Steps' }}</button>
                                    </div>
                                    <div x-show="open" class="w-full res_step" style="display: none;">
                                        {!! $stepsy !!}
                                    </div>
                                </div>

                                <p class="mt-3">{{ $lang['8'] ?? 'Evaluating' }} (a):</p>
                                <p class="mt-3">\( f_x = {!! $diffa !!} \)</p>
                                <p class="mt-3">\( f_x({{ $x }}, {{ $y }}) = {!! $s1 !!} \)</p>
                                <p class="mt-3">\( f_x({{ $x }}, {{ $y }}) = {!! $a !!} \)</p>
                                <p class="mt-3">{{ $lang['8'] ?? 'Evaluating' }} (b):</p>
                                <p class="mt-3">\( f_y = {!! $diffb !!} \)</p>
                                <p class="mt-3">\( f_y({{ $x }}, {{ $y }}) = {!! $s2 !!} \)</p>
                                <p class="mt-3">\( f_y({{ $x }}, {{ $y }}) = {!! $b !!} \)</p>
                                <p class="mt-3">{{ $lang['8'] ?? 'Evaluating' }} \( (z_0) \):</p>
                                <p class="mt-3">\( f(x, y) = {!! $eq !!} \)</p>
                                <p class="mt-3">\( f({{ $x }}, {{ $y }}) = {!! $s3 !!} \)</p>
                                <p class="mt-3">\( f({{ $x }}, {{ $y }}) = {!! $c !!} \)</p>
                                <p class="mt-3">Finally, {{ $lang['8'] ?? 'Evaluating' }} (z):</p>
                                <p class="mt-3">\( x_0 = {{ $x }}, \space y_0 = {{ $y }}, \space z_0 = {{ $c }} \)</p>
                                <p class="mt-3">\( z = a(x - x_0) + b(y - y_0) + z_0 \)</p>
                                <p class="mt-3">\( z = ({{ $a }})(x - ({{ $x }})) + ({{ $b }})(y - ({{ $y }})) + ({{ $c }}) \)</p>
                                <p class="mt-3">\( z = \color{#1670a7}{{!! $t !!}} \)</p>
                            @else
                                @php
                                    $diffc=$detail['diffc'] ?? '';
                                    $stepsz=$detail['stepsz'] ?? '';
                                    $ans=$detail['ans'] ?? '';
                                    $s1=preg_replace('/x/',"($x)",$diffa);
                                    $s1=preg_replace('/y/',"($y)",$s1);
                                    $s1=preg_replace('/z/',"($z)",$s1);
                                    $s2=preg_replace('/x/',"($x)",$diffb);
                                    $s2=preg_replace('/y/',"($y)",$s2);
                                    $s2=preg_replace('/z/',"($z)",$s2);
                                    $s3=preg_replace('/x/',"($x)",$diffc);
                                    $s3=preg_replace('/y/',"($y)",$s3);
                                    $s3=preg_replace('/z/',"($z)",$s3);
                                @endphp
                                <p class="mt-3 text-[18px]">\( z = {!! preg_replace('/frac/','dfrac',$detail['ans']) !!} \)</p>
                                <p class="mt-3"><strong>{{ $lang['5'] ?? 'Equation of Tangent Plane' }}:</strong></p>
                                <p class="mt-3">{{ $lang['6'] ?? 'Formula' }}:</p>
                                <p class="mt-3">\( a(x - x_0) + b(y - y_0) + c(z - z_0) = 0 \)</p>
                                <p class="mt-3">{{ $lang['7'] ?? 'Derivative' }} w.r.t (x): \( f'(x) \)</p>
                                <p class="mt-3">\( {!! $diffa !!} \)</p>
                                
                                <div x-data="{ open: false }">
                                    <div class="w-full my-3">
                                        <button type="button" @click="open = !open" class="calculate" style="font-size: 16px;padding: 10px;cursor: pointer;">{{ $lang['13'] ?? 'Show Steps' }}</button>
                                    </div>
                                    <div x-show="open" class="w-full res_step" style="display: none;">
                                        {!! $stepsx !!}
                                    </div>
                                </div>

                                <p class="mt-3">{{ $lang['7'] ?? 'Derivative' }} w.r.t (y): \( f'(y) \)</p>
                                <p class="mt-3">\( {!! $diffb !!} \)</p>
                                
                                <div x-data="{ open: false }">
                                    <div class="w-full my-3">
                                        <button type="button" @click="open = !open" class="calculate" style="font-size: 16px;padding: 10px;cursor: pointer;">{{ $lang['13'] ?? 'Show Steps' }}</button>
                                    </div>
                                    <div x-show="open" class="w-full res_step" style="display: none;">
                                        {!! $stepsy !!}
                                    </div>
                                </div>

                                <p class="mt-3">{{ $lang['7'] ?? 'Derivative' }} w.r.t (z): \( f'(z) \)</p>
                                <p class="mt-3">\( {!! $diffc !!} \)</p>
                                
                                <div x-data="{ open: false }">
                                    <div class="w-full my-3">
                                        <button type="button" @click="open = !open" class="calculate" style="font-size: 16px;padding: 10px;cursor: pointer;">{{ $lang['13'] ?? 'Show Steps' }}</button>
                                    </div>
                                    <div x-show="open" class="w-full res_step" style="display: none;">
                                        {!! $stepsz !!}
                                    </div>
                                </div>

                                <p class="mt-3">{{ $lang['8'] ?? 'Evaluating' }} (a):</p>
                                <p class="mt-3">\( f_x = {!! $diffa !!} \)</p>
                                <p class="mt-3">\( f_x({{ $x }}, {{ $y }}, {{ $z }}) = {!! $s1 !!} \)</p>
                                <p class="mt-3">\( f_x({{ $x }}, {{ $y }}, {{ $z }}) = {!! $a !!} \)</p>
                                <p class="mt-3">{{ $lang['8'] ?? 'Evaluating' }} (b):</p>
                                <p class="mt-3">\( f_y = {!! $diffb !!} \)</p>
                                <p class="mt-3">\( f_y({{ $x }}, {{ $y }}, {{ $z }}) = {!! $s2 !!} \)</p>
                                <p class="mt-3">\( f_y({{ $x }}, {{ $y }}, {{ $z }}) = {!! $b !!} \)</p>
                                <p class="mt-3">{{ $lang['8'] ?? 'Evaluating' }} (c):</p>
                                <p class="mt-3">\( f(x, y) = {!! $diffc !!} \)</p>
                                <p class="mt-3">\( f({{ $x }}, {{ $y }}, {{ $z }}) = {!! $s3 !!} \)</p>
                                <p class="mt-3">\( f({{ $x }}, {{ $y }}, {{ $z }}) = {!! $c !!} \)</p>
                                <p class="mt-3">{{ $lang['9'] ?? 'Substituting' }}, {{ $lang['8'] ?? 'Evaluating' }} {{ $lang['4'] ?? 'values' }}:</p>
                                <p class="mt-3">\( x_0 = {{ $x }}, \space y_0 = {{ $y }}, \space z_0 = {{ $z }} \)</p>
                                <p class="mt-3">\( a(x - x_0) + b(y - y_0) + c(z - z_0) = 0 \)</p>
                                <p class="mt-3">\( ({{ $a }})(x - ({{ $x }})) + ({{ $b }})(y - ({{ $y }})) + ({{ $c }})(z - ({{ $z }})) = 0 \)</p>
                                <p class="mt-3">\( {!! $t !!} = 0 \)</p>
                                <p class="mt-3">{{ $lang['12'] ?? 'Answer' }}:</p>
                                <p class="mt-3">\( z = \color{#ff6d00}{{!! $ans !!}} \)</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>

@push('calculatorJS')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML"></script>
    <script>
        window.addEventListener('load', function() {
            if (window.MathJax) {
                MathJax.Hub.Config({
                    "HTML-CSS": { linebreaks: { automatic: true } },
                    "CommonHTML": { linebreaks: { automatic: true } }
                });
            }
        });
        function MJrerender() {
            if (window.MathJax) {
                MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
            }
        }
    </script>
@endpush
</div>
