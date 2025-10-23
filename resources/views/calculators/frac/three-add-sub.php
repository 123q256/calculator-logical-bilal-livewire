<?php if ($N2<0 || $N3<0) { ?>
    <p class="mt-2"><?=$lang[5]?>:</p>
    <?php if($N2<0){
        $N2 = abs($N2);
        if ($action=='+') {
            $action='-';
        } else {
            $action='+';
        }
     } ?>
    <?php if($N3<0){
        $N3 = abs($N3);
        if ($action1=='+') {
            $action1='-';
        } else {
            $action1='+';
        }
     } ?>
    <p class="text-center mt-2">
     \( =\dfrac{<?=$N1?>}{<?=$D1?>} <?=$action?> \dfrac{<?=$N2?>}{<?=$D2?>}  <?=$action1?> \dfrac{<?=$N3?>}{<?=$D3?>} \)
    </p>
<?php } ?>
<?php if ($D1!=$D2 || $D1!=$D3) { ?>
    <p class="mt-2"><?=$lang[14]?>.</p>
    <?php $x = "$N1/$D1,$N2/$D2,$N3/$D3" ?>
    <p class="mt-2">
        <a href="#" class="text-blue text-decoration-none" target="_blank">LCD(<?=$x?>) = <?=$detail['lcd']?></a>
    </p>
    <p class="mt-2"><?=$lang[15]?>.</p>
    <p class="text-center mt-2">
        \( = \left(\dfrac{<?=$N1?>}{<?=$D1?>} \times \dfrac{<?=$detail['lcd']/$D1?>}{<?=$detail['lcd']/$D1?>} \right) <?=$action?> \left(\dfrac{<?=$N2?>}{<?=$D2?>} \times \dfrac{<?=$detail['lcd']/$D2?>}{<?=$detail['lcd']/$D2?>} \right) <?=$action1?> \left(\dfrac{<?=$N3?>}{<?=$D3?>} \times \dfrac{<?=$detail['lcd']/$D3?>}{<?=$detail['lcd']/$D3?>} \right) \)
    </p>
    <p class="mt-2"><?=$lang[16]?>.</p>
    <p class="text-center mt-2">
        <?php $mul1 = $detail['lcd']/$D1;$mul2 = $detail['lcd']/$D2;$mul3 = $detail['lcd']/$D3; ?>
        \( =\left(\dfrac{<?=$N1*$mul1?>}{<?=$D1*$mul1?>} \right) <?=$action?> \left(\dfrac{<?=$N2*$mul2?>}{<?=$D2*$mul2?>} \right) <?=$action1?> \left(\dfrac{<?=$N3*$mul3?>}{<?=$D3*$mul3?>} \right) \)
    </p>
    <p class="mt-2"><?=$lang[17]?>.</p>
    <p class="text-center mt-2">
        <?php if($action=='+'){ 
            $plus = ($N1*$mul1) + ($N2*$mul2);
            }elseif($action=='-'){
            $plus = ($N1*$mul1) - ($N2*$mul2);
            } ?>
        <?php if($action1=='+'){ 
            $plus = $plus + ($N3*$mul3);
            }elseif($action=='-'){
            $plus = $plus - ($N3*$mul3);
            } ?>
        \( =\dfrac{<?=$N1*$mul1?> <?=$action?> <?=$N2*$mul2?> <?=$action1?> <?=$N3*$mul3?>}{<?=$D1*$mul1?>} \)
    </p>
    <p class="text-center mt-2">
        \( = \dfrac{<?=$plus?>}{<?=$D1*$mul1?>} \)
    </p>
<?php }else{ $mul1=1; ?>
    <p class="mt-2"><?=$lang[17]?>.</p>
    <p class="text-center mt-2">
        <?php if($action=='+'){ 
            $plus = ($N1) + ($N2);
            }elseif($action=='-'){
            $plus = ($N1) - ($N2);
            } ?>
        <?php if($action1=='+'){ 
            $plus = $plus + ($N3);
            }elseif($action=='-'){
            $plus = $plus - ($N3);
            } ?>
        \( =\dfrac{<?=$N1?> <?=$action?> <?=$N2?> <?=$action1?> <?=$N3?>}{<?=$D1?>} \)
    </p>
    <p class="text-center mt-2">
        \( = \dfrac{<?=$plus?>}{<?=$D1?>} \)
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
    <p class="mt-2 text-center">\( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)</p>
    <p class="mt-2"><?=$lang[21]?></p>
    <p class="mt-2 text-center">\( <?=$detail['upr']?> \div <?=$detail['btm']?> \)</p>
    <?php if($detail['upr']%$detail['btm']!=0 && $detail['upr']>$detail['btm']){ ?>
        <p class="mt-2"><?=$lang[22]?>:</p>
        <?php
            $bta=abs($detail['upr'] % $detail['btm']);
            $shi=$detail['upr'] / $detail['btm'];
            $shi = explode('.',$shi);
            $shi = $shi[0];
        ?>
        <p class="mt-2 text-center">\( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} = <?=$shi.' \\dfrac{'.$bta.'}{'.$detail['btm']?>} \)</p>
        <p class="mt-2"><?=$lang[23]?>:</p>
        <p class="mt-2 text-center">\( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$action?> \dfrac{<?=$N2?>}{<?=$D2?>} <?=$action1?> \dfrac{<?=$N3?>}{<?=$D3?>} = <?=$shi.' \\dfrac{'.$bta.'}{'.$detail['btm']?>} \)</p>
    <?php } ?>
<?php }else{ ?>
        <p class="mt-2"><?=$lang[23]?>:</p>
        <p class="mt-2 text-center">
            \( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$action?> \dfrac{<?=$N2?>}{<?=$D2?>} <?=$action1?> \dfrac{<?=$N3?>}{<?=$D3?>} = \)
            <?php if($detail['btm']!=1 && $detail['upr']!=0){ ?>
                \( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)
            <?php }else{ ?>
                \( <?=$detail['upr']?> \)
            <?php } ?>
        </p>
<?php } ?>