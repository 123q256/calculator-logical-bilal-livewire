<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="n" class="font-s-14 text-blue">{{ $lang['1'] }} (n):</label>
                    <input type="number" step="any" name="n" id="n" value="{{ isset($_POST['n'])?$_POST['n']:'20' }}" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2 relative">
                    <label for="p" class="font-s-14 text-blue">{{ $lang['2'] }} (p):</label>
                    <input type="number" step="any" name="p" id="p" min="0" max="1" value="{{ isset($_POST['p'])?$_POST['p']:'0.13' }}" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2 relative">
                    <label for="x" class="font-s-14 text-blue">{{ $lang['3'] }} (X):</label>
                    <input type="number" step="any" name="x" id="x" value="{{ isset($_POST['x'])?$_POST['x']:'4' }}" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2 relative">
                    <label for="con" class="font-s-14 text-blue">{{ $lang['34'] }}:</label>
                    <select name="con" id="con" class="input" autocomplete="off">
                        @php
                            function optionsList($arr1,$arr2,$unit){
                            foreach($arr1 as $index => $name){
                        @endphp
                            <option value="{!! $name !!}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                {!! $arr2[$index] !!}
                            </option>
                        @php
                            }}
                            $name = [$lang['5'].' X '.$lang['4'].' P(X = x)',$lang['6'].' X '.$lang['4'].' P(X < x)',$lang['7'].' X '.$lang['4'].' P(X ≤ x)',$lang['8'].' X '.$lang['4'].' P(X > x)',$lang['9'].' X '.$lang['4'].' P(X ≥ x)'];
                            $val = ['1','2','3','4','5'];
                            optionsList($val,$name,isset($_POST['con'])?$_POST['con']:'1');
                        @endphp
                    </select>
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
                        <div class="w-full">
                            @php
                                $request = request();
                                $x = $request->x;
                                $n = $request->n;
                                $con = $request->con;
                                $p = $request->p;
                            @endphp
                            @if ($con=='1')
                                <div class="text-center">
                                    <p class="text-[18px] mt-3"><strong><?=$lang['10']?> <?=$x?> <?=$lang['4']?> P(X = <?=$x?>)</strong></p>
                                    <p class="text-[26px] rounded-lg bg-[#2845F5] text-[#ffffff] px-3 py-2 radius-10 d-inline-block my-3">
                                        <strong class="text-blue">{{ $detail['ans'] }}</strong>
                                    </p>
                                </div>
                                <p class="col-12 mt-3 font-s-18"><strong><?=$lang['11']?>: </strong> \(μ = np = ((<?=$n?>)\times(<?=$p?>)) = <?=$n*$p?>\)</p>
                                <p class="col-12 mt-3 font-s-18"><strong><?=$lang['12']?>: </strong> \(σ^2 = np(1-p) = (<?=$n?>)(<?=$p?>)(1-<?=$p?>) = <?=$n*$p*(1-$p)?>\)</p>
                                <p class="col-12 mt-3 font-s-18"><strong><?=$lang['13']?>: </strong> \(σ = \sqrt{np(1-p)} = \sqrt{(<?=$n?>)(<?=$p?>)(1-<?=$p?>)} = <?=sqrt($n*$p*(1-$p))?>\)</p>
                                <p class="col-12 font-s-20 mt-3"><strong class="text-blue"><?=$lang['14']?>:</strong></p>
                                <p class="col-12 mt-2"><?=$lang['15']?>: <strong>\(\text{trials } = <?=$n?>, p = <?=$p?> \text{ and } X = <?=$x?>\)</strong></p>
                                <p class="col-12 mt-2"><?=$lang['30']?>: $$P(X) = \dbinom{n}{X} \cdot p^X \cdot (1-p)^{n-X}$$</p>
                                <p class="col-12 mt-2"><?=$lang['18']?>, \(\dbinom{n}{X}\) <?=$lang['29']?>: $$\dbinom{n}{X} = \dfrac{n!}{X!(n-X)!}$$</p>
                                <p class="col-12 mt-2"><?=$lang['17']?>: $$P(X) = \dfrac{n!}{X!(n-X)!} \cdot p^X \cdot (1-p)^{n-X}$$</p>
                                <p class="col-12 mt-2"><?=$lang['16']?> \(n = <?=$n?>, p = <?=$p?> \text{ and } X = <?=$x?>\): $$P(<?=$x?>) = \dfrac{<?=$n?>!}{<?=$x?>!(<?=$n?>-<?=$x?>)!} \cdot <?=$p?>^{<?=$x?>} \cdot (1-<?=$p?>)^{<?=$n?>-<?=$x?>}$$</p>
                                <p class="col-12 mt-2"><?=$lang['19']?>: $$P(<?=$x?>)=<?=$detail['ans']?>$$</p>
                            @elseif($con=='2')
                                <div class="text-center">
                                    <p class="font-s-18"><strong><?=$lang['20']?> <?=$x?> <?=$lang['4']?>: P(X < <?=$x?>)</strong></p>
                                    <p class="font-s-20 bg-white px-3 py-2 radius-10 d-inline-block my-3">
                                        <strong class="text-blue">{{ $detail['ans'] }}</strong>
                                    </p>
                                </div>
                                <p class="col-12 mt-3 font-s-18"><strong><?=$lang['11']?>: </strong> \(μ = np = ((<?=$n?>)\times(<?=$p?>)) = <?=$n*$p?>\)</p>
                                <p class="col-12 mt-3 font-s-18"><strong><?=$lang['12']?>: </strong> \(σ^2 = np(1-p) = (<?=$n?>)(<?=$p?>)(1-<?=$p?>) = <?=$n*$p*(1-$p)?>\)</p>
                                <p class="col-12 mt-3 font-s-18"><strong><?=$lang['13']?>: </strong> \(σ = \sqrt{np(1-p)} = \sqrt{(<?=$n?>)(<?=$p?>)(1-<?=$p?>)} = <?=sqrt($n*$p*(1-$p))?>\)</p>
                                @if ($x>1)
                                    <p class="col-12 mt-3 font-s-20"><strong class="text-blue"><?=$lang['14']?>:</strong></p>
                                    <p class="col-12 mt-2 font-s-18"><?=$lang['15']?>: <strong>\(\text{trials } = <?=$n?>, p = <?=$p?> \text{ and } X = <?=$x?>\)</strong></p>
                                    <p class="col-12 mt-2 font-s-18"><?=$lang['6']?> <?=$x?> <?=$lang['24']?>: <strong>X = <?php 
                                        for ($i=0; $i < $x; $i++) { 
                                            echo $i.', ';
                                        }
                                    ?></strong><?=$lang['21']?> P (X).</p>
                                    <p class="col-12 mt-2 font-s-18 text-center"><strong>\(
                                        <?php 
                                            for ($i=0; $i < $x; $i++) { 
                                                if ($i!=($x-1)) {
                                                    echo "P($i) + ";
                                                }else{
                                                    echo "P($i)";
                                                }
                                            }
                                        ?>
                                    \)</strong></p>
                                    <p class="col-12 mt-2 font-s-18"><strong><?=$lang['22']?></strong></p>
                                    <p class="col-12 mt-2 font-s-18"><strong>P(0)</strong></p>
                                    <p class="col-12 mt-2 font-s-18"><?=$lang['30']?>: $$P(X) = \dbinom{n}{X} \cdot p^X \cdot (1-p)^{n-X}$$</p>
                                    <p class="col-12 mt-2 font-s-18"><?=$lang['18']?>, \(\dbinom{n}{X}\) <?=$lang['29']?>: $$\dbinom{n}{X} = \dfrac{n!}{X!(n-X)!}$$</p>
                                    <p class="col-12 mt-2 font-s-18"><?=$lang['17']?>: $$P(X) = \dfrac{n!}{X!(n-X)!} \cdot p^X \cdot (1-p)^{n-X}$$</p>
                                    <p class="col-12 mt-2 font-s-18"><?=$lang['16']?> \(n = <?=$n?>, p = <?=$p?> \text{ and } X = 0\): $$P(0) = \dfrac{<?=$n?>!}{0!(<?=$n?>-0)!} \cdot <?=$p?>^{0} \cdot (1-<?=$p?>)^{<?=$n?>-0}$$</p>
                                    <p class="col-12 mt-2 font-s-18"><?=$lang['19']?>: $$P(0)=<?=$detail['table'][0]?>$$</p>
                                    <p class="col-12 mt-2 font-s-18"><strong><?=$lang['25']?>:</strong></p>
                                    <p class="col-12 mt-2 font-s-18 text-center"><strong>\(
                                        <?php 
                                            for ($i=0; $i < $x; $i++) { 
                                                if ($i!=($x-1)) {
                                                    echo "P($i) + ";
                                                }else{
                                                    echo "P($i)";
                                                }
                                            }
                                        ?>
                                    \)</strong></p>
                                    <p class="col-12 mt-2 font-s-18 text-center"><strong><?php 
                                        for ($i=0; $i < $x; $i++) { ?>
                                            <?php if($i!=($x-1)){ ?>
                                                \(<?=$detail['table'][$i]?> + \)<br>
                                            <?php }else{ ?>
                                                \(<?=$detail['table'][$i]?>\)<br>
                                            <?php } ?>
                                    <?php }
                                    ?></strong></p>
                                    <p class="col-12 mt-3 font-s-20"><strong class="text-blue">= <?=$detail['ans']?></strong></p>
                                @endif
                            @elseif($con=='3')
                                <div class="text-center">
                                    <p class="font-s-18"><strong><?=$lang['23']?> <?=$x?> <?=$lang['4']?> P(X ≤ <?=$x?>)</strong></p>
                                    <p class="font-s-20 bg-white px-3 py-2 radius-10 d-inline-block my-3">
                                        <strong class="text-blue">{{ $detail['ans'] }}</strong>
                                    </p>
                                </div>
                                <p class="col-12 mt-3 font-s-18"><strong><?=$lang['11']?>: </strong> \(μ = np = ((<?=$n?>)\times(<?=$p?>)) = <?=$n*$p?>\)</p>
                                <p class="col-12 mt-3 font-s-18"><strong><?=$lang['12']?>: </strong> \(σ^2 = np(1-p) = (<?=$n?>)(<?=$p?>)(1-<?=$p?>) = <?=$n*$p*(1-$p)?>\)</p>
                                <p class="col-12 mt-3 font-s-18"><strong><?=$lang['13']?>: </strong> \(σ = \sqrt{np(1-p)} = \sqrt{(<?=$n?>)(<?=$p?>)(1-<?=$p?>)} = <?=sqrt($n*$p*(1-$p))?>\)</p>
                                <?php if($x>1){ ?>
                                    <p class="col-12 mt-3 font-s-20"><strong class="text-blue"><?=$lang['14']?>:</strong></p>
                                    <p class="col-12 mt-2 font-s-18"><?=$lang['15']?>: <strong>\(\text{trials } = <?=$n?>, p = <?=$p?> \text{ and } X = <?=$x?>\)</strong></p>
                                    <p class="col-12 mt-2 font-s-18"><?=$lang['7']?> <?=$x?> <?=$lang['24']?>: <strong>X = <?php 
                                        for ($i=0; $i <= $x; $i++) { 
                                            echo $i.', ';
                                        }
                                        ?></strong><?=$lang['21']?> P (X).</p>
                                    <p class="col-12 mt-2 font-s-18 text-center"><strong>\(
                                        <?php 
                                            for ($i=0; $i <= $x; $i++) { 
                                                if ($i!=($x)) {
                                                    echo "P($i) + ";
                                                }else{
                                                    echo "P($i)";
                                                }
                                            }
                                            ?>
                                    \)</strong></p>
                                    <p class="col-12 mt-2 font-s-18"><strong><?=$lang['22']?></strong></p>
                                    <p class="col-12 mt-2 font-s-18"><strong>P(0)</strong></p>
                                    <p class="col-12 mt-2 font-s-18"><?=$lang['30']?>: $$P(X) = \dbinom{n}{X} \cdot p^X \cdot (1-p)^{n-X}$$</p>
                                    <p class="col-12 mt-2 font-s-18"><?=$lang['18']?>, \(\dbinom{n}{X}\) <?=$lang['29']?>: $$\dbinom{n}{X} = \dfrac{n!}{X!(n-X)!}$$</p>
                                    <p class="col-12 mt-2 font-s-18"><?=$lang['17']?>: $$P(X) = \dfrac{n!}{X!(n-X)!} \cdot p^X \cdot (1-p)^{n-X}$$</p>
                                    <p class="col-12 mt-2 font-s-18"><?=$lang['16']?> \(n = <?=$n?>, p = <?=$p?> \text{ and } X = 0\): $$P(0) = \dfrac{<?=$n?>!}{0!(<?=$n?>-0)!} \cdot <?=$p?>^{0} \cdot (1-<?=$p?>)^{<?=$n?>-0}$$</p>
                                    <p class="col-12 mt-2 font-s-18"><?=$lang['19']?>: $$P(0)=<?=$detail['table'][0]?>$$</p>
                                    <p class="col-12 mt-2 font-s-18"><strong><?=$lang['25']?>:</strong></p>
                                    <p class="col-12 mt-2 font-s-18 text-center"><strong>\(
                                        <?php 
                                            for ($i=0; $i <= $x; $i++) { 
                                                if ($i!=($x)) {
                                                    echo "P($i) + ";
                                                }else{
                                                    echo "P($i)";
                                                }
                                            }
                                            ?>
                                    \)</strong></p>
                                    <p class="col-12 mt-2 font-s-18 text-center"><strong><?php 
                                        for ($i=0; $i <= $x; $i++) { ?>
                                            <?php if($i!=($x)){ ?>
                                                \(<?=$detail['table'][$i]?> + \)<br>
                                            <?php }else{ ?>
                                                \(<?=$detail['table'][$i]?>\)<br>
                                            <?php } ?>
                                    <?php }
                                        ?></strong></p>
                                    <p class="col-12 font-s-20 mt-3"><strong class="text-blue">= <?=$detail['ans']?></strong></p>
                                <?php } ?>
                            @elseif($con=='4')
                                <div class="text-center">
                                    <p class="font-s-18"><strong><?=$lang['26']?> <?=$x?> <?=$lang['4']?> P(X > <?=$x?>)</strong></p>
                                    <p class="font-s-20 bg-white px-3 py-2 radius-10 d-inline-block my-3">
                                        <strong class="text-blue">{{ $detail['ans'] }}</strong>
                                    </p>
                                </div>
                                <p class="col-12 mt-2 font-s-18"><strong><?=$lang['11']?>: </strong> \(μ = np = ((<?=$n?>)\times(<?=$p?>)) = <?=$n*$p?>\)</p>
                                <p class="col-12 mt-2 font-s-18"><strong><?=$lang['12']?>: </strong> \(σ^2 = np(1-p) = (<?=$n?>)(<?=$p?>)(1-<?=$p?>) = <?=$n*$p*(1-$p)?>\)</p>
                                <p class="col-12 mt-2 font-s-18"><strong><?=$lang['13']?>: </strong> \(σ = \sqrt{np(1-p)} = \sqrt{(<?=$n?>)(<?=$p?>)(1-<?=$p?>)} = <?=sqrt($n*$p*(1-$p))?>\)</p>
                                <p class="col-12 mt-3 font-s-20"><strong class="text-blue"><?=$lang['14']?>:</strong></p>
                                <p class="col-12 mt-2 font-s-18"><?=$lang['15']?>: <strong>\(\text{trials } = <?=$n?>, p = <?=$p?> \text{ and } X = <?=$x?>\)</strong></p>
                                <p class="col-12 mt-2 font-s-18"><?=$lang['8']?> <?=$x?> <?=$lang['24']?>: <strong>X = <?php 
                                    for ($i=$x+1; $i <= $n; $i++) { 
                                        echo $i.', ';
                                    }
                                    ?></strong><?=$lang['21']?> P (X).</p>
                                <p class="col-12 mt-2 font-s-18 text-center"><strong>\(
                                    <?php 
                                        for ($i=$x+1; $i <= $n; $i++) { 
                                            if ($i!=($n)) {
                                                echo "P($i) + ";
                                            }else{
                                                echo "P($i)";
                                            }
                                        }
                                        ?>
                                \)</strong></p>
                                <p class="col-12 mt-2 font-s-18"><strong><?=$lang['22']?></strong></p>
                                <p class="col-12 mt-2 font-s-18"><strong>P(<?=$x+1?>)</strong></p>
                                <p class="col-12 mt-3 font-s-18"><?=$lang['30']?>: $$P(X) = \dbinom{n}{X} \cdot p^X \cdot (1-p)^{n-X}$$</p>
                                <p class="col-12 mt-3 font-s-18"><?=$lang['18']?>, \(\dbinom{n}{X}\) <?=$lang['29']?>: $$\dbinom{n}{X} = \dfrac{n!}{X!(n-X)!}$$</p>
                                <p class="col-12 mt-3 font-s-18"><?=$lang['17']?>: $$P(X) = \dfrac{n!}{X!(n-X)!} \cdot p^X \cdot (1-p)^{n-X}$$</p>
                                <p class="col-12 mt-3 font-s-18"><?=$lang['16']?> \(n = <?=$n?>, p = <?=$p?> \text{ and } X = <?=$x+1?>\): $$P(<?=$x+1?>) = \dfrac{<?=$n?>!}{<?=$x+1?>!(<?=$n?>-<?=$x+1?>)!} \cdot <?=$p?>^{<?=$x+1?>} \cdot (1-<?=$p?>)^{<?=$n?>-<?=$x+1?>}$$</p>
                                <p class="col-12 mt-3 font-s-18"><?=$lang['19']?>: $$P(<?=$x+1?>)=<?=$detail['table'][$x+1]?>$$</p>
                                <p class="col-12 mt-2 font-s-18"><strong><?=$lang['25']?>:</strong></p>
                                <p class="col-12 mt-2 font-s-18 text-center"><strong>\(
                                    <?php 
                                        for ($i=$x+1; $i <= $n; $i++) { 
                                            if ($i!=($n)) {
                                                echo "P($i) + ";
                                            }else{
                                                echo "P($i)";
                                            }
                                        }
                                        ?>
                                \)</strong></p>
                                <p class="col-12 mt-2 font-s-18 text-center"><strong><?php 
                                    for ($i=$x+1; $i <= $n; $i++) { ?>
                                        <?php if($i!=($n)){ ?>
                                            \(<?=$detail['table'][$i]?> + \)<br>
                                        <?php }else{ ?>
                                            \(<?=$detail['table'][$i]?>\)<br>
                                        <?php } ?>
                                <?php }
                                    ?></strong></p>
                                <p class="col-12 mt-3 font-s-20"><strong class="text-blue">= <?=$detail['ans']?></strong></p>
                            @elseif($con=='5')
                                <div class="text-center">
                                    <p class="font-s-18"><strong><?=$lang['27']?> <?=$x?> <?=$lang['4']?> P(X ≥ <?=$x?>)</strong></p>
                                    <p class="font-s-20 bg-white px-3 py-2 radius-10 d-inline-block my-3">
                                        <strong class="text-blue">{{ $detail['ans'] }}</strong>
                                    </p>
                                </div>         
                                <p class="col-12 mt-2 font-s-18"><strong><?=$lang['11']?>: </strong> \(μ = np = ((<?=$n?>)\times(<?=$p?>)) = <?=$n*$p?>\)</p>
                                <p class="col-12 mt-2 font-s-18"><strong><?=$lang['12']?>: </strong> \(σ^2 = np(1-p) = (<?=$n?>)(<?=$p?>)(1-<?=$p?>) = <?=$n*$p*(1-$p)?>\)</p>
                                <p class="col-12 mt-2 font-s-18"><strong><?=$lang['13']?>: </strong> \(σ = \sqrt{np(1-p)} = \sqrt{(<?=$n?>)(<?=$p?>)(1-<?=$p?>)} = <?=sqrt($n*$p*(1-$p))?>\)</p>
                                <p class="col-12 mt-3 font-s-20"><strong class="text-blue"><?=$lang['14']?>:</strong></p>
                                <p class="col-12 mt-2 font-s-18"><?=$lang['15']?>: <strong>\(\text{trials } = <?=$n?>, p = <?=$p?> \text{ and } X = <?=$x?>\)</strong></p>
                                <p class="col-12 mt-2 font-s-18"><?=$lang['9']?> <?=$x?> <?=$lang['24']?>: <strong>X = <?php 
                                    for ($i=$x; $i <= $n; $i++) { 
                                        echo $i.', ';
                                    }
                                    ?></strong><?=$lang['21']?> P (X).</p>
                                <p class="col-12 mt-2 font-s-18 text-center"><strong>\(
                                    <?php 
                                        for ($i=$x; $i <= $n; $i++) { 
                                            if ($i!=($n)) {
                                                echo "P($i) + ";
                                            }else{
                                                echo "P($i)";
                                            }
                                        }
                                        ?>
                                \)</strong></p>
                                <p class="col-12 mt-2 font-s-18"><strong><?=$lang['22']?></strong></p>
                                <p class="col-12 mt-2 font-s-18"><strong>P(<?=$x+1?>)</strong></p>
                                <p class="col-12 mt-3 font-s-18"><?=$lang['30']?>: $$P(X) = \dbinom{n}{X} \cdot p^X \cdot (1-p)^{n-X}$$</p>
                                <p class="col-12 mt-3 font-s-18"><?=$lang['18']?>, \(\dbinom{n}{X}\) <?=$lang['29']?>: $$\dbinom{n}{X} = \dfrac{n!}{X!(n-X)!}$$</p>
                                <p class="col-12 mt-3 font-s-18"><?=$lang['17']?>: $$P(X) = \dfrac{n!}{X!(n-X)!} \cdot p^X \cdot (1-p)^{n-X}$$</p>
                                <p class="col-12 mt-3 font-s-18"><?=$lang['16']?> \(n = <?=$n?>, p = <?=$p?> \text{ and } X = <?=$x?>\): $$P(<?=$x?>) = \dfrac{<?=$n?>!}{<?=$x?>!(<?=$n?>-<?=$x?>)!} \cdot <?=$p?>^{<?=$x+1?>} \cdot (1-<?=$p?>)^{<?=$n?>-<?=$x?>}$$</p>
                                <p class="col-12 mt-3 font-s-18"><?=$lang['19']?>: $$P(<?=$x?>)=<?=$detail['table'][$x]?>$$</p>
                                <p class="col-12 mt-2 font-s-18"><strong><?=$lang['25']?>:</strong></p>
                                <p class="col-12 mt-2 font-s-18 text-center"><strong>\(
                                    <?php 
                                        for ($i=$x; $i <= $n; $i++) { 
                                            if ($i!=($n)) {
                                                echo "P($i) + ";
                                            }else{
                                                echo "P($i)";
                                            }
                                        }
                                        ?>
                                \)</strong></p>
                                <p class="col-12 mt-2 font-s-18 text-center"><strong><?php 
                                    for ($i=$x; $i <= $n; $i++) { ?>
                                        <?php if($i!=($n)){ ?>
                                            \(<?=$detail['table'][$i]?> + \)<br>
                                        <?php }else{ ?>
                                            \(<?=$detail['table'][$i]?>\)<br>
                                        <?php } ?>
                                <?php }
                                    ?></strong></p>
                                <p class="col-12 mt-3 font-s-20"><strong class="text-blue">= <?=$detail['ans']?></strong></p>
                            @endif
                            <p class="col-12 mt-3 font-s-18"><strong><?=$lang['28']?>: \(n=<?=$n?>, p=<?=$p?>\)</strong></p>
                            <?php foreach ($detail['table'] as $key => $value) { ?>
                                <p class="col-12 mt-3 font-s-18">\(P(<?=$key?>) = <?=$value?>\)</p>
                            <?php } ?>
                            <p>&nbsp;</p>
                            {{-- <div id="piechart" style="height:250px;" class="col-12 mt-3"></div>
                            <div id="barchart" style="height:250px;" class="col-12 mt-3"></div> --}}
                        </div>
                    </div>
                </div>
            </div>
    @endisset
