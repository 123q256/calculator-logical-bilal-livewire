<p class="mt-2">
    So we are having three different operations in the problem given. But first, we will work on × operation
</p>
<?php if($action2=='÷'){ 
    $ON1 = $N1;
    $OD1 = $D1;
    $ON2 = $N2;
    $OD2 = $D2;
    $ON3 = $N3;
    $OD3 = $D3;
    $ON4 = $N4;
    $OD4 = $D4;
    list($N4,$D4) = array($D4,$N4);
    $oaction = $action;
    $oaction1 = $action1;
    $oaction2 = $action2;
    $action2 = '×';


    // $N3 = $OD3;
    // $D3 = $ON3;
    // $n3 = $N3;$d3=$D3;
    // $act = $action1;
    // $oaction1 = $action2;
    // $action1 = '×';
?>
    <p class="mt-2"><?=$lang[26]?>.</p>
    <p class="mt-2"><?=$lang[27]?>.</p>
    <p class="text-center mt-2">
        \( \dfrac{<?=$N3?>}{<?=$D3?>} <?=$action2?> \dfrac{<?=$N4?>}{<?=$D4?>} = \ ? \)
    </p>
<?php }else{
    $ON1 = $N1;
    $OD1 = $D1;
    $ON2 = $N2;
    $OD2 = $D2;
    $ON3 = $N3;
    $OD3 = $D3;
    $ON4 = $N4;
    $OD4 = $D4;
    $oaction = $action;
    $oaction1 = $action1;
    $oaction2 = $action2;
} ?>
<p class="mt-2"><?=$lang[28]?>.</p>
<p class="text-center mt-2"> 
    \( \dfrac{<?=$N3?>\times<?=$N4?>}{<?=$D3?>\times<?=$D4?>} = \dfrac{<?=$N3*$N4?>}{<?=$D3*$D4?>} \)
</p>
<?php $up = $N3*$N4;$btm=$D3*$D4; ?>
<?php if(gcd($up,$btm)!=1){ $gcd=gcd($up,$btm); ?>
    <p class="mt-2"><?=$lang[18]?> <?=$up?> <?=$lang[12]?> <?=$btm?> <?=$lang[19]?></p>
    <p class="mt-2">
        <a href="#" class="text-blue text-decoration-none" target="_blank">GCF(<?=$up?>,<?=$btm?>) = <?=$gcd?></a>
    </p>
    <p class="text-center mt-2">
        \( \dfrac{<?=$up?> \div <?=$gcd?>}{<?=$btm?> \div <?=$gcd?>} = \)
        <?php
            $up = $up / $gcd;
            $btm = $btm / $gcd;
         if($btm!=1 && $up!=0){ ?>
            \( \dfrac{<?=$up?>}{<?=$btm?>} \)
        <?php }else{ ?>
            \( <?=$up?> \)
        <?php } ?>
    </p>
<?php } ?>
<p class="mt-2"><?=$lang[23]?>:</p>
<p class="text-center mt-2">
\( \dfrac{<?=$N3?>}{<?=$D3?>} <?=$action2?> \dfrac{<?=$N4?>}{<?=$D4?>} = \)
    <?php if($btm!=1 && $up!=0){ ?>
        \( \dfrac{<?=$up?>}{<?=$btm?>} \)
    <?php }else{ ?>
        \( <?=$up?> \)
    <?php } ?>
</p>
<p class="mt-2">
    <?=$lang[29]?> <?=$action?> and <?=$action1?> <?=$lang[25]?>
</p>
<?php 
    $n1 = $N1;$d1=$D1;
    $n3 = $N3;$d3=$D3;
    $act1 = $action1;
    $N1 = $up;
    $D1 = $btm;
    $N2 = $N3;
    $D2 = $D3;
    $action1 = $action1;
?>
<p class="text-center mt-2">
    \(
        \dfrac{<?=$ON1?>}{<?=$OD1?>} <?=$action?> 
        \dfrac{<?=$ON2?>}{<?=$OD2?>} <?=$action1?> 
        \dfrac{<?=$up?>}{<?=$btm?>} = \ ?
    \)
