<p class="mt-2"><b><?=$lang[24]?> <?=$action?> <?=$lang[25]?></b></p>
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
<?php if($action=='of'){ 
    $oaction = $action;
    $action = '×';
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
<p class="mt-2"><b><?=$lang[29]?> <?=$action1?> <?=$lang[25]?></b></p>
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
    \( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$action?> \dfrac{<?=$N2?>}{<?=$D2?>} = ? \)
</p>
<?php if($D1!=$D2){ ?>
    <p class="mt-2"><?=$lang[30]?>.</p>
    <?php $x = "$N1/$D1,$N2/$D2" ?>
    <p class="mt-2">
        <a href="#" class="text-blue text-decoration-none" target="_blank">LCD(<?=$x?>) = <?=$detail['lcd']?></a>
    </p>
    <p class="mt-2"><?=$lang[31]?>.</p>
    <p class="text-center mt-2">
        \( \left(\dfrac{<?=$N1?>}{<?=$D1?>} \times \dfrac{<?=$detail['lcd']/$D1?>}{<?=$detail['lcd']/$D1?>} \right) <?=$action?> \left(\dfrac{<?=$N2?>}{<?=$D2?>} \times \dfrac{<?=$detail['lcd']/$D2?>}{<?=$detail['lcd']/$D2?>} \right) = ? \)
    </p>
    <p class="mt-2"><?=$lang[32]?>.</p>
    <p class="text-center mt-2">
        <?php $mul1 = $detail['lcd']/$D1;$mul2 = $detail['lcd']/$D2; ?>
        \( \left(\dfrac{<?=$N1*$mul1?>}{<?=$D1*$mul1?>} \right) <?=$action?> \left(\dfrac{<?=$N2*$mul2?>}{<?=$D2*$mul2?>} \right) = ? \)
    </p>
    <p class="mt-2"><?=$lang[33]?> <?=($action=='+')?'+':'-'?> <?=$lang[34]?>. <br> <?=$lang[35]?>:</p>
    <p class="text-center mt-2">
        <?php if($action=='+'){ 
            $plus = ($N1*$mul1) + ($N2*$mul2);
            }elseif($action=='-'){
            $plus = ($N1*$mul1) - ($N2*$mul2);
            } ?>
        \( \dfrac{<?=$N1*$mul1?> <?=$action?> <?=$N2*$mul2?>}{<?=$D1*$mul1?>} = \dfrac{<?=$plus?>}{<?=$D1*$mul1?>} \)
    </p>
<?php }elseif($D1==$D2){
    $mul1 = 1;
        ?>
    <p class="mt-2"><?=$lang[17]?>. <br> <?=$lang[35]?>:</p>
    <p class="text-center mt-2">
        <?php if($action=='+'){ 
            $plus = ($N1) + ($N2);
            }elseif($action=='-'){
            $plus = ($N1) - ($N2);
            } ?>
        \( \dfrac{<?=$N1?> <?=$action?> <?=$N2?>}{<?=$D1?>} = \dfrac{<?=$plus?>}{<?=$D1?>} \)
    </p>
<?php } ?>

<!-- for GCF -->
<?php if(gcd($plus,$D1*$mul1)!=1){ $gcd=gcd($plus,$D1*$mul1); ?>
    <p class="mt-2"><?=$lang[18]?> <?=$plus?> <?=$lang[12]?> <?=$D1*$mul1?> <?=$lang[19]?></p>
    <p class="mt-2">
        <a href="#" class="text-blue text-decoration-none" target="_blank">GCF(<?=$plus?>,<?=$D1*$mul1?>) = <?=$gcd?></a>
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
        <p class="text-center mt-2">\( \dfrac{<?=$n1?>}{<?=$d1?>} <?=$act?> \dfrac{<?=$n2?>}{<?=$d2?>} <?=$act1?> \dfrac{<?=$n3?>}{<?=$d3?>} = <?=$shi.' \\dfrac{'.$bta.'}{'.$detail['btm']?>} \)</p>
    <?php } ?>
<?php }else{ ?>
        <p class="mt-2"><?=$lang[23]?>:</p>
        <p class="text-center mt-2">
            \( \dfrac{<?=$n1?>}{<?=$d1?>} <?=$act?> \dfrac{<?=$n2?>}{<?=$d2?>} <?=$act1?> \dfrac{<?=$n3?>}{<?=$d3?>} = \)
            <?php if($detail['btm']!=1 && $detail['upr']!=0){ ?>
                \( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)
            <?php }else{ ?>
                \( <?=$detail['upr']?> \)
            <?php } ?>
        </p>
<?php } ?>