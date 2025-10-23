<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3  gap-4">

            <div class="col-span-6">
                <label for="myselection" class="font-s-14">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2 position-relative">
                    <select name="effect_type" id="myselection" class="input">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = ["Cohen's d - two-sample equal sd", "Cohen's d - two-sample unequal sd", "Cohen's d - one-sample","Cohen's h","Phi (φ)","Cramér's V (φ꜀)","R², and f²","η², and f²","R² to f²","f² to R²","d & r"];
                            $val = ["cohen2e", "cohen2u", "cohen","h","phi","cramer","r2","eta2","r2f","f2r","dr"];
                            optionsList($val,$name,isset($_POST['effect_type'])?$_POST['effect_type']:'cohen');
                        @endphp
                    </select>
                </div>
            </div>
            <div class="col-span-6">
                <label for="formula_change" class="font-s-14">{{ $lang['1'] }}:</label>
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
            <div class="col-span-12  cohen">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-6 wh">
                        <label for="c_x1" class="font-s-14"><?= $lang[3] ?> (\(\bar x\)):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="c_x1" id="c_x1" value="{{ isset($_POST['c_x1'])?$_POST['c_x1']:'3' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 ww">
                        <label for="c_s" class="font-s-14"><?= $lang[4] ?> σ (S):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="c_s" id="c_s" value="{{ isset($_POST['c_s'])?$_POST['c_s']:'5' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 wh">
                        <label for="c_pm" class="font-s-14"><?= $lang[5] ?> (\(μ_0)\):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="c_pm" id="c_pm" value="{{ isset($_POST['c_pm'])?$_POST['c_pm']:'10' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="cohen2e col-span-12  hidden">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-6 wh">
                        <label for="x1" class="font-s-14"><?= $lang[3] ?> (\({\bar x}_1\)):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="x1" id="x1" value="{{ isset($_POST['x1'])?$_POST['x1']:'2' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 ww">
                        <label for="x2" class="font-s-14"><?= $lang[3] ?> (\({\bar x}_2\)):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="x2" id="x2" value="{{ isset($_POST['x2'])?$_POST['x2']:'8' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 wh">
                        <label for="n1" class="font-s-14"><?= $lang[6] ?> (\(n_1\)):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="n1" id="n1" value="{{ isset($_POST['n1'])?$_POST['n1']:'10' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 ww">
                        <label for="n2" class="font-s-14"><?= $lang[6] ?> (\(n_2\)):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="n2" id="n2" value="{{ isset($_POST['n2'])?$_POST['n2']:'20' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 wh">
                        <label for="s1" class="font-s-14"><?= $lang[4] ?> σ (\(S_1\)):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="s1" id="s1" value="{{ isset($_POST['s1'])?$_POST['s1']:'5' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 ww">
                        <label for="s2" class="font-s-14"><?= $lang[4] ?> σ (\(S_2\)):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="s2" id="s2" value="{{ isset($_POST['s2'])?$_POST['s2']:'3' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="h col-span-12  hidden">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-6 wh">
                        <label for="p1" class="font-s-14">\(P_1 (Proportion_1)\):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="p1" id="p1" value="{{ isset($_POST['p1'])?$_POST['p1']:'0.5' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 ww">
                        <label for="p2" class="font-s-14">\(P_2 (Proportion_2)\):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="p2" id="p2" value="{{ isset($_POST['p2'])?$_POST['p2']:'0.6' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="phi col-span-12  hidden">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-6 wh">
                        <label for="ph_x2" class="font-s-14">\(χ^2\):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="ph_x2" id="ph_x2" value="{{ isset($_POST['ph_x2'])?$_POST['ph_x2']:'2' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 ww">
                        <label for="ph_n1" class="font-s-14"><?= $lang[6] ?> (\(n_1\)):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="ph_n1" id="ph_n1" value="{{ isset($_POST['ph_n1'])?$_POST['ph_n1']:'10' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="cramer col-span-12  hidden">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-6 wh">
                        <label for="cr_x2" class="font-s-14">\(χ^2\):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="cr_x2" id="cr_x2" value="{{ isset($_POST['cr_x2'])?$_POST['cr_x2']:'2' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 ww">
                        <label for="cr_n1" class="font-s-14"><?= $lang[6] ?> (\(n_1\)):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="cr_n1" id="cr_n1" value="{{ isset($_POST['cr_n1'])?$_POST['cr_n1']:'10' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 wh">
                        <label for="row" class="font-s-14"><?= $lang[7] ?>:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="row" id="row" value="{{ isset($_POST['row'])?$_POST['row']:'3' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 ww">
                        <label for="col" class="font-s-14"><?= $lang[8] ?>:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="col" id="col" value="{{ isset($_POST['col'])?$_POST['col']:'4' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="r2 col-span-12  hidden">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-6 wh">
                        <label for="ssr" class="font-s-14"><?= $lang[9] ?>:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="ssr" id="ssr" value="{{ isset($_POST['ssr'])?$_POST['ssr']:'5' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 wh">
                        <label for="sst" class="font-s-14"><?= $lang[10] ?>:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="sst" id="sst" value="{{ isset($_POST['sst'])?$_POST['sst']:'10' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="eta2 col-span-12  hidden">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-6 wh">
                        <label for="ssg" class="font-s-14"><?= $lang[11] ?>:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="ssg" id="ssg" value="{{ isset($_POST['ssg'])?$_POST['ssg']:'5' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 ww">
                        <label for="et_sst" class="font-s-14"><?= $lang[10] ?>:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="et_sst" id="et_sst" value="{{ isset($_POST['et_sst'])?$_POST['et_sst']:'8' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="f2r col-span-12  hidden">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-6 ww">
                        <label for="f2r" class="font-s-14">\(f^2\):</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="f2r" id="f2r" value="{{ isset($_POST['f2r'])?$_POST['f2r']:'5' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="dr col-span-12  hidden">
                <div class="grid grid-cols-12 mt-3  gap-4">
                    <div class="col-span-6 wh">
                        <label for="t_value" class="font-s-14"><?= $lang[12] ?>:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="t_value" id="t_value" value="{{ isset($_POST['t_value'])?$_POST['t_value']:'5' }}" class="input" aria-label="input" placeholder="00" />
                        </div>
                    </div>
                    <div class="col-span-6 ww">
                        <label for="df" class="font-s-14"><?= $lang[13] ?>:</label>
                        <div class="w-100 py-2">
                            <input type="number" step="any" name="df" id="df" value="{{ isset($_POST['df'])?$_POST['df']:'8' }}" class="input" aria-label="input" placeholder="00" />
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
                        <?php if (isset($detail['effect_type'])) { ?>
                            @php
                                $effect_type = $detail['effect_type'];
                            @endphp
                            <div class="text-center">
                                <p class="text-[18px]">
                                    <strong><?= $lang[14] ?></strong>
                                </p>
                            </div>
                            <?php if ($effect_type == 'cohen2e') { ?>
                                <div class="flex justify-center">                            
                                    <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['cohen2e'] }}</strong>
                                    </p>
                                </div>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[15] ?></strong></p>
                                <p class="w-full mt-3">\({\bar x}_1 = <?= $detail['x1']; ?> &ensp; ; &ensp; {\bar x}_2 = <?= $detail['x2']; ?>\)</p>
                                <p class="w-full mt-3">\(n_1 = <?= $detail['n1']; ?> &ensp; ; &ensp; n_2 = <?= $detail['n2']; ?>\)</p>
                                <p class="w-full mt-3">\(S_1 = <?= $detail['s1']; ?> &ensp; ; &ensp; S_2 = <?= $detail['s2']; ?>\)</p>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[16] ?></strong></p>
                                <p class="w-full mt-3">\(S^2 = \dfrac{(n_1 - 1)S_1^2 +  (n_2 - 1)S_2^2}{n_1 + n_2 - 2}\)</p>
                                <p class="w-full mt-3">\(S^2 = \dfrac{(<?= $detail['n1']; ?> - 1)(<?= $detail['s1']; ?>)^2 +  (<?= $detail['n2']; ?> - 1)(<?= $detail['s2']; ?>)^2}{<?= $detail['n1']; ?> + <?= $detail['n2']; ?> - 2}\)</p>
                                <p class="w-full mt-3">\(S^2 = \dfrac{(<?= $detail['n1']-1; ?>)(<?= $detail['s1pow']; ?>) + (<?= $detail['n2']-1; ?>)(<?= $detail['s2pow']; ?>)}{<?= $detail['n1']+$detail['n2']; ?> - 2}\)</p>
                                <p class="w-full mt-3">\(S^2 = \dfrac{<?= $detail['res']?>}{<?= $detail['n1']+$detail['n2']-2; ?>}\)</p>
                                <p class="w-full mt-3">\(S^2 = <?= $detail['sqr']?>\)</p>
                                <p class="w-full mt-3">\(S^2 = \sqrt{<?= $detail['sqr']?>}\)</p>
                                <p class="w-full mt-3">\(S = <?= $detail['sqrt']?>\) 
                                <?php if($detail['sqr'] < 0){ ?>
                                    &ensp; (∴ <?= $lang[19] ?>.)
                                <?php } ?>
                                </p>
                                <p class="w-full mt-3"><?= $lang[17] ?>:-</p>
                                <p class="w-full mt-3">\(d = \dfrac{|{\bar x}_1 - {\bar x}_2|}{S}\)</p>
                                <p class="w-full mt-3">\(d = \dfrac{|<?= $detail['x1']?> - <?= $detail['x2']?>|}{<?= $detail['sqrt']?>}\)</p>
                                <p class="w-full mt-3"><?= $lang[18] ?>+<?= $detail['x1x2']?>.</p>
                                <p class="w-full mt-3">\(d = \dfrac{<?= $detail['x1x2']?>}{<?= $detail['sqrt']?>}\)</p>
                                <p class="w-full mt-3">\(d = <?= $detail['cohen2e']?>\)</p>
                            <?php } else if ($effect_type == 'cohen2u') { ?>
                                <div class="flex justify-center">                            
                                    <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['cohen2u'] }}</strong>
                                    </p>
                                </div>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[15] ?></strong></p>
                                <p class="w-full mt-3">\({\bar x}_1 = <?= $detail['x1']; ?> &ensp; ; &ensp; {\bar x}_2 = <?= $detail['x2']; ?>\)</p>
                                <p class="w-full mt-3">\(n_1 = <?= $detail['n1']; ?> &ensp; ; &ensp;n_2 = <?= $detail['n2']; ?>\)</p>
                                <p class="w-full mt-3">\(S_1 = <?= $detail['s1']; ?> &ensp; ; &ensp;S_2 = <?= $detail['s2']; ?>\)</p>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[16] ?></strong></p>
                                <p class="w-full mt-3">\(S^2 = \dfrac{S_1^2 + S_2^2}{2}\)</p>
                                <p class="w-full mt-3">\(S^2 = \dfrac{(<?= $detail['s1']; ?>)^2 +  (<?= $detail['s2']; ?>)^2}{2}\)</p>
                                <p class="w-full mt-3">\(S^2 = \dfrac{(<?= $detail['s1pow']; ?>) +  (<?= $detail['s2pow']; ?>)}{2}\)</p>
                                <p class="w-full mt-3">\(S^2 = \dfrac{<?= $detail['res']; ?>}{2}\)</p>
                                <p class="w-full mt-3">\(S^2 = <?= $detail['sqr']; ?>\)</p>
                                <p class="w-full mt-3">\(S^2 = \sqrt{<?= $detail['sqr']?>}\)</p>
                                <p class="w-full mt-3">\(S = <?= $detail['sqrt']?>\)</p>
                                <?php if($detail['sqr'] < 0){ ?>
                                    &ensp; (∴ <?= $lang[19] ?>.)
                                <?php } ?>
                                <p class="w-full mt-3"><?= $lang[17] ?>:-</p>
                                <p class="w-full mt-3">\(d = \dfrac{|{\bar x}_1 - {\bar x}_2|}{S}\)</p>
                                <p class="w-full mt-3">\(d = \dfrac{|<?= $detail['x1']?> - <?= $detail['x2']?>|}{<?= $detail['sqrt']?>}\)</p>
                                <p class="w-full mt-3"><?= $lang[18] ?> +<?= $detail['x1x2']?>.</p>
                                <p class="w-full mt-3">\(d = \dfrac{<?= $detail['x1x2']?>}{<?= $detail['sqrt']?>}\)</p>
                                <p class="w-full mt-3">\(d = <?= $detail['cohen2u']?>\)</p>
                            <?php } else if ($effect_type == 'cohen') { ?>
                                <div class="flex justify-center">                            
                                    <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['cohen'] }}</strong>
                                    </p>
                                </div>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[15] ?></strong></p>
                                <p class="w-full mt-3">\(\text{<?= $lang[3] ?>} &ensp; {\bar x} = <?= $detail['c_x1']; ?>\)</p>
                                <p class="w-full mt-3">\(\text{<?= $lang[4] ?>} &ensp; σ (S)  = <?= $detail['c_s']; ?>\)</p>
                                <p class="w-full mt-3">\(\text{<?= $lang[5] ?>} &ensp; (μ_0)  = <?= $detail['c_pm']; ?>\)</p>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[16] ?></strong></p>
                                <p class="w-full mt-3">\(d = \dfrac{|{\bar x} - μ_0|}{S}\)</p>
                                <p class="w-full mt-3">\(d = \dfrac{|<?= $detail['c_x1']; ?> - <?= $detail['c_pm']; ?>|}{<?= $detail['c_s']; ?>}\)</p>
                                <p class="w-full mt-3"><?= $lang[18] ?> +<?= $detail['c']?>.</p>
                                <p class="w-full mt-3">\(d = \dfrac{<?= $detail['c']?>}{<?= $detail['c_s']?>}\)</p>
                                <p class="w-full mt-3">\(d = <?= $detail['cohen']?>\)</p>
                            <?php } else if ($effect_type == 'h') { ?>
                                <div class="flex justify-center">                            
                                    <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['h'] }}</strong>
                                    </p>
                                </div>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[15] ?></strong></p>
                                <p class="w-full mt-3">\(P_1 (Proportion_1) = <?= $detail['p1']; ?>\)</p>
                                <p class="w-full mt-3"> \(P_2 (Proportion_2) = <?= $detail['p2']; ?>\)</p>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[16] ?></strong></p>
                                <p class="w-full mt-3">\(h = 2(arcsin(\sqrt{p_1}) - arcsin(\sqrt{p_2}))\)</p>
                                <p class="w-full mt-3">\(h = 2(arcsin(\sqrt{<?= $detail['p1']; ?>}) - arcsin(\sqrt{<?= $detail['p2']; ?>}))\)</p>
                                <p class="w-full mt-3">
                                <?php if($detail['p1'] < 0 || $detail['p2'] < 0){ ?>
                                    &ensp; (∴ <?= $lang[19] ?>.)
                                <?php } ?>
                                </P>
                                <p class="w-full mt-3">\(h = 2(arcsin(<?= $detail['p1sqr']; ?>) - arcsin(<?= $detail['p2sqr']; ?>))\)</p>
                                <p class="w-full mt-3">\(h = 2(<?= $detail['arcp1']; ?> - <?= $detail['arcp2']; ?>)\)</p>
                                <p class="w-full mt-3">\(h = 2(<?= $detail['arcp1'] - $detail['arcp2']; ?>)\)</p>
                                <p class="w-full mt-3">\(h = <?= $detail['h']?>\)</p>
                            <?php } else if ($effect_type == 'phi') { ?>
                                <div class="flex justify-center">                            
                                    <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['phi'] }}</strong>
                                    </p>
                                </div>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[15] ?></strong></p>
                                <p class="w-full mt-3">\(X^2 = <?= $detail['ph_x2']; ?>\)</p>
                                <p class="w-full mt-3"> \(\text{<?= $lang[6] ?>} &ensp; (n_1) = <?= $detail['ph_n1']; ?>\)</p>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[16] ?></strong></p>
                                <p class="w-full mt-3">\(φ = \sqrt{\dfrac{X^2}{n}}\)</p>
                                <p class="w-full mt-3">\(φ = \sqrt{\dfrac{<?= $detail['ph_x2']; ?>}{<?= $detail['ph_n1']; ?>}}\)</p>
                                <p class="w-full mt-3">\(φ = \sqrt{<?= $detail['res']; ?>}\)
                                <?php if($detail['res'] < 0){ ?>
                                    &ensp; (∴ <?= $lang[19] ?>.)
                                <?php } ?>
                                </p>
                                <p class="w-full mt-3">\(φ = <?= $detail['phi']?>\)</p>
                            <?php } else if ($effect_type == 'cramer') { ?>
                                <div class="flex justify-center">                            
                                    <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['cramer'] }}</strong>
                                    </p>
                                </div>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[15] ?></strong></p>
                                <p class="w-full mt-3">\(X^2 = <?= $detail['cr_x2']; ?> &ensp; ; &ensp; n_1 = <?= $detail['cr_n1']; ?>\)</p>
                                <p class="w-full mt-3"> \(\text {Number of Rows} = <?= $detail['row']; ?>\)</p>
                                <p class="w-full mt-3"> \(\text {Number of Columns} = <?= $detail['col']; ?>\)</p>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[16] ?></strong></p>
                                <p class="w-full mt-3">\(V = \sqrt{\dfrac{X^2}{n_1 * Min(R-1 , C-1)}}\)</p>
                                <p class="w-full mt-3">\(V = \sqrt{\dfrac{<?= $detail['cr_x2']; ?>}{<?= $detail['cr_n1']; ?> * Min(<?= $detail['row'];?>-1 , <?= $detail['col'];?>-1)}}\)</p>
                                <p class="w-full mt-3">\(V = \sqrt{\dfrac{<?= $detail['cr_x2']; ?>}{<?= $detail['cr_n1']; ?> * Min(<?= $detail['r'];?> , <?= $detail['c'];?>)}}\)</p>
                                <p class="w-full mt-3">\(V = \sqrt{\dfrac{<?= $detail['cr_x2']; ?>}{<?= $detail['cr_n1']; ?> * <?= $detail['min'];?>}}\)</p>
                                <p class="w-full mt-3">\(V = \sqrt{\dfrac{<?= $detail['cr_x2']; ?>}{<?= $detail['res']; ?>}}\)</p>
                                <p class="w-full mt-3">\(V = \sqrt{<?= $detail['v']; ?>}\)
                                <?php if($detail['v'] < 0){ ?>
                                    &ensp; (∴ <?= $lang[19] ?>.)
                                <?php } ?>
                                </p>
                                <p class="w-full mt-3">\(V = <?= $detail['cramer']?>\)</p>
                            <?php } else if ($effect_type == 'r2') { ?>
                                <div class="flex justify-center">                            
                                    <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['r2'] }}</strong>
                                    </p>
                                </div>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[15] ?></strong></p>
                                <p class="w-full mt-3"> \(\text {SSR} = <?= $detail['ssr']; ?> &ensp; ; &ensp; \text {SST} = <?= $detail['sst']; ?>\)</p>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[16] ?></strong></p>
                                <p class="w-full mt-3">\(R^2 = \dfrac{SSR}{SST}\)</p>
                                <p class="w-full mt-3">\(R^2 = \dfrac{ <?= $detail['ssr']; ?>}{ <?= $detail['sst']; ?>}\)</p>
                                <p class="w-full mt-3">\(R^2  = <?= $detail['r']?>\)</p>
                                <p class="w-full mt-3">Also we have:-</p>
                                <p class="w-full mt-3">\(f^2  = \dfrac{R^2}{1 - R^2}\)</p>
                                <p class="w-full mt-3">\(f^2  = \dfrac{<?= $detail['r']?>}{1 - <?= $detail['r']?>}\)</p>
                                <p class="w-full mt-3">\(f^2  = \dfrac{<?= $detail['r']?>}{<?= 1 - $detail['r']?>}\)</p>
                                <p class="w-full mt-3">\(f^2  = <?= $detail['r2']?>\)</p>
                            <?php } else if ($effect_type == 'eta2') { ?>
                                <div class="flex justify-center">                            
                                    <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['eta2'] }}</strong>
                                    </p>
                                </div>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[15] ?></strong></p>
                                <p class="w-full mt-3"> \(\text {SSG} = <?= $detail['ssg']; ?> &ensp; ; &ensp; \text {SST} = <?= $detail['et_sst']; ?>\)</p>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[16] ?></strong></p>
                                <p class="w-full mt-3">\(η^2 = \dfrac{SSG}{SST}\)</p>
                                <p class="w-full mt-3">\(η^2 = \dfrac{ <?= $detail['ssg']; ?>}{ <?= $detail['et_sst']; ?>}\)</p>
                                <p class="w-full mt-3">\(η^2  = <?= $detail['et']?>\)</p>
                                <p class="w-full mt-3">Also we have:-</p>
                                <p class="w-full mt-3">\(f^2  = \dfrac{n^2}{1 - n^2}\)</p>
                                <p class="w-full mt-3">\(f^2  = \dfrac{<?= $detail['et']?>}{1 - <?= $detail['et']?>}\)</p>
                                <p class="w-full mt-3">\(f^2  = \dfrac{<?= $detail['et']?>}{<?= 1 - $detail['et']?>}\)</p>
                                <p class="w-full mt-3">\(f^2  = <?= $detail['eta2']?>\)</p>
                            <?php } else if ($effect_type == 'r2f') { ?>
                                <div class="flex justify-center">                            
                                    <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['rf'] }}</strong>
                                    </p>
                                </div>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[15] ?></strong></p>
                                <p class="w-full mt-3"> \(R^2 = <?= $detail['r2f']; ?>\)</p>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[16] ?></strong></p>
                                <p class="w-full mt-3">\(f^2 = \dfrac{R^2}{1 - R^2}\)</p>
                                <p class="w-full mt-3">\(f^2 = \dfrac{<?= $detail['r2f']; ?>}{1 - <?= $detail['r2f']; ?>}\)</p>
                                <p class="w-full mt-3">\(f^2 = \dfrac{<?= $detail['r2f']; ?>}{ <?= $detail['res']; ?>}\)</p>
                                <p class="w-full mt-3">\(f^2  = <?= $detail['rf']?>\)</p>
                            <?php } else if ($effect_type == 'f2r') { ?>
                                <div class="flex justify-center">                            
                                    <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['fr'] }}</strong>
                                    </p>
                                </div>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[15] ?></strong></p>
                                <p class="w-full mt-3"> \(f^2 = <?= $detail['f2r']; ?>\)</p>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[16] ?></strong></p>
                                <p class="w-full mt-3">\(R^2 = \dfrac{f^2}{1 + f^2}\)</p>
                                <p class="w-full mt-3">\(R^2 = \dfrac{<?= $detail['f2r']; ?>}{1 + <?= $detail['f2r']; ?>}\)</p>
                                <p class="w-full mt-3">\(R^2 = \dfrac{<?= $detail['f2r']; ?>}{ <?= $detail['res']; ?>}\)</p>
                                <p class="w-full mt-3">\(R^2  = <?= $detail['fr']?>\)</p>
                            <?php } else if ($effect_type == 'dr') { ?>
                                <div class="flex justify-center">                            
                                    <p class="text-[25px] bg-[#2845F5] px-3 py-2 rounded-lg d-inline-block my-3">
                                        <strong class="text-white">{{ $detail['dr'] }}</strong>
                                    </p>
                                </div>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[15] ?></strong></p>
                                <p class="w-full mt-3"> \(\text {t Value} = <?= $detail['t_value']; ?> &ensp; ; &ensp; \text {df} = <?= $detail['df']; ?>\)</p>
                                <p class="w-full mt-3 text-[18px]"><strong class="text-blue"><?= $lang[16] ?></strong></p>
                                <p class="w-full mt-3">\(\text{Cohen's d} = \dfrac{2t}{\sqrt{df}}\)</p>
                                <p class="w-full mt-3">\(\text{Cohen's d} = \dfrac{2*<?= $detail['t_value']; ?>}{\sqrt{<?= $detail['df']; ?> }}\)</p>
                                <p class="w-full mt-3">\(\text{Cohen's d} = \dfrac{<?= $detail['res']; ?>}{<?= $detail['dfsqr']; ?>}\)</p>
                                <p class="w-full mt-3">\(\text{Cohen's d}  = <?= $detail['dr']?>\)</p>
                                <p class="w-full mt-3"><?= $lang[17] ?>:-</p>
                                <p class="w-full mt-3">\(r_Yλ  = \sqrt{\dfrac{t^2}{t^2 + df }}\)</p>
                                <p class="w-full mt-3">\(r_Yλ  = \sqrt{\dfrac{(<?= $detail['t_value']; ?>)^2 }{(<?= $detail['t_value']; ?>) ^2 + <?= $detail['df']; ?>  }}\)</p>
                                <p class="w-full mt-3">\(r_Yλ  = \sqrt{\dfrac{<?= $detail['t']; ?> }{<?= $detail['t']; ?> + <?= $detail['df']; ?>}}\)</p>
                                <p class="w-full mt-3">\(r_Yλ  = \sqrt{\dfrac{<?= $detail['t']; ?> }{<?= $detail['res2']?>}}\)</p>
                                <p class="w-full mt-3">\(r_Yλ  = \sqrt{<?= $detail['ry']?>}\)</p>
                                <p class="w-full mt-3">\(r_Yλ  = <?= $detail['r']?>\)</p>
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
        // Initial setup
        var demovalue = document.getElementById('myselection').value;
        toggleVisibility(demovalue);

        // Event listener for change event
        document.getElementById('myselection').addEventListener('change', function () {
            var demovalue = this.value;
            toggleVisibility(demovalue);
        });

        // Function to toggle visibility based on selected value
        function toggleVisibility(demovalue) {
            // Hide all divs initially
            var allDivs = document.querySelectorAll('div.cohen2e, div.cohen, div.cohen2u, div.h, div.phi, div.cramer, div.r2, div.eta2, div.r2f, div.f2r, div.dr');
            allDivs.forEach(function(div) {
                div.style.display = 'none';
            });

            // Show the relevant div based on demovalue
            if (demovalue == 'cohen2e' || demovalue == 'cohen2u') {
                document.querySelector('div.cohen2e').style.display = 'block';
            } else if (demovalue == 'h') {
                document.querySelector('div.h').style.display = 'block';
            } else if (demovalue == 'phi') {
                document.querySelector('div.phi').style.display = 'block';
            } else if (demovalue == 'cramer') {
                document.querySelector('div.cramer').style.display = 'block';
            } else if (demovalue == 'r2') {
                document.querySelector('div.r2').style.display = 'block';
            } else if (demovalue == 'eta2') {
                document.querySelector('div.eta2').style.display = 'block';
            } else if (demovalue == 'r2f') {
                document.querySelector('div.r2f').style.display = 'block';
            } else if (demovalue == 'f2r') {
                document.querySelector('div.f2r').style.display = 'block';
            } else if (demovalue == 'dr') {
                document.querySelector('div.dr').style.display = 'block';
            } else {
                document.querySelector('div.cohen').style.display = 'block';
            }
        }

        <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
    </script>
@endpush
<script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>