</p>
<?php if ($OD1!=$OD2 || $OD1!=$btm) { ?>
    <p class="mt-2"><?=$lang[14]?>.</p>
    <?php
        $x = "$ON1/$OD1,$ON2/$OD2,$up/$btm";
        $mul_lcm = lcmofn([$OD1,$OD2,$btm], 3);
    ?>
    <p class="mt-2">
        <a href="#" class="text-blue text-decoration-none" target="_blank">LCD(<?=$x?>) = <?= $mul_lcm ?></a>
    </p>
    <p class="mt-2"><?=$lang[15]?>.</p>
    <p class="text-center mt-2">
        \(
            = \left(\dfrac{<?=$ON1?>}{<?=$OD1?>} \times \dfrac{<?=$mul_lcm/$OD1?>}{<?=$mul_lcm/$OD1?>} \right) <?=$action?> 
            \left(\dfrac{<?=$ON2?>}{<?=$OD2?>} \times \dfrac{<?=$mul_lcm/$OD2?>}{<?=$mul_lcm/$OD2?>} \right) <?=$action1?> 
            \left(\dfrac{<?=$up?>}{<?=$btm?>} \times \dfrac{<?=$mul_lcm/$btm?>}{<?=$mul_lcm/$btm?>} \right)
        \)
    </p>
    <p class="mt-2"><?=$lang[16]?>.</p>
    <p class="text-center mt-2">
        <?php 
            $mul1 = $mul_lcm/$OD1;
            $mul2 = $mul_lcm/$OD2; 
            $mul3 = $mul_lcm/$btm; 
        ?>
        \(
            =\left(\dfrac{<?=$ON1*$mul1?>}{<?=$OD1*$mul1?>} \right) <?=$action?> 
            \left(\dfrac{<?=$ON2*$mul2?>}{<?=$OD2*$mul2?>} \right) <?=$action1?>
            \left(\dfrac{<?=$up*$mul3?>}{<?=$btm*$mul3?>} \right)
        \)
    </p>
    <p class="mt-2"><?=$lang[17]?>.</p>
    <p class="text-center mt-2">
        <?php 
            // for action 
            if($action=='+'){ 
                $plus = ($ON1*$mul1) + ($ON2*$mul2);
            }elseif($action=='-'){
                $plus = ($ON1*$mul1) - ($ON2*$mul2);
            }
            // for action2 
            if($action1=='+'){ 
                $plus = $plus + ($up*$mul3);
            }elseif($action1=='-'){
                $plus = $plus - ($up*$mul3);
            }
        ?>
        \( =\dfrac{<?=$ON1*$mul1?> <?=$action?> <?=$ON2*$mul2?> <?=$action1?> <?=$up*$mul3?>}{<?=$OD1*$mul1?>} \)
    </p>
    <p class="text-center mt-2">
        \( = \dfrac{<?=$plus?>}{<?=$OD1*$mul1?>} \)
    </p>
<?php }else{ $mul1=1; ?>
    <p class="mt-2"><?=$lang[17]?>.</p>
    <p class="text-center mt-2">
        <?php 
            // for action 
            if($action=='+'){ 
                $plus = ($ON1) + ($ON2);
            }elseif($action=='-'){
                $plus = ($ON1) - ($ON2);
            }
            // for action2 
            if($action1=='+'){ 
                $plus = $plus + ($up);
            }elseif($action1=='-'){
                $plus = $plus - ($up);
            }
        ?>
        \( =\dfrac{<?=$ON1?> <?=$action?> <?=$ON2?> <?=$action1?> <?=$up?>}{<?=$OD1?>} \)
    </p>
    <p class="text-center mt-2">
        \( = \dfrac{<?=$plus?>}{<?=$OD1?>} \)
    </p>
<?php } ?>

<!-- for GCF -->
<?php if(gcd($plus,$D1*$mul1)!=1){ $gcd=gcd($plus,$D1*$mul1); ?>
    <p class="mt-2"><?=$lang[18]?> <?=$plus?> <?=$lang[12]?> <?=$OD1*$mul1?> <?=$lang[19]?></p>
    <p class="mt-2">
        <a href="#" class="text-blue text-decoration-none" target="_blank">GCF(<?=$plus?>,<?=$OD1*$mul1?>) = <?=$gcd?></a>
    </p>
    <p class="text-center mt-2">
        \( \dfrac{<?=$plus?> \div <?=$gcd?>}{<?=$OD1*$mul1?> \div <?=$gcd?>} = \)
        <?php if($detail['btm']!=1 && $detail['upr']!=0){ ?>
            \( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)
        <?php }else{ ?>
            \( <?=$detail['upr']?> \)
        <?php } ?>
    </p>
<?php } ?>

<?php if($detail['btm']!=1 && $detail['upr']!=0 && $detail['upr']>$detail['btm']){ ?>
    <p class="mt-2"><?=$lang[20]?></p>
    <p class="text-center mt-2">\( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)</p>
    <p class="mt-2"><?=$lang[21]?></p>
    <p class="text-center mt-2">\( <?=$detail['upr']?> \div <?=$detail['btm']?> \)</p>
    <?php if($detail['upr']%$detail['btm']!=0 && $detail['upr']>$detail['btm']){ ?>
        <p class="mt-2"><?=$lang[22]?>:</p>
        <?php
            $bta=abs($detail['upr'] % $detail['btm']);
            $shi=$detail['upr'] / $detail['btm'];
            $shi = explode('.',$shi);
            $shi = $shi[0];
        ?>
        <p class="text-center mt-2">
            \( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} = <?=$shi.' \\dfrac{'.$bta.'}{'.$detail['btm']?>} \)
        </p>
        <p class="mt-2"><?=$lang[23]?>:</p>
        <p class="text-center mt-2">
            \(
                \dfrac{<?=$ON1?>}{<?=$OD1?>} <?=$oaction?> 
                \dfrac{<?=$ON2?>}{<?=$OD2?>} <?=$oaction1?> 
                \dfrac{<?=$ON3?>}{<?=$OD3?>} <?=$oaction2?>
                \dfrac{<?=$ON4?>}{<?=$OD4?>} = <?=$shi.' \\dfrac{'.$bta.'}{'.$detail['btm']?>}
            \)
        </p>
    <?php } ?>
<?php }else{ ?>
        <p class="mt-2"><?=$lang[23]?>:</p>
        <p class="text-center mt-2">
            \(
                \dfrac{<?=$ON1?>}{<?=$OD1?>} <?=$oaction?> 
                \dfrac{<?=$ON2?>}{<?=$OD2?>} <?=$oaction1?> 
                \dfrac{<?=$ON3?>}{<?=$OD3?>} <?=$oaction2?>
                \dfrac{<?=$ON4?>}{<?=$OD4?>} =
            \)
            <?php if($detail['btm']!=1 && $detail['upr']!=0){ ?>
                \( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)
            <?php }else{ ?>
                \( <?=$detail['upr']?> \)
            <?php } ?>
        </p>
<?php } ?>