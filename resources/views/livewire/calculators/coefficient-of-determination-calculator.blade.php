<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="textarea" class="font-s-14 text-blue">{{ $lang['1'] }} (,):</label>
                    <div class="w-100 py-2">
                        <textarea wire:model.live="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 12, 23, 45, 33, 65, 54, 54"></textarea>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="textarea1" class="font-s-14 text-blue">{{ $lang['2'] }} (,):</label>
                    <div class="w-100 py-2">
                        <textarea wire:model.live="y" id="textarea1" class="textareaInput" aria-label="input" placeholder="e.g. 17, 10, 20, 14, 35"></textarea>
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
    <div id="result-section" 
         x-init="setTimeout(() => { if(typeof renderMathInElement === 'function') renderMathInElement($el) }, 100)"
         wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
            @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="w-full">
                        <div class="w-full  mt-2 overflow-auto">
                            <table class="w-full">
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $lang["5"] }} <i class="text-blue">(R<sup class="text-blue">2</sup>)</i></strong></td>
                                    <td class="p-2 border-b"><b>{{ $detail['r2'] }}</b></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b"><strong class="text-blue">{{ $lang["4"] }} <i class="text-blue">(r)</i></strong></td>
                                    <td class="p-2 border-b"><b>{{ $detail['r'] }}</b></td>
                                </tr>
                            </table>
                        </div>
                        <p class="w-full  mt-2"><strong>{{$lang['6']}}, <span class="text-blue">{{ $detail['r2']*100 }}%</span> {{$lang['7']}} y {{$lang['8']}} x.</strong></p>
                        <p class="w-full font-s-20 mt-3"><strong class="text-blue">{{$lang['9']}}:</strong></p>
                        <p class="w-full font-s-18 mt-2"><strong class="text-blue">Method 1</strong></p>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                            {!! $detail['table'] !!}
                        </div>
                        <p class="w-full mt-2">{{$lang['9']}} (n) = \( {{ $detail['n'] }} \)</p>
                        <p class="w-full mt-3"><strong>{{$lang['5']}} \( SS_{xx} \)</strong></p>
                        <p class="w-full mt-2">\( SS_{xx} = \displaystyle \sum_{i=1}^n X_{i}^2 - \frac{1}{n} \left( \sum_{i=1}^n X_{i}^2 \right)^2 \)</p>
                        <p class="w-full mt-2">\( SS_{xx} = {{ $detail['sumxi'] }} - \dfrac{1}{{{ $detail['n'] }}} \normalsize{* {{ $detail['sumx2'] }}} \)</p>
                        <p class="w-full mt-2">\( SS_{xx} = {{ $detail['ssxx'] }} \)</p>
                        
                        <p class="w-full overflow-auto mt-3"><strong>{{$lang['5']}} \( SS_{yy} \)</strong></p>
                        <p class="w-full overflow-auto mt-2">\( SS_{yy} = \displaystyle \sum_{i=1}^n Y_{i}^2 - \frac{1}{n} \left( \sum_{i=1}^n Y_{i}^2 \right)^2 \)</p>
                        <p class="w-full overflow-auto mt-2">\( SS_{yy} = {{ $detail['sumyi'] }} - \dfrac{1}{{{ $detail['n'] }}} \normalsize{* {{ $detail['sumy2'] }}} \)</p>
                        <p class="w-full overflow-auto mt-2">\( SS_{yy} = {{ $detail['ssyy'] }} \)</p>
                        
                        <p class="w-full overflow-auto mt-3"><strong>{{$lang['5']}} \( SS_{xy} \)</strong></p>
                        <p class="w-full overflow-auto mt-2">\( SS_{xy} = \displaystyle \sum_{i=1}^n X_{i}^2 Y_{i}^2 - \frac{1}{n} \left( \sum_{i=1}^n X_{i}^2 \right) \left( \sum_{i=1}^n Y_{i}^2 \right) \)</p>
                        <p class="w-full overflow-auto mt-2">\( SS_{xy} = {{ $detail['sumxy'] }} - \dfrac{1}{{{ $detail['n'] }}} \normalsize{* {{ $detail['sumx'] * $detail['sumy'] }}} \)</p>
                        <p class="w-full overflow-auto mt-2">\( SS_{xy} = {{ $detail['ssxy'] }} \)</p>
                        
                        <p class="w-full overflow-auto mt-3"><strong>{{$lang['5']}} {{$lang['4']}} \( (r) \)</strong></p>
                        <p class="w-full overflow-auto mt-2">\( r = \dfrac{SS_{xy}}{\sqrt{SS_{xx} SS_{yy}}} \)</p>
                        <p class="w-full overflow-auto mt-2">\( r = \dfrac{ {{ $detail['ssxy'] }} }{\sqrt{ {{ $detail['ssxx'] }} * {{ $detail['ssyy'] }} }} \)</p>
                        <p class="w-full overflow-auto mt-2">\( r = {{ $detail['r'] }} \)</p>
                        
                        <p class="w-full mt-3"><strong>{{$lang['5']}} {{$lang['3']}} \( (R^2) \)</strong></p>
                        <p class="w-full mt-2">\( R^2 = ({{ $detail['r'] }})^2 \)</p>
                        <p class="w-full mt-2">\( R^2 = {{ $detail['r2'] }} \)</p>
        
                        <p class="w-full font-s-18 mt-2"><strong class="text-blue">Method 2</strong></p>
                        <p class="w-full overflow-auto mt-2">{{$lang['9']}} (n) = \( {{ $detail['n'] }} \)</p>
                        <p class="w-full overflow-auto mt-3"><strong>{{$lang['5']}} {{$lang['4']}} \( (r) \)</strong></p>
                        <p class="w-full overflow-auto mt-2">\( r = \dfrac{\displaystyle \sum_{i=1}^n (x - \bar x)(y - \bar y)}{(n - 1) \left(s \displaystyle \sum_{i=1}^n X_{i} \right) \left(s \displaystyle \sum_{i=1}^n Y_{i} \right)} \)</p>
                        <p class="w-full overflow-auto mt-2">\( r = \dfrac{ {{ $detail['s1'] }} }{({{ $detail['n'] }}-1) * {{ $detail['s_d'] }} * {{ $detail['s_d1'] }} } \)</p>
                        <p class="w-full overflow-auto mt-2">\( r = \dfrac{ {{ $detail['s2'] }} }{({{ $detail['n']-1 }}) * {{ $detail['s_d'] }} * {{ $detail['s_d1'] }} } \)</p>
                        <p class="w-full overflow-auto mt-2">\( r = \dfrac{ {{ $detail['s3'] }} }{ {{ $detail['s11'] }} } \)</p>
                        <p class="w-full overflow-auto mt-2">\( r = \dfrac{ {{ $detail['ssxy'] }} }{ {{ $detail['s11'] }} } \)</p>
                        <p class="w-full overflow-auto mt-2">\( r = {{ $detail['r'] }} \)</p>
                        
                        <p class="w-full overflow-auto mt-3"><strong>{{$lang['5']}} {{$lang['3']}} \( (R^2) \)</strong></p>
                        <p class="w-full overflow-auto mt-2">\( R^2 = ({{ $detail['r'] }})^2 \)</p>
                        <p class="w-full overflow-auto mt-2">\( R^2 = {{ $detail['r2'] }} \)</p>
        
                        <p class="w-full font-s-18 mt-2"><strong class="text-blue">Method 3</strong></p>
                        <p class="w-full mt-2">{{$lang['9']}} (n) = \( {{ $detail['n'] }} \)</p>
                        <p class="w-full mt-2">ȳ = \( {{ $detail['meany'] }} \)</p>
                        <p class="w-full mt-2">{{$lang['11']}} = \( {{ $detail['a'].'x + '.$detail['b'] }} \)</p>
                        <p class="w-full mt-3"><strong>{{$lang['5']}} {{$lang['12']}} (SST)</strong></p>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                            {!! $detail['sst_table'] !!}
                        </div>
                        <p class="w-full mt-2"><strong>SST \( = {{ $detail['sst'] }} \)</strong></p>
                        <p class="w-full mt-3"><strong>{{$lang['5']}} {{$lang['13']}} (SSR)</strong></p>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                            {!! $detail['ssr_table'] !!}
                        </div>
                        <p class="w-full mt-2"><strong>SSR \( = {{ $detail['ssr'] }} \)</strong></p>
                        <p class="w-full mt-3"><strong>{{$lang['5']}} {{$lang['14']}} (SSE)</strong></p>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                            {!! $detail['sse_table'] !!}
                        </div>
                        <p class="w-full mt-2"><strong>SSE \( = {{ $detail['sse'] }} \)</strong></p>
                        
                        <p class="w-full mt-3"><strong>{{$lang['5']}} {{$lang['3']}} \( (R^2) \)</strong></p>
                        <p class="w-full mt-2">\( R^2 = \dfrac{SSR}{SST} \)</p>
                        <p class="w-full mt-2">\( R^2 = \dfrac{ {{ $detail['ssr'] }} }{ {{ $detail['sst'] }} } \)</p>
                        <p class="w-full mt-2">\( R^2 = {{ ($detail['sst'] != 0) ? round($detail['ssr']/$detail['sst'], 4) : 0 }} \)</p>
                        <p class="w-full mt-2"><strong>OR</strong></p>
                        <p class="w-full mt-2">\( R^2 = \dfrac{1 - SSE}{SST} \)</p>
                        <p class="w-full mt-2">\( R^2 = 1 - {{ ($detail['sst'] != 0) ? round($detail['sse']/$detail['sst'], 4) : 0 }} \)</p>
                        <p class="w-full mt-2">\( R^2 = {{ ($detail['sst'] != 0) ? round(1-($detail['sse']/$detail['sst']), 4) : 0 }} \)</p>
                        <p class="w-full mt-2"><strong>OR</strong></p>
                        <p class="w-full mt-2">\( R^2 = \dfrac{SSR}{SSR + SSE} \)</p>
                        <p class="w-full mt-2">\( R^2 = \dfrac{ {{ $detail['ssr'] }} }{ {{ $detail['ssr'] }} + {{ $detail['sse'] }} } \)</p>
                        <p class="w-full mt-2">\( R^2 = \dfrac{ {{ $detail['ssr'] }} }{ {{ $detail['ssr'] + $detail['sse'] }} } \)</p>
                        <p class="w-full mt-2">\( R^2 = {{ (($detail['ssr']+$detail['sse']) != 0) ? round($detail['ssr']/($detail['ssr']+$detail['sse']), 4) : 0 }} \)</p>
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
    <script defer src="{{ url('katex/auto-render.min.js') }}"></script>
    
    <script>
        document.addEventListener('livewire:initialized', () => {
            setTimeout(() => {
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            }, 200);
        });
    </script>
@endpush
</div>
