<div>
   <style>
    ul li{
        list-style-type: none;
    }
</style>
 <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto " x-data="{ type_mode: @entangle('type_mode') }">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12">
                    <p class="d-inline text-blue pe-4 font-s-14">{{$lang['17']}}</p>
                    <input type="radio" wire:model.live="type_mode" id="first" value="first">
                    <label for="first" class="font-s-14 text-blue pe-lg-3 pe-2 cursor-pointer">{{$lang['18']}} </label>
                    <input type="radio" wire:model.live="type_mode" id="second" value="second">
                    <label for="second" class="font-s-14 text-blue cursor-pointer">{{$lang['19']}} </label>
                </div>
                <div class="col-span-12 flex" id="calculator" x-show="type_mode === 'first'">
                    <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                        <div class="col-span-6">
                            <label for="firsti" class="font-s-14 text-blue"><?=$lang[1]?> :</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="first" id="firsti" class="input" aria-label="input" />
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label for="secondi" class="font-s-14 text-blue"><?=$lang[2]?> :</label>
                            <div class="w-100 py-2">
                                <input type="number" step="any" wire:model.live="second" id="secondi" class="input" aria-label="input" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12" id="converter" x-show="type_mode === 'second'" x-cloak>
                    <ul class="get_html">
                        @foreach($sub_name as $index => $subject)
                        <li class="flex gap-3 {{ $index > 0 ? 'mt-2' : '' }} items-center relative">
                            <div class="col-span-4">
                                <label for="sub_name_{{$index}}" class="font-s-14 text-blue"><?= $lang[10] ?></label>
                                <div class="py-2">
                                    <input type="text" wire:model.live="sub_name.{{$index}}" id="sub_name_{{$index}}" class="input" placeholder="<?= $lang[10] ?>">
                                </div>
                            </div>
                            <div class="col-span-4">
                                <label for="s_marks_{{$index}}" class="font-s-14 text-blue"><?= $lang[11] ?></label>
                                <div class="py-2">
                                    <input type="number" wire:model.live="s_marks.{{$index}}" id="s_marks_{{$index}}" class="input" placeholder="<?= $lang[11] ?>">
                                </div>
                            </div>
                            <div class="col-span-4 gpa_weight">
                                <label for="gpa_weight_{{$index}}" class="font-s-14 text-blue"><?= $lang[12] ?></label>
                                <div class="py-2">
                                    <input type="number" wire:model.live="a_marks.{{$index}}" id="gpa_weight_{{$index}}" class="input" placeholder="<?= $lang[12] ?>">
                                </div>
                            </div>
                            @if($index > 0)
                                <img src="{{asset('images/close.png')}}" wire:click="removeRow({{$index}})" alt="Remove Course" class="cursor-pointer object-contain absolute" style="right: -30px; top: 40px;" width="20px" height="20px">
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    <div class="my-2">
                        <button type="button" title="Add New Course" wire:click="addRow" class="units_active border p-2 cursor-pointer bg-[#2845F5] text-white rounded-lg"><b><span class="font_size20">+</span> <?= $lang[13] ?></b></button>
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

    @isset($detail)
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
            <div class="">
                @if ($type == 'calculator')
                @include('inc.copy-pdf')
                @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        <div class="w-full">
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['4']}}</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue"><?= round($detail['percent'], 2) ?> %</strong></p>
                            </div>
                        </div>
                            <?php if ($detail['type'] == "second") { ?>
                                <div class="w-full mb-3">
                                    <div class="w-full md:w-[60%] lg:w-[60%] ">
                                        <p class="text-[20px] py-2"><strong><?= $lang[14] ?></strong></p>
                                        <p class="text-blue font-s-18"><strong><?= round($detail['total_scored'], 2) ?></strong></p>
                                    </div>
                                    <div class="w-full md:w-[60%] lg:w-[60%] ">
                                        <p class="text-[20px] py-2"><strong><?= $lang[15] ?></strong></p>
                                        <p class="text-blue font-s-18"><strong><?= round($detail['total_marks'], 2) ?></strong></p>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="">
                                <?php if ($detail['type'] == "first") { ?>
                                    <p class="font-s-18"><strong><?= $lang[5] ?></strong></p>
                                    <div>
                                        <strong><?= $lang[4] ?> = </strong>
                                        <span class="fraction d-flex">
                                            <span class="num">{{ $lang[6]." ". $lang[7]}}</span> 
                                            <span class="visually-hidden"></span>
                                            <span class="den">{{ $lang[6]." ". $lang[7] }}</span>
                                        </span>× 100 
                                    </div>
                                    <div>
                                        <strong><?= $lang[4] ?> = </strong>
                                        <span class="fraction d-flex">
                                            <span class="num">{{ $first }}</span> 
                                            <span class="visually-hidden"></span>
                                            <span class="den">{{ $second }}</span>
                                        </span>× 100 
                                    </div>
                                    
                                    <p class="mt-2"><strong> <?= $lang[4] ?> = <?= round($detail['percent'], 2) ?> %</strong></p>
                                <?php } elseif ($detail['type'] == "second") { ?>
                                    <table class="w-100">
                                        <tr>
                                            <td class="border-b py-2"><strong><?= $lang[10] ?></strong></td>
                                            <td class="border-b py-2"><strong><?= $lang[11] ?></strong></td>
                                            <td class="border-b py-2"><strong><?= $lang[12] ?></strong></td>
                                        </tr>
                                        <?php
                                        foreach (($detail['s_array']) as $index => $value) {
                                        ?>
                                            <tr>
                                                <td class="border-b py-2"><?= $detail['name_array'][$index] ?></td>
                                                <td class="border-b py-2"><?= $detail['s_array'][$index] ?></td>
                                                <td class="border-b py-2"><?= $detail['a_array'][$index] ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</form>


</div>
