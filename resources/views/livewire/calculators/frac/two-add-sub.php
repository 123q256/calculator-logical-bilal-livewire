<?php if($D1!=$D2){ ?>
    <p class="mt-2"><?=$lang[30]?>.</p>
    <?php $x = "$N1/$D1,$N2/$D2" ?>
    <p class="mt-2">
        <a href="#" class="text-blue text-decoration-none mt-2" target="_blank">LCD(<?=$x?>) = <?=$detail['lcd']?></a>
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
    <p class="mt-2"><?=$lang[17]?>.<br> <?=$lang[35]?>:</p>
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
        <p class="mt-2 text-center">\( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$action?> \dfrac{<?=$N2?>}{<?=$D2?>} = <?=$shi.' \\dfrac{'.$bta.'}{'.$detail['btm']?>} \)</p>
    <?php } ?>
<?php }else{ ?>
        <p class="mt-2"><?=$lang[23]?>:</p>
        <p class="mt-2 text-center">
            \( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$action?> \dfrac{<?=$N2?>}{<?=$D2?>} = \)
            <?php if($detail['btm']!=1 && $detail['upr']!=0){ ?>
                \( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)
            <?php }else{ ?>
                \( <?=$detail['upr']?> \)
            <?php } ?>
        </p>
<?php } ?>

<!-- Calculation by Formula -->
<p class="font-s-20 mt-2"><strong><?=$lang[36]?>:</strong></p>
<?php if($action=='+' || $action=='-'){ ?>
    <p class="mt-2"><?=$lang[37]?> <?=($action=='+')?'+':'-'?>, to</p>
    <p class="text-center mt-2">\( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$action?> \dfrac{<?=$N2?>}{<?=$D2?>} \)</p>
    <p class="mt-2"><?=$lang[38]?></p>
    <p class="text-center mt-2">\( =\dfrac{(<?=$N1.'×'.$D2?>)<?=$action?>(<?=$N2.'×'.$D1?>)}{(<?=$D1.'×'.$D2?>)} \)</p>
    <p class="text-center mt-2">\( =\dfrac{<?=$N1*$D2?><?=$action?><?=$N2*$D1?>}{<?=$D1*$D2?>} \)</p>
    <?php if($action=='+'){
        $uper = ($N1*$D2)+($N2*$D1);
        $btm = $D1*$D2;
        $g=gcd($uper,$btm);
            ?>
        <p class="text-center mt-2">\( =\dfrac{<?=($N1*$D2)+($N2*$D1)?>}{<?=$D1*$D2?>} \)</p>
    <?php }else{
        $uper = ($N1*$D2)-($N2*$D1);
        $btm = $D1*$D2;
        $g=gcd($uper,$btm);
        ?>
        <p class="text-center mt-2">\( =\dfrac{<?=($N1*$D2)-($N2*$D1)?>}{<?=$D1*$D2?>} \)</p>
    <?php } ?>
    <?php if($g!=1){ ?>
        <p class="mt-2"><?=$lang[39]?></p>
        <p class="mt-2">
            <a href="#" class="text-blue text-decoration-none" target="_blank">GCF(<?=$uper?>,<?=$btm?>) = <?=$g?></a>
        </p>
        <p class="text-center mt-2">
            \( \dfrac{<?=$uper?> \div <?=$g?>}{<?=$btm?> \div <?=$g?>} = \)
            <?php if($detail['btm']!=1 && $detail['upr']!=0){ ?>
                \( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)
            <?php }else{ ?>
                \( <?=$detail['upr']?> \)
            <?php } ?>
        </p>
    <?php } ?>
    <?php if($detail['btm']!=1 && $detail['upr']!=0){ ?>
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
            <p class="mt-2 text-center">\( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$action?> \dfrac{<?=$N2?>}{<?=$D2?>} = <?=$shi.' \\dfrac{'.$bta.'}{'.$detail['btm']?>} \)</p>
        <?php } ?>
    <?php }else{ ?>
        <p class="mt-2"><?=$lang[23]?>:</p>
        <p class="mt-2 text-center">
            \( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$action?> \dfrac{<?=$N2?>}{<?=$D2?>} = \)
            <?php if($detail['btm']!=1 && $detail['upr']!=0){ ?>
                \( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)
            <?php }else{ ?>
                \( <?=$detail['upr']?> \)
            <?php } ?>
        </p>
    <?php } ?>
<?php } ?>