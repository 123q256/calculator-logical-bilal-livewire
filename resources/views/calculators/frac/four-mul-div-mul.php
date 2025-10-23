<?php if($action=='÷' || $action1=='÷' || $action2=='÷'){ 
    if ($action=='÷') {
        $ON2 = $N2;
        $OD2 = $D2;
        $N2 = $OD2;
        $D2 = $ON2;
        $oaction = $action;
        $action = '×';
    }
    if ($action1=='÷') {
        $ON3 = $N3;
        $OD3 = $D3;
        $N3 = $OD3;
        $D3 = $ON3;
        $oaction1 = $action1;
        $action1 = '×';
    }
    if ($action2=='÷') {
        $ON4 = $N4;
        $OD4 = $D4;
        $N4 = $OD4;
        $D4 = $ON4;
        $oaction2 = $action2;
        $action2 = '×';
    }

?>
    <p class="mt-2"><?=$lang[26]?>.</p>
    <p class="mt-2"><?=$lang[27]?>.</p>
    <p class="text-center mt-2">
        \( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$action?> \dfrac{<?=$N2?>}{<?=$D2?>} <?=$action1?> \dfrac{<?=$N3?>}{<?=$D3?>} <?=$action2?> \dfrac{<?=$N4?>}{<?=$D4?>} = ? \)
    </p>
<?php } ?>
<p class="mt-2"><?=$lang[28]?>.</p>
<p class="text-center mt-2">
    \( = \dfrac{(<?=$N1?>)\times(<?=$N2?>)\times(<?=$N3?>)\times(<?=$N4?>)}{<?=$D1?>\times<?=$D2?>\times<?=$D3?>\times<?=$D4?>} \)
</p>
<p class="text-center mt-2">
    \( = \dfrac{<?=$N1*$N2*$N3*$N4?>}{<?=$D1*$D2*$D3*$D4?>} \)
</p>
<?php $up = $N1*$N2*$N3*$N4;$btm=$D1*$D2*$D3*$D4 ?>
<?php if(gcd($up,$btm)!=1){ $gcd=gcd($up,$btm); ?>
    <p class="mt-2"><?=$lang[18]?> <?=$up?> <?=$lang[12]?> <?=$btm?> <?=$lang[19]?></p>
    <p class="mt-2">
        <a href="#" class="text-blue text-decoration-none" target="_blank">GCF(<?=$up?>,<?=$btm?>) = <?=$gcd?></a>
    </p>
    <p class="text-center mt-2">
        \( \dfrac{<?=$up?> \div <?=$gcd?>}{<?=$btm?> \div <?=$gcd?>} = \)
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
        <p class="text-center mt-2">\( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$oaction?> \dfrac{<?=$N2?>}{<?=$D2?>} <?=$oaction1?> \dfrac{<?=$N3?>}{<?=$D3?> <?=$oaction2?> \dfrac{<?=$N4?>}{<?=$D4?>} = <?=$shi.' \\dfrac{'.$bta.'}{'.$detail['btm']?>} \)</p>
    <?php } ?>
<?php }else{ ?>
        <p class="mt-2"><?=$lang[23]?>:</p>
        <p class="text-center mt-2">
            \( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$action?> \dfrac{<?=$N2?>}{<?=$D2?>} <?=$action1?> \dfrac{<?=$N3?>}{<?=$D3?>} <?=$action2?> \dfrac{<?=$N4?>}{<?=$D4?>} = \)
            <?php if($detail['btm']!=1 && $detail['upr']!=0){ ?>
                \( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)
            <?php }else{ ?>
                \( <?=$detail['upr']?> \)
            <?php } ?>
        </p>
<?php } ?>