<div>
  <form wire:submit.prevent="calculate">
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[70%] md:w-[70%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            <div class="col-span-12">
                <label for="type" class="label"><?=$lang['1'] ?></label>
                <div class="w-full py-2">
                    <select wire:model.live="matrix_type" name="type" class="input" id="type" aria-label="select">
                        <option value="row">{{$lang['2']}}</option>
                        <option value="col">{{$lang['3']}}</option>
                    </select>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="matrix_size" class="label"><?=$lang['4'] ?></label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.defer="matrix_size" name="matrix_size" id="matrix_size" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="pth_matrix" class="label" id="pth">
                    @if($matrix_type == 'col')
                        Pth Column (C<sub class='font-s-12 text-blue'>p</sub>)
                    @else
                        <?=$lang[5]?> (R<sub class="font-s-12 text-blue">p</sub>)
                    @endif
                </label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.defer="pth_matrix" name="pth_matrix" id="pth_matrix" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="a" class="label" id="factor_a">
                    @if($matrix_type == 'col')
                        Factor "a" to be multiplied by C<sub class="font-s-12 text-blue">p</sub>
                    @else
                        Factor "a" to be multiplied by R<sub class="font-s-12 text-blue">p</sub>
                    @endif
                </label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.defer="a" name="a" id="a" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="result_q" class="label" id="resultText">
                    @if($matrix_type == 'col')
                        Column q that Receives Result (C<sub class='font-s-12 text-blue'>q</sub>)
                    @else
                        <?=$lang[7]?>(R<sub class="font-s-12 text-blue">q</sub>)
                    @endif
                </label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.defer="result_q" name="result_q" id="result_q" class="input" aria-label="input" />
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-6">
                <label for="b" class="label" id="factor_b">
                    @if($matrix_type == 'col')
                        Factor "b" to be multiplied by C<sub class="font-s-12 text-blue">q</sub>
                    @else
                        Factor "b" to be multiplied by R<sub class="font-s-12 text-blue">q</sub>
                    @endif
                </label>
                <div class="w-full py-2">
                    <input type="number" step="any" wire:model.defer="b" name="b" id="b" class="input" aria-label="input" />
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
    
    {{-- result --}}
    <hr>
    <div id="result-section" wire:loading.remove wire:target="calculate" class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    @php
                        // matrix_size, pth_matrix, a, b, matrix_type, result_q are available from Livewire state
                        $resulted_array = $detail['array'];
                        $identity_matrix = $detail['identity_matrix'];
                        $multiply_matrix = $detail['multiply_matrix'];
                        $addition_matrix = $detail['addition_matrix'];
                        $resulted = "";
                    @endphp
                    <div class="w-full text-[16px]">
                        <p class="mt-3 text-[18px]"><strong><?=$lang['9'];?></strong></p>
                        <p class="mt-3" ><strong>\( \begin{bmatrix} <?php
                            for($i=0;$i<$matrix_size;$i++){
                              for($j=0;$j<$matrix_size;$j++){
                                if($j==$matrix_size-1){
                                  $resulted.=$resulted_array[$i][$j];
                                }else{
                                  $resulted.=$resulted_array[$i][$j].'&';
                                }
                              }
                              echo $resulted;
                              echo "\\\\";
                              $resulted = "";
                            }
                            ?>\end{bmatrix} \)</strong>
                        </p>
                        <p class="mt-3"><strong><?=$lang[17]?></strong></p>
                        @php
                            $identity = "";
                            $multiply = "";
                            $addition = "";
                        @endphp
                        @if($matrix_type=="row")
                            <p class="mt-3"><?=$lang[11]?></p>
                            <p class="mt-3"><?=$lang[12]?><?=$matrix_size?></p>
                            <p class="mt-3">(<?=$lang[13]?><sub class="font-s-14">q</sub>) = <?=$result_q?></p>
                            <p class="mt-3">p<sup class="font-s-14">th</sup> Row (R<sub class="font-s-14">p</sub>) = <?=$pth_matrix?></p>
                            <p class="mt-3"><?=$lang[14]?><?=$a?></p>
                            <p class="mt-3"><?=$lang[15]?><?=$b?></p>
                            <p class="mt-3"><?=$lang[16]?></p>
                            <p class="mt-3">\( aR_p + bR_q -> R_q \)</p>
                            <div class="col-12 mt-3 d-flex align-items-center">
                                <p>For step by step calculations</p>
                                <button type="button" class="calculate ms-2" wire:click="$toggle('showSteps')" style="font-size: 16px;padding: 10px;cursor: pointer;">Click Here</button>
                            </div>
                            @if($showSteps)
                            <div class="col-12 mt-3 res_step elementrySteps" id="res_step2">
                                <p class="mt-3"><?=$lang[18]?><?=$matrix_size?><?=$lang[19]?><?=$matrix_size?>x<?=$matrix_size?><?=$lang[20]?></p>
                                <p class="mt-3">\( \begin{bmatrix} <?php
                                    for($i=0;$i<$matrix_size;$i++){
                                    for($j=0;$j<$matrix_size;$j++){
                                        if($j==$matrix_size-1){
                                        $identity.=$identity_matrix[$i][$j];
                                        }else{
                                        $identity.=$identity_matrix[$i][$j].'&';
                                        }
                                    }
                                    echo $identity;
                                    echo "\\\\";
                                    $identity = "";
                                    }
                                    ?>\end{bmatrix} \)
                                </p>
                                <p class="mt-3"><?=$lang[21]?></p>
                                <p class="mt-3">\( aR_p + bR_q -> R_q \)</p>
                                <p class="mt-3">aR<sub class="font-s-14">p</sub> = <?=$a?> x R<sub class="font-s-14"><?=$pth_matrix?></sub> (R<sub class="font-s-14">p</sub> is <?=$pth_matrix?>
                                    <?php if($pth_matrix==1){ ?><sup class="font-s-14">st</sup><?php 
                                    }elseif($pth_matrix==2){ ?><sup class="font-s-14">nd</sup><?php 
                                    }elseif($pth_matrix==3){ ?><sup class="font-s-14">rd</sup><?php 
                                    }else{ ?><sup class="font-s-14">th</sup><?php }?>
                                    Row)</p>
                                <p class="mt-3">bR<sub class="font-s-14">q</sub> = <?=$b?> x R<sub class="font-s-14"><?=$result_q?></sub> (R<sub class="font-s-14">q</sub> is <?=$result_q?>
                                    <?php if($result_q==1){ ?><sup class="font-s-14">st</sup><?php 
                                    }elseif($result_q==2){ ?><sup class="font-s-14">nd</sup><?php 
                                    }elseif($result_q==3){ ?><sup class="font-s-14">rd</sup><?php 
                                    }else{ ?><sup class="font-s-14">th</sup>
                                    <?php }?>
                                    Row)
                                </p>
                                <p class="mt-3">\( \begin{bmatrix} <?php
                                    for($i=0;$i<$matrix_size;$i++){
                                    for($j=0;$j<$matrix_size;$j++){
                                        if($j==$matrix_size-1){
                                        $multiply.=$multiply_matrix[$i][$j];
                                        }else{
                                        $multiply.=$multiply_matrix[$i][$j].'&';
                                        }
                                    }
                                    echo $multiply;
                                    echo "\\\\";
                                    $multiply = "";
                                    }
                                    ?>\end{bmatrix} \)
                                </p>
                                <p class="mt-3">Now;</p>
                                <p class="mt-3">\( <?=$a?>R_<?=$pth_matrix?> + <?=$b?>R_<?=$result_q?> = aR_p + bR_q \)</p>
                                <p class="mt-3">\( \begin{bmatrix} <?php
                                    for($i=0;$i<$matrix_size;$i++){
                                    for($j=0;$j<$matrix_size;$j++){
                                        if($j==$matrix_size-1){
                                        $addition.=$addition_matrix[$i][$j];
                                        }else{
                                        $addition.=$addition_matrix[$i][$j].'&';
                                        }
                                    }
                                    echo $addition;
                                    echo "\\\\";
                                    $addition = "";
                                    }
                                    ?>\end{bmatrix} \)
                                </p>
                                <p class="mt-3">Final Matrix</p>
                                <p class="mt-3">
                                    \( \begin{bmatrix} <?php
                                    for($i=0;$i<$matrix_size;$i++){
                                    for($j=0;$j<$matrix_size;$j++){
                                        if($j==$matrix_size-1){
                                        $resulted.=$resulted_array[$i][$j];
                                        }else{
                                        $resulted.=$resulted_array[$i][$j].'&';
                                        }
                                    }
                                    echo $resulted;
                                    echo "\\\\";
                                    $resulted = "";
                                    }
                                ?>\end{bmatrix} \)
                                </p>
                            </div>
                            @endif
                        @else
                            <p class="mt-3"><strong><?=$lang[11]?></strong></p>
                            <p class="mt-3"><?=$lang[12]?><?=$matrix_size?></p>
                            <p class="mt-3">(<?=$lang[24]?><sub class="font-s-14">q</sub>) = <?=$result_q?></p>
                            <p class="mt-3">p<sup class="font-s-14">th</sup class="font-s-14"> Column (C<sub class="font-s-14">p</sub>) = <?=$pth_matrix?></p>
                            <p class="mt-3"><?=$lang[14]?><?=$a?></p>
                            <p class="mt-3"><?=$lang[15]?><?=$b?></p>
                            <p class="mt-3"><?=$lang[16]?></p>
                            <p class="mt-3">\( aC_p + bC_q -> C_q \)</p>
                            <div class="col-12 mt-3 d-flex align-items-center">
                                <p>For step by step calculations</p>
                                <button type="button" class="calculate ms-2" wire:click="$toggle('showSteps')" style="font-size: 16px;padding: 10px;cursor: pointer;">Click Here</button>
                            </div>
                            @if($showSteps)
                            <div class="col-12 mt-3 res_step elementrySteps" id="res_step2">
                                <p class="mt-3"><?=$lang[18]?><?=$matrix_size?><?=$lang[19]?><?=$matrix_size?>x<?=$matrix_size?><?=$lang[20]?></p>
                                <p class="mt-3" >\( \begin{bmatrix} <?php
                                    for($i=0;$i<$matrix_size;$i++){
                                    for($j=0;$j<$matrix_size;$j++){
                                        if($j==$matrix_size-1){
                                        $identity.=$identity_matrix[$i][$j];
                                        }else{
                                        $identity.=$identity_matrix[$i][$j].'&';
                                        }
                                    }
                                    echo $identity;
                                    echo "\\\\";
                                    $identity = "";
                                    }
                                    ?>\end{bmatrix} \)
                                </p>
                                <p class="mt-3"><?=$lang[21]?></p>
                                <p class="mt-3">\( aC_p + bC_q -> C_q \)</p>
                                <p class="mt-3">aC<sub class="font-s-14">p</sub> = <?=$a?> x C<sub class="font-s-14"><?=$pth_matrix?></sub> (C<sub class="font-s-14">p</sub> is <?=$pth_matrix?>
                                <?php if($pth_matrix==1){ ?><sup class="font-s-14">st</sup><?php 
                                    }elseif($pth_matrix==2){ ?><sup class="font-s-14">nd</sup><?php 
                                    }elseif($pth_matrix==3){ ?><sup class="font-s-14">rd</sup><?php 
                                    }else{ ?><sup class="font-s-14">th</sup><?php }?>
                                Column)</p>
                                <p class="mt-3">bC<sub class="font-s-14">q</sub> = <?=$b?> x C<sub class="font-s-14"><?=$result_q?></sub> (C<sub class="font-s-14">q</sub> is <?=$result_q?>
                                    <?php if($result_q==1){ ?><sup class="font-s-14">st</sup><?php 
                                    }elseif($result_q==2){ ?><sup class="font-s-14">nd</sup><?php 
                                    }elseif($result_q==3){ ?><sup class="font-s-14">rd</sup><?php 
                                    }else{ ?><sup class="font-s-14">th</sup><?php }?>
                                Column)</p>
            
                                <p class="mt-3" >\( \begin{bmatrix} <?php
                                    for($i=0;$i<$matrix_size;$i++){
                                    for($j=0;$j<$matrix_size;$j++){
                                        if($j==$matrix_size-1){
                                        $multiply.=$multiply_matrix[$i][$j];
                                        }else{
                                        $multiply.=$multiply_matrix[$i][$j].'&';
                                        }
                                    }
                                    echo $multiply;
                                    echo "\\\\";
                                    $multiply = "";
                                    }
                                    ?>\end{bmatrix} \)
                                </p>
                                <p class="mt-3"><?=$lang[22]?></p>
                                <p class="mt-3">\( <?=$a?>C_<?=$pth_matrix?> + <?=$b?>C_<?=$result_q?> = aC_p + bC_q \)</p>
                                <p class="mt-3" >\( \begin{bmatrix} <?php
                                    for($i=0;$i<$matrix_size;$i++){
                                    for($j=0;$j<$matrix_size;$j++){
                                        if($j==$matrix_size-1){
                                        $addition.=$addition_matrix[$i][$j];
                                        }else{
                                        $addition.=$addition_matrix[$i][$j].'&';
                                        }
                                    }
                                    echo $addition;
                                    echo "\\\\";
                                    $addition = "";
                                    }
                                    ?>\end{bmatrix} \)
                                </p>
                                <p class="mt-3"><?=$lang[23]?></p>
                                <p class="mt-3">
                                    \( \begin{bmatrix} <?php
                                    for($i=0;$i<$matrix_size;$i++){
                                    for($j=0;$j<$matrix_size;$j++){
                                        if($j==$matrix_size-1){
                                        $resulted.=$resulted_array[$i][$j];
                                        }else{
                                        $resulted.=$resulted_array[$i][$j].'&';
                                        }
                                    }
                                    echo $resulted;
                                    echo "\\\\";
                                    $resulted = "";
                                    }
                                ?>\end{bmatrix} \)
                                </p>
                            </div>
                            @endif
                        @endif  
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
    <link rel="stylesheet" href="{{ url('katex/katex.min.css') }}">
       <script defer src="{{ url('katex/katex.min.js') }}"></script>
       <script defer src="{{ url('katex/auto-render.min.js') }}" 
       onload="renderMathInElement(document.body);"></script>
    @endpush
</form>
</div>
