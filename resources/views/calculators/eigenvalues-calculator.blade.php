<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf


    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[80%] md:w-[80%] w-full mx-auto ">
            <div class="grid grid-cols-12 mt-3   gap-2 md:gap-4 lg:gap-4">
            @php
                $request = request();
            @endphp
            <div class="col-span-12">
                <label for="matrix" class="font-s-14 text-blue">{{ $lang['1'] }}:</label>
                <div class="w-100 py-2">
                    <select id="matrix" name="matrix" class="input matrix">
                        <?php
                          function optnsList($arr1,$arr2,$frst,$matrix){
                          foreach($arr1 as $index => $name){
                        ?>
                        <option value="<?php echo $name ?>" <?php if(isset($matrix)){ echo $name === $matrix ? " selected" : ""; }else{ echo $name === $frst ? " selected" : ""; } ?>><?php echo $arr2[$index] ?></option>
                        <?php
                            }
                          }
                          $name = ["2","3","4","5"];
                          $val = ["2","3","4","5"];
                          optnsList($val,$name,"3",$request->matrix);
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-span-12">
                <table class="w-100 matrix_table">
                    <tr>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_0_0" class="input" value="<?=isset($request->matrix_0_0)?$request->matrix_0_0:'1'?>"  required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_0_1" class="input"  value="<?=isset($request->matrix_0_1)?$request->matrix_0_1:'1'?>" required>
                            </div>
                        </td>
                        <td class="{{ isset($request->matrix) && $request->matrix == '2' ? 'd-none' : '' }}">
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_0_2" class="input"  value="<?=isset($request->matrix_0_2)?$request->matrix_0_2:'9'?>" required>
                            </div>
                        </td>
                        @for ($j = 3; $j < $request->matrix; $j++)
                            <td>
                                <div class="px-1 pt-2">
                                    @php $mat = 'matrix_0_' . $j; @endphp
                                    <input type="number" step="any" name="{{ 'matrix_0_' . $j }}" class="input" value="{{$request->$mat}}"  required>
                                </div>
                            </td>
                        @endfor
                    </tr>
                    <tr>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_1_0" class="input" value="<?=isset($request->matrix_1_0)?$request->matrix_1_0:'2'?>"  required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_1_1" class="input"  value="<?=isset($request->matrix_1_1)?$request->matrix_1_1:'5'?>"  required>
                            </div>
                        </td>
                        <td class="{{ isset($request->matrix) && $request->matrix == '2' ? 'd-none' : '' }}">
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_1_2" class="input"  value="<?=isset($request->matrix_1_2)?$request->matrix_1_2:'1'?>"  required>
                            </div>
                        </td>
                        @for ($j = 3; $j < $request->matrix; $j++)
                            <td>
                                <div class="px-1 pt-2">
                                    @php $mat = 'matrix_1_' . $j; @endphp
                                    <input type="number" step="any" name="{{ 'matrix_1_' . $j }}" class="input" value="{{$request->$mat}}"  required>
                                </div>
                            </td>
                        @endfor
                    </tr>
                    <tr class="{{ isset($request->matrix) && $request->matrix == '2' ? 'd-none' : '' }}">
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_2_0" class="input" value="<?=isset($request->matrix_2_0)?$request->matrix_2_0:'1'?>"  required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_2_1" class="input"  value="<?=isset($request->matrix_2_1)?$request->matrix_2_1:'2'?>"  required>
                            </div>
                        </td>
                        <td>
                            <div class="px-1 pt-2">
                                <input type="number" step="any" name="matrix_2_2" class="input"  value="<?=isset($request->matrix_2_2)?$request->matrix_2_2:'7'?>"  required>
                            </div>
                        </td>
                        @for ($j = 3; $j < $request->matrix; $j++)
                            <td>
                                <div class="px-1 pt-2">
                                    @php $mat = 'matrix_2_' . $j; @endphp
                                    <input type="number" step="any" name="{{ 'matrix_2_' . $j }}" class="input" value="{{$request->$mat}}"  required>
                                </div>
                            </td>
                        @endfor
                    </tr>
                    @isset($request->submit)
                        @for ($i = 3; $i < $request->matrix; $i++)
                            <tr>
                                @for ($j = 0; $j < $request->matrix; $j++)
                                    <td>
                                        <div class="px-1 pt-2">
                                            @php $mat = 'matrix_'.$i.'_'. $j; @endphp
                                            <input type="number" step="any" name="{{ 'matrix_' . $i . '_' . $j }}" class="input" value="{{$request->$mat}}" required>
                                        </div>
                                    </td>
                                @endfor
                            </tr>
                        @endfor
                    @endisset
                </table>
            </div>
            <div class="col-span-12">
                <button type="button" id="matrix_gen_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><?=$lang['2']?></button>
                <button type="button" id="matrix_clr_btn" class="px-3 py-2 mt-1 mx-1 addmore cursor-pointer bg-[#2845F5] text-white rounded-lg"><?=$lang['3']?></button>
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
    
    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 result_calculator rounded-lg  space-y-6 result">
        <div class="">
                @if ($type == 'calculator')
                    @include('inc.copy-pdf')
                @endif
            <div class="rounded-lg  flex items-center justify-center">
                <div class="w-full mt-3">
                    <div class="row">
                        @php
                            $eigvals=$detail['eigvals'];
                            $d=$detail['d'];
                            $dtrmnt=$detail['dtrmnt'];
                            $l1=$detail['l1'];
                            $l2=$detail['l2'];
                            $matrix = $request->matrix;
                            $matrix_0_0 = $request->matrix_0_0;
                            $matrix_0_1 = $request->matrix_0_1;
                            $matrix_0_2 = $request->matrix_0_2;
                            $matrix_0_3 = $request->matrix_0_3;
                            $matrix_0_4 = $request->matrix_0_4;
                            $matrix_1_0 = $request->matrix_1_0;
                            $matrix_1_1 = $request->matrix_1_1;
                            $matrix_1_2 = $request->matrix_1_2;
                            $matrix_1_3 = $request->matrix_1_3;
                            $matrix_1_4 = $request->matrix_1_4;
                            $matrix_2_0 = $request->matrix_2_0;
                            $matrix_2_1 = $request->matrix_2_1;
                            $matrix_2_2 = $request->matrix_2_2;
                            $matrix_2_3 = $request->matrix_2_3;
                            $matrix_2_4 = $request->matrix_2_4;
                            $matrix_3_0 = $request->matrix_3_0;
                            $matrix_3_1 = $request->matrix_3_1;
                            $matrix_3_2 = $request->matrix_3_2;
                            $matrix_3_3 = $request->matrix_3_3;
                            $matrix_3_4 = $request->matrix_3_4;
                            $matrix_4_0 = $request->matrix_4_0;
                            $matrix_4_1 = $request->matrix_4_1;
                            $matrix_4_2 = $request->matrix_4_2;
                            $matrix_4_3 = $request->matrix_4_3;
                            $matrix_4_4 = $request->matrix_4_4;
                        @endphp
                        <div class="w-full text-[16px]">
                            <p class="mt-2 text-[20px]">\( <?=$eigvals?> \)</p>
                            <p class="mt-2"><strong><?=$lang['5']?>:</strong></p>
                            <?php if($matrix==='2'){ ?>
                                <p class="mt-2"><?=$lang['6']?> λ <?=$lang['7']?></p>
                                <p class="mt-2">\( <?=$d?> \)</p>
                                <p class="mt-2"><?=$lang['8']?></p>
                                <p class="mt-2">\( <?=$dtrmnt?> \)</p>
                                <p class="mt-2"><?=$lang['9']?></p>
                                <p class="mt-2">\( <?=$dtrmnt?> = 0 \)</p>
                                <p class="mt-2"><?=$lang['10']?> (<?=$lang['4']?>)</p>
                                <p class="mt-2">\( \lambda_1 = <?=preg_replace('/frac/','dfrac',$l1)?> \)</p>
                                <p class="mt-2">\( \lambda_2 = <?=preg_replace('/frac/','dfrac',$l2)?> \)</p>
                                <p class="mt-2">\( (\lambda1, \lambda2) = <?=$eigvals?> \)</p>
                            <?php }if($matrix==='3'){
                            $l3=$detail['l3'];
                            ?>
                                <p class="mt-2"><?=$lang['6']?> λ <?=$lang['7']?></p>
                                <p class="mt-2">\( <?=$d?> \)</p>
                                <p class="mt-2"><?=$lang['8']?></p>
                                <p class="mt-2">\( <?=$dtrmnt?> \)</p>
                                <p class="mt-2"><?=$lang['9']?></p>
                                <p class="mt-2">\( <?=$dtrmnt?> = 0 \)</p>
                                <p class="mt-2"><?=$lang['10']?> (<?=$lang['4']?>)</p>
                                <p class="mt-2">\( \lambda_1 = <?=preg_replace('/frac/','dfrac',$l1)?> \)</p>
                                <p class="mt-2">\( \lambda_2 = <?=preg_replace('/frac/','dfrac',$l2)?> \)</p>
                                <p class="mt-2">\( \lambda_3 = <?=preg_replace('/frac/','dfrac',$l3)?> \)</p>
                                <p class="mt-2">\( (\lambda1, \lambda2, \lambda3) = <?=$eigvals?> \)</p>
                            <?php }if($matrix==='4'){
                            $l3=$detail['l3'];
                            $l4=$detail['l4'];
                            ?>
                                <p class="mt-2"><?=$lang['6']?> λ <?=$lang['7']?></p>
                                <p class="mt-2">\( <?=$d?> \)</p>
                                <p class="mt-2"><?=$lang['8']?></p>
                                <p class="mt-2">\( <?=$dtrmnt?> \)</p>
                                <p class="mt-2"><?=$lang['9']?></p>
                                <p class="mt-2">\( <?=$dtrmnt?> = 0 \)</p>
                                <p class="mt-2"><?=$lang['10']?> (<?=$lang['4']?>)</p>
                                <p class="mt-2">\( \lambda_1 = <?=preg_replace('/frac/','dfrac',$l1)?> \)</p>
                                <p class="mt-2">\( \lambda_2 = <?=preg_replace('/frac/','dfrac',$l2)?> \)</p>
                                <p class="mt-2">\( \lambda_3 = <?=preg_replace('/frac/','dfrac',$l3)?> \)</p>
                                <p class="mt-2">\( \lambda_4 = <?=preg_replace('/frac/','dfrac',$l4)?> \)</p>
                                <p class="mt-2">\( (\lambda1, \lambda2, \lambda3, \lambda4) = <?=$eigvals?> \)</p>
                            <?php }if($matrix==='5'){
                            $l3=$detail['l3'];
                            $l4=$detail['l4'];
                            $l5=$detail['l5'];
                            ?>
                                <p class="mt-2"><?=$lang['6']?> λ <?=$lang['7']?></p>
                                <p class="mt-2">\( <?=$d?> \)</p>
                                <p class="mt-2"><?=$lang['8']?></p>
                                <p class="mt-2">\( <?=$dtrmnt?> \)</p>
                                <p class="mt-2"><?=$lang['9']?></p>
                                <p class="mt-2">\( <?=$dtrmnt?> = 0 \)</p>
                                <p class="mt-2"><?=$lang['10']?> (<?=$lang['4']?>)</p>
                                <p class="mt-2">\( \lambda_1 = <?=preg_replace('/frac/','dfrac',$l1)?> \)</p>
                                <p class="mt-2">\( \lambda_2 = <?=preg_replace('/frac/','dfrac',$l2)?> \)</p>
                                <p class="mt-2">\( \lambda_3 = <?=preg_replace('/frac/','dfrac',$l3)?> \)</p>
                                <p class="mt-2">\( \lambda_4 = <?=preg_replace('/frac/','dfrac',$l4)?> \)</p>
                                <p class="mt-2">\( \lambda_5 = <?=preg_replace('/frac/','dfrac',$l5)?> \)</p>
                                <p class="mt-2">\( (\lambda1, \lambda2, \lambda3, \lambda4, \lambda5) = <?=$eigvals?> \)</p>
                            <?php } ?>
                        </div>
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
        <script>
            document.getElementById('matrix_gen_btn').addEventListener('click', function() {
                var arr = [];
                for (var i = 0; i < 25; ++i) {
                    arr[i] = i;
                }
                arr = randNums(arr);
                var inputs = document.querySelectorAll('.matrix_table > tbody > tr > td > div > input');
                inputs.forEach(function(input, index) {
                    input.value = String(arr[index]).charAt(0);
                });
            });
            function randNums(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
                return array;
            }
            document.getElementById('matrix_clr_btn').addEventListener('click', function() {
                var inputs = document.querySelectorAll('.matrix_table > tbody > tr > td > div > input');
                inputs.forEach(function(input) {
                    input.value = "";
                });
            });
            function crDetMatrix(mat) {
                var matrixOptVal = mat.value;
                var matrixTableBody = document.querySelector(".matrix_table > tbody");
                var matrixRows = matrixTableBody.querySelectorAll("tr");
                var matrixRowLen = matrixRows.length;
                if (matrixOptVal > matrixRowLen) {
                    for (var i = 0; i < (matrixOptVal - matrixRowLen); i++) {
                        var newRow = document.createElement("tr");
                        matrixTableBody.appendChild(newRow);
                    }
                    matrixTableBody.querySelectorAll("tr").forEach(function(row, index) {
                        var matrixTdLen = row.querySelectorAll("td").length;
                        var matrixTdLens = matrixTdLen;
                        for (var i = 0; i < (matrixOptVal - matrixTdLen); i++) {
                            var newCell = document.createElement("td");
                            var div = document.createElement("div");
                            div.classList.add("px-1", "pt-2");
                            var input = document.createElement("input");
                            input.type = "number";
                            input.name = "matrix_" + index + "_" + matrixTdLens;
                            input.value = "0";
                            input.id = "matrix_" + index + "_" + matrixTdLens;
                            input.required = true;
                            input.classList.add("input");
                            div.appendChild(input);
                            newCell.appendChild(div);
                            row.appendChild(newCell);
                            matrixTdLens++;
                        }
                    });
                } else if (matrixOptVal < matrixRowLen) {
                    for (var i = 0; i < (matrixRowLen - matrixOptVal); i++) {
                        matrixTableBody.removeChild(matrixTableBody.lastElementChild);
                    }
                    matrixTableBody.querySelectorAll("tr").forEach(function(row, index) {
                        var matrixTdLen = row.querySelectorAll("td").length;
                        for (var i = 0; i < (matrixTdLen - matrixOptVal); i++) {
                            row.removeChild(row.lastElementChild);
                        }
                    });
                }
            }
            document.querySelectorAll(".matrix").forEach(function(element) {
                element.addEventListener("change", function() {
                    crDetMatrix(element);
                });
            });
        </script>
    @endpush
</form>
