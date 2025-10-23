<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="textarea" class="font-s-14 text-blue">{{ $lang['1'] }} X {{ $lang['2'] }} ({{ $lang['3'] }})</label>
                    <div class="w-100 py-2">
                        <textarea name="x" id="textarea" class="textareaInput" aria-label="input" placeholder="e.g. 10, 12, 11, 15, 11, 14">{{ isset($_POST['x'])?$_POST['x']:'10, 12, 11, 15, 11, 14' }}</textarea>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="textarea1" class="font-s-14 text-blue">{{ $lang['1'] }} Y {{ $lang['2'] }} ({{ $lang['3'] }})</label>
                    <div class="w-100 py-2">
                        <textarea name="y" id="textarea1" class="textareaInput" aria-label="input" placeholder="e.g. 13, 17, 12, 22, 14, 11">{{ isset($_POST['y'])?$_POST['y']:'13, 17, 12, 22, 14, 11' }}</textarea>
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
                <div class="w-full  mt-3">
                    <div class="w-full">
                        <div class="text-center">
                            <p class="text-[18px]"><strong>{{$lang['4']}}</strong></p>
                        <div class="flex justify-center">
                            <p class="text-[21px] w-auto bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                <strong class="text-white">y = <?=round($detail['a'],5)?>x<sup class="text-blue">2</sup> <?=(($detail['b']<0)?'-':'+')?> <?=round(abs($detail['b']),5)?>x <?=(($detail['c']<0)?'-':'+')?> <?=round(abs($detail['c']),5)?></strong>
                            </p>
                        </div>
                    </div>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                            <table class="w-full text-[18px]">
                                <tr>
                                    <td class="py-2 border-b text-blue"><?=$lang[5]?> (n):</td>
                                    <td class="py-2 border-b"><strong><?=count($detail['xvalues'])?></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b text-blue"><?=$lang[6]?> x:</td>
                                    <td class="py-2 border-b"><strong><?=round($detail['meanx'],5)?></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b text-blue"><?=$lang[6]?> y:</td>
                                    <td class="py-2 border-b"><strong><?=round($detail['meany'],5)?></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b text-blue">a:</td>
                                    <td class="py-2 border-b"><strong><?=round($detail['a'],5)?></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b text-blue">b:</td>
                                    <td class="py-2 border-b"><strong><?=round($detail['b'],5)?></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b text-blue">c:</td>
                                    <td class="py-2 border-b"><strong><?=round($detail['c'],5)?></strong></td>
                                </tr>
                                <tr>
                                    <td class="py-2 border-b text-blue"><?=$lang[7]?> (r):</td>
                                    <td class="py-2 border-b"><strong><?=round($detail['r2'],5)?></strong></td>
                                </tr>
                            </table>
                        </div>
                        <p class="w-full mt-3 font-s-20"><strong class="text-blue"><?=$lang[8]?>:</strong></p>
                        <p class="w-full mt-2"><?=$lang[9]?>:</p>
                        <p class="w-full mt-2">X <?=$lang[10]?>:
                            <?php for ($i=0; $i < count($detail['xvalues']); $i++) { 
                                if ($i==0) {
                                    echo $detail['xvalues'][$i];
                                }else{
                                    echo ', '.$detail['xvalues'][$i];
                                }
                            } ?>
                        </p>
                        <p class="w-full mt-2">Y <?=$lang[10]?>:
                            <?php for ($i=0; $i < count($detail['xvalues']); $i++) { 
                                if ($i==0) {
                                    echo $detail['yvalues'][$i];
                                }else{
                                    echo ', '.$detail['yvalues'][$i];
                                }
                            } ?>
                        </p>
                        <div class="w-full mt-2 overflow-auto">
                            <table class="w-full font-s-14" style="border-collapse: collapse">
                                <tr class="bg-sky">
                                    <td class="py-2 ps-1 border text-center"><strong>\((x_i - \bar{x})^2\)</strong></td>
                                    <td class="py-2 ps-1 border text-center"><strong>\((x_i - \bar{x})(y_i - \bar{y})\)</strong></td>
                                    <td class="py-2 ps-1 border text-center"><strong>\((x_i - \bar{x})({x_i}^2 - \bar{x^2})\)</strong></td>
                                    <td class="py-2 ps-1 border text-center"><strong>\(({x_i}^2 - \bar{x^2})^2\)</strong></td>
                                    <td class="py-2 ps-1 border text-center"><strong>\(({x_i}^2 - \bar{x^2})(y_i - \bar{y})\)</strong></td>
                                </tr>
                                <?php for ($i=0; $i < count($detail['Sxx']); $i++) { ?>
                                    <tr class="bg-white">
                                        <td class="py-2 ps-1 border"><?=round($detail['Sxx'][$i],3)?></td>
                                        <td class="py-2 ps-1 border"><?=round($detail['Sxy'][$i],3)?></td>
                                        <td class="py-2 ps-1 border"><?=round($detail['Sxx2'][$i],3)?></td>
                                        <td class="py-2 ps-1 border"><?=round($detail['Sx2x2'][$i],3)?></td>
                                        <td class="py-2 ps-1 border"><?=round($detail['Sx2y'][$i],3)?></td>
                                    </tr>
                                <?php } ?>
                                <tr class="bg-gray">
                                    <td class="py-2 ps-1 border text-center"><strong>\(\sum_{i=1}^n\)=<?=round(array_sum($detail['Sxx']),2)?></strong></td>
                                    <td class="py-2 ps-1 border text-center"><strong>\(\sum_{i=1}^n\)=<?=round(array_sum($detail['Sxy']),2)?></strong></td>
                                    <td class="py-2 ps-1 border text-center"><strong>\(\sum_{i=1}^n\)=<?=round(array_sum($detail['Sxx2']),2)?></strong></td>
                                    <td class="py-2 ps-1 border text-center"><strong>\(\sum_{i=1}^n\)=<?=round(array_sum($detail['Sx2x2']),2)?></strong></td>
                                    <td class="py-2 ps-1 border text-center"><strong>\(\sum_{i=1}^n\)=<?=round(array_sum($detail['Sx2y']),2)?></strong></td>
                                </tr>
                            </table>
                        </div>
                        <p class="w-full mt-2">$$b:=\dfrac{S_{xy}S_{x^2x^2}-S_{x^2y}S_{xx^2}}{S_{xx}S_{x^2x^2}-(S_{xx^2})^2}$$</p>
                        <p class="w-full mt-2">$$c:=\dfrac{S_{x^2y}S_{xx}-S_{xy}S_{xx^2}}{S_{xx}S_{x^2x^2}-(S_{xx^2})^2}$$</p>
                        <p class="w-full mt-2">$$a:=\bar{y}-b\bar{x}-c\bar{x^2}$$</p>
        
                        <p class="w-full mt-2">$$b:=<?=round($detail['b'],5)?>$$</p>
                        <p class="w-full mt-2">$$c:=<?=round($detail['c'],5)?>$$</p>
                        <p class="w-full mt-2">$$a:=<?=round($detail['a'],5)?>$$</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    @if (isset($detail))
        <script>
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        </script>
    @endif
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>