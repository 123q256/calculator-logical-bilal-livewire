<div>
 <form wire:submit.prevent="calculate">
 

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto " x-data="{
           calculation: @entangle('calculation'),
           operation: @entangle('operation'),
           vectora_rep: @entangle('vectora_representation'),
           vectorb_rep: @entangle('vectorb_representation')
       }">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">

            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="calculation" class="font-s-14 text-blue">{{ $lang['1'] }}</label>
                <div class="w-100 py-2">
                    <select wire:model.live="calculation" id="calculation" class="input">
                        <option value="2D">{{ $lang['2'] }}</option>
                        <option value="3D">{{ $lang['3'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="operation" class="font-s-14 text-blue">{{ $lang['4'] }}</label>
                <div class="w-100 py-2 relative">
                    <select class="input" wire:model.live="operation" id="operation">
                        <option value="1">{{ $lang['5'] }}</option>
                        <option value="2">{{ $lang['6'] }}</option>
                        <option value="3">{{ $lang['7'] }}</option>
                        <option value="4">{{ $lang['8'] }}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 alpha" x-show="operation == '2' || operation == '4'" style="display: none;">
                <label for="alpha" class="font-s-14 text-blue">α:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" wire:model.live="alpha" id="alpha" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6 beta" x-show="operation == '2' || operation == '4'" style="display: none;">
                <label for="beta" class="font-s-14 text-blue">β:</label>
                <div class="w-100 py-2">
                    <input type="number" step="any" wire:model.live="beta" id="beta" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12" id="stokes" x-show="calculation == '2D'" style="display: none;">
                <label for="vectora_representation" class="font-s-14 text-blue">{{ $lang['9'] }}</label>
                <div class="w-100 py-2">
                    <select class="input" wire:model.live="vectora_representation" id="vectora_representation">
                        <option value="1">{{ $lang['10'] }}</option>
                        <option value="2">{{ $lang['11'] }}</option>
                    </select>
                </div>
            </div>

            <div class="col-span-12 x_coor" x-show="calculation == '3D' || (calculation == '2D' && vectora_rep == '1')">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <p class="col-span-12 px-lg-3"><?=$lang['12']?> (a) </p>
                <div class="col-span-4">
                    <label for="ax" class="font-s-14 text-blue" >{{ $lang['13'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="ax" id="ax" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="ay" class="font-s-14 text-blue" >{{ $lang['14'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="ay" id="ay" class="input" aria-label="input" />
                    </div>
                </div>

                <div class="col-span-4 az" x-show="calculation == '3D'">
                    <label for="az" class="font-s-14 text-blue" >{{ $lang['15'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="az" id="az" class="input" aria-label="input" />
                    </div>
                </div>
               </div>
            </div>

            <div class="col-span-12 data_x" x-show="calculation == '2D' && vectora_rep == '2'" style="display: none;">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-6">
                    <label for="magnitude_x" class="font-s-14 text-blue" >{{ $lang['16'] }} (m):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="magnitude_x" id="magnitude_x" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="direction_x" class="font-s-14 text-blue" >{{ $lang['17'] }} (θ):</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" wire:model.live="direction_x" id="direction_x" class="input" aria-label="input" />
                        <label for="direction_x_unit" class="text-blue input-unit text-decoration-underline" style="position: absolute; right: 13px; top: 20px;">{{ $direction_x_unit }} ▾</label>
                        <select wire:model.live="direction_x_unit" id="direction_x_unit" class="absolute opacity-0 cursor-pointer" style="right: 13px; top: 20px; width: 50px; height: 30px;">
                            @foreach (["deg", "rad", "gon", "tr", "arcmin", "arcsec", "mrad", "μrad", "* π rad"] as $item)
                                <option value="{{$item}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                </div>
            </div>

            <div class="col-span-12" id="stokes2" x-show="calculation == '2D'" style="display: none;">
                <label for="vectorb_representation" class="font-s-14 text-blue">{{ $lang['18'] }}</label>
                <div class="w-100 py-2">
                    <select class="input" wire:model.live="vectorb_representation" id="vectorb_representation">
                        <option value="1">{{ $lang['10'] }}</option>
                        <option value="2">{{ $lang['11'] }}</option>
                    </select>
                </div>
            </div>

            <div class="col-span-12 y_coor" x-show="calculation == '3D' || (calculation == '2D' && vectorb_rep == '1')">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <p class="col-span-12 px-lg-3"><?=$lang['12']?> (2) </p>
                <div class="col-span-4">
                    <label for="bx" class="font-s-14 text-blue" >{{ $lang['13'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="bx" id="bx" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-4">
                    <label for="by" class="font-s-14 text-blue" >{{ $lang['14'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="by" id="by" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-4 bz" x-show="calculation == '3D'">
                    <label for="bz" class="font-s-14 text-blue" >{{ $lang['15'] }}:</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="bz" id="bz" class="input" aria-label="input" />
                    </div>
                </div>
            </div>
            </div>
            <div class="col-span-12 data_y" x-show="calculation == '2D' && vectorb_rep == '2'" style="display: none;">
                <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
                <div class="col-span-6">
                    <label for="magnitude_y" class="font-s-14 text-blue" >{{ $lang['16'] }} (m):</label>
                    <div class="w-100 py-2">
                        <input type="number" step="any" wire:model.live="magnitude_y" id="magnitude_y" class="input" aria-label="input" />
                    </div>
                </div>
                <div class="col-span-6">
                    <label for="direction_y" class="font-s-14 text-blue" >{{ $lang['17'] }} (θ):</label>
                    <div class="w-100 py-2 relative">
                        <input type="number" step="any" wire:model.live="direction_y" id="direction_y" class="input" aria-label="input" />
                        <label for="direction_y_unit" class="text-blue input-unit text-decoration-underline" style="position: absolute; right: 13px; top: 20px;">{{ $direction_y_unit }} ▾</label>
                        <select wire:model.live="direction_y_unit" id="direction_y_unit" class="absolute opacity-0 cursor-pointer" style="right: 13px; top: 20px; width: 50px; height: 30px;">
                            @foreach (["deg", "rad", "gon", "tr", "arcmin", "arcsec", "mrad", "μrad", "* π rad"] as $item)
                                <option value="{{$item}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
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

    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    @php
                        // Properties are directly available from Livewire
                    @endphp
                    <div class="w-full my-2">
                        @if($calculation == '3D')
                        <?php if ($operation == "1") : ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['23']}}</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue">(<?php echo $detail['x'] ?>,<?php echo $detail['y'] ?>,<?php echo $detail['z'] ?>)</strong></p>
                            </div>
                        </div>
                            <p class="mt-2"><strong><?= $lang['24'] ?></strong></p>
                            <p class="mt-2"><strong><?= $lang['25'] ?></strong> (<?php echo $ax ?>,<?php echo $ay ?>,<?php echo $az ?>) + (<?php echo $bx ?>,<?php echo $by ?>,<?php echo $bz ?>).</p>
                            <p class="mt-2">=((<?php echo $ax; ?>) + (<?php echo $bx; ?>) , (<?php echo $ay; ?>) + (<?php echo $by; ?>) , (<?php echo $az; ?>) + (<?php echo $bz; ?>))</p>
                            <p class="mt-2">=(<?php echo $detail['x'] ?> , <?php echo $detail['y'] ?> , <?php echo $detail['z'] ?>)</p>
                        <?php endif; ?>
                        <?php if ($detail['operation'] == "2") : ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['23']}}</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue">(<?php echo $detail['x'] ?>,<?php echo $detail['y'] ?>,<?php echo $detail['z'] ?>)</strong></p>
                            </div>
                        </div>
                            <p class="mt-2"><strong><?= $lang['24'] ?></strong></p>
                            <p class="mt-2"><strong><?= $lang['25'] ?></strong> (<?php echo $ax ?>,<?php echo $ay ?>,<?php echo $az ?>) + (<?php echo $bx ?>,<?php echo $by ?>,<?php echo $bz ?>) with multiples (<?php echo $alpha ?>,<?php echo $beta ?>)</p>
                            <p class="mt-2">=((<?php echo $ax; ?>*<?php echo $alpha ?>) + (<?php echo $bx; ?>*<?php echo $beta ?>) , (<?php echo $ay; ?>*<?php echo $alpha ?>) + (<?php echo $by; ?>*<?php echo $beta ?>) , (<?php echo $az; ?>*<?php echo $alpha ?>) + (<?php echo $bz; ?>*<?php echo $beta ?>))</p>
                            <p class="mt-2">=(<?php echo $detail['x'] ?> , <?php echo $detail['y'] ?> , <?php echo $detail['z'] ?>)</p>
                        <?php endif; ?>
                        <?php if ($detail['operation'] == "3") : ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['23']}}</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue">(<?php echo $detail['x'] ?>,<?php echo $detail['y'] ?>,<?php echo $detail['z'] ?>)</strong></p>
                            </div>
                        </div>
                            <p class="mt-2"><strong><?= $lang['24'] ?></strong></p>
                            <p class="mt-2"><strong><?= $lang['25'] ?></strong> (<?php echo $ax ?>,<?php echo $ay ?>,<?php echo $az ?>) - (<?php echo $bx ?>,<?php echo $by ?>,<?php echo $bz ?>).</p>
                            <p class="mt-2">=((<?php echo $ax; ?>) - (<?php echo $bx; ?>) , (<?php echo $ay; ?>) - (<?php echo $by; ?>) , (<?php echo $az; ?>) - (<?php echo $bz; ?>))</p>
                            <p class="mt-2">=(<?php echo $detail['x'] ?> , <?php echo $detail['y'] ?> , <?php echo $detail['z'] ?>)</p>
                        <?php endif; ?>
                        <?php if ($detail['operation'] == "4") : ?>
                            <div class="text-center">
                                <p class="text-[20px]"><strong>{{$lang['23']}}</strong></p>
                                <div class="flex justify-center">
                                    <p class="text-[32px] bg-[#2845F5] text-white px-3 py-2 rounded-lg d-inline-block my-3"><strong class="text-blue">(<?php echo $detail['x'] ?>,<?php echo $detail['y'] ?>,<?php echo $detail['z'] ?>)</strong></p>
                            </div>
                        </div>
                            <p class="mt-2"><strong><?= $lang['24'] ?></strong></p>
                            <p class="mt-2"><strong><?= $lang['25'] ?> $bx ?>,<?php echo $by ?>,<?php echo $bz ?>) with multiples (<?php echo $alpha ?>,<?php echo $beta ?>)</p>
                            <p class="mt-2">=((<?php echo $ax; ?>*<?php echo $alpha ?>) - (<?php echo $bx; ?>*<?php echo $beta ?>) , (<?php echo $ay; ?>*<?php echo $alpha ?>) - (<?php echo $by; ?>*<?php echo $beta ?>) , (<?php echo $az; ?>*<?php echo $alpha ?>) - (<?php echo $bz; ?>*<?php echo $beta ?>))</p>
                            <p class="mt-2">=(<?php echo $detail['x'] ?> , <?php echo $detail['y'] ?> , <?php echo $detail['z'] ?>)</p>
                        <?php endif; ?>
                        @else
                        <div class="lg:w-[80%] w-full font-s-18">
                            <table class="w-full">
                                <?php if ($detail['method'] == "1") : ?>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['19'] ?> :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['x'], 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['20'] ?> :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['y'], 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['21'] ?> :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['m'], 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['22'] ?> :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['theta'], 2) ?><span class="font-s-16"> (rad) </span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['22'] ?> :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['theta'] * 57.2958, 2) ?><span class="font-s-16"> (deg) </span></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if ($detail['method'] == "2") : ?>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['19'] ?> :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['x'], 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['20'] ?> :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['y'], 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['21'] ?> :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['m'], 2) ?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['22'] ?>  :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['theta'], 2) ?><span class="black-text font_size22"> (rad) </span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><strong><?= $lang['22'] ?>  :</strong></td>
                                        <td class="border-b py-2"><?php echo round($detail['theta'] * 57.2958, 2) ?><span class="black-text font_size22"> (deg) </span></td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
</form>
@push('calculatorJS')
    <script>
    </script>
@endpush
</div>
