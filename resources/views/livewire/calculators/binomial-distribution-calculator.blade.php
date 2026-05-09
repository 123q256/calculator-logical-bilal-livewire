<div>
 <form wire:submit.prevent="calculate">

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-1  lg:grid-cols-2 md:grid-cols-2  gap-4">
                <div class="space-y-2 relative">
                    <label for="n" class="font-s-14 text-blue">{{ $lang['1'] }} (n):</label>
                    <input type="number" step="any" wire:model.live="n" id="n" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2 relative">
                    <label for="p" class="font-s-14 text-blue">{{ $lang['2'] }} (p):</label>
                    <input type="number" step="any" wire:model.live="p" id="p" min="0" max="1" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2 relative">
                    <label for="x" class="font-s-14 text-blue">{{ $lang['3'] }} (X):</label>
                    <input type="number" step="any" wire:model.live="x" id="x" class="input" aria-label="input" placeholder="00" />
                </div>
                <div class="space-y-2 relative">
                    <label for="con" class="font-s-14 text-blue">{{ $lang['34'] }}:</label>
                    <select wire:model.live="con" id="con" class="input" autocomplete="off">
                        <option value="1">{{ $lang['5'] }} X {{ $lang['4'] }} P(X = x)</option>
                        <option value="2">{{ $lang['6'] }} X {{ $lang['4'] }} P(X < x)</option>
                        <option value="3">{{ $lang['7'] }} X {{ $lang['4'] }} P(X ≤ x)</option>
                        <option value="4">{{ $lang['8'] }} X {{ $lang['4'] }} P(X > x)</option>
                        <option value="5">{{ $lang['9'] }} X {{ $lang['4'] }} P(X ≥ x)</option>
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
    <hr>

    <div id="result-section" wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
                <div class="">
                        @if ($type == 'calculator')
                            @include('inc.copy-pdf')
                        @endif
                    <div class="rounded-lg  flex items-center justify-center">
                        <div class="w-full">
                            @php
                                // Properties $x, $n, $p, $con are automatically available.
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
                            <div class="w-full mt-8 grid grid-cols-1 md:grid-cols-2 gap-8"
                                 x-data="{ 
                                    detail: {{ json_encode($detail) }},
                                    x: {{ $x }},
                                    n: {{ $n }},
                                    render() {
                                        if (typeof Highcharts === 'undefined') {
                                            setTimeout(() => this.render(), 200);
                                            return;
                                        }

                                        const table = Object.values(this.detail.table).map(Number);
                                        const xInt = parseInt(this.x);
                                        const nInt = parseInt(this.n);

                                        // Calculate Pie Chart Data
                                        const pEqualX = table[xInt] || 0;
                                        const pLessX = table.slice(0, xInt).reduce((a, b) => a + b, 0);
                                        const pGreaterX = table.slice(xInt + 1).reduce((a, b) => a + b, 0);

                                        // 1. Pie Chart
                                        Highcharts.chart(this.$refs.pie, {
                                            chart: { type: 'pie', backgroundColor: 'transparent' },
                                            title: { text: '{{ $lang['33'] }} x', align: 'left', style: { color: '#333' } },
                                            tooltip: { pointFormat: '{series.name}: <b>{point.y:.5f}</b>' },
                                            plotOptions: {
                                                pie: {
                                                    allowPointSelect: true,
                                                    cursor: 'pointer',
                                                    dataLabels: { enabled: true, format: '<b>{point.name}</b>: {point.percentage:.1f} %' }
                                                }
                                            },
                                            series: [{
                                                name: 'Probability',
                                                colorByPoint: true,
                                                data: [
                                                    { name: 'P(X=x)', y: pEqualX, color: '#1e5b80' },
                                                    { name: 'P(X<x)', y: pLessX, color: '#800000' },
                                                    { name: 'P(X>x)', y: pGreaterX, color: '#0086F2' }
                                                ]
                                            }],
                                            credits: { enabled: false }
                                        });

                                        // 2. Bar Chart
                                        const barData = table.map((val, i) => {
                                            let color = '#800000';
                                            if (i === xInt) color = '#1e5b80';
                                            if (i > xInt) color = '#0086F2';
                                            return { y: val, color: color };
                                        });

                                        Highcharts.chart(this.$refs.bar, {
                                            chart: { type: 'column', backgroundColor: 'transparent' },
                                            title: { text: '{{ $lang['31'] }}', align: 'left', style: { color: '#333' } },
                                            xAxis: { title: { text: '{{ $lang['32'] }} x' }, categories: Array.from({length: nInt + 1}, (_, i) => i) },
                                            yAxis: { title: { text: 'P(x)' } },
                                            legend: { enabled: false },
                                            tooltip: { pointFormat: 'P(x): <b>{point.y:.5f}</b>' },
                                            series: [{ name: 'P(x)', data: barData }],
                                            credits: { enabled: false }
                                        });
                                    }
                                 }"
                                 x-init="render()"
                                 @chart-updated.window="detail = $event.detail.detail; x = $event.detail.x; n = $event.detail.n; render();"
                                 wire:ignore>
                                <div x-ref="pie" style="height: 350px;" class="w-full"></div>
                                <div x-ref="bar" style="height: 350px;" class="w-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endisset
</form>
@push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
    <script defer src="{{ url('katex/katex.min.js') }}"></script>
    <script defer src="{{ url('katex/auto-render.min.js') }}" onload="renderMathInElement(document.body);"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
@endpush

</div>
