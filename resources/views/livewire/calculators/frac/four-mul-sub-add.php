<p class="mt-2">
    So we are having three different operations in the problem given. But first, we will work on × operation
</p>
<?php if($action=='÷'){ 
    $ON2 = $N2;
    $OD2 = $D2;
    $N2 = $OD2;
    $D2 = $ON2;
    $n2 = $N2;$d2=$D2;
    $act = $action;
    $oaction = $action;
    $action = '×';
?>
    <p class="mt-2"><?=$lang[26]?>.</p>
    <p class="mt-2"><?=$lang[27]?>.</p>
    <p class="text-center mt-2">
        \( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$action?> \dfrac{<?=$N2?>}{<?=$D2?>} = ? \)
    </p>
<?php }else{
    $n2 = $N2;$d2=$D2;
    $act = $action;
    $ON2 = $N2;
    $OD2 = $D2;
    $oaction = $action;
} ?>
<p class="mt-2"><?=$lang[28]?>.</p>
<p class="text-center mt-2">
    \( \dfrac{<?=$N1?>\times<?=$N2?>}{<?=$D1?>\times<?=$D2?>} = \dfrac{<?=$N1*$N2?>}{<?=$D1*$D2?>} \)
</p>
<?php $up = $N1*$N2;$btm=$D1*$D2 ?>
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
    \( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$act?> \dfrac{<?=$n2?>}{<?=$d2?>} = \)
    <?php if($btm!=1 && $up!=0){ ?>
        \( \dfrac{<?=$up?>}{<?=$btm?>} \)
    <?php }else{ ?>
        \( <?=$up?> \)
    <?php } ?>
</p>
<p class="mt-2">
    <?=$lang[29]?> <?=$action1?> and <?=$action2?> <?=$lang[25]?>
</p>
<?php 
    $n1 = $N1;$d1=$D1;
    $n3 = $N3;$d3=$D3;
    $act1 = $action1;
    $N1 = $up;
    $D1 = $btm;
    $N2 = $N3;
    $D2 = $D3;
    $action = $action1;
?>
<p class="text-center mt-2">
    \( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$action?> \dfrac{<?=$N2?>}{<?=$D2?>} <?=$action2?> \dfrac{<?=$N4?>}{<?=$D4?>} = \ ? \)
