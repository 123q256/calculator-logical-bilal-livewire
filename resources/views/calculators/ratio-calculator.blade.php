<form class="row" action="{{ url()->current() }}/" method="POST">
    @csrf
    @if(!isset($detail))
 
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
            <div class="grid grid-cols-12  gap-2 md:gap-4 lg:gap-4">

                <div class="col-span-12 md:col-span-8 lg:col-span-8 {{ isset($_POST['ratio_of']) && $_POST['ratio_of'] == 'r2' ? '' : 'hidden' }}" id="method">
                    <label for="meth" class="label">{{ $lang['1'] }}:</label>
                    <div class="w-full py-2 position-relative">
                        <select class="input" id="meth" name="method">
                            @php
                                function optionsList($arr1,$arr2,$unit){
                                foreach($arr1 as $index => $name){
                            @endphp
                                <option value="{{ $name }}" {{ (isset($unit) && $name === $unit) ? " selected" : "" }}>
                                    {{ $arr2[$index] }}
                                </option>
                            @php
                                }}
                                $name = [$lang['2'],$lang['3'],$lang['4'],$lang['5'],$lang['6'],$lang['7']];
                                $val = ["0","1","2","3","4","5"];
                                optionsList($val,$name,isset($_POST['method'])?$_POST['method']:'0');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-8 lg:col-span-8 {{ isset($_POST['ratio_of']) && $_POST['ratio_of'] == 'r3' ? '' : 'hidden' }}" id="method1">
                    <label for="metho" class="label">{{ $lang['1'] }} :</label>
                    <div class="w-full py-2 position-relative">
                        <select class="input" id="metho" name="method1">
                            @php
                                $name = [$lang['2'],$lang['3'],$lang['4'],$lang['5'],$lang['8'],$lang['9'],$lang['10']];
								$val = ["0","1","2","3","4","5","6"];
                                optionsList($val,$name,isset($_POST['method1'])?$_POST['method1']:'0');
                            @endphp
                        </select>
                    </div>
                </div>
                <div class="col-span-12 md:col-span-4 lg:col-span-4 text-center flex items-center justify-end">
                    <input type="radio" name="ratio_of" id="r2" value="r2" checked {{ isset($_POST['ratio_of']) && $_POST['ratio_of'] === 'r2' ? 'checked' : '' }}>
                    <label for="r2" class="label pe-lg-3 pe-2">A:B </label>
                    <input type="radio" name="ratio_of" id="r3" value="r3" {{ isset($_POST['ratio_of']) && $_POST['ratio_of'] === 'r3' ? 'checked' : '' }}>
                    <label for="r3" class="label">A:B:C</label>
                </div>
                <div  id="txt1" class="txt_set my-2 col-span-12 {{ isset($_POST['ratio_of']) && $_POST['ratio_of'] == 'r2' ? '' : 'hidden' }}"><?=$lang['12']?></div>
                <div  id="txt2" class="txt_set my-2 col-span-12 {{ isset($_POST['ratio_of']) && $_POST['ratio_of'] == 'r3' ? '' : 'hidden' }}"><?=$lang['13']?></div>
                <div class="col-span-12 items-center mt-2">
                    <div class="grid grid-cols-12 gap-3">
                        <div class="col-span-2 p_set" id="a">
                            <p class="text-center"><strong>A</strong></p>
                            <input type="number" class="input" value="{{ isset($_POST['a']) ? $_POST['a'] : ''}}" name="a">
                        </div>
                        <div class="col-span-1 text-center mt-3 flex items-center" id="dot1">
                            <div class="eq_set">:</div>
                        </div>
                        <div class="col-span-2 p_set" id="b">
                            <p class="text-center"><strong>B</strong></p>
                            <input type="number" class="input" value="{{ isset($_POST['b']) ? $_POST['b'] : ''}}" name="b">
                        </div>
                        <div class="col-span-1 text-center mt-3 flex items-center" id="dot2">
                            <div class="eq_set">:</div>
                        </div>
                        <div class="col-span-2" id="c1">
                            <p class="text-center"><strong>C</strong></p>
                            <input type="number" class="input" value="{{ isset($_POST['c1']) ? $_POST['c1'] : ''}}" name="c1">
                        </div>
                        <div class="col-span-1 text-center mt-3 flex items-center" id="eq">
                            <div class="eq_set">=</div>
                        </div>
                        <div class="col-span-2 p_set" id="c">
                            <p class="text-center"><strong>C</strong></p>
                            <input type="number" class="input" value="{{ isset($_POST['c']) ? $_POST['c'] : ''}}" name="c">
                        </div>
                        <div class="col-span-1 text-center mt-3 flex items-center" id="dot3">
                            <div class="eq_set">:</div>
                        </div>
                        <div class="col-span-2 p_set" id="d">
                            <p class="text-center"><strong>D</strong></p>
                            <input type="number" class="input" value="<?=isset($_POST['d'])?$_POST['d']:''?>" name="d">
                        </div>
                        <div class="col-span-1 text-center mt-3 flex items-center" id="dot4">
                            <div class="eq_set">:</div>
                        </div>
                        <div class="col-span-2 p_set" id="e">
                            <p class="text-center"><strong>E</strong></p>
                            <input type="number" class="input" value="<?=isset($_POST['e'])?$_POST['e']:''?>" name="e">
                        </div>
                        <div class="col-span-1 text-center mt-3 flex items-center" id="dot5">
                            <div class="eq_set">:</div>
                        </div>
                        <div class="col-span-2 p_set" id="f">
                            <p class="text-center"><strong>F</strong></p>
                            <input type="number" class="input" value="<?=isset($_POST['f'])?$_POST['f']:''?>" name="f">
                        </div>
                        <div class="col-span-6 p_set ps-lg-2" id="i">
                            <p class="text-center font-s-14"><strong><?=$lang['14']?></strong></p>
                            <input type="number" class="input" step="any" value="<?=isset($_POST['i'])?$_POST['i']:2?>" name="i">
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
                            $method = request()->method;
                            $method1 = request()->method1;
                            $ratio_of = request()->ratio_of;
                            $a = request()->a;
                            $b = request()->b;
                            $c = request()->c;
                            $c1 = request()->c1;
                            $d = request()->d;
                            $f = request()->f;
                            $e = request()->e;
                            $h = request()->h;
                            $r2=isset($detail['r2']) ? $detail['r2'] : '';
                                $r3=isset($detail['r3']) ? $detail['r3'] : '';
                            $a_val=isset($detail['a_val']) ? $detail['a_val'] : '';
                            $a_val1=isset($detail['a_val1']) ? $detail['a_val1'] : '';
                            $a_val2=isset($detail['a_val2']) ? $detail['a_val2'] : '';
                            $a_val3=isset($detail['a_val3']) ? $detail['a_val3'] : '';
                            $a_val4=isset($detail['a_val4']) ? $detail['a_val4'] : '';
                            $a_val5=isset($detail['a_val5']) ? $detail['a_val5'] : '';
                            $a_val6=isset($detail['a_val6']) ? $detail['a_val6'] : '';
                            $b_val=isset($detail['b_val']) ? $detail['b_val'] : '';
                            $b_val1=isset($detail['b_val1']) ? $detail['b_val1'] : '';
                            $b_val2=isset($detail['b_val2']) ? $detail['b_val2'] : '';
                            $b_val3=isset($detail['b_val3']) ? $detail['b_val3'] : '';
                            $b_val4=isset($detail['b_val4']) ? $detail['b_val4'] : '';
                            $b_val5=isset($detail['b_val5']) ? $detail['b_val5'] : '';
                            $b_val6=isset($detail['b_val6']) ? $detail['b_val6'] : '';
                            $c_val=isset($detail['c_val']) ? $detail['c_val'] : '';
                            $c_val1=isset($detail['c_val1']) ? $detail['c_val1'] : '';
                            $c_val2=isset($detail['c_val2']) ? $detail['c_val2'] : '';
                            $c_val3=isset($detail['c_val3']) ? $detail['c_val3'] : '';
                            $c_val4=isset($detail['c_val4']) ? $detail['c_val4'] : '';
                            $c_val5=isset($detail['c_val5']) ? $detail['c_val5'] : '';
                            $c_val6=isset($detail['c_val6']) ? $detail['c_val6'] : '';
                            $d_val=isset($detail['d_val']) ? $detail['d_val'] : '';
                            $e_val=isset($detail['e_val']) ? $detail['e_val'] : '';
                            $f_val=isset($detail['f_val']) ? $detail['f_val'] : '';
            
                            if(isset($detail['a_val'])){
                                $w2=$a_val;
                                $w1=$a_val+$b;
                            }elseif(isset($detail['b_val'])){
                                $w2=$a;
                                $w1=$a+$b_val;
                            }else{
                                $w2=$a;
                                $w1=$a+$b;
                            }
                            if($w1>$w2){
                                $w=($w2/$w1)*100;
                            }else{
                                $w=$w2/$w1;
                            }
                            if(isset($detail['a_val'])){
                                if($a_val>$b){
                                    $h=$b/$a_val;
                                    $h=$h*150;
                                    $h=round($h);
                                }else{
                                    $h=$a_val/$b;
                                    $h=$h*150;
                                    $h=round($h);
                                }
                            }elseif(isset($detail['b_val'])){
                                if($a>$b_val){
                                    $h=$b_val/$a;
                                    $h=$h*150;
                                    $h=round($h);
                                }else{
                                    $h=$a/$b_val;
                                    $h=$h*150;
                                    $h=round($h);
                                }
                            }else{
                                if($a>$b){
                                    $h=$b/$a;
                                    $h=$h*150;
                                    $h=round($h);
                                }else{
                                    $h=$a/$b;
                                    $h=$h*150;
                                    $h=round($h);
                                }
                            }
                        @endphp
                        <div class="row my-2 text-[18px] text-center">
                            <?php if($method =='0' && $ratio_of =='r2'){ ?>
                                <?php if(isset($detail['a_val'])){ ?>
                                    <p class="text-[20px]"><b><?=$lang['15']?></b></p>
                                    <p class="text-[25px] text-blue-500" id="res"><b><?='<span class="text-accent-4 orange-text">'.$a_val.'</span> : '.$b.' = '.$c.' : '.$d?></b></p>
                                    <div class="col s12 margin_top_10">
                                        <?php if(gettype($a_val)==='double'){ ?>
                                        <p class="text-[20px]"><b><?=$lang['16']?>:</b></p>
                                        <p class="text-[25px] text-blue-500"><b><?=$a_val.' : '.$b.' = '.$c.' : '.$d?></b></p>
                                        <?php } ?>
                                    </div>
                                <?php }elseif(isset($detail['b_val'])){ ?>
                                    <p class="text-[20px]"><b><?=$lang['15']?></b></p>
                                    <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : <span class="text-accent-4 orange-text">'.round($b_val,3).'</span> = '.$c.' : '.$d?></b></p>
                                    <div class="col s12 margin_top_10">
                                        <?php if(gettype($b_val)==='double'){ ?>
                                        <p class="text-[20px]"><b><?=$lang['16']?>:</b></p>
                                        <p class="text-[25px] text-blue-500"><b><?=$a.' : '.round($b_val).' = '.$c.' : '.$d?></b></p>
                                        <?php } ?>
                                    </div>
                                <?php }elseif(isset($detail['c_val'])){ ?>
                                    <p class="text-[20px]"><b><?=$lang['15']?></b></p>
                                    <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' = <span class="text-accent-4 orange-text">'.round($c_val,3).'</span> : '.$d?></b></p>
                                    <div class="col s12 margin_top_10">
                                        <?php if(gettype($c_val)==='double'){ ?>
                                        <p class="text-[20px]"><b><?=$lang['16']?>:</b></p>
                                        <p class="text-[25px] text-blue-500"><b><?=$a.' : '.$b.' = '.round($c_val).' : '.$d?></b></p>
                                        <?php } ?>
                                    </div>
                                <?php }elseif(isset($detail['d_val'])){ ?>
                                    <p class="text-[20px]"><b><?=$lang['15']?></b></p>
                                    <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' = '.$c.' : <span class="text-accent-4 orange-text">'.round($d_val,3).'</span>'?></b></p>
                                    <div class="col s12 margin_top_10">
                                        <?php if(gettype($d_val)==='double'){ ?>
                                        <p class="text-[20px]"><b><?=$lang['16']?>:</b></p>
                                        <p class="text-[25px] text-blue-500"><b><?=$a.' : '.$b.' = '.$c.' : '.round($d_val)?></b></p>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            <?php }elseif($method =='1' && $ratio_of =='r2'){ ?>
                                <p class="text-[20px]"><b><?=$lang['15']?></b></p>
                                <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' = <span class="text-accent-4 orange-text"> '.round($a_val1,3).' : '.round($b_val1,3).'</span>'?></b></p>
                                <div class="col s12 margin_top_10">
                                    <?php if(gettype($detail['a_val1'])==='double' || gettype($b_val1)==='double'){ ?>
                                    <p class="text-[20px]"><b><?=$lang['16']?>:</b></p>
                                    <p class="text-[25px] text-blue-500"><b><?=$a.' : '.$b.' = '.round($a_val1).' : '.round($b_val1)?></b></p>
                                    <?php } ?>
                                </div>
                            <?php }elseif($method =='2' && $ratio_of =='r2'){ ?>
                                <p class="text-[20px]"><b><?=$lang['15']?></b></p>
                                <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' = <span class="text-accent-4 orange-text"> '.round($a_val2,3).' : '.round($b_val2,3).'</span>'?></b></p>
                                <div class="col s12 margin_top_10">
                                    <?php if(gettype($detail['a_val2'])==='double' || gettype($b_val2)==='double'){ ?>
                                    <p class="text-[20px]"><b><?=$lang['16']?>:</b></p>
                                    <p class="text-[25px] text-blue-500"><b><?=$a.' : '.$b.' = '.round($a_val2).' : '.round($b_val2)?></b></p>
                                    <?php } ?>
                                </div>
                            <?php }elseif($method =='3' && $ratio_of =='r2'){ ?>
                                <p class="text-[20px]"><b><?=$lang['15']?></b></p>
                                <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' = <span class="text-accent-4 orange-text"> '.$a_val3.' : '.$b_val3.'</span>'?></b></p>
                                <div class="col s12 margin_top_10">
                                    <?php if(gettype($detail['a_val3'])==='double' || gettype($b_val3)==='double'){ ?>
                                    <p class="text-[20px]"><b><?=$lang['16']?>:</b></p>
                                    <p class="text-[25px] text-blue-500"><b><?=$a.' : '.$b.' = '.round($a_val3).' : '.round($b_val3)?></b></p>
                                    <?php } ?>
                                </div>
                                <?php if(isset($detail['gcf'])){ ?>
                                    <p class="col s12 font_s20 margin_top_15 center"><strong><?=$lang['17']?> <a href="<?=$lang['18']?>" target="_blank" rel="noopener"><?=$lang['19']?></a> <?=$lang['20']?></strong></p>
                                <?php }else{ ?>
                                    <p class="col s12 font_s20 margin_top_15 center"><strong><?=$lang['21']?> <a href="<?=$lang['18']?>" target="_blank" rel="noopener"><?=$lang['19']?></a> <?=$lang['22']?></strong></p>
                                <?php } ?>
                            <?php }elseif($method =='4' && $ratio_of =='r2'){ ?>
                                <p class="text-[20px]"><b><?=$lang['15']?></b></p>
                                <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' = <span class="text-accent-4 orange-text"> '.round($a_val4,3).' : '.round($b_val4,3).'</span>'?></b></p>
                                <div class="col s12 margin_top_10">
                                    <?php if(gettype($$detail['a_val4'])==='double' || gettype($b_val4)==='double'){ ?>
                                    <p class="text-[20px]"><b><?=$lang['16']?>:</b></p>
                                    <p class="text-[25px] text-blue-500"><b><?=$a.' : '.$b.' = '.round($a_val4).' : '.round($b_val4)?></b></p>
                                    <?php } ?>
                                </div>
                            <?php }elseif($method =='5' && $ratio_of =='r2'){ ?>
                                <p class="text-[20px]"><b><?=$lang['15']?></b></p>
                                <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' = <span class="text-accent-4 orange-text"> '.round($a_val5,3).' : '.round($b_val5,3).'</span>'?></b></p>
                                <div class="col s12 margin_top_10">
                                    <?php if(gettype($detail['a_val6'])==='double' || gettype($b_val5)==='double'){ ?>
                                    <p class="text-[20px]"><b><?=$lang['16']?>:</b></p>
                                    <p class="text-[25px] text-blue-500"><b><?=$a.' : '.$b.' = '.round($a_val5).' : '.round($b_val5)?></b></p>
                                    <?php } ?>
                                </div>
                            <?php }elseif($method1 =='0' && $ratio_of =='r3'){ ?>
                                    <p class="text-[20px]"><b><?=$lang['15']?></b></p>
                                    <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' : '.$c1.' = '.$d.' : <span class="text-accent-4 orange-text">'.round($e_val,3).' : '.round($f_val,3).'</span>'?><br></b></p>
                                    <div class="col s12 margin_top_10">
                                        <?php if(isset($detail['dbl'])){ ?>
                                        <p class="text-[20px]"><b><?=$lang['16']?>:</b></p>
                                        <p class="text-[25px] text-blue-500"><b><?=$a.' : '.$b.' : '.$c1.' = '.$d.' : '.round($e_val).' : '.round($f_val)?></b></p>
                                        <?php } ?>
                                    </div>
                            <?php }elseif($method1 =='1' && $ratio_of =='r3'){ ?>
                                    <p class="text-[20px]"><b><?=$lang['15']?></b></p>
                                    <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' : '.$c1.' = <span class="text-accent-4 orange-text"> '.round($a_val1,3).' : '.round($b_val1,3).' : '.round($c_val1,3).'</span>'?><br></b></p>
                                    <div class="col s12 margin_top_10">
                                        <?php if(isset($detail['dbl'])){ ?>
                                            <p class="text-[20px]"><b><?=$lang['16']?>:</b></p>
                                            <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' : '.$c1.' = '.round($a_val1).' : '.round($b_val1).' : '.round($c_val1)?><br></b></p>
                                        <?php } ?>
                                    </div>
                            <?php }elseif($method1 =='2' && $ratio_of =='r3'){ ?>
                                    <p class="text-[20px]"><b><?=$lang['15']?></b></p>
                                    <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' : '.$c1.' = <span class="text-accent-4 orange-text"> '.round($a_val2,3).' : '.round($b_val2,3).' : '.round($c_val2,3).'</span>'?><br></b></p>
                                    <div class="col s12 margin_top_10">
                                        <?php if(isset($detail['dbl'])){ ?>
                                            <p class="text-[20px]"><b><?=$lang['16']?>:</b></p>
                                            <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' : '.$c1.' = '.round($a_val2).' : '.round($b_val2).' : '.round($c_val2)?><br></b></p>
                                        <?php } ?>
                                    </div>
                            <?php }elseif($method1 =='3' && $ratio_of =='r3'){ ?>
                                    <p class="text-[20px]"><b><?=$lang['15']?></b></p>
                                    <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' : '.$c1.' = <span class="text-accent-4 orange-text"> '.round($a_val3,3).' : '.round($b_val3,3).' : '.round($c_val3,3).'</span>'?><br></b></p>
                                    <div class="col s12 margin_top_10">
                                        <?php if(isset($detail['dbl'])){ ?>
                                            <p class="text-[20px]"><b><?=$lang['16']?>:</b></p>
                                            <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' : '.$c1.' = '.round($a_val3).' : '.round($b_val3).' : '.round($c_val3)?><br></b></p>
                                        <?php } ?>
                                    </div>
                                    <?php if(isset($detail['gcf'])){ ?>
                                        <p class="col s12 font_s20 margin_top_15 center"><strong><?=$lang['17']?> <a href="<?=$lang['18']?>" target="_blank" rel="noopener"><?=$lang['19']?></a> <?=$lang['20']?></strong></p>
                                    <?php }else{ ?>
                                    <p class="col s12 font_s20 margin_top_15 center"><strong><?=$lang['21']?> <a href="<?=$lang['18']?>" target="_blank" rel="noopener"><?=$lang['19']?></a> <?=$lang['22']?></strong></p>
                                    <?php } ?>
                            <?php }elseif($method1 =='4' && $ratio_of =='r3'){ ?>
                                    <p class="text-[20px]"><b><?=$lang['15']?></b></p>
                                    <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' : '.$c1.' = <span class="text-accent-4 orange-text"> '.round($a_val4,3).' : '.round($b_val4,3).' : '.round($c_val4,3).'</span>'?><br></b></p>
                                    <div class="col s12 margin_top_10">
                                        <?php if(isset($detail['dbl'])){ ?>
                                            <p class="text-[20px]"><b><?=$lang['16']?>:</b></p>
                                            <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' : '.$c1.' = '.round($a_val4).' : '.round($b_val4).' : '.round($c_val4)?><br></b></p>
                                        <?php } ?>
                                    </div>
                            <?php }elseif($method1 =='5' && $ratio_of =='r3'){ ?>
                                    <p class="text-[20px]"><b><?=$lang['15']?></b></p>
                                    <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' : '.$c1.' = <span class="text-accent-4 orange-text"> '.round($a_val5,3).' : '.round($b_val5,3).' : '.round($c_val5,3).'</span>'?><br></b></p>
                                    <div class="col s12 margin_top_10">
                                        <?php if(isset($detail['dbl'])){ ?>
                                            <p class="text-[20px]"><b><?=$lang['16']?>:</b></p>
                                            <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' : '.$c1.' = '.round($a_val5).' : '.round($b_val5).' : '.round($c_val5)?><br></b></p>
                                        <?php } ?>
                                    </div>
                            <?php }elseif($method1 =='6' && $ratio_of =='r3'){ ?>
                                    <p class="text-[20px]"><b><?=$lang['15']?></b></p>
                                    <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' : '.$c1.' = <span class="text-accent-4 orange-text"> '.round($a_val6,3).' : '.round($b_val6,3).' : '.round($c_val6,3).'</span>'?><br></b></p>
                                    <div class="col s12 margin_top_10">
                                        <?php if(isset($detail['dbl'])){ ?>
                                            <p class="text-[20px]"><b><?=$lang['16']?>:</b></p>
                                            <p class="text-[25px] text-blue-500" id="res"><b><?=$a.' : '.$b.' : '.$c1.' = '.round($a_val6).' : '.round($b_val6).' : '.round($c_val6)?><br></b></p>
                                        <?php } ?>
                                    </div>
                            <?php } ?>
                            
                            <p class="my-2"><strong><?=$lang['23']?>:</strong></p>
                            <div class="col-lg-6 pe-lg-3">
                                <p class="text-center mb-2"><strong><?=$lang['24']?>:</strong></p>
                                <div id="piechart"></div>
                            </div>
                            <div class="col-lg-6 p_set3 ps-lg-3">
                                <?php if(isset($r2)){ ?>
                                    <?php if(isset($a_val)){ ?>
                                        <div class="text-center mb-2"><strong><?=$lang['25']?> <?=$a_val?>, <?=$lang['26']?> <?=$b?></strong></div>
                                        <div>
                                            <div style="background-color:#ff9f00;width:150px;height:50px;margin:0 auto !important">
                                                <div style="background-color:#00c2db;width:<?=$w?>%;height:50px"></div>
                                            </div>
                                        </div>
                                    <?php }elseif(isset($b_val)){ ?>
                                        <div class="text-center mb-2"><strong><?=$lang['25']?> <?=$a?>, <?=$lang['26']?> <?=round($b_val)?></strong></div>
                                        <div>
                                            <div style="background-color:#ff9f00;width:150px;height:50px;margin:0 auto !important">
                                                <div style="background-color:#00c2db;width:<?=$w?>%;height:50px"></div>
                                            </div>
                                        </div>
                                    <?php }else{ ?>
                                        <div class="text-center mb-2"><strong><?=$lang['25']?> <?=$a?>, <?=$lang['26']?> <?=$b?></strong></div>
                                        <div>
                                            <div style="background-color:#ff9f00;width:150px;height:50px;margin:0 auto !important">
                                                <div style="background-color:#00c2db;width:<?=$w?>%;height:50px"></div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php }elseif(isset($r3)){ ?>
                                    <div class="text-center mb-2"><strong><?=$lang['25']?> <?=$a?>, <?=$lang['26']?> <?=$b?></strong></div>
                                    <div>
                                        <div style="background-color:#ff9f00;width:150px;height:50px;margin:0 auto !important">
                                            <div style="background-color:#00c2db;width:<?=$w?>%;height:50px"></div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="text-center mb-2"><strong><?=$lang['27']?> <?=$a?>, <?=$lang['28']?> <?=$b?></strong></div>
                                <div class="">
                                    <div class="padding_0" style="background-color:#00c2db;width:150px;height:<?=$h?>px;max-height:135px;margin:0 auto !important"></div>
                                </div>
                            </div>
                        </div>
                        <div class="w-full text-center my-[25px]">
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
    

        
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart(){
            @if(isset($detail['r2']))
              var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                @if(isset($detail['a_val']))
                    ['b', <?=$b?>],
                    ['a', <?=$detail['a_val']?>]
                @elseif(isset($detail['b_val']))
                    ['b', <?=$detail['b_val']?>],
                    ['a', <?=$a?>]
                @else
                    ['b', <?=$b?>],
                    ['a', <?=$a?>]
                @endif
              ]);
            @else
                var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['c', <?=$c?>],
                ['a', <?=$a?>],
                ['b', <?=$b?>]
              ]);
            @endif
                var options = {
                    colors: ['#ff9f00', '#00c2db'],
                    slices: {  1: {offset: 0.08}
                    },
                    legend: 'none'
                };
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
          }
        </script>
    @endif
