<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                <div class="col-span-12">
                    <label for="x" class="font-s-14 text-blue">{{ $lang['sample1'] }}</label>
                    <div class="w-100 py-2">
                        <textarea name="x" id="x" class="textareaInput" aria-label="input" placeholder="e.g. 6, 7, 7, 8, 12, 14, 15, 16, 16, 19">{{ isset($_POST['x'])?$_POST['x']:'6, 7, 7, 8, 12, 14, 15, 16, 16, 19' }}</textarea>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="y" class="font-s-14 text-blue">{{ $lang['sample2'] }}</label>
                    <div class="w-100 py-2">
                        <textarea name="y" id="y" class="textareaInput" aria-label="input" placeholder="e.g. 14, 15, 15, 17, 18, 18, 16, 14, 11, 8">{{ isset($_POST['y'])?$_POST['y']:'14, 15, 15, 17, 18, 18, 16, 14, 11, 8' }}</textarea>
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
                            $x = $detail['x'];
                            $y = $detail['y'];
                            $n = $detail['n'];
                            $x_sum = $detail['x_sum'];
                            $xi_sum = $detail['xi_sum'];
                            $y_sum = $detail['y_sum'];
                            $yi_sum = $detail['yi_sum'];
                            $xy_sum = $detail['xy_sum'];
                            $ss_xx = $detail['ss_xx'];
                            $ss_yy = $detail['ss_yy'];
                            $ss_xy = $detail['ss_xy'];
                            $beta_1 = $detail['beta_1'];
                            $beta_0 = $detail['beta_0'];
                            $ss_r = $detail['ss_r'];
                            $ss_e = $detail['ss_e'];
                            function sigFig($value, $digits)
                            {
                                if ($value !== '') {
                                    if ($value === 0) {
                                        $decimalPlaces = $digits - 1;
                                    } elseif ($value < 0) {
                                        $decimalPlaces = $digits - floor(log10($value * -1)) - 1;
                                    } else {
                                        $decimalPlaces = $digits - floor(log10($value)) - 1;
                                    }
                                    $answer = round($value, $decimalPlaces);
                                    return $answer;
                                }
                            }
                        @endphp
                        <div class="text-center">
                            <p class="text-[25px]">
                                <strong>$$ SS_{E} $$</strong>
                            </p>
                            <div class="flex justify-center">
                            <p class="text-[30px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block">
                                <strong class="text-white">{{ $ss_e }}</strong>
                            </p>
                        </div>
                    </div>
                        <p class="w-full mt-3 text-[25px]"><strong class="text-blue"><?=$lang['solution']?> :</strong></p>

                        <p class="w-full mt-3"><?=$lang['statement1']?>:</p>
                        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                            <table class="w-100" style="border-collapse: collapse">
                                <tr class="bg-gray">
                                    <td class="p-2 border text-center"><strong class="text-blue">Obs.</strong></td>
                                    <td class="p-2 border text-center"><strong class="text-blue">X</strong></td>
                                    <td class="p-2 border text-center"><strong class="text-blue">Y</strong></td>
                                </tr>
                                <?php foreach($x as $key => $value){ ?>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?=$key + 1?></td>
                                        <td class="p-2 border text-center"><?=$value?></td>
                                        <td class="p-2 border text-center"><?=$y[$key]?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                        <p class="w-full mt-3"><?=$lang['statement2']?>:</p>
                        <div class="w-full mt-2 overflow-auto">
                            <table class="w-full" style="border-collapse: collapse">
                                <tr class="bg-gray">
                                    <td class="p-2 border text-center"><strong class="text-blue">Obs.</strong></td>
                                    <td class="p-2 border text-center"><strong class="text-blue">X</strong></td>
                                    <td class="p-2 border text-center"><strong class="text-blue">Y</strong></td>
                                    <td class="p-2 border text-center"><strong class="text-blue">Xᵢ²</strong></td>
                                    <td class="p-2 border text-center"><strong class="text-blue">Yᵢ²</strong></td>
                                    <td class="p-2 border text-center"><strong class="text-blue">Xᵢ &middot; Yᵢ</strong></td>
                                </tr>
                                <?php foreach($x as $key => $xi){
                                    $yi = $y[$key];
                                ?>
                                    <tr class="bg-white">
                                        <td class="p-2 border text-center"><?=$key+1?></td>
                                        <td class="p-2 border text-center"><?=$xi?></td>
                                        <td class="p-2 border text-center"><?=$yi?></td>
                                        <td class="p-2 border text-center"><?=pow($xi, 2)?></td>
                                        <td class="p-2 border text-center"><?=pow($yi, 2)?></td>
                                        <td class="p-2 border text-center"><?=$xi * $yi?></td>
                                    </tr>
                                <?php } ?>
                                <tr class="bg-gray">
                                    <td class="p-2 border text-center"><strong class="text-blue">Sum =</strong></td>
                                    <td class="p-2 border text-center"><strong class="text-blue"><?=$x_sum?></strong></td>
                                    <td class="p-2 border text-center"><strong class="text-blue"><?=$y_sum?></strong></td>
                                    <td class="p-2 border text-center"><strong class="text-blue"><?=$xi_sum?></strong></td>
                                    <td class="p-2 border text-center"><strong class="text-blue"><?=$yi_sum?></strong></td>
                                    <td class="p-2 border text-center"><strong class="text-blue"><?=$xy_sum?></strong></td>
                                </tr>
                            </table>
                        </div>
                        <div class="row p-2 mt-2 px-3">
                        <p class="w-full mt-3 text-center"><strong>Step by Step Solution</strong></p>
                        <p class="w-full mt-3"><?=$lang['statement3']?>:</p>

                        <p class="w-full overflow-auto">$$ SS_{XX} = \sum^n_{i=1}X_i^2 - \dfrac{1}{n} \left(\sum^n_{i=1}X_i \right)^2 $$</p>
                        <p class="w-full overflow-auto">$$ = <?=$xi_sum?> - \dfrac{1}{<?=$n?>} (<?=$x_sum?>)^2 $$</p>
                        <p class="w-full overflow-auto">$$ = <?=sigFig($ss_xx, 5)?> $$</p>

                        <p class="w-full overflow-auto">$$ SS_{YY} = \sum^n_{i=1}Y_i^2 - \dfrac{1}{n} \left(\sum^n_{i=1}Y_i \right)^2 $$</p>
                        <p class="w-full overflow-auto">$$ = <?=$yi_sum?> - \dfrac{1}{<?=$n?>} (<?=$y_sum?>)^2 $$</p>
                        <p class="w-full overflow-auto">$$ = <?=sigFig($ss_yy, 5)?> $$</p>

                        <p class="w-full overflow-auto">$$ SS_{XY} = \sum^n_{i=1}X_iY_i - \dfrac{1}{n} \left(\sum^n_{i=1}X_i \right) \left(\sum^n_{i=1}Y_i \right) $$</p>
                        <p class="w-full overflow-auto">$$ = <?=$xy_sum?> - \dfrac{1}{<?=$n?>} (<?=$x_sum?>) (<?=$y_sum?>) $$</p>
                        <p class="w-full overflow-auto">$$ = <?=sigFig($ss_xy, 5)?> $$</p>

                        <p class="w-full mt-3"><?=$lang['statement4']?>:</p>

                        <p class="w-full overflow-auto">$$ \hat{\beta}_1 = \dfrac{SS_{XY}}{SS_{XX}} $$</p>
                        <p class="w-full overflow-auto">$$ = \dfrac{<?=sigFig($ss_xy, 5)?>}{<?=sigFig($ss_xx, 5)?>} $$</p>
                        <p class="w-full overflow-auto">$$ = <?=sigFig($beta_1, 5)?> $$</p>

                        <p class="w-full overflow-auto">$$ \hat{\beta}_0 = \bar{Y} - \hat{\beta}_1 \times \bar{X} $$</p>
                        <p class="w-full overflow-auto">$$ = <?=sigFig(($y_sum / $n), 5)?> - <?=sigFig($beta_1, 5)?> \times <?=sigFig(($x_sum / $n), 5)?> $$</p>
                        <p class="w-full overflow-auto">$$ = <?=sigFig($beta_0, 5)?> $$</p>

                        <p class="w-full mt-3"><?=$lang['statement5']?>:</p>

                        <p class="w-full overflow-auto">$$ \hat{Y} = <?=sigFig($beta_0, 5)?> <?=sigFig($beta_1, 5)?>X $$</p>

                        <p class="w-full mt-3"><?=$lang['statement6']?>:</p>

                        <p class="w-full overflow-auto">$$ SS_{Total} = SS_{YY} = <?=sigFig($ss_yy, 5)?> $$</p>

                        <p class="w-full mt-3"><?=$lang['statement7']?>:</p>

                        <p class="w-full overflow-auto">$$ SS_{R} = \hat{B}_1 SS_{XY} $$</p>
                        <p class="w-full overflow-auto">$$ = <?=sigFig($beta_1, 5)?> \times <?=sigFig($ss_xy, 5)?> $$</p>
                        <p class="w-full overflow-auto">$$ = <?=sigFig($ss_r, 5)?> $$</p>

                        <p class="w-full mt-3"><?=$lang['statement8']?> $$$ SS_{Total} = SS_{Regression} + SS_{Error} $$$, <?=$lang['statement8.1']?>:</p>

                        <p class="w-full overflow-auto">$$ SS_{E} = SS_{Total} - SS_{R} $$</p>
                        <p class="w-full overflow-auto">$$ = <?=sigFig($ss_yy, 5)?> - <?=sigFig($ss_r, 5)?> $$</p>
                        <p class="w-full overflow-auto">$$ = <?=sigFig($ss_e, 5)?> $$</p>

                        <p class="w-full overflow-auto "><?=$lang['statement9']?> $$ SS_{E} = <?=$ss_e?> $$</p>
                        </div>
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
            function loadMathJax() {
                var mathJaxScript = document.createElement('script');
                mathJaxScript.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
                document.querySelector('head').appendChild(mathJaxScript);
            
                var mathJaxConfigScript = document.createElement('script');
                mathJaxConfigScript.type = "text/x-mathjax-config";
                mathJaxConfigScript.textContent = 'MathJax.Hub.Config({"SVG": {linebreaks: { automatic: true }}}); function MJrerender() { MathJax.Hub.Queue(["Rerender", MathJax.Hub]); }';
                document.querySelector('head').appendChild(mathJaxConfigScript);
            }
            
            window.addEventListener('load', function () {
                loadMathJax();
            });
        </script>
    @endif
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>