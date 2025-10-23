<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
  
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
            @if (isset($error))
            <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
           @endif
           <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                <div class="grid grid-cols-1  mt-3  gap-4">
                <div class="space-y-2">
                    <label for="x" class="font-s-14 text-blue">{{ $lang['var_x'] }} (,)</label>
                    <div class="w-100 py-2">
                        <textarea name="x" id="x" class="textareaInput" aria-label="input" placeholder="e.g. 1, 13, 5, 7, 9">{{ isset($_POST['x'])?$_POST['x']:'1, 13, 5, 7, 9' }}</textarea>
                    </div>
                </div>
                <div class="space-y-2">
                    <label for="y" class="font-s-14 text-blue">{{ $lang['var_y'] }} (,)</label>
                    <div class="w-100 py-2">
                        <textarea name="y" id="y" class="textareaInput" aria-label="input" placeholder="e.g. 2, 4, 6, 18, 10">{{ isset($_POST['y'])?$_POST['y']:'2, 4, 6, 18, 10' }}</textarea>
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
                        $y_bar = $detail['y_bar'];
                        $yy_bar = $detail['yy_bar'];
                        function sigFig($value, $digits){
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
                    <p class="w-full"><?=$lang['satement1']?>:</p>
                    <div class="grid  grid-cols-1 mt-2 overflow-auto">
                        <table class="w-full" style="border-collapse: collapse">
                            <tr class="bg-sky">
                                <td class="p-2 border text-center"><strong class="text-blue">Obs.</strong></td>
                                <td class="p-2 border text-center"><strong class="text-blue">X</strong></td>
                                <td class="p-2 border text-center"><strong class="text-blue">Y</strong></td>
                            </tr>
                            <?php foreach($x as $key => $value){ ?>
                                <tr class="bg-white">
                                    <td class="p-2 text-center border"><?=$key + 1?></td>
                                    <td class="p-2 text-center border"><?=$value?></td>
                                    <td class="p-2 text-center border"><?=$y[$key]?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <p class="w-full mt-3"><?=$lang['satement2']?>:</p>
                    <div class="grid  grid-cols-1 mt-2 overflow-auto">
                        <table class="w-full" style="border-collapse: collapse">
                            <tr class="bg-sky">
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
                                <td class="p-2 border text-blue text-center">Sum =</td>
                                <td class="p-2 border text-blue text-center"><?=$x_sum?></td>
                                <td class="p-2 border text-blue text-center"><?=$y_sum?></td>
                                <td class="p-2 border text-blue text-center"><?=$xi_sum?></td>
                                <td class="p-2 border text-blue text-center"><?=$yi_sum?></td>
                                <td class="p-2 border text-blue text-center"><?=$xy_sum?></td>
                            </tr>
                        </table>
                    </div>
        
                    <p class="w-full mt-3"><?=$lang['satement3']?>:</p>
        
                    <p class="w-full mt-2">$$ SS_{XX} = \sum^n_{i-1}X_i^2 - \dfrac{1}{n} \left(\sum^n_{i-1}X_i \right)^2 $$</p>
                    <p class="w-full mt-2">$$ = <?=$xi_sum?> - \dfrac{1}{<?=$n?>} (<?=$x_sum?>)^2 $$</p>
                    <p class="w-full mt-2">$$ = <?=sigFig($ss_xx, 5)?> $$</p>
        
                    <p class="w-full mt-2">$$ SS_{YY} = \sum^n_{i-1}Y_i^2 - \dfrac{1}{n} \left(\sum^n_{i-1}Y_i \right)^2 $$</p>
                    <p class="w-full mt-2">$$ = <?=$yi_sum?> - \dfrac{1}{<?=$n?>} (<?=$y_sum?>)^2 $$</p>
                    <p class="w-full mt-2">$$ = <?=sigFig($ss_yy, 5)?> $$</p>
        
                    <p class="w-full mt-2">$$ SS_{XY} = \sum^n_{i-1}X_iY_i - \dfrac{1}{n} \left(\sum^n_{i-1}X_i \right) \left(\sum^n_{i-1}Y_i \right) $$</p>
                    <p class="w-full mt-2">$$ = <?=$xy_sum?> - \dfrac{1}{<?=$n?>} (<?=$x_sum?>) (<?=$y_sum?>) $$</p>
                    <p class="w-full mt-2">$$ = <?=sigFig($ss_xy, 5)?> $$</p>
        
                    <p class="w-full mt-3"><?=$lang['satement4']?>:</p>
        
                    <p class="w-full mt-2">$$ \hat{\beta}_1 = \dfrac{SS_{XY}}{SS_{XX}} $$</p>
                    <p class="w-full mt-2">$$ = \dfrac{<?=sigFig($ss_xy, 5)?>}{<?=sigFig($ss_xx, 5)?>} $$</p>
                    <p class="w-full mt-2">$$ = <?=sigFig($beta_1, 5)?> $$</p>
        
                    <p class="w-full mt-2">$$ \hat{\beta}_0 = \bar{Y} - \hat{\beta}_1 \times \bar{X} $$</p>
                    <p class="w-full mt-2">$$ = <?=sigFig(($y_sum / $n), 5)?> - <?=sigFig($beta_1, 5)?> \times <?=sigFig(($x_sum / $n), 5)?> $$</p>
                    <p class="w-full mt-2">$$ = <?=sigFig($beta_0, 5)?> $$</p>
        
                    <p class="w-full mt-3"><?=$lang['satement5']?>:</p>
                    <p class="w-full mt-2">$$ \hat{Y} = <?=sigFig($beta_0, 5)?> + <?=sigFig($beta_1, 5)?>X $$</p>
        
                    <p class="w-full mt-3"><?=$lang['satement6']?> $$ \hat{Y} = <?=sigFig($beta_0, 5)?> + <?=sigFig($beta_1, 5)?>X $$</p>
        
                    <p class="w-full mt-3 mb-10"><?=$lang['satement7']?>:</p>
        
                    <div class="grid  grid-cols-1 mt-2 overflow-auto">
                        <table class="w-full" style="border-collapse: collapse">
                            <tr class="bg-sky">
                                <td class="p-2 border text-center"><strong>Obs.</strong></td>
                                <td class="p-2 border text-center"><strong>X</strong></td>
                                <td class="p-2 border text-center"><strong>Y</strong></td>
                                <td class="p-2 border text-center"><strong>Predicted Values $$ (\hat{Y}) $$</strong></td>
                                <td class="p-2 border text-center"><strong>Residuals $$ (Y - \hat{Y}) $$</strong></td>
                            </tr>
                            <?php foreach($x as $key => $xi){
                                $yi = $y[$key];
                            ?>
                                <tr class="bg-white">
                                    <td class="p-2 border text-center"><?=$key+1?></td>
                                    <td class="p-2 border text-center"><?=$xi?></td>
                                    <td class="p-2 border text-center"><?=$yi?></td>
                                    <td class="p-2 border text-center">$$ <?=sigFig($beta_0, 5)?> + <?=sigFig($beta_1, 5)?> \times <?=$xi?> = <?=sigFig($y_bar[$key], 5)?> $$</td>
                                    <td class="p-2 border text-center">$$ <?=$yi?> - <?=sigFig($y_bar[$key], 5)?> = <?=sigFig(($yy_bar[$key]), 5)?> $$</td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
        
                    <p class="w-full my-3"><?=$lang['satement8']?>:</p>
                    <div class="w-full overflow-auto">
                        <canvas id="myChart" class="w-full"></canvas>
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
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
        <script>
            const xyValues = [
				<?php foreach($y_bar as $key => $value){ ?>
					{x:<?=$key+1?>, y:<?=$yy_bar[$key]?>},
				<?php } ?>
			];
			const data = {
				datasets: [{
					pointRadius: 4,
					pointBackgroundColor: "rgba(0,0,255,1)",
					data: xyValues
				}],
			};
			const config = new Chart("myChart", {
				type: 'line',
				data: data,
				options: {
					responsive: true,
					plugins: {
						title: {
							display: true,
							text: 'Residual Plot',
							font: {
								size: 20
							}
						},
						legend: {
							display: false
						}
					},
					scales: {
						x: {
							type: 'linear',
							position: 'bottom',
							title: {
								display: true,
								text: "X"
							}
						},
						y: {
							type: 'linear',
							position: 'left',
							title: {
								display: true,
								text: "Y"
							}
						}
					}
				}
			});
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        </script>
    @endif
@endpush