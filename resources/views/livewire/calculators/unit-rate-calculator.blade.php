<div>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12 flex items-center">
                <div class="px-2">
                    <p class="font-s-14 text-blue text-center py-2"><strong>(<?=$lang[1]?>)</strong></p>
                    <input type="text" name="a" id="a" class="input mb-2" wire:model.live="a" aria-label="input"/>
                    <hr>
                    <input type="text" name="b" id="b" class="input mt-2" wire:model.live="b" aria-label="input"/>
                </div>
                <div class="px-2">
                    <p class="font-s-14 text-blue text-center py-2"><strong>(<?=$lang[2]?>)</strong></p>
                    <input type="text" name="c" id="c" class="input mb-2" wire:model.live="c" aria-label="input"/>
                    <hr>
                    <input type="text" name="d" id="d" class="input mt-2" wire:model.live="d" aria-label="input"/>
                </div>
                <div class="px-2 font-s-20 mt-4">
                    <p style="white-space: nowrap;"><strong>&nbsp;&nbsp;= &nbsp;&nbsp;&nbsp; ?</strong></p>
                </div>
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

    @if(isset($detail) && isset($detail['ans']))
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="w-full md:w-[60%] lg:w-[60%] mt-2">
                                <table class="w-full text-[18px]">
                                    <tr>
                                        <td class="py-2 border-b" width="60%"><strong>{{ $lang['3'] }}</strong></td>
                                        <td class="py-2 border-b">{{$detail['ans']}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="w-full text-[16px]">
                                <p class="mt-3"><strong>Solution</strong></p>
                                <p class="mt-3"><?=$lang[4]?>:</p>
                                <p class="mt-3"><?=$detail['ans']." ".$c." per ".$d?></p>
                                <p class="mt-3"> <?=$lang[5]?>:</p>
                                <p class="mt-3"><?=$lang[3]?> = a/b</p>
                                <p class="mt-3"><?=$lang[3]?> = <?=$a?>/<?=$b?> =
                                    <?php
                                    if (is_numeric($detail['ans'])) {
                                        echo $detail['ans']."/"."1";
                                    }else if (is_float($detail['ans'])) {
                                        echo $a."/".$b;
                                    }
                                    ?>
                                </p>
                                <p class="mt-3"> <?=$lang[6]?>:</p>
                                <p class="mt-3"><?=$lang[3]?> = a/b  u1/u2</p>
                                <p class="mt-3"><?=$lang[3]?> = <?=$a?>/<?=$b?> =
                                    <?php
                                    if (is_numeric($detail['ans2'])) {
                                        echo $detail['ans2']."/"."1"." u1/u2";
                                    }else if (is_float($detail['ans2'])) {
                                        echo $a."/".$b." u1/u2";
                                    }
                                    ?>
                                </p>
                                <p class="mt-3"><?=$lang[3]?> = <?=$detail['ans']." ".$c." / ".$d?></p>
                                <p class="mt-3"> <?=$lang[7]?>:</p>
                                <p class="mt-3"><?=$lang[8]?> = a:b</p>
                                <p class="mt-3"><?=$lang[8]?> = <?=$a?>:<?=$b?> =
                                    <?php
                                    if (is_numeric($detail['ans3'])) {
                                        echo $detail['ans3'].":"."1";
                                    }else if (is_float($detail['ans3'])) {
                                        echo $a.":".$b;
                                    }
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    @endif
</form>
</div>
