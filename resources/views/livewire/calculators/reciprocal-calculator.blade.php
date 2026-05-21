<div>
 <form wire:submit.prevent="calculate">
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <label for="operations" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                    <div class="w-full py-2">
                        <select wire:model.live="operations" id="operations" class="input">
                            <option value="1">{{ $lang[2] }}</option>
                            <option value="2">{{ $lang[3] }}</option>
                            <option value="3">{{ $lang[4] }}</option>
                        </select>
                    </div>
                </div>
                @if($operations == 3)
                <div class="col-span-12 flex justify-center my-3" id="math_s">
                    <div class="flex items-center gap-2 text-[16px]">
                        <span><?=$lang[5]?></span>
                        <div class="flex flex-col items-center">
                            <span class="border-b border-black px-2 leading-none pb-1"><?=$lang[6]?></span>
                            <span class="px-2 leading-none pt-1"><?=$lang[7]?></span>
                        </div>
                    </div>
                </div>
                @endif
                @if($operations == 1)
                <div class="col-span-12 flex justify-center my-3" id="math_d">
                    <div class="flex items-center gap-2 text-[16px]">
                        <div class="flex flex-col items-center">
                            <span class="border-b border-black px-2 leading-none pb-1"><?=$lang[6]?></span>
                            <span class="px-2 leading-none pt-1"><?=$lang[7]?></span>
                        </div>
                    </div>
                </div>
                @endif
                
                @if($operations == 2 || $operations == 3)
                <div class="col-span-6 pehli">
                    <label for="first" class="font-s-14 text-blue" id="txt">{{ $operations == 2 ? $lang[8] : $lang[5] }}:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" id="first" class="input" aria-label="input" wire:model.live="first" />
                    </div>
                </div>
                @endif

                @if($operations == 1 || $operations == 3)
                <div class="col-span-6 pehli2">
                    <label for="second" class="font-s-14 text-blue r"><?=$lang[6]?>:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" id="second" class="input" aria-label="input" wire:model.live="second" />
                    </div>
                </div>
                <div class="col-span-6 pehli3">
                    <label for="third" class="font-s-14 text-blue r"><?=$lang[7]?>:</label>
                    <div class="w-full py-2">
                        <input type="number" step="any" id="third" class="input" aria-label="input" wire:model.live="third" />
                    </div>
                </div>
                @endif

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
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        @php
                            $shape = request()->shape;
                        @endphp
                        <div class="w-full my-2 text-[18px]">
                            <?php
                            $operations = $detail['operations'];
                            if ($operations==1) {
                                ?>
                                <div class="text-center">
                                    <p class="text-[20px]"><strong>{{$lang['ans']}}</strong></p>
                                    <div class="flex justify-center">
                                        <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><mathjax class="black-text">  # <?= $second.'/'.$third ?> = <?=round($third/$second,4)?> # </mathjax></strong></p>
                                </div>
                                </div>
                                <p class="mb-2 text-[18px]"><strong><?=$lang['ex']?>:</strong></p>
                                <p class="text-[18px]"><?=$lang['input']?> :<mathjax class='black-text'>  # <?= $second.'/'.$third ?># </mathjax></p>
                                <p class="text-[18px] mt-2"><?=$lang['step']?> # 1<mathjax> #=(<?=$detail['totalN'].'÷'.$detail['g']?>)/(<?=$detail['totalD'].'÷'.$detail['g']?>)# </mathjax></p>
                                <?php if($detail['btm']=='1'){ ?>
                                    <?php
                                        $xx = explode('.', $detail['upr']);
                                        if (count($xx)==1) {
                                             $upr = $detail['upr'];
                                        }else if (count($xx)==2) {
                                            $upr = number_format($detail['upr'], 3);
                                        } 
                                    ?>
                                    <p class="mt-2"><?=$lang['step']?> # 2 <mathjax> # = <?=$upr?># </mathjax></p>
                                    <table class="col-lg-8 w-full">
                                        <tr>
                                            <td><span> <?=$lang['step']?> # 3 <mathjax> # = <?=$upr.'/'.$detail['btm']?># </mathjax></span><span class="r-cross text-gray">&nbsp;&nbsp; ⤭ &nbsp;&nbsp;</span><span><mathjax> # <?=$detail['btm'].'/'.$upr?># </mathjax></span></td>
                                        </tr>
                                        <tr >
                                            <td><span> <?=$lang['step']?> # 4 <mathjax> # = <?=round($detail['btm']/$detail['upr'],4)?># </mathjax></span></td>
                                        </tr>
                                    </table>
                                <?php }else{ ?>
                                    <p class="mt-2"><?=$lang['step']?> # 2 <mathjax> # = <?=$detail['upr'].'/'.$detail['btm']?># </mathjax></p>
                                    <table class="w-full">
                                        <tr>
                                            <td><span> <?=$lang['step']?> # 3 <mathjax> # = <?=$detail['upr'].'/'.$detail['btm']?># </mathjax></span><span class="r-cross text-gray">&nbsp;&nbsp; ⤭ &nbsp;&nbsp;</span><span><mathjax> # <?=$detail['btm'].'/'.$detail['upr']?># </mathjax></span></td>
                                        </tr>
                                        <tr >
                                            <td><span> <?=$lang['step']?> # 4 <mathjax> # = <?=round($detail['btm']/$detail['upr'],4)?># </mathjax></span></td>
                                        </tr>
                                    </table>
                                <?php } ?>
                            <?php 
                            }else if ($operations==2) {
                                ?>
                                <div class="text-center">
                                    <p class="text-[20px]"><strong>{{$lang['ans']}}</strong></p>
                                    <div class="flex justify-center">
                                        <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><mathjax class="black-text">  # <?= $first ?> = <?=round($detail['answer'],4)?> # </mathjax></strong></p>
                                </div>
                                </div>
                                <p class="mb-2 text-[18px]"><strong><?=$lang['ex']?>:</strong></p>
                                <p class="text-[18px]"><?=$lang['input']?> :<mathjax class='black-text'>  # <?= $first ?># </mathjax></p>
                                <p class="text-[18px] mt-2"><?=$lang['step']?> # 1<mathjax> #=(<?= $first ?>)/1# </mathjax></p>
                                <table class="w-full">
                                    <?php
                                        $yy = explode('.', $first);
                                        if (count($yy)==1) {
                                            ?>
                                            <tr class="mt-2">
                                                <td><span> <?=$lang['step']?> # 2 <mathjax> # = <?= $first .'/'."1"?># </mathjax></span><span class="r-cross text-gray">&nbsp;&nbsp; ⤭ &nbsp;&nbsp;</span><span><mathjax> # <?="1".'/'. $first ?># </mathjax></span></td>an></td>
                                            </tr>
                                            <tr class="col s12 font_size20">
                                                <td><span> <?=$lang['step']?> # 3 <mathjax> # = <?=round($detail['answer'],4)?># </mathjax></span></td>
                                            </tr>
                                            <?php
                                        }else if (count($yy)==2) {
                                            ?>
                                            <tr class="mt-2">
                                                <td><span> <?=$lang['step']?> # 2 <mathjax> # = <?= $first .'/'."1"?># </mathjax></span><span class="r-cross text-gray">&nbsp;&nbsp; ⤭ &nbsp;&nbsp;</span><span><mathjax> # <?="1".'/'. $first ?># </mathjax></span></td>
                                            </tr>
                                            <tr class="mt-2">
                                                <td><span> <?=$lang['step']?> # 3 <mathjax> # = <?=$detail['upper'].'/'.$detail['lower']?># </mathjax></span></td>
                                            </tr>
                                            <tr class="mt-2">
                                                <td><span> <?=$lang['step']?> # 4 <mathjax>  #=(<?=$detail['totalN'].'÷'.$detail['g']?>)/(<?=$detail['totalD'].'÷'.$detail['g']?>)# </mathjax></span></td>
                                            </tr>
                                            <tr class="mt-2">
                                                <td><span> <?=$lang['step']?> # 5 <mathjax>  #=(<?=$detail['upr'] ?>)/(<?=$detail['btm']?>)# </mathjax></span></td>
                                            </tr>
                                            <tr class="mt-2">
                                                <td><span> <?=$lang['step']?> # 6 <mathjax>  # = <?=round($detail['answer'],4)?># </mathjax></span></td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </table>
                                <?php
                            }else if ($operations==3) {
                                ?>
                                <div class="text-center">
                                    <p class="text-[20px]"><strong>{{$lang['ans']}}</strong></p>
                                    <div class="flex justify-center">
                                        <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><mathjax class="black-text">  #<?= (isset($first)?$first:'') ?> <?= $second.'/'.$third ?> = <?=round($detail['btm']/$detail['upr'],4)?> # </mathjax></strong></p>
                                </div>
                                </div>
                                <p class="mb-2 text-[18px]"><strong><?=$lang['ex']?>:</strong></p>
                                <p class="text-[18px]"><?=$lang['input']?> :<mathjax class='black-text'>  #<?= (isset($first)?$first:'') ?> <?= $second.'/'.$third ?># </mathjax></p>
                                <p class="text-[18px] mt-2"><?=$lang['step']?> # 1<mathjax> #=(<?=$detail['totalN']?>)/(<?=$detail['totalD']?>)# </mathjax></p>
                                <p class="text-[18px] mt-2"><?=$lang['step']?> # 2<mathjax> #=(<?=$detail['totalN'].'÷'.$detail['g']?>)/(<?=$detail['totalD'].'÷'.$detail['g']?>)# </mathjax></p>
                                <?php if($detail['btm']=='1'){ ?>
                                    <?php
                                        $xx = explode('.', $detail['upr']);
                                        if (count($xx)==1) {
                                             $upr = $detail['upr'];
                                        }else if (count($xx)==2) {
                                            $upr = number_format($detail['upr'], 3);
                                        } 
                                    ?>
                                    <p class="text-[18px] mt-2"><?=$lang['step']?> # 3 <mathjax> # = <?=$upr?># </mathjax></p>
                                    <table class="w-full">
                                        <tr class="mt-2">
                                            <td><span> <?=$lang['step']?> # 4 <mathjax> # = <?=$upr.'/'.$detail['btm']?># </mathjax></span><span class="r-cross text-gray">&nbsp;&nbsp; ⤭ &nbsp;&nbsp;</span><span><mathjax> # <?=$detail['btm'].'/'.$upr?># </mathjax></span></td>
                                        </tr>
                                        <tr >
                                            <td><span> <?=$lang['step']?> # 5 <mathjax> # = <?=round($detail['btm']/$detail['upr'],4)?># </mathjax></span></td>
                                        </tr>
                                    </table>
                                <?php }else{ ?>
                                    <p class="text-[18px] mt-2"><?=$lang['step']?> # 3 <mathjax> # = <?=$detail['upr'].'/'.$detail['btm']?># </mathjax></p>
                                    <table class="w-full">
                                        <tr class="mt-2">
                                            <td><span> <?=$lang['step']?> # 4 <mathjax> # = <?=$detail['upr'].'/'.$detail['btm']?># </mathjax></span><span class="r-cross text-gray">&nbsp;&nbsp; ⤭ &nbsp;&nbsp;</span><span><mathjax> # <?=$detail['btm'].'/'.$detail['upr']?># </mathjax></span></td>
                                        </tr>
                                        <tr >
                                            <td><span> <?=$lang['step']?> # 5 <mathjax> # = <?=round($detail['btm']/$detail['upr'],4)?># </mathjax></span></td>
                                        </tr>
                                    </table>
                                <?php } ?>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endisset
</form>

</div>
