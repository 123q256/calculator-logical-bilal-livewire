<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-2">
                
                <div class="col-span-12  mb-2 text-center flex items-center justify-between">
                    <div class="flex items-center">
                        <p class="font-s-14 me-2">{{ $lang['2'] }}:</p>
                        @if (isset($_POST['freq']))
                            @if ($_POST['freq']=='ind')
                                <input name="freq" id="freq" value="ind" class="ind" type="radio" checked />
                            @else
                                <input name="freq" id="freq" value="ind" class="ind" type="radio" />
                            @endif
                        @else
                            <input name="freq" id="freq" value="ind" class="ind" type="radio" checked />
                        @endif
                        <label for="freq" class="font-s-14 text-blue pe-lg-3 px-1">{{ $lang['3'] }}</label>
                        @if (isset($_POST['freq']) && $_POST['freq']=='grp')
                            <input name="freq" id="freq1" value="grp" class="grp" type="radio" checked />
                        @else
                            <input name="freq" id="freq1" value="grp" class="grp" type="radio" />
                        @endif
                        <label for="freq1" class="font-s-14 text-blue ps-1">{{ $lang['4'] }}</label>
                    </div>
                </div>
                <div class="col-span-6  k_div {{ !isset($_POST['freq']) || $_POST['freq']=='ind' ? 'hidden':'' }}">
                    <label for="st_val" class="font-s-14 text-blue">Starting Value:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="st_val" id="st_val" value="{{ isset($_POST['st_val'])?$_POST['st_val']:'' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-6  k_div {{ !isset($_POST['freq']) || $_POST['freq']=='ind' ? 'hidden':'' }}">
                    <label for="k" class="font-s-14 text-blue">{{ $lang['5'] }}</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" name="k" id="k" value="{{ isset($_POST['k'])?$_POST['k']:'' }}" class="input" aria-label="input" placeholder="00" />
                    </div>
                </div>
                <div class="col-span-12 ">
                    <label for="data" class="font-s-14 text-blue">{{ $lang['1'] }} </label>
                    <div class="w-100 py-2">
                        <textarea name="data" id="data" class="textareaInput" aria-label="input" placeholder="e.g. 4, 14, 16, 22, 24, 25, 37, 38, 38, 40, 42, 42, 45, 44">{{ isset($_POST['data'])?$_POST['data']:'' }}</textarea>
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
                                $set=$detail['set'];
                                $ds=$detail['ds'];
                                $sds=$detail['sds'];
                                $n=$detail['n'];
                                $count=$detail['count'];
                                $table=$detail['table'];
                                $mean=$detail['mean'];
                                $median=$detail['median'];
                                $mode=$detail['mode'];
                                $min=$detail['min'];
                                $max=$detail['max'];
                                $range=$detail['range'];
                                $sum=$detail['sum'];
                                $ss=$detail['ss'];
                                $asum=$detail['asum'];
                                $s_d=$detail['s_d'];
                                $s_d1=$detail['s_d1'];
                                $c_v=$detail['c_v'];
                                $snr=$detail['snr'];
                                $variance=$detail['variance'];
                                $gm=$detail['gm'];
                                $hm=$detail['hm'];
                                $ad=$detail['ad'];
                                $mad=$detail['mad'];
                                $q1=$detail['q1'];
                                $q2=$detail['q2'];
                                $q3=$detail['q3'];
                                $iqr=$detail['iqr'];
                                $qd=$detail['qd'];
                                $cqd=$detail['cqd'];
                                $uf=$detail['uf'];
                                $lf=$detail['lf'];
                                $z=$detail['z'];
                            @endphp
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{ $lang['6'] }}</strong></p>
                            </div>
                            <div class="w-full mt-2 overflow-auto">
                                {!! $table !!}
                            </div>
                            <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?=$lang['37']?></strong></p>
                            <div id="container" style="height:350px" class="w-full mt-3"></div>
                
                            <p class="w-full mt-3 text-[18px]"><strong><?=$lang['7']?></strong></p>
                            {{-- <p class="w-full mt-2"><?=$lang['8']?> = {<?=$ds?>}</p>
                            <p class="w-full mt-2"><?=$lang['9']?> = {<?=$sds?>}</p> --}}
                            <p class="w-full mt-2"><?=$lang['10']?> (<?=$lang['11']?>): μ = <?=$mean?></p>
                            <p class="w-full mt-2"><?=$lang['12']?> = <?=$median?></p>
                            <p class="w-full mt-2"><?=$lang['13']?> = {<?php
                            foreach($mode as $value){
                                if(end($mode)===$value){
                                echo $value;
                                }else{
                                echo $value." , ";
                                }
                            }
                            ?>} - multimodal</p>
                            <p class="w-full mt-2"><?=$lang['14']?> = <?=$min?></p>
                            <p class="w-full mt-2"><?=$lang['15']?> = <?=$max?></p>
                            <p class="w-full mt-2"><?=$lang['16']?> = <?=$range?></p>
                            <p class="w-full mt-2"><?=$lang['17']?> = <?=$n?></p>
                            <p class="w-full mt-2"><?=$lang['21']?> = <?=round($variance,3)?></p>
                            <p class="w-full mt-2"><?=$lang['23']?> (s) = <?=round($s_d1,3)?></p>
                
                
                            {{-- <p class="w-full mt-2"><?=$lang['18']?> = <?=$sum?></p>
                            <p class="w-full mt-2"><?=$lang['19']?> = <?=$ss?></p> 
                            <p class="w-full mt-2"><?=$lang['20']?> = <?=$asum?></p>
                            <p class="w-full mt-2"><?=$lang['22']?> (σ) = <?=$s_d?></p>
                            <p class="w-full mt-2"><?=$lang['24']?> (C<sub>v</sub>) = <?=$c_v?></p>
                            <p class="w-full mt-2"><?=$lang['25']?> (SNR) = <?=$snr?></p>
                            <p class="w-full mt-2"><?=$lang['26']?> = <?=$gm?></p>
                            <p class="w-full mt-2"><?=$lang['27']?> = <?=$hm?></p>
                            <p class="w-full mt-2"><?=$lang['28']?> = <?=$ad?></p>
                            <p class="w-full mt-2"><?=$lang['29']?> = <?=$mad?></p>
                            <p class="w-full mt-2"><?=$lang['30']?> Q1 = <?=$q1?></p>
                            <p class="w-full mt-2"><?=$lang['30']?> Q2 = <?=$q2?></p>
                            <p class="w-full mt-2"><?=$lang['30']?> Q3 = <?=$q3?></p>
                            <p class="w-full mt-2"><?=$lang['31']?> (IQR) = <?=$iqr?></p>
                            <p class="w-full mt-2"><?=$lang['32']?> (QD) = <?=$qd?></p>
                            <p class="w-full mt-2"><?=$lang['33']?> (CQD) = <?=$cqd?></p>
                            <p class="w-full mt-2"><?=$lang['34']?> = <?=$uf?></p>
                            <p class="w-full mt-2"><?=$lang['35']?> = <?=$lf?></p>
                            <p class="w-full mt-2">Z <?=$lang['36']?> = {<?=$z?>}</p> --}}
                    
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
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
            // document.addEventListener('DOMContentLoaded', function () {
            //     Highcharts.chart('ourchart', {
            //         chart: {
            //             type: 'column'
            //         },
            //         title: {
            //             text: ''
            //         },
            //         xAxis: {
            //             visible: false
            //         },
            //         yAxis: {
            //             title: {
            //                 text: ''
            //             }
            //         },
            //         legend: {
            //             enabled: false
            //         },
            //         tooltip: {
            //             headerFormat: '<table>',
            //             pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            //                 '<td style="padding:0"><b>{point.y}</b></td></tr>',
            //             footerFormat: '</table>',
            //         },
            //         series: [{
            //             name: '<?= $lang['38'] ?>',
            //             data: [
            //                 <?php
            //                 if(request()->freq == 'ind'){
            //                     // dd($count);
            //                     foreach($count as $key => $value) {
            //                         echo $key . ",";
            //                     } 
            //                 }else{
            //                     // dd($detail['group']);
            //                     foreach($detail['group'] as $value){
            //                         // dd($value);
            //                         echo $value . ",";
            //                     }
            //                 }
            //                 ?>
            //             ]
            //         }]
            //     });
            // });
            
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: '{{$lang['40']}}',
                    align: 'left'
                },
                subtitle: {
                    text:
                    'Source: <a target="_blank" ' +
                    'href="https://www.indexmundi.com/agriculture/?commodity=corn">indexmundi</a>',
                    align: 'left'
                },
                xAxis: {
                    categories: [
                        <?php
                            if(request()->freq == 'ind'){
                                foreach($count as $key => $value) {
                                    echo $key . ",";
                                } 
                            }else{
                                    foreach($detail['group']  as $key => $value) {
                                        echo '"' . addslashes($value) . '",';
                                } 
                            }
                            ?>
                    ],
                    crosshair: true,
                    accessibility: {
                    description: 'Countries'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                    text: '{{$lang['2']}}'
                    }
                },
                tooltip: {
                    valueSuffix: ''
                },
                plotOptions: {
                    column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                    }
                },
                series: [
                    {
                    name: '{{$lang['2']}}',
                    data: [
                        <?php
                            if(request()->freq == 'ind'){
                                foreach($detail['rf_values'] as $key => $value) {
                                    echo $value . ",";
                                } 
                            }else{
                                foreach($detail['rf1_values'] as $value){
                                    echo $value . ",";
                                }
                            }
                        ?>
                    ]
                    },
                    {
                    name: '{{$lang['38']}}',
                    data: [
                        <?php
                            if(request()->freq == 'ind'){
                                foreach($count as $key => $value) {
                                    echo $key . ",";
                                } 
                            }else{
                                foreach($detail['group'] as $value){
                                    echo '"' . addslashes($value) . '",';

                                }
                            }
                            ?>
                    ]
                    }
                ]
            });
        </script>
    @endif
    <script>
        document.querySelectorAll('.ind').forEach(function(element) {
            element.addEventListener('click', function() {
                document.querySelectorAll('.k_div').forEach(function(k_div) {
                    k_div.style.display = 'none';
                });
            });
        });

        document.querySelectorAll('.grp').forEach(function(element) {
            element.addEventListener('click', function() {
                document.querySelectorAll('.k_div').forEach(function(k_div) {
                    k_div.style.display = 'block';
                });
            });
        });

    </script>
@endpush