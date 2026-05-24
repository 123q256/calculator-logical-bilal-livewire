<div>
<style>
    .input-unit{
        top: 2px;
    }
</style>
 <form wire:submit.prevent="calculate">

 

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">


                <div class="col-span-12">
                    <p class="d-inline pe-lg-3 ps-3 text-blue"><?=$lang['1']?></p>
                    <input type="radio" wire:model.live="dimen" name="dimen" value="3d" id="3D" class="cursor-pointer">
                    <label for="3D" class="ps-1 pe-3 text-blue cursor-pointer">3D <?=$lang['2']?></label>
                    <input type="radio" wire:model.live="dimen" name="dimen" value="2d" id="2D" class="cursor-pointer">
                    <label for="2D" class="ps-1 pe-3 text-blue cursor-pointer">2D <?=$lang['2']?></label>
                </div>
                <div class="col-span-12">
                    <label for="a_rep" class="font-s-14 text-blue"><?=$lang['2']?>(A) <?=$lang['3']?>:</label>
                    <div class="w-full py-2">
                        <select wire:model.live="a_rep" name="a_rep" id="a_rep" class="input">
                            <option value="coor">{{ $lang['17'] }}</option>
                            <option value="point">{{ $lang['18'] }}</option>
                        </select>
                    </div>
                </div>
                @if($this->showACoor())
                <div class="col-span-12" id="a_coor">
                    <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                        <p class="col-span-12"><?=$lang['4']?> (a)</p>
                        <div class="col-span-4">
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="ax" name="ax" id="ax" class="input" aria-label="input" placeholder="3" />
                                <span wire:ignore class="absolute" style="left: 106px;top: 1px;">$$\vec x$$</span>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="ay" name="ay" id="ay" class="input" aria-label="input" placeholder="4" />
                                <span wire:ignore class="absolute" style="left: 106px;top: 1px;">$$\vec y$$</span>
                            </div>
                        </div>
                        @if($this->is3D())
                        <div class="col-span-4" id="y">
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" wire:model.live="az" name="az" id="az" class="input" aria-label="input" placeholder="5" />
                                <span wire:ignore class="absolute" style="left: 106px;top: 1px;">$$\vec z$$</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                @if($this->showAPoints())
                <div class="col-span-12" id="a_points">
                    <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12"><?=$lang['5']?> (A) </p>
                    <div class="col-span-4">
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="a1" name="a1" id="a1" class="input" aria-label="input" placeholder="3" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="a2" name="a2" id="a2" class="input" aria-label="input" placeholder="4" />
                        </div>
                    </div>
                    @if($this->is3D())
                    <div class="col-span-4" id="a3">
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="a3" name="a3" id="a3" class="input" aria-label="input" placeholder="5" />
                        </div>
                    </div>
                    @endif
                    <p class="col-span-12"><?=$lang['6']?> (B) </p>
                    <div class="col-span-4">
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="b1" name="b1" id="b1" class="input" aria-label="input" placeholder="5" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="b2" name="b2" id="b2" class="input" aria-label="input" placeholder="6" />
                        </div>
                    </div>
                    @if($this->is3D())
                    <div class="col-span-4" id="b3">
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="b3" name="b3" id="b3" class="input" aria-label="input" placeholder="11" />
                        </div>
                    </div>
                    @endif
                    </div>
                </div>
                @endif
                <div class="col-span-12">
                    <label for="b_rep" class="font-s-14 text-blue" >{{ $lang['16'] }} (m):</label>
                    <div class="py-2">
                        <select wire:model.live="b_rep" id="b_rep" name="b_rep" class="input">
                            <option value="coor">by Coordinates</option>
                            <option value="point">by Points</option>
                        </select>
                    </div>
                </div>
                @if($this->showBCoor())
                <div class="col-span-12" id="b_coor">
                    <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12"><?=$lang['7']?> (b) </p>
                    <div class="col-span-4">
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="bx" name="bx" id="bx" class="input" aria-label="input" placeholder="3" />
                            <span wire:ignore class="absolute" style="left: 106px;top: 1px;">$$\vec x$$</span>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="by" name="by" id="by" class="input" aria-label="input" placeholder="4" />
                            <span wire:ignore class="absolute" style="left: 106px;top: 1px;">$$\vec y$$</span>
                        </div>
                    </div>

                    @if($this->is3D())
                    <div class="col-span-4" id="y1">
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" wire:model.live="bz" name="bz" id="bz" class="input" aria-label="input" placeholder="5" />
                            <span wire:ignore class="absolute" style="left: 106px;top: 1px;">$$\vec z$$</span>
                        </div>
                    </div>
                    @endif
                    </div>
                </div>
                @endif
                @if($this->showBPoints())
                <div class="col-span-12" id="b_points">
                    <div class="grid grid-cols-12 gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12"><?=$lang['5']?> (A) </p>
                    <div class="col-span-4">
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="aa1" name="aa1" id="aa1" class="input" aria-label="input" placeholder="3" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="aa2" name="aa2" id="aa2" class="input" aria-label="input" placeholder="4" />
                        </div>
                    </div>
                    @if($this->is3D())
                    <div class="col-span-4" id="aa3">
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="aa3" name="aa3" id="aa3" class="input" aria-label="input" placeholder="5" />
                        </div>
                    </div>
                    @endif
                    <p class="col-span-12"><?=$lang['6']?> (B) </p>
                    <div class="col-span-4">
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="bb1" name="bb1" id="bb1" class="input" aria-label="input" placeholder="4" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="bb2" name="bb2" id="bb2" class="input" aria-label="input" placeholder="9" />
                        </div>
                    </div>
                    @if($this->is3D())
                    <div class="col-span-4" id="bb3">
                        <div class="w-full py-2">
                            <input type="number" step="any" wire:model.live="bb3" name="bb3" id="bb3" class="input" aria-label="input" placeholder="12" />
                        </div>
                    </div>
                    @endif
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
    @php
        if (!function_exists('safe_round')) {
            function safe_round($val, $precision = 5) {
                if ($val === 'NAN' || $val === 'NaN' || (is_numeric($val) && is_nan((float)$val))) {
                    return 'NAN';
                }
                if ($val === 'INF' || $val === 'INF' || $val === 'infinity' || $val === 'Infinity' || (is_numeric($val) && is_infinite((float)$val))) {
                    return 'INF';
                }
                return is_numeric($val) ? round((float)$val, $precision) : $val;
            }
        }
    @endphp
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        @php
                            $dimen = $this->dimen;
                            $a_rep = $this->a_rep;
                            $ax = $this->ax;
                            $ay = $this->ay;
                            $az = $this->az;
                            $a1 = $this->a1;
                            $a2 = $this->a2;
                            $a3 = $this->a3;
                            $b1 = $this->b1;
                            $b2 = $this->b2;
                            $b3 = $this->b3;
                            $b_rep = $this->b_rep;
                            $bx = $this->bx;
                            $by = $this->by;
                            $bz = $this->bz;
                            $aa1 = $this->aa1;
                            $aa2 = $this->aa2;
                            $aa3 = $this->aa3;
                            $bb1 = $this->bb1;
                            $bb2 = $this->bb2;
                            $bb3 = $this->bb3;
                            $i= isset($detail['i']) ? $detail['i'] : '';
                            $j= isset($detail['j']) ? $detail['j'] : '';
                            $k= isset($detail['k']) ? $detail['k'] : '';
                            $ax2=  isset($detail['ax2']) ? $detail['ax2'] : '';
                            $ay2=  isset($detail['ay2']) ? $detail['ay2'] : '';
                            $az2=  isset($detail['az2']) ? $detail['az2'] : '';
                            $bx2=  isset($detail['bx2']) ? $detail['bx2'] : '';
                            $by2=  isset($detail['by2']) ? $detail['by2'] : '';
                            $bz2=  isset($detail['bz2']) ? $detail['bz2'] : '';
                            $aax=  isset($detail['ax']) ? $detail['ax'] : '';
                            $aay=  isset($detail['ay']) ? $detail['ay'] : '';
                            $aaz=  isset($detail['az']) ? $detail['az'] : '';
                            $bbx=  isset($detail['bx']) ? $detail['bx'] : '';
                            $bby=  isset($detail['by']) ? $detail['by'] : '';
                            $bbz=  isset($detail['bz']) ? $detail['bz'] : '';
                            $mgntd=  isset($detail['mgntd']) ? $detail['mgntd'] : '';
                            $mgntd_a=  isset($detail['mgntd_a']) ? $detail['mgntd_a'] : '';
                            $mgntd_b=  isset($detail['mgntd_b']) ? $detail['mgntd_b'] : '';
                            $prod=  isset($detail['prod']) ? $detail['prod'] : '';
                            $angle=  isset($detail['angle']) ? $detail['angle'] : '';
                            $deg=  isset($detail['deg']) ? $detail['deg'] : '';
                        @endphp
                        <div class="w-full my-2">
                            <div class="w-full md:w-[80%] lg:w-[80%]  text-[18px]">
                                <table class="w-full">
                                    <tr>
                                        <td class="border-b py-2"><b ><?=$lang['8']?> :</b></td>
                                        <td class="border-b py-2"><?=$detail['deg']?> <span class="font-s-16">deg</span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="pt-2"><strong><?=$lang['9']?></strong></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><?=$lang['10']?></td>
                                        <td class="border-b py-2"><?=$detail['prod']?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><?=$lang['11']?> A => |A|</td>
                                        <td class="border-b py-2"><?=$detail['mgntd_a']?></td>
                                    </tr>
                                    <tr>
                                        <td class="border-b py-2"><?=$lang['11']?> B => |B|</td>
                                        <td class="border-b py-2"><?=$detail['mgntd_b']?></td>
                                    </tr>
                                </table>
                            </div>
                            <?php if($dimen=='3d'){
                                if($a_rep=='coor' && $b_rep=='point'){
                                ?>
                                <p class="mt-2"><b><?=$lang['13']?>:</b></p>
                                <p class="mt-2">\( \vec C \cdot \vec D  = Cx - Dx * Dy - Cy * Dz - Cz \)</p>
                                <p class="mt-2">\( \vec C \cdot \vec D  = (<?=$bb1?>-<?=$aa1?>)*(<?=$bb2?>-<?=$aa2?>)*(<?=$bb3?>-<?=$aa3?>) \)</p>
                                <p class="mt-2">\( \vec C \cdot \vec D  = (<?=$bbx?>;<?=$bby?>;<?=$bbz?>) \)</p>
                                <p class="mt-2"><b><?=$lang['14']?> A <?=$lang['15']?> B = (CD):</b></p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = Ax * Bx + Ay * By + Az * Bz \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$ax?>*<?=$bbx?>)+(<?=$ay?>*<?=$bby?>)+(<?=$az?>*<?=$bbz?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$i?>)+(<?=$j?>)+(<?=$k?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = <?=$prod?> \)</p>
                              <?php }elseif($a_rep=='point' && $b_rep=='coor'){ ?>
                                <p class="mt-2"><b><?=$lang['13']?>:</b></p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = Bx - Ax * By - Ay * Bz - Az \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$b1?>-<?=$a1?>)*(<?=$b2?>-<?=$a2?>)*(<?=$b3?>-<?=$a3?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$aax?>;<?=$aay?>;<?=$aaz?>) \)</p>
                                <p class="mt-2"><b><?=$lang['14']?> A = (AB) <?=$lang['15']?> B:</b></p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = Ax * Bx + Ay * By + Az * Bz \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$aax?>*<?=$bx?>)+(<?=$aay?>*<?=$by?>)+(<?=$aaz?>*<?=$bz?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$i?>)+(<?=$j?>)+(<?=$k?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = <?=$prod?> \)</p>
                              <?php }elseif($a_rep=='point' && $b_rep=='point'){ ?>
                                <p class="mt-2"><b><?=$lang['13']?>:</b></p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = Bx - Ax * By - Ay * Bz - Az \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$b1?>-<?=$a1?>)*(<?=$b2?>-<?=$a2?>)*(<?=$b3?>-<?=$a3?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$aax?>;<?=$aay?>;<?=$aaz?>) \)</p>
                                <p>&nbsp;</p>
                                <p class="mt-2">\( \vec C \cdot \vec D  = Cx - Dx * Dy - Cy * Dz - Cz \)</p>
                                <p class="mt-2">\( \vec C \cdot \vec D  = (<?=$bb1?>-<?=$aa1?>)*(<?=$bb2?>-<?=$aa2?>)*(<?=$bb3?>-<?=$aa3?>) \)</p>
                                <p class="mt-2">\( \vec C \cdot \vec D  = (<?=$bbx?>;<?=$bby?>;<?=$bbz?>) \)</p>
                                <p class="mt-2"><b><?=$lang['14']?> A = (AB) <?=$lang['15']?> B = (CD):</b></p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = Ax * Bx + Ay * By + Az * Bz \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$aax?>*<?=$bbx?>)+(<?=$aay?>*<?=$bby?>)+(<?=$aaz?>*<?=$bbz?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$i?>)+(<?=$j?>)+(<?=$k?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = <?=$prod?> \)</p>
                              <?php }else{ ?>
                                <p class="mt-2"><b><?=$lang['14']?> A <?=$lang['15']?> B:</b></p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = Ax * Bx + Ay * By + Az * Bz \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$ax?>*<?=$bx?>)+(<?=$ay?>*<?=$by?>)+(<?=$az?>*<?=$bz?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$i?>)+(<?=$j?>)+(<?=$k?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = <?=$prod?> \)</p>
                              <?php } ?>
                                <p class="mt-2"><b><?=$lang['11']?> A:</b></p>
                                <p class="mt-2">\( |A|  = \sqrt {Ax^2 + Ay^2 + Az^2} \)</p>
                                <p class="mt-2">\( |A|  = \sqrt {(<?=$ax?>)^2 + (<?=$ay?>)^2 + (<?=$az?>)^2} \)</p>
                                <p class="mt-2">\( |A|  = \sqrt {<?=$ax2?> + <?=$ay2?> + <?=$az2?>} \)</p>
                                <p class="mt-2">\( |A|  = <?=$mgntd_a?> \)</p>
                                <p class="mt-2"><b><?=$lang['11']?> B:</b></p>
                                <p class="mt-2">\( |B|  = \sqrt {Bx^2 + By^2 + Bz^2} \)</p>
                                <p class="mt-2">\( |B|  = \sqrt {(<?=$bx?>)^2 + (<?=$by?>)^2 + (<?=$bz?>)^2} \)</p>
                                <p class="mt-2">\( |B|  = \sqrt {<?=$bx2?> + <?=$by2?> + <?=$bz2?>} \)</p>
                                <p class="mt-2">\( |B|  = <?=$mgntd_b?> \)</p>
                                <p class="mt-2"><b><?=$lang['16']?> A <?=$lang['15']?> B:</b></p>
                                <p class="mt-2">\( cos\theta  = (\vec A \cdot \vec B) / (|A||B|) \)</p>
                                <p class="mt-2">\( cos\theta  = (<?=$prod?>) / (<?=$mgntd_a?>*<?=$mgntd_b?>) \)</p>
                                <p class="mt-2">\( cos\theta  = (<?=$prod?>) / (<?=$mgntd?>) \)</p>
                                <p class="mt-2">\( cos\theta  = <?=$angle?> \)</p>
                                <p class="mt-2">\( \theta  = <?=$deg?> \text{ deg} \)</p>
                              <?php
                            }else{
                                if($a_rep=='coor' && $b_rep=='point'){
                            ?>
                                <p class="mt-2"><b><?=$lang['13']?>:</b></p>
                                <p class="mt-2">\( \vec C \cdot \vec D  = Cx - Dx * Dy - Cy \)</p>
                                <p class="mt-2">\( \vec C \cdot \vec D  = (<?=$bb1?>-<?=$aa1?>)*(<?=$bb2?>-<?=$aa2?>) \)</p>
                                <p class="mt-2">\( \vec C \cdot \vec D  = (<?=$bbx?>;<?=$bby?>) \)</p>
                                <p class="mt-2"><b><?=$lang['14']?> A <?=$lang['15']?> B = (CD):</b></p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = Ax * Bx + Ay * By \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$ax?>*<?=$bbx?>)+(<?=$ay?>*<?=$bby?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$i?>)+(<?=$j?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = <?=$prod?> \)</p>
                            <?php }elseif($a_rep=='point' && $b_rep=='coor'){ ?>
                                <p class="mt-2"><b><?=$lang['13']?>:</b></p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = Bx - Ax * By - Ay \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$b1?>-<?=$a1?>)*(<?=$b2?>-<?=$a2?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$aax?>;<?=$aay?>) \)</p>
                                <p class="mt-2"><b><?=$lang['14']?> A = (AB) <?=$lang['15']?> B:</b></p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = Ax * Bx + Ay * By \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$aax?>*<?=$bx?>)+(<?=$aay?>*<?=$by?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$i?>)+(<?=$j?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = <?=$prod?> \)</p>
                            <?php }elseif($a_rep=='point' && $b_rep=='point'){ ?>
                                <p class="mt-2"><b><?=$lang['13']?>:</b></p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = Bx - Ax * By - Ay \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$b1?>-<?=$a1?>)*(<?=$b2?>-<?=$a2?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$aax?>;<?=$aay?>) \)</p>
                                <p>&nbsp;</p>
                                <p class="mt-2">\( \vec C \cdot \vec D  = Cx - Dx * Dy - Cy * Dz - Cz \)</p>
                                <p class="mt-2">\( \vec C \cdot \vec D  = (<?=$bb1?>-<?=$aa1?>)*(<?=$bb2?>-<?=$aa2?>) \)</p>
                                <p class="mt-2">\( \vec C \cdot \vec D  = (<?=$bbx?>;<?=$bby?>) \)</p>
                                <p class="mt-2"><b><?=$lang['14']?> A = (AB) <?=$lang['15']?> B = (CD):</b></p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = Ax * Bx + Ay * By \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$aax?>*<?=$bbx?>)+(<?=$aay?>*<?=$bby?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$i?>)+(<?=$j?>)+(<?=$k?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = <?=$prod?> \)</p>
                            <?php }else{ ?>
                                <p class="mt-2"><b><?=$lang['14']?> A <?=$lang['15']?> B:</b></p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = Ax * Bx + Ay * By \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$ax?>*<?=$bx?>)+(<?=$ay?>*<?=$by?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = (<?=$i?>)+(<?=$j?>) \)</p>
                                <p class="mt-2">\( \vec A \cdot \vec B  = <?=$prod?> \)</p>
                            <?php } ?>
                                <p class="mt-2"><b><?=$lang['11']?> A:</b></p>
                                <p class="mt-2">\( |A|  = \sqrt {Ax^2 + Ay^2} \)</p>
                                <p class="mt-2">\( |A|  = \sqrt {<?=$ax?>^2 + <?=$ay?>^2} \)</p>
                                <p class="mt-2">\( |A|  = \sqrt {<?=$ax2?> + <?=$ay2?>} \)</p>
                                <p class="mt-2">\( |A|  = <?=$mgntd_a?> \)</p>
                                <p class="mt-2"><b><?=$lang['11']?> B:</b></p>
                                <p class="mt-2">\( |B|  = \sqrt {Bx^2 + By^2} \)</p>
                                <p class="mt-2">\( |A|  = \sqrt {<?=$bx?>^2 + <?=$by?>^2} \)</p>
                                <p class="mt-2">\( |B|  = \sqrt {<?=$bx2?> + <?=$by2?>} \)</p>
                                <p class="mt-2">\( |B|  = <?=$mgntd_b?> \)</p>
                                <p class="mt-2"><b><?=$lang['16']?> A <?=$lang['15']?> B:</b></p>
                                <p class="mt-2">\( cos\theta  = (\vec A \cdot \vec B) / (|A||B|) \)</p>
                                <p class="mt-2">\( cos\theta  = (<?=$prod?>) / (<?=$mgntd_a?>*<?=$mgntd_b?>) \)</p>
                                <p class="mt-2">\( cos\theta  = (<?=$prod?>) / (<?=$mgntd?>) \)</p>
                                <p class="mt-2">\( cos\theta  = <?=$angle?> \)</p>
                                <p class="mt-2">\( \theta  = <?=$deg?> \text{ deg} \)</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</form>

@push('calculatorJS')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.css">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/katex.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.16.8/dist/contrib/auto-render.min.js" onload="renderMathInElement(document.body);"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('math-updated', (event) => {
            setTimeout(() => {
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body);
                }
            }, 100);
        });

        // Initial render
        if (typeof renderMathInElement === 'function') {
            renderMathInElement(document.body);
        }
    });
</script>
@endpush
</div>