</form>
@push('calculatorJS')
    @if (isset($detail))
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script>
             <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
            var p=<?=$p?>;
            var x=<?=$x?>;
            var n=<?=$n?>;
            function equalto(p,n,x) {
                return choice(n,x) * Math.pow(p,x) * Math.pow(1-p,n-x);
            }
            function lessthan(p,n,x) {
                let result = 0;
                for(let i=0; i<x; i++) {
                    result += equalto(p,n,i);
                }
                return result;
            }
            function greaterthan(p,n,x) {
                let result = 0;
                for(let i=n; i>x; i--) {
                    result += equalto(p,n,i);
                }
                return result;
            }
            function roundto(num, digits) {
                return (Math.round(num*Math.pow(10,digits) ) / Math.pow(10,digits) );
            }
            function choice(n,k) {
                let result = 1;
                for(let i = 1; i <= k; i++) {
                    result *= (n+1-i)/i;
                }
                return result;
            }
            google.charts.load('current', {'packages':['corechart','bar']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                //pie
                let data = google.visualization.arrayToDataTable([
                    ['Set', 'Odds'],
                    ['P(X=x)', roundto(equalto(p, n, x), 5)],
                    ['P(X<x)', roundto(lessthan(p, n, x), 5)],
                    ['P(X>x)', roundto(greaterthan(p, n, x), 5)]
                ]);

                let foregroundColor =  '#333';
                let backgroundColor = '#fff';

                let options = {
                    'title':'<?=$lang['33']?> x', 
                    legend: {textStyle: {color: foregroundColor} }, 
                    titleTextStyle: {color: foregroundColor}, 
                    'width':'80%', 
                    colors: ['#1e5b80', '#800000', '#0086F2'], 
                    backgroundColor: { fill: backgroundColor} 
                };

                let chart = new google.visualization.PieChart(document.getElementById('piechart') );

                chart.draw(data, options);
                // $('svg rect[x=0][y=0]')[0].style.fill='none';
                var rect = document.querySelector('svg rect[x="0"][y="0"]');
                if (rect) {
                    rect.style.fill = 'none';
                }


                let chartdata = [['','', { role: 'style' } ]];
                for(let numSuccesses = 0; numSuccesses<n+1; numSuccesses++) {
                    let color = '#800000';
                    if(numSuccesses==x) color = '#1e5b80';
                    if(numSuccesses>x) color = '#0086F2';
                    chartdata.push([numSuccesses, equalto(p,n,numSuccesses), color]);
                }

                data = google.visualization.arrayToDataTable(chartdata);

                options = {
                    title: '<?=$lang['31']?>', 
                    titleTextStyle:{color: foregroundColor},
                    legend: 'none',
                    chartArea: {width: '75%', legend: {position: 'none'} },
                    hAxis: {
                        title: '<?=$lang['32']?> x',
                        textStyle: {color: foregroundColor},
                        titleTextStyle: {color: foregroundColor}
                    },
                    vAxis: {
                        title: 'P(x)',
                        textStyle: {color: foregroundColor},
                        titleTextStyle: {color: foregroundColor}
                    },
                    backgroundColor: {fill: backgroundColor}
                };
            
                chart = new google.visualization.ColumnChart(document.getElementById('barchart') );

                chart.draw(data, options); 
                
                // $('svg rect[x=0][y=0]')[1].style.fill='none';
                var rects = document.querySelectorAll('svg rect[x="0"][y="0"]');
                if (rects.length > 1) {
                    rects[1].style.fill = 'none';
                }


            }
        </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
@endpush
