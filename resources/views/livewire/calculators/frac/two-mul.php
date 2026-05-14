<?php if($action=='÷'){ 
    $ON2 = $N2;
    $OD2 = $D2;
    $N2 = $OD2;
    $D2 = $ON2;
    $oaction = $action;
    $action = '×';
?>
    <p class="mt-2"><?=$lang[26]?>.</p>
    <p class="mt-2"><?=$lang[27]?>.</p>
    <p class="mt-2">
        \( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$action?> \dfrac{<?=$N2?>}{<?=$D2?>} = ? \)
    </p>
<?php }else{
    $ON2 = $N2;
    $OD2 = $D2;
    $oaction = $action;
} ?>
<?php if($action=='of'){ 
    $oaction = $action;
    $action = '×';
 } ?>
<p class="mt-2"><?=$lang[28]?>.</p>
<p class="mt-2 text-center">
    \( \dfrac{<?=$N1?>\times<?=$N2?>}{<?=$D1?>\times<?=$D2?>} = \dfrac{<?=$N1*$N2?>}{<?=$D1*$D2?>} \)
</p>
<?php $up = $N1*$N2;$btm=$D1*$D2; ?>
<?php if(gcd($up,$btm)!=1){ $gcd=gcd($up,$btm); ?>
    <p class="mt-2"><?=$lang[18]?> <?=$up?> <?=$lang[12]?> <?=$btm?> <?=$lang[19]?></p>
    <p class="mt-2">
        <a href="#" class="text-blue text-decoration-none mt-2" target="_blank">GCF(<?=$up?>,<?=$btm?>) = <?=$gcd?></a>
    </p>
    <p class="mt-2">
        \( \dfrac{<?=$up?> \div <?=$gcd?>}{<?=$btm?> \div <?=$gcd?>} =  \)
        <?php if($detail['btm']!=1 && $detail['upr']!=0){ ?>
            \( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)
        <?php }else{ ?>
            \( <?=$detail['upr']?> \)
        <?php } ?>
    </p>
<?php } ?>
<?php if($detail['btm']!=1 && $detail['upr']!=0){ ?>
    <?php if($detail['upr']%$detail['btm']!=0 && $detail['upr']>$detail['btm']){ ?>
        <p class="mt-2"><?=$lang[20]?></p>
        <p class="mt-2 text-center">\( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)</p>
        <p class="mt-2"><?=$lang[21]?></p>
        <p class="mt-2 text-center">\( <?=$detail['upr']?> \div <?=$detail['btm']?> \)</p>
        <p class="mt-2"><?=$lang[22]?>:</p>
        <?php
            $bta=abs($detail['upr'] % $detail['btm']);
            $shi=$detail['upr'] / $detail['btm'];
            $shi = explode('.',$shi);
            $shi = $shi[0];
        ?>
        <p class="mt-2 text-center">\( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} = <?=$shi.' \\dfrac{'.$bta.'}{'.$detail['btm']?>} \)</p>
        <p class="mt-2"><?=$lang[23]?>:</p>
        <p class="mt-2 text-center">\( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$oaction?> \dfrac{<?=$ON2?>}{<?=$OD2?>} = <?=$shi.' \\dfrac{'.$bta.'}{'.$detail['btm']?>} \)</p>
    <?php }else{ ?>
        <p class="mt-2"><?=$lang[23]?>:</p>
        <p class="mt-2 text-center">
            \( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$oaction?> \dfrac{<?=$ON2?>}{<?=$OD2?>} =  \)
            <?php if($detail['btm']!=1 && $detail['upr']!=0){ ?>
                \( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)
            <?php }else{ ?>
                \( <?=$detail['upr']?> \)
            <?php } ?>
        </p>
    <?php } ?>
<?php }else{ ?>
    <p class="mt-2"><?=$lang[23]?>:</p>
    <p class="mt-2 text-center">
        \( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$oaction?> \dfrac{<?=$ON2?>}{<?=$OD2?>} = \)
        <?php if($detail['btm']!=1 && $detail['upr']!=0){ ?>
            \( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)
        <?php }else{ ?>
            \( <?=$detail['upr']?> \)
        <?php } ?>
    </p>
<?php } ?>

<!-- Calculation by Formula -->
<p class="font-s-25 mt-2"><?=$lang[36]?>:</p>
<?php if($oaction=='×' || $oaction=='of' || $oaction=='÷'){ ?>
    <p class="mt-2"><?=$lang[37]?> <?=(($action=='÷')?'÷':'×')?>, <?=$lang[40]?></p>
    <p class="mt-2 text-center">
        \( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$oaction?> \dfrac{<?=$ON2?>}{<?=$OD2?>} \)
    </p>
    <p class="mt-2"><?=$lang[38]?></p>
    <p class="mt-2 text-center">
        \( \dfrac{<?=$N1?><?=$action?><?=$N2?>}{<?=$D1?><?=$action?><?=$D2?>} \)
    </p>
    <p class="mt-2 text-center">
        \( = \dfrac{<?=$N1*$N2?>}{<?=$D1*$D2?>} \)
    </p>
    <?php if(gcd($up,$btm)!=1){ $gcd=gcd($up,$btm); ?>
        <p class="mt-2"><?=$lang[39]?></p>
        <p class="mt-2">
            <a href="#" class="text-blue text-decoration-none mt-2" target="_blank">GCF(<?=$up?>,<?=$btm?>) = <?=$gcd?></a>
        </p>
        <p class="mt-2">
            \( \dfrac{<?=$up?> \div <?=$gcd?>}{<?=$btm?> \div <?=$gcd?>} =  \)
            <?php if($detail['btm']!=1 && $detail['upr']!=0){ ?>
                \( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)
            <?php }else{ ?>
                \( <?=$detail['upr']?> \)
            <?php } ?>
        </p>
    <?php } ?>

    <?php if($detail['btm']!=1 && $detail['upr']!=0 && $detail['upr']>$detail['btm']){ ?>
        <?php if($detail['upr']%$detail['btm']!=0 && $detail['upr']>$detail['btm']){ ?>
            <p class="mt-2"><?=$lang[22]?>:</p>
            <?php
                $bta=abs($detail['upr'] % $detail['btm']);
                $shi=$detail['upr'] / $detail['btm'];
                $shi = explode('.',$shi);
                $shi = $shi[0];
            ?>
            <p class="mt-2 text-center">\( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} = <?=$shi.' \\dfrac{'.$bta.'}{'.$detail['btm']?>}\( </p>
            <p class="mt-2"><?=$lang[23]?>:</p>
            <p class="mt-2 text-center">\( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$oaction?> \dfrac{<?=$ON2?>}{<?=$OD2?>} = <?=$shi.' \\dfrac{'.$bta.'}{'.$detail['btm']?>} \)</p>
        <?php } ?>
    <?php }else{ ?>
        <p class="mt-2"><?=$lang[23]?>:</p>
        <p class="mt-2 text-center">
            \( \dfrac{<?=$N1?>}{<?=$D1?>} <?=$oaction?> \dfrac{<?=$ON2?>}{<?=$OD2?>} = \)
            <?php if($detail['btm']!=1 && $detail['upr']!=0){ ?>
                \( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)
            <?php }else{ ?>
                \( <?=$detail['upr']?> \)
            <?php } ?>
        </p>
    <?php } ?>
<?php } ?>