</p>
<?php if ($D1!=$D2 || $D1!=$D4) { ?>
    <p class="mt-2"><?=$lang[14]?>.</p>
    <?php
        $x = "$N1/$D1,$N2/$D2,$N4/$D4";
        $mul_lcm = lcmofn([$D1,$D2,$D4], 3);
    ?>
    <p class="mt-2">
        <a href="<?=url('lcd-calculator/?res_link=0&x='.urlencode($x))?>" class="text-blue text-decoration-none" target="_blank">LCD(<?=$x?>) = <?= $mul_lcm ?></a>
    </p>
    <p class="mt-2"><?=$lang[15]?>.</p>
    <p class="text-center mt-2">
        \(
            = \left(\dfrac{<?=$N1?>}{<?=$D1?>} \times \dfrac{<?=$mul_lcm/$D1?>}{<?=$mul_lcm/$D1?>} \right) <?=$action1?> 
            \left(\dfrac{<?=$N2?>}{<?=$D2?>} \times \dfrac{<?=$mul_lcm/$D2?>}{<?=$mul_lcm/$D2?>} \right) <?=$action2?> 
            \left(\dfrac{<?=$N4?>}{<?=$D4?>} \times \dfrac{<?=$mul_lcm/$D4?>}{<?=$mul_lcm/$D4?>} \right)
        \)
    </p>
    <p class="mt-2"><?=$lang[16]?>.</p>
    <p class="text-center mt-2">
        <?php 
            $mul1 = $mul_lcm/$D1;
            $mul2 = $mul_lcm/$D2; 
            $mul4 = $mul_lcm/$D4; 
        ?>
        \(
            =\left(\dfrac{<?=$N1*$mul1?>}{<?=$D1*$mul1?>} \right) <?=$action1?> 
            \left(\dfrac{<?=$N2*$mul2?>}{<?=$D2*$mul2?>} \right) <?=$action2?>
            \left(\dfrac{<?=$N4*$mul4?>}{<?=$D4*$mul4?>} \right)
        \)
    </p>
    <p class="mt-2"><?=$lang[17]?>.</p>
    <p class="text-center mt-2">
        <?php 
            // for action 
            if($action1=='+'){ 
                $plus = ($N1*$mul1) + ($N2*$mul2);
            }elseif($action1=='-'){
                $plus = ($N1*$mul1) - ($N2*$mul2);
            }
            // for action2 
            if($action2=='+'){ 
                $plus = $plus + ($N4*$mul4);
            }elseif($action2=='-'){
                $plus = $plus - ($N4*$mul4);
            }
        ?>
        \( =\dfrac{<?=$N1*$mul1?> <?=$action1?> <?=$N2*$mul2?> <?=$action2?> <?=$N4*$mul4?>}{<?=$D1*$mul1?>} \)
    </p>
    <p class="text-center mt-2">
        \( = \dfrac{<?=$plus?>}{<?=$D1*$mul1?>} \)
    </p>
<?php }else{ $mul1=1; ?>
    <p class="mt-2"><?=$lang[17]?>.</p>
    <p class="text-center mt-2">
        <?php 
            // for action 
            if($action1=='+'){ 
                $plus = ($N1) + ($N2);
            }elseif($action1=='-'){
                $plus = ($N1) - ($N2);
            }
            // for action2 
            if($action2=='+'){ 
                $plus = $plus + ($N4);
            }elseif($action2=='-'){
                $plus = $plus - ($N4);
            }
        ?>
        \( =\dfrac{<?=$N1?> <?=$action?> <?=$N2?> <?=$action1?> <?=$N3?> <?=$action2?> <?=$N4?>}{<?=$D1?>} \)
    </p>
    <p class="text-center mt-2">
        \( = \dfrac{<?=$plus?>}{<?=$D1?>} \)
    </p>
<?php } ?>

<!-- for GCF -->
<?php if(gcd($plus,$D1*$mul1)!=1){ $gcd=gcd($plus,$D1*$mul1); ?>
    <p class="mt-2"><?=$lang[18]?> <?=$plus?> <?=$lang[12]?> <?=$D1*$mul1?> <?=$lang[19]?></p>
    <p class="mt-2">
        <a href="<?=url('gcf-calculator/')?>" class="text-blue text-decoration-none" target="_blank">GCF(<?=$plus?>,<?=$D1*$mul1?>) = <?=$gcd?></a>
    </p>
    <p class="text-center mt-2">
        \( \dfrac{<?=$plus?> \div <?=$gcd?>}{<?=$D1*$mul1?> \div <?=$gcd?>} = \)
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
        <p class="text-center mt-2">\( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} = <?=$shi.' \\dfrac{'.$bta.'}{'.$detail['btm']?>} \)</p>
        <p class="mt-2"><?=$lang[23]?>:</p>
        <p class="text-center mt-2">
            \(
                \dfrac{<?=$n1?>}{<?=$d1?>} <?=$act?> 
                \dfrac{<?=$ON2?>}{<?=$OD2?>} <?=$act1?> 
                \dfrac{<?=$n3?>}{<?=$d3?>} <?=$action2?>
                \dfrac{<?=$N4?>}{<?=$D4?>} = <?=$shi.' \\dfrac{'.$bta.'}{'.$detail['btm']?>}
            \)
        </p>
    <?php } ?>
<?php }else{ ?>
        <p class="mt-2"><?=$lang[23]?>:</p>
        <p class="text-center mt-2">
            \(  
                \dfrac{<?=$n1?>}{<?=$d1?>} <?=$act?> 
                \dfrac{<?=$ON2?>}{<?=$OD2?>} <?=$act1?> 
                \dfrac{<?=$n3?>}{<?=$d3?>} <?=$action2?> 
                \dfrac{<?=$N4?>}{<?=$D4?>} = 
            \)
            <?php if($detail['btm']!=1 && $detail['upr']!=0){ ?>
                \( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)
            <?php }else{ ?>
                \( <?=$detail['upr']?> \)
            <?php } ?>
        </p>
<?php } ?>