<p class="mt-2"><?=$lang[8]?>:</p>
<p class="text-center mt-2">
    \( = \left(\dfrac{<?=$N1?>^{\dfrac{<?=$N2?>}{<?=$D2?>}}}{<?=$D1?>^{\dfrac{<?=$N2?>}{<?=$D2?>}}}\right) \)
</p>
<p class="mt-2"><?=$lang[9]?> \( \dfrac{<?=$N2?>}{<?=$D2?>} \) <?=$lang[10]?>:</p>
<p class="text-center mt-2">
    \( = \left(\dfrac{<?=$N1?>^{<?=$N2/$D2?>}}{<?=$D1?>^{<?=$N2/$D2?>}}\right) \)
</p>
<p class="text-center mt-2">
    \( = \dfrac{<?=$plus=pow($N1,$N2/$D2)?>}{<?=$btm=pow($D1,$N2/$D2)?>} \)
</p>
<?php if(gcd($plus,$btm)!=1){ $gcd=gcd($plus,$btm); ?>
    <p class="mt-2"><?=$lang[11]?> <?=$plus?> <?=$lang[12]?> <?=$btm?> <?=$lang[13]?>(<?=$plus?>,<?=$btm?>) = <?=$gcd?></p> 
    <p class="text-center mt-2">
        \( \dfrac{<?=$plus?> \div <?=$gcd?>}{<?=$btm?> \div <?=$gcd?>} =  \)
        <?php if($detail['btm']!=1 && $detail['upr']!=0){ ?>
            \( \dfrac{<?=$detail['upr']?>}{<?=$detail['btm']?>} \)
        <?php }else{ ?>
            \( <?=$detail['upr']?> \)
        <?php } ?>
    </p>
<?php } ?>