</form>

<script>
    var r2 = document.getElementById('r2');
    var r3 = document.getElementById('r3');
    if (r2.checked) {
        var elementsToHide = [
            '#txt2', '#c1', '#e', '#f', '#dot2', '#dot4', '#dot5', '#method1', '#i'
        ];
        var elementsToShow = [
            '#txt1', '#c', '#d', '#dot3', '#method', '#eq'
        ];

        function hideElements(selectors) {
            selectors.forEach(selector => {
                var element = document.querySelector(selector);
                if (element) element.style.display = 'none';
            });
        }

        function showElements(selectors) {
            selectors.forEach(selector => {
                var element = document.querySelector(selector);
                if (element) element.style.display = 'block';
            });
        }

        hideElements(elementsToHide);
        showElements(elementsToShow);
    }

    document.getElementById('r2').addEventListener('click', function(e) {
        var elementsToHide = [
            '#txt2', '#c1', '#e', '#f', '#dot2', '#dot4', '#dot5', '#method1', '#i'
        ];
        var elementsToShow = [
            '#txt1', '#c', '#d', '#dot3', '#method', '#eq'
        ];

        function hideElements(selectors) {
            selectors.forEach(selector => {
                var element = document.querySelector(selector);
                if (element) element.style.display = 'none';
            });
        }

        function showElements(selectors) {
            selectors.forEach(selector => {
                var element = document.querySelector(selector);
                if (element) element.style.display = 'block';
            });
        }

        hideElements(elementsToHide);
        showElements(elementsToShow);

        var dInputs = document.querySelectorAll('#d input');
        dInputs.forEach(input => input.value = '');
    });

    document.getElementById('r3').addEventListener('click', function(e) {
        var elementsToHide = [
            '#txt1', '#c', '#dot3', '#method', '#i'
        ];
        var elementsToShow = [
            '#txt2', '#c1', '#d', '#e', '#f', '#dot2', '#dot4', '#dot5', '#method1', '#eq'
        ];

        function hideElements(selectors) {
            selectors.forEach(selector => {
                var element = document.querySelector(selector);
                if (element) element.style.display = 'none';
            });
        }

        function showElements(selectors) {
            selectors.forEach(selector => {
                var element = document.querySelector(selector);
                if (element) element.style.display = 'block';
            });
        }

        hideElements(elementsToHide);
        showElements(elementsToShow);

    });

    document.getElementById('meth').addEventListener('change', function (e) {
        var elementsToHide = [
            '#txt1', '#txt2', '#c', '#c1', '#d', '#e', '#f', '#eq', '#dot2', '#dot3', '#dot4', '#dot5'
        ];

        function hideElements(selectors) {
            selectors.forEach(selector => {
                var element = document.querySelector(selector);
                if (element) element.style.display = 'none';
            });
        }

        function showElements(selectors) {
            selectors.forEach(selector => {
                var element = document.querySelector(selector);
                if (element) element.style.display = 'block';
            });
        }

        hideElements(elementsToHide);
        showElements(['#i']);

        var methodValue = this.value;

        switch (methodValue) {
            case '0':
                hideElements(['#c1', '#e', '#f', '#dot4', '#dot5', '#i']);
                showElements(['#txt1', '#c', '#d', '#dot3', '#method', '#eq']);
                
                break;
            case '1':
                hideElements(['#txt1', '#c', '#c1', '#d', '#e', '#f', '#dot3', '#dot4', '#dot5', '#eq']);
                document.querySelector('#i strong').textContent = 'Times Larger';
                break;
            case '2':
                hideElements(['#txt1', '#c', '#c1', '#d', '#e', '#f', '#dot3', '#dot4', '#dot5', '#eq']);
                document.querySelector('#i strong').textContent = 'Times Smaller';
                break;
            case '3':
            case '4':
            case '5':
                hideElements(['#txt1', '#c', '#c1', '#d', '#e', '#f', '#dot3', '#dot4', '#dot5', '#i', '#eq']);
                break;
        }
    });

    document.getElementById('metho').addEventListener('change', function (e) {
        var methodValue = this.value;
        var elementsToHide = [
            '#txt1', '#txt2', '#c', '#d', '#e', '#f', '#eq', '#dot3', '#dot4', '#dot5'
        ];

        function hideElements(selectors) {
            selectors.forEach(selector => {
                var element = document.querySelector(selector);
                if (element) element.style.display = 'none';
            });
        }

        function showElements(selectors) {
            selectors.forEach(selector => {
                var element = document.querySelector(selector);
                if (element) element.style.display = 'block';
            });
        }

        hideElements(elementsToHide);
        showElements(['#i']);

        switch (methodValue) {
            case '0':
                hideElements(['#i']);
                showElements(['#txt2', '#a', '#b', '#c1', '#d', '#e', '#f', '#eq', '#dot4', '#dot5', '#method1']);
                break;
            case '1':
                hideElements(['#txt2', '#c', '#d', '#e', '#f', '#dot3', '#dot4', '#dot5', '#eq']);
                document.querySelector('#i strong').textContent = 'Times Larger';
                break;
            case '2':
                hideElements(['#txt2', '#c', '#d', '#e', '#f', '#dot3', '#dot4', '#dot5', '#eq']);
                document.querySelector('#i strong').textContent = 'Times Smaller';
                ['#a', '#b', '#c1', '#i'].forEach(selector => {
                    var element = document.querySelector(selector);
                    if (element) element.classList.remove("mg_13", "mg_20", "mg_31", "mg_47");
                    if (element) element.classList.add("mg_23");
                });
                break;
            case '3':
            case '4':
            case '5':
            case '6':
                hideElements(['#txt2', '#c', '#d', '#e', '#f', '#dot3', '#dot4', '#dot5', '#eq', '#i']);
                break;
        }
    });

    @if(isset($detail) || isset($error))
        function hideElements(selectors) {
            selectors.forEach(selector => {
                var element = document.querySelector(selector);
                if (element) element.style.display = 'none';
            });
        }

        function showElements(selectors) {
            selectors.forEach(selector => {
                var element = document.querySelector(selector);
                if (element) element.style.display = 'block';
            });
        }
        
        hideElements(['#i']);
        showElements(['#i']);
        if (r2.checked){
            var methodValue = document.getElementById('meth').value;
            switch (methodValue) {
                case '0':
                    hideElements(['#c1', '#e', '#f', '#dot4', '#dot5', '#i']);
                    showElements(['#txt1', '#c', '#d', '#dot3', '#method', '#eq']);
                    break;
                case '1':
                    hideElements(['#txt1', '#c', '#c1', '#d', '#e', '#f', '#dot3', '#dot4', '#dot5', '#eq']);
                    document.querySelector('#i strong').textContent = 'Times Larger';
                    break;
                case '2':
                    hideElements(['#txt1', '#c', '#c1', '#d', '#e', '#f', '#dot3', '#dot4', '#dot5', '#eq']);
                    document.querySelector('#i strong').textContent = 'Times Smaller';
                    break;
                case '3':
                case '4':
                case '5':
                    hideElements(['#txt1', '#c', '#c1', '#d', '#e', '#f', '#dot3', '#dot4', '#dot5', '#i', '#eq']);
                    break;
            }
        }

        if (r3.checked){
            var methodone = document.getElementById('metho').value;
            switch (methodone) {
                case '0':
                console.log('merijan12');

                    hideElements(['#i']);
                    showElements(['#txt2', '#a', '#b', '#c1', '#d', '#e', '#f', '#eq', '#dot4', '#dot5', '#method1']);
                    break;
                case '1':
                    hideElements(['#txt2', '#c', '#d', '#e', '#f', '#dot3', '#dot4', '#dot5', '#eq']);
                    document.querySelector('#i strong').textContent = 'Times Larger';
                    break;
                case '2':
                    hideElements(['#txt2', '#c', '#d', '#e', '#f', '#dot3', '#dot4', '#dot5', '#eq']);
                    document.querySelector('#i strong').textContent = 'Times Smaller';
                    ['#a', '#b', '#c1', '#i'].forEach(selector => {
                        var element = document.querySelector(selector);
                        if (element) element.classList.remove("mg_13", "mg_20", "mg_31", "mg_47");
                        if (element) element.classList.add("mg_23");
                    });
                    break;
                case '3':
                case '4':
                case '5':
                case '6':
                    hideElements(['#txt2', '#c', '#d', '#e', '#f', '#dot3', '#dot4', '#dot5', '#eq', '#i']);
                    break;
            }
        }
    @endif

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', checkInputs);
            input.addEventListener('input', checkInput);
        });
    });

    function checkInputs() {
        if (document.getElementById('r2').checked) {
            var valueone = document.getElementById('meth').value;
            if (valueone == 0) {
                var inputNames = ['a', 'b', 'c', 'd'];
                var selector = inputNames.map(name => `input[name="${name}"]`).join(', ');
                var inputs = document.querySelectorAll(selector);

                let filledCount = 0;
                inputs.forEach(input => {
                    if (input.value.trim() !== '') {
                        filledCount++;
                    }
                });

                if (filledCount === 3) {
                    inputs.forEach(input => {
                        if (input.value.trim() === '') {
                            input.disabled = true;
                            input.style.backgroundColor = 'gainsboro';
                        }
                    });
                } else {
                    inputs.forEach(input => {
                        input.disabled = false;
                        input.style.backgroundColor = '';
                    });
                }
            }
        }
    }

    function checkInput() {
        if (document.getElementById('r3').checked) {
            var valueone = document.getElementById('metho').value;
            if (valueone == 0) {
                var inputNames = ['a', 'b', 'c1', 'd', 'e', 'f'];
                var selector = inputNames.map(name => `input[name="${name}"]`).join(', ');
                var inputs = document.querySelectorAll(selector);

                let filledCount = 0;
                inputs.forEach(input => {
                    if (input.value.trim() !== '') {
                        filledCount++;
                    }
                });

                if (filledCount === 4) {
                    inputs.forEach(input => {
                        if (input.value.trim() === '') {
                            input.disabled = true;
                            input.style.backgroundColor = 'gainsboro';
                        }
                    });
                } else {
                    inputs.forEach(input => {
                        input.disabled = false;
                        input.style.backgroundColor = '';
                    });
                }
            }
        }
    }


   
</script>