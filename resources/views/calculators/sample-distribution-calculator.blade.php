<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">
                
                <div class="col-span-6">
                    <label for="mean" class="label"><?=$lang['mean']?> (μ)</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="mean" id="mean" value="{{ isset($_POST['mean'])?$_POST['mean']:'0.5' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="deviation" class="label"><?=$lang['st_dev']?> (σ)</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="deviation" id="deviation" value="{{ isset($_POST['deviation'])?$_POST['deviation']:'1.5' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="size" class="label"><?=$lang['size']?> (n)</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="size" id="size" value="{{ isset($_POST['size'])?$_POST['size']:'65' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="probability" class="label">{{ $lang['prob'] }}</label>
                    <div class="w-100 py-2">
                        <select name="probability" id="probability" class="input" autocomplete="off">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                                }}
                                $name = ["Between","Below","Above"];
                                $val = ["two_tailed","left_tailed","right_tailed"];
                                optionsList($val,$name,isset($_POST['probability'])?$_POST['probability']:'two_tailed');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6 x1">
                    <label for="x1" class="label">X₁</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="x1" id="x1" value="{{ isset($_POST['x1'])?$_POST['x1']:'.2' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-6 x2">
                    <label for="x2" class="label">X₂</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="x2" id="x2" value="{{ isset($_POST['x2'])?$_POST['x2']:'.8' }}" class="input" aria-label="input" placeholder="00" />
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
                                $u = $detail['mean'];
                                $o = $detail['deviation'];
                                $n = $detail['size'];
                                $x1 = $detail['x1'];
                                $x2 = $detail['x2'];
                                $sd = $detail['sd'];
                                $zl = $detail['zl'];
                                $pr2 = $detail['pr2'];
                                $probability = $detail['probability'];
                                if($probability === 'two_tailed'){
                                    $zu = $detail['zu'];
                                    $pr = $detail['pr'];
                                    $pr1 = $detail['pr1'];
                                    $res = "$x1 \le \bar{X} \le $x2";
                                    $ans = $pr;
                                }elseif($probability === 'left_tailed'){
                                    $res = "\bar{X} \le $x1";
                                    $ans = $pr2;
                                }else{
                                    $res = "\bar{X} \ge $x1";
                                    $ans = $pr2;
                                }
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
                            <div class="text-center">
                                <p class="text-[20px]">
                                    <strong>$$ Pr(<?=$res?>) $$</strong>
                                </p>
                                <div class="flex justify-center">
                                <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                    <strong class="text-white">{{ sigFig($ans, 4) }}</strong>
                                </p>
                            </div>
                        </div>
                            <p class="w-full mt-3 text-[20px]"><?=$lang['statement1']?>:</p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 mt-2 overflow-auto">
                                <table class="w-full" >
                                    <tr>
                                        <td class="p-2 border-b text-blue"><?=$lang['st_d']?> (μX̄)</td>
                                        <td class="p-2 border-b"><?=$u?></td>
                                    </tr>
                                    <tr>
                                        <td class="p-2 border-b text-blue"><?=$lang['st_er']?> (σX̄)</td>
                                        <td class="p-2 border-b"><?=$detail['standard_error']?></td>
                                    </tr>
                                </table>
                            </div>
                            <p class="w-full mt-2"><?=$lang['statement5']?>:</p>
                            <div id="myChart" class="mt-3 col-12"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>
@push('calculatorJS')
    @if (isset($detail))
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script>
            Highcharts.chart('myChart', {
				chart: {
					type: 'area'
				},
				<?php if($probability === 'two_tailed'){ ?>
					labels: ['x', 'P(X̄ ≥ X₁ & X̄ > X₂), PDF', , , , , , , , , 'P(X₁ < X̄ < X₂), PDF'],
				<?php }elseif($probability === 'left_tailed'){ ?>
					labels: ['x', 'P(X̄ ≥ X), PDF', , , , , , , , , 'P(X̄ < X), PDF'],
				<?php }else{ ?>
					labels: ['x', 'P(X̄ ≤ X), PDF', , , , , , , , , 'P(X̄ > X), PDF'],
				<?php } ?>
				title: {
					text: 'Probability density function (PDF)'
				},
				tooltip: {
					pointFormat: '{series.name}, PDF {point.y}'
				},
				plotOptions: {
					area: {
						pointStart: 1940,
						marker: {
							enabled: false,
							symbol: 'circle',
							radius: 2,
							states: {
								hover: {
									enabled: true
								}
							}
						}
					}
				},
				series: [
					{
						<?php if($probability === 'two_tailed'){ ?>
							name: 'P(X̄ ≥ X₁ & X̄ > X₂)',
						<?php }elseif($probability === 'left_tailed'){ ?>
							name: 'P(X̄ ≥ X), PDF',
						<?php }else{ ?>
							name: 'P(X̄ > X), PDF',
						<?php } ?>
						data: <?php echo json_encode($detail['chartData']) ?>
					},
					{
						<?php if($probability === 'two_tailed'){ ?>
							name: 'P(X₁ < X̄ < X₂)',
						<?php }elseif($probability === 'left_tailed'){ ?>
							name: 'P(X̄ < X), PDF',
						<?php }else{ ?>
							name: 'P(X̄ ≤ X), PDF',
						<?php } ?>
						data: <?php echo json_encode($detail['chartData2']) ?>
					}
				]
			});
        </script>
    @endif
    <script>
        // Function to show or hide .x2 based on the value of #probability
        function toggleX2() {
            let val = document.getElementById('probability').value;
            if (val === 'two_tailed') {
                document.querySelector('.x2').style.display = 'block';
            } else {
                document.querySelector('.x2').style.display = 'none';
            }
        }

        // Initial check when the page loads
        toggleX2();

        // Event listener for changes to the #probability dropdown
        document.getElementById('probability').addEventListener('change', toggleX2);

    </script>
@endpush