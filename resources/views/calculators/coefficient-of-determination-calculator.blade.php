<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
   
    
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="textarea" class="font-s-14 text-blue">{{ $lang['1'] }} (,):</label>
                    <div class="w-100 py-2">
                        <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 12, 23, 45, 33, 65, 54, 54">{{ isset($_POST['x'])?$_POST['x']:'12, 13, 23, 44, 55' }}</textarea>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="textarea1" class="font-s-14 text-blue">{{ $lang['2'] }} (,):</label>
                    <div class="w-100 py-2">
                        <textarea name="y" id="textarea1" class="textareaInput" aria-label="input" placeholder="e.g. 17, 10, 20, 14, 35">{{ isset($_POST['y'])?$_POST['y']:'17, 10, 20, 14, 35' }}</textarea>
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
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
            @if ($type == 'calculator')
            @include('inc.copy-pdf')
                    @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full mt-3">
                            <div class="w-full">
                                @php
                                    $r=$detail['r'];
                                    $r2=$detail['r2'];
                                    $n=$detail['n'];
                                    $sumx=$detail['sumx'];
                                    $sumy=$detail['sumy'];
                                    $sumxi=$detail['sumxi'];
                                    $sumyi=$detail['sumyi'];
                                    $sumxy=$detail['sumxy'];
                                    $sumx2=$detail['sumx2'];
                                    $sumy2=$detail['sumy2'];
                                    $ssxx=$detail['ssxx'];
                                    $ssyy=$detail['ssyy'];
                                    $ssxy=$detail['ssxy'];
                                    $s_d=$detail['s_d'];
                                    $s_d1=$detail['s_d1'];
                                    $s1=$detail['s1'];
                                    $s2=$detail['s2'];
                                    $s3=$detail['s3'];
                                    $s11=$detail['s11'];
                                    $meanx=$detail['meanx'];
                                    $meany=$detail['meany'];
                                    $table=$detail['table'];
                                    $sst=$detail['sst'];
                                    $ssr=$detail['ssr'];
                                    $sse=$detail['sse'];
                                    $a=$detail['a'];
                                    $b=$detail['b'];
                                    $sst_table=$detail['sst_table'];
                                    $ssr_table=$detail['ssr_table'];
                                    $sse_table=$detail['sse_table'];
                                @endphp
                                <div class="w-full  mt-2 overflow-auto">
                                    <table class="w-full">
                                        <tr>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ $lang["5"] }} <i class="text-blue">(R<sup class="text-blue">2</sup>)</i></strong></td>
                                            <td class="p-2 border-b"><b>{{ $r2 }}</b></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 border-b"><strong class="text-blue">{{ $lang["4"] }} <i class="text-blue">(r)</i></strong></td>
                                            <td class="p-2 border-b"><b>{{ $r }}</b></td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="w-full  mt-2"><strong>{{$lang['6']}}, <span class="text-blue"><?=$r2*100?>%</span> {{$lang['7']}} y {{$lang['8']}} x.</strong></p>
                                <p class="w-full font-s-20 mt-3"><strong class="text-blue">{{$lang['9']}}:</strong></p>
                                <p class="w-full font-s-18 mt-2"><strong class="text-blue">Method 1</strong></p>
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                                    {!! $table !!}
                                </div>
                                <p class="w-full mt-2"><?=$lang['9']?> (n) = \( <?=$n?> \)</p>
                                <p class="w-full mt-3"><strong><?=$lang['5']?> \( SS_{xx} \)</strong></p>
                                <p class="w-full mt-2">\( SS_{xx} = \displaystyle \sum_{i=1}^n X_{i}^2 - \frac{1}{n} \left( \sum_{i=1}^n X_{i}^2 \right)^2 \)</p>
                                <p class="w-full mt-2">\( SS_{xx} = <?=$sumxi?> - \dfrac{1}{<?=$n?>} \normalsize{* <?=$sumx2?>} \)</p>
                                <p class="w-full mt-2">\( SS_{xx} = <?=$ssxx?> \)</p>
                                
                                <p class="w-full overflow-auto mt-3"><strong><?=$lang['5']?> \( SS_{yy} \)</strong></p>
                                <p class="w-full overflow-auto mt-2">\( SS_{yy} = \displaystyle \sum_{i=1}^n Y_{i}^2 - \frac{1}{n} \left( \sum_{i=1}^n Y_{i}^2 \right)^2 \)</p>
                                <p class="w-full overflow-auto mt-2">\( SS_{yy} = <?=$sumyi?> - \dfrac{1}{<?=$n?>} \normalsize{* <?=$sumy2?>} \)</p>
                                <p class="w-full overflow-auto mt-2">\( SS_{yy} = <?=$ssyy?> \)</p>
                                
                                <p class="w-full overflow-auto mt-3"><strong><?=$lang['5']?> \( SS_{xy} \)</strong></p>
                                <p class="w-full overflow-auto mt-2">\( SS_{xy} = \displaystyle \sum_{i=1}^n X_{i}^2 Y_{i}^2 - \frac{1}{n} \left( \sum_{i=1}^n X_{i}^2 \right) \left( \sum_{i=1}^n Y_{i}^2 \right) \)</p>
                                <p class="w-full overflow-auto mt-2">\( SS_{xy} = <?=$sumxy?> - \dfrac{1}{<?=$n?>} \normalsize{* <?=$sumx*$sumy?>} \)</p>
                                <p class="w-full overflow-auto mt-2">\( SS_{xy} = <?=$ssxy?> \)</p>
                                
                                <p class="w-full overflow-auto mt-3"><strong><?=$lang['5']?> <?=$lang['4']?> \( (r) \)</strong></p>
                                <p class="w-full overflow-auto mt-2">\( r = \dfrac{SS_{xy}}{\sqrt{SS_{xx} SS_{yy}}} \)</p>
                                <p class="w-full overflow-auto mt-2">\( r = \dfrac{<?=$ssxy?>}{\sqrt{<?=$ssxx?> * <?=$ssyy?>}} \)</p>
                                <p class="w-full overflow-auto mt-2">\( r = <?=$r?> \)</p>
                                
                                <p class="w-full mt-3"><strong><?=$lang['5']?> <?=$lang['3']?> \( (R^2) \)</strong></p>
                                <p class="w-full mt-2">\( R^2 = (<?=$r?>)^2 \)</p>
                                <p class="w-full mt-2">\( R^2 = <?=$r2?> \)</p>
                
                                <p class="w-full font-s-18 mt-2"><strong class="text-blue">Method 2</strong></p>
                                <p class="w-full overflow-auto mt-2"><?=$lang['9']?> (n) = \( <?=$n?> \)</p>
                                <p class="w-full overflow-auto mt-3"><strong><?=$lang['5']?> <?=$lang['4']?> \( (r) \)</strong></p>
                                <p class="w-full overflow-auto mt-2">\( r = \dfrac{\displaystyle \sum_{i=1}^n (x - \bar x)(y - \bar y)}{(n - 1) \left(s \displaystyle \sum_{i=1}^n X_{i} \right) \left(s \displaystyle \sum_{i=1}^n Y_{i} \right)} \)</p>
                                <p class="w-full overflow-auto mt-2">\( r = \dfrac{<?=$s1?>}{(<?=$n?>-1) * <?=$s_d?> * <?=$s_d1?>} \)</p>
                                <p class="w-full overflow-auto mt-2">\( r = \dfrac{<?=$s2?>}{(<?=$n-1?>) * <?=$s_d?> * <?=$s_d1?>} \)</p>
                                <p class="w-full overflow-auto mt-2">\( r = \dfrac{<?=$s3?>}{<?=$s11?>} \)</p>
                                <p class="w-full overflow-auto mt-2">\( r = \dfrac{<?=$ssxy?>}{<?=$s11?>} \)</p>
                                <p class="w-full overflow-auto mt-2">\( r = <?=$r?> \)</p>
                                
                                <p class="w-full overflow-auto mt-3"><strong><?=$lang['5']?> <?=$lang['3']?> \( (R^2) \)</strong></p>
                                <p class="w-full overflow-auto mt-2">\( R^2 = (<?=$r?>)^2 \)</p>
                                <p class="w-full overflow-auto mt-2">\( R^2 = <?=$r2?> \)</p>
                
                                <p class="w-full font-s-18 mt-2"><strong class="text-blue">Method 3</strong></p>
                                <p class="w-full mt-2"><?=$lang['9']?> (n) = \( <?=$n?> \)</p>
                                <p class="w-full mt-2">ȳ = \( <?=$meany?> \)</p>
                                <p class="w-full mt-2"><?=$lang['11']?> = \( <?=$a.'x + '.$b?> \)</p>
                                <p class="w-full mt-3"><strong><?=$lang['5']?> <?=$lang['12']?> (SST)</strong></p>
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                                    <?=$sst_table?>
                                </div>
                                <p class="w-full mt-2"><strong>SST \( = <?=$sst?> \)</strong></p>
                                <p class="w-full mt-3"><strong><?=$lang['5']?> <?=$lang['13']?> (SSR)</strong></p>
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                                    <?=$ssr_table?>
                                </div>
                                <p class="w-full mt-2"><strong>SSR \( = <?=$ssr?> \)</strong></p>
                                <p class="w-full mt-3"><strong><?=$lang['5']?> <?=$lang['14']?> (SSE)</strong></p>
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                                    <?=$sse_table?>
                                </div>
                                <p class="w-full mt-2"><strong>SSE \( = <?=$sse?> \)</strong></p>
                                
                                <p class="w-full mt-3"><strong><?=$lang['5']?> <?=$lang['3']?> \( (R^2) \)</strong></p>
                                <p class="w-full mt-2">\( R^2 = \dfrac{SSR}{SST} \)</p>
                                <p class="w-full mt-2">\( R^2 = \dfrac{<?=$ssr?>}{<?=$sst?>} \)</p>
                                <p class="w-full mt-2">\( R^2 = <?=round($ssr/$sst,4)?> \)</p>
                                <p class="w-full mt-2"><strong>OR</strong></p>
                                <p class="w-full mt-2">\( R^2 = \dfrac{1 - SSE}{SST} \)</p>
                                <p class="w-full mt-2">\( R^2 = 1 - <?=round($sse/$sst,4)?> \)</p>
                                <p class="w-full mt-2">\( R^2 = <?=round(1-($sse/$sst),4)?> \)</p>
                                <p class="w-full mt-2"><strong>OR</strong></p>
                                <p class="w-full mt-2">\( R^2 = \dfrac{SSR}{SSR + SSE} \)</p>
                                <p class="w-full mt-2">\( R^2 = \dfrac{<?=$ssr?>}{<?=$ssr?> + <?=$sse?>} \)</p>
                                <p class="w-full mt-2">\( R^2 = \dfrac{<?=$ssr?>}{<?=$ssr+$sse?>} \)</p>
                                <p class="w-full mt-2">\( R^2 = <?=round($ssr/($ssr+$sse),4)?> \)</p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        
    @endisset
</form>
@push('calculatorJS')
    <script>
        @if (isset($detail))
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        @endif
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>