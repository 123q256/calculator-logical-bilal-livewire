<style>
    .bg-gray{
        background-color: #F6FAFC !important;
        color: #2845F5 !important;
    }
</style>

<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if (!isset($detail))    
       
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class=" w-full mx-auto ">

           <div class="col-12 col-lg-9 mx-auto mt-2 lg:w-[50%] w-full">
            <input type="hidden" name="type" id="type" value="{{ isset($_POST['type'])?$_POST['type']:'one_way' }}">
            <div class="flex flex-wrap items-center bg-blue-100 border border-blue-500 text-center rounded-lg px-1">
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white tagsUnit imperial" id="tab1">
                            {{ $lang['1'] }}
                    </div>
                </div>
                <div class="lg:w-1/2 w-full px-2 py-1">
                    <div class="bg-white px-3 py-2 cursor-pointer rounded-md transition-colors duration-300  hover_tags hover:text-white metric" id="tab2">
                            {{ $lang['2'] }}
                    </div>
                </div>
            </div>
          </div>
            <div class="grid grid-cols-12 mt-3  gap-2">
                <div class="col-span-12 one_way">
                    <div class="row add_groups">
                        <div class="col-lg-7 mx-auto px-2">
                            <label for="group1" class="font-s-14 text-blue"><?=$lang['3']?> 1:</label>
                            <div class="w-full py-2">
                                <textarea name="group1" id="group1" class="textareaInput" aria-label="input" placeholder="e.g. 5, 1, 11, 2, 8">{{ isset($_POST['group1'])?$_POST['group1']:'' }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-7 mx-auto px-2">
                            <label for="group2" class="font-s-14 text-blue"><?=$lang['3']?> 2:</label>
                            <div class="w-full py-2">
                                <textarea name="group2" id="group2" class="textareaInput" aria-label="input" placeholder="e.g. 0, 1, 4, 6, 3">{{ isset($_POST['group2'])?$_POST['group2']:'' }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-7 mx-auto px-2 group">
                            <label for="group3" class="font-s-14 text-blue"><?=$lang['3']?> 3:</label>
                            <div class="w-full py-2">
                                <textarea name="group3" id="group3" class="textareaInput" aria-label="input" placeholder="e.g. 0, 1, 4, 6, 3">{{ isset($_POST['group3'])?$_POST['group3']:'' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="k" id="i" value="3">
                    <div class="col-lg-7 mx-auto d-flex px-2">
                        <button type="button" id="add" class="bg-white border radius-5 px-4 py-2 me-2"><strong class="text-blue"><?=$lang['5']?> <?=$lang['7']?></strong></button>
                        <button type="button" id="del" class="bg-white border radius-5 px-4 py-2"><strong class="text-blue"><?=$lang['6']?> <?=$lang['7']?></strong></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">

            <div class="grid grid-cols-12 mt-3  gap-2">
                <div class="col-span-12 two_way hidden">
                    <div class="row table_set overflow-auto">
                        <table id="input_table" class="w-full" style="text-align: center">
                            <tr>
                                <td><input type="text" class="input" style="width: 100px;margin:3px" name="td_0_0" placeholder="4,6,8"></td>
                                <td><input type="text" class="input" style="width: 100px;margin:3px" name="td_0_1" placeholder="4,8,9"></td>
                                <td><input type="text" class="input" style="width: 100px;margin:3px" name="td_0_2" placeholder="8,9,13"></td>
                                <td><input type="text" class="input" style="width: 100px;margin:3px" name="td_0_3" placeholder="7,6,5"></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="input" style="width: 100px;margin:3px" name="td_1_0" placeholder="6,6,9"></td>
                                <td><input type="text" class="input" style="width: 100px;margin:3px" name="td_1_1" placeholder="7,10,13"></td>
                                <td><input type="text" class="input" style="width: 100px;margin:3px" name="td_1_2" placeholder="12,14,16"></td>
                                <td><input type="text" class="input" style="width: 100px;margin:3px" name="td_1_3" placeholder="3,7,9"></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="input" style="width: 100px;margin:3px" name="td_2_0" placeholder="6,9,4"></td>
                                <td><input type="text" class="input" style="width: 100px;margin:3px" name="td_2_1" placeholder="5,7,12"></td>
                                <td><input type="text" class="input" style="width: 100px;margin:3px" name="td_2_2" placeholder="16,8,1"></td>
                                <td><input type="text" class="input" style="width: 100px;margin:3px" name="td_2_3" placeholder="2,3,4"></td>
                            </tr>
                        </table>
                        <input type="hidden" name="rows" id="rows" value="3">
                        <input type="hidden" name="columns" id="columns" value="4">
                    </div>
                    <div class="grid grid-cols-12 mt-3  gap-2">
                        <div class="col-span-3 px-2 my-1">
                            <button type="button" id="add_row" class="bg-white border w-full radius-5 px-4 py-2"><strong class="text-blue"><?=$lang['5']?> <?=$lang['8']?></strong></button>
                        </div>
                        <div class="col-span-3 px-2 my-1">
                            <button type="button" id="del_row" class="bg-white border w-full radius-5 px-4 py-2"><strong class="text-blue"><?=$lang['6']?> <?=$lang['8']?></strong></button>
                        </div>
                        <div class="col-span-3 px-2 my-1">
                            <button type="button" id="add_column" class="bg-white border w-full radius-5 px-4 py-2"><strong class="text-blue"><?=$lang['5']?> <?=$lang['9']?></strong></button>
                        </div>
                        <div class="col-span-3 px-2 my-1">
                            <button type="button" id="del_column" class="bg-white border w-full radius-5 px-4 py-2"><strong class="text-blue"><?=$lang['6']?> <?=$lang['9']?></strong></button>
                        </div>
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
                
    @endif
    @isset($detail)
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-2">
                        <div class="w-full">
                            @php
                                $request = request();
                                $submit = $request->type;
                                $table=$detail['table'];
                                $table1=$detail['table1'];
                            @endphp
                            @if ($submit=='one_way')
                                @php
                                    $k=$detail['k'];
                                    $N=$detail['N'];
                                    $table2=$detail['table2'];
                                    $s1=$detail['s1'];
                                    $s2=$detail['s2'];
                                    $ssb=$detail['ssb'];
                                    $ssw=$detail['ssw'];
                                    $dfb=$k-1;
                                    $dfw=$N-$k;
                                    $msb=round(($ssb/$dfb),4);
                                    $msw=round(($ssw/$dfw),4);
                                    $f=round(($msb/$msw),4);
                                @endphp
                                <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 overflow-auto mt-2 px-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?=$lang['26']?> <?=$lang['10']?> F</td>
                                            <td class="py-2 border-b"><strong>
                                                <?php 
                                                    echo $f;
                                                    ?>
                                            </strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b">P-<?=$lang['11']?></td>
                                            <td class="py-2 border-b"><strong class="p_value"></strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="grid  grid-cols-1 mt-3 overflow-auto"><?=$table?></div>
                                <div class="grid  grid-cols-1 mt-3 overflow-auto"><?=$table1?></div>
                                <div class="grid  grid-cols-1 mt-3 overflow-auto"><?=$table2?></div>
                                <div class="grid  grid-cols-1 mt-3 overflow-auto">
                                    <table class="w-full" style="border-collapse: collapse">
                                        <tr class="bg-sky">
                                            <td colspan="6" class="p-2 border text-center text-blue"><?=$lang['25']?> <?=$lang['13']?></td>
                                        </tr>
                                        <tr class="bg-sky">
                                            <td class="p-2 border text-center text-blue"><?=$lang['14']?></td>
                                            <td class="p-2 border text-center text-blue"><?=$lang['15']?> (DF)</td>
                                            <td class="p-2 border text-center text-blue"><?=$lang['16']?> (SS)</td>
                                            <td class="p-2 border text-center text-blue"><?=$lang['17']?> (MS)</td>
                                            <td class="p-2 border text-center text-blue">F-<?=$lang['18']?></td>
                                            <td class="p-2 border text-center text-blue">P-<?=$lang['11']?></td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td class="p-2 border text-center text-blue"><?=$lang['19']?></td>
                                            <td class="p-2 border text-center"><?=$dfb?></td>
                                            <td class="p-2 border text-center"><?=$ssb?></td>
                                            <td class="p-2 border text-center"><?=$msb?></td>
                                            <td class="p-2 border text-center"><?=$f?></td>
                                            <td class="p_value p-2 border text-center"></td>
                                        </tr>
                                        <tr class="bg-white"> 
                                            <td class="p-2 border text-center text-blue"><?=$lang['20']?></td>
                                            <td class="p-2 border text-center"><?=$dfw?></td>
                                            <td class="p-2 border text-center"><?=$ssw?></td>
                                            <td class="p-2 border text-center"><?=$msw?></td>
                                            <td colspan="2" class="p-2 border text-center"></td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td class="p-2 border text-center text-blue"><?=$lang['21']?></td>
                                            <td class="p-2 border text-center"><?=$dfb+$dfw?></td>
                                            <td class="p-2 border text-center"><?=$ssb+$ssw?></td>
                                            <td colspan="3" class="p-2 border text-center"></td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="w-full mt-3"><strong class="text-blue"><?=$lang['22']?>:1 - <?=$lang['16']?> <?=$lang['19']?></strong></p>
                                <p class="w-full mt-3">$$ SS_B = \sum^k_{i=1} n_i(\bar x_i - \bar x)^2 $$</p>
                                <p class="w-full mt-3">$$ SS_B = <?=$s1?> $$</p>
                                <p class="w-full mt-3">$$ SS_B = <?=$ssb?> $$</p>
                                <p class="w-full mt-3"><strong class="text-blue"><?=$lang['22']?>:2 - <?=$lang['16']?> <?=$lang['20']?></strong></p>
                                <p class="w-full mt-3">$$ SS_W = \sum^k_{i=1} (n_i − 1)S_i^{\space 2} $$</p>
                                <p class="w-full mt-3">$$ SS_W = <?=$s2?> $$</p>
                                <p class="w-full mt-3">$$ SS_W = <?=$ssw?> $$</p>
                                <p class="w-full mt-3"><strong class="text-blue"><?=$lang['22']?>:3 - Total <?=$lang['16']?></strong></p>
                                <p class="w-full mt-3">$$ SS_T = SS_B + SS_W $$</p>
                                <p class="w-full mt-3">$$ SS_T = <?="$ssb + $ssw"?> $$</p>
                                <p class="w-full mt-3">$$ SS_T = <?=$ssb+$ssw?> $$</p>
                                <p class="w-full mt-3"><strong class="text-blue"><?=$lang['22']?>:4 - <?=$lang['17']?> <?=$lang['19']?></strong></p>
                
                                <p class="w-full mt-3">$$ MS_B = \dfrac{SS_B}{k - 1} $$</p>
                                <p class="w-full mt-3">$$ MS_B = \dfrac{<?=$ssb?>}{<?=$k?> - 1} $$</p>
                                <p class="w-full mt-3">$$ MS_B = \dfrac{<?=$ssb?>}{<?=$dfb?>} $$</p>
                                <p class="w-full mt-3">$$ MS_B = <?=$msb?> $$</p>
                                <p class="w-full mt-3"><strong class="text-blue"><?=$lang['22']?>:5 - <?=$lang['17']?> <?=$lang['20']?></strong></p>
                                <p class="w-full mt-3">$$ MS_W = \dfrac{SS_W}{N - k} $$</p>
                                <p class="w-full mt-3">$$ MS_W = \dfrac{<?=$ssw?>}{<?=$N?> - <?=$k?>} $$</p>
                                <p class="w-full mt-3">$$ MS_W = \dfrac{<?=$ssw?>}{<?=$dfw?>} $$</p>
                                <p class="w-full mt-3">$$ MS_W = <?=$msw?> $$</p>
                                <p class="w-full mt-3"><strong class="text-blue"><?=$lang['22']?>:6 - <?=$lang['26']?> <?=$lang['23']?> F <?=$lang['24']?> <?=$lang['1']?> <?=$lang['25']?> <?=$lang['26']?></strong></p>
                                <p class="w-full mt-3">$$ F = \dfrac{MS_B}{MS_W} $$</p>
                                <p class="w-full mt-3">$$ F = \dfrac{<?=$msb?>}{<?=$msw?>} $$</p>
                                <p class="w-full mt-3">$$ F = <?=$f?> $$</p>
                                <p class="w-full mt-3"><strong class="text-blue">If F <?=$lang['26']?> <?=$lang['27']?> > <?=$lang['28']?> (<?=$lang['11']?> <?=$lang['41']?> F-<?=$lang['29']?>), <?=$lang['30']?> <?=$lang['32']?></strong></p>
                                <p class="w-full mt-3"><strong class="text-blue">If F <?=$lang['26']?> <?=$lang['27']?> < <?=$lang['28']?> (<?=$lang['11']?> <?=$lang['41']?> F-<?=$lang['29']?>), <?=$lang['31']?> <?=$lang['32']?></strong></p>
                            @else
                                @php
                                    $rows=$detail['rows'];
                                    $columns=$detail['columns'];
                                    $p1=$detail['p1'];
                                    $A=$detail['A'];
                                    $p2_s1=$detail['p2_s1'];
                                    $p2_s2=$detail['p2_s2'];
                                    $p2_s3=$detail['p2_s3'];
                                    $B=$detail['B'];
                                    $p3_s1=$detail['p3_s1'];
                                    $p3_s2=$detail['p3_s2'];
                                    $p3_s3=$detail['p3_s3'];
                                    $C=$detail['C'];
                                    $p4_s1=$detail['p4_s1'];
                                    $p4_s2=$detail['p4_s2'];
                                    $p4_s3=$detail['p4_s3'];
                                    $D=$detail['D'];
                                    $p5_s1=$detail['p5_s1'];
                                    $p5_s2=$detail['p5_s2'];
                                    $E=$detail['E'];
                                    $n=$detail['n'];
                                    $dfa=$rows-1;
                                    $dfb=$columns-1;
                                    $dfab=($rows-1)*($columns-1);
                                    $dfe=$n-($rows*$columns);
                                    $df_total=$n-1;
                                    $sst=$A-$E;
                                    $ssa=$C-$E;
                                    $ssb=$B-$E;
                                    $ssab=$D-$E-$ssa-$ssb;
                                    $sse=$sst-$ssa-$ssb-$ssab;
                                    $msa=$ssa/$dfa;
                                    $msb=$ssb/$dfb;
                                    $msab=$ssab/$dfab;
                                    $mse=$sse/$dfe;
                                    $fa=$msa/$mse;
                                    $fb=$msb/$mse;
                                    $fab=$msab/$mse;
                                    $ssa=round($ssa,4);
                                    $ssb=round($ssb,4);
                                    $ssab=round($ssab,4);
                                    $sse=round($sse,4);
                                    $msa=round($msa,4);
                                    $msb=round($msb,4);
                                    $msab=round($msab,4);
                                    $mse=round($mse,4);
                                    $fa=round($fa,4);
                                    $fb=round($fb,4);
                                    $fab=round($fab,4);
                                    $A=round($A,4);
                                    $B=round($B,4);
                                    $C=round($C,4);
                                    $D=round($D,4);
                                @endphp
                                <div class="w-full mt-2 px-2">
                                    <table class="w-full font-s-18">
                                        <tr>
                                            <td class="text-blue py-2 border-b"><?=$lang['26']?> <?=$lang['10']?> F</td>
                                            <td class="py-2 border-b"><strong>\( <?=$fa?>, <?=$fb?>, <?=$fab?> \)</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-blue py-2 border-b">P-<?=$lang['11']?></td>
                                            <td class="py-2 border-b"><strong><span class="p_value1"></span>, <span class="p_value2"></span>, <span class="p_value3"></span></strong></td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="w-full mt-3"><strong class="text-blue"><?=$lang['12']?>:</strong></p>
                                <div class="w-full mt-3 overflow-auto"><?=$table?></div>
                                <div class="w-full mt-3 overflow-auto"><?=$table1?></div>
                                <p class="w-full mt-3 overflow-auto">$$ \text {Note: } a \Rightarrow \text {<?=$lang['44']?>}, b \Rightarrow \text {<?=$lang['45']?>}, {n \Rightarrow \text {<?=$lang['33']?>}} $$</p>
                                <div class="w-full mt-3 overflow-auto">
                                    <table class="w-full" style="border-collapse: collapse">
                                        <tr class="bg-sky">
                                            <th class="p-2 border text-center text-blue" colspan="6"><?=$lang['25']?> <?=$lang['13']?></th>
                                        </tr>
                                        <tr class="bg-white">
                                            <td class="p-2 border text-center text-blue"><?=$lang['14']?></td>
                                            <td class="p-2 border text-center text-blue"><?=$lang['15']?> (DF)</td>
                                            <td class="p-2 border text-center text-blue"><?=$lang['16']?> (SS)</td>
                                            <td class="p-2 border text-center text-blue"><?=$lang['17']?> (MS)</td>
                                            <td class="p-2 border text-center text-blue">F-<?=$lang['18']?></td>
                                            <td class="p-2 border text-center text-blue">P-<?=$lang['11']?></td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td class="p-2 border text-center text-blue">A</td>
                                            <td class="p-2 border text-center">$$ a - 1 = <?=$dfa?> $$</td>
                                            <td class="p-2 border text-center">$$ <?=$ssa?> $$</td>
                                            <td class="p-2 border text-center">$$ <?=$msa?> $$</td>
                                            <td class="p-2 border text-center">$$ <?=$fa?> $$</td>
                                            <td class="p-2 border text-center p_value1"></td>
                                        </tr>
                                        <tr class="bg-white"> 
                                            <td class="p-2 border text-center text-blue">B</td>
                                            <td class="p-2 border text-center">$$ b - 1 = <?=$dfb?> $$</td>
                                            <td class="p-2 border text-center">$$ <?=$ssb?> $$</td>
                                            <td class="p-2 border text-center">$$ <?=$msb?> $$</td>
                                            <td class="p-2 border text-center">$$ <?=$fb?> $$</td>
                                            <td class="p_value2 p-2 border text-center"></td>
                                        </tr>
                                        <tr class="bg-white"> 
                                            <td class="p-2 border text-center text-blue">AB</td>
                                            <td class="p-2 border text-center">$$ (a - 1)(b - 1) = <?=$dfab?> $$</td>
                                            <td class="p-2 border text-center">$$ <?=$ssab?> $$</td>
                                            <td class="p-2 border text-center">$$ <?=$msab?> $$</td>
                                            <td class="p-2 border text-center">$$ <?=$fab?> $$</td>
                                            <td class="p_value3 p-2 border text-center"></td>
                                        </tr>
                                        <tr class="bg-white"> 
                                            <td class="p-2 border text-center text-blue"><?=$lang['34']?> (<?=$lang['35']?>)</td>
                                            <td class="p-2 border text-center">$$ n - ab = <?=$dfe?> $$</td>
                                            <td class="p-2 border text-center">$$ <?=$sse?> $$</td>
                                            <td class="p-2 border text-center">$$ <?=$mse?> $$</td>
                                            <td colspan="2" class="p-2 border text-center"></td>
                                        </tr>
                                        <tr class="bg-white">
                                            <td class="p-2 border text-center text-blue"><?=$lang['21']?></td>
                                            <td class="p-2 border text-center">$$ n - 1 = <?=$df_total?> $$</td>
                                            <td class="p-2 border text-center">$$ <?=$sst?> $$</td>
                                            <td colspan="3" class="p-2 border text-center"></td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue"><?=$lang['36']?> (A)</strong></p>
                                <p class="w-full mt-3 overflow-auto">$$ \sum x^2 = <?=$p1?> $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ \sum x^2 = <?=$A?> $$</p>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue"><?=$lang['36']?> (B)</strong></p>
                                <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {x_b^2}{n_b} = <?=$p2_s1?> $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {x_b^2}{n_b} = <?=$p2_s2?> $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {x_b^2}{n_b} = <?=$p2_s3?> $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {x_b^2}{n_b} = <?=$B?> $$</p>
                                
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue"><?=$lang['36']?> (C)</strong></p>
                                <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {x_a^2}{n_a} = <?=$p3_s1?> $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {x_a^2}{n_a} = <?=$p3_s2?> $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {x_a^2}{n_a} = <?=$p3_s3?> $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {x_a^2}{n_a} = <?=$C?> $$</p>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue"><?=$lang['36']?> (D)</strong></p>
                                <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {\sum x_{ab}^2}{n_{ab}} = <?=$p4_s1?> $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {\sum x_{ab}^2}{n_{ab}} = <?=$p4_s2?> $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {\sum x_{ab}^2}{n_{ab}} = <?=$p4_s3?> $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ \sum \dfrac {\sum x_{ab}^2}{n_{ab}} = <?=$D?> $$</p>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue"><?=$lang['36']?> (E)</strong></p>
                                <p class="w-full mt-3 overflow-auto">$$ \dfrac {\sum x^2}{n} = <?=$p5_s1?> $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ \dfrac {\sum x^2}{n} = <?=$p5_s2?> $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ \dfrac {\sum x^2}{n} = <?=$E?> $$</p>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue"><?=$lang['22']?>:1 - Total <?=$lang['16']?></strong></p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_T = \sum x^2 - \dfrac {(\sum x)^2}{n} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_T = (A) - (E) $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_T = <?=$A?> - <?=$E?> $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_T = <?=$sst?> $$</p>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue"><?=$lang['22']?>:2 - <?=$lang['16']?> <?=$lang['37']?></strong></p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_A = \sum \dfrac {x^2_a}{n_a} - \dfrac {(\sum x)^2}{n} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_T = (C) - (E) $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_A = <?=$C?> - <?=$E?> $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_A = <?=$ssa?> $$</p>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue"><?=$lang['22']?>:3 - <?=$lang['16']?> <?=$lang['38']?></strong></p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_B = \sum \dfrac {x^2_b}{n_b} - \dfrac {(\sum x)^2}{n} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_T = (B) - (E) $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_B = <?=$B?> - <?=$E?> $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_B = <?=$ssb?> $$</p>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue"><?=$lang['22']?>:4 - <?=$lang['16']?> <?=$lang['39']?></strong></p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_{AB} = \sum \dfrac {\sum x_{ab}^2}{n_{ab}} - \dfrac {(\sum x)^2}{n} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_T = (D) - (E) - SS_A - SS_B $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_{AB} = <?=$D?> - <?=$E?> - <?=$ssa?> - <?=$ssb?> $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_{AB} = <?=$ssab?> $$</p>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue"><?=$lang['22']?>:5 - <?=$lang['16']?> <?=$lang['34']?> (<?=$lang['35']?>)</strong></p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_E = SS_T - SS_A - SS_B - SS_{AB} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_E = <?=$sst?> - <?=$ssa?> - <?=$ssb?> - <?=$ssab?> $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ SS_E = <?=$sse?> $$</p>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue"><?=$lang['40']?> <?=$lang['17']?> <?=$lang['37']?></strong></p>
                                <p class="w-full mt-3 overflow-auto">$$ MS_A = \dfrac {SS_A}{DF_A} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ MS_A = \dfrac {<?=$ssa?>}{<?=$dfa?>} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ MS_A = <?=$msa?> $$</p>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue"><?=$lang['40']?> <?=$lang['17']?> <?=$lang['38']?></strong></p>
                                <p class="w-full mt-3 overflow-auto">$$ MS_B = \dfrac {SS_B}{DF_B} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ MS_B = \dfrac {<?=$ssb?>}{<?=$dfb?>} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ MS_B = <?=$msb?> $$</p>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue"><?=$lang['40']?> <?=$lang['17']?> <?=$lang['39']?></strong></p>
                                <p class="w-full mt-3 overflow-auto">$$ MS_{AB} = \dfrac {SS_{AB}}{DF_{AB}} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ MS_{AB} = \dfrac {<?=$ssab?>}{<?=$dfab?>} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ MS_{AB} = <?=$msab?> $$</p>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue"><?=$lang['40']?> <?=$lang['17']?> <?=$lang['24']?> <?=$lang['34']?></strong></p>
                                <p class="w-full mt-3 overflow-auto">$$ MS_E = \dfrac {SS_E}{DF_E} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ MS_E = \dfrac {<?=$sse?>}{<?=$dfe?>} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ MS_E = <?=$mse?> $$</p>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue"><?=$lang['40']?> F-<?=$lang['10']?> <?=$lang['24']?> <?=$lang['42']?></strong></p>
                                <p class="w-full mt-3 overflow-auto">$$ F_A = \dfrac {MS_A}{MS_E} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ F_A = \dfrac {<?=$msa?>}{<?=$mse?>} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ F_A = <?=$fa?> $$</p>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue"><?=$lang['40']?> F-<?=$lang['10']?> <?=$lang['24']?> <?=$lang['43']?></strong></p>
                                <p class="w-full mt-3 overflow-auto">$$ F_B = \dfrac {MS_B}{MS_E} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ F_B = \dfrac {<?=$msb?>}{<?=$mse?>} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ F_B = <?=$fb?> $$</p>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue"><?=$lang['40']?> F-<?=$lang['10']?> <?=$lang['24']?> <?=$lang['42']?> & <?=$lang['43']?></strong></p>
                                <p class="w-full mt-3 overflow-auto">$$ F_AB = \dfrac {MS_AB}{MS_E} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ F_AB = \dfrac {<?=$msab?>}{<?=$mse?>} $$</p>
                                <p class="w-full mt-3 overflow-auto">$$ F_AB = <?=$fab?> $$</p>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue">If F <?=$lang['26']?> <?=$lang['27']?> > <?=$lang['28']?> (<?=$lang['11']?> <?=$lang['41']?> F-<?=$lang['29']?>), <?=$lang['30']?> <?=$lang['32']?></strong></p>
                                <p class="w-full mt-3 overflow-auto"><strong class="text-blue">If F <?=$lang['26']?> <?=$lang['27']?> < <?=$lang['28']?> (<?=$lang['11']?> <?=$lang['41']?> F-<?=$lang['29']?>), <?=$lang['31']?> <?=$lang['32']?></strong></p>
                            @endif
                            <div class="w-full text-center mt-3">
                                <a href="{{ url()->current() }}">
                                    <button type="button" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3">{{ $lang['reset'] }}</button>
                                </a>
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
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jstat@latest/dist/jstat.min.js"></script>
    @endif
    <script>
        @if (isset($detail))
            <?php if($submit==='one_way'){ ?>
                var p_val = 1-jStat.centralF.cdf(<?=$f?>,<?=$dfb?>,<?=$dfw?>);
                document.querySelectorAll('.p_value').forEach(function(el) {
                    el.innerHTML = p_val.toFixed(4);
                });
            <?php }elseif($submit==='two_way'){ ?>
                var p_val1 = 1-jStat.centralF.cdf(<?=$fa?>,<?=$dfa?>,<?=$dfe?>);
                var p_val2 = 1-jStat.centralF.cdf(<?=$fb?>,<?=$dfb?>,<?=$dfe?>);
                var p_val3 = 1-jStat.centralF.cdf(<?=$fab?>,<?=$dfab?>,<?=$dfe?>);
                // Assuming p_val, p_val1, p_val2, and p_val3 are defined variables

                document.querySelectorAll('.p_value1').forEach(function(el) {
                    el.innerHTML = `\\( ${p_val1.toFixed(4)} \\)`;
                });

                document.querySelectorAll('.p_value2').forEach(function(el) {
                    el.innerHTML = `\\( ${p_val2.toFixed(4)} \\)`;
                });

                document.querySelectorAll('.p_value3').forEach(function(el) {
                    el.innerHTML = `\\( ${p_val3.toFixed(4)} \\)`;
                });

            <?php } ?>
            <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
        @endif
        @if (!isset($detail))
            // Event listener for tab1 click
            document.getElementById('tab1').addEventListener('click', function() {
                document.getElementById('type').value = 'one_way';
                this.classList.add('tagsUnit');
                document.getElementById('tab2').classList.remove('tagsUnit');
                document.querySelectorAll('.one_way').forEach(el => el.style.display = 'block');
                document.querySelectorAll('.two_way').forEach(el => el.style.display = 'none');
            });

            // Event listener for tab2 click
            document.getElementById('tab2').addEventListener('click', function() {
                document.getElementById('type').value = 'two_way';
                this.classList.add('tagsUnit');
                document.getElementById('tab1').classList.remove('tagsUnit');
                document.querySelectorAll('.two_way').forEach(el => el.style.display = 'block');
                document.querySelectorAll('.one_way').forEach(el => el.style.display = 'none');
            });

            // Trigger the tab based on the value of #type
            let tab = document.getElementById('type').value;
            if (tab=='one_way') {
                document.getElementById('tab1').click();
            }else{
                document.getElementById('tab2').click();
            }

            function add_textarea(i) {
                var html = `
                    <div class="col-lg-7 mx-auto px-2 group">
                        <label for="group${i}" class="font-s-14 text-blue">Group ${i}:</label>
                        <div class="w-full py-2">
                            <textarea name="group${i}" id="group${i}" class="textareaInput" aria-label="input" placeholder="e.g. 0, 1, 4, 6, 3"></textarea>
                        </div>
                    </div>
                `;
                document.querySelector('.add_groups').insertAdjacentHTML('beforeend', html);
            }

            var i = 3;

            // Event listener for adding textarea
            document.getElementById('add').addEventListener('click', function() {
                i++;
                if (i == 11) {
                    alert('Only 10 fields are allowed');
                    i--;
                    return;
                } else {
                    add_textarea(i);
                    document.getElementById('i').value = i;                
                }
            });


            // Event listener for deleting textarea
            document.getElementById('del').addEventListener('click', function() {
                var groups = document.querySelectorAll('.group');
                if (groups.length > 0) {
                    groups[groups.length - 1].remove();
                    i--;
                    document.getElementById('i').value = i;
                }
            });

            var row = 3;

            // Event listener for adding rows
            document.getElementById('add_row').addEventListener('click', function() {
                var table = document.getElementById('input_table');
                var tdlen = table.rows[0].cells.length;
                var trlen = table.rows.length;
                if (row < 10) {
                    var newRow = table.insertRow();
                    for (var j = 0; j < tdlen; j++) {
                        var newCell = newRow.insertCell();
                        newCell.innerHTML = '<input type="text" class="input" style="width: 100px" name="td_' + trlen + '_' + j + '">';
                    }
                    row++;
                    document.getElementById('rows').value = row;
                }
            });

            // Event listener for deleting rows
            document.getElementById('del_row').addEventListener('click', function() {
                var table = document.getElementById('input_table');
                if (table.rows.length > 2) {
                    table.deleteRow(-1);
                    row--;
                    document.getElementById('rows').value = row;
                }
            });

            var column = 4;

            // Event listener for adding columns
            document.getElementById('add_column').addEventListener('click', function() {
                if (column < 10) {
                    var table = document.getElementById('input_table');
                    Array.from(table.rows).forEach(function(row, index) {
                        var newCell = row.insertCell();
                        newCell.innerHTML = '<input type="text" class="input" style="width: 100px" name="td_' + index + '_' + (row.cells.length - 1) + '">';
                    });
                    column++;
                    document.getElementById('columns').value = column;
                }
            });

            // Event listener for deleting columns
            document.getElementById('del_column').addEventListener('click', function() {
                var table = document.getElementById('input_table');
                if (table.rows[0].cells.length > 2) {
                    Array.from(table.rows).forEach(function(row) {
                        row.deleteCell(-1);
                    });
                    column--;
                    document.getElementById('columns').value = column;
                }
            });
        @endif
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>