<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
        @endif
        <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12   mt-3  gap-4">
                <div class="col-span-6">
                    <label for="myselection" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="type" id="myselection" class="input">
                            @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {!! $arr2[$index] !!}
                                </option>
                            @php
                            }}
                            $name = ["Equal variances","Unequal variances"];
                            $val = ["equal","unequal"];
                            optionsList($val,$name,isset($_POST['type'])?$_POST['type']:'equal');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="formula_change" class="label">{{ $lang['2'] }}:</label>
                    <div class="w-100 py-2 position-relative">
                        <select name="ronding" id="formula_change" class="input">
                            @php
                            $name = ["1", "2", "3","4", "5", "6","7", "8", "9","10"];
                            $val = ["1", "2", "3","4", "5", "6","7", "8", "9","10"];
                            optionsList($val,$name,isset($_POST['ronding'])?$_POST['ronding']:'4');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12  text-center flex items-center">
                    <div class="d-flex align-items-center">
                        @if (isset($_POST['option']))
                        @if ($_POST['option']=='sum')
                        <input name="option" id="option" value="sum" class="r_data" type="radio" checked />
                        @else
                        <input name="option" id="option" value="sum" class="r_data" type="radio" />
                        @endif
                        @else
                        <input name="option" id="option" value="sum" class="r_data" type="radio" checked />
                        @endif
                        <label for="option" class="label text-blue pe-lg-3 px-1">{{ $lang['3'] }}</label>
                        @if (isset($_POST['option']) && $_POST['option']=='raw')
                        <input name="option" id="option1" value="raw" class="s_data" type="radio" checked />
                        @else
                        <input name="option" id="option1" value="raw" class="s_data" type="radio" />
                        @endif
                        <label for="option1" class="label text-blue ps-1">{{ $lang['4'] }}</label>
                    </div>
                </div>
                <div class="col-span-12 sum {{ isset($_POST['option']) && $_POST['option']=='raw' ? 'hidden':'' }}">
                    <div class="grid grid-cols-12    gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="s1" class="label text-blue"><?= $lang['5'] ?> (S<sub class="text-blue">1</sub>):</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="s1" id="s1" value="{{ isset($_POST['s1'])?$_POST['s1']:'2' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="s2" class="label text-blue"><?= $lang['5'] ?> (S₂):</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="s2" id="s2" value="{{ isset($_POST['s2'])?$_POST['s2']:'5' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="n1" class="label text-blue"><?= $lang['6'] ?> (n<sub class="text-blue">1</sub>):</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="n1" id="n1" value="{{ isset($_POST['n1'])?$_POST['n1']:'2' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="n2" class="label text-blue"><?= $lang['6'] ?> (n₂):</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" name="n2" id="n2" value="{{ isset($_POST['n2'])?$_POST['n2']:'4' }}" class="input" aria-label="input" placeholder="00" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="raw {{ !isset($_POST['option']) || $_POST['option']!='raw' ? 'hidden':'' }} col-span-12">
                    <div class="grid grid-cols-12     gap-4">
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="g1" class="label text-blue">{{ $lang['7'] }} ( , )</label>
                            <div class="w-100 py-2">
                                <textarea name="g1" id="g1" class="textareaInput" aria-label="input" placeholder="e.g. 1, 2, 3, 4, 5">{{ isset($_POST['g1'])?$_POST['g1']:'1, 2, 3, 4, 5' }}</textarea>
                            </div>
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-6">
                            <label for="g2" class="label text-blue">{{ $lang['8'] }} ( , )</label>
                            <div class="w-100 py-2">
                                <textarea name="g2" id="g2" class="textareaInput" aria-label="input" placeholder="e.g. 2, 2, 3, 2, 2">{{ isset($_POST['g2'])?$_POST['g2']:'2, 2, 3, 2, 2' }}</textarea>
                            </div>
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
                            $option = request()->option;
                            error_reporting(0);
                        @endphp
                        <?php if (isset($detail['type'])) { ?>
                            <?php if ($detail['type'] == 'equal') { ?>
                                <div class="text-center">
                                    <p class="text-[18px]">
                                        <strong><?= $lang[9] ?></strong>
                                    </p>
                                </div>
                                <?php if ($option == 'sum') { ?>
                                    <div class="flex justify-center">                            
                                        <p class="text-[22px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                            <strong class="text-white">{{ $detail['sp2'] }}</strong>
                                        </p>
                                    </div>
                                    
                                    <p class="w-full mt-2 text-[18px] text-blue"><?= $lang['10'] ?></p>
                                    <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1  mt-2 overflow-auto">
                                        <table class="w-100">
                                            <tr>
                                                <td class="py-2 border-b"><?php echo $lang["11"];?></td>
                                                <td class="py-2 border-b"><strong class="text-blue"><?php echo $detail['sp'];?></strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><?php echo $lang["12"];?></td>
                                                <td class="py-2 border-b"><strong class="text-blue"><?php echo $detail['sqrsp2'];?></strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><?php echo $lang["13"];?> (df)</td>
                                                <td class="py-2 border-b"><strong class="text-blue"><?php echo $detail['n1'] + $detail['n2'] - 2;?></strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p class="w-full mt-3 text-[18px]"><?= $lang['14'] ?></p>
                                    <p class="w-full mt-3 overflow-auto">\(S_p^2 = \dfrac{(n -1)S_1^2 + (n_2 - 1)S_2^2}{n_1 + n_2 - 2}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\(S_p^2 = \dfrac{(<?= $detail['n1']; ?> -1)(<?= $detail['s1']; ?>)^2 + (<?= $detail['n2']; ?> - 1)(<?= $detail['s2']; ?>)^2}{<?= $detail['n1']; ?> + <?= $detail['n2']; ?> - 2}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\(S_p^2 = \dfrac{(<?= $detail['n1_1']; ?>)(<?= $detail['ps1']; ?>) + (<?= $detail['n2_1']; ?>)(<?= $detail['ps2']; ?>)}{<?= $detail['devi']; ?>}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\(S_p^2 = \dfrac{<?= $detail['n1s1']; ?> + <?= $detail['n2s2']; ?>}{<?= $detail['devi']; ?>}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\(S_p^2 = \dfrac{<?= $detail['res']; ?>}{<?= $detail['devi']; ?>}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\(S_p^2 = <?= $detail['sp2']; ?>\)</p>
                                    <p class="w-full mt-3 text-[18px]"><?= $lang['15'] ?></p>
                                    <p class="w-full mt-3 overflow-auto">\(S_p^2 = <?= $detail['sp2']; ?>\)</p>
                                    <p class="w-full mt-3"><?= $lang['16'] ?></p>
                                    <p class="w-full mt-3 overflow-auto">\(\sqrt{(S_p)^2} = \sqrt{<?= $detail['sp2']; ?>}\)</p>
                                    <p class="w-full mt-3">\(S_p = <?= $detail['sqrsp2']; ?>\)</p>
                                    <p class="w-full mt-3 text-[18px]"><?= $lang['12'] ?></p>
                                    <p class="w-full mt-3 overflow-auto">\(SE = S_{\bar x_1 - \bar x_2} = S_p \sqrt{\dfrac{1}{n_1} + \dfrac{1}{n_2}}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\(SE = <?= $detail['sqrsp2']; ?> \sqrt{\dfrac{1}{<?= $detail['n1']; ?>} + \dfrac{1}{<?= $detail['n2']; ?>}}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\(SE = <?= $detail['sqrsp2']; ?> \sqrt{<?= 1 / $detail['n1']; ?> + <?= 1 / $detail['n2']; ?>}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\(SE = <?= $detail['sqrsp2']; ?> \sqrt{<?= $detail['devn1']; ?> + <?= $detail['devn2']; ?>}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\(SE = <?= $detail['sqrsp2']; ?> \sqrt{<?= $detail['devres'] ?>}\)</p>
                                    <p class="w-full mt-3">\(SE = <?= $detail['sqrsp2']; ?> * <?= $detail['sqrdevres'] ?>\)</p>
                                    <p class="w-full mt-3">\(SE = <?= $detail['sp'] ?>\)</p>
                                    <p class="w-full mt-3 text-[18px]"><?= $lang['13'] ?></p>
                                    <p class="w-full mt-3">\(df = n_1 + n_2 - 2\)</p>
                                    <p class="w-full mt-3">\(df = <?= $detail['n1'] ?> + <?= $detail['n2'] ?> - 2\)</p>
                                    <p class="w-full mt-3">\(df = <?= $detail['n1'] + $detail['n2'] ?> - 2\)</p>
                                    <p class="w-full mt-3">\(df = <?= $detail['n1'] + $detail['n2'] - 2 ?> \)</p>
                                <?php } ?>
                                <?php if ($option == 'raw') { ?>
                                    <div class="text-center">                            
                                        <p class="font-s-21 bg-sky px-3 py-2 radius-10 d-inline-block my-3">
                                            <strong class="text-blue">{{ $detail['pvres'] }}</strong>
                                        </p>
                                    </div>
                                    <p class="w-full mt-2 text-[18px] text-blue"><?= $lang['10'] ?></p>
                                    <div class="col-lg-8 mt-2 overflow-auto">
                                        <table class="w-100">
                                            <tr>
                                                <td class="py-2 border-b"><?php echo $lang["17"];?> (Sp)</td>
                                                <td class="py-2 border-b"><strong class="text-blue"><?php echo round($detail['sqrpvres'], 4);?></strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><?php echo $lang["12"];?></td>
                                                <td class="py-2 border-b"><strong class="text-blue"><?php echo round($detail['seres'], 4);?></strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><?php echo $lang["13"];?> (df)</td>
                                                <td class="py-2 border-b"><strong class="text-blue"><?php echo $detail['i'] + $detail['i1'] - 2;?></strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p class="w-full mt-3 text-[18px]"><?= $lang['18'] ?>:</p>
                                    <p class="w-full mt-3"><?= $lang['19'] ?> = <?= $detail['countn'] ?></p>
                                    <p class="w-full mt-3"><?= $lang['20'] ?> = <?= $detail['sum'] ?></p>
                                    <p class="w-full mt-3"><?= $lang['21'] ?> = <?= $detail['sum'] / $detail['countn'] ?></p>
                                    <div class="w-full mt-2 overflow-auto">
                                        <?php echo $detail["table"] ?>
                                    </div>
                                    <p class="w-full mt-4">\(\text {Variance} \)</p>
                                    <p class="w-full mt-2">\(S^2 = \dfrac{SS}{n - 1}\)</p>
                                    <p class="w-full mt-2 overflow-auto">\( = \dfrac{\Sigma(x_i - \bar x)^2}{n -1} \)</p>
                                    <p class="w-full mt-2 overflow-auto">\(= \dfrac{<?= $detail['ar_sum'] ?>}{<?= $detail['i'] ?> - 1}\)</p>
                                    <p class="w-full mt-2 overflow-auto">\(= \dfrac{<?= $detail['ar_sum'] ?>}{<?= $detail['i'] - 1 ?>}\)</p>
                                    <p class="w-full mt-2">\(= <?= $detail['v'] ?>\)</p>
                                    <p class="w-full mt-4">\(\text {Standard Deviation} \)</p>
                                    <p class="w-full mt-2">\(S = \sqrt {S^2}\)</p>
                                    <p class="w-full mt-2">\( = \sqrt {<?= $detail['v'] ?>}\)</p>
                                    <p class="w-full mt-2 overflow-auto">\( = <?= round($detail['vsqrt'], 4) ?>\)</p>
                                    <p class="w-full mt-3 text-[18px]"><?= $lang['22'] ?>:</p>
                                    <p class="w-full mt-3"><?= $lang['19'] ?> = <?= $detail['countn1'] ?></p>
                                    <p class="w-full mt-3"><?= $lang['20'] ?> = <?= $detail['sum1'] ?></p>
                                    <p class="w-full mt-3"><?= $lang['21'] ?> = <?= $detail['sum1'] / $detail['countn1'] ?></p>
                                    <div class="w-full mt-2 overflow-auto">
                                        <?php echo $detail["table1"] ?>
                                    </div>
                                    <p class="w-full mt-4">\(\text {Variance} \)</p>
                                    <p class="w-full mt-2">\(S^2 = \dfrac{SS}{n - 1}\)</p>
                                    <p class="w-full mt-2">\( = \dfrac{\Sigma(x_i - \bar x)^2}{n -1} \)</p>
                                    <p class="w-full mt-2">\(= \dfrac{<?= $detail['ar_sum1'] ?>}{<?= $detail['i1'] ?> - 1}\)</p>
                                    <p class="w-full mt-2">\(= \dfrac{<?= $detail['ar_sum1'] ?>}{<?= $detail['i1'] - 1 ?>}\)</p>
                                    <p class="w-full mt-2">\(= <?= $detail['v1'] ?>\)</p>
                                    <p class="w-full mt-4 overflow-auto">\(\text {Standard Deviation} \)</p>
                                    <p class="w-full mt-2">\(S = \sqrt {S^2}\)</p>
                                    <p class="w-full mt-2">\( = \sqrt {<?= $detail['v1'] ?>}\)</p>
                                    <p class="w-full mt-2">\( = <?= $detail['vsqrt1'] ?>\)</p>
                                    <p class="w-full mt-4 overflow-auto">\(\text {Now we have} \)</p>
                                    <p class="w-full mt-2 overflow-auto">\(S_1 = <?= $detail['vsqrt'] ?> &ensp; ; &ensp; n_1 = <?= $detail['i'] ?>\)</p>
                                    <p class="w-full mt-2 overflow-auto">\(S_2 = <?= $detail['vsqrt1'] ?> &ensp; ; &ensp; n_2 = <?= $detail['i1'] ?>\)</p>
                                    <p class="w-full mt-4 overflow-auto">\(\text {Pooled Variance} \)</p>
                                    <p class="w-full mt-2 overflow-auto">\(S_p^2 = \dfrac{(n_1 -1)S_1^2 + (n_2 - 1)S_2^2}{n_1 + n_2 + 2}\)</p>
                                    <p class="w-full mt-2 overflow-auto">\( = \dfrac{(<?= $detail['i'] ?> -1)(<?= round($detail['vsqrt'], 4) ?>)^2 + (<?= $detail['i1'] ?> - 1)(<?= round($detail['vsqrt1'], 4) ?>)^2}{<?= $detail['i'] ?> + <?= $detail['i1'] ?> - 2}\)</p>
                                    <p class="w-full mt-2 overflow-auto">\( = \dfrac{(<?= $detail['vrres'] ?>)(<?= $detail['s12'] ?>) + (<?= $detail['vrres1'] ?>)(<?= $detail['s22'] ?>)}{<?= $detail['i'] + $detail['i1'] - 2 ?>}\)</p>
                                    <p class="w-full mt-2 overflow-auto">\( = \dfrac{(<?= $detail['ress12'] ?>) + (<?= $detail['ress22'] ?>)}{<?= $detail['i'] + $detail['i1'] - 2 ?>}\)</p>
                                    <p class="w-full mt-2 overflow-auto">\( = \dfrac{(<?= $detail['pv'] ?>)}{<?= $detail['i'] + $detail['i1'] - 2 ?>}\)</p>
                                    <p class="w-full mt-2">\( = <?= $detail['pvres'] ?>\)</p>
                                    <p class="w-full mt-4">\(\text {Pooled Standard Deviation} \)</p>
                                    <p class="w-full mt-2">\(S_p = \sqrt{Sp^2}\)</p>
                                    <p class="w-full mt-2">\( = \sqrt{<?= $detail['pvres'] ?>}\)</p>
                                    <p class="w-full mt-2">\( = <?= $detail['sqrpvres'] ?>\)</p>
                                    <p class="w-full mt-4">\(\text {Standard Error} \)</p>
                                    <p class="w-full mt-2 overflow-auto">\(SE = S_{\bar x_1 - \bar x_2} = S_p \sqrt{\dfrac{1}{n_1} + \dfrac{1}{n_2}}\)</p>
                                    <p class="w-full mt-2 overflow-auto">\( =<?= $detail['sqrpvres'] ?> \sqrt{\dfrac{1}{<?= $detail['i'] ?>} + \dfrac{1}{<?= $detail['i1'] ?>}}\)</p>
                                    <p class="w-full mt-2 overflow-auto">\( =<?= $detail['sqrpvres'] ?> \sqrt{<?= $detail['devn1'] ?> + <?= $detail['devn12'] ?>}\)</p>
                                    <p class="w-full mt-2 overflow-auto">\( =<?= $detail['sqrpvres'] ?> \sqrt{<?= $detail['resdev'] ?>}\)</p>
                                    <p class="w-full mt-2">\( =<?= $detail['sqrpvres'] ?> * <?= $detail['sqrresdev'] ?>\)</p>
                                    <p class="w-full mt-2">\( =<?= $detail['seres'] ?>\)</p>
                                    <p class="w-full mt-4">\(\text {Degree of freedom} \)</p>
                                    <p class="w-full mt-2">\(df = n_1 +n_2 - 2\)</p>
                                    <p class="w-full mt-2">\( = <?= $detail['i'] ?> + <?= $detail['i1'] ?> - 2\)</p>
                                    <p class="w-full mt-2">\( = <?= $detail['i'] + $detail['i1'] ?> - 2\)</p>
                                    <p class="w-full mt-2">\( = <?= $detail['i'] + $detail['i1'] - 2 ?>\)</p>
                                <?php } ?>
                            <?php } elseif ($detail['type'] == 'unequal') { ?>
                                <?php if ($option == 'sum') { ?>
                                    <div class="text-center">
                                        <p class="text-[18px] bg-sky px-3 py-2 radius-10 d-inline-block my-3">
                                            <strong class="text-blue">{{ $lang['23'] }}</strong>
                                        </p>
                                    </div>
            
                                    <p class="w-full mt-2 text-[18px] text-blue"><?= $lang['10'] ?></p>
                                    <div class="col-lg-8 mt-2 overflow-auto">
                                        <table class="w-100">
                                            <tr>
                                                <td class="py-2 border-b"><?php echo $lang["12"];?></td>
                                                <td class="py-2 border-b"><strong class="text-blue"><?php echo $detail['seround'];?></strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><?php echo $lang["24"];?></td>
                                                <td class="py-2 border-b"><strong class="text-blue"><?php echo $detail['devs1sm'];?></strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p class="w-full mt-3 text-[18px]"><?= $lang['12'] ?></p>
                                    <p class="w-full mt-3 overflow-auto">\(SE = S_{\bar x_1 - \bar x_2} = \sqrt{\dfrac{S_1^2}{n_1} + \dfrac{S_2^2}{n_2}}\)</p>
                                    <p class="w-full mt-3" overflow-auto>\( = <?= $detail['sqrsp2']; ?> \sqrt{\dfrac{(<?= $detail['s1']; ?>)^2}{<?= $detail['n1']; ?>} + \dfrac{(<?= $detail['s2']; ?>)^2}{<?= $detail['n2']; ?>}}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\( = <?= $detail['sqrsp2']; ?> \sqrt{\dfrac{<?= $detail['ps1']; ?>}{<?= $detail['n1']; ?>} + \dfrac{<?= $detail['ps2']; ?>}{<?= $detail['n2']; ?>}}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\( = <?= $detail['sqrsp2']; ?> \sqrt{<?= $detail['devs1n1']; ?> + <?= $detail['devs2n2']; ?>}\)</p>
                                    <p class="w-full mt-3">\( = <?= $detail['sqrsp2']; ?> \sqrt{<?= $detail['se']; ?>}\)</p>
                                    <p class="w-full mt-3">\( = <?= $detail['seround'] ?>\)</p>
                                    <p class="w-full mt-3 text-[18px]"><?= $lang['24'] ?></p>
                                    <p class="w-full mt-3 overflow-auto">\(df = \dfrac{(\dfrac{S_1^2}{n_1} + \dfrac{S_2^2}{n_2})^2}{\dfrac{S_1^4}{n_1^2(n_1-1)} + \dfrac{S_2^4}{n_2^2(n_2-1)}}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\( = \dfrac{(\dfrac{<?= $detail['s1']; ?>^2}{<?= $detail['n1']; ?>} + \dfrac{<?= $detail['s2']; ?>^2}{<?= $detail['n2']; ?>})^2}{\dfrac{<?= $detail['s1']; ?>^4}{<?= $detail['n1']; ?>^2(<?= $detail['n1']; ?>-1)} + \dfrac{<?= $detail['s2']; ?>^4}{<?= $detail['n2']; ?>^2(<?= $detail['n2']; ?>-1)}}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\( = \dfrac{(\dfrac{<?= $detail['ps1']; ?>}{<?= $detail['n1']; ?>} + \dfrac{<?= $detail['ps2']; ?>}{<?= $detail['n2']; ?>})^2}{\dfrac{<?= $detail['ps14']; ?>}{<?= $detail['pn1']; ?>(<?= $detail['devn1']; ?>)} + \dfrac{<?= $detail['ps24']; ?>}{<?= $detail['pn2']; ?>(<?= $detail['devn2']; ?>)}}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\( = \dfrac{(\dfrac{<?= $detail['ps1']; ?>}{<?= $detail['n1']; ?>} + \dfrac{<?= $detail['ps2']; ?>}{<?= $detail['n2']; ?>})^2}{\dfrac{<?= $detail['ps14']; ?>}{<?= $detail['pn1'] * $detail['devn1'] ?>} + \dfrac{<?= $detail['ps24']; ?>}{<?= $detail['pn2'] * $detail['devn2'] ?>}}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\( = \dfrac{(<?= $detail['devs1n1']; ?> + <?= $detail['devs2n2']; ?>)^2}{<?= $detail['devpspn']; ?> + <?= round($detail['psmpn'], 4); ?>}\)</p>
                                    <p class="w-full mt-3">\( = \dfrac{(<?= $detail['devs1s2']; ?>)^2}{<?= round($detail['devpsmp'], 4); ?> }\)</p>
                                    <p class="w-full mt-3">\( = \dfrac{<?= round($detail['powdevs1s2'], 4); ?>}{<?= round($detail['devpsmp'], 4); ?> }\)</p>
                                    <p class="w-full mt-3">\( = <?= $detail['devs1sm']; ?>\)</p>
                                <?php } ?>
                                <?php if ($option == 'raw') { ?>
                                    <div class="text-center">
                                        <p class="text-[18px] bg-sky px-3 py-2 radius-10 d-inline-block my-3">
                                            <strong class="text-blue">{{ $lang['23'] }}</strong>
                                        </p>
                                    </div>
                                    <p class="w-full mt-2 text-[18px] text-blue"><?= $lang['10'] ?></p>
                                    <div class="col-lg-8 mt-2 overflow-auto">
                                        <table class="w-full">
                                            <tr>
                                                <td class="py-2 border-b"><?php echo $lang["12"];?></td>
                                                <td class="py-2 border-b"><strong class="text-blue"><?php echo $detail['sqrresdev'];?></strong></td>
                                            </tr>
                                            <tr>
                                                <td class="py-2 border-b"><?php echo $lang["24"];?></td>
                                                <td class="py-2 border-b"><strong class="text-blue"><?php echo $detail['dftres'];?></strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <p class="w-full mt-3 text-[18px]"><?= $lang['18'] ?>:</p>
                                    <p class="w-full mt-3"><?= $lang['19'] ?> = <?= $detail['countn'] ?></p>
                                    <p class="w-full mt-3"><?= $lang['20'] ?>= <?= $detail['sum'] ?></p>
                                    <p class="w-full mt-3"><?= $lang['21'] ?>= <?= $detail['sum'] / $detail['countn'] ?></p>
            
                                    <div class="w-full mt-2 overflow-auto">
                                        <?php echo $detail["table"] ?>
                                    </div>
                                    <p class="w-full mt-4">\(\text {Variance} \)</p>
                                    <p class="w-full mt-2">\(S^2 = \dfrac{SS}{n - 1}\)</p>
                                    <p class="w-full mt-2">\( = \dfrac{\Sigma(x_i - \bar x)^2}{n -1} \)</p>
                                    <p class="w-full mt-2">\(= \dfrac{<?= $detail['ar_sum'] ?>}{<?= $detail['i'] ?> - 1}\)</p>
                                    <p class="w-full mt-2">\(= \dfrac{<?= $detail['ar_sum'] ?>}{<?= $detail['i'] - 1 ?>}\)</p>
                                    <p class="w-full mt-2">\(= <?= $detail['v'] ?>\)</p>
                                    <p class="w-full mt-4">\(\text {Standard Deviation} \)</p>
                                    <p class="w-full mt-2">\(S = \sqrt {S^2}\)</p>
                                    <p class="w-full mt-2">\( = \sqrt {<?= $detail['v'] ?>}\)</p>
                                    <p class="w-full mt-2">\( = <?= $detail['vsqrt'] ?>\)</p>
                                    <p class="w-full mt-3 text-[18px]"><?= $lang['22'] ?>:</p>
                                    <p class="w-full mt-3"> <?= $lang['19'] ?>= <?= $detail['countn1'] ?></p>
                                    <p class="w-full mt-3"><?= $lang['20'] ?> = <?= $detail['sum1'] ?></p>
                                    <p class="w-full mt-3"><?= $lang['21'] ?> = <?= $detail['sum1'] / $detail['countn1'] ?></p>
                                    <div class="w-full mt-2 overflow-auto">
                                        <?php echo $detail["table1"] ?>
                                    </div>
                                    <p class="w-full mt-4">\(\text {Variance} \)</p>
                                    <p class="w-full mt-2">\(S^2 = \dfrac{SS}{n - 1}\)</p>
                                    <p class="w-full mt-2">\( = \dfrac{\Sigma(x_i - \bar x)^2}{n -1} \)</p>
                                    <p class="w-full mt-2">\(= \dfrac{<?= $detail['ar_sum1'] ?>}{<?= $detail['i1'] ?> - 1}\)</p>
                                    <p class="w-full mt-2">\(= \dfrac{<?= $detail['ar_sum1'] ?>}{<?= $detail['i1'] - 1 ?>}\)</p>
                                    <p class="w-full mt-2">\(= <?= $detail['v1'] ?>\)</p>
                                    <p class="w-full mt-4">\(\text {Standard Deviation} \)</p>
                                    <p class="w-full mt-2">\(S = \sqrt {S^2}\)</p>
                                    <p class="w-full mt-2">\( = \sqrt {<?= $detail['v1'] ?>}\)</p>
                                    <p class="w-full mt-2">\( = <?= $detail['vsqrt1'] ?>\)</p>
                                    <p class="w-full mt-4">\(\text {Now we have} \)</p>
                                    <p class="w-full mt-2">\(S_1 = <?= $detail['vsqrt'] ?> &ensp; ; &ensp; n_1 = <?= $detail['i'] ?>\)</p>
                                    <p class="w-full mt-2">\(S_2 = <?= $detail['vsqrt1'] ?> &ensp; ; &ensp; n_2 = <?= $detail['i1'] ?>\)</p>
                                    <p class="w-full mt-4">\(\text {Standard Error} \)</p>
                                    <p class="w-full mt-2 overflow-auto">\(SE = S_{\bar x_1 - \bar x_2} = \sqrt{\dfrac{S_1^2}{n_1} + \dfrac{S_2^2}{n_2}}\)</p>
                                    <p class="w-full mt-2 overflow-auto">\( =\sqrt{\dfrac{<?= $detail['vsqrt'] ?>^2}{<?= $detail['i'] ?>} + \dfrac{<?= $detail['vsqrt1'] ?>^2}{<?= $detail['i1'] ?>}}\)</p>
                                    <p class="w-full mt-2 overflow-auto">\( =\sqrt{\dfrac{<?= $detail['s12'] ?>}{<?= $detail['i'] ?>} + \dfrac{<?= $detail['s22'] ?>}{<?= $detail['i1'] ?>}}\)</p>
                                    <p class="w-full mt-2 overflow-auto">\( =\sqrt{<?= round($detail['vsqi'], 4) ?> + <?= round($detail['vsqi1'], 4) ?>}\)</p>
                                    <p class="w-full mt-2 overflow-auto">\( =\sqrt{<?= round($detail['resdev'], 4) ?>}\)</p>
                                    <p class="w-full mt-2">\( =<?= $detail['sqrresdev'] ?>\)</p>
                                    <p class="w-full mt-4">\(\text {DF (t-distribution)} \)</p>
                                    <p class="w-full mt-3 overflow-auto">\(df = \dfrac{(\dfrac{S_1^2}{n_1} + \dfrac{S_2^2}{n_2})^2}{\dfrac{S_1^4}{n_1^2(n_1-1)} + \dfrac{S_2^4}{n_2^2(n_2-1)}}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\( = \dfrac{(\dfrac{<?= $detail['vsqrt']; ?>^2}{<?= $detail['i']; ?>} + \dfrac{<?= $detail['vsqrt1']; ?>^2}{<?= $detail['i1']; ?>})^2}{\dfrac{<?= $detail['vsqrt']; ?>^4}{<?= $detail['i']; ?>^2(<?= $detail['i']; ?>-1)} + \dfrac{<?= $detail['vsqrt1']; ?>^4}{<?= $detail['i1']; ?>^2(<?= $detail['i1']; ?>-1)}}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\( = \dfrac{(\dfrac{<?= round($detail['s12'], 4); ?>}{<?= $detail['i']; ?>} + \dfrac{<?= round($detail['s22'], 4); ?>}{<?= $detail['i1']; ?>})^2}{\dfrac{<?= round($detail['s124'], 4); ?>}{<?= $detail['pi']; ?>(<?= $detail['vrres']; ?>)} + \dfrac{<?= round($detail['s224'], 4) ?>}{<?= $detail['pi1']; ?>(<?= $detail['vrres1']; ?>)}}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\( = \dfrac{(\dfrac{<?= round($detail['s12'], 4); ?>}{<?= $detail['i']; ?>} + \dfrac{<?= round($detail['s22'], 4); ?>}{<?= $detail['i1']; ?>})^2}{\dfrac{<?= round($detail['s124'], 4); ?>}{<?= $detail['pivr'] ?>} + \dfrac{<?= round($detail['s224'], 4) ?>}{<?= $detail['pivr1'] ?>}}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\( = \dfrac{(<?= round($detail['vsqi'], 4); ?> + <?= round($detail['vsqi1'], 4) ?>)^2}{<?= round($detail['devn1'], 4) ?> + <?= round($detail['devn12'], 4) ?>}\)</p>
                                    <p class="w-full mt-3 overflow-auto">\( = \dfrac{(<?= round($detail['dft'], 4) ?>)^2}{<?= round($detail['dft1'], 4) ?> }\)</p>
                                    <p class="w-full mt-3 overflow-auto">\( = \dfrac{<?= round($detail['powdft'], 4); ?>}{<?= round($detail['dft1'], 4); ?> }\)</p>
                                    <p class="w-full mt-3">\( = <?= $detail['dftres']; ?>\)</p>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
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
        function loadMathJax() {
            var mathJaxScript = document.createElement('script');
            mathJaxScript.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
            document.querySelector('head').appendChild(mathJaxScript);
    
            var mathJaxConfigScript = document.createElement('script');
            mathJaxConfigScript.type = "text/x-mathjax-config";
            mathJaxConfigScript.textContent = 'MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}}); function MJrerender() { MathJax.Hub.Queue(["Rerender", MathJax.Hub]); }';
            document.querySelector('head').appendChild(mathJaxConfigScript);
        }
    
        window.addEventListener('load', function () {
            loadMathJax();
        });
    @endif
    document.querySelector('.r_data').addEventListener('click', function() {
        document.querySelector('.sum').style.display = 'block';
        document.querySelector('.raw').style.display = 'none';
    });

    document.querySelector('.s_data').addEventListener('click', function() {
        document.querySelector('.sum').style.display = 'none';
        document.querySelector('.raw').style.display = 'block';
    });
</script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>