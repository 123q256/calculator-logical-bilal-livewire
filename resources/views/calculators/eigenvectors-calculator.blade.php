<form class="row w-100" action="{{ url()->current() }}/" method="POST">
    @csrf

    <div class="w-full mx-auto p-4 lg:p-8 md:p-8 input_form rounded-lg  space-y-6 my-3">
        @if (isset($error))
        <p class="text-red-500 text-lg font-semibold w-full">{{ $error }}</p>
       @endif
       <div class="lg:w-[60%] md:w-[60%] w-full mx-auto ">
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
                          $name = ["2","3"];
                          $val = ["2","3"];
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
                    </tr>
                </table>
            </div>
            <div class="col-span-12 ">
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
                    <div class="w-full">
                        @php
                            $eigvecs=$detail['eigvecs'];
                            $mul=$detail['mul'];
                            $eigvals=$detail['eigvals'];
                            $eigvals1=$detail['eigvals1'];
                            $eigvals2=$detail['eigvals2'];
                            if (isset($detail['eigvals3'])) {
                                $eigvals3=$detail['eigvals3'];
                            }
                            $d=$detail['d'];
                            $dtrmnt=$detail['dtrmnt'];
                            $l1=$detail['l1'];
                            $l2=$detail['l2'];
                            if (isset($detail['l3'])) {
                                $l3=$detail['l3'];
                            }
                            $a=$detail['a'];
                            $b=$detail['b'];
                            if (isset($detail['c'])) {
                                $c=$detail['c'];
                            }
                            $res1=$detail['res1'];
                            $res2=$detail['res2'];
                            if (isset($detail['res3'])) {
                                $res3=$detail['res3'];
                            }
                            $matrix = $request->matrix;
                            $matrix_0_0 = $request->matrix_0_0;
                            $matrix_0_1 = $request->matrix_0_1;
                            $matrix_0_2 = $request->matrix_0_2;
                            $matrix_1_0 = $request->matrix_1_0;
                            $matrix_1_1 = $request->matrix_1_1;
                            $matrix_1_2 = $request->matrix_1_2;
                            $matrix_2_0 = $request->matrix_2_0;
                            $matrix_2_1 = $request->matrix_2_1;
                            $matrix_2_2 = $request->matrix_2_2;
                        @endphp
                        <div class="w-full text-[16px] overflow-auto">
                            <p class="mt-3 text-[18px]"><strong><?=$lang['4']?></strong></p>
                            @if($matrix==='2')
                                <p class="mt-3">\( \left(<?=$res1?>, <?=$res2?> \right) \)</p> 
                            @else
                                <p class="mt-3">\( \left(<?=$res1?>, <?=$res2?>, <?=$res3?> \right) \)</p>     
                            @endif
                            <p class="mt-3 text-[18px]"><strong><?=$lang['5']?></strong></p>
                            <p class="mt-3">\( <?=$mul?> \)</p>
                            <p class="mt-3 text-[18px]"><strong><?=$lang['6']?></strong></p>
                            @if($matrix==='2')
                                <p class="mt-3">\( (<?=$l1?>, <?=$l2?>) \)</p>
                            @else
                                <p class="mt-3">\( (<?=$l1?>, <?=$l2?>, <?=$l3?>) \)</p>
                            @endif
                            <p class="mt-3"><strong><?=$lang['7']?>:</strong></p>
                            <?php if($matrix==='2'){ ?>
                                <p class="mt-3"><strong><?=$lang['8']?> λ <?=$lang['9']?></strong></p>
                                <p class="mt-3">\( <?=$d?> \)</p>
                                <p class="mt-3"><strong><?=$lang['10']?></strong></p>
                                <p class="mt-3">\( <?=$dtrmnt?> \)</p>
                                <p class="mt-3"><strong><?=$lang['11']?></strong></p>
                                <p class="mt-3">\( <?=$dtrmnt?> = 0 \)</p>
                                <p class="mt-3"><strong><?=$lang['12']?> (<?=$lang['6']?>)</strong></p>
                                <p class="mt-3">\( (\lambda1, \lambda2) = \left(<?=$l1?>, <?=$l2?>\right) \)</p>
                                <p class="mt-3"><strong><?=$lang['13']?> <?=$lang['4']?></strong></p>
                                <p class="mt-3">\( a. \quad \lambda = <?=preg_replace('/frac/','dfrac',$eigvals1)?> \)</p>
                                <p class="mt-3">\( \quad \quad <?=$d?> = <?=$res1?> \)</p>
                                <p class="mt-3">\( b. \quad \lambda = <?=preg_replace('/frac/','dfrac',$eigvals2)?> \)</p>
                                <p class="mt-3">\( \quad \quad <?=$d?> = <?=$res2?> \)</p>
                                <p class="mt-3"><strong><?=$lang['6']?></strong></p>
                                <p class="mt-3">\( <?=preg_replace('/frac/','dfrac',$eigvals)?> \approx (<?=$l1?>, <?=$l2?>) \)</p>
                                <p class="mt-3"><strong><?=$lang['5']?></strong></p>
                                <p class="mt-3">\( <?=$mul?> \)</p>
                                <p class="mt-3"><strong><?=$lang['4']?></strong></p>
                                <p class="mt-3">\( <?=$eigvecs?> \approx \left(<?=$res1?>, <?=$res2?> \right) \)</p>
                            <?php }if($matrix==='3'){ ?>
                                <p class="mt-3"><strong><?=$lang['8']?> λ <?=$lang['9']?></strong></p>
                                <p class="mt-3">\( <?=$d?> \)</p>
                                <p class="mt-3"><strong><?=$lang['10']?></strong></p>
                                <p class="mt-3">\( <?=$dtrmnt?> \)</p>
                                <p class="mt-3"><strong><?=$lang['11']?></strong></p>
                                <p class="mt-3">\( <?=$dtrmnt?> = 0 \)</p>
                                <p class="mt-3"><strong><?=$lang['12']?> (<?=$lang['6']?>)</strong></p>
                                <p class="mt-3">\( (\lambda1, \lambda2, \lambda3) = \left(<?=$l1?>, <?=$l2?>, <?=$l3?>\right) \)</p>
                                <p class="mt-3"><strong><?=$lang['13']?> <?=$lang['4']?></strong></p>
                                <p class="mt-3">\( a. \quad \lambda = <?=preg_replace('/frac/','dfrac',$eigvals1)?> \)</p>
                                <p class="mt-3">\( \quad \quad <?=$d?> = <?=$res1?> \)</p>
                                <p class="mt-3">\( b. \quad \lambda = <?=preg_replace('/frac/','dfrac',$eigvals2)?> \)</p>
                                <p class="mt-3">\( \quad \quad <?=$d?> = <?=$res2?> \)</p>
                                <p class="mt-3">\( c. \quad \lambda = <?=preg_replace('/frac/','dfrac',$eigvals3)?> \)</p>
                                <p class="mt-3">\( \quad \quad <?=$d?> = <?=$res3?> \)</p>
                                <p class="mt-3"><strong><?=$lang['6']?></strong></p>
                                <p class="mt-3">\( (<?=$l1?>, <?=$l2?>, <?=$l3?>) \)</p>
                                <p class="mt-3"><strong><?=$lang['5']?></strong></p>
                                <p class="mt-3">\( <?=$mul?> \)</p>
                                <p class="mt-3"><strong><?=$lang['4']?></strong></p>
                                <p class="mt-3">\( \left(<?=$res1?>, <?=$res2?>, <?=$res3?> \right) \)</p>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
    @push('calculatorJS')
        @if (isset($detail))
            <script>
                function loadMathJax() {
                    var mathJaxScript = document.createElement('script');
                    mathJaxScript.src = "https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/MathJax.js?config=TeX-AMS_HTML";
                    document.querySelector('head').appendChild(mathJaxScript);
                
                    var mathJaxConfigScript = document.createElement('script');
                    mathJaxConfigScript.type = "text/x-mathjax-config";
                    mathJaxConfigScript.textContent = 'MathJax.Hub.Config({"HTML-CSS": {linebreaks: { automatic: true }},"CommonHTML": {linebreaks: { automatic: true }}}); function MJrerender() { MathJax.Hub.Queue(["Rerender", MathJax.Hub]); }';
                    document.querySelector('head').appendChild(mathJaxConfigScript);
                }
                
                window.addEventListener('load', function () {
                    loadMathJax();
                });
            </script>
        @endif
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
