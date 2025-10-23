<style>
    .input-unit{
        top: 2px;
    }
</style>
<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))
 

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">


                <div class="col-span-12">
                    <p class="d-inline pe-lg-3 ps-3 text-blue"><?=$lang['1']?></p>
                    <input type="radio" name="dimen" value="3d" id="3D" class="3d" checked>
                    <label for="3D" class="ps-1 pe-3 text-blue 3d">3D <?=$lang['2']?></label>
                    <input type="radio" name="dimen" value="2d" id="2D" class="2d">
                    <label for="2D" class="ps-1 pe-3 text-blue 2d">2D <?=$lang['2']?></label>
                </div>
                <div class="col-span-12">
                    <label for="a_rep" class="font-s-14 text-blue"><?=$lang['2']?>(A) <?=$lang['3']?>:</label>
                    <div class="w-full py-2">
                        <select name="a_rep" id="a_rep" class="input">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name == $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = [$lang['17'],$lang['18']];
                                $val = ["coor","point"];
                                optionsList($val,$name,isset($_POST['a_rep'])?$_POST['a_rep'] : 'coor');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 a_coor">
                    <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                        <p class="col-span-12"><?=$lang['4']?> (a)</p>
                        <div class="col-span-4">
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="ax" id="ax" class="input" aria-label="input"  value="{{ isset($_POST['ax'])?$_POST['ax']: '3' }}" />
                                <span class="absolute" style="left: 106px;top: 1px;">$$\vec x$$</span>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="ay" id="ay" class="input" aria-label="input"  value="{{ isset($_POST['ay'])?$_POST['ay']: '4' }}" />
                                <span class="absolute" style="left: 106px;top: 1px;">$$\vec y$$</span>
                            </div>
                        </div>
                        <div class="col-span-4" id="y">
                            <div class="w-full py-2 relative">
                                <input type="number" step="any" name="az" id="az" class="input" aria-label="input"  value="{{ isset($_POST['az'])?$_POST['az']: '5' }}" />
                                <span class="absolute" style="left: 106px;top: 1px;">$$\vec z$$</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12 a_points">
                    <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12"><?=$lang['5']?> (A) </p>
                    <div class="col-span-4">
                        <div class="w-full py-2">
                            <input type="number" step="any" name="a1" id="a1" class="input" aria-label="input"  value="{{ isset($_POST['a1'])?$_POST['a1']: '3' }}" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="w-full py-2">
                            <input type="number" step="any" name="a2" id="a2" class="input" aria-label="input"  value="{{ isset($_POST['a2'])?$_POST['a2']: '4' }}" />
                        </div>
                    </div>
                    <div class="col-span-4" id="a3">
                        <div class="w-full py-2">
                            <input type="number" step="any" name="a3" id="a3" class="input" aria-label="input"  value="{{ isset($_POST['a3'])?$_POST['a3']: '5' }}" />
                        </div>
                    </div>
                    <p class="col-span-12"><?=$lang['6']?> (B) </p>
                    <div class="col-span-4">
                        <div class="w-full py-2">
                            <input type="number" step="any" name="b1" id="b1" class="input" aria-label="input"  value="{{ isset($_POST['b1'])?$_POST['b1']: '5' }}" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="w-full py-2">
                            <input type="number" step="any" name="b2" id="b2" class="input" aria-label="input"  value="{{ isset($_POST['b2'])?$_POST['b2']: '6' }}" />
                        </div>
                    </div>
                    <div class="col-span-4" id="b3">
                        <div class="w-full py-2">
                            <input type="number" step="any" name="b3" id="b3" class="input" aria-label="input"  value="{{ isset($_POST['b3'])?$_POST['b3']: '11' }}" />
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-span-12">
                    <label for="b_rep" class="font-s-14 text-blue" >{{ $lang['16'] }} (m):</label>
                    <div class="py-2">
                        <select id="b_rep" name="b_rep" class="input">
                            <?php
                            $name = ["by Coordinates","by Points"];
                            $val = ["coor","point"];
                            optionsList($val,$name,isset($_POST['b_rep'])?$_POST['b_rep'] : 'coor');
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-span-12 b_coor ">
                    <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12"><?=$lang['7']?> (b) </p>
                    <div class="col-span-4">
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="bx" id="bx" class="input" aria-label="input"  value="{{ isset($_POST['bx'])?$_POST['bx']: '3' }}" />
                            <span class="absolute" style="left: 106px;top: 1px;"">$$\vec x$$</span>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="by" id="by" class="input" aria-label="input"  value="{{ isset($_POST['by'])?$_POST['by']: '4' }}" />
                            <span class="absolute" style="left: 106px;top: 1px;"">$$\vec y$$</span>
                        </div>
                    </div>

                    <div class="col-span-4" id="y1">
                        <div class="w-full py-2 relative">
                            <input type="number" step="any" name="bz" id="bz" class="input" aria-label="input"  value="{{ isset($_POST['bz'])?$_POST['bz']: '5' }}" />
                            <span class="absolute" style="left: 106px;top: 1px;"">$$\vec z$$</span>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-span-12 b_points">
                    <div class="grid grid-cols-12   gap-2 md:gap-4 lg:gap-4">
                    <p class="col-span-12"><?=$lang['5']?> (A) </p>
                    <div class="col-span-4">
                        <div class="w-full py-2">
                            <input type="number" step="any" name="aa1" id="aa1" class="input" aria-label="input"  value="{{ isset($_POST['aa1'])?$_POST['aa1']: '3' }}" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="w-full py-2">
                            <input type="number" step="any" name="aa2" id="aa2" class="input" aria-label="input"  value="{{ isset($_POST['aa2'])?$_POST['aa2']: '4' }}" />
                        </div>
                    </div>
                    <div class="col-span-4" id="aa3">
                        <div class="w-full py-2">
                            <input type="number" step="any" name="aa3" id="aa3" class="input" aria-label="input"  value="{{ isset($_POST['aa3'])?$_POST['aa3']: '5' }}" />
                        </div>
                    </div>
                    <p class="col-span-12"><?=$lang['6']?> (B) </p>
                    <div class="col-span-4">
                        <div class="w-full py-2">
                            <input type="number" step="any" name="bb1" id="bb1" class="input" aria-label="input"  value="{{ isset($_POST['bb1'])?$_POST['bb1']: '4' }}" />
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="w-full py-2">
                            <input type="number" step="any" name="bb2" id="bb2" class="input" aria-label="input"  value="{{ isset($_POST['bb2'])?$_POST['bb2']: '9' }}" />
                        </div>
                    </div>
                    <div class="col-span-4" id="bb3">
                        <div class="w-full py-2">
                            <input type="number" step="any" name="bb3" id="bb3" class="input" aria-label="input"  value="{{ isset($_POST['bb3'])?$_POST['bb3']: '12' }}" />
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

    @else
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg mt-5 space-y-6 result">
            <div class="">
                    @if ($type == 'calculator')
                        @include('inc.copy-pdf')
                    @endif
                <div class="rounded-lg  flex items-center justify-center">
                    <div class="w-full mt-3">
                        @php
                            $dimen=request()->dimen;
                            $a_rep=request()->a_rep;
                            $ax=request()->ax;
                            $ay=request()->ay;
                            $az=request()->az;
                            $a1=request()->a1;
                            $a2=request()->a2;
                            $a3=request()->a3;
                            $b1=request()->b1;
                            $b2=request()->b2;
                            $b3=request()->b3;
                            $b_rep=request()->b_rep;
                            $bx=request()->bx;
                            $by=request()->by;
                            $bz=request()->bz;
                            $aa1=request()->aa1;
                            $aa2=request()->aa2;
                            $aa3=request()->aa3;
                            $bb1=request()->bb1;
                            $bb2=request()->bb2;
                            $bb3=request()->bb3;
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
                        <div class="col-12 text-center my-[25px]">
                            <a href="{{ url()->current() }}/" class="calculate bg-[#2845F5] shadow-2xl text-[#fff] hover:bg-[#1A1A1A] hover:text-white duration-200 font-[600] text-[16px] rounded-[44px] px-5 py-3" id="">
                                @if (app()->getLocale() == 'en')
                                    RESET
                                @else
                                    {{ $lang['reset'] ?? 'RESET' }}
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</form>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript" async
  src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML">
