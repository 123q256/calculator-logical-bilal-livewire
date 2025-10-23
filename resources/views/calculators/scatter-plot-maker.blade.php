<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
                @if (isset($error))
                <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
               @endif
               <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
                    <div class="grid grid-cols-12 mt-3  gap-4">
                        <div class="col-span-12">
                            <label for="x" class="font-s-14 text-blue">X {{ $lang['data'] }} (,)</label>
                            <div class="w-100 py-2">
                                <textarea name="x" id="x" class="textareaInput" aria-label="input" placeholder="e.g. 1, 13, 5, 7, 9">{{ isset($_POST['x'])?$_POST['x']:'1, 13, 5, 7, 9' }}</textarea>
                            </div>
                        </div>
                        <div class="col-span-12">
                            <label for="y" class="font-s-14 text-blue">Y {{ $lang['data'] }} (,)</label>
                            <div class="w-100 py-2">
                                <textarea name="y" id="y" class="textareaInput" aria-label="input" placeholder="e.g. 2, 4, 6, 18, 10">{{ isset($_POST['y'])?$_POST['y']:'2, 4, 6, 18, 10' }}</textarea>
                            </div>
                        </div>    
                        <div class="col-span-12">
                            <label for="title" class="font-s-14 text-blue">{{ $lang['g_title'] }} ({{ $lang['optional'] }}):</label>
                            <div class="w-100 py-2">
                                <input type="text" name="title" id="title" value="{{ isset($_POST['title'])?$_POST['title']:'Scatter Plot' }}" class="input" aria-label="input" placeholder="Scatter Plot" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="xaxis" class="font-s-14 text-blue">{{ $lang['horizontal'] }} {{ $lang['axis_label'] }} ({{ $lang['optional'] }}):</label>
                            <div class="w-100 py-2">
                                <input type="text" name="xaxis" id="xaxis" value="{{ isset($_POST['xaxis'])?$_POST['xaxis']:'X' }}" class="input" aria-label="input" placeholder="X" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="yaxis" class="font-s-14 text-blue">{{ $lang['vertical'] }} {{ $lang['axis_label'] }} ({{ $lang['optional'] }}):</label>
                            <div class="w-100 py-2">
                                <input type="text" name="yaxis" id="yaxis" value="{{ isset($_POST['yaxis'])?$_POST['yaxis']:'Y' }}" class="input" aria-label="input" placeholder="Y" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="xmin" class="font-s-14 text-blue">X {{ $lang['min'] }} ({{ $lang['optional'] }}):</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="xmin" id="xmin" value="{{ isset($_POST['xmin'])?$_POST['xmin']:'' }}" class="input" aria-label="input" placeholder="" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="xmax" class="font-s-14 text-blue">X {{ $lang['max'] }} ({{ $lang['optional'] }}):</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="xmax" id="xmax" value="{{ isset($_POST['xmax'])?$_POST['xmax']:'' }}" class="input" aria-label="input" placeholder="" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="ymin" class="font-s-14 text-blue">Y {{ $lang['min'] }} ({{ $lang['optional'] }}):</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="ymin" id="ymin" value="{{ isset($_POST['ymin'])?$_POST['ymin']:'' }}" class="input" aria-label="input" placeholder="" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="ymax" class="font-s-14 text-blue">Y {{ $lang['max'] }} ({{ $lang['optional'] }}):</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="ymax" id="ymax" value="{{ isset($_POST['ymax'])?$_POST['ymax']:'' }}" class="input" aria-label="input" placeholder="" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="position" class="font-s-14 text-blue">{{ $lang['position'] }} ({{ $lang['optional'] }})</label>
                            <div class="w-100 py-2">
                                <select name="position" id="position" class="input" autocomplete="off">
                                    @php
                                        function optionsList($arr1,$arr2,$unit){
                                        foreach($arr1 as $index => $name){
                                    @endphp
                                        <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                            {!! $arr2[$index] !!}
                                        </option>
                                    @php
                                        }}
                                        $name = [$lang['top'],$lang['left'],$lang['right'],$lang['bottom']];
                                        $val = ["top","left","right","bottom"];
                                        optionsList($val,$name,isset($_POST['position'])?$_POST['position']:'top');
                                    @endphp
                                </select>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="center" class="font-s-14 text-blue">{{ $lang['align'] }} ({{ $lang['optional'] }})</label>
                            <div class="w-100 py-2">
                                <select name="center" id="center" class="input" autocomplete="off">
                                    @php
                                        $name = [$lang['start'],$lang['center'],$lang['end']];
                                        $val = ["start","center","end"];
                                        optionsList($val,$name,isset($_POST['center'])?$_POST['center']:'top');
                                    @endphp
                                </select>
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
                                $title = $detail['title'];
                                $xaxis = $detail['xaxis'];
                                $yaxis = $detail['yaxis'];
                                $xmin = $detail['xmin'];
                                $xmax = $detail['xmax'];
                                $ymin = $detail['ymin'];
                                $ymax = $detail['ymax'];
                                $position = $detail['position'];
                                $align = $detail['align'];
                            @endphp
                            <p class="w-full "><?=$lang['statement1']?> <?=$xaxis?> <?=$lang['and']?> <?=$yaxis?> <?=$lang['variables']?>:</p>
                            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1  mt-2 overflow-auto ">
                                <table class="w-full" style="border-collapse: collapse">
                                    <tr class="bg-gray">
                                        <td class="p-2 border text-center"><strong class="text-blue"><?=$xaxis?></strong></td>
                                        <td class="p-2 border text-center"><strong class="text-blue"><?=$yaxis?></strong></td>
                                    </tr>
                                    <?php foreach($x as $key => $value){ ?>
                                        <tr class="bg-white">
                                            <td class="p-2 border text-center"><?=$value?></td>
                                            <td class="p-2 border text-center"><?=$y[$key]?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <p class="mt-3 w-full ">{{ $lang['statement2'] }}:</p>
                            <canvas id="myChart" class="w-full  mt-2"></canvas>
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
				<?php foreach($x as $key => $value){ ?>
					{x:<?=$value?>, y:<?=$y[$key]?>},
				<?php } ?>
			];
			const data = {
				datasets: [{
					label: "<?=$title?>",
					pointRadius: 4,
					pointBackgroundColor: "rgba(0,0,255,1)",
					data: xyValues
				}],
			};
			const config = new Chart("myChart", {
				type: 'scatter',
				data: data,
				options: {
					responsive: true,
					plugins: {
						legend: {
							align: "<?=$align?>",
							position: "<?=$position?>",
							labels: {
								boxWidth: 0
							}
						},
					},
					scales: {
						x: {
							type: 'linear',
							position: 'bottom',
							title: {
								display: true,
								text: "<?=$xaxis?>"
							},
							<?=(is_numeric($xmin)) ? "min: $xmin," : ''?>
							<?=(is_numeric($xmax)) ? "max: $xmax," : ''?>
						},
						y: {
							type: 'linear',
							position: 'left',
							title: {
								display: true,
								text: "<?=$yaxis?>"
							},
							<?=(is_numeric($ymin)) ? "min: $ymin," : ''?>
							<?=(is_numeric($ymax)) ? "max: $ymax," : ''?>
						}
					}
				}
			});
        </script>
    @endif
@endpush