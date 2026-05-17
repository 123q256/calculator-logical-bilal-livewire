<div>
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-6">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12 mt-2 px-2"><strong>{{$lang['2']}}(C)(x<sub class="font-s-12">0</sub>, y<sub class="font-s-12">0</sub>)</strong></p>
                    <div class="col-span-12">
                        <label for="x" class="label text-left">{{$lang['3']}} x<sub class="font-s-12 text-blue">0</sub>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="x" id="x" class="input" wire:model.live="x" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="y" class="label text-left">{{$lang['3']}} y<sub class="font-s-12 text-blue">0</sub>:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="y" id="y" class="input" wire:model.live="y" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="a" class="label text-left">{{$lang['3']}} a:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="a" min="1" id="a" class="input" wire:model.live="a" aria-label="input"/>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <label for="b" class="label text-left">{{$lang['3']}} b:</label>
                        <div class="w-full py-2">
                            <input type="number" step="any" name="b" min="1" id="b" class="input" wire:model.live="b" aria-label="input"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-6 text-center text-[18px]" wire:ignore>
                <p class="mt-5"><strong>{{$lang['1']}}</strong></p>
                <p class="mt-2"><strong>\( \frac{(x-x_0)^2}{a} - \frac{(y-y_0)^2}{b} = 1 \)</strong></p>
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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result overflow-auto">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full  text-[18px] overflow-auto">
                                <p class="mt-3"><strong>{{$lang['1']}}</strong></p>
                                <p class="mt-2">\( \frac{(x-({!! $x !!}))^2}{ {!! $a !!} } - \frac{(y-({!! $y !!}))^2}{ {!! $b !!} } = 1 \)</p>
                                <p class="mt-3"><strong>{{$lang['4']}}</strong></p>
                                <p class="mt-2">\( ({!! $x.','.$y !!}) \)</p>
                                <p class="mt-3"><strong>{{$lang['5']}}</strong></p>
                                <p class="mt-2">\( ({!! $x !!}-{!! $detail['ashow'] !!},{!! $y !!}) \approx ({!! $detail['v1'] !!}), ({!! $x !!}+{!! $detail['ashow'] !!},{!! $y !!}) \approx ({!! $detail['v2'] !!}) \)</p>
                                <p class="mt-3"><strong>{{$lang['6']}}</strong></p>
                                <p class="mt-2">\( ({!! $x !!},{!! $y !!}-{!! $detail['bshow'] !!}) \approx ( {!! $x !!},{!! $detail['v21'] !!}), ({!! $x !!},{!! $y !!}+{!! $detail['bshow'] !!}) \approx ( {!! $x !!},{!! $detail['v22'] !!}) \)</p>
                                <p class="mt-3"><strong>{{$lang['7']}}</strong></p>
                                <p class="mt-2">\( \frac{ {!! $detail['cshow'] !!} }{ {!! $detail['ashow'] !!} } \approx {!! round($detail['ecc'], 4) !!} \)</p>
                                <p class="mt-3"><strong>{{$lang['8']}}</strong></p>
                                <p class="mt-2">
                                    @if ($detail['cshow'] == $detail['c'])
                                        \( {!! $detail['c'] !!} \)
                                    @else
                                        \( {!! $detail['cshow'] !!} \approx {!! round($detail['c'], 4) !!} \)
                                    @endif
                                </p>
                                <p class="mt-3"><strong>{{$lang['9']}}</strong></p>
                                <p class="mt-2">\( \frac{ {!! $b !!}\times{!! $detail['cshow'] !!} }{ {!! $a+$b !!} } \approx {!! round($detail['fp'], 4) !!} \)</p>
                                <p class="mt-3"><strong>{{$lang['10']}}</strong></p>
                                <p class="mt-2">\( 2\times{!! $detail['ashow'] !!} \approx {!! round(2*$detail['as'], 4) !!} \)</p>
                                <p class="mt-3"><strong>{{$lang['11']}}</strong></p>
                                <p class="mt-2">
                                    @if ($detail['ashow'] == $detail['as'])
                                        \( {!! $detail['as'] !!} \)
                                    @else
                                        \( {!! $detail['ashow'] !!} \approx {!! round($detail['as'], 4) !!} \)
                                    @endif
                                </p>
                                <p class="mt-3"><strong>{{$lang['12']}}</strong></p>
                                <p class="mt-2">\( 2\times{!! $detail['bshow'] !!} \approx {!! round(2*$detail['bs'], 4) !!} \)</p>
                                <p class="mt-3"><strong>{{$lang['11']}}</strong></p>
                                <p class="mt-2">
                                    @if ($detail['bshow'] == $detail['bs'])
                                        \( {!! $detail['bs'] !!} \)
                                    @else
                                        \( {!! $detail['bshow'] !!} \approx {!! round($detail['bs'], 4) !!} \)
                                    @endif
                                </p>
                                <p class="mt-3"><strong>{{$lang['13']}}</strong></p>
                                <p class="mt-2">\( y = - \frac{ {!! $detail['bshow'] !!}\times{!! $detail['ashow'] !!}(x - ({!! $x !!}))}{ {!! $a !!} } + ({!! $y !!}) \)</p>
                                <p class="mt-3"><strong>{{$lang['14']}}</strong></p>
                                <p class="mt-2">\( y = \frac{ {!! $detail['bshow'] !!}\times{!! $detail['ashow'] !!}(x - ({!! $x !!}))}{ {!! $a !!} } + ({!! $y !!}) \)</p>
                                <p class="mt-3"><strong>{{$lang['15']}}</strong></p>
                                <p class="mt-2">\( x = {!! $x !!} - \frac{ {!! $a !!}\times{!! $detail['cshow'] !!} }{ {!! $a+$b !!} } \approx {!! round($detail['dir1'], 4) !!} \)</p>
                                <p class="mt-3"><strong>{{$lang['16']}}</strong></p>
                                <p class="mt-2">\( x = {!! $x !!} + \frac{ {!! $a !!}\times{!! $detail['cshow'] !!} }{ {!! $a+$b !!} } \approx {!! round($detail['dir2'], 4) !!} \)</p>
                                <p class="mt-3"><strong>{{$lang['17']}}</strong></p>
                                <p class="mt-2">\( x = {!! $x !!} - {!! $detail['cshow'] !!} \approx {!! round($detail['fl1'], 4) !!} \)</p>
                                <p class="mt-3"><strong>{{$lang['18']}}</strong></p>
                                <p class="mt-2">\( x = {!! $x !!} + {!! $detail['cshow'] !!} \approx {!! round($detail['fl2'], 4) !!} \)</p>
                                <p class="mt-3"><strong>{{$lang['19']}}</strong></p>
                                <p class="mt-2">\( \frac{2\times{!! $b !!} \times {!! $detail['ashow'] !!} }{ {!! $a !!} } \approx {!! round((2*$b*$detail['as'])/($a), 4) !!} \)</p>
                                <p class="mt-3"><strong>{{$lang['20']}}</strong></p>
                                <p class="mt-2">\( \left( {!! $x !!} - \frac{ {!! $y.'\\times'.$detail['ashow'] !!} }{ {!! $detail['bshow'] !!} },0\right) \approx ({!! round($x-(($y*$detail['as'])/$detail['bs']), 4) !!},0) , \left( {!! $x !!} + \frac{ {!! $y.'\\times'.$detail['ashow'] !!} }{ {!! $detail['bshow'] !!} },0\right) \approx ({!! round($x+(($y*$detail['as'])/$detail['bs']), 4) !!},0) \)</p>
                                <p class="mt-3"><strong>{{$lang['20']}}</strong></p>
                                <p class="mt-2">\( \left(0, {!! $y !!} - \frac{ {!! $x.'\\times'.$detail['bshow'] !!} }{ {!! $detail['ashow'] !!} }\right) \approx (0,{!! round($y-(($x*$detail['bs'])/$detail['as']), 4) !!}) , \left(0, {!! $y !!} + \frac{ {!! $x.'\\times'.$detail['bshow'] !!} }{ {!! $detail['ashow'] !!} }\right) \approx (0,{!! round($y+(($x*$detail['bs'])/$detail['as']), 4) !!}) \)</p>
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
        <script defer src="{{ url('katex/auto-render.min.js') }}" onload="if (typeof renderMathInElement === 'function') renderMathInElement(document.body);"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            });
        </script>
    @endpush
</form>
</div>