</script>
@push('calculatorJS')
    <script>
    $('.3d').click(function(){
      $('#y,#y1,#a3,#b3,#aa3,#bb3').css('display','flex');
    });
    $('.2d').click(function(){
      $('#y,#y1,#a3,#b3,#aa3,#bb3').css('display','none ');
    });
    var a_rep=$('#a_rep').val();
    if (a_rep=='coor') {
      $('.a_coor').css('display','flex');
      $('.a_points').css('display','none');
    }else{
      $('.a_coor').css('display','none');
      $('.a_points').css('display','flex');
    }
    $('#a_rep').change(function(){
      var a_rep=$('#a_rep').val();
      if (a_rep=='coor') {
        $('.a_coor').css('display','flex');
        $('.a_points').css('display','none');
      }else{
        $('.a_coor').css('display','none');
        $('.a_points').css('display','flex');
      }
    });
    var b_rep=$('#b_rep').val();
    if (b_rep=='coor') {
      $('.b_coor').css('display','flex');
      $('.b_points').css('display','none');
    }else{
      $('.b_coor').css('display','none');
      $('.b_points').css('display','flex');
    }
    $('#b_rep').change(function(){
      var b_rep=$('#b_rep').val();
      if (b_rep=='coor') {
        $('.b_coor').css('display','flex');
        $('.b_points').css('display','none');
      }else{
        $('.b_coor').css('display','none');
        $('.b_points').css('display','flex');
      }
    });
    </script>
@endpush